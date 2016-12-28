<?php 

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

$current_date=date('Y-m-d');
$pre_current_date=date('Y-m-d', strtotime($current_date . ' -30 day'));
$next_current_date=date('Y-m-d', strtotime($current_date . ' +30 day'));
$forDate = str_replace('/', '-', $forDate);
$forDate= date('Y-m-d', strtotime($forDate));
$toDate = str_replace('/', '-', $toDate);
$toDate= date('Y-m-d', strtotime($toDate));
//$pre_datefrom=date('Y-m-d', strtotime($forDate . ' -30 day'));
//$next_datefrom=date('Y-m-d', strtotime($forDate . ' +30 day'));
//$pre_dateto=date('Y-m-d', strtotime($toDate . ' -30 day'));
//$next_dateto=date('Y-m-d', strtotime($toDate . ' +30 day'));
//echo $forDate."qqq".$pre_current_date;

if(strtotime($pre_current_date) <= strtotime($forDate) && strtotime($next_current_date) >= strtotime($forDate))
{
  $flag=1;
}
 else
 {
  $flag=0;
 }

 
echo json_encode($flag);
?>
