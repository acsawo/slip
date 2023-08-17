<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML><HEAD>
<META NAME=KEYWORDS CONTENT="Department of Medical Services(DMS)">
<META NAME=AUTHOR CONTENT="กรมการแพทย์">
<TITLE>ระบบแจ้งเงินเดือนออนไลน์ กรมการแพทย์</TITLE>
<TITLE>ระบบแจ้งเงินเดือนออนไลน์ สำนักงานปลัดกระทรวงสาธารณสุข</TITLE>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
 <script src="https://code.jquery.com/jquery-3.3.1.js" > </script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" > </script>
   <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js" > </script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</HEAD>



<BODY background="images/bkgnd05.png">
<script type="text/javascript">
	$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
<?php
include ("connectdb.php");
session_start(); 

if($_SESSION['usnm'] == "")

{

header("Location: frmin.php");

exit();

}
?>
<table width="768" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF">
<tr><td colspan="3"><img src="images/header01.png" border="0"></td></tr>

<tr>
<td align="center">จัดการผู้ใช้งาน<br><br>

 
<?php
 $id_person = $_POST["id_person"];
$prename= $_POST["prename"];
 $nname= $_POST["nname"];
 $lname= $_POST["lname"];
$bank= $_POST["bank"];
 $bank_no= $_POST["bank_no"];
   $agency= $_POST["agency"];
 $position= $_POST["position"];
 
$query3 = "UPDATE tbmain SET prename='{$prename}' ,nname='{$nname}',
			lname='{$lname}',cbank='{$bank}',nobank='{$bank_no}',
		noffice='{$agency}',nposit='$position' WHERE idno = '{$id_person}'";
$re_chk_off = mysqli_query($connect,$query3);

if($re_chk_off)
{exit("<script>alert('แก้ไขสำเร็จ');window.location='manage.php';</script>");}
else 
{exit("<script>alert('แก้ไข ไม่สำเร็จ กรุณาทำการแก้ไขใหม่');window.location='manage.php';</script>");}

?>

 
 


	</tr>
	
	<tr><td>
<br><center><font face = "ms sans serif" size = "3" color="#FF3333"><b><< <a href="allmonth.php">กลับหน้าหลัก</a> >></b></font> || <font face = "ms sans serif" size = "3" color="#FF3333"><b><< <a href="logout.php">ออกจากระบบ</a> >></b></font></center>
</td></tr>
 <tr><td colspan="3"><img src="images/footer01.png" border="0"></td></tr>
	</table>
	
 </BODY>
 </HTML>

