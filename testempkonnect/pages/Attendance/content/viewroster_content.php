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
        <li>
          <a data-toggle="tab" href="#MyRosterRequests">My Roster Requests</a>
        </li>
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
                <input type="button" class="btn btn-primary" value="Swap" onclick="viewR.swap()">
                </div>
                <div class="form-group">
                  <div class="col-md-12" id="shiftapprove"></div>
                  <div class="col-md-12" id="showRoster" style="overflow-x:auto"></div>
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
            <h4 class="modal-title">Modal Header</h4>
          </div>
          <div class="modal-body">
            <div class="col-md-12">
              <div class="col-md-3">
                <h4> Change SM</h4>
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
