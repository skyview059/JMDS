-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 13, 2026 at 01:41 PM
-- Server version: 8.0.39
-- PHP Version: 8.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `freelan8_app_driving_school`
--

-- --------------------------------------------------------

--
-- Table structure for table `acls`
--

DROP TABLE IF EXISTS `acls`;
CREATE TABLE IF NOT EXISTS `acls` (
  `id` int NOT NULL AUTO_INCREMENT,
  `module_id` int DEFAULT NULL,
  `permission_name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permission_key` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permKey` (`permission_key`)
) ENGINE=InnoDB AUTO_INCREMENT=134 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `acls`
--

INSERT INTO `acls` (`id`, `module_id`, `permission_name`, `permission_key`, `order_id`) VALUES
(1, 2, 'User Management', 'users', 0),
(2, 2, 'Add New User', 'users/create', 0),
(3, 2, 'View User Profile', 'users/create_action', 0),
(4, 2, 'Delete User', 'users/delete', 0),
(5, 2, 'Add New Access Control', 'users/roles', 0),
(6, 3, 'Update General Settings', 'settings', 0),
(7, 1, 'Dashboard', 'dashboard', 0),
(8, 2, 'users/profile', 'users/profile', 0),
(9, 2, 'users/update', 'users/update', 0),
(10, 7, 'profile', 'profile', 0),
(11, 3, 'settings/update', 'settings/update', 0),
(12, 7, 'profile/update', 'profile/update', 0),
(13, 7, 'profile/password', 'profile/password', 0),
(14, 5, 'module', 'module', 0),
(15, 5, 'create', 'module/create', 0),
(16, 5, 'update', 'module/update', 0),
(17, 5, 'delete', 'module/delete', 0),
(18, 5, 'create_action', 'module/create_action', 0),
(19, 5, 'update_action', 'module/update_action', 0),
(20, 6, 'db_sync', 'db_sync', 0),
(21, 3, 'settings/items', 'settings/items', 0),
(23, 5, 'create', 'module/acl', 0),
(24, 2, 'users/password', 'users/password', 0),
(40, 10, 'Area', 'area', 0),
(41, 10, 'Area create', 'area/create', 0),
(42, 10, 'Area/save create action', 'area/create_action', 0),
(43, 10, 'Area/update', 'area/update', 0),
(45, 10, 'Area/delete', 'area/delete', 0),
(46, 10, 'Area/update_action', 'area/update_action', 0),
(73, 1, 'collector', 'collector', 0),
(80, 12, 'Report', 'report', 0),
(89, 13, 'Donor', 'donor', 0),
(90, 13, 'Donor create', 'donor/create', 0),
(91, 13, 'Donor/save create action', 'donor/create_action', 0),
(92, 13, 'Donor/update', 'donor/update', 0),
(93, 13, 'Profile', 'donor/profile', 0),
(94, 13, 'Donor/delete', 'donor/delete', 0),
(95, 13, 'Donor/update_action', 'donor/update_action', 0),
(96, 14, 'Trans', 'trans', 0),
(97, 14, 'Trans create', 'trans/entry', 0),
(98, 14, 'Trans/save create action', 'trans/entry_action', 0),
(99, 15, 'Expense', 'expense', 0),
(100, 15, 'Expense create', 'expense/create', 0),
(101, 15, 'Expense/save create action', 'expense/create_action', 0),
(104, 15, 'Expense Void', 'expense/void', 0),
(106, 15, 'expense/head', 'expense/head', 0),
(107, 16, 'Sms', 'sms', 0),
(108, 16, 'Write SMS', 'sms/write', 0),
(109, 16, 'SMS Send Acction', 'sms/send', 0),
(112, 16, 'Sms/delete', 'sms/delete', 0),
(114, 16, 'sms/template', 'sms/template', 0),
(115, 14, 'trans/head', 'trans/head', 0),
(116, 13, 'donor/stmt', 'donor/stmt', 0),
(117, 12, 'report/print_view', 'report/print_view', 0),
(118, 16, 'sms/report', 'sms/report', 0),
(119, 15, 'expense/report', 'expense/report', 0),
(120, 17, 'Learner', 'learner', 0),
(121, 17, 'Learner create', 'learner/create', 0),
(122, 17, 'Learner/save create action', 'learner/create_action', 0),
(123, 17, 'Learner/update', 'learner/update', 0),
(124, 17, 'Learner/read', 'learner/read', 0),
(125, 17, 'Learner/delete', 'learner/delete', 0),
(126, 17, 'Learner/update_action', 'learner/update_action', 0),
(127, 18, 'Batch', 'batch', 0),
(128, 18, 'Batch create', 'batch/create', 0),
(129, 18, 'Batch/save create action', 'batch/create_action', 0),
(130, 18, 'Batch/update', 'batch/update', 0),
(131, 18, 'Batch/read', 'batch/read', 0),
(132, 18, 'Batch/delete', 'batch/delete', 0),
(133, 18, 'Batch/update_action', 'batch/update_action', 0);

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

DROP TABLE IF EXISTS `batches`;
CREATE TABLE IF NOT EXISTS `batches` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_start` datetime DEFAULT NULL,
  `date_end` datetime DEFAULT NULL,
  `status` enum('Running','Close','Upcoming') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Upcoming',
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_sync`
--

DROP TABLE IF EXISTS `db_sync`;
CREATE TABLE IF NOT EXISTS `db_sync` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `event_fired` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `db` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

DROP TABLE IF EXISTS `donations`;
CREATE TABLE IF NOT EXISTS `donations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `donor_id` int NOT NULL,
  `head_id` int NOT NULL,
  `donate_type` enum('General','Personal') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'General',
  `month` date NOT NULL,
  `remark` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid` int NOT NULL,
  `paid_date` date NOT NULL,
  `collected_by` int NOT NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  `status` enum('OK','Void') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'OK',
  PRIMARY KEY (`id`),
  KEY `subscriber_id` (`donor_id`),
  KEY `month` (`month`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `donation_heads`
--

DROP TABLE IF EXISTS `donation_heads`;
CREATE TABLE IF NOT EXISTS `donation_heads` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `donors`
--

DROP TABLE IF EXISTS `donors`;
CREATE TABLE IF NOT EXISTS `donors` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ref_id` int NOT NULL,
  `area_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int NOT NULL,
  `contact` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `add_line1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `add_line2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reg_date` date NOT NULL,
  `remark` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
CREATE TABLE IF NOT EXISTS `expenses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `trans_date` date NOT NULL,
  `head_id` int NOT NULL,
  `sub_head_id` int NOT NULL,
  `remark` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` int NOT NULL,
  `timestamp` datetime NOT NULL,
  `user_id` int NOT NULL,
  `status` enum('OK','Void') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'OK',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=435 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `trans_date`, `head_id`, `sub_head_id`, `remark`, `amount`, `timestamp`, `user_id`, `status`) VALUES
