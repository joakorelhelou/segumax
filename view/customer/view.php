<?php
session_start();

$routeLevel = 1;

include_once "../../controller/customerController.php";
include_once "../../controller/frontController.php";

$title = "Clientes - SeguMax";

if($_SESSION['userData']['role'] != 'admin' && $_SESSION['userData']['role'] != 'producer'){
	header("location:../login.php?redirect=1");
}
$role = getRoleCode();
$page = getCustomerPage($role);

if($_GET){
	$customer = getCustomer($_GET['id']);
}else header("location:list.php?message=4");

if(!isset($customer)) header("location:list.php?message=4");
if(!myCustomer($customer) && !isAdmin()) header("location:list.php?message=4");
$pageTitle= "Ver Usuario: ".$customer['name']." ".$customer['surname'];

include_once "../header.php";


?>

		<p></p>
		<div class="row">
			<div class="span6">
				<table class="table table-striped">
					<tr>
						<td><b>Nombre</b></td>
						<td><? echo $customer['name']; ?></td>
					</tr>
					<tr>
						<td><b>Apellido</b></td>
						<td><? echo $customer['surname']; ?></td>
					</tr>
					<tr>
						<td><b>DNI</b></td>
						<td><? echo $customer['dni']; ?></td>
					</tr>
					<tr>
						<td><b>Fecha de Nacimiento</b></td>
						<td><? echo $customer['birthday']; ?></td>
					</tr>
					<tr>
						<td><b>Dirección</b></td>
						<td><? echo $customer['address']; ?></td>
					</tr>
					<tr>
						<td><b>Email</b></td>
						<td><? echo $customer['email']; ?></td>
					</tr>
					<tr>
						<td><b>Teléfono</b></td>
						<td><? echo $customer['phone']; ?></td>
					</tr>
					<tr>
						<td><b>Cuit</b></td>
						<td><? echo $customer['cuit']; ?></td>
					</tr>
					<tr>
						<td><b>Condición Impositiva</b></td>
						<td><? echo getImpositiveCode($customer['taxCondition']); ?></td>
					</tr>
					<tr>
						<td><b>Asociado al Productor</b></td>
						<td><? if(isAdmin()){ ?><a href="../producer/view.php?id=<? echo $customer['producerId'] ?>"><? echo getCustomerProducer($customer['producerId']) ?> </a> <? }else
						 echo getCustomerProducer($customer['producerId']) ?></td>
					</tr>
					
				</table>
			</div>
			<div class="span4">
			<div class="well">
				<b>Acciones:</b>
				<p></p>

				<p><a href="edit.php?id=<? echo $customer['id'] ?>" class="btn btn-success btn-small">Editar Cliente</a>
				<a onclick=" return confirm('Está seguro que desea eliminar este cliente?');" href="delete.php?id=<? echo $customer['id'] ?>" style="margin-left: 5px" class="btn btn-danger btn-small">Eliminar Cliente</a></p>
				<a href="../rfc/list.php?customer=<? echo $customer['id'] ?>" style="margin-top: 5px" class="btn btn-primary btn-small">Ver Historial de Solicitudes</a>
				<a href="list.php" style="margin-top: 5px" class="btn btn-primary btn-small">Volver a la Lista de Clientes</a>
			</div>
		</div>
		</div>

<?php 

include_once "../footer.php";

?>