-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2025 at 12:44 AM
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
-- Database: `properties_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `admin_id` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `district_id` varchar(50) NOT NULL,
  `Status` enum('Active','Inactive') NOT NULL,
  `created_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`admin_id`, `fullname`, `email`, `password`, `district_id`, `Status`, `created_by`) VALUES
('12345678', 'sarah', 'sarah@gmail.com', 'Emergent@2025', '12567', 'Active', '06798725');

-- --------------------------------------------------------

--
-- Table structure for table `district_table`
--

CREATE TABLE `district_table` (
  `district_id` varchar(50) NOT NULL,
  `district_name` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `district_table`
--

INSERT INTO `district_table` (`district_id`, `district_name`, `created_by`) VALUES
('12567', 'kasoa', '06798725');

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `property_code` varchar(8) NOT NULL,
  `owner_name` varchar(50) NOT NULL,
  `owner_phone_number` varchar(13) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `property_address` varchar(50) NOT NULL,
  `property_type` varchar(20) NOT NULL,
  `property_category` enum('Single Unit','Multi-Unit') NOT NULL,
  `assessment` int(11) DEFAULT NULL,
  `rate` float DEFAULT NULL,
  `amount_owed` decimal(15,2) NOT NULL,
  `amount_paid` decimal(15,2) DEFAULT NULL,
  `payment_status` enum('Paid','Unpaid') NOT NULL DEFAULT 'Unpaid',
  `billing_cycle` enum('Annual','Quarterly') NOT NULL,
  `district_id` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`property_code`, `owner_name`, `owner_phone_number`, `email`, `property_address`, `property_type`, `property_category`, `assessment`, `rate`, `amount_owed`, `amount_paid`, `payment_status`, `billing_cycle`, `district_id`, `created_by`) VALUES
('1256', 'Kofi', '0551718945', 'sarah@gmail.com', ' akjsakjbslksdf', 'jbajkdboflkbf', 'Single Unit', 45607888, 4.5, 1745898400.00, 1223490000.00, 'Paid', 'Annual', '12567', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `superadmin_table`
--

CREATE TABLE `superadmin_table` (
  `superadmin_id` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `superadmin_table`
--

INSERT INTO `superadmin_table` (`superadmin_id`, `password`) VALUES
('06798725', '$2y$10$WGD/2oSKsS/RFKlCSQGFWe.bGMsPAW0Li9gZcFPsbhYT.aKhpfBQy');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_number` varchar(13) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_properties`
--

CREATE TABLE `user_properties` (
  `user_number` varchar(13) NOT NULL,
  `property_code` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `idx_admin_district_id` (`district_id`);

--
-- Indexes for table `district_table`
--
ALTER TABLE `district_table`
  ADD PRIMARY KEY (`district_id`),
  ADD UNIQUE KEY `district_name` (`district_name`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `idx_district_name` (`district_name`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`property_code`),
  ADD KEY `idx_properties_district_id` (`district_id`),
  ADD KEY `idx_properties_owner_name` (`owner_name`),
  ADD KEY `idx_properties_property_address` (`property_address`),
  ADD KEY `idx_properties_created_by` (`created_by`),
  ADD KEY `idx_properties_owner_phone_number` (`owner_phone_number`);

--
-- Indexes for table `superadmin_table`
--
ALTER TABLE `superadmin_table`
  ADD PRIMARY KEY (`superadmin_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_number`),
  ADD UNIQUE KEY `user_number` (`user_number`);

--
-- Indexes for table `user_properties`
--
ALTER TABLE `user_properties`
  ADD PRIMARY KEY (`user_number`,`property_code`),
  ADD KEY `idx_user_properties_user_number` (`user_number`),
  ADD KEY `idx_user_properties_property_code` (`property_code`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD CONSTRAINT `admin_table_ibfk_1` FOREIGN KEY (`district_id`) REFERENCES `district_table` (`district_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `admin_table_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `superadmin_table` (`superadmin_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `district_table`
--
ALTER TABLE `district_table`
  ADD CONSTRAINT `district_table_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `superadmin_table` (`superadmin_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_ibfk_1` FOREIGN KEY (`district_id`) REFERENCES `district_table` (`district_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `properties_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `admin_table` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_properties`
--
ALTER TABLE `user_properties`
  ADD CONSTRAINT `user_properties_ibfk_1` FOREIGN KEY (`user_number`) REFERENCES `users` (`user_number`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_properties_ibfk_2` FOREIGN KEY (`property_code`) REFERENCES `properties` (`property_code`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
