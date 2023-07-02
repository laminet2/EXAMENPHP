<?php namespace App\Controller;
      use App\Config\Controller;
      use App\Model\ArticleConfModel;
      use App\Model\DetailProdModel;
      use App\Model\ProductionModel;
class ProductionController extends Controller{
    private $productionModel;
    private $detailProdModel;
    private $articleConfModel;

    public function __construct(){
        parent::__construct();
        $this->layout="base";
        $this->productionModel=new ProductionModel;
        $this->detailProdModel=new DetailProdModel;
        $this->articleConfModel=new ArticleConfModel;
        
    }
    public function save(){
        $this->renderView('appro/form');
    }
    
}