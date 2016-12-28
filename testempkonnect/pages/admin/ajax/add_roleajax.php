<?php
$header=$_POST['header'];
$Role_name=$_POST['Role_name'];
$roledivid=$_POST['roledivid'];
$datadivid=$_POST['datadivid'];
$type=$_POST['type'];
$id=$_POST['id'];

?>

<div class="modal-dialog" style="width:80%;height:80%">
    <div class="modal-content">
      <div class="modal-header modal-color white-color" >
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="white-color">X</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo$header; ?></h4>
      </div>
      <div class="modal-body">
        
<div class="form-body">
										<div class="form-group">
											<div class="col-md-12">
												<label class="col-md-2 label-control">Role Name</label>
												<div class="col-md-5">
												<input type="text" id="role_name" name="role_name" class="form-control" 
												<?php if($type=="Add") { ?>onkeyup="Role.checkrolename()"
													<?php } else { ?> 
													value="<?php  echo$Role_name; ?>"
													<?php } ?> >

												</div>
												<div class="col-md-3 rolename_availability_result" id="rolename_availability_result">
													
												</div>
												<div class="col-md-2">
													<?php if($type=="Show"){}else{ ?>
													<input type="checkbox" id="defaultcheck">Default

													<?php  } ?>
												</div>
											</div>
										</div>
										

										<div class="form-group">
										<div class="col-md-12" style="margin-top:10px;">
											
											<div class="col-md-6" >
											<label class="label-control" style="padding-left:15px;font-size:14px;">Role Menu</label><br>
											<div class="col-md-12" style="min-height:400px;max-height:400px;border:1px solid #ccc;padding-top:10px;overflow-y:auto;">
											<div id="<?php echo $roledivid ; ?>" > </div>
												
												</div>
											</div>
											<div class="col-md-6" >
											<label class="label-control" style="padding-left:15px;font-size:14px;">Data Level</label><br>
											<div class="col-md-12" style="min-height:400px;max-height:400px;border:1px solid #ccc;padding-top:10px;overflow-y:auto;">
												<div id="<?php echo $datadivid ; ?>" > </div>
											</div>
											</div>
											</div>
										</div>
									<?php   if($type=="Add" || $type=="Edit"){ 
									?>
										<div class="form-group">
										<div class="col-md-12">
											<div class="col-md-offset-3 col-md-6 col-md-offset-3" style="margin-top:10px;">
												<button type="button" class="btn btn-block blue" onclick="Role.subrole('<?php echo$type; ?>','<?php echo$id; ?>');"> 
												<?php  if($type=="Add"){  ?>
												Create Role
												<?php  } else{ ?>
													Update Role
													<?php } ?>
												</button>
											</div>
											</div>
										</div>
										<?php  }  ?>
									</div>

			 </div>
    </div>
  </div>
  <?php  if($type=="Add"){  ?>
  <script>
  	Role.ajax_menu();
    Role.ajax_datamenu();
  </script>

  <?php  }  ?>

  <?php  if($type=="Show"){  ?>
  <script>
  	Role.ajax_showmenu("<?php echo$id ?>") ;

    Role.ajax_showdatamenu("<?php echo$id ?>");
  </script>

  <?php  }  ?>

  <?php  if($type=="Edit"){  ?>
  <script>
  	Role.ajax_editmenu('<?php  echo $id ; ?>') ;
    Role.ajax_editdatamenu('<?php  echo $id ; ?>');
  </script>

  <?php  }  ?>