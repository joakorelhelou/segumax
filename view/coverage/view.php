<?php
session_start();

$routeLevel = 1;


include_once "../../controller/coverageController.php";
include_once "../../controller/frontController.php";

$title = "Clientes - SeguMax";

if($_SESSION['userData']['role'] != 'admin' && $_SESSION['userData']['role'] != 'company' && $_SESSION['userData']['role'] != 'producer'){
	header("location:../login.php?redirect=1");
}
$role = getRoleCode();
$page = getPage($role);

if($_GET){
	$coverage = getCoverage($_GET['id']);
}else header("location:list.php?message=4");

if(!isset($coverage)) header("location:list.php?message=4");
if(!myCoverage($coverage) && !isAdmin() && $_SESSION['userData']['role'] != 'producer' ) header("location:list.php?message=4");
$pageTitle= "Ver Cobertura: ".$coverage['description'];

include_once "../header.php";


?>

		<p></p>
		<div class="row">
			<div class="span6">
				<table class="table table-striped">
					<tr>
						<td><b>Descripción:</b></td>
						<td><? echo $coverage['description']; ?></td>
					</tr>
					<tr>
						<td><b>Tasa:</b></td>
						<td><? echo $coverage['rate']; ?>%</td>
					</tr>
					<tr>
						<td><b>Companía:</b></td>
						<td><? if(isAdmin()){ ?><a href="../company/view.php?id=<? echo $coverage['companyId'] ?>"><? echo getCoverageCompany($coverage['companyId']) ?> </a> <? }else
						 echo getCoverageCompany($coverage['companyId']) ?></td>
					</tr>
					
				</table>
			</div>
			<div class="span4">
			<div class="well">
				<b>Acciones:</b>
				<p></p>
				<?php if($_SESSION['userData']['role'] == 'company' OR $_SESSION['userData']['role'] == 'admin'){ ?>
				<p><a href="edit.php?id=<? echo $coverage['id'] ?>" class="btn btn-success btn-small">Editar Cobertura</a>
				<a onclick=" return confirm('Está seguro que desea eliminar esta cobertura?');" href="delete.php?id=<? echo $coverage['id'] ?>" style="margin-left: 5px" class="btn btn-danger btn-small">Eliminar Cobertura</a></p>
				<?php } ?>
				<a href="list.php" style="margin-top: 5px" class="btn btn-primary btn-small">Volver a la Lista de Coberturas</a>
			</div>
		</div>
		</div>

<?php 

include_once "../footer.php";

?>