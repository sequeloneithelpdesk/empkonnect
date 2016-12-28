<div class="page-content-wrapper" xmlns="http://www.w3.org/1999/html">
<div class="page-content">
<!--modal-dialog -->
<div class="modal fade bs-modal-lg" id="large" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog lg">
		<!-- modal-content -->
		<div class="modal-content" >
			<div class="modal-header portlet box blue">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title white-txt"><div class="caption"><b>My Past Attendance </b></div></h4>
			</div>
			<div class="modal-body" id="mypastrequest">                
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
					My Past Attendance 
				</div>
			</div>
			<div class="portlet-body">
			<div class="table-toolbar">
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="btn-group ">
                                        <select class="form-control" onchange="getRelatedSelectbox(this.value,'<?php echo $code;?>');">
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

                                    		<div class="col-md-10">
                                            <select class="form-control"  name="byname"  id="byname" onchange="getInputValue(this.value);">
                                             <option value="0">Select ..</option>
                                            <?php 
                                                $sqlCrea="select approvedBy from markPastAttendance";
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
											<div class="col-md-2" >
                                            <button class="btn  bg-blue" id="inputvalue" value="" 
                                            onclick="serchByCodeName(this.value,'<?php echo $code;?>');">Go</button>
											</div>

                                    </div>

                                </div>
                            </div>

                        </div>
				<table class="table table-striped table-bordered table-hover" id="sample_2">
                <?php
                
                           $getMyMarkPastRequestData=$attendance_class_obj->getMyMarkPastRequestData($code);
                           //print_r($getMyMarkPastRequestData);

                          $markPastId= $getMyMarkPastRequestData[0];
                            $date_from=$getMyMarkPastRequestData[1];
                            $date_to=$getMyMarkPastRequestData[2];
                            $CreatedOn=$getMyMarkPastRequestData[3];
                            $approvedBy=$getMyMarkPastRequestData[4];
                            $notMarkingReason=$getMyMarkPastRequestData[5];
                            $action_status=$getMyMarkPastRequestData[6];
                            $AttnKey=$getMyMarkPastRequestData[7];
                            $count_flag=$getMyMarkPastRequestData[8];

                       // print_r($AttnKey) ;
                          // exit;
                           /* $sql="select *,CONVERT (VARCHAR(10),LvFrom,103 ) as LvFrom,CONVERT (VARCHAR(10),LvTo,103 ) as LvTo from Leave WHERE CreatedBy='$code' and flag='1'";
                            $res=query($query,$sql,$pa,$opt,$ms_db);
                            $len = $num($res);*/
                            /* while ($row = $fetch($res)){
                    */

                          
				
                /*$sql="select *,CONVERT(VARCHAR(12),cast(date_from as date), 101) as date_from , CONVERT(VARCHAR(12),cast(date_to as date), 101) as date_to,CONVERT (VARCHAR(27),CreatedOn,109 ) as CreatedOn from markPastAttendance WHERE CreatedBy='$code' and flag='1' ";
                $res=query($query,$sql,$pa,$opt,$ms_db);
                $len = $num($res);*/
                ?>
				<thead >
				<tr>
                    <th>
                        Applied Date And Time
                    </th>

                    <th>
                       Approver Name
                    </th>

					<th>
                      From Date-To Date
                    </th>

                    <th>
                      Not Marking Reason
                    </th>

                    <th>
                        Status
                    </th>
				</tr>
				</thead>
				<tbody id="searchMyData">
				
                    <?php

                for ($i=0;$i<$count_flag;$i++){
                    $sqlWork="select * from LOVMast where LOV_Field='reasonForNotMarking' and LOV_Value='".$notMarkingReason[$i]."'";
                    $resWork=query($query,$sqlWork,$pa,$opt,$ms_db);
                    $resData=$fetch($resWork);
                ?>
               
				<tr>
					<td>
						<?php echo dateTimeFormat($CreatedOn[$i]);?>
						 
					</td>

					<td>
						 <?php
                           $mngrcode=$approvedBy[$i];
                            $sql1="select EMP_NAME from HrdMastQry WHERE Emp_Code='$mngrcode'";
                            $res1=query($query,$sql1,$pa,$opt,$ms_db);
                            $data1=$fetch($res1);
                            echo $data1['EMP_NAME']; echo "(".$mngrcode.")";
                            ?>
					</td>

					<td>
						 <?php if($row['date_to'] == ""){ echo dateFormat($date_from[$i]) ." to ". dateFormat($date_from[$i]); }
						 else { echo dateFormat($date_from[$i]) ." to ".dateFormat($date_to[$i]); } ?>
					</td>

					<td>
						<?php 
							
                                    echo $resData['LOV_Text']; 
                              
						?>
					</td>
					
					<td>
						<?php if($action_status[$i] == "1" || $action_status[$i]== ""){?>
							<a class="myod" data-toggle="modal" href="#large" 
							onclick="getmypastId('<?php echo $AttnKey[$i];?>','1','<?php echo $code;?>');">
								<span class="label bg-blue-steel">
								Pending </span>
							</a>	
                            <?php } else if($action_status[$i] == "2") {?>
                            	<a class="myod" data-toggle="modal" href="#large"
                            	onclick="getmypastId('<?php echo $AttnKey[$i];?>','2','<?php echo $code;?>');">
                                <span class="label label-success">
                               Approved
								 </span>
							 </a>
                            <?php } else if($action_status[$i] == "3") {?>
                            	<a class="myod" data-toggle="modal" href="#large"
                            	onclick="getmypastId('<?php echo $AttnKey[$i];?>','3','<?php echo $code;?>');">
                                <span class="label  label-danger">
                               Rejected
							 </span>
							 </a>
                            <?php } else if($action_status[$i] == "4") {?>
                            	<a class="myod" data-toggle="modal" href="#large"
                            	onclick="getmypastId('<?php echo $AttnKey[$i];?>','4','<?php echo $code;?>');">
                                <span class="label bg-grey-cascade">
                               Cancelled
							 </span>
							 </a>
                            <?php }else if($action_status[$i] == "5") {?>
                            	<a class="myod" data-toggle="modal" href="#large"
                            	onclick="getmypastId('<?php echo $AttnKey[$i];?>','4','<?php echo $code;?>');">
                                <span class="label bg-blue-steel">
                               Cancellation Request Pending
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
	</div>
</div>

</div>
</div>

