<?php 
session_start();
include('../../db_conn.php');
include('../../configdata.php');

$code=$_SESSION['usercode'];

$sql="select EMP_NAME,Emp_Code from hrdmastqry where MNGR_CODE='$code'";

$result=query($query,$sql,$pa,$opt,$ms_db);

if ($num($result) > 0) {
      echo 1;
    }
else{
    echo 2 ;
}



?>