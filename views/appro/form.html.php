<?php use App\Config\Controller;
        use App\Config\Help;
        use App\Config\Session;

        $controller=new Controller;
        $role=Session::getRole();
        if($role==null || !in_array($role,["Admin","ResponsableProduction"])){
            $controller->redirectByRole(Session::get("user")??null);
        }

    // if(!Session::isset("articleConfSelectionner") && $filter!="articleConf"){
    //     dd($filter);

    //     $controller->redirect("ProductionController/add/articleConf");
    //     dump("Aucun Article Selectionner");

    // }

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
            <form class="" action="<?=BASE_URL?>/ProductionController/add/articleConf"  method="Post" >             
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                     <span class="form-label">Article de Confection utiliser</span>
                                         <select class="form-test form-control" name="articleConfID"  <?= Help::errorField($errors,"articleConfID")?> >
                                            <option selected disabled >Selectionner</option>
                                            <?php foreach($articlesConf as $articleConf): ?>
                                            <option value="<?=$articleConf->getId() ?>"><?= $articleConf->getLibelle() ?> </option>
                                            <?php endforeach ?>
                                          </select>
                                          <div class="invalid-tooltip">
        					                    <?=  $errors["categorieID"]??"" ?>
      				                      </div>
                                        <span class="select-arrow"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <span class="form-label">Quantité Utiliser</span>
                                    <input class="form-test form-control " name="qte" min=1 type="number" value=1>
                                </div>
                            </div>          
                            <div class="form-btn col-md-6  d-flex justify-content-end ">
                               <button type="submit" class="submit-btn btn bleue ml-5">Ajouter <i class="fas fa-plus"></i></button>
                               <a name="" id="" class="submit-btn pt-3 btn vert <?php echo(Session::isset("articleConfSelectionner")? "":"disabled") ?>" href="#" role="button" >Suivant <i class="fas fa-chevron-right"></i></a>
                            </div>

                            </form>
                        </div>
                
        </div>
    </div>
</div>
<div class="card shadow mb-4">
       <div class="card-body">
            <div class="table-responsive ">
                 <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                    <thead>
                         <tr>
                             <th>Libelle</th>
                             <th>Quantite</th>               
                          </tr>
                    </thead>
                                    
                    <tbody>
                    <?php if(Session::isset("articleConfSelectionner")): ?>
                    <?php  foreach(Session::get("articleConfSelectionner") as $articleConf): ?>
                         <tr>
                            <td>
                                <?= $articleConf[1]->getLibelle() ?>
                            </td>
                            <td>
                                <?= $articleConf[0] ?>
                            </td>
                        </tr>
                    <?php endforeach ?> 
                    <?php endif ?>     
                    </tbody>
                </table>
            </div>
        </div>       
</div>







                    