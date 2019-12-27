-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2017 at 04:37 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trust`
--

-- --------------------------------------------------------

--
-- Table structure for table `gen_districts`
--

CREATE TABLE `gen_districts` (
  `district_id` int(11) NOT NULL,
  `district_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gen_identification_types`
--

CREATE TABLE `gen_identification_types` (
  `id_type_id` int(11) NOT NULL,
  `id_type_name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sec_users`
--

--
-- Dumping data for table `sec_users`
--

INSERT INTO `sec_users` (`user_id`, `username`, `password`, `is_active`, `active_from`, `active_to`, `created_on`, `created_by`, `is_updated`, `updated_by`, `updated_on`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', 1, '2017-05-30', '2017-06-08', '0000-00-00 00:00:00', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gen_districts`
--
ALTER TABLE `gen_districts`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `gen_identification_types`
--
ALTER TABLE `gen_identification_types`
  ADD PRIMARY KEY (`id_type_id`);

--
-- Indexes for table `sec_users`
--
ALTER TABLE `sec_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gen_districts`
--
ALTER TABLE `gen_districts`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gen_identification_types`
--
ALTER TABLE `gen_identification_types`
  MODIFY `id_type_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sec_users`
--
ALTER TABLE `sec_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
