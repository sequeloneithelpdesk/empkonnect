<?php 

include '../../db_conn.php';
include ('../../configdata.php');
include ('../../main_class.php');
$main_class_obj1=new main_class();

if($_POST['type'] == "noDays")
{	

	//$fordate = $_POST['forDate'];
	$days =  $_POST['days'];

	$halfValue = $_POST['halfValue'];
	//$val= ($todate[0] - $fordate[0]) + 1;
	
		$half= $days - $halfValue;
		echo $half; 	
}

else if($_POST['type'] == "maketoFull"){


  $days = $_POST['days'];
  $val= $days + 0.5;
  echo $val;
}

else if ($_POST['type'] == "insertLeave") 
{

  $key = md5(uniqid(rand(), true));
  $forDate=dateConversion($_POST['fromDate']);
  
  $forHalf= $_POST['forhalf'];
  

  $toDate=dateConversion($_POST['toDate']);
  
    $toHalf= $_POST['tohalf'];
  $foo=$_POST['foo'];

  $leavefor=$_POST['leaveFor'];
  $leaveType=$_POST['leaveType'];
  $reason=$_POST['reason'];
  $noOfDays=$_POST['noOfDays'];
  $empMobile=$_POST['empMobile'];
  $empEmail=$_POST['empEmail'];
  $empAddress=$_POST['empAddress'];
  $LeaveAppli=$_POST['radio4'];
  $OnDuty=$_POST['radio5'];
  $PastAtten=$_POST['radio6'];
  $approverId=explode(",", $_POST['approverId']);
    $attachment=$_POST['ufile'];
    $total = count($_FILES['uploadfile']['name']);

    $leavesql = "select * from LOVMast where LOV_Field='leave' and LOV_Value='$leaveType'";
    $leaveres = query($query,$leavesql,$pa,$opt,$ms_db);
    $leavedata=$fetch($leaveres);

    $quer="select Levkey from leave where   ((LvFrom <= '$forDate' and LvTo >= '$toDate') 
      or (LvTo >= '$toDate' and LvFrom <= '$forDate') or (LvFrom between '$forDate' and '$toDate')  or (LvTo between '$forDate' and '$toDate'))
      and status IN (1,2,5) and CreatedBy='$leavefor' group by Levkey";
     // echo $quer;
     //exit;
    $resu = query($query,$quer,$pa,$opt,$ms_db);
    $data=$fetch($resu);

    if($num($resu) >0){
      echo 2;
    }else{

      for($i=0; $i<$total; $i++) {

        $tmpFilePath = $_FILES['uploadfile']['tmp_name'][$i];

        if ($tmpFilePath != ""){
			$path_file=md5($_SERVER['REQUEST_URI'].$_SERVER['REMOTE_ADDR'].rand(50000000, 900000000000)).$_FILES['uploadfile']['name'][$i];
            $newFilePath = "../upload/".$path_file;
//echo $newFilePath;

            if(move_uploaded_file($tmpFilePath, $newFilePath)) {

             //  echo "done";

            }
        }
      }

       $level=$_POST['level'];
      $lev = explode(',',$level);

      for($i=0;$i<count($lev);$i++){
        if($i==0){
            $flag= '1';
        }
        else{
            $flag= '0';
        }

        $sql="insert into LEAVE (Trn_Code,Trn_Date,Lvfrom,LvTo,FromHalf,toHalf,reason,LvType,LvDays,mobile,Email,Address,LvApplication,OnDutyAtten,PastAtten,CreatedBy,ApprovedBy,flag,status,levkey,attachments,notification) values ('R',getdate(),'$forDate','$toDate','$forHalf','$toHalf','$reason','$leaveType','$noOfDays','$empMobile','$empEmail','$empAddress','$LeaveAppli','$OnDuty','$PastAtten','$leavefor','$approverId[$i]','$flag','1','$key','$path_file','$foo')";
       // echo $sql;
          $res=query($query,$sql,$pa,$opt,$ms_db);
      if($res){
          $myArray = explode(',', $foo);
           for($j=0;$j<sizeof($myArray);$j++)
        {
           $approver_email=$main_class_obj1->getemployee_email_main($myArray[$j]);
           $approver_name=$main_class_obj1->getemployee_leave_type_main($myArray[$j]);
            $creater_email=$main_class_obj1->getemployee_email_main($leavefor);
            $creater_name=$main_class_obj1->getemployee_leave_type_main($leavefor);
          //  echo $approver_email;
            $subject= "Leave Notification By - ".$creater_name;
            $message="Dear ".$approver_name.",<br><br>";
            $message.="Leave Request Notification from ".$LvFrom." to ".$LvTo." due to ".$remark." reason ";
            $message.="Regards,<br>";
            $message.=$creater_name;
            $var[$myArray[$j].$t."a"]=array(
          "id"=>$myArray[$j],
            "email"=>$approver_email,
            "subject"=>$subject,
            "msg"=>$message
        );
        }

          //mymail('donotreply@sequelone.com',$var);



         if($flag == 1){

                                $queMail= "Select Emp_Name,OEMailID from HrdMastQry where Emp_Code ='$approverId[$i]'";
                                $resMail= query($query,$queMail,$pa,$opt,$ms_db);
                                $appMail=$fetch($resMail);

                                $requesterSql="Select Emp_Name,Emp_Code from HrdMastQry where Emp_Code ='$leavefor'";
                                $requesterRes = query($query,$requesterSql,$pa,$opt,$ms_db);
                                $requesterRow= $fetch($requesterRes);

                                $to=trim($appMail['OEMailID']);
                                $mes = rtrim(ucwords(strtolower($appMail[0])));

                                  $subject= $leavedata['LOV_Text'] ." ".$_POST['fromDate']."-".$_POST['toDate'];
                                  $message="Dear ".$mes.",<br><br>";
                                  "You are requested to approve my ".$leavedata['LOV_Text']." from ".$_POST['fromDate']." to ".$_POST['toDate']." for ".$noOfDays." days due to the reason mentioned below <br>";
                                $message.=$reason ."<br><br>";
                                $message.="Regards <br>";
                                $message.=$requesterRow[0]. "-";
                                $message.=$requesterRow[1];
                            $var[$requesterRow[0].$t."b"]=array(
                            "id"=>$leavefor,
                                  "email"=>$to,
                                  "subject"=>$subject,
                                  "msg"=>$message
                            );
                            //print_r($var);
                            //exit();
                            mymail('donotreply@sequelone.com',$var);
                                //$m =str_replace(' ', ' ', $mes);

                               /* $subject= $leavedata['LOV_Text'] ." ".$_POST['fromDate']."-".$_POST['toDate'];
                                $message="Dear ".$mes.",<br><br>";
                                $message.="You are requested to approve my ".$leavedata['LOV_Text']." from ".$_POST['fromDate']." to ".$_POST['toDate']." for ".$noOfDays." days due to the reason mentioned below <br>";
                                $message.=$reason ."<br><br>";
                                $message.="Regards <br>";
                                $message.=$requesterRow[0]. "-";
                                $message.=$requesterRow[1];
                                $mail1=mymailer('donotreply@sequelone.com',$subject,$message,$to);*/
              
               
      }
    }
    else{
          echo 0;
      }
    
  }
  if($res){
    echo 1;
  }


}

}

