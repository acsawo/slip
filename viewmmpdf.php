<?php 
define('FPDF_FONTPATH','fpdf17/font/');


require('fpdf17/fpdf.php');




require_once('connectdb2pdf.php');


include("connectdb.php");
include("function.php");



$vrec = $_GET['vrec'];




function num2thai($number)
{


$t1 = array("ÈÙ¹Âì", "Ë¹Öè§", "ÊÍ§", "ÊÒÁ", "ÊÕè", "ËéÒ", "Ë¡", "à¨ç´", "á»´", "à¡éÒ");


$t2 = array("àÍç´", "ÂÕè", "ÊÔº", "ÃéÍÂ", "¾Ñ¹", "ËÁ×è¹", "áÊ¹", "ÅéÒ¹");


$zerobahtshow = 0; // ã¹¡Ã³Õ·ÕèÁÕáµè¨Ó¹Ç¹ÊµÒ§¤ì àªè¹ 0.25 ËÃ×Í .75 ¨ĞãËéáÊ´§¤ÓÇèÒ ÈÙ¹ÂìºÒ· ËÃ×ÍäÁè 0 = äÁèáÊ´§, 1 = áÊ´§

(string) 
$number;


$number = explode(".", $number);


if(!empty($number[1]))
{


if(strlen($number[1]) == 1)
{


$number[1] .= "0";


}else if(strlen($number[1]) > 2)
{


if($number[1]{2} < 5)
{


$number[1] = substr($number[1], 0, 2);


}else{


$number[1] = $number[1]{0}.($number[1]{1}+1);


}


}


}




for($i=0; $i<count($number); $i++)
{


$countnum[$i] = strlen($number[$i]);


if($countnum[$i] <= 7)
{


$var[$i][] = $number[$i];


}else{


$loopround = ceil($countnum[$i]/6);


for($j=1; $j<=$loopround; $j++)
{


if($j == 1)
{


$slen = 0;


$elen = $countnum[$i]-(($loopround-1)*6);


}else{


$slen = $countnum[$i]-((($loopround+1)-$j)*6);

$elen = 6;


}


$var[$i][] = substr($number[$i], $slen, $elen);


}


} 




$nstring[$i] = "";


for($k=0; $k<count($var[$i]); $k++)
{


if($k > 0)
$nstring[$i] .= $t2[7];


$val = $var[$i][$k];


$tnstring = "";


$countval = strlen($val);


for($l=7; $l>=2; $l--)
{


if($countval >= $l)
{


$v = substr($val, -$l, 1);


if($v > 0)
{


if($l == 2 && $v == 1)
{


$tnstring .= $t2[($l)];


}elseif($l == 2 && $v == 2)
{


$tnstring .= $t2[1].$t2[($l)];


}else{


$tnstring .= $t1[$v].$t2[($l)];


}


}


}


}


if($countval >= 1)
{


$v = substr($val, -1, 1);


if($v > 0)
{


if($v == 1 && $countval > 1 && substr($val, -2, 1) > 0)
{


$tnstring .= $t2[0];


}else{


$tnstring .= $t1[$v];


}




}


}




$nstring[$i] .= $tnstring;
}




}


$rstring = "";


if(!empty($nstring[0]) || $zerobahtshow == 1 || empty($nstring[1]))
{


if($nstring[0] == "") 
$nstring[0] = $t1[0];


$rstring .= $nstring[0]."ºÒ·";


}


if(count($number) == 1 || empty($nstring[1]))
{


$rstring .= "¶éÇ¹";


}else{


$rstring .= $nstring[1]."ÊµÒ§¤ì";


}


return $rstring;


}




$pdf=new FPDF();


$pdf->Open();


$pdf->AddFont('thsarabun','','THSarabun.php');


$pdf->AddFont('thsarabun','B','THSarabunB.php');


$pdf->AddFont('thsarabun','I','THSarabunI.php');


$pdf->AddFont('thsarabun','BI','THSarabunBI.php');


$pdf->AddPage();



mysqli_select_db( $connect,$dtbase);


