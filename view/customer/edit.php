<?php
session_start();

$routeLevel = 1;

include_once "../../controller/customerController.php";
include_once "../../controller/frontController.php";
$title = "Clientes - SeguMax";

if($_SESSION['userData']['role'] != 'producer' && $_SESSION['userData']['role'] != 'admin'){
	header("location:../login.php?redirect=1");
}
$role = getRoleCode();
$page = getCustomerPage($role);

if($_GET){
	if(isset($_GET['message']))
	$message = $_GET['message'];
	if(isset($_GET['id']))
		$customer = getCustomer($_GET['id']);
	else header("location:list.php?message=4");
}else header("location:list.php?message=4");
if(!myCustomer($customer) && !isAdmin()) header("location:list.php?message=4");

if(!isset($customer)) header("location:list.php?message=4");


if($_POST){
	if(updateCustomer())
		header("location:list.php?message=3");
	else $message = 2;
}

$pageTitle= "Editar Usuario: ".$customer['name']." ".$customer['surname'];

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
					<legend>Datos del cliente</legend>
					<input type="hidden" name="producerId" value=<?php echo $_SESSION['userData']['id'] ?> />
					<input type="hidden" name="id" value=<?php echo $customer['id'] ?> />

					<div class="control-group"><label for="name" class="control-label">Nombre </label><input value="<? echo $customer['name'] ?>" style="margin-left: 10px" type="text" class="span4" maxlength="25" name="name" required /></div>
					<div class="control-group"><label for="surname" class="control-label">Apellido </label><input value="<? echo $customer['surname'] ?>"  style="margin-left: 10px" type="text" class="span4" maxlength="50" name="surname" required  /></div>
					<div class="control-group"><label for="dni" class="control-label">Dni </label><input value="<? echo $customer['dni'] ?>"  style="margin-left: 10px" type="text" class="span4" maxlength="8" name="dni" required /></div>
					<div class="control-group"><label for="birthday" class="control-label">Fecha de Nacimiento </label><input id="datepicker" value="<? echo $customer['birthday'] ?>"  type="text" style="margin-left: 10px" class="span4" maxlength="50" name="birthday"  /></div>
					<div class="control-group"><label for="address" class="control-label">Dirección </label><input value="<? echo $customer['address'] ?>"   style="margin-left: 10px" type="text" class="span4" maxlength="20" name="address" /></div>
					<div class="control-group"><label for="email" class="control-label">Email </label><input type="email"  value="<? echo $customer['email'] ?>" style="margin-left: 10px" class="span4" maxlength="30" name="email" id="email" required /></div>
					<div class="control-group"><label for="phone" class="control-label">Teléfono </label><input  value="<? echo $customer['phone'] ?>" style="margin-left: 10px" type="text" class="span4" maxlength="50" name="phone"  /></div>
					<div class="control-group"><label for="cuit" class="control-label">Cuit </label><input value="<? echo $customer['cuit'] ?>"  style="margin-left: 10px" type="number" class="span4" maxlength="11" name="cuit" required /></div>
					<div class="control-group"><label for="taxCondition" class="control-label">Condición Impositiva </label>
						<select name="taxCondition" style="margin-left: 10px" class="span4">
						  <option value="1" <? if($customer['taxCondition'] == 1) echo "selected" ?> >Consumidor Final</option>
						  <option value="2" <? if($customer['taxCondition'] == 2) echo "selected" ?>>Monotributo</option>
						  <option value="3" <? if($customer['taxCondition'] == 3) echo "selected" ?>>Responsable Inscripto</option>
						</select>
					</div>
				</fieldset>
				<p></p>
				<div class="formSubmit">
					<input type="submit" class="btn btn-success" value="Guardar Cliente" />
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