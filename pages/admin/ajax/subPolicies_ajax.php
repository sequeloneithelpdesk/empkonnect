<?php 

include '../../db_conn.php';
include ('../../configdata.php');
if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) 
{
  
  $id=$_REQUEST['id'];
  //echo $id;
  //$cuisines1 = rtrim(implode(',', $cuisines), ',');
  
}else
{  
    $id=0;
}
$sql="Select * from LOVMast Where LOV_Field='$id'";
//echo $sql;
$result = query($query,$sql,$pa,$opt,$ms_db);
$noofrow=$num($result);
//echo $noofrow;
if($noofrow > 0)
{
while($row = $fetch($result)) {
 ?>
 <option value="<?php echo $row['LOV_Text'];?>">
  <?php echo $row['LOV_Text'];?>
</option>
 <?php 
 }}
 else
 {
?>
<option value="">Sub Policies Not Found </option>
 <?php 

  } ?>