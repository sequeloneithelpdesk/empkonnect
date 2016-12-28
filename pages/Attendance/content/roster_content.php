
<div class="tab-pane" id="tab_4">
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>Roster Configuration
            </div>
            <div class="tools">
               
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <form  enctype="multipart/form-data" id="form" name="mailconfigform" class="form-horizontal form-row-seperated">
                <div class="form-body">

                <div class="form-group">
                     <div id="err" class="alert alert-danger display-hide">

    </div>
    <div id="succ" class="alert alert-success display-hide">
        <button class="close" data-close="alert"></button>
        Roster Created successfully! 
    </div>
                </div>
                
                    <input type="hidden" placeholder="Enter Your Roster Name" id="workName" value="Ros<?php echo $d=date('h_i_s'); ?>" class="form-control editmenu" />
                    <!-- <div class="form-group">
                        <label class="control-label col-md-3">Roster Name</label>
                        <div class="col-md-6">
                            <input type="text" placeholder="Enter Your Roster Name" id="workName" class="form-control editmenu" onkeyup="Roster.checkrolename('workName','Roster_schema','RosterName');validate.require('workName','errorhidreq1');"/>
                        </div>
                    </div> -->

                    <div class="form-group" id="rost_org">
                        <label class="control-label col-md-3">For Whom</label>
                        <div class="col-md-6">
                            <select id="forWhome" class="form-control" onchange="Roster.showdefault();">
                            <option value="1122" selected >Company</option>
                                <option value="122" >Bussiness Unit</option>
                                <option value="222">Location</option> 
                                <option value="322">Work Location</option>
                                <option value="422">Function</option>
                                <option value="522">Sub Function</option>
                                <option value="622">Grade</option>
                                <option value="722">Employee Type</option>
                                <option value="922">Process</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="rost_confirm">
                        <div class="col-md-5" id="showsuboption" style="border:1px solid #eee;height:300px;overflow:auto;padding-top:10px;">
                        </div>
                        <div class="col-md-2" style="padding-top:10%;">
                            <button type="button" class="btn btn-block green" id="add" onclick="Roster.addConfirm();">Add</button>
                        </div>
                        <div class="col-md-5" id="showConfirm" style="border:1px solid #eee;height:300px;overflow:auto;padding-top:10px;">

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12" >
                        <div class="col-md-3">
                            <button type="button" class="btn btn-block success" id="emproster" onclick="Roster.addemp('bulk');"> Get Employee </button>
                        </div>

                            <div class="col-md-9" id="empshowdiv" style="display:none;">
                            <div class="col-md-9" >
                            <select id="select2_sample2" class="form-control select2" multiple>
                            
                            </select>
                            <div id="selectemp"></div>
                            </div>
                            <div class="col-md-3" style="margin-top:10px;">
                                <a id="selall" onclick="Roster.addemp('all');">Select All</a>
                            </div>
                            </div>
                            <input type="hidden" id="hiddata" value=''>
                        </div>
                    </div>
                    <div class="form-group rost_showdiv" >
                        
                        <div class="col-md-12" style="left: -16px;">
                            <div class="col-md-4">
                            <label class="control-label col-md-6" >Roster From :

                            </label>
                            <div class="col-md-6">
                                <input type="text" id="dfrom" name="dfrom" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                            <label class="control-label col-md-6">Roster To :

                            </label>
                            <div class="col-md-6">
                                <input type="text" id="dto" name="dto" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label col-md-8">Automatic forward roster</label>
                                <div class="col-md-4" style="padding-top:8px;">
                                    <input type="checkbox" id="auto_p" value="0" onclick="Roster.autocheck(this);">

                                </div>
                                <input type="hidden" value="0" id="rostemp">
                            </div>
                             <div class="col-md-offset-8 col-md-4">
                                <input type="button"   class="btn btn-primary btn-block" value="Create Roster" style="margin-top:28px" onclick="ros.init()"/>
                            </div>
                          </div>
                    </div>
                         
                           
                        
                            
                                <?php
                                    $result=query($query,"select ShiftMastId,Shift_Name from ShiftMast ",$pa,$opt,$ms_db);
                                    $shiftM = array();
                                while ($row=$fetch($result)){
                                    
                                    
                                    $shiftM[$row[0]] = $row[1];
                                 

                                }
 
                                        $result=query($query,"select ShiftPatternMastid,ShiftPattern_Name from ShiftPatternMast ",$pa,$opt,$ms_db);
                                        $ShiftpatternM = array();
                                        while ($row=$fetch($result)){
 
                                            $ShiftpatternM[$row[0]] = $row[1];
                                           

                                        }
                                        ?>
                                     
                     
                        
                     <div  id="addroster_M">

                     </div>
<script>
var shiftM = JSON.parse('<?php echo  json_encode($shiftM) ?>');
var ShiftpatternM = JSON.parse('<?php echo  json_encode($ShiftpatternM) ?>');
</script>
                        <div class="form-group rost_showdiv">
                            <!-- <div class="col-md-6">
                            <label class="control-label col-md-6">Define Default Period</label>
                            <div class="col-md-3" style="padding-top:8px;">
                                <input type="checkbox" id="de_p" value="0">

                            </div>
                            </div> -->
                            
                        </div>
                
                <div class="form-group rost_showdiv">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <input type="hidden" name="add" id="add" value="Add" />
                            <button type="button" class="btn green" id="submitRosterconfig" onclick="ros.savesql()"><i class="fa fa-check"></i> Submit</button>
                        </div>
                    </div>
                </div>
                </div>
                <input type="hidden" id="errorhid" value="0">
                <input type="hidden" id="errorhidreq1" value="1">
                <input type="hidden" id="errorhidreq2" value="0">
                <input type="hidden" id="errorhidreq3" value="0">
                <input type="hidden" id="errorhidreq4" value="0">
                <input type="hidden" id="errorhidreq5" value="0">
            </form>
            <!-- END FORM-->
        </div>
    </div>
</div>
