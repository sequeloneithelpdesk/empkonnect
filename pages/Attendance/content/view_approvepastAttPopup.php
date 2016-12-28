<?php 
	include('../../db_conn.php');
	include('../../configdata.php');
	include ('../../main_class.php');
	$main_class_obj=new main_class();
	$id=$_POST['id'];
	$status=$_POST['status'];
	$code=$_POST['code'];
	 
	  $sql="select *,CONVERT (VARCHAR(10),date_from,103 ) as date_from , CONVERT (VARCHAR(10),date_to,103 ) as date_to,CONVERT (VARCHAR(19),CreatedOn) as CreatedOn  from markPastAttendance WHERE markPastId='$id'";
        $res=query($query,$sql,$pa,$opt,$ms_db);
        $row=$fetch($res);

        $requestercode=$row['CreatedBy'];
        $sql1="select * from HrdMastQry WHERE Emp_Code='$requestercode'";
        $res1=query($query,$sql1,$pa,$opt,$ms_db);
        $data1=$fetch($res1);

	$actionUserCode=$row['approvedBy'];
	$sql2="select EMP_NAME,DSG_NAME, MailingAddress,EmpImage from hrdmastqry WHERE Emp_Code='$actionUserCode'";
	$res2=query($query,$sql2,$pa,$opt,$ms_db);
	$data3=$fetch($res2);
	
