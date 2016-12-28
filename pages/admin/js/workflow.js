/*--------------Start Work Flow Configuration--------*/
var ruleinc = 1;
var data ="";
var Roster={
    init:function(){
        //alert("h");
        $.ajax({
            type:"POST",
            url:"../admin/ajax/role_menuajax.php?type=data",
            dataType : 'json',
            cache: false,
            beforeSend: function(){
                loading();
            },
            success: function(result){
                unloading();
                //console.log(result);
                //alert(result);
                data=result;
                Roster.showdefault();
                //$('#datamenu').jstree(true).refresh();

            }
        });
    },

    showdefault: function (){
        var tblName = $("#forWhome").val();

        //console.log(data);
        $.ajax({
            type: "POST",
            url: "ajax/WorkflowR_ajax.php?type=defaultValue",
            data: {tblName:tblName,data:data },
            success: function(result){
                //alert (result);
                console.log(result);
                $("#showsuboption").html(result);
            }
        });
    },

    checkevent: function (clicked){
        var tblName = $("#forWhome").val();
        if(clicked.checked){
            xyx = clicked.value;
            //alert(clicked.value);
            $.ajax({
                type: "POST",
                url: "ajax/WorkflowR_ajax.php?type=showdata",
                data: {tblName:tblName,childval:xyx,data:data },
                dataType : 'json',
                success: function(result){
                    //alert (result);
                    data=result;
                    console.log(data);
                    //$("#showsuboption").html(result);
                }
            });
        }
        else{
            xyx = clicked.value;
            //alert(clicked.value);
            $.ajax({
                type: "POST",
                url: "ajax/WorkflowR_ajax.php?type=hidedata",
                data: {tblName:tblName,childval:xyx,data:data },
                dataType : 'json',
                success: function(result){
                    //alert (result);
                    data=result;
                    console.log(data);
                    //$("#showsuboption").html(result);
                }
            });
        }
        // alert (tblName);

    },
    addConfirm: function (){
        $.ajax({
            type: "POST",
            url: "ajax/WorkflowR_ajax.php?type=finaldata",
            data: {data:data },
            success: function(result){
                //alert (result);
                //console.log(result);
                $('#showConfirm').html(result);
                //console.log(data);
            }
        });
    },

    wfsubmit:function () {

        var formData = $("#workflowform").serialize()+$.param({ 'mydata': data }) ;
        //console.log(data);
         // alert(formData);
       
            $.ajax({
                type: 'POST',
                url: 'ajax/workflow_ajax.php?pagetype=workflow',
                data: formData,
                cache: false,

                beforeSend: function () {
                    loading();
                },
                success: function (responseText) {
                    unloading();
                    console.log(responseText);
                    //$("#"+divid).html(responseText);


                }
            });


    },


}


//Show no of selected levels
/*$("#go").click(function () {
    $(".select2me").select2();
    getmngrlist();
    levelNo = ruleinc;
    //console.log (levelNo);
    var topDiv = $("#levels");
    topDiv.empty();
    for (var i = 1; i <= levelNo; i++){
        topDiv.append("<div  id='Level"+i+"' class='Level1'>" +
                            "<div class='form-group'>" +
                                "<div class='col-md-12'>" +
                                     "<label class='control-label'>" +
                                         "<h5 style='color:green;'><b>Immediate Reporting Manager (Manager "+i+")</b></h5>" +
                                     "</label>" +
                                "</div>" +
                                "<label class='control-label col-md-3'><b>Action</b></label>" +
                                "<label class='control-label col-md-3'><b>Send To</b></label>" +
                                "<label class='control-label col-md-3'><b>Send Copy To</b></label>" +
                            "</div>" +
                            "<div class='form-group'>" +
                                "<label class='control-label col-md-3'><b>Request Applied</b></label>" +
                                     "<div class='col-md-3'>" +
                                        "<div class='input-group'>" +
                                            "<select class='form-control select2me col-md-3' data-placeholder='Select...' id='appliedSend'>" +
                                            "</select>" +
                                        "</div>" +
                                     "</div>" +
                                     "<div class='col-md-3'>" +
                                         "<div class='input-group'>" +
                                            "<select class='form-control select2me col-md-3' data-placeholder='Select...' id='appliedsendCopyTo'>" +
                                            "</select>" +
                                         "</div>" +
                                     "</div>" +
                            "</div>" +
            "<div class='form-group'>" +
            "<label class='control-label col-md-3'><b>Request Approved</b></label>" +
            "<div class='col-md-3'>" +
            "<div class='input-group'>" +
            "<select class='form-control select2me col-md-3' data-placeholder='Select...' id='approvedSend'>" +
            "</select>" +
            "</div>" +
            "</div>" +
            "<div class='col-md-3'>" +
            "<div class='input-group'>" +
            "<select class='form-control select2me col-md-3' data-placeholder='Select...' id='approvedsendCopyTo'>" +
            "</select>" +
            "</div>" +
            "</div>" +
            "</div>" +"<div class='form-group'>" +
            "<label class='control-label col-md-3'><b>Request Rejected</b></label>" +
            "<div class='col-md-3'>" +
            "<div class='input-group'>" +
            "<select class='form-control select2me col-md-3' data-placeholder='Select...' id='rejectedSend'>" +
            "</select>" +
            "</div>" +
            "</div>" +
            "<div class='col-md-3'>" +
            "<div class='input-group'>" +
            "<select class='form-control select2me col-md-3' data-placeholder='Select...' id='rejectedsendCopyTo'>" +
            "</select>" +
            "</div>" +
            "</div>" +
            "</div>");
        //($("#Level1").show('slow'));  
        if(i <= 1){
            $("#selectL2").hide();
        }else{
            $("#selectL2").show();
        }
    }
    $.ajax({
        type: "POST",
        url: "ajax/workflow_ajax.php",
        success: function(result){
            $('#appliedsendCopyTo').html(result);
            $('#appliedSend').html(result);
            $('#approvedsendCopyTo').html(result);
            $('#approvedSend').html(result);
            $('#rejectedsendCopyTo').html(result);
            $('#rejectedSend').html(result);



        }
    });
});*/

