<?php
if($_POST['pagetype']== "insertData") {
    $empCode = $_POST['empCode']; //alert();
    $mStatus = $_POST['mStatus'];
    $statusCode = $_POST['statusCode'];
    $doj = $_POST['doj'];
    $dojWef = $_POST['dojWef'];
    $dol = $_POST['dol'];
    $dos = $_POST['dos'];
    $dor = $_POST['dor'];

    $mngrCode = $_POST['mngrCode'];
    $mngrCode2 = $_POST['mngrCode2'];
    $compCode = $_POST['compCode'];
    $bussCode = $_POST['bussCode'];
    $locCode = $_POST['locCode'];
    $wLocCode = $_POST['wLocCode'];
    $grdCode = $_POST['grdCode'];
    $empTypeCode = $_POST['empTypeCode'];
    $functCode = $_POST['functCode'];
    $subFunctCode = $_POST['subFunctCode'];
    $costCode = $_POST['costCode'];
    $procCode = $_POST['procCode'];
    $roleCODE = $_POST['roleCODE'];
    $oEmail = $_POST['oEmail'];

    $sql = "INSERT INTO `emphrdmast`(`empCode`, `statusCode`, `doj`, `dojWef`, `dor`, `dol`, `dos`,  `mStatus`, `oEmail`) VALUES ('$empCode','$statusCode', '$doj', '$dojWef', '$dor',  '$dol', '$dos', '$mStatus', '$oEmail')";
    $sql1 = "INSERT INTO `emphrdtran`(`empCode`,`trnWef`,`trnDate` ,`statusCode`, `grdCode`, `compCode`, `locCode`, `costCode`, `procCode`, `functcode`, `subFunctCode`, `wLocCode`, `bussCode`, `empTypeCode`, `roleCODE`, `mngrCode`, `mngrCode2`) VALUES ('$empCode','$dojWef',now(), '$statusCode', '$grdCode', '$compCode', '$locCode', '$costCode', '$procCode', '$functCode', '$subFunctCode', '$wLocCode', '$bussCode', '$empTypeCode', '$roleCODE', '$mngrCode', '$mngrCode2')";
$result = query($query,$sql,$pa,$opt,$ms_db);
    if ($result) {
        $user = "user";
        if ($oEmail == "") {
            $email = "";
            $flag = 0;
        } else {
            $email = md5($oEmail);
            $flag = 1;
        }
        echo $sql2 = "INSERT INTO `hrms_users`(`userID`,`userEmail`,`userActive` ,`userType`,flag) 
						VALUES ('" . md5($empCode) . "','$email','$statusCode', '$user',$flag)";
        $result = query($query,$sql2,$pa,$opt,$ms_db);

        if ($result) {
            echo json_encode(array('status' => TRUE, 'text' => "Data updated sucessfully."));
        } else {
            echo json_encode(array('status' => FALSE, 'text' => "Data not updated in Transection Table", 'error' => "There is some problem: " . "<br>" . $conn->error));

        }

        $result2= query($query,$sql1,$pa,$opt,$ms_db);
        if ($result2 == TRUE) {
            echo json_encode(array('status' => TRUE, 'text' => "Data updated sucessfully."));
        } else {
            echo json_encode(array('status' => FALSE, 'text' => "Data not updated in Transection Table", 'error' => "There is some problem: " . "<br>" . $conn->error));

        }

    } else {
        echo json_encode(array('status' => FALSE, 'text' => "Data not updated in Master Table", 'error' => "There is some problem: " . "<br>" . $conn->error));

    }

}
?>