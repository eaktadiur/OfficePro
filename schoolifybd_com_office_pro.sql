-- phpMyAdmin SQL Dump
-- version 3.5.6
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jan 22, 2014 at 12:58 PM
-- Server version: 5.1.56-community
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `schoolifybd_com_office_pro`
--

-- --------------------------------------------------------

--
-- Table structure for table `approval_history`
--

DROP TABLE IF EXISTS `approval_history`;
CREATE TABLE IF NOT EXISTS `approval_history` (
  `ApprovalHistoryId` int(11) NOT NULL AUTO_INCREMENT,
  `ModuleId` int(11) DEFAULT NULL,
  `Module` varchar(255) NOT NULL,
  `DesignationId` int(11) DEFAULT NULL,
  `EmployeeId` int(11) DEFAULT NULL,
  `Comment` varchar(255) DEFAULT NULL,
  `CreatedBy` int(11) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`ApprovalHistoryId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `approval_history`
--

INSERT INTO `approval_history` (`ApprovalHistoryId`, `ModuleId`, `Module`, `DesignationId`, `EmployeeId`, `Comment`, `CreatedBy`, `CreatedDate`, `ModifiedBy`, `ModifiedDate`) VALUES
(10, 7, 'requisition', 0, 2, 'approved', 2, '2014-01-10 13:34:40', NULL, NULL),
(11, 7, 'requisition', 0, 2, 'rev', 2, '2014-01-10 13:38:40', NULL, NULL),
(12, 10, 'requisition', 9, 3, '02 review', 3, '2014-01-15 00:18:59', NULL, NULL),
(13, 10, 'requisition', 9, 4, '03 review', 4, '2014-01-15 00:30:27', NULL, NULL),
(14, 10, 'requisition', 9, 5, '04 review', 5, '2014-01-15 00:31:18', NULL, NULL),
(15, 10, 'requisition', 1, 11, 'admin Approve', 11, '2014-01-15 00:33:14', NULL, NULL),
(16, 10, 'requisition', 5, 13, '100 review', 13, '2014-01-15 01:12:12', NULL, NULL),
(17, 10, 'requisition', 5, 13, '100 review', 13, '2014-01-15 01:17:53', NULL, NULL),
(18, 10, 'requisition', 5, 13, '100 re', 13, '2014-01-15 01:22:01', NULL, NULL),
(19, 10, 'requisition', 5, 10, '101 re', 10, '2014-01-15 01:22:39', NULL, NULL),
(20, 10, 'requisition', 5, 15, '102 re', 15, '2014-01-15 01:23:18', NULL, NULL),
(21, 10, 'requisition', 4, 2, '103 approve', 2, '2014-01-15 01:24:01', NULL, NULL),
(22, 10, 'requisition', 1, 14, 'admin approve', 14, '2014-01-15 01:25:11', NULL, NULL),
(23, 10, 'requisition', 1, 14, 'admin approve', 14, '2014-01-15 01:25:51', NULL, NULL),
(24, 6, 'requisition', 4, 2, 'a', 2, '2014-01-19 23:15:10', NULL, NULL),
(25, 17, 'requisition', 23, 30, 'OK. Approve.', 30, '2014-01-20 21:25:18', NULL, NULL),
(26, 17, 'requisition', 1, 29, 'No. It\\''s not okay.', 29, '2014-01-20 21:32:08', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

DROP TABLE IF EXISTS `bill`;
CREATE TABLE IF NOT EXISTS `bill` (
  `BillId` int(11) NOT NULL AUTO_INCREMENT,
  `RefNo` varchar(255) DEFAULT NULL,
  `BillNo` varchar(255) DEFAULT NULL,
  `BillDate` datetime DEFAULT NULL,
  `Remark` varchar(255) DEFAULT NULL,
  `StatusId` int(11) DEFAULT NULL,
  `IsActive` int(11) DEFAULT NULL,
  `CompanyId` int(11) DEFAULT NULL,
  `CreatedBy` int(11) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`BillId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`BillId`, `RefNo`, `BillNo`, `BillDate`, `Remark`, `StatusId`, `IsActive`, `CompanyId`, `CreatedBy`, `CreatedDate`, `ModifiedBy`, `ModifiedDate`) VALUES
