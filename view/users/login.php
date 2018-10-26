<?php
//file: view/users/login.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
?>

<div id="login" class="container">
	<div class="row align-items-center h-100">
		<div class="login">
			<div class="row logo ">
				<div class="col-8 col-sm-9">
					<img src="assets/img/logo.png">
				</div>
				<div class="col-3">
					<button class="btn btn-custom-blue btn-flag dropdown-toggle mr-4" type="button" data-toggle="dropdown" aria-haspopup="true"
						aria-expanded="false"><?php
						if($_SESSION['__currentlang__']=="es"){
							echo '<span class="flag-icon flag-icon-es">';
						}else{
							echo '<span class="flag-icon flag-icon-gb">';
						}?></span></button>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="index.php?controller=language&amp;action=change&amp;lang=es"><span class="flag-icon flag-icon-es"></span><?= i18n("esp")?></a>
						<a class="dropdown-item" href="index.php?controller=language&amp;action=change&amp;lang=en"><span class="flag-icon flag-icon-gb"></span><?= i18n("eng")?></a>
					</div>
				</div>
			</div>
			<form class="login-form" action="index.php?controller=users&amp;action=login" method="POST">
				<div class="form-group">
					<label for="mail"><?= i18n("mail")?></label>
					<input type="email" class="form-control" id="mail" aria-describedby="emailHelp" placeholder="<?= i18n("mail")?>" name="mail" required>
				</div>
				<div class="form-group">
					<label for="pwd"><?= i18n("pwd")?></label>
					<input type="password" class="form-control" id="pwd" placeholder="<?= i18n("pwd")?>" name="pwd" required>
				</div>
				<button type="submit" class="btn btn-custom-blue btn-login"><?= i18n("login")?></button>
			</form>
			<div class="row text-center">
				<a class="links" href="index.php?controller=users&action=register"><?= i18n("signin")?></a>
			</div>
		</div>
	</div>
</div>
