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
                                        <i class="fa fa-gift"></i>Compensatory Off Request
                                    </div>
                                   
                                </div>
                                <div class="portlet-body form">
                                    <!-- BEGIN FORM-->
                                    <form action="#" class="form-horizontal" id="compOffForm">
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Work Done</label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" name="fromDate" id="fromDate" placeholder="dd/mm/yy" onchange="getatt_time();get_workday();">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label">No. Of Days</label>
                                                <div class="col-md-3">
                                                    <input type="number" class="form-control" name="nodays" id="nodays" disabled>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Reason</label>
                                                <div class="col-md-4">
                                                    <input type="textarea" name="reason" id="reason" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label" style="text-align:left">Attendance For This Date</label>
                                            </div>

                                            <div class="form-group" style="margin-left: 20%;">
                                            <div class="col-md-8">
                                                <div id="time_val">
                                                    <table width="100%" cellpadding="0" cellspacing="2" border="0" id="detailtable">
                                                        <tbody><tr>
                                                            <th style="text-align:left">Day Type</th>
                                                             <th style="text-align:left">Planned In Time</th>
                                                            <th style="text-align:left">Planned Out Time </th>
                                                            <th style="text-align:left">Actual In Time</th>
                                                            <th style="text-align:left">Actual Out Time </th>
                                                        </tr>
                                                        <?php
                                                        $sql="select CONVERT(VARCHAR(8),ShiftFrom,108) as ShiftFrom ,CONVERT(VARCHAR(8),Shiftto,108) as Shiftto,CONVERT(VARCHAR(8),IN_TIME,108) as IN_TIME ,CONVERT(VARCHAR(8),OUT_TIME,108) as OUT_TIME from CAttendanceqry where EMP_CODE='$code'";
                                                        $res=query($query,$sql,$pa,$opt,$ms_db);
                                                        $data_time = $fetch($res)
                                                        ?>
                                                        <tr>
                                                            <td style="text-align:left"></td>
                                                            <td style="text-align:left"><?php echo $data_time[0]; ?></td>
                                                            <td style="text-align:left"><?php echo $data_time[1]; ?></td>
                                                           <!-- <td style="text-align:left"><?php //echo $data_time[2]; ?></td>
                                                            <td style="text-align:left"><?php //echo $data_time[3]; ?></td>-->
                                                        </tr>


                                                        </tbody></table>
                                            </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-9">
                                                    <input type="hidden" id="levellist">
                                                    <input type="hidden" id="approver1"  value="<?php echo $mngrcode;?>">
                                                    <input type="hidden" id="levellist1" value="1; ;Reporting Manager">
                                                    <label class="col-md-3 control-label">Approved By</label><strong> <span id="showlevel"></span></strong>
                                                </div>
                                            </div>

                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <button type="button" onclick="submitCompOff('<?php echo $code; ?>','<?php echo $mngrcode;?>');" class="btn btn-circle blue">Submit</button>
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