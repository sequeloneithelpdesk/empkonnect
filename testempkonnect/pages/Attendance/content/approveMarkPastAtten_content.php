<div class="page-content-wrapper" xmlns="http://www.w3.org/1999/html">
    <div class="page-content">
        <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
        <div class="modal fade bs-modal-lg" id="large" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog lg">
            <!-- modal-content -->
            <div class="modal-content" >
                <div class="modal-header portlet box blue">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title white-txt"><div class="caption"><span>Approve Past Attendance </span></div></h4>
                </div>
                <div class="modal-body" id="apprpastrequest">                
                    
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
                            <i class="fa fa-globe"></i>Past attendance Request - Approval
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

                                    <div class="btn-group ">
                                        <select class="form-control" onchange="getRelatedSelectbox(this.value,'<?php echo $code;?>');">
                                            <option value="0">Select....</option>
                                            <option value="1">Request Applied On</option>
                                            <option value="2">Request Status</option>
                                            <option value="3">By Requester Name</option>
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
                                     <button class="btn" onclick="searchByDate('<?php echo $code;?>');" >Go</button>  
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

                                            <!-- <input type="text" name="byname" class="form-control pull-left" id="byname" onchange="getInputValue(this.value);" placeholder="Enter Emp code or Name"> -->
											<div class="col-md-10">
                                            <select class="form-control" name="byname"  id="byname" onchange="getInputValue(this.value);">
                                             <option value="0">Select ..</option>
                                            <?php 
                                                $sqlCrea="select CreatedBy from markPastAttendance";
                                                $resCrea=query($query,$sqlCrea,$pa,$opt,$ms_db);
                                                while ($rowCrea = $fetch($resCrea)) {
                                                  $arrEmp[]="'" .$rowCrea['CreatedBy'] . "'";
                                                }

                                                $strEmp =  implode(",", $arrEmp) ;

                                                $sqlEmp="Select Emp_Code,EMP_NAME from HrdMastQry where Emp_Code in ($strEmp) ";
                                                $resEmp=query($query,$sqlEmp,$pa,$opt,$ms_db);
                                                while ($rowEmp =$fetch($resEmp)) {?>
                                                    <option value="<?php echo $rowEmp['Emp_Code']?>"><?php echo $rowEmp['EMP_NAME']?></option> 
                                              <?php  }
                                                
                                                 ?> 
                                             </select>
											</div>
											<div class="col-md-2" >
                                            <button class="btn  bg-blue" id="inputvalue" value="" 
                                            onclick="serchByCodeName(this.value,'<?php echo $code;?>');">Go</button>
											</div>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                            <?php
                             $sql="select *,CONVERT (VARCHAR(10),date_from,103 ) as date_from , CONVERT (VARCHAR(10),date_to,103 ) as date_to,CONVERT (VARCHAR(25),CreatedOn,109 ) as CreatedOn  from markPastAttendance WHERE approvedBy='$code' and flag='1'";
                             $res=query($query,$sql,$pa,$opt,$ms_db);
                             $len = $num($res);
                             $i=0;
                            ?>
                            <tr>
                                
                                <th class="table-checkbox">
                                    <input type="checkbox" id="Allcheck" value="0" 
                                    onclick="allCheck('Allcheck','<?php echo $code;?>');" class="group-checkable" data-set="#sample_1 .checkboxes"/>
                                </th>
                                <th>
                                    Applied Date and Time
                                </th>

                                <th>
                                   Requester Name
                                </th>

                                <th>
                                   From Date - To Date
                                </th>

                                <th>
                                   Not Marking Reason
                                </th>

                                <th>
                                    Status
                                </th>   
                            </tr>
                            </thead>

                            <tbody id="searchData">
                            <?php
                                while ($row = $fetch($res)){
                            ?>
                            <tr class="odd gradeX">
                            <?php if( $row['action_status']== 2 || $row['action_status']== 3 || $row['action_status']== 4){?>
                                    <td></td>
                                <?php }else { ?>
                                <td><input type="checkbox" class="checkboxes" id="<?php echo "Mulcheck".$i;?>" onclick="mulCheck('<?php echo "Mulcheck".$i;?>');" value="<?php echo $row['markPastId'];?>"/>
                                </td>
                                <?php } ?>
                                <td >
                                    <?php echo $row['CreatedOn'];?>

                                </td>

                                <td >
                                    <?php
                                    $usercode=$row['CreatedBy'];
                                    $sql1="select EMP_NAME,Emp_Code from HrdMastQry WHERE Emp_Code='$usercode'";
                                    $res1=query($query,$sql1,$pa,$opt,$ms_db);
                                    $data1=$fetch($res1);
                                    echo $data1['EMP_NAME']; echo " (". $data1['Emp_Code']."}"
                                    ?>

                                </td>
                                <td class="center">
                                   <?php echo $row['date_from'];?> to 
                                   <?php if($row['date_to'] == "01/01/1900"){
                                    echo $row['date_from'];
                                    }else{
                                        echo $row['date_to'];
                                    } ?>
                                </td>
                                
                                <td>
                                    <?php 
                                    if($row['notMarkingReason'] == "forgot"){
                                        echo "Forgot to punch/mark attendance";
                                    }else if($row['notMarkingReason'] == "machine_not_work"){
                                        echo "Machine is not working ";
                                    }else{
                                        echo "Others";
                                    }

                                    ?>
                                </td>

                                <td> <?php if($row['action_status'] == "1" || $row['action_status'] == ""){?>
                            <a class="myod" data-toggle="modal" href="#large" 
                            onclick="getmypastId('<?php echo $row['markPastId'];?>','1','<?php echo $code;?>');">
                                <span class="label  bg-blue-steel">
                                Pending </span>
                            </a>    
                            <?php } else if($row['action_status'] == "2") {?>
                                <a class="myod" data-toggle="modal" href="#large"
                                onclick="getmypastId('<?php echo $row['markPastId'];?>','2','<?php echo $code;?>');">
                                <span class="label  label-success">
                               Approved
                                 </span>
                             </a>
                            <?php } else if($row['action_status'] == "3") {?>
                                <a class="myod" data-toggle="modal" href="#large"
                                onclick="getmypastId('<?php echo $row['markPastId'];?>','3','<?php echo $code;?>');">
                                <span class="label  label-danger">
                               Rejected
                             </span>
                             </a>
                            <?php } else if($row['action_status'] == "4") {?>
                                <a class="myod" data-toggle="modal" href="#large"
                                onclick="getmypastId('<?php echo $row['markPastId'];?>','4','<?php echo $code;?>');">
                                <span class="label  bg-grey-cascade">
                               Cancelled
                             </span>
                             </a>
                            <?php }  else if($row['action_status'] == "5") {?>
                                <a class="myod" data-toggle="modal" href="#large"
                                onclick="getmypastId('<?php echo $row['markPastId'];?>','5','<?php echo $code;?>');">
                                <span class="label  bg-blue-steel">
                               Cancelled Request Pending
                             </span>
                             </a>
                            <?php }?>
                                       
                                </td>

                                
                            </tr>
                            <?php $i++; } ?>
                            </tbody>
                        </table>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4" style="margin-top: 20px;">
                                    <input type="hidden" value="" id="selectedcheckbox" />
                                    <select class="form-control" onchange="showSubmitButton(this.value,'<?php echo $len;?>');">
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

                                <div class="col-md-4" style="margin-top: 19px;">
                                    <textarea class="form-control" name="actGroupRemarks" id="actGroupRemarks" placeholder="Please Enter Remarks"></textarea>
                                </div>

                                <div class="col-md-offset-4"  id="submitButtonDiv" style="display: none; margin-top: 19px;">
                                    <button class="btn btn-primary" id="submitButton" value="" onclick="applyAction('<?php echo $code;?>',this.value);">Submit</button>
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