var FormValidation3 = function () {

    // basic validation
    var handleValidation1 = function() {
        // for more info visit the official plugin documentation: 
            // http://docs.jquery.com/Plugins/Validation

            var form1 = $('#form_sample_5');
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
                    language: {
                      //minlength : 2,
                        required: true
                    },
                                       
                },
                
                invalidHandler: function (event, validator) { //display error alert on form submit              
                    success1.hide();
                    error1.show();
                    Metronic.scrollTo(error1, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.col-md-12').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.col-md-12').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    label
                        .closest('.col-md-12').removeClass('has-error'); // set success class to the control group
                },

                submitHandler: 
                /* function (form) {
                    success1.show();
                    error1.hide();
                } */
                function (form) {                  
                      /* var url = "insertData.php?pagetype=add_sat";
                      var formData = {};
                      $(form).find("input[name]").each(function (index, node) {
                          formData[node.name] = node.value;
                      });
                      $.post(url, formData).done(function (data) {
                          alert (data);
                      }); */
					  var empcode = $("#empCode").val();

                    var language = $("#language").val();
                    if ($("#read").is(":checked")) {
                        var langRead ="Y";
                    }
                    else if ($("#read").is(":not(:checked)")) {
                        var langRead ="N";
                    }
                    if($("#write").is(":checked")){
                        var langWrite = "Y";
                    }
                    else if($("#write").is(":not(:checked)")){
                        var langWrite = "N";
                    }
                    if($("#speak").is(":checked")){
                        var langSpeak = "Y";
                    }
                    else if($("#speak").is(":not(:checked)")){
                        var langSpeak = "N";
                    }
                    if($("#understand").is(":checked")){
                        var understand = "Y";
                    }
                    else if($("#understand").is(":not(:checked)")){
                        var understand = "N";
                    }
                    if($("#motherTongue").is(":checked")){
                        var motherTongue = "Y";
                    }
                    else if($("#motherTongue").is(":not(:checked)")){
                        var motherTongue = "N";
                    }

                     //var data = $("#form_sample_5").serialize()+"&empcode="+empcode;
					 //console.log(data);
					 //data.push({empcode:empcode});
		


                      $.ajax({
                        type : 'POST',
                        url  : 'ajax/insertData.php?pagetype=addLanguage',
                        data : {empcode:empcode, language:language, langRead:langRead, langWrite:langWrite, langSpeak:langSpeak, understand:understand, motherTongue:motherTongue},
                        success :  function(data){
                            alert(data);
                            if(data == "noEmp"){
                                $('#errorLang').show();
                                $('#portlet-config2').modal('hide');
                            }else {
                                $('#viewData3').html(data);
                                $('#portlet-config3').modal('hide');
                            }
                        }
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