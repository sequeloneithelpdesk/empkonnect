<?php
@session_start();
include ('../db_conn.php');
//@include ('../configdata.php');


	$username=$_SESSION['usercode'];
	$usertype=$_SESSION['usertype'];
	$doc_root= $_SERVER['DOCUMENT_ROOT'];

//header('Cache-control: private');



?>
<div class="page-header navbar navbar-fixed-top">
			<!-- BEGIN HEADER INNER -->
			<div class="page-header-inner ">
				<!-- BEGIN LOGO -->
				<div class="page-logo cus-dark-grey bd-le bd-ri" >
					<a href="javascript:;" >
						<img src="../../assets/admin/layout2/img/logo.png" alt="logo" class="logo-default" width="150" height="50"/>
					</a>
					
				</div>
				<!-- END LOGO -->
				<!-- BEGIN RESPONSIVE MENU TOGGLER -->
				<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
				</a>
				<!-- END RESPONSIVE MENU TOGGLER -->
				<!-- BEGIN PAGE ACTIONS -->
				<!-- DOC: Remove "hide" class to enable the page header actions -->
				<div class="menu-toggler sidebar-toggler flt-left m-0 bd-ri bd-le header-margin  white-txt fs-16">
					<!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
				</div>
				
				<!-- END PAGE ACTIONS -->
				<!-- BEGIN PAGE TOP -->
				<div class="page-top cus-dark-grey">
					<!-- BEGIN HEADER SEARCH BOX -->
					<!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
					<!-- END HEADER SEARCH BOX -->
					<!-- BEGIN TOP NAVIGATION MENU -->
					<div class="top-menu">
							<?php

									$sqlq="select EmpImage,Emp_FName,Emp_Name,gender from hrdmastqry where Emp_Code='$username'";
									$resultq=query($query,$sqlq,$pa,$opt,$ms_db);
									
									$rowq = $fetch($resultq);
										$name=$rowq[2];
										if($rowq[0]==""||$rowq[0]=="NULL" ){
										$image='images (1).jpg';
										}
										else{
											 $image=$rowq[0];
										}
										?>
						<span class="bd-le white-txt" style="
							    font-size: 14px;
							    text-transform: capitalize;
							    padding: 23px 5px;
							    display: inline-flex;
							"><?php echo str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($name))))." (".$username.")"; ?>
						</span>
						<ul class="nav navbar-nav pull-right">
							
							<li class="dropdown dropdown-user p-0">
							<div class="dropdown-toggle flipContainer" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
							<div class="flipCard">	
							<div class="front side">
								
								
										<img alt="" class="img-circle" src="../Profile/upload_images/<?php echo $image ; ?>" />
									
								</div><div class="back side"><?php  echo strtoupper(substr($name,0,1)) ?></div>
								</div>
								</div>
								
										<div class="userDrop z-depth-2">
							<div class="proSec clearfix">
								<div class="col-xs-5">
									<img class="img-circle" src="../Profile/upload_images/<?php echo $image ; ?>" alt="logo" class="logo-default" />
								</div>
								<div class="col-xs-7 userInfo">
									<p class="fs-16"><b><?php echo str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($name)))); ?></b></p>
									<p class="fs-14 grey-txt"><?php echo $username; ?></p>
									<p class="fs-14 grey-txt"><?php 
									 if($usertype=="U"){
									 	$roleA = $_SESSION['Allrole'];
									foreach($roleA  as $id => $RolA) {
						 
						 if($id ==  $_SESSION['selectedRole']){
							 echo $RolA['name'];
							 break;
						 }
						}
						}
						else{
							echo "Admin";
						}
						 ?></p>
									<p><a href="../Profile/myProfile.php">My Profile</a></p>
								</div>
							</div>
							<div class="col-xs-12 p-0 roleCon">
							<?php  if($usertype=="U"){  ?>
							
                 
                     <?php
					 $roleA = $_SESSION['Allrole'];
					 $htmlB = '';
					 $htmlT = '';

					 foreach($roleA  as $id => $RolA) {
						 $sel = '';
						 if($id ==  $_SESSION['selectedRole']){
							 $sel = 'dspn';
						 }
						 if($RolA['initial'] == 1) {
							 //$htmlT = '<option value="' . $id . '" '. $sel .'>' . $RolA['name'] . '</option>';
							 $htmlT='<a onclick="changerole(\'' . $id . '\')"><p data-role="'.strtoupper(substr($RolA['name'],0,1)) .'" class="'.$sel.'"><span class="roleToggle">' . $RolA['name'] . '</span></p></a>';
						 }
						 else{
							 $htmlB .= '<a onclick="changerole(\'' . $id . '\')"><p data-role="'.strtoupper(substr($RolA['name'],0,1)) .'" class="'.$sel.'"><span class="roleToggle">' . $RolA['name'] . '</span></p></a>';
						 }
                     }
					 echo $htmlT.$htmlB;
                        ?>
				 
					<?php }
					?>
				
							</div>
							<div class="col-xs-12 p-0 actBtn">
								<ul class="dsil m-0">
									<li><a href="../Attendance/my_calendar.php">My Calender</a></li>
									<li><a href="../login/logout.php">Sign Out</a></li>
								</ul>
							</div>

						</div>
							</li>
							<!-- END USER LOGIN DROPDOWN -->

						</ul>
					</div>
					<!-- END TOP NAVIGATION MENU -->
				</div>
				<!-- END PAGE TOP -->
			</div>
			<!-- END HEADER INNER -->
		</div>