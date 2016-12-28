<?php
include "../../db_conn.php";
include "../../configdata.php";

$nomid= $_POST['id'];

 $sql="select a.* , b.LOV_Value, b.LOV_text from (select *,CONVERT (varchar(10),Nominee_DOB,103)as DOB,CONVERT (varchar(10),Nominee_WEF,103)as WEF from Nominee where NomineeID= $nomid ) a inner join lovmast b on a.Nominee_Relation=b.lov_value and b.LOV_Field='nominee' ";
$result = query($query,$sql,$pa,$opt,$ms_db);
$row = $fetch($result);

?>

<form action="#" id="nomineeEditForm" class="form-horizontal">
    <input type="hidden" id="nomid" name="nomid" value="<?php echo $nomid; ?>"/>

    <div class="form-body">
        <div class="form-group">
            <div class="col-md-12">
                <div class="col-md-6">
                    <label class="control-label">Nominee Name<span class="required">
                            * </span>
                    </label></br>
                    <input type="text" name="nomineeName" value="<?php echo $row['Nominee_Name'];?>" id="nomineeName" class="form-control" maxlength="50" />
                </div>
                <div class="col-md-6">
                    <label class="control-label">Relation<span class="required">
                            * </span>
                    </label></br>

                    <Select class="form-control" name="nomineeRelation" id="nomineeRelation">
                        <?php
                        $sql="select * from lovmast where lov_value not in (select Nominee_Relation from Nominee where EMP_CODE='$empCode' and (Nominee_Relation='1' or Nominee_Relation='2' or Nominee_Relation='5')  group by Nominee_Relation) and  LOV_Field='nominee'";
                        $result2=query($query,$sql,$pa,$opt,$ms_db);
                        while($data=$fetch($result2)){
                            ?>
                            <option value="<?php echo $data['LOV_Value'];?>" <?php if( $row['LOV_Value'] == $data['LOV_Value']){ echo "selected"; } ?> ><?php echo $data['LOV_Text'];?> </option>
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
                    <input type="text" name="nomineeDob" value="<?php echo $row['DOB'];?>" class="form-control" id="nomineeDob"/>
                </div>
                <div class="col-md-6">
                    <label class="control-label">WEF<span class="not-required">
                            </span>
                    </label>
                    <input type="text" name="nomineeWef" value="<?php echo $row['WEF'];?>" id="nomineeWef" class="form-control"/>
                </div>
            </div>
        </div>
        <!-- <div class="form-group">
            <div class="col-md-12">
                <div class="col-md-6">
                    <label class="control-label">PF Share %<span class="not-required">
                             </span>
                    </label></br>
                    <input type="text" name="pfShare"  onclick="onlyNumeric('pfShare');" placeholder="Numeric Values Only" maxlength="10" value="<?php echo $row['Nominee_Addr1'];?>" class="form-control" id="pfShare"/>
                </div>
                <div class="col-md-6">
                    <label class="control-label">ESI Share %<span class="not-required">
                            </span>
                    </label>
                    <input type="text" name="esiShare"  onclick="onlyNumeric('esiShare');" placeholder="Numeric Values Only" id="esiShare" maxlength="10" value="<?php echo $row['Nominee_Addr2'];?>" class="form-control"/>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <div class="col-md-6">
                    <label class="control-label">Gratuity Share %<span class="not-required">
                             </span>
                    </label></br>
                    <input type="text" name="gratuityShare" onclick="onlyNumeric('gratuityShare');" placeholder="Numeric Values Only" class="form-control" maxlengh="10" value="<?php echo $row['Nominee_Share'];?>" id="gratuityShare"/>
                </div>
            </div>
        </div> -->
    </div>

    <div class="form-actions">
        <div class="row">
            <div class="col-md-offset-8 col-md-5">
                <button type="button" class="btn blue" onclick="submitEditNominee();">OK</button>
                <button type="button" data-dismiss="modal" class="btn default">Cancel</button>
            </div>
        </div>
    </div>
</form>

<script>
    $("#nomineeWef").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd/mm/yy"
    });
    $("#nomineeDob").datepicker({
        changeMonth: true,
        changeYear: true,
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