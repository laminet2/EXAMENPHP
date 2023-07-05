<?php namespace App\Controller;
      use App\Config\Controller;
      use App\Model\ArticleVenteModel;
      use App\Model\PayementModel;

class PayementController extends Controller{
    private $payamentModel;
    private $articleVenteModel;

    public function __construct(){
        $this->layout="base";
        $this->payamentModel= new PayementModel;
        $this->articleVenteModel =new ArticleVenteModel;
    }
}

