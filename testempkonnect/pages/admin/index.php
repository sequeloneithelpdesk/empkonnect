<?php
session_start();
include ('../db_conn.php');
$c_val = 'end1234';
?>

<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
<meta charset="utf-8"/>
<title>HRMS</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css">
<link href="../../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="../../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
<link href="../../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="../../assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css">
<link href="../../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="../../assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/admin/layout2/css/layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="../../assets/admin/layout2/css/themes/grey.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/admin/layout2/css/custom.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/admin/layout2/css/kunal.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->

<link href="../css/toastr.css"  rel="stylesheet" type="text/css"/>
<link href="css/style.css" rel="stylesheet" type="text/css"/>

<link rel="shortcut icon" href="favicon.ico"/>

</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white custom-layout">
<!-- BEGIN HEADER -->
<?php  include('../include/header.php'); ?>

<div class="clearfix">
		</div>
		<div class="page-content-wrapper cus-dark-grey">
			<!-- BEGIN CONTAINER -->
			<div class="page-container">
				<!-- BEGIN SIDEBAR -->
		<div class="page-sidebar-wrapper modified">
			
			<div class="page-sidebar navbar-collapse collapse cus-dark-grey">
				
				<?php include('../include/leftMenu.php') ;?>
				
			</div>
		</div>
		<!-- END SIDEBAR -->
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content cus-light-grey">
				
				<!-- BEGIN PAGE HEADER-->
				<h3 class="page-title">
				Deshboard 
				</h3>
				<div class="page-bar z-depth-1">
					<ul class="page-breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="#">Home</a>
							<i class="fa fa-angle-right"></i>
						</li>
						
					</ul>
					
				</div>
				<!-- END PAGE HEADER-->
				<!-- BEGIN PAGE CONTENT-->
				<div class="tiles">
				<a href="role" >
					<div class="tile double-down bg-blue-hoki">
						<div class="tile-body">
							<i class="fa fa-eye-slash"></i>
						</div>
						<div class="tile-object">
							<div class="name">
								 Security
							</div>
							
						</div>
					</div> </a>
					<a href="policiesandform" >
					<div class="tile bg-red-sunglo">
						<div class="tile-body">
							<i class="fa fa-calendar"></i>
						</div>
						<div class="tile-object">
							<div class="name">
								 Policies and Forms
							</div>
							
						</div>
					</div> </a>
					<a href="year" >
					<div class="tile bg-red-sunglo">
						<div class="tile-body">
							<i class="fa fa-calendar"></i>
						</div>
						<div class="tile-object">
							<div class="name">
								 Change Year
							</div>
							
						</div>
					</div> </a>
					<div class="tile double bg-green-turquoise">
						
						<div class="tile-body">
							<i class="fa fa-envelope"></i>
						</div>
						<div class="tile-object">
							<div class="name">
								Company Annoucement
							</div>
							
						</div>
					</div>
					<div class="tile bg-yellow-saffron">
						
						<div class="tile-body">
							<i class="fa fa-thumb-tack"></i>
						</div>
						<div class="tile-object">
							<div class="name">
								 Departmental Notification
							</div>
							
						</div>
					</div>
					<div class="tile double bg-blue-madison">
						<div class="tile-body">
							<i class="fa fa-user"></i>
						</div>
						<div class="tile-object">
							<div class="name">
								 Message Admin Panel
							</div>
							
						</div>
					</div>
					<div class="tile bg-purple-studio">
						<div class="tile-body">
						<i class="fa fa-twitter"></i>
							
						</div>
						<div class="tile-object">
							<div class="name">
								 Mail Notification
							</div>
							
						</div>
					</div>
					<div class="tile bg-yellow-saffron ">
						<div class="tile-body">
							<i class="fa fa-bell-o"></i>
						</div>
						<div class="tile-object">
							<div class="name">
								Manage Alert
							</div>
						</div>
					</div>
					<div class="tile bg-green-meadow">
						<div class="tile-body">
							<i class="fa fa-bullhorn"></i>
						</div>
						<div class="tile-object">
							<div class="name">
								 New Opening
							</div>
							
						</div>
					</div>
					<div class="tile double bg-grey-cascade">
						<div class="tile-body">
							<i class="fa fa-users"></i>
						</div>
						<div class="tile-object">
							<div class="name">
								
								Employee Recognition
							</div>
							
						</div>
					</div>
					<div class="tile bg-red-intense">
						<div class="tile-body">
							<i class="fa fa-coffee"></i>
						</div>
						<div class="tile-object">
							<div class="name">
								Workflow Manager
							</div>
							
						</div>
					</div>
					<div class="tile bg-green">
						<div class="tile-body">
							<i class="fa fa-check-circle-o"></i>
						</div>
						<div class="tile-object">
							<div class="name">
								 Attendance Panel
							</div>
							
						</div>
					</div>
					<div class="tile bg-blue-steel">
						<div class="tile-body">
							<i class="fa fa-briefcase"></i>
						</div>
						<div class="tile-object">
							<div class="name">
								 Leave Panel
							</div>
							
						</div>
					</div>
					
					<div class="tile bg-red-sunglo">
						<div class="tile-body">
							<i class="fa fa-cogs"></i>
						</div>
						<div class="tile-object">
							<div class="name">
								 Log Reports
							</div>
							
						</div>
					</div>
				</div>
				<!-- END PAGE CONTENT-->
			
			</div>
		</div>
		<!-- END CONTENT -->
		<!-- BEGIN QUICK SIDEBAR -->
		<!--Cooming Soon...-->
		<!-- END QUICK SIDEBAR -->
	</div>
	<!-- END CONTAINER -->
	<!-- BEGIN FOOTER -->
	<?php include('../include/footer.php') ?>
	<!-- END FOOTER -->
</div>
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../../../../assets/global/plugins/respond.min.js"></script>
<script src="../../../../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="../../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
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
<script src="../../assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="../../assets/admin/layout2/scripts/layout.js" type="text/javascript"></script>
<script src="../../assets/admin/layout2/scripts/demo.js" type="text/javascript"></script>
<script src="../js/common.js"></script>
<script>
jQuery(document).ready(function() {       
   // initiate layout and plugins
   Metronic.init(); // init metronic core components
Layout.init(); // init current layout
Demo.init(); // init demo features
});
</script>
</body>
<!-- END BODY -->
</html>