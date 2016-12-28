<?php

// Include confi.php
include('../db_conn.php');
//include('confi.php');

if($_SERVER['REQUEST_METHOD'] == "POST"){
    // Get data
       $postdata = file_get_contents("php://input");
  // $name = isset($_POST['name']) ? $_POST['name'] : "";
    //$email = isset($_POST['email']) ? $_POST['email'] : "";
    //$code = isset($_POST['code']) ?$_POST['code'] : "";
    //$status = isset($_POST['status']) ? $_POST['status'] : "";

    // Insert data into data base
    //$sql = "INSERT INTO emphrdmast ( empCode,empFName, oEmail, statusCode) VALUES (  '$code', '$name', '$email','$status')";
    $xml = simplexml_load_string($postdata);
    $json = json_encode($xml);
    $array = json_decode($json,TRUE);
//print_r($array['row']);
    $arrdata=array_slice($array['row'],1);
//print_r($arrdata);
    foreach($arrdata as $key => $value){
        $sql="insert into hrdmast ( ";

        $a=0;
        foreach($value as $i=> $v){
            if($a > 0){
                $sql .= ",";
            }
            $sql.="$i";
            $a++;
        }
        $sql.=" ) values (" ;

        $b=0;
        foreach($value as $i=> $v){
            if($b > 0){
                $sql .= ",";
            }
            $sql.="'$v'";
            $b++;
        }
//$value[$key][$r][]

        $sql.=" ) ";
      //echo $sql;
        $qur = sqlsrv_query($conn,$sql);
        if($qur){
            $json = array("status" => 1, "msg" => "Done User added!");
        }
        else{
            $json = array("status" => 0,"id"=> '' , "msg" => sqlsrv_errors(SQLSRV_ERR_ERRORS));

        }
    }

    //$qur = sqlsrv_query($conn,$sql);

}else{
    $json = array("status" => 0, "msg" => "Request method not accepted");
}

//@sqlsrv_close($conn);

/* Output header */
header('Content-type: application/json');
$json= json_encode($json);

require_once '../XML_S/XML/Serializer.php';

$data = json_decode($json, true);

// An array of serializer options
$serializer_options = array (
    'addDecl' => TRUE,
    'encoding' => 'ISO-8859-1',
    'indent' => ' ',
    'rootName' => 'DocumentElement',
    'mode' => 'simplexml'
);

$Serializer = new XML_Serializer($serializer_options);
$status = $Serializer->serialize($data);

if (PEAR::isError($status)) die($status->getMessage());

//echo '<pre>';
echo $Serializer->getSerializedData()  ;
//echo '</pre>';


?>