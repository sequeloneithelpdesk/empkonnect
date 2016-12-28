<?php
session_start();
error_reporting(0);
include('../../db_conn.php');
include('../../configdata.php');
//include $_SERVER['DOCUMENT_ROOT'].$_SESSION['root']."pages/HRMSClass/HRMSFunction.php";
if(isset($_GET['ShiftMastId']) && !empty($_GET['ShiftMastId']) && $_GET['ShiftMastId']!= 'NA'){
    $colValue1 = $_GET['ShiftMastId'];
    $colval = explode(',',$colValue1);
    if(in_array('View',$colval)){
        $colValue2= $colval[1];
        $sql="select ShiftMastId,Shift_Code, Shift_Name,convert(varchar(20), ShiftStart_SwTime, 24) As ShiftStart_SwTime,
convert(varchar(20), ShiftEnd_SwTime, 24) As ShiftEnd_SwTime,
convert(varchar(20), Shift_MFrom, 24) As Shift_MFrom,
convert(varchar(20), Shift_MTo, 24) As Shift_MTo,
convert(varchar(20), Shift_From, 24) As Shift_From,
convert(varchar(20), Shift_To, 24) As Shift_To,
LateAllow,LateAllowCycle,LateAllowGPrd,ErlyAllow,ErlyAllowCycle,ErlyAllowGPrd,
convert(varchar(20), MHrsFul, 24) As MHrsFul,
convert(varchar(20), MHrsHalf, 24) As MHrsHalf,
FixBrkDef,
convert(varchar(20), BrkStartTime, 24) As BrkStartTime,
convert(varchar(20), BrkEndTime, 24) As BrkEndTime,
MarkOut,LATCOMINGSTATUS,EARLYGOINGSTATUS,shift_status,RCLOCK from ShiftMast where ShiftMastId='$colValue2'";
        $qur=query($query,$sql,$pa,$opt,$ms_db);
        $row = $fetch($qur);
         $shiftCode   = $row['Shift_Code'];
        $shiftName   = $row['Shift_Name'];
        //$shiftCode ="";
        //$shiftName="";
        $shiftstart_swtime  = $row['ShiftStart_SwTime'];
        $shiftend_swtime = $row['ShiftEnd_SwTime'];
        $shift_mfrom    = $row['Shift_MFrom'];
        $shift_mto  = $row['Shift_MTo'];
        $shift_from = $row['Shift_From'];
        $shift_to    = $row['Shift_To'];

        $lateallow   = $row['LateAllow'];
        $lateallowcycle   = $row['LateAllowCycle'];
        $lateallowGprd  = $row['LateAllowGPrd'];
        $earlyallow = $row['ErlyAllow'];
        $earlyallowcycle    = $row['ErlyAllowCycle'];
        $earlyallowGprd  = $row['ErlyAllowGPrd'];
        $mhrsful = $row['MHrsFul'];
        $mhrshalf    = $row['MHrsHalf'];

        $fixbrk = $row['FixBrkDef'];
        $brkstarttime    = $row['BrkStartTime'];
        $brkendtime  = $row['BrkEndTime'];

        $markout  = $row['MarkOut'];
        $RCLOCK= $row['RCLOCK'];

        $buttonVal="Update";
        $formid="form_sm";
        // $headername="Edit";
        $headername="View";
        ?>
        <script>
            document.getElementById('shiftCode').disabled='disabled';
            document.getElementById('shiftName').disabled='disabled';
            document.getElementById('shiftstarttime').disabled='disabled';
            document.getElementById('shiftendtime').disabled='disabled';
            document.getElementById('mstarttime').disabled='disabled';
            document.getElementById('mendtime').disabled='disabled';
            document.getElementById('sw_startshift').disabled='disabled';
            document.getElementById('sw_endshift').disabled='disabled';
            document.getElementsByName('fixedbrk').disabled='disabled';
            document.getElementById('brkstarttime').disabled='disabled';
            document.getElementById('brkendtime').disabled='disabled';
            document.getElementById('mfullday').disabled='disabled';
            document.getElementById('mhalfday').disabled='disabled';
            document.getElementById('latecomemin').disabled='disabled';
            document.getElementById('lcycle').disabled='disabled';
            document.getElementById('lgrace').disabled='disabled';
            document.getElementById('earlygo').disabled='disabled';
            document.getElementById('ecycle').disabled='disabled';
            document.getElementById('egrace').disabled='disabled';
            document.getElementById('subbut').disabled='disabled';
        </script>
        <?php
    }
    else{
        $sql="select ShiftMastId,Shift_Code, Shift_Name,convert(varchar(20), ShiftStart_SwTime, 24) As ShiftStart_SwTime,
convert(varchar(20), ShiftEnd_SwTime, 24) As ShiftEnd_SwTime,
convert(varchar(20), Shift_MFrom, 24) As Shift_MFrom,
convert(varchar(20), Shift_MTo, 24) As Shift_MTo,
convert(varchar(20), Shift_From, 24) As Shift_From,
convert(varchar(20), Shift_To, 24) As Shift_To,
LateAllow,LateAllowCycle,LateAllowGPrd,ErlyAllow,ErlyAllowCycle,ErlyAllowGPrd,
convert(varchar(20), MHrsFul, 24) As MHrsFul,
convert(varchar(20), MHrsHalf, 24) As MHrsHalf,
FixBrkDef,
convert(varchar(20), BrkStartTime, 24) As BrkStartTime,
convert(varchar(20), BrkEndTime, 24) As BrkEndTime,
MarkOut,LATCOMINGSTATUS,EARLYGOINGSTATUS,shift_status,RCLOCK from ShiftMast where ShiftMastId='$colValue1'";
        $qur=query($query,$sql,$pa,$opt,$ms_db);
        $row = $fetch($qur);
        // $shiftCode   = $row['Shift_Code'];
        //$shiftName   = $row['Shift_Name'];
        $shiftCode ="";
        $shiftName="";
        $shiftstart_swtime  = $row['ShiftStart_SwTime'];
        $shiftend_swtime = $row['ShiftEnd_SwTime'];
        $shift_mfrom    = $row['Shift_MFrom'];
        $shift_mto  = $row['Shift_MTo'];
        $shift_from = $row['Shift_From'];
        $shift_to    = $row['Shift_To'];

        $lateallow   = $row['LateAllow'];
        $lateallowcycle   = $row['LateAllowCycle'];
        $lateallowGprd  = $row['LateAllowGPrd'];
        $earlyallow = $row['ErlyAllow'];
        $earlyallowcycle    = $row['ErlyAllowCycle'];
        $earlyallowGprd  = $row['ErlyAllowGPrd'];
        $mhrsful = $row['MHrsFul'];
        $mhrshalf    = $row['MHrsHalf'];

        $fixbrk = $row['FixBrkDef'];
        $brkstarttime    = $row['BrkStartTime'];
        $brkendtime  = $row['BrkEndTime'];

        $markout  = $row['MarkOut'];
        $RCLOCK= $row['RCLOCK'];

        $buttonVal="Update";
        $formid="form_sm";
        // $headername="Edit";
        $headername="Copy";
    }

}
else{
    $colValue="";
    $shiftCode   = "";
    $shiftName   = "";
    $shiftstart_swtime="0:00";
    //$shiftstart_swtime = new DateTime;
    //$shiftstart_swtime->setTime(0, 0);
    $shiftend_swtime="0:00";
    //$shiftend_swtime = new DateTime;
    //$shiftend_swtime->setTime(0, 0);
    $shift_mfrom="0:00";
    //$shift_mfrom = new DateTime;
    //$shift_mfrom->setTime(0, 0);
    $shift_mto="0:00";
    //$shift_mto = new DateTime;
    //$shift_mto->setTime(0, 0);
    $shift_from="0:00";
    //$shift_from = new DateTime;
    //$shift_from->setTime(0, 0);
    $shift_to="0:00";
    //$shift_to = new DateTime;
    //$shift_to->setTime(0, 0);

    $lateallow   = "0";
    $lateallowcycle   = "0";
    $lateallowGprd  = "0";
    $earlyallow = "0";
    $earlyallowcycle    = "0";
    $earlyallowGprd  = "0";
    $mhrsful="0:00";
    //$mhrsful = new DateTime;
    //$mhrsful->setTime(0, 0);
    $mhrshalf="0:00";
    //$mhrshalf = new DateTime;
    //$mhrshalf->setTime(0, 0);

    $fixbrk = "";
    $brkstarttime="0:00";
    //$brkstarttime = new DateTime;
    //$brkstarttime->setTime(0, 0); 
    $brkendtime="0:00";
    //$brkendtime = new DateTime;
    //$brkendtime->setTime(0, 0);

    $markout  = "0";
    $RCLOCK = "0";

    $buttonVal="Create";
    $formid="form_sm";
    $headername="Create";
}


