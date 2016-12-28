<?php
session_start();

error_reporting(0);

include $_SERVER['DOCUMENT_ROOT'].$_SESSION['root']."pages/db_conn.php";
include $_SERVER['DOCUMENT_ROOT'].$_SESSION['root']."pages/configdata.php";

//include $_SERVER['DOCUMENT_ROOT'].$_SESSION['root']."pages/HRMSClass/HRMSFunction.php";
//To Edit Bussiness Unit
if(isset($_GET['pagetype']) and $_GET['pagetype']=='edit_business_unit'){

        $type=$_GET['type'];
    //echo$type;
    if($type=='Add'){

       $sql = "INSERT INTO BussMast(Buss_Code, BussName, BussHname, BussAbt,status) values 
('".trim($_POST[bussCode])."', '".trim($_POST[bussName])."', '$_POST[bussHname]',
  '$_POST[bussAbt]','1')";

        $sqlup="select * from Bussmast where " ;
        if($_POST[bussCode]==""){
            $sqlup.="BussName='".trim($_POST[bussCode])."'";
        }
        else {
            $sqlup .= " Buss_Code='".trim($_POST[bussName])."' or  BussName='".trim($_POST[bussName])."'";
    }
        $resultup=query($query,$sqlup,$pa,$opt,$ms_db);
        if($num($resultup)>0){
            echo 2;
        }else {
            $resultq = query($query, $sql, $pa, $opt, $ms_db);
            if ($resultq ) {
                echo 1;
            } else {
                die();
            }
        }
    }
    elseif($type=='Edit') {
        $OLDBUSSID = $_POST['BUSSID'];

        $sql = "UPDATE BussMast SET Buss_Code = '".trim($_POST[bussCode])."',
                              BussName = '".trim($_POST[bussName])."',
                              BussHname = '$_POST[bussHname]',
                              BussAbt ='$_POST[bussAbt]'
                               WHERE BUSSID ='$OLDBUSSID' ";
        $resultq = query($query, $sql, $pa, $opt, $ms_db);
        if ($resultq ) {
            echo 1;
        } else {
            die();
        }
    }



}

