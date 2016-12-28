<form action="#" id="form_sample_1" class="form-horizontal">
                                    <div class="form-body">
                                        <div class="alert alert-danger display-hide">
                                            <button class="close" data-close="alert"></button>
                                            You have some form errors. Please check below.
                                        </div>
                                        <div class="alert alert-success display-hide">
                                            <button class="close" data-close="alert"></button>
                                            New Holiday Added successfully!
                                        </div>
                     <div class="form-group">
                      <div class="col-md-12">
                        <div class="col-md-6">
                            <label class="control-label">Holiday Date <span class="required">
                            * </span>
                            </label></br>
                            <input type="date" name="hDate" class="form-control"/>
                        </div>
                           <div class="col-md-6">                          
                            <label class="control-label">Applicable Location <span class="required">
                            * </span>
                            </label></br>
                              <input name="locCode" type="text" class="form-control"/>
                           </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12">
                      <div class="col-md-6">                          
                            <label class="control-label">Holiday Code<span class="required">
                            * </span>
                            </label></br>
                              <input name="hCode" type="text" class="form-control"/>
                           </div>
                        <div class="col-md-6">
                            <label class="control-label">Holiday Name<span class="required">
                            * </span>
                            </label></br>
                            <input type="text" name="hDesc" class="form-control"/>
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