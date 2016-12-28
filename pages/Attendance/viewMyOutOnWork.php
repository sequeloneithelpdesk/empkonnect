<?php
session_start();
include('../db_conn.php');
include('../configdata.php');
if((!isset($_SESSION['usercode']) || $_SESSION['usercode']=="")&& (!isset($_SESSION['usertype']) || $_SESSION['usertype']=="")){
	header('location: ../login/index.php');
}
$code=$_SESSION['usercode'];
$sql="select * from hrdmastqry WHERE Emp_Code='$code'";
$res=query($query,$sql,$pa,$opt,$ms_db);
$data=$fetch($res);

$mngrcode=$data['MNGR_CODE'];
$sql1="select DSG_NAME, MailingAddress,EmpImage from hrdmastqry WHERE Emp_Code='$mngrcode'";
$res1=query($query,$sql1,$pa,$opt,$ms_db);
$data1=$fetch($res1);

$c_val["Time Management"]["Out On Duty Request"] = 'end1234';
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
    <link href="../../assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css" media="screen"/>
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
        <?php include ('content/viewMyOutOnWork_content.php');?>

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

<script src="../js/jquery-ui.js"></script>
<script src="../js/toastr.js"></script>
<script src="../js/common.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
    jQuery(document).ready(function() {
        // initiate layout and plugins
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        Demo.init(); // init demo features
        ComponentsDropdowns.init();
        $(function() {
            $( "#fromDate" ).datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: "dd/mm/yy"
            });

            $( "#toDate" ).datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: "dd/mm/yy",
                
            });
        });


    });

    function selecttime(radioval) {
        if(radioval == "late_in_early_out"){
            $("#timemanagement1").show();
            $("#timemanagement2").show();
            $("#hidd_outtime").val("1");
            $("#hidd_intime").val("1");
        }

        if( radioval == "early_out"){
            $("#timemanagement2").show();
            $("#timemanagement1").hide();
            $("#hidd_intime").val("0");
            $("#hidd_outtime").val("1");
        }

        if( radioval == "wiil_be_late"){
            $("#timemanagement1").show();
            $("#timemanagement2").hide();
            $("#hidd_intime").val("1");
            $("#hidd_outtime").val("0");
        }

        if(radioval == "whole_day_out"){
            $("#timemanagement1").hide();
            $("#timemanagement2").hide();
            $("#hidd_outtime").val("0");
            $("#hidd_intime").val("0");
        }
    }

    function  selectToDate() {
        $("#multipleDate").toggle();
        $("#excludecheck").toggle();

        if(($("#hidd_todate").val()) == 0){
            $("#hidd_todate").val("1");
        }else {
            $("#hidd_todate").val("0");
        }
        if(($("#hidd_Weekly").val()) == 0){
            $("#hidd_Weekly").val("1");
        }else {
            $("#hidd_Weekly").val("0");
        }

        if(($("#hidd_Leave").val()) == 0){
            $("#hidd_Leave").val("1");
        }else {
            $("#hidd_Leave").val("0");
        }
        $("#multiple").html("(I want select single date)");
    }
    
    function submitOutOnWork(userid, mngrcode) {
        var fromDate = $("#fromDate").val();

        var natureofwork = $("#natureofwork").val();
        var reason = $("#reason").val();
        var natureofworkcause = $("input[name=natureofworkcause1]:checked").val();

        var weeklyoff = $("input[name=weeklyoff1]:checked").val();
        var leavedays = $("input[name=leavedays1]:checked").val();

            var inHour = $("#inHour").val();
            var inMinute = $("#inMinute").val();
            var inap = $("input[name=inap]:checked").val();

            var outHour = $("#outHour").val();
            var outMinute = $("#outMinute").val();
            var outap =$("input[name=outap]:checked").val();
        
            var toDate= $("#toDate").val();


        if(fromDate == ""){
            toasterrormsg("Select From date ");
            $("#fromDate").css('border-color', 'red');
            return false;
        }

        if( $("#hidd_todate").val() == 1 && toDate == ""){
            toasterrormsg("Select to date ");
            $("#toDate").css('border-color', 'red');
            return false;
        }

        if(natureofworkcause == undefined){
            toasterrormsg("Select one radio button ");
            $("#natureofworkcause").css('border-color', 'red');
            return false;
        }

        if($("#hidd_intime").val() == 1 )
        {
            if(inHour == "00" || inap == undefined ) {
                toasterrormsg("Select In Time ");
                alert(inHour);
                alert(inMinute);
                alert(inap);

                $("#inHour").css('border-color', 'red');
                return false;
            }
        }

        if($("#hidd_outtime").val() == 1)
        {
            if( outHour == "00" ||  outap == undefined ) {
                alert(outHour);
                alert(outMinute);
                alert(outap);

                toasterrormsg("Select Out Time ");
                $("#outHour").css('border-color', 'red');
                return false;
            }
        }

        if($("#hidd_intime").val() == 0 )
        {
            inap= "00";
        }

        if($("#hidd_outtime").val() == 0)
        {
            outap= "00";
        }

        if(natureofwork == ""){
            toasterrormsg("Select nature of work ");
            $("#natureofwork").css('border-color', 'red');
            return false;
        }

        if( ($("#hidd_Weekly").val()) == 1 && weeklyoff == undefined){
            toasterrormsg("check exclude weekly off ");
            $("#weeklyoff").css('border-color', 'red');
            return false;
        }

        if( ($("#hidd_Weekly").val()) == 0 && weeklyoff == undefined){
            weeklyoff="";
        }



        if( ($("#hidd_Leave").val()) == 1 && leavedays == undefined){
            toasterrormsg("check exclude Leave days  ");
            $("#leavedays").css('border-color', 'red');
            return false;
        }

        if( ($("#hidd_Leave").val()) == 0 && leavedays == undefined){
           leavedays = "";
        }

        if(reason == ""){
            toasterrormsg("Enter reason ");
            $("#reason").css('border-color', 'red');
            return false;
        }
        if($("#hidd_todate").val() == 1) {
            if (fromDate > toDate) {
                toasterrormsg("To date always be greater than from date");
                $("#fromDate").css('border-color', 'red');
                $("#toDate").css('border-color', 'red');
                return false;
            }
        }

        var type="outOnWork";

        var formdata = {
            fromDate: fromDate,
            toDate: toDate,
            natureofworkcause: natureofworkcause,
            natureofwork: natureofwork,
            weeklyoff: weeklyoff,
            leavedays: leavedays,
            reason: reason,
            inHour: inHour,
            inMinute: inMinute,
            inap: inap,
            outHour: outHour,
            outMinute: outMinute,
            outap: outap,
            type: type,
            mngrcode1: mngrcode,
            userid: userid
        };

        $.ajax({
            type: "POST",
            url: "ajax/outOnWork_ajax.php",
            data: formdata,
            cache:false,
            success: function (result) {
                //alert(result);
                //location.reload();
                if(result == 1) {
                    toastmsg("Added Successfully");
                }else {
                    toasterrormsg("Failed in Addition");
                }

            }
        });
    }

    $(window).load(function() {
        $('#loading').hide();
    });


</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>