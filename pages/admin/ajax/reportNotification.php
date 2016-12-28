<?php
include("../../db_conn.php");
include('../../configdata.php');
session_start();
$code = $_SESSION['usercode'];


echo $status = $_POST['status_val'];
echo $message = $_POST['editor'];
$fdate = $_POST['fdate'];
$tdate = $_POST['tdate'];
$department = $_POST['depart'];




if($status == 'edit')
{
    echo $id = $_POST['id'];
    echo $fdate;
    echo $sqlq = "Update DeptNotification set deptId='$code',notifyTo='$department', notifyDate=convert(datetime,'$fdate',3),
    notification='$message', EndnotifyDate=convert(datetime,'$tdate',3),notify_type='rpt' where id='$id'";
    $resultq=query($query,$sqlq,$pa,$opt,$ms_db);
    if($resultq){
        echo "success";
    }

}
else
{
    echo $sqlq = "INSERT INTO DeptNotification(uid,deptId,notifyTo,status,notifyDate,notification,EndnotifyDate,notify_type) VALUES 
(NULL,'$code','$department','1',convert(datetime,'$fdate',3),'$message',convert(datetime,'$tdate',3),'rpt')";
    $resultq=query($query,$sqlq,$pa,$opt,$ms_db);
    if($resultq){
        echo "success";
    }

}



?>