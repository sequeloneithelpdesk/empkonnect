<?php

include '../../../db_conn.php';
include 'dbconnection.php';


$type = $_POST['type'];

if($type == 'jsonData'){

	getData();
}elseif($type == 'saveData'){

	saveData();
}

elseif($type == 'sendmail'){

	saveuserData(); 
}

function getData(){
	$filename = base64_decode($_POST['a']); 
	$file = "../json/$filename.json";
	$data = json_decode(file_get_contents($file), true);
	$newData = array();
	foreach($data['data'] as $i => $opData){
		$newData['data'][$i]['value'] = $opData['value'];
		$newData['data'][$i]['condition'] = $opData['condition'];
		if(array_key_exists("type", $opData) && $opData['type'] == 'sqlOption'){
			$newData['data'][$i]['rangeValue'] = getsqlvalue( $opData['sql'],$opData['optValColName']);
		}
		if(array_key_exists("rangeValue", $opData)){
			$newData['data'][$i]['rangeValue'] = $opData['rangeValue'] ;
		}
		if(array_key_exists("minRange", $opData)){
			$newData['data'][$i]['minRange'] = $opData['minRange'];
		}
		if(array_key_exists("maxRange", $opData)){
			$newData['data'][$i]['maxRange'] = $opData['maxRange'];
		}
		if(array_key_exists("mandatory", $opData)){
			$newData['data'][$i]['mandatory'] = $opData['mandatory'];
		}
		if(array_key_exists("dateformate", $opData)){
			$newData['data'][$i]['dateformate'] = $opData['dateformate'];
		}
	
	}
	echo json_encode($newData);
	
	
}

function getsqlvalue($sql,$a){
	global $conn;
	$ms_db=$_SESSION['phpsql_db'];
	$query=$_SESSION['phpsql_query'];
	$pa=$_SESSION['phpsql_pa'];
	$opt=$_SESSION['phpsql_opt'];
	$fetch=$_SESSION['phpsql_fetch'];

	$query23 = query1($query,$sql,$pa,$opt,$ms_db);
	$data = array();
	while($row = $fetch($query23)){
		$data[] = array($row[$a[0]],$row[$a[1]]);
	}
	return $data;

}

function saveData(){
	$filename = base64_decode($_POST['a']); 
	$file = "../json/$filename.json";
	$scheme = json_decode(file_get_contents($file), true);
	$data = json_decode($_POST['data'],1);
	global $email_name;
	$schemeD = $scheme['database'];
	$position = array();

	global $conn;
	$ms_db=$_SESSION['phpsql_db'];
	$query=$_SESSION['phpsql_query'];
	$pa=$_SESSION['phpsql_pa'];
	$opt=$_SESSION['phpsql_opt'];
	$fetch=$_SESSION['phpsql_fetch'];
	$error = 0;
	$errormessage = '';
	$removedata = array();

	foreach($schemeD as $i => $schemeA){
		if($schemeA['type'] == 'bulkInsert'){
			$dataIns = bulkInsertSql($schemeA,$data);
			 $sql = $dataIns['sql'];
			$removedata[] = $dataIns['removedata'];
			$query12 = query1($query,$sql,$pa,$opt,$ms_db);
			if(!$query12){
				break;
			}
		}
		
	}
		 $empcodeA = '';
		 $sendarray = array();
		foreach($email_name as $i => $email_A){
			$email = @$email_A["Company Email"];
			$name = @$email_A["First Name"];
			$empl_code = @$email_A["Emp Code"];
			foreach ($removedata[0] as $s => $S_array) {
				if($S_array["value"] == $empl_code){
					continue;
				}
			}
			$sendarray[$empl_code] = $email_A;

		//  $to=array($email);
		//	$message="Hi ".$name." here is Password Reset Link <br>";
		//	$message.='https://empkonnect.sequelone.com/pages/login/resetPass.php?usercode='.$code;
		//s	@mymailer('donotreply@sequelone.com','Reset Password',$message,$to);

		}



	$return = array("error" => $error, "errorMessage" => $errormessage, "removedata" => $removedata,"employee_code"=>$sendarray);
	echo json_encode($return); 

}

