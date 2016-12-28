<html>
<div class="col-md-4">
    <label class="control-label">Choose File
    </label></br>


        <input type="file" name="uploadfile[]" id="uploadfile" onChange="logoimage_Validation();"/> <input type="button" value="+" onclick="addMoreFile()" ><span id="dialoginvalid"  style="color: #FF0000"></span>
<br><br>
    <div id="uploadgroup">
    </div>
    <div>
        <input type="button" value="submit" onclick="getUploadVal()">
    </div>
</div>
</html>
<script src="../../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="../../assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script>
    counter = 2;


    function addMoreFile(){

           // $("#uploadfile").add();
        var name = $("#uploadfile").val();
        var d = document.getElementById('uploadgroup');
        d.innerHTML += "<div id='uploadgroup"+ counter +"'><input type='file' id='uploadfile"+ counter++ +"' name='uploadfile[]'><input type='button' value='-' onclick='removeupload()'><br ><br></div>";

    }
    function removeupload() {
        //alert(counter);
        counter--;
        $("#uploadgroup"+counter).remove();

    }
    function getUploadVal(){
        var uploadValue = [];
        var flag =0;
        var upload_value = document.getElementsByName('uploadfile[]');
        for (i = 0; i < upload_value.length; i++) {
            if(upload_value[i].value !=''){
                uploadValue.push(upload_value[i].files[0].name);

            }
            else{

                flag++;
            }
        }

        if(flag == 0){

            var upload_string = 'uploadfile=' + uploadValue + '&type=' + flag;

            $.ajax({
                type: "POST",
                url: "ajax/upload_ajax.php",
                data: upload_string,
                success: function (data) {
                   // alert('success');
                }
            });
        }
        else{
            alert("File not selected");
        }
    }
    function logoimage_Validation()
    {

        var fuData = document.getElementById('uploadfile');
        var FileUploadPath = fuData.value;
        if (FileUploadPath == '')
        {
            alert("Please upload an image");
        }
        else
        {
            var Ext = FileUploadPath.substring(FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
            if (Ext == "png" || Ext == "jpeg" || Ext == "jpg" || Ext== "doc" || Ext== "docx" || Ext== "pdf")
            {

            }
            else
            {

                alert("Invalid file format ");
                fuData.value = "";
                //$("#dialog").dialog();

                $("#dialoginvalid").show();
                $("#dialoginvalid").html("Invalid File Format!");
                return false;
            }
        }
    }
</script>