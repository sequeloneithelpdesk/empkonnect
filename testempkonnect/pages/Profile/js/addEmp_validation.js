var empCode = $("#empCode").val();

function checkDate() {

	var EnteredDate = $("#effectiveDate").val(); // For JQuery

	var date = EnteredDate.substring(0, 2);
	var month = EnteredDate.substring(3, 5);
	var year = EnteredDate.substring(6, 10);

	var myDate = new Date(year, month -1, date);
	var today = new Date();

	if (myDate < today ) {
		alert("Please Enter Date greater than today's date");
		$("#erroreffectdate").show();
		$("#erroreffectdate").fadeOut(5000);
		$("#effectiveDate").val("");

	}
}

// function getAccessCode(acc) {
// 	$("#accesscode").val(acc);
// }

function getDateOfConf(doc) {
	//alert(doc);
	$("#dojWef").val(doc);
}

function selectGuardName(mvalue){
	if(mvalue == 2){
		$("#guard_label").html("Spouse Name");
		$("#anndate").show();
	}else {
		$("#anndate").hide();
	}
}

//To Submit personal and official details
function submitData(type){

	var empCode1 		= $("#empCode1").val();


	var Emp_title = $("#Emp_title").val();
	var empFName = $("#empFName").val();
	var empMName = $("#empMName").val();
	var empLName = $("#empLName").val();
	var sex = $("#sex").val();
	var mStatus = $("#mStatus").val();
	var nationality = $("#nationality").val();

	var dob = $("#dob").val();
	var doblen = $("#dob").val().length;

	var doj = $("#doj").val();
	var dojWef = $("#dojWef").val();

	var dojlen = doj.length;
	var doclen = dojWef.length;
	var mngrCode 		= $("#global_manager").val();
	var mngrCode2 		= $("#function_supervisor").val();
	var compCode = $("#compCode").val();
	var bussCode = $("#bussCode").val();
	var locCode = $("#locCode").val();
	var wLocCode = $("#wLocCode").val();
	var grdCode = $("#grdCode").val();
	var empTypeCode = $("#empTypeCode").val();
	var functCode = $("#functCode").val();
	var subFunctCode = $("#subFunctCode").val();
	var costCode = $("#costCode").val();
	var procCode = $("#procCode").val();
	var dsCODE = $("#dsCODE").val();
	var effectiveDate= $("#effectiveDate").val();
	var accesscode=$("#accesscode").val();
	var oEmail=$("#oEmail").val();
	var lavel= $("#lavel").val();
	var divisionMast= $("#divisionMast").val();
	var regionMast= $("#regionMast").val();
	var subBussUnit= $("#subBussUnit").val();
	var workphn    =  $("#workphn").val();
	var workphnExt =  $("#workphnExt").val();
	var religion = $("#religion").val();
	var gaurdian= $("#gaurdian").val();
	var annivdate= $("#annivdate").val();
	var bloodGroup = $("#bloodGroup").val();
	var type =type;

	 var Startdate = moment(doj, "DD/MM/YYYY").format('YYYY-MM-DD');
        var Enddate = moment(dojWef, "DD/MM/YYYY").format('YYYY-MM-DD');


	var dobarr = dob.split("/")
	var dojarr = doj.split("/");

	//alert(dobarr[2]);
	//alert(dojarr[2]);


	if(empFName=="" ||  empCode1=="" ||doj=="" || dojWef=="" || compCode==""){
		toasterrormsg("Please Fill All Mandatory Fields");
		if(compCode==""){
			$("#s2id_compCode").addClass('errorRed');
			//$('#compCode').css('border-color', 'red');

		}else {
			$("#s2id_compCode").removeClass('errorRed');
		}
		if(empFName== ""){
			$("#empFName").css('border-color', 'red');
		}else {
			$("#empFName").css('border-color', '');
		}
		if(empCode1== ""){
			$('#empCode1').css('border-color', 'red');

		}else {
			$('#empCode1').css('border-color', '');

		}if(doj=="" ){

			$('#doj').css('border-color', 'red');

		}else {
			$('#doj').css('border-color', '');
		}
		if(dojWef==""){

			$('#dojWef').css('border-color', 'red');

		}
		else{
			$('#dojWef').css('border-color', '');
		}

		return false;


	}/*else if (doblen != 10) {
	        $('#doj').css('border-color', 'red');
	        toasterrormsg("Date Of joining in not in coorect format");
	        return false;
	    }*/
	else if(Enddate < Startdate){
		$('#dojWef').css('border-color', 'red');
		toasterrormsg("Date Of Confirmation can't be less than Date Of Joining ");
		return false;
	}
	else if(dobarr[2] >= dojarr[2]){
		$('#dob').css('border-color', 'red');
		toasterrormsg("Date Of Birth can't be greater than or equal Date Of Joining ");
		return false;
	}else if(dojlen != 10){
		$('#doj').css('border-color', 'red');
		toasterrormsg("Date Of joining in not in coorect format");
		return false;
	} else if (doclen != 10) {
	    $('#dojWef').css('border-color', 'red');
	    toasterrormsg("Date Of Confirmation in not in coorect format");
	    return false;
	} 
	else {

			var formData = $('#addemployeForm').serialize() + '&type=' + type +'&mngrCode=' + mngrCode + '&mngrCode2=' + mngrCode2 +'&dsCODE=' + dsCODE + '&effectiveDate=' + effectiveDate + '&accesscode=' + accesscode
				+ '&lavel=' + lavel + '&divisionMast=' + divisionMast + '&regionMast=' + regionMast + '&subBussUnit=' + subBussUnit
				+ '&workphn=' + workphn + '&workphnExt=' + workphnExt + '&empFName=' + empFName + '&empMName=' + empMName + '&empLName=' + empLName + '&Emp_title=' + Emp_title + '&gaurdian=' + gaurdian
				+ '&annivdate=' + annivdate + '&bloodGroup=' + bloodGroup + '&sex=' + sex + '&mstatus=' + mStatus  + '&dob=' + dob + '&nationality=' + nationality ;

			$.ajax({
				type:"POST",
				url: "ajax/emp_ajax.php",
				data:formData,
				success: function(data){
					//alert(data);
					if(data == 1) {
						toastmsg("Employee added successfully");
						$("#empFName").css('border-color', '');
						$("#empCode1").css('border-color', '');
						$("#doj").css('border-color', '');
						$("#dojWef").css('border-color', '');
						$("#compCode").removeClass('errorRed');
						$("#dob").css('border-color', '');

						$("#addemployeForm")[0].reset();
						//location.reload();

						 $("#emptitle").val('').trigger('change');
						 $("#compCode").val('').trigger('change');
						 $("#locCode").val('').trigger('change');
						 $("#wLocCode").val('').trigger('change');
						 $("#functCode").val('').trigger('change');
						 $("#subFunctCode").val('').trigger('change');
						 $("#dsCODE").val('').trigger('change');
						 $("#grdCode").val('').trigger('change');
						 $("#lavel").val('').trigger('change');
						 $("#bussCode").val('').trigger('change');
						 $("#subBussUnit").val('').trigger('change');
						 $("#empTypeCode").val('').trigger('change');
						 $("#costCode").val('').trigger('change');
						 $("#procCode").val('').trigger('change');
						 $("#divisionMast").val('').trigger('change');
						 $("#regionMast").val('').trigger('change');
						 $("#global_manager").val('').trigger('change');
						 $("#function_supervisor").val('').trigger('change');
						 $("#workphn").val('').trigger('change');
						 $("#workphnExt").val('').trigger('change');
						 $("#mStatus").val('').trigger('change');
						 $("#nationality").val('').trigger('change');
						 $("#religion").val('').trigger('change');
						 $("#bloodGroup").val('').trigger('change');
						 
					}else if(data == 2) {
						toasterrormsg("Employee is Already Exist ");
					}
					else if(data == 5){
						toasterrormsg("Sending Email Error");
					}
					else {
						toasterrormsg(data);
					}
				}
			});
		}
	}

