<?php
@session_start();
include ('../db_conn.php');

//header('Cache-control: private');
$username=$_SESSION['usercode'];
$usertype=$_SESSION['usertype'];
$doc_root= $_SERVER['DOCUMENT_ROOT'];


?>
<div class="page-header navbar navbar-fixed-top">
			<!-- BEGIN HEADER INNER -->
			<div class="page-header-inner ">
				<!-- BEGIN LOGO -->
				<div class="page-logo cus-dark-grey bd-le bd-ri" >
					<a href="index.html" >
						<img src="../../assets/admin/layout2/img/logo.png" alt="logo" class="logo-default"/>
					</a>
					
				</div>
				<!-- END LOGO -->
				<!-- BEGIN RESPONSIVE MENU TOGGLER -->
				<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
				</a>
				<!-- END RESPONSIVE MENU TOGGLER -->
				<!-- BEGIN PAGE ACTIONS -->
				<!-- DOC: Remove "hide" class to enable the page header actions -->
				<div class="menu-toggler sidebar-toggler flt-left m-0 bd-ri bd-le header-margin  white-txt fs-16">
					<!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
				</div>
				<div class="page-actions bd-ri bd-le header-margin  white-txt fs-16">
					
					
					
					<i class="fa fa-support"></i>&nbsp;<span class="hidden-sm hidden-xs">Help Desk</span>
					
				</div>
				<div class="page-actions bd-le header-margin fs-16">
				<?php  if($usertype=="user"){  ?>
                 <select id="roleids" class="bs-select" onchange="changerole(this.value)">
                     <?php
					 $roleA = $_SESSION['Allrole'];
					 $htmlB = '';
					 $htmlT = '';

					 foreach($roleA  as $id => $RolA) {
						 $sel = '';
						 if($id ==  $_SESSION['selectedRole']){
							 $sel = 'selected';
						 }
						 if($RolA['initial'] == 1) {
							 $htmlT = '<option value="' . $id . '" '. $sel .'>' . $RolA['name'] . '</option>';
						 }else{
							 $htmlB .= '<option value="' . $id . '" '. $sel .'>' . $RolA['name'] . '</option>';
						 }
                     }
					 echo $htmlT.$htmlB;
                        ?>
				 </select>
					<?php }
				else { echo "<span class='white-txt'>Admin</span>"; } ?>
				</div>
				<div class="page-actions bd-le header-margin  white-txt fs-16">
					
					
					
					<span class="hidden-sm hidden-xs"><span style="background-color:#fff;color:#000;border-radius: 40px!important;padding: 0 6px;font-size: 12px;margin: 0 6px 0 0;">?</span>Help</span>
					
				</div>
				<!-- END PAGE ACTIONS -->
				<!-- BEGIN PAGE TOP -->
				<div class="page-top cus-dark-grey">
					<!-- BEGIN HEADER SEARCH BOX -->
					<!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
					<!-- END HEADER SEARCH BOX -->
					<!-- BEGIN TOP NAVIGATION MENU -->
					<div class="top-menu">
						<ul class="nav navbar-nav pull-right">
							<!-- BEGIN NOTIFICATION DROPDOWN -->
							<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
							<li class="bd-ri   fs-16 "><a href="" class="round-btn waves-effect waves-light mt-15 mr-15 blue-bg white-txt">Mark out</a></li>
							<li class="bd-ri bd-le header-margin  white-txt fs-16">Mark in time <span><b>9:00 AM</b></span></li>
							
							<li class="dropdown dropdown-extended dropdown-notification bd-ri bd-le" id="header_notification_bar">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
									<i class="icon-bell"></i>
									<span class="badge badge-default">
									7 </span>
								</a>
								<ul class="dropdown-menu">
									<li class="external">
										<h3><span class="bold">12 pending</span> notifications</h3>
										<a href="extra_profile.html">view all</a>
									</li>
									<li>
										<ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
											<li>
												<a href="javascript:;">
													<span class="time">just now</span>
													<span class="details">
														<span class="label label-sm label-icon label-success">
															<i class="fa fa-plus"></i>
														</span>
													New user registered. </span>
												</a>
											</li>
											<li>
												<a href="javascript:;">
													<span class="time">3 mins</span>
													<span class="details">
														<span class="label label-sm label-icon label-danger">
															<i class="fa fa-bolt"></i>
														</span>
													Server #12 overloaded. </span>
												</a>
											</li>
											<li>
												<a href="javascript:;">
													<span class="time">10 mins</span>
													<span class="details">
														<span class="label label-sm label-icon label-warning">
															<i class="fa fa-bell-o"></i>
														</span>
													Server #2 not responding. </span>
												</a>
											</li>
											<li>
												<a href="javascript:;">
													<span class="time">14 hrs</span>
													<span class="details">
														<span class="label label-sm label-icon label-info">
															<i class="fa fa-bullhorn"></i>
														</span>
													Application error. </span>
												</a>
											</li>
											<li>
												<a href="javascript:;">
													<span class="time">2 days</span>
													<span class="details">
														<span class="label label-sm label-icon label-danger">
															<i class="fa fa-bolt"></i>
														</span>
													Database overloaded 68%. </span>
												</a>
											</li>
											<li>
												<a href="javascript:;">
													<span class="time">3 days</span>
													<span class="details">
														<span class="label label-sm label-icon label-danger">
															<i class="fa fa-bolt"></i>
														</span>
													A user IP blocked. </span>
												</a>
											</li>
											<li>
												<a href="javascript:;">
													<span class="time">4 days</span>
													<span class="details">
														<span class="label label-sm label-icon label-warning">
															<i class="fa fa-bell-o"></i>
														</span>
													Storage Server #4 not responding dfdfdfd. </span>
												</a>
											</li>
											<li>
												<a href="javascript:;">
													<span class="time">5 days</span>
													<span class="details">
														<span class="label label-sm label-icon label-info">
															<i class="fa fa-bullhorn"></i>
														</span>
													System Error. </span>
												</a>
											</li>
											<li>
												<a href="javascript:;">
													<span class="time">9 days</span>
													<span class="details">
														<span class="label label-sm label-icon label-danger">
															<i class="fa fa-bolt"></i>
														</span>
													Storage server failed. </span>
												</a>
											</li>
										</ul>
									</li>
								</ul>
							</li>
							<!-- END NOTIFICATION DROPDOWN -->
							<!-- BEGIN INBOX DROPDOWN -->
							<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
							
							<!-- END INBOX DROPDOWN -->
							<!-- BEGIN TODO DROPDOWN -->
							<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
							
							<!-- END TODO DROPDOWN -->
							<!-- BEGIN USER LOGIN DROPDOWN -->
							<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
							<li class="dropdown dropdown-user bd-ri bd-le p-0">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
									<img alt="" class="img-circle" src="../../assets/admin/layout2/img/avatar3_small.jpg"/>
									<span class="username username-hide-on-mobile  fs-16">
									Nick </span>
									<i class="fa fa-angle-down"></i>
								</a>
								<ul class="dropdown-menu dropdown-menu-default bl">
									<li>
										<a href="extra_profile.html">
										<i class="icon-user"></i> My Profile </a>
									</li>
									<li>
										<a href="page_calendar.html">
										<i class="icon-calendar"></i> My Calendar </a>
									</li>
									<li>
										<a href="inbox.html">
											<i class="icon-envelope-open"></i> My Inbox <span class="badge badge-danger">
											3 </span>
										</a>
									</li>
									<li>
										<a href="page_todo.html">
											<i class="icon-rocket"></i> My Tasks <span class="badge badge-success">
											7 </span>
										</a>
									</li>
									<li class="divider">
									</li>
									<li>
										<a href="extra_lock.html">
										<i class="icon-lock"></i> Lock Screen </a>
									</li>
									<li>
										<a href="../login/logout.php">
										<i class="icon-key"></i> Log Out </a>
									</li>
								</ul>
							</li>
							<!-- END USER LOGIN DROPDOWN -->

						</ul>
					</div>
					<!-- END TOP NAVIGATION MENU -->
				</div>
				<!-- END PAGE TOP -->
			</div>
			<!-- END HEADER INNER -->
		</div>