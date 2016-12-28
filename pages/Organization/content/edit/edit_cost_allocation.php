<?php
if(isset($_GET['OempCode']) && !empty($_GET['OempCode'])){
    include $_SERVER['DOCUMENT_ROOT']."/pages/HRMSClass/HRMSClass.php";
    $obj=new HRMSClass;
    $colValue = $_GET['OempCode'];
    $row = $obj->GetData("costallocmast","OempCode",$colValue);
    $empCode =$row['Emp_Code'];
    $costPer = $row['Cost_Per'];
    $orgMaster = $row['orgMaster'];
              ?>
<form action="#" id="form_sample_2" class="form-horizontal">
                    <div class="form-body">
                        <div class="alert alert-danger display-hide">
                            <button class="close" data-close="alert"></button>
                            You have some form errors. Please check below.
                        </div>
                        <div class="alert alert-success display-hide">
                            <button class="close" data-close="alert"></button>
                            Cost Allocation Details Updated  successfully!
                        </div>
     <div class="form-group">
      <div class="col-md-12">
        <div class="col-md-6">
            <label class="control-label">Employee Code <span class="required">
            * </span>
            </label></br>
            <input type="hidden" name="OempCode" class="form-control" value="<?php echo $colValue; ?>"/>
            <input type="text" name="empCode" class="form-control" value="<?php echo $empCode; ?>"/>
        </div>
           <div class="col-md-6">                          
            <label class="control-label">Serial No For Cost Allocation <span class="required">
            * </span>
            </label></br>
              <input name="sNo" type="text" class="form-control" value="<?php echo $sNo; ?>"/>
           </div>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-12">
      <div class="col-md-6">                          
            <label class="control-label">Percentage Of Allocation<span class="required">
            * </span>
            </label></br>
              <input name="costPer" type="text" class="form-control" value="<?php echo $costPer; ?>" />
           </div>
           <div class="col-md-6">                          
            <label class="control-label">Applicable Organization Master<span class="required">
            * </span>
            </label></br>
              <input name="orgMaster" type="text" class="form-control" placeholder="" value="<?php echo $orgMaster; ?>"/>
           </div>                       
      </div>
    </div>                   
</div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-9 col-md-3">
                                <button type="submit" class="btn blue"  id="subbut" >Update</button>
                                <button type="button" data-dismiss="modal" class="btn default">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
 <?php

  }
 ?>
 
