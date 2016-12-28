<?php
//include('../../db_conn.php');
//include('../../configdata.php');
include ('leave_class.php');
$leave_class_obj=new leave_class();
include('../leaveCal.php');

session_start();
if (isset($_POST["code"]) && !empty($_POST["code"])) {
    $emp_code=$_POST["code"];   
}else{  
   $emp_code=$_SESSION['usercode'];
}
//$emp_code=$_SESSION['usercode'];
$typesql="select * from hrdmastqry a where emp_code='$emp_code'";
$typeresult=query($query, $typesql, $pa, $opt, $ms_db);
$rowtype=$fetch($typeresult);
$employeetype=strtolower($rowtype['GRD_NAME']);


$json = file_get_contents('../js/leave.json'); 
  $data = json_decode($json,true);

if (!key_exists($employeetype,$data)){
  	$employeetype='salaried';
	//echo'exist';
  }
  
  //print_r($data);
  //echo $employeetype;
  if($_GET['type']=="showleave"){
  $leave_b='';
  
  
// print_r($data['apprentice'][0]);
//echo"<table><tr><td>Leave type</td><td>Leave</td></tr>";
foreach ($data[$employeetype][0] as $key => $value) {
	# code...
	//$avail=3;
	 $sql4="Select REPLACE(CONVERT(VARCHAR(10),a.DOJ,102),'.','-') AS DOJ,REPLACE(CONVERT(VARCHAR(10),a.DOJ_WEF,102),'.','-') AS DOJ_WEF,REPLACE(CONVERT(VARCHAR(10),a.DOB,102),'.','-') AS DOB,a.MStatus,REPLACE(CONVERT(VARCHAR(10),a.DOM,102),'.','-') AS DOM,a.SEX from hrdmastqry a where emp_code='$emp_code'";
	 $result4=query($query, $sql4, $pa, $opt, $ms_db);
	 if($num($result4)==0){
		
		$DoL='';
		$DoJ='';
		$DOJ_WEF='';
		$status=1;

	}
	else{
    $row2=$fetch($result4);
    $status=$row2['MStatus'];
    if($status==2){
    	$DoL=$row2['DOM'];
    }
    else{
    	$DoL=$row2['DOB'];
    }
    $DoJ=$row2['DOJ'];
    $DOJ_WEF=$row2['DOJ_WEF'];

	}
if($key=='EL'){
		$keyval=1;
	}
	if($key=='CL'){
		$keyval=2;
	}
	if($key=='SL'){
		$keyval=3;
	}
	if($key=='SEL'){
		$keyval=8;
	}
	if($key=='ML'){
		$keyval=7;
	}
	if($key=='AL'){
		$keyval=9;
	}
	if($key=='SPL'){
		$keyval=10;
	}
	if($key=='OL'){
		$keyval=11;
	}
	if($key=='BTL'){
		if($status==2){
		$keyval=6;
	} else { $keyval=5; }
	}
	$sql2="select sum(a.LvDays) as LvDays from (SELECT LvDays ,Createdby,Levkey FROM leave where Createdby='$emp_code' and status='2' and LvType='$keyval' and YEAR(Trn_Date) = YEAR(getDate()) group by Levkey,Createdby,LvDays) a";
	
		$result2=query($query, $sql2, $pa, $opt, $ms_db);

		//$num($result4);
	
	if($num($result2)==0){
		$avail=0;

	}
	else{
		$row4=$fetch($result2);
    $avail=$row4['LvDays'];

	}

	if($value['rules']['accumulation']==0){
		$opening=0;
	}
	else{
		$opening=0;
	}
	if($value['name']=='BTL'){
		if($status==2){
    	$Leave_Name='Anniversary Leave';
    }
    else{
    	$Leave_Name='Birthday Leave';
    }
	}
	else{
		$Leave_Name=$value['name'];
	}


	$totall_day=getCL_SL($key,$value['day_limit'],$opening,$avail,$value['rules']['accumulation'],$DoL,$DoJ,$DOJ_WEF);
	$accur=($totall_day+$avail)-$opening;
	$leave_b.="<tr><td>".$Leave_Name."</td><td>";
	$leave_b.=$opening;  
	$leave_b.="</td><td>". $accur ."</td><td>".$avail."</td><td>".$totall_day."</td><td></td><td>".$totall_day."</td></tr>";
		
}

echo $leave_b;
  //print_r($data['Salaried']);
}

