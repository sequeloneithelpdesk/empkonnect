<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'].$_SESSION['root']."pages/HRMSClass/HRMSFunction.php";
if(isset($_GET['oid']) && !empty($_GET['oid']) && $_GET['oid']!= 'NA'){
    $colValue = $_GET['oid'];
    $row = GetData("DSGMast","DSGID",$colValue);
    $DSGCode =$row['DSG_CODE'];
    $DSGName = $row['DSG_NAME'];
    $DSGAbt = $row['DSG_ABT'];
    $buttonVal="Update";
    $formid="form_des";
    $headername="Edit";

}

else {
    $colValue="";
    $DSGCode ="";
    $DSGName = "";
    $DSGAbt = "";
    $buttonVal="Submit";
    $formid="form_des";
    $headername="Add";

}
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title"><div class="caption"><b><?php echo $headername; ?> Designation Details</b></div></h4>
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
                Designation <?php echo$buttonVal; ?>d Successfully.
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
                        <label class="control-label">Designation Code
                        </label></br>
                        <input type="hidden" name="DSGID" class="form-control" value="<?php echo $colValue; ?>"/>
                        <input type="text" name="DSGCode" id="DSGCode" class="form-control" value="<?php echo $DSGCode; ?>" onkeyup="BU.checkrolename('DSGCode','DSGMast','DSG_Code'); validate.SpecialChar('DSGCode');"/>
                    </div>
                    <div class="col-md-6">
                        <label class="control-label">Designation Name <span class="required">
                            * </span>
                        </label></br>
                        <input name="DSGName" id="DSGName" type="text" class="form-control" value="<?php echo $DSGName; ?>" onkeyup="BU.checkrolename('DSGName','DSGMast','DSG_Name');validate.require('DSGName','errorhidreq1');"/>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <label class="control-label">Designation About
                        </label></br>
                        <textarea name="DSGAbt" class="form-control" cols="10" rows="1"><?php echo $DSGAbt; ?>
                            </textarea>
                    </div>

                </div>
            </div>
        </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-9 col-md-3">
                    <button type="button" onclick="validate.require('DSGName','errorhidreq1');BU.busubmit('<?php echo $headername; ?>','<?php echo $formid; ?>','DsgMast','Dsg','Designation','errorhid','errorhidreq','edit_DSG');" class="btn blue"  id="subbut" ><?php echo$buttonVal; ?></button>
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