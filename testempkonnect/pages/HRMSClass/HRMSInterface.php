<?php
Interface HRMSInterface{
    //Constructor used for making connection as required.
    public function __construct();
    //get connection for making connection as required.
    public function getConnection();
    //Get data from passing table, column and column value.
    public function GetData($tableName,$columnName,$columnValue);
    //Get list of time zone
    public function tz_list();
    //Get list of currency with country.
    public function CurrencyList();
    //Get list of Country.
    public function CountryList();
    //Get name of country
    public function CountryName($countryId);
    //Get Status List    
    public function StatusList($country);
    //Get Function list
    public function functionList();
    //Get employee list from HRDMaster
    public function HRDMasterList();
}
?>
 

                            