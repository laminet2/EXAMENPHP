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
<div class=" row mt-3 text-dark">
        <h1>
             Liste Aticles Vente Produit
        </h1> 
</div> 
<div class="card shadow mb-4  " style="margin-top:3rem">
       <div class="card-body">
            <div class="table-responsive ">
                 <table class="table table-bordereless text-center" id="Table" width="100%" cellspacing="0">
                    <thead class="border-none bg-black" style="background:black;">
                         <tr>
                             <th class="text-center text-uppercase">Article Vente </th>


                             <th class="text-center text-uppercase">Quantite</th> 
                             
     
                          </tr>
                    </thead>
                                    
                    <tbody>
                    <?php  foreach($articleVentes as $articleVente): ?>
                         <tr>
                            <td>
                                <?=$articleVente["libelle"] ?>
                            </td>
                            
                            <td>
                                <?= $articleVente["qte"] ?>
                            </td>
                    
                        </tr>
                    <?php endforeach ?> 
                        
                    </tbody>
                </table>
            </div>
        </div>       
</div>
</section>