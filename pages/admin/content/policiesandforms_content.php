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
										
										<div class="col-md-4">
										 <span style="font-size:16px;" class="label-control"> Policies Name </span><br>
										 	<select class="form-control file" name="policiesname" id="policiesname" onchange="getSUbPolicies('policiesname');">
                                                    <option value="">Select</option>
                                                    <?php $sql="Select * from LOVMast Where LOV_Field='Policies'";
                                                    $result = query($query,$sql,$pa,$opt,$ms_db);
                                                    while($row = $fetch($result)) {
                                                    ?>
                                                        <option value="<?php echo $row['LOV_Text'];?>">
                                                        <?php echo $row['LOV_Text'];?>
                                                        </option>
                                                    <?php } ?>
                                                    </select>
												
										</div>
										<div class="col-md-4">
										 <span style="font-size:16px;" class="label-control"> Sub Policies Name </span><br>
										 	<select class="form-control file" name="subpoliciesname" id="subpoliciesname">
                                                    <option value="">Select</option>
                                                    
                                                    </select>
												
										</div>
										<div class="col-md-4">
										 <span style="font-size:16px;" class="label-control"> Policies Title</span><br>
										 
											<input type="text" class="form-control file" id="policiestitle" name="policiestitle"  />
											
										</div>
										</div>
										<div class="form-group">
											<div class="col-md-4">
										 <span style="font-size:16px;" class="label-control"> Effective Date </span><br>
										 
											<input type="text" class="form-control" name="toDate" id="fromDate" placeholder="dd/mm/yy"  />
											
										</div>
										<div class="col-md-4">
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
