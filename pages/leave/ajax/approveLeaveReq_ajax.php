<?php
include '../../db_conn.php';
include ('../../configdata.php');



if($_POST['type'] == "mulcheck"){

$key=$_POST['key'];
$userCode=$_POST['userCode'];
    $inputval=$_POST['inputval'];
    $status=$_POST['status'];
    $sql="update Leave set status='$status',flag='1' WHERE ApprovedBy='$userCode' and leaveID IN ($inputval) and LevKey IN ($key)";
    $res=query($query,$sql,$pa,$opt,$ms_db);
    if($res){
        echo 1;
    }else{
        echo 0;
    }
}


else if($_POST['type']=="allcheck"){

    $userCode=$_POST['userCode'];
    $status=$_POST['status'];
    
    $sql="select leaveID from Leave  WHERE ApprovedBy='$userCode' and status = '$status' and flag='1'";
   
    $res=query($query,$sql,$pa,$opt,$ms_db);
    $count = $num($res);
    if($count == 1){
        $row=$fetch($res);
       $val= $row['leaveID'];
   }else{
    while ($row=$fetch($res)) {
         $val.= $row['leaveID'].",";
    }
    echo $data=rtrim($val, ",");
   }
    
}

else if($_POST['type']=="allkey"){

    $userCode=$_POST['userCode'];
    $status=$_POST['status'];
    
    $sql="select LevKey from Leave  WHERE ApprovedBy='$userCode' and status ='$status'  and flag='1'";

    $res=query($query,$sql,$pa,$opt,$ms_db);
    $count = $num($res);
    if($count == 1){
        $row=$fetch($res);
       echo "'".$row['LevKey']."'";
   }else{
    while ($row=$fetch($res)) {
         $val.="'".$row['LevKey']."'".",";
    }
       echo $data=rtrim($val, ",");
   }
    
}

else if($_POST['type']=="keyValue"){

    $levid=$_POST['levid'];
  
     $sql="select LevKey from Leave  WHERE leaveID IN ($levid) and flag='1' ";
//echo $sql;
    $res=query($query,$sql,$pa,$opt,$ms_db);
    $count = $num($res);
   
    while ($row=$fetch($res)) {
         $val.="'".$row['LevKey']."'".",";
    }
    echo $data=rtrim($val, ",");
    
}

