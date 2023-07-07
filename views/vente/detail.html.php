<?php use App\Config\Controller;
        use App\Config\Help;
        use App\Config\Session;

        $controller=new Controller;
        $role=Session::getRole();
        if($role==null || !in_array($role,["Admin","ResponsableVente"])){
            
            $controller->redirectByRole(Session::get("user")??null);
        }
?>
<div class="ml-3 container">
	<div class="row">
        <?php if($errors!=[]): ?>
            <div class="alert alert-danger w-100" role="alert">
                <?=implode("<br>",$errors) ?>
            </div>
        <?php elseif($success!=[]): ?>
            <div class="p-3 mb-2 bg-success w-100 text-white">
                <?= $success ?>
            </div>
        <?php endif ?>   
    </div>
</div>
<div class="container mt-5">
    <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Statut</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$vente->getStatut()==0?"Impayer":"Payer" ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="far fa-eye"></i>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Montant Vente</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$vente->getMontant()?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Montant due</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$vente->getMontant()-$somme?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
            </div>

            <!-- Tasks Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Montant Payer
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= ($somme/$vente->getMontant())*100 ?></div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width:<?= ($somme/$vente->getMontant())*100 ?>%" aria-valuenow="<?= ($somme/$vente->getMontant())*100 ?>" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
            </div>
    </div>
</div>

<div class="row">
        <div class="col-lg-4 pb-5  mt-4">
            <!-- Account Sidebar-->
            <div class="author-card pb-3">
                <div class="author-card-profile">
                    <div class="author-card-avatar"><img src="<?=BASE_URL?>/public/img/<?=$client->getPhoto()==""? "47.jpeg" :$client->getPhoto() ;?>" alt="Daniel Adams">
                    </div>
                    <div class="author-card-details">
                        <h3 class="author-card-name "><?=$client->getNom()." ".$client->getPrenom() ?></h3>
                    </div>
                </div>
            </div>
            <div class="wizard">
                <nav class="list-group list-group-flush ">
                    <li class="list-group-item" href="#">
                        <div class="d-flex justify-content-between align-items-center ">
                            <div>
                            <i class="fas fa-phone-alt"></i>
                           <div class="d-inline-block font-weight-medium text-uppercase"><?=$client->getTelephone() ?></div>
                        </div>
                    </li>
                    <li class="list-group-item " href="#"><i class="fas fa-home"></i> <?=$client->getAddresse() ?></li>
                    <li class="list-group-item" href="#"><i class="fas fa-info-circle"></i><?=$client->getObservation() ?></li>
                    
                </nav>
            </div>
        </div>
        <!-- Profile Settings-->
        <div class="col-lg-8 pb-5 card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive ">
                 <table class="table table-bordered" id="PayementTable" width="100%" cellspacing="0">
                 <thead style="background-color:black,">
                         <tr>
                             <th>Montant</th>
                             <th>Date</th> 
                          </tr>
                    </thead>
                                    
                    <tbody>
                        <?php  foreach($payements as $payement): ?>
                            <tr>
                                <td>
                                    <?= $payement->getMontant() ?>
                                </td>
                                <td>
                                    <?= $payement->getDate() ?>
                                </td>
                                
                            </tr>
                        <?php endforeach ?> 

                    </tbody>
                </table>
            </div>
        </div>       
        </div>
    </div>
</div>
<div class="card shadow mb-4 mt-5">
       <div class="card-body">
            <h1>
                Details Article Acheter
            </h1> 
            <div class="table-responsive ">

                 <table class="table table-bordered" id="detailTable" width="100%" cellspacing="0">
                    <thead  style="background-color:#000">
                         <tr>
                             <th></th>

                             <th>libelle</th>

                             <th>Prix</th> 
                             <th>
                                Quantite
                             </th>

                             <th>Montant</th>
                               

                          </tr>
                    </thead>
                                    
                    <tbody>
                    <?php  foreach($detailVentes as $detailVente): ?>
                         <tr>
                            <td class=" " >
                                <img class="img-profile rounded-circle " style="height:5rem"
                                 src= "<?= BASE_URL."/"."public/img/".$detailVente["photo"] ?>">
                            </td>
                            <td>
                                <?= $detailVente["libelle"] ?>
                            </td>
                            <td>
                                <?= $detailVente["prix"] ?>
                            </td>
                            
                            <td>
                                <?=$detailVente["qte"] ?>
                            </td>
                            
                            <td>
                                <?= $detailVente["qte"]*$detailVente["prix"] ?>
                            </td>
                            
                            
                        </tr>
                    <?php endforeach ?> 
                        
                    </tbody>
                </table>
            </div>
        </div>       
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Enregistrement Payement</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?=BASE_URL?>/VenteController/savePaiement" class="" method="Post">

      <div class="modal-body">
        <div class="row">
            <div class="form-group align-items-center">
                <label for="">Entrer un montant</label>
                <input type="number" name="montant"></input>
                <input type="hidden" name="montantRestant" value="<?=$vente->getMontant()-$somme ?>">
                <input type="hidden" name="articleVenteID" value="<?=$vente->getId()?>">
            </div>
        </div>
      </div>

         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermez</button>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
          
      </div>
      </form>
    </div>
  </div>