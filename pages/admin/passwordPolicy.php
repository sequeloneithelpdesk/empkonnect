<?php
session_start();
include ('../db_conn.php');
include ('../configdata.php');
if((!isset($_SESSION['usercode']) || $_SESSION['usercode']=="")&& (!isset($_SESSION['usertype']) || $_SESSION['usertype']=="")){
	header('location: ../login/index.php');
}
$c_val["Tools"]["Security"]["User Login and Password Policy"] = 'end1234';?>

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
    <link href="../../assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL PLUGIN STYLES -->
    <!-- BEGIN PAGE STYLES -->
    <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/select2/select2.css"/>
    <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
    <link href="../../assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="../css/jquery-ui.css">
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
                    Password and Policies
                </h3>
                <div class="page-bar z-depth-1">
                    <ul class="page-breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a href="index.php">Home</a>
                            <i class="fa fa-angle-right"></i>
                        </li>

                        <li>
                            <a href="#">Password and Policies</a>
                        </li>
                    </ul>

                </div>
                <!-- END PAGE HEADER-->
                <!-- BEGIN PAGE CONTENT-->
				<?php 
				$pslider ='null';
				$cslider ='null';
				$eslider ='null';
				$cstatusslider ='null';
				$estatusslider ='null';$unlockstatus ='null';
				$casestatus ='null';$resetstatus ='null';
				$lockstatus ='null';
				$quesstatus ='null';$otpstatus ='null';
				$defaultpasswordstatus ='null';$defaultpasswordexpirystatus ='null';
				$sqlq="select * from PasswordPolicy";
$resultq=query($query,$sqlq,$pa,$opt,$ms_db);
$test = $num($resultq);
if($num($resultq) >= 1) {
	
	
	while ($rowq = $fetch($resultq)) {
$pslider=$rowq['password_length'];
$cslider=$rowq['change_password_days'];
$eslider=$rowq['earlier_password_use'];
$cstatusslider=$rowq['change_password_days_status'];
$estatusslider=$rowq['earlier_password_use_status'];
$unlockstatus=$rowq['userid_unlock_status'];
$casestatus=$rowq['userid_case_sensitive'];
$lockstatus=$rowq['locked_userid_status'];
$resetstatus=$rowq['password_reset_link_status'];
$quesstatus=$rowq['password_reset_ques_status'];
$otpstatus=$rowq['ask_for_otp_status'];
$defaultpasswordstatus=$rowq['default_password_status'];
	$defaultpasswordexpirystatus=$rowq['default_password_expiry_status'];}
	include('content/edit_passwordpolicy_content.php');
	
}else{
	include('content/passwordPolicy_content.php');
}
							
					?>

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
<script type="text/javascript" src="../../assets/global/plugins/select2/select2.min.js"></script>

<script src="../js/jquery-ui.js"></script>

<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="../../assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="../../assets/admin/layout2/scripts/layout.js" type="text/javascript"></script>
<script src="../../assets/admin/layout2/scripts/demo.js" type="text/javascript"></script>
<script src="../js/toastr.js"></script>
<script src="../js/common.js"></script>
<script src="../../assets/admin/pages/scripts/components-jqueryui-sliders.js"></script>
<script src="js/adminfunc.js"></script>