if(isset($_GET['pagetype']) and $_GET['pagetype']=='edit_subBusiness_unit'){

    $type=$_GET['type'];
    //echo$type;
    if($type=='Add'){

        $sql = "INSERT INTO subBussMast(subBuss_Code, subBussName, subBussHname, subBussAbt,status,SubBuss_ID) values 
('".trim($_POST[subBussCode])."', '".trim($_POST[subBussName])."', '$_POST[subBussHname]','$_POST[subBussAbt]','1','$_POST[subBussReport]')";
        $sqlup="select * from subBussMast where ";
if($_POST[subBussCode]=="") {
    $sqlup.=" subBussName='".trim($_POST[subBussName])."'";
}
else{
$sqlup.="subBuss_Code='".trim($_POST[subBussCode])."' or  subBussName='".trim($_POST[subBussName])."'";
}
        $resultup=query($query,$sqlup,$pa,$opt,$ms_db);
        if($num($resultup)>0){
            echo 2;
        }else {
            $resultq = query($query, $sql, $pa, $opt, $ms_db);
            if ($resultq ) {
                echo 1;
            } else {
                die();
            }
        }
    }
    elseif($type=='Edit') {
        $OLDsubBussID = $_POST['subBussID'];
        $sql = "UPDATE subBussMast SET subBuss_Code = '".trim($_POST[subBussCode])."',
                              subBussName = '".trim($_POST[subBussName])."',
                              subBussHname = '$_POST[subBussHname]',
                              subBussAddr ='$_POST[subBussAbt]',
                              SubBuss_ID='$_POST[subBussReport]'
                               WHERE subBussID ='$OLDsubBussID' ";
        $resultq = query($query, $sql, $pa, $opt, $ms_db);
        if ($resultq ) {
            echo 1;
        } else {
            die();
        }
    }

}
//To Edit Location
if(isset($_GET['pagetype']) and $_GET['pagetype']=='edit_location'){

          $type=$_GET['type'];
          //echo$type;
          if($type=='Add') {

              $sql = "INSERT INTO locMast (LOC_CODE, LOC_NAME,LOC_ADDR1, LOC_ADDR2,CITY,LOC_STATE, PIN_CODE, COUNTRY,locTimeZone,locCurrency,LOC_STATUS ) 
VALUES 
('".trim($_POST[locCode])."','".trim($_POST[locName])."','$_POST[locAdd1]','$_POST[locAdd2]','$_POST[locCity]','$_POST[locState]',
'$_POST[locPin]','$_POST[locCountry]','$_POST[loc_timezone]','$_POST[locCurrency]','1')";

              $sqlup="select * from LocMast where";
              if($_POST[locCode]==""){
                  $sqlup.="  LOC_NAME='".trim($_POST[locName])."'";
              }
              else{
                  $sqlup.=" LOC_CODE='".trim($_POST[locCode])."' or  LOC_NAME='".trim($_POST[locName])."'";
              }

              $resultup=query($query,$sqlup,$pa,$opt,$ms_db);
              if($num($resultup)>0){
                  echo 2;
              }
              else {
                  $resultq = query($query, $sql, $pa, $opt, $ms_db);
                  if ($resultq ) {
                      echo 1;
                  } else {
                      die();
                  }
              }

          }
          elseif($type=='Edit') {
              $id = $_POST['locId'];
              if (isset($id) and !empty($id)) {
                  $LOC_CODE = trim($_POST['locCode']);
                  $LOC_NAME = trim($_POST['locName']);
                  $LOC_ADDR1 = $_POST['locAdd1'];
                  $LOC_ADDR2 = $_POST['locAdd2'];
                  $CITY = $_POST['locCity'];
                  $LOC_STATE = $_POST['locState'];
                  $PIN_CODE = $_POST['locPin'];
                  $COUNTRY = $_POST['locCountry'];
                  $locTimeZone = $_POST['loc_timezone'];
                  $locCurrency = $_POST['locCurrency'];
                    $sql = "Update LocMast SET locTimeZone = '$locTimeZone', 
              locCurrency = '$locCurrency',
              LOC_CODE = '$LOC_CODE', 
              LOC_NAME = '$LOC_NAME',
              LOC_ADDR1 = '$LOC_ADDR1', 
              LOC_ADDR2 = '$LOC_ADDR2',  
              CITY = '$CITY', 
              LOC_STATE = '$LOC_STATE',  
              PIN_CODE = '$PIN_CODE', 
              COUNTRY = '$COUNTRY' WHERE LOCID='$id'";
                  $resultq = query($query, $sql, $pa, $opt, $ms_db);
                  if ($resultq ) {
                      echo 1;
                  } else {
                      die();
                  }
              }
          }

}
//To Edit work Location
if(isset($_GET['pagetype']) and $_GET['pagetype']=='edit_work_location'){
    $type=$_GET['type'];
if($type=='Add') {

     $sql = "INSERT INTO WorkLocMast(WLOC_CODE, WLOC_NAME,WLOC_ADD1, WLOC_ADD2, WLOC_CITY, WLOC_STATE, WLOC_PIN, WLOC_COUNTRY,wlocTimeZone,wlocCurrency,status)
 values ('".trim($_POST[wlocCode])."',' ".trim($_POST[wlocName])."','$_POST[wlocAdd1]','$_POST[wlocAdd2]','$_POST[wlocCity]','$_POST[wlocState]','$_POST[wlocPin]','$_POST[wlocCountry]','$_POST[wloc_timezone]','$_POST[wlocCurrency]','1')";

    $sqlup="select * from WorkLocMast where";
    if ($_POST[wlocCode]==""){
        $sqlup.=" wloc_Name='".trim($_POST[wlocName])."'";
    }
    else{
        $sqlup.=" wloc_Code='".trim($_POST[wlocCode])."' or  wloc_Name='".trim($_POST[wlocName])."'";
    }

    $resultup=query($query,$sqlup,$pa,$opt,$ms_db);
    if($num($resultup)>0){
        echo 2;
    }else {
        $resultq = query($query, $sql, $pa, $opt, $ms_db);
        if ($resultq ) {
            echo 1;
        } else {
            die();
        }
    }

}
elseif($type=='Edit') {
    $wlid =$_POST['wlid'];
    $resultq=false;
    if(isset($wlid) and !empty($wlid)) {
        $wlocCode = trim($_POST['wlocCode']);
        $wlocName = trim($_POST['wlocName']);
        $WLOC_ADD1 = $_POST['wlocAdd1'];
        $WLOC_ADD2 = $_POST['wlocAdd2'];
        $wlocCity = $_POST['wlocCity'];
        $wlocState = $_POST['wlocState'];
        $wlocPin = $_POST['wlocPin'];
        $wlocCountry = $_POST['wlocCountry'];
        $wlocTimeZone = $_POST['wloc_timezone'];
        $wlocCurrency = $_POST['wlocCurrency'];
         $sql = "Update WorkLocMast SET WLOC_CODE = '$wlocCode', WLOC_NAME = '$wlocName', 
                        WLOC_ADD1 = '$WLOC_ADD1', 
                        WLOC_ADD2 = '$WLOC_ADD2',  
                        WLOC_CITY = '$wlocCity', 
                        WLOC_STATE = '$wlocState',   
                        WLOC_PIN = '$wlocPin', 
                        WLOC_COUNTRY = '$wlocCountry',
                         wloctimezone='$wlocTimeZone',
                         wlocCurrency='$wlocCurrency' WHERE WorkLocID='$wlid'";
        $resultq = query($query, $sql, $pa, $opt, $ms_db);
        if ($resultq ) {
            echo 1;
        } else {
            die();
        }
    }
}

}

