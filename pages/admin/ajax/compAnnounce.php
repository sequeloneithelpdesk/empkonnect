<?php
include("../../db_conn.php");
include('../../configdata.php');

$status = $_POST['status_val'];
$message = $_POST['editorText'];
$ftdate = $_POST['fdate'];
$date = $_POST['tdate'];

if($status == 'edit')
{
    echo $id = $_POST['id'];
    $sqlq = "Update CompAnnounce set AnnouncementMessage='$message', AnnounceDate=convert(datetime,'$fdate',3), EndAnnounceDate=convert(datetime,'$tdate',3) where id='$id'";
    $resultq=query($query,$sqlq,$pa,$opt,$ms_db);
    if($resultq){
        echo "success";
    }

}
else{
    $sqlq = "INSERT INTO CompAnnounce(AnnouncementMessage,AnnounceDate,EndAnnounceDate) VALUES ( '$message',convert(datetime,'$fdate',3),convert(datetime,'$tdate',3) )";
    $resultq=query($query,$sqlq,$pa,$opt,$ms_db);
    if($resultq){
        echo "success";
    }

}

?>