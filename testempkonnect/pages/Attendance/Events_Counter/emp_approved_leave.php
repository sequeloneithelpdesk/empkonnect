<?php 

function getTimeSpan2($OutTime,$InTime){
	$givendata = round(abs(strtotime($OutTime) - strtotime($InTime)) / 60,2);
	$hours = intval($givendata/60);
	$minutes = $givendata - ($hours * 60);
	$hoursminutes = sprintf("%02d",$hours).":".sprintf("%02d",$minutes);
	return $hoursminutes;
}

function getLeaves($month,$year,$emp_code){
	global $query;
	global $pa;
	global $opt;
	global $ms_db;
	global $num;
	global $fetch;
	$daysInMonth = cal_days_in_month(0, $month, $year);
	$firstDate= $year.'-'.$month.'-01';
	$lastDate = $year.'-'.$month.'-'.$daysInMonth;

	$result1= array();
	$sqlq="select distinct cast(LvFrom as date) startDate,  cast(LvTo as date) endDate, LvType, LvDays,status from leave where CreatedBy='".$emp_code."' and cast(LvFrom as date) >= '".$firstDate."' and cast(LvTo as date) <= '".$lastDate."'";
	$resultq=query($query,$sqlq,$pa,$opt,$ms_db);
	
	if($resultq){
		$tempArray4=$num($resultq);
	}else{
		$tempArray4=-1;
	}
	$varArray = array();
	if($tempArray4>0) {
		$index=0;
		while ($rowq = $fetch($resultq)){
			
			$s = $rowq['startDate'];
			$e = $rowq['endDate'];
			$pl=0;
			$lwp=0;
			if($rowq['status']==1){
				$status='Pending';
			}else if($rowq['status']==2){
				$status='Approved';
				if(trim($rowq['LvType'])==4){
					$lwp=$rowq['LvDays'];
				}else{
					$pl=$rowq['LvDays'];	
				}
			}
			
			$start = explode('-', $s);
			$startFrom = $start[2];
			
			$end = explode('-', $e);
			$endTo = $end[2];

			for($i = $startFrom; $i<=$endTo; $i++){
				$varArray[] = array('date'=>$year.'-'.$month.'-'.sprintf("%02d", $i),'lvType'=>$rowq['LvType'],'status'=>$status,'pl'=>$index.'-'.$pl,'lwp'=>$index.'-'.$lwp);
			}
			$index++;
		}
	}

	for($j=0; $j<count($varArray); $j++){
		$result1[] =array('start'=>$varArray[$j]['date'],'lvType'=>$varArray[$j]['lvType'],'status'=>$varArray[$j]['status'],'pl'=>$varArray[$j]['pl'],'lwp'=>$varArray[$j]['lwp']);
	}
	return $result1;
}


function getAttendanceRegularised($month,$year,$emp_code){
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
	$sqlq1="SELECT cast(date_from as date) as date_from, cast(date_to as date) as date_to, convert(varchar(12),cast(inDate as date))+' '+CONVERT(VARCHAR(5),CONVERT(DATETIME,REPLACE(REPLACE(intime,':PM', 'PM'),':AM','AM'),0),108)+':00' as indatetime, convert(varchar(12),cast(outDate as date))+' '+CONVERT(VARCHAR(5),CONVERT(DATETIME,REPLACE(REPLACE(outtime,':PM', 'PM'),':AM','AM'),0),108)+':00' outdatetime, CreatedBy, CASE WHEN SUM(CONVERT(INT,(action_status)))%2=0 AND SUM(CONVERT(INT,(action_status))) <> 2 THEN 'Approved' Else 'Pending' End AS Action from markPastAttendance Where date_from >='".$firstDate."' and date_to <='".$lastDate."'  and CreatedBy='".$emp_code."' GROUP BY date_from, date_to, inDate, outDate, intime, outtime, notMarkingReason, remarks,CreatedBy ";

	$resultq1=query($query,$sqlq1,$pa,$opt,$ms_db);
	
	if($resultq1){
		$tempArray41=$num($resultq1);
	}else{
		$tempArray41=-1;
	}
	$varArray = Array();
	if($tempArray41>0) {
		while ($rowq1 = $fetch($resultq1)){
			$s = $rowq1['date_from'];
			$e = $rowq1['date_to'];
			$status =$rowq1['Action'];
			$start = explode('-', $s);
			$startFrom = $start[2];
			
			$end = explode('-', $e);
			$endTo = $end[2];
			
			$from = $rowq1['indatetime'];
			$to = $rowq1['outdatetime'];
			
			$timeSpan= getTimeSpan2($to,$from);
			for($i = $startFrom; $i<=$endTo; $i++){
				$varArray[] = array('date'=>$year.'-'.$month.'-'.sprintf("%02d", $i),'status'=>$status,'timeSpan'=>$timeSpan);
			}

		}
		
		for($j=0; $j<count($varArray); $j++){
			if($varArray[$j]['status']=='Pending'){
				$result[] = array('type'=>'attRegularised','status'=>$varArray[$j]['status'],'start'=>$varArray[$j]['date'],'timeSpan'=>'00:00');
			}else{
				$result[] = array('type'=>'attRegularised','status'=>$varArray[$j]['status'],'start'=>$varArray[$j]['date'],'timeSpan'=>$varArray[$j]['timeSpan']);
			}
		}
	}
	return $result;
} 
?>