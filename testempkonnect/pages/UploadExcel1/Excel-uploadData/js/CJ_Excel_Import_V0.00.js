var CJ_Import = {

	errorLogS1 : [],
	errorLogS2 : [],
	TotalError : 0,
	heading : [],
	folderpath:"",

	getData : function(){
			$.ajax({
			cache: false,
			type:"POST",
			url:CJ_Import.folderpath+'/php/CJExcelReadV01.php',
			data:{a:CJ_Import.filepath, type:"jsonData"},
			success:function(data)
			{
				var data = JSON.parse(data);
				CJ_Import.fieldsName = data['data'];
				console.log(data);

			},
				error: function() {
				alert('Error occurs!');
		   }
		});
	
	
	},
	sendData : function() {
		$("#CJExcel_ErrorLog").html('');
		var file_data = $('#file').prop('files')[0];   
		var form_data = new FormData();                  
		form_data.append('file', file_data);
		if(!file_data){
			$("#CJExcel_ErrorLog").html('<tr style="background-color: red;color:white"><td>Please select file</td></tr>');
		}
		// adding ajax
		$.ajax({
			type: "POST",
			url: CJ_Import.folderpath+'/php/CJExcelReadV00.php',
			data: form_data,
			cache: false,
			contentType: false,
			processData: false,
			datatype: "json",
			beforeSend: function(){
				//$(".loaderDivimp").show();
				//$(".loaderDivimp").html("<img src='images/loader.gif'>");
			},
			success: function(data) {
				//$(".loaderDivimp").hide();
				
				var getData = JSON.parse(data);
				console.log(getData);
				if(getData['error'] == 1){
					$("#CJExcel_ErrorLog").html('<tr style="background-color: red;color:white"><td>'+getData.errorMessage+'</td></tr>');
				}else{
					CJ_Import.ProcessingDataStage1(getData['data']);
				}
			}
		});
	
	},
	ProcessingDataStage1: function(getData) {
	
	

		// defining variable
		var i,p,q;
		
		CJ_Import.resettingVariables();
		
		var newData = [];
		for(var k = 0 ; k < Object.keys(getData).length; k++){
						newData[k] = [];
		}
		 
					
		for (p = 0; p < Object.keys(CJ_Import.fieldsName).length; p++) {
			for(q = 0; q < Object.keys(getData[0]).length; q++) {
				console.log(CJ_Import.fieldsName[p]);
				console.log(p);
				if(CJ_Import.fieldsName[p].value == getData[0][q]) {
				CJ_Import.heading.push(CJ_Import.fieldsName[p].value);
					newData[0].push(getData[0][q]);
					for(var k = 1 ; k < Object.keys(getData).length; k++){
						newData[k].push(getData[k][q]);
					}
					break;
				}
				if(q == Object.keys(getData[0]).length - 1) {
					if( CJ_Import.fieldsName[p].mandatory) {
						CJ_Import.fieldMissionError(CJ_Import.fieldsName[p].value)
					}
					if( CJ_Import.fieldsName[p].value == "error1234" ) {
						CJ_Import.errorLogS1.push("'error1234' Column Name is not supportable ")
					}
				}
			}
		}
		console.log(newData);
		if(!CJ_Import.errorLogStage1()) {
			CJ_Import.processingDataStage2(newData);
		} else {
			CJ_Import.showErrorStage1();
		}
		
	
	},
// show error if Mandatory field is mission
	fieldMissionError: function (value) {
		CJ_Import.errorLogS1.push("A Mandatory column name :"+value +" missing from Excel")
	},
// stage 1 error log
	errorLogStage1 : function() {
		if(CJ_Import.errorLogS1.length == 0) {

			return false;
			
		} else {

			return true;
		}
		
	},
// showing stage 1 errors 
	showErrorStage1 : function() {
		for (var i = 0; i < CJ_Import.errorLogS1.length; i++) {
		
		$("#CJExcel_ErrorLog").append('<tr style="background-color: rgb(255, 161, 161)"><td> '+CJ_Import.errorLogS1[i]+'</td></tr>');
		
		//console.log(CJ_Import.errorLogS1[i])
		}
	},
	
	resettingVariables : function () {
		// resetting error value to zero 
		CJ_Import.TotalError = 0;
		// reseting table 
		$('#CJExcel_ErrorLog').empty();
	
		// empty all array 
		CJ_Import.heading = [];
		CJ_Import.errorLogS1 = [];
	},
	
	
	processingDataStage2 : function(getData) {
		// defining variable
		var i,p,q;
		// defining double dimension array
		var NewJsonData = {};
		 for(i = 1; i < Object.keys(getData).length; i++) {
		 	NewJsonData[i-1]={};
		 	NewJsonData[i-1]["NumberOfErrors123"]=0;
			CJ_Import.errorLogS2[i-1]={};
		 }
		 
		for (p = 0; p < Object.keys(CJ_Import.fieldsName).length; p++) {
			for(q = 0; q < CJ_Import.heading.length; q++) {
				if(CJ_Import.fieldsName[p].value == getData[0][q]) {
					for(i = 1; i < Object.keys(getData).length; i++) {
						 
					
						NewJsonData[i-1][CJ_Import.fieldsName[p].value] = CJ_Import.processData(getData[i][q],CJ_Import.fieldsName[p].rangeValue,CJ_Import.fieldsName[p].dateformate);
					 
						
						
						NewJsonData[i-1]["error1234"] = CJ_Import.errorCheckStage2(NewJsonData[i-1][CJ_Import.fieldsName[p].value],i-1,CJ_Import.fieldsName[p]);
						
						
						
						if(Object.keys(NewJsonData[i-1]["error1234"][CJ_Import.fieldsName[p].value]).length) {
							NewJsonData[i-1]["NumberOfErrors123"] = NewJsonData[i-1]["NumberOfErrors123"] + 1;
						}
					}
					break;
				}
				if(q == Object.keys(getData[0]).length - 1) {
					for(i = 1; i < Object.keys(getData).length; i++) {
						NewJsonData[i-1][CJ_Import.fieldsName[p].value] = "";
					}
				}
			}					
		}
	 
		console.log("Total Number Of error:"+CJ_Import.TotalError);
		
		if(CJ_Import.TotalError == 0) {
			CJ_Import.successes(NewJsonData);
		} else {
			CJ_Import.printError(NewJsonData);
		}
	},
// default procession of a data
	processData: function(data,range,date) {
		if(data){
			data = data.replace(/(^\s*)|(\s*$)/gi,"");
			data = data.replace(/[ ]{2,}/gi," ");
			data = data.replace(/\n /,"\n");
			data = data.replace(/'/g, "\\'");
		
			
			if(range){
				for(var i = 0; i < range.length; i++){
					console.log(data);
					if(data.toLowerCase() == range[i][1].toLowerCase()){
						data = range[i][0];
					 
						break;
					}
				}
			}
			if(date){
			
				data = CJ_Import.dateValidation(data,date['get'],date['convert']);
			}
			return data;
		}else{
			return '';
		}
		
	},


// checking every data
	errorCheckStage2 : function(value,row,fieldsName) {

		var condition = fieldsName.condition;
		var fieldName = fieldsName.value;
		var mandatory = fieldsName.mandatory;
		var minRange = fieldsName.minRange;
		var maxRange = fieldsName.maxRange;
		var rangeValue = fieldsName.rangeValue;
 
		
		
		CJ_Import.errorLogS2[row][fieldName] = [];

// checking empty value error
		if(!value && mandatory) {
			CJ_Import.errorLogS2[row][fieldName].push("Empty Value");
			CJ_Import.errorCount(1);
			return CJ_Import.errorLogS2[row];
		} else if(value){
		
			for(var i = 0; i < condition.length; i++) {
				switch(condition[i]) {
					case "OnlyCharacter" :
						CJ_Import.chartersOnlyValidation(value,row,fieldName);
						break;
					
					case "EmailValidation" :
						CJ_Import.emailValidation(value,row,fieldName);
						break;
					
					case "OnlyNumber" :
						CJ_Import.numberOnlyValidation(value,row,fieldName);
						break;
					
				}
			}
			
// checking range 			
			if(minRange && value.length < minRange) {
				
					if(maxRange) {
						CJ_Import.errorLogS2[row][fieldName].push("Minimum value Must be " + minRange);
					} else {
						CJ_Import.errorLogS2[row][fieldName].push("You must enter " + minRange + " value");
					}
					CJ_Import.errorCount(1);
				
			}
			
			if(maxRange && value.length > maxRange) {
				
					CJ_Import.errorLogS2[row][fieldName].push("Value length can not exceed " + maxRange);
					CJ_Import.errorCount(1);
				
			}
			
	// calculating range value 
	var s;
	var opVal = '';
		
			if(rangeValue) {
				for(s = 0; s < rangeValue.length ; s++) {
					
						if(s > 0){
							opVal +=" , ";
						}
						if( String(rangeValue[s][0]).match("-?\\d+(.\\d+)?") && rangeValue[s][0] == value)
						{
							break;
						}
					//	console.log(rangeValue[s][0]); // upload karo server mai 
						if( String(rangeValue[s][0]).toLowerCase() == String(value).toLowerCase())
							{
								 
								break;
							}
							opVal += " "+rangeValue[s][1]+"  ";
					
				}
				if(s == rangeValue.length) {
					CJ_Import.errorLogS2[row][fieldName].push("Value Should be : " + opVal);
					CJ_Import.errorCount(1);
				}
			}
			 
			
			return CJ_Import.errorLogS2[row];
		} else {
			return CJ_Import.errorLogS2[row];
		}
	},
	
// adding empty value validation	
	EmptyValueValidation : function (value) {
		
	},

// Adding date validation into the system 
	dateValidation : function (t_sdate,formate,saveformate) {
		var date,month,year;
		if(formate == 'dd/mm/yyyy'){
			var sptdate = String(t_sdate).split("/");
			date = sptdate[0];
			month = sptdate[1];
			year = sptdate[2];
		}else if(formate == 'mm/dd/yyyy'){
			var sptdate = String(t_sdate).split("/");
			date = sptdate[1];
			month = sptdate[0];
			year = sptdate[2];
		}else if(formate == 'dd-mm-yyyy'){
			var sptdate = String(t_sdate).split("-");
			date = sptdate[0];
			month = sptdate[1];
			year = sptdate[2];
		
		}else if(formate == 'mm-dd-yyyy'){
			var sptdate = String(t_sdate).split("-");
			date = sptdate[1];
			month = sptdate[0];
			year = sptdate[2];
		}else if(formate == 'yyyy-mm-dd'){
			var sptdate = String(t_sdate).split("-");
			date = sptdate[2];
			month = sptdate[1];
			year = sptdate[0];
		}else if(formate == 'yyyy-dd-mm'){
			var sptdate = String(t_sdate).split("-");
			date = sptdate[1];
			month = sptdate[0];
			year = sptdate[2];
		}
		
		var nextdate = '';
		if(saveformate == 'yyyy-mm-dd'){
			nextdate = year+'-'+month+'-'+date;
		}else if(saveformate == 'yyyy-mm-dd 00:00:00'){
			nextdate = year+'-'+month+'-'+date+' 00:00:00.000';
		}else if(saveformate == 'yyyy/mm/dd'){
			nextdate = year+'/'+month+'/'+date;
		}else if(saveformate == 'dd/mm/yyyy'){
			nextdate = date+'/'+month+'/'+year;
		}else if(saveformate == 'dd-mm-yyyy'){
			nextdate = date+'-'+month+'-'+year;
		}else if(saveformate == 'mm-dd-yyyy'){
			nextdate = month+'-'+date+'-'+year;
		}else if(saveformate == 'mm/dd/yyyy'){
			nextdate = month+'/'+date+'/'+year;
		}
		return nextdate;
	},

	
// Adding Email Validation
	emailValidation: function (email,row,fieldName) {
		var validate = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
		if(validate.test(email)) {
		return true;
		} else {
			CJ_Import.errorLogS2[row][fieldName].push("Enter Valid Email ID");
			CJ_Import.errorCount(1);
			return false;
		}
	
	},
// Adding Numbers Only validation
	numberOnlyValidation: function (number,row,fieldName) {
	
		if (/^[0-9]+$/.test(number)) {
			return true;
			
			// value is ok, use it
		} else {
			CJ_Import.errorLogS2[row][fieldName].push("It must be a number");
			CJ_Import.errorCount(1);
			return false;
		}
				

	
	},
// Ten Digit Number Validation
	RangeValidation: function (number) {
	
	},
// Charters only validation 
	chartersOnlyValidation: function (Charters,row,fieldName) {
	
	var letters = /^[A-Za-z\s]+$/; 
   if(Charters.match(letters))  
	 {  
	  return true;  
	 }  
   else  
	 { 
			CJ_Import.errorLogS2[row][fieldName].push("Invalid Character's");
			CJ_Import.errorCount(1);	 
	 return false;  
	 }  
	 
	
	},
// Check Duplicate value validation in a column
	dublicateValueValidation: function (value) {
	
	},
// removing Extra Space 
	removeExtraSpace: function (value) {
	
	},
// removing Special Character 
	trimSpace: function (value) {
	
	},
// print error
	printError: function(data) {
	// Showing total number of error 
	$("#CJExcel_ErrorLog").append('<tr ><td colspan="3" >Total Number Of error :'+CJ_Import.TotalError +' </td></tr>');
	$("#CJExcel_ErrorLog").append('<tr style="background-color: #D4E2E5"><td id="CJ_lastErrorRow"> Row Number</td><td id="CJ_lastErrorRow"> Columb Name </td><td id="CJ_lastErrorRow">Error Type</td></tr>');
	
	var Hd = 0;
	var Ed =0;
	var firstvalue = 1;
	var firstvalue1 = 1;
	//data = JSON.parse(data);

	for(i in data){
		firstvalue = 1;
		if(data[i].NumberOfErrors123 > 0){
		
	
			for(var p = 0; p < Object.keys(data[i]["error1234"]).length; p++) {
				
				firstvalue1 = 1;
				if(Object.keys(data[i]["error1234"][CJ_Import.heading[p]]).length) {
					
					
					for(var q = 0; q < Object.keys(data[i]["error1234"][CJ_Import.heading[p]]).length; q++) {
						
						CJ_Import.appendTable(i,p,q,data,Hd,Ed,firstvalue,firstvalue1);
						firstvalue = 0;
						firstvalue1 = 0;
						Ed ++;
						Hd++;
					}
					
					Ed =0;
				}
			}
			Hd = 0;
		}

	}
	
	console.log(data);
	
	},
// creating tables
	appendTable : function(i,p,q,data,Hd,Ed,firstvalue,firstvalue1) {
		var i = parseInt(i);
		if(firstvalue == 0)
		{
			if(Hd == 0)
			{
				
				
				$("#CJExcel_ErrorLog").append('<tr ><td>Row: '+ (i+2) +'</td><td>'+ CJ_Import.heading[p] +'</td><td id="CJ_lastErrorRow">'+ data[i]["error1234"][CJ_Import.heading[p]][q]+'</td></tr>');
				
				
			} else if (Ed == 0) {
				if(firstvalue1 == 0) {
					$("#CJExcel_ErrorLog").append('<tr><td></td><td>'+ CJ_Import.heading[p] +'</td><td id="CJ_lastErrorRow">'+ data[i]["error1234"][CJ_Import.heading[p]][q]+'</td></tr>');
				} else {
					$("#CJExcel_ErrorLog").append('<tr><td></td><td id="CJ_lastErrorRow">'+ CJ_Import.heading[p] +'</td><td id="CJ_lastErrorRow">'+ data[i]["error1234"][CJ_Import.heading[p]][q]+'</td></tr>');
				}
				
			} else {
				$("#CJExcel_ErrorLog").append('<tr><td></td><td> </td><td id="CJ_lastErrorRow">'+ data[i]["error1234"][CJ_Import.heading[p]][q]+'</td></tr>');
			}
		} else {
			if(Hd == 0)
			{
			$("#CJExcel_ErrorLog").append('<tr ><td id="CJ_lastErrorRow">Row: '+ (i+2) +'</td><td id="CJ_lastErrorRow">'+ CJ_Import.heading[p] +'</td><td id="CJ_lastErrorRow">'+ data[i]["error1234"][CJ_Import.heading[p]][q]+'</td></tr>');
			} else if (Ed == 0) {
				$("#CJExcel_ErrorLog").append('<tr ><td id="CJ_lastErrorRow"></td><td id="CJ_lastErrorRow">'+ CJ_Import.heading[p] +'</td><td id="CJ_lastErrorRow">'+ data[i]["error1234"][CJ_Import.heading[p]][q]+'</td></tr>');
			} else {
				$("#CJExcel_ErrorLog").append('<tr ><td id="CJ_lastErrorRow"></td><td id="CJ_lastErrorRow"> </td><td id="CJ_lastErrorRow">'+ data[i]["error1234"][CJ_Import.heading[p]][q]+'</td></tr>');
			}
		}
	},
// counting error
	errorCount: function(value) {
		CJ_Import.TotalError = CJ_Import.TotalError + value;
	},

// If there is no error than successes function will run Successful Submitted
successes : function(NewJsonData) {
	$("#CJExcel_ErrorLog").append('<tr style="background-color: rgb(197, 247, 194)"><td>No error found, Please wait while we upload your data . . .</td></tr>');
 
	CJ_Import.excelDataUpload(NewJsonData);
},


excelDataUpload : function(NewJsonData) {
	
		console.log(NewJsonData);
	 
			var jObject = JSON.stringify(NewJsonData);
		$.ajax({
		
				type:"POST",
	 
				url: CJ_Import.folderpath+"/php/CJExcelReadV01.php",
				data:{a:CJ_Import.filepath,  type:"saveData", data:jObject},
				success:function(data)
				{
					console.log(data);
					data = JSON.parse(data);
					var html = '';
					if(data.error == 1){
						html = '<tr style="background-color: red"><td>'+data.errorMessage+'</td></tr>';
					}else{
						var n = 0;
						var htmltop = '<tr style="background-color: rgb(197, 247, 194)"><td>Successfully Uploaded</td></tr>';
						if(data.removedata.length > 0){
							html += '<tr style="background-color: red"><td>Error : Dublicate Value found below is the list of row that are not updated</td></tr><tr><td><table width:100%>';
							for(var i in data.removedata){
								for(var y in data.removedata[i]){
									var DC = data.removedata[i][y];
									html += '<tr style="background-color: red"><td>Row '+(parseInt(DC['row'])+1)+'</td><td> column name : '+DC['columb']+'</td><td> value : '+DC['value']+'</td></tr>'
									n++;
								}
							}
							html += '</table></td></tr>';
						}
						if(n > 0){
							html = htmltop + html;

						}else{
							html = htmltop;
						}

						var employeedata = data.employee_code ;
						var mymaildata=sendemail(employeedata);
					}

					//var mailsend='<table width="100%"><tr><td>  </td></tr></table>';

					$("#CJExcel_ErrorLog").html(html);

					setTimeout(function(){
						$("#CJExcel_ErrorLog").css('border','none');
						$("#CJExcel_ErrorLog").html(mymaildata);						
					}, 3000);


					$("#file").val('');
				}
			
			});	
		
	}

}

var emaildata ={};

function sendemail(data){

	emaildata = data;
var mailsend='<table width="100%"><tr><td> <select class="form-control" ><option value="">Employee</option>';
	for(var id in data){
		var dataI = data[id];
		mailsend+='<option value="'+id+'"> '+dataI['First Name']+' </option>';
	}
	mailsend+='</select></td><td> <button type="button" class="btn btn-block blue" onclick="WCmailsend();">Create Users</button> </td></tr></table>';
	console.log(data);
	return mailsend;
}

function WCmailsend(){
	 
	$.ajax({
		
				type:"POST",
	 
				url: CJ_Import.folderpath+"/php/CJExcelReadV01.php",
				data:{type:"sendmail", data:emaildata},
				beforeSend: function(){
                loading();
			        },
		        success: function(result){
		            unloading();
		            alert(result);
		            data = JSON.parse(result);
		            if(data.msg=="success"){
		            	alert('Success');
		            }else{
		            	alert('Error');
		            }

				}
			});

}


 