elseif ($_POST['type'] == "searchDate") {
    $fromDate= $_POST['fromDate'];
    $toDate = $_POST['toDate'];
    $loginUser = $_POST['code'];
    
    if ($fromDate == "" && $toDate == "") {
          $sql="select *,convert(varchar(10),LVFrom,103)as LVFrom, convert(varchar(10),LVTo,103)as LVTo from leave where ApprovedBy='$loginUser'";
        } 
       elseif ($fromDate=="") {
            $sql="select *,convert(varchar(10),LVFrom,103)as LVFrom, convert(varchar(10),LVTo,103)as LVTo from leave where ApprovedBy='$loginUser'and LVTo='$toDate'";
        }elseif($toDate==""){
        $sql="select *,convert(varchar(10),LVFrom,103)as LVFrom, convert(varchar(10),LVTo,103)as LVTo from leave where ApprovedBy='$loginUser'and LVFrom='$fromDate'";
        }
        else{
            $sql="select *,convert(varchar(10),LVFrom,103)as LVFrom, convert(varchar(10),LVTo,103)as LVTo from leave where ApprovedBy='$loginUser'and LVFrom='$fromDate' and LVTo='$toDate'";
        }
            
            $res=query($query,$sql,$pa,$opt,$ms_db);
            if($res){    
                $i=0;
                while($row=$fetch($res)){
                    $mngrcode=$row['CreatedBy'];
                    $sql1="select EMP_NAME from HrdMastQry WHERE Emp_Code='$mngrcode'";
                    $res1=query($query,$sql1,$pa,$opt,$ms_db);
                    $data1=$fetch($res1);

                 echo" <tr>";
                             if( $row['status']== 2 || $row['status']== 3 || $row['status']== 4){
                                  echo"  <td></td>";
                                }else { 
                               echo" <td><input type='checkbox' class='checkboxes' id='Mulcheck".$i." onclick='mulCheck('Mulcheck".$i."');'' value='".$row['leaveID']."'/>
                                </td>";
                                 }
                        echo" 
                            <td>
                                ".$row['LVFrom']."
                            </td>
                            <td>
                                ".$row['LVTo']."
                            </td>
                            <td>
                                ".$row['LvDays']."
                            </td>
                            <td>
                                ".$row['reason']."
                            </td>
                            <td>
                                ".$data1['EMP_NAME']."  
                            </td>
                            <td>";
                            if($row['status'] == "1"){?>
                            <a class='myod' data-toggle='modal' href='#large' 
                                onclick="getapprleaveId('<?php echo $row['leaveID'];?>','1','<?php echo $loginUser;?>');">
                                    <span class='label  bg-blue-steel'>
                                    Pending </span>
                                </a> <?php   
                                }else if($row['status'] == "2") {?>
                                 <a class='myod' data-toggle='modal' href='#large'
                                    onclick="getapprleaveId('<?php echo $row['leaveID']?>','2','<?php echo $loginUser;?>');">
                                    <span class='label  label-success'>
                                   Approved
                                     </span>
                                 </a><?php 
                                } else if($row['status'] == "3") {?>
                                <a class='myod' data-toggle='modal' href='#large'
                                    onclick="getapprleaveId('<?php echo $row['leaveID'];?>','3','<?php echo $loginUser;?>');">
                                    <span class='label  label-danger'>
                                   Rejected
                                 </span>
                                 </a><?php
                                } else if($row['status'] == "4") {?>
                                <a class='myod' data-toggle='modal' href='#large'
                                    onclick="getapprleaveId('<?php echo $row['leaveID'];?>','4',
                                        '<?php echo $loginUser;?>');">
                                    <span class='label  bg-grey-cascade'>
                                   Cancelled
                                 </span>
                                 </a><?php
                                 
                                }?>
                             <?php           
                             echo"</td>
                              <td></td>
                            </tr>";
                            $i++;

                }
            }
        
}


elseif ($_POST['type'] == "searchStatus") {
    $statusid= $_POST['statusid'];
    $loginUser=$_POST['code'];
     $sql="select *,CONVERT (VARCHAR(10),LVFrom,103 ) as LVFrom , CONVERT (VARCHAR(10),LVTo,103 ) as LVTo from  leave where status='$statusid' and ApprovedBy='$loginUser'";
    $res=query($query,$sql,$pa,$opt,$ms_db);
    $i=0;
    while($row= $fetch($res)){
         
        $mngrcode=$row['CreatedBy'];
        $sql1="select EMP_NAME from HrdMastQry WHERE Emp_Code='$mngrcode'";
        $res1=query($query,$sql1,$pa,$opt,$ms_db);
        $data1=$fetch($res1);

                echo"<tr>";

                    if( $row['status']== 2 || $row['status']== 3 || $row['status']== 4){
                                  echo"  <td></td>";
                                }else { 
                               echo" <td><input type='checkbox' class='checkboxes' id='Mulcheck".$i." onclick='mulCheck('Mulcheck".$i."');'' value='".$row['leaveID']."'/>
                                </td>";
                                 }
                 echo" 
                    
                    <td>
                          ".$row['LVFrom']."
                    </td>
                    
                    <td>
                        ".$row['LVTo']."
                    </td>

                    <td>
                        ".$row['LvDays']."
                    </td>

                    <td>
                        ".$row['reason']."
                    </td>
                    
                    <td>
                        ".$data1['EMP_NAME']."  
                    </td>

                    <td>";
                        if($row['status'] == "1"){?>
                            <a class='myod' data-toggle='modal' href='#large' 
                                onclick="getapprleaveId('<?php echo $row['leaveID'];?>','1','<?php echo $loginUser;?>');">
                                    <span class='label  bg-blue-steel'>
                                    Pending </span>
                                </a> <?php   
                        }else if($row['status'] == "2") {?>
                            <a class='myod' data-toggle='modal' href='#large'
                                    onclick="getapprleaveId('<?php echo $row['leaveID']?>','2','<?php echo $loginUser;?>');">
                                    <span class='label  label-success'>
                                   Approved
                                     </span>
                            </a><?php 
                                } else if($row['status'] == "3") {?>
                                <a class='myod' data-toggle='modal' href='#large'
                                    onclick="getapprleaveId('<?php echo $row['leaveID'];?>','3','<?php echo $loginUser;?>');">
                                    <span class='label  label-danger'>
                                   Rejected
                                 </span>
                                 </a><?php
                                } else if($row['status'] == "4") {?>
                                <a class='myod' data-toggle='modal' href='#large'
                                    onclick="getapprleaveId('<?php echo $row['leaveID'];?>','4',
                                        '<?php echo $loginUser;?>');">
                                    <span class='label  bg-grey-cascade'>
                                   Cancelled
                                 </span>
                                 </a><?php
                                }?>
                             <?php           
                      echo"</td>
                      <td></td>
                    </tr>";
                            $i++;        
    }
}


