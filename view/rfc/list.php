<?php
session_start();

$routeLevel = 1;

include_once "../../model/rfc.php";
include_once "../../controller/rfcController.php";
include_once "../../controller/frontController.php";
include_once '../../controller/customerController.php';
include_once '../../controller/companyController.php';
include_once '../../controller/producerController.php';


$title = "Solicitudes de Cobertura - SeguMax";
$pageTitle = "Solicitudes de Cobertura";

if($_SESSION['userData']['role'] != 'admin' && $_SESSION['userData']['role'] != 'producer' && $_SESSION['userData']['role'] != 'company'){
	header("location:../login.php?redirect=1");
}
$role = getRoleCode();
$page = getRfcPage($role);

if($_GET){
	if(isset($_GET['message']))
	$message = $_GET['message'];
	
}

if($_POST){
	$rfcs = getRfcsBySeach();
}else{
	if(isAdmin()) 
		$rfcs = getRfcs();
	elseif($_SESSION['userData']['role'] == 'producer')
		 $rfcs = getRfcs($_SESSION['userData']['id']);
	elseif(isset($_GET['state'])){
			$rfcs = getSentRfcs();
	}else $rfcs = getCompanyRfcs($_SESSION['userData']['id']);
}

if($_SESSION['userData']['role'] == 'producer') 
	$customers = getCustomers($_SESSION['userData']['id']);
else  $customers = getCustomers();
	
$companies = getCompanies();
$producers= getProducers();



if(isset($_GET['id'])) $rfcs = getRfcs($_GET['id']);
if(isset($_GET['customer'])) $rfcs = getCustomerRfcs($_GET['customer']);
include_once "../header.php";


