<?php

$c_val  = 'end1234';

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
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]--> <!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
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
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css">
		<link href="../../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link href="../../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
		<link href="../../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
		<link href="../../assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css">
		<link href="../../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
		<link href="../../assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet"/>
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
						Dashboard <small>dashboard & statistics</small>
						</h3>
						<div class="page-bar z-depth-1 general-alert pt-15 pb-15 pl-15">
							<p class="fs-16 m-0">Notification <i class="fa fa-bell red-txt"></i><span class="fs-14 grey-txt">Account Department will work extra for 2hrs due to financial year closing.</span></p>
						</div>
						<!-- END PAGE HEADER-->
						<!-- BEGIN PAGE CONTENT-->
						<div class="row">
							<div class="col-md-6">
								<div class="to-do ">
									<!-- BEGIN ALERTS PORTLET-->
									<div class="portlet light z-depth-1 clearfix">
										<div class="portlet-title">
											<div class="caption">
												
												<span class="caption-subject  bold uppercase">What Do You want to do Today ?</span>
												
											</div>
											
										</div>
										<div class="portlet-body">
											
											<button type="button" class="cust-btn blue-bg col-md-12 waves-effect waves-light fs-16 white-txt center-align">Apply Leave</button>
											<button type="button" class=" cus-border-btn br2 cust-btn mt-15 col-md-12 waves-effect waves-light fs-16 center-align">Regularize of Your Attendance</button>
											
											
										</div>
										<!-- END ALERTS PORTLET-->
									</div>
								</div>
								<div class="leave-status">
									<!-- BEGIN ALERTS PORTLET-->
									<div class="portlet light z-depth-1 clearfix">
										<div class="portlet-title">
											<div class="caption">
												
												<div class="btn-group">
													<button type="button" class="dropdown-toggle brn white-bg" data-toggle="dropdown">
													<span class="hidden-sm hidden-xs caption-subject  bold uppercase">Leave Status&nbsp;</span>&nbsp;<i class="fa fa-angle-down"></i>
													</button>
													<ul class="dropdown-menu" role="menu">
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
													</ul>
												</div>
												
											</div>
											<div class="tabbable-line">
												<ul class="nav nav-tabs fl-r">
													
													<li class="green-active">
														<a href="#tab_15_2" data-toggle="tab">
														Approved </a>
													</li>
													<li>
														<a href="#tab_15_3" data-toggle="tab">
														Pending </a>
													</li>
												</ul>
											</div>
										</div>
										<div class="portlet-body">
											
											
											<div class="tab-content">
												<div class="tab-pane active" id="tab_15_2">
													
													
													<ul class="list-group">
														<li class="list-group-item p-0 pb-15">
															<span class="fs-16">21st Apr 16 - 30th Apr 16</span> <span class="badge green-bg br2 badge-default">
														PL </span>
														<span class="fs-14 grey-txt dsb">Lorem Ipsum is simply dummy text of the industry.</span>
													</li>
													<li class="list-group-item p-0 pb-15 pt-15">
														<span class="fs-16">21st Apr 16 - 30th Apr 16</span> <span class="badge badge-default red-bg br2">
													WPL </span>
													<span class="fs-14 grey-txt dsb">Lorem Ipsum is simply dummy text of the industry.</span>
												</li>
												<li class="list-group-item p-0 pb-15 pt-15">
													<span class="fs-16">21st Apr 16 - 30th Apr 16</span> <span class="badge badge-default green-bg br2">
												PL </span>
												<span class="fs-14 grey-txt dsb">Lorem Ipsum is simply dummy text of the industry.</span>
											</li>
											
											
										</ul>
									</div>
									<div class="tab-pane" id="tab_15_3">
										
										
										<ul class="list-group">
											
											<li class="list-group-item p-0 pb-15 pt-15">
												<span class="fs-16">21st Apr 16 - 30th Apr 16</span> <span class="badge badge-default red-bg br2">
											WPL </span>
											<span class="fs-14 grey-txt dsb">Lorem Ipsum is simply dummy text of the industry.</span>
										</li>
										<li class="list-group-item p-0 pb-15 pt-15">
											<span class="fs-16">21st Apr 16 - 30th Apr 16</span> <span class="badge badge-default green-bg br2">
										PL </span>
										<span class="fs-14 grey-txt dsb">Lorem Ipsum is simply dummy text of the industry.</span>
									</li>
									
									
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!-- END ALERTS PORTLET-->
			</div>
			<div class=" leave-status">
				<!-- BEGIN ALERTS PORTLET-->
				<div class="portlet light z-depth-1 clearfix">
					<div class="portlet-title">
						<div class="caption">
							
							<span class="caption-subject  bold uppercase">Department Notification</span>
							
						</div>
						
					</div>
					<div class="portlet-body">
						
						<ul class="list-group">
							
							<li class="list-group-item p-0 pb-15">
								<span class="fs-16">Lorem Ipsum is simply dummy text of the industry.</span>
							</li>
							<li class="list-group-item p-0 pb-15 pt-15">
								<span class="fs-16">Lorem Ipsum is simply dummy text of the industry.</span>
							</li>
					
						</ul>
					</div>
					<!-- END ALERTS PORTLET-->
				</div>
			</div>
			<div class="leave-status">
				<!-- BEGIN ALERTS PORTLET-->
				<div class="portlet light z-depth-1 clearfix">
					<div class="portlet-title">
						<div class="caption">
							
							<span class="caption-subject  bold uppercase">My team</span>
							
						</div>
						
					</div>
					<div class="portlet-body">
						<table class="table table-hover table-light">
							<thead>
								
							</thead>
							<tr>
								<td class="fit">
									<img class="user-pic" src="../../assets/admin/layout3/img/avatar4.jpg">
								</td>
								<td>
									<a href="#" class="black-txt fs-16">Moch Ramdhani</a>
									<span class="dsb">Department Name</span>
								</td>
								<td class="black-txt">
									Manager
								</td>
								<td class="black-txt right-align">
									80% attendance
								</td>
								
							</tr>
							<tr>
								<td class="fit">
									<img class="user-pic" src="../../assets/admin/layout3/img/avatar5.jpg">
								</td>
								<td>
									<a href="#" class="black-txt fs-16">John Doe</a>
									<span class="dsb">Department Name</span>
								</td>
								<td class="black-txt">
									Team Lead
								</td>
								<td class="black-txt right-align">
									90% attendance
								</td>
								
							</tr>
							
						</table>
					</div>
				</div>
			</div>
			<!-- END PAGE CONTENT-->
		</div>
		<div class="col-md-6 sec-part">
			<div class="my-plan ">
				<!-- BEGIN ALERTS PORTLET-->
				<div class="portlet light z-depth-1 clearfix">
					<div class="portlet-title">
						<div class="caption">
							
							<span class="caption-subject  bold uppercase">My Plan</span>
							
						</div>
						<div class="fl-r fs-14 white-txt cus-alert" ><span class="red-bg br2">Totla Leaves : 2</span></div>
					</div>
					<div class="portlet-body">
						
						<div id="calendar" class="has-toolbar">											</div>
						
						
					</div>
					<!-- END ALERTS PORTLET-->
				</div>
			</div>
			<div class=" job">
				<!-- BEGIN ALERTS PORTLET-->
				<div class="portlet light z-depth-1 clearfix">
					<div class="portlet-title">
						<div class="caption">
							
							<span class="caption-subject  bold uppercase">Job Oppenings</span>
							
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
									<a href="" class=" pl-15 pr-15 cus-border-btn green-txt right-align br2">More Details</a>
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
			</div>
			<div class="col-md-6 p-0 birthday ">
				<!-- BEGIN ALERTS PORTLET-->
				<div class="portlet light z-depth-1 clearfix p-0 mr-10">
					<div class="portlet-title pink-bg">
						<div class="caption">
							
							<span class="caption-subject  bold uppercase ">Birthday</span>
							
						</div>
						<form class="form-group fl-r" style="margin:0;">
							
							<div>
								
								<input class="form-control form-control-inline input-medium date-picker pink-bg brn" type="text" placeholder="Today" name="name_2" id="name_2" value="" tabindex="1" />
							</div>
							
							
							
						</form>
					</div>
					<div class="portlet-body">
						<table class="table table-hover table-light">
							<thead>
								
							</thead>
							<tr>
								<td class="fit">
									<img class="user-pic" src="../../assets/admin/layout3/img/avatar4.jpg">
								</td>
								<td>
									<a href="#" class="black-txt fs-16">Moch Ramdhani</a>
									<span class="dsb">Department Name</span>
								</td>
								
								
							</tr>
							<tr>
								<td class="fit">
									<img class="user-pic" src="../../assets/admin/layout3/img/avatar5.jpg">
								</td>
								<td>
									<a href="#" class="black-txt fs-16">John Doe</a>
									<span class="dsb">Department Name</span>
								</td>
								
								
							</tr>
							<tr>
								<td class="fit">
									<img class="user-pic" src="../../assets/admin/layout3/img/avatar5.jpg">
								</td>
								<td>
									<a href="#" class="black-txt fs-16">John Doe</a>
									<span class="dsb">Department Name</span>
								</td>
								
								
							</tr>
							
						</table>
					</div>
				</div>
			</div>
			<div class="col-md-6 p-0 connect ">
				<!-- BEGIN ALERTS PORTLET-->
				<div class="portlet light z-depth-1 clearfix ml-10">
					<div class="portlet-title">
						<form class="search-form search-form-expanded" action="extra_search.html" method="GET">
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Connect With Employee" name="query">
								<span class="input-group-btn">
									<a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
								</span>
							</div>
						</form>
						
					</div>
					<div class="portlet-body p-0">
						<div class="alert alert-info black-txt">
							New Joiny<span class="badge badge-default white-bg black-txt fl-r">6</span>
						</div>
						<table class="table table-hover table-light">
							<thead>
								
							</thead>
							<tr>
								<td class="fit">
									<img class="user-pic" src="../../assets/admin/layout3/img/avatar4.jpg">
								</td>
								<td>
									<a href="#" class="black-txt fs-16">Moch Ramdhani</a>
									<span class="dsb">Department Name</span>
								</td>
								
								
							</tr>
							<tr>
								<td class="fit">
									<img class="user-pic" src="../../assets/admin/layout3/img/avatar5.jpg">
								</td>
								<td>
									<a href="#" class="black-txt fs-16">John Doe</a>
									<span class="dsb">Department Name</span>
								</td>
								
								
							</tr>
							
						</table>
					</div>
				</div>
			</div>
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
<div class="page-footer">
<div class="page-footer-inner">
2014 &copy; Metronic by keenthemes.
</div>
<div class="scroll-to-top">
<i class="icon-arrow-up"></i>
</div>
</div>
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
<script src="../../assets/global/plugins/moment.min.js"></script>
<script src="../../assets/global/plugins/fullcalendar/fullcalendar.min.js"></script>
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="../../assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="../../assets/admin/layout2/scripts/layout.js" type="text/javascript"></script>
<script src="../../assets/admin/layout2/scripts/demo.js" type="text/javascript"></script>
<script src="../../assets/admin/pages/scripts/calendar.js"></script>
<!-- <script src="../../assets/admin/pages/scripts/ecommerce-index.js"></script> -->
<script type="text/javascript" src="../../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/clockface/js/clockface.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script src="../../assets/admin/pages/scripts/components-pickers.js"></script>
		<script src="../js/common.js"></script>
		<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {
Metronic.init(); // init metronic core components
Layout.init(); // init current layout
Demo.init(); // init demo features
// EcommerceIndex.init();
Calendar.init();
ComponentsPickers.init();
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>