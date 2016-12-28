<?php 
//session_start();
include ('../db_conn.php');
include ('../configdata.php');


//echo $_GET[$usercode];
if(!isset($_GET) || $_GET['token']=="" ){
   // echo 'index page';

   echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
    
}
else{
$code=$_GET['token'];
$code=base64_decode($code);
$encpcode=md5($code);
	$sqlqq="select * from users where userID='$encpcode'";
                $resultqq=query($query,$sqlqq,$pa,$opt,$ms_db);
				//echo $num($resultqq);
              if($num($resultqq) >=1){
                $rowqq = $fetch($resultqq);
                $active=$rowqq['UserOptions'];
                if($active==0){
                    //echo 'home page';
                   echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
                    }


}
}
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
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
    <title>Empkonnect</title>
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
    <link href="../css/toastr.css"  rel="stylesheet" type="text/css"/>
</head>
<body>
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
                        <p><center><h5>Leave & Attendance System</h5></center></p>
                        <p class="fw-300 center"></p>

<div id="pswd_info">
<p>Please Reset password. </p>
                <?php
                $i = 1;
                $sqlq="select * from PasswordPolicy";
                $resultq=query($query,$sqlq,$pa,$opt,$ms_db);
                if($num($resultq)) {

                    while ($rowq = $fetch($resultq)) {
                        ?>

                        <ul style="list-style: none;">
                        <?php if($rowq['password_length'] != 0){?>
                            <li id="pass_length" class="invalid" value="<?php echo $rowq['password_length']; ?>"> Be at least <strong><?php echo $rowq['password_length']; ?> Character</strong>
                            <!--<li id="alphabet_char" class="invalid" value="<?php /*echo $rowq['num_alphabets']; */?>">At least <strong><?php /*echo $rowq['num_alphabets']; */?>  Alphabet</strong>--><?php }?>
                            <?php if($rowq['num_uppercase_char'] != 0){?>
                            <li id="capital" class="invalid" value="<?php echo $rowq['num_uppercase_char']; ?>">At least <strong><?php echo $rowq['num_uppercase_char']; ?> Capital Character</strong>
                            <?php } ?>
                            <?php if($rowq['num_lowercase_char'] != 0){?>
                            <li id="small" class="invalid" value="<?php echo $rowq['num_lowercase_char']; ?>">At least <strong><?php echo $rowq['num_lowercase_char']; ?> Small Character</strong>
                            <?php } ?>
                            <?php if($rowq['num_numbers'] != 0){?>
                            <li id="number_v" class="invalid" value="<?php echo $rowq['num_numbers']; ?>"> At least <strong><?php echo $rowq['num_numbers']; ?> Number</strong>
                            <?php } ?>
                            <?php if($rowq['num_special_char'] >=1){?>

                            <li id="sletter" class="invalid" value="<?php echo $rowq['num_special_char']; ?>">At least <strong><?php echo $rowq['num_special_char']; ?> Special Character</strong>
                            <?php } ?>
                        </ul>
                        <?php
                    }
                }
                ?>

            </div>
                        <div id="Password_Reset_DIV">
                            <div class="input-field col s12 p-0">
                                <input id="new_password" type="password" class="validate" onKeyUp="password_Validation();">
                                <label for="new_password">New Password</label>
                            </div>
                            <div class="input-field col s12 p-0">
                                <input id="confirm_password" type="password" class="validate" onblur="confirmpassword_Validation();">
                                <label for="confirm_password">Confirm Password</label><span style="color:#FF0000;" id="confirmerror"></span></label>
                            </div>
                            <div class="input-field col s12 p-0 login-btn">
                                <button type="button" id="forgot-att" onclick="reset_Password('reset','<?php echo $code; ?>')" class="cust-btn mb-10 upc dark-blue-bg col s12 pt-10 pb-10 waves-effect waves-light fs-16 white-txt center-align">Reset Password</button>
                            </div>
                        </div>


            <div class="col s12 center p-0">
                <a class="for-login" href="">Return to Login</a>
            </div>
            <div class="col s12 center">
                <img src="../../assets/admin/layout2/img/sql.png" alt="logo" class="logo-default">
            </div>
             </div>
                </div>

            </div>

        </div>

    </div>
