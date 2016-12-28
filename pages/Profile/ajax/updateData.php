<?php
include ('../../db_conn.php');
include ('../../configdata.php');
// Edit personal Info tab

if ($_GET['type']=="editPersonal"){
    $empCode = $_POST['empCode'];
    $emptitle=$_POST['emptitle'];
    $empFName = $_POST['empFName'];
    $empMName = $_POST['empMName'];
    $empLName = $_POST['empLName'];
    $sex = $_POST['sex'];
    $mStatus = $_POST['mStatus'];
    $nationality = $_POST['nationality'];
    $religion = $_POST['religion'];

    $bloodGroup=$_POST['bloodGroup'];
    $gaurdian=$_POST['gaurdian'];

    if($_POST['dob']==""){
        $dob=$_POST['dob'];
    }else{
        $dob = dateConversion($_POST['dob']);
    }

    if($_POST['annivdate'] == ""){
        $annivdate= "00:00:00";
    }else{
        $annivdate=dateConversion($_POST['annivdate']);
    }

    $sql ="update HrdMast set Emp_Title='$emptitle', Emp_FName='$empFName', Emp_MName='$empMName', Emp_LName='$empLName', Sex='$sex', MStatus='$mStatus',
     Nationality='$nationality', DOB='$dob', Religion='$religion', Anniversary='$annivdate', BloodGroup='$bloodGroup' where Emp_Code='$empCode' ";
    $result =  query($query,$sql,$pa,$opt,$ms_db);
    if($result == TRUE){
        $sql1="UPDATE hrdtran set GuardianName='$gaurdian'  where Emp_Code='$empCode' ";
        $result1 = query($query,$sql1,$pa,$opt,$ms_db);
        if($result1) {
            echo 1;
            json_encode(array('status' => TRUE, 'text' => "Data Inserted sucessfully."));
        }else{
            echo 2;
            // print_r($error);
        }
    }else{
        echo 0;
       // print_r($error);
    }

}

elseif ($_GET['type']=="editContact"){
    $empCode= $_POST['empCode'];
    $mHNo = $_POST['mHNo'];
    $mStreetNo =  $_POST['mStreetNo'];
    $mArea = $_POST['mArea'];
    $mCity = $_POST['mCity'];
    $mRegion = $_POST['mRegion'];
    $mState = $_POST['mState'];
    $mCountry = $_POST['mCountry'];
    $mPin = $_POST['mPin'];
    $pEMailId= $_POST['pEMailId'];
    $mPhoneNo = $_POST['mPhoneNo'];
    $mobileNo = $_POST['mobileNo'];

    $pHNo = $_POST['pHNo'];
    $pStreetNo = $_POST['pStreetNo'];
    $pArea = $_POST['pArea'];
    $pCity = $_POST['pCity'];
    $pRegion = $_POST['pRegion'];
    $pState = $_POST['pState'];
    $pCountry = $_POST['pCountry'];
    $pPin = $_POST['pPin'];
    $pPhoneNo = $_POST['pPhoneNo'];

     $sql ="update HrdMast set MAddr3='$mHNo', MAddr1='$mStreetNo', MArea='$mArea', MCity='$mCity', MRegion='$mRegion', MState='$mState',
     MCountry='$mCountry', MPin='$mPin', PEmailID='$pEMailId', MobileNo='$mobileNo', MPhoneNo='$mPhoneNo', PAddr1='$pHNo', PAddr2='$pStreetNo',
     PAddr3='$pArea', PCity='$pCity', PState='$pState' , PRegion='$pRegion',PCountry='$pCountry',PPin='$pPin', PPhoneNo='$pPhoneNo' where Emp_Code='$empCode' ";
    $result = query($query,$sql,$pa,$opt,$ms_db);
    if($result == TRUE){
        echo 1;
    }else{
        echo 0;
       // print_r($error);
    }

}

