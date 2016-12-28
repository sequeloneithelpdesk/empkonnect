<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'].$_SESSION['root']."pages/HRMSClass/HRMSFunction.php";
if (isset($_GET['oid']) && !empty($_GET['oid']) && $_GET['oid']!= 'NA') {

    $colValue = $_GET['oid'];
    $row = GetData("LocMast", "LOCID", $colValue);
    $locCode = $row['LOC_CODE'];
    $locName = $row['LOC_NAME'];
    $locType = $row['LOC_TYPE'];
    $locParent = $row['LOC_PARENT'];
    $locWork = $row['WORK_LOC'];
    $locAdd1 = $row['LOC_ADDR1'];
    $locAdd2 = $row['LOC_ADDR2'];
    $locCity = $row['CITY'];
    $locState = $row['LOC_STATE'];
    $locPin = $row['PIN_CODE'];
    $locCountry = $row['COUNTRY'];
    $locPfCode = $row['PF_CODE'];
    $locEsiCode = $row['ESI_CODE'];
    $locTimeZone = $row['locTimeZone'];
    $locCurrency = $row['locCurrency'];
    $buttonVal="Update";
    $formid="form_loc";
    $headername="Edit";

    ?>
<?php }
else{
    $colValue ="";
    $locCode = "";
    $locName = "";
    $locType = "";
    $locParent = "";
    $locWork = "";
    $locAdd1 = "";
    $locAdd2 = "";
    $locCity = "";
    $locState = "";
    $locPin = "";
    $locCountry = "";
    $locPfCode = "";
    $locEsiCode = "";
    $locTimeZone ="";
    $locCurrency = "";
    $buttonVal="Create";
    $formid="form_loc";
    $headername="Add";
}


?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title"><div class="caption"><b><?php echo $headername; ?> Location Details</b></div></h4>
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
                Location <?php echo$buttonVal; ?>d Successfully.
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
                        <label class="control-label">Location Code
                        </label></br>
                        <input type="hidden" name="locId"  class="form-control" value="<?php echo $colValue; ?>"/>
                        <input type="text" name="locCode" id="locCode" onkeyup="BU.checkrolename('locCode','locmast','loc_Code');validate.SpecialChar('locCode');" class="form-control" value="<?php echo $locCode; ?>"/>
                    </div>
                    <div class="col-md-4">                          
                        <label class="control-label">Location Name <span class="required">
                                * </span>
                        </label></br>
                        <input name="locName" id="locName" type="text" onkeyup="BU.checkrolename('locName','locmast','loc_Name'); validate.require('locName','errorhidreq1');" class="form-control" value="<?php echo $locName; ?>"/>
                    </div>

                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <!-- <div class="col-md-4">
                        <label class="control-label">This is also a WorkLocation
                        </label></br>
                        <input type="checkbox" name="locwork" value="<?php echo $locParent; ?>"/>
                    </div>
                    <div class="col-md-4">                          
                        <label class="control-label">Work Location <span class="required">
                                * </span>
                        </label></br>
                        <input name="locWork" type="text" class="form-control" value="<?php echo $locWork; ?>"/>
                    </div>-->
                    <div class="col-md-6">
                        <label class="control-label">Address 1 <span class="not-required">
                            </span>
                        </label></br>
                        <textarea name="locAdd1" class="form-control" cols="10" rows="2" WRAP="HARD"><?php echo $locAdd1; ?> </textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="control-label">Address 2 <span class="not-required">
                            </span>
                        </label></br>
                        <textarea name="locAdd2" class="form-control" cols="10" rows="2" WRAP="HARD"><?php echo $locAdd2; ?> </textarea>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">

                    <div class="col-md-4">
                        <label class="control-label">Country<span class="required">*
                            </span>
                        </label></br>
                        <select name="locCountry" id="CountryId" class="bs-select form-control usercodes bs-searchbox" onchange="CountryState(this.value,'StateID'); validate.require('CountryId','errorhidreq2');">
                            <?php  echo CountryList($locCountry) ; ?>
                        </select>
                    </div>

                    <div class="col-md-4">                          
                        <label class="control-label">State<span class="not-required">
                            </span>
                        </label></br>
                        <select name="locState" id="StateID" class="bs-select form-control usercodes bs-searchbox" onchange="StateCity(this.value,'CityID')">
                            <?php  echo StateList($locCountry,$locState) ; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="control-label">City
                        </label></br>
                        <select name="locCity" id="CityID" class="form-control" >
                            <?php  echo CityList($locState,$locCity) ; ?>
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
                        <input type="text" name="locPin" id="locPin" placeholder="numeric values Only" class="form-control" value="<?php echo $locPin; ?>" onkeypress="javascript:return isNumber(event)"/>
                    </div>

                    <div class="col-md-4">
                        <label class="control-label">Location Time Zone<span class="required">
                            *</span>
                        </label></br>
                        <select name="loc_timezone" id="loc_timezone" class="bs-select form-control usercodes" onchange="validate.require('loc_timezone','errorhidreq3')">
                            <option value="0">Please, select timezone</option>
                            <?php $data=tz_list();
                            $locTimeZone = $row['locTimeZone'];
                            $locCurrency = $row['locCurrency'];
                            foreach ($data as $t) {
                                ?>
                                <option value="<?php echo $t['zone'] ?>" <?php if($locTimeZone == $t['zone']){echo 'selected'; }  else{} ?> >
                                    <?php echo  $t['zone'] ?>
                                </option>
                            <?php } ?>

                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="control-label">Currency List<span class="required">
                            *</span>
                        </label></br>
                        <select name="locCurrency" id="locCurrency" class="bs-select form-control usercodes" onchange="validate.require('locCurrency','errorhidreq4')">
                            <option value="0">Please, Select Currency</option>
                            <?php
                            $currencyData=CurrencyList();
                            foreach($currencyData as $key => $value) { ?>
                                <option value="<?php echo $key; ?>" <?php if($key == $locCurrency){ echo'selected'; }  else{ }  ?> >
                                    <?php echo $value; ?>
                                </option>
                            <?php } ?>
                            
                        </select>
                    </div>
                </div>

                    <!-- <div class="col-md-4">
                        <label class="control-label">PF Code Of Location<span class="not-required">
                            </span>
                        </label></br>
                        <input name="locPfCode" type="text" class="form-control" cols="10" rows="1" value="<?php echo $locPfCode; ?>"/>
                    </div> -->
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <!-- <div class="col-md-4">
                        <label class="control-label">ESI Code Of Location<span class="not-required">
                            </span>
                        </label></br>
                        <input type="text" name="locEsiCode" data-required="1" class="form-control" value="<?php echo $locEsiCode; ?>"/>
                    </div>-->

            </div>
        </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-9 col-md-3">
                    <button type="button" onclick="validate.require('locCurrency','errorhidreq4');validate.require('locName','errorhidreq1');
                    validate.require('CountryId','errorhidreq2');validate.require('loc_timezone','errorhidreq3');BU.busubmit('<?php echo $headername; ?>','<?php echo $formid; ?>','locmast','loc','Location','errorhid','errorhidreq','edit_location');" class="btn blue"  id="subbut" ><?php echo$buttonVal; ?></button>
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