//To Submit Bank  data
function submitBankData(type){
	var empCode = $("#empCode").val();
	var bankCode = $("#bankCode").val();
	var reimbankCode = $("#reimbankCode").val();
	//var ifscCode = $("#ifscCode").val();
	var reimbankCode = $("#reimbankCode").val();
	//var reimIfsc = $("#reimIfsc").val();
	var rmopNo = $("#rmopNo").val();
	var smopNo = $("#smopNo").val();


	if(type == 'update'){
		var formData = $('#bankDetailsUpdate').serialize()+ '&empCode=' + empCode + '&type=' + type;

	}else {
		if (empCode == "") {
			toasterrormsg("Please Fill Employee Code");
			return false;
		}
		if (bankCode == "") {
			toasterrormsg("Please Select bank Fields");
			return false;
		}
		if (smopNo == "") {
			toasterrormsg("Please Fill Account No Fields");
			return false;
		}
		if (reimbankCode == "") {

			toasterrormsg("Please Select bank  Fields");
			return false;
		}
		if (rmopNo == "") {
			toasterrormsg("Please Fill rmop Fields");
			return false;
		}
		var formData = $('#updateEmpBankForm').serialize() + '&empCode=' + empCode + '&type=' + type;


		$.ajax({
			type: "POST",
			url: "ajax/emp_ajax.php",
			data: formData,
			success: function (data) {
				if (data == 1) {
					toastmsg("sucess");

				} else {
					toasterrormsg("Error in Bank data");
				}

			}
		});

	}
}

