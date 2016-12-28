<?php

include '../../db_conn.php';
include ('../../configdata.php');
include ('../Events/weekly_off.php');
include ('../Events/public_holidays.php');


if($_POST['type'] == "subCancelStatus")
{	
	$id=$_POST['id'];
  $status=$_POST['status'];
  $attnKey=$_POST['pastkey'];
  $loginuser=$_POST['user'];
  $remarks=$_POST['remark'];

    $sql1="select * from markPastAttendance where AttnKey='".$attnKey."' ";
    $res1=query($query,$sql1,$pa,$opt,$ms_db);
    $countRow=$num($res1);

    $t=0;
    if ($countRow >= 1) {
        $sqlWork="select * from LOVMast where LOV_Field='reasonForNotMarking'";
        $resWork=query($query,$sqlWork,$pa,$opt,$ms_db);
        $resData=$fetch($resWork);

        /*------- Getting Requester Name ----- */
        $reqsql="select * from HrdMastQry where Emp_Code='".$loginuser."'";
        $reqRes=query($query,$reqsql,$pa,$opt,$ms_db);
        $getReqName=$fetch($reqRes);

        /*------- Getting Requester Name----- */


        /*------- Getting Details----- */
         $sqlReq="select *,CONVERT(varchar(10),date_from,103) as date_from,CONVERT(varchar(10),date_to,103) as date_to from  markPastAttendance  where markPastId='".$id."'";
        $resReq=query($query,$sqlReq,$pa,$opt,$ms_db);
        $resDataReq=$fetch($resReq);
        /*------- Getting OD Details----- */

        while ( $getRow = $fetch($res1)) {
            /*---------------Email Subject ----------*/
            
             while($resData=$fetch($resWork)){
                if($getRow['notMarkingReason'] === $resData['LOV_Value']){
                    $Emailsubject= $resData['LOV_Text'];
                    break;
                }
             }
            /*---------------Email Subject ----------*/

            $appsql="select * from HrdMastQry where Emp_Code='".$getRow['approvedBy']."'";
            $appRes=query($query,$appsql,$pa,$opt,$ms_db);
            $getAppName=$fetch($appRes);

            if($getRow['action_status'] == "2"){

                $sql="update markPastAttendance set action_status='5',remarks='$remarks',UpdatedOn=getdate() where AttnKey='".$attnKey."' ";
                $res=query($query,$sql,$pa,$opt,$ms_db);
                if($res){
                    $to=trim($getAppName['OEMailID']);
                    $subject= "Cancellation Request for Mark Past Attendance-".$Emailsubject;
                    $message="Dear ".$getAppName['EMP_NAME'].",<br><br>";
                    $message.="You are requested to please approve the cancellation request for mark past attendance from ".$resDataReq['date_from']." to ".$resDataReq['date_to']." due to ";
                    $message.="{Reason i.e.".$remarks."}."."<br><br><br>";
                    $message.="Regards,<br>".$getReqName['EMP_NAME']."-".$loginuser;

                    $var [$t][$loginuser.$t.'a']=array(
                         "id"=>$id,
                          "msg"=>$message,
                          "email"=>$to,
                          "subject"=>$subject);
                    
                }

            }else{
                $sql="update markPastAttendance set action_status='4', remarks='$remarks', UpdatedOn=getdate(), flag='1' where AttnKey='".$attnKey."' and action_status='1' ";
                $res=query($query,$sql,$pa,$opt,$ms_db);


                    $to=trim($getAppName['OEMailID']);
                    $subject= "Cancelled - Mark Past Attendance for -".$Emailsubject;
                    $message="Dear ".$getAppName['EMP_NAME'].",<br><br>";
                    $message.="Mark past attendance request has been cancelled from ".$resDataReq['date_from']." to ".$resDataReq['date_to']." due to ";
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

    // $sql="update markPastAttendance set action_status='4',UpdatedBy='$userCode',UpdatedOn=getdate(), flag='1' where markPastId='$id'";
    // $res=query($query,$sql,$pa,$opt,$ms_db);
    // if($res){
    //     echo 1;
    // }else{
    //     echo 0;
    // }
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
    $action_remark=ucwords(strtolower($_POST['remark']));

     
     /*--------For Getting Not Marking Reason------*/
       $sqlWork2="select * from LOVMast where LOV_Field='reasonForNotMarking'";
       $resWork2=query($query,$sqlWork2,$pa,$opt,$ms_db); 
     /*--------For Getting Not Marking Reason------*/

      $sql1="select *,CONVERT(varchar(10), date_from, 103) as date_from,CONVERT(varchar(10), date_to, 103) as date_to from markPastAttendance where markPastId IN ($inputval)";
      $res1=query($query,$sql1,$pa,$opt,$ms_db);
      if($res1){
        $t=0;
          while ($row1=$fetch($res1)) {

              if($row1['action_status'] == "1"){

                /*---------------Start Email Subject ----------*/
                while($resData2=$fetch($resWork2)){  
                    if($row1['notMarkingReason'] === $resData2['LOV_Value']){
                        $Emailsubject2= $resData2['LOV_Text'];
                        break;
                    }
                 }

                 if($status == "2"){
                        $approvedRes="Approved";
                  }elseif($status == "3"){
                        $approvedRes="Rejected";
                  }
                /*---------------End Email Subject ----------*/

                $sql="update markPastAttendance set action_status='$status',action_remark='$action_remark' WHERE approvedBy='$userCode' and markPastId=".$row1['markPastId']." and action_status='1' ";
                $res=query($query,$sql,$pa,$opt,$ms_db);
              
                $reqMail= "Select OEMailID,EMP_NAME from HrdMastQry where Emp_Code='".$row1['CreatedBy']."'";
                $reqName= "Select EMP_NAME from HrdMastQry where Emp_Code='".$userCode."'";
                $resMail= query($query,$reqMail,$pa,$opt,$ms_db);
                $nameMail= query($query,$reqName,$pa,$opt,$ms_db);

                $rMail=$fetch($resMail);
                $name=$fetch($nameMail);

                $to=trim($rMail['OEMailID']);
                $subject= "Approved Past Attendance Request-".$Emailsubject2;
                $message="Dear ".$rMail['EMP_NAME'].",<br><br>";
                $message.="Your request of past attendance  from ".$row1['date_from']." to ".$row1['date_to']." for ";
                $message.=$Emailsubject2 ." has been Approved.<br><br><br>";
                $message.="Regards,<br>";
                $message.=$name['EMP_NAME']."-".$row1['CreatedBy'];
                $var [$t][$userCode.$t.'a']=array(
                  "id"=>$userCode,
                                  "msg"=>$message,
                                  "email"=>$rMail['OEMailID'],
                                  "subject"=>$subject);
                
               

                $sql2="SELECT TOP 1 *,CONVERT(varchar(10),date_from,103)as date_from, CONVERT(varchar(10),date_to,103)as date_to from markPastAttendance  where AttnKey ='".$row1['AttnKey']."' and flag='0' ORDER BY CreatedOn ASC";
                $res2=query($query,$sql2,$pa,$opt,$ms_db);
                $len=$num($res2);

                if($len >= 1){
                  $row6=$fetch($res2);
                   $sql3="update markPastAttendance set flag='1' where markPastId='".$row6['markPastId']."'";
                  $res3= query($query,$sql3,$pa,$opt,$ms_db);
                  if($res3){
                    
                    $aprMail= "Select OEMailID,EMP_NAME from HrdMastQry where Emp_Code='".$row6['approvedBy']."'";
                    $res1Mail= query($query,$aprMail,$pa,$opt,$ms_db);
                    $aMail=$fetch($res1Mail);

                    $creaName= "Select EMP_NAME from HrdMastQry where Emp_Code='".$row6['CreatedBy']."'";
                    $creaNameRes= query($query,$creaName,$pa,$opt,$ms_db);
                    $name1=$fetch($creaNameRes);

                     $to2=trim($aMail['OEMailID']);
                    $subject2= "Past Attendance Request-".$Emailsubject2;
                    $message2="Dear ".$aMail['EMP_NAME'].",<br><br>";
                    $message2.="You are requested to approve past attendance from ".$row6['date_from']." to ".$row6['date_to']." due to <br>";
                    $message2.=$Emailsubject2 ."<br><br><br>";
                    $message2.="Regards,<br>".$name1['EMP_NAME']."-".$row6['CreatedBy'];
                    $var[$t] [$row6['CreatedBy'].$t.'b']=array(
                                  "id"=>$row6['CreatedBy'],
                                  "msg"=>$message2,
                                  "email"=>$aMail['OEMailID'],
                                  "subject"=>$subject2);
                  }
                  
                  
                }

              }
              else if($row1['action_status'] == "5"){

                /*---------------Start Email Subject ----------*/
                while($resData2=$fetch($resWork2)){  
                    if($row1['notMarkingReason'] === $resData2['LOV_Value']){
                        $Emailsubject2= $resData2['LOV_Text'];
                        break;
                    }
                 }

                 if($status == "2"){
                        $approvedRes="Approved Cancellation Request";
                  }elseif($status == "3"){
                        $approvedRes="Rejected Cancellation Request";
                  }
                /*---------------End Email Subject ----------*/

                $sql="update markPastAttendance set action_status='4',action_remark='$action_remark' WHERE approvedBy='$userCode' and markPastId=".$row1['markPastId']." and action_status='5'";
                $res=query($query,$sql,$pa,$opt,$ms_db);
              
                $reqMail= "Select OEMailID,EMP_NAME from HrdMastQry where Emp_Code='".$row1['CreatedBy']."'";
                $reqName= "Select EMP_NAME from HrdMastQry where Emp_Code='".$userCode."'";
                $resMail= query($query,$reqMail,$pa,$opt,$ms_db);
                $nameMail= query($query,$reqName,$pa,$opt,$ms_db);

                $rMail=$fetch($resMail);
                $name=$fetch($nameMail);

                $to=trim($rMail['OEMailID']);
                $subject= "Approved Cancellation Mark Past Attendance Request-".$Emailsubject2;
                $message="Dear ".$rMail['EMP_NAME'].",<br><br>";
                $message.="Your Cancellation request of past attendance  from ".$row1['date_from']." to ".$row1['date_to']." for ";
                $message.=$Emailsubject2 ." has been ".$approvedRes.".<br><br><br>";
                $message.="Regards,<br>";
                $message.=$name['EMP_NAME']."-".$row1['CreatedBy'];
                $var [$t][$userCode.$t.'a']=array(
                  "id"=>$userCode,
                                  "msg"=>$message,
                                  "email"=>$rMail['OEMailID'],
                                  "subject"=>$subject);
                
               

                $sql2="SELECT TOP 1 *,CONVERT(varchar(10),date_from,103)as date_from, CONVERT(varchar(10),date_to,103)as date_to from markPastAttendance  where AttnKey ='".$row1['AttnKey']."' and flag='0' ORDER BY CreatedOn ASC";
                $res2=query($query,$sql2,$pa,$opt,$ms_db);
                $len=$num($res2);

                if($len >= 1){
                  $row6=$fetch($res2);
                   $sql3="update markPastAttendance set action_status='4', flag='1' where markPastId='".$row6['markPastId']."'";
                  $res3= query($query,$sql3,$pa,$opt,$ms_db);
                  if($res3){
                    
                    $aprMail= "Select OEMailID,EMP_NAME from HrdMastQry where Emp_Code='".$row6['approvedBy']."'";
                    $res1Mail= query($query,$aprMail,$pa,$opt,$ms_db);
                    $aMail=$fetch($res1Mail);

                    $creaName= "Select EMP_NAME from HrdMastQry where Emp_Code='".$row6['CreatedBy']."'";
                    $creaNameRes= query($query,$creaName,$pa,$opt,$ms_db);
                    $name1=$fetch($creaNameRes);

                     $to2=trim($aMail['OEMailID']);
                    $subject2= "Cancelled -Past Attendance Request-".$Emailsubject2;
                    $message2="Dear ".$aMail['EMP_NAME'].",<br><br>";
                    $message2.="Past attendance has been cancelled from ".$row6['date_from']." to ".$row6['date_to']." due to <br>";
                    $message2.=$Emailsubject2 ."<br><br><br>";
                    $message2.="Regards,<br>".$name1['EMP_NAME']."-".$row6['CreatedBy'];
                    $var[$t] [$row6['CreatedBy'].$t.'b']=array(
                                  "id"=>$row6['CreatedBy'],
                                  "msg"=>$message2,
                                  "email"=>$aMail['OEMailID'],
                                  "subject"=>$subject2);
                  }
                  
                  
                }
              }
            $t++;
          }

          mymail('donotreply@sequelone.com',$var);
          //print_r($var);
          echo 1; 
      }else{
        echo 0;
      }

}

else if($_POST['type']=="AppStatus"){
    $var=array();
    $id=$_POST['odid'];
    $status_code=$_POST['status_code'];
    $code=$_POST['code'];
    $loginuser=$_POST['user'];
    $action_remark=ucwords(strtolower($_POST['remark']));


        $sqlWork="select LOV_Value,LOV_Text from LOVMast where LOV_Field='reasonForNotMarking'";
        $resWork=query($query,$sqlWork,$pa,$opt,$ms_db);
        $resData=$fetch($resWork);

        $getSql="select *,CONVERT(varchar(10),date_from,103) as date_from,CONVERT(varchar(10),date_to,103) as date_to from markPastAttendance where markPastId='$id'";
            $getResSql=query($query,$getSql,$pa,$opt,$ms_db);
             
        if($getResSql){
                $t=0;
            while ($valOD=$fetch($getResSql)) {

                if($valOD['action_status'] == "5"){

                    $sql="update markPastAttendance set action_status='$status_code',action_remark='$action_remark' where markPastId='$id'";
                    $res=query($query,$sql,$pa,$opt,$ms_db);

                        /*---------------Email Subject ----------*/
                        
                         while($resData=$fetch($resWork)){
                            if($valOD['notMarkingReason'] === $resData['LOV_Value']){
                                $Emailsubject= $resData['LOV_Text'];
                                break;
                            }
                         }
                        /*---------------Email Subject ----------*/

                        $reqMail= "Select OEMailID,EMP_NAME from HrdMastQry where Emp_Code='".$code."'";
                        $apprName= "Select EMP_NAME from HrdMastQry where Emp_Code='".$loginuser."'";
                        $resMail= query($query,$reqMail,$pa,$opt,$ms_db);
                        $nameMail= query($query,$apprName,$pa,$opt,$ms_db);

                        $rMail=$fetch($resMail);
                        $name=$fetch($nameMail);


                        if($valOD['action_status'] == '2'){
                            $approveAction="Approved Cancellation Request";
                        }else{
                            $approveAction="Rejected Cancellation Request";
                        }
                        $AttnKey=$valOD['AttnKey'];

                        $to=trim($rMail['OEMailID']);
                        $subject= "Approved Cancellation Past Attendance Request-".$Emailsubject;
                        $message="Dear ".$rMail['EMP_NAME'].",<br><br>";
                        $message.="Your Cancellation request of Past Attendance Request from  ".$valOD['date_from']." to ".$valOD['date_to']." for ";
                        $message.=$Emailsubject." has been ".$approveAction.".<br><br><br>";
                        $message.="Regards,<br>".$name['EMP_NAME']."-".$loginuser;
                        $var [$t][$loginuser.$t.'a']=array(
                              "id"=>$id,
                              "msg"=>$message,
                              "email"=>$rMail['OEMailID'],
                              "subject"=>$subject);

                        $sql3="SELECT TOP 1 *,CONVERT(varchar(10),date_from,103) as date_from,CONVERT(varchar(10),date_to,103) as date_to from markPastAttendance  where AttnKey='$AttnKey' and flag='0' ORDER BY CreatedOn DESC";
                        $res3=query($query,$sql3,$pa,$opt,$ms_db); 

                        if($res3){
                           $row6=$fetch($res3);
                           $sql4="update markPastAttendance set flag='1' where markPastId='".$row6['markPastId']."'";
                           $res4= query($query,$sql4,$pa,$opt,$ms_db);
                           if($res4){

                            $apprMail= "Select OEMailID,EMP_NAME from HrdMastQry where Emp_Code='".$row6['approvedBy']."'";
                            $apprMailRes= query($query,$apprMail,$pa,$opt,$ms_db);
                            $apprMail=$fetch($apprMailRes);

                            $creaName= "Select EMP_NAME from HrdMastQry where Emp_Code='".$row6['CreatedBy']."'";
                            $creaNameRes= query($query,$creaName,$pa,$opt,$ms_db);
                            $name1=$fetch($creaNameRes);

                            $to2=trim($apprMail['OEMailID']);
                            $subject2= "Cancelled - Past Attendance Request for-".$Emailsubject;
                            $message2="Dear ".$apprMail['EMP_NAME'].",<br><br>";
                            $message2.="Past Attendance Request has been cancelled from ".$row6['date_from']." to ".$row6['date_to']." due to ";
                            $message2.=$Emailsubject.".<br><br><br>";
                            $message2.="Regards,<br>".$name1['EMP_NAME']."-".$row6['CreatedBy'];
                            $var[$t] [$row6['CreatedBy'].$t.'b']=array(
                                      "id"=>$row6['CreatedBy'],
                                      "msg"=>$message2,
                                      "email"=>$aMail['OEMailID'],
                                      "subject"=>$subject2);
                            }   
                            $t++;
                        }     
                }

                else if($valOD['action_status'] == "1"){

                    $sql="update markPastAttendance set action_status='$status_code',action_remark='$action_remark' where markPastId='$id'";
                    $res=query($query,$sql,$pa,$opt,$ms_db);

                        /*---------------Email Subject ----------*/
                        
                         while($resData=$fetch($resWork)){
                            if($valOD['notMarkingReason'] === $resData['LOV_Value']){
                                $Emailsubject= $resData['LOV_Text'];
                                break;
                            }
                         }
                        /*---------------Email Subject ----------*/

                        $reqMail= "Select OEMailID,EMP_NAME from HrdMastQry where Emp_Code='".$code."'";
                        $apprName= "Select EMP_NAME from HrdMastQry where Emp_Code='".$loginuser."'";
                        $resMail= query($query,$reqMail,$pa,$opt,$ms_db);
                        $nameMail= query($query,$apprName,$pa,$opt,$ms_db);

                        $rMail=$fetch($resMail);
                        $name=$fetch($nameMail);


                        if($valOD['action_status'] == '2'){
                            $approveAction="Approved";
                        }else{
                            $approveAction="Rejected";
                        }
                        $AttnKey=$valOD['AttnKey'];

                        $to=trim($rMail['OEMailID']);
                        $subject= "Approved Past Attendance Request-".$Emailsubject;
                        $message="Dear ".$rMail['EMP_NAME'].",<br><br>";
                        $message.="Your request of Past Attendance from ".$valOD['date_from']." to ".$valOD['date_to']." for ";
                        $message.=$Emailsubject." has been ".$approveAction.".<br><br><br>";
                        $message.="Regards,<br>".$name['EMP_NAME']."-".$loginuser;
                        $var [$t][$loginuser.$t.'a']=array(
                             "id"=>$id,
                              "msg"=>$message,
                              "email"=>$rMail['OEMailID'],
                              "subject"=>$subject);

                        $sql3="SELECT TOP 1 *,CONVERT(varchar(10),date_from,103) as date_from,CONVERT(varchar(10),date_to,103) as date_to from markPastAttendance  where AttnKey='$AttnKey' and flag='0' ORDER BY CreatedOn DESC";
                        $res3=query($query,$sql3,$pa,$opt,$ms_db); 

                        if($res3){
                           $row6=$fetch($res3);
                           $sql4="update markPastAttendance set flag='1' where markPastId='".$row6['markPastId']."'";
                           $res4= query($query,$sql4,$pa,$opt,$ms_db);
                           if($res4){

                            $apprMail= "Select OEMailID,EMP_NAME from HrdMastQry where Emp_Code='".$row6['approvedBy']."'";
                            $apprMailRes= query($query,$apprMail,$pa,$opt,$ms_db);
                            $apprMail=$fetch($apprMailRes);

                            $creaName= "Select EMP_NAME from HrdMastQry where Emp_Code='".$row6['CreatedBy']."'";
                            $creaNameRes= query($query,$creaName,$pa,$opt,$ms_db);
                            $name1=$fetch($creaNameRes);

                            $to2=trim($apprMail['OEMailID']);
                            $subject2= "Past Attendance Request-".$Emailsubject;
                            $message2="Dear ".$apprMail['EMP_NAME'].",<br><br>";
                            $message2.="You are requested to approve Past Attendance Request from ".$row6['date_from']." to ".$row6['date_to']." due to ";
                            $message2.=$Emailsubject.".<br><br><br>";
                            $message2.="Regards,<br>".$name1['EMP_NAME']."-".$row6['CreatedBy'];
                            $var[$t] [$row6['CreatedBy'].$t.'b']=array(
                                      "id"=>$row6['CreatedBy'],
                                      "msg"=>$message2,
                                      "email"=>$aMail['OEMailID'],
                                      "subject"=>$subject2);
                            }   
                            $t++;
                        }     
                }
            }
            mymail('donotreply@sequelone.com',$var);
            echo 1;
        }else{
            echo 0;
        }

}

/*------------Main Content after Search Start--------------*/

else if($_POST['type'] == "appMainContent"){
    $loginUser = $_POST['userCode'];
    $sql="select *,CONVERT (VARCHAR(10),date_from,103 ) as date_from , CONVERT (VARCHAR(10),date_to,103 ) as date_to,CONVERT (VARCHAR(35),CreatedOn,109 ) as CreatedOn from markPastAttendance WHERE approvedBy='$loginUser' and flag='1'";
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
                        echo" 
                             <td>
                                ".$row['CreatedOn']."  
                             </td>

                             <td>
                                ".$data1['EMP_NAME']."  
                            </td>
                            <td>
                                  ".$row['date_from']." to ".$row['date_to']."
                            </td>
                            <td>";
                              if($row['notMarkingReason'] == "forgot"){
                                        echo "Forgot to punch/mark attendance";
                                    }else if($row['notMarkingReason'] == "machine_not_work"){
                                        echo "Machine is not working ";
                                    }else{
                                        echo "Others";
                                    }

                           echo "</td>
                            
                            <td>";
                            if($row['action_status'] == "1"){?>
                            <a class='myod' data-toggle='modal' href='#large' 
                                onclick="getmypastId('<?php echo $row['markPastId'];?>','1','<?php echo $loginUser;?>');">
                                    <span class='label  bg-blue-steel'>
                                    Pending </span>
                                </a> <?php   
                                }else if($row['action_status'] == "2") {?>
                                 <a class='myod' data-toggle='modal' href='#large'
                                    onclick="getmypastId('<?php echo $row['markPastId']?>','2','<?php echo $loginUser;?>');">
                                    <span class='label  label-success'>
                                   Approved
                                     </span>
                                 </a><?php 
                                } else if($row['action_status'] == "3") {?>
                                <a class='myod' data-toggle='modal' href='#large'
                                    onclick="getmypastId('<?php echo $row['markPastId'];?>','3','<?php echo $loginUser;?>');">
                                    <span class='label  label-danger'>
                                   Rejected
                                 </span>
                                 </a><?php
                                } else if($row['action_status'] == "4") {?>
                                <a class='myod' data-toggle='modal' href='#large'
                                    onclick="getmypastId('<?php echo $row['markPastId'];?>','4',
                                        '<?php echo $loginUser;?>');">
                                    <span class='label bg-grey-cascade'>
                                   Cancelled
                                 </span>
                                 </a><?php
                                } else if($row['action_status'] == "5") {?>
                                <a class='myod' data-toggle='modal' href='#large'
                                    onclick="getmypastId('<?php echo $row['markPastId'];?>','4',
                                        '<?php echo $loginUser;?>');">
                                    <span class='label bg-blue-steel'>
                                   Cancellation Request Pending
                                 </span>
                                 </a> 
                                 <?php }?>
                             <?php           
                             echo"</td>
                              <td></td>
                            </tr>";
                            $i++;
                }
            }

}


