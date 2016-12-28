<?php
include '../../db_conn.php';
include '../../configdata.php';
//echo @$_POST['type'];


if($_POST['type']=="statusVise")
{
    $statusCode= $_POST['status_code1'];
    $sql="select * from HrdMastQry where Status_Code='$statusCode' ";
    $result =  query($query, $sql, $pa, $opt, $ms_db);
    echo"<option value='all'>All</option>";
    while($row = $fetch($result)) {

        echo "<option value='".$row['Emp_Code']."'>". $row['Emp_FName']."</option>";
    }
}

else if($_POST['type']=="tabledata"){
    $statusCode= $_POST['status_code'];
    $empCode= $_POST['empCode'];

    if ($empCode=="all"){
        $sql="select * from HrdMastQry where Status_Code='$statusCode' ";
    }else {
        $sql= "select * from HrdMastQry where Status_Code='$statusCode' AND Emp_Code='$empCode'";
    }
   
    $result =  query($query, $sql, $pa, $opt, $ms_db);

    ?>
    <button id="btnExport" onclick="getExcelData();" class="btn btn-success">Export</button>
        <div class="portlet-body">
            <div class="table-responsive">
                <table class="table" id="tblExport">
    <!--<table role="presentation" id="tblExport" class="table table-striped clearfix">-->
    <?php
    echo  " 
                              
                                 <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Emp_code</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Last Name</th>
                                    <th>Current Address</th>
                                    <th>Permanent Address</th>
                                    <th>Gender</th>
                                    <th>Designation</th>
                                    <th>Location</th>
                                    <th>Company Name</th>
                                    <th>Business Unit</th>
                                    <th>Function</th>
                                    <th>Grade</th>
                                    <th>Employee Type</th>
                                    <th>Manager</th>
                                    <th>Functional Manager</th>
                                    <th>DOJ</th>
                                    <th>DOB</th>
                                    <th>Nationality</th>
                                    <th>Marital Status</th>
                                    <th>Blood Group</th>
                                    <th>Company Email</th>
                                    <th>Personal Email</th>
                                    <th>Mobile</th>
                                    <th>Work Phone</th>
                                    <th>Work Phone Ext</th>
                                    <th>Work Location</th>
                                    <th>Salary Bank Code</th>
                                    <th>Salary Acc. No</th>
                                    <th>Reim. Bank Code</th>
                                    <th>Reim. Acc. No</th>
                                    <th>Pan No.</th>
                                    <th>Aadhar Card No.</th>
                                    <th>Region</th>
                                    <th>Cost Centre</th>
                                    <th>Process</th>
                                    <th>Sub Bussiness Unit</th>
                                    <th>Sub Function</th>


                                </tr>
                                </thead>
                                <tbody>
                                ";
                        $i=1;
                         while($row = $fetch($result)) {
                        echo "  <tr>
                                    <td style='background-color:red;'>$i</td>
                                    <td>".$row['Emp_Code']."</td>
                                    <td>".$row['Status_Code']."</td>
                                    <td>".$row['Emp_FName']."</td>
                                    <td>".$row['Emp_MName']."</td>
                                    <td>".$row['Emp_LName']."</td>
                                    <td>".$row['MAddr1'].$row['MCity']. $row['MState']. $row['MCountry'].$row['MPin']. $row['MPhoneNo']. "</td>
                                    <td>".$row['PAddr1']. $row['PCity']. $row['PState']. $row['PCountry'].$row['PPin']. $row['PPhoneNo']."</td>
                                    <td>".$row['Gender']."</td>
                                    <td>".$row['DSG_NAME']."</td>
                                    <td>".$row['Loc_Code']."</td>
                                    <td>".$row['COMP_NAME']."</td>
                                    <td>".$row['BUSSNAME']."</td>
                                    <td>".$row['FUNCT_NAME']."</td>
                                    <td>".$row['GRD_NAME']."</td>
                                    <td>".$row['TYPE_NAME']."</td>
                                    <td>".$row['MNGR_NAME']."</td>
                                    <td>".$row['FUNCTIONAL_MNGR_NAME']."</td>
                                    <td>".$row['DOJ']."</td>
                                    <td>".$row['DOB']."</td>
                                    <td>".$row['Nationality']."</td>
                                    <td>".$row['[Marital Status]']."</td>
                                    <td>".$row['BloodGroup']."</td>
                                    <td>".$row['OEMailID']."</td>
                                    <td>".$row['MobileNo']."</td>
                                    <td>".$row['WorkPhone']."</td>
                                    <td>".$row['WorkPhoneExt']."</td>
                                    <td>".$row['LOC_NAME']."</td>
                                    <td>".$row['SMOP_CODE']."</td>
                                    <td>".$row['SMOPNo']."</td>
                                    <td>".$row['RMOP_CODE']."</td>
                                    <td>".$row['RMOPNo']."</td>
                                    <td>".$row['PANNo']."</td>
                                    <td>".$row['AadharNo']."</td>
                                    <td>".$row['REGN_NAME']."</td>
                                    <td>".$row['COST_NAME']."</td>
                                    <td>".$row['PROC_NAME']."</td>
                                    <td>".$row['SUBBUSSNAME']."</td>
                                    <td>".$row['SUBFUNCT_NAME']."</td>
                                </tr>
            </tbody>";
        $i++ ;
      }
    ?>
         </table>
            </div>
        </div>
        <?php
}

?>