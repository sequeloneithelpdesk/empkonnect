<head>

    <link href="../../assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>

    <link href="../../assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>

    <!-- END PAGE LEVEL PLUGIN STYLES -->
    <!-- BEGIN PAGE STYLES -->
    <link href="../../assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css"/>
    <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css">
    <script src="../js/toastr.js"></script>
    <!-- END PAGE STYLES -->
    <!-- BEGIN THEME STYLES -->
    <!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->

</head>
<?php
include ('../db_conn.php');
include ('../configdata.php');
$cat = $_POST['value_action'];
$mail_id = $_POST['Email_id'];
$name= $_POST['name'];
$code= $_POST['code'];
$sqlq="select * from HrdMastQry WHERE Mailcategory = '$mail_id'";
$resultq=query($query,$sqlq,$pa,$opt,$ms_db);
$sqlq="select * from mail_configuration WHERE Mailcategory = '$cat'";
$resultq=query($query,$sqlq,$pa,$opt,$ms_db);
if($num($resultq)) {

    while ($rowq = $fetch($resultq)) {
        $header = $rowq['subject'];
        $subject = $rowq['subject'];
        $content = $rowq['content'];
    }
}
else{
    $header = "Message";
    $subject = "";
    $content = "";
}
        ?>

        <div class="modal-header portlet box blue">
            <button type="button" class="close" data-dismiss="modal"  aria-hidden="true"></button>
            <h4 class="modal-title" style="color: white"><div class="caption" ><b><?php echo $header; ?> </b></div></h4>
        </div>

              <div class="modal-body">
                  <form method="post" enctype="multipart/form-data">

                  <div class="row">

                        <div class="form-group">
                            <label class="control-label col-md-3">Send To</label>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <label class="control-label col-md-3"><?php echo $mail_id;?></label>
                                    <input type="hidden" name="empname" id="empname" value="<?php echo $name;?>">
                                    <input type="hidden" name="empcode" id="empcode" value="<?php echo $code;?>">
                                    <input type="hidden" value="<?php echo $mail_id;?>" id="send" name="send" />
                                </div>
                            </div>
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="form-group">
                            <label class="control-label col-md-3">Subject</label>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <label class="control-label col-md-3"><?php echo $subject;?></label>

                                    <input type="hidden" value="<?php echo $subject;?>" id="sub" name="sub" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="form-group ">
                            <label class="control-label col-md-3">Message</label>
                            <div class="col-md-9">
                                <textarea data-provide="markdown" name="editor3" id="departeditor"rows="6">
                                    <?php echo $content;?>
                                </textarea>
                            </div>
                        </div>
                    </div>

                  </form>
                </div>
                <hr>
                <div class="modal-footer" style="border:none;margin-top:-4%">
                    <input type="submit" class="btn default" data-dismiss="modal" value="Cancel">
                    <input type="button" class="btn blue" value="Send" name="SendMail" onclick="getWish();">

                </div>

<script src="../../assets/global/plugins/bootstrap-markdown/lib/markdown.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>
<script src="../../assets/admin/pages/scripts/components-editors.js"></script>
<script src="../js/toastr.js"></script>
<script>jQuery(document).ready(function() {
        ComponentsEditors.init();
    });

    function getWish(){
        var send = $("#send").val();
        var message = $("#departeditor").val();
        var subject = $("#sub").val();
        var code = $("#empcode").val();
        var name = $("#empname").val();
        var ALL_data = "send=" + send + "&message=" + message+ "&name=" + name+ "&code=" + code+ "&subject=" + subject +"&flag_value=7";
        
        $.ajax({
            type: "POST",
            url: "ajax/home_ajax.php",
            data: ALL_data,
            success: function (data) {
               var result = $.parseJSON(data);
                if(result.status==true){
                    $('#large1').modal('hide');
                    toastmsg(result.result);
                  //  location.reload();
                    //alert(result.result);
                }else{
                    $('#large1').modal('hide');
                    toasterrormsg(result.result);
                    //alert();
                }

            }
        });

    }
</script>


