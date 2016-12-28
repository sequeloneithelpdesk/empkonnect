<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'].$_SESSION['root']."pages/HRMSClass/HRMSFunction.php";
if (isset($_GET['bankCode']) && !empty($_GET['bankCode']) && $_GET['bankCode']!= 'NA') {

    $colValue = $_GET['bankCode'];
    $row = GetData("bankmast","bankID",$colValue);
    $bankCode     = $row['BANK_CODE'];
    $bankName     = $row['BANK_NAME'];
    $bankBranch   = $row['BANK_BRANCH'];
    $bankIFSC     = $row['BANK_IFSC'];
    $bankMICR     = $row['BANK_MICR'];
    $bankType     = $row['BankType'];
    $compIFSC     = $row['COMP_IFSC'];
    $compMICR     = $row['COMP_MICR'];
    $compBankAcNo = $row['COMP_BANK_ACNO'];
    $buttonVal="Update";
    $formid="form_bank";
    $headername="Edit";
}
else {
    $colValue ="";
    $bankCode     = "";
    $bankName     = "";
    $bankBranch   = "";
    $bankIFSC     = "";
    $bankMICR     = "";
    $bankType     = "";
    $compIFSC     = "";
    $compMICR     = "";
    $compBankAcNo = "";
    $buttonVal="Submit";
    $formid="form_bank";
    $headername="Add";
}
    
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title"><div class="caption"><b><?php echo $headername; ?> Bank Details</b></div></h4>
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
                Bank Details <?php echo$buttonVal; ?>d Successfully.
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-6 rolename_availability_result" id="rolename_availability_result">

                    </div>
                </div>
            </div>
        <div class="form-group">
          <div class="col-md-12">
            <div class="col-md-4">
              <label class="control-label">Bank Code
              </label></br>
              <input type="hidden" name="oldBankCode" class="form-control" value="<?php echo $colValue;?>"/>
              <input type="text" name="bankCode" id="bankCode" class="form-control" required="required" value="<?php echo $bankCode;?>" onkeyup="BU.checkrolename('bankCode','bankmast','Bank_CODE');validate.SpecialChar('bankCode');"/>
          </div>
             <div class="col-md-4">                          
              <label class="control-label">Bank Name <span class="required">
              * </span>
              </label></br>
                <input name="bankName" id="bankName" type="text" class="form-control" required="required" value="<?php echo $bankName;?>" onchange="validate.require('bankName','errorhidreq1')"/>
             </div>
             <div class="col-md-4">                          
              <label class="control-label">Bank Branch<span class="required">
              * </span>
              </label></br>
                <input name="bankBranch" id="bankBranch" type="text" class="form-control" required="required" value="<?php echo $bankBranch;?>" onchange="validate.require('bankBranch','errorhidreq2')"/>
             </div>
        </div>
      </div>
      <div class="form-group">
        <div class="col-md-12">
          <div class="col-md-4">
              <label class="control-label">IFSC Code<span class="required">
              * </span>
              </label></br> 
              <input type="text" name="bankIFSC" id="bankIFSC" class="form-control" required="required" value="<?php echo $bankIFSC;?>" onchange="validate.require('bankIFSC','errorhidreq3')"/>
          </div>
          <div class="col-md-4">                          
            <label class="control-label">MICR Code<span class="not-required">
            </span>
            </label></br>
            <input name="bankMICR" id="bankMICR" type="text" class="form-control" value="<?php echo $bankMICR;?>"/>
          </div>
          <div class="col-md-4">                          
            <label class="control-label">Bank Type
            </label></br>
            <select name="bankType" id="bankType" class="form-control" required="required">
              <option value="sal" <?PHP  if($bankType=="sal"){ echo'selected'; } else {} ?>>Salary</option>
                <option value="reim" <?PHP  if($bankType=="reim"){ echo'selected'; } else {} ?>>Reimbursement</option>
            </select>

          </div>
          
        </div>
        <!-- <div class="col-md-12">
            <div class="col-md-8">                          
             <label class="control-label">Bank Address<span class="not-required">
             </span>
             </label></br>
             <textarea name="bankAddress" id="bankAddress" type="text" class="form-control" cols="10" rows="1"><?php echo $bankAddress;?></textarea>
             </div>
             <div class="col-md-4">
              <label class="control-label">Bank Phone<span class="not-required"></span>
              </label></br>
              <input name="bankPhone" type="text" class="form-control" value="<?php echo $bankPhone;?>" />
             </div>
          </div>-->
      </div>
      <!-- <div class="form-group">
        <div class="col-md-12">
            <div class="col-md-4">
              <label class="control-label">City<span class="not-required">
               </span>
              </label></br>
              <input type="text" name="bankCity" class="form-control" value="<?php echo $bankCity;?>"/>
            </div>
             
             <div class="col-md-4">                          
              <label class="control-label">State<span class="not-required">
              </span>
              </label></br>
                <input name="bankState" type="text" class="form-control" value="<?php echo $bankState;?>"/>
             </div>
             <div class="col-md-4">                          
              <label class="control-label">Pincode<span class="required">
               </span>
              </label></br>
                <input name="bankPin" type="text" class="form-control" maxlength="6" placeholder="" value="<?php echo $bankPin;?>"/>
             </div>
        </div>
      </div> -->
      <div class="form-group">
        <div class="col-md-12">
          <h4><strong>Company Bank Detail</strong></h4>
        </div>
        <div class="col-md-12">
          <div class="col-md-4">
              <label class="control-label">IFSC Code<span class="required">
              * </span>
              </label></br>
              <input type="text" name="compIFSC" id="compIFSC" class="form-control" value="<?php echo $compIFSC;?>" onchange="validate.require('compIFSC','errorhidreq4')"/>
          </div>
          <div class="col-md-4">
              <label class="control-label">MICR Code<span class="required">
              * </span>
              </label></br>
              <input type="text" name="compMICR" id="compMICR" class="form-control" value="<?php echo $compMICR;?>" onchange="validate.require('compMICR','errorhidreq5')"/>
          </div>
          <div class="col-md-4">
              <label class="control-label">Account Number<span class="required">
              * </span>
              </label></br>
              <input type="text" name="compBankAcNo" id="compBankAcNo" class="form-control" value="<?php echo $compBankAcNo;?>" onchange="validate.require('compBankAcNo','errorhidreq6')"/>
          </div>
        </div>
      </div>
  </div>
    <div class="form-actions">
        <div class="row">
            <div class="col-md-offset-9 col-md-3">
                <button type="button" onclick="validate.require('bankName','errorhidreq1');validate.require('bankBranch','errorhidreq2');
                    validate.require('bankIFSC','errorhidreq3');validate.require('compIFSC','errorhidreq4');
                    validate.require('compMICR','errorhidreq5');validate.require('compBankAcNo','errorhidreq6');
                    BU.busubmit('<?php echo $headername; ?>','<?php echo $formid; ?>','BankMast','Bank','Bank','errorhid','errorhidreq','edit_bank_details');" class="btn blue"  id="subbut" ><?php echo$buttonVal; ?></button>
                <button type="button" data-dismiss="modal" class="btn default">Cancel</button>
            </div>
        </div>
    </div>
    <input type="hidden" id="errorhid" value="1">
    <input type="hidden" id="errorhidreq1" value="1">
    <input type="hidden" id="errorhidreq2" value="1">
    <input type="hidden" id="errorhidreq3" value="1">
    <input type="hidden" id="errorhidreq4" value="1">
    <input type="hidden" id="errorhidreq5" value="1">
</form>

</div>
