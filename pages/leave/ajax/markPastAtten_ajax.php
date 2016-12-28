<?php

include '../../db_conn.php';
include ('../../configdata.php');

if($_POST['type'] == "subCancelStatus")
{	
	$id=$_POST['id'];
  $userCode=$_POST['code'];
    $sql="update markPastAttendance set action_status='4',UpdatedBy='$userCode',UpdatedOn=getdate(), flag='1' where markPastId='$id'";
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
    
     $sql="select markPastId from markPastAttendance  WHERE approvedBy='$userCode' and action_status = '$status'";
    $res=query($query,$sql,$pa,$opt,$ms_db);
    $count = $num($res);
    if($count == 1){
        $row=$fetch($res);
       echo $row['markPastId'];
   }else{
    while ($row=$fetch($res)) {
         echo $row['markPastId'].",";
    }
   }
    
}

else if($_POST['type']=="mulcheck"){

    $userCode=$_POST['userCode'];
    $inputval=$_POST['inputval'];
    $status=$_POST['status'];
     $sql="update markPastAttendance set action_status='$status' WHERE approvedBy='$userCode' and markPastId IN ($inputval)";
    $res=query($query,$sql,$pa,$opt,$ms_db);
    if($res){
        echo 1;
    }else{
        echo 0;
    }
}

else if($_POST['type']=="apprAllCheck"){

    $userCode=$_POST['userCode'];
    $status=$_POST['status'];
    
     $sql="select markPastId from markPastAttendance  WHERE CreatedBy='$userCode' and flag='1' and action_status = '$status'";
    $res=query($query,$sql,$pa,$opt,$ms_db);
    $count = $num($res);
    if($count == 1){
        $row=$fetch($res);
       echo $row['markPastId'];
   }else{
    while ($row=$fetch($res)) {
         echo $row['markPastId'].",";
    }
   }
    
}

else if($_POST['type']=="apprMulCheck"){
    $var=array();
    $userCode=$_POST['userCode'];
    $inputval=$_POST['inputval'];
    $status=$_POST['status'];
     $sql="update markPastAttendance set action_status='$status' WHERE approvedBy='$userCode' and markPastId IN ($inputval) and flag='1'";
    $res=query($query,$sql,$pa,$opt,$ms_db);
    if($res){
      $sql1="select *,CONVERT(varchar(10), date_from, 103) as date_from,CONVERT(varchar(10), date_to, 103) as date_to from markPastAttendance where markPastId IN ($inputval)";
      $res1=query($query,$sql1,$pa,$opt,$ms_db);
      if($res1){
        $t=0;
          while ($row1=$fetch($res1)) {
            $reqMail= "Select OEMailID,EMP_NAME from HrdMastQry where Emp_Code='".$row1['CreatedBy']."'";
            $reqName= "Select EMP_NAME from HrdMastQry where Emp_Code='".$userCode."'";
            $resMail= query($query,$reqMail,$pa,$opt,$ms_db);
            $nameMail= query($query,$reqName,$pa,$opt,$ms_db);

            $rMail=$fetch($resMail);
            $name=$fetch($nameMail);


            $to=trim($rMail['OEMailID']);
            $subject= "Approved Past Attendance Request";
            $message="Dear, ".$rMail['EMP_NAME']." ,<br>";
            $message.="Your request to approve Past Attendance  from ".$row1['date_from']." to ".$row1['date_to']." due to the reason mentioned below , Has been Approved.<br>";
            $message.=$row1['reason'] ."<br>";
            $message.="Regards,<br>".$name['EMP_NAME'];
            $var [$t][$userCode.$t.'a']=array(
              "id"=>$userCode,
                              "msg"=>$message,
                              "email"=>$rMail['OEMailID'],
                              "subject"=>$subject);
            
            //$mail1=

            $sql2="SELECT TOP 1 * from markPastAttendance  where AttnKey ='".$row1['AttnKey']."' and flag='0' ORDER BY CreatedOn ASC";
            $res2=query($query,$sql2,$pa,$opt,$ms_db);

            if($res2){
              $row6=$fetch($res2);
              $createdBy=$row6['CreatedBy'];
               $sql3="update markPastAttendance set flag='1' where markPastId='".$row6['markPastId']."'";
              $res3= query($query,$sql3,$pa,$opt,$ms_db);
              if($res3){
                
                $aprMail= "Select OEMailID,EMP_NAME from HrdMastQry where Emp_Code='".$row6['approvedBy']."'";
                $res1Mail= query($query,$aprMail,$pa,$opt,$ms_db);
                $aMail=$fetch($res1Mail);

                 $to2=trim($aMail['OEMailID']);
                $subject2= "Past Attendance Request Lavel2";
                $message2="Dear, ".$aMail['EMP_NAME']." ,<br>";
                $message2.="You are requested to approve Past Attendance  from ".$row6['date_from']." to ".$row6['date_to']." due to the reason mentioned below <br>";
                $message2.=$row6['reason'] ."<br>";
                $message2.="Regards,<br>".$row6['CreatedBy'];
                $var[$t] [$createdBy.$t.'b']=array(
                              "id"=>$createdBy,
                              "msg"=>$message2,
                              "email"=>$aMail['OEMailID'],
                              "subject"=>$subject2);
              }
              
              
            }
            $t++;
          }

      }
      mymail('donotreply@sequelone.com',$var);
      print_r($var);
     echo 1;  
    }else{
        echo 0;
    }
}

