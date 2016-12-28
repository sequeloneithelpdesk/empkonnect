<?php
if(isset($_GET['holidayID']) && !empty($_GET['holidayID'])){
    include '../../../db_conn.php';
    include '../../../configdata.php';
    $colValue = $_GET['holidayID'];
    $sql = "SELECT HolidayID,CONVERT(varchar(10),HDATE,126) 'HDATE',LOC_CODE,HDESC,HCODE FROM HOLIDAYS where holidayID='$colValue'";
    $result=query($query,$sql,$pa,$opt,$ms_db);
    $row = $fetch($result);
    //$row = $obj->GetData("holidays","holidayID",$colValue);
    $hDate =$row['HDATE'];
    $locCode = $row['LOC_CODE'];
    $hCode = $row['HCODE'];
    $hDesc = $row['HDESC'];
?>
<form action="#" id="form_sample_2" class="form-horizontal">
                        <div class="form-body">
                            <div class="alert alert-danger display-hide">
                                <button class="close" data-close="alert"></button>
                                You have some form errors. Please check below.
                            </div>
                            <div class="alert alert-success display-hide">
                                <button class="close" data-close="alert"></button>
                               Holiday Updated successfully!
                            </div>
                     <div class="form-group">
                      <div class="col-md-12">
                        <div class="col-md-6">
                            <label class="control-label">Holiday Date <span class="required">
                            * </span>
                            </label></br>
                            <input type="hidden" name="holidayID" class="form-control" value="<?php echo $colValue; ?>"/>
                            <input type="date" name="hDate" class="form-control" value="<?php echo $hDate; ?>"/>
                        </div>
                           <div class="col-md-6">                          
                            <label class="control-label">Applicable Location <span class="required">
                            * </span>
                            </label></br>
                              <input name="locCode" type="text" class="form-control" value="<?php echo $locCode; ?>"/>
                           </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12">
                      <div class="col-md-6">                          
                            <label class="control-label">Holiday Code<span class="required">
                            * </span>
                            </label></br>
                              <input name="hCode" type="text" class="form-control" value="<?php echo $hCode; ?>"/>
                           </div>
                        <div class="col-md-6">
                            <label class="control-label">Holiday Name<span class="required">
                            * </span>
                            </label></br>
                            <input type="text" name="hDesc" class="form-control" value="<?php echo $hDesc; ?>"/>
                        </div>
                      </div>
                    </div>
                </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-9 col-md-3">
                                                <button type="submit" class="btn blue"  id="subbut" >Submit</button>
                                                <button type="button" data-dismiss="modal" class="btn default">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
<?php } ?>
