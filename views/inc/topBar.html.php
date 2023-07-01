<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

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
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
            aria-haspopup="true" data-toggle="modal" data-target="#logoutModal">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=Session::get("user")["nom"]." ".Session::get("user")["prenom"] ?></span>
            <img class="img-profile rounded-circle"
                  src= "<?= BASE_URL."/"."public/img/".Session::get("user")["photo"] ?>">
        </a>
        </li>

        </ul>
</nav>