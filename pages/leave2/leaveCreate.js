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

    function getAppliedDays(){
       var forDate= $("#fromDate").val();
        $("#toDate").val(forDate); 
        $("#toDate").attr("disabled",false);
        $("#2fh").attr("checked",false);
        $("#fullDay").attr("checked",true);

        $("#showforD").show();
        $("#noOfDays").html("1");
        makehalf();
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

    function openDropDown(dropdownId){

      $("#s2id_"+dropdownId).css('display','block');
      $("#approvalReq"+dropdownId).val("2");
      alert("#approvalReq"+dropdownId);
     
    }

    function closeDropDown(dropdownId){
       $("#s2id_"+dropdownId).css('display','none');
          $("#approvalReq"+dropdownId).val("1");
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

        /*--------for Leave Application-------*/
        if($("#approvalReqsendTo").val() == "1"){
          if(LvAppli == ""){
           $("#empEmail").css('border-color', 'red');
          toasterrormsg("Email can not be blank");
          return false;
          }else{
          $("#empEmail").css('border-color', '');
          $("#approvalReqsendTo").val('0');
          }
        }else if($("#approvalReqsendTo").val() == "2"){
          if(LvAppli == ""){
           $(".select2me").addClass('errorRed');
           toasterrormsg("Select Employee Name From Drop Down");
            return false;
          }
          else{
          $(".select2me").removeClass('errorRed');
          $("#approvalReqsendTo").val('0');
          }
        }

        /*--------for OD Application-------*/

        if($("#approvalReqoDDropDown").val() == "1"){
          if(outOnD == ""){
           $("#empEmail").addClass('errorRed');
           toasterrormsg("Email can not be blank");
            return false;
          }
          else{
          $("#empEmail").removeClass('errorRed');
          $("#approvalReqoDDropDown").val('0');
          }
        }else if($("#approvalReqoDDropDown").val() == "2"){
          if(outOnD == ""){
           $(".select2me").addClass('errorRed');
           toasterrormsg("Select Employee Name From Drop Down");
            return false;
          }
          else{
          $(".select2me").removeClass('errorRed');
          $("#approvalReqoDDropDown").val('0');
          }
        }
        /*--------for Past Attendance-------*/

        if($("#approvalReqpastDropDown").val() == "1"){
          if(PastAtten == ""){
           $("#empEmail").addClass('errorRed');
           toasterrormsg("Please Enter Email Id");
            return false;
          }
          else{
          $("#empEmail").removeClass('errorRed');
          $("#approvalReqpastDropDown").val('0');
          }
        }else if($("#approvalReqpastDropDown").val() == "2"){
          if(PastAtten == ""){
           $(".select2me").addClass('errorRed');
           toasterrormsg("Select Employee Name From Drop Down");
            return false;
          }
          else{
          $(".select2me").removeClass('errorRed');
          $("#approvalReqpastDropDown").val('0');
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
//alert(l[2]);
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
            alert('success');
            var fromDate = $("#fromDate").val();

          $.ajax({
              type: "POST",
              url: "ajax/Rosterlist_ajax.php?type=data3",
              data: fromDate,
              cache:false,
              success: function (result) {
                  alert(result);
                  //location.reload();
                $("#levellist").val(result);
                  getDL();

              }
          });
       }
   else{
           alert('error');
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
                //alert(result);
                //location.reload();
                $("#showlevel").html(result);
                emp_code=result;

            }
        });
   }

    function validateleave(){
     
        var cl=$("#CL").html();
        var Earned=$("#EL").html(); 
        var applDays= $("#noOfDays").html();
        var forDate=$("#fromDate").val();
        var ltype = $("#leaveType").val();
         // alert(ltype);
        if(ltype != '')
        {

          if(ltype == 1 && Earned <= 0.0)
          {
            $("#leaveErr").html("Dont have Enough Balance for This Leave");
            $("#leaveSubmit").css('display','none');
            $("#usenextleave").show();
            $("#uploadMultiple").hide();
          }
          else if(ltype == 1 && Earned > 0.0)
          {
            //alert(minEL);
            //alert(maxEL);
            //alert(applDays);
            if(applDays<minEL)
            {
              $("#leaveErr").html("No. of Applied days should be greater than or equal to 3");
              $("#leaveSubmit").css('display','none');
              $("#uploadMultiple").hide();

            }
            else if(applDays>maxEL)
            {
              $("#leaveErr").html("Not able to apply more than 21 days");
              $("#leaveSubmit").css('display','none');
              $("#uploadMultiple").hide();
            }
            else if(applDays>=minEL || applDays<=maxEL){
              $("#leaveErr").html("");
               $("#leaveSubmit").show();
            }
          }
        }
      }

    function getLeaveBalance(lvtype,ecode){
        var cl=$("#CL").html();
        var Earned=$("#EL").html(); 
        var applDays= $("#noOfDays").html();
        var forDate=$("#fromDate").val();

        var diff = Earned-applDays;
        alert(diff);
        if(lvtype == 1 && Earned <= 0.0){
            $("#leaveErr").html("Dont have Enough Balance for This Leave");
            $("#leaveSubmit").css('display','none');
            $("#usenextleave").show();
            $("#uploadMultiple").hide();

            
        }else if(lvtype == 1 && Earned > 0.0){
          if(applDays<3){
            $("#leaveErr").html("No. of Applied days should be greater than or equal to 3");
            $("#leaveSubmit").css('display','none');
            $("#uploadMultiple").hide();

          }else if(applDays>21){
            $("#leaveErr").html("Not able to apply more than 21 days");
            $("#leaveSubmit").css('display','none');
            $("#uploadMultiple").hide();

          }else{

          }

        }


        else if(lvtype == 2 && (cl <= 0.0 || applDays > 2)){
            $("#leaveErr").html("Dont have Enough Balance or can not take more than 2 leave");
            $("#leaveSubmit").css('display','none');
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
                   $("#leaveSubmit").show();
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
                    $("#leaveSubmit").hide();
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
			  $("#leaveSubmit").show();
                $("#usenextleave").hide();
            }
        }
        else{
            $("#leaveSubmit").show();
            $("#leaveErr").html("");
            $("#usenextleave").hide();

        }


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
        {   alert(data);
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
   }

   $("#DeviationLeave").click(function(){
       if ($(this).is(':checked')){
           $(this).val('1');
          // alert($(this).val());

       }
       else{
           //alert('Not Checked');
           $(this).val('0');
          // alert($(this).val());
       }
   });

   function getDLLevel() {
       var DL = $("#DeviationLeave").val();
       if (DL == '1')  {
           alert('success');
           $.ajax({
               type: "POST",
               url: "ajax/Rosterlist_ajax.php?type=checkbox",
               data: {deviation:DL},
               cache: false,
               success: function (result) {
                   //alert(result);
                   //location.reload();
                   $("#levellist").val(result);
                   getDL();

               }
           });
       }
   else{
           alert('error');
       }}
   function getDL(){
       var emp_code=$("#empcode").val();
       var level_list = $("#levellist").val();
       var l = level_list.split(';');

       $.ajax({
       type: "POST",
       url: "ajax/Rosterlist_ajax.php?type=dataDL",
       data: {dataval:l[2], emp_code:emp_code},
       cache:false,
       success: function (result) {
           // alert(result);
           //location.reload();
           $("#showlevel").html(result);
          // emp_code=result;

       }
   });
   }


   

