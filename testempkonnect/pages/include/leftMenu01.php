<?php 


  $json = file_get_contents('menu.json'); 
  $data = json_decode($json,true);
$serverName="localhost";
$userName="root";
$password="";
$dbname="hrms";
$conn = new mysqli($serverName, $userName, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    
}
//$data1=mysql_real_escape_string(print_r(json_decode($json,true)));
print_r($data);
$sql="update hrms_menu set menu='$json' where type='Admin' ";
$result= $conn->query($sql);

if($result){
  echo "successfully updated ." ;
}
else{
  echo $conn->error;
}
  //print_r($data);
  //print_r($data);
 
  ?>
  <ul class="page-sidebar-menu  page-header-fixed cus-dark-grey" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">

<?php
for ($i=0; $i <count($data) ; $i++) {
  # code...
  ?>
    <li class="nav-item">
    <a class="nav-link nav-toggle" href='<?php echo $data[$i]['href']?>'>
              <i class="<?php echo $data[$i]['icon']?>"></i>
              <span class="title"><?php echo $data[$i]['text']?></span>
           
  <?php
    if(count($data[$i]['children'])>=1){ ?>
    <span class="arrow"></span> </a>
    <ul class="sub-menu"> <?php
  for ($a=0; $a <count($data[$i]['children']) ; $a++) { 
    # code...
    ?>
    <li class="nav-item ">  <a class="nav-link nav-toggle" href="<?php echo $data[$i]['children'][$a]['href'] ?>"><?php echo $data[$i]['children'][$a]['text']?>
    <?php
  if(count($data[$i]['children'][$a]['children'])>=1){ ?>
    <span class="arrow "></span> </a><ul class="sub-menu">
  <?php
  for ($c=0; $c <count($data[$i]['children'][$a]['children']) ; $c++) { 
    # code...
    ?> <li class="nav-item">  <a href="<?php echo $data[$i]['children'][$a]['children'][$c]['href'] ?>"><?php echo $data[$i]['children'][$a]['children'][$c]['text']?></a>
    </li><?php
  } ?> </ul><?php
  }
  else { 

    echo"</a>";
   }
  ?> </li> <?php
  } ?>
  </ul>
<?php
  }
  else { 

    echo"</a>";
   }
  ?></li><?php
}

?>
</ul>