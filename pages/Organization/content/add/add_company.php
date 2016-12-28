
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
                    <input type="text" name="compName" class="form-control" maxlength="100"/>
                </div>
                <div class="col-md-4">
                    <label class="control-label">Company Logo <span class="not-required">
                             </span>
                    </label></br>
                    <input type="file" name="compLogo" id="company_logo"/>
                    <p id="logoName"></p><input type="hidden" name="company_logoName" id="company_logoName">
                </div>
                <div class="col-md-4">
                    <label class="control-label">Address
                    </label></br>
                    <textarea name="compAddr" type="text" class="form-control" cols="10" rows="1"></textarea>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <div class="col-md-4">
                    <label class="control-label">Country
                    </label></br>
                    <select class="form-control"  name="compCountry" onchange="CountryState(this.value,'StateID')" >
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
                    <input type="text" name="compPin" class="form-control"/>
                </div>
                <div class="col-md-4">
                    <label class="control-label">Phone No.
                    </label></br>
                    <input name="compPhone" type="text" class="form-control"/>
                </div>
                <div class="col-md-4">
                    <label class="control-label">Fax No.
                    </label></br>
                    <input name="compFax" type="text" class="form-control"/>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <div class="col-md-4">
                    <label class="control-label">PF No.
                    </label></br>
                    <input type="text" name="PFNo" class="form-control"/>
                </div>
                <div class="col-md-4">
                    <label class="control-label">ESI. No.
                    </label></br>
                    <input name="ESINo" type="text" class="form-control"/>
                </div>
                <div class="col-md-4">
                    <label class="control-label">PAN No.
                    </label></br>
                    <input name="PANNo" type="text" class="form-control"/>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <div class="col-md-4">
                    <label class="control-label">TAN No.
                    </label></br>
                    <input type="text" name="TANNo" class="form-control"/>
                </div>
                <div class="col-md-4">
                    <label class="control-label">TDS Circle
                    </label></br>
                    <input name="TDSCircle" type="text" class="form-control"/>
                </div>
                <div class="col-md-4">
                    <label class="control-label">TIN No.
                    </label></br>
                    <input type="text" name="TINNo" class="form-control"/>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <div class="col-md-4">
                    <label class="control-label">Registration No.
                    </label></br>
                    <input name="RegistNo" type="text" class="form-control"/>
                </div>
                <div class="col-md-4">
                    <label class="control-label">LST No.
                    </label></br>
                    <input type="text" name="LSTNo" class="form-control"/>
                </div>
                <div class="col-md-4">
                    <label class="control-label">CST No.
                    </label></br>
                    <input type="text" name="CSTNo" class="form-control"/>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <div class="col-md-4">
                    <label class="control-label">Service Tax No.
                    </label></br>
                    <input type="text" name="STaxNo" class="form-control"/>
                </div>
                <div class="col-md-4">
                    <label class="control-label">Email ID
                    </label></br>
                    <input type="text" name="emailId" class="form-control"/>
                </div>
                <div class="col-md-4">
                    <label class="control-label">Website
                    </label></br>
                    <input type="text" name="website" class="form-control"/>
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
                    <input type="text" name="CITAddr" class="form-control"/>
                </div>
                <div class="col-md-4">
                    <label class="control-label">City
                    </label>
                    <input type="text" name="CITCity" class="form-control"/>
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
                    <input type="text" name="CITPIN" class="form-control"/>
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions">
        <div class="row">
            <div class="col-md-offset-9 col-md-3">
                <button type="submit" class="btn blue">Submit</button>
                <button type="button" data-dismiss="modal" class="btn default">Cancel</button>
            </div>
        </div>
    </div>
</form>