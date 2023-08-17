<?php 

function DateThai($strDate)
{
	if($strDate=='0000-00-00')
	{
		return '';
	}
	$d=explode("-",$strDate);	
     $strYear = $d[0]+543;
     $strMonth= $d[1];
     $strDay= $d[2];

     $strMonthCut = Array("","มกราคม.","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
    $strMonthThai=$strMonthCut[intval($strMonth)];
     return "$strDay $strMonthThai $strYear";
}

?>