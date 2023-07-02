<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        

        <!-- Custom fonts for this template-->
        <link href="<?=BASE_URL?>/public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="<?=BASE_URL?>/public/css/sb-admin-2.css" rel="stylesheet">

    </head>
    <body id="page-top">
        <!-- Page Wrapper -->
        <?php use App\Config\Session ?>
        <div id="wrapper">
            
        <!-- Sidebar -->
        <?= $menu ?>
        <!-- End of Sidebar -->

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
        </button>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
                <!-- Main Content -->
                <div id="content" >
                
                <!-- Topbar -->
                
                <?= $topBar ?>
                <!-- End of Topbar -->

                <!-- Content -->
                <div class="container-fluid">
                    <!-- Content view --> 
                    <?= $contentView ?>

                </div>       
                <!-- End Content -->
 

                </div>

        </div>

        <!-- End of Topbar -->

         
        </div>
       
        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pret a sortir?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Selectionner Deconnexion si vous souhaiter reellement vous deconnecter</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                        <a class="btn btn-primary" href="<?=BASE_URL?>/AuthController/logout">Deconnexion</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JavaScript-->
        <script src="<?=BASE_URL?>/public/vendor/jquery/jquery.min.js"></script>
        <script src="<?=BASE_URL?>/public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="<?=BASE_URL?>/public/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="<?=BASE_URL?>/public/js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="=<?=BASE_URL?>/public/vendor/chart.js/Chart.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="<?=BASE_URL?>/public/js/demo/chart-area-demo.js"></script>
        <script src="<?=BASE_URL?>/public/js/demo/chart-pie-demo.js"></script>
    </body>
</html>