function bulkInsertSql($schemeA,$data){
	global $conn;
	global $email_name;
	$email_name = array();
	$ms_db=$_SESSION['phpsql_db'];
	$query=$_SESSION['phpsql_query'];
	$pa=$_SESSION['phpsql_pa'];
	$opt=$_SESSION['phpsql_opt'];
	$fetch=$_SESSION['phpsql_fetch'];
	
	$removedata = array();
	$removedata["dublicatevalue"] = array();
	$checkkey = array();




	$table = $schemeA['table'];
	$keys = $schemeA['key'];
	$a = 0;
	$sql = "INSERT INTO  $table  (";
	foreach($keys as $i => $DB){
		$Col = $DB[0];
		$name = $DB[1];
		if(array_key_exists($name,$data[0]) || $name == 'dateSelect12'){
			if($a > 0){
				$sql .= ",";
			}

			$sql .= " $Col ";

			
			if(array_key_exists('2',$DB)){
				
				if(array_key_exists("condition",$DB[2])){
					if(in_array("NoDublicateValue",$DB[2]["condition"])){
						$checkkey[] = array("id" => $i, "column_name" => $Col, "table" => $table, "name" => $name); 

					}
				}

			}

			$a++;
		}
	}
		foreach($checkkey as $k => $ChechD){
		$tableC = $ChechD['table'];
		$colC = $ChechD['column_name'];
		$nameC = $ChechD['name'];
		$dataC = '';
		for($l = 0; $l < count($data) ; $l++){
			if($l > 0){
				$dataC .= ',';
			}
			$dataC .= "'".$data[$l][$nameC]."'";
			
		}
		$sqlD = "select * from $tableC where $colC IN ($dataC)";
		$queryC = query1($query,$sqlD,$pa,$opt,$ms_db);
		if($queryC){
			while($rowC = $fetch($queryC)){
			
				$removedata[$nameC][] = $rowC[$colC];
			}
		}
	}

	$sql .= ") VALUES ";
	$b = 0;
	for($n = 0; $n < count($data) ; $n++){
		$sqlrow = '';
		$insert = 1;
		$a = 0;
		if($b > 0){
			$sqlrow .= ',';
		}
		$sqlrow .= "(";
		foreach($keys as $i=>$DB){
			$Col = $DB[0];
			$name = $DB[1];
			
			if(array_key_exists($name,$data[$n]) || $name == 'dateSelect12'){
				if($name == 'dateSelect12'){
					$value = date('Y-m-d h:i:s');
				}else{
					$value = $data[$n][$name];
				}
				if($a > 0){
					$sqlrow .= ",";
				}
				// checking the dubicate value 
				if(array_key_exists($name, $removedata) && in_array($value,$removedata[$name])){
					$Dcolname = $name;
					$DdataID = $i;
					$valueD = $value;
					$insert = 0;
				}
				$sqlrow .= "'$value'";
				if($name == "Emp Code" || $name == "First Name" || $name == "Company Email"){
					if(array_key_exists($n,$email_name) && array_key_exists($name, $email_name[$n])){
					
					}else{
						$email_name[$n][$name] = $value;
					}
				}
				$a++;
			}
		}
		$sqlrow .= ")";
		if($insert == 0){
			$removedata["dublicatevalue"][] = array("row" => $n, "columb" => $Dcolname, "value" => $valueD);
			continue;
		}
		
		
		$sql .= $sqlrow;
		$b++;
	}
	 
	return array("sql" => $sql, "removedata" => $removedata["dublicatevalue"]);

}

function saveuserData(){

	$data=$_POST['data'];
	//print_r($data);
	$ms_db=$_SESSION['phpsql_db'];
	$query=$_SESSION['phpsql_query'];
	$pa=$_SESSION['phpsql_pa'];
	$opt=$_SESSION['phpsql_opt'];
	$fetch=$_SESSION['phpsql_fetch'];
	$num=$_SESSION['phpsql_num'];

	$sql="insert into users (userId,username,useremailid,IsLocked,UserType,UserActive) values ";
	$i=0;
	foreach ($data as $key => $value) {
		if($i!=0){
			$sql.=",";
		}
		$id=md5($key);
		$email=md5($value['Company Email']);
		$sql.="('".$id."','".$value['First Name']."','".$email."','N','U','0')" ;
		$i++;
	}
   //echo $sql;
	$query = query1($query,$sql,$pa,$opt,$ms_db);

	if($query){
		$subject='Welcome message';
		foreach ($data as $key1 => $value1) {
			$msg=welcome_msg($key1);
			$to=$value1['Company Email'];
		mymailer('donotreply@sequelone.com',$subject,$msg,$to);
	}
	
		return array("msg"=>"success");
	}
	else{
		return array("msg"=>"error");
	}


}
?>