?>
<div class="modal-header portlet box blue">
    <button type="button" class="close" data-dismiss="modal"  aria-hidden="true"></button>
    <h4 class="modal-title" style="color: white"><div class="caption" ><b><?php echo $headername; ?> Shift</b></div></h4>
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
                        <label class="control-label">Shift Code<span class="required">
            * </span>
                        </label>
                        </div>
                    <div class="col-md-3">
                        <input type="hidden" name="ShiftMastId" class="form-control" value="<?php echo $colValue;?>" />
                        <input type="text" name="shiftCode" id="shiftCode" maxlength="10" class="form-control" onkeyup="SM.checkrolename('shiftCode','ShiftMast','Shift_Code'); validate.SpecialChar('shiftCode');" value="<?php echo $shiftCode;?>"/>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label">Shift Name <span class="required">
            * </span>
                        </label>
                    </div>
                    <div class="col-md-3">
                        <input name="shiftName" id="shiftName" maxlength="50" onkeyup="SM.checkrolename('shiftName','ShiftMast','Shift_Name'); validate.require('shiftName','errorhidreq1');" type="text" class="form-control" value="<?php echo $shiftName;?>"/>
                    </div>

                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-3">
                        <label class="control-label">Is the Shift Round the Clock?
                        </label>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" name="rclock" id="yrclock" value="1"  <?php echo ($RCLOCK==1)?'checked':''?>/>&nbsp;Yes
                    </div>
                    <div class="col-md-3">
                        <input type="radio" name="rclock" id="nrclock" value="0"  <?php echo ($RCLOCK==0)?'checked':''?>/>&nbsp;No
                    </div>

                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-3">

                        <label class="control-label">Shift Start Time
                        </label></div>
                    <div class="col-md-3">
                        <input name="shiftstarttime" id="shiftstarttime" class="form-control timepicker timepicker-24"  onblur="start_endvalid();"  type="text" value="<?php echo $shift_from ;?>"/>
                    </div>

                    <div class="col-md-3">
                        <label class="control-label">Shift End Time
                        </label></div>
                    <div class="col-md-3">
                        <input name="shiftendtime" id="shiftendtime"  class="form-control timepicker timepicker-24" type="text" onblur="end_startvalid();"  value="<?php echo $shift_to ;?>"/>
                    </div>
                    </div>
                </div>
            <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-3">
                        <label class="control-label">Mandatory Start Time
                        </label></div>
                    <div class="col-md-3">
                        <input name="mstarttime" id="mstarttime" type="text"class="form-control timepicker timepicker-24"  onblur="mstart_endvalid();"  value="<?php echo $shift_mfrom ;?>" />
                    </div>
                    <div class="col-md-3">
                        <label class="control-label">Mandatory End Time
                        </label></div>
                    <div class="col-md-3">
                        <input name="mendtime" id="mendtime" type="text"  class="form-control timepicker timepicker-24"  onblur="mend_startvalid();"  value="<?php echo $shift_mto ;?>" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">

                    <div class="col-md-9">
                        <label class="control-label">Employee is allowed to swipe before shift start
                        </label>
                    </div>
                    <div class="col-md-3">
                        <input name="sw_startshift" id="sw_startshift" class="form-control timepicker timepicker-24" type="text"  value="<?php echo $shiftstart_swtime;?>" />
                    </div>
                    </div>
                </div>
            <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-9">
                        <label class="control-label">Employee is allowed to swipe after shift end
                        </label></div>
                    <div class="col-md-3">
                        <input name="sw_endshift" id="sw_endshift" type="text" class="form-control timepicker timepicker-24"   value="<?php echo $shiftend_swtime;?>"/>
                    </div>

                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-3">
                        <label class="control-label">Fixed Break Defined
                        </label>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" name="fixedbrk" id="yfixedbrk" value="1"  <?php echo ($fixbrk==1)?'checked':''?>/>&nbsp;Yes
                    </div>
                    <div class="col-md-3">
                        <input type="radio" name="fixedbrk" id="nfixedbrk" value="0"  <?php echo ($fixbrk==0)?'checked':''?>/>&nbsp;No
                    </div>
                </div>
            </div>

                <div class="form-group" id="brkdef" <?php if($fixbrk==1){

                }
                else{
                    echo'style="display: none"';
                }
                ?>>
                    <div class="col-md-12">

                        <div class="col-md-3">
                            <label class="control-label">Break Start Time
                            </label>
                            </div>
                        <div class="col-md-3">
                            <input name="brkstarttime" id="brkstarttime"   class="form-control timepicker timepicker-24" onblur="brkvalid();"  type="text" value="<?php echo $brkstarttime ;?>" />
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Break End Time
                            </label>
                        </div>
                        <div class="col-md-3">
                            <input name="brkendtime" id="brkendtime" class="form-control timepicker timepicker-24" onblur="endbrkvalid();" type="text"  value="<?php echo $brkendtime ;?>"/>
                        </div>

                    </div>
                </div>


            <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-3">
                        <label class="control-label">Mandatory Time for Full day
                        </label>
                    </div>
                    <div class="col-md-3">
                        <input name="mfullday" id="mfullday" type="text" class="form-control timepicker timepicker-24"   value="<?php echo $mhrsful ;?>"/>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label">Mandatory Time for Half day
                        </label>
                    </div>
                    <div class="col-md-3">
                        <input name="mhalfday" id="mhalfday" type="text" class="form-control timepicker timepicker-24"   value="<?php echo $mhrshalf ;?>"/>
                    </div>
                </div>
            </div>

        </div>
        <div class="form-group">
            <div class="col-md-12">
                <div class="col-md-3">
                    <label class="control-label">Markout Mandatory
                    </label>
                </div>
                    <div class="col-md-3">
                        <input type="radio" name="markout" id="ymarkout" value="1"  <?php echo ($markout==1)?'checked':''?>/>&nbsp;Yes
                    </div>
                    <div class="col-md-3">
                        <input type="radio" name="markout" id="nmarkout" value="0"  <?php echo ($markout==0)?'checked':''?>/>&nbsp;No
                    </div>

            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">

                <div class="col-md-3">
                    <label class="control-label"><b>Late Coming</b>
                    </label>
                </div>
                <div class="col-md-9">
                    <div class="col-md-9">
                        <label class="control-label">Employee are allowed to come upto(Minutes)</label>
                        </div>
                    <div class="col-md-3">
                        <input name="latecomemin" id="latecomemin" type="number" min="0" class="form-control" value="<?php echo $lateallow;?>"/>
                    </div></br></br>
                    <div class="col-md-9">
                        <label class="control-label">Allowed Numbers of time in a attendance cycle</label>
                    </div>
                    <div class="col-md-3">
                            <input name="lcycle" id="lcycle" type="number" min="0" class="form-control" value="<?php echo $lateallowcycle; ?>"/>
                    </div></br></br>
                    <div class="col-md-9">
                        <label class="control-label">Grace Period Time (Minutes)</label>
                    </div>
                    <div class="col-md-3">
                            <input name="lgrace" id="lgrace" type="number" min="0" class="form-control" value="<?php echo  $lateallowGprd;?>"/>
                    </div>
                </div>
                </br> </br> </br> </br> </br> </br>


                <div class="col-md-3">
                    <label class="control-label"><b>Early Going</b>
                    </label>
                </div>
                <div class="col-md-9">
                    <div class="col-md-9">
                        <label class="control-label">Employee are allowed to leave upto(Minutes)</label>
                    </div>
                    <div class="col-md-3">
                        <input name="earlygo" id="earlygo" type="number" min="0" class="form-control" value="<?php echo $earlyallow;?>"/>
                    </div></br></br>
                    <div class="col-md-9">
                        <label class="control-label">Allowed Numbers of time in a attendance cycle</label>
                    </div>
                    <div class="col-md-3">
                        <input name="ecycle" id="ecycle" type="number" min="0" class="form-control" value="<?php echo $earlyallowcycle; ?>"/>
                    </div></br></br>
                    <div class="col-md-9">
                        <label class="control-label">Grace Period Time (Minutes)</label>
                    </div>
                    <div class="col-md-3">
                        <input name="egrace" id="egrace" type="number" min="0" class="form-control" value="<?php echo $earlyallowGprd;?>"/>
                    </div>
                </div>




                </div>
            </div>
        </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-9 col-md-3">
                    <button type="button" onclick="validate.require('shiftName','errorhidreq1') ; SM.smsubmit('<?php echo $headername; ?>','<?php echo $formid; ?>','ShiftMast','Shift','Shift Master','errorhid','errorhidreq','shiftMaster_content');" class="btn blue"  id="subbut" ><?php echo$buttonVal; ?></button>
                    <button type="button" data-dismiss="modal" class="btn default">Cancel</button>
                </div>
            </div>
        </div>

        <input type="hidden" id="errorhid" value="0">
        <input type="hidden" id="errorhidreq18" value="0">
        <input type="hidden" id="errorhidreq1" value="0">
        <input type="hidden" id="errorhidreq2" value="0">
        <input type="hidden" id="errorhidreq3" value="0">
        <input type="hidden" id="errorhidreq4" value="0">
        <input type="hidden" id="errorhidreq5" value="0">
        <input type="hidden" id="errorhidreq6" value="0">
        <input type="hidden" id="errorhidreq7" value="0">
        <input type="hidden" id="errorhidreq8" value="0">
        <input type="hidden" id="errorhidreq9" value="0">
        <input type="hidden" id="errorhidreq10" value="0">
        <input type="hidden" id="errorhidreq11" value="0">
        <input type="hidden" id="errorhidreq12" value="0">
        <input type="hidden" id="errorhidreq13" value="0">
        <input type="hidden" id="errorhidreq14" value="0">
        <input type="hidden" id="errorhidreq15" value="0">
        <input type="hidden" id="errorhidreq16" value="0">
        <input type="hidden" id="errorhidreq17" value="0">
    </form>
</div>

<script src="js/shift.js" type="text/javascript"></script>
<style>
    .modal-content {
        max-height: calc(100vh - 10px);
        overflow-y: auto;
    }
</style>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>
<script type="text/javascript" src="../../assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/clockface/js/clockface.js"></script>
<script src="../../assets/admin/pages/scripts/components-pickers.js"></script>

<script>jQuery(document).ready(function() {

        ComponentsPickers.init();
    });



</script>