<?php
include('../../db_conn.php');
include('../../configdata.php');
@session_start();
$type=$_GET['type'];
$code=$_SESSION['usercode'];
$d=$_POST['d'];

$sql='';

if ($d =="mngr") {

$sql.="select * from hrdmastqry where MNGR_CODE='$code'";

}

else{
 $sql.="Select * from hrdmastQry";

$datalevel =  $_POST['data'];

//print_r($datalevel[0]['children'][0]['id']);

$datalevel =newdatawork($datalevel);



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
}

    //echo $sql;
    $result = query($query,$sql,$pa,$opt,$ms_db);
    if ($num($result) > 0) {
      $list="";         
      if($type=='bulk'){
        while($row = $fetch($result)) {
          $name = $row['EMP_NAME'];
			echo '<option value="' . $row['Emp_Code']. '" >' . $name .'('.$row['Emp_Code'].')' . '</option>';
		}
      }
      elseif($type == 'selected'){
		$selectdata = $_POST['selectdata'];
		  while($row = $fetch($result)) {
				$name = $row['EMP_NAME'];
				if(array_key_exists($row['Emp_Code'], $selectdata)){
				echo '<option value="' . $row['Emp_Code']. '" selected="selected">' . $name .'('.$row['Emp_Code'].')' . '</option>';	
				}else{
				echo '<option value="' . $row['Emp_Code']. '" >' . $name .'('.$row['Emp_Code'].')' . '</option>';
				}
			} 
	  } else{
        $list1='';
        $list2='';
        echo "<div style='height:200px;overflow:auto;padding-top:10px;border:1px solid #eee;'><ul>";
        while($row = $fetch($result)) {
          $name = $row['EMP_NAME'];
         $list1.= $row['Emp_Code'] .',';
        // $list2.= $name .',';
          echo "<li style='list-style:none;border-bottom:1px solid #eee;display:table;width:100% ' id='licon".$row['Emp_Code']."'>";
          echo "<div class='col-md-9' style='padding-top:10px;'>".$name."(".$row['Emp_Code'].")" ."</div> <div class='col-md-2'> ";
          
          ?>
          <a class="btn red" id="canclebtn<?php echo $row['Emp_Code']; ?>" style="font-size:14px;display:block" onclick="Roster.selallcancle('<?php echo $row['Emp_Code']; ?>');"> <i class="fa fa-times"></i> </a>
          <a class="btn green" id="addbtn<?php echo$row['Emp_Code']; ?>" style="display:none" onclick="Roster.selallsubmit('<?php echo $row['Emp_Code']; ?>');" ><i class="fa fa-plus"></i></a>
          <?php
          echo "</div>";
          echo "</li >";

      }
      $list=rtrim($list1,',');
      echo "</ ul>
        <input type='hidden' id='checkhid_r' value='".$list."'>
      </div>";

      
      }
      

    }
else{
    echo 2 ;
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