elseif ($_GET['type']=="editOfficial") {
    if($_POST['doj']== ""){
        $doj="00:00:00";
    }else{
        $doj=dateConversion($_POST['doj']);
    }
   
    if($_POST['dojWef']==""){
        $dojWef="00:00:00";
    }else{
        $dojWef=dateConversion($_POST['dojWef']);
    }

   

    $empCode = $_POST['empCode']; //alert();
   
    $mngrCode = $_POST['global_manager'];
    $mngrCode2 = $_POST['function_supervisor'];
    $compCode = $_POST['compCode'];
    $bussCode = $_POST['bussCode'];
    $locCode = $_POST['locCode'];
    $wLocCode = $_POST['wLocCode'];
    $grdCode = $_POST['grdCode'];
    $empTypeCode = $_POST['empTypeCode'];
    $functCode = $_POST['functCode'];

    $costCode = $_POST['costCode'];
    $procCode = $_POST['procCode'];
    $dsCODE = $_POST['dsCODE'];

    $accesscode = $_POST['accesscode'];
    $oEmail = $_POST['oEmail'];
    $lavel = $_POST['lavel'];
    $divisionMast = $_POST['divisionMast'];
    $regionMast = $_POST['regionMast'];
    $subBussUnit = $_POST['subBussUnit'];

    
    $workphn=$_POST['workphn'];
    $workphnExt=$_POST['workphnExt'];
    $status="";

    if($_POST['effectiveDate'] == ""){
        $effectiveDate="00:00:00";
    }else{
        $effectiveDate = dateConversion($_POST['effectiveDate']);
    }

    if($_POST['subFunctCode']== ""){
        $subFunctCode="";
    }else{
        $subFunctCode = $_POST['subFunctCode'];
    }

    $sql = "select  * from HrdTran where Trn_Date=CONVERT(date, getdate()) AND Trn_WEF='$effectiveDate' And Emp_Code='$empCode' ";
    $value = query($query,$sql,$pa,$opt,$ms_db);
    $row_count = $num( $value );
    //echo $row_count; die;


    if ($row_count > 0) {
        $sql1 = "Update HrdMast Set  DOJ='$doj', DOJ_WEF='$dojWef', OEmailID='$oEmail',
         accessID='$accesscode' where  Emp_Code='$empCode' ";
        $result1 = query($query,$sql1,$pa,$opt,$ms_db);
        if($result1) {
            
        $sql2 = "update HrdTran set  Grd_Code = '$grdCode',Dsg_Code='$dsCODE', Loc_Code='$locCode', Cost_Code='$costCode', Proc_Code='$procCode', Funct_Code='$functCode',Comp_Code='$compCode',
        SFUNCT_CODE='$subFunctCode', WLOC_CODE='$wLocCode', BussCode='$bussCode', Type_Code='$empTypeCode', Mngr_Code='$mngrCode', Mngr_Code2='$mngrCode2', Regn_Code='$regionMast', Divi_Code='$divisionMast', Level_CODE='$lavel', SubBuss_ID='$subBussUnit', WorkPhone='$workphn', WorkPhoneExt='$workphnExt'  where  Emp_Code='$empCode' And Trn_WEF='$effectiveDate' And Trn_Date=CONVERT(date, getdate()) ";
            $result2 = query($query,$sql2,$pa,$opt,$ms_db);
            if($result2){

                if(trim($oEmail)!=""){
                $enccode=md5($empCode);
                $sqluser="select * from users where userid='$enccode' and userActive='1' ";
                $queryuser=query($query,$sqluser,$pa,$opt,$ms_db);
                if($num($queryuser)>0){
                    echo 1;
                }else{
                    $message=welcome_msg($empCode);
                    $subject='Welcome message !';
                    $to=trim($oEmail);
                    
                    $mail1=mymailer('donotreply@sequelone.com',$subject,$message,$to);
                    
                     echo 1; 
                }
                          
               }else{
                echo 1;
               }
            }else{
                echo 2;
            }
        }

    }
   elseif($data['record'] == 0) {

        // getting status code before insert
        $sqlst="select Status_Code from hrdtran where Emp_Code='$empCode'";
        $resultSt =query($query,$sqlst,$pa,$opt,$ms_db);

            while ( $datast = $fetch($resultSt)) {
             $status= $datast['Status_Code'];   
             
            }

        //end sql
       $sql3 = "Update HrdMast Set DOJ='$doj', DOJ_WEF='$dojWef', 
        OEmailID='$oEmail', accessID='$accesscode' where Emp_Code='$empCode' ";
       $result3 =query($query,$sql3,$pa,$opt,$ms_db);
       if ($result3) {
           $sql4 = "INSERT INTO HrdTran (Emp_Code,Trn_WEF,Trn_Date ,Status_Code, Grd_Code,Dsg_Code,Comp_Code, Loc_Code, Cost_Code, Proc_Code, Funct_Code, SFUNCT_CODE, WLOC_CODE, BussCode, Type_Code, Mngr_Code, Mngr_Code2, Regn_Code, Divi_Code, Level_CODE, SubBuss_ID,WorkPhone, WorkPhoneExt)
       VALUES ('$empCode','$effectiveDate',CONVERT(date, getdate()),'$status', '$grdCode','$dsCODE', '$compCode', '$locCode', '$costCode', '$procCode', '$functCode', '$subFunctCode', '$wLocCode', '$bussCode', '$empTypeCode', '$mngrCode', '$mngrCode2', '$regionMast', '$divisionMast', '$lavel', '$subBussUnit','$workphn','$workphnExt')";
           $result4 =query($query,$sql4,$pa,$opt,$ms_db);
           if ($result4) {
                if(trim($oEmail)!=""){
                $enccode=md5($empCode);
                $sqluser="select * from users where userid='$enccode' and userActive='1' ";
                $queryuser=query($query,$sqluser,$pa,$opt,$ms_db);
                if($num($queryuser)>0){
                    echo 3;
                }else{
                    $to=array($oEmail);
                    //$to[]='himanshu@agnitioworld.com';
                    $message="Hi ".$name." here is Password Reset Link <br>";
                    $message.='https://empkonnect.sequelone.com/pages/login/resetPass.php?usercode='.$empCode;
                    $mail1=mymailer('donotreply@sequelone.com','Reset Password',$message,$to);
                    // $mail=substr($mail1,-7);
                    // if($mail=="success"){
                    //     echo 3;
                    // }
                    // else{
                    //     echo 5;
                    // }
                }
        
               }
               else{
                echo 3;
               }
           } else {
               echo 4;
           }
       }
   }
   else{
       //print_r($error);
       echo 0;
   }

}

