<?php 
namespace App\Model;
class ArticleConfModel extends ArticleModel{

    private FournisseurModel $fournisseur;

    public function __construct(){
        parent::__construct();
        $this->type="articleConf";
    
    }
}