/*------------Search Start--------------*/
else if ($_POST['type'] == "searchStatus") {

	$statusid= $_POST['statusid'];
	$userCode=$_POST['code'];
	 $sql="select *,CONVERT (VARCHAR(10),date_from,103 ) as date_from , CONVERT (VARCHAR(10),date_to,103 ) as date_to,CONVERT (VARCHAR(25),CreatedOn,109 ) as CreatedOn from  markPastAttendance where action_status='$statusid' and approvedBy='$userCode'";
    $res=query($query,$sql,$pa,$opt,$ms_db);
    while($row= $fetch($res)){
    	  $usercode=$row['CreatedBy'];
        $sql1="select EMP_NAME from HrdMastQry WHERE Emp_Code='$usercode'";
        $res1=query($query,$sql1,$pa,$opt,$ms_db);
        $data1=$fetch($res1);

        $sqlWork="select * from LOVMast where LOV_Field='reasonForNotMarking'";
        $resWork=query($query,$sqlWork,$pa,$opt,$ms_db);
        $resData=$fetch($resWork);// Not Marking Reason Query

    	 $i=0;
    	echo "<tr class='odd gradeX'>";
                            if( $row['action_status']== 2 || $row['action_status']== 3 || $row['action_status']== 4){
        					echo"<td></td>";
                                }else { 
                             echo" <td><input type='checkbox' class='checkboxes' 
                             			id='Mulcheck".$i."'
                                 onclick='mulCheck('Mulcheck".$i."');' value=".$row['markPastId']." />
                                </td>";
                                } ;
                              echo "<td>
                                 ".$row['CreatedOn']."
                              </td>";
                              echo"<td >
                                   ". $data1['EMP_NAME']."
                                </td>";
                             echo"<td class='center'>".
                                  $row['date_from']." to ".$row['date_to']."
                                </td>
                                <td>";
                                     while($resData=$fetch($resWork)){
                                        if($row['notMarkingReason'] === $resData['LOV_Value']){
                                            echo $resData['LOV_Text']; break;
                                        }
                                    }
                               echo "</td>

                                <td>";
                               
                            if($row['action_status'] == "1"){?>
                            <a class='myod' data-toggle='modal' href='#large' 
                                onclick="getmypastId('<?php echo $row['markPastId'];?>','1','<?php echo $loginUser;?>');">
                                    <span class='label  bg-blue-steel'>
                                    Pending </span>
                                </a> <?php   
                                }else if($row['action_status'] == "2") {?>
                                 <a class='myod' data-toggle='modal' href='#large'
                                    onclick="getmypastId('<?php echo $row['markPastId']?>','2','<?php echo $loginUser;?>');">
                                    <span class='label  label-success'>
                                   Approved
                                     </span>
                                 </a><?php 
                                } else if($row['action_status'] == "3") {?>
                                <a class='myod' data-toggle='modal' href='#large'
                                    onclick="getmypastId('<?php echo $row['markPastId'];?>','3','<?php echo $loginUser;?>');">
                                    <span class='label  label-danger'>
                                   Rejected
                                 </span>
                                 </a><?php
                                } else if($row['action_status'] == "4") {?>
                                <a class='myod' data-toggle='modal' href='#large'
                                    onclick="getmypastId('<?php echo $row['markPastId'];?>','4',
                                        '<?php echo $loginUser;?>');">
                                    <span class='label bg-grey-cascade'>
                                   Cancelled
                                 </span>
                                 </a><?php
                                }?>
                             <?php           
                             echo"</td>
                             
                            </tr> ";
                            $i++;
    }
  
}

