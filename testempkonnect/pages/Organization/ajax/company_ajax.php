<?php
include ('../../db_conn.php');
include ('../../configdata.php');
$flag_value = $_POST['flag_value'];
if ($flag_value == 'StateID' || $flag_value == 'StateID2') {
    $country = $_POST['country'];
    $count_val = explode(",", $country);
    $queryState = "SELECT DISTINCT(State_Name),stateID FROM StateMast where Country_Id ='$count_val[0]'";
    $resultq=query($query,$queryState,$pa,$opt,$ms_db);
    echo '<option value="">Select State</option>';
    while( $row = $fetch($resultq)) {
        echo'<option value="' . $row['stateID'] . '">';
            echo $row['State_Name'];
            echo '</option>';
         }
}

if ($flag_value == 'CityID' || $flag_value == 'CityID2') {
$state = $_POST['state'];
$queryCity = "SELECT DISTINCT(City_NAME),CityID FROM CityMast where State_Id =  '$state'";
    $resultq=query($query,$queryCity,$pa,$opt,$ms_db);
echo '<option value="">Select</option>';
    while( $row = $fetch($resultq)) {

echo'<option value="' . $row['CityID'] . '">';
    echo $row['City_NAME'];
    echo '</option>';
}
}


