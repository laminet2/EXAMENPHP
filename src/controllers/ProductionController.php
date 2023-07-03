<?php namespace App\Controller;

use App\Model\ArticleConfModel;
      use App\Config\Controller;
      use App\Config\Session;
      use App\Model\ArticleModel;
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

    public function IdExiste($articleID,$tabObjets){
        foreach ($tabObjets as $key=>$objet) {
            if($objet[1]->getId()==$articleID){
                
                
                return $key;
            }
        }
        return null;

    }
    public function add(string $filter=null){

        if($filter!=null){

            if($filter=="articleConf" && count($_POST)>0){

                if(isset($_POST["articleConfID"])){

                $qteChoisieBefore=0;

                if(Session::isset("articleConfSelectionner")){
                    $articleConfSelectionner=Session::get("articleConfSelectionner");
                    $key=$this->IdExiste($_POST["articleConfID"],Session::get("articleConfSelectionner"));
                    
                    if($key !== null ){
                        $qteChoisieBefore=$articleConfSelectionner[$key][0];
                    }

                }else{
                    $articleConfSelectionner=[];

                }

                $articleConf= $this->articleConfModel->findBy("id",$_POST["articleConfID"],true);
                #dd($articleConf);
                if($articleConf->getQteStock() >= $qteChoisieBefore + intval( $_POST["qte"])){
                    if(isset($key)){
                        $articleConfSelectionner[$key]=[intval($_POST["qte"]) + $qteChoisieBefore,$articleConf];


                    }else{
                        $articleConfSelectionner[]=[intval($_POST["qte"])+$qteChoisieBefore,$articleConf];
                    }

                    Session::set("articleConfSelectionner",$articleConfSelectionner);
                }else{
                    $erreurs["qte"]="Les quantites selectionner sont beaucoup trop importante !!!,  En Stock il n'y a que ".$articleConf->getQteStock()."  ".$articleConf->getLibelle()."  Vous a en avez selectionner "." ".$qteChoisieBefore;
                    Session::set("erreurs",$erreurs);
                }
                }else{
                    
                    $erreurs["articleConfID"]="Tous les champs sont Obligatoires ,Veuillez renseigner une valeur avant de soummetre";
                    Session::set("erreurs",$erreurs);
                }
                
            }elseif($filter!="articleConf"){
                $this->redirectByRole(Session::get("user")??null);
            }
            $articlesConf=$this->articleConfModel->findBy("type","articleConf");
            #dd($articlesConf);
            $this->renderView("appro/form",["articlesConf"=>$articlesConf,"filter"=>$filter]);
            exit();

        }else{
            $this->redirectByRole(Session::get("user")??null);
        }
        

    }
    
    
}