<?php
@session_start();

$username=$_SESSION['usercode'];

?>

<div class="page-content-wrapper" xmlns="http://www.w3.org/1999/html">
    <div class="page-content cus-light-grey">

        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <div class="tabbable tabbable-custom tabbable-noborder tabbable-reversed">

                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_0">
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                    <div class="caption">
                                        Past Attendance Request
                                        <!-- <i class="fa fa-gift"></i> -->
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                    <!-- BEGIN FORM-->
                                    <form action="#" class="form-horizontal" id="outWorkForm">
                                        <div class="form-body">
                                            <div class="form-group">
                                            <?php $currDate = date("d/m/Y");?>
                                                <div class="row">
                                                <label class="col-md-2 control-label">For Date</label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control input-medium" name="fromDate" id="fromDate" onchange="selectDate(this.value,'<?php echo $currDate?>','<?php echo $code; ?>');" placeholder="dd/mm/yy">
                                                    <span id="futureDateErr" style="color:red;"></span>
                                                </div>
                                                <div style="display:none;" id="multipleDate">
                                                    <label class="col-md-1 control-label">To</label>
                                                    <div class="col-md-3">
                                                        <input type="text" class="form-control input-medium" name="toDate" onchange="selectDate(this.value,'<?php echo $currDate?>','<?php echo $code; ?>');" id="toDate" placeholder="dd/mm/yy">
                                                        <input type="hidden" id="hidd_todate" value="0">
														
                                                    </div>
                                                </div>
                                                <label class="col-md-2 control-label" id="multiple" style="color: #b2c0d8" onclick="selectToDate();">
                                                    (multiple)
                                                </label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                <div style="display: block" id="inDateDiv">
                                                    <label class="col-md-2 control-label">In Date Time<span class="required">*</span></label>
                                                    <div class="col-md-4" >
                                                        <div class="input-group">
                                                            <input type="text" class="form-control input-medium" name="inDate" id="inDate"  placeholder="dd/mm/yy">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="timemanagement1" class="col-md-6" >
                                                    <input type="hidden" id="hidd_intime" value="0">
                                                    <label class="col-md-1">In HH</label>
                                                    <select class="col-md-2" id="inHour">
                                                        <option value="00">00</option>
                                                        <option value="01">01</option>
                                                        <option value="02">02</option>
                                                        <option value="03">03</option>
                                                        <option value="04">04</option>
                                                        <option value="05">05</option>
                                                        <option value="06">06</option>
                                                        <option value="07">07</option>
                                                        <option value="08">08</option>
                                                        <option value="09">09</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                    </select>
													
                                                    <label class="col-md-1">In MM</label>
                                                    <select class="col-md-2" id="inMinute">
                                                        <?php 
                                                            for($i=0;$i<60;$i++){

                                                                if(strlen($i)==1){
                                                                    $t="0".$i;
                                                                }else{
                                                                    $t=$i;
                                                                }

                                                            echo'<option value="'.$t.'">'.$t.'</option>';
                                                        }
                                                            ?>
                                                    </select>

                                                    <label >
                                                        <input type="radio" class="icheck"  name="inap"  value="am" >AM
                                                    </label>
                                                    <label>
                                                        <input type="radio" class="icheck" name="inap"  value="pm" >PM
                                                    </label>
                                                 </div>
                                                </div>
                                                </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div id="outDateDiv" style="display: block;">
                                                    <label class="col-md-2 control-label">Out Date Time<span class="required">*</span></label>
                                                    <div class="col-md-4" >
                                                        <div class="input-group">
                                                            <input type="text" class="form-control input-medium" name="outDate" value="" id="outDate" placeholder="dd/mm/yy">
                                                        </div>
                                                    </div>
                                                    </div>
                                                
                                                <div id="timemanagement2" class="col-md-6">
                                                    <input type="hidden" id="hidd_outtime" value="0">
                                                    <label class="col-md-1">Out HH</label>
                                                    <select class="col-md-2" id="outHour">
                                                        <option value="00">00</option>
                                                        <option value="01">01</option>
                                                        <option value="02">02</option>
                                                        <option value="03">03</option>
                                                        <option value="04">04</option>
                                                        <option value="05">05</option>
                                                        <option value="06">06</option>
                                                        <option value="07">07</option>
                                                        <option value="08">08</option>
                                                        <option value="09">09</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                    </select>

                                                    <label class="col-md-1">Out MM</label>
                                                    <select class="col-md-2" id="outMinute">
                                                        <?php 
                                                            for($i=0;$i<60;$i++){

                                                                if(strlen($i)==1){
                                                                    $t="0".$i;
                                                                }else{
                                                                    $t=$i;
                                                                }

                                                            echo'<option value="'.$t.'">'.$t.'</option>';
                                                        }
                                                            ?>
                                                    </select>

                                                    <label >
                                                        <input type="radio" class="icheck" name="outap1"  value="AM" >AM
                                                    </label>
                                                    <label>
                                                        <input type="radio" class="icheck" name="outap1"  value="PM" >PM
                                                    </label>
                                                 </div>
                                             </div>    
                                            </div>


                                            <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-2 control-label">Reason For not Working<span class="required">*</span></label>
                                                <div class="col-md-4">
                                                    <div class="input-group">
                                                        <select name="notMarkingReas" id="notMarkingReas" class="form-control input-medium">
                                                            <option value=""></option>
                                                            <?php $sql1="Select * from LOVMast Where LOV_Field='reasonForNotMarking' ORDER BY LOV_Text ASC";
                                                            $result1 = query($query,$sql1,$pa,$opt,$ms_db);
                                                            if ($num($result1) > 0) {
                                                                $list="";
                                                                while($row = $fetch($result1)) {
                                                                    $list.= "<option value=" . $row['LOV_Value']. ">" . $row['LOV_Text']. "</option>";
                                                                }
                                                                echo $list;
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>

                                            <div class="form-group" id="Remarks">
                                            <div class="row">
                                                <label class="col-md-2 control-label">Remarks
                                                <span class="required">*</span></label>
                                                <div class="col-md-4 ">

                                                <textarea name="remark" id="reamark" class="form-control input-medium" maxlength="100"></textarea>

                                                </div>
                                            </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                <label class="col-md-2 control-label">Past Attendance For This Date</label><br />
                                                <div class="col-md-8">
                                                    <div id="time_val">
                                                        <table width="100%" cellpadding="0" cellspacing="2" border="0" id="detailtable">
                                                            <tbody><tr>
                                                                <th style="text-align:left">Day Type</th>
                                                                <th style="text-align:left">Shift Start Time</th>
                                                                <th style="text-align:left">Shift End Time</th>
                                                                <th style="text-align:left">Actual In Time</th>
                                                                <th style="text-align:left">Actual Out Time </th>
                                                            </tr>
                                                            <?php
                                                            $sql="select cast(Shift_From as varchar(4)) AS sIn , cast(Shift_TO as varchar(4)) AS sOut from RosterQry where EMP_CODE='$username' and (cast(rosterstart as date) <= GETDATE() and cast(rosterend as date) >= GETDATE())";
                                                            $res=query($query,$sql,$pa,$opt,$ms_db);
                                                            $data_time = $fetch($res);
                                                            ?>
                                                            <tr>
                                                                <td style="text-align:left"></td>
                                                                <td style="text-align:left"><?php ECHO timeFormat($data_time['sIn']); ?></td>
                                                                <td style="text-align:left"><?php ECHO timeFormat($data_time['sOut']); ?></td>
                                                                <td style="text-align:left"></td>
                                                                <td style="text-align:left">
                                                                </td>
                                                            </tr>


                                                            </tbody></table>

                                                    </div>
                                                </div>
                                                </div>
                                            </div>

                                            <input type="hidden" name="levellist" id="levellist" value="">
                                            <div class="row">
                                                <div class="form-group" id="According_WorkFlow">
                                                <div class="col-md-12">
                                                <label class="col-md-2 control-label">Approved By</label>
                                                <div class="col-md-6" id="showlevel1"> 
                                                </div>
                                                </div>
                                                </div>
                                            </div>

                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <button type="button" onclick="submitPastAttend('<?php echo $code;?>','<?php echo $mngrcode;?>');" class="btn btn-circle blue">Submit</button>
                                                        <button type="button" class="btn btn-circle default">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- END FORM-->
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>