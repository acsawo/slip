<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style.css">
  <title>Reset PaySlip Lerdsin Hospital</title>
</head>
<body>
<div class="login">

  <?php
  $idcard = $_POST['idcard'];
  // echo "<h3 style='color:white;'>เลขที่บัตรประชาชน : ".$idcard."</h3>";

include 'connect.inc.php';

 $sql = "select * from `tbmain` where `idno` = '$idcard'";
 $result = mysql_query($sql) or die ("ไม่สามารถ query คำสั่งได้ครับ") ;

 $num = mysql_num_rows($result);
 if ($num == 0 ){
   echo "<h4>ไม่พบข้อมุล ในระบบ ตรวจสอบว่า เป็นข้าราขการและ เคยได้รับเงินเดือนเข้าบัญชีแล้ว</h4>";
 }else{
  while($dbarr = mysql_fetch_array($result)){
    $nname = $dbarr['nname'];
    $lname = $dbarr['lname'];
    $chn = $dbarr['chn'];
    $idno = $dbarr['idno'];
    $passc = $dbarr['passc'];
  
  
  }
  
  if ($chn !=0){
	   echo "<h3 style='color:white;'>เลขที่บัตรประชาชน : ".$idno."</h3>";
       echo "<h3 style='color:white;'>ชื่อ : ".$nname." ".$lname."</h3>";
       echo "<h3 style='color:white;'>ต้องการ Reset Password ?</h3>";

   ?>
  <form method="post" action="reset.php">
  <input type="hidden" name="passReset" value="<?php echo $idno;  ?>">
    <button type="submit" class="btn btn-primary btn-block btn-large">Reset</button><br>
  </form>
  <button onclick="history.back()" class="btn btn-primary btn-block btn-large" >exit</button>
  <?php


  }else{
	  echo "<h3 style='color:white;'>ยังไม่เคยเข้าระบบ ให้ใช้ Password เป็น เลขที่บัตรประชาชน </h3>";
	  echo "<button onclick='history.back()' class='btn btn-primary btn-block btn-large' >exit</button>";
	  $ipaddress = "\n".$_SERVER['REMOTE_ADDR'];    
  }
  
   }
  ?>

</div>
</body>
</html>


