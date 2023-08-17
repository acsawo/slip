<?php session_start();  ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML><HEAD>
<META NAME=KEYWORDS CONTENT="Department of Medical Services(DMS)">
<META NAME=AUTHOR CONTENT="กรมการแพทย์">
<META content="text/html; charset=utf8" http-equiv=Content-Type>
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


if($_SESSION['usnm'] == "")

{

header("Location: frmin.php");

exit();

}

if(isset($_GET["id"]))
{$id_person =$_GET["id"];}



$query2 = "SELECT * FROM `tbmain` where idno={$id_person}";
$re = mysqli_query($connect,$query2); 
$rs=mysqli_fetch_array($re,MYSQLI_BOTH);




?>
<table width="768" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF">
<tr><td colspan="3"><img src="images/header01.png" border="0"></td></tr>

<tr>
<td>
<div class="container">
  <div class="row">
    <div class="col">
    
    </div>
    <div class="col-6">
      <form action="editprofile1.php" method="post">
	   <div class="form-group">

    <input type="hidden" class="form-control" name="id_person" value="<?php echo $rs["idno"];?>">
  </div>
  <div class="form-group">
    <label for="email">คำนำหน้าชื่อ:</label>
    <input type="text" class="form-control" name="prename" value="<?php echo $rs["prename"];?>">
  </div>
  <div class="form-group">
    <label for="pwd">ชื่อ:</label>
    <input type="text" class="form-control" name="nname" value="<?php echo $rs["nname"];?>">
  </div>
  <div class="form-group">
    <label for="pwd">นามสกุล:</label>
    <input type="text" class="form-control" name="lname" value="<?php echo $rs["lname"];?>">
  </div>
       <div class="form-group">
    <label for="pwd">ธนาคาร:</label>
	<select name="bank" id="" class="form-control" name="agcy">
	<?php
	$query4 = "select * from `tbbank`";
$re4 = mysqli_query($connect,$query4); 

//$rs3=mysqli_fetch_array($re3,MYSQLI_BOTH);
	?>
					<option value="">---เลือกธนาคาร---</option>
					<?php  while($rs4=mysqli_fetch_array($re4,MYSQLI_BOTH)) {?>
					  <option value="<?php echo $rs4["cbank"];?>"  <?php if($rs["cbank"]==$rs4["cbank"]){echo "selected";}?>> <?php echo $rs4["namebank"];?></option> 
					<?php }?>
						
						</select> 
  
  </div>
  <div class="form-group">
    <label for="pwd">เลขบัญชี:</label>
    <input type="text" class="form-control" name="bank_no" value="<?php echo $rs["nobank"];?>">
  </div>
   <div class="form-group">
    <label for="pwd">หน่วยงาน:</label>
	<select name="agency" id="" class="form-control" name="agcy">
	<?php
	$query3 = "select * from `tboffice`";
$re3 = mysqli_query($connect,$query3); 

//$rs3=mysqli_fetch_array($re3,MYSQLI_BOTH);
	?>
					<option value="">---เลือกหน่วยงาน---</option>
					<?php  while($rs3=mysqli_fetch_array($re3,MYSQLI_BOTH)) {?>
					  <option value="<?php echo $rs3["coff"];?>"  <?php if($rs["noffice"]==$rs3["coff"]){echo "selected";}?>> <?php echo $rs3["noffice"];?></option> 
					<?php }?>
						
						</select> 
  
  </div>
   <div class="form-group">
    <label for="pwd">ตำแหน่ง:</label>
    <input type="text" class="form-control" name="position" value="<?php echo $rs["nposit"];?>">
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>
    </div>
    <div class="col">
      
    </div>
  </div>
</div>

</td>
</tr>

	
	<tr><td>
<br><center><font face = "ms sans serif" size = "3" color="#FF3333"><b><< <a href="allmonth.php">กลับหน้าหลัก</a> >></b></font> || <font face = "ms sans serif" size = "3" color="#FF3333"><b><< <a href="logout.php">ออกจากระบบ</a> >></b></font></center>
</td></tr>
 <tr><td colspan="3"><img src="images/footer01.png" border="0"></td></tr>
	</table>
	
 </BODY>
 </HTML>

