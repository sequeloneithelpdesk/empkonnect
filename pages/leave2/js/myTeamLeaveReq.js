
 function getRelatedSelectbox(relval) {
        if(relval == 1){
            $("#monthlySearch").show();
            $("#actionSearch").hide();
            $("#bynameSearch").hide();
            $("#ApproverSearch").hide();
        }else if(relval == 2){
            $("#actionSearch").show();
            $("#monthlySearch").hide();
            $("#bynameSearch").hide();
             $("#ApproverSearch").hide();
        }else if(relval == 3) {
            $("#actionSearch").hide();
            $("#monthlySearch").hide();
             $("#ApproverSearch").hide();
            $("#bynameSearch").show();
        }else{
             $("#ApproverSearch").show();
              $("#actionSearch").hide();
            $("#monthlySearch").hide();
            $("#bynameSearch").hide();
        }
    }




    function getmyleaveId(myodId,status,code){

        $.ajax({
            type: "POST",
            url: "content/view_myteamlevReqPopup.php",
            data: {id: myodId, status:status, code:code},
            success: function (result) {
                 $('#myteamleave').html(result);
            }
        });
    }

    function submitCancelRequest(lvid){
        var type="subCancelStatus";
        $.ajax({
            type: "POST",
            url: "ajax/teamLeaveRequest_ajax.php",
            data: {lvid: lvid, type:type},
            success: function (result) {
                 if(result == 1){
                    location.reload();
                 }else{
                    alert("no updation");
                 }
             }
        });
    }

    function searchByStatus(statusid,code){
        var type="searchMyStatus";
        
        $.ajax({
            type:"POST",
            url:"ajax/teamLeaveRequest_ajax.php",
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

     function getInputValue1(inputval){
        $("#inputvalue1").val(inputval);

    } 

    function serchByCodeName(buttonVal){
        var type="searchByRequester";
        //alert(buttonVal);
        $.ajax({
            type:"POST",
            url:"ajax/teamLeaveRequest_ajax.php",
            data:{type:type, codename:buttonVal},
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

    function serchByApprver(buttonVal){
        var type="searchByApprover";
        //alert(buttonVal);
        $.ajax({
            type:"POST",
            url:"ajax/teamLeaveRequest_ajax.php",
            data:{type:type, codename:buttonVal},
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


    function searchByDate(){
        
        var type="searchMyDate";
        var fromDate=$("#fromDate").val();
        var toDate=$("#toDate").val();
        //alert(code);
         //alert(toDate);
        $.ajax({
            type:"POST",
            url:"ajax/teamLeaveRequest_ajax.php",
            data:{type:type, fromDate:fromDate, toDate:toDate },
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