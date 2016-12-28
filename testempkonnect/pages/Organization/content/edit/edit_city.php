<?php
if(isset($_GET['cityId']) && !empty($_GET['cityId'])){
    include $_SERVER['DOCUMENT_ROOT']."/pages/HRMSClass/HRMSClass.php";
    $obj=new HRMSClass;
    $colValue = $_GET['cityId'];
    $row = $obj->GetData("cityMast","CityID",$colValue);
    $cityName =$row['City_NAME'];
    $stateId = $row['State_Id'];

?>
<form action="#" id="form_sample_2" class="form-horizontal">
                                    <div class="form-body">
                                        <div class="alert alert-danger display-hide">
                                            <button class="close" data-close="alert"></button>
                                            You have some form errors. Please check below.
                                        </div>
                                        <div class="alert alert-success display-hide">
                                            <button class="close" data-close="alert"></button>
                                            City Details Updated successfully!
                                        </div>
                     <div class="form-group">
                      <div class="col-md-12">
                        <div class="col-md-6">
                            <label class="control-label">City Name<span class="required">
                            * </span>
                            </label></br>
                            <input type="hidden" name="cityId" class="form-control" value="<?php echo $colValue; ?>"/>
                            <input type="text" name="cityName" class="form-control" value="<?php echo $cityName; ?>"/>
                        </div>
                           <div class="col-md-6">                          
                            <label class="control-label">State ID<span class="required">
                            * </span>
                            </label></br>
                              <input name="stateId" type="text" class="form-control" value="<?php echo $stateId; ?>" />
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
