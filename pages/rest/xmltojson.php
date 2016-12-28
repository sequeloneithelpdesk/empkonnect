



<?php
$xmlstring="<?xml version=\"1.0\" ?>
<DocumentElement>
    <row>
        <Header>
            <empCode> </empCode>
            <pwd>EDP</pwd>
            <cid>TESTG4S</cid>
            <WSType>WSDESIGMASTER</WSType>
        </Header>
    </row>
    <row>
    <empCode>emp987 </empCode>
    <empFName>Kajal</empFName>
    <oEmail>kajal@abc.com</oEmail>
    <statusCode>01</statusCode>
    </row>
    <row>
    <empCode>emp986 </empCode>
    <empFName>Kajal2</empFName>
    <oEmail>kajal2@abc.com</oEmail>
    <statusCode>01</statusCode>
    </row>
</DocumentElement>";
$xml = simplexml_load_string($xmlstring);
$json = json_encode($xml);
$array = json_decode($json,TRUE);

$xml1 = 'DocumentElement' ;
//$newxml=assocArrayToXML($xml1,$array);

$xml_data = new SimpleXMLElement('<?xml version="1.0"?><data></data>');

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

echo '<pre>';
echo htmlspecialchars($Serializer->getSerializedData());
echo '</pre>';


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


    $sql.=" ) ";

    echo $sql;
}



//$arr=json_decode(xml2js($xml),1);
//
//print_r($arr['DocumentElement'][0]['row'][0]) ;
//
//
//print_r($arr['DocumentElement'][0]['row'][1]) ;
//
//
//
//function xml2js($xmlnode) {
//    $root = (func_num_args() > 1 ? false : true);
//    $jsnode = array();
//
//    if (!$root) {
//        if (count($xmlnode->attributes()) > 0){
//            $jsnode["$"] = array();
//            foreach($xmlnode->attributes() as $key => $value)
//                $jsnode["$"][$key] = (string)$value;
//        }
//
//        $textcontent = trim((string)$xmlnode);
//        if (count($textcontent) > 0)
//            $jsnode["text"] = $textcontent;
//
//        foreach ($xmlnode->children() as $childxmlnode) {
//            $childname = $childxmlnode->getName();
//            if (!array_key_exists($childname, $jsnode))
//                $jsnode[$childname] = array();
//            array_push($jsnode[$childname], xml2js($childxmlnode, true));
//        }
//        return $jsnode;
//    } else {
//        $nodename = $xmlnode->getName();
//        $jsnode[$nodename] = array();
//        array_push($jsnode[$nodename], xml2js($xmlnode, true));
//        return json_encode($jsnode);
//    }
//}




?>