elseif ($_GET['type'] == "editsepration") {
     if($_POST['dol']==""){
        $dol="00:00:00";
    }else
    {
        $dol=dateConversion($_POST['dol']);
    }

    if($_POST['dos']==""){
        $dos="00:00:00";
    }else{

        $dos=dateConversion($_POST['dos']);
    }
     if($_POST['dor']==""){
        $dor=$_POST['dor'];
    }else{
        $dor= dateConversion($_POST['dor']);
    }
    $empCode = $_POST['empCode']; //alert();
    $statusCode = $_POST['statusCode'];
    $leavReas=$_POST['leavReas'];
    
     $sql1 = "Update HrdMast Set  Status_Code='$statusCode', DOR='$dor', DOL='$dol', DOS='$dos', LeavReason='$leavReas' where  Emp_Code='$empCode' ";
        $result1 = query($query,$sql1,$pa,$opt,$ms_db);
        if($result1){
          $sql2 = "update HrdTran set Status_Code ='$statusCode' where Emp_Code='$empCode' ";
        $result2 = query($query,$sql2,$pa,$opt,$ms_db);
        if ($result2) {
               echo 1;
           } else {
               echo 0;
           }
        }

}

elseif ($_GET['type']=="editBank"){
    $empCode		=$_POST['empCode'];
    $smopCode		=$_POST['bankCode'];
    $smopNo			=$_POST['smopNo'];
    $rmopCode		=$_POST['reimbankCode'];
    $rmopNo			=$_POST['rmopNo'];

     $sql1 = "update HrdTran set SMOP_Code='$smopCode', SMOPNo='$smopNo', RMOP_Code='$rmopCode', RMOPNo='$rmopNo' where Emp_Code='$empCode'";
    $result = query($query,$sql1,$pa,$opt,$ms_db);

    if($result){
        echo 1;
    }else{
        echo 0;
       // print_r($error);
    }
}