(1, '2019-09-09', 3, 0, '', 500, '2019-09-09 22:32:24', 3, 'Void'),
(2, '2019-09-02', 12, 0, 'Chaitanya Sandesh Monthly', 1100, '2019-09-11 11:18:11', 6, 'OK'),
(3, '2019-09-01', 7, 0, '', 130, '2019-09-11 11:20:31', 3, 'OK'),
(4, '2019-09-02', 2, 0, '', 2395, '2019-09-11 11:21:43', 3, 'OK'),
(5, '2019-09-03', 6, 0, '', 400, '2019-09-11 11:22:28', 3, 'OK'),
(6, '2019-09-02', 11, 0, '', 30, '2019-09-11 11:24:04', 5, 'OK'),
(7, '2019-09-03', 4, 0, '', 460, '2019-09-11 11:25:21', 6, 'OK'),
(8, '2019-09-04', 7, 0, '', 235, '2019-09-11 11:26:59', 3, 'OK'),
(9, '2019-09-04', 5, 0, 'Utensils Purchase', 2030, '2019-09-11 11:28:14', 3, 'OK'),
(10, '2019-09-04', 11, 0, 'Spice', 790, '2019-09-11 11:29:26', 3, 'OK'),
(11, '2019-09-08', 3, 0, '', 70, '2019-09-11 11:31:00', 5, 'OK'),
(12, '2019-09-09', 4, 0, '', 150, '2019-09-11 11:31:23', 5, 'OK'),
(13, '2019-09-11', 11, 0, 'Milk 11 kg', 440, '2019-09-11 14:52:59', 3, 'OK'),
(14, '2019-09-09', 11, 0, '', 1925, '2019-09-11 17:30:55', 3, 'OK'),
(15, '2019-09-12', 6, 0, 'Petrol', 50, '2019-09-12 18:04:22', 5, 'OK'),
(16, '2019-09-12', 11, 0, 'Fine Flour', 210, '2019-09-12 18:06:25', 5, 'OK'),
(17, '2019-09-12', 7, 0, 'Poly bag half kg', 125, '2019-09-12 18:07:15', 5, 'OK'),
(18, '2019-09-13', 6, 0, 'নড়াইল যাতায়াত  তিনটা মোটর বাইক', 290, '2019-09-13 20:02:36', 5, 'OK'),
(19, '2019-09-13', 4, 0, '', 180, '2019-09-14 14:49:47', 4, 'Void'),
(20, '2019-09-13', 8, 0, 'Prasad Box for Muktidata prabhu', 220, '2019-09-14 14:50:59', 4, 'Void'),
(21, '2019-09-14', 3, 0, 'Prasad carried to Arpara Primary School', 20, '2019-09-14 19:24:25', 5, 'OK'),
(22, '2019-09-15', 13, 0, 'Bajaj platina 100', 94900, '2019-09-15 22:00:44', 5, 'OK'),
(23, '2019-09-15', 6, 0, '', 500, '2019-09-15 22:01:40', 5, 'OK'),
(24, '2019-09-15', 4, 0, '', 760, '2019-09-15 22:03:01', 5, 'OK'),
(25, '2019-09-15', 5, 0, 'Spare parts for newly purchased bike', 600, '2019-09-15 22:04:46', 5, 'OK'),
(26, '2019-09-16', 14, 0, 'ভক্তিচারু গুরু মহারাজের অভিষেকের জন্য', 1300, '2019-09-16 19:33:15', 5, 'OK'),
(27, '2019-09-17', 15, 0, '', 1156, '2019-09-17 18:04:06', 6, 'OK'),
(28, '2019-09-17', 4, 0, '', 176, '2019-09-17 18:05:15', 6, 'OK'),
(29, '2019-09-18', 6, 0, '', 180, '2019-09-19 10:53:27', 6, 'OK'),
(30, '2019-09-18', 4, 0, '', 320, '2019-09-19 10:54:04', 6, 'OK'),
(31, '2019-09-18', 16, 0, '', 100, '2019-09-19 11:55:34', 5, 'OK'),
(32, '2019-09-19', 3, 0, 'For going to Dhaka', 400, '2019-09-19 18:30:19', 6, 'OK'),
(33, '2019-09-20', 4, 0, '', 120, '2019-09-20 15:07:00', 5, 'OK'),
(34, '2019-09-21', 4, 0, 'হোগলাডাঙ্গা ও আড়পাড়ায় গীতা ক্লাসের জন্য', 40, '2019-09-21 19:32:05', 5, 'OK'),
(35, '2019-09-21', 7, 0, 'সিম কার্ড ও সেভিং মেশিন ক্রয়', 138, '2019-09-21 19:33:42', 5, 'OK'),
(36, '2019-10-02', 6, 0, '', 100, '2019-09-21 21:45:46', 5, 'Void'),
(37, '2019-09-03', 16, 0, '', 100, '2019-09-21 21:46:17', 5, 'Void'),
(38, '2019-09-23', 5, 0, 'Dumper Lock', 420, '2019-09-23 21:29:03', 5, 'OK'),
(39, '2019-09-24', 5, 0, 'Bike accessories', 250, '2019-09-24 19:35:44', 5, 'OK'),
(40, '2019-09-24', 7, 0, 'Photo taken', 45, '2019-09-24 19:37:26', 5, 'OK'),
(41, '2019-09-25', 6, 0, '2 লিটার', 180, '2019-09-25 21:41:31', 6, 'OK'),
(42, '2019-09-25', 4, 0, '', 320, '2019-09-25 21:41:55', 6, 'OK'),
(43, '2019-09-28', 4, 0, '', 50, '2019-09-28 15:30:06', 5, 'OK'),
(44, '2019-09-28', 6, 0, '', 90, '2019-09-28 15:30:35', 5, 'OK'),
(45, '2019-09-28', 4, 0, '', 500, '2019-09-29 20:19:11', 6, 'OK'),
(46, '2019-09-28', 6, 0, '', 180, '2019-09-29 20:19:30', 6, 'OK'),
(47, '2019-09-30', 6, 0, 'For Mahendra on attending a house program at Khajura', 200, '2019-09-30 19:09:06', 5, 'OK'),
(48, '2019-09-30', 4, 0, 'For children\'s class', 50, '2019-09-30 19:11:50', 5, 'OK'),
(49, '2019-10-29', 5, 0, 'মাহেন্দ্র গাড়ীর ছাউনী', 500, '2019-10-01 07:42:59', 3, 'Void'),
(50, '2029-09-19', 5, 0, 'মাহেন্দ্র গাড়ীর ছাউনী', 500, '2019-10-02 13:46:46', 3, 'Void');

-- --------------------------------------------------------

--
-- Table structure for table `expense_heads`
--

DROP TABLE IF EXISTS `expense_heads`;
CREATE TABLE IF NOT EXISTS `expense_heads` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` enum('Head','SubHead') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Head',
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Active','Inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expense_heads`
--

