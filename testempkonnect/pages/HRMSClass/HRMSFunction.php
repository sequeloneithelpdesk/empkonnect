<?php
//Get time Zone List
//session_start();
include $_SERVER['DOCUMENT_ROOT'].$_SESSION['root']."pages/db_conn.php";
include $_SERVER['DOCUMENT_ROOT'].$_SESSION['root']."pages/configdata.php";


function tz_list() {
    $zones_array = array();
    $timestamp = time();
    foreach(timezone_identifiers_list() as $key => $zone) {
        date_default_timezone_set($zone);
        $zones_array[$key]['zone'] = $zone;
        $zones_array[$key]['diff_from_GMT'] = 'UTC/GMT ' . date('P', $timestamp);
    }
    return $zones_array;
}
//Get Currency List
function CurrencyList(){
    $currencyList=array (
            'ALL' => 'Albania Lek',
            'AFN' => 'Afghanistan Afghani',
            'ARS' => 'Argentina Peso',
            'AWG' => 'Aruba Guilder',
            'AUD' => 'Australia Dollar',
            'AZN' => 'Azerbaijan New Manat',
            'BSD' => 'Bahamas Dollar',
            'BBD' => 'Barbados Dollar',
            'BDT' => 'Bangladeshi taka',
            'BYR' => 'Belarus Ruble',
            'BZD' => 'Belize Dollar',
            'BMD' => 'Bermuda Dollar',
            'BOB' => 'Bolivia Boliviano',
            'BAM' => 'Bosnia and Herzegovina Convertible Marka',
            'BWP' => 'Botswana Pula',
            'BGN' => 'Bulgaria Lev',
            'BRL' => 'Brazil Real',
            'BND' => 'Brunei Darussalam Dollar',
            'KHR' => 'Cambodia Riel',
            'CAD' => 'Canada Dollar',
            'KYD' => 'Cayman Islands Dollar',
            'CLP' => 'Chile Peso',
            'CNY' => 'China Yuan Renminbi',
            'COP' => 'Colombia Peso',
            'CRC' => 'Costa Rica Colon',
            'HRK' => 'Croatia Kuna',
            'CUP' => 'Cuba Peso',
            'CZK' => 'Czech Republic Koruna',
            'DKK' => 'Denmark Krone',
            'DOP' => 'Dominican Republic Peso',
            'XCD' => 'East Caribbean Dollar',
            'EGP' => 'Egypt Pound',
            'SVC' => 'El Salvador Colon',
            'EEK' => 'Estonia Kroon',
            'EUR' => 'Euro Member Countries',
            'FKP' => 'Falkland Islands (Malvinas) Pound',
            'FJD' => 'Fiji Dollar',
            'GHC' => 'Ghana Cedis',
            'GIP' => 'Gibraltar Pound',
            'GTQ' => 'Guatemala Quetzal',
            'GGP' => 'Guernsey Pound',
            'GYD' => 'Guyana Dollar',
            'HNL' => 'Honduras Lempira',
            'HKD' => 'Hong Kong Dollar',
            'HUF' => 'Hungary Forint',
            'ISK' => 'Iceland Krona',
            'INR' => 'India Rupee',
            'IDR' => 'Indonesia Rupiah',
            'IRR' => 'Iran Rial',
            'IMP' => 'Isle of Man Pound',
            'ILS' => 'Israel Shekel',
            'JMD' => 'Jamaica Dollar',
            'JPY' => 'Japan Yen',
            'JEP' => 'Jersey Pound',
            'KZT' => 'Kazakhstan Tenge',
            'KPW' => 'Korea (North) Won',
            'KRW' => 'Korea (South) Won',
            'KGS' => 'Kyrgyzstan Som',
            'LAK' => 'Laos Kip',
            'LVL' => 'Latvia Lat',
            'LBP' => 'Lebanon Pound',
            'LRD' => 'Liberia Dollar',
            'LTL' => 'Lithuania Litas',
            'MKD' => 'Macedonia Denar',
            'MYR' => 'Malaysia Ringgit',
            'MUR' => 'Mauritius Rupee',
            'MXN' => 'Mexico Peso',
            'MNT' => 'Mongolia Tughrik',
            'MZN' => 'Mozambique Metical',
            'NAD' => 'Namibia Dollar',
            'NPR' => 'Nepal Rupee',
            'ANG' => 'Netherlands Antilles Guilder',
            'NZD' => 'New Zealand Dollar',
            'NIO' => 'Nicaragua Cordoba',
            'NGN' => 'Nigeria Naira',
            'NOK' => 'Norway Krone',
            'OMR' => 'Oman Rial',
            'PKR' => 'Pakistan Rupee',
            'PAB' => 'Panama Balboa',
            'PYG' => 'Paraguay Guarani',
            'PEN' => 'Peru Nuevo Sol',
            'PHP' => 'Philippines Peso',
            'PLN' => 'Poland Zloty',
            'QAR' => 'Qatar Riyal',
            'RON' => 'Romania New Leu',
            'RUB' => 'Russia Ruble',
            'SHP' => 'Saint Helena Pound',
            'SAR' => 'Saudi Arabia Riyal',
            'RSD' => 'Serbia Dinar',
            'SCR' => 'Seychelles Rupee',
            'SGD' => 'Singapore Dollar',
            'SBD' => 'Solomon Islands Dollar',
            'SOS' => 'Somalia Shilling',
            'ZAR' => 'South Africa Rand',
            'LKR' => 'Sri Lanka Rupee',
            'SEK' => 'Sweden Krona',
            'CHF' => 'Switzerland Franc',
            'SRD' => 'Suriname Dollar',
            'SYP' => 'Syria Pound',
            'TWD' => 'Taiwan New Dollar',
            'THB' => 'Thailand Baht',
            'TTD' => 'Trinidad and Tobago Dollar',
            'TRY' => 'Turkey Lira',
            'TRL' => 'Turkey Lira',
            'TVD' => 'Tuvalu Dollar',
            'UAH' => 'Ukraine Hryvna',
            'GBP' => 'United Kingdom Pound',
            'UGX' => 'Uganda Shilling',
            'USD' => 'United States Dollar',
            'UYU' => 'Uruguay Peso',
            'UZS' => 'Uzbekistan Som',
            'VEF' => 'Venezuela Bolivar',
            'VND' => 'Viet Nam Dong',
            'YER' => 'Yemen Rial',
            'ZWD' => 'Zimbabwe Dollar'
    );
    return $currencyList;
}
//Get Country List
function CountryList($id=false){
    //include ('../db_conn.php');
	//include '../configdata.php';
	global $query,$pa,$opt,$ms_db,$num,$fetch ;
    $list='<option value="0">Please, select country</option>';
    $sqlq = "SELECT * FROM CountryMast where Status ='1'";
    $resultq=query($query,$sqlq,$pa,$opt,$ms_db);
    $columnfield = array();
     if ($num($resultq) >0){
            while($row = $fetch( $resultq)){

                if($row['CountryID']==$id){$select="selected";}else{$select="";}
                $list.='<option value="'.$row['CountryID'].'" '.$select.'>'.$row['Country_NAME'].'</option>';
            }
    }

   return $list;
}

