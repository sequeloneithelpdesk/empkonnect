<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'].$_SESSION['root']."pages/HRMSClass/HRMSFunction.php";
if (isset($_GET['Id']) && !empty($_GET['Id']) && $_GET['Id']!= 'NA') {

    $Id = $_GET['Id'];
    $row = GetData("SubFunctMast", "SubFunctID", $Id);

    $subFunctCode =$row['SubFunct_CODE'];
    $subFunctName = $row['SubFunct_NAME'];
    $subFunctHead = $row['SubFunct_HEAD'];
    $subFunctAdd = $row['SubFunct_Abt'];
    $functCode = $row['Func_Code'];
    $buttonVal="Update";
    $formid="form_sfun";
    $headername="Edit";

}

else {
    $Id="";
    $subFunctCode = "";
    $subFunctName = "";
    $subFunctAdd ="";
    $subFunctHead = "";
    $functCode = "";
    $buttonVal="Submit";
    $formid="form_sfun";
    $headername="Add";

}
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title"><div class="caption"><b><?php echo $headername; ?> Sub Function Details</b></div></h4>
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
                Sub Function <?php echo$buttonVal; ?>d Successfully.
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
                            <label class="control-label">Sub Function Code <span class="required"> * </span></label></br>
                            <input type="hidden" name="subfunctID" class="form-control" value="<?php echo $Id; ?>"/>
                            <input type="text" name="subFunctCode" id="subFunctCode" class="form-control" value="<?php echo $subFunctCode; ?>" onkeyup="BU.checkrolename('subFunctCode','SubFunctMast','SubFunct_Code');validate.SpecialChar('subFunctCode');"/>
                        </div>
                           <div class="col-md-6">                          
                            <label class="control-label">Sub Function Name <span class="required">
                            * </span>
                            </label></br>
                              <input name="subFunctName" id="subFunctName" type="text" class="form-control" value="<?php echo $subFunctName; ?>" onkeyup="BU.checkrolename('subFunctName','SubFunctMast','SubFunct_Name');validate.require('subFunctName','errorhidreq1');"/>
                           </div>
                           
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <div class="col-md-12">
                      <div class="col-md-6">                          
                        <label class="control-label">Sub Function Head
                            </label></br>

                          <select name="emplyeemaster" id="emplyeemaster"  class="bs-select form-control usercodes bs-searchbox" >
                              <?php echo HRDMasterList($subFunctHead); ?>
                          </select>

                           </div>
                        <div class="col-md-6">
                            <label class="control-label">Sub Function's Parent 
                            </label></br>
                            <select name="mainfunctionlist" id="mainfunctionlist"  class="bs-select form-control usercodes bs-searchbox" >
                                <?php echo functionList($functCode); ?>
                            </select>

                        </div>
                      </div>
                    </div>

            <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <label class="control-label">Sub Function About
                        </label></br>
              <textarea name="subfunctAdd" class="form-control" cols="10" rows="1"><?php echo $subFunctAdd;?>
                  </textarea>
                    </div>

                </div>
            </div>


                </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-9 col-md-3">
                    <button type="button" onclick="validate.require('subFunctName','errorhidreq1');BU.busubmit('<?php echo $headername; ?>','<?php echo $formid; ?>','SubFunctMast','SubFunct','Sub Function','errorhid','errorhidreq','edit_sub_function');" class="btn blue"  id="subbut" ><?php echo$buttonVal; ?></button>
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