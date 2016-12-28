<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'].$_SESSION['root']."pages/HRMSClass/HRMSFunction.php";
if (isset($_GET['PROCID']) && !empty($_GET['PROCID']) && $_GET['PROCID']!= 'NA') {

    $colValue = $_GET['PROCID'];
    $row = GetData("procMast", "PROCID", $colValue);
    $procCode = $row['PROC_CODE'];
    $procName = $row['PROC_NAME'];
    $buttonVal="Update";
    $formid="form_pro";
    $headername="Edit";
}
else {
    $colValue ="";
    $procCode = "";
    $procName = "";
    $buttonVal="Submit";
    $formid="form_pro";
    $headername="Add";
}
              ?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title"><div class="caption"><b><?php echo $headername; ?> Process Details</b></div></h4>
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
                Process <?php echo$buttonVal; ?>d Successfully.
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-6 rolename_availability_result" id="rolename_availability_result">

                    </div>
                </div>
            </div>

            <div class="form-group">
    <div class="col-md-12">
    <div class="col-md-6"><label class="control-label">Process Type Code <span class="required"> * </span></label></br>
        <input type="hidden" name="PROCID" class="form-control" value="<?php echo $colValue;?>"/>
        <input type="text" name="procCode" id="procCode" class="form-control" value="<?php echo $procCode;?>" onkeyup="BU.checkrolename('procCode','procMast','PROC_Code');validate.SpecialChar('procCode');"/>
    </div>
    <div class="col-md-6">                          
    <label class="control-label">Process Type Name <span class="required"> * </span></label></br>
        <input name="procName" id="procName" type="text" class="form-control" value="<?php echo $procName;?>" onkeyup="BU.checkrolename('procName','procMast','PROC_Name');validate.require('procName','errorhidreq1');"/>
    </div>
    </div>
    </div>
 </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-9 col-md-3">
                    <button type="button" onclick="validate.require('procName','errorhidreq1');BU.busubmit('<?php echo $headername; ?>','<?php echo $formid; ?>','PROCMAST','PROC','Process Type','errorhid','errorhidreq','edit_process');" class="btn blue"  id="subbut" ><?php echo$buttonVal; ?></button>
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