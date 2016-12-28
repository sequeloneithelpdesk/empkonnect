<?php
session_start();
include('../db_conn.php');
include('../configdata.php');
if((!isset($_SESSION['usercode']) || $_SESSION['usercode']=="")&& (!isset($_SESSION['usertype']) || $_SESSION['usertype']=="")){
	header('location: ../login/index.php');
}
$code=$_SESSION['usercode'];
//$c_val = 'end1234';
$c_val["Leave Management"]["Comp off Request-Approval"] = 'end1234';
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
        <?php include ('content/approveCompOff_content.php');?>

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
<script type="text/javascript" src="../../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="../../assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="../../assets/admin/layout2/scripts/layout.js" type="text/javascript"></script>
<script src="../../assets/admin/layout2/scripts/demo.js" type="text/javascript"></script>
<script src="../../assets/admin/pages/scripts/table-managed.js"></script>
<script src="../js/toastr.js"></script>
<script src="../js/table-excel.js"></script>
<script src="../js/common.js"></script>
<script>
    jQuery(document).ready(function() {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        Demo.init(); // init demo features
        TableManaged.init();
        //table_excel('sample_1');
    });

    $(window).load(function() {
        $('#loading').hide();
    });

     function getRelatedSelectbox(relval,code) {
         if(relval == 0){
            $("#actionSearch").hide();
            $("#monthlySearch").hide();
           // $("#bynameSearch").hide();
            $("#byRequesterSearch").hide();
            getContentPageResult(code);
        }else if(relval == 1){
            $("#monthlySearch").show();
            $("#actionSearch").hide();
           // $("#bynameSearch").hide();
            $("#byRequesterSearch").hide();
            getContentPageResult(code);
        }else if(relval == 2){
            $("#actionSearch").show();
            $("#monthlySearch").hide();
           // $("#bynameSearch").hide();
            $("#byRequesterSearch").hide();
            getContentPageResult(code);
        }else if(relval == 3) {
            $("#actionSearch").hide();
            $("#monthlySearch").hide();
           // $("#bynameSearch").hide();
            $("#byRequesterSearch").show();
            getContentPageResult(code);
        }
    }

