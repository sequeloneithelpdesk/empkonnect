<?php
include("../../db_conn.php");
include('../../configdata.php');

if($_POST['type']=="Add") {
    //print_r($_POST); die;
    $subject = $_POST['subject'];
    $notification = $_POST['notification'];
    $content = $_POST['editorText'];
    $mailCategory = $_POST['mailCategory'];

    echo $sql = "INSERT INTO mail_configuration(category, subject, notification, content,created_by)
     VALUES ( '$mailCategory', '$subject', '$notification', '$content', '$user')";

    $result=mysqli_query($conn, $sql);
    if($result){
        echo"Success";
    }
    else{
        echo mysqli_error();
    }

}

elseif($_POST['type']=="Edit"){



    $subject = $_POST['subject'];
    $notification = $_POST['notification'];
    $content = $_POST['editorText'];
    $mailCategory = $_POST['category2'];
    $id = $_POST['id'];

    $sql1= "UPDATE mail_configuration SET category='$mailCategory', subject='$subject', notification='$notification', content='$content' WHERE id=$id";
    $result1 = $conn->query($sql1);

    if($result1){
        echo"Success";
    }
    else{
        echo mysqli_error();
    }

}

elseif ($_POST['type']=="mailstatus") {

    $id=$_POST['id'];
    $status=$_POST['status'];

    if($status=="Active"){
        $status="Inactive";
    }else{
        $status="Active";
    }
    $sql2="update mail_configuration set mail_status='$status' where id=$id";
    $result2 = $conn->query($sql2);
    if($result2){
        echo "1";
    }
    else{
        echo"Error";
    }

}


?>


