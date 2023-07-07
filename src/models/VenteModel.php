<?php namespace App\Model;
      use App\config\Model;

class VenteModel extends Model{

    private int $id;
    private float $montant;
    private int $qteTotale;
    private string $date;
    private string $observation;
    private bool $statut;
    private int $clientID;
    
    public function __construct(){
        parent::__construct();
        $this->table="vente"; 
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of montant
     */ 
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set the value of montant
     *
     * @return  self
     */ 
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get the value of qteTotale
     */ 
    public function getQteTotale()
    {
        return $this->qteTotale;
    }

    /**
     * Set the value of qteTotale
     *
     * @return  self
     */ 
    public function setQteTotale($qteTotale)
    {
        $this->qteTotale = $qteTotale;

        return $this;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of observation
     */ 
    public function getObservation()
    {
        return $this->observation;
    }

    /**
     * Set the value of observation
     *
     * @return  self
     */ 
    public function setObservation($observation)
    {
        $this->observation = $observation;

        return $this;
    }

    /**
     * Get the value of statut
     */ 
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set the value of statut
     *
     * @return  self
     */ 
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get the value of clientID
     */ 
    public function getClientID()
    {
        return $this->clientID;
    }

    /**
     * Set the value of clientID
     *
     * @return  self
     */ 
    public function setClientID($clientID)
    {
        $this->clientID = $clientID;

        return $this;
    }
    public function insert($panier){
        //$sql="select * from categorie where id=$id" ;Jamais
        $sql="INSERT INTO $this->table  VALUES (NULL, :qteTotale, :date, :montant, :observation, :statut, :clientID)" ;//Requete preparee
        //prepare ==> requete avec parametres
        $stm= self::$dataBase->prepare($sql);
        $stm->execute([ "qteTotale" =>   $this->qteTotale,
                        "date" =>        $this->date,
                        "montant" =>     $this->montant,
                        "observation" => $this->observation,
                        "statut"  =>    $this->statut?1:0,
                        "clientID" =>  $this->clientID]);

        if($stm->rowCount()==1){
			$venteID= self::$dataBase->lastInsertId();

            //enregistrement Payement seulement au cas ou payement>0
            if(isset($_POST["payement"]) && $_POST["payement"]>0){
                $montant=$_POST["payement"];
                $payement=new PayementModel;
                $payement->setDate(date("Y-m-d"));
                $payement->setMontant($montant);
                $payement->setVenteID($venteID);
                $payement->insert();
            }

			foreach($panier["articleVente"] as $article){

				//enregistrement des articles
               
					$newQte= $article[1]->getQteStock() - $article[0];

					//enregistrement dans detailVente
					$detailVente=new DetailVenteModel;
					$detailVente->setVenteID($venteID);
					$detailVente->setQte($article[0]);
                    $detailVente->setArticleVenteID($article[1]->getId());
                    $detailVente->setPrix($article[1]->getPrixVente());
					$detailVente->insert();
				    $article[1]->updateOneAttributById($article[1]->getId(),"qteStock",$newQte);
            }
				
		};
		
    } 
    function findAllReturnArray(){
        $clientModel=new ClientModel;

        $clientTable=$clientModel->getTable();
        $sql="SELECT vente.id,qteTotale,montant,date,statut,nom,prenom FROM `vente`,`acteur` WHERE $this->table.clientID=$clientTable.id and $clientTable.id=$this->table.clientID";
        
        return $this->executeSelectReturnArray($sql);
    }
    function findByReturnArray(string $filter,$data){
        $clientModel=new ClientModel;
        $clientTable=$clientModel->getTable();

        $sql="SELECT vente.id,qteTotale,montant,date,statut,nom,prenom FROM `vente`,`acteur` WHERE $this->table.clientID=$clientTable.id and $clientTable.id=$this->table.clientID";
        $sql=$sql." and ".$filter;

        return $this->executeSelectReturnArray($sql,$data);

        
    }
}