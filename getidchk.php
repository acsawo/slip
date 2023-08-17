<?php
session_start();
ob_start(); 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<META content="text/html; charset=utf8" http-equiv=Content-Type>
<META NAME=KEYWORDS CONTENT="Department of Medical Services(DMS)">
<META NAME=AUTHOR CONTENT="กรมการแพทย์">
<TITLE>ระบบแจ้งเงินเดือนออนไลน์ กรมการแพทย์</TITLE>
<HTML>
<BODY background="images/bkgnd05.png">

<table width="768" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF">
<tr><td colspan="3"><img src="images/header01.png" border="0"></td></tr>
<tr>
<td>
<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 0);

if($_SESSION['usnm'] == "")
{
header("Location: frmin.php");
exit();
}
if( !isset($_SESSION["pswd"]) ){
header("Location: frmchkadm.php");
	exit();
}
/*  if($_SESSION['pswd'] == "")
{
}  */
$usnm=$_SESSION['usnm'];
$pswd=$_SESSION['pswd'];
include ("connectdb.php");  
?>
<center><h1>หน้าจอสำหรับ Admin </h1></center>
<center><font size='3' color='#FF0000'><a href="add_data2.php">|  เพิ่มข้อมูล |</a><a href="manage.php">|  จัดการผู้ใช้งาน |</a></font></center>
<table cellspacing=0 cellpadding=3 width=100% border=0>
<tr><td align='center'>
	<form name="frmsearch" method="post" action="getidchk.php">
	<br><font size = '3' color='#000000'>เลขประจำตัวประชาชน : </font>
	<input name="txtKword" type="text" id="txtKword" size="13">
	<input type="submit" value="ค้นหา">
	</form>
</td></tr>
</table>
<?php
if(isset($_POST["txtKword"]) ){
	$txtKword =  $_POST["txtKword"];
	//echo $txtKword;
}

 if(isset($txtKword) )
{
$rsql1 = mysqli_query($connect,"SELECT * FROM tbmain WHERE idno='".$txtKword."'"); 
$nrows1=mysqli_num_rows($rsql1);
$rsql=mysqli_fetch_array($rsql1,MYSQLI_BOTH);
if($nrows1 > 0)
{
$noman=$rsql['noman'];
$id13=$rsql['idno'];
$nname1=$rsql['nname'];
$nposit=$rsql['nposit'];
$coff=$rsql['noffice'];
$nobank=$rsql['nobank'];
$rsql2 = mysqli_query($connect,"SELECT * FROM tboffice WHERE coff='".$coff."'");
$rs2=mysqli_fetch_array($rsql2,MYSQLI_BOTH);
$noffice=$rs2['noffice'];
?>
<center>
<table  cellspacing=0 cellpadding=3 width=50% border=1 bgcolor='#FFFFFF'>
<tr><td><font size = '3' color='#0033FF'>
<br><b>id 13 :</b> <?php echo $id13; ?>
<br><b>ชื่อ-สกุล :</b> <?php echo $nname1; ?>
<br><b>ตำแหน่ง :</b> <?php echo $nposit; ?>
<br><b>หน่วยงาน :</b> <?php echo $noffice; ?>
<br><b>เลขที่บัญชี :</b> <?php echo $nobank; ?>
<br>&nbsp;
<br><center><INPUT onclick="window.location='repwd.php?vid=<?php echo $noman;?>';"  value="Reset Password" type=button></center>

</font> </td></tr>
</table>
</center>
<?php
}else{
?>
<center><font face = 'ms sans serif' size = '3' color='#0033FF'><b>!! ไม่พบ id : <?php echo $txtKword; ?> ที่ค้นหา !!</b></font> </center>
<?php
}
} 
mysqli_close($connect); 
?>

 </td>
</tr>
<tr><td>
<br><center><font face = "ms sans serif" size = "3" color="#FF3333"><b><< <a href="allmonth.php">กลับหน้าหลัก</a> >></b></font> || <font face = "ms sans serif" size = "3" color="#FF3333"><b><< <a href="logout.php">ออกจากระบบ</a> >></b></font></center>
</td></tr>
 <tr><td colspan="3"><img src="images/footer01.png" border="0"></td></tr>
 </table> 
 </BODY>
</HTML>


