<?php 
session_start();
$c_val["Admin"]["Organization Structures"]["Locations"] = 'end1234';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<title>HRMS</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
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
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="../../assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/admin/layout2/css/layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="../../assets/admin/layout2/css/themes/grey.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/admin/layout2/css/custom.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/admin/layout2/css/kunal.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link href="../css/toastr.css"  rel="stylesheet" type="text/css"/>
<link href="../css/style.css" rel="stylesheet" type="text/css"/>
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
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM
				<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">-->
        <div class="modal fade bs-modal-lg" id="large" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog lg">
						<div class="modal-content" style="width:850px;">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
								<h4 class="modal-title"><div class="caption"><b>Add New Location</b></div></h4>
							</div>
							<div class="modal-body">                
                <?php include ("content/add/add_location.php"); ?>
             
                </div>
							
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->
        <div class="modal fade bs-modal-lg" id="large1" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog lg">
						<div class="modal-content" style="width:850px;">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
								<h4 class="modal-title"><div class="caption"><b>Edit Location</b></div></h4>
							</div>
							<div class="modal-body">                
                <div style="display:none;" id="edit"></div>
                </div>
							
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- BEGIN PAGE CONTENT-->
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN EXAMPLE TABLE PORTLET-->
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-globe"></i>View Locations List
								</div>
								<div class="tools">
									<a href="javascript:;" class="collapse">
									</a>
									<a href="#portlet-config" data-toggle="modal" class="config">
									</a>
									<a href="javascript:;" class="reload">
									</a>
									<a href="javascript:;" class="remove">
									</a>
								</div>
							</div>
							<div class="portlet-body">
								<div class="table-toolbar">
									<div class="row">
										<div class="col-md-6">
											<div class="btn-group">
                      <a class="btn default blue" data-toggle="modal" href="#large">
										Add New <i class="fa fa-plus"></i> </a>
										</div>
                    </div>
										
									</div>
								</div>
								<table class="table table-striped table-bordered table-hover" id="sample_2">
								<thead>
				 
								<tr class='odd gradeX'>
									<th> Location Code
									</th> <th>
									Location Name </th>
									<th>
									Location Type </th>
									<th> Location Parent
									</th> <th>
									Work Location </th>
									<th> Location Address 
									</th> <th>
									Location State  </th> 

									<th colspan="2"> Action
									</th>
								</tr>
								</thead>
								<tbody>
								<?php
                include '../db_conn.php'; include '../configdata.php';
                $sql = "SELECT * FROM LocMast";
                $resultq=query($query,$sql,$pa,$opt,$ms_db);
                $list="";
                while( $row = $fetch($resultq) ) {
                 $id=$row['LOC_CODE'];
                 $list.= "<tr class='odd gradeX'><td>" . $row['LOC_CODE']. "</td><td>" . $row['LOC_NAME']. "</td><td>" . $row['LOC_TYPE'] . "</td><td>" . $row['LOC_PARENT'] .  "</td><td>" . $row['WORK_LOC'] .  "</td><td>" . $row['LOC_ADDR1'] .  "</td><td>" . $row['LOC_STATE']. "</td>
				   <td style='white-space: nowrap'><a class='btn' ";
				  $list.="onclick=\"myFunction('$id');\">Edit</a>" . $row['LOC_STATUS']. "</td></tr>";
			  }
								echo $list;
 //<button class='btn'>Delete</button>
    // $list.= "<tr class='odd gradeX'><td>" . $row['locCode']. "</td><td>" . $row['locName']. "</td><td>" . $row['locType']. "</td><td>" . $row['locParent'] . "</td><td>" . $row['locWork'] .  "</td><td>" . $row['locAdd1'] .  "</td><td>" . $row['locState'].  "</td><td><button class='btn'>Details</button></td><td style='white-space: nowrap'><a class='btn' data-toggle='modal' href='#large1' onclick=\"myFunction('$id');\">Edit</a>&nbsp;<button class='btn'>Delete</button></td></tr>";



                ?>
								</tbody>
								</table>
							</div>
						</div>
						<!-- END EXAMPLE TABLE PORTLET-->
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
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="../../assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/jquery-validation/js/additional-methods.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="../../assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="../../assets/admin/layout2/scripts/layout.js" type="text/javascript"></script>
<script src="../../assets/admin/layout2/scripts/demo.js" type="text/javascript"></script>
<script src="../../assets/admin/pages/scripts/table-managed.js"></script>
<script src="../../assets/admin/pages/scripts/form-validation.js"></script>
<script src="js/add/add_location_validation.js"></script>
<script src="js/edit/edit_location_validation.js"></script>
<script>
jQuery(document).ready(function() {       
   Metronic.init(); // init metronic core components
Layout.init(); // init current layout
Demo.init(); // init demo features
   TableManaged.init();
   FormValidation1.init();
});
</script>
</body>
<!-- END BODY -->
</html>
