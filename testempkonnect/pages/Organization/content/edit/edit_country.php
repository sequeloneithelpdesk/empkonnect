<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'].$_SESSION['root']."pages/HRMSClass/HRMSFunction.php";
if(isset($_GET['countryId']) && !empty($_GET['countryId']) && $_GET['countryId']!= 'NA'){
    $colValue = $_GET['countryId'];
    $row = GetData("countrymast","CountryID",$colValue);
    $countryCode =$row['Country_CODE'];
    $countryName = $row['Country_NAME'];
    $buttonVal="Update";
    $formid="form_con";
    $headername="Edit";

}

else {
    $colValue="";
    $countryCode ="";
    $countryName ="";
    $buttonVal="Submit";
    $formid="form_con";
    $headername="Add";

}
 
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title"><div class="caption"><b><?php echo $headername; ?> Country Details</b></div></h4>
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
                Country <?php echo$buttonVal; ?>d Successfully.
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
                            <label class="control-label">Country Code <span class="required">
                            * </span>
                            </label></br>
                            <input type="text" name="countryCode" id="countryCode" class="form-control" value="<?php echo $countryCode;?>" onkeyup="BU.checkrolename('countryCode','countrymast','Country_Code');validate.SpecialChar('countryCode');"/>
                            <input type="hidden" name="countryId" class="form-control" style="" value="<?php echo $colValue;?>"/>
                        </div>
                           <div class="col-md-6">                          
                            <label class="control-label">Country Name <span class="required">
                            * </span>
                            </label></br>
                              <input name="countryName" id="countryName" type="text" class="form-control" value="<?php echo $countryName;?>" onkeyup="BU.checkrolename('countryName','countrymast','Country_Name');validate.require('CountryName','errorhidreq1');"/>
                           </div>
                      </div>
                    </div>
                        
                </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-9 col-md-3">
                    <button type="button" onclick="validate.require('CountryName','errorhidreq1');BU.busubmit('<?php echo $headername; ?>','<?php echo $formid; ?>','countrymast','Country','Country','errorhid','errorhidreq','edit_country');" class="btn blue"  id="subbut" ><?php echo$buttonVal; ?></button>
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