<?php
session_start();

$routeLevel = 1;


include_once "../../controller/adminController.php";
include_once "../../controller/frontController.php";

include_once "../../model/admin.php";
$title = "Administradores - SeguMax";

$role = 1;
$page = 1;
$pageTitle= "Portal de Seguros Segumax";

include_once "../header.php";
	if($_SESSION['userData']['role'] != 'admin'){
		header("location:../login.php?redirect=1");
	}

$activities = getActivities($_SESSION['userData']['id'],"admin");


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
				<h3>Acciones Rápidas:</h3> </br>
				<p><i class="icon-plus-sign"></i><a href="../producer/add.php" class=""> Crear Productor</a></p>
				<p><i class="icon-plus-sign"></i><a href="../company/add.php" class=""> Crear Compañía</a></p>
				<p><i class="icon-plus-sign"></i><a href="../admin/add.php" class=""> Crear Administrador</a></p>

				</div>
				</div>
				
</div>
<?php 
	
include_once "../footer.php";

?>