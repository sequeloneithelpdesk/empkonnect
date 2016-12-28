<?php
include '../../db_conn.php';
include ('../../configdata.php');

if($_POST['type'] == "CheckODLeaveRequest")
{
    $userSelectedDate = date("Ydm", strtotime($_POST['fromDate']));
    $userID = $_POST['userid'];
    $isRequestQuery = "SELECT count(*) FROM leave WHERE (convert(varchar, LvFrom, 112) >= '".$userSelectedDate."' And convert(varchar, LvTo, 112) <= '".$userSelectedDate."') AND CreatedBy = '".$userID."' AND  status IN ('1','2')";
    $result_request = query($query,$isRequestQuery,$pa,$opt,$ms_db);
    if($num($result_request) > 0) {
        $resData=$fetch($result_request);
        echo $resData[0];
    }else
    {
        echo '0';
    }
}
if($_POST['type']=="outOnWork")
{
    $key = md5(uniqid(rand(), true));

    $fromDate= rtrim(dateConversion($_POST['fromDate']),' 00:00:00');
    $natureofwork= $_POST['natureofwork'];
    $reason = ucwords(strtolower($_POST['reason']));
    //$reason = ucwords($_POST['reason']);
    $natureofworkcause = $_POST['natureofworkcause'];
    $intime = $_POST['inHour'].':'.$_POST['inMinute'].':'.$_POST['inap'];    
    $outtime = $_POST['outHour'].':'.$_POST['outMinute'].':'.$_POST['outap'];
    $userid = $_POST['userid'];
    $approverId = explode(",", $_POST['approverId']);
    //$mngrcode1=$_POST['mngrcode1'];
    #Query for get detail of roster
   
    $currentDate = date('Y-m-d');
    $rosterDeatil = "SELECT ShiftPatternMastID, Shift_Name, CONVERT(char(10), [Shift_From], 108) Shift_From, CONVERT(char(10), [Shift_To], 108) Shift_To, CONVERT(VARCHAR(12), cast(rosterstart as date), 101) attfrom, CONVERT(VARCHAR(12),cast(rosterend as date), 101) attto 
    , CONVERT(char(10), [Shift_MFrom], 108) Shift_MFrom, CONVERT(char(10), [Shift_MTO], 108) Shift_MTO, RCLOCK FROM Rosterqry 
    WHERE EMP_CODE='".$userid."'  
    AND (cast(RosterStart as date)> = '".$currentDate."' Or cast(RosterEnd as date) >= '".$currentDate."')
    ORDER BY rosterstart ASC";

    $result_rosterDeatil = query($query,$rosterDeatil,$pa,$opt,$ms_db);
    $dataRoserDetail = ($num($result_rosterDeatil) > 0) ? extract($fetch($result_rosterDeatil)) : "";

    #User selected date and time in 24 hours
    $inDateTime24HoursClean = date("Y-m-d H:i:s", strtotime($fromDate." ".$_POST['inHour'].':'.$_POST['inMinute'].' '.$_POST['inap']));
    $inDateClean = date("Y-m-d", strtotime($fromDate));
    $inIime24FormatClean = date("H:i:s", strtotime($_POST['inHour'].':'.$_POST['inMinute'].' '.$_POST['inap']));

    $outDateTime24HoursClean = date("Y-m-d H:i:s", strtotime($fromDate." ".$_POST['outHour'].':'.$_POST['outMinute'].' '.$_POST['outap']));
    $outDateClean = date("Y-m-d", strtotime($fromDate));
    $outTime24FormatClean = date("H:i:s", strtotime($_POST['outHour'].':'.$_POST['outMinute'].' '.$_POST['outap']));

    #convert user selected date and time into unixtimestamp
    $inDateTime24HoursTimeStamp = (!empty($inDateTime24HoursClean))? strtotime($inDateTime24HoursClean) : '';
    $inDate24HoursTimeStamp = (!empty($inDateClean))? strtotime($inDateClean) : '';
    $inTime24HoursTimeStamp = (!empty($inIime24FormatClean))? strtotime($inIime24FormatClean) : '';

    $outDateTime24HoursTimeStamp = (!empty($outDateTime24HoursClean))? strtotime($outDateTime24HoursClean) : '';
    $outDate24HoursTimeStamp = (!empty($outDateClean))? strtotime($outDateClean) : '';
    $outTime24HoursTimeStamp = (!empty($outTime24FormatClean))? strtotime($outTime24FormatClean) : '';

    #Shift hours date and time in 24 hours 
    $shiftStartDateTime = (isset($attfrom) && !empty($attfrom)) ? strtotime(date('Y-m-d H:i:s', strtotime($attfrom. ' '. $Shift_MFrom))):'';
    $shiftStartDate = (isset($attfrom) && !empty($attfrom)) ? strtotime(date('Y-m-d', strtotime($attfrom))):'';
    $shiftStartTime = (isset($attfrom) && !empty($attfrom)) ? strtotime(date('H:i:s', strtotime($Shift_MFrom))):'';

    $shiftEndDateTime = (isset($attto) && !empty($attto)) ? strtotime(date('Y-m-d H:i:s', strtotime($attto. ' '. $Shift_MTO))):'';
    $shiftEndDate = (isset($attto) && !empty($attto)) ? strtotime(date('Y-m-d', strtotime($attto))):'';
    $shiftEndTime = (isset($attto) && !empty($attto)) ? strtotime(date('H:i:s', strtotime($Shift_MTO))):'';

    $time_error = '';
    switch ($natureofworkcause) {
        case 'early_out':
            if(($inDate24HoursTimeStamp < $shiftStartDate || $outDate24HoursTimeStamp > $shiftEndDate) || ($outTime24HoursTimeStamp > $shiftEndTime))
            #echo $error = "OD Request date must be between ".date('Y-m-d H:i:s', strtotime($shiftStartDateTime)). ' to '.date('Y-m-d H:i:s', strtotime($shiftEndDateTime));
            $time_error = 3;
            break;

        case 'late_in_early_out':
            if(($inDate24HoursTimeStamp < $shiftStartDate || $outDate24HoursTimeStamp > $shiftEndDate) || ($inTime24HoursTimeStamp < $shiftStartTime || $outTime24HoursTimeStamp > $shiftEndTime))
            $time_error = 3;
            #echo $error = "OD Request date must be between ".date('Y-m-d H:i:s', strtotime($shiftStartDateTime)). ' to '.date('Y-m-d H:i:s', strtotime($shiftEndDateTime));
            break;

        case 'whole_day_out':
            if($inDate24HoursTimeStamp < $shiftStartDate || $outDate24HoursTimeStamp > $shiftEndDate)
            $time_error = 3;
            #echo $error = "OD Request date must be between ".date('Y-m-d H:i:s', strtotime($shiftStartDateTime)). ' to '.date('Y-m-d H:i:s', strtotime($shiftEndDateTime));
            break;

        case 'wiil_be_late':
            if(($inDate24HoursTimeStamp < $shiftStartDate || $outDate24HoursTimeStamp > $shiftEndDate) || ($inTime24HoursTimeStamp > $shiftEndTime))
            $time_error = 3;
            #echo $error = "OD Request date must be between ".date('Y-m-d H:i:s', strtotime($shiftStartDateTime)). ' to '.date('Y-m-d H:i:s', strtotime($shiftEndDateTime));
            break;
    }

    if($time_error == 3){
        echo 3; exit();
    }
    if($_POST['toDate']){
        $toDate= dateConversion($_POST['toDate']);
         $toDateEmail=$_POST['toDate'];
    }else{
        $toDate=$fromDate;
        $toDateEmail=$_POST['fromDate'];
    }

    if($_POST['weeklyoff']){
        $weeklyoff=$_POST['weeklyoff'];
    }else{
        $weeklyoff="";
    }

    if($_POST['leavedays']){
        $leavedays= $_POST['leavedays'];
    }else{
        $leavedays="";
    }

    /*---------------Email Subject ----------*/
        $sqlWork="select * from LOVMast  where LOV_Field='natureOfWork'";
        $resWork=query($query,$sqlWork,$pa,$opt,$ms_db);
        $resData=$fetch($resWork);

         while($resData=$fetch($resWork)){
            if($natureofwork === $resData['LOV_Value']){
                $Emailsubject= $resData['LOV_Text'];
                break;
            }
         }

    /*---------------Email Subject ----------*/

     $checksql="select count(outWorkId) as num from outOnWorkRequest where ((date_from <= '$fromDate' and date_to >='$toDate') or  (date_to >= '$toDate' and date_from <= '$fromDate'  ) or (date_from between '$fromDate' and '$toDate') ) and action_status !='4' ";
    $checkRes= query($query,$checksql,$pa,$opt,$ms_db);
    $numAtten= $fetch($checkRes);
    if($numAtten['num'] >= 1){
        echo 2;
    }else{
            $level=$_POST['level'];
            $lev = explode(',',$level);

            for($i=0;$i<count($lev);$i++){
                if($i==0){
                    $flag= '1';
                }
                else{
                    $flag= '0';
                }

                $sql="insert into outOnWorkRequest (date_from, date_to, natureOfWorkCause,natureOfWork,excludeWeeklyOff,excludeLeaveDays,reason,CreatedOn,CreatedBy,approvedBy,intime,outtime,action_status,oDKey,flag) VALUES 
                      ('$fromDate','$toDate','$natureofworkcause','$natureofwork','$weeklyoff','$leavedays','$reason',getdate(),'$userid','$approverId[$i]','$intime','$outtime','1','$key','$flag')";
                $result = query($query,$sql,$pa,$opt,$ms_db);

                if($result){
                            if($flag == 1){
                                $queMail= "Select Emp_Name,OEMailID from HrdMastQry where Emp_Code ='$approverId[$i]'";
                                $resMail= query($query,$queMail,$pa,$opt,$ms_db);
                                $appMail=$fetch($resMail);

                                $requesterSql="Select Emp_Name,Emp_Code from HrdMastQry where Emp_Code ='$userid'";
                                $requesterRes = query($query,$requesterSql,$pa,$opt,$ms_db);
                                $requesterRow= $fetch($requesterRes);

                                $to=trim($appMail['OEMailID']);
                                
                                $subject= "Out On Duty Request-".$Emailsubject;
                                $message="Dear ".$appMail[0].",<br><br>";
                                $message.="You are requested to approve out on duty request from ".$_POST['fromDate']." to ".$toDateEmail." due to ";
                                $message.=$reason. ".<br><br><br>";
                                $message.="Regards,<br>";
                                $message.=$requesterRow[0]. "-";
                                $message.=$requesterRow[1];

                                $mail1=mymailer('donotreply@sequelone.com',$subject,$message,$to);
                    
                            }
                 }else{
                        echo 0;
                      }
             }
            echo 1;
        }
}

