<?php namespace App\Controller;
      use App\Config\Controller;
      use App\Config\Session;
      use App\Model\ArticleVenteModel;
      use App\Model\ClientModel;
      use App\Model\DetailVenteModel;
      use App\Model\PayementModel;
      use App\Model\VenteModel;
      use Rakit\Validation\Validator;
      use App\config\Model;
class VenteController extends Controller{
    private $venteModel;
    private $detailVenteModel;
    private $articleVenteModel;
    private $clientModel;
    private $payementModel;
    public function __construct(){
        parent::__construct();
        $this->layout="base";
        $this->venteModel= new VenteModel;
        $this->detailVenteModel = new DetailVenteModel;
        $this->articleVenteModel =new ArticleVenteModel;
        $this->clientModel = new ClientModel;
        $this->payementModel=new PayementModel;
    }

    function sommeArticleVente(){
        $somme=0;
        if(isset(Session::get("panier")["articleVente"])){
            foreach(Session::get("panier")["articleVente"] as $articleVente){
                $somme+=$articleVente[0]*$articleVente[1]->getPrixVente();
            }
        }
        return $somme;
    }
    public function selectionTerminer(){
        if(Session::isset("panier")){
            $panier=Session::get("panier");
            if(isset($panier["articleVente"])){

                $articleVente=$panier["articleVente"];
                if($articleVente!=[] ){
                    
                    //ici je scinde la fonction en deux options soit pour aficher le form3 soit pour enregistrer
                    if(isset($_POST["payement"])){
                        //A partir de la les test sont fini au peu effectuer une operation de finition pour le payement
                    extract($_POST);


                    //on recherche la quantite totale
                    $qteTotale=0;
                    foreach ($articleVente as $article) {
                        # code...
                        $qteTotale+=$article[0];
                    }
                    $this->venteModel->setQteTotale($qteTotale);
                    $this->venteModel->setMontant($this->sommeArticleVente());
                    $this->venteModel->setDate(date("Y-m-d"));
                    $this->venteModel->setClientID($panier["client"]->getId());
                    $this->venteModel->setStatut(($this->sommeArticleVente()>$payement??0)?false:true);
                    $this->venteModel->setObservation($observation??"");

                    $this->venteModel->insert($panier);
                    Session::unset("panier");
                    Session::set("success","vente enregistrer avec success");
                    $this->redirect("VenteController/selectClient");
                    exit();
                    }

                    
                } $this->renderView("vente/form3",["somme"=>$this->sommeArticleVente()]);
                    exit();
                

            }
            
            

        }$this->redirect("VenteController/selectArticleVente");
        
       

    }
   
    public function selectArticleVente(){
        if(!Session::isset("panier")){
            $this->redirect("VenteController/selectClient");
            exit();
        }
        if($_POST!=[]){
            if(isset($_POST["articleVenteID"])){

                $this->saveInPanierarticleVenteSelectionner();

            }else{
                $erreurs["articleVenteID"]="Selectionner un article Vente avant de soummetre un ajout";
                Session::set("erreurs",$erreurs);
            }
            
        }
        //Select somme quantite
        $somme=$this->sommeArticleVente();

       
        $articlesVente=$this->articleVenteModel->findBy("type","articleVente");
        $this->renderView("vente/form2",["articlesVente"=>$articlesVente,"somme"=>$somme]);
    }

    public function selectClient($filter=null){
        if($filter!=null ){

            $filter=explode("-",$filter);

            if( count($filter)==2 &&  ctype_digit($filter[1]) ){
                //filter pour selecetionner un client

                $client=$this->clientModel->findBy("id",$filter[1],true);
                if($client!=false){
                    $panier=[];
                    $panier["client"]=$client;
                    Session::set("panier",$panier);
                    
                    //redirectSelectArticleVente
                    $this->selectArticleVente();
                    exit();
                }
            }
        }

        $clients=$this->clientModel->findBy('type',"client");
        $this->renderView("vente/form1",["clients"=>$clients]);
    }

    
    public function saveClient(){
        if($_POST!=[]){

            $validator = new Validator;
         
            $validation = $validator->make($_POST + $_FILES, [
            'nom'                 => 'required',
            'prenom'              => 'required',
            'photo' =>            'uploaded_file:0,500K,jpg,jpeg'
            ]); 
            $validation->setMessage('required', ':attribute Obligatoire .');
            $validation->setMessage('uploaded_file',"Une erreur s'est produite lors de l'envoi de la photo verifiez que la :attribute est de taille inferieur a 500ko et du format jpg ou jpeg.");

            $validation->validate();
            if(!$validation->fails()){


                extract($_POST);
                $this->clientModel->setNom($nom);
                $this->clientModel->setPrenom($prenom);
                $this->clientModel->setAddresse($addresse??"");
                $this->clientModel->setTelephone($telephone??"");
                $this->clientModel->setObservation($observation??"");
                if($_FILES["photo"]["error"]!=4){

                    $originalFileName = $_FILES['photo']['name'];
                    $fileExtension=explode(".",$originalFileName)[1];
                    #$fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
                    $newName = uniqid('client');
                    $newFileName = $newName.'.'.$fileExtension;

                    //Depot en local du fichier
                    $destination = $_SERVER['DOCUMENT_ROOT']."/examenPHP/public/img".'/'.$newFileName;
                    #dump($_FILES);

                    move_uploaded_file($_FILES['photo']['tmp_name'],$destination);
                }

                $this->clientModel->setPhoto($newFileName??"");
                $this->clientModel->insertClient();
                $this->clientModel->setObservation($observation??"");
        }else{
            Session::set("erreurs",$validation->errors());
        }
           
        $this->redirect("VenteController/selectClient/client-".$this->clientModel->getDataBase()->lastInsertId() );
    }
    }

