<?php session_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<META content="text/html; charset=utf8" http-equiv=Content-Type>
<META NAME=KEYWORDS CONTENT="lerdsin Hospital">
<META NAME=AUTHOR CONTENT="โรงพยาบาลเลิดสิน">
<TITLE>ระบบแจ้งเงินเดือนออนไลน์ โรงพยาบาลเลิดสิน</TITLE>

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



if(!isset($_SESSION['usnm']) )
{
	header("Location: frmin.php");
	exit();
} 
if(!isset($_SESSION['pswd']) )
{
header("Location: frmchkadm.php");
exit();
}

$usnm=$_SESSION['usnm'];
$pswd=$_SESSION['pswd'];
include ("connectdb.php");
include ("function.php");
$input_file_name=$_FILES['input_file']['name'];
$input_file_temp=$_FILES['input_file']['tmp_name'];

//echo $input_file_name;
//echo $input_file_temp;

if($input_file_name=="")
	{
	exit("<script>alert('กรุณาแนบไฟล์ ด้วยคะ');window.location='add_data.php';</script>");
	}
	
if((strchr($input_file_name,".")!=".TXT") && (strchr($input_file_name,".")!=".txt") )
	{
	exit("<script>alert('กรุณาแนบไฟล์ .TXT เท่านั้น');window.location='add_data.php';</script>");
	}

if(strchr($input_file_name,".")==".txt" or strchr($input_file_name,".")==".TXT" )
{
	//echo 'txt';
	$file_newname="data.txt";
}	
$source=$input_file_temp;
$target = "data/";
copy($source,$target.$file_newname);

if (!copy($source,$target.$file_newname)) {
    echo "failed to copy $file...\n";
} 
//else echo "ok";
$myfile = fopen("data/data.txt", "r") or die("Unable to open file!");
$text = fread($myfile,filesize("data/data.txt"));
$text = iconv('TIS-620','UTF-8', $text);


$data_line = explode("\n",$text); //array ที่ถูกตัดเป็นแถวๆ
$row_count = count($data_line); //จำนวนแถวที่มี

//echo "จำนวน".$row_count;
$chk = $_POST["type_person"];
$day_pay= $_POST["date_pay"];
//echo $day_pay; exit;
$num=1;

for ($x = 0; $x < $row_count; $x++) {
	$data_line[$x]=explode("$",$data_line[$x]);  

$id_person2 = $data_line[$x][2];
$prename3= $data_line[$x][3];
$name4= $data_line[$x][4];
$lname5= $data_line[$x][5];
$position =$data_line[$x][7];


 $nobank9= $data_line[$x][9];
$bookbank13= $data_line[$x][13];
$money1 = sub($data_line[$x][14]);
$money2 = sub($data_line[$x][15]);
$money3 = sub($data_line[$x][16]);
$money4 = sub($data_line[$x][17]);
$money5 = sub($data_line[$x][18]);
$money6 = sub($data_line[$x][19]);
$money7 = sub($data_line[$x][20]);
$money8 = sub($data_line[$x][21]);
$money9 = sub($data_line[$x][22]);
$money10 = sub($data_line[$x][23]);
$sumget =sub($data_line[$x][24]);
$exp1 =sub($data_line[$x][25]);
$exp2 =sub($data_line[$x][26]);
$exp3 =sub($data_line[$x][27]);
$exp4 =sub($data_line[$x][28]);
$exp5 =sub($data_line[$x][29]);
$exp6 =sub($data_line[$x][30]);
$exp7 =sub($data_line[$x][31]);
$exp8 =sub($data_line[$x][32]);
$exp9 =sub($data_line[$x][33]);
$exp10=sub($data_line[$x][34]);
$sumpay=sub($data_line[$x][35]);
$sumnet=sub($data_line[$x][36]);
//$daypay=$data_line[$x][37];
//$daypay =paydate($daypay);

$id_chk = $data_line[$x][2];
$datenow= date("Y-m-d");




/*------------------------------------------------------------------------------*/
 $sql_id_loan=" SELECT * FROM loan where id_person='$id_chk'";
//echo $sql_id_loan."<br>";
$sql_chk_id_loan =mysqli_query($connect,$sql_id_loan);
$rowcount_loan=mysqli_num_rows($sql_chk_id_loan);
$row=mysqli_fetch_array($sql_chk_id_loan,MYSQLI_ASSOC);
if($rowcount_loan==1)
{
	$exp10=$exp10-$row["amount"];
	$exp5 = $exp5+$row["amount"];	
} 

/*------------------------------------------------------------------------------*/
 $sql_id=" SELECT * FROM tbmain where idno='$id_chk'";
//echo $sql_id."<br>";
$sql_chk_id =mysqli_query($connect,$sql_id);
$rowcount=mysqli_num_rows($sql_chk_id);
//echo "จำนวนrow".$rowcount."<br>";
if($rowcount ==0)
{	//add tbmain
	// add พนักงานที่เข้าใหม่
	$sql_tbmain = "INSERT INTO tbmain(prename,nname,lname,nobank,idno,nposit,noffice,passc,cbank,chn) 
	VALUES('$prename3', '$name4', '$lname5', '$bookbank13	', '$id_person2',  '', '0', '$id_person2', $nobank9, '0')";
//echo $sql_tbmain;exit;
	mysqli_query($connect,$sql_tbmain);
	//echo $sql_tbmain ;
	//echo $num."<br>";
	$num=$num+1;
} 

/*------------------------------------------------------------------------------*/

//ad tbdetail
 $sql_add= "INSERT INTO tbdetail(nno,yy,mm,idno,nobank,money1,money2,money3,money4,money5,
money6,money7,money8,money9,money10,sumget,exp1,exp2,exp3,exp4,exp5,exp6
,exp7,exp8,exp9,exp10,sumpay,sumnet,daykey,daypay,chk) 
VALUES(0,{$data_line[$x][0]},{$data_line[$x][1]},{$data_line[$x][2]},{$data_line[$x][13]},{$money1},{$money2},{$money3},{$money4},{$money5},
{$money6},{$money7},{$money8},{$money9},{$money10},{$sumget},{$exp1},{$exp2},{$exp3},{$exp4},{$exp5},{$exp6},
{$exp7},{$exp8},{$exp9},{$exp10},{$sumpay},{$sumnet},'{$datenow}','{$day_pay}','{$chk}')";  


 echo mysqli_query($connect,$sql_add) or die ("Err Can not to ".mysqli_error($connect));


//echo $sql_add."<br><br>";
}

$num=$num-1;
$sql_upfile = "INSERT INTO file_upload(name_file,num_record,type_person,emp_new) VALUES('{$input_file_name}',{$row_count},'{$chk}','{$num}')";
mysqli_query($connect,$sql_upfile) or die ("Err Can not to ".mysqli_error($connect));

//echo "จำนวนพนักงานที่เพิ่มใหม่ได้แก่ ".($num-1)."คน<br>";
//exit;


//หัก กยศ




fclose($myfile);

mysqli_close($connect); 
exit("<script>alert('แนบไฟลเรียบร้อยแล้วค่ะ');window.location='add_data.php';</script>"); 

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

<?php
 function sub($x)
{	$y =0.0;
	$y =$x/100;
	return $y;
}

function paydate($daypay)
{
	//echo $daypay."<br>"; //26032532
	$year = substr($daypay,4,4)-543;
	$mm =substr($daypay,2,2);
	$date1=substr($daypay,0,2);
	//echo $year."-".$mm."-".$date1; exit;
return $year."-".$mm."-".$date1;	
} 


?>