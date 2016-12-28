<?php
include '../../db_conn.php';
include ('../../configdata.php');
//To Add Family
if($_GET['type']== "AddFamily" ){
	$empcode=$_POST['empCode'];
  	$relativeName = $_POST['relativeName'];
  	$relationship = $_POST['relationship'];
  	$dependent = $_POST['dependent'];
    if($empcode == "" ){
        echo "noEmp";

    }
    elseif ($_POST['dateOfBirth'] == ""){
        $dateOfBirth="00:00:00";
    }
    else {
        $dateOfBirth = dateConversion($_POST['dateOfBirth']);
        $sql = "INSERT INTO HrdFamily (EMP_CODE, Relative_Name, Relation, Relative_DOB, Dependent) VALUES ('$empcode', '$relativeName', '$relationship', '$dateOfBirth', '$dependent')";
        $result = query($query,$sql,$pa,$opt,$ms_db);

        if ($result == TRUE) {
            $sql1 = "Select * FROM HrdFamily WHERE EMP_CODE='$empcode'";
            $result1 = query($query,$sql1,$pa,$opt,$ms_db);

            if ($result1) {
                $list = "";

                    while ($row = $fetch($result1)) {

                        $list .= "<tr class='odd gradeX'><td>" . $row['Relative_Name'] . "</td><td>" . $row['Relation'] . "</td><td>" . $row['Dependent'] . "</td></tr>";
                    }
                    echo $list;

            }

        } else {
            echo "Not Result to display";
        }

    }
}

//To Add Nominee Details
if($_GET['type']=='addNominee'){
  $empcode=$_POST['empId'];
  $nomineeName = $_POST['nomineeName'];
  $nomineeRelation = $_POST['nomineeRelation'];
  $pfShare = $_POST['pfShare'];
  $esiShare = $_POST['esiShare'];
    if($_POST['gratuityShare'] == ""){
        $gratuityShare=0;
    }else{
        $gratuityShare=$_POST['gratuityShare'];
    }
    if ($_POST['nomineeDob'] == ""){
        $nomineeDob="";

    }else{
        $nomineeDob=dateConversion($_POST['nomineeDob']);
    }
    if ($_POST['nomineeWef'] == ""){
        $nomineeWef="";

    }else{
        $nomineeWef=dateConversion($_POST['nomineeWef']);
    }
       $sql = "INSERT INTO Nominee (Emp_Code, Nominee_Name, Nominee_Relation, Nominee_DOB, Nominee_WEF, Nominee_Addr1, Nominee_Addr2, Nominee_Share) VALUES ('$empcode', '$nomineeName', '$nomineeRelation', '$nomineeDob', '$nomineeWef', '$pfShare', '$esiShare', $gratuityShare)";
        $result = query($query,$sql,$pa,$opt,$ms_db);
        if ($result == TRUE) {
             $sql1 = "select * from Nominee WHERE Emp_Code='$empcode'";
            $result1 = query($query,$sql1,$pa,$opt,$ms_db);

            if ($result1) {
                $list = "";
                while ($row = $fetch($result1)) {
                    $list .= "<tr class='odd gradeX'><td>" . $row['Nominee_Name'] . "</td><td>" . $row['Nominee_Relation'] . "</td><td>" . $row['Nominee_Addr1'] . "</td><td>" . $row['Nominee_Addr2'] . "</td></tr>";
                }
                echo $list;
            }
        } else {
            echo "Not Result to display";
        }
}

