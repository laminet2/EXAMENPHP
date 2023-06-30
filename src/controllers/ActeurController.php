<?php namespace App\Controller;
      use App\Config\Controller;
class ActeurController extends Controller{
    public function __construct(){
        parent::__construct();
        $this->layout="base";
        
    }
    public function showFormActeur(){
        if($_POST==[]){
            $this->renderView("acteur/form");
            exit();
        }
        

    }
}