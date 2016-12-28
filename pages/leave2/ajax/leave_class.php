<?php
include ('../../configdata.php');
//include ('../../define_email_data.php');
//$define_email_data_obj=new define_email_data();

class leave_class{
    function __construct(){
      
    }
    function getMyLeaveRequestData($code){

      
       global $HTTP_HOST;
        global $query;
        global $sql;
        global $pa;
        global $opt;
        global $ms_db;
        global $fetch;

        $sql="select Levkey from Leave WHERE CreatedBy='$code' group by Levkey";
       
        $res=query($query,$sql,$pa,$opt,$ms_db);
      // $Levkey_array=array();
        $count=0;
       while ($rows = $fetch($res)){
       $Levkey_val=$rows['Levkey'];
      // echo $Levkey_val."aaa";
          $sql1="select TOP 1 leaveID,CONVERT (VARCHAR(10),LvFrom,103 ) as LvFrom,CONVERT (VARCHAR(10),LvTo,103 ) as LvTo,LvDays,LvType,reason,ApprovedBy,status,Levkey from Leave WHERE Levkey='$Levkey_val' order by leaveID DESC ";
           $res1=query($query,$sql1,$pa,$opt,$ms_db);
      // $Levkey_array=array();
          while ($rows1 = $fetch($res1)){
             //echo $rows1['leaveID'];
            $leaveID[$count]=$rows1['leaveID'];
            $LvFrom[$count]=$rows1['LvFrom'];
            $LvTo[$count]=$rows1['LvTo'];
            $LvDays[$count]=$rows1['LvDays'];
            $LvType[$count]=$rows1['LvType'];
            $reason[$count]=$rows1['reason'];
            $ApprovedBy[$count]=$rows1['ApprovedBy'];
            $status[$count]=$rows1['status'];
            $Levkey[$count]=$rows1['Levkey'];
            $count++;
          }
       }  
      
      return array($leaveID,$LvFrom,$LvTo,$LvDays,$LvType,$reason,$ApprovedBy,$status,$Levkey,$count);
    }


    function getMyteamLeaveRequestData($code){

      
       global $HTTP_HOST;
        global $query;
        global $sql;
        global $pa;
        global $opt;
        global $ms_db;
        global $fetch;

        $sql="select Levkey from Leave WHERE CreatedBy='$code' and status='2' and ";
        $sql.=" YEAR(Trn_Date) = YEAR(getDate()) and";
        $sql.=" flag='1' group by Levkey ORDER BY MAX(updation_date) DESC";
       //echo $sql;
      //  $sql="select Levkey from Leave WHERE CreatedBy='$code' group by Levkey";
       
        $res=query($query,$sql,$pa,$opt,$ms_db);
      // $Levkey_array=array();
        $count=0;
       while ($rows = $fetch($res)){
       $Levkey_val=$rows['Levkey'];
      // echo $Levkey_val."aaa";
         $sql1="select TOP 1 CONVERT(VARCHAR(10),trn_Date,103) as trn_Date,CONVERT (VARCHAR(10),LvFrom,103 ) as LvFrom,CONVERT (VARCHAR(10),LvTo,103 ) as LvTo,LvType,LvDays,reason,ApprovedBy,status,CONVERT (VARCHAR(10),updation_date,103 ) as updation_date from Leave WHERE Levkey='$Levkey_val' order by leaveID DESC ";
           $res1=query($query,$sql1,$pa,$opt,$ms_db);
      // $Levkey_array=array();
          while ($rows1 = $fetch($res1)){
             //echo $rows1['leaveID'];
            $trn_Date[$count]=$rows1['trn_Date'];
            $LvFrom[$count]=$rows1['LvFrom'];
            
            $LvTo[$count]=$rows1['LvTo'];
            $LvType[$count]=$rows1['LvType'];
            $LvDays[$count]=$rows1['LvDays'];
            $updation_date[$count]=$rows1['updation_date'];
            $ApprovedBy[$count]=$rows1['ApprovedBy'];
            $count++;
          }
       }  
      
      return array($trn_Date,$LvFrom,$LvTo,$LvType,$LvDays,$ApprovedBy,$updation_date,$count);
    }


