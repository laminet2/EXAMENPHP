<?php
    use App\Config\Session;
    use App\Config\Help;
    $errors=[];
    $success=[];
    if(Session::isset("erreurs")){
        $errors=Session::get("erreurs");
    }elseif(Session::isset("success")){
        $success=Session::get("success");
    }

?>
<div id="booking" class="section">
		<div class="section-center">
			<div class="container">
				<div class="row">
					<div class="booking-form">
                    <?php if(count($errors)>0): ?>
						<div class="alert alert-danger" role="alert">
							<?=implode("<br>",$errors) ?>
						</div>
					<?php elseif(count($success)>0): ?>
                        <div class="p-3 mb-2 bg-success text-white">
                            <?= $success ?>
                        </div>
                    <?php endif ?>
						<form action="<?=BASE_URL?>/ArticleController/save" method="Post">
							<div class="form-group">
								<div class="form-checkbox " id="check">
										<input type="radio" class="btn-check  " name="type" id="option1" value="articleVente" autocomplete="off" >
										<label class="btn selected"  for="option1"><i class="fas fa-shopping-cart"></i> Article de Vente</label>

										<input type="radio" class="btn-check" name="type" id="option2" value="articleConf" autocomplete="off" selected>
										<label class="btn btn-primary" for="option2"><i class="fas fa-store"></i> Article de Confection</label>
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
										<input class="form-test form-control <?= Help::errorField($errors,"qteStock")?>" name="qteStock" type="number" value=0>
									</div>
								</div>
                                <div class="col-md-3">
									<div class="form-group">
										<span class="form-label">Categorie</span>
                                        <select class="form-test form-control" name="categorieID" <?= Help::errorField($errors,"categorieID")?> >
											<option selected disabled >Selectionner</option>
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
										<input id="none" class="form-test form-control" type="number" >
									</div>
								</div>
							</div>
							<div class="row container  ">
                                <div class="col-md-6">
                                    <label for="formFile"  class="form-label ">Photo de l'article</label>
                                    <input class="bg-white  mt-2 <?= Help::errorField($errors,"photo")?>" type="file" name="photo" id="formFile ">
                                </div>	
                                <div class="form-btn col-md-6">
										<button class="submit-btn">Enregistrer</button>
								</div>							
							</div>
							
							<input type="hidden" name="route" value="ArticleController/save">
							</div>
						</form>
                        <script>
                            const divVente = document.querySelector("#prixVente")
                            
                            
                            const option1 = document.querySelector("#option1");
                            const option2=document.querySelector("#option2");

                            option1.addEventListener("click", function() {
                                if (divVente.classList.contains("d-none")) {
                                    divVente.classList.remove("d-none");
                                }
                                
                            })
                            option2.addEventListener("click", function() {
                                if (!divVente.classList.contains("d-none")) {
                                        divVente.classList.add("d-none");
                                    }
                                
                            })
                            </script>
					</div>
				</div>
			</div>
		</div>
</div>