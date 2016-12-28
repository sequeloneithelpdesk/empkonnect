<?php
if(isset($_GET['ofieldName']) && !empty($_GET['ofieldName'])){
    include $_SERVER['DOCUMENT_ROOT'] . "/pages/HRMSClass/HRMSClass.php";
    $obj = new HRMSClass;
    $colValue = $_GET['ofieldName'];
    $row = $obj->GetData("LOVMast","fieldName", $colValue);
    $fieldName =$row['LOV_Field'];
    $fieldValue = $row['LOV_Value'];
    $fieldText = $row['LOV_Text'];
    $fieldActive = $row['LOV_Active'];
    $fieldOrderNo = $row['LOV_OrdNo'];
    $fieldDefault = $row['LOV_Default'];
?>
<form action="#" id="form_sample_2" class="form-horizontal">
					<div class="form-body">
						<div class="alert alert-danger display-hide">
							<button class="close" data-close="alert"></button>
							You have some form errors. Please check below.
						</div>
						<div class="alert alert-success display-hide">
							<button class="close" data-close="alert"></button>
							Option Updated successfully!
						</div>
	 <div class="form-group">
	  <div class="col-md-12">
		<div class="col-md-4">
			<label class="control-label">Field Name <span class="required">
			* </span>
			</label></br>
			<input type="hidden" name="ofieldName" class="form-control" value="<?php echo $colValue; ?>"/>
			<input type="text" name="fieldName" class="form-control" value="<?php echo $fieldName; ?>"/>
		</div>
		   <div class="col-md-4">                          
			<label class="control-label">Field Value <span class="required">
			* </span>
			</label></br>
			  <input name="fieldValue" type="bussName" class="form-control" value="<?php echo $fieldValue; ?>"/>
		   </div>
		   <div class="col-md-4">                          
			<label class="control-label">Field Text<span class="required">
			* </span>
			</label></br>
			  <input name="fieldText" type="text" class="form-control" value="<?php echo $fieldText; ?>"/>
		   </div>
	  </div>
	</div>
	<div class="form-group">
	  <div class="col-md-12">
		<div class="col-md-4">
			<label class="control-label">Field Active <span class="required">
			* </span>
			</label></br>
			<input type="text" name="fieldActive" class="form-control" value="<?php echo $fieldActive; ?>"/>
		</div>
		   <div class="col-md-4">                          
			<label class="control-label">Field Order No. <span class="not-required">
			 </span>
			</label></br>
			  <input name="fieldOrderNo" type="bussName" class="form-control" value="<?php echo $fieldOrderNo; ?>"/>
		   </div>
		   <div class="col-md-4">                          
			<label class="control-label">Field Default<span class="not-required">
			 </span>
			</label></br>
			  <input name="fieldDefault" type="text" class="form-control" value="<?php echo $fieldDefault; ?>"/>
		   </div>
	  </div>
	</div>
	<div class="form-group">
	  <div class="col-md-12">
		   <div class="col-md-4">                          
			<label class="control-label">Table Name<span class="not-required">
			 </span>
			</label></br>
			  <input name="tableName" type="text" class="form-control" placeholder="" value="<?php echo $tableName; ?>"/>
		   </div>
		   <div class="col-md-4">                          
			<label class="control-label">Type<span class="required">
			* </span>
			</label></br>
			  <input name="type" type="text" class="form-control" placeholder="" value="<?php echo $type; ?>"/>
		   </div>
	  </div>
	</div>
</div>
					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-9 col-md-3">
								<button type="submit" class="btn blue"  id="subbut" >Submit</button>
								<button type="button" data-dismiss="modal" class="btn default">Cancel</button>
							</div>
						</div>
					</div>
				</form>
	<?php
}
 ?>