$rtdt="SELECT tbdetail.nauto, tbdetail.nno, tbdetail.idno, tbmain.prename,tbmain.nname,tbmain.lname, tbmain.nposit, tboffice.noffice, tbdetail.money1, tbdetail.money2, tbdetail.money3, tbdetail.exp1, tbdetail.exp5, tbdetail.exp6, tbdetail.exp7, tbdetail.exp4, tbdetail.exp3, tbdetail.exp2, tbdetail.exp8, tbdetail.money4, tbdetail.money4txt, tbdetail.money5, tbdetail.money5txt, tbdetail.money6, tbdetail.money6txt, tbdetail.money7, tbdetail.money8, tbdetail.money9, tbdetail.money10, tbdetail.money10txt, tbdetail.exp9, tbdetail.exp9txt, tbdetail.daypay, tbdetail.mm, tbmonth.nmonth, tbdetail.yy, tbdetail.remarks, tbmain.nobank, tbbank.namebank, tbbank.sakhabank

 FROM (((tbmain LEFT JOIN tbdetail ON tbmain.idno = tbdetail.idno) LEFT JOIN tbbank ON tbmain.cbank = tbbank.cbank) LEFT JOIN tboffice ON tbmain.noffice = tboffice.coff) LEFT JOIN tbmonth ON tbdetail.mm = tbmonth.mm

WHERE ((tbdetail.nauto)=$vrec)

ORDER BY tbdetail.mm DESC;";


$rsdt=mysqli_query($connect,$rtdt ) or die(mysql_error());


$rs=mysqli_fetch_assoc($rsdt);


$rows=mysqli_num_rows($rsdt);


$sumget=$rs['money1']+$rs['money2']+$rs['money3']+$rs['money4']+$rs['money5']+$rs['money6']+$rs['money7']+$rs['money8']+$rs['money9']+$rs['money10'];

$sumpay=$rs['exp1']+$rs['exp2']+$rs['exp3']+$rs['exp4']+$rs['exp5']+$rs['exp6']+$rs['exp7']+$rs['exp8']+$rs['exp9'];


$sumnet=$sumget-$sumpay;




$pdf->SetMargins(30,10,10);


$pdf->Rect(10, 10, 190, 275 , 'D');


$pdf->Image('images/logo MOPH.png',12,12,25,25);


$pdf->SetFont('thsarabun','B',22); 


$pdf->setXY(40,15);


$pdf->MultiCell(100 ,10 , 'ãºáÊ´§ÃÒÂ¡ÒÃâÍ¹à§Ô¹à¢éÒºÑ­ªÕà§Ô¹à´×Í¹', 0);


$pdf->SetFont('thsarabun','B',20); 


$pdf->setXY(40,25);


$pdf->MultiCell(100 ,10 , ' ¡ÃÁ¡ÒÃá¾·Âì', 0);



//´éÒ¹«éÒÂ


$pdf->SetFont('thsarabun','',15); 


$pdf->setXY(15,40);


$pdf->MultiCell(95 , 10 , 'âÍ¹à§Ô¹à¢éÒÇÑ¹·Õè : '. iconv('UTF-8','cp874',DateThai($rs['daypay'])));


$pdf->setXY(15,47);


$pdf->MultiCell(95 , 10 , 'ª×èÍ-Ê¡ØÅ : '. iconv('UTF-8','cp874',$rs['prename'].$rs['nname']." ".$rs['lname']));


$pdf->setXY(15,54);


$pdf->MultiCell(95 , 10 , 'Ë¹èÇÂ§Ò¹ : '. iconv('UTF-8','cp874',$rs['noffice']));



$pdf->SetFont('thsarabun','B',15); 


$pdf->SetFillColor(248,242,151);


$pdf->setXY(16,65);


$pdf->Cell(90 , 5 , 'ÃÒÂ¡ÒÃÃÑº', 0 , 0 , 'C',  true);


$pdf->SetFont('thsarabun','',15); 


$pdf->setXY(15,70);


