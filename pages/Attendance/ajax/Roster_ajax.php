<?php
include('../../db_conn.php');
include('../../configdata.php');
@session_start();

//echo $tblName;
if(isset($_GET['type']) && $_GET['type']=='defaultValue') {

    $tblName = $_POST['tblName'];
    $data=$_POST['data'];
    //print_r($data);
    $list = "";
    for($i=0;$i<count($data);$i++){
        if($data[$i]['id']== $tblName) {
            if(!empty($data[$i]['children'])) {
                for ($a = 0; $a < count($data[$i]['children']); $a++) {
                    $list .= "<input type='checkbox' onclick='Roster.checkevent(this);' class='col-md-2 checkboxes checkclass_".$i."_".$a."' id='" . $data[$i]['children'][$a]['id'] . "' value='" . $data[$i]['children'][$a]['id'] . "' ";
                    if ($data[$i]['children'][$a]['state']['selected'] == "show") {
                        $list .= " checked ";
                    }
                    $list .= "name='" . $data[$i]['children'][$a]['id'] . "'/>
        <label for='" . $data[$i]['children'][$a]['id'] . "' class='col-md-10'>" . $data[$i]['children'][$a]['text'] . "</label>";
                }
            }
            else{
                $list="No data in ".$data[$i]['text'];
            }
        }

    }

        echo $list;

}

else if(isset($_GET['type']) && $_GET['type']=='showdata') {

    $childName = $_POST['childval'];
    $tblName = $_POST['tblName'];
    $data=$_POST['data'];
    for($i=0;$i<count($data);$i++){
        if($data[$i]['id']== $tblName) {
            $data[$i]['state']['selected']= "show" ;
            for($a=0;$a<count($data[$i]['children']);$a++) {
                if($data[$i]['children'][$a]['id']== $childName){
                    $data[$i]['children'][$a]['state']['selected']= "show" ;
                }
            }
        }

    }
    echo json_encode($data) ;

}

else if(isset($_GET['type']) && $_GET['type']=='hidedata') {

    $childName = $_POST['childval'];
    $tblName = $_POST['tblName'];
    $data=$_POST['data'];
    for($i=0;$i<count($data);$i++){
        if($data[$i]['id']== $tblName) {
            $z=count($data[$i]['children']) ;
            for($a=0;$a<count($data[$i]['children']);$a++) {

                if($data[$i]['children'][$a]['id']== $childName){
                    $data[$i]['children'][$a]['state']['selected']= true ;
                }
                if($data[$i]['children'][$a]['state']['selected']== "true"){
                    $z=$z-1;
                }

            }
            if($z==0){
                $data[$i]['state']['selected']= true ;
            }
        }

    }
    echo json_encode($data) ;

}

else if(isset($_GET['type']) && $_GET['type']=='imp_finaldata') {

    
    $pid = $_GET['pid']; 
    $data=$_POST['data'];
     for($i=0;$i<count($data);$i++){
        if($data[$i]['text']== $pid) {
            $data[$i]['state']['selected']= true ;
            for($a=0;$a<count($data[$i]['children']);$a++) {
                
                    $data[$i]['children'][$a]['state']['selected']= true ;
                
            }
        }

    }
    echo json_encode($data) ;

}

else if(isset($_GET['type']) && $_GET['type']=='child_finaldata') {

    
    $pid = $_GET['pid'];
    $chid = $_GET['chid']; 
    $data=$_POST['data'];
     for($i=0;$i<count($data);$i++){
        if($data[$i]['text']== $pid) {
            $cc=0;
            for($a=0;$a<count($data[$i]['children']);$a++) {
                if($data[$i]['children'][$a]['text']== $chid){
                    $data[$i]['children'][$a]['state']['selected']= true ;
                }else{
                 if($data[$i]['children'][$a]['state']['selected']== "show"){ 
                   $cc++;

                   }
                }
                
            }

            if($cc==0){
                $data[$i]['state']['selected']= true ;
            }
        }

    }
    echo json_encode($data) ;

}


else if(isset($_GET['type']) && $_GET['type']=='finaldata') {

    $newdata=$_POST['data'];
//
    //$newdata=newdatawork($newdata);
    //print_r($newdata);
    echo '<ul>';
    for($i=0;$i<count($newdata);$i++) {
        if ($newdata[$i]['state']['selected'] == "show") {
            echo "<li style='display:table;width:100% '><div class='col-md-8'>" . $newdata[$i]['text']."</div><div class='col-md-4'>"; ?>
            <a onclick="Roster.par_del('<?php echo $newdata[$i]['text']; ?>')"><i class="fa fa-times"></i></a>
            <?php  echo"</div>";
            if (count($newdata[$i]['children']) > 0 ) {
                echo "<ul>";
                for ($a = 0; $a < count($newdata[$i]['children']); $a++) {
                    if ($newdata[$i]['children'][$a]['state']['selected'] == "show") {
                        echo "<li style='display:table;width:100% '><div class='col-md-7'>" . $newdata[$i]['children'][$a]['text'] . "</div><div class='col-md-4'>"; ?>
            <a onclick="Roster.child_del('<?php echo $newdata[$i]['text']; ?>','<?php echo $newdata[$i]['children'][$a]['text'] ; ?>')"><i class="fa fa-times"></i></a>
            <?php  echo"</div></li>";
                    }
                }
                echo "</ul>";
            }
            echo "</li>";
        }
    }
    echo "</ul>";

    //echo $list;


}

