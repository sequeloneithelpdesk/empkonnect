<?php
session_start();
include '../../db_conn.php';
include ('../../configdata.php');
include ('../../Attendance/Events/weekly_off.php');
include ('../../Attendance/Events/public_holidays.php');

$code= $_SESSION['usercode'];
$type =$_POST['type'];
if($type=="add")
{
$fromDate= dateConversion($_POST['fromDate']);
$daysval = $_POST['daysval'];
$reason = $_POST['reason'];
$week_val= $_POST['week_val'];
$plan_in=$_POST['plan_in'];
$plan_out=$_POST['plan_out'];
$actual_in=$_POST['actual_in'];
$actual_out=$_POST['actual_out'];
$level=$_POST['level'];
$lev = explode(',',$level);
 $checksql="select count(compOffId) as num from compOff where CreatedBy='$code' and wd_date='$fromDate' and action_status !='4' ";
$checkRes= query($query,$checksql,$pa,$opt,$ms_db);
$numAtten= $fetch($checkRes);
if($numAtten['num'] >= 1)
{
echo 2;
}
else
{
for($i=0;$i<count($lev);$i++){
if($i==0)
{
$flag= '1';
}
else
{
$flag= '0';
}
 $sql="insert into compOff (wd_date,reason,noOfDays,day_type,planned_INtime,planned_OUTtime,actual_INtime,actual_OUTtime
,CreatedBy,approvedBy,action_status,flag_val,CreatedOn) VALUES
('$fromDate','$reason','$daysval','$week_val','$plan_in','$plan_out','$actual_in','$actual_out','$code','$lev[$i]','1','$flag',GETDATE())";
$result = query($query,$sql,$pa,$opt,$ms_db);
if($result){
  echo 1;
  if($flag == 1){
  $queMail= "Select Emp_Name,OEMailID from HrdMastQry where Emp_Code ='$lev[$i]'";
  $resMail= query($query,$queMail,$pa,$opt,$ms_db);
  $appMail=$fetch($resMail);
  $requesterSql="Select Emp_Name,Emp_Code from HrdMastQry where Emp_Code ='$code'";
  $requesterRes = query($query,$requesterSql,$pa,$opt,$ms_db);
  $requesterRow= $fetch($requesterRes);
  $to=trim($appMail['OEMailID']);
  $mes = ucwords(strtolower($appMail[0])).",";
  $m =str_replace(' ', '', $mes);
  $subject= "Compensatory Off Request";
  $message="Dear ".$m."<br><br>";
  $message.="You are requested to approve my Compensatory Off Request for ".$_POST['fromDate']." due to  ";
  $message.=$reason.".";
  $message.="<br><br>";
  $message.="Regards <br>";
  $message.=$requesterRow[0]. "-";
  $message.=$requesterRow[1];
  $mail1=mymailer('donotreply@sequelone.com',$subject,$message,$appMail['OEMailID']);
  }
}
else
{
echo 0;
}
}
//echo 1;
}
}
else if($type=="workday"){
$fordate=$_POST['fromDate'];
$dateval=explode('/',$fordate);
//print_r($dateval);
$new_date=$dateval[2].'-'.$dateval[1].'-'.$dateval[0];
$var = getWeeklyOff($dateval[1],$dateval[2],$code);
//echo $dateval[1].$dateval[2];
$public_holidays= getHolidays($dateval[1],$dateval[2]);
//echo $new_date;
//print_r($var);
$array = array();
for($i=0;$i<count($var); $i++){
$array[] = $var[$i]['start'];
}
$array1 = array();
for($i=0;$i<count($public_holidays); $i++){
$array1[] = $public_holidays[$i]['start'];
}

if(in_array($new_date,$array)) 
{
  $daytype="Weekly Off";
}
else if(in_array($new_date,$array1))
{
   $daytype="Public Holidays";
}
else
{
   $daytype="Working day";
}
//echo $daytype;
if($daytype !== 'Working day') {

 $tym = array();
  // $sql="SELECT CONVERT(VARCHAR(8),PunchDate,108) as PunchDate FROM AttendanceAll  WHERE  EMP_CODE ='$code' and cast(PunchDate as date) = '$new_date' and  cast(PunchDate as time) IN (SELECT TOP 1 cast(MIN(PunchDate) as time) time FROM AttendanceAll WHERE EMP_CODE ='$code' and cast(PunchDate as date) = '$new_date'  UNION ALL  SELECT TOP 1 cast(MAX(PunchDate) as time) time  FROM AttendanceAll WHERE  EMP_CODE ='$code' and cast(PunchDate as date) = '$new_date') order by PunchDate asc";
   $sql="select CONVERT(VARCHAR(20),IN_TIME,120) as IN_TIME,CONVERT(VARCHAR(20),OUT_TIME,120) as OUT_TIME from CAttendanceqry where EMP_CODE='$code' and  attdate='$new_date'";

  $res=query($query,$sql,$pa,$opt,$ms_db);
  $attendance_row = sqlsrv_num_rows ($res);
/* for Mark Past Attendance */
  $mark_sql="Select AttnKey from markPastAttendance where CONVERT (date,date_from,103) <='$new_date' and CONVERT (date,date_to,103) >='$new_date' and CreatedBy ='$code' group by AttnKey";
  //echo $outOnDuty;
  $mark_res=query($query,$mark_sql,$pa,$opt,$ms_db);
  $mark_result = $fetch($mark_res);
  $AttnKey=$mark_result['AttnKey'];
  $mark_sql1="select top 1 case when  action_status =2 then intime end as intime,case when  action_status =2 then outtime end as outtime,case when  action_status =2 then Rflag end as Rflag from markPastAttendance WHERE AttnKey='$AttnKey' 
  order by markPastId DESC ";
   //   echo $mark_sql1;
  $mark_res1=query($query,$mark_sql1,$pa,$opt,$ms_db);
  $markPastAttendance_row = sqlsrv_num_rows ($mark_res1);
  //echo $markPastAttendance_row;
  /* out ON DUty */

  //echo $new_date;
  $outOnDuty="Select oDKey from outOnWorkRequest where CONVERT (date,date_from,103) <='$new_date' and CONVERT (date,date_to,103) >='$new_date' and CreatedBy ='$code' group by oDKey";
  //echo $outOnDuty;
  $oDres=query($query,$outOnDuty,$pa,$opt,$ms_db);
  $oDrows = $fetch($oDres);
  $oDKey=$oDrows['oDKey'];
  $outOnDuty1="select top 1 case when  action_status =2 then intime end as intime,case when  action_status =2 then outtime end as outtime,case when  action_status =2 then Rflag end as Rflag from outOnWorkRequest WHERE oDKey='$oDKey' 
  order by outWorkId DESC ";
      //echo $outOnDuty1;
  $res1=query($query,$outOnDuty1,$pa,$opt,$ms_db);
  $oDres_row = sqlsrv_num_rows ($res1);

  if($attendance_row > 0)
  {
      $result= $fetch($res);
     
      $outtime = strtotime($result['OUT_TIME']);
      $intime = strtotime($result['IN_TIME']);
      //echo  $result['OUT_TIME'];
       $timediff = abs($outtime - $intime)/3600;

     if($timediff >= 4){
        echo '1';
     }
     else{
      echo '0';
     }
 }
 else
 if($markPastAttendance_row > 0)
  {
       $mark_result= $fetch($mark_res1);
       $Rflag=$mark_result['Rflag'];
       if($Rflag == 1)
       {
        $new_date1 = date('Y-m-d', strtotime($new_date . ' +1 day'));
       // echo date("H:i", strtotime($oDrows_result['intime']));
       // echo date("H:i", strtotime($oDrows_result['outtime']));
        //echo "aaaaaa".$new_date1;
        $intime=$new_date." ".date("H:i", strtotime($mark_result['intime']));
        $outtime=$new_date1." ".date("H:i", strtotime($mark_result['outtime']));
       }
       else
       {
           $intime=$new_date." ".date("H:i", strtotime($mark_result['intime']));
           $outtime=$new_date." ".date("H:i", strtotime($mark_result['outtime']));
       }
     
      //echo $intime."qqqqq".$outtime;
      $outtime = strtotime($outtime);
     $intime = strtotime($intime);
     $timediff = abs($outtime - $intime)/3600;
     //echo "wwwwww".$timediff;
     if($timediff >= 4){
        echo '1';
     }
     else{
      echo '0';
     }

  }
  else if ($oDres_row > 0) {

       $oDrows_result = $fetch($res1);
       $Rflag=$oDrows_result['Rflag'];
       if($Rflag == 1)
       {
        $new_date1 = date('Y-m-d', strtotime($new_date . ' +1 day'));
       // echo date("H:i", strtotime($oDrows_result['intime']));
       // echo date("H:i", strtotime($oDrows_result['outtime']));
        //echo "aaaaaa".$new_date1;
        $intime=$new_date." ".date("H:i", strtotime($oDrows_result['intime']));
        $outtime=$new_date1." ".date("H:i", strtotime($oDrows_result['outtime']));
       }
       else
       {
           $intime=$new_date." ".date("H:i", strtotime($oDrows_result['intime']));
           $outtime=$new_date." ".date("H:i", strtotime($oDrows_result['outtime']));
       }
     
      //echo $intime."qqqqq".$outtime;
      $outtime = strtotime($outtime);
     $intime = strtotime($intime);
     $timediff = abs($outtime - $intime)/3600;
     //echo "wwwwww".$timediff;
     if($timediff >= 4){
        echo '1';
     }
     else{
      echo '0';
     }

    # code...
  }

}
else{
//$daytype='Working Day';
/*$sql="select Top 1 CONVERT(VARCHAR(8),ShiftFrom,108) as ShiftFrom ,CONVERT(VARCHAR(8),Shiftto,108) as Shiftto,CONVERT(VARCHAR(8),IN_TIME,108) as IN_TIME ,CONVERT(VARCHAR(8),OUT_TIME,108) as OUT_TIME from CAttendanceqry where EMP_CODE='$code' AND ATTDATE='$new_date'";
  $res=query($query,$sql,$pa,$opt,$ms_db);
  $row= $fetch($res);
  
  if($row[3] != '' && $row[2] != ''){
     $minhr = $row[3]-$row[2];
     $shiftin = strtotime($row[0]);
     $shiftout = strtotime($row[1]);
     $outtime = strtotime($row[3]);
     $intime = strtotime($row[2]);
     $timediff = abs($outtime - $intime)/3600;
     $shiftdiff = abs($shiftout - $shiftin)/3600;
     if(($timediff-$shiftdiff) >= 4){
        echo '1';
     }
     else{
      echo '0';
     }
     
  }
  else{
    echo '0';
  }*/
}
/* $empType;
$sql="select DISTINCT(GRD_Name)from HrdMastQry where EMP_CODE='$code'";
$res=query($query,$sql,$pa,$opt,$ms_db);
while($row= $fetch($res)){
$empType = $row['GRD_Name'];
}
if($empType=='APPRENTICE' && $daytype == 'Weekly Off'){
$sql="select CONVERT(VARCHAR(8),IN_TIME,108) as IN_TIME ,CONVERT(VARCHAR(8),OUT_TIME,108) as OUT_TIME from CAttendanceqry where EMP_CODE='$code' AND ATTDATE='$new_date'";
$res=query($query,$sql,$pa,$opt,$ms_db);
while($row= $fetch($res)){
echo '1';
}
}
else if($empType=='SALARIED' && $daytype == 'Weekly Off'){
$sql="select CAST(IN_TIME AS DATE) as IN_TIME ,CAST(OUT_TIME AS DATE) as OUT_TIME from CAttendanceqry where EMP_CODE='$code' AND ATTDATE='$new_date'";
$res=query($query,$sql,$pa,$opt,$ms_db);
while($row= $fetch($res)){
echo date("Y-m-d");
$diff=date_diff(date("Y-m-d"),strtotime('2016-09-16'));
echo $diff;
if($diff=='3'){
ECHO '1';
}
else{
echo '0';
}
}
}
else if($empType=='ASSOCIATES' && $daytype == 'Weekly Off'){
$sql="select CONVERT(VARCHAR(8),IN_TIME,108) as IN_TIME ,CONVERT(VARCHAR(8),OUT_TIME,108) as OUT_TIME from CAttendanceqry where EMP_CODE='$code' AND ATTDATE='$new_date'";
$res=query($query,$sql,$pa,$opt,$ms_db);
while($row= $fetch($res)){
$diff=date_diff($row[0],date("Y-m-d"));
echo $diff;
if($diff=='3'){
ECHO '1';
}
else{
echo '0';
}
}
}
else{
echo '0';
}*/
}
elseif($_POST['type'] == "usercancel")
{
$id=$_POST['id'];
$userCode=$_POST['code'];
$remrk=$_POST['remrk'];

$sql_q="select *,CONVERT(VARCHAR(10), wd_date,126) as wd_date from compOff where compOffId='$id'";
$res_g=query($query,$sql_q,$pa,$opt,$ms_db);
$row = $fetch($res_g);
$wd =$row['wd_date'];
$app = $row['approvedBy'];
$reason = $row['reason'];
//$wd = $thedate->format("Y-m-d");
//$wd= $row['wd_date'];


$sql="update compOff set action_status='4',UpdatedBy='$userCode',action_remark='$remrk' where CreatedBy='$userCode' AND CONVERT (DATE, wd_date)='$wd'";

$res=query($query,$sql,$pa,$opt,$ms_db);
if($res){
echo 1;

$aMail= "Select Emp_Name,OEMailID from HrdMastQry where Emp_Code ='$app'";
$resMail1= query($query,$aMail,$pa,$opt,$ms_db);
$appMail1=$fetch($resMail1);
$requesterSql1="Select Emp_Name,Emp_Code from HrdMastQry where Emp_Code ='$code'";
$requesterRes1 = query($query,$requesterSql1,$pa,$opt,$ms_db);
$requesterRow1= $fetch($requesterRes1);
$to=trim($appMail1['OEMailID']);
$mes = ucwords(strtolower($appMail1[0])).",";
$m =str_replace(' ', '', $mes);
$subject= "Compensatory Off Request Cancelled";
$message="Dear ".$m."<br><br>";
$message.="I cancelled my applied Compensatory Off Request due to ".$remrk." for ".$wd." due to  ";
$message.=$reason.".";
$message.="<br><br>";
$message.="Regards <br>";
$message.=$requesterRow1[0]. "-";
$message.=$requesterRow1[1];
$mail1=mymailer('donotreply@sequelone.com',$subject,$message,$appMail1['OEMailID']);





}else{
echo 0;
}
}
else if ($_POST['type'] == "searchMyStatus") {
$statusid= $_POST['statusid'];
$userCode=$_POST['code'];
if($statusid !=""){
$sql="select *,CONVERT (VARCHAR(10),wd_date,103 ) as work_date,CONVERT (VARCHAR(10),CreatedOn,103 ) as CreatedOn  from  compOff where action_status='$statusid' and CreatedBy='$userCode' AND flag_val='1'";
}
else{
  $sql="select *,CONVERT (VARCHAR(10),wd_date,103 ) as work_date,CONVERT (VARCHAR(10),CreatedOn,103 ) as CreatedOn  from  compOff where  CreatedBy='$userCode' AND flag_val='1'";
}

$res=query($query,$sql,$pa,$opt,$ms_db);
while($row= $fetch($res)){
$usercode=$row['approvedBy'];
$sql1="select EMP_NAME from HrdMastQry WHERE Emp_Code='$usercode'";
$res1=query($query,$sql1,$pa,$opt,$ms_db);
$data1=$fetch($res1);
$i=0;
echo "<tr>
  <td>
    ". $row['CreatedOn']."
  </td>
  <td>
    ". $data1['EMP_NAME']."
  </td>
  <td>
    ".$row['work_date']."
  </td>
  <td>
    ".$row['noOfDays']."
  </td>
  <td>
    ".$row['reason']."
  </td>
  <td>";
    if($row['action_status'] == "1" || $row['action_status'] == ""){
    echo" <a class='myod' data-toggle='modal' href='#large'
      onclick='getmypastId('".$row['compOffId']."','1',' ".$userCode."')'>
      <span class='label label-sm bg-blue-steel'>
      Pending </span>
    </a> ";
    } else if($row['action_status'] == "2") {
    echo" <a class='myod' data-toggle='modal' href='#large'
      onclick='getmypastId('".$row['compOffId']."','2','".$userCode."')''>
      <span class='label label-sm label-success'>
        Approved
      </span>
    </a>";
    } else if($row['action_status'] == "3") {
    echo" <a class='myod' data-toggle='modal' href='#large'
      onclick='getmypastId('".$row['compOffId']."','3','".$userCode."')'>
      <span class='label label-sm label-danger'>
        Rejected
      </span>
    </a>";
    } else if($row['action_status'] == "4") {
    echo" <a class='myod' data-toggle='modal' href='#large'
      onclick='getmypastId('".$row['compOffId']."','4','".$userCode."')'>
      <span class='label label-sm bg-grey-cascade'>
        Cancelled
      </span>
    </a>";
    }
  echo " </td>
</tr>";
$i++;
}
}
else if ($_POST['type'] == "searchMyName") {
 $codename= $_POST['codename'];
$userCode=$_POST['code'];
if($codename != '0'){
 $sql="select *,CONVERT (VARCHAR(10),wd_date,103 ) as wd_date,CONVERT (VARCHAR(10),CreatedOn,103 ) as CreatedOn from  compOff where (approvedBy='$codename' or approvedBy=(select emp_code from HrdMastQry where EMP_NAME='$codename')) and CreatedBy='$userCode' and flag_val='1'";
}else{
   $sql="select *,CONVERT (VARCHAR(10),wd_date,103 ) as wd_date,CONVERT (VARCHAR(10),CreatedOn,103 ) as CreatedOn from  compOff where CreatedBy='$userCode' and flag_val='1'";
}

$res=query($query,$sql,$pa,$opt,$ms_db);
while($row= $fetch($res)){
$usercode1=$row['approvedBy'];
$sql1="select EMP_NAME from HrdMastQry WHERE Emp_Code='$usercode1'";
$res1=query($query,$sql1,$pa,$opt,$ms_db);
$data1=$fetch($res1);
$i=0;
echo "<tr>
<td>
 ". $row['CreatedOn']."
</td>
  <td>
    ". $data1['EMP_NAME']."
  </td>
  <td>
    ".$row['wd_date']."
  </td>
  <td>
    ".$row['noOfDays']."
  </td>
  <td>
    ".$row['reason']."
  </td>
  <td>";
    if($row['action_status'] == "1" || $row['action_status'] == ""){
    echo" <a class='myod' data-toggle='modal' href='#large'
      onclick='getmypastId('".$row['compOffId']."','1',' ".$userCode."')'>
      <span class='label label-sm bg-blue-steel'>
      Pending </span>
    </a> ";
    } else if($row['action_status'] == "2") {
    echo" <a class='myod' data-toggle='modal' href='#large'
      onclick='getmypastId('".$row['compOffId']."','2','".$userCode."')''>
      <span class='label label-sm label-success'>
        Approved
      </span>
    </a>";
    } else if($row['action_status'] == "3") {
    echo" <a class='myod' data-toggle='modal' href='#large'
      onclick='getmypastId('".$row['compOffId']."','3','".$userCode."')'>
      <span class='label label-sm label-danger'>
        Rejected
      </span>
    </a>";
    } else if($row['action_status'] == "4") {
    echo" <a class='myod' data-toggle='modal' href='#large'
      onclick='getmypastId('".$row['compOffId']."','4','".$userCode."')'>
      <span class='label label-sm bg-grey-cascade'>
        Cancelled
      </span>
    </a>";
    }
  echo " </td>
</tr>";
$i++;
}
}
else if ($_POST['type'] == "searchMyDate") {
$userCode=$_POST['code'];
//$wd= $row['wd_date'];
if ($_POST['fd'] == "" && $_POST['td'] == "") {
$sql="select *,CONVERT (VARCHAR(10),wd_date,103 ) as wd_date,CONVERT (VARCHAR(10),CreatedOn,103 ) as CreatedOn from  compOff where CreatedBy='$userCode' and flag_val='1'";
}
elseif ($_POST['fd']=="") {
$todate=$_POST['td'];
$fromdate =$_POST['fd'];
$sql="select *,CONVERT (VARCHAR(10),wd_date,103 ) as wd_date,CONVERT (VARCHAR(10),CreatedOn,103 ) as CreatedOn from  compOff where CONVERT(DATE,CreatedOn) = '$todate' and CreatedBy='$userCode' and flag_val='1'";
}elseif($_POST['td']==""){
$fromdate =$_POST['fd'];
$todate=$_POST['td'];
$sql="select *,CONVERT (VARCHAR(10),wd_date,103 ) as wd_date,CONVERT (VARCHAR(10),CreatedOn,103 ) as CreatedOn from  compOff where CONVERT(DATE,CreatedOn) = '$fromdate' and CreatedBy='$userCode' and flag_val='1'";
}
else{
$todate=$_POST['td'];
$fromdate =$_POST['fd'];
$sql="select *,CONVERT (VARCHAR(10),wd_date,103 ) as wd_date,CONVERT (VARCHAR(10),CreatedOn,103 ) as CreatedOn from  compOff where CONVERT(DATE,CreatedOn) >= '$fromdate' and
CONVERT(DATE,CreatedOn) <= '$todate' and CreatedBy='$userCode' and flag_val='1'";
}
$res=query($query,$sql,$pa,$opt,$ms_db);
while($row= $fetch($res)){
$usercode=$row['approvedBy'];
$sql1="select EMP_NAME from HrdMastQry WHERE Emp_Code='$usercode'";
$res1=query($query,$sql1,$pa,$opt,$ms_db);
$data1=$fetch($res1);
$i=0;
echo "<tr>
<td>
    ". $row['CreatedOn']."
  </td>
  <td>
    ". $data1['EMP_NAME']."
  </td>
  <td>
    ".$row['wd_date']."
  </td>
  <td>
    ".$row['noOfDays']."
  </td>
  <td>
    ".$row['reason']."
  </td>
  <td>";
    if($row['action_status'] == "1" || $row['action_status'] == ""){
    echo" <a class='myod' data-toggle='modal' href='#large'
      onclick='getmypastId('".$row['compOffId']."','1',' ".$userCode."')'>
      <span class='label label-sm bg-blue-steel'>
      Pending </span>
    </a> ";
    } else if($row['action_status'] == "2") {
    echo" <a class='myod' data-toggle='modal' href='#large'
      onclick='getmypastId('".$row['compOffId']."','2','".$userCode."')''>
      <span class='label label-sm label-success'>
        Approved
      </span>
    </a>";
    } else if($row['action_status'] == "3") {
    echo" <a class='myod' data-toggle='modal' href='#large'
      onclick='getmypastId('".$row['compOffId']."','3','".$userCode."')'>
      <span class='label label-sm label-danger'>
        Rejected
      </span>
    </a>";
    } else if($row['action_status'] == "4") {
    echo" <a class='myod' data-toggle='modal' href='#large'
      onclick='getmypastId('".$row['compOffId']."','4','".$userCode."')'>
      <span class='label label-sm bg-grey-cascade'>
        Cancelled
      </span>
    </a>";
    }
  echo " </td>
</tr>";
$i++;
}
}
else if($_POST['type']=="allcheck"){
  $userCode=$_POST['userCode'];
  $status=$_POST['status'];
  $sql="select compOffId from compOff  WHERE approvedBy='$userCode' and action_status = '$status'";
  $res=query($query,$sql,$pa,$opt,$ms_db);
  $count = $num($res);
  if($count == 1)
  {
    $row=$fetch($res);
    echo $row['compOffId'];
  }
  else
  {
        while ($row=$fetch($res)) 
        {
          echo $row['compOffId'].",";
        }
  }
}
else if($_POST['type']=="mulcheck"){
$userCode=$_POST['userCode'];
$inputval=$_POST['inputval'];
$status=$_POST['status'];
$remark=$_POST['remark'];
$sql="update compOff set action_status='$status',action_remark='$remark' WHERE approvedBy='$userCode' and compOffId IN ($inputval) ";
$res=query($query,$sql,$pa,$opt,$ms_db);
if($res){
echo 1;
$ids = explode(',',$inputval);
for($i=0;$i<count($ids);$i++){
//$nextid = $ids[$i]+1;
$sql_i="select CONVERT (VARCHAR(10),wd_date,120 ) as wd_date,CreatedBy  from  compOff where compOffId='$ids[$i]'";
$res_i=query($query,$sql_i,$pa,$opt,$ms_db);
$data=$fetch($res_i);
$pre_wd =$data['wd_date'];
$cby =$data['CreatedBy'];
$sql_id="select compOffId from  compOff where wd_date='$pre_wd' AND CreatedBy='$cby' And compOffId>'$ids[$i]'";
$res_id=query($query,$sql_id,$pa,$opt,$ms_db);
$data1=$fetch($res_id);
$nextid=$data1['compOffId'];
$sql1="update compOff set flag_val='1' WHERE compOffId='$nextid' AND wd_date='$pre_wd'";
$res1=query($query,$sql1,$pa,$opt,$ms_db);
}
}else{
echo 0;
}
}
elseif ($_POST['type'] == "searchStatus") {
$statusid= $_POST['statusid'];
$loginUser=$_POST['code'];
if( $statusid== ''){
  $sql="select *,CONVERT (VARCHAR(10),wd_date,103 ) as work_date,CONVERT (VARCHAR(10),CreatedOn,103 ) as CreatedOn  from  compOff where approvedBy='$loginUser' AND flag_val='1'";

}
else{
$sql="select *,CONVERT (VARCHAR(10),wd_date,103 ) as work_date,CONVERT (VARCHAR(10),CreatedOn,103 ) as CreatedOn  from  compOff where action_status='$statusid' and approvedBy='$loginUser' AND flag_val='1'";

}
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
  ".$row['CreatedOn']."
</td>
<td>
  ".$data1['EMP_NAME']."
</td>
<td>
  ".$row['work_date']."
</td>
<td>
  ".$row['noOfDays']."
</td>
<td>
  ".$row['reason']."
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
  if($codename != '0'){
 $sql="select *,CONVERT (VARCHAR(10),wd_date,103 ) as wd_date , CONVERT (VARCHAR(10),CreatedOn,103 ) as CreatedOn from  compOff where approvedBy='$loginUser' and (CreatedBy in (select emp_code from HrdMastQry where Emp_FName='$codename' or Emp_MName='$codename' or Emp_LName='$codename') or CreatedBy='$codename') and flag_val='1'";
  }else{
     $sql="select *,CONVERT (VARCHAR(10),wd_date,103 ) as wd_date , CONVERT (VARCHAR(10),CreatedOn,103 ) as CreatedOn from  compOff where approvedBy='$loginUser' and flag_val='1'";
  }
  
    $res=query($query,$sql,$pa,$opt,$ms_db);
    while($row= $fetch($res)){
        
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
                                  ".$row['wd_date']." 
                            </td>
                             <td>
                                  ".$row['noOfDays']." 
                            </td>
                             <td>
                                  ".$row['reason']." 
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
                             
                            </tr>";
                            $i++;
       
            }      
}


