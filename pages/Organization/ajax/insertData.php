<?php

include '../../db_conn.php';
include '../../configdata.php';
//To Add Locations in locMast Table.
//To Add Business Unit in bussMast Table
if (isset($_GET[pagetype]) and $_GET[pagetype] == 'add_business_unit') {
    if (isset($_POST[bussCode]) && !empty($_POST[bussCode]) && isset($_POST[bussName]) && !empty($_POST[bussName]) && isset($_POST[bussHname]) && !empty($_POST[bussHname]) && isset($_POST[bussReport]) && !empty($_POST[bussReport]) && isset($_POST[bussCur]) && !empty($_POST[bussCur])) {
        $sql = "INSERT INTO BussMast(Buss_Code, BussName, BussHname,BussReport, BussAbt, BussAddr, BussCity, BussPin, BussState, BussCur)
    values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $pa = array('$_POST[bussCode]',' $_POST[bussName]',' $_POST[bussHname]',' $_POST[bussReport]',' $_POST[bussAbt]',' $_POST[bussAddr]',' $_POST[bussCity]',' $_POST[bussPin]',' $_POST[bussState]',' $_POST[bussCur]');
        $stmt = query($query, $sql, $pa, $opt, $ms_db);
        if ($stmt === false) {
            die();
        } else {
            echo "Form submitted.";
        }
    }
}
//$resize = json_decode($_POST[name_print]);
if (isset($_GET[pagetype]) and $_GET[pagetype] == 'add_location') {
    //$resize = json_decode($_POST[name_print]);
    $sql = "INSERT INTO locMast (LOC_CODE, LOC_NAME, LOC_TYPE, LOC_PARENT, WORK_LOC, LOC_ADDR1, LOC_ADDR2,CITY,LOC_STATE, PIN_CODE, COUNTRY, PF_CODE, ESI_CODE,locTimeZone,locCurrency) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?)";
    $pa = array('$_POST[locCode]',' $_POST[locName]',' $_POST[locType]',' $_POST[locParent]',' $_POST[locWork]',' $_POST[locAdd1]',' $_POST[locAdd2]',' $_POST[locCity]',' $_POST[locState]',' $_POST[locPin]',' $_POST[locCountry]',' $_POST[locPfCode]',' $_POST[locEsiCode]',' $_POST[loc_timezone]',' $_POST[locCurrency]');
    $stmt = query($query, $sql, $pa, $opt, $ms_db);
    if ($stmt === false) {
        die();
    } else {
        echo "Form submitted.";
        exit;
    }
}
//To Add Work Location
if (isset($_GET[pagetype]) and $_GET[pagetype] == 'add_work_location') {
    $sql = "INSERT INTO WorkLocMast(WLOC_CODE, WLOC_NAME, WLOC_TYPE, WLOC_PARENT_LOCATION, WLOC_WORK, WLOC_ADD1, WLOC_ADD2, WLOC_CITY, WLOC_STATE, WLOC_PIN, WLOC_COUNTRY) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
    $pa = array('$_POST[wlocCode]',' $_POST[wlocName]',' $_POST[wlocType]',' $_POST[wlocParent]',' $_POST[wlocWork]',' $_POST[wlocAdd1]',' $_POST[wlocAdd2]',' $_POST[wlocCity]',' $_POST[wlocState]',' $_POST[wlocPin]',' $_POST[wlocCountry]');
    $stmt = query($query, $sql, $pa, $opt, $ms_db);
    if ($stmt === false) {
        die();
    } else {
        echo "Form submitted.";
    }
}
//To Add State
if (isset($_GET[pagetype]) and $_GET[pagetype] == 'add_state') {
    if (isset($_POST[stateName]) && !empty($_POST[stateName]) && isset($_POST[countryId]) && !empty($_POST[countryId])) {
        $sql = "INSERT INTO StateMast (State_Name, Country_Id, State_Status) VALUES ('$_POST[stateName]',' $_POST[countryId]',' $_POST[status]')";
        //$pa = array();
        $stmt = query($query, $sql, $pa, $opt, $ms_db);
        if ($stmt === false) {
            die();
        } else {
            echo "Form submitted.";
            exit;
        }
    }
}
//To Add Bank Details in bankMast Table
if (isset($_GET[pagetype]) and $_GET[pagetype] == 'add_bank_details') {
    if (isset($_POST[bankCode]) && !empty($_POST[bankCode]) &&
            isset($_POST[bankName]) && !empty($_POST[bankName]) &&
            isset($_POST[bankBranch]) && !empty($_POST[bankBranch]) &&
            isset($_POST[bankIFSC]) && !empty($_POST[bankIFSC]) &&
            isset($_POST[bankType]) && !empty($_POST[bankType]) &&
            isset($_POST[compIFSC]) && !empty($_POST[compIFSC]) &&
            isset($_POST[compMICR]) && !empty($_POST[compMICR]) &&
            isset($_POST[compBankAcNo]) && !empty($_POST[compBankAcNo])) {
        $sql = "INSERT INTO BankMast (BANK_CODE, BANK_NAME, BANK_BRANCH,BANK_IFSC, BANK_MICR, BankType ,BANK_ADDR, BANK_PHONE, BANK_CITY, BANK_STATE, BANK_PIN, COMP_IFSC,COMP_MICR,BANK_ACCNO)
      VALUES ('$_POST[bankCode]', '$_POST[bankName]', '$_POST[bankBranch]', '$_POST[bankIFSC]', '$_POST[bankMICR]', '$_POST[bankType]','$_POST[bankAddress]', '$_POST[bankPhone]','$_POST[bankCity]', '$_POST[bankState]', '$_POST[bankPin]','$_POST[compIFSC]','$_POST[compMICR]','$_POST[compBankAcNo]')";
        $result = query($query, $sql, $pa, $opt, $ms_db);
        if ($result === TRUE) {
            echo "Bank Details Added Successfully..";
            exit;
        } else {
            echo "There is some problem: " ;
        }
    }
}

