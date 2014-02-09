<?php
session_start();

$routeLevel = 1;


include_once "../../controller/companyController.php";
include_once "../../controller/frontController.php";
$title = "Productores - SeguMax";
$pageTitle= "Añadir Companía";

	if($_SESSION['userData']['role'] != 'admin'){
		header("location:../login.php?redirect=1");
	} 
$role = getRoleCode();
$page = getCompanyPage($role);

if($_GET){
	if(isset($_GET['message']))
	$message = $_GET['message'];
}

if($_POST){
	if(addCompany())
		header("location:list.php?message=1");
	else $message = 2;
}
include_once "../header.php";


?>
		<?php if(isset($message)){ ?>
			<div class="alert alert-error"  id="alertBanner">
    				<a class="close" data-dismiss="alert" href="#" onclick="closeDiv('alertBanner');">×</a>	
     			    	<h4 class="alert-heading">Error al crear Companía</h4>
     			    	Email ya registrado o las contraseñas no coinciden. Revise los datos.		
     		</div>
     	<?php } ?>
		<div class="span6">
			<form action="add.php" class="form-horizontal" id="addCompanyForm" method="post" accept-charset="utf-8">
				<fieldset>
					<legend>Datos de la Companía</legend>
					<div class="control-group"><label for="propName" class="control-label">Nombre del propietario </label><input style="margin-left: 10px" type="text" class="span4" maxlength="25" name="propName" required /></div>
					<div class="control-group"><label for="propSurname" class="control-label">Apellido del propietario </label><input style="margin-left: 10px" type="text" class="span4" maxlength="50" name="propSurname" required  /></div>
					<div class="control-group"><label for="address" class="control-label">Dirección de la Companía </label><input style="margin-left: 10px" type="text" class="span4" maxlength="50" name="address" /></div>
					<div class="control-group"><label for="businessName" class="control-label">Razón Social </label><input type="text" style="margin-left: 10px" class="span4" maxlength="50" name="businessName" required /></div>
					<div class="control-group"><label for="rc" class="control-label">RC </label><input readonly="true" value="1500" style="margin-left: 10px" type="text" class="span4" maxlength="20" name="rc" /></div>
					<div class="control-group"><label for="coverageTax" class="control-label">Impuestos de Cobertura </label><input style="margin-left: 10px" pattern="^(?!0\d)\d{1,2}(\.\d{1,2})?$" type="number" class="span4" maxlength="50" name="coverageTax" required />
						<span class="help-block" style="margin-left:150px">Porcentaje de impuesto. Número de dos cifras.</span>
					</div>
					<div class="control-group"><label for="producerCommission" class="control-label">Comisión al Proveedor </label><input style="margin-left: 10px" pattern="^(?!0\d)\d{1,2}(\.\d{1,2})?$" type="number" class="span4" maxlength="50" name="producerCommission" required />
						<span class="help-block" style="margin-left:150px">Porcentaje de comisión al proveedor sobre el total del costo de la cobertura. Número de dos cifras.</span>
					</div>
					<div class="control-group"><label for="discount" class="control-label">Descuento </label><input style="margin-left: 10px" pattern="^(?!0\d)\d{1,2}(\.\d{1,2})?$" type="number" class="span4" maxlength="50" name="discount" required />
						<span class="help-block" style="margin-left:150px">Porcentaje de descuento conseguido en la cobertura por cada 1% de comisión que el proveedor reduzca. Número de dos cifras.</span>
					</div>
				</fieldset>
				<fieldset>
					<div class="control-group"><legend>Datos de Sesión</legend></div>
					<div class="control-group"><label for="email" class="control-label">Email </label><input type="email" style="margin-left: 10px" class="span4" maxlength="30" name="email" id="email" required /></div>
					<div id = "mailError"></div>
					<div class="control-group"><label for="userPassword" class="control-label">Contraseña </label><input pattern=".{8,}" type="password" style="margin-left: 10px" class="span4" maxlength="25" name="userPassword" required  />
     				<span class="help-block" style="margin-left:150px">Mínimo 8 caracteres.</span>
					</div>
					<div class="control-group"><label for="userRetypedPassword" class="control-label">Repita Contraseña</label><input pattern=".{8,}" style="margin-left: 10px" type="password" class="span4" maxlength="25" name="userRetypedPassword" required  /></div>
				</fieldset>
				<p></p>
				<div class="formSubmit">
					<input type="submit" class="btn btn-success" value="Crear Companía" />
					<input type="button" class="btn btn-danger" value="Cancelar" onclick="history.go(-1)" />
				</div>
			</form>
		</div>
<?php 

include_once "../footer.php";

?>