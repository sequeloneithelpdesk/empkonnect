
function selectGuardName(mvalue){
    if(mvalue == 2){
        $("#guard_label").html("Spouse Name");
        $("#anndate").show();
    }else {
        $("#guard_label").html("Guardian Name");
        $("#anndate").hide();
    }
}


function editFamily(id) {
//alert(id);
    $.ajax({
        type:"POST",
        url: "content/editFamily_content.php",
        data:{id:id},
        success: function(data){
            //alert (data);
            $('#portlet-configEditbody').html(data);
            console.log(data);

        }
    });

}


function editNominee(id) {
//alert(id);
    $.ajax({
        type:"POST",
        url: "content/editNominee_content.php",
        data:{id:id},
        success: function(data){
            //alert (data);
            $('#portlet-configEdit1tbody').html(data);
            console.log(data);

        }
    });

}


function editQualification(id) {
//alert(id);
    $.ajax({
        type:"POST",
        url: "content/editQualification_content.php",
        data:{id:id},
        success: function(data){
            //alert (data);
            $('#portlet-configEdit2tbody').html(data);
            console.log(data);

        }
    });

}

function editLanguage(id) {
//alert(id);
    $.ajax({
        type:"POST",
        url: "content/editLanguage_content.php",
        data:{id:id},
        success: function(data){
            //alert (data);
            $('#portlet-configEdit3tbody').html(data);
            console.log(data);

        }
    });

}

function submitEditQual(id) {
    var formData=$('#editQualForm').serialize();

    var type="editQual";
    //alert(formData);

    var qual=$("#qualification").val();
    var specialization=$("#specialization").val();
    if(qual == ""){
        toasterrormsg("Select Qualification ");
        $("#qualification").css('border-color','red');
        return false;
    }else{
        $("#qualification").css('border-color','');
    } 
    if(specialization == ""){
        toasterrormsg("Enter Specialization");
        $("#specialization").css('border-color','red');
        return false;
    }else {
       $("#specialization").css('border-color',''); 
    }
        $.ajax({
            type: "POST",
            url: "ajax/insertData.php?type=" + type,
            data: formData,
            success: function (data) {

                $('#portlet-configEdit2').modal('hide');
                location.reload();
            }
        });
    }


function submitEditFamily() {
    var formData=$('#editfamForm').serialize();
    //alert(formData);
    var relativeName=$("#relativeName").val();
    var relationship=$("#relationship").val();
    //alert(relativeName);
    if(relativeName == ""){
        toasterrormsg("Please enter Realative Name");
        return false;
    }

    if(relationship == ""){
        toasterrormsg("Select Relationship");
        return false;
    }
    var type="editFamily";
    $.ajax({
        type:"POST",
        url: "ajax/insertData.php?type="+type,
        data:formData,
        success: function(data){

            $('#portlet-configEdit').modal('hide');
            location.reload();
        }
    });


}

function submitEditNominee() {
    var formData=$('#nomineeEditForm').serialize();
    var nomineeName=$("#nomineeName").val();
    var nomineeRelation=$("#nomineeRelation").val();
    var nomineeDob=$("#nomineeDob").val();
    var nomineeWEF=$("#nomineeWef").val();

    if(nomineeName == ""){
        toasterrormsg("Please enter nominee name");
        $('#nomineeName').css('border-color','red');
        return false;
    }else{
       $('#nomineeName').css('border-color',''); 
    }

    if(nomineeRelation == ""){
        toasterrormsg("Please enter relationship");
        $('#nomineeRelation').css('border-color','red');
        return false;
    }else{
        $('#nomineeRelation').css('border-color','');
    }

    if(nomineeDob == ""){
        toasterrormsg("Please enter the Date of Birth");
        $('#nomineeDob').css('border-color','red');
        return false;
    }else{
        $('#nomineeDob').css('border-color','');
    }

    if(nomineeWEF == ""){
        toasterrormsg("Select WEF ");
        $('#nomineeWef').css('border-color','red');
        return false;
    }else{
        $('#nomineeWef').css('border-color','');
    }

    //alert (formData);
    var type="editNominee";
    $.ajax({
        type:"POST",
        url: "ajax/insertData.php?type="+type,
        data:formData,
        success: function(data){

            $('#portlet-configEdit1').modal('hide');
           location.reload();
        }
    });

}


function submitEditLanguage() {
    
    var formdata=$("#editLanguageForm").serialize()  ;
    //alert(formdata);
    var type="editLang";

    $.ajax({
        type:"POST",
        url: "ajax/insertData.php?type="+type,
        data:formdata,
        success: function(data){
            $('#portlet-configEdit3').modal('hide');
            location.reload()

        }
    });
}

function addFamily(id) {
    //var id=$("#empCode").val()
    //alter(id);
    $.ajax({
        type:"POST",
        url: "content/editAddFamily_content.php",
        data:{id:id},
        success: function(data){
            //alert (data);
            $('#portlet-configAddtbody').html(data);
            console.log(data);

        }
    });

}

