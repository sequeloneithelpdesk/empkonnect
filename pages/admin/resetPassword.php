<?php
/**
 * Created by PhpStorm.
 * User: monika
 * Date: 22-06-2016
 * Time: 10:45
 */

session_start();
include ('../db_conn.php');
include ('../configdata.php');

ini_set('session.gc_maxlifetime',1);

if($_POST['action'] == "reset")
{
  $user_id = $_POST['uid'];
  $hash_user=md5($user_id);
  $newpass = $_POST['new_password'];
  $confpass = $_POST['confirm_password'];
  $hash_pass=md5($newpass);
  $sql1 = "Update users SET UserPWD='".$hash_pass."',PasswordChangeDate=GETDATE()
  ,UserOptions='0', UserActive='1' where UserID ='".$hash_user."'";
  $result1 = query($query,$sql1,$pa,$opt,$ms_db); 

  $sql_del = "delete from OTP where Emp_code='$user_id'";
  $result_del = query($query,$sql_del,$pa,$opt,$ms_db);

}
else if($_POST['action'] == "question") {
  $user_id = $_POST['uid'];
  $user_ans = $_POST['user_ans'];
  $ans = explode(",", $user_ans);
  $user_ques = $_POST['user_ques'];
  $ques = explode(",", $user_ques);
  $date_var = Array("DOB","DOJ");
  $counter = "1";
  $hash_user = $user_id;
  $sql = "SELECT * FROM HrdMastQry WHERE (Emp_Code='$hash_user' OR OEmailID='$hash_user') ";

  for ($i = 0; $i < count($ques); $i++) {
    if(in_array($ques[$i],$date_var)){
      $date = strtotime($ans[$i]);
      $new_date = date('m-d-Y',$date);
      $sql .="AND convert(Date,$ques[$i],101)" . "='$new_date' ";
    }
     else{

      $sql .="AND $ques[$i]". "='$ans[$i]'  ";

    }
  }


  $result = query($query,$sql,$pa,$opt,$ms_db);
  if ($num($result)) {
    while ($row = $fetch($result)) {

    }
  }
  else{
    echo ++$counter;
  }

  if($counter == "1"){

  $sqlq = "select * from PasswordPolicy";
  $resultq = query($query,$sqlq,$pa,$opt,$ms_db);

  if ($num($resultq)) {

    while ($rowq = $fetch($resultq)) {
      echo $columnfield = $rowq['ask_for_otp_status'];
      echo ",";
      if($rowq['ask_for_otp_status'] == 1)
      {
        echo $otp= OTP();
        $store = true;
      }
      if($store = true)
      {
        $sql_otp = "Select * from OTP where Emp_code='$user_id'";
        $result_otp = query($query,$sql_otp,$pa,$opt,$ms_db);
        if($num($result_otp)) {

         $sql_u = "Update OTP Set Rand_OTP='$otp' ,Creation_Time=GETDATE() WHERE Emp_Code='$user_id' ";
            $result_u = query($query,$sql_u,$pa,$opt,$ms_db);

        }
        else{
          $sql = "INSERT INTO OTP (Emp_Code,Rand_OTP,Creation_Time) VALUES ('$user_id','$otp',GETDATE())";
          $result = query($query,$sql,$pa,$opt,$ms_db);
        }


      }


    }
  }
}
}
else if($_POST['action'] == "votp"){
  $user_id = $_POST['uid'];
  $user_ans = $_POST['otp_value'];
  $sql_otp = "Select * from OTP where Emp_code='$user_id' AND Rand_OTP='$user_ans' AND GETDATE() <= (DATEADD(Minute,15,Creation_Time)) ";
  $result_otp = query($query,$sql_otp,$pa,$opt,$ms_db);
  if($num($result_otp)) {

    while ($rowq = $fetch($result_otp)) {
          echo $otp_true = "true";


    }
  }
  if($otp_true == 'true')
  {
    $sql_del = "delete from OTP where Emp_code='$user_id'";
    $result_del = query($query,$sql_del,$pa,$opt,$ms_db);
  }
}
else {

  $user_id = $_POST['uid'];
 // $comp_code = $_POST['compcode'];
  $sqlq1="select * from company_login_mst where status='Active' ";
  $resultq1=query($query,$sqlq1,$pa,$opt,$ms_db);
  $columnfield = array();
  $no=$num($resultq1);
  if($num($resultq1)) {

    while ($rowq1 = $fetch($resultq1)) {
      $columnfield[] = $rowq1['login_column'];

    }
  }
  $hash_user=md5($user_id);
  $sql = "SELECT * FROM users WHERE ";
  $nocolumn=count($columnfield);
  for($i=0;$i< count($columnfield);$i++) {

    $sql .= $columnfield[$i] . "='$hash_user'  ";
    if ($i > 1 || !$i==$nocolumn-1) {
      $sql .= " OR ";
    }

  }
  $sql .= "AND UserActive='1'";
  //echo $sql;
  $result = query($query,$sql,$pa,$opt,$ms_db);
  if($num($result) == 1) {

    $sqlq = "select * from PasswordPolicy";
    $resultq = query($query,$sqlq,$pa,$opt,$ms_db);

    if ($num($resultq)) {

      while ($rowq = $fetch($resultq)) {
        echo $rowq['password_reset_ques_status'];
        echo ",";
        echo $rowq['ask_for_otp_status'];
        echo ",";
        if($rowq['ask_for_otp_status'] == 1 && $rowq['password_reset_ques_status'] ==0)
        {
         echo $otp = OTP();
          $store = true;
        }
        if($store = true)
        {
           $sql = "INSERT INTO OTP (Emp_Code,Rand_OTP,Creation_Time) VALUES ('$user_id','$otp',GETDATE())";
          $result = query($query,$sql,$pa,$opt,$ms_db);
          if($result)
          {
            //echo"success";
          }
        }

      }
    }
  }
  else
  {
    echo "false";
  }
}

function OTP($digits = 4){
  $i = 0;
  $random_code = "";
  while($i < $digits){
    $random_code .= mt_rand(0, 9);
    $i++;
  }
  return  $random_code;

}
