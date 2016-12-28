<?php
include ('../../../db_conn.php');
include ('../../../configdata.php');?>
<?php
$compid = $_POST['code'];
$queryq = "SELECT * FROM CompMast where COMPID='$compid'";
$resultq = query($query, $queryq, $pa, $opt, $ms_db);
if($num($resultq)) {

    while ($rowq = $fetch($resultq)) {

        ?>

        <form action="#" id="form_sample_1" class="form-horizontal">
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
                            <input type="text" name="compName" maxlength='10' class="form-control"
                                   value="<?php echo $rowq['COMP_NAME']; ?>"/>
                            <input type="hidden" name="hidecompID" id="compIDs" value="<?php echo $rowq['COMPID']; ?>">

                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Company Logo <span class="not-required">
                             </span>
                            </label></br>
                            <input type="file" name="compLogo" id="company_logo" onChange="logoimage_Validation();"
                                   title="Max File Size (500kb),File Type(.PNG,.JPEG,.JPG,.PSD,.BMP,.PDF,.EPS,.TIFF)"/><span
                                style="color:red" id="comprequire_logo"></span><span id="dialoginvalid"
                                                                                     style="color: #FF0000"></span>
                            <p id="logoName"></p><input type="hidden" name="company_logoName" id="company_logoName">
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Address<span class="required">
                             *</span>
                            </label></br>
                                <textarea name="compAddr" type="text" class="form-control" cols="10"
                                          rows="1"><?php echo $rowq['COMP_ADDR']; ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <label class="control-label">Country<span class="required">
                            * </span>
                            </label></br>
                            <select class="form-control" name="compCountry" onchange="CountryState(this.value,'StateID2')">
                                <option value="">Select Country...</option>
                                  <?php

                                $queryCountry = "SELECT * FROM CountryMast";
                                $resultq = query($query, $queryCountry, $pa, $opt, $ms_db);
                                while ($row = $fetch($resultq)) {
                                    ?>
                                    <option
                                        value="<?php echo $row['CountryID']; ?>,<?php echo $row['Country_NAME']; ?>" <?php if($row['Country_NAME']==$rowq['COMP_COUNTRY']){ echo 'selected' ;} else {} ?> ><?php echo $row['Country_NAME']; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">State<span class="required">
                            * </span>
                            </label></br>
                            <select class="form-control" name="compState" id="StateID2" onchange="StateCity(this.value,'CityID2')">
                                <option value="<?php echo $rowq['COMP_STATE']; ?>"><?php echo $rowq['COMP_STATE']; ?></option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">City<span class="required">
                             *</span>
                            </label></br>
                            <select class="form-control" name="compCity" id="CityID2">
                                <option value="<?php echo $rowq['COMP_CITY']; ?>"><?php echo $rowq['COMP_CITY']; ?></option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <label class="control-label">Postal Code<span class="required">
                            * </span>
                            </label></br>
                            <input type="text" name="compPin" class="form-control" value="<?php echo $rowq['COMP_PIN']; ?>"/>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Phone No.<span class="required">
                             * </span>
                            </label></br>
                            <input name="compPhone" type="text" class="form-control" value="<?php echo $rowq['COMP_PhoneNo']; ?>"/>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Fax No.<span class="not-required">
                            </span>
                            </label></br>
                            <input name="compFax" type="text" class="form-control" value="<?php echo $rowq['COMP_FAX']; ?>"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <label class="control-label">PF No.<span class="required">
                             * </span>
                            </label></br>
                            <input type="text" name="PFNo" class="form-control" value="<?php echo $rowq['COMP_PFNO']; ?>"/>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">ESI. No.<span class="required">
                            * </span>
                            </label></br>
                            <input name="ESINo" type="text" class="form-control" value="<?php echo $rowq['COMP_ESINO']; ?>"/>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">PAN No.<span class="required">
                            * </span>
                            </label></br>
                            <input name="PANNo" type="text" class="form-control" value="<?php echo $rowq['COMP_PANNO']; ?>"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <label class="control-label">TAN No.<span class="required">
                             * </span>
                            </label></br>
                            <input type="text" name="TANNo" class="form-control" value="<?php echo $rowq['COMP_TANNO']; ?>"/>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">TDS Circle<span class="required">
                             * </span>
                            </label></br>
                            <input name="TDSCircle" type="text" class="form-control" value="<?php echo $rowq['COMP_TDSCIRCLE']; ?>"/>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">TIN No.<span class="required">
                             * </span>
                            </label></br>
                            <input type="text" name="TINNo" class="form-control" value="<?php echo $rowq['TINNo']; ?>"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <label class="control-label">Registration No.<span class="required">
                            * </span>
                            </label></br>
                            <input name="RegistNo" type="text" class="form-control" value="<?php echo $rowq['Regist_No']; ?>"/>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">LST No.<span class="required">
                            * </span>
                            </label></br>
                            <input type="text" name="LSTNo" class="form-control" value="<?php echo $rowq['LSTNo']; ?>"/>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">CST No.<span class="required">
                            * </span>
                            </label></br>
                            <input type="text" name="CSTNo" class="form-control" value="<?php echo $rowq['CSTNo']; ?>"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <label class="control-label">Service Tax No.<span class="required">
                            * </span>
                            </label></br>
                            <input type="text" name="STaxNo" class="form-control" value="<?php echo $rowq['Service_TaxNo']; ?>"/>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Email ID<span class="required">
                            * </span>
                            </label></br>
                            <input type="text" name="emailId" class="form-control" value="<?php echo $rowq['COMP_Email']; ?>"/>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Website<span class="not-required">
                            </span>
                            </label></br>
                            <input type="text" name="website" class="form-control" value="<?php echo $rowq['COMP_URL']; ?>"/>
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <div class="col-md-2">
                            <label class="control-label">CIT Details<span class="required">
                            * </span>
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Address<span class="required">
                            * </span>
                            </label>
                            <input type="text" name="CITAddr" class="form-control" value="<?php echo $rowq['CIT_Addr']; ?>"/>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">City<span class="required">
                            * </span>
                            </label>
                            <input type="text" name="CITCity" class="form-control" value="<?php echo $rowq['CIT_City']; ?>"/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <label class="control-label">
                            </label>
                        </div>

                        <div class="col-md-4">
                            <label class="control-label">PIN No.<span class="required">
                            * </span>
                            </label>
                            <input type="text" name="CITPIN" class="form-control" value="<?php echo $rowq['CIT_PIN']; ?>"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-9 col-md-3">
                        <button type="submit" class="btn blue"  id="subbut" >Submit</button>
                        <button type="button" data-dismiss="modal" class="btn default">Cancel</button>
                    </div>
                </div>
            </div>
        </form>
        <?php
    }
}
?>

