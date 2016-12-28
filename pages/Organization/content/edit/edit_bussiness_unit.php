<?php
 session_start();
include $_SERVER['DOCUMENT_ROOT'].$_SESSION['root']."pages/HRMSClass/HRMSFunction.php";
if(isset($_GET['BUSSID']) && !empty($_GET['BUSSID']) && $_GET['BUSSID']!= 'NA'){
    $colValue = $_GET['BUSSID'];
    $row = GetData("BussMast","BUSSID",$colValue);
    $bussCode   = $row['Buss_Code'];
    $bussName   = $row['BussName'];
    $bussHname  = $row['BussHname'];
    $bussReport = $row['BussReport'];
    $bussAbt    = $row['BussAbt'];

    $buttonVal="Update";
    $formid="form_bu";
    $headername="Edit";

    ?>
<?php }
else{
    $colValue="";
    $bussCode   = "";
    $bussName   = "";
    $bussHname  = "";
    $bussReport = "";
    $bussAbt    = "";

    $buttonVal="Create";
    $formid="form_bu";
    $headername="Add";
}


?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title"><div class="caption"><b><?php echo $headername; ?> Bussiness Unit Details</b></div></h4>
</div>
<div class="modal-body">
<form action="#" id="<?php echo$formid; ?>" class="form-horizontal">
  <div class="form-body">
    <div id="err" class="alert alert-danger display-hide">

    </div>
    <div id="succ" class="alert alert-success display-hide">
        <button class="close" data-close="alert"></button>
        Business Unit <?php echo$buttonVal; ?>d successfully!
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
          <label class="control-label">Business Unit Code
          </label></br>
          <input type="hidden" name="BUSSID" class="form-control" value="<?php echo $colValue;?>" />
          <input type="text" name="bussCode" id="bussCode" class="form-control" onkeyup="BU.checkrolename('bussCode','bussmast','buss_Code'); validate.SpecialChar('bussCode');" value="<?php echo $bussCode;?>"/>
        </div>
        <div class="col-md-4">                          
          <label class="control-label">Business Unit Name <span class="required">
            * </span>
          </label></br>
          <input name="bussName" id="bussName" maxlength='10' onkeyup="BU.checkrolename('bussName','bussmast','bussName'); validate.require('bussName','errorhidreq1');" type="text" class="form-control" value="<?php echo $bussName;?>"/>
        </div>
        <div class="col-md-4">                          
          <label class="control-label">Business Unit Head Name 
          </label></br>
          <select name="bussHname" id="bussHname"  class="bs-select form-control usercodes bs-searchbox" >
              <?php echo HRDMasterList($bussHname); ?>
              </select>
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-12">
        <!--<div class="col-md-4">
          <label class="control-label">Reporting Business Unit
          </label></br>
          <select name="bussReport" id="bussReport" class="bs-select form-control usercodes bs-searchbox" >
              <?php //echo HRDMasterList($bussReport); ?>
            </select>
        </div> -->
        <div class="col-md-4">                          
          <label class="control-label">About Business Unit
          </label></br>
          <textarea name="bussAbt" class="form-control"  cols="10" rows="1"><?php echo $bussAbt;?></textarea>
        </div>
      </div>
    </div>


    </div>
    <div class="form-actions">
        <div class="row">
            <div class="col-md-offset-9 col-md-3">
                <button type="button" onclick="validate.require('bussName','errorhidreq1') ; BU.busubmit('<?php echo $headername; ?>','<?php echo $formid; ?>','bussmast','buss','Business Unit','errorhid','errorhidreq','edit_business_unit');" class="btn blue"  id="subbut" ><?php echo$buttonVal; ?></button>
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

