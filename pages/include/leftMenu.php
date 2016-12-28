<?php 
include ('../db_conn.php');
//include ('../configdata.php');
//session_start();


//print_r($data['menuitem']);

//$json = file_get_contents('menu.json'); 
//$data = json_decode($json,true);

//$data1=mysql_real_escape_string(print_r(json_decode($json,true)));
// $sql="insert into hrms_menu (menu) value('$json')";
// $result= $conn->query($sql);

//print_r($data);



//echo $data['menuitem'][0]['state']['selected'];
?>
<ul id="ulid" class="page-sidebar-menu  page-header-fixed cus-dark-grey" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">

<?php
$data['menuitem'] =  $_SESSION['Allrole'][$_SESSION['selectedRole']]['role'];
//$c_menu1 ="Tools";
//$c_menu2="Security";
//$c_menu3="Manage User Role";

    if ($c_val != 'end1234' && !validate($data['menuitem'], $c_val)) {
        echo "<script type='text/javascript'> document.location = '../login/home.php'; </script>";
    
        exit("Illegal access detected");

    }

function validate($data,$c_val){
     //return false ;
    foreach ($c_val as $key => $c_vA){
    }
    for ($i=0; $i <count($data) ; $i++) {
         $da = $data[$i];

        if($da['text'] ==  $key ){
            if($c_vA != 'end1234' ){
                 $value = validate($da['children'],$c_vA);
                if($value){
                    return true ;
                }
            }else{
                return true ;
            }

        }
    }
    return false ;
}

$p=array(
    array("key"=>"Home","page"=>array('home.php'),"sec"=>array()),
    array("key"=>"Profile","page"=>array('myProfile.php','myTeam.php','addEmp.php','download_employee.php','view_employee.php','showEmployee.php','editEmployee.php','up_emp.php'),"sec"=>array()),
    array("key"=>"Time Management","page"=>array('outOnWorkRequest.php','markPastAttendance.php','approveOutOnWork.php',
        'approveMarkPastAtten.php','my_calendar.php','manage_Roster.php','shiftMaster.php','shiftPattern.php','view_roster.php','viewMyOutWork.php','myPastAttenRequest.php'),"sec"=>array()),
    array("key"=>"Leave Management","page"=>array('approveCompOff.php','approveLeaveRequest.php',
        'compOffRequest.php','leave_balance.php','leaveRequest.php','myCompOffRequest.php','myLeaveRequest.php','Myteam_leavebalance.php','myTeamCompOffRequest.php','myTeamLeaveRequest.php','viewMyOutOnWork.php'),"sec"=>array()),
    array("key"=>"Tools","page"=>array(),
        "sec"=>array(
            array("key"=>'Security',"page"=>array('role.php','manage_user.php')))
        ),
    array("key"=>"Policies & Forms","page"=>array('policiesandform.php'),"sec"=>array()),
    array("key"=>"Admin","page"=>array(),
        "sec"=>array(
            array("key"=>'Organization Structure',"page"=>array('view_bank_details.php','view_bussiness_unit.php','view_work_location.php','view_university.php','view_sub_function.php','view_sub_bussinessunit.php','view_state.php','view_roles.php','view_reason.php','view_qualification.php','view_process.php','view_optionMast.php','view_option_center.php','view_location.php','view_level.php','view_holiday.php','view_grade.php','view_function.php','view_emp_type.php','view_division.php','view_designation.php','view_country.php','view_cost_center.php','view_cost_allocation.php','view_companies.php','view_city.php')),
            array("key"=>'Payroll Setup',"page"=>array('year.php')),
            array("key"=>'Announcement and Notification',"page"=>array('companyAnnouncement.php','departmentalNotification.php','reportingNotification.php')),
            array("key"=>'Message and Alert',"page"=>array()),
            array("key"=>'Leave and Attendance',"page"=>array('workflow.php')),
            array("key"=>'Personalize Your Page',"page"=>array())

            )
        )
    );