elseif ($_POST['type'] == "searchName") {
echo $codename= $_POST['codename'];
echo $userCode=$_POST['code'];
$sql="select *,CONVERT (VARCHAR(10),wd_date,103 ) as wd_date,CONVERT (VARCHAR(10),CreatedOn,103 ) as CreatedOn from  compOff where (approvedBy='$userCode' or approvedBy=(select emp_code from HrdMastQry where EMP_NAME='$userCode')) and (CreatedBy='$codename' or CreatedBy=(select emp_code from HrdMastQry where EMP_NAME='$codename')) and flag_val='1'";
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
".$row['CreatedOn']."
</td>
<td>
".$data1['EMP_NAME']."
</td>
<td>
".$row['wd_date']."
</td>
<td>
".$row['noOfDays']."
</td>
<td>
".$row['reason']."
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

</tr>";
$i++;
}
}

else if($_POST['type']=="AppStatus"){
    $id=$_POST['mycompId'];
    $status_code=$_POST['status_code'];
    $code=$_POST['code'];
    $loginuser=$_POST['user'];
    $remrk=$_POST['remrk'];


    $sql="update compOff set action_status='$status_code',action_remark='$remrk' where compOffId='$id'";
    //echo $sql;
    $res=query($query,$sql,$pa,$opt,$ms_db);
    if($res){

          $getSql="select *,CONVERT(varchar(10),wd_date,103) as wd_date,CONVERT(varchar(10),CreatedOn,103) as CreatedOn from compOff where compOffId='$id'";
            $getResSql=query($query,$getSql,$pa,$opt,$ms_db);
             
        if($getResSql){
                 while ($valC=$fetch($getResSql)) {
                    $reqMail= "Select OEMailID,EMP_NAME from HrdMastQry where Emp_Code='".$code."'";
                    $apprName= "Select EMP_NAME from HrdMastQry where Emp_Code='".$loginuser."'";
                    $resMail= query($query,$reqMail,$pa,$opt,$ms_db);
                    $nameMail= query($query,$apprName,$pa,$opt,$ms_db);

                    $rMail=$fetch($resMail);
                    $name=$fetch($nameMail);


                    if($valC['action_status'] == '2'){
                        $approveAction="Approved";
                    }else{
                        $approveAction="Rejected";
                    }
                    

                    $to=trim($rMail['OEMailID']);
                    $mes = ucwords(strtolower($rMail['EMP_NAME'])).",";
                    $m =str_replace(' ', '', $mes);
                    $subject= "Approved Compensatory Off Request";
                    $message="Dear ".$m."<br><br>";
                    $message.="Your request for Compensatory Off  for ".$valC['wd']." due to ";
                    $message.=$valC['reason'] ."Has been ".$approveAction.".<br><br>";
                    $message.="Regards<br>".ucwords(strtolower($name['EMP_NAME']));
                    $mail1=mymailer('donotreply@sequelone.com',$subject,$message,'monika@sequelone.com');

                 
        }
    }
  
     // print_r($var);
     echo 1;  
    }else{
        echo 0;
    }
}

