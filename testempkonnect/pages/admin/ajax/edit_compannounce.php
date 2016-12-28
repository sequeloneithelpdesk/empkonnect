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
<?php
include ('../../db_conn.php');
include ('../../configdata.php');

$action = $_POST['action'];
$id = $_POST['id'];


$sqlq="select * from compAnnounce where id='$id'";

$resultq=query($query,$sqlq,$pa,$opt,$ms_db);
if($num($resultq)) {

while ($rowq = $fetch($resultq)) {
   ?>
    <form enctype="multipart/form-data" id="form5" name="editcompanyAnnounce"
          class="form-horizontal form-row-seperated">
        <div class="modal-header portlet box blue">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title" style="color: white"><b>Edit Company Announcement</b> </h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <label class="control-label col-md-3">Announcement From</label>
                <div class="col-md-6">
                    <div class="col-md-10 newNot">
                        <i class="fa fa-calendar"></i><input class="form-control input-medium" size="16" type="text"
                               value="<?php $thedate = $rowq['AnnounceDate'];
                               echo $thedate->format("d/m/Y"); ?>" id="fdate"/>
                        <input type="hidden" id="hide_id" value="<?php echo $id; ?>"/>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <label class="control-label col-md-3">Announcement To</label>
                <div class="col-md-6">
                    <div class="col-md-10 newNot">
                        <i class="fa fa-calendar"></i><input class="form-control input-medium" size="16" type="text"
                               value="<?php $thedate = $rowq['EndAnnounceDate'];
                               echo $thedate->format("d/m/Y"); ?>" id="tdate"/>
                        <input type="hidden" id="hide_id" value="<?php echo $id; ?>"/>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <label class="control-label col-md-3">Announcement Subject</label>
                <div class="col-md-8">
                    <input class="form-control form-control-inline input-medium" size="18" type="text" name="topic" id="topic" value="<?php echo $rowq['Topic']; ?>">
                </div>
            </div>
            <hr>
            <div class="row">
                <label class="control-label col-md-3">Announcement Message</label>
                <div class="col-md-8">
                    <textarea name="content" data-provide="markdown" name="editor2" id="anneditor"rows="6"><?php echo $rowq['AnnouncementMessage'];?></textarea>


                </div>
            </div>

        </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn green" id="announcement" value="edit" onclick="update_annu()"><i class="fa fa-check"></i>Submit
            </button>
        </div>

    </form>
    <?php
}}
?>
