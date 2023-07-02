<?php namespace App\Model;
      use App\config\Model;
class DetailApproModel extends Model{
private $id;
private $qte;
private $prixAchat;
private int $fournisseurID;


private $ArtConfectionID;
private $ApproID;

public function __construct(){
    parent::__construct();
    $this->table="detailappro";

}

	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * @param mixed $id 
	 * @return self
	 */
	public function setId($id): self {
		$this->id = $id;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getQte() {
		return $this->qte;
	}
	
	/**
	 * @param mixed $qte 
	 * @return self
	 */
	public function setQte($qte): self {
		$this->qte = $qte;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getArtConfectionID() {
		return $this->ArtConfectionID;
	}
	
	/**
	 * @param mixed $ArtConfectionID 
	 * @return self
	 */
	public function setArtConfectionID($ArtConfectionID): self {
		$this->ArtConfectionID = $ArtConfectionID;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getApproID() {
		return $this->ApproID;
	}
	
	/**
	 * @param mixed $ApproID 
	 * @return self
	 */
	public function setApproID($ApproID): self {
		$this->ApproID = $ApproID;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getFournisseurID(): int {
		return $this->fournisseurID;
	}
	
	/**
	 * @param int $fournisseurID 
	 * @return self
	 */
	public function setFournisseurID(int $fournisseurID): self {
		$this->fournisseurID = $fournisseurID;
		return $this;
	}
}