else if ($_POST['type'] == "searchStatus") {

	$statusid= $_POST['statusid'];
	$userCode=$_POST['code'];
	 $sql="select *,CONVERT (VARCHAR(10),date_from,103 ) as date_from , CONVERT (VARCHAR(10),date_to,103 ) as date_to from  markPastAttendance where action_status='$statusid' and approvedBy='$userCode'";
    $res=query($query,$sql,$pa,$opt,$ms_db);
    while($row= $fetch($res)){
    	$usercode=$row['CreatedBy'];
        $sql1="select EMP_NAME from HrdMastQry WHERE Emp_Code='$usercode'";
        $res1=query($query,$sql1,$pa,$opt,$ms_db);
        $data1=$fetch($res1);
    	 $i=0;
    	echo "<tr class='odd gradeX'>";
                            if( $row['action_status']== 2 || $row['action_status']== 3 || $row['action_status']== 4){
        					echo"<td></td>";
                                }else { 
                             echo"   <td><input type='checkbox' class='checkboxes' 
                             			id='Mulcheck".$i."'
                                 onclick='mulCheck('Mulcheck".$i."');' value=".$row['markPastId']." />
                                </td>";
                                } 
                              echo"<td >
                                   ". $data1['EMP_NAME']."
                                </td>";
                             echo"<td class='center'>".
                                  $row['date_from']."
                                </td>
                                <td>
                                     ".$row['notMarkingReason']."
                                </td>

                                <td>"; if($row['action_status'] == "1"){
								echo"<span class='label label-sm bg-blue-steel'>
										Pending </span>";
                                     } else if($row['action_status'] == "2") {
                                   echo" <span class='label label-sm label-success'>
                                       Approved
									 </span>";
                                  } else if($row['action_status'] == "3") {
                                  echo" <span class='label label-sm label-danger'>
                                       Rejected
									 </span>";
                                    } else if($row['action_status'] == "4") {
                                    echo"<span class='label label-sm bg-grey-cascade'>
                                       Cancelled
									 </span>";
                                     }  
                               echo"</td>

                                <td></td>
                            </tr> ";
                            $i++;
    }
  
}

