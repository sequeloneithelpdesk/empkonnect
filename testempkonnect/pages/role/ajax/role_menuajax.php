<?php

include ('../../db_conn.php');

// $json = file_get_contents('../js/menujson.json'); 
// $data = json_encode($json,true);
$sql="select menu from hrms_menu ";
$result= $conn->query($sql);
$product=$result->fetch_assoc();


$data = $product['menu'];
echo $data ;
//print_r($data);
?>