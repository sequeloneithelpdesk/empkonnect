<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'].$_SESSION['root']."pages/HRMSClass/HRMSFunction.php";
if(isset($_GET['subBussID']) && !empty($_GET['subBussID']) && $_GET['subBussID']!= 'NA'){
    $colValue = $_GET['subBussID'];
    $row = GetData("subBussMast","subBussID",$colValue);
    $subBussCode   = $row['subBuss_Code'];
    $subBussName   = $row['subBussName'];
    $subBussHname  = $row['subBussHname'];
    $subBussReport = $row['subBussReport'];
    $subBussAbt    = $row['subBussAbt'];

    $buttonVal="Update";
    $formid="form_sbu";
    $headername="Edit";

    ?>
<?php }
else{
    $colValue="";
    $subBussCode   = "";
    $subBussName   = "";
    $subBussHname  = "";
    $subBussReport = "";
    $subBussAbt    = "";

    $buttonVal="Create";
    $formid="form_sbu";
    $headername="Add";
}


?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title"><div class="caption"><b><?php echo $headername; ?> SubBussiness Unit Details</b></div></h4>
</div>
<div class="modal-body">
    <form action="#" id="<?php echo$formid; ?>" class="form-horizontal">
        <div class="form-body">
            <div id="err" class="alert alert-danger display-hide">

            </div>
            <div id="succ" class="alert alert-success display-hide">
                <button class="close" data-close="alert"></button>
                SubBusiness Unit <?php echo$buttonVal; ?>d successfully!
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
                        <label class="control-label">SubBusiness Unit Code
                        </label></br>
                        <input type="hidden" name="subBussID" class="form-control" value="<?php echo $colValue;?>" />
                        <input type="text" name="subBussCode" id="subBussCode" class="form-control" onkeyup="BU.checkrolename('subBussCode','subBussmast','subBuss_Code'); validate.SpecialChar('subBussCode');" value="<?php echo $subBussCode;?>"/>
                    </div>
                    <div class="col-md-4">
                        <label class="control-label">SubBusiness Unit Name <span class="required">
            * </span>
                        </label></br>
                        <input name="subBussName" id="subBussName" onkeyup="BU.checkrolename('subBussName','subBussmast','subBussName'); validate.require('subBussName','errorhidreq1');" type="text" class="form-control" value="<?php echo $subBussName;?>"/>
                    </div>
                    <div class="col-md-4">
                        <label class="control-label">SubBusiness Unit Head Name
                        </label></br>
                        <select name="subBussHname" id="subBussHname"  class="bs-select form-control usercodes bs-searchbox" >
                            <?php echo HRDMasterList($subBussHname); ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-4">
          <label class="control-label">Reporting Business Unit
          </label></br>
          <select name="subBussReport" id="subBussReport" class="bs-select form-control usercodes bs-searchbox" >
              <?php echo bussList($subBussReport); ?>
            </select>
        </div>
                    <div class="col-md-4">
                        <label class="control-label">About SubBusiness Unit
                        </label></br>
          <textarea name="subBussAbt" class="form-control"  cols="10" rows="1"><?php echo $subBussAbt;?>
              </textarea>
                    </div>
                </div>
            </div>


        </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-9 col-md-3">
                    <button type="button" onclick="validate.require('subBussName','errorhidreq1') ; BU.busubmit('<?php echo $headername; ?>','<?php echo $formid; ?>','subBussmast','subBuss','SubBusiness Unit','errorhid','errorhidreq','edit_subBusiness_unit');" class="btn blue"  id="subbut" ><?php echo$buttonVal; ?></button>
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

