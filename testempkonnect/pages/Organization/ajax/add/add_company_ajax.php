<?php

//include "../../db_conn.php";
include ('../../../db_conn.php');
include ('../../../configdata.php');
?>
<form action="#" id="form_sample_1" method="post"  class="form-horizontal" enctype="multipart/form-data">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title"><b>New Company</b> </h4>
    </div>
    <div class="modal-body">
        <div class="form-body">

            <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-4">
                        <label class="control-label">Company Name <span class="required">
                            *</span>
                        </label></br>
                        <input type="text" name="compName" id="comp_Name" class="form-control"/>
                        <input type="hidden" name="func" id="compIDs" value="add">

                    </div>
                    <div class="col-md-4">
                        <label class="control-label">Company Logo
                        </label></br>
                        <input type="file" name="compLogo" id="company_logo" onChange="logoimage_Validation();" title="Max File Size (500kb),File Type(.PNG,.JPEG,.JPG,.PSD,.BMP,.PDF,.EPS,.TIFF)"/><span style="color:red" id="comprequire_logo"></span><span id="dialoginvalid"  style="color: #FF0000"></span>
                        <p id="logoName"></p><input type="hidden" name="company_logoName" id="company_logoName">
                    </div>
                    <div class="col-md-4">
                        <label class="control-label">Address
                        </label></br>
                        <textarea name="compAddr" id="comp_Addr" type="text" class="form-control" cols="10" rows="1"></textarea>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-4">
                        <label class="control-label">Country
                        </label></br>
                        <select class="form-control" id="comp_Country" name="compCountry" onchange="CountryState(this.value,'StateID')">
                            <option value="">Select Country</option>
                            <?php
                            $queryCountry = "SELECT * FROM CountryMast";
                            $resultq=query($query,$queryCountry,$pa,$opt,$ms_db);
                            while( $row = $fetch($resultq)) {
                                ?>
                                <option value="<?php echo $row['CountryID'];?>,<?php echo $row['Country_NAME'];?>"><?php echo $row['Country_NAME'];?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="control-label">State
                        </label></br>
                        <select class="form-control"  name="compState" id="StateID" onchange="StateCity(this.value,'CityID')">
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="control-label">City
                        </label></br>
                        <select class="form-control"  name="compCity" id="CityID">
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-4">
                        <label class="control-label">Postal Code
                        </label></br>
                        <input type="text" name="compPin" id="comp_Pin" onkeypress="return IsNumeric(event);" maxlength="6" class="form-control"/>
                    </div>
                    <div class="col-md-4">
                        <label class="control-label">Phone No.
                        </label></br>
                        <input name="compPhone" id="comp_Phone" onkeypress="return IsNumeric(event);" maxlength="10" type="text" class="form-control"/>
                    </div>
                    <div class="col-md-4">
                        <label class="control-label">Fax No.
                        </label></br>
                        <input name="compFax" id="comp_Fax" type="text" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-4">
                        <label class="control-label">PF No.
                        </label></br>
                        <input type="text" name="PFNo" id="PF_No" class="form-control"/>
                    </div>
                    <div class="col-md-4">
                        <label class="control-label">ESI. No.
                        </label></br>
                        <input name="ESINo" id="ESI_No" type="text" class="form-control"/>
                    </div>
                    <div class="col-md-4">
                        <label class="control-label">PAN No.
                        </label></br>
                        <input name="PANNo" id="PAN_No" type="text" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-4">
                        <label class="control-label">TAN No.
                        </label></br>
                        <input type="text" name="TANNo" id="TAN_No" class="form-control"/>
                    </div>
                    <div class="col-md-4">
                        <label class="control-label">TDS Circle
                        </label></br>
                        <input name="TDSCircle" id="TDS_Circle" type="text" class="form-control"/>
                    </div>
                    <div class="col-md-4">
                        <label class="control-label">TIN No.
                        </label></br>
                        <input type="text" id="TIN_No" name="TINNo" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-4">
                        <label class="control-label">Registration No.
                        </label></br>
                        <input name="RegistNo" id="Regist_No" type="text" class="form-control"/>
                    </div>
                    <div class="col-md-4">
                        <label class="control-label">LST No.
                        </label></br>
                        <input type="text" name="LSTNo" id="LST_No" class="form-control"/>
                    </div>
                    <div class="col-md-4">
                        <label class="control-label">CST No.
                        </label></br>
                        <input type="text" name="CSTNo" id="CST_No" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-4">
                        <label class="control-label">Service Tax No.
                        </label></br>
                        <input type="text" name="STaxNo" id="STax_No" class="form-control"/>
                    </div>
                    <div class="col-md-4">
                        <label class="control-label">Company Email ID
                        </label></br>
                        <input type="text" name="emailId" id="email_Id" onBlur="email_Validation();" class="form-control"/>
                    </div>
                    <div class="col-md-4">
                        <label class="control-label">Website
                        </label></br>
                        <input type="text" name="website" id="web_site" class="form-control"/>
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
                        <input type="text" name="CITAddr" id="CIT_Addr" class="form-control"/>
                    </div>
                    <div class="col-md-4">
                        <label class="control-label">City
                        </label>
                        <input type="text" name="CITCity" id="CIT_City" class="form-control"/>
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
                        <input type="text" name="CITPIN" id="CIT_PIN" class="form-control"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn green" id="Companies" value="add" onclick="companyAddEdit()"><i class="fa fa-check"></i>Submit
        </button>
    </div>
</form>