-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2017 at 06:15 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `midterm`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounttype`
--

CREATE TABLE `accounttype` (
  `AccTypeID` int(11) NOT NULL,
  `AccountName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounttype`
--

INSERT INTO `accounttype` (`AccTypeID`, `AccountName`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `ampm`
--

CREATE TABLE `ampm` (
  `AmPmID` int(11) NOT NULL,
  `AmPmName` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ampm`
--

INSERT INTO `ampm` (`AmPmID`, `AmPmName`) VALUES
(1, 'AM'),
(2, 'PM');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `AttendID` int(11) NOT NULL,
  `StudID` varchar(50) NOT NULL,
  `EventID` int(11) NOT NULL,
  `AttendTime` time NOT NULL,
  `TimeInOutID` int(11) NOT NULL,
  `AmPmID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`AttendID`, `StudID`, `EventID`, `AttendTime`, `TimeInOutID`, `AmPmID`) VALUES
(1, '14-04194', 5, '17:01:29', 1, 1),
(2, '14-04194', 5, '17:10:34', 2, 1),
(3, '14-04194', 5, '17:10:44', 1, 2),
(4, '14-04194', 5, '17:10:55', 2, 2),
(6, '14-00100', 5, '17:25:10', 1, 1),
(10, '14-00104', 5, '18:42:15', 1, 1),
(16, '14-00104', 5, '19:57:10', 2, 1),
(18, '14-00104', 5, '20:02:09', 1, 2),
(19, '14-00110', 5, '20:04:16', 2, 1),
(20, '14-00110', 5, '20:05:06', 1, 1),
(24, '14-00106', 5, '20:14:41', 1, 1),
(25, '14-00106', 5, '20:16:38', 1, 2),
(27, '14-00110', 5, '20:19:37', 1, 2),
(28, '14-00108', 5, '07:36:56', 1, 1),
(29, '14-00110', 5, '07:37:25', 2, 2),
(30, '15-16207', 5, '10:28:58', 1, 1),
(31, '15-16207', 5, '10:29:29', 2, 1),
(32, '15-16207', 5, '10:29:45', 1, 2),
(34, '14-06056', 5, '15:40:35', 1, 1),
(35, '14-06056', 5, '15:41:11', 2, 1),
(38, '14-06057', 5, '16:55:48', 1, 1),
(39, '14-06057', 5, '16:56:46', 2, 1),
(41, '14-04194', 6, '09:38:43', 1, 1),
(42, '14-04194', 6, '10:08:33', 2, 1),
(43, '14-04194', 6, '10:12:19', 1, 2),
(45, '14-04194', 6, '10:17:06', 2, 2),
(47, '14-04194', 7, '19:01:19', 2, 1),
(48, '15-16207', 6, '19:08:27', 1, 1),
(49, '15-16207', 6, '19:09:58', 2, 1),
(50, '14-04194', 7, '19:13:06', 1, 2),
(53, '14-00104', 6, '19:21:21', 1, 1),
(54, '15-16207', 6, '19:29:12', 1, 2),
(55, '14-06057', 6, '04:49:04', 1, 1),
(57, '14-04194', 7, '19:32:48', 2, 2),
(58, '14-04194', 7, '19:33:18', 1, 1),
(59, '15-16207', 7, '03:49:38', 1, 1),
(60, '15-16207', 7, '03:49:44', 2, 1),
(61, '14-10101', 7, '19:40:37', 1, 1),
(62, '14-00010', 6, '20:03:04', 1, 1),
(63, '14-00010', 6, '20:03:15', 2, 1),
(64, '14-00011', 6, '20:03:41', 1, 1),
(65, '14-10101', 6, '20:05:01', 1, 1),
(66, '14-10101', 6, '20:05:18', 2, 1),
(67, '14-00108', 6, '20:50:59', 1, 1),
(68, '14-00110', 6, '20:51:36', 1, 1),
(69, '14-00110', 6, '20:51:55', 2, 1),
(70, '14-00108', 6, '20:52:16', 2, 1),
(71, '14-00010', 5, '06:09:09', 1, 1),
(72, '14-00011', 5, '06:09:23', 1, 1),
(73, '14-00012', 5, '06:09:36', 1, 1),
(74, '14-00012', 6, '06:55:44', 1, 1),
(75, '14-00012', 6, '07:03:17', 2, 1),
(76, '14-00013', 5, '08:17:33', 1, 1),
(77, '14-00013', 5, '08:17:43', 2, 1),
(78, '14-10101', 5, '08:19:17', 1, 1),
(79, '14-06056', 7, '06:36:26', 1, 1),
(80, '14-06056', 6, '06:38:30', 1, 1),
(81, '14-00014', 6, '06:39:04', 1, 1),
(82, '14-00014', 7, '12:10:38', 1, 1),
(83, '14-00013', 7, '12:11:22', 1, 1),
(84, '14-00018', 5, '06:58:42', 1, 1),
(85, '14-00020', 5, '08:34:02', 1, 1),
(86, '14-00020', 5, '08:34:35', 2, 1),
(87, '14-04194', 8, '16:42:59', 1, 1),
(88, '14-00020', 5, '11:36:43', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `CourseID` int(11) NOT NULL,
  `CourseName` varchar(50) NOT NULL,
  `DeptID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`CourseID`, `CourseName`, `DeptID`) VALUES