function getContentPageResult(code){
       var type="appMainContent";
       $.ajax({
                type: "POST",
                url: "ajax/compOff_ajax.php",
                data: {userCode :  code, type: type },
                success: function (result) { 
                    //alert(result);
                    $("#searchData").html(result);
                }
        });
    }

    function allCheck(checkid,code) {
        alert("hh");
        if($("#"+checkid).is(":checked")){
            var status = "1";
            var type = "allcheck";

            $.ajax({
                type: "POST",
                url: "ajax/compOff_ajax.php",
                data: {userCode :  code, type: type, status:status },
                success: function (result) {
                    if(result){
                        var str=result;
                        str = str.slice(0, -1);
                        $("#selectedcheckbox").val(str);

                    }else {
                        toasterrormsg("Can not perform any action on Approved and Rejected .");
                    }

                }
            });
        }

        else if($("#"+checkid).is(":not(:checked)")){
            $("#selectedcheckbox").val("0");

        }
    }

    function mulCheck(mulcheckid) {
        var vals = [];

        if($("#"+mulcheckid).is(":checked")){

            $('.checkboxes:checked').each(function(){
                vals.push($(this).val());
            });

            $("#selectedcheckbox").val(vals);

        }
        else if($("#"+mulcheckid).is(":not(:checked)")){
            $("#Allcheck").val("0");
            $("#uniform-Allcheck  > span").removeClass ( 'checked' );

            $('.checkboxes:checked').each(function(i) {
                vals.push($(this).val());
            });

            $("#selectedcheckbox").val(vals);
        }
    }

    function showSubmitButton(btnVal,len) {
        if($("#selectedcheckbox").val() == 0){
            toasterrormsg("Select rows");
            return false;
        }else{
                $("#submitButtonDiv").show();
                $("#submitButton").val(btnVal);
                if(btnVal == 2 ){
                    $("#submitButton").html("Approved");
                    $("#submitButton").show();
                }else if(btnVal == 3 ){
                     $("#submitButton").html("Rejected");
                     $("#submitButton").show();
                }
                else{
                    $("#submitButton").hide();
                }
         }

    }


    function applyAction(code,status) {
        var inputval=$("#selectedcheckbox").val();
        var wd = $("#wd_hide").val();
        var remark= $("#Remrk").val();
         
            if(remark == "" || remark == undefined){
                $("#actGroupRemarks").css("border-color","red");
                toasterrormsg("Please Enter Remarks");
                return false;
            }else{
                 $("#actGroupRemarks").css('border-color','');
            }
        var type="mulcheck"
        $.ajax({
            type: "POST",
            url: "ajax/compOff_ajax.php",
            data: {userCode :  code, type: type, status:status, inputval:inputval, remark:remark},
            success: function (result) {
                alert(result);
                if(result == 1){
                    location.reload();

                }else {
                    toasterrormsg("Failed in Updation");
                }

            }
        });
    }

    function searchByStatus(statusid,code){
        var type="searchStatus";
        $.ajax({
            type:"POST",
            url:"ajax/compOff_ajax.php",
            data:{type:type, statusid:statusid, code:code},
            success: function(result){
                if(result){
                    //location.reload();
                    $("#searchData").html(result);
                }else{
                     $("#searchData").html("No Data Available");
                }
            }
        });

    }

     function getInputRequestValue(inputdata){
        $("#inputrequest").val(inputdata);
    }

    function serchByRequestName(buttonVal,code){
        var type="searchRequesterName";
        $.ajax({
            type:"POST",
            url:"ajax/compOff_ajax.php",
            data:{type:type, codename:buttonVal, code:code},
            success: function(result){
                if(result){
                    //location.reload();
                    $("#searchData").html(result);
                }else{
                     $("#searchData").html("no data Available");
                }
            }
        });
    }


    function getInputValue(inputval){
        $("#inputvalue").val(inputval);
    }

    function serchByCodeName(buttonVal,code){
        var type="searchName";
        $.ajax({
            type:"POST",
            url:"ajax/compOff_ajax.php",
            data:{type:type, codename:buttonVal, code:code},
            success: function(result){
                if(result){
                    //location.reload();
                    $("#searchData").html(result);
                }else{
                    $("#searchData").html("no data Available");
                }
            }
        });
    }

    function searchByDate(code){
        
        var type="searchDate";
        var fromDate=$("#fromDate").val();
        var toDate=$("#toDate").val();
        // alert(fromDate);
         //alert(toDate);
        $.ajax({
            type:"POST",
            url:"ajax/compOff_ajax.php",
            data:{type:type, fromDate:fromDate, toDate:toDate, code:code},
            success: function(result){
                if(result){
                    //location.reload();
                    $("#searchData").html(result);
                }else{
                     $("#searchData").html("no data Available");
                }
            }
        });
    }
    function getmycompoffId(mycompId,status,code){

        $.ajax({
            type: "POST",
            url: "content/view_approveCompOff.php",
            data: {id: mycompId, status:status, code:code},
            success: function (result) {
                 $('#approvecomprequest').html(result);
            }
        });
    }

    function submitAppRequest(mycompId,status_code,code,user){
        var type="AppStatus";
        var remark= $("#remrk").val();
         alert(type);
        if(remark == "" || remark == 'undefined'){
            $("#remrk").css("border-color","red");
            toasterrormsg("Please Enter Remarks");
            return false;
        }else{
             $("#remrk").css('border-color','none');
        }

        $.ajax({
           // alert(remark);
            type: "POST",
            url: "ajax/compOff_ajax.php",
            data: {mycompId: mycompId, type:type, status_code:status_code, code:code, user:user, remrk:remark},
            success: function (result) {
                 if(result == 1){
                    location.reload();
                 }else{
                    toasterrormsg("No updation");
                 }
            }
        });
    }
    


</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>