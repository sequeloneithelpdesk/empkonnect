<?php 

include '../../db_conn.php';
include ('../../configdata.php');

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
  $approverId=$_POST['approverId'];
    $attachment=$_POST['ufile'];
    $total = count($_FILES['uploadfile']['name']);

    $quer="select count(leaveID) as count from leave where 
     ((LvFrom <= '$forDate' and LvTo >= '$toDate'  ) 
      or (LvTo >= '$toDate' and LvFrom <= '$forDate'  ) 
      or (LvFrom between '$forDate' and '$toDate'))
      and CreatedBy='$leavefor'";
    $resu = query($query,$quer,$pa,$opt,$ms_db);
    $data=$fetch($resu);

    if($data['count'] >= 1){
      echo 2;
    }else{

      for($i=0; $i<$total; $i++) {

        $tmpFilePath = $_FILES['uploadfile']['tmp_name'][$i];

        if ($tmpFilePath != ""){

            $newFilePath = "../upload/" . $_FILES['uploadfile']['name'][$i];


            if(move_uploaded_file($tmpFilePath, $newFilePath)) {

               //echo "done";

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

        $sql="insert into LEAVE (Trn_Code,Trn_Date,Lvfrom,LvTo,FromHalf,toHalf,reason,LvType,LvDays,mobile,Email,Address,LvApplication,OnDutyAtten,PastAtten,CreatedBy,ApprovedBy,flag,status,levkey,attachments) values ('R',getdate(),'$forDate','$toDate','$forHalf','$toHalf','$reason','$leaveType','$noOfDays','$empMobile','$empEmail','$empAddress','$LeaveAppli','$OnDuty','$PastAtten','$leavefor','$lev[$i]','$flag','1','$key','$attachment')";
          $res=query($query,$sql,$pa,$opt,$ms_db);
      }
      if($res){
            $queMail= "Select OEMailID from HrdMastQry where Emp_Code='$approverId'";
            $resMail= query($query,$queMail,$pa,$opt,$ms_db);
            $appMail=$fetch($resMail);

            $to=trim($appMail['OEMailID']);
            //$to[]='himanshu@agnitioworld.com';
            $subject= $leaveType ." ".$forDate." ".$toDate;
            $message="Dear,  ,<br>";
            $message.="You are requested to approve my ".$leaveType." from ".$forDate." to ".$toDate." for ".$noOfDays."due to the reason mentioned below <br>";
            $message.=$reason ."<br>";
            $message.="Regards,<br>".$_POST['requesterID'];
            
            $mail1=mymailer('donotreply@sequelone.com',$subject,$message,$to);
            echo 1;
          
      }else{
          echo 0;
      }
    }
}



else if($_POST['type'] =="subCancelStatus"){

    $id=$_POST['lvid'];
    $sql="update leave set status='4' where leaveID='$id'";
    $res=query($query,$sql,$pa,$opt,$ms_db);
    if($res){
        echo 1;
    }else{
        echo 0;
    }

}


elseif ($_POST['type']=="subCancelStatus") {
    $id=$_POST['id'];
    $status=$_POST['status'];
    $oDKey=$_POST['odkey'];
    $loginuser=$_POST['user'];
    $remarks=$_POST['remark'];
  
        $sql1="select * from outOnWorkRequest where oDKey='".$oDKey."' ";
        $res1=query($query,$sql1,$pa,$opt,$ms_db);
        $countRow=$num($res1);
        $t=0;
        if ($countRow >= 1) {
                $sqlWork="select * from LOVMast  where LOV_Field='natureOfWork'";
                $resWork=query($query,$sqlWork,$pa,$opt,$ms_db);
                $resData=$fetch($resWork);
                /*------- Getting OD Requester Name ----- */
                    $reqsql="select * from HrdMastQry where Emp_Code='".$loginuser."'";
                    $reqRes=query($query,$reqsql,$pa,$opt,$ms_db);
                    $getReqName=$fetch($reqRes);

                /*------- Getting OD Requester Name----- */


                /*------- Getting OD Details----- */
                 $sqlReq="select *,CONVERT(varchar(10),date_from,103) as date_from,CONVERT(varchar(10),date_to,103) as date_to from  outOnWorkRequest  where outWorkId='".$id."'";
                $resReq=query($query,$sqlReq,$pa,$opt,$ms_db);
                $resDataReq=$fetch($resReq);
                /*------- Getting OD Details----- */

                while ( $getRow = $fetch($res1)) {
                    /*---------------Email Subject ----------*/
                    
                     while($resData=$fetch($resWork)){
                        if($getRow['natureOfWork'] === $resData['LOV_Value']){
                            $Emailsubject= $resData['LOV_Text'];
                            break;
                        }
                     }
                    /*---------------Email Subject ----------*/

                    $appsql="select * from HrdMastQry where Emp_Code='".$getRow['approvedBy']."'";
                    $appRes=query($query,$appsql,$pa,$opt,$ms_db);
                    $getAppName=$fetch($appRes);

                    if($getRow['action_status'] == "2"){

                        $sql="update outOnWorkRequest set action_status='5',action_remark='$remarks' where oDKey='".$oDKey."' ";
                        $res=query($query,$sql,$pa,$opt,$ms_db);
                        if($res){
                            $to=trim($getAppName['OEMailID']);
                            $subject= "Cancellation Request for Out on Duty-".$Emailsubject;
                            $message="Dear ".$getAppName['EMP_NAME'].",<br><br>";
                            $message.="You are requested to please approve the cancellation request for out on duty from ".$resDataReq['date_from']." to ".$resDataReq['date_to']." due to ";
                            $message.="{Reason i.e.".$remarks."}."."<br><br><br>";
                            $message.="Regards,<br>".$getReqName['EMP_NAME']."-".$loginuser;

                            $var [$t][$loginuser.$t.'a']=array(
                                 "id"=>$id,
                                  "msg"=>$message,
                                  "email"=>$to,
                                  "subject"=>$subject);
                            
                        }

                    }else{
                        $sql="update outOnWorkRequest set action_status='4', action_remark='$remarks', flag='1' where oDKey='".$oDKey."' and action_status='1' ";
                        $res=query($query,$sql,$pa,$opt,$ms_db);


                            $to=trim($getAppName['OEMailID']);
                            $subject= "Cancelled - Out on Duty for -".$Emailsubject;
                            $message="Dear ".$getAppName['EMP_NAME'].",<br><br>";
                            $message.="Out on duty request has been cancelled from ".$resDataReq['date_from']." to ".$resDataReq['date_to']." due to ";
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
