<?php
    session_start();
    include ('../db_conn.php');
    include ('../configdata.php');
    $menuid=$_POST['id'];
    $username=$_SESSION['usercode'];
    $_SESSION['selectedRole'] = $menuid;
    //print_r($menu);


?>
