<?php 
function getWeeklyOff($month,$year,$emp_code){
	global $query;
	global $pa;
	global $opt;
	global $ms_db;
	global $num;
	global $fetch;
	$daysInMonth = cal_days_in_month(0, $month, $year);
	$firstDate= $year.'-'.$month.'-01';
	$lastDate = $year.'-'.$month.'-'.$daysInMonth;

	$result= array();
	$sqlq="SELECT ShiftPatternMastID,cast(ATT_FROM as date) attfrom,cast(ATT_TO as date) attto 
			FROM AttRoster 
			WHERE EMP_CODE='".$emp_code."' 
			AND ((DATEPART(MM, ATT_FROM) <='".$month."'AND DATEPART(YY, ATT_FROM)='".$year."') 
			AND   (DATEPART(MM, ATT_TO) >= '".$month."' AND DATEPART(YY, ATT_FROM)='".$year."'))
			ORDER BY ATT_FROM ASC";

	$resultq=query($query,$sqlq,$pa,$opt,$ms_db);
	if($resultq){
		$tempArray2 = $num($resultq);
	}else{
		$tempArray2=-1;
	}
	if($tempArray2>0) {
		while ($rowq = $fetch($resultq)){
			$f = explode('-',$rowq['attfrom']);
			
			$t = explode('-',$rowq['attto']);


			$result[] =array('patternId'=>$rowq['ShiftPatternMastID'],'from'=>$f[2],'to'=>$t[2]);
		}

	
	}else{
		$sqlq1="SELECT TOP 1 ShiftPatternMastID FROM AttRoster WHERE EMP_CODE='".$emp_code."' AND automatic_period='1'
			ORDER BY UPDATED_ON DESC";
		
		$resultq1=query($query,$sqlq1,$pa,$opt,$ms_db);
		
		if($resultq1){
			$tempArray3 = $num($resultq1);
		}else{
			$tempArray3=-1;
		}

		if($tempArray3>0) {
			while ($rowq1 = $fetch($resultq1)){
				$result[] =array('patternId'=>$rowq1['ShiftPatternMastID'],'from'=>01,'to'=>$daysInMonth);
			}
		}
	}


	$tempArray = array();
	$tempFromTo = array();
	for($i=0;$i<count($result); $i++){
		$tempArray[] = $result[$i]['patternId'];
		$tempFromTo[] =array($result[$i]['from'],$result[$i]['to']);
	}

	$ShiftPatternMastids = implode(', ', $tempArray);
	
	$weeklyOffArrayForMonth = Array();
	$sqlq2 = "SELECT WeeklyOff1, WeeklyOff2, WeeklyOff3, WeeklyOff4, WeeklyOff5 FROM ShiftPatternMast WHERE ShiftPatternMastid in (".$ShiftPatternMastids.")";
	$resultq2=query($query,$sqlq2,$pa,$opt,$ms_db);
	if($resultq2){
		$tempArray1 = $num($resultq2);
	}else{
		$tempArray1 =-1;
	}
	if($tempArray1>0) {
		while ($rowq2 = $fetch($resultq2)){
			$givenArray[] = array($rowq2['WeeklyOff1'], $rowq2['WeeklyOff2'], $rowq2['WeeklyOff3'], $rowq2['WeeklyOff4'], $rowq2['WeeklyOff5']);
		}
	}

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


	$monthlyRecord = Array();
	$finalRecords = Array();
	for($j=1;$j<=7;$j++){
		$days = getSundays($year,$month,$j);
		$monthlyRecord[$j] = $days;
	}
	


	for($p=0;$p<count($tempFromTo);$p++){
		$r = (int)$tempFromTo[$p][0];
		$k = 0;
		
		if($r<=$tempFromTo[$p][1]){
			while($k<count($givenArray[$p])){
				$givenDaysPerWeek = explode(',',$givenArray[$p][$k]);
				for($q=0;$q<count($givenDaysPerWeek);$q++){
					for($h=0;$h<count($monthlyRecord);$h++){
						try{
							@$d = $monthlyRecord[(int)$givenDaysPerWeek[$q]][$k];
							if($d >= $tempFromTo[$p][0] && $d<=$tempFromTo[$p][1]){
								$dateff1 = "{$year}-{$month}-".sprintf("%02d", $d);
								$finalRecords[] =array('start'=>$dateff1);
								goto end3;
							}
						}catch(Exception $e){
						}
						
					}
					end3:
				}$k++;
			}
		}
	}
	return $finalRecords;
}
?>