else if($_POST['type']=="pastAttendance"){

    $key = md5(uniqid(rand(), true));

    $fromDate= dateConversion($_POST['fromDate']);
    $notMarkingReas= $_POST['notMarkingReas'];
    $remarks = $_POST['remarks'];
    $intime=$_POST['inHour'].':'.$_POST['inMinute'].$_POST['inap'];
    $outtime=$_POST['outHour'].':'.$_POST['outMinute'].$_POST['outap'];
    $userid=$_POST['userid'];
    
    $approverId=explode(",", $_POST['approverId']);

    if($_POST['toDate']){
        $toDate= dateConversion($_POST['toDate']);
        $EmailtoDate=$_POST['fromDate'];
    }else{
        $toDate=$fromDate;
        $EmailtoDate=$_POST['fromDate'];
    }

    if($_POST['inDate']){
        $inDate=dateConversion($_POST['inDate']);
    }else{
        $inDate="";
    }

    if($_POST['outDate']){
        $outDate=dateConversion($_POST['outDate']);
    }else{
        $outDate="";
    }
    $PasSubject="";
  
    $checksql="select * from markPastAttendance where (date_from='$fromDate' or date_to='$toDate') and CreatedBy='$userid' and action_status !='4' ";
    $checkRes= query($query,$checksql,$pa,$opt,$ms_db);
    $numAtten= $num($checkRes);
    if($numAtten >= 1){
        echo 2;
    }else{

          /*------------Email----------*/
            $sqlPasEmailSub="Select * from LOVMast Where LOV_Field='reasonForNotMarking' ";
            $re123 = query($query,$sqlPasEmailSub,$pa,$opt,$ms_db);

             while($pas123 = $fetch($re123)) {  
                if($notMarkingReas == $pas123['LOV_Value']){
                   $PasSubject = $pas123['LOV_Text'];   
                   //echo $PasSubject; 
                   goto end;
                } 
             }
             end:

             /*------------Email End----------*/ 

            $level=$_POST['level'];
            $lev = explode(',',$level);

            for($i=0;$i<count($lev);$i++){
                if($i==0){
                    $flag= '1';
                }
                else{
                    $flag= '0';
                }

               $sql="insert into markPastAttendance (date_from, date_to,inDate,outDate, notMarkingReason,remarks,intime,outtime,CreatedOn,CreatedBy,approvedBy,action_status,AttnKey,flag) VALUES 
                ('$fromDate','$toDate','$inDate','$outDate','$notMarkingReas','$remarks','$intime','$outtime',getdate(),'$userid','$approverId[$i]','1','$key','$flag')";
                 $result = query($query,$sql,$pa,$opt,$ms_db);
                 $result = query($query,$sql,$pa,$opt,$ms_db);
                 if($result){
                    
                    if($flag == 1){
                        $queMail= "Select Emp_Name,OEMailID from HrdMastQry where Emp_Code ='$approverId[$i]'";
                        $resMail= query($query,$queMail,$pa,$opt,$ms_db);
                        $appMail=$fetch($resMail);

                        $requesterSql="Select Emp_Name,Emp_Code from HrdMastQry where Emp_Code ='$userid'";
                        $requesterRes = query($query,$requesterSql,$pa,$opt,$ms_db);
                        $requesterRow= $fetch($requesterRes);

                        $to=trim($appMail['OEMailID']);
                        
                        $subject= "Past Attendance Request-".$PasSubject;
                        $message="Dear ".$appMail[0].",<br><br>";
                        $message.="You are requested to approve past attendance request from ".$_POST['fromDate']." to ".$EmailtoDate." due to ";
                        $message.=$PasSubject. ".<br><br><br>";
                        $message.="Regards,<br>";
                         $message.=$requesterRow[0]. "-";
                         $message.=$requesterRow[1];
                        
                        $mail1=mymailer('donotreply@sequelone.com',$subject,$message,$to);
                    }
                }else{
                    echo 0;
                }    
            }
            echo 1;
       
        }


   
}

