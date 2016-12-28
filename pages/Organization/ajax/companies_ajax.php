<?php
include ('../../db_conn.php');
include ('../../configdata.php');
    ECHO $action=$_POST['func'];
    $compName=$_POST['compName'];
    $compLogo=$_FILES['compLogo']['name'];
    $dir = "../logo/";
    move_uploaded_file($_FILES['compLogo']['tmp_name'], $dir. $compLogo);
    ECHO $compAddr =$_POST['compAddr'];
    $compCountry =$_POST['compCountry'];
    $count_val = explode(",", $compCountry);
    $compState =$_POST['compState'];
    $compCity =$_POST['compCity'];
    $compPin =$_POST['compPin'];
    $compPhone =$_POST['compPhone'];
    $compFax =$_POST['compFax'];
    $PFNo =$_POST['PFNo'];
    $ESINo =$_POST['ESINo'];
    $PANNo =$_POST['PANNo'];
    $TANNo =$_POST['TANNo'];
    $TDSCircle =$_POST['TDSCircle'];
    $TINNo =$_POST['TINNo'];
    $RegistNo =$_POST['RegistNo'];
    $LSTNo =$_POST['LSTNo'];
    $CSTNo =$_POST['CSTNo'];
    $STaxNo =$_POST['STaxNo'];
    $emailId =$_POST['emailId'];
    $website =$_POST['website'];
    $CITAddr =$_POST['CITAddr'];
    $CITCity =$_POST['CITCity'];
    $CITPIN =$_POST['CITPIN'];

if($action == 'add') {
    ECHO $sql = "Insert into CompMast (COMP_NAME,Comp_Logo,COMP_ADDR,COMP_COUNTRY,COMP_STATE,COMP_CITY,
            COMP_PIN,COMP_PhoneNo,COMP_FAX,COMP_PFNO,COMP_ESINO,COMP_PANNO,COMP_TANNO,COMP_TDSCIRCLE,
            TINNo,Regist_No,LSTNo,CSTNo,Service_TaxNo,COMP_Email,COMP_URL,CIT_Addr,CIT_City,CIT_PIN) VALUES
            ('$compName','$compLogo','$compAddr','$count_val[0]','$compState','$compCity','$compPin','$compPhone',
            '$compFax','$PFNo','$ESINo','$PANNo','$TANNo','$TDSCircle','$TINNo','$RegistNo','$LSTNo','$CSTNo','$STaxNo',
            '$emailId','$website','$CITAddr','$CITCity','$CITPIN')";

    $result = query($query, $sql, $pa, $opt, $ms_db);
    if ($result === false) {
        die();
    } else {
        echo "Form updated.";
    }

}
else{


    $compID=$_POST['hidecompID'];


    if($compLogo==""){
        $Logo=$_POST['company_logoName'];

    }
    else{
        $Logo=$compLogo;
    }
    echo $sql = "Update CompMast  set COMP_NAME='$compName',Comp_Logo='$Logo',COMP_ADDR='$compAddr',COMP_COUNTRY='$count_val[0]'
                  ,COMP_STATE='$compState',COMP_CITY='$compCity',COMP_PIN='$compPin',COMP_PhoneNo='$compPhone'
                  ,COMP_FAX='$compFax',COMP_PFNO='$PFNo',COMP_ESINO='$ESINo',COMP_PANNO='$PANNo',COMP_TANNO='$TANNo',
                  COMP_TDSCIRCLE='$TDSCircle',TINNo='$TINNo',Regist_No='$RegistNo',LSTNo='$LSTNo',CSTNo='$CSTNo',
                  Service_TaxNo='$STaxNo',COMP_Email='$emailId',COMP_URL='$website',CIT_Addr='$CITAddr',CIT_City='$CITCity',
                  CIT_PIN='$CITPIN' WHERE COMPID='$compID'";


    $result = query($query,$sql,$pa,$opt,$ms_db);
    if($result === false)
    {
        die();
    }else
    {
        echo "Form updated.";
    }
}