</div>
</div>
<script src="../../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="../../assets/global/scripts/materialize.js" type="text/javascript"></script>
<script src="../../assets/global/scripts/init.js" type="text/javascript"></script>
<script src="../js/toastr.js"></script>
<script src="../js/common.js"></script>

            <script type="text/javascript">
            var checking="";
            function reset_Password(r,user)
 {
     var id_user = user;
     var newpass = $("#new_password").val();
     var confpass = $("#confirm_password").val();
     if(checking1 == false || checking2 == false || checking3 == false || checking4 == false || checking5 == false){
        alert('Password Policy not fulfilled');
     }     else{
        if(id_user != "" && confpass !="" && newpass !="" ){

        if(newpass==confpass){

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
     else{
            $("#confirmerror").html("Incorrect Password");
     }

     }
     }
     


 }
                
 function password_Validation()
    {

        $('#pswd_info').show();

        $('#new_password').keyup(function () {

            var pswd = $(this).val();
            var passlen = ($('#pass_length').length == 0)?'0':$('#pass_length').val();
            var alphalen = ($('#alphabet_char').length == 0)?'0':$('#alphabet_char').val();
            var upperlen = ($('#capital').length == 0)?'0':$('#capital').val();
            var lowerlen = ($('#small').length == 0)?'0':$('#small').val();
            var numlen = ($('#number_v').length == 0)?'0':$('#number_v').val();
            var speclen = ($('#sletter').length == 0)?'0':$('#sletter').val();
 //alert(speclen+'-'+passlen+'-'+numlen );
            var x;
            
            if (pswd.length < passlen)
            {
                $('#pass_length').removeClass('valid_img').addClass('invalid_img');
                checking1=false;
//alert("l1");
            }
            else
            {
                $('#pass_length').removeClass('invalid_img').addClass('valid_img');
                x = $('#new_password').val();
				checking1=true;
//alert("l1");
            }
			if(speclen =='0' ||speclen == ''){
				checking2=true;
//alert("spl1");
			}
			else{
				  if ((pswd.match(/[!@#$%^&*.]/)) && (pswd.match(/[!@#$%^&*.]/).length == speclen))
            {
                $('#sletter').removeClass('invalid_img').addClass('valid_img');
				checking2=true;
//alert("spl2");
            }
            else
            {
                $('#sletter').removeClass('valid_img').addClass('invalid_img');
                checking2=false;
//alert("spl3");
            }
			}
            if(upperlen == 0){
				checking3=true;
////alert("ul1");
			}
			else{
				if ((pswd.match(/[A-Z]/)) && (pswd.match(/[A-Z]/).length == upperlen))
            {
                $('#capital').removeClass('invalid_img').addClass('valid_img');
				checking3=true;
//alert("ul2");
            }
            else
            {
                $('#capital').removeClass('valid_img').addClass('invalid_img');
                checking3=false;
//alert("ul3");
            }
			}
            if(lowerlen ==0){
				checking4=true;
			}
			else{
				if ((pswd.match(/[a-z]/)) && (pswd.match(/[a-z]/).length == lowerlen))
            {
                $('#small').removeClass('invalid_img').addClass('valid_img');
				checking4=true;
            }
            else
            {
                $('#small').removeClass('valid_img').addClass('invalid_img');
                checking4=false;
            }
			}
            if(numlen == 0){
				checking5=true;
			}else{
				if ((pswd.match(/\d/)) && (pswd.match(/\d/).length == numlen))
            {
                $('#number_v').removeClass('invalid_img').addClass('valid_img');
				checking5=true;
            }
            else
            {
                $('#number_v').removeClass('valid_img').addClass('invalid_img');
                checking5=false;
            }
			}
            var checking="";
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


</body>
</html>


