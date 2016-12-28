<?php
include '../../../db_conn.php';
include '../../../configdata.php';
$id=$_POST['locId'];
if(isset($id) and !empty($id)){
	$LOC_CODE =$_POST['locCode'];
	$LOC_NAME = $_POST['locName'];
	$LOC_TYPE = $_POST['locType'];
	$LOC_PARENT = $_POST['locParent'];
	$WORK_LOC = $_POST['locWork'];
	$LOC_ADDR1 = $_POST['locAdd1'];
	$LOC_ADDR2 = $_POST['locAdd2'];
	$CITY = $_POST['locCity'];
	$LOC_STATE = $_POST['locState'];
	$PIN_CODE = $_POST['locPin'];
	$COUNTRY = $_POST['locCountry'];
	$PF_CODE = $_POST['locPfCode'];
	$ESI_CODE = $_POST['locEsiCode'];
	$sql="Update LocMast SET 
				LOC_CODE = '$LOC_CODE', 
				LOC_NAME = '$LOC_NAME', 
				LOC_TYPE = '$LOC_TYPE', 
				LOC_PARENT = '$LOC_PARENT',
				WORK_LOC = '$WORK_LOC',
				LOC_ADDR1 = '$LOC_ADDR1', 
				LOC_ADDR2 = '$LOC_ADDR2',  
				CITY = '$CITY', 
				LOC_STATE = '$LOC_STATE',  
				PIN_CODE = '$PIN_CODE', 
				COUNTRY = '$COUNTRY',
				PF_CODE = '$PF_CODE',
				ESI_CODE = '$ESI_CODE' WHERE LOC_CODE='$id'";
	$resultq= query($query,$sql,$pa,$opt,$ms_db);
}
if($resultq === false){
	die();
}else{
	echo "Form submitted.";
}
 
?>