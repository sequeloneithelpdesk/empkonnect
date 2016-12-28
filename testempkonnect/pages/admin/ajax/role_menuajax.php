<?php

include ('../../db_conn.php');
include('../../configdata.php');
// $json = file_get_contents('../js/menujson.json'); 
// $data = json_encode($json,true);

$type=$_GET['type'];
if($type=="menu"){
	$sql="select menu from hrms_menu ";
	$result= query($query,$sql,$pa,$opt,$ms_db);
	$product=$fetch($result);


	$data = $product['menu'];
	echo $data ;
//print_r($data);

}

elseif ($type=="data") {
	//$datamenu=array();
	//echo"1";
	$json = file_get_contents('../js/datamenu.json');
	$data = json_decode($json,true);
	//print_r($data);
	//echo"<br>";
	$i=0; $l=0;$w=0;$e=0;$f=0;$ft=0;$g=0;$le=0;$p=0;$con=0;$cost=0;$r=0;$state=0;$com=0;
	$sql=query($query,"select COMPID,COMP_NAME from CompMast ",$pa,$opt,$ms_db);
	while($row=$fetch($sql)){
		$data[0]['children'][$com]['id']="a".$row['COMPID'] ;
		$data[0]['children'][$com]['text']=$row['COMP_NAME'] ;
		$data[0]['children'][$com]['icon']="icon-pin" ;
		$data[0]['children'][$com]['state']['selected']=true ;
		$com++;
	}
	$sql=query($query,"select bussName,bussID from bussmast ",$pa,$opt,$ms_db);
	while($row=$fetch($sql)){
		$data[1]['children'][$i]['id']="b".$row['bussID'] ;
		$data[1]['children'][$i]['text']=$row['bussName'] ;
		$data[1]['children'][$i]['icon']="icon-pin" ;
		$data[1]['children'][$i]['state']['selected']=true ;
		$i++;
	}
	$sql=query($query,"select loc_Name,locID from locmast ",$pa,$opt,$ms_db);
	while($row=$fetch($sql)){
		$data[2]['children'][$l]['id']="c".$row['locID'] ;
		$data[2]['children'][$l]['text']=$row['loc_Name'] ;
		$data[2]['children'][$l]['icon']="icon-pin" ;
		$data[2]['children'][$l]['state']['selected']=true ;
		$l++;
	}
	$sql=query($query,"select wLoc_Name,workLocID from worklocmast ",$pa,$opt,$ms_db);
	while($row=$fetch($sql)){
		$data[3]['children'][$w]['id']="d".$row['workLocID'] ;
		$data[3]['children'][$w]['text']=$row['wLoc_Name'] ;
		$data[3]['children'][$w]['icon']="icon-pin" ;
		$data[3]['children'][$w]['state']['selected']=true ;
		$w++;
	}
	$sql=query($query,"select funct_Name,functID from functmast ",$pa,$opt,$ms_db);
	while($row=$fetch($sql)){
		$data[4]['children'][$f]['id']="e".$row['functID'] ;
		$data[4]['children'][$f]['text']=$row['funct_Name'] ;
		$data[4]['children'][$f]['icon']="icon-pin" ;
		$data[4]['children'][$f]['state']['selected']=true ;
		$f++;
	}
	$sql=query($query,"select subFunct_Name,subFunctID from subfunctmast ",$pa,$opt,$ms_db);
	while($row=$fetch($sql)){
		$data[5]['children'][$ft]['id']="f".$row['subFunctID'] ;
		$data[5]['children'][$ft]['text']=$row['subFunct_Name'] ;
		$data[5]['children'][$ft]['icon']="icon-pin" ;
		$data[5]['children'][$ft]['state']['selected']=true ;
		$ft++;
	}
	$sql=query($query,"select grd_Name,grdID from grdmast ",$pa,$opt,$ms_db);
	while($row=$fetch($sql)){
		$data[6]['children'][$g]['id']="g".$row['grdID'] ;
		$data[6]['children'][$g]['text']=$row['grd_Name'] ;
		$data[6]['children'][$g]['icon']="icon-pin" ;
		$data[6]['children'][$g]['state']['selected']=true ;
		$g++;
	}
	$sql=query($query,"select Type_Name,TypeID from emptype ",$pa,$opt,$ms_db);
	while($row=$fetch($sql)){
		$data[7]['children'][$e]['id']="h".$row['TypeID'] ;
		$data[7]['children'][$e]['text']=$row['Type_Name'] ;
		$data[7]['children'][$e]['icon']="icon-pin" ;
		$data[7]['children'][$e]['state']['selected']=true ;
		$e++;
	}
	$sql=query($query,"select proc_Name,procID from procmast  ",$pa,$opt,$ms_db);
	while($row=$fetch($sql)){
		$data[8]['children'][$p]['id']="i".$row['procID'] ;
		$data[8]['children'][$p]['text']=$row['proc_Name'] ;
		$data[8]['children'][$p]['icon']="icon-pin" ;
		$data[8]['children'][$p]['state']['selected']=true ;
		$p++;
	}
	
	
	
	//echo $data;
	$data=json_encode($data);
	print_r($data);

}

//show role in js tree //////////////////////////

elseif($type=="showmenu"){
	$id=$_POST['id'];
	$sql="select role_menu from hrms_role where id=$id ";
	$result= query($query,$sql,$pa,$opt,$ms_db);
	$product=$fetch($result);


	$data = $product['role_menu'];
	echo $data ;
//print_r($data);

}
elseif($type=="showdata"){
	$id=$_POST['id'];
	$sql="select data_menu from hrms_role where id=$id ";
	$result= query($query,$sql,$pa,$opt,$ms_db);
	$product=$fetch($result);


	$data = $product['data_menu'];
	echo $data ;
//print_r($data);

}

//edit role in js tree //////////////////////////

elseif($type=="editmenu"){
	$id=$_POST['id'];
	$sql="select role_menu from hrms_role where id=$id ";
	$result= query($query,$sql,$pa,$opt,$ms_db);
	$product=$fetch($result);


	$data = $product['role_menu'];
	echo $data ;
//print_r($data);

}
elseif($type=="editdata"){
	$id=$_POST['id'];
	$sql="select data_menu from hrms_role where id=$id ";
	$result= query($query,$sql,$pa,$opt,$ms_db);
	$product=$fetch($result);

	$data = $product['data_menu'];
	echo $data ;
//print_r($data);

}


?>