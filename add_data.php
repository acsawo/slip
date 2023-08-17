<?php session_start(); ?>
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
	//error_reporting(E_ALL);
		//ini_set('display_errors', 0);

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
?>


<div class="well well-lg">
  <h6>**ก่อนเพิ่มข้อมูลกรุณาตรวจสอบความถูกต้องของข้อมูล เงินกู้เพื่อการศึกษาก่อน**</h6>
  <br>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#home">จัดการรายชื่อบุคลากรที่กู้เกิน กยศ.</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu1">นำเข้าข้อมูล</a>
    </li>
  <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu2">ประวัติการนำเข้าข้อมูล</a>
    </li>
  </ul>

  <!-- Tab panes -->
 
  <div class="tab-content">
    <div id="home" class="container tab-pane active"><br>
      <!--<h3>HOME</h3>-->
	  <br>
       	<a href="add_loan.php" class="btn btn-info" role="button">เพิ่ม</a> 
		
		<table class="table table-bordered ">
    <thead>
      <tr>
		<th>ลำดับที่</th>
        <th>เลขประจำตัวประชาชน</th>
        <th>ชื่อ-สกุล</th>
        <th>จำนวนเงินที่หัก</th>
		<th>แก้ไข</th>
      </tr>
    </thead>
<?php
$sql ="SELECT * FROM loan LEFT JOIN tbmain on loan.id_person = tbmain.idno";
$result  = mysqli_query($connect,$sql);
/*  if (!$result){
       die('Error: ' . mysqli_error($connect));
    } 
if (mysqli_num_rows($result) >= 1 ) { echo "yahoo it worked! "; }	
echo mysqli_num_rows($result);*/
$num =1;
	
/*if(isset($_FILES['image'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size = $_FILES['image']['size'];
      $file_tmp = $_FILES['image']['tmp_name'];
      $file_type = $_FILES['image']['type'];
$file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));}*/

?>
    <tbody>
<?php while($rs = mysqli_fetch_array($result))
{?>
      <tr>
		<td><?php echo $num;?></td>
		<td><?php echo $rs["id_person"];?></td>
        <td><?php echo $rs["prename"].$rs["nname"]." ".$rs["lname"];?></td>
        <td><?php echo  number_format($rs["amount"],2);?></td>
       
		<td><a href="loan_edit.php?id_person=<?php echo $rs["id"]; ?>" class="btn btn-info" role="button"><i class="fa fa-edit"></i></a></td>
      </tr>
 <?php $num=$num+1;}?>    
    </tbody>
  </table>
    </div>
	<!------------------------------------------------------------------------->
    <div id="menu1" class="container tab-pane fade"><br>

<div class="container"> 
			<div class="panel-heading  green text-primary" data-toggle="collapse" data-target="#demo1"><h2><center>ข้าราชการ</center><h2></div>
				<div class="panel-body panel-collapse collapse in border" id="demo1" >
					<br>
					 <form class="form-inline" action="read_data.php" method = "POST" enctype="multipart/form-data">
						<div class="row">
							<div class="col-sm-12">
							 * กรุณาเลือกไฟลที่ถูก Export ออกมาจากกรมบัญชีกลาง<br>*  เป็นไฟล์ที่มีนามสกุลเป็น .txt <br>
							 *  ใส่วันที่โอนเงินเข้า <br>
							</div>
						</div>
					 <hr>
					 <br>

					<!--<label for="file1">เลือกไฟล์ที่จะนำเข้าข้อมูล: </label>--><br>
						 <div class="row">
							<div class="col-sm-12">
							<input type="file" name="input_file" class="form-control" id="input_file" placeholder="เลือกไฟล์ที่จะนำเข้าข้อมูล"  accept=".txt">
							<input type="date" name="date_pay" class="form-control" id="input_file" placeholder="เลือกวันที่โอนเงินเข้า"  >
							<input type="hidden" name="type_person" class="form-control" id="type_person" value="0">
					<button type="submit" class="btn btn-primary">Submit</button>
						</div>
						</div> 
					</form>


				</div>
</div>
<div class="container"> 
			<div class="panel-heading  green text-primary" data-toggle="collapse" data-target="#demo2"><h2><center>ลูกจ้างประจำ</center><h2></div>
				<div class="panel-body panel-collapse collapse in border" id="demo2" >
					<br>
					 <form class="form-inline" action="read_data.php" method = "POST" enctype="multipart/form-data">
						<div class="row">
							<div class="col-sm-12">
							 * กรุณาเลือกไฟลที่ถูก Export ออกมาจากกรมบัญชีกลาง<br>*  เป็นไฟล์ที่มีนามสกุลเป็น .txt <br>
							 *  ใส่วันที่โอนเงินเข้า <br>
							</div>
						</div>
					 <hr>
					 <br>

					<!--<label for="file1">เลือกไฟล์ที่จะนำเข้าข้อมูล: </label>--><br>
						 <div class="row">
							<div class="col-sm-12">
							<input type="file" name="input_file" class="form-control" id="input_file" placeholder="เลือกไฟล์ที่จะนำเข้าข้อมูล"  accept=".txt">
							<input type="date" name="date_pay" class="form-control" id="input_file" placeholder="เลือกวันที่โอนเงินเข้า"  >
							<input type="hidden" name="type_person" class="form-control" id="type_person" value="1">
					<button type="submit" class="btn btn-primary">Submit</button>
						</div>
						</div> 
					</form>


				</div>