function addNominee(id) {
    // employee id
    //var type="editAdd";
    $.ajax({
        type:"POST",
        url: "content/editAddNominee_content.php",
        data:{id:id },
        success: function(data){
            //alert (data);
            $('#portlet-config1Addtbody').html(data);
            console.log(data);

        }
    });

}

function addQual(id) {
    //alert("1");
    $.ajax({
        type:"POST",
        url: "content/editAddQualification_content.php",
        data:{id:id },
        success: function(data){
            //alert (data);
            $('#portlet-configAdd2tbody').html(data);
            console.log(data);

        }
    });
}

function addLang(id) {
    $.ajax({
        type:"POST",
        url: "content/editAddLanguage_content.php",
        data:{id:id },
        success: function(data){
            //alert (data);
            $('#portlet-configAdd3tbody').html(data);
            console.log(data);

        }
    });
}

function submitAddLang(){
    var formData=$('#editAddLangForm').serialize();
    //alert(formData);
    var type="editAddLang";
    $.ajax({
        type:"POST",
        url: "ajax/insertData.php?type="+type,
        data:formData,
        success: function(data){

            $('#portlet-config2Addtbody').modal('hide');
                location.reload();
        }
    });

}

function submitAddQual() {
    var formData=$('#editAddQualForm').serialize();
    //alert(formData);
    var type="editAddQual";
    var qual=$("#qualification").val();
    var specialization=$("#specialization").val();

    if(qual == ""){
        toasterrormsg("Select Qualification ");
        $("#qualification").css('border-color','red');
        return false;
    }else{
         $("#qualification").css('border-color','');
    }
     if(specialization == ""){
        toasterrormsg("Enter Specialization");
         $("#specialization").css('border-color','red');
        return false;
    }else {
         $("#specialization").css('border-color','');
    }
        $.ajax({
            type: "POST",
            url: "ajax/insertData.php?type=" + type,
            data: formData,
            success: function (data) {

                $('#portlet-config2Addtbody').modal('hide');
                location.reload();
                //location.reload();
            }
        });
    }

function submitAddNominee() {
    var formData=$('#editAddNomForm').serialize();
    var nomineeName=$("#nomineeName").val();
    var nomineeRelation=$("#nomineeRelation").val();
    var nomineeDob=$("#nomineeDob").val();
    var nomineeWEF=$("#nomineeWEF").val();

     if(nomineeName == ""){
        toasterrormsg("Please enter nominee name");
        $('#nomineeName').css('border-color','red');
        return false;
    }else{
       $('#nomineeName').css('border-color',''); 
    }

    if(nomineeRelation == ""){
        toasterrormsg("Please enter relationship ");
        $('#nomineeRelation').css('border-color','red');
        return false;
    }else{
        $('#nomineeRelation').css('border-color','');
    }

    if(nomineeDob == ""){
        toasterrormsg("Please enter the Date of Birth");
        $('#nomineeDob').css('border-color','red');
        return false;
    }else{
        $('#nomineeDob').css('border-color','');
    }

    if(nomineeWEF == ""){
        toasterrormsg("Select WEF ");
        $('#nomineeWef').css('border-color','red');
        return false;
    }else{
        $('#nomineeWef').css('border-color','');
    }
    //alert(formData);
    var type="editAddNominee";
    $.ajax({
        type:"POST",
        url: "ajax/insertData.php?type="+type,
        data:formData,
        success: function(data){
        //alert(data);

            $('#portlet-config1Addtbody').modal('hide');
            location.reload();
        }
    });


}

function submitAddFamily() {

    var formData=$('#editAddFamForm').serialize();
    var relativeName=$("#relativeName").val();
    var relationship=$("#relationship").val();
    if(relativeName == ""){
        toasterrormsg("Please enter Realative Name");
        return false;
    }

    if(relationship == ""){
        toasterrormsg("Select Relationship");
        return false;
    }
   // alert(formData);
    var type="editAddFam";
    $.ajax({
        type:"POST",
        url: "ajax/insertData.php?type="+type,
        data:formData,
        success: function(data){
            if(data == 1){
                $('#portlet-config').modal('hide');
                location.reload();
            }else {
                toasterrormsg("Problem in Adding Family");
            }

        }
    });

}




function check(checkid) {

    //var check=$("#motherTongue23").checked ;
    if($("#"+checkid).is(":checked")){
        $( "#"+checkid ).val("Y");
    }
    else if($("#"+checkid).is(":not(:checked)")){
        $( "#"+checkid ).val("N");
    }
}


function showImage() {
    $("#change_Image").show();
    $("#personal_info").hide();
    $("#official_details").hide();
    $("#change_password").hide();
    $("#pers_info").addClass("active");
    $("#offi_detail").removeClass("active");
    $("#change_pass").removeClass("active");
}

