//define('SCRIPT_DEBUG', true);
var viewR={
	swapA : {},
	init: function(d){
//alert("hi0");
		var mon = moment().format('MM');
		var ye = moment().format('YYYY');
//alert("hi1");
		$.ajax({
            type: "POST",
            url: "ajax/view_roster_ajax.php",
            data: {type:'showroster',year:ye,month:mon},
            beforeSend: function(){
                loading();
            },
            success: function(result){
                unloading();
               	//$('#showRoster').html(result);
			    var data = JSON.parse(result);
			    viewR.maketable(data,mon,ye);
			    //console.log(data);
            }
        });

        $.ajax({
            type: "POST",
            url: "ajax/view_roster_ajax.php",
            data: {type:'showroster_requests',year:ye,month:mon},
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
		var html = '<table class="table table-bordered"><thead><tr><th>Name</th>';
		var num = data.numberofdays;
		for(var i = 1; i <= num; i++){
			html += '<th>'+i+'</th>';
		}
		html += '</thead></tr><tbody>';
		var detail = data.details;
		var alldata = data.data;
		var schm = data.scheme;
		var chnagedata = data.changeD;
 
		html += '<td><img class="img-circle" style="max-width:50px;" src= "'+detail['image']+'"/>'+detail['Fname']+'</td>';
		var iddata = [];
		if(alldata[detail['id']]){
			iddata = alldata[detail['id']];
		}
		var shiftA = viewR.detectshift(detail['id'],iddata,schm,mon,ye,num,chnagedata,"request");
		for(var i = 1; i <= num; i++){
			var valH = 'N/A';
			if(shiftA[i]){
				valH = shiftA[i]['html'];
			}
			html += '<td>'+valH+'</td>';
		}
		html += '</tr>';
		for(var Cid in detail['children']){
			html += '<tr>';
			var CA = detail['children'][Cid];
			
			var iddata = [];
			if(alldata[Cid]){
				iddata = alldata[Cid];
			}
			var shiftA = viewR.detectshift(Cid,iddata,schm,mon,ye,num,chnagedata,"approve");
			
			html += '<td><img class="img-circle" style="max-width:50px;" src= "'+CA.image+'"/>'+CA.Fname+'</td>';
			for(var i = 1; i <= num; i++){
				var valH = 'N/A';
				if(shiftA[i]){
					valH = shiftA[i]['html'];
				}
				html += '<td>'+valH+'</td>';
			}
			html += '</tr>';
		}
		
		
		html += '</table>';
		$('#showRoster').html(html);
		
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
				rhtml += '<div class="col-md-3" id="Approv_'+rid+'_'+daA[0]+'"><div class="col-md-12"><img class="img-circle" style="max-width:50px;" src= "'+idDetail['image']+'"/>'+idDetail.Fname+'</div><div class="col-md-12">'+da+' : '+shiftAA[SMid]["name"]+'</div><div class="col-md-12"><input value="Approve"  class="btn btn-default" type="button" onclick="viewR.saveSM(\''+rid+'\',\''+daA[0]+'\',\''+daA[1]+'\',\''+daA[2]+'\','+SMid+','+SPid+',\'approve\',1)"></div><hr></div>';
			}
			}
		}
		var sq = data.sq;
		viewR.sq = sq;
		for(var rid in sq){
			if(detail['children'][rid]){
				for(var rand in sq[rid]){
					var idDetail = detail['children'][rid];
					rhtml += '<div class="col-md-3" id="Approv_'+rid+'_'+rand+'"><div class="col-md-12"><img class="img-circle" style="max-width:50px;" src= "'+idDetail['image']+'"/>'+idDetail.Fname+'</div>';
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
	
	 detectshift : function(id,data,scheme,mon,ye,num,chnagedata,LT){
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
		 console.log(alldate);
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
		for(var i = 1; i <= num; i++){
			finaldata[i] = [];
			if(thisdata[i]){
				var shiftname = viewR.getshiftname(i,mon,ye,scheme[thisdata[i]['name']]);
				if(i < 10){
					var todaydate = '0'+i+'/'+mon+'/'+ye;
				}else{
					var todaydate = i+'/'+mon+'/'+ye;
				}
				var shiftN = shiftname["SM"]["name"];
				var request = ''
				var colorBut = 'rgba(0, 78, 255, 0.72)';
				if(chnagedata[id] && chnagedata[id][todaydate]){
					if(chnagedata[id][todaydate]["type_name"] == "approve"){
						shiftN = shiftAA[chnagedata[id][todaydate]["SM"]]['name'];
						colorBut = '#ffa03f';
					}
				} 
				
				var html = '<div style="color:white;background-color:'+colorBut+';width:100%; padding: 5px;  border-radius: 4px ! important;cursor:pointer" onclick="viewR.changeSM(\''+id+'\','+i+',\''+mon+'\',\''+ye+'\','+shiftname["SM"]["id"]+','+shiftname["SM"]["id"]+',\''+LT+'\')" id="datediv_'+id+'_'+i+'">'+shiftN+'</div>';
				// swap checkbox
				html += '<div><input type="checkbox" class="form-control swapcheckbox swapcheckbox_'+id+' swapcheckbox_'+id+'_'+i+'" style="display:none;width:15px" onchange = "viewR.swapSM(\''+id+'\','+i+',\''+mon+'\',\''+ye+'\','+shiftname["SM"]["id"]+','+shiftname["SM"]["id"]+',\''+LT+'\',this.checked)"></div>';
			}else{
				var html = 'N/A';
			}
			finaldata[i]['html'] = html;
		}
		 
		return finaldata;
		
		//console.log(thisdata);
	
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
						console.log(A);
						if(A){
							$('#Approv_'+id+'_'+day).hide("slow");
							console.log('#Approv_'+id+'_'+day);
						}
					}
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
	//console.log(viewR.swapA);
	
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
 

