<?php
include ('../../db_conn.php');
include ('../../configdata.php');
$user_name    =   $_POST['user_name'];
$table_name    =   $_POST['table_name'];
$col_name    =   $_POST['col_name'];
$sqlUser="SELECT $col_name FROM $table_name WHERE $col_name = '".$user_name."'";
$resUser=query($query,$sqlUser,$pa,$opt,$ms_db);
if($resUser) {
    echo $rows_returned = $num($resUser);

} else {
   echo"error";
}


?>