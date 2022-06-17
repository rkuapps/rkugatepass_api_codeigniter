-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2022 at 10:51 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rkugatepass`
--

-- --------------------------------------------------------

--
-- Table structure for table `rkuh_checkinout`
--

CREATE TABLE `rkuh_checkinout` (
  `id` bigint(20) NOT NULL,
  `userid` bigint(20) NOT NULL,
  `out_datetime` datetime NOT NULL,
  `in_datetime` datetime NOT NULL,
  `reason` varchar(255) NOT NULL,
  `action_datetime` datetime DEFAULT NULL,
  `action_by` bigint(20) DEFAULT NULL,
  `actual_out_datetime` datetime DEFAULT NULL,
  `actual_out_by` bigint(20) DEFAULT NULL,
  `actual_in_datetime` datetime DEFAULT NULL,
  `achual_in_by` bigint(20) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1 COMMENT '0-Rejected\r\n1-Pending\r\n2-Approved\r\n3-Out\r\n4-In\r\n5-Deleted',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` bigint(20) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rkuh_checkinout`
--

INSERT INTO `rkuh_checkinout` (`id`, `userid`, `out_datetime`, `in_datetime`, `reason`, `action_datetime`, `action_by`, `actual_out_datetime`, `actual_out_by`, `actual_in_datetime`, `achual_in_by`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(3, 1, '2021-08-13 10:07:40', '2021-08-13 20:07:40', 'To Issue Driving Licence', '2021-08-13 05:07:40', 2, '2021-10-27 23:27:43', 3, '2021-10-27 23:27:56', 3, 4, '2021-08-13 08:38:29', 1, '2021-10-27 17:57:56', 0, '0000-00-00 00:00:00', 0),
(4, 1, '2021-08-19 10:07:40', '2021-08-20 20:07:40', 'To process education loan and collect courior from rajkot bluedart office.', '2021-09-19 23:46:17', 2, '2021-08-18 09:41:05', 3, '2021-08-18 09:41:05', 4, 2, '2021-08-18 09:41:05', 1, '2021-09-19 19:12:31', 0, '2021-09-11 19:14:18', 1),
(5, 1, '2021-08-19 10:07:40', '2021-08-20 20:07:40', 'To Issue Driving Licence', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, 2, '2021-08-18 09:42:10', 1, '2021-09-19 19:12:31', 0, '2021-08-21 15:14:05', 1),
(6, 1, '2021-08-19 10:07:40', '2021-08-20 20:07:40', 'To Issue Driving Licence', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, 3, '2021-08-19 02:15:57', 1, '2021-09-19 19:12:31', 0, NULL, 1),
(7, 1, '2021-08-21 01:18:31', '2021-08-23 01:18:31', 'Bank Work', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, 4, '2021-08-19 15:49:10', 0, '2021-09-19 19:12:31', 0, NULL, 1),
(19, 1, '2021-08-13 10:07:40', '2021-08-13 20:07:40', 'To Issue Driving License', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, 1, '2021-09-11 02:59:21', 1, '2021-10-27 05:04:29', 0, '2021-09-11 19:03:24', 1),
(20, 1, '2021-08-13 10:07:40', '2021-08-13 20:07:40', 'To Issue Driving License', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, 1, '2021-09-11 03:42:16', 1, '2021-10-27 05:04:37', 0, '2021-09-11 19:05:01', 1),
(21, 1, '2021-08-13 10:07:40', '2021-08-13 20:07:40', 'To Issue Driving License', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, 1, '2021-09-11 03:42:18', 1, '2021-10-27 05:04:50', 0, '2021-09-11 19:06:19', 1),
(54, 7, '2021-09-23 10:30:00', '2021-09-24 07:31:00', 'health issues', '2021-09-20 07:34:41', 6, '2021-08-23 01:18:31', 3, '2021-08-23 01:18:31', 3, 4, '2021-09-19 22:01:44', 7, '2021-09-20 09:35:32', 0, NULL, 0),
(64, 10, '2021-09-24 11:49:00', '2021-09-27 11:49:00', 'Go to home', '2021-09-24 11:49:39', 2, '2021-09-24 11:50:01', 3, NULL, NULL, 3, '2021-09-24 02:19:21', 10, '2021-09-24 06:20:02', 0, NULL, 0),
(65, 11, '2021-09-24 11:54:00', '2021-09-24 11:54:00', 'To Issue Driving License', '2021-09-24 11:55:09', 2, '2021-09-24 11:55:26', 3, '2021-09-24 11:55:40', 3, 4, '2021-09-24 02:24:57', 11, '2021-10-27 05:06:28', 0, NULL, 0),
(66, 7, '2021-09-27 14:35:00', '2021-09-28 18:35:00', 'to attend function', '2021-09-24 16:36:35', 6, '2021-09-24 16:37:32', 3, '2021-09-24 16:39:03', 3, 4, '2021-09-24 07:06:12', 7, '2021-09-24 11:09:04', 0, NULL, 0),
(67, 1, '2021-09-28 10:53:00', '2021-09-29 10:53:00', 'To Issue Driving License', '2021-09-29 13:37:09', 2, NULL, NULL, NULL, NULL, 0, '2021-09-28 01:23:44', 1, '2021-10-27 05:05:28', 0, '2021-10-05 16:41:57', 1),
(68, 1, '2021-09-29 12:43:00', '2021-09-30 12:44:00', 'Shopping ', '2021-09-29 12:46:10', 2, '2021-09-29 12:48:59', 3, '2021-09-29 12:50:31', 3, 4, '2021-09-29 03:14:14', 1, '2021-09-29 07:20:32', 0, NULL, 0),
(69, 1, '2021-10-04 08:22:00', '2021-10-04 08:22:00', 'demo', '2021-10-05 12:42:47', 17, '2021-12-25 19:52:58', 3, '2022-01-08 11:02:31', 3, 4, '2021-10-03 22:52:51', 1, '2022-01-08 05:32:32', 0, NULL, 0),
(72, 13, '2021-10-06 15:05:00', '2021-10-08 15:15:00', 'shopping', '2021-10-14 09:31:39', 2, NULL, NULL, NULL, NULL, 2, '2021-10-05 03:36:02', 13, '2021-10-14 04:01:39', 0, NULL, 0),
(73, 13, '2021-10-21 14:07:00', '2021-10-13 15:07:00', 'To Issue Driving License', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, 1, '2021-10-05 03:38:23', 13, '2021-10-27 05:05:36', 0, '2021-10-05 17:08:29', 13),
(74, 18, '2021-10-17 12:00:00', '2021-10-17 17:30:00', 'Go For Blood Donation', '2021-10-14 09:31:35', 2, '2021-10-20 13:04:14', 22, NULL, NULL, 3, '2021-10-05 04:11:57', 18, '2021-10-26 08:25:46', 0, NULL, 0),
(83, 18, '2021-10-20 14:35:00', '2021-10-20 14:40:00', 'Getting the Driving Licence', '2021-10-12 14:36:16', 23, '2021-10-12 18:00:43', 22, NULL, NULL, 3, '2021-10-12 05:05:15', 18, '2021-10-26 08:24:52', 0, NULL, 0),
(84, 18, '2021-10-24 15:46:00', '2021-10-24 20:24:00', 'Go to Hospital', '2021-10-20 14:47:07', 23, NULL, NULL, NULL, NULL, 2, '2021-10-20 05:16:42', 18, '2021-10-26 08:28:59', 0, NULL, 0),
(85, 24, '2021-10-20 19:54:00', '2021-10-23 22:54:00', 'Go to Hospital', '2021-10-20 14:58:33', 23, '2021-10-20 14:58:54', 22, '2021-10-20 14:59:12', 22, 4, '2021-10-20 05:24:52', 24, '2021-10-26 08:32:58', 0, NULL, 0),
(90, 24, '2021-10-20 10:30:00', '2021-10-24 18:00:00', 'Go to Home', '2021-10-20 16:09:40', 23, '2021-10-20 16:10:53', 18, '2021-10-20 16:11:12', 18, 4, '2021-10-20 06:39:18', 24, '2021-10-26 08:34:11', 0, NULL, 0),
(93, 24, '2021-10-30 08:00:00', '2021-11-15 16:30:00', 'Diwali Vacation', '2021-10-20 16:53:54', 23, '2021-10-20 16:54:15', 18, '2021-10-20 16:54:32', 18, 4, '2021-10-20 07:23:37', 24, '2021-10-26 08:35:06', 0, NULL, 0),
(98, 18, '2021-10-05 12:00:00', '2021-10-10 20:24:00', 'Go For Science city Tour', '2021-10-28 10:27:27', 23, NULL, NULL, NULL, NULL, 2, '2021-10-26 04:28:15', 0, '2021-10-28 04:57:27', 0, NULL, 0),
(99, 18, '2021-10-30 20:00:00', '2021-11-20 07:30:00', 'Diwali Vacation Leave', '2021-10-28 10:25:13', 23, NULL, NULL, NULL, NULL, 2, '2021-10-26 04:30:21', 0, '2021-10-28 04:55:13', 0, NULL, 0),
(100, 7, '2021-10-28 15:17:00', '2021-10-29 15:17:00', 'Attending Function ', '2021-10-28 10:24:33', 23, NULL, NULL, NULL, NULL, 2, '2021-10-26 05:48:11', 7, '2021-10-28 04:54:34', 0, NULL, 0),
(101, 7, '2021-10-26 16:37:00', '2021-10-26 16:37:00', 'To Go home', '2021-10-26 16:38:47', 2, '2021-08-23 01:18:31', 3, '2021-08-23 01:18:31', 3, 4, '2021-10-26 07:08:10', 7, '2021-10-27 16:54:13', 0, NULL, 0),
(109, 24, '2021-10-28 16:29:00', '2021-10-29 16:29:00', 'Go To Surat', '2021-10-28 15:29:40', 23, '2021-10-28 15:30:03', 18, '2021-10-28 15:30:14', 18, 4, '2021-10-28 05:59:17', 24, '2021-10-28 10:00:14', 0, NULL, 0),
(110, 1, '2021-11-22 14:45:00', '2021-11-22 20:00:00', 'Parsal pickup', '2021-11-22 14:46:15', 25, NULL, NULL, NULL, NULL, 0, '2021-11-22 04:15:33', 1, '2022-01-08 05:31:49', 0, '2022-01-08 16:01:49', 1),
(111, 1, '2021-11-22 14:46:00', '2021-11-22 21:00:00', 'Movie', '2021-11-22 14:47:03', 25, '2021-11-22 14:48:07', 3, '2021-11-22 14:49:12', 3, 4, '2021-11-22 04:16:50', 1, '2021-11-22 09:19:15', 0, NULL, 0),
(112, 1, '2021-11-22 14:55:00', '2021-11-22 14:55:00', 'Marwadi, 9979936669', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, 1, '2021-11-22 04:25:13', 1, '2022-01-08 05:31:54', 0, '2022-01-08 16:01:54', 1),
(113, 1, '2022-01-08 11:03:00', '2022-01-08 06:29:00', 'pass', '2022-01-08 11:04:49', 2, NULL, NULL, NULL, NULL, 2, '2022-01-08 00:33:57', 1, '2022-01-08 05:34:50', 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `rkuh_users`
--

CREATE TABLE `rkuh_users` (
  `id` bigint(20) NOT NULL,
  `usertype` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0-Admin 1-Students 2-Security',
  `name` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `mobile` varchar(15) NOT NULL,
  `whatsapp` varchar(15) NOT NULL DEFAULT '0000000000' COMMENT 'Enter with country code',
  `enrollment` varchar(256) DEFAULT NULL,
  `branch` varchar(256) DEFAULT NULL,
  `p_mobile` varchar(15) NOT NULL DEFAULT '0000000000',
  `room_no` varchar(50) DEFAULT NULL,
  `status` varchar(20) DEFAULT '1' COMMENT '0-Inactive\r\n1-Active\r\n2-Special',
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `created_by` bigint(20) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_by` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rkuh_users`
--

INSERT INTO `rkuh_users` (`id`, `usertype`, `name`, `email`, `password`, `mobile`, `whatsapp`, `enrollment`, `branch`, `p_mobile`, `room_no`, `status`, `comment`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 1, 'Fenil Roy', 'jasmin.jasani@rku.ac.in', '123456', '9979936669', '9737536669', '11SOECA11011', 'SOE-MCA', '9988774455', '104', '1', '', '2021-10-27 17:43:20', NULL, '2021-10-27 17:43:20', 0, NULL, 0),
(2, 0, 'Admin Jasmin', 'jasanijasmink@gmail.com', '123456', '9979936669', '9737536669', '11SOECA11011', 'MCA', '9988774455', '104', '1', '', '2021-09-09 05:21:43', NULL, '2021-09-09 05:21:43', 0, NULL, 0),
(3, 2, 'Security Out', 'jjasani.gtu@gmail.com', '123456', '9979936669', '9737536669', '11SOECA11011', 'MCA', '9988774455', '104', '1', '', '2021-09-11 16:55:25', NULL, '2021-09-11 16:55:25', 0, NULL, 0),
(4, 2, 'Security In', 'jjasani303@rku.ac.in', NULL, '', '', NULL, NULL, '', NULL, '1', '', '2021-09-11 16:54:52', 1, '2021-09-11 16:54:52', 0, NULL, 0),
(5, 0, 'Amit Lathigra', 'amit.lathigara@rku.ac.in', NULL, '', '', NULL, NULL, '', NULL, '1', '', '2021-09-20 09:55:02', NULL, '2021-09-20 09:55:02', 0, NULL, 0),
(6, 0, 'Ashwin Rathod', 'ashwin.raiyani@rku.ac.in', NULL, '', '', NULL, NULL, '', NULL, '1', '', '2021-09-20 01:55:05', NULL, '2021-09-20 01:55:05', 0, NULL, 0),
(7, 1, 'Neha Chauhan', 'neha.chauhan@rku.ac.in', NULL, '9874563210', '9988774455', '11SOECE11011', 'SOE-B.Tech CE', '7894561230', 'GA-304', '1', '', '2021-10-26 09:50:03', NULL, '2021-10-26 09:50:03', 0, NULL, 0),
(10, 1, 'Umang Bagadaniya', 'ubagadaniya486@rku.ac.in', NULL, '', '', NULL, NULL, '', NULL, '1', '', '2021-09-24 06:18:06', NULL, '2021-09-24 06:18:06', 0, NULL, 0),
(11, 1, 'Sagar', 'srajvir330@rku.ac.in', NULL, '', '', NULL, NULL, '', NULL, '1', '', '2021-09-24 06:24:26', NULL, '2021-09-24 06:24:26', 0, NULL, 0),
(12, 1, 'Tanu Shrivastav', 'tshrivastav891@trku.ac.in', NULL, '', '', NULL, NULL, '', NULL, '1', '', '2021-09-29 07:09:05', NULL, '2021-09-29 07:09:05', 0, NULL, 0),
(13, 1, 'Kinjal Shah', 'kshah952@rku.ac.in', NULL, '', '', NULL, NULL, '', NULL, '1', '', '2021-09-29 07:11:33', NULL, '2021-09-29 07:11:33', 0, NULL, 0),
(14, 0, 'Dipen Vasoya', 'dvasoya580@rku.ac.in', NULL, '', '', NULL, NULL, '', NULL, '1', '', '2021-09-30 05:56:17', NULL, '2021-09-30 05:56:17', 0, NULL, 0),
(15, 0, 'Jevil Popat', 'jpopat892@rku.ac.in', NULL, '', '', NULL, NULL, '', NULL, '1', '', '2021-09-30 05:56:48', NULL, '2021-09-30 05:56:48', 0, NULL, 0),
(16, 0, 'Avni Trivedi', 'atrivedi779@rku.ac.in', NULL, '', '', NULL, NULL, '', NULL, '1', '', '2021-09-30 05:57:22', NULL, '2021-09-30 05:57:22', 0, NULL, 0),
(17, 0, 'Rahul Jagatiya', 'rjagetiya780@rku.ac.in', NULL, '', '', NULL, NULL, '', NULL, '1', '', '2021-10-05 07:10:22', NULL, '2021-10-05 07:10:22', 0, NULL, 0),
(18, 2, 'Pranav Kakadiya', 'pkakadiya274@rku.ac.in', '123456', '9568445215', '6358974125', '18SOECE11012', 'CE', '8951321324', 'BB-414', '1', '', '2021-10-28 05:01:16', NULL, '2021-10-28 05:01:16', 0, NULL, 0),
(20, 1, 'Disha Vaghela', 'dvaghela001@rku.ac.in', NULL, '', '', NULL, NULL, '', NULL, '1', '', '2021-10-26 04:00:10', NULL, '2021-10-26 04:00:10', 0, NULL, 0),
(21, 0, '', 'mchovatiya751@rku.ac.in', NULL, '', '', NULL, NULL, '', NULL, '1', '', '2021-10-14 04:50:39', NULL, '2021-10-14 04:50:39', 0, NULL, 0),
(23, 0, 'Vivek Chavda', 'vchavda464@rku.ac.in', NULL, '', '', NULL, NULL, '', NULL, '1', '', '2021-10-20 05:14:52', NULL, '2021-10-20 05:14:52', 0, NULL, 0),
(24, 1, 'Janvi Siddhpura', 'jsiddhpura829@rku.ac.in', '', '9988776655', '9987456321', '20SOECE13059', 'CE', '6565765656', 'GC-302', '1', '', '2021-10-26 03:56:33', NULL, '2021-10-26 03:56:33', 0, NULL, 0),
(25, 0, 'Shiraj Sunasara', 'shiraj.sunasara@rku.ac.in', NULL, '', '', NULL, NULL, '', NULL, '1', '', '2021-11-22 09:11:11', NULL, '2021-11-22 09:11:11', 0, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rkuh_checkinout`
--
ALTER TABLE `rkuh_checkinout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rkuh_users`
--
ALTER TABLE `rkuh_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rkuh_checkinout`
--
ALTER TABLE `rkuh_checkinout`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `rkuh_users`
--
ALTER TABLE `rkuh_users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
