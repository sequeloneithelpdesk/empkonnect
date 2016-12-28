<?php

include ('../db_conn.php');
include ('../configdata.php');

?>
<!--  HR and Admin Policies  -->
<div class="pass-form-container">
    <center> <img src="../../assets/admin/layout2/img/logo.png" alt=""> </center>
    <h3 class="upc login-head fw-100 center">Reset Password</h3>
    <span style="color:#FF0000;" id="show_error"></span>

    <form class="col s12 p-0 login-form">
        <div class="row">
            <div class="error" style="display: none;"> <p> Incorrect Value......</p></div>


            <div class="input-field col s12 p-0">
                <input id="loginId" type="text">
                <label for="loginId">Login ID<span style="color:#FF0000">*</span><span style="color:#FF0000" id="idrequire"></label>
            </div>
            <div>
                <button type="button" id="continue_button1" onclick="show_question_div('status_val')" class="cust-btn mb-10 upc red-bg col s12 pt-10 pb-10 waves-effect waves-light fs-16 white-txt center-align">Continue</button>
            </div>
            <input type="hidden" id="hidden_ajax_value">
                    <div id="Reset_Password_ques" style="display: none">
                        <?php
                        $i = 1;
                        $sqlq1="select * from PasswordPolicy";
                        $resultq1=query($query,$sqlq1,$pa,$opt,$ms_db);
                        if($num($resultq1)) {

                        while ($rowq1 = $fetch($resultq1)) {

                            $ques = $rowq1['password_reset_ques'];
                            $no_of_ques = explode(",", $ques);
                            $date_var = Array("DOB","DOJ");

                            for ($i = 0; $i < count($no_of_ques); $i++)
                            {
                        if(in_array($no_of_ques[$i],$date_var))
                        {
                        ?>
                                <div class="input-field col s12 p-0 ">
                                    <input type="date" class="datepicker" id="<?php echo $no_of_ques[$i]; ?>" name="ques_name">
                                    <label><?php echo $no_of_ques[$i]; ?><span style="color:#FF0000;" id="<?php echo $no_of_ques[$i]; ?>error"></span></label>
                                </div>
                            <?php
            }
            else
            {
                ?>
                <div class="input-field col s12 p-0 ">
                    <input type="text" id="<?php echo $no_of_ques[$i]; ?>" name="ques_name">
                    <label><?php echo $no_of_ques[$i]; ?><span style="color:#FF0000;" id="<?php echo $no_of_ques[$i]; ?>error"></span></label>
                </div>
                <?php
            }

                            }
                        }
                            }



                        ?>





                        <div>
                            <button type="button" id="continue_button2"  onclick="question_validation('question')" class="cust-btn mb-10 upc red-bg col s12 pt-10 pb-10 waves-effect waves-light fs-16 white-txt center-align">Continue</button>
                        </div>
                        <input type="hidden" id="hidden_ajax_value2">

                    </div>
                    <div id="Ask_For_OTP" style="display: none">
                        <label>OTP Code send on your Mobile Number </label>
                        <div class="input-field col s12 p-0 dt-picker">
                            <input type="text" id="entered_otp">
                            <label for="date">Enter 4-digit OTP Code</label>
                        </div>
                        <div>
                            <button type="button" id="continue_button3" onclick="otp_validation('votp')" class="cust-btn mb-10 upc red-bg col s12 pt-10 pb-10 waves-effect waves-light fs-16 white-txt center-align">Continue</button>
                        </div>
                        <input type="hidden" id="hidden_ajax_value3">
                    </div>
            <div id="pswd_info">
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
                        <div id="Password_Reset_DIV" style="display: none">
                            <div class="input-field col s12 p-0">
                                <input id="new_password" type="password" class="validate" onKeyUp="password_Validation();">
                                <label for="new_password">New Password</label>
                            </div>
                            <div class="input-field col s12 p-0">
                                <input id="confirm_password" type="password" class="validate" onblur="confirmpassword_Validation();">
                                <label for="confirm_password">Confirm Password</label><span style="color:#FF0000;" id="confirmerror"></span></label>
                            </div>
                            <div class="input-field col s12 p-0 login-btn">
                                <button type="button" id="forgot-att" onclick="reset_Password('reset')" class="cust-btn mb-10 upc red-bg col s12 pt-10 pb-10 waves-effect waves-light fs-16 white-txt center-align">Reset Password</button>
                            </div>
                        </div>











            <div class="col s12 center p-0">
                <a class="for-login" href="">Return to Login</a>
            </div>
            <div class="col s12 center">
                <img src="../../assets/admin/layout2/img/sql.png" alt="logo" class="logo-default">
            </div>
        </div>
    </form>
</div>
<script src="js/login.js"></script>


            <!-- END PORTLET-->
</div>



