<?php 

include_once "../../controller/coverageController.php";


if($_GET){
	$id = $_GET['id'];
	$coverages = getCoverages($id);
?>
   <div class="control-group"><label for="coverageId" class="control-label">Cobertura: </label>
		<select style="margin-left: 10px" class="span4" name="coverageId" id="coverageId" required >
			<option value="0">-- Seleccione una Cobertura --</option>
			<?php foreach ($coverages as $coverage) { ?>
			<option value="<?php echo $coverage['id'] ?>"><?php echo $coverage["description"] ?></option>
			<?php } ?>
		</select>
	</div>
<?php	} ?>