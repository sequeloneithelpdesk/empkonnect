<?php
include "../../db_conn.php";
include "../../configdata.php";
 $famid= $_POST['id'];
  $sql="select a.*,b.LOV_text,b.LOV_Value from (select *,CONVERT (varchar(10),Relative_DOB,103)as DOB from HrdFamily where hrdfamilyID= '$famid') a inner join lovmast b on a.relation=b.lov_value and b.LOV_Field='nominee' ";
  $result = query($query,$sql,$pa,$opt,$ms_db);
 $row = $fetch($result);
?>

<form action="#"  method="post" id="editfamForm" class="form-horizontal">
    <input type="hidden" id="fmid" name="fmid" value="<?php echo $famid;?>"/>

    <div class="form-body">
        <div class="form-group">
            <div class="col-md-12">
                <div class="col-md-6">
                    <label class="control-label">Relative Name<span class="required">
                            * </span>
                    </label></br>

                    <input type="text" name="relativeName" maxlength="50" value="<?php echo $row['Relative_Name'];?>" id="relativeName" class="form-control"/>
                </div>
                <div class="col-md-6">
                    <label class="control-label">Relationship<span class="required">
                            * </span>
                    </label></br>
                    <Select class="form-control" name="relationship" id="relationship">
                        <?php
                        $sql="select * from lovmast where lov_value not in (select Relation from hrdfamily where EMP_CODE='$empCode' and (Relation='1' or Relation='2' or Relation='5') group by Relation) and  LOV_Field='nominee'";
                        $result2=query($query,$sql,$pa,$opt,$ms_db);
                        while($data=$fetch($result2)){
                            ?>
                            <option <?php if($row['LOV_Value']== $data['LOV_Value']){echo "selected";}?> value="<?php echo $data['LOV_Value'];?>" ><?php echo $data['LOV_Text'];?> </option>
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
                    <input type="text" name="dateOfBirth" value="<?php echo $row['DOB'];?>" class="form-control" id="dateOfBirth"/>
                </div>
                <div class="col-md-6">
                    <label class="control-label">Dependent<span class="not-required">
                            </span>
                    </label>
                    <select name="dependent" id="dependent" class="form-control">
                        <option <?php if($row['Dependent']==0){echo "selected";}?> value="0">No</option>
                        <option <?php if($row['Dependent']==1){echo "selected";}?> value="1">yes</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions">
        <div class="row">
            <div class="col-md-offset-8 col-md-5">
                <button type="button"   class="btn blue" onclick="submitEditFamily();">OK</button>
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