(1, 'BS Computer Science', 1),
(2, 'BS Information Technology', 1),
(15, 'BS Information Technology - Animation', 1),
(20, 'BS Civil Engineering', 2),
(21, 'BS Chemical Engineering', 2),
(22, 'BS Electronic Engineering', 2),
(23, 'BS Biology', 3),
(24, 'AB Mass Communication', 3),
(25, 'BS Psychology', 3);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `DeptID` int(11) NOT NULL,
  `DeptName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`DeptID`, `DeptName`) VALUES
(1, 'College of Information and Computing Sciences'),
(2, 'College of Engineering'),
(3, 'College of Arts and Sciences');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `EventID` int(11) NOT NULL,
  `EventName` varchar(50) NOT NULL,
  `Venue` varchar(50) NOT NULL,
  `Date` date NOT NULL,
  `NumAttendee` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`EventID`, `EventName`, `Venue`, `Date`, `NumAttendee`) VALUES
(5, 'IT Uniwide', 'CSU Red Eagle Gymnasium', '2017-04-25', 300),
(6, 'College Days', 'CICS Grounds', '2017-05-31', 500),
(7, 'Clean and Green', 'CSU Fields', '2017-05-31', 500),
(8, 'Team Building', 'Santa Ana, Cagayan', '2017-06-30', 500);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `UserID` int(11) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `AccTypeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`UserID`, `UserName`, `Password`, `AccTypeID`) VALUES
(1, 'omaresguerra', '12345', 1),
(2, 'esguerraomar', '54321', 2),
(3, 'omar@yahoo.com', '56789', 1),
(4, 'esguerraomar@gmail.com', '98765', 2),
(5, 'omar', 'ramo', 2),
(6, 'nicoleann', '10001', 1),
(7, 'omar', 'omar23', 2);

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `SectionID` int(11) NOT NULL,
  `SectionName` varchar(20) NOT NULL,
  `CourseID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`SectionID`, `SectionName`, `CourseID`) VALUES
(1, 'BS-Psych 3A', 25),
(3, 'BSCS 4A', 1),
(4, 'BSIT 2A', 2),
(7, 'BSIT 3A', 2),
(8, 'BSIT 4A', 2),
(9, 'BSIT-ANIM 2A', 15),
(10, 'BSIT-ANIM 3A', 15),
(12, 'BSCS 3A', 1),
(13, 'BSIT-ANIM 4A', 15),
(14, 'BSCE 2A', 20),
(15, 'BSCE 3A', 20),
(16, 'BSCE 4A', 20),
(17, 'BS-Chem 2A', 21),
(18, 'BS-Chem 3A', 21),
(19, 'BSEE 2A', 22),
(20, 'BSEE 3A', 22),
(21, 'BS-Bio 4A', 23),
(25, 'BS-Psych 4A', 25),
(26, 'BS-Bio 3A', 23),
(27, 'ABMC 4A', 24),
(28, 'ABMC 3A', 24);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `StudID` varchar(50) NOT NULL,
  `StudName` varchar(50) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `CourseID` int(11) NOT NULL,
  `SectionID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`StudID`, `StudName`, `Address`, `CourseID`, `SectionID`) VALUES
