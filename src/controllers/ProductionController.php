<?php namespace App\Controller;

use App\Model\ArticleConfModel;
      use App\Config\Controller;
      use App\Config\Session;
      use App\Model\ArticleVenteModel;
      use App\Model\DetailProdModel;
      use App\Model\ProductionModel;
class ProductionController extends Controller{
    private $productionModel;
    private $detailProdModel;
    private $articleConfModel;
    private $articleVenteModel;

    public function __construct(){
        parent::__construct();
        $this->layout="base";
        $this->productionModel=new ProductionModel;
        $this->detailProdModel=new DetailProdModel;
        $this->articleConfModel=new ArticleConfModel;
        $this->articleVenteModel=new ArticleVenteModel;
        
    }
    
    public function IdExiste($articleID,$tabObjets){
        foreach ($tabObjets as $key=>$objet) {
            if($objet[1]->getId()==$articleID){
                
                
                return $key;
            }
        }
        return null;
    }


    public function deleteArticleFromArticleSelectionner($type,$filter){
        
        $articleSelectionner=Session::get("article".$type."Selectionner");
        $key=$this->IdExiste(intVal($filter),Session::get("article".$type."Selectionner"));
        if($key!== null){
            //supprimer en php $articleSelectionner.remove($key)
            unset($articleSelectionner[$key]);

            //J'enregistre la nouvelle tables
            Session::set("article".$type."Selectionner",$articleSelectionner);

    }}

    public function deleteArticleConfSelect($filter){

        if($filter!=null){
            $filter=explode("-",$filter);

            if(count($filter)>1 and $filter[0]=="articleConf"){
                //tester si $filter[1] est in isdigit() and si Session::isset("articleSelectionner")
                
                if(ctype_digit($filter[1])){
                    $this->deleteArticleFromArticleSelectionner("Conf",$filter[1]);
                }
            }
        }
        $this->redirect("ProductionController/add");

    }

    public function deleteArticleVenteSelect($filter){

        if($filter!=null){
            $filter=explode("-",$filter);

            if(count($filter)>1 and $filter[0]=="articleVente"){
                //tester si $filter[1] est in isdigit() and si Session::isset("articleSelectionner")
                
                if(ctype_digit($filter[1])){
                    $this->deleteArticleFromArticleSelectionner("Vente",$filter[1]);
                }
            }
        }
        $this->redirect("ProductionController/save");

    }




    public function saveInSessionArticleSelectionner(string $type,$articleModel){

            #dd("article".$type."ID");

            

            $qteChoisieBefore=0;

            if(Session::isset("article".$type."Selectionner")){
                $articleSelectionner=Session::get("article".$type."Selectionner");
                $key=$this->IdExiste($_POST["article".$type."ID"],Session::get("article".$type."Selectionner"));
                
                if($key !== null ){
                    $qteChoisieBefore=$articleSelectionner[$key][0];
                }

            }else{
                $articleSelectionner=[];

            }

            $articleModel= $articleModel->findBy("id",$_POST["article".$type."ID"],true);
            #dd($articleConf);
            if($type=="Vente"|| $articleModel->getQteStock() >= $qteChoisieBefore + intval( $_POST["qte"])){

                if(isset($key)){

                    $articleSelectionner[$key]=[intval($_POST["qte"]) + $qteChoisieBefore,$articleModel];

                }else{
                    $articleSelectionner[]=[intval($_POST["qte"])+$qteChoisieBefore,$articleModel];
                }

                Session::set("article".$type."Selectionner",$articleSelectionner);
            }else{
                $erreurs["qte"]="Les quantites selectionner sont beaucoup trop importante !!!,  En Stock il n'y a que ".$articleModel->getQteStock()."  ".$articleModel->getLibelle()."  Vous a en avez selectionner "." ".$qteChoisieBefore;
                Session::set("erreurs",$erreurs);
            
            }
            
    }
    public function add(string $filter=null){

            
            #dd($articlesConf);
            if(count($_POST)>0){

                if( isset($_POST["articleConfID"]) ){
                    $articleConfModel=new ArticleConfModel;
                    $this->saveInSessionArticleSelectionner("Conf",$articleConfModel);
                }else{
                        $erreurs["articleConfID"]="Tous les champs sont Obligatoires ,Veuillez renseigner une valeur avant de soummetre";
                        Session::set("erreurs",$erreurs);
                }
            }
            $articlesConf=$this->articleConfModel->findBy("type","articleConf");
            $this->renderView("production/form",["articlesConf"=>$articlesConf]);
            exit();

       
            #$this->redirectByRole(Session::get("user")??null);

    }


    public function save($filter=null){

        if(!Session::isset("articleConfSelectionner") ){
            if(Session::isset("articleConfSelectionner") && count(Session::get("articleConfSelelectionner"))==0 ){
                $this->add();
                exit();
            }        
           
        }

        if(count($_POST)>0){

            //Enregistrer
            //alors cette fonction aete appeler pour enregistrer des Articles De Vente

            if(isset($_POST["articleVenteID"]) ){
                
                $articleVenteModel = new ArticleVenteModel;
                $this->saveInSessionArticleSelectionner("Vente",$articleVenteModel);

            }else{

                $erreurs["articleVenteID"]="Tous les champs sont Obligatoires ,Veuillez renseigner une valeur avant de soummetre";
                Session::set("erreurs",$erreurs);
            }
        }

        $articlesVente=$this->articleVenteModel->findBy("type","articleVente");
        $this->renderView('production/form2',["articlesVente"=>$articlesVente]);
    }


    public function selectionTerminer(){
        if(Session::isset("articleVenteSelelectionner") && count(Session::get("articleVenteSelelectionner"))==0){
            $this->redirect("/ProductionController/save");
        }
            if(isset($_POST["save"])){

                 //on retranche les qte de toutes articles conf

                //on ajoute les qte de toute article Vente

                //on supprime de session articleConf Selectioonner 

                //on enregistre dans le tableau  production

                //on enregistre dans details production

                //on supprime de session articleVente Selectioonner 

                //on redirige vers liste productions.

                $articleConfSelectionner=Session::get("articleConfSelectionner");
                foreach ($articleConfSelectionner as $key => $articleConf) {
                    $articleConf[1]->updateOneAttributById($articleConf[1]->getId(),"qteStock",$articleConf[1]->getQteStock() - $articleConf[0]);
                }
        
                $articleVenteSelectionner=Session::get("articleVenteSelectionner");
                foreach ($articleVenteSelectionner as $key => $articleVente) {
                    $articleVente[1]->updateOneAttributById($articleVente[1]->getId(),"qteStock",$articleVente[1]->getQteStock() + $articleVente[0] );
                }
        
                Session::unset("articleConfSelectionner");

                $this->productionModel->setObservation($_POST["observation"]);
                $this->productionModel->setDate();


            }else{
                $articlesSelectionner=array_merge(Session::get("articleConf"))
                
            }
               



       

        


    }


    
    
}