function showPersonal () {
    $("#change_Image").hide();
    $("#personal_info").show();
    $("#official_details").hide();
    $("#change_password").hide();
    $("#pers_info").addClass("active");
    $("#offi_detail").removeClass("active");
    $("#change_pass").removeClass("active");


}

function showOfficial () {
    $("#change_Image").hide();
    $("#official_details").show();
    $("#personal_info").hide();
    $("#change_password").hide();
    $("#offi_detail").addClass("active");
    $("#pers_info").removeClass("active");
    $("#change_pass").removeClass("active");
}

function showPassword () {
    $("#change_Image").hide();
    $("#change_password").show();
    $("#official_details").hide();
    $("#personal_info").hide();
    $("#change_pass").addClass("active");
    $("#pers_info").removeClass("active");
    $("#offi_detail").removeClass("active");
}

function getAllState(countryid) {

   // alert(countryid);
    var countryid= countryid;
    var type="allState";
    $.ajax({
        type: "POST",
        url: "ajax/emp_ajax.php",
        data: {countryid :  countryid, type : type},
        success: function (result) {
            //alert(result);
            //location.reload();
            $('#state').html(result);

        }
    });


}


function getAllCity(stateid) {

   // alert(countryid);
    var stateid= stateid;
    var type="allCity";
    $.ajax({
        type: "POST",
        url: "ajax/emp_ajax.php",
        data: {stateid :  stateid, type : type},
        success: function (result) {
            //alert(result);
            //location.reload();
            $('#city').html(result);

        }
    });


}


/*----------personal Information --------------*/

function perEnableTexts() {

    $("#dob").attr("disabled", false);
    $("#religion").attr("disabled", false);
    $("#nationality").attr("disabled", false);
    $("#mStatus").attr("disabled", false);
    $("#sex").attr("disabled", false);
    $("#lname").attr("readonly", false);
    $("#mname").attr("readonly", false);
    $("#fname").attr("readonly", false);

    $("#annivdate").attr("readonly", false);
    $("#bloodGroup").attr("disabled", false);
    $("#gaurdian").attr("readonly", false);
    
    $("#Lname").show();
    $("#fullName").hide();
    $("#FMname").show();
    

    $("#submitButton").show();
    $("#editButton").hide();
  }

function afterUpdatePerInfo(){

    $("#dob").attr("disabled", true);
    $("#religion").attr("disabled", true);
    $("#nationality").attr("disabled", true);
    $("#mStatus").attr("disabled", true);
    $("#sex").attr("disabled", true);
    $("#lname").attr("readonly", true);
    $("#mname").attr("readonly", true);
    $("#fname").attr("readonly", true);

    $("#annivdate").attr("readonly", true);
    $("#bloodGroup").attr("disabled", true);
    $("#gaurdian").attr("readonly", true);
    
    $("#Lname").hide();
    $("#fullName").show();
    $("#FMname").hide();



     $("#editButton").show();
     $("#submitButton").hide();

 }


function  submitPerInfo(id) {

    var fname=$("#fname").val();
    var dob=$("#dob").val();
    var doj=$("#doj").val();

    var dobarr = dob.split("/")
    var dojarr = doj.split("/");

    if(fname == ""){
        toasterrormsg("First Name can not Be blank");
        $("#fname").css('border-color' , 'red');
        return false;
    }else{
         $("#fname").css('border-color' , '');
    }

    if(dobarr[2] >= dojarr[2]){
        $('#dob').css('border-color', 'red');
        toasterrormsg("Date Of Birth can't be greater than or equal to Date Of Joining ");
        return false;
    }else{
         $('#dob').css('border-color', '');
    }


    var formData=$("#editPersForm").serialize() + '&empCode=' + id;
   // alert(formData);
    var type="editPersonal";
    $.ajax({
        type:"POST",
        url: "ajax/updateData.php?type="+type,
        data:formData,
        success: function(data){
           // alert (data);
            if(data == 1) {
                toastmsg("Updated Successfully");
                show_EditPic(id);
                location.reload();
                 //afterUpdatePerInfo();
                //$("#addemployeForm")[0].reset();
            }else {
                toasterrormsg("Error in Personal data");
            }
        }
    })

}

/*----------End Personal Information --------------*/

/*----------Start Contact Information --------------*/

function contactEnableTexts() {

    $("#mHNo").attr("readonly", false);
    $("#mStreetNo").attr("readonly", false);
    $("#mArea").attr("readonly", false);
    $("#mCity").attr("readonly", false);
    $("#mRegion").attr("readonly", false);
    $("#mState").attr("readonly", false);
    $("#mCountry").attr("readonly", false);
    $("#mPhoneNo").attr("readonly", false);
    $("#pEMailId").attr("readonly", false);
    $("#mobileNo").attr("readonly", false);
    $("#mPin").attr("readonly", false);

    
    $("#pHNo").attr("readonly", false);
    $("#pArea").attr("readonly", false);
    $("#pCity").attr("readonly", false);
    $("#pRegion").attr("readonly", false);
    $("#pState").attr("readonly", false);
    $("#pCountry").attr("readonly", false);
    $("#pPin").attr("readonly", false);
    $("#pPhoneNo").attr("readonly", false);
    $("#pStreetNo").attr("readonly", false);

    $("#submitContactButton").show();
    $("#editContactButton").hide();


}


