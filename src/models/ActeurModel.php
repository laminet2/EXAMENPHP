<?php namespace App\Model;
      use App\Config\Model;
abstract class ActeurModel extends Model{
protected int $id;
protected string $nom;
protected string $prenom;
protected string $telephone;
protected string $addresse;
protected string $photo;
protected string $type;

public function __construct(){
    parent::__construct();
    $this->table="acteur";
}


	/**
	 * @return int
	 */
	public function getId(): int {
		return $this->id;
	}
	
	/**
	 * @param int $id 
	 * @return self
	 */
	public function setId(int $id): self {
		$this->id = $id;
		return $this;
	}
}
?>