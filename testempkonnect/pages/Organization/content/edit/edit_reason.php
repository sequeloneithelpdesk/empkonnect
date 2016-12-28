<?php
if (isset($_GET['rcode']) && !empty($_GET['rcode'])) {
    include $_SERVER['DOCUMENT_ROOT'] . "/pages/HRMSClass/HRMSClass.php";
    $obj = new HRMSClass;
    $colValue = $_GET['rcode'];
    $row = $obj->GetData("reasonmast", "REASON_CODE", $colValue);
    $Rcode =$row['REASON_CODE'];
    $Rname = $row['REASON_NAME'];
    $Rcategory = $row['REASON_CATEGORY'];
    $Rdetail = $row['REASON_DETAIL'];
?>
<form action="#" id="form_sample_2" class="form-horizontal">
                                    <div class="form-body">
                                        <div class="alert alert-danger display-hide">
                                            <button class="close" data-close="alert"></button>
                                            You have some form errors. Please check below.
                                        </div>
                                        <div class="alert alert-success display-hide">
                                            <button class="close" data-close="alert"></button>
                                            Reason Updated successfully!
                                        </div>
                     <div class="form-group">
                      <div class="col-md-12">
                        <div class="col-md-6">
                            <label class="control-label">Reason Code <span class="required">
                            * </span>
                            </label></br>
							<input type="hidden" name="rcode" class="form-control" value="<?php echo $colValue; ?>"/>
                            <input type="text" name="Rcode" id="RCode" class="form-control" value="<?php echo $Rcode; ?>"/>
                        </div>
                           <div class="col-md-6">                          
                            <label class="control-label">Reason Name <span class="required">
                            * </span>
                            </label></br>
                              <input name="Rname" id="RName" type="text" class="form-control" value="<?php echo $Rname; ?>"/>
                           </div> 
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12">
                      <div class="col-md-6">                          
                            <label class="control-label">Reason Category<span class="required">
                            * </span>
                            </label></br>
                              <input name="Rcategory" type="text" class="form-control" value="<?php echo $Rcategory; ?>"/>
                           </div>
                        <div class="col-md-6">
                            <label class="control-label">Reason Details<span class="required">
                            * </span>
                            </label></br>
                            <input type="text" name="Rdetail" class="form-control" value="<?php echo $Rdetail; ?>"/>
                        </div>
                           
                      </div>
                    </div>
                </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-9 col-md-3">
                                                <button type="submit" class="btn blue"  id="subbut" >Submit</button>
                                                <button type="button" data-dismiss="modal" class="btn default">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
	 <?php
  }
 ?>