//To Add Qualifications
if($_GET['type'] == 'addQualification'){
	$empcode=$_POST['empId'];
	$qualification = $_POST['qualification'];
	$specialization = $_POST['specialization'];
	$university = $_POST['university'];
	$college = $_POST['college'];
	$country = $_POST['country'];
	@$state = $_POST['state'];
	$city = $_POST['city'];
	$marks = $_POST['marks'];
	$grade = $_POST['grade'];
	$subject = $_POST['subject'];
    if($empcode == "" ){
        echo "noEmp";

    }if ($_POST['from'] == ""){
        $from = "00:00:00";
    }else{
        $from = dateConversion($_POST['from']);
    }
    if($_POST['to'] == ""){
        $to ="00:00:00";
    }
    else {
        $to =dateConversion($_POST['to']);
    }
         $sql = "INSERT INTO HrdQual (Emp_Code, Qual_Code, Qual_From, Qual_to, Qual_Special, Univ_Code, College, Country, Qual_State, Place, Marks_per, Grade, Subjects) VALUES ('$empcode', '$qualification', '$from', '$to', '$specialization', '$university', '$college', '$country', '$state', '$city', '$marks', '$grade', '$subject')";
        $result = query($query,$sql,$pa,$opt,$ms_db);
        if ($result == TRUE) {

          $sql1 = "select a.*,convert(varchar(20),a.Qual_From,103)as Qual_From,convert(varchar(20),a.Qual_to,103)as Qual_to ,b.Qual_Name from (Select * FROM HrdQual) a join QualMast b on a.Qual_Code=b.QualID WHERE a.Emp_Code='$empcode'
";
            $result1 = query($query,$sql1,$pa,$opt,$ms_db);

            if ($result1) {
                $list = "";
                while ($row = $fetch($result1)) {

                    $list .= "<tr class='odd gradeX'><td>" . $row['Qual_Name'] . "</td><td>" . $row['Qual_From'] . "</td><td>" . $row['Qual_to'] . "</td><td>" . $row['Qual_Special'] . "</td><td>" . $row['Univ_Code'] . "</td><td>" . $row['College'] . "</td><td>" . $row['Country'] . "</td><td>" . $row['Subjects'] . "</td></tr>";
                }
                echo $list;
            }
        } else {
            echo "Not Result to display";
        }

}

//To Add Known Language
if($_GET['type'] =='addLanguage'){
  $empcode=$_POST['empId'];
  $language = $_POST['language'];
  @$read = $_POST['read'];
  @$write = $_POST['write'];
  @$speak = $_POST['speak'];
  $understand = $_POST['understand'];
  $motherTongue = $_POST['motherTongue'];
    if($empcode == ""){
        echo "noEmp";

    }else {
         $sql = "INSERT INTO ResLanguges (Emp_Code, Languge, Read_YN, Write_YN, Speak_YN,  understand, motherTongue) VALUES ('$empcode', '$language', '$read', '$write', '$speak', '$understand', '$motherTongue')";
        $result = query($query,$sql,$pa,$opt,$ms_db);
        if ($result == TRUE) {
           // $last_id = $conn->insert_id;
             $sql = "SELECT RES.*,LOV_Text
FROM LOVMAST LOV, ResLanguges RES
WHERE LOV.LOV_Field='languge' AND LOV.LOV_Active='Y'
AND LOV.LOV_Value=RES.Languge AND Emp_Code='$empcode'";
            $result1 = query($query,$sql,$pa,$opt,$ms_db);
            if ($result1) {
                $list = "";
                while ($row = $fetch($result1)) {
                    $list .= "<tr class='odd gradeX'><td>" . $row['LOV_Text'] . "</td><td>" . $row['Read_YN'] . "</td><td>" . $row['Write_YN'] . "</td><td>" . $row['Speak_YN'] . "</td><td>" . $row['understand'] . "</td><td>" . $row['motherTongue'] . "</td></tr>";
                }
                echo $list;
            }
        } else {
            echo "Not Result to display";
        }
    }
}


//Edit more option tab

elseif ($_GET['type']=="editFamily"){
    $id=$_POST['fmid'];
    $relativeName=$_POST['relativeName'];
    $relationship=$_POST['relationship'];
   $dependent= $_POST['dependent'];

    if($_POST['dateOfBirth'] == ""){
        $dateOfBirth="00:00:00";
    }else{
        $dateOfBirth = dateConversion($_POST['dateOfBirth']);
    }

     $sql1="update HrdFamily set Relative_Name='$relativeName',Relation='$relationship',Relative_DOB='$dateOfBirth',
	Dependent='$dependent' where hrdfamilyID= '$id'";
    $result = query($query,$sql1,$pa,$opt,$ms_db);
    if($result){
        echo 1;
    }else{
        echo 0;
    }
    // $row = $fetch($result);
}