</div>
<div class="container"> 
			<div class="panel-heading  green text-primary" data-toggle="collapse" data-target="#demo3"><h2><center>พนังงานราชการ</center><h2></div>
				<div class="panel-body panel-collapse collapse in border" id="demo3" >
					<br>
					 <form class="form-inline" action="read_data2.php" method = "POST" enctype="multipart/form-data">
						<div class="row">
							<div class="col-sm-12">
							*  เลือกไฟล์ <br><br>
						
							</div>
						</div>
					 <hr>
					 <br>

					<!--<label for="file1">เลือกไฟล์ที่จะนำเข้าข้อมูล: </label>--><br>
						 <div class="row">
							<div class="col-sm-12">
							<input type="file" name="input_file" class="form-control" id="input_file" placeholder="เลือกไฟล์ที่จะนำเข้าข้อมูล"  accept=".xlsx,.xls">
							<input type="hidden" name="type_person" class="form-control" id="type_person" value="2">
		
							<input type="date" name="date_pay" class="form-control" id="input_file" placeholder="เลือกวันที่โอนเงินเข้า"  >
							
							<select name="month"  >
							  <option value="1">มกราคม</option>
							  <option value="2">กุมภาพันธ์</option>
							  <option value="3">มีนาคม</option>
							  <option value="4">เมษายน</option>
							  <option value="5">พฤษภาคม</option>
							  <option value="6">มิถุนายน</option>
							  <option value="7">กรกฎาคม</option>
							  <option value="8">สิงหาคม</option>
							  <option value="9">กันยายน</option>
							  <option value="10">ตุลาคม</option>
							  <option value="11">พฤศจิกายน</option>
							  <option value="12">ธันวาคม</option>
							</select>
							<select name="year"  >
							  <option value="<?php echo date('Y')-1;?>"><?php echo date('Y')-1;?></option>
							  <option value="<?php echo date('Y');?>" selected><?php echo date('Y');?></option>
							  <option value="<?php echo date('Y')+1;?>"><?php echo date('Y')+1;?></option>
						
							</select>
					<button type="submit" class="btn btn-primary">Submit</button>
						</div>
						</div> 
						
					</form>


				</div>
</div>
 <!--<div class="container"> 
	<div class="panel-heading  text-primary" data-toggle="collapse" data-target="#demo3"><h2><center>พนักงานราชการ</center><h2></div>
    <div class="panel-body panel-collapse collapse in border" id="demo3" >
	<br>
	
	 <form class="form-inline" action="/action_page.php">
		<div class="row">
							<div class="col-sm-12">
							 *  ใส่วันที่โอนเงินเข้า <br><br>
							</div>
						</div>
			<input type="file" class="form-control" id="file1" placeholder="เลือกไฟล์ที่จะนำเข้าข้อมูล" name="file" accept=".xlsx">
			<input type="date" name="date_pay" class="form-control" id="input_file" placeholder="เลือกวันที่โอนเงินเข้า"  >
			<input type="hidden" name="type_person" class="form-control" id="type_person" value="2">
		<hr>
		
    <button type="submit" class="btn btn-primary">Submit</button>
	</form>


	</div>
 </div>  -->
 

</div>
  <!------------------------------------------------------------------------->
  <!--ให้แสดงแค่ 20 recode ปัจจุบัน-->
     <div id="menu2" class="container tab-pane fade"><br>
        <table class="table table-bordered">
    <thead>
      <tr>
		<th>วันที่</th>
		<th>ชื่อไฟล์</th>
        <th>จำนวนข้อมูล</th>
        <th>ชนิดของบุคลากร</th>
		<th>จำนวนบุคลาก่อนใหม่</th>
      </tr>
    </thead>
<?php
$sql_log ="SELECT * FROM file_upload order by id_file DESC";
$result1  = mysqli_query($connect,$sql_log);
/*  if (!$result){
       die('Error: ' . mysqli_error($connect));
    } 
if (mysqli_num_rows($result) >= 1 ) { echo "yahoo it worked! "; }	
echo mysqli_num_rows($result);*/
$num =1;
	

?>
    <tbody>
<?php while($rs1 = mysqli_fetch_array($result1))
{?>
      <tr>
	  <td><?php echo $rs1["last_update"]?></td>
		<td><?php echo $rs1["name_file"]?></td>
		<td><?php echo $rs1["num_record"]?></td>
       <?php $sst =$rs1["type_person"];
				if($sst=='0'){$sstt='ข้าราชการ';}
				if($sst=='1'){$sstt='ลูกจ้างประจำ';}
				if($sst=='2'){$sstt='พนักงานราชการ';}
		?>
        <td><?php echo $sstt;?></td>
        <td><?php echo $rs1["emp_new"]?></td>
      </tr>
<?php }?>  
    </tbody>
  </table>

 

</div>
  </div>
</div>



<?php
mysqli_close($connect); 
?>

</td>
</tr>
<tr><td>
<br><center><font face = "ms sans serif" size = "3" color="#FF3333"><b><< <a href="allmonth.php">กลับหน้าหลัก</a> >></b></font> || <font face = "ms sans serif" size = "3" color="#FF3333"><b><< <a href="logout.php">ออกจากระบบ</a> >></b></font></center>
</td></tr>
 <tr><td colspan="3"><img src="images/footer01.png" border="0"></td></tr>
 </table>
 
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
 </BODY>
</HTML>


