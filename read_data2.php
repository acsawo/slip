<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<META content="text/html; charset=utf8" http-equiv=Content-Type>
<META NAME=KEYWORDS CONTENT="Department of Medical Services(DMS)">
<META NAME=AUTHOR CONTENT="กรมการแพทย์">
<TITLE>ระบบแจ้งเงินเดือนออนไลน์ โรงพยาบาลเลิดสิน กรมการแพทย์</TITLE>

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
 session_start();
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


$input_file_name=$_FILES['input_file']['name'];
$input_file_temp=$_FILES['input_file']['tmp_name'];

if($input_file_name=="")
	{
	exit("<script>alert('กรุณาแนบไฟล์ ด้วยคะ');window.location='add_data.php';</script>");
	}
	
	//echo $input_file_name."<br>";
	/* echo $input_file_name."<br>"; exit;
	echo $input_file_temp."<br>"; */

	if((strchr($input_file_name,".")!=".xls") && (strchr($input_file_name,".")!=".xlsx") )
	{
	exit("<script>alert('กรุณาแนบไฟล์ excel เท่านั้น');window.location='add_data.php';</script>");
	}	



if(strchr($input_file_name,".")==".xls" or strchr($input_file_name,".")==".xlsx" )
{
	//echo 'txt';
	$file_newname="data.xls";
}

$source=$input_file_temp;
$target = "./data/";
copy($source,$target.$file_newname);

echo $source."<br>";
echo $target.$file_newname."<br><br>";
 if (!copy($source,$target.$file_newname)) {
    echo "failed to copy $file...\n";
} 


require_once "PHPExcel/Classes/PHPExcel.php";

		$tmpfname = "data.xls";
		
		
		   $pathToFile = realpath("data/data.xls"); 
		$excelReader = PHPExcel_IOFactory::createReaderForFile($pathToFile);		
		$excelObj = $excelReader->load($pathToFile); 
		
		$worksheet = $excelObj->getSheet(0);
		$lastRow = $worksheet->getHighestRow();
	
