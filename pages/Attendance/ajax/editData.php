<?php
session_start();
//error_reporting(E_ALL);
error_reporting(0);
include $_SERVER['DOCUMENT_ROOT'].$_SESSION['root']."pages/db_conn.php";
include $_SERVER['DOCUMENT_ROOT'].$_SESSION['root']."pages/configdata.php";

//include $_SERVER['DOCUMENT_ROOT'].$_SESSION['root']."pages/HRMSClass/HRMSFunction.php";
//To Edit Bussiness Unit
if(isset($_GET['pagetype']) and $_GET['pagetype']=='shiftMaster_content'){

    $type=$_GET['type'];
    //echo$type;
    if($type=='Create'){

         $sql = "INSERT INTO ShiftMast(Shift_Code, Shift_Name, ShiftStart_SwTime, ShiftEnd_SwTime,Shift_MFrom,Shift_MTo,Shift_From,Shift_To,LateAllow,LateAllowCycle,LateAllowGPrd,
ErlyAllow,ErlyAllowCycle,ErlyAllowGPrd,MHrsFul,MHrsHalf,FixBrkDef,BrkStartTime,BrkEndTime,MarkOut,shift_status,RCLOCK) values 
('$_POST[shiftCode]', '$_POST[shiftName]', '$_POST[sw_startshift]',' $_POST[sw_endshift]', '$_POST[mstarttime]',' $_POST[mendtime]',
 '$_POST[shiftstarttime]',' $_POST[shiftendtime]', $_POST[latecomemin], $_POST[lcycle], $_POST[lgrace], $_POST[earlygo], $_POST[ecycle]
, $_POST[egrace], '$_POST[mfullday]',' $_POST[mhalfday]', '$_POST[fixedbrk]',' $_POST[brkstarttime]',' $_POST[brkendtime]', $_POST[markout], '1','$_POST[rclock]')";
        $code = $_POST['shiftCode'];
        $sqlup="select * from ShiftMast where " ;
        if($code==""){
            $sqlup.="Shift_Name='trim($_POST[shiftName])'";
        }
        else {
            $sqlup .= " Shift_Code='trim($_POST[shiftCode])' or  Shift_Name='trim($_POST[shiftName])'";
        }
        $resultup=query($query,$sqlup,$pa,$opt,$ms_db);
        if($num($resultup)>0){
            echo 2;
        }else {
            $resultq = query($query, $sql, $pa, $opt, $ms_db);
            if ($resultq ) {
                echo 1;
            } else {
                echo 3;
                die();
            }
        }
    }
    elseif($type=='Edit') {
         $OLDSHIFTID = $_POST['ShiftMastId'];
       //$_POST[ecycle];
        $sql = "UPDATE ShiftMast SET Shift_Code='$_POST[shiftCode]', 
                                      Shift_Name='$_POST[shiftName]', 
                                      ShiftStart_SwTime='$_POST[sw_startshift]', 
                                      ShiftEnd_SwTime='$_POST[sw_endshift]',
                                      Shift_MFrom='$_POST[mstarttime]',
                                      Shift_MTo='$_POST[mendtime]',
                                      Shift_From='$_POST[shiftstarttime]',
                                      Shift_To='$_POST[shiftendtime]',
                                      LateAllow=$_POST[latecomemin],
                                      LateAllowCycle=$_POST[lcycle],
                                      LateAllowGPrd=$_POST[lgrace],
                                      ErlyAllow=$_POST[earlygo],
                                      ErlyAllowCycle=$_POST[ecycle],
                                      ErlyAllowGPrd=$_POST[egrace],
                                      MHrsFul='$_POST[mfullday]',
                                      MHrsHalf='$_POST[mhalfday]',
                                      FixBrkDef='$_POST[fixedbrk]',
                                      BrkStartTime='$_POST[brkstarttime]',
                                      BrkEndTime='$_POST[brkendtime]',
                                      MarkOut=$_POST[markout],
                                      shift_status='1',
                                      RCLOCK = '$_POST[rclock]'
                               WHERE ShiftMastId ='$OLDSHIFTID' ";
        $resultq = query($query, $sql, $pa, $opt, $ms_db);
        if ($resultq ) {
            echo 1;
        } else {
            die();
        }
    }
    else if($type=='Copy'){

        $sql = "INSERT INTO ShiftMast(Shift_Code, Shift_Name, ShiftStart_SwTime, ShiftEnd_SwTime,Shift_MFrom,Shift_MTo,Shift_From,Shift_To,LateAllow,LateAllowCycle,LateAllowGPrd,
ErlyAllow,ErlyAllowCycle,ErlyAllowGPrd,MHrsFul,MHrsHalf,FixBrkDef,BrkStartTime,BrkEndTime,MarkOut,shift_status,RCLOCK) values 
('$_POST[shiftCode]', '$_POST[shiftName]', '$_POST[sw_startshift]',' $_POST[sw_endshift]', '$_POST[mstarttime]',' $_POST[mendtime]',
 '$_POST[shiftstarttime]',' $_POST[shiftendtime]', $_POST[latecomemin], $_POST[lcycle], $_POST[lgrace], $_POST[earlygo], $_POST[ecycle]
, $_POST[egrace], '$_POST[mfullday]',' $_POST[mhalfday]', '$_POST[fixedbrk]',' $_POST[brkstarttime]',' $_POST[brkendtime]', $_POST[markout], '1','$_POST[rclock]')";
        $code = $_POST['shiftCode'];
        $sqlup="select * from ShiftMast where " ;
        if($code==""){
            $sqlup.="Shift_Name='trim($_POST[shiftName])'";
        }
        else {
            $sqlup .= " Shift_Code='trim($_POST[shiftCode])' or  Shift_Name='trim($_POST[shiftName])'";
        }
        $resultup=query($query,$sqlup,$pa,$opt,$ms_db);
        if($num($resultup)>0){
            echo 2;
        }else {
            $resultq = query($query, $sql, $pa, $opt, $ms_db);
            if ($resultq ) {
                echo 1;
            } else {
                echo 3;
                die();
            }
        }
    }


}
elseif(isset($_GET['pagetype']) and $_GET['pagetype']=='shiftPattern_content'){

$type=$_GET['type'];
//echo $type;
if($type=='Add'){
    $W1 = implode(',',$_POST['1week']);
    $W2 = implode(',',$_POST['2week']);
    $W3 = implode(',',$_POST['3week']);
    $W4 = implode(',',$_POST['4week']);
    $W5 = implode(',',$_POST['5week']);
   // $AW = implode(',',$_POST['Allweek']);

    $sql = "INSERT INTO ShiftPatternMast(ShiftPattern_Code, ShiftPattern_Name, CompOff, IsRepating,WeeklyOff1,WeeklyOff2,WeeklyOff3,WeeklyOff4
,WeeklyOff5) values 
('$_POST[shiftPatternCode]', '$_POST[shiftPatternName]', '$_POST[companyOff]','$_POST[repeatPattern]', '$W1','$W2',
  '$W3','$W4','$W5')";
    $code = $_POST['shiftPatternCode'];
    $sqlup="select * from ShiftPatternMast where " ;
    if($code==""){
        $sqlup.="ShiftPattern_Name='trim($_POST[shiftPatternName])'";
    }
    else {
        $sqlup .= " ShiftPattern_Code='trim($_POST[shiftPatternCode])' or  ShiftPattern_Name='trim($_POST[shiftPatternName])'";
    }
    $resultup=query($query,$sqlup,$pa,$opt,$ms_db);
    if($num($resultup)>0){
        echo 2;
    }else {
        $resultq = query($query, $sql, $pa, $opt, $ms_db);
        if ($resultq ) {
            echo 1;
        } else {
            echo 3;
            die();
        }
    }
}
elseif($type=='Edit') {
    $OLDSHIFTID = $_POST['ShiftPatternMastId'];
    $W1 = implode(',',$_POST['1week']);
    $W2 = implode(',',$_POST['2week']);
    $W3 = implode(',',$_POST['3week']);
    $W4 = implode(',',$_POST['4week']);
    $W5 = implode(',',$_POST['5week']);


   $sql = "UPDATE ShiftPatternMast SET ShiftPattern_Code='$_POST[shiftPatternCode]', 
                                      ShiftPattern_Name='$_POST[shiftPatternName]', 
                                      CompOff='$_POST[companyOff]', 
                                      IsRepating='$_POST[repeatPattern]',
                                      WeeklyOff1='$W1',
                                      WeeklyOff2='$W2',
                                      WeeklyOff3='$W3',
                                      WeeklyOff4='$W4',
                                      WeeklyOff5='$W5'
                                        
                               WHERE ShiftPatternMastid ='$OLDSHIFTID' ";
    $resultq = query($query, $sql, $pa, $opt, $ms_db);
    if ($resultq ) {
        echo 1;
    } else {
        die();
        echo 3;
    }
}
    elseif($type=='Copy'){
        $W1 = implode(',',$_POST['1week']);
        $W2 = implode(',',$_POST['2week']);
        $W3 = implode(',',$_POST['3week']);
        $W4 = implode(',',$_POST['4week']);
        $W5 = implode(',',$_POST['5week']);
        // $AW = implode(',',$_POST['Allweek']);

        $sql = "INSERT INTO ShiftPatternMast(ShiftPattern_Code, ShiftPattern_Name, CompOff, IsRepating,WeeklyOff1,WeeklyOff2,WeeklyOff3,WeeklyOff4
,WeeklyOff5) values 
('$_POST[shiftPatternCode]', '$_POST[shiftPatternName]', '$_POST[companyOff]','$_POST[repeatPattern]', '$W1','$W2',
  '$W3','$W4','$W5')";
        $code = $_POST['shiftPatternCode'];
        $sqlup="select * from ShiftPatternMast where " ;
        if($code==""){
            $sqlup.="ShiftPattern_Name='trim($_POST[shiftPatternName])'";
        }
        else {
            $sqlup .= " ShiftPattern_Code='trim($_POST[shiftPatternCode])' or  ShiftPattern_Name='trim($_POST[shiftPatternName])'";
        }
        $resultup=query($query,$sqlup,$pa,$opt,$ms_db);
        if($num($resultup)>0){
            echo 2;
        }else {
            $resultq = query($query, $sql, $pa, $opt, $ms_db);
            if ($resultq ) {
                echo 1;
            } else {
                die();
            }
        }
    }



}
?>