elseif ($_GET['type']=="editStatury"){ // identity tab

    $empCode  = $_POST['empCode'];

    $passNo =  $_POST['passNo'];
    $passPlace = $_POST['passPlace'];
    $passAddress = $_POST['passAddress'];
    $dlNo = $_POST['dlNo'];
    $dlPlace = $_POST['dlPlace'];
    $dlAddress = $_POST['dlAddress'];

    $adharNo = $_POST['adharNo'];
    $registration= $_POST['registration'];
    $trade = $_POST['trade'];
    //$contract = $_POST['contract'];


    if($_POST['dlDate']){
        $dlDate = "00:00:00";
    }else{
        $dlDate = dateConversion($_POST['dlDate']);
    }
    if($_POST['passValidityDate'] == ""){
        $passValidityDate = "";
    }else{
        $passValidityDate = dateConversion($_POST['passValidityDate']);
    }

    if($_POST['passIssue'] == ""){
        $passDate = "";
    }else{
        $passDate =dateConversion($_POST['passIssue']);
    }

    if($_POST['dlValidityDate'] == ""){
        $dlValidityDate = "";
    }else{
        $dlValidityDate =dateConversion($_POST['dlValidityDate']);
    }

    $sql ="update HrdMast set PassportNo='$passNo', PassportValidityDate='$passValidityDate', PassportAddress='$passAddress', PassportPlace='$passPlace', PIssueDate='$passDate', DIssueDate='$dlDate',
     DLNo='$dlNo', DLValidityDate='$dlValidityDate', DLAddress='$dlAddress', DLPlace='$dlPlace', AadharNo='$adharNo' where Emp_Code='$empCode' ";
    $result = query($query,$sql,$pa,$opt,$ms_db);
    if($result){
        $sql1="UPDATE hrdtran set  Registration_No='$registration', Trade='$trade' where Emp_Code='$empCode' ";
        $result1 = query($query,$sql1,$pa,$opt,$ms_db);
        if($result1){
            echo 1;
        }else{
            echo 0;
        }
    }else{
        echo 0;
    }
    
}



elseif ($_GET['type']=="editIdentity"){  // statutory tab

    $empCode  = $_POST['empCode'];
    $unNo =  $_POST['uanNo'];
    $PfNo = $_POST['PfNo'];
    $esiNo = $_POST['esiNo'];
    $panNo = $_POST['panNo'];



     $sql ="update HrdMast set PFNo='$PfNo', ESINo='$esiNo', UNNo='$unNo',PANNo='$panNo' where Emp_Code='$empCode' ";
    $result = query($query,$sql,$pa,$opt,$ms_db);
    if($result){
        echo 1;

    }else{
        echo 0;
    }

}


elseif ($_GET['type']=="funct"){

    $functCod=$_POST['functcode'];
    if($_POST['functcode']){
        echo $sql= "select  SubFunctID, SubFunct_NAME from SubFunctMast where FunctID='$functCod'";
    }else{
        echo  $sql= "select  SubFunctID, SubFunct_NAME from SubFunctMast ";
    }
    $result = query($query,$sql,$pa,$opt,$ms_db);
    if($num($result)>0){
        while($row =$fetch($result)) {
         echo "<option value='" . $row['SubFunctID'] . "' >" . $row['SubFunct_NAME'] . "</option>";
        }
    }else{
        $sql1= "select  SubFunctID, SubFunct_NAME from SubFunctMast";
        $result1 = query($query,$sql1,$pa,$opt,$ms_db);
        while($row1 =$fetch($result1)) {
            echo "<option value='" . $row1['SubFunctID'] . "' >" . $row1['SubFunct_NAME'] . "</option>";
        }
    }

    // if($num($result)>0){
    // //$row= $fetch($result);
    //     while($row =$fetch($result)) {
    //      echo "<option value='" . $row['SubFunctID'] . "' >" . $row['SubFunct_NAME'] . "</option>";
    //     }
    // }else{
    //     $sql1= "select  SubFunctID, SubFunct_NAME from SubFunctMast";
    //     $result1 = query($query,$sql1,$pa,$opt,$ms_db);
    //     while($row1 =$fetch($result1)) {
    //         echo "<option value='" . $row1['SubFunctID'] . "' >" . $row1['SubFunct_NAME'] . "</option>";
    //     }
    // }
}


