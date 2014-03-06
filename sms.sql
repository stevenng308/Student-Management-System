-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 03, 2014 at 02:42 AM
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
  `zip` int(5) NOT NULL
)

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
)

-- --------------------------------------------------------

INSERT INTO `admin` (`accountID`, `username`, `password`, `role`, `firstName`, `lastName`, `email`, `DOB`, `contactNum`, `status`, `salt`) VALUES
(1, 'admin', 'dce15624c79336c6d6bca9e892b9285ccae6934b82dc27939d1c7b8eebb28a09', 1, 'Admin', 'Ruler', 'admin@mail.com', '1970-01-01', 7777777777, 1, 'db0')

--
-- Table structure for table `classroom`
--

CREATE TABLE IF NOT EXISTS `classroom` (
  `classID` int(8) NOT NULL,
  `courseNO` int(8) NOT NULL,
  `courseDescript` varchar(50) NOT NULL,
  `classTime` time NOT NULL,
  `teacherID` int(10) NOT NULL,
  PRIMARY KEY (`classID`)
)

-- --------------------------------------------------------

--
-- Table structure for table `enrolled`
--

CREATE TABLE IF NOT EXISTS `enrolled` (
  `classID` int(8) NOT NULL,
  `studentID` int(20) NOT NULL,
  PRIMARY KEY (`classID`)
)

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
  PRIMARY KEY (`messageID`)
)

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
)

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

CREATE TABLE IF NOT EXISTS `parent` (
  `accountID` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(16) NOT NULL DEFAULT 'password',
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
)

-- --------------------------------------------------------

--
-- Table structure for table `parent_student_assoc`
--

CREATE TABLE IF NOT EXISTS `parent_student_assoc` (
  `studentID` int(20) NOT NULL,
  `guardianID` int(10) NOT NULL,
  `role` int(1) NOT NULL
)

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
)

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
)

ALTER TABLE `student` ADD `balance` INT( 6 ) NOT NULL DEFAULT '0' AFTER `password` ;
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
)

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