function StateList( $cid=false,$sid=false){
    //include ('../db_conn.php');
    //include '../configdata.php';
    global $query,$pa,$opt,$ms_db,$num,$fetch ;
    $list='<option value="0">Please, select State</option>';

    $sqlq = "SELECT * FROM StateMast where Country_ID='$cid'";
    $resultq=query($query,$sqlq,$pa,$opt,$ms_db);
    $columnfield = array();
    if ($num($resultq) >0){
        while($row = $fetch( $resultq)){

            if($row['StateID']==$sid){$select="selected";}else{$select="";}
            $list.='<option value="'.$row['StateID'].'" '.$select.'>'.$row['State_Name'].'</option>';
        }
    }

    return $list;
}


function CityList( $sid=false,$cid=false){
    //include ('../db_conn.php');
    //include '../configdata.php';
    global $query,$pa,$opt,$ms_db,$num,$fetch ;
    $list='<option value="0">Please, select City</option>';

    echo$sqlq = "SELECT * FROM CityMast where State_Id='$sid'";
    $resultq=query($query,$sqlq,$pa,$opt,$ms_db);
    $columnfield = array();
    if ($num($resultq) >0){
        while($row = $fetch( $resultq)){

            if($row['CityID']==$cid){$select="selected";}else{$select="";}
            $list.='<option value="'.$row['CityID'].'" '.$select.'>'.$row['City_NAME'].'</option>';
        }
    }

    return $list;
}