elseif ($_GET['type']=="editAddFam"){
    $empcode=$_POST['addfamid'];
    $relativeName = $_POST['relativeName'];
    $relationship = $_POST['relationship'];
    $dependent = $_POST['dependent'];


    if($_POST['dateOfBirth'] == ""){
        $dateOfBirth="00:00:00";
    }else{
        $dateOfBirth = dateConversion($_POST['dateOfBirth']);
    }

        $sql = "INSERT INTO HrdFamily (EMP_CODE, Relative_Name, Relation, Relative_DOB, Dependent) VALUES ('$empcode', '$relativeName', '$relationship', '$dateOfBirth', '$dependent')";
        $result = query($query,$sql,$pa,$opt,$ms_db);

        if ($result) {
            echo 1;
        } else {
            echo 0;
        }


}

elseif ($_GET['type']=="editNominee"){

    $id=$_POST['nomid'];
    $nomineeName=$_POST['nomineeName'];
    $nomineeRelation=$_POST['nomineeRelation'];
    $pfShare= $_POST['pfShare'];
    $esiShare= $_POST['esiShare'];

    if($_POST['gratuityShare'] == ""){
        $gratuityShare=0;
    }else{
        $gratuityShare=$_POST['gratuityShare'];
    }
    if ($_POST['nomineeDob'] == ""){
        $nomineeDob="";

    }else{
        $nomineeDob=dateConversion($_POST['nomineeDob']);
    }
    if ($_POST['nomineeWef'] == ""){
        $nomineeWef="";

    }else{
        $nomineeWef=dateConversion($_POST['nomineeWef']);
    }

   echo $sql1="update Nominee set Nominee_Name='$nomineeName',Nominee_Relation='$nomineeRelation',Nominee_DOB='$nomineeDob',
	Nominee_WEF='$nomineeWef', Nominee_ADDr1='$pfShare',Nominee_ADDr2='$esiShare',Nominee_Share=$gratuityShare  where NomineeID= '$id'";
    $result = query($query,$sql1,$pa,$opt,$ms_db);
    if($result){
        echo 1;
    }else{
        echo 0;
    }

}

elseif ($_GET['type']=="editAddNominee"){
    $empcode=$_POST['empId'];
    $nomineeName = $_POST['nomineeName'];
    $nomineeRelation = $_POST['nomineeRelation'];
    $pfShare = $_POST['pfShare'];
    $esiShare = $_POST['esiShare'];

    if($_POST['gratuityShare'] == ""){
        $gratuityShare=0;
    }else{
        $gratuityShare=$_POST['gratuityShare'];
    }
    if ($_POST['nomineeDob'] == ""){
        $nomineeDob="00:00:00";

    }else{
        $nomineeDob=dateConversion($_POST['nomineeDob']);
    }
    if ($_POST['nomineeWef'] == ""){
        $nomineeWef="00:00:00";

    }else{
        $nomineeWef=dateConversion($_POST['nomineeWef']);
    }

        $sql = "INSERT INTO Nominee (Emp_Code, Nominee_Name, Nominee_Relation, Nominee_DOB, Nominee_WEF, Nominee_Addr1, Nominee_Addr2, Nominee_Share) VALUES ('$empcode', '$nomineeName', '$nomineeRelation', '$nomineeDob', '$nomineeWef', '$pfShare', '$esiShare', '$gratuityShare')";
        $result = query($query,$sql,$pa,$opt,$ms_db);
        if ($result) {
           echo 1;

        }else{
            echo 0;
        }
}


