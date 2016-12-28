var Role = {

  init:function(status){

     $.ajax({
                    type : 'POST',
                    data:{type:'init',status:status},
                    url  : 'ajax/role_ajax.php',
                    success: function(responseText){
                    
                    $("#showrole").html(responseText);
                }
            });

  },

  createmodel:function(){

       $.ajax({
                    type : 'POST',
                    data:{type:'Add',header:'Create Role',Role_name:'',roledivid:'menu',
                    datadivid:'datamenu',id:'' },
                    url  : 'ajax/add_roleajax.php',
                    success: function(responseText){
                      $('#AddRole').html(responseText);
                    $('#AddRole').modal('show');
                    //$("#showrole").html(responseText);
                }
            });

      
  },

 checkrolename : function(){

var role_name = $('#role_name').val();
            if(role_name.length > 1) {
                $('#rolename_availability_result').html('Loading..');
                var post_string = 'user_name='+role_name;
                $.ajax({
                    type : 'POST',
                    data : post_string,
                    url  : 'ajax/namecheck_ajax.php',
                    success: function(responseText){
                    if(responseText == 0){
                        $('#rolename_availability_result').html('<span class="success" id="result">Rolename name available.</span>');
                    }else if(responseText > 0){
                        $('#rolename_availability_result').html('<span class="error" id="result">Rolename already taken.</span>');
                    }else{
                        alert('Problem with mysql query');
                    }
                }
            });
        }
        else{
            $('#rolename_availability_result').html('');
        }

},

ajax_menu:function(){
  $.ajax({
    type:"POST",
    url:"ajax/role_menuajax.php?type=menu",
    dataType : 'json',
      cache: false,
        beforeSend: function(){
                      loading();
                   },
        success: function(result){
                  unloading();
                  //  result = JSON.parse(result);
                  console.log(result);
                  //alert(result['menuitem']);
                  Role.menu(result);
                  $('#menu').jstree(true).refresh();
           
                   }
  });
},
ajax_datamenu:function(){
  //alert("h");
  $.ajax({
    type:"POST",
    url:"ajax/role_menuajax.php?type=data",
    dataType : 'json',
      cache: false,
        beforeSend: function(){
                      loading();
                   },
        success: function(result){
                  unloading();
                //console.log("this");
                  console.log(result);
            //console me bhi sahi aa rha hai
                  //alert(result);

                  Role.datamenu(result);
            $('#datamenu').jstree(true).refresh();
            //bussiness Unit or Location gayab hai
           
                   }
  });
},
  menu: function(datamenu){
       
   //   <div id="tree_9"></div>
//<input type = "button" value="getdata" onclick ="getdata()">
//<div id="tree_10"></div>

    $('#menu').jstree({
            'plugins': ["wholerow","checkbox", "types"],
            'core': {
                "themes" : {
                    "responsive": false,
          
                },    
                'data': datamenu
            },
            "types" : {
                "default" : {
                    "icon" : "fa fa-folder icon-state-warning icon-lg"
                },
                "file" : {
                    "icon" : "fa fa-file icon-state-warning icon-lg"
                }
            }
        });
    //.on("changed.jstree", function(e, data) {
          //alert(JSON.stringify(data));
           //Role:createjson(data);
      //  });

  },
   datamenu: function(datalevel){
       
   //   <div id="tree_9"></div>
//<input type = "button" value="getdata" onclick ="getdata()">
//<div id="tree_10"></div>

    $('#datamenu').jstree({
            'plugins': ["wholerow","checkbox", "types"],
            'core': {
                "themes" : {
                    "responsive": false,
          
                },    
                'data': datalevel
            },
            "types" : {
                "default" : {
                    "icon" : "fa fa-folder icon-state-warning icon-lg"
                },
                "file" : {
                    "icon" : "fa fa-file icon-state-warning icon-lg"
                }
            }
        });

  },
  //show role ///////////////////////////////////////////////////////////////
  showrole:function(id,role){
    $.ajax({
              type : 'POST',
              data:{type:'Show',header:'Show Role',Role_name:role,
              roledivid:'showmenu',datadivid:'showdatamenu',id:id },
              url  : 'ajax/add_roleajax.php',
              success: function(responseText){
                $('#ShowRole').html(responseText);
                
              $('#ShowRole').modal('show');
                  //$("#showrole").html(responseText);
                }
            });

  },

  ajax_showmenu:function(id){
  $.ajax({
    type:"POST",
    url:"ajax/role_menuajax.php?type=showmenu",
    data:{id:id},
    dataType : 'json',
      cache: false,
        beforeSend: function(){
                      loading();
                   },
        success: function(result){
                  unloading();
                  console.log(result);
                  //alert(result['menuitem']);
                  Role.showmenu(result);
                  //$('#showmenu').jstree(true).refresh();
           
                   }
  });
},
ajax_showdatamenu:function(id){
  //alert("h");
  $.ajax({
    type:"POST",
    url:"ajax/role_menuajax.php?type=showdata",
    data:{id:id},
    dataType : 'json',
      cache: false,
        beforeSend: function(){
                      loading();
                   },
        success: function(result){
                  unloading();
                  console.log(result);
                  //alert(result);
                  Role.showdatamenu(result);
                  //$('#showdatamenu').jstree(true).refresh();
           
                   }
  });
},
 showmenu: function(datamenu){
       
   //   <div id="tree_9"></div>
//<input type = "button" value="getdata" onclick ="getdata()">
//<div id="tree_10"></div>
    var data1= Role.createjson(datamenu);
    $('#showmenu').jstree({
            'plugins': ["state","types"],
            'core': {
                "themes" : {
                    "responsive": false,
          
                },    
                'data': data1
            },
            "types" : {
                "default" : {
                    "icon" : "fa fa-folder icon-state-warning icon-lg"
                },
                "file" : {
                    "icon" : "fa fa-file icon-state-warning icon-lg"
                }
            }
        });
    //.on("changed.jstree", function(e, data) {
          //alert(JSON.stringify(data));
           //Role:createjson(data);
      //  });

  },
   showdatamenu: function(datamenu){
       
   //   <div id="tree_9"></div>
//<input type = "button" value="getdata" onclick ="getdata()">
//<div id="tree_10"></div>
    var data1=Role.createjson(datamenu);

    $('#showdatamenu').jstree({
            'plugins': ["state","types"],
            'core': {
                "themes" : {
                    "responsive": false,
          
                },    
                'data': data1
            },
            "types" : {
                "default" : {
                    "icon" : "fa fa-folder icon-state-warning icon-lg"
                },
                "file" : {
                    "icon" : "fa fa-file icon-state-warning icon-lg"
                }
            }
        });
    //.on("changed.jstree", function(e, data) {
          //alert(JSON.stringify(data));
           //Role:createjson(data);
      //  });

  },


  //edit role ///////////////////////////////////////////////////////////////
  editrole:function(id,role){
    $.ajax({
              type : 'POST',
              data:{type:'Edit',header:'Edit Role',Role_name:role,
              roledivid:'editmenu',datadivid:'editdatamenu',id:id },
              url  : 'ajax/add_roleajax.php',
              success: function(responseText){
                $('#EditRole').html(responseText);
                
              $('#EditRole').modal('show');
              //$("#showrole").html(responseText);
                }
            });

  },

  ajax_editmenu:function(id){
  $.ajax({
    type:"POST",
    url:"ajax/role_menuajax.php?type=editmenu",
    data:{id:id},
    dataType : 'json',
      cache: false,
        beforeSend: function(){
                      loading();
                   },
        success: function(result){
                  unloading();

                 //   result = JSON.parse(result);
                  //alert(JSON.stringify(result));
                  Role.editmenu(result);
                //  $('#editmenu').jstree(true).refresh();
           
                   }
  });
},
ajax_editdatamenu:function(id){
  alert("h");
  $.ajax({
    type:"POST",
    url:"ajax/role_menuajax.php?type=editdata",
    data:{id:id},
    dataType : 'json',
      cache: false,
        beforeSend: function(){
                      loading();
                   },
        success: function(result){
                  unloading();
                  console.log(result);
                  //alert(JSON.stringify(result));
                  Role.editdatamenu(result);
                  //$('#editdatamenu').jstree(true).refresh();
           
                   }
  });
},
 editmenu: function(datamenu){
       
   //   <div id="tree_9"></div>
//<input type = "button" value="getdata" onclick ="getdata()">
//<div id="tree_10"></div>
     console.log(datamenu);
    $('#editmenu').jstree({
            'plugins': ["wholerow","checkbox","types"],
            'core': {
                "themes" : {
                    "responsive": false,
          
                },    
                'data': datamenu
            },
            "types" : {
                "default" : {
                    "icon" : "fa fa-folder icon-state-warning icon-lg"
                },
                "file" : {
                    "icon" : "fa fa-file icon-state-warning icon-lg"
                }
            }
        } );
    //.on("changed.jstree", function(e, data) {
          //alert(JSON.stringify(data));
           //Role:createjson(data);
      //  });

  },
   editdatamenu: function(data){
       
   //   <div id="tree_9"></div>
//<input type = "button" value="getdata" onclick ="getdata()">
//<div id="tree_10"></div>

    $('#editdatamenu').jstree({
            'plugins': ["wholerow","checkbox","types"],
            'core': {
                "themes" : {
                    "responsive": false,
          
                },    
                'data': data
            },
            "types" : {
                "default" : {
                    "icon" : "fa fa-folder icon-state-warning icon-lg"
                },
                "file" : {
                    "icon" : "fa fa-file icon-state-warning icon-lg"
                }
            }
        });
    //.on("changed.jstree", function(e, data) {
          //alert(JSON.stringify(data));
           //Role:createjson(data);
      //  });

  },
    
  createjson: function (data){
    var newArray = [];
    var y = 0;
    for(var i = 0; i < data.length; i++){
      if(data[i]["state"] && data[i]["state"]["selected"]){
        newArray.push(data[i]);
      }else{
        if(data[i]["children"] && data[i]["children"].length){
          data[i]["children"] = Role.createjson(data[i]["children"]);
          if(data[i]["children"] && data[i]["children"].length){
            newArray.push(data[i]);
          }
        }
      }
      
    }
    return newArray;
   
  },
  
  subrole : function(type,id){

      if(type=="Add"){
      var mytext = $('#menu').jstree(true).get_json('#', {flat:false});
      var mydata=JSON.stringify(mytext);
      var mytext1 = $('#datamenu').jstree(true).get_json('#', {flat:false});
      var mydata1=JSON.stringify(mytext1);

      //alert(mydata1);
      var resultmsg=$("#result").html();
          if ($('#defaultcheck').is(":checked"))
          {
              var check=1;
          }
          else
          {
              var check=0;
          }
      var name ;
      name = $("#role_name").val();
      if(resultmsg == "Rolename already taken."){
       name = "";
      }
      //alert(name);
      if(name==""){
        alert("Please fill valid Role name.");
      }
      else{
      $.ajax({
      type: "POST",
      url: "ajax/role_ajax.php",
      data: {type:'create',role:name,roledata:mydata,datamenu:mydata1,check:check} ,
      cache: false,
      beforeSend: function(){
                      loading();
                   },
       success: function(result){
                  unloading();
                  //alert(result);
                  if(result=="Y"){
                    toastmsg("Successfully Role Created.");

                  }
                  else{
                     // alert(result);
                    toasterrormsg(result);
                  }
                  $('#role_name').val("");
                  $('#menu').jstree(true).refresh();
                  $('#datamenu').jstree(true).refresh();
                  $('#AddRole').modal('hide');
                  Role.init();
                  
           
       }
    });

    }
  }
  else{
    var mytext = $('#editmenu').jstree(true).get_json('#', {flat:false});
      var mydata=JSON.stringify(mytext);
      var mytext1 = $('#editdatamenu').jstree(true).get_json('#', {flat:false});
      var mydata1=JSON.stringify(mytext1);
      //alert(mydata);
      
      name = $("#role_name").val();
      
      $.ajax({
      type: "POST",
      url: "ajax/role_ajax.php",
      data: {type:'edit',role:name,roledata:mydata,datamenu:mydata1,id:id} ,
      cache: false,
      beforeSend: function(){
                      loading();
                   },
      success: function(result){
                  unloading();
                  //alert(result);
                  if(result=="Y"){
                    toastmsg("Successfully Updated .");

                  }
                  else{
                    toasterrormsg(result);
                  }
                  $('#role_name').val("");
                  $('#editmenu').jstree(true).refresh();
                  $('#editdatamenu').jstree(true).refresh();
                  $('#EditRole').modal('hide');
                  Role.init();
                  
           
       }
    });
  }

},

deletefunc : function(dbid,tbid,status){

    $.ajax({
      type: "POST",
      url: "ajax/role_ajax.php",
      data: {type:'delete',id:dbid,status:status} ,
      cache: false,
      beforeSend: function(){
                      loading();
                   },
      success: function(result){
                  unloading();
                  
                  if(result=="Y"){

                    if(status=="Active"){
                           var status1="Inactive";
                        }else{
                          var  status1="Active";
                        }
                    $("#st"+tbid).html(status1);
                    Role.init();

                  }
                  else{
                    alert(result);
                  }
                  
           
       }
    });
}

};

