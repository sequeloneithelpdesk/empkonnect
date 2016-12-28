<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'].$_SESSION['root']."pages/HRMSClass/HRMSFunction.php";
if (isset($_GET['Id']) && !empty($_GET['Id']) && $_GET['Id']!= 'NA') {

    $Id = $_GET['Id'];
    $row = GetData("functmast", "FunctID", $Id);
    $functCode = $row['FUNCT_CODE'];
    $functName = $row['FUNCT_NAME'];
    $functAdd = $row['FUNCT_Add'];
    $functHead = $row['FUNCTHEAD'];
    $buttonVal="Update";
    $formid="form_fun";
    $headername="Edit";

}

else {
    $Id="";
    $functCode = "";
    $functName = "";
    $functAdd ="";
    $functHead = "";
    $buttonVal="Submit";
    $formid="form_fun";
    $headername="Add";

}
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title"><div class="caption"><b><?php echo $headername; ?> Function Details</b></div></h4>
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
                Function <?php echo$buttonVal; ?>d Successfully.
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
            <label class="control-label">Function Code </label></br>
                <input type="hidden" name="functId" class="form-control" value="<?php echo $Id;?>"/>
                <input type="text" name="functCode" id="functCode" class="form-control" value="<?php echo $functCode;?>" onkeyup="BU.checkrolename('functCode','FunctMast','Funct_Code');validate.SpecialChar('functCode');"/>
            </div>
            <div class="col-md-6">                          
                <label class="control-label">Function Name <span class="required"> * </span>
            </label></br>
              <input name="functName" id="functName" type="text" class="form-control" value="<?php echo $functName;?>" onkeyup="BU.checkrolename('functName','FunctMast','funct_Name');validate.require('functName','errorhidreq1');"/>
           </div>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-12">
      <div class="col-md-6">                          
            <label class="control-label">Function About
            </label></br>
              <textarea name="functAdd" class="form-control" cols="10" rows="1"><?php echo $functAdd;?>
                  </textarea>
           </div>
        <div class="col-md-6">
            <label class="control-label">Function Head
            </label></br>
            <select name="functHead" id="functHead"  class="bs-select form-control usercodes bs-searchbox" >
                <?php echo HRDMasterList($functHead); ?>
            </select>

        </div>
      </div>
    </div>

</div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-9 col-md-3">
                    <button type="button" onclick="validate.require('functName','errorhidreq1');BU.busubmit('<?php echo $headername; ?>','<?php echo $formid; ?>','FUNCTMast','FUNCT','Function','errorhid','errorhidreq','edit_function');" class="btn blue"  id="subbut" ><?php echo$buttonVal; ?></button>
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
