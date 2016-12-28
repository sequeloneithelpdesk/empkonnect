<?php
//session_start();
$host=$_SERVER['HTTP_HOST'];
if($host=="localhost"){
    $_SESSION['srv_connect']="sqlsrv_connect";
    $_SESSION['srv_error']="sqlsrv_errors";
    $_SESSION['srv_query']="sqlsrv_query";
    $_SESSION['srv_fetch']="sqlsrv_fetch_array";
    $_SESSION['srv_num']="sqlsrv_num_rows";

    $connect=$_SESSION['srv_connect'];
    $error=$_SESSION['srv_error'];
    $query=$_SESSION['srv_query'];
    $fetch=$_SESSION['srv_fetch'];
    $num=$_SESSION['srv_num'];

    $serverName = "172.16.30.4"; //serverName\instanceName, portNumber (default is 1433)
    $connectionInfo = array( "Database"=>"empkonnect", "UID"=>"empkonnect", "PWD"=>"P3P51#@634");
    $conn = $connect( $serverName, $connectionInfo);
    if($conn ) {
//     echo "Connection established.<br />";
    }else{
//    echo "Connection could not be established.<br />";
        die( print_r( $error(), true));
    }
    $ms_db=$conn;
    $pa = array();
    $opt =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );

}
else{
    $_SESSION['ms_connect']="mssql_connect";
    $_SESSION['ms_db_connect']="mssql_select_db";
    $_SESSION['ms_error']="mssql_errors";
    $_SESSION['ms_query']="mssql_query";
    $_SESSION['ms_fetch']="mssql_fetch_array";
    $_SESSION['ms_num']="mssql_num_rows";
    $_SESSION['ms_last_message']="mssql_get_last_message";

    $connect=$_SESSION['ms_connect'];
    $db_connect=$_SESSION['ms_db_connect'];
    $error=$_SESSION['ms_error'];
    $query=$_SESSION['ms_query'];
    $fetch=$_SESSION['ms_fetch'];
    $num=$_SESSION['ms_num'];
    $last=$_SESSION['ms_last_message'];
    $ms_db="";
    $ms_arr="";

    $conn = $connect('172.29.0.194','empkonnect','P3P51#@634');
    if (!$conn) {
        echo $strerr = "ERROR: Failed to connect to MSSQL Server ('hostname') : " . $last();
    }
    else if($conn){
        //echo $strerr="connection established";
    }
    $db = $db_connect('empkonnect_web') or die("Error selecting the database");

    $pa = "";
    $opt =  "";


}


//$conn = mssql_connect('172.16.30.4','empkonnect','P3P51#@634');
//
////var_dump($conn);
//
//if (!$conn)
//    echo $strerr = "ERROR: Failed to connect to MSSQL Server ('hostname') : ".mssql_get_last_message();
//
//$db = mssql_select_db($cfg['database'],$connection) or die("Error selecting the database");

//phpinfo();
//$serverName = "172.29.0.194"; //serverName\instanceName, portNumber (default is 1433)
//$connectionInfo = array( "Database"=>"demo_web", "UID"=>"mypay", "PWD"=>"B@as#382K");
//$conn = sqlsrv_connect( $serverName, $connectionInfo);
//
//if( $conn ) {
//  //  echo "Connection established.<br />";
//}else{
////    echo "Connection could not be established.<br />";
//    die( print_r( sqlsrv_errors(), true));
//}
//
//$sql="select * from hrdmast ";
//$query=sqlsrv_query($conn,$sql);
//
//while($row=sqlsrv_fetch_array($query)){
//    echo $row['Emp_Code']."<br>";
//}
//$serverName = "HIMANSHU"; //serverName\instanceName, portNumber (default is 1433)
//$connectionInfo = array( "Database"=>"empkonnect1", "UID"=>"sa", "PWD"=>"a");
//$conn = sqlsrv_connect( $serverName, $connectionInfo);
//////
//if( $conn ) {
//////    //echo "Connection established.<br />";
//}else{
//////    //echo "Connection could not be established.<br />";
//    die( print_r( sqlsrv_errors(), true));
//}

//$sql="select * from hrdmast ";
//$query=sqlsrv_query($conn,$sql);
//
//while($row=sqlsrv_fetch_array($query)){
//    echo $row['Emp_Code']."<br>";
//}

date_default_timezone_set('Asia/Kolkata');
?>
