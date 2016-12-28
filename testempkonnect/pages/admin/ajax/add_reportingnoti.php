<?php

//include "../../db_conn.php";
include ('../../db_conn.php');
include ('../../configdata.php');
session_start();
$code = '11371';//$_SESSION['usercode'];
$sqlq="select MNGR_CODE from HrdMastQry where Emp_Code='$code'";
$resultq=query($query,$sqlq,$pa,$opt,$ms_db);
$data=$fetch($resultq);
$mng= $data['MNGR_CODE'];
?>
<head>
    <style>
        .multiselect {
            width: 200px;
        }
        .selectBox {
            position: relative;
        }
        .selectBox select {
            width: 100%;
            font-weight: bold;
        }
        .overSelect {
            position: absolute;
            left: 0; right: 0; top: 0; bottom: 0;
        }
        #checkboxes {
            display: none;
            border: 1px #dadada solid;
        }
        #checkboxes label {
            display: block;
        }
        #checkboxes label:hover {
            background-color: #1e90ff;
        }
    </style>
    <script>
        var expanded = false;
        function showCheckboxes() {
            var checkboxes = document.getElementById("checkboxes");
            if (!expanded) {
                checkboxes.style.display = "block";
                expanded = true;
            } else {
                checkboxes.style.display = "none";
                expanded = false;
            }

        }
        function allChecked(){

            if($('input[id="all"]').attr("checked")){
                //alert('checked');
                $('.empcheck').attr( "checked", true );
            }
            else {
               // alert('checked');
                $('.empcheck').attr( "checked", false );
            }
        }

    </script>
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

<form enctype="multipart/form-data" id="form5" name="addreportingnoti"
      class="form-horizontal form-row-seperated">
    <div class="modal-header portlet box blue">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title" style="color: white"><b>New Reporting Notification</b> </h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <label class="control-label col-md-3">Select Team Members</label>
                <div class="multiselect col-md-6">
                    <div class="selectBox" onclick="showCheckboxes()">
                        <select  style="width: 20em">
                            <option>Select an option</option>
                        </select>
                        <div class="overSelect"></div>
                    </div>
                    <div id="checkboxes" style="overflow-y: scroll;width: 20em;height:20em">
                        <label for="All"><input type="checkbox" id="all" onchange="allChecked();" value="All"/>All</label>


                        <?php
                        $i = 1;
                        $sqlq1="select * from HrdMastQry where MNGR_CODE='$mng'";
                        $resultq1=query($query,$sqlq1,$pa,$opt,$ms_db);
                        if($num($resultq1)) {

                            while ($rowq1 = $fetch($resultq1)) {
                                ?>
                                <label for="<?php echo $rowq1['Emp_Code'];?>"><input type="checkbox" id="<?php echo $rowq1['Emp_Code'];?>" class="empcheck" name="team[]" value="<?php echo $rowq1['Emp_Code'];?>"/><?php echo $rowq1['EMP_NAME'];?></label>

                                <?php
                            }
                        }
                        ?>


                    </div>
                </div>

            </div>
        </div>
        <hr>
        <div class="row">
            <label class="control-label col-md-3">Notifications From</label>
            <div class="col-md-6">
                <div class="col-md-10 newNot">

                    <i class="fa fa-calendar"></i><input class="form-control input-medium" size="16" type="text" id="fdate"/>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <label class="control-label col-md-3">Notifications To</label>
            <div class="col-md-6">
                <div class="col-md-10 newNot">

                    <i class="fa fa-calendar"></i><input class="form-control form-control-inline input-medium" size="16" type="text" id="tdate"/>
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
                <textarea name="content" data-provide="markdown" name="editor2" id="reporteditor"rows="6" ></textarea>
            </div>
        </div>

    </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn green" id="Rnotification" value="add" onclick="update_report()"><i class="fa fa-check"></i>Submit
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