else if ($_POST['type'] == "searchMyStatus") {
 

  $statusid= $_POST['statusid'];
  $userCode=$_POST['code'];
   $sql="select *,CONVERT (VARCHAR(10),date_from,103 ) as date_from , CONVERT (VARCHAR(10),date_to,103 ) as date_to,CONVERT (VARCHAR(24),CreatedOn,109 ) as CreatedOn from  markPastAttendance where action_status='$statusid' and CreatedBy='$userCode'";
    $res=query($query,$sql,$pa,$opt,$ms_db);
    while($row= $fetch($res)){
      $usercode=$row['approvedBy'];
        $sql1="select EMP_NAME from HrdMastQry WHERE Emp_Code='$usercode'";
        $res1=query($query,$sql1,$pa,$opt,$ms_db);
        $data1=$fetch($res1);

        $sqlWork="select * from LOVMast where LOV_Field='reasonForNotMarking'";
        $resWork=query($query,$sqlWork,$pa,$opt,$ms_db);
        $resData=$fetch($resWork);// Not Marking Reason Query

       $i=0;
      echo "<tr>
            <td>
               ".$row['CreatedOn']."
            </td>
            <td>
              ". $data1['EMP_NAME']."              
          </td>
          <td>
             ".$row['date_from']." to ".$row['date_to']."
          </td>
          <td>";
               while($resData=$fetch($resWork)){
                    if($row['notMarkingReason'] === $resData['LOV_Value']){
                        echo $resData['LOV_Text']; break;
                    }
                }
      echo" </td>
          <td>";
            if($row['action_status'] == "1" || $row['action_status'] == ""){?>
             <a class='myod' data-toggle='modal' href='#large' 
              onclick="getmypastId('<?php echo $row['markPastId'];?>','1','<?php echo $userCode;?>')">
                <span class='label bg-blue-steel'>
                Pending </span>
              </a> <?php 
            } else if($row['action_status'] == "2") {?>
                <a class='myod' data-toggle='modal' href='#large'
                              onclick="getmypastId('<?php echo $row['markPastId'];?>','2','<?php echo $userCode;?>')">
                                <span class='label label-success'>
                               Approved
                 </span>
               </a><?php
               } else if($row['action_status'] == "3") {?>
                   <a class='myod' data-toggle='modal' href='#large'
                              onclick="getmypastId('<?php echo $row['markPastId'];?>','3','<?php echo $userCode;?>')">
                                <span class='label label-danger'>
                               Rejected
               </span>
               </a><?php
                 } else if($row['action_status'] == "4") {?>
                    <a class='myod' data-toggle='modal' href='#large'
                              onclick="getmypastId('<?php echo $row['markPastId'];?>','4','<?php echo $userCode;?>')">
                                <span class='label bg-grey-cascade'>
                               Cancelled
               </span>
               </a><?php 
               } else if($row['action_status'] == "5") {?>
                    <a class='myod' data-toggle='modal' href='#large'
                              onclick="getmypastId('<?php echo $row['markPastId'];?>','5','<?php echo $userCode;?>')">
                                <span class='label  bg-blue-steel'>
                               Cancelled Request Pending
               </span>
               </a>
               <?php }
                            
         echo " </td>

        </tr>";
                            $i++;
    } 
}


