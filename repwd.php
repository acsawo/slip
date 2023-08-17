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
session_start();
if($_SESSION['usnm'] == "")
{
header("Location: frmin.php");
exit();
}
if($_SESSION['pswd'] == "")
{
header("Location: frmchkadm.php");
exit();
}
$usnm=$_SESSION['usnm'];
$pswd=$_SESSION['pswd'];
include ("connectdb.php"); 
$vid = $_GET['vid'];
?>
<center><font size='3' color='#FF0000'><b>[ :: หน้าจอสำหรับ Admin :: ]</b></font></center>

<?php
if($vid != '')
{
$query1 = "update tbmain set passc='123456', chn='0', dayup=now() where noman='".$vid."'";
$result = mysqli_query($connect,$query1) or die(mysqli_error());

$rsql1 = mysqli_query($connect,"SELECT * FROM tbmain WHERE noman='".$vid."'"); 
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
$passw=$rsql['passc'];
$rsql2 = mysqli_query($connect,"SELECT * FROM tboffice WHERE coff='".$coff."'");
$rs2=mysqli_fetch_array($rsql2,MYSQLI_BOTH);
$noffice=$rs2['noffice'];
?>
<center>
<br><font face = 'ms sans serif' size = '3' color='#0033FF'><b>!! ดำเนินการ Reset Password เสร็จสิ้นแล้ว !!</b></font><br>
<table  cellspacing=0 cellpadding=3 width=50% border=1 bgcolor='#FFFFFF'>
<tr><td><font size = '3'>
<br><font color='#CCCCCC'><b>id 13 :</b> <?php echo $id13; ?></font>
<br><font color='#CCCCCC'><b>ชื่อ-สกุล :</b> <?php echo $nname1; ?></font>
<br><font color='#CCCCCC'><b>ตำแหน่ง :</b> <?php echo $nposit; ?></font>
<br><font color='#CCCCCC'><b>หน่วยงาน :</b> <?php echo $noffice; ?></font>
<br><font color='#CCCCCC'><b>เลขที่บัญชี :</b> <?php echo $nobank; ?></font>
<br><font color='#0033FF'><b>password :</b> <?php echo $passw; ?></font>
<br>&nbsp;
</font> </td></tr>
</table>
</center>

&nbsp;
<?php
}
}
mysqli_close($connect); 
?>

</td>
</tr>
<tr><td>
<br><center><font face = "ms sans serif" size = "3" color="#FF3333"><b><< <a href="getidchk.php">ค้นหาต่อ</a> >></b></font> || <font face = "ms sans serif" size = "3" color="#FF3333"><b><< <a href="allmonth.php">กลับหน้าหลัก</a> >></b></font> || <font face = "ms sans serif" size = "3" color="#FF3333"><b><< <a href="logout.php">ออกจากระบบ</a> >></b></font></center>
</td></tr>
 <tr><td colspan="3"><img src="images/footer01.png" border="0"></td></tr>
 </table>
 </BODY>
</HTML>


