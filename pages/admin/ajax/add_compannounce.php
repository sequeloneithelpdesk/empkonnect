
<head>
    <script src="js/adminfunc.js"></script>
    <link href="../../assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>

    <!-- END PAGE LEVEL PLUGIN STYLES -->
    <!-- BEGIN PAGE STYLES -->
    <link href="../../assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css"/>
    <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css">
    <!-- END PAGE STYLES -->
    <!-- BEGIN THEME STYLES -->
    <!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->

</head>
<form enctype="multipart/form-data" id="form5" name="addcompanyAnnounce"
      class="form-horizontal form-row-seperated">
    <div class="modal-header portlet box blue">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title" style="color: white"><b>New Company Announcement</b> </h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <label class="control-label col-md-3">Announcement From</label>
            <div class="col-md-6">
                <div class="col-md-10 newNot">
                     <i class="fa fa-calendar"></i><input class="form-control input-medium" size="16" type="text" id="fdate"/>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <label class="control-label col-md-3">Announcement To</label>
            <div class="col-md-6">
                <div class="col-md-10 newNot">
                    <i class="fa fa-calendar"></i><input class="form-control input-medium" size="16" type="text" id="tdate"/>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <label class="control-label col-md-3">Announcement Subject</label>
            <div class="col-md-8">
                <input class="form-control form-control-inline input-medium" size="18" type="text" name="topic" id="topic" >
            </div>
        </div>
        <hr>
        <div class="row">

            <label class="control-label col-md-3">Announcement Message</label>
            <div class="col-md-8">
                <textarea name="content" data-provide="markdown" name="editor2" id="anneditor"rows="6"></textarea>

            </div>
</div>

        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn green" id="announcement" value="add" onclick="update_annu()"><i class="fa fa-check"></i>Submit
        </button>
    </div>

</form>
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