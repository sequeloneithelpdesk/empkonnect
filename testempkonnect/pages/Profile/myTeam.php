<?php
include ('../db_conn.php');
include ('../configdata.php');

session_start();
if((!isset($_SESSION['usercode']) || $_SESSION['usercode']=="")&& (!isset($_SESSION['usertype']) || $_SESSION['usertype']=="")){
	header('location: ../login/index.php');
}
$team=array();
$c_val = 'end1234';
?>

<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8"/>
    <title>HRMS</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
    <link href="../../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
    <!-- END PAGE LEVEL PLUGIN STYLES -->
    <!-- BEGIN PAGE STYLES -->
    <link href="../../assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css" media="screen"/>
    <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/select2/select2.css"/>
    <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
    <link href="../../assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/jstree/dist/themes/default/style.css"/>
    <!-- END PAGE STYLES -->
    <!-- BEGIN THEME STYLES -->
    <!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->
    <link href="../../assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
    <link href="../../assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/admin/layout2/css/layout.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/admin/layout2/css/themes/grey.css" rel="stylesheet" type="text/css" id="style_color"/>
    <link href="../../assets/admin/layout2/css/custom.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/admin/layout2/css/kunal.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME STYLES -->

    <link href="../css/toastr.css"  rel="stylesheet" type="text/css"/>
    
    <link rel="stylesheet" href="../css/jquery-ui.css">

    <link rel="shortcut icon" href="favicon.ico"/>
	<style>
	.imagesize{
		width:15%;
		height:15%;
	
	}
	</style>

</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white custom-layout">
<!-- BEGIN HEADER -->
<?php  include('../include/header.php'); ?>

<div class="clearfix">
</div>
<div class="page-content-wrapper cus-dark-grey">
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
        <!-- BEGIN SIDEBAR -->
        <div class="page-sidebar-wrapper modified">

            <div class="page-sidebar navbar-collapse collapse cus-dark-grey">

                <?php include('../include/leftMenu.php') ;?>

            </div>
        </div>
        <!-- END SIDEBAR -->
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <div class="page-content cus-light-grey">

                <!-- BEGIN PAGE HEADER-->
                <h3 class="page-title">
                    My Team
                </h3>
                <div class="page-bar z-depth-1">
                    <ul class="page-breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a href="index.html">Home</a>
                            <i class="fa fa-angle-right"></i>
                        </li>

                        <li>
                            <a href="#">My Team</a>
                        </li>
                    </ul>

                </div>
                <!-- END PAGE HEADER-->
                <!-- BEGIN PAGE CONTENT-->


<?php
$username=$_SESSION['usercode'];
//$username=100010;

$sql="select MNGR_CODE,MNGR_CODE2 from HrdMastQry where Emp_Code='$username' ";
$result=query($query, $sql, $pa, $opt, $ms_db);
while($row1=$fetch($result)){
   $team['G_manager']['info'][0]['id']=$row1['MNGR_CODE'];
   $team['F_manager']['info'][1]['id'] =$row1['MNGR_CODE2'];
}
//print_r($team);
   $sql1 = "SELECT * FROM HrdMastQry where Emp_Code='".$team['G_manager']['info'][0]['id']."'";
   $result1 = query($query, $sql1, $pa, $opt, $ms_db);
       while ($row = $fetch($result1)) {
           $team['G_manager']['info'][0]['name'] = $row['Emp_Title'] . " " . $row['Emp_FName'] . " " . $row['Emp_MName'] . " " . $row['Emp_LName'];
           //$team['G_manager']['info'][0]['image'] = $row['EmpImage'];
           if($row['EmpImage']==''){
            $myteamimage="../../assets/admin/layout2/img/avatar.png";
           }
           else{
            $myteamimage="upload_images/".$row['EmpImage'];
           }
           $team['G_manager']['info'][0]['image'] =$myteamimage ;
           $team['G_manager']['info'][0]['dsg'] = $row['DSG_NAME'];
           //$team['G_manager']['info'][0]['link'] = "/show_profile.php";
           //$team['manager']['info']['email'][] = $row['OEMailD'];

}
$sql2  = "SELECT * FROM HrdMastQry where Emp_Code='".$team['F_manager']['info'][1]['id']."'";
$result2 = query($query, $sql2, $pa, $opt, $ms_db);
   while ($rowf = $fetch($result2)) {
       $team['F_manager']['info'][1]['name'] = $rowf['Emp_Title'] . " " . $rowf['Emp_FName'] . " " . $rowf['Emp_MName'] . " " . $rowf['Emp_LName'];
       //$team['F_manager']['info'][1]['image'] = $rowf['EmpImage'];
       if($rowf['EmpImage']==''){
            $myteamimagef="../../assets/admin/layout2/img/avatar.png";
           }
           else{
            $myteamimagef="upload_images/".$rowf['EmpImage'];
           }
       $team['F_manager']['info'][1]['image'] =$myteamimagef;
       $team['F_manager']['info'][1]['dsg'] = $rowf['DSG_NAME'];
       //$team['manager']['info']['email'][] = $row['OEMailD'];

}

