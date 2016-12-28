<?php
session_start();
include('../db_conn.php');
include('../configdata.php');
if((!isset($_SESSION['usercode']) || $_SESSION['usercode']=="")&& (!isset($_SESSION['usertype']) || $_SESSION['usertype']=="")){
	header('location: ../login/index.php');
}
include ('ajax/attendance_class.php');
$attendance_class_obj=new attendance_class();

$code=$_SESSION['usercode'];
$c_val["Time Management"]["My Out On Duty Request"] = 'end1234';
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
        <?php include ('content/myOutOnWork_content.php');?>

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
<script src="../js/toastr.js"></script>
<script src="../js/common.js"></script>
<script>
    jQuery(document).ready(function() {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        Demo.init(); // init demo features
        TableAdvanced.init();
    });
    
    $(window).load(function() {
        $('#loading').hide();
    });

    function getRelatedSelectbox(relval,code) {
        if(relval == 1){
            $("#monthlySearch").show();
            $("#actionSearch").hide();
            $("#bynameSearch").hide();
             getContentPageResult(code);
        }else if(relval == 0){
           $("#monthlySearch").hide();
            $("#actionSearch").hide();
            $("#bynameSearch").hide();
            getContentPageResult(code);
        }else if(relval == 2){
            $("#actionSearch").show();
            $("#monthlySearch").hide();
            $("#bynameSearch").hide();
             getContentPageResult(code);
        }else {
            $("#actionSearch").hide();
            $("#monthlySearch").hide();
            $("#bynameSearch").show();
             getContentPageResult(code);
        }
    }

    function getContentPageResult(code){
       var type="myMainContent";
       $.ajax({
                type: "POST",
                url: "ajax/outOnWork_ajax.php",
                data: {userCode :  code, type: type },
                success: function (result) { 
                    //alert(result);
                    $("#searchMyData").html(result);
                }
        });
    }

    function getmyodId(myodId,status,code){

        $.ajax({
            type: "POST",
            url: "content/view_myodrequest.php",
            data: {id: myodId, status:status, code:code},
            success: function (result) {
                 $('#myodrequest').html(result);
            }
        });
    }

    function submitCancelRequest(odid,createdBy,status,odkey){
        var type="subCancelStatus";
        var remark=$("#actRemarks").val();
        if(remark == ""){
            $("#actRemarks").css('border-color','red');
            toasterrormsg("Please Mentioned Remarks");
            return false;
        }
        else{
            $("#actRemarks").css('border-color','');

            $.ajax({
            type: "POST",
            url: "ajax/outOnWork_ajax.php",
            data: {id: odid, type:type, status:status,odkey:odkey,user:createdBy,remark:remark},
            success: function (result) {
                 if(result == 1){
                    location.reload();
                 }else{
                    toasterrormsg("no updation");
                 }
             }
            });
        }
        
    }

    function searchByStatus(statusid,code){
        var type="searchMyStatus";
        
        $.ajax({
            type:"POST",
            url:"ajax/outOnWork_ajax.php",
            data:{type:type, statusid:statusid, code:code},
            success: function(result){
                if(result){
                    //location.reload();
                    $("#searchMyData").html(result);
                }else{
                     $("#searchMyData").html("No Data Available");
                }
            }
        });

    }

    function getInputValue(inputval){
        $("#inputvalue").val(inputval);
    }

    function serchByCodeName(buttonVal,code){
        var type="searchMyName";
        //alert(buttonVal);
        $.ajax({
            type:"POST",
            url:"ajax/outOnWork_ajax.php",
            data:{type:type, codename:buttonVal, code:code},
            success: function(result){
                if(result){
                    //location.reload();
                    $("#searchMyData").html(result);
                }else{
                     $("#searchMyData").html("no data Available");
                }
            }
        });
    }

    function searchByDate(code){
        
        var type="searchMyDate";
        var fromDate=$("#fromDate").val();
        var toDate=$("#toDate").val();
        // alert(fromDate);
         //alert(toDate);
        $.ajax({
            type:"POST",
            url:"ajax/outOnWork_ajax.php",
            data:{type:type, fromDate:fromDate, toDate:toDate, code:code},
            success: function(result){
                if(result){
                    //location.reload();
                    $("#searchMyData").html(result);
                }else{
                     $("#searchMyData").html("no data Available");
                }
            }
        });
    }

</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>