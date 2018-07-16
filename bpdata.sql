-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2018 at 04:08 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bp_monitor`
--

-- --------------------------------------------------------

--
-- Table structure for table `bpdata`
--

CREATE TABLE `bpdata` (
  `id` int(10) UNSIGNED NOT NULL,
  `client` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `systolic` int(11) NOT NULL,
  `diastolic` int(11) NOT NULL,
  `pulse` int(11) DEFAULT NULL,
  `notes` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bpdata`
--

INSERT INTO `bpdata` (`id`, `client`, `date`, `time`, `systolic`, `diastolic`, `pulse`, `notes`) VALUES
(1, 1, '2018-01-26', '16:14:00', 183, 98, 0, ''),
(2, 1, '2018-01-27', '14:37:00', 178, 95, 0, ''),
(3, 1, '2018-01-28', '13:17:00', 164, 100, 0, ''),
(4, 1, '2018-01-29', '20:55:00', 161, 98, 0, ''),
(5, 1, '2018-01-30', '16:38:00', 165, 86, 0, ''),
(6, 1, '2018-01-31', '16:11:00', 175, 105, 0, ''),
(9, 1, '2018-02-01', '18:10:00', 161, 96, 0, 'Began taking Lisinopril 12.5 mg'),
(10, 1, '2018-02-02', '17:13:00', 156, 90, 0, ''),
(11, 1, '2018-02-03', '12:48:00', 148, 87, 0, ''),
(12, 1, '2018-02-04', '15:40:00', 131, 84, 0, ''),
(13, 1, '2018-02-05', '12:28:00', 120, 80, 0, ''),
(14, 1, '2018-02-06', '11:50:00', 131, 78, 76, 'Started recording pulse'),
(15, 1, '2018-02-07', '12:48:00', 138, 86, 74, ''),
(16, 1, '2018-02-08', '14:57:00', 144, 87, 79, ''),
(17, 1, '2018-02-09', '18:52:00', 138, 82, 78, ''),
(18, 1, '2018-02-10', '15:08:00', 141, 83, 79, ''),
(19, 1, '2018-02-11', '15:40:00', 142, 79, 79, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bpdata`
--
ALTER TABLE `bpdata`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bpdata`
--
ALTER TABLE `bpdata`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
