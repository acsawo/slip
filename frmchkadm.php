<?php 
session_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML><HEAD>
<META content="text/html; charset=utf8" http-equiv=Content-Type>
<META NAME=KEYWORDS CONTENT="Department of Medical Services(DMS)">
<META NAME=AUTHOR CONTENT="กรมการแพทย์">
<TITLE>ระบบแจ้งเงินเดือนออนไลน์ กรมการแพทย์</TITLE>
</HEAD>
<?php
include ("connectdb.php");

if($_SESSION['usnm'] == "")
{
header("Location: frmin.php");
exit();
}
$usnm=$_SESSION['usnm'];

?>
<BODY background="images/bkgnd05.png">
<table width="768" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF">
<tr><td colspan="3"><img src="images/header01.png" border="0"></td></tr>
<tr>
<td width="214" align="center"><br>
<table width="90%" border="0" cellpadding="0" cellspacing="0"><tr><td>
<!--<font color="#000000"><b>วัตถุประสงค์ :</b>
<br>1.เพื่อแจ้งรายละเอียดการโอนเงินดือน ค่าจ้าง ค่าตอบแทนเข้าบัญชีของข้าราชการ ลูกจ้างประจำ และพนักงานราชการของสำนักงานปลัดกระทรวงสาธารณสุข (INTRANET)
<br>2.เพื่อลดการใช้กระดาษ ทดแทนการแจกกระดาษสลิปเงินเดือน
</font>-->
</td></tr></table>
</td>
<td align="center">
<br><font color="#FF3333" size="-1"><b>!! หากคุณไม่ใช่ ADMIN !!<br>กรุณา <font color="#000000"><a href="allmonth.php">กลับหน้าแรก</a></font> ขอบคุณค่ะ<b></font><br>
<table width="340" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
 <tr>
<form name="form" method="post" action="chkadm.php">
 <td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
 
<tr><td colspan="3">&nbsp;</td></tr>
<tr>
<td colspan="3" align="center"><font color="#0000CC"><strong>:: หน้า Login สำหรับ Admin ::</font></strong></td>
 </tr>
 <tr>
<td align="right"><font color="#009900"><b>Password</b></font></td>
 <td>:</td>
 <td><input name="pswd" type="password" size="13" id="pswd"></td>
 </tr>
 
<tr>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td><input type="submit" name="Submit" value="ตกลง"></td>
 </tr>
 </tr>
</table>
</td>
</form>
</tr>
 </table><br>
  </td>
<td width="214" align="center"><br>
<table width="90%" border="0" cellpadding="0" cellspacing="0"><tr><td valign="top">
<!--<font color="#FF0000"><b>โปรดอ่าน :</b>
<br>ผู้ใดเข้าถึงโดยมิชอบซึ่งข้อมูลคอมพิวเตอร์ที่มีมาตรการป้องกันการเข้าถึงโดยเฉพาะ และมาตรการนั้นมิได้มีไว้สําหรับตน ต้องระวางโทษจําคุกไม่เกินสองปี หรือปรับไม่เกินสี่หมื่นบาท หรือทั้งจําทั้งปรับ (มาตรา 7 พระราชบัญญัติว่าด้วยการกระทําความผิดเกี่ยวกับคอมพิวเตอร์ พ.ศ.2550)
</font>--></td></tr></table>
</td>
   </tr>
<tr><td colspan="3"><br><img src="images/footer01.png" border="0"></td></tr>
</table>
 </BODY>
 </HTML>