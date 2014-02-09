<?php
session_start();

$routeLevel = 1;


include_once "../../controller/companyController.php";
include_once "../../controller/frontController.php";
$title = "Companías - SeguMax";

	if($_SESSION['userData']['role'] != 'admin' && $_SESSION['userData']['role'] != 'company'){
		header("location:../login.php?redirect=1");
	} 
$role = getRoleCode();
$page = getCompanyPage($role);

if($_GET){
	if(isset($_GET['message']))
	$message = $_GET['message'];
	if(isset($_GET['id']))
		$company = getCompany($_GET['id']);
	else header("location:list.php?message=4");
	
		if(isset($_GET['id']) && $_SESSION['userData']['role'] == 'company' && $_SESSION['userData']['id']!= $_GET['id'])
		header("location:../login.php?redirect=1");
	
}else header("location:list.php?message=4");

if(!isset($company)) header("location:list.php?message=4");

if($_POST){
	if(updateCompany()){
		if($_SESSION['userData']['role'] == 'company')
			header("location:main.php");
		else header("location:list.php?message=3");
	}
	else $message = 2;
}

$pageTitle= "Editar companía: ".$company['businessName'];


include_once "../header.php";


?>

		<?php if(isset($message)){ ?>
			<div class="alert alert-error"  id="alertBanner">
    				<a class="close" data-dismiss="alert" href="#" onclick="closeDiv('alertBanner');">×</a>	
     			    	<h4 class="alert-heading">La companía especificado no existe.</h4>		
     		</div>
     	<?php } ?>
		<div class="span6">
			<form action="edit.php" class="form-horizontal" id="addProducerForm" method="post" accept-charset="utf-8">
				<fieldset>
					<input type="hidden" name="id" id="id" value = <?php echo $company['id'] ?>  />
					<legend>Datos de la Companía</legend>
					<div class="control-group"><label for="propName" class="control-label">Nombre del propietario </label><input value = "<?php echo $company['propName'] ?>" style="margin-left: 10px" type="text" class="span4" maxlength="25" name="propName" required /></div>
					<div class="control-group"><label for="propSurname" class="control-label">Apellido del propietario </label><input value = "<?php echo $company['propSurname'] ?>" style="margin-left: 10px" type="text" class="span4" maxlength="50" name="propSurname" required  /></div>
					<div class="control-group"><label for="address" class="control-label">Dirección de la Companía </label><input  value = "<?php echo $company['address'] ?>" style="margin-left: 10px" type="text" class="span4" maxlength="50" name="address" /></div>
					<div class="control-group"><label for="businessName" class="control-label">Razón Social </label><input type="text" value = "<?php echo $company['businessName'] ?>" style="margin-left: 10px" class="span4" maxlength="50" name="businessName" required /></div>
					<div class="control-group"><label for="rc" class="control-label">RC </label><input readonly="true" value="1500" style="margin-left: 10px" type="text" class="span4" maxlength="20" name="rc" /></div>
					<div class="control-group"><label for="coverageTax" class="control-label">Impuestos de Cobertura </label><input pattern="^(?!0\d)\d{1,2}(\.\d{1,2})?$" value = "<?php echo $company['coverageTax'] ?>"  style="margin-left: 10px" type="number" class="span4" maxlength="50" name="coverageTax" required />
						<span class="help-block" style="margin-left:150px">Porcentaje de impuesto.</span>
					</div>
					<div class="control-group"><label for="producerCommission" class="control-label">Comisión al Proveedor </label><input pattern="^(?!0\d)\d{1,2}(\.\d{1,2})?$" value = "<?php echo $company['producerCommission'] ?>" style="margin-left: 10px" type="number" class="span4" maxlength="50" name="producerCommission" required />
						<span class="help-block" style="margin-left:150px">Porcentaje de comisión al proveedor sobre el total del costo de la cobertura.</span>
					</div>
					<div class="control-group"><label for="discount" class="control-label">Descuento </label><input pattern="^(?!0\d)\d{1,2}(\.\d{1,2})?$" value = "<?php echo $company['discount'] ?>" style="margin-left: 10px" type="number" class="span4" maxlength="50" name="discount" required />
						<span class="help-block" style="margin-left:150px">Porcentaje de descuento conseguido en la cobertura por cada 1% de comisión que el proveedor reduzca.</span>
					</div>
				</fieldset>
				<fieldset>
					<div class="control-group"><legend>Datos de Sesión</legend></div>
					<div class="control-group"><label for="email" class="control-label">Email </label><input value="<?php echo $company['email'] ?>" type="email" style="margin-left: 10px" class="span4" maxlength="30" name="email" id="email" required /></div>
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
					<input type="submit" class="btn btn-success" value="Guardar Companía" />
					<input type="button" class="btn btn-danger" value="Cancelar" onclick="history.go(-1)" />
				</div>
			</form>
		</div>
<?php 

include_once "../footer.php";

?>