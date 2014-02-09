<?php
session_start();

$routeLevel = 1;

include_once "../../controller/coverageController.php";
include_once "../../controller/frontController.php";
$title = "Coberturas - SeguMax";
$pageTitle= "Añadir Cobertura";

	if($_SESSION['userData']['role'] != 'company'){
		header("location:../login.php?redirect=1");
	}
	
$role = getRoleCode();
$page = getPage($role);

if($_GET){
	if(isset($_GET['message']))
	$message = $_GET['message'];
}

if($_POST){
	if(addCoverage())
		header("location:list.php?message=1");
	else $message = 2;
}
include_once "../header.php";


?>
		<?php if(isset($message)){ ?>
			<div class="alert alert-error"  id="alertBanner">
    				<a class="close" data-dismiss="alert" href="#" onclick="closeDiv('alertBanner');">×</a>	
     			    	<h4 class="alert-heading">Error al crear la cobertura</h4>		
     		</div>
     	<?php } ?>
		<div class="span6">
			<form action="add.php" class="form-horizontal" id="addCompanyForm" method="post" accept-charset="utf-8">
				<fieldset>
					<legend>Datos de la cobertura</legend>
					<input type="hidden" name="companyId" value=<?php echo $_SESSION['userData']['id'] ?> />
					<div class="control-group"><label for="description" class="control-label">Descripción </label><input style="margin-left: 10px" type="text" class="span4" maxlength="50" name="description" required /></div>
					<div class="control-group"><label for="rate" class="control-label">Tasa (%) </label><input pattern="^(?!0\d)\d{1,2}(\.\d{1,2})?$" style="margin-left: 10px" type="number" class="span4" maxlength="5" name="rate" required  /></div>
				</fieldset>
				<p></p>
				<div class="formSubmit">
					<input type="submit" class="btn btn-success" value="Crear Cobertura" />
					<input type="button" class="btn btn-danger" value="Cancelar" onclick="history.go(-1)" />
				</div>
			</form>
		</div>
<?php 

include_once "../footer.php";

?>