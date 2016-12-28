<?php
session_start();
 include "../db_conn.php";
include ('../configdata.php');
 
 if(isset($_POST['username'])&& !empty($_POST['username']) && isset($_POST['password'])&& !empty($_POST['password'])){

     echo $sqlq="select * from company_login_mst where status='Active' ";
     $resultq=query($query,$sqlq,$pa,$opt,$ms_db);
     $columnfield = array();
      $no=$num($resultq);
    if($num($resultq)) {

        while ($rowq = $fetch($resultq)) {
            $columnfield[] = $rowq['login_column'];

        }
    }
    print_r($columnfield);

    $username = $_POST['username'];
    $password = $_POST['password'] ;
    $hash_user=md5($username);
    $hash_pass=md5($password);
        //    if(count($columnfield)>=1)
        $sql = "SELECT * FROM users WHERE ";
         $nocolumn=count($columnfield);
        for($i=0;$i< count($columnfield);$i++) {

            $sql .= $columnfield[$i] . "='$hash_user' ";
            if ($i > 1 || !$i==$nocolumn-1) {
                $sql .= " OR ";
            }

        }
     $sql.= " AND userPWD='$hash_pass' ";
  echo $sql;
    $result = query($query,$sql,$pa,$opt,$ms_db);
    if($num($result) == 1) {
        while ($row = $fetch($result)) {
            $_SESSION['usertype'] = $row['UserType'];
            $_SESSION['usercode'] = $username;
            if ($row['UserType'] == "U") {
                $sqlRole = "SELECT a.role_menu,a.data_menu,a.role_name,a.id,a.defaultrole FROM hrms_role a left join  usersroles b on a.id = b.roleId and (b.userid = '$username' or b.menucode ='$username' )where (b.userid != 'null' or a.defaultrole = 1) order by a.defaultrole desc";
                $resultR = query($query,$sqlRole,$pa,$opt,$ms_db);
                $roleArray = array();
                $defID = 0;
                while ($rowR = $fetch($resultR)) {
                    if ($rowR['initial']) {
                        $defID = $rowR['id'];
                    }
                    $roleArray[$rowR['id']] = array('role' => newdata(json_decode($rowR['role_menu'], 1)), 'data' => newdata(json_decode($rowR['data_menu'], 1)), 'name' => $rowR['role_name'], 'initial' => $rowR['initial']);
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
            //print_r( $_SESSION['Allrole']);
             header ('location: home.php');
        }
    }
    else{
        header ('location:../../index.php');
    }

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
