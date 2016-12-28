<?php
//error_reporting();
//ini_set("display_errors", 1);
include('../../db_conn.php');
include('../../configdata.php');
 $type=$_GET['type'];
if($type=="policies"){

if($_FILES['hr']['name']!="" || $_GET['name']!=""){
    $size = getimagesize($_FILES['hr']['tmp_name']);
    $type = $size['mime'];
    $imgfp = fopen($_FILES['hr']['tmp_name'], 'rb');
    $size = $size[3];
    $name = $_FILES['hr']['name'];
    $maxsize = 99999999;
    $policiesname=$_GET['policiesname'];
    $subpoliciesname=$_GET['subpoliciesname'];
    $policiestitle=$_GET['policiestitle'];
    $fromDate=$_GET['fromDate'];
    $fromDate = str_replace('/', '-', $fromDate);
    $fromDate =date('Y-m-d', strtotime($fromDate));
    // $sizead = getimagesize($_FILES['admin']['tmp_name']);
    // $typead = $size['mime'];
    // $imgfpad = fopen($_FILES['admin']['tmp_name'], 'rb');
    // $sizead = $size[3];
    // $namead = $_FILES['admin']['name'];
    // $maxsizead = 99999999;
   // echo $policiesname.$subpoliciesname.$hrpolicies;
    $allowed =  array('pdf','doc' ,'xls','ppt','PDF','DOC','XLS','PPT','docx','xlsx','pptx','DOCX','XLSX','PPTX');
$ext = pathinfo($name, PATHINFO_EXTENSION);
//$ext1 = pathinfo($namead, PATHINFO_EXTENSION);
if(!in_array($ext,$allowed)  ) {
    echo 'File Type is not pdf,doc,xls and ppt .';
}
else{
    if($_FILES['hr']['size'] < $maxsize || $_FILES['admin']['size'] < $maxsizead){
        //Path
        $uploads_dir="../../".$comp_code."_uploads";
        //Hr file
        $path_file= md5($_SERVER['REQUEST_URI'].$_SERVER['REMOTE_ADDR'].rand(50000000, 900000000000)).$name;
        //$filenamehr="HrPolicies_".$name;
        $hrfilepath=$uploads_dir."/".$path_file;
        //admin file
        //$filenameadmin="AdminPolicies_".$namead;
        //$adminfilepath=$uploads_dir."/".$filenameadmin;
        //move file to folder
        
        move_uploaded_file($_FILES['hr']['tmp_name'], $hrfilepath);
        //move_uploaded_file($_FILES['admin']['tmp_name'], $adminfilepath);
        $active="1";
        $sql="INSERT INTO hrpolicy (PolicyId,Policy_Name,Sub_Policy_Name,PolicyTopic,PolicyContent, status, updatedby,effective_date) VALUES ('$comp_code','$policiesname','$subpoliciesname','$policiestitle','$path_file','$active','$user','$fromDate')";

        $stmt = query($query,$sql,$pa,$opt,$ms_db);


         if($stmt){
            echo"Y";
         }
         else{
            echo "File not inserted.";
         }
}
    else{
        throw new Exception("File Size Error");
    }
}
}
else{
    echo "Please Select File . ";
}

}


elseif($type=="showpolicies"){
?>
        <div class="col-md-12" >
        <h4 class="form-section">Policies </h4>
        <table class="table">
        <thead>
            <tr><th> Policies </th> 
            <th> Policies Type </th> 
            <th>Status</th>
            <th>Action </th>
            
            </tr>
            </thead>
            <tbody>
                <?php
                $result=query($query,"select * from hrpolicy",$pa,$opt,$ms_db);
                $i=1;
                while($row = $fetch($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row['PolicyTopic']; ?></td>
                        <td><?php echo $row['Policy_Name']."(".$row['Sub_Policy_Name'].")"; ?></td>
                        <td><button class="btn btn-default" id="hrstatus<?php echo$i; ?>" onclick="polform.hrstatus(<?php echo$row['id'] ?>,<?php echo$i; ?>,'<?php echo$row['status']; ?>');" > <?php if($row['status']=="1"){ echo "Active"; }else{ echo"Inactive"; } ; ?> </button></td>
                        <td><?php echo"<a href='../".$row['PolicyID']."_uploads/".$row['PolicyContent']."' style='color:#5b9bd1'>View</a>"; ?></td>
                        
                    </tr>
                    <?php
                    $i++;
                }
                ?>
            </tbody>
        </table>
        </div>
<?php
}

elseif ($type=="hrstatus") {
    
    $id=$_POST['id'];
    $status=$_POST['status'];

    if($status=="1"){
        $status1="0";
    }else{
        $status1="1";
    }
    $sql="update hrpolicy set status='$status1' where id='$id'";
    //$prams=array('$status','$id');
    $result=query($query,$sql,$pa,$opt,$ms_db);
    if($result){
        echo"Y";
    }
    else{
        echo"Error";
    }

}



?>