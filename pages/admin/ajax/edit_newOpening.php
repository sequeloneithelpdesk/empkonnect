<?php

include "../../db_conn.php";

$action = $_POST['action'];
$action_val = explode(',',$action);
$sqlq="select * from Vacancy where Vacancy_Code='$action_val[1]'";
$resultq=sqlsrv_query($conn,$sqlq, array(), array( "Scrollable" => 'static' ));
if(sqlsrv_num_rows($resultq)) {

while ($rowq = sqlsrv_fetch_array($resultq)) {
?>
<form enctype="multipart/form-data" id="form5" name="editnewOpening"
      class="form-horizontal form-row-seperated">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="close"></button>
        <h4 class="modal-title"><b>Edit Vacancy</b> </h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
                <label class="control-label col-md-3">Designation Code</label>
                <div class="col-md-3">
                    <div class="input-group">
                       <input class="form-control form-control-inline input-medium" type="text" id="Dcode" value="<?php echo $rowq['Dsg_Code'];?>"/>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label class="control-label col-md-3">Location Code</label>
                <div class="col-md-3">
                    <div class="input-group">
                        <input class="form-control form-control-inline input-medium"  type="text" id="Lcode" value="<?php echo $rowq['Loc_Code'];?>"/>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <label class="control-label col-md-3">Department Code</label>
                <div class="col-md-3">
                    <div class="input-group">
                        <input class="form-control form-control-inline input-medium" type="text" id="Depcode" value="<?php echo $rowq['Dept_Code'];?>"/>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label class="control-label col-md-3">Process Code</label>
                <div class="col-md-3">
                    <div class="input-group">
                        <input class="form-control form-control-inline input-medium"  type="text" id="Pcode" value="<?php echo $rowq['Proc_Code'];?>"/>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <label class="control-label col-md-3">No of Vacancies</label>
                <div class="col-md-3">
                    <div class="input-group">
                        <input class="form-control form-control-inline input-medium" type="text" id="NoVac" value="<?php echo $rowq['Wanted_No'];?>"/>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label class="control-label col-md-3">Source Person</label>
                <div class="col-md-3">
                    <div class="input-group">
                        <input class="form-control form-control-inline input-medium"  type="text" id="sp" value="<?php echo $rowq['SourcePerson'];?>"/>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <label class="control-label col-md-3">Open Date</label>
                <div class="col-md-3">
                    <div class="input-group">
                        <input class="form-control form-control-inline input-medium" type="text" id="odate" value="<?php echo $rowq['Opn_Date'];?>"/>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label class="control-label col-md-3">Close Date</label>
                <div class="col-md-3">
                    <div class="input-group">
                        <input class="form-control form-control-inline input-medium"  type="text" id="cdate" value="<?php echo $rowq['Cls_Date'];?>"/>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <label class="control-label col-md-3">Experience To</label>
                <div class="col-md-3">
                    <div class="input-group">
                        <input class="form-control form-control-inline input-medium" type="text" id="expTo" value="<?php echo $rowq['Exp_To'];?>"/>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label class="control-label col-md-3">Experience From</label>
                <div class="col-md-3">
                    <div class="input-group">
                        <input class="form-control form-control-inline input-medium"  type="text" id="expFrom" value="<?php echo $rowq['Exp_From'];?>"/>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <label class="control-label col-md-3">Proposed Salary</label>
                <div class="col-md-3">
                    <div class="input-group">
                        <input class="form-control form-control-inline input-medium" type="text" id="salary" value="<?php echo $rowq['ProposedSalary'];?>"/>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label class="control-label col-md-3">Sex</label>
                <div class="col-md-3">
                    <div class="input-group">
                        <input class="form-control form-control-inline input-medium"  type="text" id="sex" value="<?php echo $rowq['Sex'];?>"/>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <label class="control-label col-md-3">Age To</label>
                <div class="col-md-3">
                    <div class="input-group">
                        <input class="form-control form-control-inline input-medium" type="text" id="ageTo" value="<?php echo $rowq['Age_To'];?>"/>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label class="control-label col-md-3">Age From</label>
                <div class="col-md-3">
                    <div class="input-group">
                        <input class="form-control form-control-inline input-medium"  type="text" id="ageFrom" value="<?php echo $rowq['Age_From'];?>"/>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <label class="control-label col-md-3">Vacancy Reason</label>
                <div class="col-md-3">
                    <div class="input-group">
                        <input class="form-control form-control-inline input-medium" type="text" id="vReason" value="<?php echo $rowq['VacancyReason'];?>"/>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label class="control-label col-md-3">Vacancy Type</label>
                <div class="col-md-3">
                    <div class="input-group">
                        <input class="form-control form-control-inline input-medium"  type="text" id="vtype" value="<?php echo $rowq['VacancyType'];?>"/>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <label class="control-label col-md-3">Job Profile</label>
                <div class="col-md-3">
                    <div class="input-group">
                        <input class="form-control form-control-inline input-medium" type="text" id="profile" value="<?php echo $rowq['JobProfile'];?>"/>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label class="control-label col-md-3">Vacancy Status</label>
                <div class="col-md-3">
                    <div class="input-group">
                        <input class="form-control form-control-inline input-medium"  type="text" id="vstatus" value="<?php echo $rowq['VacancyStatus'];?>"/>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <label class="control-label col-md-3">Title</label>
                <div class="col-md-3">
                    <div class="input-group">
                        <input class="form-control form-control-inline input-medium"  type="text" id="title" value="<?php echo $rowq['Title'];?>"/>
                    </div>
                </div>
            </div>
            <?php
            }
            }
            $sqlq="select * from VacancyQual where Vacancy_Code='$action_val[1]'";
            $resultq=sqlsrv_query($conn,$sqlq, array(), array( "Scrollable" => 'static' ));
            if(sqlsrv_num_rows($resultq)) {

            while ($rowq = sqlsrv_fetch_array($resultq)) {
            ?>
            <div class="col-md-6">
                <label class="control-label col-md-3">Qualification Required</label>
                <div class="col-md-3">
                    <div class="input-group">
                        <input class="form-control form-control-inline input-medium" type="text" id="qual" value="<?php echo $rowq['Qual_Code'];?>"/>
                    </div>
                </div>
            </div>
<?php } } ?>
        </div>
        <hr>
        <?php
        $sqlq="select * from VacancySkills where Vacancy_Code='$action_val[1]'";
        $resultq=sqlsrv_query($conn,$sqlq, array(), array( "Scrollable" => 'static' ));
        if(sqlsrv_num_rows($resultq)) {

        while ($rowq = sqlsrv_fetch_array($resultq)) {
        ?>
        <div class="row">
            <div class="col-md-6">
                <label class="control-label col-md-3">Skills Required</label>
                <div class="col-md-3">
                    <div class="input-group">
                        <input class="form-control form-control-inline input-medium"  type="text" id="skill" value="<?php echo $rowq['Skill_Code'];?>"/>
                    </div>
                </div>
            </div>

        </div>
        <?php }} ?>
    </div>
    </div>
    <div class="modal-footer">

        <button type="button" class="btn green" id="createOpening" value="edit"><i class="fa fa-check"></i>Submit
        </button>
        <input type="hidden" id="hiddenid" value="<?php echo $action_val[1]; ?>" />
    </div>

</form>