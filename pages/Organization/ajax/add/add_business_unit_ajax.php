<?php
session_start();
include '../../../db_conn.php';
include_once '../../../configdata.php';
$bussCode=$_POST['bussCode'];
if(isset($_POST['bussName']) && !empty($_POST['bussName']) ){
    
    //$pa1 = array();
    //$stmt = sqlsrv_query($conn, $sql, $params);
    $stmt=query($query,$sql,$pa,$opt,$ms_db);
    if($stmt === false){
        die();
    }else{
        echo "Form submitted.";
    }    
}
?>