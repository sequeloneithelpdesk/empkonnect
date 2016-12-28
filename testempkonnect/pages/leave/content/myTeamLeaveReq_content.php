<div class="page-content-wrapper" xmlns="http://www.w3.org/1999/html">
    <div class="page-content">
        <!--modal-dialog -->
        <div class="modal fade bs-modal-lg" id="large" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog lg">
                <!-- modal-content -->
                <div class="modal-content" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title"><div class="caption"><b>My Leave Request </b></div></h4>
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

                             $fsql= "select * from HrdMastQry where MNGR_CODE='$code'";
                                        $result=query($query,$fsql,$pa,$opt,$ms_db);
                                        $len = $num($result);
                                        if($len >0){
                                            $e=0;
                                           $team="";
                                            while($arr = $fetch($result)){
                                                if($e==0){ }
                                                    else{
                                                        $team.=",";
                                                    }
                                            $team .= "'".$arr['Emp_Code']."'";
                                            $e++;
                                            } 
                                        }

                             $sql="select *,CONVERT (VARCHAR(10),LvFrom,103 ) as LvFrom,CONVERT (VARCHAR(10),LvTo,103 ) as LvTo from Leave WHERE CreatedBy in ($team) and flag='1'";
                            $res=query($query,$sql,$pa,$opt,$ms_db);
                            
                            ?>
                            <thead >
                            <tr>
                                <th>
                                    Approbed By
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

                            while ($row = $fetch($res)){
                                ?>
                                <tr>
                                    <td>
                                        <?php
                                        $mngrcode=$row['ApprovedBy'];
                                        $sql1="select EMP_NAME from HrdMastQry WHERE Emp_Code='$mngrcode'";
                                        $res1=query($query,$sql1,$pa,$opt,$ms_db);
                                        $data1=$fetch($res1);
                                        echo $data1['EMP_NAME'];
                                        ?>
                                    </td>

                                    <td>
                                        <?php echo $row['LvFrom'];?>
                                    </td>

                                    <td>
                                        <?php echo $row['LvTo'];?>
                                    </td>

                                    <td>
                                        <?php echo $row['LvDays'];?>
                                    </td>

                                    <td>
                                        <?php echo $row['reason'];?>
                                    </td>

                                    <td>
                                    <?php if($row['status'] == "1" || $row['status'] == ""){?>

                                       <a class="myod" data-toggle="modal" href="#large"
                                         onclick="getmyleaveId('<?php echo $row['leaveID'];?>','1','<?php echo $code;?>');">
								        <span class="label label-sm bg-blue-steel">
								        Pending </span>
                                       </a>

                                        <?php } else if($row['status'] == "2") {?>
                                         <a class="myod" data-toggle="modal" href="#large"
                                               onclick="getmyleaveId('<?php echo $row['leaveID'];?>','2','<?php echo $code;?>');">
                                        <span class="label label-sm label-success">
                                         Approved
								        </span>
                                         </a>

                                        <?php } else if($row['status'] == "3") {?>
                                            <a class="myod" data-toggle="modal" href="#large"
                                               onclick="getmyleaveId('<?php echo $row['leaveID'];?>','3','<?php echo $code;?>');">

                                         <span class="label label-sm label-danger">
                                            Rejected
    							         </span>
                                            </a>
                                        <?php } else if($row['status'] == "4") {?>
                                            <a class="myod" data-toggle="modal" href="#large"
                                               onclick="getmyleaveId('<?php echo $row['leaveID'];?>','4','<?php echo $code;?>');">
                                <span class="label label-sm bg-grey-cascade">
                               Cancelled
							 </span>
                                            </a>
                                        <?php }?>

                                    </td>

                                </tr>
                                <?php $i++; } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END CONDENSED TABLE PORTLET-->
            </div>
        </div>

    </div>
</div>