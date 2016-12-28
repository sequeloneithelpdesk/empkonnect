<?php

include('../../db_conn.php');
include('../../configdata.php');
 $type=$_POST['type'];
if($type=="finyear"){
	$year1=$_POST['year'];
	$startdate=$_POST['startdate'];
	$enddate=$_POST['enddate'];
$year=substr($year1,0,4);
    //echo$year;
 $sql1="insert into FinYear (FY,FY_Start,FY_Type,CreatedBy) values (?,?,?,?)" ;
 $param = array($year,$startdate,$enddate,'$user') ;
 $query=sqlsrv_query($conn,$sql1,$param);

if($query ){
  echo "1" ;
}
else{
  echo "N";
}
}

elseif($type=="rmbyear"){
	$year=$_POST['year'];
	$startdate=$_POST['startdate'];
	$enddate=$_POST['enddate'];

 $sql1="insert into changermb_year (year,rmb_start,rmb_end,created_by) value(?,?,?,?)";
$result1 = $conn->prepare($sql1);
 $result1->bind_param('ssss',$year,$startdate,$enddate,$user);

if($result1->execute()){
  echo "Y" ;
}
else{
  echo "N";
}
}
elseif($type=="levyear"){
	$year=$_POST['year'];
	$startdate=$_POST['startdate'];
	$enddate=$_POST['enddate'];

 $sql1="insert into changeleave_year (year,lev_start,lev_end,created_by) value(?,?,?,?)";
$result1 = $conn->prepare($sql1);
 $result1->bind_param('ssss',$year,$startdate,$enddate,$user);

if($result1->execute()){
  echo "Y" ;
}
else{
  echo "N";
}
}
?>