var year={

  finend: function(){
      var y1=$('#finyear').val();
        if(y1==""){
          $('#finenddate').val("");
        }
          else{
       //yearend=y1.substring(5);
           var Y=parseInt(y1) +1;
       $('#finenddate').val("31/03/"+Y);
     }
    
  },
  rmbend: function(y2){
     if(y2==""){
      $('#rmbenddate').val("");
     }
          else{
       yearend1=y2.substring(5);
       $('#rmbenddate').val("31/03/"+yearend1);
    }
  },
  levend: function(y3){
     if(y3==""){
      $('#levenddate').val("");
     }
          else{
       yearend2=y3.substring(5);
       $('#levenddate').val("31/12/"+yearend2);
      }
  },
  finsub: function(){
    var year1=$("#finyear").val();
    var startdate=$("#finstartdate").val();
    var yeartext=$("#yeartext").val();
    if(year1==""|| startdate=="" || yeartext==""){
      alert("Please Fill all Data");
      //toastmsg("Success");
    }
    else{
    $.ajax({
      type: "POST",
      url: "ajax/changeyear.php",
      data: {type:'finyear',year:year1, startdate:startdate,enddate:yeartext },
      cache: false,
      beforeSend: function(){
                      loading();
                   },
      success: function(result){
                  unloading();
                  if(result==1){
                  toastmsg("Success");
                }
                else{
                  toasterrormsg("Error");
                }
           
       }
    });
    }
  },

  rmbsub: function(){
    var year1=$("#rmbyear").val();
    var startdate=$("#rmbstartdate").val();
    var enddate=$("#rmbenddate").val();
    if(year1==""|| startdate=="" || enddate==""){
     // alert("no");
    }
    else{
    $.ajax({
      type: "POST",
      url: "ajax/changeyear.php",
      data: {type:'rmbyear',year:year1, startdate:startdate,enddate:enddate },
      cache: false,
      beforeSend: function(){
                      loading();
                   },
      success: function(result){
                  unloading();
                  if(result=="Y"){
                  toastmsg("Success");
                }
                else{
                  toasterrormsg("Error");
                }
           
       }
    });
    }
  },

  levsub: function(){
    var year1=$("#levyear").val();
    var startdate=$("#levstartdate").val();
    var enddate=$("#levenddate").val();
    if(year1==""|| startdate=="" || enddate==""){

    }
    else{
    $.ajax({
      type: "POST",
      url: "ajax/changeyear.php",
      data: {type:'levyear',year:year1, startdate:startdate,enddate:enddate },
      cache: false,
      beforeSend: function(){
                      loading();
                   },
      success: function(result){
                  unloading();
                  if(result=="Y"){
                  toastmsg("Success");
                }
                else{
                  toasterrormsg("Error");
                }
           
       }
    });
    }
  }
};

