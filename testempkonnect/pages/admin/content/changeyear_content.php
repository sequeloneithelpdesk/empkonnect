<!--  Financial Year Change  -->
<div class="row">
					<div class="col-md-12">
						<!-- BEGIN PORTLET-->
						<div class="portlet box blue-steel">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-gift"></i>Year Change
								</div>
								<div class="tools">
									<a href="javascript:;" class="collapse">
									</a>
									
								</div>
							</div>
							<div class="portlet-body form">
								<!-- BEGIN FORM-->
								
								<form class="form-horizontal">
								<div class="form-body">
										<div class="form-group">
										<?php
										//define(DATETIME_FORMAT, 'Y');
										$todayYear=date('Y');
										$date = date('Y', strtotime("+1 year"));

										?>
										<div class="col-md-2">
										 <span style="font-size:16px;" class="label-control">Year </span><br>
											<select name="finyear" id="finyear" class="bs-select form-control" >
												<option  selected="selected"  value="<?php echo$todayYear ; ?>"><?php echo$todayYear."-".$date ; ?></option>
											</select>
										</div>
										<div class="col-md-2">
											<span style="font-size:16px;" class="label-control">Type of Year change </span><br>
											<select name="yeartext" id="yeartext" class="bs-select form-control" >
												<option value=""> Select Type</option>
												<option value="1">Financial Year</option>
												<option value="2">Reimbursement Year</option>
												<option value="3">Leave Year</option>
											</select>
										</div>
										<div class="col-md-4">
											<span style="font-size:16px;" class="label-control">Starting Date </span>
											<div class="input-group">
												<span class="input-group-addon">
												<i class="fa fa-calendar"></i>
												</span>
												<input class="form-control form-control-inline input-medium" size="16" type="text" value="" id="finstartdate" />
											</div>
											
										</div>
										<div class="col-md-4">
											<span style="font-size:16px;" class="label-control">Ending Date </span>
											<div class="input-group">
											<span class="input-group-addon">
											<i class="fa fa-calendar"></i>
											</span>
												<input class="form-control form-control-inline input-medium" size="16" type="text" value="" id="finenddate" />
											</div>

										</div>

										</div>

									<div class="form-group">
									<div class="row">
											<div class="col-md-offset-3 col-md-6 col-md-offset-3">
												<button type="button" class="btn btn-block blue" onclick="year.finsub()"><i class="fa fa-check"></i> Submit</button>
												
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
