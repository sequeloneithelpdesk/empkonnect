<?php
session_start();
include ('../db_conn.php');
include ('../configdata.php');
if((!isset($_SESSION['usercode']) || $_SESSION['usercode']=="")&& (!isset($_SESSION['usertype']) || $_SESSION['usertype']=="")){
	header('location: ../login/index.php');
}
$c_val  = 'end1234';

$male='images.png';
$female='images.jpg.jpg';

if(isset($_GET['emp_code']) && !empty($_GET['emp_code'])){
	$emp_code =$_GET['emp_code'];
}else{
	$emp_code=$_SESSION['usercode']; 
}




$sqlq11="SELECT * FROM HrdMastQry WHERE Emp_Code = '".$emp_code."'";
$resultq11=query($query,$sqlq11,$pa,$opt,$ms_db);
if($num($resultq11)) {

    while ($rowq11 = $fetch($resultq11)) {
       
      
        if($rowq['EmpImage'] != ""){
            $empimage=htmlentities(stripslashes($rowq11['EmpImage']));
        }else if($rowq11['EmpImage'] == "" && $rowq11['Gender'] == 'Male'){
            $empimage=htmlentities(stripslashes($male));
        }elseif($rowq11['EmpImage'] == "" && $rowq11['Gender'] == 'Female'){
            $empimage=htmlentities(stripslashes($female));
        }
        	$empcode = $emp_code;
        	$empname = $rowq11['EMP_NAME'];
        	$empdsg  = $rowq11['DSG_NAME'];
        	$empdept = $rowq11['DEPT_NAME'];
       


    }
}

?>



