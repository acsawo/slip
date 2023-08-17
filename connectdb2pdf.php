<?php
//$hstname = "localhost";
//$dtbase = "dbslip";
//$usern = "nameuser";
//$passw = "passlogin";
//$connectdb = mysql_pconnect($hstname, $usern, $passw) or trigger_error(mysql_error(),E_USER_ERROR); 
//mysql_query("SET NAMES utf8") or die('Invalid quer: ' . mysql_error());

	$connect = mysqli_connect("localhost", "root", "g]bflbo", "slip");
	$connect->set_charset('utf8');
	$connect->query("SET NAMES 'utf8'");
?>