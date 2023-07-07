<?php namespace App\Model;
      use App\config\Model;
class DetailVenteModel extends Model{
    private $id;
    private $qte;
    private  $prix;
    private $articleVenteID;
    private $venteID;

    public function __construct(){
        parent::__construct();
        $this->table="detailVente";
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
     * Get the value of qte
     */ 
    public function getQte()
    {
        return $this->qte;
    }

    /**
     * Set the value of qte
     *
     * @return  self
     */ 
    public function setQte($qte)
    {
        $this->qte = $qte;

        return $this;
    }

    /**
     * Get the value of prix
     */ 
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set the value of prix
     *
     * @return  self
     */ 
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get the value of articleVenteID
     */ 
    public function getArticleVenteID()
    {
        return $this->articleVenteID;
    }

    /**
     * Set the value of articleVenteID
     *
     * @return  self
     */ 
    public function setArticleVenteID($articleVenteID)
    {
        $this->articleVenteID = $articleVenteID;

        return $this;
    }

  
	 
	public function getVenteID() {
		return $this->venteID;
	}
	
	/**
	 * @param mixed $venteID 
	 * @return self
	 */
	public function setVenteID($venteID): self {
		$this->venteID = $venteID;
		return $this;
	}
    function findByReturnArray(string $filter,$data){
        $articleTable=new ArticleVenteModel;
        $articleTable=$articleTable->getTable();

        $sql="SELECT $this->table.qte,$this->table.prix,article.libelle,article.photo FROM `article`,$this->table WHERE $this->table.articleVenteID=$articleTable.id and $articleTable.id=$this->table.articleVenteID";
        $sql=$sql." and ".$filter;

        return $this->executeSelectReturnArray($sql,$data);

        
    }
    public function insert(){
        $sql="INSERT INTO `detailvente` (`id`, `articleVenteID`, `qte`, `venteID`, `prix`) VALUES (NULL, :articleID, :qte, :venteID, :prix)";
        $stm= self::$dataBase->prepare($sql);
        $stm->execute(["articleID"=>$this->articleVenteID,"qte"=>$this->qte,"venteID"=>$this->venteID,"prix"=>$this->prix]);
        
    }
}