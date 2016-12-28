<?php
include '../../../db_conn.php';
include '../../../configdata.php';
$owlocCode =$_POST['owlocCode']; 
$resultq=false;
if(isset($owlocCode) and !empty($owlocCode)){
 	$wlocCode = $_POST['wlocCode'];
	$wlocName = $_POST['wlocName'];
	$wlocType = $_POST['wlocType'];
	$wlocParent = $_POST['wlocParent'];
	$wlocWork = $_POST['wlocWork'];
	$WLOC_ADD1 = $_POST['wlocAdd1'];
	$WLOC_ADD2 = $_POST['wlocAdd2'];
	$wlocCity = $_POST['wlocCity'];
	$wlocState = $_POST['wlocState'];
	$wlocPin = $_POST['wlocPin'];
	$wlocCountry = $_POST['wlocCountry'];
	$sql="Update WorkLocMast SET WLOC_CODE = '$wlocCode', WLOC_NAME = '$wlocName', 
									WLOC_TYPE = '$wlocType', 
									WLOC_PARENT_LOCATION = '$wlocParent',
									WLOC_WORK = '$wlocWork',
									WLOC_ADD1 = '$WLOC_ADD1', 
									WLOC_ADD2 = '$WLOC_ADD2',  
									WLOC_CITY = '$wlocCity', 
									WLOC_STATE = '$wlocState',  
									WLOC_PIN = '$wlocCountry',
									WLOC_COUNTRY = '$wlocCountry' WHERE WLOC_CODE='$owlocCode'";
	$resultq= query($query,$sql,$pa,$opt,$ms_db);
}
if($resultq === false){
	die();
}else{
	echo "Form submitted.";
}
?>