else if ($_POST['type'] == "searchName") {

	$empidName= $_POST['codename'];
	$userCode=$_POST['code'];
	  $sql="select *,CONVERT (VARCHAR(10),date_from,103 ) as date_from , CONVERT (VARCHAR(10),date_to,103 ) as date_to,CONVERT (VARCHAR(25),CreatedOn,109 ) as CreatedOn from  markPastAttendance where CreatedBy ='$empidName' And approvedBy='$userCode' and flag='1'";
    $res=query($query,$sql,$pa,$opt,$ms_db);
    while($row= $fetch($res)){
    	$usercode=$row['CreatedBy'];
        $sql1="select EMP_NAME from HrdMastQry WHERE Emp_Code='$usercode'";
        $res1=query($query,$sql1,$pa,$opt,$ms_db);
        $data1=$fetch($res1);

        $sqlWork="select * from LOVMast where LOV_Field='reasonForNotMarking'";
        $resWork=query($query,$sqlWork,$pa,$opt,$ms_db);
        $resData=$fetch($resWork);// Not Marking Reason Query

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
                              echo"
                                <td >
                                   ". $row['CreatedOn']."
                                </td>
                                <td >
                                   ". $data1['EMP_NAME']."
                                </td>";
                             echo"<td class='center'>".
                                  $row['date_from']." to ".$row['date_to']."
                                </td>
                                <td>";
                                     while($resData=$fetch($resWork)){
                                        if($row['notMarkingReason'] === $resData['LOV_Value']){
                                            echo $resData['LOV_Text']; break;
                                        }
                                    }
                             echo "</td>

                                <td>"; 
                                if($row['action_status'] == "1" || $row['action_status'] == ""){?>
             <a class='myod' data-toggle='modal' href='#large' 
              onclick="getmypastId('<?php echo $row['markPastId'];?>','1','<?php echo $userCode;?>')">
                <span class='label bg-blue-steel'>
                Pending </span>
              </a> <?php 
            } else if($row['action_status'] == "2") {?>
                <a class='myod' data-toggle='modal' href='#large'
                              onclick="getmypastId('<?php echo $row['markPastId'];?>','2','<?php echo $userCode;?>')">
                                <span class='label label-success'>
                               Approved
                 </span>
               </a><?php
               } else if($row['action_status'] == "3") {?>
                   <a class='myod' data-toggle='modal' href='#large'
                              onclick="getmypastId('<?php echo $row['markPastId'];?>','3','<?php echo $userCode;?>')">
                                <span class='label label-danger'>
                               Rejected
               </span>
               </a><?php
                 } else if($row['action_status'] == "4") {?>
                    <a class='myod' data-toggle='modal' href='#large'
                              onclick="getmypastId('<?php echo $row['markPastId'];?>','4','<?php echo $userCode;?>')">
                                <span class='label bg-grey-cascade'>
                               Cancelled
               </span>
               </a><?php 
               } else if($row['action_status'] == "5") {?>
                    <a class='myod' data-toggle='modal' href='#large'
                              onclick="getmypastId('<?php echo $row['markPastId'];?>','5','<?php echo $userCode;?>')">
                                <span class='label  bg-blue-steel'>
                               Cancelled Request Pending
               </span>
               </a>
               <?php }
                               echo"</td>

                                <td></td>
                            </tr> ";
                            $i++;
    }
}

