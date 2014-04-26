-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 24, 2014 at 06:32 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sms`
--
CREATE DATABASE IF NOT EXISTS `sms` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `sms`;

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE IF NOT EXISTS `address` (
  `accountID` int(10) NOT NULL,
  `role` int(1) NOT NULL,
  `street` varchar(75) NOT NULL,
  `city` varchar(20) NOT NULL,
  `state` varchar(2) NOT NULL,
  `zip` int(5) NOT NULL,
  KEY `role` (`role`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`accountID`, `role`, `street`, `city`, `state`, `zip`) VALUES
(1, 1, '100 Main Street', 'Atlanta', 'GA', 30000),
(2, 4, '100 Main Street', 'Atlanta', 'GA', 30000),
(4, 3, '101 Main Street', 'Atlantis', 'AL', 30001),
(7, 1, 'aaa', 'aaa', 'AL', 30000),
(9, 1, '100 Main Street', 'Atlanta', 'GA', 30000),
(10, 1, '100 Main ST', 'Atlanta', 'GA', 30090),
(2, 2, '101 Main Street', 'Atlantis', 'AL', 30001),
(18, 1, '100 Main Street', 'Atlanta', 'GA', 30000),
(19, 1, '100 Main Drive', 'Atlanta', 'GA', 30000),
(5, 3, '653 Rupin Drive', 'POWDEr', 'GA', 23465),
(3, 2, '345 Ty Bi', 'Herfi', 'IL', 23464),
(3, 4, '100 main st', 'mariettta', 'OH', 30008),
(6, 3, '100 Main Street', 'Atlantano', 'AL', 30000),
(7, 3, '100 Main Street', 'Norcross', 'GA', 30000),
(4, 4, '123 Cherry Street', 'Hanover', 'GA', 11111),
(8, 3, '100 Main Street', 'Atlanta', 'AL', 34000),
(4, 2, '100 Main Drive', 'Atlanta', 'GA', 30000),
(20, 1, '100 Main Pl', 'Atlanta', 'GA', 30000),
(9, 3, '100 Main Ct', 'Atlanta', 'GA', 30000),
(21, 1, '123 main st', 'lalaland', 'GA', 30047),
(22, 1, '123 main st', 'snellville', 'GA', 30039),
(5, 2, '123 main st', 'abc', 'ME', 7000),
(10, 3, '123 main st', 'abc', 'ME', 7000),
(5, 4, '123 main st', 'abc', 'ME', 7000),
(23, 1, '123 main st', 'abc', 'ME', 7000),
(11, 3, '123 main st', 'abc', 'ME', 7000),
(12, 3, '123 Smithsonian Street', 'Chicago', 'CA', 78875),
(13, 3, '123 main st', 'abc', 'ME', 7000),
(14, 3, '123 main st', 'abc', 'ME', 7000),
(15, 3, '123 main st', 'abc', 'ME', 7000),
(16, 3, '123 main st', 'abc', 'ME', 7000),
(6, 2, '3671 Haiw Dr', 'Kennesaw', 'GA', 30152),
(7, 2, '123 main st', 'abc', 'ME', 7000),
(24, 1, 'the he', 'Gak', 'AL', 40502),
(17, 3, '100 Main Street', 'Sandy Springs', 'GA', 30090),
(6, 4, 'ryth', 'thend', 'AK', 39294),
(25, 1, '123 main st', 'abc', 'ME', 7000),
(18, 3, '2384 Candy Apple Way', 'Kennesaw', 'GA', 30251),
(19, 3, 'the he', 'ghd', 'AL', 30294),
(20, 3, 'rth e', 'ehh', 'AK', 50394),
(8, 2, 'rth e', 'dgh', 'AL', 46969),
(26, 1, '100 Main ST', 'Atlanta', 'GA', 30000),
(7, 4, '100 Main Street', 'Atlanta', 'GA', 30000),
(21, 3, '234 robfb', 'fdbdfk', 'AK', 23430),
(22, 3, '2391 Downward Spiral', 'Some', 'GA', 30152),
(8, 4, '123 abc main st', 'abc', 'ME', 7000);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `accountID` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` char(128) NOT NULL DEFAULT 'password',
  `role` int(1) NOT NULL DEFAULT '1',
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `DOB` date NOT NULL DEFAULT '1970-01-01',
  `contactNum` bigint(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `salt` char(128) NOT NULL,
  PRIMARY KEY (`accountID`),
  UNIQUE KEY `accountID` (`accountID`),
  UNIQUE KEY `username` (`username`),
  KEY `role` (`role`),
  KEY `role_2` (`role`),
  KEY `accountID_2` (`accountID`),
  KEY `accountID_3` (`accountID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`accountID`, `username`, `password`, `role`, `firstName`, `lastName`, `email`, `DOB`, `contactNum`, `status`, `salt`) VALUES
(1, 'admin', 'dce15624c79336c6d6bca9e892b9285ccae6934b82dc27939d1c7b8eebb28a09', 1, 'Admin', 'Ruler', 'kng@spsu.edu', '1970-01-01', 7777777777, 1, 'db0'),
(7, 'admintest', 'ad370a6a9327ae587a36330f419c349a1b900633766e9b20b2d6ba0448bf8c53', 1, 'aaa', 'aaa', 'einstein@mail.com', '1930-11-30', 7777777777, 1, '21f'),
(9, 'bsmith', '3dafd85f00a107ba67d93262ef2cd90d21b60067c1de259f160546499413d516', 1, 'Bob', 'Smith', 'bsmith@mail.com', '1935-11-30', 1112224444, 0, 'c7c'),
(10, 'jsmith', 'bd514b50af3797e8307f3df81c9380f26f25e9ae3c2a05e15cc96c1f14e6961c', 1, 'John', 'Smith', 'kng@spsu.edu', '1970-01-01', 1112224444, 1, '421'),
(18, 'jsmith2', 'cb2564de22a1491c61724f1038cafa12cee53e24ec6f1b25f6a04448e37a997f', 1, 'John', 'Smith', 'jsmith2@mail.com', '1970-01-01', 1112224343, 1, '5c8'),
(19, 'jcon', 'ffa24e11f3cd75c59bf32e720960e0628be0f184aaaf628365aa27539d3a9dae', 1, 'John', 'O''Connor', 'jconn@mail.com', '1970-12-01', 1112224444, 1, 'e08'),
(20, 'tbirth2', '9a75f1e612ddf1162aa286a6287fc53e8f9d744f8a3574b817b6c48b0a87d93e', 1, 'Test', 'Birth', 'test3@mail.com', '2014-03-22', 1112224444, 1, 'c2d'),
(21, 'Jfox', '315633ac5c051aed0639c539ea0545323dff0603c72b40f5232a544c63861f79', 1, 'Jamie', 'Foxx', 'jfox@spsu.edu', '2014-03-24', 7770009999, 1, '5ce'),
(22, 'johnsmith', 'c469e2997cdb16fee36eef3d7be0f1cf011544ffc3e3729e1262614d5974bc1f', 1, 'John', 'Smith', 'jsmith@abc.net', '1995-01-09', 8889991026, 1, '792'),
(23, 'RegoneAdmin', '587d643b19a9d6820315ac79490ab363715853ba668e492f14c26cba391bb667', 1, 'RegoneAdmin', 'Admin', 'regoneadmin@abc.net', '1995-01-10', 1234567890, 1, '4a4'),
(24, 'admin2', 'f46abc4ff885c031f9b2b514817499f2d4d79c0a36ea28a7f63d22bbe5c54fc2', 1, 'groegy', 'bi', 'andrev91@comcast.net', '2014-04-01', 4545202346, 1, '335'),
(25, 'RegtwoAdmin', '4492013b4cd8438cb367556d52d7941d047efbc55db9c043012c046cd00098c7', 1, 'RegressionTwo', 'Admin', 'regtwoadmin@abc.net', '2014-01-01', 1234567890, 1, 'b16'),
(26, 'testadmin', '1b00eabb2cf269ce90d31dd524acd1b8350ed40cfc4d96f6b635cee8c66dec31', 1, 'ad', 'min', 'admin@mail.com', '2014-04-01', 1112224444, 1, 'a9e');

-- --------------------------------------------------------

--
-- Table structure for table `classroom`
--

CREATE TABLE IF NOT EXISTS `classroom` (
  `classID` int(10) NOT NULL AUTO_INCREMENT,
  `course_number` varchar(9) NOT NULL,
  `course_name` varchar(25) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `semester` varchar(6) NOT NULL,
  `year` varchar(9) NOT NULL,
  `teacherID` int(10) NOT NULL,
  `forumName` varchar(16) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`classID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `classroom`
--

INSERT INTO `classroom` (`classID`, `course_number`, `course_name`, `start_date`, `end_date`, `start_time`, `end_time`, `semester`, `year`, `teacherID`, `forumName`, `status`) VALUES
(3, '1111-11', 'A class', '2014-03-16', '2014-03-17', '00:00:00', '23:55:00', 'Spring', '2014-2015', 3, '3_forum', 0),
(4, '1111-12', 'A class', '2014-04-09', '2015-03-13', '19:00:00', '20:15:00', 'Spring', '-2015', 3, '4_forum', 0),
(5, '1001-1451', 'Test after forum changes', '2014-06-13', '2015-05-27', '06:00:00', '07:30:00', 'Spring', '2014-2015', 2, '5_forum', 0),
(6, '1302', 'Programming II', '2014-08-20', '2014-12-17', '16:00:00', '17:30:00', 'Fall', '2017-2018', 2, '6_forum', 1),
(7, '3468', 'T-bone', '2014-03-27', '2014-03-29', '08:50:00', '13:50:00', 'Spring', '2020-2021', 3, '7_forum', 0),
(8, '1111-121', 'A classes II', '2014-07-04', '2015-05-21', '08:15:00', '15:45:00', 'Spring', '2014-2015', 2, '8_forum', 1),
(9, '1111-12', 'A class III', '2014-08-04', '2015-05-20', '07:15:00', '14:45:00', 'Fall', '-2015', 3, '9_forum', 0),
(10, '1235', 'Jquery-java', '2014-04-08', '2015-01-08', '09:05:00', '08:05:00', 'Spring', '2014-2015', 2, '10_forum', 1),
(11, '12345', 'Puma', '2014-04-08', '2015-01-15', '02:25:00', '08:25:00', 'Spring', '2014-2015', 5, '11_forum', 1),
(12, '1111', 'HIST', '2014-04-14', '2015-01-14', '13:55:00', '15:35:00', 'Spring', '2014-2015', 6, '12_forum', 1),
(13, '1112', 'BTESTONE', '2014-04-09', '2015-01-21', '15:10:00', '09:10:00', 'Spring', '2014-2015', 6, '13_forum', 1),
(14, '1113', 'BTESTTWO', '2014-04-14', '2015-01-07', '07:10:00', '14:10:00', 'Spring', '2014-2015', 6, '14_forum', 1),
(15, '1114', 'BTESTTHREE', '2014-04-20', '2015-01-23', '12:10:00', '16:35:00', 'Spring', '2014-2015', 6, '15_forum', 1),
(16, '1115', 'BTESTFOUR', '2014-04-20', '2015-01-14', '19:10:00', '08:10:00', 'Spring', '2014-2015', 6, '16_forum', 1),
(17, '1100', 'Geology', '2014-04-09', '2015-01-09', '00:50:00', '01:50:00', 'Spring', '2014-2015', 5, '17_forum', 1),
(18, '1200-001', 'Economy', '2014-04-09', '2015-04-09', '00:55:00', '00:55:00', 'Spring', '2014-2015', 7, '18_forum', 1),
(19, '23-32', 'Bungee Jump', '2014-05-01', '2015-01-21', '01:00:00', '23:00:00', 'Spring', '2014-2015', 3, '19_forum', 1),
(20, '3480', 'SWE Testing', '2014-04-29', '2015-01-13', '07:20:00', '08:20:00', 'Spring', '2014-2015', 3, '20_forum', 1),
(21, '32458', 'SWE Testing testig', '2014-04-24', '2015-01-07', '19:25:00', '19:30:00', 'Spring', '2014-2015', 3, '21_forum', 1),
(22, '1112', 'HIST', '2014-04-21', '2015-01-01', '08:10:00', '16:35:00', 'Spring', '2014-2015', 6, '22_forum', 1);

-- --------------------------------------------------------

--
-- Table structure for table `class_messageboard`
--

CREATE TABLE IF NOT EXISTS `class_messageboard` (
  `class_messageID` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `messageContent` text,
  `accountID` int(10) NOT NULL,
  `authorFirstName` varchar(25) NOT NULL DEFAULT 'Test',
  `authorLastName` varchar(30) NOT NULL DEFAULT 'Admin',
  `messageDate` datetime DEFAULT NULL,
  `classID` int(10) NOT NULL,
  PRIMARY KEY (`class_messageID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `class_messageboard`
--

INSERT INTO `class_messageboard` (`class_messageID`, `messageContent`, `accountID`, `authorFirstName`, `authorLastName`, `messageDate`, `classID`) VALUES
(1, 'Hello World!!~`` &#039;&quot; . ', 1, 'Admin', 'Ruler', '2014-04-01 00:34:53', 5),
(4, 'Hello Class!!!', 2, 'Jack', 'Frosty', '2014-04-01 13:54:56', 5),
(7, 'heshe', 1, 'Admin', 'Ruler', '2014-04-02 18:11:12', 5),
(8, 'Some other class.', 1, 'Admin', 'Ruler', '2014-04-02 18:11:16', 3),
(9, 'Hello Student of Class 1001-1451.... We have a test tomorrow\n', 23, 'RegoneAdmin', 'Admin', '2014-04-05 01:35:12', 5),
(12, 'Hello class. Welcome to the new year~! ', 2, 'Jack', 'Frosty', '2014-04-06 14:43:37', 8),
(14, 'Testing of edit. Test successful.', 6, 'Test', 'Teacher', '2014-04-09 16:27:15', 12),
(15, 'hell kids', 3, 'teacher', 'teacher', '2014-04-09 18:14:50', 3),
(20, 'testing1242354 drgj', 3, 'teacher', 'teacher', '2014-04-09 18:45:39', 19),
(24, 'fgfb', 1, 'Admin', 'Ruler', '2014-04-13 09:38:27', 19),
(28, 'test', 1, 'Admin', 'Ruler', '2014-04-15 23:52:39', 5),
(29, 'tesssst 3 edit', 6, 'Test', 'Teacher', '2014-04-16 18:02:17', 13),
(31, 'adsvk', 24, 'groegy', 'bi', '2014-04-18 19:07:01', 5),
(32, 'Hello', 23, 'RegoneAdmin', 'Admin', '2014-04-19 04:33:04', 17);

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE IF NOT EXISTS `email` (
  `emailID` int(11) NOT NULL AUTO_INCREMENT,
  `owner` varchar(25) NOT NULL,
  `dest_username` varchar(25) NOT NULL,
  `dest_first` varchar(20) NOT NULL,
  `dest_last` varchar(25) NOT NULL,
  `from_username` varchar(25) NOT NULL,
  `from_first` varchar(20) NOT NULL,
  `from_last` varchar(25) NOT NULL,
  `date_sent` datetime NOT NULL,
  `subject` text NOT NULL,
  `msg_content` longtext NOT NULL,
  `box` int(1) NOT NULL,
  PRIMARY KEY (`emailID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=409 ;

--
-- Dumping data for table `email`
--

INSERT INTO `email` (`emailID`, `owner`, `dest_username`, `dest_first`, `dest_last`, `from_username`, `from_first`, `from_last`, `date_sent`, `subject`, `msg_content`, `box`) VALUES
(323, 'admin', 'admintest', 'aaa', 'aaa', 'admin', 'Admin', 'Ruler', '2014-04-13 17:40:37', 'testing email changes', 'asdsad', 2),
(325, 'admin', 'admin', 'Admin', 'Ruler', 'RegthreeStudent', 'Regressionthree', 'Student', '2014-04-13 22:08:38', 'testing regonestudent e-mail', 'This is a test', 1),
(326, 'RegthreeStudent', 'admin', 'Admin', 'Ruler', 'RegthreeStudent', 'Regressionthree', 'Student', '2014-04-13 22:08:38', 'testing regonestudent e-mail', 'This is a test', 2),
(327, 'RegtwoStudent', 'RegtwoStudent', 'RegtwoStudent', 'Student', 'RegthreeStudent', 'Regressionthree', 'Student', '2014-04-13 22:08:38', 'testing regonestudent e-mail', 'This is a test', 1),
(328, 'RegthreeStudent', 'RegtwoStudent', 'RegtwoStudent', 'Student', 'RegthreeStudent', 'Regressionthree', 'Student', '2014-04-13 22:08:38', 'testing regonestudent e-mail', 'This is a test', 2),
(329, 'RegthreeStudent', 'RegthreeStudent', 'Regressionthree', 'Student', 'RegthreeStudent', 'System', 'Msg', '2014-04-13 22:09:00', 'Cannot Send', 'syedrkamil@gmail.com, username does not exist or is inactive. Message not sent to this user. \n----------------------------------------------------------\nTesting 1', 1),
(330, 'RegoneStudent', 'RegoneStudent', 'RegoneStudent', 'Test', 'RegthreeStudent', 'Regressionthree', 'Student', '2014-04-13 22:09:25', 'Testing to send e-mail to the user', 'testing ', 1),
(331, 'RegthreeStudent', 'RegoneStudent', 'RegoneStudent', 'Test', 'RegthreeStudent', 'Regressionthree', 'Student', '2014-04-13 22:09:25', 'Testing to send e-mail to the user', 'testing ', 2),
(332, 'RegthreeStudent', '', '', '', 'RegthreeStudent', 'Regressionthree', 'Student', '2014-04-13 22:09:40', '', '', 4),
(333, 'RegoneStudent', 'RegoneStudent', 'RegoneStudent', 'Test', 'RegtwoStudent', 'RegtwoStudent', 'Student', '2014-04-13 22:10:07', 'test3', 'test3', 1),
(334, 'RegtwoStudent', 'RegoneStudent', 'RegoneStudent', 'Test', 'RegtwoStudent', 'RegtwoStudent', 'Student', '2014-04-13 22:10:07', 'test3', 'test3', 2),
(335, 'RegoneStudent', 'RegoneStudent', 'RegoneStudent', 'Test', 'RegtwoStudent', 'RegtwoStudent', 'Student', '2014-04-13 22:10:21', 'test4', 'Test4', 1),
(336, 'RegtwoStudent', 'RegoneStudent', 'RegoneStudent', 'Test', 'RegtwoStudent', 'RegtwoStudent', 'Student', '2014-04-13 22:10:21', 'test4', 'Test4', 2),
(337, 'RegoneStudent', 'RegoneStudent', 'RegoneStudent', 'Test', 'RegtwoStudent', 'RegtwoStudent', 'Student', '2014-04-13 22:11:04', 'testing combine more than 2 emails', 'Testing more than two recipient', 1),
(338, 'RegtwoStudent', 'RegoneStudent', 'RegoneStudent', 'Test', 'RegtwoStudent', 'RegtwoStudent', 'Student', '2014-04-13 22:11:04', 'testing combine more than 2 emails', 'Testing more than two recipient', 2),
(339, 'RegtwoStudent', 'RegtwoStudent', 'RegtwoStudent', 'Student', 'RegtwoStudent', 'RegtwoStudent', 'Student', '2014-04-13 22:11:04', 'testing combine more than 2 emails', 'Testing more than two recipient', 1),
(340, 'RegtwoStudent', 'RegtwoStudent', 'RegtwoStudent', 'Student', 'RegtwoStudent', 'RegtwoStudent', 'Student', '2014-04-13 22:11:04', 'testing combine more than 2 emails', 'Testing more than two recipient', 2),
(341, 'RegthreeStudent', 'RegthreeStudent', 'Regressionthree', 'Student', 'RegtwoStudent', 'RegtwoStudent', 'Student', '2014-04-13 22:11:04', 'testing combine more than 2 emails', 'Testing more than two recipient', 1),
(342, 'RegtwoStudent', 'RegthreeStudent', 'Regressionthree', 'Student', 'RegtwoStudent', 'RegtwoStudent', 'Student', '2014-04-13 22:11:04', 'testing combine more than 2 emails', 'Testing more than two recipient', 2),
(343, 'RegoneStudent', 'RegoneStudent', 'RegoneStudent', 'Test', 'admin', 'Admin', 'Ruler', '2014-04-13 22:12:10', 'Testing from Admin email', 'Testing from admin&#039;s email', 1),
(344, 'admin', 'RegoneStudent', 'RegoneStudent', 'Test', 'admin', 'Admin', 'Ruler', '2014-04-13 22:12:10', 'Testing from Admin email', 'Testing from admin&#039;s email', 2),
(345, 'RegtwoStudent', 'RegtwoStudent', 'RegtwoStudent', 'Student', 'admin', 'Admin', 'Ruler', '2014-04-13 22:12:10', 'Testing from Admin email', 'Testing from admin&#039;s email', 1),
(346, 'admin', 'RegtwoStudent', 'RegtwoStudent', 'Student', 'admin', 'Admin', 'Ruler', '2014-04-13 22:12:10', 'Testing from Admin email', 'Testing from admin&#039;s email', 2),
(347, 'RegthreeStudent', 'RegthreeStudent', 'Regressionthree', 'Student', 'admin', 'Admin', 'Ruler', '2014-04-13 22:12:10', 'Testing from Admin email', 'Testing from admin&#039;s email', 1),
(348, 'admin', 'RegthreeStudent', 'Regressionthree', 'Student', 'admin', 'Admin', 'Ruler', '2014-04-13 22:12:10', 'Testing from Admin email', 'Testing from admin&#039;s email', 2),
(349, 'admin', 'admin', 'Admin', 'Ruler', 'RegoneStudent', 'RegoneStudent', 'Test', '2014-04-13 22:13:22', 'testing', 'tadfadslf;kdsajfldsfdsa', 1),
(350, 'RegoneStudent', 'admin', 'Admin', 'Ruler', 'RegoneStudent', 'RegoneStudent', 'Test', '2014-04-13 22:13:22', 'testing', 'tadfadslf;kdsajfldsfdsa', 2),
(351, 'RegoneStudent', 'RegoneStudent', 'RegoneStudent', 'Test', 'RegoneStudent', 'RegoneStudent', 'Test', '2014-04-13 22:13:22', 'testing', 'tadfadslf;kdsajfldsfdsa', 1),
(353, 'RegoneParent', 'RegoneParent', 'RegoneParent', 'test', 'RegoneStudent', 'RegoneStudent', 'Test', '2014-04-13 22:13:52', 'testing drafts', 'testing saving in the drafts', 1),
(354, 'RegoneStudent', 'RegoneParent', 'RegoneParent', 'test', 'RegoneStudent', 'RegoneStudent', 'Test', '2014-04-13 22:13:52', 'testing drafts', 'testing saving in the drafts', 2),
(355, 'RegoneStudent', 'RegtwoStudent,', '', '', 'RegoneStudent', 'RegoneStudent', 'Test', '2014-04-13 22:14:10', 'saving in the draft', 'saving in the draft', 4),
(356, 'RegoneStudent', 'RegoneStudent', 'RegoneStudent', 'Test', 'RegoneStudent', 'RegoneStudent', 'Test', '2014-04-13 22:15:04', 'RE: testing', 'Replying to e-mails\r\n --------------------------------------------------------\r\nFrom: RegoneStudent&lt;RegoneStudent Test&gt;\r\nSubject: testing\r\ntadfadslf;kdsajfldsfdsa', 1),
(357, 'RegoneStudent', 'RegoneStudent', 'RegoneStudent', 'Test', 'RegoneStudent', 'RegoneStudent', 'Test', '2014-04-13 22:15:04', 'RE: testing', 'Replying to e-mails\r\n --------------------------------------------------------\r\nFrom: RegoneStudent&lt;RegoneStudent Test&gt;\r\nSubject: testing\r\ntadfadslf;kdsajfldsfdsa', 2),
(358, 'RegtwoStudent', 'RegtwoStudent', 'RegtwoStudent', 'Student', 'RegoneStudent', 'RegoneStudent', 'Test', '2014-04-13 22:15:23', 'FWD: testing', 'Forwarding\r\n --------------------------------------------------------\r\nFrom: RegoneStudent&lt;RegoneStudent Test&gt;\r\nSubject: testing\r\ntadfadslf;kdsajfldsfdsa', 1),
(359, 'RegoneStudent', 'RegtwoStudent', 'RegtwoStudent', 'Student', 'RegoneStudent', 'RegoneStudent', 'Test', '2014-04-13 22:15:23', 'FWD: testing', 'Forwarding\r\n --------------------------------------------------------\r\nFrom: RegoneStudent&lt;RegoneStudent Test&gt;\r\nSubject: testing\r\ntadfadslf;kdsajfldsfdsa', 2),
(363, 'jsmith3', 'jsmith3', 'Johney', 'Smithy', 'jsmith3', 'Johney', 'Smithy', '2014-04-13 23:28:05', 'FWD: asd', '\r\n --------------------------------------------------------\r\nFrom: jsmith3&lt;Johney Smithy&gt;\r\nSubject: asd\r\ntest', 2),
(365, 'testteacher', 'admin', 'Admin', 'Ruler', 'testteacher', 'Test', 'Teacher', '2014-04-16 18:32:58', 'b tersxtyy', 'zytuytguyhui', 2),
(366, 'testteacher', 'testteacher', 'Test', 'Teacher', 'admin', 'Admin', 'Ruler', '2014-04-16 18:33:26', 'tgrdtyfyf`', 'ghvjhvbjhb', 1),
(367, 'admin', 'testteacher', 'Test', 'Teacher', 'admin', 'Admin', 'Ruler', '2014-04-16 18:33:26', 'tgrdtyfyf`', 'ghvjhvbjhb', 2),
(368, 'testteacher', 'testteacher', 'Test', 'Teacher', 'admin', 'Admin', 'Ruler', '2014-04-16 18:33:38', 'rsrtdtdr`', 'qdghbjhk', 1),
(369, 'admin', 'testteacher', 'Test', 'Teacher', 'admin', 'Admin', 'Ruler', '2014-04-16 18:33:38', 'rsrtdtdr`', 'qdghbjhk', 2),
(371, 'admin', 'testteacher', 'Test', 'Teacher', 'admin', 'Admin', 'Ruler', '2014-04-16 18:33:48', 'fytfuv', 'gjdrdykltcg', 2),
(372, 'testteacher', 'testteacher', 'Test', 'Teacher', 'admin', 'Admin', 'Ruler', '2014-04-16 18:34:00', 'jhgvjyft', 'fgxcgrs', 1),
(373, 'admin', 'testteacher', 'Test', 'Teacher', 'admin', 'Admin', 'Ruler', '2014-04-16 18:34:00', 'jhgvjyft', 'fgxcgrs', 2),
(374, 'testteacher', 'testteacher', 'Test', 'Teacher', 'admin', 'Admin', 'Ruler', '2014-04-16 18:34:14', 'vhdtfhgf', 'ghcgrfeytdg57', 1),
(375, 'admin', 'testteacher', 'Test', 'Teacher', 'admin', 'Admin', 'Ruler', '2014-04-16 18:34:14', 'vhdtfhgf', 'ghcgrfeytdg57', 2),
(377, 'testteacher', 'admin,', '', '', 'testteacher', 'Test', 'Teacher', '2014-04-16 18:35:31', 'awdawdaw', 'adawawd', 4),
(378, 'admin', 'admin', 'Admin', 'Ruler', 'testteacher', 'Test', 'Teacher', '2014-04-16 18:36:42', 'RE: vhdtfhgf', 'Yeah?\r\n --------------------------------------------------------\r\nFrom: admin&lt;Admin Ruler&gt;\r\nSubject: vhdtfhgf\r\nghcgrfeytdg57', 1),
(379, 'testteacher', 'admin', 'Admin', 'Ruler', 'testteacher', 'Test', 'Teacher', '2014-04-16 18:36:42', 'RE: vhdtfhgf', 'Yeah?\r\n --------------------------------------------------------\r\nFrom: admin&lt;Admin Ruler&gt;\r\nSubject: vhdtfhgf\r\nghcgrfeytdg57', 2),
(380, 'teststudent', 'teststudent', 'test', 'test', 'testteacher', 'Test', 'Teacher', '2014-04-16 18:36:49', 'FWD: jhgvjyft', 'awdawd\r\n --------------------------------------------------------\r\nFrom: admin&lt;Admin Ruler&gt;\r\nSubject: jhgvjyft\r\nfgxcgrs', 1),
(381, 'testteacher', 'teststudent', 'test', 'test', 'testteacher', 'Test', 'Teacher', '2014-04-16 18:36:49', 'FWD: jhgvjyft', 'awdawd\r\n --------------------------------------------------------\r\nFrom: admin&lt;Admin Ruler&gt;\r\nSubject: jhgvjyft\r\nfgxcgrs', 2),
(382, 'admin', 'admin', 'Admin', 'Ruler', 'admin2', 'groegy', 'bi', '2014-04-18 18:53:05', 'hello', 'hey', 1),
(383, 'admin2', 'admin', 'Admin', 'Ruler', 'admin2', 'groegy', 'bi', '2014-04-18 18:53:05', 'hello', 'hey', 1),
(384, 'teacher', 'teacher', 'teacher', 'teacher', 'admin2', 'groegy', 'bi', '2014-04-18 18:53:17', 'FWD: hello', '\r\n --------------------------------------------------------\r\nFrom: admin2&lt;groegy bi&gt;\r\nSubject: hello\r\nhey', 1),
(387, 'admin', 'admin', 'Admin', 'Ruler', 'admin2', 'groegy', 'bi', '2014-04-18 18:54:15', 'be', 'happy', 1),
(390, 'admin', 'admin2', 'groegy', 'bi', 'admin', 'Admin', 'Ruler', '2014-04-18 19:22:26', 'RE: be', 'yo\r\n --------------------------------------------------------\r\nFrom: admin2&lt;groegy bi&gt;\r\nSubject: be\r\nhappy', 2),
(393, 'admin', 'admin2', 'groegy', 'bi', 'admin', 'Admin', 'Ruler', '2014-04-18 19:22:47', 'FWD: hello', ' --------------------------------------------------------\r\nFrom: admin2&lt;groegy bi&gt;\r\nSubject: hello\r\nhey', 2),
(394, 'RegthreeStudent', 'RegthreeStudent', 'Regressionthree', 'Student', 'RegoneStudent', 'RegoneStudent', 'Test', '2014-04-19 04:45:18', 'Testing for the fourth round', 'Testing for the fourth round of testing', 1),
(395, 'RegoneStudent', 'RegthreeStudent', 'Regressionthree', 'Student', 'RegoneStudent', 'RegoneStudent', 'Test', '2014-04-19 04:45:18', 'Testing for the fourth round', 'Testing for the fourth round of testing', 2),
(396, 'RegtwoStudent', 'RegtwoStudent', 'RegtwoStudent', 'Student', 'RegoneStudent', 'RegoneStudent', 'Test', '2014-04-19 04:45:18', 'Testing for the fourth round', 'Testing for the fourth round of testing', 1),
(397, 'RegoneStudent', 'RegtwoStudent', 'RegtwoStudent', 'Student', 'RegoneStudent', 'RegoneStudent', 'Test', '2014-04-19 04:45:18', 'Testing for the fourth round', 'Testing for the fourth round of testing', 2),
(398, 'RegoneStudent', 'RegoneAdmin,RegtwoStudent', '', '', 'RegoneStudent', 'RegoneStudent', 'Test', '2014-04-19 05:00:58', 'Saving in the drafts', '', 4),
(399, 'RegoneStudent', 'regthreestudent', '', '', 'RegoneStudent', 'RegoneStudent', 'Test', '2014-04-19 05:01:24', 'Saving in the draft 2', '', 4),
(400, 'admin', 'admin', 'Admin', 'Ruler', 'testteacher', 'Test', 'Teacher', '2014-04-23 20:57:25', 'Need a substitute', 'I&#039;ve fallen ill and need a substitute for today!', 1),
(401, 'testteacher', 'admin', 'Admin', 'Ruler', 'testteacher', 'Test', 'Teacher', '2014-04-23 20:57:25', 'Need a substitute', 'I&#039;ve fallen ill and need a substitute for today!', 2),
(402, 'admin', 'admin', 'Admin', 'Ruler', 'testteacher', 'Test', 'Teacher', '2014-04-23 20:57:49', 'Recommendation', '....', 1),
(403, 'testteacher', 'admin', 'Admin', 'Ruler', 'testteacher', 'Test', 'Teacher', '2014-04-23 20:57:49', 'Recommendation', '....', 2),
(404, 'admin', 'admin', 'Admin', 'Ruler', 'admin2', 'groegy', 'bi', '2014-04-23 23:49:38', 'hello', 'hey', 1),
(405, 'admin2', 'admin', 'Admin', 'Ruler', 'admin2', 'groegy', 'bi', '2014-04-23 23:49:38', 'hello', 'hey', 2),
(406, 'admin2', 'admin', '', '', 'admin2', 'groegy', 'bi', '2014-04-23 23:53:10', 'workin in progress', 'hey', 4),
(407, 'teacher', 'teacher', 'teacher', 'teacher', 'admin2', 'groegy', 'bi', '2014-04-23 23:55:55', 'class 1', 'have the grades been posted for assignment 1 yet?', 1),
(408, 'admin2', 'teacher', 'teacher', 'teacher', 'admin2', 'groegy', 'bi', '2014-04-23 23:55:55', 'class 1', 'have the grades been posted for assignment 1 yet?', 2);

-- --------------------------------------------------------

--
-- Table structure for table `enrolled`
--

CREATE TABLE IF NOT EXISTS `enrolled` (
  `registerNum` int(10) NOT NULL AUTO_INCREMENT,
  `classID` int(10) NOT NULL,
  `studentID` int(20) NOT NULL,
  PRIMARY KEY (`registerNum`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=111 ;

--
-- Dumping data for table `enrolled`
--

INSERT INTO `enrolled` (`registerNum`, `classID`, `studentID`) VALUES
(36, 5, 1111),
(45, 5, 1235312),
(46, 5, 123),
(47, 5, 1122),
(55, 5, 112),
(56, 5, 113),
(57, 5, 114),
(59, 12, 112),
(60, 12, 113),
(61, 17, 32),
(63, 13, 923),
(72, 4, 112),
(73, 4, 113),
(75, 8, 112),
(76, 8, 113),
(78, 15, 112),
(79, 15, 113),
(81, 19, 7),
(83, 19, 2),
(86, 5, 12),
(87, 13, 12),
(88, 13, 123),
(89, 20, 12),
(90, 21, 7),
(92, 21, 2),
(95, 17, 112),
(96, 17, 113),
(98, 9, 112),
(99, 9, 113),
(100, 5, 7),
(101, 5, 2),
(102, 12, 7),
(103, 12, 2),
(104, 22, 12),
(106, 22, 2),
(107, 4, 919),
(108, 12, 919),
(109, 17, 12),
(110, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE IF NOT EXISTS `forum` (
  `topicID` int(10) NOT NULL AUTO_INCREMENT,
  `forumName` varchar(16) NOT NULL,
  `topic_subject` text NOT NULL,
  `topic_message` mediumtext NOT NULL,
  `author_user` varchar(25) NOT NULL,
  `author_first` varchar(20) NOT NULL,
  `author_last` varchar(25) NOT NULL,
  `role` int(1) NOT NULL,
  `date_posted` datetime NOT NULL,
  `last_post` datetime NOT NULL,
  PRIMARY KEY (`topicID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`topicID`, `forumName`, `topic_subject`, `topic_message`, `author_user`, `author_first`, `author_last`, `role`, `date_posted`, `last_post`) VALUES
(2, '3_forum', '111111111111111111hello2222Test', 'hello world', 'admin', 'Admin', 'Ruler', 1, '2014-03-23 21:56:13', '2014-03-23 21:56:13'),
(6, '3_forum', 'Testing response', 'plz respond.', 'admin', 'Admin', 'Ruler', 1, '2014-03-24 18:52:08', '2014-04-01 19:24:29'),
(10, '5_forum', 'Test subscribe.', 'test', 'admin', 'Admin', 'Ruler', 1, '2014-03-26 22:03:45', '2014-04-02 17:47:07'),
(11, '3_forum', 'Surprised Test Tomorrow and student reactions', 'Because we can....lol....\r\nPS. and we enjoy it\r\n --- Edited on 2014-04-05 01:45:25 by RegoneAdmin', 'RegoneAdmin', 'RegoneAdmin', 'Admin', 1, '2014-04-05 01:40:29', '2014-04-05 01:48:41'),
(12, '8_forum', 'Hello World', 'New student post!! I am student~!!@ --- Edited on 2014-04-06 15:00:22 by jsmith3', 'jsmith3', 'Johney', 'Smithy', 3, '2014-04-06 14:08:33', '2014-04-06 15:07:06'),
(13, '5_forum', 'Latest Topic', 'Test the start of a new forum thread...', 'admin', 'Admin', 'Ruler', 1, '2014-04-08 23:50:26', '2014-04-08 23:50:26'),
(15, '12_forum', 'Creating New Topic', 'For New User DO NOT REPLY', 'RegoneAdmin', 'RegoneAdmin', 'Admin', 1, '2014-04-09 16:33:46', '2014-04-09 17:39:10'),
(16, '1_forum', 'Hello World2', 'fadsfdsfdasfasdfdasfsd', 'RegthreeStudent', 'Regressionthree', 'Student', 3, '2014-04-09 17:40:00', '2014-04-09 17:40:00'),
(17, '1_forum', 'adfasdfdsf', 'asdfadsfdasfadsfasdfasdfds', 'RegthreeStudent', 'Regressionthree', 'Student', 3, '2014-04-09 17:43:49', '2014-04-09 17:43:49'),
(18, '5_forum', 'adfasdfsd', 'asdfasdfadsfd', 'RegoneAdmin', 'RegoneAdmin', 'Admin', 1, '2014-04-09 17:45:46', '2014-04-09 17:45:46'),
(19, '5_forum', 'ggaffdf', 'afasdfds --- Edited on 2014-04-15 22:47:36 by admin', 'RegoneAdmin', 'RegoneAdmin', 'Admin', 1, '2014-04-09 18:41:46', '2014-04-15 23:45:07'),
(20, '19_forum', 'new topic', 'hello class study page 5 in your books tomorrow --- Edited on 2014-04-09 19:06:58 by admin2 --- Edited on 2014-04-09 19:09:09 by admin2', 'admin', 'Admin', 'Ruler', 1, '2014-04-09 18:47:50', '2014-04-13 09:41:48'),
(21, '1_forum', 'whelp', 'something is broken\r\n', 'admin2', 'groegy', 'bi', 1, '2014-04-09 18:51:06', '2014-04-09 18:51:06'),
(24, '17_forum', 'Test', 'test', 'admin', 'Admin', 'Ruler', 1, '2014-04-09 19:17:30', '2014-04-09 19:17:30'),
(25, '1_forum', 'ewihioerhi', 'ijaeifjaoweif', 'testteacher', 'Test', 'Teacher', 2, '2014-04-09 19:17:49', '2014-04-09 19:17:49'),
(27, '17_forum', 'Testing bread', 'bread', 'admin', 'Admin', 'Ruler', 1, '2014-04-09 19:24:45', '2014-04-09 19:24:45'),
(28, '15_forum', 'hello', 'asdfadsfdasfdsafdsfds', 'RegthreeStudent', 'Regressionthree', 'Student', 3, '2014-04-09 20:54:54', '2014-04-09 21:02:58'),
(29, '15_forum', 'adsfdsaf', 'adsfadsfdsafdsfdsf', 'RegthreeStudent', 'Regressionthree', 'Student', 3, '2014-04-09 20:55:10', '2014-04-09 20:55:21'),
(30, '15_forum', 'asdfadsfdas', 'fdasfdsfd', 'RegthreeStudent', 'Regressionthree', 'Student', 3, '2014-04-09 20:55:37', '2014-04-09 20:55:37'),
(31, '13_forum', 'Testing new topic 22222', 'aiwhdawih --- Edited on 2014-04-12 13:05:10 by testteacher', 'testteacher', 'Test', 'Teacher', 2, '2014-04-12 13:03:55', '2014-04-12 13:08:53'),
(32, '19_forum', 'lkllkl', 'jiim', 'admin', 'Admin', 'Ruler', 1, '2014-04-13 09:38:51', '2014-04-13 09:41:39'),
(33, '12_forum', 'Hello testing 3 RegoneStudent', 'Hello this is testing for regression two student\r\n', 'RegthreeStudent', 'Regressionthree', 'Student', 3, '2014-04-13 22:06:20', '2014-04-13 22:06:50'),
(34, '13_forum', 'Tuesday&#039;s Class', 'hwuiawdawdawdawaw2222  --- Edited on 2014-04-21 15:54:03 by admin', 'testteacher', 'Test', 'Teacher', 2, '2014-04-16 18:38:16', '2014-04-21 15:54:29'),
(35, '20_forum', 'new topic', 'heyvdhuih --- Edited on 2014-04-18 19:03:14 by admin2', 'admin2', 'groegy', 'bi', 1, '2014-04-18 19:02:49', '2014-04-18 19:21:30'),
(36, '20_forum', 'no', 'no', 'admin2', 'groegy', 'bi', 1, '2014-04-18 19:02:58', '2014-04-18 19:02:58'),
(37, '21_forum', ';,l;,', 'klklk', 'admin2', 'groegy', 'bi', 1, '2014-04-18 19:05:43', '2014-04-18 19:05:43'),
(38, '21_forum', ';oilk', 'ilkl', 'admin2', 'groegy', 'bi', 1, '2014-04-18 19:06:09', '2014-04-18 19:06:09'),
(39, '21_forum', ';l;l', 'joinin', 'admin2', 'groegy', 'bi', 1, '2014-04-18 19:07:56', '2014-04-18 19:07:56'),
(40, '21_forum', 'fgfglkl', 'sdldfbl', 'admin2', 'groegy', 'bi', 1, '2014-04-18 19:20:02', '2014-04-18 19:20:02'),
(41, '20_forum', 'test', 'dfbkj', 'admin', 'Admin', 'Ruler', 1, '2014-04-18 19:22:01', '2014-04-18 19:22:01'),
(43, '13_forum', 'Questions About Homework 3', 'Please post any questions regarding homework three in this thread. Don&#039;t be afraid to ask for help! --- Edited on 2014-04-18 20:40:36 by admin', 'admin', 'Admin', 'Ruler', 1, '2014-04-18 19:25:04', '2014-04-20 16:42:23'),
(45, '5_forum', 'testing register', 'asdas', 'admin', 'Admin', 'Ruler', 1, '2014-04-19 02:45:29', '2014-04-19 02:45:29'),
(46, '5_forum', 'test register 2!', 'asdasd --- Edited on 2014-04-19 02:49:05 by admin', 'admin', 'Admin', 'Ruler', 1, '2014-04-19 02:47:38', '2014-04-19 04:35:09'),
(47, '17_forum', 'New form for final testing for all users', 'Testing for new forms to make sure it prompts all new errors', 'RegoneAdmin', 'RegoneAdmin', 'Admin', 1, '2014-04-19 04:33:40', '2014-04-19 04:33:40'),
(48, '5_forum', 'Testing for the fourth Round', 'Testing fro student&#039;s fourth round  --- Edited on 2014-04-24 02:58:40 by RegoneAdmin', 'RegoneStudent', 'RegoneStudent', 'Test', 3, '2014-04-19 04:55:29', '2014-04-24 03:02:25'),
(49, '5_forum', 'hell o ', 'qsirw', 'admin2', 'groegy', 'bi', 1, '2014-04-19 15:28:34', '2014-04-19 15:28:34');

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE IF NOT EXISTS `grade` (
  `gradeID` int(11) NOT NULL AUTO_INCREMENT,
  `studentID` int(20) NOT NULL,
  `classID` int(10) NOT NULL,
  `label` varchar(50) NOT NULL,
  `grade` varchar(6) NOT NULL,
  PRIMARY KEY (`gradeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=491 ;

--
-- Dumping data for table `grade`
--

INSERT INTO `grade` (`gradeID`, `studentID`, `classID`, `label`, `grade`) VALUES
(37, 852, 3, '1', '1'),
(38, 852, 3, 'A', 'A'),
(43, 12, 3, 'Quiz 1', '100.25'),
(44, 12, 3, 'Quiz 2', '66.677'),
(45, 12, 3, 'Quiz 3', '55'),
(46, 12, 3, 'Test 1', 'A'),
(47, 12, 3, 'Test 2 ', 'A'),
(48, 12, 3, 'Test 3', 'A'),
(49, 12, 3, 'Test 4', 'A'),
(52, 12, 6, 'HW 1', 'B'),
(53, 12, 6, 'HW 2', '66.788'),
(242, 7, 5, 'F      K', 'F'),
(245, 12, 8, 'HW 1', '100'),
(246, 12, 8, 'HW 2', '99.99'),
(247, 852, 8, 'HW 1', '50'),
(248, 852, 8, 'HW 2', '67.79'),
(250, 1122, 5, 'test1', '99.6'),
(251, 1122, 5, 'test2', 'ABDC'),
(252, 1122, 5, 'test3', 'A'),
(283, 852, 13, 'Test 1', 'A'),
(284, 852, 13, 'Test 3', '91'),
(285, 852, 13, 'Test 4', 'B'),
(287, 113, 5, 'asdf', 'A'),
(288, 113, 5, 'adfasd', 'B'),
(289, 113, 5, 'fdf', 'C'),
(290, 113, 5, 'asd', 'A'),
(291, 114, 5, 'adf', 'A'),
(292, 114, 5, 'as', 'B'),
(293, 923, 13, 'fight', 'A'),
(298, 111, 12, 'Friad', 'F'),
(324, 7, 19, 'pBc', '0'),
(325, 111, 19, 'B', '75'),
(435, 12, 5, 'Quiz 3', 'A'),
(436, 12, 5, 'Quiz 4', 'B'),
(437, 12, 5, 'Quiz 5', 'A'),
(438, 12, 5, 'Quiz 6', 'A'),
(439, 12, 5, 'Quiz 7', 'F'),
(440, 12, 5, 'Quiz 8', '6.5'),
(441, 12, 5, 'Quiz 9', '8.44'),
(442, 12, 5, 'Quiz 10 ', '2.3'),
(443, 12, 5, 'HW 3', '100'),
(444, 12, 5, 'HW 2', '11'),
(445, 12, 5, 'Project 1', '100'),
(446, 12, 5, 'Project 2', '50'),
(447, 12, 5, 'Project 3', '80'),
(448, 12, 5, 'HW 9', '11'),
(449, 12, 5, 'Quiz 11', '22'),
(450, 12, 5, 'Test1', 'A'),
(451, 12, 5, 'Test2', 'C'),
(452, 12, 5, 'Test4', '92'),
(453, 12, 5, 'Midterm', 'A'),
(454, 923, 13, 'Slay Apostle', 'A'),
(457, 123, 13, 'Testsss', '12.44'),
(458, 123, 13, 'tests', 'A'),
(461, 111, 13, 'Chair', 'C'),
(462, 111, 13, 'Tet', 'D'),
(463, 12, 13, 'set', '22'),
(468, 7, 21, 'Test1', 'F'),
(471, 2, 21, 'tettndfsfjkjl', 'B'),
(475, 2, 22, 'Test One', '100'),
(476, 2, 22, 'Test Two', 'B'),
(477, 12, 22, 'Test One', 'B'),
(478, 12, 22, 'Test Two', '76'),
(479, 919, 12, 'Test One', '98'),
(480, 919, 12, 'Test Two', '95'),
(481, 919, 12, 'Homework One', '100'),
(482, 919, 12, 'Quiz One', '97'),
(483, 919, 12, 'Quiz Two', '91'),
(487, 12, 17, 'afdsaf', '50'),
(488, 12, 17, 'ewew', '34'),
(489, 2, 5, 'test3', '100'),
(490, 2, 3, 'test1', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `messageboard`
--

CREATE TABLE IF NOT EXISTS `messageboard` (
  `messageID` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `messageContent` text,
  `accountID` int(10) NOT NULL,
  `authorFirstName` varchar(25) NOT NULL DEFAULT 'Test',
  `authorLastName` varchar(30) NOT NULL DEFAULT 'Admin',
  `messageDate` datetime DEFAULT NULL,
  PRIMARY KEY (`messageID`),
  KEY `authorID` (`accountID`),
  KEY `authorID_2` (`accountID`),
  KEY `accountID` (`accountID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `messageboard`
--

INSERT INTO `messageboard` (`messageID`, `messageContent`, `accountID`, `authorFirstName`, `authorLastName`, `messageDate`) VALUES
(2, '&#039;te&#039;ST&quot; &quot; , . : ;\n\nT @ # $ % ^ &amp; * ()\n{} [] \\ // &lt;&gt; E ` ` \n\nS T', 1, 'Admin', 'Ruler', '2014-03-18 17:06:39'),
(3, '&#039;te&#039;ST&quot; &quot; , . : ;\n\nT @ # $ % ^ &amp; * ()\n{} []  // &lt;&gt; E ` ` \n\nS T ing', 1, 'Admin', 'Ruler', '2014-03-18 17:09:06'),
(8, 'Hello there sir ferdinand', 1, 'Admin', 'Ruler', '2014-03-19 01:57:15'),
(10, 'Testing World yes EDIT TEST ANDRE WAS HERE', 1, 'Admin', 'Ruler', '2014-03-25 01:53:20'),
(11, 'Hello World! -Hey', 1, 'Admin', 'Ruler', '2014-03-26 13:59:26'),
(12, 'Hello testing for functionalities on the messageboard with user Admin', 1, 'Admin', 'Ruler', '2014-04-02 14:59:51'),
(14, 'testing 2 edit', 1, 'Admin', 'Ruler', '2014-04-02 17:56:17'),
(15, 'Test message to post for all to see!!!', 1, 'Admin', 'Ruler', '2014-04-07 21:11:58'),
(16, 'ADMIN2 Message', 1, 'Admin', 'Ruler', '2014-04-09 18:11:11'),
(21, 'additional dialogs1', 24, 'groegy', 'bi', '2014-04-09 18:25:14'),
(23, 'advance', 24, 'groegy', 'bi', '2014-04-12 17:28:15'),
(24, 'test', 24, 'groegy', 'bi', '2014-04-18 18:50:03'),
(25, 'rset1 dgdfkbdjfbkljl', 24, 'groegy', 'bi', '2014-04-18 18:50:22'),
(27, 'tes1xdgd..xfbdfbmkl', 24, 'groegy', 'bi', '2014-04-18 18:50:43'),
(28, 'School will be closed Monday for inclement weather.', 1, 'Admin', 'Ruler', '2014-04-18 19:09:52'),
(29, 'Homecoming dance will be taking place this Friday!', 1, 'Admin', 'Ruler', '2014-04-18 19:10:32'),
(31, 'All final grades of the semester will be due by May 8th. ', 1, 'Admin', 'Ruler', '2014-04-18 19:12:04'),
(32, 'Fundraiser for cancer research in the courtyard Thursday after school. Please come by and show your support!', 1, 'Admin', 'Ruler', '2014-04-18 19:12:50');

-- --------------------------------------------------------

--
-- Table structure for table `newuser`
--

CREATE TABLE IF NOT EXISTS `newuser` (
  `accountID` int(10) NOT NULL,
  `username` varchar(25) NOT NULL,
  `role` int(1) NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `newuser`
--

INSERT INTO `newuser` (`accountID`, `username`, `role`) VALUES
(7, 'admintest', 1),
(9, 'bsmith', 1),
(19, 'jcon', 1),
(21, 'Jfox', 1),
(15, 'RegfiveStudent', 3),
(14, 'RegfourStudent', 3),
(16, 'RegsixStudent', 3),
(25, 'RegtwoAdmin', 1),
(8, 'RegtwoParent', 4),
(7, 'RegtwoTeacher', 2),
(7, 'scroll', 3),
(3, 'steve', 4),
(19, 'student12', 3),
(21, 'studenttest', 3),
(3, 'teacher', 2),
(26, 'testadmin', 1),
(7, 'testparent', 4),
(9, 'teststudent2', 3),
(22, 'TrentR', 3),
(12, 'weweqqwer', 3);

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

CREATE TABLE IF NOT EXISTS `parent` (
  `accountID` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` char(128) NOT NULL DEFAULT 'password',
  `role` int(1) NOT NULL DEFAULT '4',
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `DOB` date NOT NULL DEFAULT '1970-01-01',
  `contactNum` bigint(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `salt` char(128) NOT NULL,
  PRIMARY KEY (`accountID`),
  UNIQUE KEY `accountID` (`accountID`),
  KEY `role` (`role`),
  KEY `role_2` (`role`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `parent`
--

INSERT INTO `parent` (`accountID`, `username`, `password`, `role`, `firstName`, `lastName`, `email`, `DOB`, `contactNum`, `status`, `salt`) VALUES
(2, 'janesmith', '1b7e9ed8bc12adf8e3cb0d603704951f67f9c1f5bbf7e27fa477b7e9488aa816', 4, 'Jane', 'Smith', 'jane@mail.com', '1990-04-01', 1112224444, 1, '22e'),
(3, 'steve', 'f8117f0ada40907f1cdd172900ee4ef684797b7dad40a9ea744cc6eb3341fe35', 4, 'steve', 'bin', 'the@gmail.com', '1998-01-12', 1235634235, 1, 'df0'),
(4, 'jestin', 'f1e7feed2e3d5b598b7b1688896a3df8a36f5d9fc211808046721271a816f634', 4, 'Jestin', 'Keaton', 'clumzyNinja@hotmail.com', '1969-12-31', 2345678888, 1, '711'),
(5, 'RegoneParent', '5844a9981e895e7ad9f19792602f3f4ec4ae2ecbefd07a48829905f6a1031800', 4, 'RegoneParent', 'test', 'regoneparent@abc.net', '2014-01-10', 1234567890, 1, 'd58'),
(6, 'parent', '8d548de500dd3dcff327c0ac060e5090dfedf65ac8fc974c8548ba62b125e93c', 4, 'dfgh', 'sdfdsh', 'he@he.com', '2014-04-02', 3405692349, 1, '67c'),
(7, 'testparent', '322c35723198bb8bcf072019e1721296e07d7dea2c0f8846ea3dce78f7664f82', 4, 'test', 'parent', 'testdialog@mail.com', '2014-04-15', 7777777777, 1, '5dd'),
(8, 'RegtwoParent', '9ed01748c0034d22b6fd02154101b3cb35e3b113da9952fd91139178dd223dac', 4, 'Regressiontwo', 'Parent', 'regtwoparent@abc.net', '2014-01-10', 1234567890, 1, '673');

-- --------------------------------------------------------

--
-- Table structure for table `parent_student_assoc`
--

CREATE TABLE IF NOT EXISTS `parent_student_assoc` (
  `studentID` int(20) NOT NULL,
  `guardianID` int(10) NOT NULL,
  `role` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parent_student_assoc`
--

INSERT INTO `parent_student_assoc` (`studentID`, `guardianID`, `role`) VALUES
(12, 19, 1),
(22, 19, 1),
(44, 19, 1),
(12, 2, 2),
(1111, 4, 2),
(12, 1, 1),
(1111, 1, 1),
(852, 1, 1),
(111, 3, 4),
(12, 3, 4),
(111, 7, 2),
(112, 7, 2),
(113, 7, 2),
(12, 6, 4),
(111, 25, 1),
(112, 25, 1),
(113, 25, 1),
(12, 2, 4),
(852, 2, 4),
(1234, 2, 4),
(12, 6, 2),
(1235312, 6, 2),
(7, 8, 2),
(12, 26, 1),
(12, 7, 4),
(12, 24, 1),
(111, 24, 1),
(9, 24, 1),
(111, 23, 1),
(112, 23, 1),
(111, 8, 4),
(112, 8, 4),
(113, 8, 4),
(114, 8, 4);

-- --------------------------------------------------------

--
-- Table structure for table `reset`
--

CREATE TABLE IF NOT EXISTS `reset` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `accountID` int(10) NOT NULL,
  `role` int(1) NOT NULL,
  `myKey` char(128) NOT NULL,
  `expire` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `response`
--

CREATE TABLE IF NOT EXISTS `response` (
  `responseID` int(10) NOT NULL AUTO_INCREMENT,
  `topicID` int(10) NOT NULL,
  `response_message` mediumtext NOT NULL,
  `author_user` varchar(25) NOT NULL,
  `author_first` varchar(20) NOT NULL,
  `author_last` varchar(25) NOT NULL,
  `role` int(1) NOT NULL,
  `date_posted` datetime NOT NULL,
  PRIMARY KEY (`responseID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=116 ;

--
-- Dumping data for table `response`
--

INSERT INTO `response` (`responseID`, `topicID`, `response_message`, `author_user`, `author_first`, `author_last`, `role`, `date_posted`) VALUES
(2, 6, 'Hello world!', 'admin', 'Admin', 'Ruler', 1, '2014-03-24 18:52:23'),
(41, 10, '&gt;Quote From: jsmith2\n&gt;5\n\n6', 'jsmith2', 'John', 'Smith', 1, '2014-03-26 22:48:12'),
(52, 10, '15 Edit this --- Edited on 2014-04-02 14:56:33 by admin --- Edited on 2014-04-02 14:59:22 by admin', 'jsmith2', 'John', 'Smith', 1, '2014-03-28 02:28:50'),
(58, 6, 'No', 'admin', 'Admin', 'Ruler', 1, '2014-04-01 19:22:49'),
(60, 10, 'hey there son --- Edited on 2014-04-02 14:56:12 by admin', 'admin', 'Admin', 'Ruler', 1, '2014-04-02 14:50:03'),
(62, 10, 'hey buddy', 'admin', 'Admin', 'Ruler', 1, '2014-04-02 15:32:28'),
(63, 10, 'how&#039;s it going sir\n\n&gt;Quote From: admin\n&gt;hey buddy\n\n', 'admintest', 'aaa', 'aaa', 1, '2014-04-02 17:43:56'),
(64, 10, 'hello all', 'admintest', 'aaa', 'aaa', 1, '2014-04-02 17:44:05'),
(65, 10, 'testing fr subscribion', 'admintest', 'aaa', 'aaa', 1, '2014-04-02 17:47:07'),
(66, 10, 'testing fr subscribion', 'admintest', 'aaa', 'aaa', 1, '2014-04-02 17:47:07'),
(67, 11, 'It is very good', 'RegoneAdmin', 'RegoneAdmin', 'Admin', 1, '2014-04-05 01:48:41'),
(69, 12, '&gt;Quote From: jsmith3\n&gt;student 2\n\nI am you someone edit me if they can. I can edit myself. Other student cannot. --- Edited on 2014-04-06 15:07:06 by jsmith3', 'jsmith3', 'Johney', 'Smithy', 3, '2014-04-06 14:12:44'),
(70, 12, 'Welcome`~', 'jfrosty', 'Jack', 'Frosty', 2, '2014-04-06 14:44:07'),
(71, 12, '&gt;Quote From: jfrosty\n&gt;Welcome`~\n\nHello!!~ --- Edited on 2014-04-06 14:57:24 by jfrosty', 'admin', 'Admin', 'Ruler', 1, '2014-04-06 14:56:32'),
(73, 12, '&gt;Quote From: jsmith3\n&gt;New student post!! --- Edited on 2014-04-06 14:56:10 by admin\n\nhi to you', 'jfrosty', 'Jack', 'Frosty', 2, '2014-04-06 14:58:55'),
(74, 12, '&gt;Quote From: jsmith3\n&gt;&gt;Quote From: jsmith3\n&gt;&gt;student 2\n&gt;\n&gt;I am you someone edit me if they can.\n\nI cannot edit I am student. I am editing my own. --- Edited on 2014-04-06 15:06:04 by scroll', 'scroll', 'Scroll', 'Page', 3, '2014-04-06 15:02:03'),
(75, 15, 'Hello world', 'RegthreeStudent', 'Regressionthree', 'Student', 3, '2014-04-09 17:39:10'),
(77, 20, 'okay', 'admin2', 'groegy', 'bi', 1, '2014-04-09 18:55:22'),
(79, 20, '&gt;Quote From: admin2\n&gt;okay\n\nwhat', 'admin2', 'groegy', 'bi', 1, '2014-04-09 18:55:35'),
(84, 20, 'post', 'admin', 'Admin', 'Ruler', 1, '2014-04-09 19:17:23'),
(85, 20, 'repl2', 'admin', 'Admin', 'Ruler', 1, '2014-04-09 19:18:08'),
(86, 29, 'adsfdasfdsfadsfdasf', 'RegthreeStudent', 'Regressionthree', 'Student', 3, '2014-04-09 20:55:21'),
(87, 28, '&gt;Quote From: RegthreeStudent\n&gt;asdfadsfdasfdsafdsfds\n\n', 'RegthreeStudent', 'Regressionthree', 'Student', 3, '2014-04-09 21:02:58'),
(89, 31, 'testss subscribe', 'admin', 'Admin', 'Ruler', 1, '2014-04-12 13:07:47'),
(90, 31, 'Testing again', 'admin', 'Admin', 'Ruler', 1, '2014-04-12 13:08:47'),
(91, 31, '&gt;Quote From: testteacher\n&gt;aiwhdawih --- Edited on 2014-04-12 13:05:10 by testteacher\n\nawdaaaa', 'admin', 'Admin', 'Ruler', 1, '2014-04-12 13:08:53'),
(94, 32, 'no', 'admin', 'Admin', 'Ruler', 1, '2014-04-13 09:39:15'),
(95, 32, 'fdgsdfbsfklj', 'admin', 'Admin', 'Ruler', 1, '2014-04-13 09:39:37'),
(96, 32, 'barney', 'admin', 'Admin', 'Ruler', 1, '2014-04-13 09:39:47'),
(97, 32, 'no', 'admin', 'Admin', 'Ruler', 1, '2014-04-13 09:40:44'),
(98, 32, 'hsdf', 'admin', 'Admin', 'Ruler', 1, '2014-04-13 09:41:39'),
(99, 20, 'kfvkj', 'admin', 'Admin', 'Ruler', 1, '2014-04-13 09:41:48'),
(100, 33, 'Testing reply', 'RegthreeStudent', 'Regressionthree', 'Student', 3, '2014-04-13 22:06:36'),
(101, 33, 'testing reply 3', 'RegthreeStudent', 'Regressionthree', 'Student', 3, '2014-04-13 22:06:50'),
(105, 19, 'dfgzdfg --- Edited on 2014-04-15 23:45:07 by admin', 'admin', 'Admin', 'Ruler', 1, '2014-04-15 23:45:02'),
(106, 34, 'awaaa', 'testteacher', 'Test', 'Teacher', 2, '2014-04-16 18:38:35'),
(108, 35, 'heydsvcbhjkh --- Edited on 2014-04-18 19:21:30 by admin', 'admin', 'Admin', 'Ruler', 1, '2014-04-18 19:21:17'),
(109, 46, '&gt;Quote From: admin\n&gt;asdasd --- Edited on 2014-04-19 02:49:05 by admin\n\nHello testing for quotes', 'RegoneStudent', 'RegoneStudent', 'Test', 3, '2014-04-19 04:34:46'),
(110, 46, 'Also reply on the messages', 'RegoneStudent', 'RegoneStudent', 'Test', 3, '2014-04-19 04:35:09'),
(111, 48, 'Replying for the fourth round testing', 'RegoneStudent', 'RegoneStudent', 'Test', 3, '2014-04-19 04:56:02'),
(112, 48, '&gt;Quote From: RegoneStudent\n&gt;Testing fro student&#039;s fourth round\n\nReply', 'RegoneStudent', 'RegoneStudent', 'Test', 3, '2014-04-19 04:59:35'),
(113, 43, 'I have a question!', 'testteacher', 'Test', 'Teacher', 2, '2014-04-20 16:42:23'),
(114, 34, 'It&#039;s cancelled!', 'testteacher', 'Test', 'Teacher', 2, '2014-04-21 15:54:29'),
(115, 48, '&gt;Quote From: RegoneStudent\n&gt;Testing fro student&#039;s fourth round  --- Edited on 2014-04-24 02:58:40 by RegoneAdmin\n\n', 'RegoneAdmin', 'RegoneAdmin', 'Admin', 1, '2014-04-24 03:02:25');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `role` int(1) NOT NULL,
  `description` varchar(10) NOT NULL,
  PRIMARY KEY (`role`),
  UNIQUE KEY `role_2` (`role`),
  KEY `role` (`role`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role`, `description`) VALUES
(1, 'Admin'),
(2, 'Teacher'),
(3, 'Student'),
(4, 'Parent');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `accountID` int(10) NOT NULL AUTO_INCREMENT,
  `studentID` int(20) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` char(128) NOT NULL DEFAULT 'password',
  `balance` decimal(8,2) NOT NULL DEFAULT '0.00',
  `role` int(1) NOT NULL DEFAULT '3',
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `DOB` date NOT NULL DEFAULT '1970-01-01',
  `contactNum` bigint(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `salt` char(128) NOT NULL,
  PRIMARY KEY (`accountID`),
  UNIQUE KEY `studentID` (`studentID`),
  KEY `studentID_2` (`studentID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`accountID`, `studentID`, `username`, `password`, `balance`, `role`, `firstName`, `lastName`, `email`, `DOB`, `contactNum`, `status`, `salt`) VALUES
(4, 12, 'jsmith3', '023106f6106440e3296f48ced632c7d2fe27a479c63b9809d9a983fa5ebaab7c', '999999.99', 3, 'Johney', 'Smithy', 'kng@spsu.edu', '1995-06-15', 1112224343, 1, 'cda'),
(5, 1235312, 'gregory', 'd50362520e59d0e5da4d26ed9cf7e65c189e91a0c1e08f5edf3b6bb1a19264c8', '14.00', 3, 'vergi', 'lasti', 'gregory@gmail.com', '1999-12-23', 1235434524, 1, '1c0'),
(6, 1111, 'teststudent', '2840b8ed0572eab781f0f67b4998bccbcc90040ee18fda2f0c33acae0bdf3d88', '1145.00', 3, 'test', 'test', 'test@mail.com', '1970-01-01', 1112224444, 1, '343'),
(7, 852, 'scroll', 'd328f49c926783ac2f8828e2af1db14599d4f88bd875144227ecd66e4cf9ad8c', '68.00', 3, 'Scroll', 'Page', 'test2@mail.com', '1980-01-01', 1112224444, 1, 'e93'),
(8, 1122, 'tbirth', 'aeca8a0882045dfb3970007d526b08fadc1d299af43c15af857d9d916bcc56b9', '0.00', 3, 'Test', 'Birth', '1111111111@111.com', '2100-01-01', 1112224444, 1, '4ed'),
(9, 16, 'teststudent2', '9bfae94ad5715561ef7c7a2cbb16b2e239c16b75b73f86db2986167c7b41cc04', '0.00', 3, 'Test', 'Student', 'test4@mail.com', '2014-03-21', 1112224444, 0, '726'),
(10, 123, 'RegoneStudent', 'c0912ce46844bbe86e52c35994c0448c075f0c13ca69086685e744ed6aad5f09', '0.00', 3, 'RegoneStudent', 'Test', 'regonestudent@abc.net', '1995-01-10', 1234567890, 1, 'daa'),
(11, 7, 'RegtwoStudent', '26bee52ea56abda69df5705ce9620fff196f42ac7d11505b03aac0751a8d2e75', '0.00', 3, 'RegtwoStudent', 'Student', 'regtwostudent@abc.net', '1995-01-10', 1234567890, 1, 'ad8'),
(12, 2, 'weweqqwer', '242cd0ff632d4122cfa68edbdecf4b4996d69e8bdaf55b8dd929911b3a5feccd', '0.00', 3, 'Jonas', 'McGibbons', 'hot.and.cold@h3.smith._.d.s.a', '1985-09-04', 3121121221, 1, 'ea5'),
(13, 111, 'RegthreeStudent', '7dfd1d7bd9f6ac6c5eca40b87901c8d26691bb48afa910e9a9bba3d99f101e3a', '61.00', 3, 'Regressionthree', 'Student', 'regthreestudent@abc.net', '1993-04-11', 1234567890, 1, 'ac0'),
(14, 112, 'RegfourStudent', 'cba854589fa353dbee9fe6a71b67f2d66ed6e3a59751717a26962ca662ebb66f', '0.00', 3, 'Regressionfour', 'Student', 'regfourstudent@abc.net', '1984-08-01', 1234567890, 1, 'f83'),
(15, 113, 'RegfiveStudent', '914163de0ebb63b0237e6a1551c272bb644e3705f993b4ecb12b27260ba908c6', '0.00', 3, 'Regressionfive', 'Student', 'regfivestudent@abc.net', '1979-02-01', 1234567890, 1, 'd79'),
(16, 114, 'RegsixStudent', '337278eefb64eeb59de206bae3d38078412ff03f48279bad3a5951ca40758585', '0.00', 3, 'RegressionSix', 'Student', 'regsixstudent@abc.net', '1995-01-11', 1234567890, 1, '301'),
(17, 32, 'teststudent3', '20c680c1059fd0ff32ba62f64ffcd15e7a7b4cbfa40a68cbef7415fd3d5b3f7e', '0.00', 3, 'Test', 'Student', 'test1@mail.com', '2014-04-09', 1112224444, 1, '807'),
(18, 923, 'gattsu', 'a3aa66f212f944a12bce1e9b8c76eb20ae97d80fd7f5e84c149cafe8dd1b1c84', '0.00', 3, 'Gattsu', 'Ber', 'Dihawidh@mgaih.com', '2014-04-07', 1234158798, 1, 'a0f'),
(19, 1234, 'student12', '5587637a9e2a2ce0b77da0345fb335e51e680e81b0289797f2416bdf8ea7bc39', '0.00', 3, 'ge', 'het', 'hello@egu.org', '2014-04-01', 3405692349, 1, '5e2'),
(20, 56, 'student2', '814d124f4403aa1a7d19af81c1b6a404658c8f820e38d687bcd5e5b41dfc67d3', '0.00', 3, 'student', 'bkl', 'the@he.com', '2014-04-02', 2353464569, 1, '4fc'),
(21, 9, 'studenttest', '3d80c00b73ac4ae43f2380311ee178b72581b1c2bd7fa5b6c76a5f6b704ca982', '5.00', 3, 'cfb-tom', 'dfd', 'the@hfbvnf.com', '1997-01-15', 4657030235, 1, '75b'),
(22, 919, 'TrentR', '0715b78053f7d0b94427c70a2d2a5168d33331a47c68a49962ee508baa031434', '0.00', 3, 'Trent', 'Reznor', 'nin@nin.com', '1995-08-24', 5555555555, 1, '818');

-- --------------------------------------------------------

--
-- Table structure for table `subscribe`
--

CREATE TABLE IF NOT EXISTS `subscribe` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `accountID` int(10) NOT NULL,
  `role` int(1) NOT NULL,
  `topicID` int(10) NOT NULL,
  `lastNum` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `subscribe`
--

INSERT INTO `subscribe` (`id`, `accountID`, `role`, `topicID`, `lastNum`) VALUES
(1, 1, 1, 9, 16),
(3, 2, 2, 10, 17),
(4, 1, 1, 6, 4),
(11, 1, 1, 18, 1),
(12, 2, 2, 18, 2),
(13, 23, 1, 11, 2),
(14, 4, 3, 12, 6),
(16, 13, 3, 15, 2),
(20, 13, 3, 29, 2),
(21, 13, 3, 28, 2),
(22, 6, 2, 31, 4),
(24, 1, 1, 32, 6),
(25, 24, 1, 32, 6),
(26, 24, 1, 20, 6),
(27, 13, 3, 33, 3),
(28, 6, 2, 34, 3),
(29, 24, 1, 35, 2),
(31, 1, 1, 43, 1),
(32, 23, 1, 47, 1),
(33, 10, 3, 46, 3),
(34, 10, 3, 48, 3),
(35, 10, 3, 10, 9),
(36, 1, 1, 34, 2);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
  `accountID` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` char(128) NOT NULL DEFAULT 'password',
  `role` int(1) NOT NULL DEFAULT '2',
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `DOB` date NOT NULL DEFAULT '1970-01-01',
  `contactNum` bigint(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `salt` char(128) NOT NULL,
  PRIMARY KEY (`accountID`),
  UNIQUE KEY `accountID` (`accountID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`accountID`, `username`, `password`, `role`, `firstName`, `lastName`, `email`, `DOB`, `contactNum`, `status`, `salt`) VALUES
(2, 'jfrosty', '693a6f1d65d1789cdf130440159352039811e52a5f38afd5d4d1642daef79160', 2, 'Jack', 'Frosty', 'jfrosty@mail.com', '1961-11-23', 1112224343, 1, 'c91'),
(3, 'teacher', '696c1bcccf138b38b7bb19792648f54883091f3505a212338b3dc1970048b383', 2, 'teacher', 'teacher', 'the@the.com', '2013-01-23', 2134867763, 1, '431'),
(4, 'nStudentID', '431788ed6cd20949fe1090c5f3eb36484db83ab4cfdc0efa29ee8f0e7f0f1fe6', 2, 'NoExist', 'StudentID', 'no@mail.com', '2014-03-19', 1112224445, 1, '0a7'),
(5, 'RegoneTeacher', '2fa17d0a76024ccea3457c2055e3def27d76315074419ee22f676249975dd957', 2, 'RegoneTeacher', 'Test', 'regoneteacher@abc.net', '1995-01-10', 1234567890, 1, '9a0'),
(6, 'testteacher', '7e950b9367b5113035e183c8c2e3733f2cb2d5a86e1cf8ac85d7d627c667e851', 2, 'Test', 'Teacher', 'dkenned2@spsu.edu', '2014-04-01', 5555555555, 1, 'a21'),
(7, 'RegtwoTeacher', '54b0a3f9989fbfc38745da0aa2086ac5c3500cdea2c2e7b036ea7f64ee1b5185', 2, 'Regressiontwo', 'Teacher', 'regtwoteacher@abc.net', '1995-01-01', 1234567890, 1, '29c'),
(8, 'teach1', '38e6f0eab3bcfa0ad1ea68134098e1922d22ae6d8dd26470c0712d0089fa6b20', 2, 'bc', 'dc', 'the@fed.com', '2014-04-03', 4670304593, 1, 'd0e');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`role`) REFERENCES `role` (`role`);

--
-- Constraints for table `parent`
--
ALTER TABLE `parent`
  ADD CONSTRAINT `parent_ibfk_1` FOREIGN KEY (`role`) REFERENCES `role` (`role`);

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `clearReset` ON SCHEDULE EVERY 3 HOUR STARTS '2014-03-30 00:53:02' ON COMPLETION NOT PRESERVE ENABLE DO begin
DELETE FROM reset WHERE expire < current_timestamp;
end$$

CREATE DEFINER=`root`@`localhost` EVENT `empty` ON SCHEDULE EVERY 3 HOUR STARTS '2014-03-13 21:06:11' ON COMPLETION PRESERVE ENABLE DO begin
delete from email where box = 3;
end$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
