<div class="page-content-wrapper" xmlns="http://www.w3.org/1999/html">
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-globe"></i>Reports
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse">

                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                      <form  enctype="multipart/form-data" id="form" name="mailconfigform" class="form-horizontal form-row-seperated">
                        <div class="form-body">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="btn-group ">
                                            <select class="form-control" onchange="selectReport(this.value,'<?php echo $code;?>');">
                                                <option value="">Leave Reports</option>
                                                <option value="1">Leave Transcation</option>
                                                <option value="2">Attendance Report</option>
                                                <option value="3"></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" style="display: none" id="type">
                                <div class="col-md-12" >
                                    <div class="col-md-6" >
                                        <div class="btn-group ">
                                            <select class="form-control" id="Ltype">
                                                <option value="">Select Leave Type</option>
                                                <?php 
                                                $sql="select * from LOVMast where LOV_Field='leave' and LOV_OrdNo !='0' and LOV_OrdNo !='3'";
                                                $result = query($query,$sql,$pa,$opt,$ms_db);
                                                while($row = $fetch($result)){  
                                                ?>
                                                <option  value="<?php echo $row['LOV_Value'] ?>"><?php echo $row['LOV_Text'] ?>
                                                </option>
                                                <?php } ?>
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="status" style="display: none">
                                        <div class="btn-group ">
                                            <select class="form-control" id="Lstatus">
                                                <option value="">Select Leave Status</option>
                                              
                                                <?php 
                                                $sql="select * from LOVMast where LOV_Field='status'";
                                                $result = query($query,$sql,$pa,$opt,$ms_db);
                                                while($row = $fetch($result)){  
                                                ?>
                                                <option  value="<?php echo $row['LOV_Value'] ?>"><?php echo $row['LOV_Text'] ?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" id="datesearch" style="display: none">    
                                <div class="col-md-12" >
                                    <div class="col-md-6">
                                            <label>
                                                From Date                
                                            </label>
                                            <input type="date" class="form-control" name="fromDate" id="fromDate" placeholder="dd/mm/yy">
                                    </div>
                                    <div class="col-md-6">  
                                            <label>
                                                To Date                
                                            </label>
                                            <input type="date" class="form-control" name="toDate" id="toDate" placeholder="dd/mm/yy">
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="form-group" id="empsearch" style="display: none">    
                                <div class="col-md-12" >
                                    <div class="col-md-4" style="margin-top: 25px;">
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
                                    <div class="col-md-4" style="margin-top: 25px;">
                                        <select id="company-select" name="character" style="width: 300px" onchange="hideDiv()" multiple >

                                              
                                        </select>
                                    </div>
                                    <div class="col-md-4" style="margin-top: 25px;">
                                        <select id="bussiness-select" name="character" style="width: 300px" onchange="hideDiv()" multiple >

                                              
                                        </select>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="form-group" id="empsearch" style="display: none">    
                                <div class="col-md-12" >
                                    <div class="col-md-4" style="margin-top: 25px;">
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
                                    <div class="col-md-4" style="margin-top: 25px;">
                                        <select id="company-select" name="character" style="width: 300px" onchange="hideDiv()" multiple >
                                            
                                              
                                        </select>
                                    </div>
                                    <div class="col-md-1" style="margin-top: 25px;">
                                            <button type="button" class="btn  bg-blue" onclick="Report('<?php echo $code;?>');">Go</button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" id="reportresult" style="display: none">
                            </div>
                        </div>
                        </form>
                    </div>
                    
                </div>
               
            </div>
        </div>
    </div>
</div>