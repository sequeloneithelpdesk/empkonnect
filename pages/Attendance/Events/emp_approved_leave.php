<?php 

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
	$sqlq="SELECT cast(LvFrom as date) as startDate,cast(LvTo as date) as endDate,status,reason,LvType FROM leave WHERE leaveID IN (SELECT MAX(leaveID) FROM leave GROUP BY LevKey) AND (LvFROM BETWEEN '".$firstDate."' AND '".$lastDate."' OR LvTO BETWEEN '".$firstDate."' AND '".$lastDate."') AND status  NOT IN( '4' , '3')  and createdby='".$emp_code."'
ORDER BY LvFrom";
	$resultq=query($query,$sqlq,$pa,$opt,$ms_db);
	
	if($resultq){
		$tempArray4=$num($resultq);
	}else{
		$tempArray4=-1;
	}
	$varArray = array();
	if($tempArray4>0) {
		while ($rowq = $fetch($resultq)){

			$s = $rowq['startDate'];
			$e = $rowq['endDate'];

			if($rowq['status']==1){
				$status='Pending';
			}else if($rowq['status']==2){
				$status='Approved';
			}else if($rowq['status']==3){
				$status='Rejected';
			}else if($rowq['status']==4){
				$status='Cancelled';
			}else if($rowq['status']==5){
				$status='Cancelled Pending';
			}
			$start = explode('-', $s);
			$end = explode('-', $e);

			if($start[1]<$month){
				$startFrom = 1;
			}else{
				$startFrom = $start[2];
			}

			if($end[1]>$month){
				$endTo = $daysInMonth;
			}else{
				$endTo = $end[2];
			}
			

		

			for($i = $startFrom; $i<=$endTo; $i++){
				$varArray[] = array('date'=>$year.'-'.$month.'-'.sprintf("%02d", $i),'status'=>$status,'reason'=>$rowq['reason'],'LvType'=>$rowq['LvType']);
			}
		}
		//return $result1;
	}

	for($j=0; $j<count($varArray); $j++){
		if($varArray[$j]['status']=='Approved'){
			$result1[] = array('type'=>'leave','title'=>'Leave','reason'=>$varArray[$j]['reason'],'status'=>$varArray[$j]['status'],'start'=>$varArray[$j]['date'],'className'=>array("blue_over circle-legend"),'presetShortStatus'=>'P','lvType'=>$varArray[$j]['LvType']);
		}else if($varArray[$j]['status']=='Pending'){
			$result1[] = array('type'=>'leave','title'=>'Absent','reason'=>$varArray[$j]['reason'],'status'=>$varArray[$j]['status'],'start'=>$varArray[$j]['date'],'className'=>array("red circle-legend"),'presetShortStatus'=>'A','lvType'=>$varArray[$j]['LvType']);
		}else{
			$result1[] = array('type'=>'leave','title'=>'Leave','reason'=>$varArray[$j]['reason'],'status'=>'Absent','start'=>$varArray[$j]['date'],'className'=>array("red circle-legend"),'presetShortStatus'=>'A','lvType'=>$varArray[$j]['LvType']);
		}
	}


	return $result1;
	
	//return json_encode($result1);
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
	$sqlq1="SELECT cast(date_from as date) as date_from,cast(date_to as date) as date_to,intime,outtime,action_status,notMarkingReason,remarks FROM markpastattendance WHERE markPastId IN (SELECT MAX(markPastId) fROM markpastattendance GROUP BY AttnKey) AND (date_FROM BETWEEN '".$firstDate."' AND '".$lastDate."' OR date_TO BETWEEN '".$firstDate."' AND '".$lastDate."') AND action_status  NOT IN( '4' , '3')  and createdby='".$emp_code."' ORDER BY date_from";


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
			$end = explode('-', $e);
			
			if($start[1]<$month){
				$startFrom = 1;
			}else{
				$startFrom = $start[2];
			}

			if($end[1]>$month){
				$endTo = $daysInMonth;
			}else{
				$endTo = $end[2];
			}
			
			if($rowq1['action_status']==1){
				$status='Pending';
			}else if($rowq1['action_status']==2){
				$status='Approved';
			}else if($rowq1['action_status']==3){
				$status='Rejected';
			}else if($rowq1['action_status']==4){
				$status='Cancelled';
			}else if($rowq1['action_status']==5){
				$status='Cancelled Pending';
			}

			for($i = $startFrom; $i<=$endTo; $i++){
				$varArray[] = array('date'=>$year.'-'.$month.'-'.sprintf("%02d", $i),'status'=>$status,'startTime'=>$rowq1['intime'],'endTime'=>$rowq1['outtime'],'reason'=>$rowq1['remarks']);
			}

		}



		for($j=0; $j<count($varArray); $j++){
			if($varArray[$j]['status']=='Approved'){
				$result[] = array('type'=>'attRegularised','title'=>'Attendance Regularised','reason'=>$varArray[$j]['reason'],'status'=>$varArray[$j]['status'],'start'=>$varArray[$j]['date'],'className'=>array("pink_over circle-legend"),'presetShortStatus'=>'P','startTime'=>$varArray[$j]['startTime'],'endTime'=>$varArray[$j]['endTime']);
			}else if($varArray[$j]['status']=='Pending'){
				$result[] = array('type'=>'attRegularised','title'=>'Absent','reason'=>$varArray[$j]['reason'],'status'=>$varArray[$j]['status'],'start'=>$varArray[$j]['date'],'className'=>array("red circle-legend"),'presetShortStatus'=>'A','startTime'=>$varArray[$j]['startTime'],'endTime'=>$varArray[$j]['endTime']);
			}else{
				$result[] = array('type'=>'attRegularised','title'=>'Attendance Regularised','reason'=>$varArray[$j]['reason'],'status'=>'Absent','start'=>$varArray[$j]['date'],'className'=>array("red circle-legend"),'presetShortStatus'=>'A','startTime'=>$varArray[$j]['startTime'],'endTime'=>$varArray[$j]['endTime']);
			}
		}
	}

	//var_dump($result);die;
	return $result;

} 



