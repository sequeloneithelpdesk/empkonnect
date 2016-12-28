   // jQuery.fn.multiselect = function() {
   //      var data=[];
   //      $(this).each(function() {
   //      var checkboxes = $(this).find("input:checkbox");
   //      checkboxes.each(function() {
   //          var checkbox = $(this);
            
   //          // Highlight pre-selected checkboxes
   //          if (checkbox.prop("checked"))
   //              checkbox.parent().addClass("multiselect-on");

   //          // Highlight checkboxes that the user selects
   //          checkbox.click(function() {
   //              if (checkbox.prop("checked")){
   //                  data.push($(this).val());
   //                 // alert(data);
   //                  checkbox.parent().addClass("multiselect-on");
                    
   //                 $("#selectedcheckbox").val(data);
                  
   //              }
   //              else{
   //                  checkbox.parent().removeClass("multiselect-on");
   //                  data.pop($(this).val());
   //                   $("#selectedcheckbox").val(data);
   //              }
               
   //          });
   //      });
   //  });
   //  }; multiselect for dropdown list

    var minEL = 3;
    var maxEL = 21;
    var maxCL = 2;
    var minCL = 0.5;
    var minSL = 0.5;
    var maxSL = 2;

    function getAppliedDays(){
       var forDate= $("#fromDate").val();
        $("#toDate").val(forDate); 
        $("#toDate").attr("disabled",false);
        $("#2fh").attr("checked",false);
        $("#fullDay").attr("checked",true);

        $("#showforD").show();
        $("#noOfDays").html("1");
        makehalf();
        getMyAttendanceByDate1();
        validateleave();
    }

    function makehalf(){

        var forDate=$("#fromDate").val();
        var toDate=$("#toDate").val(); 
        var type="noDays";
        var halfValue=0;
        if ($("#radio1").prop("checked") || $("#2fh").prop("checked")) {
             halfValue=.5;
       }else {
              halfValue=0;
       }
       if($("#1th").prop("checked") || $("#2th").prop("checked")){
             halfValue= halfValue+.5;
       }else{
             halfValue=halfValue;
       }
         var forD = $("#fromDate").datepicker('getDate');
         var toD = $("#toDate").datepicker('getDate');
         var days = ((toD - forD)/1000/60/60/24) + 1;
        $.ajax({
            type:"POST",
            url:"ajax/leaveRequest_ajax.php",
            data:{type:type, days:days,halfValue:halfValue},
            success: function(result){
                 $("#noOfDays").html(result);     
            }
        });
    }

    function maketohalf(){

        var forDate=$("#fromDate").val();
        var toDate=$("#toDate").val(); 
        //var applyDays = $("#noOfDays").html(result);
        var halfValue=0;
        if ($("#radio1").prop("checked") || $("#2fh").prop("checked")) {
             halfValue=.5;
       }else {
              halfValue=0;
       }
       if($("#1th").prop("checked") || $("#2th").prop("checked")){
             halfValue= halfValue+.5;
       }else{
             halfValue=halfValue;
       }
        var type="noDays";
          var forD = $("#fromDate").datepicker('getDate');
         var toD = $("#toDate").datepicker('getDate');
         var days = ((toD - forD)/1000/60/60/24) + 1;
        $.ajax({
            type:"POST",
            url:"ajax/leaveRequest_ajax.php",
            data:{type:type, days:days,halfValue:halfValue},
            success: function(result){
                 $("#noOfDays").html(result);     
            }
        });
    }

    function makeFull(){
      var bal= $("#noOfDays").html();
      var type="maketoFull"
       $.ajax({
            type:"POST",
            url:"ajax/leaveRequest_ajax.php",
            data:{type:type, days:bal},
            success: function(result){
                 $("#noOfDays").html(result);     
            }
        });
      
    }

    function getToDate(){

       var toDate= $("#toDate").val();
       var forDate=$("#fromDate").val();
       var daya= $("#noOfDays").val();
        var halfValue=0;
        var type="noDays";
        var Startdate = moment(forDate, "DD/MM/YYYY").format('YYYY-MM-DD');
        var Enddate = moment(toDate, "DD/MM/YYYY").format('YYYY-MM-DD');

       
       if ($("#radio1").prop("checked") || $("#2fh").prop("checked")) {
             halfValue=.5;
       }else {
              halfValue=0;
       }
       if($("#1th").prop("checked") || $("#2th").prop("checked")){
             halfValue= halfValue+.5;
       }else{
             halfValue=halfValue;
       }
       //alert(halfValue);

       if(Startdate == Enddate){
            halfValue=0;
            if($("#1th").prop("checked") || $("#2th").prop("checked")){
             halfValue= halfValue+.5;
             }else{
                   halfValue=halfValue;
             }
            $("#halfshow").css('display','none');
        }else{
          halfValue=0;
          if ($("#radio1").prop("checked") || $("#2fh").prop("checked")) {
             halfValue=.5;
           }else {
                  halfValue=0;
           }
        }

      
        if(Enddate < Startdate){
            toasterrormsg("From date should be less than end date");
            $("#toDate").val("");
            $("#noOfDays").html("0");
            return false;
        }
       else{
          $("#halfshow").show();
          $("#radio1").attr("disabled",true);
          $("#2th").attr("disabled",true);

          $("#1th").attr("checked",false); 
          $("#fulltoDay").attr("checked",true); 

         var forD = $("#fromDate").datepicker('getDate');
         var toD = $("#toDate").datepicker('getDate');
         var days = ((toD - forD)/1000/60/60/24) + 1;

          $.ajax({
            type:"POST",
            url:"ajax/leaveRequest_ajax.php",
            data:{type:type, days:days,halfValue:halfValue},
            success: function(result){
                 $("#noOfDays").html(result);  
                 validateleave();
            }
        });
          
        }
    }

    function empDetails(code,inputid){

        if(inputid == "MyTeam"){
            $("#empdetail").show();
            $("#myselftable").hide();
            $("#apprMngr").show();
            $("#According_WorkFlow").hide();
            $("#leaveSubmit").val(code);


        }else{
            $("#empdetail").hide();
            $("#myselftable").show();
             $("#leaveFor").val(code);
             $("#apprMngr").hide();
             $("#According_WorkFlow").show();
             var apprcode= $("#approverId").val();
             $("#leaveSubmit").val(apprcode);
            
        }
        
    }

    function setLeaveFor(leavVal){
        $("#leaveFor").val(leavVal);
         Leave.myleave(leavVal);
    }

    /*function openDropDown(dropdownId){

      $("#s2id_"+dropdownId).css('display','block');
      $("#approvalReq").val("2");
      
     
    }*/

    function closeDropDown(dropdownId){
		//alert(dropdownId);
		if(dropdownId==1)
		{
			//alert($('input[name=type][value='+id+']').attr('checked', true));
			$("#s2id_sendTo").css('display','none');
          $("#approvalReq").val("1");
		 // alert($("#approvalReq").val());
		}
		else if(dropdownId==0)
		{
			$("#s2id_sendTo").css('display','none');
		}
		else
		{
			//alert("aaa");
      //getElementById("sendTo").style.display = null;
	  
	  $('#s2id_sendTo').css("display","block");
       
          $("#approvalReq").val("0");
		 // alert($("#approvalReq").val());
		}
       
    }
	function closeDropDown1(dropdownId){
		//alert('sss');
		if(dropdownId==1)
		{
			
			$("#s2id_oDDropDown").css('display','none');
          $("#approvalReq1").val("1");
		
		}
		else if(dropdownId==0)
		{
			$("#s2id_oDDropDown").css('display','none');
		}
		else
		{
			$("#s2id_oDDropDown").css('display','block');
			
          $("#approvalReq1").val("0");
		
		}
       
    }
	function closeDropDown2(dropdownId){
		//alert('sss');
		if(dropdownId==1)
		{
			
			$("#s2id_pastDropDown").css('display','none');
          $("#approvalReq2").val("1");
		
		}
		else if(dropdownId==0)
		{
			$("#s2id_pastDropDown").css('display','none');
		}
		else
		{
			$("#s2id_pastDropDown").css('display','block');
          $("#approvalReq2").val("0");
		
		}
       
    }

    function submitLeave(me,app){
		
        var type="insertLeave";
        var fromdate=$("#fromDate").val();
        var noOfDays= $("#noOfDays").html();
        var LvAppli= $('input[name=radio4]').val();
        var outOnD= $('input[name=radio5]').val();
        var PastAtten= $('input[name=radio6]').val();
        var leaveFor= $("#leaveFor").val();
        var forhalf= $( "input:radio[name=radio1]:checked" ).val();
        var tohalf= $( "input:radio[name=radio2]:checked" ).val();
        var DLLeave = $("#DeviationLeave").val();
        var reason= $("#reason").val();
        var approverId= $("#approverId").val();
        var requesterID= me;
        var strlevel=$("#levellist").val();
        var level1=strlevel.split(";");
        var levelarr=level1[0].split(",");
        var level=levelarr.toString();
        var leaveTypes = $("#leaveType").val();
        //var level= app;
//alert(level);


        if(forhalf == undefined){
            forhalf="null";
        }

        if(tohalf == undefined){
            tohalf="null";
        }

        if(fromdate == ""){
            $("#fromDate").css('border-color', 'red');
             toasterrormsg("For Date cann't be blank ");
            return false;
        }else{
            $("#fromDate").css('border-color', '');
        }

        if ($("#leaveType").val() == "") {

            $("#leaveType").css('border-color', 'red');
             toasterrormsg("leave Type cann't be blank ");
            return false;
        }else{
            $("#leaveType").css('border-color', '');
        }

        if ($('#reason').val() == "") {

            $('#reason').css('border-color', 'red');
             toasterrormsg("reason cann't be blank ");
            return false;
        }else{
            $('#reason').css('border-color', '');
        }

      
		 if ($("#approvalReq").val()==1 || $("#approvalReq1").val()==1 || $("#approvalReq2").val()==1){
			 //alert("aaa");
        var email = document.getElementById('empEmail');
		var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if (!filter.test(email.value)) {
			$("#empEmail").addClass('errorRed');
		toasterrormsg("Please Enter Valid Email ID");
		
		return false;
		}
		else{
           $("#empEmail").removeClass('errorRed');
        }
		 }

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
        if(leaveTypes == 3){
        //  alert(upload_value);
          if(noOfDays >=2  || upload_value.length < 0){
                $("#leaveErr").html("Please provide attachments.");
                $("#uploadMultiple").show();
                $("#leaveSubmit").hide();
                $("#usenextleave").hide();
                return false;              
          }
          else{
                $("#leaveErr").html("");
                $("#uploadMultiple").show();
                 $("#leaveSubmit").prop('disabled', false);
                $("#usenextleave").hide();
          }
        }
        if(flag == 0){
			       //alert("flag");
            var form =  $("#leaveForm")[0];
            var formData1 = new FormData(form);
            //var fromData= formData1 +'&type='+ type + '&noOfDays=' + noOfDays +
              //  '&LvAppli=' + LvAppli + '&level=' + level + '&forhalf=' + forhalf + '&tohalf=' + tohalf +'&ufile=' + uploadValue ;
           
            formData1.append('type',type);
            formData1.append('noOfDays',noOfDays);
            formData1.append('LvAppli',LvAppli);
            formData1.append('level',level);
            formData1.append('forhalf',forhalf);
            formData1.append('tohalf',tohalf);
            formData1.append('reason',reason);
            formData1.append('ufile',uploadValue);
            formData1.append('approverId',approverId);
            formData1.append('requesterID',requesterID);

           
            $.ajax({
                type:"POST",
                url:"ajax/leaveRequest_ajax.php",
                data:formData1,
                cache: false,
                contentType: false,
                processData: false,
                success: function(result){
                    if(result == 1){
                        toastmsg("Inserted Successfully");
                    }else if(result == 2){
                        toasterrormsg("Already Leave Applied Of This date");
                    }else if(result == 5){
                       toasterrormsg("Email Sending Issue");
                    }else if(result == 0){
                        toasterrormsg("Failed in Insertion");
                    }
                }
            });

        }else{
          //alert("flag");
            var form =  $("#leaveForm")[0];
            var formData1 = new FormData(form);
            //var fromData= formData1 +'&type='+ type + '&noOfDays=' + noOfDays +
              //  '&LvAppli=' + LvAppli + '&level=' + level + '&forhalf=' + forhalf + '&tohalf=' + tohalf +'&ufile=' + uploadValue ;
           
            formData1.append('type',type);
            formData1.append('noOfDays',noOfDays);
            formData1.append('LvAppli',LvAppli);
            formData1.append('level',level);
            formData1.append('forhalf',forhalf);
            formData1.append('tohalf',tohalf);
            formData1.append('reason',reason);
            formData1.append('ufile',uploadValue);
             formData1.append('approverId',approverId);
             formData1.append('requesterID',requesterID);
           // alert(formData1);
           // console.log(formData1);
            $.ajax({
                type:"POST",
                url:"ajax/leaveRequest_ajax.php",
                data:formData1,
                cache: false,
                contentType: false,
                processData: false,
                success: function(result){
                    if(result == 1){
                        toastmsg("Inserted Successfully");
                        location.reload();
                    }else if(result == 2){
                        toasterrormsg("Already Leave Applied Of This date");
                    }else if(result == 5){
                       toasterrormsg("Email Sending Issue");
                    }else{
                        toasterrormsg("Failed in Insertion");
                    }
                }
            });
        }


    }

