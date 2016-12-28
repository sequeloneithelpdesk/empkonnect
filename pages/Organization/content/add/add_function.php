<?php

?>
<form action="#" id="form_sample_1" class="form-horizontal">
<div class="form-body">
<div class="alert alert-danger display-hide">
<button class="close" data-close="alert"></button>You have some form errors. Please check below.</div>
<div class="alert alert-success display-hide"><button class="close" data-close="alert"></button>Your Function Added successfully !
        </div>
        <div class="form-group">
              <div class="col-md-12">
                <div class="col-md-6">
                <label class="control-label">Function Code <span class="required">
                    * </span></label></br><input type="text" name="functCode" class="form-control"/>
                </div>
                   <div class="col-md-6">                          
                    <label class="control-label">Function Name <span class="required">
                    * </span>
                    </label></br>
                      <input name="functName" type="bussName" class="form-control"/>
                   </div>
              </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                  <div class="col-md-6">                          
                        <label class="control-label">Function Type<span class="required">
                        * </span>
                        </label></br>
                          <input name="functType" type="text" class="form-control"/>
                       </div>
                  <div class="col-md-6">
                      <label class="control-label">Function Head<span class="required">
                      * </span>
                      </label></br>
                      <input type="text" name="functHead" class="form-control"/>
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