     function getMyteamLeaveRequestData1($code,$type1,$start,$end,$total){

      //echo "qq".$total."www";
     // print_r($total);
       global $HTTP_HOST;
        global $query;
        global $sql;
        global $pa;
        global $opt;
        global $ms_db;
        global $fetch;
$total_sum=0;
if($type1=='EL'){
    $keyval=1;
  }
  if($type1=='CL'){
    $keyval=2;
  }
  if($ketype1y=='SL'){
    $keyval=3;
  }
  if($type1=='SEL'){
    $keyval=8;
  }
  if($type1=='ML'){
    $keyval=7;
  }
  if($type1=='AL'){
    $keyval=9;
  }
  if($type1=='SPL'){
    $keyval=10;
  }
  if($type1=='OL'){
    $keyval=11;
  }
  if($type1=='BTL'){
    $keyval='7,5';
   }

foreach ($total as $name => $accur) {
    if ($name == $type1) {
      $total_days_bal= $accur;
        break;
    }
}
//echo $total_days_bal;
        $sql="select Levkey from Leave WHERE CreatedBy='$code' and status='2' and ";
       
      $sql.="LvType IN ($keyval) and CONVERT (date,updation_date,103) >=convert(date, '$start',103) 
and CONVERT (date,updation_date,103) <=convert(date, '$end',103) and";    
  $sql.=" flag='1' group by Levkey ORDER BY MAX(updation_date) DESC";
     //  echo $sql;
      //  $sql="select Levkey from Leave WHERE CreatedBy='$code' group by Levkey";
       
        $res=query($query,$sql,$pa,$opt,$ms_db);
        $sql2="select sum(a.LvDays) as LvDays from (SELECT LvDays ,Createdby,Levkey FROM leave where Createdby='$code' and status='2' and LvType='$keyval' and CONVERT (date,updation_date,103) >=convert(date, '$start',103) 
and CONVERT (date,updation_date,103) <=convert(date, '$end',103) group by Levkey,Createdby,LvDays) a";
  //echo $sql2;
    $result2=query($query, $sql2, $pa, $opt, $ms_db);

    $row4=$fetch($result2);
    $avail=$row4['LvDays'];
   // $total_days_bal=$total_days_bal-$avail;
    //echo "sac".$total_days_bal."hin".$avail;
      // $Levkey_array=array();
        $count=0;
       while ($rows = $fetch($res)){
       $Levkey_val=$rows['Levkey'];
      // echo $Levkey_val."aaa";
         $sql1="select TOP 1 leaveID,CONVERT(VARCHAR(10),trn_Date,103) as trn_Date,CONVERT (VARCHAR(10),LvFrom,103 ) as LvFrom,CONVERT (VARCHAR(10),LvTo,103 ) as LvTo,LvType,LvDays,reason,ApprovedBy,CONVERT (VARCHAR(10),updation_date,103 ) as updation_date,status from Leave WHERE Levkey='$Levkey_val' order by leaveID DESC";
        // echo $sql1;
           $res1=query($query,$sql1,$pa,$opt,$ms_db);
      // $Levkey_array=array();
          while ($rows1 = $fetch($res1)){
             //echo $rows1['leaveID'];
            $trn_Date[$count]=$rows1['trn_Date'];
            $LvFrom[$count]=$rows1['LvFrom'];
            
            $LvTo[$count]=$rows1['LvTo'];
            $LvType[$count]=$rows1['LvType'];
            $LvDays[$count]=$rows1['LvDays'];
            $ApprovedBy[$count]=$rows1['ApprovedBy'];
            $updation_date[$count]=$rows1['updation_date'];
             $total_days_bal1[$count]=$total_days_bal-$rows1['LvDays'];
             $total_days_bal=$total_days_bal-$rows1['LvDays'];
            $count++;
          }
       }  
      