//To Edit State Details
if(isset($_GET['pagetype']) and $_GET['pagetype']=='edit_state'){

$type=$_GET['type'];
if($type=='Add') {
    
}

elseif($type=='Edit') {
    $ostateId = $_POST['ostateId'];
    $sql = "Update StateMast SET State_Name ='$_POST[stateName]',Country_Id = '$_POST[countryId]',State_Status = '$_POST[status]' WHERE StateID='$ostateId'";
}
    $resultq= query($query,$sql,$pa,$opt,$ms_db);
   if($resultq===TRUE){
        echo "State Details Updated Successfully..!";
    }else{
             die();
    }
}

//To Edit University
if(isset($_GET['pagetype']) and $_GET['pagetype']=='editUniv'){
$type=$_GET['type'];
if($type=='Add') {

}

elseif($type=='Edit') {
    $oldUnivCode = $_POST['oldUnivCode'];
    $sql = "UPDATE UnivMast SET 
      Univ_Name ='$_POST[univName]',
      Univ_Categ = '$_POST[Univ_Categ]'
      WHERE Univ_Code = '$oldUnivCode'";
}
  $resultq=query($query,$sql,$pa,$opt,$ms_db);
  if($resultq===TRUE){
      echo "University Edited Successfully..!";
  }else{
             die();
  }
}

//To Edit Bank Details
if(isset($_GET['pagetype']) and $_GET['pagetype']=='edit_bank_details'){

$type=$_GET['type'];
if($type=='Add') {

    echo $sql = "INSERT INTO BankMast (BANK_CODE, BANK_NAME, BANK_BRANCH,BANK_IFSC, BANK_MICR, BankType , COMP_IFSC,COMP_MICR,BANK_ACCNO)
      VALUES 
      ('".trim($_POST[bankCode])."', '".trim($_POST[bankName])."', '$_POST[bankBranch]', '$_POST[bankIFSC]', '$_POST[bankMICR]', '$_POST[bankType]','$_POST[compIFSC]','$_POST[compMICR]','$_POST[compBankAcNo]')";

    $sqlup="select * from bankMast where";
    if ($_POST[bankCode]==""){
        $sqlup.=" bankName='".trim($_POST[bankName])."'";
    }
    else{
        $sqlup.=" bankCode='".trim($_POST[bankCode])."' or  bankName='".trim($_POST[bankName])."'";
    }

    $resultup=query($query,$sqlup,$pa,$opt,$ms_db);
    if($num($resultup)>0){
        echo 2;
    }else {
        $resultq = query($query, $sql, $pa, $opt, $ms_db);
        if ($resultq ) {
            echo 1;
        } else {
            die();
        }
    }
}
elseif($type=='Edit') {

    $oldBankCode = $_POST['oldBankCode'];
    $sql = "UPDATE bankmast SET 
  bankCode ='".trim($_POST[bankCode])."',
  bankName = '".trim($_POST[bankName])."',
  bankBranch = '$_POST[bankBranch]',
  bankIFSC = '$_POST[bankIFSC]',
  bankMICR = '$_POST[bankMICR]',
  bankType= '$_POST[bankType]',
  compIFSC = '$_POST[compIFSC]',
  compMICR    = '$_POST[compMICR]',
  compBankAcNo = $_POST[compBankAcNo]
  WHERE bankID = '$oldBankCode'";

    $resultq = query($query, $sql, $pa, $opt, $ms_db);
    if ($resultq ) {
        echo 1;
    } else {
        die();
    }
}

}

