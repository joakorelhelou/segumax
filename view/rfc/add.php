<?php
session_start();

$routeLevel = 1;


include_once "../../controller/producerController.php";
include_once "../../controller/customerController.php";
include_once "../../controller/companyController.php";
include_once "../../controller/frontController.php";
include_once "../../controller/rfcController.php";

$title = "Coberturas - SeguMax";
$pageTitle= "Solicitar Cobertura";

	if($_SESSION['userData']['role'] != 'producer'){
		header("location:../login.php?redirect=1");
	} 
$role = getRoleCode();
$page = 3;

$customers = getCustomers($_SESSION['userData']['id']);
$companies = getCompanies();


if($_GET){
	if(isset($_GET['message']))
	$message = $_GET['message'];
}

if($_POST){
	if(addRfc())
		header("location:list.php?message=1");
	else $message = 2;
}

include_once "../header.php";


?>
		<?php if(isset($message)){ ?>
			<div class="alert alert-error"  id="alertBanner">
    				<a class="close" data-dismiss="alert" href="#" onclick="closeDiv('alertBanner');">×</a>	
     			    	<h4 class="alert-heading">Error al crear la solicitud</h4>		
     		</div>
     	<?php } ?>
		<div class="span6">
			<form action="add.php" class="form-horizontal" id="addCompanyForm" method="post" accept-charset="utf-8">
				<fieldset>
					<div class="control-group"><label for="customerId" class="control-label">Cliente </label>
						<select style="margin-left: 10px" class="span4" id="customer" name="customerId" required >
							<option value="0">-- Seleccione un Cliente --</option>
							<?php foreach ($customers as $customer) { ?>
									<option value="<?php echo $customer['id'] ?>"><?php echo $customer["name"]." ".$customer["surname"] ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="control-group"><label for="carData" class="control-label">Datos de la Unidad: </label><textarea style="margin-left: 10px" rows="4" cols="50"  class="span4"  name="carData" required ></textarea></div>
					<div class="control-group"><label for="modelAge" class="control-label">Modelo: </label>
							<select style="margin-left: 10px" class="span2" name="modelAge" required >
								<?php for ($i = 1; $i <= 15; $i++) { ?>
									<option value="<?php echo $i ?>"><?php echo $i; if($i == 1) echo " Año"; else echo " Años"  ?></option>
								<?php } ?>
							</select>
					</div>
					<div class="control-group"><label for="insuredAmount" class="control-label">Suma Asegurada: </label>
						<div class="input-append">
							<input pattern="^\d{1,7}$" type="number" style="margin-left: 10px" class="span2" id="insuredAmount" name="insuredAmount" required >
   						 <span class="add-on">$</span>
						</div>
					</div>
					<div class="control-group"><label for="companyId" class="control-label">Compañía: </label>
						<select id="companies" style="margin-left: 10px" class="span4" name="companyId" required >
							<option value="0">-- Seleccione una Companía --</option>
							<?php foreach ($companies as $company) { ?>
									<option value="<?php echo $company['id'] ?>"><?php echo $company["businessName"] ?></option>
							<?php } ?>
						</select>
					</div>
					<div id="coverages">
						  <div class="control-group"><label for="coverageId" class="control-label">Cobertura: </label>
								<select style="margin-left: 10px" class="span4" name="coverageId" id="coverageId" required >
									<option value="0">-- Seleccione una Cobertura --</option>
								</select>
						</div>
					</div>		
					<div class="control-group"><label for="producerCommission" class="control-label">Comisión del Productor: </label>
						<div class="input-append">
							<input value="0" pattern="^\d{1,7}$" type="number" id="commission"  style="margin-left: 10px" class="span2" name="producerCommission" readonly />
   						 <span class="add-on">%</span>
						</div>
					</div>
					<div class="control-group"><label for="commissionDis" class="control-label">Disminución de Comisión: </label>
						<div class="input-append">
							<input value="0" type="number" id="commissionDis"  style="margin-left: 10px" class="span2" name="commissionDis" required />
   						 <span class="add-on">%</span>
						</div>
						<span class="help-block" style="margin-left:150px">Elija un porcentaje entre 0 y <div id="maxDiscount" style="display: inline">0</div>%</span>
					</div>
					<div class="control-group"><label for="coverageAmount" class="control-label">Costo del Seguro (anual): </label>
						<div class="input-append">
							<input value="0" type="number" id="coverageAmount"  style="margin-left: 10px" class="span2" name="coverageAmount" readonly />
   						 <span class="add-on">$</span>
						</div>
						<input type="button" id="calculate" class="btn btn-inverse" value="Calcular" />
					   <span class="help-block" style="margin-left:150px"><div id="error" style="display: inline; color:red"></div></span>
					</div>
					
				</fieldset>
				
				<p></p>
				<div class="formSubmit">
					<input id="send" type="submit" class="btn btn-success" value="Enviar Solicitud " disabled="true"/>
					<input type="button" class="btn btn-danger" value="Cancelar" onclick="history.go(-1)" />
				</div>
			</form>
		</div>
<?php 

include_once "../footer.php";

?>


<script type="text/javascript" src="../../js/rfc.js"></script>  