// else if($_POST['type'] =="subCancelStatus"){

//     $id=$_POST['lvid'];
//     $sql="update leave set status='4' where leaveID='$id'";
//     $res=query($query,$sql,$pa,$opt,$ms_db);
//     if($res){
//         echo 1;
//     }else{
//         echo 0;
//     }

// }


elseif ($_POST['type']=="subCancelStatus") {
    $id=$_POST['lvid'];
    $status=$_POST['status'];
    $lvKey=$_POST['lvkey'];
    $loginuser=$_POST['user'];
    $remarks=$_POST['remark'];
  
        $sql1="select * from leave where LevKey='".$lvKey."' ";
        $res1=query($query,$sql1,$pa,$opt,$ms_db);
        echo $countRow=$num($res1);
        $t=0;
        if ($countRow >= 1) {
                $sqlWork="select * from LOVMast where LOV_Field='leave'";
                $resWork=query($query,$sqlWork,$pa,$opt,$ms_db);
                $resData=$fetch($resWork);
                /*------- Getting OD Requester Name ----- */
                    $reqsql="select * from HrdMastQry where Emp_Code='".$loginuser."'";
                    $reqRes=query($query,$reqsql,$pa,$opt,$ms_db);
                    $getReqName=$fetch($reqRes);

                /*------- Getting OD Requester Name----- */


                /*------- Getting OD Details----- */
                 $sqlReq="select *,CONVERT(varchar(10),LvFrom,103) as date_from,CONVERT(varchar(10),LvTo,103) as date_to from  leave  where leaveID='".$id."'";
                $resReq=query($query,$sqlReq,$pa,$opt,$ms_db);
                $resDataReq=$fetch($resReq);
                /*------- Getting OD Details----- */

                while ( $getRow = $fetch($res1)) {
                    /*---------------Email Subject ----------*/
                    
                     while($resData=$fetch($resWork)){
                        if($getRow['LvType'] === $resData['LOV_Value']){
                            $Emailsubject= $resData['LOV_Text'];
                            break;
                        }
                     }
                    /*---------------Email Subject ----------*/

                    $appsql="select * from HrdMastQry where Emp_Code='".$getRow['ApprovedBy']."'";
                    $appRes=query($query,$appsql,$pa,$opt,$ms_db);
                    $getAppName=$fetch($appRes);

                    if($getRow['status'] == "2"){

                        $sql="update leave set status='5',action_remark='$remarks' where LvKey='".$lvKey."' ";
                        $res=query($query,$sql,$pa,$opt,$ms_db);
                        if($res){
                            $to=trim($getAppName['OEMailID']);
                            $subject= "Cancellation Request for Leave-".$Emailsubject;
                            $message="Dear ".$getAppName['EMP_NAME'].",<br><br>";
                            $message.="You are requested to please approve the cancellation request for Leave from ".$resDataReq['date_from']." to ".$resDataReq['date_to']." due to ";
                            $message.="{Reason i.e.".$remarks."}."."<br><br><br>";
                            $message.="Regards,<br>".$getReqName['EMP_NAME']."-".$loginuser;

                            $var [$t][$loginuser.$t.'a']=array(
                                 "id"=>$id,
                                  "msg"=>$message,
                                  "email"=>$to,
                                  "subject"=>$subject);
                            
                        }

                    }else{
                        $sql="update leave set action_status='4', action_remark='$remarks', flag='1' where LvKey='".$lvKey."' and action_status='1' ";
                        $res=query($query,$sql,$pa,$opt,$ms_db);

                            $to=trim($getAppName['OEMailID']);
                            $subject= "Cancelled - Leave Request for -".$Emailsubject;
                            $message="Dear ".$getAppName['EMP_NAME'].",<br><br>";
                            $message.="Leave request has been cancelled from ".$resDataReq['date_from']." to ".$resDataReq['date_to']." due to ";
                            $message.="{Reason i.e.".$remarks."}."."<br><br><br>";
                            $message.="Regards,<br>".$getReqName['EMP_NAME']."-".$loginuser;

                            $var [$t][$loginuser.$t.'a']=array(
                                 "id"=>$id,
                                  "msg"=>$message,
                                  "email"=>$to,
                                  "subject"=>$subject);
                            break;
                    }
                  $t++; 
                }
                    echo 1;
            mymail('donotreply@sequelone.com',$var);
            //print_r($var);
        }else{
            echo 0;
        }

}