//To Edit City Details
if(isset($_GET['pagetype']) and $_GET['pagetype']=='edit_city'){
$type=$_GET['type'];
if($type=='Add') {

}

elseif($type=='Edit') {
    $cityId = $_POST['cityId'];
    $sql = "Update cityMast SET 
  city_Name ='$_POST[cityName]',
  State_Id = '$_POST[stateId]' WHERE cityId='$cityId'";
}
  $resultq=query($query,$sql,$pa,$opt,$ms_db);
  if($resultq===TRUE){
      echo "City Details Updated Successfully..!";
    }
    else{
             die();
    }
  
}
//To Edit Cost Allocation Details

if(isset($_GET['pagetype']) and $_GET['pagetype']=='edit_cost_allocation'){
  $OempCode = $_POST['OempCode'];
  $sql="Update costallocmast SET empCode = '$_POST[empCode]',
    sNo = '$_POST[sNo]',
    costPer = '$_POST[costPer]',
    orgMaster = '$_POST[orgMaster]'
    WHERE empCode = '$OempCode'";
  $resultq=query($query,$sql,$pa,$opt,$ms_db);
  if($resultq===TRUE){
      echo "Cost Allocation Details Updated Successfully..!";
    }
    else{
             die();
    }
  }

//To Edit Cost center
if(isset($_GET['pagetype']) and $_GET['pagetype']=='edit_cost'){
$type=$_GET['type'];
if($type=='Add') {
    $sql = "INSERT INTO CostMast (COST_CODE, COST_NAME,Cost_status) VALUES ('".trim($_POST[costCode])."', '".trim($_POST[costName])."','1')" ;
    $sqlup="select * from CostMast where";
    if($_POST[costCode]==""){
        $sqlup.=" cost_Name='".trim($_POST[costName])."'";
    }
    else{
        $sqlup.=" cost_Code='".trim($_POST[costCode])."' or  cost_Name='".trim($_POST[costName])."'";
    }

    $resultup=query($query,$sqlup,$pa,$opt,$ms_db);
    if($num($resultup)>0){
        echo 2;
    }else {
        $resultq = query($query, $sql, $pa, $opt, $ms_db);
        if ($resultq ) {
            echo 1;
        } else {
            die();
        }
    }
}

elseif($type=='Edit') {
    $oldCostCode = $_POST['oldCostCode'];
    $sql = "Update costmast SET cost_Code = '".trim($_POST[costCode])."',
  cost_Name = '".trim($_POST[costName])."' 
  WHERE costID = '$oldCostCode'";
    $resultq = query($query, $sql, $pa, $opt, $ms_db);
    if ($resultq ) {
        echo 1;
    } else {
        die();
    }
}


}

//To Edit Country
if(isset($_GET['pagetype']) and $_GET['pagetype']=='edit_country'){
$type=$_GET['type'];
if($type=='Add') {
    $sql = "INSERT INTO CountryMast (Country_CODE, Country_NAME,status) VALUES ('$_POST[countryCode]', '$_POST[countryName]','1')";

}

elseif($type=='Edit') {
    $countryId = $_POST['countryId'];
    $sql = "Update CountryMast SET country_code = '$_POST[countryCode]',country_name = '$_POST[countryName]'
  WHERE countryId = '$countryId'";
}
  $resultq=query($query,$sql,$pa,$opt,$ms_db);
  if($resultq===TRUE){
      echo 1;
    }else{
         die();
    }
}

//To Edit Employee Type
if(isset($_GET['pagetype']) and $_GET['pagetype']=='edit_emp_type'){
$type=$_GET['type'];
if($type=='Add') {
    $sql = "INSERT INTO TypeMast (TYPE_CODE,  TYPE_NAME,TYPE_ABT ,status) VALUES ('".trim($_POST[empTypeCode])."', '".trim($_POST[empTypeName])."','$_POST[empTypeAbt]','1')";

    $sqlup="select * from TypeMast where";
    if($_POST[empTypeCode]==""){
        $sqlup.=" type_Name='".trim($_POST[empTypeName])."'";
    }
    else{
        $sqlup.=" type_Code='".trim($_POST[empTypeCode])."' or  type_Name='".trim($_POST[empTypeName])."'";
    }

    $resultup=query($query,$sqlup,$pa,$opt,$ms_db);
    if($num($resultup)>0){
        echo 2;
    }else {
        $resultq = query($query, $sql, $pa, $opt, $ms_db);
        if ($resultq ) {
            echo 1;
        } else {
            die();
        }
    }
}

elseif($type=='Edit') {
    $typeid = $_POST['TYPEID'];

    $sql = "UPDATE TypeMast SET TYPE_CODE = '".trim($_POST[empTypeCode])."',
   TYPE_NAME = '".trim($_POST[empTypeName])."',TYPE_ABT='$_POST[empTypeAbt]' WHERE TYPEID = '$typeid'";
    $resultq = query($query, $sql, $pa, $opt, $ms_db);
    if ($resultq ) {
        echo 1;
    } else {
        die();
    }
}

}

