<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<META content="text/html; charset=utf8" http-equiv=Content-Type>
<META NAME=KEYWORDS CONTENT="Department of Medical Services(DMS)">
<META NAME=AUTHOR CONTENT="กรมการแพทย์">
<TITLE>ระบบแจ้งเงินเดือนออนไลน์ กรมการแพทย์</TITLE>

<HTML>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.nav-tabs{
  background-color:#fdf;
}
.tab-content{
    background-color:#fff;
    color:#000;
    padding:5px
}
.nav-tabs > li > a{
  border: medium none;
}
.nav-tabs > li > a:hover{
  background-color: #fsf;
    border: medium none;
    border-radius: 0;
    color:#54f;
}
</style>
</head>
<BODY background="images/bkgnd05.png">
<table width="768" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF">
<tr><td colspan="3"><img src="images/header01.png" border="0"></td></tr>
<tr>
<td>
<?php
	error_reporting(E_ALL);
		ini_set('display_errors', 0);
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


if(isset($_POST["status"]))
{
if($_POST["status"]=='add')
{
	$id_person =$_POST["id_person"];
	$amount=$_POST["amount"];
	$sql_add ="INSERT INTO loan(id_person,amount) VALUES('{$id_person}', {$amount})";
	//echo $sql_add;
	mysqli_query($connect,$sql_add);
	exit("<script>alert('เพิ่มเรียบร้อย');window.location='add_data.php';</script>");
}
}
?>

<div class="container"> 
<form class="form-inline" action="add_loan.php" method = "POST" >
<h2> เพิ่มจำนวนเงินกู้ยืม</h2>
<table class="table">
    
    <tbody>
      <!--<tr>
        <td>ชื่อ-สกุล</td>
        <td><input type="text" class="form-control" name="name1" value="" ></td>
       
      </tr>-->
      <tr>
        <td>เลขประจำตัวประชาชน</td>
        <td><input type="text" class="form-control" name="id_person" value=""  required></td>
       
      </tr>
      <tr>
        <td>จำนวนวเงินที่หัก</td>
        <td><input type="number" class="form-control" name="amount" value="" min="0.0" max="10000" step="0.01" required ></td>
		<td><input type="hidden" class="form-control" name="status" value="add"  ></td>
      </tr>
    </tbody>
  </table>

<button type="submit" class="btn btn-primary">เพิ่ม</button>

</form>
</div>


<?php

?>


<?php
mysqli_close($connect); 
?>

</td>
</tr>
<tr><td>
<br><center><font face = "ms sans serif" size = "3" color="#FF3333"><b><< <a href="add_data.php">กลับหน้าหลัก(addmin)</a> >></b></font> || <font face = "ms sans serif" size = "3" color="#FF3333"><b><< <a href="logout.php">ออกจากระบบ</a> >></b></font></center>
</td></tr>
 <tr><td colspan="3"><img src="images/footer01.png" border="0"></td></tr>
 </table>
 
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
 </BODY>
</HTML>