elseif($_GET['type']=="showteamleave"){
  $leave_b='';
  //$code=$_POST['code'];
  $code='11193';
  $type1=$_POST['type1'];
  $start=$_POST['start'];
  $end=$_POST['end'];
 // echo $start.$end;
 // print_r($data[$employeetype][0]);
//echo"<table><tr><td>Leave type</td><td>Leave</td></tr>";
  
foreach ($data[$employeetype][0] as $key => $value) {
	# code...
	//$avail=3;
	$sql4="Select REPLACE(CONVERT(VARCHAR(10),a.DOJ,102),'.','-') AS DOJ,REPLACE(CONVERT(VARCHAR(10),a.DOJ_WEF,102),'.','-') AS DOJ_WEF,REPLACE(CONVERT(VARCHAR(10),a.DOB,102),'.','-') AS DOB,a.MStatus,REPLACE(CONVERT(VARCHAR(10),a.DOM,102),'.','-') AS DOM,a.SEX from hrdmastqry a where emp_code='$emp_code'";
	 $result4=query($query, $sql4, $pa, $opt, $ms_db);
	 if($num($result4)==0){
		
		$DoL='';
		$DoJ='';
		$DOJ_WEF='';
		$status=1;

	}
	else{
    $row2=$fetch($result4);
    $status=$row2['MStatus'];
    if($status==2){
    	$DoL=$row2['DOM'];
    }
    else{
    	$DoL=$row2['DOB'];
    }
    $DoJ=$row2['DOJ'];
    $DOJ_WEF=$row2['DOJ_WEF'];

	}
if($key=='EL'){
		$keyval=1;
	}
	if($key=='CL'){
		$keyval=2;
	}
	if($key=='SL'){
		$keyval=3;
	}
	if($key=='SEL'){
		$keyval=8;
	}
	if($key=='ML'){
		$keyval=7;
	}
	if($key=='AL'){
		$keyval=9;
	}
	if($key=='SPL'){
		$keyval=10;
	}
	if($key=='OL'){
		$keyval=11;
	}
	if($key=='BTL'){
		if($status==2){
		$keyval=6;
	} else { $keyval=5; }
	}
	$sql2="select sum(a.LvDays) as LvDays from (SELECT LvDays ,Createdby,Levkey FROM leave where Createdby='$emp_code' and status='2' and LvType='$keyval' and YEAR(Trn_Date) = YEAR(getDate()) group by Levkey,Createdby,LvDays) a";
	
		$result2=query($query, $sql2, $pa, $opt, $ms_db);

		//$num($result4);
	
	if($num($result2)==0){
		$avail=0;

	}
	else{
		$row4=$fetch($result2);
    $avail=$row4['LvDays'];

	}

	if($value['rules']['accumulation']==0){
		$opening=0;
	}
	else{
		$opening=0;
	}
	if($value['name']=='BTL'){
		if($status==2){
    	$Leave_Name='Anniversary Leave';
    }
    else{
    	$Leave_Name='Birthday Leave';
    }
	}
	else{
		$Leave_Name=$value['name'];
	}

if($type1=='all'){
	//echo "1";
	$totall_day=getCL_SL($key,$value['day_limit'],$opening,$avail,$value['rules']['accumulation'],$DoL,$DoJ,$DOJ_WEF);
$accur=($totall_day+$avail)-$opening;
$leave_b.="<tr><td>".$Leave_Name."</td><td>";
		$leave_b.=$opening;
$leave_b.="</td><td>".$accur."</td><td>".$avail."</td><td>".$totall_day."</td><td></td><td>".$totall_day."</td></tr>";
}
elseif ($key==$type1) {
		# code...
	echo "a".$key.$type1."sa";
	$totall_day=getCL_SL($key,$value['day_limit'],$opening,$avail,$value['rules']['accumulation'],$DoL,$DoJ,$DOJ_WEF);
$accur=($totall_day+$avail)-$opening;
$leave_b.="<tr><td>".$Leave_Name."</td><td>";
		$leave_b.=$opening;
$leave_b.="</td><td>".$accur."</td><td>".$avail."</td><td>".$totall_day."</td><td></td><td>".$totall_day."</td></tr>";

	}
	else{

	}	
}

echo$leave_b;
  //print_r($data['Salaried']);
}


