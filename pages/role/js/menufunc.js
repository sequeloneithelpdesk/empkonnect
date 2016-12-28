

var Role = {

checkrolename : function(){

var role_name = $('#role_name').val();
            if(role_name.length > 2) {
                $('#rolename_availability_result').html('Loading..');
                var post_string = 'user_name='+role_name;
                $.ajax({
                    type : 'POST',
                    data : post_string,
                    url  : 'ajax/namecheck_ajax.php',
                    success: function(responseText){
                    if(responseText == 0){
                        $('#rolename_availability_result').html('<span class="success">Rolename name available.</span>');
                    }else if(responseText > 0){
                        $('#rolename_availability_result').html('<span class="error">Rolename already taken.</span>');
                    }else{
                        alert('Problem with mysql query');
                    }
                }
            });
        }else{
            $('#rolename_availability_result').html('');
        }

},

ajax_menu:function(){
	$.ajax({
		type:"POST",
		url:"ajax/role_menuajax.php",
		dataType : 'json',
 	    cache: false,
        beforeSend: function(){
                      loading();
                   },
        success: function(result){
                  unloading();
                  console.log(result.menuitem);
                  //alert(result['menuitem']);
                  Role.menu(result);
           
                   }
	});
},
  menu: function(datamenu){
       
   //   <div id="tree_9"></div>
//<input type = "button" value="getdata" onclick ="getdata()">
//<div id="tree_10"></div>

		$('#menu').jstree({
            'plugins': [ "wholerow","checkbox", "state","types"],
            'core': {
                "themes" : {
                    "responsive": false,
					
                },    
                'data': datamenu.menuitem
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
		getdata : function (){
			$("#showmenu").jstree("destroy");
		    //Role.menu();
			var mytext = $('#menu').jstree(true).get_json('#', {flat:false})
			
	 
			newjson = Role.createjson(mytext);
			
			
			$('#showmenu').jstree({
            'plugins': [ "state","types"],
            'core': {
                "themes" : {
                    "responsive": false,
					
                },    
                'data': newjson,
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
	 
	}
	

}

