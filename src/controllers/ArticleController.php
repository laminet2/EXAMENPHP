<?php namespace App\Controller;

use App\Config\Session;
      use App\Model\ArticleVenteModel;
use App\Model\ArticleConfModel;
      use App\Model\CategorieModel;
      use Rakit\Validation\Validation;
      use Rakit\Validation\Validator;
      use App\Config\Controller;

class ArticleController extends Controller{
    
    public function __construct() {
        parent::__construct();
        $this->layout="base";


    }
    public function save(){
        if($_POST==[]){

            $categorieModel=new CategorieModel;
            $categories=$categorieModel->find();

            $this->renderView("article/form",["categories"=>$categories]);
            exit();
        }else{

            //Verification de l'unicite du libelle

            $articleModel= new ArticleConfModel;
            $articles=$articleModel->find();
            if(isset($_POST["libelle"])){
                foreach ($articles as $article) {
                    # code...
                    if($article->getLibelle()==$_POST["libelle"]){
                        Session::set("erreurs",["libelles"=>"Ce libelle existe deja"]);
                        $this->redirect("ArticleController/save");
                    }
                }
            }
                
            

            

            $validator = new Validator;
         
            $validation = $validator->make($_POST + $_FILES, [
            'libelle'                 => 'required',
            'qteStock'              => 'numeric|min:0',
            'photo' =>            'uploaded_file:0,500K,jpg,jpeg',
            'categorieID'=>     'required'
            ]); 
            $validation->setMessage('required', ':attribute Obligatoire .');
            $validation->setMessage('min:0', ' Pourquoi mettre une :attribute négative ?');
            $validation->setMessage('uploades_file',"Une erreur s'est produite lors de l'envoi de la photo verifiez que la :attribute est de taille inferieur a 500ko et du format jpg ou jpeg.");

            $validation->validate();
            if(!$validation->fails()){

            $data=null;
            
            
            if($_POST["type"]=="articleVente"){
                $validator = new Validator;
                $validation = $validator->make($_POST, ['prixVente' => 'required',]);
                $validation->setMessage('required','Vous avez selectionner un article de vente,Il faut donc un prix de Vente');
                $validation->validate();
                if(!$validation->fails()){
                    $articleModel= new ArticleVenteModel;
                    $data=$_POST["prixVente"];
                }else{
                    Session::set("erreurs",$validation->errors());
                    //on enregistre dans le tableau erreur et on redirige vers le formulaire
                }
            }
            $originalFileName = $_FILES['photo']['name'];
            $fileExtension=explode(".",$originalFileName)[1];
            #$fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
            $newName = uniqid('article');
            $newFileName = $newName.'.'.$fileExtension;

            //Depot en local du fichier
            $destination = BASE_URL."/public/img".'/'.$newFileName;
            move_uploaded_file($_FILES['photo']['tmp_name'],$destination);

            //Depot sur la dB
            extract($_POST);
            $articleModel->setPhoto($newFileName);
            $articleModel->setCategorieID($categorieID);
            $articleModel->setLibelle($libelle);
            $articleModel->setQteStock($qteStock);
            $articleModel->setType($type);
            $articleModel->insert($data);
            Session::set("success","L'article a ete enregistrer avec succes");
            $this->redirect("ArticleController/save");
        }

        }
    }
}