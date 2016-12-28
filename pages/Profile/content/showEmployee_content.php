<div class="page-content-wrapper">
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

        <div class="modal fade" id="portlet-configEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title" style="color:blue;">Edit Relative Details</h4>
                    </div>
                    <div class="modal-body" id="portlet-configEditbody">
                        <?php //include "content/editFamily_content.php" ?>
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
                    <div class="modal-body" id="portlet-configAdd2tbody" >
                        <?php //include "content/addQualification_content.php" ?>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>


        <div class="modal fade" id="portlet-configEdit2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title" style="color:blue;">Edit Qualification Details</h4>
                    </div>
                    <div class="modal-body" id="portlet-configEdit2tbody">
                        <?php //include "content/editQualification_content.php" ?>
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
                        <?php //include "content/addLanguage_content.php" ?>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>


        <div class="modal fade" id="portlet-configEdit3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title" style="color:blue;">Edit Language Details</h4>
                    </div>
                    <div class="modal-body" id="portlet-configEdit3tbody">
                        <?php// include "content/editLanguage_content.php" ?>
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
                        <?php// include "content/addNominee_content.php" ?>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>


        <div class="modal fade" id="portlet-configEdit1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title" style="color:blue;">Edit Nominee Details</h4>

                    </div>
                    <div class="modal-body" id="portlet-configEdit1tbody">
                        <?php// include "content/editNominee_content.php" ?>
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
            <i class="fa fa-gift"></i>Edit Employee
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse">
            </a>
            <a href="#portlet-config" data-toggle="modal" class="config">
            </a>
        </div>
    </div>
</div>