(12, 'aaaaaaaaaa', '2014000001', '2014-01-01 00:00:00', 'ssssssssssssssdddddddddd', 1, 1, 2, 10, '2014-01-17 22:55:19', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bill_details`
--

DROP TABLE IF EXISTS `bill_details`;
CREATE TABLE IF NOT EXISTS `bill_details` (
  `BillDetailsId` int(11) NOT NULL AUTO_INCREMENT,
  `BillId` int(11) DEFAULT NULL,
  `ChallanDetailsId` int(11) DEFAULT NULL,
  `ProductId` int(11) DEFAULT NULL,
  `Qty` float(11,0) DEFAULT NULL,
  `UnitPrice` decimal(20,2) DEFAULT NULL,
  `Total` decimal(20,2) DEFAULT NULL,
  `Remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`BillDetailsId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `bill_details`
--

INSERT INTO `bill_details` (`BillDetailsId`, `BillId`, `ChallanDetailsId`, `ProductId`, `Qty`, `UnitPrice`, `Total`, `Remark`) VALUES
(12, 12, 10, 5, 0, '0.00', '0.00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `CategoryId` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) DEFAULT NULL COMMENT 'Name,y,,,,20,1',
  `CompanyId` int(11) DEFAULT NULL,
  `IsActive` int(11) DEFAULT NULL,
  `CreatedBy` int(11) NOT NULL,
  `CreatedDate` date NOT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `ModifiedDate` date DEFAULT NULL,
  PRIMARY KEY (`CategoryId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryId`, `Name`, `CompanyId`, `IsActive`, `CreatedBy`, `CreatedDate`, `ModifiedBy`, `ModifiedDate`) VALUES
(1, 'Primary', 1, 1, 1, '1900-01-01', 1, NULL),
(2, 'Rajib', 1, 1, 1, '2010-01-01', 1, '2010-01-01'),
(3, 'ffffffffffff', 1, 1, 0, '2010-11-24', NULL, NULL),
(4, 'djdjhfkjdshfjsdh', 1, 1, 0, '2010-11-24', NULL, NULL),
(5, 'hsdgfdhsgf', 1, 1, 0, '2010-11-24', NULL, NULL),
(6, 'aaa', 88, NULL, 0, '2013-06-28', 0, '2013-06-28');

-- --------------------------------------------------------

--
-- Table structure for table `challan`
--

DROP TABLE IF EXISTS `challan`;
CREATE TABLE IF NOT EXISTS `challan` (
  `ChallanId` int(11) NOT NULL AUTO_INCREMENT,
  `RefNo` varchar(255) DEFAULT NULL,
  `ChallanNo` varchar(255) DEFAULT NULL,
  `ChallanDate` datetime DEFAULT NULL,
  `PresentLocationId` int(11) DEFAULT NULL,
  `Remark` varchar(255) DEFAULT NULL,
  `StatusId` int(11) DEFAULT NULL,
  `IsActive` int(11) DEFAULT NULL,
  `CompanyId` int(11) DEFAULT NULL,
  `DeliveredBy` int(11) DEFAULT NULL,
  `ReceivedBy` int(11) DEFAULT NULL,
  `CreatedBy` int(11) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`ChallanId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `challan`
--

INSERT INTO `challan` (`ChallanId`, `RefNo`, `ChallanNo`, `ChallanDate`, `PresentLocationId`, `Remark`, `StatusId`, `IsActive`, `CompanyId`, `DeliveredBy`, `ReceivedBy`, `CreatedBy`, `CreatedDate`, `ModifiedBy`, `ModifiedDate`) VALUES
(8, '2001/ttt', '2014000001', '2014-01-17 00:00:00', NULL, 'rrrrrr', 1, 1, 0, NULL, NULL, 10, '2014-01-17 18:24:23', NULL, NULL),
(9, '2000/re', '2014000001', '2014-01-08 00:00:00', NULL, 'rr', 1, 1, 2, NULL, NULL, 10, '2014-01-17 18:31:44', NULL, NULL),
(10, 'q', '2014000010', '2014-01-01 00:00:00', NULL, '', 1, 1, 2, NULL, NULL, 10, '2014-01-17 18:33:16', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `challan_details`
--

DROP TABLE IF EXISTS `challan_details`;
CREATE TABLE IF NOT EXISTS `challan_details` (
  `ChallanDetailsId` int(11) NOT NULL AUTO_INCREMENT,
  `RequisitionDetailsId` int(11) DEFAULT NULL,
  `ChallanId` int(11) DEFAULT NULL,
  `ProductId` int(11) DEFAULT NULL,
  `Qty` float(11,0) DEFAULT NULL,
  `UnitPrice` decimal(20,2) DEFAULT NULL,
  `Total` decimal(20,2) DEFAULT NULL,
  `Remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ChallanDetailsId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `challan_details`
--

INSERT INTO `challan_details` (`ChallanDetailsId`, `RequisitionDetailsId`, `ChallanId`, `ProductId`, `Qty`, `UnitPrice`, `Total`, `Remark`) VALUES
(9, 12, 8, NULL, 55, '66.00', '3443.00', 'fdsfdfd'),
(10, 12, 9, NULL, 11, '111.00', '3434.00', 'dfsdd');

-- --------------------------------------------------------

--
-- Table structure for table `challan_requisition`
--

DROP TABLE IF EXISTS `challan_requisition`;
CREATE TABLE IF NOT EXISTS `challan_requisition` (
  `ChallanId` int(11) NOT NULL,
  `RequisitionDetailsId` int(11) NOT NULL,
  `CompanyId` int(11) NOT NULL,
  `CreatedBy` int(11) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `clt_leads`
--

DROP TABLE IF EXISTS `clt_leads`;
CREATE TABLE IF NOT EXISTS `clt_leads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city_state_zip` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `tshirt_size` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `afname` varchar(255) NOT NULL,
  `alname` varchar(255) NOT NULL,
  `aemail` varchar(255) NOT NULL,
  `arelation` varchar(255) DEFAULT NULL,
  `aphone` varchar(255) NOT NULL,
  `atshirt_size` varchar(255) DEFAULT NULL,
  `event_date` varchar(255) DEFAULT NULL,
  `modify_history` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `event_type` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `clt_leads`
--

INSERT INTO `clt_leads` (`id`, `fname`, `lname`, `address`, `city_state_zip`, `phone`, `mobile`, `fax`, `tshirt_size`, `email`, `afname`, `alname`, `aemail`, `arelation`, `aphone`, `atshirt_size`, `event_date`, `modify_history`, `date`, `event_type`) VALUES
(10, 'LaTrisha', 'Reid', '1236 Wildwood Lane', 'Vestal, NY 13850', '(917) 831-6995', '(917) 831-6995', '', 'Medium (womens)', 'latrisha@ikkinandcompany.com', 'Tyrell', 'Winston', 'tyrellwinston88@gmail.com', 'Son', '(832) 795-9914', 'Large (mens)', 'November 7- 9, 2013', '', '1381785890', NULL),
(11, 'Kevin', 'Lindsey', '1228 Limerick Drive', 'Fort Worth/TX/76134', '8179947814', '8179947814', '', 'xxxl', 'kevindewayne@gmail.com', 'dewan', 'partee', 'kevindewayne@gmail.com', 'partner', '8179947814', 'l', 'November 7- 9, 2013', '', '1381862319', NULL),
(12, 'Roslyn', 'Clowers', '16815 Village View Trl', 'Sugar Land', '832-405-9293', '', '', 'medium', 'rclowers14@gmail.com', '', '', '', '', '', '', 'November 7- 9, 2013', '', '1382042535', NULL),
(13, 'Saba', 'Haile', '12700 Stafford Rd #528', 'Stafford, TX 77477', '8328761998', '', '', 'X-Small', 'haile_st@yahoo.com', '', '', '', '', '', '', 'November 7- 9, 2013', '', '1382045043', NULL),
(14, 'Elaine', 'Barley', '11012 Panther Court', 'Houston tx 77099', '2817018439', '2817018439', '', 'Large', 'elainebarley@gmail.com', 'Gidget', 'Lewis', 'elainebarley@gmail.com', 'Manger of my store', '8329210806', 'X X Large', 'November 7- 9, 2013', '', '1382128267', NULL),
(15, 'Elfrin', 'Patten', '811 Royal George Ln', 'houston/Tx/77047', '8328842700', '8328842700', '', 'XL', 'elfrinlee@gmail.com', '', '', '', '', '', '', 'November 7- 9, 2013', '', '1382133366', NULL),
(16, 'ELAINE', 'BARLEY', '11012 PANTHER COURT', 'HOUSTON, TX 77099', '2817018439', '', '', 'LARGE', 'williamweyeberg@gmail.com', 'William', 'Weyenberg', 'williamweyeberg@gmail.com', 'son', '2816838378', 'Large', 'November 7- 9, 2013', '', '1382199587', NULL),
(17, 'Tavoria', 'Wilson', '213 W. Country Club Drive', 'Brentwood, CA 94513', '415-290-5306', '415-290-5306', '925-516-2354', 'XL', 'tavoria@calalum.org', 'Larry', 'Morton', 'LRM1224@gmail.com', 'Spouse', '415-254-0004', 'XXL', 'November 7- 9, 2013', '', '1382299846', NULL),
(18, 'Kevin', 'McCullough', '202 Blakewood St.', 'Navasota, TX 77868', '9336-825-8398', '936-870-6294', '', 'X-Lg', 'kpmccullough@msn.com', 'Dale', 'McMillan', 'txmongo@gmail.com', 'Co-Worker', '979-571-6927', '2X-Lg', 'November 7- 9, 2013', '', '1382386534', NULL),
(20, 'Shanna M.', 'Hennigan', '929 Preston Suite 300A', 'Houston, Texas 77002', '8324980222', '8324980222', '7132647598', 'XL', 'shannahennigan@yahoo.com', 'Shanna M.', 'Hennigan', 'shannahennigan@yahoo.com', 'Self', '8324980222', 'XL', 'November 7- 9, 2013', '', '1382430343', NULL),
(21, 'Daniel', 'Murray', '1910 Hidden Cypress Lane', 'Fresno, TX 77545', '2146059243', '2146059243', '', '2xL', 'daniel@unitedcorporateconcepts.com', 'Adam', 'Montemayor', 'daniel@unitedcorporateconcepts.com', '', '2146059243', 'Large', 'November 7- 9, 2013', '', '1382456690', NULL),
(22, 'Rogers', 'Dennis', '21303 Wildwood park rd', 'Richmond/Tx/77469', '8325138836', '8326134567', '', 'xl', 'dnnsrogers@yahoo.com', 'Henry', 'Velasquez', '', 'Partner', '8326134567', 'xl', 'November 7- 9, 2013', '', '1382672028', NULL),
(23, 'Jerome', 'Rodgers', '3936 South Polk #108', 'Dallas TX 75224', '214.251.6594', '214.251.6594', '', '3x', 'alphajar@yahoo.com', 'Shasha', 'Franchis', '', 'Office Manager', '469.219.4768', 'm', 'November 7- 9, 2013', '', '1383004438', NULL),
(24, 'Chantel', 'Moore', 'P.O. Box 480954', 'Charlotte', '7042816680', '7042816680', '980-236-7971', 'XXL women', 'chantelm1989@yahoo.com', 'Craig', 'Davenport, Sr.', 'avid_acquisitions@mail.com', 'partner', '7042816680', '3XL men', 'November 7- 9, 2013', '', '1383085366', NULL),
(25, 'Tojuna', 'Eldridge', '25222 Northwest Freeway #274', 'Cypress', '8327975969', '8327975969', '281-417-0029', 'small', 'tojuna.eldridge@yahoo.com', 'Tojuna', 'Eldridge', 'tojuna.eldridge@yahoo.com', 'Self', '832-797-5969', 'Small', 'November 7- 9, 2013', '', '1383099712', NULL),
(26, 'bryan', 'callis', '5801 N.Houston-Rosslyn rd apt#2921', 'Houston, TX 77091', '832-908-3545', '832-908-3545', '', 'Large', 'bryancallis@yahoo.com', '', '', '', '', '', '', 'November 7- 9, 2013', '', '1383162379', NULL),
(27, 'Magdalina', 'Noel', '13102 Fallsview Ln. Apt 4904G', 'Houston, TX 77077', '8328761375', '8328761375', '', 'Xs or small', 'mnoel437@gmail.com', 'JAMESSY', 'Fontaine', 'jamessyfontaine@gmail.com', 'Brother', '(832) 896-3886', 'XL', 'November 7- 9, 2013', '', '1383387600', NULL),
(30, 'Gerald', 'Mack', '4437 Walnut Creek Drive', 'Lexington, KY 40509', '859 621 3309', '', '', '2x', 'gmack859@yahoo.com', 'T.C', 'Howard', 'gmack859@yahoo.com', 'partner', '859 621 3309', '2x', 'November 7- 9, 2013', '', '1383588854', NULL),
(31, 'Stephanie', 'Turner', '10914 Golden Grain Dr', 'Houston Tecas 77064', '2818971176', '2816351753', '', 'Ladies Large  Mens medium', 'slghines@gmail.com', '', '', '', '', '', '', 'November 7- 9, 2013', '', '1383687537', NULL),
(32, 'Terry', 'Harvin', '14118 Avongate Lane', 'Houston, TX 77082', '7169864219', '', '', 'XL', 'tharvin73@gmail.com', 'Nicole', 'Jackson', 'tharvin73@gmail.com', 'Friend', '', 'Small', 'November 7- 9, 2013', '', '1383771545', NULL),
(33, 'Dametria', 'Eagleton', '14731 Julie Meadows Ln', 'Humble, TX  77396', '832-703-9009', '832-703-9009', '', 'Medium', 'msdeagleton@gmail.com', '', '', '', '', '', '', 'November 7- 9, 2013', '', '1383774601', NULL),
(34, 'Altoria', 'Prince', '7870 Kemper Circle', 'Beaumont, TX 77707', '409-842-1001', '409-466-3353', '409-898-4393', 'medium', 'altoriaprince@sbcglobal.net', '', '', '', '', '', '', 'November 7- 9, 2013', '', '1383830627', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
CREATE TABLE IF NOT EXISTS `company` (
  `CompanyId` int(3) NOT NULL AUTO_INCREMENT,
  `Code` varchar(20) NOT NULL,
  `Name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `Address1` text CHARACTER SET utf8 NOT NULL,
  `Address2` text CHARACTER SET utf8,
  `ZipCode` int(11) NOT NULL,
  `Phone` varchar(50) CHARACTER SET utf8 NOT NULL,
  `Fax` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Email` varchar(50) CHARACTER SET utf8 NOT NULL,
  `CurrencySymbol` varchar(5) CHARACTER SET utf8 DEFAULT NULL,
  `IsActive` int(1) NOT NULL,
  `CreatedBy` int(3) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `ModifiedBy` int(3) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`CompanyId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`CompanyId`, `Code`, `Name`, `Address1`, `Address2`, `ZipCode`, `Phone`, `Fax`, `Email`, `CurrencySymbol`, `IsActive`, `CreatedBy`, `CreatedDate`, `ModifiedBy`, `ModifiedDate`) VALUES
(1, '1000', 'Enroute', 'DOHS', '', 0, '', '', '', '', 1, 0, '2013-06-25 00:00:00', NULL, NULL),
(2, '1001', 'Schoolify', 'Mirpur', '', 0, '01680824484', '', 'eaktadiur@schoolifybd.com', '', 1, 0, '2013-08-09 00:00:00', NULL, NULL),
(3, '1002', 'Apsis Solutions Limited', 'Kemal Ataturk Avenue, Banani, Dhaka', '', 0, '', '', '', '', 0, 0, '2014-01-04 10:59:21', NULL, NULL),
(7, '2001', 'Test', '', '', 0, '', '', 'eak@gmail.com', NULL, 1, 0, '2014-01-10 14:32:22', NULL, NULL),
(8, '201413', 'Test2', '', '', 0, '', '', 'eak@gmail.com', NULL, 1, 0, '2014-01-10 14:38:19', NULL, NULL),
(9, '1002', 'abc', 'aaaaaaaa', 'aaaaaaaaaaaaa2', 1215, '0171211024', '0171211023', 'abc@gmail.com', NULL, 1, 0, '2014-01-19 00:38:11', NULL, NULL),
(10, '1002', 'abc', 'aaaaaaaa', 'aaaaaaaaaaaaa2', 1215, '0171211024', '0171211023', 'abc@gmail.com', NULL, 1, 0, '2014-01-19 00:40:04', NULL, NULL),
(11, '1002', 'abc', 'aaaaaaaa', 'aaaaaaaaaaaaa2', 1215, '0171211024', '0171211023', 'abc@gmail.com', NULL, 1, 0, '2014-01-19 00:40:45', NULL, NULL),
(12, '2001', 'Samsung R&D Institute Bangladesh Limited', '111-Bir Uttam C. R. Dutta Road, Panthapath, Dhaka-1205, Bangladesh', 'Samsung Town, Seoul, South Korea', 1206, '+8809606852020', '+8809606852021', 'hr@samsung.com', NULL, 1, 0, '2014-01-19 13:14:04', NULL, NULL),
(13, '22', 'Shuvo & Sons', 'Dilu Road, Eskaton', 'Dhaka', 1206, '01912446387', '123', 'a@bc.com', NULL, 1, 0, '2014-01-19 21:20:35', NULL, NULL),
(14, '5055', 'Drik Gallery', 'A', 'B', 1020, '6565', '6565', 'a@bc.com', NULL, 1, 0, '2014-01-20 20:54:52', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `company_product`
--

DROP TABLE IF EXISTS `company_product`;
CREATE TABLE IF NOT EXISTS `company_product` (
  `CompanyProductId` int(11) NOT NULL AUTO_INCREMENT,
  `CompanyId` int(11) DEFAULT NULL,
  `ProductId` int(11) DEFAULT NULL,
  `AgreementId` int(2) DEFAULT NULL,
  `Price` decimal(20,2) DEFAULT NULL,
  `UnitId` int(11) DEFAULT NULL,
  `CreatedBy` int(11) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`CompanyProductId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `company_product`
--

INSERT INTO `company_product` (`CompanyProductId`, `CompanyId`, `ProductId`, `AgreementId`, `Price`, `UnitId`, `CreatedBy`, `CreatedDate`, `ModifiedBy`, `ModifiedDate`) VALUES
(1, 1, 1, 1, '100.00', 1, 0, '2014-01-08 21:30:50', NULL, NULL),
(2, 1, 2, 1, '200.00', 2, 0, '2014-01-08 21:30:55', NULL, NULL),
(3, 1, 3, 1, '300.00', 3, 0, '2014-01-08 21:30:59', NULL, NULL),
(4, 1, 4, 1, '400.00', 4, 0, '0000-00-00 00:00:00', NULL, NULL),
(10, 2, 5, 1, '44.00', 5, 0, '0000-00-00 00:00:00', NULL, NULL),
(11, 2, 6, 1, '55.00', 6, 0, '0000-00-00 00:00:00', NULL, NULL),
(12, 2, 7, 1, '66.00', 7, 0, '0000-00-00 00:00:00', NULL, NULL),
(13, 2, 8, 1, '77.00', 8, 0, '0000-00-00 00:00:00', NULL, NULL),
(14, 0, 9, NULL, '1.00', NULL, 0, '2014-01-10 00:00:00', NULL, NULL),
(15, 0, 10, NULL, '1.00', NULL, 0, '2014-01-10 00:00:00', NULL, NULL),
(16, 3, 6, NULL, '1.00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL),
(17, 3, 1, NULL, '1.00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL),
(18, 0, 5, NULL, '1.00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL),
(19, 0, 6, NULL, '1.00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL),
(20, 0, 10, NULL, '1.00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL),
(21, 0, 8, NULL, '1.00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL),
(22, 0, 9, NULL, '1.00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL),
(23, 0, 9, NULL, '1.00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL),
(24, 0, 2, NULL, '1.00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL),
(25, 0, 2, NULL, '1.00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL),
(26, 3, 1, NULL, '1.00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL),
(27, 3, 1, NULL, '1.00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL),
(28, 3, 1, NULL, '1.00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL),
(29, 3, 2, NULL, '1.00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL),
(30, 9, 1, NULL, '1000.00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL),
(31, 9, 2, NULL, '1.00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL),
(32, 12, 1, NULL, '10.00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL),
(33, 12, 2, NULL, '20.00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL),
(34, 12, 3, NULL, '30.00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL),
(35, 13, 1, NULL, '1.00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL),
(36, 13, 2, NULL, '1.00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL),
(37, 13, 7, NULL, '1.00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL),
(38, 14, 1, NULL, '16.00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL),
(39, 14, 2, NULL, '19.00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL),
(40, 14, 7, NULL, '11.00', NULL, 0, '0000-00-00 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

DROP TABLE IF EXISTS `designation`;
CREATE TABLE IF NOT EXISTS `designation` (
  `DesignationId` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(150) COLLATE latin1_general_ci DEFAULT NULL COMMENT 'Designation,y,,,,20,1',
  `CompanyId` int(11) DEFAULT NULL,
  `CreatedBy` int(11) NOT NULL,
  `CreatedDate` date NOT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `ModifiedDate` date DEFAULT NULL,
  PRIMARY KEY (`DesignationId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=25 ;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`DesignationId`, `Name`, `CompanyId`, `CreatedBy`, `CreatedDate`, `ModifiedBy`, `ModifiedDate`) VALUES
(1, 'Account', 2, 0, '0000-00-00', NULL, NULL),
(3, 'HR', 3, 0, '0000-00-00', NULL, NULL),
(4, 'Division Head', 1, 0, '0000-00-00', NULL, NULL),
(5, 'Testing Master', 1, 0, '0000-00-00', NULL, NULL),
(7, 'Dispatch officer', 1, 0, '0000-00-00', NULL, NULL),
(8, 'Executive', 2, 0, '0000-00-00', NULL, NULL),
(9, 'Office Staff', 2, 0, '0000-00-00', NULL, NULL),
(10, 'Comunication officer', 2, 0, '0000-00-00', NULL, NULL),
(11, 'Store Officer', 3, 0, '0000-00-00', NULL, NULL),
(12, 'CFO', 3, 0, '0000-00-00', NULL, NULL),
(13, 'DMD', 3, 0, '0000-00-00', NULL, NULL),
(14, 'aaaaaaaaaaaa', 0, 0, '2014-01-11', NULL, NULL),
(15, 'aa', 1, 2, '2014-01-11', NULL, NULL),
(16, 'MD', 12, 21, '2014-01-19', NULL, NULL),
(17, 'Requisition Manager', 12, 21, '2014-01-19', NULL, NULL),
(18, 'MD', 13, 23, '2014-01-19', NULL, NULL),
(19, 'HR Head', 13, 23, '2014-01-19', NULL, NULL),
(20, 'a', 12, 21, '2014-01-19', NULL, NULL),
(21, 'MD', 1, 14, '2014-01-20', NULL, NULL),
(22, 'CEO', 1, 14, '2014-01-20', NULL, NULL),
(23, 'A', 14, 29, '2014-01-20', NULL, NULL),
(24, 'B', 14, 29, '2014-01-20', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `EmployeeId` int(11) NOT NULL AUTO_INCREMENT,
  `CompanyId` int(11) DEFAULT NULL,
  `CardNo` varchar(255) DEFAULT NULL,
  `FirstName` varchar(50) DEFAULT NULL COMMENT 'Name,y,Y,,,20,1',
  `LastName` varchar(50) DEFAULT NULL COMMENT 'Decimal Place,y,Y,,,20,1',
  `MiddleName` varchar(50) DEFAULT NULL,
  `SurName` varchar(255) DEFAULT NULL,
  `DesignationId` int(11) DEFAULT NULL,
  `PresentAddress` varchar(255) DEFAULT NULL,
  `Cell` varchar(14) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `NextApprovalId` int(11) DEFAULT NULL,
  `DlegationId` int(11) DEFAULT NULL,
  `RoleId` int(1) DEFAULT NULL,
  `IsActive` int(11) DEFAULT NULL,
  `CreatedBy` int(11) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`EmployeeId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`EmployeeId`, `CompanyId`, `CardNo`, `FirstName`, `LastName`, `MiddleName`, `SurName`, `DesignationId`, `PresentAddress`, `Cell`, `Email`, `NextApprovalId`, `DlegationId`, `RoleId`, `IsActive`, `CreatedBy`, `CreatedDate`, `ModifiedBy`, `ModifiedDate`) VALUES
(1, 2, '01', 'Eaktadiur', 'Rajib', '', '', 9, '', '', 'eaktadiur@gmail.com', 3, NULL, 2, 1, 3, '2010-10-15 10:48:23', 1, '2014-01-15 00:11:17'),
(2, 1, '103', 'Towfiq', 'Rahman', '', '', 4, '', '', 's@gmail.com', 14, NULL, 2, 1, 3, '2010-10-15 10:48:43', 14, '2014-01-15 01:00:32'),
(3, 2, '02', 'Shuvo', 'Nur', '', '', 9, '', '', 'Nur@yahoo.com', 4, NULL, 5, 0, 0, '2010-11-27 12:39:35', 11, '2014-01-14 23:58:56'),
(4, 2, '03', 'Forhad', 'Hossain', '', '', 9, '', '', 'forhad@yahoo.com', 5, NULL, 5, 0, 0, '2010-11-27 12:40:54', 11, '2014-01-14 23:59:33'),
(5, 2, '04', 'Kamal', 'Ahmed', '', '', 9, '', '', 'Ahmed@yahoo.com', 11, NULL, 5, 0, 0, '2010-11-27 12:41:42', 11, '2014-01-15 00:00:40'),
(11, 2, 'admin', 'admin', 'admin', '', '', 1, '', '', 'eak@gmail.com', 0, NULL, 1, NULL, 3, '2014-01-10 14:34:55', NULL, NULL),
(12, 8, 'admin', 'admin', 'admin', '', '', 1, '', '', '', 0, NULL, 1, NULL, 3, '2014-01-10 14:38:19', NULL, NULL),
(10, 1, '101', 'Account', 'Finance', 'Middle Name', 'Sur Name', 5, 'ppppppp', '333333', 'eak@gmail.com', 15, NULL, 4, NULL, 1, '2014-01-09 22:30:38', 14, '2014-01-18 14:54:24'),
(13, 1, '100', 'Customer', 'Service', '', '', 5, '', '000', 'a@gmail.com', 10, NULL, 0, NULL, 2, '2014-01-14 20:39:56', 14, '2014-01-15 01:20:12'),
(14, 1, 'admin', 'admin', 'admin', NULL, NULL, 1, NULL, NULL, 'admin@gmail.com', NULL, NULL, 1, NULL, 0, '0000-00-00 00:00:00', NULL, NULL),
(15, 1, '102', 'Karim', 'Hasan', '', '', 5, '', '', '', 2, NULL, 5, NULL, 14, '2014-01-15 00:59:33', NULL, NULL),
(17, 9, 'admin', 'admin', 'admin', '', '', 1, '', '', '', 0, NULL, 1, NULL, 3, '2014-01-19 00:38:11', NULL, NULL),
(18, 10, 'admin', 'admin', 'admin', '', '', 1, '', '', '', 0, NULL, 1, NULL, 3, '2014-01-19 00:40:04', NULL, NULL),
(19, 11, 'admin', 'admin', 'admin', '', '', 1, '', '', '', 0, NULL, 1, NULL, 3, '2014-01-19 00:40:45', NULL, NULL),
(20, 1, '105', 'Fname c', 'LName vvvvvvvvv', 'MidNamev  vvvvvvv', 'Sur Nameb vvvvvvvvvv', 15, 'present vvvvvvvvvvvv', '22222255555', 'forhad.csekuet@yahoo.com', 2, NULL, 1, NULL, 14, '2014-01-19 00:46:42', 14, '2014-01-19 19:42:39'),
(21, 12, 'admin', 'admin', 'admin', '', '', 17, '', '', 'forhad.csekuet@yahoo.com', 22, NULL, 2, NULL, 3, '2014-01-19 13:14:04', 21, '2014-01-19 19:18:44'),
(22, 12, '985739833', 'Mr.', 'Haque', 'Anisul', 'Anis', 17, 'Road# 4, House# 10, Mohammadpur, Dhaka, Bangladesh', '01915837463', 'forhad.csekuet@yahoo.com', 22, NULL, 2, NULL, 21, '2014-01-19 18:01:56', 21, '2014-01-19 22:20:51'),
(23, 13, 'admin', 'admin', 'admin', '', '', 1, '', '', '', 0, NULL, 1, NULL, 3, '2014-01-19 21:20:35', NULL, NULL),
(24, 13, '22201', 'shuvo', 'Alam', 'Noor', 'shuvo', 18, 'Eskaton', '01912446387', 'shuvo@yahoo.com', 23, NULL, 2, NULL, 23, '2014-01-19 21:42:49', NULL, NULL),
(25, 13, '2202', 'F', 'ALAM', 'Nissan', 'Nissan', 19, 'A', '726328721481', 'gg@aa.com', 24, NULL, 5, NULL, 23, '2014-01-19 21:50:31', 23, '2014-01-19 23:02:59'),
(26, 12, '12345678', 'Md', 'Hossain', 'Forhad', 'Forhad', 17, 'Johuri Moholla, Dhaka', '01916446676', 'forhad.csekuet@yahoo.com', 21, NULL, 5, NULL, 21, '2014-01-19 22:39:20', 21, '2014-01-19 22:59:43'),
(27, 13, '2203', 'Al', 'Hasan', 'Kajol', 'Kajol', 19, 'AA', '1234', 'a@10.com', 25, NULL, 3, NULL, 23, '2014-01-19 22:41:17', NULL, NULL),
(28, 12, '123', 'a', 'b', 'c', '', 17, '', '142342342', 'a@b.com', 26, NULL, 2, NULL, 21, '2014-01-19 22:45:20', 21, '2014-01-19 22:58:44'),
(29, 14, 'admin', 'admin', 'admin', '', '', 1, '', '', '', 0, NULL, 1, NULL, 3, '2014-01-20 20:54:52', NULL, NULL),
(30, 14, '505501', 'A', 'aa', 'aaa', 'aaaa', 23, 'fdgf', '6565', 'gfg@gfg.com', 29, NULL, 5, NULL, 29, '2014-01-20 21:12:08', NULL, NULL),
(31, 14, '505502', 'B', 'bb', 'bbb', 'bbbb', 24, 'bbvgv', '767', 'gh@hg.comc', 30, NULL, 2, NULL, 29, '2014-01-20 21:13:41', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `file_attach_list`
--

DROP TABLE IF EXISTS `file_attach_list`;
CREATE TABLE IF NOT EXISTS `file_attach_list` (
  `FILE_ATTACH_LIST_ID` int(11) NOT NULL AUTO_INCREMENT,
  `REQUEST_ID` int(11) DEFAULT NULL,
  `MODULE_NAME` varchar(60) DEFAULT NULL,
  `ATTACH_TITTLE` varchar(50) DEFAULT NULL,
  `ATTACH_FILE_PATH` varchar(250) DEFAULT NULL,
  `CREATED_BY` varchar(255) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT NULL,
  `MODIFY_BY` varchar(255) DEFAULT NULL,
  `MODIFY_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`FILE_ATTACH_LIST_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `file_attach_list`
--

INSERT INTO `file_attach_list` (`FILE_ATTACH_LIST_ID`, `REQUEST_ID`, `MODULE_NAME`, `ATTACH_TITTLE`, `ATTACH_FILE_PATH`, `CREATED_BY`, `CREATED_DATE`, `MODIFY_BY`, `MODIFY_DATE`) VALUES
(1, 5, 'requisition', 's', '../documents/requisition/21.12.10(18267)918914.jpg', '', '2014-01-03 19:56:49', NULL, NULL),
(2, 6, 'requisition', 's', '../documents/requisition/21.12.10(18267)429077.jpg', '', '2014-01-03 19:59:11', NULL, NULL),
(3, 7, 'requisition', 'xx', '../documents/requisition/M102-Syllabus.565d80a76ddb237060.pdf', '', '2014-01-09 20:22:48', NULL, NULL),
(4, 8, 'requisition', 'logo', '../documents/requisition/schoolify228881.jpg', '', '2014-01-10 14:04:22', NULL, NULL),
(5, 8, 'requisition', 'lms', '../documents/requisition/schoolifyLMS637359.jpg', '', '2014-01-10 14:04:22', NULL, NULL),
(6, 9, 'requisition', 'pdf', '../documents/requisition/pratical164672.pdf', '', '2014-01-14 20:15:30', NULL, NULL),
(7, 10, 'requisition', 'PDF', '../documents/requisition/PriceQuotationsenroute601989.pdf', '', '2014-01-15 00:07:34', NULL, NULL),
(8, 12, 'requisition', 'PDF', '../documents/requisition/ColbertBallTaxServices424285.pdf', '', '2014-01-19 22:52:14', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `ProductId` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) DEFAULT NULL,
  `Code` varchar(255) DEFAULT NULL,
  `UnitId` int(2) DEFAULT NULL,
  `CategoryId` int(11) DEFAULT NULL,
  `CreatedBy` int(11) NOT NULL,
  `CreatedDate` date NOT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `ModifiedDate` date DEFAULT NULL,
  PRIMARY KEY (`ProductId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductId`, `Name`, `Code`, `UnitId`, `CategoryId`, `CreatedBy`, `CreatedDate`, `ModifiedBy`, `ModifiedDate`) VALUES
(1, 'Penccccc', '1002', NULL, NULL, 0, '0000-00-00', NULL, NULL),
(2, 'Book', '1003', NULL, NULL, 0, '0000-00-00', NULL, NULL),
(3, 'Mobile', '1004', NULL, NULL, 0, '0000-00-00', NULL, NULL),
(4, 'Laptop', '1005', NULL, NULL, 0, '0000-00-00', NULL, NULL),
(5, 'Car', '204', NULL, NULL, 0, '0000-00-00', NULL, NULL),
(6, 'Bike', '402', NULL, NULL, 0, '0000-00-00', NULL, NULL),
(7, 'Paper', '302', NULL, NULL, 0, '0000-00-00', NULL, NULL),
(8, 'Support Stuff', '204', NULL, NULL, 0, '0000-00-00', NULL, NULL),
(9, 'X-Box', '30006', NULL, NULL, 1, '2014-01-06', NULL, NULL),
(10, 'Mobile Sony', '2001002', NULL, NULL, 1, '2014-01-06', NULL, NULL),
(11, 'test7', '10007', NULL, NULL, 1, '2014-01-19', NULL, NULL),
(12, '2222', '111111', NULL, NULL, 0, '2014-01-19', NULL, NULL),
(13, '1111', '111111', NULL, NULL, 0, '2014-01-19', NULL, NULL),
(14, 'Soap', '2001', NULL, NULL, 0, '2014-01-19', NULL, NULL),
(15, 'Soap', '2001', NULL, NULL, 0, '2014-01-19', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

DROP TABLE IF EXISTS `purchase_order`;
CREATE TABLE IF NOT EXISTS `purchase_order` (
  `PurchaseOrderId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_no` int(11) DEFAULT NULL,
  `module` varchar(50) DEFAULT NULL,
  `CompanyId` int(11) DEFAULT NULL,
  `OrderDate` date DEFAULT NULL,
  `IsActive` smallint(5) unsigned DEFAULT '0',
  `discount` decimal(10,5) NOT NULL DEFAULT '0.00000',
  `vat` decimal(10,5) NOT NULL DEFAULT '0.00000',
  `OrderStatus` int(11) DEFAULT '1' COMMENT '1New,2Deli,3rejet,4recei,5close',
  `DeliveryDate` date DEFAULT NULL,
  `CreatedBy` int(11) NOT NULL,
  `CreatedDate` date NOT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `ModifiedDate` date DEFAULT NULL,
  PRIMARY KEY (`PurchaseOrderId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `purchase_order`
--

INSERT INTO `purchase_order` (`PurchaseOrderId`, `order_no`, `module`, `CompanyId`, `OrderDate`, `IsActive`, `discount`, `vat`, `OrderStatus`, `DeliveryDate`, `CreatedBy`, `CreatedDate`, `ModifiedBy`, `ModifiedDate`) VALUES
(1, 2013000001, NULL, 54, '2013-07-23', 0, '0.00000', '0.00000', 1, NULL, 0, '0000-00-00', NULL, NULL),
(2, 2013000002, NULL, 54, '2013-07-23', 0, '0.00000', '0.00000', 1, NULL, 0, '0000-00-00', NULL, NULL),
(3, 2013000003, NULL, 55, '2013-07-23', 0, '0.00000', '0.00000', 1, NULL, 0, '0000-00-00', NULL, NULL),
(4, 2013000004, NULL, 55, '2013-07-23', 0, '0.00000', '0.00000', 4, NULL, 0, '0000-00-00', NULL, NULL),
(5, 2013000005, NULL, 56, '2013-07-27', 0, '0.00000', '0.00000', 4, NULL, 0, '0000-00-00', NULL, NULL),
(6, 2013000006, NULL, 54, '2013-07-27', 0, '0.00000', '0.00000', 1, NULL, 0, '0000-00-00', NULL, NULL),
(7, 2013000007, NULL, 57, '2013-07-27', 0, '0.00000', '0.00000', 4, NULL, 0, '0000-00-00', NULL, NULL),
(8, 2013000008, NULL, 58, '2013-07-28', 0, '0.00000', '0.00000', 4, NULL, 0, '0000-00-00', NULL, NULL),
(9, 2013000009, NULL, 60, '2013-07-29', 0, '0.00000', '0.00000', 4, NULL, 0, '0000-00-00', NULL, NULL),
(10, 2013000010, NULL, 61, '2013-07-30', 0, '0.00000', '0.00000', 4, NULL, 0, '0000-00-00', NULL, NULL),
(11, 2013000011, NULL, 62, '2013-08-03', 0, '0.00000', '0.00000', 4, NULL, 0, '0000-00-00', NULL, NULL),
(12, 2013000012, NULL, 64, '2013-08-03', 0, '0.00000', '0.00000', 4, NULL, 0, '0000-00-00', NULL, NULL),
(13, 2013000013, NULL, 63, '2013-08-03', 0, '0.00000', '0.00000', 3, NULL, 0, '0000-00-00', NULL, NULL),
(14, 2013000014, NULL, 53, '2013-08-18', 0, '0.00000', '0.00000', 1, NULL, 0, '0000-00-00', NULL, NULL),
(15, 2013000015, NULL, 70, '2013-09-03', 0, '0.00000', '0.00000', 1, NULL, 0, '0000-00-00', NULL, NULL),
(16, 2013000016, NULL, 70, '2013-09-03', 0, '0.00000', '0.00000', 1, NULL, 0, '0000-00-00', NULL, NULL),
(17, 2013000017, NULL, 70, '2013-09-03', 0, '0.00000', '0.00000', 1, NULL, 0, '0000-00-00', NULL, NULL),
(18, 2013000018, NULL, 70, '2013-09-03', 0, '0.00000', '0.00000', 4, NULL, 0, '0000-00-00', NULL, NULL),
(19, 2013000019, NULL, 73, '2013-09-03', 0, '0.00000', '0.00000', 4, NULL, 0, '0000-00-00', NULL, NULL),
(20, 2013000020, NULL, 73, '2013-09-03', 0, '5.00000', '2.00000', 2, NULL, 0, '0000-00-00', NULL, NULL),
(21, 2013000021, NULL, 73, '2013-09-03', 0, '0.00000', '0.00000', 2, NULL, 0, '0000-00-00', NULL, NULL),
(22, 2013000022, NULL, 74, '2013-09-03', 0, '0.00000', '0.00000', 4, NULL, 0, '0000-00-00', NULL, NULL),
(23, 2013000023, NULL, 75, '2013-09-03', 0, '0.00000', '0.00000', 4, NULL, 0, '0000-00-00', NULL, NULL),
(24, 2013000024, NULL, 76, '2013-09-03', 0, '0.00000', '0.00000', 4, NULL, 0, '0000-00-00', NULL, NULL),
(25, 2013000025, NULL, 77, '2013-09-03', 0, '0.00000', '0.00000', 4, NULL, 0, '0000-00-00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_details`
--

DROP TABLE IF EXISTS `purchase_order_details`;
CREATE TABLE IF NOT EXISTS `purchase_order_details` (
  `PurchaseOrderDetailsId` int(10) unsigned NOT NULL,
  `PurchaseOrderId` int(11) DEFAULT NULL,
  `ProductId` varchar(32) NOT NULL,
  `Qty` int(10) NOT NULL,
  `UnitPrice` decimal(12,2) DEFAULT NULL,
  `Discount` decimal(12,6) NOT NULL DEFAULT '0.000000',
  `DetailsStatus` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purchase_order_details`
--

INSERT INTO `purchase_order_details` (`PurchaseOrderDetailsId`, `PurchaseOrderId`, `ProductId`, `Qty`, `UnitPrice`, `Discount`, `DetailsStatus`) VALUES
(0, 6, '636', 2, '50000.00', '0.000000', 5),
(0, 7, '636', 2, '49000.00', '0.000000', 5),
(0, 7, '637', 2, '19000.00', '0.000000', 5),
(0, 8, '631', 10, '4.00', '0.000000', 5),
(0, 9, '638', 4, '25000.00', '0.000000', 5),
(0, 9, '639', 2, '11000.00', '0.000000', 5),
(0, 10, '638', 4, '25000.00', '0.000000', 5),
(0, 10, '639', 4, '11000.00', '0.000000', 5),
(0, 11, '638', 2, '25000.00', '0.000000', 5),
(0, 11, '639', 1, '11000.00', '0.000000', 5),
(0, 12, '633', 2, '10000.00', '0.000000', 5),
(0, 12, '634', 2, '20000.00', '0.000000', 5),
(0, 13, '633', 4, '18000.00', '0.000000', 5),
(0, 13, '634', 4, '30000.00', '0.000000', 5),
(0, 14, '633', 1, '20000.00', '0.000000', 5),
(0, 15, '630', 1000, '13.00', '0.000000', 5),
(0, 16, '630', 1000, '13.00', '0.000000', 5),
(0, 17, '630', 1000, '13.00', '0.000000', 5),
(0, 18, '630', 1000, '13.00', '0.000000', 5),
(0, 19, '636', 2, '22.00', '0.000000', 5),
(0, 20, '638', 2, '55.00', '0.000000', 5),
(0, 21, '639', 2, '88.00', '0.000000', 5),
(0, 22, '26', 1500, '50.00', '0.000000', 5),
(0, 23, '638', 1, '55.00', '0.000000', 5),
(0, 24, '29', 50, '0.00', '0.000000', 5),
(0, 24, '636', 20, '22.00', '0.000000', 5),
(0, 24, '638', 22, '0.00', '0.000000', 5),
(0, 25, '11', 3, '122.00', '0.000000', 5),
(0, 25, '29', 3, '222.00', '0.000000', 5),
(0, 25, '638', 3, '22.00', '0.000000', 5);

-- --------------------------------------------------------

--
-- Table structure for table `requisition`
--

DROP TABLE IF EXISTS `requisition`;
CREATE TABLE IF NOT EXISTS `requisition` (
  `RequisitionId` int(11) NOT NULL AUTO_INCREMENT,
  `RequisitionNo` varchar(255) DEFAULT NULL,
  `RequisitionDate` datetime DEFAULT NULL,
  `PresentLocationId` int(11) DEFAULT NULL,
  `Remark` varchar(255) DEFAULT NULL,
  `StatusId` int(11) DEFAULT NULL,
  `IsActive` int(11) DEFAULT NULL,
  `CompanyId` int(11) DEFAULT NULL,
  `CreatedBy` int(11) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`RequisitionId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `requisition`
--

INSERT INTO `requisition` (`RequisitionId`, `RequisitionNo`, `RequisitionDate`, `PresentLocationId`, `Remark`, `StatusId`, `IsActive`, `CompanyId`, `CreatedBy`, `CreatedDate`, `ModifiedBy`, `ModifiedDate`) VALUES
(1, '1000343', '2014-01-03 12:28:12', 2, 'This is test', 1, 1, 1, 1, '2014-01-03 12:28:45', NULL, NULL),
(2, '1000344', '2014-01-09 12:28:12', 2, 'This is test', 2, 1, 1, 1, '2014-01-03 12:28:45', NULL, '0000-00-00 00:00:00'),
(3, '1000345', '2014-01-11 12:28:12', 2, 'This is test', 2, 1, 1, 1, '2014-01-03 12:28:45', NULL, '0000-00-00 00:00:00'),
(4, '1000346', '2014-01-07 12:28:12', 2, 'This is test', 2, 1, 1, 1, '2014-01-04 12:28:45', NULL, '0000-00-00 00:00:00'),
(5, '2014000005', '2014-01-03 19:56:49', 0, 'alllllllllllllll', 1, 1, 0, 0, '2014-01-11 19:56:49', NULL, NULL),
(6, '2014000006', '2014-01-03 19:59:11', 14, 'alllllllllllllll', 5, 1, 1, 1, '2014-01-15 19:59:11', NULL, NULL),
(7, '2014000007', '2014-01-09 20:22:48', 0, 're', 3, 1, 2, 2, '2014-01-09 20:22:48', NULL, NULL),
(8, '2014000008', '2014-01-10 14:04:22', 1, 'latest model', 2, 1, 2, 3, '2014-01-08 14:04:22', NULL, NULL),
(9, '2014000009', '2014-01-14 20:15:30', 1, 'rrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr', 2, 1, 2, 4, '2014-01-14 20:15:30', NULL, NULL),
(10, '2014000010', '2014-01-15 00:07:34', 10, 'Brand', 6, 1, 2, 1, '2014-01-15 00:07:34', NULL, NULL),
(11, '2014000011', '2014-01-19 19:14:47', 0, 'Please Give the following products within 2 days. ', 1, 1, 1, 14, '2014-01-19 19:14:47', NULL, NULL),
(12, '2014000012', '2014-01-19 22:52:14', 21, 'this is form rajib', 1, 1, 12, 26, '2014-01-19 22:52:14', NULL, NULL),
(13, '2014000013', '2014-01-19 22:52:59', 25, 'I am new to requisition. ', 1, 1, 13, 27, '2014-01-19 22:52:59', NULL, NULL),
(14, '2014000014', '2014-01-19 22:53:49', 26, 'Please Give us these product within 3 days.', 1, 1, 12, 28, '2014-01-19 22:53:49', NULL, NULL),
(15, '2014000015', '2014-01-19 22:55:55', 25, 'I have a dream...', 1, 1, 13, 27, '2014-01-19 22:55:55', NULL, NULL),
(16, '2014000016', '2014-01-19 22:56:08', 26, 'Please give us these product as early as possible. ', 1, 1, 12, 28, '2014-01-19 22:56:08', NULL, NULL),
(17, '2014000017', '2014-01-20 21:19:19', 0, 'hghfhg', 4, 1, 14, 31, '2014-01-20 21:19:19', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `requisition_details`
--

DROP TABLE IF EXISTS `requisition_details`;
CREATE TABLE IF NOT EXISTS `requisition_details` (
  `RequisitionDetailsId` int(11) NOT NULL AUTO_INCREMENT,
  `requisitionId` int(11) DEFAULT NULL,
  `ProductId` int(11) DEFAULT NULL,
  `Qty` int(11) DEFAULT NULL,
  `ChallanQty` int(11) DEFAULT NULL,
  `UnitPrice` decimal(20,2) DEFAULT NULL,
  `Total` decimal(20,2) DEFAULT NULL,
  `Remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`RequisitionDetailsId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `requisition_details`
--

INSERT INTO `requisition_details` (`RequisitionDetailsId`, `requisitionId`, `ProductId`, `Qty`, `ChallanQty`, `UnitPrice`, `Total`, `Remark`) VALUES
(1, 1, 6, 80, NULL, '10.00', '800.00', 'Big'),
(2, 5, 7, 14, NULL, NULL, NULL, 'ssss'),
(3, 5, 8, 13, NULL, NULL, NULL, 'cccc'),
(4, 6, 7, 14, NULL, NULL, NULL, 'ssss'),
(5, 6, 8, 13, NULL, NULL, NULL, 'cccc'),
(6, 7, 5, 1, NULL, NULL, NULL, 'aaaaa'),
(7, 7, 6, 1, NULL, NULL, NULL, 'ssss'),
(8, 8, 5, 1, NULL, NULL, NULL, 'BMW'),
(9, 9, 5, 1, NULL, NULL, NULL, 'dfdf'),
(10, 9, 6, 1, NULL, NULL, NULL, 'fdfdf'),
(11, 10, 5, 1, NULL, NULL, NULL, 'BMW'),
(12, 10, 6, 1, NULL, NULL, NULL, 'TVS'),
(13, 11, 1, 1, NULL, NULL, NULL, ''),
(14, 11, 2, 1, NULL, NULL, NULL, ''),
(15, 11, 3, 1, NULL, NULL, NULL, ''),
(16, 12, 1, 10, NULL, NULL, NULL, ''),
(17, 13, 1, 12, NULL, NULL, NULL, 'a'),
(18, 13, 2, 13, NULL, NULL, NULL, 'b'),
(19, 14, 2, 11, NULL, NULL, NULL, 'Bangla book.'),
(20, 14, 3, 1, NULL, NULL, NULL, 'Samsung Galaxy S duos'),
(21, 15, 1, 17, NULL, NULL, NULL, 'yyg'),
(22, 15, 2, 19, NULL, NULL, NULL, '76786'),
(23, 16, 2, 11, NULL, NULL, NULL, 'English Book'),
(24, 16, 3, 2, NULL, NULL, NULL, 'Samsung '),
(25, 17, 1, 30, NULL, NULL, NULL, 'hgfghfh');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `RoleId` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) DEFAULT NULL COMMENT 'Name,y,Y,,,20,1',
  `CompanyId` int(11) DEFAULT NULL,
  `CreatedBy` int(11) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`RoleId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`RoleId`, `Name`, `CompanyId`, `CreatedBy`, `CreatedDate`, `ModifiedBy`, `ModifiedDate`) VALUES
(1, 'Admin', 2, 0, '0000-00-00 00:00:00', NULL, NULL),
(2, 'Staff', 1, 1, '0000-00-00 00:00:00', NULL, NULL),
(3, 'Customer Service', 1, 0, '0000-00-00 00:00:00', NULL, NULL),
(4, 'Accounts', 1, 0, '0000-00-00 00:00:00', NULL, NULL),
(5, 'Reviewer', 2, 0, '0000-00-00 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `StatusId` int(11) NOT NULL AUTO_INCREMENT,
  `Module` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`StatusId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`StatusId`, `Module`, `Name`) VALUES
(1, 'Draft', 'Draft'),
(2, 'requisition', 'New'),
(3, 'requisition', 'Reviewed'),
(4, 'requisition', 'Approved'),
(5, 'requisition', 'Enroute Review'),
(6, 'requisition', 'Enroute Approve');

-- --------------------------------------------------------

--
-- Table structure for table `sys_menu`
--

DROP TABLE IF EXISTS `sys_menu`;
CREATE TABLE IF NOT EXISTS `sys_menu` (
  `MenuId` int(3) NOT NULL AUTO_INCREMENT,
  `CompanyId` int(11) DEFAULT NULL,
  `Name` varchar(60) COLLATE latin1_general_ci DEFAULT NULL COMMENT 'Menu Name,y,Y,,,20,1',
  `Icon` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `Links` varchar(100) COLLATE latin1_general_ci DEFAULT NULL COMMENT 'Link,y,,,,20,7',
  `AdminSort` int(3) NOT NULL,
  `Sort` int(3) NOT NULL,
  `Show` int(1) NOT NULL,
  `Group` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `SubId` int(3) NOT NULL,
  `CreatedBy` int(11) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`MenuId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `sys_menu`
--

INSERT INTO `sys_menu` (`MenuId`, `CompanyId`, `Name`, `Icon`, `Links`, `AdminSort`, `Sort`, `Show`, `Group`, `SubId`, `CreatedBy`, `CreatedDate`, `ModifiedBy`, `ModifiedDate`) VALUES
(1, 1, 'Requisition List', 'icon-th-list', '../requisition/index.php', 4, 4, 1, 'main', 0, 0, '0000-00-00 00:00:00', NULL, NULL),
(2, 1, 'Company List', 'icon-th-list', '../company/index.php', 3, 3, 1, 'main', 0, 0, '0000-00-00 00:00:00', NULL, NULL),
(3, 1, 'Profile', 'icon-user', '../common/user_settings.php', 2, 2, 1, 'main', 0, 0, '0000-00-00 00:00:00', NULL, NULL),
(4, NULL, 'Dashboard', 'icon-home', '#', 1, 1, 1, 'main', 0, 0, '0000-00-00 00:00:00', NULL, NULL),
(5, NULL, 'Employee List', 'icon-user', '../employee/index.php', 5, 5, 1, 'main', 0, 0, '0000-00-00 00:00:00', NULL, NULL),
(6, NULL, 'Product List', 'icon-th-list', '../product/index.php', 6, 6, 1, 'main', 0, 0, '0000-00-00 00:00:00', NULL, NULL),
(7, NULL, 'User List', 'icon-th-list', '../admin/index.php', 7, 7, 0, 'main', 0, 0, '0000-00-00 00:00:00', NULL, NULL),
(8, NULL, 'Menu List', 'icon-th-list', '../menu/index.php', 8, 8, 1, 'main', 0, 0, '0000-00-00 00:00:00', NULL, NULL),
(9, NULL, 'Challan List', 'icon-th-list', '../challan/index.php', 9, 9, 1, 'main', 0, 0, '0000-00-00 00:00:00', NULL, NULL),
(10, NULL, 'Logout', 'icon-th-list', '../common/logout.php?logout=true', 10, 10, 1, 'main', 0, 0, '0000-00-00 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

DROP TABLE IF EXISTS `unit`;
CREATE TABLE IF NOT EXISTS `unit` (
  `UnitId` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) DEFAULT NULL COMMENT 'Name,y,Y,,,20,1',
  `CreatedBy` int(11) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`UnitId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`UnitId`, `Name`, `CreatedBy`, `CreatedDate`, `ModifiedBy`, `ModifiedDate`) VALUES
(1, 'Qty', 3, '2010-10-15 10:48:23', NULL, NULL),
(2, 'gm', 3, '2010-10-15 10:48:43', 0, '2013-07-15 00:00:00'),
(3, 'Nos', 0, '2010-11-27 12:39:35', NULL, NULL),
(4, 'Pound', 0, '2010-11-27 12:40:54', NULL, NULL),
(5, 'Pcs', 0, '2010-11-27 12:41:42', NULL, NULL),
(6, 'sft', 0, '0000-00-00 00:00:00', 0, '2013-07-20 00:00:00'),
(7, 'Kg', 0, '0000-00-00 00:00:00', NULL, NULL),
(8, 'Pound', 0, '0000-00-00 00:00:00', 0, '2013-07-20 00:00:00'),
(9, 'ft', 0, '2013-06-30 00:00:00', 0, '2013-07-20 00:00:00'),
(10, 'Pcs', 0, '2013-07-25 00:00:00', NULL, NULL),
(11, 'Pcs', 0, '2013-08-09 00:00:00', NULL, NULL),
(12, 'Kg', 0, '2013-08-09 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_level`
--

DROP TABLE IF EXISTS `user_level`;
CREATE TABLE IF NOT EXISTS `user_level` (
  `UserLevelId` int(11) NOT NULL AUTO_INCREMENT,
  `CompanyId` int(11) DEFAULT NULL,
  `Name` varchar(150) COLLATE latin1_general_ci DEFAULT NULL COMMENT 'Level Name,y,Y,,,20,1',
  `Sort` int(2) DEFAULT NULL COMMENT 'Sort,y,Y,,,20,1',
  `MainId` varchar(150) COLLATE latin1_general_ci NOT NULL,
  `SubId` varchar(250) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`UserLevelId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=DYNAMIC AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user_level`
--

INSERT INTO `user_level` (`UserLevelId`, `CompanyId`, `Name`, `Sort`, `MainId`, `SubId`) VALUES
(1, 1, 'Admin', 1, '1,2,3,4,5,6,7,8,9,10', '0'),
(2, 1, 'Staff', 2, '1,3,7,9,10', '0');

-- --------------------------------------------------------

--
-- Table structure for table `user_session`
--

DROP TABLE IF EXISTS `user_session`;
CREATE TABLE IF NOT EXISTS `user_session` (
  `SESSIONID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `USERNAME` varchar(32) DEFAULT NULL,
  `REMOTE_HOST` varchar(80) DEFAULT NULL,
  `LOGINTIME` datetime DEFAULT NULL,
  PRIMARY KEY (`SESSIONID`),
  KEY `FK_SESSION_USER` (`USERNAME`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=91 ;

--
-- Dumping data for table `user_session`
--

INSERT INTO `user_session` (`SESSIONID`, `USERNAME`, `REMOTE_HOST`, `LOGINTIME`) VALUES
(1, 'admin', '27.147.206.108', '2014-01-19 10:11:53'),
(2, 'admin', '27.147.206.108', '2014-01-19 10:12:05'),
(3, 'Admin', '27.147.206.108', '2014-01-19 10:12:30'),
(4, '01', '27.147.206.108', '2014-01-19 10:27:59'),
(5, 'user', '27.147.206.108', '2014-01-19 10:28:19'),
(6, 'schoolify', '27.147.206.108', '2014-01-19 10:29:00'),
(7, '01', '103.29.127.73', '2014-01-19 11:59:20'),
(8, '01', '103.29.127.73', '2014-01-19 11:59:34'),
(9, 'admin', '103.29.127.73', '2014-01-19 12:00:36'),
(10, 'admin', '103.29.127.73', '2014-01-19 12:00:46'),
(11, 'admin', '103.29.127.73', '2014-01-19 16:14:33'),
(12, 'admin', '103.29.127.73', '2014-01-19 16:32:38'),
(13, 'admin', '103.29.127.73', '2014-01-19 19:46:18'),
(14, 'admin', '103.29.127.73', '2014-01-19 19:46:32'),
(15, '01', '27.147.206.108', '2014-01-19 21:18:21'),
(16, 'admin', '27.147.206.108', '2014-01-19 21:19:17'),
(17, 'Admin', '27.147.206.108', '2014-01-19 21:21:52'),
(18, 'admin', '27.147.206.108', '2014-01-19 21:22:03'),
(19, 'admin', '27.147.206.108', '2014-01-19 21:22:32'),
(20, 'admin', '27.147.206.108', '2014-01-19 21:23:26'),
(21, '2202', '27.147.206.108', '2014-01-19 21:52:29'),
(22, '2202', '27.147.206.108', '2014-01-19 21:52:46'),
(23, '2202', '27.147.206.108', '2014-01-19 21:58:47'),
(24, 'admin', '103.29.127.73', '2014-01-19 22:00:33'),
(25, '2202', '27.147.206.108', '2014-01-19 22:01:46'),
(26, 'admin', '114.130.66.30', '2014-01-19 22:02:00'),
(27, '22201', '27.147.206.108', '2014-01-19 22:05:47'),
(28, '2201', '27.147.206.108', '2014-01-19 22:11:32'),
(29, 'admin', '114.130.64.158', '2014-01-19 22:14:49'),
(30, 'admin', '103.29.127.73', '2014-01-19 22:14:50'),
(31, 'admin', '114.130.64.158', '2014-01-19 22:15:04'),
(32, 'admin', '27.147.206.108', '2014-01-19 22:15:21'),
(33, 'admin', '114.130.64.158', '2014-01-19 22:15:25'),
(34, 'admin', '27.147.206.108', '2014-01-19 22:15:34'),
(35, 'admin', '114.130.64.158', '2014-01-19 22:15:40'),
(36, 'admin', '103.29.127.73', '2014-01-19 22:15:45'),
(37, 'admin', '103.29.127.73', '2014-01-19 22:15:55'),
(38, 'admin', '114.130.64.158', '2014-01-19 22:16:08'),
(39, 'admin', '27.147.206.108', '2014-01-19 22:16:12'),
(40, '2202', '27.147.206.108', '2014-01-19 22:16:59'),
(41, '2201', '27.147.206.108', '2014-01-19 22:17:12'),
(42, '985739833', '103.29.127.73', '2014-01-19 22:23:40'),
(43, '985739833', '103.29.127.73', '2014-01-19 22:24:13'),
(44, 'admin', '103.29.127.73', '2014-01-19 22:24:52'),
(45, 'admin', '103.29.127.73', '2014-01-19 22:37:44'),
(46, '12345678', '103.29.127.73', '2014-01-19 22:39:48'),
(47, 'admin', '27.147.206.108', '2014-01-19 22:39:53'),
(48, 'admin', '27.147.206.108', '2014-01-19 22:40:16'),
(49, 'admin', '114.130.66.30', '2014-01-19 22:41:09'),
(50, '2203', '27.147.206.108', '2014-01-19 22:41:35'),
(51, '12345678', '114.130.66.30', '2014-01-19 22:41:36'),
(52, 'admin', '103.29.127.73', '2014-01-19 22:44:35'),
(53, '123', '103.29.127.73', '2014-01-19 22:45:55'),
(54, 'admin', '27.147.206.108', '2014-01-19 22:46:49'),
(55, 'admin', '27.147.206.108', '2014-01-19 22:47:01'),
(56, '2203', '27.147.206.108', '2014-01-19 22:52:11'),
(57, 'admin', '114.130.66.30', '2014-01-19 22:58:08'),
(58, 'admin', '114.130.66.30', '2014-01-19 23:00:18'),
(59, 'admin', '114.130.66.30', '2014-01-19 23:00:33'),
(60, 'admin', '27.147.206.108', '2014-01-19 23:00:34'),
(61, 'admin', '27.147.206.108', '2014-01-19 23:01:22'),
(62, '01', '114.130.64.158', '2014-01-19 23:04:26'),
(63, '01', '27.147.206.108', '2014-01-19 23:04:33'),
(64, '01', '103.29.127.73', '2014-01-19 23:04:38'),
(65, '04', '114.130.64.158', '2014-01-19 23:11:30'),
(66, '104', '114.130.64.158', '2014-01-19 23:11:42'),
(67, '103', '114.130.64.158', '2014-01-19 23:12:00'),
(68, '103', '103.29.127.73', '2014-01-19 23:12:30'),
(69, '01', '27.147.206.108', '2014-01-19 23:13:06'),
(70, 'admin', '114.130.64.158', '2014-01-19 23:13:20'),
(71, '103', '103.29.127.73', '2014-01-19 23:13:44'),
(72, '103', '114.130.64.158', '2014-01-19 23:14:50'),
(73, '101', '114.130.64.158', '2014-01-19 23:15:48'),
(74, '101', '114.130.64.158', '2014-01-19 23:15:58'),
(75, '01', '114.130.64.158', '2014-01-19 23:16:14'),
(76, '101', '114.130.64.158', '2014-01-19 23:16:38'),
(77, '101', '114.130.64.158', '2014-01-19 23:16:46'),
(78, '101', '103.29.127.73', '2014-01-19 23:17:11'),
(79, '101', '27.147.206.108', '2014-01-19 23:17:13'),
(80, 'admin', '27.147.206.108', '2014-01-20 20:52:07'),
(81, 'admin', '27.147.206.108', '2014-01-20 21:07:17'),
(82, 'admin', '27.147.206.108', '2014-01-20 21:09:19'),
(83, '505502', '27.147.206.108', '2014-01-20 21:14:16'),
(84, '505502', '27.147.206.108', '2014-01-20 21:17:09'),
(85, '505501', '27.147.206.108', '2014-01-20 21:22:27'),
(86, 'admin', '27.147.206.108', '2014-01-20 21:27:59'),
(87, 'admin', '27.147.206.108', '2014-01-20 21:28:44'),
(88, '505502', '27.147.206.108', '2014-01-20 21:32:46'),
(89, '02', '27.147.209.190', '2014-01-21 15:12:04'),
(90, '03', '27.147.209.190', '2014-01-21 15:15:03');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

DROP TABLE IF EXISTS `user_table`;
CREATE TABLE IF NOT EXISTS `user_table` (
  `UserTableId` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(50) NOT NULL,
  `DisplayName` varchar(50) NOT NULL,
  `Password` varchar(225) NOT NULL,
  `EmployeeId` int(11) NOT NULL,
  `UserLevelId` int(2) DEFAULT NULL,
  `ActivationToken` varchar(225) NOT NULL,
  `LastActivationAequest` int(11) NOT NULL,
  `LostPasswordRequest` tinyint(1) NOT NULL,
  `IsActive` tinyint(1) NOT NULL,
  `CreatedBy` int(11) NOT NULL,
  `CreatedDate` date NOT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `ModifiedDate` date DEFAULT NULL,
  PRIMARY KEY (`UserTableId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`UserTableId`, `UserName`, `DisplayName`, `Password`, `EmployeeId`, `UserLevelId`, `ActivationToken`, `LastActivationAequest`, `LostPasswordRequest`, `IsActive`, `CreatedBy`, `CreatedDate`, `ModifiedBy`, `ModifiedDate`) VALUES
(1, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 14, 1, 'a3c308f2cb31becd53e386ee0b869c6e', 1380463670, 1, 1, 0, '0000-00-00', NULL, NULL),
(2, '103', '103', '6974ce5ac660610b44d9b9fed0ff9548', 2, 2, '', 0, 0, 0, 0, '0000-00-00', NULL, NULL),
(3, '02', '02', 'a2ef406e2c2351e0b9e80029c909242d', 3, 2, '', 0, 0, 0, 0, '0000-00-00', NULL, NULL),
(5, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 11, 1, '', 0, 0, 1, 0, '0000-00-00', NULL, NULL),
(6, '03', 'shuvo', 'e45ee7ce7e88149af8dd32b27f9512ce', 4, 2, '', 0, 0, 0, 0, '0000-00-00', NULL, NULL),
(8, '01', '01', '96a3be3cf272e017046d1b2674a52bd3', 1, 2, '', 0, 0, 1, 3, '2014-01-10', NULL, NULL),
(9, 'admin', 'Admin', '0045e287c8c7e7ba2c61879d24b797fe', 12, 1, '', 0, 0, 1, 3, '2014-01-10', NULL, NULL),
(10, '101', '101', '38b3eff8baf56627478ec76a704e9b52', 10, 2, '', 0, 0, 0, 0, '0000-00-00', NULL, NULL),
(12, '04', '04', '7d0665438e81d8eceb98c1e31fca80c1', 5, 2, '', 0, 0, 0, 0, '0000-00-00', NULL, NULL),
(13, '100', '100', 'f899139df5e1059396431415e770c6dd', 13, 2, '', 0, 0, 0, 0, '0000-00-00', NULL, NULL),
(14, '102', '102', 'ec8956637a99787bd197eacd77acce5e', 15, 2, '', 0, 0, 0, 0, '0000-00-00', NULL, NULL),
(15, 'admin', 'Admin', 'fba9d88164f3e2d9109ee770223212a0', 18, NULL, '', 0, 0, 1, 14, '2014-01-19', NULL, NULL),
(16, 'admin', 'Admin', 'fba9d88164f3e2d9109ee770223212a0', 19, NULL, '', 0, 0, 1, 14, '2014-01-19', NULL, NULL),
(17, 'admin', 'Admin', 'd0fb963ff976f9c37fc81fe03c21ea7b', 21, NULL, '', 0, 0, 1, 14, '2014-01-19', NULL, NULL),
(18, 'admin', 'Admin', 'b6d767d2f8ed5d21a44b0e5886680cb9', 23, NULL, '', 0, 0, 1, 14, '2014-01-19', NULL, NULL),
(19, '12345678', '12345678', '25d55ad283aa400af464c76d713c07ad', 26, 2, '', 0, 0, 1, 21, '2014-01-19', NULL, NULL),
(20, '2203', '2203', '2d969e2cee8cfa07ce7ca0bb13c7a36d', 27, 2, '', 0, 0, 1, 23, '2014-01-19', NULL, NULL),
(21, '123', '123', '202cb962ac59075b964b07152d234b70', 28, 2, '', 0, 0, 1, 21, '2014-01-19', NULL, NULL),
(22, 'admin', 'Admin', 'be6ad8761fe4eb9bb85934a2d21686bb', 29, NULL, '', 0, 0, 1, 14, '2014-01-20', NULL, NULL),
(23, '505501', '505501', '05da5ba5bbad83777463416881581817', 30, 2, '', 0, 0, 1, 29, '2014-01-20', NULL, NULL),
(24, '505502', '505502', 'bc002de58ccc6aa5f096a52c69ebea6b', 31, 2, '', 0, 0, 1, 29, '2014-01-20', NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
