-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2024 at 07:43 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `food_request_details_master`
--

CREATE TABLE `food_request_details_master` (
  `id` int(11) NOT NULL,
  `frId` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `peopleCount` int(11) NOT NULL,
  `unit` enum('kg','ton') DEFAULT NULL,
  `madeOn` timestamp NULL DEFAULT NULL,
  `expireOn` timestamp NULL DEFAULT NULL,
  `description` text DEFAULT NULL,
  `category` enum('0','1') DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `updatedBy` int(11) NOT NULL,
  `updatedOn` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `enabled` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food_request_details_master`
--

INSERT INTO `food_request_details_master` (`id`, `frId`, `name`, `quantity`, `peopleCount`, `unit`, `madeOn`, `expireOn`, `description`, `category`, `price`, `address`, `updatedBy`, `updatedOn`, `enabled`) VALUES
(1, 1, 'ajdns', NULL, 0, NULL, '2024-01-07 07:47:00', '2024-01-08 07:47:00', 'asdsa', '1', NULL, 'asdas', 1, '2024-01-07 07:49:21', '1'),
(2, 2, 'Gahu', 10, 0, 'kg', '2024-01-06 18:30:00', NULL, 'Chan', NULL, 300, 'Nashik', 2, '2024-01-07 07:52:53', '1'),
(3, 3, 'Shahi Paneed', NULL, 0, NULL, '2024-04-23 14:50:00', '2024-04-24 11:30:00', 'Chan', '1', NULL, 'Nashik', 1, '2024-01-07 07:58:06', '1'),
(4, 4, 'Biryani', NULL, 0, NULL, '2024-01-07 16:14:00', '2024-01-07 19:30:00', 'Rice biryani', '1', NULL, 'Nashik', 4, '2024-01-07 09:15:37', '1'),
(5, 5, 'Raita', NULL, 0, NULL, '2024-01-07 16:00:00', '2024-01-07 18:20:00', 'Masala added', '1', NULL, 'Nashik', 4, '2024-01-07 09:17:54', '1'),
(6, 6, 'Rice', 100, 0, 'kg', '2024-01-06 18:30:00', NULL, 'Basmati rice', NULL, 50000, 'Thane', 6, '2024-01-07 09:21:03', '1'),
(7, 7, 'Mung Dal', 50, 0, 'kg', '2024-01-06 18:30:00', NULL, 'NA', NULL, 20000, 'Thane', 6, '2024-01-07 09:21:42', '1'),
(8, 8, 'Biryani', NULL, 0, NULL, '2024-01-07 09:30:00', '2024-01-07 12:30:00', 'Masala Added', '1', NULL, 'Nashik', 7, '2024-01-07 09:37:55', '1'),
(9, 9, 'Nuts', 100, 0, 'kg', '2024-01-06 18:30:00', NULL, 'NA', NULL, 100000, 'Thane', 8, '2024-01-07 09:40:24', '1'),
(10, 10, 'kjdsfn', NULL, 0, NULL, '2024-01-15 16:52:00', '2024-01-15 17:53:00', 'klsdnf', '0', NULL, 'kasjd', 7, '2024-01-17 18:21:55', '0'),
(11, 11, 'kjdsfn', NULL, 0, NULL, '2024-01-15 16:52:00', '2024-01-15 17:53:00', 'klsdnf', '0', NULL, 'kasjd', 7, '2024-01-17 18:22:00', '0'),
(12, 12, 'kjdsfn', NULL, 0, NULL, '2024-01-15 16:52:00', '2024-01-15 17:53:00', 'klsdnf', '0', NULL, 'kasjd', 7, '2024-01-17 18:22:06', '0'),
(13, 13, 'kjdsfn', NULL, 0, NULL, '2024-01-15 16:52:00', '2024-01-15 17:53:00', 'klsdnf', '0', NULL, 'kasjd', 7, '2024-01-17 18:22:08', '0'),
(14, 14, 'kjdsfn', NULL, 0, NULL, '2024-01-15 16:52:00', '2024-01-15 17:53:00', 'klsdnf', '0', NULL, 'kasjd', 7, '2024-01-17 18:22:10', '0'),
(15, 15, 'kjdsfn', NULL, 0, NULL, '2024-01-15 16:52:00', '2024-01-15 17:53:00', 'klsdnf', '0', NULL, 'kasjd', 7, '2024-01-17 18:22:13', '0'),
(16, 16, 'kjdsfn', NULL, 0, NULL, '2024-01-15 16:52:00', '2024-01-15 17:53:00', 'klsdnf', '0', NULL, 'kasjd', 7, '2024-01-17 18:22:15', '0'),
(17, 17, 'Dudh', NULL, 3, NULL, '2024-01-17 18:12:00', '2024-01-16 23:13:00', 'asd', '0', NULL, 'sdsd', 7, '2024-01-17 18:13:21', '1'),
(18, 18, 'Dahi', NULL, 2, NULL, '2024-01-17 18:22:00', '2024-01-16 23:22:00', 'sdf', '0', NULL, 'asd', 7, '2024-01-17 18:22:47', '1'),
(19, 19, 'Dahi', NULL, 2, NULL, '2024-01-17 18:22:00', '2024-01-16 23:22:00', 'sdf', '0', NULL, 'asd', 7, '2024-01-17 18:23:23', '1'),
(20, 20, 'Dahi', NULL, 2, NULL, '2024-01-17 18:22:00', '2024-01-16 23:22:00', 'sdf', '0', NULL, 'asd', 7, '2024-01-17 18:23:40', '1'),
(21, 21, 'sakjsd', NULL, 1, NULL, '2024-01-17 19:33:00', '2024-01-18 00:37:00', 'NA', '0', NULL, 'NA', 7, '2024-01-17 19:37:33', '1');

-- --------------------------------------------------------

--
-- Table structure for table `food_request_document_master`
--

CREATE TABLE `food_request_document_master` (
  `id` int(11) NOT NULL,
  `frId` int(11) NOT NULL,
  `docPath` varchar(255) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `createdOn` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedBy` int(11) NOT NULL,
  `updatedOn` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `enabled` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food_request_document_master`
--

INSERT INTO `food_request_document_master` (`id`, `frId`, `docPath`, `createdBy`, `createdOn`, `updatedBy`, `updatedOn`, `enabled`) VALUES
(1, 1, './assets/images/uploads/food/banner1.jpeg', 1, '2024-01-07 07:49:21', 1, '2024-01-07 07:49:21', '1'),
(2, 1, './assets/images/uploads/food/banner2.jpeg', 1, '2024-01-07 07:49:21', 1, '2024-01-07 07:49:21', '1'),
(3, 2, './assets/images/uploads/crop/banner1.jpeg', 2, '2024-01-07 07:52:53', 2, '2024-01-07 07:52:53', '1'),
(4, 2, './assets/images/uploads/crop/banner2.jpeg', 2, '2024-01-07 07:52:53', 2, '2024-01-07 07:52:53', '1'),
(5, 3, './assets/images/uploads/food/avatar_male.png', 1, '2024-01-07 07:58:06', 1, '2024-01-07 07:58:06', '1'),
(6, 3, './assets/images/uploads/food/avatar_female.png', 1, '2024-01-07 07:58:06', 1, '2024-01-07 07:58:06', '1'),
(7, 4, './assets/images/uploads/food/Matrimony Brand Logo.png', 4, '2024-01-07 09:15:37', 4, '2024-01-07 09:15:37', '1'),
(8, 4, './assets/images/uploads/food/QR Code.png', 4, '2024-01-07 09:15:37', 4, '2024-01-07 09:15:37', '1'),
(9, 5, './assets/images/uploads/food/393433.png', 4, '2024-01-07 09:17:54', 4, '2024-01-07 09:17:54', '1'),
(10, 6, './assets/images/uploads/crop/banner1 - Copy.jpeg', 6, '2024-01-07 09:21:03', 6, '2024-01-07 09:21:03', '1'),
(11, 7, './assets/images/uploads/crop/banner2 - Copy.jpeg', 6, '2024-01-07 09:21:42', 6, '2024-01-07 09:21:42', '1'),
(12, 8, './assets/images/uploads/food/banner3 - Copy.jpeg', 7, '2024-01-07 09:37:55', 7, '2024-01-07 09:37:55', '1'),
(13, 9, './assets/images/uploads/crop/Matrimony Brand Logo - Copy.png', 8, '2024-01-07 09:40:24', 8, '2024-01-07 09:40:24', '1');

-- --------------------------------------------------------

--
-- Table structure for table `food_request_master`
--

CREATE TABLE `food_request_master` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `isFoodOrCrop` enum('0','1') DEFAULT NULL,
  `isPicked` enum('0','1') DEFAULT NULL,
  `pickedBy` int(11) DEFAULT NULL,
  `isDelivered` enum('0','1') NOT NULL DEFAULT '0',
  `createdBy` int(11) NOT NULL,
  `createdOn` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedBy` int(11) NOT NULL,
  `updatedOn` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `enabled` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food_request_master`
--

INSERT INTO `food_request_master` (`id`, `uid`, `isFoodOrCrop`, `isPicked`, `pickedBy`, `isDelivered`, `createdBy`, `createdOn`, `updatedBy`, `updatedOn`, `enabled`) VALUES
(1, 1, '0', NULL, NULL, '0', 1, '2024-01-07 07:49:21', 1, '2024-01-07 07:49:21', '1'),
(2, 2, '1', '1', 3, '0', 2, '2024-01-07 07:52:53', 2, '2024-01-07 07:54:05', '1'),
(3, 1, '0', '1', 3, '0', 1, '2024-01-07 07:58:06', 1, '2024-01-07 07:58:38', '1'),
(4, 4, '0', '1', 9, '1', 4, '2024-01-07 09:15:37', 4, '2024-01-07 10:11:17', '1'),
(5, 4, '0', NULL, NULL, '0', 4, '2024-01-07 09:17:54', 4, '2024-01-07 09:17:54', '1'),
(6, 6, '1', '1', 9, '0', 6, '2024-01-07 09:21:03', 6, '2024-01-07 09:42:03', '1'),
(7, 6, '1', NULL, NULL, '0', 6, '2024-01-07 09:21:42', 6, '2024-01-07 09:21:42', '1'),
(8, 7, '0', NULL, NULL, '0', 7, '2024-01-07 09:37:55', 7, '2024-01-07 09:37:55', '1'),
(9, 8, '1', NULL, NULL, '0', 8, '2024-01-07 09:40:24', 8, '2024-01-07 09:40:24', '1'),
(10, 7, '0', NULL, NULL, '0', 7, '2024-01-15 16:57:20', 7, '2024-01-17 18:21:55', '0'),
(11, 7, '0', NULL, NULL, '0', 7, '2024-01-15 16:59:05', 7, '2024-01-17 18:22:00', '0'),
(12, 7, '0', NULL, NULL, '0', 7, '2024-01-15 16:59:45', 7, '2024-01-17 18:22:06', '0'),
(13, 7, '0', NULL, NULL, '0', 7, '2024-01-15 16:59:52', 7, '2024-01-17 18:22:08', '0'),
(14, 7, '0', NULL, NULL, '0', 7, '2024-01-15 17:00:05', 7, '2024-01-17 18:22:10', '0'),
(15, 7, '0', NULL, NULL, '0', 7, '2024-01-15 17:01:09', 7, '2024-01-17 18:22:13', '0'),
(16, 7, '0', NULL, NULL, '0', 7, '2024-01-15 17:01:30', 7, '2024-01-17 18:22:15', '0'),
(17, 7, '0', NULL, NULL, '0', 7, '2024-01-17 18:13:21', 7, '2024-01-17 18:13:21', '1'),
(18, 7, '0', NULL, NULL, '0', 7, '2024-01-17 18:22:47', 7, '2024-01-17 18:22:47', '1'),
(19, 7, '0', NULL, NULL, '0', 7, '2024-01-17 18:23:23', 7, '2024-01-17 18:23:23', '1'),
(20, 7, '0', NULL, NULL, '0', 7, '2024-01-17 18:23:40', 7, '2024-01-17 18:23:40', '1'),
(21, 7, '0', NULL, NULL, '0', 7, '2024-01-17 19:37:33', 7, '2024-01-17 19:37:33', '1');

-- --------------------------------------------------------

--
-- Table structure for table `food_request_rejected_master`
--

CREATE TABLE `food_request_rejected_master` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `requestId` int(11) NOT NULL,
  `createdOn` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food_request_rejected_master`
--

INSERT INTO `food_request_rejected_master` (`id`, `userId`, `requestId`, `createdOn`) VALUES
(1, 3, 1, '2024-01-07 07:53:53');

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE `user_master` (
  `id` int(11) NOT NULL,
  `category` enum('0','1','2') NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phoneNumber` varchar(121) NOT NULL,
  `password` varchar(100) NOT NULL,
  `addressLine1` varchar(255) NOT NULL,
  `addressLine2` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `createdOn` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedBy` int(11) NOT NULL,
  `updatedOn` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `enabled` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`id`, `category`, `firstName`, `lastname`, `email`, `phoneNumber`, `password`, `addressLine1`, `addressLine2`, `city`, `pincode`, `createdBy`, `createdOn`, `updatedBy`, `updatedOn`, `enabled`) VALUES
(1, '1', 'Bhushan', 'Chaudhari', 'bhusha@gmail.com', '1234567890', '123', 'Nashik', '', 'Nahsik', '422003', 0, '2024-01-07 07:40:19', 0, '2024-01-07 07:40:19', '1'),
(2, '2', 'Atharva', 'Ghotya', 'athya@gmail.com', '1234567890', '123', 'Nahsik', '', 'Nashik', '422003', 0, '2024-01-07 07:51:44', 0, '2024-01-07 07:51:44', '1'),
(3, '0', 'swadaan', 'foundation', 'swadaan@gmail.com', '1234567890', '123', 'Nashik', 'N', 'Nashik', '422009', 0, '2024-01-07 07:53:34', 0, '2024-01-17 20:01:57', '1'),
(4, '1', 'Food', 'User', 'fooduser@gmail.com', '1234567890', '123', 'Nashik', '', 'Nashik', '422003', 0, '2024-01-07 09:13:44', 0, '2024-01-07 09:13:44', '1'),
(5, '0', 'seva', 'foundation', 'seva@ngo.com', '1234567890', '123', 'Pune', '', 'Pune', '411057', 0, '2024-01-07 09:18:39', 0, '2024-01-07 09:18:39', '1'),
(6, '2', 'Farmer', 'User', 'farmeruser@gmail.com', '1234567890', '123', 'Thane', '', 'Mumbai', '123456', 0, '2024-01-07 09:19:58', 0, '2024-01-07 09:19:58', '1'),
(7, '1', 'Food', 'User', 'food@user.com', '0987654321', '123', 'Nashik', '', 'Nashik', '422004', 0, '2024-01-07 09:36:47', 0, '2024-01-07 09:36:47', '1'),
(8, '2', 'Farmer', 'User', 'farmer@user.com', '0987654321', '123', 'Thane', '', 'Mumbai', '124562', 0, '2024-01-07 09:39:19', 0, '2024-01-07 09:39:19', '1'),
(9, '0', 'Sevabhavi', 'Foundation', 'seva1@ngo.com', '1234567890', '123', 'Aurangabad', '', 'Aurangabad', '123456', 0, '2024-01-07 09:41:25', 0, '2024-01-07 09:41:25', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `food_request_details_master`
--
ALTER TABLE `food_request_details_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_request_document_master`
--
ALTER TABLE `food_request_document_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_request_master`
--
ALTER TABLE `food_request_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_request_rejected_master`
--
ALTER TABLE `food_request_rejected_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_master`
--
ALTER TABLE `user_master`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `food_request_details_master`
--
ALTER TABLE `food_request_details_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `food_request_document_master`
--
ALTER TABLE `food_request_document_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `food_request_master`
--
ALTER TABLE `food_request_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `food_request_rejected_master`
--
ALTER TABLE `food_request_rejected_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_master`
--
ALTER TABLE `user_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
