<?php
include('../../db_conn.php');
include('../../configdata.php');
$id=$_POST['id'];
$status=$_POST['status'];
$code=$_POST['code'];
$sql="select *,CONVERT (VARCHAR(10),wd_date,103) as wd_date,CONVERT (VARCHAR,CreatedOn,109) as CreatedOn,convert(char(8), actual_INtime, 108) as actual_INtime,convert(char(8), actual_OUTtime, 108) as actual_OUTtime from compOff WHERE compOffId='$id'";
$res=query($query,$sql,$pa,$opt,$ms_db);
$row=$fetch($res);
$sql1="select * from hrdmastqry WHERE Emp_Code='$code'";
$res1=query($query,$sql1,$pa,$opt,$ms_db);
$data2=$fetch($res1);
$actionUserCode=$row['approvedBy'];
$sql2="select DSG_NAME, MailingAddress,EmpImage,EMP_NAME from hrdmastqry WHERE Emp_Code='$actionUserCode'";
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
                    <div class="form-group m-0">
                        <label class="col-md-6">
                        <strong>Applied Date And time:</strong></label>
                        <div class="col-md-6">
                            <p class="form-control-static">
                                <?php
                                 $date1=     date("d/m/Y g:i A",strtotime($row['CreatedOn']));
                                    echo $date1;
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group m-0">
                        <label class="col-md-6">
                            <strong>Compensatory Off Applied For:</strong>
                        </label>
                        <div class="col-md-6">
                            <p class="form-control-static">
                                <?php  echo $row['wd_date'];?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group m-0">
                        <label class="col-md-6">
                        <strong>No. of Days:</strong></label>
                        <div class="col-md-6">
                            <p class="form-control-static">
                                <?php  echo $row['noOfDays'];?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    
                    <div class="form-group m-0">
                        <label class="col-md-6">
                        <strong>Reason:</strong></label>
                        <div class="col-md-6">
                            <p class="form-control-static">
                                <?php  echo $row['reason'];?>
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    
                    <div class="form-group m-0">
                        <label class="col-md-6">
                        <strong>In Time:</strong></label>
                        <div class="col-md-6">
                            <p class="form-control-static">
                                <?php  echo $row['actual_INtime'];?>
                            </p>
                        </div>
                        
                    </div>
                    
                </div>
                <div class="row">
                    
                    <div class="form-group m-0">
                        <label class="col-md-6">
                        <strong>Out Time:</strong></label>
                        <div class="col-md-6">
                            <p class="form-control-static">
                                <?php  echo $row['actual_OUTtime'];?>
                            </p>
                        </div>
                        
                    </div>
                </div>
                
                <div class="row">
                    
                    <div class="form-group m-0">
                        <label class="col-md-6">
                        <strong>Remarks:</strong></label>
                        <div class="col-md-6">
                            <p class="form-control-static">
                                <?php  echo $row['action_remark'];?>
                            </p>
                        </div>
                        
                    </div>
                </div>

                <div class="row">
                    
                    <div class="form-group m-0">
                        <!-- On <?php echo date("Y-m-d h:i:sa");?><br> -->
                         <?php if($row['action_status'] != "4") {?>
                        <div class="col-md-6">
                            <span class="appMan blue-bg">
                                <span class="appManImg">
                                    <?php if($data3['EmpImage'] == ""){?>
                                    <img class="img-circle img50" src="../Profile/upload_images/change_img.png" >
                                    <?php }else{?>
                                    <img class="img-circle img50" src="../Profile/upload_images/<?php echo $data3['EmpImage'];?>" >
                                    <?php  } ?>
                                </span>
                                <span class="appManName" data-des="<?php echo $data3['DSG_NAME'];?>">
                                    <?php echo $data3['EMP_NAME'];?>
                                </span>
                            </span>
                        </div>
                        <?php } else{ ?>
                        <div class="col-md-6">
                            <span class="appMan blue-bg">
                                <span class="appManImg">
                                    <?php if($data2['EmpImage'] == ""){?>
                                    <img class="img-circle img50" src="../Profile/upload_images/change_img.png" >
                                    <?php }else{?>
                                    <img class="img-circle img50" src="../Profile/upload_images/<?php echo $data2['EmpImage'];?>" >
                                    <?php  } ?>
                                </span>
                                <span class="appManName" data-des="<?php echo $data2['DSG_NAME'];?>">
                                    <?php echo $data2['EMP_NAME'];?>
                                </span>
                            </span>
                        </div>
                        <?php } ?>
                        <div class="col-md-6">
                            <?php if($row['action_status'] == "1" || $row['action_status'] == ""){
                            echo "<span style='color:blue;'>Pending </span>";
                            }else if($row['action_status'] == "2"){
                            echo "<span style='color:green;'>Approved</span>";
                            }else if($row['action_status'] == "3"){
                            echo "<span style='color:red;'>Rejected </span>";
                            }else if($row['action_status'] == "4"){
                            echo "<span style='color:red;'>Cancelled </span>";
                            }?>
                        </div>
                       
                    </div>
                    
                </div>
                <?php if($status == "1"){?>
                <div class="form-actions" style="margin-top:10px;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                 <div class="col-md-6">
                                    <textarea class="form-control input-medium" placeholder="Please Enter Remarks" id='remrk' name='remrk'></textarea>
                                </div> 
                                <div class="col-md-6">
                                    <button type="button" onclick="submitCancelRequest('<?php echo $row['compOffId'];?>','<?php echo $code;?>');" class="btn default">Cancel Request</button>
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