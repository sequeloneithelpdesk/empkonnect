<div class="page-content-wrapper" xmlns="http://www.w3.org/1999/html">
    <div class="page-content cus-light-grey">

        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <div class="tabbable tabbable-custom tabbable-noborder tabbable-reversed">

                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_0">
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                    
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>Apply For Leave
                                    </div>
                                  
                                </div>
                                <div class="portlet-body form">
                                    <!-- BEGIN FORM-->
                                    <form action="#" class="form-horizontal" id="leaveForm">
                                    <input type="hidden" name="empcode" id="empcode" value="<?php echo $code;?>">
                                        <div class="form-body" >
                                        <div class="col-md-8">
                                            
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">From Date</label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" name="fromDate" id="fromDate" placeholder="dd/mm/yy" onchange="getAppliedDays();">
                                                </div> 
                                            </div>

                                            <div class="form-group" id="showforD" style="display:none">
                                                <label class="col-md-3 control-label">
                                                    Mark this as Half day
                                                </label>
                                                <div class="input-group col-md-5">
                                                    <div class="icheck-inline">
                                                        <label>
                                                        <input type="radio" name="radio1" id="radio1" value="1FH" onclick="makehalf();" class="icheck"> First Half</label>
                                                        <label>
                                                        <input type="radio" name="radio1" id="2fh" class="icheck" value="2FH" onclick="makehalf();"> Second half </label>
                                                        <label>
                                                        <input type="radio" name="radio1" id="fullDay" class="icheck" value="2FD" onclick="makeFull();" checked> Full Day </label>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                 <div  id="multipleDate">
                                                    <label class="col-md-3 control-label">To</label>
                                                    <div class="col-md-5">
                                                    <input type="text" class="form-control" name="toDate" id="toDate" placeholder="dd/mm/yy"
                                                    onchange="getToDate();myAttendanceByDAte('<?php echo $code;?>','fromDate','toDate');" disabled>
                                                    <div id="err_attendance" style="color:red;"></div>
                                                        
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="form-group" id="halfshow" style="display:none">
                                                <label class="col-md-3 control-label">
                                                        Mark this as Half day
                                                </label>
                                                <div class="input-group col-md-5">
                                                    <div class="icheck-inline">
                                                        <label>
                                                        <input type="radio" name="radio2"  class="icheck" id="1th" onclick="maketohalf();"> First Half</label>
                                                        <label>
                                                        <input type="radio" name="radio2" class="icheck" id="2th" onclick="maketohalf();"> Second half </label>
                                                        <label>
                                                        <input type="radio" name="radio2" id="fulltoDay" class="icheck" value="2FD" onclick="makeFull();" checked> Full Day </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">
                                                       Leave Request For
                                                </label>

                                                <div class="input-group col-md-5">
                                                <input type="hidden" name="leaveFor" id="leaveFor" value="<?php echo $code;?>">
                                                    <div class="icheck-inline">
                                                        <label>
                                                        <input type="radio" name="radio3" checked class="icheck" onclick="empDetails('<?php echo $code?>','MySelf');" value="<?php echo $code; ?>"> MySelf</label>
                                                        
                                                        <?php 
                                                            $sql="select count(Emp_Code) as number from Hrdmastqry where MNGR_CODE='$code'";
                                                            $res=query($query,$sql,$pa,$opt,$ms_db);
                                                            $val=$fetch($res);
                                                            if($val['number'] >= 1){
                                                        ?>
                                                        <label>
                                                        <input type="radio" name="radio3" class="icheck" onclick="empDetails('<?php echo $code?>','MyTeam')"> MyTeam </label>
                                                        <?php }?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group" id="empdetail" style="display: none;">
                                                <label class="col-md-3 control-label"></label>
                                                <div class="col-md-5">
                
                                                    <select class="form-control" id="empCheck" name="empCheck" onclick="setLeaveFor(this.value);">
                                                    <option value="">select </option>
                                                        <?php $sql="select * from Hrdmastqry where MNGR_CODE='$code'";
                                                         $result = query($query,$sql,$pa,$opt,$ms_db);
                                                        while($row = $fetch($result)) { ?>
                                                            <option  value="<?php echo $row['Emp_Code'];?>" >
                                                                <?php echo $row['EMP_NAME']; ?>
                                                            </option>
                                                            <?php } ?>
                                                    </select>  
                                                 </div>
                                            </div>
                                             <?php
                        $sql="select Levkey from Leave WHERE CreatedBy='$code' group by Levkey";
                        $res=query($query,$sql,$pa,$opt,$ms_db);
                          // $Levkey_array=array();
                            $countel=0;
                           while ($rows = $fetch($res)){
                           $Levkey_val=$rows['Levkey'];
                          // echo $Levkey_val."aaa";
                             $sql1="select TOP 1 leaveID,CONVERT (VARCHAR(10),LvFrom,103 ) as LvFrom,CONVERT (VARCHAR(10),LvTo,103 ) as LvTo,LvDays,reason,ApprovedBy,status,Levkey from Leave WHERE Levkey='$Levkey_val' and lvtype='1' order by leaveID DESC ";
                               $res1=query($query,$sql1,$pa,$opt,$ms_db);
                          // $Levkey_array=array();
                              while ($rows1 = $fetch($res1)){
                                 if($rows1['status'] == '2'){
                                     $countel++;
                                 }
                              
                              }
                           }  
      
      
   

                            ?>
                                            <input type="hidden" id="el_used" value='<?php echo $countel?>'>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Apply Leave Type</label>
                                                <div class="col-md-5">
                                                    <select class="form-control" name="leaveType" id="leaveType" onchange="getLeaveBalance(this.value,'<?php echo $code;?>');">
                                                    <option value="">Select Type</option>
                                                     <?php if($empType == 1 || $empType == 2 ){
                                                         $month = array("06", "12");
                                                         //echo $data['sex'];

                                                         $month_val = date('m');
                                                         if(in_array($month_val,$month)){
                                                             if($data['MStatus'] == '2'){
                                                                 if($data['Sex'] == '1'){
                                                                     $sql="select LOV_Value,LOV_Text from LOVMast where LOV_Field='leave' AND LOV_Value!='5' AND LOV_Value!='7' AND LOV_Value!='9'";
                                                                 }
                                                                 else{
                                                                     $sql="select LOV_Value,LOV_Text from LOVMast where LOV_Field='leave' AND LOV_Value!='5' AND LOV_Value!='9'";
                                                                 }

                                                             }
                                                             else{
                                                                 if($data['Sex'] == '1'){
                                                                     $sql="select LOV_Value,LOV_Text from LOVMast where LOV_Field='leave' AND LOV_Value!='7' AND LOV_Value!='6' AND LOV_Value!='9'";
                                                                 }
                                                                 else{
                                                                     $sql="select LOV_Value,LOV_Text from LOVMast where LOV_Field='leave' AND LOV_Value!='6' AND LOV_Value!='9'";
                                                                 }

                                                             }
                                                         }
                                                         else{
                                                             if($data['MStatus'] == '2'){
                                                                 if($data['Sex'] == '1'){
                                                                     $sql="select LOV_Value,LOV_Text from LOVMast where LOV_Field='leave' AND LOV_Value!='5' AND LOV_Value!='7' AND LOV_Value!='8' AND LOV_Value!='9'";
                                                                 }
                                                                 else{
                                                                     $sql="select LOV_Value,LOV_Text from LOVMast where LOV_Field='leave' AND LOV_Value!='5' AND LOV_Value!='8' AND LOV_Value!='9'";
                                                                 }

                                                             }
                                                             else{
                                                                 if($data['Sex'] == '1'){
                                                                     $sql="select LOV_Value,LOV_Text from LOVMast where LOV_Field='leave' AND LOV_Value!='7' AND LOV_Value!='6'  AND LOV_Value!='8' AND LOV_Value!='9'";
                                                                 }
                                                                 else{
                                                                     $sql="select LOV_Value,LOV_Text from LOVMast where LOV_Field='leave' AND LOV_Value!='6' AND LOV_Value!='8' AND LOV_Value!='9'";
                                                                 }

                                                             }
                                                         }

                                                        $sql.= " AND (LOV_OrdNo='1' or LOV_OrdNo='10')"; 

                                                           $result = query($query,$sql,$pa,$opt,$ms_db);
                                                            while($row = $fetch($result)){ ?>
                                                            <option  value="<?php echo $row['LOV_Value'] ?>">
                                                           <?php echo $row['LOV_Text'] ?>
                                                       </option>

                                                       <?php }
                                                   }

                                                   else if($empType == 3){

                                                        $sql="select LOV_Value,LOV_Text from LOVMast where LOV_Field='leave' AND (LOV_OrdNo='2' or LOV_OrdNo='10')";
                                                                
                                                           $result = query($query,$sql,$pa,$opt,$ms_db);
                                                            while($row = $fetch($result)){  
                                                        ?>
                                                       <option  value="<?php echo $row['LOV_Value'] ?>">
                                                           <?php echo $row['LOV_Text'] ?>
                                                       </option>
                                                       <?php } }
                                                        else if($empType == 4){

                                                        $sql="select LOV_Value,LOV_Text from LOVMast where LOV_Field='leave' AND (LOV_OrdNo='3' or LOV_OrdNo='10')";
                                                                
                                                           $result = query($query,$sql,$pa,$opt,$ms_db);
                                                            while($row = $fetch($result)){  
                                                        ?>
                                                       <option  value="<?php echo $row['LOV_Value'] ?>">
                                                           <?php echo $row['LOV_Text'] ?>
                                                       </option>
                                                       <?php } }?>
                                                       
                                                    </select>
                                                    <div id="leaveErr" style="color:red;"></div>
                                                </div>
                                                
                                                <span id="usenextleave" style="display: none; float:left"><br>
                                                    <div class="col-md-12">
                                                        <input type="checkbox" value="0" id="DeviationLeave" name='DeviationLeave' class="setDL"  onchange="getDLLevel()" />Do you want to use Earned Leave of upcoming Year?
                                                        <div id="error_properapprover" style="color:red"></div>
                                                    </div>
                                                </span>


                                            </div>


                                                <div class="col-md-12" id="uploadMultiple" style="display:none;">
                                                    <div class="col-md-6">
                                                    <label class="control-label">Upload Attachments
                                                    </label></br>
                                                    <input type="file" name="uploadfile[]" id="uploadfile" onChange="logoimage_Validation();"/>
                                                        </div>
                                                    <div class="col-md-6">
                                                        <input type="button" value="+" onclick="addMoreFile()" ><span id="dialoginvalid"  style="color: #FF0000"></span>
                                                        </div>
                                                    <br><br>
                                                    <div id="uploadgroup">
                                                        <br> <br>
                                                    </div>
                                                    <br>
                                                   <!-- <div class="col-md-1" style="float: right">
                                                        <input type="button" value="upload" onclick="getUploadVal()">
                                                    </div>-->
                                                </div>
                                            <span id="message"></span>


                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Reason</label>
                                                <div class="col-md-5">
                                                <textarea name="reason"  rows="3" cols="15" id="reason" class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="col-md-12 red-bg white-txt z-depth-1" style="padding: 10px;font-size: 12px;border-radius: 3px!important;"> 
                                            <span>No of Days Applied</span>
                                              
                                            <strong id="noOfDays" class="fl-r" name="noOfDays" style="font-size: 12px;line-height: 19px;">0</strong>
                                                    
                                            </div>
                                            <div class="clearfix" style="margin-bottom: 10px;">
                                            </div>
                                            <div class="z-depth-1 clearfix">
                                               <p class="blue-bg col-md-12 white-txt m-0" style=" padding: 10px 12px;">My Leave Balance Details</p>
												<div id="my_leave" class='col-md-12 p-0'>
                                                
												</div>

                                                

                                                <div>
                                                   <!-- <label>Privilage Leave:</label>&nbsp;&nbsp;&nbsp;
                                                   <strong id="pl">0.0</strong> -->
                                                </div>
                                            </div>
                                            <div class="clearfix" style="margin-bottom: 10px;">
                                            </div>
                                           <div class="z-depth-1">
                                               <p class="green-bg white-txt m-0" style=" padding: 10px 0;">
                                               <span class="col-md-7">Holidays</span>
                                               <span><a id="upcome" onclick="Leave.upcome();" class="white-txt"> Upcoming </a></span><span><a id="pastcome" onclick="Leave.pastcome();" class="white-txt" style="
    float: right;
    padding: 0 15px 0 0;
