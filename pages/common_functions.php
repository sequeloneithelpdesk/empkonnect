<?php
/*
* Created By: Pramod Shrama
* Date: 07 Oct 2016
*/


/*
* Change date format
* @params $dateTime string
* Return null if @datetime is null otherwise converted custom format
*/
if (!function_exists('dateFormat')) {

	function dateFormat($dateTime = null)
	{ 
		#Remove white spaces from string
		$currentformatDateTime = trim($dateTime);

		#Return null if date time not found
		if(empty($currentformatDateTime)){ return ''; exit(); }

		#Return converted date format
		return date("d M Y", strtotime($dateTime));
	}

}

/*
* Change time format
* @params $dateTime string
* Return null if @datetime is null otherwise converted custom format
*/
if (!function_exists('timeFormat')) {

	function timeFormat($dateTime = null)
	{ 
		#Remove white spaces from string
		$currentformatDateTime = trim($dateTime);

		#Return null if date time not found
		if(empty($currentformatDateTime)){ return ''; exit(); }

		#Return converted date format
		return date('h:i A', strtotime($dateTime));
	}

}

/*
* Change time format
* @params $dateTime string
* Return null if @datetime is null otherwise converted custom format
*/
if (!function_exists('dateTimeFormat')) {

	function dateTimeFormat($dateTime = null)
	{ 
		#Remove white spaces from string
		$currentformatDateTime = trim($dateTime);

		#Return null if date time not found
		if(empty($currentformatDateTime)){ return ''; exit(); }

		#Return converted date format
		return date('jS F Y h:i A', strtotime($dateTime));
	}

}


/*
* stringTextFormat get a string from user and return a proper formatted string
*/
function stringTextFormat($string = null){
	$s = trim($string);

	if(empty($s))
		return '';
	return str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($s))));
	exit();
}


function prd($record){
	if(is_array($record)){
		echo '<pre>'; print_r($record); echo '</pre>';
	}else{
		echo '<pre>'; var_dump($record); echo '</pre>';
	}
	exit();
}


?>