<?php
session_start();
 include "../db_conn.php";
include ('../configdata.php');

 if(isset($_POST['username'])&& !empty($_POST['username']) && isset($_POST['password'])&& !empty($_POST['password'])){

      $sqlq="select * from company_login_mst where status='Active' ";
     $resultq=query($query,$sqlq,$pa,$opt,$ms_db);
     $columnfield = array();
     $no=$num($resultq);
     if($num($resultq)) {

         while ($rowq = $fetch($resultq)) {
             $columnfield[] = $rowq['login_column'];

         }
     }
    // print_r($columnfield);
     
    $username = $_POST['username'];
    $password = $_POST['password'] ;
    $hash_user=md5($username);
    $hash_pass=md5($password);
        //    if(count($columnfield)>=1)
        $sql = "SELECT * FROM users WHERE (";
         $nocolumn=count($columnfield);
        for($i=0;$i< count($columnfield);$i++) {

            $sql .= $columnfield[$i] . "='$hash_user'  ";
            if ($i > 1 || !$i==$nocolumn-1) {
                $sql .= " OR ";
            }

        }
     $sql.= ") AND userPWD='$hash_pass' AND IsLocked='N' AND (UserActive='Y' OR UserActive='1')" ;
  //echo $sql;
    $result = query($query,$sql,$pa,$opt,$ms_db);
    if($num($result) == 1) {
        while ($row = $fetch($result)) {
            $_SESSION['usertype'] = $row['UserType'];
            $_SESSION['usercode'] = $username;
            if ($row['UserType'] == "U") {
                $sqlcheckm="select count(emp_code) from hrdmastqry where mngr_code='$username'";
                $resultcheckm=query($query,$sqlcheckm,$pa,$opt,$ms_db);
                $sqlm="select menu_id from role_define where menu_for='M'";
                $resultm=query($query,$sqlm,$pa,$opt,$ms_db);
                $rowcheckm=$fetch($resultcheckm);
                $rowm=$fetch($resultm);
                $sqlRole = "SELECT a.role_menu , a.data_menu,a.role_name,a.id,a.DefaultRole FROM hrms_role a left join  usersroles b on a.id = b.roleId and (b.userID = '$username' or b.MenuCode ='$username' ) where (b.RoleId != 'null' or a.DefaultRole = 1";
                if($rowcheckm[0] > 0){
                    $sqlRole.=" or a.id = '".$rowm[0]."' ";
                }else{ 
                $sqlRole.=" ";
            }
                $sqlRole.=") order by a.DefaultRole desc";
                $resultR = query($query,$sqlRole,$pa,$opt,$ms_db);
                $roleArray = array();
                $defID = 0;
                while ($rowR = $fetch($resultR)) {
                    if ($rowR['DefaultRole']) {
                        $defID = $rowR['id'];
                    }
                    $roleArray[$rowR['id']] = array('role' => newdata(json_decode($rowR['role_menu'], 1)), 'data' => newdata(json_decode($rowR['data_menu'], 1)), 'name' => $rowR['role_name'], 'initial' => $rowR['DefaultRole']);
                }
                $_SESSION['defId'] = $defID;
                $_SESSION['Allrole'] = $roleArray;
                $_SESSION['selectedRole'] = $defID;


            } elseif ($row['UserType'] == "A") {
                echo $sqlRole = "SELECT * FROM hrms_menu where TYPE = 'Admin'";
                $resultR = query($query,$sqlRole,$pa,$opt,$ms_db);
                while ($rowR = $fetch($resultR)) {
                    //print_r($rowR['Menu']);
                    $_SESSION['defId'] = $rowR['Mid'];
                    $roleArray[$rowR['Mid']] = array('role' => json_decode($rowR['Menu'], 1));
                    $_SESSION['Allrole'] = $roleArray;
                    $_SESSION['selectedRole'] = $rowR['Mid'];
                }
            }
           // print_r( $_SESSION['Allrole']);

            $sql_up1 = "Update users SET FailedAttemptCount='0' , FailedAttemptDate=NULL where ";
            for($i=0;$i< count($columnfield);$i++) {
                $sql_up1 .= $columnfield[$i] . "='$hash_user'  ";
                if ($i > 1 || !$i==$nocolumn-1) {
                    $sql_up1 .= " OR ";
                }
            }
           // echo $sql_up1;
            $result_up1 = query($query,$sql_up1,$pa,$opt,$ms_db);

            header ('location: home.php');
        }

    }
    else{
        $sqlq_att = "select * from PasswordPolicy";
        $resultq_att = query($query,$sqlq_att,$pa,$opt,$ms_db);

        if ($num($resultq_att)) {
            while ($rowq_att = $fetch($resultq_att)) {
                $columnfield1 = $rowq_att['locked_userid_status'];
                $attempt_val = $rowq_att['locked_userid_attempts'];
                $locked_time = $rowq_att['locked_userid_minutes'];
            }
        }
     //   echo $locked_time;
        if($columnfield1 == "1") {
            $sql_failatt = "Select * from users WHERE (";
            $nocolumn = count($columnfield);
            for ($i = 0; $i < count($columnfield); $i++) {
                $sql_failatt .= $columnfield[$i] . "='$hash_user'  ";
                if ($i > 1 || !$i == $nocolumn - 1) {
                    $sql_failatt .= " OR ";
                }
            }
            $sql_failatt .= ") AND IsLocked='N' AND (UserActive='Y' OR UserActive='1') AND FailedAttemptDate IS NULL";
            $locked;
            $result_failatt = query($query,$sql_failatt,$pa,$opt,$ms_db);
            if ($result_failatt )  {
                if ($num($result_failatt)) {

                    while ($row_failatt = $fetch($result_failatt)) {
                        $failed_attempt = $row_failatt['FailedAttemptCount'];
                        $locked = $row_failatt['IsLocked'];
                    }
                    if ($failed_attempt <= $attempt_val - 1) {

                        $failed_attempt = $failed_attempt + 1;
                        $nocolumn = count($columnfield);
                        $sql_up2 = "Update users SET FailedAttemptCount='$failed_attempt' , FailedAttemptDate=GETDATE() where ";
                        for ($i = 0; $i < count($columnfield); $i++) {
                            $sql_up2 .= $columnfield[$i] . "='$hash_user'  ";
                            if ($i > 1 || !$i == $nocolumn - 1) {
                                $sql_up2 .= " OR ";
                            }
                        }
                       // echo $sql_up2;
                        $result_up2 = query($query,$sql_up2,$pa,$opt,$ms_db);

                    }
                }

                else {
                        $sql_failatt = "Select * from users WHERE (";
                        $nocolumn = count($columnfield);
                        for ($i = 0; $i < count($columnfield); $i++) {
                            $sql_failatt .= $columnfield[$i] . "='$hash_user'  ";
                            if ($i > 1 || !$i == $nocolumn - 1) {
                                $sql_failatt .= " OR ";
                            }
                        }
                        $sql_failatt .= ") AND IsLocked='N' AND (UserActive='Y' OR UserActive='1') AND FailedAttemptDate IS NOT NULL  AND GETDATE() <= (DATEADD(Minute,$locked_time,FailedAttemptDate))";
                 //   echo $sql_failatt;
                    $result_failatt = query($query,$sql_failatt,$pa,$opt,$ms_db);
                        if ($result_failatt){
                            if ($num($result_failatt)) {

                                while ($row_failatt = $fetch($result_failatt)) {
                                    $failed_attempt = $row_failatt['FailedAttemptCount'];
                                    $locked = $row_failatt['IsLocked'];

                                }
                                if ($failed_attempt == $attempt_val - 1) {
                                    $failed_attempt = $failed_attempt + 1;
                                    $nocolumn = count($columnfield);
                                    $sql_up1 = "Update users SET IsLocked='Y' ,LockedDate=GETDATE(),FailedAttemptCount='$failed_attempt' , FailedAttemptDate=GETDATE() where ";
                                    for ($i = 0; $i < count($columnfield); $i++) {
                                        $sql_up1 .= $columnfield[$i] . "='$hash_user'  ";
                                        if ($i > 1 || !$i == $nocolumn - 1) {
                                            $sql_up1 .= " OR ";
                                        }
                                    }
                                  //  echo $sql_up1;
                                    $result_up1 = query($query,$sql_up1,$pa,$opt,$ms_db);

                                }
                                elseif ($failed_attempt <= $attempt_val - 1) {

                                    $failed_attempt = $failed_attempt + 1;
                                    $nocolumn = count($columnfield);
                                    $sql_up2 = "Update users SET FailedAttemptCount='$failed_attempt' , FailedAttemptDate=GETDATE() where ";
                                    for ($i = 0; $i < count($columnfield); $i++) {
                                        $sql_up2 .= $columnfield[$i] . "='$hash_user'  ";
                                        if ($i > 1 || !$i == $nocolumn - 1) {
                                            $sql_up2 .= " OR ";
                                        }
                                    }
                                  //  echo $sql_up2;
                                    $result_up2 = query($query,$sql_up2,$pa,$opt,$ms_db);

                                }
                            }
                            else{
                                $sql_failatt = "Select * from users WHERE (";
                                $nocolumn = count($columnfield);
                                for ($i = 0; $i < count($columnfield); $i++) {
                                    $sql_failatt .= $columnfield[$i] . "='$hash_user'  ";
                                    if ($i > 1 || !$i == $nocolumn - 1) {
                                        $sql_failatt .= " OR ";
                                    }
                                }
                                $sql_failatt .= ") AND IsLocked='N' AND (UserActive='Y' OR UserActive='1') AND FailedAttemptDate IS NOT NULL  AND GETDATE() > (DATEADD(Minute,$locked_time,FailedAttemptDate))";
                                $result_failatt = query($query,$sql_failatt,$pa,$opt,$ms_db);
                                if ($result_failatt)
                                {
                                    $sql_up3 = "Update users SET FailedAttemptCount='0' , FailedAttemptDate=NULL where ";
                                    for($i=0;$i< count($columnfield);$i++) {
                                        $sql_up3 .= $columnfield[$i] . "='$hash_user'  ";
                                        if ($i > 1 || !$i==$nocolumn-1) {
                                            $sql_up3 .= " OR ";
                                        }
                                    }
                               //     echo $sql_up3;
                                    $result_up3 = query($query,$sql_up3,$pa,$opt,$ms_db);
                                }

                            }

                        }




                }
        }



        }?>
 <script type="text/javascript">
alert('Username or Password Incorrect');
setTimeout(function() { 
        window.location.href='/index.php'; 
    }, 1000);
  
  //  $('#error').html('Username and Password cannot be blank');
    
     
 </script>

 <?php
// header ('location: index.php');
    }

 }
 else{ ?>
 <script type="text/javascript">
alert('Username and Password cannot be blank');
  setTimeout(function() { 
        window.location.href='/index.php'; 
    }, 1000);
  //  $('#error').html('Username and Password cannot be blank');
    
     
 </script>
 <?php
    //echo "Username and Password cannot be blank";
   // header ('location:../../index.php');
 }

function newdata($data){

    $newArray = array();
    $y = 0;
    for($i = 0; $i < count($data); $i++){
        if(array_key_exists('state',$data[$i]) && array_key_exists('selected',$data[$i]['state']) && $data[$i]['state']['selected']){
            $newArray[] = $data[$i];
        }else{
            if(array_key_exists('children',$data[$i]) && count($data[$i]['children']) > 0){
                $data[$i]['children'] = newdata($data[$i]['children']);
                if(array_key_exists('children',$data[$i]) && count($data[$i]['children'])){
                    $newArray[] = $data[$i];
                }
            }
        }
    }
    return $newArray;
}
    
    ?>
