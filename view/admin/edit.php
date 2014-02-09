<?php
session_start();

$routeLevel = 1;

include_once "../../controller/adminController.php";
include_once "../../model/admin.php";
include_once "../../controller/frontController.php";
$title = "Administradores - SeguMax";

if($_SESSION['userData']['role'] != 'admin'){
	header("location:../login.php?redirect=1");
}
$role = getRoleCode();
$page = getPage($role);

if($_POST){
	if(updateAdmin()){
		header("location:list.php?message=3");
	}
	else $message = 2;
}

if($_GET){
	if(isset($_GET['message']))
	$message = $_GET['message'];
	if(isset($_GET['id']))
		$admin = getAdmin($_GET['id']);
	else header("location:list.php?message=4");
}

if(!isset($admin)) header("location:list.php?message=3");



$pageTitle= "Editar Usuario: ".$admin['name']." ".$admin['surname'];


include_once "../header.php";


?>

		<?php if(isset($message)){ ?>
			<div class="alert alert-error"  id="alertBanner">
    				<a class="close" data-dismiss="alert" href="#" onclick="closeDiv('alertBanner');">×</a>	
     			    	<h4 class="alert-heading">El usuario especificado no existe.</h4>		
     		</div>
     	<?php } ?>
		<div class="span6">
			<form action="edit.php" class="form-horizontal" id="addProducerForm" method="post" accept-charset="utf-8">
				<fieldset>
					<input type="hidden" name="id" id="id" value = <?php echo $admin['id'] ?>  />
					<legend>Datos Personales</legend>
					<div class="control-group"><label for="name" class="control-label">Nombre </label><input value="<?php echo $admin['name'] ?>" style="margin-left: 10px" type="text" class="span4" maxlength="25" name="name" required /></div>
					<div class="control-group"><label for="surname" class="control-label">Apellido </label><input value="<?php echo $admin['surname'] ?>"  style="margin-left: 10px" type="text" class="span4" maxlength="50" name="surname" required  /></div>
					<div class="control-group"><label for="dni" class="control-label">DNI </label><input value="<?php echo $admin['dni'] ?>" type="text" style="margin-left: 10px" class="span4" maxlength="8" name="dni" required /></div>
					<div class="control-group"><label for="phone" class="control-label">Teléfono </label><input value="<?php echo $admin['phone'] ?>" style="margin-left: 10px" type="text" class="span4" maxlength="20" name="phone" /></div>
					<div class="control-group"><label for="address" class="control-label">Dirección </label><input value="<?php echo $admin['address'] ?>" style="margin-left: 10px" type="text" class="span4" maxlength="50" name="address" /></div>
				</fieldset>
				<fieldset>
					<div class="control-group"><legend>Datos de Sesión</legend></div>
					<div class="control-group"><label for="email" class="control-label">Email </label><input value="<?php echo $admin['email'] ?>" type="email" style="margin-left: 10px" class="span4" maxlength="30" name="userEmail" id="email" required /></div>
					<div id = "mailError"></div>
					
					<div class="control-group"><label for="changePassword" class="control-label">Cambiar Contraseña </label><input type="checkbox" style="margin-left: 10px" maxlength="30" name="changePassword" id="changePassword" onclick="closeDiv('hidden');" /></div>
					
					<div id="hidden" style="display: none">
						<div class="control-group"><label for="userPassword" class="control-label">Contraseña </label><input type="password" pattern=".{8,}" style="margin-left: 10px" class="span4" maxlength="25" name="userPassword"  />
							     				<span class="help-block" style="margin-left:150px">Mínimo 8 caracteres.</span>

						</div>
						<div class="control-group"><label for="userRetypedPassword" class="control-label">Repita Contraseña</label><input pattern=".{8,}" style="margin-left: 10px" type="password" class="span4" maxlength="25" name="userRetypedPassword" /></div>
					</div>
					
				</fieldset>
				<p></p>
				<div class="formSubmit">
					<input type="submit" class="btn btn-success" value="Guardar Usuario" />
					<input type="button" class="btn btn-danger" value="Cancelar" onclick="history.go(-1)" />
				</div>
			</form>
		</div>
<?php 

include_once "../footer.php";

?>