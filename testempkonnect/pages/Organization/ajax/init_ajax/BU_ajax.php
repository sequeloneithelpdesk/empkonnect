<?php

error_reporting();
ini_set("display_errors", 1);
include('../../../db_conn.php');
include('../../../configdata.php');
// $comp_code="ABC";
$type=$_POST['type'];
if($type=="init"){
    $tablename=$_POST['table'];
    $pre=$_POST['pre'];
    $status=$_POST['status'];
    $name=$_POST['name'];
    if($pre=='buss' || $pre=='subBuss'){
        $col_name=$pre.'Name' ;
        $col_status='status';
        $col_code=$pre."_code";
        $col_id=$pre."ID";
    }
    elseif($pre=='TYPE' || $pre=='FUNCT' || $pre=='SubFunct' || $pre=='Country'|| $pre=='City'){
        $col_name=$pre.'_Name' ;
        $col_status='status';
        $col_code=$pre."_code";
        $col_id=$pre."ID";
    }
    elseif ($pre=='H'){
        $col_name=$pre.'desc' ;
        $col_status=$pre.'_status';
        $col_code=$pre."code";
        $col_id="HolidayID";
    }
    elseif ($pre=='WLoc'){
        $col_name=$pre.'_Name' ;
        $col_status='status';
        $col_code=$pre."_code";
        $col_id="WorkLocID";
    }
    else{
        $col_name=$pre.'_Name' ;
        $col_status=$pre.'_status';
        $col_code=$pre."_code";
        $col_id=$pre."ID";
    }
    ?>
    <thead>
    <tr>
        <th><?php  echo$name; ?> Name </th>
        <th><?php  echo$name; ?> Code</th>
        <th>Status</th>
        <th>Action</th></tr>
    </thead>
    <tbody >



        <?php
        echo  $sql = "SELECT $col_code,$col_id,$col_name,$col_status FROM $tablename ";
        $resultq=query($query,$sql,$pa,$opt,$ms_db);
        //$list=1;
        while( $row = $fetch($resultq)) {
            ?>
            <tr class='odd gradeX'>
                <td><?php echo $row[2]; ?></td>
                <td><?php echo$row[0]; ?></td>

                <td> <input type="button" id="stid" class="btn btn-default"
                            value='<?php if($row[3]=="1"){ echo"Inactive"; }else{ echo"Active"; } ?>'
                            onclick="BU.changestatus('<?php echo$tablename; ?>','<?php echo$pre; ?>','stid','<?php echo$row[3] ; ?>','<?php echo $row[1]; ?>','<?php echo$name; ?>')" /> </td>
                <td style='white-space: nowrap'>
                    <?php if($row[3]=="1") {  ?>
                    <a class="btn" onclick="myFunction('<?php echo $row[1]; ?>')">Edit</a>
                <?php  }else { ?>
                    <a class="btn" onclick="alert('Please make active before edit.');" >Edit </a>
                    <?php } ?>
                </td></tr>
        <?php
            //$list++ ;
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
    if($pre=='buss' || $pre=='subBuss'){
        $col_name=$pre.'Name' ;
        $col_status='status';
        $col_code=$pre."_code";
        $col_id=$pre."ID";
    }
    elseif($pre=='TYPE' || $pre=='FUNCT' || $pre=='SubFunct' || $pre=='Country'|| $pre=='City' ){
        $col_name=$pre.'_Name' ;
        $col_status='status';
        $col_code=$pre."_code";
        $col_id=$pre."ID";
    }
    elseif ($pre=='H'){
        $col_name=$pre.'desc' ;
        $col_status=$pre.'_status';
        $col_code=$pre."code";
        $col_id="HolidayID";
    }
    elseif ($pre=='WLoc'){
        $col_name=$pre.'_Name' ;
        $col_status='status';
        $col_code=$pre."_code";
        $col_id="WorkLocID";
    }
    else{
        $col_name=$pre.'_Name' ;
        $col_status=$pre.'_status';
        $col_code=$pre."_code";
        $col_id=$pre."ID";
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

