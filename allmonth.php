<?php
session_start();
ob_start();?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<META content="text/html; charset=utf8" http-equiv=Content-Type>
<META NAME=KEYWORDS CONTENT="lerdsin Hospital">
<META NAME=AUTHOR CONTENT="โรงพยาบาลเลิดสิน , E-mail: aj_or@hotmail.com">
<TITLE>ระบบแจ้งเงินเดือนออนไลน์ โรงพยาบาลเลิดสิน กรมการแพทย์</TITLE>

<HTML>

<BODY background="images/bkgnd05.png">

<table width="768" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF">

<tr><td colspan="3"><img src="images/header01.png" border="0"></td></tr>

<tr><td>

<?php



if($_SESSION['usnm'] == "")

{

header("Location: frmin.php");
exit();

}

$usnm=$_SESSION['usnm'];

include ("connectdb.php"); 
include("function.php");


$rtdt = "SELECT tbdetail.nauto, tbdetail.idno, tbmain.nname,tbmain.lname,tbmain.prename, tbmain.nposit, tboffice.noffice, tbdetail.daypay, tbdetail.mm, tbdetail.notes, tbmonth.nmonth, tbdetail.yy, tbmain.nobank, tbbank.namebank, tbbank.sakhabank, tbdetail.chk

FROM (((tbmain RIGHT JOIN tbdetail ON tbmain.idno = tbdetail.idno) LEFT JOIN tbbank ON tbmain.cbank = tbbank.cbank) LEFT JOIN tboffice ON tbmain.noffice = tboffice.coff) LEFT JOIN tbmonth ON tbdetail.mm = tbmonth.mm

WHERE (((tbdetail.idno)= '".$_SESSION['usnm']."'))  

ORDER BY tbdetail.yy DESC, tbdetail.mm DESC; ";
//echo $rtdt;exit;


//rtdt = retrive data, rsdt = resource data

$chk_admin_sql = "SELECT * FROM tbchkadm where idno ='{$_SESSION['usnm']}' ";
//echo $chk_admin_sql;
$re_chk_admin = mysqli_query($connect,$chk_admin_sql); 
$row_chk=mysqli_num_rows($re_chk_admin);


$rsdt = mysqli_query($connect,$rtdt); 
$nrows=mysqli_num_rows($rsdt);
$rs=mysqli_fetch_array($rsdt,MYSQLI_BOTH);

$nname=$rs['nname'];
$lname=$rs['lname'];
$prename=$rs['prename'];

$nposit=$rs['nposit'];

$noffice=$rs['noffice'];
//echo $row_chk."999";
if($row_chk!=0)
{echo "<center><font size='-1' color='#CCCCCC'>[ <a href='getidchk.php'>Admin</a> ]</font></center>";}


echo "<table cellspacing=0 cellpadding=3 width=100% border=0><tr><td align='center'>";

echo "<font face = 'ms sans serif' size = '3'><b>ยินดีต้อนรับ <br/> $prename$nname"." ".$lname."  </b>ตำแหน่ง<b> $nposit  </b> <br/>หน่วยงาน<b> $noffice</b><br/></font></td></tr>";

echo "<tr><td align='center'><br><font face = 'ms sans serif' size = '3' color='#FF3333'><b><< <a href='chdetailnd.php'>เปลี่ยนรหัสผ่าน</a> >></b></font> || <font face = 'ms sans serif' size = '3' color='#FF3333'><b><< <a href='logout.php'>ออกจากระบบ</a> >></b></font></td></tr>";

echo "<tr><td align='center'><br><font face = 'ms sans serif' size = '3' color='#990033'><b>!! คลิกชื่อเดือนเพื่อแสดงรายละเอียดใบแจ้งเงินเดือน !!</b></font><br> ";

echo "<table  cellspacing=0 cellpadding=3 width=60% border=1 bgcolor='#FFFFFF'><tr align='center' bgcolor='#CCFFFF'>";

echo "<td align='center'><font face = 'ms sans serif' size = '3' color='#0033FF'><b>เดือน</b></font></td>";

echo "<td align='center'><font face = 'ms sans serif' size = '3' color='#0033FF'><b>วันที่โอนเงินเข้าบัญชี</b></font></td>";

echo "<td align='center'><font face = 'ms sans serif' size = '3' color='#0033FF'><b>หมายเหตุ</b></font></td></tr>";



mysqli_data_seek($rsdt,0);

$i=1;

while($i <= $nrows){

	$rs2=mysqli_fetch_array($rsdt,MYSQLI_BOTH);

	$nmonth=$rs2['nmonth'];

	$yy=$rs2['yy'];

	$chk=$rs2['chk'];

	$daypay=$rs2['daypay'];

	$notes=$rs2['notes'];

	if($notes==""){$notes = "-";}	   

	$vrec=$rs2['nauto']; 


?>
<tr>

<?php
//9=ข้อมูลก่อนเข้าจ่ายตรงกรมบัญชีกลาง  0=ข้าราชการ  1=ลูกจ้างประจำ
if($chk==9){
echo "<td align='left'>&nbsp;&nbsp;&nbsp;<font face = 'ms sans serif' size = '3'><a href='viewmm.php?vrec= $vrec '>$nmonth $yy</a></font></td>";
}
elseif($chk==0){
echo "<td align='left'>&nbsp;&nbsp;&nbsp;<font face = 'ms sans serif' size = '3'><a href='viewmmCivil.php?vrec= $vrec '>$nmonth  $yy</a></font></td>";
}
elseif($chk==2)
{
	echo "<td align='left'>&nbsp;&nbsp;&nbsp;<font face = 'ms sans serif' size = '3'><a href='viewmmoffice.php?vrec= $vrec '>$nmonth  $yy</a></font></td>";
}
else{
echo "<td align='left'>&nbsp;&nbsp;&nbsp;<font face = 'ms sans serif' size = '3'><a href='viewmmEmployee.php?vrec= $vrec '>$nmonth  $yy</a></font></td>";
}
?>

<td align='right'><font face = 'ms sans serif' size = '3'><?php echo DateThai($daypay); ?></font>&nbsp;&nbsp;&nbsp;</td>

<td align='center'><font face = 'ms sans serif' size = '3'><?php echo $notes; ?></font></td></tr>

<?php

$i++;

}

mysqli_close($connect); 

?>

</table></td></tr></table>

 </td></tr>

 <tr><td colspan="3" align="center"><br><font color="#666666" size="-1">++ ข้อมูลเริ่มต้น เดือน มิถุนายน 2563 ++</font><br><br></td></tr>

  <tr><td colspan="3"><img src="images/footer01.png" border="0"></td></tr>

 </table>

 </BODY>

</HTML>