//to Submit Statury Data
function submitStaturyData(type) {

	var empCode = $("#empCode").val();
	var uanNo = $("#uanNo").val();
	var PfNo = $("#PfNo").val();
	var esiNo = $("#esiNo").val();

	var formData = $('#updateEmpStaturyForm').serialize() + '&empCode=' + empCode + '&type=' + type;

	if(empCode=="" || uanNo=="" ||  PfNo=="" || esiNo==""){
		toasterrormsg("Please fill all mandatory Fields");
		return false;
	}else{
		$.ajax({
			type:"POST",
			url: "ajax/emp_ajax.php",
			data:formData,
			success: function(data){
				if(data == 1){
					toastmsg("sucess");
				}else {
					toasterrormsg("Error in Statury data");
				}

			}
		});

	}

}

//To Submit Identity details
function submitIdentityData(type) {

	var empCode = $("#empCode").val();
	var passNo = $("#passportNo").val();
	var passPlace = $("#passportPlace").val();
	var passIssue = $("#passportIssue").val();
	var passValidityDate = $("#passportValidityDate").val();
	var passAddress = $("#passportAddress").val();
	var dlNo = $("#dlNo").val();
	var dlPlace = $("#dlPlace").val();
	var dlDate = $("#dlDate").val();
	var dlValidityDate =$("#dlValidityDate").val();
	var dlAddress = $("#dlAddress").val();
	var panNo = $("#panNo").val();
	var adharNo = $("#adharNo").val();
	
	var contract= $("#contract").val();
	var registration= $("#registration").val();
	var trade= $("#trade").val();


	var formData = $('#updateIdentityForm').serialize() + '&empCode=' + empCode + '&type=' + type + '&passIssue=' + passIssue + '&passPlace=' + passPlace +'&passNo=' + passNo
		+'&passValidityDate=' + passValidityDate + '&passAddress=' + passAddress + '&contract=' + contract + '&registration=' + registration
		+ '&trade=' + trade;

	if(empCode=="" || dlNo=="" ||  dlValidityDate=="" || dlAddress==""){
		toasterrormsg("Please Fill All Required Fields");
		return false;
	}else{
		$.ajax({
			type:"POST",
			url: "ajax/emp_ajax.php",
			data:formData,
			success: function(data){
				if(data == 1){
					toastmsg("sucess");
				}else if (data == 2){
					toasterrormsg("Error in Transaction data");
				}else {
					toasterrormsg("Error in Master  data");
				}

			}
		});

	}
	
}

//To Submit personal details
function submitPersonalData(type) {

	var empCode = $("#empCode").val();
	var dol 			= $("#dol").val();
	var leavReas        = $("#leavReas").val();
	var dos 			= $("#dos").val();
	var dor 			= $("#dor").val();
	var Status_Code     = $("#statusCode").val();


	var formData = $('#updatePersonalForm').serialize() + '&type=' + type + '&empCode=' + empCode;
	if (empCode == "") {
		toasterrormsg("Please Fill Employee Code Fields");
		return false;
	} else {
		$.ajax({
			type: "POST",
			url: "ajax/emp_ajax.php",
			data: formData,
			success: function (data) {
				if(data == 1){
					toastmsg("sucess");
				}else if(data == 2){
					toasterrormsg("Error in Transaction data");
				}else {
					toasterrormsg("Error in Master data");
				}

			}
		});


	}
}

//To Submit Contact details
function submitContactData(type) {

	var empCode = $("#empCode").val();

	var mHNo = $("#mHNo").val();
	var mStreetNo = $("#mStreetNo").val();
	var mArea = $("#mArea").val();
	var mCity = $("#mCity").val();
	var mRegion = $("#mRegion").val();
	var mState = $("#mState").val();
	var mCountry = $("#mCountry").val();
	var mPin = $("#mPin").val();
	var mPhoneNo = $("#mPhoneNo").val();
	var pEMailId = $("#pEMailId").val();
	var mobileNo = $("#mobileNo").val();

	var pHNo = $("#pHNo").val();
	var pStreetNo = $("#pStreetNo").val();
	var pArea = $("#pArea").val();
	var pCity = $("#pCity").val();
	var pRegion = $("#pRegion").val();
	var pState = $("#pState").val();
	var pCountry = $("#pCountry").val();
	var pPin = $("#pPin").val();
	var pPhoneNo = $("#pPhoneNo").val();

	var formData = $('#updateContactForm').serialize() + '&empCode=' + empCode + '&type=' + type ;
	//alert(formData);
	if (empCode == "") {
		toasterrormsg("Please Fill All Required Fields");
		return false;
	} else {
		$.ajax({
			type: "POST",
			url: "ajax/emp_ajax.php",
			data: formData,
			success: function (data) {
				// var result = $.parseJSON(data);
				// if (result.status == true) {
				// 	toastmsg(result.text);
				// 	//  window.location.reload(true)
				// } else {
				// 	toasterrormsg(result.text);
				// }

				if(data == 1){
					toastmsg("sucess");
				}else {
					toasterrormsg("Error in Statury data");
				}

			}
		});


	}
}





