<?php
@session_start();
include ('../db_conn.php');
include ('../configdata.php');

$c_val["Profile"]["Employee Upload"] = 'end1234';
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
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
    <link href="../../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
    <!-- END PAGE LEVEL PLUGIN STYLES -->
    <!-- BEGIN PAGE STYLES -->
    <link href="../../assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css" media="screen"/>
    <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/select2/select2.css"/>
    <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
    <link href="../../assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/jstree/dist/themes/default/style.css"/>
    <!-- END PAGE STYLES -->
    <!-- BEGIN THEME STYLES -->
    <!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->
    <link href="../../assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
    <link href="../../assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/admin/layout2/css/layout.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/admin/layout2/css/themes/grey.css" rel="stylesheet" type="text/css" id="style_color"/>
    <link href="../../assets/admin/layout2/css/custom.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/admin/layout2/css/kunal.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME STYLES -->

    <link rel="stylesheet" type="text/css" href="./Excel-uploadData/css/CJ_ExcelImportCSSV01.css">
    <link href="../css/toastr.css"  rel="stylesheet" type="text/css"/>
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="../css/jquery-ui.css">

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
                   Employee Upload
                </h3>
                <div class="page-bar z-depth-1">
                    <ul class="page-breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a href="index.html">Home</a>
                            <i class="fa fa-angle-right"></i>
                        </li>

                        <li>
                            <a href="#">Employee Upload</a>
                        </li>
                    </ul>

                </div>

                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet box blue z-depth-1">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-edit"></i>Employee Upload
                                </div>

                            </div>
                            <div class="portlet-body">
                                <form class="form-horizontal">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <div class="col-md-3">
                                                <a href="blank_employee.csv" class="btn btn-block green">
                                                    Download blank Template <i class="fa fa-download"></i>
                                                </a>
                                            </div>
                                            <div class="col-md-4">
                                                Download blank template for Employee Upload .
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <div class="col-md-6">
                                                <input type="file" name="file" id="file"></div>
                                                <div class="col-md-6">
                                                <button type="button" class="btn purple btn-block" onclick="CJ_Import.sendData()" id="savebtn" ><i class="fa fa-check"></i> Upload</button>
                                                </div>

                                            </div>
                                            <div class="col-md-12">

                                                <table id="CJExcel_ErrorLog" cellpadding="0" cellspacing="0" width="100%"> </table>

                                            </div>
                                        </div>
                                    </div>

                                </form>

                            </div>
                        </div>

                    </div>
                </div>

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
        <!-- BEGIN PAGE LEVEL PLUGINS -->

        <script src="../../assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
        <script type="text/javascript" src="../../assets/global/plugins/select2/select2.min.js"></script>
        <script type="text/javascript" src="../../assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>

        <script type="text/javascript" src="../../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="../../assets/global/plugins/jstree/dist/jstree.min.js"></script>

        <!-- END PAGE LEVEL SCRIPTS -->
        <script src="../../assets/admin/pages/scripts/ui-tree.js"></script>
        <script src="../../assets/global/scripts/metronic.js" type="text/javascript"></script>
        <script src="../../assets/admin/layout2/scripts/layout.js" type="text/javascript"></script>
        <script src="../../assets/admin/layout2/scripts/demo.js" type="text/javascript"></script>
        <script src="../../assets/admin/pages/scripts/table-advanced.js"></script>
        <script src="../js/toastr.js"></script>
        <script src="../js/common.js"></script>
        
        <!--Data Upload Script Start-->
        <script src="./Excel-uploadData/js/CJ_Excel_Import_V0.00.js"></script>
        <script>
            CJ_Import.folderpath = './Excel-uploadData';
            CJ_Import.filepath = 'ZXhjZWx1cGxvYWQ=';
            CJ_Import.getData();

        </script>
        <script>
            jQuery(document).ready(function() {
                Metronic.init(); // init metronic core components
                Layout.init(); // init current layout
                Demo.init(); // init demo features

                //Role.init();

                TableAdvanced.init();
            });
        </script>

</body>
<!-- END BODY -->
</html>