    function getRelatedSelectbox(relval) {
        if(relval == 1){
            $("#monthlySearch").show();
            $("#actionSearch").hide();
            $("#bynameSearch").hide();
            $("#byRequesterSearch").hide();
        }else if(relval == 2){
            $("#actionSearch").show();
            $("#monthlySearch").hide();
            $("#bynameSearch").hide();
            $("#byRequesterSearch").hide();
        }else if(relval == 3) {
            $("#actionSearch").hide();
            $("#monthlySearch").hide();
            $("#bynameSearch").hide();
            $("#byRequesterSearch").show();
        }else{
            $("#actionSearch").hide();
            $("#monthlySearch").hide();
            $("#byRequesterSearch").hide();
            $("#bynameSearch").show();
        }
    }

    function allCheck(checkid,code) {
    if($("#"+checkid).is(":checked")){
        allkey(checkid,code);
        var status = "1";
        var type = "allcheck";

        $.ajax({
                type: "POST",
                url: "ajax/approveLeaveReq_ajax.php",
                data: {userCode :  code, type: type, status:status },
                success: function (result) {
                   // alert(result);
                   if(result){
                   
                    var str=result;
                    //str = str.slice(0, -1);
                       $("#selectedcheckbox").val(str);
                      // alert($("#selectedcheckbox").val());

                   }else {
                       toasterrormsg("Can not perform any action on Approved and Rejected .");
                   }

                }
        });
    }
        
     else if($("#"+checkid).is(":not(:checked)")){
        $("#selectedcheckbox").val("0");
        
     }
    }

    function allkey(checkid,code){
        var type = "allkey";
        var status = "1";

        $.ajax({
                type: "POST",
                url: "ajax/approveLeaveReq_ajax.php",
                data: {userCode :  code, type: type, status:status },
                success: function (result) {
                   if(result){
                    var str=result;
                    //str = str.slice(0, -1);
                    //str = rtrim($string, ",")
                       $("#key").val(str);
                      // alert($("#key").val());
                      
                   }else {
                       toasterrormsg("Error in Getting Key");
                   }

                }
        });
    }

    function mulCheck(mulcheckid,keyid) {
        var vals = [];
    
        if($("#"+mulcheckid).is(":checked")){

          $('.checkboxes:checked').each(function(){
              vals.push($(this).val());
            });
           
            $("#selectedcheckbox").val(vals);

               var levid=$("#selectedcheckbox").val();
			 //  alert(levid);
               var type="keyValue";
              $.ajax({
                    type: "POST",
                    url: "ajax/approveLeaveReq_ajax.php",
                    data: {type: type, levid:levid},
                    success: function (result) {
                        if(result){

                            var str=result;
                             //str = str.slice(0, -1);
                            // alert(str);
                                $("#key").val(str);
                        }else {
                            toasterrormsg("Failed in Getting Key");
                        }

                    }
              });
            

        }
        else if($("#"+mulcheckid).is(":not(:checked)")){
            $("#Allcheck").val("0");
            $("#uniform-Allcheck  > span").removeClass ( 'checked' );

            $('.checkboxes:checked').each(function(i) {
                vals.push($(this).val());
                
            });



            $("#selectedcheckbox").val(vals);
            
               var levid=$("#selectedcheckbox").val();
               var type="keyValue";
            $.ajax({
                    type: "POST",
                    url: "ajax/approveLeaveReq_ajax.php",
                    data: {type: type, levid:levid},
                    success: function (result) {
                        if(result){
                           var str=result;
                             str = str.slice(0, -1);
                                $("#key").val(str);
                        }else {
                            toasterrormsg("Failed in Getting Key");
                        }

                    }
              });

        }
    }

    function showSubmitButton(btnVal,len) {
         if($("#selectedcheckbox").val() == 0){
             toasterrormsg("Select rows");
            return false;
         }else{
            $("#submitButtonDiv").show();
                $("#submitButton").val(btnVal);
         }
                
    }

    
    function applyAction(code,status) {

            var inputval=$("#selectedcheckbox").val();
            //alert(inputval);
            var key = $("#key").val();
            //var type="mulcheck"
            //alert(key);
            $.ajax({
                type: "POST",
                url: "ajax/approveLeaveReq_ajax.php",
                data: {userCode :  code, type: type, status:status, inputval:inputval,key:key},
                success: function (result) {
                    if(result == 1){
                        location.reload();
                          // alert("done");
                    }else {
                        toasterrormsg("Failed in Updation");
                    }

                }
            });
    }

    // function getmyodId(myodId,status,code){

    //     $.ajax({
    //         type: "POST",
    //         url: "content/view_approveLevRequest.php",
    //         data: {id: myodId, status:status, code:code},
    //         success: function (result) {
    //              $('#approveodrequest').html(result);
    //         }
    //     });
    // }
    
 function searchByStatus(statusid,code){
        var type="searchStatus";
        
        $.ajax({
            type:"POST",
            url:"ajax/approveLeaveReq_ajax.php",
            data:{type:type, statusid:statusid, code:code},
            success: function(result){
                if(result){
                    //location.reload();
                    $("#searchData").html(result);
                }else{
                     $("#searchData").html("<span class='nda'>No Data Available</span>");
                }
            }
        });

    }

    function getInputValue(inputval){
        $("#inputvalue").val(inputval);
    }

    function serchByCodeName(buttonVal,code){
        var type="searchApproverName";
        $.ajax({
            type:"POST",
            url:"ajax/approveLeaveReq_ajax.php",
            data:{type:type, codename:buttonVal, code:code},
            success: function(result){
                if(result){
                    //location.reload();
                    $("#searchData").html(result);
                }else{
                     $("#searchData").html("<span class='nda'>no data Available</span>");
                }
            }
        });
    }

    function getInputRequestValue(inputdata){
        $("#inputrequest").val(inputdata);
    }


    function serchByRequestName(buttonVal,code){
        var type="searchRequesterName";
        $.ajax({
            type:"POST",
            url:"ajax/approveLeaveReq_ajax.php",
            data:{type:type, codename:buttonVal, code:code},
            success: function(result){
                if(result){
                    //location.reload();
                    $("#searchData").html(result);
                }else{
                     $("#searchData").html("<span class='nda'>no data Available</span>");
                }
            }
        });
    }
    

    function searchByDate(code){
        
        var type="searchDate";
        var fromDate=$("#fromDate").val();
        var toDate=$("#toDate").val();
        // alert(fromDate);
         //alert(toDate);
        $.ajax({
            type:"POST",
            url:"ajax/approveLeaveReq_ajax.php",
            data:{type:type, fromDate:fromDate, toDate:toDate, code:code},
            success: function(result){
                if(result){
                    //location.reload();
                    $("#searchData").html(result);
                }else{
                     $("#searchData").html("<span class='nda'>no data Available</span>");
                }
            }
        });
    }

    function getapprleaveId(levId,staId,code){
       // alert("sss");
         $.ajax({
            type: "POST",
            url: "content/view_approveLevRequest.php",
            data: {id: levId, status:staId, code:code},
            success: function (result) {
                 $('#approveLevrequest').html(result);
            }
        });
    }
      /* Approve and reject by approver leave request (sachin)   */

 function submitApprovelRequest(id,status_flag,del){
   // alert(del);
    if(del==1)
    {
        var id=document.getElementById(id).value;
        //alert("sac"+id+status_flag);   
    }
    else
    {
       // alert("else");
         var id=document.getElementById(id).value;
        // alert(id);
         var status_flag=document.getElementById(status_flag).value;
       // alert("sac"+id+status_flag);   
    }
    
    
            $.ajax({
                type: "POST",
                url: "ajax/leaveApproveRequest_ajax.php",
                data: {id: id, status_flag: status_flag},
                dataType: "json",
                 beforeSend: function(){
                loading();
            },
                success: function (result) {
                  //  alert(result);
                     if(result == 1){

                        //init();
                         unloading();
                       location.reload();
                     }else{
                        toasterrormsg("Some thing wrong");
                     }
                 }
            });
      
    }
