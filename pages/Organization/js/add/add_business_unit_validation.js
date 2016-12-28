var FormValidation1 = function () {
    // basic validation
    var handleValidation1 = function() {
        // for more info visit the official plugin documentation: 
        // http://docs.jquery.com/Plugins/Validation
            var form1 = $('#form_sample_1');
            var error1 = $('.alert-danger', form1);
            var success1 = $('.alert-success', form1);
            form1.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                messages: "",
                rules: {

                    bussName: {
                        minlength: 3,
                        required: true
                    }
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
                submitHandler: function (form) {
                     // var url = "ajax/insertData.php?pagetype=add_business_unit";
                     var url = "ajax/add/add_business_unit_ajax.php";
                     var formData = $(form).serialize();
                     // console.log(formData);
                    $.post(url, formData).done(function (data) {
                        success1.show();
                        error1.hide();
                        //console.log(data);
                        $("#form_sample_1")[0].reset();
                        FormValidation1.init();
                        //location.reload();
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