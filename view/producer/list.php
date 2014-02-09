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
	if(isset($_GET['message']))
	$message = $_GET['message'];
}

if($_POST){
	$producers = getProducersBySeach($_POST['search']);
}else $producers = getProducers();

$pageTitle = "Productores";
include_once "../header.php";


?>
		<?php if(isset($message) && ($message == 1)){ ?>
			<div class="alert alert-success"  id="alertBanner">
    				<a class="close" data-dismiss="alert" href="#" onclick="closeDiv('alertBanner');">×</a>	
     			    	<h4 class="alert-heading">El productor ha sido agregado con éxito.</h4>		
     		</div>
     	<?php }elseif (isset($message) && ($message == 2)){ ?>
  			<div class="alert alert-danger"  id="alertBanner">
    				<a class="close" data-dismiss="alert" href="#" onclick="closeDiv('alertBanner');">×</a>	
     			    	<h4 class="alert-heading">El productor ha sido eliminado con éxito.</h4>		
     		</div>
     	<?php }elseif (isset($message) && ($message == 3)){ ?>
  			<div class="alert alert-success"  id="alertBanner">
    				<a class="close" data-dismiss="alert" href="#" onclick="closeDiv('alertBanner');">×</a>	
     			    	<h4 class="alert-heading">El productor ha sido modificado con éxito.</h4>		
     		</div>
   		
		<?php }elseif (isset($message) && ($message == 4)){ ?>
  			<div class="alert alert-error"  id="alertBanner">
    				<a class="close" data-dismiss="alert" href="#" onclick="closeDiv('alertBanner');">×</a>	
     			    	<h4 class="alert-heading">El productor seleccionado no existe.</h4>		
     		</div>
   		
     	<?php } ?>

		<form action="list.php" class="form-horizontal" method="post" accept-charset="utf-8">
				<div class="btn-group">
					<button class="btn" rel="tooltip" title="Buscar" type="submit"><i class="icon-search"></i></button>
					<input name="search" type="text" class="span3" rel="tooltip" title="Buscar por nombre, DNI o Email" />
				</div>			
			</form>
			<div class="row">
				<div class ="span9">				
					<table id="myTable" class="table table-bordered table-striped paginated-table">
						<thead>
							<tr>
								<th><a href="#">DNI</a></th>
								<th><a href="#">Nombre</a></th>
								<th><a href="#">Apellido</a></th>
								<th><a href="#">Email</a></th>
								<th><a href="#">Teléfono</a></th>
								<th></th>

							</tr>
						</thead>
						<tbody>
							<?php if($producers){
							 foreach ($producers as $producer) { ?>
							<tr>
								<td><? echo $producer["dni"]; ?></td>
								<td><a href="view.php?id=<? echo $producer["id"]; ?>"><? echo $producer["name"]; ?></a></td>
								<td><a href="view.php?id=<? echo $producer["id"]; ?>"><? echo $producer["surname"]; ?></a></td>
								<td><? echo $producer["email"]; ?></td>
								<td><? echo $producer["phone"]; ?></td>
								<td><a href="view.php?id=<? echo $producer["id"]; ?>">Ver</a></td>

							</tr>
							<?php } }?>
						</tbody>
					</table>
					<?php if(!$producers){ echo "No hay productores que mostrar."; } ?>
					
					  <!--  <div class="pagination">
						    <ul>
						    <li class="prev disabled"><a href="#">«</a></li>
						    <li class="active"><a href="#">1</a></li>
						    <li><a href="list.php/page:2">2</a></li>
						    <li><a href="list.php/page:3">3</a></li>
						    <li><a href="list.php/page:4">4</a></li>
						    <li><a href="list.php/page:5">5</a></li>
						    <li><a class="next" href="#">»</a></li>
						    </ul>
						</div>-->
						    <ul class="pager">
							    <li><a id="prev" href="#">Anterior</a></li>
							    <li><a id="next" href="#">Siguiente</a></li>
						    </ul>

				</div>
				<?php if(isAdmin()){ ?>
				<div class="span2">
					<div class="well">
						<b>Acciones:</b>
						<p></p>
						<p><a href="add.php" class="btn btn-success btn-small">Crear Productor</a></p>
						<p><a href="list.php" class="btn btn-success btn-small">Listar Productores</a></p>
					</div>
				</div>
			   <?php } ?>
			</div>

<?php 

include_once "../footer.php";

?>

<script>
	$(document).ready(function() 
    { 
        $("#myTable").tablesorter(); 
    } 
); 
</script>