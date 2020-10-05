-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2020 at 05:26 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE
= "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT
= 0;
START TRANSACTION;
SET time_zone
= "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_healthcare`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment`
(
  `appId` int
(3) NOT NULL,
  `patientIc` bigint
(12) NOT NULL,
  `scheduleId` int
(10) NOT NULL,
  `appSymptom` varchar
(100) NOT NULL,
  `appComment` varchar
(100) NOT NULL,
  `status` varchar
(10) NOT NULL DEFAULT 'process'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`
appId`,
`patientIc
`, `scheduleId`, `appSymptom`, `appComment`, `status`) VALUES
(86, 920517105553, 40, 'Pening Kepala', 'Bila doktor free?', 'done');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor`
(
  `idAdmin` bigint
(12) NOT NULL,
  `password` varchar
(20) NOT NULL,
  `adminId` int
(3) NOT NULL,
  `doctorFirstName` varchar
(50) NOT NULL,
  `doctorEmail` varchar
(20) NOT NULL,
  `doctorDOB` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctorschedule`
--

CREATE TABLE `doctorschedule`
(
  `scheduleId` int
(11) NOT NULL,
  `scheduleDate` date NOT NULL,
  `scheduleDay` varchar
(15) NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  `bookAvail` varchar
(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctorschedule`
--

INSERT INTO `doctorschedule` (`
scheduleId`,
`scheduleDate
`, `scheduleDay`, `startTime`, `endTime`, `bookAvail`) VALUES
(40, '2015-12-13', 'Sunday', '09:00:00', '10:00:00', 'notavail'),
(41, '2015-12-13', 'Sunday', '10:00:00', '11:00:00', 'available'),
(42, '2015-12-13', 'Sunday', '11:00:00', '12:00:00', 'available'),
(43, '2015-12-14', 'Monday', '11:00:00', '12:00:00', 'available'),
(44, '2015-12-13', 'Sunday', '01:00:00', '02:00:00', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient`
(
  `idUser` bigint
(12) NOT NULL,
  `password` varchar
(20) NOT NULL,
  `userFirstName` varchar
(20) NOT NULL,
  `userLastName` varchar
(20) NOT NULL,
  `userDOB` date NOT NULL,
  `userGender` varchar
(10) NOT NULL,
  `userAddress` varchar
(100) NOT NULL,
  `userPhone` varchar
(15) NOT NULL,
  `userEmail` varchar
(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`
idUser`,
`password
`, `userFirstName`, `userLastName`, `userDOB`, `userGender`, `userAddress`, `userPhone`, `userEmail`) VALUES
(920517105553, '123', 'Mohd', 'Mazlan', 'single', '1992-05-17', 'male', 'NO 153 BLOK MURNI\r\nKOLEJ CANSELOR UNIVERSITI PUTRA MALAYSIA', '173567758', 'lan.psis@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
ADD PRIMARY KEY
(`appId`),
ADD UNIQUE KEY `scheduleId_2`
(`scheduleId`),
ADD KEY `patientIc`
(`patientIc`),
ADD KEY `scheduleId`
(`scheduleId`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
ADD PRIMARY KEY
(`idAdmin`);

--
-- Indexes for table `doctorschedule`
--
ALTER TABLE `doctorschedule`
ADD PRIMARY KEY
(`scheduleId`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
ADD PRIMARY KEY
(`idUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appId` int
(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `doctorschedule`
--
ALTER TABLE `doctorschedule`
  MODIFY `scheduleId` int
(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
ADD CONSTRAINT `appointment_ibfk_4` FOREIGN KEY
(`patientIc`) REFERENCES `patient`
(`idUser`),
ADD CONSTRAINT `appointment_ibfk_5` FOREIGN KEY
(`scheduleId`) REFERENCES `doctorschedule`
(`scheduleId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
