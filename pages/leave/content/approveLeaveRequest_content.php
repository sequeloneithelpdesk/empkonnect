
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
       <div class="modal fade bs-modal-lg" id="large" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog lg">
        <!-- modal-content -->
        <div class="modal-content" >
            <div class="modal-header portlet box blue">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title white-txt"><div class="caption"><b>Approve Leave Request</b></div></h4>
            </div>
            <div class="modal-body" id="approveLevrequest">                
                <?php //include ("content/view_myodrequest.php"); ?>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>
        <!-- /.modal -->

        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-globe"></i>Approve Leave Request
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse">

                            </a>
                            
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-toolbar">
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="btn-group selectAlign">
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
                                        <input type="date" class="form-control" name="fromDate" id="fromDate" placeholder="dd/mm/yy">
                                        </div>
                                        <div class="col-md-5">  
                                        <label class="control-label">
                                            To Date                
                                        </label>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="date" class="form-control" name="toDate" id="toDate" placeholder="dd/mm/yy">
                                        </div>
                                        <div class="col-md-2" style="margin-top: 25px;">
                                        <button class="btn submit" onclick="searchByDate('<?php echo $code;?>');">Go</button>
                                        </div>
                                     
                                    </div>

                                    <div class="btn-group" id="actionSearch" style="display: none;margin-left: 45px;">
                                        <select class="form-control" onchange="searchByStatus(this.value,'<?php echo $code;?>');">
                                            <option value="" >Select ..</option>
                                            <?php
                                            $sql="select * from LOVMast where LOV_Field='status'";
                                            $result=query($query,$sql,$pa,$opt,$ms_db);
                                            while ($row = $fetch($result)){
                                                ?>
                                                <option value="<?php echo $row['LOV_Value']?>"><?php echo $row['LOV_Text']?></option>
                                            <?php } ?>

                                        </select>
                                    </div>

                                    <div class="btn-group" id="bynameSearch" style="display: none;margin-left: 45px;">
                                        <div class="col-md-10">
                                            <input type="text" name="byname" class="form-control pull-left" id="byname" onchange="getInputValue(this.value);" placeholder="Enter Emp code or Name">
                                        </div>
                                            
                                        <div class="col-md-2">

                                            <button class="btn submit" id="inputvalue" value="" onclick="serchByCodeName(this.value,'<?php echo $code;?>');">Go</button>
                                        </div>
                                    </div>

                                    <div class="btn-group" id="byRequesterSearch" style="display: none;margin-left: 45px;">
                                        <div class="col-md-10">
                                            <input type="text" name="byRequest" class="form-control pull-left" id="byRequest" onchange="getInputRequestValue(this.value);" placeholder="Enter Emp code or Name">
                                        </div>
                                            
                                        <div class="col-md-2">
                                            <button class="btn submit" id="inputrequest" value="" onclick="serchByRequestName(this.value,'<?php echo $code;?>');">Go</button>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <table class="table table-striped table-bordered table-hover" id="sample_2">
                            <thead>
                            <?php
                            $sql="select *,convert(varchar(10),LvFrom,103)as LvFrom, convert(varchar(10),LvTo,103)as LvTo from leave where ApprovedBy='$code' and flag='1'";
                            $res=query($query,$sql,$pa,$opt,$ms_db);
                            $len = $num($res);
                            
                            $i=0;
                            ?>
                            <tr>
                                <th class="table-checkbox">
                                    <input type="checkbox" id="Allcheck" value="0" 
                                    onclick="allCheck('Allcheck','<?php echo $code;?>');" class="group-checkable" data-set="#sample_2 .checkboxes"/>
                                </th>

                                <th>
                                    From Date
                                </th>

                                <th>
                                    To Date
                                </th>
								<th>
                                    Applied Leave
                                </th>
                                 <th>
                                   Requested By
                                </th>
                                 <th>
                                   Category
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
                                <th></th>
                            </tr>
                            </thead>

                            <tbody id="searchData">
                            <?php
                                while ($row = $fetch($res)){
                            ?>

                            <tr class="odd gradeX">
                            <?php if( $row['status']== 2 || $row['status']== 3 || $row['status']== 4 || $row['status']== 5){?>
                                    <td></td>
                                <?php }else { ?>
                                <td>
                                <input type="checkbox" class="checkboxes" id="<?php echo "Mulcheck".$i;?>" onclick="mulCheck('<?php echo "Mulcheck".$i;?>','<?php echo "key".$i;?>');" value="<?php echo $row['leaveID'];?>"/>
                                </td>
                                <?php } ?>
                                
                                <td>
                                    <?php echo $row['LvFrom'];?>
                                </td>
                                <td>
                                    <?php echo $row['LvTo'];?>
                                </td>
								<td>
                                    <?php echo $leave_class_obj->getemployee_leave_type($row['LvType']) ;?>
                                </td>
                                 <td >
                                    <?php
                                    $usercode=$row['CreatedBy'];
                                    $sql1="select EMP_NAME,GRD_NAME from HrdMastQry WHERE Emp_Code='$usercode'";
                                    $res1=query($query,$sql1,$pa,$opt,$ms_db);
                                    $data1=$fetch($res1);
                                    $cate=$data1['GRD_NAME'];
                                    echo $data1['EMP_NAME']." (".$usercode.")";
                                    ?>

                                </td>
                                <td>
                                    <?php
                                   
                                    echo $cate;
                                    ?>

                                </td>
                                <td>
                                    <?php echo $row['LvDays'];?>
                                </td>
                                <td>
                                    <?php echo $row['reason'];?>
                                </td>

                               
                                <td> <?php if($row['status'] == "1"){?>
										<a class="myod" data-toggle="modal" href="#large" 
                            onclick="getapprleaveId('<?php echo $row['leaveID'];?>','1','<?php echo $code;?>');">
                                <span class="label bg-blue-steel">
                                Pending </span>
                                    <?php } else if($row['status'] == "2") {?>
                                        <a class="myod" data-toggle="modal" href="#large" 
                            onclick="getapprleaveId('<?php echo $row['leaveID'];?>','1','<?php echo $code;?>');">
                                <span class="label label-success">
                                Approved </span>
                                    <?php } else if($row['status'] == "3") {?>
                                        <a class="myod" data-toggle="modal" href="#large" 
                            onclick="getapprleaveId('<?php echo $row['leaveID'];?>','1','<?php echo $code;?>');">
                                <span class="label label-danger">
                                Rejected </span>
                                    <?php } else if($row['status'] == "4") {?>
                                        <a class="myod" data-toggle="modal" href="#large" 
                            onclick="getapprleaveId('<?php echo $row['leaveID'];?>','1','<?php echo $code;?>');">
                                <span class="label bg-grey-cascade">
                                Cancelled </span>
                                 <?php } else if($row['status'] == "5") {?>
                                        <a class="myod" data-toggle="modal" href="#large" 
                            onclick="getapprleaveId('<?php echo $row['leaveID'];?>','1','<?php echo $code;?>');">
                                <span class="label bg-grey-cascade">
                                Cancelled Requested </span>
                                    <?php }?>
                                       
                                </td>

                                <td><input type="hidden" value="
                                <?php echo $row['Levkey'];?>" 
                                name="key" id="key<?php echo $i;?>">
                                </td>
                            </tr>

                            <?php $i++; } ?>
                            </tbody>
                        </table>

                        <div class="row">
                            <div class="col-md-6">
                            <textarea class="form-control input-medium" name="actRemarks" id="actRemarks" placeholder="Please Enter Remarks"></textarea>
                        </div>
						  <div class="col-md-6">
                        <label>
                            <input type="radio" name="action_radio_all"  class="icheck" id="action_radio_all" value="0"> Unplanned</label>
                              <label>
                            <input type="radio" name="action_radio_all"  class="icheck" id="action_radio_all" value="1"> Planned</label>
                        </div>
                            <div class="col-md-8" style="float: right;">
                            <label id="hide_LeaveReasons_combo1" style="display: none;" class="col-md-5">
                                <select class="form-control" id="LeaveReasonscombo1" onchange="change_LeaveReasons1();">
                                            <option value="" >Select ..</option>
                                            <?php
                                            $sql6="select * from LOVMast where LOV_Field='LeaveReasons'";
                                            $result6=query($query,$sql6,$pa,$opt,$ms_db);
                                            while ($row6 = $fetch($result6)){
                                                ?>
                                                <option value="<?php echo $row6['LOV_Value']?>"><?php echo $row6['LOV_Text']?></option>
                                            <?php } ?>

                                        </select></br>
                            </label>
                             <label id="hide_LeaveReasons_text1" style="display: none;" class="col-md-5">
                                <input type="text" name="othercombo" class="form-control" id="othercombo1" placeholder="Enter Your Unplanned Reason">
                                  </br>         
                            </label>
                           </div>
                        </div>
                            <div class="col-md-12">
                                <div class="col-md-offset-4 col-md-4 col-md-offset-4" style="margin-top: 20px;">
                                <input type="hidden" value="" id="selectedcheckbox" />
                                <input type="hidden" name="key" id="key" value="">

                                <select class="form-control" id="selected_status_div" onchange="showSubmitButton(this.value,'<?php echo $len;?>');">
                                    <option value="">Select Action..</option>
                                    <?php
                                        $sql="select * from LOVMast where LOV_Field='status' and LOV_Value in ('2','3')";
                                        $result=query($query,$sql,$pa,$opt,$ms_db);
                                       while ($row = $fetch($result)){
                                    ?>
                                    <option value="<?php echo $row['LOV_Value']?>"><?php echo $row['LOV_Text']?></option>
                                    <?php } ?>
                                </select>
                                    </div>
                                <div class="col-md-offset-4" id="submitButtonDiv" style="display: none; margin-top: 19px;">
                                    <button class="btn btn-primary" id="submitButton" value="" onclick="submitApprovelRequest('selectedcheckbox','selected_status_div','0');">Submit</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>

        <!-- END PAGE CONTENT-->
    </div>
</div>