<?php
session_start();
include ('../db_conn.php');
include ('../configdata.php');
include ('../main_class.php');
$main_class_obj=new main_class();
if((!isset($_SESSION['usercode']) || $_SESSION['usercode']=="")&& (!isset($_SESSION['usertype']) || $_SESSION['usertype']=="")){
	header('location: ../login/index.php');
}
$c_val  = 'end1234';
$emp_code=$_SESSION['usercode'];
$login_code=$_SESSION['usercode'];
$role_val = $_SESSION['selectedRole'];
global $query,$pa,$opt,$ms_db,$num,$fetch;
if($role_val==1)
{
$sqlqsu="select CONVERT (VARCHAR(10),LvFrom,103 ) as startDate,  CONVERT (VARCHAR(10),LvTo,103 ) as endDate, status,reason,LvType,CreatedBy,Trn_Date from leave
where CreatedBy='".$emp_code."' and status=1 and YEAR(LvFrom) = YEAR(getDate()) order by CONVERT (VARCHAR(10),LvFrom,121 ) asc";
//echo $sqlqsu;
$resultqsu=query($query,$sqlqsu,$pa,$opt,$ms_db);
if($resultqsu){
	$tempArray4=$num($resultqsu);
}else{
	$tempArray4=-1;
}
$resultsu = array();
if($tempArray4>0) {
	while ($rowqsu = $fetch($resultqsu)){
		$resultsu[] = array('start'=>$rowqsu['startDate'],'end'=>$rowqsu['endDate'],'reason'=>$rowqsu['reason'],'LvType'=>$rowqsu['LvType'],'requestedby'=>$rowqsu['CreatedBy']);
	}
}

//print_r($resultsu);
$sqlq1su="select CONVERT (VARCHAR(10),LvFrom,103 ) as startDate,  CONVERT (VARCHAR(10),LvTo,103 ) as endDate,LvType, status,reason,CreatedBy,Trn_Date from leave
where CreatedBy='".$emp_code."' and status=2 and YEAR(LvFrom) = YEAR(getDate()) order by CONVERT (VARCHAR(10),LvFrom,121 ) asc";
//echo $sqlq1su;
$resultq1su=query($query,$sqlq1su,$pa,$opt,$ms_db);
if($resultq1su){
	$tempArray41=$num($resultq1su);
}else{
	$tempArray41=-1;
}
$result1su = array();
if($tempArray41>0) {
	while ($rowq1su = $fetch($resultq1su)){
		$result1su[] = array('startDate'=>$rowq1su['startDate'],'endDate'=>$rowq1su['endDate'],'reason'=>$rowq1su['reason'],'LvType'=>$rowq1su['LvType'],'requestedby'=>$rowq1su['CreatedBy']);
	}
}
}
elseif ($role_val==2) {
	$sqlqsu="select CONVERT (VARCHAR(10),LvFrom,103 ) as startDate,  CONVERT (VARCHAR(10),LvTo,103 ) as endDate, status,reason,LvType,CreatedBy,Trn_Date from leave
where ApprovedBy='".$emp_code."' and status=1 and YEAR(LvFrom) = YEAR(getDate()) order by CONVERT (VARCHAR(10),LvFrom,121 ) asc";
//echo $sqlqsu;
$resultqsu=query($query,$sqlqsu,$pa,$opt,$ms_db);
if($resultqsu){
	$tempArray4=$num($resultqsu);
}else{
	$tempArray4=-1;
}
$resultsu = array();
if($tempArray4>0) {
	while ($rowqsu = $fetch($resultqsu)){
		$resultsu[] = array('start'=>$rowqsu['startDate'],'end'=>$rowqsu['endDate'],'reason'=>$rowqsu['reason'],'LvType'=>$rowqsu['LvType'],'requestedby'=>$rowqsu['CreatedBy']);
	}
}

//print_r($resultsu);
$sqlq1su="select CONVERT (VARCHAR(10),LvFrom,103 ) as startDate,  CONVERT (VARCHAR(10),LvTo,103 ) as endDate,LvType, status,reason,CreatedBy,Trn_Date from leave
where ApprovedBy='".$emp_code."' and status=2 and YEAR(LvFrom) = YEAR(getDate()) order by CONVERT (VARCHAR(10),LvFrom,121 ) asc";
//echo $sqlq1su;
$resultq1su=query($query,$sqlq1su,$pa,$opt,$ms_db);
if($resultq1su){
	$tempArray41=$num($resultq1su);
}else{
	$tempArray41=-1;
}
$result1su = array();
if($tempArray41>0) {
	while ($rowq1su = $fetch($resultq1su)){
		$result1su[] = array('startDate'=>$rowq1su['startDate'],'endDate'=>$rowq1su['endDate'],'reason'=>$rowq1su['reason'],'LvType'=>$rowq1su['LvType'],'requestedby'=>$rowq1su['CreatedBy']);
	}
}
}
//print_r($result1su);

