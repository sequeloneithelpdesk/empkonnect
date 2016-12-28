<?php
session_start();
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
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]--> <!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <style>
        .error {color: #FF0000;}
        #pswd_info
        {
            position:absolute;
            /* IE Specific */
            padding: 5px;
            top:40%;
            width:20%;
            left:80%;
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
            background-image:url(public/img/invalid.png);
            background-size:20px, 10px;
            background-repeat: no-repeat;
            padding-left:22px;
            line-height:24px;
            color:red;
        }
        .valid_img
        {
            background-image:url(public/img/valid.png);
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


    </style>
    <meta charset="utf-8"/>
    <title>Empkonnect | Login</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="../../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/admin/layout2/css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="../../assets/admin/layout2/css/kunal.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body >
<div class="container-fluid">
    <div class="row m-0">

        <div class="slider fullscreen m-0 col l7 m6 s12">
            <ul class="slides">
                <li>
                    <img src="../../assets/admin/layout2/img/slider1.jpg" alt="slider" class="logo-default"/> <!-- random image -->
                    <div class="caption center-align">
                        <!-- <h3>This is our big Tagline!</h3>
                        <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5> -->
                    </div>
                </li>
                <li>
                    <img src="../../assets/admin/layout2/img/slider1.jpg" alt="slider" class="logo-default"/> <!-- random image -->
                    <div class="caption left-align">
                        <!-- <h3>Left Aligned Caption</h3>
                        <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5> -->
                    </div>
                </li>
                <li>
                    <img src="../../assets/admin/layout2/img/slider1.jpg" alt="slider" class="logo-default"/> <!-- random image -->
                    <div class="caption right-align">
                        <!-- <h3>Right Aligned Caption</h3>
                        <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5> -->
                    </div>
                </li>
                <li>
                    <img src="../../assets/admin/layout2/img/slider1.jpg" alt="slider" class="logo-default"/> <!-- random image -->
                    <div class="caption center-align">
                        <!-- <h3>This is our big Tagline!</h3>
                        <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5> -->
                    </div>
                </li>
            </ul>
        </div>
        <div class="m-0 col l5 m6 s12 fl-r mbg">
            <div class="row valign-wrapper m-0 mvh">
                <div class="col m12 center-m0 valign lfw" id="load-form">
                    <div class="login-form-container">
                    <center> <img src="../../assets/admin/layout2/img/logo.png" alt=""> </center>
                        <h3 class=" login-head fw-100 center">empKonnect</h3>
                        <p class="fw-300 center"></p>
                        <form method="post" class="col s12 p-0 login-form" action="login.php">
                            <div class="row">

                                <div class="input-field col s12 p-0">
                                     <p id="error" name="error" type="text" class="validate"></p>
                                </div>
                                <div class="input-field col s12 p-0">
                                    <input id="username" name="username" type="text" class="validate">
                                    <label for="username">Username</label>
                                </div>
                                <div class="input-field col s12 p-0">
                                    <input id="password" name="password" type="password" class="validate">
                                    <label for="password">Password</label>
                                </div>
                                <div class="col s12 p-0">
                                    <ul class="ds-ilb">
                                        <li>
                                            <input type="radio" id="login-r" name="group1" checked/>
                                            <label for="login-r">login</label>
                                        </li>
                                        <li class=" markin-r-wrapper">
                                            <input type="radio" id="markin-r" name="group1"/>
                                            <label for="markin-r">Mark in</label>
                                        </li>
                                        <li class="vnst markout-r-wrapper">
                                            <input type="radio" id="markout-r" name="group1"/>
                                            <label for="markout-r">Mark out</label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="input-field col s12 p-0 login-btn">
                                    <p class="vnst mark-in-time clearfix center-align fw-300">Mark in time <span> 9:00 am</span></p>
                                    <p class="vnst mark-out-time center-align fw-300">Mark out time <span>6:00 pm</span></p>
                                    <button type="submit" id="sub-att" class="cust-btn mb-10 upc red-bg col s12 pt-10 pb-10 waves-effect waves-light fs-16 white-txt center-align">Login</button>
                                    <div class="col s6 p-0">
                                        <input type="checkbox" id="test5" /> <label style="top:0;font-weight:normal;line-height: 18px;" for="test5">Remember me</label>
                                    </div>
                                    <div class="col s6 p-0" style="text-align: right;">
                                        <a class="for-pass">Forgot Password <span>?</span></a>
                                    </div>
                                </div>
                                <div class="col s12 center">
                                    <img src="../../assets/admin/layout2/img/sql.png" alt="logo" class="logo-default">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>
</div>
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../../assets/global/plugins/respond.min.js"></script>
<script src="../../assets/global/plugins/excanvas.min.js"></script>
<![endif]-->
<script src="../../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="../../assets/global/scripts/materialize.js" type="text/javascript"></script>
<script src="../../assets/global/scripts/init.js" type="text/javascript"></script>



<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script type="text/javascript">
    $(document).ready(function(){
        $('#login-r').click(function(){
            if($(this).is(':checked')) {
                $("#sub-att").html("login");
            }
        });
        $('#markin-r').click(function(){
            if($(this).is(':checked')) {
                $("#sub-att").html("Mark in");
                // $(".markout-r").attr('checked',true);
            }
        });
        $('#markout-r').click(function(){
            if($(this).is(':checked')) {
                $("#sub-att").html("Mark out");
                // $(".markin-r").attr('checked',true);
            }
        });
        $('#sub-att').click(function(){
            if($('#markin-r').is(':checked')) {
                $(".markout-r-wrapper, .mark-in-time").removeClass("vnst");
                $(".markin-r-wrapper").addClass("vnst") ;
                $(".mark-in-time").addClass("vbst");
                // $(".markout-r").prop('checked',true);
                $(this).html("mark out");
                window.setTimeout(function(){
                    $(".mark-in-time").addClass('vnst');
                }, 5000);}

            if($('#markout-r').is(':checked')) {
                $(".markin-r-wrapper, .mark-out-time").removeClass("vnst");
                $(".markout-r-wrapper").addClass("vnst") ;
                window.setTimeout(function(){
                    $(".mark-out-time").addClass("vbst");
                    // $(".markin-r").prop('checked',true);
                    $(this).html("mark in");
                    $(".mark-out-time").addClass('vnst');
                }, 5000);}
        });

        $(".for-pass").click(function(){
             $(".login-form-container").fadeOut(
                function(){
                    $(this).detach();
                });
            $("#load-form").load("login_form1.php .pass-form-container");

        });



    });

    $(document).on('keyup', '.input-field', function () {

        company_code = document.getElementById("companycode").value;
        login_ID = document.getElementById("loginId").value;


        if (login_ID.length > 0) {
            $('#idrequire').fadeOut(2000);
        }
        else {
            $('#idrequire').show();
        }

   });


function show_question_div(s)
{
    var id_user = $("#loginId").val();
   // var company_code = $('#companycode').val();
    if (id_user == "" )
    {
        if (id_user == "")
        {
            $("#idrequire").html("Required field");
        }

    }
    else {

        var dataString = 'action='+ s+'&uid=' + id_user;
        //alert(dataString);
        $.ajax({
            type: "POST",
            url: "resetPassword.php",
            data: dataString,
            success: function (data) {
                $('#hidden_ajax_value').val(data);
                if(data != "false") {
                    $("#show_error").html("");
                    var split_hidden_elem = document.getElementById('hidden_ajax_value').value;
                    var s = split_hidden_elem.split(',');
                    if (s[0] == 1) {
                        $("#Reset_Password_ques").show();
                        $("#continue_button1").hide();
                    }
                    else if (s[1] == 1) {
                        alert(s[2]);
                        $("#Ask_For_OTP").show();
                        $("#continue_button1").hide();
                    }
                    else {
                        $("#Password_Reset_DIV").show();
                        $("#continue_button1").hide();

                    }
                }
                else{
                    $("#show_error").html("Incorrect Login ID");
                }


            }
        });
    }

}

    function question_validation(q)
    {
        var id_user = $("#loginId").val();
        var ques_length = document.getElementsByName("ques_name").length;
        var quesname = document.getElementsByName("ques_name").id;
        var ans = [];
        var name = [];
        for (var i = 0;i<ques_length; i++) {

        ans.push(document.getElementsByName("ques_name")[i].value);
            name.push(document.getElementsByName("ques_name")[i].id)
        }

        var dataString = 'user_ans='+ ans +'&user_ques=' + name+'&uid=' + id_user+'&action=' + q ;
       // alert(dataString);

            $.ajax({
                type: "POST",
                url: "resetPassword.php",
                data: dataString,
                success: function (data1) {
                   //     alert(data1);
                    $('#hidden_ajax_value2').val(data1);
                    if(data1 != false) {
                        var split_hidden_elem2 = document.getElementById('hidden_ajax_value2').value;
                        var q_val = split_hidden_elem2.split(',');
                      //  alert(q_val.length);
                        if ( $.inArray('1', q_val) > -1 ){
                            alert(q_val[1]);
                                $("#continue_button2").hide();
                                $("#Ask_For_OTP").show();
                            }
                            if(q_val == ""){
                                $("#Reset_Password_ques").hide();
                                $("#Password_Reset_DIV").show();
                                $("#continue_button1").hide();
                            }




                    }

                }
            });

          }
    
function otp_validation(o)
{
    var otp_value = $("#entered_otp").val();
    var id_user = $("#loginId").val();
   // alert(o);
    if (otp_value != '')
    {
        var dataString = 'otp_value='+ otp_value +'&action=' + o+'&uid=' + id_user ;

        $.ajax({
            type: "POST",
            url: "resetPassword.php",
            data: dataString,
            success: function (data3) {
              //  alert(data3);
                if(data3 == "true"){
                    $("#Password_Reset_DIV").show();
                    $("#continue_button3").hide();
                }

                            }
        });


    }
}
 function reset_Password(r)
 {
     var id_user = $("#loginId").val();
     var newpass = $("#new_password").val();
     var confpass = $("#confirm_password").val();

     if(id_user != "" && confpass !="" && newpass !=""){

         var dataString = 'new_password='+ newpass +'&confirm_password=' + confpass+'&uid=' + id_user +'&action=' + r ;

         $.ajax({
             type: "POST",
             url: "resetPassword.php",
             data: dataString,
             success: function () {
                 document.location.href='index.php'
             }
         });

     }


 }

    function password_Validation()
    {

        $('#pswd_info').show();

        $('#new_password').keyup(function () {

            var pswd = $(this).val();
            var passlen = $('#pass_length').val();
            var alphalen = $('#alphabet_char').val();
            var upperlen = $('#capital').val();
            var lowerlen = $('#small').val();
            var numlen = $('#number_v').val();
            var speclen = $('#sletter').val();
            var x;
            var checking="";
            if (pswd.length < passlen)
            {
                $('#pass_length').removeClass('valid_img').addClass('invalid_img');
                checking=false;
            }
            else
            {
                $('#pass_length').removeClass('invalid_img').addClass('valid_img');
                x = $('#new_password').val();
            }
            if ((pswd.match(/[!@#$%^&*.]/)) && (pswd.match(/[!@#$%^&*.]/).length == speclen))
            {
                $('#sletter').removeClass('invalid_img').addClass('valid_img');
            }
            else
            {
                $('#sletter').removeClass('valid_img').addClass('invalid_img');
                checking=false;
            }
            if ((pswd.match(/[A-Z]/)) && (pswd.match(/[A-Z]/).length == upperlen))
            {
                $('#capital').removeClass('invalid_img').addClass('valid_img');
            }
            else
            {
                $('#capital').removeClass('valid_img').addClass('invalid_img');
                checking=false;
            }
            if ((pswd.match(/[a-z]/)) && (pswd.match(/[a-z]/).length == lowerlen))
            {
                $('#small').removeClass('invalid_img').addClass('valid_img');
            }
            else
            {
                $('#small').removeClass('valid_img').addClass('invalid_img');
                checking=false;
            }
            if ((pswd.match(/\d/)) && (pswd.match(/\d/).length == numlen))
            {
                $('#number_v').removeClass('invalid_img').addClass('valid_img');
            }
            else
            {
                $('#number_v').removeClass('valid_img').addClass('invalid_img');
                checking=false;
            }
            if (x.length >= passlen && (pswd.match(/[!@#$%^&*.]/)) && (pswd.match(/[!@#$%^&*.]/).length == speclen) &&
                 (pswd.match(/[A-Z]/)) && (pswd.match(/[A-Z]/).length == upperlen) && (pswd.match(/[a-z]/)) && (pswd.match(/[a-z]/).length == lowerlen) &&
                (pswd.match(/\d/)) && (pswd.match(/\d/).length == numlen) && checking=="") {
                $('#pswd_info').hide();
            }else{
                $('#pswd_info').show();
            }
        });
    }

    function confirmpassword_Validation()
    {
        var pass = $('#new_password').val();
        var confPass = $('#confirm_password').val();
        var m = pass.length;
        var n = confPass.length;
        if(pass != confPass){
            //alert("Password is equel.");
            $("#confirmerror").html("Incorrect Password");
        }
        else{
            $("#confirmerror").html("");
            //alert("Password is not equel.");

        }
        if(confPass == 0)
        {
            $("#pCheckPassword").html("");
        }
    }
</script>

<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>