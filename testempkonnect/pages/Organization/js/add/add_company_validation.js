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
            messages: {
                select_multi: {
                    maxlength: jQuery.validator.format("Max {0} items allowed for selection"),
                    minlength: jQuery.validator.format("At least {0} items must be selected")
                }
            },
            rules: {
                compName: {
                    required: true
                },
                compAddr: {
                    required: true
                },
                compCountry: {
                    required: true
                    //url: true
                },
                compState: {
                    required: true
                    //number: true

                },
                compCity: {
                    required: true
                    //number: true

                },
                compPhone: {
                    required: true,
                    number: true

                },
                compPin:{
                    required: true,
                    number: true,
                    minlength: 6,
                    maxlength: 6
                },
                PFNo: {
                    required: true
                   // number: true

                },
                ESINo: {
                    required: true
                    // number: true

                },
                PANNo: {
                    required: true
                    // number: true

                },
                TANNo: {
                    required: true
                    // number: true

                },
                TDSCircle: {
                    required: true
                    // number: true

                },
                TINNo: {
                    required: true
                    // number: true

                },
                RegistNo: {
                    required: true
                    // number: true

                },
                LSTNo: {
                    required: true
                    // number: true

                },
                CSTNo: {
                    required: true
                    // number: true

                },
                STaxNo: {
                    required: true
                    // number: true

                },
                emailId: {
                    required: true
                    // number: true

                },
                CITAddr: {
                    required: true
                    // number: true

                },
                CITCity: {
                    required: true
                    // number: true

                },
                CITPIN: {
                    required: true
                    // number: true

                },
                tableType: {
                    required: true
                    //digits: true
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
                var url = "ajax/add/add_company_ajax.php";
                formData = {};
                var formData = $(form).serialize();
                // console.log(formData);
                $.post(url, formData).done(function (data) {
                    success1.show();
                    error1.hide();
                    //console.log(data);
                    $("#form_sample_1")[0].reset();
                    FormValidation1.init();
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