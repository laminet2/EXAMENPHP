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

	/**
	 * @return string
	 */
	public function getNom(): string {
		return $this->nom;
	}
	
	/**
	 * @param string $nom 
	 * @return self
	 */
	public function setNom(string $nom): self {
		$this->nom = $nom;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getPrenom(): string {
		return $this->prenom;
	}
	
	/**
	 * @param string $prenom 
	 * @return self
	 */
	public function setPrenom(string $prenom): self {
		$this->prenom = $prenom;
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
 * Get the value of addresse
 */ 
public function getAddresse()
{
return $this->addresse;
}

/**
 * Set the value of addresse
 *
 * @return  self
 */ 
public function setAddresse($addresse)
{
$this->addresse = $addresse;

return $this;
}

/**
 * Get the value of telephone
 */ 
public function getTelephone()
{
return $this->telephone;
}

/**
 * Set the value of telephone
 *
 * @return  self
 */ 
public function setTelephone($telephone)
{
$this->telephone = $telephone;

return $this;
}
}
?>