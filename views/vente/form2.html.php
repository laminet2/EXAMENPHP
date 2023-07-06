<?php use App\Config\Controller;
        use App\Config\Help;
        use App\Config\Session;

        $controller=new Controller;
        $role=Session::getRole();
        if($role==null || !in_array($role,["Admin","ResponsableVente"])){
            
            $controller->redirectByRole(Session::get("user")??null);
        }

?>
<div class="ml-3 ">
	<div class="row ">
        <?php if($errors!=[]): ?>
            <div class="alert alert-danger w-100" role="alert">
                <?=implode("<br>",$errors) ?>
            </div>
        <?php elseif($success!=[]): ?>
            <div class="p-3 mb-2 w-100 bg-success text-white">
                <?= $success ?>
            </div>
        <?php endif ?>   
    </div>
</div>


<div id="booking" class="section">
	<div class="section ">          
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
    <div>
</div>
<!--Bouton annuler vente -->
<div class="row container mb-2">
    <a type="button" role="button" href="<?=BASE_URL?>/VenteController/annulerVente" class="btn btn-danger">
        Annuler Vente <span class="badge badge-light"><i class="fas fa-times-circle"></i></span>
    </a>
</div>

<div class="booking-form p-4">           
    <form class="" action="<?=BASE_URL?>/VenteController/selectArticleVente"  method="Post" >             
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <span class="form-label">Article de Vente Selectionner</span>
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
                                    <span class="form-label">Quantité </span>
                                    <input class="form-test form-control " name="qte" min=1 type="number" value=1>
                                </div>
                            </div>          
                            <div class="form-btn col-md-6  d-flex justify-content-end ">
                               <button type="submit" class="submit-btn btn bleue ml-5">Ajouter <i class="fas fa-plus"></i></button>
                               <a name="" id="disabled" class="submit-btn pt-3 btn vert <?php $panier=Session::get("panier")??[]; echo(isset($panier["articleVente"]) && count($panier["articleVente"])!=0 ? "":"disabled") ?>" href="<?=BASE_URL ?>/VenteController/selectionTerminer" role="button"> Suivant <i class="fas fa-arrow-right"></i></a>
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
                             <th>Prix</th> 
                             <th>Quantite</th> 
                             <th>Montant</th>   
                             <th></th>       
                          </tr>
                    </thead>
                                    
                    <tbody>
                    <?php if(Session::isset("panier") && isset(Session::get("panier")["articleVente"]) ): $panier=Session::get("panier") ?>
                    <?php  foreach($panier["articleVente"] as $articleVente): ?>
                         <tr class="text-align-center">
                            <td>
                                <?= $articleVente[1]->getLibelle() ?>
                            </td>
                            <td>
                                <?= $articleVente[1]->getPrixVente() ?>
                            </td>
                            <td>
                                <?= $articleVente[0] ?>
                            </td>
                            <td>
                                <?= $articleVente[0] * $articleVente[1]->getPrixVente()?>
                            </td>
                            <td>
                                <a name="" id="" class="btn btn-danger" href="<?=BASE_URL?>/VenteController/deleteArticleSelect/articleVente-<?=$articleVente[1]->getId()?>" role="button">Supprimer</a>
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







                    