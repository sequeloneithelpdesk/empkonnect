<?php 
include('../../db_conn.php');
include('../../configdata.php');
@session_start();

$username=$_SESSION['usercode'];
//$username=100010;
if($_POST['type']=="showroster"){
$month = $_POST['month'];
$year = $_POST['year'];

$myteam = array();
$sql="select * from HrdMastQry where Emp_Code='$username' ";
$result=query($query, $sql, $pa, $opt, $ms_db);
$row3=$fetch($result);
$myteam['id']=$row3['Emp_Code'];
$myteam['Fname']=$row3['Emp_FName'];
$myteam['name']=$row3['Emp_Title'] . " " . $row3['Emp_FName'] . " " . $row3['Emp_MName'] . " " . $row3['Emp_LName'];

    if($row3['EmpImage']==""||$row3['EmpImage']=="NULL" ){
	$myteam['image']= "../Profile/upload_images/images (1).jpg";
	}
	else{
	$myteam['image']= "../Profile/upload_images/".$row3['EmpImage'];
	}

$myteam['dsg'] = $row3['DSG_NAME'];
$myteam['children'] = array();

$sql4="SELECT * FROM HrdMastQry where MNGR_CODE='$username' ";
$result4=query($query, $sql4, $pa, $opt, $ms_db);

       while($row2=$fetch($result4)){
       	if($username==$row2['Emp_Code']){
       		continue;
       	}
       	if($row2['EmpImage']==""||$row2['EmpImage']=="NULL" ){
												$image= "../Profile/upload_images/images (1).jpg";
												}
												else{
												$image= "../Profile/upload_images/".$row3['EmpImage'];
												}
             $myteam['children'][$row2['Emp_Code']] = array(
											"Fname" => $row2['Emp_FName'],
                                            "name" => $row2['Emp_Title'] . " " . $row2['Emp_FName'] . " " . $row2['Emp_MName'] . " " . $row2['Emp_LName'],
                                            "image" =>$image,
                                              "dsg" => $row2['DSG_NAME']);
           //$team['myteam1'][]['email'] = $row2['OEMailD'];
       }

       $allEmployee[] = $myteam['id'];
       foreach ($myteam['children'] as $id => $TDA) {
           $allEmployee[] = $id;
       }

 
 
    $date = $year."-".$month."-".'01';
	$numberofdays = get_number_of_days_in_month($month,$year);
    $date2 =   $year.'-'.$month."-".$numberofdays ;


	$employee = "'".implode("','",$allEmployee)."'";
    $sqlD1 = "select max(RostID) as RostID from Roster_schema where  Emp_Code IN ($employee) and end_rost <= '$date' group by Emp_Code";
	
	$sqlD1 = "select a.Emp_Code,convert(varchar(10),a.start_rost,103) as start_rost,convert(varchar(10),a.end_rost,103) as end_rost,a.RosterName,a.auto_period,a.created_on from Roster_schema a inner join ($sqlD1) b on a.RostID = b.RostID";
	
    $sqlD2 = "select Emp_Code, convert(varchar(10),start_rost,103) as start_rost,convert(varchar(10),end_rost,103) as end_rost,RosterName,auto_period,created_on from Roster_schema where  Emp_Code IN ($employee) and  start_rost >= '$date' and end_rost <= '$date2' ";
  
	$sqlD = " ($sqlD1) union ($sqlD2)";
	//--------------------------
	$sqlD = "select * from ($sqlD) a order by a.created_on asc";
	//----------------------------
	//echo $sqlD;
	
	$resultD = query($query, $sqlD, $pa, $opt, $ms_db);
	$data = array();
	$scheme = array();
	$i = 0;
	while($rowD = $fetch($resultD)){
		$st_date = $rowD['start_rost'];
		$en_date = $rowD['end_rost'];
		$data[$rowD['Emp_Code']][] = array("startdate" =>$st_date , "enddate" => $en_date, "RosterName" => $rowD['RosterName'], "auto" => $rowD['auto_period']);
		$scheme[$rowD['RosterName']] = '';
	}
	$SSN = array();
	foreach($scheme as $SN => $val){
		$SSN[] = $SN;
	}
	
	$schemeN = "'".implode("','",$SSN)."'";


	 $sqlS = "select c.*,d.ShiftPattern_Name from (select a.*,b.Shift_Name, cast(b.Shift_From as varchar(8)) as st ,
cast(b.Shift_To as varchar(8)) as en from (select convert(varchar(10),RosterDate,103) as RosterDate,
shiftMaster,shiftPattern,auto_period,roster from att_roster where roster IN ($schemeN)) as a join ShiftMast b 
on a.shiftMaster=b.ShiftMastId) c join ShiftPatternMast d on c.shiftPattern=d.ShiftPatternMastid  ";
	$resultS = query($query, $sqlS, $pa, $opt, $ms_db);
	$ss = array();
	while($rowS = $fetch($resultS)){
		$ss[$rowS['roster']][$rowS['RosterDate']] = array("SM" => array("id" => $rowS['shiftMaster'], "name"=>$rowS['Shift_Name'],"start"=>$rowS['st'],"end"=>$rowS['en']),"SP" => array("id"=>$rowS['shiftPattern'], "name"=>$rowS['ShiftPattern_Name']),"auto_period" => $rowS['auto_period']);
		
	}
	
	$changed = array();
	$rq = array();
	$sq = array();
	$sqlD = "select convert(varchar(10),RosterDate,103) as RosterDate,Emp_code,shiftMaster,shiftPattern,type_name,swap_id from rost_change where Emp_code IN ($employee) and RosterDate >=  '$date' and RosterDate <= '$date2' ";
	$resultD = query($query, $sqlD, $pa, $opt, $ms_db);
	while($rowD = $fetch($resultD)){
		$changed[$rowD['Emp_code']][$rowD['RosterDate']] = array("SM" => $rowD['shiftMaster'],"SP" => $rowD['shiftPattern'],"type_name" => $rowD['type_name']);
		if($rowD['type_name'] == "request"){
			$rq[$rowD['Emp_code']][$rowD['RosterDate']] = array("SM" => $rowD['shiftMaster'],"SP" => $rowD['shiftPattern'],"type_name" => $rowD['type_name']);
		}
		if($rowD['type_name'] == "swapR"){
			$sq[$rowD['Emp_code']][$rowD['swap_id']][$rowD['RosterDate']] = array("SM" => $rowD['shiftMaster'],"SP" => $rowD['shiftPattern'],"type_name" => $rowD['type_name']);
		}
	}
	
	
	echo json_encode(array("data"=> $data, "numberofdays" => $numberofdays, "details" => $myteam, "scheme" => $ss,"changeD"=>$changed,"rq" => $rq, "sq" => $sq));
	

        //print_r($employee);
}
elseif ($_POST['type'] == "showroster_requests") {
	$sql="SELECT rost_change.ID, rost_change.shiftMaster, rost_change.shiftPattern, CONVERT(VARCHAR(19), rost_change.rosterDate, 120) AS rosterDate, CONVERT(VARCHAR(19), rost_change.created_on, 120) AS createdOn,
		CONVERT(VARCHAR(8), ShiftMast.Shift_From, 24) AS Shift_From, CONVERT(VARCHAR(8), ShiftMast.Shift_To, 24) AS Shift_To, ShiftPatternMast.ShiftPattern_Name
		from rost_change 
		INNER JOIN ShiftMast ON ShiftMast.ShiftMastId = rost_change.shiftMaster
		INNER JOIN ShiftPatternMast ON ShiftPatternMast.ShiftPatternMastid = rost_change.shiftPattern
		where rost_change.Emp_code = '$username' ";
	$result=query($query, $sql, $pa, $opt, $ms_db);
	if($num($result) > 0){ 
		while($rowD = $fetch($result)){
			$resultRow[] = array(
					"ID" => $rowD["ID"],
					"rosterDate" => dateFormat($rowD["rosterDate"]),
					"Shift_From" => timeFormat($rowD["Shift_From"]),
					"Shift_To" => timeFormat($rowD["Shift_To"]),
					"ShiftPattern_Name" => $rowD["ShiftPattern_Name"],
					"createdOn" => dateTimeFormat($rowD["createdOn"])
				);
		}
		echo json_encode($resultRow);
	}else{
		echo json_encode(array());
	}
	exit();

}
elseif($_POST['type']=="subrost"){
	$empid=$_POST['eid'];
	$year=$_POST['year'];
	$month=$_POST['month'];
	$day=$_POST['day'];
	$sm=$_POST['sm'];
	$sp = $_POST['sp'];
	$rtype = $_POST['LT'];
	$d=strlen($day);
	if($d==1){
		$da="0".$day;
	}else{
		$da=$day;
	}
	$rostdate=$year."-".$month."-".$da ;
	
	$sqlC = "select * from rost_change where Emp_code = '$empid' and RosterDate = '$rostdate'";
	$resultC = query($query, $sqlC, $pa, $opt, $ms_db);
	$numrow = $num($resultC); 
	
	if($numrow > 0){
	//update
		$sql="update rost_change SET shiftMaster ='$sm' , shiftPattern ='$sp' , type_name ='$rtype' where Emp_code = '$empid' and RosterDate = '$rostdate'";
	
	// insert 
	}else{
		$sql="insert into rost_change(Emp_code,shiftMaster,shiftPattern,RosterDate,type_name) values ('$empid','$sm','$sp','$rostdate','$rtype')";
	}
	//echo$sql;
	$result = query($query, $sql, $pa, $opt, $ms_db);
	if($result){
		echo 1;
	}
	else{
		echo 2;
	}
	//echo $sql;
	
}elseif($_POST['type']=="subswitch"){
	$data = $_POST['data'];
	$LT = $_POST['LT'];
	$empid = $_POST['id'];
	$randval = $_POST['randomVar'];
	
	if($LT == 'request'){ 
		$LT = 'swapR';
	}	
	foreach($data as $day => $RA){
		$rostdate = $RA['year']."-".$RA['month']."-".$RA['day'];
		$sp = $RA['SP'];
		$sm = $RA['SM'];
		
		$sqlC = "select * from rost_change where Emp_code = '$empid' and RosterDate = '$rostdate'";
		$resultC = query($query, $sqlC, $pa, $opt, $ms_db);
		$numrow = $num($resultC); 
		
		if($numrow > 0){
		//update
			 $sql="update rost_change SET shiftMaster ='$sm' , shiftPattern ='$sp' , type_name ='$LT',swap_id = '$randval' where Emp_code = '$empid' and RosterDate = '$rostdate'";
		
		// insert 
		}else{
			$sql="insert into rost_change(Emp_code,shiftMaster,shiftPattern,RosterDate,type_name,swap_id) values ('$empid','$sm','$sp','$rostdate','$LT','$randval')";
		}
		$result = query($query, $sql, $pa, $opt, $ms_db);
		
	} 
	if($result){
			echo 1;
		}
		else{
			echo 2; 
		}
	
	
}
function get_number_of_days_in_month($month, $year) {
	// Using first day of the month, it doesn't really matter
	$date = $year."-".$month."-1";
	return date("t", strtotime($date));
}
  ?>