<?php
session_start();

$routeLevel = 1;
include_once "../../controller/producerController.php";
include_once "../../controller/frontController.php";
$title = "Productores - SeguMax";
$pageTitle= "Añadir Productor";

if($_SESSION['userData']['role'] != 'admin'){
	header("location:../login.php?redirect=1");
}
$role = getRoleCode();
$page = getProducerPage($role);

if($_GET){
	if(isset($_GET['message']))
	$message = $_GET['message'];
}

if($_POST){
	if(addProducer())
		header("location:list.php?message=1");
	else $message = 2;
}
include_once "../header.php";


?>
		<?php if(isset($message)){ ?>
			<div class="alert alert-error"  id="alertBanner">
    				<a class="close" data-dismiss="alert" href="#" onclick="closeDiv('alertBanner');">×</a>	
     			    	<h4 class="alert-heading">Error al crear Usuario</h4>		
						Mail ya registrado o las contraseñas no coinciden. 
     		</div>
     	<?php } ?>
		<div class="span6">
			<form action="add.php" class="form-horizontal" id="addProducerForm" method="post" accept-charset="utf-8">
				<fieldset>
					<legend>Datos Personales</legend>
					<div class="control-group"><label for="userName" class="control-label">Nombre </label><input style="margin-left: 10px" type="text" class="span4" maxlength="25" name="userName" required /></div>
					<div class="control-group"><label for="userLastName" class="control-label">Apellido </label><input style="margin-left: 10px" type="text" class="span4" maxlength="50" name="userLastName" required  /></div>
					<div class="control-group"><label for="userDni" class="control-label">DNI </label><input type="text" style="margin-left: 10px" class="span4" maxlength="8" name="userDni" required /></div>
					<div class="control-group"><label for="userPhone" class="control-label">Teléfono </label><input style="margin-left: 10px" type="text" class="span4" maxlength="20" name="userPhone" /></div>
					<div class="control-group"><label for="userAdress" class="control-label">Dirección </label><input style="margin-left: 10px" type="text" class="span4" maxlength="50" name="userAdress" /></div>
				</fieldset>
				<fieldset>
					<div class="control-group"><legend>Datos de Sesión</legend></div>
					<div class="control-group"><label for="userEmail" class="control-label">Email </label><input type="email" style="margin-left: 10px" class="span4" maxlength="30" name="userEmail" id="userEmail" required /></div>
					<div id = "mailError"></div>
					<div class="control-group"><label for="userPassword" class="control-label">Contraseña </label><input pattern=".{8,}" type="password" style="margin-left: 10px" class="span4" maxlength="25" name="userPassword" required  />
     				<span class="help-block" style="margin-left:150px">Mínimo 8 caracteres.</span>
					</div>
					<div class="control-group"><label for="userRetypedPassword" class="control-label">Repita Contraseña</label><input pattern=".{8,}" style="margin-left: 10px" type="password" class="span4" maxlength="25" name="userRetypedPassword" required  /></div>
				</fieldset>
				<p></p>
				<div class="formSubmit">
					<input type="submit" class="btn btn-success" value="Crear Usuario" />
					<input type="button" class="btn btn-danger" value="Cancelar" onclick="history.go(-1)" />
				</div>
			</form>
		</div>
<?php 

include_once "../footer.php";

?>