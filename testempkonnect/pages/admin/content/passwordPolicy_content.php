<!--  HR and Admin Policies  -->
<div class="row">
    <div class="col-md-12">
        <div class="success" style="display: none;"><p> Successfully Inserted......</p></div>
        <div class="error" style="display: none;"> <p> Error in insertion.....</p></div>
        <!-- BEGIN PORTLET-->
        <div class="portlet box blue-steel">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>Login Policy
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
                         <table class="table table-striped table-bordered table-hover" id="sample_editable_1">
                                <thead>
                                <tr>
                                    <th>
                                        S.No.
                                    </th>
                                    <th>
                                        Login With
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $i = 1;
                                $sqlqu="select * from Company_login_mst";
                                $resultqu=query($query,$sqlqu,$pa,$opt,$ms_db);
                                $no=$num($resultqu);
                                if($num($resultqu)) {

                                while ($rowq = $fetch($resultqu)) {
                                ?>
                                <tr>
                                    <td><?php echo $i;?></td>
                                    <td><?php echo $rowq['login_base'];?></td>
                                    <td align="center"><button type="button" class="btn btn-block blue" id="status_update_btn<?php echo $rowq['Id']?>" value="<?php echo $rowq['status']; ?>" onclick="update_status_login(this.value,'<?php echo $rowq['Id']; ?>')"><?php echo $rowq['status']; ?></button>
                                        </td>
                                </tr>

                                <?php
                                    $i++;
                                }
                                }

                                ?>







                                </tbody>
                            </table>



                    </div>

                </form>

                <!-- END FORM-->
            </div>
        </div>
        <!-- END PORTLET-->
    </div>
</div>



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
                    <?php
                    $sqlq="select * from PasswordPolicy";
                    $resultq=query($query,$sqlq,$pa,$opt,$ms_db);
                    if($num($resultq)) {

                        while ($rowq = $fetch($resultq)) {
                            ?>
                            <button type="button" class="btn green" id="edit_policy" onclick="update_policy()">Edit Policy</button>
                        <?php }
                    }
                    ?>
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
                                                    <input type="radio" name="alpha" id="alpha_not" value="0"/>
                                                </td>
                                                <td>
                                                    <input type="radio" name="alpha" id="alpha_must" value="1" checked="checked"/>
                                                </td>
                                                <td>
											        <input type="number" id="alphabet" name="alphabet" class="text_class" min="1" value="1"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Uppercase Letter
                                                </td>
                                                <td>
                                                    <input type="radio" name="uppercase" id="upper_not" value="0"/>
                                                </td>
                                                <td>
                                                    <input type="radio" name="uppercase" id="upper_must" value="1" checked="checked"/>
                                                </td>
                                                <td>
                                                    <input type="number" id="uppercaseletter" name="uppercaseletter" class="text_class" min="1" value="1"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Lowercase Letter
                                                </td>
                                                <td>
                                                    <input type="radio" name="lowercase" id="lower_not" value="0"/>
                                                </td>
                                                <td>
                                                    <input type="radio" name="lowercase" id="lower_must" value="1" checked="checked"/>
                                                </td>
                                                <td>
                                                    <input type="number" id="lowercaseletter" name="lowercaseletter" class="text_class" min="1" value="1"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Number
                                                </td>
                                                <td>
                                                    <input type="radio" name="numb" value="0"/>
                                                </td>
                                                <td>
                                                    <input type="radio" name="numb"  value="1" checked="checked"/>
                                                </td>
                                                <td>
                                                    <input type="number" id="number" name="no_number" min="1" value="1"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Special Character
                                                </td>
                                                <td>
                                                    <input type="radio" name="spec" value="0"/>
                                                </td>
                                                <td>
                                                    <input type="radio" name="spec" value="1" checked="checked"/>
                                                </td>
                                                <td>
                                                    <input type="number" id="special" name="special"  min="1" value="1"/>
                                                </td>
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
                                    <button type="button" class="btn green-meadow" id="change_password">Inactive</button>
                                    <input type="hidden" id="change_password_days_status" value="1">

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
                                <button type="button" class="btn green-meadow" id="earlier_password">Inactive</button>
                                <input type="hidden" id="earlier_password_use_status" value="1">

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
                                <button type="button" class="btn green-meadow" id="userid_sensitive">Inactive</button>
                                <input type="hidden" id="userid_sensitive_status" value="1">
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
                                            <input type="text" id="invalidAttempts" name="invalidAttempts"> Invalid Attempt(s) within <input type="text" id="invalidTime" name="invalidTime"> Minute(s)</span>
                                        </div>
                                    </div>


                                    <div class="col-md-2">
                                        <button type="button" class="btn green-meadow" id="locked_userid">Inactive</button>
                                        <input type="hidden" id="locked_userid_status" value="1">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-3">
                                        <span style="font-size:14px;" class="label-control"> UserId Auto Unlock After </span><br>
                                    </div>
                                    <div id="auto_unlock_userid_after_time">
                                        <div class="col-md-7" id="hide_auto_unlock_userid_after_time">
                                            <span style="font-size:14px;" class="label-control">
                                            <input type="text" id="autounlock" name="autounlock"> Minute(s)
                                                </div>
                                    </div>


                                    <div class="col-md-2">
                                        <button type="button" class="btn green-meadow" id="userid_unlock">Inactive</button>
                                        <input type="hidden" id="userid_unlock_status" value="1">
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
                                            <option value="oEMailId">Official Email ID</option>
                                            <option value="pEMailId">Personal Email ID</option>
                                        </select>
                                        </div>
                                    </div>


                                    <div class="col-md-2">
                                        <button type="button" class="btn green-meadow" id="password_reset_link_button">Inactive</button>
                                        <input type="hidden" id="password_reset_link_status" value="1">
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
                                                    <span class="hida">Select Reset Question</span>
                                                    <input type="hidden" id="others" value="">
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
                                        <button type="button" class="btn green-meadow" id="password_reset_question_button">Inactive</button>
                                        <input type="hidden" id="password_reset_question_status" value="1">
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
                                        <button type="button" class="btn green-meadow" id="hid" onclick="function changeButtonValue();">Inactive</button>
                                        <input type="hidden" id="ask_for_otp_status" value="1">

                                    </div>
                                </div>



                            </div>
                            <div class="clearfix"></div><br>
                            </div>

                        

                        <div class="form-group">
                            <div class="row">
                                <div class=" col-md-offset-1 col-md-4 ">
                                    <button type="button" class="btn btn-block blue" id="submitpasspolicy" ><i class="fa fa-check"></i> Submit</button>

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





