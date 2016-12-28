<?php
include ('../../db_conn.php');
include ('../../configdata.php');
include ('../../Attendance/Events/emp_attendance.php');
//echo $_POST['type'] ;
//print_r(getAttendance('10','20','08','2016','10910'));
if($_POST['type']=="init"){
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
    elseif ($pre=='COMP'){
        $col_name=$pre.'_NAME' ;
        $col_status='Comp_status';
        $col_code=$pre."_CODE";
        $col_id=$pre."ID";    }
    else{
        $col_name=$pre.'_Name' ;
        $col_status=$pre.'_status';
        $col_code=$pre."_code";
        $col_id=$pre."ID";
    }
    ?>
       <?php
        $sql = "SELECT $col_code,$col_id,$col_name,$col_status FROM $tablename ";
        $resultq=query($query,$sql,$pa,$opt,$ms_db);
        //$list=1;
        while( $row = $fetch($resultq)) {
            ?>
            <option value="<?php echo $row[1] ?>">
                <?php echo $row[2].'('.$row[0].')'; ?>
            </option>
        <?php
            //$list++ ;
        }
        //echo $list;
        ?>
    <?php
}
if($_POST['type'] == "transReport"){
    $leaveType = $_POST['leaveType'];
    $leaveStatus = $_POST['leaveStatus'];
    $fDate = $_POST['fDate'];
    $tDate = $_POST['tDate'];
    $empName = implode(',',$_POST['empName']);
    //print_r($empName);
    $sql="select * from Leave";
    if($leaveType == '' && $leaveStatus == '' && $fDate == '' && $tDate == '' && $empName == '')
    {
        $sql.="where ";
    }
    else if ($leaveType == '' && $leaveStatus == '' && $fDate == '' && $tDate == '' )
    {
        $sql.=" where CreatedBy IN ($empName)";
    }
    else if ($leaveType == '' && $leaveStatus == '' && $fDate == '' && $tDate == '' )
    echo "<table class='table table-striped table-bordered table-hover' id='sample_1'>
        <thead>
            <tr>
                <th>Employee Name</th>
                <th>Employee Code</th>
                <th>Leave Type</th>
                <th>Leave Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>";
    
    $res=query($query,$sql,$pa,$opt,$ms_db);
    while ($row = $fetch($res)){
        echo"<tr>
                <td></td>
                <td>".$row['CreatedBy']."</td>
                <td>".$row['LvType']."</td>
                <td>".$row['status']."</td>
                <td>".$row['updation_date']."</td>
                </tr>";
            }
            echo "</tbody>
            </table>";
 
}
if($_POST['type'] == "summaryReport"){
    echo $fDate = $_POST['fDate'];
    $tDate = $_POST['tDate'];
    $empName = implode(',',$_POST['empName']);
    $scomp = implode(',',$_POST['scomp']);
    $sbus = implode(',',$_POST['sbus']);
    $ssubbus = implode(',',$_POST['ssubbus']);
    $sloc = implode(',',$_POST['sloc']);
    $swloc = implode(',',$_POST['swloc']);
    $sfunc = implode(',',$_POST['sfunc']);
    $ssubfunc = implode(',',$_POST['ssubfunc']);
    $scost = implode(',',$_POST['scost']);
    $sproc = implode(',',$_POST['sproc']);
    $sgrade = implode(',',$_POST['sgrade']);
    $sdes = implode(',',$_POST['sdes']);
    //print_r($empName);
    $sql="select * from CAttendanceqry";
    if($fDate == '' && $tDate == '' && $empName == '')
    {
        $sql.="where ";
    }
    else if ($fDate == '' && $tDate == '' )
    {
        $sql.=" where CreatedBy IN ($empName)";
    }
    else if ($fDate == '' && $tDate == '' )
    echo "<table class='table table-striped table-bordered table-hover' id='sample_1'>
        <thead>
            <tr>
                <th>Employee Name</th>
                <th>Employee Code</th>
                
            </tr>
        </thead>
        <tbody>";
    
    $res=query($query,$sql,$pa,$opt,$ms_db);
    while ($row = $fetch($res)){
        echo"<tr>
                <td></td>
                <td>".$row['CreatedBy']."</td>
                <td>".$row['LvType']."</td>
                <td>".$row['status']."</td>
                <td>".$row['updation_date']."</td>
                </tr>";
            }
            echo "</tbody>
            </table>";
 
}
?>