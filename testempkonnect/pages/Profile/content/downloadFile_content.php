
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
        <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        Widget settings form goes here
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn blue">Save changes</button>
                        <button type="button" class="btn default" data-dismiss="modal">Close</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

        <!-- BEGIN PAGE HEADER-->
        <h3 class="page-title">
             File Download <small>Employee Details</small>
        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="#">Home</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Profile</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">File Download</a>
                </li>
            </ul>

        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="portlet light">
            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-12">
                            <div class="row fileupload-buttonbar" style="margin-bottom: 45px;">
                                <div class="col-lg-7">
                                    <!-- The fileinput-button span is used to style the file input field as button -->
                                    <select style="float: left;margin-right: 37px;" onchange="getEmpByStatus();" class="bs-select form-control input-medium select2me "  name="status_code" id="status_code" data-placeholder="Select..." >
                                        <option value="">select status</option>
                                        <?php
                                        $sql="SELECT * FROM StatusMast ";
                                        $resultq=query($query, $sql, $pa, $opt, $ms_db);

                                        while($data = $fetch($resultq)) {
                                            ?>
                                            <option value="<?php echo $data['Status_Code'];?>"><?php echo $data['Status_Name'];?>
                                            </option>
                                            <?php }?>
                                    </select>

                                    <select style="float: left;margin-right: 20px;" class="bs-select form-control input-medium select2me " name="employee_data" id="employee_data" data-placeholder="Select..." >
                                        <option value=""></option>

                                    </select>

                                    <button type="submit" style="float: left;" onclick="getEmpInTable();" class="btn blue start">
                                        <i class="fa fa-upload"></i>
											<span>
											Go </span>
                                    </button>

                                </div>
                                <!-- The global progress information -->
                                <div class="col-lg-5 fileupload-progress fade">
                                    <!-- The global progress bar -->
                                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar progress-bar-success" style="width:0%;">
                                        </div>
                                    </div>
                                    <!-- The extended global progress information -->
                                    <div class="progress-extended">

                                    </div>
                                </div>
                            </div>
                            <!-- The table listing the files available for upload/download -->
                            <div id="emptable" >

                            </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>
</div>
<!-- END CONTENT -->