/*---------------------------------- My Leave Request ----------------------------------------*/

elseif ($_POST['type'] == "searchMyDate") {

    $fromDate= $_POST['fromDate'];
    $toDate = $_POST['toDate'];
    $loginUser = $_POST['code'];
    
    if ($fromDate == "" && $toDate == "") {
            $sql="select *,convert(varchar(10),LvFrom,103)as LvFrom, convert(varchar(10),LvTo,103)as LvTo from leave where CreatedBy='$loginUser' and flag='1'" ;
        } 
       elseif ($fromDate=="") {
            $sql="select *,convert(varchar(10),LvFrom,103)as LvFrom, convert(varchar(10),LvTo,103)as LvTo from leave where CreatedBy='$loginUser'and LvTo='$toDate' and flag='1'";
        }elseif($toDate==""){
        $sql="select *,convert(varchar(10),LvFrom,103)as LvFrom, convert(varchar(10),LvTo,103)as LvTo from leave where CreatedBy='$loginUser'and LvFrom='$fromDate' and flag='1'";
        }
        else{
            $sql="select *,convert(varchar(10),LvFrom,103)as LvFrom, convert(varchar(10),LvTo,103)as LvTo from leave where CreatedBy='$loginUser'and LvFrom='$fromDate' and LvTo='$toDate' and flag='1'";
        }
            
            $res=query($query,$sql,$pa,$opt,$ms_db);
            if($res){    
                $i=0;
                while($row=$fetch($res)){
                    $mngrcode=$row['ApprovedBy'];
                    $sql1="select EMP_NAME from HrdMastQry WHERE Emp_Code='$mngrcode'";
                    $res1=query($query,$sql1,$pa,$opt,$ms_db);
                    $data1=$fetch($res1);

                 echo" <tr>
                            
                            <td>
                                  ".$row['LvFrom']."
                            </td>
                            <td>
                                  ".$row['LvTo']."
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
                            if($row['status'] == "1"){
                            echo"<a class='myod' data-toggle='modal' href='#large' 
                                onclick='getmyleaveId('".$row['leaveID']."','1','".$loginUser."')'>
                                    <span class='label label-sm bg-blue-steel'>
                                    Pending </span>
                                </a> ";   
                                }else if($row['status'] == "2") {
                                echo" <a class='myod' data-toggle='modal' href='#large'
                                    onclick='getmyleaveId('".$row['leaveID']."','2','".$loginUser."')'>
                                    <span class='label label-sm label-success'>
                                   Approved
                                     </span>
                                 </a>";
                                } else if($row['status'] == "3") {
                                echo "<a class='myod' data-toggle='modal' href='#large'
                                    onclick='getmyleaveId('".$row['leaveID']."','3','".$loginUser."')'>
                                    <span class='label label-sm label-danger'>
                                   Rejected
                                 </span>
                                 </a>";
                                } else if($row['status'] == "4") {
                                echo"<a class='myod' data-toggle='modal' href='#large'
                                    onclick='getmyleaveId('".$row['leaveID']."','4','".$loginUser."')'>
                                    <span class='label label-sm bg-grey-cascade'>
                                   Cancelled
                                 </span>
                                 </a>";
                                }
                                        
                              echo"</td>
                            </tr>";
                            $i++;

                }
            }
     
}