var polform = {

  policies : function(){

      var aFormData = new FormData();
      var policiesname=$("#policiesname").val();
       var subpoliciesname=$("#subpoliciesname").val();
       var fromDate=$("#fromDate").val();
        var policiestitle=$("#policiestitle").val();
      aFormData.append("hr", $('#hrpolicies').get(0).files[0]);
      //aFormData.append("name",name);
      //aFormData.append("admin", $('#adminpolicies').get(0).files[0]);
        //console.log(aFormData.length);
      if(policiesname=="" || policiestitle=="" ||fromDate=="" || aFormData.length=="undefined"){
          toasterrormsg("Fill All valid Fields. ");
      }
      else {
      // alert(fromDate);
          $.ajax({
              type: "POST",
              url: "ajax/policies.php?type=policies&policiesname=" + policiesname+"&subpoliciesname="+subpoliciesname+"&policiestitle="+policiestitle+"&fromDate="+fromDate,
              data: aFormData,
              cache: false,
              processData: false,
              contentType: false,
              beforeSend: function () {
                  loading();
              },
              success: function (result) {
                  unloading();
                  //alert(result);
                  if (result == "Y") {
                      toastmsg("Successfully Uploaded.");
                      polform.showpolicies();
                      $("#formname").val("");
                  }
                  else {
                      toasterrormsg(result);
                  }

              }
          });
      }
  },

  showpolicies : function(){

      $.ajax({
      type: "POST",
      url: "ajax/policies.php?type=showpolicies",
      data: {policies:'policies'} ,
      cache: false,
      processData: false,
      contentType: false,
      beforeSend: function(){
                      loading();
                   },
      success: function(result){
                  unloading();
                  $("#showpolicies").html(result);
           
       }
    });

  },
  hrstatus : function(id,no,status){
    $.ajax({
      type: "POST",
      url: "ajax/policies.php?type=hrstatus",
      data: {id:id,status:status} ,
      cache: false,
      beforeSend: function(){
                      loading();
                   },
      success: function(result){
                  unloading();
                  
                  if(result=="Y"){

                    if(status=="1"){
                            status1="Inactive";
                        }else{
                            status1="Active";
                        }
                    $("#hrstatus"+no).html(status1);
                    polform.showpolicies();

                  }
                  else{
                    alert(result);
                  }
                  
           
       }
    });
  }

};

var User={

  init: function(){

      $.ajax({
                    type : 'POST',
                    url  : 'ajax/userinfo_ajax.php?type=init',
                    success: function(responseText){
                    
                    $("#showuser").html(responseText);
                }
            });

  },

  createmodel:function(){

    $.ajax({
      type: "POST",
      url: "ajax/userrole_ajax.php",
      cache: false,
      beforeSend: function(){
                      loading();
                   },
      success: function(result){
                  unloading();
                  $('#AddRole').html(result);
                  $("#AddRole").modal('show');
                  //User.usercode();
           
       }
    });
  },
fill: function(){
    var code=$('#usercode1').val();
    $('#hidcode').val(code);
},
  filluser:function(code){
	//$('#errorhid').val('0');
    $.ajax({
      type: "POST",
      url: "ajax/userinfo_ajax.php?type=usercode",
      data:{ empcode:code },
      cache: false,
      dataType: 'json',
      beforeSend: function(){
                      loading();
                   },
      success: function(result){
                  unloading();
				  
                  $('#hidcode').val(code);
                  $('#user_name').val(result[0]);
                  $('#user_email').val(result[1]);
				  
				  //$('#user_email').unbind('keyup.validate.email');
                  
       }
    });
  },

  subrole:function(){
    var code=$('#hidcode').val();
      //var code1=$('#usercode1').val();
    var name=$('#user_name').val();
    var email1=$('#user_email').val();
    email=email1.trim();
	   //alert(email.length);
    var role=$('#rolecode').val();
      var error=$("#errorhid").val();
	  
    if( name=="" || email.length==0 || !email){
        toasterrormsg("Fill all valid Fields.");
    }
    else{
    $.ajax({
      type: "POST",
      url: "ajax/userinfo_ajax.php?type=rolesub",
      data:{code:code,name:name,email:email,role:role},
      cache: false,
      beforeSend: function(){
                      loading();
                   },
      success: function(result){
                  unloading();
                  if(result==1){
                  toastmsg("Successfully Uploaded.");
                  $("#Addrole").modal("hide");
                      User.init();
                }
                else{
                  toasterrormsg(result);
                }
                  
           
       }
    });
  }
  },

    deletefunc : function(dbid,tbid,status){

        $.ajax({
            type: "POST",
            url: "ajax/userinfo_ajax.php?type=delete",
            data: {id:dbid,status:status} ,
            cache: false,
            beforeSend: function(){
                loading();
            },
            success: function(result){
                unloading();

                if(result=="Y"){

                    if(status==1){
                        var status1="Inactive";
                    }else{
                        var  status1="Active";
                    }
                    $("#st"+tbid).html(status1);
                    User.init();

                }
                else{
                    alert(result);
                }


            }
        });
    },
    
    roleconfirm:function(role,id){
		var role1=$('#rolecode').find('option:selected').text();
        $.confirm({
            title: 'Change Role',
            content: 'Are you sure to change '+role1+' Role ?',
            confirm: function(){
                $.alert('You are confirmed .');
            },
            cancel: function(){
                $.alert('Canceled!');
				$("#"+id).modal('hide');
            }
        });
        
    }


};





