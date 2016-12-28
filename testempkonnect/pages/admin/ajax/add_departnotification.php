<?php

//include "../../db_conn.php";
include ('../../db_conn.php');
include ('../../configdata.php');
?>
<head>
    <script src="js/adminfunc.js"></script>

    <link href="../../assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>

    <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-select/bootstrap-select.min.css"/>
    <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/select2/select2.css"/>
    <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/jquery-multi-select/css/multi-select.css"/>
    <!-- END PAGE LEVEL PLUGIN STYLES -->
    <!-- BEGIN PAGE STYLES -->
    <link href="../../assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="../css/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css"/>
    <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css">
    <!-- END PAGE STYLES -->
    <!-- BEGIN THEME STYLES -->
    <!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->

</head>

<form enctype="multipart/form-data" id="form5" name="addDeptnotify"
      class="form-horizontal form-row-seperated">
    <div class="modal-header portlet box blue">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title" style="color: white"><b>New Function Notification</b> </h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <label class="control-label col-md-3">Applicable Function</label>
            <div class="col-md-3">

                <select name="departments" id="departments" class="select2container form-control input-medium select2me" data-placeholder="Select Function">
                    <option value=""></option>
                    <?php
                    $i = 1;

                    $sqlq="select * from FUNCTMast";
                    $resultq=query($query,$sqlq,$pa,$opt,$ms_db);
                    if($num($resultq)) {

                        while ($rowq = $fetch($resultq)) {        ?>
                            <option value="<?php echo $rowq['FUNCT_NAME'];echo ",";echo $rowq['FunctID']?>"><?php echo $rowq['FUNCT_NAME'];?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>

        </div>
        <hr>
        <div class="row">
            <label class="control-label col-md-3">Notifications From</label>
            <div class="col-md-6">
                <div class="col-md-10 newNot">
<!--                    <ul>-->
<!--                        <li></li>-->
<!--                        <li></li>-->
<!--                    </ul>-->

                    <i class="fa fa-calendar"></i><input class="form-control input-medium" size="16" type="text" id="fdate"/>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <label class="control-label col-md-3">Notifications To</label>
            <div class="col-md-6">
                <div class="col-md-10 newNot">
    				<i class="fa fa-calendar"></i><input class="form-control input-medium" size="16" type="text" id="tdate"/>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <label class="control-label col-md-3">Notification Subject</label>
            <div class="col-md-8">
                <input class="form-control form-control-inline input-medium" size="18" type="text" name="topic" id="topic" >
            </div>
        </div>
        <hr>
        <div class="row">
            <label class="control-label col-md-3">Notification Message</label>
            <div class="col-md-8">
                <textarea name="content" data-provide="markdown" name="editor2" id="departeditor"rows="6"></textarea>
            </div>
        </div>

        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn green" id="Dnotification" value="add" onclick="update_noti()"><i class="fa fa-check"></i>Save
        </button>
    </div>

</form>
<script src="../js/jquery-ui.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js"></script>

<script type="text/javascript" src="../../assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<script src="../../assets/global/plugins/bootstrap-markdown/lib/markdown.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>
<script src="../../assets/admin/pages/scripts/components-editors.js"></script>
<script src="../../assets/admin/pages/scripts/components-dropdowns.js"></script>
<script src="../../assets/admin/pages/scripts/form-wizard.js"></script>
<script src="../../assets/admin/pages/scripts/components-pickers.js"></script>
<script>
    $(function() {
        $( "#fdate" ).datepicker({
            changeMonth: true,
            dateFormat: "dd/mm/yy",
            minDate: 0
        });
        $( "#tdate" ).datepicker({
            changeMonth: true,
            dateFormat: "dd/mm/yy",
            minDate: 0
        });
    });
    $(function() {

    });
    ComponentsEditors.init();
    ComponentsDropdowns.init();
    FormWizard.init();
</script>
