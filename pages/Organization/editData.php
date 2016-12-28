<?php
include '../db_conn.php';
//To Edit University
if(isset($_GET['pagetype']) and $_GET['pagetype']=='editUniv'){
$oldUnivCode = $_POST['oldUnivCode'];
$sql="UPDATE univmast SET 
  univCode = '$_POST[univCode]',
  univName ='$_POST[univName]',
  status = '$_POST[status]'
  WHERE univCode = '$oldUnivCode'";
  if($conn->query($sql)===TRUE){
      echo "University Edited Successfully..!";
    }
    else{
      echo "There is some problem: " . "<br>" . $conn->error;
    }

}
//To Edit Bussiness Unit
if(isset($_GET['pagetype']) and $_GET['pagetype']=='edit_business_unit'){
  $oldBussCode = $_POST['oldBussCode'];
  $sql="UPDATE bussmast SET 
  bussCode ='$_POST[bussCode]',
  bussName = '$_POST[bussName]',
  bussHname = '$_POST[bussHname]',
  bussReport = '$_POST[bussReport]',
  bussAbt = '$_POST[bussAbt]',
  bussAddr = '$_POST[bussAddr]',
  bussCity = '$_POST[bussCity]',
  bussPin = '$_POST[bussPin]',
  bussState = '$_POST[bussState]',
  bussCur = '$_POST[bussCur]' WHERE bussCode = '$oldBussCode'";
  if($conn->query($sql)===TRUE){
      echo "Bussiness Unit Edited Successfully..!";
    }
    else{
      echo "There is some problem: " . "<br>" . $conn->error;
    }
}


//To Edit Bank Details
if(isset($_GET['pagetype']) and $_GET['pagetype']=='edit_bank_details'){
  $oldBankCode = $_POST['oldBankCode'];
  $sql="UPDATE bankmast SET 
  bankCode ='$_POST[bankCode]',
  bankName = '$_POST[bankName]',
  bankBranch = '$_POST[bankBranch]',
  bankIFSC = '$_POST[bankIFSC]',
  bankMICR = '$_POST[bankMICR]',
  bankType= '$_POST[bankType]',
  bankAddress = '$_POST[bankAddress]',
  bankPhone = '$_POST[bankPhone]',
  bankCity = '$_POST[bankCity]',
  bankState = '$_POST[bankState]',
  bankPin = '$_POST[bankPin]',
  compIFSC = '$_POST[compIFSC]',
  compMICR    = '$_POST[compMICR]',
  compBankAcNo = $_POST[compBankAcNo],
  bankCode = '$_POST[bankCode]' 
  WHERE bankCode = '$oldBankCode'";
  if($conn->query($sql)===TRUE){
      echo "Bank Details Upadted Successfully..!";
    }
    else{
      echo "There is some problem: " . "<br>" . $conn->error;
    }
}

