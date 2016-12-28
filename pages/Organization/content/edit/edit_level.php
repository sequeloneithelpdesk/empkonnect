<?php
if (isset($_GET['olevelCode']) && !empty($_GET['olevelCode'])) {
    include $_SERVER['DOCUMENT_ROOT'] . "/pages/HRMSClass/HRMSClass.php";
    $obj = new HRMSClass;
    $colValue = $_GET['olevelCode'];
    $row = $obj->GetData("levelmast", "levelCode", $colValue);
    $levelCode = $row['LEVEL_Code'];
    $levelName = $row['LEVEL_Name'];
    //$tableType = $row['tableType'];
    ?>
    <form action="#" id="form_sample_2" class="form-horizontal">
        <div class="form-body">
            <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button>
                You have some form errors. Please check below.
            </div>
            <div class="alert alert-success display-hide">
                <button class="close" data-close="alert"></button>
                Level Updated successfully!
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <label class="control-label">Level Code <span class="required">
                                * </span>
                        </label></br>
                        <input type="hidden" name="olevelCode" value="<?php echo $colValue; ?>" class="form-control"/>
                        <input type="text" name="levelCode" class="form-control" value="<?php echo $levelCode; ?>"/>
                    </div>
                    <div class="col-md-6">                          
                        <label class="control-label">Level Name <span class="required">
                                * </span>
                        </label></br>
                        <input name="levelName" type="text" class="form-control" value="<?php echo $levelName; ?>"/>
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
<?php } ?>