$pdf->MultiCell(90, 10 , '1. à§Ô¹à´×Í¹/¤èÒ¨éÒ§/¤èÒµÍºá·¹');


$pdf->setXY(75,70);


$pdf->MultiCell(30, 10 , number_format($rs['money1'],2) . ' ºÒ·' , 0 , 'R');


$pdf->setXY(15,77);


$pdf->MultiCell(90, 10 , '2. à§Ô¹»ÃĞ¨ÓµÓáË¹è§/à§Ô¹µÍºá·¹ÃÒÂà´×Í¹');


$pdf->setXY(75,77);


$pdf->MultiCell(30, 10 , number_format($rs['money2'],2) . ' ºÒ·' , 0 , 'R');


$pdf->setXY(15,84);


$pdf->MultiCell(90, 10 , '3. à§Ô¹à¾ÔèÁ¤èÒ¤ÃÍ§ªÕ¾Ï');


$pdf->setXY(75,84);


$pdf->MultiCell(30, 10 , number_format($rs['money3'],2) . ' ºÒ·' , 0 , 'R');

$pdf->setXY(15,91);


$pdf->MultiCell(90, 10 , '4. à§Ô¹à´×Í¹/¤èÒ¨éÒ§/¤èÒµÍºá·¹ µ¡àºÔ¡ ' );


$pdf->setXY(75,91);


$pdf->MultiCell(30, 10 , number_format($rs['money4'],2) . ' ºÒ·' , 0 , 'R');

if ($rs['remarks'] == "1") 
{
$pdf->setXY(19,98);

$pdf->SetFont('thsarabun','',15); 

$pdf->MultiCell(90, 10 , '(ÃĞºØ : ** )');

$pdf->setXY(19,190);


$pdf->SetFont('thsarabun','',15); 


$pdf->MultiCell(80, 6 , '** '. iconv('UTF-8','cp874',$rs['money4txt']) );
}elseif ($rs['remarks'] == "5") {
$pdf->setXY(19,98);

$pdf->SetFont('thsarabun','',15); 

$pdf->MultiCell(90, 10 , '(ÃĞºØ : ** )');

$pdf->setXY(19,190);


$pdf->SetFont('thsarabun','',15); 


$pdf->MultiCell(80, 6 , '** '. iconv('UTF-8','cp874',$rs['money4txt']) );
$pdf->setXY(19,112);


$pdf->MultiCell(90, 10 , 'µ¡àºÔ¡ (ÃĞºØ : *** )');

$pdf->setXY(19,210);


$pdf->SetFont('thsarabun','',15); 


$pdf->MultiCell(80, 6 , '*** '. iconv('UTF-8','cp874',$rs['money5txt']) );
}else {
$pdf->setXY(19,98);

$pdf->SetFont('thsarabun','',15); 

$pdf->MultiCell(90, 10 , '(ÃĞºØ : '. iconv('UTF-8','cp874',$rs['money4txt']) . ' )');
}


$pdf->setXY(15,105);

$pdf->SetFont('thsarabun','',15); 

$pdf->MultiCell(90, 10 , '5. à§Ô¹»ÃĞ¨ÓµÓáË¹è§/à§Ô¹µÍºá·¹ÃÒÂà´×Í¹');


$pdf->setXY(75,105);


$pdf->MultiCell(30, 10 , number_format($rs['money5'],2) . ' ºÒ·' , 0 , 'R');




