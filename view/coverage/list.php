<?php
session_start();

$routeLevel = 1;


include_once "../../model/coverage.php";
include_once "../../controller/coverageController.php";
include_once "../../controller/frontController.php";
$title = "Coberturas - SeguMax";
$pageTitle = "Coberturas";

if($_SESSION['userData']['role'] != 'admin' && $_SESSION['userData']['role'] != 'company' && $_SESSION['userData']['role'] != 'producer'){
	header("location:../login.php?redirect=1");
}
$role = getRoleCode();
$page = getPage($role);

if($_GET){
	if(isset($_GET['message']))
	$message = $_GET['message'];
}

if($_POST){
	if($_SESSION['userData']['role'] != 'company')
	$coverages = getCoveragesBySeach($_POST['search']);
	else $coverages = getCoveragesBySeach($_POST['search'],$_SESSION['userData']['id']);
}else
	if(isAdmin() OR $_SESSION['userData']['role'] == 'producer') 
		$coverages = getCoverages();
	else $coverages = getCoverages($_SESSION['userData']['id']);
if(isset($_GET['id'])) $coverages = getCoverages($_GET['id']);

include_once "../header.php";


?>
		<?php if(isset($message) && ($message == 1)){ ?>
			<div class="alert alert-success"  id="alertBanner">
    				<a class="close" data-dismiss="alert" href="#" onclick="closeDiv('alertBanner');">×</a>	
     			    	<h4 class="alert-heading">La Cobertura ha sido agregada con éxito.</h4>		
     		</div>
     	<?php }elseif (isset($message) && ($message == 2)){ ?>
  			<div class="alert alert-danger"  id="alertBanner">
    				<a class="close" data-dismiss="alert" href="#" onclick="closeDiv('alertBanner');">×</a>	
     			    	<h4 class="alert-heading">La Cobertura ha sido eliminada con éxito.</h4>		
     		</div>
     	<?php }elseif (isset($message) && ($message == 3)){ ?>
  			<div class="alert alert-success"  id="alertBanner">
    				<a class="close" data-dismiss="alert" href="#" onclick="closeDiv('alertBanner');">×</a>	
     			    	<h4 class="alert-heading">La Cobertura ha sido modificada con éxito.</h4>		
     		</div>
   		
		<?php }elseif (isset($message) && ($message == 4)){ ?>
  			<div class="alert alert-error"  id="alertBanner">
    				<a class="close" data-dismiss="alert" href="#" onclick="closeDiv('alertBanner');">×</a>	
     			    	<h4 class="alert-heading">La Cobertura seleccionada no existe.</h4>		
     		</div>
   		
     	<?php } ?>

		<form action="list.php" class="form-horizontal" method="post" accept-charset="utf-8">
				<div class="btn-group">
					<button class="btn" rel="tooltip" title="Buscar" type="submit"><i class="icon-search"></i></button>
					<input name="search" type="text" class="span3" rel="tooltip" title="Buscar por descripcion, o tasa" />
				</div>			
			</form>
			<div class="row">
				<div class ="span9">				
					<table id="myTable"  class="table table-bordered table-striped paginated-table">
						<thead>
							<tr>
								<th><a href="#">Descripcion</a></th>
								<th><a href="#">Tasa</a></th>	
								<th><a href="#">Companía</a></th>							
								<th></th>							
							</tr>
						</thead>
						<tbody>
							<?php if($coverages){
							 foreach ($coverages as $coverage) { ?>
							<tr>
								<td><? echo $coverage["description"]; ?></td>
								<td><? echo $coverage["rate"]; ?>%</td>
								<td><a href="../company/view.php?id=<? echo $coverage["companyId"]; ?>"><? echo getCoverageCompany($coverage["companyId"]); ?></a></td>
								<td><a href="view.php?id=<? echo $coverage["id"]; ?>">Ver</a></td>

							</tr>
							<?php } }?>
						</tbody>
					</table>
					<?php if(!$coverages){ echo "No hay coberturas que mostrar."; } ?>
						    <ul class="pager">
							    <li><a id="prev" href="#">Anterior</a></li>
							    <li><a id="next" href="#">Siguiente</a></li>
						    </ul>

				</div>
				<?php if(!isAdmin() && $_SESSION['userData']['role'] != 'producer' ){ ?>
				<div class="span2">
					<div class="well">
						<b>Acciones:</b>
						<p></p>
						<p><a href="add.php" class="btn btn-success btn-small">Crear Cobertura</a></p>
						<p><a href="list.php" class="btn btn-success btn-small">Listar Coberturas</a></p>
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
