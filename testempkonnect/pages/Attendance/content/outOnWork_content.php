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
                                    	Out On Duty Request
                                        <!-- <i class="fa fa-gift"></i> -->
                                    </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse">
                                        </a>
                                       
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                    <!-- BEGIN FORM-->
                                    <form action="#" class="form-horizontal" id="outWorkForm">
                                        <div class="form-body">
                                            <div class="form-group">
                                                <div class="row">
                                                <?php $currDate = date("d/m/Y");?>
                                                <label class="col-md-2 control-label">From</label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control input-medium" name="fromDate" id="fromDate" onchange="selectDate(this.value,'<?php echo $currDate;?>','<?php echo $code?>')" placeholder="dd/mm/yy">
                                                </div>
                                            
                                                <div style="display:none;" id="multipleDate">
                                                    <label class="col-md-1 control-label">To</label>
                                                    <div class="col-md-3">
                                                    <input type="text" class="form-control input-medium" name="toDate" id="toDate" placeholder="dd/mm/yy">
                                                        <input type="hidden" id="hidd_todate" value="0">
                                                    </div>
                                                </div>
                                                <label class="col-md-2 control-label" id="multiple" style="color: #b2c0d8" onclick="selectToDate();">
                                                    (select multiple date)
                                                </label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                <label class="col-md-2 control-label">
                                                    Select Timing
                                                </label>
                                                <div class="col-md-4" >
                                                    <select class="form-control input-medium" name="natureofworkcause1" id="natureofworkcause1" onchange="selecttime(this.value);">
                                                    <option value="">Select</option>
                                                    <?php $sql="Select * from LOVMast Where LOV_Field='natureOfWorkCause'";
                                                    $result = query($query,$sql,$pa,$opt,$ms_db);
                                                    while($row = $fetch($result)) {
                                                    ?>
                                                        <option value="<?php echo $row['LOV_Value'];?>">
                                                        <?php echo $row['LOV_Text'];?>
                                                        </option>
                                                    <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                <div id="timemanagement1" class="col-md-12" style="top: 0px; display: none;">
                                                    <input type="hidden" id="hidd_intime" value="0">
                                                    <label class="col-md-2"  style="
                                                         font-size: 13px;">In HH</label>
                                                      <select class="col-md-2" id="inHour" style="padding-left:0px !important;">
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

                                                    <label class="col-md-2"  style="
                                                         font-size: 13px;">In MM</label>
                                                        <select class="col-md-2" id="inMinute" style="padding-left:0px !important;">
                        
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
                                                    <div class="col-md-4">
                                                    <label >
                                                        <input type="radio" class="icheck"  name="inap"  value="AM" >AM
                                                    </label>
                                                    <label>
                                                        <input type="radio"  class="icheck" name="inap"  value="PM" >PM
                                                    </label>
                                                    </div>
                                                </div>

                                                <div id="timemanagement2" class="col-md-12" style="top: 0px; display: none;">
                                                    <input type="hidden" id="hidd_outtime" value="0">
                                                        <label class="col-md-2" style="
                                                         font-size: 13px;">
                                                        Out HH</label>
                                                        <select class="col-md-2" id="outHour" style="padding-left:0px !important;">
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

                                                        <label class="col-md-2" style="
                                                         font-size: 13px;">
                                                            Out MM
                                                        </label>
                                                        <select class="col-md-2" id="outMinute" style="padding-left:0px !important;">
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
                                                        <div class="col-md-4">
                                                        <label >
                                                            <input type="radio" class="icheck" name="outap"  value="AM" >AM
                                                        </label>
                                                        <label>
                                                            <input type="radio" class="icheck" name="outap"  value="PM" >PM
                                                        </label>
                                                        </div>
                                                </div>
                                                </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                <label class="col-md-2 control-label">Nature Of Work</label>
                                                <div class="col-md-4">
                                                    <div class="input-group">
                                                        <select name="natureofwork" id="natureofwork" class="form-control input-medium">
                                                            <option value=""></option>
                                                            <?php $sql1="Select * from LOVMast Where LOV_Field='natureOfWork' ORDER BY LOV_Text ASC";
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

                                            <div class="form-group" id="excludecheck" style="display: none;">
                                                <div class="row">
                                                <label class="col-md-2 control-label"></label>
                                                <div class="col-md-4">
                                                    <div class="input-group">
                                                        <div class="icheck-list">
                                                            <label>
                                                                <input type="checkbox"  name="weeklyoff1" id="weeklyoff"  value="yes" class="icheck" data-checkbox="icheckbox_flat-grey" checked> Exclude Weekly offs and Holiday
                                                                <input type="hidden" id="hidd_Weekly" value="0">
                                                            </label>
                                                            <span id="warningExclude" style="color:red;"></span>
                                                            <label>
                                                                <input type="checkbox"  name="leavedays1" id="leavedays"  value="yes" class="icheck" data-checkbox="icheckbox_flat-grey" checked>Exclude Leave Days
                                                                <input type="hidden" id="hidd_Leave" value="0">
                                                            </label>
                                                            <span id="warningExcludeLeave" style="color:red;"></span>
                                                        </div>
                                                     </div>
                                                 </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                <label class="col-md-2 control-label">Reason</label>
                                                <div class="col-md-4">
                                                <textarea name="reason" id="reason" class="form-control input-medium" maxlength="100"></textarea>
                                                </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="row">
                                                <label class="col-md-2 control-label">Out On Duty For This Date
                                                </label><br />
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
                                                            $sql="select CONVERT (VA
                                                            RCHAR(10),Shift_From,103 ) as Shift_From,CONVERT (VARCHAR(10),Shift_To,103 ) as Shift_To from RosterQry where EMP_CODE='$code' and (cast(rosterstart as date) <= GETDATE() and cast(rosterend as date) >= GETDATE())";
                                                            $res=query($query,$sql,$pa,$opt,$ms_db);
                                                            $data_time = $fetch($res);
                                                            ?>
                                                            <tr>
                                                                <td style="text-align:left"></td>
                                                                <td style="text-align:left"><?php ECHO $data_time['Shift_From']; ?></td>
                                                                <td style="text-align:left"><?php ECHO $data_time['Shift_To']; ?></td>
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
                                                <label class='col-md-2 control-label'>Approved By</label>   
                                                <div class="col-md-10" id="showlevel1"> 
                                                </div>
                                                </div>
                                                </div>
                                            </div>

                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button type="button" onclick="submitOutOnWork('<?php echo $code; ?>','<?php echo $mngrcode;?>');" class="btn btn-circle blue">Submit</button>
                                                    <button type="button" class="btn btn-circle default">Cancel</button>
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