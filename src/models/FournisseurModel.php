<?php 
namespace App\Model;

class FournisseurModel extends ActeurModel{
    public function __construct(){
        parent::__construct();
        $this->type="Fournisseur";
    }
}
?>