INSERT INTO `expense_heads` (`id`, `type`, `name`, `status`) VALUES
(1, 'Head', 'Deposit', 'Inactive'),
(2, 'Head', 'Garments', 'Inactive'),
(3, 'Head', 'Conveyance', 'Active'),
(4, 'Head', 'Prasad', 'Active'),
(5, 'Head', 'Repair/Maintenance', 'Active'),
(6, 'Head', 'Fuel/Oil', 'Active'),
(7, 'Head', 'Stationery', 'Active'),
(8, 'Head', 'Gift', 'Inactive'),
(9, 'Head', 'Medicine', 'Inactive'),
(10, 'Head', 'Medicine', 'Inactive'),
(11, 'Head', 'Food Stuff', 'Active'),
(12, 'Head', 'Monthly &Magazine', 'Active'),
(13, 'Head', 'Vehicle purchase', 'Inactive'),
(14, 'Head', 'অভিষেকের সামগ্রী', 'Inactive'),
(15, 'Head', 'Book', 'Inactive'),
(16, 'Head', 'Mobile Bill', 'Active'),
(17, 'Head', 'Utensils', 'Inactive'),
(18, 'Head', 'বিবিধ', 'Active'),
(19, 'Head', 'বীজ ক্রয়', 'Inactive'),
(20, 'Head', 'Nagar Sankirtan', 'Active'),
(21, 'Head', 'গ্রন্থ ক্রয়', 'Active'),
(22, 'Head', 'Course Fee', 'Inactive'),
(23, 'SubHead', 'Varieties', 'Active'),
(24, 'Head', 'APP SERVICE CHARGE & SMS COST', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `learners`
--

DROP TABLE IF EXISTS `learners`;
CREATE TABLE IF NOT EXISTS `learners` (
  `id` int NOT NULL AUTO_INCREMENT,
  `batch_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `dob` date DEFAULT NULL,
  `nid` int DEFAULT NULL,
  `father` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mother` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `zila_id` int NOT NULL,
  `primary_mobile` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `blood_group` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `second_contact_person` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `second_contact_mobile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_resident` enum('Yes','No') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'No',
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=228 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

DROP TABLE IF EXISTS `modules`;
CREATE TABLE IF NOT EXISTS `modules` (
  `id` int NOT NULL AUTO_INCREMENT,
  `added_date` date NOT NULL,
  `order` int NOT NULL,
  `type` enum('Module','Utility','Accounts') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `folder` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Enable','Disable','Locked') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Disable',
  PRIMARY KEY (`id`),
  UNIQUE KEY `folder` (`folder`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `added_date`, `order`, `type`, `name`, `folder`, `description`, `status`) VALUES
(1, '2014-09-07', 1, 'Module', 'Dashboard', 'dashboard', '', 'Locked'),
(2, '2014-09-07', 10, 'Module', 'Admin User', 'user', '', 'Locked'),
(3, '2014-09-07', 15, 'Module', 'Site Setting', 'settings', '', 'Locked'),
(5, '2016-11-24', 32, 'Module', 'Manage Modules', 'module', '', 'Locked'),
(6, '2016-11-24', 33, 'Module', 'DB Sync', 'db_sync', '', 'Locked'),
(7, '2016-11-24', 34, 'Module', 'Profile', 'profile', '', 'Locked'),
(10, '2018-08-23', 1, 'Module', 'Area', 'area', '', 'Locked'),
(12, '2018-12-02', 1, 'Module', 'Report', 'report', '', 'Enable'),
(14, '2019-08-23', 1, 'Module', 'Trans', 'trans', '', 'Locked'),
(15, '2019-08-23', 1, 'Module', 'Expense', 'Expense', '', 'Locked'),
(16, '2019-08-26', 1, 'Module', 'SMS', 'sms', 'SMS', 'Locked'),
(17, '2026-05-13', 1, 'Module', 'learner', 'learner', 'Learner Driver Management', 'Enable'),
(18, '2026-05-13', 1, 'Module', 'Batch Manager', 'batch', 'Batch Manager', 'Enable');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `role_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Locked','Unlocked') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Unlocked',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `status`) VALUES
(1, 'Webmaseter ', 'Locked'),
(2, 'Admin', 'Locked'),
(3, 'Manager', 'Locked'),
(4, 'Instructor', 'Locked'),
(5, 'Monitor (Sr. Student)', 'Unlocked');

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

DROP TABLE IF EXISTS `role_permissions`;
CREATE TABLE IF NOT EXISTS `role_permissions` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `role_id` int NOT NULL,
  `acl_id` int NOT NULL,
  `access` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `roleID_2` (`role_id`,`acl_id`),
  UNIQUE KEY `role_id` (`role_id`,`acl_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1752 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Role Permit ACL';

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`id`, `role_id`, `acl_id`, `access`) VALUES
(368, 1, 7, 1),
(369, 1, 1, 1),
(370, 1, 24, 1),
(371, 1, 9, 1),
(372, 1, 8, 1),
(373, 1, 5, 1),
(374, 1, 4, 1),
(375, 1, 3, 1),
(376, 1, 2, 1),
(377, 1, 6, 1),
(378, 1, 11, 1),
(379, 1, 21, 1),
(380, 1, 19, 1),
(381, 1, 23, 1),
(382, 1, 18, 1),
(383, 1, 17, 1),
(384, 1, 16, 1),
(385, 1, 15, 1),
(386, 1, 14, 1),
(387, 1, 20, 1),
(388, 1, 10, 1),
(389, 1, 12, 1),
(390, 1, 13, 1),
(391, 1, 141, 1),
(392, 1, 140, 1),
(393, 1, 139, 1),
(394, 1, 138, 1),
(395, 1, 137, 1),
(396, 1, 136, 1),
(397, 1, 142, 1),
(414, 1, 25, 1),
(415, 1, 26, 1),
(416, 1, 27, 1),
(417, 1, 28, 1),
(418, 1, 29, 1),
(419, 1, 30, 1),
(420, 1, 31, 1),
(421, 1, 32, 1),
(422, 1, 33, 1),
(423, 1, 34, 1),
(424, 1, 35, 1),
(425, 1, 36, 1),
(426, 1, 37, 1),
(427, 1, 38, 1),
(428, 1, 39, 1),
(429, 1, 40, 1),
(430, 1, 41, 1),
(431, 1, 42, 1),
(432, 1, 43, 1),
(434, 1, 45, 1),
(435, 1, 46, 1),
(436, 1, 47, 1),
(437, 1, 48, 1),
(438, 1, 49, 1),
(439, 1, 50, 1),
(440, 1, 51, 1),
(441, 1, 52, 1),
(442, 1, 53, 1),
(443, 1, 54, 1),
(444, 1, 55, 1),
(445, 1, 56, 1),
(446, 1, 57, 1),
(447, 1, 58, 1),
(448, 1, 59, 1),
(449, 1, 60, 1),
(450, 1, 61, 1),
(451, 1, 62, 1),
(452, 1, 63, 1),
(453, 1, 64, 1),
(454, 1, 65, 1),
(455, 1, 66, 1),
(456, 1, 67, 1),
(457, 1, 68, 1),
(458, 1, 69, 1),
(459, 1, 70, 1),
(460, 1, 71, 1),
(542, 1, 73, 1),
(561, 1, 75, 1),
(692, 1, 76, 1),
(747, 1, 77, 1),
(803, 1, 78, 1),
(890, 1, 79, 1),
(950, 3, 73, 1),
(951, 3, 7, 1),
(952, 3, 13, 1),
(953, 3, 12, 1),
(954, 3, 10, 1),
(955, 3, 70, 1),
(956, 3, 55, 1),
(957, 3, 31, 1),
(958, 3, 30, 1),
(959, 3, 29, 1),
(960, 3, 28, 1),
(961, 3, 27, 1),
(962, 3, 26, 1),
(963, 3, 25, 1),
(964, 3, 39, 1),
(965, 3, 75, 1),
(966, 3, 76, 1),
(967, 3, 78, 1),
(968, 3, 71, 1),
(969, 3, 77, 1),
(970, 3, 54, 1),
(971, 3, 53, 1),
(972, 3, 52, 1),
(973, 3, 51, 1),
(974, 3, 50, 1),
(975, 3, 49, 1),
(976, 3, 48, 1),
(977, 3, 47, 1),
(978, 3, 79, 1),
(979, 1, 80, 1),
(1104, 1, 88, 1),
(1223, 1, 89, 1),
(1224, 1, 90, 1),
(1225, 1, 91, 1),
(1226, 1, 92, 1),
(1227, 1, 93, 1),
(1228, 1, 94, 1),
(1229, 1, 95, 1),
(1230, 1, 96, 1),
(1231, 1, 97, 1),
(1232, 1, 98, 1),
(1233, 1, 99, 1),
(1234, 1, 100, 1),
(1235, 1, 101, 1),
(1238, 1, 104, 1),
(1240, 1, 106, 1),
(1301, 1, 107, 1),
(1302, 1, 108, 1),
(1303, 1, 109, 1),
(1306, 1, 112, 1),
(1308, 1, 114, 1),
(1408, 1, 115, 1),
(1450, 4, 7, 1),
(1451, 4, 73, 1),
(1452, 4, 13, 1),
(1453, 4, 12, 1),
(1454, 4, 10, 1),
(1455, 4, 95, 1),
(1456, 4, 94, 1),
(1457, 4, 93, 1),
(1458, 4, 92, 1),
(1459, 4, 91, 1),
(1460, 4, 90, 1),
(1461, 4, 89, 1),
(1462, 4, 98, 1),
(1463, 4, 97, 1),
(1464, 4, 104, 1),
(1465, 4, 101, 1),
(1466, 4, 100, 1),
(1467, 4, 99, 1),
(1468, 1, 116, 1),
(1554, 1, 117, 1),
(1599, 1, 118, 1),
(1645, 1, 119, 1),
(1692, 2, 73, 1),
(1693, 2, 7, 1),
(1694, 2, 1, 1),
(1695, 2, 24, 1),
(1696, 2, 9, 1),
(1697, 2, 8, 1),
(1698, 2, 4, 1),
(1699, 2, 3, 1),
(1700, 2, 21, 1),
(1701, 2, 6, 1),
(1702, 2, 11, 1),
(1703, 2, 13, 1),
(1704, 2, 12, 1),
(1705, 2, 10, 1),
(1706, 2, 46, 1),
(1707, 2, 45, 1),
(1708, 2, 43, 1),
(1709, 2, 42, 1),
(1710, 2, 41, 1),
(1711, 2, 40, 1),
(1712, 2, 80, 1),
(1713, 2, 117, 1),
(1714, 2, 116, 1),
(1715, 2, 95, 1),
(1716, 2, 94, 1),
(1717, 2, 93, 1),
(1718, 2, 92, 1),
(1719, 2, 91, 1),
(1720, 2, 90, 1),
(1721, 2, 89, 1),
(1722, 2, 96, 1),
(1723, 2, 97, 1),
(1724, 2, 98, 1),
(1725, 2, 115, 1),
(1726, 2, 119, 1),
(1727, 2, 106, 1),
(1728, 2, 101, 1),
(1729, 2, 104, 1),
(1730, 2, 99, 1),
(1731, 2, 100, 1),
(1732, 2, 118, 1),
(1733, 2, 107, 1),
(1734, 2, 114, 1),
(1735, 2, 112, 1),
(1736, 2, 108, 1),
(1737, 2, 109, 1),
(1738, 1, 120, 1),
(1739, 1, 121, 1),
(1740, 1, 122, 1),
(1741, 1, 123, 1),
(1742, 1, 124, 1),
(1743, 1, 125, 1),
(1744, 1, 126, 1),
(1745, 1, 127, 1),
(1746, 1, 128, 1),
(1747, 1, 129, 1),
(1748, 1, 130, 1),
(1749, 1, 131, 1),
(1750, 1, 132, 1),
(1751, 1, 133, 1);

-- --------------------------------------------------------

--
-- Table structure for table `service_areas`
--

DROP TABLE IF EXISTS `service_areas`;
CREATE TABLE IF NOT EXISTS `service_areas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `en_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bn_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_areas`
--

INSERT INTO `service_areas` (`id`, `en_name`, `bn_name`) VALUES
(1, 'Saradanga', 'সড়াডাঙ্গা'),
(2, 'Vatbila', 'ভাটবিলা'),
(4, 'Arpara', 'আড়পাড়া'),
(6, 'Chinatola', 'চিনাটোলা'),
(7, 'Mashiyahati', 'মশিয়াহাটি'),
(8, 'Manirampur', 'মনিরামপুর'),
(9, 'Bhulbariya', 'ভুলবাড়িয়া'),
(10, 'Kumarsima,Manirampur', 'কুমার সীমা , মনিরামপুর'),
(11, 'Nowapara', 'নওয়াপাড়া'),
(12, 'Khulna', 'খুলনা'),
(13, 'Kultiya', 'কুলটিয়া'),
(14, 'Purataal', 'পুড়াটাল'),
(15, 'Raajair Bazar', 'রাজৈর বাজার'),
(16, 'Shyamkur', 'শ্যামকুড়'),
(17, 'Mohanpur', 'মোহনপুর'),
(18, 'Sundali', 'সুন্দলী'),
(19, 'Bara Mitna', 'বড় মিতনা'),
(20, 'Harina', 'হরিনা'),
(21, 'Rundiya', 'রুন্দিয়া'),
(22, 'Baamanhaat', 'বামনহাট'),
(23, 'Kachuya, Bagerhaat', 'কচুয়া ,বাগেরহাট'),
(24, 'Saruliya,Patkelghaataa', 'সরুলিয়া, পাটকেলঘাটা'),
(25, 'Kayraa', 'কয়রা'),
(26, 'Naagarghop', 'নাগরঘোপ'),
(27, 'Haridaaskati', 'হরিদাসকাটি'),
(28, 'Panch Bariya', 'পাঁচবাড়িয়া'),
(29, 'Shyamnagar', 'শ্যামনগর'),
(30, 'Phulergaati', 'ফুলেরগাতী'),
(31, 'Gallamaari,Khulna', 'গল্লামারী,খুলনা'),
(34, 'Different Arears', 'বিভিন্ন অঞ্চল'),
(40, 'RSST', 'রামসরা ধাম'),
(42, 'Mahishdiya', 'মহিষদিয়া'),
(43, 'Lakhaidanga', 'লখাইডাঙ্গা'),
(44, 'Alipur', 'আলিপুর'),
(45, 'Bajekultiya', 'বাজেকুলটিয়া'),
(46, 'Kuchaliya', 'কুচলিয়া'),
(47, 'Magura Haat', 'মাগুরা হাট'),
(48, 'Narikel Baariyaa', 'নারিকেলবাড়ীয়া'),
(49, 'Nebugaati', 'নেবুগাতী'),
(50, 'Jiyadaanga', 'জিয়াডাঙ্গা'),
(51, 'Govindapur', 'গোবিন্দপুর'),
(52, 'Hogladanga', 'হোগলাডাঙ্গা'),
(53, 'Kaataakhaali', 'কাটাখালি ,মনিরামপুর'),
(54, 'Lauri', 'লাউড়ী'),
(55, 'Panchakari', 'পাাঁচাকড়ি'),
(56, 'Narikel Baariyaa', 'নারিকেলবাড়ীয়া'),
(57, 'Manoharpur', 'মনোহরপুর'),
(58, 'Jashore', 'যশোর'),
(59, 'রামসরা', 'Raamsaraa'),
(61, 'Satkshira', 'সাতক্ষীরা'),
(62, 'Magura', 'মাগুরা'),
(63, 'Akij Jute Mills Nowapara', 'আকিজ জুট মিলস নঃপাড়া'),
(64, 'Dhakuriya', 'ঢাকুরিয়া'),
(65, 'Razapur', 'রাজাপুর'),
(66, 'চেঙ্গুটিয়া', 'CHENGUTIYA'),
(67, 'ভাটপাড়া', 'Bhaatpaara'),
(68, 'Basundiya', 'বসুন্দিয়া'),
(69, 'ধোপাদী', 'Dhopadi'),
(70, 'Ramsara', 'রামসরা'),
(71, 'Chapakona', 'চাপাকোনা'),
(72, 'Baghutiya', 'বাঘুটিয়া'),
(73, 'Rupsa', 'রূপসা'),
(74, 'Pirojpur', 'পিরোজপুর'),
(75, 'Diyapur', 'দিয়াপুর'),
(76, 'Nehaalpur', 'নেহালপুর'),
(77, 'Sujatpur', 'সুজাতপুর'),
(78, 'Narail', 'নড়াইল'),
(79, 'Narail', 'নড়াইল'),
(80, 'Abhayanagar', 'অভয়নগর'),
(82, 'Rupdiya', 'রূপদিয়া'),
(83, 'Phultala', 'ফুলতলা'),
(84, 'Phultala', 'ফুলতলা'),
(86, 'Sharsha', 'শার্শা'),
(87, 'Geeta Academy', 'গীতা একাডেমি'),
(88, 'UTSAV UDYAPAN COMMITTEE,  RAMSARA DHAMM', 'উৎসব উদযাপন কমিটি, রামসরা ধাম'),
(89, 'Gabukhali', 'গাবুখালি'),
(93, 'Keshavpur', 'কেশবপুর'),
(96, 'Chuknagar', 'চুকনগর'),
(97, 'Bagharpara', 'বাঘারপাড়া'),
(98, 'Dhaka', 'ঢাকা'),
(99, 'Chinra', 'চিংড়া'),
(100, 'Sripur', 'শ্রীপুর'),
(101, 'Damortula', 'ডুমুরতলা');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `label` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `label` (`label`),
  UNIQUE KEY `label_2` (`label`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `label`, `value`) VALUES
(1, 'ComName', 'JMDS'),
(3, 'Address', 'Jahanarabad, Khulna'),
(4, 'Contact', '01713-900423');

-- --------------------------------------------------------

--
-- Table structure for table `sms_log`
--

DROP TABLE IF EXISTS `sms_log`;
CREATE TABLE IF NOT EXISTS `sms_log` (
  `id` int NOT NULL AUTO_INCREMENT,
  `donor_id` int NOT NULL,
  `phone` int NOT NULL,
  `body` varchar(750) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('TEXT','UNICODE') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` tinyint DEFAULT NULL,
  `respond` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('SUCCESS','FAIL') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` smallint DEFAULT NULL,
  `timestamp` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60429 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms_log`
--

INSERT INTO `sms_log` (`id`, `donor_id`, `phone`, `body`, `type`, `qty`, `respond`, `status`, `code`, `timestamp`) VALUES
(6, 58, 1714779964, 'Test SMS Send From Software\r\nNight 2:45 am\r\n\r\nDada I need SMS Body  for Received Money & New Registration', 'TEXT', 1, '{\"request_type\":\"SINGLE_SMS\",\"campaign_uid\":\"C5584321570046744\",\"sms_uid\":\"S7755841570049196\",\"invalid_numbers\":[],\"api_response_code\":200,\"api_response_message\":\"SUCCESS\"}', 'SUCCESS', NULL, '2019-10-03 02:46:37'),
(7, 97, 1713900423, 'হরে কৃষ্ণ। দণ্ডবৎ প্রনাম গ্রহণ করুন। আপনি শ্রী শ্রীরূপ-সনাতন স্মৃতি তীর্থের সেবা সংকল্প বিভাগে সম্মানিত সদস্য হিসেবে নিবন্ধিত হয়েছেন। নিবন্ধন নং: 97।  হরিবল।', 'UNICODE', 3, '{\"request_type\":\"SINGLE_SMS\",\"campaign_uid\":\"C4117471570133894\",\"sms_uid\":\"S7939571570133894\",\"invalid_numbers\":[],\"api_response_code\":200,\"api_response_message\":\"SUCCESS\"}', 'SUCCESS', NULL, '2019-10-04 02:18:15'),
(8, 97, 1713900423, 'হরে কৃষ্ণ। শ্রীশ্রী রূপ-সনাতন স্মৃতি তীর্থের সেবা সংকল্প বিভাগের পক্ষ থেকে  কৃষ্ণ প্রীতি গ্রহণ করুন । \r\nআপনার মাসিক প্রণামী  100 টাকা সাদরে গৃহীত হয়েছে।', 'UNICODE', 3, '{\"request_type\":\"SINGLE_SMS\",\"campaign_uid\":\"C4117471570133894\",\"sms_uid\":\"S4734891570136153\",\"invalid_numbers\":[],\"api_response_code\":200,\"api_response_message\":\"SUCCESS\"}', 'SUCCESS', NULL, '2019-10-04 02:55:54'),
(9, 98, 1711582895, 'হরে কৃষ্ণ। দণ্ডবৎ প্রনাম গ্রহণ করুন। আপনি শ্রীশ্রীরূপ-সনাতন স্মৃতি তীর্থের সেবা সংকল্প বিভাগে সম্মানিত সদস্য হিসেবে নিবন্ধিত হয়েছেন। নিবন্ধন নং: 98।  হরিবল।', 'UNICODE', 3, '{\"request_type\":\"SINGLE_SMS\",\"campaign_uid\":\"C4117471570133894\",\"sms_uid\":\"S8397511570155227\",\"invalid_numbers\":[],\"api_response_code\":200,\"api_response_message\":\"SUCCESS\"}', 'SUCCESS', NULL, '2019-10-04 08:13:47'),
(10, 99, 1712405163, 'হরে কৃষ্ণ। দণ্ডবৎ প্রনাম গ্রহণ করুন। আপনি শ্রীশ্রীরূপ-সনাতন স্মৃতি তীর্থের সেবা সংকল্প বিভাগে সম্মানিত সদস্য হিসেবে নিবন্ধিত হয়েছেন। নিবন্ধন নং: 99।  হরিবল।', 'UNICODE', 3, '{\"request_type\":\"SINGLE_SMS\",\"campaign_uid\":\"C4117471570133894\",\"sms_uid\":\"S0704181570155500\",\"invalid_numbers\":[],\"api_response_code\":200,\"api_response_message\":\"SUCCESS\"}', 'SUCCESS', NULL, '2019-10-04 08:18:21'),
(11, 98, 1711582895, 'হরে কৃষ্ণ। শ্রীশ্রী রূপ-সনাতন স্মৃতি তীর্থের সেবা সংকল্প বিভাগের পক্ষ থেকে  কৃষ্ণ প্রীতি গ্রহণ করুন । \r\nআপনার মাসিক প্রণামী 151 টাকা সাদরে গৃহীত হয়েছে।', 'UNICODE', 3, '{\"request_type\":\"SINGLE_SMS\",\"campaign_uid\":\"C4117471570133894\",\"sms_uid\":\"S7992521570155899\",\"invalid_numbers\":[],\"api_response_code\":200,\"api_response_message\":\"SUCCESS\"}', 'SUCCESS', NULL, '2019-10-04 08:24:59'),
(12, 99, 1712405163, 'হরে কৃষ্ণ। শ্রীশ্রী রূপ-সনাতন স্মৃতি তীর্থের সেবা সংকল্প বিভাগের পক্ষ থেকে  কৃষ্ণ প্রীতি গ্রহণ করুন । \r\nআপনার মাসিক প্রণামী 151 টাকা সাদরে গৃহীত হয়েছে।', 'UNICODE', 3, '{\"request_type\":\"SINGLE_SMS\",\"campaign_uid\":\"C4117471570133894\",\"sms_uid\":\"S1420011570155967\",\"invalid_numbers\":[],\"api_response_code\":200,\"api_response_message\":\"SUCCESS\"}', 'SUCCESS', NULL, '2019-10-04 08:26:08'),
(13, 30, 1777150751, 'হরে কৃষ্ণ। শ্রীশ্রী রূপ-সনাতন স্মৃতি তীর্থের সেবা সংকল্প বিভাগের পক্ষ থেকে  কৃষ্ণ প্রীতি গ্রহণ করুন । \r\nআপনার মাসিক প্রণামী 151 টাকা সাদরে গৃহীত হয়েছে।', 'UNICODE', 3, '{\"request_type\":\"SINGLE_SMS\",\"campaign_uid\":\"C4117471570133894\",\"sms_uid\":\"S5924091570156760\",\"invalid_numbers\":[],\"api_response_code\":200,\"api_response_message\":\"SUCCESS\"}', 'SUCCESS', NULL, '2019-10-04 08:39:20'),
(14, 25, 1719021741, 'হরে কৃষ্ণ। শ্রীশ্রী রূপ-সনাতন স্মৃতি তীর্থের সেবা সংকল্প বিভাগের পক্ষ থেকে  কৃষ্ণ প্রীতি গ্রহণ করুন । \r\nআপনার মাসিক প্রণামী 201 টাকা সাদরে গৃহীত হয়েছে।', 'UNICODE', 3, '{\"request_type\":\"SINGLE_SMS\",\"campaign_uid\":\"C4117471570133894\",\"sms_uid\":\"S8283991570157592\",\"invalid_numbers\":[],\"api_response_code\":200,\"api_response_message\":\"SUCCESS\"}', 'SUCCESS', NULL, '2019-10-04 08:53:13'),
(27, 100, 1765024037, 'হরে কৃষ্ণ। দণ্ডবৎ প্রনাম গ্রহণ করুন। আপনি শ্রীশ্রীরূপ-সনাতন স্মৃতি তীর্থের সেবা সংকল্প বিভাগে সম্মানিত সদস্য হিসেবে নিবন্ধিত হয়েছেন। নিবন্ধন নং: 90।  হরিবল।', 'UNICODE', 3, '{\"request_type\":\"SINGLE_SMS\",\"campaign_uid\":\"C1421161570349736\",\"sms_uid\":\"S6179911570349736\",\"invalid_numbers\":[],\"api_response_code\":200,\"api_response_message\":\"SUCCESS\"}', 'SUCCESS', NULL, '2019-10-06 14:15:37'),
(28, 101, 1715849832, 'হরে কৃষ্ণ। দণ্ডবৎ প্রনাম গ্রহণ করুন। আপনি শ্রীশ্রীরূপ-সনাতন স্মৃতি তীর্থের সেবা সংকল্প বিভাগে সম্মানিত সদস্য হিসেবে নিবন্ধিত হয়েছেন। নিবন্ধন নং: 91।  হরিবল।', 'UNICODE', 3, '{\"request_type\":\"SINGLE_SMS\",\"campaign_uid\":\"C1421161570349736\",\"sms_uid\":\"S6371271570350335\",\"invalid_numbers\":[],\"api_response_code\":200,\"api_response_message\":\"SUCCESS\"}', 'SUCCESS', NULL, '2019-10-06 14:25:35'),
(29, 57, 1716704277, 'Developer Testing BulK SMS\r\n01714779964 - বলদেব\r\n01713900423 - Kanny', 'UNICODE', 1, '{\"request_type\":\"GENERAL_CAMPAIGN\",\"campaign_uid\":\"C7051661570350554\",\"sms_uid\":null,\"invalid_numbers\":[],\"api_response_code\":200,\"api_response_message\":\"SUCCESS\"}', 'SUCCESS', NULL, '2019-10-06 14:29:14'),
(30, 97, 1713900423, 'Developer Testing BulK SMS\r\n01714779964 - বলদেব\r\n01713900423 - Kanny', 'UNICODE', 1, '{\"request_type\":\"GENERAL_CAMPAIGN\",\"campaign_uid\":\"C7051661570350554\",\"sms_uid\":null,\"invalid_numbers\":[],\"api_response_code\":200,\"api_response_message\":\"SUCCESS\"}', 'SUCCESS', NULL, '2019-10-06 14:29:14'),
(31, 102, 1724904968, 'হরে কৃষ্ণ। দণ্ডবৎ প্রনাম গ্রহণ করুন। আপনি শ্রীশ্রীরূপ-সনাতন স্মৃতি তীর্থের সেবা সংকল্প বিভাগে সম্মানিত সদস্য হিসেবে নিবন্ধিত হয়েছেন। নিবন্ধন নং: 92।  হরিবল।', 'UNICODE', 3, '{\"request_type\":\"SINGLE_SMS\",\"campaign_uid\":\"C1421161570349736\",\"sms_uid\":\"S0436061570350568\",\"invalid_numbers\":[],\"api_response_code\":200,\"api_response_message\":\"SUCCESS\"}', 'SUCCESS', NULL, '2019-10-06 14:29:29'),
(32, 100, 1765024037, 'হরে কৃষ্ণ। শ্রীশ্রী রূপ-সনাতন স্মৃতি তীর্থের সেবা সংকল্প বিভাগের পক্ষ থেকে  কৃষ্ণ প্রীতি গ্রহণ করুন । \r\nআপনার মাসিক প্রণামী 225 টাকা সাদরে গৃহীত হয়েছে।', 'UNICODE', 3, '{\"request_type\":\"SINGLE_SMS\",\"campaign_uid\":\"C1421161570349736\",\"sms_uid\":\"S3350001570350732\",\"invalid_numbers\":[],\"api_response_code\":200,\"api_response_message\":\"SUCCESS\"}', 'SUCCESS', NULL, '2019-10-06 14:32:13'),
(33, 102, 1724904968, 'হরে কৃষ্ণ। শ্রীশ্রী রূপ-সনাতন স্মৃতি তীর্থের সেবা সংকল্প বিভাগের পক্ষ থেকে  কৃষ্ণ প্রীতি গ্রহণ করুন । \r\nআপনার মাসিক প্রণামী 201 টাকা সাদরে গৃহীত হয়েছে।', 'UNICODE', 3, '{\"request_type\":\"SINGLE_SMS\",\"campaign_uid\":\"C1421161570349736\",\"sms_uid\":\"S7155771570350772\",\"invalid_numbers\":[],\"api_response_code\":200,\"api_response_message\":\"SUCCESS\"}', 'SUCCESS', NULL, '2019-10-06 14:32:53'),
(34, 101, 1715849832, 'হরে কৃষ্ণ। শ্রীশ্রী রূপ-সনাতন স্মৃতি তীর্থের সেবা সংকল্প বিভাগের পক্ষ থেকে  কৃষ্ণ প্রীতি গ্রহণ করুন । \r\nআপনার মাসিক প্রণামী 251 টাকা সাদরে গৃহীত হয়েছে।', 'UNICODE', 3, '{\"request_type\":\"SINGLE_SMS\",\"campaign_uid\":\"C1421161570349736\",\"sms_uid\":\"S2724421570350804\",\"invalid_numbers\":[],\"api_response_code\":200,\"api_response_message\":\"SUCCESS\"}', 'SUCCESS', NULL, '2019-10-06 14:33:25'),
(35, 103, 1631047170, 'হরে কৃষ্ণ। দণ্ডবৎ প্রনাম গ্রহণ করুন। আপনি শ্রীশ্রীরূপ-সনাতন স্মৃতি তীর্থের সেবা সংকল্প বিভাগে সম্মানিত সদস্য হিসেবে নিবন্ধিত হয়েছেন। নিবন্ধন নং: 93।  হরিবল।', 'UNICODE', 3, '{\"request_type\":\"SINGLE_SMS\",\"campaign_uid\":\"C1421161570349736\",\"sms_uid\":\"S2796201570358303\",\"invalid_numbers\":[],\"api_response_code\":200,\"api_response_message\":\"SUCCESS\"}', 'SUCCESS', NULL, '2019-10-06 16:38:23'),
(36, 103, 1631047170, 'হরে কৃষ্ণ। শ্রীশ্রী রূপ-সনাতন স্মৃতি তীর্থের সেবা সংকল্প বিভাগের পক্ষ থেকে  কৃষ্ণ প্রীতি গ্রহণ করুন । \r\nআপনার মাসিক প্রণামী 251 টাকা সাদরে গৃহীত হয়েছে।', 'UNICODE', 3, '{\"request_type\":\"SINGLE_SMS\",\"campaign_uid\":\"C1421161570349736\",\"sms_uid\":\"S7246531570358349\",\"invalid_numbers\":[],\"api_response_code\":200,\"api_response_message\":\"SUCCESS\"}', 'SUCCESS', NULL, '2019-10-06 16:39:09'),
(37, 104, 1747000700, 'হরে কৃষ্ণ। দণ্ডবৎ প্রনাম গ্রহণ করুন। আপনি শ্রীশ্রীরূপ-সনাতন স্মৃতি তীর্থের সেবা সংকল্প বিভাগে সম্মানিত সদস্য হিসেবে নিবন্ধিত হয়েছেন। নিবন্ধন নং: 94।  হরিবল।', 'UNICODE', 3, '{\"request_type\":\"SINGLE_SMS\",\"campaign_uid\":\"C1421161570349736\",\"sms_uid\":\"S7990731570372839\",\"invalid_numbers\":[],\"api_response_code\":200,\"api_response_message\":\"SUCCESS\"}', 'SUCCESS', NULL, '2019-10-06 20:40:40'),
(38, 104, 1747000700, 'হরে কৃষ্ণ। শ্রীশ্রী রূপ-সনাতন স্মৃতি তীর্থের সেবা সংকল্প বিভাগের পক্ষ থেকে  কৃষ্ণ প্রীতি গ্রহণ করুন । \r\nআপনার মাসিক প্রণামী 501 টাকা সাদরে গৃহীত হয়েছে।', 'UNICODE', 3, '{\"request_type\":\"SINGLE_SMS\",\"campaign_uid\":\"C1421161570349736\",\"sms_uid\":\"S6364871570372898\",\"invalid_numbers\":[],\"api_response_code\":200,\"api_response_message\":\"SUCCESS\"}', 'SUCCESS', NULL, '2019-10-06 20:41:39'),
(39, 105, 1783562171, 'হরে কৃষ্ণ। দণ্ডবৎ প্রনাম গ্রহণ করুন। আপনি শ্রীশ্রীরূপ-সনাতন স্মৃতি তীর্থের সেবা সংকল্প বিভাগে সম্মানিত সদস্য হিসেবে নিবন্ধিত হয়েছেন। নিবন্ধন নং: 95।  হরিবল।', 'UNICODE', 3, '{\"request_type\":\"SINGLE_SMS\",\"campaign_uid\":\"C3743601570456925\",\"sms_uid\":\"S6620481570456925\",\"invalid_numbers\":[],\"api_response_code\":200,\"api_response_message\":\"SUCCESS\"}', 'SUCCESS', NULL, '2019-10-07 20:02:05'),
(40, 105, 1783562171, 'হরে কৃষ্ণ। শ্রীশ্রী রূপ-সনাতন স্মৃতি তীর্থের সেবা সংকল্প বিভাগের পক্ষ থেকে  কৃষ্ণ প্রীতি গ্রহণ করুন । \r\nআপনার মাসিক প্রণামী 251 টাকা সাদরে গৃহীত হয়েছে।', 'UNICODE', 3, '{\"request_type\":\"SINGLE_SMS\",\"campaign_uid\":\"C3743601570456925\",\"sms_uid\":\"S8500111570456969\",\"invalid_numbers\":[],\"api_response_code\":200,\"api_response_message\":\"SUCCESS\"}', 'SUCCESS', NULL, '2019-10-07 20:02:50'),
(41, 38, 1731004880, 'হরে কৃষ্ণ। শ্রীশ্রী রূপ-সনাতন স্মৃতি তীর্থের সেবা সংকল্প বিভাগের পক্ষ থেকে  কৃষ্ণ প্রীতি গ্রহণ করুন । \r\nআপনার মাসিক প্রণামী 251 টাকা সাদরে গৃহীত হয়েছে।', 'UNICODE', 3, '{\"request_type\":\"SINGLE_SMS\",\"campaign_uid\":\"C3743601570456925\",\"sms_uid\":\"S2806701570464557\",\"invalid_numbers\":[],\"api_response_code\":200,\"api_response_message\":\"SUCCESS\"}', 'SUCCESS', NULL, '2019-10-07 22:09:19'),
(42, 32, 1713491195, 'হরে কৃষ্ণ। শ্রীশ্রী রূপ-সনাতন স্মৃতি তীর্থের সেবা সংকল্প বিভাগের পক্ষ থেকে  কৃষ্ণ প্রীতি গ্রহণ করুন । \r\nআপনার মাসিক প্রণামী 201 টাকা সাদরে গৃহীত হয়েছে।', 'UNICODE', 3, '{\"request_type\":\"SINGLE_SMS\",\"campaign_uid\":\"C3743601570456925\",\"sms_uid\":\"S1935231570465187\",\"invalid_numbers\":[],\"api_response_code\":200,\"api_response_message\":\"SUCCESS\"}', 'SUCCESS', NULL, '2019-10-07 22:19:48'),
(43, 31, 1713093631, 'হরে কৃষ্ণ। শ্রীশ্রী রূপ-সনাতন স্মৃতি তীর্থের সেবা সংকল্প বিভাগের পক্ষ থেকে  কৃষ্ণ প্রীতি গ্রহণ করুন । \r\nআপনার মাসিক প্রণামী 151 টাকা সাদরে গৃহীত হয়েছে।', 'UNICODE', 3, '{\"request_type\":\"SINGLE_SMS\",\"campaign_uid\":\"C3743601570456925\",\"sms_uid\":\"S5431841570465219\",\"invalid_numbers\":[],\"api_response_code\":200,\"api_response_message\":\"SUCCESS\"}', 'SUCCESS', NULL, '2019-10-07 22:20:34'),
(44, 33, 1718693727, 'হরে কৃষ্ণ। শ্রীশ্রী রূপ-সনাতন স্মৃতি তীর্থের সেবা সংকল্প বিভাগের পক্ষ থেকে  কৃষ্ণ প্রীতি গ্রহণ করুন । \r\nআপনার মাসিক প্রণামী 501 টাকা সাদরে গৃহীত হয়েছে।', 'UNICODE', 3, '{\"request_type\":\"SINGLE_SMS\",\"campaign_uid\":\"C3743601570456925\",\"sms_uid\":\"S0931711570465296\",\"invalid_numbers\":[],\"api_response_code\":200,\"api_response_message\":\"SUCCESS\"}', 'SUCCESS', NULL, '2019-10-07 22:21:36'),
(45, 107, 1726949128, 'হরে কৃষ্ণ। দণ্ডবৎ প্রনাম গ্রহণ করুন। আপনি শ্রীশ্রীরূপ-সনাতন স্মৃতি তীর্থের সেবা সংকল্প বিভাগে সম্মানিত সদস্য হিসেবে নিবন্ধিত হয়েছেন। নিবন্ধন নং: 96।  হরিবল।', 'UNICODE', 3, '{\"request_type\":\"SINGLE_SMS\",\"campaign_uid\":\"C5475861570811643\",\"sms_uid\":\"S3520051570811643\",\"invalid_numbers\":[],\"api_response_code\":200,\"api_response_message\":\"SUCCESS\"}', 'SUCCESS', NULL, '2019-10-11 22:34:04'),
(46, 108, 1731236939, 'হরে কৃষ্ণ। দণ্ডবৎ প্রনাম গ্রহণ করুন। আপনি শ্রীশ্রীরূপ-সনাতন স্মৃতি তীর্থের সেবা সংকল্প বিভাগে সম্মানিত সদস্য হিসেবে নিবন্ধিত হয়েছেন। নিবন্ধন নং: 97।  হরিবল।', 'UNICODE', 3, '{\"request_type\":\"SINGLE_SMS\",\"campaign_uid\":\"C5475861570811643\",\"sms_uid\":\"S6254801570811853\",\"invalid_numbers\":[],\"api_response_code\":200,\"api_response_message\":\"SUCCESS\"}', 'SUCCESS', NULL, '2019-10-11 22:37:33'),
(47, 107, 1726949128, 'হরে কৃষ্ণ। শ্রীশ্রী রূপ-সনাতন স্মৃতি তীর্থের সেবা সংকল্প বিভাগের পক্ষ থেকে  কৃষ্ণ প্রীতি গ্রহণ করুন । \r\nআপনার মাসিক প্রণামী 201 টাকা সাদরে গৃহীত হয়েছে।', 'UNICODE', 3, '{\"request_type\":\"SINGLE_SMS\",\"campaign_uid\":\"C5475861570811643\",\"sms_uid\":\"S1004431570811929\",\"invalid_numbers\":[],\"api_response_code\":200,\"api_response_message\":\"SUCCESS\"}', 'SUCCESS', NULL, '2019-10-11 22:38:49'),
(48, 108, 1731236939, 'হরে কৃষ্ণ। শ্রীশ্রী রূপ-সনাতন স্মৃতি তীর্থের সেবা সংকল্প বিভাগের পক্ষ থেকে  কৃষ্ণ প্রীতি গ্রহণ করুন । \r\nআপনার মাসিক প্রণামী 201 টাকা সাদরে গৃহীত হয়েছে।', 'UNICODE', 3, '{\"request_type\":\"SINGLE_SMS\",\"campaign_uid\":\"C5475861570811643\",\"sms_uid\":\"S6078031570811959\",\"invalid_numbers\":[],\"api_response_code\":200,\"api_response_message\":\"SUCCESS\"}', 'SUCCESS', NULL, '2019-10-11 22:39:20'),
(49, 99, 1712405163, 'হরে কৃষ্ণ। শ্রীশ্রী রূপ-সনাতন স্মৃতি তীর্থের সেবা সংকল্প বিভাগের পক্ষ থেকে  কৃষ্ণ প্রীতি গ্রহণ করুন । \r\nআপনার মাসিক প্রণামী 151 টাকা সাদরে গৃহীত হয়েছে।', 'UNICODE', 3, '{\"request_type\":\"SINGLE_SMS\",\"campaign_uid\":\"C5475861570811643\",\"sms_uid\":\"S1967821570812080\",\"invalid_numbers\":[],\"api_response_code\":200,\"api_response_message\":\"SUCCESS\"}', 'SUCCESS', NULL, '2019-10-11 22:41:20'),
(50, 106, 1917493249, 'হরে কৃষ্ণ। শ্রীশ্রী রূপ-সনাতন স্মৃতি তীর্থের সেবা সংকল্প বিভাগের পক্ষ থেকে  কৃষ্ণ প্রীতি গ্রহণ করুন । \r\nআপনার মাসিক প্রণামী 500 টাকা সাদরে গৃহীত হয়েছে।', 'UNICODE', 3, '{\"request_type\":\"SINGLE_SMS\",\"campaign_uid\":\"C5475861570811643\",\"sms_uid\":\"S1510361570812137\",\"invalid_numbers\":[],\"api_response_code\":200,\"api_response_message\":\"SUCCESS\"}', 'SUCCESS', NULL, '2019-10-11 22:42:17');

-- --------------------------------------------------------

--
-- Table structure for table `sms_templates`
--

DROP TABLE IF EXISTS `sms_templates`;
CREATE TABLE IF NOT EXISTS `sms_templates` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms_templates`
--

INSERT INTO `sms_templates` (`id`, `title`, `body`) VALUES
(1, 'On Registration:: Welcome SMS', 'Hare Krishna .\r\nAccept our obeisances.You have been registered as a member of Nitya Seva Department of RSST . Your reg. No. is: {rid}. Thanks -ISKCON RAMSARA'),
(2, 'On Receiving ::  Donation', 'HARE KRISHNA. \r\nYOUR DONATION  (PRANAAMI) TK {tk} WAS RECEIVED WITH THANKS.  \r\nISKCON RAMSARA');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role_id` int NOT NULL,
  `first_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `add_line1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `add_line2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `postcode` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` int DEFAULT NULL,
  `created` date DEFAULT NULL,
  `last_access` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_photo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Pending','Active','Inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `first_name`, `last_name`, `email`, `password`, `contact`, `dob`, `add_line1`, `add_line2`, `city`, `state`, `postcode`, `country_id`, `created`, `last_access`, `profile_photo`, `status`) VALUES
(1, 1, 'Developer', 'Account', 'developer@flickcms.com', '$2y$10$8ta1YSBvKiFQeeBfwcKkjeJbPcoNpNkFszvg0MpTBcj8SH/yQ.lte', '01713-900-423', '0000-00-00', 'Noapara', 'Abhoynagar', 'Jessore', 'Khulna', '7461', 17, '2016-11-11', '10/23/2016 1:10', NULL, 'Active'),
(3, 2, 'Baladev Pran', ' Das', 'bparey84@gmail.com', '$2y$10$HuF4t.u0Uo4dZjqa6cg2ouZQZvmD.Z6/YRWCnxOGNG2DeS/PhZq9.', '01714779964', '0000-00-00', 'Rupsanatan Shrity Tertho', '', 'Jessore', 'Khulna', '7460', 17, '2016-11-11', '', NULL, 'Active'),
(4, 4, 'Advaita Bhagaban ', 'Das', 'collector1@gmail.com', '$2y$10$NuNu57hYN5CBNgaka14LmeEytBdE1DUY8GKxK6GSho5PomWUrqw8C', ' 01981523567', '0000-00-00', 'Ramsara Dhaam', '', 'Jashore', '', '', 17, '2016-11-11', '', NULL, 'Active'),
(5, 4, 'Karuna', 'Sindhu', 'collector2@gmail.com', '$2y$10$qnxYjDqCgsXRKrKjR60XC.ZlUowiOYgu9dLUyQlSHfcgkgGYIm4ze', '01966032732', '0000-00-00', '', '', '', '', '', 17, '2018-08-30', '', NULL, 'Active'),
(6, 4, 'Achintya', 'Lila', 'collector3@gmail.com', '$2y$10$xzmc8bn.rTUHcBHlEJzviuYAY3w0KiT3P7ToHYY7W/ucwgfTs./RW', '01974047381', '0000-00-00', '', '', '', '', '', 17, '2018-08-30', '', NULL, 'Active'),
(7, 4, 'সুকৃতি', 'সরকার', 'karunajps57@gmail.com', '$2y$10$IZPspDwTJPnKbQDgpWA82OHdQk4JtqPCjS.dYdF4FY2zeoFI52VP.', '', '0000-00-00', ',Ramsara Dhaam', '', '', '', '', 17, '2018-08-30', '', NULL, 'Active'),
(8, 4, 'Anupam Chaitanya', 'Das', 'collector5@gmail.com', '$2y$10$J8DJi4FlcpG5dgCrkq0Qg.JG5ujPNYF4A4j4LnX2fc.gtKDaVTL7i', '', '0000-00-00', '', '', '', '', '', 17, '2018-08-30', '', NULL, 'Active'),
(9, 4, 'সিদ্ধিদাতা নৃসিংহ', 'দাস', 'collector6@gmail.com', '$2y$10$JAPwaA3Jj/sdNj9JcDJJoeX2H8qtLzAqoS/7TL1v9kiaazDX4dsPm', '01988486938', '0000-00-00', 'শ্রীশ্রী রূপ সনাতন স্মৃতি তীর্থ ', '', '', '', '', 17, '2018-08-30', '', NULL, 'Active'),
(10, 4, 'সর্বমঙ্গল গৌর ', 'দাস', 'collector7@gmail.com', '$2y$10$LEdfeQvSDk2TKkEzOIqS2e3cH56a2.uxjlAto1rPkgCHJUid6w6HC', '01912679729', '0000-00-00', 'শ্রীশ্রী রূপ সনাতন স্মৃতি তীর্থ ', '', '', '', '', 17, '2018-08-30', '', NULL, 'Active');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
