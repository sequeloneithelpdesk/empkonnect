<?php
include '../db_conn.php';
//To Add Locations in locMast Table.
//$resize = json_decode($_POST['name_print']);
if(isset($_GET['pagetype']) and $_GET['pagetype']=='add_location'){
  //$resize = json_decode($_POST['name_print']);
$sql="INSERT INTO locMast (locCode, locName, locType, locParent, locWork, locAdd1, locAdd2, locCity, locState, locPin, locCountry, locPfCode, locEsiCode) VALUES ('$_POST[locCode]', '$_POST[locName]', '$_POST[locType]', '$_POST[locParent]', '$_POST[locWork]', '$_POST[locAdd1]', '$_POST[locAdd2]', '$_POST[locCity]', '$_POST[locState]', '$_POST[locPin]', '$_POST[locCountry]', '$_POST[locPfCode]', '$_POST[locEsiCode]')";
    if ($conn->query($sql) === TRUE) {
      echo "Form submitted.";
     exit;         
    }
    else{
    echo "There is some problem: " . "<br>" . $conn->error;
     }
}
//To Add Business Unit in bussMast Table
if(isset($_GET['pagetype']) and $_GET['pagetype']=='add_business_unit'){
  
if(isset($_POST['bussCode']) && !empty($_POST['bussCode']) &&  isset($_POST['bussName']) && !empty($_POST['bussName']) &&  isset($_POST['bussHname']) && !empty($_POST['bussHname']) && isset($_POST['bussReport']) && !empty($_POST['bussReport']) && isset($_POST['bussCur']) && !empty($_POST['bussCur'])){
    echo  $sql= "INSERT INTO bussMast (bussCode, bussName, bussHname,bussReport, bussAbt, bussAddr, bussCity, bussPin, bussState, bussCur)
      VALUES
      ('$_POST[bussCode]', '$_POST[bussName]', '$_POST[bussHname]', '$_POST[bussReport]', '$_POST[bussAbt]', '$_POST[bussAddr]', '$_POST[bussCity]', '$_POST[bussPin]', '$_POST[bussState]', '$_POST[bussCur]')";
      if ($conn->query($sql) === TRUE) {
      echo "Business Unit Added Successfully..";
     exit;              
    }
    else{
    echo "There is some problem: " . "<br>" . $conn->error;
     }
    }
}


//To Add Bank Details in bankMast Table
if(isset($_GET['pagetype']) and $_GET['pagetype']=='add_bank_details'){

if( isset($_POST['bankCode']) && !empty($_POST['bankCode']) &&  
    isset($_POST['bankName']) && !empty($_POST['bankName']) &&  
    isset($_POST['bankBranch']) && !empty($_POST['bankBranch']) && 
    isset($_POST['bankIFSC']) && !empty($_POST['bankIFSC']) && 
    isset($_POST['bankType']) && !empty($_POST['bankType']) && 
    isset($_POST['compIFSC']) && !empty($_POST['compIFSC']) && 
    isset($_POST['compMICR']) && !empty($_POST['compMICR']) && 
    isset($_POST['compBankAcNo']) && !empty($_POST['compBankAcNo']) ){
     $sql= "INSERT INTO bankmast (bankCode, bankName, bankBranch,bankIFSC, bankMICR, bankType ,bankAddress, bankPhone, bankCity, bankState, bankPin, compIFSC,compMICR,compBankAcNo )
      VALUES
      ('$_POST[bankCode]', '$_POST[bankName]', '$_POST[bankBranch]', '$_POST[bankIFSC]', '$_POST[bankMICR]', '$_POST[bankType]','$_POST[bankAddress]', '$_POST[bankPhone]','$_POST[bankCity]', '$_POST[bankState]', '$_POST[bankPin]','$_POST[compIFSC]','$_POST[compMICR]','$_POST[compBankAcNo]')";
      if ($conn->query($sql) === TRUE) {
      echo "Bank Details Added Successfully..";
     exit;              
    }
    else{
    echo "There is some problem: " . "<br>" . $conn->error;
     }
    }
}


