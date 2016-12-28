<?php 
	include('../../db_conn.php');
	include('../../configdata.php');
	$id=$_POST['id'];
	$status=$_POST['status'];
	$code=$_POST['code'];
	include ('../../main_class.php');
$main_class_obj=new main_class();
	/*$sql="select *,CONVERT (VARCHAR(10),date_from,103 ) as date_from , CONVERT (VARCHAR(10),date_to,103 ) as date_to, CONVERT(varchar(25),CreatedOn,109) as CreatedOn from outOnWorkRequest WHERE outWorkId='$id'";
        $res=query($query,$sql,$pa,$opt,$ms_db);
        $row=$fetch($res);

		$sql1="select * from hrdmastqry WHERE Emp_Code='$code'";
		$res1=query($query,$sql1,$pa,$opt,$ms_db);
		$data2=$fetch($res1);

	$mngrcode=$row['approvedBy'];
	$sql2="select DSG_NAME, MailingAddress,EmpImage from hrdmastqry WHERE Emp_Code='$mngrcode'";
	$res2=query($query,$sql2,$pa,$opt,$ms_db);
	$data3=$fetch($res2);*/

$sql="select TOP 1 *,CONVERT (VARCHAR(10),date_from,103 ) as date_from , CONVERT (VARCHAR(10),date_to,103 ) as date_to, CONVERT (VARCHAR(19),CreatedOn ) as CreatedOn from outOnWorkRequest WHERE oDKey='$id' order by outWorkId DESC";
$res=query($query,$sql,$pa,$opt,$ms_db);
$row=$fetch($res);
//echo $sql;
$sql1="select approvedBy,action_status,CreatedBy from outOnWorkRequest WHERE oDKey='$id' order by approvedBy DESC";
$res1=query($query,$sql1,$pa,$opt,$ms_db);
$emp_count=0;
while ($data2=$fetch($res1))
{
             //echo $rows1['leaveID'];
            $emp_code_ID[$emp_count]=$data2['approvedBy'];
            $emp_code_status[$emp_count]=$data2['action_status'];
            $emp_count++;
}
//print_r($emp_code_status);

$all_id="'" . implode("','", $emp_code_ID) . "'";

$actionUserCode=$row['approvedBy'];
$createdBy=$row['CreatedBy'];
$sql2="select h.Emp_Fname,h.Emp_Lname,h.DSG_NAME, h.MailingAddress,h.EmpImage from hrdmastqry as h WHERE h.Emp_Code IN($all_id) order by Emp_Code DESC";
$res2=query($query,$sql2,$pa,$opt,$ms_db);
$emp_name_count=0;
while ($data3=$fetch($res2))
{
   // echo $data3['Emp_Fname'];
        $Emp_Fname[$emp_name_count]=$data3['Emp_Fname']." ".$data3['Emp_Lname']." ";
         $DSG_NAME[$emp_name_count]=$data3['DSG_NAME'];
          $MailingAddress[$emp_name_count]=$data3['MailingAddress'];
           $EmpImage[$emp_name_count]=$data3['EmpImage'];
        $emp_name_count++;
}
//print_r($Emp_Fname);
$all_approved_emp=implode(",", $Emp_Fname);

