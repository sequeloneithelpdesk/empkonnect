<?php
//include('../../db_conn.php');
//include('../../configdata.php');
ini_set('MAX_EXECUTION_TIME', -1);
include ('leave_class.php');
$leave_class_obj=new leave_class();
include('../leaveCal.php');

session_start();
if (isset($_POST["code"]) && !empty($_POST["code"])) {
    $emp_code=$_POST["code"];   
}else{  
	$sql="select emp_code from HrdMast";
	$result=query($query, $sql, $pa, $opt, $ms_db);
	$count=0;
	 while ($rows = $fetch($result))
        {
           $emp_code[$count]=$rows['emp_code'];
            $count++;
        }
       echo sizeof($emp_code);
  // $emp_code=$_SESSION['usercode'];
}
//$emp_code='10910';
//echo $emp_code;
for($k=0;$k < sizeof($emp_code);$k++)
{
$typesql="select * from hrdmastqry a where emp_code='$emp_code[$k]'";
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
  
  $leave_b='';
  
  
// print_r($data['apprentice'][0]);
//echo"<table><tr><td>Leave type</td><td>Leave</td></tr>";
foreach ($data[$employeetype][0] as $key => $value) {
	# code...
	//$avail=3;
	 $sql4="Select REPLACE(CONVERT(VARCHAR(10),a.DOJ,102),'.','-') AS DOJ,REPLACE(CONVERT(VARCHAR(10),a.DOJ_WEF,102),'.','-') AS DOJ_WEF,REPLACE(CONVERT(VARCHAR(10),a.DOB,102),'.','-') AS DOB,a.MStatus,REPLACE(CONVERT(VARCHAR(10),a.DOM,102),'.','-') AS DOM,a.SEX from hrdmastqry a where emp_code='$emp_code[$k]'";
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
	$sql2="select sum(a.LvDays) as LvDays from (SELECT LvDays ,Createdby,Levkey FROM leave where Createdby='$emp_code[$k]' and status='2' and LvType='$keyval' and YEAR(Trn_Date) = YEAR(getDate()) group by Levkey,Createdby,LvDays) a";
	
		$result2=query($query, $sql2, $pa, $opt, $ms_db);

		$num($result4);
	
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
	//echo $key;
	$sql4="Select * from LeavMast where emp_code='$emp_code[$k]' and LvType='$key' and LevYear=year(getdate()) ";
	 $result4=query($query, $sql4, $pa, $opt, $ms_db);
	 //echo $sql4;
	 if($num($result4) > 0){
	 	$sql1="update LeavMast SET Opening='$totall_day' where emp_code='$emp_code[$k]' and LvType='$key' and LevYear=year(getdate()) ";
	 	$res=query($query,$sql1,$pa,$opt,$ms_db);
	 }
	 else
	 {
	 	$sql="insert into LeavMast (LevYear,Emp_Code,LvType,Opening) values(year(getdate()),'$emp_code[$k]','$key','$totall_day')";
	 //	echo $sql;
	 	$res=query($query,$sql,$pa,$opt,$ms_db);
	 	if($res)
	 	{
	 		echo $k;
	 	}
	 }
	//$accur=($totall_day+$avail)-$opening;
}
		
}

  //print_r($data['Salaried']);
