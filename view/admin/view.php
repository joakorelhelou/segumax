<?php
session_start();

$routeLevel = 1;


include_once "../../controller/adminController.php";
include_once "../../controller/frontController.php";
$title = "Administradores - SeguMax";

if($_SESSION['userData']['role'] != 'admin'){
	header("location:../login.php?redirect=1");
}
$role = getRoleCode();
$page = getPage($role);

if($_GET){
	$admin = getAdmin($_GET['id']);
}else header("location:list.php?message=4");

if(!isset($admin)) header("location:list.php?message=4");

$pageTitle= "Ver Usuario: ".$admin['name']." ".$admin['surname'];


include_once "../header.php";


?>

		<p></p>
		<div class="row">
			<div class="span6">
				<table class="table table-striped">
					<tr>
						<td><b>Nombre</b></td>
						<td><? echo $admin['name']; ?></td>
					</tr>
					<tr>
						<td><b>Apellido</b></td>
						<td><? echo $admin['surname']; ?></td>
					</tr>
					<tr>
						<td><b>Email</b></td>
						<td><? echo $admin['email']; ?></td>
					</tr>
					<tr>
						<td><b>DNI</b></td>
						<td><? echo $admin['dni']; ?></td>
					</tr>
					<tr>
						<td><b>Telefono</b></td>
						<td><? echo $admin['phone']; ?></td>
					</tr>
					<tr>
						<td><b>Drección</b></td>
						<td><? echo $admin['address']; ?></td>
					</tr>
				</table>
			</div>
			<div class="span4">
			<div class="well">
				<b>Acciones:</b>
				<p></p>
				<p><a href="edit.php?id=<? echo $admin['id'] ?>" class="btn btn-success btn-small">Editar Usuario</a>
				<?php if($admin['id'] != $_SESSION['userData']['id']){ ?>
					<a onclick=" return confirm('Está seguro que desea eliminar este usuario?');" href="delete.php?id=<? echo $admin['id'] ?>" style="margin-left: 5px" class="btn btn-danger btn-small">Eliminar Usuario</a></p>
				<?php } ?>
				<a href="list.php" style="margin-top: 5px" class="btn btn-primary btn-small">Volver a la Lista de Usarios</a>
			</div>
		</div>
		</div>

<?php 

include_once "../footer.php";

?>