//To Add Functions
if (isset($_GET[pagetype]) and $_GET[pagetype] == 'add_function') {
    if (isset($_POST[functCode]) && !empty($_POST[functCode]) && isset($_POST[functName]) && !empty($_POST[functName]) && isset($_POST[functType]) && !empty($_POST[functType]) && isset($_POST[functHead]) && !empty($_POST[functHead])) {
        $sql = "INSERT INTO FUNCTMast (FUNCT_CODE,  FUNCT_NAME,  FUNCT_TYPE,  FUNCTHEAD) VALUES ('$_POST[functCode]', '$_POST[functName]', '$_POST[functType]', '$_POST[functHead]')";
        $result = query($query, $sql, $pa, $opt, $ms_db);
        if ($result === TRUE) {
            echo "Function Added Successfully..";
            exit;
        } else {
            echo "There is some problem: ";
        }
    }
}
//To Add Employee Type
if (isset($_GET[pagetype]) and $_GET[pagetype] == 'add_emp_type') {
    if (isset($_POST[empTypeCode]) && !empty($_POST[empTypeCode]) && isset($_POST[empTypeName]) && !empty($_POST[empTypeName]) ) {
        $sql = "INSERT INTO EmpType (TYPE_CODE,  TYPE_NAME) VALUES ('$_POST[empTypeCode]', '$_POST[empTypeName]')";
        $result = query($query, $sql, $pa, $opt, $ms_db);
        if ($result === TRUE) {
            echo "Employee Type Added Successfully.";
            exit;
        } else {
            die();
        }
    }
}
// To Add Cost Allocation Master
if (isset($_GET[pagetype]) && $_GET[pagetype] == 'add_cost_allocation') {
    if (isset($_POST[empCode]) && !empty($_POST[empCode]) && isset($_POST[sNo]) && !empty($_POST[sNo]) && isset($_POST[costPer]) && !empty($_POST[costPer]) && isset($_POST[orgMaster]) && !empty($_POST[orgMaster])) {
        $sql = "INSERT INTO CostAllocMast(Comp_Code, Regn_Code, Cost_Per) VALUES ('$_POST[empCode]','$_POST[sNo]', '$_POST[costPer]')";
        $result = query($query, $sql, $pa, $opt, $ms_db);
        if ($result === TRUE) {
            echo "Cost Allocation Master Added Successfully..!";
        } else {
            die();
        }
    }
}