">Past  </a></sapn></p>
												 <div class="clearfix" style="margin-bottom: 10px;" id="show_holiday">
                                            </div>
                                            </div>
                                           
                                        </div>
                                        <div class="clearfix"></div>

                                            <div class="form-actions" style="padding: 5px;    color: purple;">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                    My Alternative Contact Details
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group" style="margin-top: 10px;"> 
                                                <label class="col-md-1 control-label">
                                                   Mobile
                                                </label>
                                                <div class="col-md-3">  
                                                   <input type="text" class="form-control" width="100%" name="empMobile">
                                                </div>

                                                <label class="col-md-1 control-label">
                                                   Email
                                                </label>
                                                <div class="col-md-3">  
                                                   <input type="text" class="form-control" onkeyup="validate.email(empEmail,error)" onchange="getForwardEmail(this.value);" id="empEmail" name="empEmail">
                                                </div>

                                                <label class="col-md-1 control-label">
                                                   Address
                                                </label>
                                                <div class="col-md-3">  
                                                   <input type="text" class="form-control" name="empAddress">
                                                </div>
                                            </div>
                                            <input type="hidden" name="approvalReq" id="approvalReq" value="0">
											<input type="hidden" name="approvalReq1" id="approvalReq1" value="0">
											<input type="hidden" name="approvalReq2" id="approvalReq2" value="0">
                                            <div class="form-group" id="myselftable" style=" display:block;">
                                                
                                                <div class="col-md-12">
                                                    <!-- BEGIN SAMPLE TABLE PORTLET-->
                                                    <div class="portlet box ">
                                                   <div class="portlet-body">
                                                        <div class="table-scrollable">
                                                            <table class="table table-hover">
                                                            <thead>
                                                            <tr>
                                                               <th>Approval Required</th>
                                                                <th>Send To</th>
                                                                <th>Keep Pending till i return</th>
                                                                <th>Forward To My Contact Email</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                        <tr>
                                                        <td>Leave Application</td>
                                                        <td>
                                                            <label>
                                                            <input type="radio" name="radio4" id="levSend" onclick="closeDropDown('2');" class="icheck" value="">

                                                            <select name="sendTo" id="sendTo" class="form-control     input-medium select2me" onchange="getSendTo(this.value);" data-placeholder="Select..." style="display:none;">
                                                                      <option value=""></option>>
                                                                        <?php $quer="select EMP_NAME, Emp_Code from Hrdmastqry"; 
                                                                        $res=query($query,$quer,$pa,$opt,$ms_db);
                                                                        while ($ro= $fetch($res)) {
                                                                        ?>
                                                                            <option value='<?php echo $ro['Emp_Code'] ?>'><?php echo $ro['EMP_NAME'];?> (<?php echo $ro['Emp_Code'];?>)</option>
                                                                        <?php }?>    
                                                                </select>

                                                             </label>
                                                        </td>

                                                        <td>
                                                            <label>
                                                            <input type="radio" name="radio4"  class="icheck" onclick="closeDropDown('0');" value="Pending" checked>
                                                            
                                                            </label>
                                                        </td>

                                                        <td>
                                                            <label>
                                                            <input type="radio" name="radio4" id="forwardTo" onclick="closeDropDown('1');" class="icheck" value="">
                                                              
                                                            </label>
                                                        </td>

                                                        </tr>
                                                        <tr>
                                                            <td>On Duty Attendance</td>
                                                        <td>
                                                            <label>
                                                            <input type="radio" name="radio5" id="sendODTo" class="icheck" onclick="closeDropDown1('2');" value="">
                                                            <select name="sendODTo" id="oDDropDown" onchange="getODSendTo(this.value);" class="form-control input-medium select2me" data-placeholder="Select..." style="display:none;">
                                                              <option value=""></option>
                                                                <?php $quer="select EMP_NAME, Emp_Code from Hrdmastqry"; 
                                                                $res=query($query,$quer,$pa,$opt,$ms_db);
                                                                while ($ro= $fetch($res)) {
                                                                ?>
                                                                    <option value='<?php echo $ro['Emp_Code'] ?>'><?php echo $ro['EMP_NAME'];?> (<?php echo $ro['Emp_Code'];?>)</option>
                                                                <?php }?>    
                                                                </select> </label>
                                                        </td>

                                                        <td>
                                                            <label>
                                                            <input type="radio" name="radio5" onclick="closeDropDown1('0');" class="icheck" value="Pending" checked>
                                                            
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label>
                                                            <input type="radio" name="radio5" id="forwardODTo"  class="icheck" onclick="closeDropDown1('1');" value="">
                                                             </label>
                                                        </td>
                                                        </tr>
                                                        <tr>
                                                        <td>Past Attendance</td>
                                                        <td>
                                                            <label>
                                                             <input type="radio" name="radio6" id="sendPastTo" class="icheck" value=""
                                                             onclick="closeDropDown2('2');">

                                                            <select name="sendPastTo" id="pastDropDown" onchange="getPastSend(this.value);" class="form-control input-medium select2me" data-placeholder="Select..." style="display:none;">
                                                          <option value=""></option>>
                                                            <?php $quer="select EMP_NAME, Emp_Code from Hrdmastqry"; 
                                                            $res=query($query,$quer,$pa,$opt,$ms_db);
                                                            while ($ro= $fetch($res)) {
                                                            ?>
                                                                <option value='<?php echo $ro['Emp_Code'] ?>'><?php echo $ro['EMP_NAME'];?> (<?php echo $ro['Emp_Code'];?>)</option>
                                                            <?php }?>    
                                                            </select></label>
                                                        </td>

                                                        <td>
                                                            <label>
                                                            <input type="radio" name="radio6" onclick="closeDropDown2('0');" class="icheck" value="Pending" checked>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label>
                                                            <input type="radio" name="radio6" id="forwardPastTo" class="icheck third" onclick="closeDropDown2('1');" value="">
                                                             </label>
                                                        </td>
                                                        </tr>
                                                                </tbody>
                                                                </table>
                                                            </div>
                                                        </div> 





                                <!-- <div class="leavePurCon col-md-9">
                              <div class="col-md-4">
                                <ul class="p-0">
                                <li><strong>Approval Required</strong></li>
                                <li>Leave Application</li>
                                <li>On Duty Attendance</li>
                                <li>Past Attendance</li></ul>
                              </div>
                              <div class="col-md-4">
                                <div class="leaveRadCon"><span><strong>Action</strong></span></div>
                                  <div class="leaveRadCon">
                                      <span class="downArrow"><span class="clickUpdate1">Select</span>
                                      <ul class="p-0 z-depth-1">
                                      <li> 
                                      <input type="radio" name="radio4" radioBtnName="send to" id="levSend" onclick="openDropDown('sendTo');" class="icheck" value="">
                                      </li>
                                      <li>
                                         <input type="radio" name="radio4" radioBtnName="Keep Pending" class="icheck" onclick="closeDropDown('sendTo');" value="Pending" checked> 
                                      </li>
                                      <li>
                                         <input type="radio" name="radio4" radioBtnName="forward email" id="forwardTo" onclick="closeDropDown('sendTo');" class="icheck" value=""> 
                                      </li>
                                      </ul>
                                      </span>
                                  </div>
                                  <div class="leaveRadCon">
                                      <span class="downArrow secoNd">Select
                                      <ul class="p-0 z-depth-1">
                                      <li>
                                          <input type="radio" name="radio5" radioBtnName="send to" id="sendODTo" class="icheck" onclick="openDropDown('oDDropDown');" value="">
                                      </li>
                                      <li>
                                          <input type="radio" name="radio5" radioBtnName="Keep Pending" onclick="closeDropDown('oDDropDown');" class="icheck" value="Pending" checked>
                                      </li>

                                      <li>
                                          <input type="radio" name="radio5" radioBtnName="forward email" id="forwardODTo"  class="icheck" onclick="closeDropDown('oDDropDown');" value="">
                                      </li>
                                      <ul>
                                      </span>
                                  </div>
                                  <div class="leaveRadCon">
                                      <span class="downArrow">Select
                                      <ul class="p-0 z-depth-1">
                                      <li>
                                           <input type="radio" name="radio6" radioBtnName="send to" id="sendPastTo" class="icheck" value="" onclick="openDropDown('pastDropDown');">
                                      </li>
                                      <li>
                                           <input type="radio" name="radio6" radioBtnName="Keep Pending" onclick="closeDropDown('pastDropDown');" class="icheck" value="Pending" checked>
                                      </li>
                                      <li>
                                           <input type="radio" name="radio6" radioBtnName="forward email" id="forwardPastTo" class="icheck" onclick="closeDropDown('pastDropDown');" value="">
                                      </li>
                                      </ul>
                                      </span>
                                  </div>                                
                              </div>
                              <div class="col-md-4">
                                  <div class="leaveRadCon"><span><strong>Action</strong></span></div> 
                                  <div class="leaveDropCon">
                                      <span>
                                           <select name="sendTo" id="sendTo" class="form-control     input-medium select2me" onchange="getSendTo(this.value);" data-placeholder="Select..." style="opacity:0;">
                                          <option value=""></option>>
                                            <?php $quer="select EMP_NAME, Emp_Code from Hrdmastqry"; 
                                            $res=query($query,$quer,$pa,$opt,$ms_db);
                                            while ($ro= $fetch($res)) {
                                            ?>
                                                <option value='<?php echo $ro['Emp_Code'] ?>'><?php echo $ro['EMP_NAME'];?> (<?php echo $ro['Emp_Code'];?>)</option>
                                            <?php }?>    
                                            </select>
                                      </span>
                                   </div>
                                   <div class="leaveDropCon">
                                      <span>
                                          <select name="sendODTo" id="oDDropDown" onchange="getODSendTo(this.value);" class="form-control input-medium select2me" data-placeholder="Select..." style="display:none;">
                                          <option value=""></option>
                                            <?php $quer="select EMP_NAME, Emp_Code from Hrdmastqry"; 
                                            $res=query($query,$quer,$pa,$opt,$ms_db);
                                            while ($ro= $fetch($res)) {
                                            ?>
                                                <option value='<?php echo $ro['Emp_Code'] ?>'><?php echo $ro['EMP_NAME'];?> (<?php echo $ro['Emp_Code'];?>)</option>
                                            <?php }?>    
                                            </select> 
                                      </span>
                                   </div>
                                   <div class="leaveDropCon">
                                      <span>
                                          <select name="sendPastTo" id="pastDropDown" onchange="getPastSend(this.value);" class="form-control input-medium select2me" data-placeholder="Select..." style="display:none;">
                                          <option value=""></option>>
                                            <?php $quer="select EMP_NAME, Emp_Code from Hrdmastqry"; 
                                            $res=query($query,$quer,$pa,$opt,$ms_db);
                                            while ($ro= $fetch($res)) {
                                            ?>
                                                <option value='<?php echo $ro['Emp_Code'] ?>'><?php echo $ro['EMP_NAME'];?> (<?php echo $ro['Emp_Code'];?>)</option>
                                            <?php }?>    
                                            </select>
                                      </span>
                                   </div>                                
                              </div>
                                </div> -->






                                                    </div>
                                                    <!-- END SAMPLE TABLE PORTLET-->
                                                </div>
                                            </div>
                                                
                                            <div class="form-group" id="apprMngr" style="display:none;">
                                               <div class="col-md-9">
                                               <div class="col-md-3">
                                                    Approve By &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </div>
                                                <div class="col-md-3">
                                                <img class="img-circle" src="../Profile/upload_images/<?php echo $data1['EmpImage'];?>"
                                                style="width: 25%;height: 25%;">
                                                </div>    
                                                <div class="col-md-3">
                                                 <?php echo $data1['EMP_NAME'];?>, <?php echo $data1['DSG_NAME'];?>, <?php echo $data1['MailingAddress'];?> 
                                                <input type="hidden" id="levellist" value=' <?php echo $data1['Emp_Code'];?>'>
                                                <strong> <span id="showlevel1"></span></strong>
                                                </div>
                                                </div>
                                            </div>

                                            <input type="hidden" id="levellist" value="">
                                                <div class="row">
                                                <div class="form-group" id="According_WorkFlow">
                                                <div class="col-md-12">
                                                <label class="col-md-3 control-label">Approved By</label>
                                                <div class="col-md-9" id="showlevel"> 
                                                </div>
                                                </div>
                                                </div>
                                                </div>

                                        <div class="form-actions" id="actionMyself">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button type="button" onclick="submitLeave('<?php echo $code; ?>',this.value);" class="btn btn-circle blue" id="leaveSubmit" value="<?php echo $mngrcode; ?>">Submit</button>
                                                    
                                                </div>
                                            </div>
                                        </div>


                                    </form>
                                    <!-- END FORM-->
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>