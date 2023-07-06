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

   

<div class="card shadow mb-4">
       <div class="card-body">
            <div class="table-responsive ">
                 <table class="table table-bordered" id="saveVenteTable" width="100%" cellspacing="0">
                    <thead>
                         <tr>
                             <th></th>

                             <th>id</th>

                             <th>Nom & Prenom</th> 
                             <th>
                                Telephone
                             </th>

                             <th>Adresse</th>
                             <th>Observation</th>            
                             <th>Action</th>       

                          </tr>
                    </thead>
                                    
                    <tbody>
                    <?php  foreach($clients as $client): ?>
                         <tr>
                            <td class=" " >
                                <img class="img-profile rounded-circle " style="height:5rem"
                                 src= "<?= BASE_URL."/"."public/img/".$client->getPhoto() ?>">
                            </td>
                            <td>
                                <?= $client->getId() ?>
                            </td>
                            <td>
                                <?= $client->getNom()." ". $client->getPrenom() ?>
                            </td>
                            
                            <td>
                                <?=$client->getTelephone() ?>
                            </td>
                            
                            <td>
                                <?= $client->getAddresse() ?>
                            </td>
                            <td>
                                <?=$client->getObservation() ?>
                            </td>
                            <td class="" >
                                <a name="" id="" class="btn btn-primary" href="<?=BASE_URL?>/VenteController/selectClient/client-<?=$client->getId() ?>" role="button">Selectionner <i class="fas fa-external-link-alt"></i></a>
                            </td>
                        </tr>
                    <?php endforeach ?> 
                        
                    </tbody>
                </table>
            </div>
        </div>       
</div>
<!-- Modal -->
<div class="modal fade" id="ModalSaveClientSinceVente" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Enregistrer Client</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="booking-form">
        <form action="<?=BASE_URL?>/VenteController/saveClient" method="post" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="row">
                        
                     <div class=" form-group col-6 ">
                            <label for="nom">Nom</label>
                            <input type="text" name="nom" id="nom">
                     </div>
                     <div class="form-group col-6 ">
                            <label for="prenom">Prenom</label>
                            <input type="text" name="prenom" id="prenom">
                     </div> 
                </div>
                <div class="row">
                        
                        <div class="form-group col-6 ">
                               <label for="tel">Telephone</label>
                               <input type="text" name="telephone" id="tel">
                        </div>
                        <div class="form-group col-6 ">
                               <label for="adresse">Adresse</label>
                               <input type="text" name="addresse" id="adresse">
                        </div> 
                </div>
                <div class="row w-100 ">
                    <div class="form-group col-12 ">
                        <label for="observation">Observation</label> <br>
                        <textarea name="observation" class="w-100" id="observation" cols="12" rows="3"></textarea>
                    </div>
                </div>

                <div class="row">
                    <label for="photo"></label>
                    <input type="file" name="photo" id="photo">
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>
    </div>
  </div>
</div>








                    