<?php 
    namespace App\Model;
    use App\config\Model;

class ProductionModel extends Model{
    private int $id;
    private $date;
    private string $observation;

    public function __construct(){
        parent::__construct();
        $this->table="production";
    }
    

	/**
	 * @return string
	 */
	public function getObservation(): string {
		return $this->observation;
	}
	
	/**
	 * @param string $observation 
	 * @return self
	 */
	public function setObservation(string $observation): self {
		$this->observation = $observation;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getDate() {
		return $this->date;
	}
	
	/**
	 * @param mixed $date 
	 * @return self
	 */
	public function setDate($date): self {
		$this->date = $date;
		return $this;
	}
	public function insert($articleSelectionner){
        //$sql="select * from categorie where id=$id" ;Jamais
        $sql="INSERT INTO $this->table (`id`, `date`,`observation`) VALUES (NULL,:date,:observation)";//Requete preparee
        //prepare ==> requete avec parametres
        $stm= self::$dataBase->prepare($sql);
        $stm->execute(["date" => $this->date,"observation" => $this->observation]);
        if($stm->rowCount()==1){
			$productionId= self::$dataBase->lastInsertId();

			foreach($articleSelectionner as $article){

				//enregistrement des articles

				if($article[1]->getType()=="articleConf"){
					$newQte= $article[1]->getQteStock() - $article[0];
				}else{
					$newQte= $article[1]->getQteStock() + $article[0];

					//enregistrement dans detailProd
					$detailProd=new DetailProdModel;
					$detailProd->setProductionID($productionId);
					$detailProd->setArticleVenteID($article[1]->getId());
					$detailProd->setQte($article[0]);
					$detailProd->insert();

				}
				$article[1]->updateOneAttributById($article[1]->getId(),"qteStock",$newQte);
				
			};
		} 
    } 

	
	
}
