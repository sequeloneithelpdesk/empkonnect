<div class="page-content-wrapper" xmlns="http://www.w3.org/1999/html">
    <div class="page-content">
        <!--modal-dialog -->
        <div class="modal fade bs-modal-lg" id="large" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog lg">
                <!-- modal-content -->
                <div class="modal-content" >
                    <div class="modal-header portlet box blue">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title white-txt"><div class="caption"><b>My Compensatory Off </b></div></h4>
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

                                    <div class="btn-group">
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
                                            <button class="btn bg-blue" onclick="searchByDate('<?php echo $code;?>')">Go</button>
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
                                            <label class="control-label"></label>
                                             <select class="form-control" name="byname"  id="byname" onchange="getInputValue(this.value);">
                                             <option value="0">Select ..</option>
                                            <?php 
                                                $sqlCrea="select approvedBy from compOff";
                                                $resCrea=query($query,$sqlCrea,$pa,$opt,$ms_db);
                                                while ($rowCrea = $fetch($resCrea)) {
                                                  $arrEmp[]="'" .$rowCrea['approvedBy'] . "'";
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

                                        <div class="col-md-2" style="margin-top: 17px;">
                                            <button class="btn  bg-blue" id="inputvalue" value="" onclick="serchByCodeName(this.value,'<?php echo $code;?>');">Go</button>
                                        </div>
                                    </div>

                                   

                                </div>
                            </div>

                        </div>
                        <table class="table table-striped table-bordered table-hover" id="sample_2">
                            <?php
                            $sql="select *,CONVERT (VARCHAR(10),wd_date,103 ) as work_done,CONVERT (VARCHAR(10),CreatedOn,103 ) as CreatedOn  from compOff WHERE CreatedBy='$code' and flag_val='1'";
                            $res=query($query,$sql,$pa,$opt,$ms_db);
                            $len = $num($res);

                            ?>
                            <thead >
                            <tr>
                                <th>
                                    Request Applied Date
                                </th>
                              
                                <th>
                                    Work Done Date
                                </th>
                                  <th>
                                    Approved By
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
                                        <?php echo $row['CreatedOn'];?>
                                    </td>
                                   
                                    <td>
                                        <?php echo $row['work_done'];?>
                                    </td>
                                     <td>
                                        <?php
                                        $mngrcode=$row['approvedBy'];
                                        $sql1="select EMP_NAME from HrdMastQry WHERE Emp_Code='$mngrcode'";
                                        $res1=query($query,$sql1,$pa,$opt,$ms_db);
                                        $data1=$fetch($res1);
                                        echo $data1['EMP_NAME']."(".$mngrcode.")";
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo $row['noOfDays'];?>
                                    </td>
                                    <td>
                                        <?php echo $row['reason'];?>
                                    </td>
                                    
                                    <td>
                                        <?php if($row['action_status'] == "1" || $row['action_status'] == ""){?>
                                            <a class="myod" data-toggle="modal" href="#large"
                                               onclick="getmycompoffId('<?php echo $row['compOffId'];?>','1','<?php echo $code;?>');">
								<span class="label label-sm bg-blue-steel">
								Pending </span>
                                            </a>
                                        <?php } else if($row['action_status'] == "2") {?>
                                            <a class="myod" data-toggle="modal" href="#large"
                                               onclick="getmycompoffId('<?php echo $row['compOffId'];?>','2','<?php echo $code;?>');">
                                <span class="label label-sm label-success">
                               Approved
								 </span>
                                            </a>
                                        <?php } else if($row['action_status'] == "3") {?>
                                            <a class="myod" data-toggle="modal" href="#large"
                                               onclick="getmycompoffId('<?php echo $row['compOffId'];?>','3','<?php echo $code;?>');">
                                <span class="label label-sm label-danger">
                               Rejected
							 </span>
                                            </a>
                                        <?php } else if($row['action_status'] == "4") {?>
                                            <a class="myod" data-toggle="modal" href="#large"
                                               onclick="getmycompoffId('<?php echo $row['compOffId'];?>','4','<?php echo $code;?>');">
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