//To Edit Designation
if(isset($_GET['pagetype']) and $_GET['pagetype']=='edit_DSG'){
    $type=$_GET['type'];
    if($type=='Add') {
         $sql = "INSERT INTO DSGMast (DSG_CODE,  DSG_NAME,DSG_ABT ,Dsg_status) VALUES ('".trim($_POST[DSGCode])."', '".trim($_POST[DSGName])."','$_POST[DSGAbt]','1')";
        $sqlup="select * from DSGMast where" ;
        if($_POST[DSGCode]==""){
            $sqlup.="DSG_Name='".trim($_POST[DSGName])."'";
        }
        else {
            $sqlup .= "DSG_Code='".trim($_POST[DSGCode])."' or  DSG_Name='".trim($_POST[DSGName])."'";
        }
        $resultup=query($query,$sqlup,$pa,$opt,$ms_db);
        if($num($resultup)>0){
            echo 2;
        }else {
            $resultq = query($query, $sql, $pa, $opt, $ms_db);
            if ($resultq ) {
                echo 1;
            } else {
                die();
            }
        }
    }

    elseif($type=='Edit') {
        $DSGid = $_POST['DSGID'];

        $sql = "UPDATE DSGMast SET DSG_CODE = '".trim($_POST[DSGCode])."',
   DSG_NAME = '".trim($_POST[DSGName])."',DSG_ABT='$_POST[DSGAbt]' WHERE DSGID = '$DSGid'";
        $resultq = query($query, $sql, $pa, $opt, $ms_db);
        if ($resultq ) {
            echo 1;
        } else {
            die();
        }
    }

}

//To Edit Region
if(isset($_GET['pagetype']) and $_GET['pagetype']=='edit_REGN'){
    $type=$_GET['type'];
    if($type=='Add') {
        $sql = "INSERT INTO REGNMast (REGN_CODE,  REGN_NAME,REGN_ABT ,REGN_status) VALUES ('".trim($_POST[REGNCode])."', '".trim($_POST[REGNName])."','$_POST[REGNAbt]','1')";
        $sqlup="select * from REGNMast where";
        if($_POST[REGNCode]==""){
            $sqlup.=" REGN_Name='".trim($_POST[REGNName])."'";
        }
        else{
            $sqlup.=" REGN_Code='".trim($_POST[REGNCode])."' or  REGN_Name='".trim($_POST[REGNName])."'";
        }

        $resultup=query($query,$sqlup,$pa,$opt,$ms_db);
        if($num($resultup)>0){
            echo 2;
        }else {
            $resultq = query($query, $sql, $pa, $opt, $ms_db);
            if ($resultq ) {
                echo 1;
            } else {
                die();
            }
        }
    }

    elseif($type=='Edit') {
        $REGNid = $_POST['REGNID'];

        $sql = "UPDATE REGNMast SET REGN_CODE = '".trim($_POST[REGNCode])."',
   REGN_NAME = '".trim($_POST[REGNName])."',REGN_ABT='$_POST[REGNAbt]' WHERE REGNID = '$REGNid'";

        $resultq = query($query, $sql, $pa, $opt, $ms_db);
        if ($resultq ) {
            echo 1;
        } else {
            die();
        }
    }

}

