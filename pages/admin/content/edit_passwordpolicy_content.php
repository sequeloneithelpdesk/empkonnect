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

                                while ($rowq1 = $fetch($resultqu)) {
                                ?>
                                <tr>
                                    <td><?php echo $i;?></td>
                                    <td><?php echo $rowq1['login_base'];?></td>
                                    <td align="center"><button type="button" class="btn btn-block blue" id="status_update_btn<?php echo $rowq1['Id']?>" value="<?php echo $rowq1['status']; ?>" onclick="update_status_login(this.value,'<?php echo $rowq1['Id']; ?>')"><?php echo $rowq1['status']; ?></button>
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
						<dl class="dropdown" id='qus'>
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
                                    <div class="col-md-3">
                                        <span style="font-size:14px;" class="label-control">
                                            User must update default password within day(s)
                                        </span><br>
                                    </div>
                                    <div id="default_password_expiry_div">
                                        <div class="col-md-7" id="hide_default_password_expiry">
                                            <span style="font-size:14px;" class="label-control">
                                              <input type="text" id="default_password" min="0" value="<?php echo $rowq['default_password_expiry'];?>">  </div>
                                    </div>


                                    <div class="col-md-2">
                                       <?php if($rowq['default_password_expiry_status'] == 1){?>
			<button type="button" class="btn green-meadow" id="default_password_expiry_button">Inactive</button>
			<input type="hidden" id="default_password_expiry_status" value="1">
			<?php } else{?>
			<button type="button" class="btn green-meadow" id="default_password_expiry_button">Active</button>
			<input type="hidden" id="default_password_expiry_status" value="0">
			<?php  }?>


			

                                    </div>
                                </div>
                                <div class="clearfix"></div></br></br>

							<div class="form-group">
			<div class="col-md-3">
				<span style="font-size:14px;" class="label-control"> Default Password </span><br>
			</div>
			<div id="default_password_div">
				<div class="col-md-7" id="hide_default_password">
					<span style="font-size:14px;" class="label-control">
						<dl class="dropdown" id='def'>
							<dt>
							<a href="javascript:void(0)">
								<input type="hidden" id="others" value="">
								<span title="<?php echo $rowq['default_password'];?>,"><?php echo $rowq['default_password'];?>,</span>
								<p class="multiSel1"></p>
							</a>
							</dt>
							<dd>
								<div class="mutliSelect1" id="c_b1">
									<ul>

										<li>
										<input type="checkbox"  name="check1[]" class="messageCheckbox" value="Emp_Code" />Employee Code</li>
										<li>
										<input type="checkbox"  name="check1[]" class="messageCheckbox" value="DOJ" />DOJ</li>
										<li>
											<input type="checkbox" name="check1[]" class="messageCheckbox" value="PANNo" />Pan No</li>
											<li>
												<input type="checkbox"  name="check1[]" class="messageCheckbox" value="DOB" />DOB</li>
												<li>
													<input type="checkbox"  name="check1[]" class="messageCheckbox" value="BirthPlace" />Birth Place</li>
									</ul>
								</div>
							</dd>
						</dl>
				</div>
			</div>
								<div class="col-md-2">
									<?php if($rowq['default_password_status'] == 1){?>
									<button type="button" class="btn green-meadow" id="default_password_button">Inactive</button>
									<input type="hidden" id="default_password_status" value="1">
									<?php } else{?>
									<button type="button" class="btn green-meadow" id="default_password_button">Active</button>
									<input type="hidden" id="default_password_status" value="0">
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
										<button type="button" class="btn green-meadow" id="hid" >Inactive</button>
										<input type="hidden" id="ask_for_otp_status" value="1">
										<?php } else{?>
										<button type="button" class="btn green-meadow" id="hid">Active</button>
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

<!-- END PAGE CONTENT -->
</div>
</div>
<!-- END CONTENT -->
<!-- BEGIN QUICK SIDEBAR -->
<!--Cooming Soon...-->
<!-- END QUICK SIDEBAR -->
</div>

</div>
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
<div class="clearfix"></div></br></br>


                                <div class="form-group">
                                    <div class="col-md-3">
                                        <span style="font-size:14px;" class="label-control"> Password Reset Question </span><br>
                                    </div>
                                    <div id="password_reset_question_div">
                                        <div class="col-md-7" id="hide_password_reset_question">
                                            <span style="font-size:14px;" class="label-control">
                                                <dl class="dropdown" id='qus'>

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
                                    <div class="col-md-3">
                                        <span style="font-size:14px;" class="label-control">
                                            User must update default password within day(s)
                                        </span><br>
                                    </div>
                                    <div id="default_password_expiry_div">
                                        <div class="col-md-7" id="hide_default_password_expiry">
                                            <span style="font-size:14px;" class="label-control">
                                              <input type="number" id="default_password" min="0"> 
                                        </div>
                                    </div>


                                    <div class="col-md-2">
                                        <button type="button" class="btn green-meadow" id="default_password_expiry_button">Inactive</button>
                                        <input type="hidden" id="default_password_expiry_status" value="1">

                                    </div>
                                </div>
                                <div class="clearfix"></div></br></br>

                                <div class="form-group">
                                    <div class="col-md-3">
                                        <span style="font-size:14px;" class="label-control"> Default Password </span><br>
                                    </div>
                                <div id="default_password_div">
                                    <div class="col-md-7" id="hide_default_password">
                                            <span style="font-size:14px;" class="label-control">
                                        <dl class="dropdown" id='def'>

                                            <dt>
                                                <a href="javascript:void(0)">
                                                    <span class="hida1">Select Options</span>
                                                    <input type="hidden" id="others" value="">
                                                    <p class="multiSel1"></p>
                                                </a>
                                            </dt>

                                            <dd>
                                                <div class="mutliSelect1" id="c_b1">
                                                    <ul>
                                                        <li>
                                                            <input type="checkbox"  name="check1[]" class="messageCheckbox" value="Emp_Code" />Employee Code</li>
                                                        <li>
                                                        <li>
                                                            <input type="checkbox"  name="check1[]" class="messageCheckbox" value="DOJ" />DOJ</li>
                                                        <li>
                                                            <input type="checkbox" name="check1[]" class="messageCheckbox" value="PANNo" />Pan No</li>
                                                        <li>
                                                            <input type="checkbox"  name="check1[]" class="messageCheckbox" value="DOB" />DOB</li>
                                                         <li>
                                                            <input type="checkbox"  name="check1[]" class="messageCheckbox" value="BirthPlace" />Birth Place</li>

                                                    </ul>
                                                </div>
                                            </dd>

                                        </dl>
                                    </div>
                                </div>


                                    <div class="col-md-2">
                                        <button type="button" class="btn green-meadow" id="default_password_button">Inactive</button>
                                        <input type="hidden" id="default_password_status" value="1">
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
                                        <button type="button" class="btn green-meadow" id="hid">Inactive</button>
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
                       <?php }
                    }
                    ?>







