<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML><HEAD>
<META content="text/html; charset=tis-620" http-equiv=Content-Type>
<META NAME=KEYWORDS CONTENT="Department of Medical Services(DMS)">
<META NAME=AUTHOR CONTENT="กรมการแพทย์">
<TITLE>ระบบแจ้งเงินเดือนออนไลน์ กรมการแพทย์</TITLE>
</HEAD>
<?php
include ("connectdb.php");
$query = "SELECT chn FROM tbmain WHERE (chn>0)";
$result  = mysqli_query($connect,$query);
$rows = mysqli_num_rows($result);

$query2 = "SELECT noman FROM tbmain";
$result2  = mysqli_query($connect,$query2);
$rows2 = mysqli_num_rows($result2);
?>
<BODY background="images/bkgnd05.png">
<table width="768" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF">
<tr><td colspan="3"><img src="images/header01.png" border="0"></td></tr>
<tr>
<td width="214" align="center"><br>
<table width="90%" border="0" cellpadding="0" cellspacing="0"><tr><td>
</td></tr></table>
</td>
<td align="center"><br><br>
<table width="340" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
 <tr>
<form name="form1" method="post" action="inchk.php">
 <td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
 
<tr><td colspan="3">&nbsp;</td></tr>
<tr>
<td colspan="3" align="center"><font color="#0000CC"><strong>:: กรุณา Login เข้าสู่ระบบ ::</font></strong></td>
 </tr>
 
<tr>
<td align="right"><font color="#009900"><b>เลขประชาชน</b><br>(Username)</font></td>
 <td width="6">:</td>
 <td><input name="usnm" type="text" size="13" id="usnm">
<br><font color="#666666" size="-1">[เลขประชาชน 13 หลัก]</font></td>
 </tr>
 <tr>
<td align="right"><font color="#009900"><b>รหัสผ่าน</b><br>(Password)</font></td>
 <td>:</td>
 <td><input name="pswd" type="password" size="13" id="pswd">
<br><font color="#666666" size="-1">[ครั้งแรกใช้ เลขประจำตัว 13 หลัก]</font></td>
 </tr>
 
<tr>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td><input type="submit" name="Submit" value="ตกลง"></td>
 </tr>
 </tr>
<tr><td colspan="3" align="center"><font color="#666666" size="-1">** ลืมรหัสผ่านโปรดติดต่อ 02-5906280 **</td></tr></table>
</td>
</form>
</tr>
 </table><br>
  </td>
<td width="214" align="center"><br>
<table width="90%" border="0" cellpadding="0" cellspacing="0"><tr><td valign="top">
<font color="#FF0000"><b>โปรดอ่าน :</b>
<br>ผู้ใดเข้าถึงโดยมิชอบซึ่งข้อมูลคอมพิวเตอร์ที่มีมาตรการป้องกันการเข้าถึงโดยเฉพาะ และมาตรการนั้นมิได้มีไว้สําหรับตน ต้องระวางโทษจําคุกไม่เกินสองปี หรือปรับไม่เกินสี่หมื่นบาท หรือทั้งจําทั้งปรับ (มาตรา 7 พระราชบัญญัติว่าด้วยการกระทําความผิดเกี่ยวกับคอมพิวเตอร์ พ.ศ.2550)
</font></td></tr></table>
</td>
   </tr>
 <tr><td colspan="3" align="center"><font color="#666666" size="-1">++ ข้อมูลเริ่มต้น เดือนมกราคม 2562 ++</font></td></tr>
 <tr><td colspan="3" align="center"><br><font color="#666666" size="-1">:: จำนวนผู้ที่ Login และเปลี่ยน Password ครั้งแรกสำเร็จ  
<?php
echo $rows ." คน จำนวนผู้มีสิทธิ์ ". number_format($rows2) . " คน ::";
?>
</font></td></tr>
<tr><td colspan="3">&nbsp;</td></tr>
<tr><td colspan="3" align="center">[ <a href="data/Mannual01.pdf"  target=_blank><img src="images/DLicon.jpg" border="0"></a> คลิกอ่านคู่มือการใช้งาน  ]</td></tr>
<tr><td colspan="3"><br><img src="images/footer01.png" border="0"></td></tr>
</table>
 </BODY>
 </HTML>