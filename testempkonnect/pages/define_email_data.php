<?php
class define_email_data 
{
    function __construct() 
    {
        
    }
    var $leave_from_emailID=""; // email id which will used to send email

    function get_email_details_from_email_data($leaveType,$forDate,$toDate,$noOfDays,$reason,$requesterID)
    {
            $leave_from_emailID='donotreply@sequelone.com';
            $subject= $leaveType ." ".$forDate." ".$toDate;
            $message="Dear,  ,<br>";
            $message.="You are requested to approve my ".$leaveType." from ".$forDate." to ".$toDate." for ".$noOfDays."due to the reason mentioned below <br>";
            $message.=$reason ."<br>";
            $message.="Regards,<br>".$requesterID;
            //exit;
       return array($leave_from_emailID,$subject,$message);  
    }
	
}

?>