//echo GetData("BussMast","BUSSID",4);
function GetData($tableName, $columnName, $columnValue) {

    //include ('../../../db_conn.php');
    global $query,$pa,$opt,$ms_db,$num,$fetch ;
    $sql = "SELECT * FROM $tableName Where $columnName ='$columnValue'";
    $result=query($query,$sql,$pa,$opt,$ms_db);
    $nu = $num($result);
    if($nu>=1){
        if(!$result) {
            die();
        }else{
            $row = $fetch($result);
            return $row;
        }
    }
}

function HRDMasterList($id = false) {
    //@include ('../../../db_conn.php');
    //@include ('../../../configdata.php');
    global $query,$pa,$opt,$ms_db,$num,$fetch ;

    $list = '<option value="">Please, select employee</option>';
    $sql = "SELECT * FROM HrdMastQry";
    $resultq=@query($query,$sql,$pa,$opt,$ms_db);
    $columnfield = array();
    if ($num($resultq) > 0) {
        while ($row = $fetch($resultq)) {
            if ($row['Emp_Code'] == $id) {
                $select = "selected";
            } else {
                $select = "";
            }
            $list.='<option value="' . $row['Emp_Code'] . '" '.$select.'>' . $row['EMP_NAME'] . ' ' . $row['Emp_MName'] . ' ' . $row['Emp_LName'] . '</option>';
        }
    }

    return $list;
}

function functionList($id = false) {
    //include '../db_conn.php';
    //include '../configdata.php';
    global $query,$pa,$opt,$ms_db,$num,$fetch ;
    $list = '<option value="0">Please, select function name</option>';
    $sql = "SELECT * FROM FUNCTMast where status ='1'";
    $resultq=query($query,$sql,$pa,$opt,$ms_db);
    $columnfield = array();
    if ($num($resultq) > 0) {
        while ($row = $fetch($resultq)){
            if($row['FunctID'] == $id) {
                $select = "selected";
            }else{
                $select = "";
            }
            $list.='<option value="' . $row['FunctID'] . '" '.$select.'>' . $row['FUNCT_NAME'] . '</option>';
        }
    }

    return $list;
}


function bussList($id = false) {
    //include '../db_conn.php';
    //include '../configdata.php';
    global $query,$pa,$opt,$ms_db,$num,$fetch ;
    $list = '<option value="0">Select Bussiness Unit name</option>';
    $sql = "SELECT * FROM BussMast where status ='1'";
    $resultq=query($query,$sql,$pa,$opt,$ms_db);
    $columnfield = array();
    if ($num($resultq) > 0) {
        while ($row = $fetch($resultq)){
            if($row['BUSSID'] == $id) {
                $select = "selected";
            }else{
                $select = "";
            }
            $list.='<option value="' . $row['BUSSID'] . '" '.$select.'>' . $row['BussName'] . '</option>';
        }
    }

    return $list;
}
//Get Country Name
function CountryName($CountryID){

    //include '../db_conn.php';
    //include '../configdata.php';
    global $query,$pa,$opt,$ms_db,$num,$fetch ;
    $sqlq = "SELECT Country_NAME FROM CountryMast where CountryID ='$CountryID'";
    $resultq=query($query,$sqlq,$pa,$opt,$ms_db);
    $columnfield = array();
    $list='';
    if (@$num($resultq) >0){
          $row = $fetch( $resultq);
          $list=$row['Country_NAME'];
    }
    return $list;
}
//Get Status List

?>
 

                            