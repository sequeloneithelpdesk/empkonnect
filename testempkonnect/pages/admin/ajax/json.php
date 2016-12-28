<?php
include("../../db_conn.php");
include('../../configdata.php');

$update_call = $_POST['call_val'];
    if($update_call=="1")
    {
        $user_id = $_POST['u_ID'];
        $update_status = $_POST['status_update'];
        $sql = "Update Company_login_mst SET status='$update_status' where id='$user_id'";
        $result = query($query,$sql,$pa,$opt,$ms_db);
        if ($result) {
            echo "Success";
        } else {
            echo "failure";
        }
    }
    else {
        $sql1="select * from PasswordPolicy";
        $res1=query($query,$sql1,$pa,$opt,$ms_db);
        $countRow=$num($res1);
        if ($countRow == 0) {
            $pass_length = $_POST['passLength'];
        $alpha_radio = $_POST['alpha_radio'];
        $uppercase_radio = $_POST['uppercase_radio'];
        $lowercase_radio = $_POST['lowercase_radio'];
        $number_radio = $_POST['number_radio'];
        $special_characters = $_POST['special_characters'];
        $alphabet = $_POST['alphabet'];
        $upper_letter = $_POST['upper_letter'];
        $lower_letter = $_POST['lower_letter'];
        $no_number = $_POST['no_number'];
        $special = $_POST['special'];
        $change_password_days = $_POST['change_password_days'];
        $earlier_password_use = $_POST['earlier_password_use'];
        $userid_case_sensitive = $_POST['userid_case_sensitive'];
        $change_password_days_status = $_POST['change_password_days_status'];
        $earlier_password_use_status = $_POST['earlier_password_use_status'];
        $userid_sensitive_status = $_POST['userid_sensitive_status'];
        $locked_userid_attempts = $_POST['invalidAttempts'];
        $locked_userid_minutes = $_POST['invalidTime'];
        $locked_userid_status = $_POST['locked_userid_status'];
        $userid_auto_unlock = $_POST['autounlock'];
        $userid_unlock_status = $_POST['userid_unlock_status'];
        $password_reset_link = $_POST['password_reset_link'];
        $password_reset_link_status = $_POST['password_reset_link_status'];
        $password_reset_ques = $_POST['password_reset_ques1'];
        $password_reset_ques1_status = $_POST['password_reset_ques1_status'];
        $ask_for_otp = $_POST['ask_for_otp'];
        $ask_for_otp_status = $_POST['ask_for_otp_status'];
        

       $sql = "INSERT INTO PasswordPolicy (password_length,alphabet_radio,uppercase_radio,lowercase_radio,number_radio,special_radio,num_alphabets,num_uppercase_char,num_lowercase_char,num_numbers,num_special_char,change_password_days,change_password_days_status,earlier_password_use,earlier_password_use_status,userid_case_sensitive,userid_sensitive_status,locked_userid_attempts,locked_userid_minutes,locked_userid_status,userid_auto_unlock,userid_unlock_status,password_reset_link,password_reset_link_status,password_reset_ques,password_reset_ques_status,ask_for_otp,ask_for_otp_status,status) 
               VALUES ('$pass_length','$alpha_radio','$uppercase_radio','$lowercase_radio','$number_radio',
               '$special_characters','$alphabet','$upper_letter','$lower_letter','$no_number','$special',
               '$change_password_days','$change_password_days_status','$earlier_password_use','$earlier_password_use_status','$userid_case_sensitive','$userid_sensitive_status','$locked_userid_attempts','$locked_userid_minutes',
                 '$locked_userid_status','$userid_auto_unlock','$userid_unlock_status','$password_reset_link',
                 '$password_reset_link_status','$password_reset_ques','$password_reset_ques1_status','$ask_for_otp',
                 '$ask_for_otp_status', '1')";

        $result = query($query,$sql,$pa,$opt,$ms_db);
        if ($result) {
            echo "1";
        } else {
            echo "0";
        }

        }
        else{
            echo "2";
        }
    }


?>