function getmngrlist(){
    $.ajax({
        type: "POST",
        url: "ajax/workflowRLists_ajax.php",
        data: {},
        success: function(result){
            $(".select2me").html(result);
            //$("#sendCopyTo").html(result);
        }
    });
}



/*--------------End Work Flow Configuration--------*/


//To Show and Hide the attendance and Leave div
$("#attendance").click(function() {
    $("#showevent").hide('slow');
    $("#showevent").show('slow');
    var eventval =  $("#attendance").val();
    var ALL_data = "eventval=" + eventval;
    $.ajax({
        type: "POST",
        url: "ajax/workflow_ajax.php?pagetype=workflowAtt",
        data: ALL_data,
        success: function (html) {
            $("#event").html(html);

        }
    });

})
$("#leave").click(function(){
    $("#showevent").hide('slow');
    $("#showevent").show('slow');
    var eventval =  $("#leave").val();
    var ALL_data = "eventval=" + eventval;
    $.ajax({
        type: "POST",
        url: "ajax/workflow_ajax.php?pagetype=workflowAtt",
        data: ALL_data,
        success: function (html) {
            $("#event").html(html);

        }
    });

})

//To Show and Hide the attendance and Leave div

//Show no of selected levels
$("#showevent").change(function () {
    $("#approvingMethod").show('slow');

});
$("#showevent").change(function () {
    $("#approvingMethod").show('slow');

});

//To Show and Hide the Level of approval rule div
$("#manager").click(function() {
    $("#showmanagers").show('slow');
})
$("#automatic").click(function(){
    $("#showmanagers").hide('slow');
    $("#levels").hide('slow');

})
$("#manual").click(function() {
    $("#showmanagers").show('slow');
})
$("#automatic").click(function(){
    $("#showmanagers").hide('slow');
    $("#levels").hide('slow');

})

$("#shownocol").change(function(){

    for(var i=1;i<=ruleinc;i++) {
        $("#day" + i).prop("disabled", !$(this).is(':checked'));
        $("#shownocol").prop("value", !$(this).is(':checked'));
    }

})

$("button[id='addnewrow']").click(function() {
    if($("#level"+ruleinc).val() !="" && $("#approver"+ruleinc).val() !=""){

        approver = new Array();
        for(var i=1;i<=ruleinc;i++){
            approver.push($("#approver"+i).val());
        }
        alert(approver);

        ruleinc++;
        var ALL_data = "approver=" + approver;
         $.ajax({
            type: "POST",
            url: "ajax/workflow_ajax.php",
            data: ALL_data,
            success: function (html) {
                $("#approver"+ruleinc).html(html);

            }
        });
        if($("#shownocol").val()=='false'){
            $("#showrules").append('<br><div class="row">' +
                '<input class="col-md-3" type="text" id="level' + ruleinc + '" name="level[]" style="margin-left:30px;" />' +
                '<input class="col-md-3" type="text" id="day' + ruleinc + '" name="dayno[]" style="margin-left:50px;"/>' +
                '<select class="col-md-3" type="text" id="approver' + ruleinc + '" name="approver[]" style="margin-left:50px;"></select></div>');

        }
        else {
            $("#showrules").append('<br><div class="row">' +
                '<input class="col-md-3" type="text" id="level' + ruleinc + '" name="level[]" style="margin-left:30px;" />' +
                '<input class="col-md-3" type="text" id="day' + ruleinc + '" name="dayno[]" style="margin-left:50px;" disabled/>' +
                '<select class="col-md-3" type="text" id="approver' + ruleinc + '" name="approver[]" style="margin-left:50px;"></select></div>');
        }

        //  $("#go").hide();

        //  $("#go").show();
    }
    else{
        if($("#level"+ruleinc).val() ==""){
            alert('Enter Approval Level');
        }
        else if($("#approver"+ruleinc).val() =="") {;
            alert('Select Approver')

        }
    }

});


function insertReq(){
    $.ajax({
        type: "POST",
        url: "ajax/workflow_ajax.php",
        
    });
}