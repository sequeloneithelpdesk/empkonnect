<?php 
session_start();
include '../../db_conn.php';
include ('../../configdata.php');

$code=$_SESSION['usercode'];

 $fsql= "select * from HrdMastQry where MNGR_CODE='$code'";
    $result=query($query,$fsql,$pa,$opt,$ms_db);
    $len = $num($result);
    if($len >0){
        $e=0;
       $team="";
        while($arr = $fetch($result)){
            if($e==0){ }
                else{
                    $team.=",";
                }
        $team .= "'".$arr['Emp_Code']."'";
        $e++;
        } 
    }


if ($_POST['type'] == "searchMyDate") {

    $fromDate= $_POST['fromDate'];
    $toDate = $_POST['toDate'];
    $loginUser = $team;
    
    if ($fromDate == "" && $toDate == "") {
          echo  $sql="select *,convert(varchar(10),LvFrom,103)as LvFrom, convert(varchar(10),LvTo,103)as LvTo from leave where CreatedBy in ($loginUser) and flag='1'" ;
        } 
       elseif ($fromDate=="") {
         echo   $sql="select *,convert(varchar(10),LvFrom,103)as LvFrom, convert(varchar(10),LvTo,103)as LvTo from leave where CreatedBy in ($loginUser) and LvTo='$toDate' and flag='1'";
        }elseif($toDate==""){
      echo  $sql="select *,convert(varchar(10),LvFrom,103)as LvFrom, convert(varchar(10),LvTo,103)as LvTo from leave where CreatedBy in ($loginUser) and LvFrom='$fromDate' and flag='1'";
        }
        else{
         echo   $sql="select *,convert(varchar(10),LvFrom,103)as LvFrom, convert(varchar(10),LvTo,103)as LvTo from leave where CreatedBy in ($loginUser) and LvFrom='$fromDate' and LvTo='$toDate' and flag='1'";
        }
            
            $res=query($query,$sql,$pa,$opt,$ms_db);
            if($res){    
                $i=0;
                while($row=$fetch($res)){
                    $mngrcode=$row['ApprovedBy'];
                    $sql1="select EMP_NAME from HrdMastQry WHERE Emp_Code='$mngrcode'";
                    $res1=query($query,$sql1,$pa,$opt,$ms_db);
                    $data1=$fetch($res1);

                 echo" <tr>
                            <td>
                                ".$data1['EMP_NAME']."  
                            </td>
                            <td>
                                  ".$row['LvFrom']."
                            </td>
                            <td>
                                        ".$row['LvTo']."
                            </td>
                            <td>
                                ".$row['LvDays']."
                            </td>
              <td>
                                ".$row['reason']."
                            </td>

                            <td>";
                            if($row['status'] == "1"){
                            echo"<a class='myod' data-toggle='modal' href='#large' 
                                onclick='getmyleaveId('".$row['leaveID']."','1','".$loginUser."')'>
                                    <span class='label label-sm bg-blue-steel'>
                                    Pending </span>
                                </a> ";   
                                }else if($row['status'] == "2") {
                                echo" <a class='myod' data-toggle='modal' href='#large'
                                    onclick='getmyleaveId('".$row['leaveID']."','2','".$loginUser."')'>
                                    <span class='label label-sm label-success'>
                                   Approved
                                     </span>
                                 </a>";
                                } else if($row['status'] == "3") {
                                echo "<a class='myod' data-toggle='modal' href='#large'
                                    onclick='getmyleaveId('".$row['leaveID']."','3','".$loginUser."')'>
                                    <span class='label label-sm label-danger'>
                                   Rejected
                                 </span>
                                 </a>";
                                } else if($row['status'] == "4") {
                                echo"<a class='myod' data-toggle='modal' href='#large'
                                    onclick='getmyleaveId('".$row['leaveID']."','4','".$loginUser."')'>
                                    <span class='label label-sm bg-grey-cascade'>
                                   Cancelled
                                 </span>
                                 </a>";
                                }
                                        
                              echo"</td>
                            </tr>";
                            $i++;

                }
            }
     
}