?>
<style type="text/css">
.highlight-text { background-color: yellow; padding: 3px 10px; min-width: 32%; }
</style>			
<div class="portlet light bordered">

	<div class="portlet-body form">
		<!-- BEGIN FORM-->
		<form class="form-horizontal" role="form">
			<div class="form-body">
				<!-- <h3 class="form-section">Address</h3> -->
				<div class="row">
					<div class="col-md-12">
						<div class="form-group m-0">
							<label class="col-md-6 ">Applied Date and Time:</label>
							<div class="col-md-6">
								<p class="form-control-static">
							<?php
                            echo $row['CreatedOn'];
                            ?>
							</p>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<div class="form-group m-0">
							<label class="col-md-6">Requested By:</label>
							<div class="col-md-6">
								<p class="form-control-static">
							<?php
							
                            echo $data1['EMP_NAME'].' ('.$data1['Emp_Code'].')';
                            ?>
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group m-0">
							<label class="col-md-6">Shift Timing:</label>
							<div class="col-md-6">
								<p class="form-control-static">
									<?php  
										$EmployeeShiftByDate=$main_class_obj->getEmployeeShiftByDate($requestercode, $row['date_from']);
										echo $EmployeeShiftByDate['Shift_From'].' - '.$EmployeeShiftByDate['Shift_To'];
									?>									
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group  m-0">
							<label class="col-md-6">For Date:</label>
							<div class="col-md-6">
								<p class="form-control-static">
									<?php  echo $row['date_from'];?>
								</p>
							</div>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-12">
						<div class="form-group m-0">
							<label class="col-md-6 ">To Date:</label>
							<div class="col-md-6">
								<p class="form-control-static">
									<?php  if($row['date_to'] == "01/01/1900"){
											echo  $row['date_from'];
										}else{
											echo $row['date_to'];
											}?>
								</p>
							</div>
						</div>
					</div>
					<!--/span-->
				</div>
				<!--/row-->
				<div class="row">
					<div class="col-md-12">
						<div class="form-group  m-0">
							<label class="col-md-6">Remarks:</label>
							<div class="col-md-6">
								<p class="form-control-static">
									<?php  echo $row['remarks'];?>
								</p>
							</div>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-12">
						<div class="form-group  m-0">
							<label class="col-md-6">Not Marking Reason:</label>
							<div class="col-md-6">
								<p class="form-control-static">
									<?php 
									$higlightInClass = $higlightOutClass = $higlightInOutClass = FALSE;
                                    if($row['notMarkingReason'] == "forgot"){
                                        echo "Punch In - Missed";
                                        $higlightInClass = TRUE;
                                    }else if($row['notMarkingReason'] == "1"){
										echo "Punch In & Out - Missed";
										$higlightInOutClass = TRUE;
                                    }else if($row['notMarkingReason'] == "machine_not_work"){
                                        echo "Punch Out - Missed ";
                                        $higlightOutClass = TRUE;
                                    }else{
                                        echo "Others";
                                        $higlightInOutClass = TRUE;
                                    }

                                    ?>
								</p>
							</div>
						</div>
					</div>
					<!--/span-->
				</div>

				<div class="row">
					<div class="col-md-12">
						<div class="form-group  m-0">
							<label class="col-md-6">In Time:</label>
							<div class="col-md-6">
								<p class="form-control-static <?php if($higlightInClass || $higlightInOutClass) echo "highlight-text"; ?>">
									<?php  if($row['intime'] == "00:00:00"){
											echo "";
									}else{
										echo timeFormat($row['intime']);
									}
									?>
								</p>
							</div>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-12">
						<div class="form-group  m-0">
							<label class="col-md-6">Out Time:</label>
							<div class="col-md-6">
								<p class="form-control-static <?php if($higlightOutClass || $higlightInOutClass) echo "highlight-text"; ?>">
									<?php  echo timeFormat($row['outtime']);?>
								</p>
							</div>
						</div>
					</div>
					<!--/span-->
				</div>

				<div class="row">
					<div class="col-md-12">
						<div class="form-group  m-0">
							<label class="col-md-6">Action Remarks:</label>
							<div class="col-md-6">
								<p class="form-control-static">
									<?php  echo $row['action_remark'];?>
								</p>
							</div>
						</div>
					</div>
				</div>

			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group m-0">
						<div class="col-md-6">
			             <?php if($row['action_status'] == "1" || $row['action_status'] == ""){
			             		echo "<span style='color:blue;'>Pending By</span>";
			             	}else if($row['action_status'] == "2"){
			             		echo "<span style='color:green;'>Approved By</span>";
			             	}else if($row['action_status'] == "3"){
			             			echo "<span style='color:red;'>Rejected By</span>";
			             	}else if($row['action_status'] == "4"){
									echo "<span style='color:red;'>Cancelled By</span>";
			             	}else if($row['action_status'] == "5"){
									echo "<span style='color:red;'>Cancellation Request Pending By</span>";
			             	}?> 
			             </div>
						 
			             <div class="col-md-6">
			             <?php if($row['action_status'] == "4" ) {?>
				             <span class="appMan blue-bg">
				             <?php if($data3['EmpImage'] == ""){?>
				             <span class="appManImg" >
				             <img class="img-circle img50" src="../Profile/upload_images/change_img.png" >
				             </span>
				             <?php }else{?>
				              <span class="appManImg" >
								<img class="img-circle img50" src="../Profile/upload_images/<?php echo $data1['EmpImage'];?>" >
							 </span>
				             <?php	} ?>
				             <span class="appManName" data-des="<?php echo $data1['DSG_NAME'];?>">
				              <?php echo $data1['EMP_NAME'];?>
				             </span>
				             </span>
				           <?php }else{ ?>
				           		 <span class="appMan blue-bg">
				             <?php if($data3['EmpImage'] == ""){?>
				             <span class="appManImg" >
				             <img class="img-circle img50" src="../Profile/upload_images/change_img.png" >
				             </span>
				             <?php }else{?>
				              <span class="appManImg" >
								<img class="img-circle img50" src="../Profile/upload_images/<?php echo $data3['EmpImage'];?>" >
							 </span>
				             <?php	} ?>
				             <span class="appManName" data-des="<?php echo $data3['DSG_NAME'];?>">
				              <?php echo $data3['EMP_NAME'];?>
				             </span>
				             </span>
				           <?php } ?>
			             </div>
			             
            		</div>
            	</div>
            </div>	
          <?php if($status == "1" || $status == "5"){ ?>
			<div class="form-actions">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-6">
							<textarea class="form-control input-medium" name="actRemarks" id="actRemarks" placeholder="Please Enter Remarks"></textarea>
							</div>

							<div class="col-md-3">		
							<button type="button" onclick="submitAppRequest('<?php echo $row['markPastId'];?>','2','<?php echo $row['CreatedBy'];?>','<?php echo $code;?>');" class="btn default green">Approved</button>
							</div>

							<div class="col-md-3">		
							<button type="button" onclick="submitAppRequest('<?php echo $row['markPastId'];?>','3','<?php echo $row['CreatedBy'];?>','<?php echo $code;?>');" class="btn default red">Rejected
							</button>
							</div>
								
							</div>
							
						</div>
					</div>
					<div class="col-md-6">
					</div>
				</div>
			</div>
			<?php } ?>
		</form>
		<!-- END FORM-->
	</div>
</div>

							
