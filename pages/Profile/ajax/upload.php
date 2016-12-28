<?php
include ('../../db_conn.php');
include ('../../configdata.php');
$fileName=$_FILES["file"]["name"];
$empCode=$_GET['empCode'];

$target_dir = "../upload_images/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
	$check = getimagesize($_FILES["file"]["tmp_name"]);
	if($check !== false) {
		echo "File is an image - " . $check["mime"] . ".";
		$uploadOk = 1;
	} else {
		echo "File is not an image.";
		$uploadOk = 0;
	}
}
// Check if file already exists
//if (file_exists($target_file)) {
//	echo "Sorry, file already exists.";
//	$uploadOk = 0;
//}
// Check file size
if ($_FILES["file"]["size"] > 500000) {
	echo "Imagge size can not be more than 500 KB !";
	$uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	echo "Only JPG, JPEG, PNG & GIF is allowed.";
	$uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
	//echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
	if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
		$sql="UPDATE hrdmast set EmpImage='$fileName' WHERE Emp_Code='$empCode'";
		$result=query($query,$sql,$pa,$opt,$ms_db);
		if($result){
			echo "Image has been uploaded";
		//echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
		}else{
			echo "Sorry, there was an error in updating profile into table.";
		}
	} else {
		echo "Sorry, there was an error uploading your file.";
	}
}
?>
