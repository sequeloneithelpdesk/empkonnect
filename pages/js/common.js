
function toastmsg(message){

	toastr.options = {
  "closeButton": true,
  "debug": false,
  "positionClass": "toast-bottom-full-width",
  "onclick": null,
  "showDuration": "1000",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
	}

 toastr["success"](message, "Notification");

}
function toasterrormsg(message){

	toastr.options = {
  "closeButton": true,
  "debug": false,
  "positionClass": "toast-bottom-full-width",
  "onclick": null,
  "showDuration": "1000",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
	}

 toastr["error"](message, "Notification");

}



function loading(){
	Metronic.blockUI({
                boxed: true
            });

}

function unloading(){
	  Metronic.unblockUI();

}

function changerole(roleid){

  $.ajax({
    type:"POST",
    url:"../include/rolemenu_ajax.php?type=editmenu",
    data:{id:roleid},

    cache: false,
    beforeSend: function(){
      loading();
    },
    success: function(result){
      unloading();
      //header('location: ../login/home');
      window.location.href = "../login/home.php";
      //location.reload();

    }
  });

}

var validate={
  validateEmail : function(elementValue) {
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    return emailPattern.test(elementValue);
  },
  validateonlyno : function(elementValue) {
    var noPattern = /[0-9]|\./;
    return noPattern.test(elementValue);
  },

  email :function (id,error) {
    var value = $("#"+id).val();
    var valid = validate.validateEmail(value);

    if (!valid) {
      $("#"+id).css('color', 'red');
      $("#"+error).val("1");

    } else {
       $("#"+id).css('color', '#000');
      $("#"+error).val("0");
    }
  },
  onlyno :function (id,error) {
    var value = $("#"+id).val();
    var valid = validate.validateonlyno(value);

    if (!valid) {
      $("#"+id).css('color', 'red');
      $("#"+error).val("1");

    } else {
      $("#"+id).css('color', '#000');
      $("#"+error).val("0");
    }
  },
  require :function (id,error) {
    var value = $("#"+id).val();
    //var valid = valid.length ;

    if (value == ""|| value=="0") {
      $("#"+id).css('border', '1px solid red');
      $("#"+error).val("1");

    } else {
      $("#"+id).css('color', '#000');
      $("#"+id).css('border', '1px solid black');
      $("#"+error).val("0");
    }
  }


}    



function isNumber(evt) {
  var iKeyCode = (evt.which) ? evt.which : evt.keyCode
  if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
    return false;

  return true;
}




function countryfunc(tablename,tablepre,tablepar,divid,res){
	
	$.ajax({
    type:"POST",
    url:"../ajax/ajaxcountry.php",
    data:{table:tablename, pre:tablepre,par:tablepar, res:res},
    cache: false,
    beforeSend: function(){
      loading();
    },
    success: function(result){
      unloading();
	  $('#divid').html(result); 
    }
  });
	
}

function onlyNumeric(fieldId) {

  $("#"+fieldId).keypress(function (e) {

    //if the letter is not digit then display error and don't type anything
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
      //display error message
      //$("#errphone").html("Digits Only").show();
      return false;
    }
  });

}


$("#mPhoneNo").keypress(function (e) {

  //if the letter is not digit then display error and don't type anything
  if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
    //display error message
    //$("#errphone").html("Digits Only").show();
    return false;
  }
});

$("#pPhoneNo").keypress(function (e) {

  //if the letter is not digit then display error and don't type anything
  if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
    //display error message
    //$("#errpphone").html("Digits Only").show();
    return false;
  }
});

$("#mPin").keypress(function (e) {

  if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
    //display error message
   // $("#errPin").html("Digits Only").show();
    return false;
  }

});

$("#pPin").keypress(function (e) {

  if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
    //display error message
   // $("#errPPin").html("Digits Only").show();
    return false;
  }

});

$("#mobileNo").keypress(function (e) {

  if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
    //display error message
    //$("#errmobile").html("Digits Only").show();
    return false;
  }

})


$("#rmopNo").keypress(function (e) {

  if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
    //display error message
    $("#errRmopNo").html("Digits Only").show();
    $("#errRmopNo").fadeOut(4000);
    return false;
  }

})


$("#smopNo").keypress(function (e) {

  if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
    //display error message
    //$("#errSmopNo").html("Digits Only").show();
    //$("#errSmopNo").fadeOut(4000);
    return false;
  }

})

$("#workphn").keypress(function (e) {

  if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
    //display error message
   // $("#errorworkphn").html("Digits Only").show();
   // $("#errorworkphn").fadeOut(4000);
    return false;
  }

})

$("#workphnExt").keypress(function (e) {

  if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
    //display error message
   // $("#errorworkphnExt").html("Digits Only").show();
   // $("#errorworkphnExt").fadeOut(4000);
    return false;
  }

})
 function checkEmail() {
    var email = document.getElementById('recipient');
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!filter.test(email.value)) {
    alert('Please provide a valid email address');
    email.focus;
    return false;
    }
    else
    {
   return true;
    }
    }
	
	$('.jq_teamMembersCalendar').change(function(){
  $('#emp_code').val($(this).val());
  Calendar.init();
});

	
	
	