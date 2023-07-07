<?php 
namespace App\Config;
use App\Config\Session;
use App\Config\Help;

class Controller{
    protected string $layout;
    public function __construct()
    {
        Session::start();
    }
    public function renderView($view,$data=[],$menuDirectory="menu.html.php",$topBarDirectory="topBarBlank.html.php"){

        //Verification si le layout est un blankPage
        if(!is_numeric(stripos($this->layout,"blank"))){

            //Chargement du menu
            ob_start();
            require_once("./../views/inc/$menuDirectory");
            $menu=ob_get_clean();

            //chargement de la topBar
            ob_start();
            require_once "./../views/inc/$topBarDirectory";
            $topBar=ob_get_clean();

        }

        ob_start();
            extract($data);
           
                
                $errors=[];
                $success=[];
                if(Session::isset("erreurs") && !is_array(Session::get("erreurs"))){
                    $errors=Session::get("erreurs");
                    $errors=$errors->firstOfAll();
                    #dump($errors);
                    Session::unset("erreurs");

                }elseif(Session::isset("success")){
                    $success=Session::get("success");
                    Session::unset("success");
                }elseif(Session::isset("erreurs")){
                    $errors=Session::get("erreurs");
                    Session::unset("erreurs");

                }

                
            require_once("./../views/$view.html.php");
        $contentView=ob_get_clean();
        require_once("./../views/layout/$this->layout.html.php");

    }
    public  function redirect(string $path){
        #$encodedUrl = urlencode($path);
        #session_regenerate_id(true);
        if(session_write_close ()){
            #dump("coucou");
            #dump("coucou");
            header("Location:".BASE_URL."/".$path);
        }
        exit();
    }

    public function redirectByRole($user){
        if($user==null){
            $this->redirect("AuthController/login");
        }else{
            $role=$user->getRole();

            switch ($role) {
                case 'Admin':
                    # code...
                    #dd(Session::get("user"));
                    #$this->renderView("acteur/form");
                    
                    $this->redirect("ArticleController/save");
                    break;
                
                case 'ResponsableVente':
                    #code...
                    break;
                case 'ResponsableProduction':
                    break;
            
            }  
        }
    }

    /**
     * Get the value of layout
     */ 
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * Set the value of layout
     *
     * @return  self
     */ 
    public function setLayout($layout)
    {
        $this->layout = $layout;

        return $this;
    }
}
?>