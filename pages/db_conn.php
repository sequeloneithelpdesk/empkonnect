<?php //ini_set("display_errors","on"); error_reporting(E_ALL);
//session_start();
$host=$_SERVER['HTTP_HOST'];
include_once("common_functions.php");

if($host=="localhost"){
    $_SESSION['root']="/empkonnect/";
    $_SESSION['phpsql_connect']="sqlsrv_connect";
    $_SESSION['phpsql_error']="sqlsrv_errors";
    $_SESSION['phpsql_query']="sqlsrv_query";
    $_SESSION['phpsql_fetch']="sqlsrv_fetch_array";
    $_SESSION['phpsql_pa']=array();
    $_SESSION['phpsql_opt']=array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $_SESSION['phpsql_num']="sqlsrv_num_rows";

    $connect=$_SESSION['phpsql_connect'];
    $error=$_SESSION['phpsql_error'];
    $query=$_SESSION['phpsql_query'];
    $fetch=$_SESSION['phpsql_fetch'];
    $num=$_SESSION['phpsql_num'];
    $pa=$_SESSION['phpsql_pa'];
    $opt=$_SESSION['phpsql_opt'];

   	$serverName = "."; //serverName\instanceName, portNumber (default is 1433)
   	$connectionInfo = array( "Database"=>"CNH", "UID"=>"sa", "PWD"=>"1@million");
   	$conn = $connect( $serverName, $connectionInfo);
   	if($conn ) {
		//echo "Connection established.<br />";
   	}else{
		//echo "Connection could not be established.<br />";
       die( print_r( $error(), true));
   	}
   	$_SESSION['phpsql_db']=$conn;
   	$ms_db=$_SESSION['phpsql_db'];


} else if($host=='hrms.sequelone.com'){
    $_SESSION['root']="/";
    $_SESSION['phpsql_connect']="mssql_connect";
    $_SESSION['phpsql_db_connect']="mssql_select_db";
    $_SESSION['phpsql_error']="mserror";
    $_SESSION['phpsql_query']="mssql_query";
    $_SESSION['phpsql_fetch']="mssql_fetch_array";
    $_SESSION['phpsql_num']="mssql_num_rows";
    $_SESSION['phpsql_last_message']="mssql_get_last_message";
    $_SESSION['phpsql_pa']="";
    $_SESSION['phpsql_opt']="";

    $connect=$_SESSION['phpsql_connect'];
	$db_connect=$_SESSION['phpsql_db_connect'];
    $error=$_SESSION['phpsql_error'];
    $query=$_SESSION['phpsql_query'];
    $fetch=$_SESSION['phpsql_fetch'];
    $num=$_SESSION['phpsql_num'];
    $pa=$_SESSION['phpsql_pa'];
    $opt=$_SESSION['phpsql_opt'];
    $last=$_SESSION['phpsql_last_message'];
    $_SESSION['phpsql_db']="";
    $ms_db=$_SESSION['phpsql_db'];
    
    $conn = $connect('172.29.0.194','empkonnect','P3P51#@634');
    if (!$conn) {
        echo $strerr = "ERROR: Failed to connect to MSSQL Server ('hostname') : " . $last();
    }
    else if($conn){
        //echo $strerr="connection established";
    }
    $db = $db_connect('TimeOffce') or die("Error selecting the database"); 

}else{
	$_SESSION['root']="/";
    $_SESSION['phpsql_connect']="mssql_connect";
    $_SESSION['phpsql_db_connect']="mssql_select_db";
    $_SESSION['phpsql_error']="mserror";
    $_SESSION['phpsql_query']="mssql_query";
    $_SESSION['phpsql_fetch']="mssql_fetch_array";
    $_SESSION['phpsql_num']="mssql_num_rows";
    $_SESSION['phpsql_last_message']="mssql_get_last_message";
    $_SESSION['phpsql_pa']="";
    $_SESSION['phpsql_opt']="";

    $connect=$_SESSION['phpsql_connect'];
	$db_connect=$_SESSION['phpsql_db_connect'];
    $error=$_SESSION['phpsql_error'];
    $query=$_SESSION['phpsql_query'];
    $fetch=$_SESSION['phpsql_fetch'];
    $num=$_SESSION['phpsql_num'];
    $pa=$_SESSION['phpsql_pa'];
    $opt=$_SESSION['phpsql_opt'];
    $last=$_SESSION['phpsql_last_message'];
    $_SESSION['phpsql_db']="";
    $ms_db=$_SESSION['phpsql_db'];
    
    $conn = $connect('172.29.0.194','empkonnect','P3P51#@634');
    if (!$conn) {
        echo $strerr = "ERROR: Failed to connect to MSSQL Server ('hostname') : " . $last();
    }
    else if($conn){
        //echo $strerr="connection established";
    }
    $db = $db_connect('CNH') or die("Error selecting the database");
}
define('EMPLOYEE_CATEGORY_TITLE', 'Category');
?>
