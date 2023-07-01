<?php namespace App\Controller;
      use App\Config\Controller;
class ArticleController extends Controller{
    public function __construct() {
        parent::__construct();
        $this->layout="base";

    }
    public function save(){
        $this->renderView("article/form");
    }
}