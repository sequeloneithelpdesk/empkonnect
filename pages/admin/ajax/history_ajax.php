<?php
include("../../db_conn.php");
include('../../configdata.php');

$paramValue = $_POST['paramValue'];
$startdate = $_POST['startdate'];
$enddate = $_POST['enddate'];
$s = strtotime($startdate);
$newstart_date = date('Y-m-d',$s);
$e = strtotime($enddate);
$newend_date = date('Y-m-d',$e);
$p = explode(',',$paramValue);
$param = array();

for($i=0;$i<count($p);$i++)
{
    $param[] = $p[$i];
}
$paramstring = implode(",",$param);
echo '<table class="table table-striped table-bordered table-hover" id="sample_editable_1">
                <thead>
                <tr>';
                for($i=0;$i<count($param);$i++){
                    echo '<th>'; echo str_replace('_', ' ', $param[$i]);
                    echo '</th>';
                }
                echo '</tr>
                </thead>';
echo '<tbody>';

$query_t = "SELECT $paramstring FROM HrdTran where Emp_Code='100010' AND (convert(Date,Trn_WEF,101) >= '$newstart_date') AND (convert(Date,Trn_WEF,101) <= '$newend_date') ORDER By UpdatedOn ";
$result=query($query,$query_t,$pa,$opt,$ms_db);

if($num($result)) {

while ($row = $fetch($result)) {
    echo '<tr>';
    for($i=0;$i<count($param);$i++){

        if(($i==count($param)-3) || ($i==count($param)-2)){

            echo '<td>'; $thedate =$row[$param[$i]]; echo $thedate->format("d/m/y"); echo '</td>';
        }
        
        else{
            echo '<td>'; echo $row[$param[$i]];
            echo '</td>';
        }

    }
    echo'</tr>';
}}
else{
    echo "failure";
}

