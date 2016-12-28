$("input[name=fixedbrk]").click(function(){
    if($('input[name=fixedbrk]:checked').val() ==1)
    {
       
        $("#brkdef").show();
    }
    else
    {
        $("#brkdef").hide();
    }

});
$("input[name=fixedbrk]").click(function(){
    if($('input[name=fixedbrk]:checked').val() ==1)
    {

        $("#brkdef").show();
    }
    else
    {
        $("#brkdef").hide();
    }

});

$('#companyOff').change(function(){
    if($(this).attr('checked')){
        $(this).val('1');
    }else{
        $(this).val('0');
    }
});



function time_validate(value,id)
{
   // var re = /^([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]/;

   // var re = /^[0-9:]+$/;

    // var re = /^([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]/;

    var re = /^[0-9:]+$/;

    if(value.length <=8 && value.match(re)){
        if(value.length == 2){
            if(value<=23){
                var newval  = value.concat(':');

                $('#'+id).val(newval);
            }
            else{
                alert("Incorrect Time");
            }

        }
        if(value.length == 5){
            var newstr = value.split(":");
           // alert(newstr[1]);
            if(newstr[1]<=60){
                var newval  = value.concat(':');
                $('#'+id).val(newval);
            }
            else{
                alert("Incorrect Time");
            }
        }
        if(value.length == 8){
            var newstr = value.split(":");
            // alert(newstr[1]);
            if(newstr[2]<=60){
               // var newval  = value.concat(':');
              //  $('#'+id).val(newval);
            }
            else{
                alert("Incorrect Time");
            }
        }
    }
    else{
        alert("Incorrect Time");
        $("#"+id).val("");
    }




}

function start_endvalid(){

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
                }

        }
        else{
            if(parseInt(splitendtime[0])<=parseInt(splitstarttime[0])){
               // alert(splitendtime[0]);
                toasterrormsg("Shift End Time must be greater than Shift Start Time! Please use 24 hr format")

                $("#shiftendtime").val("");
                $("#shiftendtime").css('border-color', 'red');
                return false;
            }

                else{
                    $("#shiftendtime").css('border-color', '');
                }

        }

    }
function end_startvalid(){

    var starttime = $("#shiftstarttime").val();
    var endtime = $("#shiftendtime").val();
    var splitstarttime = starttime.split(":");
    var splitendtime = endtime.split(":");
    //alert(starttime + endtime);
    if(splitstarttime[0] == 0){
        splitstarttime[0] = 24;
        // alert(splitstarttime[0]);
    }
    if(splitendtime[0] == 0){
        splitendtime[0] = 24;
        // alert(splitstarttime[0]);
    }
//alert(splitendtime[0]);
    if($('input[name=rclock]:checked').val() ==1) {
        if(parseInt(splitendtime[0])>=parseInt(splitstarttime[0])){
            toasterrormsg("Shift is Rotational So Shift Start Time must be greater than Shift End Time! Please use 24 hr format");

            $("#shiftendtime").val("");
            $("#shiftendtime").css('border-color', 'red');
            return false;
        }

            else{
                $("#shiftendtime").css('border-color', '');
            }

    }
    else{
        if(parseInt(splitendtime[0])<=parseInt(splitstarttime[0])){
        //    alert(splitendtime[0]);
         //   alert(splitstarttime[0]);
            toasterrormsg("Shift End Time must be greater than Shift Start Time! Please use 24 hr format");

            $("#shiftendtime").val("");
            $("#shiftendtime").css('border-color', 'red');
            return false;
        }
        else{
             $("#shiftendtime").css('border-color', '');
            }

    }

}


    
function mstart_endvalid(){

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
            toasterrormsg("Mandatory is Rotational So Shift Start Time must be greater than Mandatory End Time! Please use 24 hr format");
            $("#mendtime").val("");
            $("#mendtime").css('border-color', 'red');
            return false;
        }

        else{
            $("#mendtime").css('border-color', '');
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
        }

    }

}
function mend_startvalid(){

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
        }

    }

}
function brkvalid() {

    var starttime = $("#brkstarttime").val();
    var endtime = $("#brkendtime").val();
    var splitstarttime = starttime.split(":");
    var splitendtime = endtime.split(":");
    if (splitstarttime[0] == 0) {
        splitstarttime[0] = 24;
        // alert(splitstarttime[0]);
    }
    if (splitendtime[0] == 0) {
        splitendtime[0] = 24;
        // alert(splitstarttime[0]);
    }
    if ($('input[name=fixedbrk]:checked').val() == 1){
        if ($('input[name=rclock]:checked').val() == 1) {
            if (parseInt(splitendtime[0]) >= parseInt(splitstarttime[0])) {
                toasterrormsg("Shift is Rotational So Break Start Time must be greater than Break End Time! Please use 24 hr format");

                $("#brkendtime").val("");
                $("#brkendtime").css('border-color', 'red');
                return false;
            }

            else {
                $("#brkendtime").css('border-color', '');
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
            }

        }
}
}
function endbrkvalid(){

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
            if (parseInt(splitendtime[0]) >=parseInt(splitstarttime[0])) {
                toasterrormsg("Shift is Rotational So Break Start Time must be greater than Break End Time! Please use 24 hr format");

                $("#brkendtime").val("");
                $("#brkendtime").css('border-color', 'red');
                return false;
            }

            else {
                $("#brkendtime").css('border-color', '');
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
            }

        }
    }

}

function select_all(id)
{
   if($("#"+id).val() == 0){
       $("#"+id).val('1');

       var all = $("#"+id).val();
       var newid = id.split("all");
       for(var i=1;i<=5;i++){
           //alert(i+newid[1]);
           $('#'+i+newid[1]).prop('checked', true);

       }
   }
    else{
       $("#"+id).val('0');

       var all = $("#"+id).val();
       var newid = id.split("all");
       for(var i=1;i<=5;i++){
           //alert(i+newid[1]);
           $('#'+i+newid[1]).prop('checked', false);

       }
   }

}