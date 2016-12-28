<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box blue z-depth-1">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>Work Flow Configuration
            </div>
           <div class="tools">
                <a href="javascript:;" class="collapse">
                </a>
                <a href="#portlet-config" data-toggle="modal" class="config">
                </a>
                <a href="javascript:;" class="reload">
                </a>
                <a href="javascript:;" class="remove">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <form  enctype="multipart/form-data" id="form" name="mailconfigform" class="form-horizontal form-row-seperated">
                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">Roster Name</label>
                        <div class="col-md-6">
                          <input type="text" placeholder="Enter Your Work Flow Name" id="workName" class="form-control"/>
                        </div>
                    </div>
                    <h4 class="form-section" style="  margin: 10px 0px 8px 10px;font-weight:bold">Applicability</h4>
                    <div class="form-group">
                        <label class="control-label col-md-3">For Whome</label>
                    <div class="col-md-6">
                      <select id="forWhome" class="form-control" onchange="workflow.showdefault();">
                            <option value="1234" selected >Bussiness Unit</option>
                            <option value="222">Location</option>
                            <option value="322">Work Location</option>
                            <option value="1322">State</option>
                            <option value="422">Function</option>
                            <option value="522">Sub Function</option>
                            <option value="622">Grade</option>
                            <option value="822">Level</option>
                            <option value="722">Employee Type</option>
                            <option value="922">Process</option>
                            <option value="1022">Country</option>
                            <option value="1122">Cost Center</option>
                            <option value="1222">Roles</option>
                      </select>
                    </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-5" id="showsuboption">    
                        </div>
                        <div class="col-md-1">
                        <button type="button" class="btn green" id="add" onclick="workflow.addConfirm();">Add</button>
                        </div>
                        <div class="col-md-5" height="600px" width="600px" id="showConfirm">
                           
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3">Roster For</label>
                        <div class="col-md-4">

                            <input type="button" id="empbtn" value="Applicable Employee" name="empbtn" class="btn btn-block" onclick="showemp()"/>

                        </div>
                        <div class="col-md-6" id="showemp">
                            <select class="form-control">
                                
                                <option>  -- Select Employee --  </option>

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3">Approving Method</label>
                        <div class="col-md-9">
                        <label class="control-label col-md-2">
                            <input type="radio" id="automatic" value="automatic" name="approvingMethod" class="form-control"/> Automatic
                            </label>
                            <label class="control-label col-md-2">
                            <input type="radio" id="manager" value="manager" name="approvingMethod" class="form-control"/> Manager
                            </label>
                        </div>
                    </div>
              <div id="showmanagers" style="display:none;">
                    <div class="form-group">
                      <label class="control-label col-md-4">Number Of Approving Levels</label>
                        <div class="col-md-3">
                        <input type="number" id="approveLevel"  name="approveLevel" min="1" max="100" class="form-control"/>
                        </div>
                        <div class="col-md-2">
                          <button type="button" class="form-control btn green" id="go">Go</button>
                        </div>
                    </div>
              </div>
            <div id="levels" class="lavels">
  
            </div>
          
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <input type="hidden" name="add" id="add" value="Add" />
                            <button type="button" class="btn green" id="submitworkflowconfig"><i class="fa fa-check"></i> Submit</button>
                        </div>
                    </div>
                </div>
            </form>
            <!-- END FORM-->
        </div>
    </div>
</div>
</div>