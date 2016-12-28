<?php
if(isset($_GET['univCode']) && !empty($_GET['univCode'])) {
    include $_SERVER['DOCUMENT_ROOT']."/pages/HRMSClass/HRMSClass.php";
    $obj = new HRMSClass;
    $colValue = $_GET['univCode'];
    $row = $obj->GetData("univmast", "Univ_Code", $colValue);
    $univCode =$row['Univ_Code'];
    $univName = $row['Univ_Name']; 
?>
              
              <form action="#" id="form_sample_2" class="form-horizontal">
              
                                    <div class="form-body">
                                        <div class="alert alert-danger display-hide">
                                            <button class="close" data-close="alert"></button>
                                            You have some form errors. Please check below.
                                        </div>
                                        <div class="alert alert-success display-hide">
                                            <button class="close" data-close="alert"></button>
                                            University Details Edited successfully!
                                        </div>
                     <div class="form-group">
                      <div class="col-md-12">
                        <div class="col-md-6">
                            <label class="control-label">University Code<span class="required">
                            * </span>
                            </label></br>
                            <input type="hidden" name="oldUnivCode" class="form-control" value="<?php echo $colValue;?>" />
                            <input type="text" name="univCode" class="form-control" value="<?php echo $univCode;?>"/>
                        </div>
                           <div class="col-md-6">                          
                            <label class="control-label">University Name<span class="required">
                            * </span>
                            </label></br>
                              <input name="univName" type="bussName" class="form-control" value="<?php echo $univName;?>"/>
                           </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12">
                      <div class="col-md-6">                          
                            <label class="control-label">Status<span class="required">
                            * </span>
                            </label></br>
                              <input name="status" type="text" class="form-control" value="<?php echo $status;?>"/>
                           </div>
                      </div>
                    </div>     
                </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-9 col-md-3">
                                                <button type="submit" class="btn blue"  id="subbut" >Update</button>
                                                <button type="button" data-dismiss="modal" class="btn default">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
 <?php
 
  }
 ?>
 
