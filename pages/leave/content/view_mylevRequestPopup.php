<?php
//include('../../db_conn.php');
//include('../../configdata.php');
include ('../ajax/leave_class.php');
$leave_class_obj=new leave_class();
$id=$_POST['id'];
$status=$_POST['status'];
$code=$_POST['code'];
$sql="select TOP 1 *,CONVERT (VARCHAR(10),LvFrom,103 ) as LvFrom,CONVERT (VARCHAR(10),LvTo,103 ) as LvTo, convert(varchar,Trn_Date,109) as Trn_Date,LvType from Leave WHERE Levkey='$id' order by leaveID DESC";
$res=query($query,$sql,$pa,$opt,$ms_db);
$row=$fetch($res);
//echo $sql;
$sql1="select ApprovedBy,status from leave WHERE Levkey='$id' order by ApprovedBy DESC";
$res1=query($query,$sql1,$pa,$opt,$ms_db);
$emp_count=0;
while ($data2=$fetch($res1))
{
             //echo $rows1['leaveID'];
            $emp_code_ID[$emp_count]=$data2['ApprovedBy'];
            $emp_code_status[$emp_count]=$data2['status'];
            $emp_count++;
}
//print_r($emp_code_status);

$all_id="'" . implode("','", $emp_code_ID) . "'";

$actionUserCode=$row['ApprovedBy'];
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
$all_approved_emp=implode(",",$Emp_Fname);
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
                            Applied Date And time:</label>
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
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group m-0">
                            <label class="col-md-6">
                            Approved By:
                            </label>
                            <div class="col-md-6">
                                <p class="form-control-static">
                                    <?php echo str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($all_approved_emp))));?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group m-0">
                            <label class="col-md-6">
                            From Date:</label>
                            <div class="col-md-6">
                                <p class="form-control-static">
                                    <?php  echo $row['LvFrom'];?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group m-0">
                            <label class="col-md-6">
                            To Date:</label>
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
                            <label class="col-md-6">
                            No Of Days:</label>
                            <div class="col-md-6">
                                <p class="form-control-static">
                                    <?php echo $row['LvDays'];
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                  <div class="row">
                    <div class="col-md-12">
                        <div class="form-group m-0">
                            <label class="col-md-6">
                            Leave Types:</label>
                            <div class="col-md-6">
                                <p class="form-control-static">
                                    <?php echo $leave_class_obj->getemployee_leave_type($row['LvType']);
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
                            <label class="col-md-6">Remark:</label>
                            <div class="col-md-6">
                                <p class="form-control-static">
                                    <?php  echo $row['action_remark'];?>
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
                            <img src="../Profile/upload_images/change_img.png" class="img-circle img50">
                            <?php }else{?>
                            <img src="../Profile/upload_images/<?php echo $EmpImage[$k];?>" class="img-circle img50">
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






            <?php  //if($row['LvFrom'] > date("d/m/Y")){?>
            <?php if($status == "1" || $status == "2" ){?>
                <div class="form-actions">
                    <div class="row">

                        <div class="col-md-6">
                            <textarea class="form-control input-medium" name="actRemarks" id="actRemarks" placeholder="Please Enter Remarks"></textarea>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="button" onclick="submitCancelleaveRequest('<?php echo $id;?>');" class="btn default">Cancel Request</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            <?php } 
            elseif($status == "4" || $status == "5" ){?>
                <div class="form-actions">
                    <div class="row">

                       
                        
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="button" onclick="reapplyleaveRequest('<?php echo $id;?>');" class="btn default">Re Apply Request</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            <?php }
                    ?>
        </form>
        <!-- END FORM-->
    </div>
</div>