function afterUpdateConInfo(){
    
    $("#mHNo").attr("readonly", true);
    $("#mStreetNo").attr("readonly", true);
    $("#mArea").attr("readonly", true);
    $("#mCity").attr("readonly", true);
    $("#mRegion").attr("readonly", true);
    $("#mState").attr("readonly", true);
    $("#mCountry").attr("readonly", true);
    $("#mPhoneNo").attr("readonly", true);
    $("#pEMailId").attr("readonly", true);
    $("#mobileNo").attr("readonly", true);
    $("#mPin").attr("readonly", true);

    
    $("#pHNo").attr("readonly", true);
    $("#pArea").attr("readonly", true);
    $("#pCity").attr("readonly", true);
    $("#pRegion").attr("readonly", true);
    $("#pState").attr("readonly", true);
    $("#pCountry").attr("readonly", true);
    $("#pPin").attr("readonly", true);
    $("#pPhoneNo").attr("readonly", true);
    $("#pStreetNo").attr("readonly", true);

    $("#submitContactButton").hide();
    $("#editContactButton").show();

}

function  submitContactInfo(id) {
    var formData=$("#editContactForm").serialize() + '&empCode=' + id;
   // alert(formData);
   var offemail=$("#errofficmail").val();
   var erremail=$("#erroremail").val();
   var type="editContact";
    if(offemail == 1 || erremail == 1){
        toasterrormsg("Correct Email  Format");
        return false;
    }
    $.ajax({
        type:"POST",
        url: "ajax/updateData.php?type="+type,
        data:formData,
        success: function(data){
           // alert (data);
            if(data == 1) {
                toastmsg("Updated Successfully");
                afterUpdateConInfo();
                //$("#addemployeForm")[0].reset();
            }else {
                toasterrormsg("Error in Contact data");
            }
        }
    })

}

/*----------End Contact Information --------------*/



/*----------Start Official Information --------------*/

function officialEnableTexts() {

    $("#statusCode").attr("disabled", false);
    $("#doj").attr("disabled", false);
    $("#dojWef").attr("disabled", false);
    $("#dol").attr("disabled", false);
    $("#dos").attr("disabled", false);
    $("#dor").attr("disabled", false);
    $("#function_supervisor").attr("disabled", false);
    $("#global_manager").attr("disabled", false);
    //$("#compCode").attr("disabled", false);
    $("#bussCode").attr("disabled", false);

    $("#locCode").attr("disabled", false);
    $("#wLocCode").attr("disabled", false);
    $("#grdCode").attr("disabled", false);
    $("#empTypeCode").attr("disabled", false);
    $("#functCode").attr("disabled", false);
    $("#subFunctCode").attr("disabled", false);
    $("#costCode").attr("disabled", false);
    $("#procCode").attr("disabled", false);
    $("#dsCODE").attr("disabled", false);
    $("#oEmail").attr("readonly", false);
    $("#effectiveDate").attr("disabled", false);
    $("#accesscode").attr("readonly", false);
    $("#lavel").attr("disabled", false);
    $("#divisionMast").attr("disabled", false);
    $("#regionMast").attr("disabled", false);
    $("#subBussUnit").attr("disabled", false);

    $("#leavReas").attr("readonly", false);
    $("#workphn").attr("readonly", false);
    $("#workphnExt").attr("readonly", false);


    $("#submitOfficialButton").show();
    $("#editOfficialButton").hide();


}

function  submitOfficialInfo(id) {
    var formData = $("#editOfficialForm").serialize() + '&empCode=' + id;
    // alert(formData);
    var empCode1 = $("#empCode1").val();
    var effectiveDate = $("#effectiveDate").val();
   // var compCode = $("#compCode").val();
    var doj = $("#doj").val();
    var dojWef = $("#dojWef").val();
   

    if ( empCode1 == "" || doj == "" || dojWef == "" ||  effectiveDate == "") {
        toasterrormsg("Please Fill All Mandatory fields");

        if (empCode1 == "") {
            $('#empCode1').css('border-color', 'red');

        } else {
            $('#empCode1').css('border-color', 'none');

        }
        if (doj == "") {

            $('#doj').css('border-color', 'red');

        } else {
            $('#doj').css('border-color', 'none');
        }
        if (dojWef == "") {

            $('#dojWef').css('border-color', 'red');

        }
        else {
            $('#dojWef').css('border-color', 'none');
        }

        if(effectiveDate == ""){
            $("#effectiveDate").css('border-color', 'red');
        }else{
             $("#effectiveDate").css('border-color', 'none');
        }

        return false;


    }
    else{
        var type = "editOfficial";
        $.ajax({
            type: "POST",
            url: "ajax/updateData.php?type=" + type,
            data: formData,
            success: function (data) {
                //alert (data);
                if (data == 1) {
                    toastmsg("Updated Successfully");
                    //$("#addemployeForm")[0].reset();
                }
                else if (data == 3) {
                    toastmsg("Inserted Successfully");
                }else if(data == 5){
                    toasterrormsg("Email Sending Error");
                }else if(data == 2){
                    toasterrormsg("Updating Error");
                }
                else if(data == 4){
                    toasterrormsg("Inserting Error");
                }else{

                    toasterrormsg(data);   
                }
            }
        });
    }

}


