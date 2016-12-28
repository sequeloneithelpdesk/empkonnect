<div class="page-content-wrapper" xmlns="http://www.w3.org/1999/html">
<div class="page-content">
<!--modal-dialog -->
<div class="modal fade bs-modal-lg" id="large" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog lg">
		<!-- modal-content -->
		<div class="modal-content" >
			<div class="modal-header portlet box blue">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title white-txt"><div class="caption"><span>My Out On Work Duty</span></div></h4>
			</div>
			<div class="modal-body" id="myodrequest">                
				<?php //include ("content/view_myodrequest.php"); ?>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
</div>
<!-- /.modal-dialog -->
<div class="row">
	<div class="col-md-12">			
		<!-- BEGIN CONDENSED TABLE PORTLET-->
		<div class="portlet box blue">

			<div class="portlet-title">
				<div class="caption">
					My Out On Duty Request 
				</div>
			</div>
			<div class="portlet-body">
				<div class="row">
                                <div class="col-md-12">

                                    <div class="btn-group ">
                                        <select class="form-control" onchange="getRelatedSelectbox(this.value,<?php echo $code;?>);">
                                            <option value="0">Select....</option>
                                            <option value="1">Request Applied On</option>
                                            <option value="2">Request Status</option>
                                            <option value="3">By Approver Name</option>
                                        </select>
                                    </div>

                                    <div class="btn-group" id="monthlySearch" style="display: none;margin-left: 45px;">
                                    	
                                        <div class="col-md-5">
	                                    <label class="control-label">
	                                    	From Date                
	                                    </label>&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="date" class="form-control" name="fromDate" id="fromDate" placeholder="dd/mm/yy">
										</div>
										<div class="col-md-5">	
										<label class="control-label">
	                                    	To Date                
	                                    </label>&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="date" class="form-control" name="toDate" id="toDate" placeholder="dd/mm/yy">
                                     	</div>
                                     	<div class="col-md-2" style="margin-top: 25px;">
                                     	<button class="btn" onclick="searchByDate('<?php echo $code;?>');">Go</button>
                                     	</div>
                                     
                                    </div>

                                    <div class="btn-group" id="actionSearch" style="display: none;margin-left: 45px;">
                                        <select class="form-control" 
                                        onchange="searchByStatus(this.value,'<?php echo $code;?>');" >
                                            <option value="">Select ..</option>
                                            <?php
                                            $sql="select LOV_Value,LOV_Text from LOVMast where LOV_Field='status'";
                                            $result=query($query,$sql,$pa,$opt,$ms_db);
                                            while ($row = $fetch($result)){
                                                ?>
                                                <option value="<?php echo $row['LOV_Value']?>"><?php echo $row['LOV_Text']?></option>
                                            <?php } ?>

                                        </select>
                                    </div>

                                    <div class="btn-group " id="bynameSearch" style="display: none;margin-left: 45px;">

                                            <!-- <input type="text" name="byname" class="form-control pull-left" id="byname" onchange="getInputValue(this.value);" placeholder="Enter Emp code or Name"> -->

                                            <div class="col-md-10">
                                            <label class="control-label"></label>
                                             <select class="form-control" name="byname"  id="byname" onchange="getInputValue(this.value);">
                                             <option value="0">Select ..</option>
                                            <?php 
                                                $sqlCrea="select approvedBy from outOnWorkRequest";
                                                $resCrea=query($query,$sqlCrea,$pa,$opt,$ms_db);
                                                while ($rowCrea = $fetch($resCrea)) {
                                                  $arrEmp[]="'" .$rowCrea['approvedBy'] . "'";
                                                }

                                                $strEmp =  implode(",", $arrEmp) ;

                                                $sqlEmp="Select Emp_Code,EMP_NAME from HrdMastQry where Emp_Code in ($strEmp) ";
                                                $resEmp=query($query,$sqlEmp,$pa,$opt,$ms_db);
                                                while ($rowEmp =$fetch($resEmp)) {?>
                                                    <option value="<?php echo $rowEmp['Emp_Code']?>"><?php echo $rowEmp['EMP_NAME']?></option> 
                                              <?php  }
                                                
                                                 ?> 
                                             </select>
                                        </div> 

										<div class="col-md-2" style="margin-top: 17px;">
                                            <button class="btn  bg-blue" id="inputvalue" value="" onclick="serchByCodeName(this.value,'<?php echo $code;?>');">Go</button>
										</div>
                                    </div>

                                </div>
                            </div>

				<table class="table table-striped table-bordered table-hover" id="sample_2">
                    <?php
                
                           $getMyODRequestData=$attendance_class_obj->getMyODRequestData($code);
                        //print_r($getMyODRequestData);
                          $outWorkId= $getMyODRequestData[0];
                            $date_from=$getMyODRequestData[1];
                            $date_to=$getMyODRequestData[2];
                            $CreatedOn=$getMyODRequestData[3];
                            $approvedBy=$getMyODRequestData[4];
                            $natureOfWork=$getMyODRequestData[5];
                            $action_status=$getMyODRequestData[6];
                            $oDKey=$getMyODRequestData[7];
                            $count_flag=$getMyODRequestData[8];
                             //echo $oDKey;

                      
                ?>
				<thead>
				
				<tr>
					<th>
                       Applied Date And Time
                    </th>

                    <th>
                       Approver Name
                    </th>

                    <th>
                       From Date - To Date
                    </th>

                    <th>
                       Nature Of Work
                    </th>

                    <th>
                        Status
                    </th>
				</tr>
				</thead>
				<tbody id="searchMyData">
				<?php
                   for ($i=0;$i<$count_flag;$i++){
                    	//$sqlWork="select LOV_Value,LOV_Text from LOVMast  where LOV_Field='".$natureOfWork[$i]."'";
                       // echo $sqlWork;
                        //$resWork=query($query,$sqlWork,$pa,$opt,$ms_db);
//                        $resData=$fetch($resWork);
                ?>
				<tr >

					<td>
						 <?php echo dateTimeFormat($CreatedOn[$i]);?>
					</td>

					<td>
						<?php
                            $mngrcode=$approvedBy[$i];
                            $sql1="select EMP_NAME from HrdMastQry WHERE Emp_Code='$mngrcode'";
                            $res1=query($query,$sql1,$pa,$opt,$ms_db);
                            $data1=$fetch($res1);
                            echo isset($data1['EMP_NAME'])?$data1['EMP_NAME']:'N/A';
                        ?>
					</td>

					<td>
						 <?php echo dateFormat($date_from[$i])." to ".dateFormat($date_to[$i]);?>
					</td>
					
					<td>
						<?php 
						 $sqlWork="select LOV_Text from LOVMast  where LOV_Field='natureOfWork' and LOV_Value ='".$natureOfWork[$i]."'";
                                    
                                    $resWork=query($query,$sqlWork,$pa,$opt,$ms_db);
                                    $resData=$fetch($resWork);
                                    
                                            echo $resData['LOV_Text'];
                                    
                            
						?>
                        
					</td>
					<td>
						<?php if($action_status[$i] == "1"){?>
							<a class="myod" data-toggle="modal" href="#large" 
							onclick="getmyodId('<?php echo $oDKey[$i];?>','1','<?php echo $code;?>');">
								<span class="label bg-blue-steel">
								Pending </span>
							</a>	
                            <?php } else if($action_status[$i]  == "2") {?>
                            	<a class="myod" data-toggle="modal" href="#large"
                            	onclick="getmyodId('<?php echo $oDKey[$i];?>','2','<?php echo $code;?>');">
                                <span class="label label-success">
                               Approved
								 </span>
							 </a>
                            <?php } else if($action_status[$i]  == "3") {?>
                            	<a class="myod" data-toggle="modal" href="#large"
                            	onclick="getmyodId('<?php echo $oDKey[$i];?>','3','<?php echo $code;?>');">
                                <span class="label label-danger">
                               Rejected
							 </span>
							 </a>
                            <?php } else if($action_status[$i] == "4") {?>
                            	<a class="myod" data-toggle="modal" href="#large"
                            	onclick="getmyodId('<?php echo $oDKey[$i];?>','4','<?php echo $code;?>');">
                                <span class="label bg-grey-cascade">
                               Cancelled
							 </span>
							 </a>
                            <?php } else if($action_status[$i]  == "5") {?>
                                <a class="myod" data-toggle="modal" href="#large"
                                onclick="getmyodId('<?php echo $oDKey[$i];?>','4','<?php echo $code;?>');">
                                <span class="label bg-blue-steel">
                               Cancelled Request Pending
                             </span>
                             </a>
                            <?php } ?>
					</td>

				</tr>
				<?php } ?>
				</tbody>
				
				</table>
			</div>
		
		</div>


		<!-- END CONDENSED TABLE PORTLET-->


	</div>
</div>

</div>
</div>
