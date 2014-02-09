<?php
session_start();

$routeLevel = 1;


include_once "../../controller/companyController.php";
include_once "../../controller/frontController.php";
$title = "Companías - SeguMax";


$role = getRoleCode();
$page = getCompanyPage($role);

if($_GET){
	$company = getCompany($_GET['id']);
		if(isset($_GET['id']) && $_SESSION['userData']['role'] == 'company' && $_SESSION['userData']['id']!= $_GET['id'])
		header("location:../login.php?redirect=1");
}else header("location:list.php?message=4");

if(!isset($company)) header("location:list.php?message=4");
$pageTitle= "Ver Companía: ".$company['businessName'];

include_once "../header.php";


?>

		<p></p>
		<div class="row">
			<div class="span6">
				<table class="table table-striped">
					<tr>
						<td><b>Razón Social</b></td>
						<td><? echo $company['businessName']; ?></td>
					</tr>
					<tr>
						<td><b>Nombre del Propietario</b></td>
						<td><? echo $company['propName']; ?></td>
					</tr>
					<tr>
						<td><b>Apellido del Propietario</b></td>
						<td><? echo $company['propSurname']; ?></td>
					</tr>
					<tr>
						<td><b>Dirección</b></td>
						<td><? echo $company['address']; ?></td>
					</tr>
					<tr>
						<td><b>RC</b></td>
						<td><? echo $company['rc']; ?></td>
					</tr>
					<tr>
						<td><b>Impuestos de Cobertura</b></td>
						<td><? echo $company['coverageTax']; ?>%</td>
					</tr>
					<tr>
						<td><b>Comisión al Productor</b></td>
						<td><? echo $company['producerCommission']; ?>%</td>
					</tr>
					<tr>
						<td><b>Descuento</b></td>
						<td><? echo $company['discount']; ?>%</td>
					</tr>
					<tr>
						<td><b>Email</b></td>
						<td><? echo $company['email']; ?></td>
					</tr>
					
				</table>
			</div>
			<div class="span4">
			<div class="well">
				<b>Acciones:</b>
				<p></p>
				<?php if(isAdmin() OR $_SESSION['userData']['role'] == 'company'){ ?>
				<p><a href="edit.php?id=<? echo $company['id'] ?>" class="btn btn-success btn-small">Editar Companía</a>
				<? }
				if(isAdmin()){ ?>
				<a onclick=" return confirm('Está seguro que desea eliminar esta companía?');" href="delete.php?id=<? echo $company['id'] ?>" style="margin-left: 5px" class="btn btn-danger btn-small">Eliminar Companía</a></p>
				<?php } ?>
				<a href="../coverage/list.php?id=<? echo $company['id'] ?>" style="margin-top: 5px" class="btn btn-primary btn-small">Ver coberturas de <? echo $company['businessName'] ?></a>
				<a href="list.php" style="margin-top: 5px" class="btn btn-primary btn-small">Volver a la Lista de Companías</a>
			</div>
		</div>
		</div>

<?php 

include_once "../footer.php";

?>