//To Edit Division
if(isset($_GET['pagetype']) and $_GET['pagetype']=='edit_DIVI'){
    $type=$_GET['type'];
    if($type=='Add') {
        $sql = "INSERT INTO DIVIMast (DIVI_CODE,  DIVI_NAME,DIVI_ABT ,DIVI_status) VALUES ('".trim($_POST[DIVICode])."', '".trim($_POST[DIVIName])."','$_POST[DIVIAbt]','1')";
        $sqlup="select * from DIVIMast where";
        if($_POST[DIVICode]==""){
            $sqlup.="  DIVI_Name='".trim($_POST[DIVIName])."'";
        }
        else{
            $sqlup.=" DIVI_Code='".trim($_POST[DIVICode])."' or  DIVI_Name='".trim($_POST[DIVIName])."'";
        }

        $resultup=query($query,$sqlup,$pa,$opt,$ms_db);
        if($num($resultup)>0){
            echo 2;
        }else {
            $resultq = query($query, $sql, $pa, $opt, $ms_db);
            if ($resultq ) {
                echo 1;
            } else {
                die();
            }
        }
    }

    elseif($type=='Edit') {
        $DIVIid = $_POST['DIVIID'];

        $sql = "UPDATE DIVIMast SET DIVI_CODE = '".trim($_POST[DIVICode])."',
   DIVI_NAME = '".trim($_POST[DIVIName])."',DIVI_ABT='$_POST[DIVIAbt]' WHERE DIVIID = '$DIVIid'";
        $resultq = query($query, $sql, $pa, $opt, $ms_db);
        if ($resultq ) {
            echo 1;
        } else {
            die();
        }
    }

}

//To Edit Function
if(isset($_GET['pagetype']) and $_GET['pagetype']=='edit_function'){

$type=$_GET['type'];
if($type=='Add') {

    $sql = "INSERT INTO FUNCTMast (FUNCT_CODE,  FUNCT_NAME,  FUNCT_Add,  FUNCTHEAD,status) VALUES ('".trim($_POST[functCode])."', '".trim($_POST[functName])."', '$_POST[functAdd]', '$_POST[functHead]','1')";

    $sqlup="select * from FUNCTMast where";
    if($_POST[functCode]==""){
        $sqlup.=" FUNCT_Name='".trim($_POST[functName])."'";
    }
    else{
        $sqlup.=" FUNCT_Code='".trim($_POST[functCode])."' or  FUNCT_Name='".trim($_POST[functName])."'";
    }

    $resultup=query($query,$sqlup,$pa,$opt,$ms_db);
    if($num($resultup)>0){
        echo 2;
    }else {
        $resultq = query($query, $sql, $pa, $opt, $ms_db);
        if ($resultq ) {
            echo 1;
        } else {
            die();
        }
    }
}
    elseif($type=="Edit") {
        $functId = $_POST['functId'];
        $functCode = trim($_POST['functCode']);
        $functName = trim($_POST['functName']);
        $functAdd = $_POST['functAdd'];
        $functHead = $_POST['functHead'];
        $sql = "UPDATE functmast SET FUNCT_CODE = '$functCode',FUNCT_NAME = '$functName',FUNCT_Add = '$functAdd',FUNCTHEAD = '$functHead' WHERE FunctID ='$functId' ";
        $resultq = query($query, $sql, $pa, $opt, $ms_db);
        if ($resultq ) {
            echo 1;
        } else {
            die();
        }

    }

}

//To Edit Grade
if(isset($_GET['pagetype']) and $_GET['pagetype']=='edit_grade'){
$type=$_GET['type'];
if($type=='Add') {

     $sql = "INSERT INTO GrdMast(GRD_CODE, GRD_NAME,Grd_status)VALUES ('".trim($_POST[grdCode])."','".trim($_POST[grdName])."','1')";
    $sqlup="select * from grdmast where";
    if($_POST[grdCode]==""){
        $sqlup.="  GRD_NAME='".trim($_POST[grdName])."'";
    }
    else{
        $sqlup.=" GRD_CODE='".trim($_POST[grdCode])."' or  GRD_NAME='".trim($_POST[grdName])."'";
    }

    $resultup=query($query,$sqlup,$pa,$opt,$ms_db);
    if($num($resultup)>0){
        echo 2;
    }else{
        $result=query($query,$sql,$pa,$opt,$ms_db);
        if($result){
            echo 1;
        }else{
            die();
        }
    }
}
elseif($type=="Edit") {
    $GRDID = $_POST['GRDID'];
    $grdCode = trim($_POST['grdCode']);
    $grdName = trim($_POST['grdName']);

      $sql = "UPDATE grdmast SET GRD_CODE='$grdCode', GRD_NAME='$grdName' WHERE GRDID='$GRDID'";
    $result=query($query,$sql,$pa,$opt,$ms_db);
    if($result){
        echo 1;
    }else{
        die();
    }
}

}

//TO Edit Level
//if(isset($_GET['pagetype']) and $_GET['pagetype']=='edit_level'){
//    $olevelCode=$_POST['olevelCode'];
//    $sql="UPDATE levelmast SET levelCode = '$_POST[levelCode]',
//                           levelName ='$_POST[levelName]'
//                           WHERE levelCode = '$olevelCode'";
//    if($resultq===TRUE){
//      echo "Level Edited Successfully..!";
//    }else{
//      die();
//    }
//}

