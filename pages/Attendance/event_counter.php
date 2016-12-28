<?php 
include ('../db_conn.php');
include ('../configdata.php');
include ('Events_Counter/public_holidays.php');
include ('Events_Counter/weekly_off.php');
include ('Events_Counter/emp_attendance.php');
include ('Events_Counter/emp_approved_leave.php');

if($_GET['type']=='myNewEvents'){
	//set global parameters to access or execute database query & their results--------------	
	global $query;
	global $pa;
	global $opt;
	global $ms_db;
	global $num;
	global $fetch;

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

	// check employee date of joining & set their year, month, date
	$sqlq0="SELECT cast(DOJ as date) as DOJ FROM HrdMastQry WHERE EMP_CODE='".$emp_code."'";
	$resultq0=query($query,$sqlq0,$pa,$opt,$ms_db);
	if($num($resultq0)){
		while ($rowq0 = $fetch($resultq0)){
			$dateofjoining = $rowq0['DOJ'];
		} 
	}else{
		$dateofjoining = "2016-01-01";
	}

	$datetime = explode('-', $dateofjoining);
	$jyear  = $datetime[0];
	$jmonth = $datetime[1];
	$jdate  = $datetime[2];

	// total number of days in requested month and set first,last date & their numbers

	$daysInMonth 	= cal_days_in_month(0, $month, $year);
	$firstDate 		= $year.'-'.$month.'-01';					//first date
	$lastDate 		= $year.'-'.$month.'-'.$daysInMonth;		//last date
	$firstDateNum 	= 01;										//first date number
	$lastDateNum 	= $daysInMonth;								//last date number


	$result 	= array();
	for($b=$firstDateNum;$b<=$lastDateNum;$b++){
		$result[ltrim($b,'0')] = array('type'=>'null','lates'=>0,'start'=>$year.'-'.$month.'-'.sprintf("%02d",$b),'status'=>'','lvtype'=>'','timeSpan'=>'00:00','pl'=>'','lwp'=>'','shiftSpan'=>0);
	}

	$holidays 		= getHolidays($month,$year,$emp_code);	
	$leaves 		= getLeaves($month,$year,$emp_code);	


	// set employee first date of joining and current date if year & month are same 
	if($year>=$jyear){
		if($year>$jyear){
			$firstDateNumc 	= 01;
			$lastDateNumc 	= $lastDateNum;
			$weeklyOffs 	= getWeeklyOff($month,$year,$emp_code);         						// dependent events 
			$attendances 	= getAttendance($firstDateNumc,$lastDateNumc,$month,$year,$emp_code);   // solely dependent events 
			$attregularised	= getAttendanceRegularised($month,$year,$emp_code); 					// solely dependent events 

		}else if($year==$jyear){
			if($month>$jmonth && $month<$cmonth){
				$firstDateNumc 	= 01;
				$lastDateNumc 	= $lastDateNum;
				$weeklyOffs 	= getWeeklyOff($month,$year,$emp_code);         						// dependent events 
				$attendances 	= getAttendance($firstDateNumc,$lastDateNumc,$month,$year,$emp_code);   // solely dependent events 
				$attregularised	= getAttendanceRegularised($month,$year,$emp_code); 					// solely dependent events 
			}else if($month==$jmonth){
				$firstDateNumc 	= $jdate;
				$lastDateNumc 	= $lastDateNum;
				$weeklyOffs 	= getWeeklyOff($month,$year,$emp_code);         						// dependent events 
				$attendances 	= getAttendance($firstDateNumc,$lastDateNumc,$month,$year,$emp_code);   // solely dependent events 
				$attregularised	= getAttendanceRegularised($month,$year,$emp_code); 					// solely dependent events 
			}else if($month==$cmonth){
				$firstDateNumc 	= 01;
				$lastDateNumc 	= $cdate;
				$weeklyOffs 	= getWeeklyOff($month,$year,$emp_code);         						// dependent events 
				$attendances 	= getAttendance($firstDateNumc,$lastDateNumc,$month,$year,$emp_code);   // solely dependent events 
				$attregularised	= getAttendanceRegularised($month,$year,$emp_code); 					// solely dependent events 
			}else{
				return false;
			}
		}
	}
	


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



	for($i=0;$i<count($weeklyOffs);$i++){
		$date2 = explode('-', $weeklyOffs[$i]['start']);
		$result[ltrim($date2[2],'0')]['type']='weeklyoff';
	}
	
	for($j=0;$j<count($holidays);$j++){
		$date1 = explode('-', $holidays[$j]['start']);
		$result[ltrim($date1[2],'0')]['type']='pholiday';
	
	}





	if(!empty($attendances)){
		for($a=0;$a<count($attendances);$a++){
			$result[$attendances[$a]['num']]['type'] = $attendances[$a]['type'];
			$result[$attendances[$a]['num']]['lates'] = $attendances[$a]['lates'];
			$result[$attendances[$a]['num']]['timeSpan'] = $attendances[$a]['timeSpan'];
			$result[$attendances[$a]['num']]['shiftSpan'] = $attendances[$a]['shiftSpan'];
		
		}
	}




	if(!empty($leaves)){
		for($b=0;$b<count($leaves);$b++){
			$date1 = explode('-', $leaves[$b]['start']);
			$result[ltrim($date1[2],'0')]['type']='leave';
			$result[ltrim($date1[2],'0')]['status']=$leaves[$b]['status'];
			$result[ltrim($date1[2],'0')]['lvtype']=$leaves[$b]['lvType'];
			$result[ltrim($date1[2],'0')]['pl']=$leaves[$b]['pl'];
			$result[ltrim($date1[2],'0')]['lwp']=$leaves[$b]['lwp'];
			
		}
	}


	
	if(!empty($attregularised)){
		for($c=0;$c<count($attregularised); $c++){
			$date1 = explode('-', $attregularised[$c]['start']);
			$result[ltrim($date1[2],'0')]['type']=$attregularised[$c]['type'];
			$result[ltrim($date1[2],'0')]['status'] = $attregularised[$c]['status'];
			$result[ltrim($date1[2],'0')]['timeSpan'] = $attregularised[$c]['timeSpan'];
			
		}
	}
	
	if($year==$cyear && $month==$cmonth){
		for($d=1;$d<=ltrim($cdate,'0'); $d++){
			if($result[$d]['type']=='null'){
				$result[$d]['type']='empty_attendance';
				$result[$d]['timeSpan']='0';
			}
		}
	}else{
		for($d=1;$d<=count($result); $d++){
			if($result[$d]['type']=='null'){
				$result[$d]['type']='empty_attendance';
				$result[$d]['timeSpan']='0';
			}
		}
	}




	$working_days =0;
	$off_days=0;
	$days_worked=0;
	$pl_days=0;
	$lwp_days=0;
	$absent_days=0;
	$payroll_days=0;
	$hours_worked=0;
	$extra_hours=0;
	$late_days=0;
	$hours_worked_in_shift=0;

	$no_of_present =0;
	$half_days=0;
	$index=-1;
	$index2=-1;
	$leaveDaysCount=0;
	$times = array();
	$shiftSpan= array();
	if($year==$cyear && $month==$cmonth){
		$payroll_days=ltrim($cdate,'0');
		for($d=1;$d<=ltrim($cdate,'0'); $d++){
			
			if($result[$d]['type']=='Present'){
				$no_of_present = $no_of_present+1;
				array_push($times,$result[$d]['timeSpan']);
				array_push($shiftSpan,$result[$d]['shiftSpan']);
				$late_days = $result[$d]['lates'];


			}

			if($result[$d]['type']=='Absent'){
				$absent_days = $absent_days+1;
			}

			if($result[$d]['type']=='empty_attendance'){
				$absent_days = $absent_days+1;
			}

			if($result[$d]['type']=='attRegularised'){
				if($result[$d]['status']=='Pending'){
					$absent_days = $absent_days+1;
				}else{
					$no_of_present = $no_of_present+1;
					array_push($times,$result[$d]['timeSpan']);
				}
			}

			if($result[$d]['type']=='Half Day'){
				$half_days = $half_days+1;
				$absent_days =$absent_days+.5;
				array_push($times,$result[$d]['timeSpan']);
				array_push($shiftSpan,$result[$d]['shiftSpan']);
				$late_days = $result[$d]['lates'];
			}

			if($result[$d]['type']=='leave'){
				if($result[$d]['status']=='Approved'){
					$leaveDaysCount++;
					$pl= explode('-', $result[$d]['pl']);
					$lwp= explode('-', $result[$d]['lwp']);
					if($index!=(int)$pl[0]){
						$index=(int)$pl[0];
						$pl_days=$pl_days+(float)$pl[1];
					}
					if($index2!=(int)$lwp[0]){
						$index2=(int)$lwp[0];
						$lwp_days=(float)$lwp_days+(float)$lwp[1];
					}
				
				}
			}

			if($result[$d]['type']=='pholiday' || $result[$d]['type']=='weeklyoff'){
				$off_days = $off_days+1;
			}

			$working_days++;
			
		}
	}else{
		$payroll_days=count($result);
		for($d=1;$d<=count($result); $d++){

			if($result[$d]['type']=='Present'){
				$no_of_present = $no_of_present+1;
				array_push($times,$result[$d]['timeSpan']);
				array_push($shiftSpan,$result[$d]['shiftSpan']);
				$late_days = $result[$d]['lates'];
			}

			if($result[$d]['type']=='Absent'){
				$absent_days = $absent_days+1;
			}

			if($result[$d]['type']=='empty_attendance'){
				$absent_days = $absent_days+1;
			}
			
			if($result[$d]['type']=='attRegularised'){
				if($result[$d]['status']=='Pending'){
					$absent_days = $absent_days+1;
				}else{
					$no_of_present = $no_of_present+1;
					array_push($times,$result[$d]['timeSpan']);
				}
			}
			
			if($result[$d]['type']=='Half Day'){
				$half_days = $half_days+1;
				$absent_days =(float)$absent_days+.5;
				array_push($times,$result[$d]['timeSpan']);
				array_push($shiftSpan,$result[$d]['shiftSpan']);
				$late_days = $result[$d]['lates'];
			}

			if($result[$d]['type']=='leave'){
				if($result[$d]['status']=='Approved'){
					$leaveDaysCount++;
					$pl= explode('-', $result[$d]['pl']);
					$lwp= explode('-', $result[$d]['lwp']);
					if($index!=(int)$pl[0]){
						$index=(int)$pl[0];
						$pl_days=(float)$pl_days+(float)$pl[1];
					}
					if($index2!=(int)$lwp[0]){
						$index2=(int)$lwp[0];
						$lwp_days=(float)$lwp_days+(float)$lwp[1];
					}
				
				}
			}

			if($result[$d]['type']=='pholiday' || $result[$d]['type']=='weeklyoff'){
				$off_days = $off_days+1;
			}

			$working_days++;
		}
	}


	function getTimeSpan22($OutTime,$InTime){
		$givendata = round(abs(strtotime($OutTime) - strtotime($InTime)) / 60,2);
		$hours = intval($givendata/60);
		$minutes = $givendata - ($hours * 60);
		$hoursminutes = sprintf("%02d",$hours).":".sprintf("%02d",$minutes);
		return $hoursminutes;
	}

	//var_dump($shiftSpan);die;

	$iiii = 0;
    for($ts=0;$ts<count($times);$ts++) {
		sscanf($times[$ts], '%d:%d', $hour, $min);
		$iiii += $hour * 60 + $min;
    }
   
    if ($h = floor($iiii / 60)) {
        $iiii %= 60;
    }
    $hours_worked =  sprintf('%02d:%02d', $h, $iiii);


    $iiii2 = 0;
    for($ts2=0;$ts2<count($shiftSpan);$ts2++) {
		sscanf($shiftSpan[$ts2], '%d:%d', $hour2, $min2);
		$iiii2 += $hour2 * 60 + $min2;
    }
   
    if ($h2 = floor($iiii2 / 60)) {
        $iiii2 %= 60;
    }
    $hours_worked_in_shift =  sprintf('%02d:%02d', $h2, $iiii2);

    //$extra_hours = getTimeSpan22($hours_worked,$hours_worked_in_shift);


    list($hours, $minutes) = split(':', $hours_worked);
	$startTimestamp = mktime($hours, $minutes);
	
	list($hours, $minutes) = split(':', $hours_worked_in_shift);
	$endTimestamp = mktime($hours, $minutes);
	
	$seconds = $startTimestamp-$endTimestamp;
	$minutes = ($seconds / 60) % 60;
	$hours = round($seconds / (60 * 60));
	$extra_hours = $hours.':'.$minutes;
//$fulltime = new DateTime($hours_worked);
//$totalduration = new DateTime($hours_worked_in_shift);
//$res= $fulltime->diff($totalduration);
//var_dump($res);die;
//echo "DIFF: ".$res->format("%H:%S");
//DIFF: 01:00
//echo "DIFF: ".$res->format("%H:%I:%S");
//die;

	$absent_days_left = $leaveDaysCount-((float)$pl_days+(float)$lwp_days); 
	$absent_days      = $absent_days+(float)$absent_days_left;
	$working_days     = $working_days-$off_days;
	$days_worked      = $no_of_present+($half_days/2);

	echo json_encode(array('status'=>true,'working_days'=>$working_days,'off_days'=>$off_days,'days_worked'=>$days_worked,'pl_days'=>$pl_days,'lwp_days'=>$lwp_days,'absent_days'=>$absent_days,'payroll_days'=>$payroll_days,'hours_worked'=>$hours_worked,'extra_hours'=>$extra_hours,'late_days'=>$late_days,'hours_worked_in_shift'=>$hours_worked_in_shift));
}

?>