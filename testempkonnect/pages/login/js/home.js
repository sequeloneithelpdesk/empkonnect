    $("#search").autocomplete({
        source: "search.php", // name of controller followed by function
        change: function( event, ui ) {
            console.log(event);
            console.log(ui);
            var value_search = $( "#search" ).val();
            if(value_search !=''){
                var ALL_data = "search=" + value_search + "&flag_value=" +'1';
                $.ajax({
                    type: "POST",
                    url: "ajax/home_ajax.php",
                    data: ALL_data,
                    success: function (html) {
                        $("#search_block").css("height","200px");
                        $(".slimScrollDiv").css("height","200px");
                        $("#search_block").html(html);
                    }
                });
            }
        }

    }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
        var inner_html = '<a>' +
            '<div class="list_item_container">' +
            '<img class="img-circle" src="../../pages/Profile/upload_images/' + item.image + '" height="42" width="42">' + '<span class="kEmpNam"> ' + item.label + '</span><span class="kEmpCod">' + item.description + '</span> </div></a>';

        return $( "<li></li>" )
            .data( "item.autocomplete", item )
            .append(inner_html)
            .appendTo( ul );
    };

$("#newjoinee_search").autocomplete({
    source: "newjoinee.php" // name of controller followed by function
}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
    var inner_html = '<a><div class="list_item_container">' +
        '<img class="img-circle" src="../../pages/Profile/upload_images/' + item.image + '" height="42" width="42">' + '<span class="kEmpNam"> ' + item.label + '</span><span class="kEmpCod"> ' + item.description + '</span></div></a>';
    return $( "<li></li>" )
        .data( "item.autocomplete", item )
        .append(inner_html)
        .appendTo( ul );
};

$("#birthday_search0").autocomplete({
    source: function(request, response) {
        $.getJSON(
            "birthday.php",
            { term:request.term, extraParams:'0' },
            response
        );
    }
   // name of controller followed by function
}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
    var inner_html = '<a>' +
        '<div class="list_item_container">' +
        '<img class="img-circle" src="../../pages/Profile/upload_images/' + item.image + '" height="42" width="42">' + '<span class="kEmpNam"> ' + item.label + '</span><span class="kEmpCod"> ' + item.description + '</span></div></a>';
    return $( "<li></li>" )
        .data( "item.autocomplete", item )
        .append(inner_html)
        .appendTo( ul );
};

$("#birthday_search1").autocomplete({
    source: function(request, response) {
        $.getJSON(
            "birthday.php",
            { term:request.term, extraParams:'1' },
            response
        );
    }
    // name of controller followed by function
}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
    var inner_html = '<a><div class="list_item_container">' +
        '<img class="img-circle" src="../../pages/Profile/upload_images/' + item.image + '" height="42" width="42">' + '<span class="kEmpNam"> ' + item.label + '</span><span class="kEmpCod"> ' + item.description + '</span></div></a>';
    return $( "<li></li>" )
        .data( "item.autocomplete", item )
        .append(inner_html)
        .appendTo( ul );
};

$("#birthday_search2").autocomplete({
    source: function(request, response) {
        $.getJSON(
            "birthday.php",
            { term:request.term, extraParams:'2' },
            response
        );
    }
    // name of controller followed by function
}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
    var inner_html = '<a><div class="list_item_container">' +
        '<img class="img-circle" src="../../pages/Profile/upload_images/' + item.image + '" height="42" width="42">' + '<span class="kEmpNam"> ' + item.label + '</span><span class="kEmpCod"> ' + item.description + '</span></div></a>';
    return $( "<li></li>" )
        .data( "item.autocomplete", item )
        .append(inner_html)
        .appendTo( ul );
};

var manager_teamsearch = $( "#hidden_mng" ).val();
$("#myteam_search").autocomplete({
    source: function(request, response) {
        $.getJSON(
            "myteam.php",
            { term:request.term, extraParams:manager_teamsearch },
            response
        );
    }
    // name of controller followed by function
}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
    var inner_html = '<a><div class="list_item_container">' +
        '<img class="img-circle" src="../../pages/Profile/upload_images/' + item.image + '" height="42" width="42">' + '<span class="kEmpNam"> ' + item.label + '</span><span class="kEmpCod"> ' + item.description + '</span></div></a>';
    return $( "<li></li>" )
        .data( "item.autocomplete", item )
        .append(inner_html)
        .appendTo( ul );
};




$( "#search_emp" ).click(function( event ) {
    var value_search = $( "#search" ).val();
  //  alert(value_search);
    if(value_search !=''){
        var ALL_data = "search=" + value_search + "&flag_value=" +'1';

        $.ajax({
            type: "POST",
            url: "ajax/home_ajax.php",
            data: ALL_data,
            success: function (html) {
                //alert(html);
                $("#search_block").css("height","200px");
                $(".slimScrollDiv").css("height","200px");
                //alert('1');
                $("#search_block").html(html);


            }
        });
    }

});

//helo

/*$('#search').on('blur',function(e) {
    if ( e.which == 13) {
        var value_search = $( "#search" ).val();
        if(value_search !=''){
            var ALL_data = "search=" + value_search + "&flag_value=" +'1';
            $.ajax({
                type: "POST",
                url: "ajax/home_ajax.php",
                data: ALL_data,
                success: function (html) {
                    $("#search_block").css("height","200px");
                    $(".slimScrollDiv").css("height","200px");
                    $("#search_block").html(html);
                }
            });
        }

    }
});*/