function getODRequest($month,$year,$emp_code){
	
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
	$sqlq1="SELECT cast(date_from as date) as date_from,cast(date_to as date) as date_to,intime,outtime,action_status,reason fROM outOnWorkRequest WHERE outWorkId IN (SELECT MAX(outWorkId) fROM outOnWorkRequest GROUP BY oDKey) AND (date_FROM BETWEEN '".$firstDate."' AND '".$lastDate."' OR date_TO BETWEEN '".$firstDate."' AND '".$lastDate."') and action_status NOT IN( '4' , '3') and createdby='".$emp_code."' ORDER BY date_from";


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
			
			$start = explode('-', $s);
			if($start[1]<$month){
				$startFrom = 1;
			}else{
				$startFrom = $start[2];
			}

			$end = explode('-', $e);
			if($end[1]>$month){
				$endTo = $daysInMonth;
			}else{
				$endTo = $end[2];
			}

			if($rowq1['action_status']==1){
				$status='Pending';
			}else if($rowq1['action_status']==2){
				$status='Approved';
			}else if($rowq1['action_status']==3){
				$status='Rejected';
			}else if($rowq1['action_status']==4){
				$status='Cancelled';
			}else if($rowq1['action_status']==5){
				$status='Cancelled Pending';
			}

		

			for($i = $startFrom; $i<=$endTo; $i++){
				$varArray[] = array('date'=>$year.'-'.$month.'-'.sprintf("%02d", $i),'status'=>$status,'startTime'=>$rowq1['intime'],'endTime'=>$rowq1['outtime'],'reason'=>$rowq1['reason']);
			}

		}
//echo '<pre>'; print_r($varArray); die;


		for($j=0; $j<count($varArray); $j++){
			if($varArray[$j]['status']=='Approved'){
				$result[] = array('type'=>'odrequest','title'=>'OD Request','reason'=>$varArray[$j]['reason'],'status'=>$varArray[$j]['status'],'start'=>$varArray[$j]['date'],'className'=>array("pink_over circle-legend"),'presetShortStatus'=>'P','startTime'=>$varArray[$j]['startTime'],'endTime'=>$varArray[$j]['endTime']);
			}else if($varArray[$j]['status']=='Pending'){
				$result[] = array('type'=>'odrequest','title'=>'Absent','reason'=>$varArray[$j]['reason'],'status'=>$varArray[$j]['status'],'start'=>$varArray[$j]['date'],'className'=>array("red circle-legend"),'presetShortStatus'=>'A','startTime'=>$varArray[$j]['startTime'],'endTime'=>$varArray[$j]['endTime']);
			}else{
				$result[] = array('type'=>'odrequest','title'=>'OD Request','reason'=>$varArray[$j]['reason'],'status'=>'Absent','start'=>$varArray[$j]['date'],'className'=>array("red circle-legend"),'presetShortStatus'=>'A','startTime'=>$varArray[$j]['startTime'],'endTime'=>$varArray[$j]['endTime']);
			}
		}
	}
	return $result;

} 
	

?>