elseif ($_POST['type'] == "searchApproverName") {
  $codename= $_POST['codename'];
  $loginUser=$_POST['code'];
   $sql="select *,CONVERT (VARCHAR(10),LVFrom,103 ) as LVFrom , CONVERT (VARCHAR(10),LVTo,103 ) as LVTo from  leave where ApprovedBy='$loginUser' and (ApprovedBy in (select emp_code from HrdMastQry where Emp_FName='$codename' or Emp_MName='$codename' or Emp_LName='$codename') or ApprovedBy='$codename')";
    $res=query($query,$sql,$pa,$opt,$ms_db);
    while($row= $fetch($res)){
        $usercode=$row['CreatedBy'];
        $sql1="select EMP_NAME from HrdMastQry WHERE Emp_Code='$usercode'";
        $res1=query($query,$sql1,$pa,$opt,$ms_db);
        $data1=$fetch($res1);
        $i=0;
        echo"<tr>";
                    if( $row['status']== 2 || $row['status']== 3 || $row['status']== 4){
                                  echo"  <td></td>";
                                }else { 
                               echo" <td><input type='checkbox' class='checkboxes' id='Mulcheck".$i." onclick='mulCheck('Mulcheck".$i."');'' value='".$row['leaveID']."'/>
                                </td>";
                                 }
               echo"
                    <td>
                          ".$row['LVFrom']."
                    </td>
                    <td>
                        ".$row['LVTo']."
                    </td>
                    <td>
                        ".$row['LvDays']."
                    </td>
                    <td>
                        ".$row['reason']."
                    </td>
                    <td>
                        ".$data1['EMP_NAME']."  
                    </td>
                    <td>";
                    if($row['status'] == "1"){?>
                    <a class='myod' data-toggle='modal' href='#large' 
                        onclick="getapprleaveId('<?php echo $row['leaveID'];?>','1','<?php echo $loginUser;?>');">
                            <span class='label  bg-blue-steel'>
                            Pending </span>
                        </a> <?php   
                        }else if($row['status'] == "2") {?>
                         <a class='myod' data-toggle='modal' href='#large'
                            onclick="getapprleaveId('<?php echo $row['leaveID']?>','2','<?php echo $loginUser;?>');">
                            <span class='label  label-success'>
                           Approved
                             </span>
                         </a><?php 
                        } else if($row['status'] == "3") {?>
                        <a class='myod' data-toggle='modal' href='#large'
                            onclick="getapprleaveId('<?php echo $row['leaveID'];?>','3','<?php echo $loginUser;?>');">
                            <span class='label  label-danger'>
                           Rejected
                         </span>
                         </a><?php
                        } else if($row['status'] == "4") {?>
                        <a class='myod' data-toggle='modal' href='#large'
                            onclick="getapprleaveId('<?php echo $row['leaveID'];?>','4',
                                '<?php echo $loginUser;?>');">
                            <span class='label  bg-grey-cascade'>
                           Cancelled
                         </span>
                         </a><?php
                        }?>
                     <?php
                      echo"</td>
                      <td></td>
                    </tr>";
                     $i++;        
   }
}

