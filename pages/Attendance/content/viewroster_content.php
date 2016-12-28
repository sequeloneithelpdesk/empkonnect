<?php
$currentMonth = date('F');
$prevMonth = date("F", strtotime ( '-1 month' , strtotime ( date('F') ) )) ;
$nextMonth = date("F", strtotime ( '+1 month' , strtotime ( date('F') ) )) ;
?>
<style type="text/css">
.legendlist { list-style: none;margin-top: 16px; padding-left: 0; }
.legendlist li { float: left; margin-right: 10px;}
.legendlist li:first-child {margin: 0;}
.legendlist span { border: 1px solid #ccc; float: left; width: 12px; height: 12px; margin: 2px;}

.legendlist .approved-legent { background-color: #ffa03f; }
.legendlist .daily-legent { background-color: #477FFF; }
.legendlist .holiday-legent { background-color: #E5EFE5; }
</style>
<div class="tab-pane" id="tab_4">
  <div class="portlet box blue">
    <div class="portlet-title">
      <div class="caption">
        <i class="fa fa-gift"></i>View Roster
            
      </div>
      <div class="tools"></div>
    </div>
    <div class="portlet-body form">
      <div class="clearfix"></div>
      <ul class="nav nav-tabs">
        <li class="active">
          <a data-toggle="tab" href="#ApplyRoster">Apply Roster</a>
        </li>
        <!-- <li>
          <a data-toggle="tab" href="#MyRosterRequests">My Roster Requests</a>
        </li> -->
      </ul>
      <div class="tab-content">
        <div id="ApplyRoster" class="tab-pane fade in active">
          <!-- BEGIN FORM-->
          <form  enctype="multipart/form-data" id="form" name="mailconfigform" class="form-horizontal form-row-seperated">
            <div class="form-body">
              <div class="form-group">
                <div id="err" class="alert alert-danger display-hide"></div>
                <div id="succ" class="alert alert-success display-hide">
                  <button class="close" data-close="alert"></button>
        Roster Created successfully! 
    
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12">
                  <div class="col-md-6 rolename_availability_result" id="rolename_availability_result"></div>
                </div>
              </div>
              <div class="form-group">
              <!-- <input type="button" class="btn btn-primary" value="Swap" onclick="viewR.swap()"> -->
              <div class="pull-right">
                <ul class="legendlist">
                  <li><span class="daily-legent"></span> Assigned shift</li>
                  <li><span class="approved-legent"></span> Changed shift</li>
                  <li><span class="holiday-legent"></span> Holiday/Weekly Off</li>
                              
                            </ul>
              </div>
              </div>
                <div class="form-group">
        				<div class="pull-right">
                  <?php if($_SESSION['usercode'] == 'admin'){ ?>
                  <input type="checkbox" name="assignedRoster"  class="rosterTypeCheckBox" checked="checked" /> Assigned Roster
                  <input type="checkbox" name="unAssignedRoster"  class="rosterTypeCheckBox" /> Unassigned Roster
                  <input type="checkbox" name="allRoster" class="rosterTypeCheckBox" /> All Roster
                  <?php } ?>
                  <a href="javascript:void(0)" onclick="viewR.getPreviousMonthRoster()" class="btn btn-primary prevMonth"><< <?php echo $prevMonth; ?></a>
        					<a href="javascript:void(0)" class="btn btn-default currentMonth" style="cursor: not-allowed;"><?php echo $currentMonth; ?></a>
        					<a href="javascript:void(0)" onclick="viewR.getNextMonthRoster()" class="btn btn-primary nextMonth"><?php echo $nextMonth; ?> >></a>
        				</div>
        					<div class="clearfix"></div>
				
                  <div class="col-md-12" id="shiftapprove"></div> 
                  
                  <div class="clearfix"></div>
                  <div style="overflow:auto; max-height: 800px; margin-top: 15px;" id="showRosterScroll"><table id="showRoster" class="table-bordered table"></table></div>
                  <?php if($_SESSION['usercode'] == 'admin'){ ?><p class="text-right col-md-12">Please down the verticle scroll to load more records</p><?php } ?>
                  <div class="alert alert-danger" style="text-align: center; margin: 2% auto 0px; display: none; " id="loading">Loading Please wait...</div>
                </div>
                </div>
              </form>
              <!-- END FORM-->
            </div>
            <div id="MyRosterRequests" class="tab-pane fade">
              <div class="form-body clearfix">
                <div class="form-group">
                  <div id="ApplyRoster" class="tab-pane fade in active">
                    <div class="col-md-12" id="showRosterRequests"></div>
                  </div>
                </div>
              </div>             
            </div>
          </div>
          </div>
        </div>
      </div>
    </div>
    <div id="SMModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Change Shift</h4>
          </div>
          <div class="modal-body">
            <div class="col-md-12">
              <div class="col-md-3">
                <h4> Shifts</h4>
              </div>
              <div  class="col-md-5">
                <select id="changeSM" class="form-control">
                  <option value="" selected>-- Select Value --</option>
                  <?php
        $result=query($query,"select ShiftMastId,Shift_Name,cast(shift_From as varchar(5)), cast(Shift_To as varchar(5)) from ShiftMast",$pa,$opt,$ms_db);
        $shiftM = array();
        $list='';
        while ( $row=$fetch( $result ) ){
          $shiftM[$row[0]] = array(
          "name"=>$row[1],
          "start"=>$row[2],
          "end"=>$row[3]
        );
        $list.="
                  <option value='".$row[0]."'>".$row[1]."(".$row[2]."-".$row[3].")</option>";
        }
        echo $list;
      ?>
                </select>
              </div>
            </div>
            <div class="col-md-12" class="shiftinfo"></div>
          </div>
          <div class="modal-footer">
            <div id="changeSMbutton"></div>
          </div>
        </div>
      </div>
    </div>
<script>
var shiftAA = JSON.parse('<?php echo json_encode($shiftM)?>');
var userType = "<?php echo $_SESSION['usercode']; ?>";
</script>
    <div id="showSwap" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Swap Shift</h4>
          </div>
          <div class="modal-body">
            <div class="col-md-12" id="SwapID"></div>
          </div>
          <div class="modal-footer">
            <div id="swapbutton"></div>
          </div>
        </div>
      </div>
    </div>
