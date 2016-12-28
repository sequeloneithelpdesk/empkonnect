	<?php 
	include('../../db_conn.php');
	include('../../configdata.php');
	include ('../Events/weekly_off.php');
	@session_start();

	$username=$_SESSION['usercode'];
//$username=100010;
	if($_POST['type']=="showroster"){
		$month = $_POST['month'];
		$year = $_POST['year'];
		$weeklyOffsData = '';
		$weeklyOffs 	= getWeeklyOff($month,$year,$username);  
		if(isset($weeklyOffs) && count($weeklyOffs) > 0){
			foreach ($weeklyOffs as $key => $value) {
				if (isset($value['start'])) {
					$weeklyOffDate = date('d/m/Y',strtotime($value['start']));
					$weeklyOffsData[$weeklyOffDate] = $weeklyOffDate;
				}
			}
		}

		$monthNames = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
		$currentMonth = date('F',strtotime($monthNames[$month-1].' ' . $year));
		$prevMonth = date('F',strtotime($monthNames[$month-1].' ' . $year . ' -1 month'));		
		$nextMonth = date('F',strtotime($monthNames[$month-1].' ' . $year . ' +1 month'));
		$monthNames = array("prevMonth" => $prevMonth, "nextMonth" => $nextMonth, "currentMonth" => $currentMonth);
	
		$limitStart = (isset($_POST['limitStart']) && !empty($_POST['limitStart'])) ? $_POST['limitStart'] : 0;
		$offsetLimit = (isset($_POST['offsetLimit']) && !empty($_POST['offsetLimit'])) ? $_POST['offsetLimit'] : 10;
		$myteam = array();
		$rosterListType = isset($_POST["rosterListType"])?$_POST["rosterListType"]:'';
		$rosterTypeCondition = "EMP_CODE IN (SELECT EMP_CODE FROM Roster_schema)";

		if(!empty($rosterListType)){
			switch ($rosterListType) {
				case "assignedRoster":
					$rosterTypeCondition = "WHERE EMP_CODE IN (SELECT EMP_CODE FROM Roster_schema)";
					$rosterTypeConditionWithAnd = " AND EMP_CODE IN (SELECT EMP_CODE FROM Roster_schema)";
					break;

				case "unAssignedRoster":
					$rosterTypeCondition = "WHERE EMP_CODE NOT IN (SELECT EMP_CODE FROM Roster_schema)";
					$rosterTypeConditionWithAnd = " AND EMP_CODE NOT IN (SELECT EMP_CODE FROM Roster_schema)";
					break;

				case "allRoster":
					$rosterTypeCondition = "";
					$rosterTypeConditionWithAnd = "";
					break;
			}

		}else{
			$rosterTypeCondition = "WHERE EMP_CODE IN (SELECT EMP_CODE FROM Roster_schema)";
			$rosterTypeConditionWithAnd = " AND EMP_CODE IN (SELECT EMP_CODE FROM Roster_schema)";
		}
		
		$whereEmp = ($username == 'admin') ? $rosterTypeCondition : "WHERE Emp_Code='$username' ".$rosterTypeConditionWithAnd;
		
		/*$sql="SELECT * FROM 
					(SELECT ROW_NUMBER() OVER(ORDER BY EMP_CODE) AS ROWNUM, * FROM HrdMastQry) HrdMastQry
					WHERE EMP_CODE IN (SELECT EMP_CODE FROM Roster_schema) $whereEmp AND ROWNUM BETWEEN $limitStart AND $offsetLimit ORDER BY EMP_CODE ASC";*/
		$sql="SELECT * FROM ( SELECT ROW_NUMBER() OVER(ORDER BY EMP_CODE) AS ROWNUM, * FROM HrdMastQry $whereEmp) HrdMastQry1 WHERE ROWNUM BETWEEN $limitStart AND $offsetLimit ";
		
		$result=query($query, $sql, $pa, $opt, $ms_db);
		$resultNew=query($query, $sql, $pa, $opt, $ms_db);
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

		if($username != 'admin'){

			$rosterTypeCondition = "EMP_CODE IN (SELECT EMP_CODE FROM Roster_schema)";
			if(!empty($rosterListType)){
				if($rosterListType == "assignedRoster"){
					$rosterTypeCondition = "WHERE EMP_CODE IN (SELECT EMP_CODE FROM Roster_schema)";
					$rosterTypeConditionWithAnd = " AND EMP_CODE IN (SELECT EMP_CODE FROM Roster_schema)";
				}else if ($rosterListType == "unSssignedRoster") {
					$rosterTypeCondition = "WHERE EMP_CODE NOT IN (SELECT EMP_CODE FROM Roster_schema)";
					$rosterTypeConditionWithAnd = " AND EMP_CODE NOT IN (SELECT EMP_CODE FROM Roster_schema)";
				}else if ($rosterListType == "allRoster") {
					$rosterTypeCondition = "";
				}
			}

			//$sql4="SELECT * FROM HrdMastQry where MNGR_CODE='$username' ";
			$whereMngr = "WHERE MNGR_CODE='$username' ".$rosterTypeConditionWithAnd;
			$sql4="SELECT * FROM ( SELECT ROW_NUMBER() OVER(ORDER BY EMP_CODE) AS ROWNUM, * FROM HrdMastQry $whereMngr) HrdMastQry2 WHERE ROWNUM BETWEEN $limitStart AND $offsetLimit";
			$result4=query($query, $sql4, $pa, $opt, $ms_db);

			while($row2=$fetch($result4)){
				if($username==$row2['Emp_Code']){
					continue;
				}
				if($row2['EmpImage']==""||$row2['EmpImage']=="NULL" ){
					$image= "../Profile/upload_images/images (1).jpg";
				}
				else{
					$image= "../Profile/upload_images/".$row2['EmpImage'];
				}
				$myteam['children'][$row2['Emp_Code']] = array(
					"Fname" => $row2['Emp_FName'],
					"name" => $row2['Emp_Title'] . " " . $row2['Emp_FName'] . " " . $row2['Emp_MName'] . " " . $row2['Emp_LName'],
					"image" =>$image,
					"dsg" => $row2['DSG_NAME']);
	           //$team['myteam1'][]['email'] = $row2['OEMailD'];
			}		

		}else{
			while($rowNew=$fetch($resultNew)){
				if($username==$rowNew['Emp_Code']){
					continue;
				}
				if($rowNew['EmpImage']==""||$rowNew['EmpImage']=="NULL" ){
					$image= "../Profile/upload_images/images (1).jpg";
				}
				else{
					$image= "../Profile/upload_images/".$rowNew['EmpImage'];
				}
				$myteam['children'][$rowNew['Emp_Code']] = array(
					"Fname" => $rowNew['Emp_FName'],
					"name" => $rowNew['Emp_Title'] . " " . $rowNew['Emp_FName'] . " " . $rowNew['Emp_MName'] . " " . $rowNew['Emp_LName'],
					"image" =>$image,
					"dsg" => $rowNew['DSG_NAME']);
			}
		}

		$allEmployee[] = $myteam['id'];
		foreach ($myteam['children'] as $id => $TDA) {
			$allEmployee[] = $id;
		}
		$date = $year."-".$month."-".'01';
		$numberofdays = get_number_of_days_in_month($month,$year);
		$date2 =   $year.'-'.$month."-".$numberofdays ;

		$employee = "'".implode("','",$allEmployee)."'";
		$sqlD1 = "select max(RostID) as RostID from Roster_schema where Emp_Code IN ($employee) and end_rost <= '$date' AND auto_period_flag = '0' group by Emp_Code";
		
		$sqlD1 = "select a.Emp_Code,convert(varchar(10),a.start_rost,103) as start_rost,convert(varchar(10),a.end_rost,103) as end_rost,a.RosterName,a.auto_period,a.created_on from Roster_schema a inner join ($sqlD1) b on a.RostID = b.RostID";
		
		$sqlD2 = "select Emp_Code, convert(varchar(10),start_rost,103) as start_rost,convert(varchar(10),end_rost,103) as end_rost,RosterName,auto_period,created_on from Roster_schema where Emp_Code IN ($employee) and start_rost >= '$date' and end_rost <= '$date2' AND auto_period_flag = '0' ";
		
		$sqlD = " ($sqlD1) union ($sqlD2)";
		//----------------------------
		$sqlD = "select * from ($sqlD) a order by a.created_on asc";
		//----------------------------
		//echo $sqlD; die;
		
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


		$sqlS = "select c.*,d.ShiftPattern_Name from (select a.*,b.Shift_Name,b.Shift_Code, cast(b.Shift_From as varchar(8)) as st ,
		cast(b.Shift_To as varchar(8)) as en from (select convert(varchar(10),RosterDate,103) as RosterDate,
		shiftMaster,shiftPattern,auto_period,roster from att_roster where roster IN ($schemeN)) as a join ShiftMast b 
		on a.shiftMaster=b.ShiftMastId) c join ShiftPatternMast d on c.shiftPattern=d.ShiftPatternMastid  ";
		$resultS = query($query, $sqlS, $pa, $opt, $ms_db);
		$ss = array();
		while($rowS = $fetch($resultS)){
			$ss[$rowS['roster']][$rowS['RosterDate']] = array("SM" => array("id" => $rowS['shiftMaster'], "name"=>$rowS['Shift_Name'], "shift_code"=>$rowS['Shift_Code'],"start"=>$rowS['st'],"end"=>$rowS['en']),"SP" => array("id"=>$rowS['shiftPattern'], "name"=>$rowS['ShiftPattern_Name']),"auto_period" => $rowS['auto_period']);
			
		}
		
		$changed = array();
		$rq = array();
		$sq = array();
		$sqlD = "select convert(varchar(10),RosterDate,103) as RosterDate,Emp_code,shiftMaster,shiftPattern,type_name,swap_id from rost_change where Emp_code IN ($employee) and RosterDate >=  '$date' and RosterDate <= '$date2' ";
		$resultD = query($query, $sqlD, $pa, $opt, $ms_db);
		while($rowD = $fetch($resultD)){

			//get shift name
			$sqlDNew = "SELECT Shift_Code FROM ShiftMast WHERE ShiftMastId = '".$rowD['shiftMaster']."'";
			$resultDNew = query($query, $sqlDNew, $pa, $opt, $ms_db);
			$rowDNew = $fetch($resultDNew);

			$changed[$rowD['Emp_code']][$rowD['RosterDate']] = array("SM" => $rowD['shiftMaster'],"SP" => $rowD['shiftPattern'],"type_name" => $rowD['type_name'],'shift_code'=>$rowDNew['Shift_Code']);
			if($rowD['type_name'] == "request"){
				$rq[$rowD['Emp_code']][$rowD['RosterDate']] = array("SM" => $rowD['shiftMaster'],"SP" => $rowD['shiftPattern'],"type_name" => $rowD['type_name'],'shift_code'=>$rowDNew['Shift_Code']);
			}
			if($rowD['type_name'] == "swapR"){
				$sq[$rowD['Emp_code']][$rowD['swap_id']][$rowD['RosterDate']] = array("SM" => $rowD['shiftMaster'],"SP" => $rowD['shiftPattern'],"type_name" => $rowD['type_name'],'shift_code'=>$rowDNew['Shift_Code']);
			}
		}

		//get holidays
		$holidaysQuery = "select cast(HDATE as date) HDATE,LOC_CODE,HCODE,HDESC,HolidayID,H_status  from holidays where cast(HDATE as date) BETWEEN '$date' AND '$date2'";
		$holidaysResult = query($query,$holidaysQuery,$pa,$opt,$ms_db);
		$holidaysResultNum = $num($holidaysResult);
		$holidaysList = array();
		if($holidaysResultNum > 0){
			while ($HolidaysRow = $fetch($holidaysResult)){
				$holidayDate = date('d/m/Y',strtotime($HolidaysRow['HDATE']));
				$holidaysList[$holidayDate] = array('title'=>$HolidaysRow['HDESC'],'start'=>$holidayDate);
			}
		}
		//echo "<pre>"; print_r($data); print_r($holidaysList); die;
		
		echo json_encode(array("data"=> $data, "numberofdays" => $numberofdays, "details" => $myteam, "scheme" => $ss,"changeD"=>$changed,"rq" => $rq, "sq" => $sq,"monthNames" => $monthNames,"holidays"=>$holidaysList,"weeklyOffsData" => $weeklyOffsData));
		

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
		$rtype = trim($_POST['LT']);
		$d=strlen($day);
		if($d==1){
			$da="0".$day;
		}else{
			$da=$day;
		}
		$rostdate=$year."-".$month."-".$da ;
		
		if( $rtype == 1 || $rtype == 'approve') $rosterFlag = TRUE; else $rosterFlag = FALSE ;

		

		//Check request roster of employee in request month
		//if(!$rosterFlag){
			$checkExistRosterQuery = "SELECT COUNT(*) AS count FROM rost_change WHERE DATEPART(yyyy,RosterDate) = '".$year."' AND DATEPART(mm,RosterDate) = '".$month."' AND Emp_code = '".$empid."'";
			$checkExistRosterResult = query($query, $checkExistRosterQuery, $pa, $opt, $ms_db);
			$existRosterResult = $fetch($checkExistRosterResult);

			if($existRosterResult['count'] >= 2){
				echo 3;
				exit();
			}
		//}
		
		$sqlC = "select * from rost_change where Emp_code = '$empid' and RosterDate = '$rostdate'";
		$resultC = query($query, $sqlC, $pa, $opt, $ms_db);
		$numrow = $num($resultC); 
		
		if($numrow > 0){
			//update
			$sql="update rost_change SET shiftMaster ='$sm' , shiftPattern ='$sp' , type_name ='$rtype' where Emp_code = '$empid' and RosterDate = '$rostdate'";
			
			// insert 
		}else{
			//$sql="insert into rost_change(Emp_code,shiftMaster,shiftPattern,RosterDate,type_name) values ('$empid','$sm','$sp','$rostdate','$rtype')";
			$sql="insert into rost_change(Emp_code,shiftMaster,shiftPattern,RosterDate,type_name) values ('$empid','$sm','$sp','$rostdate','approve')";
		}

	//echo$sql;
		$result = query($query, $sql, $pa, $opt, $ms_db);
		if($result){

			//if($rosterFlag){
				$rosterName = "Ros".date('h_i_s');
				$currentDateTime = date('Y-m-d h:i:s');

				$attRosterQuery	=	"INSERT INTO att_roster( roster,shiftMaster,shiftPattern,RosterDate,auto_period,created_on,updated_on) values ('".$rosterName."', '".$sm."', '".$sp."', '".$rostdate."','0','".$currentDateTime."','".$currentDateTime."')";

				$rosterSchemaQuery	=	"INSERT INTO Roster_schema(RosterName, Emp_Code , created_on, updated_on, start_rost, end_rost, auto_period,auto_period_flag) values ('".$rosterName."', '".$empid."','".$currentDateTime."','".$currentDateTime."','".$rostdate."','".$rostdate."', '0', '1')";

				query($query, $attRosterQuery, $pa, $opt, $ms_db);
				query($query, $rosterSchemaQuery, $pa, $opt, $ms_db);
			//}

			$checkAutoShiftQuery = "SELECT MAX(RostID) FROM Rosterqry WHERE RosterEnd > '".$rostdate."' AND Emp_Code = '".$empid."' AND auto_period = 1";
			$checkAutoShiftQueryResult = query($query, $checkAutoShiftQuery, $pa, $opt, $ms_db);
			$checkAutoShiftQueryResultRows = $num($checkAutoShiftQueryResult); 
		
			if($checkAutoShiftQueryResultRows > 0){
				$rosterNameNew = "rostChange_".$empid.'_'.time();
				$insertAutoShiftInattRoster = "INSERT INTO att_roster(roster,shiftMaster,shiftPattern,RosterDate,auto_period,created_on,updated_on)
				SELECT  '".$rosterNameNew."',shiftMaster,ShiftPatternMastID,DATEADD(D,1,'".$rostdate."'),1,GETDATE(),GETDATE()
				FROM RosterQry WHERE ROSTID IN (
				SELECT MAX(RostID) FROM Rosterqry WHERE RosterEnd < '".$rostdate."' AND Emp_Code = '".$empid."' AND auto_period = 1)";

 
				$insertAutoShiftInrosterSchema = "INSERT INTO Roster_schema(RosterName, Emp_Code , created_on, updated_on, start_rost, end_rost, auto_period
														)
														SELECT '".$rosterNameNew."',EMP_CODE,GETDATE(),GETDATE(),DATEADD(D,1,'".$rostdate."'),DATEADD(D,1,'".$rostdate."'),1
														FROM RosterQry WHERE ROSTID IN (
														SELECT MAX(RostID) FROM Rosterqry WHERE RosterEnd < '".$rostdate."' AND Emp_Code = '".$empid."' AND auto_period = 1)";

				query($query, $insertAutoShiftInattRoster, $pa, $opt, $ms_db);
				query($query, $insertAutoShiftInrosterSchema, $pa, $opt, $ms_db);
			}

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
				//Check request roster of employee in request month
				$checkExistRosterQuery = "SELECT COUNT(*) AS count FROM rost_change WHERE DATEPART(yyyy,RosterDate) = '".$RA['year']."' AND DATEPART(mm,RosterDate) = '".$RA['month']."' AND Emp_code = '".$empid."'";
				$checkExistRosterResult = query($query, $checkExistRosterQuery, $pa, $opt, $ms_db);
				$existRosterResult = $fetch($checkExistRosterResult);

				if($existRosterResult['count'] >= 2){
					echo 3;
					exit();
				}
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