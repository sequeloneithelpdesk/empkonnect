<?php
include("../../db_conn.php");
include('../../configdata.php');

$status = $_POST['status_val'];
$message = $_POST['editorText'];
$fdate = $_POST['fdate'];
$tdate = $_POST['tdate'];
$department = $_POST['depart'];

$split_depart = explode(",",$department);


if($status == 'edit')
{
    echo $id = $_POST['id'];
    echo $fdate;
    $sqlq = "Update DeptNotification set notifyTo='$split_depart[0]',deptID='$split_depart[1]', notifyDate=convert(datetime,'$fdate',3),
    notification='$message', EndnotifyDate=convert(datetime,'$tdate',3) where id='$id'";
    $resultq=query($query,$sqlq,$pa,$opt,$ms_db);
    if($resultq){
        echo "success";
    }

}
else
{
    $sqlq = "INSERT INTO DeptNotification(uid,notifyTo,deptID,status,notifyDate,notification,EndnotifyDate) VALUES 
(NULL,'$split_depart[0]','$split_depart[1]','1',convert(datetime,'$fdate',3),'$message',convert(datetime,'$tdate',3))";
    $resultq=query($query,$sqlq,$pa,$opt,$ms_db);
    if($resultq){
        echo "success";
    }

}



?>