function gettable_val(){
        var fromDate = $("#fromDate").val();

        $.ajax({
            type: "POST",
            url: "ajax/Rosterlist_ajax.php?type=data1",
            data: fromDate,
            cache:false,
            success: function (result) {
                //alert(result);
                //location.reload();
              $("#levellist").val(result);
                levelfunc();

            }
        });
    }


    function levelfunc(){

        var level_list = $("#levellist").val();
        var l = level_list.split(';');
        var emp_code=$("#empcode").val();

        $.ajax({
            type: "POST",
            url: "ajax/Rosterlist_ajax.php?type=data2",
            data: {dataval:l[2], emp_code:emp_code},
            cache:false,
            success: function (result) {
                //alert(result);
                //location.reload();
                $("#showlevel").html(result);
                emp_code=result;
                
            }
        });
    }

      function getDLLevel() {
       var DL = $("#DeviationLeave").val();
       if (DL == '1')  {
          //  alert('a');
            var fromDate = $("#fromDate").val();

          $.ajax({
              type: "POST",
              url: "ajax/Rosterlist_ajax.php?type=data3",
              data: fromDate,
              cache:false,
              success: function (result) {
                 // alert(result);
                  //location.reload();
                $("#levellist").val(result);
                  getDL();

              }
          });
       }
   else{
    //alert("b");
           gettable_val();
       }}
   function getDL(){
         var level_list = $("#levellist").val();
        var l = level_list.split(';');
        var emp_code=$("#empcode").val();
//alert(l[2]);
        $.ajax({
            type: "POST",
            url: "ajax/Rosterlist_ajax.php?type=data4",
            data: {dataval:l[2], emp_code:emp_code},
            cache:false,
            success: function (result) {
              // alert(result);
                //location.reload();
                $("#showlevel").html(result);
                emp_code=result;
                check_approver_ids();

            }
        });
   }

    function validateleave(){
     


      $('select#leaveType option').removeAttr("selected");
      $("#leaveType").css('border-color', 'red');
      $("#leaveType").focus();
      $('#leaveErr').html("");
       $("#leaveSubmit").prop('disabled', true);
              $("#usenextleave").hide();
              $("#uploadMultiple").hide();
      /*  var cl=$("#CL").html();
        var Earned=$("#EL").html(); 
        var applDays= $("#noOfDays").html();
        var forDate=$("#fromDate").val();
        var ltype = $("#leaveType").val();
        
        
       
        var diff = Earned-applDays;
        alert("ltype="+ltype+"Earned="+Earned+"apppl="+applDays+"diff="+diff+"maxEL="+maxEL+"minEL="+minEL);
        if(ltype != '')
        {

          if((diff<0.0 && applDays<=maxEL && ltype == 1) || (ltype == 1 && Earned <= minEL))
          {
            $("#leaveErr").html("Dont have Enough Balance for This Leave");
            if(diff <-15)
            {
            //  alert("true");
            $("#leaveSubmit").prop('disabled', true);
             $("#usenextleave").hide();
             //$("#DeviationLeave").hide();
          }
          else
          {
            //alert("false");
           // $("#leaveSubmit").prop('disabled', false);
             $("#usenextleave").show();
            $("#uploadMultiple").hide();
          }
           // $("#usenextleave").show();
            //$("#uploadMultiple").hide();
          }
          else if(ltype == 1 && Earned > minEL)
          {
            //alert(minEL);
            //alert(maxEL);
            //alert(applDays);
            if(applDays<minEL)
            {
              $("#leaveErr").html("No. of Applied days should be greater than or equal to 3");
              $("#leaveSubmit").prop('disabled', true);
               $("#usenextleave").hide();
              $("#uploadMultiple").hide();

            }
            else if(applDays>maxEL)
            {
              $("#leaveErr").html("Not able to apply more than 21 days");
              $("#leaveSubmit").prop('disabled', true);
               $("#usenextleave").hide();
              $("#uploadMultiple").hide();
            }
            else if(applDays>=minEL || applDays<=maxEL){
              $("#leaveErr").html("");
                $("#leaveSubmit").prop('disabled', false);
                $("#usenextleave").hide();
            }
          }
          else if(ltype == 2){
            if(cl <= 0.0 || applDays > 2){
              if(cl <= 0.0){
                $("#leaveErr").html("Dont have Enough Balance");
                $("#leaveSubmit").prop('disabled', true);
                $("#usenextleave").hide();
                $("#uploadMultiple").hide();

              }else if(applDays > 2){
                $("#leaveErr").html("Can not take more than 2 leave");
                $("#leaveSubmit").prop('disabled', true);
                $("#usenextleave").hide();
                $("#uploadMultiple").hide();

              }
            }
            else{
              $("#leaveErr").html("");
               $("#leaveSubmit").prop('disabled', false);
            }
          }
          else if(ltype == 3){

            
                $("#uploadMultiple").show();
                 $("#leaveSubmit").prop('disabled', false);
                $("#usenextleave").hide();
              
          }
        }*/
      }

    function getLeaveBalance(lvtype,ecode){
        var cl=$("#CL").html();
        var Earned=$("#EL").html(); 
        var applDays= $("#noOfDays").html();
        var forDate=$("#fromDate").val();
        var elused = $("#el_used").val();
       // alert(Earned);
       // alert(applDays);
        var diff = Earned-applDays;
        //alert(diff);
        if(lvtype == 1)
        {
         //alert("a");
          if(elused == '2' || diff< -15)
          {
              $("#leaveErr").html("You are not eligible to use Earned Leave ");
            $("#leaveSubmit").prop('disabled', true);
              $("#usenextleave").hide();
              $("#uploadMultiple").hide();
          }
          else if(elused == '0' || elused=='1')
          {
          // alert(Earned);
          
             //alert("b"+applDays);
              if(applDays <3){
               // alert("q");
                $("#leaveErr").html("No. of Applied days should be greater than or equal to 3");
               $("#leaveSubmit").prop('disabled', true);
                $("#usenextleave").hide();
                $("#uploadMultiple").hide();

              }else if(applDays>21){
                $("#leaveErr").html("Not able to apply more than 21 days");
             $("#leaveSubmit").prop('disabled', true);
                $("#uploadMultiple").hide();
                $("#usenextleave").hide();

              }
           
            else if((diff<0.0 && applDays<21) || (lvtype == 1 && Earned <= 0.0))
            {
              //alert("c");
                $("#leaveErr").html("Don't have Enough Balance for This Leave");
                $("#leaveSubmit").prop('disabled', true);
                $("#usenextleave").show();
                $("#uploadMultiple").hide();
            }
			else{
				//alert("qq");
				 $("#leaveSubmit").prop('disabled', false);
				 $("#leaveErr").html("");
			}
          
           }
        }
        else if(lvtype == 2 && (cl <= 0.0 || applDays > 2)){
            $("#leaveErr").html("Dont have Enough Balance or can not take more than 2 leave");
           $("#leaveSubmit").prop('disabled', true);
            $("#usenextleave").hide();
            $("#uploadMultiple").hide();

        }else if(lvtype == 5 || lvtype == 6){
            $("#usenextleave").hide();
            $("#uploadMultiple").hide();
          var type="birth_Anniv";
            $.ajax({
              type: "POST",
              url: "ajax/leaveRequest_ajax.php",
              data: {type:type , leaveType:lvtype, ecode:ecode, date:forDate},
              cache:false,
              success: function (result) {
                 if(result == 0){
                    $("#leaveErr").html("This is not Valid Date");
                    $("#leaveSubmit").hide();
                 }if(result == 1) {
                  $("#leaveSubmit").prop('disabled', false);
                    $("#leaveErr").html("");
                 }

              }
            });
        }else if(lvtype == 7){
            $("#usenextleave").hide();
            $("#uploadMultiple").hide();
          var type="maternity";
            $.ajax({
              type: "POST",
              url: "ajax/leaveRequest_ajax.php",
              data: {type:type , leaveType:lvtype, ecode:ecode },
              cache:false,
              success: function (result) {
                 if(result == 0){
                    $("#leaveErr").html("This is not allowed For Male");
                   $("#leaveSubmit").prop('disabled', false);
                 }if(result == 1) {
                   $("#leaveSubmit").show();
                    $("#leaveErr").html("");
                 }

              }
            });
        }else if(lvtype == 3){
            $("#leaveErr").hide();
            $("#usenextleave").hide();
      $("#leaveSubmit").show();
            if(applDays > 2){
              $("#uploadMultiple").show();
       $("#leaveSubmit").prop('disabled', flase);
                $("#usenextleave").hide();
            }
        }
        else{
            $("#leaveSubmit").prop('disabled', false);
            $("#leaveErr").html("");
            $("#usenextleave").hide();

        }



gettable_val();

    }

