<?php
session_start();
include '../../../db_conn.php';
//include '../../../configdata.php';

include $_SERVER['DOCUMENT_ROOT'].$_SESSION['root']."pages/HRMSClass/HRMSFunction.php";
//include '../HRMSClass/HRMSFunction.php';

 ?>
<?php
$compid = $_POST['id'];
$queryq = "SELECT * FROM CompMast where COMPID='$compid'";
$resultq = query($query, $queryq, $pa, $opt, $ms_db);
if($num($resultq)) {

    while ($rowq = $fetch($resultq)) {

        ?>

        <form action="#" id="form_sample_1" class="form-horizontal">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><b>Edit Company</b> </h4>
            </div>
            <div class="modal-body">
                <div class="form-body">
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    You have some form errors. Please check below.
                </div>
                <div class="alert alert-success display-hide">
                    <button class="close" data-close="alert"></button>
                    Company Created And Added successfully!
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <label class="control-label">Company Name <span class="required">
                            *</span>
                            </label></br>
                            <input type="text" name="compName" id="comp_Name" class="form-control"
                                   value="<?php echo $rowq['COMP_NAME']; ?>"/>
                            <input type="hidden" name="hidecompID" id="compIDs" value="<?php echo $rowq['COMPID']; ?>">

                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Company Logo
                            </label></br>
                            <input type="file" name="compLogo" id="company_logo" onChange="logoimage_Validation();"
                                   title="Max File Size (500kb),File Type(.PNG,.JPEG,.JPG,.PSD,.BMP,.PDF,.EPS,.TIFF)"/><span
                                style="color:red" id="comprequire_logo"></span><span id="dialoginvalid"
                                                                                     style="color: #FF0000"></span>
                            <p id="logoName"><?php echo $rowq['Comp_Logo']; ?></p><input type="hidden" name="company_logoName" id="company_logoName" value="<?php echo $rowq['Comp_Logo']; ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Address
                            </label></br>
                                <textarea name="compAddr" id="comp_Addr" type="text" class="form-control" cols="10"
                                          rows="1"><?php echo $rowq['COMP_ADDR']; ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <label class="control-label">Country
                            </label></br>
                            <select class="form-control" id="comp_Country" name="compCountry" onchange="CountryState(this.value,'StateID2')">
                                <option value="">Select Country...</option>
                                <?php

                                $queryCountry = "SELECT * FROM CountryMast";
                                $resultq = query($query, $queryCountry, $pa, $opt, $ms_db);
                                while ($row = $fetch($resultq)) {
                                    ?>
                                    <option
                                        value="<?php echo $row['CountryID']; ?>,<?php echo $row['Country_NAME']; ?>" <?php if($row['CountryID']==$rowq['COMP_COUNTRY']){ echo 'selected' ;} else {} ?> ><?php echo $row['Country_NAME']; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">State
                            </label></br>
                            <select class="form-control" name="compState" id="StateID2" onchange="StateCity(this.value,'CityID2')">
                                <?php  echo StateList($rowq['COMP_COUNTRY'],$rowq['COMP_STATE']) ; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">City
                            </label></br>
                            <select class="form-control" name="compCity" id="CityID2">
                                <?php  echo CityList($rowq['COMP_STATE'],$rowq['COMP_CITY']) ; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <label class="control-label">Postal Code
                            </label></br>
                            <input type="text" name="compPin" id="comp_Pin" onkeypress="return IsNumeric(event);" maxlength="6" class="form-control" value="<?php echo $rowq['COMP_PIN']; ?>"/>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Phone No.
                            </label></br>
                            <input name="compPhone" id="comp_Phone" onkeypress="return IsNumeric(event);" maxlength="10" type="text" class="form-control" value="<?php echo $rowq['COMP_PhoneNo']; ?>"/>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Fax No.
                            </label></br>
                            <input name="compFax" id="comp_Fax" type="text" class="form-control" value="<?php echo $rowq['COMP_FAX']; ?>"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <label class="control-label">PF No.
                            </label></br>
                            <input type="text" name="PFNo" id="PF_No" class="form-control" value="<?php echo $rowq['COMP_PFNO']; ?>"/>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">ESI. No.
                            </label></br>
                            <input name="ESINo" id="ESI_No" type="text" class="form-control" value="<?php echo $rowq['COMP_ESINO']; ?>"/>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">PAN No.
                            </label></br>
                            <input name="PANNo" id="PAN_No" type="text" class="form-control" value="<?php echo $rowq['COMP_PANNO']; ?>"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <label class="control-label">TAN No.
                            </label></br>
                            <input type="text" name="TANNo"  id="TAN_No" class="form-control" value="<?php echo $rowq['COMP_TANNO']; ?>"/>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">TDS Circle
                            </label></br>
                            <input name="TDSCircle"  id="TDS_Circle" type="text" class="form-control" value="<?php echo $rowq['COMP_TDSCIRCLE']; ?>"/>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">TIN No.
                            </label></br>
                            <input type="text" id="TIN_No" name="TINNo" class="form-control" value="<?php echo $rowq['TINNo']; ?>"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <label class="control-label">Registration No.
                            </label></br>
                            <input name="RegistNo" id="Regist_No" type="text" class="form-control" value="<?php echo $rowq['Regist_No']; ?>"/>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">LST No.
                            </label></br>
                            <input type="text" name="LSTNo" id="LST_No" class="form-control" value="<?php echo $rowq['LSTNo']; ?>"/>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">CST No.
                            </label></br>
                            <input type="text" name="CSTNo" id="CST_No"  class="form-control" value="<?php echo $rowq['CSTNo']; ?>"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <label class="control-label">Service Tax No.
                            </label></br>
                            <input type="text" name="STaxNo"  id="STax_No" class="form-control" value="<?php echo $rowq['Service_TaxNo']; ?>"/>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Company Email ID
                            </label></br>
                            <input type="text" name="emailId"  id="email_Id" onBlur="email_Validation();" class="form-control" value="<?php echo $rowq['COMP_Email']; ?>"/>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Website
                            </label></br>
                            <input type="text" name="website"  id="web_site"  class="form-control" value="<?php echo $rowq['COMP_URL']; ?>"/>
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <div class="col-md-2">
                            <label class="control-label">CIT Details
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Address
                            </label>
                            <input type="text" name="CITAddr" id="CIT_Addr" class="form-control" value="<?php echo $rowq['CIT_Addr']; ?>"/>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">City
                            </label>
                            <input type="text" name="CITCity"  id="CIT_City"  class="form-control" value="<?php echo $rowq['CIT_City']; ?>"/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <label class="control-label">
                            </label>
                        </div>

                        <div class="col-md-4">
                            <label class="control-label">PIN No.
                            </label>
                            <input type="text" name="CITPIN" id="CIT_PIN"  class="form-control" value="<?php echo $rowq['CIT_PIN']; ?>"/>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn green" id="Companies" value="edit" onclick="companyAddEdit()"><i class="fa fa-check"></i>Submit
                </button>
            </div>
        </form>
        <?php
    }
}
?>