//To Edit Process
if(isset($_GET['pagetype']) and $_GET['pagetype']=='edit_process'){
$type=$_GET['type'];
if($type=='Add') {
    $sql = "INSERT INTO PROCMAST (PROC_CODE, PROC_NAME,proc_status) VALUES ('".trim($_POST[procCode])."', '".trim($_POST[procName])."','1')";

    $sqlup="select * from procmast where";
    if($_POST[procCode]==""){
        $sqlup.=" PROC_NAME='".trim($_POST[procName])."'";
    }
    else{
        $sqlup.=" PROC_CODE='".trim($_POST[procCode])."' or  PROC_NAME='".trim($_POST[procName])."'";
    }

    $resultup=query($query,$sqlup,$pa,$opt,$ms_db);
    if($num($resultup)>0){
        echo 2;
    }else {
        $resultq = query($query, $sql, $pa, $opt, $ms_db);
        if ($resultq ) {
            echo 1;
        } else {
            die();
        }
    }
}
elseif($type=="Edit") {
    $PROCID = $_POST['PROCID'];
    $sql = "UPDATE procmast SET 
  PROC_CODE = '".trim($_POST[procCode])."',
  PROC_NAME ='".trim($_POST[procName])."'
  WHERE PROCID = '$PROCID'";
    $resultq = query($query, $sql, $pa, $opt, $ms_db);
    if ($resultq ) {
        echo 1;
    } else {
        die();
    }
}

}

//To Edit Qualification
if(isset($_GET['pagetype']) and $_GET['pagetype']=='edit_qualification'){
$type=$_GET['type'];
if($type=='Add') {
     $sql = "INSERT INTO QualMast (Qual_Code, Qual_Name,Qual_status) VALUES ('".trim($_POST[qualCode])."', '".trim($_POST[qualName])."','1')";
    $sqlup="select * from qualMast where";
    if($_POST[qualCode]==""){
        $sqlup.=" qual_Name='".trim($_POST[qualName])."'";
    }
    else{
        $sqlup.=" qual_Code='".trim($_POST[qualCode])."' or  qual_Name='".trim($_POST[qualName])."'";
    }

    $resultup=query($query,$sqlup,$pa,$opt,$ms_db);
    if($num($resultup)>0){
        echo 2;
    }else {
        $resultq = query($query, $sql, $pa, $opt, $ms_db);
        if ($resultq ) {
            echo 1;
        } else {
            die();
        }
    }
}
elseif($type=="Edit") {
    $oqualCode = $_POST['oqualCode'];
    $qualCode = trim($_POST['qualCode']);
    $qualName = trim($_POST['qualName']);
     $sql = "UPDATE qualmast SET qual_Code ='$qualCode', qual_Name='$qualName' WHERE qualID = '$oqualCode'";
    $resultq = query($query, $sql, $pa, $opt, $ms_db);
    if ($resultq ) {
        echo 1;
    } else {
        die();
    }
}

}