elseif ($_POST['type'] == "searchMyStatus") {
    $statusid= $_POST['statusid'];
    $loginUser=$_POST['code'];
     $sql="select *,CONVERT (VARCHAR(10),LvFrom,103 ) as LvFrom , CONVERT (VARCHAR(10),LvTo,103 ) as LvTo from  leave where status='$statusid' and CreatedBy='$loginUser' and flag='1'";
    $res=query($query,$sql,$pa,$opt,$ms_db);
    while($row= $fetch($res)){
         
        $mngrcode=$row['ApprovedBy'];
        $sql1="select EMP_NAME from HrdMastQry WHERE Emp_Code='$mngrcode'";
        $res1=query($query,$sql1,$pa,$opt,$ms_db);
        $data1=$fetch($res1);

                echo"<tr>

                     <td>
                          ".$row['LvFrom']."
                    </td>
                    <td>
                          ".$row['LvTo']."
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
                     if($row['status'] == "1"){
                            echo"<a class='myod' data-toggle='modal' href='#large' 
                                onclick='getmyleaveId('".$row['leaveID']."','1','".$loginUser."')'>
                                    <span class='label label-sm bg-blue-steel'>
                                    Pending </span>
                                </a> ";   
                                }else if($row['status'] == "2") {
                                echo" <a class='myod' data-toggle='modal' href='#large'
                                    onclick='getmyleaveId('".$row['leaveID']."','2','".$loginUser."')'>
                                    <span class='label label-sm label-success'>
                                   Approved
                                     </span>
                                 </a>";
                                } else if($row['status'] == "3") {
                                echo "<a class='myod' data-toggle='modal' href='#large'
                                    onclick='getmyleaveId('".$row['leaveID']."','3','".$loginUser."')'>
                                    <span class='label label-sm label-danger'>
                                   Rejected
                                 </span>
                                 </a>";
                                } else if($row['status'] == "4") {
                                echo"<a class='myod' data-toggle='modal' href='#large'
                                    onclick='getmyleaveId('".$row['leaveID']."','4','".$loginUser."')'>
                                    <span class='label label-sm bg-grey-cascade'>
                                   Cancelled
                                 </span>
                                 </a>";
                                }
                                        
                              echo"</td>
                            </tr>";
                            $i++;        
    }
}


