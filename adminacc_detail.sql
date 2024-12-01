-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 01, 2024 at 10:00 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grabmygarbagedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminacc_detail`
--

CREATE TABLE `adminacc_detail` (
  `adminid` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `admincode` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adminacc_detail`
--

INSERT INTO `adminacc_detail` (`adminid`, `username`, `password`, `email`, `admincode`) VALUES
(12, 'admindev', '$2y$10$6Eygf6GmXijH8Ti2jmr0ZeX5Gye4HEv2BSYwh42XhMLaTHJNxG89m', 'admin@gmail.com', 'U7MHNW'),
(13, 'adminromell', '$2y$10$0CTWs62r1Pv3QUBaM/P.YeQYrXPAwt8PB/.WhA08lZBVvn784/Pn.', 'admintest@gmail.com', 'RQGS5C'),
(26, 'JROMEEEE', '$2y$10$aYoCDjfLpPHjZRWmjOrPKOMmXvru5x6dNkBT4wWBZIWtETikux4lG', 'ziadjiar@gmail.com', 'K41QIW'),
(27, 'ADMINTESTING', '$2y$10$qbdgwHAJjiSasyQiIA99LO7zSJsSYcEAXrKWqgRT2DJd1mGLx4Cai', 'jromell099@gmail.com', '28KZ7Y'),
(28, 'jearziad', '$2y$10$NEDISLdKvUqa3L/PkhF0cuf0dFRkFkUsoS6mZwd0wpgDq0GT8lGCS', 'ziadjiar@gmail.com', '80KPDJ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminacc_detail`
--
ALTER TABLE `adminacc_detail`
  ADD PRIMARY KEY (`adminid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminacc_detail`
--
ALTER TABLE `adminacc_detail`
  MODIFY `adminid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