elseif($_GET['type']=="showteam"){

$sql="Select EMP_NAME,Emp_Code from hrdmastqry where MNGR_CODE='$emp_code' or EMP_CODE='$emp_code'";
	$result=query($query, $sql, $pa, $opt, $ms_db);
$list='';
$list.="<select id='L_team' class='form-control' onchange='Leave.leave_type()'>";
	while ($row=$fetch($result)) {
		# code...
		$list.="<option value='".$row[1]."'" ;
		if($row[1]==$emp_code){ 
			$list.="selected";
			 }
			 $list.=">".$row[0]."(".$row[1].")</option>";

	}
	$list.="</select >";
	echo $list;

}

elseif($_GET['type']=="showtype"){
$code=$_POST['code'];

$list='';

$list.="<select id='T_team' class='form-control'><option value='all' selected>All</option>";
foreach ($data[$employeetype][0] as $key => $value) {

$sql4="Select a.DOJ,a.DOJ_WEF,a.DOB,a.MStatus,a.DOM,a.SEX from hrdmastqry a  where a.Emp_Code='$code'";
	$result4=query($query, $sql4, $pa, $opt, $ms_db);
	if($num($result4)==0){
		
$status=0;
	}
	else{
    $row2=$fetch($result4);
    
    $status=$row2['MStatus'];
    
	}
	if($value['name']=='BTL'){
		if($status==2){
    	$Leave_Name='Anniversary Leave';
    }
    else{
    	$Leave_Name='Birthday Leave';
    }
	}
	else{
		$Leave_Name=$value['name'];
	}
$list.="<option value='".$key."'>".$Leave_Name."</option>";

}
$list.="</select >";
	echo $list;

}
elseif($_GET['type']=="showtran"){
$code=$_POST['code'];
  $type1=$_POST['type1'];
  $start=$_POST['start'];
  $end=$_POST['end'];
  //echo $code."  ";
$total_days1=array();
$accur1=array();
$i=0;
			foreach ($data[$employeetype][0] as $key => $value) {
$sql4="Select REPLACE(CONVERT(VARCHAR(10),a.DOJ,102),'.','-') AS DOJ,REPLACE(CONVERT(VARCHAR(10),a.DOJ_WEF,102),'.','-') AS DOJ_WEF,REPLACE(CONVERT(VARCHAR(10),a.DOB,102),'.','-') AS DOB,a.MStatus,REPLACE(CONVERT(VARCHAR(10),a.DOM,102),'.','-') AS DOM,a.SEX from hrdmastqry a where emp_code='$code'";
//echo $sql4;
	 $result4=query($query, $sql4, $pa, $opt, $ms_db);
	 if($num($result4)==0){
		
		$DoL='';
		$DoJ='';
		$DOJ_WEF='';
		$status=1;

	}
	else{
    $row2=$fetch($result4);
    $status=$row2['MStatus'];
    if($status==2){
    	$DoL=$row2['DOM'];
    }
    else{
    	$DoL=$row2['DOB'];
    }
    $DoJ=$row2['DOJ'];
    $DOJ_WEF=$row2['DOJ_WEF'];

	}
if($key=='EL'){
		$keyval=1;
	}
	if($key=='CL'){
		$keyval=2;
	}
	if($key=='SL'){
		$keyval=3;
	}
	if($key=='SEL'){
		$keyval=8;
	}
	if($key=='ML'){
		$keyval=7;
	}
	if($key=='AL'){
		$keyval=9;
	}
	if($key=='SPL'){
		$keyval=10;
	}
	if($key=='OL'){
		$keyval=11;
	}
	if($key=='BTL'){
		if($status==2){
		$keyval=6;
	} else { $keyval=5; }
	}


	$sql2="select sum(a.LvDays) as LvDays from (SELECT LvDays ,Createdby,Levkey FROM leave where Createdby='$code' and status='2' and LvType='$keyval' and YEAR(Trn_Date) = YEAR(getDate()) group by Levkey,Createdby,LvDays) a";
	//echo $sql2;
		$result2=query($query, $sql2, $pa, $opt, $ms_db);

		//$num($result4);
	
	if($num($result2)==0){
		$avail=0;

	}
	else{
		$row4=$fetch($result2);
    $avail=$row4['LvDays'];

	}

	if($value['rules']['accumulation']==0){
		$opening=0;
	}
	else{
		$opening=0;
	}
	if($value['name']=='BTL'){
		if($status==2){
    	$Leave_Name='Anniversary Leave';
    }
    else{
    	$Leave_Name='Birthday Leave';
    }
	}
	else{
		$Leave_Name=$value['name'];
	}
	$total_days= getCL_SL($key,$value['day_limit'],$opening,$avail,$value['rules']['accumulation'],$DoL,$DoJ,$DOJ_WEF);

	//array_push_assoc($total_days1, $key, $total_days);
	//array_push($total_days1,$total_days);
	//$total_days.=$total_days;
	//$i++;
	$total_days1[$key] = $total_days;
	$accur=($totall_day+$avail)-$opening;
	$totall_day=getCL_SL($key,$value['day_limit'],$opening,$avail,$value['rules']['accumulation'],$DoL,$DoJ,$DOJ_WEF);

$accur=($totall_day+$avail)-$opening;
$accur1[$key] = $accur;
}
//print_r($accur1);
/*foreach ($total_days1 as $name => $total_days) {
    if ($name == $type1) {
      echo $name . " is " . $total_days . " years old";
        break;
    }
}*/

	//$totall_day=getCL_SL($key,$value['day_limit'],$opening,$avail,$value['rules']['accumulation'],$DoL,$DoJ,$DOJ_WEF);
echo "p".$type1."q";
if($type1=="all")
{
	echo "if"."SSSSSSSSSSSSSSSS";
  $getMyteamLeaveRequestData=$leave_class_obj->getMyteamLeaveRequestData($code);
  print_r($getMyteamLeaveRequestData);
                           $Trn_Date= $getMyteamLeaveRequestData[0];
                            $LvFrom=$getMyteamLeaveRequestData[1];
                            $LvTo=$getMyteamLeaveRequestData[2];
                            $LvType=$getMyteamLeaveRequestData[3];
                            $LvDays=$getMyteamLeaveRequestData[4];
      						$ApprovedBy=$getMyteamLeaveRequestData[5];
      						$approved_date= $getMyteamLeaveRequestData[6];
                            $team_leavecount_flag=$getMyteamLeaveRequestData[7];
	
}
else
{
	//echo $type1;
	
	//echo "else".$keyval;
	$getMyteamLeaveRequestData=$leave_class_obj->getMyteamLeaveRequestData1($code,$type1,$start,$end,$accur1);
	print_r($getMyteamLeaveRequestData);
                           $Trn_Date= $getMyteamLeaveRequestData[0];
                            $LvFrom=$getMyteamLeaveRequestData[1];
                            $LvTo=$getMyteamLeaveRequestData[2];
                            $LvType=$getMyteamLeaveRequestData[3];
                            $LvDays=$getMyteamLeaveRequestData[4];
      						$ApprovedBy=$getMyteamLeaveRequestData[5];
      						$total_days_bal=$getMyteamLeaveRequestData[6];
      						$approved_date= $getMyteamLeaveRequestData[7];
                            $team_leavecount_flag=$getMyteamLeaveRequestData[8];
	
}


if($type1=='all')
{
$list='';
$list.="<thead><tr>
                                                        <th>Approved Date</th>
                                                        <th>Apply Date</th>
                                                        <th>Transaction Details</th>
                                                          <th>Leave Type</th>
                                                          <th>No Of days</th>
                                                        <th>Action by</th>
                                                      
                                                       
                                                    </tr>
                                                    </thead>
                                                    <tbody ></tbody>";
                                                 
	
	for($j=0;$j<$team_leavecount_flag;$j++) {
		
//$sac=$leave_class_obj->getemployee_leave_type($LvType[$j]);
//print_r($sac);
		$list.="<tr><td>".$approved_date[$j]."</td><td>".$Trn_Date[$j]."</td><td>".$LvFrom[$j].' To '.$LvTo[$j]."</td><td>".$leave_class_obj->getemployee_leave_type($LvType[$j])."</td><td>".$LvDays[$j]."</td><td>".$leave_class_obj->getemployee_name($ApprovedBy[$j])."</td></tr>" ;
		
	
}
}
else
{

$list='';
$list.="<thead><tr>
                                                      <th>Approved Date</th>
                                                        <th>Apply Date</th>
                                                        <th>Transaction Details</th>
                                                          <th>Leave Type</th>
                                                          <th>No Of days</th>
                                                        <th>Action by</th>
                                                      <th>Balance</th>
                                                       
                                                    </tr>
                                                    </thead>
                                                    <tbody ></tbody>";
                                                 
	
	for($j=0;$j<$team_leavecount_flag;$j++) {
		

		$list.="<tr><td>".$approved_date[$j]."</td><td>".$Trn_Date[$j]."</td><td>".$LvFrom[$j].' To '.$LvTo[$j]."</td><td>".$leave_class_obj->getemployee_leave_type($LvType[$j])."</td><td>".$LvDays[$j]."</td><td>".$leave_class_obj->getemployee_name($ApprovedBy[$j])."</td><td>".$total_days_bal[$j]."</td></tr>" ;
		
	
}
}

echo $list;
}

