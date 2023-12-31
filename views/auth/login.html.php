<?php 
	use App\Config\Session;
	use App\Config\Help;
	$errors=[];
	if(Session::isset("errors")){
		$errors=Session::get("errors");
		Session::unset("errors");
		$errors=$errors->firstOfAll();
		#dump($errors);
	}
?>
<body class="img js-fullheight" style="background-image: url(<?=BASE_URL?>/public/img/j-williams-tabzu_kbVs0-unsplash.jpg);">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<img src="<?=BASE_URL?>/public/img/logo.png" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
		      	<h3 class="mb-4 text-center">Se Connecter</h3>
		      	<form action="<?=BASE_URL?>/AuthController/login" class="signin-form needs-validation" method="Post" >
		      		<div class="form-group">
		      			<input type="text" class="form-control <?= Help::errorField($errors,"login")?> " name="login" placeholder="Login" id="validationDefault01" >
						  <div class="invalid-tooltip">
        					<?=  $errors["login"]??"" ?>
      					   </div>
		      		</div>
					  
	            <div class="form-group">
	              <input id="password-field" type="password" name="motDePasse" class="form-control <?=Help::errorField($errors,"motDePasse")?>" placeholder="Mot de Passe" >
	              <span toggle="#password-field" class=" fa fa-fw fa-eye field-icon toggle-password"></span>
				  <div class="invalid-tooltip">
        					<?=  $errors["motDePasse"]??"" ?>
      				</div>
					
	            </div>
				<?php if(isset($errors["user"])): ?>
						<div class="alert alert-danger" role="alert">
							<?=$errors["user"] ?>
						</div>
					<?php endif ?>

					<div class="form-group">
						<button type="submit"  class="btn form-control  btn btn-primary submit px-3">CONNEXION</button>
						
					</div>

				<input type="hidden" name="route" value="AuthController/login" >

	          </form>
	          
		      </div>
				</div>
			</div>
		</div>
	</section>

  <script src="<?=BASE_URL?>/public/js/jquery.min.js"></script>
  <script src="<?=BASE_URL?>/public/js/popper.js"></script>
  <script src="<?=BASE_URL?>/public/js/bootstrap.min.js"></script>
  <script src="<?=BASE_URL?>/public/js/main.js"></script>

</body>