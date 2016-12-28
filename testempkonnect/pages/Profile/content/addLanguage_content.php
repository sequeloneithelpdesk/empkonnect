<?php
include '../../db_conn.php'; include ('../../configdata.php');
if($_POST['empCode']) {
    $empCode = $_POST['empCode'];
}

?>
<form action="#" id="AddLangugeForm" class="form-horizontal">
    <input type="hidden" id="empId" name="empId" value="<?php echo $empCode;?>">
    <div class="form-body">
        <div class="form-group">
            <div class="col-md-12">
                <div class="col-md-12">
                    <label class="control-label">Language<span class="required">
                            * </span>
                    </label></br>
                    <Select class="form-control" name="language" id="language">
                        <?php $sql="select * from lovmast where lov_value not in (select Languge from ResLanguges where EMP_CODE='$empCode') and  LOV_Field='languge'";
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
                <div class="col-md-3">
                    <label class="control-label">Read<span class="not-required">
                             </span>
                    </label>
                    <input type="checkbox" name="read" onclick="check('read1');" class="form-control" value="N" id="read1"/>
                </div>
                <div class="col-md-3">
                    <label class="control-label">Write<span class="not-required">
                            </span>
                    </label>
                    <input type="checkbox" name="write" onclick="check('writr1');" class="form-control" value="N" id="write1"/>
                </div>
                <div class="col-md-3">
                    <label class="control-label">Speak<span class="not-required">
                             </span>
                    </label>
                    <input type="checkbox" name="speak" onclick="check('speak1');" class="form-control" value="N" id="speak1"/>
                </div>
                <div class="col-md-3">
                    <label class="control-label">Understand<span class="not-required">
                            </span>
                    </label>
                    <input type="checkbox" name="understand"  onclick="check('understand1');" class="form-control" value="N" id="understand1"/>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <div class="col-md-3">
                    <label class="control-label">Mother Tongue<span class="not-required">
                             </span>
                    </label>
                    <input type="checkbox" name="motherTongue" onclick="check('motherTongue23');" class="form-control"  value="N" id="motherTongue23"/>
                </div>
            </div>
        </div>


    </div>
    <div class="form-actions">
        <div class="row">
            <div class="col-md-offset-8 col-md-5">
                <button type="button" onclick="submitAddLang();" class="btn blue">OK</button>
                <button type="button" data-dismiss="modal" class="btn default">Cancel</button>
            </div>
        </div>
    </div>
</form>