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
include 'connect.inc.php';

$passReset = $_POST['passReset'];

echo "<h3 style='color:white;text-align:center;'>หมายเลขบัตรประชาชน : ".$passReset."</h3>";
$sql = "UPDATE `tbmain` SET `passc` = '$passReset' , `chn` = '0' where `idno` = '$passReset'";
if (mysql_query($sql)){
    echo '<h1>ได้ทำการ <Br> Reset Password <br>เรียบร้อยแล้ว</h1>';
}else{
    echo '<h4>Error Update Password </h4>';
}
echo "<meta http-equiv='refresh' content='1;URL=index.php'>";
?>

<?php
$notepad = 'log.txt';
//$fp = fopen("$notepad", "r");        
$ipaddress = "\n".$passReset."  ".$_SERVER['REMOTE_ADDR']."  ".date('Ymd- H:i:s');  
$datelog =                 
//$count = fread($fp, 1024); 
//fclose($fp); 
//$count = $count + 1; 
//echo "<p>จำนวนผู้เข้าชม : " . $count . " ครั้ง</p>"; 
$fp = fopen("$notepad", "a"); 
fwrite($fp,$ipaddress); 
fclose($fp); 
?>

</div>
</body>
</html>


