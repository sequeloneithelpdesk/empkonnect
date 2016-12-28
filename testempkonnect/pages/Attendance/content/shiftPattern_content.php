<?php
session_start();
include('../../db_conn.php');
include('../../configdata.php');

//include $_SERVER['DOCUMENT_ROOT'].$_SESSION['root']."pages/HRMSClass/HRMSFunction.php";
if(isset($_GET['ShiftPatternMastId']) && !empty($_GET['ShiftPatternMastId']) && $_GET['ShiftPatternMastId']!= 'NA'){
    $colValue = $_GET['ShiftPatternMastId'];
    $sql="select * from ShiftPatternMast where ShiftPatternMastId='$colValue'";
    $qur=query($query,$sql,$pa,$opt,$ms_db);
    $row = $fetch($qur);
    $shiftPatternCode   = $row['ShiftPattern_Code'];
    $shiftPatternName   = $row['ShiftPattern_Name'];

    $compOff  = $row['CompOff'];
    $IsRepeat = $row['IsRepating'];
    $Off1    = $row['WeeklyOff1'];
    $arrOff1 = explode(',',$Off1);

    $Off2  = $row['WeeklyOff2'];
    $arrOff2 = explode(',',$Off2);

    $Off3 = $row['WeeklyOff3'];
    $arrOff3 = explode(',',$Off3);

    $Off4    = $row['WeeklyOff4'];
    $arrOff4 = explode(',',$Off4);

    $Off5   = $row['WeeklyOff5'];
    $arrOff5 = explode(',',$Off5);

    //$allOff   = $row['allWeekOff'];

    $buttonVal="Update";
    $formid="form_spm";
    $headername="Edit";

    ?>
<?php }
else{
    $colValue="";
    $shiftPatternCode   = "";
    $shiftPatternName   = "";

    $compOff  = "1";
    $IsRepeat = "";
    $arrOff1 =array();
    $arrOff2 =array();
    $arrOff3 =array();
    $arrOff4 =array();
    $arrOff5 =array();
  //  $Off1    = "";
   // $Off2  = "";
    //$Off3 = "";
    //$Off4    = "";
    //$Off5   = "";
    //$allOff   = "";

    $buttonVal="Create";
    $formid="form_spm";
    $headername="Add";
}


