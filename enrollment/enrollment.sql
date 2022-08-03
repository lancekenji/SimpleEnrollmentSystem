-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2022 at 03:43 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `enrollment`
--

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `idno` int(10) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subj_code` varchar(255) NOT NULL,
  `subj_name` varchar(255) NOT NULL,
  `subj_type` varchar(255) NOT NULL,
  `subj_unit` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subj_code`, `subj_name`, `subj_type`, `subj_unit`) VALUES
('CC-DISCRET21', 'Discrete Structure', 'Lecture', '3'),
('CC-HCI31', 'Human Computer Interaction', 'Lecture', '3'),
('CC-PRACT41', 'Practicum 1', 'Laboratory', '5'),
('CC-RESCOM31', 'Methods of Research in Computing', 'Lecture', '3'),
('CC-WEBDEV11', 'Web Design & Development', 'Lecture and Laboratory', '3'),
('ENGL 100', 'Communication Arts', 'Lecture', '3'),
('FIL 101', 'Sining ng Komunikasyon', 'Lecture', '3'),
('IT-CPSTONE41', 'Capstone Project', 'Lecture', '3'),
('IT-NETWORK31', 'Computer Networks', 'Lecture and Laboratory', '3'),
('IT-OOPROG21', 'Object Oriented Programming', 'Lecture and Laboratory', '3'),
('LIT 11', 'Literatures of the World', 'Lecture', '3'),
('SOCIO 101', 'The Contemporary World', 'Lecture', '3');

-- --------------------------------------------------------

--
-- Table structure for table `subject_offered`
--

CREATE TABLE `subject_offered` (
  `edp_code` int(11) NOT NULL,
  `subj_code` varchar(255) NOT NULL,
  `start_time` varchar(255) NOT NULL,
  `end_time` varchar(255) NOT NULL,
  `days` varchar(255) NOT NULL,
  `room` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject_offered`
--

INSERT INTO `subject_offered` (`edp_code`, `subj_code`, `start_time`, `end_time`, `days`, `room`) VALUES
(2131000, 'ENGL 100', '8:00am', '10:00am', 'MW', '100'),
(2131000, 'FIL 101', '10:00am', '12:00am', 'MW', '101'),
(2131000, 'CC-WEBDEV11', '1:00pm', '5:00pm', 'F', '105'),
(2132000, 'SOCIO 101', '7:00am', '9:00am', 'MW', '101'),
(2132000, 'CC-DISCRET21', '9:00am', '12:00pm', 'MW', '105'),
(2132000, 'IT-OOPROG21', '1:00pm', '5:00pm', 'F', '105'),
(2133000, 'CC-RESCOM31', '7:00am', '9:00am', 'MWF', '106'),
(2133000, 'CC-HCI31', '9:00am', '12:00pm', 'MWF', '105'),
(2133000, 'IT-NETWORK31', '1:00pm', '5:00pm', 'F', '106'),
(2134000, 'LIT 11', '7:00am', '5:00pm', 'MW', '104'),
(2134000, 'IT-CPSTONE41', '7:00am', '10:00am', 'F', '106'),
(2134000, 'CC-PRACT41', '10:00am', '5:00pm', 'F', '105');

-- --------------------------------------------------------

--
-- Table structure for table `subject_offered_details`
--

CREATE TABLE `subject_offered_details` (
  `id` int(10) NOT NULL,
  `edp_code` varchar(255) NOT NULL,
  `idno` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD KEY `idno` (`idno`) USING BTREE;

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD KEY `subj_code` (`subj_code`) USING BTREE;

--
-- Indexes for table `subject_offered`
--
ALTER TABLE `subject_offered`
  ADD KEY `subj_code` (`subj_code`),
  ADD KEY `edp_code` (`edp_code`) USING BTREE;

--
-- Indexes for table `subject_offered_details`
--
ALTER TABLE `subject_offered_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idno` (`idno`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `idno` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- AUTO_INCREMENT for table `subject_offered_details`
--
ALTER TABLE `subject_offered_details`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `subject_offered`
--
ALTER TABLE `subject_offered`
  ADD CONSTRAINT `subject_offered_ibfk_1` FOREIGN KEY (`subj_code`) REFERENCES `subject` (`subj_code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
