<div class="page-content-wrapper" xmlns="http://www.w3.org/1999/html">
    <div class="page-content cus-light-grey">

        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <div class="tabbable tabbable-custom tabbable-noborder tabbable-reversed">

                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_0">
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>My Team Leave
                                    </div>
                                   
                                </div>
                                <div class="portlet-body form">
                                    <!-- BEGIN FORM-->
                                    <form action="#" class="form-horizontal" id="compOffForm">
                                        <div class="form-body">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <div class="col-md-6">
                                                    <label class="col-md-4" style="padding-left: 0px;">Employee Name</label>
                                                    <div class="col-md-8" id="leave_team">
                                                        <select></select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="col-md-4">Leave Type</label>
                                                    <div class="col-md-6" id="leave_type">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12"><hr>
                                            <div class="col-md-2">
                                                    <label >Statement Period</label>
                                                    </div>
                                                <div class="col-md-4">
                                                    <label class="col-md-4">Start Date</label>
                                                    <div class="col-md-6" >
                                                        <input type="text" class="form-control" name="startDate" id="startDate" placeholder="dd/mm/yy">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="col-md-4">End Date</label>
                                                    <div class="col-md-6" >
                                                        <input type="text" class="form-control" name="endDate" id="endDate" placeholder="dd/mm/yy">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="button" name="Go" value="Go" class="btn btn-block blue" onclick="Leave.transaction(1);">
                                                </div>
                                            </div>
                                        </div>
                                            <div class="form-group" id="leave_bal">
                                            
                                            <div class="col-md-12">
                                            <div class="col-md-12" style="border-bottom:1px solid #eee;">
                                            <ul class="leave_ul"><li id="sac">
                                            <a onclick="Leave.bal();" class="btn btn-default tab1_col"><span>Leave Balance</span></a>
                                            </li>
                                            <li><a onclick="Leave.tran();" class="btn btn-default tab2_col"><span>Leave Transaction</span></a>
                                            </li>
                                            
                                            </ul>
                                            </div>                                            
                                            <div class="col-md-12" id="tab_1">
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <th>Leave Type</th>
                                                        <th>Year Start balance</th>
                                                        <th>Added so far</th>
                                                        <th>Availed so far</th>
                                                        <th>Balanced today</th>
                                                        <th>Yet to accrue</th>
                                                        <th>Year-end Balance</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="leave_b"></tbody>
                                                </table>
                                                </div>
                                                <div class="col-md-12 inactive" id="tab_2">
                                            
                                                <table class="table table-striped table-bordered table-hover" id="sample_2">
                                                    <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Transaction Details</th>
                                                        <th>Action by</th>
                                                        <th>Decrease</th>
                                                        <th>Balance</th>
                                                        
                                                    </tr>
                                                    </thead>
                                                    <tbody id="leave_t"></tbody>
                                                </table>
                                                </div>
                                                </div>
                                            </div>

                                            <div class="form-group" id="leave_tran">
                                            
                                            
                                            </div>
                                            </div>
                                        
                                    </form>
                                    <!-- END FORM-->
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>