
<section>
<div class="card shadow mb-4  " style="margin-top:3rem">
       <div class="card-body">
            <div class="table-responsive ">
                 <table class="table table-bordereless text-center" id="listerTable" width="100%" cellspacing="0">
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
                                <?=$production["id"] ?>
                            </td>
                            
                            <td>
                                <?= $production["nom"]." ". $production["prenom"] ?>
                            </td>
                            
                            <td>
                                <?=$production ?>
                            </td>
                            
                            <td>
                                <?= $vente["qteTotale"] ?>
                            </td>
                            <td>
                                <?=$vente["date"] ?>
                            </td>
                            <td>
                                <span class="badge p-2 badge-<?= $vente["statut"]==0?"danger":"success" ?>"><?= $vente["statut"]==0?"Impayer":"Payer" ?> </span>
                            </td>
                            <td class="" >
                                <a name="" id="" class="btn btn-primary" href="<?=BASE_URL?>/VenteController/detail/vente-<?=$vente["id"] ?>" role="button">Voir <i class="fas fa-plus-circle"></i></a>
                            </td>
                        </tr>
                    <?php endforeach ?> 
                        
                    </tbody>
                </table>
            </div>
        </div>       
</div>
</section>