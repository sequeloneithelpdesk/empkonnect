<?php
$subject=$_POST['subject'];
$notification=$_POST['notification'];
$id=$_POST['id'];
$category=$_POST['category'];
$content = urldecode($_POST['content']);

?>

<div class="modal-dialog" style="width:80%;height:80%">
    <div class="modal-content">
        <div class="modal-header modal-color white-color" >
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="white-color">X</span></button>
            <h4 class="modal-title" id="myModalLabel">Edit Mail Configuration</h4>
        </div>
        <div class="modal-body">

            <form  enctype="multipart/form-data" id="form3" name="mailconfigform" class="form-horizontal form-row-seperated">
                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">Category</label>
                        <div class="col-md-9">
                            <select id="mailCategory2" class="bs-select form-control input-xlarge col-md-12" onchange="abc(this.value)">
                                <option>select category..</option>
                                <option  value="birthday" <?php if ($category =="birthday") echo "selected";?>>Birthday</option>
                                <option value="leave"  <?php if ($category =="leave") echo "selected";?>>Leave</option>
                                <option value="anniversary" <?php if ($category =="anniversary") echo "selected";?>>Anniversary</option>
                            </select>
                            <input type="hidden" id="selectcategory" value="" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Subject</label>
                        <div class="col-md-9">
                            <input type="text" placeholder="enter your mail subject" id="subject" value="<?php echo $subject; ?>" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Notification Name</label>
                        <div class="col-md-9">
                            <input type="text" placeholder="enter your notification name" id="notification" value="<?php echo $notification; ?>" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-body">
                            <div class="form-group last">
                                <label class="control-label col-md-3">CKEditor</label>
                                <div class="col-md-9">
                                    <textarea class="ckeditor form-control" name="editor1" id="maileditor" rows="6">
                                        <?php echo $content; ?>
                                    </textarea>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <input type="hidden" name="type" id="type" value="Edit">
                            <input type="hidden" id="mailid" value="<?php echo $id;?>">
                            <button type="button" class="btn green" id="editmail" onclick="editMail();"><i class="fa fa-check"></i> Submit</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>



<script type="text/javascript" src="../../assets/global/plugins/ckeditor/ckeditor.js"></script>















