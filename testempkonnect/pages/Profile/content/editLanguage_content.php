<?php
include "../../db_conn.php";
include "../../configdata.php";
$langlid= $_POST['id'];
//echo $langlid;

$sql="select a.*,b.LOV_Text,b.LOV_Value from (select * from ResLanguges where ResLangugesID='$langlid') a inner join lovmast b on a.Languge=b.lov_value and b.LOV_Field='languge'
";
$result = query($query,$sql,$pa,$opt,$ms_db);
$row = $fetch($result);

?>


<form action="#" id="editLanguageForm" class="form-horizontal">
    <input type="hidden" value="<?php echo $langlid;?>" id="lang_id" name="lag_id">
    <div class="form-body">
        <div class="form-group">
            <div class="col-md-12">
                <div class="col-md-12">
                    <label class="control-label">Language<span class="required">* </span></label></br>  
                    <Select class="form-control" name="language" id="language">
                        <?php
                         $sql2="select * from lOVMast where LOV_Field='languge'";
                        $result2=query($query,$sql2,$pa,$opt,$ms_db);
                        while($data=$fetch($result2)){
                        ?>
                        <option value="<?php echo $data['LOV_Value'];?>" <?php if($data['LOV_Value']== $row['LOV_Value'] ){ echo "selected"; } ?> ><?php echo $data['LOV_Text'];?> </option>
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
                    <input type="checkbox" name="read"  onclick="check('read1');"  <?php if($row['Read_YN']=="Y"){echo "checked "; echo " value=Y";}else {echo " value=N";}?>  class="form-control"  id="read1" style="width: 20PX;"/>
                </div>
                <div class="col-md-3">
                    <label class="control-label">Write<span class="not-required">
                            </span>
                    </label>
                    <input type="checkbox" name="write" onclick="check('write1');"  <?php if($row['Write_YN']=="Y"){echo "checked "; echo " value=Y";}else {echo " value=N";}?>  class="form-control" id="write1" style="width: 20PX;"/>
                </div>
                <div class="col-md-3">
                    <label class="control-label">Speak<span class="not-required">
                             </span>
                    </label>
                    <input type="checkbox" name="speak" onclick="check('speak1');"  <?php if($row['Speak_YN']=="Y"){echo "checked "; echo " value=Y";}else {echo " value=N";}?>  class="form-control"  id="speak1" style="width: 20PX;"/>
                </div>
                <div class="col-md-3">
                    <label class="control-label">Understand<span class="not-required">
                            </span>
                    </label>
                    <input type="checkbox" name="understand" class="form-control"  onclick="check('understand1');"  <?php if($row['understand']=="Y"){echo "checked "; echo " value=Y";}else {echo " value=N";}?>  id="understand1" style="width: 20PX;"/>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <div class="col-md-3">
                    <label class="control-label">Mother Tongue<span class="not-required">
                             </span>
                    </label>

                    <input type="checkbox" name="motherTongue" class="form-control" onclick="check('motherTongue23');"  <?php if($row['motherTongue']=="Y"){echo "checked "; echo " value=Y";}else {echo " value=N";}?> id="motherTongue23" style="width: 20PX;"/>
                    
                </div>
            </div>
        </div>


    </div>
    <div class="form-actions">
        <div class="row">
            <div class="col-md-offset-8 col-md-5">
                <button type="button" class="btn blue" onclick="submitEditLanguage();">OK</button>
                <button type="button" data-dismiss="modal" class="btn default">Cancel</button>
            </div>
        </div>
    </div>
</form>
