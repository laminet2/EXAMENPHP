<?php namespace App\Controller;
      use App\Config\Controller;
      use App\Config\Session;
      use App\Model\ArticleVenteModel;
      use App\Model\ClientModel;
      use App\Model\DetailVenteModel;
      use App\Model\VenteModel;
      use Rakit\Validation\Validator;
      use App\config\Model;
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

    public function selectClient($filter=null){
        if($filter!=null ){

            $filter=explode("-",$filter);
            if( count($filter)==2 &&  ctype_digit($filter[1]) ){

                $client=$this->clientModel->findBy("type","client",true);
                if($client!=false){
                    Session::set("clientSelectionner",$client);
                    //redirectSelectArticleVente
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
        if(Session::isset("clientSelectionner")){
            Session::unset("clientSelectionner");
        }
        if(Session::isset("articleVenteSelectionnerZoneVente")){
            Session::unset("articleVenteSelectionnerZoneVente");
        }

        $this->redirect("VenteController/selectClient");
    }
}