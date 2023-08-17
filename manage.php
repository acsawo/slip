<?php 
session_start();
ob_start();  ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML><HEAD>
<META NAME=KEYWORDS CONTENT="Department of Medical Services(DMS)">
<META NAME=AUTHOR CONTENT="โรงพยาบาลเลิดสิน">
<META content="text/html; charset=utf8" http-equiv=Content-Type>
<TITLE>ระบบแจ้งเงินเดือนออนไลน์ โรงพยาบาลเลิดสิน</TITLE>


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
?>
<table width="768" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF">
<tr><td colspan="3"><img src="images/header01.png" border="0"></td></tr>

<tr>
<td align="center">จัดการผู้ใช้งาน<br><br>

 



<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
			<th>ลำดับที่</th>
                <th>ชื่อ-สกุล</th>
                <th>เลขประจำตัว 13 หลัก</th>
                <th>หน่วยงาน</th>
				<th>แก้ไข</th>
                
            </tr>
        </thead>

        <tbody>
<?php 
	

$query2 = "SELECT * FROM `tbmain`";
$re_chk_admin = mysqli_query($connect,$query2); 
$num =1;
while ($rs=mysqli_fetch_array($re_chk_admin,MYSQLI_BOTH)){
	
$query3 = "SELECT * FROM `tboffice` WHERE coff ={$rs['noffice']}";
$re_chk_off = mysqli_query($connect,$query3);
$rs_off=mysqli_fetch_array($re_chk_off,MYSQLI_BOTH) 	
?>		


            <tr>
                <td><?php echo $num;?></td>
                <td><?php echo $rs['prename'].$rs['nname']." ".$rs['lname'];?></td>
                <td><?php echo $rs['idno'];?></td>
				<td><?php echo $rs_off['noffice'];?></td>
                <td><a href="editprofile.php?id=<?php echo $rs['idno'];?>" target="_blank"><button class="btn"><i class="fa fa-edit"></i></button></a></td>
            </tr>
           
<?php $num++;}?> 
         
        </tbody>
        <tfoot>
            <tr>
                <th>ลำดับที่</th>
                <th>ชื่อ-สกุล</th>
                <th>เลขประจำตัว 13 หลัก</th>
                <th>หน่วยงาน</th>
				<th>แก้ไข</th>
              
            </tr>
        </tfoot>
    </table>
	</tr>
	
	<tr><td>
<br><center><font face = "ms sans serif" size = "3" color="#FF3333"><b><< <a href="allmonth.php">กลับหน้าหลัก</a> >></b></font> || <font face = "ms sans serif" size = "3" color="#FF3333"><b><< <a href="logout.php">ออกจากระบบ</a> >></b></font></center>
</td></tr>
 <tr><td colspan="3"><img src="images/footer01.png" border="0"></td></tr>
	</table>
	
 </BODY>
 </HTML>

