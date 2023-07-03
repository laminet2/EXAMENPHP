<?php use App\Config\Controller;
        use App\Config\Help;
        use App\Config\Session;

        $controller=new Controller;
        $role=Session::getRole();
        if($role==null || !in_array($role,["Admin","ResponsableProduction"])){
            
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
        <div class="">
             <a type="button" class="btn btn-primary p-3" role="button" href="<?=BASE_URL?>/ProductionController/add">
            Enregistrer Article Confection Utiliser<span class="badge badge-light"></span>
             </a>
        </div>
        <div class="horizontale-bar bg-primary mt-4 w-25"> </div>
        <div class="">
            <a type="button" class="btn btn-primary p-3" role="button " href="<?=BASE_URL?>/ProductionController/save" >Enregisrer Articles de Vente Produit</a>
        </div>
        <div class="horizontale-bar  mt-4 w-25  border border-primary"> </div>

        <div class="pr-5">
             <button role="button" type="button" class="btn btn-outline-primary p-3" disabled> Enregistrer Production </button>
        </div>	
</div>

<div id="booking" class="section">
	<div class="section ">            
        <div class="booking-form p-4">           
            <form class="" action="<?=BASE_URL?>/ProductionController/save"  method="Post" >             
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                     <span class="form-label">Article de Vente Produite</span>
                                         <select class="form-test form-control" name="articleVenteID"  <?= Help::errorField($errors,"articleVenteID")?> >
                                            <option selected disabled >Selectionner</option>
                                            <?php foreach($articlesVente as $articleVente): ?>
                                            <option value="<?=$articleVente->getId() ?>"><?= $articleVente->getLibelle() ?> </option>
                                            <?php endforeach ?>
                                          </select>
                                        <span class="select-arrow"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <span class="form-label">Quantité Produite</span>
                                    <input class="form-test form-control " name="qte" min=1 type="number" value=1>
                                </div>
                            </div>          
                            <div class="form-btn col-md-6  d-flex justify-content-end ">
                               <button type="submit" class="submit-btn btn bleue ml-5">Ajouter <i class="fas fa-plus"></i></button>
                               <a name="" id="disabled" class="submit-btn pt-3 btn vert <?php echo(Session::isset("articleVenteSelectionner") && count(Session::get("articleVenteSelectionner"))!=0 ? "":"disabled") ?>" href="<?=BASE_URL ?>/ProductionController/selectionTerminer" role="button"> Suivant <i class="fas fa-arrow-right"></i></a>
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
                             <th>Quantite</th> 
                             <th> </th>          
                          </tr>
                    </thead>
                                    
                    <tbody>
                    <?php if(Session::isset("articleVenteSelectionner")): ?>
                    <?php  foreach(Session::get("articleVenteSelectionner") as $articleVente): ?>
                         <tr>
                            <td>
                                <?= $articleVente[1]->getLibelle() ?>
                            </td>
                            <td>
                                <?= $articleVente[0] ?>
                            </td>
                            <td>
                                <a name="" id="" class="btn btn-danger" href="<?=BASE_URL?>/ProductionController/deleteArticleVenteSelect/articleVente-<?=$articleVente[1]->getId()?>" role="button">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach ?> 
                    <?php endif ?>     
                    </tbody>
                </table>
            </div>
        </div>       
</div>
<script>
    let ElementSelect = document.querySelector(#disabled);
    if(ElementSelect.classList.contains("disabled")){
        //verfier la fonction qui ajoute des attributs et non du css
        ElementSelect.disabled = true;
    }

</script>







                    