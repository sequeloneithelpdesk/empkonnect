
<?php 
include ('../../db_conn.php');
include ('../../configdata.php');

global $query;
global $pa;
global $opt;
global $ms_db;
global $num;
global $fetch;

$emp_code = $_GET['emp_code'];

$sqlq0="SELECT emp_code,Emp_FName FROM HrdMastqry WHERE Mngr_Code = '".$emp_code."' or emp_code='".$emp_code."'";

//$sqlq0 ="SELECT emp_code,Emp_FName FROM HrdMastqry WHERE Mngr_Code = (SELECT Mngr_Code FROM HrdTran	WHERE Emp_Code='".$emp_code."' GROUP BY Mngr_Code) GROUP BY EMP_CODE,Emp_FName";

	$resultq0=query($query,$sqlq0,$pa,$opt,$ms_db);
	$EmpTeam = array();
	if($resultq0){
		$rowExist=$num($resultq0);
	}else{
		$rowExist=-1;
	}
	if($rowExist>0) {
		while ($rowq0 = $fetch($resultq0)){
			$EmpTeam[] = array('emp_code'=>$rowq0['emp_code'],'emp_fname'=>$rowq0['Emp_FName']);
		}
		echo json_encode(array('status'=>TRUE,'data'=>$EmpTeam));
	}else{
		echo json_encode(array('status'=>FALSE,'data'=>''));
	}



?>