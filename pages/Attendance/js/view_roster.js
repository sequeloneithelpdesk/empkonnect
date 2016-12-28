//define('SCRIPT_DEBUG', true);
var viewR={
	swapA : {},
	mon: moment().format('MM'),
	ye: moment().format('YYYY'),
	limitStart: 1,
	offsetLimit: 10,
	rosterListTypeStore: '',
	init: function(d){

		/*var mon = moment().format('MM');
		var ye = moment().format('YYYY');*/

		var temp_mon = this.mon;
		var temp_ye = this.ye;
		
		viewR.getViewRoster();
		
	},
	
	getNextMonthRoster: function(){
		this.limitStart = 0;
		this.offsetLimit = 10;
		$("#showRoster").html('');
		this.mon = Number(this.mon) + 1;
		if(this.mon > 12){
			this.mon = 1;
			this.ye = Number(this.ye) + 1;
		}
		//console.log(this.ye +'--'+ this.mon);
		viewR.getViewRoster();
	},
	getPreviousMonthRoster: function(){
		this.limitStart = 0;
		this.offsetLimit = 10;
		$("#showRoster").html('');
		this.mon = Number(this.mon) - 1;
		if(this.mon <= 0){
			this.mon = 12;
			this.ye = Number(this.ye) - 1;
		}
		//console.log(this.ye +'--'+ this.mon);
		viewR.getViewRoster();
	},	
	getViewRoster: function(){
		
		var rosterListType = $('input.rosterTypeCheckBox:checked').attr("name");
		if(this.rosterListTypeStore != rosterListType){ 
			this.rosterListTypeStore = rosterListType;
			this.limitStart = 0;
			this.offsetLimit = 10;
			$("#showRoster").html('');
		}

		var temp_mon = this.mon;
		var temp_ye = this.ye;
		var limitStart = this.limitStart;		
		var offsetLimit = this.offsetLimit;
		rosterListType = this.rosterListTypeStore;

		$.ajax({
            type: "POST",
            url: "ajax/view_roster_ajax.php",
            async: false ,
            data: {type:'showroster',year:this.ye,month:this.mon, 'limitStart': limitStart, 'offsetLimit': offsetLimit, "rosterListType": rosterListType},
            beforeSend: function(){
                loading();
            },
            success: function(result){
                unloading();
               	//$('#showRoster').html(result);
			    var data = JSON.parse(result);
			
			    if(data.data == '' && data.details == ''){
			    	toasterrormsg("Sorry! No more records found");
			    }else{
			    	$(".prevMonth").text('<< '+data.monthNames.prevMonth);
			    	$(".nextMonth").text(data.monthNames.nextMonth+" >>");
			    	$(".currentMonth").text(data.monthNames.currentMonth);
				    viewR.maketable(data,temp_mon, temp_ye);
					viewR.getRosterRequests(temp_mon, temp_ye);
				    //console.log(data);
				}
			    $("#loading").hide(); 
            }
        });
        this.limitStart = this.offsetLimit + Number(1);
		this.offsetLimit = this.offsetLimit + Number(10);
	},
	getRosterRequests: function(temp_mon, temp_ye){
		$.ajax({
            type: "POST",
            async: false ,
            url: "ajax/view_roster_ajax.php",
            data: {type:'showroster_requests',year:temp_ye,month:temp_mon},
            beforeSend: function(){
                loading();
            },
            success: function(result){
                unloading();
               	//$('#showRoster').html(result);
			    var data = JSON.parse(result);
			    viewR.makeRequestTable(data);
			   // console.log(data);
            }
        });
	},
	makeRequestTable: function(data){
		if(data == ''){
			var html = "<p class='text-center'>No record exist</p>";
		}else{
			var html = '<table class="table table-bordered"><thead><tr><th>#</th><th>Shift Time</th><th>Roster Date</th><th>Created Date</th></thead><tbody>';
			var sno = 1;
			$.each(data, function(i, item) {
				html += '<td>'+ sno++ + '</td>';
			    html += '<td>'+data[i].ShiftPattern_Name+' [ '+ data[i].Shift_From+' - '+ data[i].Shift_To +' ]</td>';
				html += '<td>'+data[i].rosterDate+'</td>';
				html += '<td>'+data[i].createdOn+'</td>';
			
			});
			html += '</tbody></table>';
		}
		$("#showRosterRequests").html(html);
	},

	maketable : function(data,mon,ye){
		var html = '';
		var num = data.numberofdays;	
		console.log("limitStart: "+this.limitStart);	
		if(this.limitStart == 0){
			html = '<thead><tr><th>Name</th>';
	        for(var i = 1; i <= num; i++){	html += '<th>'+i+'</th>'; }
	        html += '</tr></thead>';
    	}
		html += '<tr>';
		var detail = data.details;
		var alldata = data.data;
		var schm = data.scheme;
		var chnagedata = data.changeD;
		var holidays = data.holidays;
		var weeklyOffsData = data.weeklyOffsData;
 		if(userType != 'admin' && $.trim(detail['name']) !== ''){
			//html += '<td class="bb"><img class="img-circle" style="max-width:50px;" src= "'+detail['image']+'"/><br>'+detail['name']+'<br>'+detail['id']+'</td>';
			html += '<td class="bb">'+detail['name']+' ('+detail['id']+')</td>';
			var iddata = [];
			if(alldata[detail['id']]){
				iddata = alldata[detail['id']];
			}
			var shiftA = viewR.detectshift(detail['id'],iddata,schm,mon,ye,num,chnagedata,"request",holidays,weeklyOffsData);
			for(var i = 1; i <= num; i++){
				var valH = 'N/A';
				if(shiftA[i]){
					valH = shiftA[i]['html'];
				}
				html += '<td class="bb">'+valH+'</td>';
			}
			html += '</tr>';
		}
		for(var Cid in detail['children']){
			html += '<tr>';
			var CA = detail['children'][Cid];
			
			var iddata = [];
			if(alldata[Cid]){
				iddata = alldata[Cid];
			}
			var shiftA = viewR.detectshift(Cid,iddata,schm,mon,ye,num,chnagedata,"approve",holidays,weeklyOffsData);
			
			//html += '<td class="dd"><img class="img-circle" style="max-width:50px;" src= "'+CA.image+'"/><br>'+CA.name+'<br>'+Cid+'</td>';
			html += '<td class="dd" style="vertical-align: middle;">'+CA.name+' ('+Cid+')</td>';
			for(var i = 1; i <= num; i++){
				var valH = 'N/A';
				if(shiftA[i]){
					valH = shiftA[i]['html'];
				}
				html += '<td class="dd" style="vertical-align: middle;">'+valH+'</td>';
			}
			html += '</tr>';
		}
		
		
		//html += '</table>';
		html += '</tr>';
		$('#showRoster').append(html);
		
		// approve list
		var rhtml = '';		
		var rq = data.rq;
		for(var rid in rq){
			if(detail['children'][rid]){
			for(var da in rq[rid]){
				var idDetail = detail['children'][rid];
	 
				var daA = da.split("/");
				var SMid = rq[rid][da]["SM"];
				var SPid = rq[rid][da]["SP"];
				rhtml += '<div class="col-md-3" id="Approv_'+rid+'_'+daA[0]+'"><div class="col-md-12"><img class="img-circle" style="max-width:50px;" src= "'+idDetail['image']+'"/>'+idDetail.Fname+' ('+rid+')</div><div class="col-md-12">'+da+' : '+shiftAA[SMid]["name"]+'</div><div class="col-md-12"><input value="Approve"  class="btn btn-default" type="button" onclick="viewR.saveSM(\''+rid+'\',\''+daA[0]+'\',\''+daA[1]+'\',\''+daA[2]+'\','+SMid+','+SPid+',\'approve\',1)"></div><hr></div>';
			}
			}
		}
		var sq = data.sq;
		viewR.sq = sq;
		for(var rid in sq){
			if(detail['children'][rid]){
				for(var rand in sq[rid]){
					var idDetail = detail['children'][rid];
					rhtml += '<div class="col-md-3" id="Approv_'+rid+'_'+rand+'"><div class="col-md-12"><img class="img-circle" style="max-width:50px;" src= "'+idDetail['image']+'"/>'+idDetail.Fname+' ('+rid+')</div>';
					var i = 0;
					for(var da in sq[rid][rand]){
						var daA = da.split("/");
						var SMid = sq[rid][rand][da]["SM"];
						var SPid = sq[rid][rand][da]["SP"];
						rhtml += '<div class="col-md-12">'+da+' : '+shiftAA[SMid]["name"]+'</div>';
						if(i == 0){
							rhtml += ' <div class="col-md-12">swap to </div>';
							i++;
						}
					}
					rhtml += '<input value="Approve"  class="btn btn-default" type="button" onclick="viewR.Approveswap(\''+rid+'\',\''+rand+'\')"></div></div>';
				}
			}
		}
		
		$("#shiftapprove").html(rhtml);
		
		
	},
	
	 detectshift : function(id,data,scheme,mon,ye,num,chnagedata,LT,holidays,weeklyOffsData){
	 	console.log(holidays);
		 if(data.length == 0){
			 return [];
		 }
		 var alldate = {};
		 for(var i in data){
		 	//alert(data[i]['startdate']);
			var startDate = datechage(data[i]['startdate']);//moment(data[i]['startdate'], "DD/MM/YYYY",true).format('YYYY-MM-DD');
			var endDate = datechage(data[i]['enddate']);//moment(data[i]['enddate'], "DD/MM/YYYY",true).format('YYYY-MM-DD');
			var roster = data[i]['auto'];
			var schemeName = data[i]['RosterName'];
			var daterange = viewR.getDatesRangeArray(startDate, endDate);
			// getting roster name in date range
			for(var i in daterange){
				var d = daterange[i].split("-");
				if(!alldate[d[0]]){
					alldate[d[0]] = {};
					alldate[d[0]][d[1]] = {};
				}else if(!alldate[d[0]][d[1]]){
					alldate[d[0]][d[1]] = {};
				}
				if(d[1] != mon && roster == 0){ 
					
				}else{
					alldate[d[0]][d[1]][d[2]] = {"name":schemeName,"roster":roster};
				}
			}
			
		 }
		 // getting old roster 
		 if(alldate[ye] && alldate[ye][mon] && alldate[ye][mon][01]){
				
				
		}else{
			 for(var year in alldate){
				  
					 for(var month in alldate[year]){
						 if(month != mon){
							 for(var day in alldate[year][month]){
								 if(alldate[year][month][day]['roster'] == 1){
									 if(!alldate[ye]){
										 alldate[ye] = [];
										 alldate[ye][mon] = [];
									 }else if(!alldate[ye][mon]){
										 alldate[ye][mon] = [];
									 }
									
									alldate[ye][mon]['01'] =  {"name":alldate[year][month][day]['name'],"roster":1};
									break;
								 }
							 }
						 }
					 }
				  
			 }
			 
		}
		
		
		var thisdata = {};
	
		if(alldate[ye] && alldate[ye][mon]){
 
			// converting datestring into integer
			for(var di in alldate[ye][mon]){
				thisdata[parseInt(di)] = alldate[ye][mon][di];
			}
		}
		
		
		
		
		for(var i = 1; i <= num; i++){
			if(thisdata[i]){
				
			}else{
				if(thisdata[i-1] && thisdata[i-1]["roster"] == 1){
					thisdata[i] = thisdata[i-1];
				}
			}
			
		}
	
// comparing all data to scheme	
		var finaldata = [];
		var currentDateObj = new Date();
		/*var clearDate = '';
		var dd = currentDateObj.getDate();
var mm = currentDateObj.getMonth()+1; //January is 0!
var yyyy = currentDateObj.getFullYear();
		var currentDate = ""+dd + mm + yyyy;    
		alert(currentDate);*/
		//var currentDateStatus = false;
		for(var i = 1; i <= num; i++){
			finaldata[i] = [];
			if(thisdata[i]){
				var shiftname = viewR.getshiftname(i,mon,ye,scheme[thisdata[i]['name']]);
				todaydate = '';
				if(i < 10){
					var todaydate = '0'+i+'/'+mon+'/'+ye;
				}else{
					var todaydate = i+'/'+mon+'/'+ye;
				}
				
				var shiftN = shiftname["SM"]["shift_code"];
				var request = '';
				colorText = 'color:white;';
				var colorBut = 'rgba(0, 78, 255, 0.72)';
				if (typeof holidays[todaydate] != "undefined") {
					shiftN = holidays[todaydate]['title'];
					colorBut = '#E5EFE5';
					colorText = 'color: #494F49;';
				}
				if(chnagedata[id] && chnagedata[id][todaydate]){
					if(chnagedata[id][todaydate]["type_name"] == "approve"){
						//shiftN = shiftAA[chnagedata[id][todaydate]["SM"]]['name'];
						shiftN = chnagedata[id][todaydate]["shift_code"];
						colorBut = '#ffa03f';
					}
				}
				if (typeof weeklyOffsData[todaydate] != "undefined") {
					shiftN = 'Weekly Off';
					colorBut = '#E5EFE5';
					colorText = 'color: #494F49;';
				}
				/*clearDate = i+mon+ye;
				console.log(currentDate+" < "+clearDate);*/
				if( currentDateObj.getDate() < i ){
					var html = '<div style="background-color:'+colorBut+';'+colorText+'min-width: 73px; text-align:center; padding: 5px;  border-radius: 4px ! important;cursor:pointer" onclick="viewR.changeSM(\''+id+'\','+i+',\''+mon+'\',\''+ye+'\','+shiftname["SM"]["id"]+','+shiftname["SM"]["id"]+',\''+LT+'\')" id="datediv_'+id+'_'+i+'">'+shiftN+'</div>';
					//var html = '<div style="color:white;background-color:'+colorBut+';width:100%; padding: 5px;  border-radius: 4px ! important;cursor:pointer" id="datediv_'+id+'_'+i+'">'+shiftN+'</div>';
					//swap checkbox
					html += '<div><input type="checkbox" class="form-control swapcheckbox swapcheckbox_'+id+' swapcheckbox_'+id+'_'+i+'" style="display:none;width:15px" onchange = "viewR.swapSM(\''+id+'\','+i+',\''+mon+'\',\''+ye+'\','+shiftname["SM"]["id"]+','+shiftname["SM"]["id"]+',\''+LT+'\',this.checked)"></div>';
				}else{
					var html = '<div style="background-color:'+colorBut+';'+colorText+'min-width: 73px; text-align:center; padding: 5px;  border-radius: 4px ! important;cursor:pointer" onclick="viewR.changeSM(\''+id+'\','+i+',\''+mon+'\',\''+ye+'\','+shiftname["SM"]["id"]+','+shiftname["SM"]["id"]+',\''+LT+'\')" id="datediv_'+id+'_'+i+'">'+shiftN+'</div>';
				}
				
			}else{
				var html = 'N/A';
			}
			finaldata[i]['html'] = html;
		}
		 
		return finaldata;
		
	
	},
	 getshiftname : function(day,month,year,scheme){
	if(day < 10){
		day = "0"+day.toString();
	}
	var date = day+"/"+month+"/"+year;
	if(scheme[date]){
		return scheme[date];
	}else{
		var numday = Object.keys(scheme).length;
		var scchemA = [];
		var i = 0;
		for(var day in scheme){
			scchemA[i] = scheme[day];
			i++;
			if(i == Object.keys(scheme).length){
				var enda = day;
			}
			
			//getnumberofday = numday(date,day);
		}
		d1 = moment(date, "DD/MM/YYYY").format('YYYY-MM-DD');
		d2 = moment(day, "DD/MM/YYYY").format('YYYY-MM-DD');
		var duration =   moment(d1).diff(moment(d2),"days") ;
		var y = parseInt(duration-1)%parseInt(numday);
		return scchemA[y];
	}
	
},

 getDatesRangeArray : function (startDate, endDate) {
    var i = 0;
    var date1 = [startDate];
      
     while(i == 0){
    
    	if(startDate == endDate){
         i = 1;
       }
       var newdate = moment(startDate).add(1,'days').format('YYYY-MM-DD');
      
       if(newdate >= endDate){
         i = 1;
       }
       startDate = newdate;
 
       date1.push(newdate);
    }

     
     return date1;
},
changeSM : function(id,day,month,year,SMid,SPid,LT){
	$("#changeSM").val('');
	var btn = '<button type="button" class="btn btn-primary" onclick="viewR.saveSM(\''+id+'\','+day+',\''+month+'\',\''+year+'\','+SMid+','+SPid+',\''+LT+'\')">Change</button> <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
	$("#changeSMbutton").html(btn);
	$("#SMModal").modal('show');
	
},
saveSM : function(id,day,month,year,SMid_old,SPid_old,LT,A){
	var SMid = $("#changeSM").val();
	if(!SMid && !A){
		alert("please select Shift");
		return false;
	}
	if(A){
		SMid = SMid_old;
	}

	$.ajax({
            type: "POST",
            url: "ajax/view_roster_ajax.php",
            data: {type:'subrost',year:year,month:month,day:day,eid:id,sm:SMid,sp:SPid_old,LT:LT},
            beforeSend: function(){
                loading();
            },
            success: function(result){
                unloading();
               	if(result==1){
					toastmsg("Successfully submitted.");
					$("#SMModal").modal('hide');
					if(LT == 'approve'){
						$("#datediv_"+id+'_'+parseInt(day)).css("background-color","#ffa03f");
						$("#datediv_"+id+'_'+day).html(shiftAA[SMid]['name']);
						if(A){
							$('#Approv_'+id+'_'+day).hide("slow");
						}
					}
				}else if(result == 3){
					toasterrormsg("You have already 2 times requested for change reoster in this month.");
				}
				else{
					toasterrormsg("");
				}
				
            }
        });
	
},
swap : function(){
	$(".swapcheckbox").show("slow");
},
swapSM : function(id,day,month,year,SMid,SPid,LT,val){
	
	if(val){
		if(viewR.swapA[id]){
			for(var days in viewR.swapA[id]){
				if(viewR.swapA[id][days]["SM"] == SMid){
					toasterrormsg("Cant swap same shift");
					$(".swapcheckbox_"+id+"_"+day).attr("checked",false);
					return false;
				}
			}
			
			
			viewR.swapA[id][day] = {"day":day,"month":month,"year":year,"SM":SMid,"SP":SPid};
			var html ="<div>";
			var i = 0;
			
			$(".swapcheckbox_"+id).hide();
			
			
				for(var days in viewR.swapA[id]){
					var idata = viewR.swapA[id][days];
					html +='<div class="col-md-4"><h4>Date:'+idata.day+'/'+idata.month+'/'+idata.year+'</h4><h4>Shift name :'+shiftAA[idata.SM]['name']+'</h4></div>'; 
					if(i == 0){
						html +='<div class ="col-md-2"><h4>Swap<h4></div>';
						i++;
					}
					$(".swapcheckbox_"+id+"_"+idata.day).show();
				}
				
			 html +="</div>";
			
			$("#SwapID").html(html);
			var swapbtn = '<input type="button" class="btn btn-primary" value="Swap" onclick="viewR.saveswap(\''+id+'\',\''+LT+'\')"> <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
			$("#swapbutton").html(swapbtn);
			$("#showSwap").modal("show");
		}else{
			viewR.swapA[id] = {};
			viewR.swapA[id][day] = {"day":day,"month":month,"year":year,"SM":SMid,"SP":SPid};
		}
	}else{
		if(viewR.swapA[id] && viewR.swapA[id][day]){
			delete viewR.swapA[id][day];
			$(".swapcheckbox_"+id).show();
			if(Object.keys(viewR.swapA[id]).length == 0){
				delete viewR.swapA[id];
			}
		}
	}
	
},
saveswap : function(id,LT){
	if(viewR.swapA[id]){
		if(Object.keys(viewR.swapA[id]).length == 2){
			var data = viewR.swapA[id];
			 
			var da1 = '';
			
			var SM2 = '';
			for(var days in data){
				if(!da1){
					da1 = days;
					
				}else{
					SM2 = data[days]["SM"];
					data[days]["SM"] = data[da1]["SM"];
					data[da1]["SM"] = SM2;
					
				}
			}
			var randomVar =  Date.parse(Date());  
			
			$.ajax({
            type: "POST",
            url: "ajax/view_roster_ajax.php",
            data: {type:'subswitch',data:data,id:id,LT:LT,randomVar:randomVar},
            beforeSend: function(){
                loading();
            },
            success: function(result){
                unloading();
               	if(result==1){
					toastmsg("Successfully submitted.");
					 $("#showSwap").modal("hide");
					 delete viewR.swapA[id];
					if(LT == 'approve'){
						 for(var days in data){
							$("#datediv_"+id+'_'+parseInt(days)).css("background-color","#ffa03f");
							$("#datediv_"+id+'_'+days).html(shiftAA[data[days]["SM"]]['name']);
						 }
					}
				}
				else{
					toasterrormsg("");
				}
				
            }
        });
		}else{
			toasterrormsg("Need 2 date to swap");
		}
	}
},
Approveswap : function(id,rand){
	 
			var data1 = viewR.sq[id][rand];
			 data = {};
			for(var days in data1){
				var day = days.split("/");
				data[day[0]] = {"day":day[0],"month":day[1],"year":day[2],"SM":data1[days]['SM'],"SP":data1[days]['SP']};
			}
			 
			var randomVar =  rand;  
			
			$.ajax({
            type: "POST",
            url: "ajax/view_roster_ajax.php",
            data: {type:'subswitch',data:data,id:id,LT:'approve',randomVar:randomVar},
            beforeSend: function(){
                loading();
            },
            success: function(result){
                unloading();
               	if(result==1){
					toastmsg("Successfully submitted.");
					 $('#Approv_'+id+'_'+rand).hide("slow");
					  
					 for(var days in data){
							$("#datediv_"+id+'_'+parseInt(days)).css("background-color","#ffa03f");
							$("#datediv_"+id+'_'+days).html(shiftAA[data[days]["SM"]]['name']);
						}
				}
				else{
					toasterrormsg("");
				}
				
            }
        });
		 
	 
}
	
}

