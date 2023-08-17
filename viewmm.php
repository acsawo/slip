<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<META content="text/html; charset=utf8" http-equiv=Content-Type>
<META NAME=KEYWORDS CONTENT="Department of Medical Services(DMS)">
<META NAME=AUTHOR CONTENT="กรมการแพทย์">
<TITLE>ระบบแจ้งเงินเดือนออนไลน์ โรงพยาบาลเลิดสิน กรมการแพทย์</TITLE>
<HTML>
<?php
include ("connectdb.php"); 
include ("function.php"); 

$vrec = $_GET['vrec']; 

function num2thai($number){
$t1 = array("ศูนย์", "หนึ่ง", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า");
$t2 = array("เอ็ด", "ยี่", "สิบ", "ร้อย", "พัน", "หมื่น", "แสน", "ล้าน");
$zerobahtshow = 0; // ในกรณีที่มีแต่จำนวนสตางค์ เช่น 0.25 หรือ .75 จะให้แสดงคำว่า ศูนย์บาท หรือไม่ 0 = ไม่แสดง, 1 = แสดง
(string) $number;
$number = explode(".", $number);
if(!empty($number[1])){
if(strlen($number[1]) == 1){
$number[1] .= "0";
}else if(strlen($number[1]) > 2){
if($number[1]{2} < 5){
$number[1] = substr($number[1], 0, 2);
}else{
$number[1] = $number[1]{0}.($number[1]{1}+1);
}
}
}

for($i=0; $i<count($number); $i++){
$countnum[$i] = strlen($number[$i]);
if($countnum[$i] <= 7){
$var[$i][] = $number[$i];
}else{
$loopround = ceil($countnum[$i]/6);
for($j=1; $j<=$loopround; $j++){
if($j == 1){
$slen = 0;
$elen = $countnum[$i]-(($loopround-1)*6);
}else{
$slen = $countnum[$i]-((($loopround+1)-$j)*6);
$elen = 6;
}
$var[$i][] = substr($number[$i], $slen, $elen);
}
} 

$nstring[$i] = "";
for($k=0; $k<count($var[$i]); $k++){
if($k > 0) $nstring[$i] .= $t2[7];
$val = $var[$i][$k];
$tnstring = "";
$countval = strlen($val);
for($l=7; $l>=2; $l--){
if($countval >= $l){
$v = substr($val, -$l, 1);
if($v > 0){
if($l == 2 && $v == 1){
$tnstring .= $t2[($l)];
}elseif($l == 2 && $v == 2){
$tnstring .= $t2[1].$t2[($l)];
}else{
$tnstring .= $t1[$v].$t2[($l)];
}
}
}
}
if($countval >= 1){
$v = substr($val, -1, 1);
if($v > 0){
if($v == 1 && $countval > 1 && substr($val, -2, 1) > 0){
$tnstring .= $t2[0];
}else{
$tnstring .= $t1[$v];
}

}
}

$nstring[$i] .= $tnstring;
}

}
$rstring = "";
if(!empty($nstring[0]) || $zerobahtshow == 1 || empty($nstring[1])){
if($nstring[0] == "") $nstring[0] = $t1[0];
$rstring .= $nstring[0]."บาท";
}
if(count($number) == 1 || empty($nstring[1])){
$rstring .= "ถ้วน";
}else{
$rstring .= $nstring[1]."สตางค์";
}
return $rstring;
}

$rtdt = "SELECT tbdetail.nauto, tbdetail.nno, tbdetail.idno, tbmain.nname, tbmain.nposit, tboffice.noffice, tbdetail.money1, tbdetail.money2, tbdetail.money3, tbdetail.exp1, tbdetail.exp5, tbdetail.exp6, tbdetail.exp7, tbdetail.exp4, tbdetail.exp3, tbdetail.exp2, tbdetail.exp8, tbdetail.money4, tbdetail.money4txt, tbdetail.money5, tbdetail.money5txt, tbdetail.money6, tbdetail.money6txt, tbdetail.money7, tbdetail.money8, tbdetail.money9, tbdetail.money10, tbdetail.money10txt, tbdetail.exp9, tbdetail.exp9txt, tbdetail.daypay, tbdetail.mm, tbmonth.nmonth, tbdetail.yy, tbmain.nobank, tbbank.namebank, tbbank.sakhabank
FROM (((tbmain RIGHT JOIN tbdetail ON tbmain.idno = tbdetail.idno) LEFT JOIN tbbank ON tbmain.cbank = tbbank.cbank) LEFT JOIN tboffice ON tbmain.noffice = tboffice.coff) LEFT JOIN tbmonth ON tbdetail.mm = tbmonth.mm
WHERE (((tbdetail.nauto)=$vrec))
ORDER BY tbdetail.mm DESC; ";
//rtdt = retrive data, rsdt = resource data
$rsdt = mysqli_query($connect,$rtdt); 
$nrows=mysqli_num_rows($rsdt);
$rs=mysqli_fetch_array($rsdt,MYSQLI_BOTH);
$sumget=$rs['money1']+$rs['money2']+$rs['money3']+$rs['money4']+$rs['money5']+$rs['money6']+$rs['money7']+$rs['money8']+$rs['money9']+$rs['money10'];
$sumpay=$rs['exp1']+$rs['exp2']+$rs['exp3']+$rs['exp4']+$rs['exp5']+$rs['exp6']+$rs['exp7']+$rs['exp8']+$rs['exp9'];
$sumnet=$sumget-$sumpay;
?>

<script language="javascript">
function printpr()
{
var OLECMDID = 7;
/* OLECMDID values:
* 6 - print
* 7 - print preview
* 1 - open window
* 4 - Save As
*/
var PROMPT = 1; // 2 DONTPROMPTUSER
var WebBrowser = '<OBJECT ID="WebBrowser1" WIDTH=0 HEIGHT=0 CLASSID="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2"></OBJECT>';
document.body.insertAdjacentHTML('beforeEnd', WebBrowser);
WebBrowser1.ExecWB(OLECMDID, PROMPT);
WebBrowser1.outerHTML = "";
}
</script>

<SCRIPT type=text/javascript>   
function printDiv(divName) {   
     var printContents = document.getElementById(divName).innerHTML;   
     var originalContents = document.body.innerHTML;     
     document.body.innerHTML = printContents;   
     printpr();   
     document.body.innerHTML = originalContents;   
}   
</SCRIPT>  

<BODY background="images/bkgnd05.png">
<center><INPUT onclick="window.open('viewmmpdf.php?vrec=<?php echo $vrec; ?>','_blank');"  value="พิมพ์ใบแจ้งเงินเดือน (PDF) ด้วย IE และ Chrome" type=button> <font face = "ms sans serif" size = "3" color="#FF0000"><b>||</b></font> <INPUT onclick="window.location='allmonth.php';" value="กลับหน้าแรก" type=button> <font face = "ms sans serif" size = "3" color="#FF0000"><b>||</b></font> <INPUT onclick="window.location='logout.php';" value="ออกจากระบบ" type=button></center><br>
<div id=divprint>
<center><font face = "ms sans serif" size = "3" color="#FF00FF">!!</font> <font color="#0000FF">ขออภัยค่ะ..ขอให้ใช้ IE หรือ Chrome เพื่อพิมพ์ (Print) ออกกระดาษได้ครบถ้วนและสวยงามค่ะ</font> <font face = "ms sans serif" size = "3" color="#FF00FF">!!</font></center>
<center><table cellspacing="0" cellpadding="0" width="90%" border="1"><tr><td>
<table cellspacing="0" cellpadding="0" width="100%" border="0"  bgcolor="#FFFFFF">
<tr><td>&nbsp;</td></tr>
<tr><td align="center">
<table cellspacing="0" cellpadding="0" width="90%" border="0">
<tr><td width="100" align="center"><img src="images/logo MOPH.png" border="0" width="80"></td>
<td align="left"><font face = "ms sans serif" size = "5"><b>กรมการแพทย์ <br>ใบแสดงรายการโอนเงินเข้าบัญชีเงินเดือน</b></font></td>
<td align="right">&nbsp;</td>
</tr>
</table><br>
<table cellspacing="0" cellpadding="0" width="90%" border="0">
<tr><td width="53%" colspan="3" align="left"><font face = "ms sans serif" size = "3">ประจำเดือน : <?php echo $rs['nmonth'], "&nbsp;", $rs['yy']; ?></font> </td>
<td width="4%">&nbsp;</td>
<td width="43%" colspan="3" align="left"><font face = "ms sans serif" size = "3">โอนเงินเข้าวันที่ : <?php echo $rs['daypay']; ?></font></td></tr>
<tr><td colspan="3" align="left"><font face = "ms sans serif" size = "3">ชื่อ-สกุล : <?php echo $rs['nname']; ?></font> </td>
<td >&nbsp;</td>
<td colspan="3" align="left"><font face = "ms sans serif" size = "3">ชื่อธนาคาร : </font><font face = "ms sans serif" size = "3"> <?php echo $rs['namebank'], "&nbsp;", $rs['sakhabank']; ?></font></td></tr>
<tr><td colspan="3" align="left"><font face = "ms sans serif" size = "3">หน่วยงาน : <?php echo $rs['noffice']; ?></font> </td>
<td>&nbsp;</td>
<td colspan="3" align="left"><font face = "ms sans serif" size = "3">เลขที่บัญชี : <?php echo $rs['nobank']; ?></font></td></tr>
<tr><td colspan="3" align="center"><font face = "ms sans serif" size = "3"><b><u>รายการรับ</u></b></font></td><td>&nbsp;</td>
<td colspan="3" align="center"><font face = "ms sans serif" size = "3"><b><u>รายการหัก</u></b></font></td></tr>
<tr><td width="40%"><font face = "ms sans serif" size = "3">1. เงินเดือน/ค่าจ้าง/ค่าตอบแทน</font></td><td>&nbsp;</td>
<td  width="10%" align="right"><font face = "ms sans serif" size = "3"><?php echo number_format($rs['money1'],2); ?> บาท</font></td>
<td>&nbsp;</td>
<td width="30%"><font face = "ms sans serif" size = "3">1. ภาษีเงินได้</font></td><td>&nbsp;</td>
<td  width="10%" align="right"><font face = "ms sans serif" size = "3"><?php echo number_format($rs['exp1'],2); ?> บาท</font></td></tr>
<tr><td><font face = "ms sans serif" size = "3">2. เงินประจำตำแหน่ง/เงินตอบแทนรายเดือน</font></td><td>&nbsp;</td>
<td align="right"><font face = "ms sans serif" size = "3"><?php echo number_format($rs['money2'],2); ?> บาท</font></td>
<td>&nbsp;</td>
<td><font face = "ms sans serif" size = "3">2. กบข./กสจ./ประกันสังคม</font></td><td>&nbsp;</td>
<td align="right"><font face = "ms sans serif" size = "3"><?php echo number_format($rs['exp2'],2); ?> บาท</font></td></tr>
<tr><td><font face = "ms sans serif" size = "3">3. เงินเพิ่มค่าครองชีพฯ</font></td><td>&nbsp;</td>
<td align="right"><font face = "ms sans serif" size = "3"><?php echo number_format($rs['money3'],2); ?> บาท</font></td>
<td>&nbsp;</td>
<td><font face = "ms sans serif" size = "3">3. ฌกส.</font></td><td>&nbsp;</td>
<td align="right"><font face = "ms sans serif" size = "3"><?php echo number_format($rs['exp3'],2); ?> บาท</font></td></tr>
<tr valign="top"><td><font face = "ms sans serif" size = "3">4. เงินเดือน/ค่าจ้าง/ค่าตอบแทน ตกเบิก  ( <?php echo $rs['money4txt']; ?> )</font></td><td>&nbsp;</td>
<td align="right"><font face = "ms sans serif" size = "3"><?php echo number_format($rs['money4'],2); ?> บาท</font></td>
<td>&nbsp;</td>
<td><font face = "ms sans serif" size = "3">4. ธนาคารอาคารสงเคราะห์</font></td><td>&nbsp;</td>
<td align="right"><font face = "ms sans serif" size = "3"><?php echo number_format($rs['exp4'],2); ?> บาท</font></td></tr>
<tr><td><font face = "ms sans serif" size = "3">5. เงินประจำตำแหน่ง/เงินตอบแทนรายเดือน ตกเบิก ( <?php echo $rs['money5txt']; ?> )</font></td><td>&nbsp;</td>
<td align="right"><font face = "ms sans serif" size = "3"><?php echo number_format($rs['money5'],2); ?> บาท</font></td>
<td>&nbsp;</td>
<td><font face = "ms sans serif" size = "3">5. ธนาคารกรุงไทย จำกัด</font></td><td>&nbsp;</td>
<td align="right"><font face = "ms sans serif" size = "3"><?php echo number_format($rs['exp5'],2); ?> บาท</font></td></tr>
<tr><td><font face = "ms sans serif" size = "3">6. เงินเพิ่มค่าครองชีพฯ ตกเบิก ( <?php echo $rs['money6txt']; ?> )</font></td><td>&nbsp;</td>
<td align="right"><font face = "ms sans serif" size = "3"><?php echo number_format($rs['money6'],2); ?> บาท</font></td>
<td>&nbsp;</td>
<td><font face = "ms sans serif" size = "3">6. ธนาคารออมสิน</font></td><td>&nbsp;</td>
<td align="right"><font face = "ms sans serif" size = "3"><?php echo number_format($rs['exp6'],2); ?> บาท</font></td></tr>
<tr><td><font face = "ms sans serif" size = "3">7. เงินค่าตอบแทนพิเศษ (กรณีเงินเดือนเต็มขั้น)</font></td><td>&nbsp;</td>
<td align="right"><font face = "ms sans serif" size = "3"><?php echo number_format($rs['money7'],2); ?> บาท</font></td>
<td>&nbsp;</td>
<td><font face = "ms sans serif" size = "3">7. สหกรณ์ออมทรัพย์</font></td><td>&nbsp;</td>
<td align="right"><font face = "ms sans serif" size = "3"><?php echo number_format($rs['exp7'],2); ?> บาท</font></td></tr>
<tr><td><font face = "ms sans serif" size = "3">8. เงิน พตส.</font></td><td>&nbsp;</td>
<td align="right"><font face = "ms sans serif" size = "3"><?php echo number_format($rs['money8'],2); ?> บาท</font></td>
<td>&nbsp;</td>
<td><font face = "ms sans serif" size = "3">8. ส่งคืนคลัง</font></td><td>&nbsp;</td>
<td align="right"><font face = "ms sans serif" size = "3"><?php echo number_format($rs['exp8'],2); ?> บาท</font></td></tr>
<tr><td><font face = "ms sans serif" size = "3">9. เงินตอบแทนค่ารถประจำตำแหน่ง</font></td><td>&nbsp;</td>
<td align="right"><font face = "ms sans serif" size = "3"><?php echo number_format($rs['money9'],2); ?> บาท</font></td>
<td>&nbsp;</td>
<td><font face = "ms sans serif" size = "3">9. อื่นๆ ( <?php echo $rs['exp9txt']; ?> )</font></td><td>&nbsp;</td>
<td align="right"><font face = "ms sans serif" size = "3"><?php echo number_format($rs['exp9'],2); ?> บาท</font></td></tr>
<tr><td><font face = "ms sans serif" size = "3">10. อื่นๆ ( <?php echo $rs['money10txt']; ?> )</font></td><td>&nbsp;</td>
<td align="right"><font face = "ms sans serif" size = "3"><?php echo number_format($rs['money10'],2); ?> บาท</font></td>
<td>&nbsp;</td>
<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td><font face = "ms sans serif" size = "3">รวมรับทั้งหมด</font></td><td>&nbsp;</td>
<td align="right"><font face = "ms sans serif" size = "3"><?php echo number_format($sumget,2); ?> บาท</font></td>
<td>&nbsp;</td>
<td><font face = "ms sans serif" size = "3">รวมหักทั้งหมด</font></td><td>&nbsp;</td>
<td align="right"><font face = "ms sans serif" size = "3"><?php echo number_format($sumpay,2); ?> บาท</font></td></tr>
<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td><font face = "ms sans serif" size = "3"><b>รับสุทธิ</b></font></td><td>&nbsp;</td>
<td align="right"><font face = "ms sans serif" size = "3"><b><?php echo number_format($sumnet,2); ?></b> บาท</font></td>
<td>&nbsp;</td>
<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td colspan="3" align="right"><font face = "ms sans serif" size = "3">(<?php echo num2thai($sumnet); ?>)</font></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
<td colspan="3" align="center"><img src="images/sign.png" border="0"><br>
<font face = "ms sans serif" size = "3">ลงชื่อ ................................................<br>
(นางปวีณา&nbsp;&nbsp;&nbsp;เอี๋ยวพิทักษ์)<br>
นักวิชาการเงินและบัญชีชำนาญการ<br>
กลุ่มคลังและพัสดุ<br></font>
<font color="#CCCCCC" size="-1">(พิมพ์วันที่ 
<?php 
echo DateThai(date("Y-m-d"));
 ?>
)</font></td></tr>
<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
</table>
</td></tr>
<tr><td align="left"><br><dd><font face = "ms sans serif" size = "3" color="#FF0000"><b>หมายเหตุ :</b>
<br><dd>1. กรุณาตรวจสอบข้อมูลหากไม่ถูกต้องโปรดทักท้วงทันที
<br><dd>2. เอกสารฉบับนี้เป็น "สำเนา" ต้องใช้ประกอบกับเอกสารที่ทางราชการออกให้เท่านั้น
<br><dd>3.หากต้องการฉบับจริงหรือพบข้อมูลไม่ถูกต้อง กรุณาติดต่องานการเงิน ชั้น 9 อาคาร33ปี โทร 0 2353 9763
<br><dd>4.เงินเพิ่มสำหรับตำแหน่งที่มีเหตุพิเศษของผู้ปฏิบัติงานด้านการสาธารณสุข เช่น แพทย์ ทันตแพทย์  เภสัชกรรม  พยาบาล  เทคนิคการแพทย์ รังสีการแพทย์และกายภาพ
 บำบัด และ ด้านการสาธารณสุขอื่น ๆ
</font>
</td></tr>
</table>
<br><br></td></tr></table></center></div>
</BODY>
</HTML>
