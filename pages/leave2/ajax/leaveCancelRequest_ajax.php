<?php 

include ('leave_class.php');
$leave_class_obj=new leave_class();
if (isset($_REQUEST['lvkey']) && !empty($_REQUEST['lvkey'])) 
{
  
  $lvkey=$_REQUEST['lvkey'];
  
}else
{  
    $lvkey=0;
}
if (isset($_REQUEST['remark']) && !empty($_REQUEST['remark'])) 
{
  
  $remark=$_REQUEST['remark'];
  
}else
{  
    $remark=0;
}
//echo $lvkey;
//$getMyteamLeaveRequestData=$leave_class_obj->cancelLeaveRequestFirstStep($lvkey);
  //print_r($getMyteamLeaveRequestData);
 $sql="Select leaveID,ApprovedBy,status,flag from leave where levKey='$lvkey'";
     // echo $sql;
        $res=query($query,$sql,$pa,$opt,$ms_db);
      // $Levkey_array=array();
       $count=0;
       while ($rows = $fetch($res))
       {
         $status[$count]=$rows['status'];
         $leaveID[$count]=$rows['leaveID'];
          $ApprovedBy[$count]=$rows['ApprovedBy'];
           $flag[$count]=$rows['flag'];
         $count++;
       }
        if(end($status)==2)
        {
          
           $cancelLeaveRequestWhenBothApproved=$leave_class_obj->cancelLeaveRequestWhenBothApproved($leaveID,$ApprovedBy,$remark,$lvkey,$flag);
            echo json_encode($cancelLeaveRequestWhenBothApproved);
           // print_r($cancelLeaveRequestWhenBothApproved);
        }
        else if($status[0]==1)
        {
          
            $cancelLeaveRequestWhenBothNotApproved=$leave_class_obj->cancelLeaveRequestWhenBothNotApproved($leaveID,$ApprovedBy,$remark,$lvkey);
             echo json_encode($cancelLeaveRequestWhenBothNotApproved);
           // print_r($cancelLeaveRequestWhenBothNotApproved);
        }
        else
        {
          $cancelLeaveRequestWhenBothApproved=$leave_class_obj->cancelLeaveRequestWhenBothApproved($leaveID,$ApprovedBy,$remark,$lvkey,$flag);
           echo json_encode($cancelLeaveRequestWhenBothApproved);
           // print_r($cancelLeaveRequestWhenBothApproved);
        }

      
/*print_r($leaveID);
print_r($status);
if(isset($status[1]==2) && $status[2] == 2) {
  echo "sachin";*/
    // do something

?>
