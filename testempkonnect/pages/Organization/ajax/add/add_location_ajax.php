<?php
include '../../../db_conn.php';
include_once '../../../configdata.php';
//$resize = json_decode($_POST[name_print]);
$sql = "INSERT INTO locMast (LOC_CODE, LOC_NAME, LOC_TYPE, LOC_PARENT, WORK_LOC, LOC_ADDR1, LOC_ADDR2,CITY,LOC_STATE, PIN_CODE, COUNTRY, PF_CODE, ESI_CODE) VALUES ('$_POST[locCode]',' $_POST[locName]',' $_POST[locType]',' $_POST[locParent]',' $_POST[locWork]',' $_POST[locAdd1]',' $_POST[locAdd2]',' $_POST[locCity]',' $_POST[locState]',' $_POST[locPin]',' $_POST[locCountry]',' $_POST[locPfCode]',' $_POST[locEsiCode]')";
//$params = array();
$stmt=query($query,$sql,$pa,$opt,$ms_db);
if( $stmt === false ) {
    die();
}else{
    echo "Form submitted.";
    exit;
}
 
?>