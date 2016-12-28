<?php 

function getHolidays($month,$year){
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
	$sqlq="select cast(HDATE as date) HDATE,LOC_CODE,HCODE,HDESC,HolidayID,H_status  from holidays where cast(HDATE as date) BETWEEN '".$firstDate."' AND '".$lastDate."'";

	$resultq=query($query,$sqlq,$pa,$opt,$ms_db);
	
	if($resultq){
		$tempArray4=$num($resultq);
	}else{
		$tempArray4=-1;
	}
	if($tempArray4>0) {
		while ($rowq = $fetch($resultq)){
			$result1[] =array('start'=>$rowq['HDATE']);
		}
		return $result1;
	}
}


?>