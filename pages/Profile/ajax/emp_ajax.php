<?php
error_reporting(0);
include '../../db_conn.php';
include ('../../configdata.php');
//echo @$_POST['type'];



if($_POST['type']=="reim")

{
    $bankCode= $_POST['bankCode'];
    $sql="select IFSC from SVMast where SV_Code='$bankCode' ";
    $result = query($query,$sql,$pa,$opt,$ms_db);
    $row = $fetch($result);
    echo $row['IFSC'];
    
}
else if($_POST['type']=="sal"){
    $bankCode= $_POST['bankCode'];
    $sql="select IFSC from SVMast where SV_Code ='$bankCode' ";

    $result = query($query,$sql,$pa,$opt,$ms_db);
    $row = $fetch($result);
    echo $row['IFSC'];

}

else if($_POST['type']=="allState"){
    $countryid = $_POST['countryid'];
    $sql="select * from StateMast where Country_Id='$countryid'";
    $result = query($query,$sql,$pa,$opt,$ms_db);
    $row = $fetch($result);

    while($row =$fetch($result)) {
     echo "<option value='". $row['StateID']."' > ". $row['State_Name']. "</option>";
    }
}

else if($_POST['type']=="allCity"){
    $stateid = $_POST['stateid'];
    $sql="select * from CityMast where State_Id='$stateid'";
    $result = query($query,$sql,$pa,$opt,$ms_db);
    $row = $fetch($result);

    while($row =$fetch($result)) {
     echo "<option value='". $row['CityID']."' > ". $row['City_NAME']. "</option>";
    }
}

