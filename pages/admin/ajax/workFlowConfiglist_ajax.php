<?php
include('../../db_conn.php');
include('../../configdata.php');
@session_start();
 $sql="Select * from emphrdmast";
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