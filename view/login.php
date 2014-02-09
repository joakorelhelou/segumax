<?php

session_start();
include_once "../controller/frontController.php";
include_once "../model/user.php";
$title = "SeguMax - El mejor seguro para tu auto!";
$pageTitle = "Portal de Seguros Segumax";
$role = 0;
$page = 1;
include_once "header.php";

if($_POST){
	$error = logUser(sanitize($_POST['userName']), sanitize($_POST['userPassword']));
}

if($_GET){
	if(isset($_GET['logout'])){		
		session_destroy();
			
	}
	 $error = getError();
}

?>

 
<div class="container">
	<div class="span8">
		<?php if(isset($error)){
		if($error == 0){ ?>
			<div class="alert alert-error"  id="alertBanner">
    			<a class="close" data-dismiss="alert" href="#" onclick="closeDiv('alertBanner');">×</a>
    			<h4 class="alert-heading">Error!</h4>
   				 Email o contraseña invalidos.
  			</div>		
		 <?php	}elseif($error == 1){ ?>
				<div class="alert alert-success"  id="alertBanner">
	    				<a class="close" data-dismiss="alert" href="#" onclick="closeDiv('alertBanner');">×</a>
	    				<h4 class="alert-heading">Nos vemos pronto!</h4>
	   				 Ha cerrado sesión.
	  			    </div> <?php
		}elseif($error == 2){ ?>
				<div class="alert alert-error"  id="alertBanner">
	    			<a class="close" data-dismiss="alert" href="#" onclick="closeDiv('alertBanner');">×</a>
	    			<h4 class="alert-heading">Error!</h4>
	   				 Acceso no autorizado, por favor ingrese sus datos.
	  			</div>
		<?php }
		} ?>
		<h1>Bienvenido a SeguMax!</h1>
			<h3>Encuentre el mejor seguro para su Automovil!</h3>
			<p>
				SeguMax tiene como visión brindar asesoramiento profesional, en lo que respecta a la exposición a riesgos que tienen los activos de nuestros asegurados, basándose en su experiencia y profesionalismo, brindándole la mayor tranquilidad y una alta calidad de servicio.
			</p>
			<hr />
		</div>
	<div class="span4">
		<div class="well">
			<p><h3>Iniciar Sesión</h3></p>
			<form id="loginForm" action="login.php" method="post">
				<label>Dirección de Email</label>
				<input type="text" name="userName" id="userName" />
				<label>Contraseña</label>
				<input type="password" name="userPassword" id="userPassword" />
				<p><input class="btn btn-primary" type="submit" value="Iniciar" /></p>
				
			</form>
		</div>	
		
	</div>
</div>

<?php

include_once "footer.php";


?>