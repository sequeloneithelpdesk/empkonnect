function CountryState(country_value,flag_data)
{
    if(country_value != '')
    {
        var ALL_data = "country=" + country_value + "&flag_value=" + flag_data;

        $.ajax({
            type: "POST",
            url: "ajax/company_ajax.php",
            data: ALL_data,
            success: function (html) {
               $("#"+flag_data).html(html);

            }
        });
    }


}

function StateCity(state_value,flag_data)
{
//alert(flag_data);
    //alert(state_value);
    if(state_value != '')
    {
        var ALL_data = "state=" + state_value + "&flag_value=" + flag_data;

        $.ajax({
            type: "POST",
            url: "ajax/company_ajax.php",
            data: ALL_data,
            success: function (html) {

                $("#"+flag_data).html(html);

            }
        });
    }


}

function logoimage_Validation()
{

    var fuData = document.getElementById('company_logo');
    var FileUploadPath = fuData.value;
    if (FileUploadPath == '')
    {
        alert("Please upload an image");
    }
    else
    {
        var Ext = FileUploadPath.substring(FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
        if (Ext == "png" || Ext == "jpeg" || Ext == "jpg" || Ext== "bmp" || Ext== "eps" || Ext== "pdf" || Ext== "psd" || Ext== "tiff")
        {
            $("#dialoginvalid").hide();

            if (!fuData.value == "")
            {
                var size = fuData.files[0].size;
                var imgsize = size / 1024;
                if (imgsize > 500)
                {
                    alert("Maximum file size exceeds");
                    fuData.value = "";
                    //$("#dialog").dialog();
                    $("#dialoginvalid").html("Invalid Size!");
                    return false;
                }
                else
                {
                    //alert("File accepted");
                    $("#comprequire_logo1").fadeOut(2000);
                    $("#dialoginvalid").hide();
                }
            }

        }
        else
        {

            //alert("Invalid file format ");
            fuData.value = "";
            //$("#dialog").dialog();

            $("#dialoginvalid").show();
            $("#dialoginvalid").html("Invalid File Format!");
            return false;
        }
    }
}

var specialKeys = new Array();
specialKeys.push(8);
function IsNumeric(e)
{
    var keyCode = e.which ? e.which : e.keyCode
    var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
    return ret;
}

var res;
function email_Validation()
{

    //var mailformat = ;

    var email1 = document.getElementById("email_Id").value;
    if (email1.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/))
    {

    }
    else
    {
        alert("Invalid Email id");
    }

}

/*---------Start Company --------*/

function companyAddEdit() {

    var status_val = $("#Companies").val();
    var StateID,CityID,hid_value,datastring,hide_logo;
    var comp_Name = $("#comp_Name").val();

    //var company_logo = document.getElementById("company_logo").files[0].name;

    var comp_Addr = $("#comp_Addr").val();
    var comp_Country = $("#comp_Country").val();
    if(status_val == 'add'){
        StateID = $("#StateID").val();
         CityID = $("#CityID").val();
    }
    else{
        StateID = $("#StateID2").val();
        CityID = $("#CityID2").val();
        hid_value= $("#compIDs").val();
        hide_logo= $("#company_logoName").val();
    }

    var comp_Pin = $("#comp_Pin").val();
    var comp_Phone = $("#comp_Phone").val();
    var comp_Fax = $("#comp_Fax").val();
    var PF_No = $("#PF_No").val();
    var ESI_No = $("#ESI_No").val();
    var PAN_No = $("#PAN_No").val();
    var TAN_No = $("#TAN_No").val();
    var TDS_Circle = $("#TDS_Circle").val();
    var TIN_No = $("#TIN_No").val();
    var Regist_No = $("#Regist_No").val();
    var LST_No = $("#LST_No").val();
    var CST_No = $("#CST_No").val();
    var STax_No = $("#STax_No").val();
    var email_Id = $("#email_Id").val();
    var web_site = $("#web_site").val();
    var CIT_Addr = $("#CIT_Addr").val();
    var CIT_City = $("#CIT_City").val();
    var CIT_PIN = $("#CIT_PIN").val();
 var formData = new FormData($("#form_sample_1")[0]);
       if(status_val == 'add') {
           datastring = 'comp_Name=' + comp_Name + '&company_logo=' + company_logo+ '&comp_Addr=' + comp_Addr
               + '&comp_Country=' + comp_Country+ '&StateID=' + StateID+ '&CityID=' + CityID
               + '&comp_Pin=' + comp_Pin+ '&comp_Phone=' + comp_Phone+ '&comp_Fax=' + comp_Fax
               + '&PF_No=' + PF_No+ '&ESI_No=' + ESI_No + '&PAN_No=' + PAN_No+ '&TAN_No=' + TAN_No
               + '&TDS_Circle=' + TDS_Circle+ '&TIN_No=' + TIN_No+ '&Regist_No=' + Regist_No
               + '&LST_No=' + LST_No+ '&CST_No=' + CST_No+ '&STax_No=' + STax_No+ '&email_Id=' + email_Id
               + '&web_site=' + web_site+ '&CIT_Addr=' + CIT_Addr+ '&CIT_City=' + CIT_City+ '&CIT_PIN=' + CIT_PIN
               + '&flag_value=' + status_val;
       }
    else{
           datastring = 'comp_Name=' + comp_Name + '&company_logo=' + company_logo+ '&comp_Addr=' + comp_Addr
               + '&comp_Country=' + comp_Country+ '&StateID=' + StateID+ '&CityID=' + CityID
               + '&comp_Pin=' + comp_Pin+ '&comp_Phone=' + comp_Phone+ '&comp_Fax=' + comp_Fax
               + '&PF_No=' + PF_No+ '&ESI_No=' + ESI_No + '&PAN_No=' + PAN_No+ '&TAN_No=' + TAN_No
               + '&TDS_Circle=' + TDS_Circle+ '&TIN_No=' + TIN_No+ '&Regist_No=' + Regist_No
               + '&LST_No=' + LST_No+ '&CST_No=' + CST_No+ '&STax_No=' + STax_No+ '&email_Id=' + email_Id
               + '&web_site=' + web_site+ '&CIT_Addr=' + CIT_Addr+ '&CIT_City=' + CIT_City+ '&CIT_PIN=' + CIT_PIN
               + '&flag_value=' + status_val+ '&hidecompID=' + hid_value;
       }



    if(comp_Name != ''){
        $.ajax({
            type: "POST",
            url: "ajax/companies_ajax.php",
            data: formData,
            success: function () {

              location.reload();

            },
            cache : false,
            contentType : false,
            processData : false
        });
    }
    else{
        alert("enter all field");
    }





}
/*--------- End Company ----------*/

/*--------- Start Add/Edit Company ----------*/
function company_action(id,action){

    if(action == 'edit'){

        var datastring = 'id=' + id + '&action=' + action;
        $.ajax({
            type: "POST",
            url: "ajax/edit/edit_company_ajax.php",
            data: datastring,
            success: function (html) {

                $('#modalbody').html(html);

                $('#companypopup').modal({
                    show: true

                });
                $('#close').click(function() {
                    location.reload();
                });
            }
        });

    }
    else{
        $.ajax({
            type: "POST",
            url: "ajax/add/add_company_ajax.php",
            data: datastring,
            success: function (data) {

                $('#modalbody').html(data);

                $('#companypopup').modal({
                    show: true

                });
                $('#close').click(function() {
                    location.reload();
                });
            }
        });


    }


}
/*--------- End Add/Edit Company ----------*/