//To Add Functions
if(isset($_GET['pagetype']) and $_GET['pagetype']=='add_function'){
  
if(isset($_POST['functCode']) && !empty($_POST['functCode']) &&  isset($_POST['functName']) && !empty($_POST['functName']) &&  isset($_POST['functType']) && !empty($_POST['functType']) && isset($_POST['functHead']) && !empty($_POST['functHead'])){
$sql="INSERT INTO functMast (functCode,  functName,  functType,  functHead) VALUES ('$_POST[functCode]', '$_POST[functName]', '$_POST[functType]', '$_POST[functHead]')";
if ($conn->query($sql) === TRUE) {
  echo "Function Added Successfully..";
     exit;              
    }
    else{
    echo "There is some problem: " . "<br>" . $conn->error;
     }
}
}
//To Add Work Location
if(isset($_GET['pagetype']) and $_GET['pagetype']=='add_work_location'){
  
    $sql = "INSERT INTO workLocMast (wLocCode, wLocName, wLocType, wLocParent, wLocWork, wLocAdd1, wLocAdd2, wLocCity, wLocState, wLocPin, wLocCountry) VALUES ('$_POST[wlocCode]', '$_POST[wlocName]', '$_POST[wlocType]', '$_POST[wlocParent]', '$_POST[wlocWork]', '$_POST[wlocAdd1]', '$_POST[wlocAdd2]', '$_POST[wlocCity]', '$_POST[wlocState]', '$_POST[wlocPin]', '$_POST[wlocCountry]')";
    if ($conn->query($sql) === TRUE) {
      echo "Work Location Added Successfully..";
     exit;              
    }
    else{
    echo "There is some problem: " . "<br>" . $conn->error;
     }
    
  }

//To Add Employee Type
if(isset($_GET['pagetype']) and $_GET['pagetype']=='add_emp_type'){  
   if(isset($_POST['empTypeCode']) && !empty($_POST['empTypeCode']) &&  isset($_POST['empTypeName']) && !empty($_POST['empTypeName']) &&  isset($_POST['empTypeAbt']) && !empty($_POST['empTypeAbt'])){
      $sql="INSERT INTO emptypemast (empTypeCode,  empTypeName,  empTypeAbt) VALUES ('$_POST[empTypeCode]', '$_POST[empTypeName]', '$_POST[empTypeAbt]')";
        if ($conn->query($sql) === TRUE) {
          echo "Employee Type Added Successfully..";
            exit;              
           }
    else{
    echo "There is some problem: " . "<br>" . $conn->error;
     }
}
}
// To Add Cost Allocation Master
if(isset($_GET['pagetype']) && $_GET['pagetype']=='add_cost_allocation'){
  if(isset($_POST['empCode']) && !empty($_POST['empCode']) &&  isset($_POST['sNo']) && !empty($_POST['sNo']) &&  isset($_POST['costPer']) && !empty($_POST['costPer']) && isset($_POST['orgMaster']) && !empty($_POST['orgMaster']) ){
    $sql="INSERT INTO costAllocMast(empCode, sNo, costPer, orgMaster) VALUES ('$_POST[empCode]','$_POST[sNo]', '$_POST[costPer]', '$_POST[orgMaster]')";
    if($conn->query($sql)===TRUE){
      echo "Cost Allocation Master Added Successfully..!";
    }
    else{
      echo "There is some problem: " . "<br>" . $conn->error;
    }
  }
}

