<?php
global $flag;
global $flag1;
global $flag_change;
$flag 	= 0;
$flag1  = 0;
$flag_change =0;

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
	//$OutTime = trim(str_replace(array(':',' '),'',$OutTime));
//$InTime= trim(str_replace(array(':',' '),'',$InTime));
//if($OutTime > 0 && $InTime > 0){
	return (abs(strtotime($OutTime) - strtotime($InTime)) / 60);
//}else{
//	return "Pramod"; //.'-'.$OutTime.','.$InTime;
//}
	
}

function getTimeSpan($OutTime,$InTime){
	$givendata = round(abs(strtotime($OutTime) - strtotime($InTime)) / 60,2);
	$hours = intval($givendata/60);
	$minutes = $givendata - ($hours * 60);
	$hoursminutes = sprintf("%02d",$hours)." hours "." and ".sprintf("%02d",$minutes)." minutes";
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

	/*echo $year.'-'.$month.'-'.$firstDateNum.' || '.$year.'-'.$month.'-'.$lastDateNum; die;*/
	$hello = getShiftWiseRecord($emp_code,$year,$month,$firstDateNum,$lastDateNum);
	return $hello;
}

function getShiftWiseRecord($emp_code,$year,$month,$firstDateN,$lastDateN){
	//var_dump("stop script here"); die; 
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
				'mHrsHalf'			=>getMinutes($rowq00['MHrsHalf'],'00:00:00')
				//'mHrsFul'			=>getMinutes(date_format($rowq00['MHrsFul'],'H:i:s'),'00:00:00'),
				//'mHrsHalf'		=>getMinutes(date_format($rowq00['MHrsHalf'],'H:i:s'),'00:00:00')
			);
		}
		


		for($i=0; $i<count($RowData); $i++){	
			$date 				= $RowData[$i]['attDate'];

			$d 					= date('l, d M Y',strtotime($date));
			$dNum 				= date('j',strtotime($date));
			
			$InOutTime 			= array();
			$resultArray 		= array();
			
			$resultArray['type'] 			= 'attendance';
			$resultArray['shiftName'] 		= 'Shift : '.$RowData[$i]['shiftName'];

			$resultArray['shiftInOutTime'] 	= '('.date_format(date_create($RowData[$i]['shiftFrom']),'h:i a').' - '.date_format(date_create($RowData[$i]['shiftTo']),'h:i a').')';

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
				$timeFrom 			= '';
				$timeTo 			= '';
				$timeFrom = $startTime;
				$timeTo = $endTime;
				
				$shiftFrom_LateAllGPrd 	=  $shiftFrom_LateAllow  =  $shiftFrom_HalfDay = '';
				
				if(strtotime($startTime)<strtotime($shiftMFrom) ) {
					$from = $shiftMFrom;
					$timeFrom = $startTime;
				}else{

					$shiftFrom_LateAllGPrd 	=  addTimeToDateTime($RowData[$i]['lateAllowGPrd'],$shiftFrom);
					$shiftFrom_LateAllow 	=  addTimeToDateTime($RowData[$i]['lateAllow'],$shiftFrom);
					$shiftFrom_HalfDay 		=  addTimeToDateTime($RowData[$i]['mHrsHalf'],$shiftFrom);

					if(strtotime($startTime)<=strtotime($shiftFrom_LateAllGPrd)){ 
						$from = $startTime;
						$timeFrom = $startTime;
					}
					else if(strtotime($startTime)>strtotime($shiftFrom_LateAllGPrd) && strtotime($startTime)<strtotime($shiftFrom_LateAllow) && $flag<=$RowData[$i]['lateAllowCycle']){
						$flag = $flag+1;
						$from = $startTime;
						$timeFrom = $startTime;

					}else if(strtotime($startTime)>strtotime($shiftFrom_LateAllow)  && strtotime($startTime)<=strtotime($shiftFrom_HalfDay)){
						$flag_change=$flag_change+1;
						$from = $startTime;
						$timeFrom = $startTime;
					}
				}


				
				if(strtotime($endTime)>strtotime($shiftMTo)){
					$to = $shiftMTo;
					$timeTo = $endTime;
				}else{
					$shiftTo_ErlyAllGPrd 	=  subTimeToDateTime($shiftTo,$RowData[$i]['erlyAllowGPrd']);
					$shiftTo_ErlyAllow 		=  subTimeToDateTime($shiftTo,$RowData[$i]['erlyAllow']);
					
					$shiftTo_HalfDay 		=  subTimeToDateTime($shiftTo,$RowData[$i]['mHrsFul']-$RowData[$i]['mHrsHalf']);

					if(strtotime($endTime)>=strtotime($shiftTo_ErlyAllGPrd)){
						$to = $endTime;
						$timeTo = $endTime;
					}
					else if(strtotime($startTime)<strtotime($shiftTo_ErlyAllGPrd) && strtotime($endTime)>strtotime($shiftTo_ErlyAllow) 
						&& $flag1<=$RowData[$i]['erlyAllowCycle']){
						$flag1 = $flag1+1;
						$to = $endTime;
						$timeTo = $endTime;

					}else if(strtotime($endTime)<strtotime($shiftTo_ErlyAllow) && strtotime($endTime)>=strtotime($shiftTo_HalfDay)){
						$to = $endTime;
						$timeTo = $endTime;
					}
				}


				//$latetime=$RowData[$i]['lateAllow']/60;
				if(getMinutes($to,$from)>=$RowData[$i]['mHrsFul']){
					$presetShortStatus 	= "P" ;
					$presetStatus  		= "Present";
					$class 				= array('green2 circle-legend');
					$TimeSpan = getTimeSpan($to,$from);     
				}
				else if($flag > $RowData[$i]['lateAllowCycle'] && getMinutes($to,$from)< ($RowData[$i]['mHrsFul']-$RowData[$i]['lateAllow'])   and getMinutes($to,$from)>= $RowData[$i]['mHrsHalf']){ 
				//&& getMinutes($to,$from)< $RowData[$i]['mHrsFul'] and getMinutes($to,$from)>= $RowData[$i]['mHrsHalf']
					$presetShortStatus 	= "H";
					$presetStatus  		= "Half Day";
					$class 				= array('yellow circle-legend');
					$TimeSpan = getTimeSpan($to,$from);
				}
				else if($flag > $RowData[$i]['lateAllowCycle'] && getMinutes($to,$from)< $RowData[$i]['mHrsFul']  and getMinutes($to,$from)>= $RowData[$i]['mHrsHalf']){
					$presetShortStatus 	= "H";
					$presetStatus  		= "Half Day";
					$class 				= array('yellow circle-legend');
					$TimeSpan = getTimeSpan($to,$from);
				}
				else if($flag <= $RowData[$i]['lateAllowCycle'] && getMinutes($to,$from)>($RowData[$i]['mHrsFul']-$RowData[$i]['lateAllow']) and getMinutes($to,$from)>= $RowData[$i]['mHrsHalf']){
					$presetShortStatus 	= "P";
					$presetStatus  		= "Present";
					$class 				= array('green2 circle-legend latecoming_warning');
					$TimeSpan = getTimeSpan($to,$from);
				}
				else if($flag <= $RowData[$i]['lateAllowCycle'] && getMinutes($to,$from)<($RowData[$i]['mHrsFul']-$RowData[$i]['lateAllow']) and getMinutes($to,$from)>= $RowData[$i]['mHrsHalf']){
					$presetShortStatus 	= "H";
					$presetStatus  		= "Half Day";
					$class 				= array('yellow circle-legend');
					$TimeSpan = getTimeSpan($to,$from);
				}
				else{
					$presetShortStatus 	= "A";
					$presetStatus  		= "Absent";
					$class 				= array('red circle-legend');
					$TimeSpan 			= '0';
				}

				$resultArray['num']  				= $dNum;
				$resultArray['start']  				= $date;
				$resultArray['lates']				= $lates;
				$from = DateTime::createFromFormat('Y-m-d H:i:s', $timeFrom);

				
				$resultArray['startTime']			= ($from != null)?$from->format('h:i a'):null;

				$timeTo = DateTime::createFromFormat('Y-m-d H:i:s', $timeTo);
				$resultArray['endTime']				= ($timeTo!=null)?$timeTo->format('h:i a'):null;
				$resultArray['presetShortStatus'] 	= $presetShortStatus;
				$resultArray['presetStatus'] 		= $presetStatus;
				$resultArray['title']		 		= $presetStatus;
				$resultArray['timeSpan']			= $TimeSpan;
				$resultArray['className']			= $class;
				$hello[] = $resultArray;
				
			}else if(!empty($RowData[$i]['inTime']) && empty($RowData[$i]['outTime'])){

				$startTime 			= date_format(date_create($RowData[$i]['inTime']),'Y-m-d H:i:s');
				$shiftFrom			= date_format(date_create($RowData[$i]['shiftFrom']),'Y-m-d H:i:s');
				$shiftMFrom 		= date_format(date_create($RowData[$i]['shiftMFrom']),'Y-m-d H:i:s');
				$from 				= '';
				$timeFrom = '';
				
				if(strtotime($startTime)<strtotime($shiftMFrom) ) {
					$from = $shiftMFrom;
					$timeFrom = $startTime;
				}else{

					$shiftFrom_LateAllGPrd 	=  addTimeToDateTime($RowData[$i]['lateAllowGPrd'],$shiftFrom);
					$shiftFrom_LateAllow 	=  addTimeToDateTime($RowData[$i]['lateAllow'],$shiftFrom);
					$shiftFrom_HalfDay 		=  addTimeToDateTime($RowData[$i]['mHrsHalf'],$shiftFrom);

					if(strtotime($startTime)<=strtotime($shiftFrom_LateAllGPrd)){

						$from = $startTime;
						$timeFrom = $startTime;
					}else if(strtotime($startTime)>strtotime($shiftFrom_LateAllGPrd) && strtotime($startTime)<strtotime($shiftFrom_LateAllow) && $flag<=$RowData[$i]['lateAllowCycle']){
						$flag = $flag+1;
						$from = $startTime;
						$timeFrom = $startTime;

					}else if(strtotime($startTime)>strtotime($shiftFrom_LateAllow)  && strtotime($startTime)<=strtotime($shiftFrom_HalfDay)){
						$from = $startTime;
						$timeFrom = $startTime;
					}
				}


				$presetShortStatus 					= "A";
				$presetStatus  						= "Absent";
				$class 								= array('red circle-legend');
				$TimeSpan 							= '0';
				$resultArray['num']  				= $dNum;
				$resultArray['start']  				= $date;
				$resultArray['lates']				= $lates;
				$resultArray['formattedDate']		= $d;

				$timeFrom = DateTime::createFromFormat('Y-m-d H:i:s', $timeFrom);

				$resultArray['startTime']			= ($timeFrom!=null)?$timeFrom->format('h:i a'):null;
				$resultArray['endTime']				= '';
				$resultArray['presetShortStatus'] 	= $presetShortStatus;
				$resultArray['presetStatus'] 		= $presetStatus;
				$resultArray['title']		 		= $presetStatus;
				$resultArray['timeSpan']			= $TimeSpan;
				$resultArray['className']			= $class;
				$hello[] = $resultArray;

			}else if(empty($RowData[$i]['inTime']) && !empty($RowData[$i]['outTime'])){
				$to 				= '';
				$timeTo ='';
				$endTime  			= date_format(date_create($RowData[$i]['outTime']),'Y-m-d H:i:s');

				$shiftTo			= date_format(date_create($RowData[$i]['shiftTo']),'Y-m-d H:i:s');
				$shiftMTo			= date_format(date_create($RowData[$i]['shiftMTo']),'Y-m-d H:i:s');
				


				if(strtotime($endTime)>strtotime($shiftMTo)){
					$to = $shiftMTo;
					$timeTo = $endTime;
				}else{
					$shiftTo_ErlyAllGPrd 	=  subTimeToDateTime($shiftTo,$RowData[$i]['erlyAllowGPrd']);
					$shiftTo_ErlyAllow 		=  subTimeToDateTime($shiftTo,$RowData[$i]['erlyAllow']);
					$shiftTo_HalfDay 		=  subTimeToDateTime($shiftTo,$RowData[$i]['mHrsFul']-$RowData[$i]['mHrsHalf']);

					if(strtotime($endTime)>=strtotime($shiftTo_ErlyAllGPrd)){
						$to = $endTime;
						$timeTo = $endTime;
					}else if(strtotime($startTime)<strtotime($shiftTo_ErlyAllGPrd) && strtotime($endTime)>strtotime($shiftTo_ErlyAllow) && $flag1<=$RowData[$i]['erlyAllowCycle']){
						$flag1 = $flag1+1;
						$to = $endTime;
						$timeTo = $endTime;

					}else if(strtotime($endTime)<strtotime($shiftTo_ErlyAllow) && strtotime($endTime)>=strtotime($shiftTo_HalfDay)){
						$to = $endTime;
						$timeTo = $endTime;
					}
				}


				$presetShortStatus 					= "A";
				$presetStatus  						= "Absent";
				$class 								= array('red circle-legend');
				$TimeSpan 							= '0';
				$resultArray['num']  				= $dNum;
				$resultArray['start']  				= $date;
				$resultArray['lates']				= $lates;

				$timeTo = DateTime::createFromFormat('Y-m-d H:i:s', $timeTo);
				
				$resultArray['startTime']			= '';
				$resultArray['endTime']				= ($timeTo!=null)?$timeTo->format('h:i a'):null;

				
				$resultArray['presetShortStatus'] 	= $presetShortStatus;
				$resultArray['presetStatus'] 		= $presetStatus;
				$resultArray['title']		 		= $presetStatus;
				$resultArray['timeSpan']			= $TimeSpan;
				$resultArray['className']			= $class;
				
			 	$hello[] = $resultArray;
			
			}else{

				$presetShortStatus 					= "A";
				$presetStatus  						= "Absent";
				$class 								= array('red circle-legend');
				$TimeSpan 							= '0';
				$resultArray['num']  				= $dNum;
				$resultArray['start']  				= $date;
				$resultArray['lates']				= $lates;
			
				$resultArray['startTime']			= '';
				$resultArray['endTime']				= '';
				$resultArray['presetShortStatus'] 	= $presetShortStatus;
				$resultArray['presetStatus'] 		= $presetStatus;
				$resultArray['title']		 		= $presetStatus;
				$resultArray['timeSpan']			= $TimeSpan;
				$resultArray['className']			= $class;
				
			 	$hello[] = $resultArray;

			}
		}
	}	
	return $hello;
}

?>