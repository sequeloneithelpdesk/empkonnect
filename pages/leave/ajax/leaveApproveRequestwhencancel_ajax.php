<?php 
include ('leave_class.php');
$leave_class_obj=new leave_class();

if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) 
{
  
  $leave_id=$_REQUEST['id'];
  $leave_id = explode(',', $leave_id);
  //$cuisines1 = rtrim(implode(',', $cuisines), ',');
  
}else
{  
    $leave_id=0;
}
if (isset($_REQUEST['status_flag']) && !empty($_REQUEST['status_flag'])) 
{
  
  $status_flag=$_REQUEST['status_flag'];
  
}else
{  
    $status_flag=0;
}
if (isset($_REQUEST['remark']) && !empty($_REQUEST['remark'])) 
{
  
  $remark=$_REQUEST['remark'];
  
}else
{  
    $remark=0;
}
//print_r($leave_id);
//echo $leave_id."ppp".$status_flag;
if($status_flag==3)
{
  //echo "q";
  $count=0;
  for($i=0;$i<sizeof($leave_id);$i++)
  {
    //echo "bbbb".$leave_id[$i];
    $leaveApproveRequestWhenReject=$leave_class_obj->CancelleaveApproveRequestWhenReject($leave_id[$i],$status_flag,$remark,$i);
           $temp[$count]=$leaveApproveRequestWhenReject;
          // print_r($leaveApproveRequestWhenReject);
    $count++;
  }
  //print_r($temp);
  mymail('donotreply@sequelone.com',$temp);
  
    $flag=1;
 
   echo json_encode($flag);
}

else if($status_flag==2)
{
    $count=0;
  for($i=0;$i<sizeof($leave_id);$i++)
  {
   // echo "qqqq".$leave_id[$i];
     $leaveApproveRequestWhenApprove=$leave_class_obj->leaveApproveRequestWhenApprove($leave_id[$i],$status_flag,$i);
           $temp[$count]=$leaveApproveRequestWhenApprove;
		  //print_r($temp);
          // print_r($leaveApproveRequestWhenReject);
		  $count++;
  }
  mymail('donotreply@sequelone.com',$temp);
  
    $flag=1;
 
   echo json_encode($flag);
}

?>