//To Add Roles
if (isset($_GET[pagetype]) and $_GET[pagetype] == 'add_roles') {
    if (isset($_POST[roleCODE]) && !empty($_POST[roleCODE]) && isset($_POST[roleNAME]) && !empty($_POST[roleNAME]) && isset($_POST[roleGrp]) && !empty($_POST[roleGrp]) && isset($_POST[roleMngr]) && !empty($_POST[roleMngr])) {
        $sql = "INSERT INTO roleMast (ROLE_CODE, ROLE_NAME, Role_Grp, Role_Mngr, Role_Profile, Role_Quali, Role_Skill, Role_Exp, Role_Other, Role_JobDesc, Role_HiringTime) VALUES
    ('$_POST[roleCODE]', '$_POST[roleNAME]', '$_POST[roleGrp]', '$_POST[roleMngr]', '$_POST[roleProfile]', '$_POST[roleQuali]', '$_POST[roleSkill]', '$_POST[roleExp]', '$_POST[roleOther]', '$_POST[roleJobDesc]', '$_POST[roleHiringTime]')";
        $result = query($query, $sql, $pa, $opt, $ms_db);
        if ($result === TRUE) {
            echo "New Role Added Successfully..!";
        } else {
            die();
        }
    }
}
//To Add Grades
if (isset($_GET[pagetype]) and $_GET[pagetype] == 'add_grade') {
    $sql = "INSERT INTO GrdMast(GRD_CODE, GRD_NAME,Level_Code,Level_Name)VALUES ('$_POST[grdCode]','$_POST[grdName]','$_POST[levelCode]','$_POST[levelName]')";
    $result = query($query, $sql, $pa, $opt, $ms_db);
	$sql1 = "INSERT INTO LevelMast (LEVEL_Code, LEVEL_Name) VALUES ('$_POST[levelCode]', '$_POST[levelName]')";
	$result1=query($query,$sql1,$pa,$opt,$ms_db);
    if ($result === TRUE) {
        echo "Grade/Level Added Successfully..!";
    } else {
        die();
    }
}
//To add Level
//if (isset($_GET[pagetype]) and $_GET[pagetype] == 'add_level') {
//    if (isset($_POST[levelCode]) && !empty($_POST[levelCode]) && isset($_POST[levelName]) && !empty($_POST[levelName])) {
//        $sql = "INSERT INTO LevelMast (LEVEL_Code, LEVEL_Name) VALUES ('$_POST[levelCode]', '$_POST[levelName]')";
//        $result=query($query,$sql,$pa,$opt,$ms_db);
//        if ($result === TRUE) {
//            echo "Level Added Successfully..!";
//        } else {
//             die();
//        }
//    }
//}
//To Add New Process
if (isset($_GET[pagetype]) and $_GET[pagetype] == 'add_process') {
    if (isset($_POST[procCode]) && !empty($_POST[procCode]) && isset($_POST[procName]) && !empty($_POST[procName])) {
        $sql = "INSERT INTO PROCMAST (PROC_CODE, PROC_NAME) VALUES ('$_POST[procCode]', '$_POST[procName]')";
        $result = query($query, $sql, $pa, $opt, $ms_db);
        if ($result === TRUE) {
            echo "Process Added Successfully..!";
        } else {
            die();
        }
    }
}
//To Add Cost Center
if (isset($_GET[pagetype]) and $_GET[pagetype] == 'add_cost_center') {
    if (isset($_POST[costCode]) && !empty($_POST[costCode]) && isset($_POST[costName]) && !empty($_POST[costName])) {
        $sql = "INSERT INTO CostMast (COST_CODE, COST_NAME) VALUES ('$_POST[costCode]', '$_POST[costName]')";
        $result = query($query, $sql, $pa, $opt, $ms_db);
        if ($result === TRUE) {
            echo 1;
        } else {
            die(print_r($_SESSION[phpsql_error](), true));
        }
    }
}
//To Add New Holiday
if (isset($_GET[pagetype]) and $_GET[pagetype] == 'add_holiday') {
    $sql = "INSERT INTO HOLIDAYS (HDATE,LOC_CODE,HCODE,HDESC) VALUES ('$_POST[hDate]', '$_POST[locCode]', '$_POST[hCode]', '$_POST[hDesc]')";
    $result = query($query, $sql, $pa, $opt, $ms_db);
    if($result === TRUE) {
        echo "Holiday Added Successfully.";
        exit;
    } else {
        die();
    }
}
//Add Qualification
if (isset($_GET[pagetype]) and $_GET[pagetype] == 'add_qualification') {
    if (isset($_POST[qualCode]) && !empty($_POST[qualCode]) && isset($_POST[qualName]) && !empty($_POST[qualName])) {
        $sql = "INSERT INTO QualMast (Qual_Code, Qual_Name) VALUES ('$_POST[qualCode]', '$_POST[qualName]')";
        $result = query($query, $sql, $pa, $opt, $ms_db);
        if ($result === TRUE) {
            echo "Qualification Added Successfully..!";
        } else {
            die();
        }
    }
}
//To Add Country
if (isset($_GET[pagetype]) and $_GET[pagetype] == 'add_country') {
        $sql = "INSERT INTO CountryMast (Country_CODE, Country_NAME) VALUES ('$_POST[countryCode]', '$_POST[countryName]')";
        $result = query($query, $sql, $pa, $opt, $ms_db);
        if ($result === TRUE) {
            echo "Country Added Successfully..!";
        } else {
            die();
        }
}

