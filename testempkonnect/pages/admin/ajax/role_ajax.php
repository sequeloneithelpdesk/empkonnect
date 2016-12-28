<?php
error_reporting();
ini_set("display_errors", 1);
include('../../db_conn.php');
include('../../configdata.php');
// $comp_code="ABC";
 $type=$_POST['type'];
if($type=="create"){
	$name=$_POST['role'];
$role=$_POST['roledata'];
$data=$_POST['datamenu'];
$status="Active";
//$date=date("Y-m-d H:i:s");
	$check=$_POST['check'];
//echo $data;
	 $sql1="insert into hrms_role (role_name,role_menu,data_menu,defaultrole,status,createdby,createdon) values ('$name','$role','$data','$check','$status','$user',getdate()) ";

 //$params=array($name,$role,$data,$check,$status,$user,$date);
	$result1 = query($query,$sql1,$pa,$opt,$ms_db);

if($result1){
  echo "Y" ;
}
else{
  echo "N";
}


}

elseif($type=="edit"){
	$name=$_POST['role'];
$role=$_POST['roledata'];
$data=$_POST['datamenu'];
$id=$_POST['id'];
//$date=date("Y-m-d H:i:s");
//echo $data;
 $sql1="update hrms_role set role_menu='$role',data_menu='$data',updatedby='$user',updatedon=getdate() where id='$id' ";
 $result1 = query($query,$sql1,$pa,$opt,$ms_db);
 //$result1->bind_param('ssssi',$role,$data,$user,$date,$id);

if($result1){
  echo "Y" ;
}
else{
  echo "N";
}


}

elseif ($type=="init") {
	$sqlq="select * from hrms_role order by role_name";
	$sql=query($query,$sqlq,$pa,$opt,$ms_db);
	//echo$query;

	?>
	<table class="table table-striped table-bordered table-hover" id="sample_3"> 
	<thead><tr> <th align="center" > Role Name</th>
	<th align="center">Status</th>
	<th align="center"> Action </th>

	 </tr></thead>
	 <tbody>
	<?php
	$i=0;
	while($row=$fetch($sql)){  ?>
		<tr id="roleid<?php echo$i; ?>">
		<td align="center"><?php  echo$row['role_name'] ?></td>
		<td align="center"><button type="button" class="btn btn-default" id="st<?php echo$i; ?>"
	   onclick="Role.deletefunc(<?php  echo$row['Id'] ?>,<?php echo$i; ?>,'<?php  echo$row['status'] ?>')"><?php  echo$row['status'] ?> </button></td>
		<td align="center">
				<a class="btn btn-icon-only green" onclick="Role.showrole(<?php  echo$row['Id'] ?>,'<?php  echo$row['role_name'] ?>');">
				<i class="fa fa-eye"></i>
				</a>
				<a class="btn btn-icon-only green" onclick="Role.editrole(<?php  echo$row['Id'] ?>,'<?php  echo$row['role_name'] ?>');">
				<i class="fa fa-edit"></i>
				</a>

		<?php  ?></td>
		</tr>
	<?php $i++; }
	?>
	</tbody>
	</table>

	<?php }

elseif($type=="delete"){
	$status=$_POST['status'];
$id=$_POST['id'];
$date=date("Y-m-d H:i:s");
if($status=="Active"){
	$status="Inactive";
}
else{
	$status="Active";
}

//echo $data;
 $sql1="update hrms_role set status='$status', updatedby='$user',updatedon=getdate() where Id='$id' ";
 $result1 = query($query,$sql1,$pa,$opt,$ms_db);
 //$result1->bind_param('ssssi',$role,$data,$user,$date,$id);

if($result1){
  echo "Y" ;
}
else{
  echo "N";
}


}


?>