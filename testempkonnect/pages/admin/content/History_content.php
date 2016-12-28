<div class="tab-pane" id="tab_4">
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>History
            </div>

        </div>
        <div class="portlet-body">
            <!-- BEGIN FORM-->
            <div class="table-toolbar">
                <div class="row">
                    <div class="col-md-6">
                            <span style="font-size:16px;" class="label-control">Starting Date </span>
                            <div class="input-group">
												<span class="input-group-addon">
												<i class="fa fa-calendar"></i>
												</span>
                                <input class="form-control form-control-inline input-medium" size="16" type="text" id="hisstartdate" />
                            </div>
                    </div>
                    <div class="col-md-6">
                            <span style="font-size:16px;" class="label-control">Ending Date </span>
                            <div class="input-group">
											<span class="input-group-addon">
											<i class="fa fa-calendar"></i>
											</span>
                                <input class="form-control form-control-inline input-medium" size="16" type="text" id="hisenddate" />
                            </div>
                    </div>
                </div>
                <hr>
                <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="hidden"/>
                        </div>
                    </div>
                    <label><b>Parameters to Filter Data</b></label>

                    <?php
                    /* if($_SESSION == 'HR') {
                         */?><!--
                        <div class="col-md-3">
                            <div class="form-group" id="a15">
                                <input type="checkbox" id="Emp_Code" name="params[]" value="Emp_Code"> Sub Business
                            </div>


                        </div>
                        --><?php
                    /*                    }
                                        */?>

                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="button" class="btn green" id="parambutton" name="parambutton" value="Check All" onClick="display_all()" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group" id="a0">

                            <input type="checkbox" id="Comp" name="params[]" value="Comp_Code"> Company
                        </div>


                    </div>

                    <div class="col-md-3">
                        <div class="form-group" id="a1">
                            <input type="checkbox"  name="params[]" value="Dsg_Code"> Designation
                        </div>


                    </div>
                    <div class="col-md-3">
                        <div class="form-group" id="a2">

                                <input type="checkbox" name="params[]" value="Grd_Code"> Grade
                        </div>


                    </div>
                    <div class="col-md-3">
                        <div class="form-group" id="a3">

                                <input type="checkbox" id="Type" name="params[]" value="Type_Code"> Employee Type
                        </div>


                    </div>
                    <div class="col-md-3">
                        <div class="form-group" id="a4">
                               <input type="checkbox" id="Regn" name="params[]" value="Regn_Code"> Region
                        </div>


                    </div>
                    <div class="col-md-3">
                        <div class="form-group" id="a5">
                            <input type="checkbox" id="Loc" name="params[]" value="Loc_Code"> Location
                        </div>


                    </div>
                    <div class="col-md-3">
                        <div class="form-group" id="a6">

                                <input type="checkbox" id="Divi" name="params[]" value="Divi_Code"> Division
                        </div>


                    </div>
                    <div class="col-md-3">
                        <div class="form-group" id="a7">

                                <input type="checkbox" id="Sect" name="params[]" value="Sect_Code"> Sector
                        </div>


                    </div>
                    <div class="col-md-3">
                        <div class="form-group" id="a8">

                                <input type="checkbox" id="Dept" name="params[]" value="Dept_Code"> Department
                        </div>


                    </div>
                    <div class="col-md-3">
                        <div class="form-group" id="a9">

                                <input type="checkbox" id="Buss" name="params[]" value="BussCode"> Business Unit
                        </div>


                    </div>
                    <div class="col-md-3">
                        <div class="form-group" id="a10">
                            <input type="checkbox" id="WLOC" name="params[]" value="WLOC_CODE"> Work Location
                        </div>


                    </div>
                    <div class="col-md-3">
                        <div class="form-group" id="a11">

                                <input type="checkbox" id="FUNCT" name="params[]" value="FUNCT_CODE"> Functional
                        </div>


                    </div>
                    <div class="col-md-3">
                        <div class="form-group" id="a12">

                                <input type="checkbox" id="Level" name="params[]" value="Level_CODE"> Level
                        </div>


                    </div>
                    <div class="col-md-3">
                        <div class="form-group" id="a13">
                            <input type="checkbox" id="SFUNCT" name="params[]" value="SFUNCT_CODE"> Sub Functional
                        </div>


                    </div>
                    <div class="col-md-3">
                        <div class="form-group" id="a14">
                              <input type="checkbox" id="SubBuss" name="params[]" value="SubBuss_ID"> Sub Business
                        </div>


                    </div>

                    <input type="button" name="submit" value="Submit"class="btn blue pull-right" onclick="insertParams();"></button>

                </div>


            </div>
            <hr>

<div id="replace">
            <table class="table table-striped table-bordered table-hover" id="sample_editable_1">
                <thead>
                <tr>
                    <th>
                        S.No.
                    </th>
                    <th>
                        Employee Code
                    </th>
                    <th>
                        Company Code
                    </th>
                    <th>
                        Department And Designation Code
                    </th>
                    <th>
                        Grade Code
                    </th>
                    <th>
                        Location And Region
                    </th>
                    <th>
                        Updated By
                    </th>
                    <th>
                        Transition Date
                    </th>
                    <th>
                        Transition Date with Effect
                    </th>

                </tr>
                </thead>
                <tbody>
                <?php
                $i = 1;
                $sqlq="select * from HrdTran where Emp_Code='100010'";
                $resultq=sqlsrv_query($conn,$sqlq, array(), array( "Scrollable" => 'static' ));
                if(sqlsrv_num_rows($resultq)) {

                    while ($rowq = sqlsrv_fetch_array($resultq)) {
                        ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $rowq['Emp_Code'];?></td>
                            <td><?php echo $rowq['Comp_Code'];?></td>
                            <td><?php echo $rowq['Dept_Code'];?>,<?php echo $rowq['Dsg_Code'];?></td>
                            <td><?php echo $rowq['Grd_Code'];?></td>
                            <td><?php echo $rowq['Loc_Code'];?>,<?php echo $rowq['Regn_Code'];?></td>
                            <td><?php echo $rowq['UpdatedBy'];?></td>
                            <td><?php $thedate =$rowq['Trn_Date']; echo $thedate->format("d/m/y");?></td>
                            <td><?php $date =$rowq['Trn_WEF']; echo $date->format("d/m/y");?></td>
                           
                        </tr>

                        <?php
                        $i++;
                    }
                }

                ?>







                </tbody>
            </table>

</div>
            <div id="show_replace" style='overflow-x:auto;overflow-y:auto;'>
                
            </div>



            <!-- END FORM-->
        </div>


    </div>
</div>
