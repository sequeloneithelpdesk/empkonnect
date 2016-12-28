<div class="page-content-wrapper" xmlns="http://www.w3.org/1999/html">
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-globe"></i>Attendance Reports
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse">


                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                      <form  enctype="multipart/form-data" id="form" name="reportform" class="form-horizontal form-row-seperated">
                        <div class="form-body">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                       
                                            <select class="form-control" onchange="showfunction(this.value)" style="margin-top: 25px;" id="mainselect">
                                                
                                                <!--<option value="1">Detail Summary</option>-->
                                                <option value="2">IN & OUT</option>
                                                <option value="3">Monthly Attendance</option>
                                                <option value="4">MIS Punch</option>
                                                <option value="5">Late Arrival</option>
                                                <option value="6">Early Departure</option>
                                            </select>
                                       
                                    </div>
                                    <div class="col-md-3" id="month_div">
                                       
                                            <select class="form-control" style="margin-top: 25px;" id="selectmonth" onchange="showMonth(this.value)">
                                                <option value="">Select Month</option>
                                                 <?php $sql_m="select * from LOVMast where LOV_Field='Month' order by (0+LOV_Value)";
                                                $result_m = query($query,$sql_m,$pa,$opt,$ms_db);
                                               
                                                while($row_m = $fetch($result_m)){ ?> 
                                                    <option value="<?php echo $row_m['LOV_Value'] ?>">
                                                    <?php echo $row_m['LOV_Text']; ?>
                                                    
                                                          </option>
                                                  <?php    }  
                                                ?>
                                                 </select>
                                       
                                    </div>
                                     <div class="col-md-3" id="fromDate_div">
                                            <label>
                                                From Date              
                                            </label>
                                            <input type="text" class="form-control" name="fromDate" id="fromDate" value="<?php echo date('Y-m-d');?>" readonly>
                                    </div>
                                    <div class="col-md-3" id="toDate_div">  
                                            <label>
                                                To Date                
                                            </label>
                                            <input type="text" class="form-control" name="toDate" id="toDate" value="<?php echo date('Y-m-d');?>" readonly>
                                    </div>
                                   

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="col-md-3" id="emps">
                                       
                                            <select id="my-default-text-select" name="character" style="width: 300px" onchange="hideDiv()" multiple >
                                                
                                               <?php 
                                              // echo $code;
                                                if($code == 'admin'){
                                                     $sql3="select Emp_Code,emp_name from HrdMastQry";
                                                }
                                                else{
                                                    $sql4="select Emp_Code,emp_name from HrdMastQry where MNGR_CODE='$code'";
                                                    $result4 = query($query,$sql4,$pa,$opt,$ms_db);
                                                    $countRow=$num($result4);
                                                    if ($countRow >= 1) {
                                                       $sql3="select Emp_Code,emp_name from HrdMastQry where MNGR_CODE='$code'";
                                                    }  
                                                    else{
                                                        $sql3="select emp_name from HrdMastQry where Emp_Code='$code'";
                                                    }
                                                }
                                                $result3 = query($query,$sql3,$pa,$opt,$ms_db);
                                                $row3 = $fetch($result3);
                                                    // //print_r($row3);
                                                while($row3 = $fetch($result3)){ ?> 
                                                    <option value="<?php echo $row3['Emp_Code'] ?>">
                                                    <?php echo $row3['emp_name'].'-'.$row3['Emp_Code']; ?>
                                                    
                                                          </option>
                                                  <?php    }  
                                                ?>
                                        </select>
                                       
                                    </div>
                                     
                                    <div class="col-md-1" style="margin-top: 25px;margin-left: 695px">
                                            <button type="button" id="showorg" value="1" class="btn  bg-blue" onclick="selectAttendanceReport(this.value,'<?php echo $code;?>');">Advance</button>
                                    </div>

                                </div>
                            </div>
                            
                            <div id="advancefilter">
                                <div class="form-group" id="multisearch" style="display: none">    
                                    <div class="col-md-12" >
                                        <div class="col-md-4" style="margin-top: 25px;">
                                            <select id="company-select" name="character" style="width: 300px" onchange="hideDiv()" multiple >
                                            </select>
                                        </div>
                                        <div class="col-md-4" style="margin-top: 25px;">
                                            <select id="business-select" name="character" style="width: 300px" onchange="hideDiv()" multiple >

                                                  
                                            </select>
                                        </div>
                                        <div class="col-md-4" style="margin-top: 25px;">
                                            <select id="sub-business-select" name="character" style="width: 300px" onchange="hideDiv()" multiple >

                                                  
                                            </select>
                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="form-group" id="multisearch1" style="display: none">    
                                    <div class="col-md-12" >
                                        <div class="col-md-4" style="margin-top: 25px;">
                                            <select id="location-select" name="character" style="width: 300px" onchange="hideDiv()" multiple >
                                            </select>
                                        </div>
                                        <div class="col-md-4" style="margin-top: 25px;">
                                            <select id="work-location-select" name="character" style="width: 300px" onchange="hideDiv()" multiple >

                                                  
                                            </select>
                                        </div>
                                        <div class="col-md-4" style="margin-top: 25px;">
                                            <select id="function-select" name="character" style="width: 300px" onchange="hideDiv()" multiple >

                                                  
                                            </select>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="form-group" id="multisearch2" style="display: none">    
                                    <div class="col-md-12" >
                                        <div class="col-md-4" style="margin-top: 25px;">
                                            <select id="sub-function-select" name="character" style="width: 300px" onchange="hideDiv()" multiple >
                                            </select>
                                        </div>
                                        <div class="col-md-4" style="margin-top: 25px;">
                                            <select id="cost-master-select" name="character" style="width: 300px" onchange="hideDiv()" multiple >

                                                  
                                            </select>
                                        </div>
                                        <div class="col-md-4" style="margin-top: 25px;">
                                            <select id="process-select" name="character" style="width: 300px" onchange="hideDiv()" multiple >

                                                  
                                            </select>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="form-group" id="multisearch3" style="display: none">    
                                    <div class="col-md-12" >
                                        <div class="col-md-4" style="margin-top: 25px;">
                                            <select id="grade-select" name="character" style="width: 300px" onchange="hideDiv()" multiple >
                                            </select>
                                        </div>
                                        <div class="col-md-4" style="margin-top: 25px;">
                                            <select id="designation-select" name="character" style="width: 300px" onchange="hideDiv()" multiple >

                                                  
                                            </select>
                                        </div>
                                        <div class="col-md-4" style="margin-top: 25px;">
                                            <button type="button" class="btn  bg-blue" onclick="attReport();">Go</button>
                                        </div>
                                        
                                        
                                    </div>
                                </div>
                                 <div class="form-group">    
                                    <div class="col-md-12" style="margin-top: 25px;" >
                                        
                                        <button type="button" style="float: right" class="btn  bg-blue" onclick="attReport();">Generate Report</button>
                                       
                                        
                                    </div>
                                </div>
                                <button type="button" id="downloadbtn" class="btn  bg-blue" style="display: none; float: right" onclick="downloadReport();">Download Report</button>
                                <div class="form-group" id="reportresult">
                                 
                                </div>
                               
                            </div>
                        </div>
                        </form>
                    </div>
                    
                </div>
               
            </div>
        </div>
    </div>
</div>