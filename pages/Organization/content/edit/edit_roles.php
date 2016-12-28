<?php
if (isset($_GET['oroleCODE']) &&!empty($_GET['oroleCODE'])) {
    include $_SERVER['DOCUMENT_ROOT'] . "/pages/HRMSClass/HRMSClass.php";
    $obj = new HRMSClass;
    $colValue = $_GET['oroleCODE'];
    $row = $obj->GetData("rolemast", "ROLE_CODE", $colValue);
    $roleCODE = $row['ROLE_NAME'];
    $roleNAME = $row['roleNAME'];
    $roleGrp = $row['Role_Grp'];
    $roleMngr = $row['Role_Mngr'];
    $roleProfile = $row['Role_Profile'];
    $roleQuali = $row['Role_Quali'];
    $roleSkill = $row['Role_Skill'];
    $roleExp = $row['Role_Exp'];
    $roleOther = $row['Role_Other'];
    $roleJobDesc = $row['Role_JobDesc'];
    $roleHiringTime = $row['Role_HiringTime'];
   
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
            New Role Added successfully!
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <div class="col-md-4">
                    <label class="control-label">Role Code <span class="required">
                            * </span>
                    </label></br>
                    <input type="hidden" name="oroleCODE" class="form-control" value="<?php echo $colValue; ?>"/>
                    <input type="text" name="roleCODE" class="form-control" value="<?php echo $roleCODE; ?>"/>
                </div>
                <div class="col-md-4">                          
                    <label class="control-label">Role Name <span class="required">
                            * </span>
                    </label></br>
                    <input name="roleNAME" type="text" class="form-control" value="<?php echo $roleNAME; ?>"/>
                </div>
                <div class="col-md-4">                          
                    <label class="control-label">Role Group<span class="required">
                            * </span>
                    </label></br>
                    <input name="roleGrp" type="text" class="form-control" value="<?php echo $roleGrp; ?>"/>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <div class="col-md-4">
                    <label class="control-label">Role Reporting Manager<span class="required">
                            * </span>
                    </label></br>
                    <input type="text" name="roleMngr" class="form-control" value="<?php echo $roleMngr; ?>"/>
                </div>
                <div class="col-md-4">                          
                    <label class="control-label">Role Profile<span class="not-required">
                        </span>
                    </label></br>
                    <input name="roleProfile" type="text" class="form-control" value="<?php echo $roleProfile; ?>"/>
                </div>
                <div class="col-md-4">                          
                    <label class="control-label">Qualification For Role<span class="not-required">
                        </span>
                    </label></br>
                    <textarea name="roleQuali" type="text" class="form-control" cols="10" rows="1" value="<?php echo $roleQuali; ?>"></textarea>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <div class="col-md-4">
                    <label class="control-label">Skills For Role<span class="not-required">
                        </span>
                    </label></br>
                    <input type="text" name="roleSkill" class="form-control" value="<?php echo $roleSkill; ?>"/>
                </div>
                <div class="col-md-4">                          
                    <label class="control-label">Experience For Role<span class="required">
                        </span>
                    </label></br>
                    <input name="roleExp" type="text" class="form-control" placeholder="" value="<?php echo $roleExp; ?>"/>
                </div>
                <div class="col-md-4">                          
                    <label class="control-label">Other Requirements<span class="not-required">
                        </span>
                    </label></br>
                    <input name="roleOther" type="text" class="form-control" value="<?php echo $roleOther; ?>"/>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <div class="col-md-4">
                    <label class="control-label">Job Description<span class="not-required">
                        </span>
                    </label></br>
                    <input type="text" name="roleJobDesc" class="form-control" value="<?php echo $roleJobDesc; ?>"/>
                </div>
                <div class="col-md-4">                          
                    <label class="control-label">Role Hiring Time<span class="not-required">
                        </span>
                    </label></br>
                    <input name="roleHiringTime" type="text" class="form-control" placeholder="" value="<?php echo $roleHiringTime; ?>"/>
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
}
?>
