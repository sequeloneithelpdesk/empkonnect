<?php
include('../../db_conn.php');
include('../../configdata.php');
$id=$_POST['id'];
$status=$_POST['status'];
$code=$_POST['code'];
$sql="select *,CONVERT (VARCHAR(10),LvFrom,103 ) as LvFrom,CONVERT (VARCHAR(10),LvTo,103 ) as LvTo from Leave WHERE leaveID='$id'";
$res=query($query,$sql,$pa,$opt,$ms_db);
$row=$fetch($res);

$sql1="select * from hrdmastqry WHERE Emp_Code='$code'";
$res1=query($query,$sql1,$pa,$opt,$ms_db);
$data2=$fetch($res1);

$actionUserCode=$row['ApprovedBy'];
$sql2="select DSG_NAME, MailingAddress,EmpImage from hrdmastqry WHERE Emp_Code='$actionUserCode'";
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">To:</label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php
                                    $mngrcode=$row['ApprovedBy'];
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-6">From Date:</label>
                            <div class="col-md-6">
                                <p class="form-control-static">
                                    <?php  echo $row['LvFrom'];?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-6">No. Of Days:</label>
                            <div class="col-md-6">
                                <p class="form-control-static">
                                    <?php echo $row['LvDays'];
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                </div>
                <!--/row-->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">Reason:</label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php  echo $row['reason'];?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!--/span-->

                    <!--/span-->
                </div>



            </div>
            <div class="row">
                <!-- <div class="col-md-6">
					<div class="form-group">
					On Duty Request By
					<strong>
					<?php echo $data2['EMP_NAME']; echo ","; echo $data2['DSG_NAME'];  echo ",";
                echo $data2['MailingAddress'];
                ?>

					</strong>
					</div>
				</div> -->

                <div class="col-md-12">
                    <div class="form-group">
                        <!-- On <?php echo date("Y-m-d h:i:sa");?><br> -->
                        <?php if($row['status'] == "1" || $row['status'] == ""){
                            echo "<span style='color:blue;'>Pending By</span>";
                        }else if($row['status'] == "2"){
                            echo "<span style='color:green;'>Approved By</span>";
                        }else if($row['status'] == "3"){
                            echo "<span style='color:red;'>Rejected By</span>";
                        }else if($row['status'] == "4"){
                            echo "<span style='color:red;'>Cancelled By</span>";
                        }?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <?php if($data3['EmpImage'] == ""){?>
                            <img src="../Profile/upload_images/change_img.png" style="width: 10%;height: 10%;">
                        <?php }else{?>
                            <img src="../Profile/upload_images/<?php echo $data3['EmpImage'];?>" style="width: 10%;height: 10%;">
                        <?php	} ?>
                        <?php echo $data1['EMP_NAME'];?>, <?php echo $data3['DSG_NAME'];?>, <?php echo $data3['MailingAddress'];?>
                    </div>
                </div>
            </div>
            <?php if($status == "1"){?>
              <!--  <div class="form-actions">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="button" onclick="submitCancelRequest('<?php echo $row['leaveID'];?>','<?php echo $code;?>');" class="btn default">Cancel Request</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                        </div>
                    </div>
                </div> -->

            <?php } ?>
        </form>
        <!-- END FORM-->
    </div>
</div>


