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
						aria-expanded="false"><span class="flag-icon flag-icon-es"></span></button>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="#"><span class="flag-icon flag-icon-es"></span> ESPAÑA</a>
						<a class="dropdown-item" href="#"><span class="flag-icon flag-icon-gb"></span> Ingles</a>
					</div>
				</div>
			</div>
			<form class="login-form" action="index.php?controller=users&amp;action=login" method="POST">
				<div class="form-group">
					<label for="mail">Correo electrónico</label>
					<input type="email" class="form-control" id="mail" aria-describedby="emailHelp" placeholder="Correo electrónico" name="mail" required>
				</div>
				<div class="form-group">
					<label for="pwd">Contraseña</label>
					<input type="password" class="form-control" id="pwd" placeholder="Contraseña" name="pwd" required>
				</div>
				<button type="submit" class="btn btn-custom-blue btn-login">Ingresar</button>
			</form>
			<div class="row text-center">
				<a class="links" href="index.php?controller=users&action=register">Registrarse</a>
			</div>
		</div>
	</div>
</div>
