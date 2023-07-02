<?php 
use App\Config\Session;
use App\Config\Help;
?>
<div id="booking" class="section">
		<div class="section-center">
			<div class="container">
				<div class="row">
					<div class="booking-form">
                    <?php if($errors!=[]): ?>
						<div class="alert alert-danger" role="alert">
							<?=implode("<br>",$errors) ?>
						</div>
					<?php elseif($success!=[]): ?>
                        <div class="p-3 mb-2 bg-success text-white">
                            <?= $success ?>
                        </div>
                    <?php endif ?>
						<form action="<?=BASE_URL?>/ArticleController/save/article-<?=$filtre?>"  method="Post" enctype="multipart/form-data">
							<div class="form-group">
								
                                <div class="list-group list-group-horizontal">
                                    <a href="<?=BASE_URL?>/ArticleController/save/article-articleConf" id="articleConf" class="list-group-item list-group-item-action active">
                                        <i class="fas fa-store"></i>
                                        Article Confection  
                                    </a>
                                    <a href="<?=BASE_URL?>/ArticleController/save/article-articleVente" id="articleVente" class="list-group-item list-group-item-action ">
                                    <i class="fas fa-shopping-cart"></i>
                                        Article de Vente
                                    </a>
                                    </div>
								
							</div>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<span class="form-label">Libelle</span>
										<input class="form-test form-control <?= Help::errorField($errors,"libelle")?>" name="libelle" type="text" >
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<span class="form-label">Qte stock</span>
										<input class="form-test form-control <?= Help::errorField($errors,"qteStock")?>" name="qteStock" min=0 type="number" value=0>
									</div>
								</div>
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
                                <div class="col-md-3 ">
									<div class="form-group  d-none" id="prixVente">
										<span class="form-label" <?= Help::errorField($errors,"prixVente")?>>Prix Vente</span>
										<input id="" class="form-test form-control" name="prixVente" type="number" min=0>
									</div>
								</div>
							</div>
							<div class="row container  ">
                                <div class="col-md-6">
                                    <label for="formFile"  class="form-label">Photo de l'article</label>
                                    <input class="bg-white  mt-2 <?= Help::errorField($errors,"photo")?>" type="file" name="photo" id="formFile">
                                </div>	
                                <div class="form-btn col-md-6">
										<button class="submit-btn">Enregistrer</button>
								</div>							
							</div>
							
							
							</div>
						</form>
                        <script>
                            const divVente = document.querySelector("#prixVente")
                            
                            
                            const articleVente = document.querySelector("#articleVente");
                            const articleConf=document.querySelector("#articleConf");
                            
                            if(window.location.href=="<?=BASE_URL?>/ArticleController/save/article-articleVente"){
                                if (divVente.classList.contains("d-none")) {
                                    divVente.classList.remove("d-none");
                                }
                                articleConf.classList.remove("active");
                                if(!articleVente.classList.contains("active")){
                                    articleVente.classList.add("active");
                                }
                            }else{
                                if (!divVente.classList.contains("d-none")) {
                                        divVente.classList.add("d-none");
                                    }
                                articleVente.classList.remove("active");
                                if(!articleConf.classList.contains("active")){
                                    articleConf.classList.add("active");
                                }
                                
                                
                            }

                            
                                

                            // articleVente.addEventListener("click", function() {
                                
                                
                            //     window.location.href="/ArticleController/save/article-articleVente";
                                
                            // })

                            
                            </script>
					</div>
				</div>
			</div>
		</div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Creation Categorie</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?=BASE_URL?>/ArticleController/saveCategorie" class="" method="Post">

      <div class="modal-body">
        <div class="row">
            <div class="form-group col-6">
                <label for="">Entrer un libelle</label>
                <input type="text" name="libelle"></input>
            </div>
            <div class="form-group col-6">
              <label for="">Selectionner un type</label>
              <select class="form-control" name="type" id="">
                <option value="articleConf">Confection</option>
                <option value="articleVente">vente</option>
              </select>
            </div>
           
        </div>
      </div>

         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermez</button>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
          
      </div>
      </form>
    </div>
  </div>
  <script>
        const nouveau = document.querySelector("#categorie");
        nouveau.addEventListener("change",function(){
        const elementSelect =this.value;
            if(elementSelect==="nouveau"){
                $('#exampleModalCenter').modal('show');
            }
        })
 </script>
</div>