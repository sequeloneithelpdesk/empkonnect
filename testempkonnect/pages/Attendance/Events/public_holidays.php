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
			$result1[] =array('title'=>$rowq['HDESC'],'start'=>$rowq['HDATE']);
		}
		return $result1;
	}
	

	//return json_encode($result1);
}

function getBirthDates($month,$year){
	global $query;
	global $pa;
	global $opt;
	global $ms_db;
	global $num;
	global $fetch;
	$result2=array();
	$sqlq2 ="SELECT '".$year."'+'-'+RIGHT('00'+CONVERT(NVARCHAR(2),cast(DATEPART(MONTH, DOB) as VARCHAR(2))),2)+'-'+RIGHT('00'+CONVERT(NVARCHAR(2),cast(DATEPART(DAY, DOB) as VARCHAR(2))),2) as cDOB,
			EMP_NAME,OEMailID,isnull(DSG_NAME,'') DSG_NAME,isnull(WLOC_NAME,'') WLOC_NAME,isnull(LOC_NAME,'') LOC_NAME 
			FROM HrdMastQry where DOB != '' 
			AND RIGHT('00'+CONVERT(NVARCHAR(2),cast(DATEPART(MONTH, DOB) as VARCHAR(2))),2)='".$month."'  
			ORDER BY cDOB ASC";
	$resultq2=query($query,$sqlq2,$pa,$opt,$ms_db);
	if($resultq2){
		$tempArray5=$num($resultq2);
	}else{
		$tempArray5=-1;
	}
	if($tempArray5>0) {
		while ($rowq2 = $fetch($resultq2)){
			$result2[] =array('start'=>$rowq2['cDOB'],'bemp_record'=>array('bemp_name'=>$rowq2['EMP_NAME'],'bemp_email'=>$rowq2['OEMailID'],'bemp_dsg'=>$rowq2['DSG_NAME'],'bemp_wloc'=>$rowq2['WLOC_NAME'],'bemp_loc'=>$rowq2['LOC_NAME']));
		}

		//var_dump($result2);die;
		return $result2;
	}

}

function getAnniDates($month,$year){
	global $query,$pa,$opt,$ms_db,$num,$fetch;
	$result3=array();
	$sqlq3 ="SELECT '".$year."'+'-'+RIGHT('00'+CONVERT(NVARCHAR(2),cast(DATEPART(MONTH, Anniversary) as VARCHAR(2))),2)+'-'+RIGHT('00'+CONVERT(NVARCHAR(2),cast(DATEPART(DAY, Anniversary) as VARCHAR(2))),2) as cAnniversary,
			EMP_NAME,OEMailID,isnull(DSG_NAME,'') DSG_NAME,isnull(WLOC_NAME,'') WLOC_NAME,isnull(LOC_NAME,'') LOC_NAME 
			FROM HrdMastQry where Anniversary != '' 
			AND RIGHT('00'+CONVERT(NVARCHAR(2),cast(DATEPART(MONTH, Anniversary) as VARCHAR(2))),2)='".$month."'  
			ORDER BY cAnniversary ASC";
	$resultq3=query($query,$sqlq3,$pa,$opt,$ms_db);
	if($resultq3){
		$tempArray53=$num($resultq3);
	}else{
		$tempArray53=-1;
	}
	if($tempArray53>0) {
		while ($rowq3 = $fetch($resultq3)){
			$result3[] =array('start'=>$rowq3['cAnniversary'],'bemp_record'=>array('bemp_name'=>$rowq3['EMP_NAME'],'bemp_email'=>$rowq3['OEMailID'],'bemp_dsg'=>$rowq3['DSG_NAME'],'bemp_wloc'=>$rowq3['WLOC_NAME'],'bemp_loc'=>$rowq3['LOC_NAME']));
		}
		return $result3;
	}
	
}

?>