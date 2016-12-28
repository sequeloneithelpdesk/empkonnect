<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'].$_SESSION['root']."pages/HRMSClass/HRMSFunction.php";
if (isset($_GET['GRDID']) && !empty($_GET['GRDID']) && $_GET['GRDID']!= 'NA') {
    $colValue = $_GET['GRDID'];
    $row = GetData("grdmast","GRDID",$colValue);
    $grdCode =$row['GRD_CODE'];
    $grdName = $row['GRD_NAME'];
    $buttonVal="Update";
    $formid="form_grd";
    $headername="Edit";
}
else {
    $colValue ="";
    $grdCode = "";
    $grdName = "";
    $buttonVal="Submit";
    $formid="form_grd";
    $headername="Add";
}
    //$tableType = $row['tableType'];
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title"><div class="caption"><b><?php echo $headername; ?> Grade Details</b></div></h4>
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
                Grade <?php echo$buttonVal; ?>d Successfully.
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
                            <label class="control-label">Grade Code 
                            </label></br>
                            <input type="hidden" name="GRDID" class="form-control" value="<?php echo $colValue;?>"/>
                            <input type="text" name="grdCode" id="grdCode" class="form-control" value="<?php echo $grdCode;?>" onkeyup="BU.checkrolename('grdCode','GRDMast','GRD_Code');validate.SpecialChar('grdCode');" />
                        </div>
                           <div class="col-md-6">                          
                            <label class="control-label">Grade Name <span class="required">
                            * </span>
                            </label></br>
                              <input name="grdName" id="grdName" type="text" class="form-control" value="<?php echo $grdName;?>" onkeyup="BU.checkrolename('grdName','GRDMast','GRD_Name');validate.require('grdName','errorhidreq1');"/>
                           </div>
                      </div>
                    </div>
                    <!-- <div class="form-group">
                      <div class="col-md-12">
                      <div class="col-md-6">                          
                            <label class="control-label">Level Code<span class="required">
                            * </span>
                            </label></br>
                              <input name="levelCode" type="text" class="form-control" value="<?php echo $Level_Code; ?>"/>
                           </div>
                                                 <div class="col-md-6">                          
                            <label class="control-label">Level Name<span class="required">
                            * </span>
                            </label></br>
                              <input name="levelName" type="text" class="form-control" value="<?php echo $Level_Name; ?>"/>
                           </div>
    
                      </div>
                    </div>-->
                </div>
    <div class="form-actions">
        <div class="row">
            <div class="col-md-offset-9 col-md-3">
                <button type="button" id="subbut" onclick="validate.require('grdName','errorhidreq1');BU.busubmit('<?php echo $headername; ?>','<?php echo $formid; ?>','GRDMAST','GRD','Grade','errorhid','errorhidreq','edit_grade');" class="btn blue"><?php echo$buttonVal; ?></button>
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