/*-------Start Password Policy---------*/

$("#submitpasspolicy").click(function() {
    /*------------------*/
    var allVals = [];
    function updateTextArea() {

        $('#c_b :checked').each(function() {
            allVals.push($(this).val());
        });
        //alert(allVals);

    }
    $('#c_b input').click(updateTextArea);
    updateTextArea();
    /*------------------*/

    var allVals_def = [];
    function updateTextArea1() {

        $('#c_b1 :checked').each(function() {
            allVals_def.push($(this).val());
        });
        //alert(allVals);

    }
    $('#c_b1 input').click(updateTextArea1);
    updateTextArea1();

    var passLength = $("#slider-range-max-amount").html();

    /*------------------*/

    var radioAlpha = $("input[name='alpha']:checked").val();
    var radioUpperCase = $("input[name='uppercase']:checked").val();
    var radioLowerCase = $("input[name='lowercase']:checked").val();
    var radioNumber = $("input[name='numb']:checked").val();
    var radioSpecial = $("input[name='spec']:checked").val();

    //alert(radioAlpha);
    // alert(radioNumber);
    //alert(radioSpecial);
    //alert(radioUpperCase);
    /*------------------*/


    var change_password_days,change_password_days_status,earlier_password_use,earlier_password_use_status,userid_case_sensitive,
        userid_sensitive_status,invalidAttempts,invalidTime,locked_userid_status,autounlock,userid_unlock_status,password_reset_link,
        password_reset_link_status,password_reset_ques1,password_reset_ques1_status,ask_for_otp,ask_for_otp_status,default_password,default_password_status,
        default_password_expiry,default_password_expiry_status;

    var alphabet = $("#alphabet").val();
    var uppercase_letter = $("#uppercaseletter").val();
    var lowercase_letter = $("#lowercaseletter").val();
    var no_number = $("#number").val();
    var special = $("#special").val();
    change_password_days_status = $("#change_password_days_status").val();
    if(change_password_days_status == 0)
    {
        change_password_days = 0;
    }
    else
    {
        change_password_days = $("#slider-range-max-amount5").html();
    }

    earlier_password_use_status = $("#earlier_password_use_status").val();
    if(earlier_password_use_status == 0)
    {
        earlier_password_use = 0;
    }
    else
    {
        earlier_password_use = $("#slider-range-max-amount6").html();
    }

    userid_sensitive_status = $("#userid_sensitive_status").val();
    if(userid_sensitive_status == 0)
    {
        userid_case_sensitive = 0;
    }
    else
    {
        userid_case_sensitive = $("#userid_case_sensitive").val();
    }

    locked_userid_status = $("#locked_userid_status").val();
    if(locked_userid_status == 0)
    {
        invalidAttempts = 0;
        invalidTime = 0;
    }
    else
    {
        invalidAttempts = $("#invalidAttempts").val();
        invalidTime = $("#invalidTime").val();
    }

    userid_unlock_status = $("#userid_unlock_status").val();
    if(userid_unlock_status == 0) {
        autounlock = 0;
    }
    else
    {
        autounlock = $("#autounlock").val();
    }

    password_reset_link_status = $("#password_reset_link_status").val();
    if(password_reset_link_status == 0) {
        password_reset_link = 0;
    }
    if(password_reset_link_status != 0)
    {
        password_reset_link = $("#password_reset_link").val();
    }

    password_reset_ques1_status = $("#password_reset_question_status").val();
    if(password_reset_ques1_status == 0) {
        password_reset_ques1 = '';
    }
    else
    {
        password_reset_ques1 = allVals;
    }
    if(allVals.length > 0){
      password_reset_ques1_status = 1;
    }
    else{
      password_reset_ques1_status = 0;
    }


    default_password_status = $("#default_password_status").val();
    if(default_password_status == 0) {
        default_password = '';
    }
    else
    {
        default_password = allVals_def;
    }
    if(allVals_def.length > 0){
      default_password_status = 1;
    }
    else{
      default_password_status = 0;
    }

    ask_for_otp_status = $("#ask_for_otp_status").val();

    if(ask_for_otp_status == 0 ) {
        ask_for_otp = 0;
    }
    else
    {
        ask_for_otp = $("#ask_for_otp").val();
    }

    default_password_expiry_status = $("#default_password_expiry_status").val();

    if(default_password_expiry_status == 0 ) {
        default_password_expiry = 0;
    }
    else
    {
        default_password_expiry = $("#default_password").val();
    }


    var alphabet_radio= radioAlpha;
    var uppercase_radio= radioUpperCase;
    var lowercase_radio= radioLowerCase;
    var number_radio = radioNumber;
    var special_characters = radioSpecial;

    if(alphabet_radio == "0"){
        uppercase_radio ="0";
        lowercase_radio = "0";
    }

    var dataString = 'passLength='+ passLength +
        '&alpha_radio=' + alphabet_radio +
        '&uppercase_radio=' + uppercase_radio +
        '&lowercase_radio=' + lowercase_radio +
        '&number_radio=' + number_radio +
        '&special_characters=' + special_characters +
        '&alphabet=' + alphabet +
        '&upper_letter=' + uppercase_letter +
        '&lower_letter=' + lowercase_letter +
        '&no_number=' + no_number +
        '&special=' + special +
        '&change_password_days=' + change_password_days +
        '&earlier_password_use=' + earlier_password_use +
        '&userid_case_sensitive=' + userid_case_sensitive +
        '&change_password_days_status=' + change_password_days_status +
        '&earlier_password_use_status=' + earlier_password_use_status +
        '&userid_sensitive_status=' + userid_sensitive_status +
        '&invalidAttempts=' + invalidAttempts +
        '&invalidTime=' + invalidTime +
        '&locked_userid_status=' + locked_userid_status +
        '&autounlock=' + autounlock +
        '&userid_unlock_status=' + userid_unlock_status +
        '&password_reset_link=' + password_reset_link +
        '&password_reset_link_status=' + password_reset_link_status +
        '&password_reset_ques1=' + password_reset_ques1 +
        '&password_reset_ques1_status=' + password_reset_ques1_status +
        '&call_val=' + "2" +
        '&ask_for_otp=' + ask_for_otp +
        '&ask_for_otp_status=' + ask_for_otp_status +
        '&default_password=' + default_password +
        '&default_password_status=' + default_password_status +
        '&default_password_expiry=' + default_password_expiry +
        '&default_password_expiry_status=' + default_password_expiry_status ;

    if(passLength=='' || alphabet=='' || special=='' || no_number=='')
    {

        $('.success').fadeOut(500).hide();
        $('.error').fadeOut(500).show();
    }
    else if(parseInt(passLength)<=parseInt(alphabet)+parseInt(special)+parseInt(no_number)){
      //  alert(passLength);

        //alert(alphabet);
        //alert(special);
        //alert(no_number);
    }
    else {
        //alert(dataString);
        $.ajax({
            type: "POST",
            url: "ajax/json.php",
            data: dataString,
            success: function (result) {
                    if(result == 1) {
                        toastmsg("Policy Created Successfully");
                        setTimeout(function() { window.location=window.location;},3000);
                        
                    }else if(result == 2) {
                        toasterrormsg("Policy Already Created. You are only eligible to change the policy");
                    }
                    else {
                        toasterrormsg("Failed in Addition");
                    }
                }
        });
    }


});

