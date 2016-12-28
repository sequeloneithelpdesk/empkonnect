<?php
include ('../../db_conn.php');
$user_name    =    $conn->real_escape_string($_POST['user_name']);
    $sqlUser='SELECT role_name FROM hrms_role WHERE role_name = "'.$user_name.'"';
    $resUser=$conn->query($sqlUser);
    if($resUser === false) {
        trigger_error('Error: ' . $conn->error, E_USER_ERROR);
    } else {
        echo $rows_returned = $resUser->num_rows;
    }


?>