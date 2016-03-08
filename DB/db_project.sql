-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2015 at 09:27 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_project`
--
CREATE DATABASE IF NOT EXISTS `db_project` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `db_project`;

-- --------------------------------------------------------

--
-- Table structure for table `campaign`
--

DROP TABLE IF EXISTS `campaign`;
CREATE TABLE `campaign` (
  `SA_ID` int(10) UNSIGNED NOT NULL,
  `Camp_Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Start_Date` date NOT NULL,
  `End_Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `campaign`
--

INSERT INTO `campaign` (`SA_ID`, `Camp_Name`, `Start_Date`, `End_Date`) VALUES
(1, 'Fresh Start', '2002-01-16', '2029-01-16'),
(1, 'meca 1.0', '2015-12-27', '2015-12-31'),
(1, 'new', '2012-01-15', '2031-08-16'),
(1, 't2', '2008-07-05', '2012-01-03'),
(2, 'Meca 2', '2015-12-16', '2015-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `campaign_location`
--

DROP TABLE IF EXISTS `campaign_location`;
CREATE TABLE `campaign_location` (
  `SA_ID` int(10) UNSIGNED NOT NULL,
  `Camp_Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `campaign_location`
--

INSERT INTO `campaign_location` (`SA_ID`, `Camp_Name`, `location`) VALUES
(1, 'Fresh Start', 'loc1'),
(1, 'Fresh Start', 'loc2'),
(1, 'meca 1.0', '123'),
(1, 'meca 1.0', '894651'),
(1, 'meca 1.0', 'Cairo');

-- --------------------------------------------------------

--
-- Table structure for table `committee`
--

DROP TABLE IF EXISTS `committee`;
CREATE TABLE `committee` (
  `Com_ID` int(10) UNSIGNED NOT NULL,
  `Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `committee`
--

INSERT INTO `committee` (`Com_ID`, `Name`, `description`) VALUES
(1, 'HR', NULL),
(2, 'PR', NULL),
(3, 'FR', NULL),
(4, 'R&D', 'Research and Development.');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
CREATE TABLE `member` (
  `S_ID` char(7) COLLATE utf8_unicode_ci NOT NULL,
  `SA_ID` int(10) UNSIGNED NOT NULL,
  `Com_ID` int(10) UNSIGNED NOT NULL,
  `Pos` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `participant`
--

DROP TABLE IF EXISTS `participant`;
CREATE TABLE `participant` (
  `S_ID` char(7) COLLATE utf8_unicode_ci NOT NULL,
  `SA_ID` int(10) UNSIGNED NOT NULL,
  `T_ID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `professor`
--

DROP TABLE IF EXISTS `professor`;
CREATE TABLE `professor` (
  `code` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `professor`
--

INSERT INTO `professor` (`code`, `name`) VALUES
(11111, 'Ahmed'),
(22222, 'Hazem'),
(33333, 'Seif'),
(44444, 'Cherif');

-- --------------------------------------------------------

--
-- Table structure for table `registered_in`
--

DROP TABLE IF EXISTS `registered_in`;
CREATE TABLE `registered_in` (
  `SA_ID` int(10) UNSIGNED NOT NULL,
  `U_ID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `registered_in`
--

INSERT INTO `registered_in` (`SA_ID`, `U_ID`) VALUES
(2, 1),
(4, 1),
(10, 1),
(14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sa_committee`
--

DROP TABLE IF EXISTS `sa_committee`;
CREATE TABLE `sa_committee` (
  `SA_ID` int(10) UNSIGNED NOT NULL,
  `Com_ID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sa_committee`
--

INSERT INTO `sa_committee` (`SA_ID`, `Com_ID`) VALUES
(1, 2),
(1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `sponsor`
--

DROP TABLE IF EXISTS `sponsor`;
CREATE TABLE `sponsor` (
  `SP_ID` int(10) UNSIGNED NOT NULL,
  `Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sponsored_by`
--

DROP TABLE IF EXISTS `sponsored_by`;
CREATE TABLE `sponsored_by` (
  `SA_ID` int(10) UNSIGNED NOT NULL,
  `SP_ID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
  `Code` char(7) COLLATE utf8_unicode_ci NOT NULL,
  `Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `E-mail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Phone_No` char(11) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`Code`, `Name`, `E-mail`, `Phone_No`) VALUES
('1111111', 'Reem Medhat', 'reem@gmail.com', '01111111111'),
('1111112', 'Fady Fares', 'fady@gmail.com', '01111111112'),
('1111113', 'Rizk Tawfik', 'rizk@gmail.com', '01111111113');

-- --------------------------------------------------------

--
-- Table structure for table `student_activity`
--

DROP TABLE IF EXISTS `student_activity`;
CREATE TABLE `student_activity` (
  `SA_ID` int(10) UNSIGNED NOT NULL,
  `Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Desc` text COLLATE utf8_unicode_ci,
  `imgPath` text COLLATE utf8_unicode_ci,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prof_code` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `student_activity`
--

INSERT INTO `student_activity` (`SA_ID`, `Name`, `Desc`, `imgPath`, `password`, `website`, `prof_code`) VALUES
(1, 'Meca', NULL, 'img/meca.jpg', '123', NULL, 11111),
(2, 'Aces', NULL, 'img/aces.jpg', '1234', NULL, 22222),
(3, 'Apec', NULL, NULL, '12345', NULL, 33333),
(4, 'Aisec', '', '', 'muxysk603ma38fr', 'google.com', 11111),
(5, 'United', '', '', 'm87ivabwottsxlxr', '', 44444),
(10, 'NEW_ASU', '', '', 'iwyvsfhpyu4vlsor', '7sen.com', 44444),
(14, 'Img', '', './img/14.png', '8x6d5pbvjbcblnmi', 'mysite.tk', 44444);

-- --------------------------------------------------------

--
-- Table structure for table `track`
--

DROP TABLE IF EXISTS `track`;
CREATE TABLE `track` (
  `T_ID` int(10) UNSIGNED NOT NULL,
  `Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `track`
--

INSERT INTO `track` (`T_ID`, `Name`, `Description`) VALUES
(1, 'Embedded', 'Test\r\n123\r\n123\r\n456'),
(2, 'hr', 'bibi');

-- --------------------------------------------------------

--
-- Table structure for table `track_campaign`
--

DROP TABLE IF EXISTS `track_campaign`;
CREATE TABLE `track_campaign` (
  `SA_ID` int(10) UNSIGNED NOT NULL,
  `Camp_Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `T_ID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `track_campaign`
--

INSERT INTO `track_campaign` (`SA_ID`, `Camp_Name`, `T_ID`) VALUES
(1, 'Fresh Start', 1),
(1, 'Fresh Start', 2);

-- --------------------------------------------------------

--
-- Table structure for table `university`
--

DROP TABLE IF EXISTS `university`;
CREATE TABLE `university` (
  `U_ID` int(10) UNSIGNED NOT NULL,
  `Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `university`
--

INSERT INTO `university` (`U_ID`, `Name`) VALUES
(1, 'Ain Shams');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `campaign`
--
ALTER TABLE `campaign`
  ADD PRIMARY KEY (`SA_ID`,`Camp_Name`),
  ADD UNIQUE KEY `Camp_Name` (`Camp_Name`);

--
-- Indexes for table `campaign_location`
--
ALTER TABLE `campaign_location`
  ADD PRIMARY KEY (`SA_ID`,`Camp_Name`,`location`);

--
-- Indexes for table `committee`
--
ALTER TABLE `committee`
  ADD PRIMARY KEY (`Com_ID`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`S_ID`,`SA_ID`),
  ADD KEY `Com_ID` (`Com_ID`),
  ADD KEY `member_ibfk_1` (`SA_ID`,`Com_ID`);

--
-- Indexes for table `participant`
--
ALTER TABLE `participant`
  ADD PRIMARY KEY (`S_ID`,`SA_ID`),
  ADD KEY `SA_ID` (`SA_ID`),
  ADD KEY `T_ID` (`T_ID`);

--
-- Indexes for table `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `registered_in`
--
ALTER TABLE `registered_in`
  ADD PRIMARY KEY (`SA_ID`,`U_ID`),
  ADD KEY `registered_in_ibfk_1` (`U_ID`);

--
-- Indexes for table `sa_committee`
--
ALTER TABLE `sa_committee`
  ADD PRIMARY KEY (`SA_ID`,`Com_ID`),
  ADD KEY `Com_ID` (`Com_ID`);

--
-- Indexes for table `sponsor`
--
ALTER TABLE `sponsor`
  ADD PRIMARY KEY (`SP_ID`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `sponsored_by`
--
ALTER TABLE `sponsored_by`
  ADD PRIMARY KEY (`SA_ID`,`SP_ID`),
  ADD KEY `SP_ID` (`SP_ID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`Code`);

--
-- Indexes for table `student_activity`
--
ALTER TABLE `student_activity`
  ADD PRIMARY KEY (`SA_ID`),
  ADD UNIQUE KEY `name` (`Name`),
  ADD KEY `prof_code` (`prof_code`);

--
-- Indexes for table `track`
--
ALTER TABLE `track`
  ADD PRIMARY KEY (`T_ID`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `track_campaign`
--
ALTER TABLE `track_campaign`
  ADD PRIMARY KEY (`SA_ID`,`Camp_Name`,`T_ID`),
  ADD KEY `T_ID` (`T_ID`);

--
-- Indexes for table `university`
--
ALTER TABLE `university`
  ADD PRIMARY KEY (`U_ID`),
  ADD UNIQUE KEY `name` (`Name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `committee`
--
ALTER TABLE `committee`
  MODIFY `Com_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `student_activity`
--
ALTER TABLE `student_activity`
  MODIFY `SA_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `track`
--
ALTER TABLE `track`
  MODIFY `T_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `university`
--
ALTER TABLE `university`
  MODIFY `U_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `campaign`
--
ALTER TABLE `campaign`
  ADD CONSTRAINT `campaign_ibfk_1` FOREIGN KEY (`SA_ID`) REFERENCES `student_activity` (`SA_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `campaign_location`
--
ALTER TABLE `campaign_location`
  ADD CONSTRAINT `campaign_location_fk_1` FOREIGN KEY (`SA_ID`,`Camp_Name`) REFERENCES `campaign` (`SA_ID`, `Camp_Name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `member_ibfk_1` FOREIGN KEY (`SA_ID`,`Com_ID`) REFERENCES `sa_committee` (`SA_ID`, `Com_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `member_ibfk_2` FOREIGN KEY (`S_ID`) REFERENCES `student` (`Code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `member_ibfk_3` FOREIGN KEY (`Com_ID`) REFERENCES `committee` (`Com_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `participant`
--
ALTER TABLE `participant`
  ADD CONSTRAINT `participant_ibfk_1` FOREIGN KEY (`SA_ID`) REFERENCES `student_activity` (`SA_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `participant_ibfk_2` FOREIGN KEY (`S_ID`) REFERENCES `student` (`Code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `participant_ibfk_3` FOREIGN KEY (`T_ID`) REFERENCES `track` (`T_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `registered_in`
--
ALTER TABLE `registered_in`
  ADD CONSTRAINT `registered_in_ibfk_1` FOREIGN KEY (`U_ID`) REFERENCES `university` (`U_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `registered_in_ibfk_2` FOREIGN KEY (`SA_ID`) REFERENCES `student_activity` (`SA_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sa_committee`
--
ALTER TABLE `sa_committee`
  ADD CONSTRAINT `sa_committee_ibfk_1` FOREIGN KEY (`Com_ID`) REFERENCES `committee` (`Com_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sa_committee_ibfk_2` FOREIGN KEY (`SA_ID`) REFERENCES `student_activity` (`SA_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sponsored_by`
--
ALTER TABLE `sponsored_by`
  ADD CONSTRAINT `sponsored_by_ibfk_1` FOREIGN KEY (`SA_ID`) REFERENCES `student_activity` (`SA_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sponsored_by_ibfk_2` FOREIGN KEY (`SP_ID`) REFERENCES `sponsor` (`SP_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_activity`
--
ALTER TABLE `student_activity`
  ADD CONSTRAINT `student_activity_ibfk_1` FOREIGN KEY (`prof_code`) REFERENCES `professor` (`code`);

--
-- Constraints for table `track_campaign`
--
ALTER TABLE `track_campaign`
  ADD CONSTRAINT `track_campaign_fk_1` FOREIGN KEY (`SA_ID`,`Camp_Name`) REFERENCES `campaign` (`SA_ID`, `Camp_Name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `track_campaign_ibfk_1` FOREIGN KEY (`T_ID`) REFERENCES `track` (`T_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
