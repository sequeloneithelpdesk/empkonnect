<?php
include('../../db_conn.php');
include('../../configdata.php');
@session_start();

//echo $tblName;
if(isset($_GET['type']) && $_GET['type']=='defaultValue') {

    $tblName = $_POST['tblName'];
    $data=$_POST['data'];
    //print_r($data);
    $list = "";
    for($i=0;$i<count($data);$i++){
        if($data[$i]['id']== $tblName) {
            for($a=0;$a<count($data[$i]['children']);$a++) {
                $list .= "<input type='checkbox' onclick='workflow.checkevent(this);' class='col-md-2 checkboxes' id='" . $data[$i]['children'][$a]['id'] . "' value='" . $data[$i]['children'][$a]['id'] . "' ";
                if($data[$i]['children'][$a]['state']['selected']=="show"){
                    $list.=" checked ";
                }
                $list.="name='" . $data[$i]['children'][$a]['id'] . "'/>
        <label for='" . $data[$i]['children'][$a]['id'] . "' class='col-md-10'>" . $data[$i]['children'][$a]['text'] . "</label>";
            }
        }

    }

        echo $list;

}

else if(isset($_GET['type']) && $_GET['type']=='showdata') {

    $childName = $_POST['childval'];
    $tblName = $_POST['tblName'];
    $data=$_POST['data'];
    for($i=0;$i<count($data);$i++){
        if($data[$i]['id']== $tblName) {
            $data[$i]['state']['selected']= "show" ;
            for($a=0;$a<count($data[$i]['children']);$a++) {
                if($data[$i]['children'][$a]['id']== $childName){
                    $data[$i]['children'][$a]['state']['selected']= "show" ;
                }
            }
        }

    }
    echo json_encode($data) ;

}

else if(isset($_GET['type']) && $_GET['type']=='hidedata') {

    $childName = $_POST['childval'];
    $tblName = $_POST['tblName'];
    $data=$_POST['data'];
    for($i=0;$i<count($data);$i++){
        if($data[$i]['id']== $tblName) {
            $z=count($data[$i]['children']) ;
            for($a=0;$a<count($data[$i]['children']);$a++) {

                if($data[$i]['children'][$a]['id']== $childName){
                    $data[$i]['children'][$a]['state']['selected']= true ;
                }
                if($data[$i]['children'][$a]['state']['selected']== "true"){
                    $z=$z-1;
                }

            }
            if($z==0){
                $data[$i]['state']['selected']= true ;
            }
        }

    }
    echo json_encode($data) ;

}

else if(isset($_GET['type']) && $_GET['type']=='finaldata') {

    $newdata=$_POST['data'];
//
//    $newdata=newdatawork($data1);
//    print_r($newdata);
    $list='<ul>';
    for($i=0;$i<count($newdata);$i++) {
        if ($newdata[$i]['state']['selected'] == "show") {
            $list .= "<li>" . $newdata[$i]['text'];
            if (count($newdata[$i]['children']) > 0 ) {
                $list .= "<ul>";
                for ($a = 0; $a < count($newdata[$i]['children']); $a++) {
                    if ($newdata[$i]['children'][$a]['state']['selected'] == "show") {
                        $list .= "<li>" . $newdata[$i]['children'][$a]['text'] . "</li>";
                    }
                }
                $list .= "</ul>";
            }
            $list .= "</li>";
        }
    }
    $list.="</ul>";

    echo $list;



}

function newdatawork($data){

    $newArray = array();
    $y = 0;
    for($i = 0; $i < count($data); $i++){
        if($data[$i]['state']['selected']=="show"){
            $newArray[] = $data[$i];
        }else{
            if(array_key_exists('children',$data[$i]) && count($data[$i]['children']) > 0){
                $data[$i]['children'] = newdata($data[$i]['children']);
                if(array_key_exists('children',$data[$i]) && count($data[$i]['children'])){
                    $newArray[] = $data[$i];
                }
            }
        }
    }
    return $newArray;
}
?>