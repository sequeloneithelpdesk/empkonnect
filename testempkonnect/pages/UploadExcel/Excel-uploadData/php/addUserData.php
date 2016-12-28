<?php
session_start();
include '../../db_conn.php';

$getdata = $_POST['phpDataArray'];
echo json_encode($getdata);


?>