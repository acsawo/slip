<?php 
ob_start();
define('FPDF_FONTPATH','fpdf17/font/');


require('fpdf17/fpdf.php');
//require_once('connectdb2pdf.php');


include("connectdb.php");
include("function.php");



$vrec = $_GET['vrec'];




function num2thai($number)
{


$t1 = array("�ٹ��", "˹��", "�ͧ", "���", "���", "���", "ˡ", "��", "Ỵ", "���");


$t2 = array("���", "���", "�Ժ", "����", "�ѹ", "����", "�ʹ", "��ҹ");


$zerobahtshow = 0; // 㹡óշ������ӹǹʵҧ�� �� 0.25 ���� .75 ������ʴ������ �ٹ��ҷ ������� 0 = ����ʴ�, 1 = �ʴ�

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


$rstring .= $nstring[0]."�ҷ";


}


if(count($number) == 1 || empty($nstring[1]))
{


$rstring .= "��ǹ";


}else{


$rstring .= $nstring[1]."ʵҧ��";


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



//mysql_select_db($dtbase, $connectdb);


$rtdt="SELECT tbdetail.nauto, tbdetail.nno, tbdetail.yy, tbdetail.mm, tbdetail.idno,tbmain.prename ,tbmain.nname,tbmain.lname, tbmain.nposit, tbmain.nobank, tboffice.noffice, tbdetail.money1, tbdetail.money2, tbdetail.money3, tbdetail.money4, tbdetail.money5, tbdetail.money6, tbdetail.money7, tbdetail.money8, tbdetail.money9, tbdetail.money10,  tbdetail.sumget, tbdetail.exp1, tbdetail.exp2, tbdetail.exp3, tbdetail.exp4, tbdetail.exp5, tbdetail.exp6, tbdetail.exp7, tbdetail.exp8, tbdetail.exp9, tbdetail.exp10, tbdetail.sumpay, tbdetail.sumnet, tbdetail.money4txt, tbdetail.money5txt, tbdetail.money6txt, tbdetail.exp9txt, tbdetail.money10txt, tbdetail.daypay, tbdetail.remarks, tbbank.namebank, tbbank.sakhabank, tbmonth.nmonth

 FROM (((tbmain LEFT JOIN tbdetail ON tbmain.idno = tbdetail.idno) LEFT JOIN tbbank ON tbmain.cbank = tbbank.cbank) LEFT JOIN tboffice ON tbmain.noffice = tboffice.coff) LEFT JOIN tbmonth ON tbdetail.mm = tbmonth.mm

WHERE ((tbdetail.nauto)=$vrec)

ORDER BY tbdetail.mm DESC;";


$rsdt=mysqli_query($connect,$rtdt) ;


$rs=mysqli_fetch_assoc($rsdt);


$rows=mysqli_num_rows($rsdt);



$pdf->SetMargins(30,10,10);


$pdf->Rect(10, 10, 190, 275 , 'D');


$pdf->Image('images/logolerdsin.png',12,12,25,25);


$pdf->SetFont('thsarabun','B',22); 


$pdf->setXY(40,15);


$pdf->MultiCell(100 ,10 , '��Ѻ�ͧ��è����Թ��͹����Թ���', 0);


$pdf->SetFont('thsarabun','B',20); 


$pdf->setXY(40,25);


$pdf->MultiCell(100 ,10 , '������ᾷ��', 0);



//��ҹ����


$pdf->SetFont('thsarabun','',15); 


$pdf->setXY(15,40);


$pdf->MultiCell(95 , 10 , '�͹�Թ����ѹ��� : '. iconv('UTF-8','cp874',DateThai($rs['daypay'])));


$pdf->setXY(15,47);



$pdf->MultiCell(95 , 10 , '����-ʡ�� : '. iconv('UTF-8','cp874',$rs['prename'].$rs['nname']." ".$rs['lname']));

$pdf->setXY(15,54);


$pdf->MultiCell(95 , 10 , '˹��§ҹ : '. iconv('UTF-8','cp874',$rs['noffice']));



$pdf->SetFont('thsarabun','B',15); 


$pdf->SetFillColor(248,242,151);


$pdf->setXY(16,65);


$pdf->Cell(90 , 5 , '��¡���Ѻ', 0 , 0 , 'C',  true);


$pdf->SetFont('thsarabun','',15); 


$pdf->setXY(15,70);


$pdf->MultiCell(90, 10 , '1. �Թ��͹');


$pdf->setXY(75,70);


$pdf->MultiCell(30, 10 , number_format($rs['money1'],2) . ' �ҷ' , 0 , 'R');


$pdf->setXY(15,77);


$pdf->MultiCell(90, 10 , '2. �Թ��͹ (���ԡ)');


$pdf->setXY(75,77);


$pdf->MultiCell(30, 10 , number_format($rs['money2'],2) . ' �ҷ' , 0 , 'R');


$pdf->setXY(15,84);


$pdf->MultiCell(90, 10 , '3. �Թ���./�ԪҪվ/�Է°ҹ�');


$pdf->setXY(75,84);


$pdf->MultiCell(30, 10 , number_format($rs['money3'],2) . ' �ҷ' , 0 , 'R');
$pdf->setXY(15,91);


$pdf->MultiCell(90, 10 , '4. �Թ���./�ԪҪվ/�Է°ҹ� (���ԡ) ' );


$pdf->setXY(75,91);


$pdf->MultiCell(30, 10 , number_format($rs['money4'],2) . ' �ҷ' , 0 , 'R');
$pdf->setXY(15,98);

$pdf->MultiCell(90, 10 , '5. �.�.�.���./�.�.8-8�./�.�.�.1-7');


$pdf->setXY(75,98);


$pdf->MultiCell(30, 10 , number_format($rs['money5'],2) . ' �ҷ' , 0 , 'R');

$pdf->setXY(15,105);


$pdf->MultiCell(90, 10 , '6. �.�.�.���./�.�.8-8�./�.�.�.1-7 (���ԡ)');


$pdf->setXY(75,105);


$pdf->MultiCell(30, 10 , number_format($rs['money6'],2) . ' �ҷ' , 0 , 'R');


$pdf->setXY(15,112);


$pdf->MultiCell(90, 10 , '7. �Թ��������ͺص�');


$pdf->setXY(75,112);


$pdf->MultiCell(30, 10 , number_format($rs['money7'],2) . ' �ҷ' , 0 , 'R');


$pdf->setXY(15,119);


$pdf->MultiCell(90, 10 , '8. �Թ �.�.�./�.�.�.');


$pdf->setXY(75,119);


$pdf->MultiCell(30, 10 , number_format($rs['money8'],2) . ' �ҷ' , 0 , 'R');


$pdf->setXY(15,126);


$pdf->MultiCell(90, 10 , '9. �Թ�ͺ᷹�����');


$pdf->setXY(75,126);


$pdf->MultiCell(30, 10 , number_format($rs['money9'],2) . ' �ҷ' , 0 , 'R');


$pdf->setXY(15,133);


$pdf->MultiCell(90, 10 , '10. ���� ');


$pdf->setXY(75,133);


$pdf->MultiCell(30, 10 , number_format($rs['money10'],2) . ' �ҷ' , 0 , 'R');


$pdf->SetFont('thsarabun','B',15); 


$pdf->setXY(15,161);


$pdf->MultiCell(90, 10 , '����Ѻ������', 0, 'C');


$pdf->setXY(75,161);


$pdf->MultiCell(30, 10 , number_format($rs['sumget'],2) . ' �ҷ' , 0 , 'R');


$pdf->setXY(15,170);


$pdf->MultiCell(90, 10 , '�Ѻ�ط��', 0, 'C');


$pdf->setXY(75,170);


$pdf->MultiCell(30, 10 , number_format($rs['sumnet'],2) . ' �ҷ' , 0 , 'R');


$pdf->SetFont('thsarabun','',15); 


$pdf->setXY(15,177);


$pdf->MultiCell(90, 10 , '(' . num2thai($rs['sumnet']) . ')' , 0 , 'R');


//$pdf->setXY(15,190);


//$pdf->SetFont('thsarabun','',14); 


//$pdf->SetTextColor(255, 0, 0); 


//$pdf->MultiCell(90, 6 , '�����˵� : �͡��é�Ѻ����� "����" ��ͧ���Сͺ�Ѻ�͡��÷��ҧ�Ҫ����͡��� ������Ѻ�ͧ���Ҷ١��ͧ�ء���� �ҡ�����ʧ����ô�Դ��͡������ѧ��о�ʴ� �� 0 2590 1273' , 1 , 'C');




//��ҹ���


$pdf->SetFont('thsarabun','',15); 


$pdf->SetTextColor(0, 0, 0); 


$pdf->setXY(110,33);


$pdf->MultiCell(95 , 10 , '��Ш���͹ : '. iconv('UTF-8','cp874',$rs['nmonth']) . '  �.�.' . $rs['yy']);


$pdf->setXY(110,40);

$pdf->MultiCell(95 , 10 , '���͸�Ҥ�� : ' . iconv('UTF-8','cp874',$rs['namebank']));


$pdf->setXY(128,47);

$pdf->MultiCell(100 , 10 , iconv('UTF-8','cp874',$rs['sakhabank']));


$pdf->setXY(110,54);


$pdf->MultiCell(95 , 10 , '�Ţ���ѭ�� : '. $rs['nobank']);


$pdf->SetFont('thsarabun','B',15); 


$pdf->SetFillColor(248,242,151);


$pdf->setXY(110,65);


$pdf->Cell(85 , 5 , '��¡���ѡ', 0 , 0 , 'C', true);


$pdf->SetFont('thsarabun','',15); 


$pdf->setXY(110,70);


$pdf->MultiCell(90, 10 , '1. ����');


$pdf->setXY(165,70);


$pdf->MultiCell(30, 10 , number_format($rs['exp1'],2) . ' �ҷ' , 0 , 'R');


$pdf->setXY(110,77);


$pdf->MultiCell(90, 10 , '2. ��ҷع���͹���-�Թ����ˡó�');


$pdf->setXY(165,77);


$pdf->MultiCell(30, 10 , number_format($rs['exp2'],2) . ' �ҷ' , 0 , 'R');


$pdf->setXY(110,84);


$pdf->MultiCell(90, 10 , '3. ���./�ʨ./��Сѹ�ѧ�� (�����͹)');


$pdf->setXY(165,84);


$pdf->MultiCell(30, 10 , number_format($rs['exp3'],2) . ' �ҷ' , 0 , 'R');


$pdf->setXY(110,91);


$pdf->MultiCell(90, 10 , '4. �Թ������ͷ�����������');


$pdf->setXY(165,91);


$pdf->MultiCell(30, 10 , number_format($rs['exp4'],2) . ' �ҷ' , 0 , 'R');


$pdf->setXY(110,98);


$pdf->MultiCell(90, 10 , '5. �Թ������͡���֡��');


$pdf->setXY(165,98);


$pdf->MultiCell(30, 10 , number_format($rs['exp5'],2) . ' �ҷ' , 0 , 'R');


$pdf->setXY(110,105);


$pdf->MultiCell(90, 10 , '6. �Թ����ҹ��˹�');


$pdf->setXY(165,105);


$pdf->MultiCell(30, 10 , number_format($rs['exp6'],2) . ' �ҷ' , 0 , 'R');


$pdf->setXY(110,112);


$pdf->MultiCell(90, 10 , '7. ��Ҭһ��Ԩ/�Թ��������ͧҹȾ');


$pdf->setXY(165,112);


$pdf->MultiCell(30, 10 , number_format($rs['exp7'],2) . ' �ҷ' , 0 , 'R');


$pdf->setXY(110,119);


$pdf->MultiCell(90, 10 , '8. �Թ���ا/�Թ�ع/������ʴԡ��/ʧ������');


$pdf->setXY(165,119);


$pdf->MultiCell(30, 10 , number_format($rs['exp8'],2) . ' �ҷ' , 0 , 'R');


$pdf->setXY(110,126);


$pdf->MultiCell(90, 10 , '9. �Թ���ا���¡�׹/����ҧ��/���Ѵ�Թ ');


$pdf->setXY(165,126);


$pdf->MultiCell(30, 10 , number_format($rs['exp9'],2) . ' �ҷ' , 0 , 'R');

$pdf->setXY(110,133);


$pdf->MultiCell(90, 10 , '10. ����');


$pdf->setXY(165,133);


$pdf->MultiCell(30, 10 , number_format($rs['exp10'],2) . ' �ҷ' , 0 , 'R');


$pdf->SetFont('thsarabun','B',15); 


$pdf->setXY(110,161);


$pdf->MultiCell(90, 10 , '����ѡ������', 0, 'C');


$pdf->setXY(165,161);


$pdf->MultiCell(30, 10 , number_format($rs['sumpay'],2) . ' �ҷ' , 0 , 'R');


$pdf->Image('images/sign.png',147,180,15);


$pdf->SetFont('thsarabun','',15); 


$pdf->setXY(110,184);


//$pdf->MultiCell(90, 10 ,'ŧ���� ............................................', 0, 'C');


//$pdf->setXY(110,191);


//$pdf->MultiCell(90, 10 , '(������Դ    �ҹ�ͧ)', 0, 'C');


//$pdf->setXY(110,198);


//$pdf->MultiCell(90, 10 , '��Ҿ�ѡ�ҹ����Թ��кѭ��������', 0, 'C');


//$pdf->setXY(110,205);


//$pdf->MultiCell(90, 10 , '���˹�ҽ��¡���Թ', 0, 'C');

//$pdf->setXY(110,212);


//$pdf->MultiCell(90, 10 , '�ͧ��ѧ ������ᾷ��', 0, 'C');


$pdf->setXY(110,229);


$pdf->SetFont('thsarabun','',14); 


$date_now= date("Y-m-d");



$pdf->MultiCell(90, 10 , '�ѹ����͡˹ѧ����Ѻ�ͧ '.iconv('UTF-8','cp874',DateThai($date_now))  , 0, 'C');


$pdf->setXY(10,247);


$pdf->SetFont('thsarabun','',14); 


$pdf->SetTextColor(255, 0, 0); 


$pdf->MultiCell(190, 6 , ':: �͡��é�Ѻ����� "����" ��ͧ���Сͺ�Ѻ�͡��÷��ҧ�Ҫ����͡�����ҹ��  �ҡ��ͧ��é�Ѻ��ԧ���;����������١��ͧ ��سҵԴ��ͧҹ����Թ ��� 9 �Ҥ��33�� �� 02-3539763 ::' , 0 , 'C');


$pdf->Output();

?>