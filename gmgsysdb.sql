-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 06, 2024 at 12:52 PM
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
-- Database: `gmgsysdb`
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
  `admincode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adminacc_detail`
--

INSERT INTO `adminacc_detail` (`adminid`, `username`, `password`, `email`, `admincode`) VALUES
(1, 'admin', '$2y$10$TARKjgFY7y/YYRr9v2D15.VBUAgVasoaTlczUvdvgL.IPveJWC4Mu', 'jearziad@gmail.com', 'ED6LW8'),
(2, 'RomellDiaz', '$2y$10$ErgxWbTeAfiiMBDmOS91H.OOVVoKSZdyY0zVyDCs886vnbId89sMy', 'jearziad@gmail.com', 'W3MZN2');

-- --------------------------------------------------------

--
-- Table structure for table `collection_data`
--

CREATE TABLE `collection_data` (
  `collectionid` int(10) UNSIGNED NOT NULL,
  `request_id` int(11) NOT NULL,
  `weight` decimal(8,2) NOT NULL,
  `notes` text DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `collection_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `collection_data`
--

INSERT INTO `collection_data` (`collectionid`, `request_id`, `weight`, `notes`, `username`, `collection_date`) VALUES
(24, 1, 45.42, 'Very Nice', 'admin', '2024-12-06 06:54:37'),
(25, 1, 12.00, 'Test', 'RomellDiaz', '2024-12-06 06:59:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_detail`
--

CREATE TABLE `user_detail` (
  `request_id` int(11) NOT NULL,
  `user_fullname` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_phonenumber` varchar(11) NOT NULL,
  `garbage_type` varchar(255) NOT NULL,
  `request_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_detail`
--

INSERT INTO `user_detail` (`request_id`, `user_fullname`, `user_address`, `user_phonenumber`, `garbage_type`, `request_date`) VALUES
(1, 'John Romell Diaz', 'Sampaguita Homes Lipa City', '09471098936', 'Recyclables, Toxic Waste', '2024-12-06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminacc_detail`
--
ALTER TABLE `adminacc_detail`
  ADD PRIMARY KEY (`adminid`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `collection_data`
--
ALTER TABLE `collection_data`
  ADD PRIMARY KEY (`collectionid`),
  ADD KEY `collection_data_ibfk_1` (`request_id`),
  ADD KEY `collection_data_username_foreign` (`username`);

--
-- Indexes for table `user_detail`
--
ALTER TABLE `user_detail`
  ADD PRIMARY KEY (`request_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminacc_detail`
--
ALTER TABLE `adminacc_detail`
  MODIFY `adminid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `collection_data`
--
ALTER TABLE `collection_data`
  MODIFY `collectionid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user_detail`
--
ALTER TABLE `user_detail`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `collection_data`
--
ALTER TABLE `collection_data`
  ADD CONSTRAINT `collection_data_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `user_detail` (`request_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `collection_data_username_foreign` FOREIGN KEY (`username`) REFERENCES `adminacc_detail` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
