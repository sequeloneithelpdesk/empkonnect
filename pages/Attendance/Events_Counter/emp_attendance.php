<?php
global $flag;
global $flag1;
global $lates;
$flag 	= 0;
$flag1  = 0;
$lates  = 0;

//pre-defined functions --- calls by some input
function get_time_difference($time1, $time2) { 
    $time1 = strtotime("$time1"); 
    $time2 = strtotime("$time2"); 
    if ($time2 < $time1){ 
        $time2 = $time2 + 86400; 
    } 
    return ($time2 - $time1) / 3600; 
} 

function getMinutesWithOnePara($InTime){
	$givendata = round(abs(strtotime($InTime)-strtotime('00:00:00.0000000')) / 60,2);
	return $givendata;
}

function getMinutes($OutTime,$InTime){
	return round(abs(strtotime($OutTime) - strtotime($InTime)) / 60,2);
}

function getTimeSpan($OutTime,$InTime){
	$givendata = round(abs(strtotime($OutTime) - strtotime($InTime)) / 60,2);
	$hours = intval($givendata/60);
	$minutes = $givendata - ($hours * 60);
	$hoursminutes = sprintf("%02d",$hours).":".sprintf("%02d",$minutes);
	return $hoursminutes;
}

function getHoursMiutes($givendata){
	$hours = intval($givendata/60);
	$minutes = $givendata - ($hours * 60);
	$hoursminutes = "+".sprintf("%02d",$hours)." hour "."+".sprintf("%02d",$minutes)." minutes";
	return $hoursminutes;
}

function addTimeToDateTime($addedTime,$actualTime){
	$hours = intval($addedTime/60);
	$minutes = $addedTime - ($hours * 60);
	$hoursminutes = "+".sprintf("%02d",$hours)." hour "."+".sprintf("%02d",$minutes)." minutes";
	return date('Y-m-d H:i:s',strtotime($hoursminutes,strtotime($actualTime)));
}

function subTimeToDateTime($actualTime,$subtractedTime){
	$hours = intval($subtractedTime/60);
	$minutes = $subtractedTime - ($hours * 60);
	$hoursminutes = "-".sprintf("%02d",$hours)." hour "."-".sprintf("%02d",$minutes)." minutes";
	return date('Y-m-d H:i:s',strtotime($hoursminutes,strtotime($actualTime)));
}

function getAttendance($firstDateNumc,$lastDateNumc,$month,$year,$emp_code){
	date_default_timezone_set("Asia/Kolkata");
	$current_date		= strtotime(date("Y-m-d"));
	$cyear 				= date('Y', $current_date);
	$cmonth 			= date('m', $current_date);
	$cdate       		= date('d', $current_date);

	global $query;
	global $pa;
	global $opt;
	global $ms_db;
	global $num;
	global $fetch;

	if($year>=$cyear){
		if($year==$cyear){
			if($month<$cmonth){
				$daysInMonth 	= cal_days_in_month(0, $month, $year);
				$firstDate 		= $year.'-'.$month.'-'.$firstDateNumc;
				$lastDate 		= $year.'-'.$month.'-'.$cdate;
				$firstDateNum 	= $firstDateNumc;
				$lastDateNum 	= $lastDateNumc;
			}else if($month==$cmonth){
				$daysInMonth 	= cal_days_in_month(0, $month, $year);
				$firstDate 		= $year.'-'.$month.'-'.$firstDateNumc;
				$lastDate 		= $year.'-'.$month.'-'.$cdate;
				$firstDateNum 	= $firstDateNumc;
				$lastDateNum 	= $cdate;
			}
		}
	} else if($year<$cyear){
		$daysInMonth 	= cal_days_in_month(0, $month, $year);
		$firstDate 		= $year.'-'.$month.'-'.$firstDateNumc;
		$lastDate 		= $year.'-'.$month.'-'.$cdate;
		$firstDateNum 	= $firstDateNumc;
		$lastDateNum 	= $lastDateNumc;
	}

	$hello = getShiftWiseRecord($emp_code,$year,$month,$firstDateNum,$lastDateNum);
	return $hello;
}