/*----------End Official Information --------------*/

/*----------Start Sepration Information --------------*/
function seprationEnableTexts() {

    $("#statusCode").attr("disabled", false);
    
    $("#dol").attr("disabled", false);
    $("#dos").attr("disabled", false);
    $("#dor").attr("disabled", false);
  
    
    

    $("#leavReas").attr("readonly", false);
   


    $("#submitSepration").show();
    $("#editSepration").hide();


}

function  submitSeprationInfo(id) {
    var formData = $("#editSeprationForm").serialize() + '&empCode=' + id;
    // alert(formData);
    var empCode1 = $("#empCode1").val();

        var type = "editsepration";
        $.ajax({
            type: "POST",
            url: "ajax/updateData.php?type=" + type,
            data: formData,
            success: function (data) {
                //alert (data);
                if (data == 1) {
                    toastmsg("Updated Successfully");
                    //$("#addemployeForm")[0].reset();
                }
                else {
                    toasterrormsg("Error in Sepration data");
                }
            }
        });

}

/*----------End Sepration Information --------------*/

/*----------Start Bank Information --------------*/

function bankEnableTexts() {
$("#bankCode").attr("disabled", false);
$("#smopNo").attr("readonly", false);
$("#reimbankCode").attr("disabled", false);
$("#rmopNo").attr("readonly", false);

    $("#submitBankButton").show();
    $("#editBankButton").hide();

}


function  submitBankInfo(id) {
    var formData=$("#editBankForm").serialize() + '&empCode=' + id;
    //alert(formData);
    var type="editBank";
    $.ajax({
        type:"POST",
        url: "ajax/updateData.php?type="+type,
        data:formData,
        success: function(data){
           // alert (data);
            if(data == 1) {
                toastmsg("Updated Successfully");
                //$("#addemployeForm")[0].reset();
            }
            else {
                toasterrormsg("Error in Bank Updation");
            }
        }
    })

}


/*----------End Bank Information --------------*/

/*----------Start Identity Information --------------*/

function staturyEnableTexts() { 
    // $("#uanNo").attr("readonly", false);
    // $("#PfNo").attr("readonly", false);
    // $("#esiNo").attr("readonly", false);
    $("#passportNo").attr("readonly", false);
    $("#passportPlace").attr("readonly", false);
    $("#passportIssue").attr("disabled", false);
    $("#passportValidityDate").attr("disabled", false);
    $("#passportAddress").attr("readonly", false);
    $("#dlNo").attr("readonly", false);
    $("#dlPlace").attr("readonly", false);
    $("#dlDate").attr("disabled", false);
    $("#dlValidityDate").attr("disabled", false);
    $("#dlAddress").attr("readonly", false);
    // $("#panNo").attr("readonly", false);

     $("#adharNo").attr("readonly", false);
     $("#registration").attr("readonly", false);
     $("#trade").attr("readonly", false);
     $("#contract").attr("readonly", false);



    $("#submitStaturyButton").show();
    $("#editStaturyButton").hide();

}

function afterUpdateStatInfo(){
    $("#passportNo").attr("readonly", true);
    $("#passportPlace").attr("readonly", true);
    $("#passportIssue").attr("disabled", true);
    $("#passportValidityDate").attr("disabled", true);
    $("#passportAddress").attr("readonly", true);
    $("#dlNo").attr("readonly", true);
    $("#dlPlace").attr("readonly", true);
    $("#dlDate").attr("disabled", true);
    $("#dlValidityDate").attr("disabled", true);
    $("#dlAddress").attr("readonly", true);
    // $("#panNo").attr("readonly", false);

     $("#adharNo").attr("readonly", true);
     $("#registration").attr("readonly", true);
     $("#trade").attr("readonly", true);
     $("#contract").attr("readonly", true);



    $("#submitStaturyButton").hide();
    $("#editStaturyButton").show();

}


