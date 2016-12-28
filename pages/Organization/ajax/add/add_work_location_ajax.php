<?php
include '../../../db_conn.php';
include_once '../../../configdata.php';
//To Add Work Location
if(isset($_POST['wlocCode']) and !empty($_POST['wlocCode'])){
	$sql = "INSERT INTO WorkLocMast(WLOC_CODE, WLOC_NAME, WLOC_TYPE, WLOC_PARENT_LOCATION, WLOC_WORK, WLOC_ADD1, WLOC_ADD2, WLOC_CITY, WLOC_STATE, WLOC_PIN, WLOC_COUNTRY) values ('$_POST[wlocCode]',' $_POST[wlocName]',' $_POST[wlocType],$_POST[wlocParent],$_POST[wlocWork],$_POST[wlocAdd1],$_POST[wlocAdd2],$_POST[wlocCity],$_POST[wlocState],$_POST[wlocPin]',' $_POST[wlocCountry]')";
        //$params = array();
 	 	$stmt=query($query,$sql,$pa,$opt,$ms_db);
	  	if($stmt === false){
	        die();
	    }else{
	        echo "Form submitted.";
	    }
 }
?>