function uploadMultipleFile(id){
    $.ajax({
        url: "../Leave/ajax/uploadMultipleFile.php?empCode="+id, // Url to which the request is send
        type: "POST",             // Type of request to be send, called as method
        data: {}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false,       // The content type used when sending data to the server.
        cache: false,             // To unable request pages to be cached
        processData:false,        // To send DOMDocument or non processed data file it is set to false
        success: function(data)   // A function to be called if request succeeds
        {  // alert(data);
            //$('#loading').hide();
            $("#message").html(data);
            

        }
    });
}

   counter = 2;


   function addMoreFile(){

       // $("#uploadfile").add();
       var name = $("#uploadfile").val();
       var d = document.getElementById('uploadgroup');
       d.innerHTML += "<div id='uploadgroup"+ counter +"' class='col-md-12'><div class='col-md-6'><input type='file' id='uploadfile"+ counter++ +"' name='uploadfile[]'></div><div class='col-md-6'></div><input type='button' value='-' onclick='removeupload()'><br ><br></div>";

   }
   function removeupload() {
       //alert(counter);
       counter--;
       $("#uploadgroup"+counter).remove();

   }
   function getUploadVal(){

   }
   function logoimage_Validation()
   {

       var fuData = document.getElementById('uploadfile');
       var FileUploadPath = fuData.value;
       if (FileUploadPath == '')
       {
           $("#leaveErr").show();
           $("#leaveErr").html("Please upload attachments");
           //alert("Please upload an image");
       }
       else
       {
           var Ext = FileUploadPath.substring(FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
           if (Ext == "png" || Ext == "jpeg" || Ext == "jpg" || Ext== "doc" || Ext== "docx" || Ext== "pdf")
           {
               $("#leaveErr").hide();
           }
           else
           {

              // alert("Invalid file format ");
               fuData.value = "";
               //$("#dialog").dialog();

               $("#leaveErr").show();
               $("#leaveErr").html("Invalid File Format!");
               return false;
           }
       }
        $("#leaveSubmit").prop('disabled', false);
   }

   $("#DeviationLeave").click(function(){
       if ($(this).is(':checked')){
           $(this).val('1');
          // alert($(this).val());
            $("#leaveSubmit").prop('disabled', false);

       }
       else{
           //alert('Not Checked');
           $(this).val('0');
          // alert($(this).val());
          $("#leaveSubmit").prop('disabled', true);
       }
   });

function myAttendanceByDAte(id,from,to){
  
 var forDate=document.getElementById(from).value;

   var toDate=document.getElementById(to).value;
 

       // alert(id+forDate+toDate);

        $.ajax({
            type: "POST",
            url: "ajax/general.php",
            data: {id:id , forDate:forDate, toDate:toDate },
            cache:false,
            success: function (result) {
              if(result==0)
              {
                    $("#err_attendance").html("");
                    $("#leaveSubmit").prop('disabled',false);
              }
              else
              {
                $("#err_attendance").html(result);
               $("#leaveSubmit").prop('disabled', true);
              }

             
                
            }
        });
    }
    function getMyAttendanceByDate1()
    {
      var forDate=$("#fromDate").val();
      var id=$("#empcode").val();
      var toDate="";
     // alert("cc");
      $.ajax({
            type: "POST",
            url: "ajax/general.php",
            data: {id:id , forDate:forDate, toDate:toDate },
            cache:false,
            success: function (result) {
             // alert("aa"+result);
              if(result==0)
              {
                    $("#err_attendance").html("");
                    $("#leaveSubmit").prop('disabled',false);
              }
              else
              {
                $("#err_attendance").html(result);
               $("#leaveSubmit").prop('disabled', true);
              }

             
                
            }
        });
      //myAttendanceByDAte(empcode,forDate,toDate);
    }

  function check_approver_ids() 
  {
     var a=$("#approver_leave_approver").val();
     var b=$("#approver_leave_ids").val();
     alert(a+"q"+b);
     if(a != b)
     {
     // alert("true");
        $("#error_properapprover").html("You don't have enough approver. Please contact HR");
       
        $("#leaveSubmit").prop('disabled', true);
     }
     else
     {
     // alert("false");
      $("#leaveSubmit").prop('disabled', false);
       $("#error_properapprover").html("");
     }


  }
   function check_approver_ids1() 
  {
   // alert("aa");
     var a=$("#approver_leave_approver1").val();
     var b=$("#approver_leave_ids1").val();
    // alert(a+"q"+b);
     if(a != b)
     {
     // alert("true");
        $("#error_properapprover").html("You don't have enough approver. Please contact HR");
       
        $("#leaveSubmit").prop('disabled', true);
     }
     else
     {
    //  alert("false");
      $("#leaveSubmit").prop('disabled', false);
       $("#error_properapprover").html("");
     }


  }


   

