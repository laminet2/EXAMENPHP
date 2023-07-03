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
    public function save(string $filtre =null ){
        
        #dump($filtre);

        if($filtre!=null ){
            $filtre=explode("-",$filtre);
            if(count($filtre)==2){
                $filtre=$filtre[1];
            }else{
                $filtre="articleConf";
            }
        }else{
            $filtre="articleConf";
        }

        if($_POST==[]){
            $categorieModel=new CategorieModel;
            

            // if($filtre=="articleConf"){
            //     $categories=$categorieModel->findBy("type","confection");
            // }else{
            //     $categories=$categorieModel->findBy("type","vente");
            // }
            $categories=$categorieModel->findBy("type",$filtre);

            $categorie= $categories==false?[]:$categories;
            

            $this->renderView("article/form",["categories"=>$categorie,"filtre"=>$filtre]);
            exit();
        }else{

            //Verification de l'unicite du libelle

            $articleModel= new ArticleConfModel;
            $articles=$articleModel->find();
            if(isset($_POST["libelle"])){
                foreach ($articles as $article) {
                    # code...
                    if(strtolower($article->getLibelle())==strtolower($_POST["libelle"])){
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
            
            if($filtre=="articleVente"){
                $validator = new Validator;
                $validation = $validator->make($_POST, ['prixVente' => 'required',]);
                $validation->setMessage('required','Vous avez selectionner un article de vente,Il faut donc un prix de Vente');
                $validation->validate();
                if(!$validation->fails()){
                    $articleModel= new ArticleVenteModel;
                    $data=$_POST["prixVente"];
                }else{
                    Session::set("erreurs",$validation->errors());
                    $this->redirect("ArticleController/save/article-articleVente");
                    //on enregistre dans le tableau erreur et on redirige vers le formulaire
                }
            }
            if($_FILES["photo"]["error"]!=4){
                
                $originalFileName = $_FILES['photo']['name'];
                $fileExtension=explode(".",$originalFileName)[1];
                #$fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
                $newName = uniqid('article');
                 $newFileName = $newName.'.'.$fileExtension;

                //Depot en local du fichier
                $destination = $_SERVER['DOCUMENT_ROOT']."/examenPHP/public/img".'/'.$newFileName;
                #dump($_FILES);

                move_uploaded_file($_FILES['photo']['tmp_name'],$destination);
                $articleModel->setPhoto($newFileName);

            }
            

            //Depot sur la dB
            extract($_POST);
            $articleModel->setCategorieID($categorieID);
            $articleModel->setLibelle($libelle);
            $articleModel->setQteStock($qteStock);
            
            $articleModel->insert($data);
            Session::set("success","L'article a ete enregistrer avec succes");
            $this->redirect("ArticleController/save/article-$filtre");
        }

        }Session::set("erreurs",$validation->errors());
        $this->redirect("ArticleController/save/article-articleConf");
    }

    public function saveCategorie(){
        $categorieModel=new CategorieModel;
        $categories=$categorieModel->find();
        if(isset($_POST["libelle"])){
            foreach ($categories as $categorie) {
                if(strtolower($categorie->getLibelle())==strtolower($_POST["libelle"])){
                    Session::set("erreurs",["libelles"=>"Ce libelle existe deja"]);
                    $this->redirect("ArticleController/save/article-articleConf");
                } 
            }
        }
            $validator = new Validator;
            $validation = $validator->make($_POST, [
            'libelle' => 'required',
            'type'=> 'required']);

            $validation->setMessage('required', ' Le :attribute de la categorie est necessaire pour un enregistrement de la categorie?');

            $validation->validate();
            if($validation->fails()){
                Session::set("erreurs",$validation->errors());
                $this->redirect("ArticleController/save/article-articleConf");
            }Session::set("success","Nouvelle Categorie enregistrer avec success");
            extract($_POST);
            $categorieModel->setLibelle($libelle);
            $categorieModel->setType($type);
            $categorieModel->insert();
            $this->redirect("ArticleController/save/article-articleConf");
    }
}