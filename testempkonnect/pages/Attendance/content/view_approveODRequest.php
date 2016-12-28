<?php 
	include('../../db_conn.php');
	include('../../configdata.php');
	$id=$_POST['id'];
	$status=$_POST['status'];
	$code=$_POST['code'];
	$sql="select *,CONVERT (VARCHAR(10),date_from,103 ) as date_from , CONVERT (VARCHAR(10),date_to,103 ) as date_to from outOnWorkRequest WHERE outWorkId='$id'";
        $res=query($query,$sql,$pa,$opt,$ms_db);
        $row=$fetch($res);

		$sql1="select * from hrdmastqry WHERE Emp_Code='$code'";
		$res1=query($query,$sql1,$pa,$opt,$ms_db);
		$data2=$fetch($res1);

	$actioncode=$row['CreatedBy'];
	$sql2="select DSG_NAME, MailingAddress,EmpImage from hrdmastqry WHERE Emp_Code='$actioncode'";
	$res2=query($query,$sql2,$pa,$opt,$ms_db);
	$data3=$fetch($res2);

	
?>
									
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
							$mngrcode=$row['CreatedBy'];
                            $sql1="select EMP_NAME from HrdMastQry WHERE Emp_Code='$mngrcode'";
                            $res1=query($query,$sql1,$pa,$opt,$ms_db);
                            $data1=$fetch($res1);
                            echo $data1['EMP_NAME'];
                            ?>
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group m-0">
							<label class="col-md-6">From Date:</label>
							<div class="col-md-6">
								<p class="form-control-static">
									<?php  echo $row['date_from'];?>
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="row">	
					<div class="col-md-12">
						<div class="form-group m-0">
							<label class="col-md-6">To Date:</label>
							<div class="col-md-6">
								<p class="form-control-static">
									<?php  if($row['date_to'] == "01/01/1900"){
											 echo $row['date_from'];
										}else{
											echo $row['date_to'];
									}?>
								</p>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<div class="form-group m-0">
							<label class="col-md-6">In Time:</label>
							<div class="col-md-6">
								<p class="form-control-static">
									<?php  if($row['intime'] == "00:00:00"){
											echo "";
									}else{
										echo $row['intime'];
									}
									?>
								</p>
							</div>
						</div>
					</div>
				</div>
					
				<div class="row">
					<div class="col-md-12">
						<div class="form-group m-0">
							<label class="col-md-6">Out Time:</label>
							<div class="col-md-6">
								<p class="form-control-static">
									<?php  echo $row['outtime'];?>
								</p>
							</div>
						</div>
					</div>
				</div>
				
				<div class="row">	
					<div class="col-md-12">
						<div class="form-group m-0">
							<label class="col-md-6">Nature Of Work:</label>
							<div class="col-md-6">
								<p class="form-control-static">
									<?php 
									$sqlWork="select * from LOVMast  where LOV_Field='natureOfWork'";
							        $resWork=query($query,$sqlWork,$pa,$opt,$ms_db);
							        $resData=$fetch($resWork);
									while($resData=$fetch($resWork)){
				                        if($row['natureOfWork'] === $resData['LOV_Value']){
				                            echo $resData['LOV_Text'];
				                            break;
				                        }
				                     }

									?>
								</p>
							</div>
						</div>
					</div>
				</div>

				<div class="row">	
					<div class="col-md-12">
						<div class="form-group m-0">
							<label class="col-md-6">Reason:</label>
							<div class="col-md-6">
								<p class="form-control-static">
									<?php echo $row['reason'];		                        
									?>
								</p>
							</div>
						</div>
					</div>
				</div>

				<div class="row">	
					<div class="col-md-12">
						<div class="form-group m-0">
							<label class="col-md-6">Requester Remarks:</label>
							<div class="col-md-6">
								<p class="form-control-static">
									<?php echo $row['action_remark'];		                        
									?>
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
			             <?php if($row['action_status'] == "1"){
			             		echo "<span style='color:blue;'>Pending By</span>";
			             	}else if($row['action_status'] == "2"){
			             		echo "<span style='color:green;'>Approved By</span>";
			             	}else if($row['action_status'] == "3"){
			             			echo "<span style='color:red;'>Rejected By</span>";
			             	}else if($row['action_status'] == "4"){
									echo "<span style='color:red;'>Cancelled By</span>";
			             	} else if($row['action_status'] == "5"){
									echo "<span style='color:red;'>Cancelled Request Pending By</span>";
			             	}?>
			            </div>
			            <?php if($row['action_status'] == "4"){?>
			            	<div class="col-md-6">
			            	<span class="appMan blue-bg">
				             <?php if($data3['EmpImage'] == ""){?>
				             <span class="appManImg">
				             <img class="img-circle img50" src="../Profile/upload_images/change_img.png" >
				             </span>
				             <?php }else{?>
				             <span class="appManImg">
								<img class="img-circle img50" src="../Profile/upload_images/<?php echo $data3['EmpImage'];?>" >
							 </span>
				             <?php	} ?>
				             <span  class="appManName" data-des="<?php echo $data3['DSG_NAME'];?>">
				             <?php echo $data1['EMP_NAME'];?>
				             </span>
				             </span>
			            	</div>
			            <?php } else{?>	
			            <div class="col-md-6">
			            <span class="appMan blue-bg">
	 					<span class="appManImg">
				             <?php if($data3['EmpImage'] == ""){?>
				             <img class="img-circle img50" src="../Profile/upload_images/change_img.png" >
				             <?php }else{?>
							<img class="img-circle img50" src="../Profile/upload_images/<?php echo $data2['EmpImage'];?>" >
				             <?php	} ?>
			             </span>
			             <span class="appManName" data-des="<?php echo $data2['DSG_NAME'];?>">
			             	<?php echo $data2['EMP_NAME'];?>
			             </span>
			             </span>
			            </div>
			            <?php } ?>
            		</div>
            	</div>
            </div>	
            <div class="clearfix"></div>
            <?php if($status == "1" || $status == "5"){ ?>	
			<div class="form-actions" style="margin-top:10px;">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-6">
							<textarea class="form-control input-medium" name="actRemarks" id="actRemarks" placeholder="Please Enter Remarks"></textarea>
							</div>

							<div class="col-md-3" style="margin-top:10px;">		
							<button type="button" onclick="submitAppRequest('<?php echo $row['outWorkId'];?>','2','<?php echo $row['CreatedBy'];?>','<?php echo $code;?>');" class="btn default green">Approved</button>
							</div>

							<div class="col-md-3" style="margin-top:10px;">		
							<button type="button" onclick="submitAppRequest('<?php echo $row['outWorkId'];?>','3','<?php echo $row['CreatedBy'];?>','<?php echo $code;?>');" class="btn default red">Rejected
							</button>
							</div>
								
							</div>
							
						</div>
					</div>
					
				</div>
			</div>
			<?php } ?> 
		</form>
		<!-- END FORM-->
	</div>
</div>

							
