<?php 
namespace App\Controller;
use App\Config\Controller;
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
    
    
    if(isset($_SERVER["REQUEST_URI"])){
        //Help::dumpDie([]);
        $this->renderView("auth/login");


    }else{
        //help::dumpDie([]);
        $validator = new Validator;
        // Validator::isEmail($_POST["login"],"login");
        // Validator::isVide($_POST["motDePasse"],"motDePasse"); 
        $validation = $validator->validate($_POST, [
            'login'                 => 'required|email',
            'motDePasse'              => 'required|min:3',
        ]); 
        if(!$validation->fails()){
            
            extract($_POST);
            $user=$ResponsableModel->findUserByLoginAndPassword($login,$motDePasse);
            $validation = $validator->make([ 'user' => $user, ],['user' => 'required',]);
            if($validation->fails()){
                $validation->setMessage('required', 'Aucun :attribute ne correspond a ce compte.');
            }else{
                Session::set("user",$user);
                //redirection
                $this->renderView("404");
            }

        }Session::set($validation->errors(),"errors");
        $this->redirect("AuthController/login");
    }
}

}
?>