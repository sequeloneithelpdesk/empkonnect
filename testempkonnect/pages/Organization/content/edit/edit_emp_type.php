<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'].$_SESSION['root']."pages/HRMSClass/HRMSFunction.php";
if(isset($_GET['TYPEID']) && !empty($_GET['TYPEID']) && $_GET['TYPEID']!= 'NA'){
    $colValue = $_GET['TYPEID'];
    $row = GetData("TypeMast","TYPEID",$colValue);
    $empTypeCode =$row['TYPE_CODE'];
    $empTypeName = $row['TYPE_NAME'];
    $empTypeAbt = $row['TYPE_ABT'];
    $buttonVal="Update";
    $formid="form_etfun";
    $headername="Edit";

}

else {
    $colValue="";
    $empTypeCode ="";
    $empTypeName = "";
    $empTypeAbt = "";
    $buttonVal="Create";
    $formid="form_etfun";
    $headername="Add";

}
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title"><div class="caption"><b><?php echo $headername; ?> Employee Type Details</b></div></h4>
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
                Employee Type <?php echo$buttonVal; ?>d Successfully.
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
                            <label class="control-label">Employee Type Code
                            </label></br>
                            <input type="hidden" name="TYPEID" class="form-control" value="<?php echo $colValue; ?>"/>
                            <input type="text" name="empTypeCode" id="empTypeCode" class="form-control"  value="<?php echo $empTypeCode; ?>" onkeyup="BU.checkrolename('empTypeCode','TypeMast','Type_Code');validate.SpecialChar('empTypeCode');"/>
                        </div>
                           <div class="col-md-6">                          
                            <label class="control-label">Employee Type Name <span class="required">
                            * </span>
                            </label></br>
                              <input name="empTypeName" id="empTypeName" type="text" class="form-control" value="<?php echo $empTypeName; ?>" onkeyup="BU.checkrolename('empTypeName','TypeMast','Type_Name');validate.require('empTypeName','errorhidreq1');"/>
                           </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12">
                      <div class="col-md-6">                          
                            <label class="control-label">Employee Type About
                            </label></br>
                          <textarea name="empTypeAbt" class="form-control" cols="10" rows="1"><?php echo $empTypeAbt; ?>
                            </textarea>

                           </div>
                                                 
                      </div>
                    </div>                   
                </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-9 col-md-3">
                    <button type="button" onclick="validate.require('empTypeName','errorhidreq1');BU.busubmit('<?php echo $headername; ?>','<?php echo $formid; ?>','TypeMast','TYPE','Employee Type','errorhid','errorhidreq','edit_emp_type');" class="btn blue"  id="subbut" ><?php echo$buttonVal; ?></button>
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