else if($_POST['type']=="allcheck"){

    $userCode=$_POST['userCode'];
    $status=$_POST['status'];
    
    $sql="select outWorkId from outOnWorkRequest  WHERE approvedBy='$userCode' and(action_status = '$status' or action_status = '5') and flag='1'";
    $res=query($query,$sql,$pa,$opt,$ms_db);
    $count = $num($res);
    if($count == 1){
        $row=$fetch($res);
       echo $row['outWorkId'];
   }else{
    while ($row=$fetch($res)) {
         echo $row['outWorkId'].",";
    }
   }
    
}

else if($_POST['type']=="mulcheck"){

    $userCode=$_POST['userCode'];
    $inputval=$_POST['inputval'];
    $status=$_POST['status'];
    $action_remark=ucwords(strtolower($_POST['remark']));
    
    /*--------For Getting Nature of Work------*/
     $sqlWork2="select * from LOVMast  where LOV_Field='natureOfWork'";
     $resWork2=query($query,$sqlWork2,$pa,$opt,$ms_db);  
    /*--------For Getting Nature of Work------*/

    $sql1="select *,CONVERT(varchar(10), date_from, 103) as date_from,CONVERT(varchar(10), date_to, 103) as date_to from outOnWorkRequest where outWorkId IN ($inputval)";
    $res1=query($query,$sql1,$pa,$opt,$ms_db);
    if($res1){
        $t=0;
          while ($row1=$fetch($res1)) {

                if($row1['action_status'] == "1"){

                    /*---------------Start Email Subject ----------*/
                    while($resData2=$fetch($resWork2)){  
                    if($row1['natureOfWork'] === $resData2['LOV_Value']){
                        $Emailsubject2= $resData2['LOV_Text'];
                        break;
                        }
                    }
                
                    /*---------------End Email Subject ----------*/

                    if($status == "2"){
                        $approvedRes="Approved";
                    }elseif($status == "3"){
                        $approvedRes="Rejected";
                    }

                    $sql="update outOnWorkRequest set action_status='$status',action_remark='$action_remark',UpdatedOn='getdate()' WHERE approvedBy='$userCode' and outWorkId=".$row1['outWorkId']." and action_status='1'";
                    $res=query($query,$sql,$pa,$opt,$ms_db);



                    $reqMail= "Select OEMailID,EMP_NAME from HrdMastQry where Emp_Code='".$row1['CreatedBy']."'";
                    $reqName= "Select EMP_NAME from HrdMastQry where Emp_Code='".$userCode."'";
                    $resMail= query($query,$reqMail,$pa,$opt,$ms_db);
                    $nameMail= query($query,$reqName,$pa,$opt,$ms_db);

                    $rMail=$fetch($resMail);
                    $name=$fetch($nameMail);

                    
                    $to=trim($rMail['OEMailID']);
                    $subject= "Approved OutOn Duty Request-".$Emailsubject2;
                    $message="Dear ".$rMail['EMP_NAME'].",<br><br>";
                    $message.="Your request of out on duty from  ".$row1['date_from']." to ".$row1['date_to']." for ";
                    $message.=$row1['reason'] ." has been ".$approvedRes.".<br><br><br>";
                    $message.="Regards,<br>".$name['EMP_NAME']."-".$userCode;
                    $var [$t][$userCode.$t.'a']=array(
                                      "id"=>$userCode,
                                      "msg"=>$message,
                                      "email"=>$rMail['OEMailID'],
                                      "subject"=>$subject);
                    
                    $sql2="SELECT TOP 1 *,CONVERT(varchar(10),date_from,103) as date_from,CONVERT(varchar(10),date_to,103) as date_to from outOnWorkRequest  where oDKey ='".$row1['oDKey']."' and flag='0' ORDER BY CreatedOn DESC";
                    $res2=query($query,$sql2,$pa,$opt,$ms_db);

                    if($res2){
                      $row6=$fetch($res2);
                      $sql3="update outOnWorkRequest set flag='1' where outWorkId='".$row6['outWorkId']."'";
                      $res3= query($query,$sql3,$pa,$opt,$ms_db);
                      if($res3){
                        
                        $aprMail= "Select OEMailID,EMP_NAME from HrdMastQry where Emp_Code='".$row6['approvedBy']."'";
                        $res1Mail= query($query,$aprMail,$pa,$opt,$ms_db);
                        $aMail=$fetch($res1Mail);

                        $creaName= "Select EMP_NAME from HrdMastQry where Emp_Code='".$row6['CreatedBy']."'";
                        $creaNameRes= query($query,$creaName,$pa,$opt,$ms_db);
                        $name1=$fetch($creaNameRes);


                        $to2=trim($aMail['OEMailID']);
                        $subject2= "OutOn Duty Request-".$Emailsubject2;
                        $message2="Dear ".$aMail['EMP_NAME'].",<br><br>";
                        $message2.="You are requested to approve out on duty request  from ".$row6['date_from']." to ".$row6['date_to']." due to ";
                        $message2.=$row6['reason'] .".<br><br><br>";
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
                    if($row1['natureOfWork'] === $resData2['LOV_Value']){
                        $Emailsubject2= $resData2['LOV_Text'];
                        break;
                        }
                    }
                
                    /*---------------End Email Subject ----------*/

                    if($status == "2"){
                        $approvedRes="Approved Cancellation Request";
                    }elseif($status == "3"){
                        $approvedRes="Rejected Cancellation Request";
                    }

                    $sql="update outOnWorkRequest set action_status='4',action_remark='$action_remark',UpdatedOn='getdate()' WHERE approvedBy='$userCode' and outWorkId =".$row1['outWorkId']." and action_status='5'";
                    $res=query($query,$sql,$pa,$opt,$ms_db);



                    $reqMail= "Select OEMailID,EMP_NAME from HrdMastQry where Emp_Code='".$row1['CreatedBy']."'";
                    $reqName= "Select EMP_NAME from HrdMastQry where Emp_Code='".$userCode."'";
                    $resMail= query($query,$reqMail,$pa,$opt,$ms_db);
                    $nameMail= query($query,$reqName,$pa,$opt,$ms_db);

                    $rMail=$fetch($resMail);
                    $name=$fetch($nameMail);

                    
                    $to=trim($rMail['OEMailID']);
                    $subject= "Approved CancellationOutOn Duty Request-".$Emailsubject2;
                    $message="Dear ".$rMail['EMP_NAME'].",<br><br>";
                    $message.="Your  Cancellation request of out on duty from  ".$row1['date_from']." to ".$row1['date_to']." for ";
                    $message.=$row1['reason'] ." has been ".$approvedRes.".<br><br><br>";
                    $message.="Regards,<br>".$name['EMP_NAME']."-".$userCode;
                    $var [$t][$userCode.$t.'a']=array(
                                      "id"=>$userCode,
                                      "msg"=>$message,
                                      "email"=>$rMail['OEMailID'],
                                      "subject"=>$subject);
                    
                    $sql2="SELECT TOP 1 *,CONVERT(varchar(10),date_from,103) as date_from,CONVERT(varchar(10),date_to,103) as date_to from outOnWorkRequest  where oDKey ='".$row1['oDKey']."' and flag='1' ORDER BY CreatedOn DESC";
                    $res2=query($query,$sql2,$pa,$opt,$ms_db);

                    if($res2){
                      $row6=$fetch($res2);
                      $sql3="update outOnWorkRequest set flag='1' where outWorkId='".$row6['outWorkId']."'";
                      $res3= query($query,$sql3,$pa,$opt,$ms_db);
                      if($res3){
                        
                        $aprMail= "Select OEMailID,EMP_NAME from HrdMastQry where Emp_Code='".$row6['approvedBy']."'";
                        $res1Mail= query($query,$aprMail,$pa,$opt,$ms_db);
                        $aMail=$fetch($res1Mail);

                        $creaName= "Select EMP_NAME from HrdMastQry where Emp_Code='".$row6['CreatedBy']."'";
                        $creaNameRes= query($query,$creaName,$pa,$opt,$ms_db);
                        $name1=$fetch($creaNameRes);


                        $to2=trim($aMail['OEMailID']);
                        $subject2= "Cancelled - Out on Duty for -".$Emailsubject2;
                        $message2="Dear ".$aMail['EMP_NAME'].",<br><br>";
                        $message2.="Out on duty request has been cancelled from ".$row6['date_from']." to ".$row6['date_to']." due to ";
                        $message2.=$row6['reason'] .".<br><br><br>";
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


        $sqlWork="select * from LOVMast  where LOV_Field='natureOfWork'";
        $resWork=query($query,$sqlWork,$pa,$opt,$ms_db);
        $resData=$fetch($resWork);

        $getSql="select *,CONVERT(varchar(10),date_from,103) as date_from,CONVERT(varchar(10),date_to,103) as date_to from outOnWorkRequest where outWorkId='$id'";
            $getResSql=query($query,$getSql,$pa,$opt,$ms_db);
             
        if($getResSql){
                $t=0;
            while ($valOD=$fetch($getResSql)) {

                if($valOD['action_status'] == "5"){

                    $sql="update outOnWorkRequest set action_status='$status_code',action_remark='$action_remark',UpdatedOn='getdate()' where outWorkId='$id'";
                    $res=query($query,$sql,$pa,$opt,$ms_db);

                        /*---------------Email Subject ----------*/
                        
                         while($resData=$fetch($resWork)){
                            if($valOD['natureOfWork'] === $resData['LOV_Value']){
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
                        $oDkey=$valOD['oDKey'];

                        $to=trim($rMail['OEMailID']);
                        $subject= "Approved CancellationOutOn Duty Request-".$Emailsubject;
                        $message="Dear ".$rMail['EMP_NAME'].",<br><br>";
                        $message.="Your  Cancellation request of out on duty from  ".$valOD['date_from']." to ".$valOD['date_to']." for ";
                        $message.=$valOD['reason'] ." has been ".$approveAction.".<br><br><br>";
                        $message.="Regards,<br>".$name['EMP_NAME']."-".$loginuser;
                        $var [$t][$loginuser.$t.'a']=array(
                             "id"=>$id,
                              "msg"=>$message,
                              "email"=>$rMail['OEMailID'],
                              "subject"=>$subject);

                        $sql3="SELECT TOP 1 *,CONVERT(varchar(10),date_from,103) as date_from,CONVERT(varchar(10),date_to,103) as date_to from outonworkrequest  where oDKey='$oDkey' and flag='0' ORDER BY CreatedOn DESC";
                        $res3=query($query,$sql3,$pa,$opt,$ms_db); 

                        if($res3){
                           $row6=$fetch($res3);
                           $sql4="update outonworkrequest set flag='1' where outWorkId='".$row6['outWorkId']."'";
                           $res4= query($query,$sql4,$pa,$opt,$ms_db);
                           if($res4){

                            $apprMail= "Select OEMailID,EMP_NAME from HrdMastQry where Emp_Code='".$row6['approvedBy']."'";
                            $apprMailRes= query($query,$apprMail,$pa,$opt,$ms_db);
                            $apprMail=$fetch($apprMailRes);

                            $creaName= "Select EMP_NAME from HrdMastQry where Emp_Code='".$row6['CreatedBy']."'";
                            $creaNameRes= query($query,$creaName,$pa,$opt,$ms_db);
                            $name1=$fetch($creaNameRes);

                            $to2=trim($apprMail['OEMailID']);
                            $subject2= "Cancelled - Out on Duty for-".$Emailsubject;
                            $message2="Dear ".$apprMail['EMP_NAME'].",<br><br>";
                            $message2.="Out on duty request has been cancelled from ".$row6['date_from']." to ".$row6['date_to']." due to ";
                            $message2.=$row6['reason'] .".<br><br><br>";
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

                    $sql="update outOnWorkRequest set action_status='$status_code',action_remark='$action_remark',UpdatedOn='getdate()' where outWorkId='$id'";
                    $res=query($query,$sql,$pa,$opt,$ms_db);

                        /*---------------Email Subject ----------*/
                        
                         while($resData=$fetch($resWork)){
                            if($valOD['natureOfWork'] === $resData['LOV_Value']){
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
                        $oDkey=$valOD['oDKey'];

                        $to=trim($rMail['OEMailID']);
                        $subject= "Approved Out On Duty Request-".$Emailsubject;
                        $message="Dear ".$rMail['EMP_NAME'].",<br><br>";
                        $message.="Your request of out on duty from ".$valOD['date_from']." to ".$valOD['date_to']." for ";
                        $message.=$valOD['reason'] ." has been ".$approveAction.".<br><br><br>";
                        $message.="Regards,<br>".$name['EMP_NAME']."-".$loginuser;
                        $var [$t][$loginuser.$t.'a']=array(
                             "id"=>$id,
                              "msg"=>$message,
                              "email"=>$rMail['OEMailID'],
                              "subject"=>$subject);

                        $sql3="SELECT TOP 1 *,CONVERT(varchar(10),date_from,103) as date_from,CONVERT(varchar(10),date_to,103) as date_to from outonworkrequest  where oDKey='$oDkey' and flag='0' ORDER BY CreatedOn DESC";
                        $res3=query($query,$sql3,$pa,$opt,$ms_db); 

                        if($res3){
                           $row6=$fetch($res3);
                           $sql4="update outonworkrequest set flag='1' where outWorkId='".$row6['outWorkId']."'";
                           $res4= query($query,$sql4,$pa,$opt,$ms_db);
                           if($res4){

                            $apprMail= "Select OEMailID,EMP_NAME from HrdMastQry where Emp_Code='".$row6['approvedBy']."'";
                            $apprMailRes= query($query,$apprMail,$pa,$opt,$ms_db);
                            $apprMail=$fetch($apprMailRes);

                            $creaName= "Select EMP_NAME from HrdMastQry where Emp_Code='".$row6['CreatedBy']."'";
                            $creaNameRes= query($query,$creaName,$pa,$opt,$ms_db);
                            $name1=$fetch($creaNameRes);

                            $to2=trim($apprMail['OEMailID']);
                            $subject2= "Out On Request-".$Emailsubject;
                            $message2="Dear ".$apprMail['EMP_NAME'].",<br><br>";
                            $message2.="You are requested to approve out on duty request from ".$row6['date_from']." to ".$row6['date_to']." due to ";
                            $message2.=$row6['reason'] .".<br><br><br>";
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

                        $sql="update outOnWorkRequest set action_status='5',action_remark='$remarks',UpdatedOn='getdate()' where oDKey='".$oDKey."' ";
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
                        $sql="update outOnWorkRequest set action_status='4', action_remark='$remarks', flag='1',UpdatedOn='getdate()' where oDKey='".$oDKey."' and action_status='1' ";
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

elseif ($_POST['type'] == "searchMyDate") {
    $fromDate= dateConversionhtml($_POST['fromDate']);
    $toDate = dateConversionhtml($_POST['toDate']);
    $loginUser = $_POST['code'];
    
    if ($fromDate == "" && $toDate == "") {
            $sql="select *,convert(varchar(10),date_from,103)as date_from, convert(varchar(10),date_to,103)as date_to,convert(varchar(27),CreatedOn,109)as CreatedOn from outOnWorkRequest where CreatedBy='$loginUser'  and flag='1'";
        } 
       elseif ($fromDate=="") {
            $sql="select *,convert(varchar(10),date_from,103)as date_from, convert(varchar(10),date_to,103)as date_to,,convert(varchar(27),CreatedOn,109)as CreatedOn from outOnWorkRequest where CreatedBy='$loginUser'and date_to='$toDate'  and flag='1'";
        }elseif($toDate==""){
         $sql="select *,convert(varchar(10),date_from,103)as date_from, convert(varchar(10),date_to,103)as date_to,convert(varchar(27),CreatedOn,109)as CreatedOn from outOnWorkRequest where CreatedBy='$loginUser'and date_from='$fromDate'  and flag='1'";
        }
        else{
            $sql="select *,convert(varchar(10),date_from,103)as date_from, convert(varchar(10),date_to,103)as date_to,convert(varchar(27),CreatedOn,109)as CreatedOn from outOnWorkRequest where CreatedBy='$loginUser'and date_from='$fromDate' and date_to='$toDate'  and flag='1'";
        }
            
            $res=query($query,$sql,$pa,$opt,$ms_db);
            if($res){    
                $i=0;
                while($row=$fetch($res)){
                    $sqlWork="select * from LOVMast  where LOV_Field='natureOfWork'";
                    $resWork=query($query,$sqlWork,$pa,$opt,$ms_db);
                    $resData=$fetch($resWork); 

                    $mngrcode=$row['approvedBy'];
                    $sql1="select EMP_NAME from HrdMastQry WHERE Emp_Code='$mngrcode'";
                    $res1=query($query,$sql1,$pa,$opt,$ms_db);
                    $data1=$fetch($res1);

                 echo" <tr>
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
                              while($resData=$fetch($resWork)){
                                    if($row['natureOfWork'] === $resData['LOV_Value']){
                                        echo $resData['LOV_Text']; break;
                                    }
                                 }
                                
                           echo "</td>
                            
                            <td>";
                            if($row['action_status'] == "1"){?>
                            <a class="myod" data-toggle="modal" href="#large" 
                                onclick="getmyodId('<?php echo $row['outWorkId'];?>','1','<?php echo $loginUser;?>');">
                                    <span class='label bg-blue-steel'>
                                    Pending </span>
                                </a>   
                            <?php    }else if($row['action_status'] == "2") {?>
                                <a class='myod' data-toggle='modal' href='#large'
                                    onclick='getmyodId('".$row['outWorkId']."','2','".$loginUser."')'>
                                    <span class='label label-success'>
                                   Approved
                                     </span>
                                 </a>
                            <?php    } else if($row['action_status'] == "3") { ?>
                               <a class='myod' data-toggle='modal' href='#large'
                                    onclick='getmyodId('".$row['outWorkId']."','3','".$loginUser."')'>
                                    <span class='label label-danger'>
                                   Rejected
                                 </span>
                                 </a>
                            <?php    } else if($row['action_status'] == "4") { ?>
                                <a class='myod' data-toggle='modal' href='#large'
                                    onclick='getmyodId('".$row['outWorkId']."','4','".$loginUser."')'>
                                    <span class='label bg-grey-cascade'>
                                   Cancelled
                                 </span>
                                 </a>
                            <?php  }
                                        
                           echo"</td>
                            </tr>";
                          $i++;  
                }
            }
        
}

else if($_POST['type'] == "appMainContent"){
    $loginUser = $_POST['userCode'];
    $sql="select *,CONVERT (VARCHAR(10),date_from,103 ) as date_from , CONVERT (VARCHAR(10),date_to,103 ) as date_to,CONVERT (VARCHAR(35),CreatedOn,109 ) as CreatedOn from outOnWorkRequest WHERE approvedBy='$loginUser'";
    $res=query($query,$sql,$pa,$opt,$ms_db);
    if($res){
                   
                $i=0;
                while($row=$fetch($res)){
                    $sqlWork="select * from LOVMast  where LOV_Field='natureOfWork'";
                    $resWork=query($query,$sqlWork,$pa,$opt,$ms_db);
                    $resData=$fetch($resWork); 

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
                              while($resData=$fetch($resWork)){
                                        if($row['natureOfWork'] === $resData['LOV_Value']){
                                            echo $resData['LOV_Text']; break;
                                        }
                                     }
                                
                           echo "</td>
                            
                            <td>";
                            if($row['action_status'] == "1"){?>
                            <a class='myod' data-toggle='modal' href='#large' 
                                onclick="getmyodId('<?php echo $row['outWorkId'];?>','1','<?php echo $loginUser;?>');">
                                    <span class='label  bg-blue-steel'>
                                    Pending </span>
                                </a> <?php   
                                }else if($row['action_status'] == "2") {?>
                                 <a class='myod' data-toggle='modal' href='#large'
                                    onclick="getmyodId('<?php echo $row['outWorkId']?>','2','<?php echo $loginUser;?>');">
                                    <span class='label  label-success'>
                                   Approved
                                     </span>
                                 </a><?php 
                                } else if($row['action_status'] == "3") {?>
                                <a class='myod' data-toggle='modal' href='#large'
                                    onclick="getmyodId('<?php echo $row['outWorkId'];?>','3','<?php echo $loginUser;?>');">
                                    <span class='label  label-danger'>
                                   Rejected
                                 </span>
                                 </a><?php
                                } else if($row['action_status'] == "4") {?>
                                <a class='myod' data-toggle='modal' href='#large'
                                    onclick="getmyodId('<?php echo $row['outWorkId'];?>','4',
                                        '<?php echo $loginUser;?>');">
                                    <span class='label bg-grey-cascade'>
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

else if($_POST['type'] == "myMainContent"){
    $loginUser = $_POST['userCode'];
    $sql="select *,CONVERT (VARCHAR(10),date_from,103 ) as date_from , CONVERT (VARCHAR(10),date_to,103 ) as date_to,CONVERT (VARCHAR(35),CreatedOn,109 ) as CreatedOn from outOnWorkRequest WHERE flag='1' and CreatedBy='$loginUser'";
    $res=query($query,$sql,$pa,$opt,$ms_db);
    if($res){
                   
                $i=0;
                while($row=$fetch($res)){
                    $sqlWork="select * from LOVMast  where LOV_Field='natureOfWork'";
                    $resWork=query($query,$sqlWork,$pa,$opt,$ms_db);
                    $resData=$fetch($resWork); 

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
                              while($resData=$fetch($resWork)){
                                        if($row['natureOfWork'] === $resData['LOV_Value']){
                                            echo $resData['LOV_Text']; break;
                                        }
                                     }
                                
                           echo "</td>
                            
                            <td>";
                            if($row['action_status'] == "1"){?>
                            <a class='myod' data-toggle='modal' href='#large' 
                                onclick="getmyodId('<?php echo $row['outWorkId'];?>','1','<?php echo $loginUser;?>');">
                                    <span class='label  bg-blue-steel'>
                                    Pending </span>
                                </a> <?php   
                                }else if($row['action_status'] == "2") {?>
                                 <a class='myod' data-toggle='modal' href='#large'
                                    onclick="getmyodId('<?php echo $row['outWorkId']?>','2','<?php echo $loginUser;?>');">
                                    <span class='label  label-success'>
                                   Approved
                                     </span>
                                 </a><?php 
                                } else if($row['action_status'] == "3") {?>
                                <a class='myod' data-toggle='modal' href='#large'
                                    onclick="getmyodId('<?php echo $row['outWorkId'];?>','3','<?php echo $loginUser;?>');">
                                    <span class='label  label-danger'>
                                   Rejected
                                 </span>
                                 </a><?php
                                } else if($row['action_status'] == "4") {?>
                                <a class='myod' data-toggle='modal' href='#large'
                                    onclick="getmyodId('<?php echo $row['outWorkId'];?>','4',
                                        '<?php echo $loginUser;?>');">
                                    <span class='label bg-grey-cascade'>
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


elseif ($_POST['type'] == "searchDate") {
    $fromDate= $_POST['fromDate'];
    $toDate = $_POST['toDate'];
    $loginUser = $_POST['code'];
    
    if ($fromDate == "" && $toDate == "") {
            $sql="select *,convert(varchar(10),date_from,103)as date_from, convert(varchar(10),date_to,103)as date_to,convert(varchar(27),CreatedOn,109)as CreatedOn from outOnWorkRequest where approvedBy='$loginUser' and flag='1'";
        } 
       elseif ($fromDate=="") {
            $sql="select *,convert(varchar(10),date_from,103)as date_from, convert(varchar(10),date_to,103)as date_to,convert(varchar(27),CreatedOn,109)as CreatedOn from outOnWorkRequest where approvedBy='$loginUser'and date_to='$toDate' and flag='1'";
        }elseif($toDate==""){
        $sql="select *,convert(varchar(10),date_from,103)as date_from, convert(varchar(10),date_to,103)as date_to,convert(varchar(27),CreatedOn,109)as CreatedOn from outOnWorkRequest where approvedBy='$loginUser'and date_from='$fromDate' and flag='1'";
        }
        else{
            $sql="select *,convert(varchar(10),date_from,103)as date_from, convert(varchar(10),date_to,103)as date_to,convert(varchar(27),CreatedOn,109)as CreatedOn from outOnWorkRequest where approvedBy='$loginUser'and date_from='$fromDate' and date_to='$toDate' and flag='1'";
        }
            
            $res=query($query,$sql,$pa,$opt,$ms_db);
            if($res){    
                $i=0;
                while($row=$fetch($res)){
                    $sqlWork="select * from LOVMast  where LOV_Field='natureOfWork'";
                    $resWork=query($query,$sqlWork,$pa,$opt,$ms_db);
                    $resData=$fetch($resWork);

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
                              while($resData=$fetch($resWork)){
                                        if($row['natureOfWork'] === $resData['LOV_Value']){
                                            echo $resData['LOV_Text']; break;
                                        }
                                     }
                                
                           echo "</td>
                            
                            <td>";
                            if($row['action_status'] == "1"){?>
                            <a class='myod' data-toggle='modal' href='#large' 
                                onclick="getmyodId('<?php echo $row['outWorkId'];?>','1','<?php echo $loginUser;?>');">
                                    <span class='label  bg-blue-steel'>
                                    Pending </span>
                                </a> <?php   
                                }else if($row['action_status'] == "2") {?>
                                 <a class='myod' data-toggle='modal' href='#large'
                                    onclick="getmyodId('<?php echo $row['outWorkId']?>','2','<?php echo $loginUser;?>');">
                                    <span class='label  label-success'>
                                   Approved
                                     </span>
                                 </a><?php 
                                } else if($row['action_status'] == "3") {?>
                                <a class='myod' data-toggle='modal' href='#large'
                                    onclick="getmyodId('<?php echo $row['outWorkId'];?>','3','<?php echo $loginUser;?>');">
                                    <span class='label  label-danger'>
                                   Rejected
                                 </span>
                                 </a><?php
                                } else if($row['action_status'] == "4") {?>
                                <a class='myod' data-toggle='modal' href='#large'
                                    onclick="getmyodId('<?php echo $row['outWorkId'];?>','4',
                                        '<?php echo $loginUser;?>');">
                                    <span class='label bg-grey-cascade'>
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

elseif ($_POST['type'] == "searchMyStatus") {
    $statusid= $_POST['statusid'];
    $loginUser=$_POST['code'];
     $sql="select *,CONVERT (VARCHAR(10),date_from,103 ) as date_from , CONVERT (VARCHAR(10),date_to,103 ) as date_to,convert(varchar(27),CreatedOn,109)as CreatedOn from  outOnWorkRequest where action_status='$statusid' and CreatedBy='$loginUser' and flag='1'";
    $res=query($query,$sql,$pa,$opt,$ms_db);
    while($row= $fetch($res)){
        $sqlWork="select * from LOVMast  where LOV_Field='natureOfWork'";
        $resWork=query($query,$sqlWork,$pa,$opt,$ms_db);
        $resData=$fetch($resWork);

         
        $mngrcode=$row['approvedBy'];
        $sql1="select EMP_NAME from HrdMastQry WHERE Emp_Code='$mngrcode'";
        $res1=query($query,$sql1,$pa,$opt,$ms_db);
        $data1=$fetch($res1);

                echo"<tr>

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
                      while($resData=$fetch($resWork)){
                                if($row['natureOfWork'] === $resData['LOV_Value']){
                                    echo $resData['LOV_Text']; break;
                                }
                             }
                        
                   echo "</td>
                    
                    <td>";
                    if($row['action_status'] == "1"){?>
                    <a class='myod' data-toggle='modal' href='#large' 
                        onclick="getmyodId('<?php echo $row['outWorkId'];?>','1','<?php echo $loginUser; ?>');">
                            <span class='label bg-blue-steel'>
                            Pending </span>
                        </a>   
                     <?php   }else if($row['action_status'] == "2") {?>
                       <a class='myod' data-toggle='modal' href='#large'
                            onclick="getmyodId('<?php echo $row['outWorkId'];?>','2','<?php echo $loginUser;?>');">
                            <span class='label label-success'>
                           Approved
                             </span>
                         </a>
                     <?php   } else if($row['action_status'] == "3") {?>
                        <a class='myod' data-toggle='modal' href='#large'
                            onclick="getmyodId('<?php echo $row['outWorkId'];?>','3','<?php echo $loginUser;?>');">
                            <span class='label label-danger'>
                           Rejected
                         </span>
                         </a>
                    <?php    } else if($row['action_status'] == "4") {?>
                        <a class='myod' data-toggle='modal' href='#large'
                            onclick="getmyodId('<?php echo $row['outWorkId'];?>','4','<?php echo $loginUser;?>');">
                            <span class='label bg-grey-cascade'>
                           Cancelled
                         </span>
                         </a>
                    <?php    }
                                
                      echo"</td>
                    </tr>";
                            $i++;        
    }
}

elseif ($_POST['type'] == "searchStatus") {
    $statusid= $_POST['statusid'];
    $loginUser=$_POST['code'];
     $sql="select *,CONVERT (VARCHAR(10),date_from,103 ) as date_from , CONVERT (VARCHAR(10),date_to,103 ) as date_to,CONVERT (VARCHAR(27),CreatedOn,109) as CreatedOn from  outOnWorkRequest where action_status='$statusid' and approvedBy='$loginUser' and flag='1'";
    $res=query($query,$sql,$pa,$opt,$ms_db);
    $i=0;
    while($row= $fetch($res)){

        $sqlWork="select * from LOVMast  where LOV_Field='natureOfWork'";
        $resWork=query($query,$sqlWork,$pa,$opt,$ms_db);
        $resData=$fetch($resWork);
         
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
                              while($resData=$fetch($resWork)){
                                        if($row['natureOfWork'] === $resData['LOV_Value']){
                                            echo $resData['LOV_Text']; break;
                                        }
                                     }
                                
                           echo "</td>
                            
                            <td>";
                            if($row['action_status'] == "1"){?>
                            <a class='myod' data-toggle='modal' href='#large' 
                                onclick="getmyodId('<?php echo $row['outWorkId'];?>','1','<?php echo $loginUser;?>');">
                                    <span class='label  bg-blue-steel'>
                                    Pending </span>
                                </a> <?php   
                                }else if($row['action_status'] == "2") {?>
                                 <a class='myod' data-toggle='modal' href='#large'
                                    onclick="getmyodId('<?php echo $row['outWorkId']?>','2','<?php echo $loginUser;?>');">
                                    <span class='label  label-success'>
                                   Approved
                                     </span>
                                 </a><?php 
                                } else if($row['action_status'] == "3") {?>
                                <a class='myod' data-toggle='modal' href='#large'
                                    onclick="getmyodId('<?php echo $row['outWorkId'];?>','3','<?php echo $loginUser;?>');">
                                    <span class='label  label-danger'>
                                   Rejected
                                 </span>
                                 </a><?php
                                } else if($row['action_status'] == "4") {?>
                                <a class='myod' data-toggle='modal' href='#large'
                                    onclick="getmyodId('<?php echo $row['outWorkId'];?>','4',
                                        '<?php echo $loginUser;?>');">
                                    <span class='label bg-grey-cascade'>
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

elseif ($_POST['type'] == "searchMyName") {
    $codename= $_POST['codename'];
  $loginUser=$_POST['code'];
   $sql="select *,CONVERT (VARCHAR(10),date_from,103 ) as date_from , CONVERT (VARCHAR(10),date_to,103 ) as date_to from  outOnWorkRequest where CreatedBy='$loginUser' and (approvedBy in (select emp_code from HrdMastQry where Emp_FName='$codename' or Emp_MName='$codename' or Emp_LName='$codename') or approvedBy='$codename') and flag='1'";
    $res=query($query,$sql,$pa,$opt,$ms_db);
    while($row= $fetch($res)){
        $sqlWork="select * from LOVMast  where LOV_Field='natureOfWork'";
        $resWork=query($query,$sqlWork,$pa,$opt,$ms_db);
        $resData=$fetch($resWork);


        $usercode=$row['approvedBy'];
        $sql1="select EMP_NAME from HrdMastQry WHERE Emp_Code='$usercode'";
        $res1=query($query,$sql1,$pa,$opt,$ms_db);
        $data1=$fetch($res1);
        $i=0;
        echo"<tr>

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
                      while($resData=$fetch($resWork)){
                                if($row['natureOfWork'] === $resData['LOV_Value']){
                                    echo $resData['LOV_Text']; break;
                                }
                             }
                                
               echo "</td>
                    
                    <td>";
                    if($row['action_status'] == "1"){?>
                    <a class='myod' data-toggle='modal' href='#large' 
                        onclick="getmyodId('<?php echo $row['outWorkId'];?>','1','<?php echo $loginUser;?>');">
                            <span class='label bg-blue-steel'>
                            Pending </span>
                        </a>   
                    <?php    }else if($row['action_status'] == "2") {?>
                         <a class='myod' data-toggle='modal' href='#large'
                            onclick="getmyodId('<?php echo $row['outWorkId'];?>','2','<?php echo $loginUser;?>');">
                            <span class='label label-success'>
                           Approved
                             </span>
                         </a>
                    <?php  } else if($row['action_status'] == "3") {?>
                        <a class='myod' data-toggle='modal' href='#large'
                            onclick="getmyodId('<?php echo $row['outWorkId'];?>','3','<?php echo $loginUser;?>');">
                            <span class='label label-danger'>
                           Rejected
                         </span>
                         </a>
                    <?php    } else if($row['action_status'] == "4") {?>
                        <a class='myod' data-toggle='modal' href='#large'
                            onclick='getmyodId('<?php echo $row['outWorkId'];?>','4','<?php echo $loginUser;?>');">
                            <span class='label bg-grey-cascade'>
                           Cancelled
                         </span>
                         </a>
                    <?php    }
                                
                      echo"</td>
                    </tr>";
                        $i++;        
   }
}

elseif ($_POST['type'] == "searchApproverName") {
  $codename= $_POST['codename'];
  $loginUser=$_POST['code'];
   $sql="select *,CONVERT (VARCHAR(10),date_from,103 ) as date_from , CONVERT (VARCHAR(10),date_to,103 ) as date_to from  outOnWorkRequest where approvedBy='$loginUser' and (approvedBy in (select emp_code from HrdMastQry where Emp_FName='$codename' or Emp_MName='$codename' or Emp_LName='$codename') or approvedBy='$codename') and flag='1'";
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
   $sql="select *,CONVERT (VARCHAR(10),date_from,103 ) as date_from , CONVERT (VARCHAR(10),date_to,103 ) as date_to from  outOnWorkRequest where approvedBy='$loginUser' and (CreatedBy in (select emp_code from HrdMastQry where Emp_FName='$codename' or Emp_MName='$codename' or Emp_LName='$codename') or CreatedBy='$codename') and flag='1'";
    $res=query($query,$sql,$pa,$opt,$ms_db);
    while($row= $fetch($res)){
        $sqlWork="select * from LOVMast  where LOV_Field='natureOfWork'";
        $resWork=query($query,$sqlWork,$pa,$opt,$ms_db);
        $resData=$fetch($resWork);

        $usercode=$row['CreatedBy'];
        $sql1="select EMP_NAME from HrdMastQry WHERE Emp_Code='$usercode'";
        $res1=query($query,$sql1,$pa,$opt,$ms_db);
        $data1=$fetch($res1);
        $i=0;
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
                              while($resData=$fetch($resWork)){
                                        if($row['natureOfWork'] === $resData['LOV_Value']){
                                            echo $resData['LOV_Text']; break;
                                        }
                                     }
                                
                           echo "</td>
                            
                            <td>";
                            if($row['action_status'] == "1"){?>
                            <a class='myod' data-toggle='modal' href='#large' 
                                onclick="getmyodId('<?php echo $row['outWorkId'];?>','1','<?php echo $loginUser;?>');">
                                    <span class='label  bg-blue-steel'>
                                    Pending </span>
                                </a> <?php   
                                }else if($row['action_status'] == "2") {?>
                                 <a class='myod' data-toggle='modal' href='#large'
                                    onclick="getmyodId('<?php echo $row['outWorkId']?>','2','<?php echo $loginUser;?>');">
                                    <span class='label  label-success'>
                                   Approved
                                     </span>
                                 </a><?php 
                                } else if($row['action_status'] == "3") {?>
                                <a class='myod' data-toggle='modal' href='#large'
                                    onclick="getmyodId('<?php echo $row['outWorkId'];?>','3','<?php echo $loginUser;?>');">
                                    <span class='label  label-danger'>
                                   Rejected
                                 </span>
                                 </a><?php
                                } else if($row['action_status'] == "4") {?>
                                <a class='myod' data-toggle='modal' href='#large'
                                    onclick="getmyodId('<?php echo $row['outWorkId'];?>','4',
                                        '<?php echo $loginUser;?>');">
                                    <span class='label bg-grey-cascade'>
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

function dateConversionhtml($sDate){
    $aDate = explode('-', $sDate);

    @$sMySQLTimestamp = sprintf(
        '%s-%s-%s 00:00:00',
        @$aDate[0],
        @$aDate[1],
        @$aDate[2]
    );

    return $sMySQLTimestamp;
}

?>
