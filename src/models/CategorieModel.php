<?php
namespace App\Model;
use App\config\Model;
 class CategorieModel extends Model{
    private int $id;
    private string $libelle;

    private string $type;

     public function __construct()
     {
         parent::__construct();//
         $this->table="categorie";
     }
     
    /**
     * Get the value of libelle
     */ 
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set the value of libelle
     *
     * @return  self
     */ 
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
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

     public function insert():int{
        //$sql="select * from categorie where id=$id" ;Jamais
        $sql="INSERT INTO $this->table (`id`, `libelle`,`type`) VALUES (NULL,:libelle,:type)";//Requete preparee
        //prepare ==> requete avec parametres
        $stm= self::$dataBase->prepare($sql);
        $stm->execute(["libelle" => $this->libelle,"type" => $this->type]);
        return  $stm->rowCount() ;
     }
    
 
	/**
	 * @return string
	 */
	public function getType(): string {
		return $this->type;
	}
	
	/**
	 * @param string $type 
	 * @return self
	 */
	public function setType(string $type): self {
		$this->type = $type;
		return $this;
	}
}