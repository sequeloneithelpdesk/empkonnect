function getTables(tablename,pre,divid,status,name){

        $.ajax({
            type : 'POST',
            data:{type:'init',status:status,table:tablename,pre:pre,name:name },
            url  : 'ajax/leaveReport_ajax.php',
            beforeSend: function(){
                loading();
            },
            success: function(responseText){
                unloading();
                $("#"+divid).html(responseText);

            }
        });
}

function selectAttendanceReport(sval,code){

        if(sval == '1'){
            $("#showorg").val('0');
         //   $("#emps").hide();
            $("#multisearch").show();
            $("#multisearch1").show();
            $("#multisearch2").show();
            $("#multisearch3").show();

           
            $('#company-select').searchableOptionList({
                showSelectAll: true,
                 maxHeight: '250px',
                  texts: {
                    
                    searchplaceholder: 'Select Company'
                }
            });
            $('#business-select').searchableOptionList({
                    showSelectAll: true,
                     maxHeight: '250px',
                      texts: {
                        
                        searchplaceholder: 'Select Business Unit'
                    }
            });
            $('#sub-business-select').searchableOptionList({
                    showSelectAll: true,
                     maxHeight: '250px',
                      texts: {
                        
                        searchplaceholder: 'Select Sub Business Unit'
                    }
            });
            $('#location-select').searchableOptionList({
                    showSelectAll: true,
                     maxHeight: '250px',
                      texts: {
                        
                        searchplaceholder: 'Select Location'
                    }
            });
            $('#work-location-select').searchableOptionList({
                    showSelectAll: true,
                     maxHeight: '250px',
                      texts: {
                        
                        searchplaceholder: 'Select Work Location'
                    }
            });
            $('#function-select').searchableOptionList({
                    showSelectAll: true,
                     maxHeight: '250px',
                      texts: {
                        
                        searchplaceholder: 'Select Function'
                    }
            });
            $('#sub-function-select').searchableOptionList({
                    showSelectAll: true,
                     maxHeight: '250px',
                      texts: {
                        
                        searchplaceholder: 'Select Sub Function'
                    }
            });
            $('#cost-master-select').searchableOptionList({
                    showSelectAll: true,
                     maxHeight: '250px',
                      texts: {
                        
                        searchplaceholder: 'Select Cost Master'
                    }
            });
             $('#process-select').searchableOptionList({
                    showSelectAll: true,
                     maxHeight: '250px',
                      texts: {
                        
                        searchplaceholder: 'Select Process'
                    }
            });
              $('#grade-select').searchableOptionList({
                    showSelectAll: true,
                     maxHeight: '250px',
                      texts: {
                        
                        searchplaceholder: 'Select Grade'
                    }
            });
               $('#designation-select').searchableOptionList({
                    showSelectAll: true,
                     maxHeight: '250px',
                      texts: {
                        
                        searchplaceholder: 'Select Designation'
                    }
            });

        }
        else{
            $("#showorg").val('1');
           // alert('hello');
           // $("#emps").show();
            $("#multisearch").hide();
            $("#multisearch1").hide();
            $("#multisearch2").hide();
            $("#multisearch3").hide();
        }

    }                                            
function hideDiv(){
       // alert('hide');
        $('.sol-current-selection').css('display','none');
    }
function selectReport(sval,code){

        if(sval == '1'){
            $("#type").show();
            $("#status").show();
            $("#datesearch").show();
            $("#empsearch").show();
            
        }
        else{
            $("#type").hide();
            $("#status").hide();
            $("#datesearch").hide();
            $("#empsearch").hide();
        }

}

function getRelatedtables(tablename,pre,divid,status,id,name) {
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

    }
    
