
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
      window.location.href = "../login/home";
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
  },

  SpecialChar: function (myStringID)
{
  // declare which special chars to validate
  var illegalChars = "!@#$%^&*()+=-[]\\\';,./{}|\":<>?";
  var strToSearch = document.getElementById(myStringID).value;

  for (var i = 0; i < strToSearch.length; i++)
  {
    if (illegalChars.indexOf(strToSearch.charAt(i)) != -1)
    {
      str=strToSearch.slice(0, -1);
      $("#"+myStringID).val(str);
      $("#err").removeClass('display-hide');
      $("#err").html('<button class="close" data-close="alert"></button> <br>Special characters are not allowed.');
      setTimeout(function(){ $("#err").addClass('display-hide'); }, 2000);
    }
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