//To Add Roles
if(isset($_GET['pagetype']) and $_GET['pagetype']=='add_roles'){
  if(isset($_POST['roleCODE']) && !empty($_POST['roleCODE']) &&  isset($_POST['roleNAME']) && !empty($_POST['roleNAME']) &&  isset($_POST['roleGrp']) && !empty($_POST['roleGrp']) && isset($_POST['roleMngr']) && !empty($_POST['roleMngr'])){
    $sql="INSERT INTO roleMast (roleCODE, roleNAME, roleGrp, roleMngr, roleProfile, roleQuali, roleSkill, roleExp, roleOther, roleJobDesc, roleHiringTime) VALUES
    ('$_POST[roleCODE]', '$_POST[roleNAME]', '$_POST[roleGrp]', '$_POST[roleMngr]', '$_POST[roleProfile]', '$_POST[roleQuali]', '$_POST[roleSkill]', '$_POST[roleExp]', '$_POST[roleOther]', '$_POST[roleJobDesc]', '$_POST[roleHiringTime]')";
    if ($conn->query($sql) === TRUE) {
      echo "New Role Added Successfully..!";
    }
    else{
      echo "There is some problem: " . "<br>" . $conn->error;
    }
  }
}
//To Add Grades
if(isset($_GET['pagetype']) and $_GET['pagetype']=='add_grade'){
  if(isset($_POST['grdCode']) && !empty($_POST['grdCode']) &&  isset($_POST['grdName']) && !empty($_POST['grdName']) &&  isset($_POST['grdUnder']) && !empty($_POST['grdUnder'])){
     $sql="INSERT INTO grdMast(grdCode, grdName, grdUnder) VALUES ('$_POST[grdCode]','$_POST[grdName]', '$_POST[grdUnder]')";
    if($conn->query($sql)===TRUE){
      echo "Grade Added Successfully..!";
    }
    else{
      echo "There is some problem: " . "<br>" . $conn->error;
    }
    }
  }
//To add Level
if(isset($_GET['pagetype']) and $_GET['pagetype']=='add_level'){
  if(isset($_POST['levelCode']) && !empty($_POST['levelCode']) &&  isset($_POST['levelName']) && !empty($_POST['levelName'])){
     $sql="INSERT INTO levelMast (levelCode, levelName) VALUES ('$_POST[levelCode]', '$_POST[levelName]')";
    if($conn->query($sql)===TRUE){
      echo "Level Added Successfully..!";
    }
    else{
      echo "There is some problem: " . "<br>" . $conn->error;
    }
    }
  }
//To Add New Process
if(isset($_GET['pagetype']) and $_GET['pagetype']=='add_process'){
  if(isset($_POST['procCode']) && !empty($_POST['procCode']) &&  isset($_POST['procName']) && !empty($_POST['procName'])){
    $sql="INSERT INTO procMast (procCode, procName) VALUES ('$_POST[procCode]', '$_POST[procName]')";
    if($conn->query($sql)===TRUE){
      echo "Process Added Successfully..!";
    }
    else{
      echo "There is some problem: " . "<br>" . $conn->error;
    }
    }
  }
//To Add Cost Center
if(isset($_GET['pagetype']) and $_GET['pagetype']=='add_cost_center'){
  if(isset($_POST['costCode']) && !empty($_POST['costCode']) &&  isset($_POST['costName']) && !empty($_POST['costName'])){
    $sql = "INSERT INTO costMast (costCode, costName) VALUES ('$_POST[costCode]', '$_POST[costName]')";
    if($conn->query($sql)===TRUE){
      echo "Cost Center Added Successfully..!";
    }
    else{
      echo "There is some problem: " . "<br>" . $conn->error;
    }
    }
  }
//To Add New Holiday
if(isset($_GET['pagetype']) and $_GET['pagetype']=='add_holiday'){
  
if(isset($_POST['hDate']) && !empty($_POST['hDate']) &&  isset($_POST['locCode']) && !empty($_POST['locCode']) &&  isset($_POST['hCode']) && !empty($_POST['hCode']) && isset($_POST['hDesc']) && !empty($_POST['hDesc'])){
$sql="INSERT INTO holidayMast (hDate,locCode,hCode,hDesc) VALUES ('$_POST[hDate]', '$_POST[locCode]', '$_POST[hCode]', '$_POST[hDesc]')";
if ($conn->query($sql) === TRUE) {
  echo "Holiday Added Successfully..";
     exit;              
    }
    else{
    echo "There is some problem: " . "<br>" . $conn->error;
     }
}
}
//Add Qualification
if(isset($_GET['pagetype']) and $_GET['pagetype']=='add_qualification'){
  if(isset($_POST['qualCode']) && !empty($_POST['qualCode']) &&  isset($_POST['qualName']) && !empty($_POST['qualName'])){
      $sql="INSERT INTO qualimast (qualCode, qualName) VALUES ('$_POST[qualCode]', '$_POST[qualName]')";
    if($conn->query($sql)===TRUE){
      echo "Qualification Added Successfully..!";
    }
    else{
      echo "There is some problem: " . "<br>" . $conn->error;
    }
    }
  }
