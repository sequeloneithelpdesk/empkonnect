<?php
include '../../db_conn.php'; include ('../../configdata.php');
if($_POST['id']) {
    $empCode = $_POST['id'];
}
?>
<form action="#" id="editAddQualForm" class="form-horizontal">
    <input type="hidden" id="empId" name="empId" value="<?php echo $empCode;?>">
    <div class="form-body">
        <div class="form-group">
            <div class="col-md-12">

                <div class="col-md-6">
                    <label class="control-label">Qualification<span class="required">
                            * </span>
                    </label></br>
                    <select name="qualification" id="qualification" class="form-control input-medium select2me" data-placeholder="Select...">
                        <?php
                        $sql= "select * from QualMast";
                        $result = query($query,$sql,$pa,$opt,$ms_db);

                        echo"<option value=''></option>";
                        while($row =$fetch($result)) {
                            ?>
                            <option value="<?php echo $row['QualID'];?>"><?php echo $row['Qual_Name'];?>
                            </option>
                            <?php

                        }
                        ?>

                    </select>
                </div>
                <div class="col-md-6">
                    <label class="control-label">From<span class="not-required">
                            </span>
                    </label></br>
                    <input type="text" name="from" class="form-control" id="from"/>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <div class="col-md-6">
                    <label class="control-label">To<span class="not-required">
                             </span>
                    </label></br>
                    <input type="text" name="to" class="form-control" id="to"/>
                </div>
                <div class="col-md-6">
                    <label class="control-label">Specialization<span class="required">
                            *</span>
                    </label>
                    <input type="text" class="form-control"  maxlength="25" name="specialization" id="specialization" >
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <div class="col-md-6">
                    <label class="control-label">University<span class="not-required">
                             </span>
                    </label></br>
                    <select name="university" id="university" class="form-control input-medium select2me" data-placeholder="Select...">
                        <?php
                        $sql= "select * from UnivMast";
                        $result = query($query,$sql,$pa,$opt,$ms_db);

                        echo"<option value=''></option>";
                        while($row =$fetch($result)) {
                            ?>
                            <option value="<?php echo $row['UNIVID'];?>"><?php echo $row['Univ_Name'];?>
                            </option>
                            <?php

                        }
                        ?>

                    </select>


                </div>
                <div class="col-md-6">
                    <label class="control-label">College<span class="not-required">
                            </span>
                    </label>
                    <input type="text" name="college" id="college" maxlength="30" class="form-control"/>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <div class="col-md-6">
                    <label class="control-label">Country<span class="not-required">
                             </span>
                    </label></br>
                    <select name="country" id="country" class="form-control input-medium select2me" data-placeholder="Select..." onchange="getAllState(this.value);">
                        <?php
                        $sql= "select * from CountryMast";
                        $result = query($query,$sql,$pa,$opt,$ms_db);

                        echo"<option value=''></option>";
                        while($row =$fetch($result)) {
                            ?>
                            <option value="<?php echo $row['CountryID'];?>"><?php echo $row['Country_NAME'];?>
                            </option>
                            <?php

                        }
                        ?>

                    </select>

                </div>
                <div class="col-md-6">
                    <label class="control-label">State<span class="not-required">
                             </span>
                    </label></br>
                    <select class="form-control" name="state" id="state" onchange="getAllCity(this.value);">

                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <div class="col-md-6">
                    <label class="control-label">City<span class="not-required">
                             </span>
                    </label></br>
                    <select class="form-control" name="city" id="city">

                    </select>
                    <!-- <input type="text" name="city" id="city" maxlength="30" class="form-control"/> -->
                </div>
                <div class="col-md-6">
                    <label class="control-label">Marks In %<span class="not-required">
                             </span>
                    </label></br>
                    <input type="text" name="marks" id="marks" onclick="onlyNumeric('marks')" placeholder="Numeric Values Only" maxlength="2" class="form-control"/>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <div class="col-md-6">
                    <label class="control-label">Grade/Division<span class="not-required">
                        </span>
                    </label></br>
                    <input type="text" class="form-control" maxlength="10" name="grade" id="grade">
                </div>
                <div class="col-md-6">
                    <label class="control-label">Subjects<span class="not-required">
                             </span>
                    </label></br>
                    <input type="text" name="subject" id="subject" maxlength="50" class="form-control"/>
                </div>
            </div>
        </div>
    </div>

    <div class="form-actions">
        <div class="row">
            <div class="col-md-offset-8 col-md-5">
                <button type="button" onclick="submitAddQual();" class="btn blue">OK</button>
                <button type="button" data-dismiss="modal" class="btn default">Cancel</button>
            </div>
        </div>
    </div>
</form>

<script>
    $( "#from" ).datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+0",
        dateFormat: "dd/mm/yy"
    });

    $( "#to" ).datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+0",
        dateFormat: "dd/mm/yy"
    });

    function onlyNumeric(fieldId) {

        $("#"+fieldId).keypress(function (e) {

            //if the letter is not digit then display error and don't type anything
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                //display error message
                //$("#errphone").html("Digits Only").show();
                return false;
            }
        });

    }
</script>