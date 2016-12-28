
<?php
include ('../../db_conn.php');
include ('../../configdata.php');

$action = $_POST['action'];
$id = $_POST['id'];


$sqlq="select * from DeptNotification where id='$id'";
$resultq=query($query,$sqlq,$pa,$opt,$ms_db);
if($num($resultq)) {

    while ($rowq = $fetch($resultq)) {
    ?>
    <form enctype="multipart/form-data" id="form5" name="editdeptnotify"
          class="form-horizontal form-row-seperated">
        <div class="modal-header portlet box blue">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title" style="color: white"><b>Edit Function Notification</b> </h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <label class="control-label col-md-3">Departments</label>
                <div class="col-md-6">
                    <select id="departments" class="select2-container form-control input-xlarge select2me col-md-12">
                        <option value="<?php echo $rowq['notifyTo'];echo ",";echo $rowq['deptId']?>"><?php echo $rowq['notifyTo'];?></option>
                        <?php
                        $i = 1;
                        $sqlq1="select * from FUNCTMast";
                        $resultq1=query($query,$sqlq1,$pa,$opt,$ms_db);
                        if($num($resultq1)) {

                            while ($rowq1 = $fetch($resultq1)) {
                                ?>
                                <option value="<?php echo $rowq1['FUNCT_NAME'];echo ",";echo $rowq1['FunctID']?>"><?php echo $rowq1['FUNCT_NAME'];?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <hr>
            <div class="row">
                <label class="control-label col-md-3">Notification From</label>
                <div class="col-md-6">
                    <div class="col-md-10 newNot">

                        <i class="fa fa-calendar"></i><input class="form-control input-medium" size="16" type="text"
                               value="<?php $thedate = $rowq['notifyDate'];
                               echo $thedate->format("d/m/Y"); ?>" id="fdate"/>
                        <input type="hidden" id="hide_id" value="<?php echo $id; ?>"/>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <label class="control-label col-md-3">Notification To</label>
                <div class="col-md-6">
                    <div class="col-md-10 newNot">
                             <i class="fa fa-calendar"></i><input class="form-control input-medium" size="16" type="text"
                               value="<?php $thedate = $rowq['EndnotifyDate'];
                               echo $thedate->format("d/m/Y"); ?>" id="tdate"/>
                        <input type="hidden" id="hide_id" value="<?php echo $id; ?>"/>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <label class="control-label col-md-3">Topic of Notification</label>
                <div class="col-md-8">
                    <input class="form-control form-control-inline input-medium" size="18" type="text" name="topic" id="topic" value="<?php echo $rowq['Topic']; ?>">
                </div>
            </div>
            <hr>
            <div class="row">
                <label class="control-label col-md-3">Editor</label>
                <div class="col-md-8">
                    <textarea name="content" data-provide="markdown" name="editor2" id="departeditor"rows="6"><?php echo $rowq['notification'];?></textarea>

                </div>
            </div>

        </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn green" id="Dnotification1" value="edit" onclick="update_noti()"><i class="fa fa-check"></i>Submit
            </button>
        </div>

    </form>
    <?php
}}
?>
<script type="text/javascript" src="../../assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<script src="../../assets/global/plugins/bootstrap-markdown/lib/markdown.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>
<script src="../../assets/admin/pages/scripts/components-editors.js"></script>
<script>$(function() {
        $( "#fdate" ).datepicker({
            changeMonth: true,
            dateFormat: "dd/mm/yy",
            minDate: 0
        });
    });
    $(function() {
        $( "#tdate" ).datepicker({
            changeMonth: true,
            dateFormat: "dd/mm/yy",
            minDate: 0
        });
    });
    ComponentsEditors.init();
</script>
