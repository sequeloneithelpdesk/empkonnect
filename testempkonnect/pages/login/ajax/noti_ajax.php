<?php
session_start();
include ('../../db_conn.php');
include ('../../configdata.php');

if($_GET['type']=="compNoti"){

            $result = array();
			$sqlq="select * from CompAnnounce WHERE Convert(Date,GETDATE(),3) = AnnounceDate OR Convert(Date,GETDATE(),3)<= EndAnnounceDate ";
			$resultq=query($query,$sqlq,$pa,$opt,$ms_db);
			if($num($resultq))
            {
                while ($rowq = $fetch($resultq))
                {
                    $result[] = $rowq['AnnouncementMessage'];
                }
            }
			if(!empty($result))		{
                //print_r($result);
                $notif = join(",",$result);
                echo'<marquee>'; echo strip_tags($notif);
                echo'</marquee>';
            }
    else{
        echo"1";
    }

}
if($_GET['type']=="deptNoti"){

	$sqlq="select * from DeptNotification WHERE (Convert(Date,GETDATE(),3) = notifyDate OR Convert(Date,GETDATE(),3)<= EndnotifyDate) AND notify_type='dpt' ";
	$resultq=query($query,$sqlq,$pa,$opt,$ms_db);
    if($num($resultq) == 0){
        echo"1";
    }
    else {
        while ($rowq = $fetch($resultq)) {
            echo '<li class="list-group-item p-0 pb-15">';
            echo '<span class="fs-16">';
            echo $rowq['notification'];
            echo '</span>
                                    </li>';
        }
    }




}
if($_GET['type']=="reptNoti"){

    $sqlq="select * from DeptNotification WHERE Convert(Date,GETDATE(),3) = notifyDate Or Convert(Date,GETDATE(),3)<= EndnotifyDate AND notify_type='rpt' ";
    $resultq=query($query,$sqlq,$pa,$opt,$ms_db);
    if($num($resultq) == 0){
        echo"1";
    }
    else {
        while ($rowq = $fetch($resultq)) {
            ?>
            <li class="list-group-item p-0 pb-15">
                <span class="fs-16"><?php echo $rowq['notification'];?></span>
            </li>
            <?php

        }
    }





}