elseif ($_POST['type'] == "searchMyStatus") {
    $statusid= $_POST['statusid'];
    $loginUser=$team;
     $sql="select *,CONVERT (VARCHAR(10),LvFrom,103 ) as LvFrom , CONVERT (VARCHAR(10),LvTo,103 ) as LvTo from  leave where status='$statusid' and CreatedBy in ($loginUser) and flag='1'";
    $res=query($query,$sql,$pa,$opt,$ms_db);
    while($row= $fetch($res)){
         
        $mngrcode=$row['ApprovedBy'];
        $sql1="select EMP_NAME from HrdMastQry WHERE Emp_Code='$mngrcode'";
        $res1=query($query,$sql1,$pa,$opt,$ms_db);
        $data1=$fetch($res1);

                echo"<tr>

                    <td>
                        ".$data1['EMP_NAME']."  
                    </td>
                     <td>
                          ".$row['LvFrom']."
                    </td>
                    <td>
                                ".$row['LvTo']."
                    </td>
                    <td>
                        ".$row['LvDays']."
                    </td>
          <td>
                        ".$row['reason']."
                    </td>
                    <td>";
                     if($row['status'] == "1"){
                            echo"<a class='myod' data-toggle='modal' href='#large' 
                                onclick='getmyleaveId('".$row['leaveID']."','1','".$loginUser."')'>
                                    <span class='label label-sm bg-blue-steel'>
                                    Pending </span>
                                </a> ";   
                                }else if($row['status'] == "2") {
                                echo" <a class='myod' data-toggle='modal' href='#large'
                                    onclick='getmyleaveId('".$row['leaveID']."','2','".$loginUser."')'>
                                    <span class='label label-sm label-success'>
                                   Approved
                                     </span>
                                 </a>";
                                } else if($row['status'] == "3") {
                                echo "<a class='myod' data-toggle='modal' href='#large'
                                    onclick='getmyleaveId('".$row['leaveID']."','3','".$loginUser."')'>
                                    <span class='label label-sm label-danger'>
                                   Rejected
                                 </span>
                                 </a>";
                                } else if($row['status'] == "4") {
                                echo"<a class='myod' data-toggle='modal' href='#large'
                                    onclick='getmyleaveId('".$row['leaveID']."','4','".$loginUser."')'>
                                    <span class='label label-sm bg-grey-cascade'>
                                   Cancelled
                                 </span>
                                 </a>";
                                }
                                        
                              echo"</td>
                            </tr>";
                            $i++;        
    }
}


elseif ($_POST['type'] == "searchByRequester") {
    $codename= $_POST['codename'];
  $loginUser=$team;
   $sql="select *,CONVERT (VARCHAR(10),LvFrom,103 ) as LvFrom , CONVERT (VARCHAR(10),LvTo,103 ) as LvTo from  leave where CreatedBy in ($loginUser) and flag='1' and (CreatedBy in (select emp_code from HrdMastQry where Emp_FName='$codename' or Emp_MName='$codename' or Emp_LName='$codename') or CreatedBy='$codename')";
    $res=query($query,$sql,$pa,$opt,$ms_db);
    while($row= $fetch($res)){
         
        $mngrcode=$row['ApprovedBy'];
        $sql1="select EMP_NAME from HrdMastQry WHERE Emp_Code='$mngrcode'";
        $res1=query($query,$sql1,$pa,$opt,$ms_db);
        $data1=$fetch($res1);

         $i=0;       echo"<tr>

                    <td>
                        ".$data1['EMP_NAME']."  
                    </td>
                     <td>
                          ".$row['LvFrom']."
                    </td>
                    <td>
                                ".$row['LvTo']."
                    </td>
                    <td>
                        ".$row['LvDays']."
                    </td>
                    <td>
                        ".$row['reason']."
                    </td>
                    <td>";
                     if($row['status'] == "1"){
                            echo"<a class='myod' data-toggle='modal' href='#large' 
                                onclick='getmyleaveId('".$row['leaveID']."','1','".$loginUser."')'>
                                    <span class='label label-sm bg-blue-steel'>
                                    Pending </span>
                                </a> ";   
                                }else if($row['status'] == "2") {
                                echo" <a class='myod' data-toggle='modal' href='#large'
                                    onclick='getmyleaveId('".$row['leaveID']."','2','".$loginUser."')'>
                                    <span class='label label-sm label-success'>
                                   Approved
                                     </span>
                                 </a>";
                                } else if($row['status'] == "3") {
                                echo "<a class='myod' data-toggle='modal' href='#large'
                                    onclick='getmyleaveId('".$row['leaveID']."','3','".$loginUser."')'>
                                    <span class='label label-sm label-danger'>
                                   Rejected
                                 </span>
                                 </a>";
                                } else if($row['status'] == "4") {
                                echo"<a class='myod' data-toggle='modal' href='#large'
                                    onclick='getmyleaveId('".$row['leaveID']."','4','".$loginUser."')'>
                                    <span class='label label-sm bg-grey-cascade'>
                                   Cancelled
                                 </span>
                                 </a>";
                                }
                                        
                              echo"</td>
                            </tr>";
                            $i++;        
    }
}

