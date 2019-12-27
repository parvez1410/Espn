-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2019 at 02:22 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `espn`
--

-- --------------------------------------------------------

--
-- Table structure for table `api_request`
--

CREATE TABLE `api_request` (
  `request_no` int(11) NOT NULL,
  `request_details` text NOT NULL,
  `user_ip` varchar(100) NOT NULL,
  `request_on` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee_wise_day_bits`
--

CREATE TABLE `employee_wise_day_bits` (
  `EMPLOYEE_WISE_DAY_BIT_NO` int(11) NOT NULL,
  `EMPLOYEE_REG_NO` int(11) NOT NULL,
  `ZONE_NO` int(11) NOT NULL,
  `BIT_NO` int(11) NOT NULL,
  `DAY_NO` int(11) NOT NULL,
  `CREATED_BY` int(11) NOT NULL,
  `CREATED_ON` datetime NOT NULL,
  `IS_DELETED` int(1) NOT NULL DEFAULT 0,
  `DELETED_BY` int(11) NOT NULL,
  `DELETED_ON` datetime NOT NULL,
  `IS_UPDATED` int(1) NOT NULL DEFAULT 0,
  `UPDATED_BY` int(11) NOT NULL,
  `UPDATED_ON` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee_wise_day_bits`
--

INSERT INTO `employee_wise_day_bits` (`EMPLOYEE_WISE_DAY_BIT_NO`, `EMPLOYEE_REG_NO`, `ZONE_NO`, `BIT_NO`, `DAY_NO`, `CREATED_BY`, `CREATED_ON`, `IS_DELETED`, `DELETED_BY`, `DELETED_ON`, `IS_UPDATED`, `UPDATED_BY`, `UPDATED_ON`) VALUES
(1, 3, 2, 1, 1, 1, '2018-06-04 08:11:51', 0, 0, '0000-00-00 00:00:00', 1, 1, '2018-06-04 21:35:27'),
(2, 4, 1, 2, 1, 1, '2018-06-04 09:07:52', 0, 0, '0000-00-00 00:00:00', 1, 1, '2018-06-04 10:46:26'),
(4, 6, 2, 1, 2, 1, '2018-06-04 09:23:45', 0, 0, '0000-00-00 00:00:00', 1, 1, '2018-06-04 10:50:35'),
(5, 1, 1, 2, 1, 1, '2018-06-04 10:45:05', 1, 1, '2018-06-04 18:42:58', 0, 0, '0000-00-00 00:00:00'),
(6, 2, 1, 2, 1, 1, '2018-06-04 10:53:44', 1, 1, '2018-06-04 18:42:34', 0, 0, '0000-00-00 00:00:00'),
(7, 6, 2, 1, 1, 1, '2018-06-04 18:42:58', 0, 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `employee_wise_sales`
--

CREATE TABLE `employee_wise_sales` (
  `EMPLOYEE_WISE_SALE_NO` int(11) NOT NULL,
  `SALES_GROUP_NO` int(11) NOT NULL,
  `EMPLOYEE_REG_NO` varchar(55) NOT NULL,
  `CREATED_BY` int(11) NOT NULL,
  `CREATED_ON` datetime NOT NULL,
  `IS_DELETED` int(1) NOT NULL DEFAULT 0,
  `DELETED_BY` int(11) NOT NULL,
  `DELETED_ON` int(11) NOT NULL,
  `IS_UPDATED` int(1) NOT NULL DEFAULT 0,
  `UPDATED_BY` int(11) NOT NULL,
  `UPDATED_ON` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee_wise_sales`
--

INSERT INTO `employee_wise_sales` (`EMPLOYEE_WISE_SALE_NO`, `SALES_GROUP_NO`, `EMPLOYEE_REG_NO`, `CREATED_BY`, `CREATED_ON`, `IS_DELETED`, `DELETED_BY`, `DELETED_ON`, `IS_UPDATED`, `UPDATED_BY`, `UPDATED_ON`) VALUES
(13, 1, '1,2,5', 1, '2018-06-04 00:00:00', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(14, 1, '3,4,5', 1, '2018-06-04 00:00:00', 0, 0, 0, 1, 1, '2018-06-04 00:00:00'),
(15, 2, '2,6,7', 1, '2018-06-04 00:00:00', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(16, 2, '3,5', 1, '2018-06-04 00:00:00', 0, 0, 0, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `gen_bits`
--

CREATE TABLE `gen_bits` (
  `BIT_NO` int(11) NOT NULL,
  `ZONE_NO` int(11) NOT NULL,
  `BIT_CODE` varchar(100) NOT NULL,
  `BIT_AREA` text NOT NULL,
  `CREATED_BY` int(11) NOT NULL,
  `CREATED_ON` datetime NOT NULL,
  `IS_DELETED` int(1) NOT NULL DEFAULT 0,
  `DELETED_BY` int(11) NOT NULL,
  `DELETED_ON` int(11) NOT NULL,
  `IS_UPDATED` int(1) NOT NULL DEFAULT 0,
  `UPDATED_BY` int(11) NOT NULL,
  `UPDATED_ON` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gen_bits`
--

INSERT INTO `gen_bits` (`BIT_NO`, `ZONE_NO`, `BIT_CODE`, `BIT_AREA`, `CREATED_BY`, `CREATED_ON`, `IS_DELETED`, `DELETED_BY`, `DELETED_ON`, `IS_UPDATED`, `UPDATED_BY`, `UPDATED_ON`) VALUES
(1, 2, '201', 'Dhanmondi,Dhaka', 1, '2018-05-20 00:00:00', 0, 0, 0, 1, 1, '2018-06-03 00:00:00'),
(2, 1, '40004', 'Mirpur', 1, '2018-06-03 00:00:00', 0, 0, 0, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `gen_categorys`
--

CREATE TABLE `gen_categorys` (
  `CATEGORY_NO` int(11) NOT NULL,
  `CATEGORY_NAME` varchar(150) NOT NULL,
  `CATEGORY_IMAGE` varchar(255) NOT NULL,
  `CREATED_BY` int(11) NOT NULL,
  `CREATED_ON` datetime NOT NULL,
  `IS_DELETED` int(1) NOT NULL DEFAULT 0,
  `DELETED_BY` int(11) NOT NULL,
  `DELETED_ON` int(11) NOT NULL,
  `IS_UPDATED` int(1) NOT NULL DEFAULT 0,
  `UPDATED_BY` int(11) NOT NULL,
  `UPDATED_ON` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gen_categorys`
--

INSERT INTO `gen_categorys` (`CATEGORY_NO`, `CATEGORY_NAME`, `CATEGORY_IMAGE`, `CREATED_BY`, `CREATED_ON`, `IS_DELETED`, `DELETED_BY`, `DELETED_ON`, `IS_UPDATED`, `UPDATED_BY`, `UPDATED_ON`) VALUES
(1, 'test', '1527098800book.png', 1, '2018-05-20 13:00:44', 0, 0, 0, 1, 1, '2018-05-23 20:06:40'),
(2, 'Test2', '152709920230530720_1514726275305229_4593838674207026645_n.jpg', 1, '2018-05-23 20:10:46', 0, 0, 0, 1, 1, '2018-05-23 20:13:22'),
(3, 'Test3', 'No.png', 1, '2018-05-23 20:12:06', 1, 1, 2018, 0, 0, '0000-00-00 00:00:00'),
(4, 'FAN', 'No.png', 1, '2018-05-27 19:48:10', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(5, 'Light', 'No.png', 1, '2018-05-29 21:49:45', 0, 0, 0, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `gen_days`
--

CREATE TABLE `gen_days` (
  `DAY_NO` int(11) NOT NULL,
  `DAY_NAME` varchar(100) NOT NULL,
  `CREATED_BY` int(11) NOT NULL,
  `CREATED_ON` datetime NOT NULL,
  `IS_DELETED` int(1) NOT NULL DEFAULT 0,
  `DELETED_BY` int(11) NOT NULL,
  `DELETED_ON` int(11) NOT NULL,
  `IS_UPDATED` int(1) NOT NULL DEFAULT 0,
  `UPDATED_BY` int(11) NOT NULL,
  `UPDATED_ON` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gen_days`
--

INSERT INTO `gen_days` (`DAY_NO`, `DAY_NAME`, `CREATED_BY`, `CREATED_ON`, `IS_DELETED`, `DELETED_BY`, `DELETED_ON`, `IS_UPDATED`, `UPDATED_BY`, `UPDATED_ON`) VALUES
(1, 'Saturday', 1, '2018-05-23 20:52:10', 0, 0, 0, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `gen_designations`
--

CREATE TABLE `gen_designations` (
  `DESIGNATION_NO` int(11) NOT NULL,
  `DESIGNATION_NAME` varchar(50) NOT NULL,
  `DESIGNATION_LEVEL` varchar(55) NOT NULL,
  `CREATED_BY` int(11) NOT NULL,
  `CREATED_ON` datetime NOT NULL,
  `IS_DELETED` int(1) NOT NULL DEFAULT 0,
  `DELETED_BY` int(11) NOT NULL,
  `DELETED_ON` int(11) NOT NULL,
  `IS_UPDATED` int(1) NOT NULL DEFAULT 0,
  `UPDATED_BY` int(11) NOT NULL,
  `UPDATED_ON` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gen_designations`
--

INSERT INTO `gen_designations` (`DESIGNATION_NO`, `DESIGNATION_NAME`, `DESIGNATION_LEVEL`, `CREATED_BY`, `CREATED_ON`, `IS_DELETED`, `DELETED_BY`, `DELETED_ON`, `IS_UPDATED`, `UPDATED_BY`, `UPDATED_ON`) VALUES
(1, 'Software Developer', 'Junior', 1, '2018-05-23 00:00:00', 0, 0, 0, 1, 1, '2018-05-23 00:00:00'),
(2, 'FDGDF', 'GF', 1, '2018-05-25 00:00:00', 1, 1, 2018, 0, 0, '0000-00-00 00:00:00'),
(3, 'FDGDF', 'DFGDF', 1, '2018-05-25 00:00:00', 1, 0, 2018, 0, 0, '0000-00-00 00:00:00'),
(4, 'vb', 'fghgf', 1, '2018-05-25 00:00:00', 1, 1, 2018, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `gen_items`
--

CREATE TABLE `gen_items` (
  `ITEM_NO` int(11) NOT NULL,
  `ITEM_NAME` varchar(150) NOT NULL,
  `ITEM_CODE` varchar(25) NOT NULL,
  `CATEGORY_NO` int(11) NOT NULL,
  `SUBCATEGORY_NO` int(11) NOT NULL,
  `ITEM_UNIT` varchar(100) NOT NULL,
  `ITEM_RATE` double NOT NULL,
  `ITEM_IMAGE` varchar(25) NOT NULL,
  `CREATED_BY` int(11) NOT NULL,
  `CREATED_ON` datetime NOT NULL,
  `IS_DELETED` int(1) NOT NULL DEFAULT 0,
  `DELETED_BY` int(11) NOT NULL,
  `DELETED_ON` int(11) NOT NULL,
  `IS_UPDATED` int(1) NOT NULL DEFAULT 0,
  `UPDATED_BY` int(11) NOT NULL,
  `UPDATED_ON` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gen_items`
--

INSERT INTO `gen_items` (`ITEM_NO`, `ITEM_NAME`, `ITEM_CODE`, `CATEGORY_NO`, `SUBCATEGORY_NO`, `ITEM_UNIT`, `ITEM_RATE`, `ITEM_IMAGE`, `CREATED_BY`, `CREATED_ON`, `IS_DELETED`, `DELETED_BY`, `DELETED_ON`, `IS_UPDATED`, `UPDATED_BY`, `UPDATED_ON`) VALUES
(1, 'item', '', 2, 7, 'kg', 120, '1527101476book.png', 1, '2018-05-23 20:46:28', 0, 0, 0, 1, 1, '0000-00-00 00:00:00'),
(2, 'ITEM2', '001', 2, 7, 'gm', 220, 'No.png', 1, '2018-05-23 20:49:51', 0, 0, 0, 1, 1, '0000-00-00 00:00:00'),
(3, 'GF', '002', 4, 10, 'pcs', 2800, 'No.png', 1, '2018-05-27 19:53:07', 0, 0, 0, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `gen_packagedtls`
--

CREATE TABLE `gen_packagedtls` (
  `PACKAGEDTL_NO` int(11) NOT NULL,
  `ITEM_NO` int(11) NOT NULL,
  `PACKAGEMASTER_NO` int(11) NOT NULL,
  `ITEM_UNIT` varchar(55) NOT NULL,
  `ITEM_RATE` double NOT NULL,
  `CREATED_BY` int(11) NOT NULL,
  `CREATED_ON` datetime NOT NULL,
  `IS_DELETED` int(1) NOT NULL DEFAULT 0,
  `DELETED_BY` int(11) NOT NULL,
  `DELETED_ON` int(11) NOT NULL,
  `IS_UPDATED` int(1) NOT NULL DEFAULT 0,
  `UPDATED_BY` int(11) NOT NULL,
  `UPDATED_ON` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gen_packagedtls`
--

INSERT INTO `gen_packagedtls` (`PACKAGEDTL_NO`, `ITEM_NO`, `PACKAGEMASTER_NO`, `ITEM_UNIT`, `ITEM_RATE`, `CREATED_BY`, `CREATED_ON`, `IS_DELETED`, `DELETED_BY`, `DELETED_ON`, `IS_UPDATED`, `UPDATED_BY`, `UPDATED_ON`) VALUES
(1, 1, 1, 'kg', 120, 1, '2018-05-25 07:24:53', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(2, 1, 2, 'kg', 140, 1, '2018-05-28 07:50:11', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(3, 1, 3, 'kg', 140, 1, '2018-05-28 07:50:13', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(4, 1, 4, 'kg', 140, 1, '2018-05-28 07:50:17', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(5, 1, 5, 'kg', 140, 1, '2018-05-28 07:50:31', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(6, 1, 6, 'kg', 140, 1, '2018-05-28 07:50:32', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(7, 1, 7, 'kg', 140, 1, '2018-05-28 07:50:32', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(8, 1, 8, 'kg', 140, 1, '2018-05-28 07:50:32', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(9, 1, 9, 'kg', 140, 1, '2018-05-28 07:50:33', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(10, 1, 10, 'kg', 140, 1, '2018-05-28 07:50:33', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(11, 1, 11, 'kg', 140, 1, '2018-05-28 07:50:33', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(12, 1, 12, 'kg', 140, 1, '2018-05-28 07:50:33', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(13, 1, 13, 'kg', 140, 1, '2018-05-28 07:50:34', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(14, 1, 14, 'kg', 140, 1, '2018-05-28 07:50:34', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(15, 1, 15, 'kg', 140, 1, '2018-05-28 07:50:35', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(16, 1, 16, 'kg', 140, 1, '2018-05-28 07:50:35', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(17, 1, 17, 'kg', 140, 1, '2018-05-28 07:50:35', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(18, 1, 18, 'kg', 140, 1, '2018-05-28 07:50:35', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(19, 1, 19, 'kg', 140, 1, '2018-05-28 07:50:35', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(20, 1, 20, 'kg', 140, 1, '2018-05-28 07:50:35', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(21, 1, 21, 'kg', 140, 1, '2018-05-28 07:50:36', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(22, 1, 22, 'kg', 140, 1, '2018-05-28 07:50:36', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(23, 1, 23, 'kg', 140, 1, '2018-05-28 07:50:36', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(24, 1, 24, 'kg', 140, 1, '2018-05-28 07:50:36', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(25, 1, 25, 'kg', 140, 1, '2018-05-28 07:50:36', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(26, 1, 26, 'kg', 140, 1, '2018-05-28 07:50:37', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(27, 1, 27, 'kg', 140, 1, '2018-05-28 07:50:38', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(28, 1, 28, 'kg', 140, 1, '2018-05-28 07:50:38', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(29, 1, 29, 'kg', 140, 1, '2018-05-28 07:50:44', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(30, 1, 1, 'kg', 140, 1, '2018-05-28 07:52:14', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(31, 3, 2, 'pcs', 3200, 1, '2018-05-28 09:35:48', 0, 0, 0, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `gen_packagemasters`
--

CREATE TABLE `gen_packagemasters` (
  `PACKAGEMASTER_NO` int(11) NOT NULL,
  `PACKAGE_NAME` varchar(100) NOT NULL,
  `PACKAGE_RATE` double NOT NULL,
  `PACKAGE_CODE` varchar(25) NOT NULL,
  `PACKAGE_IMAGE` varchar(255) NOT NULL,
  `PACKAGE_BENEFIT` varchar(255) NOT NULL,
  `CREATED_BY` int(11) NOT NULL,
  `CREATED_ON` datetime NOT NULL,
  `IS_DELETED` int(1) NOT NULL DEFAULT 0,
  `DELETED_BY` int(11) NOT NULL,
  `DELETED_ON` int(11) NOT NULL,
  `IS_UPDATED` int(1) NOT NULL DEFAULT 0,
  `UPDATED_BY` int(11) NOT NULL,
  `UPDATED_ON` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gen_packagemasters`
--

INSERT INTO `gen_packagemasters` (`PACKAGEMASTER_NO`, `PACKAGE_NAME`, `PACKAGE_RATE`, `PACKAGE_CODE`, `PACKAGE_IMAGE`, `PACKAGE_BENEFIT`, `CREATED_BY`, `CREATED_ON`, `IS_DELETED`, `DELETED_BY`, `DELETED_ON`, `IS_UPDATED`, `UPDATED_BY`, `UPDATED_ON`) VALUES
(1, 'Package', 2200, '001', '1527486734', 'details', 1, '2018-05-28 07:52:14', 0, 1, 2018, 0, 0, '0000-00-00 00:00:00'),
(2, 'Special Package', 4000, '006', '', 'All', 1, '2018-05-28 09:35:48', 0, 0, 0, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `gen_sales_groups`
--

CREATE TABLE `gen_sales_groups` (
  `SALES_GROUP_NO` int(11) NOT NULL,
  `SALES_GROUP_NAME` varchar(100) NOT NULL,
  `SALES_GROUP_ID` varchar(50) NOT NULL,
  `CREATED_BY` int(11) NOT NULL,
  `CREATED_ON` datetime NOT NULL,
  `IS_DELETED` int(1) NOT NULL DEFAULT 0,
  `DELETED_BY` int(11) NOT NULL,
  `DELETED_ON` int(11) NOT NULL,
  `IS_UPDATED` int(1) NOT NULL DEFAULT 0,
  `UPDATED_BY` int(11) NOT NULL,
  `UPDATED_ON` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gen_sales_groups`
--

INSERT INTO `gen_sales_groups` (`SALES_GROUP_NO`, `SALES_GROUP_NAME`, `SALES_GROUP_ID`, `CREATED_BY`, `CREATED_ON`, `IS_DELETED`, `DELETED_BY`, `DELETED_ON`, `IS_UPDATED`, `UPDATED_BY`, `UPDATED_ON`) VALUES
(1, 'Group 1', 'sg-1', 1, '2018-05-23 00:00:00', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(2, 'bdsoft', 'bds1', 1, '2018-05-25 00:00:00', 0, 0, 0, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `gen_subcategorys`
--

CREATE TABLE `gen_subcategorys` (
  `SUBCATEGORY_NO` int(11) NOT NULL,
  `CATEGORY_NO` int(11) NOT NULL,
  `SUBCATEGORY_NAME` varchar(150) NOT NULL,
  `SUB_CATEGORY_IMAGE` varchar(255) NOT NULL,
  `CREATED_BY` int(11) NOT NULL,
  `CREATED_ON` datetime NOT NULL,
  `IS_DELETED` int(1) NOT NULL DEFAULT 0,
  `DELETED_BY` int(11) NOT NULL,
  `DELETED_ON` int(11) NOT NULL,
  `IS_UPDATED` int(1) NOT NULL DEFAULT 0,
  `UPDATED_BY` int(11) NOT NULL,
  `UPDATED_ON` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gen_subcategorys`
--

INSERT INTO `gen_subcategorys` (`SUBCATEGORY_NO`, `CATEGORY_NO`, `SUBCATEGORY_NAME`, `SUB_CATEGORY_IMAGE`, `CREATED_BY`, `CREATED_ON`, `IS_DELETED`, `DELETED_BY`, `DELETED_ON`, `IS_UPDATED`, `UPDATED_BY`, `UPDATED_ON`) VALUES
(1, 4, 'IHDIUFDS', '', 0, '0000-00-00 00:00:00', 1, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(2, 2, 'rasel', '', 0, '0000-00-00 00:00:00', 1, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(3, 2, 'iidfkfbdfb', '', 0, '0000-00-00 00:00:00', 1, 0, 0, 1, 0, '0000-00-00 00:00:00'),
(4, 4, 'lldvppp', '', 0, '0000-00-00 00:00:00', 1, 0, 0, 1, 0, '0000-00-00 00:00:00'),
(5, 1, 'Sub Category', '15271001154.png', 0, '0000-00-00 00:00:00', 0, 0, 0, 1, 0, '0000-00-00 00:00:00'),
(6, 1, '', '', 0, '0000-00-00 00:00:00', 1, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(7, 2, 'Category', 'No.png', 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(8, 0, 'fdgd', 'No.png', 0, '0000-00-00 00:00:00', 1, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(9, 2, 'fdgf', 'No.png', 0, '0000-00-00 00:00:00', 1, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(10, 4, 'Table fan', 'No.png', 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `gen_zones`
--

CREATE TABLE `gen_zones` (
  `ZONE_NO` int(11) NOT NULL,
  `ZONE_NAME` varchar(255) NOT NULL,
  `IS_DELETED` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gen_zones`
--

INSERT INTO `gen_zones` (`ZONE_NO`, `ZONE_NAME`, `IS_DELETED`) VALUES
(1, 'Dhaka', 0),
(2, 'Khulna', 0),
(3, 'Comilla', 0);

-- --------------------------------------------------------

--
-- Table structure for table `trn_employee_regs`
--

CREATE TABLE `trn_employee_regs` (
  `EMPLOYEE_REG_NO` int(11) NOT NULL,
  `EMPLOYEE_ID` varchar(100) NOT NULL,
  `EMPLOYEE_PASSWORD` varchar(100) NOT NULL,
  `EMPLOYEE_NAME` varchar(100) NOT NULL,
  `EMPLOYEE_EMAIL` varchar(100) NOT NULL,
  `MOBILE_NO` varchar(50) NOT NULL,
  `DESIGNATION_NO` int(11) NOT NULL,
  `JOINING_DATE` date NOT NULL,
  `ZONE_NO` int(11) NOT NULL,
  `IS_ACTIVE` int(1) NOT NULL DEFAULT 0,
  `IMAGE_URL` varchar(255) NOT NULL,
  `CREATED_BY` int(11) NOT NULL,
  `CREATED_ON` datetime NOT NULL,
  `IS_DELETED` int(1) NOT NULL DEFAULT 0,
  `DELETED_BY` int(11) NOT NULL,
  `DELETED_ON` int(11) NOT NULL,
  `IS_UPDATED` int(1) NOT NULL DEFAULT 0,
  `UPDATED_BY` int(11) NOT NULL,
  `UPDATED_ON` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trn_employee_regs`
--

INSERT INTO `trn_employee_regs` (`EMPLOYEE_REG_NO`, `EMPLOYEE_ID`, `EMPLOYEE_PASSWORD`, `EMPLOYEE_NAME`, `EMPLOYEE_EMAIL`, `MOBILE_NO`, `DESIGNATION_NO`, `JOINING_DATE`, `ZONE_NO`, `IS_ACTIVE`, `IMAGE_URL`, `CREATED_BY`, `CREATED_ON`, `IS_DELETED`, `DELETED_BY`, `DELETED_ON`, `IS_UPDATED`, `UPDATED_BY`, `UPDATED_ON`) VALUES
(1, 'EMP123', '', 'SAIKAT SARWAR ISLAM bd', 'ssislambd@gmail.com', '1685505076', 1, '1970-01-01', 1, 0, '152749007330743540_1748036515281543_935243405175291904_n.jpg', 1, '2018-05-20 00:00:00', 0, 0, 0, 1, 1, '2018-05-28 00:00:00'),
(2, '151-15', '123', 'Riyad', 'riyad@bdsoft.biz', '1234567890-', 1, '2018-05-22', 1, 1, '152749021328577664_1582152718579154_5372807873801486740_n.png', 1, '2018-05-25 00:00:00', 0, 0, 0, 1, 1, '2018-05-28 00:00:00'),
(3, '12348', '123', 'Ripon', 'ripon@bdsoft.biz', '1234567890320', 1, '2018-05-23', 2, 1, '152749016232336646_1712057562224128_1069814548854210560_o.jpg', 1, '2018-05-28 00:00:00', 0, 0, 0, 1, 1, '2018-05-29 00:00:00'),
(4, '123', '123', 'SAIKAT SARWAR ISLAM bd', 'saikat@bdsoft.biz', '12345678976', 1, '2018-05-17', 1, 0, '152749036032202881_1711657972264087_3564101112195710976_o.jpg', 1, '2018-05-28 00:00:00', 0, 0, 0, 0, 1, '2018-05-29 00:00:00'),
(5, '151-15-001', '123', 'Shahadat', 'shhaadaat@bdsoft.biz', '123456787976896576', 1, '2018-05-09', 2, 1, '152753457130706695_2012499772125776_6073682590949179392_n.jpg', 1, '2018-05-28 00:00:00', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(6, '123456789876', '123', 'Solaiman', 'sallu@gmail.com', '2345676563454', 1, '2018-05-17', 2, 1, '152753462130743540_1748036515281543_935243405175291904_n.jpg', 1, '2018-05-28 00:00:00', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(7, '111-009-880', '123', 'Mamun Ahmed', 'mamun@gmail.com', '098234332423', 1, '2018-05-15', 2, 1, 'No.png', 1, '2018-05-28 00:00:00', 0, 0, 0, 1, 1, '2018-05-28 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `trn_outlets`
--

CREATE TABLE `trn_outlets` (
  `OUTLET_NO` int(11) NOT NULL,
  `OUTLET_NAME` varchar(255) NOT NULL,
  `OUTLET_CODE` varchar(50) NOT NULL,
  `ZONE_NO` int(11) NOT NULL,
  `BIT_NO` int(11) NOT NULL,
  `CREATED_BY` int(11) NOT NULL,
  `CREATED_ON` datetime NOT NULL,
  `IS_DELETED` int(1) NOT NULL DEFAULT 0,
  `DELETED_BY` int(11) NOT NULL,
  `DELETED_ON` int(11) NOT NULL,
  `IS_UPDATED` int(1) NOT NULL DEFAULT 0,
  `UPDATED_BY` int(11) NOT NULL,
  `UPDATED_ON` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trn_outlets`
--

INSERT INTO `trn_outlets` (`OUTLET_NO`, `OUTLET_NAME`, `OUTLET_CODE`, `ZONE_NO`, `BIT_NO`, `CREATED_BY`, `CREATED_ON`, `IS_DELETED`, `DELETED_BY`, `DELETED_ON`, `IS_UPDATED`, `UPDATED_BY`, `UPDATED_ON`) VALUES
(1, 'Outlet-1', '005', 2, 1, 1, '2018-05-23 20:52:57', 0, 0, 0, 1, 1, '2018-06-03 18:16:06'),
(2, 'Outlet-4', 'OUT-009', 1, 2, 1, '2018-05-25 19:29:33', 0, 0, 0, 1, 1, '2018-06-03 18:15:46'),
(3, '', '', 0, -1, 1, '2018-05-25 19:36:19', 1, 1, 2018, 0, 0, '0000-00-00 00:00:00'),
(4, '', '', 0, -1, 1, '2018-05-25 19:37:06', 1, 1, 2018, 0, 0, '0000-00-00 00:00:00'),
(5, 'g', 'F', 0, 1, 1, '2018-05-25 19:37:45', 1, 1, 2018, 0, 0, '0000-00-00 00:00:00'),
(6, 'Outlet-3', 'OT-004', 2, 1, 1, '2018-06-03 18:15:20', 0, 0, 0, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `xxx_user`
--

CREATE TABLE `xxx_user` (
  `user_no` int(11) NOT NULL,
  `user_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `user_full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_contact` text COLLATE utf8_unicode_ci NOT NULL,
  `is_active` int(11) NOT NULL,
  `active_from` date NOT NULL,
  `active_to` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `xxx_user`
--

INSERT INTO `xxx_user` (`user_no`, `user_name`, `pass`, `user_full_name`, `user_email`, `user_contact`, `is_active`, `active_from`, `active_to`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', 'Administrator', '', '', 1, '2018-05-01', '2020-04-30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee_wise_day_bits`
--
ALTER TABLE `employee_wise_day_bits`
  ADD PRIMARY KEY (`EMPLOYEE_WISE_DAY_BIT_NO`);

--
-- Indexes for table `employee_wise_sales`
--
ALTER TABLE `employee_wise_sales`
  ADD PRIMARY KEY (`EMPLOYEE_WISE_SALE_NO`);

--
-- Indexes for table `gen_bits`
--
ALTER TABLE `gen_bits`
  ADD PRIMARY KEY (`BIT_NO`);

--
-- Indexes for table `gen_categorys`
--
ALTER TABLE `gen_categorys`
  ADD PRIMARY KEY (`CATEGORY_NO`);

--
-- Indexes for table `gen_days`
--
ALTER TABLE `gen_days`
  ADD PRIMARY KEY (`DAY_NO`);

--
-- Indexes for table `gen_designations`
--
ALTER TABLE `gen_designations`
  ADD PRIMARY KEY (`DESIGNATION_NO`);

--
-- Indexes for table `gen_items`
--
ALTER TABLE `gen_items`
  ADD PRIMARY KEY (`ITEM_NO`);

--
-- Indexes for table `gen_packagedtls`
--
ALTER TABLE `gen_packagedtls`
  ADD PRIMARY KEY (`PACKAGEDTL_NO`);

--
-- Indexes for table `gen_packagemasters`
--
ALTER TABLE `gen_packagemasters`
  ADD PRIMARY KEY (`PACKAGEMASTER_NO`);

--
-- Indexes for table `gen_sales_groups`
--
ALTER TABLE `gen_sales_groups`
  ADD PRIMARY KEY (`SALES_GROUP_NO`);

--
-- Indexes for table `gen_subcategorys`
--
ALTER TABLE `gen_subcategorys`
  ADD PRIMARY KEY (`SUBCATEGORY_NO`);

--
-- Indexes for table `gen_zones`
--
ALTER TABLE `gen_zones`
  ADD PRIMARY KEY (`ZONE_NO`);

--
-- Indexes for table `trn_employee_regs`
--
ALTER TABLE `trn_employee_regs`
  ADD PRIMARY KEY (`EMPLOYEE_REG_NO`);

--
-- Indexes for table `trn_outlets`
--
ALTER TABLE `trn_outlets`
  ADD PRIMARY KEY (`OUTLET_NO`);

--
-- Indexes for table `xxx_user`
--
ALTER TABLE `xxx_user`
  ADD PRIMARY KEY (`user_no`),
  ADD UNIQUE KEY `USER_NAME` (`user_name`),
  ADD UNIQUE KEY `USER_EMAIL` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee_wise_day_bits`
--
ALTER TABLE `employee_wise_day_bits`
  MODIFY `EMPLOYEE_WISE_DAY_BIT_NO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employee_wise_sales`
--
ALTER TABLE `employee_wise_sales`
  MODIFY `EMPLOYEE_WISE_SALE_NO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `gen_bits`
--
ALTER TABLE `gen_bits`
  MODIFY `BIT_NO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gen_categorys`
--
ALTER TABLE `gen_categorys`
  MODIFY `CATEGORY_NO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `gen_days`
--
ALTER TABLE `gen_days`
  MODIFY `DAY_NO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gen_designations`
--
ALTER TABLE `gen_designations`
  MODIFY `DESIGNATION_NO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gen_items`
--
ALTER TABLE `gen_items`
  MODIFY `ITEM_NO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gen_packagedtls`
--
ALTER TABLE `gen_packagedtls`
  MODIFY `PACKAGEDTL_NO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `gen_packagemasters`
--
ALTER TABLE `gen_packagemasters`
  MODIFY `PACKAGEMASTER_NO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gen_sales_groups`
--
ALTER TABLE `gen_sales_groups`
  MODIFY `SALES_GROUP_NO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gen_subcategorys`
--
ALTER TABLE `gen_subcategorys`
  MODIFY `SUBCATEGORY_NO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `gen_zones`
--
ALTER TABLE `gen_zones`
  MODIFY `ZONE_NO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `trn_employee_regs`
--
ALTER TABLE `trn_employee_regs`
  MODIFY `EMPLOYEE_REG_NO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `trn_outlets`
--
ALTER TABLE `trn_outlets`
  MODIFY `OUTLET_NO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `xxx_user`
--
ALTER TABLE `xxx_user`
  MODIFY `user_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