/*-------End Password Policy--------*/



/*-------Start Mail Configuration--------*/

$("#submitmailconfig").click(function () {

    var subject = $("#subject").val();
    var notification = $("#notification").val();
    var editorText = CKEDITOR.instances.maileditor.getData();
    var mailCategory = $("#mailCategory").val();
    var type= $("#add").val();

    var datastring = 'subject=' + subject + '&notification=' + notification + '&editorText=' + editorText + '&type=' + type + '&mailCategory=' + mailCategory;

    if(subject=='' || notification=='' || editorText=='')
    {
        alert("enter all field");

    }else {
        // alert(dataString);
        $.ajax({
            type: "POST",
            url: "ajax/mailConfig_ajax.php",
            data: datastring,
            success: function () {
                alert("success");
                $('.success').fadeIn(500).show();
                $('.error').fadeOut(500).hide();
            }
        });
    }});

function showmailconfigview() {
    $.ajax({
        type: "POST",
        url: "ajax/mailconfigview.php",
        data: {mailconfigview:'mailconfigview'} ,
        cache: false,
        processData: false,
        contentType: false,
        success: function(result){
            //alert(result);
            $("#mailconfigshow").html(result);

        }
    });

}


function mailconfigedit(id,subject,notification,content,category) {
    $.ajax({
        type : 'POST',
        data:{id:id,subject:subject,notification:notification,content:content,category:category },
        url  : 'ajax/mailConfigEdit_ajax.php',
        success: function(responseText){
            $('#EditMailConfig').html(responseText);
            $('#EditMailConfig').modal('show');

        }
    });
}

function abc(category_value){

    $("#selectcategory").val(category_value);
}
function editMail() {

    var subject = $("#subject").val();
    var notification = $("#notification").val();
    var editorText = CKEDITOR.instances.maileditor.getData();
    var category2 = $("#selectcategory").val();
    var type= $("#type").val();
    var id= $("#mailid").val();

    var datastring = 'subject=' + subject + '&notification=' + notification + '&editorText=' + editorText + '&type=' + type + '&id=' + id + '&category2=' + category2;
    // alert(datastring);
    if(subject=='' || notification=='' || editorText=='')
    {
        alert("enter all field");

    }else {

        $.ajax({
            type: "POST",
            url: "ajax/mailConfig_ajax.php",
            data: datastring,
            success: function () {
                alert("success");
                location.reload();
                $('.success').fadeIn(500).show();
                $('.error').fadeOut(500).hide();
            }
        });
    }
}




function configMailActivated(id,rowid) {

    //alert("1");
    var status = $("#activated"+rowid).val();

    var type= "mailstatus";

    $.ajax({
        type: "POST",
        url: "ajax/mailConfig_ajax.php",
        data: {id:id,status:status,type:type} ,
        cache: false,
        beforeSend: function(){
            loading();
        },
        success: function(result){
            unloading();
            //alert(result);
            if(result== 1){
                //alert(result);
                if(status == "Active"){
                    var status1="Inactive";
                }else{
                    var status1="Active";
                }
                //alert(status1);
                $("#mailActivated" + rowid).html(status1);
                $("#activated" + rowid).val(status1);
                //showmailconfigview();

            }
            else{
                alert(result);
            }


        }
    });

}




/*-------End Mail Configuration--------*/


/*---------Start Company Announcement--------*/
function  update_annu() {

    var status_val = $("#announcement").val();
    var id = $("#hide_id").val();
    var FromDate = $("#fdate").val();
    var ToDate = $("#tdate").val();
    var Topic = $("#topic").val();
//alert(FromDate);


    var editorText = $('#anneditor').data('markdown').parseContent();



    if(validFromDate=='' || validToDate=='' || editorText=='')
    {
        alert("enter all field");

    }
    else {
        var newFromDate = FromDate.split("/");
        var validFromDate = newFromDate[0]+ "/" +newFromDate[1]+ "/" +newFromDate[2].substring(2);

        var newToDate = ToDate.split("/");
        var validToDate = newToDate[0]+ "/" +newToDate[1]+ "/" +newToDate[2].substring(2);
        //   alert(editorText);
        //alert(dataString);
        if(typeof id == 'undefined'){
            //alert('he');
            var status_val = '';
            var datastring = 'fdate=' + validFromDate + '&tdate=' + validToDate+ '&editorText=' + editorText+  '&status_val=' + status_val+ '&id=' + id+ '&Topic=' + Topic;
            $.ajax({
                type: "POST",
                url: "ajax/compAnnounce.php",
                data: datastring,
                success: function (result) {
                    if(result == 1) {
                        toastmsg("Notification Added Successfully");
                        setInterval(function() {
                            window.location.reload();
                        }, 300000);
                    }else {
                        toasterrormsg("Failed in Addition");
                    }
                }
            });
        }
        else{
            var status_val = 'edit';
            editorText = editorText.replace('&lt;p&gt;', '');
            var datastring = 'fdate=' + validFromDate + '&tdate=' + validToDate+ '&editorText=' + editorText+ '&status_val=' + status_val+ '&id=' + id+ '&Topic=' + Topic;
            $.ajax({
                type: "POST",
                url: "ajax/compAnnounce.php",
                data: datastring,
                success: function (result) {
                    if(result == 1) {
                        toastmsg("Notification Updated Successfully");
                        setInterval(function() {
                            location.reload();
                        }, 300000);
                    }else {
                        toasterrormsg("Failed in Updation");
                    }
                }
            });
        }

    }

}

