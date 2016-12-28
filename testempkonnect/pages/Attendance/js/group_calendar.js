	// standard time attributes
	var now = new Date()

	var year = now.getYear()
	if (year < 1000)
	year+=1900
	var month = now.getMonth()
	month=month+1;

	var date = now.getDate()
	now = null






function leapYear(year) {
	if (year % 4 == 0) // basic rule
	return true // is leap year
	/* else */ // else not needed when statement is "return"
	return false // is not leap year
}

function getDays(month, year) {
	// create array to hold number of days in each month
	var ar = new Array(12)
	ar[1] = 31 // January
	ar[2] = (leapYear(year)) ? 29 : 28 // February
	ar[3] = 31 // March
	ar[4] = 30 // April
	ar[5] = 31 // May
	ar[6] = 30 // June
	ar[7] = 31 // July
	ar[8] = 31 // August
	ar[9] = 30 // September
	ar[10] = 31 // October
	ar[11] = 30 // November
	ar[12] = 31 // December

	// return number of days in the specified month (parameter)
	return ar[month]
}

function getMonthName(month) {
	// create array to hold name of each month
	var ar = new Array(12)
	ar[1] = "January"
	ar[2] = "February"
	ar[3] = "March"
	ar[4] = "April"
	ar[5] = "May"
	ar[6] = "June"
	ar[7] = "July"
	ar[8] = "August"
	ar[9] = "September"
	ar[10] = "October"
	ar[11] = "November"
	ar[12] = "December"

	// return name of specified month (parameter)
	return ar[month]
}



function setCal(year,month,date,emp_code) {
	


	var monthName = getMonthName(month)
	// create instance of first day of month, and extract the day on which it occurs
	var firstDayInstance = new Date(year, month, 1)
	var firstDay = firstDayInstance.getDay()
	firstDayInstance = null

	// number of days in current month
	var days = getDays(month, year)

	// call function to draw calendar
	drawCal(1, days, date, monthName, month,year,emp_code)
}

function drawCal(firstDay, lastDate, date, monthName, month, year,emp_code) {
	if(month==12){
		var nextmonth = 12;
		var premonth = month-1;

	}else if(month==1){

		var premonth = 1;
		var nextmonth = month+1;
	}else{

		var premonth = month-1;
		var nextmonth = month+1;
	}

	


	

	

	// create basic table structure
	var text = "" // initialize accumulative variable to empty string
	var html = "";
	text +='<div class="fc-toolbar myDiv"><div class="fc-left"><h2>'+ monthName + ' ' + year +'</h2></div>'
	text +='<div class="fc-right" style="height:2.1em"><button onclick="setCal('+year+','+premonth+','+date+',\''+emp_code+'\')" class="fc-prev-button fc-button fc-state-default fc-corner-left" type="button" style="height: 2.1em;">'
	text +='<span class="fc-icon fc-icon-left-single-arrow"></span></button>'
	text +='<button  onclick="setCal('+year+','+nextmonth+','+date+','+emp_code+')" class="fc-next-button fc-button fc-state-default" type="button" style="height:2.1em">'
	text +='<span class="fc-icon fc-icon-right-single-arrow"></span></button>'
	text +='<button class="fc-month-button fc-button fc-state-default fc-state-active" type="button" style="height:2.1em">month</button>'
	text +='</div></div><div class="fc-center"></div><div class="fc-clear"></div></div>'

	text += '<table class="table myTable table-bordered">' // table settings

	// variables to hold constant settings
	text += '<tr style="height:60px;"><th style="padding: 38px 20px 5px ! important;">Team Emp Name</th>'
	var openCol = '<th class="text-center rotate" ><div><span>'

	var closeCol = '</div></span></th>'

	// create array of abbreviated day names


	function whichDay(dateString) {
	  	return ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'][new Date(dateString).getDay()];
	}


	var temp = new Array()
	month = ('0' + month).slice(-2)
	for(var i = firstDay; i<= lastDate; ++i){
		ij = ('0' + i).slice(-2)
		temp.push(whichDay(year+"-"+month+"-"+ij))
	}


	// create first row of table to set column width and specify week day
	
	for (var j = 0; j<temp.length; ++j) {
		dnum= j+1;
		text += openCol + dnum +'-'+ temp[j] + closeCol  
	}
	text += '</tr>'

	

	gmonth = ('0' + month).slice(-2)
	
	$.ajax({
		url:'Events/emp_team.php?emp_code='+emp_code,
		type:'GET',
		async: false,
		success:function(data){
			var result = $.parseJSON(data);

			if(result.status==true){
				for(var j = 0; j<result.data.length;j++){
					
					html +='<tr style="height:20px;"><td style="padding: 5px 20px 5px ! important;"><a target="_blank" href="my_calendar.php?emp_code='+result.data[j].emp_code+'">'+result.data[j].emp_fname+'</a></td>'
					$.ajax({
						url: "calling_page.php?type=myNewEvents&emp_code="+result.data[j].emp_code,
                    	type:'POST',
                    	data:{'start':year+'-'+gmonth+'-01','end':year+'-'+gmonth+'-'+lastDate},
                    	async: false,
                    	
						success:function(data1){

							var result1 = $.parseJSON(data1);
							var allDate = new Array();
							var allDateStatus = new Array()
							if(result1 !=null){
								for(var p =0; p<result1.length;p++){
									var str = result1[p].start;
									var temp2 = str.split("-");
									allDate.push(Number(temp2[2]))
									allDateStatus[Number(temp2[2])] = result1[p].presetShortStatus
								}
							}
							if(allDate.length>0 && allDateStatus.length>0){
								for (var q = 1; q<=temp.length; ++q) {
									
									if(allDate.includes(q))
										if(allDateStatus[q]=='W' || allDateStatus[q]=='F')
									   		html += '<td class="text-center" style="background:rgba(0, 100, 0, 0.1) none repeat scroll 0 0"></td>'
										else
											html += '<td class="text-center">' + allDateStatus[q] + '</td>'
									else
									   html += '<td class="text-center"></td>'
									
									  
								}
							}else{
								for (var q = 1; q<=temp.length; ++q) {
									html += '<td class="text-center"></td>'
								}
							}
							
							
						}
					})
					html +='</tr>'

				}

				
				
			}
		
			
		}
	})


	text += html

	// close all basic table tags
	text += '</table>'


	// print accumulative HTML string
	$('#group_calendar').html(text); 
}