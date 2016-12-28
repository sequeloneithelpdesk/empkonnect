<div class="page-content-wrapper" xmlns="http://www.w3.org/1999/html">
    <div class="page-content">
        <!--modal-dialog -->
        <div class="modal fade bs-modal-lg" id="large" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog lg">
                <!-- modal-content -->
                <div class="modal-content" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title"><div class="caption"><b>My Team Compensatory Off </b></div></h4>
                    </div>
                    <div class="modal-body" id="mycompoff">
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
                            <i class="fa fa-globe"></i>My Compensatory Off
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="reload">
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
                                            <option value="3">By Approver Name</option>
                                        </select>
                                    </div>

                                    <div class="btn-group" id="monthlySearch" style="display: none;margin-left: 45px;">
                                        <div class="col-md-6">
                                            <label class="control-label">
                                                From Date
                                            </label>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="date" class="form-control" name="fromPastDate" id="fromDate" placeholder="dd/mm/yy">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label">
                                                To Date
                                            </label>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="date" class="form-control" name="toPastDate" id="toDate" placeholder="dd/mm/yy">
                                        </div>
                                        <button class="btn" onclick="searchByDate('<?php echo $code;?>')">Go</button>
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

                            $sql="select *,CONVERT (VARCHAR(10),wd_date,103 ) as work_done from compOff WHERE CreatedBy IN ($team) and flag_val='1'";
                            $res=query($query,$sql,$pa,$opt,$ms_db);
                            $len = $num($res);

                            ?>
                            <thead >
                            <tr>
                                <th>
                                    Request To
                                </th>
                                <th>
                                    Work Done Date
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
                                        $mngrcode=$row['approvedBy'];
                                        $sql1="select EMP_NAME from HrdMastQry WHERE Emp_Code='$mngrcode'";
                                        $res1=query($query,$sql1,$pa,$opt,$ms_db);
                                        $data1=$fetch($res1);
                                        echo $data1['EMP_NAME'];
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo $row['work_done'];?>
                                    </td>
                                    <td>
                                        <?php echo $row['noOfDays'];?>
                                    </td>
                                    <td>
                                        <?php echo $row['reason'];?>
                                    </td>
                                    <td>
                                        <?php if($row['action_status'] == "1" || $row['action_status'] == ""){?>
                                            <span class="label label-sm bg-blue-steel">
								                Pending </span>

                                        <?php } else if($row['action_status'] == "2") {?>

                                            <span class="label label-sm label-success">
                                           Approved
                                             </span>

                                        <?php } else if($row['action_status'] == "3") {?>
                                            <span class="label label-sm label-danger">
                                               Rejected
                                             </span>

                                        <?php } else if($row['action_status'] == "4") {?>
                                              <span class="label label-sm bg-grey-cascade">
                                               Cancelled
                                             </span>
                                                            
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