if ($rs['remarks'] == "2") 
{
$pdf->setXY(19,112);


$pdf->MultiCell(90, 10 , 'µ¡àºÔ¡ (ÃĞºØ : ** )');

$pdf->setXY(19,190);


$pdf->SetFont('thsarabun','',15); 


$pdf->MultiCell(80, 6 , '** '. iconv('UTF-8','cp874',$rs['money5txt']) );
}elseif ($rs['remarks'] == "5") {
$pdf->setXY(19,98);

$pdf->SetFont('thsarabun','',15); 

$pdf->MultiCell(90, 10 , '(ÃĞºØ : ** )');

$pdf->setXY(19,190);


$pdf->SetFont('thsarabun','',15); 


$pdf->MultiCell(80, 6 , '** '. iconv('UTF-8','cp874',$rs['money4txt']) );
$pdf->setXY(19,112);


$pdf->MultiCell(90, 10 , 'µ¡àºÔ¡ (ÃĞºØ : *** )');

$pdf->setXY(19,210);


$pdf->SetFont('thsarabun','',15); 


$pdf->MultiCell(80, 6 , '*** '. iconv('UTF-8','cp874',$rs['money5txt']) );
}else{
$pdf->setXY(19,112);


$pdf->MultiCell(90, 10 , 'µ¡àºÔ¡ (ÃĞºØ : ' .  iconv('UTF-8','cp874',$rs['money5txt']) . ' )');
}


$pdf->setXY(15,119);


$pdf->MultiCell(90, 10 , '6. à§Ô¹à¾ÔèÁ¤èÒ¤ÃÍ§ªÕ¾Ï µ¡àºÔ¡');


$pdf->setXY(75,119);


$pdf->MultiCell(30, 10 , number_format($rs['money6'],2) . ' ºÒ·' , 0 , 'R');


$pdf->setXY(19,126);


$pdf->MultiCell(90, 10 , '(ÃĞºØ : ' .  iconv('UTF-8','cp874',$rs['money6txt']) . ' )');


$pdf->setXY(15,133);


$pdf->MultiCell(90, 10 , '7. à§Ô¹¤èÒµÍºá·¹¾ÔàÈÉ (¡Ã³Õà§Ô¹à´×Í¹àµçÁ¢Ñé¹)');


$pdf->setXY(75,133);


$pdf->MultiCell(30, 10 , number_format($rs['money7'],2) . ' ºÒ·' , 0 , 'R');


$pdf->setXY(15,140);


$pdf->MultiCell(90, 10 , '8. à§Ô¹ ¾µÊ.');


$pdf->setXY(75,140);


$pdf->MultiCell(30, 10 , number_format($rs['money8'],2) . ' ºÒ·' , 0 , 'R');


$pdf->setXY(15,147);


$pdf->MultiCell(90, 10 , '9. à§Ô¹µÍºá·¹¤èÒÃ¶»ÃĞ¨ÓµÓáË¹è§');


$pdf->setXY(75,147);


$pdf->MultiCell(30, 10 , number_format($rs['money9'],2) . ' ºÒ·' , 0 , 'R');


$pdf->setXY(15,154);


$pdf->MultiCell(90, 10 , '10. Í×è¹æ (ÃĞºØ :  ' . iconv('UTF-8','cp874',$rs['money10txt']) . ' )');


$pdf->setXY(75,154);


$pdf->MultiCell(30, 10 , number_format($rs['money10'],2) . ' ºÒ·' , 0 , 'R');


$pdf->SetFont('thsarabun','B',15); 


$pdf->setXY(15,161);


$pdf->MultiCell(90, 10 , 'ÃÇÁÃÑº·Ñé§ËÁ´', 0, 'C');


$pdf->setXY(75,161);


$pdf->MultiCell(30, 10 , number_format($sumget,2) . ' ºÒ·' , 0 , 'R');


$pdf->setXY(15,170);


$pdf->MultiCell(90, 10 , 'ÃÑºÊØ·¸Ô', 0, 'C');


$pdf->setXY(75,170);


$pdf->MultiCell(30, 10 , number_format($sumnet,2) . ' ºÒ·' , 0 , 'R');


$pdf->SetFont('thsarabun','',15); 


$pdf->setXY(15,177);


$pdf->MultiCell(90, 10 , '(' . num2thai($sumnet) . ')' , 0 , 'R');


//$pdf->setXY(15,190);


//$pdf->SetFont('thsarabun','',14); 


//$pdf->SetTextColor(255, 0, 0); 


