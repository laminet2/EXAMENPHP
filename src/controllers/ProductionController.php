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
    
    public function IdExiste($articleID,$tabObjets){
        foreach ($tabObjets as $key=>$objet) {
            if($objet[1]->getId()==$articleID){
                
                
                return $key;
            }
        }
        return null;
    }

    public function deleteArticleConfSelect($filter){
        if($filter!=null){
            $filter=explode("-",$filter);
            if(count($filter)>1 and $filter[0]=="articleConf"){
                //tester si $filter[1] est in isdigit() and si Session::isset("articleConfSelectionner")
                
                $articleConfSelectionner=Session::get("articleConfSelectionner");
                $key=$this->IdExiste(intVal($filter[1]),Session::get("articleConfSelectionner"));
                if($key!== null){
                    //supprimer en php $articleConfSelectionner.remove($key)
                     
                    //J'enregistre la nouvelle tables
                    Session::set("articleConfSelectionner",$articleConfSelectionner);
                }

            }
        } $this->redirect("ProductionController/add/articleConf");
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
            $this->renderView("production/form",["articlesConf"=>$articlesConf,"filter"=>$filter]);
            exit();

        }else{
            $this->redirectByRole(Session::get("user")??null);
        }

    }
    public function save($filter=null){

        if($filter==null){



            $this->renderView('production/form');
        }elseif($filter=="Production"){
            //Enregistrer
            
            //verifier que le tableau qui contient les articleVente n'est pas vide
            //si ce n'est pas le cas on enregistre , on detruits les onformations dans $session et on le redirige vers la liste  

        }

        
    }


    
    
}