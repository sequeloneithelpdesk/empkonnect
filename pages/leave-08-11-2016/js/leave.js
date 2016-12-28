var Leave={

	init:function(){
		$.ajax({
                type: "POST",
                url: "ajax/leave_function.php?type=showleave",
                data: {},
                 beforeSend: function(){
                loading();
            },
                success: function(result){
                    //alert (result);
                    unloading();
                    $("#leave_b").html(result);
                    					
                }
            });

	},
	initteam:function(){
		var code=$('#L_team').val();
		var type1=$('#T_team').val();
		var start=$('#startDate').val();
		var end=$('#endDate').val();
		$.ajax({
                type: "POST",
                url: "ajax/leave_function.php?type=showteamleave",
                data: {code:code,type1:type1,start:start,end:end},
                 beforeSend: function(){
                loading();
            },
                success: function(result){
                    //alert (result);
                    unloading();
                    $("#leave_b").html(result);
                    
					
                }
            });

	},
	showmyteam:function(){
		$.ajax({
                type: "POST",
                url: "ajax/leave_function.php?type=showteam",
                data: {},
                 beforeSend: function(){
                loading();
            },
                success: function(result){
                    //alert (result);
                    unloading();
                    $("#leave_team").html(result);
                    Leave.leave_type();

                }
            });
	},

	leave_type:function(){
		var code=$('#L_team').val();
		//alert(code);
		$.ajax({
                type: "POST",
                url: "ajax/leave_function.php?type=showtype",
                data: {code:code},
                 beforeSend: function(){
                loading();
            },
                success: function(result){
                  //  alert (result);
                    unloading();
                    $("#leave_type").html(result);

                    Leave.initteam();
					Leave.transaction(0);

                }
            });
	},
	transaction:function(flag){
//alert(flag);
		var code=$('#L_team').val();
		var type1=$('#T_team').val();
        //alert(type1);
		var start=$('#startDate').val();
            var end=$('#endDate').val();
            //alert("start="+start+"end="+end);
       if(type1 =='all' && flag==0)
        {
            
        }
        else
        {
           // alert("q");
            if (type1 == "all") {
            toasterrormsg("Please Select Leave Type");
             return false;
            }
            if (start == "") {
            toasterrormsg("Please Select Start Date");
             return false;
            }

          var end=$('#endDate').val();
            if (end == "") {
            toasterrormsg("Please Select End Date");
             return false;
            }
           
     }
 
		//alert("sac"+code+type1+start+end);
		$.ajax({
                type: "POST",
                url: "ajax/leave_function.php?type=showtran",
                data: {code:code,type1:type1,start:start,end:end},
                 beforeSend: function(){
                loading();
            },
                success: function(result){
               //     alert (result);
                     Leave.initteam();
                    unloading();
                    $("#sample_2").html(result);
                    					
                }
            });
	},
	bal:function(){
		$('#tab_1').removeClass("inactive").addClass("active");

		$('#tab_2').addClass("inactive");
		$('.tab1_col').css("border-bottom",'2px solid #5b9bd1');
		$('.tab2_col').css("border-bottom",'none');
		
	},

	tran:function(){
		$('#tab_2').removeClass('inactive').addClass("active");
		$('#tab_1').addClass( "inactive" );
		$('.tab2_col').css("border-bottom",'2px solid #5b9bd1');
		$('.tab1_col').css("border-bottom",'none');

		
		
	},
    upcome:function(){
        $('#upholi').css("display",'block') ;
        $('#pastholi').css("display",'none') ;
        $('#upcome').css("border-bottom",'2px solid #5b9bd1');
        $('#pastcome').css("border-bottom",'none');
        
    },

    pastcome:function(){
        $('#pastholi').css("display",'block') ;

        $('#upholi').css("display",'none') ;
        $('#pastcome').css("border-bottom",'2px solid #5b9bd1');
        $('#upcome').css("border-bottom",'none');

        
        
    },
		myleave:function(id){
	$.ajax({
                type: "POST",
                url: "ajax/leave_function.php?type=showmyleave",
                data: {id:id},
                success: function(result){
                    //alert (result);
                    
                    $("#my_leave").html(result);
                    					
                }
            });

	
	},
     holiday:function(id){
        $.ajax({
                type: "POST",
                url: "ajax/leave_function.php?type=showholiday",
                data: {id:id},
                success: function(result){
                    //alert (result);
                    
                    $("#show_holiday").html(result);
                                        
                }
            });
    },
   getAllEventsTypes:function(id){

        $.ajax({
                type: "POST",
                url: "ajax/leave_function.php?type=getAllEventsTypes",
                data: {id:id},
                success: function(result){
                  //  alert (result);
                    
                    $("#getLeaveTypePolicy11").html(result);
                                        
                }
            });
    }
}