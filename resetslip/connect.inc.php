<?php
	$host = "localhost" ; //HOST ปกติ เป็น 127.0.0.1 หรือ Locallhost หรือ เลข IP
	$username = "root" ; //username  SQL
	$password = "g]bflbo" ;//password  SQL
	$db = "slip" ; //ชื่อ Database
	$connect = mysql_connect($host,$username,$password) OR DIE ("ไม่สามารถติดต่อ HOST ได้ / Unable to connect to database") ;
	mysql_select_db($db) OR DIE ("ไม่สามารถติดต่อ DataBase ได้ / Unable to select database");
	mysql_query("SET NAMES UTF8"); 
?>