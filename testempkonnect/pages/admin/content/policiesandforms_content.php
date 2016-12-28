<!--  HR and Admin Policies  -->
<div class="row">
					<div class="col-md-12">
						<!-- BEGIN PORTLET-->
						<div class="portlet box blue-steel">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-gift"></i>Policies
								</div>
								<div class="tools">
									<a href="javascript:;" class="collapse">
									</a>
									
								</div>
							</div>
							<div class="portlet-body form">
								<!-- BEGIN FORM-->
								
								<form class="form-horizontal" enctype="multipart/form-data" id="form1">
								<div class="form-body">
										<div class="form-group">
										
										<div class="col-md-6">
										 <span style="font-size:16px;" class="label-control"> Policies Name </span><br>
										 
											<input type="text" class="form-control file" id="policiesname" name="policiesname"  />
											
										</div>
										<div class="col-md-6">
										 <span style="font-size:16px;" class="label-control"> Policies </span><br>
										 
											<input type="file" class="form-control file" id="hrpolicies" name="hrpolicies"  />
											
										</div>
										
										</div>

									<div class="form-group">
							 		<div class="row">
											<div class=" col-md-offset-1 col-md-4 ">
												<button type="button" class="btn btn-block blue" onclick="polform.policies();"><i class="fa fa-check"></i> Submit</button>
												
											</div>
											<div class="col-md-offset-2 col-md-4 ">
												<button type="button" class="btn btn-block blue" onclick="polform.showpolicies();"><i class="fa fa-file-o"></i> Show Policies</button>
												
											</div>
										</div>
								</div>
								</div>
								
								</form>
								
								<div class="row" id="showpolicies" style="padding-left:10px" >
									
									
								</div>

								<!-- END FORM-->
							</div>
						</div>
						<!-- END PORTLET-->
					</div>
</div>
