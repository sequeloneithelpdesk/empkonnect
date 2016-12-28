<?php
session_start();
//include "../db_conn.php";
include ('../db_conn.php');
include ('../configdata.php');
if((!isset($_SESSION['usercode']) || $_SESSION['usercode']=="")&& (!isset($_SESSION['usertype']) || $_SESSION['usertype']=="")){
	header('location: ../login/index.php');
}
$c_val["Time Management"]["Manage Shift"] = 'end1234';
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
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/select2/select2.css"/>
    <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css"/>
    <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css"/>
    <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN THEME STYLES -->
    <link href="../../assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
    <link href="../../assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/admin/layout2/css/layout.css" rel="stylesheet" type="text/css"/>
    <link id="style_color" href="../../assets/admin/layout2/css/themes/grey.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/admin/layout2/css/custom.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/admin/layout2/css/kunal.css" rel="stylesheet" type="text/css"/>

    <link href="../css/toastr.css"  rel="stylesheet" type="text/css"/>
    <!--<link href="css/style.css" rel="stylesheet" type="text/css"/> -->

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
                <div class="modal fade bs-modal-lg" id="large1" tabindex="-1" role="dialog" aria-hidden="true" >
                    <div class="modal-dialog lg">
                        <div class="modal-content" id="edit" style="width:850px;">



                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>

                <!-- BEGIN PAGE HEADER-->
                <h3 class="page-title">
                    Shift Master
                </h3>
                <div class="page-bar z-depth-1">
                    <ul class="page-breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a href="index.php">Home</a>
                            <i class="fa fa-angle-right"></i>
                        </li>

                        <li>
                            <a href="#">Shift Master</a>
                        </li>
                    </ul>

                </div>
                <!-- END PAGE HEADER-->
                <!-- BEGIN PAGE CONTENT-->

                <div class="tab-pane" id="tab_4">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-gift"></i>Shift Master
                            </div>

                        </div>

                        <div class="portlet-body">
                            <!-- BEGIN FORM-->
                            <div class="table-toolbar">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="btn-group">

                                            <a href="#shiftmasterpopup" data-toggle="modal" class="btn green" onclick="myFunction('NA');">Add New <i class="fa fa-plus"></i></a>
                                        </div>
                                    </div>




                                </div>
                            </div>


                            <table class="table table-striped table-bordered table-hover" id="sample_2">
                                <thead>
                                <th>Shift Name</th>
                                <th>Shift Code</th>
                                <th>Shift Start Time</th>
                                <th>Shift End Time</th>
                                <th>Total Time(Hrs.)</th>
                                <th>Status</th>
                                <th>Action</th></thead>

                                <tbody>







                                </tbody>

                            </table>




                            <!-- END FORM-->
                        </div>


                    </div>
                </div>


                <!-- END PAGE CONTENT -->
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
<script src="../../assets/global/plugins/respond.min.js"></script>
<script src="../../assets/global/plugins/excanvas.min.js"></script>
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
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="../../assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="../../assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="../../assets/admin/layout2/scripts/layout.js" type="text/javascript"></script>
<script src="../../assets/admin/layout2/scripts/demo.js" type="text/javascript"></script>
<script src="../../assets/admin/pages/scripts/table-advanced.js"></script>
<script src="../../assets/admin/pages/scripts/form-validation.js"></script>
<script src="../js/toastr.js"></script>
<script src="../js/common.js"></script>
<script src="../js/table-excel.js"></script>
<script src="js/commonMaster.js" type="text/javascript"></script>
<script src="js/shift.js" type="text/javascript"></script>
<script src="js/common.js"></script>

<!-- END PAGE LEVEL SCRIPTS -->
<script>
    jQuery(document).ready(function() {
        // initiate layout and plugins
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        Demo.init(); // init demo features
        // FormSamples.init();
      //  ComponentsEditors.init();
       // TableAdvanced.init();
        //table_excel('sample_2');
    });
   SM.init('ShiftMast','Shift','sample_2','1','Shift');
    function myFunction(ShiftMastId){
        $.ajax({url: "content/shiftMaster_content.php?ShiftMastId="+ShiftMastId,
            cache: false,
            beforeSend: function(){
                loading();
            },
            success: function(result){
                unloading();
                $('#edit').show();
                $('#edit').html(result);
                $('#large1').modal('show');
                //FormValidation.init();
                return false;
            }});
    }

</script>




<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>

