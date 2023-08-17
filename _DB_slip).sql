-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 17, 2023 at 10:30 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `slip`
--

-- --------------------------------------------------------

--
-- Table structure for table `file_upload`
--

CREATE TABLE IF NOT EXISTS `file_upload` (
  `id_file` int(11) NOT NULL AUTO_INCREMENT COMMENT ' id คุม',
  `name_file` varchar(255) NOT NULL COMMENT 'ชื่อไฟล์',
  `num_record` int(255) NOT NULL COMMENT 'จำนวนrecode ที่นำเข้า',
  `type_person` varchar(1) NOT NULL COMMENT 'ชนิดของบุคลลากร 0=ข้าราชการ,1=ลูกจ้างประจำ,2=พนักงานราชการ',
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'วันที่อัพเดดล่าสุด',
  `emp_new` int(3) DEFAULT NULL COMMENT 'จำนวนของพนักงานใหม่',
  PRIMARY KEY (`id_file`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=113 ;

--
-- Dumping data for table `file_upload`
--


-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE IF NOT EXISTS `loan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_person` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'เลขบัตรประชาชน',
  `amount` double DEFAULT NULL COMMENT 'จำนวนเงินที่ต้องหักเงินกู้ ณ ปัจจุบัน',
  `last_update` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=1 ;

--
-- Dumping data for table `loan`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbbank`
--

CREATE TABLE IF NOT EXISTS `tbbank` (
  `cbank` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `namebank` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `sakhabank` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  KEY `cbank` (`cbank`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `tbbank`
--

INSERT INTO `tbbank` (`cbank`, `namebank`, `sakhabank`) VALUES
('4', '-', ''),
('6', 'ธนาคารกรุงไทย จำกัด(มหาชน)	', ''),
('14', 'ธนาคารไทยพาณิชย์', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbchkadm`
--

CREATE TABLE IF NOT EXISTS `tbchkadm` (
  `pswadm` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `cnt` int(11) NOT NULL,
  `idno` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `daylgin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `tbchkadm`
--

INSERT INTO `tbchkadm` (`pswadm`, `cnt`, `idno`, `daylgin`) VALUES
('1234', 28, '3101600651830', '2020-07-01 11:58:19');

-- --------------------------------------------------------

--
-- Table structure for table `tbdetail`
--

CREATE TABLE IF NOT EXISTS `tbdetail` (
  `nauto` int(11) NOT NULL AUTO_INCREMENT,
  `nno` int(11) NOT NULL,
  `yy` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `mm` int(11) NOT NULL,
  `idno` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `nobank` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `money1` double NOT NULL,
  `money2` double NOT NULL,
  `money3` double NOT NULL,
  `money4` double NOT NULL,
  `money5` double NOT NULL,
  `money6` double NOT NULL,
  `money7` double NOT NULL,
  `money8` double NOT NULL,
  `money9` double NOT NULL,
  `money10` double NOT NULL,
  `sumget` double NOT NULL,
  `exp1` double NOT NULL,
  `exp2` double NOT NULL,
  `exp3` double NOT NULL,
  `exp4` double NOT NULL,
  `exp5` double NOT NULL,
  `exp6` double NOT NULL,
  `exp7` double NOT NULL,
  `exp8` double NOT NULL,
  `exp9` double NOT NULL,
  `exp10` double NOT NULL,
  `sumpay` double NOT NULL,
  `sumnet` double NOT NULL,
  `daykey` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `money4txt` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `money5txt` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `money6txt` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `money10txt` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `exp9txt` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `daypay` date NOT NULL,
  `notes` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `remarks` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `chk` int(11) NOT NULL COMMENT '0civil 1employee 2officer',
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`nauto`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT AUTO_INCREMENT=81426 ;

--
-- Dumping data for table `tbdetail`
--

INSERT INTO `tbdetail` (`nauto`, `nno`, `yy`, `mm`, `idno`, `nobank`, `money1`, `money2`, `money3`, `money4`, `money5`, `money6`, `money7`, `money8`, `money9`, `money10`, `sumget`, `exp1`, `exp2`, `exp3`, `exp4`, `exp5`, `exp6`, `exp7`, `exp8`, `exp9`, `exp10`, `sumpay`, `sumnet`, `daykey`, `money4txt`, `money5txt`, `money6txt`, `money10txt`, `exp9txt`, `daypay`, `notes`, `remarks`, `chk`, `last_update`) VALUES
(43526, 0, '2563', 6, '3100700072091', '6870096716', 56390, 0, 5600, 0, 5600, 0, 0, 0, 0, 0, 67590, 2930.16, 6943.75, 0, 0, 0, 0, 277, 0, 0, 0, 10150.91, 57439.09, '2020-09-24', '', '', '', '', '', '2020-06-25', '', '', 0, '2020-09-24 15:08:18');

-- --------------------------------------------------------

--
-- Table structure for table `tbmain`
--

CREATE TABLE IF NOT EXISTS `tbmain` (
  `noman` int(11) NOT NULL,
  `prename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nname` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nobank` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `idno` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `nposit` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `noffice` int(11) NOT NULL,
  `passc` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `cbank` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `mbphone` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'mobile number',
  `dayup` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `chn` int(11) NOT NULL COMMENT '0=ยังไม่เคยแก้ไขpassw'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `tbmain`
--

INSERT INTO `tbmain` (`noman`, `prename`, `nname`, `lname`, `nobank`, `idno`, `nposit`, `noffice`, `passc`, `cbank`, `mbphone`, `dayup`, `chn`) VALUES
(3, 'นาย', 'วรพันธุ์', 'อุดมเจียระไน', '0220118760', '3101600651830', 'นักเทคโนโลยีสารสนเทศ', 16, '000000', '6', '0891235112', '2020-07-20 13:12:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbmonth`
--

CREATE TABLE IF NOT EXISTS `tbmonth` (
  `mm` int(11) NOT NULL,
  `nmonth` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  KEY `mm` (`mm`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `tbmonth`
--

INSERT INTO `tbmonth` (`mm`, `nmonth`) VALUES
(1, 'มกราคม'),
(2, 'กุมภาพันธ์'),
(3, 'มีนาคม'),
(4, 'เมษายน'),
(5, 'พฤษภาคม'),
(6, 'มิถุนายน'),
(7, 'กรกฎาคม'),
(8, 'สิงหาคม'),
(9, 'กันยายน'),
(10, 'ตุลาคม'),
(11, 'พฤศจิกายน'),
(12, 'ธันวาคม');

-- --------------------------------------------------------

--
-- Table structure for table `tboffice`
--

CREATE TABLE IF NOT EXISTS `tboffice` (
  `coff` int(11) NOT NULL,
  `noffice` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `tboffice`
--

INSERT INTO `tboffice` (`coff`, `noffice`) VALUES
(1, 'สำนักสารสนเทศการแพทย์'),
(2, 'สำนักยุทธศาสตร์การแพทย์'),
(3, 'สำนักงานเลขานุการกรม'),
(16, 'กรมการแพทย์'),
(99, 'ราชการบริหารส่วนกลาง'),
(4, 'สำนักกฏหมายการแพทย์'),
(5, 'สำนักวิชาการแพทย์'),
(6, 'กองคลัง'),
(7, 'สถาบันทันตกรรม'),
(8, 'สถาบันวิจัยและประเมินเทคโนโลยีทางการแพทย์'),
(9, 'สำนักบริหารทรัพยากรบุคคล'),
(10, 'สำนักนิเทศระบบการแพทย์'),
(11, 'กลุ่มตรวจสอบภายใน'),
(12, 'กลุ่มพัฒนาระบบบริหาร'),
(13, 'โรงพยาบาลนพรัตนราชธานี'),
(14, 'โรงพยาบาลเมตตาประชารักษ์(วัดไร่ขิง)'),
(15, 'โรงพยาบาลราชวิถี'),
(0, 'โรงพยาบาลเลิดสิน'),
(17, 'โรงพยาบาลสงฆ์'),
(18, 'สถาบันสิรินธรเพื่อการฟื้นฟูสมรรถภาพทางการแพทย์แห่งชาติ'),
(19, 'สถาบันประสาทวิทยา'),
(20, 'สถาบันพยาธิวิทยา'),
(21, 'สถาบันมะเร็งแห่งชาติ'),
(22, 'สถาบันบำบัดรักษาและฟื้นฟูผู้ติดยาเสพติดแห่งชาติบรมราชชนนี'),
(23, 'สถาบันโรคทรวงอก'),
(24, 'สถาบันโรคผิวหนัง'),
(25, 'สถาบันเวชศาสตร์สมเด็จพระสังฆราชญาณสังวรเพื่อผู้สูงอายุ'),
(26, 'สถาบันสุขภาพเด็กแห่งชาติมหาราชินี'),
(29, 'โรงพยาบาลมะเร็งชลบุรี'),
(31, 'โรงพยาบาลมะเร็งลำปาง'),
(33, 'โรงพยาบาลมะเร็งอุดรธานี'),
(34, 'โรงพยาบาลมะเร็งสุราษฎร์ธานี'),
(35, 'โรงพยาบาลมหาวชิราลงกรณธัญบุรี'),
(36, 'โรงพยาบาลธัญญารักษ์เชียงใหม่'),
(37, 'โรงพยาบาลธัญญารักษ์สงขลา'),
(38, 'โรงพยาบาลธัญญารักษ์ขอนแก่น'),
(39, 'โรงพยาบาลธัญญารักษ์ปัตตานี'),
(40, 'โรงพยาบาลธัญญารักษ์แม่ฮ่องสอน'),
(41, 'โรงพยาบาลธัญญารักษ์อุดรธานี'),
(42, 'โรงพยาบาลโรคผิวหนังเขตร้อนภาคใต้ จังหวัดตรัง'),
(43, 'โรงพยาบาลสมเด็จพระสังฆราชญาณสังวรเพื่อผู้สูงอายุ จ.ชลบุรี'),
(27, 'สถาบันเวชศาสตร์การออกกำลังกายและการกีฬา'),
(28, 'โรงพยาบาลประสาทเชียงใหม่'),
(30, 'โรงพยาบาลมะเร็งลพบุรี'),
(32, 'โรงพยาบาลมะเร็งอุบลราชธานี'),
(44, 'ศูนย์นวัตกรรมสุขภาพผู้สูงอายุ');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