elseif($_GET['type']=="showmyleave"){
  $leave_b='';
  $id=$_POST['id'];
 // print_r($data[$employeetype][0]);
//echo"<table><tr><td>Leave type</td><td>Leave</td></tr>";
foreach ($data[$employeetype][0] as $key => $value) {
	# code...
	//$avail=3;
	 $sql4="Select REPLACE(CONVERT(VARCHAR(10),a.DOJ,102),'.','-') AS DOJ,REPLACE(CONVERT(VARCHAR(10),a.DOJ_WEF,102),'.','-') AS DOJ_WEF,REPLACE(CONVERT(VARCHAR(10),a.DOB,102),'.','-') AS DOB,a.MStatus,REPLACE(CONVERT(VARCHAR(10),a.DOM,102),'.','-') AS DOM,a.SEX from hrdmastqry a where emp_code='$id'";
	 $result4=query($query, $sql4, $pa, $opt, $ms_db);
	 if($num($result4)==0){
		
		$DoL='';
		$DoJ='';
		$DOJ_WEF='';
		$status=1;

	}
	else{
    $row2=$fetch($result4);
    $status=$row2['MStatus'];
    if($status==2){
    	$DoL=$row2['DOM'];
    }
    else{
    	$DoL=$row2['DOB'];
    }
    $DoJ=$row2['DOJ'];
    $DOJ_WEF=$row2['DOJ_WEF'];

	}
if($key=='EL'){
		$keyval=1;
	}
	if($key=='CL'){
		$keyval=2;
	}
	if($key=='SL'){
		$keyval=3;
	}
	if($key=='SEL'){
		$keyval=8;
	}
	if($key=='ML'){
		$keyval=7;
	}
	if($key=='AL'){
		$keyval=9;
	}
	if($key=='SPL'){
		$keyval=10;
	}
	if($key=='OL'){
		$keyval=11;
	}
	if($key=='BTL'){
		if($status==2){
		$keyval=6;
	} else { $keyval=5; }
	}
	 $sql2="select sum(a.LvDays) as LvDays from (SELECT LvDays ,Createdby,Levkey FROM leave where Createdby='$id' and status IN('2','1','5') and LvType='$keyval' and YEAR(Trn_Date) = YEAR(getDate()) group by Levkey,Createdby,LvDays) a";
	  $sql_pending="select sum(a.LvDays) as LvDays from (SELECT LvDays ,Createdby,Levkey FROM leave where Createdby='$id' and status IN('1','5') and LvType='$keyval' and YEAR(Trn_Date) = YEAR(getDate()) group by Levkey,Createdby,LvDays) a";
	  $sql_approval="select sum(a.LvDays) as LvDays from (SELECT LvDays ,Createdby,Levkey FROM leave where Createdby='$id' and status IN('2') and LvType='$keyval' and YEAR(Trn_Date) = YEAR(getDate()) group by Levkey,Createdby,LvDays) a";
	  $result_pending=query($query, $sql_pending, $pa, $opt, $ms_db);
	  $result_approval=query($query, $sql_approval, $pa, $opt, $ms_db);
	 //echo $sql_pending;
		$result2=query($query, $sql2, $pa, $opt, $ms_db);

		//echo $num($result4);
	
	if($num($result2)==0){
		$avail=0;

	}
	else{
		$row4=$fetch($result2);
    $avail=$row4['LvDays'];

	}

	if($value['rules']['accumulation']==0){
		$opening=0;
	}
	else{
		$opening=0;
	}
	if($value['name']=='BTL'){
		if($status==2){
    	$Leave_Name='Anniversary Leave';
    }
    else{
    	$Leave_Name='Birthday Leave';
    }
	}
	else{
		$Leave_Name=$value['name'];
	}

	$totall_day=getCL_SL($key,$value['day_limit'],$opening,$avail,$value['rules']['accumulation'],$DoL,$DoJ,$DOJ_WEF);
$leave_b.="<div class='leaveCon clearfix'><div class='col-md-9'>".$Leave_Name."</div><div class='col-md-3' id='".$key."'>".$totall_day."</div></div>";
		

}

echo $leave_b;
  //print_r($data['Salaried']);
}


