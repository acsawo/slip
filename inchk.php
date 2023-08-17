<?php
session_start();
ob_start();
include ("connectdb.php"); 
$rtdt = "SELECT idno, passc, nname, chn FROM tbmain WHERE idno = '".mysqli_real_escape_string($connect,$_POST['usnm'])."'and passc = '".mysqli_real_escape_string($connect,$_POST['pswd'])."'";
$objQuery = mysqli_query($connect,$rtdt);
$rs = mysqli_fetch_array($objQuery,MYSQLI_BOTH);
if(!$rs){
		header("Location: frminwrong.php");
		}else{
		$_SESSION["usnm"] = $rs["idno"];
		session_write_close();
			if ($rs["chn"]==0){
				header("location:chdetail.php");
				mysqli_close($connect);
				}else{
				header("location:allmonth.php");
				mysqli_close($connect);
				}
}
?>