<?php
session_start();

$routeLevel = 1;

include_once "../../controller/rfcController.php";
include_once "../../controller/frontController.php";

$title = "Solicitudes - SeguMax";

if($_SESSION['userData']['role'] != 'admin' && $_SESSION['userData']['role'] != 'producer' && $_SESSION['userData']['role'] != 'company'){
	header("location:../login.php?redirect=1");
}
$role = getRoleCode();
$page = getRfcPage($role);

if($_GET){
	$rfc = getRfc($_GET['id']);
}else header("location:list.php?message=4");

if(!isset($rfc)) header("location:list.php?message=4");
if(!myRfc($rfc) && !isAdmin()) header("location:list.php?message=4");
$pageTitle= "Ver Solicitud de: ".getRfcCustomer($rfc['customerId']);

include_once "../header.php";


?>

		<p></p>
		<div class="row">
			<div class="span6">
				<table class="table table-striped">
					<tr>
						<td><b>Cliente: </b></td>
						<td><? echo getRfcCustomer($rfc['customerId']); ?></td>
					</tr>
					<tr>
						<td><b>Productor: </b></td>
						<td><? echo  getRfcProducer($rfc['producerId']); ?></td>
					</tr>
					<tr>
						<td><b>Compañía: </b></td>
						<td><? echo getRfcCompany($rfc['companyId']); ?></td>
					</tr>
					<tr>
						<td><b>Cobertura: </b></td>
						<td><? echo getRfcCoverage($rfc['coverageId']); ?></td>
					</tr>
					<tr>
						<td><b>Datos del vehículo: </b></td>
						<td><? echo $rfc['carData']; ?></td>
					</tr>
					<tr>
						<td><b>Año del Modelo: </b></td>
						<td><? echo $rfc['modelAge']; ?></td>
					</tr>
					<tr>
						<td><b>Suma Asegurada: </b></td>
						<td>$<? echo $rfc['insuredAmount']; ?></td>
					</tr>
					<tr>
						<td><b>Descuento de comisión: </b></td>
						<td><? echo $rfc['commissionDisc']; ?>%</td>
					</tr>
					<tr>
						<td><b>Costo Anual: </b></td>
						<td>$<? echo $rfc['coverageAmount']; ?></td>
					</tr>
					<tr>
						<td><b>Fecha: </b></td>
						<td><? echo $rfc['date']; ?></td>
					</tr>
					<tr>
						<td><b>Estado: </b></td>
						<td><?
								if($rfc["state"] == 1) 
									echo  '<span class="label label-info">Enviada</span>';
								elseif($rfc["state"] == 2)
									echo  '<span class="label label-success">Aceptada</span>';
								else echo  '<span class="label label-important">Cancelada</span>';
									  ?></td>
					</tr>
					<tr>
						<td><b>Comentarios de la compañía: </b></td>
						<td><? echo $rfc['comment']; ?></td>
					</tr>
					
				</table>
			</div>
			<div class="span4">
			<div class="well">
				<b>Acciones:</b>
				<p></p>
				<?php if(!isAdmin() && $_SESSION['userData']['role'] != 'company' && $rfc["state"] == 1){ ?>

				<a onclick=" return confirm('Está seguro que desea eliminar esta Solicitud?');" href="delete.php?id=<? echo $rfc['id'] ?>" style="margin-left: 5px" class="btn btn-danger btn-small">Cancelar Solicitud</a></p>
						<?php }elseif($_SESSION['userData']['role'] == 'company' && $rfc["state"] == 1){ ?>
							<a href="confirm.php?id=<? echo $rfc['id'] ?>" style="margin-left: 5px" class="btn btn-primary btn-small">Aceptar Solicitud</a></p>
							<a href="delete.php?id=<? echo $rfc['id'] ?>" style="margin-left: 5px" class="btn btn-danger btn-small">Cancelar Solicitud</a></p>

						<?php } ?>
				<a href="list.php" style="margin-top: 5px" class="btn btn-primary btn-small">Volver a la Lista de Solicitudes</a>
			</div>
		</div>
		</div>

<?php 

include_once "../footer.php";

?>