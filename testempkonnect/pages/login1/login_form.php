
	<div class="login-form-container">
		<h3 class="upc login-head fw-100 center">HRMS ADMIN Login</h3>
		<p class="fw-300 center">Contrary to popular belief, Lorem Ipsum is </p>
		<form class="col s12 p-0 login-form">
			<div class="row">
				
				<div class="input-field col s12 p-0">
					<input id="company_code" type="text" class="validate">
					<label for="company_code">Company Code</label>
				</div>
				
				<div class="input-field col s12 p-0">
					<input id="username" type="text" class="validate">
					<label for="username">Username</label>
				</div>
				<div class="input-field col s12 p-0">
					<input id="password" type="password" class="validate">
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
					<button type="button" id="sub-att" class="cust-btn mb-10 upc dark-blue-bg col s12 pt-10 pb-10 waves-effect waves-light fs-16 white-txt center-align">Login</button>
					<div class="col s6 p-0">
						<input type="checkbox" id="test5" /> <label style="top:0;font-weight:normal;line-height: 18px;" for="test5">Remember me</label>
					</div>
					<div class="col s6 p-0" style="text-align: right;">
						<a class="for-pass"  href="">Forgot Passord <span>?</span></a>
					</div>
				</div>
				<div class="col s12 center">
					<img src="../../assets/admin/layout2/img/sql.png" alt="logo" class="logo-default">
				</div>
			</div>
		</form>
	</div>

<!-- fogot password -->

	<div class="pass-form-container">
		<h3 class="upc login-head fw-100 center">Reset Password</h3>
		<p class="fw-300 center">Contrary to popular belief, Lorem Ipsum is </p>
		<form class="col s12 p-0 login-form">
			<div class="row">
				
				<div class="input-field col s12 p-0">
					<input id="usermail" type="email" class="validate">
					<label for="email">Email id</label>
				</div>
				
				<div class="input-field col s12 p-0 dt-picker">
					<input type="date" class="datepicker">
					<label for="date">Birthday</label>
				</div>
				<div class="input-field col s12 p-0">
					<input id="password" type="password" class="validate">
					<label for="password">Password</label>
				</div>
				<div class="input-field col s12 p-0">
					<input id="password" type="password" class="validate">
					<label for="password">Confirm Password</label>
				</div>
				
				<div class="input-field col s12 p-0 login-btn">
					
					<button type="button" id="forgot-att" class="cust-btn mb-10 upc dark-blue-bg col s12 pt-10 pb-10 waves-effect waves-light fs-16 white-txt center-align">Reset Password</button>
					
					<div class="col s12 center p-0">
						<a class="for-login" href="">Return to Login</a>
					</div>
				</div>
				<div class="col s12 center">
					<img src="../../assets/admin/layout2/img/sql.png" alt="logo" class="logo-default">
				</div>
			</div>
		</form>
	</div>

<!-- forgot password ends -->

	<div class="otp-form-container">
		<h3 class="upc login-head fw-100 center">Enter OTP</h3>
		<p class="fw-300 center">You Have recived OTP on Mobile</p>
		<form class="col s12 p-0 login-form">
			<div class="row">
				
				<div class="input-field col s12 p-0">
					<input id="otp" type="text" class="validate">
					<label for="otp">OTP</label>
				</div>
				
				
				
				
				
				<div class="input-field col s12 p-0 login-btn">
					
					<button type="button" id="forgot-att" class="cust-btn mb-10 upc dark-blue-bg col s12 pt-10 pb-10 waves-effect waves-light fs-16 white-txt center-align">Submit</button>
					
					<div class="col s12 center p-0">
						<a class="for-login" href="">Return to Login</a>
					</div>
				</div>
				<div class="col s12 center">
					<img src="../../assets/admin/layout2/img/sql.png" alt="logo" class="logo-default">
				</div>
			</div>
		</form>
	</div>
