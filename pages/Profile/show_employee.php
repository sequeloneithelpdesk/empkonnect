<?php
session_start();
include "../db_conn.php";
include "../configdata.php";
if((!isset($_SESSION['usercode']) || $_SESSION['usercode']=="")&& (!isset($_SESSION['usertype']) || $_SESSION['usertype']=="")){
	header('location: ../login/index.php');
}
include "../include/preFunction.php";
$type=$_SESSION['usertype'];
$c_val["Profile"]["Edit Employee"] = 'end1234';

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

    <link href="../css/toastr.css"  rel="stylesheet" type="text/css"/>
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="../css/jquery-ui.css">

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

</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white custom-layout">
<div id="loading">
    <img id="loading-image" src="images/ajax-loader1.gif" alt="Loading..." />
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
        <div class="page-content-wrapper">
            <div class="page-content cus-light-grey">
                <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM
                <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">-->
        <div class="modal fade bs-modal-lg" id="large11" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog lg">
                        <div class="modal-content" style="width:850px;">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title"><div class="caption"><b></b></div></h4>
                            </div>
                            <div class="modal-body">                
             
                </div>
                            
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
                <!-- BEGIN PAGE CONTENT-->
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-globe"></i>View Employee List
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
                                            <!--<div class="btn-group">
                      <a class="btn default blue" data-toggle="modal" href="#large">
                                        Add New <i class="fa fa-plus"></i> </a>
                                        </div>-->
                    </div>
                                        <div class="col-md-6">
                                            <div class="btn-group pull-right">
                                                <button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
                                                </button>
                                                <ul class="dropdown-menu pull-right">
                                                    <li>
                                                        <a href="#">
                                                        Print </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                        Save as PDF </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                        Export to Excel </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-striped table-bordered table-hover" id="sample_2">
                                <thead>
                                <tr class='odd gradeX'>
                                    <th>
                                    Employee Code
                                    </th>
                                    <th>
                                    Employee Name
                                    </th>
                                    <th>
                                    Gender
                                    </th>
                                    <th>
                                    DOJ
                                    </th>
                                    <th>
                                    Reporting Manager
                                    </th> 
                                    <th>
                                    Employee Type
                                    </th>   
                                    <th>
                                    Function
                                    </th>                                   
                                    <th>
                                    Action
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                <?php

                $sql= "select Emp_Code,Emp_Name,sex,convert(varchar(10),DOJ,103) as DOJ,Mngr_Name,FUNCT_NAME,Type_Code from HrdMastqry ";
                if($type=="A"){

                }
                else{
                    $datalevel =  $_SESSION['Allrole'][$_SESSION['selectedRole']]['data'];

                    $sql.=" where ";
                    for ($i=0;$i<count($datalevel);$i++){
                        if($datalevel[$i]['text']=="Business Unit"){
                            for($b=0;$b<count($datalevel[$i]['children']);$b++) {
                                $sql .= " BussCode='" . $datalevel[$i]['children'][$b]['id']."'";
                                if($b<count($datalevel[$i]['children'])-1){
                                    $sql.= " or ";
                                }
                            }

                        }
                        if($datalevel[$i]['text']=="Location"){
                            $sql.= " and ";
                            for($l=0;$l<count($datalevel[$i]['children']);$l++) {
                                $sql .= " loc_Code='" . $datalevel[$i]['children'][$l]['id']."'";
                                if($l<count($datalevel[$i]['children'])-1){
                                    $sql.= " or ";
                                }
                            }

                        }

                        if($datalevel[$i]['text']=="Working Location"){
                            $sql.= " and ";
                            for($wl=0;$wl<count($datalevel[$i]['children']);$wl++) {
                                $sql .= " WLOC_CODE='" . $datalevel[$i]['children'][$wl]['id']."'";
                                if($wl<count($datalevel[$i]['children'])-1){
                                    $sql.= " or ";
                                }
                            }

                        }
                        if($datalevel[$i]['text']=="Function"){
                            $sql.= " and ";
                            for($f=0;$f<count($datalevel[$i]['children']);$f++) {
                                $sql .= " FUNCT_CODE='" . $datalevel[$i]['children'][$f]['id']."'";
                                if($f<count($datalevel[$i]['children'])-1){
                                    $sql.= " or ";
                                }
                            }

                        }
                        if($datalevel[$i]['text']=="Sub Function"){
                            $sql.= " and ";
                            for($sf=0;$sf<count($datalevel[$i]['children']);$sf++) {
                                $sql .= " SFUNCT_CODE='" . $datalevel[$i]['children'][$sf]['id']."'";
                                if($sf<count($datalevel[$i]['children'])-1){
                                    $sql.= " or ";
                                }
                            }

                        }
                        if($datalevel[$i]['text']=="Grade"){
                            $sql.= " and ";
                            for($g=0;$g<count($datalevel[$i]['children']);$g++) {
                                $sql .= " GRD_CODE='" . $datalevel[$i]['children'][$g]['id']."'";
                                if($g<count($datalevel[$i]['children'])-1){
                                    $sql.= " or ";
                                }
                            }

                        }
                        if($datalevel[$i]['text']=="Employee Type"){
                            $sql.= " and ";
                            for($et=0;$et<count($datalevel[$i]['children']);$et++) {
                                $sql .= " TYPE_CODE='" . $datalevel[$i]['children'][$et]['id']."'";
                                if($et<count($datalevel[$i]['children'])-1){
                                    $sql.= " or ";
                                }
                            }

                        }
                        if($datalevel[$i]['text']=="Level"){
                            $sql.= " and ";
                            for($lc=0;$lc<count($datalevel[$i]['children']);$lc++) {
                                $sql .= " Level_CODE='" . $datalevel[$i]['children'][$lc]['id']."'";
                                if($lc<count($datalevel[$i]['children'])-1){
                                    $sql.= " or ";
                                }
                            }

                        }
                        if($datalevel[$i]['text']=="Process"){
                            $sql.= " and ";
                            for($pr=0;$pr<count($datalevel[$i]['children']);$pr++) {
                                $sql .= " PROC_CODE='" . $datalevel[$i]['children'][$pr]['id']."'";
                                if($pr<count($datalevel[$i]['children'])-1){
                                    $sql.= " or ";
                                }
                            }

                        }

                    }
                }
                $result = query($query,$sql,$pa,$opt,$ms_db);
                $row_count = $num( $result );
                if ($row_count) {
                    $list="";
                    while($row =$fetch($result)) {
                        $oempCode = $row['Emp_Code'];
                        $list.= "<tr class='odd gradeX'><td>" . $row['Emp_Code']. "</td><td>" . $row['Emp_Name']. "</td><td>" . $row['sex']. "</td><td>" .$row['DOJ']. "</td><td>" .$row['Mngr_Name']. "</td><td>" . $row['FUNCT_NAME']. "</td><td>" . $row['Type_Code']. "</td><td style='white-space: nowrap'><a class='btn' href='showEmployee.php?oempCode=$oempCode'>View</a></td></tr>";
                    }
                    echo $list;
                } else {
                    echo "No results to display";
                }
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
<script src="js/view_employee_validation.js"></script>
<script>
jQuery(document).ready(function() {       
   Metronic.init(); // init metronic core components
Layout.init(); // init current layout
Demo.init(); // init demo features
   TableManaged.init();
   FormValidation.init();
});

$(window).load(function() {
    $('#loading').hide();
});

</script>
</body>
<!-- END BODY -->
</html>