else if ($_POST['type'] == "searchMyStatus") {

  $statusid= $_POST['statusid'];
  $userCode=$_POST['code'];
   $sql="select *,CONVERT (VARCHAR(10),date_from,103 ) as date_from , CONVERT (VARCHAR(10),date_to,103 ) as date_to from  markPastAttendance where action_status='$statusid' and CreatedBy='$userCode'";
    $res=query($query,$sql,$pa,$opt,$ms_db);
    while($row= $fetch($res)){
      $usercode=$row['approvedBy'];
        $sql1="select EMP_NAME from HrdMastQry WHERE Emp_Code='$usercode'";
        $res1=query($query,$sql1,$pa,$opt,$ms_db);
        $data1=$fetch($res1);
       $i=0;
      echo "<tr>
            <td>
              ". $data1['EMP_NAME']."              
          </td>
          <td>
             ".$row['date_from']."
          </td>
          <td>
            ".$row['notMarkingReason']."
          </td>
          <td>";
            if($row['action_status'] == "1" || $row['action_status'] == ""){?>
             <a class='myod' data-toggle='modal' href='#large' 
              onclick="getmypastId('<?php echo $row['markPastId'];?>','1','<?php echo $userCode;?>')">
                <span class='label label-sm bg-blue-steel'>
                Pending </span>
              </a> <?php 
            } else if($row['action_status'] == "2") {?>
                <a class='myod' data-toggle='modal' href='#large'
                              onclick="getmypastId('<?php echo $row['markPastId'];?>','2','<?php echo $userCode;?>')">
                                <span class='label label-sm label-success'>
                               Approved
                 </span>
               </a><?php
               } else if($row['action_status'] == "3") {?>
                   <a class='myod' data-toggle='modal' href='#large'
                              onclick="getmypastId('<?php echo $row['markPastId'];?>','3','<?php echo $userCode;?>')">
                                <span class='label label-sm label-danger'>
                               Rejected
               </span>
               </a><?php
                 } else if($row['action_status'] == "4") {?>
                    <a class='myod' data-toggle='modal' href='#large'
                              onclick="getmypastId('<?php echo $row['markPastId'];?>','4','<?php echo $userCode;?>')">
                                <span class='label label-sm bg-grey-cascade'>
                               Cancelled
               </span>
               </a><?php
               }
                            
         echo " </td>

        </tr>";
                            $i++;
    }
    
}


else if ($_POST['type'] == "searchName") {

	$empidName= $_POST['codename'];
	$userCode=$_POST['code'];
	 $sql="select *,CONVERT (VARCHAR(10),date_from,103 ) as date_from , CONVERT (VARCHAR(10),date_to,103 ) as date_to from  markPastAttendance where 
	 	CreatedBy ='$empidName' or approvedBy='$empidName' or CreatedBy=(select emp_code from HrdMastQry where EMP_NAME='$empidName')
	 	or approvedBy=(select emp_code from HrdMastQry where EMP_NAME='$empidName') And createdBy='$userCode'";
    $res=query($query,$sql,$pa,$opt,$ms_db);
    while($row= $fetch($res)){
    	$usercode=$row['CreatedBy'];
        $sql1="select EMP_NAME from HrdMastQry WHERE Emp_Code='$usercode'";
        $res1=query($query,$sql1,$pa,$opt,$ms_db);
        $data1=$fetch($res1);
    	 $i=0;
    	echo "<tr class='odd gradeX'>";
                            if( $row['action_status']== 2 || $row['action_status']== 3 || $row['action_status']== 4){
        					echo"<td></td>";
                                }else { 
                             echo"   <td><input type='checkbox' class='checkboxes' 
                             			id='Mulcheck".$i."'
                                 onclick='mulCheck('Mulcheck".$i."');' value=".$row['markPastId']." />
                                </td>";
                                } 
                              echo"<td >
                                   ". $data1['EMP_NAME']."
                                </td>";
                             echo"<td class='center'>".
                                  $row['date_from']."
                                </td>
                                <td>
                                     ".$row['notMarkingReason']."
                                </td>

                                <td>"; if($row['action_status'] == "1"){
								echo"<span class='label label-sm bg-blue-steel'>
										Pending </span>";
                                     } else if($row['action_status'] == "2") {
                                   echo" <span class='label label-sm label-success'>
                                       Approved
									 </span>";
                                  } else if($row['action_status'] == "3") {
                                  echo" <span class='label label-sm label-danger'>
                                       Rejected
									 </span>";
                                    } else if($row['action_status'] == "4") {
                                    echo"<span class='label label-sm bg-grey-cascade'>
                                       Cancelled
									 </span>";
                                     }  
                               echo"</td>

                                <td></td>
                            </tr> ";
                            $i++;
    }
}

