<?php
$error = 0;
$errormessage = '';
$data = array();
if ($_FILES["file"]["error"] > 0)
{
	$error = 1;
	$errormessage  = $_FILES["file"]["error"];
}
else
{
	//$type=$_POST['inputhid'];
	$allowed =  array('csv','xls','xlsx');
	$filename = $_FILES["file"]["name"];
	$ext = pathinfo($filename, PATHINFO_EXTENSION);
	if(!in_array($ext,$allowed) ){
	   $error = 1;
	   $errormessage = 'Allowed Extension csv,xls,xlsx';
	}
	else{
		if($ext == 'csv'){
			$data = csv();
		}elseif($ext == 'xls' || $ext == 'xlsx'){
			$data = xls();
		}
	}
}

$alldata = array("data" => $data, "error" => $error, "errorMessage" => $errormessage);

echo json_encode($alldata);

// get data from csv file
function csv(){

		$a=$_FILES["file"]["tmp_name"];
		$csv_file = $a; 
		$file = fopen($csv_file,"r");
		$csv_arr = array();
		//Populate an array with all the cells of the CSV file
		while(!feof($file))
		{
			 $csv_arr[] = fgetcsv($file);
		}
		//Close the file, no longer needed
		fclose($file);
		$array = array();
		for($i=0;$i<count($csv_arr)-1;$i++){
			if($i==1 || $i== 2 ){
				//continue;
			}
			$array[]= $csv_arr[$i];
		}
		return $array;
		
}

function xls(){
	// loading php excel
	require '../plugin/PHPExcel/Classes/PHPExcel.php';
	include ("../plugin/PHPExcel/Classes/PHPExcel/IOFactory.php");  
	$inputFile=$_FILES["file"]["tmp_name"];
	$inputFileType = PHPExcel_IOFactory::identify($inputFile);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
	$objPHPExcel = $objReader->load($inputFile);
	//Get worksheet dimensions
	$sheet = $objPHPExcel->getSheet(0); 
	$highestRow = $sheet->getHighestRow(); 
	$highestColumn = $sheet->getHighestColumn();
	$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
	
	//Loop through each row of the worksheet in turn
	$array = array();
	$t=1;
	for ($row = 1; $row <= $highestRow; $row++){ 
		if($row==2 || $row== 3 ){
				continue;
			}
		for ($col = 1; $col <= $highestColumnIndex; $col++){
			$colname = PHPExcel_Cell::stringFromColumnIndex($col);
			$cellValue = $objPHPExcel->getActiveSheet()->getCell($colname.$row)->getValue();

			$array[$t-1][$col-1] = strval($cellValue);
		}

		$t++;
	}
	return $array;
			
	
}
?>