else if ($_POST['type'] == "searchMyName") {

  $codename= $_POST['codename'];
  $userCode=$_POST['code'];
   $sql="select *,CONVERT (VARCHAR(10),date_from,103 ) as date_from , CONVERT (VARCHAR(10),date_to,103 ) as date_to,CONVERT (VARCHAR(24),CreatedOn,109) as CreatedOn from  markPastAttendance where approvedBy='$codename' and CreatedBy='$userCode' and flag='1'";
    $res=query($query,$sql,$pa,$opt,$ms_db);
    while($row= $fetch($res)){
      $usercode=$row['approvedBy'];
        $sql1="select EMP_NAME from HrdMastQry WHERE Emp_Code='$usercode'";
        $res1=query($query,$sql1,$pa,$opt,$ms_db);
        $data1=$fetch($res1);

        $sqlWork="select * from LOVMast where LOV_Field='reasonForNotMarking'";
        $resWork=query($query,$sqlWork,$pa,$opt,$ms_db);
        $resData=$fetch($resWork);// Not Marking Reason Query

       $i=0;
      echo "<tr>
            <td>
              ".$row['CreatedOn']."
            </td>
            <td>
              ". $data1['EMP_NAME']."              
          </td>
          <td>
             ".$row['date_from']." to ".$row['date_to']."
          </td>
          <td>";
            while($resData=$fetch($resWork)){
                if($row['notMarkingReason'] === $resData['LOV_Value']){
                    echo $resData['LOV_Text']; break;
                }
            }
        echo" </td>
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
            $sql="select *,convert(varchar(10),date_from,103)as date_from, convert(varchar(10),date_to,103)as date_to,convert(varchar(24),CreatedOn,109)as CreatedOn from markPastAttendance where CreatedBy='$loginUser'";
        } 
       elseif ($fromDate=="") {
            $sql="select *,convert(varchar(10),date_from,103)as date_from, convert(varchar(10),date_to,103)as date_to,convert(varchar(24),CreatedOn,109)as CreatedOn from markPastAttendance where CreatedBy='$loginUser'and date_to='$toDate'";
        }elseif($toDate==""){
        $sql="select *,convert(varchar(10),date_from,103)as date_from, convert(varchar(10),date_to,103)as date_to,convert(varchar(24),CreatedOn,109)as CreatedOn from markPastAttendance where CreatedBy='$loginUser'and date_from='$fromDate'";
        }
        else{
            $sql="select *,convert(varchar(10),date_from,103)as date_from, convert(varchar(10),date_to,103)as date_to,convert(varchar(24),CreatedOn,109)as CreatedOn from markPastAttendance where CreatedBy='$loginUser'and date_from='$fromDate' and date_to='$toDate'";
        }

    $res=query($query,$sql,$pa,$opt,$ms_db);
    while($row= $fetch($res)){
    	$usercode=$row['approvedBy'];
        $sql1="select EMP_NAME from HrdMastQry WHERE Emp_Code='$usercode'";
        $res1=query($query,$sql1,$pa,$opt,$ms_db);
        $data1=$fetch($res1);

        $sqlWork="select * from LOVMast where LOV_Field='reasonForNotMarking'";
        $resWork=query($query,$sqlWork,$pa,$opt,$ms_db);
        $resData=$fetch($resWork);// Not Marking Reason Query

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

                              echo"
                              <td >
                                   ". $row['CreatedOn']."
                                </td>
                              <td >
                                   ". $data1['EMP_NAME']."
                                </td>";
                             echo"<td class='center'>".
                                  $row['date_from']." to ".$row['date_to']."
                                </td>
                                <td>";
                                      while($resData=$fetch($resWork)){
                                        if($row['notMarkingReason'] === $resData['LOV_Value']){
                                            echo $resData['LOV_Text']; break;
                                        }
                                    }
                            echo" </td>

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
                                   } else if($row['action_status'] == "5") {?>
                                  <a class='myod' data-toggle='modal' href='#large'
                                  onclick="getmypastId('<?php echo $row['markPastId'];?>','5','<?php echo $userCode;?>')">
                                    <span class='label  bg-blue-steel'>
                                   Cancelled Request Pending
                                   </span>
                                   </a>
                               <?php }
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
            $sql="select *,convert(varchar(10),date_from,103)as date_from, convert(varchar(10),date_to,103)as date_to,convert(varchar(24),CreatedOn,109)as CreatedOn from markPastAttendance where CreatedBy='$loginUser'";
        } 
       elseif ($fromDate=="") {
            $sql="select *,convert(varchar(10),date_from,103)as date_from, convert(varchar(10),date_to,103)as date_to,convert(varchar(24),CreatedOn,109)as CreatedOn from markPastAttendance where CreatedBy='$loginUser'and date_to='$toDate'";
        }elseif($toDate==""){
         $sql="select *,convert(varchar(10),date_from,103)as date_from, convert(varchar(10),date_to,103)as date_to,convert(varchar(24),CreatedOn,109)as CreatedOn from markPastAttendance where CreatedBy='$loginUser'and date_from='$fromDate'";
        }
        else{
            $sql="select *,convert(varchar(10),date_from,103)as date_from, convert(varchar(10),date_to,103)as date_to,convert(varchar(24),CreatedOn,109)as CreatedOn from markPastAttendance where CreatedBy='$loginUser'and date_from='$fromDate' and date_to='$toDate'";
        }

    $res=query($query,$sql,$pa,$opt,$ms_db);
    while($row= $fetch($res)){
      $usercode=$row['approvedBy'];
        $sql1="select EMP_NAME from HrdMastQry WHERE Emp_Code='$usercode'";
        $res1=query($query,$sql1,$pa,$opt,$ms_db);
        $data1=$fetch($res1);

        $sqlWork="select * from LOVMast where LOV_Field='reasonForNotMarking'";
        $resWork=query($query,$sqlWork,$pa,$opt,$ms_db);
        $resData=$fetch($resWork);// Not Marking Reason Query

       $i=0;
            echo "<tr>
                        <td>
                         ".$row['CreatedOn']."
                        </td>
                             <td >
                                   ". $data1['EMP_NAME']."
                             </td>
                             <td class='center'>"
                              .$row['date_from']." to ".$row['date_to']."
                                </td>
                                <td>";
                                    while($resData=$fetch($resWork)){
                                        if($row['notMarkingReason'] === $resData['LOV_Value']){
                                            echo $resData['LOV_Text']; break;
                                        }
                                    }
                            echo "</td>

                                <td>";
                                 if($row['action_status'] == "1" || $row['action_status'] == ""){?>
                                 <a class='myod' data-toggle='modal' href='#large' 
                                  onclick="getmypastId('<?php echo $row['markPastId'];?>','1','<?php echo $loginUser;?>')">
                                    <span class='label bg-blue-steel'>
                                    Pending </span>
                                  </a> <?php 
                                } else if($row['action_status'] == "2") {?>
                                    <a class='myod' data-toggle='modal' href='#large'
                                                  onclick="getmypastId('<?php echo $row['markPastId'];?>','2','<?php echo $loginUser;?>')">
                                                    <span class='label label-success'>
                                                   Approved
                                     </span>
                                   </a><?php
                                   } else if($row['action_status'] == "3") {?>
                                       <a class='myod' data-toggle='modal' href='#large'
                                                  onclick="getmypastId('<?php echo $row['markPastId'];?>','3','<?php echo $loginUser;?>')">
                                                    <span class='label label-danger'>
                                                   Rejected
                                   </span>
                                   </a><?php
                                     } else if($row['action_status'] == "4") {?>
                                        <a class='myod' data-toggle='modal' href='#large'
                                                  onclick="getmypastId('<?php echo $row['markPastId'];?>','4','<?php echo $loginUser;?>')">
                                                    <span class='label bg-grey-cascade'>
                                                   Cancelled
                                   </span>
                                   </a><?php
                                   } else if($row['action_status'] == "5") {?>
                                  <a class='myod' data-toggle='modal' href='#large'
                                  onclick="getmypastId('<?php echo $row['markPastId'];?>','5','<?php echo $userCode;?>')">
                                    <span class='label  bg-blue-steel'>
                                   Cancelled Request Pending
                                   </span>
                                   </a>
                               <?php }
                               echo"</td>
                            </tr> ";
                            $i++;
    }
}


