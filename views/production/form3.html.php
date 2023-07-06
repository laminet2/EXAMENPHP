<?php use App\Config\Controller;
        use App\Config\Help;
        use App\Config\Session;

        $controller=new Controller;
        $role=Session::getRole();
        if($role==null || !in_array($role,["Admin","ResponsableProduction"])){
            
            $controller->redirectByRole(Session::get("user")??null);
        }
?>
<div class=" container d-flex  justify-content-center p-4 ">        
        <div class="">
             <a type="button" class="btn btn-primary p-3" role="button" href="<?=BASE_URL?>/ProductionController/add">
               Enregistrer Article Confection Utiliser<span class="badge badge-light"></span>
             </a>
        </div>
        <div class="horizontale-bar bg-primary mt-4 w-25"> </div>
        <div class="">
            <a type="button" class="btn btn-primary p-3" role="button " href="<?=BASE_URL?>/ProductionController/save" >Enregisrer Articles de Vente Produit</a>
        </div>
        <div class="horizontale-bar  mt-4 w-25 bg-primary"> </div>

        <div class="pr-5">
             <a role="button" type="button" class="btn btn-primary p-3" href="<?=BASE_URL?>/ProductionController/selectionTerminer"> Enregistrer Production</a>
        </div>	
</div>

<div id="booking" class="section">
	<div class="section ">            
        <div class="booking-form p-4">           
            <form class="" action="<?=BASE_URL?>/ProductionController/selectionTerminer"  method="Post" >             
                    <div class="form-group row">
                        <div class="form-outline col-4">
                            <span class="form-label">Observation</span>
                            <textarea class="form-control m-3" id="Observation" rows="4" maxlength="350" ></textarea>
                        </div>
                        <div class="offset-2 form-btn col-md-6 mt-5 d-flex justify-content-end ">
                            <button type="submit" class="submit-btn btn ml-5" name="save" >ENREGISTRER <i class="fas fa-save"></i> </button>
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