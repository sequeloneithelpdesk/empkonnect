<?php
include_once 'HRMSInterface.php';
include "../db_conn.php";
include "../configdata.php";
class HRMSClass implements HRMSInterface{
    var $con;
    var $query1;
    var $fetch;
    var $num;
    var $pa;
    var $opt;
	var $ms_db;
    public function __construct() {
        @session_start();
        global $conn;
        $this->con=$conn;
        $this->error=$_SESSION['phpsql_error'];
        $this->query1=$_SESSION['phpsql_query'];
        $this->fetch=$_SESSION['phpsql_fetch'];
        $this->num=$_SESSION['phpsql_num'];
        $this->pa=$_SESSION['phpsql_pa'];
        $this->opt=$_SESSION['phpsql_opt'];
        $this->ms_db=$_SESSION['phpsql_db'];
    }
    public function getConnection($type = false) {
        if($type == false) {
            return $conn;
        }else{
            return $this->pdocon;
        }
    }
    //Get single record from table
    public function query($query,$q,$p,$op,$db){
		global $conn;
        if( $p==''||$op==''){
            $result= $query($q);
        }else{
            $result = $query($conn, $q, $p, $op);
        }
        return $result;
    }
    //Get single record from table
    public function GetData($tableName, $columnName, $columnValue) {
        $sql = "SELECT * FROM $tableName Where $columnName ='$columnValue'";
        $result=$this->query($_SESSION['phpsql_query'],$sql,$_SESSION['phpsql_pa'],$_SESSION['phpsql_opt'],$_SESSION['phpsql_db']);
        $nu = $_SESSION['phpsql_num']($result);
        if($nu>=1){
            if($result===false) {
                die();
            }else{
                $row = $_SESSION['phpsql_fetch']($result);
                return $row;
            }
        }
    }
    public function tz_list() {
        $zones_array = array();
        $timestamp = time();
        foreach (timezone_identifiers_list() as $key => $zone) {
            date_default_timezone_set($zone);
            $zones_array[$key]['zone'] = $zone;
            $zones_array[$key]['diff_from_GMT'] = 'UTC/GMT ' . date('P', $timestamp);
        }
        return $zones_array;
    }
    public function CurrencyList() {
        $currencyList = array(
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
    public function CountryList($id = false) {
        $list = '<select name="countryId" class="bs-select form-control usercodes bs-searchbox"><option value="0">Please, select country</option>';
        $sql = "SELECT * FROM CountryMast";
        $resultq=$this->query($this->query,$sql,$this->pa,$this->opt,$this->ms_db);
        $columnfield = array();
        if ($this->num.($resultq) > 0) {
            while ($row = $this->fetch.($resultq)) {
                if ($row['CountryID'] == $id) {
                    $select = "selected";
                }else{
                    $select = "";
                }
                $list.='<option value="' . $row['CountryID'] . '" $select>' . $row['Country_NAME'] . '</option>';
            }
        }
        $list.='</select>';
        return $list;
    }
    public function CountryName($CountryID) {
        $sql = "SELECT Country_NAME FROM CountryMast where CountryID ='$CountryID'";
        $resultq=$this->query($this->query,$sql,$this->pa,$this->opt,$this->ms_db);
        $columnfield = array();
        $list = '';
        if ($this->num.($resultq) > 0) {
            $row = $this->fetch.($resultq);
            $list = $row['Country_NAME'];
        }
        return $list;
    }
    public function StatusList($id = false) {
        $list = '<select name="status" class="bs-select form-control usercodes bs-searchbox"><option value="0">Please, select status</option>';
        $select1 = $select2 = $select3 = "";
        if ($id == 1) {
            $select1 = 'selected';
        } else if ($id == 0) {
            $select2 = '<option value="0" selected>In-Active</option>';
        } else {
            $select3 = "";
        }
        $list.='<option value="1" $select1>Active</option><option value="0" $select2>In-Active</option>';
        $list.='</select>';
        return $list;
    }
    public function functionList($id = false) {
        $list = '<select name="mainfunctionlist" class="bs-select form-control usercodes bs-searchbox"><option value="0">Please, select function name</option>';
        $sql = "SELECT * FROM FUNCTMast where status ='1'";
        $resultq=$this->query($this->query,$sql,$this->pa,$this->opt,$this->ms_db);
        $columnfield = array();
        if ($this->num.($resultq) > 0) {
            while ($row = $this->fetch.($resultq)){
                if($row['FunctID'] == $id) {
                    $select = "selected";
                }else{
                    $select = "";
                }
                $list.='<option value="' . $row['FunctID'] . '" $select>' . $row['FUNCT_NAME'] . '</option>';
            }
        }
        $list.='</select>';
        return $list;
    }
    public function HRDMasterList($id = false) {
        $list = '<select name="emplyeemaster" class="bs-select form-control usercodes bs-searchbox"><option value="0">Please, select employee</option>';
        $sql = "SELECT * FROM HrdMastQry";
        $resultq=$this->query($this->query,$sql,$this->pa,$this->opt,$this->ms_db);
        $columnfield = array();
        if ($this->num.($resultq) > 0) {
            while ($row = $this->fetch.($resultq)) {
                if ($row['Emp_Code'] == $id) {
                    $select = "selected";
                } else {
                    $select = "";
                }
                $list.='<option value="' . $row['Emp_Code'] . '" $select>' . $row['EMP_NAME'] . ' ' . $row['Emp_MName'] . ' ' . $row['Emp_LName'] . '</option>';
            }
        }
        $list.='</select>';
        return $list;
    }
}
?>
