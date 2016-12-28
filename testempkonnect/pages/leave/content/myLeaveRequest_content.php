<div class="page-content-wrapper" xmlns="http://www.w3.org/1999/html">
    <div class="page-content">
        <!--modal-dialog -->
        <div class="modal fade bs-modal-lg" id="large" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog lg">
                <!-- modal-content -->
                <div class="modal-content" >
                    <div class="modal-header portlet box blue">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title white-txt"><div class="caption"><span>My Leave Request </span></div></h4>
                    </div>
                    <div class="modal-body" id="myleave">
                        <?php //include ("content/view_myodrequest.php"); ?>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>
        <!-- /.modal-dialog -->
        <div class="row">

            <div class="col-md-12">
                <!-- BEGIN CONDENSED TABLE PORTLET-->
                <div class="portlet box blue">

                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-globe"></i>My Leave Request
                        </div>
                      
                    </div>
                    <div class="portlet-body">
                        <div class="table-toolbar">
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="btn-group ">
                                        <select class="form-control" onchange="getRelatedSelectbox(this.value);">
                                            <option value="">Select....</option>
                                            <option value="1">Request Applied On</option>
                                            <option value="2">Request Status</option>
                                            <option value="3">By Approver Name</option>
                                        </select>
                                    </div>

                                    <div class="btn-group" id="monthlySearch" style="display: none;margin-left: 45px;">
                                        <div class="col-md-5">
                                            <label class="control-label">
                                                From Date
                                            </label>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="date" class="form-control" name="fromPastDate" id="fromDate" placeholder="dd/mm/yy">
                                        </div>
                                        <div class="col-md-5">
                                            <label class="control-label">
                                                To Date
                                            </label>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="date" class="form-control" name="toPastDate" id="toDate" placeholder="dd/mm/yy">
                                        </div>
                                        <div class="col-md-2" style="margin-top: 25px;">
                                        <button class="btn" onclick="searchByDate('<?php echo $code;?>')">Go</button>
                                        </div>
                                    </div>

                                    <div class="btn-group" id="actionSearch" style="display: none;margin-left: 45px;">
                                        <select class="form-control" onchange="searchByStatus(this.value,'<?php echo $code;?>');">
                                            <option value="">Select ..</option>
                                            <?php
                                            $sql="select * from LOVMast where LOV_Field='status'";
                                            $result=query($query,$sql,$pa,$opt,$ms_db);
                                            while ($row = $fetch($result)){
                                                ?>
                                                <option value="<?php echo $row['LOV_Value']?>"><?php echo $row['LOV_Text']?></option>
                                            <?php } ?>

                                        </select>
                                    </div>

                                    <div class="btn-group " id="bynameSearch" style="display: none;margin-left: 45px;">

                                        <input type="text" name="byname" class="form-control pull-left" id="byname" onchange="getInputValue(this.value);" placeholder="Enter Emp code or Name">


                                        <button class="pull-right" id="inputvalue" value=""
                                                onclick="serchByCodeName(this.value,'<?php echo $code;?>');">Go</button>

                                    </div>

                                </div>
                            </div>

                        </div>
                        <table class="table table-striped table-bordered table-hover" id="sample_2">
                            <?php
                           $getMyLeaveRequestData=$leave_class_obj->getMyLeaveRequestData($code);
                          $leaveID= $getMyLeaveRequestData[0];
                            $LvFrom=$getMyLeaveRequestData[1];
                            $LvTo=$getMyLeaveRequestData[2];
                            $LvDays=$getMyLeaveRequestData[3];
                            $LvType=$getMyLeaveRequestData[4];
                            $reason=$getMyLeaveRequestData[5];
                            $ApprovedBy=$getMyLeaveRequestData[6];
                            $status=$getMyLeaveRequestData[7];
                            $Levkey=$getMyLeaveRequestData[8];
                            $count_flag=$getMyLeaveRequestData[9];
                         // print_r($count_flag) ;
                          // exit;
                           /* $sql="select *,CONVERT (VARCHAR(10),LvFrom,103 ) as LvFrom,CONVERT (VARCHAR(10),LvTo,103 ) as LvTo from Leave WHERE CreatedBy='$code' and flag='1'";
                            $res=query($query,$sql,$pa,$opt,$ms_db);
                            $len = $num($res);*/

                            ?>
                            <thead >
                            <tr>
                                <th>
                                    From Date 
                                </th>

                                <th>
                                    To Date
                                </th>

                                <th>
                                    Leave days
                                </th>
                                 <th>
                                    Leave Type
                                </th>

                                <th>
                                    Reason
                                </th>

                                <th>
                                    Approved By
                                </th>
                                <th>
                                    Status
                                </th>
                            </tr>
                            </thead>
                            <tbody id="searchMyData">
                            <?php

                            for ($i=0;$i<$count_flag;$i++){
                                ?>
                                <tr>
                                    
                                    <td>
                                        <?php echo $LvFrom[$i];?>
                                    </td>
                                    <td>
                                        <?php echo $LvTo[$i];?>
                                    </td>
                                    <td>
                                        <?php echo $LvDays[$i];?>
                                    </td>
                                    <td>
                                        <?php echo $leave_class_obj->getemployee_leave_type($LvType[$i]);?>
                                    </td>
                                    <td>
                                        <?php echo $reason[$i];?>
                                    </td>
                                    <td>
                                    <?php echo str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($leave_class_obj->getemployee_name($ApprovedBy[$i])))));?>
                                       
                                    </td>

                                    <td>
                                        <?php if($status[$i] == "1" || $status[$i] == ""){?>
                                            <a class="myod" data-toggle="modal" href="#large"
                                               onclick="getmyleaveId('<?php echo $Levkey[$i];?>','1','<?php echo $code;?>');">
								<span class="label  bg-blue-steel">
								Pending </span>
                                            </a>
                                        <?php } else if($status[$i] == "2") {?>
                                            <a class="myod" data-toggle="modal" href="#large"
                                               onclick="getmyleaveId('<?php echo $Levkey[$i];?>','2','<?php echo $code;?>');">
                                <span class="label label-success">
                               Approved
								 </span>
                                            </a>
                                        <?php } else if($status[$i] == "3") {?>
                                            <a class="myod" data-toggle="modal" href="#large"
                                               onclick="getmyleaveId('<?php echo $Levkey[$i];?>','3','<?php echo $code;?>');">
                                <span class="label label-danger">
                               Rejected
							 </span>
                                            </a>
                                        <?php } else if($status[$i] == "4") {?>
                                            <a class="myod" data-toggle="modal" href="#large"
                                               onclick="getmyleaveId('<?php echo $Levkey[$i];?>','4','<?php echo $code;?>');">
                                <span class="label bg-grey-cascade">
                               Cancelled
							 </span>
                                            </a>
                                             <?php } else if($status[$i] == "5") {?>
                                            <a class="myod" data-toggle="modal" href="#large"
                                               onclick="getmyleaveId('<?php echo $Levkey[$i];?>','4','<?php echo $code;?>');">
                                <span class="label bg-grey-cascade">
                               Cancelled Requested
                             </span>
                                            </a>
                                        <?php }?>

                                    </td>

                                </tr>
                                <?php  } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END CONDENSED TABLE PORTLET-->
            </div>
        </div>
    </div>
</div>

