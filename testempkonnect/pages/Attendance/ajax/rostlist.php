<?php
include('../../db_conn.php');
include('../../configdata.php');

@session_start();
//$type=$_GET['type'];
$code=$_SESSION['usercode'];
$approverID = Array();
if(isset($_GET['type']) && $_GET['type']=='data1'){
    $workflow = Array();
    $level= Array();
    $sqlq="select * from WorkFlow WHERE WFFor='Attendance' order by WorkFlowID DESC ";
    $resultq = query($query,$sqlq,$pa,$opt,$ms_db);
    {
        while($row = $fetch($resultq)) {
            $sql="Select * from hrdmastQry";

            $datalevel = $row['ForMenu']; // $_POST['data'];

            $datalevel=json_decode($datalevel,true);

            //  print_r($datalevel);
            //print_r($datalevel[0]['children'][$b]['id']);


            $sql.=" where ";
            for ($i=0;$i<count($datalevel);$i++){
                if($datalevel[$i]['text']=="Company"){
                    for($b=0;$b<count($datalevel[$i]['children']);$b++) {
                        $sql .= " Comp_code='" . substr($datalevel[$i]['children'][$b]['id'],1)."'";
                        if($b<count($datalevel[$i]['children'])-1){
                            $sql.= " or ";
                        }
                    }
                    $sql .= " and ";
                }

                if($datalevel[$i]['text']=="Business Unit"){
                    for($b=0;$b<count($datalevel[$i]['children']);$b++) {
                        $sql .= " Busscode='" . substr($datalevel[$i]['children'][$b]['id'],1)."'";
                        if($b<count($datalevel[$i]['children'])-1){
                            $sql.= " or ";
                        }
                    }
                    $sql .= " and ";
                }
                if($datalevel[$i]['text']=="Location"){

                    for($l=0;$l<count($datalevel[$i]['children']);$l++) {
                        $sql .= " loc_Code='" . substr($datalevel[$i]['children'][$l]['id'],1)."'";
                        if($l<count($datalevel[$i]['children'])-1){
                            $sql.= " or ";
                        }
                    }
                    $sql.= " and ";
                }

                if($datalevel[$i]['text']=="Working Location"){

                    for($wl=0;$wl<count($datalevel[$i]['children']);$wl++) {
                        $sql .= " WLOC_code='" . substr($datalevel[$i]['children'][$wl]['id'],1)."'";
                        if($wl<count($datalevel[$i]['children'])-1){
                            $sql.= " or ";
                        }
                    }
                    $sql.= " and ";
                }
                if($datalevel[$i]['text']=="Function"){

                    for($f=0;$f<count($datalevel[$i]['children']);$f++) {
                        $sql .= " FUNCT_code='" . substr($datalevel[$i]['children'][$f]['id'],1)."'";
                        if($f<count($datalevel[$i]['children'])-1){
                            $sql.= " or ";
                        }
                    }
                    $sql.= " and ";
                }
                if($datalevel[$i]['text']=="Sub Function"){

                    for($sf=0;$sf<count($datalevel[$i]['children']);$sf++) {
                        $sql .= " SFUNCT_code='" . substr($datalevel[$i]['children'][$sf]['id'],1)."'";
                        if($sf<count($datalevel[$i]['children'])-1){
                            $sql.= " or ";
                        }
                    }
                    $sql.= " and ";
                }
                if($datalevel[$i]['text']=="Grade"){

                    for($g=0;$g<count($datalevel[$i]['children']);$g++) {
                        $sql .= " GRD_code='" . substr($datalevel[$i]['children'][$g]['id'],1)."'";
                        if($g<count($datalevel[$i]['children'])-1){
                            $sql.= " or ";
                        }
                    }
                    $sql.= " and ";
                }
                if($datalevel[$i]['text']=="Employee Type"){

                    for($et=0;$et<count($datalevel[$i]['children']);$et++) {
                        $sql .= " TYPE_code='" . substr($datalevel[$i]['children'][$et]['id'],1)."'";
                        if($et<count($datalevel[$i]['children'])-1){
                            $sql.= " or ";
                        }
                    }
                    $sql.= " and ";
                }

                if($datalevel[$i]['text']=="Process"){

                    for($pr=0;$pr<count($datalevel[$i]['children']);$pr++) {
                        $sql .= " PROC_code='" . substr($datalevel[$i]['children'][$pr]['id'],1)."'";
                        if($pr<count($datalevel[$i]['children'])-1){
                            $sql.= " or ";
                        }
                    }
                    $sql.= " and ";
                }

            }
            $sql.="Status_Code='01'";

            //echo $sql;
            $result = query($query,$sql,$pa,$opt,$ms_db);
            if ($num($result) > 0) {
                $list=array();

                while($row1 = $fetch($result)) {
                    $list[] = $row1['Emp_Code'];


                }
                if(in_array($code,$list)){
                    echo $row['LevelNo']; echo ";";
                    echo $row['NoDays']; echo ";";
                    echo $row['Approver'];

                    exit;

                }


            }
            else{
                echo 2 ;
            }


        }
    }

}
elseif (isset($_GET['type']) && $_GET['type']=='data2') {
    if(isset($_POST['dataval']) && $_POST['dataval'] == ""){
        echo "Manager is not Available";
    }else{
        $lev = explode(',',$_POST['dataval']);
    for($i=0;$i<count($lev);$i++){
        if($lev[$i]=='Reporting Manager'){
            $sqlr="Select * from hrdmastQry where Emp_Code='$code'";
            $resultr = query($query,$sqlr,$pa,$opt,$ms_db);
            while($rowr = $fetch($resultr)){
                $code1 = $rowr['MNGR_CODE'];
                $sql1="Select * from hrdmastQry where Emp_Code='$code1'";
                $result1 = query($query,$sql1,$pa,$opt,$ms_db);
                while($row1 = $fetch($result1)){
                echo "<span class='appMan blue-bg'>
                        <span class='appManImg'>";
                            if($row1['EmpImage'] == ""){
                             echo "<img class='img-circle img50' src='../Profile/upload_images/images (2).jpg' >"; }else{
                             echo "<img class='img-circle img50' src='../Profile/upload_images/".$row1['EmpImage']."' >";}
                echo      "  </span>";
                echo    "    <span class='appManName' data-des='".$row1['DSG_NAME']."'>";
                                echo $row1['EMP_NAME']; 

                        echo"</span></span>";
                    $approverID[]= $row1['Emp_Code']; 
                }

            }
        }
        if($lev[$i]=='Functional Manager'){
            $sqlf="Select * from hrdmastQry where Emp_Code='$code'";
            $resultf = query($query,$sqlf,$pa,$opt,$ms_db);
            while($rowf = $fetch($resultf)){
                $code2 = $rowf['MNGR_CODE2'];
                $sql2="Select * from hrdmastQry where Emp_Code='$code2'";
                $result2 = query($query,$sql2,$pa,$opt,$ms_db);
                while($row2 = $fetch($result2)){
                    echo "<span class='appMan blue-bg'>
                        <span class='appManImg'>";
                     if($row2['EmpImage'] == ""){echo "<img class='img-circle img50' src='../Profile/upload_images/images (2).jpg' >"; echo ",";}else{echo "<img class='img-circle img50' src='../Profile/upload_images/".$row2['EmpImage']."' >";} 
                    echo      "  </span>";
                    echo    "    <span class='appManName' data-des='".$row2['DSG_NAME']."'>";  
                    echo $row2['EMP_NAME'];  
                     echo"</span></span>";
                    $approverID[]=$row2['Emp_Code'];
                }

            }
        }
        if($lev[$i]=='Function Head'){
            $sqlfh="Select * from hrdmastQry where Emp_Code='$code'";
            $resultfh = query($query,$sqlfh,$pa,$opt,$ms_db);
            while($rowfh = $fetch($resultfh)){
                $code3 = $rowfh['FunctionHead_Code'];
                $sql3="Select * from hrdmastQry where Emp_Code='$code3'";
                $result3 = query($query,$sql3,$pa,$opt,$ms_db);
                while($row3 = $fetch($result3)){
                    echo "<span class='appMan blue-bg'>
                        <span class='appManImg'>";
                     if($row3['EmpImage'] == ""){echo "<img class='img-circle img50' src='../Profile/upload_images/images (2).jpg' >"; }else{echo "<img class='img-circle img50' src='../Profile/upload_images/".$row3['EmpImage']."' >";  }
                    echo      "  </span>";
                    echo    "    <span class='appManName'>";   

                    echo $row3['EMP_NAME']; echo "<i> "; echo $row3['DSG_NAME']; echo "</i>";
                     echo"</span></span>";
                    $approverID[]= $row3['Emp_Code'];
                }

            }
        }
        if($lev[$i]=='Bussiness Unit Head'){
            $sqlb="Select * from hrdmastQry where Emp_Code='$code'";
            $resultb = query($query,$sqlb,$pa,$opt,$ms_db);
            while($rowb = $fetch($resultb)){
                $code4 = $rowb['BussUnitHead_Code'];
                $sql4="Select * from hrdmastQry where Emp_Code='$code4'";
                $result4 = query($query,$sql4,$pa,$opt,$ms_db);
                while($row4 = $fetch($result4)){
                    echo "<span class='appMan blue-bg'>
                        <span class='appManImg'>";
                     if($row4['EmpImage'] == ""){echo "<img class='img-circle img50' src='../Profile/upload_images/images (2).jpg' >"; echo ",";}else{echo "<img class='img-circle' src='../Profile/upload_images/".$row4['EmpImage']."' >"; echo ",";} 
                     echo      "  </span>";
                    echo    "    <span class='appManName'>";
                    echo $row4['EMP_NAME']; echo "<i> "; echo $row4['DSG_NAME']; echo"</i>"; 
                     echo"</span></span>";
                    $approverID[] = $row4['Emp_Code'];
                }

            }
        }
        if($lev[$i]=='Sub Functional Head'){
            $sqlsf="Select * from hrdmastQry where Emp_Code='$code'";
            $resultsf = query($query,$sqlsf,$pa,$opt,$ms_db);
            while($rowsf = $fetch($resultsf)){
                $code5 = $rowsf['SubFunctionHead_Code'];
                $sql5="Select * from hrdmastQry where Emp_Code='$code5'";
                $result5 = query($query,$sql5,$pa,$opt,$ms_db);
                while($row5 = $fetch($result5)){
                    echo "<span class='appMan blue-bg'>
                        <span class='appManImg'>";
                    if($row5['EmpImage'] == ""){echo "<img class='img-circle img50' src='../Profile/upload_images/images (2).jpg' >"; }else{echo "<img class='img-circle img50' src='../Profile/upload_images/".$row5['EmpImage']."' >"; }
                    echo      "  </span>";
                    echo    "    <span class='appManName'>";
                    echo $row5['EMP_NAME']; echo "<i>"; echo $row5['DSG_NAME']; echo"</i>";
                     echo"</span></span>";
                    $approverID[]=$row5['Emp_Code'];
                }

            }
        }
        if($lev[$i]=='Sub Bussiness Head'){
            $sqlsb="Select * from hrdmastQry where Emp_Code='$code'";
            $resultsb = query($query,$sqlsb,$pa,$opt,$ms_db);
            while($rowsb = $fetch($resultsb)){
                $code6 = $rowsb['SubBussHead_Code'];
                $sql6="Select * from hrdmastQry where Emp_Code='$code6'";
                $result6 = query($query,$sql6,$pa,$opt,$ms_db);
                while($row6 = $fetch($result6)){
                    echo "<span class='appMan blue-bg'>
                        <span class='appManImg'>";
                    if($row6['EmpImage'] == ""){echo "<img class='img-circle' src='../Profile/upload_images/images (2).jpg' >"; }else{ echo "<img class='img-circle' src='../Profile/upload_images/".$row6['EmpImage']."' >";  }
                    echo      "  </span>";
                    echo    "    <span class='appManName' data-des='".$row6['DSG_NAME']."'>";
                    echo $row6['EMP_NAME']; 
                     echo"</span></span>";
                    $approverI[] = $row6['Emp_Code'];
                }

            }
        }

    }
     $appID = implode(',',$approverID);

    echo'<input type="hidden" id="approverId" value="'.$appID.'">';
    }
    
}


//echo $list;

function newdatawork($data){

    $newArray = array();
    $y = 0;
    for($i = 0; $i < count($data); $i++){
        if(@array_key_exists('state',$data[$i])  && count($data[$i]['state']) > 0 && $data[$i]['state']['selected']=="show"){
            $newArray[$y]['text'] = $data[$i]['text'];
            //$newArray[$y]['count']=count($data);

            if(array_key_exists('children',$data[$i]) && count($data[$i]['children']) > 0){
                for($j=0;$j< count($data[$i]['children']) ;$j++ ) {

                    if ($data[$i]['children'][$j]['state']['selected']=='show') {  
                        $newArray[$y]['children'][]['id'] = $data[$i]['children'][$j]['id'];
                        //$newArray[$y]['children'][]['text'] = $data[$i]['children'][$j]['text'];

                        //$newArray[$y]['children'][]['count'] = count($data[$i]['children']);
                    }

                }
            }
            $y++;
        }

    }
    return $newArray;
}

?>