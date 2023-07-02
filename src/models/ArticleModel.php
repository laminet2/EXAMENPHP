<?php 
namespace App\Model;
use App\config\Model;
abstract class  ArticleModel extends Model{
protected int $id;
protected string $libelle;
protected int $qteStock;
protected string $type;
protected int $categorieID;

protected string $photo;


public function __construct(){
    parent::__construct();
    $this->table="article";

}
/**
 * Get the value of qteStock
 */ 
public function getQteStock()
{
return $this->qteStock;
}

/**
 * Set the value of qteStock
 *
 * @return  self
 */ 
public function setQteStock($qteStock)
{
$this->qteStock = $qteStock;

return $this;
}

/**
 * Get the value of categorieID
 */ 
public function getCategorieID()
{
return $this->categorieID;
}

/**
 * Set the value of categorieID
 *
 * @return  self
 */ 
public function setCategorieID($categorieID)
{
$this->categorieID = $categorieID;

return $this;
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
	 * @return string
	 */
	public function getPhoto(): string {
		return $this->photo;
	}
	
	/**
	 * @param string $photo 
	 * @return self
	 */
	public function setPhoto(string $photo): self {
		$this->photo = $photo;
		return $this;
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

	/**
	 * @return int
	 */
	public function getId(): int {
		return $this->id;
	}
	
	/**
	 * @param int $id 
	 */
	public function setId(int $id): self {
		$this->id = $id;
		return $this;
	}
	public function insert($data=null):int{
		//$sql="select * from categorie where id=$id" ;Jamais
		$sql="INSERT INTO $this->table values (NULL, :libelle, :qteStock, :type, :categorieID, :photo,:prixVente,:montantVente) ";//Requete preparee
		//prepare ==> requete avec parametres*
		#dd($this->photo);
		$stm= self::$dataBase->prepare($sql);
		$stm->execute(["libelle"=>$this->libelle,
					   "qteStock"=>$this->qteStock,
					   "type" => $this->type,
					   "prixVente"=>$this->type=="articleVente"?$data:NULL,
					   "categorieID"=>$this->categorieID,
					   "photo"=> $this->photo??"",
					   "montantVente"=>$this->type=="articleVente"?0:null,
			]);
		return  $stm->rowCount() ;
	 }
}