$mypage= basename($_SERVER['PHP_SELF']);
$mypageIndex='';
$mysubpageIndex='';
for($i=0;$i<count($p);$i++){
//$key=array_search('myProfile.php', $p[$i]);
if(in_array($mypage, $p[$i]['page']))
    { $mypageIndex = $i; }
else{
    for($j=0;$j<count($p[$i]['sec']);$j++){
//$key=array_search('myProfile.php', $p[$i]);
if(in_array($mypage, $p[$i]['sec'][$j]['page']) )
    { $mypageIndex = $i;
        $mysubpageIndex=$j ;
     }

}
}
}

//echo $mypageIndex;
//echo $p[$mypageIndex]['key'];
 
for ($i=0; $i <count($data['menuitem']) ; $i++) {
    # code...
    if ( $data['menuitem'][$i]['state']['selected'] ) { ?>

        <li class="nav-item <?php if($data['menuitem'][$i]['text']==$p[$mypageIndex]['key']){ echo 'open';} ?>">

    <a class="nav-link nav-toggle" href='<?php echo $data['menuitem'][$i]['a_attr']['href'] ?>'>
        <i class="<?php echo $data['menuitem'][$i]['icon'] ?>"></i>
        <span class="title"><?php echo $data['menuitem'][$i]['text'] ?></span>

        <?php

    if (count($data['menuitem'][$i]['children']) >= 1){ ?>
        <span class="arrow <?php if($data['menuitem'][$i]['text']==$p[$mypageIndex]['key']){ echo 'open';} ?>"></span> </a>
        <ul class="sub-menu" 
        <?php if($data['menuitem'][$i]['text']==$p[$mypageIndex]['key'] ){ 
            echo "style='display:block'";
        } else{ 
            echo "style='display:none'"; 
        } ?> > <?php
            for ($a = 0; $a < count($data['menuitem'][$i]['children']); $a++) {
                
            if( $data['menuitem'][$i]['children'][$a]['state']['selected']){
                ?>
                <li class="nav-item <?php 
                if((in_array($mypage,$p[$mypageIndex]['page']) && strstr($data['menuitem'][$i]['children'][$a]['a_attr']['href'],$mypage))  )
                    { echo 'active';} 
                elseif ($data['menuitem'][$i]['children'][$a]['text']==$p[$mypageIndex]['sec'][$mysubpageIndex]['key']){
                     
                        echo 'open'; 
                   
                } ?>"><a class="nav-link nav-toggle"
                                         href="<?php echo $data['menuitem'][$i]['children'][$a]['a_attr']['href'] ?>"><?php echo $data['menuitem'][$i]['children'][$a]['text'] ?>
                        <?php
                        if (count($data['menuitem'][$i]['children'][$a]['children']) >= 1){ ?>
                        <span class="arrow <?php if($data['menuitem'][$i]['children'][$a]['text']==$p[$mypageIndex]['sec'][$mysubpageIndex]['key']){ echo 'open';} ?>"></span> </a>
                    <ul class="sub-menu"
                     <?php if($data['menuitem'][$i]['children'][$a]['text']==$p[$mypageIndex]['sec'][$mysubpageIndex]['key'] ){ 
            echo "style='display:block'";
        } else{ 
            echo "style='display:none'"; 
        } ?>

                    >
                        <?php
                        for ($c = 0; $c < count($data['menuitem'][$i]['children'][$a]['children']); $c++) {
                            # code...
                            ?>
                            <li class="nav-item <?php if((in_array($mypage,$p[$mypageIndex]['sec'][$mysubpageIndex]['page']) && strstr($data['menuitem'][$i]['children'][$a]['children'][$c]['a_attr']['href'],$mypage))){ echo 'active';} ?>">  <a
                                href="<?php echo $data['menuitem'][$i]['children'][$a]['children'][$c]['a_attr']['href'] ?>"><?php echo $data['menuitem'][$i]['children'][$a]['children'][$c]['text'] ?></a>
                            </li><?php
                        } ?> </ul><?php
                    }
                    else {

                        echo "</a>";
                    }
                    ?> </li> <?php
            } }?>
        </ul>
        <?php

    }
    else {

        echo "</a>";
    }
        ?></li><?php
    }
    else{
        if((count($data['menuitem'][$i]['children']) && !$data['menuitem'][$i]['state']['selected']) ){
            ?>

            <li class="nav-item <?php if($data['menuitem'][$i]['text']==$p[$mypageIndex]['key']){ echo 'open';} ?>">
        <a class="nav-link nav-toggle" href='<?php echo $data['menuitem'][$i]['a_attr']['href'] ?>'>
            <i class="<?php echo $data['menuitem'][$i]['icon'] ?>"></i>
            <span class="title"><?php echo $data['menuitem'][$i]['text'] ?></span>

            <?php

        if (count($data['menuitem'][$i]['children']) >= 1){ ?>
            <span class="arrow <?php if($data['menuitem'][$i]['text']==$p[$mypageIndex]['key']){ echo 'open';} ?>"></span> </a>
        <ul class="sub-menu" <?php if($data['menuitem'][$i]['text']==$p[$mypageIndex]['key']){ echo 'style="display:block;"';} ?> > <?php
                for ($a = 0; $a < count($data['menuitem'][$i]['children']); $a++) {

                    if( $data['menuitem'][$i]['children'][$a]['state']['selected']){
                ?>
                <li class="nav-item <?php if((in_array($mypage,$p[$mypageIndex]['page']) && strstr($data['menuitem'][$i]['children'][$a]['a_attr']['href'],$mypage)) || (in_array($data['menuitem'][$i]['children'][$a]['text'],$p[$mypageIndex]['sec']) && strstr($data['menuitem'][$i]['children'][$a]['a_attr']['href'],$data['menuitem'][$i]['children'][$a]['text']))  ){ echo 'active';} ?>"><a class="nav-link nav-toggle"
                                         href="<?php echo $data['menuitem'][$i]['children'][$a]['a_attr']['href'] ?>"><?php echo $data['menuitem'][$i]['children'][$a]['text'] ?>
                        <?php
                        if (count($data['menuitem'][$i]['children'][$a]['children']) >= 1){ ?>
                        <span class="arrow <?php if(in_array($data['menuitem'][$i]['children'][$a]['text'],$p[$mypageIndex]['sec']) && strstr($data['menuitem'][$i]['children'][$a]['a_attr']['href'],$data['menuitem'][$i]['children'][$a]['text'])){ echo 'open';} ?>"></span> </a>
                    <ul class="sub-menu"
                     <?php if(in_array($data['menuitem'][$i]['children'][$a]['text'],$p[$mypageIndex]['sec']) && strstr($data['menuitem'][$i]['children'][$a]['a_attr']['href'],$data['menuitem'][$i]['children'][$a]['text']) ){ 
            echo "style='display:block'";
        } else{ 
            echo "style='display:none'"; 
        } ?>

                    >
                        <?php
                        for ($c = 0; $c < count($data['menuitem'][$i]['children'][$a]['children']); $c++) {
                            # code...
                            ?>
                            <li class="nav-item <?php if(in_array($mypage,$p[$mypageIndex]['secpage']) && strstr($data['menuitem'][$i]['children'][$a]['children'][$c]['a_attr']['href'],$mypage)){ echo 'active';} ?>">  <a
                                href="<?php echo $data['menuitem'][$i]['children'][$a]['children'][$c]['a_attr']['href'] ?>"><?php echo $data['menuitem'][$i]['children'][$a]['children'][$c]['text'] ?></a>
                            </li><?php
                        } ?> </ul><?php
                    }
                    else {

                        echo "</a>";
                    }
                            ?> </li> <?php
                    } }?>
            </ul>
            <?php

        }
        else {

            echo "</a>";
        }
            ?></li><?php
        }
    }
}

?>
</ul>

		