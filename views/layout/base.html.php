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
            href="//fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

        <!-- Custom styles for this template-->
        <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
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
        <!-- Bootstrap  JavaScript-->
        <script src="<?=BASE_URL?>/public/vendor/jquery/jquery.min.js"></script>
        <script src="<?=BASE_URL?>/public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        
        <!--  scripts Pour Toutes les pages-->
        <script src="<?=BASE_URL?>/public/js/sb-admin-2.min.js"></script>

        <!-- Datatabless !-->
        <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script>
            $('#myTable').DataTable( {
            language: {
            processing:     "Traitement en cours...",
            search:         "Rechercher&nbsp;:",
            lengthMenu:    "Afficher _MENU_ &eacute;l&eacute;ments",
            info:           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
            infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
            infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
            infoPostFix:    "",
            loadingRecords: "Chargement en cours...",
            zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
            emptyTable:     "Aucune donnée disponible dans le tableau",
            paginate: {
                first:      "Premier",
                previous:   "Pr&eacute;c&eacute;dent",
                next:       "Suivant",
                last:       "Dernier"
            },
            aria: {
                sortAscending:  ": activer pour trier la colonne par ordre croissant",
                sortDescending: ": activer pour trier la colonne par ordre décroissant"
            }
        }
} );
        </script>

        
    </body>
</html>