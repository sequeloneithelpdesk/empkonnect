<div class="tab-pane" id="tab_4">
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>Departmental Notification
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
            <form  enctype="multipart/form-data" id="form5" name="departnoti" class="form-horizontal form-row-seperated">
                <div class="form-body">
                    <div class="form-group">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Departments</label>
                                <div class="col-md-9">
                                    <select id="departments" class="select2-container form-control input-xlarge select2me col-md-12">
                                        <option value="">Select Department</option>
                                    <?php
                                    $i = 1;
                                    $sqlq="select * from FUNCTMast";
                                    $resultq=sqlsrv_query($conn,$sqlq, array(), array( "Scrollable" => 'static' ));
                                    if(sqlsrv_num_rows($resultq)) {

                                    while ($rowq = sqlsrv_fetch_array($resultq)) {
                                    ?>
                                        <option value="<?php echo $rowq['FUNCT_NAME'];echo ",";echo $rowq['FunctID']?>"><?php echo $rowq['FUNCT_NAME'];?></option>
                                     <?php 
                                        }
                                    }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Validity of Announcement</label>
                                <div class="col-md-3">
                                    <div class="input-group">
												<span class="input-group-addon">
												<i class="fa fa-calendar"></i>
												</span>
                                        <input class="form-control form-control-inline input-medium" size="16" type="text" value="" id="vdate" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label class="control-label col-md-3">CKEditor</label>
                                <div class="col-md-9">
                                    <textarea class="ckeditor form-control" name="editor3" id="departeditor" rows="6"></textarea>
                                </div>
                            </div>
                            <div class="form-group last">
                                <label class="control-label col-md-3"></label>
                                <div class="col-md-9">
                                    <button type="button" class="btn green" id="addmoretiof"><i class="fa fa-plus"></i> Add More Departmental Announcements </button>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-10 col-md-9">
                          <button type="button" class="btn green" id="DNotification"><i class="fa fa-check"></i> Submit</button>
                        </div>
                    </div>
                </div>
            </form>
            <!-- END FORM-->
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="success" style="display: none;"><p> Successfully Inserted......</p></div>
        <div class="error" style="display: none;"> <p> Error in insertion.....</p></div>
        <!-- BEGIN PORTLET-->
        <div class="portlet box blue-steel">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>Login Policy
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>

                </div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->

                <form class="form-horizontal" enctype="multipart/form-data" id="form8" name="comannounce">
                    <div class="form-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_editable_1">
                            <thead>
                            <tr>
                                <th>
                                    S.No.
                                </th>
                                <th>
                                    Announcements
                                </th>
                                <th>
                                    Validity Date
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            $sqlq="select * from compAnnounce";
                            $resultq=sqlsrv_query($conn,$sqlq, array(), array( "Scrollable" => 'static' ));
                            if(sqlsrv_num_rows($resultq)) {

                                while ($rowq = sqlsrv_fetch_array($resultq)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $rowq['AnnouncementMessage'];?></td>
                                        <td><?php $thedate =$rowq['AnnounceDate']; echo $thedate->format("d/m/y");?></td>
                                        <td align="center"><button type="button" class="btn btn-block blue" id="edit_update<?php echo $rowq['id']?>" value="<?php echo $rowq['id']; ?>" onclick="update_status_login(this.value,'<?php echo $rowq['id']; ?>')">Edit</button>
                                        </td>
                                    </tr>

                                    <?php
                                    $i++;
                                }
                            }

                            ?>






                            </tbody>
                        </table>



                    </div>

                </form>

                <!-- END FORM-->
            </div>
        </div>
        <!-- END PORTLET-->
    </div>
</div>