else if($_POST['type'] == "myMainContent"){

    $loginUser = $_POST['userCode'];
    $sql="select *,CONVERT (VARCHAR(10),date_from,103 ) as date_from , CONVERT (VARCHAR(10),date_to,103 ) as date_to,CONVERT (VARCHAR(35),CreatedOn,109 ) as CreatedOn from markPastAttendance WHERE CreatedBy='$loginUser' and flag='1'";
    $res=query($query,$sql,$pa,$opt,$ms_db);
    if($res){               
                $i=0;
                while($row=$fetch($res)){
                    
                    $mngrcode=$row['approvedBy'];
                    $sql1="select EMP_NAME from HrdMastQry WHERE Emp_Code='$mngrcode'";
                    $res1=query($query,$sql1,$pa,$opt,$ms_db);
                    $data1=$fetch($res1);

                 echo" <tr>";
                             
                        echo" 
                             <td>
                                ".$row['CreatedOn']."  
                             </td>

                             <td>
                                ".$data1['EMP_NAME']."  
                            </td>
                            <td>
                                  ".$row['date_from']." to ".$row['date_to']."
                            </td>
                            <td>";
                              if($row['notMarkingReason'] == "forgot"){
                                        echo "Forgot to punch/mark attendance";
                                    }else if($row['notMarkingReason'] == "machine_not_work"){
                                        echo "Machine is not working ";
                                    }else{
                                        echo "Others";
                                    }

                           echo "</td>
                            
                            <td>";
                            if($row['action_status'] == "1"){?>
                            <a class='myod' data-toggle='modal' href='#large' 
                                onclick="getmypastId('<?php echo $row['markPastId'];?>','1','<?php echo $loginUser;?>');">
                                    <span class='label  bg-blue-steel'>
                                    Pending </span>
                                </a> <?php   
                                }else if($row['action_status'] == "2") {?>
                                 <a class='myod' data-toggle='modal' href='#large'
                                    onclick="getmypastId('<?php echo $row['markPastId']?>','2','<?php echo $loginUser;?>');">
                                    <span class='label  label-success'>
                                   Approved
                                     </span>
                                 </a><?php 
                                } else if($row['action_status'] == "3") {?>
                                <a class='myod' data-toggle='modal' href='#large'
                                    onclick="getmypastId('<?php echo $row['markPastId'];?>','3','<?php echo $loginUser;?>');">
                                    <span class='label  label-danger'>
                                   Rejected
                                 </span>
                                 </a><?php
                                } else if($row['action_status'] == "4") {?>
                                <a class='myod' data-toggle='modal' href='#large'
                                    onclick="getmypastId('<?php echo $row['markPastId'];?>','4',
                                        '<?php echo $loginUser;?>');">
                                    <span class='label bg-grey-cascade'>
                                   Cancelled
                                 </span>
                                 </a><?php
                                } else if($row['action_status'] == "5") {?>
                                <a class='myod' data-toggle='modal' href='#large'
                                    onclick="getmypastId('<?php echo $row['markPastId'];?>','4',
                                        '<?php echo $loginUser;?>');">
                                    <span class='label bg-blue-steel'>
                                   Cancellation Request Pending
                                 </span>
                                 </a> 
                                 <?php }?>
                             <?php           
                             echo"</td>
                              
                            </tr>";
                            $i++;
                }
            }

}