else if ($_POST['type'] == "searchMyName") {

  $codename= $_POST['codename'];
  $userCode=$_POST['code'];
   $sql="select *,CONVERT (VARCHAR(10),date_from,103 ) as date_from , CONVERT (VARCHAR(10),date_to,103 ) as date_to from  markPastAttendance where approvedBy='$codename' or approvedBy in (select emp_code from HrdMastQry where Emp_FName='$codename' or Emp_MName='$codename' or Emp_LName='$codename') and CreatedBy='$userCode'";
    $res=query($query,$sql,$pa,$opt,$ms_db);
    while($row= $fetch($res)){
      $usercode=$row['approvedBy'];
        $sql1="select EMP_NAME from HrdMastQry WHERE Emp_Code='$usercode'";
        $res1=query($query,$sql1,$pa,$opt,$ms_db);
        $data1=$fetch($res1);
       $i=0;
      echo "<tr>
            <td>
              ". $data1['EMP_NAME']."              
          </td>
          <td>
             ".$row['date_from']."
          </td>
          <td>
            ".$row['notMarkingReason']."
          </td>
          <td>";
           if($row['action_status'] == "1" || $row['action_status'] == ""){?>
             <a class='myod' data-toggle='modal' href='#large' 
              onclick="getmypastId('<?php echo $row['markPastId'];?>','1','<?php echo $userCode;?>')">
                <span class='label label-sm bg-blue-steel'>
                Pending </span>
              </a> <?php 
            } else if($row['action_status'] == "2") {?>
                <a class='myod' data-toggle='modal' href='#large'
                              onclick="getmypastId('<?php echo $row['markPastId'];?>','2','<?php echo $userCode;?>')">
                                <span class='label label-sm label-success'>
                               Approved
                 </span>
               </a><?php
               } else if($row['action_status'] == "3") {?>
                   <a class='myod' data-toggle='modal' href='#large'
                              onclick="getmypastId('<?php echo $row['markPastId'];?>','3','<?php echo $userCode;?>')">
                                <span class='label label-sm label-danger'>
                               Rejected
               </span>
               </a><?php
                 } else if($row['action_status'] == "4") {?>
                    <a class='myod' data-toggle='modal' href='#large'
                              onclick="getmypastId('<?php echo $row['markPastId'];?>','4','<?php echo $userCode;?>')">
                                <span class='label label-sm bg-grey-cascade'>
                               Cancelled
               </span>
               </a><?php
               }
                            
                            
         echo " </td>

        </tr>";
                            $i++;
    }
    
}