function datechage(d){
var sp=d.split('/');

var newdate=sp[2]+'-'+sp[1]+'-'+sp[0] ;

return newdate;

}
 
$(document).ready(function(){

	var el = $('#showRosterScroll'),

    // initialize last scroll position
    lastY = el.scrollTop(), 
    lastX = el.scrollLeft();

	el.on('scroll', function() {

	// get current scroll position
      var currY = el.scrollTop(),
      currX = el.scrollLeft(),

      // determine current scroll direction
      x = (currX > lastX) ? 'right' : ((currX === lastX) ? 'none' : 'left'),
      y = (currY > lastY) ? 'down' : ((currY === lastY) ? 'none' : 'up');

      // do something here…
      //console.log(x + ', ' + y);

      // update last scroll position to current position
      lastY = currY;
      lastX = currX;

	  if($("#loading").css('display') == 'none' && y == 'down') {
	    if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
	    	$("#loading").show();
	       viewR.getViewRoster(); 
	    }
	  }
	});

	$('input.rosterTypeCheckBox').on('change', function() {
		
	    $('input.rosterTypeCheckBox').prop('checked', false);
	    $('input.rosterTypeCheckBox').removeAttr('checked');
	    $('input.rosterTypeCheckBox').not(this).parent('span').removeClass('checked');
	    $(this).attr('checked', true); 
		
	    viewR.getViewRoster();
	});

});