$month = $_POST["month"];		
$date_pay= $_POST["date_pay"];	
$year= $_POST["year"]+543;		
$num=0;
$count_line=0;

		//echo "<table>";
		for ($row = 4; $row <= $lastRow; $row++) {
			/* if($worksheet->getCell('A'.$row)->getValue()=='')
			{ continue;} */
			 /* echo "<tr><td>";
			 echo $worksheet->getCell('B'.$row)->getValue();
			 echo "</td><td>";
			 echo $worksheet->getCell('C'.$row)->getValue();
			 echo "</td><td>";
			echo $worksheet->getCell('D'.$row)->getValue();
			 echo "</td><td>";
			 echo $worksheet->getCell('F'.$row)->getValue();
			 echo "</td><td>";
			 echo $worksheet->getCell('G'.$row)->getValue();
			 echo "</td><td>";
			 echo $worksheet->getCell('K'.$row)->getValue();
			 echo "</td><td>";
			 echo $worksheet->getCell('N'.$row)->getValue();
			 echo "</td><td>";
			 echo $worksheet->getCell('O'.$row)->getValue();
			 echo "</td><td>";
			 echo $worksheet->getCell('P'.$row)->getValue();
			 echo "</td><td>";
			 echo $worksheet->getCell('Q'.$row)->getValue();
			 echo "</td><td>";
			 echo $worksheet->getCell('U'.$row)->getValue();
			 echo "</td><td>";
			  echo $worksheet->getCell('Z'.$row)->getValue();
			 echo "</td><td>";
			 echo $worksheet->getCell('AA'.$row)->getValue();
			 echo "</td></tr>";  */
		 /* $cars[]=array($worksheet->getCell('B'.$row)->getValue(),$worksheet->getCell('C'.$row)->getValue(),$worksheet->getCell('D'.$row)->getValue(),$worksheet->getCell('F'.$row)->getValue(),
		$worksheet->getCell('G'.$row)->getValue(),$worksheet->getCell('K'.$row)->getValue(),$worksheet->getCell('N'.$row)->getValue(),$worksheet->getCell('O'.$row)->getValue(),
		
		$worksheet->getCell('P'.$row)->getValue(),$worksheet->getCell('Q'.$row)->getValue(),$worksheet->getCell('U'.$row)->getValue(),$worksheet->getCell('Z'.$row)->getValue(),$worksheet->getCell('AA'.$row)->getValue()); */	
$recive_all =$worksheet->getCell('I'.$row)->getValue()+$worksheet->getCell('Z'.$row)->getValue()+$worksheet->getCell('AA'.$row)->getValue();	
$all_pay= 	$worksheet->getCell('K'.$row)->getValue()+ $worksheet->getCell('N'.$row)->getValue()+ $worksheet->getCell('O'.$row)->getValue()+ $worksheet->getCell('P'.$row)->getValue()+ $worksheet->getCell('R'.$row)->getValue()+ $worksheet->getCell('AB'.$row)->getValue();
$all_get = $worksheet->getCell('U'.$row)->getValue()+(($worksheet->getCell('Z'.$row)->getValue()+$worksheet->getCell('AA'.$row)->getValue())-$worksheet->getCell('AB'.$row)->getValue());
 
 $money2     = zero($worksheet->getCell('AA'.$row)->getValue())  ;        //เงินเดือนตกเบิก */
$money3		 = zero($worksheet->getCell('G'.$row)->getValue())  ;  						//ค่าครองชีพ
$money4 	= zero($worksheet->getCell('Z'.$row)->getValue()) 	;					//ค่าครองชีพตกเบิก
 $exp2	= zero($worksheet->getCell('O'.$row)->getValue()) 	;								//สหกรณ์
$exp4	= zero($worksheet->getCell('N'.$row)->getValue()) 	;								//ธนาคารอาคารสงเคาะห์
$exp6	= zero($worksheet->getCell('AB'.$row)->getValue()) 	;								//ประกันสังคมตกเบิก
$exp7	= zero($worksheet->getCell('R'.$row)->getValue()) 	;								//ประกันชีวิต
$exp8	= zero($worksheet->getCell('P'.$row)->getValue()) 	;								//ธนาคารกรุงไทย
$exp9	= zero($worksheet->getCell('Q'.$row)->getValue()) 	;								//  
 
 
 $sql_add= "INSERT INTO tbdetail(yy,mm,idno,nobank,money1,money2,money3,money4,sumget,exp1,exp2,exp3,exp4,exp6
,exp7,exp8,exp9,sumpay,sumnet,daykey,daypay,chk) 
VALUES('2562',{$month},'{$worksheet->getCell('B'.$row)->getValue()}','','{$worksheet->getCell('F'.$row)->getValue()}','{$money2}','{$money3}','{$money4}',
'{$recive_all}','0','{$exp2}','{$worksheet->getCell('K'.$row)->getValue()}','{$exp4}','{$exp6}',
'{$exp7}','{$exp8}','{$exp9}','$all_pay','{$all_get}','','{$date_pay}','2')"; 
//echo $sql_add."<br>";
$id_no =$worksheet->getCell('B'.$row)->getValue();
$full_name = $worksheet->getCell('C'.$row)->getValue();
/*------------------------------------------------------------------------------*/
 $sql_id=" SELECT * FROM tbmain where idno='$id_no'";
//echo $sql_id."<br>";
$sql_chk_id =mysqli_query($connect,$sql_id);
$rowcount=mysqli_num_rows($sql_chk_id);
//echo "จำนวนrow".$rowcount."<br>";
if($rowcount ==0)
{	//add tbmain
	// add พนักงานที่เข้าใหม่
	$sql_tbmain = "INSERT INTO tbmain(prename,nname,lname,nobank,idno,nposit,noffice,passc,cbank,chn) 
	VALUES('', '{$full_name}', '', '', '{$id_no}',  '', '0', '{$id_no}', '', '0')";
	//echo $sql_tbmain;
	mysqli_query($connect,$sql_tbmain);
	$num=$num+1;
	
} 
$count_line = $count_line+1;
/*------------------------------------------------------------------------------*/
$aa = mysqli_query($connect,$sql_add);
//echo $aa."<br>".$sql_add."<br><br>";
		} 
	echo "มีจำนวนคนเพิ่ม ขึ้น ".$num; 
$sql_upfile = "INSERT INTO file_upload(name_file,num_record,type_person,emp_new) VALUES('{$input_file_name}',{$count_line},'2','{$num}')";
mysqli_query($connect,$sql_upfile) or die ("Err Can not to ".mysqli_error($connect));	
		//print_r($cars);
		//echo "</table>";
//echo count($cars);		
?>
<!--เช็คว่าอ่านมาครบทุกคอร์ลัมรึเปล่า ถ้าไม่ครบในแนบใหม่ ถ้าครบแล้วให้แอดลง db-->
</td>
</tr>
<tr><td>

<?php 
    mysqli_close($connect); 
exit("<script>alert('แนบไฟลเรียบร้อยแล้วค่ะ');window.location='add_data.php';</script>"); 
	
	
	
?>
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

function zero($aa)
{
  if($aa==null)
  {$aa = 0;}
  return $aa;
}

?>