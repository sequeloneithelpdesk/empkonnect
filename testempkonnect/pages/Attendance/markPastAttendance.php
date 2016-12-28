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
$sql1="select DSG_NAME, MailingAddress,EmpImage,EMP_NAME from hrdmastqry WHERE Emp_Code='$mngrcode'";
$res1=query($query,$sql1,$pa,$opt,$ms_db);
$data1=$fetch($res1);
$c_val["Time Management"]["Mark Past Attendance"] = 'end1234';
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
        <?php include ('content/markPastAttend_content.php');?>

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
<script src="../js/moment.js"></script>
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
        gettable_val();

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
            $("#inDate").datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: "dd/mm/yy",
            });
            $("#outDate").datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: "dd/mm/yy",
            });

        });


    });



    function gettable_val(){

        var fromDate = $("#fromDate").val();

        $.ajax({
            type: "POST",
            url: "ajax/rostlist.php?type=data1",
            data: fromDate,
            cache:false,
            success: function (result) {
                //alert(result);
                //location.reload();
              $("#levellist").val(result);
                levelfunc();

            }
        });
    }


    function levelfunc(){

        var level_list = $("#levellist").val();
        var l = level_list.split(';');
        var emp_code=$("#empcode").val();
        //alert(l[2]);
        $.ajax({
            type: "POST",
            url: "ajax/rostlist.php?type=data2",
            data: {dataval:l[2], emp_code:emp_code},
            cache:false,
            success: function (result) {
                //alert(result);
                //location.reload();
                $("#showlevel1").html(result);
                emp_code=result;

            }
        });
    }


    function selectDate(dateval,currdate,empcode){
          // alert('1');
        var Startdate = moment(dateval, "DD/MM/YYYY").format('YYYY-MM-DD');
        var currdate = moment(currdate, "DD/MM/YYYY").format('YYYY-MM-DD');
        if(Startdate > currdate){
             $("#futureDateErr").html("Can not apply past attendance on future date ");
            $( "#futureDateErr" ).show();
            

        }
        else{
             $( "#futureDateErr" ).fadeOut("slow");
             $("#futureDateErr").html("");

             $("#inDate").val(dateval);
            $("#outDate").val(dateval);
            var fromDate = $("#fromDate").val();
            var type="time";

            var formdata = {
                fromDate: fromDate,
                type: type,
                code:empcode
            }
            $.ajax({
                type: "POST",
                url: "ajax/markPastAtten_ajax.php",
                data: formdata,
                cache:false,
                success: function (result) {
                    $("#time_val").html(result);

                }
            });
        }

    }

    function  selectToDate() {
        $("#multipleDate").toggle();
        $("#inDateDiv").toggle();
        $("#outDateDiv").toggle();

        if(($("#hidd_todate").val()) == 0){
            $("#hidd_todate").val("1");
            $("#multiple").html("(single)");
        }else {
            $("#hidd_todate").val("0");
            $("#multiple").html("(multiple)");
        }

        
    }

    function submitPastAttend(userid, mngrcode) {

        var fromDate = $("#fromDate").val();
        var toDate= $("#toDate").val();

        var inDate = $("#inDate").val();
        var outDate = $("#outDate").val();

        var inHour = $("#inHour").val();
        var inMinute = $("#inMinute").val();
        var inap = $("input[name=inap]:checked").val();

        var outHour = $("#outHour").val();
        var outMinute = $("#outMinute").val();
        var outap =$("input[name=outap1]:checked").val();
        
        var notMarkingReas= $("#notMarkingReas").val();
        var remarks= $("#reamark").val();
        var approverId=$("#approverId").val();

        var strlevel=$("#levellist").val();

        var level1=strlevel.split(";");
        var levelarr=level1[0].split(",");
        var level=levelarr.toString();


        var Startdate = moment(fromDate, "DD/MM/YYYY").format('YYYY-MM-DD');
        var Enddate = moment(toDate, "DD/MM/YYYY").format('YYYY-MM-DD');



        if($("#futureDateErr").html() != ""){
            toasterrormsg("Can not apply past attendance on future date ");
            $( "#futureDateErr" ).show();
            return false;
        }else{
            $("#futureDateErr").fadeOut("slow");
            $("#futureDateErr").html("");
        }


        if(Startdate > Enddate){
             toasterrormsg("To date will be greater than From date");
            $( "#toDate" ).css('border-color', 'red');
            $("#fromDate").css('border-color', 'red');
            return false;
        }else{
             $( "#toDate" ).css('border-color', '');
            $("#fromDate").css('border-color', '');
        }


        if(fromDate == ""){
            toasterrormsg("Select From date ");
            $("#fromDate").css('border-color', 'red');
            return false;
        }else {
            $("#fromDate").css('border-color', '');
        }

        if( $("#hidd_todate").val() == 1 && toDate == ""){
            toasterrormsg("Select to date ");
            $("#toDate").css('border-color', 'red');
            return false;
        }else {
            $("#toDate").css('border-color', '');
        }

        if(inHour == "00" || inap == undefined ) {
            toasterrormsg("Select In Time ");
            $("#inHour").css('border-color', 'red');
            return false;
        }else{
            $("#inHour").css('border-color', '');
        }
       
        if( outHour == "00" ||  outap == undefined ) {
            //alert(outHour);
            //alert(outap);
            toasterrormsg("Select Out Time ");
            $("#outHour").css('border-color', 'red');
            return false;
        }else {
            $("#outHour").css('border-color', '');
        }

       

        if(notMarkingReas == ""){
            toasterrormsg("Select Not marking Reason ");
            $("#notMarkingReas").css('border-color', 'red');
            return false;
        }
        else {
            $("#notMarkingReas").css('border-color', '');
        }

        if(remarks == ""){
            toasterrormsg("Enter remarks ");
            $("#reamark").css('border-color', 'red');
            return false;
        }else {
            $("#reamark").css('border-color', '');
        }
        if($("#hidd_todate").val() == 1) {
            if (fromDate > toDate) {
                toasterrormsg("To date always be greater than from date");
                $("#fromDate").css('border-color', 'red');
                $("#toDate").css('border-color', 'red');
                return false;
            }
            else {
                $("#fromDate").css('border-color', '');
                $("#toDate").css('border-color', '');
            }
        }

        var type="pastAttendance";
        var formdata = {
            fromDate: fromDate,
            toDate: toDate,
            notMarkingReas: notMarkingReas,
            remarks: remarks,
            inHour: inHour,
            inMinute: inMinute,
            inap: inap,
            outHour: outHour,
            outMinute: outMinute,
            outap: outap,
            inDate:inDate,
            outDate:outDate,
            type: type,
            approverId:approverId,
            level:level,
            userid: userid
        };

        $.ajax({
            type: "POST",
            url: "ajax/outOnWork_ajax.php",
            data: formdata,
             beforeSend: function(){
                      loading();
                   },
            success: function(result){
                  unloading();
                if(result == 1) {
                    toastmsg("Added Successfully");
                    location.reload();
                }else if(result == 2){
                    toasterrormsg("Already Applied For This Date");
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