elseif ($_POST['type'] == "searchMyName") {
    $codename= $_POST['codename'];
    $loginUser=$_POST['code'];
    $sql="select *,CONVERT (VARCHAR(10),LvFrom,103 ) as LvFrom , CONVERT (VARCHAR(10),LvTo,103 ) as LvTo from  leave where CreatedBy='$loginUser'and flag='1' and (ApprovedBy in (select emp_code from HrdMastQry where Emp_FName='$codename' or Emp_MName='$codename' or Emp_LName='$codename') or ApprovedBy='$codename')";
    $res=query($query,$sql,$pa,$opt,$ms_db);
    while($row= $fetch($res)){
         
        $mngrcode=$row['ApprovedBy'];
        $sql1="select EMP_NAME from HrdMastQry WHERE Emp_Code='$mngrcode'";
        $res1=query($query,$sql1,$pa,$opt,$ms_db);
        $data1=$fetch($res1);

         $i=0;       echo"<tr>

                     <td>
                          ".$row['LvFrom']."
                    </td>
                    <td>
                          ".$row['LvTo']."
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
                     if($row['status'] == "1"){
                            echo"<a class='myod' data-toggle='modal' href='#large' 
                                onclick='getmyleaveId('".$row['leaveID']."','1','".$loginUser."')'>
                                    <span class='label label-sm bg-blue-steel'>
                                    Pending </span>
                                </a> ";   
                                }else if($row['status'] == "2") {
                                echo" <a class='myod' data-toggle='modal' href='#large'
                                    onclick='getmyleaveId('".$row['leaveID']."','2','".$loginUser."')'>
                                    <span class='label label-sm label-success'>
                                   Approved
                                     </span>
                                 </a>";
                                } else if($row['status'] == "3") {
                                echo "<a class='myod' data-toggle='modal' href='#large'
                                    onclick='getmyleaveId('".$row['leaveID']."','3','".$loginUser."')'>
                                    <span class='label label-sm label-danger'>
                                   Rejected
                                 </span>
                                 </a>";
                                } else if($row['status'] == "4") {
                                echo"<a class='myod' data-toggle='modal' href='#large'
                                    onclick='getmyleaveId('".$row['leaveID']."','4','".$loginUser."')'>
                                    <span class='label label-sm bg-grey-cascade'>
                                   Cancelled
                                 </span>
                                 </a>";
                                }
                                        
                              echo"</td>
                            </tr>";
                            $i++;        
    }
}




/*------------------------------Approve My Leave Request-------------------------------------*/

