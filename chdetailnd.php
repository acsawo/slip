<?php 
session_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<META content="text/html; charset=utf8" http-equiv=Content-Type>
<META NAME=KEYWORDS CONTENT="Department of Medical Services(DMS)">
<META NAME=AUTHOR CONTENT="กรมการแพทย์">
<TITLE>ระบบแจ้งเงินเดือนออนไลน์ กรมการแพทย์</TITLE>
<HTML>
<BODY background="images/bkgnd05.png">
<table width="768" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF">
<tr><td colspan="3"><img src="images/header01.png" border="0"></td></tr>
<tr><td>
<?php
include ("connectdb.php"); 
if($_SESSION['usnm'] == "")
{
header("Location: frmin.php");
exit();
}
$usnm=$_SESSION['usnm'];

$rtdt = "SELECT tbmain.nname, tbmain.nposit, tbmain.passc, tboffice.noffice FROM tbmain LEFT JOIN tboffice ON tbmain.noffice = tboffice.coff WHERE tbmain.idno = '".$_SESSION['usnm']."'";
//rtdt = retrive data, rsdt = resource data
$rsdt = mysqli_query($connect,$rtdt); 
$nrows=mysqli_num_rows($rsdt);
$rs=mysqli_fetch_array($rsdt,MYSQLI_BOTH);
$nname=$rs['nname'];
$nposit=$rs['nposit'];
$noffice=$rs['noffice'];
echo "<table cellspacing=0 cellpadding=0 width=100% border=0><tr><td align='center'>";
echo "<font face = 'ms sans serif' size = '5'><font color='#FF0000'><b>++ เปลี่ยนรหัสผ่านใหม่ ++</b></font><br/><b> $nname  </b>ตำแหน่ง<b> $nposit  </b> <br/>หน่วยงาน<b> $noffice</b></font>
<br/> <font color='#0000CC'><b>:: หน้าจอนี้สำหรับกำหนดรหัสผ่าน (Password) เฉพาะตัวคุณ ในการเข้าระบบ ::</b></font></td></tr>";
?>
<tr><td align="center"><br/>
<table cellspacing="0" cellpadding="0" width="80%" border="0"><tr><td>
<dd><font face = 'ms sans serif' size = '3'><font color="#FF0000"><b><u>โปรดอ่าน</u> !! </b></font>
<br><dd>1. พิมพ์ <b>ตัวอักษรภาษาอังกฤษและตัวเลข</b> ลงในช่องรหัสผ่านใหม่(New) ด้านล่าง ต้องพิมพ์ให้เหมือนกันทั้ง 2 ช่องเพื่อเป็นการยืนยัน <font color="#FF0000">(รหัสผ่านต้องเป็นตัวอักษรภาษาอังกฤษและตัวเลขเท่านั้น <u>ห้าม</u>ใช้อักขระพิเศษและเว้นวรรค) </font>
<br><dd>2. รหัสผ่านควรกำหนดจำนวน<b>ไม่น้อยกว่า 8 ตัว</b>
<br><dd>3. ต้องปกปิดรหัสผ่านเป็นความลับเฉพาะตัวของท่าน <u>ห้าม</u>เปิดเผยแก่ผู้อื่น ป้องกันข้อมูลของท่านถูกนำไปใช้ในทางมิชอบ
<br><dd>4. การเข้าระบบครั้งต่อไป <u>ต้องใช้</u> เลขบัตรประจำตัวประชาชน13หลัก เป็น "ชื่อผู้ใช้(Username)" 
<br><dd>และใช้รหัสผ่านที่ท่านกำหนดใหม่ในครั้งนี้ เป็น "รหัสผ่าน(Password)"
<br><dd>5. <b>กรณีเข้าระบบไม่ได้หรือลืมรหัสผ่าน</b> โปรดติดต่อ 02-5906280 แจ้งข้อมูลส่วนบุคคล เพื่อให้เจ้าหน้าที่ตรวจสอบความเป็นตัวตนที่ถูกต้อง
</font>
</td></tr></table>
</td></tr>
<tr><td align='center'><br>
<FORM METHOD=POST ACTION = "chpwd_actnd.php">
  <table width="440" border="1" align="center" cellpadding="0" cellspacing="1">
  <tr><td align="center"><br>
  <table width="90%" border="0" align="center">
  <tr> 
<td><font color="#0000CC"><strong><font face = 'ms sans serif' size = '3'> กำหนดรหัสผ่านใหม่ (New) </font><font face = 'ms sans serif' size = '3' color="green"> :
	</font></strong></font></td>
<td><strong>
	<input type = "password" name = "new_pwd" size = "20" maxlength="15">
</strong></td>
</tr>
<tr> 
<td> <strong><font face = 'ms sans serif' size = '3' color="#0000CC"> ยืนยันรหัสผ่านใหม่ (New) </font><font face = 'ms sans serif' size = '3' color="green"> :
</font></strong></td>
<td><strong> 
	<input type = "password" name = "confirm_pwd" size = "20" maxlength="15">
</strong><font face = 'ms sans serif' size = '3' color="#FF0000"> <b>เหมือนบรรทัดบน</b> </font></td>
</tr>
<tr> 
<td colspan="2"><div align="center">
  <p>
    <input name="button_ok" type = "submit" id="button_ok2" value = " ตกลง " > 
    <input name="cancel" type="reset" id="cancel" value="ยกเลิก"> 
    </p>
</div></td>
</tr>
</table>
<br></td></tr></table>
</FORM>
</table>

<center><font face = "ms sans serif" size = "3" color="#FF3333"><b><< <a href="allmonth.php">กลับหน้าแรก</a> >></b></font> || <font face = "ms sans serif" size = "3" color="#FF3333"><b><< <a href="logout.php">ออกจากระบบ</a> >></b></font></center>
<br>
 </td></tr>
  <tr><td colspan="3"><img src="images/footer01.png" border="0"></td></tr>
 </table>
 </BODY>
</HTML>