else if(isset($_GET['type']) && $_GET['type']=='subdata') {

$data=$_POST['savedata'] ;
//$emp=$_POST['emp'];
//echo $emp;
$auto=$_POST['ck'];
$sdate=$_POST['startrost'];
$edate=$_POST['endrost'];

$name=$_POST['names'];
$name=explode(',', $name);
$r_name=$_POST['r_name'];
$edit=$_POST['edit'];

//print_r($data);
//echo"</br>-----------//////////////</br>";
//print_r($name);
//echo $sql="insert into attroster (Emp_Code,empcode,AttStatus,ShiftMastID,ShiftPatternMastID,ATT_FROM, ATT_TO ,automatic_period) values 
//('$workName','$emp','1','$rshift','$rshiftp','".dateConversion($dfrom)."','".dateConversion($dto)."','$auto_p')";
//$result=query($query, $sql, $pa, $opt, $ms_db);
//echo"<br>-----------//////////////</br>";

	if($edit == 1){
		$sqlD1="Delete from  att_roster where roster = '$r_name'" ;
		$resultD1=query($query, $sqlD1, $pa, $opt, $ms_db);
		$sqlD2="Delete from  Roster_schema where RosterName = '$r_name'" ;
		$resultD2=query($query, $sqlD2, $pa, $opt, $ms_db);
		
	}

	$sql="insert into att_roster (roster,shiftMaster,shiftPattern,RosterDate,auto_period) values ";
	$w=0;
	foreach($data as $key => $d){
	if($w>0){
		$sql.=",";
	}

	 $sql.="('$r_name','".$d['SM']."','".$d['SP']."','$key',$auto)";


	$w++;
	}

	$sqlr="insert into Roster_schema (RosterName,Emp_Code,start_rost,end_rost,auto_period) values";

	for($i=0;$i<count($name);$i++){

	 $sqlr.=" ('$r_name','$name[$i]','$sdate','$edate','$auto')";
	 if($i==(count($name)-1)){}
		else{ $sqlr.=","; }
	}
	 //echo $sqlr;
     //echo $sql;
	 $result=query($query, $sql, $pa, $opt, $ms_db);
	$resultr=query($query, $sqlr, $pa, $opt, $ms_db);
	if($result && $resultr){
		echo 1;

	}
	else{
		echo 2;
	}
}else if(isset($_GET['type']) && $_GET['type']=='getrostervalue') {
	$rostername = $_POST['value'];
	$sql = "select a.EMP_NAME,b.Emp_Code,convert(varchar(10),b.start_rost,21) as start_rost,convert(varchar(10),b.end_rost,21) as end_rost,b.auto_period from HrdMastQry a inner join Roster_schema b on a.Emp_Code = b.Emp_Code and RosterName = '$rostername'";
	$result = query($query, $sql, $pa, $opt, $ms_db);
	$rosterA = array();
	while($row = $fetch($result)){
		$rosterA['Emp'][$row['Emp_Code']] = array("name" => $row['EMP_NAME']);
		$rosterA['auto_period'] = $row['auto_period'];
		$rosterA['start_rost'] = $row['start_rost'];
		$rosterA['end_rost'] = $row['end_rost'];
	}
	
	
	$sqlC = "select convert(varchar(10),RosterDate,21) as RosterDate,shiftMaster,shiftPattern from att_roster where roster = '$rostername'";
	$resultC = query($query, $sqlC, $pa, $opt, $ms_db);
	$rosterA['RosterDate'] = array();
	while($rowC = $fetch($resultC)){

		$rosterA['RosterDate'][(string)$rowC['RosterDate']] = array("SM" => intval($rowC['shiftMaster']),"SP" => intval($rowC['shiftPattern']));
		
	}
	$rosterA['date'] = date('Y-m-d'); 
	echo json_encode($rosterA,1);
	
	
}else if(isset($_GET['type']) && $_GET['type']=='updateEditDropdown') {
	 
	$sql = "select RosterName,count(Emp_Code) as count from Roster_schema group by RosterName order by RosterName";
	$result=query($query, $sql, $pa, $opt, $ms_db);
	$rostername = array();
	while($row=$fetch($result)){
		$rostername[$row['RosterName']] = array("count" => $row["count"]);
	}
	$html = "<option> --Select Roster--</option>";
						foreach($rostername as $rname => $rA){
							$html .="<option value='".$rname."'>".$rname." (".$rA['count'].")</option>";
						}
						echo $html;
 
	
	
}


function newdatawork($data){

    $newArray = array();
    $y = 0;
    for($i = 0; $i < count($data); $i++){
        if($data[$i]['state']['selected']=="show"){
            $newArray[] = $data[$i];
        }else{
            if(array_key_exists('children',$data[$i]) && count($data[$i]['children']) > 0){
                $data[$i]['children'] = newdatawork($data[$i]['children']);
                if(array_key_exists('children',$data[$i]) && count($data[$i]['children'])){
                    $newArray[] = $data[$i];
                }
            }
        }
    }
    return $newArray;
}

function dateConversion($sDate){

    if($sDate==""){
        $sMySQLTimestamp="00:00:00";
    }
    else{
    $aDate = explode('/', $sDate);

    @$sMySQLTimestamp = sprintf(
        '%s-%s-%s 00:00:00',
        @$aDate[2],
        @$aDate[1],
        @$aDate[0]
    );
    }
    return $sMySQLTimestamp;

}






?>