/*$SqlQuery = "SELECT EMP_CODE, convert(varchar(10),RosterStart,103) as RosterStart,convert(varchar(10),RosterEnd,111) as RosterEnd,
			ShiftMast.Shift_From,ShiftMast.Shift_To
			FROM rosterQry 
			INNER JOIN ShiftMast ON rosterQry.SHIFTMASTER = ShiftMast.ShiftMastId
			WHERE RosterEnd >= '09/11/2016' AND RosterStart <= '09/11/2016' AND EMP_CODE = '10910'";
			$result=query($query, $SqlQuery, $pa, $opt, $ms_db);
			$row = $fetch($result);
			$shiftFrom = $row['Shift_From'];
			$shiftTo = $row['Shift_To'];*/
	
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
							<label class="col-md-6">Applied Date and Time:</label>
							<div class="col-md-6">
								<p class="form-control-static">
								<?php echo $row['CreatedOn']; ?>
								</p>
							</div>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12">
						<div class="form-group m-0">
							<label class="col-md-6">Approved By:</label>
							<div class="col-md-6">
								<p class="form-control-static">
								<?php
								$mngrcode=$row['approvedBy'];
	                            $sql1="select EMP_NAME,Emp_Code from HrdMastQry WHERE Emp_Code='$mngrcode'";
	                            $res1=query($query,$sql1,$pa,$opt,$ms_db);
	                            $data1=$fetch($res1);
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
										$EmployeeShiftByDate=$main_class_obj->getEmployeeShiftByDate($createdBy, $row['date_from']);
										echo $EmployeeShiftByDate['Shift_From'].' - '.$EmployeeShiftByDate['Shift_To'];
									?>									
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group m-0">
							<label class="col-md-6">From:</label>
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
							<label class="col-md-6">To:</label>
							<div class="col-md-6">
								<p class="form-control-static">
									<?php  if($row['date_to'] == "01/01/1900"){
											echo "";
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
									$sqlWork="select LOV_Text from LOVMast  where LOV_Field='natureOfWork' and LOV_Value ='".$row['natureOfWork']."'";
									
							        $resWork=query($query,$sqlWork,$pa,$opt,$ms_db);
							        $resData=$fetch($resWork);
									
				                            echo $resData['LOV_Text'];
				                        

									?>
								</p>
							</div>
						</div>
					</div>
				</div>
				
				<div class="row">	
					<div class="col-md-12">
						<div class="form-group m-0">
							<label class="col-md-6">Selected Time:</label>
							<div class="col-md-6">
								<p class="form-control-static">
									<?php 
									$sqlWork="select LOV_Text from LOVMast  where LOV_Field='natureOfWorkCause' and LOV_Value ='".$row['natureOfWorkCause']."'";
									
							        $resWork=query($query,$sqlWork,$pa,$opt,$ms_db);
							        $resData=$fetch($resWork);
									
				                            echo rtrim($resData['LOV_Text'],':');
				                        

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
									<?php  echo $row['reason'];?>
								</p>
							</div>
						</div>
					</div>
				</div>

				<div class="row">	
					<div class="col-md-12">
						<div class="form-group m-0">
							<label class="col-md-6">Approver Remarks:</label>
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

			<?php 
            for($k=0;$k<$emp_name_count;$k++)
            {
             //   echo $emp_code_status[$k]." \n";
               // echo "aaa".$k."ssss";
            ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">

                    <div class="col-md-6">
                       <span class="appMan blue-bg">
				             <span class="appManImg">
                            <?php if($EmpImage[$k] == ""){?>
                            <img class="img-circle img50" src="../Profile/upload_images/change_img.png" >
                            <?php }else{?>
                           <img class="img-circle img50" src="../Profile/upload_images/<?php echo $EmpImage[$k]; ?>" >
                            <?php   } ?>
                            </span>
                            <span class="appManName" data-des="<?php echo str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($DSG_NAME[$k]))));?>">
                                <?php echo str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($Emp_Fname[$k]))));?>
                            </span>
                        </span>
                       
                        </div>
                        <div class="col-md-6">
                        <?php if($emp_code_status[$k] == "1" || $emp_code_status[$k] == ""){
                            echo "<span style='color:blue;'>Pending</span>";
                        }else if($emp_code_status[$k] == "2"){
                            echo "<span style='color:green;'>Approved </span>";
                        }else if($emp_code_status[$k] == "3"){
                            echo "<span style='color:red;'>Rejected </span>";
                        }else if($emp_code_status[$k] == "4"){
                            echo "<span style='color:red;'>Cancelled </span>";
                        }else if($emp_code_status[$k] == "5"){
                            echo "<span style='color:red;'>Cancelled Request Pending </span>";
                        }?>
                        </div>

                        
                    </div>
                </div>
            </div>
            <?php }?>

            <?php if($status == "1" || $status == "2" ){?>	
			<div class="form-actions">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-6">
							<textarea class="form-control input-medium" name="actRemarks" id="actRemarks" placeholder="Please Enter Remarks"></textarea>
							</div>

							<div class="col-md-6" style="margin-top: 10px;">
							<button type="button" onclick="submitCancelRequest(<?php echo $row['outWorkId'];?>,'<?php echo $row['CreatedBy'];?>','<?php echo $status;?>','<?php echo $row['oDKey'];?>');" class="btn default">Cancel Request</button>
								
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

							
