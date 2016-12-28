
<?php
include("../../db_conn.php");
include('../../configdata.php');


echo $action = $_POST['action'];
if($action == "edit"){
    $v_id = $_POST['hiddenID'];
    $Dcode = $_POST['Dcode'];
    $Lcode = $_POST['Lcode'];
    $Depcode = $_POST['Depcode'];
    $Pcode = $_POST['Pcode'];
    $NoVac = $_POST['NoVac'];
    $sp = $_POST['sp'];
    $odate = $_POST['odate'];
    $cdate = $_POST['cdate'];
    $expTo = $_POST['expTo'];
    $expFrom = $_POST['expFrom'];
    $salary = $_POST['salary'];
    $sex = $_POST['sex'];
    $ageTo = $_POST['ageTo'];
    $ageFrom = $_POST['ageFrom'];
    $vReason = $_POST['vReason'];
    $vtype = $_POST['vtype'];
    $profile = $_POST['profile'];
    $vstatus = $_POST['vstatus'];
    $title = $_POST['title'];
    $qual = $_POST['qual'];
    $skill = $_POST['skill'];
    

    $sql = "Update Vacancy Set Dsg_Code='$Dcode',Loc_Code='$Lcode',Dept_Code='$Depcode',Proc_Code='$Pcode',
Wanted_No='$NoVac',SourcePerson='$sp',Opn_Date='$odate',Cls_Date='$cdate',Exp_From='$expFrom',Exp_To='$expTo',ProposedSalary='$salary',
Sex='$sex',Age_From='$ageFrom',Age_To='$ageTo',VacancyReason='$vReason',VacancyType='$vtype',JobProfile='$profile',VacancyStatus='$vstatus',Title='$title'";
       $result = query($query,$sql,$pa,$opt,$ms_db);
    if($result){
        echo "success";
    }
    $sql_q = "Update VacancyQual Set Qual_Code='$qual'";
    $result_q = query($query,$sql_q,$pa,$opt,$ms_db);
    if($result_q){
        echo "success";
    }
    $sql_s = "Update VacancySkills Set Skill_Code='$skill'";
    $result_s = query($query,$sql_s,$pa,$opt,$ms_db);
    if($result_s){
        echo "success";
    }


}
else if($action == "add"){
    $Dcode = $_POST['Dcode'];
    $Lcode = $_POST['Lcode'];
    $Depcode = $_POST['Depcode'];
    $Pcode = $_POST['Pcode'];
    $NoVac = $_POST['NoVac'];
    $sp = $_POST['sp'];
    $odate = $_POST['odate'];
    $cdate = $_POST['cdate'];
    $expTo = $_POST['expTo'];
    $expFrom = $_POST['expFrom'];
    $salary = $_POST['salary'];
    $sex = $_POST['sex'];
    $ageTo = $_POST['ageTo'];
    $ageFrom = $_POST['ageFrom'];
    $vReason = $_POST['vReason'];
    $vtype = $_POST['vtype'];
    $profile = $_POST['profile'];
    $title = $_POST['title'];
    $qual = $_POST['qual'];
    $skill = $_POST['skill'];
    $vstatus = $_POST['vstatus'];


    $sql = "INSERT INTO Vacancy (Vacancy_Code,Dsg_Code,Loc_Code,Dept_Code,Proc_Code,Wanted_No,SourcePerson,Opn_Date,Cls_Date,Exp_From,Exp_To,ProposedSalary,
Sex,Age_From,Age_To,VacancyReason,VacancyType,JobProfile,VacancyStatus,Title) 
        VALUES ('V002', '$Dcode','$Lcode','$Depcode','$Pcode','$NoVac','$sp','$odate','$cdate','$expTo','$expFrom','$salary'
        ,'$sex','$ageTo','$ageFrom','$vReason','$vtype','$profile','$vstatus','$title')";
    $result = query($query,$sql,$pa,$opt,$ms_db);
    if($result){
        echo "success";
    }
    $sql_q = "INSERT INTO VacancyQual (Qual_Code) VALUES ('$qual')";
    $result_q = query($query,$sql_q,$pa,$opt,$ms_db);
    if($result_q){
        echo "success";
    }
    $sql_s = "INSERT INTO VacancySkills (Skill_Code) VALUES ( '$skill')";
    $result_s = query($query,$sql_s,$pa,$opt,$ms_db);
    if($result_s){
        echo "success";
    }

}

?>