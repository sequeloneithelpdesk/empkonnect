<?php
//include ('../../configdata.php');
//include ('../../define_email_data.php');
//$define_email_data_obj=new define_email_data();

class attendance_class{
    function __construct(){
      
    }
    function getMyMarkPastRequestData($code){

      
       global $HTTP_HOST;
        global $query;
        global $sql;
        global $pa;
        global $opt;
        global $ms_db;
        global $fetch;

        $sql="select AttnKey from markPastAttendance WHERE CreatedBy='$code' group by AttnKey";
      // echo $sql;
        $res=query($query,$sql,$pa,$opt,$ms_db);
      // $Levkey_array=array();
        $count=0;
       while ($rows = $fetch($res)){
       $AttnKey_val=$rows['AttnKey'];
      // echo $Levkey_val."aaa";
          $sql1="select TOP 1 markPastId,CONVERT(VARCHAR(12),cast(date_from as date), 101) as date_from,CONVERT(VARCHAR(12),cast(date_to as date), 101) as date_to,CONVERT (VARCHAR(27),CreatedOn,109 ) as CreatedOn,approvedBy,notMarkingReason,action_status,AttnKey from markPastAttendance WHERE AttnKey='$AttnKey_val' order by markPastId DESC ";
           $res1=query($query,$sql1,$pa,$opt,$ms_db);
      // $Levkey_array=array();
          while ($rows1 = $fetch($res1)){
             //echo $rows1['markPastId'];
            $markPastId[$count]=$rows1['markPastId'];
            $date_from[$count]=$rows1['date_from'];
            $date_to[$count]=$rows1['date_to'];
            $CreatedOn[$count]=$rows1['CreatedOn'];
            $approvedBy[$count]=$rows1['approvedBy'];
            $notMarkingReason[$count]=$rows1['notMarkingReason'];
            $action_status[$count]=$rows1['action_status'];
            $AttnKey[$count]=$rows1['AttnKey'];
            $count++;
          }
       }  
      
      return array($markPastId,$date_from,$date_to,$CreatedOn,$approvedBy,$notMarkingReason,$action_status,$AttnKey,$count);
      //return $sql;
    }

    function getMyODRequestData($code){

      
       global $HTTP_HOST;
        global $query;
        global $sql;
        global $pa;
        global $opt;
        global $ms_db;
        global $fetch;

        $sql="select oDKey from outOnWorkRequest WHERE CreatedBy='$code' group by oDKey";
      // echo $sql;
        $res=query($query,$sql,$pa,$opt,$ms_db);
      // $Levkey_array=array();
        $count=0;
       while ($rows = $fetch($res)){
       $oDKey=$rows['oDKey'];
      // echo $Levkey_val."aaa";
          $sql1="select TOP 1 outWorkId,CONVERT(VARCHAR(12),cast(date_from as date), 101) as date_from,CONVERT(VARCHAR(12),cast(date_to as date), 101) as date_to,CONVERT (VARCHAR(27),CreatedOn,109 ) as CreatedOn,approvedBy,natureOfWork,action_status,oDKey from outOnWorkRequest WHERE oDKey='$oDKey' order by outWorkId DESC ";
         // echo $sql1;
           $res1=query($query,$sql1,$pa,$opt,$ms_db);
      // $Levkey_array=array();
          while ($rows1 = $fetch($res1)){
             //echo $rows1['markPastId'];
            $outWorkId[$count]=$rows1['outWorkId'];
            $date_from[$count]=$rows1['date_from'];
            $date_to[$count]=$rows1['date_to'];
            $CreatedOn[$count]=$rows1['CreatedOn'];
            $approvedBy[$count]=$rows1['approvedBy'];
            $natureOfWork[$count]=$rows1['natureOfWork'];
            $action_status[$count]=$rows1['action_status'];
            $oDKey1[$count]=$rows1['oDKey'];
            $count++;
          }
       }  
      
      return array($outWorkId,$date_from,$date_to,$CreatedOn,$approvedBy,$natureOfWork,$action_status,$oDKey1,$count);
      //return $sql;
    }

}