/*--------- End Company Announcement----------*/

/*--------- Start Edit Company Announcement----------*/
function update_status_login(id,action){

    if(action == 'edit'){

        var datastring = 'id=' + id + '&action=' + action;
        $.ajax({
            type: "POST",
            url: "ajax/edit_compannounce.php",
            data: datastring,
            success: function (html) {

                $('#modalbody').html(html);

                $('#companyNotificationpopup').modal({
                    show: true

                });
                $('#close').click(function() {
                    location.reload();
                });
            }
        });

    }
    else{
        $.ajax({
            type: "POST",
            url: "ajax/add_compannounce.php",
            data: datastring,
            success: function (data) {

                $('#modalbody').html(data);
                $( "#fdate" ).datepicker();
                $( "#tdate" ).datepicker();
                $('#companyNotificationpopup').modal({
                    show: true

                });
                $('#close').click(function() {
                    location.reload();
                });
            }
        });


    }


}
/*--------- End Edit Company Announcement----------*/

/*---------Start Departmental Announcement--------*/
function update_noti(){

    var id = $("#hide_id").val();
    var department_name = $("#departments").val();
  //  alert(id);
    var FromDate = $("#fdate").val();
    var ToDate = $("#tdate").val();
    var Topic = $("#topic").val();
    var editorText = $('#departeditor').data('markdown').parseContent();


    if(FromDate=='' || ToDate=='' || editorText=='' || department_name=='' || Topic=='')
    {
        toasterrormsg("Enter All Fields");

    }
    else {
        var newFromDate = FromDate.split("/");
        var validFromDate = newFromDate[0]+ "/" +newFromDate[1]+ "/" +newFromDate[2].substring(2);

        var newToDate = ToDate.split("/");
        var validToDate = newToDate[0]+ "/" +newToDate[1]+ "/" +newToDate[2].substring(2);
        //   alert(editorText);
        //alert(dataString);
        if(typeof id == 'undefined'){
            alert('he');
            var status_val = '';
            var datastring = 'fdate=' + validFromDate + '&tdate=' + validToDate+ '&editorText=' + editorText+ '&depart=' + department_name+ '&status_val=' + status_val+ '&id=' + id+ '&Topic=' + Topic;
            $.ajax({
                type: "POST",
                url: "ajax/departNotification.php",
                data: datastring,
                success: function (result) {
                    if(result == 1) {
                        toastmsg("Notification Added Successfully");
                        setInterval(function() {
                            window.location.reload();
                        }, 300000);
                    }else {
                        toasterrormsg("Failed in Addition");
                    }
                }
            });
        }
        else{
            var status_val = 'edit';
            editorText = editorText.replace('&lt;p&gt;', '');
            var datastring = 'fdate=' + validFromDate + '&tdate=' + validToDate+ '&editorText=' + editorText+ '&depart=' + department_name+ '&status_val=' + status_val+ '&id=' + id+ '&Topic=' + Topic;
            $.ajax({
                type: "POST",
                url: "ajax/departNotification.php",
                data: datastring,
                success: function (result) {
                    if(result == 1) {
                        toastmsg("Notification Updated Successfully");
                        setInterval(function() {
                            location.reload();
                        }, 300000);
                    }else {
                        toasterrormsg("Failed in Updation");
                    }
                }
            });
        }

    }
}

/*--------- End Departmental Announcement----------*/


function update_department_notifi(id,action){

    if(action == 'edit'){
       // alert(id,action);
        var datastring = 'id=' + id + '&action=' + action;
        $.ajax({
            type: "POST",
            url: "ajax/edit_departnotification.php",
            data: datastring,
            success: function (html) {
                $('#modalbody').html(html);
                $('#departmentalNotificationpopup').modal({
                    show: true

                });
            }
        });

    }
    else{
        $.ajax({
            type: "POST",
            url: "ajax/add_departnotification.php",
            data: datastring,
            success: function (data) {

                $('#modalbody').html(data);
                $('#departmentalNotificationpopup').modal({
                    show: true

                });
            }
        });


    }
}


/*---------Start Reporting Notification--------*/

function update_report_notifi(id,action){

    if(action == 'edit'){
        //alert(id,action);
        var datastring = 'id=' + id + '&action=' + action;
        $.ajax({
            type: "POST",
            url: "ajax/edit_reportingnoti.php",
            data: datastring,
            success: function (html) {
                $('#modalbody').html(html);
                $('#reportingNotificationpopup').modal({
                    show: true

                });
            }
        });

    }
    else{
        $.ajax({
            type: "POST",
            url: "ajax/add_reportingnoti.php",
            data: datastring,
            success: function (data) {

                $('#modalbody').html(data);
                $('#reportingNotificationpopup').modal({
                    show: true

                });
            }
        });


    }
}

