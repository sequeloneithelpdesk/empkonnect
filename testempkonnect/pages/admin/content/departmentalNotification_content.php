<div class="tab-pane" id="tab_4">
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>Function Notification
            </div>

        </div>
        <div class="portlet-body">
            <!-- BEGIN FORM-->
            <div class="table-toolbar">
                <div class="row">
                    <div class="col-md-6">
                        <div class="btn-group">

                            <a href="#departmentalNotificationpopup" data-toggle="modal" class="btn green" onclick="update_department_notifi(this.value,'')">Add New <i class="fa fa-plus"></i></a>
                        </div>
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
                        Functions
                    </th>
                    <th>
                        Subject
                    </th>
                    <th>
                        Notifications
                    </th>
                    <th>
                        Validity Period
                    </th>
                    <th>
                        Action
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i = 1;
              
                $sqlq="select * from DeptNotification where notify_type='dpt'";
                $resultq=query($query,$sqlq,$pa,$opt,$ms_db);
                if($num($resultq)) {

                    while ($rowq = $fetch($resultq)) {
                        ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $rowq['notifyTo'];?></td>
                            <td><?php echo $rowq['Topic'];?></td>
                            <td><?php echo $rowq['notification'];?></td>
                            <td><?php $thedate =$rowq['notifyDate']; echo $thedate->format("d-M-y");?> to <?php $thedate1 =$rowq['EndnotifyDate']; echo $thedate1->format("d-M-y");?> </td>
                            <td align="center"><button type="button" class="btn btn-block blue" id="edit_update<?php echo $rowq['Id']?>" value="<?php echo $rowq['Id']; ?>" onclick="update_department_notifi(this.value,'edit')">Edit</button>
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
<div class="modal fade bs-modal-lg" id="departmentalNotificationpopup" data-backdrop="static" data-keyboard="false">
    <div  tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="modalbody">


            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

