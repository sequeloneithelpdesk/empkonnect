<div class="page-content-wrapper" xmlns="http://www.w3.org/1999/html">
    <div class="page-content">
        <!--modal-dialog -->
        <div class="modal fade bs-modal-lg" id="large" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog lg">
                <!-- modal-content -->
                <div class="modal-content" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title"><div class="caption"><b> Leave Request Details</b></div></h4>
                    </div>
                    <div class="modal-body" id="myteamleave">
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
                <div class="portlet box blue-madison">

                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-globe"></i>My Team Leave Request
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="reload">
                            </a>
                            <a href="javascript:;" class="remove">
                            </a>
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
                                            <option value="3">By Requester Name</option>
                                            <option value="4">By Approver Name</option>
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
                                        <button class="btn" onclick="searchByDate();">Go</button>
                                        </div>
                                    </div>

                                    <div class="btn-group" id="actionSearch" style="display: none;margin-left: 45px;">
                                        <select class="form-control" onchange="searchByStatus(this.value);">
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
                                                onclick="serchByCodeName(this.value);">Go</button>

                                    </div>

                                    <div class="btn-group " id="ApproverSearch" style="display: none;margin-left: 45px;">

                                        <input type="text" name="apprname" class="form-control pull-left" id="apprname" onchange="getInputValue1(this.value);" placeholder="Enter Emp code or Name">


                                        <button class="pull-right" id="inputvalue1" value=""
                                                onclick="serchByApprver(this.value);">Go</button>

                                    </div>

                                </div>
                            </div>

                        </div>
                        <table class="table table-striped table-bordered table-hover" id="sample_2">
                            <?php

                          

                           $getMyTeamLeaveRequestDataManager=$leave_class_obj->getMyTeamLeaveRequestDataManager($code);

                          $leaveID= $getMyTeamLeaveRequestDataManager[0];
                            $LvFrom=$getMyTeamLeaveRequestDataManager[1];
                            $LvTo=$getMyTeamLeaveRequestDataManager[2];
                            $LvDays=$getMyTeamLeaveRequestDataManager[3];
                            $LvType=$getMyTeamLeaveRequestDataManager[4];
                            $reason=$getMyTeamLeaveRequestDataManager[5];
                            $ApprovedBy=$getMyTeamLeaveRequestDataManager[6];
                            $status=$getMyTeamLeaveRequestDataManager[7];
                            $Levkey=$getMyTeamLeaveRequestDataManager[8];
                             $CreatedBy=$getMyTeamLeaveRequestDataManager[9];
                            $count_flag=$getMyTeamLeaveRequestDataManager[10];

                            /* $sql="select *,CONVERT (VARCHAR(10),LvFrom,103 ) as LvFrom,CONVERT (VARCHAR(10),LvTo,103 ) as LvTo from Leave WHERE ApprovedBy ='$code' and flag='1'";
                            $res=query($query,$sql,$pa,$opt,$ms_db);*/


                            
                            ?>
                            <thead >
                            <tr>
                                 <th>
                                    Requested By
                                </th>
                                <th>
                                    Category
                                </th>
                                <th>
                                    Approved By
                                </th>
                                <th>
                                    From Date
                                </th>

                                <th>
                                    To Date
                                </th>

                                <th>
                                    No. Of Days
                                </th>

                                <th>
                                    Reason
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
                                        <?php echo str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($leave_class_obj->getemployee_name($CreatedBy[$i]))))). "(".$CreatedBy[$i].")";?>
                                    </td>
                                     <td>
                                        <?php echo str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($leave_class_obj->getemployee_category($CreatedBy[$i])))));?>
                                    </td>
                                     <td>
                                        <?php
                                        $mngrcode=  $ApprovedBy[$i];
                                       
                                        echo str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($leave_class_obj->getemployee_name($mngrcode))))). "(".$mngrcode.")";
                                        ?>
                                    </td>
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
                                        <?php echo $reason[$i];?>
                                    </td>

                                    <td>
                                    <?php if($status[$i] == "1" || $status[$i] == ""){?>

                                       <a class="myod" data-toggle="modal" href="#large"
                                         onclick="getmyleaveId('<?php echo $Levkey[$i];?>','1','<?php echo $code;?>');">
								        <span class="label label-sm bg-blue-steel">
								        Pending </span>
                                       </a>

                                        <?php } else if($status[$i] == "2") {?>
                                         <a class="myod" data-toggle="modal" href="#large"
                                               onclick="getmyleaveId('<?php echo $Levkey[$i];?>','2','<?php echo $code;?>');">
                                        <span class="label label-sm label-success">
                                         Approved
								        </span>
                                         </a>

                                        <?php } else if($status[$i] == "3") {?>
                                            <a class="myod" data-toggle="modal" href="#large"
                                               onclick="getmyleaveId('<?php echo $Levkey[$i];?>','3','<?php echo $code;?>');">

                                         <span class="label label-sm label-danger">
                                            Rejected
    							         </span>
                                            </a>
                                        <?php } else if($status[$i] == "4") {?>
                                            <a class="myod" data-toggle="modal" href="#large"
                                               onclick="getmyleaveId('<?php echo $Levkey[$i];?>','4','<?php echo $code;?>');">
                                <span class="label label-sm bg-grey-cascade">
                               Cancelled
							 </span>
                                            </a>
                                             <?php } else if($status[$i] == "5") {?>
                                            <a class="myod" data-toggle="modal" href="#large"
                                               onclick="getmyleaveId('<?php echo $Levkey[$i];?>','4','<?php echo $code;?>');">
                                <span class="label label-sm bg-grey-cascade">
                               Cancelled Requested
                             </span>
                                            </a>
                                        <?php }?>

                                    </td>

                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END CONDENSED TABLE PORTLET-->
            </div>
        </div>

    </div>
</div>