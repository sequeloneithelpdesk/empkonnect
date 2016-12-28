var Calendar = function() {
    return {
        init: function() {
            Calendar.initCalendar();
        },

        initCalendar: function() {
            if (!jQuery().fullCalendar) {
                return;
            }
            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();
            var h = {};

            if (Metronic.isRTL()) {
                if ($('#calendar').parents(".portlet").width() <= 720) {
                    $('#calendar').addClass("mobile");
                    h = {
                        right: 'title, prev, next',
                        center: '',
                        left: 'agendaWeek, month'
                    };
                } else {
                    $('#calendar').removeClass("mobile");
                    h = {
                        right: 'title',
                        center: '',
                        left: 'agendaDay, agendaWeek, month, prev,next'
                    };
                }
            } else {
                if ($('#calendar').parents(".portlet").width() <= 720) {
                    $('#calendar').addClass("mobile");
                    h = {
                        left: 'title, prev, next',
                        center: '',
                        right: 'month,agendaWeek,agendaDay'
                    };
                } else {
                    $('#calendar').removeClass("mobile");
                    h = {
                        left: 'title',
                        center: '',
                        right: 'prev,next,month,agendaWeek,agendaDay'
                    };
                }
            }
            $('#calendar').fullCalendar('destroy');     // destroy the calendar
            $('#calendar').fullCalendar({               //re-initialize the calendar
                header: h,
                defaultView: 'month',                   // change default view with available options from http://arshaw.com/fullcalendar/docs/views/Available_Views/ 
                slotMinutes: 15,
                firstDay: 1,
                
                eventSources: {
                    //url: "ajax/getEventList.php?type=myNewEvents",
                    url: "../../pages/Attendance/calling_page.php?type=myNewEvents&emp_code="+$('#emp_code').val(),
                    type:'POST',
                    textColor: 'black'
                },
                eventRender: function (event, element) {

                    element.attr('href', 'javascript:void(0);');
                    element.click(function() {
                       
                        $('#birthdayRecords').html('');
                        $('#anniversaryRecords').html('');
                        $("#shiftName").html('');
                        $("#shiftInOutTime").html('');
                        $("#presetStatus").html('');
                        $("#startTime").html('');
                        $("#endTime").html('');
                        $("#leaveReason").html('');

                        if(event.birthdate.length>0){
                            var html='<div><br/><i class="fa fa-birthday-cake" style="color:pink" aria-hidden="true"></i><span><b>Birthdays:</b></span><div style="height:100px;overflow:auto;">';
                            for(var i=0;i<event.birthdate.length;i++){
                                html +='<span style="font-size:.9em;"><span><br/>'+event.birthdate[i].bemp_name+'<a href="mailto:'+event.birthdate[i].bemp_email+'">  <i class="fa fa-envelope-o" style="color:green;font-size: 1.2em;" aria-hidden="true"></i></a></span><br/><span>'+event.birthdate[i].bemp_dsg+','+event.birthdate[i].bemp_wloc+','+event.birthdate[i].bemp_loc+'</span></span><br>';
                            }
                            html +='</div></div>';
                        }
                        $('#birthdayRecords').html(html);
                        
                       
                        if(event.annidate.length>0){
                            var html1='<div><br/><i class="fa fa-gift" style="color:green" aria-hidden="true"></i><span><b>Anniversaries:</b></span><div style="height:100px;overflow:auto;">';
                            for(var i=0;i<event.annidate.length;i++){
                                html1 +='<span style="font-size:.9em;"><span><br/>'+event.annidate[i].bemp_name+'<a href="mailto:'+event.annidate[i].bemp_email+'">  <i class="fa fa-envelope-o" style="color:green;font-size: 1.2em;" aria-hidden="true"></i></a></span><br/><span>'+event.annidate[i].bemp_dsg+','+event.annidate[i].bemp_wloc+','+event.annidate[i].bemp_loc+'</span></span><br>';
                            }
                            html1 +='</div></div>';
                        }
                        $('#anniversaryRecords').html(html1);


                        if(event.type=='null'){
                            $("#shiftName").html(event.shiftName);
                            $("#shiftInOutTime").html(event.shiftInOutTime);  
                        }

                        if(event.type=='attendance'){
                            $("#shiftName").html(event.shiftName);
                            $("#shiftInOutTime").html(event.shiftInOutTime);
                            
                            if(wordInString(event.className, 'latecoming_warning')  )
                                    lateComingMessage +='<span class="att-time"><font style="color: #cc3300;">Late Coming</span>';

                            if(event.title=='Present'){
                                $("#presetStatus").html(event.title+' : ');
                                $("#startTime").html('('+event.startTime);
                                $("#endTime").html('-'+event.endTime+')');
                            }else if(event.title=='Absent'){
                                $("#presetStatus").html(event.title+' : '); 
                                $("#startTime").html('('+event.startTime);
                                $("#endTime").html('-'+event.endTime+')');
                            }else if(event.title=='Half Day'){
                                $("#presetStatus").html(event.title+' : ');
                                $("#startTime").html('('+event.startTime);
                                $("#endTime").html('-'+event.endTime+')');
                            }
                            if((event.startTime == '' && event.endTime != '') || (event.startTime != '' && event.endTime == '')){
                                $("#presetStatus").html('Miss Punch');
                            }
                        }else if(event.type=='leave'){
                            $("#shiftName").html(event.shiftName);
                            $("#shiftInOutTime").html(event.shiftInOutTime); 
                           //$("#presetStatus").html(event.title+' status : '+event.status);
                            $("#firstpresetStatus").html('Leave Status : '+event.firststatus);
							if( typeof event.secondstatus != 'undefined' || event.secondstatus != null ){
								$("#secondpresetStatus").html('<br>Regular Attendance Status : '+event.secondstatus);
							}
							$("#leaveReason").html('<br>Leave Reason : '+event.reason);
                        }else if(event.type=='odrequest'){
                            $("#shiftName").html(event.shiftName);
                            $("#shiftInOutTime").html(event.shiftInOutTime); 
                            //$("#presetStatus").html(event.title+' status : '+event.status);
                            $("#leaveReason").html('<br>Reason : '+event.reason);
                            $("#startTime").html('('+event.startTime);
                            $("#endTime").html('-'+event.endTime+')');
							event.firststatus = (event.firststatus == 'OD Request-Pending')?'Pending':event.firststatus;
							$("#firstpresetStatus").html('OD Status : '+event.firststatus);
							
							if( typeof event.secondstatus != 'undefined'){
								switch(event.flagType){
									case 'odandattnreq':
										$("#firstpresetStatus").html('Attendance Regularization Status : '+event.firststatus);
										$("#secondpresetStatus").html('<br>OD Status : '+event.secondstatus);
									break;
									case 'odandleave':
										$("#firstpresetStatus").html('OD Status : '+event.firststatus);
										$("#secondpresetStatus").html('<br>Leave Status : '+event.secondstatus);
									break;
									
								}
							}
                        }else if(event.type=='attRegularised'){
                            $("#shiftName").html(event.shiftName);
                            $("#shiftInOutTime").html(event.shiftInOutTime);  
                            //$("#presetStatus").html(event.title+' : '+event.status);
                            $("#startTime").html('<br>('+event.startTime);
                            $("#endTime").html('-'+event.endTime+')');
							event.title = (event.status == 'Pending')?'Attn Regularised':event.title;
							$("#firstpresetStatus").html(event.title+' : '+event.status);
                            $("#leaveReason").html('<br>Reason : '+event.reason);
                        }else if(event.type=='weeklyoff'){
                            $("#shiftName").html(event.shiftName);
                            $("#shiftInOutTime").html(event.shiftInOutTime);  
                            $("#presetStatus").html(event.title);
                            if(event.title == 'POW'){
                                $("#presetStatus").html('Present On Weekly Off');
                                $("#startTime").html('('+event.startTime);
                                $("#endTime").html('-'+event.endTime+')');
                            }
                        }else if(event.type=='pholiday'){
                            $("#presetStatus").html('Holiday: '+event.title);
                            if(event.title == 'POH'){
                                $("#shiftName").html(event.shiftName);
                                $("#shiftInOutTime").html(event.shiftInOutTime); 
                                $("#presetStatus").html('Present On Holiday');
                                $("#startTime").html('('+event.startTime);
                                $("#endTime").html('-'+event.endTime+')');
                            }
                        }else if(event.type=='empty_attendance'){
                            $("#shiftName").html(event.shiftName);
                            $("#shiftInOutTime").html(event.shiftInOutTime); 
                            $("#presetStatus").html(event.title);
                        }
                        $("#eventContent").dialog({ modal: true, title: event.formattedDate, width:230});
                    });
                },
                eventOverlap:true
            });
        }
    };
}();
function wordInString(s, word){
  return new RegExp( '\\b' + word + '\\b', 'i').test(s);
}