elseif ($_POST['type'] == "searchDate") {
$fromDate= $_POST['fromDate'];
$toDate = $_POST['toDate'];
$loginUser = $_POST['code'];

 if ($fromDate == "" && $toDate == "") {
            $sql="select *,CONVERT (VARCHAR(10),wd_date,103 ) as wd_date,CONVERT (VARCHAR(10),CreatedOn,103 ) as CreatedOn from  compOff where approvedBy='$loginUser' and flag_val='1'";
        } 
       elseif ($fromDate=="") {
            $sql="select *,CONVERT (VARCHAR(10),wd_date,103 ) as wd_date,CONVERT (VARCHAR(10),CreatedOn,103 ) as CreatedOn from  compOff where CONVERT(DATE,CreatedOn) = '$toDate' and approvedBy='$loginUser' and flag_val='1'";
        }elseif($toDate==""){
       
        $sql="select *,CONVERT (VARCHAR(10),wd_date,103 ) as wd_date,CONVERT (VARCHAR(10),CreatedOn,103 ) as CreatedOn from  compOff where CONVERT(DATE,CreatedOn) = '$fromDate' and approvedBy='$loginUser' and flag_val='1'";
        }
        else{
           $sql="select *,CONVERT (VARCHAR(10),wd_date,103 ) as wd_date,CONVERT (VARCHAR(10),CreatedOn,103 ) as CreatedOn from  compOff where CONVERT(DATE,CreatedOn) >= '$fromDate' and CONVERT(DATE,CreatedOn) <= '$toDate' and approvedBy='$loginUser' and flag_val='1'";;
        }
           

$res=query($query,$sql,$pa,$opt,$ms_db);
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
".$row['CreatedOn']."
</td>
<td>
".$data1['EMP_NAME']."
</td>
<td>
".$row['wd_date']."
</td>
<td>
".$row['noOfDays']."
</td>
<td>
".$row['reason']."
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

</tr>";
$i++;
}
}
else if ($_POST['type'] == "time") {
  //echo "sachin";
$fordate=$_POST['fromDate'];
$dateval=explode('/',$fordate);
//print_r($dateval);
$new_date=$dateval[2].'-'.$dateval[1].'-'.$dateval[0];
$var = getWeeklyOff($dateval[1],$dateval[2],$code);
//echo $dateval[1].$dateval[2];
$public_holidays= getHolidays($dateval[1],$dateval[2]);
//echo $new_date;
//print_r($var);
$array = array();
for($i=0;$i<count($var); $i++){
$array[] = $var[$i]['start'];
}
$array1 = array();
for($i=0;$i<count($public_holidays); $i++){
$array1[] = $public_holidays[$i]['start'];
}

if(in_array($new_date,$array)) 
{
  $day="Weekly Off";
}
else if(in_array($new_date,$array1))
{
   $day="Public Holidays";
}
else
{
   $day="Working day";
}
//print_r($array1);
/*$array = array();
if (in_array(array('start' => $new_date),$var))
    {
      echo "sa";
      $dayType="Weekly Off";
    }
   else if (in_array(array('start' => $new_date),$public_holidays))
    {
      echo "Sac";
      $dayType="Public Holidays";
    }
    else{
    
      $dayType="Working day";
    }*/
//echo $dayType;

if($day == 'Working Day'){
    echo "<table width='100%' cellpadding='0' cellspacing='2' border='0' id='detailtable'>
  <tbody><tr>
  <th style='text-align:left'>Day Type</th>
  <th style='text-align:left'>Planned In Time</th>
  <th style='text-align:left'>Planned Out Time </th>
  <th style='text-align:left'>Actual In Time</th>
  <th style='text-align:left'>Actual Out Time </th>
  </tr>";
  $sql="select Top 1 CONVERT(VARCHAR(8),ShiftFrom,108) as ShiftFrom ,CONVERT(VARCHAR(8),Shiftto,108) as Shiftto,CONVERT(VARCHAR(8),IN_TIME,108) as IN_TIME ,CONVERT(VARCHAR(8),OUT_TIME,108) as OUT_TIME from CAttendanceqry where EMP_CODE='$code' AND ATTDATE='$new_date'";
  $res=query($query,$sql,$pa,$opt,$ms_db);
  while($row= $fetch($res)){
  echo "<tr>
  <td>";
  echo $day;
  echo  "</td>
  <td>";
  echo $row[0];
  echo  "</td>
  <td>";
  echo $row[1];
  echo  "</td>
  <td>";
  echo $row[2];
  echo  "</td>
  <td>";
  echo $row[3];
  echo  "</td>
  </tr>";
  }
}
else{
   echo "<table width='100%' cellpadding='0' cellspacing='2' border='0' id='detailtable'>
  <tbody><tr>
  <th style='text-align:left'>Day Type</th>
  
  <th style='text-align:left'>Actual In Time</th>
  <th style='text-align:left'>Actual Out Time </th>
  </tr>";
 // $sql="SELECT CONVERT(VARCHAR(8),PunchDate,108) as PunchDate FROM AttendanceAll  WHERE  EMP_CODE ='$code' and cast(PunchDate as date) = '$new_date' and  cast(PunchDate as time) IN (SELECT TOP 1 cast(MIN(PunchDate) as time) time FROM AttendanceAll WHERE EMP_CODE ='$code' and cast(PunchDate as date) = '$new_date'  UNION ALL  SELECT TOP 1 cast(MAX(PunchDate) as time) time  FROM AttendanceAll WHERE  EMP_CODE ='$code' and cast(PunchDate as date) = '$new_date') order by PunchDate asc";
   $sql="select CONVERT(VARCHAR(8),IN_TIME,108) as IN_TIME,CONVERT(VARCHAR(8),OUT_TIME,108) as OUT_TIME from CAttendanceqry where EMP_CODE='$code' and  attdate='$new_date'";
   //echo $sql;

  $res=query($query,$sql,$pa,$opt,$ms_db);
  $attendance_row = sqlsrv_num_rows ($res);
/* for Mark Past Attendance */
  $mark_sql="Select AttnKey from markPastAttendance where CONVERT (date,date_from,103) <='$new_date' and CONVERT (date,date_to,103) >='$new_date' and CreatedBy ='$code' group by AttnKey";
  //echo $outOnDuty;
  $mark_res=query($query,$mark_sql,$pa,$opt,$ms_db);
  $mark_result = $fetch($mark_res);
  $AttnKey=$mark_result['AttnKey'];
  $mark_sql1="select top 1 case when  action_status =2 then intime end as intime,case when  action_status =2 then outtime end as outtime,case when  action_status =2 then Rflag end as Rflag from markPastAttendance WHERE AttnKey='$AttnKey' 
  order by markPastId DESC ";
   //   echo $mark_sql1;
  $mark_res1=query($query,$mark_sql1,$pa,$opt,$ms_db);
  $markPastAttendance_row = sqlsrv_num_rows ($mark_res1);


  $outOnDuty="Select oDKey from outOnWorkRequest where CONVERT (date,date_from,103) <='$new_date' and CONVERT (date,date_to,103) >='$new_date' and CreatedBy ='$code' group by oDKey";
  //echo $outOnDuty;
  $oDres=query($query,$outOnDuty,$pa,$opt,$ms_db);
  $oDrows = $fetch($oDres);
  $oDKey=$oDrows['oDKey'];
  $outOnDuty1="select top 1 case when  action_status =2 then intime end as intime,case when  action_status =2 then outtime end as outtime,case when  action_status =2 then Rflag end as Rflag from outOnWorkRequest WHERE oDKey='$oDKey' 
  order by outWorkId DESC ";
      //echo $outOnDuty1;
  $res1=query($query,$outOnDuty1,$pa,$opt,$ms_db);
  $oDres_row = sqlsrv_num_rows ($res1);

  $var = "<tr>";
  $var.="<td>";
  $var.=$day;
  $var.="</td>";
  if($attendance_row >0)
  {
    $row= $fetch($res);
   $var.="<td>";
    $var.=$row['IN_TIME'];
    $var.="</td>";
    $var.="<td>";
    $var.=$row['OUT_TIME'];
    $var.="</td>";
  }
  else if($markPastAttendance_row >0)
  {
   
    $mark_result= $fetch($mark_res1);
    $var.="<td>";
    $var.=$mark_result['intime'];
    $var.="</td>";
    $var.="<td>";
    $var.=$mark_result['outtime'];
    $var.="</td>";
    
  }
  else if ($oDres_row > 0) {

      $oDrows_result = $fetch($res1);
      $intime=$oDrows_result['intime'];
      $outtime=$oDrows_result['outtime'];
      $var.="<td>";
      $var.=$intime;
      $var.="</td>";
      $var.="<td>";
      $var.=$outtime;
      $var.="</td>";
    # code...
  }
  $var.="</tr>";
echo $var;
}

}