function update_report(){

    var teamArr = [];
    $(".empcheck:checked").each(function(){
        teamArr.push($(this).val());
    });
  //  var editor = $("#reporteditor").val();

    var id = $("#hide_id").val();
    var Topic = $("#topic").val();
    var FromDate = $("#fdate").val();
    var ToDate = $("#tdate").val();



    var editorText = $('#reporteditor').data('markdown').parseContent();


    if(validFromDate=='' || validToDate=='' || editorText=='' || teamArr=='' || Topic =='')
    {
        alert("enter all field");

    }
    else {
        var newFromDate = FromDate.split("/");
        var validFromDate = newFromDate[0]+ "/" +newFromDate[1]+ "/" +newFromDate[2].substring(2);

        var newToDate = ToDate.split("/");
        var validToDate = newToDate[0]+ "/" +newToDate[1]+ "/" +newToDate[2].substring(2);
        //   alert(editorText);
        //alert(dataString);
        if(typeof id == 'undefined'){
           // alert('he');
            var status_val = '';
            var datastring = 'fdate=' + validFromDate + '&tdate=' + validToDate+ '&editor=' + editorText+ '&depart=' + teamArr+ '&status_val=' + status_val+ '&id=' + id+ '&Topic=' + Topic;
            $.ajax({
                type: "POST",
                url: "ajax/reportNotification.php",
                data: datastring,
                success: function (result) {
                    if(result == 1) {
                        toastmsg("Notification Added Successfully");
                        setInterval(function() {
                            window.location.reload();
                        }, 300000);
                    }else {
                        toasterrormsg("Failed in Addition");
                    }
                }
            });
        }
        else{
            var status_val = 'edit';
            editorText = editorText.replace('&lt;p&gt;', '');
            var datastring = 'fdate=' + validFromDate + '&tdate=' + validToDate+ '&editor=' + editorText+ '&depart=' + teamArr+ '&status_val=' + status_val+ '&id=' + id+ '&Topic=' + Topic;
            $.ajax({
                type: "POST",
                url: "ajax/reportNotification.php",
                data: datastring,
                success: function (result) {
                    if(result == 1) {
                        toastmsg("Notification Updated Successfully");
                        setInterval(function() {
                            location.reload();
                        }, 300000);
                    }else {
                        toasterrormsg("Failed in Updation");
                    }
                }
            });
        }

    }



}
/*--------- End Reporting Notification----------*/


/*---------Start WorkFlow Configuration--------*/

function workflow_action(id,action){

    if(action == 'edit'){
        //alert(id,action);
        var datastring = 'id=' + id + '&action=' + action;
        $.ajax({
            type: "POST",
            url: "ajax/edit_workflow.php",
            data: datastring,
            success: function (html) {
                $('#modalbody').html(html);
                $('#workflowpopup').modal({
                    show: true

                });
            }
        });

    }
    else{
        $.ajax({
            type: "POST",
            url: "ajax/add_workflow.php",
            data: datastring,
            success: function (data) {

                $('#modalbody').html(data);
                $('#workflowpopup').modal({
                    show: true

                });
            }
        });


    }
}


/*--------- End WorkFlow Configuration----------*/


function new_opening(action){

    var str = action;
    var res = str.split(",");


    if(res[0] == 'add'){
        $.ajax({
            type: "POST",
            url: "ajax/add_newOpening.php",
            data: datastring,
            success: function (data) {

                $('#modalbody').html(data);
                $('#newOpeningpopup').modal({
                    show: true

                });
                $('#close').click(function() {
                    location.reload();
                });
            }
        });


    }
    else if(res[0] == 'edit'){

        var datastring = 'action=' + action;
        $.ajax({
            type: "POST",
            url: "ajax/edit_newOpening.php",
            data: datastring,
            success: function (html) {

                $('#modalbody').html(html);

                $('#newOpeningpopup').modal({
                    show: true

                });
                $('#close').click(function() {
                    location.reload();
                });
            }
        });

    }
    else if(res[0] == 'view'){

        var datastring = 'action=' + action;
        $.ajax({
            type: "POST",
            url: "ajax/view_newOpening.php",
            data: datastring,
            success: function (html) {

                $('#modalbody').html(html);

                $('#newOpeningpopup').modal({
                    show: true

                });
                $('#close').click(function() {
                    location.reload();
                });
            }
        });

    }



}


$("#createOpening").click(function () {


    var Dcode = $("#Dcode").val();
    var Lcode = $("#Lcode").val();
    var Depcode = $("#Depcode").val();
    var Pcode = $("#Pcode").val();
    var NoVac = $("#NoVac").val();
    var sp = $("#sp").val();
    var odate = $("#odate").val();
    var cdate = $("#cdate").val();
    var expTo = $("#expTo").val();
    var expFrom = $("#expFrom").val();
    var salary = $("#salary").val();
    var sex = $("#sex").val();
    var ageTo = $("#ageTo").val();
    var ageFrom = $("#ageFrom").val();
    var vReason = $("#vReason").val();
    var vtype = $("#vtype").val();
    var profile = $("#profile").val();
    var vstatus = $("#vstatus").val();
    var title = $("#title").val();
    var qual = $("#qual").val();
    var skill = $("#skill").val();
    var hiddenID = $("#hiddenid").val();
    var action = $("#createOpening").val();

    var datastring = 'Dcode=' + Dcode + '&Lcode=' + Lcode+ '&Depcode=' + Depcode+ '&Pcode=' + Pcode
        + '&NoVac=' + NoVac+ '&sp=' + sp+ '&odate=' + odate+ '&cdate=' + cdate+ '&expTo=' + expTo+ '&expFrom=' + expFrom
        + '&salary=' + salary+ '&sex=' + sex+ '&ageTo=' + ageTo+ '&ageFrom=' + ageFrom+ '&vReason=' + vReason+ '&vtype=' + vtype
        + '&profile=' + profile+ '&vstatus=' + vstatus+ '&title=' + title+ '&qual=' + qual+ '&skill=' + skill+ '&hiddenID=' + hiddenID+ '&action=' + action;


    if(Dcode=='' || Lcode==''|| Depcode=='' || Pcode=='' || NoVac=='' || sp=='' || odate==''|| cdate==''
        || expTo=='' || expFrom=='' || salary=='' || sex=='' || ageTo=='' || ageFrom==''
        || vReason=='' || vtype=='' || profile=='' || vstatus==''|| title==''|| qual==''|| skill=='')
    {
        alert("enter all field");

    }else {

        $.ajax({
            type: "POST",
            url: "ajax/newOpening_ajax.php",
            data: datastring,
            success: function () {

            }
        });
    }});

function update_policy(){

    window.location.href='edit_passwordpolicy.php';

    $.ajax({
        type: "POST",
        url: "ajax/edit_passwordpolicy.php",
        success: function (html) {
            $('#modalbody').html(html);
            $('#editpolicypopup').modal({
                show: true

            });
        }
    });

}