elseif ($_GET['type']=="showPc"){
    $Code=$_POST['oCode'];
    $det="select EmpImage,Sex,Emp_FName,Emp_MName,Emp_LName,DSG_NAME from hrdmastqry where Emp_Code='$Code'";
    $details=query($query,$det,$pa,$opt,$ms_db);
    $row=$fetch($details);
    $male="images.png";
    $female="images.jpg";
    $others="people.png";

    if($row['EmpImage']=="" && $row['Sex']== 1){
       // echo "<img src='upload_images/".$male."' class='img-responsive' alt='' style='width: 100px;height: 100px;'>";

        echo" <div class='profile-userpic'>
              <img src='upload_images/".$male."' class='img-responsive' alt='' style='width: 100px;height: 100px;'>
            </div>
            
            <div class='profile-usertitle'>
                <div class='profile-usertitle-name'>
                   ".$row['Emp_FName'] ." ". $row['Emp_MName']." ".$row['Emp_LName']."
            </div>
            <div class='profile-usertitle-job'>
                   ". $Code."
            </div>
            <div class='profile-usertitle-job'>
                ".$row['DSG_NAME']."
            </div>
            </div>";

    }elseif ($row['EmpImage']=="" && $row['Sex']== 2){
       // echo "<img src='upload_images/".$female."' class='img-responsive' alt='' style='width: 100px;height: 100px;' >";

        echo" <div class='profile-userpic'>
             <img src='upload_images/".$female."' class='img-responsive' alt='' style='width: 100px;height: 100px;' >
            </div>
            
            <div class='profile-usertitle'>
                <div class='profile-usertitle-name'>
                   ".$row['Emp_FName'] ." ". $row['Emp_MName']." ".$row['Emp_LName']."
            </div>
             <div class='profile-usertitle-job'>
                   ". $Code."
            </div>
            <div class='profile-usertitle-job'>
                ".$row['DSG_NAME']."
            </div>
            </div>";

    }elseif ($row['EmpImage']=="" && $row['Sex']== ""){
       // echo "<img src='upload_images/".$others."' class='img-responsive' alt='' style='width: 100px;height: 100px;' >";

        echo" <div class='profile-userpic'>
             <img src='upload_images/".$others."' class='img-responsive' alt='' style='width: 100px;height: 100px;' >
            </div>
            
            <div class='profile-usertitle'>
                <div class='profile-usertitle-name'>
                   ".$row['Emp_FName'] ." ". $row['Emp_MName']." ".$row['Emp_LName']."
            </div> <div class='profile-usertitle-job'>
                   ". $Code."
            </div>
            <div class='profile-usertitle-job'>
                ".$row['DSG_NAME']."
            </div>
            </div>";

    }
    else {
        //echo "<img src='upload_images/" . $row['EmpImage'] . "' class='img-responsive' alt='' style='width: 100px;height: 100px;'>";

        echo" <div class='profile-userpic'>
             <img src='upload_images/" . $row['EmpImage'] . "' class='img-responsive' alt='' style='width: 100px;height: 100px;'>
            </div>
            
            <div class='profile-usertitle'>
                <div class='profile-usertitle-name'>
                   ".$row['Emp_FName'] ." ". $row['Emp_MName']." ".$row['Emp_LName']."
            </div> <div class='profile-usertitle-job'>
                   ". $Code."
            </div >
            <div class='profile-usertitle-job'>
                ".$row['DSG_NAME']."
            </div>
            </div>";
    }
}


elseif ($_GET['type'] == "headerPic"){
    $Code=$_POST['oCode'];
    $det="select EmpImage,Sex,Emp_FName,Emp_MName,Emp_LName,DSG_NAME from hrdmastqry where Emp_Code='$Code'";
    $details=query($query,$det,$pa,$opt,$ms_db);
    $row=$fetch($details);
    $male="images.png";
    $female="images.jpg";
    $others="people.png";

    if($row['EmpImage']=="" && $row['Sex']== 1){
       // echo "<img src='upload_images/".$male."' class='img-responsive' alt='' style='width: 100px;height: 100px;'>";

        echo"  <img src='upload_images/".$male."' class='img-circle' alt='' style='width: 50px;height: 50px;'>
            
                <span class='username username-hide-on-mobile  fs-16'>
                   ".$row['Emp_FName'] ."
            </span>
           ";

    }elseif ($row['EmpImage']=="" && $row['Sex']== 2){
       // echo "<img src='upload_images/".$female."' class='img-responsive' alt='' style='width: 100px;height: 100px;' >";

        echo"  <img src='upload_images/".$female."' class='img-circle' alt='' style='width: 50px;height: 50px;' >
            
                <span class='username username-hide-on-mobile  fs-16'>
                   ".$row['Emp_FName'] ."
            </span>";

    }elseif ($row['EmpImage']=="" && $row['Sex']== ""){
       // echo "<img src='upload_images/".$others."' class='img-responsive' alt='' style='width: 100px;height: 100px;' >";

        echo" <img src='upload_images/".$others."' class='img-circle' alt='' style='width: 50px;height: 50px;' >
            
                <span class='username username-hide-on-mobile  fs-16'>
                   ".$row['Emp_FName'] ."
            </span>";

    }
    else {
        //echo "<img src='upload_images/" . $row['EmpImage'] . "' class='img-responsive' alt='' style='width: 100px;height: 100px;'>";

        echo" <img src='upload_images/" . $row['EmpImage'] . "' class='img-circle' alt='' style='width: 50px;height: 50px;'>
           
                <span class='username username-hide-on-mobile  fs-16'>
                   ".$row['Emp_FName'] ."
            </span>";
    }
}

