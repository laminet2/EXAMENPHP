<ul class="navbar-nav backCustom sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <div class="sidebar-brand h-25">

            </div>                
                <div class="sidebar-brand-text  mx-3"><img src="" class="img-fluid  ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt=""></div>
            

            <!-- Divider -->

            <!-- Nav Item - Dashboard -->
            <!--
            <li class="nav-item ">
                
                    <?php use App\Config\Session;
                    use App\Model\ResponsableModel;
                     $user=new ResponsableModel;
                    $user=Session::get("user");
                    ?>
                    
                    <a class="nav-link user-connect dropdown-toggle bg-success text-monospace font-weight-bold text-white" href="#" id="userDropdown" role="button"
                        aria-haspopup="true" data-toggle="modal" data-target="#logoutModal">
                        <?=$user->getNom()." ".$user->getPrenom() ?>
                        <img class="img-profile rounded-circle ml-2   "
                        src= "<?= BASE_URL."/"."public/img/".$user->getPhoto() ?>">
                    </a>

            </li>
                -->

            <!-- Divider -->
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

            

            <!-- Divider -->

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <div class="sidebar-heading">
                Gestion vente
            </div>
            <li class="nav-item">
                <a class="nav-link" href="<?=BASE_URL?>/VenteController/selectClient">
                    <i class="fas fa-save" style=""></i>
                    <span>Enregistrer Vente</span></a>
            </li>

            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.html">Login</a>
                        <a class="collapse-item" href="register.html">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item" href="blank.html">Blank Page</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->


            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li>
            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="utilities-color.html">Colors</a>
                        <a class="collapse-item" href="utilities-border.html">Borders</a>
                        <a class="collapse-item" href="utilities-animation.html">Animations</a>
                        <a class="collapse-item" href="utilities-other.html">Other</a>
                    </div>
                </div>
            </li>


            <!-- Sidebar Toggler (Sidebar) -->
            


</ul>