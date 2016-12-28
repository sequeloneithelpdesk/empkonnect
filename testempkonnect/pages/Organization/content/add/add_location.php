<?php
include '../HRMSClass/HRMSFunction.php';


?>
<form action="" id="form_sample_1" class="form-horizontal">
      <div class="form-body">
          <div class="alert alert-danger display-hide">
              <button class="close" data-close="alert"></button>
              You have some form errors. Please check below.
          </div>
          <div class="alert alert-success display-hide">
              <button class="close" data-close="alert"></button>
              Location Added Successfully.
          </div>
                     <div class="form-group">
                      <div class="col-md-12">
                        <div class="col-md-4">
                            <label class="control-label">Location Code <span class="required">
                            * </span>
                            </label></br>
                            <input type="text" name="locCode" data-required="1" data-msg-pattern="enter correct pattern" class="form-control"/>
                        </div>
                           <div class="col-md-4">                          
                            <label class="control-label">Location Name <span class="required">
                            * </span>
                            </label></br>
                              <input name="locName" type="text" class="form-control" data-rule-checkCode="4321" data-msg-checkCode="Invalid code"/>
                           </div>
                           <div class="col-md-4">                          
                            <label class="control-label">Location Type<span class="required">
                            * </span>
                            </label></br>
                              <input name="locType" type="text" class="form-control"/>
                           </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12">
                        <div class="col-md-4">
                          <label class="control-label">Parent Location <span class="required">* </span>
                            </label></br>
                            <input type="text" name="locParent" data-required="1" class="form-control"/>
                        </div>
                           <div class="col-md-4">                          
                            <label class="control-label">Work Location <span class="required">
                            * </span>
                            </label></br>
                              <input name="locWork" type="text" class="form-control"/>
                           </div>
                           <div class="col-md-4">                          
                            <label class="control-label">Address 1 <span class="not-required">
                             </span>
                            </label></br>
                              <input name="locAdd1" type="text" class="form-control"/>
                           </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12">
                        <div class="col-md-4">
                            <label class="control-label">Address 2 <span class="not-required">
                             </span>
                            </label></br>
                            <input type="text" name="locAdd2" data-required="1" class="form-control"/>
                        </div>
                          <div class="col-md-4">
                              <label class="control-label">Pincode No. <span class="not-required">
                             </span>
                              </label></br>
                              <input type="text" name="locPin" data-required="1" class="form-control"/>
                          </div>
                          <div class="col-md-4">
                              <label class="control-label">PF Code Of Location<span class="not-required">
                             </span>
                              </label></br>
                              <input name="locPfCode" type="text" class="form-control" cols="10" rows="1"/>
                          </div>


                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12">

                           <div class="col-md-4">                          
                            <label class="control-label">Country<span class="not-required">
                             </span>
                            </label></br>
						<?php  $coun=CountryList(); echo $coun; ?>
							
							
                              
                           </div>
                          <div class="col-md-4">
                              <label class="control-label">State<span class="not-required">
                             </span>
                              </label></br>
                              <input name="locState" type="text" class="form-control"/>
                          </div>
                          <div class="col-md-4">
                              <label class="control-label">City<span class="not-required">
                             </span>
                              </label></br>
                              <input name="locCity" type="text" class="form-control" placeholder=""/>
                          </div>

                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12">
                        <div class="col-md-4">
                            <label class="control-label">ESI Code Of Location<span class="not-required">
                             </span>
                            </label></br>
                            <input type="text" name="locEsiCode" data-required="1" class="form-control"/>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Location Time Zone<span class="not-required">
                             </span>
                        </label></br>
                          <select name="loc_timezone" class="bs-select form-control usercodes bs-searchbox">
                                <option value="0">Please, select timezone</option>
                                <?php foreach(tz_list() as $t) {  ?>
                                    <option value="<?php echo $t['zone'] ?>">
                                        <?php echo  $t['zone'] ?>
                                    </option>
                                <?php } ?>

                            </select>
                        </div>   
                         <div class="col-md-4">
                            <label class="control-label">Currency List<span class="not-required">
                             </span>
                        </label></br>
                          <select name="locCurrency" class="bs-select form-control usercodes"> 
                              <option value="0">Please, Select Currency</option>
                              <?php foreach(CurrencyList() as $key=>$value) { ?>
                                    <option value="<?php echo $key; ?>">
                                        <?php echo $value.' ('.$key.')'; ?>
                                    </option>
                                <?php } ?>
                                
                                </option>
                          </select>
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