elseif ($_GET['type']=="oldPassCheck"){
    $Password=md5($_POST['oldpass']);
    $userId=md5($_POST['userId']);
    $sql="SELECT * FROM Users Where UserID='$userId'";
    $details=query($query,$sql,$pa,$opt,$ms_db);
    $row=$fetch($details);
    if($row['UserPWD']==""){
        echo "no password";
    }
    elseif ($row['UserPWD']!=$Password){
        echo "Old Password is wrong";
    }
    else{
        echo 0;
    }
}

elseif($_GET['type']=="change"){
    $oldPass=$_POST['oldpass'];
    $checkNewPass=$_POST['new_password'];
    $newPasscheck=$_POST['new_password'];
    $newPass=md5($newPasscheck);
    $userid=md5($_POST['uid']);

     $sql1="select * from PasswordPolicy";
     $sql2="SELECT * FROM  Users WHERE UserID='$userid'";

    $details1=query($query,$sql1,$pa,$opt,$ms_db);
    $row1= $fetch($details1);

    $details2=query($query,$sql2,$pa,$opt,$ms_db);
    $row2= $fetch($details2);

    if($row1['earlier_password_use_status'] == 1){
        $numUse = $row1['earlier_password_use'];
       // echo $numUse; return false;
        $oldpassarr = explode(",", $row2['OldPWD']);
        array_push($oldpassarr, $oldPass);

        if($row2['OldPWD'] == ""){
            if($newPasscheck == $oldPass){
                echo 2;
                return false;
            }else {
                $oldpassStr=implode(",",$oldpassarr);
                $sql3 = "UPDATE users set UserPWD='$newPass', OldPWD='$oldpassStr' WHERE UserID='$userid'";
                $details3 = query($query, $sql3, $pa, $opt, $ms_db);
                if ($details3) {
                    echo 1;
                } else {
                    echo 0;
                }
            }
        }
        else{
            if (in_array($newPasscheck, $oldpassarr)) {
                echo 2;
                return false;
            }else {
                if ($numUse == count($oldpassarr)) {
                    $arr=array_slice($oldpassarr,1);
                    array_push($arr, $oldPass);

                } elseif ($numUse > count($oldpassarr)) {
                    array_push($oldpassarr, $oldPass);
                } 
            }

            $oldpassStr=implode(",",$arr);
            $sql4 = "UPDATE users set UserPWD='$newPass', OldPWD='$oldpassStr' WHERE UserID='$userid'";

            $details4 = query($query, $sql4, $pa, $opt, $ms_db);
            if ($details4) {
                echo 1;
            } else {
                echo 0;
            }

        }
    }
    else {
       $sql = "UPDATE users set UserPWD='$newPass', OldPWD='$oldPass' WHERE UserID='$userid'";
        $details = query($query, $sql, $pa, $opt, $ms_db);
        if ($details) {
            echo 1;
        } else {
            echo 0;
        }
    }
}

function dateConversion($sDate){


    $aDate = explode('/', $sDate);

    @$sMySQLTimestamp = sprintf(
        '%s-%s-%s 00:00:00',
        @$aDate[2],
        @$aDate[1],
        @$aDate[0]
    );

    return $sMySQLTimestamp;

}



?>

