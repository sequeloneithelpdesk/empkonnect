<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'].$_SESSION['root']."pages/HRMSClass/HRMSFunction.php";
if (isset($_GET['oldCostCode']) && !empty($_GET['oldCostCode']) && $_GET['oldCostCode']!= 'NA') {

    $colValue = $_GET['oldCostCode'];
    $row = GetData("costmast","CostID",$colValue);
    $costCode =$row['COST_CODE'];
    $costName = $row['COST_NAME'];
    $buttonVal="Update";
    $formid="form_cost";
    $headername="Edit";
}
else {
    $colValue ="";
    $costCode = "";
    $costName = "";
    $buttonVal="Submit";
    $formid="form_cost";
    $headername="Add";
}
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title"><div class="caption"><b><?php echo $headername; ?> Cost Center Details</b></div></h4>
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
                Cost Center <?php echo$buttonVal; ?>d Successfully.
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
                            <label class="control-label">Cost Code
                            </label></br>
                            <input type="hidden" name="oldCostCode" class="form-control" value="<?php echo $colValue; ?>"/>
                            <input type="text" name="costCode" id="costCode" class="form-control"  value="<?php echo $costCode; ?>" onkeyup="BU.checkrolename('costCode','costMast','cost_Code');validate.SpecialChar('costCode');"/>
                        </div>
                           <div class="col-md-6">                          
                            <label class="control-label">Cost Name <span class="required">
                            * </span>
                            </label></br>
                              <input name="costName" id="costName" type="text" class="form-control"  value="<?php echo $costName; ?>" onkeyup="BU.checkrolename('costName','costMast','cost_Name');validate.require('costName','errorhidreq1');"/>
                           </div>
                      </div>
                    </div>
                   
                </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-9 col-md-3">
                    <button type="button" onclick="validate.require('costName','errorhidreq1');BU.busubmit('<?php echo $headername; ?>','<?php echo $formid; ?>','costMast','Cost','Cost Center','errorhid','errorhidreq','edit_cost');" class="btn blue"  id="subbut" ><?php echo$buttonVal; ?></button>
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