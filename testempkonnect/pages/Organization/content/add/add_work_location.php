<?php include '../HRMSClass/HRMSFunction.php'; ?>

<form action="" id="form_sample_1" class="form-horizontal">
                                    <div class="form-body">
                                        <div class="alert alert-danger display-hide">
                                            <button class="close" data-close="alert"></button>
                                            You have some form errors. Please check below.
                                        </div>
                                        <div class="alert alert-success display-hide">
                                            <button class="close" data-close="alert"></button>
                                            Work Location Added Successfully.
                                        </div>
                     <div class="form-group">
                      <div class="col-md-12">
                        <div class="col-md-4">
                            <label class="control-label">Work Location Code <span class="required">
                            * </span>
                            </label></br>
                            <input type="text" name="wlocCode" data-required="1" data-msg-pattern="enter correct pattern" class="form-control"/>
                        </div>
                           <div class="col-md-4">                          
                            <label class="control-label">Work Location Name <span class="required">
                            * </span>
                            </label></br>
                              <input name="wlocName" type="text" class="form-control"/>
                           </div>
                           <div class="col-md-4">                          
                            <label class="control-label">Work Location Type<span class="required">
                            * </span>
                            </label></br>
                              <input name="wlocType" type="text" class="form-control"/>
                           </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12">
                        <div class="col-md-4">
                            <label class="control-label">Work Parent Location <span class="required">
                            * </span>
                            </label></br>
                            <input type="text" name="wlocParent" data-required="1" class="form-control"/>
                        </div>
                           <div class="col-md-4">                          
                            <label class="control-label">Work Location <span class="required">
                            * </span>
                            </label></br>
                              <input name="wlocWork" type="text" class="form-control"/>
                           </div>
                           <div class="col-md-4">                          
                            <label class="control-label">Address 1 <span class="not-required">
                             </span>
                            </label></br>
                              <textarea name="wlocAdd1" type="text" class="form-control" cols="10" rows="1"></textarea>
                           </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12">
                        <div class="col-md-4">
                            <label class="control-label">Address 2 <span class="not-required">
                             </span>
                            </label></br>
                            <textarea type="text" name="wlocAdd2" data-required="1" class="form-control" cols="10" rows="1"></textarea>
                        </div>
                           <div class="col-md-4">
                            <label class="control-label">Pincode No. <span class="not-required">
                             </span>
                            </label></br>
                            <input type="text" name="wlocPin" data-required="1" class="form-control"/>
                        </div>
                           <div class="col-md-4">                          
                            <label class="control-label">Country<span class="not-required">
                             </span>
                            </label></br>
                              <?php  $coun=CountryList(); echo $coun; ?>
                           </div>
                           
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12">
                        
						   <div class="col-md-4">                          
                            <label class="control-label">State<span class="not-required">
                             </span>
                            </label></br>
                              <input name="wlocState" type="text" class="form-control"/>
                           </div>
                           <div class="col-md-4">                          
                            <label class="control-label">City<span class="not-required">
                             </span>
                            </label></br>
                              <input name="wlocCity" type="text" class="form-control" placeholder=""/>
                           </div>
                      </div>
                    </div>
                    
                </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-9 col-md-3">
                                                <button type="submit" class="btn blue">Submit</button>
                                                <button type="button" data-dismiss="modal" class="btn default">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>