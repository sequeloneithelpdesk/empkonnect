/*--------------Start Work Flow Configuration--------*/
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
            url: "ajax/Roster_ajax.php?type=defaultValue",
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
                url: "ajax/Roster_ajax.php?type=showdata",
                data: {tblName:tblName,childval:xyx,data:data },
                dataType : 'json',
                success: function(result){
                    //alert (result);
                    data=result;
                    //console.log(data);
                    //$("#showsuboption").html(result);
                }
            });
        }
        else{
            xyx = clicked.value;
            //alert(clicked.value);
            $.ajax({
                type: "POST",
                url: "ajax/Roster_ajax.php?type=hidedata",
                data: {tblName:tblName,childval:xyx,data:data },
                dataType : 'json',
                success: function(result){
                    //alert (result);
                    data=result;
                    //console.log(data);
                    //$("#showsuboption").html(result);
                }
            });
        }
        // alert (tblName);

    },
    addConfirm: function (){
        $.ajax({
            type: "POST",
            url: "ajax/Roster_ajax.php?type=finaldata",
            data: {data:data },
            success: function(result){
                //alert (result);
                //console.log(result);
                // data=result;
                $('#showConfirm').html(result);
                //console.log(data);
            }
        });
    },

    addemp:function(type){
        $.ajax({
            type: "POST",
            url: "ajax/Rosterlist_ajax.php?type="+type,
            data: {data:data },
            beforeSend: function(){
                loading();
            },
            success: function(result){
                unloading();
                //console.log(result);
                
                $("#empshowdiv").css('display','block');
                if(result==2){
                    $("#empshowdiv").html("No employee mapped.");
                    $("#selall").css('display','none');

                }
                else{
                    
                    if(type=='bulk'){
                        $('#s2id_select2_sample2').css('display','block');
                        $('#selectemp').css('display','none');
                    $('#select2_sample2').html(result);
                    $('#selall').html('Select All');
                    $('#selall').attr('onclick',"Roster.addemp('all')");
                }
                else{
                        $('#s2id_select2_sample2').css('display','none');
                        $('#selectemp').css('display','block');
                        $('#selectemp').html(result);
                        $('#selall').html('Unselect All');
                        $('#selall').attr('onclick',"Roster.addemp('bulk')");
                }
                }

                //console.log(data);
            }
        });
    },
    submitrost:function(){
        
        var workName=$("#workName").val(); 
        var emp=$("#select2_sample2").val(); 
        var dfrom=$("#dfrom").val(); 
        var dto=$("#dto").val(); 
        var rshift=$("#rshift").val();        
        var rshiftp=$("#rshiftp").val();
        var auto_p=$("#auto_p").val(); 
        var v1=$("#errorhid").val();var v2=$("#errorhidreq1").val();var v3=$("#errorhidreq2").val();
        var v4=$("#errorhidreq3").val();var v5=$("#errorhidreq4").val();var v6=$("#errorhidreq5").val();


        if(emp==""||rshift==""||rshiftp==""){
            $("#err").removeclass('display-hide');
            $("#err").html("Please Fill Mandetory Fields.");
        }

        $.ajax({
            type: "POST",
            url: "ajax/Roster_ajax.php?type=subdata",
            data: {workName:workName,emp:emp,dfrom:dfrom,dto:dto,rshift:rshift,rshiftp:rshiftp,auto_p:auto_p},
            beforeSend: function(){
                loading();
            },
            success: function(result){
                unloading();
                //console.log(result);
                
                $("#err").addClass('display-hide');
                $("#succ").removeClass('display-hide');

            }
        });
        
    },
    autocheck:function(autocheckbtn){
        if(autocheckbtn.checked){
            $('#auto_p').val('1');
            alert(1);

        }
        else{
            $('#auto_p').val('0');
            alert(0);

        }
    },
    selallcancle: function(id){

        $('#licon'+id).css('display','none');

        var hidval=$('#checkhid_r').val();
        alert(hidval);
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
        url: "ajax/Rosterlist_ajax.php",
        data: {},
        success: function(result){
            $(".select2me").html(result);
            //$("#sendCopyTo").html(result);
        }
    });
}



/*--------------End Work Flow Configuration--------*/