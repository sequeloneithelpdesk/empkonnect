<?php

function query1 ($query,$q,$p,$op,$db){
  if($db== '' || $p==''||$op==''){
    $result= $query($q);
  }
  else {
    $result = $query($db, $q, $p, $op);
  }
  return $result ;
}

/* $subject='Welcome message';
     $data=  Array
(
    "98273" => Array
        (
            "Emp Code" => '98273',
            "First Name" => 'Sunil1',
            "Company Email" => 'himanshu@agnitioworld.com'
        ),

    "98274" => Array
        (
            "Emp Code" => '98274',
            "First Name" => 'Virendra2',
            "Company Email" => 'himanshu@agnitioworld.com'
        ),

    "98275" => Array
        (
            "Emp Code" => '98275',
            "First Name" => 'Sanjay3',
            "Company Email" => 'himanshu@agnitioworld.com'
        )

);
 */
//foreach($data as $k=>$value){
	//$msg=welcome_msg($k);
      //      $to=$value['Company Email'];
		//	mymailer('donotreply@sequelone.com',$subject,$msg,$to);
//}
           // mymailer('donotreply@sequelone.com',$subject,$data);
        
function mymailer($from,$subject,$emailAllList){
    //$from = 'donotreply@sequelone.com';

    //$subject = $status;

    $headers  = "MIME-Version: 1.0\r\n";

    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    //require_once('PHPMailer/class.phpmailer.php');
    require '../../../PHPMailer/PHPMailerAutoload.php';

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

    

    foreach ($emailAllList as $key=>$to_add) {
       // $to_add['']
        $mail->Body = welcome_msg($key);
		$mail->AddAddress($to_add['Company Email']);
        //$mail->AddAddress($emailAllList);
		$mail->Send();
	}
		
         

    //}

   

}
function welcome_msg($code){

$html="<p>Dear Employee,</p>

<p><b>Welcome to empkonnect portal !!!</b> </p>


<p>We are pleased to announce launch of the CNHI empkonnect portal. We are going live with the Employee Self-Service Portal, which provides access to a comprehensive centralized repository of vital employee related information available to you, managers and all colleagues within CNHI who have access to empkonnect. 
</p>
<p>
We hope you will enjoy your browsing experience and find the tool useful.

</p>
<p>
Please save below mentioned login information for future use:
</p>

URL: http://10.240.168.94/ 

<p>
Click on below link to generate the password.
</p>
https://empkonnect.sequelone.com/pages/login/resetPass.php?usercode=$code;


<p>
Kindly review your individual profile and update personal Information; and ensure that it remains updated at all times. 
</p>

<p>
Regards,<br>
Team HR  </p>
";

return $html ;
}


?>