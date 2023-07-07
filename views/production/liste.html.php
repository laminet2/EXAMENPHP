<?php use App\Config\Controller;
        use App\Config\Help;
        use App\Config\Session;

        $controller=new Controller;
        $role=Session::getRole();
        if($role==null || !in_array($role,["Admin","ResponsableProduction"])){
            
            $controller->redirectByRole(Session::get("user")??null);
        }
?>
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
                                <?=$production->getId()?>
                            </td>
                            
                            <td>
                                <?= $production->getDate() ?>
                            </td>
                            
                            <td>
                                <?=$production->getObservation() ?>
                            </td>    
                            <td class="" >
                                <a name="" id="" class="btn btn-primary" href="<?=BASE_URL?>/ProductionController/index/production-<?=$production->getId() ?>" role="button">Voir <i class="fas fa-plus-circle"></i></a>
                            </td>
                        </tr>
                    <?php endforeach ?> 
                    </tbody>
                </table>
            </div>
        </div>       
</div>
</section>