<?php
session_start();

$routeLevel = 1;

include_once "../../controller/customerController.php";
include_once "../../controller/frontController.php";
$title = "Productores - SeguMax";
$pageTitle= "Añadir Cliente";

	if($_SESSION['userData']['role'] != 'producer'){
		header("location:../login.php?redirect=1");
	}
	
$role = getRoleCode();
$page = getCustomerPage($role);

if($_GET){
	if(isset($_GET['message']))
	$message = $_GET['message'];
}

if($_POST){
	if(addCustomer())
		header("location:list.php?message=1");
	else $message = 2;
}
include_once "../header.php";


?>
		<?php if(isset($message)){ ?>
			<div class="alert alert-error"  id="alertBanner">
    				<a class="close" data-dismiss="alert" href="#" onclick="closeDiv('alertBanner');">×</a>	
     			    	<h4 class="alert-heading">Error al crear el cliente</h4>		
     		</div>
     	<?php } ?>
		<div class="span6">
			<form action="add.php" class="form-horizontal" id="addCompanyForm" method="post" accept-charset="utf-8">
				<fieldset>
					<legend>Datos del cliente</legend>
					<input type="hidden" name="producerId" value=<?php echo $_SESSION['userData']['id'] ?> />
					<div class="control-group"><label for="name" class="control-label">Nombre </label><input style="margin-left: 10px" type="text" class="span4" maxlength="25" name="name" required /></div>
					<div class="control-group"><label for="surname" class="control-label">Apellido </label><input style="margin-left: 10px" type="text" class="span4" maxlength="50" name="surname" required  /></div>
					<div class="control-group"><label for="dni" class="control-label">Dni </label><input style="margin-left: 10px" type="text" class="span4" maxlength="8" name="dni" required /></div>
					<div class="control-group"><label for="birthday" class="control-label">Fecha de Nacimiento </label><input id="datepicker" type="text" style="margin-left: 10px" class="span4" maxlength="50" name="birthday"  /></div>
					<div class="control-group"><label for="address" class="control-label">Dirección </label><input  style="margin-left: 10px" type="text" class="span4" maxlength="20" name="address" /></div>
					<div class="control-group"><label for="email" class="control-label">Email </label><input type="email" style="margin-left: 10px" class="span4" maxlength="30" name="email" id="email" required /></div>
					<div class="control-group"><label for="phone" class="control-label">Teléfono </label><input style="margin-left: 10px" type="text" class="span4" maxlength="50" name="phone"  /></div>
					<div class="control-group"><label for="cuit" class="control-label">Cuit </label><input style="margin-left: 10px" type="number" class="span4" maxlength="11" name="cuit" required /></div>
					<div class="control-group"><label for="taxCondition" class="control-label">Condición Impositiva </label>
						<select name="taxCondition" style="margin-left: 10px" class="span4">
						  <option value="1">Consumidor Final</option>
						  <option value="2">Monotributo</option>
						  <option value="3">Responsable Inscripto</option>
						</select>
					</div>
				</fieldset>
				<p></p>
				<div class="formSubmit">
					<input type="submit" class="btn btn-success" value="Crear Cliente" />
					<input type="button" class="btn btn-danger" value="Cancelar" onclick="history.go(-1)" />
				</div>
			</form>
		</div>
<?php 

include_once "../footer.php";

?>
<script>
$(function() {
$( "#datepicker" ).datepicker({ dateFormat: "yy-mm-dd" });
});
</script>