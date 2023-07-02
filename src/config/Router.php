<?php 

use App\Config\Controller;
use App\Config\Session;
use App\Controller\ArticleController;
use App\Controller\AuthController;
use App\Controller\ActeurController;
use App\Controller\ProductionController;

#phpinfo();
#echo("coucou");
$Interdit=['getId','getPassword'];
$listesControllers=["AuthController","ActeurController","ArticleController","ProductionController"];
#var_dump($_SESSION);

if(isset($_POST["route"])){

    $url=$_POST["route"];
    $url = explode("/",$url);
    $controller=$url[0];
    

}else{

    $url = $_SERVER["REQUEST_URI"];
    #dump($_GET);
    $url = explode("/",$url);
    #dump($url);

    $url=array_slice($url,2);
    #dump($url);

    $controller=$url[0];
    #dd(Session::isset("user"));
}

#var_dump(session_status()==PHP_SESSION_NONE);

if($controller=="" or $controller=="Perdu"){
    #dd("controller vide");
        
        $controller =new Controller;
        $controller->redirectByRole($_SESSION["user"]??null);
    
    #echo 'coucou';

}elseif(Session::isset("user") && in_array($controller,$listesControllers)){

    #dump(in_array($controller,$listesControllers));
 
    if(count($url)>=1 and count($url)<=3){
        //cela signifie qu'elle possede une action
        $action=$url[1];

        
         $controller= instanceController($controller);
        #dump(method_exists($controller,$action));

        if(method_exists($controller,$action) && !in_array($action,$Interdit)){
            #dump(session_status()== PHP_SESSION_NONE);
            if(count($url)<3){
                //cela signifie qu'il na pas d'argument
                //on appele la fonction action situer dans le controller supposer ne pas avoir d'argument
                call_user_func(array($controller,$action));
            }else{
                //alors il a des arguments et nous on se limite a 3 arguments dans le get ainsi on s'en arrete la
                $filter=$url[2];
                $controller->$action($filter);
                #call_user_func_array(array($controller, $action), array($filter));
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
} 
  $controller = new AuthController;
    
  $controller->login();

  function instanceController($controller){
    switch ($controller) {
        case 'AuthController':
            # code...
            return new AuthController();
        case 'ActeurController':
            return new ActeurController();
        case "ArticleController":
            return new ArticleController();
        case 'ProductionController':
            return new ProductionController();
        default:
            # code...
            break;
    }
  }


// if(isset($_POST["page"])){
//     $authC= new AuthController();
//     $authC->login();
    
//     die();
// }
// $authC=new AuthController();
// $authC->login();
?>