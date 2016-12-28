<?php
session_start();
include('../db_conn.php');
include('../configdata.php');
$c_val["Profile"]["Add Employee"] = 'end1234';
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
        <?php include ('content/addEmp_content.php');?>

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
<script src="js/addEmp_validation.js" type="text/javascript"></script>
<script src="js/add_family_validation.js"></script>
<script src="js/add_nominee_validation.js"></script>
<script src="js/add_qualification_validation.js"></script>
<script src="js/add_language_validation.js"></script>
<script src="../js/jquery-ui.js"></script>
<script src="../js/toastr.js"></script>
<script src="../js/moment.js"></script>
<script src="../js/common.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
    jQuery(document).ready(function() {
        // initiate layout and plugins
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        Demo.init(); // init demo features
        ComponentsDropdowns.init();

        FormValidation1.init(); //for nominee
        FormValidation2.init(); //for qualification
        //FormValidation.init(); //for family
        FormValidation3.init(); // for language
        
        $(function() {
            $( "#dob" ).datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: '1950:2016',
                dateFormat: "dd/mm/yy"
            });

            $( "#doj" ).datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: '1950:2016',
                dateFormat: "dd/mm/yy"
            });
            $( "#dojWef" ).datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: '1950:2016',
                dateFormat: "dd/mm/yy"
            });
            $( "#dol" ).datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: '1950:2016',
                dateFormat: "dd/mm/yy"
            });
            $( "#dos" ).datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: '1950:2016',
                dateFormat: "dd/mm/yy"
            });
            $( "#dor" ).datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: '1950:2016',
                dateFormat: "dd/mm/yy"
            });


            $( "#passportIssue" ).datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: '1950:2016',
                dateFormat: "dd/mm/yy"
            });
            $( "#passportValidityDate" ).datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: '1950:2016',
                dateFormat: "dd/mm/yy"
            });
            $( "#dlDate" ).datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: '1950:2016',
                dateFormat: "dd/mm/yy"
            });
            $( "#dlValidityDate" ).datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: '1950:2016',
                dateFormat: "dd/mm/yy"
            });

            $("#effectiveDate").datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: '1950:2016',
                dateFormat: "dd/mm/yy"
            });

            $("#annivdate").datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: '1950:2016',
                dateFormat: "dd/mm/yy"
            });
            
        });

    });

