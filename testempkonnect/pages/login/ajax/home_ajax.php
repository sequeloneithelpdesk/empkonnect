
<?php
include ('../../db_conn.php');
include ('../../configdata.php');
$flag_value = $_POST['flag_value'];
$male='images.png';
$female='images.jpg.jpg';
if ($flag_value == '1' ) {
    $searchTerm = $_POST['search'];
    echo '<script src="../login/js/home.js"></script><table class="table table-hover table-light">
				<thead></thead>';
//get matched data from skills table
    $sqlq = "SELECT * FROM HrdMastQry WHERE (Emp_Code LIKE '%" . $searchTerm . "%') OR (EMP_NAME LIKE '%" . $searchTerm . "%') OR (DEPT_NAME  LIKE '%" . $searchTerm . "%') OR (DSG_NAME  LIKE '%" . $searchTerm . "%') ORDER BY EMP_NAME ASC";
    $resultq = query($query, $sqlq, $pa, $opt, $ms_db);
    if ($num($resultq)) {

        while ($rowq = $fetch($resultq)) {

               echo '
<div class="empSearchResult clearfix">
                    <div class="empSearchImg col-md-2">';
                    if($rowq['EmpImage'] != ''){
                        echo'<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/';echo$rowq['EmpImage']; echo '">';

                    }
            else if($rowq['EmpImage'] == "" && $rowq['Gender'] == 'Male'){
                echo'<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/';echo$male; echo '">';

            }
            elseif($rowq['EmpImage'] == "" && $rowq['Gender'] == 'Female'){
                echo'<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/';echo$female; echo '">';

            }
            echo '</div>
                    <div class="empSearchInfo col-md-10">
                    <span class="fit">
                       <!-- <a href="#" class="black-txt fs-16">-->'; echo $rowq['EMP_NAME']; echo '<span class="kEmpCod">'; echo $rowq['Emp_Code'];'</span> 
                        <span class="dsb">';  echo '</span>
                    </span>
                    <span class="fit">
                        <span class="dsb">'; echo $rowq['DEPT_NAME']; echo $rowq['DSG_NAME']; echo '</span>
                    </span>
                    <span class="fit">
                        <span class="dsb">';  echo $rowq['WorkPhone']; echo '</span>
                    </span>
                    <span class="fit">
                        <span class="dsb">'; echo $rowq['OEMailID']; echo '</span>
                   
                    </div>
                    </div>
                ';

        }
    }
    echo '</table>';
//return json data
   // echo json_encode($data);
}
elseif ($flag_value == '2' ) {
    $searchTerm = $_POST['search'];
    echo '<script src="../login/js/home.js"></script><table class="table table-hover table-light">';
//get matched data from skills table
    $sqlq="SELECT * FROM HrdMastQry WHERE (DOJ between DATEADD(DD,-30,GETDATE()) and GETDATE()) AND((Emp_Code LIKE '%".$searchTerm."%') OR (EMP_NAME LIKE '%".$searchTerm."%')) ORDER BY EMP_NAME ASC";
    $resultq = query($query, $sqlq, $pa, $opt, $ms_db);
    echo '<div class="empSearchResultCon clearfix">';
    if ($num($resultq)) {

        while ($rowq = $fetch($resultq)) {

            echo '
            <div class="empSearchResult clearfix">
                    <div class="empSearchImg col-md-2">
            <a class="black-txt fs-16" onclick="editInfo(\'nj\',\'';echo $rowq['OEMailID'];echo '\',\'';echo $rowq['EMP_NAME'];echo '\',\'';echo $rowq['Emp_Code'];echo '\')">';
                    if($rowq['EmpImage'] != ''){
                        echo'<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/';echo$rowq['EmpImage']; echo '">';

                    }
            else if($rowq['EmpImage'] == "" && $rowq['Gender'] == 'Male'){
                echo'<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/';echo$male; echo '">';

            }
            elseif($rowq['EmpImage'] == "" && $rowq['Gender'] == 'Female'){
                echo'<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/';echo$female; echo '">';

            }
            echo '</div>
                    <div class="empSearchInfo col-md-10">
                    <span class="fit">
                       '; echo $rowq['EMP_NAME']; echo '<span class="kEmpCod">'; echo $rowq['Emp_Code'];'</span> 
                        <span class="dsb">';  echo '</span>
                    </span>
                    <span class="fit dsb">
                        <span>'; echo "IT Department";$rowq['DEPT_NAME'];  echo '</span>
                        <span class="kcircle">'; echo "software Developer";$rowq['DSG_NAME']; echo '</span>
                        
                    </span>
                    </a>
                    </div>
                    </div>
                  
                    
                ';













        }
           }
            echo ' </div><span class="searchResToggleBtn">
                                      <a class="defaultTxt" id="close_newjoinee" btnTxt1="To get whole List " btnTxt2="plz provide text foethis button"></a>
                                </span>';

     
    echo '</table>';
//return json data
    // echo json_encode($data);
}
elseif ($flag_value == '3' ) {
    $searchTerm = $_POST['search'];
    echo '<script src="../login/js/home.js"></script><table class="table table-hover table-light">
				<thead><span class="input-group-btn">
									  <a class="btn submit" id="close_birthday0">To get whole List       <i class="icon-close"></i></a>
								</span></thead>';
//get matched data from skills table
    $sqlq="SELECT * FROM HrdMastQry WHERE DATEPART(MM, DOB)=DATEPART(MM, GETDATE()) and DATEPART(dd, DOB)=DATEPART(dd, (DATEADD(D,-1,GETDATE()))) AND((Emp_Code LIKE '%".$searchTerm."%') OR (EMP_NAME LIKE '%".$searchTerm."%')) ORDER BY EMP_NAME ASC";
    $resultq = query($query, $sqlq, $pa, $opt, $ms_db);
    if ($num($resultq)) {

        while ($rowq = $fetch($resultq)) {

            echo '<div class="empSearchResult clearfix">
                    <div class="empSearchImg col-md-2">
            <a class="black-txt fs-16" onclick="editInfo(\'birthday\',\'';echo $rowq['OEMailID'];echo '\',\'';echo $rowq['EMP_NAME'];echo '\',\'';echo $rowq['Emp_Code'];echo '\')">';
                    if($rowq['EmpImage'] != ''){
                        echo'<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/';echo$rowq['EmpImage']; echo '">';

                    }
                    else if($rowq['EmpImage'] == "" && $rowq['Gender'] == 'Male'){
                        echo'<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/';echo$male; echo '">';

                    }
                    elseif($rowq['EmpImage'] == "" && $rowq['Gender'] == 'Female'){
                        echo'<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/';echo$female; echo '">';

                    }
            echo '</div>
                    <div class="empSearchInfo col-md-10">
                    <span class="fit">
                       '; echo $rowq['EMP_NAME']; echo '<span class="kEmpCod">'; echo $rowq['Emp_Code'];'</span> 
                        <span class="dsb">';  echo '</span>
                    </span>
                    <span class="fit">
                        <span class="dsb">'; $rowq['DEPT_NAME']; echo $rowq['DSG_NAME']; echo '</span>
                    </span>
                    </a>
                    </div>
                    </div>
                ';

        }
    }
    echo '</table>';
//return json data
    // echo json_encode($data);
}
elseif ($flag_value == '4' ) {
    $searchTerm = $_POST['search'];
    echo '<script src="../login/js/home.js"></script><table class="table table-hover table-light">
				<thead><span class="input-group-btn">
									  <a class="btn submit" id="close_birthday1">To get whole List       <i class="icon-close"></i></a>
								</span></thead>';
//get matched data from skills table
    $sqlq="SELECT * FROM HrdMastQry WHERE DATEPART(MM, DOB)=DATEPART(MM, GETDATE()) and DATEPART(dd, DOB)=DATEPART(dd, GETDATE()) AND((Emp_Code LIKE '%".$searchTerm."%') OR (EMP_NAME LIKE '%".$searchTerm."%')) ORDER BY EMP_NAME ASC";
    $resultq = query($query, $sqlq, $pa, $opt, $ms_db);
    if ($num($resultq)) {

        while ($rowq = $fetch($resultq)) {

            echo '<div class="empSearchResult clearfix">
                    <div class="empSearchImg col-md-2">
            <a class="black-txt fs-16" onclick="editInfo(\'birthday\',\'';echo $rowq['OEMailID'];echo '\',\'';echo $rowq['EMP_NAME'];echo '\',\'';echo $rowq['Emp_Code'];echo '\')">';
                    if($rowq['EmpImage'] != ''){
                        echo'<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/';echo$rowq['EmpImage']; echo '">';

                    }
                    else if($rowq['EmpImage'] == "" && $rowq['Gender'] == 'Male'){
                        echo'<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/';echo$male; echo '">';

                    }
                    elseif($rowq['EmpImage'] == "" && $rowq['Gender'] == 'Female'){
                        echo'<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/';echo$female; echo '">';

                    }
            echo '</div>
                    <div class="empSearchInfo col-md-10">
                    <span class="fit">
                       '; echo $rowq['EMP_NAME']; echo '<span class="kEmpCod">'; echo $rowq['Emp_Code'];'</span> 
                        <span class="dsb">';  echo '</span>
                    </span>
                    <span class="fit">
                        <span class="dsb">'; $rowq['DEPT_NAME']; echo $rowq['DSG_NAME']; echo '</span>
                    </span>
                    </a>
                    </div>
                    </div>
                ';

        }
    }
    echo '</table>';
//return json data
    // echo json_encode($data);
}
elseif ($flag_value == '5' ) {
    $searchTerm = $_POST['search'];

    echo '<script src="../login/js/home.js"></script><table class="table table-hover table-light">
				<thead><span class="input-group-btn">
									  <a class="btn submit" id="close_birthday2">To get whole List       <i class="icon-close"></i></a>
								</span></thead>';
//get matched data from skills table
    $sqlq="SELECT * FROM HrdMastQry WHERE DATEPART(MM, DOB)=DATEPART(MM, GETDATE()) and DATEPART(dd, DOB)=DATEPART(dd, (DATEADD(D,1,GETDATE()))) AND((Emp_Code LIKE '%".$searchTerm."%') OR (EMP_NAME LIKE '%".$searchTerm."%')) ORDER BY EMP_NAME ASC";
    $resultq = query($query, $sqlq, $pa, $opt, $ms_db);
    if ($num($resultq)) {

        while ($rowq = $fetch($resultq)) {

            echo '<div class="empSearchResult clearfix">
                    <div class="empSearchImg col-md-2">
            <a class="black-txt fs-16" onclick="editInfo(\'birthday\',\'';echo $rowq['OEMailID'];echo '\',\'';echo $rowq['EMP_NAME'];echo '\',\'';echo $rowq['Emp_Code'];echo '\')">';
                    if($rowq['EmpImage'] != ''){
                        echo'<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/';echo$rowq['EmpImage']; echo '">';

                    }
                    else if($rowq['EmpImage'] == "" && $rowq['Gender'] == 'Male'){
                        echo'<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/';echo$male; echo '">';

                    }
                    elseif($rowq['EmpImage'] == "" && $rowq['Gender'] == 'Female'){
                        echo'<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/';echo$female; echo '">';

                    }
            echo '</div>
                    <div class="empSearchInfo col-md-10">
                    <span class="fit">
                       '; echo $rowq['EMP_NAME']; echo '<span class="kEmpCod">'; echo $rowq['Emp_Code'];'</span> 
                        <span class="dsb">';  echo '</span>
                    </span>
                    <span class="fit">
                        <span class="dsb">'; $rowq['DEPT_NAME']; echo $rowq['DSG_NAME']; echo '</span>
                    </span>
                    </a>
                    </div>
                    </div>
                ';
        }
    }
    echo '</table>';
//return json data
    // echo json_encode($data);
}
elseif ($flag_value == '6' ) {
    $searchTerm = $_POST['search'];
    $manager = $_POST['manager'];

    echo '<script src="../login/js/home.js"></script><table class="table table-hover table-light">
				<thead><span class="input-group-btn">
									  <a class="btn submit" id="close_myteam">To get whole List       <i class="icon-close"></i></a>
								</span></thead>';
//get matched data from skills table
    $sqlq="SELECT * FROM HrdMastQry WHERE (MNGR_CODE='$manager') AND((Emp_Code LIKE '%".$searchTerm."%') OR (EMP_NAME LIKE '%".$searchTerm."%')) ORDER BY EMP_NAME ASC";
    $resultq = query($query, $sqlq, $pa, $opt, $ms_db);
    if ($num($resultq)) {

        while ($rowq = $fetch($resultq)) {

            echo '
                <div class="empSearchResult clearfix">
                    <div class="empSearchImg col-md-2">
            <a href="../Profile/showEmployee.php?oempCode=';echo $rowq['Emp_Code'];echo'" class="black-txt fs-14">';
                    if($rowq['EmpImage'] != ''){
                        echo'<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/';echo$rowq['EmpImage']; echo '">';

                    }
            else if($rowq['EmpImage'] == "" && $rowq['Gender'] == 'Male'){
                echo'<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/';echo$male; echo '">';

            }
            elseif($rowq['EmpImage'] == "" && $rowq['Gender'] == 'Female'){
                echo'<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/';echo$female; echo '">';

            }
            echo '</div>
                    <div class="empSearchInfo col-md-10">
                    <span class="fit">
                       '; echo $rowq['EMP_NAME']; echo '<span class="kEmpCod">'; echo $rowq['Emp_Code'];'</span> 
                        <span class="dsb">';  echo '</span>
                    </span>
                    <span class="fit">
                        <span class="dsb">'; $rowq['DEPT_NAME']; echo $rowq['DSG_NAME']; echo '</span>
                    </span>
                    </a>
                    </div>
                    </div>
                ';


        }
    }
    echo '</table>';
//return json data
    // echo json_encode($data);
}
elseif ($flag_value == '7'){
    $send = $_POST['send'];
    $message = $_POST['message'];
    $name = $_POST['name'];
    $code = $_POST['code'];
    $subject = $_POST['subject'];
    wishmailer('donotreply@sequelone.com',$name,$subject,$message,'monikasequelone.com',$send);

}