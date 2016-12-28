<div class="tab-pane" id="tab_4">
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>Companies
            </div>

        </div>
        <div class="portlet-body">
            <!-- BEGIN FORM-->
            <div class="table-toolbar">
                <div class="row">
                    <div class="col-md-6">
                        <div class="btn-group">

                            <a href="#companypopup" data-toggle="modal" class="btn green" onclick="company_action(this.value,'add')">Add New <i class="fa fa-plus"></i></a>
                        </div>
                    </div>




                </div>
            </div>


            <table class="table table-striped table-bordered table-hover" id="sample_2">
                <thead><tr class='odd gradeX'><th>S.No.</th><th>Company Code/ID</th>
                    <th>Company Name </th>
                    <th>Company Logo </th>
                    <th>Action</th></tr></thead><tbody>
                <?php
                $i = 1;
                $sqlq="select * from CompMast";
                $resultq=query($query,$sqlq,$pa,$opt,$ms_db);
                if($num($resultq)) {

                    while ($rowq = $fetch($resultq)) {
                        ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $rowq['COMPID'];?></td>
                            <td><?php echo $rowq['COMP_NAME'];?></td>
                            <td><img src="logo/<?php echo $rowq['Comp_Logo'];?>"  style="width: 100px;height:auto;"/></td>
                             <td><button type="button" class="btn btn-block blue" id="edit_update<?php echo $rowq['COMPID']?>" value="<?php echo $rowq['COMPID']; ?>" onclick="company_action(this.value,'edit')">Edit</button>
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
<div class="modal fade bs-modal-lg" id="companypopup" data-backdrop="static" data-keyboard="false">
    <div  tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="modalbody">


            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