/* ---------- Edit Password Policy ------ */
$("#editpasspolicy").click(function() {
    /*------------------*/
    var allVals = [];
    function updateTextArea() {

        $('#c_b :checked').each(function() {
            allVals.push($(this).val());
        });
        //alert(allVals);

    }
    $('#c_b input').click(updateTextArea);
    updateTextArea();
    /*------------------*/
    var allVals_def = [];
    function updateTextArea1() {

        $('#c_b1 :checked').each(function() {
            allVals_def.push($(this).val());
        });
       // alert(allVals_def);

    }
    $('#c_b1 input').click(updateTextArea1);
    updateTextArea1();

    var passLength = $("#slider-range-max-amount").html();

    /*------------------*/

    var radioAlpha = $("input[name='alpha']:checked").val();
    var radioUpperCase = $("input[name='uppercase']:checked").val();
    var radioLowerCase = $("input[name='lowercase']:checked").val();
    var radioNumber = $("input[name='numb']:checked").val();
    var radioSpecial = $("input[name='spec']:checked").val();

    //alert(radioAlpha);
    // alert(radioNumber);
    //alert(radioSpecial);
    //alert(radioUpperCase);
    /*------------------*/


    var change_password_days,change_password_days_status,earlier_password_use,earlier_password_use_status,userid_case_sensitive,
        userid_sensitive_status,invalidAttempts,invalidTime,locked_userid_status,autounlock,userid_unlock_status,password_reset_link,
        password_reset_link_status,password_reset_ques1,password_reset_ques1_status,ask_for_otp,ask_for_otp_status,default_password_status,default_password,
        default_password_expiry_status,default_password_expiry;

    var alphabet = $("#alphabet").val();
    var uppercase_letter = $("#uppercaseletter").val();
    var lowercase_letter = $("#lowercaseletter").val();
    var no_number = $("#number").val();
    var special = $("#special").val();
    change_password_days_status = $("#change_password_days_status").val();
    if(change_password_days_status == 0)
    {
        change_password_days = 0;
    }
    else
    {
        change_password_days = $("#slider-range-max-amount5").html();
    }

    earlier_password_use_status = $("#earlier_password_use_status").val();
    if(earlier_password_use_status == 0)
    {
        earlier_password_use = 0;
    }
    else
    {
        earlier_password_use = $("#slider-range-max-amount6").html();
    }

    userid_sensitive_status = $("#userid_sensitive_status").val();
    if(userid_sensitive_status == 0)
    {
        userid_case_sensitive = 0;
    }
    else
    {
        userid_case_sensitive = $("#userid_case_sensitive").val();
    }

    locked_userid_status = $("#locked_userid_status").val();
    if(locked_userid_status == 0)
    {
        invalidAttempts = 0;
        invalidTime = 0;
    }
    else
    {
        invalidAttempts = $("#invalidAttempts").val();
        invalidTime = $("#invalidTime").val();
    }

    userid_unlock_status = $("#userid_unlock_status").val();
    if(userid_unlock_status == 0) {
        autounlock = 0;
    }
    else
    {
        autounlock = $("#autounlock").val();
    }

    password_reset_link_status = $("#password_reset_link_status").val();
    if(password_reset_link_status == 0) {
        password_reset_link = 0;
    }
    if(password_reset_link_status != 0)
    {
        password_reset_link = $("#password_reset_link").val();
    }

    password_reset_ques1_status = $("#password_reset_question_status").val();
    if(password_reset_ques1_status == 0) {
        password_reset_ques1 = '';
    }
    else
    {
        password_reset_ques1 = allVals;
    }
    if(allVals.length > 0){
      password_reset_ques1_status = 1;
    }
    else{
      password_reset_ques1_status = 0;
    }

    default_password_status = $("#default_password_status").val();
    if(default_password_status == 0) {
        default_password = '';
    }
    else
    {
        default_password = allVals_def;
    }
    if(allVals_def.length > 0){
      default_password_status = 1;
    }
    else{
      default_password_status = 0;
    }


    ask_for_otp_status = $("#ask_for_otp_status").val();

    if(ask_for_otp_status == 0 ) {
        ask_for_otp = 0;
    }
    else
    {
        ask_for_otp = $("#ask_for_otp").val();
    }

    default_password_expiry_status = $("#default_password_expiry_status").val();

    if(default_password_expiry_status == 0 ) {
        default_password_expiry = 0;
    }
    else
    {
        default_password_expiry = $("#default_password").val();
    }


    var alphabet_radio= radioAlpha;
    var uppercase_radio= radioUpperCase;
    var lowercase_radio= radioLowerCase;
    var number_radio = radioNumber;
    var special_characters = radioSpecial;

    if(alphabet_radio == "0"){
        uppercase_radio ="0";
        lowercase_radio = "0";
    }

    var dataString = 'passLength='+ passLength +
        '&alpha_radio=' + alphabet_radio +
        '&uppercase_radio=' + uppercase_radio +
        '&lowercase_radio=' + lowercase_radio +
        '&number_radio=' + number_radio +
        '&special_characters=' + special_characters +
        '&alphabet=' + alphabet +
        '&upper_letter=' + uppercase_letter +
        '&lower_letter=' + lowercase_letter +
        '&no_number=' + no_number +
        '&special=' + special +
        '&change_password_days=' + change_password_days +
        '&earlier_password_use=' + earlier_password_use +
        '&userid_case_sensitive=' + userid_case_sensitive +
        '&change_password_days_status=' + change_password_days_status +
        '&earlier_password_use_status=' + earlier_password_use_status +
        '&userid_sensitive_status=' + userid_sensitive_status +
        '&invalidAttempts=' + invalidAttempts +
        '&invalidTime=' + invalidTime +
        '&locked_userid_status=' + locked_userid_status +
        '&autounlock=' + autounlock +
        '&userid_unlock_status=' + userid_unlock_status +
        '&password_reset_link=' + password_reset_link +
        '&password_reset_link_status=' + password_reset_link_status +
        '&password_reset_ques1=' + password_reset_ques1 +
        '&password_reset_ques1_status=' + password_reset_ques1_status +
        '&call_val=' + "2" +
        '&ask_for_otp=' + ask_for_otp +
        '&ask_for_otp_status=' + ask_for_otp_status +
        '&default_password=' + default_password +
        '&default_password_status=' + default_password_status +
        '&default_password_expiry=' + default_password_expiry +
        '&default_password_expiry_status=' + default_password_expiry_status ;

    if(passLength=='' || alphabet=='' || special=='' || no_number=='')
    {

        $('.success').fadeOut(500).hide();
        $('.error').fadeOut(500).show();
    }
    else if(parseInt(passLength)<=parseInt(alphabet)+parseInt(special)+parseInt(no_number)){
        alert(passLength);

        alert(alphabet);
        alert(special);
        alert(no_number);
    }
    else {
        //alert(dataString);
        $.ajax({
            type: "POST",
            url: "ajax/updatePolicy.php",
            data: dataString,
            success: function (result) {
                   
                    if(result == 1) {
                        toastmsg("Policy updated Successfully");
                        setTimeout(function() { window.location=window.location;},3000);
                        
                    }else if(result == 2) {
                        toasterrormsg("Policy Already Created. You are only eligible to change the policy");
                    }
                    else {
                        toasterrormsg("Failed in Updation");
                    }
                }
        });
    }

});