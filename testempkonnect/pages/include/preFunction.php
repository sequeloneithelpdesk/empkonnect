<?php 
//$funct=$_POST['funcname'];

//$table = $_POST['table'];

//$code = $_POST['code'];

//$name = $_POST['name'];

//$pass = $_POST['pass'];

//$funct($table,$code,$name,$pass);

function getEmpFullName($empId){
	include "../db_conn.php";
	$sql="SELECT empTitle, empFName,empMName,empLName FROM `emphrdmast` WHERE empCode='".$empId."'";
	$result = $conn->query($sql);
	if ($result->num_rows == 1) {
		$row = $result->fetch_assoc();
		return $row['empTitle']." ".$row['empFName']." ".$row['empMName']." ".$row['empLName'];
		
	}else{
		return "---";
	}
}

function getLocation($locId){
	include "../db_conn.php";
	$sql="SELECT * FROM `locmast` WHERE locmast.locCode='".$locId."'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		return $row['locName'];
		
	}
}

function allLocation(){
	include "../db_conn.php";
	$sql="SELECT * FROM `locmast`";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		return $row;
		
	}
}

//my search start here



//my search end herer 

function getData($table,$code,$name,$pass){
	include "../db_conn.php";
	$sql="SELECT ".$code.",".$name." FROM `".$table."` where ".$name." LIKE '%".$pass."%'";
	
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		$posts = array();
		while($row =$result->fetch_assoc()){
		
			 $oname=$row[$name];
			 $ocode=$row[$code];

			$b_name='<strong>'.strtolower($pass).'</strong>';
			
			$final_name = str_ireplace($pass, $b_name, $oname);
			
			
			$posts[] = array('code'=> $ocode, 'name'=> $final_name);

   
		}
		$response['country'] = $posts;
		echo json_encode($response);
		
	}
}

?>
