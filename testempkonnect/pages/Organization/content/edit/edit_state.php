<?php
if(isset($_GET['ostateId']) && !empty($_GET['ostateId'])) {
    include $_SERVER['DOCUMENT_ROOT'] . "/pages/HRMSClass/HRMSClass.php";
    $obj = new HRMSClass;
    $colValue = $_GET['ostateId'];
    $row = $obj->GetData("StateMast", "stateID", $colValue);
    $stateName = $row['State_Name'];
    $countryId = $row['Country_Id'];
    $status = $row['State_Status'];
?>
<form action="#" id="form_sample_2" class="form-horizontal">
        <div class="form-body">
            <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button>
                You have some form errors. Please check below.
            </div>
            <div class="alert alert-success display-hide">
                <button class="close" data-close="alert"></button>
                State Updated successfully!
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <label class="control-label">State Name<span class="required"> * </span></label></br>
                        <input type="hidden" name="ostateId" class="form-control" value="<?php echo $colValue; ?>"/>
                        <input type="text" name="stateName" class="form-control" value="<?php echo $stateName; ?>"/>
                    </div>
                    <div class="col-md-6">                          
                        <label class="control-label">Country ID<?php echo $countryId; ?><span class="required">
                                * </span>
                        </label></br>
                        <?php echo $obj->CountryList($countryId); ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-6">                          
                    <label class="control-label">Status<span class="required"> * </span></label></br>
                    <?php
                        $list = '<select name="status" class="bs-select form-control usercodes"><option value="0">Please, select status</option>';
                        $select1 = $select2 = $select3 = "";
                        if ($status == 1) {
                            $select1 = 'selected';
                        } else if ($status == 0) {
                            $select2 = 'selected';
                        } else {
                            $select3 = "";
                        }
                        $list.='<option value="1" ' . $select1 . '>Active</option><option value="0" ' . $select2 . '>In-Active</option>';
                        $list.='</select>';
                        echo $list;
                        //StatusList($status);
                        ?>
                    </div>
                </div>
            </div>     
        </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-9 col-md-3">
                    <button type="submit" class="btn blue"  id="subbut" >Update</button>
                    <button type="button" data-dismiss="modal" class="btn default">Cancel</button>
                </div>
            </div>
        </div>
    </form>
    <?php
}
?>