elseif ($_GET['type']=="editAddQual"){
    $empcode=$_POST['empId'];
    $qualification = $_POST['qualification'];


    $specialization = $_POST['specialization'];
    $university = $_POST['university'];
    $college = $_POST['college'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $marks = $_POST['marks'];
    $grade = $_POST['grade'];
    $subject = $_POST['subject'];
    if($_POST['from'] == ""){
        $from = "00:00:00";
    }else{
        $from = dateConversion($_POST['from']);
    }

    if($_POST['to'] == ""){
        $to ="00:00:00";
    }else{
        $to =dateConversion($_POST['to']);
    }

       echo $sql = "INSERT INTO HrdQual (Emp_Code, Qual_Code, Qual_From, Qual_to, Qual_Special, Univ_Code, College, Country, Qual_State, Place, Marks_per, Grade, Subjects) VALUES ('$empcode', '$qualification', '$from', '$to', '$specialization', '$university', '$college', '$country', '$state', '$city', '$marks', '$grade', '$subject')";
        $result = query($query,$sql,$pa,$opt,$ms_db);
        if ($result) {
            echo 1;
        }else{
            echo 0;
        }
}

elseif ($_GET['type']=="editQual"){
    $qualId=$_POST['qualId'];
    $qualification = $_POST['qualification'];
    $specialization = $_POST['specialization'];
    $university = $_POST['university'];
    $college = $_POST['college'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $marks = $_POST['marks'];
    $grade = $_POST['grade'];
    $subject = $_POST['subject'];

    if($_POST['from'] == ""){
        $from = "00:00:00";
    }else{
        $from = dateConversion($_POST['from']);
    }

    if($_POST['to'] == ""){
        $to ="00:00:00";
    }else{
        $to =dateConversion($_POST['to']);
    }



   echo  $sql = "Update HrdQual set  Qual_Code='$qualification', Qual_From='$from', Qual_to='$to', Qual_Special='$specialization', Univ_Code='$university', College='$college', Country='$country', Qual_State='$state', Place='$city', Marks_per='$marks', Grade='$grade', Subjects='$subject' WHERE QualID=$qualId ";
    $result = query($query,$sql,$pa,$opt,$ms_db);
    if ($result) {
        echo 1;
    }else{
        echo 0;
    }
}

elseif ($_GET['type']=="editAddLang"){
    $empcode=$_POST['empId'];
    $language = $_POST['language'];
    $read = $_POST['read'];
    $write = $_POST['write'];
    $speak = $_POST['speak'];
    $understand = $_POST['understand'];
    $motherTongue = $_POST['motherTongue'];
   echo $sql = "INSERT INTO ResLanguges (Emp_Code, Languge, Read_YN, Write_YN,Speak_YN, understand, motherTongue) VALUES ('$empcode', '$language', '$read', '$write', '$speak', '$understand', '$motherTongue')";
    $result = query($query,$sql,$pa,$opt,$ms_db);
    if ($result) {
            echo 1;
    }else{
        echo 0;
    }

}

elseif ($_GET['type']=="editLang"){

    $id=$_POST['lag_id'];
    $language=$_POST['language'];
    $read=$_POST['read'];
    $write=$_POST['write'];
    $speak= $_POST['speak'];
    $understand= $_POST['understand'];
    $motherTongue= $_POST['motherTongue'];


     $sql1="update ResLanguges set Languge='$language',Speak_YN='$speak',Read_YN='$read',Write_YN='$write',understand='$understand',motherTongue='$motherTongue' where ResLangugesID='$id'";
    $result = query($query,$sql1,$pa,$opt,$ms_db);
    if($result){
        echo 1;
    }else{
        echo 0;
    }
    
}






function dateConversion($sDate){


    $aDate = explode('/', $sDate);

    @$sMySQLTimestamp = sprintf(
        '%s-%s-%s 00:00:00',
        @$aDate[2],
        @$aDate[1],
        @$aDate[0]
    );

    return $sMySQLTimestamp;

}



?>