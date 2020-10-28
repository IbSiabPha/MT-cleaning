-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2020 at 03:25 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE
= "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone
= "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_cleaning`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment`
(
  `appId` int
(3) NOT NULL,
  `userId` bigint
(12) NOT NULL,
  `scheduleId` int
(10) NOT NULL,
  `needService` varchar
(100) NOT NULL,
  `serviceComment` varchar
(100) NOT NULL,
  `status` varchar
(10) NOT NULL DEFAULT 'process'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appId`, `userId`, `scheduleId`, `needService`, `serviceComment`, `status`) VALUES (88, 1234, 47, 'Garage Cleaning', 'i want my garage cleaned', 'done'), (89, 1234, 48, 'home cleaning', 'clean my agarage', 'done');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `admin1`
(`idAdmin` bigint(12) NOT NULL, `password` varchar(20) NOT NULL, `adminId` int(3) NOT NULL, `adminFirstName` varchar(50) NOT NULL, `adminEmail` varchar(20) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `admin1` (`idAdmin`,`password`, `adminId`, `adminFirstName`, `adminEmail`) VALUES(0, '123', 123, 'Admin', 'admin@mtcleaning.com');

-- --------------------------------------------------------

--
-- Table structure for table `adminschedule`
--

CREATE TABLE `adminschedule`
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
-- Dumping data for table `adminschedule`
--

INSERT INTO `adminschedule` (`scheduleId`,`scheduleDate`, `scheduleDay`, `startTime`, `endTime`, `bookAvail`) VALUES(47, '2020-10-06', '', '00:05:00', '03:10:00', 'notavail'), (48, '2020-10-14', '', '12:00:00', '01:05:00', 'notavail'), (49, '0000-00-00', '', '00:00:00', '00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `client1`
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

INSERT INTO `client1` (`idUser`, `password`, `userFirstName`, `userLastName`, `userDOB`, `userGender`, `userAddress`, `userPhone`, `userEmail`) VALUES
(0, '1234', '', '', '2002-01-22', '', '', '', ''),
(1234, '1', 'ib', 'pha', '1981-01-02', 'male', '', '', 'fake@gmail.com'),
(123456, 'pha', 'ib ', 'pha', '2012-02-01', 'male', '', '', 'wahtever@gmail.com');

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
ADD KEY `userId`
(`userId`),
ADD KEY `scheduleId`
(`scheduleId`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `admin1`
ADD PRIMARY KEY
(`idAdmin`);

--
-- Indexes for table `adminschedule`
--
ALTER TABLE `adminschedule`
ADD PRIMARY KEY
(`scheduleId`);

--
-- Indexes for table `patient`
--
ALTER TABLE `client1`
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
(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `adminschedule`
--
ALTER TABLE `adminschedule`
  MODIFY `scheduleId` int
(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
ADD CONSTRAINT `appointment_ibfk_4` FOREIGN KEY
(`userId`) REFERENCES `client1`
(`idUser`),
ADD CONSTRAINT `appointment_ibfk_5` FOREIGN KEY
(`scheduleId`) REFERENCES `adminschedule`
(`scheduleId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
