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



function setCalSumm(year,month,date,emp_code) {
	
	var monthName = getMonthName(month)
	// create instance of first day of month, and extract the day on which it occurs
	var firstDayInstance = new Date(year, month, 1)
	var firstDay = firstDayInstance.getDay()
	firstDayInstance = null

	// number of days in current month
	var days = getDays(month, year)

	// call function to draw calendar
	drawCal1(1, days, date, monthName, month,year,emp_code)
}

function drawCal1(firstDay, lastDate, date, monthName, month, year,emp_code) {
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
		text +='<div class="fc-right" style="height:2.1em"><button onclick="setCalSumm('+year+','+premonth+','+date+',\''+emp_code+'\')" class="fc-prev-button fc-button fc-state-default fc-corner-left" type="button" style="height: 2.1em;">'
		text +='<span class="fc-icon fc-icon-left-single-arrow"></span></button>'
		text +='<button  onclick="setCalSumm('+year+','+nextmonth+','+date+','+emp_code+')" class="fc-next-button fc-button fc-state-default" type="button" style="height:2.1em">'
		text +='<span class="fc-icon fc-icon-right-single-arrow"></span></button>'
		text +='<button class="fc-month-button fc-button fc-state-default fc-state-active" type="button" style="height:2.1em">month</button>'
		text +='</div></div><div class="fc-center"></div><div class="fc-clear"></div></div>'
		text += '<table class="table myTable table-bordered">' // table settings
		// variables to hold constant settings
		text += '<tr style="height:40px;"><th style="padding:10px ! important;">Team Emp Name</th>'
		text += '<th class="text-center" ><div><span>Working <br>Days</span></div></th>'
		text += '<th class="text-center" ><div><span>Off <br>Days</span></div></th>'
		text += '<th class="text-center" ><div><span>Days <br>Worked</span></div></th>'
		text += '<th class="text-center" ><div><span>Paid <br>Leave</span></div></th>'
		text += '<th class="text-center" ><div><span>LWP <br>Days</span></div></th>'
		text += '<th class="text-center" ><div><span>Days <br>Absent</span></div></th>'
		text += '<th class="text-center" ><div><span>Payroll <br>Days</span></div></th>'
		text += '<th class="text-center" ><div><span>Hours <br>Worked</span></div></th>'
		text += '<th class="text-center" ><div><span>Extra <br>Hours</span></div></th>'
		text += '<th class="text-center" ><div><span>No. Of <br>Days Late</span></div></th>'
		text += '<th class="text-center" ><div><span>Hours Worked<br><span style="font-weight: normal; font-size: 1em; color: rgb(102, 102, 102);">( within shift )</span></span></div></th>'
	
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
						url: "event_counter.php?type=myNewEvents&emp_code="+result.data[j].emp_code,
						type:'POST',
                    	data:{'start':year+'-'+gmonth+'-01','end':year+'-'+gmonth+'-'+lastDate},
                    	async: false,
                    	success:function(data1){
							var result1 = $.parseJSON(data1);
							if(result1 !=null){
								html += '<td class="text-center">'+result1.working_days+'</td>';
								html += '<td class="text-center">'+result1.off_days+'</td>';
								html += '<td class="text-center">'+result1.days_worked+'</td>';
								html += '<td class="text-center">'+result1.pl_days+'</td>';
								html += '<td class="text-center">'+result1.lwp_days+'</td>';
								html += '<td class="text-center">'+result1.absent_days+'</td>';
								html += '<td class="text-center">'+result1.payroll_days+'</td>';
								html += '<td class="text-center">'+result1.hours_worked+'</td>';
								html += '<td class="text-center">'+result1.extra_hours+'</td>';
								html += '<td class="text-center">'+result1.late_days+'</td>';
								html += '<td class="text-center">'+result1.hours_worked_in_shift+'</td>';
							}else{
								html += '<td class="text-center">0</td>';
								html += '<td class="text-center">0</td>';
								html += '<td class="text-center">0</td>';
								html += '<td class="text-center">0</td>';
								html += '<td class="text-center">0</td>';
								html += '<td class="text-center">0</td>';
								html += '<td class="text-center">0</td>';
								html += '<td class="text-center">00:00</td>';
								html += '<td class="text-center">00:00</td>';
								html += '<td class="text-center">0</td>';
								html += '<td class="text-center">00:00</td>';
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
	$('#group_summary').html(text); 
}