function  submitStaturyInfo(id) {
    var passNo= $.trim($("#passportNo").val());
    var passPl= $.trim($("#passportPlace").val());
    var passIs= $.trim($("#passportIssue").val());
    var passDate= $.trim($("#passportValidityDate").val());
    var passAddr= $.trim($("#passportAddress").val());

    var dlNo= $.trim($("#dlNo").val());
    var dlPlace= $.trim($("#dlPlace").val());
    var dlDate= $.trim($("#dlDate").val());
    var dlValidityDate= $.trim($("#dlValidityDate").val());
    var dlAddress= $.trim($("#dlAddress").val());

    var PassIssue = moment(passIs, "DD/MM/YYYY").format('YYYY-MM-DD');
    var PassValidDate = moment(passDate, "DD/MM/YYYY").format('YYYY-MM-DD');

    var dlIssue = moment(dlDate, "DD/MM/YYYY").format('YYYY-MM-DD');
    var dlValidDate = moment(dlValidityDate, "DD/MM/YYYY").format('YYYY-MM-DD');

   if(passNo !="" ){
        if(passPl == "" || passPl ==" " ||passIs =="" || passDate == "" || passAddr == "" || passNo == ""){
            
            if(passNo == ""){
                $("#passportNo").css('border-color', 'red');
                toasterrormsg("Please Fill all Mandatory Fields");
                 return false;
            }else{
                $("#passportNo").css('border-color', 'none');
               
            }

            if(passPl == ""){
             
                $("#passportPlace").css('border-color', 'red');
                toasterrormsg("Please Fill all Mandatory Fields");
                return false;
            }else{
                $("#passportPlace").css('border-color', 'none');
            }

            if(passIs == ""){
                
                $("#passportIssue").css('border-color', 'red');
                toasterrormsg("Please Fill all Mandatory Fields");
                return false;
            }else{
                $("#passportIssue").css('border-color', 'none');
            }

            if( passAddr == " "){
                
                $("#passportAddress").css('border-color', 'red');
                toasterrormsg("Please Fill all Mandatory Fields");
                return false;
            }else{
                $("#passportAddress").css('border-color', '');
            }
           
            if( passDate == " "){
               
                $("#passportValidityDate").css('border-color', 'red');
                toasterrormsg("Please Fill all Mandatory Fields");
                 return false;
            }else{
               $("#passportValidityDate").css('border-color', '');
            }
            
        }else{ 
             $("#passportNo").css('border-color', '');
             $("#passportValidityDate").css('border-color', '');
             $("#passportAddress").css('border-color', '');
             $("#passportIssue").css('border-color', '');
             $("#passportPlace").css('border-color', '');
        }
   }else{ 

             $("#passportNo").css('border-color', '');
             $("#passportValidityDate").css('border-color', '');
             $("#passportAddress").css('border-color', '');
             $("#passportIssue").css('border-color', '');
             $("#passportPlace").css('border-color', '');
        }
   

    if(dlNo != ""){ 
        if(dlPlace == "" || dlDate =="" || dlValidityDate == "" || dlAddress == "" || dlNo == ""){

            if(dlPlace == ""){
                $("#dlPlace").css('border-color', 'red');
                toasterrormsg("Please Fill all Mandatory Fields");
                 return false;
            }else{
                $("#dlPlace").css('border-color', '');
               
            }

            if(dlDate == ""){
             
                $("#dlDate").css('border-color', 'red');
                toasterrormsg("Please Fill all Mandatory Fields");
                return false;
            }else{
                $("#dlDate").css('border-color', '');
            }

            if(dlValidityDate == ""){
                
                $("#dlValidityDate").css('border-color', 'red');
                toasterrormsg("Please Fill all Mandatory Fields");
                return false;
            }else{
                $("#dlValidityDate").css('border-color', '');
            }

            if( dlAddress == " "){
                
                $("#dlAddress").css('border-color', 'red');
                toasterrormsg("Please Fill all Mandatory Fields");
                return false;
            }else{
                $("#dlAddress").css('border-color', '');
            }
           
            if( dlNo == " "){
               
                $("#dlNo").css('border-color', 'red');
                toasterrormsg("Please Fill all Mandatory Fields");
                 return false;
            }else{
               $("#dlNo").css('border-color', '');
            }
            
        } $("#dlPlace").css('border-color', '');
             $("#dlDate").css('border-color', '');
             $("#dlValidityDate").css('border-color', '');
             $("#dlAddress").css('border-color', '');
             $("#dlNo").css('border-color', '');
    }else{
             $("#dlPlace").css('border-color', '');
             $("#dlDate").css('border-color', '');
             $("#dlValidityDate").css('border-color', '');
             $("#dlAddress").css('border-color', '');
             $("#dlNo").css('border-color', '');
    }

    if(PassIssue > PassValidDate){
        $("#passportIssue").css('border-color', 'red');
        $("#passportValidityDate").css('border-color', 'red');
        toasterrormsg("Date Of Issue is always less than date of Validity");
         return false;
    }else{
        $("#passportIssue").css('border-color', '');
        $("#passportValidityDate").css('border-color', '');         
    }
    

    if(dlIssue > dlValidDate){
        $("#dlDate").css('border-color', 'red');
        $("#dlValidityDate").css('border-color', 'red');
        toasterrormsg("Date Of Issue is always less than date of Validity");
         return false;
    }else{
        $("#dlDate").css('border-color', '');
        $("#dlValidityDate").css('border-color', '');
               
    }
    
    
      

    var formData=$("#editStaturyForm").serialize() + '&empCode=' + id;
    //alert(formData);
    var type="editStatury";
    $.ajax({
        type:"POST",
        url: "ajax/updateData.php?type="+type,
        data:formData,
        success: function(data){
            //alert (data);
            if(data == 1) {
                toastmsg("Updated Successfully");
                afterUpdateStatInfo();
                //$("#addemployeForm")[0].reset();
            }
            else {
                toasterrormsg("Error in Statutory Updation");
            }
        }
    })

}

