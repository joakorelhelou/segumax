<?php
session_start();

$routeLevel = 1;

include_once "../../controller/adminController.php";
include_once "../../model/admin.php";
include_once "../../controller/frontController.php";
$title = "Administradores - SeguMax";

if($_SESSION['userData']['role'] != 'admin'){
	header("location:../login.php?redirect=1");
}
$role = getRoleCode();
$page = getPage($role);

if($_GET){
	if(isset($_GET['message']))
	$message = $_GET['message'];
}

if($_POST){
	$admins = getAdminsBySeach($_POST['search']);
}else $admins = getAdmins();

$pageTitle= "Administradores";


include_once "../header.php";


?>
		<?php if(isset($message) && ($message == 1)){ ?>
			<div class="alert alert-success"  id="alertBanner">
    				<a class="close" data-dismiss="alert" href="#" onclick="closeDiv('alertBanner');">×</a>	
     			    	<h4 class="alert-heading">El administrador ha sido agregado con éxito.</h4>		
     		</div>
     	<?php }elseif (isset($message) && ($message == 2)){ ?>
  			<div class="alert alert-danger"  id="alertBanner">
    				<a class="close" data-dismiss="alert" href="#" onclick="closeDiv('alertBanner');">×</a>	
     			    	<h4 class="alert-heading">El administrador ha sido eliminado con éxito.</h4>		
     		</div>
     	<?php }elseif (isset($message) && ($message == 3)){ ?>
  			<div class="alert alert-success"  id="alertBanner">
    				<a class="close" data-dismiss="alert" href="#" onclick="closeDiv('alertBanner');">×</a>	
     			    	<h4 class="alert-heading">El administrador ha sido modificado con éxito.</h4>		
     		</div>
   		
		<?php }elseif (isset($message) && ($message == 4)){ ?>
  			<div class="alert alert-error"  id="alertBanner">
    				<a class="close" data-dismiss="alert" href="#" onclick="closeDiv('alertBanner');">×</a>	
     			    	<h4 class="alert-heading">El administrador seleccionado no existe.</h4>		
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
								<th><a href="#">Nombre</a></th>
								<th><a href="#">Apellido</a></th>
								<th><a href="#">DNI</a></th>
								<th><a href="#">Teléfono</a></th>
								<th><a href="#">Email</a></th>								
								<th> </th>								

							</tr>
						</thead>
						<tbody>
							<?php if($admins){
							 foreach ($admins as $admin) { ?>
							<tr>
								<td><? echo $admin["name"]; ?></td>
								<td><? echo $admin["surname"]; ?></td>
								<td><? echo $admin["dni"]; ?></td>
								<td><? echo $admin["phone"]; ?></td>
								<td><? echo $admin["email"]; ?></td>
								<td><a href="view.php?id=<? echo $admin["id"]; ?>">Ver</a></td>

							</tr>
							<?php } }?>
						</tbody>
					</table>
					<?php if(!$admins){ echo "No hay administradores que mostrar."; } ?>
						    <ul class="pager">
							    <li><a id="prev" href="#">Anterior</a></li>
							    <li><a id="next" href="#">Siguiente</a></li>
						    </ul>
					
				</div>
				<div class="span2">
					<div class="well">
						<b>Acciones:</b>
						<p></p>
						<p><a href="add.php" class="btn btn-success btn-small">Crear Administador</a></p>
						<p><a href="list.php" class="btn btn-success btn-small">Listar Administrador</a></p>
					</div>
				</div>
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