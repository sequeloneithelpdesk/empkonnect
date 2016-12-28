<div class="tab-pane" id="tab_4">
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>Mail Configuration
            </div>
           <!-- <div class="tools">
                <a href="javascript:;" class="collapse">
                </a>
                <a href="#portlet-config" data-toggle="modal" class="config">
                </a>
                <a href="javascript:;" class="reload">
                </a>
                <a href="javascript:;" class="remove">
                </a>
            </div>-->
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <form  enctype="multipart/form-data" id="form3" name="mailconfigform" class="form-horizontal form-row-seperated">
                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">Category</label>
                        <div class="col-md-9">
                            <select id="mailCategory" class="select2-container form-control input-xlarge select2me col-md-12">
                                <option value="birthday">Birthday</option>
                                <option value="leave">Leave</option>
                                <option value="anniversary">Anniversary</option>

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Subject</label>
                        <div class="col-md-9">
                            <input type="text" placeholder="enter your mail subject" id="subject" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Notification Name</label>
                        <div class="col-md-9">
                            <input type="text" placeholder="enter your notification name" id="notification" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-body">
                            <div class="form-group last">
                                <label class="control-label col-md-3">CKEditor</label>
                                <div class="col-md-9">
                                    <textarea class="ckeditor form-control" name="editor1" id="maileditor" rows="6"></textarea>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <input type="hidden" name="add" id="add" value="Add" />
                            <button type="button" class="btn green" id="submitmailconfig"><i class="fa fa-check"></i> Submit</button>
                        </div>
                    </div>
                </div>
            </form>
            <!-- END FORM-->
        </div>
    </div>
</div>