?>
<div class="modal-header portlet box blue">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title" style="color:white"><div class="caption"><b><?php echo $headername; ?> Shift Pattern </b></div></h4>
</div>
<div class="modal-body">
    <form action="#" id="<?php echo$formid; ?>" class="form-horizontal">
        <div class="form-body">
            <div id="err" class="alert alert-danger display-hide">

            </div>
            <div id="succ" class="alert alert-success display-hide">
                <button class="close" data-close="alert"></button>
                Shift Master <?php echo$buttonVal; ?>d successfully!
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-6 rolename_availability_result" id="rolename_availability_result">

                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">

                    <div class="col-md-3">
                        <label class="control-label">Shift Pattern Code<span class="required">* </span>
                        </label>
                        </div>
                        <div class="col-md-3">
                        <input type="hidden" name="ShiftPatternMastId" class="form-control" value="<?php echo $colValue;?>" />
                        <input type="text" maxlength="10" name="shiftPatternCode" id="shiftPatternCode" class="form-control" onkeyup="SM.checkrolename('shiftCode','ShiftMast','Shift_Code'); validate.SpecialChar('shiftCode');" value="<?php echo $shiftPatternCode;?>"/>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label">Shift Pattern Name <span class="required">
            * </span>
                        </label>
                    </div>
                    <div class="col-md-3">
                        <input name="shiftPatternName" maxlength="50" id="shiftPatternName" onkeyup="SM.checkrolename('shiftName','ShiftMast','Shift_Name'); validate.require('shiftName','errorhidreq1');" type="text" class="form-control" value="<?php echo $shiftPatternName;?>"/>
                    </div>

                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-3">
                        <label class="control-label">Company Off's Apply?
                        </label>
                    </div>
                    <div class="col-md-3">
                        <input type="checkbox" name="companyOff" id="companyOff" value="<?php echo $compOff ?>" <?php echo ($compOff==1)?'checked':''?>/>
                    </div>
                </div>
            </div>
                       <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-9">
                        <label class="control-label">Is this a repeating pattern for a fixed number of days, independent of weekdays ?
                        </label>
                    </div>
                    <div class="col-md-3">
                        <input name="repeatPattern" id="repeatPattern" type="number" class="form-control" value="<?php echo $IsRepeat?>"/>
                    </div>

                </div>
            </div>

            <div class="form-group" id="shiftdiff" >
                <div class="col-md-12">
                    <div class="col-md-12">
                        <label class="control-label">Weekdays Shift
                        </label></br>
                <table border="1px">
                    <thead>
                        <th>&nbsp; S.No.&nbsp; </th>
                        <th>&nbsp; Week Type &nbsp; </th>
                        <th>&nbsp; Sunday &nbsp; </th>
                        <th>&nbsp;Monday &nbsp;</th>
                        <th>&nbsp;Tuesday&nbsp;</th>
                        <th>&nbsp;Wednesday&nbsp;</th>
                        <th>&nbsp;Thursday&nbsp;</th>
                        <th>&nbsp;Friday&nbsp;</th>
                        <th>&nbsp;Saturday&nbsp;</th>
                    </thead>
                    <tbody>
                    <tr>
                        <td>&nbsp;1</td>
                        <td>&nbsp;All Weeks</td>
                        <td>&nbsp;<input type="checkbox" id="allsun" name="Allweek[]" value="0" onchange="select_all(this.id);"></td>
                        <td>&nbsp;<input type="checkbox" id="allmon" name="Allweek[]" value="0" onchange="select_all(this.id);"></td>
                        <td>&nbsp;<input type="checkbox" id="alltue" name="Allweek[]" value="0" onchange="select_all(this.id);"></td>
                        <td>&nbsp;<input type="checkbox" id="allwed" name="Allweek[]" value="0" onchange="select_all(this.id);"></td>
                        <td>&nbsp;<input type="checkbox" id="allthur" name="Allweek[]" value="0" onchange="select_all(this.id);"></td>
                        <td>&nbsp;<input type="checkbox" id="allfri" name="Allweek[]" value="0" onchange="select_all(this.id);"></td>
                        <td>&nbsp;<input type="checkbox" id="allsat" name="Allweek[]" value="0" onchange="select_all(this.id);"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;2</td>
                        <td>&nbsp;1st Week</td>
                        <td>&nbsp;<input type="checkbox" id="1sun" name="1week[]" value="7" <?php echo (in_array('7',$arrOff1))?'checked':''?>></td>
                        <td>&nbsp;<input type="checkbox" id="1mon" name="1week[]" value="1" <?php echo (in_array('1',$arrOff1))?'checked':''?>></td>
                        <td>&nbsp;<input type="checkbox" id="1tue" name="1week[]" value="2" <?php echo (in_array('2',$arrOff1))?'checked':''?>></td>
                        <td>&nbsp;<input type="checkbox" id="1wed" name="1week[]" value="3" <?php echo (in_array('3',$arrOff1))?'checked':''?>></td>
                        <td>&nbsp;<input type="checkbox" id="1thur" name="1week[]" value="4" <?php echo(in_array('4',$arrOff1))?'checked':''?>></td>
                        <td>&nbsp;<input type="checkbox" id="1fri" name="1week[]" value="5" <?php echo (in_array('5',$arrOff1))?'checked':''?>></td>
                        <td>&nbsp;<input type="checkbox" id="1sat" name="1week[]" value="6" <?php echo (in_array('6',$arrOff1))?'checked':''?>></td>
                    </tr>
                    <tr>
                        <td>&nbsp;3</td>
                        <td>&nbsp;2nd Week</td>
                        <td>&nbsp;<input type="checkbox" id="2sun" name="2week[]" value="7" <?php echo (in_array('7',$arrOff2))?'checked':''?>></td>
                        <td>&nbsp;<input type="checkbox" id="2mon" name="2week[]" value="1" <?php echo (in_array('1',$arrOff2))?'checked':''?>></td>
                        <td>&nbsp;<input type="checkbox" id="2tue" name="2week[]" value="2" <?php echo (in_array('2',$arrOff2))?'checked':''?>></td>
                        <td>&nbsp;<input type="checkbox" id="2wed" name="2week[]" value="3" <?php echo (in_array('3',$arrOff2))?'checked':''?>></td>
                        <td>&nbsp;<input type="checkbox" id="2thur" name="2week[]" value="4"<?php echo (in_array('4',$arrOff2))?'checked':''?>></td>
                        <td>&nbsp;<input type="checkbox" id="2fri" name="2week[]" value="5" <?php echo (in_array('5',$arrOff2))?'checked':''?>></td>
                        <td>&nbsp;<input type="checkbox" id="2sat" name="2week[]" value="6" <?php echo (in_array('6',$arrOff2))?'checked':''?>></td>
                    </tr>
                    <tr>
                        <td>&nbsp;4</td>
                        <td>&nbsp;3rd Week</td>
                        <td>&nbsp;<input type="checkbox" id="3sun" name="3week[]" value="7" <?php echo (in_array('7',$arrOff3))?'checked':''?>></td>
                        <td>&nbsp;<input type="checkbox" id="3mon" name="3week[]" value="1" <?php echo (in_array('1',$arrOff3))?'checked':''?>></td>
                        <td>&nbsp;<input type="checkbox" id="3tue" name="3week[]" value="2" <?php echo (in_array('2',$arrOff3))?'checked':''?>></td>
                        <td>&nbsp;<input type="checkbox" id="3wed" name="3week[]" value="3" <?php echo (in_array('3',$arrOff3))?'checked':''?>></td>
                        <td>&nbsp;<input type="checkbox" id="3thur" name="3week[]" value="4" <?php echo (in_array('4',$arrOff3))?'checked':''?>></td>
                        <td>&nbsp;<input type="checkbox" id="3fri" name="3week[]" value="5" <?php echo (in_array('5',$arrOff3))?'checked':''?>></td>
                        <td>&nbsp;<input type="checkbox" id="3sat" name="3week[]" value="6" <?php echo (in_array('6',$arrOff3))?'checked':''?>></td>
                    </tr>
                    <tr>
                        <td>&nbsp;5</td>
                        <td>&nbsp;4th Week</td>
                        <td>&nbsp;<input type="checkbox" id="4sun" name="4week[]" value="7" <?php echo (in_array('7',$arrOff4))?'checked':''?>></td>
                        <td>&nbsp;<input type="checkbox" id="4mon" name="4week[]" value="1" <?php echo (in_array('1',$arrOff4))?'checked':''?>></td>
                        <td>&nbsp;<input type="checkbox" id="4tue" name="4week[]" value="2" <?php echo (in_array('2',$arrOff4))?'checked':''?>></td>
                        <td>&nbsp;<input type="checkbox" id="4wed" name="4week[]" value="3" <?php echo (in_array('3',$arrOff4))?'checked':''?>></td>
                        <td>&nbsp;<input type="checkbox" id="4thur" name="4week[]" value="4" <?php echo (in_array('4',$arrOff4))?'checked':''?>></td>
                        <td>&nbsp;<input type="checkbox" id="4fri" name="4week[]" value="5" <?php echo (in_array('5',$arrOff4))?'checked':''?>></td>
                        <td>&nbsp;<input type="checkbox" id="4sat" name="4week[]" value="6" <?php echo (in_array('6',$arrOff4))?'checked':''?>></td>
                    </tr>
                    <tr>
                        <td>&nbsp;6</td>
                        <td>&nbsp;5th Week</td>
                        <td>&nbsp;<input type="checkbox" id="5sun" name="5week[]" value="7" <?php echo (in_array('7',$arrOff5))?'checked':''?>></td>
                        <td>&nbsp;<input type="checkbox" id="5mon" name="5week[]" value="1" <?php echo (in_array('1',$arrOff5))?'checked':''?>></td>
                        <td>&nbsp;<input type="checkbox" id="5tue" name="5week[]" value="2" <?php echo (in_array('2',$arrOff5))?'checked':''?>></td>
                        <td>&nbsp;<input type="checkbox" id="5wed" name="5week[]" value="3" <?php echo (in_array('3',$arrOff5))?'checked':''?>></td>
                        <td>&nbsp;<input type="checkbox" id="5thur" name="5week[]" value="4" <?php echo (in_array('4',$arrOff5))?'checked':''?>></td>
                        <td>&nbsp;<input type="checkbox" id="5fri" name="5week[]" value="5" <?php echo (in_array('5',$arrOff5))?'checked':''?>></td>
                        <td>&nbsp;<input type="checkbox" id="5sat" name="5week[]" value="6" <?php echo (in_array('6',$arrOff5))?'checked':''?>></td>
                    </tr>
                    </tbody>
                </table>
                
            </div>
                    </div>


        </div>
            </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-9 col-md-3">
                    <button type="button" onclick="validate.require('shiftName','errorhidreq1') ; SM.smsubmit('<?php echo $headername; ?>','<?php echo $formid; ?>','ShiftPatternMast','ShiftPattern','Shift Pattern Master','errorhid','errorhidreq','shiftPattern_content');" class="btn blue"  id="subbut" ><?php echo$buttonVal; ?></button>
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

<script src="js/shift.js" type="text/javascript"></script>