else if($_POST['type']=="insert")
{
    $mngrCode = $_POST['mngrCode'];//globalmanager or reporting to
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
    $dsCODE = $_POST['dsCODE'];
    //$effectiveDate= dateConversion($_POST['effectiveDate']);
    $accesscode=$_POST['accesscode'];
    $oEmail = $_POST['oEmail'];
    $lavel= $_POST['lavel'];
    $divisionMast= $_POST['divisionMast'];
    $regionMast= $_POST['regionMast'];
    $subBussUnit= $_POST['subBussUnit'];
    $workphn=$_POST['workphn'];
    $workphnExt=$_POST['workphnExt'];

    $Emp_title =  $_POST['emptitle'];
    $empFName = $_POST['empFName'];
    $empMName = $_POST['empMName'];
    $empLName = $_POST['empLName'];
    $sex = $_POST['sex'];
    $mStatus = $_POST['mStatus'];
    $nationality = $_POST['nationality'];

    $religion = $_POST['religion'];
    $gaurdian = $_POST['gaurdian'];

    $bloodGroup =$_POST['bloodGroup'];

    if($_POST['empCode1']){
        $empCode=$_POST['empCode1'];
        $sql="select COUNT(Emp_Code) as numRow from HrdMast where Emp_Code='$empCode' ";
        $result = query($query,$sql,$pa,$opt,$ms_db);
        $row = $fetch($result);
        if($row['numRow'] > 0){
            echo 2;
            return false;
        }
    }else{
        $empCode = $_POST['empCode1'];
    }

    if($_POST['doj'] == " "){
        $doj =  "00:00:00";

    }else{
        $doj = dateConversion($_POST['doj']);

    }
    if($_POST['dojWef'] == " "){
        $dojWef= "00:00:00";

    }else{
        $dojWef = dateConversion($_POST['dojWef']);

    }
    if($_POST['dob'] == ""){
        $dob = "00:00:00";

    }else{
        $dob = dateConversion($_POST['dob']);

    }
    if($_POST['annivdate'] == ""){
        $annivdate = "00:00:00";

    }else{
        $annivdate = dateConversion($_POST['annivdate']);

    }

    $sql="INSERT INTO HrdMast(Emp_Code, DOJ, DOJ_WEF,OEmailID, accessID, Emp_Title,Emp_FName, Emp_MName,Emp_LName,Status_Code,Sex,MStatus,Nationality,DOB, Religion,Anniversary,BloodGroup) VALUES
   ('$empCode', '$doj', '$dojWef','$oEmail','$accesscode','$Emp_title','$empFName','$empMName',
        '$empLName','01','$sex','$mStatus','$nationality','$dob','$religion','$annivdate','$bloodGroup')";
    $result = query($query,$sql,$pa,$opt,$ms_db);

    if($result){

	 $sql1="INSERT INTO HrdTran (Emp_Code,Trn_WEF,Trn_Date ,Status_Code, Grd_Code,Dsg_Code,Comp_Code, Loc_Code, Cost_Code, Proc_Code, Funct_Code, SFUNCT_CODE, WLOC_CODE, BussCode, Type_Code, Mngr_Code, Mngr_Code2, Regn_Code, Divi_Code, Level_CODE, SubBuss_ID,WorkPhone,WorkPhoneExt)
     VALUES ('$empCode','$doj',CONVERT(date, getdate()),'01','$grdCode','$dsCODE', '$compCode', '$locCode', '$costCode', '$procCode', '$functCode', '$subFunctCode', '$wLocCode', '$bussCode', '$empTypeCode', '$mngrCode', '$mngrCode2', '$regionMast', '$divisionMast', '$lavel', '$subBussUnit','$workphn', '$workphnExt')";
       $result1 = query($query,$sql1,$pa,$opt,$ms_db);

		if($result1){
                $passVar=array();
                $passComb="";
                $date_var = Array("DOB","DOJ");
                $user="U";
                $EMPCODE=md5($empCode);
                $email="";
                $userName =ucwords(strtolower($empFName." ".$empMName." ".$empLName));
                $userPass="";

                //for default password
                $policySql="Select default_password_status,default_password from PasswordPolicy";
                $policyRes= query($query,$policySql,$pa,$opt,$ms_db);
                $policyRow=$fetch($policyRes);
                 
                if($policyRow['default_password_status'] == 1){
                    $passVar=explode(",", $policyRow['default_password']);
                    //print_r($passVar);
                     $getPassSql = "SELECT ";
                    
                      for ($i = 0; $i < count($passVar); $i++) {
                        if($i>0)
                        $getPassSql .=",";
                        if(in_array($passVar[$i],$date_var)){
                          $getPassSql .="Replace(convert(varchar(10),DOJ,105),'-','') as $passVar[$i]" ;
                        }
                         else{
                          $getPassSql .="$passVar[$i]";
                        }
                      }
                      $getPassSql .=" FROM HrdMastQry WHERE Emp_Code='$empCode' ";
                      $getPassRes = query($query,$getPassSql,$pa,$opt,$ms_db);
                      while($getPassRow = $fetch($getPassRes)){
                        for ($j = 0; $j < count($passVar); $j++) {
                        $passComb.=$getPassRow[$j];
                      }
                       
                       $userPass=md5($passComb);
                      }
                   
                    $sql2="INSERT INTO Users(UserID,UserName,UserPWD,UserOptions,Useremailid, UserActive,UserType,flag) VALUES ('$EMPCODE','$userName','$userPass','1','";
                    if($oEmail=="") {
                        $sql2.="$email";
                        $flag=0;
                    }
                    else {
                        $email=md5($oEmail);
                        $sql2.="$email";
                        $flag=1;
                    }

                    $sql2.="','1', '$user',$flag)";
                    $result2 = query($query,$sql2,$pa,$opt,$ms_db);
                    if($result2){
                        if($oEmail==""){
                            echo 1;
                        }else{
                            $subject='Welcome message !';
                            $to=$oEmail;
                            $message=welcome_msg($empCode,$userPass);
                            $mail1=mymailer('donotreply@sequelone.com',$subject,$message,$to);
                             echo 1;
                        }
                      
                    }else{
                        echo 0;
                    }

                }
                else {
                     
                    $sql2="INSERT INTO Users(UserID,UserName,UserPWD,UserOptions,Useremailid, UserActive,UserType,flag) 
                                    VALUES ('$EMPCODE','$userName','$userPass','0','";
                    if($oEmail=="") {
                        $sql2.="$email";
                        $flag=0;
                    }
                    else {
                        $email=md5($oEmail);
                        $sql2.="$email";
                        $flag=1;
                    }

                    $sql2.="','0', '$user',$flag)";
                    $result2 = query($query,$sql2,$pa,$opt,$ms_db);
                    if($result2){
                        if($oEmail==""){
                            echo 1;
                        }else{
                            $subject='Welcome message !';
                            $to=$oEmail;
                            $message=welcome_msg($empCode,'no');
                            $mail1=mymailer('donotreply@sequelone.com',$subject,$message,$to);
                             echo 1;
                        }
                      
                    }else{
                        echo 0;
                    }
                }   

			
        }

    }else{
       
        echo 0;

    }

}


//To Add Bank Data
else if($_POST['type']== "bank_insert"){
    $empCode		=$_POST['empCode'];
    $smopCode		=$_POST['bankCode'];
    $ifscCode		=$_POST['ifscCode'];
    $smopNo			=$_POST['smopNo'];
    $rmopCode		=$_POST['reimbankCode'];
    $reimIfsc		=$_POST['reimIfsc'];
    $rmopNo			=$_POST['rmopNo'];


    $sql1 = "update HrdTran set SMOP_Code='$smopCode', SMOPNo='$smopNo', RMOP_Code='$rmopCode', RMOPNo='$rmopNo' where Emp_Code='$empCode'";
    $result = query($query,$sql1,$pa,$opt,$ms_db);

    if($result){
        echo 1;
        
    }else{
        echo 0;
        
    }

}

else if ($_POST['type']== "statury_insert"){

     $empCode  = $_POST['empCode'];
    $uanNo =  $_POST['uanNo'];
    $PfNo = $_POST['PfNo'];
    $esiNo = $_POST['esiNo'];
    $gaurdianName= $_POST['gaurdian'];

       
    $sql ="update HrdMast set PFNo='$PfNo', ESINo='$esiNo', UNNo='$uanNo' where Emp_Code='$empCode'";
    $result = query($query,$sql,$pa,$opt,$ms_db);
    if($result){
        $sqlQry="UPDATE HrdTran SET  GuardianName='$gaurdianName' where Emp_Code='$empCode' ";
        $resultqry = query($query,$sqlQry,$pa,$opt,$ms_db);
        if($resultqry) {
            echo 1;
           
        }else{
            echo 0;
        }
    }else{
        echo 0;
        
    }

}

else if ($_POST['type']== "identity_insert"){
    $empCode = $_POST['empCode'];
    $passNo =  $_POST['passNo'];
    $passPlace = $_POST['passPlace'];
    $passValidityDate = dateConversion($_POST['passValidityDate']);
    $passAddress = $_POST['passAddress'];
    $passDate =dateConversion($_POST['passIssue']);
    $dlNo = $_POST['dlNo'];
    $dlPlace = $_POST['dlPlace'];
    $dlDate = dateConversion($_POST['dlDate']);
    $dlValidityDate =dateConversion($_POST['dlValidityDate']);
    $dlAddress = $_POST['dlAddress'];
    $panNo = $_POST['panNo'];
    $adharNo = $_POST['adharNo'];

    $contract= $_POST['contract'];
    $registration= $_POST['registration'];
    $trade= $_POST['trade'];

     $sql ="update HrdMast set PassportNo='$passNo', PassportValidityDate='$passValidityDate', PassportAddress='$passAddress', PassportPlace='$passPlace', PIssueDate='$passDate', DIssueDate='$dlDate',
     DLNo='$dlNo', DLValidityDate='$dlValidityDate', DLAddress='$dlAddress', DLPlace='$dlPlace', PANNo='$panNo', AadharNo='$adharNo' where Emp_Code='$empCode' ";

    $result = query($query,$sql,$pa,$opt,$ms_db);
    if($result){
        $sql1="UPDATE hrdtran set Contract_type='$contract', Registration_No='$registration', Trade='$trade' where Emp_Code='$empCode' ";
        $result1 = query($query,$sql1,$pa,$opt,$ms_db);
        if($result1) {
            echo 1;
            
        }else{
            echo 2;
        }
    }else{
        echo 0;
       
    }

}

else if ($_POST['type']== "personal_insert"){
    $empCode = $_POST['empCode'];
    $statusCode = $_POST['statusCode'];
    $leavReas=$_POST['leavReas'];

    if($_POST['dol'] == ""){
        $dol="00:00:00";
    }else{
        $dol = dateConversion($_POST['dol']);
    }

    if($_POST['dos'] == ""){
        $dos="00:00:00";
    }else{
        $dos = dateConversion($_POST['dos']);
    }
    if($_POST['dor'] == ""){
        $dor="00:00:00";
    }else{
        $dor = dateConversion($_POST['dor']);
    }

   $sql ="update HrdMast set DOL='$dol', DOS='$dos', DOR='$dor', LeavReason='$leavReas', Status_Code='$statusCode'  where Emp_Code='$empCode' ";
    $result =  $result2 = query($query,$sql,$pa,$opt,$ms_db);
    if($result == TRUE){
        $sql1="UPDATE hrdtran set Status_Code='$statusCode'  where Emp_Code='$empCode' ";
       $result1 = query($query,$sql1,$pa,$opt,$ms_db);
        if ($result1){
            echo 1;
        }else{
            echo 0;
        }

    }else{
        echo 0;
        
    }

}

else if ($_POST['type']== "contact_insert"){
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
        
    }

}


// Start Validation Of All Fields In Add Employee


else if($_POST['type']=="empcodeValid"){
    $empCode= $_POST['empCode'];
    //echo $empCode;
    $sql="select COUNT(Emp_Code) as numRow from HrdMast where Emp_Code='$empCode' ";

    $result = query($query,$sql,$pa,$opt,$ms_db);
    $row = $fetch($result);
   if($row['numRow'] == 0){
       echo 0;
   }else{
       echo 1;
   }

}



// End Validation Of All Fields In Add Employee



function dateConversion($sDate){

        if(strpos($sDate, '-') !== false){
            $aDate = explode('-', $sDate);
        }else{
            $aDate = explode('/', $sDate);
        }
        
        @$sMySQLTimestamp = sprintf(
            '%s-%s-%s 00:00:00',
            @$aDate[2],
            @$aDate[1],
            @$aDate[0]
        );

    return $sMySQLTimestamp;

}
?>