elseif($_GET['type']=="showholiday"){

$id=$_POST['id'];

$holiday='';


 $sqlup="select convert(varchar, HDATE, 6), hdesc from holidays WHERE cast(HDATE as date) >= cast(GETDATE() as date) and YEAR(HDATE)=YEAR(GETDATE()) and (LOC_CODE='' or LOC_CODE=(select LOC_CODE from HrdMastQry where Emp_Code='$id'))";
 $resup=query($query,$sqlup,$pa,$opt,$ms_db);

$holiday .='<div class="col=md-12" id="upholi">';

while($dataup=$fetch($resup) ){

$holiday.='<div class="leaveCon clearfix" ><div class="col-md-8"> '.$dataup[1].'</div> <div class="col-md-4">'.$dataup[0].' </div></div>';

}

$holiday.='</div>';



$sqlpast="select convert(varchar, HDATE, 6), hdesc from holidays WHERE cast(HDATE as date) < cast(GETDATE() as date) and YEAR(HDATE)=YEAR(GETDATE()) and (LOC_CODE='' or LOC_CODE=(select LOC_CODE from HrdMastQry where Emp_Code='$id'))";
 $respast=query($query,$sqlpast,$pa,$opt,$ms_db);

$holiday .='<div class="col=md-12" id="pastholi" style="display:none;">';
while($datapast=$fetch($respast)){

$holiday.='<div class="leaveCon clearfix" ><div class="col-md-8"> '.$datapast[1].'</div> <div class="col-md-4">'.$datapast[0].' </div></div>';

}

$holiday.=' </div>';

echo $holiday;


}
function array_push_assoc($array, $key, $value){
$array[$key] = $value;
return $array;
}

?>

