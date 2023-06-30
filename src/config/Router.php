<?php 

use App\Config\Controller;
use App\Config\Session;
use App\Controller\AuthController;

#phpinfo();
#echo("coucou");
$Interdit=['getId','getPassword'];
$listesControllers=["AuthController","ActeurController"];

if(isset($_POST["route"])){
    $url=$_POST["route"];
    $url = explode("/",$url);
    $controller=$url[0];


}else{
    $url = $_SERVER["REQUEST_URI"];
    $url = explode("/",$url);
    array_shift($url);
    $controller=$url[0];
}

if($controller==""){

        $controller =new Controller;
        $controller->redirectByRole($_SESSION["user"]??null);
    
    #echo 'coucou';

}elseif(Session::isset("user") && in_array($controller,$listesControllers)){
    #dump(in_array($controller,$listesControllers));
    dump("je suis arriver dans header");
 
    if(count($url)>1){
        //cela signifie qu'elle possede une action
        $action=$url[1];

        if(method_exists($controller,$action) && !in_array($action,$Interdit)){
            #dump(session_status()== PHP_SESSION_NONE);
            if(count($url)<3){
                //cela signifie qu'il na pas d'argument
                //on appele la fonction action situer dans le controller supposer ne pas avoir d'argument
                call_user_func(array($controller,$action));
            }else{
                //alors il a des arguments et nous on se limite a 3 arguments dans le get ainsi on s'en arrete la
                $filter=$url[2];
                call_user_func(array($controller,$action),$filter);
            } exit();
        }else{
            $controller = new Controller;
            $controller->setLayout("blank");
            $controller->renderView("404");
            exit();
        }
    }else{
        //Ici il s'agit d'une url sans action alors on le redirige vers sa page concerné
        #$controller->redirectByRole($_SESSION["user"]->getRole()??null);
    }
} $controller = new AuthController;
   $controller->login();


// if(isset($_POST["page"])){
//     $authC= new AuthController();
//     $authC->login();
    
//     die();
// }
// $authC=new AuthController();
// $authC->login();
?>