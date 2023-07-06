<?php use App\Config\Controller;
        use App\Config\Help;
        use App\Config\Session;

        $controller=new Controller;
        $role=Session::getRole();
        if($role==null || !in_array($role,["Admin","ResponsableVente"])){
            
            $controller->redirectByRole(Session::get("user")??null);
        }
?>

<div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xxs font-weight-bold  text-success text-uppercase mb-1">
                                        TOTAL PANIER
                                    </div>
                                    <div class="h2 mb-0 font-weight-bold text-danger"><?=$somme ??0 ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
</div>
<!--Bouton annuler vente -->
<div class="row container mb-2">
    <a type="button" role="button" class="btn btn-danger">
        Annuler Vente <span class="badge badge-light"><i class="fas fa-times-circle"></i></span>
    </a>
</div>
<div id="booking" class="section">
	<div class="section ">            
        <div class="booking-form p-4 w-100 ">           
            <form class="" action="<?=BASE_URL?>/ProductionController/selectionTerminer"  method="Post" >             
                    <div class="form-group row w-100  justify-content-between ">
                        <div class="row col-6">
                        <div class="form-outline col-6 ">
                            <span class="form-label">Montant Payer</span>
                            <input type="number" class="w-100 p-0 mt-2 h-50 rounded" name="payement" min=0 max="<?=$somme??0 ?>" id="">
                        </div>
                        <div class="form-outline col-6">
                            <span class="form-label">Observation Vente</span>
                            <textarea class="form-control m-3" id="Observation"  rows="2" maxlength="350" style="height:3rem" ></textarea>
                        </div>
                        
                        </div>
                        
                       
                        <div class="form-btn col-md-6  d-flex justify-content-end ">
                               <button  class="submit-btn btn bleue ml-5">Precedent <i class="fas fa-chevron-left"></i></button>
                               <a name="" type="submit" id="disabled" class="submit-btn pt-3 btn btn-danger" href="<?=BASE_URL ?>/ProductionController/selectionTerminer" role="button"> Enregistrer  <i class="fas fa-save"></i></a>
                            </div>
                    </div>
            </form>
        </div>
    </div>
</div>
<div class="card shadow mb-4">
       <div class="card-body">
            <div class="table-responsive ">
                 <table class="table table-bordered" id="saveProductionTable" width="100%" cellspacing="0">
                    <thead>
                         <tr>
                             <th>Libelle</th>
                             <th>Type</th> 
                             <th>Quantite </th>          
                          </tr>
                    </thead>
                                    
                    <tbody>
                        <?php  foreach($articlesSelectionner as $articleSelectionner): ?>
                            <tr>
                                <td>
                                    <?= $articleSelectionner[1]->getLibelle() ?>
                                </td>
                                <td>
                                    <?= $articleSelectionner[1]->getType()=="articleConf"? "Article de Confection" : "Article de Vente" ?>
                                </td>
                                <td>
                                    <?= $articleSelectionner[0] ?>
                                </td>
                            </tr>
                        <?php endforeach ?> 
                    </tbody>
                </table>
            </div>
        </div>       
</div>