('14-00010', 'Cordon, Ma. Elena', 'Solana, Cagayan', 20, 16),
('14-00011', 'Lorenzo, Carvin', 'Baggao, Cagayan', 21, 18),
('14-00012', 'Saguid, Benjamin', 'Baggao, Cagayan', 20, 14),
('14-00013', 'Somblingo, John Mikko', 'Caritan Centro, Tuguegarao City', 23, 21),
('14-00014', 'Cabauatan, Floriann', 'Penablanca, Cagayan', 1, 12),
('14-00015', 'Baloran, Ramon', 'Baggao, Cagayan', 1, 12),
('14-00016', 'Accad, Geoff Carl', 'Enrile, Cagayan', 21, 18),
('14-00017', 'Verzola, George Christian', 'Aparri, Cagayan', 2, 7),
('14-00018', 'Sibaluca, Jordan', 'Penablanca, Cagayan', 25, 25),
('14-00020', 'Saturno, Wilcar', 'Tuguegarao City, Cagayan', 24, 27),
('14-00021', 'Pico, Vaughn', 'Tuguegarao City, Cagayan', 22, 20),
('14-00100', 'Carpio, Roger Jr. Pareja', 'Ugac Norte, Tuguegarao City, Cagayan', 1, 3),
('14-00104', 'Carayugan, Ma. Elena', 'Penablanca, Cagayan', 2, 4),
('14-00106', 'Boydon, Keicee', 'Balzain, Tuguegarao City', 2, 7),
('14-00108', 'Maquera, Patrick Jay', 'Carig Sur, Tuguegarao City', 15, 9),
('14-00110', 'Maribbay, Joseph Jr. V.', 'Pengue-Ruyu, Tuguegarao City', 15, 10),
('14-04194', 'Esguerra, John Omar D.', 'Antagan 1, Tumauini, Isabela', 1, 3),
('14-06056', 'Lacambra, Kimberly Rose L.', 'Atulayan Sur, Tuguegarao City', 1, 12),
('14-06057', 'Padua, Ailyn Joy C. ', 'Catagaman Nuevo, Tuguegarao City', 2, 8),
('14-10101', 'Bermijiso, Robert', 'Alcala, Cagayan', 20, 16),
('15-16207', 'Naval, Nicole-Anne V.', 'Pengue-Ruyu, Tuguegarao City', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `timeinout`
--

CREATE TABLE `timeinout` (
  `TimeInOutID` int(11) NOT NULL,
  `TimeInOutName` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timeinout`
--

INSERT INTO `timeinout` (`TimeInOutID`, `TimeInOutName`) VALUES
(1, 'IN'),
(2, 'OUT');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounttype`
--
ALTER TABLE `accounttype`
  ADD PRIMARY KEY (`AccTypeID`);

--
-- Indexes for table `ampm`
--
ALTER TABLE `ampm`
  ADD PRIMARY KEY (`AmPmID`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`AttendID`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`CourseID`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`DeptID`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`EventID`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`SectionID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`StudID`);

--
-- Indexes for table `timeinout`
--
ALTER TABLE `timeinout`
  ADD PRIMARY KEY (`TimeInOutID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounttype`
--
ALTER TABLE `accounttype`
  MODIFY `AccTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ampm`
--
ALTER TABLE `ampm`
  MODIFY `AmPmID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `AttendID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;
--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `CourseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `DeptID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `EventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `SectionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `timeinout`
--
ALTER TABLE `timeinout`
  MODIFY `TimeInOutID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
