<?php use App\Config\Help;
        use App\Config\Session;
?>
<div class="container">
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

<div id="booking" class="section">
	<div class="section ">            
        <div class="booking-form p-4">           
            <form class="" action="<?=BASE_URL?>/ArticleController/save/article-"  method="Post" enctype="multipart/form-data">             
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                     <span class="form-label">Categorie</span>
                                         <select class="form-test form-control" name="categorieID" id="categorie" <?= Help::errorField($errors,"categorieID")?> >
                                            <option selected disabled >Selectionner</option>
                                            <option value="nouveau" >Nouveau ...</option>
                                            <?php foreach($categories as $categorie): ?>
                                             <option value="<?=$categorie->getId() ?>"><?= $categorie->getLibelle() ?> </option>
                                            <?php endforeach ?>
                                          </select>
                                        <span class="select-arrow"></span>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <span class="form-label">Qte stock</span>
                                    <input class="form-test form-control <?= Help::errorField($errors,"qteStock")?>" name="qteStock" min=0 type="number" value=0>
                                </div>
                            </div>
                                        
                            <div class="form-btn col-md-6  d-flex justify-content-end ">

                               <button class="submit-btn btn bleue ml-5">Ajouter</button>
                               <button class="submit-btn btn ml-3 mr-0 vert" disabled>Suivant</button>

                            </div>
                    
                        </div>
                </form>
        </div>
    </div>
</div>






                    