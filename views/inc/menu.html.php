<ul class="navbar-nav backCustom sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <div class="sidebar-brand " style="height:9rem">
            <div class="sidebar-brand-text  mx-3">
                <img src="" class="img-fluid  ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
            </div>
            </div>                
            
            

            <!-- Divider -->

            <!-- Nav Item - Dashboard -->
           
            <li class="nav-item li-user" style="backdrop-filter: blur(50px)"  >
                
                    <?php use App\Config\Session;
                    use App\Config\Controller;
                    use App\Config\Help;
                    use App\Model\ResponsableModel;
                     $user=new ResponsableModel;
                    $user=Session::get("user");
                    ?>
                    
                    <a class="nav-link user-connect dropdown-toggle  text-monospace font-weight-bold text-white"   href="<?=BASE_URL?>/AuthController/logout"  role="button"
                       >
                        <?=$user->getNom()." ".$user->getPrenom() ?>
                        <img class="img-profile rounded-circle ml-2   "
                        src= "<?= BASE_URL."/"."public/img/".$user->getPhoto() ?>">
                    </a>

            </li>
                

            <!-- Divider -->
            <?php 
                
                $controller=new Controller;
                $role=Session::getRole();
            ?>
            <?php if($role!==null && in_array($role,["Admin","ResponsableStock"])): ?>
                
            
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Gestion Article
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item ">
                <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-save" style=""></i>
                    <span>Enregistrer un article</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Choix de l'article:</h6>
                        <a class="collapse-item" href="<?=BASE_URL?>/ArticleController/save/article-articleConf">Confection</a>
                        <a class="collapse-item" href="<?=BASE_URL?>/ArticleController/save/article-articleVente">Vente</a>
                    </div>
                </div>
            </li>
            <?php endif ?>
            <?php if($role!==null && in_array($role,["Admin","ResponsableProduction"])): ?>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Gestion Production
            </div>

            <li class="nav-item">
                <a class="nav-link" href="<?=BASE_URL?>/ProductionController/add">
                     <i class="fas fa-save" style=""></i>
                    <span>Enregistrer une production</span></a>
            </li>

            
            <?php endif ?>

            <!-- Divider -->

            <!-- Divider -->
            <?php if($role!==null && in_array($role,["Admin","ResponsableVente"])): ?>

            <hr class="sidebar-divider d-none d-md-block">

            <div class="sidebar-heading">
                Gestion vente
            </div>
            <li class="nav-item">
                <a class="nav-link" href="<?=BASE_URL?>/VenteController/selectClient">
                    <i class="fas fa-save" style=""></i>
                    <span>Enregistrer Vente</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=BASE_URL?>/VenteController/index">
                <i class="fas fa-list"></i>              
                <span>Lister Vente</span></a>
            </li>

            <hr class="sidebar-divider">

            <!-- Heading -->
            
            <!-- Sidebar Toggler (Sidebar) -->
            <?php endif ?>

            


</ul>