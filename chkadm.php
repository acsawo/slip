<?php
session_start();
include ("connectdb.php"); 

if(!isset($_SESSION['usnm']) )
{
	echo "<script type='text/javascript'>window.location.href = 'frmin.php';</script>";
	//header("Location: frmin.php");
	exit();
}

/* if($_SESSION['usnm'] == "")
{

} */
 $usnm=$_SESSION['usnm'];
$pswd=$_POST['pswd'];

$rtdt = "SELECT pswadm, cnt, daylgin, idno FROM tbchkadm WHERE pswadm = '".mysqli_real_escape_string($connect,$_POST['pswd'])."' and idno= '".mysqli_real_escape_string($connect,$usnm)."'";
//echo $rtdt;


$objQuery = mysqli_query($connect,$rtdt);
$rs = mysqli_fetch_array($objQuery,MYSQLI_BOTH);
$_SESSION["pswd"] = $rs["pswadm"];
session_write_close();
$row_chk=mysqli_num_rows($objQuery);


if($row_chk==0)
{
	//aleart บอกรหัสผิด
	exit ("<script>alert('รหัสผิด โปรดใส่รหัสใหม่');window.location='allmonth.php';</script>");
	mysql_close();
}
else
{
	//echo "รหัสถูก";
 $vcnt = $rs["cnt"]+1;
$query2 = "update tbchkadm set idno='$usnm', cnt='$vcnt'   where pswadm = '$pswd' ";
$result = mysqli_query($connect,$query2) or die(mysqli_error());
	echo "<script type='text/javascript'>window.location.href = 'getidchk.php';</script>";
//header("Location: getidchk.php");
mysqli_close($connect);	
	
}
/* if(!$rs)
{
//aleart บอกรหัสผิด
exit ("<script>alert('รหัสผิด โปรดใส่รหัสใหม่');window.location='allmonth.php';</script>");
//header("Location: allmonth.php");
mysql_close();
}else {
$vcnt = $rs["cnt"]+1;
$query2 = "update tbchkadm set idno='$usnm', cnt='$vcnt', daylgin=now()  where pswadm = '$pswd' ";
$result = mysqli_query($connect,$query2) or die(mysqli_error());
header("Location: getidchk.php");
mysqli_close();
} */ 
?>