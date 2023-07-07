<?php use App\Config\Controller;
        use App\Config\Help;
        use App\Config\Session;

        $controller=new Controller;
        $role=Session::getRole();
        if($role==null || !in_array($role,["Admin","ResponsableProduction"])){
            
            $controller->redirectByRole(Session::get("user")??null);
        }
?>
<section class="container search bg-danger rounded ">
    <div class="row">
        <h1>
            RECHERCHE AVANCE
        </h1> 
    </div>
    
    <form action="<?=BASE_URL?>/ProductionController/index" class="" method="post">
        <div class="row  ">
            <div class="  col-2">
                <div class="form-group">
                    <label for="">Date</label>
                    <input type="date" name="date" id="" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
            </div>
            <div class="col-2 ">
                  <div class="form-group">
                    <label for="">Articles Produits</label>
                    <select class="form-control" name="article.id" id="">
                      <option disabled selected>Selectionner</option>
                      <?php foreach($articleVentes as $article):?>
                        <option value="<?=$article->getId()?>" > <?=$article->getLibelle() ?> </option>
                       <?php endforeach ?>
                    </select>
                  </div>
            </div>

            
            <div class="col-2">
                <div class="form-group">
                        <label for=""></label>
                        <button type="submit" class="btn btn-primary"  style=" margin-top:2rem">RECHERCHER <i class="fas fa-search"></i> </button>
                  </div>
            </div>
            <input type="hidden" name="filtrer" value='true'>
            <div class="col" >

                
            </div>
        </div>
    </form>
    <div class="row recherche-img ">
        <img src="<?=BASE_URL?>/public/img/search.gif" alt="" srcset="">
    </div>
</section>
<section>
<div class="card shadow mb-4  " style="margin-top:3rem">
       <div class="card-body">
            <div class="table-responsive ">
                 <table class="table table-bordereless text-center" id="detailTable" width="100%" cellspacing="0">
                    <thead class="border-none bg-black" style="background:black;">
                         <tr>
                             <th class="text-center text-uppercase">Production ID</th>

                             <th class="text-center text-uppercase">Date</th>

                             <th class="text-center text-uppercase">Observation</th> 

                             <th class="text-center text-uppercase"></th> 
                          </tr>
                    </thead>
                                    
                    <tbody>
                    <?php  foreach($productions as $production): ?>
                         <tr>
                            <td>
                                <?=$production["id"]?>
                            </td>
                            
                            <td>
                                <?= $production["date"] ?>
                            </td>
                            
                            <td>
                                <?=$production["observation"] ?>
                            </td>    
                            <td class="" >
                                <a name="" id="" class="btn btn-primary" href="<?=BASE_URL?>/ProductionController/index/production-<?=$production["id"] ?>" role="button">Voir <i class="fas fa-plus-circle"></i></a>
                            </td>
                        </tr>
                    <?php endforeach ?> 
                    </tbody>
                </table>
            </div>
        </div>       
</div>
</section>