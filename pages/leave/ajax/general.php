<?php 
include ('leave_class.php');
$leave_class_obj=new leave_class();

if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) 
{
  
  $emp_id=$_REQUEST['id'];
  
  //$cuisines1 = rtrim(implode(',', $cuisines), ',');
  
}else
{  
    $emp_id=0;
}
if (isset($_REQUEST['forDate']) && !empty($_REQUEST['forDate'])) 
{
  
  $forDate=$_REQUEST['forDate'];
  
}else
{  
    $forDate="";
}
if (isset($_REQUEST['toDate']) && !empty($_REQUEST['toDate'])) 
{
  
  $toDate=$_REQUEST['toDate'];
  
}else
{  
    $toDate="";
}

//echo $emp_id."ppp".$forDate."qqq".$toDate;

  $getMyAttendanceByDate=$leave_class_obj->getMyAttendanceByDate($emp_id,$forDate,$toDate);
           $flag=$getMyAttendanceByDate;
          // print_r($leaveApproveRequestWhenReject);
  
 
   echo $flag;


?>