<!DOCTYPE html>
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
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css">
		<link href="../../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link href="../../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
		<link href="../../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
		<link href="../../assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css">
		<link href="../../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
		<link href="../../assets/global/plugins/fullcalendar/fullcalendar.css" rel="stylesheet"/>
		<!-- END GLOBAL MANDATORY STYLES -->
		<!-- BEGIN THEME STYLES -->
		<link href="../../assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
		<link href="../../assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
		<link href="../../assets/admin/layout2/css/layout.css" rel="stylesheet" type="text/css"/>
		<link href="../../assets/admin/layout2/css/themes/grey.css" rel="stylesheet" type="text/css" id="style_color" />
		<link href="../../assets/admin/layout2/css/custom.css" rel="stylesheet" type="text/css"/>
		<link href="../../assets/admin/layout2/css/kunal.css" rel="stylesheet" type="text/css"/>
		<script src="../../assets/global/plugins/jquery.min.js" type="text/javascript"></script>

		<!-- END THEME STYLES -->
		<link rel="shortcut icon" href="favicon.ico"/>
		<style>
			
			.fc-day-grid-event > .fc-content {
			    margin-right: 18px;
			    padding: 3px;
			}

			.fc-day-grid-event > .fc-content > span {
			    white-space: pre-line;
			}

			.red, .red2, .green,.green2,.green_over,.red_over,.yellow,.yellow_over,.blue_over,.pink {
				height: 108px;
			    margin-left: -1px;
			    margin-right: -1px;
			    margin-top: -23px;
			}
			
			.red {
			    background: rgba(255,255,255, .0);
			}

			.red2 {
			    background: rgba(209,210,209, 0.05);
			}


			.green {
			    background: rgba(0,100,0,0.1);
			}

			.green_over,.red_over,.yellow_over,.green2,.red {
			    background: rgba(255,255,255,0.05);
			}

			
			.green2 {
			    background: rgba(209,210,209,0.05);
			}

			.yellow .fc-title::before {
			    background-color: yellow;
			}
		

			.yellow {
				background: rgba(255, 252, 192, 0.05);
			}

			

			.circle-legend .fc-title {
			    color: #2c2c2c;
			    display: block;
			    font-family: Open Sans;
			    font-size: 1.1em;
			    padding: 2px 6px 2px 15px;
			}
			.cal-event {
			    bottom: 3px;
			    position: absolute;
			    right: 0;
			}
			.att-time {
			    color: #817d7d;
			    font-size: 0.85em;
			    margin: 0 0 0 3px;
			}
			.circle-legend .fc-title:before{
				border-radius: 10px;
			    content: "";
			    height: 10px !important;
			    left: 5px;
			    margin: 0;
			    position: absolute;
			    top: 9px;
			    width: 10px !important;
			}
			.yellow .fc-title:before, .yellow_over .fc-title:before{
				background-color: #ff9800;
			}
			
			.red_over .fc-title::before, .red .fc-title::before {
			  	background-color: #f83d3d;
			}
			.blue_over .fc-title::before{
				background-color: #4646FF;
			}
			
			.green2 .fc-title::before{
				background-color: green;
			}

			.pink .fc-title::before{
				background-color: #999;
			}

			.pink_over .fc-title::before{
				background-color: green;
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
			    font-size: 1.1em;
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
		</style>
		<script>
			var HTTP_HOST = '<?php echo $_SERVER['HTTP_HOST'];?>';
		</script>
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
						<!-- BEGIN PAGE CONTENT-->
						<div class="row">
							<div class="col-md-12">
								
								<div class="leave-status">
									<!-- BEGIN ALERTS PORTLET-->
									<div class="portlet light z-depth-1 clearfix">
										<div class="portlet-title">
											<div class="caption">
												
												<div class="btn-group">
													<button type="button" class="dropdown-toggle brn white-bg" data-toggle="dropdown">
													<span class="hidden-sm hidden-xs caption-subject  bold uppercase">
													<?php 
														if(isset($_GET['emp_code']) && !empty($_GET['emp_code'])){ 
															echo $empname;
														}else{
															echo "My"; 
														} 
													?> Calendar&nbsp;
													</span>&nbsp;
													</button>
													
												</div>
												
											</div>
											<div class="tabbable-line">
												<ul class="nav nav-tabs fl-r">
													<?php if(isset($_GET['type']) && !empty($_GET['type']) && $_GET['type'] =='grpcal' || $_GET['type'] =='grpsum'){
													}else{ ?>
													<li class="green-active <?php if(!isset($_GET['type'])){echo 'active'; }?>">
														<a href="#tab_15_2" data-toggle="tab" <?php if(!isset($_GET['type'])){echo 'aria-expanded="true"'; }?>>
														Personal Calendars </a>
													</li>
													<?php } ?>
													<?php if(isset($_GET['emp_code']) && !empty($_GET['emp_code'])){

													}else{?>
														<?php if(isset($_GET['type']) && !empty($_GET['type']) && $_GET['type'] =='grpsum'){
													}else{ ?>
													<li <?php if($_GET['type'] =='grpcal'){echo 'class="green-active active"'; }?>>
														<a href="#tab_15_3" data-toggle="tab" <?php if($_GET['type'] =='grpcal'){echo 'aria-expanded="true"'; }?>>
														Group Calendars </a>
													</li>
													<?php } ?>
													<?php if(isset($_GET['type']) && !empty($_GET['type']) && $_GET['type'] =='grpcal'){
													}else{ ?>
													<li <?php if($_GET['type'] =='grpsum'){echo 'class="green-active active"'; }?>>
														<a href="#tab_15_4" data-toggle="tab" onclick="setCal" <?php if($_GET['type'] =='grpsum'){echo 'aria-expanded="true"'; }?>>
														Group Summary </a>
													</li>
													<?php } ?>
													<?php } ?>
												</ul>
											</div>
										</div>
										<div class="portlet-body">
											<div class="tab-content">
												<?php if(isset($_GET['type']) && !empty($_GET['type']) && $_GET['type'] =='grpcal' || $_GET['type'] =='grpsum'){
												}else{ ?>
													<div class="tab-pane active" id="tab_15_2">
													<div class="col-md-2">
														
														<div class="text-left" style="margin-top: 42px;">
														<img class="user-pic img-circle" style="width:60%;" src="../../pages/Profile/upload_images/<?php echo $empimage;?>">
														</div>
														<div class="text-left" style="margin-top:10px;">
														<?php echo "<b>".$empname."</b> <span style='font-size:.9em;color:#999'>(".$empcode.")</span><br>";?>
														
														<?php if(!empty($empdsg)){echo $empdsg."<br>";} ?>
														<?php if(!empty($empdept)){echo $empdept."<br>";} ?>
														
														</div>
													</div>
													<div class="col-md-10">
														<input type="hidden" id="emp_code" value="<?php echo $emp_code; ?>" >
														<div id="calendar" class="has-toolbar">										</div>
														<div id="eventContent" title="Event Details" style="display:none;">
														    <span id="shiftName"></span>
														    <span id="shiftInOutTime"></span><br><br>
														    <span id="presetStatus"></span>
														    <span id="leaveReason"></span>
														    <br>
														    <span id="startTime"></span><span id="endTime"></span>
														    <span id="birthdayRecords"></span>
														    <span id="anniversaryRecords"></span>
														</div>
													</div>
												</div>
													
												<?php }?>
												
												<?php if(isset($_GET['emp_code']) && !empty($_GET['emp_code'])){

													}else{?>
														<?php if(isset($_GET['type']) && !empty($_GET['type']) && $_GET['type'] =='grpsum'){
												}else{ ?>
												<div class="tab-pane <?php if($_GET['type'] =='grpcal'){echo 'active'; }?>" id="tab_15_3">
													<!-- start here  -->
													
													<div class="col-md-12">
														<div id="group_calendar">
														</div>
													</div>

													<!-- end here -->
												</div>
												<?php } ?>
												<?php if(isset($_GET['type']) && !empty($_GET['type']) && $_GET['type'] =='grpcal'){
												}else{ ?>
												<div class="tab-pane <?php if($_GET['type'] =='grpsum'){echo 'active'; }?>" id="tab_15_4">
													<div class="col-md-12">
														<div id="group_summary">
														</div>
													</div>
												</div>
												<?php } ?>
												<?php } ?>
											</div>
										</div>
									</div>
									<!-- END ALERTS PORTLET-->
								</div>
								<!-- END PAGE CONTENT-->
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
		<script src="../../assets/global/plugins/moment.js"></script>
		<script src="../../assets/global/plugins/fullcalendar/fullcalendar.js"></script>
		<!-- BEGIN PAGE LEVEL SCRIPTS -->
		<script src="../../assets/global/scripts/metronic.js" type="text/javascript"></script>
		<script src="../../assets/admin/layout2/scripts/layout.js" type="text/javascript"></script>
		<script src="../../assets/admin/layout2/scripts/demo.js" type="text/javascript"></script>
		<script src="../../assets/admin/pages/scripts/calendar.js"></script>
		<!-- <script src="../../assets/admin/pages/scripts/ecommerce-index.js"></script> -->
		<script type="text/javascript" src="../../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script type="text/javascript" src="../../assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
		<script type="text/javascript" src="../../assets/global/plugins/clockface/js/clockface.js"></script>
		<script type="text/javascript" src="../../assets/global/plugins/bootstrap-daterangepicker/moment.js"></script>
		<script type="text/javascript" src="../../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
		<script type="text/javascript" src="../../assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
		<script type="text/javascript" src="../../assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
		<script src="../../assets/admin/pages/scripts/components-pickers.js"></script>
		<link href="../css/jquery-ui.css" rel="stylesheet" type="text/css"/>
		<script src="../js/common.js"></script>
		<script src="js/group_calendar.js"></script>
		<script src="js/group_summary.js"></script>
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

			$( document ).ready(function() {
				setCal(year,month,date,'<?php echo $emp_code;?>');
				setCalSumm(year,month,date,'<?php echo $emp_code;?>');

			});

			

		</script>
		<!-- END JAVASCRIPTS -->
	</body>
	<!-- END BODY -->
</html>