/*----------End Identity Information --------------*/


/*----------Start Statutory Information --------------*/

function identityEnableTexts() {
    $("#uanNo").attr("readonly", false);
    $("#PfNo").attr("readonly", false);
    $("#esiNo").attr("readonly", false);
    $("#panNo").attr("readonly", false);
    // $("#adharNo").attr("readonly", false);
    //
    // $("#registration").attr("readonly", false);
    // $("#trade").attr("readonly", false);
    // $("#contract").attr("readonly", false);



    $("#submitIdentityButton").show();
    $("#editIdentityButton").hide();

}


function  submitIdentityInfo(id) {
    var formData=$("#editIdentityForm").serialize() + '&empCode=' + id;
    //alert(formData);
    var type="editIdentity";
    $.ajax({
        type:"POST",
        url: "ajax/updateData.php?type="+type,
        data:formData,
        success: function(data){
            //alert (data);
            if(data == 1) {
                toastmsg("Updated Successfully");
                //$("#addemployeForm")[0].reset();
            }
            else {
                toasterrormsg("Error in Statutory Updation");
            }
        }
    })

}

/*----------End Statutory Information --------------*/


/*----------Start Image Information --------------*/
function submitImage(id) {
    var aFormData = new FormData();
    aFormData.append("file", $('#fileToUpload').get(0).files[0]);
    
    $.ajax({
        url: "../Profile/ajax/upload.php?empCode="+id, // Url to which the request is send
        type: "POST",             // Type of request to be send, called as method
        data: aFormData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false,       // The content type used when sending data to the server.
        cache: false,             // To unable request pages to be cached
        processData:false,        // To send DOMDocument or non processed data file it is set to false
        beforeSend: function(){
                loading();
        },
        success: function(data){
                unloading();
            
        //if(data == "success"){
            //$("#message1").html("Image is Updated Successfully");
           // toastmsg("Image is Updated Successfully");
       // }else{
           // $("#message").html(data);
            //toasterrormsg(data)
        // }
            
        show_EditPic(id);
        show_headerPic(id);

        }
    });
}

function show_ProfilePic(eid) {
    var type="showPc";
    //alert(eid);
    $.ajax({
        url: "../Profile/ajax/updateData.php?type="+type, // Url to which the request is send
        type: "POST",             // Type of request to be send, called as method
        data:{ oCode: eid}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        cache: false,
        beforeSend: function(){
            loading();
        },
        success: function(data){
            unloading();   // A function to be called if request succeeds
            //$('#loading').hide();
            $("#profilePic").html(data);

        }
    });
}

function show_headerPic(eid) {
   var type="headerPic";
   // alert(eid);
    $.ajax({
        url: "../Profile/ajax/updateData.php?type="+type, // Url to which the request is send
        type: "POST",         // Type of request to be send, called as method
        data:{ oCode: eid},  // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        cache: false,       // To send DOMDocument or non processed data file it is set to false
        success: function(data)   // A function to be called if request succeeds
        {  // alert(data);
            //$('#loading').hide();
            $("#headerPic").html(data);

        }
    });
}

function show_EditPic(eid) {
    var type="showPc";
   // alert(eid);
    $.ajax({
        url: "../Profile/ajax/updateData.php?type="+type, // Url to which the request is send
        type: "POST",             // Type of request to be send, called as method
        data:{ oCode: eid}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        cache: false,        // To send DOMDocument or non processed data file it is set to false
        success: function(data)   // A function to be called if request succeeds
        {  // alert(data);
            //$('#loading').hide();
            $("#profilePic").html(data);

        }
    });
}

/*----------End Imaage Information --------------*/

/*----------Start Change Password Information --------------*/