$myinfo=array();

$sql3="SELECT * FROM HrdMastQry where MNGR_CODE='".$team['G_manager']['info'][0]['id']."' ";
$result3=query($query, $sql3, $pa, $opt, $ms_db);
$q=0;
while($row3=$fetch($result3)){
    if($row3['Emp_Code']==$username){
        $myinfo[0]['id']=$row3['Emp_Code'];
        $myinfo[0]['name']=$row3['Emp_Title'] . " " . $row3['Emp_FName'] . " " . $row3['Emp_MName'] . " " . $row3['Emp_LName'];
        if($row3['EmpImage']==''){
            $myteamimage3="../../assets/admin/layout2/img/avatar.png";
           }
           else{
            $myteamimage3="upload_images/".$row3['EmpImage'];
           }
        $myinfo[0]['image']= $myteamimage3;
        $myinfo[0]['dsg'] = $row3['DSG_NAME'];
    }
    else{
   $team['G_manager']['children'][$q]['id']=$row3['Emp_Code'];
   $team['G_manager']['children'][$q]['name'] = $row3['Emp_Title'] . " " . $row3['Emp_FName'] . " " . $row3['Emp_MName'] . " " . $row3['Emp_LName'];
   //$team['G_manager']['children'][$q]['image'] = $row3['EmpImage'];
   if($row3['EmpImage']==''){
            $myteamimage3="../../assets/admin/layout2/img/avatar.png";
           }
           else{
            $myteamimage3="upload_images/".$row3['EmpImage'];
           }
   $team['G_manager']['children'][$q]['image'] = $myteamimage3;
   $team['G_manager']['children'][$q]['dsg'] = $row3['DSG_NAME'];
   //$team['G_manager']['children'][$q]['email'] = $row3['OEMailD'];
   $q++;
}
}

$sql4="SELECT * FROM HrdMastQry where MNGR_CODE='$username' ";
$result4=query($query, $sql4, $pa, $opt, $ms_db);

       $p=0;
       while($row2=$fetch($result4)){
           $myinfo[0]['children'][$p]['id'] = $row2['Emp_Code'];
           $myinfo[0]['children'][$p]['name'] = $row2['Emp_Title'] . " " . $row2['Emp_FName'] . " " . $row2['Emp_MName'] . " " . $row2['Emp_LName'];
           //$team['G_manager']['children'][$w]['children'][$p]['image'] = $row2['EmpImage'];
           if($row2['EmpImage']==''){
            $myteamimage2="../../assets/admin/layout2/img/avatar.png";
           }
           else{
            $myteamimage2="upload_images/".$row2['EmpImage'];
           }
           $myinfo[0]['children'][$p]['image'] = $myteamimage2;

           $myinfo[0]['children'][$p]['dsg'] = $row2['DSG_NAME'];
           //$team['myteam1'][]['email'][] = $row2['OEMailD'];
           $p++;
       }

//print_r(json_encode($myinfo));
//$team = file_get_contents('js/tsconfig.json');
//$team = json_decode($team,true);

