<?php
include 'db_conn.php';
global $HTTP_HOST;
global $query;
global $sql;
global $pa;
global $opt;
global $ms_db;
global $fetch;
$HTTP_HOST = $_SERVER['HTTP_HOST'];

$user="H";
$comp_code="ABC";

function query ($query,$q,$p,$op,$db){
    if($db== '' || $p==''||$op==''){
        $result= $query($q);
    }
    else {
        $result = $query($db, $q, $p, $op);
    }
    return $result ;
}

//mymailer('Info.nhindia@cnhind.com','Test mail','This is test mail','abhinav.sareen@external.cnhind.com');


mymailer('donotreply@sequelone.com','Test mail','This is test mail','abhinav.sareen@external.cnhind.com');

function mymailer($from,$subject,$message,$emailAllList){
       $headers  = "MIME-Version: 1.0\r\n";

    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    //require_once('PHPMailer/class.phpmailer.php');
    require 'PHPMailer/PHPMailerAutoload.php';

    //smtpmailer($to, 'donotreply@sequelone.com', 'Shipment', $status, $message);

    global $error;

    $mail = new PHPMailer();  // create a new object

    $mail->IsSMTP(); // enable SMTP

    $mail->SMTPDebug = 2;  // debugging: 1 = errors and messages, 2 = messages only

    $mail->SMTPAuth = true;  // authentication enabled

    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail ssl
		
    //$mail->Host = '10.240.168.91';
   
    //$mail->Port = 25;
    // $mail->Host = 'smtp.gmail.com';

    // $mail->Port = 587;

    //$mail->Username = 'Info.nhindia@cnhind.com';

    //$mail->Password = 'Welcome123';
	$mail->Host = '103.25.131.92';

    $mail->Port = 465;

    $mail->Username = 'donotreply@sequelone.com';

    $mail->Password = 'Sequ&l@Ne11??';
    $mail->SetFrom($from);

    $mail->Subject = $subject;

    $mail->IsHTML(true);

    $mail->Body = $message;

    //foreach ($emailAllList as $to_add) {

    $mail->AddAddress($emailAllList);

    //}
//$mail->Send();
    if($mail->Send()){
echo"mail send";
}
else{
echo"not send".$mail->error ;
}


}

    ?>