//To Edit City Details
if(isset($_GET['pagetype']) and $_GET['pagetype']=='edit_city'){
  $cityId = $_POST['cityId'];
  $sql="Update city SET 
  cityName ='$_POST[cityName]',
  stateId = '$_POST[stateId]',
  status = '$_POST[status]' WHERE cityId='$cityId'";
   if($conn->query($sql)===TRUE){
      echo "City Details Updated Successfully..!";
    }
    else{
      echo "There is some problem: " . "<br>" . $conn->error;
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
  if($conn->query($sql)===TRUE){
      echo "Cost Allocation Details Updated Successfully..!";
    }
    else{
      echo "There is some problem: " . "<br>" . $conn->error;
    }
  }
//To Edit Cost center
if(isset($_GET['pagetype']) and $_GET['pagetype']=='edit_cost_center'){
  $oldCostCode = $_POST['oldCostCode'];
  $sql="Update costmast SET costCode = '$_POST[costCode]',
  costName = '$_POST[costName]' 
  WHERE costCode = '$oldCostCode'";
   if($conn->query($sql)===TRUE){
      echo "Cost Center Details Updated Successfully..!";
    }
    else{
      echo "There is some problem: " . "<br>" . $conn->error;
    }
}
//To Edit Country
if(isset($_GET['pagetype']) and $_GET['pagetype']=='edit_country'){
  $countryId1 = $_POST['countryId1'];
  $sql="Update country SET countryCode = '$_POST[countryCode]',
  countryName = '$_POST[countryName]', 
  Status = '$_POST[Status]' 
  WHERE countryId = '$countryId1'";
   if($conn->query($sql)===TRUE){
      echo "Country Details Updated Successfully..!";
    }
    else{
      echo "There is some problem: " . "<br>" . $conn->error;
    }
}
//To Edit Employee Type
if(isset($_GET['pagetype']) and $_GET['pagetype']=='edit_emp_type'){
  $empTypeCodeOld = $_POST['empTypeCodeOld'];
  $sql="UPDATE emptypemast SET empTypeCode = '$_POST[empTypeCode]',
  empTypeName = '$_POST[empTypeName]', 
  empTypeAbt = '$_POST[empTypeAbt]' WHERE empTypeCode = '$empTypeCodeOld'";
  if($conn->query($sql)===TRUE){
      echo "Employee Type Details Updated Successfully..!";
    }
    else{
      echo "There is some problem: " . "<br>" . $conn->error;
    }
}
//To Edit Function 
if(isset($_GET['pagetype']) and $_GET['pagetype']=='edit_function'){
  $functId = $_POST['functId'];
  $functCode = $_POST['functCode'];
  $functName = $_POST['functName'];
  $functType = $_POST['functType'];
  $functHead = $_POST['functHead'];
  //$tableType = $_POST['tableType'];
  $statement=$conn->prepare("UPDATE functmast SET functCode = ?, functName = ?, functType = ?, functHead = ? WHERE id = ?");
  $statement->bind_param('sssss', $functCode, $functName, $functType, $functHead, $functId);
  $results =  $statement->execute();
  if($results){
      echo "Function Details Updated Successfully..!";
    }
    else{
      echo "There is some problem: " . "<br>" . $conn->error;
    }
}
//To Edit Grade
if(isset($_GET['pagetype']) and $_GET['pagetype']=='edit_grade'){
  $ogrdCode=$_POST['ogrdCode'];
  $grdCode=$_POST['grdCode'];
  $grdName=$_POST['grdName'];
  $grdUnder=$_POST['grdUnder'];
  //$tableType = $_POST['tableType'];
  $sql="UPDATE grdmast SET grdCode='$grdCode', grdName='$grdName', grdUnder='$grdUnder' WHERE grdCode='$ogrdCode'";
   if($conn->query($sql)===TRUE){
      echo "Grade Details Updated Successfully..!";
    }
    else{
      echo "There is some problem: " . "<br>" . $conn->error;
    }
}
//TO Edit Level
if(isset($_GET['pagetype']) and $_GET['pagetype']=='edit_level'){
$olevelCode=$_POST['olevelCode'];
$sql="UPDATE levelmast SET 
  levelCode = '$_POST[levelCode]',
  levelName ='$_POST[levelName]'
  WHERE levelCode = '$olevelCode'";
  if($conn->query($sql)===TRUE){
      echo "Level Edited Successfully..!";
    }
    else{
      echo "There is some problem: " . "<br>" . $conn->error;
    }
}
//To Edit Process
if(isset($_GET['pagetype']) and $_GET['pagetype']=='edit_process'){
$oprocCode = $_POST['oprocCode'];
$sql="UPDATE procmast SET 
  procCode = '$_POST[procCode]',
  procName ='$_POST[procName]'
  WHERE procCode = '$oprocCode'";
  if($conn->query($sql)===TRUE){
      echo "Process Edited Successfully..!";
    }
    else{
      echo "There is some problem: " . "<br>" . $conn->error;
    }
}
//To Edit Qualification
if(isset($_GET['pagetype']) and $_GET['pagetype']=='edit_qualification'){
$oqualCode = $_POST['oqualCode'];
$qualCode=$_POST['qualCode'];
$qualName=$_POST['qualName'];
$sql="UPDATE qualimast SET qualCode ='$qualCode', qualName='$qualName' WHERE qualCode = '$oqualCode'";
  if($conn->query($sql)===TRUE){
      echo "Qualification Edited Successfully..!";
    }
    else{
      echo "There is some problem: " . "<br>" . $conn->error;
    }
}
//To Edit Holiday
if(isset($_GET['pagetype']) and $_GET['pagetype']=='edit_holiday'){
    $ohDate =$_POST['ohDate'];
     $hDate =$_POST['hDate'];
    $locCode = $_POST['locCode'];
    $hCode = $_POST['hCode'];
    $hDesc = $_POST['hDesc'];
$sql="UPDATE holidaymast SET hDate ='$hDate', locCode='$locCode', hCode='$hCode', hDesc='$hDesc' WHERE hDate = '$ohDate'";
  if($conn->query($sql)===TRUE){
      echo "Holiday Edited Successfully..!";
    }
    else{
      echo "There is some problem: " . "<br>" . $conn->error;
    }
}
//To Edit Location
if(isset($_GET['pagetype']) and $_GET['pagetype']=='edit_location'){
    $id=$_POST['locId'];
    $locCode =$_POST['locCode'];
    $locName = $_POST['locName'];
    $locType = $_POST['locType'];
    $locParent = $_POST['locParent'];
    $locWork = $_POST['locWork'];
    $locAdd1 = $_POST['locAdd1'];
    $locAdd2 = $_POST['locAdd2'];
    $locCity = $_POST['locCity'];
    $locState = $_POST['locState'];
    $locPin = $_POST['locPin'];
    $locCountry = $_POST['locCountry'];
    $locPfCode = $_POST['locPfCode'];
    $locEsiCode = $_POST['locEsiCode'];
    
    $sql="Update locmast SET locCode = '$locCode', locName = '$locName', locType = '$locType', locParent = '$locParent', locWork = '$locWork', locAdd1 = '$locAdd1', locAdd2 = '$locAdd2',  locCity = '$locCity', locState = '$locState',  locPin = '$locPin', locCountry = '$locCountry',locPfCode = '$locPfCode',locEsiCode = '$locEsiCode' WHERE id='$id'";
if($conn->query($sql)===TRUE){
      echo "Location Edited Successfully..!";
    }
    else{
      echo "There is some problem: " . "<br>" . $conn->error;
    }
    }
//To Edit sub function
if(isset($_GET['pagetype']) and $_GET['pagetype']=='edit_sub_function'){
  $osubFunctCode = $_POST['osubFunctCode'];
  $subFunctCode = $_POST['subFunctCode'];
  $subFunctName = $_POST['subFunctName'];
  $subFunctHead = $_POST['subFunctHead'];
  $functCode = $_POST['functCode'];
  $sql="UPDATE subfunctmast SET subFunctCode='$subFunctCode', subFunctName='$subFunctName',subFunctHead='$subFunctHead',functCode='$functCode' WHERE subFunctCode='$osubFunctCode'";
  if($conn->query($sql)===TRUE){
      echo "Sub-Function Edited Successfully..!";
    }
    else{
      echo "There is some problem: " . "<br>" . $conn->error;
    }
}
//To Edit Reason Master
if(isset($_GET['pagetype']) and $_GET['pagetype']=='edit_reason'){
$rcode=$_POST['rcode'];
$Rcode=$_POST['Rcode'];
$Rname= $_POST['Rname'];
$Rcategory=$_POST['Rcategory'];
$Rdetail=$_POST['Rdetail'];
$sql="UPDATE reasonmast SET Rcode='$Rcode', Rname='$Rname', Rcategory='$Rcategory', Rdetail='$Rdetail' WHERE Rcode='$rcode'";
if($conn->query($sql)===TRUE){
echo $sql;
      echo "Reason Master Edited Successfully..!";
    }
    else{
      echo "There is some problem: " . "<br>" . $conn->error;
    }
}
//To Edit Roles
if(isset($_GET['pagetype']) and $_GET['pagetype']=='edit_roles'){
$oroleCODE=$_POST['oroleCODE'];
$sql="UPDATE rolemast SET roleCODE='$_POST[roleCODE]', roleNAME='$_POST[roleNAME]', roleGrp='$_POST[roleGrp]', roleMngr='$_POST[roleMngr]', roleProfile='$_POST[roleProfile]', roleQuali='$_POST[roleQuali]', roleSkill='$_POST[roleSkill]', roleExp='$_POST[roleExp]', roleOther='$_POST[roleOther]',roleJobDesc='$_POST[roleJobDesc]', roleHiringTime='$_POST[roleHiringTime]' WHERE roleCODE='$oroleCODE'";
if($conn->query($sql)===TRUE){
echo $sql;
      echo "Role Master Edited Successfully..!";
    }
    else{
      echo "There is some problem: " . "<br>" . $conn->error;
    }
}
//To Edit Option Master
if(isset($_GET['pagetype']) and $_GET['pagetype']=='edit_optionMast'){
$ofieldName = $_POST['ofieldName'];
$sql="UPDATE optionmast SET 
	fieldName ='$_POST[fieldName]',
	fieldValue = '$_POST[fieldValue]',
	fieldText = '$_POST[fieldText]',
	fieldActive = '$_POST[fieldActive]',
	fieldOrderNo = '$_POST[fieldOrderNo]',
	fieldDefault = '$_POST[fieldDefault]'
	type = '$_POST[type]'
WHERE fieldName='$ofieldName'";
if($conn->query($sql)===TRUE){
echo $sql;
      echo "Option Master Edited Successfully..!";
    }
    else{
      echo "There is some problem: " . "<br>" . $conn->error;
    }
}
//To Edit State Details
if(isset($_GET['pagetype']) and $_GET['pagetype']=='edit_state'){
  $ostateId = $_POST['ostateId'];
  $sql="Update states SET 
  stateName ='$_POST[stateName]',
  countryId = '$_POST[countryId]',
  status = '$_POST[status]' WHERE stateId='$ostateId'";
   if($conn->query($sql)===TRUE){
      echo "State Details Updated Successfully..!";
    }
    else{
      echo "There is some problem: " . "<br>" . $conn->error;
    }
  
}
//To Edit work Location
if(isset($_GET['pagetype']) and $_GET['pagetype']=='edit_work_location'){
  $owLocCode = $_POST['owlocCode'];
  $sql="Update worklocmast SET 
	wLocCode ='$_POST[wlocCode]',
	wLocName = '$_POST[wlocName]',
	wLocType = '$_POST[wlocType]',
	wLocParent = '$_POST[wlocParent]',
	wLocWork = '$_POST[wlocWork]',
	wLocAdd1 = '$_POST[wlocAdd1]',
	wLocAdd2 = '$_POST[wlocAdd2]',
	wLocCity = '$_POST[wlocCity]',
	wLocState = '$_POST[wlocState]',
	wLocPin = '$_POST[wlocPin]',
	wLocCountry = '$_POST[wlocCountry]'
	WHERE wLocCode='$owLocCode'";
   if($conn->query($sql)===TRUE){
      echo "Work Location Details Updated Successfully..!";
    }
    else{
      echo "There is some problem: " . "<br>" . $conn->error;
    }
}










?>
