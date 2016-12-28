<div class="page-content-wrapper" xmlns="http://www.w3.org/1999/html">
    <div class="page-content cus-light-grey">

        <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
        <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title" style="color:blue;">Add Relative Details</h4>
                    </div>
                    <div class="modal-body" id="portlet-configAddtbody">
                        <?php //include "content/addFamily_content.php" ?>
                    </div>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- / .modal -->

        <div class="modal fade" id="portlet-config2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title" style="color:blue;">Add Qualification Details</h4>
                    </div>
                    <div class="modal-body"  id="portlet-configAdd2tbody">
                        <?php //include "content/addQualification_content.php" ?>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- End Qualification Details Model-->

        <!-- Add Language Details Model-->
        <div class="modal fade" id="portlet-config3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title" style="color:blue;">Add Language Details</h4>
                    </div>
                    <div class="modal-body" id="portlet-configAdd3tbody">
                        <?php// include "content/addLanguage_content.php" ?>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- End Language Details Model-->
        <div class="modal fade" id="portlet-config1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title" style="color:blue;">Add Nominee Details</h4>

                    </div>
                    <div class="modal-body" id="portlet-config1Addtbody">
                        <?php //include "content/addNominee_content.php" ?>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
        

        <!-- BEGIN PAGE CONTENT-->
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>Add Employee
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                    <a href="#portlet-config" data-toggle="modal" class="config">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="tabbable tabs-left">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab_6_1" data-toggle="tab">
                                Official Details </a>
                        </li>
                        <li>
                            <a href="#tab_6_2" data-toggle="tab">
                                Bank Details </a>
                        </li>
                        <li >
                            <a href="#tab_6_3" data-toggle="tab">
                                Statury Details
                            </a>
                        </li>
                        <li>
                            <a href="#tab_6_4" data-toggle="tab">
                                Identity Proofs  </a>
                        </li>
                        <li>
                            <a href="#tab_6_5" data-toggle="tab">
                                Seperation Information </a>
                        </li>
                        <li>
                            <a href="#tab_6_6" data-toggle="tab">
                                Contact Details </a>
                        </li>
                        <li>
                            <a href="#tab_6_7" data-toggle="tab">
                                More Details </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <input type="hidden" id="empCode" value="">

                        <div class="tab-pane active" id="tab_6_1">
                            <form name="addemployeForm" id="addemployeForm" action="#">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="col-md-3">
                                            <label class="control-label">Title<span class="not-required"></span></label>
                                            <select name="emptitle" id="emptitle" class="form-control">
                                                <option value=""></option>
                                                <?php  echo $sql="Select * from LOVMast where LOV_Field='title'";
                                                        $res=query($query,$sql,$pa,$opt,$ms_db);
                                                while( $ro = $fetch($res)){
                                                ?>
                                                <option value="<?php echo $ro['LOV_Value'];?>"><?php echo $ro['LOV_Text'];?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label">Employee First Name<span class="required">* </span>
                                            </label></br>
                                            <input name="empFName" id="empFName" type="text" class="form-control" cols="10" rows="1"/>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label">Employee Middle Name <span class="not-required">
				                             </span>
                                            </label></br>
                                            <input type="text" name="empMName" id="empMName" class="form-control"/>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label">Employee Last Name <span class="not-required">
				                             </span>
                                            </label></br>
                                            <input name="empLName" id="empLName" type="text" class="form-control"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="col-md-3">
                                            <label class="control-label">Gender<span class="required">* </span></label></br>
                                            <select name="sex" id="sex" class="form-control">
                                                <?php
                                                $sql="select LOV_Value,LOV_Text from LOVMAst where LOV_Field='SEX'";
                                                $result =  query($query,$sql,$pa,$opt,$ms_db);
                                                while($data = $fetch($result)) {
                                                ?>
                                                <option value="<?php echo $data['LOV_Value'];?>"><?php echo $data['LOV_Text'];?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="control-label">Employee Code <span class="required">* </span></label></br>
                                            <input type="text" name="empCode1" id="empCode1"  maxlength="20" class="form-control" onchange="getEmpCode();"/>

                                            <span class="help-block" id="errorempcode"  style="display: none; color: red;">Employee Code Already Exist</span>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="control-label">Date Of Joining <span class="required">*</span></label></br>
                                            <input type="text" name="doj" id="doj" onchange="getDateOfConf(this.value);" placeholder="DD/MM/YYYY" class="form-control"/>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="control-label">Date Of Confirmation<span class="required">*</span></label></br>
                                            <input name="dojWef" id="dojWef" type="text" class="form-control" placeholder="DD/MM/YYYY"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">

                                        <div class="col-md-3">
                                            <?php
                                            $sqlq="select * from company_login_mst where status='Active' AND  login_column='userEmailid'";
                                            $resultq=query($query,$sqlq,$pa,$opt,$ms_db);
                                            $no=$num($resultq);
                                            //echo $no;
                                            if($no == 1) {
                                                ?>
                                                <label class="control-label">Official Email<span id="errEmailOff" class="not-required"></span></label></br>
                                                <input type="email" name="oEmail" id="oEmail"  onkeyup="validate.email('oEmail','errEmailOff');" class="form-control" required/>
                                            <?php } else { ?>
                                                <label class="control-label">Official Email<span id="errEmailOff" class="not-required"></span></label></br>
                                                <input type="email" name="oEmail" id="oEmail" onkeyup="validate.email('oEmail','errEmailOff');" class="form-control" />

                                            <?php  }?>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="control-label">Access Code<span class="not-required"></span></label></br>
                                            <input type="text" name="accesscode" id="accesscode"  class="form-control" />
                                        </div>


                                        <div class="col-md-3">
                                            <label class="control-label">Company<span class="required">* </span></label></br>
                                            <select name="compCode" id="compCode" class="form-control input-medium select2me" data-placeholder="Select...">
                                                <option value=""></option>
                                                <?php $sql="Select COMPID, COMP_NAME from CompMast";

                                                $result = query($query,$sql,$pa,$opt,$ms_db);
                                                if ($num($result) > 0) {
                                                    $list="";
                                                    while($row = $fetch($result)) {
                                                        $list.= "<option value=" . $row['COMPID']. ">" . $row['COMP_NAME']. "</option>";
                                                    }
                                                    echo $list;
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="control-label">Location<span class="not-required"></span></label></br>
                                            <select name="locCode" id="locCode" class="form-control input-medium select2me" data-placeholder="Select...">
                                                <option value=""></option>
                                                <?php $sql="Select LOCID, LOC_NAME from LocMast";
                                                $result = query($query,$sql,$pa,$opt,$ms_db);
                                                if ($num($result) > 0) {
                                                    $list="";
                                                    while($row =$fetch($result)) {
                                                        $list.= "<option value=" . $row['LOCID']. ">" . $row['LOC_NAME']. "</option>";
                                                    }
                                                    echo $list;
                                                }
                                                ?>
                                            </select>
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="col-md-3">
                                            <label class="control-label">Work Location<span class="not-required"></span></label></br>
                                            <!--<input name="wLocCode" id="wLocCode" type="text" class="form-control" placeholder=""/>-->
                                            <select name="wLocCode" id="wLocCode" class="form-control input-medium select2me" data-placeholder="Select...">
                                                <option value=""></option>
                                                <?php $sql="Select WorkLocId, WLOC_NAME from WorkLocMast";
                                                $result = query($query,$sql,$pa,$opt,$ms_db);
                                                if ($num($result) > 0) {
                                                    $list="";
                                                    while($row =$fetch($result)) {
                                                        $list.= "<option value=" . $row['WorkLocId']. ">" . $row['WLOC_NAME']. "</option>";
                                                    }
                                                    echo $list;
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label">Function<span class="not-required"></span></label></br>
                                            <select name="functCode" id="functCode" class="form-control input-medium select2me" onchange="selectSubFunction(this.value);" data-placeholder="Select...">
                                                <option value=""></option>
                                                <?php $sql="Select FunctID, FUNCT_NAME from FUNCTMast";
                                                $result = query($query,$sql,$pa,$opt,$ms_db);

                                                if ($num($result) > 0) {
                                                    $list="";
                                                    while($row =$fetch($result)) {
                                                        $list.= "<option value=" . $row['FunctID']. ">" . $row['FUNCT_NAME']. "</option>";
                                                    }
                                                    echo $list;
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="control-label">Sub Function<span class="not-required">
				                             </span>
                                            </label></br>
                                            <select name="subFunctCode" id="subFunctCode" class="form-control input-medium select2me" data-placeholder="Select..." >
                                                <option value=""></option>
                                                <?php $sql="Select * from SubFunctMast";
                                                $result = query($query,$sql,$pa,$opt,$ms_db);

                                                    while($row =$fetch($result)) {?>
                                                        <option value="<?php echo $row['SubFuntId']; ?>"><?php echo $row['SubFunct_NAME'];?></option>
                                                <?php }?>
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="control-label">Designation<span class="required"></span></label></br>
                                            <!-- <input name="roleCODE" id="roleCODE" type="text" class="form-control" placeholder=""/>-->
                                            <select name="dsCODE" id="dsCODE" class="form-control input-medium select2me" data-placeholder="Select...">
                                                <option value=""></option>
                                                <?php $sql="Select DSGID, DSG_NAME from DsgMast";
                                                $result = query($query,$sql,$pa,$opt,$ms_db);
                                                $list="";
                                                if ($num($result)> 0) {
                                                    while($row =$fetch($result)) {
                                                        $list.= "<option value=" . $row['DSGID']. ">" . $row['DSG_NAME']. "</option>";
                                                    }
                                                    echo $list;
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="col-md-3">
                                            <label class="control-label">Grade<span class="not-required"></span></label></br>
                                            <!--<input name="grdCode" id="grdCode" type="text" class="form-control" placeholder=""/>-->
                                            <select name="grdCode" id="grdCode" class="form-control input-medium select2me" data-placeholder="Select...">
                                                <option value=""></option>
                                                <?php $sql="Select GRDID, GRD_NAME from GrdMast";
                                                $result = query($query,$sql,$pa,$opt,$ms_db);
                                                if ($num($result) > 0) {
                                                    $list="";
                                                    while($row =$fetch($result)) {
                                                        $list.= "<option value=" . $row['GRDID']. ">" . $row['GRD_NAME']. "</option>";
                                                    }
                                                    echo $list;
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="control-label">Level<span class="not-required"></span></label></br>
                                            <select name="lavel" id="lavel" class="form-control input-medium select2me" data-placeholder="Select...">
                                                <option value=""></option>
                                                <?php $sql="Select LEVELID, LEVEL_Name from LEVELMAST";
                                                $result = query($query,$sql,$pa,$opt,$ms_db);
                                                $list="";
                                                if ($num($result)> 0) {
                                                    while($row =$fetch($result)) {
                                                        $list.= "<option value=" . $row['LEVELID']. ">" . $row['LEVEL_Name']. "</option>";
                                                    }
                                                    echo $list;
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="control-label">Business Unit<span class="not-required"></span></label></br>
                                            <select name="bussCode" id="bussCode" class="form-control input-medium select2me" data-placeholder="Select...">
                                                <option value=""></option>
                                                <?php $sql="Select BUSSID, BussName from BussMast";
                                                $result = query($query,$sql,$pa,$opt,$ms_db);
                                                if ($num($result) > 0) {
                                                    $list="";
                                                    while($row =$fetch($result)) {
                                                        $list.= "<option value=" . $row['BUSSID']. ">" . $row['BussName']. "</option>";
                                                    }
                                                    echo $list;
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="control-label">Sub Business Unit<span class="not-required">
				                             </span>
                                            </label></br>
                                            <!--<input name="procCode" id="procCode" type="text" class="form-control" placeholder=""/>-->
                                            <select name="subBussUnit" id="subBussUnit" class="form-control input-medium select2me" data-placeholder="Select...">
                                                <option value=""></option>
                                                <?php $sql="Select subBussid, subBussName from subBussMast";
                                                $result = query($query,$sql,$pa,$opt,$ms_db);
                                                if ($num($result) > 0) {
                                                    $list="";
                                                    while($row =$fetch($result)) {
                                                        $list.= "<option value=" . $row['subBussid']. ">" . $row['subBussName']. "</option>";
                                                    }
                                                    echo $list;
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="col-md-3">
                                            <label class="control-label">Employee Type<span class="not-required"></span></label></br>
                                            <!--<input name="empTypeCode" id="empTypeCode" type="text" class="form-control" placeholder=""/>-->
                                            <select name="empTypeCode" id="empTypeCode" class="form-control input-medium select2me" data-placeholder="Select...">
                                                <option value=""></option>
                                                <?php $sql="Select TYPEID, TYPE_NAME from TypeMast";
                                                $result = query($query,$sql,$pa,$opt,$ms_db);
                                                if ($num($result) > 0) {
                                                    $list="";
                                                    while($row =$fetch($result)) {
                                                        $list.= "<option value=" . $row['TYPEID']. ">" . $row['TYPE_NAME']. "</option>";
                                                    }
                                                    echo $list;
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label">Cost Center<span class="not-required"></span></label></br>
                                            <select name="costCode" id="costCode" class="form-control input-medium select2me" data-placeholder="Select...">
                                                <option value=""></option>
                                                <?php $sql="Select CostID, COST_NAME from CostMast";
                                                $result = query($query,$sql,$pa,$opt,$ms_db);

                                                if ($num($result) > 0) {
                                                    $list="";
                                                    while($row =$fetch($result)) {
                                                        $list.= "<option value=" . $row['CostID']. ">" . $row['COST_NAME']. "</option>";
                                                    }
                                                    echo $list;
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="control-label">Process<span class="not-required"></span></label></br>
                                            <!--<input name="procCode" id="procCode" type="text" class="form-control" placeholder=""/>-->
                                            <select name="procCode" id="procCode" class="form-control input-medium select2me" data-placeholder="Select...">
                                                <option value=""></option>
                                                <?php $sql="Select PROCID, PROC_NAME from PROCMAST";
                                                $result = query($query,$sql,$pa,$opt,$ms_db);
                                                if ($num($result) > 0) {
                                                    $list="";
                                                    while($row =$fetch($result)) {
                                                        $list.= "<option value=" . $row['PROCID']. ">" . $row['PROC_NAME']. "</option>";
                                                    }
                                                    echo $list;
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="control-label">Division<span class="not-required">
				                             </span>
                                            </label></br>
                                            <select name="divisionMast" id="divisionMast" class="form-control input-medium select2me" data-placeholder="Select..." >
                                                <option value=""></option>
                                                <?php $sql="select DIVIID, DIVI_NAME from DiviMast";
                                                $result = query($query,$sql,$pa,$opt,$ms_db);
                                                if ($num($result) > 0) {
                                                    $list="";
                                                    while($row =$fetch($result)) {
                                                        $list.= "<option value=" . $row['DIVIID']. ">" . $row['DIVI_NAME']. "</option>";
                                                    }
                                                    echo $list;
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="col-md-3">
                                            <label class="control-label">Region<span class="not-required">
				                             </span>
                                            </label></br>
                                            <!-- <input name="costCode" id="costCode" type="text" class="form-control" placeholder=""/>-->
                                            <select name="regionMast" id="regionMast" class="form-control input-medium select2me" data-placeholder="Select...">
                                                <option value=""></option>
                                                <?php $sql="Select REGNID, REGN_NAME from RegnMast";
                                                $result = query($query,$sql,$pa,$opt,$ms_db);

                                                if ($num($result) > 0) {
                                                    $list="";
                                                    while($row =$fetch($result)) {
                                                        $list.= "<option value=" . $row['REGNID']. ">" . $row['REGN_NAME']. "</option>";
                                                    }
                                                    echo $list;
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="control-label col-md-12">Reporting To</label>
                                                <select class="bs-select form-control input-medium select2me " id="global_manager" data-placeholder="Select...">
                                                    <option value=""></option>
                                                    <?php
                                                    $sql="select Emp_Code,Emp_FName,Emp_MName,Emp_LName from HrdMast";
                                                    $resultq=query($query,$sql,$pa,$opt,$ms_db);

                                                    while($row = $fetch($resultq)) {
                                                        ?>
                                                        <option value="<?php echo $row['Emp_Code'];?>"><?php echo $row['Emp_FName'];?><?php echo $row['Emp_MName'];?> <?php echo $row['Emp_LName'];?> (<?php echo $row['Emp_Code'];?>)
                                                        </option>
                                                        <?php

                                                    }?>
                                                </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="control-label col-md-12" >Function Supervisor</label>
                                                <select class="form-control input-medium select2me" id="function_supervisor" data-placeholder="Select..." >
                                                    <option value=""></option>
                                                    <?php
                                                    $sql="select Emp_Code,Emp_FName,Emp_MName,Emp_LName from HrdMast";
                                                    $resultq=query($query,$sql,$pa,$opt,$ms_db);

                                                    $i=1;
                                                    while($row = $fetch($resultq)) {
                                                        ?>
                                                        <option value="<?php echo $row['Emp_Code'];?>"><?php echo $row['Emp_FName'];?><?php echo $row['Emp_MName'];?> <?php echo $row['Emp_LName'];?> (<?php echo $row['Emp_Code'];?>)
                                                        </option>
                                                        <?php
                                                        $i++;
                                                    }?>
                                                </select>
                                            
                                        </div>

                                        <div class="col-md-3">
                                            <label class="control-label">Work Phone<span class="required" id="errorworkphn"></span></label></br>
                                            <input type="text" name="workphn" id="workphn" maxlength="10" placeholder="Numeric Values Only"  class="form-control" />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="col-md-3">
                                            <label class="control-label">Work Phone Extention<span class="required" id="errorworkphnExt"></span></label></br>
                                            <input type="text" name="workphnExt" id="workphnExt" maxlength="10" placeholder="Numeric Values Only" class="form-control" />
                                        </div>

                                        <div class="col-md-3">
                                            <label class="control-label">Date Of Birth<span class="not-required"></span></label></br>
                                            <input type="text" name="dob" id="dob" class="form-control" placeholder="DD/MM/YYYY" />
                                        </div>

                                        <div class="col-md-3">
                                            <label class="control-label">Marital Status<span class="not-required"></span></label></br>
                                            <select name="mStatus" id="mStatus" type="text" onchange="selectGuardName(this.value);" class="form-control">
                                                <option value="">Select</option>
                                                <option value="1">Unmarried</option>
                                                <option value="2">Married</option>
                                                <option value="3">Divorced</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label">Nationality<span class="not-required"></span></label></br>
                                            <select name="nationality" id="nationality" class="form-control">
                                                <option value=""></option>
                                                <?php
                                                $sql1="Select * from LOVMast where LOV_Field='NATIONALITY'";
                                                $res1=query($query,$sql1,$pa,$opt,$ms_db);
                                                while( $ro1 = $fetch($res1)){
                                                    ?>
                                                    <option value="<?php echo $ro1['LOV_Value'];?>"><?php echo $ro1['LOV_Text'];?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="col-md-3">
                                            <label class="control-label">Religion<span class="not-required"></span></label></br>
                                            <select name="religion" id="religion" class="form-control">
                                                <option value=""></option>
                                                <?php
                                                $sql1="Select * from LOVMast where LOV_Field='Religon'";
                                                $res1=query($query,$sql1,$pa,$opt,$ms_db);
                                                while( $ro1 = $fetch($res1)){
                                                ?>
                                                <option value="<?php echo $ro1['LOV_Value'];?>"><?php echo $ro1['LOV_Text'];?></option>
                                                <?php } ?>
                                            </select>

                                        </div>
                                        <div class="col-md-3" id="anndate" style="display:none;">
                                            <label class="control-label">Anniversary Date<span class="not-required"></span></label></br>
                                            <input name="annivdate" id="annivdate" type="text" class="form-control"/>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="control-label">Blood Group<span class="not-required"></span></label></br>
                                            <select name="bloodGroup" id="bloodGroup" class="form-control">
                                                <option value=""></option>
                                                <?php
                                                $sql1="Select * from LOVMast where LOV_Field='BloodGroup' order by LOV_Text asc";
                                                $res1=query($query,$sql1,$pa,$opt,$ms_db);
                                                while( $ro1 = $fetch($res1)){
                                                    ?>
                                                    <option value="<?php echo $ro1['LOV_Value'];?>"><?php echo $ro1['LOV_Text'];?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                                <div class="form-actions col-md-offset-10 col-md-3">
                                    <button type="submit" class="btn blue" onclick="return submitData('insert');">Save</button>
                                </div>

                        </div>
                        
                        <div class="tab-pane fade" id="tab_6_2">
                            <form name="updateEmpBankForm" id="updateEmpBankForm" action="#">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <label class="control-label"> Salary Bank<span class="required">
				                            * </span>
                                        </label></br>

                                        <select name="bankCode" id="bankCode" class="form-control input-medium select2me" data-placeholder="Select..." onchange="getBankIfsc(this.value);">
                                            <?php
                                            $sql= "select SV_CODE,SV_NAME from SVMast WHERE SV_Type='MOP' ";
                                            $result = query($query,$sql,$pa,$opt,$ms_db);

                                            echo"<option value=''></option>";

                                            while($row =$fetch($result)) {
                                                ?>
                                                <option value="<?php echo $row['SV_CODE'];?>"><?php echo $row['SV_NAME'];?>
                                                </option>
                                                <?php

                                            }
                                            ?>

                                        </select>

                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">IFSC Code<span class="required">
				                            * </span>
                                        </label></br>
                                        <input name="ifscCode" id="ifscCode" type="text" class="form-control"  readonly/>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Salary Account No.<span class="required" id="errSmopNo">
				                            * </span>
                                        </label></br>
                                        <input name="smopNo" id="smopNo" type="text" onkeyup="getTextLength('smopNo','19','errSmopNo');" class="form-control" placeholder="Numeric Values Only" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <label class="control-label">Reimbursement Bank<span class="required">* </span></label></br>
                                        <select name="reimbankCode" id="reimbankCode" class="form-control input-medium select2me" data-placeholder="Select..." onchange="getReimBankIfsc(this.value);">
                                            <?php
                                            $sql= "select SV_CODE,SV_NAME from SVMast WHERE SV_Type='RMOP' ";
                                            $result = query($query,$sql,$pa,$opt,$ms_db);

                                            echo"<option value=''></option>";
                                            while($row =$fetch($result)) {
                                                ?>
                                                <option value="<?php echo $row['SV_CODE'];?>"><?php echo $row['SV_NAME'];?>
                                                </option>
                                                <?php

                                            }
                                            ?>

                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">IFSC Code<span class="required">
				                            * </span>
                                        </label></br>
                                        <input name="reimIfsc" id="reimIfsc" type="text" class="form-control" value=""  readonly/>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Reimbursement Account No.<span class="required" id="errRmopNo">
				                            * </span>
                                        </label></br>
                                        <input name="rmopNo" id="rmopNo" type="text"  onkeyup="getTextLength('rmopNo','19','errRmopNo');"  placeholder="Numeric Values Only" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            </form>
                            <div class="form-actions col-md-offset-10 col-md-3">
                                <button type="button" class="btn blue" onclick="return submitBankData('bank_insert');">Save</button>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tab_6_3">
                            <form name="updateEmpStaturyForm" id="updateEmpStaturyForm" action="#">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <label class="control-label">UAN No.<span class="not-required" id="errUan" style="color: red;"></span></label></br>
                                        <input name="uanNo" id="uanNo" type="text"  onkeyup="getTextLength('uanNo','19','errUan');" class="form-control"/>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">PF No.<span class="required" id="errPfno" style="color: red;">* </span></label></br>
                                        <input name="PfNo" id="PfNo" type="text" onkeyup="getTextLength('PfNo','19','errPfno');" class="form-control"/>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">ESI No.<span class="required" id="errEsino" style="color: red;">
					                            * </span>
                                        </label></br>
                                        <input name="esiNo" id="esiNo" type="text" onkeyup="getTextLength('esiNo','19','errEsino');" class="form-control"/>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label" id="guard_label">Guardian Name<span class="not-required"id="errGuard" style="color: red;"></span>
                                        </label></br>
                                        <input name="gaurdian" id="gaurdian" type="text"  class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            </form>
                            <div class="form-actions col-md-offset-10 col-md-3">
                                <button type="button" class="btn blue" onclick="return submitStaturyData('statury_insert');">Save</button>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tab_6_4">
                            <form name="updateIdentityForm" id="updateIdentityForm" action="#">
                            <div class="presentAddress" style="padding-left:12px;"><h4 style="color:blue;">Passport Details</h4></div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <label class="control-label">Passport No.<span class="not-required" id="errPassno" style="color: red;">
				                             </span>
                                        </label></br>
                                        <input name="passportNo" id="passportNo" onkeyup="getTextLength('passportNo','19','errPassno');" type="text" class="form-control"/>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Place Of Issue<span class="not-required">
				                             </span>
                                        </label></br>
                                        <input name="passportPlace" id="passportPlace"  type="text" class="form-control"/>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Date Of Issue<span class="not-required">
				                             </span>
                                        </label></br>
                                        <input name="passportIssue" id="passportIssue" type="text" class="form-control"/>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Passport Validity<span class="not-required">
				                             </span>
                                        </label></br>
                                        <input name="passportValidityDate" id="passportValidityDate" type="text" class="form-control" placeholder="DD/MM/YYYY" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <label class="control-label">Address On Passport<span class="not-required">
				                             </span>
                                        </label></br>
                                        <input name="passportAddress" id="passportAddress"  type="text" class="form-control"/>
                                    </div>
                                 </div>
                            </div>

                            <div class="presentAddress" style="padding-left:12px;"><h4 style="color:blue;">Driving Details</h4></div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <label class="control-label">Driving Licence No.<span class="required" id="errDlno">
				                            * </span>
                                        </label></br>
                                        <input name="dlNo" id="dlNo" type="text" onkeyup="getTextLength('dlNo','19','errDlno');" class="form-control"/>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Place Of Issue<span class="not-required">
				                            </span>
                                        </label></br>
                                        <input name="dlPlace" id="dlPlace"  type="text" class="form-control"/>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Date Of Issue<span class="not-required">
				                            </span>
                                        </label></br>
                                        <input name="dlDate" id="dlDate" type="text" class="form-control" placeholder="DD/MM/YYYY" />
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">DL Validity<span class="required">
				                            * </span>
                                        </label></br>
                                        <input name="dlValidityDate" id="dlValidityDate" type="text" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <label class="control-label">Driving Licence Address<span class="required">
				                            * </span>
                                        </label></br>
                                        <input name="dlAddress" id="dlAddress"  type="text" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="presentAddress" style="padding-left:12px;"><h4 style="color:blue;">Others Details</h4></div>
                            <div class="form-group">
                                 <div class="col-md-12">
                                    <div class="col-md-3">
                                        <label class="control-label">PAN No.<span class="not-required" id="errPanno" style="color: red;">
				                             </span>
                                        </label></br>
                                        <input name="panNo" id="panNo" onkeyup="getTextLength('panNo','19','errPanno');" type="text" class="form-control"/>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Adhar Card No.<span class="not-required" id="errAdharno">
				                             </span>
                                        </label></br>
                                        <input name="adharNo" id="adharNo" onkeyup="getTextLength('adharNo','19','errAdharno');" type="text" class="form-control"/>
                                    </div>
                                     <div class="col-md-3">
                                         <label class="control-label">Registration No.<span class="not-required" id="errorRegistr"></span></label></br>
                                         <input name="registration" id="registration" onkeyup="getTextLength('registration','19','errorRegistr');" type="text" class="form-control"/>
                                     </div>

                                     <div class="col-md-3">
                                         <label class="control-label">Trade<span class="not-required"></span></label></br>
                                         <input name="trade" id="trade" type="text" class="form-control"/>
                                     </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <label class="control-label">Contract Type<span class="not-required"></span></label></br>
                                        <input name="contract" id="contract" type="text" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            </form>
                            <div class="form-actions col-md-offset-10 col-md-3">
                                <button type="button" class="btn blue" onclick="return submitIdentityData('identity_insert');">Save</button>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tab_6_5">
                            <form action="#" id="updatePersonalForm" class="updatePersonalForm">

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="col-md-3">
                                            <label class="control-label">Date Of Leaving<span class="not-required"></span></label></br>
                                            <input name="dol" id="dol" type="text" class="form-control" placeholder="DD/MM/YYYY" />
                                        </div>

                                        <div class="col-md-3">
                                            <label class="control-label">Leaving Reason<span class="not-required"></span></label></br>
                                            <input name="leavReas" id="leavReas" type="text" class="form-control" />
                                        </div>

                                        <div class="col-md-3">
                                            <label class="control-label">Date Of Settlement<span class="not-required"></span></label></br>
                                            <input name="dos" id="dos" type="text" class="form-control" placeholder="DD/MM/YYYY"/>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label">Date Of Resignation<span class="not-required"></span></label></br>
                                            <input name="dor" id="dor" type="text" class="form-control" placeholder="DD/MM/YYYY"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <label class="control-label">Employee Status <span class="not-required"></span></label></br>
                                        <select name="statusCode" id="statusCode" class="form-control">
                                            <option value="01">Active</option>
                                            <?php   $sql="select * from StatusMast";
                                            $result =  query($query,$sql,$pa,$opt,$ms_db);
                                            while($row = $fetch($result)) {
                                                ?>
                                                <option value="<?php echo $row['Status_Code'];?>"><?php echo $row['Status_Name'];?>
                                                </option>


                                            <?php  }?>
                                        </select>
                                    </div>

                                </div>

                            </div>

                            </form>
                            <div class="form-actions col-md-offset-10 col-md-3">
                                <button type="button" class="btn blue" onclick="return submitPersonalData('personal_insert');">Save</button>
                            </div>

                        </div>

                        <div class="tab-pane fade" id="tab_6_6">
                            <form id="updateContactForm" class="updateContactForm" action="#">
                            <div class="presentAddress" style="padding-left:12px;"><h4 style="color:blue;">Present Address</h4></div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <label class="control-label">House No<span class="required">
					                             </span>
                                        </label></br>
                                        <input name="mHNo" id="mHNo" type="text" class="form-control"/>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Street No.<span class="required">
					                             </span>
                                        </label></br>
                                        <input name="mStreetNo" id="mStreetNo" type="text" class="form-control" placeholder=""/>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Area<span class="required">
					                             </span>
                                        </label></br>
                                        <input name="mArea" id="mArea" type="text" class="form-control" placeholder=""/>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">City<span class="required">
					                             </span>
                                        </label></br>
                                        <input name="mCity" id="mCity" type="text" class="form-control"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <label class="control-label">Region<span class="required">
					                             </span>
                                        </label></br>
                                        <input name="mRegion" id="mRegion" type="text" class="form-control"/>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Local State<span class="required">
					                             </span>
                                        </label></br>
                                        <input name="mState" id="mState" type="text" class="form-control" placeholder=""/>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Country<span class="required">
					                             </span>
                                        </label></br>
                                        <input name="mCountry" id="mCountry" type="text" class="form-control" placeholder=""/>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Pincode<span class="required" id="errPin">
					                             </span>
                                        </label></br>
                                        <input name="mPin" id="mPin" type="text" onkeyup="getTextLength('mPin','6','errPin');"class="form-control" placeholder="Numeric Values Only"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <label class="control-label">Phone No.<span class="required" id="errphone">
					                            </span>
                                        </label></br>
                                        <input name="mPhoneNo" id="mPhoneNo" type="text" maxlength="20" class="form-control" placeholder="Numeric Values Only"/>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Personal EmailId<span class="required" id="errConEmaiil">
					                             </span>
                                        </label></br>
                                        <input name="pEMailId" id="pEMailId" type="text" onkeyup="validate.email('pEMailId','errConEmaiil');" class="form-control" placeholder=""/>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="control-label">Mobile No.<span class="required" id="errmobile">
					                             </span>
                                        </label></br>
                                        <input name="mobileNo" id="mobileNo" type="text" maxlength="20" class="form-control" placeholder="Numeric Values Only"/>
                                    </div>
                                </div>
                            </div>

                            <div class="permanentAddress" style="padding-left:12px;"><h4 style="color:blue;">Permanent Address</h4>
                                <input type="checkbox" name="permanenttoo" onclick="FillPermanent(this.form)">
                                <em>Check this box if Current Address and Permanent Address are the same.</em>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <label class="control-label">House No<span class="required">
					                             </span>
                                        </label></br>
                                        <input name="pHNo" id="pHNo" type="text" class="form-control"/>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Street No.<span class="required">
					                             </span>
                                        </label></br>
                                        <input name="pStreetNo" id="pStreetNo" type="text" class="form-control" placeholder=""/>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Area<span class="required">
					                             </span>
                                        </label></br>
                                        <input name="pArea" id="pArea" type="text" class="form-control" placeholder=""/>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">City<span class="required">
					                             </span>
                                        </label></br>
                                        <input name="pCity" id="pCity" type="text" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <label class="control-label">Region<span class="required">
					                             </span>
                                        </label></br>
                                        <input name="pRegion" id="pRegion" type="text" class="form-control"/>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">State<span class="required">
					                             </span>
                                        </label></br>
                                        <input name="pState" id="pState" type="text" class="form-control" placeholder=""/>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Country<span class="required">
					                             </span>
                                        </label></br>
                                        <input name="pCountry" id="pCountry" type="text" class="form-control" placeholder=""/>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Pincode<span class="required" id="errPPin">
					                             </span>
                                        </label></br>
                                        <input name="pPin" id="pPin" type="text" onkeyup="getTextLength('pPin','6','errPPin');" class="form-control" placeholder="Numeric Values Only"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <label class="control-label">Phone No.<span class="required" id="errpphone">
					                            </span>
                                        </label></br>
                                        <input name="pPhoneNo" id="pPhoneNo" type="text" maxlength="20" class="form-control" placeholder="Numeric Values Only"/>
                                    </div>
                                </div>
                            </div>
                            </form>
                            <div class="form-actions col-md-offset-10 col-md-3">
                                <button type="button" class="btn blue" onclick="return submitContactData('contact_insert');">Save</button>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab_6_7">

                            <div class="col-md-12 col-sm-12">
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-user"></i>Family Details
                                        </div>
                                        <div class="actions">
                                            <a href="#portlet-config" class="btn btn-default btn-sm" onclick="addFamily( );" data-toggle="modal">
                                                <i class="fa fa-pencil"></i> Add </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <table class="table table-striped table-bordered table-hover" id="sample_2">
                                            <thead>
                                            <tr>
                                                <th>Relative Name</th>
                                                <th>Relationship</th>
                                                <!--<th>Date Of Birth</th>-->
                                                <th>Dependent</th>
                                            </tr>
                                            </thead>
                                            <tbody id="viewData">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- END EXAMPLE TABLE PORTLET-->
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-user"></i>Nominee Details
                                        </div>
                                        <div class="actions">
                                            <a href="#portlet-config1" class="btn btn-default btn-sm"  onclick="addNominee( );" data-toggle="modal">
                                                <i class="fa fa-pencil"></i> Add </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <table class="table table-striped table-bordered table-hover" id="sample_2">
                                            <thead>
                                            <tr>
                                                <th>Nominee Name</th>
                                                <th>Relation</th>
                                               <!-- <th>Date Of Birth</th>
                                                <th>WEF</th>-->
                                                <th>PF Share %</th>
                                                <th>Gratuity Share %</th>
                                            </tr>
                                            </thead>
                                            <tbody id="viewData1">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- END EXAMPLE TABLE PORTLET-->
                            </div>
                            <!--Add Qualification Details-->
                            <div class="col-md-12 col-sm-12">
                                <div class="" id="errorQual" style="display: none;color: red;">First  Enter Employee Code</div>
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-user"></i>Qualification Details
                                        </div>
                                        <div class="actions">
                                            <a href="#portlet-config2" class="btn btn-default btn-sm"  onclick="addQual( );" data-toggle="modal">
                                                <i class="fa fa-pencil"></i> Add </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <table class="table table-striped table-bordered table-hover" id="sample_2">
                                            <thead>
                                            <tr>
                                                <th>Qualification</th>
                                                <th>From</th>
                                                <th>To</th>
                                                <th>Specialization</th>
                                                <th>University</th>
                                                <th>City</th>
                                                <th>Grade/Division</th>
                                                <th>Subjects</th>
                                            </tr>
                                            </thead>
                                            <tbody id="viewData2">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- END EXAMPLE TABLE PORTLET-->
                            </div>
                            <!--Add Language Details-->
                            <div class="col-md-12 col-sm-12">
                                <div class="" id="errorLang" style="display: none;color: red;">First  Enter Employee Code</div>
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-user"></i>Language Details
                                        </div>
                                        <div class="actions">
                                            <a href="#portlet-config3" class="btn btn-default btn-sm" onclick="addLang( );" data-toggle="modal">
                                                <i class="fa fa-pencil"></i> Add </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <table class="table table-striped table-bordered table-hover" id="sample_2">
                                            <thead>
                                            <tr>
                                                <th> Language</th>
                                                <th> Read</th>
                                                <th>Write</th>
                                                <th> Speak</th>
                                                <th>Understand</th>
                                                <th>Mother Tongue</th>
                                            </tr>
                                            </thead>
                                            <tbody id="viewData3">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- END EXAMPLE TABLE PORTLET-->
                            </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>