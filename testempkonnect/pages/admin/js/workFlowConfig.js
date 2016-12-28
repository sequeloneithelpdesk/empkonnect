/*--------------Start Work Flow Configuration--------*/
var data ="";
var workflow={
    init:function(){
        //alert("h");
        $.ajax({
            type:"POST",
            url:"ajax/role_menuajax.php?type=data",
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
                workflow.showdefault();
                //$('#datamenu').jstree(true).refresh();

            }
        });
    },

showdefault: function (){
    var tblName = $("#forWhome").val();

    //console.log(data);
    $.ajax({
        type: "POST",
        url: "ajax/workFlowConfig_ajax.php?type=defaultValue",
        data: {tblName:tblName,data:data },
        success: function(result){
            //alert (result);
            //console.log(result);
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
                url: "ajax/workFlowConfig_ajax.php?type=showdata",
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
                url: "ajax/workFlowConfig_ajax.php?type=hidedata",
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
            url: "ajax/workFlowConfig_ajax.php?type=finaldata",
            data: {data:data },
            success: function(result){
                //alert (result);
                //console.log(result);
                $('#showConfirm').html(result);
                console.log(data);
            }
        });
}


}

//To Show and Hide the Level of approval div
$("#manager").click(function() {
  $("#showmanagers").show('slow');  
})
$("#automatic").click(function(){
  $("#showmanagers").hide('slow');
  $("#levels").hide('slow');
  
})

//Show no of selected levels
$("#go").click(function () {
  $(".select2me").select2();
  getmngrlist();
  levelNo = $("#approveLevel").val();
  //console.log (levelNo);
  var topDiv = $("#levels");
  topDiv.empty();
  for (var i = 1; i <= levelNo; i++){
   topDiv.append("<div  id='Level"+i+"' class='Level1'><div class='form-group'><div class='col-md-12'><label class='control-label'><h5 style='color:green;'><b>Immediate Reporting Manager (Manager "+i+")</b></h5></label></div> <label class='control-label col-md-3'><b>Action</b></label><label class='control-label col-md-3'><b>Send To</b></label><label class='control-label col-md-3'><b>Send Copy To</b></label><label class='control-label col-md-3'><b>Notification/Email/Messages</b></label></div><div class='form-group'><label class='control-label col-md-3'><b>Request Applied</b></label><div class='col-md-3'><div class='input-group'><select class='form-control select2me' data-placeholder='Select...' id='manager1'></select></div></div><div class='col-md-3'><div class='input-group'><select class='form-control select2me' data-placeholder='Select...' id='sendCopyTo'></select></div></div><label class='control-label col-md-3'>Edit</label></div><div class='form-group'><label class='control-label col-md-2'><b>Request Approved</b></label><label class='control-label col-md-2'>User</label><div class='col-md-2' id='selectL2'><div class='input-group'> <select class='form-control select2me' data-placeholder='Select...' id='manager2'></select></div></div><label class='control-label col-md-3'>Edit</label></div><div class='form-group'><label class='control-label col-md-3'><b>Request Rejected</b></label><label class='control-label col-md-3'>User</label><label class='control-label col-md-3'>Select</label><label class='control-label col-md-3'>Edit</label></div></div>");
   //($("#Level1").show('slow'));  
   if(i <= 1){
      $("#selectL2").hide();
    }else{
      $("#selectL2").show();
    }
  }
});

function getmngrlist(){
  $.ajax({
        type: "POST",
        url: "ajax/workFlowConfiglist_ajax.php",
        data: {},
        success: function(result){
          $(".select2me").html(result);
          //$("#sendCopyTo").html(result);
        }
    });
}
   
   

/*--------------End Work Flow Configuration--------*/