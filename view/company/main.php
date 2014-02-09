<?php
session_start();
$routeLevel = 1;

include_once "../../controller/companyController.php";
include_once "../../model/company.php";
include_once "../../controller/frontController.php";
include_once "../../controller/rfcController.php";


$title = "Companias - SeguMax";
$role = 3;
$page = 1;

$pageTitle= "Portal de Seguros Segumax";


include_once "../header.php";
	if($_SESSION['userData']['role'] != 'company'){
		header("location:../login.php?redirect=1");
	} 
	
$activities = getActivities($_SESSION['userData']['id'],"company");
$requests = getRequestNumber($_SESSION['userData']['id']);

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
						<h3>Mis solicitudes de Cobertura</h3></br>
						<form action="../rfc/list.php" method="post">
						<p><button type="submit" class="btn btn-large btn-primary"><span><? echo $requests ?></span> Solicitudes sin Responder</button></p>									
						<input type="hidden" name="state" value="1" />
						<input type="hidden" name="dateTo" value="" />
						<input type="hidden" name="dateFrom" value="" />

						</form>
						<a href="../rfc/list.php" class="btn btn-large btn-success">Listar Todas las Solicitudes</a>
					</div>
			
				<div class="well">
				<p><i class="icon-plus-sign"></i><a href="../coverage/add.php" class=""> Crear nueva Cobertura</a></p>
				</div>
				</div>
</div>


<?php 

include_once "../footer.php";

?>