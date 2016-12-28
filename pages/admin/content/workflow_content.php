<div class="tab-pane" id="tab_4">
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>Workflow Configuration
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
            <form  id="workflowform" name="mailconfigform" class="form-horizontal form-row-seperated">
                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-2">Workflow Code</label>
                        <div class="col-md-3">
                            <input type="text" placeholder="Enter Your Work Flow Code" id="workCode" name="workCode" class="form-control"/>
                        </div>
                        <label class="control-label col-md-2">Workflow Name</label>
                        <div class="col-md-3">
                            <input type="text" placeholder="Enter Your Work Flow Name" id="workName" name="workName" class="form-control"/>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3">For Whom</label>
                        <div class="col-md-6">
                            <select id="forWhome" class="form-control" onchange="Roster.showdefault();">
                                <option value="1122" selected >Company</option>
                                <option value="122" >Bussiness Unit</option>
                                <option value="222">Location</option>
                                <option value="322">Work Location</option>
                                <option value="422">Function</option>
                                <option value="522">Sub Function</option>
                                <option value="622">Grade</option>
                                <option value="722">Employee Type</option>
                                <option value="922">Process</option>
                                <option value="1022">Employee Wise</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-5" id="showsuboption" style="height: 100px; overflow-y: scroll">
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn green" id="add" onclick="Roster.addConfirm();">Add</button>
                        </div>
                        <div class="col-md-5" height="600px" width="600px" id="showConfirm" style="height: 100px; overflow-y: scroll">

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Workflow For</label>
                        <div class="col-md-9">
                            <label class="control-label col-md-3">
                                <input type="radio" id="attendance" value="Attendance" name="workflowMethod" class="form-control"/> Attendance
                            </label>
                            <label class="control-label col-md-3">
                                <input type="radio" id="leave" value="Leave" name="workflowMethod" class="form-control"/> Leave
                            </label>
                            <label class="control-label col-md-3">
                                <input type="radio" id="overtime" value="overtime" name="workflowMethod" class="form-control"/> OverTime
                            </label>
                        </div>
                    </div>
                    <div id="showevent" style="display:none;">
                        <div class="form-group">
                            <label class="control-label col-md-3">Events</label>
                            <div class="col-md-6">
                                <select id="event" name="event" class="form-control">
                                   
                              
                                </select>
                            </div>
                        </div>


                    </div>

                    <div id="showattendancerule" style="display:none;">
                        <div class="form-group">
                            <label class="control-label col-md-4">Rules for Attendance</label>
                            <div class="row">
                                <div class="col-md-2">
                                    <button type="button" class="form-control btn green" id="addrulerow"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="row">
                                <label class="control-label col-md-3">No. of days</label>
                                <label class="control-label col-md-3">Approval Levels</label>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <input type="text" class="form-control"/>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control"/>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div id="showleaverule" style="display:none;">
                        <div class="form-group">
                            <label class="control-label col-md-3">Rules for Leave</label>

                        </div>


                    </div>
                    <div id="approvingMethod" style="display:none;">
                        <div class="form-group" >
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
                    </div>
                    <div id="rulepolicy" style="display:none;">
                        <div class="form-group" >
                            <label class="control-label col-md-3">Rules for Approval</label>
                            <div class="col-md-9">
                                <label class="control-label col-md-3">
                                    <input type="radio" id="systemDefine" value="systemDefine" name="approvingRules" class="form-control"/> System Define
                                </label>
                                <label class="control-label col-md-3">
                                    <input type="radio" id="manual" value="manual" name="approvingRules" class="form-control"/> Manual
                                </label>
                            </div>
                        </div>
                    </div>
                    <div id="showmanagers" style="display:none;">
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-md-3">Rules for Attendance</label>
                                <div class="col-md-1" style="float:right">
                                    <button type="button" style="float: right;" class="form-control btn green" id="addnewrow">+</button>
                                </div>
                            </div>
                            <div id="showrules">
                                <div class="row"><input type="checkbox" id="shownocol">
                                    <label class="control-label col-md-3" style="margin-left:30px;">Levels</label>
                                    <label class="control-label col-md-3" style="margin-left:50px;">No. of Days</label>
                                    <label class="control-label col-md-3" style="margin-left:50px;">Approver</label>
                                </div>
                                <div class="row">
                                    <input class="col-md-3" type="text" id="level1" name="level[]" style="margin-left:30px;"/>
                                    <input class="col-md-3" type="text" id="day1" name="dayno[]" style="margin-left:50px;"/ disabled>
                                    <select class="col-md-3" id="approver1" name="approver[]" class="form-control" style="margin-left:50px;">
                                        <option value="">Select Approver</option>
                                        <?php
                                        $sqlq="select * from LovMast where LOV_Field='Profile'";
                                        $resultq=query($query,$sqlq,$pa,$opt,$ms_db);
                                        if($num($resultq)) {

                                            while ($rowq = $fetch($resultq)) {
                                                ?>
                                                <option value="<?php echo $rowq['LOV_Text'] ?>"><?php echo $rowq['LOV_Text'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>

                                </div>
                            </div>
                            <!--<div class="col-md-2" style="float: right">
                                <button type="button" class="form-control btn green" id="go">Go</button>
                            </div>-->

                        </div>
                    </div>



                    <div id="levels" class="lavels">

                    </div>

                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <input type="hidden" name="add" id="add" value="Add" />
                            <button type="button" class="btn green" id="submitRosterconfig" onclick="Roster.wfsubmit();"><i class="fa fa-check"></i> Submit</button>
                        </div>
                    </div>
                </div>
            </form>
            <!-- END FORM-->
        </div>
    </div>
</div>