//To Add Country
if(isset($_GET['pagetype']) and $_GET['pagetype']=='add_country'){
  if(isset($_POST['countryCode']) && !empty($_POST['countryCode']) &&  isset($_POST['countryName']) && !empty($_POST['countryName'])){
      $sql="INSERT INTO country (countryCode, countryName, Status) VALUES ('$_POST[countryCode]', '$_POST[countryName]', '$_POST[Status]')";
    if($conn->query($sql)===TRUE){
      echo "Country Added Successfully..!";
    }
    else{
      echo "There is some problem: " . "<br>" . $conn->error;
    }
    }
  }
//To Add State
if(isset($_GET['pagetype']) and $_GET['pagetype']=='add_state'){
  if(isset($_POST['stateName']) && !empty($_POST['stateName']) &&  isset($_POST['countryId']) && !empty($_POST['countryId'])){
      $sql="INSERT INTO states (stateName, countryId, status) VALUES ('$_POST[stateName]', '$_POST[countryId]', '$_POST[status]')";
    if($conn->query($sql)===TRUE){
      echo "State Added Successfully..!";
    }
    else{
      echo "There is some problem: " . "<br>" . $conn->error;
    }
    }
  }
//To Add City
if(isset($_GET['pagetype']) and $_GET['pagetype']=='add_city'){
  if(isset($_POST['cityName']) && !empty($_POST['cityName']) &&  isset($_POST['stateId']) && !empty($_POST['stateId'])){
      $sql="INSERT INTO city (cityName, stateId, status) VALUES ('$_POST[cityName]', '$_POST[stateId]', '$_POST[status]')";
    if($conn->query($sql)===TRUE){
      echo "City Added Successfully..!";
    }
    else{
      echo "There is some problem: " . "<br>" . $conn->error;
    }
    }
  }
//To Add Option Master
if(isset($_GET['pagetype']) and $_GET['pagetype']=='add_optionMast'){
  $sql="INSERT INTO optionMast (fieldName, fieldValue, fieldText, fieldActive, fieldOrderNo, fieldDefault, tableName, type) VALUES ('$_POST[fieldName]', '$_POST[fieldValue]', '$_POST[fieldText]', '$_POST[fieldActive]', '$_POST[fieldOrderNo]', '$_POST[fieldDefault]', '$_POST[tableName]', '$_POST[type]')";
  if($conn->query($sql)===TRUE){
      echo "Option Added Successfully..!";
    }
    else{
      echo "There is some problem: " . "<br>" . $conn->error;
    }
}
//To Add Reason Master
if(isset($_GET['pagetype']) and $_GET['pagetype']=='add_reason'){
  $sql="INSERT INTO reasonmast (Rcode, Rname, Rcategory, Rdetail) VALUES ('$_POST[Rcode]',  '$_POST[Rname]',  '$_POST[Rcategory]',  '$_POST[Rdetail]')";
  if($conn->query($sql)===TRUE){
      echo "Reason Added Successfully..!";
    }
    else{
      echo "There is some problem: " . "<br>" . $conn->error;
    }
}
// To Add University
if(isset($_GET['pagetype']) and $_GET['pagetype']=='add_university'){
  $sql="INSERT INTO univmast (univCode, univName, status) VALUES ('$_POST[univCode]', '$_POST[univName]', '$_POST[status]')";
  if($conn->query($sql)===TRUE){
      echo "University Added Successfully..!";
    }
    else{
      echo "There is some problem: " . "<br>" . $conn->error;
    }
}  
  // To Add Sub Function
if(isset($_GET['pagetype']) and $_GET['pagetype']=='add_sub_function'){
 $sql="INSERT INTO subfunctmast (subFunctCode, subFunctName, subFunctHead, functCode) VALUES ('$_POST[subFunctCode]', '$_POST[subFunctName]', '$_POST[subFunctHead]', '$_POST[functCode]')";
  if($conn->query($sql)===TRUE){
      echo "Sub Function Added Successfully..!";
    }
    else{
      echo "There is some problem: " . "<br>" . $conn->error;
    }
}



