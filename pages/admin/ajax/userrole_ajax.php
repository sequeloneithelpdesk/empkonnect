<?php
include("../../db_conn.php");
include('../../configdata.php');
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<div class="modal-dialog">
    <div class="modal-content">
      	<div class="modal-header modal-color white-color" >
        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
        		<span aria-hidden="true" class="white-color"></span>
        	</button>
        	<h4 class="modal-title" id="myModalLabel">User Role</h4>
      	</div>
      	<div class="modal-body">
        
			<div class="form-body form-horizontal">
				<div class="form-group">
					<div class="col-md-12">
						<label class="col-md-4 label-control">User Code</label>
						<div class="col-md-8">
							<select id="usercode" class="bs-select form-control usercodesl" onchange="User.filluser(this.value)">
							<option value="">Select User Code</option>
							<?php  
								$sql = "select * from hrdmastqry where status_code = '01' or status_code = '1' ";
								$query2 = query($query,$sql,$pa,$opt,$ms_db);

								while($row=$fetch($query2)){ ?>
									<option value="<?php  echo$row['Emp_Code'] ?>"> 
										<?php  echo $row['EMP_NAME']." (".$row['Emp_Code'].")" ?>
									</option>
							<?php } ?>
							</select>
							<input type="text" id="usercode1" class="form-control usercodein" style="display:none" onchange="User.fill()">
							<input type="hidden" id="hidcode" value="">
						</div>
						<div class="col-md-12">
							<div class="col-md-offset-4 col-md-6">
								<input type="checkbox" id="checknew">
								<span>Individual User </span>
							</div>
						</div>
					</div>
				</div>
						
				<div class="form-group">
					<div class="col-md-12">
						<label class="col-md-4 label-control">User Name</label>
						<div class="col-md-8">
						<input type="text" id="user_name" class="form-control">
							
						</div>
						
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-12">
						<label class="col-md-4 label-control">User Email</label>
						<div class="col-md-8">
							<input type="text" id="user_email" class="form-control" onkeyup="validate.email('user_email','errorhid')">
							
						</div>
						
					</div>
				</div>


				<div class="form-group">
					<div class="col-md-12">
						<label class="col-md-4 label-control">User Role</label>
						<div class="col-md-8">
						<select id="rolecode" class="bs-select form-control" onchange="User.roleconfirm(this.html,'AddRole')">
							<?php  

							$sql1="select * from hrms_role where status = '1' or status ='Active' ";

							$query1=  query($query,$sql1,$pa,$opt,$ms_db);

							while($row1=$fetch($query1)){
							?>
							
							<option value="<?php  echo$row1['Id'] ?>"
							<?php if($row1['DefaultRole']==1){ echo"selected"; } else{} ?> >
							<?php echo $row1['role_name'] ?>
							</option>
							<?php  } ?>
						</select>
							
						</div>
						
					</div>
				</div>
							
						
				<div class="form-group">
					<div class="col-md-12">
						<div class="col-md-offset-4 col-md-4 col-md-offset-4" style="margin-top:10px;">
							<button type="button" class="btn btn-block blue" onclick="User.subrole();"> 
							Create User
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>

<input type="hidden" id="errorhid" value="1">
<script>
  	$('select').select2();  
  	$('#checknew').click(function(){
		if($(this).prop("checked") == true){
            $(".usercodesl").css("display","none");
            $(".usercodein").css("display","block");
            $("#user_name").val("");
            $("#user_email").val("");
		}else if($(this).prop("checked") == false){
			$(".usercodesl").css("display","block");
        	$(".usercodein").css("display","none");
		}
	});
</script>