/**
 * Created by Lenovo PC on 11-07-2016.
 */
var startnew = "0";
var mstartnew = "0";
var brknew ="0";
function validateall(){
    var shiftCode = $("#shiftCode").val();
    var shiftName = $("#shiftName").val();
    var shiftstarttime = $("#shiftstarttime").val();
    var shiftendtime = $("#shiftendtime").val();
    var mstarttime = $("#mstarttime").val();
    var mendtime = $("#mendtime").val();
    var sw_startshift = $("#sw_startshift").val();
    var sw_endshift = $("#sw_endshift").val();
    var brkstarttime = $("#brkstarttime").val();
    var brkendtime = $("#brkendtime").val();
    var mfullday = $("#mfullday").val();
    var mhalfday = $("#mhalfday").val();
    var latecomemin = $("#latecomemin").val();
    var lcycle = $("#lcycle").val();
    var lgrace = $("#lgrace").val();
    var earlygo = $("#earlygo").val();
    var ecycle = $("#ecycle").val();
    var egrace = $("#egrace").val();
    var brkradio = $('input[name=fixedbrk]:checked').val();
//alert(shiftCode);
    if(shiftCode==''){
        $("#errorhidreq18").val("1");

    }else{
        $("#errorhidreq18").val('0');
    }
    if(shiftName==''){
        $("#errorhidreq1").val('1');
        $("#shiftName").css('border-color', 'red');

    }
    else{
        $("#errorhidreq1").val('0');
    }
    if(shiftstarttime==''){
        $("#errorhid2").val("1");

    }else{
        $("#errorhid2").val('0');
    }
    if(shiftendtime==''){
        $("#errorhidreq3").val("1");

    }else{
        $("#errorhidreq3").val('0');
    }
    if(mstarttime==''){
        $("#errorhidreq4").val("1");
    }else{
        $("#errorhidreq4").val('0');
    }
    if(mendtime==''){
        $("#errorhidreq5").val("1");
    }else{
        $("#errorhidreq5").val('0');
    }
    if(sw_startshift==''){
        $("#errorhidreq6").val("1");
    }else{
        $("#errorhidreq6").val('0');
    }
    if(sw_endshift==''){
        $("#errorhidreq7").val("1")}
    if(brkradio=='1'){
        if(brkstarttime==''){
            $("#errorhidreq8").val("1");

        }else{
            $("#errorhidreq8").val('0');
        } if(brkendtime==''){
            $("#errorhidreq9").val("1");

        }
        else{
            $("#errorhidreq9").val('0');
        }
    }
    else{
        $("#errorhidreq7").val('0');
    }if(mfullday==''){
        $("#errorhidreq10").val("1");

    }
    else{
        $("#errorhidreq10").val('0');
    }
    if(mhalfday==''){
        $("#errorhidreq11").val("1");

    }else{
        $("#errorhidreq11").val('0');
    } if(latecomemin==''){
        $("#errorhidreq12").val("1");
    }else{
        $("#errorhidreq12").val('0');
    } if(lcycle==''){
        $("#errorhidreq13").val("1");

    }else{
        $("#errorhidreq13").val('0');
    } if(lgrace==''){
        $("#errorhidreq14").val("1");
    }else{
        $("#errorhidreq14").val('0');
    } if(earlygo==''){
        $("#errorhidreq15").val("1");

    }else{
        $("#errorhidreq15").val('0');
    } if(ecycle==''){
        $("#errorhidreq16").val("1");

    }else{
        $("#errorhidreq16").val('0');
    } if(egrace==''){
        $("#errorhidreq17").val("1");

    }else{
        $("#errorhidreq17").val('0');
    }





}
function validateallPattern(){
    var shiftPatternCode = $("#shiftPatternCode").val();
    var shiftPatternName = $("#shiftPatternName").val();
    var repeatPattern = $("#repeatPattern").val();

//alert(shiftCode);
    if(shiftPatternCode==''){
        $("#errorhidreq1").val('1');

    }
    else{
        $("#errorhidreq1").val('0');
    }
    if(shiftPatternName==''){
        $("#errorhidreq2").val('1');
        $("#shiftPatternName").css('border-color', 'red');

    }
    else{
        $("#errorhidreq2").val('0');
    }
    if(repeatPattern==''){
        $("#errorhidreq3").val("1");
    }
    else{
        $("#errorhidreq3").val("0");
    }





}
function start_endvalid1(){

    var starttime = $("#shiftstarttime").val();
    var endtime = $("#shiftendtime").val();
    var splitstarttime = starttime.split(":");
    var splitendtime = endtime.split(":");
    if(splitstarttime[0] == 0){
        splitstarttime[0] = 24;
        // alert(splitstarttime[0]);
    }
    if(splitendtime[0] == 0){
        splitendtime[0] = 24;
        // alert(splitstarttime[0]);
    }
    if($('input[name=rclock]:checked').val() ==1) {
        if(parseInt(splitendtime[0])>=parseInt(splitstarttime[0])){
            toasterrormsg("Shift is Rotational So Shift Start Time must be greater than Shift End Time! Please use 24 hr format");

            $("#shiftendtime").val("");
            $("#shiftendtime").css('border-color', 'red');
            return false;
        }

        else{
            $("#shiftendtime").css('border-color', '');
            startnew="1";
        }

    }
    else{
        if(parseInt(splitendtime[0])<=parseInt(splitstarttime[0])){
            // alert(splitendtime[0]);
            toasterrormsg("Shift End Time must be greater than Shift Start Time! Please use 24 hr format");

            $("#shiftendtime").val("");
            $("#shiftendtime").css('border-color', 'red');
            return false;
        }

        else{
            $("#shiftendtime").css('border-color', '');
            startnew="1";
        }

    }

}
function mstart_endvalid1(){

    var starttime = $("#mstarttime").val();
    var endtime = $("#mendtime").val();
    var splitstarttime = starttime.split(":");
    var splitendtime = endtime.split(":");
    if(splitstarttime[0] == 0){
        splitstarttime[0] = 24;
        // alert(splitstarttime[0]);
    }
    if(splitendtime[0] == 0){
        splitendtime[0] = 24;
        // alert(splitstarttime[0]);
    }
    if($('input[name=rclock]:checked').val() ==1) {
        if(parseInt(splitendtime[0])>=parseInt(splitstarttime[0])){
            toasterrormsg("Shift is Rotational So Mandatory Start Time must be greater than Mandatory End Time! Please use 24 hr format");

            $("#mendtime").val("");
            $("#mendtime").css('border-color', 'red');
            return false;
        }

        else{
            $("#mendtime").css('border-color', '');
            mstartnew = "1";
        }

    }
    else{
        if(parseInt(splitendtime[0])<=parseInt(splitstarttime[0])){
            //  alert(splitendtime[0]);
            //  alert(splitstarttime[0]);
            toasterrormsg("Mandatory End Time must be greater than Mandatory Start Time! Please use 24 hr format");

            $("#mendtime").val("");
            $("#mendtime").css('border-color', 'red');
            return false;
        }
        else{
            $("#mendtime").css('border-color', '');
            mstartnew = "1";
        }

    }

}
function brkvalid1(){

    var starttime = $("#brkstarttime").val();
    var endtime = $("#brkendtime").val();
    var splitstarttime = starttime.split(":");
    var splitendtime = endtime.split(":");
    if(splitstarttime[0] == 0){
        splitstarttime[0] = 24;
        // alert(splitstarttime[0]);
    }
    if(splitendtime[0] == 0){
        splitendtime[0] = 24;
        // alert(splitstarttime[0]);
    }
    if ($('input[name=fixedbrk]:checked').val() == 1) {
        if ($('input[name=rclock]:checked').val() == 1) {
            if (parseInt(splitendtime[0]) >= parseInt(splitstarttime[0])) {
                toasterrormsg("Shift is Rotational So Break Start Time must be greater than Break End Time! Please use 24 hr format");

                $("#brkendtime").val("");
                $("#brkendtime").css('border-color', 'red');
                return false;
            }

            else {
                $("#brkendtime").css('border-color', '');
                brknew = "1";
            }

        }
        else {
            if (parseInt(splitendtime[0]) <= parseInt(splitstarttime[0])) {
                //  alert(splitendtime[0]);
                //  alert(splitstarttime[0]);
                toasterrormsg("Break End Time must be greater than Break Start Time! Please use 24 hr format");

                $("#brkendtime").val("");
                $("#brkendtime").css('border-color', 'red');
                return false;
            }
            else {
                $("#brkendtime").css('border-color', '');
                brknew = "1";
            }

        }
    }
    else{
        brknew="1";
    }
}
var SM={

    init: function(tablename,pre,divid,status,name ){

        $.ajax({
            type : 'POST',
            data:{type:'init',status:status,table:tablename,pre:pre,name:name },
            url  : 'ajax/init_ajax/SM_ajax.php',
            beforeSend: function(){
                loading();
            },
            success: function(responseText){
                unloading();

                $("#"+divid).html(responseText);

                $("#"+divid).DataTable().destroy();

                table_excel(divid);
            }
        });
    },
    changestatus:function (tablename,pre,divid,status,id,name) {
        $.ajax({
            type : 'POST',
            data:{type:'editstatus',status:status,table:tablename,pre:pre,id:id },
            url  : 'ajax/init_ajax/SM_ajax.php',
            beforeSend: function(){
                loading();
            },
            success: function(responseText){
                unloading();
                if(responseText==1){

                    if(status=="1"){
                        var status1="Inactive";
                    }else{
                        var  status1="Active";
                    }
                    $("#"+divid).val(status1);
                    SM.init(tablename,pre,'sample_2',status,name);

                }
                else{
                    alert(responseText);
                }
                //$("#"+divid).html(responseText);


            }
        });

    },

    smsubmit:function (type,frm,table,pre,header,valid,validhidreq,pagetype) {
        var formData = $("#"+frm).serialize();
      //  alert(formData);

        if(frm=='form_sm'){
           // alert(frm);
            validateall();
            var v1=$("#"+valid).val();var v2=$("#"+validhidreq+"1").val();var v3=$("#"+validhidreq+"2").val();
            var v4=$("#"+validhidreq+"3").val();var v5=$("#"+validhidreq+"4").val();var v6=$("#"+validhidreq+"5").val();
            var v7=$("#"+validhidreq+"6").val();var v8=$("#"+validhidreq+"7").val();var v9=$("#"+validhidreq+"8").val();
            var v10=$("#"+validhidreq+"9").val();var v11=$("#"+validhidreq+"10").val();var v12=$("#"+validhidreq+"11").val();
            var v13=$("#"+validhidreq+"12").val();var v14=$("#"+validhidreq+"13").val();var v15=$("#"+validhidreq+"14").val();
            var v16=$("#"+validhidreq+"15").val();var v17=$("#"+validhidreq+"16").val();var v18=$("#"+validhidreq+"17").val();
            var v19=$("#"+validhidreq+"18").val();


            var err1=$('#rolename_availability_result').html();
            var err23=$('#result').html();
            //alert(err1);
            if(v1=="1" || v2=="1"||v3=="1" || v4=="1"||v5=="1"|| v6=="1"|| v7=="1"|| v8=="1"|| v9=="1"|| v10=="1"|| v11=="1"
                || v12=="1"|| v13=="1"|| v14=="1"|| v15=="1"|| v16=="1"|| v17=="1"|| v18=="1"|| v19=="1"){
                $("#err").removeClass('display-hide');
                $("#err").html('<button class="close" data-close="alert"></button> <br>Please Fill Mandatory Fields.');
                if(v19=="1"){
                    $("#shiftCode").css('border-color', 'red');
                }
                else {

                    $("#shiftCode").css('border-color', '#e5e5e5');
                }
                if(v2=='1'){
                        $("#shiftName").css('border-color', 'red');
                    }
                else {
                    $("#shiftName").css('border-color', '#e5e5e5');
                }
                if(v3=='1'){
                    $("#shiftstarttime").css('border-color', 'red');
                }
                else {
                    $("#shiftstarttime").css('border-color', '#e5e5e5');
                }
                if(v4=='1'){
                    $("#shiftendtime").css('border-color', 'red');
                }
                else {
                    $("#shiftendtime").css('border-color', '#e5e5e5');
                }
                if(v5=='1'){
                    $("#mstarttime").css('border-color', 'red');
                }
                else {
                    $("#mstarttime").css('border-color', '#e5e5e5');
                }
                if(v6=='1'){
                    $("#mendtime").css('border-color', 'red');
                }
                else {
                    $("#mendtime").css('border-color', '#e5e5e5');
                }
                if(v7=='1'){
                   $("#sw_startshift").css('border-color', 'red');
                }
                else {
                    $("#sw_startshift").css('border-color', '#e5e5e5');
                }
                if(v8=='1'){
                   $("#sw_endshift").css('border-color', 'red');
                }
                else {
                    $("#sw_endshift").css('border-color', '#e5e5e5');
                }
                if($('input[name=fixedbrk]:checked').val()=='1'){
                    if(v9=='1'){
                       $("#brkstarttime").css('border-color', 'red');
                    }
                    else {
                        $("#brkstarttime").css('border-color', '#e5e5e5');
                    }
                    if(v10=='1'){
                        $("#brkendtime").css('border-color', 'red');
                    }
                    else {
                        $("#brkendtime").css('border-color', '#e5e5e5');
                    }
                }

                if(v11=='1'){
                    $("#mfullday").css('border-color', 'red');
                }
                else {
                    $("#mfullday").css('border-color', '#e5e5e5');
                }
                if(v12=='1'){
                    $("#mhalfday").css('border-color', 'red');
                }
                else {
                    $("#mhalfday").css('border-color', '#e5e5e5');
                }
                if(v13=='1'){
                    $("#latecomemin").css('border-color', 'red');
                }
                else {
                    $("#latecomemin").css('border-color', '#e5e5e5');
                }
                if(v14=='1'){
                    $("#lcycle").css('border-color', 'red');
                }
                else {
                    $("#lcycle").css('border-color', '#e5e5e5');
                }
                if(v15=='1'){
                    $("#lgrace").css('border-color', 'red');
                }else {
                    $("#lgrace").css('border-color', '#e5e5e5');
                }
                if(v16=='1'){
                    $("#earlygo").css('border-color', 'red');
                }else {
                    $("#earlygo").css('border-color', '#e5e5e5');
                }
                if(v17=='1'){
                    $("#ecycle").css('border-color', 'red');
                }else {
                    $("#ecycle").css('border-color', '#e5e5e5');
                }
                if(v18=='1'){
                    $("#egrace").css('border-color', 'red');
                }
                else {
                    $("#egrace").css('border-color', '#e5e5e5');
                }

                // $("#"+valid).css('border','red');
            }
            else if(err23=='Code Already taken.' || err23=='Name Already exists.'){
                $("#err").removeClass('display-hide');
                $("#err").html('<button class="close" data-close="alert"></button> <br>Please Fill Unique Value.');
            }
            else {
                start_endvalid1();
                mstart_endvalid1();
                brkvalid1();
               // alert(startnew);
                //alert(mstartnew);
                //alert(brknew);
                if(startnew=="1" && mstartnew=="1" && brknew=="1"){
                   // alert('update');
                    $.ajax({
                        type: 'POST',
                        data: formData,
                        url: 'ajax/editData.php?pagetype='+pagetype+'&type=' + type,
                        beforeSend: function () {
                            loading();
                        },
                        success: function (responseText) {
                            unloading();
                            if (responseText == 1) {
                                $("#err").addClass('display-hide');
                                $("#succ").removeClass('display-hide');

                                SM.init(table,pre,'sample_2','1',header);

                                setTimeout(function(){ $('#large1').modal('hide'); }, 2000);
                                toastmsg("Shift Created Successfully");

                            }
                            if (responseText == 2) {
                                $("#err").removeClass('display-hide');
                                $("#err").html('<button class="close" data-close="alert"></button> <br>Please Fill Unique Value.');
                            }
                            if (responseText == 3) {
                                toasterrormsg("Error in Creation");
                            }

                            //$("#"+divid).html(responseText);


                        }
                    });
                }

            }
        }
        else{
            validateallPattern();
            var v1=$("#"+valid).val();var v2=$("#"+validhidreq+"1").val();var v3=$("#"+validhidreq+"2").val();
            var v4=$("#"+validhidreq+"3").val();var v5=$("#"+validhidreq+"4").val();var v6=$("#"+validhidreq+"5").val();



            var err1=$('#rolename_availability_result').html();
            var err23=$('#result').html();
            //alert(err1);
            if(v1=="1" || v2=="1"||v3=="1" || v4=="1"||v5=="1"|| v6=="1"){
                $("#err").removeClass('display-hide');
                $("#err").html('<button class="close" data-close="alert"></button> <br>Please Fill Mandatory Fields.');
                //$("#"+valid).css('border','red');

                if(v2=='1'){
                    //alert(v2);
                    $("#shiftPatternCode").css('border-color', 'red');
                }
                else {
                    $("#shiftPatternCode").css('border-color', '#e5e5e5');
                }
                if(v3=='1'){
                        $("#shiftPatternName").css('border-color', 'red');
                }
                else{
                    $("#shiftPatternName").css('border-color', '#e5e5e5');
                }
                if(v4=='1'){
                    $("#repeatPattern").css('border-color', 'red');
                }
                else{
                    $("#repeatPattern").css('border-color', '#e5e5e5');
                }
            }
            else if(err23=='Code Already taken.' || err23=='Name Already exists.'){
                $("#err").removeClass('display-hide');
                $("#err").html('<button class="close" data-close="alert"></button> <br>Please Fill Unique Value.');
            }
            else {
//alert('1');
                $.ajax({
                    type: 'POST',
                    data: formData,
                    url: 'ajax/editData.php?pagetype='+pagetype+'&type=' + type,
                    beforeSend: function () {
                        loading();
                    },
                    success: function (responseText) {
                        unloading();
                        if (responseText == 1) {
                            $("#err").addClass('display-hide');
                            $("#succ").removeClass('display-hide');

                            SM.init(table,pre,'sample_2','1',header);

                            setTimeout(function(){ $('#large1').modal('hide'); }, 2000);

                        }
                        if (responseText == 2) {
                            $("#err").removeClass('display-hide');
                            $("#err").html('<button class="close" data-close="alert"></button> <br>Please Fill Unique Value.');
                        }
                        if (responseText == 3) {
                            toasterrormsg("");
                        }
                        //$("#"+divid).html(responseText);


                    }
                });
            }

        }



    },
    checkrolename : function(id,table,col){

        var role_name = $('#'+id).val();
        var cutname=id.substr(id.length-4);
        var newid=id.slice(0,-4);
        //alert(newid);
        //alert(cutname);
        if(role_name.length > 0) {
            $('#rolename_availability_result').html('Loading..');
            $('#subbut').attr('disabled',true);
            //var post_string = 'user_name='+role_name+'&table_name='+table+'&col_name='+col ;
            $.ajax({
                type : 'POST',
                data : {user_name:role_name,table_name:table ,col_name:col},
                url  : 'ajax/namecheck.php',
                success: function(responseText){
                    if(responseText == 0){

                        $('#rolename_availability_result').html('<span class="success" id="result">Available.</span>');
                        if( cutname=='Code'){
                            $('#'+newid+'Name').attr('readonly',false);
                            $('#'+newid+'Name').attr('tabindex','1');

                        }
                        else{
                            $('#'+newid+'Code').attr('readonly',false);
                            $('#'+newid+'Name').attr('tabindex','1');
                        }
                        $('#subbut').attr('disabled',false);

                    }else if(responseText > 0){
                        $('#subbut').attr('disabled',true);
                        $('#rolename_availability_result').html('<span class="error" id="result">'+cutname+' Already exists.</span>');

                        if(cutname=='Code' ){
                            $('#'+newid+'Name').attr('readonly',true);
                            $('#'+newid+'Name').attr('tabindex','-1');
                        }
                        else{
                            $('#'+newid+'Code').attr('readonly',true);
                            $('#'+newid+'Name').attr('tabindex','-1');
                        }


                    }else{
                        alert('Problem with mysql query');
                    }
                }
            });
        }
        else{
            $('#rolename_availability_result').html('');
            $('#subbut').attr('disabled',false);
        }

    },
    locsubmit:function (type,frm) {
        var formData = $("#"+frm).serialize();

        var name=$("#LocName").val();
        var err=$('#rolename_availability_result').html();
        if(name=="" || err==""){
            $("#err").removeClass('display-hide');
            $("#err").html('<button class="close" data-close="alert"></button> <br> You have some form errors. Please check below.');
            $("#bussName").css('border',red);
        }
        else {
            $.ajax({
                type: 'POST',
                data: formData,
                url: 'ajax/editData.php?pagetype=edit_business_unit&type=' + type,
                beforeSend: function () {
                    loading();
                },
                success: function (responseText) {
                    unloading();
                    if (responseText == 1) {

                        SM.init('ShiftMast','Shift','sample_2','1','Shift');

                    }
                    else {
                        alert(responseText);
                    }
                    //$("#"+divid).html(responseText);


                }
            });
        }

    }

}

