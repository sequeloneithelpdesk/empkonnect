<?php
    include "../../db_conn.php";
    include "../../configdata.php";
    $qualid= $_POST['id'];
//echo $qualid;
$sql="select *,convert(VARCHAR (10),Qual_From,103) as Qfrom,convert(VARCHAR (10),Qual_to,103) as Qto from hrdqualqry where QualID=$qualid ";
$result = query($query,$sql,$pa,$opt,$ms_db);
$data = $fetch($result);
?>
<form action="#" id="editQualForm" class="form-horizontal">
    <input type="hidden" id="qualId" name="qualId" value="<?php echo $qualid;?>"/>
    <div class="form-body">
        <div class="form-group">
            <div class="col-md-12">

                <div class="col-md-6">
                    <label class="control-label">Qualification<span class="required">*</span>  
                    </label></br>
                    <select name="qualification" id="qualification" class="form-control input-medium select2me" data-placeholder="Select...">
                        <?php
                        $sql= "select * from QualMast";
                        $result = query($query,$sql,$pa,$opt,$ms_db);

                        //echo"<option value=''></option>";
                        while($row =$fetch($result)) { ?>
                            <option <?php if($data['Qual_Code']==$row['QualID']){echo "selected";}?> value="<?php echo $row['QualID'];?>"><?php echo $row['Qual_Name'];?>
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
                    <input type="text" value="<?php echo $data['Qfrom'];?>" name="from" class="form-control" id="from"/>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <div class="col-md-6">
                    <label class="control-label">To<span class="not-required">
                             </span>
                    </label></br>
                    <input type="text" name="to" value="<?php echo $data['Qto'];?>" class="form-control" id="to"/>
                </div>
                <div class="col-md-6">
                    <label class="control-label">Specialization<span class="required">
                            *</span>
                    </label>
                    <input type="text" class="form-control" value="<?php echo $data['Qual_Special'];?>" name="specialization" id="specialization" >
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

                        //echo"<option value=''></option>";
                        while($row =$fetch($result)) {
                            ?>
                            <option <?php if($data['Univ_Code']==$row['UNIVID']){echo "selected";}?>" value="<?php echo $row['UNIVID'];?>"><?php echo $row['Univ_Name'];?>
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
                    <input type="text" name="college" maxlength="30" value="<?php echo $data['College'];?>" id="college" class="form-control"/>
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
                    <!-- <option> Select Country</option> -->
                        <?php
                        $sql= "select * from CountryMast";
                        $result = query($query,$sql,$pa,$opt,$ms_db);

                        while($row =$fetch($result)) {
                            $cid=$row['CountryID'];
                            ?>
                            <option value="<?php echo $row['CountryID'];?>" <?php if($data['Country'] == $row['CountryID']){ echo "selected";}?>" >
                            <?php echo $row['Country_NAME'];?>
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
                    <Select class="form-control"  name="state" id="state" onchange="getAllCity(this.value);">
                        <?php $cid=$data['Country'];
                        $sql="select * from StateMast where Country_Id=$cid ";
                        $result = query($query,$sql,$pa,$opt,$ms_db);
                        while($row =$fetch($result)) {
                        ?>
                        <option value="<?php echo $row['StateID'];?>" <?php if($data['Qual_State']== $row['StateID']){echo "selected";}?> ><?php echo $row['State_Name'];?></option>

                        <?php }?>
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
                    <Select class="form-control"  name="city" id="city" >
                        <?php $cid=$data['Qual_State'];
                        $sql="select * from CityMast where State_Id=$cid ";
                        $result = query($query,$sql,$pa,$opt,$ms_db);
                        while($row =$fetch($result)) { ?>
                        
                        <option value="<?php echo $row['CityID'];?>" <?php if($data['Place']== $row['CityID']){echo "selected";}?> ><?php echo $row['City_NAME'];?>
                        </option>

                        <?php }?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="control-label">Marks In %<span class="not-required">
                             </span>
                    </label></br>
                    <input type="text" name="marks" onclick="onlyNumeric('marks');" placeholder="Numeric Values Only" value="<?php echo $data['Marks_Per'];?>" maxlength="2" id="marks" class="form-control"/>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <div class="col-md-6">
                    <label class="control-label">Grade/Division<span class="not-required">
                        </span>
                    </label></br>
                    <input type="text" class="form-control" maxlength="10" value="<?php echo $data['Grade'];?>" name="grade" id="grade">
                </div>
                <div class="col-md-6">
                    <label class="control-label">Subjects<span class="not-required">
                             </span>
                    </label></br>
                    <input type="text" name="subject" maxlength="50" value="<?php echo $data['Subjects'];?>" id="subject" class="form-control"/>
                </div>
            </div>
        </div>
    </div>

    <div class="form-actions">
        <div class="row">
            <div class="col-md-offset-8 col-md-5">
                <button type="button" onclick="submitEditQual();" class="btn blue">OK</button>
                <button type="button" data-dismiss="modal" class="btn default">Cancel</button>
            </div>
        </div>
    </div>
</form>

<script>
    $( "#from" ).datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: true,
        dateFormat: "dd/mm/yy"
    });

    $( "#to" ).datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: true,
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