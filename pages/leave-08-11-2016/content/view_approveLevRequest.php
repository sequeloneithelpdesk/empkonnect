<?php
include('../../db_conn.php');
include('../../configdata.php');
include ('../../main_class.php');
$main_class_obj=new main_class();
$id=$_POST['id'];
$status=$_POST['status'];
$code=$_POST['code'];
$sql="select *,CONVERT (VARCHAR(10),LvFrom,103 ) as LvFrom,CONVERT (VARCHAR(10),LvTo,103 ) as LvTo,convert(varchar,Trn_Date,109) as Trn_Date  from Leave WHERE leaveID='$id'";

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
                    <div class="col-md-12">
                        <div class="form-group m-0">
                            <label class="col-md-6">
                            Applied Date And time:
                            </label>
                            <div class="col-md-6">
                                <p class="form-control-static">
                                    <?php
                                   $date1=     date("d/m/Y g:i A",strtotime($row['Trn_Date']));
                                    echo $date1;
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group m-0">
                            <label class="col-md-6">Applied Leave:</label>
                            <div class="col-md-6">
                                <p class="form-control-static">
                                    <?php
                                  
                                    echo $main_class_obj->getemployee_leave_type_main($row['LvType']);
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                     <div class="col-md-12">
                        <div class="form-group m-0">
                            <label class="col-md-6">Requested By:</label>
                            <div class="col-md-6">
                                <p class="form-control-static">
                                    <?php
                                    $reqcode=$row['CreatedBy'];
                                    $sql1="select EMP_NAME from HrdMastQry WHERE Emp_Code='$reqcode'";
                                    $res1=query($query,$sql1,$pa,$opt,$ms_db);
                                    $data1=$fetch($res1);
                                    echo str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($data1['EMP_NAME']))));
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
                                    <?php  echo $row['LvFrom'];?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group m-0">
                            <label class="col-md-6">To Date:</label>
                            <div class="col-md-6">
                                <p class="form-control-static">
                                    <?php  echo $row['LvTo'];?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group m-0">
                            <label class="col-md-6">No. Of Days:</label>
                            <div class="col-md-6">
                                <p class="form-control-static">
                                    <?php echo $row['LvDays'];
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
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
                    <div class="col-md-12">
                        <div class="form-group m-0">
                           
                            <div class="col-md-6">
                            </div>
                            <div class="col-md-6">
                                <label>
                            <input type="radio" name="radio_action"  class="icheck" id="action_radio" value="0"> Unplanned</label></br>
                             <label>
                            <input type="radio" name="radio_action"  class="icheck" id="action_radio" value="1"> Planned</label>
                            </div>
                        </div>
                    </div>
					<?php 
					//echo "aaaaaa".$row['attachments']."bbbbb";
                    if($row['attachments']!="" and $row['attachments']!=" ")
                    {
                            
                    ?>
                       <div class="col-md-12">
                        <div class="form-group m-0">
                            <label class="col-md-6">Attachment:</label>
                            <div class="col-md-6">
                                <p class="form-control-static">
                                    <a href="upload/<?php echo $row['attachments'];?>" target="_blank">View</a>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php
                    }
                    ?>

                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                         <div class="col-md-6">
                        <span class="appMan blue-bg">
                        <?php if($data3['EmpImage'] == ""){?>
                            <span class="appManImg" >
                            <img class="img-circle img50" src="../Profile/upload_images/change_img.png" >
                            </span>
                        <?php }else{?>
                            <span class="appManImg" >
                            <img class="img-circle img50" src="../Profile/upload_images/<?php echo $data3['EmpImage'];?>" >
                            </span>
                        <?php   } ?>
                        <span class="appManName" data-des="<?php echo str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($data3['DSG_NAME']))));?>">
                        <?php echo str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($data1['EMP_NAME']))));?>
                        </span>
                        </span>
                        </div>
                        <div class="col-md-6">
                        <!-- On <?php echo date("Y-m-d h:i:sa");?><br> -->
                        <?php if($row['status'] == "1" || $row['status'] == ""){
                            echo "<span style='color:blue;'>Pending </span>";
                        }else if($row['status'] == "2"){
                            echo "<span style='color:green;'>Approved </span>";
                        }else if($row['status'] == "3"){
                            echo "<span style='color:red;'>Rejected </span>";
                        }else if($row['status'] == "4"){
                            echo "<span style='color:red;'>Cancelled </span>";
                        }?>
                        </div>
                    
                       
                       
                    </div>
                </div>
                </div>
            </div>
             <?php if($row['status'] == "1"){ ?>   
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                             <div class="col-md-6">
                            <textarea class="form-control input-medium" name="actRemarks" id="actRemarks" placeholder="Please Enter Remarks"></textarea>
                        </div>
                            <div class="col-md-3"> 
                            <input type="hidden" id="emp_ID" value="<?php echo $row['leaveID'];?>">     
                            <button type="button" onclick="submitApprovelRequest('emp_ID','2','1');" class="btn default green">Approved</button>
                            </div>

                            <div class="col-md-3">      
                            <button type="button" onclick="submitApprovelRequest('emp_ID','3','1');" class="btn default red">Rejected
                            </button>
                            </div>
                                
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                    </div>
                </div>
          
            <?php }
                    if($row['status'] == "5"){ ?>   
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                           
                            <div class="col-md-3"> 
                            <input type="hidden" id="emp_ID" value="<?php echo $row['leaveID'];?>">     
                            <button type="button" onclick="submitApprovelRequest('emp_ID','4','1');" class="btn default green">Approved</button>
                            </div>

                          
                                
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                    </div>
                </div>
          
            <?php } ?>
        </form>
        <!-- END FORM-->
    </div>
</div>