elseif ($_POST['type'] == "searchRequesterName") {
    $codename= $_POST['codename'];
  	$loginUser=$_POST['code'];
   	$sql="select *,CONVERT (VARCHAR(10),LVFrom,103 ) as LVFrom , CONVERT (VARCHAR(10),LVTo,103 ) as LVTo from  leave where ApprovedBy='$loginUser' and (CreatedBy in (select emp_code from HrdMastQry where Emp_FName='$codename' or Emp_MName='$codename' or Emp_LName='$codename') or CreatedBy='$codename')";
    $res=query($query,$sql,$pa,$opt,$ms_db);
    while($row= $fetch($res)){
        $usercode=$row['CreatedBy'];
        $sql1="select EMP_NAME from HrdMastQry WHERE Emp_Code='$usercode'";
        $res1=query($query,$sql1,$pa,$opt,$ms_db);
        $data1=$fetch($res1);
        $i=0;
        echo"<tr>";
                    if( $row['status']== 2 || $row['status']== 3 || $row['status']== 4){
                                  echo"  <td></td>";
                                }else { 
                               echo" <td><input type='checkbox' class='checkboxes' id='Mulcheck".$i." onclick='mulCheck('Mulcheck".$i."');'' value='".$row['leaveID']."'/>
                                </td>";
                                 }
               echo"
                    <td>
                          ".$row['LVFrom']."
                    </td>
                    <td>
                        ".$row['LVTo']."
                    </td>
                    <td>
                         ".$row['LvDays']."
                    </td>
                    <td>
                        ".$row['reason']."
                    </td>
                    <td>
                        ".$data1['EMP_NAME']."  
                    </td>
                            <td>";
                            if($row['status'] == "1"){?>
                            <a class='myod' data-toggle='modal' href='#large' 
                                onclick="getapprleaveId('<?php echo $row['leaveID'];?>','1','<?php echo $loginUser;?>');">
                                    <span class='label  bg-blue-steel'>
                                    Pending </span>
                                </a> <?php   
                                }else if($row['status'] == "2") {?>
                                 <a class='myod' data-toggle='modal' href='#large'
                                    onclick="getapprleaveId('<?php echo $row['leaveID']?>','2','<?php echo $loginUser;?>');">
                                    <span class='label  label-success'>
                                   Approved
                                     </span>
                                 </a><?php 
                                } else if($row['status'] == "3") {?>
                                <a class='myod' data-toggle='modal' href='#large'
                                    onclick="getapprleaveId('<?php echo $row['leaveID'];?>','3','<?php echo $loginUser;?>');">
                                    <span class='label  label-danger'>
                                   Rejected
                                 </span>
                                 </a><?php
                                } else if($row['status'] == "4") {?>
                                <a class='myod' data-toggle='modal' href='#large'
                                    onclick="getapprleaveId('<?php echo $row['leaveID'];?>','4',
                                        '<?php echo $loginUser;?>');">
                                    <span class='label  bg-grey-cascade'>
                                   Cancelled
                                 </span>
                                 </a><?php

                                }?>
                             <?php
                      echo"</td>
                      <td></td>
                    </tr>";
                            $i++;  
            }      
}

?>