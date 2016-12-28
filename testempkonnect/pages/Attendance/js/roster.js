/*--------------Start Work Flow Configuration--------*/
var data ="";
var Roster={
    init:function(){
        //alert("h");
        $.ajax({
            type:"POST",
            url:"../admin/ajax/role_menuajax.php?type=data",
            dataType : 'json',
            cache: false,
            beforeSend: function(){
                loading();
            },
            success: function(result){
                unloading();
                //console.log(result);
                //alert(result);
                data=result;
                Roster.showdefault();
                //$('#datamenu').jstree(true).refresh();

            }
        });
    },
	
	createRoster : function(){
		$("#rosterform").hide("slow");

		ros.resetall();
		$("#rosterform").show("slow");
		
	},
	editRoster : function(){
		$("#rosterform").hide("slow");
		 
		var value = $("#editrosterselect").val();
		if(!value){
			toasterrormsg("Please Select Roster");
			return false;
			
		}
		
		$.ajax({
            type:"POST",
            url:"ajax/Roster_ajax.php?type=getrostervalue",
	 
			data: {value:value},
            cache: false,
            beforeSend: function(){
                loading();
            },
            success: function(result){
				unloading();  
 
				result = JSON.parse(result);
				ros.resetall(); 
				ros.editdata(result,value);
				$("#rosterform").show("slow");
            }
        });
		
		
	},

    showdefault: function (){	
        var tblName = $("#forWhome").val();

        //console.log(data);
        $.ajax({
            type: "POST",
            url: "ajax/Roster_ajax.php?type=defaultValue",
            data: {tblName:tblName,data:data},
            success: function(result){
                //alert (result);
                //console.log(result);
                $("#showsuboption").html(result);
            }
        });
    },

    checkevent: function (clicked){
        var tblName = $("#forWhome").val();
        if(clicked.checked){
            xyx = clicked.value;
            //alert(clicked.value);
            $.ajax({
                type: "POST",
                url: "ajax/Roster_ajax.php?type=showdata",
                data: {tblName:tblName,childval:xyx,data:data },
                dataType : 'json',
                success: function(result){
                    //alert (result);
                    data=result;
                    //console.log(data);
                    //$("#showsuboption").html(result);
                }
            });
        }
        else{
            xyx = clicked.value;
            //alert(clicked.value);
            $.ajax({
                type: "POST",
                url: "ajax/Roster_ajax.php?type=hidedata",
                data: {tblName:tblName,childval:xyx,data:data },
                dataType : 'json',
                success: function(result){
                    //alert (result);
                    data=result;
                    //console.log(data);
                    //$("#showsuboption").html(result);
                }
            });
        }
        // alert (tblName);

    },
    par_del:function(parid){
		var parent1 = data[parid];
		data[parid]['state']['selected'] = 'true';
		var children = data[parid]['children'];
		for(var x in children){
			data[parid]['children'][x]['state']['selected'] = 'true';
			$('.checkclass_'+parid+'_'+x).attr("checked",false);
		}
		Roster.addConfirm();
		return false;
        //alert(parid);
        $.ajax({
            type: "POST",
            url: "ajax/Roster_ajax.php?type=imp_finaldata&pid="+parid,
            data: {data:data },
            dataType : 'json',
            success: function(result){
                data= result;
                //console.log(data);
                Roster.addConfirm();
                Roster.showdefault();
                
            }
        });
    },
    child_del:function(parid,chid){
		data[parid]['children'][chid]['state']['selected'] = 'true';
		$('.checkclass_'+parid+'_'+chid).attr("checked",false);
		var children = data[parid]['children'];
		var count = 0;
		for(var x in children){
			var cstate = children[x]['state']['selected'];
				if(cstate == 'show'){
					count++;
				}
		}
		if(count == 0){
			data[parid]['state']['selected'] = 'true';
		}
		Roster.addConfirm();
		return false;
       $.ajax({
            type: "POST",
            url: "ajax/Roster_ajax.php?type=child_finaldata&pid="+parid+"&chid="+chid,
            data: {data:data },
            dataType : 'json',
            success: function(result){
                data= result;
                //console.log(data);
                Roster.addConfirm();
                Roster.showdefault();
                
            }
        });
    },
    addConfirm: function (){
		var html = '<ul>';
		for(var i in data){
			var state = data[i]['state']['selected'];
			if(state != 'show'){
				continue;
			}
			var textp = data[i]['text'];
			html += '<li style="display:table;width:100%">';
			html += '<div class="col-md-8">'+textp+'</div>';
			html += '<a onclick="Roster.par_del('+i+')"><i class="fa fa-times"></i></a>';
			var children = data[i]['children'];
			html += '<ul>';
			for(var x in children){
				var cstate = children[x]['state']['selected'];
				if(cstate != 'show'){
					continue;
				}
				var texta = children[x]['text'];
				html += '<li style="display:table;width:100%">';
				html += '<div class="col-md-8">'+texta+'</div>';
				html += '<a onclick="Roster.child_del('+i+','+x+')"><i class="fa fa-times"></i></a>';
				html += '</li>';
				
 
			}
			html += '</ul>';
			html += '</li>';
		}
		html += '</ul>';
		 $('#showConfirm').html(html);
		
		
		
		
		console.log(data);
		return false;
		
		
		
        $.ajax({
            type: "POST",
            url: "ajax/Roster_ajax.php?type=finaldata",
            data: {data:data },
            success: function(result){
                //alert (result);
                //console.log(result);
                // data=result;
                $('#showConfirm').html(result);
                //console.log(data);
            }
        });
    },

    addemp:function(type,code){
        var d=$('#hiddata').val();
        $.ajax({
            type: "POST",
            url: "ajax/Rosterlist_ajax.php?type="+type,
            data: {data:data ,d:d},
            beforeSend: function(){
                loading();
            },
            success: function(result){
                unloading();
                //console.log(result);
                
                $("#empshowdiv").css('display','block');
                if(result==2){
                    $("#empshowdiv").html("No employee mapped.");
                    $("#selall").css('display','none');

                }
                else{
                    
                    if(type=='bulk'){
                        $('.rost_showdiv').css('display','block');
                        $('#s2id_select2_sample2').css('display','block');
                        $('#selectemp').css('display','none');
                    $('#select2_sample2').html(result);
                    $('#selall').html('Select All');
                    $('#selall').attr('onclick',"Roster.addemp('all')");
                    $('#checkhid_r').val('');
                    $('#rostemp').val('bulk');
                    
                }
                else{   

                         $('.rost_showdiv').css('display','block');
                        $('#s2id_select2_sample2').css('display','none');
                        $('#select2_sample2').css('display','none');
                        $('#selectemp').css('display','block');
                        $('#selectemp').html(result);
                        $('#selall').html('Unselect All');
                        $('#selall').attr('onclick',"Roster.addemp('bulk')");
                        $('#select2_sample2').empty();
                        $("#select2_sample2 option:selected").prop("selected", false);
                    $('#select2_sample2').val('');
                        $('#rostemp').val('all');
                }
                }

                //console.log(data);
            }
        });
    },
    checkrolename : function(id,table,col){

        var role_name = $('#'+id).val();
        
        if(role_name.length > 0) {
            $('#rolename_availability_result').html('Loading..');
            $('#emproster').attr('disabled',true);
            //var post_string = 'user_name='+role_name+'&table_name='+table+'&col_name='+col ;
            $.ajax({
                type : 'POST',
                data : {user_name:role_name,table_name:table ,col_name:col},
                url  : '../Organization/ajax/namecheck.php',
                success: function(responseText){
                    if(responseText == 0){

                        $('#rolename_availability_result').html('<span class="success" id="result">Available.</span>');
                        $('#'+id).css('border','1px solid #000000');
                        $('#emproster').attr('disabled',false);

                    }else if(responseText > 0){
                        $('#emproster').attr('disabled',true);
                        
                        $('#'+id).css('border','1px solid #FF0000');
                        $('#rolename_availability_result').html('<span class="error" id="result">Name Already exists.</span>');

                    }else{
                        alert('Problem with mysql query');
                    }
                }
            });
        }
        else{
            $('#rolename_availability_result').html('');
            $('#emproster').attr('disabled',false);
        }

    },
    mngr:function(){

        $.ajax({
            type: "POST",
            url: "ajax/roster_manager_ajax.php?type=mngrdata",
            data: { },
            beforeSend: function(){
                loading();
            },
            success: function(result){
                unloading();
                //console.log(result);
                if(result==1){
                    $('#rost_org').css("display",'none');
                    $('#rost_confirm').css("display",'none');
                    $('#hiddata').val("mngr");
                    Roster.addemp('bulk');

                }
                else{
                    $('#rost_org').css("display",'block');
                    $('#rost_confirm').css("display",'block');
                    $('#hiddata').val("");

                }
                
            }
        });

    },
    
    submitrost:function(){
        
        var workName=$("#workName").val(); 
        var rostemp=$('#rostemp').val();
        if(rostemp=="bulk"){
            var emp=$("#select2_sample2").val();
            emp=emp.toString();
        }
        else{
        var emp=$("#checkhid_r").val(); 

        }
        
        //alert(emp2);
        var dfrom=$("#dfrom").val(); 
        var dto=$("#dto").val(); 
        var rshift=$("#rshift").val();        
        var rshiftp=$("#rshiftp").val();
        var auto_p=$("#auto_p").val(); 
        var v1=$("#errorhid").val();var v2=$("#errorhidreq1").val();var v3=$("#errorhidreq2").val();
        var v4=$("#errorhidreq3").val();var v5=$("#errorhidreq4").val();var v6=$("#errorhidreq5").val();
        

        if(emp==""||rshift==""||rshiftp==""){
            $("#err").removeclass('display-hide');
            $("#err").html("Please Fill Mandetory Fields.");
        }
        else{
        $.ajax({
            type: "POST",
            url: "ajax/Roster_ajax.php?type=subdata",
            data: {workName:workName,emp:emp,dfrom:dfrom,dto:dto,rshift:rshift,rshiftp:rshiftp,auto_p:auto_p},
            beforeSend: function(){
                loading();
            },
            success: function(result){
                unloading();
                //console.log(result);
                toastmsg("successfully Submitted");
                //$("#err").addClass('display-hide');
                //$("#succ").removeClass('display-hide');

            }
        });
    }
        
    },
    autocheck:function(autocheckbtn){
        if(autocheckbtn.checked){
            $('#auto_p').val('1');
            //alert(1);

        }
        else{
            $('#auto_p').val('0');
            //alert(0);

        }
    },
    selallcancle: function(id){
        $('#licon'+id).css('background-color','#eee')
        $('#canclebtn'+id).css('display','none');
        $('#addbtn'+id).css('display','block');
        var hidval=$('#checkhid_r').val();
        arrval=hidval.split(',');
        arrval.splice( $.inArray(id,arrval) ,1 );
        $('#checkhid_r').val(arrval);
        //alert(arrval);
    },
    selallsubmit: function(id2){
        $('#licon'+id2).css('background-color','#fff')
        $('#canclebtn'+id2).css('display','block');
        $('#addbtn'+id2).css('display','none');

        var hidval=$('#checkhid_r').val();
        //alert(hidval);
        if(hidval==""){
            var arrval = id2;
        }
        else{

        var arrval=hidval.split(',');
     
        arrval[arrval.length] = id2
       // arrval=arrval.push('hhhh');
         //console.log(arrval);
     }
    
        $('#checkhid_r').val(arrval);
        
    }


}


