<?php ?>
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box blue z-depth-1">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-edit"></i>Manage Roles
				</div>
				
			</div>
			<div class="portlet-body">
				<form class="form-horizontal">
					<div class="form-body">
						<div class="form-group">
							<div class="col-md-2">
								<button type="button" class="btn btn-block green" onclick="Role.createmodel();">
									Create <i class="fa fa-plus"></i>
								</button>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-md-12" id="showrole">
								

							</div>
						</div>
					</div>
					
					<div class="modal fade" id="AddRole" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
					 
					</div>
				</form>
				<div class="modal fade" id="ShowRole" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
								 
				</div>
				<div class="modal fade" id="EditRole" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
				 
				</div>

			</div>
		</div>

	</div>
</div>