else if ($_POST['type'] == "searchDate") {

    $fromDate= $_POST['fromDate'];
    $toDate = $_POST['toDate'];
    $loginUser = $_POST['code'];

    if ($fromDate == "" && $toDate == "") {
            $sql="select *,convert(varchar(10),date_from,103)as date_from, convert(varchar(10),date_to,103)as date_to from markPastAttendance where CreatedBy='$loginUser'";
        } 
       elseif ($fromDate=="") {
            $sql="select *,convert(varchar(10),date_from,103)as date_from, convert(varchar(10),date_to,103)as date_to from markPastAttendance where CreatedBy='$loginUser'and date_to='$toDate'";
        }elseif($toDate==""){
        $sql="select *,convert(varchar(10),date_from,103)as date_from, convert(varchar(10),date_to,103)as date_to from markPastAttendance where CreatedBy='$loginUser'and date_from='$fromDate'";
        }
        else{
            $sql="select *,convert(varchar(10),date_from,103)as date_from, convert(varchar(10),date_to,103)as date_to from markPastAttendance where CreatedBy='$loginUser'and date_from='$fromDate' and date_to='$toDate'";
        }

    $res=query($query,$sql,$pa,$opt,$ms_db);
    while($row= $fetch($res)){
    	$usercode=$row['approvedBy'];
        $sql1="select EMP_NAME from HrdMastQry WHERE Emp_Code='$usercode'";
        $res1=query($query,$sql1,$pa,$opt,$ms_db);
        $data1=$fetch($res1);
    	 $i=0;
    	echo "<tr class='odd gradeX'>";
                            if( $row['action_status']== 2 || $row['action_status']== 3 || $row['action_status']== 4){
        					echo"<td></td>";
                                }else { 
                             echo"   <td><input type='checkbox' class='checkboxes' 
                             			id='Mulcheck".$i."'
                                 onclick='mulCheck('Mulcheck".$i."');' value=".$row['markPastId']." />
                                </td>";
                                } 
                              echo"<td >
                                   ". $data1['EMP_NAME']."
                                </td>";
                             echo"<td class='center'>".
                                  $row['date_from']."
                                </td>
                                <td>
                                     ".$row['notMarkingReason']."
                                </td>

                                <td>";
                                 if($row['action_status'] == "1" || $row['action_status'] == ""){?>
                                 <a class='myod' data-toggle='modal' href='#large' 
                                  onclick="getmypastId('<?php echo $row['markPastId'];?>','1','<?php echo $loginUser;?>')">
                                    <span class='label label-sm bg-blue-steel'>
                                    Pending </span>
                                  </a> <?php 
                                } else if($row['action_status'] == "2") {?>
                                    <a class='myod' data-toggle='modal' href='#large'
                                                  onclick="getmypastId('<?php echo $row['markPastId'];?>','2','<?php echo $loginUser;?>')">
                                                    <span class='label label-sm label-success'>
                                                   Approved
                                     </span>
                                   </a><?php
                                   } else if($row['action_status'] == "3") {?>
                                       <a class='myod' data-toggle='modal' href='#large'
                                                  onclick="getmypastId('<?php echo $row['markPastId'];?>','3','<?php echo $loginUser;?>')">
                                                    <span class='label label-sm label-danger'>
                                                   Rejected
                                   </span>
                                   </a><?php
                                     } else if($row['action_status'] == "4") {?>
                                        <a class='myod' data-toggle='modal' href='#large'
                                                  onclick="getmypastId('<?php echo $row['markPastId'];?>','4','<?php echo $loginUser;?>')">
                                                    <span class='label label-sm bg-grey-cascade'>
                                                   Cancelled
                                   </span>
                                   </a><?php
                                   }
                               echo"</td>

                                <td></td>
                            </tr> ";
                            $i++;
    }
}

