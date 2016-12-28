
 function getRelatedSelectbox(relval) {
        if(relval == 1){
            $("#monthlySearch").show();
            $("#actionSearch").hide();
            $("#bynameSearch").hide();
        }else if(relval == 2){
            $("#actionSearch").show();
            $("#monthlySearch").hide();
            $("#bynameSearch").hide();
        }else {
            $("#actionSearch").hide();
            $("#monthlySearch").hide();
            $("#bynameSearch").show();
        }
    }




    function getmyleaveId(myodId,status,code){

        $.ajax({
            type: "POST",
            url: "content/view_mylevRequestPopup.php",
            data: {id: myodId, status:status, code:code},
            success: function (result) {
                 $('#myleave').html(result);
            }
        });
    }

    function submitCancelRequest(lvid,createdBy,status,lvkey){
        var type="subCancelStatus";
        var remark=$("#lvRemarks").val();
        if(remark == ""){
            $("#lvRemarks").css('border-color','red');
            toasterrormsg("Please Mentioned Remarks");
            return false;
        }
        else{
            $("#lvRemarks").css('border-color','');

            $.ajax({
                type: "POST",
                url: "ajax/leaveRequest_ajax.php",
                data: {lvid: lvid, type:type, status:status, lvkey:lvkey, user:createdBy, remark:remark},
                success: function (result) {
                     if(result == 1){
                        location.reload();
                     }else{
                        toasterrormsg("Data is not available");
                     }
                 }
            });
        }
    }

    function searchByStatus(statusid,code){
        var type="searchMyStatus";
        
        $.ajax({
            type:"POST",
            url:"ajax/leaveRequest_ajax.php",
            data:{type:type, statusid:statusid, code:code},
            success: function(result){
                if(result){
                    //location.reload();
                    $("#searchMyData").html(result);
                }else{
                     $("#searchMyData").html("No Data Available");
                }
            }
        });

    }

    function getInputValue(inputval){
        $("#inputvalue").val(inputval);
    }

    function serchByCodeName(buttonVal,code){
        var type="searchMyName";
        //alert(buttonVal);
        $.ajax({
            type:"POST",
            url:"ajax/leaveRequest_ajax.php",
            data:{type:type, codename:buttonVal, code:code},
            success: function(result){
                if(result){
                    //location.reload();
                    $("#searchMyData").html(result);
                }else{
                     $("#searchMyData").html("no data Available");
                }
            }
        });
    }

    function searchByDate(code){
        
        var type="searchMyDate";
        var fromDate=$("#fromDate").val();
        var toDate=$("#toDate").val();
        // alert(fromDate);
         //alert(toDate);
        $.ajax({
            type:"POST",
            url:"ajax/leaveRequest_ajax.php",
            data:{type:type, fromDate:fromDate, toDate:toDate, code:code},
            success: function(result){
                if(result){
                    //location.reload();
                    $("#searchMyData").html(result);
                }else{
                     $("#searchMyData").html("no data Available");
                }
            }
        });
    }

 
/* cancel leave request (sachin)   */

 function submitCancelleaveRequest(lvkey){
       //alert("sac"+lvkey);
        var type="subCancelleaveStatus";
        var remark=$("#actRemarks").val();
     // alert(lvkey+"first");
        if(remark == ""){
            $("#lvRemarks").css('border-color','red');
            toasterrormsg("Please Mentioned Remarks");
            return false;
        }
        else{
            $("#lvRemarks").css('border-color','');

            $.ajax({
                type: "POST",
                url: "ajax/leaveCancelRequest_ajax.php",
                data: {lvkey: lvkey, remark:remark},
                dataType: "json",
                success: function (result) {
                   // alert(result);
                     if(result == 1){

                        //init();
                        location.reload();
                     }else{
                        toasterrormsg("Some thing wrong");
                     }
                 }
            });
        }
    }

    /* Re Apply leave request (sachin)   */

 function reapplyleaveRequest(lvkey){
       
            $.ajax({
                type: "POST",
                url: "ajax/leaveReApplyRequest_ajax.php",
                data: {lvkey: lvkey},
                dataType: "json",
                success: function (result) {
                    //alert(result);
                     if(result == 1){
                       // alert(result);
                        //init();
                        location.reload();
                     }else{
                        toasterrormsg("Some thing wrong");
                     }
                 }
            });
       
    }