elseif ($_POST['type'] == "searchByApprover") {
    $codename= $_POST['codename'];
  $loginUser=$team;
   $sql="select *,CONVERT (VARCHAR(10),LvFrom,103 ) as LvFrom , CONVERT (VARCHAR(10),LvTo,103 ) as LvTo from  leave where CreatedBy in ($loginUser) and flag='1' and (ApprovedBy in (select emp_code from HrdMastQry where Emp_FName='$codename' or Emp_MName='$codename' or Emp_LName='$codename') or ApprovedBy='$codename')";
    $res=query($query,$sql,$pa,$opt,$ms_db);
    while($row= $fetch($res)){
        $usercode=$row['ApprovedBy'];
        $sql1="select EMP_NAME from HrdMastQry WHERE Emp_Code='$usercode'";
        $res1=query($query,$sql1,$pa,$opt,$ms_db);
        $data1=$fetch($res1);
        $i=0;
        echo"<tr>

                    <td>
                        ".$data1['EMP_NAME']."  
                    </td>
                     <td>
                          ".$row['LvFrom']."
                    </td>
                    <td>
                                ".$row['LvTo']."
                    </td>
                    <td>
                        ".$row['LvDays']."
                    </td>
                    <td>
                        ".$row['reason']."
                    </td>
                    <td>";
                     if($row['status'] == "1"){
                            echo"<a class='myod' data-toggle='modal' href='#large' 
                                onclick='getmyleaveId('".$row['leaveID']."','1','".$loginUser."')'>
                                    <span class='label label-sm bg-blue-steel'>
                                    Pending </span>
                                </a> ";   
                                }else if($row['status'] == "2") {
                                echo" <a class='myod' data-toggle='modal' href='#large'
                                    onclick='getmyleaveId('".$row['leaveID']."','2','".$loginUser."')'>
                                    <span class='label label-sm label-success'>
                                   Approved
                                     </span>
                                 </a>";
                                } else if($row['status'] == "3") {
                                echo "<a class='myod' data-toggle='modal' href='#large'
                                    onclick='getmyleaveId('".$row['leaveID']."','3','".$loginUser."')'>
                                    <span class='label label-sm label-danger'>
                                   Rejected
                                 </span>
                                 </a>";
                                } else if($row['status'] == "4") {
                                echo"<a class='myod' data-toggle='modal' href='#large'
                                    onclick='getmyleaveId('".$row['leaveID']."','4','".$loginUser."')'>
                                    <span class='label label-sm bg-grey-cascade'>
                                   Cancelled
                                 </span>
                                 </a>";
                                }
                                        
                              echo"</td>
                            </tr>";
                            $i++;        
            }      
}



?>