      return array($trn_Date,$LvFrom,$LvTo,$LvType,$LvDays,$ApprovedBy,$total_days_bal1,$updation_date,$count);
    }

   function getemployee_name($code){

      
       global $HTTP_HOST;
        global $query;
        global $sql;
        global $pa;
        global $opt;
        global $ms_db;
        global $fetch;

        $sql="select Emp_FName,Emp_LName from EmpNameQry WHERE Emp_Code='$code'";
        $result=query($query,$sql,$pa,$opt,$ms_db);
          $row=$fetch($result);
        $emp_name=$row['Emp_FName']." ".$row['Emp_LName'];
       // echo $emp_name;
        return $emp_name;
    }
    function getemployee_email($code){

      
       global $HTTP_HOST;
        global $query;
        global $sql;
        global $pa;
        global $opt;
        global $ms_db;
        global $fetch;

        $sql="Select OEMailID,EMP_NAME from EmpNameQry where Emp_Code='".$code."'";
        $result=query($query,$sql,$pa,$opt,$ms_db);
          $row=$fetch($result);
        $emp_email=$row['OEMailID'];
       // echo $emp_name;
        return $emp_email;
    }
     
      function getemployee_leave_type($type)
      {
          global $HTTP_HOST;
        global $query;
        global $sql;
        global $pa;
        global $opt;
        global $ms_db;
        global $fetch;
          $sql="Select LOV_Text from lovmast where LOV_Field='Leave' and LOV_Value='".$type."'";
         // echo $sql;
        $result=query($query,$sql,$pa,$opt,$ms_db);
          $row=$fetch($result);
        $keyval=$row['LOV_Text'];
        return $keyval;
    }


   function cancelLeaveRequestWhenBothApproved($leaveIDs,$ApprovedBy,$remark,$lvkey,$flag){

      
       global $HTTP_HOST;
        global $query;
        global $sql;
        global $pa;
        global $opt;
        global $ms_db;
        global $fetch;
     
        $sql="select CONVERT(VARCHAR(10),LvFrom,102) as LvFrom,CONVERT(VARCHAR(10),LvTo,102) as LvTo,LvType,LvDays,reason,CreatedBy from Leave WHERE levkey='$lvkey'";
        $res=query($query,$sql,$pa,$opt,$ms_db);
        //echo  $sql;
        $row4=$fetch($res);
        $LvFrom=$row4['LvFrom'];
        $LvTo=$row4['LvTo'];
        $LvType=$row4['LvType'];
        $LvDays=$row4['LvDays'];
        $reason=$row4['reason'];
        $CreatedBy=$row4['CreatedBy'];
       // echo $LvFrom.$LvTo.$LvType;
        $update_sql = "UPDATE leave SET status='5',remark='$remark' WHERE levkey='$lvkey'";
        $res1=query($query,$update_sql,$pa,$opt,$ms_db);
       // echo  $update_sql;
        $update_sql2 = "INSERT INTO leavehistory (flag,levkey) VALUES ('4','$lvkey')";
        $res2=query($query,$update_sql2,$pa,$opt,$ms_db);
       // echo  $update_sql2;
        for($i=0;$i<sizeof($flag);$i++)
        {
         /* if($flag[$i]==1)
          {

            $approver_email=self::getemployee_email($ApprovedBy[$i]);
            $creater_email=self::getemployee_email($CreatedBy);
            $creater_name=self::getemployee_name($CreatedBy);
            //echo $approver_email;
            $subject= "Cancel Leave Request for approval".$creater_name;
            $message="Dear ".$creater_name.",<br><br>";
            $message.="Leave Cancel Request from ".$date_from." to ".$LvTo." for ";
            $message.="Regards,<br>";
            $message.=$creater_name;
            //echo  $message;
            $mail1=mymailer('donotreply@sequelone.com',$subject,$message,$to);

          }
          else
          {*/
            $approver_email=self::getemployee_email($ApprovedBy[$i]);
            $creater_email=self::getemployee_email($CreatedBy);
            $creater_name=self::getemployee_name($CreatedBy);
            //echo $approver_email;
            $subject= "Apply for Cancel Leave Request-".$creater_name;
            $message="Dear ".$creater_name.",<br><br>";
            $message.="Leave Cancel Request from ".$date_from." to ".$LvTo." for ";
            $message.="Regards,<br>";
            $message.=$creater_name;
           // $mail1=mymailer('donotreply@sequelone.com',$subject,$message,$approver_email);
             $var[$i][$ApprovedBy[$i].$i."a"]=array(
      "id"=>$ApprovedBy[$i],
            "email"=>$approver_email,
            "subject"=>$subject,
            "msg"=>$message
      );
              mymail('donotreply@sequelone.com',$var);
           //echo  $message;
         // }
        }
         $flag_key=1;
          return $flag_key;
  }
 function cancelLeaveRequestWhenBothNotApproved($leaveIDs,$ApprovedBy,$remark,$lvkey){

      
       global $HTTP_HOST;
        global $query;
        global $sql;
        global $pa;
        global $opt;
        global $ms_db;
        global $fetch;
     
        $sql="select CONVERT(VARCHAR(10),LvFrom,102) as LvFrom,CONVERT(VARCHAR(10),LvTo,102) as LvTo,LvType,LvDays,reason,CreatedBy from Leave WHERE levkey='$lvkey'";
        $res=query($query,$sql,$pa,$opt,$ms_db);
        //echo  $sql;
        $row4=$fetch($res);
        $LvFrom=$row4['LvFrom'];
        $LvTo=$row4['LvTo'];
        $LvType=$row4['LvType'];
        $LvDays=$row4['LvDays'];
        $reason=$row4['reason'];
        $CreatedBy=$row4['CreatedBy'];
        //echo $sql;
        $update_sql = "UPDATE leave SET status='4',remark='$remark' WHERE levkey='$lvkey'";
        $res1=query($query,$update_sql,$pa,$opt,$ms_db);
        //echo  $update_sql;
        $update_sql2 = "INSERT INTO leavehistory (flag,levkey) VALUES ('1','$lvkey')";
        $res2=query($query,$update_sql2,$pa,$opt,$ms_db);
        //echo  $update_sql2;
       for($i=0;$i<sizeof($ApprovedBy);$i++)
        {
           $approver_email=self::getemployee_email($ApprovedBy[$i]);
           $approver_name=self::getemployee_name($ApprovedBy[$i]);
            $creater_email=self::getemployee_email($CreatedBy);
            $creater_name=self::getemployee_name($CreatedBy);
            //echo $approver_email;
            $subject= "Apply for Cancel Leave Request-".$creater_name;
            $message="Dear ".$approver_name.",<br><br>";
            $message.="Leave Cancel Request from ".$date_from." to ".$LvTo." for ";
            $message.="Regards,<br>";
            $message.=$creater_name;
              $var[$i][$ApprovedBy[$i].$i."a"]=array(
      "id"=>$ApprovedBy[$i],
            "email"=>$approver_email,
            "subject"=>$subject,
            "msg"=>$message
      );
                mymail('donotreply@sequelone.com',$var);
            // $mail1=mymailer('donotreply@sequelone.com',$subject,$message,$approver_email);
           // echo  $message;
        }
        $flag_key=1;
          return $flag_key;   
  }



  function reApplyLeaveRequestCanceled($leaveIDs,$ApprovedBy,$lvkey){

      
       global $HTTP_HOST;
        global $query;
        global $sql;
        global $pa;
        global $opt;
        global $ms_db;
        global $fetch;
     
         $sql="select CONVERT(VARCHAR(10),LvFrom,102) as LvFrom,CONVERT(VARCHAR(10),LvTo,102) as LvTo,LvType,LvDays,reason,CreatedBy from Leave WHERE levkey='$lvkey'";
        $res=query($query,$sql,$pa,$opt,$ms_db);
        //echo  $sql;
        $row4=$fetch($res);
        $LvFrom=$row4['LvFrom'];
        $LvTo=$row4['LvTo'];
        $LvType=$row4['LvType'];
        $LvDays=$row4['LvDays'];
        $reason=$row4['reason'];
        $CreatedBy=$row4['CreatedBy'];
        //echo  $sql;
       
       // echo $LvFrom.$LvTo.$LvType;
        $update_sql = "UPDATE leave SET status='1' WHERE levkey='$lvkey'";
        $res1=query($query,$update_sql,$pa,$opt,$ms_db);
       // echo  $update_sql;
        $update_sql2 = "INSERT INTO leavehistory (flag,levkey) VALUES ('6','$lvkey')";
        $res2=query($query,$update_sql2,$pa,$opt,$ms_db);
       // echo  $update_sql2;
        for($i=0;$i<sizeof($leaveIDs);$i++)
        {
          if($i==0)
          {
            $update_flag_sql = "UPDATE leave SET flag='1' WHERE leaveID='$leaveIDs[$i]'";
            $res_flag=query($query,$update_flag_sql,$pa,$opt,$ms_db);
            $approver_email=self::getemployee_email($ApprovedBy[$i]);
            $approver_name=self::getemployee_name($ApprovedBy[$i]);
            $creater_email=self::getemployee_email($CreatedBy);
            $creater_name=self::getemployee_name($CreatedBy);
            //echo $approver_email;
            $subject= "Leave Request for approval".$creater_name;
            $message="Dear ".$approver_name.",<br><br>";
            $message.="Leave Cancel Request from ".$date_from." to ".$LvTo." for ";
            $message.="Regards,<br>";
            $message.=$creater_name;
              $var[$i][$ApprovedBy[$i].$i."a"]=array(
      "id"=>$ApprovedBy[$i],
            "email"=>$approver_email,
            "subject"=>$subject,
            "msg"=>$message
      );
                mymail('donotreply@sequelone.com',$var);
           // $mail1=mymailer('donotreply@sequelone.com',$subject,$message,$approver_email);
          //  echo  $message;
           }
          else
          {
            $update_flag_sql1 = "UPDATE leave SET flag='0' WHERE leaveID='$leaveIDs[$i]'";
            $res_flag1=query($query,$update_flag_sql1,$pa,$opt,$ms_db);
          }
        }
          $flag_key=1;
          return $flag_key;
  }


   function leaveApproveRequestWhenReject($leaveID,$flag,$remark,$t,$planned){

      
       global $HTTP_HOST;
        global $query;
        global $sql;
        global $pa;
        global $opt;
        global $ms_db;
        global $fetch;
     $var=array();
         $sql="select CONVERT(VARCHAR(10),LvFrom,102) as LvFrom,CONVERT(VARCHAR(10),LvTo,102) as LvTo,LvType,LvDays,reason,CreatedBy,levKey,ApprovedBy from Leave WHERE leaveID='$leaveID'";
        $res=query($query,$sql,$pa,$opt,$ms_db);
        //echo  $sql;
        $row4=$fetch($res);
        $LvFrom=$row4['LvFrom'];
        $LvTo=$row4['LvTo'];
        $LvType=$row4['LvType'];
        $LvDays=$row4['LvDays'];
        $reason=$row4['reason'];
        $CreatedBy=$row4['CreatedBy'];
        $lvkey=$row4['levKey'];
        $ApprovedBy1=$row4['ApprovedBy'];
        $approver_email1=self::getemployee_email($ApprovedBy1);
           $approver_name1=self::getemployee_name($ApprovedBy1);
        //echo $sql;
        $update_sql = "UPDATE leave SET status='3',remark='$remark',planned_unplanned='$planned',updation_date=getdate() WHERE levkey='$lvkey'";
        $res1=query($query,$update_sql,$pa,$opt,$ms_db);
        //echo  $update_sql;
        $update_sql2 = "INSERT INTO leavehistory (flag,levkey) VALUES ('3','$lvkey')";
        $res2=query($query,$update_sql2,$pa,$opt,$ms_db);
        $sql="Select leaveID,ApprovedBy,status,flag from leave where levKey='$lvkey'";
        $res=query($query,$sql,$pa,$opt,$ms_db);
        $count=0;
        while ($rows = $fetch($res))
        {
           $ApprovedBy[$count]=$rows['ApprovedBy'];
            $count++;
        }
        //print_r($ApprovedBy);
        //echo  $update_sql2;
       for($i=0;$i<sizeof($ApprovedBy);$i++)
        {
          if($ApprovedBy[$i] !=$ApprovedBy1)
          {
           $approver_email=self::getemployee_email($ApprovedBy[$i]);
           $approver_name=self::getemployee_name($ApprovedBy[$i]);
            $creater_email=self::getemployee_email($CreatedBy);
            $creater_name=self::getemployee_name($CreatedBy);
            //echo $approver_email;
            $subject= "Leave Rejected By - ".$approver_name1;
            $message="Dear ".$approver_name.",<br><br>";
            $message.="Leave Request Rejected from ".$LvFrom." to ".$LvTo." due to ".$remark." reason ";
            $message.="Regards,<br>";
            $message.=$approver_name1;
            $var[$ApprovedBy[$i].$t."a"]=array(
          "id"=>$ApprovedBy[$i],
            "email"=>$approver_email,
            "subject"=>$subject,
            "msg"=>$message
      );

          // echo  $message;
            // $mail1=mymailer('donotreply@sequelone.com',$subject,$message,$approver_email);
          }
        }
            $creater_email=self::getemployee_email($CreatedBy);
            $creater_name=self::getemployee_name($CreatedBy);
            //echo $approver_email;
            $subject= " Your Leave Rejected By - ".$approver_name1;
            $message="Dear ".$creater_name.",<br><br>";
            $message.="Your Leave Request Rejected from ".$LvFrom." to ".$LvTo." due to ".$remark." reason ";
            $message.="Regards,<br>";
            $message.=$approver_name1;
            $var[$CreatedBy.$t."b"]=array(
      "id"=>$CreatedBy,
            "email"=>$creater_email,
            "subject"=>$subject,
            "msg"=>$message
      );
	 
        return $var;   
  }

  function leaveApproveRequestWhenApprove($leaveID,$flag,$t,$planned){

      
       global $HTTP_HOST;
        global $query;
        global $sql;
        global $pa;
        global $opt;
        global $ms_db;
        global $fetch;
    $var=array();
        $sql="select CONVERT(VARCHAR(10),LvFrom,102) as LvFrom,CONVERT(VARCHAR(10),LvTo,102) as LvTo,LvType,LvDays,reason,CreatedBy,ApprovedBy,levKey from Leave WHERE leaveID='$leaveID'";
        $res=query($query,$sql,$pa,$opt,$ms_db);
        //echo  $sql;
        $row4=$fetch($res);
        $LvFrom=$row4['LvFrom'];
        $LvTo=$row4['LvTo'];
        $LvType=$row4['LvType'];
        $LvDays=$row4['LvDays'];
        $reason=$row4['reason'];
        $CreatedBy=$row4['CreatedBy'];
        $ApprovedBy=$row4['ApprovedBy'];
         $lvkey=$row4['levKey'];
        //echo $sql;
        $update_sql = "UPDATE leave SET status='2',planned_unplanned='$planned',updation_date=getdate() WHERE leaveID='$leaveID'";
        $res1=query($query,$update_sql,$pa,$opt,$ms_db);
//echo $update_sql;
        $pre_next_sql = "SELECT P.PreviousID, N.NextID FROM (SELECT  MAX(D.leaveID) PreviousID FROM leave D WHERE leaveID < '$leaveID' and levKey='$lvkey') P CROSS JOIN (SELECT  MIN(D.leaveID) NextID FROM leave D WHERE leaveID > '$leaveID' and levKey='$lvkey') N";
        //echo $pre_next_sql;
        $pre_next_res=query($query,$pre_next_sql,$pa,$opt,$ms_db);
        $pre_next_rows = $fetch($pre_next_res);
        $PreviousID=$pre_next_rows['PreviousID'];
        $NextID=$pre_next_rows['NextID'];
        //echo  "qqqqq".$PreviousID."aaaa".$NextID;
        if($NextID !="")
        {
          $update_next_sql = "UPDATE leave SET flag='1' WHERE leaveID='$NextID'";
          $res=query($query,$update_next_sql,$pa,$opt,$ms_db);
          $sql_approve="select ApprovedBy from Leave WHERE leaveID='$NextID'";
        $res_approve=query($query,$sql_approve,$pa,$opt,$ms_db);
        //echo  $sql;
        $row5=$fetch($res_approve);
        $ApprovedBy2=$row5['ApprovedBy'];
          $approver_email2=self::getemployee_email($ApprovedBy2);
           $approver_name2=self::getemployee_name($ApprovedBy2);
          $creater_email=self::getemployee_email($CreatedBy);
            $creater_name=self::getemployee_name($CreatedBy);
            //echo $approver_email;
            $subject= "Leave Requested By -".$creater_name;
            $message="Dear ".$approver_name2.",<br><br>";
            $message.="Leave Request  for Approval from ".$LvFrom." to ".$LvTo." for ";
            $message.="Regards,<br>";
            $message.=$creater_name;
      $var[$ApprovedBy2.$t."a"]=array(
      "id"=>$ApprovedBy2,
            "email"=>$approver_email2,
            "subject"=>$subject,
            "msg"=>$message
      );
      
        //print_r($var);
          //$mail1=mymailer('donotreply@sequelone.com',$subject,$message,$approver_email2);
        }
        $update_sql2 = "INSERT INTO leavehistory (flag,levkey) VALUES ('2','$lvkey')";
        $res2=query($query,$update_sql2,$pa,$opt,$ms_db);
        $approver_email=self::getemployee_email($ApprovedBy);
           $approver_name=self::getemployee_name($ApprovedBy);
            $creater_email=self::getemployee_email($CreatedBy);
            $creater_name=self::getemployee_name($CreatedBy);
            //echo $approver_email;
            $subject= "Leave Approved By -".$approver_name;
            $message="Dear ".$creater_name.",<br><br>";
            $message.="Your Leave Request Approved from ".$LvFrom." to ".$LvTo." for ";
            $message.="Regards,<br>";
            $message.=$approver_name;
      $var[$CreatedBy.$t."b"]=array(
      "id"=>$CreatedBy,
            "email"=>$creater_email,
            "subject"=>$subject,
            "msg"=>$message
      );
     // print_r($var);
      //mymail('donotreply@sequelone.com',$var);
            //$mail1=mymailer('donotreply@sequelone.com',$subject,$message,$creater_email);
        //   echo  $message;
            
            return $var;   
  }

  function getMyAttendanceByDate($emp_id,$forDate,$toDate){

      
       global $HTTP_HOST;
        global $query;
        global $sql;
        global $pa;
        global $opt;
        global $ms_db;
        global $fetch;
        
         $forDate = str_replace('/', '-', $forDate);
          $forDate= date('Y-m-d', strtotime($forDate));
        if($toDate=="")
        {
         
            $sql="select CONVERT(VARCHAR(10),ATTDATE,102) as ATTDATE,CONVERT(VARCHAR(10),IN_TIME,108) as IN_TIME,CONVERT(VARCHAR(10),OUT_TIME,108) as OUT_TIME from CAttendanceqry where ATTDATE = '$forDate' and EMP_CODE='$emp_id'";
        }
        else
        {
          $forDate = str_replace('/', '-', $forDate);
        $forDate= date('Y-m-d', strtotime($forDate));
        $toDate = str_replace('/', '-', $toDate);
        $toDate= date('Y-m-d', strtotime($toDate));
       $sql="select CONVERT(VARCHAR(10),ATTDATE,102) as ATTDATE,CONVERT(VARCHAR(10),IN_TIME,108) as IN_TIME,CONVERT(VARCHAR(10),OUT_TIME,108) as OUT_TIME from CAttendanceqry where ((ATTDATE = '$forDate' and ATTDATE = '$toDate' ) or (ATTDATE between '$forDate' and '$toDate')) and EMP_CODE='$emp_id'";
        }
     // echo $sql;
    $resu = query($query,$sql,$pa,$opt,$ms_db);
    $row_count = sqlsrv_num_rows ($resu);
    if($row_count>0)
    {

        $row4=$fetch($resu);
        //echo $row4['IN_TIME'];
        $flag="You alredy mark your attendance Date: ".$row4['ATTDATE'];
       
        //."-".$row4['OUT_TIME'];
    }
    else
    {
      $flag="0";
    }

      
     return $flag;
    }

    function getMyTeamLeaveRequestDataManager($code){

      
       global $HTTP_HOST;
        global $query;
        global $sql;
        global $pa;
        global $opt;
        global $ms_db;
        global $fetch;

        $sql="select Levkey from Leave WHERE ApprovedBy='$code' group by Levkey";
       
        $res=query($query,$sql,$pa,$opt,$ms_db);
      // $Levkey_array=array();
        $count=0;
       while ($rows = $fetch($res)){
       $Levkey_val=$rows['Levkey'];
      // echo $Levkey_val."aaa";
          $sql1="select TOP 1 leaveID,CONVERT (VARCHAR(10),LvFrom,103 ) as LvFrom,CONVERT (VARCHAR(10),LvTo,103 ) as LvTo,LvDays,LvType,reason,ApprovedBy,status,Levkey,CreatedBy from Leave WHERE Levkey='$Levkey_val' order by leaveID DESC ";
           $res1=query($query,$sql1,$pa,$opt,$ms_db);
           //echo  $sql1;
      // $Levkey_array=array();
          while ($rows1 = $fetch($res1)){
             //echo $rows1['leaveID'];
            $leaveID[$count]=$rows1['leaveID'];
            $LvFrom[$count]=$rows1['LvFrom'];
            $LvTo[$count]=$rows1['LvTo'];
            $LvDays[$count]=$rows1['LvDays'];
            $LvType[$count]=$rows1['LvType'];
            $reason[$count]=$rows1['reason'];
            $ApprovedBy[$count]=$rows1['ApprovedBy'];
            $status[$count]=$rows1['status'];
            $Levkey[$count]=$rows1['Levkey'];
             $CreatedBy[$count]=$rows1['CreatedBy'];
            $count++;
          }
       }  
      
    return array($leaveID,$LvFrom,$LvTo,$LvDays,$LvType,$reason,$ApprovedBy,$status,$Levkey,$CreatedBy,$count);
    }


    function leaveApproveRequestWhenCancel($leaveID,$flag,$t){

      
       global $HTTP_HOST;
        global $query;
        global $sql;
        global $pa;
        global $opt;
        global $ms_db;
        global $fetch;
     $var=array();
         $sql="select CONVERT(VARCHAR(10),LvFrom,102) as LvFrom,CONVERT(VARCHAR(10),LvTo,102) as LvTo,LvType,LvDays,reason,CreatedBy,levKey,ApprovedBy from Leave WHERE leaveID='$leaveID'";
        $res=query($query,$sql,$pa,$opt,$ms_db);
        //echo  $sql;
        $row4=$fetch($res);
        $LvFrom=$row4['LvFrom'];
        $LvTo=$row4['LvTo'];
        $LvType=$row4['LvType'];
        $LvDays=$row4['LvDays'];
        $reason=$row4['reason'];
        $CreatedBy=$row4['CreatedBy'];
        $lvkey=$row4['levKey'];
        $ApprovedBy1=$row4['ApprovedBy'];
        $approver_email1=self::getemployee_email($ApprovedBy1);
           $approver_name1=self::getemployee_name($ApprovedBy1);
        //echo $sql;
        $update_sql = "UPDATE leave SET status='4',remark='$remark',updation_date=getdate() WHERE levkey='$lvkey'";
        $res1=query($query,$update_sql,$pa,$opt,$ms_db);
        //echo  $update_sql;
        $update_sql2 = "INSERT INTO leavehistory (flag,levkey) VALUES ('4','$lvkey')";
        $res2=query($query,$update_sql2,$pa,$opt,$ms_db);
        $sql="Select leaveID,ApprovedBy,status,flag from leave where levKey='$lvkey'";
        $res=query($query,$sql,$pa,$opt,$ms_db);
        $count=0;
        while ($rows = $fetch($res))
        {
           $ApprovedBy[$count]=$rows['ApprovedBy'];
            $count++;
        }
        //print_r($ApprovedBy);
        //echo  $update_sql2;
       for($i=0;$i<sizeof($ApprovedBy);$i++)
        {
          if($ApprovedBy[$i] !=$ApprovedBy1)
          {
           $approver_email=self::getemployee_email($ApprovedBy[$i]);
           $approver_name=self::getemployee_name($ApprovedBy[$i]);
            $creater_email=self::getemployee_email($CreatedBy);
            $creater_name=self::getemployee_name($CreatedBy);
            //echo $approver_email;
            $subject= "Cancel Leave Approved By - ".$approver_name1;
            $message="Dear ".$approver_name.",<br><br>";
            $message.="Cancel Leave Request approved from ".$LvFrom." to ".$LvTo." due to ".$remark." reason ";
            $message.="Regards,<br>";
            $message.=$approver_name1;
            $var[$ApprovedBy[$i].$t."a"]=array(
          "id"=>$ApprovedBy[$i],
            "email"=>$approver_email,
            "subject"=>$subject,
            "msg"=>$message
      );

          // echo  $message;
            // $mail1=mymailer('donotreply@sequelone.com',$subject,$message,$approver_email);
          }
        }
            $creater_email=self::getemployee_email($CreatedBy);
            $creater_name=self::getemployee_name($CreatedBy);
            //echo $approver_email;
            $subject= " Your Cancel Leave Approved By - ".$approver_name1;
            $message="Dear ".$creater_name.",<br><br>";
            $message.="Your Cancel Leave Request approved from ".$LvFrom." to ".$LvTo." due to ".$remark." reason ";
            $message.="Regards,<br>";
            $message.=$approver_name1;
            $var[$CreatedBy.$t."b"]=array(
      "id"=>$CreatedBy,
            "email"=>$creater_email,
            "subject"=>$subject,
            "msg"=>$message
      );
   
        return $var;   
  }
    

}

/*$var=array(

          "0"=> array(
                        "109100a"=>array(
                        "id"=>"10910",
                        "email"=>"himanshu@sequelone.com",
                        "subject"=>"",
                        "massege"=>""
                          ),
                        "109100b"=>array(
                        "id"=>"10910",
                        "email"=>"himanshu@sequelone.com",
                        "subject"=>"",
                        "massege"=>""
                          )
            ),
          "1"=> array(
                        "109100a"=>array(
                        "id"=>"10910",
                        "email"=>"himanshu@sequelone.com",
                        "subject"=>"",
                        "massege"=>""
                          ),
                        "109100b"=>array(
                        "id"=>"10910",
                        "email"=>"himanshu@sequelone.com",
                        "subject"=>"",
                        "massege"=>""
                          )
            )
  )*/
