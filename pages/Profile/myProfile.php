<?php
session_start();
include "../db_conn.php";
include "../configdata.php"; 
 if((!isset($_SESSION['usercode']) || $_SESSION['usercode']=="")&& (!isset($_SESSION['usertype']) || $_SESSION['usertype']=="")){
	header('location: ../login/index.php');
}
include "../include/preFunction.php";
$code=$_SESSION['usercode'];
$c_val["Profile"]["My Profile"] = 'end1234';
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
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="../../assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/admin/pages/css/profile.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN PAGE STYLES -->
    
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
    
    <link rel="stylesheet" href="../css/jquery-ui.css">

    <link rel="shortcut icon" href="favicon.ico"/>


    <style>

        .error
        {
            color: #FF0000;
        }
        #pswd_info
        {
            position:absolute;
            /* IE Specific */
            padding: 5px;
            top:16%;
            width:30%;
            left:53%;
            background:#fefefe;
            font-size:.875em;
            border-radius:10px;
            box-shadow:0 1px 3px #ccc;
            border:1px solid #ddd;
            z-index:100;
        }
        #pswd_info h4
        {
            margin:0 0 5px 0;
            padding:0;
            font-weight:normal;
        }
        #pswd_info::before
        {

            position:absolute;
            top:-12px;
            left:5%;
            font-size:12px;
            line-height:14px;
            color:#ddd;
            text-shadow:none;
            display:block;
        }
        .invalid_img
        {
            background-image:url(images/img/invalid.png);
            background-size:20px, 10px;
            background-repeat: no-repeat;
            padding-left:22px;
            line-height:24px;
            color:red;
        }
        .valid_img
        {
            background-image:url(images/img/valid.png);
            background-size:20px, 10px;
            background-repeat: no-repeat;
            padding-left:22px;
            line-height:24px;
            color:green;
        }
        #pswd_info
        {
            display:none;
        }
        @media screen and (max-width: 1024px)
        {
            #pswd_info
            {
                width: 50%;
                float:left;
                z-index: 1;
            }
        }
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
<!--<div class="page-content-wrapper cus-dark-grey">
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
    <?php include ('content/myProfile_content.php');?>


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
<script type="text/javascript" src="../../assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/jquery-validation/js/additional-methods.min.js"></script>
<!-- END CORE PLUGINS -->

<script type="text/javascript" src="../../assets/admin/pages/scripts/components-dropdowns.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js"></script>



<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="../../assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="../../assets/admin/layout2/scripts/layout.js" type="text/javascript"></script>
<script src="../../assets/admin/layout2/scripts/demo.js" type="text/javascript"></script>
<script src="../../assets/admin/pages/scripts/profile.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>


<script src="js/edit_Employee.js" type="text/javascript"></script>

<script src="../js/toastr.js"></script>
<script src="../js/common.js"></script>
<script src="../js/moment.js"></script>


<!-- END PAGE LEVEL SCRIPTS -->
<script>
    jQuery(document).ready(function() {
        // initiate layout and plugins
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        Demo.init(); // init demo features
        ComponentsDropdowns.init();

        show_ProfilePic('<?php echo $code; ?>');

        

        $(function() {
            $( "#dob" ).datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: "-100:+0",
                dateFormat: "dd/mm/yy"
            });

            $( "#doj" ).datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: "-100:+0",
                dateFormat: "dd/mm/yy"
            });
            $( "#dojWef" ).datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: "-100:+0",
                dateFormat: "dd/mm/yy"
            });
            $( "#dol" ).datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: "-100:+0",
                dateFormat: "dd/mm/yy"
            });
            $( "#dos" ).datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: "-100:+0",
                dateFormat: "dd/mm/yy"
            });
            $( "#dor" ).datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: "-100:+0",
                dateFormat: "dd/mm/yy"
            });


            $( "#passportIssue" ).datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: "-100:+0",
                dateFormat: "dd/mm/yy"
            });
            $( "#passportValidityDate" ).datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: "-100:+0",
                dateFormat: "dd/mm/yy"
            });
            $( "#dlDate" ).datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: "-100:+0",
                dateFormat: "dd/mm/yy"
            });
            $( "#dlValidityDate" ).datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: "-100:+0",
                dateFormat: "dd/mm/yy"
            });
            $("#effectiveDate").datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: "-100:+0",
                dateFormat: "dd/mm/yy"
            });
            $("#annivdate").datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: "-100:+0",
                dateFormat: "dd/mm/yy"
            });
            $("#nomineeWef").datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+0",
        dateFormat: "dd/mm/yy"
    });
    $("#nomineeDob").datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+0",
        dateFormat: "dd/mm/yy"
    });
            
        });


    });

    function selectSubFunction(functcode) {
        var type = "funct";
        $.ajax({
            type: "POST",
            url: "ajax/updateData.php?type="+type,
            data: {functcode: functcode, type: type},
            success: function (result) {
                //location.reload();
                //alert(result);
                $('#subFunctCode').innerHTML(result);

            }
        });
    }

    function getTextLength(inputId,len,errMsg) {
        var myLength = $("#"+inputId).val() ;
        var msg="Length cant not enter more than"+len;
        if (myLength.length >= len){
            $("#"+errMsg).html(msg).show();
            $("#"+inputId).attr("readonly", true);
            $("#"+errMsg).fadeOut(4000);

        }

    }

    function FillPermanent(f) {
        if(f.permanenttoo.checked == true) {
            f.pHNo.value = f.mHNo.value;
            f.pStreetNo.value = f.mStreetNo.value;
            f.pArea.value = f.mArea.value;
            f.pCity.value = f.mCity.value;
            f.pRegion.value = f.mRegion.value;
            f.pState.value = f.mState.value;
            f.pCountry.value = f.mCountry.value;
            f.pPin.value = f.mPin.value;
            f.pPhoneNo.value = f.mPhoneNo.value;
        }
    }

    $(window).load(function() {
        $('#loading').hide();
    });
    
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>