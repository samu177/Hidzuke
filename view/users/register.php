<?php
//file: view/users/register.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$user = $view->getVariable("user");
$view->setVariable("title", "Register");
?>

<div id="signin" class="container">
	<div class="row align-items-center h-100">
		<div class="login">
			<div class="row logo-top">
				<div class="col-6">
					<img src="assets/img/logo.png">
				</div>
				<div class="col-3 offset-2 offset-sm-3">
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
			<form class="login-form" action="index.php?controller=users&amp;action=register" method="POST">
				<div class="form-group">
					<h3 class="underline"><?= i18n("label_signin")?></h3>
				</div>
				<div class="form-group">
					<label for="exampleInputName"><?= i18n("name")?></label>
					<input type="text" class="form-control" id="exampleInputName" name="name" placeholder="<?= i18n("newname")?>" pattern="[A-Za-z]{1,}" title="Solo letras por favor" required>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1"><?= i18n("mail")?></label>
					<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="mail" placeholder="<?= i18n("newmail")?>" required>
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1"><?= i18n("pwd")?></label>
					<input type="password" class="form-control" id="exampleInputPassword1" name="pwd" placeholder="<?= i18n("pwd")?>" required>
				</div>
				<div class="form-group">
					<label for="exampleInputPassword2"><?= i18n("pwdconfirm")?></label>
					<input type="password" class="form-control" id="exampleInputPassword2" name="pwd2" placeholder="<?= i18n("pwd")?>" required>
				</div>
				<button type="submit" class="btn btn-custom-blue btn-login"><?= i18n("accept")?></button>
			</form>
		</div>
	</div>
</div>
