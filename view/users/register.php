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
						aria-expanded="false"><span class="flag-icon flag-icon-es"></span></button>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="#"><span class="flag-icon flag-icon-es"></span> ESPAÑA</a>
						<a class="dropdown-item" href="#"><span class="flag-icon flag-icon-gb"></span> Ingles</a>
					</div>
				</div>
			</div>
			<form class="login-form" action="index.php?controller=users&amp;action=register" method="POST">
				<div class="form-group">
					<h3 class="underline">Datos de registro:</h3>
				</div>
				<div class="form-group">
					<label for="exampleInputName">Nombre</label>
					<input type="text" class="form-control" id="exampleInputName" name="name" placeholder="Insertar nombre" required>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Correo electrónico</label>
					<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="mail" placeholder="Insertar correo electrónico" required>
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">Contraseña</label>
					<input type="password" class="form-control" id="exampleInputPassword1" name="pwd" placeholder="Contraseña" required>
				</div>
				<div class="form-group">
					<label for="exampleInputPassword2">Confirmar Contraseña</label>
					<input type="password" class="form-control" id="exampleInputPassword2" name="pwd2" placeholder="Contraseña" required>
				</div>
				<button type="submit" class="btn btn-custom-blue btn-login">Aceptar</button>
			</form>
		</div>
	</div>
</div>
