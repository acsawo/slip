<?php
ob_start(); 
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
	 
	 $new_pwd=$_POST['new_pwd'];
	 $confirm_pwd=$_POST['confirm_pwd'];
	if ($usnm ) {	
		$query = "select * from tbmain WHERE (idno= '".$_SESSION['usnm']."')";
		$result  = mysqli_query($connect,$query);
		$rows = mysqli_num_rows($result);
		$rs=mysqli_fetch_array($result,MYSQLI_BOTH);
		
		if($rows <= 0)   {
		header("Location: frmin.php");
		exit();
		}
		else {
		if((strcmp($new_pwd,$confirm_pwd) != 0 ) or ($new_pwd == "")){
?>
			<div align="center">
			<table width="480" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
			<tr> <td>
					<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
					<tr><td>&nbsp;</td></tr>
					<tr><td align="center"><font face = "ms sans serif" size = "4"><strong><font color="#FF0099">!!</font><font color="#0000CC"> ผิดพลาด : รหัสผ่านที่กำหนดไม่ตรงกันทั้ง 2 ครั้ง</font> <font color="#FF0099">!!</font></strong></font>
							<br><br><font face = "ms sans serif" size = "4"><strong><font color="#0000CC">หรือยังไม่ได้กำหนดรหัสผ่านใหม่</font></strong></font>				
							<br><br><font face = "ms sans serif" size = "4" color="#003300"><b><< <a href="chdetailnd.php"><font color="#003300">กำหนดใหม่</font></a> >></b></font> || <font face = "ms sans serif" size = "4" color="#FF3333"><b><< <a href="logout.php"><font color="#FF0000">ออกจากระบบ</font></a> >></b></font>
						   </td></tr>
					<tr><td>&nbsp;</td></tr>
					</table>
			</td></tr>
			</table>
			</div>
        <?php
			}
			else  {
			    $vchn = $rs["chn"]+1;
				$query2 = "update tbmain set passc='$new_pwd', chn='$vchn', dayup=now()  where idno = '$usnm' ";
				$result = mysqli_query($connect,$query2) or die(mysqli_error());
?>        <div align="center">
			<table width="480" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
			<tr> <td>
					<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
					<tr><td>&nbsp;</td></tr>
					<tr><td align="center"><font face = "ms sans serif" size = "4"><strong><font color="#FF0099">:+:</font><font color="#0000CC"> การเปลี่ยนแปลงรหัสผ่าน(Password) เสร็จเรียบร้อยแล้ว</font> <font color="#FF0099">:+:</font></strong></font>
							<br><br><font face = "ms sans serif" size = "4" color="#003300"><strong>โปรดออกจากระบบเพื่อทำการ Login ด้วยรหัสผ่านใหม่ที่ท่านกำหนดเองเมื่อสักครู่นี้ค่ะ</strong></font>
							<br><br><font face = "ms sans serif" size = "4" color="#FF3333"><b><< <a href="logout.php"><font color="#FF0000">ออกจากระบบ</font></a> >></b></font>
						   </td></tr>
					<tr><td>&nbsp;</td></tr>
					</table>
			</td></tr>
			</table>
			</div><br><br></td>
        <?php
	//	mysqli_close();
		session_destroy(); 
						}
				}
		}
		else  {
		header("Location: frmin.php");
		exit();
		}
?>
</tr>
  <tr><td colspan="3"><img src="images/footer01.png" border="0"></td></tr>
 </table>
 </BODY>
</HTML>