?>
<!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.1
Version: 3.6.1
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
	<!--<![endif]-->
	<!-- BEGIN HEAD -->
	<head>
		<meta charset="utf-8"/>
		<title>HRMS</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<meta content="" name="description"/>
		<meta content="" name="author"/>
		<!-- BEGIN GLOBAL MANDATORY STYLES -->
		<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>
		<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>
		<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css"/>
		<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>
		<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"/>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css">
		<link href="../../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link href="../../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
		<link href="../../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
		<link href="../../assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css">
		<link href="../../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
		<link href="../../assets/global/plugins/fullcalendar/fullcalendar.css" rel="stylesheet"/>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<!-- END GLOBAL MANDATORY STYLES -->
		<!-- BEGIN THEME STYLES -->
		<link href="../../assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
		<link href="../../assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
		<link href="../../assets/admin/layout2/css/layout.css" rel="stylesheet" type="text/css"/>
		<link id="style_color" href="../../assets/admin/layout2/css/themes/grey.css" rel="stylesheet" type="text/css"/>
		<link href="../../assets/admin/layout2/css/custom.css" rel="stylesheet" type="text/css"/>
		<link href="../../assets/admin/layout2/css/kunal.css" rel="stylesheet" type="text/css"/>
		<!-- END THEME STYLES -->
		<link rel="shortcut icon" href="favicon.ico"/>
		<style>
			.fc-day-grid-event > .fc-content{
				padding: 3px;
			}
			.red,.red2,.green,.green2,.green_over,.blue_over,.red_over,.yellow,.yellow_over,.pink,.presentAbsent,.miss-punch{
				height: 65px;
			margin-left: -1px;
			margin-right: -1px;
			margin-top: -22px;
						}
			.presentAbsent  > .fc-content > .fc-title{
				background: linear-gradient(45deg, green, green 100%), linear-gradient(135deg, red, red), linear-gradient(225deg, green, green) , linear-gradient(225deg, red, red);
			background-size: 50% 50%;
			background-position: 0% 0%, 0% 100%, 100% 0%, 100% 100%;
			background-repeat: no-repeat;
			
			border-radius: 10px !important;
			display: block;
			height: 10px !important;
			position: relative;
			top: 2px;
			width: 10px !important;
			}
			.red {
			background: rgba(255,255,255, .0);
			}
			.red2 {
			background: rgba(209,210,209, 0.05);
			}
			.green {
			background: rgba(0,100,0,0.05);
			}
			.green_over,.red_over,.yellow_over {
			background: rgba(255, 255, 255, 0.05) none repeat scroll 0 0;
			}
			.green2,.miss-punch {
			background: rgba(209,210,209,0.05);
			}
			.yellow {
				background: rgba(255, 252, 192, 0.05);
			}
			.green2 > .fc-content > .fc-title{
			background-color: green;
			border-radius: 10px !important;
			display: block;
			height: 10px !important;
			position: relative;
			top: 2px;
			width: 10px !important;
			}
			.miss-punch > .fc-content > .fc-title{
			background-color: #28E0D1;
			border-radius: 10px !important;
			display: block;
			height: 10px !important;
			position: relative;
			top: 2px;
			width: 10px !important;
			}
			.red > .fc-content > .fc-title{
				background-color: #f83d3d;
				border-radius: 10px !important;
			display: block;
			height: 10px !important;
			position: relative;
			top: 2px;
			width: 10px !important;
			}
			.yellow > .fc-content > .fc-title{
			background-color: #ff9800;
			border-radius: 10px !important;
			display: block;
			height: 10px !important;
			position: relative;
			top: 2px;
			width: 10px !important;
			}
			.pink > .fc-content > .fc-title{
			background-color: #999;
			border-radius: 10px !important;
			display: block;
			height: 10px !important;
			position: relative;
			top: 2px;
			width: 10px !important;
			}
			.red_over > .fc-content > .fc-title{
				background-color: #f83d3d;
				border-radius: 10px !important;
				display: block;
				height: 10px !important;
				position: relative;
				top: 2px;
				width: 10px !important;
			}
			.green_over > .fc-content > .fc-title {
			background-color: green;
			border-radius: 10px !important;
			display: block;
			height: 10px !important;
			position: relative;
			top: 2px;
			width: 10px !important;
			}
			.blue_over > .fc-content > .fc-title {
			background-color: #4646FF;
			border-radius: 10px !important;
			display: block;
			height: 10px !important;
			position: relative;
			top: 2px;
			width: 10px !important;
			}
			.yellow_over > .fc-content > .fc-title {
			background-color: #ff9800;
			border-radius: 10px !important;
			display: block;
			height: 10px !important;
			position: relative;
			top: 2px;
			width: 10px !important;
			}
			.cal-event {
			bottom: 3px;
			position: absolute;
			right: 0;
			}
			.att-time {
			color: #817d7d;
			font-size: 0.9em;
			margin: 0 0 0 3px;
			}
			.fc-content-skeleton{
				padding-bottom:0 !important;
				
			}
			.myTable > tbody > tr > td {
				font-size: 12px;
				padding: 4px 2px !important;
			}
			.myTable > tbody > tr > th {
				font-size: 11px;
				padding: 4px 2px !important;
			}
			
			.month-data-active{
				display: block;
			}
			.month-data{
				display: none;
			}
			
			th.rotate {
			height: 60px;
			white-space: nowrap;
			}
			th.rotate > div {
				transform:
				translate(0px, 40px)
				rotate(270deg);
				width: 22px;
			}
			th.rotate > div > span {
				padding: 0px 10px;
			}
			.ui-widget-header{
				border-top: 0px solid !important;
				border-left: 0px solid !important;
				border-right: 0px solid !important;
				border-bottom: 1px solid #aaaaaa !important;
				background: #ffffff !important;
				color: #222222;
			font-weight:normal !important;
			}
			.ui-widget {
			font-family: "Open Sans",Arial,sans-serif !important;
			font-size: 0.9em !important;
			}
			.fc-basic-view td.fc-day-number, .fc-basic-view td.fc-week-number span {
			font-weight: 600;
			padding-bottom: 2px;
			padding-top: 0px;
			}
			.fc-day-number {
			font-size: 1em;
			}
			#eventContent{
				max-height: 350px;
				overflow-y: auto;
			}
			.ui-dialog-titlebar-close::before {
			content: "x";
			}
			.ui-dialog-titlebar-close {
			background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
			border: medium none;
			}
			.legendlist { list-style: none;margin-top: 16px; padding-left: 0; }
		.legendlist li { float: left; margin-right: 10px; }
		.legendlist li:first-child {
		margin: 0;
		}
		.legendlist span { border: 1px solid #ccc; float: left; width: 12px; height: 12px; margin: 2px; }
		.legendlist .preset-legent { background-color: green; }
		.legendlist .absent-legend { background-color:#f83d3d; }
		.legendlist .leave-legend { background-color: #4646FF; }
		.legendlist .od-legend { background-color: #999; }
		.legendlist .halfday-legend { background-color: #ff9800; }
		.legendlist .holiday-legend { background-color: #E5EFE5; }
		.legendlist .miss-punch { background-color:  #28E0D1; }
		.bgnone{ background: none repeat scroll 0 0 rgba(0, 100, 0, 0.1); }
		</style>
	</head>
	<!-- END HEAD -->
	<!-- BEGIN BODY -->
	<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
	<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
	<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
	<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
	<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
	<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
	<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
	<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
	<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
	<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white custom-layout">
		<!-- BEGIN HEADER -->
		<?php include('../include/header.php'); ?>
		<!-- END HEADER -->
		<div class="clearfix">
		</div>
		<div class="page-content-wrapper cus-dark-grey">
			<!-- BEGIN CONTAINER -->
			<div class="page-container">
				<!-- BEGIN SIDEBAR -->
				<div class="page-sidebar-wrapper modified">
					<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
					<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
					<div class="page-sidebar navbar-collapse collapse cus-dark-grey">
						<!-- BEGIN SIDEBAR MENU -->
						<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
						<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
						<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
						<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
						<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
						<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
						<?php include('../include/leftMenu.php') ?>
						<!-- END SIDEBAR MENU -->
					</div>
				</div>
				<!-- END SIDEBAR -->
				<!-- BEGIN CONTENT -->
				<div class="page-content-wrapper">
					<div class="page-content cus-light-grey">
						<div class="modal fade bs-modal-lg" id="large1" tabindex="-1" role="dialog" aria-hidden="true" >
							<div class="modal-dialog lg">
								<div class="modal-content" id="wishtemplate" style="width:850px;">
								</div>
								<!-- /.modal-content -->
							</div>
							<!-- /.modal-dialog -->
						</div>
						<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
						<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
										<h4 class="modal-title">Modal title</h4>
									</div>
									<div class="modal-body">
										Widget settings form goes here
									</div>
									<div class="modal-footer">
										<button type="button" class="btn blue">Save changes</button>
										<button type="button" class="btn default" data-dismiss="modal">Close</button>
									</div>
								</div>
								<!-- /.modal-content -->
							</div>
							<!-- /.modal-dialog -->
						</div>
						<!-- /.modal -->
						<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
						<!-- BEGIN STYLE CUSTOMIZER -->
						<!-- END STYLE CUSTOMIZER -->
						<!-- BEGIN PAGE HEADER-->
						<h3 class="page-title">
						My Home Page 
						</h3>
						<div class="page-bar z-depth-1 general-alert pt-15 pb-15 pl-15" id="noti" style="display: none">
							<h3 class="fs-16 m-0" id="head1">Notification <i class="fa fa-bell red-txt"></i></h3>
							<div id="noti1"></div>
						</div>
						<!-- END PAGE HEADER-->
						<!-- BEGIN PAGE CONTENT-->
						<div class="row">
							<div class="col-md-6">
							<?php
							$emp_cate=$main_class_obj->getemployee_category_main($emp_code);
							if($emp_cate !='SALARIED' && $role_val != 2)
								{?>
								<div class="to-do ">
									<!-- BEGIN ALERTS PORTLET-->
									<div class="portlet light z-depth-1 clearfix">
										<div class="portlet-title">
											<div class="caption">
												
												<span class="caption-subject  bold uppercase">What Do You want to do Today ?</span>
												
											</div>
											
										</div>
										<div class="portlet-body">
											
											<a href="../leave/leaveRequest.php" class="cust-btn blue-bg col-md-12 waves-effect waves-light fs-16 white-txt center-align">Apply Leave</a>
											<a href="../Attendance/markPastAttendance.php" class=" cus-border-btn br2 cust-btn mt-15 col-md-12 waves-effect waves-light fs-16 center-align">Regularize Your Attendance</a>
											
											
										</div>
										<!-- END ALERTS PORTLET-->
									</div>
								</div>
								<?php } ?>
								<div class="leave-status">
									<!-- BEGIN ALERTS PORTLET-->
									<div class="portlet light z-depth-1 clearfix" style="overflow-y: scroll;max-height: 435px;">
										<div class="portlet-title">
											<div class="caption">
												
												<div class="btn-group">
													<button type="button" class="dropdown-toggle brn white-bg" data-toggle="dropdown">
													<span class="hidden-sm hidden-xs caption-subject  bold uppercase">Leave Status&nbsp;</span>&nbsp;
													</button>
													<!-- <ul class="dropdown-menu" role="menu">
																<li>
																			<a href="#">
																			<i class="icon-user"></i> New User </a>
																</li>
																<li>
																			<a href="#">
																						<i class="icon-present"></i> New Event <span class="badge badge-success">4</span>
																			</a>
																</li>
																<li>
																			<a href="#">
																			<i class="icon-basket"></i> New order </a>
																</li>
																<li class="divider">
																</li>
																<li>
																			<a href="#">
																						<i class="icon-flag"></i> Pending Orders <span class="badge badge-danger">4</span>
																			</a>
																</li>
																<li>
																			<a href="#">
																						<i class="icon-users"></i> Pending Users <span class="badge badge-warning">12</span>
																			</a>
																</li>
													</ul> -->
												</div>
												
											</div>
											<div class="tabbable-line">
												<ul class="nav nav-tabs fl-r">
													
													<li class="active green-active">
														<a href="#tab_15_2" data-toggle="tab">
														Pending  </a>
													</li>
													<li>
														<a href="#tab_15_3" data-toggle="tab">
														Approved </a>
													</li>
												</ul>
											</div>
										</div>
										<div class="portlet-body">
											
											
											<div class="tab-content">
												<div class="tab-pane active" id="tab_15_2">
													
													
													<ul class="list-group">
														
														<?php for($i=0; $i<count($resultsu);$i++){?>
														<li class="list-group-item p-0 pb-15">
															<span class="fs-16">
																<?php echo $main_class_obj->getemployee_leave_type_main($resultsu[$i]['LvType'])." - ".$resultsu[$i]['start']. " To ".$resultsu[$i]['end']; ?>
																
																
															</span>
															<?php
															if($role_val==2)
															{
															?>
															<span class="badge blue-bg br2 badge-default"><a href="../leave/approveLeaveRequest.php" style="color: white;">Pending </a></span>
															<?php
															}
															else
															{
															?>
															<span class="badge blue-bg br2 badge-default">Pending </span>
															<?php
															}
															?>
															<span class="fs-14 grey-txt dsb">
																<?php// echo $resultsu[$i]['reason']; ?>
															</span>
														</li>
														<?php }?>
														
														
													</ul>
													
												</div>
												<div class="tab-pane" id="tab_15_3">
													
													

													<ul class="list-group">
														<?php for($i=0; $i<count($result1su);$i++){?>
														<li class="list-group-item p-0 pb-15">
															<span class="fs-16">
																<?php echo $main_class_obj->getemployee_leave_type_main($result1su[$i]['LvType'])." - ".$result1su[$i]['startDate']. " To ".$result1su[$i]['endDate']; ?>
																
															</span>
															<span class="badge blue-bg br2 badge-default">Approved </span>
															<span class="fs-14 grey-txt dsb">
																<?php //echo $result1su[$i]['reason']; ?>
																
															</span>
														</li>
														<?php }?>
														
														
													</ul>
												</div>
											</div>
										</div>
									</div>
									<!-- END ALERTS PORTLET-->
								</div>
								<div class=" leave-status" id="deptnoti" style="display: none">
									<!-- BEGIN ALERTS PORTLET-->
									<div class="portlet light z-depth-1 clearfix">
										<div class="portlet-title">
											<div class="caption">
												<span class="caption-subject  bold uppercase">Department Notification</span>
											</div>
										</div>
										<div class="portlet-body">
											<ul class="list-group" id="showdept">
											</ul>
										</div>
										<!-- END ALERTS PORTLET-->
									</div>
								</div>
								<div class="leave-status">
									<!-- BEGIN ALERTS PORTLET-->
									<div class="empSearch">
										<div class="portlet light z-depth-1 clearfix">
											<div class="portlet-title">
												<div class="caption">
													<span class="caption-subject  bold uppercase">My team</span>
													<div class="input-group">
														<input type="text" class="form-control"name="term_1" id="myteam_search">
														<span class="input-group-btn">
															<a class="btn submit" id="search_myteam"><i class="icon-magnifier"></i></a>
														</span>
													</div>
												</div>
											</div>
											<div class="portlet-body">
												<div class="scroller" style="height: 200px;">
													
													<p id="myteam_result"></p>
													<?php
													$username = $_SESSION['usercode'];
													$Manager;
													$sqlq = "select * from HrdMastQry WHERE MNGR_CODE='$username'";
													$resultq = query($query,$sqlq,$pa,$opt,$ms_db);
													if ($num($resultq)) {
														while ($rowq = $fetch($resultq)) {
													?>
													<div class="empSearchResult clearfix">
														<div class="empSearchImg col-md-2">
															<a href="../Profile/showEmployee.php?oempCode=<?php echo $rowq['Emp_Code'];?>" class="black-txt fs-13">
																<?php if($rowq['EmpImage'] != ""){ ?>
																<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/<?php echo $rowq['EmpImage'];?>">
																<?php  }else if($rowq['EmpImage'] == "" && $rowq['Gender'] == 'Male'){?>
																<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/<?php echo 'images.png';?>">
																<?php  }elseif($rowq['EmpImage'] == "" && $rowq['Gender'] == 'Female'){
																?>
																<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/<?php echo 'images.jpg.jpg';?>">
																<?php } ?>
															</div>
															<div class="empSearchInfo col-md-10">
																<span class="fit">
																	<?php echo $rowq['EMP_NAME']; $Manager = $rowq['MNGR_CODE']; ?>
																</span>
																<span class="fit">
																	<span class="kEmpCod"><?php echo $rowq['Emp_Code'];;?></span>
																</span>
																<span class="fit">
																	<span><?php echo $rowq['DEPT_NAME'];?></span>
																</span>
																<input type="hidden" id="hidden_mng" value="<?php echo $username; ?>">
															</a>
														</div>
													</div>
													<?php
													}
													}
														/*	$sqlq1 = "select * from HrdMastQry WHERE MNGR_CODE='$username'";
													$resultq1 = query($query,$sqlql,$pa,$opt,$ms_db);
													if ($num($resultq1)) {
													while ($rowq1 = $fetch($resultq1)) {
													?>
													<tr>
														<td class="fit">
															<img class="user-pic" src="../../assets/admin/layout3/img/avatar4.jpg">
														</td>
														<td>
															<a href="#" class="black-txt fs-16"><?php echo $rowq1['EMP_NAME'];?></a>
															<span class="dsb"><?php echo $rowq1['DEPT_NAME'];?></span>
														</td>
														<td class="black-txt">
															<?php echo $rowq1['DSG_NAME'];?>
														</td>
														<td class="black-txt right-align">
														</td>
													</tr>
													<?php
													}
													}
													*/
													?>
												</div>
											</div>
										</div>
									</div>
								</div>
								
								<div class="leave-status">
									<!-- BEGIN ALERTS PORTLET-->
									<div class="portlet light z-depth-1 clearfix ml-10">
										<div class="portlet-title">
											<div class="alert alert-info black-txt bold">
											Welcome On the Board
												<!-- New Joinee of the Month -->
											</div>
											<div class="input-group">
												<input type="text" class="form-control"name="term" id="newjoinee_search">
												<span class="input-group-btn">
													<a class="btn submit" id="search_newjoinee"><i class="icon-magnifier"></i></a>
												</span>
											</div>
										</div>
										<div class="portlet-body p-0">
											<p id="newjoinee_result"></p>
											<div class="scroller" style="height: 200px" id="new_joinee">
												<?php
												$sqlq="select * from HrdMastQry where DOJ between DATEADD(DD,-30,GETDATE()) and GETDATE()";
												$resultq=query($query,$sqlq,$pa,$opt,$ms_db);
												if($num($resultq)) {
													while ($rowq = $fetch($resultq)) {
												?>
												<div class="empSearchResult clearfix">
													<div class="empSearchImg col-md-2">
														<a onclick="editInfo('nj','<?php echo $rowq['OEMailID'];?>','<?php echo $rowq['EMP_NAME'];?>','<?php echo $rowq['Emp_Code'];?>')" class="black-txt fs-12">
															<?php if($rowq['EmpImage'] != ""){ ?>
															<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/<?php echo $rowq['EmpImage'];?>">
															<?php  }else if($rowq['EmpImage'] == "" && $rowq['Gender'] == 'Male'){?>
															<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/<?php echo 'images.png';?>">
															<?php  }elseif($rowq['EmpImage'] == "" && $rowq['Gender'] == 'Female'){
															?>
															<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/<?php echo 'images.jpg.jpg';?>">
															<?php } else{?>
															<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/<?php echo 'images.jpg';?>">
															<?php }?>
														</div>
														<div class="empSearchInfo col-md-10">
															<span class="fit">
																<?php echo $rowq['EMP_NAME'];?> <span class="kEmpCod"><?php echo $rowq['Emp_Code'];?></span>
																<span class="dsb"></span>
															</span>
															<span class="fit">
																<span class="dsb"><?php echo $rowq['DEPT_NAME'];?></span>
															</span>
														</div>
													</a>
												</div>
												<?php
												$i++;
												}
												}
												?>
												
											</div>
										</div>
									</div>
								</div>
								<!-- END PAGE CONTENT-->
							</div>
							<div class="col-md-6 sec-part">
								<div class="portlet light z-depth-1 clearfix ">
									<div class="empSearch">
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Connect With Employee" name="term" id="search">
											<span class="input-group-btn">
												<a class="btn submit" id="search_emp"><i class="icon-magnifier"></i></a>
											</span>
										</div>
										<div class="scroller" style="display: block" id="search_block">
										</div>
									</div>
								</div>
								<div class="my-plan ">
									<!-- BEGIN ALERTS PORTLET-->
									<div class="portlet light z-depth-1 clearfix">
										<div class="portlet-title">
											<div class="caption">
												<div class="tabbable-line">
													<ul class="nav nav-tabs fl-r">
														<li class="green-active">
															<a href="#tab_16_2" data-toggle="tab">
															My Calendar </a>
														</li>
														<li>
															<a href="#tab_16_3" data-toggle="tab">
															My Leave Balance </a>
														</li>
													</ul>
												</div>
												
											</div>
										</div>
										<div class="portlet-body">
											<div class="tab-content">
												<div class="tab-pane active" id="tab_16_2">
													<input type="hidden" id="emp_code" value="<?php echo $emp_code; ?>" >
													<div id="calendar" class="has-toolbar">
													</div>
													<ul class="legendlist">
														<li><span class="preset-legent"></span> Present</li>
														<li><span class="absent-legend"></span> Absent</li>
														<li><span class="leave-legend"></span> Leave</li>
														<li><span class="od-legend"></span> OD</li>
														<li><span class="halfday-legend"></span> Half Day</li>
														<li><span class="holiday-legend"></span> Holiday</li>
														<li><span class="miss-punch"></span> Miss Punch</li>
													</ul>
													<div id="eventContent" title="Event Details" style="display:none;">
														<span id="shiftName"></span>
														<span id="shiftInOutTime"></span><br><br>
														<span id="presetStatus"></span>
														<span id="firstpresetStatus"></span>
														<span id="secondpresetStatus"></span>
														<span id="leaveReason"></span><br>
														<span id="startTime"></span><span id="endTime"></span>
														<span id="birthdayRecords"></span>
														<span id="anniversaryRecords"></span>
													</div>
												</div>
												<div class="tab-pane" id="tab_16_3">
													<div id="my_leave">
														<span>
															<script>
															getLeaveDetails('<?php echo $emp_code; ?>');
															</script>
														</span>
													</div>
												</div>
											</div>
										</div>
										<!-- END ALERTS PORTLET-->
									</div>
								</div>
<!-- <div class=" job">
	<!-- BEGIN ALERTS PORTLET
	<div class="portlet light z-depth-1 clearfix">
		<div class="portlet-title">
			<div class="caption">
				<span class="caption-subject  bold uppercase">Job Openings</span>
			</div>
		</div>
		<div class="portlet-body">
			<table class="table table-hover table-light">
				<thead>
				</thead>
				<tr>
				<td>
				<span class="dsb fs-16 black-txt">PHP Developer</span>
				</td>
				<td class="right-align">
				<a href="admin/ajax/view_newOpening.php" class=" pl-15 pr-15 cus-border-btn green-txt right-align br2">More Details</a>
				</td>
				</tr>
				<tr>
				<td>
				<span class="dsb fs-16 black-txt">PHP Developer</span>
				</td>
				<td class="right-align">
				<a href="" class=" cus-border-btn pl-15 green-txt pr-15 br2">More Details</a>
				</td>
				</tr>
				</table>
			</div>
	</div>
</div> -->
<!-- BEGIN birthday ALERTS PORTLET-->
<div class="portlet light z-depth-1 clearfix ml-10">
		<div class="portlet-title alert alert-info black-txt bold">
		<span style="display: inline-block;padding: 14px 13px 13px 13px;"> 
		Birthday/Anniversay	</span>		
			<ul class="nav nav-tabs">
				<li>
					<a href="#portlet_tab0" data-toggle="tab">
						Yesterday </a>
				</li>
				<li class="active">
					<a href="#portlet_tab1" data-toggle="tab">
						Today </a>
				</li>
				<li>
					<a href="#portlet_tab2" data-toggle="tab">
						Tomorrow </a>
				</li>
			</ul>
		</div>
		<div class="portlet-body">
			<div class="tab-content">
				<div class="tab-pane" id="portlet_tab0">
					<div class="input-group">
						<input type="text" class="form-control" name="term" id="birthday_search0">
							<span class="input-group-btn">
								<a class="btn submit" id="search_birthday0">
									<i class="icon-magnifier"></i>
								</a>
							</span>
					</div>
					<div class="scroller" style="height: 200px;">
						<p id="birthday0_result"></p>
						<?php
						$sqlq = "select * from HrdMastQry WHERE  DATEPART(MM, DOB)=DATEPART(MM, GETDATE()) and DATEPART(dd, DOB)=DATEPART(dd, (DATEADD(DAY,-1,GETDATE())))";
						$resultq = query($query,$sqlq,$pa,$opt,$ms_db);
						if ($num($resultq)) {
							while ($rowq = $fetch($resultq)) {
								//$rowq['OEMailID'];
						?>
						<div class="empSearchResult clearfix">
							<div class="empSearchImg col-md-2">
							<a onclick="editInfo('birthday','<?php echo $rowq['OEMailID'];?>','<?php echo $rowq['EMP_NAME'];?>','<?php echo $rowq['Emp_Code'];?>')" class="black-txt fs-12">
								<?php if($rowq['EmpImage'] != ""){ ?>
								<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/<?php echo $rowq['EmpImage'];?>">
								<?php  }else if($rowq['EmpImage'] == "" && $rowq['Gender'] == 'Male'){?>
								<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/<?php echo 'images.png';?>">
								<?php  }elseif($rowq['EmpImage'] == "" && $rowq['Gender'] == 'Female'){
								?>
								<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/<?php echo 'images.jpg.jpg';?>">
								<?php } ?>
							</div>
							<div class="empSearchInfo col-md-10">
								<span class="fit">
									<?php echo $rowq['EMP_NAME'];?><i class="fa fa-birthday-cake"></i>
								</span>
								<span class="fit">
									<span class="kEmpCod"><?php echo $rowq['Emp_Code'];?></span>
								</span>
								<span class="fit">
									<span><?php echo $rowq['DEPT_NAME'];?></span>
								</span>
							</a>
							</div>
					</div>
					<?php
					}
					}
					?>
					<?php
						$sqla = "select * from HrdMastQry WHERE  DATEPART(MM, DOJ)=DATEPART(MM, GETDATE()) and DATEPART(dd, DOJ)=DATEPART(dd, (DATEADD(DAY,-1,GETDATE())))";
						$resulta = query($query,$sqla,$pa,$opt,$ms_db);
						if ($num($resulta)) {
							while ($rowa = $fetch($resulta)) {
								//$rowq['OEMailID'];
						?>
						<div class="empSearchResult clearfix">
							<div class="empSearchImg col-md-2">
							<a onclick="editInfo('anniv','<?php echo $rowa['OEMailID'];?>','<?php echo $rowa['EMP_NAME'];?>','<?php echo $rowa['Emp_Code'];?>')" class="black-txt fs-12">
								<?php if($rowa['EmpImage'] != ""){ ?>
								<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/<?php echo $rowa['EmaImage'];?>">
								<?php  }else if($rowa['EmpImage'] == "" && $rowa['Gender'] == 'Male'){?>
								<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/<?php echo 'images.png';?>">
								<?php  }elseif($rowa['EmpImage'] == "" && $rowa['Gender'] == 'Female'){
								?>
								<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/<?php echo 'images.jpg.jpg';?>">
								<?php } ?>
							</div>
							<div class="empSearchInfo col-md-10">
								<span class="fit">
									<?php echo $rowa['EMP_NAME'];?><i class="fa fa-gift"></i>
								</span>
								<span class="fit">
									<span class="kEmpCod"><?php echo $rowa['Emp_Code'];?></span>
								</span>
								<span class="fit">
									<span><?php echo $rowa['DEPT_NAME'];?></span>
								</span>
							</a>
							</div>
					</div>
					<?php
					}
					}
					?>
					<?php
						$sqlwd = "select * from HrdMastQry WHERE  DATEPART(MM, Anniversary)=DATEPART(MM, GETDATE()) and DATEPART(dd, Anniversary)=DATEPART(dd, (DATEADD(DAY,-1,GETDATE())))";
						$resultwd = query($query,$sqlwd,$pa,$opt,$ms_db);
						if ($num($resultwd)) {
							while ($rowwd = $fetch($resultwd)) {
								//$rowq['OEMailID'];
						?>
						<div class="empSearchResult clearfix">
							<div class="empSearchImg col-md-2">
							<a onclick="editInfo('wdanniv','<?php echo $rowwd['OEMailID'];?>','<?php echo $rowwd['EMP_NAME'];?>','<?php echo $rowwd['Emp_Code'];?>')" class="black-txt fs-12">
								<?php if($rowwd['EmpImage'] != ""){ ?>
								<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/<?php echo $rowwd['EmaImage'];?>">
								<?php  }else if($rowwd['EmpImage'] == "" && $rowwd['Gender'] == 'Male'){?>
								<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/<?php echo 'images.png';?>">
								<?php  }elseif($rowwd['EmpImage'] == "" && $rowwd['Gender'] == 'Female'){
								?>
								<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/<?php echo 'images.jpg.jpg';?>">
								<?php } ?>
							</div>
							<div class="empSearchInfo col-md-10">
								<span class="fit">
									<?php echo $rowwd['EMP_NAME'];?><i class="fa fa-glass"></i>
								</span>
								<span class="fit">
									<span class="kEmpCod"><?php echo $rowwd['Emp_Code'];?></span>
								</span>
								<span class="fit">
									<span><?php echo $rowwd['DEPT_NAME'];?></span>
								</span>
							</a>
							</div>
					</div>
					<?php
					}
					}
					?>
				</div>
			</div>
			<div class="tab-pane active" id="portlet_tab1">
				<div class="input-group">
					<input type="text" class="form-control" name="term" id="birthday_search1">
					<span class="input-group-btn">
						<a class="btn submit" id="search_birthday1"><i class="icon-magnifier"></i></a>
					</span>
				</div>
				<div class="scroller" style="height: 200px;">
					<p id="birthday1_result"></p>
					<?php
					$sqlq2 = "select * from HrdMastQry WHERE  DATEPART(MM, DOB)=DATEPART(MM, GETDATE()) and DATEPART(dd, DOB)=DATEPART(dd, GETDATE())";
					$resultq2 = query($query,$sqlq2,$pa,$opt,$ms_db);
					if ($num($resultq2)) {
						while ($rowq2 = $fetch($resultq2)) {
					?>
					<div class="empSearchResult clearfix">
						<div class="empSearchImg col-md-2">
							<a onclick="editInfo('birthday','<?php echo $rowq2['OEMailID'];?>','<?php echo $rowq2['EMP_NAME'];?>','<?php echo $rowq2['Emp_Code'];?>')" class="black-txt fs-12">	<?php if($rowq2['EmpImage'] != ""){ ?>
								<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/<?php echo $rowq2['EmpImage'];?>">
								<?php  }else if($rowq2['EmpImage'] == "" && $rowq2['Gender'] == 'Male'){?>
								<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/<?php echo 'images.png';?>">
								<?php  }elseif($rowq2['EmpImage'] == "" && $rowq2['Gender'] == 'Female'){
								?>
								<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/<?php echo 'images.jpg.jpg';?>">
								<?php } ?>
							</div>
							<div class="empSearchInfo col-md-10">
								<span class="fit">
									<?php echo $rowq2['EMP_NAME'];?><i class="fa fa-birthday-cake"></i>
								</span>
								<span class="fit">
									<span class="kEmpCod"><?php echo $rowq2['Emp_Code'];;?></span>
								</span>
								<span class="fit">
									<span><?php echo $rowq2['DEPT_NAME'];?></span>
								</span>
							</a>
						</div>
					</div>
					<?php
					}
					}
					?>
					<?php
					$sqlq2a = "select * from HrdMastQry WHERE  DATEPART(MM, DOJ)=DATEPART(MM, GETDATE()) and DATEPART(dd, DOJ)=DATEPART(dd, GETDATE())";
					$resultq2a = query($query,$sqlq2a,$pa,$opt,$ms_db);
					if ($num($resultq2a)) {
						while ($rowq2a = $fetch($resultq2a)) {
					?>
					<div class="empSearchResult clearfix">
						<div class="empSearchImg col-md-2">
							<a onclick="editInfo('anniv','<?php echo $rowq2a['OEMailID'];?>','<?php echo $rowq2a['EMP_NAME'];?>','<?php echo $rowq2a['Emp_Code'];?>')" class="black-txt fs-12">	<?php if($rowq2a['EmpImage'] != ""){ ?>
								<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/<?php echo $rowq2a['EmpImage'];?>">
								<?php  }else if($rowq2a['EmpImage'] == "" && $rowq2a['Gender'] == 'Male'){?>
								<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/<?php echo 'images.png';?>">
								<?php  }elseif($rowq2a['EmpImage'] == "" && $rowq2a['Gender'] == 'Female'){
								?>
								<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/<?php echo 'images.jpg.jpg';?>">
								<?php } ?>
							</div>
							<div class="empSearchInfo col-md-10">
								<span class="fit">
									<?php echo $rowq2a['EMP_NAME'];?><i class="fa fa-gift"></i>
								</span>
								<span class="fit">
									<span class="kEmpCod"><?php echo $rowq2a['Emp_Code'];;?></span>
								</span>
								<span class="fit">
									<span><?php echo $rowq2a['DEPT_NAME'];?></span>
								</span>
							</a>
						</div>
					</div>
					<?php
					}
					}
					?>
					<?php
					$sqlq2wd = "select * from HrdMastQry WHERE  DATEPART(MM, Anniversary)=DATEPART(MM, GETDATE()) and DATEPART(dd, Anniversary)=DATEPART(dd, GETDATE())";
					$resultq2wd = query($query,$sqlq2wd,$pa,$opt,$ms_db);
					if ($num($resultq2wd)) {
						while ($rowq2wd = $fetch($resultq2wd)) {
					?>
					<div class="empSearchResult clearfix">
						<div class="empSearchImg col-md-2">
							<a onclick="editInfo('wdanniv','<?php echo $rowq2wd['OEMailID'];?>','<?php echo $rowq2wd['EMP_NAME'];?>','<?php echo $rowq2wd['Emp_Code'];?>')" class="black-txt fs-12">	<?php if($rowq2wd['EmpImage'] != ""){ ?>
								<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/<?php echo $rowq2wd['EmpImage'];?>">
								<?php  }else if($rowq2wd['EmpImage'] == "" && $rowq2wd['Gender'] == 'Male'){?>
								<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/<?php echo 'images.png';?>">
								<?php  }elseif($rowq2wd['EmpImage'] == "" && $rowq2wd['Gender'] == 'Female'){
								?>
								<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/<?php echo 'images.jpg.jpg';?>">
								<?php } ?>
							</div>
							<div class="empSearchInfo col-md-10">
								<span class="fit">
									<?php echo $rowq2wd['EMP_NAME'];?><i class="fa fa-glass"></i>
								</span>
								<span class="fit">
									<span class="kEmpCod"><?php echo $rowq2wd['Emp_Code'];;?></span>
								</span>
								<span class="fit">
									<span><?php echo $rowq2wd['DEPT_NAME'];?></span>
								</span>
							</a>
						</div>
					</div>
					<?php
					}
					}
					?>
				</div>
			</div>
			<div class="tab-pane" id="portlet_tab2">
				<div class="input-group">
					<input type="text" class="form-control"name="term" id="birthday_search2">
					<span class="input-group-btn">
						<a class="btn submit" id="search_birthday2"><i class="icon-magnifier"></i></a>
					</span>
				</div>
				<div class="scroller" style="height: 200px;">
					<p id="birthday2_result"></p>
					<?php
					$sqlq = "select * from HrdMastQry WHERE  DATEPART(MM, DOB)=DATEPART(MM, GETDATE()) and DATEPART(dd, DOB)=DATEPART(dd, (DATEADD(DAY,1,GETDATE())))";
					$resultq = query($query,$sqlq,$pa,$opt,$ms_db);
					if ($num($resultq)) {
						while ($rowq = $fetch($resultq)) {
					?>
					<div class="empSearchResult clearfix">
						<div class="empSearchImg col-md-2">
							<a onclick="editInfo('birthday','<?php echo $rowq['OEMailID'];?>','<?php echo $rowq['EMP_NAME'];?>','<?php echo $rowq['Emp_Code'];?>')" class="black-txt fs-12">	<?php if($rowq['EmpImage'] != ""){ ?>
								<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/<?php echo $rowq['EmpImage'];?>">
								<?php  }else if($rowq['EmpImage'] == "" && $rowq['Gender'] == 'Male'){?>
								<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/<?php echo 'images.png';?>">
								<?php  }elseif($rowq['EmpImage'] == "" && $rowq['Gender'] == 'Female'){
								?>
								<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/<?php echo 'images.jpg.jpg';?>">
								<?php } ?>
							</div>
							<div class="empSearchInfo col-md-10">
								<span class="fit">
									<?php echo $rowq['EMP_NAME'];?><i class="fa fa-birthday-cake"></i>
								</span>
								<span class="fit">
									<span class="kEmpCod"><?php echo $rowq['Emp_Code'];;?></span>
								</span>
								<span class="fit">
									<span><?php echo $rowq['DEPT_NAME'];?></span>
								</span>
							</a>
						</div>
					</div>
					<?php
					}
					}
					?>
					<?php
					$sqlq2a = "select * from HrdMastQry WHERE  DATEPART(MM, DOJ)=DATEPART(MM, GETDATE()) and DATEPART(dd, DOJ)=DATEPART(dd, (DATEADD(DAY,1,GETDATE())))";
					$resultq2a= query($query,$sqlq2a,$pa,$opt,$ms_db);
					if ($num($resultq2a)) {
						while ($rowq2a = $fetch($resultq2a)) {
					?>
					<div class="empSearchResult clearfix">
						<div class="empSearchImg col-md-2">
							<a onclick="editInfo('anniv','<?php echo $rowq2a['OEMailID'];?>','<?php echo $rowq2a['EMP_NAME'];?>','<?php echo $rowq2a['Emp_Code'];?>')" class="black-txt fs-12">	<?php if($rowq2a['EmpImage'] != ""){ ?>
								<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/<?php echo $rowq2a['EmpImage'];?>">
								<?php  }else if($rowq2a['EmpImage'] == "" && $rowq2a['Gender'] == 'Male'){?>
								<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/<?php echo 'images.png';?>">
								<?php  }elseif($rowq2a['EmpImage'] == "" && $rowq2a['Gender'] == 'Female'){
								?>
								<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/<?php echo 'images.jpg.jpg';?>">
								<?php } ?>
							</div>
							<div class="empSearchInfo col-md-10">
								<span class="fit">
									<?php echo $rowq2a['EMP_NAME'];?><i class="fa fa-gift"></i>
								</span>
								<span class="fit">
									<span class="kEmpCod"><?php echo $rowq2a['Emp_Code'];;?></span>
								</span>
								<span class="fit">
									<span><?php echo $rowq2a['DEPT_NAME'];?></span>
								</span>
							</a>
						</div>
					</div>
					<?php
					}
					}
					?>
					<?php
					$sqlq3wd = "select * from HrdMastQry WHERE  DATEPART(MM, DOJ)=DATEPART(MM, GETDATE()) and DATEPART(dd, DOJ)=DATEPART(dd, (DATEADD(DAY,1,GETDATE())))";
					$result3wd= query($query,$sqlq3wd,$pa,$opt,$ms_db);
					if ($num($result3wd)) {
						while ($row3wd = $fetch($result3wd)) {
					?>
					<div class="empSearchResult clearfix">
						<div class="empSearchImg col-md-2">
							<a onclick="editInfo('wdanniv','<?php echo $row3wd['OEMailID'];?>','<?php echo $row3wd['EMP_NAME'];?>','<?php echo $row3wd['Emp_Code'];?>')" class="black-txt fs-12">	<?php if($row3wd['EmpImage'] != ""){ ?>
								<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/<?php echo $row3wd['EmpImage'];?>">
								<?php  }else if($row3wd['EmpImage'] == "" && $row3wd['Gender'] == 'Male'){?>
								<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/<?php echo 'images.png';?>">
								<?php  }elseif($row3wd['EmpImage'] == "" && $row3wd['Gender'] == 'Female'){
								?>
								<img class="user-pic img-circle" style="width:100%;" src="../../pages/Profile/upload_images/<?php echo 'images.jpg.jpg';?>">
								<?php } ?>
							</div>
							<div class="empSearchInfo col-md-10">
								<span class="fit">
									<?php echo $row3wd['EMP_NAME'];?><i class="fa fa-glass"></i>
								</span>
								<span class="fit">
									<span class="kEmpCod"><?php echo $row3wd['Emp_Code'];;?></span>
								</span>
								<span class="fit">
									<span><?php echo $row3wd['DEPT_NAME'];?></span>
								</span>
							</a>
						</div>
					</div>
					<?php
					}
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
</div>
<div class=" leave-status" id="reptnoti" style="display: none">
<!-- BEGIN ALERTS PORTLET-->
<div class="portlet light z-depth-1 clearfix">
<div class="portlet-title">
<div class="caption">
	<span class="caption-subject  bold uppercase">Reporting Notification</span>
</div>
</div>
<div class="portlet-body">
<ul class="list-group" id="showrept">
</ul>
</div>
<!-- END ALERTS PORTLET-->
</div>
</div>
</div>
</div>
<!-- END CONTENT -->
<!-- BEGIN QUICK SIDEBAR -->
<!--Cooming Soon...-->
<!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<?php include('include/footer.php');  ?>
<!-- END FOOTER -->
</div>
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../../assets/global/plugins/respond.min.js"></script>
<script src="../../assets/global/plugins/excanvas.min.js"></script>
<![endif]-->
<script src="../../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="../../assets/global/scripts/materialize.min.js" type="text/javascript"></script>
<script src="../../assets/global/scripts/init.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="../../assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<!-- <script src="../../assets/global/plugins/flot/jquery.flot.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/flot/jquery.flot.resize.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/flot/jquery.flot.categories.js" type="text/javascript"></script> -->
<!-- END PAGE LEVEL PLUGINS -->
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="../../assets/global/plugins/moment.min.js"></script>
<script src="../../assets/global/plugins/fullcalendar/fullcalendar_home.js"></script>
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="../../assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="../../assets/admin/layout2/scripts/layout.js" type="text/javascript"></script>
<script src="../../assets/admin/layout2/scripts/demo.js" type="text/javascript"></script>
<script src="../../assets/admin/pages/scripts/calendar_home.js"></script>
<!-- <script src="../../assets/admin/pages/scripts/ecommerce-index.js"></script> -->
<script type="text/javascript" src="../../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/clockface/js/clockface.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<script src="../../assets/admin/pages/scripts/components-pickers.js"></script>
<script src="../../assets/admin/pages/scripts/table-managed.js"></script>
<script src="../js/common.js"></script>
<script src="../login/js/home.js"></script>
<script src="../leave/js/leave.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {
Metronic.init(); // init metronic core components
Layout.init(); // init current layout
Demo.init(); // init demo features
// EcommerceIndex.init();
Calendar.init();
ComponentsPickers.init();
	TableManaged.init();
});
show_noti();
function show_noti(){
	$.ajax({
		type: "GET",
		url: "ajax/noti_ajax.php?type=compNoti",
		success: function (html) {
			if(html =='1'){
				$("#noti").hide();
			}else{
				$("#noti").show();
				$("#noti1").html(html);
			}
		}
	});
	$.ajax({
		type: "GET",
		url: "ajax/noti_ajax.php?type=deptNoti",
		success: function (html) {
			if(html =='1'){
				$("#deptnoti").hide();
			}else{
				$("#deptnoti").show();
				$("#showdept").html(html);
			}
		}
	});
	$.ajax({
		type: "GET",
		url: "ajax/noti_ajax.php?type=reptNoti",
		success: function (html) {
			if(html =='1'){
				$("#reptnoti").hide();
			}else{
				$("#reptnoti").show();
				$("#showrept").html(html);
			}
		}
	});
}
getLeaveDetails('<?php echo $emp_code; ?>');
function getLeaveDetails(id) {
//alert(id);
$.ajax({
type: "POST",
url: "../leave/ajax/leave_function.php?type=showmyleave",
data: {id: id},
success: function (result) {
//    alert (result);
$("#my_leave").html(result);
}
});
}
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>