//$pdf->MultiCell(90, 6 , 'ËÁÒÂàËµØ : àÍ¡ÊÒÃ©ºÑº¹Õéà»ç¹ "ÊÓà¹Ò" µéÍ§ãªé»ÃĞ¡Íº¡ÑºàÍ¡ÊÒÃ·Õè·Ò§ÃÒª¡ÒÃÍÍ¡ãËé ¾ÃéÍÁÃÑºÃÍ§ÊÓà¹Ò¶Ù¡µéÍ§·Ø¡¤ÃÑé§ ËÒ¡¾º¢éÍÊ§ÊÑÂâ»Ã´µÔ´µèÍ¡ÅØèÁ¤ÅÑ§áÅĞ¾ÑÊ´Ø â·Ã 0 2590 1283' , 1 , 'C');




//´éÒ¹¢ÇÒ


$pdf->SetFont('thsarabun','',15); 


$pdf->SetTextColor(0, 0, 0); 


$pdf->setXY(110,33);


$pdf->MultiCell(95 , 10 , '»ÃĞ¨Óà´×Í¹ : '. iconv('UTF-8','cp874',$rs['nmonth']) . ' ' . $rs['yy']);


$pdf->setXY(110,40);

$pdf->MultiCell(95 , 10 , 'ª×èÍ¸¹Ò¤ÒÃ : ' . iconv('UTF-8','cp874',$rs['namebank']));


$pdf->setXY(128,47);

$pdf->MultiCell(100 , 10 , iconv('UTF-8','cp874',$rs['sakhabank']));


$pdf->setXY(110,54);


$pdf->MultiCell(95 , 10 , 'àÅ¢·ÕèºÑ­ªÕ : '. $rs['nobank']);


$pdf->SetFont('thsarabun','B',15); 


$pdf->SetFillColor(248,242,151);


$pdf->setXY(110,65);


$pdf->Cell(85 , 5 , 'ÃÒÂ¡ÒÃËÑ¡', 0 , 0 , 'C', true);


$pdf->SetFont('thsarabun','',15); 


$pdf->setXY(110,70);


$pdf->MultiCell(90, 10 , '1. ÀÒÉÕà§Ô¹ä´é');


$pdf->setXY(165,70);


$pdf->MultiCell(30, 10 , number_format($rs['exp1'],2) . ' ºÒ·' , 0 , 'R');


$pdf->setXY(110,77);


$pdf->MultiCell(90, 10 , '2. ¡º¢./¡Ê¨./»ÃĞ¡Ñ¹ÊÑ§¤Á');


$pdf->setXY(165,77);


$pdf->MultiCell(30, 10 , number_format($rs['exp2'],2) . ' ºÒ·' , 0 , 'R');


$pdf->setXY(110,84);


$pdf->MultiCell(90, 10 , '3. ¬¡Ê.');

$pdf->setXY(165,84);


$pdf->MultiCell(30, 10 , number_format($rs['exp3'],2) . ' ºÒ·' , 0 , 'R');


$pdf->setXY(110,91);


$pdf->MultiCell(90, 10 , '4. ¸¹Ò¤ÒÃÍÒ¤ÒÃÊ§à¤ÃÒĞËì');


$pdf->setXY(165,91);


$pdf->MultiCell(30, 10 , number_format($rs['exp4'],2) . ' ºÒ·' , 0 , 'R');


$pdf->setXY(110,98);


$pdf->MultiCell(90, 10 , '5. ¸¹Ò¤ÒÃ¡ÃØ§ä·Â ¨Ó¡Ñ´');


$pdf->setXY(165,98);


$pdf->MultiCell(30, 10 , number_format($rs['exp5'],2) . ' ºÒ·' , 0 , 'R');


$pdf->setXY(110,105);


$pdf->MultiCell(90, 10 , '6. ¸¹Ò¤ÒÃÍÍÁÊÔ¹');


$pdf->setXY(165,105);


$pdf->MultiCell(30, 10 , number_format($rs['exp6'],2) . ' ºÒ·' , 0 , 'R');


$pdf->setXY(110,112);


$pdf->MultiCell(90, 10 , '7. ÊË¡Ã³ìÍÍÁ·ÃÑ¾Âì');


