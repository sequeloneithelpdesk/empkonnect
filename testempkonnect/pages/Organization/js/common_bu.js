/**
 * Created by Lenovo PC on 11-07-2016.
 */

var BU={
    
    init: function(tablename,pre,divid,status,name ){

        $.ajax({
            type : 'POST',
            data:{type:'init',status:status,table:tablename,pre:pre,name:name },
            url  : 'ajax/init_ajax/BU_ajax.php',
            beforeSend: function(){
                loading();
            },
            success: function(responseText){
                unloading();

                $("#"+divid).html(responseText);

                $("#"+divid).DataTable().destroy();

                table_excel(divid);
            }
        });
    },
    changestatus:function (tablename,pre,divid,status,id,name) {
        $.ajax({
            type : 'POST',
            data:{type:'editstatus',status:status,table:tablename,pre:pre,id:id },
            url  : 'ajax/init_ajax/BU_ajax.php',
            beforeSend: function(){
                loading();
            },
            success: function(responseText){
                unloading();
                if(responseText==1){

                    if(status=="1"){
                        var status1="Inactive";
                    }else{
                        var  status1="Active";
                    }
                    $("#"+divid).val(status1);
                    BU.init(tablename,pre,'sample_2',status,name);

                }
                else{
                    alert(responseText);
                }
                //$("#"+divid).html(responseText);


            }
        });

    },

    busubmit:function (type,frm,table,pre,header,valid,validhidreq,pagetype) {
        var formData = $("#"+frm).serialize();

        var v1=$("#"+valid).val();var v2=$("#"+validhidreq+"1").val();var v3=$("#"+validhidreq+"2").val();
        var v4=$("#"+validhidreq+"3").val();var v5=$("#"+validhidreq+"4").val();var v6=$("#"+validhidreq+"5").val();


        var err1=$('#rolename_availability_result').html();
        var err23=$('#result').html();
        //alert(err1);
        if(v1=="1" || v2=="1"||v3=="1" || v4=="1"||v5=="1"|| v6=="1"){
            $("#err").removeClass('display-hide');
            $("#err").html('<button class="close" data-close="alert"></button> <br>Please Fill Mandatory Fields.');
            //$("#"+valid).css('border','red');
        }
        else if(err23=='Code Already taken.' || err23=='Name Already exists.'){
            $("#err").removeClass('display-hide');
            $("#err").html('<button class="close" data-close="alert"></button> <br>Please Fill Unique Value.');
        }
        else {
            $.ajax({ 
                type: 'POST',
                data: formData,
                url: 'ajax/editData.php?pagetype='+pagetype+'&type=' + type,
                beforeSend: function () {
                    loading();
                },
                success: function (responseText) {
                    unloading();
                    if (responseText == 1) {
                        $("#err").addClass('display-hide');
                        $("#succ").removeClass('display-hide');

                        BU.init(table,pre,'sample_2','1',header);

                        setTimeout(function(){ $('#large1').modal('hide'); }, 2000);

                    }
                    if (responseText == 2) {
                        $("#err").removeClass('display-hide');
                        $("#err").html('<button class="close" data-close="alert"></button> <br>Please Fill Unique Value.');
                    }
                    
                    //$("#"+divid).html(responseText);


                }
            });
        }

    },
    checkrolename : function(id,table,col){

        var role_name = $('#'+id).val();
        var cutname=id.substr(id.length-4);
        var newid=id.slice(0,-4);
        //alert(newid);
		//alert(cutname);
        if(role_name.length > 0) {
            $('#rolename_availability_result').html('Loading..');
            $('#subbut').attr('disabled',true);
            //var post_string = 'user_name='+role_name+'&table_name='+table+'&col_name='+col ;
            $.ajax({
                type : 'POST',
                data : {user_name:role_name,table_name:table ,col_name:col},
                url  : 'ajax/namecheck.php',
                success: function(responseText){
                    if(responseText == 0){

                        $('#rolename_availability_result').html('<span class="success" id="result">Available.</span>');
                        if( cutname=='Code'){
                            $('#'+newid+'Name').attr('readonly',false);
                            $('#'+newid+'Name').attr('tabindex','1');

                        }
                        else{
                            $('#'+newid+'Code').attr('readonly',false);
                            $('#'+newid+'Name').attr('tabindex','1');
                        }
                        $('#subbut').attr('disabled',false);

                    }else if(responseText > 0){
                        $('#subbut').attr('disabled',true);
                        $('#rolename_availability_result').html('<span class="error" id="result">'+cutname+' Already exists.</span>');

                        if(cutname=='Code' ){
                            $('#'+newid+'Name').attr('readonly',true);
                            $('#'+newid+'Name').attr('tabindex','-1');
                        }
                        else{
                            $('#'+newid+'Code').attr('readonly',true);
                            $('#'+newid+'Name').attr('tabindex','-1');
                        }


                    }else{
                        alert('Problem with mysql query');
                    }
                }
            });
        }
        else{
            $('#rolename_availability_result').html('');
            $('#subbut').attr('disabled',false);
        }

    },
    locsubmit:function (type,frm) {
        var formData = $("#"+frm).serialize();

        var name=$("#LocName").val();
        var err=$('#rolename_availability_result').html();
        if(name=="" || err==""){
            $("#err").removeClass('display-hide');
            $("#err").html('<button class="close" data-close="alert"></button> <br> You have some form errors. Please check below.');
            $("#bussName").css('border',red);
        }
        else {
            $.ajax({
                type: 'POST',
                data: formData,
                url: 'ajax/editData.php?pagetype=edit_business_unit&type=' + type,
                beforeSend: function () {
                    loading();
                },
                success: function (responseText) {
                    unloading();
                    if (responseText == 1) {

                        BU.init('bussmast','buss','sample_2','1','Business Unit');

                    }
                    else {
                        alert(responseText);
                    }
                    //$("#"+divid).html(responseText);


                }
            });
        }

    }
    
}
