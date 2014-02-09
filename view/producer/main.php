<?php
session_start();
$routeLevel = 1;

include_once "../../controller/producerController.php";
include_once "../../model/producer.php";
include_once "../../controller/frontController.php";

$title = "Productores - SeguMax";
$role = 2;
$page = 1;

$pageTitle= "Portal de Seguros Segumax";


include_once "../header.php";
	if($_SESSION['userData']['role'] != 'producer'){
		header("location:../login.php?redirect=1");
	}
	
$activities = getActivities($_SESSION['userData']['id'],"producer");

?>

<div class="row">
				<div class ="span8">	
							<table class="paginated-table">

							<?php 
							if($activities){
							 foreach ($activities as $activity) { ?>
							<tr><td>
							<div class="activity">
							 <p><?php	echo $activity['description']; ?></p>
							 <span class="date">
							 <span class="datetime"><?php	echo $activity['date']; ?></span>
							 </span>
							</div>
							</tr></td>
							<?php
							
							} }else echo "No hay actividades que mostrar"; ?>
						</table></br>
					    <ul class="pager">
							    <li><a id="prev" href="#">Anterior</a></li>
							    <li><a id="next" href="#">Siguiente</a></li>
						    </ul>

				</div>
				<div class="span4">
					
			<div class="well">
			<h3>Acciones Rápidas:</h3></br>
				<p><i class="icon-plus-sign"></i><a href="../rfc/add.php" class=""> Crear Solicitud de Cobertura</a></p>
				<p><i class="icon-plus-sign"> </i><a href="../customer/add.php" class=""> Crear Cliente</a></p>
			</div>
				</div>
</div>

<?php 

include_once "../footer.php";

?>