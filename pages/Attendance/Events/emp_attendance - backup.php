<?php
global $flag;
$flag=1;
//pre-defined functions --- calls by some input
function get_time_difference($time1, $time2) { 
    $time1 = strtotime("$time1"); 
    $time2 = strtotime("$time2"); 
    if ($time2 < $time1){ 
        $time2 = $time2 + 86400; 
    } 
    return ($time2 - $time1) / 3600; 
} 

function getMinutes($OutTime,$InTime){
	return round(abs(strtotime($OutTime) - strtotime($InTime)) / 60,2);
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

function getAttendance($month,$year,$emp_code){

	date_default_timezone_set("Asia/Kolkata");
	$current_date		= strtotime(date("Y-m-d"));
	$cmonth 			= date('m', $current_date);
	$cdate       		= date('d', $current_date);

	global $query,$pa,$opt,$ms_db,$num,$fetch;
	if($month==$cmonth){
		$daysInMonth 	= cal_days_in_month(0, $month, $year);
		$firstDate 		= $year.'-'.$month.'-01';
		$lastDate 		= $year.'-'.$month.'-'.$cdate;
		$firstDateNum 	= '01';
		$lastDateNum 	= $cdate;

	}else if($month<$cmonth){
		$daysInMonth 	= cal_days_in_month(0, $month, $year);
		$firstDate 		= $year.'-'.$month.'-01';
		$lastDate 		= $year.'-'.$month.'-'.$daysInMonth;
		$firstDateNum 	= '01';
		$lastDateNum 	= $daysInMonth;
	}else{
		$daysInMonth 	= cal_days_in_month(0, $month, $year);
		$firstDate 		= $year.'-'.$month.'-01';
		$lastDate 		= $year.'-'.$month.'-'.$daysInMonth;
		$firstDateNum 	= '01';
		$lastDateNum 	= $daysInMonth;
	}
	


	$result= array();
	$finalResult= array();
	$sqlq="SELECT ShiftMastID,cast(ATT_FROM as date) attfrom,cast(ATT_TO as date) attto 
			FROM AttRoster 
			WHERE EMP_CODE='".$emp_code."' 
			AND ((DATEPART(MM, ATT_FROM) ='".$month."'AND DATEPART(YY, ATT_FROM)='".$year."') 
			OR   (DATEPART(MM, ATT_TO) = '".$month."' AND DATEPART(YY, ATT_FROM)='".$year."'))
			ORDER BY ATT_FROM ASC";
	$resultq=query($query,$sqlq,$pa,$opt,$ms_db);
	
	if($resultq !=0){
		$tempArray2=$num($resultq);
	}else{
		$tempArray2=-1;
	}

	if($tempArray2>0) {
		while ($rowq = $fetch($resultq)){
			$result[] =array('shiftmastId'=>$rowq['ShiftMastID'],'from'=>date_format($rowq['attfrom'],'d'),'to'=>date_format($rowq['attto'],'d'));
		}
	}else if($tempArray2==0){
		$sqlq11="SELECT TOP 1 ShiftMastID FROM AttRoster WHERE EMP_CODE='".$emp_code."' AND automatic_period='1'
			ORDER BY UPDATED_ON DESC";
		$resultq11=query($query,$sqlq11,$pa,$opt,$ms_db);

		if($resultq11){
			$tempArray31 = $num($resultq11);
		}else{
			$tempArray31=-1;
		}

		if($tempArray31>0) {
			while ($rowq11 = $fetch($resultq11)){
				$result[] =array('shiftmastId'=>$rowq11['ShiftMastID'],'from'=>01,'to'=>$lastDateNum);
			}
		}
		
	}

	$tempArray = array();
	$tempFromTo = array();
	for($i=0;$i<count($result); $i++){
		$tempArray[] = $result[$i]['shiftmastId'];
		$tempFromTo[] =array($result[$i]['from'],$result[$i]['to']);
	}

	$ShiftMastids = implode(', ', $tempArray);
	$sqlq1="select ShiftMastId,Shift_Code,Shift_Name,ShiftStart_SwTime,ShiftEnd_SwTime,Shift_MFrom,
				Shift_MTo,Shift_From,Shift_To,LATCOMINGSTATUS,LateAllow,LateAllowCycle,LateAllowGPrd,EARLYGOINGSTATUS,ErlyAllow,
				ErlyAllowCycle,ErlyAllowGPrd,MHrsFul,MHrsHalf,shift_status from ShiftMast where ShiftMastId in(".$ShiftMastids.")";
	$resultq1=query($query,$sqlq1,$pa,$opt,$ms_db);

	$shiftArray = array();
	if($resultq1){
		$tempRow = $num($resultq1);
	}else{
		$tempRow =-1;
	}
	
	
	if($tempRow>0) {
		while ($rowq1 = $fetch($resultq1)){
			$shiftArray[] =array(
			'Shift_Code'  		=> $rowq1['Shift_Code'],
			'Shift_Name'  		=> $rowq1['Shift_Name'],
			'ShiftStart_SwTime' => date_format($rowq1['ShiftStart_SwTime'],'H:i:s'),
			'ShiftEnd_SwTime' 	=> date_format($rowq1['ShiftEnd_SwTime'],'H:i:s'),
			'Shift_From'  		=> date_format($rowq1['Shift_From'],'H:i:s'),
			'Shift_Fromap'  	=> date_format($rowq1['Shift_From'],'h:i a'),
			'Shift_To'    		=> date_format($rowq1['Shift_To'],'H:i:s'),
			'Shift_Toap'    	=> date_format($rowq1['Shift_To'],'h:i a'),
			'Shift_MFrom' 		=> date_format($rowq1['Shift_MFrom'],'H:i:s'),
			'Shift_MTo'   		=> date_format($rowq1['Shift_MTo'],'H:i:s'),
			'Shift_Late_Status' => $rowq1['LATCOMINGSTATUS'],
			'LateAllow'			=> $rowq1['LateAllow'],							//in minutes
			'LateAllowCycle' 	=> $rowq1['LateAllowCycle'],
			'LateAllowGPrd' 	=> $rowq1['LateAllowGPrd'],						//in minutes
			'Shift_Early_Status'=> $rowq1['EARLYGOINGSTATUS'],
			'ErlyAllow'			=> $rowq1['ErlyAllow'],							//in minutes
			'ErlyAllowCycle' 	=> $rowq1['ErlyAllowCycle'],
			'ErlyAllowGPrd'		=> $rowq1['ErlyAllowGPrd'],					//in minutes
			'MHrsFul'			=> getMinutes(date_format($rowq1['MHrsFul'],'H:i:s'),'00:00:00'),
			'MHrsHalf'			=> getMinutes(date_format($rowq1['MHrsHalf'],'H:i:s'),'00:00:00'),
			'Shift_Status' 		=> $rowq1['shift_status']
			);
		}

		$hello = array();

		for($p=0;$p<count($tempFromTo);$p++){
			global $flag;
			global $hello;
			$tempFirst = $tempFromTo[$p][0];
			$tempLast  = $tempFromTo[$p][1];
		
			if($flag==1){
				$hello = getShiftWiseRecord($emp_code,$year,$month,$firstDateNum,$tempLast,$shiftArray[$p],$hello);
			}else if($flag>1 && $flag <count($tempFromTo)){
				$hello = getShiftWiseRecord($emp_code,$year,$month,$tempFirst,$tempLast,$shiftArray[$p],$hello);
			}else{
				$hello = getShiftWiseRecord($emp_code,$year,$month,$tempFirst,$lastDateNum,$shiftArray[$p],$hello);
			}
		}
		return $hello;
	}

	
//return json_encode($hello);

	
}

function getShiftWiseRecord($emp_code,$year,$month,$firstDateN,$lastDateN,$Shift_array,$hello){
	global $flag;
	$flag = $flag+1;
	global $query,$pa,$opt,$ms_db,$num,$fetch,$lates;
	
	if($Shift_array['Shift_Status']=='D'){
		

		for($ddd=$firstDateN; $ddd<=$lastDateN;$ddd++){
			$dd = sprintf("%02d", $ddd);

			$date = "{$year}-{$month}-{$dd}";
			$d = date('l, d M Y',strtotime($date));


			$InOutTime = array();
			$resultArray = array();


			$sqlq2="SELECT cast(PunchDate as time ) time
					FROM ATTENDANCE 
					WHERE  EMP_CODE ='".$emp_code."' and cast(PunchDate as date) = '".$date."' 
							AND  cast(PunchDate as time) IN (
							SELECT TOP 1 cast(MIN(PunchDate) as time) time
							FROM ATTENDANCE 
							WHERE  EMP_CODE ='".$emp_code."' AND cast(PunchDate as date) = '".$date."' 
							UNION ALL
							SELECT TOP 1 cast(MAX(PunchDate) as time) time
							FROM ATTENDANCE 
							WHERE  EMP_CODE ='".$emp_code."' AND cast(PunchDate as date) = '".$date."' 
							) order by PunchDate asc";
			
			$resultq2=query($query,$sqlq2,$pa,$opt,$ms_db);
			if($resultq2){
				$tempArray3 = $num($resultq2);
			}else{
				$tempArray3 = -1;
			}
			if($tempArray3 > 0) {
				while ($rowq2 = $fetch($resultq2)){
					$InOutTime[] = date_format($rowq2['time'],'H:i:s');
				}
			}

			$resultArray['type'] 		= 'attendance';
			$resultArray['shiftName'] 	= $Shift_array['Shift_Name'];
			$resultArray['shiftInOutTime'] = $Shift_array['Shift_Fromap'].' - '.$Shift_array['Shift_Toap'];
			
			
			$InTime ='';
			$OutTime ='';
			$presetShortStatus 	= "";
			$presetStatus  		= "";
			$startTime ='';
			$endTime='';
			$TimeSpan='';



			

			if(count($InOutTime)==2){
				$startTime 	= $InOutTime[0];
				$endTime 	= $InOutTime[1];

				
				if(strtotime($Shift_array['ShiftStart_SwTime'])<=strtotime($startTime) and strtotime($startTime) <=strtotime($Shift_array['Shift_MFrom'])){
					$InTime = $Shift_array['Shift_MFrom'];
					$OutTime= $endTime;

					$presetShortStatus 	= "P";
					$presetStatus  		= "Present";
					$class 				= ['green2'];
					$TimeSpan = getTimeSpan($OutTime,$InTime);
					
				}else if(strtotime($startTime) >strtotime($Shift_array['Shift_MFrom']) and strtotime($startTime) <=strtotime(getHoursMiutes($Shift_array['LateAllowGPrd']),strtotime($Shift_array['Shift_From'])) ){
					$InTime = $startTime;
					$OutTime= $endTime;
					
					if(getMinutes($OutTime,$InTime)>=$Shift_array['MHrsFul']){
						$presetShortStatus 	= "P";
						$presetStatus  		= "Present";
						$class 				= ['green2'];
						$TimeSpan = getTimeSpan($OutTime,$InTime);
					}else if(getMinutes($OutTime,$InTime)<$Shift_array['MHrsFul'] and getMinutes($OutTime,$InTime) >= $Shift_array['MHrsHalf']){
						$presetShortStatus 	= "H";
						$presetStatus  		= "Half Day";
						$class 				= ['yellow'];
						$TimeSpan = getTimeSpan($OutTime,$InTime);
					}
					
					
				}else if(strtotime($startTime) > strtotime(getHoursMiutes($Shift_array['LateAllowGPrd']),strtotime($Shift_array['Shift_From'])) and strtotime($startTime) <=strtotime(getHoursMiutes($Shift_array['LateAllowGPrd']),strtotime(getHoursMiutes($Shift_array['LateAllow']),strtotime($Shift_array['Shift_From'])))){
					$lates=$lates+1;
					$InTime = $startTime;
					$OutTime= $endTime;
					if($lates>$Shift_array['LateAllowCycle']){
						if(getMinutes($OutTime,$InTime)>=$Shift_array['MHrsFul']){
							$presetShortStatus 	= "P";
							$presetStatus  		= "Present";
							$class 				= ['green2'];
							$TimeSpan = getTimeSpan($OutTime,$InTime);
						}else if(getMinutes($OutTime,$InTime)<$Shift_array['MHrsFul'] and getMinutes($OutTime,$InTime) >= $Shift_array['MHrsHalf']){
							$presetShortStatus 	= "H";
							$presetStatus  		= "Half Day";
							$class 				= ['yellow'];
							$TimeSpan = getTimeSpan($OutTime,$InTime);
						}
						
					}else{
						if(getMinutes($OutTime,$InTime)>=$Shift_array['MHrsFul']){
							$presetShortStatus 	= "P";
							$presetStatus  		= "Present";
							$class 				= ['green2'];
							$TimeSpan = getTimeSpan($OutTime,$InTime);
						}else if(getMinutes($OutTime,$InTime)<$Shift_array['MHrsFul'] and getMinutes($OutTime,$InTime) >= $Shift_array['MHrsHalf']){
							$presetShortStatus 	= "H";
							$presetStatus  		= "Half Day";
							$class 				= ['yellow'];
							$TimeSpan = getTimeSpan($OutTime,$InTime);
						}
						
					}
				}else if(strtotime($startTime) > strtotime(getHoursMiutes($Shift_array['LateAllowGPrd']),strtotime(getHoursMiutes($Shift_array['LateAllow']),strtotime($Shift_array['Shift_From'])))){
					$InTime = $startTime;
					$OutTime= $endTime;
					if(getMinutes($OutTime,$InTime)<$Shift_array['MHrsFul'] and getMinutes($OutTime,$InTime) >= $Shift_array['MHrsHalf']){
						$presetShortStatus 	= "H";
						$presetStatus  		= "Half Day";
						$class 				= ['yellow'];
						$TimeSpan = getTimeSpan($OutTime,$InTime);
					}else{
						$presetShortStatus 	= "A";
						$presetStatus  		= "Absent";
						$class 				= ['red'];
						$TimeSpan = '0';
					}
				}
				$resultArray['start']			    = $date;

			}else if(count($InOutTime)==1){
				$presetShortStatus 	= "A";
				$presetStatus  		= "Absent";
				$class 				= ['red'];
				$TimeSpan = '0';
				$OneTime	= $InOutTime[0];
				
				if(strtotime($Shift_array['ShiftStart_SwTime'])<strtotime($OneTime) && strtotime($OneTime)<strtotime($Shift_array['Shift_From'])){
					$InTime 	= $OneTime;
					$OutTime  	= '-';
				}else if(strtotime($Shift_array['ShiftEnd_SwTime'])>strtotime($OneTime) && strtotime($OneTime)>strtotime($Shift_array['Shift_To'])){
					$InTime 	= '-';
					$OutTime  	= $OneTime;
				}else{
					$TimeDiff = get_time_difference($Shift_array['Shift_From'],$OneTime);
					$TimeDiff2 = get_time_difference($Shift_array['Shift_To'],$OneTime);
					if($TimeDiff<$TimeDiff2){
						$InTime 	= $OneTime;
						$OutTime  	= '-';
					}else{
						$InTime 	= '-';
						$OutTime  	= $OneTime;
					}
				}
				$resultArray['start']			    = $date;

			}else{
				goto end;
			}

			$resultArray['lates']				= $lates;
			$resultArray['formattedDate']		= $d;
			
			if($InTime != '-'){
				$resultArray['startTime']			= date_format( date_create($InTime),'h:i a');
			}else{
				$resultArray['startTime']			= $InTime;
			}
			if($OutTime!='-'){
				$resultArray['endTime']				= date_format( date_create($OutTime),'h:i a');
			}else{
				$resultArray['endTime']				= $OutTime;
			}
			
			$resultArray['presetShortStatus'] 	= $presetShortStatus;
			$resultArray['presetStatus'] 		= $presetStatus;
			$resultArray['title']		 		= $presetStatus;
			$resultArray['timeSpan']			= $TimeSpan;
			$resultArray['className']			= $class;
			$resultArray['allDay']			    = TRUE;
			$resultArray['birthdate']			= array();
			$resultArray['annidate']			= array();
		 	$hello[] = $resultArray;
		 	end:
		}
		return $hello;
	}else if($Shift_array['Shift_Status']=='N'){

		for($ddd=$firstDateN; $ddd<=$lastDateN;$ddd++){
			$dd = sprintf("%02d", $ddd);

			$date = "{$year}-{$month}-{$dd}";
			$d = date('l, d M Y',strtotime($date));


			$date1 = str_replace('-', '/', $date);
			$tomorrow = date('Y-m-d',strtotime($date1 . "+1 days"));


			$InOutTime = array();
			$resultArray = array();


			$sqlq2="SELECT cast(PunchDate as time ) time
					FROM ATTENDANCE 
					WHERE  EMP_CODE ='".$emp_code."' and cast(PunchDate as date) BETWEEN '".$date."' AND '".$tomorrow."' 
							AND  cast(PunchDate as time) IN (
							SELECT TOP 1 cast(MIN(PunchDate) as time) time
							FROM ATTENDANCE 
							WHERE  EMP_CODE ='".$emp_code."' AND cast(PunchDate as date) = '".$date."' AND cast(PunchDate as time) >='".$Shift_array['ShiftStart_SwTime']."' 
							UNION ALL
							SELECT TOP 1 cast(MAX(PunchDate) as time) time
							FROM ATTENDANCE 
							WHERE  EMP_CODE ='".$emp_code."' AND cast(PunchDate as date) = '".$tomorrow."' AND cast(PunchDate as time) <='".$Shift_array['ShiftEnd_SwTime']."' 
							) order by PunchDate asc";
			
			$resultq2=query($query,$sqlq2,$pa,$opt,$ms_db);
			if($resultq2){
				$tempArray4 = $num($resultq2);
			}else{
				$tempArray4 =-1;
			}
			if($tempArray4 > 0) {
				while ($rowq2 = $fetch($resultq2)){
					$InOutTime[] = date_format($rowq2['time'],'H:i:s');
				}
			}

			$resultArray['type']='attendance';
			$resultArray['shiftName'] = $Shift_array['Shift_Name'];
			$resultArray['shiftInOutTime'] = $Shift_array['Shift_Fromap'].' - '.$Shift_array['Shift_Toap'];
			
			
			$InTime ='';
			$OutTime ='';
			$presetShortStatus 	= "";
			$presetStatus  		= "";
			$startTime ='';
			$endTime='';
			$TimeSpan='';



			

			if(count($InOutTime)==2){
				$startTime 	= $date.' '.$InOutTime[0];
				$endTime 	= $tomorrow.' '.$InOutTime[1];

				
				if(strtotime($date.' '.$Shift_array['ShiftStart_SwTime'])<=strtotime($startTime) and strtotime($startTime) <=strtotime($date.' '.$Shift_array['Shift_MFrom'])){
					$InTime = $date.' '.$Shift_array['Shift_MFrom'];
					$OutTime= $endTime;

					$presetShortStatus 	= "P";
					$presetStatus  		= "Present";
					$class 				= ['green2'];
					$TimeSpan = getTimeSpan($OutTime,$InTime);
					
				}else if(strtotime($startTime) >strtotime($date.' '.$Shift_array['Shift_MFrom']) and strtotime($startTime) <=strtotime(getHoursMiutes($Shift_array['LateAllowGPrd']),strtotime($date.' '.$Shift_array['Shift_From'])) ){
					$InTime = $startTime;
					$OutTime= $endTime;
					
					if(getMinutes($OutTime,$InTime)>=$Shift_array['MHrsFul']){
						$presetShortStatus 	= "P";
						$presetStatus  		= "Present";
						$class 				= ['green2'];
						$TimeSpan = getTimeSpan($OutTime,$InTime);
					}else if(getMinutes($OutTime,$InTime)<$Shift_array['MHrsFul'] and getMinutes($OutTime,$InTime) >= $Shift_array['MHrsHalf']){
						$presetShortStatus 	= "H";
						$presetStatus  		= "Half Day";
						$class 				= ['yellow'];
						$TimeSpan = getTimeSpan($OutTime,$InTime);
					}
					
				}else if(strtotime($startTime) > strtotime(getHoursMiutes($Shift_array['LateAllowGPrd']),strtotime($Shift_array['Shift_From'])) and strtotime($startTime) <=strtotime(getHoursMiutes($Shift_array['LateAllowGPrd']),strtotime(getHoursMiutes($Shift_array['LateAllow']),strtotime($date.' '.$Shift_array['Shift_From'])))){
					$lates=$lates+1;
					$InTime = $startTime;
					$OutTime= $endTime;
					if($lates>$Shift_array['LateAllowCycle']){
						if(getMinutes($OutTime,$InTime)>=$Shift_array['MHrsFul']){
							$presetShortStatus 	= "P";
							$presetStatus  		= "Present";
							$class 				= ['green2'];
							$TimeSpan = getTimeSpan($OutTime,$InTime);
						}else if(getMinutes($OutTime,$InTime)<$Shift_array['MHrsFul'] and getMinutes($OutTime,$InTime) >= $Shift_array['MHrsHalf']){
							$presetShortStatus 	= "H";
							$presetStatus  		= "Half Day";
							$class 				= ['yellow'];
							$TimeSpan = getTimeSpan($OutTime,$InTime);
						}
						
					}else{
						if(getMinutes($OutTime,$InTime)>=$Shift_array['MHrsFul']){
							$presetShortStatus 	= "P";
							$presetStatus  		= "Present";
							$class 				= ['green2'];
							$TimeSpan = getTimeSpan($OutTime,$InTime);
						}else if(getMinutes($OutTime,$InTime)<$Shift_array['MHrsFul'] and getMinutes($OutTime,$InTime) >= $Shift_array['MHrsHalf']){
							$presetShortStatus 	= "H";
							$presetStatus  		= "Half Day";
							$class 				= ['yellow'];
							$TimeSpan = getTimeSpan($OutTime,$InTime);
						}
						
					}
				}else if(strtotime($startTime) > strtotime(getHoursMiutes($Shift_array['LateAllowGPrd']),strtotime(getHoursMiutes($Shift_array['LateAllow']),strtotime($date.' '.$Shift_array['Shift_From'])))){
					$InTime = $startTime;
					$OutTime= $endTime;
					if(getMinutes($OutTime,$InTime)<$Shift_array['MHrsFul'] and getMinutes($OutTime,$InTime) >= $Shift_array['MHrsHalf']){
						$presetShortStatus 	= "H";
						$presetStatus  		= "Half Day";
						$class 				= ['yellow'];
						$TimeSpan = getTimeSpan($OutTime,$InTime);
					}else{
						$presetShortStatus 	= "A";
						$presetStatus  		= "Absent";
						$class 				= ['red'];
						$TimeSpan = '0';
					}
					
				}
				$resultArray['start']	= $date;
			}else if(count($InOutTime)==1){
				$presetShortStatus 	= "A";
				$presetStatus  		= "Absent";
				$class 				= ['red'];
				$TimeSpan 			= '0';
				$OneTime			= $InOutTime[0];
				
				if(strtotime($Shift_array['ShiftStart_SwTime'])<strtotime($OneTime) && strtotime($OneTime)<=strtotime($Shift_array['Shift_From'])){
					$InTime 	= $OneTime;
					$OutTime  	= '-';
				}else if(strtotime($Shift_array['ShiftEnd_SwTime'])>strtotime($OneTime) && strtotime($OneTime)>=strtotime($Shift_array['Shift_To'])){
					$InTime 	= '-';
					$OutTime  	= $OneTime;
				}else{
					$TimeDiff = get_time_difference($Shift_array['Shift_From'],$OneTime);
					$TimeDiff2 = get_time_difference($Shift_array['Shift_To'],$OneTime);
					if($TimeDiff<$TimeDiff2){
						$InTime 	= $OneTime;
						$OutTime  	= '-';
					}else{
						$InTime 	= '-';
						$OutTime  	= $OneTime;
					}
				}
				$resultArray['start']			    = $date;

			}else{
				goto end1;
			}

			$resultArray['lates']				= $lates;
			$resultArray['formattedDate']		= $d;
			
			if($InTime != '-'){
				$resultArray['startTime']		= date_format( date_create($InTime),'h:i a');
			}else{
				$resultArray['startTime']		= $InTime;
			}
			if($OutTime != '-'){
				$resultArray['endTime']			= date_format( date_create($OutTime),'h:i a');
			}else{
				$resultArray['endTime']			= $OutTime;
			}

			$resultArray['presetShortStatus'] 	= $presetShortStatus;
			$resultArray['presetStatus'] 		= $presetStatus;
			$resultArray['title']		 		= $presetStatus;
			$resultArray['className'] 			= $class;
			$resultArray['timeSpan']			= $TimeSpan;
			$resultArray['allDay']			    = TRUE;
			$resultArray['birthdate']			= array();
			$resultArray['annidate']			= array();
		 	$hello[] = $resultArray;
		 	end1:

		}
		
		return $hello; 
	}

	
}

?>