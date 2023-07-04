<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top ">

     <!-- Sidebar Toggle (Topbar) -->
      <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle  ml-0">
          <i class="fa fa-bars"></i>
      </button>
       <!-- name du site -->
        <!--
        <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>
        -->
           <!--End name Site-->
        <ul class="navbar-nav ml-auto">
                 
             <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
        <?php use App\Config\Session;
              use App\Model\ResponsableModel;
              $user=new ResponsableModel;
              $user=Session::get("user");
         ?>
        
        <a class="nav-link user-connect dropdown-toggle rounded text-monospace font-weight-bold  rounded" href="#" id="userDropdown" role="button"
            aria-haspopup="true" data-toggle="modal" data-target="#logoutModal">
            <span class="mr-2 d-none d-lg-inline "><?=$user->getNom()." ".$user->getPrenom() ?></span>
            <img class="img-profile rounded-circle"
                  src= "<?= BASE_URL."/"."public/img/".$user->getPhoto() ?>">
        </a> 
        
          <!--          
        <a class="nav-link user-connect dropdown-toggle bg-success " href="#" id="userDropdown" role="button"
            aria-haspopup="true" data-toggle="modal" data-target="#logoutModal">
            <?=$user->getNom()." ".$user->getPrenom() ?>
            <img class="img-profile rounded-circle ml-2   "
                src= "<?= BASE_URL."/"."public/img/".$user->getPhoto() ?>">
        </a> -->
        </li>

        </ul>
</nav>