elseif ($_POST['type'] == "searchDate") {
    $fromDate= $_POST['fromDate'];
    $toDate = $_POST['toDate'];
    $loginUser = $_POST['code'];
    
    if ($fromDate == "" && $toDate == "") {
            $sql="select *,convert(varchar(10),date_from,103)as date_from, convert(varchar(10),date_to,103)as date_to from outOnWorkRequest where approvedBy='$loginUser'";
        } 
       elseif ($fromDate=="") {
            $sql="select *,convert(varchar(10),date_from,103)as date_from, convert(varchar(10),date_to,103)as date_to from outOnWorkRequest where approvedBy='$loginUser'and date_to='$toDate'";
        }elseif($toDate==""){
        $sql="select *,convert(varchar(10),date_from,103)as date_from, convert(varchar(10),date_to,103)as date_to from outOnWorkRequest where approvedBy='$loginUser'and date_from='$fromDate'";
        }
        else{
            $sql="select *,convert(varchar(10),date_from,103)as date_from, convert(varchar(10),date_to,103)as date_to from outOnWorkRequest where approvedBy='$loginUser'and date_from='$fromDate' and date_to='$toDate'";
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
                             if( $row['action_status']== 2 || $row['action_status']== 3 || $row['action_status']== 4){
                                  echo"  <td></td>";
                                }else { 
                               echo" <td><input type='checkbox' class='checkboxes' id='Mulcheck".$i." onclick='mulCheck('Mulcheck".$i."');'' value='".$row['outWorkId']."'/>
                                </td>";
                                 }
                        echo" <td>
                                  ".$row['date_from']."
                            </td>
                            <td>
                                  ".$row['date_to']."
                            </td>
                            <td>
                                ".$row['natureOfWorkCause']."
                            </td>
                            <td>
                                ".$data1['EMP_NAME']."  
                            </td>
                            <td>";
                            if($row['action_status'] == "1"){?>
                            <a class='myod' data-toggle='modal' href='#large' 
                                onclick="getmyodId('<?php echo $row['outWorkId'];?>','1','<?php echo $loginUser;?>');">
                                    <span class='label label-sm bg-blue-steel'>
                                    Pending </span>
                                </a> <?php   
                                }else if($row['action_status'] == "2") {?>
                                 <a class='myod' data-toggle='modal' href='#large'
                                    onclick="getmyodId('<?php echo $row['outWorkId']?>','2','<?php echo $loginUser;?>');">
                                    <span class='label label-sm label-success'>
                                   Approved
                                     </span>
                                 </a><?php 
                                } else if($row['action_status'] == "3") {?>
                                <a class='myod' data-toggle='modal' href='#large'
                                    onclick="getmyodId('<?php echo $row['outWorkId'];?>','3','<?php echo $loginUser;?>');">
                                    <span class='label label-sm label-danger'>
                                   Rejected
                                 </span>
                                 </a><?php
                                } else if($row['action_status'] == "4") {?>
                                <a class='myod' data-toggle='modal' href='#large'
                                    onclick="getmyodId('<?php echo $row['outWorkId'];?>','4',
                                        '<?php echo $loginUser;?>');">
                                    <span class='label label-sm bg-grey-cascade'>
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
     $sql="select *,CONVERT (VARCHAR(10),date_from,103 ) as date_from , CONVERT (VARCHAR(10),date_to,103 ) as date_to from  outOnWorkRequest where action_status='$statusid' and approvedBy='$loginUser'";
    $res=query($query,$sql,$pa,$opt,$ms_db);
    $i=0;
    while($row= $fetch($res)){
         
        $mngrcode=$row['CreatedBy'];
        $sql1="select EMP_NAME from HrdMastQry WHERE Emp_Code='$mngrcode'";
        $res1=query($query,$sql1,$pa,$opt,$ms_db);
        $data1=$fetch($res1);

                echo"<tr>";

                    if( $row['action_status']== 2 || $row['action_status']== 3 || $row['action_status']== 4){
                                  echo"  <td></td>";
                                }else { 
                               echo" <td><input type='checkbox' class='checkboxes' id='Mulcheck".$i." onclick='mulCheck('Mulcheck".$i."');'' value='".$row['outWorkId']."'/>
                                </td>";
                                 }
                 echo"   
                    <td>
                          ".$row['date_from']."
                    </td>
                    <td>
                          ".$row['date_to']."
                    </td>
                    <td>
                        ".$row['natureOfWorkCause']."
                    </td>
                    <td>
                        ".$data1['EMP_NAME']."  
                    </td>
                    <td>";
                    if($row['action_status'] == "1"){?>
                            <a class='myod' data-toggle='modal' href='#large' 
                                onclick="getmyodId('<?php echo $row['outWorkId'];?>','1','<?php echo $loginUser;?>');">
                                    <span class='label label-sm bg-blue-steel'>
                                    Pending </span>
                                </a> <?php   
                                }else if($row['action_status'] == "2") {?>
                                 <a class='myod' data-toggle='modal' href='#large'
                                    onclick="getmyodId('<?php echo $row['outWorkId']?>','2','<?php echo $loginUser;?>');">
                                    <span class='label label-sm label-success'>
                                   Approved
                                     </span>
                                 </a><?php 
                                } else if($row['action_status'] == "3") {?>
                                <a class='myod' data-toggle='modal' href='#large'
                                    onclick="getmyodId('<?php echo $row['outWorkId'];?>','3','<?php echo $loginUser;?>');">
                                    <span class='label label-sm label-danger'>
                                   Rejected
                                 </span>
                                 </a><?php
                                } else if($row['action_status'] == "4") {?>
                                <a class='myod' data-toggle='modal' href='#large'
                                    onclick="getmyodId('<?php echo $row['outWorkId'];?>','4',
                                        '<?php echo $loginUser;?>');">
                                    <span class='label label-sm bg-grey-cascade'>
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
   $sql="select *,CONVERT (VARCHAR(10),date_from,103 ) as date_from , CONVERT (VARCHAR(10),date_to,103 ) as date_to from  outOnWorkRequest where approvedBy='$loginUser' and (approvedBy in (select emp_code from HrdMastQry where Emp_FName='$codename' or Emp_MName='$codename' or Emp_LName='$codename') or approvedBy='$codename')";
    $res=query($query,$sql,$pa,$opt,$ms_db);
    while($row= $fetch($res)){
        $usercode=$row['CreatedBy'];
        $sql1="select EMP_NAME from HrdMastQry WHERE Emp_Code='$usercode'";
        $res1=query($query,$sql1,$pa,$opt,$ms_db);
        $data1=$fetch($res1);
        $i=0;
        echo"<tr>";
                    if( $row['action_status']== 2 || $row['action_status']== 3 || $row['action_status']== 4){
                                  echo"  <td></td>";
                                }else { 
                               echo" <td><input type='checkbox' class='checkboxes' id='Mulcheck".$i." onclick='mulCheck('Mulcheck".$i."');'' value='".$row['outWorkId']."'/>
                                </td>";
                                 }
               echo"<td>
                          ".$row['date_from']."
                    </td>
                    <td>
                          ".$row['date_to']."
                    </td>
                    <td>
                        ".$row['natureOfWorkCause']."
                    </td>
                    <td>
                        ".$data1['EMP_NAME']."  
                    </td>
                    <td>";
                     if($row['action_status'] == "1"){?>
                            <a class='myod' data-toggle='modal' href='#large' 
                                onclick="getmyodId('<?php echo $row['outWorkId'];?>','1','<?php echo $loginUser;?>');">
                                    <span class='label label-sm bg-blue-steel'>
                                    Pending </span>
                                </a> <?php   
                                }else if($row['action_status'] == "2") {?>
                                 <a class='myod' data-toggle='modal' href='#large'
                                    onclick="getmyodId('<?php echo $row['outWorkId']?>','2','<?php echo $loginUser;?>');">
                                    <span class='label label-sm label-success'>
                                   Approved
                                     </span>
                                 </a><?php 
                                } else if($row['action_status'] == "3") {?>
                                <a class='myod' data-toggle='modal' href='#large'
                                    onclick="getmyodId('<?php echo $row['outWorkId'];?>','3','<?php echo $loginUser;?>');">
                                    <span class='label label-sm label-danger'>
                                   Rejected
                                 </span>
                                 </a><?php
                                } else if($row['action_status'] == "4") {?>
                                <a class='myod' data-toggle='modal' href='#large'
                                    onclick="getmyodId('<?php echo $row['outWorkId'];?>','4',
                                        '<?php echo $loginUser;?>');">
                                    <span class='label label-sm bg-grey-cascade'>
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
   $sql="select *,CONVERT (VARCHAR(10),date_from,103 ) as date_from , CONVERT (VARCHAR(10),date_to,103 ) as date_to from  outOnWorkRequest where approvedBy='$loginUser' and (CreatedBy in (select emp_code from HrdMastQry where Emp_FName='$codename' or Emp_MName='$codename' or Emp_LName='$codename') or CreatedBy='$codename')";
    $res=query($query,$sql,$pa,$opt,$ms_db);
    while($row= $fetch($res)){
        $usercode=$row['CreatedBy'];
        $sql1="select EMP_NAME from HrdMastQry WHERE Emp_Code='$usercode'";
        $res1=query($query,$sql1,$pa,$opt,$ms_db);
        $data1=$fetch($res1);
        $i=0;
        echo"<tr>";
                    if( $row['action_status']== 2 || $row['action_status']== 3 || $row['action_status']== 4){
                                  echo"  <td></td>";
                                }else { 
                               echo" <td><input type='checkbox' class='checkboxes' id='Mulcheck".$i." onclick='mulCheck('Mulcheck".$i."');'' value='".$row['outWorkId']."'/>
                                </td>";
                                 }
               echo"<td>
                        ".$row['date_from']."  
                    </td>
                    <td>
                          ".$row['date_to']."
                    </td>
                    <td>
                        ".$row['natureOfWorkCause']."
                    </td>
                    <td>
                        ".$data1['EMP_NAME']."  
                    </td>
                    <td>";
                     if($row['action_status'] == "1"){?>
                            <a class='myod' data-toggle='modal' href='#large' 
                                onclick="getmyodId('<?php echo $row['outWorkId'];?>','1','<?php echo $loginUser;?>');">
                                    <span class='label label-sm bg-blue-steel'>
                                    Pending </span>
                                </a> <?php   
                                }else if($row['action_status'] == "2") {?>
                                 <a class='myod' data-toggle='modal' href='#large'
                                    onclick="getmyodId('<?php echo $row['outWorkId']?>','2','<?php echo $loginUser;?>');">
                                    <span class='label label-sm label-success'>
                                   Approved
                                     </span>
                                 </a><?php 
                                } else if($row['action_status'] == "3") {?>
                                <a class='myod' data-toggle='modal' href='#large'
                                    onclick="getmyodId('<?php echo $row['outWorkId'];?>','3','<?php echo $loginUser;?>');">
                                    <span class='label label-sm label-danger'>
                                   Rejected
                                 </span>
                                 </a><?php
                                } else if($row['action_status'] == "4") {?>
                                <a class='myod' data-toggle='modal' href='#large'
                                    onclick="getmyodId('<?php echo $row['outWorkId'];?>','4',
                                        '<?php echo $loginUser;?>');">
                                    <span class='label label-sm bg-grey-cascade'>
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

elseif ($_POST['type'] == "birth_Anniv") {
  $empCode= $_POST['ecode'];
  $date=$_POST['date'];
  if($_POST['leaveType'] == 5){
    $sql="select convert(varchar(20),DOB,103) as DOB from HrdMastQry where Emp_Code='$empCode' ";
    $res=query($query,$sql,$pa,$opt,$ms_db);
    $row=$fetch($res);
     $row['DOB'];
    if($row['DOB'] == $date){
        echo 1;
      }else{
        echo 0;
      }
    }else{
        $sql="select convert(varchar(20),Anniversary,103) as Anniversary from HrdMastQry where Emp_Code='$empCode' ";
    $res=query($query,$sql,$pa,$opt,$ms_db);
    $row=$fetch($res);
    if($row['Anniversary'] == $date){
        echo 1;
      }else{
        echo 0;
      }
    }
}

elseif ($_POST['type'] == "maternity") {
  $empCode= $_POST['ecode'];
  
  
    $sql="select Sex from HrdMastQry where Emp_Code='$empCode' ";
    $res=query($query,$sql,$pa,$opt,$ms_db);
    $row=$fetch($res);
     $row['Sex'];
    if($row['Sex'] == 2){
        echo 1;
      }else{
        echo 0;
      }
   
}


elseif ($_POST['type'] == "sick") {
  $empCode= $_POST['ecode'];
  $days= $_POST['applDays'];
    $sql="select Sex from HrdMastQry where Emp_Code='$empCode' ";
    $res=query($query,$sql,$pa,$opt,$ms_db);
    $row=$fetch($res);
     $row['Sex'];
    if($row['Sex'] == 2){
        echo 1;
      }else{
        echo 0;
      }
   
}

elseif ($_POST['type'] == "el") {
  $empCode= $_POST['ecode'];
  $days= $_POST['applDays'];
    $sql="select Sex from HrdMastQry where Emp_Code='$empCode' ";
    $res=query($query,$sql,$pa,$opt,$ms_db);
    $row=$fetch($res);
     $row['Sex'];
    if($row['Sex'] == 2){
        echo 1;
      }else{
        echo 0;
      }
   
}

function dateConversion($sDate){

        $aDate = explode('/', $sDate);

        @$sMySQLTimestamp = sprintf(
            '%s-%s-%s 00:00:00',
            @$aDate[2],
            @$aDate[1],
            @$aDate[0]
        );

    return $sMySQLTimestamp;

}

?>