function getTextLength(inputId,len,errMsg) {
    var myLength = $("#"+inputId).val() ;
    var msg="Length cant not enter more than"+len;
    if (myLength.length >= len){
       $("#"+errMsg).html(msg).show();
        $("#"+inputId).attr("readonly", true);
        $("#"+errMsg).fadeOut(4000);

    }

}

    function getBankIfsc(bankcode) {

        var code= bankcode;
        var type="sal";
        $.ajax({
            type: "POST",
            url: "ajax/emp_ajax.php",
            data: {bankCode :  code, type: type},
            success: function (result) {
                //location.reload();
                $('#ifscCode').val(result);

            }
        });

    }

    function getReimBankIfsc(bankcode) {

        var code= bankcode;
        var type= "reim";
        $.ajax({
            type: "POST",
            url: "ajax/emp_ajax.php",
            data: {bankCode :  code, type : type},
            success: function (result) {
                //location.reload();
                $('#reimIfsc').val(result);

            }
        });

      

    }

    function getAllState(countryid) {

        alert(countryid);
        var countryid= countryid;
        var type="allState";
        $.ajax({
            type: "POST",
            url: "ajax/emp_ajax.php",
            data: {countryid :  countryid, type : type},
            success: function (result) {
                alert(result);
                //location.reload();
                $('#state').html(result);

            }
        });


    }

    function addFamily() {
       // var id=$("#empCode").val()
        //alter(id);
        var empcode = $("#empCode").val();
        if(empcode==""){
            toasterrormsg("Please enter employee Code in official tab");
            return false;
        }else {
            $.ajax({
                type: "POST",
                url: "content/addFamily_content.php",
                data: {empCode: empcode},
                success: function (data) {
                    //alert (data);
                    $('#portlet-configAddtbody').html(data);
                    console.log(data);

                }
            });
        }

    }

    function addNominee() {
        var empcode = $("#empCode").val();
        if(empcode==""){
            toasterrormsg("Please enter employee Code in official tab");
            return false;
        }else {
            $.ajax({
                type: "POST",
                url: "content/addNominee_content.php",
                data: {empCode: empcode},
                success: function (data) {
                    //alert (data);
                    $('#portlet-config1Addtbody').html(data);
                    console.log(data);

                }
            });
        }
    }

    function addQual() {
        var empcode = $("#empCode").val();
        if(empcode==""){
            toasterrormsg("Please enter employee Code in official tab");
            return false;
        }else {
            $.ajax({
                type: "POST",
                url: "content/addQualification_content.php",
                data: {empCode: empcode},
                success: function (data) {
                    //alert (data);
                    $('#portlet-configAdd2tbody').html(data);
                    console.log(data);

                }
            });
        }
    }

    function check(checkid) {

        var check=$( "#"+checkid ).val("N");

        if($("#"+checkid).is(":checked")){
            $( "#"+checkid ).val("Y");
        }
        else if($("#"+checkid).is(":not(:checked)")){
            $( "#"+checkid ).val("N");
        }
    }


    function addLang() {
        var empcode = $("#empCode").val();
        if(empcode==""){
            toasterrormsg("Please enter employee Code in official tab");
            return false;
        }else {
            $.ajax({
                type: "POST",
                url: "content/addLanguage_content.php",
                data: {empCode: empcode},
                success: function (data) {
                    //alert (data);
                    $('#portlet-configAdd3tbody').html(data);
                    console.log(data);

                }
            });
        }
    }

    function submitAddFamily(id) {

        var formData=$('#AddFamilyForm').serialize()+ '&empCode=' +id;
        var emprelative=$("#relativeName").val();
        var emprelation =$("#relationship").val();
        // alert(formData);
        var type="AddFamily";
        if(emprelative == ""){
            toasterrormsg("Enter Relative Name");
            return false;
        }else if(emprelation == ""){
            toasterrormsg("Select Relation");
            return false;
        }else {
            $.ajax({
                type: "POST",
                url: "ajax/insertData.php?type=" + type,
                data: formData,
                success: function (data) {
                    //alert (data);
                    $('#viewData').html(data);
                    console.log(data);
                    $('#portlet-config').modal('hide');
                }
            });
        }
    }

    function submitAddLang(){
       // var formData=$('#AddLangugeForm').serialize();
        var empId=$("#empId").val();
        var language=$("#language").val();
        var read=$("#read1").val();
        var write=$("#write1").val();
        var speak=$("#speak1").val();
        var understand=$("#understand1").val();
        var motherTongue=$("#motherTongue23").val();

        var type="addLanguage";
        $.ajax({
            type:"POST",
            url: "ajax/insertData.php?type="+type,
            data:{read:read, write:write, speak:speak, understand:understand, motherTongue:motherTongue, empId:empId, language:language},
            success: function(data){
                $("#viewData3").html(data)
                console.log(data);
                $('#portlet-configAdd3tbody').modal('hide');
            }
        });

    }

    function check(checkid) {

        //var check=$("#motherTongue23").checked ;
        if($("#"+checkid).is(":checked")){
            $( "#"+checkid ).val("Y");
        }
        else if($("#"+checkid).is(":not(:checked)")){
            $( "#"+checkid ).val("N");
        }
    }


    function submitAddQual() {
        var formData=$('#AddQualForm').serialize();
        var qual=$("#qualification").val();
        var specialization=$("#specialization").val();
       // alert(formData);
        var type="addQualification";
        if(qual == ""){
            toasterrormsg("Select Qualification ");
            return false;
        }else if(specialization == ""){
            toasterrormsg("Enter Specialization");
            return false;
        }else {
            $.ajax({
                type: "POST",
                url: "ajax/insertData.php?type=" + type,
                data: formData,
                success: function (data) {
                    $('#viewData2').html(data);
                    console.log(data);
                    $('#portlet-config2Addtbody').modal('hide');
                    // location.reload();
                    //location.reload();
                }
            });
        }
    }

    function submitAddNominee() {
        var formData=$('#AddNomineeForm').serialize();
        var nominee=$("#nomineeName").val();
        var relation=$("#nomineeRelation").val();
       // alert(formData);
        var type="addNominee";
        if(nominee == ""){
            toasterrormsg("Enter Nominee Name");
            return false;
        }else if(relation == ""){
            toasterrormsg("Select Relation");
            return false;
        }else {
            $.ajax({
                type: "POST",
                url: "ajax/insertData.php?type=" + type,
                data: formData,
                success: function (data) {
                    $('#viewData1').html(data);
                    console.log(data);
                    $('#portlet-config1Addtbody').modal('hide');
                }

            });
        }

    }

    function getEmpCode() {
        var empCode=$("#empCode1").val();
        var type="empcodeValid";
        $.ajax({
            type:"POST",
            url:"../Profile/ajax/emp_ajax.php",
            data:{empCode:empCode, type:type},
            success: function(result){ //alert(result);
                if(result == 1){
                    $("#errorempcode").show();
                    $("#errorempcode").fadeOut(4000);
                    $("#empCode").val(empCode);
                    $("#accesscode").val(empCode);

                }else {
                    $("#empCode").val(empCode);
                    $("#accesscode").val(empCode);
                }
            }
        });
    }


    function selectSubFunction(functcode) {
        var type = "funct";
        $.ajax({
            type: "POST",
            url: "ajax/updateData.php?type="+type,
            data: {functcode: functcode, type: type},
            success: function (result) {
                //location.reload();
                //alert(result);
                $('#subFunctCode').html(result);

            }
        });
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