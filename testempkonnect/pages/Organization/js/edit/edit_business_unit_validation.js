var FormValidation = function () {
       //Basic validation
        var handleValidation1 = function() {
        var form1 = $('#form_sample_2');
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
                        //minlength: 3,
                        required: true
                    }
                    // bussPin:{
                    //   required: false,
                    //   number: true,
                    //   minlength: 6,
                    //   maxlength: 6
                    // },

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
                submitHandler:  function (form) {
                      var url = "ajax/editData.php?pagetype=edit_business_unit";
                      var formData = $(form).serialize();
                      $.post(url, formData).done(function (data) {
                            success1.show();
                            error1.hide();
                          // console.log(data);
                         $("#form_sample_2")[0].reset();
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
function myFunction(bussCode){
    $.ajax({type:"POST",url: "content/edit/edit_bussiness_unit.php?pagetype=edit_business_unit&BUSSID="+bussCode, success: function(result){
    $('#edit').show();
        $('#edit').html(result);
        $('#large1').modal('show');
  	FormValidation.init();
          return false;
      }});
}