else if ($_POST['type'] == "searchMyDate") {
    $fromDate= $_POST['fromDate'];
    $toDate = $_POST['toDate'];
    $loginUser = $_POST['code'];

    if ($fromDate == "" && $toDate == "") {
            $sql="select *,convert(varchar(10),date_from,103)as date_from, convert(varchar(10),date_to,103)as date_to from markPastAttendance where CreatedBy='$loginUser'";
        } 
       elseif ($fromDate=="") {
            $sql="select *,convert(varchar(10),date_from,103)as date_from, convert(varchar(10),date_to,103)as date_to from markPastAttendance where CreatedBy='$loginUser'and date_to='$toDate'";
        }elseif($toDate==""){
        $sql="select *,convert(varchar(10),date_from,103)as date_from, convert(varchar(10),date_to,103)as date_to from markPastAttendance where CreatedBy='$loginUser'and date_from='$fromDate'";
        }
        else{
            $sql="select *,convert(varchar(10),date_from,103)as date_from, convert(varchar(10),date_to,103)as date_to from markPastAttendance where CreatedBy='$loginUser'and date_from='$fromDate' and date_to='$toDate'";
        }

    $res=query($query,$sql,$pa,$opt,$ms_db);
    while($row= $fetch($res)){
      $usercode=$row['approvedBy'];
        $sql1="select EMP_NAME from HrdMastQry WHERE Emp_Code='$usercode'";
        $res1=query($query,$sql1,$pa,$opt,$ms_db);
        $data1=$fetch($res1);
       $i=0;
      echo "<tr>
                             <td >
                                   ". $data1['EMP_NAME']."
                             </td>
                             <td class='center'>".
                                  $row['date_from']."
                                </td>
                                <td>
                                     ".$row['notMarkingReason']."
                                </td>

                                <td>";
                                 if($row['action_status'] == "1" || $row['action_status'] == ""){?>
                                 <a class='myod' data-toggle='modal' href='#large' 
                                  onclick="getmypastId('<?php echo $row['markPastId'];?>','1','<?php echo $loginUser;?>')">
                                    <span class='label label-sm bg-blue-steel'>
                                    Pending </span>
                                  </a> <?php 
                                } else if($row['action_status'] == "2") {?>
                                    <a class='myod' data-toggle='modal' href='#large'
                                                  onclick="getmypastId('<?php echo $row['markPastId'];?>','2','<?php echo $loginUser;?>')">
                                                    <span class='label label-sm label-success'>
                                                   Approved
                                     </span>
                                   </a><?php
                                   } else if($row['action_status'] == "3") {?>
                                       <a class='myod' data-toggle='modal' href='#large'
                                                  onclick="getmypastId('<?php echo $row['markPastId'];?>','3','<?php echo $loginUser;?>')">
                                                    <span class='label label-sm label-danger'>
                                                   Rejected
                                   </span>
                                   </a><?php
                                     } else if($row['action_status'] == "4") {?>
                                        <a class='myod' data-toggle='modal' href='#large'
                                                  onclick="getmypastId('<?php echo $row['markPastId'];?>','4','<?php echo $loginUser;?>')">
                                                    <span class='label label-sm bg-grey-cascade'>
                                                   Cancelled
                                   </span>
                                   </a><?php
                                   }
                               echo"</td>
                            </tr> ";
                            $i++;
    }
}
else if ($_POST['type'] == "time") {

    $fordate=$_POST['fromDate'];
    $code=$_POST['code'];
    $dateval=explode('/',$fordate);
    $new_date=$dateval[2].'-'.$dateval[1].'-'.$dateval[0];
    echo "<table width='100%' cellpadding='0' cellspacing='2' border='0' id='detailtable'>
            <tbody><tr>
                <th style='text-align:left'>Day Type</th>
                <th style='text-align:left'>Planned In Time</th>
                <th style='text-align:left'>Planned Out Time</th>
                <th style='text-align:left'>Actual In Time</th>
                <th style='text-align:left''>Actual Out Time </th>
            </tr>";
    $sql="select * from Attendanceqry where EMP_CODE='$code' AND ATTDATE='$new_date'";
    $res=query($query,$sql,$pa,$opt,$ms_db);
    while($row= $fetch($res)){
        echo "<tr>
            <td>";
        echo "Weekly Off";
        echo  "</td>
            <td>";
        $shiftIn = $row['Shift_From']; echo $shiftIn->format('H:i:s');
        echo  "</td>
             <td>";
        $shiftOut = $row['Shift_to']; echo $shiftOut->format('H:i:s');
        echo  "</td>
            <td>";
        $IN = $row['IN_TIME']; echo $IN->format('H:i:s');
        echo  "</td>
         <td>";
        $OUT = $row['OUT_TIME']; echo $OUT->format('H:i:s');
        echo  "</td>
        </tr>";

    }

}
?>