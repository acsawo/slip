 <?php 
// @mysql_connect("localhost", "root", "") or die("เชื่อมต่อไม่สำเร็จ มีข้อมูลผิด"); 
// @mysql_select_db("dbslip") or die("เลือกฐานข้อมูลไม่ได้"); 
// mysql_query("SET NAMES utf8") or die('Invalid quer: ' . mysql_error());


	// $connect = mysqli_connect("localhost", "slip", "", "slip");
	// $connect->set_charset('utf8');
	// $connect->query("SET NAMES 'utf8'");
	
// // $host="localhost";
// // $user="";
// // $pass="";

// // $objConnect = mssql_connect($host,$user,$pass);

// // /* $host = server,ip,computer-name
// // $user = user
// // $pass = password	 */
	
	
// // ?> 



 <?php
#  if(!function_exists('mysqli_init'))
#  {echo "we dont have";} else echo "wehave";
#exit;

$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "slip";

// Create connection
$connect = new mysqli($servername, $username, $password,$dbname);
mysqli_set_charset($connect,"utf8");
// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}
else
{
//echo "Connected successfully";
}



?> 

