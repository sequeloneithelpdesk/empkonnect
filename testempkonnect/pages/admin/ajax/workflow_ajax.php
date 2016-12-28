<?php
include('../../db_conn.php');
include('../../configdata.php');
if($_GET['pagetype']=='workflow') {

    $datalevel =  $_POST['mydata'] ;
    $datalevel2 = newdatawork($datalevel);
    echo $newdata=json_encode($datalevel2);//save  $newdata
    if($_POST['workCode'] !=""  && $_POST['workName'] !=""){
       if($_POST['approvingMethod'] !="automatic") {
    $level = implode(",", $_POST['level']);
    $dayno = implode(",", $_POST['dayno']);
    $approver = implode(",", $_POST['approver']);
   echo $sqlwf = "INSERT INTO Workflow(WCode,WFName,ForMenu,WFFor,WEvents,AppMethod,LevelNo,NoDays,Approver) values
    ('$_POST[workCode]', '$_POST[workName]','$newdata','$_POST[workflowMethod]','$_POST[event]','$_POST[approvingMethod]','$level','$dayno','$approver')";
}
    else{
        $sqlwf = "INSERT INTO Workflow(WCode,WFName,ForMenu,WFFor,WEvents,AppMethod) values
    ('$_POST[workCode]','$_POST[workName]','$newdata','$_POST[workflowMethod]','$_POST[event]','$_POST[approvingMethod]')";

    }


    $resultq=query($query,$sqlwf,$pa,$opt,$ms_db);
    if($resultq){
        echo "success";
    }else{
        echo "error";
    }

}}
else if($_GET['pagetype']=='workflowAtt')
{
    $eventval = $_POST['eventval'];
    $queryatt = "SELECT * from LOVMast where LOV_Field='$eventval'";
    $resultq=query($query,$queryatt,$pa,$opt,$ms_db);
    echo ' <option value="" selected >Select Event</option><option value="ALL">Select All Event</option>';
    while( $row = $fetch($resultq)) {

        echo'<option value="' . $row['LOV_Text'] . '">';
        echo $row['LOV_Text'];
        echo '</option>';
    }
}
else{
    $approver = $_POST['approver'];
    $a= explode(',',$approver);
    $qapp = implode("','",$a);
    echo $comma_separated = "'".$qapp."'";

    $queryapp = "SELECT * from LOVMast where LOV_Text  NOT IN ($comma_separated) AND LOV_Field='Profile'";
    $resultq=query($query,$queryapp,$pa,$opt,$ms_db);
    echo '<option value="">Select</option>';
    while( $row = $fetch($resultq)) {

        echo'<option value="' . $row['LOV_Text'] . '">';
        echo $row['LOV_Text'];
        echo '</option>';
    }
}


function newdatawork($data){

    $newArray = array();
    $y = 0;
    for($i = 0; $i < count($data); $i++){
        if(@array_key_exists('state',$data[$i])  && $data[$i]['state']['selected']=="show"){
            $newArray[$y]['text'] = $data[$i]['text'];
            //$newArray[$y]['count']=count($data);

            if(array_key_exists('children',$data[$i]) && count($data[$i]['children']) > 0){
                $z=0;
                for($j=0;$j< count($data[$i]['children']) ;$j++ ) {

                    if ($data[$i]['children'][$j]['state']['selected']=='show') {
                        $newArray[$y]['children'][]['id'] = $data[$i]['children'][$j]['id'];
                        //$newArray[$y]['children'][$z]['text'] = $data[$i]['children'][$j]['text'];

                        //$newArray[$y]['children'][]['count'] = count($data[$i]['children']);
                    }
                    $z++;
                }
            }
            $y++;
        }

    }
    return $newArray;
}


//$queryemp = "SELECT DISTINCT(Emp_FName) from HrdMastQry";
//$resultq=query($query,$queryemp,$pa,$opt,$ms_db);
//echo '<option value="">Select Employee</option>';
//while( $row = $fetch($resultq)) {
//    echo'<option value="' . $row['Emp_FName'] . '">';
//    echo $row['Emp_FName'];
//    echo '</option>';
//}


?>