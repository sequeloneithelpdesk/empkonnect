<?php 
$comp_code="ABC";
?>
<div class="row">
					<div class="col-md-12">
						<!-- BEGIN EXAMPLE TABLE PORTLET-->
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-edit"></i>Create Roles
								</div>
								
							</div>
							<div class="portlet-body">
								<form class="form-horizontal">
									<div class="form-body">
										<div class="form-group">
											<div class="col-md-12">
												<label class="col-md-2 label-control">Role Name</label>
												<div class="col-md-6">
												<input type="text" id="role_name" name="role_name" class="form-control" onkeyup="Role.checkrolename()">

												</div>
												<div class="col-md-4 rolename_availability_result" id="rolename_availability_result">
													
												</div>
											</div>
										</div>
										<div class="form-group">
										<div class="col-md-12">
											<h2> <?php echo $comp_code; ?> </h2><br>
										</div>
										</div>
										<div class="form-group">
										<div class="col-md-12">
											<label label-control" style="padding-left:15px;">Role Menu</label>
											<div class="col-md-12" style="min-height:400px;border:1px solid #ccc;padding-top:10px;">
												<div class="col-md-4" id="menu" style="">
													
												</div>
												<div class="col-md-4">
													<button type="button" class="btn btn-block blue" onclick="Role.getdata();">Preview
													</button>
												</div>
												<div class="col-md-4" id="showmenu">
													
												</div>
												
											</div>
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-offset-3 col-md-6 col-md-offset-3">
												<button class="btn btn-block blue "> Create Role
												</button>
											</div>
										</div>
									</div>
								</form>
					

					</div>
				</div>

				</div>
				</div>