function change_Password(empid)
{
    var type = "change";
    var newpass = $("#new_password").val();
    var confpass = $("#confirm_password").val();
    var oldpass = $("#opass").val();

   var valOldPass = $("#showMsg").html();
   var valConfPass = $("#showMsg").html();
    var hiddenVal=$("#newpass").val();

    if(oldpass == ""){
        toasterrormsg("old password cant be null");
        return false;
    }else if(newpass == ""){
        toasterrormsg("New password cant be null");
        return false;
    }else if(confpass == ""){
        toasterrormsg("Confirm password cant be null");
        return false;
    }
    else if(newpass != confpass){
        toasterrormsg("New Password and Confirm password should be equal");
        return false;
    }
    else if(valOldPass != 0){
        toasterrormsg("old password is not correct");
        return false;
    }
    else if(valConfPass != 0){
        toasterrormsg("Confirm password is not correct");
        return false;
    }
    else if(hiddenVal == ""){
        toasterrormsg("Please folllow all Password Validation Rule");
        return false;
    }
    else {

        var dataString = 'new_password='+ newpass +'&confirm_password=' + confpass+'&uid=' + empid + '&oldpass=' + oldpass;

        $.ajax({
            type: "POST",
            url: "ajax/updateData.php?type="+type,
            data: dataString,
            success: function (data) {
                alert(data);
                //document.location.href='index.php'
                //$("#showMsg").html();
                if(data == 1){
                    toastmsg("Update successfully");
                }else if (data == 2){
                    toasterrormsg(" New Password should not equal to previous password");
                }else {
                    toasterrormsg(" Not Updated successfully");
                }
               // location.reload();
            }
        });

    }


}

function password_Validation()
{

    $('#pswd_info').show();

    $('#new_password').keyup(function () {

        var pswd = $(this).val();
        var passlen = $('#pass_length').val();
        var alphalen = $('#alphabet_char').val();
        var upperlen = $('#capital').val();
        var lowerlen = $('#small').val();
        var numlen = $('#number_v').val();
        var speclen = $('#sletter').val();
        var x;
        var checking="";
        if (pswd.length < passlen)
        {
            $('#pass_length').removeClass('valid_img').addClass('invalid_img');
            checking=false;
        }
        else
        {
            $('#pass_length').removeClass('invalid_img').addClass('valid_img');
            x = $('#new_password').val();
            //alert(x);
        }
        if ((pswd.match(/[!@#$%^&*.]/)) && (pswd.match(/[!@#$%^&*.]/).length == speclen))
        {
            $('#sletter').removeClass('invalid_img').addClass('valid_img');
        }
        else
        {
            $('#sletter').removeClass('valid_img').addClass('invalid_img');
            checking=false;
        }
        if ((pswd.match(/[A-Z]/)) && (pswd.match(/[A-Z]/).length == upperlen))
        {
            $('#capital').removeClass('invalid_img').addClass('valid_img');
        }
        else
        {
            $('#capital').removeClass('valid_img').addClass('invalid_img');
            checking=false;
        }
        if ((pswd.match(/[a-z]/)) && (pswd.match(/[a-z]/).length == lowerlen))
        {
            $('#small').removeClass('invalid_img').addClass('valid_img');
        }
        else
        {
            $('#small').removeClass('valid_img').addClass('invalid_img');
            checking=false;
        }
        if ((pswd.match(/\d/)) && (pswd.match(/\d/).length == numlen))
        {
            $('#number_v').removeClass('invalid_img').addClass('valid_img');
        }
        else
        {
            $('#number_v').removeClass('valid_img').addClass('invalid_img');
            checking=false;
        }
        if (x.length >= passlen && (pswd.match(/[!@#$%^&*.]/)) && (pswd.match(/[!@#$%^&*.]/).length == speclen) &&
            (pswd.match(/[A-Z]/)) && (pswd.match(/[A-Z]/).length == upperlen) && (pswd.match(/[a-z]/)) && (pswd.match(/[a-z]/).length == lowerlen) &&
            (pswd.match(/\d/)) && (pswd.match(/\d/).length == numlen) && checking=="") {
            $('#pswd_info').hide();
            $("#newpass").val("1");



        }else{
            $('#pswd_info').show();
        }
    });
}

function confirmpassword_Validation()
{
    var pass = $('#new_password').val();
    var confPass = $('#confirm_password').val();
    var m = pass.length;
    var n = confPass.length;
    if(pass != confPass){
        //alert("Password is equel.");
        $("#confirmerror").html("Incorrect Password");
    }
    else{
        $("#confirmerror").html("correct Password");
        //alert("Password is not equel.");
    }
    // if(confPass == 0)
    // {
    //     $("#pCheckPassword").html("");
    // }
}


function  oldPassword_Validation(userId) {
    var oldpass=$("#opass").val();
    var type="oldPassCheck";
    $.ajax({
        type: "POST",
        url: "ajax/updateData.php?type="+type,
        data: {oldpass:oldpass, userId:userId},
        success: function (data) {
                
                $("#showMsg").html(data);

            
        }
    });
}
/*----------End Change Password  Information --------------*/
