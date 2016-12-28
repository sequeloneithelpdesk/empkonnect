<?php
include '../../db_conn.php'; include ('../../configdata.php');
if($_POST['id']) {
    $empCode = $_POST['id'];
}

?>

<form action="#" id="editAddNomForm" class="form-horizontal">
    <input type="hidden" id="empId" name="empId" value="<?php echo $empCode;?>">
    <div class="form-body">
        <div class="form-group">
            <div class="col-md-12">
                <div class="col-md-6">
                    <label class="control-label">Nominee Name<span class="required">
                            * </span>
                    </label></br>
                    <input type="text" name="nomineeName" id="nomineeName" maxlength="50" class="form-control"/>
                </div>
                <div class="col-md-6">
                    <label class="control-label">Relation<span class="required">
                            * </span>
                    </label></br>
                    <Select class="form-control" name="nomineeRelation" id="nomineeRelation">
                        <option value="">Select</option>
                        <?php
                        $sql="select * from lovmast where lov_value not in (select Nominee_Relation from Nominee where EMP_CODE='$empCode' and (Nominee_Relation='1' or Nominee_Relation='2' or Nominee_Relation='5')  group by Nominee_Relation) and  LOV_Field='nominee'";
                        $result2=query($query,$sql,$pa,$opt,$ms_db);
                        while($data=$fetch($result2)){
                            ?>
                            <option value="<?php echo $data['LOV_Value'];?>" ><?php echo $data['LOV_Text'];?> </option>
                        <?php }?>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <div class="col-md-6">
                    <label class="control-label">Nominee DOB<span class="not-required">
                             </span>
                    </label></br>
                    <input type="text" name="nomineeDob" class="form-control" id="nomineeDob"/>
                </div>
                <div class="col-md-6">
                    <label class="control-label">WEF<span class="not-required">
                            </span>
                    </label>
                    <input type="text" name="nomineeWef" id="nomineeWef" class="form-control"/>
                </div>
            </div>
        </div>
       <!--  <div class="form-group">
            <div class="col-md-12">
                <div class="col-md-6">
                    <label class="control-label">PF Share %<span class="not-required">
                             </span>
                    </label></br>
                    <input type="text" name="pfShare" class="form-control" onclick="onlyNumeric('pfShare');" placeholder="Numeric Values Only" value="0" maxlength="10" id="pfShare"/>
                </div>
                <div class="col-md-6">
                    <label class="control-label">ESI Share %<span class="not-required">
                            </span>
                    </label>
                    <input type="text" name="esiShare" id="esiShare" onclick="onlyNumeric('esiShare');" placeholder="Numeric Values Only" value="0" maxlength="10" class="form-control"/>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <div class="col-md-6">
                    <label class="control-label">Gratuity Share %<span class="not-required">
                             </span>
                    </label></br>
                    <input type="text" name="gratuityShare" class="form-control" onclick="onlyNumeric('gratuityShare');" value="0" placeholder="Numeric Values Only" maxlength="10" id="gratuityShare"/>
                </div>
            </div>
        </div> -->
    </div>

    <div class="form-actions">
        <div class="row">
            <div class="col-md-offset-8 col-md-5">
                <button type="button" onclick="submitAddNominee();" class="btn blue">OK</button>
                <button type="button" data-dismiss="modal" class="btn default">Cancel</button>
            </div>
        </div>
    </div>
</form>


<script>
    $( "#nomineeWef" ).datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+0",
        dateFormat: "dd/mm/yy"
    });
    $( "#nomineeDob" ).datepicker({
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