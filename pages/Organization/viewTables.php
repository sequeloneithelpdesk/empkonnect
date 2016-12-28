<?php
include ('../db_conn.php');
include ('../configdata.php');
    include ("../db_conn.php ");
    if(isset($_GET['pagetype']) && $_GET['pagetype']=='viewFunction'){
    $sql = "SELECT * FROM functMast where status=1";
    $resultq=sqlsrv_query($conn,$sql);
    $num=sqlsrv_num_rows($resultq);
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
    $list="";
    while($row = $result->fetch_assoc()) {
    $id=$row['id'];
    $list.= "<tr class='odd gradeX'><td>" . $row['functCode']. "</td><td>" . $row['functName']. "</td><td>" . $row['functType']. "</td><td>" . $row['functHead'] . "</td><td><button class='btn'>Details</button></td><td style='white-space: nowrap'><a class='btn' data-toggle='modal' href='#large1' onclick=\"myFunction('$id')\">Edit</a></td></tr>";
    }
    echo $list;

    } else {
    echo "No results to display";
    } 
    }
if(isset($_GET['pagetype']) && $_GET['pagetype']=='viewGrades'){
  $sql = "SELECT * FROM GrdMast where status=1";
    $$result = query($query,$sqlq,$pa,$opt,$ms_db);
        $list="";
        while($row = $fetch($result)) {
            $list.= "<tr class='odd gradeX'><td>" . $row['GRD_CODE']. "</td><td>" . $row['GRD_NAME']. "</td><td>" . $row['grdUnder']. "</td><td>" . $row['tableType'] . "</td><td><button class='btn'>Details</button></td><td style='white-space: nowrap'><a class='btn' data-toggle='modal' href='#large'>Edit</a> </td></tr>";
        }
        echo $list;
      
    
} 

?>
							
