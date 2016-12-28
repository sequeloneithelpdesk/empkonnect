<?php
include '../../db_conn.php'; include ('../../configdata.php');
if($_POST['id']) {
    $empCode = $_POST['id'];
}

?>
<form action="#" id="editAddFamForm" class="form-horizontal">
    <input id="addfamid" name="addfamid" type="hidden" value="<?php echo $empCode;?>">
    <div class="form-body">
        <div class="form-group">
            <div class="col-md-12">
                <div class="col-md-6">
                    <label class="control-label">Relative Name<span class="required">
                            * </span>
                    </label></br>
                    <input type="text" name="relativeName" id="relativeName" maxlength="50" class="form-control"/>
                </div>
                <div class="col-md-6">
                    <label class="control-label">Relationship<span class="required">
                            * </span>
                    </label></br>
                    <Select class="form-control" name="relationship" id="relationship">
                        <option value="">SELECT</option>
                        <?php
                        $sql="select * from lovmast where lov_value not in (select Relation from hrdfamily where EMP_CODE='$empCode' and (Relation='1' or Relation='2' or Relation='5') group by Relation) and  LOV_Field='nominee'";
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
                    <label class="control-label">Date Of Birth<span class="not-required">
                             </span>
                    </label></br>
                    <input type="text" name="dateOfBirth" class="form-control" id="dateOfBirth"/>
                </div>
                <div class="col-md-6">
                    <label class="control-label">Dependent<span class="not-required">
                            </span>
                    </label>
                    <select name="dependent" id="dependent" class="form-control">
                        <option value="">Select</option>
                        <option value="0">No</option>
                        <option value="1">yes</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions">
        <div class="row">
            <div class="col-md-offset-8 col-md-5">
                <button type="button"onclick="submitAddFamily()" class="btn blue">OK</button>
                <button type="button" data-dismiss="modal" class="btn default">Cancel</button>
            </div>
        </div>
    </div>
</form>


<script>
        $( "#dateOfBirth" ).datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "-100:+0",
            dateFormat: "dd/mm/yy"
        });
 </script>