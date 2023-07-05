<?php use App\Config\Controller;
        use App\Config\Help;
        use App\Config\Session;

        $controller=new Controller;
        $role=Session::getRole();
        if($role==null || !in_array($role,["Admin","ResponsableVente"])){
            
            $controller->redirectByRole(Session::get("user")??null);
        }
?>
<div class="ml-3">
	<div class="row">
        <?php if($errors!=[]): ?>
            <div class="alert alert-danger" role="alert">
                <?=implode("<br>",$errors) ?>
            </div>
        <?php elseif($success!=[]): ?>
            <div class="p-3 mb-2 bg-success text-white">
                <?= $success ?>
            </div>
        <?php endif ?>   
    </div>
</div>
<div class=" container d-flex  justify-content-center p-4 ">        
        <div class="row">
            <h1>
                ETAPE 1 / 3
            </h1>
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

                             <th>Adresse</th>

                             <th>Action</th>       

                          </tr>
                    </thead>
                                    
                    <tbody>
                    <?php  foreach($clients as $client): ?>
                         <tr>
                            <td>
                                <img class="img-profile rounded-circle"
                                 src= "<?= BASE_URL."/"."public/img/".$client->getPhoto() ?>">
                            </td>
                            <td>
                                <?= $client->getId() ?>
                            </td>
                            <td>
                                <?= $client->getNom()." ".$client->getPrenom ?>
                            </td>
                            
                            <td>
                                <?=$client->getAdresse()?>
                            </td>
                            <td>
                                <a name="" id="" class="btn btn-primary" href="<?=BASE_URL?>/VenteController/clientSelect/client-<?=$Client->getId()?>" role="button">Selectionner</a>
                            </td>
                        </tr>
                    <?php endforeach ?> 
                        <tr>
                            <td>
                                1
                            </td>
                            <td>
                                5
                            </td>
                            <td>
                                TRAORE KAMIYA HAMED LAMINE
                            </td>
                            <td>
                                MEDINA RUE 13
                            </td>
                            <td>
                                BUTTON
                            </td>
                        </tr>
                       
                    </tbody>
                </table>
            </div>
        </div>       
</div>








                    