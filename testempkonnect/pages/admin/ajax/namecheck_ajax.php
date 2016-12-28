<?php
include ('../../db_conn.php');
include ('../../configdata.php');
$user_name    =   $_POST['user_name'];
     $sqlUser="SELECT role_name FROM hrms_role WHERE role_name = '".$user_name."'";
    $resUser=query($query,$sqlUser,$pa,$opt,$ms_db);
    if($resUser) {
        echo $rows_returned = $num($resUser);

    } else {
        echo "Error";
    }


?>