<script>

    jQuery(document).ready(function() {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        Demo.init(); // init demo features
        //polform.showpolicies();
        ComponentsjQueryUISliders.init();
		var test_val = <?php echo $test; ?>;
		//alert(test_val);
		if(test_val >= 1){
			//alert(test_val);
				var value_slider_dynamic = <?php echo $pslider; ?>;
	$("#slider-range-max-amount").text($("#slider-range-max").slider(value_slider_dynamic));
	$("#slider-range-max-amount").text(value_slider_dynamic);
	$("#slider-range-max").slider({
	isRTL: Metronic.isRTL(),
	range: "max",
	min: 5,
	max: 30,
	value: value_slider_dynamic,
	slide: function (event, ui) {
	$("#slider-range-max-amount").text(ui.value);
	}
	});
	var value_slider_dynamic1 = <?php echo $cslider; ?>;
	$("#slider-range-max-amount5").text($("#slider-range-max5").slider(value_slider_dynamic1));
	$("#slider-range-max-amount5").text(value_slider_dynamic1);
	$("#slider-range-max5").slider({
	isRTL: Metronic.isRTL(),
	range: "max",
	min: 1,
	max: 230,
	value: value_slider_dynamic1,
	slide: function (event, ui) {
	$("#slider-range-max-amount5").text(ui.value);
	}
	});
	var value_slider_dynamic2 = <?php echo $eslider; ?>;
	$("#slider-range-max-amount6").text($("#slider-range-max6").slider(value_slider_dynamic2));
	$("#slider-range-max-amount6").text(value_slider_dynamic2);
	$("#slider-range-max6").slider({
	isRTL: Metronic.isRTL(),
	range: "max",
	min: 1,
	max: 5,
	value: value_slider_dynamic2,
	slide: function (event, ui) {
	$("#slider-range-max-amount6").text(ui.value);
	}
	});
	$( "#hid" ).click(function() {
	var active = $('#ask_for_otp_status').val();
	if(active==1){
	$("#hid").html('Active');
	$('#ask_for_otp_status').val("0");
	}else{
	$("#hid").html('Inactive');
	$('#ask_for_otp_status').val("1");
	}
	}); // status button for ask_for_otp
var unlock_status= <?php echo $unlockstatus; ?>;
if(unlock_status == 0){
$("#hide_auto_unlock_userid_after_time").hide();
}
var change_status= <?php echo $cstatusslider; ?>;
if(change_status == 0){
$("#hide_change_password_after").hide();
}
var earlier_status= <?php echo $estatusslider; ?>;
if(earlier_status == 0){
$("#hide_earlier_password_used").hide();
}
var case_status= <?php echo $casestatus; ?>;
if(case_status == 0){
$("#hide_case_sensitive").hide();
}
var lock_status= <?php echo $lockstatus; ?>;
if(lock_status == 0){
$("#hide_locked_userid_after_time").hide();
}
var reset_status= <?php echo $resetstatus; ?>;
if(reset_status == 0){
$("#hide_password_reset_link").hide();
}
var ques_status= <?php echo $quesstatus; ?>;
if(ques_status == 0){
$("#hide_password_reset_question").hide();
}
var otp_status= <?php echo $otpstatus; ?>;
if(otp_status == 0){
$("#hide_otp").hide();
}
var default_password_status= <?php echo $defaultpasswordstatus; ?>;
if(default_password_status == 0){
$("#hide_default_password").hide();
}
var default_password_expiry_status= <?php echo $defaultpasswordexpirystatus; ?>;
if(default_password_expiry_status == 0){
$("#hide_default_password_expiry").hide();
}
$( "#change_password" ).click(function() {
var active = $('#change_password_days_status').val();
if(active==1){
$("#change_password").html('Active');
$('#change_password_days_status').val("0");
}else{
$("#change_password").html('Inactive');
$('#change_password_days_status').val("1");
}
}); // status button for change password after (days)
$( "#earlier_password" ).click(function() {
var active = $('#earlier_password_use_status').val();
if(active==1){
$("#earlier_password").html('Active');
$('#earlier_password_use_status').val("0");
}else{
$("#earlier_password").html('Inactive');
$('#earlier_password_use_status').val("1");
}
}); // status button for number of earlier password can use
$( "#userid_sensitive" ).click(function() {
var active = $('#userid_sensitive_status').val();
if(active==1){
$("#userid_sensitive").html('Active');
$('#userid_sensitive_status').val("0");
}else{
$("#userid_sensitive").html('Inactive');
$('#userid_sensitive_status').val("1");
}
}); // status button for user id case sensitive
$( "#locked_userid" ).click(function() {
var active = $('#locked_userid_status').val();
if(active==1){
$("#locked_userid").html('Active');
$('#locked_userid_status').val("0");
}else{
$("#locked_userid").html('Inactive');
$('#locked_userid_status').val("1");
}
}); // status button for locked user id
$( "#userid_unlock" ).click(function() {
var active = $('#userid_unlock_status').val();
if(active==1){
$("#userid_unlock").html('Active');
$('#userid_unlock_status').val("0");
}else{
$("#userid_unlock").html('Inactive');
$('#userid_unlock_status').val("1");
}
}); // status button for auto unlock
$( "#password_reset_link_button" ).click(function() {
var active = $('#password_reset_link_status').val();
if(active==1){
$("#password_reset_link_button").html('Active');
$('#password_reset_link_status').val("0");
}else{
$("#password_reset_link_button").html('Inactive');
$('#password_reset_link_status').val("1");
}
}); // status button for password reset link
$( "#password_reset_question_button" ).click(function() {
var active = $('#password_reset_question_status').val();
if(active==1){
$("#password_reset_question_button").html('Active');
$('#password_reset_question_status').val("0");
}else{
$("#password_reset_question_button").html('Inactive');
$('#password_reset_question_status').val("1");
}
}); // status button for password reset link
$( "#default_password_button" ).click(function() {
var active = $('#default_password_status').val();
if(active==1){
$("#default_password_button").html('Active');
$('#default_password_status').val("0");
}else{
$("#default_password_button").html('Inactive');
$('#default_password_status').val("1");
}
});
$( "#default_password_expiry_button" ).click(function() {
var active = $('#default_password_expiry_status').val();
if(active==1){
$("#default_password_expiry_button").html('Active');
$('#default_password_expiry_status').val("0");
}else{
$("#default_password_expiry_button").html('Inactive');
$('#default_password_expiry_status').val("1");
}
});

 $("#qus dt a").on('click', function() {
            $("#qus dd ul").slideToggle('fast');
        });
        

        $("#qus dd ul li a").on('click', function() {
            $("#qus dd ul").hide();
        });

        $("#def dt a").on('click', function() {
            $("#def dd ul").slideToggle('fast');
        });
        $("#def dd ul li a").on('click', function() {
            $("#def dd ul").hide();
        });

        function getSelectedValue(id) {
            return $("#" + id).find("dt a span.value").html();
        }

        $(document).bind('click', function(e) {
            var $clicked = $(e.target);
            if (!$clicked.parents().hasClass("dropdown")) $(".dropdown dd ul").hide();
        });

        $('.mutliSelect input[type="checkbox"]').on('click', function() {

            var title = $(this).closest('.mutliSelect').find('input[type="checkbox"]').val(),
                title = $(this).val() + ",";

            if ($(this).is(':checked')) {
                var html = '<span title="' + title + '">' + title + '</span>';
                $('.multiSel').append(html);
                $("#others").html(html);
                $(".hida").hide();
            } else {
                $('span[title="' + title + '"]').remove();
                var ret = $(".hida");
                $('#qus dt a').append(ret);

            }
        });
        $('.mutliSelect1 input[type="checkbox"]').on('click', function() {

                    var title = $(this).closest('.mutliSelect1').find('input[type="checkbox"]').val(),
                        title = $(this).val() + ",";

                    if ($(this).is(':checked')) {
                        var html = '<span title="' + title + '">' + title + '</span>';
                        $('.multiSel1').append(html);
                        $("#others1").html(html);
                        $(".hida1").hide();
                    } else {
                        $('span[title="' + title + '"]').remove();
                        var ret = $(".hida");
                        $('#def dt a').append(ret);

                    }
                });
			
		}else{
			    var value_slider_dynamic = 5;
        $("#slider-range-max-amount").text($("#slider-range-max").slider(value_slider_dynamic));
        $("#slider-range-max-amount").text(value_slider_dynamic);
        $("#slider-range-max").slider({
            isRTL: Metronic.isRTL(),
            range: "max",
            min: 5,
            max: 30,
            value: value_slider_dynamic,
            slide: function (event, ui) {
                $("#slider-range-max-amount").text(ui.value);
            }
        });

        

        $( "#hid" ).click(function() {
           var active = $('#ask_for_otp_status').val();
            if(active==1){
                $("#hid").html('Active');
                $('#ask_for_otp_status').val("0");
            }else{
                $("#hid").html('Inactive');
                $('#ask_for_otp_status').val("1");
            }

        }); // status button for ask_for_otp

        $( "#change_password" ).click(function() {
            var active = $('#change_password_days_status').val();
            if(active==1){
                $("#change_password").html('Active');
                $('#change_password_days_status').val("0");
            }else{
                $("#change_password").html('Inactive');
                $('#change_password_days_status').val("1");
            }

        }); // status button for change password after (days)

        $( "#earlier_password" ).click(function() {
            var active = $('#earlier_password_use_status').val();

            if(active==1){
                $("#earlier_password").html('Active');
                $('#earlier_password_use_status').val("0");
            }else{
                $("#earlier_password").html('Inactive');
                $('#earlier_password_use_status').val("1");
            }

        }); // status button for number of earlier password can use


        $( "#userid_sensitive" ).click(function() {
            var active = $('#userid_sensitive_status').val();
            if(active==1){
                $("#userid_sensitive").html('Active');
                $('#userid_sensitive_status').val("0");
            }else{
                $("#userid_sensitive").html('Inactive');
                $('#userid_sensitive_status').val("1");
            }

        }); // status button for user id case sensitive


        $( "#locked_userid" ).click(function() {
            var active = $('#locked_userid_status').val();
            if(active==1){
                $("#locked_userid").html('Active');
                $('#locked_userid_status').val("0");
            }else{
                $("#locked_userid").html('Inactive');
                $('#locked_userid_status').val("1");
            }

        }); // status button for locked user id

        $( "#userid_unlock" ).click(function() {
            var active = $('#userid_unlock_status').val();
            if(active==1){
                $("#userid_unlock").html('Active');
                $('#userid_unlock_status').val("0");
            }else{
                $("#userid_unlock").html('Inactive');
                $('#userid_unlock_status').val("1");
            }

        }); // status button for auto unlock

        $( "#password_reset_link_button" ).click(function() {
            var active = $('#password_reset_link_status').val();
            if(active==1){
                $("#password_reset_link_button").html('Active');
                $('#password_reset_link_status').val("0");
            }else{
                $("#password_reset_link_button").html('Inactive');
                $('#password_reset_link_status').val("1");
            }

        }); // status button for password reset link

        $( "#password_reset_question_button" ).click(function() {
            var active = $('#password_reset_question_status').val();
            if(active==1){
                $("#password_reset_question_button").html('Active');
                $('#password_reset_question_status').val("0");
            }else{
                $("#password_reset_question_button").html('Inactive');
                $('#password_reset_question_status').val("1");
            }

        }); // status button for password reset link

        $( "#default_password_button" ).click(function() {
            var active = $('#default_password_status').val();
            if(active==1){
                $("#default_password_button").html('Active');
                $('#default_password_status').val("0");
            }else{
                $("#default_password_button").html('Inactive');
                $('#default_password_status').val("1");
            }

        }); 

        $( "#default_password_expiry_button" ).click(function() {
            var active = $('#default_password_expiry_status').val();
            if(active==1){
                $("#default_password_expiry_button").html('Active');
                $('#default_password_expiry_status').val("0");
            }else{
                $("#default_password_expiry_button").html('Inactive');
                $('#default_password_expiry_status').val("1");
            }

        }); 



        $("#qus dt a").on('click', function() {
            $("#qus dd ul").slideToggle('fast');
        });
        

        $("#qus dd ul li a").on('click', function() {
            $("#qus dd ul").hide();
        });

        $("#def dt a").on('click', function() {
            $("#def dd ul").slideToggle('fast');
        });
        $("#def dd ul li a").on('click', function() {
            $("#def dd ul").hide();
        });

        function getSelectedValue(id) {
            return $("#" + id).find("dt a span.value").html();
        }

        $(document).bind('click', function(e) {
            var $clicked = $(e.target);
            if (!$clicked.parents().hasClass("dropdown")) $(".dropdown dd ul").hide();
        });

        $('.mutliSelect input[type="checkbox"]').on('click', function() {

            var title = $(this).closest('.mutliSelect').find('input[type="checkbox"]').val(),
                title = $(this).val() + ",";

            if ($(this).is(':checked')) {
                var html = '<span title="' + title + '">' + title + '</span>';
                $('.multiSel').append(html);
                $("#others").html(html);
                $(".hida").hide();
            } else {
                $('span[title="' + title + '"]').remove();
                var ret = $(".hida");
                $('#qus dt a').append(ret);

            }
        });
        $('.mutliSelect1 input[type="checkbox"]').on('click', function() {

                    var title = $(this).closest('.mutliSelect1').find('input[type="checkbox"]').val(),
                        title = $(this).val() + ",";

                    if ($(this).is(':checked')) {
                        var html = '<span title="' + title + '">' + title + '</span>';
                        $('.multiSel1').append(html);
                        $("#others1").html(html);
                        $(".hida1").hide();
                    } else {
                        $('span[title="' + title + '"]').remove();
                        var ret = $(".hida");
                        $('#def dt a').append(ret);

                    }
                });

        

		}	
     

    });

	var test_val = <?php echo $test; ?>;
		if(test_val >= 1){
			$("#change_password").click(function() {
$("#hide_change_password_after").toggle();
});
$("#earlier_password").click(function() {
$("#hide_earlier_password_used").toggle();
});
$("#userid_sensitive").click(function() {
$("#hide_case_sensitive").toggle();
});
$("#locked_userid").click(function() {
$("#hide_locked_userid_after_time").toggle();
});
$("#userid_unlock").click(function() {
$("#hide_auto_unlock_userid_after_time").toggle();
});
$("#password_reset_link_button").click(function() {
$("#hide_password_reset_link").toggle();
});
$("#password_reset_question_button").click(function() {
$("#hide_password_reset_question").toggle();
});
$("#default_password_button").click(function() {
$("#hide_default_password").toggle();
});
$("#default_password_expiry_button").click(function() {
$("#hide_default_password_expiry").toggle();
});
$("#hid").click(function() {
$("#hide_otp").toggle();
});
$('input[type=radio]').change(function() {
if ($("input[name=alpha]:checked").val() == "0")
{
$("#alphabet,#uppercaseletter,#lowercaseletter").attr("disabled", true);
$("#alphabet,#uppercaseletter,#lowercaseletter").attr("value", '0');
}
if ($("input[name=alpha]:checked").val() == "1")
{
$("#alphabet,#uppercaseletter,#lowercaseletter").attr("disabled", false);
$("#alphabet,#uppercaseletter,#lowercaseletter").attr("value", '1');
if ($("input[name=uppercase]:checked").val() == "0")
{
$("#uppercaseletter").attr("disabled", true);
$("#uppercaseletter").attr("value", '0');
}
if ($("input[name=uppercase]:checked").val() == "1")
{
$("#uppercaseletter").attr("disabled", false);
$("#uppercaseletter").attr("value", '1');
}
if ($("input[name=lowercase]:checked").val() == "0")
{
$("#lowercaseletter").attr("disabled", true);
$("#lowercaseletter").attr("value", '0');
}
if ($("input[name=lowercase]:checked").val() == "1")
{
$("#lowercaseletter").attr("disabled", false);
$("#lowercaseletter").attr("value", '1');
}
}
if ($("input[name=numb]:checked").val() == "0")
{
$("#number").attr("disabled", true);
$("#number").attr("value", '0');
}
if ($("input[name=numb]:checked").val() == "1")
{
$("#number").attr("disabled", false);
$("#number").attr("value", '1');
}
if ($("input[name=spec]:checked").val() == "0")
{
$("#special").attr("disabled", true);
$("#special").attr("value", '0');
}
if ($("input[name=spec]:checked").val() == "1")
{
$("#special").attr("disabled", false);
$("#special").attr("value", '1');
}
});
		}else{
			 $("#change_password").click(function() {
        $("#hide_change_password_after").toggle();
    });

    $("#earlier_password").click(function() {
        $("#hide_earlier_password_used").toggle();
    });

    $("#userid_sensitive").click(function() {
        $("#hide_case_sensitive").toggle();
    });

    $("#locked_userid").click(function() {
        $("#hide_locked_userid_after_time").toggle();
    });

    $("#userid_unlock").click(function() {
        $("#hide_auto_unlock_userid_after_time").toggle();
    });

    $("#password_reset_link_button").click(function() {
        $("#hide_password_reset_link").toggle();
    });

    $("#password_reset_question_button").click(function() {
        $("#hide_password_reset_question").toggle();
    });
    $("#default_password_button").click(function() {
        $("#hide_default_password").toggle();
    });
     $("#default_password_expiry_button").click(function() {
        $("#hide_default_password_expiry").toggle();
    });

    $("#hid").click(function() {
        $("#hide_otp").toggle();
    });

    $('input[type=radio]').change(function() {
        if ($("input[name=alpha]:checked").val() == "0")
        {
            $("#alphabet,#uppercaseletter,#lowercaseletter").attr("disabled", true);
            $("#alphabet,#uppercaseletter,#lowercaseletter").attr("value", '0');


        }
        if ($("input[name=alpha]:checked").val() == "1")
        {
            $("#alphabet,#uppercaseletter,#lowercaseletter").attr("disabled", false);
            $("#alphabet,#uppercaseletter,#lowercaseletter").attr("value", '1');

            if ($("input[name=uppercase]:checked").val() == "0")
            {
                $("#uppercaseletter").attr("disabled", true);
                $("#uppercaseletter").attr("value", '0');
            }
            if ($("input[name=uppercase]:checked").val() == "1")
            {
                $("#uppercaseletter").attr("disabled", false);
                $("#uppercaseletter").attr("value", '1');
            }
            if ($("input[name=lowercase]:checked").val() == "0")
            {
                $("#lowercaseletter").attr("disabled", true);
                $("#lowercaseletter").attr("value", '0');
            }
            if ($("input[name=lowercase]:checked").val() == "1")
            {
                $("#lowercaseletter").attr("disabled", false);
                $("#lowercaseletter").attr("value", '1');
            }
        }


        if ($("input[name=numb]:checked").val() == "0")
        {
            $("#number").attr("disabled", true);
            $("#number").attr("value", '0');
        }
        if ($("input[name=numb]:checked").val() == "1")
        {
            $("#number").attr("disabled", false);
            $("#number").attr("value", '1');
        }
        if ($("input[name=spec]:checked").val() == "0")
        {
            $("#special").attr("disabled", true);
            $("#special").attr("value", '0');
        }
        if ($("input[name=spec]:checked").val() == "1")
        {
            $("#special").attr("disabled", false);
            $("#special").attr("value", '1');
        }

    });
function update_status_login(Status,ID)
{
    var new_update;

    if(ID=="1" && Status=="Inactive"){
        $('#status_update_btn1').html('Active');
        $('#status_update_btn1').val("Active");
        $('#status_update_btn2').html('Inactive');
        $('#status_update_btn2').val("Inactive");
        new_update = "Active";

    }
    else if(ID=="1" && Status=="Active"){
        $('#status_update_btn1').html('Inactive');
        $('#status_update_btn1').val("Inactive");
        $('#status_update_btn2').html('Active');
        $('#status_update_btn2').val("Active");
        new_update = "Inactive";
    }
    else if(ID=="2" && Status=="Active"){
        $('#status_update_btn2').html('Inactive');
        $('#status_update_btn2').val("Inactive");
        $('#status_update_btn1').html('Active');
        $('#status_update_btn1').val("Active");
        new_update = "Inactive";
    }
    else if(ID=="2" && Status=="Inactive"){
        $('#status_update_btn2').html('Active');
        $('#status_update_btn2').val("Active");
        $('#status_update_btn1').html('Inactive');
        $('#status_update_btn1').val("Inactive");
        new_update = "Active";
    }
    // if(Status=="Inactive"){
    //     $('#status_update_btn' + ID + '').html('Active');
    //     $('#status_update_btn' + ID + '').val("Active");
    //     new_update = "Active";

    // }else {
    //     $('#status_update_btn' + ID + '').html('Inactive');
    //     $('#status_update_btn' + ID + '').val("Inactive");
    //     new_update = "Inactive";
    // }
    call_value = "1";
    user_id=ID;
    status_val = new_update;

    var ALL_data = "u_ID="+user_id+"&status_update="+status_val+"&call_val="+call_value;
    $.ajax({
        type: "POST",
        url: "ajax/json.php",
        data: ALL_data,
        success: function (result) {
                    if(result == 1) {
                        toastmsg("Login Policy Update Successfully");
                        
                    }else {
                        toasterrormsg("Failed in Updation");
                    }
                }
    });
}

		}

   
</script>




</body>
<!-- END BODY -->
</html>