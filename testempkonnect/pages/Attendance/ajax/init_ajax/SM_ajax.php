<?php

error_reporting();

ini_set("display_errors", 1);
date_default_timezone_set("Asia/Kolkata");
include('../../../db_conn.php');
include('../../../configdata.php');

function getDiffTime($OutTime,$InTime){
    if($OutTime<$InTime){
        $flag =24;

        $totaltime = round(abs((strtotime($OutTime)+ 86400) - strtotime($InTime)) / 60,2);
        $hours = intval($totaltime/60);
        $minutes = $totaltime - ($hours * 60);
        $hoursminutes = sprintf("%02d",$hours).":".sprintf("%02d",$minutes).":00";
        return $hoursminutes;
    }
    else{
        $totaltime = round(abs(strtotime($OutTime) - strtotime($InTime)) / 60,2);
        $hours = intval($totaltime/60);
        $minutes = $totaltime - ($hours * 60);
        $hoursminutes = sprintf("%02d",$hours).":".sprintf("%02d",$minutes).":00";
        return $hoursminutes;
    }

}

// $comp_code="ABC";
$type=$_POST['type'];
if($type=="init"){
    $tablename=$_POST['table'];
    $pre=$_POST['pre'];
    $status=$_POST['status'];
    $name=$_POST['name'];
    if($pre=='Shift'){
        $col_name=$pre.'_Name' ;
        $col_status='shift_status';
        $col_code=$pre."_Code";
        $col_id=$pre."MastId";
        $col_sstarttime=$pre."_From";
        $col_sendtime=$pre."_To";

    }
    if($pre=='ShiftPattern'){
        $col_name=$pre.'_Name' ;
       // $col_status='status';
        $col_code=$pre."_Code";
       $col_id=$pre."Mastid";


    }
    elseif($pre=='panelty'){
        $col_name=$pre.'_Name' ;
        $col_status='status';
        $col_code=$pre."_code";
        $col_id=$pre."ID";
    }

    ?>
    <thead>
    <?php if($pre=='ShiftPattern'){?>
        <tr>
            <th><?php  echo$name; ?> Name </th>
            <th><?php  echo$name; ?> Code</th>
           <th>Weekly Off </th>
            <th>Action</th></tr>

    <?php
    }
    else{?>
        <tr>
            <th><?php  echo$name; ?> Name </th>
            <th><?php  echo$name; ?> Code</th>
            <th><?php  echo$name; ?> Start Time</th>
            <th><?php  echo$name; ?> End Time</th>
            <th>Total Time(Hrs.) </th>
            <th>Status</th>
            <th>Action</th></tr>
   <?php }?>

    </thead>
    <tbody >



    <?php
   if($pre=='ShiftPattern'){

       $weekname=array("Mon"=>"1","Tue"=>"2","Wed"=>"3","Thur"=>"4","Fri"=>"5","Sat"=>"6","Sun"=>"7");
       $sql = "SELECT $col_code,$col_id,$col_name,WeeklyOff1,WeeklyOff2,WeeklyOff3,WeeklyOff4,WeeklyOff5 FROM $tablename ";
       $resultq=query($query,$sql,$pa,$opt,$ms_db);
       //$list=1;
       while( $row = $fetch($resultq)) {

           ?>
           <tr class='odd gradeX'>

               <td><?php echo $row[2]; ?></td>
               <td><?php echo $row[0]; ?></td>
               <td>1 Week Off -  <?php $w1 = explode(',',$row[3]);
                   $x=0;
                      for($i=0;$i<count($w1);$i++){
                          if($x!=0){
                              echo ",";
                          }
                          echo $key = array_search($w1[$i],$weekname);
                          if($key !=''){
                              $x++;
                          }

                      }

                       ?> <br>
                   2 Week Off -  <?php $w1 = explode(',',$row[4]);
                   $y=0;
                   for($i=0;$i<count($w1);$i++){
                       if($y!=0){
                           echo ",";
                       }
                       echo $key = array_search($w1[$i],$weekname);
                       if($key !=''){
                           $y++;
                       }

                   }

                   ?>  <br>
                   3 Week Off - <?php $w1 = explode(',',$row[4]);
                   $z=0;
                   for($i=0;$i<count($w1);$i++){
                       if($z!=0){
                           echo ",";
                       }
                       echo $key = array_search($w1[$i],$weekname);
                       if($key !=''){
                           $z++;
                       }


                   }

                   ?> <br>
                   4 Week Off - <?php $w1 = explode(',',$row[5]);
                   $b=0;
                   for($i=0;$i<count($w1);$i++){
                       if($b!=0){
                           echo ",";
                       }
                       echo $key = array_search($w1[$i],$weekname);
                       if($key !=''){
                          $b++;
                       }

                   }

                   ?> <br>
                   5 Week Off - <?php $w1 = explode(',',$row[6]);
                   $a=0;
                   for($i=0;$i<count($w1);$i++){
                        if($a!=0){
                            echo ",";
                        }
                       echo $key = array_search($w1[$i],$weekname);
                       if($key !=''){
                          $a++;
                       }

                   }

                   ?> </td>
              <!-- <td> <input type="button" id="stid" class="btn btn-default"
                           value='<?php if($row[3]=="1"){ echo"Inactive"; }else{ echo"Active"; } ?>'
                           onclick="SM.changestatus('<?php echo$tablename; ?>','<?php echo$pre; ?>','stid','<?php echo$row[3] ; ?>','<?php echo $row[1]; ?>','<?php echo$name; ?>')" /> </td>

               <td style='white-space: nowrap'>
                   <?php if($row[3]=="1") {  ?>
                       <a class="btn" onclick="myFunction('<?php echo $row[1]; ?>')">Edit</a>
                   <?php  }else { ?>
                       <a class="btn" onclick="alert('Please make active before edit.');" >Edit </a>
                   <?php } ?>
               </td>
               -->
               <td style='white-space: nowrap'>
                            <a class="btn" onclick="myFunction('<?php echo $row[1]; ?>')">Edit</a>

               </td>
           </tr>
           <?php
           //$list++ ;
       }
   }
    else{
          $sql = "SELECT $col_code,$col_id,$col_name,$col_status,cast($col_sstarttime as varchar(8)) As $col_sstarttime,cast($col_sendtime as varchar(8)) As $col_sendtime  FROM $tablename ";
        $resultq=query($query,$sql,$pa,$opt,$ms_db);
        //$list=1;
        while( $row = $fetch($resultq)) {
            ?>
            <tr class='odd gradeX'>
                <td><?php echo $row[2]; ?></td>
                <td><?php echo$row[0]; ?></td>
                <td><?php echo $row[4]; ?></td>
                <td><?php echo $row[5]; ?></td>
                <td><?php echo getDiffTime($row[5],$row[4]);  ?></td>

                <td> <input type="button" id="stid" class="btn btn-default"
                            value='<?php if($row[3]=="1"){ echo"Inactive"; }else{ echo"Active"; } ?>'
                            onclick="SM.changestatus('<?php echo$tablename; ?>','<?php echo$pre; ?>','stid','<?php echo$row[3] ; ?>','<?php echo $row[1]; ?>','<?php echo$name; ?>')" /> </td>
                <td style='white-space: nowrap'>
                    <?php if($row[3]=="1") {  ?>
                        <a class="btn" onclick="myFunction('<?php echo $row[1]; ?>')">Copy</a>
                    <?php  }else { ?>
                        <a class="btn" onclick="alert('Please make active before edit.');" >Copy </a>
                    <?php } ?>/<a class="btn" onclick="myFunction('View,<?php echo $row[1]; ?>')">View</a>
                </td></tr>
            <?php
            //$list++ ;
        }
    }

    //echo $list;
    ?>

    </tbody>

    <?php
}

elseif($type=="editstatus"){

    $status=$_POST['status'];
    $id=$_POST['id'];
    $tablename=$_POST['table'];
    $pre=$_POST['pre'];
    if($pre=='Shift'){
        $col_name=$pre.'_Name' ;
        $col_status='shift_status';
        $col_code=$pre."_Code";
        $col_id=$pre."MastId";
    }
    elseif($pre=='ShiftPattern'){
        $col_name=$pre.'_Name' ;
        $col_status='status';
        $col_code=$pre."_Code";
        $col_id=$pre."Mastid";
    }



    if($status=="1"){
        $status1="0";
    }
    else{
        $status1="1";
    }

//echo $data;
    $sql1="update $tablename set $col_status='$status1' where $col_id='$id' ";
    $result1 = query($query,$sql1,$pa,$opt,$ms_db);

    if($result1){
        echo "1" ;
    }
    else{
        echo "2";
    }


}

?>

