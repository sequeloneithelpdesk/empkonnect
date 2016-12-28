<?php
include ('../../db_conn.php');
include ('../../configdata.php');
include ('../../Attendance/Events/emp_attendance.php');
error_reporting(0);
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
    echo "<table class='table table-striped table-bordered table-hover table2excel' id='sample_1'>
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
    $fDate = $_POST['fDate'];
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
    echo "<table class='table table-striped table-bordered table-hover table2excel' id='sample_1'>
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
if($_POST['type'] == "inoutReport"){
    $fDate = $_POST['fDate'];
    $tDate = $_POST['tDate'];
    $empName = implode(',',$_POST['empName']);
        //print_r($empName);
    $sql="select b.emp_name,a.* from (select EMP_CODE,CONVERT(VARCHAR(5), IN_TIME, 108) as IN_TIME,CONVERT(VARCHAR(5), OUT_TIME, 108) as OUT_TIME,CONVERT(VARCHAR(10), ATTDATE, 105) as ATTDATE from Cattendanceqry where CONVERT(varchar(10),ATTDATE,103) Between '$fDate' and '$tDate' and EMP_CODE IN ($empName)) a join HrdMastqry b on a.EMP_CODE=b.Emp_Code";

    echo "<table class='table table-striped table-bordered table-hover table2excel' id='sample_1'>
        <thead>
            <tr>
                <th>Employee Name</th>
                <th>Employee Code</th>
                <th>Attendance Date</th>
                <th>IN TIME </th>
                <th>OUT TIME </th>
            </tr>
        </thead>
        <tbody>";
    
    $res=query($query,$sql,$pa,$opt,$ms_db);
    while ($row = $fetch($res)){
        echo"<tr>
                <td>".$row['emp_name']."</td>
                <td>".$row['EMP_CODE']."</td>
                <td>".$row['ATTDATE']."</td>
                <td>".$row['IN_TIME']."</td>
                <td>".$row['OUT_TIME']."</td>
                </tr>";
            }
            echo "</tbody>
            </table>";
 
}
if($_POST['type'] == "misReport"){
    $fDate = $_POST['fDate'];
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

    // $sql_f = "select Emp_code from HrdMastqry where COMP_CODE= '$scomp' and BussCode='$sbus' and SUBBuss_Code='$ssubbus' and LOC_CODE='$sloc' and WLOC_CODE='$swloc' and FUNCT_CODE='$sfunc' and SFUNCT_CODE='$ssubfunc' and COST_CODE='$scost' and PROC_CODE='$sproc' and GRD_CODE='$sgrade' and DGS_CODE='$sdes'";
    // $res_f=query($query,$sql_f,$pa,$opt,$ms_db);
    // while ($row_f = $fetch($res_f)){

    // }
    //     //print_r($empName);
    $sql="select b.emp_name,a.* from (select EMP_CODE,CONVERT(VARCHAR(5), IN_TIME, 108) as IN_TIME,CONVERT(VARCHAR(5), OUT_TIME, 108) as OUT_TIME,CONVERT(VARCHAR(10), ATTDATE, 105) as ATTDATE from Cattendanceqry where CONVERT(varchar(10),ATTDATE,103) Between '$fDate' and '$tDate' and EMP_CODE IN ($empName) and (IN_TIME is null or OUT_TIME is null)) a join HrdMastqry b on a.EMP_CODE=b.Emp_Code";

    echo "<table class='table table-striped table-bordered table-hover table2excel' id='sample_1'>
        <thead>
            <tr>
                <th>Employee Name</th>
                <th>Employee Code</th>
                <th>Attendance Date</th>
                <th>IN TIME </th>
                <th>OUT TIME </th>
            </tr>
        </thead>
        <tbody>";
    
    $res=query($query,$sql,$pa,$opt,$ms_db);
    while ($row = $fetch($res)){
        echo"<tr>
                <td>".$row['emp_name']."</td>
                <td>".$row['EMP_CODE']."</td>
                <td>".$row['ATTDATE']."</td>
                <td>".$row['IN_TIME']."</td>
                <td>".$row['OUT_TIME']."</td>
                </tr>";
            }
            echo "</tbody>
            </table>";
 
}
if($_POST['type'] == "lateArrival"){
    $fDate = $_POST['fDate'];
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

    // $sql_f = "select Emp_code from HrdMastqry where COMP_CODE= '$scomp' and BussCode='$sbus' and SUBBuss_Code='$ssubbus' and LOC_CODE='$sloc' and WLOC_CODE='$swloc' and FUNCT_CODE='$sfunc' and SFUNCT_CODE='$ssubfunc' and COST_CODE='$scost' and PROC_CODE='$sproc' and GRD_CODE='$sgrade' and DGS_CODE='$sdes'";
    // $res_f=query($query,$sql_f,$pa,$opt,$ms_db);
    // while ($row_f = $fetch($res_f)){

    // }
    //     //print_r($empName);
    $sql="select b.emp_name,a.* from (select EMP_CODE,CONVERT(VARCHAR(5), IN_TIME, 108) as IN_TIME,CONVERT(VARCHAR(5), OUT_TIME, 108) as OUT_TIME,CONVERT(VARCHAR(10), ATTDATE, 105) as ATTDATE from Cattendanceqry where CONVERT(varchar(10),ATTDATE,103) Between '$fDate' and '$tDate' and EMP_CODE IN ($empName) and (CAST(ShiftMFrom AS time)<= CAST(IN_TIME AS time))) a join HrdMastqry b on a.EMP_CODE=b.Emp_Code";

    echo "<table class='table table-striped table-bordered table-hover table2excel' id='sample_1'>
        <thead>
            <tr>
                <th>Employee Name</th>
                <th>Employee Code</th>
                <th>Attendance Date</th>
                <th>IN TIME </th>
                <th>OUT TIME </th>
            </tr>
        </thead>
        <tbody>";
    
    $res=query($query,$sql,$pa,$opt,$ms_db);
    while ($row = $fetch($res)){
        echo"<tr>
                <td>".$row['emp_name']."</td>
                <td>".$row['EMP_CODE']."</td>
                <td>".$row['ATTDATE']."</td>
                <td>".$row['IN_TIME']."</td>
                <td>".$row['OUT_TIME']."</td>
                </tr>";
            }
            echo "</tbody>
            </table>";
 
}
if($_POST['type'] == "earlyDeparture"){
    $fDate = $_POST['fDate'];
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
    
    $sql = "select b.emp_name,a.* from (select EMP_CODE,CONVERT(VARCHAR(5), IN_TIME, 108) as IN_TIME,CONVERT(VARCHAR(5), OUT_TIME, 108) as OUT_TIME,CONVERT(VARCHAR(10), ATTDATE, 105) as ATTDATE from Cattendanceqry where CONVERT(varchar(10),ATTDATE,103) Between '$fDate' and '$tDate' and";
    if($empName != '' && $scomp == '' && $sbus == '' && $ssubbus == '' && $sloc == '' && $swloc == '' && $sfunc == '' && $ssubfunc == '' && $scost == '' && $sproc == '' && $sgrade == '' && $sdes == '')
    {
        $sql .="EMP_CODE IN ($empName) and (CAST(ShiftMTo AS time)>= CAST(OUT_TIME AS time))) a join EmpNameQry b on a.EMP_CODE=b.Emp_Code";
    }
    else if($empName == '' && $scomp != '' && $sbus == '' && $ssubbus == '' && $sloc == '' && $swloc == '' && $sfunc == '' && $ssubfunc == '' && $scost == '' && $sproc == '' && $sgrade == '' && $sdes == ''){
        // $emp_opt = array();
        // $sql_o = "select emp_code from HrdMastQry where COMP_CODE IN ($scomp)";
        // $res_o=query($query,$sql_o,$pa,$opt,$ms_db);
        // while ($row_o = $fetch($res_o)){
        //     $emp_opt[] = $row_o['emp_code'];
        // }
        // $inner_emp = implode(',',$emp_opt);
        $sql="EMP_CODE IN (select emp_code from HrdMastQry where COMP_CODE IN ($scomp)) and (CAST(ShiftMTo AS time)>= CAST(OUT_TIME AS time))) a join EmpNameQry b on a.EMP_CODE=b.Emp_Code";
    }
    else if($empName == '' && $scomp == '' && $sbus != '' && $ssubbus == '' && $sloc == '' && $swloc == '' && $sfunc == '' && $ssubfunc == '' && $scost == '' && $sproc == '' && $sgrade == '' && $sdes == ''){
      echo  $sql="EMP_CODE IN (select emp_code from HrdMastQry where BussCode IN ($sbus)) and (CAST(ShiftMTo AS time)>= CAST(OUT_TIME AS time))) a join EmpNameQry b on a.EMP_CODE=b.Emp_Code";
   }

    //     //print_r($empName);
  

    echo "<table class='table table-striped table-bordered table-hover table2excel' id='sample_1'>
        <thead>
            <tr>
                <th>Employee Name</th>
                <th>Employee Code</th>
                <th>Attendance Date</th>
                <th>IN TIME </th>
                <th>OUT TIME </th>
            </tr>
        </thead>
        <tbody>";
    
    $res=query($query,$sql,$pa,$opt,$ms_db);
    while ($row = $fetch($res)){
        echo"<tr>
                <td>".$row['emp_name']."</td>
                <td>".$row['EMP_CODE']."</td>
                <td>".$row['ATTDATE']."</td>
                <td>".$row['IN_TIME']."</td>
                <td>".$row['OUT_TIME']."</td>
                </tr>";
            }
            echo "</tbody>
            </table>";
 
}

?>