else if ($_POST['type'] == "time") {

    $fordate=$_POST['fromDate'];
    $code=$_POST['code'];
    $dateval=explode('/',$fordate);
    $new_date=$dateval[2].'-'.$dateval[1].'-'.$dateval[0];
    @$weeklyoff = getWeeklyOff($dateval[1],$dateval[2],$code);
    @$public_holidays= getHolidays($dateval[1],$dateval[2]);
    $dayType="";

    if (in_array(array('start' => $new_date),$weeklyoff))
    {
      $dayType="Weekly Off";
    }
   else if (in_array(array('start' => $new_date),$public_holidays))
    {
      $dayType="Public Holidays";
    }
    else{
      $dayType="Working day";
    }


    echo "<table width='100%' cellpadding='0' cellspacing='2' border='0' id='detailtable'>
            <tbody><tr>
                <th style='text-align:left'>Day Type</th>
                <th style='text-align:left'>Planned In Time</th>
                <th style='text-align:left'>Planned Out Time</th>
                <th style='text-align:left'>Actual In Time</th>
                <th style='text-align:left''>Actual Out Time </th>
            </tr>";
       

     $sql="select CONVERT(VARCHAR(8), Shift_From, 24) AS sIn , CONVERT(VARCHAR(8), Shift_To, 24) AS sOut,EMP_CODE from RosterQry
      where EMP_CODE='$code' and (cast(rosterstart as date) <= '$new_date' and cast(rosterend as date) >= '$new_date')";
    
      $sql1="select convert(varchar(5),b.IN_TIME,108) as IN_TIME,CONVERT(varchar(5),b.OUT_TIME,108) as OUT_TIME from
 CAttendanceqry b where EMP_CODE='$code' and ATTDATE='$new_date'";
      $res=query($query,$sql,$pa,$opt,$ms_db);
    $res1=query($query,$sql1,$pa,$opt,$ms_db);
      $row= $fetch($res);
    $row1= $fetch($res1);
        echo "<tr>
            <td>";
        echo $dayType;
        echo  "</td>
            <td>";
        echo timeFormat($row['sIn']); 
        echo  "</td>
             <td>";
        echo timeFormat($row['sOut']);
        echo  "</td>
            <td>";
        echo timeFormat($row1['IN_TIME']);
        echo  "</td>
         <td>";
        echo timeFormat($row1['OUT_TIME']);
        echo  "</td>
        </tr>";

}
?>