else if($_POST['type'] == "appMainContent"){
    $loginUser = $_POST['userCode'];
    $sql="select *,CONVERT(varchar(10), wd_date, 103) as wd_date,CONVERT(varchar(10), CreatedOn, 103) as CreatedOn from compOff WHERE approvedBy='$loginUser' and flag_val='1'";
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
                                  ".$row['wd_date']."
                            </td>
                            <td>
                                ".$row['noOfDays']."
                                
                            </td>
                             <td>
                                ".$row['reason']."
                                
                            </td>
                            
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


else if($_POST['type'] == "myMainContent")
{
$loginUser = $_POST['userCode'];
$sql="select *,CONVERT (VARCHAR(10),wd_date,103) as work_done,CONVERT (VARCHAR(10),CreatedOn,103) as CreatedOn from compOff WHERE CreatedBy='$code' and flag_val='1'";
$res=query($query,$sql,$pa,$opt,$ms_db);
while($row=$fetch($res))
{

echo" <tr>";
echo "<td>";
echo $row['CreatedOn'];
echo "</td>";
echo" <td>";
$mngrcode=$row['approvedBy'];
$sql1="select EMP_NAME from HrdMastQry WHERE Emp_Code='$mngrcode'";
$res1=query($query,$sql1,$pa,$opt,$ms_db);
$data1=$fetch($res1);
echo $data1['EMP_NAME'];
echo "</td>
<td>";
echo $row['work_done'];
echo "</td>
<td>";
echo $row['noOfDays'];
echo "</td>
<td>  ";
echo $row['reason'];
echo "</td>
<td>";
if($row['action_status'] == "1")
  {?>
  <a class='myod' data-toggle='modal' href='#large'
    onclick="getmycompoffId('<?php echo $row['compOffId'];?>','1','<?php echo $loginUser;?>');">
    <span class='label  bg-blue-steel'>
    Pending </span>
  </a> <?php
  }else if($row['action_status'] == "2") {?>
  <a class='myod' data-toggle='modal' href='#large'
    onclick="getmycompoffId('<?php echo $row['compOffId'];?>','2','<?php echo $loginUser;?>');">
    <span class='label  label-success'>
      Approved
    </span>
  </a><?php
  } else if($row['action_status'] == "3") {?>
  <a class='myod' data-toggle='modal' href='#large'
    onclick="getmycompoffId('<?php echo $row['compOffId'];?>','3','<?php echo $loginUser;?>');">
    <span class='label  label-danger'>
      Rejected
    </span>
  </a><?php
  } else if($row['action_status'] == "4") {?>
  <a class='myod' data-toggle='modal' href='#large'
    onclick="getmycompoffId('<?php echo $row['compOffId'];?>','4',
    '<?php echo $loginUser;?>');">
    <span class='label bg-grey-cascade'>
      Cancelled
    </span>
  </a><?php
}?>
<?php
echo"</td>

</tr>";

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