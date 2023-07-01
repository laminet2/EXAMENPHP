<?php 
namespace App\Controller;
use App\Config\Controller;
use App\Config\Help;
use App\Model\ResponsableModel;
use App\Config\Session;
use Rakit\Validation\Validator;
class AuthController extends Controller{

private ResponsableModel $ResponsableModel  ; 
    
public function __construct() {
    parent::__construct();
    $this->layout="blank1";
    $this->ResponsableModel= new ResponsableModel;
}
public function login(){
    

    if($_POST==[]){
        //Help::dumpDie([]);
        $this->renderView("auth/login");
        exit();

    }else{
        //help::dumpDie([]);
        

        $validator = new Validator;
        // Validator::isEmail($_POST["login"],"login");
        // Validator::isVide($_POST["motDePasse"],"motDePasse"); 
        $validation = $validator->make($_POST, [
            'login'                 => 'required|email',
            'motDePasse'              => 'required|min:3',
        ]); 
        $validation->setMessage('required', ':attribute Obligatoire .');

        $validation->validate();
        if(!$validation->fails()){
            
            extract($_POST);
            $user= $this->ResponsableModel->findUserByLoginAndPassword($login,$motDePasse);
            $userTrouver = $user ? $user!=false :null;
            
            $validation = $validator->make([ 'user' => $userTrouver, ],['user' => 'required',]);
            $validation->setMessage('required', 'Aucun :attribute ne correspond a ce compte.');
            $validation->validate();
            if(!$validation->fails()){
                Session::set("user",$user);
                //redirection
                #dump($user);
                #dump($user);

                $this->redirectByRole($user);
                exit();
            }

        }

        Session::set("errors",$validation->errors());
        $this->redirect("AuthController/login");
    }
}
public function logout(){
    Session::destroy();
    $this->redirect("AuthController/login");
}

}
?>