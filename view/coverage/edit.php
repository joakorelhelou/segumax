<?php
session_start();

$routeLevel = 1;


include_once "../../controller/coverageController.php";
include_once "../../controller/frontController.php";
$title = "Coberturas - SeguMax";

if($_SESSION['userData']['role'] != 'company' && $_SESSION['userData']['role'] != 'admin'){
	header("location:../login.php?redirect=1");
}
$role = getRoleCode();
$page = getPage($role);

if($_GET){
	if(isset($_GET['message']))
	$message = $_GET['message'];
	if(isset($_GET['id']))
		$coverage = getCoverage($_GET['id']);
	else header("location:list.php?message=4");
}else header("location:list.php?message=4");
if(!myCoverage($coverage) && !isAdmin()) header("location:list.php?message=4");

if(!isset($coverage)) header("location:list.php?message=4");


if($_POST){
	if(updateCoverage())
		header("location:list.php?message=3");
	else $message = 2;
}

$pageTitle= "Editar Cobertura";

include_once "../header.php";


?>

		<?php if(isset($message)){ ?>
			<div class="alert alert-error"  id="alertBanner">
    				<a class="close" data-dismiss="alert" href="#" onclick="closeDiv('alertBanner');">×</a>	
     			    	<h4 class="alert-heading">La cobertura especificada no existe.</h4>		
     		</div>
     	<?php } ?>
		<div class="span6">
			<form action="edit.php" class="form-horizontal" id="addProducerForm" method="post" accept-charset="utf-8">
				<fieldset>
					<legend>Datos de la cobertura</legend>
					<input type="hidden" name="id" value=<?php echo $_GET['id']; ?> />
					<div class="control-group"><label for="description" class="control-label">Descripción </label><input value="<?php echo $coverage['description'] ?>" style="margin-left: 10px" type="text" class="span4" name="description" required /></div>
					<div class="control-group"><label pattern="^(?!0\d)\d{1,2}(\.\d{1,2})?$" for="rate" class="control-label">Tasa (%) </label><input value="<?php echo $coverage['rate'] ?>" style="margin-left: 10px" type="number" class="span4" maxlength="5" name="rate" required  /></div>
				</fieldset>
				<p></p>
				<div class="formSubmit">
					<input type="submit" class="btn btn-success" value="Guardar Cobertura" />
					<input type="button" class="btn btn-danger" value="Cancelar" onclick="history.go(-1)" />
				</div>
			</form>
		</div>
<?php 

include_once "../footer.php";

?>