<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'].$_SESSION['root']."pages/HRMSClass/HRMSFunction.php";
if(isset($_GET['oid']) && !empty($_GET['oid']) && $_GET['oid']!= 'NA'){
    $colValue = $_GET['oid'];
    $row = GetData("DIVIMast","DIVIID",$colValue);
    $DIVICode =$row['DIVI_CODE'];
    $DIVIName = $row['DIVI_NAME'];
    $DIVIAbt = $row['DIVI_ABT'];
    $buttonVal="Update";
    $formid="form_divi";
    $headername="Edit";

}

else {
    $colValue="";
    $DIVICode ="";
    $DIVIName = "";
    $DIVIAbt = "";
    $buttonVal="Create";
    $formid="form_divi";
    $headername="Add";

}
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title"><div class="caption"><b><?php echo $headername; ?> Division Details</b></div></h4>
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
                Division <?php echo$buttonVal; ?>d Successfully.
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
                        <label class="control-label">Division Code
                        </label></br>
                        <input type="hidden" name="DIVIID" class="form-control" value="<?php echo $colValue; ?>"/>
                        <input type="text" name="DIVICode" id="DIVICode" class="form-control" value="<?php echo $DIVICode; ?>" onkeyup="BU.checkrolename('DIVICode','DIVIMast','DIVI_Code');validate.SpecialChar('DIVICode');"/>
                    </div>
                    <div class="col-md-6">
                        <label class="control-label">Division Name <span class="required">
                            * </span>
                        </label></br>
                        <input name="DIVIName" id="DIVIName" type="text" class="form-control" value="<?php echo $DIVIName; ?>" onkeyup="BU.checkrolename('DIVIName','DIVIMast','DIVI_Name');validate.require('DIVIName','errorhidreq1');"/>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <label class="control-label">Division About
                        </label></br>
                        <textarea name="DIVIAbt" class="form-control" cols="10" rows="1"><?php echo $DIVIAbt; ?></textarea>
                    </div>

                </div>
            </div>
        </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-9 col-md-3">
                    <button type="button" onclick="validate.require('DIVIName','errorhidreq1');BU.busubmit('<?php echo $headername; ?>','<?php echo $formid; ?>','DIVIMast','DIVI','Designation','errorhid','errorhidreq','edit_DIVI');" class="btn blue"  id="subbut" ><?php echo$buttonVal; ?></button>
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