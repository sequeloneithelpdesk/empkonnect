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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
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
                            <a href="passwordPolicy.php">Password and Policies</a>
                            <i class="fa fa-angle-right"></i>
                        </li>
                        <li>
                            <a href="#">Edit Password Policy</a>
                        </li>
                    </ul>

                </div>
                <!-- END PAGE HEADER-->
                <!-- BEGIN PAGE CONTENT-->
                <?php

                $sqlq="select * from PasswordPolicy";
                $resultq=query($query,$sqlq,$pa,$opt,$ms_db);
                if($num($resultq)) {

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


                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="success" style="display: none;"><p> Successfully Inserted......</p></div>
                                <div class="error" style="display: none;"> <p> Error in insertion.....</p></div>
                                <!-- BEGIN PORTLET-->
                                <div class="portlet box blue-steel">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-gift"></i>Password Policies
                                        </div>
                                        <div class="tools">

                                            <a href="javascript:;" class="collapse">
                                            </a>

                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <!-- BEGIN FORM-->

                                        <form class="form-horizontal" enctype="multipart/form-data" id="form2" name="passform">
                                            <div class="form-body">
                                                <div class="form-group">

                                                    <div class="col-md-6">
                                                        <span style="font-size:16px;" class="label-control"> Password length should be between  </span><br>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div id="slider-range-max" class="slider bg-purple">
                                                        </div>

                                                        <div class="slider-value">
                                                            Minimum Value: <span id="slider-range-max-amount">
													</span>

                                                        </div>
                                                    </div>

                                                    <!--table start-->
                                                    <div class="col-md-12">
                                                        <div class="portlet box red">
                                                            <div class="portlet-title">
                                                                <div class="caption">
                                                                    <i class="fa fa-cogs"></i>Password Character Combination
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
                                                                <div class="table-scrollable">
                                                                    <table class="table table-hover">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>

                                                                            </th>
                                                                            <th>
                                                                                Can not have
                                                                            </th>
                                                                            <th>
                                                                                Must Have
                                                                            </th>
                                                                            <th>
                                                                                Minimum Number Of Character
                                                                            </th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        <tr>
                                                                            <td>
                                                                                Alphabet
                                                                            </td>
                                                                            <td>
                                                                                <input type="radio" name="alpha" id="alpha_not" value="0"  <?php echo ($rowq['alphabet_radio']=='0')?'checked':'' ?>/>
                                                                            </td>
                                                                            <td>
                                                                                <input type="radio" name="alpha" id="alpha_must" value="1"  <?php echo ($rowq['alphabet_radio']=='1')?'checked':'' ?>/>
                                                                            </td>
                                                                            <?php if( $rowq['num_alphabets'] == 0){?>
                                                                                <td>
                                                                                <input type="number" id="alphabet" name="alphabet" class="text_class" min="1" value="<?php echo $rowq['num_alphabets'];?>" disabled/>
                                                                                </td>
                                                                            <?php }
                                                                            else {
                                                                                ?>
                                                                                <td>
                                                                                    <input type="number" id="alphabet" name="alphabet" class="text_class" min="1" value="<?php echo $rowq['num_alphabets'];?>"/>
                                                                                </td>
                                                                            <?php } ?>

                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                Uppercase Letter
                                                                            </td>
                                                                            <td>
                                                                                <input type="radio" name="uppercase" id="upper_not" value="0" <?php echo ($rowq['uppercase_radio']=='0')?'checked':'' ?>/>
                                                                            </td>
                                                                            <td>
                                                                                <input type="radio" name="uppercase" id="upper_must" value="1" <?php echo ($rowq['uppercase_radio']=='1')?'checked':'' ?>/>
                                                                            </td>
                                                                            <?php if( $rowq['num_uppercase_char'] == 0){?>
                                                                                <td>
                                                                                    <input type="number" id="uppercaseletter" name="uppercaseletter" class="text_class" min="1" value="<?php echo $rowq['num_uppercase_char'];?>" disabled/>

                                                                                </td>
                                                                            <?php }
                                                                            else {
                                                                                ?>
                                                                                <td>
                                                                                    <input type="number" id="uppercaseletter" name="uppercaseletter" class="text_class" min="1" value="<?php echo $rowq['num_uppercase_char'];?>"/>

                                                                                </td>
                                                                            <?php } ?>

                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                Lowercase Letter
                                                                            </td>
                                                                            <td>
                                                                                <input type="radio" name="lowercase" id="lower_not" value="0" <?php echo ($rowq['lowercase_radio']=='0')?'checked':'' ?>/>
                                                                            </td>
                                                                            <td>
                                                                                <input type="radio" name="lowercase" id="lower_must" value="1" <?php echo ($rowq['lowercase_radio']=='1')?'checked':'' ?>/>
                                                                            </td>
                                                                            <?php if( $rowq['num_lowercase_char'] == 0){?>
                                                                                <td>
                                                                                    <input type="number" id="lowercaseletter" name="lowercaseletter" class="text_class" min="1" value="<?php echo $rowq['num_lowercase_char'];?>" disabled/>


                                                                                </td>
                                                                            <?php }
                                                                            else {
                                                                                ?>
                                                                                <td>
                                                                                    <input type="number" id="lowercaseletter" name="lowercaseletter" class="text_class" min="1" value="<?php echo $rowq['num_lowercase_char'];?>"/>


                                                                                </td>
                                                                            <?php } ?>

                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                Number
                                                                            </td>
                                                                            <td>
                                                                                <input type="radio" name="numb" value="0" <?php echo ($rowq['number_radio']=='0')?'checked':'' ?>/>
                                                                            </td>
                                                                            <td>
                                                                                <input type="radio" name="numb"  value="1" <?php echo ($rowq['number_radio']=='1')?'checked':'' ?>/>
                                                                            </td>
                                                                            <?php if( $rowq['num_numbers'] == 0){?>
                                                                                <td>
                                                                                    <input type="number" id="number" name="no_number" min="1" value="<?php echo $rowq['num_numbers'];?>" disabled/>
                                                                                </td>
                                                                            <?php }
                                                                            else {
                                                                                ?>
                                                                                <td>
                                                                                    <input type="number" id="number" name="no_number" min="1" value="<?php echo $rowq['num_numbers'];?>"/>

                                                                                </td>
                                                                            <?php } ?>

                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                Special Character
                                                                            </td>
                                                                            <td>
                                                                                <input type="radio" name="spec" value="0" <?php echo ($rowq['special_radio']=='0')?'checked':'' ?>/>
                                                                            </td>
                                                                            <td>
                                                                                <input type="radio" name="spec" value="1" <?php echo ($rowq['special_radio']=='1')?'checked':'' ?>/>
                                                                            </td>
                                                                            <?php if( $rowq['num_special_char'] == 0){?>
                                                                                <td>
                                                                                    <input type="number" id="special" name="special"  min="1" value="<?php echo $rowq['num_special_char'];?>" disabled/>

                                                                                </td>
                                                                            <?php }
                                                                            else {
                                                                                ?>
                                                                                <td>
                                                                                    <input type="number" id="special" name="special"  min="1" value="<?php echo $rowq['num_special_char'];?>"/>


                                                                                </td>
                                                                            <?php } ?>

                                                                        </tr>

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- END SAMPLE TABLE PORTLET-->

                                                    <div class="clearfix"></div><br>




                                                    <div class="col-md-4">
                                                        <span style="font-size:16px;" class="label-control"> User Must Change Password After(Days) </span><br>
                                                    </div>

                                                         <div id="change_password_after">
                                                                <div class="col-md-6" id="hide_change_password_after">
                                                                    <div id="slider-range-max5" class="slider bg-purple">
                                                                    </div>
                                                                    <div class="slider-value">
                                                                        Value: <span id="slider-range-max-amount5">
                                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>




                                                    <div class="col-md-2">
                                                        <?php if($rowq['change_password_days_status'] == 1){?>
                                                            <button type="button" class="btn green-meadow" id="change_password">Inactive</button>
                                                            <input type="hidden" id="change_password_days_status" value="1">

                                                        <?php } else{?>
                                                            <button type="button" class="btn green-meadow" id="change_password">Active</button>
                                                            <input type="hidden" id="change_password_days_status" value="0">
                                                        <?php  }?>



                                                    </div>



                                                    <div class="clearfix"></div><br>
                                                    <div class="col-md-4">
                                                        <span style="font-size:16px;" class="label-control"> Number Of Earlier Password Can Use </span><br>
                                                    </div>

                                                        <div id="earlier_password_used">
                                                            <div class="col-md-6" id="hide_earlier_password_used">
                                                                <div id="slider-range-max6" class="slider bg-purple">
                                                                </div>
                                                                <div class="slider-value">
                                                                    Minimum Value: <span id="slider-range-max-amount6">
                                                        </span>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    <div class="col-md-2">
                                                        <?php if($rowq['earlier_password_use_status'] == 1){?>
                                                            <button type="button" class="btn green-meadow" id="earlier_password">Inactive</button>
                                                            <input type="hidden" id="earlier_password_use_status" value="1">

                                                        <?php } else{?>
                                                            <button type="button" class="btn green-meadow" id="earlier_password">Active</button>
                                                            <input type="hidden" id="earlier_password_use_status" value="0">
                                                        <?php  }?>



                                                    </div>


                                                    <div class="clearfix"></div><br>
                                                    <div class="col-md-4">
                                                        <span style="font-size:16px;" class="label-control"> Is User ID Case Sensitive </span><br>
                                                    </div>

                                                        <div id="case_sens">
                                                            <div class="col-md-6" id="hide_case_sensitive">
                                                                <label>
                                                                    <input type="checkbox" id="userid_case_sensitive" value="1" checked>
                                                                </label>
                                                            </div>
                                                        </div>


                                                    <div class="col-md-2">
                                                        <?php if($rowq['userid_sensitive_status'] == 1){?>
                                                            <button type="button" class="btn green-meadow" id="userid_sensitive">Inactive</button>
                                                            <input type="hidden" id="userid_sensitive_status" value="1">

                                                        <?php } else{?>
                                                            <button type="button" class="btn green-meadow" id="userid_sensitive">Active</button>
                                                            <input type="hidden" id="userid_sensitive_status" value="0">
                                                        <?php  }?>


                                                    </div>
                                                    <div class="clearfix"></div><br>
                                                    <div class="form-body">
                                                        <h4 class="form-section">Password Invalid Attempts</h4>
                                                        <div class="form-group">
                                                            <div class="col-md-3">
                                                                <span style="font-size:14px;" class="label-control"> Locked UserID After </span><br>
                                                            </div>

                                                                <div id="locked_userid_after_time">
                                                                    <div class="col-md-7" id="hide_locked_userid_after_time">
                                                                        <span style="font-size:14px;" class="label-control">
                                                                        <input type="text" id="invalidAttempts" name="invalidAttempts" value="<?php echo $rowq['locked_userid_attempts']; ?>"> Invalid Attempt(s) within <input type="text" id="invalidTime" name="invalidTime" value="<?php echo $rowq['locked_userid_minutes']; ?>"> Minute(s)</span>
                                                                                                </div>
                                                                </div>






                                                            <div class="col-md-2">
                                                                <?php if($rowq['locked_userid_status'] == 1){?>
                                                                    <button type="button" class="btn green-meadow" id="locked_userid">Inactive</button>
                                                                    <input type="hidden" id="locked_userid_status" value="1">

                                                                <?php } else{?>
                                                                    <button type="button" class="btn green-meadow" id="locked_userid">Active</button>
                                                                    <input type="hidden" id="locked_userid_status" value="0">
                                                                <?php  }?>

                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="col-md-3">
                                                                <span style="font-size:14px;" class="label-control"> UserId Auto Unlock After </span><br>
                                                            </div>

                                                                <div id="auto_unlock_userid_after_time">
                                                                    <div class="col-md-7" id="hide_auto_unlock_userid_after_time">
                                            <span style="font-size:14px;" class="label-control">
                                            <input type="text" id="autounlock" name="autounlock" value="<?php echo $rowq['userid_auto_unlock'];?>"> Minute(s)
                                                                    </div>
                                                                </div>




                                                            <div class="col-md-2">
                                                                <?php if($rowq['userid_unlock_status'] == 1){?>
                                                                    <button type="button" class="btn green-meadow" id="userid_unlock">Inactive</button>
                                                                    <input type="hidden" id="userid_unlock_status" value="1">

                                                                <?php } else{?>
                                                                    <button type="button" class="btn green-meadow" id="userid_unlock">Active</button>
                                                                    <input type="hidden" id="userid_unlock_status" value="0">
                                                                <?php  }?>

                                                            </div>
                                                        </div>


                                                    </div>

                                                    <div class="clearfix"></div><br>
                                                    <div class="form-body">
                                                        <h4 class="form-section">Password Reset Option</h4>

                                                        <div class="form-group">
                                                            <div class="col-md-3">
                                                                <span style="font-size:14px;" class="label-control"> Password Reset Link </span><br>
                                                            </div>
                                                            <div id="password_reset_link_div">
                                                                <div class="col-md-7" id="hide_password_reset_link">
                                            <span style="font-size:14px;" class="label-control">
                                            <select class="form-control input-xlarge " id="password_reset_link">
                                                <option value="oEMailId" <?php if($rowq['password_reset_link']=="oEMailId") echo 'selected="selected"'; ?>>Official Email ID</option>
                                            <option value="pEMailId" <?php if($rowq['password_reset_link']=="pEMailId") echo 'selected="selected"'; ?>>Personal Email ID</option>
                                        </select>
                                                                </div>
                                                            </div>


                                                            <div class="col-md-2">
                                                                <?php if($rowq['password_reset_link_status'] == 1){?>
                                                                    <button type="button" class="btn green-meadow" id="password_reset_link_button">Inactive</button>
                                                                    <input type="hidden" id="password_reset_link_status" value="1">

                                                                <?php } else{?>
                                                                    <button type="button" class="btn green-meadow" id="password_reset_link_button">Active</button>
                                                                    <input type="hidden" id="password_reset_link_status" value="0">
                                                                <?php  }?>

                                                            </div>
                                                        </div>



                                                        <div class="form-group">
                                                            <div class="col-md-3">
                                                                <span style="font-size:14px;" class="label-control"> Password Reset Question </span><br>
                                                            </div>
                                                            <div id="password_reset_question_div">
                                                                <div class="col-md-7" id="hide_password_reset_question">
                                            <span style="font-size:14px;" class="label-control">
                                                <dl class="dropdown">

                                            <dt>
                                                <a href="javascript:void(0)">

                                                    <input type="hidden" id="others" value="">
                                                    <span title="<?php echo $rowq['password_reset_ques'];?>,"><?php echo $rowq['password_reset_ques'];?>,</span>
                                                    <p class="multiSel"></p>
                                                </a>
                                            </dt>

                                            <dd>
                                                <div class="mutliSelect" id="c_b">
                                                    <ul>
                                                        <li>
                                                            <input type="checkbox"  name="check[]" class="messageCheckbox" value="DOJ" />DOJ</li>
                                                        <li>
                                                            <input type="checkbox" name="check[]" class="messageCheckbox" value="PANNo" />Pan No</li>
                                                        <li>
                                                            <input type="checkbox"  name="check[]" class="messageCheckbox" value="DOB" />DOB</li>
                                                         <li>
                                                            <input type="checkbox"  name="check[]" class="messageCheckbox" value="BirthPlace" />Birth Place</li>

                                                    </ul>
                                                </div>
                                            </dd>

                                        </dl>
                                                                </div>
                                                            </div>


                                                            <div class="col-md-2">
                                                                <?php if($rowq['password_reset_ques_status'] == 1){?>
                                                                    <button type="button" class="btn green-meadow" id="password_reset_question_button">Inactive</button>
                                                                    <input type="hidden" id="password_reset_question_status" value="1">
                                                                <?php } else{?>
                                                                    <button type="button" class="btn green-meadow" id="password_reset_question_button">Active</button>
                                                                    <input type="hidden" id="password_reset_question_status" value="0">
                                                                <?php  }?>


                                                            </div>
                                                        </div>


                                                        <div class="clearfix"></div></br></br>

                                                        <div class="form-group">
                                                            <div class="col-md-2">
                                                                <span style="font-size:14px;" class="label-control">Ask for OTP</span><br>
                                                            </div>
                                                            <div id="otp_div">
                                                                <div class="col-md-8" id="hide_otp">
                                            <span style="font-size:14px;" class="label-control">

                                                     <input type="checkbox" id="ask_for_otp" value="otp" checked> OTP



                                                                </div>
                                                            </div>


                                                            <div class="col-md-2">
                                                                <?php if($rowq['ask_for_otp_status'] == 1){?>
                                                                    <button type="button" class="btn green-meadow" id="hid" onclick="function changeButtonValue();">Inactive</button>
                                                                    <input type="hidden" id="ask_for_otp_status" value="1">

                                                                <?php } else{?>
                                                                    <button type="button" class="btn green-meadow" id="hid" onclick="function changeButtonValue();">Active</button>
                                                                    <input type="hidden" id="ask_for_otp_status" value="0">
                                                                <?php  }?>


                                                            </div>
                                                        </div>



                                                    </div>
                                                    <div class="clearfix"></div><br>
                                                </div>



                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class=" col-md-offset-1 col-md-4 ">
                                                            <button type="button" class="btn btn-block blue" id="editpasspolicy" ><i class="fa fa-check"></i> Submit</button>

                                                        </div>
                                                    </div>
                                                </div>


                                            </div>

                                        </form>

                                        <!-- END FORM-->
                                    </div>
                                </div>
                                <!-- END PORTLET-->
                            </div>
                        </div>
                        <?php
                    }}
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

<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

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



        $(".dropdown dt a").on('click', function() {
            $(".dropdown dd ul").slideToggle('fast');
        });

        $(".dropdown dd ul li a").on('click', function() {
            $(".dropdown dd ul").hide();
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
                $('.dropdown dt a').append(ret);

            }
        });


    });

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


</script>




</body>
<!-- END BODY -->
</html>