<!-- BEGIN PAGE CONTENT-->
<div class="row">

    <div class="col-md-12">
        <!-- BEGIN PROFILE SIDEBAR -->
        <?php $empCode=$_GET['oempCode'];
        $det="select * from hrdmastqry where Emp_Code='$empCode'";
        $details=query($query,$det,$pa,$opt,$ms_db);
        $row3=$fetch($details);
        ?>
        <div class="profile-sidebar" style="width:250px;">
            <!-- PORTLET MAIN -->
            <div class="portlet light profile-sidebar-portlet" >
                <div id="profilePic" >
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic" >
                </div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name">
                       <?php echo $row3['Emp_FName'] ." ". $row3['Emp_MName']." ".$row3['Emp_LName'] ;?>
                    </div>
                    <div >
                        <?php echo $empCode;?>
                    </div>
                    <div class="profile-usertitle-job">
                        <?php echo $row3['DSG_NAME'];?>
                    </div>
                </div>
                </div>
                <!-- END SIDEBAR USER TITLE -->
                <!-- SIDEBAR BUTTONS -->
                <div class="profile-userbuttons">
                    
                    <!-- <button type="button" onclick="showImage();" class="btn btn-circle green-haze ">Edit</button> -->
                </div>
                <!-- END SIDEBAR BUTTONS -->
                <!-- SIDEBAR MENU -->
                <div class="profile-usermenu">
                    <ul class="nav">
                        <li onclick="showPersonal();" id="pers_info" >
                            <a href="#" >
                                <i class="icon-home"></i>
                                Personal Information </a>
                        </li>
                        <li onclick="showOfficial();" id="offi_detail">
                            <a href="#">
                                <i class="icon-settings"></i>
                                Official Information</a>
                        </li>
                    </ul>
                </div>
                <!-- END MENU -->
            </div>
            <!-- END PORTLET MAIN -->

        </div>
        <!-- END BEGIN PROFILE SIDEBAR -->
        <!-- BEGIN PROFILE CONTENT -->
        <div class="profile-content" style="display: block;" id="personal_info">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light">
                        <div class="portlet-title tabbable-line">

                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab_1_1" data-toggle="tab">Personal Info</a>
                                </li>
                                <li>
                                    <a href="#tab_1_2" data-toggle="tab">Contact Information</a>
                                </li>
                                <li>
                                    <a href="#tab_1_3" data-toggle="tab">Others Information</a>
                                </li>
                            </ul>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                <!-- PERSONAL INFO TAB -->
                                <div class="tab-pane active" id="tab_1_1">
                                    <form role="form" id="editPersForm" action="#">
                                        <?php   $empCode= $_GET['oempCode'];
                                        // echo $empCode;
                                        $sql1 = "select *,convert(varchar(10),DOB,103) as DOB,convert(varchar(10),DOC,103) as DOC,convert(varchar(10),DOJ,103)as DOJ,CONVERT (VARCHAR (10),Anniversary,103)as Anniversary from HrdMastQry WHERE Emp_Code='$empCode'";
                                        $result1 = query($query,$sql1,$pa,$opt,$ms_db);
                                        $row = $fetch($result1);
                                        ?>
                                        <div class="form-group" id="FMname" style="display:none;">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label class="control-label">Title<span class="not-required"></span></label>
                                                    <select name="emptitle" id="emptitle" class="form-control">
                                                        <option value=""></option>
                                                        <?php   $sql="Select * from LOVMast where LOV_Field='title'";
                                                        $res=query($query,$sql,$pa,$opt,$ms_db);
                                                        while( $ro = $fetch($res)){
                                                            ?>
                                                            <option <?php if($row['Emp_Title'] == $ro['LOV_Value']) {echo "Selected";}?> value="<?php echo $ro['LOV_Value'];?>"><?php echo $ro['LOV_Text'];?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="control-label">First Name</label>
                                                    <input type="text" placeholder="First Name" name="empFName" id="fname" value="<?php echo $row['Emp_FName'];?>" class="form-control" readonly/>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="control-label">Middle Name</label>
                                                    <input type="text" placeholder="Middle Name" id="mname" name="empMName" value="<?php echo $row['Emp_MName'];?>" class="form-control" readonly/>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6" id="Lname" style="display: none;">
                                                    <label class="control-label">last Name</label>
                                                    <input type="text" class="form-control" value="<?php echo $row['Emp_LName'];?>" name="empLName" id="lname" readonly>
                                                </div>
                                                <div class="col-md-6" id="fullName" style="display: block;">
                                                    <label class="control-label">Full Name</label>
                                                    <input type="text" class="form-control" value="<?php echo $row['Emp_FName'] ." ". $row['Emp_MName'] ." ". $row['Emp_LName'];?>" name="fLName"  readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="control-label">Gender<span class="required">* </span></label></br>
                                                    <select name="sex" id="sex" class="form-control" disabled>
                                                        <option value=""></option>
                                                        <option <?php if($row['Sex']== 1){ echo "selected";}  ?> value="1">Male</option>
                                                        <option <?php if($row['Sex']== 2){ echo "selected";}  ?> value="2">Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="control-label">Marital Status<span class="not-required"></span></label></br>
                                                    <select name="mStatus" id="mStatus" type="text" onchange="selectGuardName(this.value);" class="form-control" disabled>
                                                        <option value=""></option>
                                                        <option <?php if($row['MStatus']== 1){ echo "selected";}  ?> value="1">Unmarried</option>
                                                        <option <?php if($row['MStatus']== 2){ echo "selected";}  ?> value="2">Married</option>
                                                        <option <?php if($row['MStatus']== 3){ echo "selected";}  ?> value="3">Divorced</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="control-label">Nationality<span class="not-required"></span></label></br>
                                                    <select name="nationality" id="nationality" class="form-control" disabled>
                                                        <option value=""></option>
                                                        <?php
                                                        $sql1="Select * from LOVMast where LOV_Field='NATIONALITY'";
                                                        $res1=query($query,$sql1,$pa,$opt,$ms_db);
                                                        while( $ro1 = $fetch($res1)){
                                                            ?>
                                                            <option <?php if($row['Nationality'] ==$ro1['LOV_Value'] ){echo "Selected";}?> value="<?php echo $ro1['LOV_Value'];?>"><?php echo $ro1['LOV_Text'];?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-group" style="">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="control-label">Date Of Birth<span class="not-required"></span></label></br>
                                                    <input type="text" name="dob" id="dob" value="<?php echo $row['DOB'];?>" class="form-control" placeholder="DD/MM/YYYY" disabled/>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="control-label">Religion<span class="not-required"></span></label></br>
                                                    <select name="religion" id="religion" class="form-control" disabled>
                                                        <option value=""></option>
                                                        <?php
                                                        $sql1="Select * from LOVMast where LOV_Field='Religon'";
                                                        $res1=query($query,$sql1,$pa,$opt,$ms_db);
                                                        while( $ro1 = $fetch($res1)){
                                                            ?>
                                                            <option <?php if($row['Religion'] ==$ro1['LOV_Value'] ){echo "Selected";}?> value="<?php echo $ro1['LOV_Value'];?>"><?php echo $ro1['LOV_Text'];?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <?php if($row['MStatus']== 2){?>
                                                    <div class="col-md-6">
                                                    <label class="control-label">Anniversary Date<span class="not-required"></span></label></br>
                                                    <input name="annivdate" id="annivdate" type="text"  value="<?php echo $row['Anniversary'];?>" class="form-control" readonly/>
                                                </div>
                                               <?php }else{
                                                ?>
                                                <div class="col-md-6" id="anndate" style="display:none;">
                                                    <label class="control-label">Anniversary Date<span class="not-required"></span></label></br>
                                                    <input name="annivdate" id="annivdate" type="text"  value="<?php echo $row['Anniversary'];?>" class="form-control" readonly/>
                                                </div>
                                                <?php }?>
                                                <div class="col-md-6">
                                                    <label class="control-label">Blood Group<span class="not-required"></span></label></br>
                                                        <select name="bloodGroup" id="bloodGroup" class="form-control" disabled>
                                                            <option value=""></option>
                                                            <?php
                                                            $sql1="Select * from LOVMast where LOV_Field='BloodGroup'";
                                                            $res1=query($query,$sql1,$pa,$opt,$ms_db);
                                                            while( $ro1 = $fetch($res1)){
                                                                ?>
                                                                <option <?php if($row['BloodGroup'] == $ro1['LOV_Value'] ) echo "selected";?> value="<?php echo $ro1['LOV_Value'];?>"><?php echo $ro1['LOV_Text'];?></option>
                                                            <?php } ?>
                                                        </select>
                                                </div>
                                                <?php if($row['MStatus']== 2){?>
                                                <div class="col-md-6">
                                                    <label class="control-label" id="guard_label">Spouse Name<span class="not-required"></span></label></br>
                                                    <input name="gaurdian" id="gaurdian" type="text" value="<?php echo $row['GuardianName'];?>" class="form-control" readonly/>
                                                </div>
                                                <?php }else{?>
                                                    <div class="col-md-6">
                                                        <label class="control-label" id="guard_label">Guardian Name<span class="not-required"></span></label></br>
                                                        <input name="gaurdian" id="gaurdian" type="text" value="<?php echo $row['GuardianName'];?>" class="form-control" readonly/>
                                                    </div>

                                                <?php }?>
                                            </div>

                                        </div>


                                        <!-- <div class="col-md-offset-9 margiv-top-10">
                                            <a href="#" onclick="perEnableTexts();" id="editButton" style="display: block;" class="btn btn-block green-haze">
                                                Edit  </a>
                                            <a href="#" class="btn btn-block green-haze" id="submitButton" onclick="submitPerInfo('<?php echo $_GET['oempCode'];?>');" style="display: none;">
                                                Submit </a>
                                        </div> -->
                                    </form>
                                </div>

                                <!-- Start Contact Information  -->
                                <div class="tab-pane" id="tab_1_2">
                                    <div class="presentAddress" style="padding-left:12px;"></div>
                                    <form role="form" id="editContactForm" action="#">
                                        <div class="form-group">
                                            <div class="col-md-12" style="padding-left:12px;">
                                                <h4 style="color:blue;">Current Address</h4>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="control-label">House No<span class="required">                                                 </span>
                                                    </label></br>
                                                    <input name="mHNo" id="mHNo" type="text" value="<?php echo $row['MAddr3'];?>" class="form-control" readonly/>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="control-label">Street No.<span class="required">                                               </span>
                                                    </label></br>
                                                    <input name="mStreetNo" id="mStreetNo" type="text" value="<?php echo $row['MAddr1'];?>" class="form-control" placeholder="" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="control-label">Area<span class="required">                                                 </span>
                                                    </label></br>
                                                    <input name="mArea" id="mArea" type="text" value="<?php echo $row['MArea'];?>" class="form-control" placeholder="" readonly/>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="control-label">City<span class="required">                                                 </span>
                                                    </label></br>
                                                    <input name="mCity" id="mCity" type="text" value="<?php echo $row['MCity'];?>" class="form-control" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="control-label">District<span class="required">                                               </span>
                                                    </label></br>
                                                    <input name="mRegion" id="mRegion" type="text" value="<?php echo $row['MRegion'];?>" class="form-control" readonly/>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="control-label">Local State<span class="required">                                              </span>
                                                    </label></br>
                                                    <input name="mState" id="mState" type="text" value="<?php echo $row['MState'];?>" class="form-control" placeholder="" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="control-label">Country<span class="required">                                              </span>
                                                    </label></br>
                                                    <input name="mCountry" id="mCountry" type="text" value="<?php echo $row['MCountry'];?>" class="form-control" placeholder="" readonly/>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="control-label">Pincode<span class="required" id="errPin">                                              </span>
                                                    </label></br>
                                                    <input name="mPin" id="mPin" type="text" value="<?php echo $row['MPin'];?>" placeholder="Numeric Values only" maxlength="6" class="form-control" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="control-label">Phone No.<span class="required" id="errphone"></span>
                                                    </label></br>
                                                    <input name="mPhoneNo" id="mPhoneNo"  type="text" value="<?php echo $row['MPhoneNo'];?>" maxlength="20" placeholder="Numeric Values only"  class="form-control" readonly/>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="control-label">Personal EmailId<span class="required" id="erroremail"></span>
                                                    </label></br>
                                                    <input name="pEMailId" id="pEMailId" onkeyup="validate.email('pEMailId','erroremail');" type="text" value="<?php echo $row['PEMailID'];?>" class="form-control" placeholder="" readonly/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                            <div class="col-md-12">
                                                <label class="control-label">Mobile No.<span class="required" id="errmobile">                                                </span>
                                                </label></br>
                                                <div class="col-md-6" style="padding-left: 0px;">
                                                <input name="mobileNo" id="mobileNo" type="text" placeholder="Numeric Values only" maxlength="20" value="<?php echo $row['MobileNo'];?>" class="col-md-6 form-control" readonly/>
                                                 </div>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                        <div class="col-md-12" style="padding-left:12px;">
                                        <h4 style="color:blue;">Permanent Address</h4>
                                            <input type="checkbox" name="permanenttoo" onclick="FillPermanent(this.form)">
                                            <em>Check this box if Current Address and Permanent Address are the same.</em>

                                        </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                            <div class="col-md-6">
                                                <label class="control-label">House No<span class="required">                                                 </span>
                                                </label></br>
                                                <input name="pHNo" id="pHNo" type="text" value="<?php echo $row['PAddr1'];?>" class="form-control" readonly/>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="control-label">Street No.<span class="required">                                               </span>
                                                </label></br>
                                                <input name="pStreetNo" id="pStreetNo" type="text" value="<?php echo $row['PAddr2'];?>" class="form-control" placeholder="" readonly/>
                                            </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                            <div class="col-md-6">
                                                <label class="control-label">Area<span class="required">                                                 </span>
                                                </label></br>
                                                <input name="pArea" id="pArea" type="text" value="<?php echo $row['PAddr3'];?>" class="form-control" placeholder="" readonly/>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="control-label">City<span class="required">                                                 </span>
                                                </label></br>
                                                <input name="pCity" id="pCity" type="text" value="<?php echo $row['PCity'];?>" class="form-control" readonly/>
                                            </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                            <div class="col-md-6">
                                                <label class="control-label">District<span class="required">                                               </span>
                                                </label></br>
                                                <input name="pRegion" id="pRegion" maxlength="20" type="text" value="<?php echo $row['PRegion'];?>" class="form-control" readonly/>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="control-label">State<span class="required">                                                </span>
                                                </label></br>
                                                <input name="pState" id="pState" type="text" value="<?php echo $row['PState'];?>" class="form-control" placeholder="" readonly/>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                            <div class="col-md-6">
                                                <label class="control-label">Country<span class="required">                                              </span>
                                                </label></br>
                                                <input name="pCountry" id="pCountry" type="text" value="<?php echo $row['PCountry'];?>" class="form-control" placeholder="" readonly/>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="control-label">Pincode<span class="required" id="errPPin">                                                 </span>
                                                </label></br>
                                                <input name="pPin" id="pPin" type="text" placeholder="Numeric Values only" maxlength="6" value="<?php echo $row['PPin'];?>" class="form-control" readonly/>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                            <div class="col-md-12">
                                            <div class="col-md-6" style="padding-left: 0px;">
                                                <label class="control-label">Phone No.<span class="required" id="errpphone">                                                </span>
                                                </label></br>
                                                <input name="pPhoneNo" id="pPhoneNo" type="text" placeholder="Numeric Values only" maxlength="20" value="<?php echo $row['PPhoneNo'];?>" class="col-md-6 form-control" readonly/>
                                            </div>
                                            </div>

                                            </div>
                                        </div>


                                        <!-- <div class="col-md-offset-9 margiv-top-10">
                                            <a href="#" onclick="contactEnableTexts();" id="editContactButton" style="display: block;" class="btn btn-block green-haze">
                                                Edit  </a>
                                            <a href="#" class="btn btn-block green-haze" id="submitContactButton" onclick="submitContactInfo('<?php echo $_GET['oempCode'];?>');" style="display: none;">
                                                Submit </a>
                                        </div> -->


                                    </form>
                                </div>
                                <!-- End Contact Information  -->
                                <div class="tab-pane" id="tab_1_3">
                                    <form action="#">
                                        <div class="form-group">
                                            <div class="row">
                                            <div class="col-md-12 col-sm-12">
                                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                                <div class="portlet box blue">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            <i class="fa fa-user"></i>Family Details
                                                        </div>
                                                        <!-- <div class="actions"><?php $empCode= $_GET['oempCode'];?>
                                                            <a href="#portlet-config" class="btn btn-default btn-sm" onclick="addFamily('<?php echo $empCode;?>');" data-toggle="modal">
                                                                <i class="fa fa-pencil"></i> Add </a>
                                                        </div> -->
                                                    </div>
                                                    <div class="portlet-body">
                                                        <table class="table table-striped table-bordered table-hover" id="sample_2">
                                                            <thead>
                                                            <tr>
                                                                <th>Relative Name</th>
                                                                <th>Relationship</th>
                                                                <th>Dependent</th>
                                                                <th>Action</th>
                                                            </tr>
                                                            </thead>
                                                           <!-- <tbody id="viewData">
                                                            </tbody>-->
                                                            <tbody id="viewData">
                                                            <?php
                                                            $empCode= $_GET['oempCode'];
                                                           // echo $empCode;
                                                            $sql1 = "select a.*,b.LOV_text from (select *,CONVERT (varchar(10),Relative_DOB,103)as DOB from HrdFamily where Emp_Code= '$empCode') a inner join lovmast b on a.relation=b.lov_value and b.LOV_Field='nominee'";
                                                            $result1 = query($query,$sql1,$pa,$opt,$ms_db);
                                                            $row_count = $num( $result1 );
                                                            if ($row_count > 0) {
                                                                while ($row = $fetch($result1)) { ?>
                                                                    <tr class='odd gradeX'>
                                                                        <td><?php echo  $row['Relative_Name'];?></td>
                                                                        <td><?php echo $row['LOV_text'];?></td>
                                                                        <td><?php if($row['Dependent'] == 1){echo "Yes";}else{ echo "No";}?></td>
                                                                        <td> <!--<a href="#portlet-configEdit" class="btn btn-default btn-sm" onclick="editFamily(<?php// echo $row['hrdfamilyID'];?>)" data-toggle="modal">
                                                                                <!--<i class="fa fa-pencil"></i> Edit </a>--></td>
                                                                    </tr>
                                                          <?php }

                                                            }
                                                             else {?>
                                                                 <tr>
                                                               <td> <?php echo "No Family Details available .Please add ";?> </td>
                                                                     <td></td>
                                                                     <td></td>
                                                                     <td></td>
                                                                 </tr>
                                                          <?php  }
                                                            ?>

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
                                                           <!--  <a href="#portlet-config1" class="btn btn-default btn-sm" onclick="addNominee('<?php echo $_GET['oempCode'];?>');" data-toggle="modal">
                                                                <i class="fa fa-pencil"></i> Add </a> -->
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body">
                                                        <table class="table table-striped table-bordered table-hover" id="sample_2">
                                                            <thead>
                                                            <tr>
                                                                <th>Nominee Name</th>
                                                                <th>Relation</th>
                                                                <th>PF Share %</th>
                                                                <th>Gratuity Share %</th>
                                                                <th>Action</th>
                                                            </tr>
                                                            </thead>
                                                            <!--<tbody id="viewData1">
                                                            </tbody>-->
                                                            <tbody id="viewData1">
                                                            <?php
                                                            $empCode= $_GET['oempCode'];
                                                            $sql1 = "select a.* , b.LOV_text from (select *,CONVERT (varchar(10),Nominee_DOB,103)as DOB,CONVERT (varchar(10),Nominee_WEF,103)as WEF from Nominee where Emp_Code= '$empCode' ) a inner join lovmast b on a.Nominee_Relation=b.lov_value and b.LOV_Field='nominee'";
                                                            $result1 = query($query,$sql1,$pa,$opt,$ms_db);
                                                            $row_count = $num( $result1 );
                                                            if ($row_count > 0) {
                                                                while ($row = $fetch($result1)) { ?>
                                                                    <tr class='odd gradeX'>
                                                                        <td><?php echo  $row['Nominee_Name'];?></td>
                                                                        <td><?php echo $row['LOV_text'];?></td>
                                                                        <td><?php echo $row['Nominee_Addr1'];?></td>
                                                                        <td><?php echo $row['Nominee_Addr2'];?></td>
                                                                        <td><td><!-- <a href="#portlet-configEdit1" class="btn btn-default btn-sm" onclick="editNominee(<?= $row['NomineeID']?>);" data-toggle="modal">-->
                                                                                <!--<i class="fa fa-pencil"></i> Edit </a>--></td></td>
                                                                    </tr>
                                                                <?php }

                                                            }
                                                            else {?>
                                                                <tr>
                                                                    <td> <?php echo "No Nominee Details available .Please add ";?> </td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                            <?php  }
                                                            ?>

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
                                                           <!--  <a href="#portlet-config2" class="btn btn-default btn-sm" onclick="addQual('<?php echo $_GET['oempCode']; ?>');" data-toggle="modal">
                                                                <i class="fa fa-pencil"></i> Add </a> -->
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body">
                                                        <table class="table table-striped table-bordered table-hover" id="sample_2">
                                                            <thead>
                                                            <tr>
                                                                <th>Specialization</th>
                                                                <th>From</th>
                                                                <th>To</th>
                                                                <th>College</th>
                                                                <th>Subjects</th>
                                                                <th>Action</th>
                                                            </tr>
                                                            </thead>
                                                            <!--<tbody id="viewData2">
                                                            </tbody>-->
                                                            <tbody>
                                                            <?php
                                                            $empCode= $_GET['oempCode'];
                                                            $sql1 = "select a.*,convert(varchar(20),a.Qual_From,103)as Qual_From,convert(varchar(20),a.Qual_to,103)as Qual_to ,b.Qual_Name from (Select * FROM HrdQual) a join QualMast b on a.Qual_Code=b.QualID WHERE a.Emp_Code='$empCode'";
                                                            $result1 = query($query,$sql1,$pa,$opt,$ms_db);
                                                            $row_count = $num( $result1 );
                                                            if ($row_count > 0) {
                                                                while ($row = $fetch($result1)) { ?>
                                                                    <tr class='odd gradeX'>
                                                                        <td><?php echo $row['Qual_Special'];?></td>
                                                                        <td><?php echo $row['Qual_From'];?></td>
                                                                        <td><?php echo $row['Qual_to'];?></td>
                                                                        <td><?php echo $row['College'];?></td>
                                                                        <td><?php echo $row['Subjects'];?></td>
                                                                        <td> <!--<a href="#portlet-configEdit2" class="btn btn-default btn-sm" onclick="editQualification(<?php// echo $row['QualID'];?>);" data-toggle="modal">
                                                                              <!--  <i class="fa fa-pencil"></i> Edit </a>--></td>
                                                                    </tr>
                                                                <?php }

                                                            }
                                                            else {?>
                                                                <tr>
                                                                    <td> <?php echo "No Nominee Details available .Please add ";?> </td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                            <?php  }
                                                            ?>
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
                                                            <!-- <a href="#portlet-config3" class="btn btn-default btn-sm"onclick="addLang('<?php echo $_GET['oempCode'];?>');" data-toggle="modal">
                                                                <i class="fa fa-pencil"></i> Add </a> -->
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
                                                                <th>Action</th>
                                                            </tr>
                                                            </thead>
                                                           <!-- <tbody id="viewData3">
                                                            </tbody>-->
                                                            <tbody >
                                                            <?php
                                                            $empCode= $_GET['oempCode'];
                                                            $sql1 = "select a.*,b.LOV_Text,b.LOV_Value from (select * from ResLanguges where Emp_Code='$empCode') a inner join lovmast b on a.Languge=b.lov_value and b.LOV_Field='languge' ";
                                                            $result1 = query($query,$sql1,$pa,$opt,$ms_db);
                                                            $row_count = $num( $result1 );
                                                            //$row = $fetch($result1);
                                                            if ($row_count > 0) {
                                                                while ($row = $fetch($result1)) { ?>
                                                                    <tr class='odd gradeX'>
                                                                        <td><?php echo $row['LOV_Text'];?></td>
                                                                        <td><?php echo $row['Read_YN'];?></td>
                                                                        <td><?php echo $row['Write_YN'];?></td>
                                                                        <td><?php echo $row['Speak_YN'];?></td>
                                                                        <td><?php echo $row['understand'];?></td>
                                                                        <td><?php echo $row['motherTongue'];?></td>
                                                                        <td><td><!-- <a href="#portlet-configEdit3" class="btn btn-default btn-sm"  onclick="editLanguage(<?php //echo $row['ResLangugesID'];?>);" data-toggle="modal">
                                                                              <!--  <i class="fa fa-pencil"></i> Edit </a>--></td></td>
                                                                    </tr>
                                                                <?php }

                                                            }
                                                            else {?>
                                                                <tr>
                                                                    <td> <?php echo "No Language Details available .Please add ";?> </td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                            <?php  }
                                                            ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <!-- END EXAMPLE TABLE PORTLET-->
                                            </div>
                                            <!--end profile-settings-->
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- END PRIVACY SETTINGS TAB -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PROFILE CONTENT -->

        <!-- BEGIN Official Details-->

                    <?php
                    $sql2 = "select *,convert(varchar(10),DOB,103) as DOB,convert(varchar(10),DOJ_WEF,103) as DOJ_WEF,convert(varchar(10),DOJ,103)as DOJ ,
                    convert(varchar(10),DOL,103)as DOL,convert(varchar(10),DOS,103)as DOS,convert(varchar(10),DOR,103)as DOR,convert(varchar(10),HRD_TRN_WEF,103)as WEF,CONVERT (varchar(10),DIssueDate,103) as DIssueDate, CONVERT (varchar(10),PIssueDate,103)as PIssueDate,CONVERT (varchar(10),DIssueDate,103) as DIssueDate, CONVERT (varchar(10),PIssueDate,103)as PIssueDate, 
                    CONVERT(varchar(10),PassportValidityDate,103 )AS PassportValidityDate,CONVERT(varchar(10),PassportValidityDate,103 )AS PassportValidityDate,CONVERT(varchar(10),DLValidityDate,103 )AS DLValidityDate  from HrdMastQry WHERE Emp_Code='$empCode'";
                    $result2 = query($query,$sql2,$pa,$opt,$ms_db);
                    $row2 = $fetch($result2);
                    ?>

         <div class="profile-content" style="display: none;" id="official_details">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light">
                        <div class="portlet-title tabbable-line">

                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab_1_4" data-toggle="tab">Official Details</a>
                                </li>
                                <li>
                                    <a href="#tab_1_5" data-toggle="tab"> Bank Details</a>
                                </li>
                                <li>
                                    <a href="#tab_1_6" data-toggle="tab">Identity Details</a>
                                </li>
                                <li>
                                    <a href="#tab_1_8" data-toggle="tab"> Seperation Information</a>
                                </li>
                                <li>
                                    <a href="#tab_1_7" data-toggle="tab">Statury Details</a>
                                </li>

                            </ul>
                        </div>
                        <input type="hidden" id="empCode" value="<?php echo $_GET['oempCode'];?>">
                        <div class="portlet-body">
                            <div class="tab-content">
                                <!-- officialINFO TAB -->
                                 <div class="tab-pane active" id="tab_1_4">
                                            <form role="form" id="editOfficialForm" class="form-horizontal" action="#">
                                                <div class="" style="display:block;">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label class="control-label">Employee Code <span class="required">* </span></label></br>
                                                            <input type="text" name="empCode1" id="empCode1" value="<?php echo $_GET['oempCode'];?>" maxlength="20" class="input-medium form-control input-medium" readonly onchange="getEmpCode();"/>
                                                            <span class="help-block" id="errorempcode" style="display: none; color: red;">Please eter different Employee Code</span>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <label class="control-label">Date Of Joining <span class="required"></span></label></br>
                                                            <input type="text" name="doj" id="doj" disabled value="<?php echo $row2['DOJ']; ?>"  placeholder="DD/MM/YYYY" class="input-medium form-control"/>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label class="control-label">Date Of Confirmation<span class="not-required"></span></label></br>
                                                            <input name="dojWef" id="dojWef" type="text" disabled value="<?php echo $row2['DOJ_WEF']; ?>"  class="input-medium form-control" placeholder="DD/MM/YYYY"/>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label class="control-label">Function Supervisor</label>
                                                            <div class="col-md-12" style="padding: 0;">
                                                                <select class="form-control input-medium select2me" name="function_supervisor" id="function_supervisor" data-placeholder="Select..." disabled>
                                                                    <option value=""></option>
                                                                    <?php
                                                                    $sql="select Emp_Code,EMP_NAME from HrdMastQry";
                                                                    $resultq=query($query,$sql,$pa,$opt,$ms_db);
                                                                    while($data = $fetch($resultq)) {
                                                                        ?>
                                                                        <option <?php if($row2['MNGR_CODE2']== $data['Emp_Code']){echo "selected";}?> value="<?php echo $data['Emp_Code'];?>"><?php echo $data['EMP_NAME'];?> <?php echo " (".$data['Emp_Code'].")";?> 
                                                                        </option>
                                                                        <?php

                                                                    }?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label class="control-label">Reporting To</label>
                                                            <div class="col-md-12" style="padding: 0;">
                                                                <select class="form-control input-medium select2me " name="global_manager" id="global_manager" data-placeholder="Select..." disabled>
                                                                    <option value=""></option>
                                                                    <?php
                                                                   $sql="select Emp_Code,EMP_NAME from HrdMastQry";
                                                                    $resultq=query($query,$sql,$pa,$opt,$ms_db);
                                                                    while($data = $fetch($resultq)) {
                                                                        ?>
                                                                        <option <?php if($row2['MNGR_CODE']== $data['Emp_Code']){echo "selected";}?> value="<?php echo $data['Emp_Code'];?>"><?php echo $data['EMP_NAME'];?> <?php echo " (".$data['Emp_Code'].")";?> 
                                                                        </option>
                                                                        <?php

                                                                    }?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label class="control-label">Company<span class="required">* </span></label></br>
                                                            <select name="compCode" id="compCode" class="form-control input-medium select2me" data-placeholder="Select..." disabled>
                                                                <option value=""></option>
                                                                <?php $sql="Select * from CompMast";
                                                                $result = query($query,$sql,$pa,$opt,$ms_db);
                                                                if ($num($result) > 0) {
                                                                    while($data = $fetch($result)) { ?>
                                                                        <option <?php if($row2['COMP_CODE'] == $data['COMPID']){echo "Selected";}?> value="<?php echo $data['COMPID']; ?>" ><?php echo $data['COMP_NAME'];?></option>

                                                                    <?php }}
                                                                ?>
                                                            </select>
                                                            <input type="hidden" name="compCode" value="<?php echo $row2['COMP_CODE'];?>">
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label class="control-label">Business Unit<span class="required"></span></label></br>
                                                            <select name="bussCode" id="bussCode" class="form-control input-medium select2me" data-placeholder="Select..." disabled>
                                                                <option value=""></option>
                                                                <?php $sql="Select BUSSID, BussName from BussMast";
                                                                $result = query($query,$sql,$pa,$opt,$ms_db);
                                                                if ($num($result) > 0) {
                                                                    $list="";
                                                                    while($data =$fetch($result)) {?>
                                                                        <option <?php if($row2['BussCode']== $data['BUSSID']){echo "Selected";}?> value="<?php echo $data['BUSSID']; ?>"> <?php echo $data['BussName'];?></option>

                                                                    <?php }}
                                                                ?>
                                                            </select>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label class="control-label">Location<span class="required"></span></label></br>
                                                            <select name="locCode" id="locCode" class="form-control input-medium select2me" data-placeholder="Select..." disabled>
                                                                <option value=""></option>
                                                                <?php $sql="Select LOCID, LOC_NAME from LocMast";
                                                                $result = query($query,$sql,$pa,$opt,$ms_db);
                                                                if ($num($result) > 0) {
                                                                    $list="";
                                                                    while($data =$fetch($result)) {?>
                                                                        <option <?php if($row2['LOC_CODE']== $data['LOCID']){echo "Selected";}?> value=<?php echo $data['LOCID'];?> ><?php echo $data['LOC_NAME'];?></option>;
                                                                    <?php } }
                                                                ?>
                                                            </select>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label class="control-label">Work Location<span class="required">
                                                             </span>
                                                            </label></br>
                                                            <select name="wLocCode" id="wLocCode" class="form-control input-medium select2me" data-placeholder="Select..." disabled>
                                                                <option value=""></option>
                                                                <?php $sql="Select WorkLocId, WLOC_NAME from WorkLocMast";
                                                                $result = query($query,$sql,$pa,$opt,$ms_db);
                                                                if ($num($result) > 0) {

                                                                    while($data =$fetch($result)) {?>
                                                                        <option <?php if($row2['WLOC_CODE']==$data['WorkLocId']){ echo "selected";}?> value=<?php echo $data['WorkLocId'];?> ><?php echo $data['WLOC_NAME'];?></option>
                                                                    <?php  } }
                                                                ?>
                                                            </select>
                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label class="control-label">Grade<span class="required">
                                                            *</span>
                                                            </label></br>

                                                            <select name="grdCode" id="grdCode" class="form-control input-medium select2me" data-placeholder="Select..." disabled>
                                                                <option value=""></option>
                                                                <?php $sql="Select GRDID, GRD_NAME from GrdMast";
                                                                $result = query($query,$sql,$pa,$opt,$ms_db);
                                                                if ($num($result) > 0) {

                                                                    while($data =$fetch($result)) {?>
                                                                        <option <?php if($row2['GRD_CODE']==$data['GRDID']){ echo "selected";} ?> value=<?php echo $data['GRDID'];?> ><?php echo $data['GRD_NAME'];?></option>

                                                                    <?php }}
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="control-label">Employee Type<span class="required">
                                                             </span>
                                                            </label></br>
                                                            <!--<input name="empTypeCode" id="empTypeCode" type="text" class="form-control" placeholder=""/>-->
                                                            <select name="empTypeCode" id="empTypeCode" class="form-control input-medium select2me" data-placeholder="Select..." disabled>
                                                                <option value=""></option>
                                                                <?php $sql="Select TYPEID, TYPE_NAME from EmpType";
                                                                $result = query($query,$sql,$pa,$opt,$ms_db);
                                                                if ($num($result) > 0) {
                                                                    while($data =$fetch($result)) {?>
                                                                        <option <?php if($row2['TYPE_CODE']== $data['TYPEID']){echo "selected";}?> value=<?php echo $data['TYPEID'];?> ><?php echo $data['TYPE_NAME']; ?></option>

                                                                    <?php }}
                                                                ?>
                                                            </select>
                                                        </div>

                                                        <div class="col-md-4">

                                                            <label class="control-label">Function<span class="required">
                                                             </span>
                                                            </label></br>
                                                            <select name="functCode" id="functCode" onchange="selectSubFunction(this.value);" class="form-control input-medium select2me" data-placeholder="Select..." disabled>
                                                                <option value=""></option>
                                                                <?php $sql="Select FunctID, FUNCT_NAME from FUNCTMast";
                                                                $result = query($query,$sql,$pa,$opt,$ms_db);

                                                                if ($num($result) > 0) {
                                                                    while($data =$fetch($result)) {?>
                                                                        <option <?php if($row2['FUNCT_CODE']== $data['FunctID']){echo "Selected";}?> value=<?php echo $data['FunctID'];?>><?php echo  $data['FUNCT_NAME'];?></option>
                                                                    <?php  }} ?>
                                                            </select>
                                                        </div>


                                                    </div>

                                                </div>


                                                <div class="">
                                                    <div class="row">
                                                        
                                                        <div class="col-md-4">
                                                            <label class="control-label">Sub Function<span class="not-required">
                                                             </span>
                                                            </label></br>
                                                            <select name="subFunctCode" id="subFunctCode" class="form-control input-medium select2me" data-placeholder="Select..." disabled>
                                                                <option value=""></option>
                                                                <?php $sql="Select * from SubFunctMast";
                                                                $result = query($query,$sql,$pa,$opt,$ms_db);
                                                                if ($num($result) > 0) {
                                                                    while($row =$fetch($result)) {?>
                                                                        <option <?php if($row2['SFUNCT_CODE'] == $row['SubFunctID']){echo "Selected";}?> value="<?php echo $row['SubFunctID'];?>">
                                                                            <?php echo $row['SubFunct_NAME'];?>
                                                                        </option>
                                                                    <?php }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="control-label">Cost Center<span class="not-required"> </span>
                                                            </label></br>
                                                            <!-- <input name="costCode" id="costCode" type="text" class="form-control" placeholder=""/>-->
                                                            <select name="costCode" id="costCode" class="form-control input-medium select2me" data-placeholder="Select..." disabled>
                                                                <option value=""></option>
                                                                <?php $sql="Select CostID, COST_NAME from CostMast";
                                                                $result = query($query,$sql,$pa,$opt,$ms_db);

                                                                if ($num($result) > 0) {
                                                                    while($data =$fetch($result)) {?>
                                                                        <option <?php if($row2['COST_CODE']== $data['CostID']){echo "selected";}?>  value=<?php echo $data['CostID'];?>><?php echo $data['COST_NAME'];?></option>

                                                                    <?php }}
                                                                ?>
                                                            </select>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label class="control-label">Process<span class="required">
                                                                 </span>
                                                            </label></br>
                                                            <!--<input name="procCode" id="procCode" type="text" class="form-control" placeholder=""/>-->
                                                            <select name="procCode" id="procCode" class="form-control input-medium select2me" data-placeholder="Select..." disabled>
                                                                <option value=""></option>
                                                                <?php $sql="Select PROCID, PROC_NAME from PROCMAST";
                                                                $result = query($query,$sql,$pa,$opt,$ms_db);
                                                                if ($num($result) > 0) {
                                                                    while($data =$fetch($result)) {?>
                                                                        <option <?php if($row2['PROC_CODE'] == $data['PROCID']){echo "selected";} ?> value=<?php echo $data['PROCID'];?> ><?php echo $data['PROC_NAME'];?></option>

                                                                    <?php }}
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label class="control-label">Designation<span class="required">
                                                                 </span>
                                                            </label></br>
                                                            <!-- <input name="roleCODE" id="roleCODE" type="text" class="form-control" placeholder=""/>-->
                                                            <select name="dsCODE" id="dsCODE" class="form-control input-medium select2me" data-placeholder="Select..." disabled>
                                                                <option value=""></option>
                                                                <?php $sql="Select DSGID, DSG_NAME from DsgMast";
                                                                $result = query($query,$sql,$pa,$opt,$ms_db);
                                                                if ($num($result)> 0) {
                                                                    while($data =$fetch($result)) {?>
                                                                        <option <?php if($row2['DSG_CODE']==$data['DSGID']){echo "selected";}?> value=<?php echo $data['DSGID']; ?>><?php echo $data['DSG_NAME']; ?></option>
                                                                    <?php } }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="control-label">Official Email<span class="not-required" id="errofficmail"></span></label></br>
                                                            <input type="text" name="oEmail" id="oEmail" onkeydown="validate.email('oEmail','errofficmail');" value="<?php echo $row2['OEMailID'];?>" class="form-control input-medium" readonly/>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label class="control-label">Effective Date<span class="required">*</span></label></br>
                                                            <input type="text" name="effectiveDate" id="effectiveDate" value="<?php echo $row2['WEF'];?>" disabled placeholder="DD/MM/YYYY" class="form-control input-medium"/>
                                                            <span class="help-block" id="erroreffectdate" style="display: none; color: red;">Entered date is greaterthan or equal to today's date </span>
                                                        </div>


                                                    </div>

                                                </div>

                                                <div class="">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label class="control-label">Access Code<span class="required"></span></label></br>
                                                            <input type="text" name="accesscode" id="accesscode" value="<?php echo $row2['accessID'];?>" class="form-control input-medium" readonly/>
                                                            <span class="help-block" id="erroraccesscode" style="display: none; color: red;">Entered Access Code </span>
                                                        </div>
                                                         <div class="col-md-4">
                                                            <label class="control-label">Level<span class="required">
                                                            </span>
                                                            </label></br>
                                                            <!-- <input name="roleCODE" id="roleCODE" type="text" class="form-control" placeholder=""/>-->
                                                            <select name="lavel" id="lavel" class="form-control input-medium select2me" data-placeholder="Select..." disabled>
                                                                <option value=""></option>
                                                                <?php $sql="Select LEVELID, LEVEL_Name from LEVELMAST";
                                                                $result = query($query,$sql,$pa,$opt,$ms_db);
                                                                if ($num($result)> 0) {
                                                                    while($data =$fetch($result)) {?>
                                                                        <option <?php if($row2['Level_CODE'] == $data['LEVELID']){echo "selected"; }?>
                                                                            value="<?php echo $data['LEVELID'];?>" >
                                                                            <?php echo $data['LEVEL_Name'];?>
                                                                        </option>
                                                                    <?php  }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label class="control-label">Division Master<span class="not-required">
                                                               </span>
                                                            </label></br>
                                                            <select name="divisionMast" id="divisionMast" class="form-control input-medium select2me" data-placeholder="Select..." disabled>
                                                                <option value=""></option>
                                                                <?php $sql="Select DIVIID, DIVI_NAME from DiviMast";
                                                                $result = query($query,$sql,$pa,$opt,$ms_db);
                                                                if ($num($result) > 0) {
                                                                    while($data =$fetch($result)) {?>
                                                                        <option <?php if($row2['DIVI_NAME'] == $data['DIVI_NAME'])                                                                                    {echo "selected";}?> value="<?php echo $data['DIVIID'];?>" >
                                                                            <?php echo $data['DIVI_NAME'];?>
                                                                        </option>
                                                                    <?php    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label class="control-label">Region Master<span class="required"></span>
                                                            </label></br>
                                                            <!-- <input name="costCode" id="costCode" type="text" class="form-control" placeholder=""/>-->
                                                            <select name="regionMast" id="regionMast" class="form-control input-medium select2me"                                                    data-placeholder="Select..." disabled>
                                                                <option value=""></option>
                                                                <?php $sql="Select REGNID, REGN_NAME from RegnMast";
                                                                $result = query($query,$sql,$pa,$opt,$ms_db);

                                                                if ($num($result) > 0) {

                                                                    while($data =$fetch($result)) { ?>
                                                                        <option <?php if($row2['REGN_NAME'] == $data['REGN_NAME'])
                                                                        {echo "selected"; } ?> value="<?php echo $data['REGNID'];?>"><?php echo $data['REGN_NAME'];?> </option>
                                                                    <?php }} ?>
                                                            </select>
                                                        </div>
                                                         <div class="col-md-4">
                                                            <label class="control-label">Sub Bussiness Unit<span class="required">
                                                             </span>
                                                            </label></br>
                                                            <select name="subBussUnit" id="subBussUnit" class="form-control input-medium select2me" data-placeholder="Select..." disabled>
                                                                <option value=""></option>
                                                                <?php $sql="Select subBussid, subBussName from subBussMast";
                                                                $result = query($query,$sql,$pa,$opt,$ms_db);
                                                                if ($num($result) > 0) {
                                                                    while($data =$fetch($result)) {?>
                                                                        <option <?php if($row2['SUBBuss_Code'] == $data['subBussid']){echo "selected";}?> value=" <?php echo $data['subBussid'];?>" ><?php echo $data['subBussName'];?></option>
                                                                    <?php }  }
                                                                ?>
                                                            </select>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label class="control-label">Work Phone<span class="required" id="errorworkphn"></span></label></br>
                                                            <input type="text" name="workphn" id="workphn" value="<?php echo $row2['WorkPhone'];?>" class=" input-medium form-control" readonly/>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label class="control-label">Work Phone Extention<span class="required" id="errorworkphnExt"></span></label></br>
                                                            <input type="text" name="workphnExt" id="workphnExt" value="<?php echo $row2['WorkPhoneExt'];?>" class=" input-medium form-control" readonly/>
                                                        </div>

                                                    </div>
                                                </div>
                                                <input type="hidden" name="gaurdian" value="<?phpecho $row2['GuardianName']; ?>">
                                                <!-- <div class="col-md-offset-9" style="margin-top: 15px;">
                                                    <a href="#" onclick="officialEnableTexts();" id="editOfficialButton" style="display: block;" class="btn btn-block green-haze">
                                                        Edit  </a>
                                                    <a href="#" class="btn btn-block green-haze" id="submitOfficialButton" onclick="submitOfficialInfo('<?php echo $_GET['oempCode'];?>');" style="display: none;">
                                                        Submit </a>
                                                </div> -->

                                            </form>
                                        </div>

                                <!-- Start Bank Information  -->
                                <div class="tab-pane" id="tab_1_5">
                                    <form role="form" id="editBankForm" action="#">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="control-label"> Salary Bank<span class="required"></span>
                                                    </label></br>
                                                    <select name="bankCode" id="bankCode" class="form-control input-medium select2me" data-placeholder="Select..." disabled>
                                                        <?php
                                                        $sql= "select SV_CODE,SV_NAME from SVMast WHERE SV_Type='MOP' ";
                                                        $result = query($query,$sql,$pa,$opt,$ms_db);

                                                        echo"<option value=''></option>";

                                                        while($data =$fetch($result)) {
                                                            ?>
                                                            <option <?php if($row2['SMOP_CODE']==$data['SV_CODE']){echo "selected";}?> value="<?php echo $data['SV_CODE']; ?>" ><?php echo $data['SV_NAME'];?>
                                                            </option>
                                                            <?php
                                                        }
                                                        ?>

                                                    </select>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="control-label">Salary Account No.<span class="required" id="errSmopNo"> </span>
                                                    </label></br>
                                                    <input name="smopNo" id="smopNo" type="text"  maxlength="20" value="<?php echo $row2['SMOPNo'];?>" onkeyup="getTextLength('smopNo','20','errSmopNo');"  class="form-control" placeholder="Only Numeric Values" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">


                                                <div class="col-md-6">
                                                    <label class="control-label">Reimbursement Bank<span class="required"> </span></label></br>
                                                    <select name="reimbankCode" id="reimbankCode" class="form-control input-medium select2me" data-placeholder="Select..." disabled>
                                                        <?php
                                                        $sql= "select SV_CODE,SV_NAME from SVMast WHERE SV_Type='RMOP' ";
                                                        $result = query($query,$sql,$pa,$opt,$ms_db);

                                                        echo"<option value=''></option>";
                                                        while($data =$fetch($result)) {
                                                            ?>
                                                            <option <?php if($row2['RMOP_CODE']== $data['SV_CODE']){echo "selected";}?> value="<?php echo $data['SV_CODE'];?>"> <?php echo $data['SV_NAME'];?>
                                                            </option>
                                                            <?php

                                                        }
                                                        ?>

                                                    </select>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="control-label">Reimbursement Account No.<span class="required" id="errRmopNo"> </span>
                                                    </label></br>
                                                    <input name="rmopNo" id="rmopNo" type="text" value="<?php echo $row2['RMOPNo'];?>" onkeyup="getTextLength('rmopNo','20','errRmopNo');" maxlength="20" placeholder="Onlu Numeric Values" class="form-control" readonly/>
                                                </div>
                                            </div>
                                        </div>

                                       <!--  <div class="col-md-offset-9 margiv-top-10">
                                            <a href="#" onclick="bankEnableTexts();" id="editBankButton" style="display: block;" class="btn btn-block green-haze">
                                                Edit  </a>
                                            <a href="#" class="btn btn-block green-haze" id="submitBankButton" onclick="submitBankInfo('<?php echo $_GET['oempCode'];?>');" style="display: none;">
                                                Submit </a>
                                        </div> -->
                                    </form>
                                </div>
                                <!-- End identity Information  -->
                                <div class="tab-pane" id="tab_1_6">
                                    <form action="#" id="editStaturyForm">
                                        <div class="permanentAddress" style="padding-left:12px;"><h4 style="color:blue;">Passport Details</h4></div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="control-label">Passport No.<span class="not-required">
                                             </span>
                                                    </label></br>
                                                    <input name="passNo" id="passportNo" value="<?php echo $row2['PassportNo'];?>" readonly type="text" class="form-control"/>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="control-label">Place Of Issue<span class="not-required">
                                             </span>
                                                    </label></br>
                                                    <input name="passPlace" id="passportPlace" value="<?php echo $row2['PassportPlace']; ?>" readonly type="text" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="control-label">Passport Validity<span class="not-required">
                                             </span>
                                                    </label></br>
                                                    <input name="passValidityDate" id="passportValidityDate" type="text" value="<?php echo $row2['PassportValidityDate']; ?>" disabled class="form-control" placeholder="DD/MM/YYYY" />
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="control-label">Date Of Issue<span class="not-required"></span>
                                                    </label></br>
                                                    <input name="passIssue" id="passportIssue" type="text" value="<?php echo $row2['PIssueDate']; ?>" disabled class="form-control"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="control-label">Address On Passport<span class="not-required">
                                             </span>
                                                    </label></br>
                                                    <input name="passAddress" id="passportAddress" readonly value="<?php echo $row2['PassportAddress']; ?>" type="text" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="permanentAddress" style="padding-left:12px;"><h4 style="color:blue;">Driving Details</h4></div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="control-label">Driving Licence No.<span class="required">
                                            * </span>
                                                    </label></br>
                                                    <input name="dlNo" id="dlNo" type="text" readonly value="<?php echo $row2['DLNo']; ?>" class="form-control"/>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="control-label">Place Of Issue<span class="not-required">
                                            </span>
                                                    </label></br>
                                                    <input name="dlPlace" id="dlPlace" type="text" readonly value="<?php echo $row2['DLPlace'];?>" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="control-label">Date Of Issue<span class="not-required">
                                            </span>
                                                    </label></br>
                                                    <input name="dlDate" id="dlDate" type="text" class="form-control" disabled value="<?php echo $row2['DIssueDate'];?>" placeholder="DD/MM/YYYY" />
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="control-label">DL Validity<span class="required">
                                            * </span>
                                                    </label></br>
                                                    <input name="dlValidityDate" id="dlValidityDate"  value="<?php echo $row2['DLValidityDate'];?>" type="text" class="form-control" disabled/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="control-label">Driving Licence Address<span class="required">* </span>
                                                    </label></br>
                                                    <input name="dlAddress" id="dlAddress" readonly value="<?php echo $row2['DLAddress'];?>" type="text" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="permanentAddress" style="padding-left:12px;"><h4 style="color:blue;">Others Details</h4></div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="control-label">Adhar Card No.<span class="not-required"></span>
                                                    </label></br>
                                                    <input name="adharNo" id="adharNo" type="text" readonly value="<?php echo $row2['AadharNo'];?>" class="form-control"/>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="control-label">Registration No.<span class="not-required" id="errorRegistr"></span></label></br>
                                                    <input name="registration" id="registration"  value="<?php echo $row2['Registration_No'];?>" type="text" class="form-control" readonly/>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="control-label">Trade<span class="not-required"></span></label></br>
                                                    <input name="trade" id="trade" type="text" value="<?php echo $row2['Trade'];?>" class="form-control" readonly/>
                                                </div>
                                                <!--<div class="col-md-6">
                                                            <label class="control-label">Contract Type<span class="not-required"></span></label></br>
                                                            <input name="contract" id="contract" type="text" value="<?php //echo $row2['Contract_type'];?>" class="form-control" readonly/>
                                                        </div>-->
                                            </div>
                                        </div>

                                        <div class="col-md-offset-9 margiv-top-10">
                                            <a href="#" onclick="staturyEnableTexts();" id="editStaturyButton" style="display: block;" class="btn btn-block green-haze">
                                                Edit  </a>
                                            <a href="#" class="btn btn-block green-haze" id="submitStaturyButton" onclick="submitStaturyInfo('<?php echo $_GET['oempCode'];?>');" style="display: none;">
                                                Submit </a>
                                        </div>
                                    </form>
                                </div>
                                <!-- END PRIVACY SETTINGS TAB -->

                                <div class="tab-pane" id="tab_1_7">
                                    <form action="#" id="editIdentityForm">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="control-label">UNNo.<span class="not-required"></span></label></br>
                                                    <input name="uanNo" id="uanNo" type="text" value="<?php echo $row2['UNNo'];?>" class="form-control" readonly/>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="control-label">PF No.<span class="required">* </span></label></br>
                                                    <input name="PfNo" id="PfNo" type="text" value="<?php echo $row2['PFNo'];?>" class="form-control" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="control-label">PAN No.<span class="not-required"></span>
                                                    </label></br>
                                                    <input name="panNo" id="panNo" type="text" readonly value="<?php echo $row2['PANNo'];?>" class="form-control"/>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="control-label">ESI No.<span class="required">*</span>
                                                    </label></br>
                                                    <input name="esiNo" id="esiNo" type="text" value="<?php echo $row2['ESINo'];?>" class="form-control" readonly/>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- <div class="col-md-offset-9 margiv-top-10">
                                            <a href="#" onclick="identityEnableTexts();" id="editIdentityButton" style="display: block;" class="btn btn-block green-haze">
                                                Edit  </a>
                                            <a href="#" class="btn btn-block green-haze" id="submitIdentityButton" onclick="submitIdentityInfo('<?php echo  $_GET['oempCode'];?>');" style="display: none;">
                                                Update </a>
                                        </div> -->
                                    </form>
                                </div>


                                        <!--Start sepration -->

                                         <div class="tab-pane" id="tab_1_8">
                                            <form action="#" id="editSeprationForm">
                                                
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label class="control-label">Date Of Leaving<span class="not-required"></span></label></br>
                                                            <input name="dol" id="dol" type="text" disabled value="<?php echo $row2['DOL'];?>" class="input-medium form-control" placeholder="DD/MM/YYYY" />
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="control-label">Leaving Reason<span class="not-required"></span></label></br>
                                                            <input name="leavReas" id="leavReas" type="text" value="<?php echo $row2['LeavReason'];?>" class="input-medium form-control" readonly/>
                                                        </div>
                                                    </div>  
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label class="control-label">Date Of Settlement<span class="not-required"></span></label></br>
                                                            <input name="dos" id="dos" type="text" disabled value="<?php echo $row2['DOS'];?>"  class="input-medium form-control" placeholder="DD/MM/YYYY"/>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label class="control-label">Date Of Resignation<span class="not-required"></span></label></br>
                                                            <input name="dor" id="dor" type="text" disabled value="<?php echo $row2['DOR'];?>" class="input-medium form-control" placeholder="DD/MM/YYYY"/>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label class="control-label">Employee Status <span class="not-required"></span></label></br>
                                                            <select name="statusCode" id="statusCode" class="form-control input-medium" disabled>
                                                                <option value=""></option>
                                                                <?php   $sql="select * from StatusMast";
                                                                $result =  query($query,$sql,$pa,$opt,$ms_db);
                                                                while($data = $fetch($result)) {
                                                                    ?>
                                                                    <option <?php if($row2['Status_Code']=== $data['Status_Code']){echo "selected";}?> value="<?php echo $data['Status_Code'];?>"><?php echo $data['Status_Name'];?>
                                                                    </option>
                                                                <?php  }?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                

                                                <!-- <div class="col-md-offset-9 margiv-top-10">
                                                    <a href="#" onclick="seprationEnableTexts();" id="editSepration" style="display: block;" class="btn btn-block green-haze">
                                                        Edit  </a>
                                                    <a href="#" class="btn btn-block green-haze" id="submitSepration" onclick="submitSeprationInfo('<?php echo $_GET['oempCode'];?>');" style="display: none;">
                                                        Submit </a>
                                                </div> -->
                                            </form>
                                        </div>   

                                        <!--End sepration -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <!-- END Official Details -->




        <!-- BEGIN Change Image-->
        <div class="profile-content" style="display: none" id="change_Image">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light">

                        <input type="hidden" id="empCode" value="<?php echo $_GET['oempCode'];?>">
                        <div class="portlet-body">
                            <div class="tab-content">
                                <!-- PERSONAL INFO TAB -->
                                <div class="tab-pane active" id="">
                                    <div id="message"></div>
                                    <form action="#" id="uploadimage" method="post" enctype="multipart/form-data" role="form">
                                        <div class="form-group">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""/>
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                                                </div>
                                                <div>
                                                    <span class="btn default btn-file">
                                                    <span class="fileinput-new">
                                                    Select image </span>
                                                    <span class="fileinput-exists">
                                                    Change </span>
                                                    <input type="file" name="fileToUpload" id="fileToUpload">
                                                    </span>
                                                    <a href="#" class="btn default fileinput-exists" data-dismiss="fileinput">
                                                        Remove </a>
                                                </div>
                                            </div>
                                            <div class="clearfix margin-top-10">
                                                <span class="label label-danger">NOTE! </span>
                                                <span>Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only </span>
                                            </div>
                                        </div>
                                        <div class="margin-top-10">
                                        <a href="#" onclick="submitImage('<?php echo $_GET['oempCode'];?>');" class="btn green-haze">
                                                                Submit </a>
                                        </div>
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- End change Image-->

    </div>

</div>
<!-- END PAGE CONTENT-->
