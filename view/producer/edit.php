<?php
session_start();

$routeLevel = 1;

include_once "../../controller/producerController.php";
include_once "../../controller/frontController.php";
$title = "Productores - SeguMax";

if($_SESSION['userData']['role'] != 'admin' && $_SESSION['userData']['role'] != 'producer'){
	header("location:../login.php?redirect=1");
}


$role = getRoleCode();
$page = getProducerPage($role);

if($_GET){
	if(isset($_GET['message']))
	$message = $_GET['message'];
	if(isset($_GET['id']))
		$producer = getProducer($_GET['id']);
	else header("location:list.php?message=4");

	if(isset($_GET['id']) && $_SESSION['userData']['role'] == 'producer' && $_SESSION['userData']['id']!= $_GET['id'])
		header("location:../login.php?redirect=1");
}else header("location:list.php?message=4");

if(!isset($producer)) header("location:list.php?message=4");

if($_POST){
	if(updateProducer())
		header("location:list.php?message=3");
	else $message = 2;
}
$pageTitle= "Editar Usuario: ".$producer['name']." ".$producer['surname'];

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
					<input type="hidden" name="id" id="id" value = <?php echo $producer['id'] ?>  />
					<legend>Datos Personales</legend>
					<div class="control-group"><label for="userName" class="control-label">Nombre </label><input value="<?php echo $producer['name'] ?>" style="margin-left: 10px" type="text" class="span4" maxlength="25" name="userName" required /></div>
					<div class="control-group"><label for="userLastName" class="control-label">Apellido </label><input value="<?php echo $producer['surname'] ?>"  style="margin-left: 10px" type="text" class="span4" maxlength="50" name="userLastName" required  /></div>
					<div class="control-group"><label for="userDni" class="control-label">DNI </label><input value="<?php echo $producer['dni'] ?>" type="text" style="margin-left: 10px" class="span4" maxlength="8" name="userDni" required /></div>
					<div class="control-group"><label for="userPhone" class="control-label">Teléfono </label><input value="<?php echo $producer['phone'] ?>" style="margin-left: 10px" type="text" class="span4" maxlength="20" name="userPhone" /></div>
					<div class="control-group"><label for="userAdress" class="control-label">Dirección </label><input value="<?php echo $producer['address'] ?>" style="margin-left: 10px" type="text" class="span4" maxlength="50" name="userAdress" /></div>
				</fieldset>
				<fieldset>
					<div class="control-group"><legend>Datos de Sesión</legend></div>
					<div class="control-group"><label for="userEmail" class="control-label">Email </label><input value="<?php echo $producer['email'] ?>" type="email" style="margin-left: 10px" class="span4" maxlength="30" name="userEmail" id="userEmail" required /></div>
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