    public function annulerVente(){
        
        if(Session::isset("panier")){
            Session::unset("panier");
        }

        $this->redirect("VenteController/selectClient");
    }
    public function IdExiste($articleID,$tabObjets){
        foreach ($tabObjets as $key=>$objet) {
            if($objet[1]->getId()==$articleID){
                return $key;
            }
        }
        return null;
    }
    public function saveInPanierarticleVenteSelectionner(){

        #dd("article".$type."ID");

        $qteChoisieBefore=0;

        $panier=Session::get("panier");

        if(isset($panier["articleVente"])){

            $articleSelectionner=$panier["articleVente"];

            $key=$this->IdExiste($_POST["articleVenteID"],$articleSelectionner);
            
            if($key !== null ){
                $qteChoisieBefore=$articleSelectionner[$key][0];
            }

        }else{
            $articleSelectionner=[];

        }
        $articleModel=new ArticleVenteModel;
        $articleModel= $articleModel->findBy("id",$_POST["articleVenteID"],true);
        #dd($articleConf);
        if($articleModel->getQteStock() >= $qteChoisieBefore + intval( $_POST["qte"])){

            if(isset($key)){

                $articleSelectionner[$key]=[intval($_POST["qte"]) + $qteChoisieBefore,$articleModel];

            }else{
                $articleSelectionner[]=[intval($_POST["qte"])+$qteChoisieBefore,$articleModel];
            }
            $panier["articleVente"]=$articleSelectionner;
            Session::set("panier",$panier);
        }else{
            $erreurs["qte"]="Les quantites selectionner sont beaucoup trop importante !!!,  En Stock il n'y a que ".$articleModel->getQteStock()."  ".$articleModel->getLibelle()."  Vous a en avez selectionner "." ".$qteChoisieBefore;
            Session::set("erreurs",$erreurs);
        }  
    }
    public function deleteArticleSelect($filter){
        $panier=Session::get("panier") ?? [];
        if(isset($panier["articleVente"]) ){
            $filter=explode("-",$filter);
            if(count($filter)==2){

                $key= $this->IdExiste($filter[1],$panier["articleVente"]);
                if($key!== null){

                    unset($panier["articleVente"][$key]);
                    Session::set("panier",$panier);
                }
            }

        }
        $this->redirect("VenteController/selectArticleVente");
            
    } 
    
    
    public function index($filter=null){
        //si tu rentre dans cette fonction avec un filter ses pour afficher details
        //si tu rentre avec un post ses pour filtrer
        //si tu rentre sans rien alors ses pour juste afficher

        $ventes=$this->venteModel->findAllReturnArray();
        if(isset($_POST["filtrer"])){
            unset($_POST["filtrer"]);
            if($_POST["date"]==""){
                unset($_POST["date"]);
            }

            if($_POST!==[]){
                $data=$_POST;
                $ventes= $this->venteModel->findByReturnArray($this->venteModel->RequeteCondition($_POST),$data);
            }
        }elseif($filter!=null){
            //on cherche a filtrer
            $filter=explode("-",$filter);
            if(count($filter)==2){
                $key=$this->venteModel->findBy("id",$filter[1],true);
                if($key!=[]){

                    //Verification Terminer
                    $payements=$this->payementModel->findBy("venteID",$filter[1]);
                    $detailVentes=$this->detailVenteModel->findByReturnArray("venteID=:venteID",["venteID"=>$filter[1]]);
                    $client=$this->clientModel->findBy("id",$key->getClientID(),true);
                    $vente=$this->venteModel->findBy("id",$filter[1],true);
                    $somme=0;
                    foreach ($payements as $payement) {
                        $somme+=$payement->getMontant();
                    }
                    $this->renderView('vente/detail',["payements"=>$payements,"detailVentes"=>$detailVentes,"client"=>$client,"somme"=>$somme,"vente"=>$vente]);


                }

            }
            

        }



        $clients=$this->clientModel->findBy("type","client");
        $this->renderview("vente/liste",["ventes"=>$ventes,"clients"=>$clients]);
    }

    public function savePaiement(){
        if(isset($_POST["montant"])){
            if($_POST["montant"]>$_POST["montantRestant"] || $_POST["montant"]<=0){
                $erreurs["payement"]="Montant entrer invalide";
                Session::set("erreurs",$erreurs);
            }else{
                $this->payementModel->setMontant($_POST["montant"]);
                $this->payementModel->setDate(date("Y-m-d"));
                $this->payementModel->setVenteID($_POST["articleVenteID"]);
                $this->payementModel->insert();
                Session::set("success","Payement Enregistrer avec succes");
            }
        }$this->redirect("VenteController/index/vente-".$_POST["articleVenteID"]);
    }
    
}