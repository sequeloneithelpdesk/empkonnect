<?php
session_start();
include("../db_conn.php");
include("../configdata.php");
if((!isset($_SESSION['usercode']) || $_SESSION['usercode']=="")&& (!isset($_SESSION['usertype']) || $_SESSION['usertype']=="")){
	header('location: ../login/index.php');
}

?>

<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
function countryfunc(tablename,tablepre,tablepar,divid,res){
	
	$.ajax({
    type:"POST",
    url:"ajax/ajaxcountry.php",
    data:{table:tablename, pre:tablepre,par:tablepar, res:res,type:"contry"},
    cache: false,
    success: function(result){
      
	  $('#'+divid).html(result);
    }
  });
	
}
</script>

</head>
<body>
<div>
Country <br>
<div>
<select id="counid" onchange="countryfunc('StateMast','State','country','stateid',this.value)">
<option value=""> Select Country</option>
<?php
$sql="select * from countrymast ";
$result=query($query,$sql,$pa,$opt,$ms_db);
while($coun=$fetch($result)){
	?>
	<option value='<?php  echo$coun['CountryID']; ?>'> <?php echo$coun['Country_NAME'] ?> </option>
<?php	
}

?>
</select>

</div>
</div>

<div>
State <br>
<div id="stateid">
<select >
<option value="">Select State</option>
</select>

</div>
</div>

<div>
City <br>
<div id="cityid">
<select >
<option value="">Select City</option>
</select>

</div>
</div>


</body>

</html>