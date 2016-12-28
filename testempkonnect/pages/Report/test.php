<?php
//session_start();
include('../db_conn.php');
include('../configdata.php');
//$code=$_SESSION['usercode'];
$c_val = 'end1234';

$sql3="select EMP_CODE from empnameqry ";
$result3 = query($query,$sql3,$pa,$opt,$ms_db);
//$row3 = $fetch($result3);
//print_r($row3);
while($row=$fetch($result3)){
	echo $row[0];
}

?>