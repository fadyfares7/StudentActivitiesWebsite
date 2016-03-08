-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2015 at 12:32 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `campaign`
--

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
(1, 'meca academy ', '2015-12-26', '2015-12-27'),
(2, 'let go', '2015-12-26', '2015-12-28');

-- --------------------------------------------------------

--
-- Table structure for table `campaign_location`
--

CREATE TABLE `campaign_location` (
  `SA_ID` int(10) UNSIGNED NOT NULL,
  `Camp_Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `campaign_location`
--

INSERT INTO `campaign_location` (`SA_ID`, `Camp_Name`, `location`) VALUES
(1, 'meca academy ', 'el modrgat'),
(1, 'meca academy ', 'el tak3eba'),
(2, 'let go', 'el tak3eba'),
(2, 'let go', 'ma3ml el bank');

-- --------------------------------------------------------

--
-- Table structure for table `committee`
--

CREATE TABLE `committee` (
  `Com_ID` int(10) UNSIGNED NOT NULL,
  `Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `committee`
--

INSERT INTO `committee` (`Com_ID`, `Name`, `description`) VALUES
(1, 'HR', 'Hr committee'),
(2, 'FR', 'asds');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `S_ID` char(7) COLLATE utf8_unicode_ci NOT NULL,
  `SA_ID` int(10) UNSIGNED NOT NULL,
  `Com_ID` int(10) UNSIGNED NOT NULL,
  `Pos` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`S_ID`, `SA_ID`, `Com_ID`, `Pos`) VALUES
('1111110', 1, 1, 'head'),
('1111110', 2, 2, 'FR head');

-- --------------------------------------------------------

--
-- Table structure for table `participant`
--

CREATE TABLE `participant` (
  `S_ID` char(7) COLLATE utf8_unicode_ci NOT NULL,
  `SA_ID` int(10) UNSIGNED NOT NULL,
  `T_ID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `professor`
--

CREATE TABLE `professor` (
  `code` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `professor`
--

INSERT INTO `professor` (`code`, `name`) VALUES
(0, 'Mona'),
(1, 'Hoda'),
(2, 'Cherif'),
(3, 'Hazzem'),
(4, 'Ahmed zaki');

-- --------------------------------------------------------

--
-- Table structure for table `registered_in`
--

CREATE TABLE `registered_in` (
  `SA_ID` int(10) UNSIGNED NOT NULL,
  `U_ID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `registered_in`
--

INSERT INTO `registered_in` (`SA_ID`, `U_ID`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sa_committee`
--

CREATE TABLE `sa_committee` (
  `SA_ID` int(10) UNSIGNED NOT NULL,
  `Com_ID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sa_committee`
--

INSERT INTO `sa_committee` (`SA_ID`, `Com_ID`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sponsor`
--

CREATE TABLE `sponsor` (
  `SP_ID` int(10) UNSIGNED NOT NULL,
  `Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sponsored_by`
--

CREATE TABLE `sponsored_by` (
  `SA_ID` int(10) UNSIGNED NOT NULL,
  `SP_ID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

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
('1111110', 'fady', 'fadyfares@hotmail.com', '01025462565'),
('1111111', 'rizk', 'rizk@hotmail.com', '01025462564'),
('1111112', 'reem', 'reem@hotmail.com', '01025462568'),
('1111113', 'sameh', 'sameh@hotmail.com', '01026564547'),
('1111115', 'mego', 'mego@hotmail.com', '01026564548');

-- --------------------------------------------------------

--
-- Stand-in structure for view `students_in_activities`
--
CREATE TABLE `students_in_activities` (
`S_ID` char(7)
,`SA_ID` int(11) unsigned
);

-- --------------------------------------------------------

--
-- Table structure for table `student_activity`
--

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
(1, 'Meca', '', './img/1.jpg', 'Meca', '', 0),
(2, 'aces', '', './img/2.jpg', '1235', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `track`
--

CREATE TABLE `track` (
  `T_ID` int(10) UNSIGNED NOT NULL,
  `Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `track`
--

INSERT INTO `track` (`T_ID`, `Name`, `Description`) VALUES
(1, 'embedded', 'embedded systems'),
(2, 'Database adminstration', 'Database adminstration'),
(3, 'FR adminstration', 'assss');

-- --------------------------------------------------------

--
-- Table structure for table `track_campaign`
--

CREATE TABLE `track_campaign` (
  `SA_ID` int(10) UNSIGNED NOT NULL,
  `Camp_Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `T_ID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `track_campaign`
--

INSERT INTO `track_campaign` (`SA_ID`, `Camp_Name`, `T_ID`) VALUES
(1, 'meca academy ', 1),
(1, 'meca academy ', 2),
(2, 'let go', 1),
(2, 'let go', 2),
(2, 'let go', 3);

-- --------------------------------------------------------

--
-- Table structure for table `university`
--

CREATE TABLE `university` (
  `U_ID` int(10) UNSIGNED NOT NULL,
  `Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `university`
--

INSERT INTO `university` (`U_ID`, `Name`) VALUES
(1, 'Ain shams'),
(2, 'Cairo');

-- --------------------------------------------------------

--
-- Structure for view `students_in_activities`
--
DROP TABLE IF EXISTS `students_in_activities`;

CREATE ALGORITHM=UNDEFINED DEFINER=`user`@`localhost` SQL SECURITY DEFINER VIEW `students_in_activities`  AS  (select `member`.`S_ID` AS `S_ID`,`member`.`SA_ID` AS `SA_ID` from `member`) union (select distinct `participant`.`S_ID` AS `S_ID`,`participant`.`SA_ID` AS `SA_ID` from `participant`) ;

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
  MODIFY `Com_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `student_activity`
--
ALTER TABLE `student_activity`
  MODIFY `SA_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `track`
--
ALTER TABLE `track`
  MODIFY `T_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `university`
--
ALTER TABLE `university`
  MODIFY `U_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
