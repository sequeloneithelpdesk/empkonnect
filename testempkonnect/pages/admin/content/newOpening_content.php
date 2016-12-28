<div class="tab-pane" id="tab_4">
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>New Opening
            </div>

        </div>
        <div class="portlet-body">
            <!-- BEGIN FORM-->
            <div class="table-toolbar">
                <div class="row">
                    <div class="col-md-6">
                        <div class="btn-group">

                            <a href="#newOpeningpopup" data-toggle="modal" class="btn green" onclick="new_opening('add,')">Create New Vacancy <i class="fa fa-plus"></i></a>                        </div>
                    </div>




                </div>
            </div>


            <table class="table table-striped table-bordered table-hover" id="sample_editable_1">
                <thead>
                <tr>
                    <th>
                        S.No.
                    </th>
                    <th>
                        Vacancy Code
                    </th>
                    <th>
                        Department And Designation Code
                    </th>
                    <th>
                        Location Code
                    </th>
                    <th>
                        No. of Vacancies
                    </th>
                    <th>
                        Action
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i = 1;
                $sqlq="select * from Vacancy ";
                $resultq=sqlsrv_query($conn,$sqlq, array(), array( "Scrollable" => 'static' ));
                if(sqlsrv_num_rows($resultq)) {

                    while ($rowq = sqlsrv_fetch_array($resultq)) {
                        ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $rowq['Vacancy_Code'];?></td>
                            <td><?php echo $rowq['Dept_Code'];?>,<?php echo $rowq['Dsg_Code'];?></td>
                            <td><?php echo $rowq['Loc_Code'];?></td>
                            <td><?php echo $rowq['Wanted_No'];?>,<?php echo $rowq['Dsg_Code'];?></td>
                            <td align="center"><select id="<?php echo $rowq['Vacancy_Code']?>" onchange="new_opening(this.value)">
                                    <option value="">Select Action</option>
                                    <option value="edit,<?php echo $rowq['Vacancy_Code'];?>" >Edit</option>
                                    <option value="view,<?php echo $rowq['Vacancy_Code'];?>">View</option>
                                </select>

                            </td>
                        </tr>

                        <?php
                        $i++;
                    }
                }

                ?>







                </tbody>
            </table>





            <!-- END FORM-->
        </div>


    </div>
</div>
<div class="modal fade bs-modal-lg" id="" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Create New Order</h4>
            </div>
            <div class="modal-body">
                <div class="row">



                    <div class="col-md-12">
                        <label class="control-label"><b>Delivery Address</b></label>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Name<span style="color:#FF0000">*</span></label>
                            <input type="text" class="form-control" value="vijay">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Mobile No<span style="color:#FF0000">*</span></label>
                            <input type="text" class="form-control" value="9560958171">
                        </div>
                    </div>
                    <div class="col-md-6 ">

                        <div class="form-group">
                            <label>Street<span style="color:#FF0000">*</span></label>
                            <input type="text" class="form-control" value="4">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Postal Code<span style="color:#FF0000">*</span></label>
                            <input type="text" class="form-control" value="110091">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Near Land Mark</label>
                            <input type="text" class="form-control" value="cyber city">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Country<span style="color:#FF0000">*</span></label>
                            <select class="form-control"><option>India</option>
                                <option>India</option>
                            </select>
                        </div>
                    </div>

                    <!--/span-->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>State<span style="color:#FF0000">*</span></label>
                            <select class="form-control"><option>Gurgaon</option>
                                <option>India</option>
                            </select>
                        </div>
                    </div>
                    <!--/span-->

                    <!--/row-->


                    <!--/span-->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>City<span style="color:#FF0000">*</span></label>
                            <select class="form-control"><option>Gurgaon</option>
                                <option>Haryana</option>
                            </select>
                        </div>
                    </div>
                    <!--/span-->



                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <label class="control-label"><b>Order Details</b></label>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Start Date<span style="color:#FF0000">*</span></label>
                            <input type="text" class="form-control" value="8/10/2015">

                        </div>
                    </div>
                    <!--/span-->
                    <div class="col-md-6">
                        <div class="form-group has-error">
                            <label class="control-label">End Date<span style="color:#FF0000">*</span></label>
                            <input type="text" class="form-control" value="18/10/2015">
                            <!--<span class="help-block">
                            This field has error. </span>-->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div  class="col-md-12"><b>Item Details</b></div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Quantity<span style="color:#FF0000">*</span></label>
                            <input type="text" class="form-control" value="5">
                        </div>
                    </div>
                    <!--/span-->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Service Model(Daily/Monthly)<span style="color:#FF0000">*</span></label>
                            <select class="form-control">
                                <option>Daily</option>
                                <option>Monthly</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label class="control-label"><b>Destination Address</b></label>
                    </div>
                    <div class="col-md-6 ">

                        <div class="form-group">
                            <label>Street<span style="color:#FF0000">*</span></label>
                            <input type="text" class="form-control" value="4">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Postal Code<span style="color:#FF0000">*</span></label>
                            <input type="text" class="form-control" value="110091">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Near Land Mark</label>
                            <input type="text" class="form-control" value="cyber city">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Country<span style="color:#FF0000">*</span></label>
                            <select class="form-control"><option>India</option>
                                <option>India</option>
                            </select>
                        </div>
                    </div>

                    <!--/span-->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>State<span style="color:#FF0000">*</span></label>
                            <select class="form-control"><option>Gurgaon</option>
                                <option>India</option>
                            </select>
                        </div>
                    </div>
                    <!--/span-->

                    <!--/row-->


                    <!--/span-->

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>City<span style="color:#FF0000">*</span></label>
                            <select class="form-control"><option>Gurgaon</option>
                                <option>Haryana</option>
                            </select>
                        </div>
                    </div>

                    <!--/span-->

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Please Upload Supporting File(Max File Size 2MB)<br>
                                File Type(.jpeg,.png,.xls,.xlsx,.psd)</label>
                            <input type="file"/>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Remarks</label>
                            <textarea  class="form-control" rows="3" name="orderNotes" data-bind="value: orderNotes">This is urgent Requirement</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn default" data-dismiss="modal">Close</button>
                <button type="button" class="btn blue">Save</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade bs-modal-lg" id="newOpeningpopup" data-backdrop="static" data-keyboard="false">
    <div  tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="modalbody">


            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

