<?php
session_start();

$routeLevel = 1;

include_once "../../controller/rfcController.php";
include_once "../../controller/frontController.php";

$title = "Solicitudes - SeguMax";

if($_SESSION['userData']['role'] != 'company'){
	header("location:../login.php?redirect=1");
}
$role = getRoleCode();
$page = getRfcPage($role);

if($_GET){
	$rfc = getRfc($_GET['id']);
}elseif($_POST){
		confirmRfc();
		header("location:list.php?message=5");
}else header("location:list.php?message=4");
if(!isset($rfc)) header("location:list.php?message=5");
$pageTitle= "Confirmar Solicitud de ".getRfcCustomer($rfc['customerId']);

include_once "../header.php";


?>

			<div class="span6">
			<form action="confirm.php" class="form-horizontal" id="addCompanyForm" method="post" accept-charset="utf-8">
				<fieldset>		
					<input type="hidden" name="id" value="<? echo $rfc['id'] ?>" />			
					<div class="control-group"><label for="comment" class="control-label">Comentarios: </label><textarea style="margin-left: 10px" rows="4" cols="50"  class="span4"  name="comment" required ></textarea></div>
				</fieldset>	
				<p></p>
				<div class="formSubmit">
					<input id="send" type="submit" class="btn btn-success" value="Aceptar Solicitud " />
					<input type="button" class="btn btn-danger" value="Cancelar" onclick="history.go(-1)" />
				</div>
			</form>
		</div> 

<?php 

include_once "../footer.php";

?>