function Report(){

        var leaveType = $("#Ltype").val();
        var leaveStatus = $("#Lstatus").val();
        var fDate = $("#fromDate").val();
        var tDate = $("#toDate").val();
        var empName = $("#my-default-text-select").val();
        //alert(empName);

        var type="transReport";
        $.ajax({
            type:"POST",
            url:"ajax/leaveReport_ajax.php",
            data:{type:type, leaveType:leaveType, leaveStatus:leaveStatus, fDate:fDate, tDate:tDate, empName:empName},
            success: function(result){
                $("#reportresult").show();
                if(result){
                    //location.reload();
                    $("#reportresult").html(result);
                }else{
                     $("#reportresult").html("no data Available");
                }
            }
        });

}
function attReport(){
        var html = "";
        var mainfil = $("#mainselect").val();

        var fDate = $("#fromDate").val();
        var tDate = $("#toDate").val();
        var empName = $("#my-default-text-select").val();
        var scomp = $("#company-select").val();
        var sbus = $("#business-select").val();
        var ssubbus = $("#sub-business-select").val();
        var sloc = $("#location-select").val();
        var swloc = $("#work-location-select").val();
        var sfunc = $("#function-select").val();
        var ssubfunc = $("#sub-function-select").val();
        var scost = $("#cost-master-select").val();
        var sproc = $("#process-select").val();
        var sgrade = $("#grade-select").val();
        var sdes = $("#designation-select").val();
            
            if(fDate == "")
            {
                toasterrormsg("Select From Date");
                return false;
            }
            if(tDate == "")
            {
                toasterrormsg("Select To Date");
                return false;
            }
        if(mainfil == 3){
            var year ='2016';
            var gmonth = $("#selectmonth").val();
           // alert(gmonth);
            var lastDate = '12';
            var emp_code = $("#my-default-text-select").val();
            setCal(year,gmonth,lastDate,emp_code);
            $("#downloadbtn").css('display','block');
        }
        else {
            if(mainfil == 2){
            var type="inoutReport";
        }        
        else if(mainfil == 4){
            var type="misReport";
        }
        else if(mainfil == 5){
            var type="lateArrival";
        }
        else if(mainfil == 6){
            var type="earlyDeparture";
        }
        else{
            var type="summaryReport";
        }
         $.ajax({
            type:"POST",
            url:"ajax/leaveReport_ajax.php",
            data:{type:type, fDate:fDate, tDate:tDate, empName:empName, scomp:scomp, sbus:sbus, ssubbus:ssubbus
            , sloc:sloc, swloc:swloc, sfunc:sfunc, ssubfunc:ssubfunc, scost:scost
            , sproc:sproc, sgrade:sgrade, sdes:sdes},
            success: function(result){
                $("#downloadbtn").css('display','block');
                $("#reportresult").show();
                if(result){
                    //location.reload();
                    $("#reportresult").html(result);
                }else{
                     $("#reportresult").html("no data Available");
                }
            }
        });


        }
        
      

}

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
    

    text += '<table class="table myTable table-bordered table2excel" id="attendaceval">' // table settings

    // variables to hold constant settings
    text += '<tr style="height:60px;"><th style="padding: 38px 20px 5px ! important;">Emp Name</th>'
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
        url:'https://empkonnect.sequelone.com/pages/Attendance/Events/emp_att.php?emp_code1='+'emp_code',
        type:'POST',
        data:{'emp_code':emp_code},
        async: false,
        beforeSend: function(){
                loading();
            },
        success:function(data){
             unloading();
            var result = $.parseJSON(data);

            if(result.status==true){
                for(var j = 0; j<result.data.length;j++){
                    
                    html +='<tr style="height:20px;"><td style="padding: 5px 20px 5px ! important;"><a target="_blank" href="my_calendar.php?emp_code='+result.data[j].emp_code+'">'+result.data[j].emp_fname+'</a></td>'
                    $.ajax({
                        url: "https://empkonnect.sequelone.com/pages/Attendance/calling_page.php?type=myNewEvents&emp_code="+result.data[j].emp_code,
                        type:'POST',
                        data:{'start':year+'-'+gmonth+'-01','end':year+'-'+gmonth+'-'+lastDate},
                        async: false,
                        
                        success:function(data1){
                            //console.log(data1);    
                            var result1 = JSON.parse(data1);
                           // console.log('--------------------------');
                           // console.log(JSON.parse(result1));

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
                            //alert(allDate.length);
                            if(allDate.length>0 && allDateStatus.length>0){
                                for (var q = 1; q<=temp.length; ++q) {
                                    
                                    if(allDate.includes(q))
                                        if(allDateStatus[q]=='W' || allDateStatus[q]=='F')
                                            html += '<td class="text-center" style="background:rgba(0, 100, 0, 0.1) none repeat scroll 0 0">'+allDateStatus[q]+'</td>'
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
    $('#reportresult').html(text); 
}

function downloadReport()
{
    //alert('helo');
     $(".table2excel").table2excel({
                    exclude: ".noExl",
                    name: "Excel Document Name",
                    filename: "myFileName",
                    fileext: ".xls",
                    exclude_img: true,
                    exclude_links: true,
                    exclude_inputs: true
                });
    //e.preventDefault();
}

function showMonth(month_val){
    var currentDate = $("#fromDate").val();
    var split_date = currentDate.split("-");
   // var day = currentDate.getDay();
   if(month_val.length == 1 ){
    newDate = split_date[0]+'-0'+month_val+'-'+'01';
   }
   else{
    newDate = split_date[0]+'-'+month_val+'-'+'01';
    
   }
    //alert(newDate);
    $("#fromDate,#toDate").val(newDate);
    //$("#fromDate,#toDate").datepicker('setDate', newDate);
    //$("#toDate").datepicker('setDate', newDate);
    $('#fromDate').datepicker( {
            changeMonth: false,
            changeYear: false,
            stepMonths: false,
            dateFormat : 'yy-mm-dd',
            setDate : newDate,
            onSelect: function (selected) {
            var dt = new Date(selected);
            dt.setDate(dt.getDate() + 1);
            $("#toDate").datepicker("option", "minDate", dt);
        },
        duration: 'fast'
        }).focus(function() {
          $(".ui-datepicker-prev, .ui-datepicker-next").remove();
        
        });
   $('#toDate').datepicker( {
            changeMonth: false,
            changeYear: false,
            stepMonths: false,
            dateFormat : 'yy-mm-dd',
            setDate : newDate,
            onSelect: function (selected) {
            var dt = new Date(selected);
            dt.setDate(dt.getDate() - 1);
            $("#fromDate").datepicker("option", "maxDate", dt);
        },
        duration: 'fast'
        }).focus(function() {
          $(".ui-datepicker-prev, .ui-datepicker-next").remove();
        
        
        });
}