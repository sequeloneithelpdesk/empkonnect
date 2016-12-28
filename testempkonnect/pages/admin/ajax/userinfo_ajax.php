 <?php

include("../../db_conn.php");
include('../../configdata.php');

$type=$_GET['type'];

if($type=="usercode"){
$code=$_POST['empcode'];
$userinfo=array();
$sql="select * from hrdmastqry where emp_Code='$code' and status_code='01'";

$query2=  query($query,$sql,$pa,$opt,$ms_db); 

while($row=$fetch($query2)){

$userinfo[]=$row['EMP_NAME'] ;
$userinfo[]=trim($row['OEMailID'],"");

}

//echo $userinfo;

echo $info=json_encode($userinfo,true) ;
//print_r($userinfo);

}

if($type=="rolesub"){

	$code=$_POST['code'];
	$name=$_POST['name'];
	$email=$_POST['email'];
	$role=$_POST['role'];
	$codecrypt=md5($code);
	$emailcrypt=md5(trim($email));
	//$passcrypt=md5("password");
	$date=date("Y-m-d H:i:s");
	$status=1;
	
	$sql="select * from usersroles where userid='$code'";
	$sqlre= query($query,$sql,$pa,$opt,$ms_db);
	if($num($sqlre) >=1){

	}
	else {
		$sql="select * from users where userID='$codecrypt'";
		$sqlre= query($query,$sql,$pa,$opt,$ms_db);
		if($num($sqlre) >=1){

		}
		else{
		$usertable = query($query,"insert into users (userId, username, useremailid, islocked, userActive,UserType) 
		values ('$codecrypt','$name','$emailcrypt','N','0','U') ",$pa,$opt,$ms_db);

			//mail
		$to=$email;
		//$to[]='himanshu@agnitioworld.com';
		$message=welcome_msg($code);
		$subject='Welcome message !';
		//$message.='https://empkonnect.sequelone.com/pages/login/resetPass.php?usercode='.$code;
		@mymailer('donotreply@sequelone.com',$subject,$message,$to);
	}  }
	$sqlc="select * from usersroles where userid='$code' and roleId='".$role."' ";
	$sqlrec= query($query,$sqlc,$pa,$opt,$ms_db);
	if($num($sqlrec) >=1){
		echo"Already Role define .";
	}
	else {
		$result = query($query,"insert into usersroles (roleId, username, userid, menucode, actions, createdby, createdon) values ('$role','$name','$code','$email','$status','$user','$date') ",$pa,$opt,$ms_db);
		if ($result) {
			echo 1;
		} else {
			echo "N";
		}
	}


}

elseif ($type=="init") {
	$query1="SELECT b.role_name,b.id as roleid ,a.username,a.userid,a.menucode,a.actions FROM usersroles a join hrms_role b on a.roleId=b.id ";
	$sql= query($query,$query1,$pa,$opt,$ms_db)
	?>
	<table class="table table-striped table-bordered table-hover" id="sample_3"> 
	<thead><tr> <th align="center" > Role Name</th>
	<th align="center" > User Name</th>
	<th align="center" > User Code</th>
	<th align="center" > User Email</th>
	<th align="center">Status</th>
	<th align="center"> Action </th>

	 </tr></thead>
	 <tbody>
	<?php
	$i=0;
	while($row=$fetch($sql)){  ?>
		<tr id="roleid<?php echo$i; ?>">
		<td align="center"><?php  echo$row['role_name'] ?></td>
		<td align="center"><?php  echo$row['username'] ?></td>
		<td align="center"><?php  echo$row['userid'] ?></td>
		<td align="center"><?php  echo$row['menucode'] ?></td>
		<td align="center"><button type="button" class="btn btn-default" id="st<?php echo$i; ?>" onclick="User.deletefunc(<?php  echo$row['userid'] ?>,<?php echo$i; ?>,'<?php  echo$row['actions'] ?>')"><?php  if($row['actions']==1){ echo "Active"; }else{ echo"Inactive" ;} ?> </button></td>
		<td align="center">
				<a class="btn btn-icon-only green" onclick="Role.showrole(<?php  echo$row['roleid'] ?>,'<?php  echo$row['role_name'] ?>');">
				<i class="fa fa-eye"></i>
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
	if($status==1){
		$status1=0;
	}
	else{
		$status1=1;
	}

//echo $data;
	$sql1="update usersroles set actions='$status1'  where userid='$id' ";
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