?>
<div class='row'>
                                    <div class='level l1  col-md-offset-4 col-md-4 col-sm-12 clearfix' style=''>
                                        <div class='col-sm-2 emp-img'>
                                            <img class="img-circle" src="<?php echo $team['G_manager']['info'][0]['image']; ?>">
                                        </div>
                                        <div class='col-sm-10'>
                                            <h4><b><?php 
                                            if($team['G_manager']['info'][0]['id']==$username){ 
                                                $link1="<a href='showEmployee.php?oempCode=".$team['G_manager']['info'][0]['id']."'>".$team['G_manager']['info'][0]['name']."</a>";
                                                echo $link1;


                                        } 
                                        else{
                                            echo $team['G_manager']['info'][0]['name'] ;
                                          }
                                             ?></b></h4>
                                            <ul class="ds-ilb p-0">
                                                <li><h4>Manager</h4></li>
                                                <li><i style="margin: 0 0 0 20px;"><?php echo $team['G_manager']['info'][0]['id']; ?></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='l2 col-md-offset-1 col-md-4 col-sm-12 p-0'>
                                        <div class='level clearfix'>
                                            <div class='col-sm-2 emp-img'>
                                                <img class='img-circle' src='<?php echo $team['F_manager']['info'][1]['image']; ?>'>
                                            </div>
                                            <div class='col-sm-10 emp-info'>
                                                <h4><b>
                                                <?php 
                                            if($team['G_manager']['info'][0]['id']==$username || $team['F_manager']['info'][1]['id']==$username){ 
                                                $link1="<a href='showEmployee.php?oempCode=".$team['F_manager']['info'][1]['id']."'>".$team['F_manager']['info'][1]['name']."</a>";
                                                echo$link1;
                                        } 
                                        else{
                                            echo $team['F_manager']['info'][1]['name'] ;
                                          }
                                             ?>
                                             </b></h4>
                                                <ul class='ds-ilb p-0'>
                                                    <li><h4>Functional Manager</h4></li>
                                                    <li><i style='margin: 0 0 0 20px;'><?php echo$team['F_manager']['info'][1]['id']; ?></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <span class='connector'>
                                        
                                    </span>
                                </div>
                                
                                <div class="team-lead-wrapper">
                                    <div class="teamCon">
                                        <div class='l3 p-0 col-md-4 fix-block'>
                                                <div class='level clearfix'>
                                                    <div class='emp-img'>
                                                        <img class="img-circle imagesize" src='<?php echo$myinfo[0]['image']; ?>'>
                                                    </div>
                                                    <div class='col-sm-12 emp-info'>
                                                        <h4><b> 
                                                        <?php 
                                            if($team['G_manager']['info'][0]['id']==$username || $team['F_manager']['info'][1]['id']==$username || $myinfo[0]['id']==$username){ 
                                                $link1="<a href='showEmployee.php?oempCode=".$myinfo[0]['id']."' style='color:#fff;'>".$myinfo[0]['name']."</a>";
                                                echo$link1;
                                        } 
                                          else{
                                            echo $myinfo[0]['name'];
                                          }
                                             ?>
                                                        </b></h4>
                                                        <ul class="ds-ilb p-0">
                                                            <li><h4><?php echo$myinfo[0]['dsg']; ?></h4></li>
                                                            <li><i style="margin: 0 0 0 20px;"><?php echo$myinfo[0]['id']; ?></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        <ul class='teamLead right1 left1'>
                                            <?php
                                            // $myindex ;
                                            for($m=0;$m<count($team['G_manager']['children']);$m++)
                                            {
                                            // if($team['G_manager']['children'][$m]['id']== $username){
                                            // $myindex=$m;
                                            // }   ?>
                                            
                                            <li class='l3 p-0 col-md-4'>
                                                <div class='level clearfix'>
                                                    <div class='emp-img'>
                                                        <img class="img-circle imagesize" src='<?php echo $team['G_manager']['children'][$m]['image']; ?>'>
                                                    </div>
                                                    <div class='col-sm-12 emp-info'>
                                                        <h4><b>
                                                            <?php 
                                            if($team['G_manager']['info'][0]['id']==$username || $team['F_manager']['info'][1]['id']==$username ){ 
                                                $link1="<a href='showEmployee.php?oempCode=".$team['G_manager']['children'][$m]['id']."'>".$team['G_manager']['children'][$m]['name']."</a>";
                                                echo$link1;
                                        } 
                                          else{
                                            echo $team['G_manager']['children'][$m]['name'];
                                          }
                                             ?>
                                                        </b></h4>
                                                        <ul class="ds-ilb p-0">
                                                            <li><h4><?php echo $team['G_manager']['children'][$m]['dsg']; ?></h4></li>
                                                            <li><i style="margin: 0 0 0 20px;"><?php echo $team['G_manager']['children'][$m]['id']; ?></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            
                                            
                                            <?php
                                            }
                                            ?>
                                            
                                        </ul>
                                    </div>
                                    <div>
                                        <button class="slideLeft"  value="left1"><img src="../../assets/admin/layout2/img/arrowLeft.png" alt=""></button>
                                        <button class="slideRight" value="right1"><img src="../../assets/admin/layout2/img/arrowRight.png" alt=""></button>
                                    </div>
                                </div>
                                <div class='connector' style="height:70px;"></div>
                                <div class="team-lead-wrapper">
                                    <div class="teamCon">
                                        
                                        <ul class='teamLead right2 left2'>
                                            <?php //echo $myindex;
                                            if(array_key_exists('children',$myinfo[0])) {
                                            
                                            for ($mi = 0; $mi < count($myinfo[0]['children']); $mi++) { ?>
                                            <li class='l3 p-0 col-md-4'>
                                                <div class='level clearfix'>
                                                    <div class='emp-img'>
                                                        <img class="img-circle " src='<?php echo $myinfo[0]['children'][$mi]['image']; ?>'>
                                                    </div>
                                                    <div class='col-sm-12 emp-info'>
                                                        <h4><b>
                                                        <?php 
                                            if($team['G_manager']['info'][0]['id']==$username || $team['F_manager']['info'][1]['id']==$username || $myinfo[0]['id']==$username){ 
                                                $link1="<a href='showEmployee.php?oempCode=".$myinfo[0]['children'][$mi]['id']."'>".$myinfo[0]['children'][$mi]['name']."</a>";
                                                echo$link1;
                                        } 
                                          else{
                                            echo $myinfo[0]['children'][$mi]['name'];;
                                          }
                                             ?>
                                            </b></h4>
                                                        <ul class="ds-ilb p-0">
                                                            <li><h4><i class="fa fa-caret-right" aria-hidden="true"></i><?php echo $myinfo[0]['children'][$mi]['dsg']; ?></h4></li>
                                                            <li><i style="margin: 0 0 0 20px;"><?php echo $myinfo[0]['children'][$mi]['id']; ?></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                           <?php
                                            
                                            }
                                            
                                            }
                                            else{
                                            echo" no employee";
                                            }
                                            ?>
                                            </ul>
                                            <input type="hidden" value="0" id="hidid">
                                            <input type="hidden" value="0" id="hidid2">
                                            <input type="hidden" value="0" id="hidid3">
                                        </div>
                                         <div>
                                        <button class="slideLeft"  value="left2"><img src="../../assets/admin/layout2/img/arrowLeft.png" alt=""></button>
                                        <button class="slideRight"  value="right2"><img src="../../assets/admin/layout2/img/arrowRight.png" alt=""></button>
                                    </div>
                                    </div>
            </div>
            <!-- END CONTAINER -->
            <!-- BEGIN FOOTER -->
            <?php include('../include/footer.php') ?>
            <!-- END FOOTER -->
        </div>
        <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
        <!-- BEGIN CORE PLUGINS -->
        <!--[if lt IE 9]>
        <script src="../../../../assets/global/plugins/respond.min.js"></script>
        <script src="../../../../assets/global/plugins/excanvas.min.js"></script>
        <![endif]-->
        <script src="../../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
        <!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
        <script src="../../assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->

        <script src="../../assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
        <script type="text/javascript" src="../../assets/global/plugins/select2/select2.min.js"></script>
        <script type="text/javascript" src="../../assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>

        <script type="text/javascript" src="../../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="../../assets/global/plugins/jstree/dist/jstree.min.js"></script>

        <!-- END PAGE LEVEL SCRIPTS -->
        <script src="../../assets/admin/pages/scripts/ui-tree.js"></script>
        <script src="../../assets/global/scripts/metronic.js" type="text/javascript"></script>
        <script src="../../assets/admin/layout2/scripts/layout.js" type="text/javascript"></script>
        <script src="../../assets/admin/layout2/scripts/demo.js" type="text/javascript"></script>
        <script src="../../assets/admin/pages/scripts/table-advanced.js"></script>
        <script src="../js/toastr.js"></script>
        <script src="../js/common.js"></script>
        
        <script>
            jQuery(document).ready(function() {
                Metronic.init(); // init metronic core components
                Layout.init(); // init current layout
                Demo.init(); // init demo features

                

                TableAdvanced.init();
            });

            $('.slideRight').click(function(){
                                        var id = $(this).attr('value');

                                        if (id==='left2'||id==='right2') {
                                            var inc=$("#hidid").val();
                                            // var iCol=$("#hidid3").val();
                                            // iCol++;
                                            // $('#hidid3').val(iCol);
                                            // alert(iCol);
                                            // $('.l3:nth-child(' + iCol + ')').addClass('kunal'); 
                                            if (inc <= 0) {
                                            inc=parseInt(inc)-335;
                                            $("#hidid").val(inc);
                                            $('.'+id).css({"transform": "translate3d(" + inc + "px, 0px, 0px)"});
                                            }
                                            
                                        }
                                        else{
                                            var inc2=$("#hidid2").val();
                                            if (inc2 <= 0) {
                                            inc2=parseInt(inc2)-335;
                                            $("#hidid2").val(inc2);
                                            $('.'+id).css({"transform": "translate3d(" + inc2 + "px, 0px, 0px)"});
                                            }
                                        }
                                        
                                        
                                     
                                    });

                                    
                                    $('.slideLeft').click(function(){
                                        var id = $(this).attr('value');
                                        if (id=='left2'||id=='right2') {
                                            var inc=$("#hidid").val(); 
                                            if (inc < 0) {
                                            inc=parseInt(inc)+335;
                                            $("#hidid").val(inc);
                                           
                                            $('.'+id).css({"transform": "translate3d(" + inc + "px, 0px, 0px)"});
                                            }   
                                        }
                                        else{
                                            var inc2=$("#hidid2").val();
                                            if (inc2 < 0) {
                                            inc2=parseInt(inc2)+335;
                                            $("#hidid2").val(inc2);
                                           
                                            $('.'+id).css({"transform": "translate3d(" + inc2 + "px, 0px, 0px)"});
                                            }
                                        }
                                        
                                        
                                     
                                    });
        </script>

</body>
<!-- END BODY -->
</html>
