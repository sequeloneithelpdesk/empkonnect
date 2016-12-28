<?php
include('../../db_conn.php');
include('../../configdata.php');
@session_start();
$data=$_POST['data'];

$sql="Select * from hrdmastQry";

$datalevel =  $_POST['data'];

$sql.=" where ";
for ($i=0;$i<count($datalevel);$i++){
    if($datalevel[$i]['text']=="Business Unit"){
        for($b=0;$b<count($datalevel[$i]['children']);$b++) {
            $sql .= " BussCode='" . $datalevel[$i]['children'][$b]['id']."'";
            if($b<count($datalevel[$i]['children'])-1){
                $sql.= " or ";
            }
        }
    }
    if($datalevel[$i]['text']=="Location"){
        $sql.= " and ";
        for($l=0;$l<count($datalevel[$i]['children']);$l++) {
            $sql .= " loc_Code='" . $datalevel[$i]['children'][$l]['id']."'";
            if($l<count($datalevel[$i]['children'])-1){
                $sql.= " or ";
            }
        }

    }

    if($datalevel[$i]['text']=="Working Location"){
        $sql.= " and ";
        for($wl=0;$wl<count($datalevel[$i]['children']);$wl++) {
            $sql .= " WLOC_CODE='" . $datalevel[$i]['children'][$wl]['id']."'";
            if($wl<count($datalevel[$i]['children'])-1){
                $sql.= " or ";
            }
        }

    }
    if($datalevel[$i]['text']=="Function"){
        $sql.= " and ";
        for($f=0;$f<count($datalevel[$i]['children']);$f++) {
            $sql .= " FUNCT_CODE='" . $datalevel[$i]['children'][$f]['id']."'";
            if($f<count($datalevel[$i]['children'])-1){
                $sql.= " or ";
            }
        }

    }
    if($datalevel[$i]['text']=="Sub Function"){
        $sql.= " and ";
        for($sf=0;$sf<count($datalevel[$i]['children']);$sf++) {
            $sql .= " SFUNCT_CODE='" . $datalevel[$i]['children'][$sf]['id']."'";
            if($sf<count($datalevel[$i]['children'])-1){
                $sql.= " or ";
            }
        }

    }
    if($datalevel[$i]['text']=="Grade"){
        $sql.= " and ";
        for($g=0;$g<count($datalevel[$i]['children']);$g++) {
            $sql .= " GRD_CODE='" . $datalevel[$i]['children'][$g]['id']."'";
            if($g<count($datalevel[$i]['children'])-1){
                $sql.= " or ";
            }
        }

    }
    if($datalevel[$i]['text']=="Employee Type"){
        $sql.= " and ";
        for($et=0;$et<count($datalevel[$i]['children']);$et++) {
            $sql .= " TYPE_CODE='" . $datalevel[$i]['children'][$et]['id']."'";
            if($et<count($datalevel[$i]['children'])-1){
                $sql.= " or ";
            }
        }

    }
    if($datalevel[$i]['text']=="Level"){
        $sql.= " and ";
        for($lc=0;$lc<count($datalevel[$i]['children']);$lc++) {
            $sql .= " Level_CODE='" . $datalevel[$i]['children'][$lc]['id']."'";
            if($lc<count($datalevel[$i]['children'])-1){
                $sql.= " or ";
            }
        }

    }
    if($datalevel[$i]['text']=="Process"){
        $sql.= " and ";
        for($pr=0;$pr<count($datalevel[$i]['children']);$pr++) {
            $sql .= " PROC_CODE='" . $datalevel[$i]['children'][$pr]['id']."'";
            if($pr<count($datalevel[$i]['children'])-1){
                $sql.= " or ";
            }
        }

    }
    if($datalevel[$i]['text']=="Employee"){
        $sql.= " and ";
        for($pr=0;$pr<count($datalevel[$i]['children']);$pr++) {
            $sql .= " EMP_NAME='" . $datalevel[$i]['children'][$pr]['id']."'";
            if($pr<count($datalevel[$i]['children'])-1){
                $sql.= " or ";
            }
        }

    }

}
$result = query($query,$sql,$pa,$opt,$ms_db);
if ($$num > 0) {
    $list="";
    while($row = $fetch()) {
        $name = $row['empTitle']." ". $row['empFName']." ". $row['empMName']." ".$row['empLName'];
        $list.= "<option value=" . $row['empCode']. ">" . $name . "</option>";
    }
    echo $list;
}

?>