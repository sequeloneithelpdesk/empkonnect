<?php
//$leave_count=getCL_SL('EL',90);
//echo $leave_count;
function getCL_SL($type,$entitle,$opening,$avail,$accumulate,$l,$j,$c){

    $leave_type=$type;
    $entitlement=$entitle;
    $avail=$avail;
    $total_carry=$opening;
    $total__month=12;
    $carry_leave=$accumulate;
    $confirm=false;

    if($total_carry<=$carry_leave){
        $add_leave= $total_carry ;
    }
    else{
        $add_leave=$carry_leave;
    } 
    $m_status='Married';
    $DOJ= $j; // get DOJ in this parameter
    $DOC = $c; // get DOC in this parameter
    //if($m_status='Married'){
    //$DOA = '2012-08-01'; // get DOC in this parameter    
    //}
    //else{
    //$DOA = '1986-06-01'; // get DOC in this parameter    
    //}
    $DOA = $l; // get DOC in this parameter
    
    
    $yourjoin_date = strtotime($DOJ);
    

    //start date
	if($l=='' &&$j=='' && $c==''){
	return $SL=0;

	}
	else{
		
    $jdate = explode('-',$DOJ);
	//print_r($jdate);
    $joinyear = $jdate[0];
    $joinmonth = $jdate[1];
    $joindate = $jdate[2];

    $ljoin_Date=$joinyear."-12-31" ;
    $lastDate = strtotime($ljoin_Date);

    //confirm date
	if($DOC==''){
		
		$DOC=$DOJ;
		}
		else{
		$DOC=$c;
		}
		$yourconf_date = strtotime($DOC);
    $confirm_date  = explode('-',$DOC);
    $confirm_year  = $confirm_date[0];

    $lastconfirm_Date=$confirm_year."-12-31" ;
    $last_con_Date = strtotime($lastconfirm_Date);

    
    $curryear = date('Y');
	$currmonth = date('m');
    $sjoin_Date=$curryear."-01-01";
    $startDate = strtotime($sjoin_Date);

    $current_date = date('Y-m-d');
    $current_lastdate=$curryear."-12-31";
    $current_lastdate=strtotime($current_lastdate);
    $current_date = strtotime($current_date);

    //Ann date
	if($DOA==''){
		
		$A_Date=0;
		}
		else{
    $Ann_date  = explode('-',$DOA);
    
    $Anndate_Date=$curryear."-".$Ann_date[1]."-".$Ann_date[2] ;
    $A_Date = strtotime($Anndate_Date);
		}
    
    $total_days = cal_days_in_month(CAL_GREGORIAN,$joinmonth,$joinyear);
    $date_valid = ($total_days- $joindate)+1 ;

    //echo $total_days;
    if($leave_type=='EL'){

         $diff = abs($current_date - $yourjoin_date);

        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

        if($years >= 10 && $entitlement!=0){
            $entitlement=$entitlement+3 ;
        }


        if($joinyear==$curryear && $current_date < $yourconf_date){

            $SL=0;
        }
        elseif($joinyear < $curryear && $confirm_year==$curryear && ($current_date >= $yourconf_date || $current_date < $yourconf_date)){
            $SL = ((($entitlement/$total__month)/$total_days)*$date_valid) + (($entitlement/$total__month)*($total__month-($joinmonth)))-$avail;

        }
        elseif($joinyear == ($curryear-1) && $confirm_year ==  ($curryear-1)) {
            $SL = ((($entitlement/$total__month)/$total_days)*$date_valid) + (($entitlement/$total__month)*($total__month-($joinmonth)))-$avail ;
        }
        else{
            $SL= $entitlement+$add_leave-$avail ;
        }

    //     if($current_lastdate < $current_date){
    //         if($confirm_year>=$curryear){

    //     if($joinyear==$confirm_year && $current_date >= $yourconf_date && $confirm_year==$curryear && $joinyear==$curryear){
    //           //  echo"add3";
    //             $SL = ((($entitlement/$total__month)/$total_days)*$date_valid) + (($entitlement/$total__month)*($total__month-($joinmonth)))-$avail;
           
    //     }
    //     elseif($joinyear<$confirm_year && $current_date >= $yourconf_date && $confirm_year==$curryear && $joinyear==$curryear-1){
    //         //echo"add2";
    //          $preSL= ((($entitlement/$total__month)/$total_days)*$date_valid) + (($entitlement/$total__month)*($total__month-($joinmonth)));
    //         //$postSL=$entitlement;

    //         $SL=$preSL+$postSL-$avail;
            
            
    //     }
    //     else{
    //             //echo"add3";
    //             $SL=0;
    //         }

    // }
    //     elseif($confirm_year<$curryear){
    //          //echo"add4";
    //         $SL= $entitlement+$add_leave-$avail ;

    //     }
    // }
    //      else{
    //         $SL= $add_leave-$avail ;
    //      }   
        


        
        

    }
    elseif($leave_type=='CL'||$leave_type=='SL'){
    if($yourjoin_date<=$lastDate && $joinyear==$curryear){
        //echo"1";
    $SL = ((($entitlement/$total__month)/$total_days)*$date_valid) + (($entitlement/$total__month)*($total__month-($joinmonth)))-$avail ;

    }
    elseif($lastDate < $startDate){ 
        //echo"2";
        $SL= $entitlement+ $add_leave-$avail ;
      
    
    }
   }

    elseif($leave_type=='SEL'){

        if($current_date >= $yourconf_date){
            $SL=$entitlement-$avail;
        }
    }
    elseif($leave_type=='BTL'){
       
		   if($A_Date >= $current_date ){
            $SL=$entitlement;
        }
        elseif($A_Date < $current_date){
            $SL=0;

        }

        
    }
	elseif($leave_type=='AL'){

            $prorata=$entitlement/$total__month;
			//$a=((($entitlement/$total__month)/$total_days)*$date_valid);
			//echo $b=($entitlement/$total__month)*(($currmonth-$joinmonth)+1);
			//echo"prorata--";echo $a.",".$b.",". $c=$a+$b; echo"<br>";
			//echo"avail--";echo $joinmonth.",".$currmonth;echo"<br>";

        if($joinyear==$curryear ){
                //echo"add3";
				//echo $avail;
            //$joinmonth, $currmonth ;
            $SL = ((($entitlement/$total__month)/$total_days)*$date_valid) + ($entitlement/$total__month)*(($currmonth-$joinmonth)) -$avail;
           
        }
        else{

            $SL=  (($entitlement/$total__month) * $currmonth) +$add_leave - $avail ;
        }
        
       
    }
   

    elseif($leave_type=='SPL'){
        if($current_date >= $yourconf_date){
            $SL=$entitlement-$avail;
        }
        
    }
    elseif($leave_type=='OL'){
        $SL=$entitlement;

    }
    else{
        //echo"hihi";
        $SL=0;
    }

     return floorToFraction($SL,4) ;
	}
}



//echo $nod;
//echo 7/$nod;
function floorToFraction($number, $denominator)
{

    $x = $number * $denominator;
    $x = round($x) ;
    $x = $x / $denominator;
    return $x;

}

$type='';
if($type == ''){

    $code='10111';
    $EL;
    $CL='7';
    $SL='7';
    $SPL='1';
    $sql_i="select * from  HrdMastQry where Emp_Code='$code'";
    $res_i=query($query,$sql_i,$pa,$opt,$ms_db);
    $data=$fetch($res_i);
    $DOJ =$data['DOJ'];
    $DOC =$data['DOC'];
    
}
