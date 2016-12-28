<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'].$_SESSION['root']."pages/HRMSClass/HRMSFunction.php";
if (isset($_GET['wlid']) && !empty($_GET['wlid']) && $_GET['wlid']!= 'NA') {
  $wlid = $_GET['wlid'];
    $row = GetData("WorkLocMast", "workLOCID", $wlid);
      $wLocCode =$row['WLOC_CODE'];
      $wLocName = $row['WLOC_NAME'];
      $wLocAdd1 = $row['WLOC_ADD1'];
      $wLocAdd2 = $row['WLOC_ADD2'];
      $wLocCity = $row['WLOC_CITY'];
      $wLocState = $row['WLOC_STATE'];
      $wLocPin = $row['WLOC_PIN'];
      $wLocCountry = $row['WLOC_COUNTRY'];
    $wLocTimeZone = $row['wlocTimeZone'];
    $wLocCurrency = $row['wlocCurrency'];
    $buttonVal="Update";
    $formid="form_wloc";
    $headername="Edit";

    ?>
<?php }
else{
    $wlid = "";
    $wLocCode ="";
    $wLocName = "";
    $wLocAdd1 = "";
    $wLocAdd2 = "";
    $wLocCity ="";
    $wLocState = "";
    $wLocPin = "";
    $wLocCountry = "";
    $wLocTimeZone = "";
    $wLocCurrency = "";
    $buttonVal="Submit";
    $formid="form_wloc";
    $headername="Add";
}
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title"><div class="caption"><b><?php echo $headername; ?> Work Location Details</b></div></h4>
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
                Work Location <?php echo$buttonVal; ?>d Successfully.
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
                  <label class="control-label">Work Location Code
                  </label></br> <input type="hidden" name="wlid"  class="form-control" value="<?php echo $wlid; ?>"/>
                            <input type="text" name="wlocCode" id="wlocCode" onkeyup="BU.checkrolename('wlocCode','WorkLocMast','wloc_Code');validate.SpecialChar('wlocCode');" class="form-control" value="<?php echo $wLocCode; ?>"/>
                        </div>
                           <div class="col-md-4">                          
                            <label class="control-label">Work Location Name <span class="required">
                            * </span>
                            </label></br>
                              <input name="wlocName" id="wlocName" type="text" class="form-control" onkeyup="BU.checkrolename('wlocName','WorkLocMast','wloc_Name');validate.require('wlocName','errorhidreq1');" value="<?php echo $wLocName; ?>"/>
                           </div>

                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12">

                           <div class="col-md-6">
                            <label class="control-label">Address 1 <span class="not-required">
                             </span>
                            </label></br>
                              <textarea name="wlocAdd1" class="form-control" cols="10" rows="1"><?php echo $wLocAdd1; ?></textarea>
                           </div>
                          <div class="col-md-6">
                              <label class="control-label">Address 2 <span class="not-required">
                             </span>
                              </label></br>
                              <textarea name="wlocAdd2" class="form-control" cols="10" rows="1"><?php echo $wLocAdd2; ?></textarea>
                          </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12">
                          <div class="col-md-4">
                              <label class="control-label">Country<span class="required">*
                             </span>
                              </label></br>
                              <select name="wlocCountry" id="CountryId" class="bs-select form-control usercodes bs-searchbox" onchange="CountryState(this.value,'StateID'); validate.require('CountryId','errorhidreq2');">
                                  <?php  echo CountryList($wLocCountry) ; ?>
                              </select>

                          </div>

                           <div class="col-md-4">                          
                            <label class="control-label">State<span class="not-required">
                             </span>
                            </label></br>
                               <select name="wlocState" id="StateID" class="bs-select form-control usercodes bs-searchbox" onchange="StateCity(this.value,'CityID')">
                                   <?php  echo StateList($wLocCountry,$wLocState) ; ?>
                               </select>
                              </div>
                          <div class="col-md-4">
                              <label class="control-label">City<span class="not-required">
                             </span>
                              </label></br>
                              <select name="wlocCity" id="CityID" class="form-control" >
                                  <?php  echo CityList($wLocState,$wLocCity) ; ?>
                              </select>
                               </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12">
                        <div class="col-md-4">
                            <label class="control-label">Pincode No. <span class="not-required">
                             </span>
                            </label></br>
                            <input type="text" name="wlocPin" id="wlocPin" value="<?php echo $wLocPin; ?>" placeholder="numeric values Only" class="form-control" onkeypress="javascript:return isNumber(event)"/>
                        </div>
                          <div class="col-md-4">
                              <label class="control-label">Location Time Zone<span class="required">
                            *</span>
                              </label></br>
                              <select name="wloc_timezone" id="wloc_timezone" class="bs-select form-control usercodes" onchange="validate.require('wloc_timezone','errorhidreq3')">
                                  <option value="0">Please, select timezone</option>
                                  <?php $data=tz_list();

                                  foreach ($data as $t) {
                                      ?>
                                      <option value="<?php echo $t['zone'] ?>" <?php if($wLocTimeZone == $t['zone']){echo 'selected'; }  else{} ?> >
                                          <?php echo  $t['zone'] ?>
                                      </option>
                                  <?php } ?>

                              </select>
                          </div>
                          <div class="col-md-4">
                              <label class="control-label">Currency List<span class="required">
                            *</span>
                              </label></br>
                              <select name="wlocCurrency" id="wlocCurrency" class="bs-select form-control usercodes" onchange="validate.require('wlocCurrency','errorhidreq4')">
                                  <option value="0">Please, Select Currency</option>
                                  <?php
                                  $currencyData=CurrencyList();
                                  foreach($currencyData as $key => $value) { ?>
                                      <option value="<?php echo $key; ?>" <?php if($wLocCurrency == $key){echo'selected'; }  else{ }  ?> >
                                          <?php echo $value; ?>
                                      </option>
                                  <?php } ?>
                                  </option>
                              </select>
                          </div>
                           
                      </div>
                    </div>
                    
                </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-9 col-md-3">
                    <button type="button" onclick="validate.require('wlocCurrency','errorhidreq4');validate.require('wlocName','errorhidreq1');
                        validate.require('CountryId','errorhidreq2');validate.require('wloc_timezone','errorhidreq3');BU.busubmit('<?php echo $headername; ?>','<?php echo $formid; ?>','WorkLocMast','WLoc','Work Location','errorhid','errorhidreq','edit_work_location');" class="btn blue"  id="subbut" ><?php echo$buttonVal; ?></button>
                    <button type="button" data-dismiss="modal" class="btn default">Cancel</button>
                </div>
            </div>
        </div>
        <input type="hidden" id="errorhid" value="0">
        <input type="hidden" id="errorhidreq1" value="1">
        <input type="hidden" id="errorhidreq2" value="1">
        <input type="hidden" id="errorhidreq3" value="1">
        <input type="hidden" id="errorhidreq4" value="1">
        <input type="hidden" id="errorhidreq5" value="0">
    </form>

</div>
