<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'].$_SESSION['root']."pages/HRMSClass/HRMSFunction.php";
if(isset($_GET['oid']) && !empty($_GET['oid']) && $_GET['oid']!= 'NA'){
    $colValue = $_GET['oid'];
    $row = GetData("REGNMast","REGNID",$colValue);
    $REGNCode =$row['REGN_CODE'];
    $REGNName = $row['REGN_NAME'];
    $REGNAbt = $row['Regn_ABT'];
    $buttonVal="Update";
    $formid="form_reg";
    $headername="Edit";

}

else {
    $colValue="";
    $REGNCode ="";
    $REGNName = "";
    $REGNAbt = "";
    $buttonVal="Submit";
    $formid="form_reg";
    $headername="Add";

}
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title"><div class="caption"><b><?php echo $headername; ?> Region Details</b></div></h4>
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
                Region <?php echo$buttonVal; ?>d Successfully.
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
                        <label class="control-label">Region Code
                        </label></br>
                        <input type="hidden" name="REGNID" class="form-control" value="<?php echo $colValue; ?>"/>
                        <input type="text" name="REGNCode" id="REGNCode" class="form-control" value="<?php echo $REGNCode; ?>" onkeyup="BU.checkrolename('REGNCode','REGNMast','REGN_Code');validate.SpecialChar('REGNCode');"/>
                    </div>
                    <div class="col-md-6">
                        <label class="control-label">Region Name <span class="required">
                            * </span>
                        </label></br>
                        <input name="REGNName" id="REGNName" type="text" class="form-control" value="<?php echo $REGNName; ?>" onkeyup="BU.checkrolename('REGNName','REGNMast','REGN_Name');validate.require('REGNName','errorhidreq1');"/>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <label class="control-label">Region About
                        </label></br>
                        <textarea name="REGNAbt" class="form-control" cols="10" rows="1"><?php echo $REGNAbt; ?></textarea>
                    </div>

                </div>
            </div>
        </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-9 col-md-3">
                    <button type="button" onclick="validate.require('REGNName','errorhidreq1');BU.busubmit('<?php echo $headername; ?>','<?php echo $formid; ?>','RegnMast','Regn','Designation','errorhid','errorhidreq','edit_REGN');" class="btn blue"  id="subbut" ><?php echo$buttonVal; ?></button>
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