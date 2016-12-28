function display_all()
{
    var checkboxesTiles = document.getElementsByName('params[]');

    var buttonCheckAll = document.getElementById('parambutton');
    //alert(button.value);
    if (buttonCheckAll.value == 'Check All') {
        for (var i in checkboxesTiles) {
            //alert("checked");
            //alert(checkboxesTiles[i].value);
            $('#a' + i +' div span').addClass('checked');
            checkboxesTiles[i].checked = 'FALSE';
        }
        buttonCheckAll.value = 'Uncheck All'
    } else {
        for (var i in checkboxesTiles) {
            checkboxesTiles[i].checked = '';
            $('#a' + i +' div span').removeClass('checked');
        }
        buttonCheckAll.value = 'Check All';
    }

}

function insertParams() {
   
    var checkedparamValue = "";
    var check_param_value = document.getElementsByName('params[]');
    for (i = 0; i < check_param_value.length; i++) {
        if (check_param_value[i].checked) {
            checkedparamValue += check_param_value[i].value + ',';
        }
    }


    //paramValue1 = checkedparamValue.split(",");
    var first_string = "Emp_Code,";
    var first_addparam = first_string.concat(checkedparamValue);
    var add_string = "Trn_WEF,Trn_Date,UpdatedBy";
    paramValue = first_addparam.concat(add_string);
    alert(paramValue);


    var startdate = $( "#hisstartdate" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
    var enddate = $( "#hisenddate" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();


    var dataString = 'paramValue='+ paramValue +
        '&startdate=' + startdate +
        '&enddate=' + enddate ;
    if(paramValue !='' || startdate !='' || enddate !='')
    {
        $.ajax({
            type: "POST",
            url: "ajax/history_ajax.php",
            data: dataString,
            success: function (data) {
                $('#replace').hide();
                $("#show_replace").html(data);
            }
        });
    }


}