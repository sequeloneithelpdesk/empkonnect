<?php
include ('../db_conn.php');
include ('../configdata.php');
//get search term
$searchTerm = $_GET['term'];
$birthday = $_GET['extraParams'];
$male='images.png';
$female='images.jpg.jpg';
if($birthday == 0){

//get matched data from skills table
    $sqlq="SELECT * FROM HrdMastQry WHERE DATEPART(MM, DOB)=DATEPART(MM, GETDATE()) and DATEPART(dd, DOB)=DATEPART(dd, (DATEADD(D,-1,GETDATE()))) AND((Emp_Code LIKE '%".$searchTerm."%') OR (EMP_NAME LIKE '%".$searchTerm."%')) ORDER BY EMP_NAME ASC";
    $resultq=query($query,$sqlq,$pa,$opt,$ms_db);
    if($num($resultq)) {

        while ($rowq = $fetch($resultq)) {
            $new_row['label']=htmlentities(stripslashes($rowq['EMP_NAME']));
            $new_row['value']=htmlentities(stripslashes($rowq['EMP_NAME']));
            $new_row['description']=htmlentities(stripslashes($rowq['Emp_Code']));
            if($rowq['EmpImage'] != ""){
                $new_row['image']=htmlentities(stripslashes($rowq['EmpImage']));
            }else if($rowq['EmpImage'] == "" && $rowq['Gender'] == 'Male'){
                $new_row['image']=htmlentities(stripslashes($male));
            }elseif($rowq['EmpImage'] == "" && $rowq['Gender'] == 'Female'){
                $new_row['image']=htmlentities(stripslashes($female));
            }
            //$image = '<img src="'.$dir.'/'.$rowq['EmpImage'].'" height="42" width="42">';
            //$data[] = $rowq['EmpImage'].$rowq['EMP_NAME']." (".$rowq['Emp_Code'].")";
            $data[] = $new_row;


        }
    }
//return json data
    echo json_encode($data);

}
elseif($birthday == 1){

//get matched data from skills table
    $sqlq="SELECT * FROM HrdMastQry WHERE DATEPART(MM, DOB)=DATEPART(MM, GETDATE()) and DATEPART(dd, DOB)=DATEPART(dd, GETDATE()) AND((Emp_Code LIKE '%".$searchTerm."%') OR (EMP_NAME LIKE '%".$searchTerm."%')) ORDER BY EMP_NAME ASC";
    $resultq=query($query,$sqlq,$pa,$opt,$ms_db);
    if($num($resultq)) {

        while ($rowq = $fetch($resultq)) {
            $new_row['label']=htmlentities(stripslashes($rowq['EMP_NAME']));
            $new_row['value']=htmlentities(stripslashes($rowq['EMP_NAME']));
            $new_row['description']=htmlentities(stripslashes($rowq['Emp_Code']));
            if($rowq['EmpImage'] != ""){
                $new_row['image']=htmlentities(stripslashes($rowq['EmpImage']));
            }else if($rowq['EmpImage'] == "" && $rowq['Gender'] == 'Male'){
                $new_row['image']=htmlentities(stripslashes($male));
            }elseif($rowq['EmpImage'] == "" && $rowq['Gender'] == 'Female'){
                $new_row['image']=htmlentities(stripslashes($female));
            }
            //     $image = '<img src="'.$dir.'/'.$rowq['EmpImage'].'" height="42" width="42">';
            //$data[] = $rowq['EmpImage'].$rowq['EMP_NAME']." (".$rowq['Emp_Code'].")";
            $data[] = $new_row;


        }
    }
//return json data
    echo json_encode($data);

}
elseif($birthday == 2){

//get matched data from skills table
    $sqlq="SELECT * FROM HrdMastQry WHERE DATEPART(MM, DOB)=DATEPART(MM, GETDATE()) and DATEPART(dd, DOB)=DATEPART(dd, (DATEADD(D,1,GETDATE()))) AND((Emp_Code LIKE '%".$searchTerm."%') OR (EMP_NAME LIKE '%".$searchTerm."%')) ORDER BY EMP_NAME ASC";
    $resultq=query($query,$sqlq,$pa,$opt,$ms_db);
    if($num($resultq)) {

        while ($rowq = $fetch($resultq)) {
            $new_row['label']=htmlentities(stripslashes($rowq['EMP_NAME']));
            $new_row['value']=htmlentities(stripslashes($rowq['EMP_NAME']));
            $new_row['description']=htmlentities(stripslashes($rowq['Emp_Code']));
            if($rowq['EmpImage'] != ""){
                $new_row['image']=htmlentities(stripslashes($rowq['EmpImage']));
            }else if($rowq['EmpImage'] == "" && $rowq['Gender'] == 'Male'){
                $new_row['image']=htmlentities(stripslashes($male));
            }elseif($rowq['EmpImage'] == "" && $rowq['Gender'] == 'Female'){
                $new_row['image']=htmlentities(stripslashes($female));
            }
            //     $image = '<img src="'.$dir.'/'.$rowq['EmpImage'].'" height="42" width="42">';
            //$data[] = $rowq['EmpImage'].$rowq['EMP_NAME']." (".$rowq['Emp_Code'].")";
            $data[] = $new_row;

        }
    }
//return json data
    echo json_encode($data);

}


?>