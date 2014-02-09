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
	$producer = getProducer($_GET['id']);
		if(isset($_GET['id']) && $_SESSION['userData']['role'] == 'producer' && $_SESSION['userData']['id']!= $_GET['id'])
		header("location:../login.php?redirect=1");
}else header("location:list.php?message=4");

if(!isset($producer)) header("location:list.php?message=4");
$pageTitle= "Ver Usuario: ".$producer['name']." ".$producer['surname'];

include_once "../header.php";


?>

		<p></p>
		<div class="row">
			<div class="span6">
				<table class="table table-striped">
					<tr>
						<td><b>Nombre</b></td>
						<td><? echo $producer['name']; ?></td>
					</tr>
					<tr>
						<td><b>Apellido</b></td>
						<td><? echo $producer['surname']; ?></td>
					</tr>
					<tr>
						<td><b>Email</b></td>
						<td><? echo $producer['email']; ?></td>
					</tr>
					<tr>
						<td><b>DNI</b></td>
						<td><? echo $producer['dni']; ?></td>
					</tr>
					<tr>
						<td><b>Telefono</b></td>
						<td><? echo $producer['phone']; ?></td>
					</tr>
					<tr>
						<td><b>Drección</b></td>
						<td><? echo $producer['address']; ?></td>
					</tr>
				</table>
			</div>
			<div class="span4">
			<div class="well">
				<b>Acciones:</b>
				<p></p>
				<p><a href="edit.php?id=<? echo $producer['id'] ?>" class="btn btn-success btn-small">Editar Usuario</a>
			    <? if(isAdmin()){ ?>
				<a onclick=" return confirm('Está seguro que desea eliminar este usuario?');" href="delete.php?id=<? echo $producer['id'] ?>" style="margin-left: 5px" class="btn btn-danger btn-small">Eliminar Usuario</a></p>
				<? } ?>
				<a href="../customer/list.php?id=<? echo $producer['id'] ?>" style="margin-top: 5px" class="btn btn-primary btn-small">Ver Clientes Asociados</a>
				<a href="list.php" style="margin-top: 5px" class="btn btn-primary btn-small">Volver a la Lista de Usarios</a>
			</div>
		</div>
		</div>

<?php 

include_once "../footer.php";

?>