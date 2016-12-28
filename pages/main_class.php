<?php
//include ('configdata.php');
//include ('../../define_email_data.php');
//$define_email_data_obj=new define_email_data();

class main_class{
    function __construct(){
      
    }
 
    

   function getemployee_name_main($code){

      
       global $HTTP_HOST;
        global $query;
        global $sql;
        global $pa;
        global $opt;
        global $ms_db;
        global $fetch;

        $sql="select Emp_FName,Emp_LName from hrdmastqry WHERE Emp_Code='$code'";
        $result=query($query,$sql,$pa,$opt,$ms_db);
          $row=$fetch($result);
        $emp_name=$row['Emp_FName']." ".$row['Emp_LName'];
       // echo $emp_name;
        return $emp_name;
    }
    function getemployee_email_main($code){

      
       global $HTTP_HOST;
        global $query;
        global $sql;
        global $pa;
        global $opt;
        global $ms_db;
        global $fetch;

        $sql="Select OEMailID,EMP_NAME from HrdMastQry where Emp_Code='".$code."'";
        $result=query($query,$sql,$pa,$opt,$ms_db);
          $row=$fetch($result);
        $emp_email=$row['OEMailID'];
       // echo $emp_name;
        return $emp_email;
    }
     
      function getemployee_leave_type_main($type)
      {
          global $HTTP_HOST;
        global $query;
        global $sql;
        global $pa;
        global $opt;
        global $ms_db;
        global $fetch;
          $sql="Select LOV_Text from lovmast where LOV_Field='Leave' and LOV_Value='".$type."'";
         // echo $sql;
        $result=query($query,$sql,$pa,$opt,$ms_db);
          $row=$fetch($result);
        $keyval=$row['LOV_Text'];
        return $keyval;
    }
    /* pramod */
    function getEmployeeShiftByDate($empCode, $date){
        $date = trim($date);
        if(empty($empCode) || empty($date)) return '';

        global $HTTP_HOST;
        global $query;
        global $sql;
        global $pa;
        global $opt;
        global $ms_db;
        global $fetch;
        $explodeDate = explode('/', $date);
        $convertDate = $explodeDate[1].'/'.$explodeDate[0].'/'.$explodeDate[2];
        $SqlQuery = "SELECT EMP_CODE, convert(varchar(10),RosterStart,103) as RosterStart,convert(varchar(10),RosterEnd,111) as RosterEnd,
        ShiftMast.Shift_From,ShiftMast.Shift_To,ShiftMast.Shift_Code,ShiftMast.Shift_Name
        FROM rosterQry 
        INNER JOIN ShiftMast ON rosterQry.SHIFTMASTER = ShiftMast.ShiftMastId
        WHERE RosterEnd >= '".$convertDate."' AND RosterStart <= '".$convertDate."' AND EMP_CODE = '".$empCode."'";
        $result=query($query, $SqlQuery, $pa, $opt, $ms_db);
        $row = $fetch($result);

        return array('Shift_From'=>(isset($row['Shift_From']))?$row['Shift_Name'].' ('.timeFormat($row['Shift_From']):'N/A','Shift_To'=>(isset($row['Shift_To']))?timeFormat($row['Shift_To']).')':'N/A');
    }

   function getemployee_category_main($code){

      
       global $HTTP_HOST;
        global $query;
        global $sql;
        global $pa;
        global $opt;
        global $ms_db;
        global $fetch;

        $sql="SELECT GRD_NAME FROM hrdmastqry WHERE Emp_Code='$code'";
        $result=query($query,$sql,$pa,$opt,$ms_db);
        $row=$fetch($result);
        $GRD_NAME=$row['GRD_NAME'];
        return $GRD_NAME;
    }

}

/*$var=array(

          "0"=> array(
                        "109100a"=>array(
                        "id"=>"10910",
                        "email"=>"himanshu@sequelone.com",
                        "subject"=>"",
                        "massege"=>""
                          ),
                        "109100b"=>array(
                        "id"=>"10910",
                        "email"=>"himanshu@sequelone.com",
                        "subject"=>"",
                        "massege"=>""
                          )
            ),
          "1"=> array(
                        "109100a"=>array(
                        "id"=>"10910",
                        "email"=>"himanshu@sequelone.com",
                        "subject"=>"",
                        "massege"=>""
                          ),
                        "109100b"=>array(
                        "id"=>"10910",
                        "email"=>"himanshu@sequelone.com",
                        "subject"=>"",
                        "massege"=>""
                          )
            )
  )*/