//To Add City
if (isset($_GET[pagetype]) and $_GET[pagetype] == 'add_city') {
        $sql = "INSERT INTO cityMast (City_NAME, State_Id) VALUES ('$_POST[cityName]', '$_POST[stateId]')";
        $result = query($query, $sql, $pa, $opt, $ms_db);
        if ($result === TRUE) {
            echo "City Added Successfully..!";
        } else {
            die();
        }
}
//To Add Option Master
if (isset($_GET[pagetype]) and $_GET[pagetype] == 'add_costMast') {
    $sql = "INSERT INTO optionMast (fieldName, fieldValue, fieldText, fieldActive, fieldOrderNo, fieldDefault, tableName, type) VALUES ('$_POST[fieldName]', '$_POST[fieldValue]', '$_POST[fieldText]', '$_POST[fieldActive]', '$_POST[fieldOrderNo]', '$_POST[fieldDefault]', '$_POST[tableName]', '$_POST[type]')";
    $result = query($query, $sql, $pa, $opt, $ms_db);
    if ($result === TRUE) {
        echo "Option Added Successfully..!";
    } else {
        die();
    }
}
//To Add Option Master
if (isset($_GET[pagetype]) and $_GET[pagetype] == 'add_optionMast') {
    $sql = "INSERT INTO LOVMast (LOV_Field, LOV_Value, LOV_Text, LOV_Active, LOV_OrdNo, LOV_Default) VALUES ('$_POST[fieldName]', '$_POST[fieldValue]', '$_POST[fieldText]', '$_POST[fieldActive]', '$_POST[fieldOrderNo]', '$_POST[fieldDefault]')";
    $result = query($query, $sql, $pa, $opt, $ms_db);
    if ($result === TRUE) {
        echo "Option Added Successfully..!";
    } else {
        die();
    }
}
//To Add Reason Master
if (isset($_GET[pagetype]) and $_GET[pagetype] == 'add_reason') {
    $sql = "INSERT INTO REASONMAST (REASON_CODE, REASON_NAME, REASON_CATEGORY, REASON_DETAIL) VALUES ('$_POST[Rcode]',  '$_POST[Rname]',  '$_POST[Rcategory]',  '$_POST[Rdetail]')";
    $result = query($query, $sql, $pa, $opt, $ms_db);
    if ($result === TRUE) {
        echo "Reason Added Successfully..!";
    } else {
        die();
    }
}
// To Add University
if (isset($_GET[pagetype]) and $_GET[pagetype] == 'add_university') {
    $sql = "INSERT INTO UnivMast (Univ_Code, Univ_Name, Univ_Categ) VALUES ('$_POST[univCode]', '$_POST[univName]', '$_POST[Univ_Categ]')";
    $result = query($query, $sql, $pa, $opt, $ms_db);
    if ($result === TRUE) {
        echo "University Added Successfully..!";
    } else {
        die();
    }
}
//To Add Sub Function
if (isset($_GET[pagetype]) and $_GET[pagetype] == 'add_sub_function') {
    $sql = "INSERT INTO SubFunctMast(SubFunct_CODE, SubFunct_NAME, SubFunct_HEAD, Func_Code) VALUES ('$_POST[subFunctCode]', '$_POST[subFunctName]', '$_POST[emplyeemaster]', '$_POST[mainfunctionlist]')";
    $result = query($query, $sql, $pa, $opt, $ms_db);
    if ($result === TRUE) {
        echo "Sub Function Added Successfully..!";
    } else {
        die();
    }
}
