<?php
session_start();
include('../db_conn.php');
include('../configdata.php');
$code=$_SESSION['usercode'];
$c_val = 'end1234';

 

?>
<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" xmlns="http://www.w3.org/1999/html">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>

    <meta charset="utf-8"/>
    <title>Sequel- HRMS</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
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
  
    <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/select2/select2.css"/>
    <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
    <link href="../../assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/jstree/dist/themes/default/style.css"/>

    <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-select/bootstrap-select.min.css"/>
    <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/jquery-multi-select/css/multi-select.css"/>


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

    <link href="../css/toastr.css"  rel="stylesheet" type="text/css"/>
    <link href="../css/style.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="../css/jquery-ui.css">
     <link href="../Attendance/css/sol.css"  rel="stylesheet" type="text/css"/>


    <link rel="shortcut icon" href="favicon.ico"/>
    <style>
        #loading {
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            position: fixed;
            display: block;
            opacity: 0.8;
            background-color: #1a1a1a;
            z-index: 99;
            text-align: center;
        }

        #loading-image {
            position: absolute;
            top: 30%;
            left: 35%;
            z-index: 100;
        }

    </style>
    <style type="text/css">
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
            }</style>
<script src="../../assets/global/plugins/jquery.min.js" type="text/javascript"></script>

</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white custom-layout">
<div id="loading">
    <img id="loading-image" src="../Profile/images/ajax-loader1.gif" alt="Loading..." />
</div>
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
        <?php include ('content/attendanceReport_content.php');?>

        <!-- END PAGE CONTAINER-->
    </div>
    <!-- BEGIN CONTENT -->
</div>
<!-- END CONTENT -->
<!-- BEGIN QUICK SIDEBAR -->
<!-- Cooming Soon...-->
<!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
    <?php include('../include/footer.php') ?>
</div>

<!-- END FOOTER -->
</div>
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../../assets/global/plugins/respond.min.js"></script>
<script src="../../assets/global/plugins/excanvas.min.js"></script>
<![endif]-->

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
<script type="text/javascript" src="../../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="../../assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="../../assets/admin/layout2/scripts/layout.js" type="text/javascript"></script>
<script src="../../assets/admin/layout2/scripts/demo.js" type="text/javascript"></script>
<script src="../../assets/admin/pages/scripts/table-managed.js"></script>
<script src="../js/toastr.js"></script>
<script src="../js/common.js"></script>
<script src="js/report.js"></script>
<script src="../Attendance/js/sol.js"  type="text/javascript"></script>
<script src="js/jquery.table2excel.js"></script>
<!-- <script src="js/php_funct.js"></script> -->

<script>
    jQuery(document).ready(function() {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        Demo.init(); // init demo features
        TableManaged.init();
    });
    
  $('#fromDate').datepicker( {
            changeMonth: false,
            changeYear: false,
            stepMonths: false,
            dateFormat : 'yy-mm-dd',
            onSelect: function (selected) {
            var dt = new Date(selected);
            dt.setDate(dt.getDate() + 1);
            $("#toDate").datepicker("option", "minDate", dt);
        },
        duration: 'fast'
        }).focus(function() {
          $(".ui-datepicker-prev, .ui-datepicker-next").remove();
        
        });
   $('#toDate').datepicker( {
            changeMonth: false,
            changeYear: false,
            stepMonths: false,
            dateFormat : 'yy-mm-dd',
            onSelect: function (selected) {
            var dt = new Date(selected);
            dt.setDate(dt.getDate() - 1);
            $("#fromDate").datepicker("option", "maxDate", dt);
        },
        duration: 'fast'
        }).focus(function() {
          $(".ui-datepicker-prev, .ui-datepicker-next").remove();
        
        
        });

    $(window).load(function() {
        $('#loading').hide();
    });

   

    $(function() {
        getTables('CompMast','COMP','company-select','1','a');
        getTables('BussMast','buss','business-select','1','a');
        getTables('subBussMast','subBuss','sub-business-select','1','a');
        getTables('locMast','LOC','location-select','1','a');
        getTables('WorkLocMast','WLoc','work-location-select','1','a');
        getTables('FUNCTMast','FUNCT','function-select','1','a');
        getTables('SubFunctMast','SubFunct','sub-function-select','1','a');
        getTables('CostMast','cost','cost-master-select','1','a');
        getTables('PROCMAST','PROC','process-select','1','a');
        getTables('GrdMast','GRD','grade-select','1','a');
        getTables('DsgMast','DSG','designation-select','1','a');

     $('#my-default-text-select').searchableOptionList({
                showSelectAll: true,
                 maxHeight: '250px',
                  texts: {
                    searchplaceholder: 'Select Employee'
                }
            });
   });  
function showfunction (value){
    if(value == '3'){
        $("#fromDate_div").hide();
        $("#toDate_div").hide();
       // $("#month_div").show();
    }
    else if(value == '4' || value == '5' || value == '6' || value == '2'){
        $("#fromDate_div").show();
        $("#toDate_div").show();
       // $("#month_div").show();
        //$("#month_div").hide();
    }
    else{
       // alert('1');
    }
}


</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>