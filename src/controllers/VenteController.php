<?php namespace App\Controller;
      use App\Config\Controller;
      use App\Model\ArticleVenteModel;
      use App\Model\ClientModel;
      use App\Model\DetailVenteModel;
      use App\Model\VenteModel;
class VenteController extends Controller{
    private $venteModel;
    private $detailVenteModel;
    private $articleVenteModel;
    private $clientModel;
    public function __construct(){
        parent::__construct();
        $this->layout="base";
        $this->venteModel= new VenteModel;
        $this->detailVenteModel = new DetailVenteModel;
        $this->articleVenteModel =new ArticleVenteModel;
        $this->clientModel = new ClientModel;
    }

    public function selectClient(){

        $clients=$this->clientModel->findBy('type',"client");
        $this->renderView("vente/form1",["clients"=>$clients]);
    }
}