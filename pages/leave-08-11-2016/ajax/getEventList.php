
<?php
include ('../../db_conn.php');
include ('../../configdata.php');

if($_GET['type']=='myNewEvents'){

	$start = explode('-', $_POST['start']);
	$end   = explode('-', $_POST['end']);
	if($start[2]==1){
		$end[1]=$start[1];
	}else{
		if($start[1]==12){
			$start[1]=1;
			$end[1] = $end[1]-1;
		}else if($start[1]==11){
			$start[1] = $start[1]+1;
			$end[1] = 12;
		}else{
			$start[1] = $start[1]+1;
			$end[1] = $end[1]-1;	
		}
		
	}
	

	$result1= array();

	$daysInMonth = cal_days_in_month(0, $start[1], $start[0]);
	$firstDate= $start[0].'-'.$start[1].'-01';
	$lastDate = $start[0].'-'.$start[1].'-'.$daysInMonth;
	
	$result1= array();
	$givenArray = Array();
	
	$sqlq="select * from holidays where cast(HDATE as date) BETWEEN '".$firstDate."' AND '".$lastDate."'";
	$resultq=query($query,$sqlq,$pa,$opt,$ms_db);
	
	if($num($resultq)) {
		while ($rowq = $fetch($resultq)){
			$result1[] =array('id'=>$rowq['HolidayID'],'title'=>$rowq['HDESC'],'start'=>date_format($rowq['HDATE'],'Y-m-d'),'allDay'=>true,'editable'=>false,'className'=>["green"],'rendering'=>'background','formattedDate'=>date('l, d M Y',strtotime(date_format($rowq['HDATE'],'Y-m-d'))));
		}
	}
	
	$givenArray = Array();
	$sqlq2="select WeeklyOff1,WeeklyOff2,WeeklyOff3,WeeklyOff4,WeeklyOff5 from ShiftPatternMast where ShiftPatternMastid=1";
	$resultq2=query($query,$sqlq2,$pa,$opt,$ms_db);
	
	if($num($resultq2)) {
		while ($rowq2 = $fetch($resultq2)){
			$givenArray=array($rowq2['WeeklyOff1'],$rowq2['WeeklyOff2'],$rowq2['WeeklyOff3'],$rowq2['WeeklyOff4'],$rowq2['WeeklyOff5']);
		}
	}
	//$givenArray=array('7','6,7','6,7','7','7');
	$finalRecords = Array();
	$cYear = date("Y");
	
	function getSundays($y,$m,$dayNo){ 
	    $date = "$y-$m-01";
	    $first_day = date('N',strtotime($date));
	    $first_day = $dayNo - $first_day + 1;
	    $last_day =  date('t',strtotime($date));
	    $days = array();
	    for($i=$first_day; $i<=$last_day; $i=$i+7 ){
	        if($i>0){
	        	$days[] = $i;
	    	}
	    }
	    return  $days;
	}

	
	$yearRecords = Array();
	
	for($i=$start[1];$i<=$end[1];$i++){
		for($j=1;$j<=7;$j++){
			$days = getSundays($cYear,$i,$j);
			$yearRecords[$j] = $days;
		}

		for($k=0; $k<count($givenArray);$k++){
			$givenDaysPerWeek = explode(',',$givenArray[$k]);
			for($q=0;$q<count($givenDaysPerWeek);$q++){
				for($h=0;$h<count($yearRecords);$h++){
					try{
						@$d = $yearRecords[(int)$givenDaysPerWeek[$q]][$k];
						$date = new DateTime($cYear.'-'.$i.'-'.$d.' 00:00:00');	
						$finalRecords[] = date_format($date,'Y-m-d');
						goto end3;
					}catch(Exception $e){
						echo '';
					}
					
				}
				end3:
			}
		}
		$yearRecords[]=''; 
	}
	
	$result = array();
	for($w=0;$w<count($result1);$w++){
		if(in_array($result1[$w]['start'],$finalRecords,true)){

		}else{
			$result[] = $result1[$w];
		}
	}



	/*--------------------attendance status start---------------------*/

	//This emp_code getting from session when session recreate  
$emp_code = '100010'; 

//getting all team member emp_code 
$sqlq3 ="SELECT emp_code FROM HrdTran WHERE Mngr_Code = (SELECT Mngr_Code FROM HrdTran	WHERE Emp_Code='".$emp_code."' GROUP BY Mngr_Code) GROUP BY EMP_CODE";

$resultq3=query($query,$sqlq3,$pa,$opt,$ms_db);
$EmpTeam = array();
if($num($resultq3)) {
	while ($rowq3 = $fetch($resultq3)){
		$EmpTeam[] = $rowq3['emp_code'];
	}
}


$sqlq4="select top 1 ShiftMastId,ShiftPatternMastId from AttRoster where Emp_Code='".$emp_code."' and AttStatus='1'";
$resultq4=query($query,$sqlq4,$pa,$opt,$ms_db);
if($num($resultq4)) {
	while ($rowq4 = $fetch($resultq4)){
		$ShiftMastId = $rowq4['ShiftMastId'];
		$ShiftPatternMastId = $rowq4['ShiftPatternMastId'];
	}
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



$sqlq5="select ShiftMastId,Shift_Code,Shift_Name,ShiftStart_SwTime,ShiftEnd_SwTime,Shift_MFrom,
				Shift_MTo,Shift_From,Shift_To,LateAllow,LateAllowCycle,LateAllowGPrd,ErlyAllow,
				ErlyAllowCycle,ErlyAllowGPrd,MHrsFul,MHrsHalf from ShiftMast where ShiftMastId='".$ShiftMastId."'";
$resultq5=query($query,$sqlq5,$pa,$opt,$ms_db);

if($num($resultq5)) {
	while ($rowq5 = $fetch($resultq5)){
		$Shift_Code  		= $rowq5['Shift_Code'];
		$Shift_Name  		= $rowq5['Shift_Name'];
		$ShiftStart_SwTime 	= date_format($rowq5['ShiftStart_SwTime'],'H:i:s');
		$ShiftEnd_SwTime 	= date_format($rowq5['ShiftEnd_SwTime'],'H:i:s');
		$Shift_From  		= date_format($rowq5['Shift_From'],'H:i:s');
		$Shift_Fromap  		= date_format($rowq5['Shift_From'],'H:i a');
		$Shift_To    		= date_format($rowq5['Shift_To'],'H:i:s');
		$Shift_Toap    		= date_format($rowq5['Shift_To'],'H:i a');
		$Shift_MFrom 		= date_format($rowq5['Shift_MFrom'],'H:i:s');
		$Shift_MTo   		= date_format($rowq5['Shift_MTo'],'H:i:s');
		$LateAllow			= $rowq5['LateAllow'];							//in minutes
		$LateAllowCycle 	= $rowq5['LateAllowCycle'];
		$LateAllowGPrd 		= $rowq5['LateAllowGPrd'];						//in minutes
		$ErlyAllow			= $rowq5['ErlyAllow'];							//in minutes
		$ErlyAllowCycle 	= $rowq5['ErlyAllowCycle'];
		$ErlyAllowGPrd		= $rowq5['ErlyAllowGPrd'];					//in minutes
		$MHrsFul			= getMinutes(date_format($rowq5['MHrsFul'],'H:i:s'),'00:00:00');
		$MHrsHalf			= getMinutes(date_format($rowq5['MHrsHalf'],'H:i:s'),'00:00:00');
	}
}





$lates=0;
function getEmpAttStatus($Shift_Code,$Shift_Name,$ShiftStart_SwTime,$ShiftEnd_SwTime,$Shift_From,$Shift_Fromap,$Shift_To,$Shift_Toap,$Shift_MFrom,$Shift_MTo,$LateAllow,$LateAllowCycle,$LateAllowGPrd,$ErlyAllow,$ErlyAllowCycle,$ErlyAllowGPrd,$MHrsFul,$MHrsHalf,$emp_code,$cDate){
	global $query,$pa,$opt,$ms_db,$num,$fetch,$lates;
	$InOutTime = array();
	$resultArray = array();
	
	$resultArray['shiftName'] = $Shift_Name;
	$resultArray['shiftInOutTime'] = $Shift_Fromap.' - '.$Shift_Toap;
	$var = explode('-', $cDate);
	
	$mm = sprintf("%02d", $var[1]);
	$dd = sprintf("%02d", $var[2]);
	$date = "{$var[0]}-{$mm}-{$dd}";
	
	$d = date('l, d M Y',strtotime($date));
	$InTime ='';
	$OutTime ='';
	$presetShortStatus 	= "";
	$presetStatus  		= "";
	$startTime ='';
	$endTime='';
	$TimeSpan='';
	$class ='';



	$sqlq6="SELECT cast(PunchDate as time ) time
			FROM ATTENDANCE 
			WHERE  EMP_CODE ='".$emp_code."' and cast(PunchDate as date) = '".$cDate."' 
					AND  cast(PunchDate as time) IN (
					SELECT TOP 1 cast(MIN(PunchDate) as time) time
					FROM ATTENDANCE 
					WHERE  EMP_CODE ='".$emp_code."' AND cast(PunchDate as date) = '".$cDate."' 
					UNION ALL
					SELECT TOP 1 cast(MAX(PunchDate) as time) time
					FROM ATTENDANCE 
					WHERE  EMP_CODE ='".$emp_code."' AND cast(PunchDate as date) = '".$cDate."' 
					) order by PunchDate asc";
	


	$resultq6=query($query,$sqlq6,$pa,$opt,$ms_db);
	if($num($resultq6)) {
		while ($rowq6 = $fetch($resultq6)){
			$InOutTime[] = date_format($rowq6['time'],'H:i:s');
			//$ShiftPatternMastId = $rowq['ShiftPatternMast'];
		}
	}

	if(count($InOutTime)==2){
		$startTime 	= $InOutTime[0];
		$endTime 	= $InOutTime[1];

		
		
		if(strtotime($ShiftStart_SwTime)<=strtotime($startTime) and strtotime($startTime) <=strtotime($Shift_MFrom)){
			$InTime = $Shift_MFrom;
			$OutTime= $endTime;

			$presetShortStatus 	= "P";
			$presetStatus  		= "Present";
			$class =['green2'];
			$TimeSpan = getTimeSpan($OutTime,$InTime);
			
		}else if(strtotime($startTime) >strtotime($Shift_MFrom) and strtotime($startTime) <=strtotime(getHoursMiutes($LateAllowGPrd),strtotime($Shift_From)) ){
			$InTime = $startTime;
			$OutTime= $endTime;
			
			if(getMinutes($OutTime,$InTime)>=$MHrsFul){
				$presetShortStatus 	= "P";
				$presetStatus  		= "Present";
				$class =['green2'];
			}else if(getMinutes($OutTime,$InTime)<$MHrsFul and getMinutes($OutTime,$InTime) >= $MHrsHalf){
				$presetShortStatus 	= "H";
				$presetStatus  		= "Half Day";
				$class =['yellow'];
			}
			$TimeSpan = getTimeSpan($OutTime,$InTime);
			
		}else if(strtotime($startTime) > strtotime(getHoursMiutes($LateAllowGPrd),strtotime($Shift_From)) and strtotime($startTime) <=strtotime(getHoursMiutes($LateAllowGPrd),strtotime(getHoursMiutes($LateAllow),strtotime($Shift_From)))){
			$lates=$lates+1;
			$InTime = $startTime;
			$OutTime= $endTime;
			if($lates>3){
				if(getMinutes($OutTime,$InTime)>=$MHrsFul){
					$presetShortStatus 	= "P";
					$presetStatus  		= "Present";
					$class =['green2'];
				}else if(getMinutes($OutTime,$InTime)<$MHrsFul and getMinutes($OutTime,$InTime) >= $MHrsHalf){
					$presetShortStatus 	= "H";
					$presetStatus  		= "Half Day";
					$class =['yellow'];
				}
				$TimeSpan = getTimeSpan($OutTime,$InTime);
			}else{
				if(getMinutes($OutTime,$InTime)>=$MHrsFul){
					$presetShortStatus 	= "P";
					$presetStatus  		= "Present";
					$class =['green2'];
				}else if(getMinutes($OutTime,$InTime)<$MHrsFul and getMinutes($OutTime,$InTime) >= $MHrsHalf){
					$presetShortStatus 	= "H";
					$presetStatus  		= "Half Day";
					$class =['yellow'];
				}
				$TimeSpan = getTimeSpan($OutTime,$InTime);
			}
		}else if(strtotime($startTime) > strtotime(getHoursMiutes($LateAllowGPrd),strtotime(getHoursMiutes($LateAllow),strtotime($Shift_From)))){
			$InTime = $startTime;
			$OutTime= $endTime;
			if(getMinutes($OutTime,$InTime)<$MHrsFul and getMinutes($OutTime,$InTime) >= $MHrsHalf){
				$presetShortStatus 	= "H";
				$presetStatus  		= "Half Day";
				$class =['yellow'];
			}else{
				$presetShortStatus 	= "A";
				$presetStatus  		= "Absent";
				$class =['red'];
			}
			$TimeSpan = getTimeSpan($OutTime,$InTime);
		}

		

	}else if(count($InOutTime)==1){
		$InTime 	= $InOutTime[0];
		$OutTime  	= $InOutTime[0];
		$presetShortStatus 	= "A";
		$presetStatus  		= "Absent";
		$class =['red'];
		$TimeSpan = getTimeSpan($OutTime,$InTime);

	}else{
		$presetShortStatus 	= "A";
		$presetStatus  		= "Absent";
		$class =['red'];
	}


	$resultArray['lates']				= $lates;
	$resultArray['formattedDate']		= $d;
	$resultArray['date']			    = $date;
	$resultArray['startTime']			= $InTime;
	$resultArray['endTime']				= $OutTime;
	$resultArray['presetShortStatus'] 	= $presetShortStatus;
	$resultArray['presetStatus'] 		= $presetStatus;
	$resultArray['timeSpan']			= $TimeSpan;
	$resultArray['title'] 				= $presetStatus;
		
	$resultArray['start']			    = $date;
	$resultArray['allDay']			    = TRUE;
	$resultArray['className']			= $class;
	$resultArray['editable']			= FALSE;
	$resultArray['rendering'] 			= 'background';
	
	return $resultArray;
	
}





	/*--------------------attendance status end ----------------------*/

	date_default_timezone_set("Asia/Kolkata");

	/* Set the date */
	$date = strtotime(date("Y-m-d"));

	$day = date('d', $date);
	$month = date('m', $date);
	$year = date('Y', $date);
	for($j=$start[1];$j<=$end[1];$j++){

		$firstDay = mktime(0,0,0,$j, 1, $year);
		$title = strftime('%B', $firstDay);
		$dayOfWeek = date('D', $firstDay);
		$firstDayName = date('l',$firstDay);

		$daysInMonth = cal_days_in_month(0, $j, $year);
		$blank = date('w', strtotime("{$year}-{$month}-01"));
		/* Get the name of the week days */
		$timestamp = strtotime('next '.$firstDayName);
		$weekDays = array();
		for ($i = 0; $i < $daysInMonth; $i++) {
		  	$weekDays[] = strftime('%a', $timestamp);
			$timestamp = strtotime('+1 day', $timestamp);
		}
		for($p = 1; $p <= $daysInMonth; $p++){
				$cDate = "{$year}-{$j}-{$p}";

				$attStatus = getEmpAttStatus($Shift_Code,$Shift_Name,$ShiftStart_SwTime,$ShiftEnd_SwTime,$Shift_From,$Shift_Fromap,$Shift_To,$Shift_Toap,$Shift_MFrom,$Shift_MTo,$LateAllow,$LateAllowCycle,$LateAllowGPrd,$ErlyAllow,$ErlyAllowCycle,$ErlyAllowGPrd,$MHrsFul,$MHrsHalf,$emp_code,$cDate);
				
				$result2[] = $attStatus;
			} 
			
	 }
	$temp = array(); 
	for($pip=0;$pip<count($result1);$pip++){
		$temp[] = $result1[$pip]['start'];
	}
	for($ww=0;$ww<count($result2);$ww++){
		if(in_array($result2[$ww]['start'],$finalRecords,true)){
			
			
		}else{
			if(in_array($result2[$ww]['start'],$temp,true)){
			}else{
				$result[] = $result2[$ww];
			}
		}
	}

	for($ff=0;$ff<count($finalRecords);$ff++){
		$result[] =array('id'=>'','title'=>'','start'=>$finalRecords[$ff],'allDay'=>true,'editable'=>false,'className'=>["green"]);
	}
	
	echo json_encode($result);
}







/*----------------new code end here ---------------------*/

?>
