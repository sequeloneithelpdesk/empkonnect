<?php

// Include confi.php
include_once('confi.php');

if($_SERVER['REQUEST_METHOD'] == "GET"){
    $uid = isset($_GET['id']) ? mysql_real_escape_string($_GET['id']) : "";
    $status = isset($_GET['status']) ? mysql_real_escape_string($_GET['status']) : "";

    // Add your validations
    if(!empty($uid)){
        $qur = mysql_query("UPDATE  `users` SET  `status` =  '$status' WHERE  `users`.`ID` ='$uid';");
        if($qur){
            $json = array("status" => 1, "msg" => "Status updated!!.");
        }else{
            $json = array("status" => 0, "msg" => "Error updating status");
        }
    }else{
        $json = array("status" => 0, "msg" => "User ID not define");
    }
}else{
    $json = array("status" => 0, "msg" => "User ID not define");
}
@mysql_close($conn);

/* Output header */
header('Content-type: application/json');
echo json_encode($json);

?>