$( "#search_newjoinee" ).click(function( event ) {
    var value_search = $( "#newjoinee_search" ).val();

    if(value_search != ''){
        var ALL_data = "search=" + value_search + "&flag_value=" +'2';
        

        $.ajax({
            type: "POST",
            url: "ajax/home_ajax.php",
            data: ALL_data,
            success: function (html) {

                $("#newjoinee_result").html(html);
                 $('#new_joinee').addClass('searchResToggle');

            }
        });
    }

});
$( "#newjoinee_search" ).live('keypress',function(e) {
    if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {

        var value_search = $("#newjoinee_search").val();

        if (value_search != '') {
            var ALL_data = "search=" + value_search + "&flag_value=" + '2';

            $.ajax({
                type: "POST",
                url: "ajax/home_ajax.php",
                data: ALL_data,
                success: function (html) {

                    $("#newjoinee_result").html(html);


                }
            });
        }
    }
});
$( "#search_birthday0" ).click(function( event ) {
    var value_search = $( "#birthday_search0" ).val();

    if(value_search != ''){
        var ALL_data = "search=" + value_search + "&flag_value=" +'3';

        $.ajax({
            type: "POST",
            url: "ajax/home_ajax.php",
            data: ALL_data,
            success: function (html) {

                $("#birthday0_result").html(html);
            }
        });
    }

});
$( "#birthday_search0" ).live('keypress',function(e) {
    if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {

        var value_search = $( "#birthday_search0" ).val();

        if(value_search != ''){
            var ALL_data = "search=" + value_search + "&flag_value=" +'3';

            $.ajax({
                type: "POST",
                url: "ajax/home_ajax.php",
                data: ALL_data,
                success: function (html) {

                    $("#birthday0_result").html(html);
                }
            });
        }
    }
});
$( "#search_birthday1" ).click(function( event ) {
    var value_search = $( "#birthday_search1" ).val();

    if(value_search != ''){
        var ALL_data = "search=" + value_search + "&flag_value=" +'4';

        $.ajax({
            type: "POST",
            url: "ajax/home_ajax.php",
            data: ALL_data,
            success: function (html) {

                $("#birthday1_result").html(html);
            }
        });
    }

});
$( "#birthday_search1" ).live('keypress',function(e) {
    if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
        var value_search = $( "#birthday_search1" ).val();

        if(value_search != ''){
            var ALL_data = "search=" + value_search + "&flag_value=" +'4';

            $.ajax({
                type: "POST",
                url: "ajax/home_ajax.php",
                data: ALL_data,
                success: function (html) {

                    $("#birthday1_result").html(html);
                }
            });
        }

    }
});
$( "#search_birthday2" ).click(function( event ) {
    var value_search = $( "#birthday_search2" ).val();

    if(value_search != ''){
        var ALL_data = "search=" + value_search + "&flag_value=" +'5';

        $.ajax({
            type: "POST",
            url: "ajax/home_ajax.php",
            data: ALL_data,
            success: function (html) {

                $("#birthday2_result").html(html);
            }
        });
    }

});
$( "#birthday_search2" ).live('keypress',function(e) {
    if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
        var value_search = $( "#birthday_search2" ).val();

        if(value_search != ''){
            var ALL_data = "search=" + value_search + "&flag_value=" +'5';

            $.ajax({
                type: "POST",
                url: "ajax/home_ajax.php",
                data: ALL_data,
                success: function (html) {

                    $("#birthday2_result").html(html);
                }
            });
        }

    }
});
$( "#search_myteam" ).click(function( event ) {
    var value_search = $( "#myteam_search" ).val();
    var manager = $( "#hidden_mng" ).val();

    if(value_search != ''){
        var ALL_data = "search=" + value_search + "&manager=" + manager + "&flag_value=" +'6';

        $.ajax({
            type: "POST",
            url: "ajax/home_ajax.php",
            data: ALL_data,
            success: function (html) {

                $("#myteam_result").html(html);

            }
        });
    }

});
$( "#myteam_search" ).live('keypress',function(e) {
    if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {

        var value_search = $( "#myteam_search" ).val();
        var manager = $( "#hidden_mng" ).val();

        if(value_search != ''){
            var ALL_data = "search=" + value_search + "&manager=" + manager + "&flag_value=" +'6';

            $.ajax({
                type: "POST",
                url: "ajax/home_ajax.php",
                data: ALL_data,
                success: function (html) {

                    $("#myteam_result").html(html);

                }
            });
        }
    }
});
$('#close_newjoinee').click(function(){
  $('.empSearchResultCon').toggleClass('searchResToggle');
  $('#new_joinee').toggleClass('searchResToggle');
  $(this).toggleClass('changerTxt')

});


$( "#close_myteam" ).click(function( event ){
    $("#myteam_result").hide();


});
$( "#close_birthday0" ).click(function( event ){
    $("#birthday0_result").hide();


});
$( "#close_birthday1" ).click(function( event ){
    $("#birthday1_result").hide();


});
$( "#close_birthday2" ).click(function( event ){
    $("#birthday2_result").hide();


});


function editInfo(value_action,Email_id,name,code)
{
//alert(value_action);
    if(Email_id !='')
    {
        var ALL_data = "value_action=" + value_action + "&Email_id=" + Email_id+ "&name=" + name+ "&code=" + code+ "&flag_value=7";

        $.ajax({
            type: "POST",
            url: "wishes_template.php",
            data: ALL_data,
            beforeSend: function(){
                loading();
            },
            success: function (result) {
                unloading();
                $('#wishtemplate').show();
                $('#wishtemplate').html(result);
                $('#large1').modal('show');
              
                return false;

            }
        });
    }
    else{
        alert('Email id not available');
    }
}

