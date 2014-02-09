<?php
session_start();

$routeLevel = 1;

include_once "../../model/customer.php";
include_once "../../controller/customerController.php";
include_once "../../controller/frontController.php";
$title = "Clientes - SeguMax";
$pageTitle = "Clientes";

if($_SESSION['userData']['role'] != 'admin' && $_SESSION['userData']['role'] != 'producer'){
	header("location:../login.php?redirect=1");
}
$role = getRoleCode();
$page = getCustomerPage($role);

if($_GET){
	if(isset($_GET['message']))
	$message = $_GET['message'];
}

if($_POST){
	$customers = getCustomersBySeach($_POST['search']);
}else
	if(isAdmin()) 
		$customers = getCustomers();
	else $customers = getCustomers($_SESSION['userData']['id']);

if(isset($_GET['id'])) $customers = getCustomers($_GET['id']);
include_once "../header.php";


?>
		<?php if(isset($message) && ($message == 1)){ ?>
			<div class="alert alert-success"  id="alertBanner">
    				<a class="close" data-dismiss="alert" href="#" onclick="closeDiv('alertBanner');">×</a>	
     			    	<h4 class="alert-heading">El cliente ha sido agregado con éxito.</h4>		
     		</div>
     	<?php }elseif (isset($message) && ($message == 2)){ ?>
  			<div class="alert alert-danger"  id="alertBanner">
    				<a class="close" data-dismiss="alert" href="#" onclick="closeDiv('alertBanner');">×</a>	
     			    	<h4 class="alert-heading">El cliente ha sido eliminado con éxito.</h4>		
     		</div>
     	<?php }elseif (isset($message) && ($message == 3)){ ?>
  			<div class="alert alert-success"  id="alertBanner">
    				<a class="close" data-dismiss="alert" href="#" onclick="closeDiv('alertBanner');">×</a>	
     			    	<h4 class="alert-heading">El cliente ha sido modificado con éxito.</h4>		
     		</div>
   		
		<?php }elseif (isset($message) && ($message == 4)){ ?>
  			<div class="alert alert-error"  id="alertBanner">
    				<a class="close" data-dismiss="alert" href="#" onclick="closeDiv('alertBanner');">×</a>	
     			    	<h4 class="alert-heading">El cliente seleccionado no existe.</h4>		
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
					<table id="myTable"  class="table table-bordered table-striped paginated-table">
						<thead>
							<tr>
								<th><a href="#">Nombre</a></th>
								<th><a href="#">Apellido</a></th>
								<th><a href="#">Cuit</a></th>
								<th><a href="#">Condición Inpositiva</a></th>
								<th><a href="#">Email</a></th>								
								<th></th>								

							</tr>
						</thead>
						<tbody>
							<?php if($customers){
							 foreach ($customers as $customer) { ?>
							<tr>
								<td><a href="view.php?id=<? echo $customer["id"]; ?>"><? echo $customer["name"]; ?></a></td>
								<td><a href="view.php?id=<? echo $customer["id"]; ?>"><? echo $customer["surname"]; ?></a></td>
								<td><? echo $customer["cuit"]; ?></td>
								<td><? echo getImpositiveCode($customer["taxCondition"]); ?></td>
								<td><? echo $customer["email"]; ?></td>
								<td><a href="view.php?id=<? echo $customer["id"]; ?>">Ver</a></td>

							</tr>
							<?php } }?>
						</tbody>
					</table>
					<?php if(!$customers){ echo "No hay clientes que mostrar."; } ?>
						    <ul class="pager">
							    <li><a id="prev" href="#">Anterior</a></li>
							    <li><a id="next" href="#">Siguiente</a></li>
						    </ul>

				</div>
				<?php if(!isAdmin()){ ?>
				<div class="span2">
					<div class="well">
						<b>Acciones:</b>
						<p></p>
						<p><a href="add.php" class="btn btn-success btn-small">Crear Cliente</a></p>
						<p><a href="list.php" class="btn btn-success btn-small">Listar Clientes</a></p>
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