function getShiftWiseRecord($emp_code,$year,$month,$firstDateN,$lastDateN){

	global $flag;
	global $flag1;
	global $lates;
	global $query;
	global $pa;
	global $opt;
	global $ms_db;
	global $num;
	global $fetch;
	
	$hello = array();
	$RowData ='';
	


	$sqlq00 = "select * from cattendanceqry where EMP_CODE='".$emp_code."' and  ATTDate between '".$year."-".$month."-".sprintf("%02d",$firstDateN)."' and '".$year."-".$month."-".sprintf("%02d",$lastDateN)."'";
	
	$resultq00 = query($query,$sqlq00,$pa,$opt,$ms_db);
	if($resultq00){
		$tempArray00 = $num($resultq00);
	}else{
		$tempArray00 = -1;
	}
	if($tempArray00 > 0) {
		while ($rowq00 = $fetch($resultq00)){
			$RowData[] = array(
				'empCode'			=>$rowq00['EMP_CODE'],
				'attDate'			=>$rowq00['ATTDATE'],
				'inTime'			=>$rowq00['IN_TIME'],
				'outTime'			=>$rowq00['OUT_TIME'],
				'shiftName'			=>$rowq00['Shift_Name'],
				'shiftFrom'			=>$rowq00['ShiftFrom'],
				'shiftTo'			=>$rowq00['Shiftto'],
				'shiftMFrom'		=>$rowq00['ShiftMFrom'],
				'shiftMTo'			=>$rowq00['ShiftMTo'],
				'lateAllow'			=>$rowq00['LateAllow'],
				'lateAllowCycle'	=>$rowq00['LateAllowCycle'],
				'lateAllowGPrd'		=>$rowq00['LateAllowGPrd'],
				'erlyAllow'			=>$rowq00['ErlyAllow'],
				'erlyAllowCycle'	=>$rowq00['ErlyAllowCycle'],
				'erlyAllowGPrd'		=>$rowq00['ErlyAllowGPrd'],
				'mHrsFul'			=>getMinutes($rowq00['MHrsFul'],'00:00:00'),
				'mHrsHalf'			=>getMinutes($rowq00['MHrsHalf'],'00:00:00'),
				'mFulShift'			=>date_format(date_create($rowq00['MHrsFul']),'H:i'),
				'mHalfShift'		=>date_format(date_create($rowq00['MHrsHalf']),'H:i')
			);
		}
	

		for($i=0; $i<count($RowData); $i++){
			$date 				= $RowData[$i]['attDate'];
			$dNum 				= date('j',strtotime($date));
			$InOutTime 			= array();
			$resultArray 		= array();


			$InTime 			='';
			$OutTime 			='';
			$presetShortStatus 	="";
			$presetStatus  		="";
			$startTime 			='';
			$endTime 			='';
			$TimeSpan 			='';
			$startTime          ='';
			$endTime            ='';
			$shiftMFrom         ='';
			$shiftMTo           ='';
			$shiftFrom          ='';
			$shiftTo            ='';
			
			if(!empty($RowData[$i]['inTime']) && !empty($RowData[$i]['outTime'])){
				$startTime 			= date_format(date_create($RowData[$i]['inTime']),'Y-m-d H:i:s');
				$endTime  			= date_format(date_create($RowData[$i]['outTime']),'Y-m-d H:i:s');
				$shiftFrom			= date_format(date_create($RowData[$i]['shiftFrom']),'Y-m-d H:i:s');
				$shiftTo			= date_format(date_create($RowData[$i]['shiftTo']),'Y-m-d H:i:s');
				$shiftMFrom 		= date_format(date_create($RowData[$i]['shiftMFrom']),'Y-m-d H:i:s');
				$shiftMTo			= date_format(date_create($RowData[$i]['shiftMTo']),'Y-m-d H:i:s');
			
				$from 				= '';
				$to 				= '';

				
				if(strtotime($startTime)<strtotime($shiftMFrom) ) {
					$from = $shiftMFrom;
				}else{

					$shiftFrom_LateAllGPrd 	=  addTimeToDateTime($RowData[$i]['lateAllowGPrd'],$shiftFrom);
					$shiftFrom_LateAllow 	=  addTimeToDateTime($RowData[$i]['lateAllow'],$shiftFrom);
					$shiftFrom_HalfDay 		=  addTimeToDateTime($RowData[$i]['mHrsHalf'],$shiftFrom);

					if(strtotime($startTime)<=strtotime($shiftFrom_LateAllGPrd)){

						$from = $startTime;
					}else if(strtotime($startTime)>strtotime($shiftFrom_LateAllGPrd) && strtotime($startTime)<strtotime($shiftFrom_LateAllow) && $flag<=$RowData[$i]['lateAllowCycle']){
						$flag = $flag+1;
						$from = $startTime;

					}else if(strtotime($startTime)>strtotime($shiftFrom_LateAllow)  && strtotime($startTime)<=strtotime($shiftFrom_HalfDay)){
						$lates = $lates+1;
						$from = $startTime;
						
					}
				}


				
				if(strtotime($endTime)>strtotime($shiftMTo)){
					$to = $shiftMTo;
				}else{
					$shiftTo_ErlyAllGPrd 	=  subTimeToDateTime($shiftTo,$RowData[$i]['erlyAllowGPrd']);
					$shiftTo_ErlyAllow 		=  subTimeToDateTime($shiftTo,$RowData[$i]['erlyAllow']);
					$shiftTo_HalfDay 		=  subTimeToDateTime($shiftTo,$RowData[$i]['mHrsFul']-$RowData[$i]['mHrsHalf']);

					if(strtotime($endTime)>=strtotime($shiftTo_ErlyAllGPrd)){
						$to = $endTime;
					}else if(strtotime($startTime)<strtotime($shiftTo_ErlyAllGPrd) && strtotime($endTime)>strtotime($shiftTo_ErlyAllow) && $flag1<=$RowData[$i]['erlyAllowCycle']){
						$flag1 = $flag1+1;
						$to = $endTime;

					}else if(strtotime($endTime)<strtotime($shiftTo_ErlyAllow) && strtotime($endTime)>=strtotime($shiftTo_HalfDay)){
						$to = $endTime;
					}
				}



				if(getMinutes($to,$from)>=$RowData[$i]['mHrsFul']){
					
					$type  		= "Present";
					$TimeSpan = getTimeSpan($to,$from);
					$shiftSpan = $RowData[$i]['mFulShift'];
				}else if(getMinutes($to,$from)<$RowData[$i]['mHrsFul'] and getMinutes($to,$from)>= $RowData[$i]['mHrsHalf']){
					
					$type  		= "Half Day";
					$TimeSpan = getTimeSpan($to,$from);
					$shiftSpan = $RowData[$i]['mHalfShift'];
				}else{
					$type  		= "Absent";
					$TimeSpan 	= '00:00';
				}
				$resultArray['num']  				= $dNum;
				$resultArray['start']  				= $date;
				$resultArray['lates']				= $lates;
				$resultArray['type']		 		= $type;
				$resultArray['timeSpan']			= $TimeSpan;
				$resultArray['shiftSpan']			= $shiftSpan;
			
				$hello[] = $resultArray;
				
			}else if(!empty($RowData[$i]['inTime']) && empty($RowData[$i]['outTime'])){
				$startTime 			= date_format(date_create($RowData[$i]['inTime']),'Y-m-d H:i:s');
				$shiftFrom			= date_format(date_create($RowData[$i]['shiftFrom']),'Y-m-d H:i:s');
				$shiftMFrom 		= date_format(date_create($RowData[$i]['shiftMFrom']),'Y-m-d H:i:s');
				$from 				= '';
				
				if(strtotime($startTime)<strtotime($shiftMFrom) ) {
					$from = $shiftMFrom;
				}else{

					$shiftFrom_LateAllGPrd 	=  addTimeToDateTime($RowData[$i]['lateAllowGPrd'],$shiftFrom);
					$shiftFrom_LateAllow 	=  addTimeToDateTime($RowData[$i]['lateAllow'],$shiftFrom);
					$shiftFrom_HalfDay 		=  addTimeToDateTime($RowData[$i]['mHrsHalf'],$shiftFrom);

					if(strtotime($startTime)<=strtotime($shiftFrom_LateAllGPrd)){

						$from = $startTime;
					}else if(strtotime($startTime)>strtotime($shiftFrom_LateAllGPrd) && strtotime($startTime)<strtotime($shiftFrom_LateAllow) && $flag<=$RowData[$i]['lateAllowCycle']){
						$flag = $flag+1;
						$from = $startTime;

					}else if(strtotime($startTime)>strtotime($shiftFrom_LateAllow)  && strtotime($startTime)<=strtotime($shiftFrom_HalfDay)){
						$from = $startTime;
					}
				}

				$type  								= "Absent";
				$TimeSpan 							= '00:00';
				$resultArray['num']  				= $dNum;
				$resultArray['start']  				= $date;
				$resultArray['lates']				= $lates;
				$resultArray['type']		 		= $type;
				$resultArray['timeSpan']			= $TimeSpan;
				$hello[] = $resultArray;

			}else if(empty($RowData[$i]['inTime']) && !empty($RowData[$i]['outTime'])){
				$to 				= '';
				$endTime  			= date_format(date_create($RowData[$i]['outTime']),'Y-m-d H:i:s');
				$shiftTo			= date_format(date_create($RowData[$i]['shiftTo']),'Y-m-d H:i:s');
				$shiftMTo			= date_format(date_create($RowData[$i]['shiftMTo']),'Y-m-d H:i:s');
				
				if(strtotime($endTime)>strtotime($shiftMTo)){
					$to = $shiftMTo;
				}else{
					$shiftTo_ErlyAllGPrd 	=  subTimeToDateTime($shiftTo,$RowData[$i]['erlyAllowGPrd']);
					$shiftTo_ErlyAllow 		=  subTimeToDateTime($shiftTo,$RowData[$i]['erlyAllow']);
					$shiftTo_HalfDay 		=  subTimeToDateTime($shiftTo,$RowData[$i]['mHrsFul']-$RowData[$i]['mHrsHalf']);

					if(strtotime($endTime)>=strtotime($shiftTo_ErlyAllGPrd)){
						$to = $endTime;
					}else if(strtotime($startTime)<strtotime($shiftTo_ErlyAllGPrd) && strtotime($endTime)>strtotime($shiftTo_ErlyAllow) && $flag1<=$RowData[$i]['erlyAllowCycle']){
						$flag1 = $flag1+1;
						$to = $endTime;
					}else if(strtotime($endTime)<strtotime($shiftTo_ErlyAllow) && strtotime($endTime)>=strtotime($shiftTo_HalfDay)){
						$to = $endTime;
					}
				}


				$type  								= "Absent";
				$TimeSpan 							= '00:00';
				$resultArray['num']  				= $dNum;
				$resultArray['start']  				= $date;
				$resultArray['lates']				= $lates;
				$resultArray['type']		 		= $type;
				$resultArray['timeSpan']			= $TimeSpan;
				
			 	$hello[] = $resultArray;
			
			}else{
				$type  								= "Absent";
				$TimeSpan 							= '00:00';
				$resultArray['num']  				= $dNum;
				$resultArray['start']  				= $date;
				$resultArray['lates']				= $lates;
				$resultArray['type']		 		= $type;
				$resultArray['timeSpan']			= $TimeSpan;
				
			 	$hello[] = $resultArray;

			}
		}
	}	
	return $hello;
}

?>