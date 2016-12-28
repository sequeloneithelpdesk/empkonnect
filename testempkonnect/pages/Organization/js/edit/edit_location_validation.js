var FormValidation = function () {
    // basic validation
    var handleValidation1 = function() {
        // for more info visit the official plugin documentation: 
            // http://docs.jquery.com/Plugins/Validation
            var form1 = $('#form_sample_2');
            var error1 = $('.alert-danger', form1);
            var success1 = $('.alert-success', form1);

            form1.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                messages: {
                    select_multi: {
                        maxlength: jQuery.validator.format("Max {0} items allowed for selection"),
                        minlength: jQuery.validator.format("At least {0} items must be selected")
                    }
                },
                rules: {
                    locCode: {
                        minlength: 3,
                        required: true,
                        //pattern: "[A-Z]{4}[0-9]{5}"
                    },
                    locName: {
                        minlength: 3,
                        required: true
                    },
                    locType: {
                        required: true,
                        //email: true
                    },
                    locParent: {
                        required: true,
                        //url: true
                    },
                    locWork: {
                        required: true,
                        //number: true
                        
                    },
                    tableType: {
                        required: true,
                        //digits: true
                    },
                },
                
                invalidHandler: function (event, validator) { //display error alert on form submit              
                    success1.hide();
                    error1.show();
                    Metronic.scrollTo(error1, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.col-md-4').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.col-md-4').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    label
                        .closest('.col-md-4').removeClass('has-error'); // set success class to the control group
                },
                submitHandler: 
                function (form) {                  
                      //var url = "ajax/edit/edit_location_ajax.php";
                      var url = "ajax/editData.php?pagetype=edit_location";
                      var formData = $(form).serialize();
                      $.post(url, formData).done(function (data) {
                           success1.show();
                           error1.hide();
                          $("#form_sample_1")[0].reset();
                          location.reload();
                      });
                      }
                     
            });


    }
     return {
        //main function to initiate the module
        init: function () {
            handleValidation1();
        }

    };

}();
function myFunction(oid){
    $.ajax({url: "content/edit/edit_location.php?oid="+oid, success: function(result){
    console.log(result);
    $('#edit').show();
        $('#edit').html(result);
        $('#large1').modal('show');
	FormValidation.init();
        return false;
    }});
}