//To Edit Holiday
if(isset($_GET['pagetype']) and $_GET['pagetype']=='edit_holiday'){
$type=$_GET['type'];
if($type=='Add') {
   
}
elseif($type=="Edit") {
    $holidayID = $_POST['holidayID'];
    $hDate = $_POST['hDate'];
    $locCode = $_POST['locCode'];
    $hCode = $_POST['hCode'];
    $hDesc = $_POST['hDesc'];
    $sql = "UPDATE holidays SET HDATE ='$hDate', LOC_CODE='$locCode', HCODE='$hCode', HDESC='$hDesc' WHERE holidayID='$holidayID'";
}
    $resultq=query($query,$sql,$pa,$opt,$ms_db);
    if($resultq===TRUE){
        echo "Holiday Edited Successfully..!";
    }else{
        die();
    }
}
//To Edit sub function
if(isset($_GET['pagetype']) and $_GET['pagetype']=='edit_sub_function'){

$type=$_GET['type'];
if($type=='Add') {

    $sql = "INSERT INTO SubFunctMast(SubFunct_CODE, SubFunct_NAME, SubFunct_HEAD,SubFunct_Abt, Func_Code,Status) VALUES 
('".trim($_POST[subFunctCode])."', '".trim($_POST[subFunctName])."', '$_POST[emplyeemaster]', '$_POST[subfunctAdd]','$_POST[mainfunctionlist]','1')";

    $sqlup="select * from subfunctMast where";
    if($_POST[subfunctCode]==""){
        $sqlup.="subfunct_Name='".trim($_POST[subfunctName])."'";
    }
    else{
        $sqlup.=" subfunct_Code='".trim($_POST[subfunctCode])."' or  subfunct_Name='".trim($_POST[subfunctName])."'";
    }

    $resultup=query($query,$sqlup,$pa,$opt,$ms_db);
    if($num($resultup)>0){
        echo 2;
    }else {
        $resultq = query($query, $sql, $pa, $opt, $ms_db);
        if ($resultq ) {
            echo 1;
        } else {
            die();
        }
    }

}
elseif($type=="Edit") {

    $subfunctID = $_POST['subfunctID'];
    $subFunctCode = trim($_POST['subFunctCode']);
    $subFunctName = trim($_POST['subFunctName']);
    $subFunctHead = $_POST['emplyeemaster'];
    $subFunctAbt = $_POST['subfunctAdd'];
    $functCode = $_POST['mainfunctionlist'];
    $sql = "UPDATE subfunctmast SET SubFunct_CODE='$subFunctCode',SubFunct_Abt='$subFunctAbt' , SubFunct_NAME='$subFunctName',SubFunct_HEAD='$subFunctHead',Func_Code='$functCode' WHERE SubFunctID='$subfunctID'";
    $resultq = query($query, $sql, $pa, $opt, $ms_db);
    if ($resultq ) {
        echo 1;
    } else {
        die();
    }

}

}

//To Edit Reason Master
if(isset($_GET['pagetype']) and $_GET['pagetype']=='edit_reason'){
$type=$_GET['type'];
if($type=='Add') {

}
elseif($type=="Edit") {
    $rcode = $_POST['rcode'];
    $Rcode = $_POST['Rcode'];
    $Rname = $_POST['Rname'];
    $Rcategory = $_POST['Rcategory'];
    $Rdetail = $_POST['Rdetail'];
    $sql = "UPDATE reasonmast SET Rcode='$Rcode', Rname='$Rname', Rcategory='$Rcategory', Rdetail='$Rdetail' WHERE Rcode='$rcode'";

}
$resultq=query($query,$sql,$pa,$opt,$ms_db);
if($resultq===TRUE){
      echo "Reason Master Edited Successfully..!";
    }
    else{
             die();
    }
}

//To Edit Roles
if(isset($_GET['pagetype']) and $_GET['pagetype']=='edit_roles'){
$type=$_GET['type'];
if($type=='Add') {

}
elseif($type=="Edit") {
    $oroleCODE = $_POST['oroleCODE'];
    $sql = "UPDATE rolemast SET roleCODE='$_POST[roleCODE]', roleNAME='$_POST[roleNAME]', roleGrp='$_POST[roleGrp]', roleMngr='$_POST[roleMngr]', roleProfile='$_POST[roleProfile]', roleQuali='$_POST[roleQuali]', roleSkill='$_POST[roleSkill]', roleExp='$_POST[roleExp]', roleOther='$_POST[roleOther]',roleJobDesc='$_POST[roleJobDesc]', roleHiringTime='$_POST[roleHiringTime]' WHERE roleCODE='$oroleCODE'";
}
    
    $resultq=query($query,$sql,$pa,$opt,$ms_db);
if($resultq===TRUE){
        echo "Role Master Edited Successfully..!";
    }else{
        die();
    }
}

//To Edit Option Master
if(isset($_GET['pagetype']) and $_GET['pagetype']=='edit_optionMast'){
$type=$_GET['type'];
if($type=='Add') {

}
elseif($type=="Edit") {
    $ofieldName = $_POST['ofieldName'];
    $sql = "UPDATE optionmast SET 
	fieldName ='$_POST[fieldName]',
	fieldValue = '$_POST[fieldValue]',
	fieldText = '$_POST[fieldText]',
	fieldActive = '$_POST[fieldActive]',
	fieldOrderNo = '$_POST[fieldOrderNo]',
	fieldDefault = '$_POST[fieldDefault]'
	type = '$_POST[type]'
WHERE fieldName='$ofieldName'";
}
$resultq=query($query,$sql,$pa,$opt,$ms_db);
if($resultq===TRUE){
          echo "Option Master Edited Successfully..!";
    }else{
            die();
    }
}
?>