$pdf->setXY(165,112);


$pdf->MultiCell(30, 10 , number_format($rs['exp7'],2) . ' ºÒ·' , 0 , 'R');


$pdf->setXY(110,119);


$pdf->MultiCell(90, 10 , '8. Êè§¤×¹¤ÅÑ§');


$pdf->setXY(165,119);


$pdf->MultiCell(30, 10 , number_format($rs['exp8'],2) . ' ºÒ·' , 0 , 'R');


$pdf->setXY(110,126);


$pdf->MultiCell(90, 10 , '9. Í×è¹æ ');


$pdf->SetFont('thsarabun','',13); 


$pdf->setXY(114,134);

$pdf->MultiCell(80, 6 , '(ÃĞºØ :  ' . iconv('UTF-8','cp874',$rs['exp9txt']) . ' )');


$pdf->SetFont('thsarabun','',15); 


$pdf->setXY(165,126);


$pdf->MultiCell(30, 10 , number_format($rs['exp9'],2) . ' ºÒ·' , 0 , 'R');


$pdf->SetFont('thsarabun','B',15); 


$pdf->setXY(110,161);


$pdf->MultiCell(90, 10 , 'ÃÇÁËÑ¡·Ñé§ËÁ´', 0, 'C');


$pdf->setXY(165,161);


$pdf->MultiCell(30, 10 , number_format($sumpay,2) . ' ºÒ·' , 0 , 'R');


$pdf->Image('images/sign.png',147,180,15);


$pdf->SetFont('thsarabun','',15); 


$pdf->setXY(110,184);


$pdf->MultiCell(90, 10 ,'Å§ª×èÍ ............................................', 0, 'C');


$pdf->setXY(110,191);


$pdf->MultiCell(90, 10 , '(¹ÒÂÊÁ¤Ô´    »Ò¹·Í§)', 0, 'C');


$pdf->setXY(110,198);


$pdf->MultiCell(90, 10 , 'à¨éÒ¾¹Ñ¡§Ò¹¡ÒÃà§Ô¹áÅĞºÑ­ªÕÍÒÇØâÊ', 0, 'C');


$pdf->setXY(110,205);


$pdf->MultiCell(90, 10 , 'ËÑÇË¹éÒ½èÒÂ¡ÒÃà§Ô¹', 0, 'C');

$pdf->setXY(110,212);


$pdf->MultiCell(90, 10 , '¡Í§¤ÅÑ§ ¡ÃÁ¡ÒÃá¾·Âì', 0, 'C');


$pdf->setXY(110,229);


$pdf->SetFont('thsarabun','',14); 


$date_now= date("Y-m-d");



$pdf->MultiCell(90, 10 , 'ÇÑ¹·ÕèÍÍ¡Ë¹Ñ§Ê×ÍÃÑºÃÍ§ '.iconv('UTF-8','cp874',DateThai($date_now))  , 0, 'C');


$pdf->setXY(10,247);


$pdf->SetFont('thsarabun','',14); 


$pdf->SetTextColor(255, 0, 0); 


$pdf->MultiCell(190, 6 , ':: àÍ¡ÊÒÃ©ºÑº¹Õéà»ç¹ "ÊÓà¹Ò" µéÍ§ãªé»ÃĞ¡Íº¡ÑºàÍ¡ÊÒÃ·Õè·Ò§ÃÒª¡ÒÃÍÍ¡ãËéà·èÒ¹Ñé¹  ËÒ¡µéÍ§¡ÒÃ©ºÑº¨ÃÔ§ËÃ×Í¾º¢éÍÁÙÅäÁè¶Ù¡µéÍ§ ¡ÃØ³ÒµÔ´µèÍ§Ò¹à§Ô¹à´×Í¹áÅĞ¤èÒ¨éÒ§ ¡Í§¤ÅÑ§ ¡ÃÁ¡ÒÃá¾·Âì ÍÒ¤ÒÃ2 ªÑé¹ 2 â·Ã 02-5906280 ::' , 0 , 'C');


$pdf->Output();

?>