/*--------------End Work Flow Configuration--------*/

var ros = {
	 savedata : {},
	 edit : 0,
    init : function(edit,data){
		if(edit){
			ros.edit = 1;
		}else{
			ros.edit = 0;
		}
        var datefrom = $("#dfrom").val();
        var dateto = $("#dto").val();
		var o1 = $("#select2_sample2").val();
		var r_name = $("#workName").val();
		if(!r_name){
			toasterrormsg("Please fill Roster Name");
			return false;
		}
		
		if(o1){
			o1 =  o1.toString();
		}
		var o2 = $("#checkhid_r").val();
		if(o2){
			o1 = o2;
		}
		
		if(!o1){
			toasterrormsg("No Employee Selected");
			return false;
		}
		ros.r_name = r_name;
		ros.names = o1;
		
        if(!datefrom || !dateto){
              toasterrormsg("Please fill date");
              return false;
        }
        var Startdate = moment(datefrom, "DD/MM/YYYY").format('YYYY-MM-DD');
        var Enddate = moment(dateto, "DD/MM/YYYY").format('YYYY-MM-DD');
        if(Enddate < Startdate){
            toasterrormsg("start date should be less than end date");
            return false;
        }
		
        if(edit){
	 
			ros.savedata = JSON.parse(JSON.stringify(data['RosterDate']));
			
		}else{
			ros.savedata = {};
		}
		console.log(ros.savedata);
        ros.startdate = Startdate;
        ros.enddate = Enddate;
		if(edit){
			dateA = [];
			for(var datn in ros.savedata){
				dateA.push(datn);
			}
		}else{
			var dateA = getDatesRangeArray(Startdate, Enddate);
		}
		var html = '';
		var op1 = '<option value = "">-- Select Shift --</option>';
		var op2 = '<option value = "">-- Select Shift Pattern--</option>';
		for(var So in shiftM){
			op1 += '<option value = "'+So+'">'+shiftM[So]+'</option>';
		} 
		for(var Spm in ShiftpatternM){
			op2 += '<option value = "'+Spm+'">'+ShiftpatternM[Spm]+'</option>';
		} 

        html = '<div class="form-group edithide"><div class="col-md-12 " ><div class="col-md-3"><h4>Select All Shift & Pattern</h4> </div><div class="col-md-3"><select id="date" class="form-control editmenu" onchange="ros.tempsavearray(this.value,\'All\',\'SM\')">'+op1+'</select></div><div class="col-md-3"><select id="date" class="form-control editmenu" onchange="ros.tempsavearray(this.value,\'All\',\'SP\')">'+op2+'</select></div></div></div></div>';
		
		for(var i in dateA){ 
			html += '<div class="form-group"><div class="col-md-12" ><div class="col-md-3"><h4>Date</h4><h4>'+moment(dateA[i]).format('DD MMM ( dddd )')+'</h4></div><div class="col-md-3"><h4>Applicable Shift:</h4><select id="date" class="form-control optiontype_SM editmenu" onchange="ros.tempsavearray(this.value,\''+dateA[i]+'\',\'SM\')">';
			
			html += '<option value = "">-- Select Shift --</option>';
			for(var So in shiftM){
				var sel = ''
				if(ros.savedata && ros.savedata[dateA[i]]){
					var SMM = ros.savedata[dateA[i]]["SM"];
					if(SMM == So){
						 sel = 'selected';
					}
					
				}
				html += '<option value = "'+So+'" '+sel+'>'+shiftM[So]+'</option>';
			} 
			
			html +='</select><div id="err'+dateA[i]+'SM"  style="color:red"></div></div><div class="col-md-3"><h4>Applicable Shift Pattern:</h4><select id="date" class="form-control optiontype_SP editmenu" onchange="ros.tempsavearray(this.value,\''+dateA[i]+'\',\'SP\')">';
			html += '<option value = "">-- Select Shift Pattern--</option>';
			for(var Spm in ShiftpatternM){
				var sel = ''
				if(ros.savedata && ros.savedata[dateA[i]]){
					var SMM = ros.savedata[dateA[i]]["SP"];
					if(SMM == Spm){
						 sel = 'selected';
					}
					
				}
				html += '<option value = "'+Spm+'" '+sel+'>'+ShiftpatternM[Spm]+'</option>';
			}
			
			html +='</select><div id="err'+dateA[i]+'SP" style="color:red"></div></div></div></div>';
		}
		if(edit){
			
			$("#auto_p").attr("checked",data['auto_period']);
		}
		
		 
		$("#addroster_M").html(html);
		$(".allsubmit").show();

    },
	tempsavearray : function(value,date,type){
		if(date == 'All'){
            for(var da in ros.savedata){
                ros.savedata[da][type] = value;
                ros.errorcheck(value,date,type);
               
            }
             $(".optiontype_"+type).val(value);

        }else{
		  ros.savedata[date][type] = value;
          ros.errorcheck(value,date,type);
        }
		//console.log();
	},
	errorcheck : function(value,date,type){
		$("#err"+date+type).html("");
		if(!value){
			$("#err"+date+type).html("This cant be empty");
			return false
		}
		return true;
	},
	savesql : function(){
		var error = 0;
        var error1=$('#result').val;
		for(var date in ros.savedata){
			if(!ros.errorcheck(ros.savedata[date]["SM"],date,"SM")){
				error++;
			}
			if(!ros.errorcheck(ros.savedata[date]["SP"],date,"SP")){
				error++;
			}
		}
		
		if(error > 0){
			 toasterrormsg("Please fill All the Fields");
			 return true;
		}
        if(error1=='Name Already exists.'){
            $("#err").removeClass('display-hide');
            $("#err").html('<button class="close" data-close="alert"></button> <br>Please Fill Unique Value.');
        }
		var ck = $("#auto_p").attr("checked");
		if(!ck){
			ck = 0;
		}else{
			ck = 1;
		}
		var o1 = $("#select2_sample2").val();
		if(o1){
			o1 =  o1.toString();
		}
		var o2 = $("#checkhid_r").val();
		if(o2){
			o1 = o2;
		}
		
		if(!o1){
			toasterrormsg("No Employee Selected");
			return false;
		}

		ros.names = o1;

		   $.ajax({
            type: "POST",
            url: "ajax/Roster_ajax.php?type=subdata",
            data: {savedata:ros.savedata,ck:ck,names:ros.names,r_name:ros.r_name,startrost: ros.startdate,endrost:ros.enddate,edit:ros.edit},
            beforeSend: function(){
                loading();
            },
            success: function(result){
                unloading();
                //console.log(result);
                if(result==1){
						toastmsg("successfully Updated");
						ros.resetall();
						$("#rosterform").hide("slow");
						ros.updateeditdropdown();
					}
				else{
					toasterrormsg("Network error");
				}
            }
        });
		
	},
	editdata : function(editdata,name){
		$("#workName").val(name);
	
		var d=$('#hiddata').val();
		 $.ajax({
            type: "POST",
            url: "ajax/Rosterlist_ajax.php?type=selected",
            data: {data:data ,d:d,selectdata:editdata['Emp']},
            beforeSend: function(){
                loading();
            },
            success: function(result){
                unloading();
                //console.log(result);
					ros.editajax(result,editdata);
                }

                //console.log(data);
           
        });
		
	},
	updateeditdropdown: function(){
		$.ajax({
            type: "POST",
            url: "ajax/Roster_ajax.php?type=updateEditDropdown",
            beforeSend: function(){
                loading();
            },
            success: function(html){
                unloading();
    
					$("#editrosterselect").html(html);
                }
           
        });
	},
	editajax : function(result,editdata){
		
		
		$("#empshowdiv").css('display','block');
		$('.rost_showdiv').css('display','block');
		$('#s2id_select2_sample2').css('display','block');
		$('#selectemp').css('display','none');
		$('#select2_sample2').html(result);
		$('#selall').html('Select All');
		$('#selall').attr('onclick',"Roster.addemp('all')");
		$('#checkhid_r').val('');
		$('#rostemp').val('bulk');
		var emplarray = [];
		for(var id in editdata['Emp']){
			emplarray.push(id);
		}
		var $exampleMulti = $("#select2_sample2").select2();
		$exampleMulti.val(emplarray).trigger("change");
		var Startdate = moment(editdata['start_rost'], 'YYYY-MM-DD').format("DD/MM/YYYY");
        var Enddate = moment(editdata['end_rost'], 'YYYY-MM-DD').format("DD/MM/YYYY");
		$("#dfrom").val(Startdate);
		$("#dto").val(Enddate);

		
		console.log(editdata);
		ros.init(1,editdata);
		if(editdata['date'] >= editdata['start_rost']){
			$(".editmenu").attr("disabled",true);
			$(".edithide").css("display",'none');
			 
		}
		$("#workName").attr("disabled",true);
	
	},
	resetall : function(){
		$("#workName").val('');
		$("#dfrom").val('');
		$("#dto").val('');
		$("#addroster_M").html('');
		$("#workName").attr("disabled",false);
		$("#select2_sample2").select2().val(null).trigger("change");
		$(".allsubmit").hide();
		$(".editmenu").attr("disabled",false);
		$(".edithide").css("display",'block');
        $("#rolename_availability_result").html('');
		
	},
	resetdate : function(){
		$("#addroster_M").html('');
		$(".allsubmit").hide();
		ros.savedata = {};
	}
	



}

function getDatesRangeArray (startDate, endDate) {
    var i = 0;
    var date1 = [startDate];
      ros.savedata[startDate] = {"SM":"","SP":""};
     while(i == 0){
    
       var newdate =  moment(startDate).add(1,'days').format('YYYY-MM-DD');
      
       if(newdate >= endDate){
         i = 1;
         if(newdate > endDate){
            break;
         }
       }
       startDate = newdate;
	   ros.savedata[newdate] = {"SM":"","SP":""};
       date1.push(newdate);
    }

     return date1;
};