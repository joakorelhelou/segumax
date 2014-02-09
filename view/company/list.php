<?php
session_start();

$routeLevel = 1;

include_once "../../controller/companyController.php";
include_once "../../controller/frontController.php";
$title = "Companías - SeguMax";
$pageTitle = "Companías";

if($_SESSION['userData']['role'] != 'admin' && $_SESSION['userData']['role'] != 'producer'){
	header("location:../login.php?redirect=1");
}
$role = getRoleCode();
$page = getCompanyPage($role);

if($_GET){
	if(isset($_GET['message']))
	$message = $_GET['message'];
}

if($_POST){
	$companies = getCompaniesBySeach($_POST['search']);
}else $companies = getCompanies();

include_once "../header.php";


?>
		<?php if(isset($message) && ($message == 1)){ ?>
			<div class="alert alert-success"  id="alertBanner">
    				<a class="close" data-dismiss="alert" href="#" onclick="closeDiv('alertBanner');">×</a>	
     			    	<h4 class="alert-heading">La companía ha sido agregada con éxito.</h4>		
     		</div>
     	<?php }elseif (isset($message) && ($message == 2)){ ?>
  			<div class="alert alert-danger"  id="alertBanner">
    				<a class="close" data-dismiss="alert" href="#" onclick="closeDiv('alertBanner');">×</a>	
     			    	<h4 class="alert-heading">La companía ha sido eliminada con éxito.</h4>		
     		</div>
     	<?php }elseif (isset($message) && ($message == 3)){ ?>
  			<div class="alert alert-success"  id="alertBanner">
    				<a class="close" data-dismiss="alert" href="#" onclick="closeDiv('alertBanner');">×</a>	
     			    	<h4 class="alert-heading">La companía ha sido modificada con éxito.</h4>		
     		</div>
   		
		<?php }elseif (isset($message) && ($message == 4)){ ?>
  			<div class="alert alert-error"  id="alertBanner">
    				<a class="close" data-dismiss="alert" href="#" onclick="closeDiv('alertBanner');">×</a>	
     			    	<h4 class="alert-heading">La companía seleccionada no existe.</h4>		
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
								<th><a href="#">Nombre del Propietario</a></th>
								<th><a href="#">Apellido</a></th>
								<th><a href="#">Razón Social</a></th>
								<th><a href="#">RC</a></th>
								<th><a href="#">Email</a></th>	
								<th> </th>							
							</tr>
						</thead>
						<tbody>
							<?php if($companies){
							 foreach ($companies as $company) { ?>
							<tr>
								<td><? echo $company["propName"]; ?></td>
								<td><? echo $company["propSurname"]; ?></td>
								<td><? echo $company["businessName"]; ?></td>
								<td><? echo $company["rc"]; ?></td>
								<td><? echo $company["email"]; ?></td>
								<td><a href="view.php?id=<? echo $company["id"]; ?>">Ver</a></td>

							</tr>
							<?php } }?>
						</tbody>
					</table>
					<?php if(!$companies){ echo "No hay companías que mostrar."; } ?>
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
						<p><a href="add.php" class="btn btn-success btn-small">Crear Companía</a></p>
						<p><a href="list.php" class="btn btn-success btn-small">Listar Companías</a></p>
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