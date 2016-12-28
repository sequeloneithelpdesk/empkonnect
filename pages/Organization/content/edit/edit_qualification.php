<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'].$_SESSION['root']."pages/HRMSClass/HRMSFunction.php";
if (isset($_GET['oqualCode']) && !empty($_GET['oqualCode']) && $_GET['oqualCode']!= 'NA') {

    $colValue = $_GET['oqualCode'];
    $row = GetData("qualmast", "qualID", $colValue);
    $qualCode =$row['Qual_Code'];
    $qualName = $row['Qual_Name'];
    $buttonVal="Update";
    $formid="form_qual";
    $headername="Edit";
}
else {
    $colValue ="";
    $qualCode = "";
    $qualName = "";
    $buttonVal="Submit";
    $formid="form_qual";
    $headername="Add";
}
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title"><div class="caption"><b><?php echo $headername; ?> Qualification Details</b></div></h4>
</div>
<div class="modal-body">

    <form action="" id="<?php echo$formid; ?>" class="form-horizontal">
        <div class="form-body">
            <div id="err" class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button>
                You have some form errors. Please check below.
            </div>
            <div id="succ" class="alert alert-success display-hide">
                <button class="close" data-close="alert"></button>
                Qualification <?php echo$buttonVal; ?>d Successfully.
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-6 rolename_availability_result" id="rolename_availability_result">

                    </div>
                </div>
            </div>

                     <div class="form-group">
                      <div class="col-md-12">
                        <div class="col-md-6">
                            <label class="control-label">Qualification Code 
                            </label></br>
							<input type="hidden" name="oqualCode" class="form-control" value="<?php echo $colValue; ?>"/>
                            <input type="text" name="qualCode" id="qualCode" class="form-control" value="<?php echo $qualCode; ?>" onkeyup="BU.checkrolename('qualCode','qualMast','qual_Code');validate.SpecialChar('qualCode');"/>
                        </div>
                           <div class="col-md-6">                          
                            <label class="control-label">Qualification Name <span class="required">
                            * </span>
                            </label></br>
                              <input name="qualName" id="qualName" type="text" class="form-control" value="<?php echo $qualName; ?>" onkeyup="BU.checkrolename('qualName','qualMast','qual_Name');validate.require('qualName','errorhidreq1');"/>
                           </div>
                      </div>
                    </div>
                    
                </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-9 col-md-3">
                    <button type="button" onclick="validate.require('qualName','errorhidreq1');BU.busubmit('<?php echo $headername; ?>','<?php echo $formid; ?>','QualMast','Qual','Qualification','errorhid','errorhidreq','edit_qualification');" class="btn blue"  id="subbut" ><?php echo$buttonVal; ?></button>
                    <button type="button" data-dismiss="modal" class="btn default">Cancel</button>
                </div>
            </div>
        </div>
        <input type="hidden" id="errorhid" value="0">
        <input type="hidden" id="errorhidreq1" value="1">
        <input type="hidden" id="errorhidreq2" value="0">
        <input type="hidden" id="errorhidreq3" value="0">
        <input type="hidden" id="errorhidreq4" value="0">
        <input type="hidden" id="errorhidreq5" value="0">
    </form>

</div>