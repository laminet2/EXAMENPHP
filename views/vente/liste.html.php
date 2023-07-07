<section class="container search bg-danger rounded ">
    <div class="row">
        <h1>
            RECHERCHE AVANCE
        </h1> 
    </div>
    
    <form action="<?=BASE_URL?>/VenteController/index" class="" method="post">
        <div class="row  ">
            <div class="  col-2">
                <div class="form-group">
                    <label for="">Date</label>
                    <input type="date" name="date" id="" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
            </div>
            <div class="col-2 ">
                  <div class="form-group">
                    <label for="">Statut</label>
                    <select class="form-control" name="statut" id="">
                      <option disabled selected>Selectionner</option>
                      <option value="1">Payer</option>
                      <option value="0">Impayer</option>
                    </select>
                  </div>
            </div>

            <div class="col-2">
                <div class="form-group">
                  <label for="">Client</label>
                  <select class="form-control" name="clientID" id="">
                      <option disabled selected>Selectionner</option>
                      <?php foreach($clients as $client): ?>
                        <option value="<?=$client->getId()?>"><?= $client->getNom()." ".$client->getPrenom() ?></option>
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
                 <table class="table table-bordereless text-center" id="listerTable" width="100%" cellspacing="0">
                    <thead class="border-none bg-black" style="background:black;">
                         <tr>
                             <th class="text-center text-uppercase">Vente ID</th>

                             <th class="text-center text-uppercase">Client</th>

                             <th class="text-center text-uppercase">Montant</th> 
                             <th class="text-center text-uppercase">
                                articles
                             </th>

                             <th class="text-center text-uppercase">date</th>
                                     
                             <th class="text-center text-uppercase">Statut</th>  

                             <th class="text-center text-uppercase">Detail</th>    
     
                          </tr>
                    </thead>
                                    
                    <tbody>
                    <?php  foreach($ventes as $vente): ?>
                         <tr>
                            <td>
                                <?=$vente["id"] ?>
                            </td>
                            
                            <td>
                                <?= $vente["nom"]." ". $vente["prenom"] ?>
                            </td>
                            
                            <td>
                                <?=$vente["montant"] ?>
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
                                <a name="" id="" class="btn btn-primary" href="<?=BASE_URL?>/VenteController/index/vente-<?=$vente["id"] ?>" role="button">Voir <i class="fas fa-plus-circle"></i></a>
                            </td>
                        </tr>
                    <?php endforeach ?> 
                        
                    </tbody>
                </table>
            </div>
        </div>       
</div>
</section>