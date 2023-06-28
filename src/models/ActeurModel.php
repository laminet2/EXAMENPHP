<?php namespace App\Model;
      use App\Config\Model;
abstract class ActeurModel extends Model{
protected int $id;
protected string $nom;
protected string $prenom;
protected array $telephone;
protected string $addresse;
protected string $idPhoto;
protected string $type;

public function __construct(){
    parent::__construct();
    $this->table="Acteur";
}

}
?>