-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 23, 2024 at 09:53 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `virtual_internet of things (iot) workshops_ platform`
--

-- --------------------------------------------------------

--
-- Table structure for table `analytics`
--

CREATE TABLE IF NOT EXISTS `analytics` (
  `AnalyticsID` int(11) NOT NULL AUTO_INCREMENT,
  `WorkshopID` int(11) DEFAULT NULL,
  `AttendeeID` int(11) DEFAULT NULL,
  `QuizID` int(11) DEFAULT NULL,
  `Score` int(11) DEFAULT NULL,
  PRIMARY KEY (`AnalyticsID`),
  KEY `WorkshopID` (`WorkshopID`),
  KEY `AttendeeID` (`AttendeeID`),
  KEY `QuizID` (`QuizID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `analytics`
--

INSERT INTO `analytics` (`AnalyticsID`, `WorkshopID`, `AttendeeID`, `QuizID`, `Score`) VALUES
(2, 1, 1, 3, 100),
(3, 1, 1, 3, 86);

-- --------------------------------------------------------

--
-- Table structure for table `attendees`
--

CREATE TABLE IF NOT EXISTS `attendees` (
  `AttendeeID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) DEFAULT NULL,
  `WorkshopID` int(11) DEFAULT NULL,
  `RegistrationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`AttendeeID`),
  KEY `UserID` (`UserID`),
  KEY `WorkshopID` (`WorkshopID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `attendees`
--

INSERT INTO `attendees` (`AttendeeID`, `UserID`, `WorkshopID`, `RegistrationDate`) VALUES
(1, 1, 1, '2024-05-17 14:07:19'),
(2, 1, 1, '2024-07-02 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `certificate`
--

CREATE TABLE IF NOT EXISTS `certificate` (
  `CertificateID` int(11) NOT NULL AUTO_INCREMENT,
  `AttendeeID` int(11) DEFAULT NULL,
  `WorkshopID` int(11) DEFAULT NULL,
  `IssueDate` date DEFAULT NULL,
  PRIMARY KEY (`CertificateID`),
  KEY `AttendeeID` (`AttendeeID`),
  KEY `WorkshopID` (`WorkshopID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `certificate`
--

INSERT INTO `certificate` (`CertificateID`, `AttendeeID`, `WorkshopID`, `IssueDate`) VALUES
(1, 1, 1, '2024-06-19'),
(2, 1, 1, '2024-05-19');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `FeedbackID` int(11) NOT NULL AUTO_INCREMENT,
  `WorkshopID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Rating` int(11) DEFAULT NULL,
  `Comment` text,
  PRIMARY KEY (`FeedbackID`),
  KEY `WorkshopID` (`WorkshopID`),
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`FeedbackID`, `WorkshopID`, `UserID`, `Rating`, `Comment`) VALUES
(2, 1, 1, 5, 'the workshop was so wonderfull'),
(3, 1, 1, 10, 'workshop was  very interested');

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE IF NOT EXISTS `instructors` (
  `InstructorID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) DEFAULT NULL,
  `Bio` text,
  `Specialization` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`InstructorID`),
  UNIQUE KEY `UserID` (`UserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `instructors`
--

INSERT INTO `instructors` (`InstructorID`, `UserID`, `Bio`, `Specialization`) VALUES
(1, 1, 'oganiser', 'teaching'),
(5, 2, 'oganiser', 'teache');

-- --------------------------------------------------------

--
-- Table structure for table `iotresources`
--

CREATE TABLE IF NOT EXISTS `iotresources` (
  `ResourceID` int(11) NOT NULL AUTO_INCREMENT,
  `WorkshopID` int(11) DEFAULT NULL,
  `ResourceType` varchar(50) DEFAULT NULL,
  `ResourceName` varchar(100) DEFAULT NULL,
  `ResourceURL` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ResourceID`),
  KEY `WorkshopID` (`WorkshopID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `iotresources`
--

INSERT INTO `iotresources` (`ResourceID`, `WorkshopID`, `ResourceType`, `ResourceName`, `ResourceURL`) VALUES
(1, 1, 'Book', 'IoT Fundamentals', 'https://example.com/iot-fundamentals'),
(2, 1, 'Video', 'IoT Workshop Intro', 'https://example.com/iot-intro-video'),
(3, 1, 'Course', 'Advanced IoT', 'https://example.com/advanced-iot-course');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `PaymentID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) DEFAULT NULL,
  `WorkshopID` int(11) DEFAULT NULL,
  `Amount` decimal(10,2) DEFAULT NULL,
  `PaymentDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`PaymentID`),
  KEY `UserID` (`UserID`),
  KEY `WorkshopID` (`WorkshopID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`PaymentID`, `UserID`, `WorkshopID`, `Amount`, `PaymentDate`) VALUES
(1, 2, 2, 30000.00, '2024-05-24 03:49:43'),
(3, 1, 2, 1000.00, '2024-09-15 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE IF NOT EXISTS `quiz` (
  `QuizID` int(11) NOT NULL AUTO_INCREMENT,
  `WorkshopID` int(11) DEFAULT NULL,
  `Question` text,
  `Option1` varchar(100) DEFAULT NULL,
  `Option2` varchar(100) DEFAULT NULL,
  `CorrectAnswer` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`QuizID`),
  KEY `WorkshopID` (`WorkshopID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`QuizID`, `WorkshopID`, `Question`, `Option1`, `Option2`, `CorrectAnswer`) VALUES
(3, 2, 'choose members included in iot workshop platform', 'farmers', 'instructors', 'instructors'),
(4, 1, 'IOT in full words', 'internet of things', 'internet of them', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `UserType` varchar(200) NOT NULL,
  `Password` varchar(100) NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Email`, `UserType`, `Password`) VALUES
(1, 'vestine', 'vestine25@gmail.com', 'Participant', '121212'),
(2, 'vestine', 'vestine25@gmail.com', '', '121212'),
(20, 'vestine', 'vestine25@gmail.com', 'Participant', '121212'),
(25, 'veve', 'vestine25@gmail.com', 'Instructor', '12345'),
(45, 'vestine', 'vestine25@gmail.com', 'Participant', '12345'),
(46, '', '', '', ''),
(47, 'vestine', 'vestine5@gmail.com', 'Participant', '333'),
(48, 'qaq', 'qaq@gmail.com', 'student', '123'),
(49, 'vestine', 'vestine277@gmail.com', 'manager', '123'),
(50, 'lazi', 'ruk@gmail.com', 'student', '12'),
(51, 'lazia', 'lazia@gmail.com', 'manager', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `workshops`
--

CREATE TABLE IF NOT EXISTS `workshops` (
  `WorkshopID` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(100) NOT NULL,
  `Description` text,
  `Date` date NOT NULL,
  `InstructorID` int(11) DEFAULT NULL,
  `MaxParticipants` int(11) DEFAULT NULL,
  PRIMARY KEY (`WorkshopID`),
  KEY `InstructorID` (`InstructorID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `workshops`
--

INSERT INTO `workshops` (`WorkshopID`, `Title`, `Description`, `Date`, `InstructorID`, `MaxParticipants`) VALUES
(1, 'project ', 'instructor', '2024-05-18', 5, 100),
(2, 'project based on iot learning', 'instructor', '2024-05-18', 1, 100),
(3, 'project', 'instructor', '2024-05-18', 1, 100);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `analytics`
--
ALTER TABLE `analytics`
  ADD CONSTRAINT `analytics_ibfk_1` FOREIGN KEY (`WorkshopID`) REFERENCES `workshops` (`WorkshopID`),
  ADD CONSTRAINT `analytics_ibfk_2` FOREIGN KEY (`AttendeeID`) REFERENCES `attendees` (`AttendeeID`),
  ADD CONSTRAINT `analytics_ibfk_3` FOREIGN KEY (`QuizID`) REFERENCES `quiz` (`QuizID`);

--
-- Constraints for table `attendees`
--
ALTER TABLE `attendees`
  ADD CONSTRAINT `attendees_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `attendees_ibfk_2` FOREIGN KEY (`WorkshopID`) REFERENCES `workshops` (`WorkshopID`);

--
-- Constraints for table `certificate`
--
ALTER TABLE `certificate`
  ADD CONSTRAINT `certificate_ibfk_1` FOREIGN KEY (`AttendeeID`) REFERENCES `attendees` (`AttendeeID`),
  ADD CONSTRAINT `certificate_ibfk_2` FOREIGN KEY (`WorkshopID`) REFERENCES `workshops` (`WorkshopID`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`WorkshopID`) REFERENCES `workshops` (`WorkshopID`),
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `instructors`
--
ALTER TABLE `instructors`
  ADD CONSTRAINT `instructors_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `iotresources`
--
ALTER TABLE `iotresources`
  ADD CONSTRAINT `iotresources_ibfk_1` FOREIGN KEY (`WorkshopID`) REFERENCES `workshops` (`WorkshopID`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`WorkshopID`) REFERENCES `workshops` (`WorkshopID`);

--
-- Constraints for table `quiz`
--
ALTER TABLE `quiz`
  ADD CONSTRAINT `quiz_ibfk_1` FOREIGN KEY (`WorkshopID`) REFERENCES `workshops` (`WorkshopID`);

--
-- Constraints for table `workshops`
--
ALTER TABLE `workshops`
  ADD CONSTRAINT `workshops_ibfk_1` FOREIGN KEY (`InstructorID`) REFERENCES `instructors` (`InstructorID`);
