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
        if($status[0]==4)
        {
          
           $reApplyLeaveRequestCanceled=$leave_class_obj->reApplyLeaveRequestCanceled($leaveID,$ApprovedBy,$lvkey);
           echo json_encode($reApplyLeaveRequestCanceled);
           // print_r($reApplyLeaveRequestCanceled);
        }
        

?>