?>
		<?php if(isset($message) && ($message == 1)){ ?>
			<div class="alert alert-success"  id="alertBanner">
    				<a class="close" data-dismiss="alert" href="#" onclick="closeDiv('alertBanner');">×</a>	
     			    	<h4 class="alert-heading">La Solicitud ha sido enviada con éxito.</h4>		
     		</div>
     	<?php }elseif (isset($message) && ($message == 2)){ ?>
  			<div class="alert alert-danger"  id="alertBanner">
    				<a class="close" data-dismiss="alert" href="#" onclick="closeDiv('alertBanner');">×</a>	
     			    	<h4 class="alert-heading">La Solicitud ha sido cancelada con éxito.</h4>		
     		</div>
     	<?php }elseif (isset($message) && ($message == 3)){ ?>
  			<div class="alert alert-success"  id="alertBanner">
    				<a class="close" data-dismiss="alert" href="#" onclick="closeDiv('alertBanner');">×</a>	
     			    	<h4 class="alert-heading">La Solicitud ha sido modificado con éxito.</h4>		
     		</div>
   		
		<?php }elseif (isset($message) && ($message == 4)){ ?>
  			<div class="alert alert-error"  id="alertBanner">
    				<a class="close" data-dismiss="alert" href="#" onclick="closeDiv('alertBanner');">×</a>	
     			    	<h4 class="alert-heading">La Solicitud seleccionada no existe.</h4>		
     		</div>
   		
     	<?php }elseif (isset($message) && ($message == 5)){ ?>
  			<div class="alert alert-success"  id="alertBanner">
    				<a class="close" data-dismiss="alert" href="#" onclick="closeDiv('alertBanner');">×</a>	
     			    	<h4 class="alert-heading">La Solicitud seleccionada fue aceptada.</h4>		
     		</div>
   		
     	<?php } ?>
		<form action="list.php" class="form-horizontal" method="post" accept-charset="utf-8">
					<a class="btn" id="cog" rel="tooltip" title="Avanzada"><i class="icon-search"></i></a>
					<i class="icon-arrow-left"></i> Utilice los filtros de búsqueda proporcionados. <a href="list.php">Remover Filtros</a>
				<div id="advanced" style="display:none">
					<div class="span6">
						<div class="well" style="margin-left:-30px;">
							<?php if($_SESSION['userData']['role'] != 'company'){ ?>
							<div class="control-group"><label for="customerId" class="control-label">Cliente: </label>
								<select style="margin-left: 10px" class="span3" id="customer" name="customerId"  >
									<option value="0">-- Todos --</option>
									<?php foreach ($customers as $customer) { ?>
											<option value="<?php echo $customer['id'] ?>"><?php echo $customer["name"]." ".$customer["surname"] ?></option>
									<?php } ?>
								</select>
							</div>
							<? } ?>
							<?php if($_SESSION['userData']['role'] != 'company'){ ?>
							<div class="control-group"><label for="companyId" class="control-label">Compañía: </label>
								<select id="companies" style="margin-left: 10px" class="span3" name="companyId"  >
									<option value="0">-- Todas --</option>
									<?php foreach ($companies as $company) { ?>
											<option value="<?php echo $company['id'] ?>"><?php echo $company["businessName"] ?></option>
									<?php } ?>
								</select>
							</div>
							<? } ?>
							<?php if($_SESSION['userData']['role'] != 'producer' && $_SESSION['userData']['role'] != 'company'){ ?>
								<div class="control-group"><label for="producerId" class="control-label">Productor: </label>
								<select id="producers" style="margin-left: 10px" class="span3" name="producerId"  >
									<option value="0">-- Todos --</option>
									<?php foreach ($producers as $producer) { ?>
											<option value="<?php echo $producer['id'] ?>"><?php echo $producer["name"]." ".$producer["surname"] ?></option>
									<?php } ?>
								</select>
							</div>
							
							<? } ?>

							<div class="control-group"><label for="dateFrom" class="control-label">Fecha desde: </label><input id="datepicker1" type="text" style="margin-left: 10px" class="span3" maxlength="50" name="dateFrom"  /></div>
							<div class="control-group"><label for="dateTo" class="control-label">Fecha hasta: </label><input id="datepicker2" type="text" style="margin-left: 10px" class="span3" maxlength="50" name="dateTo"  /></div>
							<div class="control-group"><label for="state" class="control-label">Estado: </label>
								<select style="margin-left: 10px" class="span3" id="state" name="state"  >
									<option value="0">-- Todos --</option>
									<option value="1">Enviada</option>
									<option value="2">Aceptada</option>
									<option value="3">Cancelada</option>
									
								</select>
							</div>
							<button class="btn btn-primary" rel="tooltip" title="Buscar" type="submit">Buscar</button>

					</div>
				</div>		
			</div>	
		</form> 

		
			<div class="row">
				<div class ="span9">				
					<table id="myTable" class="table table-bordered table-striped paginated-table">
						<thead>
							<tr>
								<th><a href="#">Productor</a></th>
								<th><a href="#">Compañía</a></th>
								<th><a href="#">Cliente</a></th>
								<th><a href="#">Costo</a></th>
								<th><a href="#">Estado</a></th>
								<th><a href="#">Fecha</a></th>								
								<th></th>								
							</tr>
						</thead>
						<tbody>
							<?php if($rfcs){
							 foreach ($rfcs as $rfc) { ?>
							<tr>
								<td><? echo getRfcProducer($rfc["producerId"]); ?></td>
								<td><? echo getRfcCompany($rfc["companyId"]); ?></td>
								<?php if($_SESSION['userData']['role'] != "company"){ ?>
								<td><a href="../customer/view.php?id=<? echo $rfc["customerId"]; ?>"><? echo getRfcCustomer($rfc["customerId"]); ?></a></td>
								<? }else{ ?>
										<td><? echo getRfcCustomer($rfc["customerId"]); ?></td>
							
								<? } ?>
								<td><? echo $rfc["coverageAmount"]; ?></td>
								<td><?
								if($rfc["state"] == 1) 
									echo  '<span class="label label-info">Enviada</span>';
								elseif($rfc["state"] == 2)
									echo  '<span class="label label-success">Aceptada</span>';
								else echo  '<span class="label label-important">Cancelada</span>';
									  ?></td>
								<td><? echo $rfc["date"]; ?></td>
								<td><a href="view.php?id=<? echo $rfc["id"]; ?>">Ver</a></td>

							</tr>
							<?php } }?>
						</tbody>
					</table>
					<?php if(!$rfcs){ echo "No hay Solicitudes que mostrar."; } ?>
						    <ul class="pager">
							    <li><a id="prev" href="#">Anterior</a></li>
							    <li><a id="next" href="#">Siguiente</a></li>
						    </ul>

				</div>
				<?php if($_SESSION['userData']['role'] == 'producer'){ ?>
				<div class="span2">
					<div class="well">
						<b>Acciones:</b>
						<p></p>
						<p><a href="add.php" class="btn btn-success btn-small">Crear Solicitud</a></p>
						<p><a href="list.php" class="btn btn-success btn-small">Listar Solicitudes</a></p>
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
    

$(function() {
$( "#datepicker1" ).datepicker({ dateFormat: "yy-mm-dd" });
});

$(function() {
$( "#datepicker2" ).datepicker({ dateFormat: "yy-mm-dd" });
});
$('#cog').click(function() {  
		if($('#advanced').css('display') == "none")
  			$('#advanced').css('display','block');
  		else  $('#advanced').css('display','none');

    });
</script>