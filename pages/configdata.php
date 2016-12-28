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

function mymailer($from,$subject,$message,$emailAllList){
    //$from = 'donotreply@sequelone.com';
    //echo $from.$subject.$message.$emailAllList;
    //$subject = $status;

    $headers  = "MIME-Version: 1.0\r\n";

    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    //require_once('PHPMailer/class.phpmailer.php');
    require 'PHPMailer/PHPMailerAutoload.php';

    //smtpmailer($to, 'donotreply@sequelone.com', 'Shipment', $status, $message);

    global $error;

    $mail = new PHPMailer();  // create a new object

    $mail->IsSMTP(); // enable SMTP

    $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only

    $mail->SMTPAuth = true;  // authentication enabled

    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail ssl

    $mail->Host = '103.25.131.92';

    $mail->Port = 465;

    $mail->Username = 'donotreply@sequelone.com';

    $mail->Password = 'Sequ&l@Ne11??';

    // $mail->Host = 'smtp.gmail.com';

    // $mail->Port = 587;

    // $mail->Username = 'er.himanshurawat@gmail.com';

    // $mail->Password = '***';

    $mail->SetFrom($from);

    $mail->Subject = $subject;

    $mail->IsHTML(true);

    $mail->Body = $message;

    //foreach ($emailAllList as $to_add) {

    $mail->AddAddress($emailAllList);

    //}

    $mail->Send();


}

//welcome_msg('10910');
function welcome_msg($code,$default){
    global $HTTP_HOST;
    global $query;
    global $sql;
    global $pa;
    global $opt;
    global $ms_db;
    global $fetch;
    $sql="select * from HrdMastQry where EMP_CODE = '".$code."'";
    //var_dump($sql);die;
    $res= query($query,$sql,$pa,$opt,$ms_db);
    while($row = $fetch($res)){
       //var_dump($row);die;
        $name = $row['EMP_NAME'];
    }

$html="<p>Dear ".ucwords(strtolower($name)).",</p>

<p><b>Welcome to empkonnect portal !</b> </p>


<p>We are pleased to announce the launch of CNHI Time-Office solution. We are going live with the Employee Self-Service Portal, which provides an access to a comprehensive centralized repository of vital employee related information along with Leave and Time Management Portal.
</p>
<p>
We hope you will enjoy your browsing experience and find the tool useful.

</p>

<p>
Please save below mentioned login information for future use: 
</p>

<p><b>
User Name: $code
</b></p>";
if($default != "no"){
"<p><b>
User Default Password: $default
</b></p>";
}else if($default == "no"){
"
<p>
Click on below link to generate the password.
</p>
<a href=\"https://".$HTTP_HOST."/pages/login/resetPass.php?usercode=$code\">Generate Password</a>


<p>
Kindly review your profile and update the information if required. 
</p>

<p>
Regards,<br>
Team HR  </p>
";
}
 return $html ;
 //   echo $html;
}

//echo welcome_msg('111');
function mymail($from,$data){
    $len = count($data);
    //$from = 'donotreply@sequelone.com';

    //$subject = $status;

    $headers  = "MIME-Version: 1.0\r\n";

    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    //require_once('PHPMailer/class.phpmailer.php');
    require 'PHPMailer/PHPMailerAutoload.php';

    //smtpmailer($to, 'donotreply@sequelone.com', 'Shipment', $status, $message);

    global $error;

    $mail = new PHPMailer();  // create a new object

    $mail->IsSMTP(); // enable SMTP

    $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only

    $mail->SMTPAuth = true;  // authentication enabled

    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail ssl

    $mail->Host = '103.25.131.92';

    $mail->Port = 465;

    $mail->Username = 'donotreply@sequelone.com';

    $mail->Password = 'Sequ&l@Ne11??';


    $mail->SetFrom($from);
    for($i=0; $i< $len; $i++){
        foreach ($data[$i] as $to_add) {
			$mail2 = clone $mail;
//print_r($to_add);
        $mail2->Subject = $to_add['subject'];
        $mail2->IsHTML(true);
        $mail2->Body = $to_add['msg'];
        $mail2->AddAddress($to_add['email']);
		
		
         $mail2->Send();

        }
    }
   


}

function wishmailer($from,$name,$subject,$message,$emailAllList,$reply){
    //$from = 'donotreply@sequelone.com';

    //$subject = $status;
    //echo $emailAllList;

    $headers  = "MIME-Version: 1.0\r\n";

    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    //require_once('PHPMailer/class.phpmailer.php');
    require 'PHPMailer/PHPMailerAutoload.php';

    //smtpmailer($to, 'donotreply@sequelone.com', 'Shipment', $status, $message);

    global $error;

    $mail = new PHPMailer();  // create a new object

    $mail->IsSMTP(); // enable SMTP

    $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only

    $mail->SMTPAuth = true;  // authentication enabled

    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail ssl

    $mail->Host = '103.25.131.92';

    $mail->Port = 465;

    $mail->Username = 'donotreply@sequelone.com';

    $mail->Password = 'Sequ&l@Ne11??';

    // $mail->Host = 'smtp.gmail.com';

    // $mail->Port = 587;

    // $mail->Username = 'er.himanshurawat@gmail.com';

    // $mail->Password = '***';

    $mail->SetFrom($from);
    $mail->AddReplyTo($reply);

    $mail->Subject = $subject;

    $mail->IsHTML(true);

    $mail->Body = $message;

    //foreach ($emailAllList as $to_add) {

    $mail->AddAddress(trim($emailAllList));
    //$mail->AddAddress('monika@sequelone.com');

    //}

    if(!$mail->Send()){
        //echo "FALSE";
        echo json_encode(array('status'=>FALSE,'result'=>'Mail not sent'));
    }else{
        //echo "TRUE";
        echo json_encode(array('status'=>TRUE,'result'=>'Mail sent successfully'));
    }


}

?>