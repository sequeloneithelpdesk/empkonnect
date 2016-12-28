<?php 
include ('../db_conn.php');
include ('../configdata.php');
include ('Events/public_holidays.php');
include ('Events/weekly_off.php');
include ('Events/emp_attendance.php');
include ('Events/emp_approved_leave.php');

if($_GET['type']=='myNewEvents'){
	//set global parameters to access or execute database query & their results--------------	
	global $query;
	global $pa;
	global $opt;
	global $ms_db;
	global $num;
	global $fetch;
	global $firstRosterStart;

	//current Date,Month,Year using c-prefix------------------------------------------------
	date_default_timezone_set("Asia/Kolkata");
	$current_date		= strtotime(date("Y-m-d"));
	$cyear 				= date('Y', $current_date);
	$cmonth 			= date('m', $current_date);
	$cdate       		= date('d', $current_date);

	//set emp_code and requested month, year------------------------------------------------
	$emp_code  	= $_GET['emp_code'];
	$start = explode('-', $_POST['start']);
	if($start[2]==1){
		$year  = $start[0];
		$month = sprintf("%02d", $start[1]);
	}else{
		if($start[1]==12){
			$year  = $start[0]+1;
			$month = '01';
		} else {
			$year  = $start[0];
			$month = sprintf("%02d", $start[1]+1);
		}
	}
	

	// total number of days in requested month and set first,last date & their numbers

	$daysInMonth 	= cal_days_in_month(0, $month, $year);
	$firstDate 		= $year.'-'.$month.'-01';					//first date
	$lastDate 		= $year.'-'.$month.'-'.$daysInMonth;		//last date
	$firstDateNum 	= 01;										//first date number
	$lastDateNum 	= $daysInMonth;								//last date number



	$result 	= array();
	//$firstRosterStart = array();
	for($b=$firstDateNum;$b<=$lastDateNum;$b++){
		$result[ltrim($b,'0')] = array('type'=>'null','title'=>'','shiftName'=>'','shiftInOutTime'=>'','formattedDate'=>date('l, d M Y',strtotime($year.'-'.$month.'-'.sprintf("%02d",$b))),'presetStatus'=>'','presetShortStatus'=>'','start'=>$year.'-'.$month.'-'.sprintf("%02d",$b),'className'=>'','birthdate'=>array(),'annidate'=>array(),'startTime'=>'','endTime'=>'','allDay'=>true,'status'=>'','reason'=>'','timeSpan'=>'');
	}

	$sqlq00 = "SELECT top 1 cast(RosterStart as date) as attFrom from rosterqry where emp_code='".$emp_code."' order by RostId asc";

	$resultq00=query($query,$sqlq00,$pa,$opt,$ms_db);
	if($num($resultq00)){
		while ($rowq00 = $fetch($resultq00)){
			$hello = $rowq00['attFrom'];
			$firstRosterStart = explode('-', $hello);

		}
	}
	
	// check employee date of joining & set their year, month, date
	$sqlq0="SELECT ShiftPatternMastID, Shift_Name, Shift_From,Shift_To, cast(rosterstart as date) attfrom, cast(rosterend as date) attto 
			FROM Rosterqry 
			WHERE EMP_CODE='".$emp_code."' 
			AND ((DATEPART(MM, rosterstart) <='".$month."'AND DATEPART(YY, rosterstart)='".$year."') 
			AND  (DATEPART(MM, rosterend ) >= '".$month."' AND DATEPART(YY, rosterstart)='".$year."'))
			ORDER BY rosterstart ASC";

	$resultq0=query($query,$sqlq0,$pa,$opt,$ms_db);

	if($num($resultq0)){
		while ($rowq0 = $fetch($resultq0)){
			$rosterStart = $rowq0['attfrom'];
			$rosterEnd 	= $rowq0['attto'];
			$shift_From = date('g:i a', strtotime($rowq0['Shift_From']));
			$shift_To 	= date('g:i a', strtotime($rowq0['Shift_To']));
			$shift_Name = $rowq0['Shift_Name'];
			//$shift_Name = $rowq0['SHIFTMASTER'];

			if(strtotime($rosterStart)>strtotime($firstDate)){
				$getFirstDate = explode('-', $rosterStart);


			}else{
				$getFirstDate = explode('-', $firstDate);
			}
			
			if(strtotime($rosterEnd)>strtotime($lastDate)){
				$getLastDate = explode('-', $lastDate);


			}else{
				$getLastDate = explode('-', $rosterEnd);
			}

			for($d=ltrim($getFirstDate[2],'0');$d<=ltrim($getLastDate[2],'0'); $d++){

				$result[$d]['shiftName']='Shift : '.$shift_Name;
				$result[$d]['shiftInOutTime']='('.$shift_From.'-'.$shift_To.')';
				
			}

		} 
	}

	


	$birthdates 	= getBirthDates($month,$year);						// independent events 
	$annidates		= getAnniDates($month,$year);						// independent events 
	$holidays 		= getHolidays($month,$year);						// independent events 
	$leaves 		= getLeaves($month,$year,$emp_code);				// solely dependent events 

	// set employee first date of joining and current date if year & month are same 
	if($year>=$firstRosterStart[0]){
		if($year>$firstRosterStart[0]){

			$firstDateNumc 	= 01;
			$lastDateNumc 	= $lastDateNum;
			$weeklyOffs 	= getWeeklyOff($month,$year,$emp_code);  								// dependent events 
			$attendances 	= getAttendance($firstDateNumc,$lastDateNumc,$month,$year,$emp_code);   // solely dependent events 
			$attregularised	= getAttendanceRegularised($month,$year,$emp_code);
			$getODRequest	= getODRequest($month,$year,$emp_code); 					// solely dependent events 

		}else if($year==$firstRosterStart[0]){

			if($month>ltrim($firstRosterStart[1],0) && $month<$cmonth){
				$firstDateNumc 	= 01;
				$lastDateNumc 	= $lastDateNum;
				$weeklyOffs 	= getWeeklyOff($month,$year,$emp_code);         						// dependent events 
				$attendances 	= getAttendance($firstDateNumc,$lastDateNumc,$month,$year,$emp_code);   // solely dependent events 
				$attregularised	= getAttendanceRegularised($month,$year,$emp_code); 
				$getODRequest	= getODRequest($month,$year,$emp_code); 					// solely dependent events 
			}else if($month==ltrim($firstRosterStart[1],0)){

				$firstDateNumc 	= $firstRosterStart[2];
				$lastDateNumc 	= $lastDateNum;
				$weeklyOffs 	= getWeeklyOff($month,$year,$emp_code);         						// dependent events 
				$attendances 	= getAttendance($firstDateNumc,$lastDateNumc,$month,$year,$emp_code);   // solely dependent events 
				$attregularised	= getAttendanceRegularised($month,$year,$emp_code); 
				$getODRequest	= getODRequest($month,$year,$emp_code); 
							// solely dependent events 
			}else if($month==$cmonth){
				$firstDateNumc 	= 01;
				$lastDateNumc 	= $cdate;
				$weeklyOffs 	= getWeeklyOff($month,$year,$emp_code);         						// dependent events 
				$attendances 	= getAttendance($firstDateNumc,$lastDateNumc,$month,$year,$emp_code);   // solely dependent events 
				$attregularised	= getAttendanceRegularised($month,$year,$emp_code); 
				$getODRequest	= getODRequest($month,$year,$emp_code); 					// solely dependent events 
			}else{
				return false;
			}
		}
	}
	

	// unset weekly offs if they are on holiday's date--------------------------------------------------
	if($holidays != null && $weeklyOffs != null){
		for($i=0;$i<count($holidays);$i++){
			for($j=0;$j<count($weeklyOffs);$j++){
				if(in_array($holidays[$i]['start'],$weeklyOffs[$j],true)){
					unset($weeklyOffs[$j]);
					$weeklyOffs = array_values($weeklyOffs);
				}
				
			}
		}
	}

	// add birthdays list on calendar date event--------------------------------------------------------
	if($birthdates !=null || count($birthdates) !=0){
		for($m=0;$m<=count($birthdates);$m++){
			$date1 = explode('-', $birthdates[0]['start']);
			array_push($result[ltrim($date1[2],'0')]['birthdate'],$birthdates[0]['bemp_record']);
			unset($birthdates[0]);
			$birthdates = array_values($birthdates);
			$m=0;

		}
	}


	//add anniversaries list on calendar date event-----------------------------------------------------
	if($annidates !=null || count($annidates) !=0){
		for($m=0;$m<=count($annidates);$m++){
			$date1 = explode('-', $annidates[0]['start']);
			array_push($result[ltrim($date1[2],'0')]['annidate'],$annidates[0]['bemp_record']);
			unset($annidates[0]);
			$annidates = array_values($annidates);
			$m=0;
		}
	}

	// add employee wise weeklyoff on calendar date event-----------------------------------------------
	for($i=0;$i<count($weeklyOffs);$i++){
		$date2 = explode('-', $weeklyOffs[$i]['start']);
		$result[ltrim($date2[2],'0')]['type']='weeklyoff';
		$result[ltrim($date2[2],'0')]['title']='Weekly Off';
		$result[ltrim($date2[2],'0')]['presetShortStatus']='W';
		$result[ltrim($date2[2],'0')]['className']=array("green");
	}
	// add public holidays on specific festival date in calendar date event-----------------------------
	for($j=0;$j<count($holidays);$j++){
		$date1 = explode('-', $holidays[$j]['start']);
		$result[ltrim($date1[2],'0')]['type']='pholiday';
		$result[ltrim($date1[2],'0')]['title']=$holidays[$j]['title'];
		$result[ltrim($date1[2],'0')]['presetShortStatus']='F';
		$result[ltrim($date1[2],'0')]['className']=array("green");
	}


	// add attendance from cattendanceqry table in calendar date events--------------------------------- 
	if(!empty($attendances)){
		for($a=0;$a<count($attendances);$a++){

			if($result[$attendances[$a]['num']]['type']=='weeklyoff' || $result[$attendances[$a]['num']]['type']=='pholiday'){
				$result[ltrim($date1[2],'0')]['className'] = array($result[$attendances[$a]['num']]['className'].' '.$attendances[$a]['className'][0]);
			}else{
				$result[$attendances[$a]['num']]['className']=$attendances[$a]['className'];	
			}

			$result[$attendances[$a]['num']]['type'] = $attendances[$a]['type'];
			$result[$attendances[$a]['num']]['title'] = $attendances[$a]['title'];
			$result[$attendances[$a]['num']]['shiftName'] = $attendances[$a]['shiftName'];
			$result[$attendances[$a]['num']]['shiftInOutTime'] = $attendances[$a]['shiftInOutTime'];
			$result[$attendances[$a]['num']]['presetShortStatus'] = $attendances[$a]['presetShortStatus'];
			$result[$attendances[$a]['num']]['presetStatus'] = $attendances[$a]['presetStatus'];
			$result[$attendances[$a]['num']]['startTime'] = $attendances[$a]['startTime'];
			$result[$attendances[$a]['num']]['endTime'] = $attendances[$a]['endTime'];
			$result[$attendances[$a]['num']]['timeSpan'] = $attendances[$a]['timeSpan'];
		}
	}

	// add approved/pending leaves in calendar date event -----------------------------------------------
	if(!empty($leaves)){
		for($b=0;$b<count($leaves);$b++){
			$date1 = explode('-', $leaves[$b]['start']);
			if($result[ltrim($date1[2],'0')]['type']=='weeklyoff' || $result[ltrim($date1[2],'0')]['type']=='pholiday'){
				$result[ltrim($date1[2],'0')]['className'] = array($result[ltrim($date1[2],'0')]['className'][0].' '.$leaves[$b]['className'][0]);
			}else{
				$result[ltrim($date1[2],'0')]['className']=$leaves[$b]['className'];	
			}
			$result[ltrim($date1[2],'0')]['type']=$leaves[$b]['type'];
			$result[ltrim($date1[2],'0')]['title']=$leaves[$b]['title'];
			$result[ltrim($date1[2],'0')]['presetShortStatus']=$leaves[$b]['presetShortStatus'];
			$result[ltrim($date1[2],'0')]['status']=$leaves[$b]['status'];
			$result[ltrim($date1[2],'0')]['reason']=$leaves[$b]['reason'];
			
		}
	}

	
	
	// add regularised attendance in calendar date events (status, reason)-------------------------------
	if(!empty($attregularised)){
		for($c=0;$c<count($attregularised); $c++){
			$date1 = explode('-', $attregularised[$c]['start']);
			
			if($result[ltrim($date1[2],'0')]['type']=='weeklyoff' || $result[ltrim($date1[2],'0')]['type']=='pholiday'){
				$result[ltrim($date1[2],'0')]['className'] = array($result[ltrim($date1[2],'0')]['className'][0].' '.$attregularised[$c]['className'][0]);
			}else{
				$result[ltrim($date1[2],'0')]['className']=$attregularised[$c]['className'];	
			}

			$result[ltrim($date1[2],'0')]['type']=$attregularised[$c]['type'];
			$result[ltrim($date1[2],'0')]['title']=$attregularised[$c]['title'];
			$result[ltrim($date1[2],'0')]['presetStatus'] = $attregularised[$c]['title'];
			$result[ltrim($date1[2],'0')]['reason'] = $attregularised[$c]['reason'];
			$result[ltrim($date1[2],'0')]['status'] = $attregularised[$c]['status'];
			$result[ltrim($date1[2],'0')]['presetShortStatus']=$attregularised[$c]['presetShortStatus'];
			$result[ltrim($date1[2],'0')]['startTime'] = $attregularised[$c]['startTime'];
			$result[ltrim($date1[2],'0')]['endTime'] = $attregularised[$c]['endTime'];
			
		}
	}


	// add OD request in calendar date events (status, reason)-------------------------------

	if(!empty($getODRequest)){
		for($c=0;$c<count($getODRequest); $c++){
			$date1 = explode('-', $getODRequest[$c]['start']);
			if($result[ltrim($date1[2],'0')]['type']=='weeklyoff' || $result[ltrim($date1[2],'0')]['type']=='pholiday'){
				$result[ltrim($date1[2],'0')]['className'] = array($result[ltrim($date1[2],'0')]['className'][0].' '.$getODRequest[$c]['className'][0]);
			}else{
				$result[ltrim($date1[2],'0')]['className']=$getODRequest[$c]['className'];	
			}

			$result[ltrim($date1[2],'0')]['type']=$getODRequest[$c]['type'];
			$result[ltrim($date1[2],'0')]['title']=$getODRequest[$c]['title'];
			$result[ltrim($date1[2],'0')]['presetStatus'] = $getODRequest[$c]['title'];
			$result[ltrim($date1[2],'0')]['reason'] = $getODRequest[$c]['reason'];
			$result[ltrim($date1[2],'0')]['status'] = $getODRequest[$c]['status'];
			$result[ltrim($date1[2],'0')]['presetShortStatus']= $getODRequest[$c]['presetShortStatus'];
			$result[ltrim($date1[2],'0')]['startTime'] = $getODRequest[$c]['startTime'];
			$result[ltrim($date1[2],'0')]['endTime'] = $getODRequest[$c]['endTime'];
			


		}
	}
	


	// add empty date event as Absent in calendar date event ---------------------------------------------
	if($year==$cyear && $month==$cmonth){
		for($d=1;$d<=ltrim($cdate,'0'); $d++){
			if($result[$d]['type']=='null'){
				$result[$d]['type']='empty_attendance';
				$result[$d]['title']='Absent';
				$result[$d]['presetShortStatus']='A';
				$result[$d]['presetStatus']='Absent';
				$result[$d]['timeSpan']=0;
				$result[$d]['className']=array('red circle-legend');
			}
		}
	} else if($year==$cyear && $month>$cmonth){
		for($d=1;$d<=count($result); $d++){
			if($result[$d]['type']=='null'){
				$result[$d]['type']='empty_attendance';
				$result[$d]['title']='';
				$result[$d]['presetShortStatus']='';
				$result[$d]['presetStatus']='';
				$result[$d]['timeSpan']=0;
				$result[$d]['className']=array('circle-legend');
			}
		}
	} else if($year==$cyear &&  $month>=ltrim($firstRosterStart[1],0) && $month<$cmonth){


		if($month>ltrim($firstRosterStart[1],0)){
			for($d=1;$d<=count($result); $d++){
				if($result[$d]['type']=='null'){
					$result[$d]['type']='empty_attendance';
					$result[$d]['title']='Absent';
					$result[$d]['presetShortStatus']='A';
					$result[$d]['presetStatus']='Absent';
					$result[$d]['timeSpan']=0;
					$result[$d]['className']=array('red circle-legend');
				}
			}
		}else if($month==ltrim($firstRosterStart[1],0)){
			for($d=ltrim($firstRosterStart[2],0);$d<=count($result); $d++){
				if($result[$d]['type']=='null'){
					$result[$d]['type']='empty_attendance';
					$result[$d]['title']='Absent';
					$result[$d]['presetShortStatus']='A';
					$result[$d]['presetStatus']='Absent';
					$result[$d]['timeSpan']=0;
					$result[$d]['className']=array('red circle-legend');
				}
			}
		}
	} else {
		for($d=1;$d<=count($result); $d++){
			if($result[$d]['type']=='null'){
				$result[$d]['type']='empty_attendance';
				$result[$d]['title']='Absent';
				$result[$d]['presetShortStatus']='A';
				$result[$d]['presetStatus']='Absent';
				$result[$d]['timeSpan']=0;
				$result[$d]['className']=array('red circle-legend');
			}
		}
	}
	//$firstRosterStart

	$mydata = array_merge($result);
 	echo json_encode($mydata,true);

}

?>