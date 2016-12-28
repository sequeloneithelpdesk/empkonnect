-- phpMyAdmin SQL Dump
-- version 4.5.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 09, 2016 at 10:58 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hrms`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance_details`
--

CREATE TABLE `attendance_details` (
  `markIn` datetime NOT NULL,
  `markOut` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `attint`
--

CREATE TABLE `attint` (
  `Card_No` varchar(20) DEFAULT NULL,
  `Emp_Code` varchar(20) DEFAULT NULL,
  `In_Time` datetime(6) DEFAULT NULL,
  `Out_Time` datetime(6) DEFAULT NULL,
  `AttDate` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `attrequest`
--

CREATE TABLE `attrequest` (
  `Ref_No` varchar(20) NOT NULL DEFAULT '',
  `Ref_Date` datetime(6) DEFAULT NULL,
  `Emp_Code` varchar(20) DEFAULT NULL,
  `Trn_Date` datetime(6) DEFAULT NULL,
  `Att_Date` datetime(6) DEFAULT NULL,
  `In_Time` datetime(6) DEFAULT NULL,
  `Out_Time` datetime(6) DEFAULT NULL,
  `Shift_Code` varchar(20) DEFAULT NULL,
  `LvType` varchar(20) DEFAULT NULL,
  `Remarks` varchar(100) DEFAULT NULL,
  `Status` varchar(1) DEFAULT 'P',
  `CreatedOn` datetime(6) DEFAULT NULL,
  `CreatedBy` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attrequest`
--

INSERT INTO `attrequest` (`Ref_No`, `Ref_Date`, `Emp_Code`, `Trn_Date`, `Att_Date`, `In_Time`, `Out_Time`, `Shift_Code`, `LvType`, `Remarks`, `Status`, `CreatedOn`, `CreatedBy`) VALUES
('', NULL, '', NULL, '2016-05-02 00:00:00.000000', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000', 'Shift02', 'Casual Leave', 'Because of sickness issue, Please Accept my leave for today.', 'P', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bussmast`
--

CREATE TABLE `bussmast` (
  `id` int(11) NOT NULL,
  `bussCode` varchar(21) DEFAULT NULL,
  `bussName` varchar(21) DEFAULT NULL,
  `bussHname` varchar(21) DEFAULT NULL,
  `bussReport` varchar(21) DEFAULT NULL,
  `bussAbt` varchar(21) DEFAULT NULL,
  `bussAddr` varchar(21) DEFAULT NULL,
  `bussCity` varchar(21) DEFAULT NULL,
  `bussPin` varchar(21) DEFAULT NULL,
  `bussState` varchar(21) DEFAULT NULL,
  `bussCur` varchar(21) DEFAULT NULL,
  `tableType` varchar(21) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bussmast`
--

INSERT INTO `bussmast` (`id`, `bussCode`, `bussName`, `bussHname`, `bussReport`, `bussAbt`, `bussAddr`, `bussCity`, `bussPin`, `bussState`, `bussCur`, `tableType`) VALUES
(1, 'BU01', 'BU Test', 'BU Head', 'RBU Test', 'Abt test', 'bu addr', 'city', 'bu pin', 'Delhi', 'aa', 'M'),
(2, 'BU011', 'BU Development', 'IT', 'IT ', 'Devolopment', 'gurgaon', 'durgaon', '112233', 'Haryana', '$', 'T'),
(3, 'BU011', 'BU Development', 'IT', 'IT ', 'Devolopment', 'gurgaon', 'durgaon', '112233', 'Haryana', '$', 'T');

-- --------------------------------------------------------

--
-- Table structure for table `calendar`
--

CREATE TABLE `calendar` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `startdate` varchar(48) NOT NULL,
  `enddate` varchar(48) NOT NULL,
  `allDay` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `calendar`
--

INSERT INTO `calendar` (`id`, `title`, `startdate`, `enddate`, `allDay`) VALUES
(1, 'Present', '07-05-2016', '07-05-2016', '1'),
(3, 'Present', '05-07-2016', '05-07-2016', '1'),
(4, 'absent', '05-07-2016', '05-07-2016', '1'),
(5, 'absent', '07-05-2016', '07-05-2016', '1'),
(6, 'Hello', '10-05-2016', '10-05-2016', '1'),
(7, 'Hello', '05-10-2016', '05-10-2016', '1');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `message`) VALUES
(17, 'jkljafjkhasjkhfkdhka'),
(18, 'jkjdlfjaj\n');

-- --------------------------------------------------------

--
-- Table structure for table `costallocmast`
--

CREATE TABLE `costallocmast` (
  `empCode` varchar(20) NOT NULL DEFAULT '',
  `sNo` float DEFAULT NULL,
  `costPer` varchar(20) DEFAULT NULL,
  `orgMaster` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `costallocmast`
--

INSERT INTO `costallocmast` (`empCode`, `sNo`, `costPer`, `orgMaster`) VALUES
('emp01', 101, '12%', 'Org Master 1');

-- --------------------------------------------------------

--
-- Table structure for table `costmast`
--

CREATE TABLE `costmast` (
  `costCode` varchar(20) NOT NULL,
  `costName` varchar(100) DEFAULT NULL,
  `tableType` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `costmast`
--

INSERT INTO `costmast` (`costCode`, `costName`, `tableType`) VALUES
('01', 'Test01', 'Master'),
('02', 'Test02', 'Master');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `countryId` int(11) NOT NULL,
  `countryCode` varchar(4) NOT NULL,
  `countryName` varchar(50) NOT NULL,
  `Status` smallint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`countryId`, `countryCode`, `countryName`, `Status`) VALUES
(1, 'AF', 'Afghanistan', 1),
(2, 'AL', 'Albania', 1),
(3, 'DZ', 'Algeria', 1),
(4, 'DS', 'American Samoa', 1),
(5, 'AD', 'Andorra', 1),
(6, 'AO', 'Angola', 1),
(7, 'AI', 'Anguilla', 1),
(8, 'AQ', 'Antarctica', 1),
(9, 'AG', 'Antigua and Barbuda', 1),
(10, 'AR', 'Argentina', 1),
(11, 'AM', 'Armenia', 1),
(12, 'AW', 'Aruba', 1),
(13, 'AU', 'Australia', 1),
(14, 'AT', 'Austria', 1),
(15, 'AZ', 'Azerbaijan', 1),
(16, 'BS', 'Bahamas', 1),
(17, 'BH', 'Bahrain', 1),
(18, 'BD', 'Bangladesh', 1),
(19, 'BB', 'Barbados', 1),
(20, 'BY', 'Belarus', 1),
(21, 'BE', 'Belgium', 1),
(22, 'BZ', 'Belize', 1),
(23, 'BJ', 'Benin', 1),
(24, 'BM', 'Bermuda', 1),
(25, 'BT', 'Bhutan', 1),
(26, 'BO', 'Bolivia', 1),
(27, 'BA', 'Bosnia and Herzegovina', 1),
(28, 'BW', 'Botswana', 1),
(29, 'BV', 'Bouvet Island', 1),
(30, 'BR', 'Brazil', 1),
(31, 'IO', 'British Indian Ocean Territory', 1),
(32, 'BN', 'Brunei Darussalam', 1),
(33, 'BG', 'Bulgaria', 1),
(34, 'BF', 'Burkina Faso', 1),
(35, 'BI', 'Burundi', 1),
(36, 'KH', 'Cambodia', 1),
(37, 'CM', 'Cameroon', 1),
(38, 'CA', 'Canada', 1),
(39, 'CV', 'Cape Verde', 1),
(40, 'KY', 'Cayman Islands', 1),
(41, 'CF', 'Central African Republic', 1),
(42, 'TD', 'Chad', 1),
(43, 'CL', 'Chile', 1),
(44, 'CN', 'China', 1),
(45, 'CX', 'Christmas Island', 1),
(46, 'CC', 'Cocos (Keeling) Islands', 1),
(47, 'CO', 'Colombia', 1),
(48, 'KM', 'Comoros', 1),
(49, 'CG', 'Congo', 1),
(50, 'CK', 'Cook Islands', 1),
(51, 'CR', 'Costa Rica', 1),
(52, 'HR', 'Croatia (Hrvatska)', 1),
(53, 'CU', 'Cuba', 1),
(54, 'CY', 'Cyprus', 1),
(55, 'CZ', 'Czech Republic', 1),
(56, 'DK', 'Denmark', 1),
(57, 'DJ', 'Djibouti', 1),
(58, 'DM', 'Dominica', 1),
(59, 'DO', 'Dominican Republic', 1),
(60, 'TP', 'East Timor', 1),
(61, 'EC', 'Ecuador', 1),
(62, 'EG', 'Egypt', 1),
(63, 'SV', 'El Salvador', 1),
(64, 'GQ', 'Equatorial Guinea', 1),
(65, 'ER', 'Eritrea', 1),
(66, 'EE', 'Estonia', 1),
(67, 'ET', 'Ethiopia', 1),
(68, 'FK', 'Falkland Islands (Malvinas)', 1),
(69, 'FO', 'Faroe Islands', 1),
(70, 'FJ', 'Fiji', 1),
(71, 'FI', 'Finland', 1),
(72, 'FR', 'France', 1),
(73, 'FX', 'France, Metropolitan', 1),
(74, 'GF', 'French Guiana', 1),
(75, 'PF', 'French Polynesia', 1),
(76, 'TF', 'French Southern Territories', 1),
(77, 'GA', 'Gabon', 1),
(78, 'GM', 'Gambia', 1),
(79, 'GE', 'Georgia', 1),
(80, 'DE', 'Germany', 1),
(81, 'GH', 'Ghana', 1),
(82, 'GI', 'Gibraltar', 1),
(83, 'GK', 'Guernsey', 1),
(84, 'GR', 'Greece', 1),
(85, 'GL', 'Greenland', 1),
(86, 'GD', 'Grenada', 1),
(87, 'GP', 'Guadeloupe', 1),
(88, 'GU', 'Guam', 1),
(89, 'GT', 'Guatemala', 1),
(90, 'GN', 'Guinea', 1),
(91, 'GW', 'Guinea-Bissau', 1),
(92, 'GY', 'Guyana', 1),
(93, 'HT', 'Haiti', 1),
(94, 'HM', 'Heard and Mc Donald Islands', 1),
(95, 'HN', 'Honduras', 1),
(96, 'HK', 'Hong Kong', 1),
(97, 'HU', 'Hungary', 1),
(98, 'IS', 'Iceland', 1),
(99, 'IN', 'India', 1),
(100, 'IM', 'Isle of Man', 1),
(101, 'ID', 'Indonesia', 1),
(102, 'IR', 'Iran (Islamic Republic of)', 1),
(103, 'IQ', 'Iraq', 1),
(104, 'IE', 'Ireland', 1),
(105, 'IL', 'Israel', 1),
(106, 'IT', 'Italy', 1),
(107, 'CI', 'Ivory Coast', 1),
(108, 'JE', 'Jersey', 1),
(109, 'JM', 'Jamaica', 1),
(110, 'JP', 'Japan', 1),
(111, 'JO', 'Jordan', 1),
(112, 'KZ', 'Kazakhstan', 1),
(113, 'KE', 'Kenya', 1),
(114, 'KI', 'Kiribati', 1),
(115, 'KP', 'Korea, Democratic People\'s Republic of', 1),
(116, 'KR', 'Korea, Republic of', 1),
(117, 'XK', 'Kosovo', 1),
(118, 'KW', 'Kuwait', 1),
(119, 'KG', 'Kyrgyzstan', 1),
(120, 'LA', 'Lao People\'s Democratic Republic', 1),
(121, 'LV', 'Latvia', 1),
(122, 'LB', 'Lebanon', 1),
(123, 'LS', 'Lesotho', 1),
(124, 'LR', 'Liberia', 1),
(125, 'LY', 'Libyan Arab Jamahiriya', 1),
(126, 'LI', 'Liechtenstein', 1),
(127, 'LT', 'Lithuania', 1),
(128, 'LU', 'Luxembourg', 1),
(129, 'MO', 'Macau', 1),
(130, 'MK', 'Macedonia', 1),
(131, 'MG', 'Madagascar', 1),
(132, 'MW', 'Malawi', 1),
(133, 'MY', 'Malaysia', 1),
(134, 'MV', 'Maldives', 1),
(135, 'ML', 'Mali', 1),
(136, 'MT', 'Malta', 1),
(137, 'MH', 'Marshall Islands', 1),
(138, 'MQ', 'Martinique', 1),
(139, 'MR', 'Mauritania', 1),
(140, 'MU', 'Mauritius', 1),
(141, 'TY', 'Mayotte', 1),
(142, 'MX', 'Mexico', 1),
(143, 'FM', 'Micronesia, Federated States of', 1),
(144, 'MD', 'Moldova, Republic of', 1),
(145, 'MC', 'Monaco', 1),
(146, 'MN', 'Mongolia', 1),
(147, 'ME', 'Montenegro', 1),
(148, 'MS', 'Montserrat', 1),
(149, 'MA', 'Morocco', 1),
(150, 'MZ', 'Mozambique', 1),
(151, 'MM', 'Myanmar', 1),
(152, 'NA', 'Namibia', 1),
(153, 'NR', 'Nauru', 1),
(154, 'NP', 'Nepal', 1),
(155, 'NL', 'Netherlands', 1),
(156, 'AN', 'Netherlands Antilles', 1),
(157, 'NC', 'New Caledonia', 1),
(158, 'NZ', 'New Zealand', 1),
(159, 'NI', 'Nicaragua', 1),
(160, 'NE', 'Niger', 1),
(161, 'NG', 'Nigeria', 1),
(162, 'NU', 'Niue', 1),
(163, 'NF', 'Norfolk Island', 1),
(164, 'MP', 'Northern Mariana Islands', 1),
(165, 'NO', 'Norway', 1),
(166, 'OM', 'Oman', 1),
(167, 'PK', 'Pakistan', 1),
(168, 'PW', 'Palau', 1),
(169, 'PS', 'Palestine', 1),
(170, 'PA', 'Panama', 1),
(171, 'PG', 'Papua New Guinea', 1),
(172, 'PY', 'Paraguay', 1),
(173, 'PE', 'Peru', 1),
(174, 'PH', 'Philippines', 1),
(175, 'PN', 'Pitcairn', 1),
(176, 'PL', 'Poland', 1),
(177, 'PT', 'Portugal', 1),
(178, 'PR', 'Puerto Rico', 1),
(179, 'QA', 'Qatar', 1),
(180, 'RE', 'Reunion', 1),
(181, 'RO', 'Romania', 1),
(182, 'RU', 'Russian Federation', 1),
(183, 'RW', 'Rwanda', 1),
(184, 'KN', 'Saint Kitts and Nevis', 1),
(185, 'LC', 'Saint Lucia', 1),
(186, 'VC', 'Saint Vincent and the Grenadines', 1),
(187, 'WS', 'Samoa', 1),
(188, 'SM', 'San Marino', 1),
(189, 'ST', 'Sao Tome and Principe', 1),
(190, 'SA', 'Saudi Arabia', 1),
(191, 'SN', 'Senegal', 1),
(192, 'RS', 'Serbia', 1),
(193, 'SC', 'Seychelles', 1),
(194, 'SL', 'Sierra Leone', 1),
(195, 'SG', 'Singapore', 1),
(196, 'SK', 'Slovakia', 1),
(197, 'SI', 'Slovenia', 1),
(198, 'SB', 'Solomon Islands', 1),
(199, 'SO', 'Somalia', 1),
(200, 'ZA', 'South Africa', 1),
(201, 'GS', 'South Georgia South Sandwich Islands', 1),
(202, 'ES', 'Spain', 1),
(203, 'LK', 'Sri Lanka', 1),
(204, 'SH', 'St. Helena', 1),
(205, 'PM', 'St. Pierre and Miquelon', 1),
(206, 'SD', 'Sudan', 1),
(207, 'SR', 'Suriname', 1),
(208, 'SJ', 'Svalbard and Jan Mayen Islands', 1),
(209, 'SZ', 'Swaziland', 1),
(210, 'SE', 'Sweden', 1),
(211, 'CH', 'Switzerland', 1),
(212, 'SY', 'Syrian Arab Republic', 1),
(213, 'TW', 'Taiwan', 1),
(214, 'TJ', 'Tajikistan', 1),
(215, 'TZ', 'Tanzania, United Republic of', 1),
(216, 'TH', 'Thailand', 1),
(217, 'TG', 'Togo', 1),
(218, 'TK', 'Tokelau', 1),
(219, 'TO', 'Tonga', 1),
(220, 'TT', 'Trinidad and Tobago', 1),
(221, 'TN', 'Tunisia', 1),
(222, 'TR', 'Turkey', 1),
(223, 'TM', 'Turkmenistan', 1),
(224, 'TC', 'Turks and Caicos Islands', 1),
(225, 'TV', 'Tuvalu', 1),
(226, 'UG', 'Uganda', 1),
(227, 'UA', 'Ukraine', 1),
(228, 'AE', 'United Arab Emirates', 1),
(229, 'GB', 'United Kingdom', 1),
(230, 'US', 'United States', 1),
(231, 'UM', 'United States minor outlying islands', 1),
(232, 'UY', 'Uruguay', 1),
(233, 'UZ', 'Uzbekistan', 1),
(234, 'VU', 'Vanuatu', 1),
(235, 'VA', 'Vatican City State', 1),
(236, 'VE', 'Venezuela', 1),
(237, 'VN', 'Vietnam', 1),
(238, 'VG', 'Virgin Islands (British)', 1),
(239, 'VI', 'Virgin Islands (U.S.)', 1),
(240, 'WF', 'Wallis and Futuna Islands', 1),
(241, 'EH', 'Western Sahara', 1),
(242, 'YE', 'Yemen', 1),
(243, 'YU', 'Yugoslavia', 1),
(244, 'ZR', 'Zaire', 1),
(245, 'ZM', 'Zambia', 1),
(246, 'ZW', 'Zimbabwe', 1);

-- --------------------------------------------------------

--
-- Table structure for table `deptnotification`
--

CREATE TABLE `deptnotification` (
  `id` int(11) NOT NULL,
  `uid` varchar(20) DEFAULT NULL,
  `notifyTo` varchar(20) DEFAULT NULL,
  `deptId` varchar(20) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `notifyDate` datetime(6) DEFAULT NULL,
  `notification` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deptnotification`
--

INSERT INTO `deptnotification` (`id`, `uid`, `notifyTo`, `deptId`, `status`, `notifyDate`, `notification`) VALUES
(1, '', 'Account', 'Account012', 1, '2016-05-05 00:00:00.000000', 'There is a New Joinee in your dept. welcome him.'),
(2, '', 'IT', 'ITdev', 1, '2016-05-06 00:00:00.000000', 'Due to maintenance of systems tomorrow is holiday.'),
(3, '1', 'IT', 'IT-PHP', 1, '2016-05-06 00:00:00.000000', 'The New Project is in the queue Please contact your functional team for details.');

-- --------------------------------------------------------

--
-- Table structure for table `emphrdmast`
--

CREATE TABLE `emphrdmast` (
  `empCode` varchar(20) NOT NULL DEFAULT '',
  `empTitle` varchar(4) DEFAULT NULL,
  `empFName` varchar(50) DEFAULT NULL,
  `empMName` varchar(50) DEFAULT NULL,
  `empLName` varchar(50) DEFAULT NULL,
  `statusCode` varchar(10) DEFAULT NULL,
  `doj` datetime DEFAULT NULL,
  `dojWef` datetime DEFAULT NULL,
  `probPeriod` smallint(2) DEFAULT NULL,
  `probPeriodExtended` smallint(2) DEFAULT NULL,
  `dor` datetime DEFAULT NULL,
  `dol` datetime DEFAULT NULL,
  `dolWef` datetime DEFAULT NULL,
  `dos` datetime DEFAULT NULL,
  `pfNo` varchar(20) DEFAULT NULL,
  `fpfNo` varchar(20) DEFAULT NULL,
  `esiNo` varchar(20) DEFAULT NULL,
  `lwfNo` varchar(20) DEFAULT NULL,
  `safNo` varchar(20) DEFAULT NULL,
  `grtNo` varchar(20) DEFAULT NULL,
  `panNo` varchar(20) DEFAULT NULL,
  `ptNo` varchar(20) DEFAULT NULL,
  `smopNo` varchar(20) DEFAULT NULL,
  `rmopNo` varchar(20) DEFAULT NULL,
  `mAddr1` varchar(100) DEFAULT NULL,
  `mAddr2` varchar(100) DEFAULT NULL,
  `mAddr3` varchar(100) DEFAULT NULL,
  `mCity` varchar(50) DEFAULT NULL,
  `mRegion` varchar(10) DEFAULT NULL,
  `mState` varchar(20) DEFAULT NULL,
  `mCountry` varchar(20) DEFAULT NULL,
  `mPin` varchar(6) DEFAULT NULL,
  `mPhoneNo` varchar(100) DEFAULT NULL,
  `pAddr1` varchar(100) DEFAULT NULL,
  `pAddr2` varchar(100) DEFAULT NULL,
  `pAddr3` varchar(100) DEFAULT NULL,
  `pCity` varchar(50) DEFAULT NULL,
  `pRegion` varchar(10) DEFAULT NULL,
  `pState` varchar(20) DEFAULT NULL,
  `pCountry` varchar(20) DEFAULT NULL,
  `pPin` varchar(6) DEFAULT NULL,
  `pPhoneNo` varchar(100) DEFAULT NULL,
  `mobileNo` varchar(100) DEFAULT NULL,
  `faxNo` varchar(20) DEFAULT NULL,
  `dob` datetime(6) DEFAULT NULL,
  `birthPlace` varchar(50) DEFAULT NULL,
  `domicile` varchar(50) DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `mStatus` smallint(2) DEFAULT NULL,
  `religion` varchar(10) DEFAULT NULL,
  `nationality` varchar(20) DEFAULT NULL,
  `passportNo` varchar(20) DEFAULT NULL,
  `passportValidityDate` datetime(6) DEFAULT NULL,
  `passportAddress` varchar(100) DEFAULT NULL,
  `passportPlace` varchar(30) DEFAULT NULL,
  `dlNo` varchar(20) DEFAULT NULL,
  `dlValidityDate` datetime(6) DEFAULT NULL,
  `dlAddress` varchar(255) DEFAULT NULL,
  `dlPlace` varchar(30) DEFAULT NULL,
  `fathHusb` varchar(1) DEFAULT NULL,
  `fathHusbName` varchar(100) DEFAULT NULL,
  `fathHusbOcupation` varchar(50) DEFAULT NULL,
  `emergencyName` varchar(100) DEFAULT NULL,
  `emergencyRelation` varchar(20) DEFAULT NULL,
  `emergencyAddress` varchar(255) DEFAULT NULL,
  `emergencyPhoneNo` varchar(50) DEFAULT NULL,
  `bloodGrp` varchar(3) DEFAULT NULL,
  `oEMailId` varchar(200) DEFAULT NULL,
  `oEMailPwd` varchar(10) DEFAULT NULL,
  `pEMailId` varchar(200) DEFAULT NULL,
  `pEMailPwd` varchar(10) DEFAULT NULL,
  `empImage` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emphrdmast`
--

INSERT INTO `emphrdmast` (`empCode`, `empTitle`, `empFName`, `empMName`, `empLName`, `statusCode`, `doj`, `dojWef`, `probPeriod`, `probPeriodExtended`, `dor`, `dol`, `dolWef`, `dos`, `pfNo`, `fpfNo`, `esiNo`, `lwfNo`, `safNo`, `grtNo`, `panNo`, `ptNo`, `smopNo`, `rmopNo`, `mAddr1`, `mAddr2`, `mAddr3`, `mCity`, `mRegion`, `mState`, `mCountry`, `mPin`, `mPhoneNo`, `pAddr1`, `pAddr2`, `pAddr3`, `pCity`, `pRegion`, `pState`, `pCountry`, `pPin`, `pPhoneNo`, `mobileNo`, `faxNo`, `dob`, `birthPlace`, `domicile`, `sex`, `mStatus`, `religion`, `nationality`, `passportNo`, `passportValidityDate`, `passportAddress`, `passportPlace`, `dlNo`, `dlValidityDate`, `dlAddress`, `dlPlace`, `fathHusb`, `fathHusbName`, `fathHusbOcupation`, `emergencyName`, `emergencyRelation`, `emergencyAddress`, `emergencyPhoneNo`, `bloodGrp`, `oEMailId`, `oEMailPwd`, `pEMailId`, `pEMailPwd`, `empImage`) VALUES
('', '', '', '', '', 'Emp Status', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Maharastra', '', '', '', '', '', '', '', '', '--Maharastra--', '', '', '', '', '', '0000-00-00 00:00:00.000000', '', '', 'Male', 0, '', '', '', '0000-00-00 00:00:00.000000', '', '', '', '0000-00-00 00:00:00.000000', '', '', 'F', '', '', '', '', '', '', '', '', '', '', '', ''),
('1111', 'Mr', 'abc', 'asd', 'aaaa', 'active', '2012-05-19 00:00:00', '2016-04-25 00:00:00', 1, 15, '2016-04-10 00:00:00', '2016-05-10 00:00:00', '2016-05-10 00:00:00', '2016-05-24 00:00:00', '111111111', '5544566546464', '2213247894654163', '23546576123123', '113464', '854679', '4445555123', '123654789', '112233445566778899', '123456789', 'aaa', 'bbbbbdsss', 'ddddddddddf', 'delhi', 'fffff', 'Delhi', 'sql', '110021', '1234567890', 'abc', 'ancdd', 'asdff', 'ffff', 'fffff', 'Haryana', 'India', '111111', '1234567890', '123456789', '11111112222', '2016-04-05 00:00:00.000000', 'gurgaon', 'guragon', 'Male', 0, 'Indian', 'Indian', '123321', '2028-04-19 00:00:00.000000', 'aaaaaasdsdsdsdsdsdsdsdsdsdsdsdsdsd', 'asdfg', '543216', '2016-04-23 00:00:00.000000', 'aaaa', 'aaa', 'F', 'aaa', 'aaa', 'aaaa', 'aaa', 'aaad', 'dddd', 'b', 'abc@gmail.com', '123456', '', '123456', 'images.png'),
('1112', 'Mrs', 'Geeta', 'Kumari', 'Verma', 'Emp Status', '2016-04-01 00:00:00', '2016-05-15 00:00:00', 1, 1, '2016-05-01 00:00:00', '2016-05-15 00:00:00', '2016-05-15 00:00:00', '2016-05-20 00:00:00', 'xxxx12345x', 'yyyy4321y', 'xxxxx1234x', 'L12345', '1234556', '543211', 'xx1234xx12', 'P1234X12', '12121345512345', '1237896543214', 'HN. 600 Hauz Khas Village', 'Sarvpriya vihar, New Delhi', 'South Delhi, Delhi', 'New Delhi', 'South Delh', 'Delhi', '', '110016', '01112345678', '634 Udhyog vihar phase 5', 'Near Shankar Chawk', 'Haryana', 'Gurgaon', 'Phase 5 ', 'Haryana', '', '220012', '01154545454', '9988776655', '12121331212', '1992-08-15 00:00:00.000000', 'New Delhi', 'Canought Place', 'Female', 0, 'Hindu', 'Indaian', '54361256', '2017-09-20 00:00:00.000000', 'Udhyog Vihar, Gurgaon, Haryana', 'Haryana', 'DL123123123', '2017-04-13 00:00:00.000000', 'Ashok Nagar, New Delhi', 'Delhi', 'F', 'Mr. Ram Prakash', 'Teacher', 'Mr Vijay Kumar', 'Senior', '634 udhyog vihar, Haryana', '123456554', 'B+', 'myemail@sequelone.com', '123456', '', '123456', 'logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `emphrdtran`
--

CREATE TABLE `emphrdtran` (
  `empCode` varchar(21) NOT NULL DEFAULT '',
  `trnWef` datetime DEFAULT NULL,
  `trnDate` datetime DEFAULT NULL,
  `statusCode` varchar(21) DEFAULT NULL,
  `dsgCode` varchar(21) DEFAULT NULL,
  `grdCode` varchar(21) DEFAULT NULL,
  `compCode` varchar(21) DEFAULT NULL,
  `regnCode` varchar(21) DEFAULT NULL,
  `locCode` varchar(21) DEFAULT NULL,
  `diviCode` varchar(21) DEFAULT NULL,
  `sectCode` varchar(21) DEFAULT NULL,
  `deptCode` varchar(21) DEFAULT NULL,
  `costCode` varchar(21) DEFAULT NULL,
  `procCode` varchar(21) DEFAULT NULL,
  `functcode` varchar(21) DEFAULT NULL,
  `subFunctCode` varchar(21) DEFAULT NULL,
  `wLocCode` varchar(21) DEFAULT NULL,
  `bussCode` varchar(21) DEFAULT NULL,
  `empTypeCode` varchar(21) DEFAULT NULL,
  `roleCODE` varchar(21) DEFAULT NULL,
  `levelCODE` varchar(21) DEFAULT NULL,
  `mngrCode` varchar(21) DEFAULT NULL,
  `mngrCode2` varchar(21) DEFAULT NULL,
  `pfCode` varchar(21) DEFAULT NULL,
  `pfNo` varchar(21) DEFAULT NULL,
  `fpfCode` varchar(21) DEFAULT NULL,
  `fpfNo` varchar(21) DEFAULT NULL,
  `esiCode` varchar(21) DEFAULT NULL,
  `esiNo` varchar(21) DEFAULT NULL,
  `lwfCode` varchar(21) DEFAULT NULL,
  `lwfNo` varchar(21) DEFAULT NULL,
  `safCode` varchar(21) DEFAULT NULL,
  `safNo` varchar(21) DEFAULT NULL,
  `grtCode` varchar(21) DEFAULT NULL,
  `grtNo` varchar(21) DEFAULT NULL,
  `itCode` varchar(21) DEFAULT NULL,
  `panNo` varchar(21) DEFAULT NULL,
  `tanNo` varchar(21) DEFAULT NULL,
  `ptCode` varchar(21) DEFAULT NULL,
  `ptNo` varchar(21) DEFAULT NULL,
  `smopCode` varchar(21) DEFAULT NULL,
  `smopNo` varchar(21) DEFAULT NULL,
  `rmopCode` varchar(21) DEFAULT NULL,
  `rmopNo` varchar(21) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emphrdtran`
--

INSERT INTO `emphrdtran` (`empCode`, `trnWef`, `trnDate`, `statusCode`, `dsgCode`, `grdCode`, `compCode`, `regnCode`, `locCode`, `diviCode`, `sectCode`, `deptCode`, `costCode`, `procCode`, `functcode`, `subFunctCode`, `wLocCode`, `bussCode`, `empTypeCode`, `roleCODE`, `levelCODE`, `mngrCode`, `mngrCode2`, `pfCode`, `pfNo`, `fpfCode`, `fpfNo`, `esiCode`, `esiNo`, `lwfCode`, `lwfNo`, `safCode`, `safNo`, `grtCode`, `grtNo`, `itCode`, `panNo`, `tanNo`, `ptCode`, `ptNo`, `smopCode`, `smopNo`, `rmopCode`, `rmopNo`) VALUES
('1111', '2016-04-06 00:00:00', '2016-04-05 00:00:00', 'active', '22', '22', '1234', '1234', '12345', '1234', '1234', '1234', '1234', 'process01', 'funct01', '1234', '1234', 'BU01', 'a', '123', 'a', '12', '21', '12', '1111111', '222', '5544566546464', '1111111', '2213247894654163', '111111111111111', '23546576123123', '22222222222', '113464', '2222222222', '854679', '111111111111', '4445555123', '111', '999', '666', '11111111', '11111111', '1111111111', '11111111');

-- --------------------------------------------------------

--
-- Table structure for table `emptypemast`
--

CREATE TABLE `emptypemast` (
  `empTypeCode` varchar(20) NOT NULL,
  `empTypeName` varchar(100) DEFAULT NULL,
  `empTypeAbt` varchar(100) DEFAULT NULL,
  `tableType` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emptypemast`
--

INSERT INTO `emptypemast` (`empTypeCode`, `empTypeName`, `empTypeAbt`, `tableType`) VALUES
('emptype01', 'test', 'HR', 'm'),
('emptype02', 'asd', 'HR', 'M');

-- --------------------------------------------------------

--
-- Table structure for table `functmast`
--

CREATE TABLE `functmast` (
  `id` int(11) NOT NULL,
  `functCode` varchar(21) DEFAULT NULL,
  `functName` varchar(100) DEFAULT NULL,
  `functType` varchar(100) DEFAULT NULL,
  `functHead` varchar(21) DEFAULT NULL,
  `tableType` varchar(21) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `functmast`
--

INSERT INTO `functmast` (`id`, `functCode`, `functName`, `functType`, `functHead`, `tableType`) VALUES
(1, '', '', '', 'Head function', 'M'),
(2, 'funct01', 'Test function', 'Function Type 1', 'Head function', 'M'),
(3, '5501', 'test', 'Function Type 2', 'Head function', 'm'),
(4, '5501', 'test', 'Function Type 2', 'Head function', 'm'),
(5, 'aa', 'aa', 'Function abc', '', 'aa');

-- --------------------------------------------------------

--
-- Table structure for table `grdmast`
--

CREATE TABLE `grdmast` (
  `grdCode` varchar(20) NOT NULL,
  `grdName` varchar(100) DEFAULT NULL,
  `grdUnder` varchar(100) DEFAULT NULL,
  `tableType` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grdmast`
--

INSERT INTO `grdmast` (`grdCode`, `grdName`, `grdUnder`, `tableType`) VALUES
('grd1', 'grade0012', '5', 'Master');

-- --------------------------------------------------------

--
-- Table structure for table `holidaymast`
--

CREATE TABLE `holidaymast` (
  `hDate` datetime(6) NOT NULL DEFAULT '0000-00-00 00:00:00.000000',
  `locCode` varchar(100) DEFAULT NULL,
  `hCode` varchar(100) DEFAULT NULL,
  `hDesc` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `holidaymast`
--

INSERT INTO `holidaymast` (`hDate`, `locCode`, `hCode`, `hDesc`) VALUES
('2016-04-07 00:00:00.000000', 'Gurgaon', '02', 'Test'),
('2016-04-20 00:00:00.000000', 'NULL', '01', 'Mahaveer Jayanti'),
('2016-08-15 00:00:00.000000', 'Delhi', 'GovHoli', 'Independence Day');

-- --------------------------------------------------------

--
-- Table structure for table `hrdnominee`
--

CREATE TABLE `hrdnominee` (
  `Emp_Code` varchar(20) DEFAULT NULL,
  `Nominee_Name` varchar(50) DEFAULT NULL,
  `Nominee_Relation` varchar(20) DEFAULT NULL,
  `Nominee_DOB` datetime(6) DEFAULT NULL,
  `Nominee_Addr1` varchar(50) DEFAULT NULL,
  `Nominee_Addr2` varchar(50) DEFAULT NULL,
  `Nominee_Addr3` varchar(50) DEFAULT NULL,
  `Nominee_City` varchar(20) DEFAULT NULL,
  `Nominee_Pin` int(6) DEFAULT NULL,
  `Nominee_PhoneNo` int(20) DEFAULT NULL,
  `Nominee_WEF` varchar(20) DEFAULT NULL,
  `Nominee_Share1` varchar(20) DEFAULT NULL,
  `Nominee_Share2` varchar(20) DEFAULT NULL,
  `Nominee_Share3` varchar(20) DEFAULT NULL,
  `Nominee_Share4` varchar(20) DEFAULT NULL,
  `Nominee_Share5` varchar(20) DEFAULT NULL,
  `Nominee_Share6` varchar(20) DEFAULT NULL,
  `Nominee_Share7` varchar(20) DEFAULT NULL,
  `Nominee_Share8` varchar(20) DEFAULT NULL,
  `Nominee_Share9` varchar(20) DEFAULT NULL,
  `Nominee_Share10` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hrms_company_details`
--

CREATE TABLE `hrms_company_details` (
  `COMPCODE` varchar(21) NOT NULL DEFAULT '',
  `COMPNAME` varchar(21) DEFAULT NULL,
  `COMPADDR` varchar(21) DEFAULT NULL,
  `COMPCITY` varchar(21) DEFAULT NULL,
  `COMPSTATE` varchar(21) DEFAULT NULL,
  `COMPPIN` varchar(21) DEFAULT NULL,
  `COMPESINO` varchar(21) DEFAULT NULL,
  `COMPPANNO` varchar(21) DEFAULT NULL,
  `COMPPFNO` varchar(21) DEFAULT NULL,
  `COMPTANNO` varchar(21) DEFAULT NULL,
  `SIGNNAME` varchar(21) DEFAULT NULL,
  `SIGNADDR` varchar(21) DEFAULT NULL,
  `SIGNCITY` varchar(21) DEFAULT NULL,
  `SIGNDSG` varchar(21) DEFAULT NULL,
  `SIGNSTATE` varchar(21) DEFAULT NULL,
  `SIGNPIN` varchar(21) DEFAULT NULL,
  `SIGNPLACE` varchar(21) DEFAULT NULL,
  `SIGNDATE` varchar(21) DEFAULT NULL,
  `DLIPER` varchar(21) DEFAULT NULL,
  `EFPFPER` varchar(21) DEFAULT NULL,
  `EPFPER` varchar(21) DEFAULT NULL,
  `FPFPER` varchar(21) DEFAULT NULL,
  `PAYSLPNOTE` varchar(21) DEFAULT NULL,
  `PFADMCH` varchar(21) DEFAULT NULL,
  `PFINT` varchar(21) DEFAULT NULL,
  `PFPER` varchar(21) DEFAULT NULL,
  `SLPNOTE1` varchar(21) DEFAULT NULL,
  `SLPNOTE2` varchar(21) DEFAULT NULL,
  `DLIADMCH` varchar(21) DEFAULT NULL,
  `ESIPER` varchar(21) DEFAULT NULL,
  `EESIPER` varchar(21) DEFAULT NULL,
  `COMPURL` varchar(21) DEFAULT NULL,
  `CITAddr` varchar(21) DEFAULT NULL,
  `CITCity` varchar(21) DEFAULT NULL,
  `CITPIN` varchar(21) DEFAULT NULL,
  `CompLogo` varchar(21) DEFAULT NULL,
  `CurBase` varchar(21) DEFAULT NULL,
  `PayCycle` varchar(21) DEFAULT NULL,
  `CurPay` varchar(21) DEFAULT NULL,
  `COMPSTATUS` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_company_details`
--

INSERT INTO `hrms_company_details` (`COMPCODE`, `COMPNAME`, `COMPADDR`, `COMPCITY`, `COMPSTATE`, `COMPPIN`, `COMPESINO`, `COMPPANNO`, `COMPPFNO`, `COMPTANNO`, `SIGNNAME`, `SIGNADDR`, `SIGNCITY`, `SIGNDSG`, `SIGNSTATE`, `SIGNPIN`, `SIGNPLACE`, `SIGNDATE`, `DLIPER`, `EFPFPER`, `EPFPER`, `FPFPER`, `PAYSLPNOTE`, `PFADMCH`, `PFINT`, `PFPER`, `SLPNOTE1`, `SLPNOTE2`, `DLIADMCH`, `ESIPER`, `EESIPER`, `COMPURL`, `CITAddr`, `CITCity`, `CITPIN`, `CompLogo`, `CurBase`, `PayCycle`, `CurPay`, `COMPSTATUS`) VALUES
('1', 'sssadr', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
('111', 'microsoft', 'usa', 'singapour', 'Maharastra', '6668888', '3333', '111', '1234', 'tan5637', 'acbd', 'sldo eloife ', 'jjjj', 'llooh', 'Delhi', 'lhjo', 'ljlkjl', '2016-04-01', '11', '11', '13', '13', 'Helloo', '5', '22', NULL, 'hi buddy', 'how r u', '11', '11', '11', 'abcdef', 'hh', 'hh', '111111', 'images.png', 'Doller $', 'Monthly', 'Doller $', 0),
('121', 'HCL', 'Punjab', 'Ludhiyana', 'Punjab', '758463', '54545452', '12313434', '132163456', '231316464564', 'singh sahab', 'Ganga Nagar', 'Jaypur', 'xyz', 'Rajasthan', '445344', 'delhi', NULL, '12', '12', '3', '14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
('abc01', 'Hello techno', 'noida', 'noida', 'UP', '221512', '1112', '111222', '2323231', '1231313', 'ased', 'agra', 'agra', 'abc', 'UP', '1232354', 'agra', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
('spx', 'Sparx Technology', 'Noida 63', 'Noida', 'Uttar Pradesh', '223344', '123456', '123456', '123456', '123456', 'Hari', 'delhi', 'new delhi', 'abc', 'Delhi', '123456', 'delhi', '2016-04-11', '3', '11', '13', '13', 'Helloo', '5', '8', NULL, 'hi buddy', 'how r u', '11', '11', '11', '', '', '', '111111', 'logo.png', 'INR', 'Daily', 'INR', 0);

-- --------------------------------------------------------

--
-- Table structure for table `hrms_company_setup`
--

CREATE TABLE `hrms_company_setup` (
  `compId` int(10) NOT NULL COMMENT 'It is auto incremented value and uniquely identified',
  `compCode` varchar(21) NOT NULL COMMENT 'Its Unique code for Company',
  `compName` varchar(101) NOT NULL,
  `compCountry` varchar(31) NOT NULL,
  `compStatus` tinyint(1) NOT NULL,
  `compRemarks` text NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_company_setup`
--

INSERT INTO `hrms_company_setup` (`compId`, `compCode`, `compName`, `compCountry`, `compStatus`, `compRemarks`, `isActive`, `isDeleted`) VALUES
(1, 'SQL', 'Sequel Mynd Solution Pvt. Ltd.', 'IND', 1, 'Testing Setup', 1, 0),
(2, 'SQLQ', 'Sequel Mynd Solution Pvt. Ltd.', 'IND', 1, 'Testing Setup', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `hrms_global_reset_options`
--

CREATE TABLE `hrms_global_reset_options` (
  `gId` int(11) NOT NULL,
  `companyId` int(11) NOT NULL,
  `resetOptions` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_global_reset_options`
--

INSERT INTO `hrms_global_reset_options` (`gId`, `companyId`, `resetOptions`) VALUES
(1, 1, 'email,phone,pan');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_menu`
--

CREATE TABLE `hrms_menu` (
  `mId` int(8) NOT NULL COMMENT 'menuId is auto incremented value for uniquely identified.',
  `mParentId` int(10) NOT NULL,
  `userId` int(10) NOT NULL,
  `mName` varchar(51) NOT NULL,
  `companyCode` varchar(21) NOT NULL,
  `addedBy` varchar(50) NOT NULL,
  `createDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mStatus` tinyint(1) NOT NULL DEFAULT '1',
  `menuSequence` int(9) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_menu`
--

INSERT INTO `hrms_menu` (`mId`, `mParentId`, `userId`, `mName`, `companyCode`, `addedBy`, `createDate`, `mStatus`, `menuSequence`, `isDeleted`) VALUES
(1, 0, 1, 'Home', 'SQL', 'Om shukla', '2016-04-08 10:27:26', 1, 1, 0),
(2, 1, 1, 'Home', 'SQL', 'Hariom Shukla', '2016-04-08 10:27:26', 1, 1, 0),
(3, 0, 0, 'Contact Us', 'SQl02', 'Hari', '0000-00-00 00:00:00', 0, 0, 0),
(4, 0, 0, 'test', 'sql', 'Subodh', '2016-04-25 14:39:14', 0, 0, 0),
(5, 0, 0, 'leave', 'sql', 'Subodh', '2016-04-25 14:47:53', 1, 0, 0),
(6, 0, 0, 'SetUp', 'sql', 'Subodh', '2016-04-25 14:48:18', 1, 0, 0),
(7, 0, 0, 'Test', 'Google', 'Bill Gates', '2016-04-29 15:48:24', 0, 0, 0),
(8, 0, 0, 'Setting', 'SQL', 'Subodh', '2016-05-02 10:37:03', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `hrms_reset_links`
--

CREATE TABLE `hrms_reset_links` (
  `rlId` int(11) NOT NULL,
  `companyId` int(7) NOT NULL,
  `depId` varchar(211) NOT NULL,
  `userId` varchar(255) NOT NULL,
  `resetOptions` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hrms_role_menu`
--

CREATE TABLE `hrms_role_menu` (
  `id` int(11) NOT NULL,
  `roleId` int(11) NOT NULL,
  `menuId` varchar(101) NOT NULL,
  `subMenuId` varchar(101) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_role_menu`
--

INSERT INTO `hrms_role_menu` (`id`, `roleId`, `menuId`, `subMenuId`) VALUES
(1, 1, '1', '2,9');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_role_type`
--

CREATE TABLE `hrms_role_type` (
  `roleId` int(11) NOT NULL,
  `roleName` varchar(31) NOT NULL,
  `isActive` tinyint(1) NOT NULL COMMENT 'This role is inactive or not'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_role_type`
--

INSERT INTO `hrms_role_type` (`roleId`, `roleName`, `isActive`) VALUES
(1, 'Employee', 1),
(2, 'HR User', 1),
(3, 'Central User', 1),
(4, 'Admin', 1),
(6, 'HR Admin', 1),
(7, 'Developer', 1),
(8, 'IT Head', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hrms_users`
--

CREATE TABLE `hrms_users` (
  `userId` int(10) NOT NULL,
  `userFName` varchar(21) NOT NULL,
  `userMName` varchar(21) NOT NULL,
  `userLName` varchar(21) NOT NULL,
  `userPWD` varchar(51) NOT NULL,
  `userRoleId` varchar(221) NOT NULL,
  `userMenuId` varchar(51) NOT NULL,
  `userEmailId` varchar(51) NOT NULL,
  `pwdChangeDate` datetime NOT NULL,
  `IsLocked` tinyint(1) NOT NULL DEFAULT '1',
  `lockDate` datetime NOT NULL,
  `unLockDate` datetime NOT NULL,
  `userActive` datetime NOT NULL,
  `pwdChangeOnLogon` int(4) NOT NULL,
  `PasswordChangeAllowed` varchar(20) NOT NULL,
  `pwdNeverExpire` tinyint(1) NOT NULL,
  `oldPWD` varchar(51) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_users`
--

INSERT INTO `hrms_users` (`userId`, `userFName`, `userMName`, `userLName`, `userPWD`, `userRoleId`, `userMenuId`, `userEmailId`, `pwdChangeDate`, `IsLocked`, `lockDate`, `unLockDate`, `userActive`, `pwdChangeOnLogon`, `PasswordChangeAllowed`, `pwdNeverExpire`, `oldPWD`) VALUES
(1, 'Subodh', '', 'Kumar', 'e10adc3949ba59abbe56e057f20f883e', '1', '', 'subodh.kumar@sequelone.com', '2016-04-08 10:15:00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '', 1, ''),
(2, 'Hariom', 'kumar', 'shukla', 'e10adc3949ba59abbe56e057f20f883e', '', '', 'hariom@sequel.com', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, ''),
(3, 'Vijay', 'kumar', 'kumar', '123456', '', '', 'vijay@sequelone.com', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, ''),
(4, 'Rajat ', 'kumar', 'sharma', 'd41d8cd98f00b204e9800998ecf8427e', '', '', 'rajat@gmail.com', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, ''),
(5, 'M', 'D', 'sharma', 'd41d8cd98f00b204e9800998ecf8427e', '', '', 'mdsharma@gmail.com', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, ''),
(6, 'M', 'D', 'sharma', 'd41d8cd98f00b204e9800998ecf8427e', '', '', 'mdsharma@gmail.com', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, ''),
(7, 'alok', 'kuamr', 'thakur', 'e10adc3949ba59abbe56e057f20f883e', '', '', 'alok@abc.com', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, ''),
(8, '444', 'jjj', 'jjj', 'd41d8cd98f00b204e9800998ecf8427e', '', '', 'jjjj@gmail.com', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, ''),
(9, 'Hari', 'om', 'shukla', 'd41d8cd98f00b204e9800998ecf8427e', '', '', 'myemail@email.com', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, ''),
(10, 'shivam', 'shukla', 'shukla', 'd41d8cd98f00b204e9800998ecf8427e', '', '', 'shivam@google.com', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, ''),
(11, 'om', 'shukla', 'shukla', '123456', '', '', 'omshukla@gmail.com', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, ''),
(12, 'omi', 'omi', 'omi', '123456', '', '', 'omshukla@gmail.com', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, ''),
(13, 'ttt', 'shukla', 'singh', '123456', '', '', 'omshukla@gmail.com', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, ''),
(14, 'omi', 'shukla', 'hhh', 'e10adc3949ba59abbe56e057f20f883e', '', '', 'hari@gmail.com', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, ''),
(15, 'omi', 'shukla', 'hhh', 'e10adc3949ba59abbe56e057f20f883e', '', '', 'hari@gmail.com', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, ''),
(16, 'abc', 'omi', 'singh', 'e10adc3949ba59abbe56e057f20f883e', '', '', 'vishal.thakur@gmail.com', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, ''),
(17, 'omi', 'shukla', 'hhh', 'e10adc3949ba59abbe56e057f20f883e', '', '', 'vijay@sequel.com', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, ''),
(18, 'Hari', 'om', 'shukla', '123456', 'testing', '5 3 2 ', 'hariom@sequel.com', '2016-04-06 00:00:00', 0, '2016-04-08 00:00:00', '2016-04-14 00:00:00', '0000-00-00 00:00:00', 0, '', 1, ''),
(19, 'h', 'h', 'f', 'gggg', 'ggg', 'ggg', 'jjjj@gmail.com', '2016-04-01 00:00:00', 0, '2016-04-02 00:00:00', '2016-04-05 00:00:00', '0000-00-00 00:00:00', 0, '', 0, ''),
(20, 'Mohan', 'D.', 'sharma', '123456', '5 6 5 ', '5 3 2 ', 'mdsharma@gmail.com', '2016-04-06 00:00:00', 0, '2016-04-15 00:00:00', '2016-04-21 00:00:00', '0000-00-00 00:00:00', 0, '', 0, ''),
(1111, 'hari', 'om', 'shukla', 'Hariom@123', '31', '3122', 'hari@yahoo.com', '2016-04-07 00:00:00', 1, '2016-04-01 00:00:00', '2016-04-16 00:00:00', '0000-00-00 00:00:00', 1, '', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `leavedetail`
--

CREATE TABLE `leavedetail` (
  `Emp_Code` varchar(20) DEFAULT NULL,
  `Trn_Code` varchar(20) DEFAULT NULL,
  `Trn_Date` datetime(6) DEFAULT NULL,
  `LvFrom` datetime(6) DEFAULT NULL,
  `LvTo` datetime(6) DEFAULT NULL,
  `LvType` varchar(20) DEFAULT NULL,
  `LvDays` int(5) DEFAULT NULL,
  `In_Time` datetime(6) DEFAULT NULL,
  `Out_Time` datetime(6) DEFAULT NULL,
  `Shift_Code` varchar(20) DEFAULT NULL,
  `CreatedBy` varchar(20) DEFAULT NULL,
  `CreatedOn` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `leave_details`
--

CREATE TABLE `leave_details` (
  `id` int(11) NOT NULL,
  `empCode` varchar(21) NOT NULL,
  `leaveType` varchar(35) NOT NULL,
  `balance` int(11) NOT NULL,
  `redeem` int(11) NOT NULL,
  `totalBalance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `levelmast`
--

CREATE TABLE `levelmast` (
  `levelCode` varchar(20) NOT NULL,
  `levelName` varchar(100) DEFAULT NULL,
  `tableType` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `levelmast`
--

INSERT INTO `levelmast` (`levelCode`, `levelName`, `tableType`) VALUES
('01', 'Level 01', 'M');

-- --------------------------------------------------------

--
-- Table structure for table `locmast`
--

CREATE TABLE `locmast` (
  `id` int(11) NOT NULL,
  `locCode` varchar(21) DEFAULT NULL,
  `locName` varchar(21) DEFAULT NULL,
  `locType` varchar(21) DEFAULT NULL,
  `locParent` varchar(21) DEFAULT NULL,
  `locWork` varchar(21) DEFAULT NULL,
  `locAdd1` varchar(21) DEFAULT NULL,
  `locAdd2` varchar(21) DEFAULT NULL,
  `locCity` varchar(21) DEFAULT NULL,
  `locState` varchar(21) DEFAULT NULL,
  `locPin` varchar(21) DEFAULT NULL,
  `locCountry` varchar(21) DEFAULT NULL,
  `locPfCode` varchar(21) DEFAULT NULL,
  `locEsiCode` varchar(21) DEFAULT NULL,
  `tableType` varchar(21) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locmast`
--

INSERT INTO `locmast` (`id`, `locCode`, `locName`, `locType`, `locParent`, `locWork`, `locAdd1`, `locAdd2`, `locCity`, `locState`, `locPin`, `locCountry`, `locPfCode`, `locEsiCode`, `tableType`) VALUES
(1, '12345', 'Test', 'testing', 'test', 'test', 'asdfghj', 'qwerty', 'new delhi', 'Delhi', '110011', 'INDIA', '', '', 'M'),
(2, 'Test2', 'test2', 'test2', 'test2', 'test2', 'test2', 'test2 test2', 'gurgaon', 'Haryana', 'testing', 'india', '12345', '123456', 'T'),
(3, '12345', 'Test', 'testing', 'test2', 'test2', 'aaassswwww', 'aaa', 'sss', 'Delhi', '', '', '', '', 'M'),
(4, '12345', 'Test', 'testing', 'test2', 'test2', 'aaassswwww', 'aaa', 'sss', 'Delhi', '', '', '', '', 'M');

-- --------------------------------------------------------

--
-- Table structure for table `loctypemast`
--

CREATE TABLE `loctypemast` (
  `LocType_CODE` varchar(20) NOT NULL,
  `LocType_NAME` varchar(100) DEFAULT NULL,
  `Table_Type` varchar(20) DEFAULT NULL,
  `Status` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `newjobopening`
--

CREATE TABLE `newjobopening` (
  `jobId` varchar(20) NOT NULL,
  `jobTitle` varchar(50) DEFAULT NULL,
  `jobExperience` varchar(20) DEFAULT NULL,
  `jobDescription` varchar(200) DEFAULT NULL,
  `jobRole` varchar(100) DEFAULT NULL,
  `jobQualification` varchar(100) DEFAULT NULL,
  `jobKeySkill` varchar(50) DEFAULT NULL,
  `jobLanguageKnown1` varchar(20) DEFAULT NULL,
  `jobLanguageKnown2` varchar(20) DEFAULT NULL,
  `jobLanguageKnown3` varchar(20) DEFAULT NULL,
  `jobSalary` varchar(20) DEFAULT NULL,
  `jobAssetDetails` varchar(50) DEFAULT NULL,
  `jobOtherDetails` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `newjobopening`
--

INSERT INTO `newjobopening` (`jobId`, `jobTitle`, `jobExperience`, `jobDescription`, `jobRole`, `jobQualification`, `jobKeySkill`, `jobLanguageKnown1`, `jobLanguageKnown2`, `jobLanguageKnown3`, `jobSalary`, `jobAssetDetails`, `jobOtherDetails`) VALUES
('1', 'Developer', '2 years', 'Need A Developer who can manage and work individual on web projects.', 'Software Developer', 'Graduate', 'PHP, HTML, JavaScript, CSS', 'Hindi', 'English', '', '2-4 LPA', 'Laptop & Data card', ''),
('2', 'Designer', '2-4 years', 'Should have great experience with working knowledge of photoshop, corel draw and can work with team.', 'Designer', 'Any Graduate', 'Photoshop, Corel Draw, Html, Image Editing ', 'English', 'Hindi', '', '3000000-600000', 'Laptop & Data card', 'Flexible shift are for this profile.');

-- --------------------------------------------------------

--
-- Table structure for table `paytran`
--

CREATE TABLE `paytran` (
  `empCode` varchar(20) NOT NULL,
  `trnDate` datetime(6) DEFAULT NULL,
  `trnWef` datetime(6) DEFAULT NULL,
  `fieldName` varchar(10) DEFAULT NULL,
  `fieldRate` varchar(18) DEFAULT NULL,
  `fieldEdit` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paytran`
--

INSERT INTO `paytran` (`empCode`, `trnDate`, `trnWef`, `fieldName`, `fieldRate`, `fieldEdit`) VALUES
('emp01', '2016-04-19 00:00:00.000000', '2016-04-20 00:00:00.000000', 'test', '001', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `procmast`
--

CREATE TABLE `procmast` (
  `procCode` varchar(20) NOT NULL,
  `procName` varchar(100) DEFAULT NULL,
  `tableType` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `procmast`
--

INSERT INTO `procmast` (`procCode`, `procName`, `tableType`) VALUES
('123', 'abc', 'Master'),
('process01', 'test process', 'M'),
('process011', 'test process', 'T'),
('process0111', 'test process', 'Master');

-- --------------------------------------------------------

--
-- Table structure for table `qualimast`
--

CREATE TABLE `qualimast` (
  `qualCode` varchar(20) NOT NULL,
  `qualName` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qualimast`
--

INSERT INTO `qualimast` (`qualCode`, `qualName`) VALUES
('01', 'Abc');

-- --------------------------------------------------------

--
-- Table structure for table `rolemast`
--

CREATE TABLE `rolemast` (
  `roleCODE` varchar(20) NOT NULL,
  `roleNAME` varchar(100) DEFAULT NULL,
  `roleGrp` varchar(100) DEFAULT NULL,
  `roleMngr` varchar(100) DEFAULT NULL,
  `roleProfile` varchar(100) DEFAULT NULL,
  `roleQuali` varchar(100) DEFAULT NULL,
  `roleSkill` varchar(100) DEFAULT NULL,
  `roleExp` varchar(100) DEFAULT NULL,
  `roleOther` varchar(100) DEFAULT NULL,
  `roleJobDesc` varchar(100) DEFAULT NULL,
  `roleHiringTime` varchar(100) DEFAULT NULL,
  `tableType` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rolemast`
--

INSERT INTO `rolemast` (`roleCODE`, `roleNAME`, `roleGrp`, `roleMngr`, `roleProfile`, `roleQuali`, `roleSkill`, `roleExp`, `roleOther`, `roleJobDesc`, `roleHiringTime`, `tableType`) VALUES
('10', '', 'Test', 'Manager1', 'dev', 'TEST', 'testing', '5', 'nothing', 'abc work', 'abc', ''),
('11', 'Coder', 'dev', 'Manager', 'coding', 'graduate', 'PHP', '2 years', 'Java', 'coding for web proj', '5 march', 'M');

-- --------------------------------------------------------

--
-- Table structure for table `shiftpatternmast`
--

CREATE TABLE `shiftpatternmast` (
  `ShiftPattern_Code` varchar(20) NOT NULL,
  `ShiftPattern_Name` varchar(50) DEFAULT NULL,
  `Compoff` varchar(20) DEFAULT NULL,
  `DefPrd` varchar(20) DEFAULT NULL,
  `RoasterForwardPrd` varchar(20) DEFAULT NULL,
  `IsRepating` varchar(20) DEFAULT NULL,
  `FixWeeklyoff` varchar(20) DEFAULT NULL,
  `Shift_From` datetime(6) DEFAULT NULL,
  `Shift_To` datetime(6) DEFAULT NULL,
  `MndStartTime` datetime(6) DEFAULT NULL,
  `MndEndTime` datetime(6) DEFAULT NULL,
  `ExtPuncStartTime` datetime(6) DEFAULT NULL,
  `ExtPunchEndTime` datetime(6) DEFAULT NULL,
  `WEEKLYOFF` varchar(20) DEFAULT NULL,
  `AttMarkBy` varchar(20) DEFAULT NULL,
  `AttDefault` varchar(20) DEFAULT NULL,
  `OffOnDOB` varchar(20) DEFAULT NULL,
  `CreatedOn` datetime(6) DEFAULT NULL,
  `CreatedBy` varchar(20) DEFAULT NULL,
  `WeeklyOff1` varchar(20) DEFAULT NULL,
  `WeeklyOff2` varchar(20) DEFAULT NULL,
  `WeeklyOff3` varchar(20) DEFAULT NULL,
  `WeeklyOff4` varchar(20) DEFAULT NULL,
  `WeeklyOff5` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `stateId` int(11) NOT NULL,
  `stateName` varchar(50) DEFAULT NULL,
  `countryId` int(11) DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`stateId`, `stateName`, `countryId`, `status`) VALUES
(1, 'Andhra Pradesh', 99, '1'),
(2, 'Assam', 99, '1'),
(3, 'ARUNACHAL PRADESH', 99, '1');

-- --------------------------------------------------------

--
-- Table structure for table `subfunctmast`
--

CREATE TABLE `subfunctmast` (
  `subFunctCode` varchar(20) NOT NULL,
  `subFunctName` varchar(100) DEFAULT NULL,
  `subFunctType` varchar(100) DEFAULT NULL,
  `subFunctHead` varchar(20) DEFAULT NULL,
  `functCode` varchar(20) DEFAULT NULL,
  `tableType` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subfunctmast`
--

INSERT INTO `subfunctmast` (`subFunctCode`, `subFunctName`, `subFunctType`, `subFunctHead`, `functCode`, `tableType`) VALUES
('subFunct01', 'sub funct 11', '', 'home', '', 'M'),
('subFunct02', 'sub funct 12', '', 'home', '', 'Master'),
('test', 'test', 'Function Type 1', 'testhead', 'Function 1', 'trans');

-- --------------------------------------------------------

--
-- Table structure for table `usersroles`
--

CREATE TABLE `usersroles` (
  `roleId` varchar(20) NOT NULL,
  `roleName` varchar(80) DEFAULT NULL,
  `menuCode` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usersroles`
--

INSERT INTO `usersroles` (`roleId`, `roleName`, `menuCode`) VALUES
('Role01', 'Developer', 'A11'),
('Role02', 'Admin', 'A12');

-- --------------------------------------------------------

--
-- Table structure for table `worklocmast`
--

CREATE TABLE `worklocmast` (
  `wLocCode` varchar(50) NOT NULL,
  `wLocName` varchar(50) DEFAULT NULL,
  `wLocType` varchar(50) DEFAULT NULL,
  `wLocParent` varchar(50) DEFAULT NULL,
  `wLocWork` varchar(50) DEFAULT NULL,
  `wLocAdd1` varchar(50) DEFAULT NULL,
  `wLocAdd2` varchar(50) DEFAULT NULL,
  `wLocCity` varchar(50) DEFAULT NULL,
  `wLocState` varchar(50) DEFAULT NULL,
  `wLocPin` varchar(50) DEFAULT NULL,
  `wLocCountry` varchar(50) DEFAULT NULL,
  `tableType` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `worklocmast`
--

INSERT INTO `worklocmast` (`wLocCode`, `wLocName`, `wLocType`, `wLocParent`, `wLocWork`, `wLocAdd1`, `wLocAdd2`, `wLocCity`, `wLocState`, `wLocPin`, `wLocCountry`, `tableType`) VALUES
('', '', '', '', '', '', '', '', '', '', '', 'Master'),
('012', '', 'NCR', 'Haryana', 'Haryana', 'cyber city', 'gurgaon', 'gurgaon', 'Haryana', '220011', 'India', 'Master');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attrequest`
--
ALTER TABLE `attrequest`
  ADD PRIMARY KEY (`Ref_No`);

--
-- Indexes for table `bussmast`
--
ALTER TABLE `bussmast`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `calendar`
--
ALTER TABLE `calendar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `costallocmast`
--
ALTER TABLE `costallocmast`
  ADD PRIMARY KEY (`empCode`);

--
-- Indexes for table `costmast`
--
ALTER TABLE `costmast`
  ADD PRIMARY KEY (`costCode`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`countryId`);

--
-- Indexes for table `deptnotification`
--
ALTER TABLE `deptnotification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emphrdmast`
--
ALTER TABLE `emphrdmast`
  ADD PRIMARY KEY (`empCode`);

--
-- Indexes for table `emphrdtran`
--
ALTER TABLE `emphrdtran`
  ADD PRIMARY KEY (`empCode`);

--
-- Indexes for table `emptypemast`
--
ALTER TABLE `emptypemast`
  ADD PRIMARY KEY (`empTypeCode`);

--
-- Indexes for table `functmast`
--
ALTER TABLE `functmast`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grdmast`
--
ALTER TABLE `grdmast`
  ADD PRIMARY KEY (`grdCode`);

--
-- Indexes for table `holidaymast`
--
ALTER TABLE `holidaymast`
  ADD PRIMARY KEY (`hDate`);

--
-- Indexes for table `hrms_company_details`
--
ALTER TABLE `hrms_company_details`
  ADD PRIMARY KEY (`COMPCODE`);

--
-- Indexes for table `hrms_menu`
--
ALTER TABLE `hrms_menu`
  ADD PRIMARY KEY (`mId`);

--
-- Indexes for table `hrms_role_type`
--
ALTER TABLE `hrms_role_type`
  ADD PRIMARY KEY (`roleId`);

--
-- Indexes for table `hrms_users`
--
ALTER TABLE `hrms_users`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `levelmast`
--
ALTER TABLE `levelmast`
  ADD PRIMARY KEY (`levelCode`);

--
-- Indexes for table `locmast`
--
ALTER TABLE `locmast`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loctypemast`
--
ALTER TABLE `loctypemast`
  ADD PRIMARY KEY (`LocType_CODE`);

--
-- Indexes for table `newjobopening`
--
ALTER TABLE `newjobopening`
  ADD PRIMARY KEY (`jobId`);

--
-- Indexes for table `paytran`
--
ALTER TABLE `paytran`
  ADD PRIMARY KEY (`empCode`);

--
-- Indexes for table `procmast`
--
ALTER TABLE `procmast`
  ADD PRIMARY KEY (`procCode`);

--
-- Indexes for table `qualimast`
--
ALTER TABLE `qualimast`
  ADD PRIMARY KEY (`qualCode`);

--
-- Indexes for table `rolemast`
--
ALTER TABLE `rolemast`
  ADD PRIMARY KEY (`roleCODE`);

--
-- Indexes for table `shiftpatternmast`
--
ALTER TABLE `shiftpatternmast`
  ADD PRIMARY KEY (`ShiftPattern_Code`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`stateId`);

--
-- Indexes for table `subfunctmast`
--
ALTER TABLE `subfunctmast`
  ADD PRIMARY KEY (`subFunctCode`);

--
-- Indexes for table `usersroles`
--
ALTER TABLE `usersroles`
  ADD PRIMARY KEY (`roleId`);

--
-- Indexes for table `worklocmast`
--
ALTER TABLE `worklocmast`
  ADD PRIMARY KEY (`wLocCode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bussmast`
--
ALTER TABLE `bussmast`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `calendar`
--
ALTER TABLE `calendar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `countryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;
--
-- AUTO_INCREMENT for table `deptnotification`
--
ALTER TABLE `deptnotification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `functmast`
--
ALTER TABLE `functmast`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `hrms_menu`
--
ALTER TABLE `hrms_menu`
  MODIFY `mId` int(8) NOT NULL AUTO_INCREMENT COMMENT 'menuId is auto incremented value for uniquely identified.', AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `hrms_role_type`
--
ALTER TABLE `hrms_role_type`
  MODIFY `roleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `locmast`
--
ALTER TABLE `locmast`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `stateId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
