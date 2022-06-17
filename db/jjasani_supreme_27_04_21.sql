-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 27, 2021 at 02:48 AM
-- Server version: 5.7.34
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jjasani_supreme`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_backup`
--

CREATE TABLE `tbl_backup` (
  `id` int(11) NOT NULL,
  `file_name` text,
  `created_by` int(11) NOT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_backup`
--

INSERT INTO `tbl_backup` (`id`, `file_name`, `created_by`, `created_on`) VALUES
(1, 'backup/sujata-07-02-21-03-13-47.zip', 1, '2021-02-07 09:43:47'),
(2, 'backup/sujata-07-02-21-03-14-57.zip', 1, '2021-02-07 09:44:57'),
(3, 'backup/SUPREME-19-03-21-05-31-05.zip', 1, '2021-03-19 12:01:11'),
(4, 'backup/SUPREME-23-03-21-06-47-29.zip', 1, '2021-03-23 13:17:29'),
(5, 'backup/SUPREME-23-03-21-07-21-52.zip', 1, '2021-03-23 13:51:52'),
(6, 'backup/SUPREME-25-03-21-03-13-44.zip', 5, '2021-03-25 09:43:44');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_company_management`
--

CREATE TABLE `tbl_company_management` (
  `id` int(11) NOT NULL,
  `company_code` varchar(20) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `gst_no` varchar(50) NOT NULL,
  `pan_no` varchar(20) NOT NULL,
  `tds_no` varchar(20) DEFAULT NULL,
  `address` text NOT NULL,
  `country` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `pincode` int(10) NOT NULL,
  `isdelete` tinyint(1) NOT NULL,
  `created_by` int(10) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(10) NOT NULL,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_company_management`
--

INSERT INTO `tbl_company_management` (`id`, `company_code`, `company_name`, `gst_no`, `pan_no`, `tds_no`, `address`, `country`, `state`, `city`, `pincode`, `isdelete`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(8, '', 'SUPREME INDUSTRIAL FASTENERS', '24ADHFS7085F1ZU', 'ADHFS7085F1ZU', 'RKTS12570F', 'Plot No.4043, 4044/4045, \r\nBypass Road, GIDC Phase III, \r\nGIDC Phase-2, Dared, Jamnagar, \r\nGujarat 361004, India.', '1', '24', 'Jamnagar', 361004, 0, 1, '2021-03-16 09:17:32', 1, '2021-03-25 09:02:11');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_company_person`
--

CREATE TABLE `tbl_company_person` (
  `id` int(11) NOT NULL,
  `company_id` int(10) NOT NULL,
  `name` varchar(155) NOT NULL,
  `email` varchar(50) NOT NULL,
  `designation` varchar(155) DEFAULT NULL,
  `contact_no` bigint(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `isdelete` tinyint(2) NOT NULL,
  `created_by` int(2) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(2) NOT NULL,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_company_person`
--

INSERT INTO `tbl_company_person` (`id`, `company_id`, `name`, `email`, `designation`, `contact_no`, `status`, `isdelete`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(12, 8, 'Aniruddh Dudhagara', 'supreme.fasteners@gmail.com', 'Admin Manager', 9712524646, '0', 0, 1, '2021-03-16 09:18:57', 1, '2021-03-25 09:03:17');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_country_master`
--

CREATE TABLE `tbl_country_master` (
  `id` int(11) NOT NULL,
  `country_name` varchar(100) NOT NULL,
  `short_name` varchar(100) NOT NULL,
  `isdelete` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_country_master`
--

INSERT INTO `tbl_country_master` (`id`, `country_name`, `short_name`, `isdelete`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(1, 'India', 'IND', 0, 1, '2020-11-06 14:57:42', 1, '2021-01-08 13:30:22'),
(2, 'France1', 'FR1', 1, 1, '2020-11-11 16:25:22', 1, '2020-11-11 21:57:46'),
(3, 'France', 'FR', 0, 1, '2020-11-11 18:12:29', 1, '2020-11-11 23:42:29'),
(4, 'Germany', 'GM', 0, 3, '2020-11-17 06:42:58', 3, '2020-11-17 12:12:58'),
(5, 'Spain', 'SP', 0, 2, '2020-11-22 11:02:59', 2, '2020-11-22 16:32:59'),
(6, 'Afghanistan', 'AFG', 0, 1, '2020-11-25 09:45:42', 1, '2020-11-25 15:15:42'),
(7, 'Åland Islands', 'ALA', 0, 1, '2020-11-25 09:45:42', 1, '2020-11-25 15:15:42'),
(8, 'Albania', 'ALB', 0, 1, '2020-11-25 09:45:42', 1, '2020-11-25 15:15:42'),
(9, 'Algeria', 'DZA', 0, 1, '2020-11-25 09:45:42', 1, '2020-11-25 15:15:42'),
(10, 'American Samoa', 'ASM', 0, 1, '2020-11-25 09:45:42', 1, '2020-11-25 15:15:42'),
(11, 'Andorra', 'AND', 0, 1, '2020-11-25 09:45:42', 1, '2020-11-25 15:15:42'),
(12, 'Angola', 'AGO', 0, 1, '2020-11-25 09:45:42', 1, '2020-11-25 15:15:42'),
(13, 'Anguilla', 'AIA', 0, 1, '2020-11-25 09:45:42', 1, '2020-11-25 15:15:42'),
(14, 'Antigua and Barbuda', 'ATG', 0, 1, '2020-11-25 09:45:42', 1, '2020-11-25 15:15:42'),
(15, 'Argentina', 'ARG', 0, 1, '2020-11-25 09:45:43', 1, '2020-11-25 15:15:43'),
(16, 'Armenia', 'ARM', 0, 1, '2020-11-25 09:45:43', 1, '2020-11-25 15:15:43'),
(17, 'Aruba', 'ABW', 0, 1, '2020-11-25 09:45:43', 1, '2020-11-25 15:15:43'),
(18, 'Australia', 'AUS', 0, 1, '2020-11-25 09:45:43', 1, '2020-11-25 15:15:43'),
(19, 'Austria', 'AUT', 0, 1, '2020-11-25 09:45:43', 1, '2020-11-25 15:15:43'),
(20, 'Azerbaijan', 'AZE', 0, 1, '2020-11-25 09:45:43', 1, '2020-11-25 15:15:43'),
(21, 'Bahamas', 'BHS', 0, 1, '2020-11-25 09:45:43', 1, '2020-11-25 15:15:43'),
(22, 'Bahrain', 'BHR', 0, 1, '2020-11-25 09:45:43', 1, '2020-11-25 15:15:43'),
(23, 'Bangladesh', 'BGD', 0, 1, '2020-11-25 09:45:43', 1, '2020-11-25 15:15:43'),
(24, 'Barbados', 'BRB', 0, 1, '2020-11-25 09:45:43', 1, '2020-11-25 15:15:43'),
(25, 'Belarus', 'BLR', 0, 1, '2020-11-25 09:45:43', 1, '2020-11-25 15:15:43'),
(26, 'Belgium', 'BEL', 0, 1, '2020-11-25 09:45:43', 1, '2020-11-25 15:15:43'),
(27, 'Belize', 'BLZ', 0, 1, '2020-11-25 09:45:43', 1, '2020-11-25 15:15:43'),
(28, 'Benin', 'BEN', 0, 1, '2020-11-25 09:45:43', 1, '2020-11-25 15:15:43'),
(29, 'Bermuda', 'BMU', 0, 1, '2020-11-25 09:45:43', 1, '2020-11-25 15:15:43'),
(30, 'Bhutan', 'BTN', 0, 1, '2020-11-25 09:45:43', 1, '2020-11-25 15:15:43'),
(31, 'Bolivia - Plurinational State of', 'BOL', 0, 1, '2020-11-25 09:45:43', 1, '2020-11-25 15:15:43'),
(32, 'Bonaire - Sint Eustatius and Saba', 'BES', 0, 1, '2020-11-25 09:45:43', 1, '2020-11-25 15:15:43'),
(33, 'Bosnia and Herzegovina', 'BIH', 0, 1, '2020-11-25 09:45:43', 1, '2020-11-25 15:15:43'),
(34, 'Botswana', 'BWA', 0, 1, '2020-11-25 09:45:43', 1, '2020-11-25 15:15:43'),
(35, 'Bouvet Island', 'BVT', 0, 1, '2020-11-25 09:45:43', 1, '2020-11-25 15:15:43'),
(36, 'Brazil', 'BRA', 0, 1, '2020-11-25 09:45:43', 1, '2020-11-25 15:15:43'),
(37, 'British Indian Ocean Territory', 'IOT', 0, 1, '2020-11-25 09:45:43', 1, '2020-11-25 15:15:43'),
(38, 'Brunei Darussalam', 'BRN', 0, 1, '2020-11-25 09:45:43', 1, '2020-11-25 15:15:43'),
(39, 'Bulgaria', 'BGR', 0, 1, '2020-11-25 09:45:43', 1, '2020-11-25 15:15:43'),
(40, 'Burkina Faso', 'BFA', 0, 1, '2020-11-25 09:45:43', 1, '2020-11-25 15:15:43'),
(41, 'Burundi', 'BDI', 0, 1, '2020-11-25 09:45:43', 1, '2020-11-25 15:15:43'),
(42, 'Cambodia', 'KHM', 0, 1, '2020-11-25 09:45:44', 1, '2020-11-25 15:15:44'),
(43, 'Cameroon', 'CMR', 0, 1, '2020-11-25 09:45:44', 1, '2020-11-25 15:15:44'),
(44, 'Canada', 'CAN', 0, 1, '2020-11-25 09:45:44', 1, '2020-11-25 15:15:44'),
(45, 'Cape Verde', 'CPV', 0, 1, '2020-11-25 09:45:44', 1, '2020-11-25 15:15:44'),
(46, 'Cayman Islands', 'CYM', 0, 1, '2020-11-25 09:45:44', 1, '2020-11-25 15:15:44'),
(47, 'Central African Republic', 'CAF', 0, 1, '2020-11-25 09:45:44', 1, '2020-11-25 15:15:44'),
(48, 'Chad', 'TCD', 0, 1, '2020-11-25 09:45:44', 1, '2020-11-25 15:15:44'),
(49, 'Chile', 'CHL', 0, 1, '2020-11-25 09:45:44', 1, '2020-11-25 15:15:44'),
(50, 'China', 'CHN', 0, 1, '2020-11-25 09:45:44', 1, '2020-11-25 15:15:44'),
(51, 'Christmas Island', 'CXR', 0, 1, '2020-11-25 09:45:44', 1, '2020-11-25 15:15:44'),
(52, 'Cocos (Keeling) Islands', 'CCK', 0, 1, '2020-11-25 09:45:44', 1, '2020-11-25 15:15:44'),
(53, 'Colombia', 'COL', 0, 1, '2020-11-25 09:45:44', 1, '2020-11-25 15:15:44'),
(54, 'Comoros', 'COM', 0, 1, '2020-11-25 09:45:44', 1, '2020-11-25 15:15:44'),
(55, 'Congo', 'COG', 0, 1, '2020-11-25 09:45:44', 1, '2020-11-25 15:15:44'),
(56, 'Congo - the Democratic Republic of the', 'COD', 0, 1, '2020-11-25 09:45:44', 1, '2020-11-25 15:15:44'),
(57, 'Cook Islands', 'COK', 0, 1, '2020-11-25 09:45:44', 1, '2020-11-25 15:15:44'),
(58, 'Costa Rica', 'CRI', 0, 1, '2020-11-25 09:45:44', 1, '2020-11-25 15:15:44'),
(59, 'Côte d\'Ivoire', 'CIV', 0, 1, '2020-11-25 09:45:44', 1, '2020-11-25 15:15:44'),
(60, 'Croatia', 'HRV', 0, 1, '2020-11-25 09:45:44', 1, '2020-11-25 15:15:44'),
(61, 'Cuba', 'CUB', 0, 1, '2020-11-25 09:45:44', 1, '2020-11-25 15:15:44'),
(62, 'Curaçao', 'CUW', 0, 1, '2020-11-25 09:45:44', 1, '2020-11-25 15:15:44'),
(63, 'Cyprus', 'CYP', 0, 1, '2020-11-25 09:45:44', 1, '2020-11-25 15:15:44'),
(64, 'Czech Republic', 'CZE', 0, 1, '2020-11-25 09:45:44', 1, '2020-11-25 15:15:44'),
(65, 'Denmark', 'DNK', 0, 1, '2020-11-25 09:45:44', 1, '2020-11-25 15:15:44'),
(66, 'Djibouti', 'DJI', 0, 1, '2020-11-25 09:45:44', 1, '2020-11-25 15:15:44'),
(67, 'Dominica', 'DMA', 0, 1, '2020-11-25 09:45:44', 1, '2020-11-25 15:15:44'),
(68, 'Dominican Republic', 'DOM', 0, 1, '2020-11-25 09:45:45', 1, '2020-11-25 15:15:45'),
(69, 'Ecuador', 'ECU', 0, 1, '2020-11-25 09:45:45', 1, '2020-11-25 15:15:45'),
(70, 'Egypt', 'EGY', 0, 1, '2020-11-25 09:45:45', 1, '2020-11-25 15:15:45'),
(71, 'El Salvador', 'SLV', 0, 1, '2020-11-25 09:45:45', 1, '2020-11-25 15:15:45'),
(72, 'Equatorial Guinea', 'GNQ', 0, 1, '2020-11-25 09:45:45', 1, '2020-11-25 15:15:45'),
(73, 'Eritrea', 'ERI', 0, 1, '2020-11-25 09:45:45', 1, '2020-11-25 15:15:45'),
(74, 'Estonia', 'EST', 0, 1, '2020-11-25 09:45:45', 1, '2020-11-25 15:15:45'),
(75, 'Ethiopia', 'ETH', 0, 1, '2020-11-25 09:45:45', 1, '2020-11-25 15:15:45'),
(76, 'Falkland Islands (Malvinas)', 'FLK', 0, 1, '2020-11-25 09:45:45', 1, '2020-11-25 15:15:45'),
(77, 'Faroe Islands', 'FRO', 0, 1, '2020-11-25 09:45:45', 1, '2020-11-25 15:15:45'),
(78, 'Fiji', 'FJI', 0, 1, '2020-11-25 09:45:45', 1, '2020-11-25 15:15:45'),
(79, 'Finland', 'FIN', 0, 1, '2020-11-25 09:45:45', 1, '2020-11-25 15:15:45'),
(80, 'French Guiana', 'GUF', 0, 1, '2020-11-25 09:45:45', 1, '2020-11-25 15:15:45'),
(81, 'French Polynesia', 'PYF', 0, 1, '2020-11-25 09:45:45', 1, '2020-11-25 15:15:45'),
(82, 'French Southern Territories', 'ATF', 0, 1, '2020-11-25 09:45:46', 1, '2020-11-25 15:15:46'),
(83, 'Gabon', 'GAB', 0, 1, '2020-11-25 09:45:46', 1, '2020-11-25 15:15:46'),
(84, 'Gambia', 'GMB', 0, 1, '2020-11-25 09:45:46', 1, '2020-11-25 15:15:46'),
(85, 'Georgia', 'GEO', 0, 1, '2020-11-25 09:45:46', 1, '2020-11-25 15:15:46'),
(86, 'Ghana', 'GHA', 0, 1, '2020-11-25 09:45:46', 1, '2020-11-25 15:15:46'),
(87, 'Gibraltar', 'GIB', 0, 1, '2020-11-25 09:45:46', 1, '2020-11-25 15:15:46'),
(88, 'Greece', 'GRC', 0, 1, '2020-11-25 09:45:46', 1, '2020-11-25 15:15:46'),
(89, 'Greenland', 'GRL', 0, 1, '2020-11-25 09:45:47', 1, '2020-11-25 15:15:47'),
(90, 'Grenada', 'GRD', 0, 1, '2020-11-25 09:45:47', 1, '2020-11-25 15:15:47'),
(91, 'Guadeloupe', 'GLP', 0, 1, '2020-11-25 09:45:47', 1, '2020-11-25 15:15:47'),
(92, 'Guam', 'GUM', 0, 1, '2020-11-25 09:45:47', 1, '2020-11-25 15:15:47'),
(93, 'Guatemala', 'GTM', 0, 1, '2020-11-25 09:45:47', 1, '2020-11-25 15:15:47'),
(94, 'Guernsey', 'GGY', 0, 1, '2020-11-25 09:45:47', 1, '2020-11-25 15:15:47'),
(95, 'Guinea', 'GIN', 0, 1, '2020-11-25 09:45:47', 1, '2020-11-25 15:15:47'),
(96, 'Guinea-Bissau', 'GNB', 0, 1, '2020-11-25 09:45:47', 1, '2020-11-25 15:15:47'),
(97, 'Guyana', 'GUY', 0, 1, '2020-11-25 09:45:47', 1, '2020-11-25 15:15:47'),
(98, 'Haiti', 'HTI', 0, 1, '2020-11-25 09:45:47', 1, '2020-11-25 15:15:47'),
(99, 'Heard Island and McDonald Islands', 'HMD', 0, 1, '2020-11-25 09:45:47', 1, '2020-11-25 15:15:47'),
(100, 'Holy See (Vatican City State)', 'VAT', 0, 1, '2020-11-25 09:45:47', 1, '2020-11-25 15:15:47'),
(101, 'Honduras', 'HND', 0, 1, '2020-11-25 09:45:47', 1, '2020-11-25 15:15:47'),
(102, 'Hong Kong', 'HKG', 0, 1, '2020-11-25 09:45:47', 1, '2020-11-25 15:15:47'),
(103, 'Hungary', 'HUN', 0, 1, '2020-11-25 09:45:47', 1, '2020-11-25 15:15:47'),
(104, 'Iceland', 'ISL', 0, 1, '2020-11-25 09:45:48', 1, '2020-11-25 15:15:48'),
(105, 'Indonesia', 'IDN', 0, 1, '2020-11-25 09:45:48', 1, '2020-11-25 15:15:48'),
(106, 'Iran - Islamic Republic of', 'IRN', 0, 1, '2020-11-25 09:45:48', 1, '2020-11-25 15:15:48'),
(107, 'Iraq', 'IRQ', 0, 1, '2020-11-25 09:45:48', 1, '2020-11-25 15:15:48'),
(108, 'Ireland', 'IRL', 0, 1, '2020-11-25 09:45:48', 1, '2020-11-25 15:15:48'),
(109, 'Isle of Man', 'IMN', 0, 1, '2020-11-25 09:45:48', 1, '2020-11-25 15:15:48'),
(110, 'Israel', 'ISR', 0, 1, '2020-11-25 09:45:48', 1, '2020-11-25 15:15:48'),
(111, 'Italy', 'ITA', 0, 1, '2020-11-25 09:45:48', 1, '2020-11-25 15:15:48'),
(112, 'Jamaica', 'JAM', 0, 1, '2020-11-25 09:45:49', 1, '2020-11-25 15:15:49'),
(113, 'Japan', 'JPN', 0, 1, '2020-11-25 09:45:49', 1, '2020-11-25 15:15:49'),
(114, 'Jersey', 'JEY', 0, 1, '2020-11-25 09:45:49', 1, '2020-11-25 15:15:49'),
(115, 'Jordan', 'JOR', 0, 1, '2020-11-25 09:45:49', 1, '2020-11-25 15:15:49'),
(116, 'Kazakhstan', 'KAZ', 0, 1, '2020-11-25 09:45:49', 1, '2020-11-25 15:15:49'),
(117, 'Kenya', 'KEN', 0, 1, '2020-11-25 09:45:49', 1, '2020-11-25 15:15:49'),
(118, 'Kiribati', 'KIR', 0, 1, '2020-11-25 09:45:49', 1, '2020-11-25 15:15:49'),
(119, 'Korea - Democratic People\'s Republic of', 'PRK', 0, 1, '2020-11-25 09:45:49', 1, '2020-11-25 15:15:49'),
(120, 'Korea - Republic of', 'KOR', 0, 1, '2020-11-25 09:45:49', 1, '2020-11-25 15:15:49'),
(121, 'Kuwait', 'KWT', 0, 1, '2020-11-25 09:45:50', 1, '2020-11-25 15:15:50'),
(122, 'Kyrgyzstan', 'KGZ', 0, 1, '2020-11-25 09:45:50', 1, '2020-11-25 15:15:50'),
(123, 'Lao People\'s Democratic Republic', 'LAO', 0, 1, '2020-11-25 09:45:50', 1, '2020-11-25 15:15:50'),
(124, 'Latvia', 'LVA', 0, 1, '2020-11-25 09:45:50', 1, '2020-11-25 15:15:50'),
(125, 'Lebanon', 'LBN', 0, 1, '2020-11-25 09:45:50', 1, '2020-11-25 15:15:50'),
(126, 'Lesotho', 'LSO', 0, 1, '2020-11-25 09:45:50', 1, '2020-11-25 15:15:50'),
(127, 'Liberia', 'LBR', 0, 1, '2020-11-25 09:45:50', 1, '2020-11-25 15:15:50'),
(128, 'Libya', 'LBY', 0, 1, '2020-11-25 09:45:50', 1, '2020-11-25 15:15:50'),
(129, 'Liechtenstein', 'LIE', 0, 1, '2020-11-25 09:45:50', 1, '2020-11-25 15:15:50'),
(130, 'Lithuania', 'LTU', 0, 1, '2020-11-25 09:45:50', 1, '2020-11-25 15:15:50'),
(131, 'Luxembourg', 'LUX', 0, 1, '2020-11-25 09:45:50', 1, '2020-11-25 15:15:50'),
(132, 'Macao', 'MAC', 0, 1, '2020-11-25 09:45:50', 1, '2020-11-25 15:15:50'),
(133, 'Macedonia - the former Yugoslav Republic of', 'MKD', 0, 1, '2020-11-25 09:45:50', 1, '2020-11-25 15:15:50'),
(134, 'Madagascar', 'MDG', 0, 1, '2020-11-25 09:45:50', 1, '2020-11-25 15:15:50'),
(135, 'Malawi', 'MWI', 0, 1, '2020-11-25 09:45:50', 1, '2020-11-25 15:15:50'),
(136, 'Malaysia', 'MYS', 0, 1, '2020-11-25 09:45:50', 1, '2020-11-25 15:15:50'),
(137, 'Maldives', 'MDV', 0, 1, '2020-11-25 09:45:50', 1, '2020-11-25 15:15:50'),
(138, 'Mali', 'MLI', 0, 1, '2020-11-25 09:45:50', 1, '2020-11-25 15:15:50'),
(139, 'Malta', 'MLT', 0, 1, '2020-11-25 09:45:50', 1, '2020-11-25 15:15:50'),
(140, 'Marshall Islands', 'MHL', 0, 1, '2020-11-25 09:45:50', 1, '2020-11-25 15:15:50'),
(141, 'Martinique', 'MTQ', 0, 1, '2020-11-25 09:45:50', 1, '2020-11-25 15:15:50'),
(142, 'Mauritania', 'MRT', 0, 1, '2020-11-25 09:45:50', 1, '2020-11-25 15:15:50'),
(143, 'Mauritius', 'MUS', 0, 1, '2020-11-25 09:45:50', 1, '2020-11-25 15:15:50'),
(144, 'Mayotte', 'MYT', 0, 1, '2020-11-25 09:45:50', 1, '2020-11-25 15:15:50'),
(145, 'Mexico', 'MEX', 0, 1, '2020-11-25 09:45:50', 1, '2020-11-25 15:15:50'),
(146, 'Micronesia - Federated States of', 'FSM', 0, 1, '2020-11-25 09:45:50', 1, '2020-11-25 15:15:50'),
(147, 'Moldova - Republic of', 'MDA', 0, 1, '2020-11-25 09:45:50', 1, '2020-11-25 15:15:50'),
(148, 'Monaco', 'MCO', 0, 1, '2020-11-25 09:45:50', 1, '2020-11-25 15:15:50'),
(149, 'Mongolia', 'MNG', 0, 1, '2020-11-25 09:45:50', 1, '2020-11-25 15:15:50'),
(150, 'Montenegro', 'MNE', 0, 1, '2020-11-25 09:45:50', 1, '2020-11-25 15:15:50'),
(151, 'Montserrat', 'MSR', 0, 1, '2020-11-25 09:45:50', 1, '2020-11-25 15:15:50'),
(152, 'Morocco', 'MAR', 0, 1, '2020-11-25 09:45:50', 1, '2020-11-25 15:15:50'),
(153, 'Mozambique', 'MOZ', 0, 1, '2020-11-25 09:45:50', 1, '2020-11-25 15:15:50'),
(154, 'Myanmar', 'MMR', 0, 1, '2020-11-25 09:45:50', 1, '2020-11-25 15:15:50'),
(155, 'Namibia', 'NAM', 0, 1, '2020-11-25 09:45:50', 1, '2020-11-25 15:15:50'),
(156, 'Nauru', 'NRU', 0, 1, '2020-11-25 09:45:50', 1, '2020-11-25 15:15:50'),
(157, 'Nepal', 'NPL', 0, 1, '2020-11-25 09:45:50', 1, '2020-11-25 15:15:50'),
(158, 'Netherlands', 'NLD', 0, 1, '2020-11-25 09:45:50', 1, '2020-11-25 15:15:50'),
(159, 'New Caledonia', 'NCL', 0, 1, '2020-11-25 09:45:50', 1, '2020-11-25 15:15:50'),
(160, 'New Zealand', 'NZL', 0, 1, '2020-11-25 09:45:50', 1, '2020-11-25 15:15:50'),
(161, 'Nicaragua', 'NIC', 0, 1, '2020-11-25 09:45:50', 1, '2020-11-25 15:15:50'),
(162, 'Niger', 'NER', 0, 1, '2020-11-25 09:45:50', 1, '2020-11-25 15:15:50'),
(163, 'Nigeria', 'NGA', 0, 1, '2020-11-25 09:45:50', 1, '2020-11-25 15:15:50'),
(164, 'Niue', 'NIU', 0, 1, '2020-11-25 09:45:50', 1, '2020-11-25 15:15:50'),
(165, 'Norfolk Island', 'NFK', 0, 1, '2020-11-25 09:45:51', 1, '2020-11-25 15:15:51'),
(166, 'Northern Mariana Islands', 'MNP', 0, 1, '2020-11-25 09:45:51', 1, '2020-11-25 15:15:51'),
(167, 'Norway', 'NOR', 0, 1, '2020-11-25 09:45:51', 1, '2020-11-25 15:15:51'),
(168, 'Oman', 'OMN', 0, 1, '2020-11-25 09:45:51', 1, '2020-11-25 15:15:51'),
(169, 'Pakistan', 'PAK', 0, 1, '2020-11-25 09:45:51', 1, '2020-11-25 15:15:51'),
(170, 'Palau', 'PLW', 0, 1, '2020-11-25 09:45:51', 1, '2020-11-25 15:15:51'),
(171, 'Palestine - State of', 'PSE', 0, 1, '2020-11-25 09:45:51', 1, '2020-11-25 15:15:51'),
(172, 'Panama', 'PAN', 0, 1, '2020-11-25 09:45:51', 1, '2020-11-25 15:15:51'),
(173, 'Papua New Guinea', 'PNG', 0, 1, '2020-11-25 09:45:51', 1, '2020-11-25 15:15:51'),
(174, 'Paraguay', 'PRY', 0, 1, '2020-11-25 09:45:51', 1, '2020-11-25 15:15:51'),
(175, 'Peru', 'PER', 0, 1, '2020-11-25 09:45:51', 1, '2020-11-25 15:15:51'),
(176, 'Philippines', 'PHL', 0, 1, '2020-11-25 09:45:51', 1, '2020-11-25 15:15:51'),
(177, 'Pitcairn', 'PCN', 0, 1, '2020-11-25 09:45:51', 1, '2020-11-25 15:15:51'),
(178, 'Poland', 'POL', 0, 1, '2020-11-25 09:45:51', 1, '2020-11-25 15:15:51'),
(179, 'Portugal', 'PRT', 0, 1, '2020-11-25 09:45:51', 1, '2020-11-25 15:15:51'),
(180, 'Puerto Rico', 'PRI', 0, 1, '2020-11-25 09:45:51', 1, '2020-11-25 15:15:51'),
(181, 'Qatar', 'QAT', 0, 1, '2020-11-25 09:45:51', 1, '2020-11-25 15:15:51'),
(182, 'Réunion', 'REU', 0, 1, '2020-11-25 09:45:51', 1, '2020-11-25 15:15:51'),
(183, 'Romania', 'ROU', 0, 1, '2020-11-25 09:45:51', 1, '2020-11-25 15:15:51'),
(184, 'Russian Federation', 'RUS', 0, 1, '2020-11-25 09:45:51', 1, '2020-11-25 15:15:51'),
(185, 'Rwanda', 'RWA', 0, 1, '2020-11-25 09:45:51', 1, '2020-11-25 15:15:51'),
(186, 'Saint Barthélemy', 'BLM', 0, 1, '2020-11-25 09:45:51', 1, '2020-11-25 15:15:51'),
(187, 'Saint Helena - Ascension and Tristan da Cunha', 'SHN', 0, 1, '2020-11-25 09:45:51', 1, '2020-11-25 15:15:51'),
(188, 'Saint Kitts and Nevis', 'KNA', 0, 1, '2020-11-25 09:45:51', 1, '2020-11-25 15:15:51'),
(189, 'Saint Lucia', 'LCA', 0, 1, '2020-11-25 09:45:51', 1, '2020-11-25 15:15:51'),
(190, 'Saint Martin (French part)', 'MAF', 0, 1, '2020-11-25 09:45:51', 1, '2020-11-25 15:15:51'),
(191, 'Saint Pierre and Miquelon', 'SPM', 0, 1, '2020-11-25 09:45:51', 1, '2020-11-25 15:15:51'),
(192, 'Saint Vincent and the Grenadines', 'VCT', 0, 1, '2020-11-25 09:45:51', 1, '2020-11-25 15:15:51'),
(193, 'Samoa', 'WSM', 0, 1, '2020-11-25 09:45:51', 1, '2020-11-25 15:15:51'),
(194, 'San Marino', 'SMR', 0, 1, '2020-11-25 09:45:51', 1, '2020-11-25 15:15:51'),
(195, 'Sao Tome and Principe', 'STP', 0, 1, '2020-11-25 09:45:51', 1, '2020-11-25 15:15:51'),
(196, 'Saudi Arabia', 'SAU', 0, 1, '2020-11-25 09:45:51', 1, '2020-11-25 15:15:51'),
(197, 'Senegal', 'SEN', 0, 1, '2020-11-25 09:45:52', 1, '2020-11-25 15:15:52'),
(198, 'Serbia', 'SRB', 0, 1, '2020-11-25 09:45:52', 1, '2020-11-25 15:15:52'),
(199, 'Seychelles', 'SYC', 0, 1, '2020-11-25 09:45:52', 1, '2020-11-25 15:15:52'),
(200, 'Sierra Leone', 'SLE', 0, 1, '2020-11-25 09:45:52', 1, '2020-11-25 15:15:52'),
(201, 'Singapore', 'SGP', 0, 1, '2020-11-25 09:45:52', 1, '2020-11-25 15:15:52'),
(202, 'Sint Maarten (Dutch part)', 'SXM', 0, 1, '2020-11-25 09:45:52', 1, '2020-11-25 15:15:52'),
(203, 'Slovakia', 'SVK', 0, 1, '2020-11-25 09:45:52', 1, '2020-11-25 15:15:52'),
(204, 'Slovenia', 'SVN', 0, 1, '2020-11-25 09:45:52', 1, '2020-11-25 15:15:52'),
(205, 'Solomon Islands', 'SLB', 0, 1, '2020-11-25 09:45:52', 1, '2020-11-25 15:15:52'),
(206, 'Somalia', 'SOM', 0, 1, '2020-11-25 09:45:52', 1, '2020-11-25 15:15:52'),
(207, 'South Africa', 'ZAF', 0, 1, '2020-11-25 09:45:52', 1, '2020-11-25 15:15:52'),
(208, 'South Georgia and the South Sandwich Islands', 'SGS', 0, 1, '2020-11-25 09:45:52', 1, '2020-11-25 15:15:52'),
(209, 'South Sudan', 'SSD', 0, 1, '2020-11-25 09:45:52', 1, '2020-11-25 15:15:52'),
(210, 'Sri Lanka', 'LKA', 0, 1, '2020-11-25 09:45:52', 1, '2020-11-25 15:15:52'),
(211, 'Sudan', 'SDN', 0, 1, '2020-11-25 09:45:52', 1, '2020-11-25 15:15:52'),
(212, 'Suriname', 'SUR', 0, 1, '2020-11-25 09:45:52', 1, '2020-11-25 15:15:52'),
(213, 'Swaziland', 'SWZ', 0, 1, '2020-11-25 09:45:52', 1, '2020-11-25 15:15:52'),
(214, 'Sweden', 'SWE', 0, 1, '2020-11-25 09:45:52', 1, '2020-11-25 15:15:52'),
(215, 'Switzerland', 'CHE', 0, 1, '2020-11-25 09:45:52', 1, '2020-11-25 15:15:52'),
(216, 'Syrian Arab Republic', 'SYR', 0, 1, '2020-11-25 09:45:52', 1, '2020-11-25 15:15:52'),
(217, 'Taiwan', 'TWN', 0, 1, '2020-11-25 09:45:52', 1, '2020-11-25 15:15:52'),
(218, 'Tajikistan', 'TJK', 0, 1, '2020-11-25 09:45:52', 1, '2020-11-25 15:15:52'),
(219, 'Tanzania - United Republic of', 'TZA', 0, 1, '2020-11-25 09:45:52', 1, '2020-11-25 15:15:52'),
(220, 'Thailand', 'THA', 0, 1, '2020-11-25 09:45:52', 1, '2020-11-25 15:15:52'),
(221, 'Timor-Leste', 'TLS', 0, 1, '2020-11-25 09:45:52', 1, '2020-11-25 15:15:52'),
(222, 'Togo', 'TGO', 0, 1, '2020-11-25 09:45:52', 1, '2020-11-25 15:15:52'),
(223, 'Tokelau', 'TKL', 0, 1, '2020-11-25 09:45:52', 1, '2020-11-25 15:15:52'),
(224, 'Tonga', 'TON', 0, 1, '2020-11-25 09:45:52', 1, '2020-11-25 15:15:52'),
(225, 'Trinidad and Tobago', 'TTO', 0, 1, '2020-11-25 09:45:52', 1, '2020-11-25 15:15:52'),
(226, 'Tunisia', 'TUN', 0, 1, '2020-11-25 09:45:52', 1, '2020-11-25 15:15:52'),
(227, 'Turkey', 'TUR', 0, 1, '2020-11-25 09:45:52', 1, '2020-11-25 15:15:52'),
(228, 'Turkmenistan', 'TKM', 0, 1, '2020-11-25 09:45:52', 1, '2020-11-25 15:15:52'),
(229, 'Turks and Caicos Islands', 'TCA', 0, 1, '2020-11-25 09:45:52', 1, '2020-11-25 15:15:52'),
(230, 'Tuvalu', 'TUV', 0, 1, '2020-11-25 09:45:53', 1, '2020-11-25 15:15:53'),
(231, 'Uganda', 'UGA', 0, 1, '2020-11-25 09:45:53', 1, '2020-11-25 15:15:53'),
(232, 'Ukraine', 'UKR', 0, 1, '2020-11-25 09:45:53', 1, '2020-11-25 15:15:53'),
(233, 'United Arab Emirates', 'ARE', 0, 1, '2020-11-25 09:45:53', 1, '2020-11-25 15:15:53'),
(234, 'United Kingdom', 'GBR', 0, 1, '2020-11-25 09:45:53', 1, '2020-11-25 15:15:53'),
(235, 'United States', 'USA', 0, 1, '2020-11-25 09:45:53', 1, '2020-11-25 15:15:53'),
(236, 'United States Minor Outlying Islands', 'UMI', 0, 1, '2020-11-25 09:45:53', 1, '2020-11-25 15:15:53'),
(237, 'Uruguay', 'URY', 0, 1, '2020-11-25 09:45:53', 1, '2020-11-25 15:15:53'),
(238, 'Uzbekistan', 'UZB', 0, 1, '2020-11-25 09:45:53', 1, '2020-11-25 15:15:53'),
(239, 'Vanuatu', 'VUT', 0, 1, '2020-11-25 09:45:53', 1, '2020-11-25 15:15:53'),
(240, 'Venezuela - Bolivarian Republic of', 'VEN', 0, 1, '2020-11-25 09:45:53', 1, '2020-11-25 15:15:53'),
(241, 'Viet Nam', 'VNM', 0, 1, '2020-11-25 09:45:53', 1, '2020-11-25 15:15:53'),
(242, 'Virgin Islands - British', 'VGB', 0, 1, '2020-11-25 09:45:53', 1, '2020-11-25 15:15:53'),
(243, 'Virgin Islands - U.S.', 'VIR', 0, 1, '2020-11-25 09:45:53', 1, '2020-11-25 15:15:53'),
(244, 'Wallis and Futuna', 'WLF', 0, 1, '2020-11-25 09:45:53', 1, '2020-11-25 15:15:53'),
(245, 'Yemen', 'YEM', 0, 1, '2020-11-25 09:45:53', 1, '2020-11-25 15:15:53'),
(246, 'Zambia', 'ZMB', 0, 1, '2020-11-25 09:45:53', 1, '2020-11-25 15:15:53'),
(247, 'Zimbabwe', 'ZWE', 0, 1, '2020-11-25 09:45:53', 1, '2020-11-25 15:15:53');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer_item`
--

CREATE TABLE `tbl_customer_item` (
  `id` int(11) NOT NULL,
  `customerid` int(11) NOT NULL,
  `item_category` int(11) NOT NULL,
  `item_subcategory` int(11) DEFAULT NULL,
  `unique_no` varchar(150) NOT NULL,
  `item_name` varchar(200) NOT NULL,
  `jw_itemname` varchar(50) DEFAULT NULL,
  `item_unit` int(10) DEFAULT NULL,
  `item_unit_value` varchar(20) DEFAULT NULL,
  `item_altunit` int(10) DEFAULT NULL,
  `item_altunit_value` varchar(20) DEFAULT NULL,
  `item_price` float(10,2) DEFAULT NULL,
  `net_weight` decimal(10,3) NOT NULL,
  `platting` varchar(100) NOT NULL,
  `opening_stock` int(10) DEFAULT NULL,
  `chno` varchar(200) DEFAULT NULL,
  `hsn_code` varchar(20) DEFAULT NULL,
  `description` text,
  `item_image` text NOT NULL,
  `item_detail` text,
  `unit_measurement` int(11) DEFAULT NULL,
  `isdelete` tinyint(1) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `drawing_no` int(11) DEFAULT NULL,
  `rawmaterial` int(20) DEFAULT NULL,
  `rivetweight` int(20) NOT NULL,
  `finalweight` int(20) NOT NULL,
  `packing` int(11) NOT NULL,
  `paramsize` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_customer_item`
--

INSERT INTO `tbl_customer_item` (`id`, `customerid`, `item_category`, `item_subcategory`, `unique_no`, `item_name`, `jw_itemname`, `item_unit`, `item_unit_value`, `item_altunit`, `item_altunit_value`, `item_price`, `net_weight`, `platting`, `opening_stock`, `chno`, `hsn_code`, `description`, `item_image`, `item_detail`, `unit_measurement`, `isdelete`, `created_by`, `created_on`, `updated_by`, `updated_on`, `drawing_no`, `rawmaterial`, `rivetweight`, `finalweight`, `packing`, `paramsize`) VALUES
(15, 13, 11, 5, 'CC606045', 'CA702 SELF THREADED SCREW FOR END CLAMP', NULL, NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, NULL, NULL, '', NULL, 0, 1, 1, '2021-03-23 14:04:27', 1, '2021-03-27 18:32:48', NULL, NULL, 0, 73, 0, 0),
(16, 12, 11, 4, 'XYZ1234321', 'brass bolt', NULL, NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, NULL, NULL, '', NULL, 0, 1, 1, '2021-03-25 10:32:00', 1, '2021-03-26 17:03:29', NULL, NULL, 0, 10, 0, 0),
(17, 11, 11, 5, 'VEW-01', 'PC M6 X 10 CHAMFER, MS SCREW', NULL, NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, NULL, NULL, '', NULL, 0, 0, 1, '2021-03-26 11:30:11', 1, '2021-03-26 17:00:11', NULL, NULL, 0, 232, 0, 0),
(18, 11, 11, 5, 'VEW-02', 'PC M6 X 8 CHAMFER, MS SCREW', NULL, NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, NULL, NULL, '', NULL, 0, 0, 1, '2021-03-26 11:30:43', 1, '2021-03-26 17:00:43', NULL, NULL, 0, 196, 0, 0),
(19, 11, 11, 5, 'VEW-03', 'CH POZI M5 X 7 CHAMFER, MS SCREW', NULL, NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, NULL, NULL, '', NULL, 0, 0, 1, '2021-03-26 11:31:08', 1, '2021-03-26 17:01:08', NULL, NULL, 0, 120, 0, 0),
(20, 11, 11, 5, 'VEW-04', 'CH M6 X 12 CHAMFER, MS SCREW', NULL, NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, NULL, NULL, '', NULL, 0, 0, 1, '2021-03-26 11:31:25', 1, '2021-03-26 17:01:25', NULL, NULL, 0, 292, 0, 0),
(21, 11, 11, 5, 'VEW-05', 'CH M8 X 12 CHAMFER, MS SCREW', NULL, NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, NULL, NULL, '', NULL, 0, 0, 1, '2021-03-26 11:31:41', 1, '2021-03-26 17:01:41', NULL, NULL, 0, 490, 0, 0),
(22, 11, 11, 5, 'VEW-06', 'CH POZI M4 X 8 MS SCREW', NULL, NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, NULL, NULL, '', NULL, 0, 0, 1, '2021-03-26 11:31:56', 1, '2021-03-26 17:01:56', NULL, NULL, 0, 88, 0, 0),
(23, 11, 11, 5, 'VEW-09', 'PC STD. M5 X 10 MS SCREW', NULL, NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, NULL, NULL, '', NULL, 0, 0, 1, '2021-03-26 11:32:14', 1, '2021-03-26 17:02:14', NULL, NULL, 0, 227, 0, 0),
(24, 11, 11, 4, 'VEW-10', 'HEX PHILIPS M5 X 7 RING TYPE, MS  BOLT', NULL, NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, NULL, NULL, '', NULL, 0, 0, 1, '2021-03-26 11:32:35', 1, '2021-03-26 17:02:35', NULL, NULL, 0, 196, 0, 0),
(25, 11, 11, 5, 'VEW-11', 'CH POZI M6 X 9.90 CHAMFER, MS SCREW', NULL, NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, NULL, NULL, '', NULL, 0, 0, 1, '2021-03-26 11:32:52', 1, '2021-03-26 17:02:52', NULL, NULL, 0, 227, 0, 0),
(26, 12, 11, 5, 'AI-0101', 'CH SMALL 8/32 X 4.50M MS SCREW', NULL, NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, NULL, NULL, '', NULL, 0, 0, 1, '2021-03-26 11:33:51', 1, '2021-03-26 17:03:51', NULL, NULL, 0, 71, 0, 0),
(27, 12, 11, 5, 'AI-0102', 'PC M4 X 6 CHAMFER, MS SCREW', NULL, NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, NULL, NULL, '', NULL, 0, 0, 1, '2021-03-26 11:34:12', 1, '2021-03-26 17:04:12', NULL, NULL, 0, 69, 0, 0),
(28, 12, 11, 5, 'AI-002', 'DIN 7985 BINDING PHILIPS M4 X 35 MS SCREW', NULL, NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, NULL, NULL, '', NULL, 0, 0, 1, '2021-03-26 11:34:30', 1, '2021-03-26 17:04:30', NULL, NULL, 0, 347, 0, 0),
(29, 12, 11, 4, 'AI-003', '1/4 X 20UNC X 16.50 MS CARRIAGE BOLT', NULL, NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, NULL, NULL, '', NULL, 0, 0, 1, '2021-03-26 11:34:47', 1, '2021-03-26 17:04:47', NULL, NULL, 0, 472, 0, 0),
(30, 12, 11, 5, 'AI-004', 'CHW M6 X 10 CHAMFER, MS SCREW', NULL, NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, NULL, NULL, '', NULL, 0, 0, 1, '2021-03-26 11:35:05', 1, '2021-03-26 17:05:05', NULL, NULL, 0, 500, 0, 0),
(31, 12, 11, 5, 'AI-005', 'BINDING PHILIPS M4 X 37 MS SCREW', NULL, NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, NULL, NULL, '', NULL, 0, 0, 1, '2021-03-26 11:35:24', 1, '2021-03-26 17:05:24', NULL, NULL, 0, 368, 0, 0),
(32, 16, 11, 4, '124524', 'MS BOLT-2.2mm', NULL, NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, NULL, NULL, '', NULL, 0, 0, 1, '2021-03-26 11:53:24', 1, '2021-03-26 17:23:24', NULL, NULL, 0, 0, 0, 0),
(33, 14, 10, 6, '1222', 'ch combi m4 x 8', NULL, NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '7318', NULL, '', NULL, 1, 0, 1, '2021-03-27 07:00:42', 1, '2021-03-27 12:30:42', NULL, NULL, 0, 150, 0, 0),
(34, 11, 11, 4, 'CC606046', 'CA702 SELF THREADED SCREW FOR END CLAMP2', NULL, NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '1245', NULL, '', NULL, 0, 1, 1, '2021-03-27 11:11:11', 1, '2021-04-22 08:33:17', NULL, NULL, 0, 72, 0, 0),
(35, 17, 11, 5, 'A7N00582091', 'TERMINAL SCREW M3.5 X 7.90MM - NEW PENTA SWITCH', 'CH M3.5 X 6 CHAMFER', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 0, 0, 1, '2021-03-27 11:48:20', 1, '2021-04-19 14:23:52', 0, 0, 0, 65, 0, 0),
(36, 17, 11, 5, 'A7N00585001', 'SCREW CH. COM 4 X 8MM P.P.', 'Ch Combi #4 x 8 B&#34;', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 0, 0, 1, '2021-03-27 12:02:12', 1, '2021-04-21 14:58:52', 0, 0, 0, 48, 0, 0),
(37, 17, 11, 5, 'A7N00503051', 'KNOB SCREW', NULL, NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 0, 0, 1, '2021-03-27 12:03:32', 1, '2021-03-27 17:33:32', NULL, NULL, 0, 11, 0, 0),
(38, 17, 11, 5, 'A7N00566002', 'L/N TERMINAL SCREW M4 X 6.10', 'Ch M4 x 6.10 Chamfer', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 0, 0, 1, '2021-03-27 12:04:44', 1, '2021-04-21 14:50:29', 0, 0, 0, 81, 0, 0),
(39, 17, 11, 5, 'A7N00580091', 'SCREW HEADED M4 X 6.70MM', NULL, NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 0, 0, 1, '2021-03-27 12:06:57', 1, '2021-03-27 17:36:57', NULL, NULL, 0, 74, 0, 0),
(40, 13, 11, 5, 'CC606045 Rev.5', 'CA702 MS SCREW PLTD', 'CH NO.4 X 16.50 POINT', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 0, 0, 1, '2021-03-27 13:02:04', 1, '2021-04-19 14:22:33', 0, 0, 0, 73, 0, 0),
(41, 17, 11, 5, 'A7N00579091', 'SCREW HEADED M4.00 X 7.80M', NULL, NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 0, 0, 1, '2021-03-28 06:26:41', 1, '2021-03-28 11:56:41', NULL, NULL, 0, 82, 0, 0),
(42, 17, 11, 5, 'A7N00578091', 'SCREW HEADED M4 X 6.20MM', NULL, NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 0, 0, 1, '2021-03-28 06:27:57', 1, '2021-03-28 11:57:57', NULL, NULL, 0, 72, 0, 0),
(43, 14, 10, 6, 'M3', 'MS WIRE', NULL, NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '7214', NULL, '', NULL, 1, 0, 1, '2021-03-30 09:18:36', 1, '2021-03-30 14:48:36', NULL, NULL, 0, 196, 0, 0),
(44, 18, 11, 5, 'SLBI-04', 'CH COMBI M5 X 12 CHAMFER, HARDENED, BORON STEEL SCREW       (8-10 µ 96 Hrs. SSY)', 'Ch Combi M5 x 12 Chamfer Boron', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 0, 0, 1, '2021-03-30 09:25:15', 1, '2021-04-20 15:04:26', 0, 0, 0, 191, 0, 0),
(45, 19, 11, 5, 'PDYL6771', 'CH POZI M5 X 10 CHAMFER, BREAK, MS SCREW', 'CH POZI M5 X 10 CHAMFER, BREAK, MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-15 11:06:42', 1, '2021-04-22 14:24:23', 0, 0, 0, 156, 0, 0),
(46, 19, 11, 5, 'PDYL7071', 'HEX COMBI RING TYAPE MC BOLT M6 X 16', NULL, NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-18 08:11:07', 1, '2021-04-18 13:43:46', 0, 0, 0, 445, 0, 0),
(47, 19, 11, 5, 'PDYL7068', 'PC M4 X 8 CHAMFER MS SCREW', NULL, NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-18 08:11:56', 1, '2021-04-18 13:44:00', 0, 0, 0, 110, 0, 0),
(48, 19, 11, 5, 'PDYL7070', 'HEX COMBI RING TYPE MS BOLT M8 X 20', NULL, NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-18 08:13:34', 1, '2021-04-18 13:44:14', 0, 0, 0, 1060, 0, 0),
(49, 19, 11, 5, 'PDYL VR-1', 'CH COMBI M5 X 8 CHAMFER MS SCREW', NULL, NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-18 08:15:17', 1, '2021-04-18 13:45:17', NULL, NULL, 0, 135, 0, 0),
(50, 20, 11, 5, 'PFTI-01', 'CH Slotted Rivet M5 X 12 MS', NULL, NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-18 08:48:28', 1, '2021-04-18 14:18:28', NULL, NULL, 0, 258, 0, 0),
(51, 21, 11, 5, 'RT.0', 'THREAD ROLLING DIE #4          #4X24TX16.5XPXAB>45           SECTION: 20X20X73.3X86.2', '1234', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '82073000', NULL, '', NULL, 2, 0, 1, '2021-04-18 10:15:16', 1, '2021-04-20 11:11:20', 0, 0, 0, 0, 0, 0),
(52, 21, 9, 8, 'Thread Rolling Die', '#4X24TX16.5X9XAB>45         Section: 20X20X73.3X86.2       RT.0', '1234', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '82073000', NULL, '', NULL, 2, 0, 1, '2021-04-18 10:29:35', 1, '2021-04-20 13:52:30', 0, 0, 0, 0, 0, 0),
(53, 22, 11, 7, '', 'WOOD SCREW OVAL HEAD #8 X 1&#34; 1/2 (MATERIAL: BRASS)', 'WOOD SCREW OVAL HEAD BRASS SCREW #8 X 1&#34; 1/2 (', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '74153390', NULL, '', NULL, 1, 0, 1, '2021-04-18 11:09:24', 1, '2021-04-24 11:50:59', 0, 0, 0, 450, 0, 0),
(54, 24, 11, 7, 'MI-008', 'SQUARE BOLT BRASS M4 X 13 CHAMFER, HALF THREADED', 'SQ. BOLT M4 X 13 CHAMFER, H.T. BRASS', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '74153390', NULL, '', NULL, 0, 0, 1, '2021-04-19 08:47:44', 1, '2021-04-19 14:17:58', 0, 0, 0, 185, 0, 0),
(55, 17, 11, 5, 'A7N00565002', 'E TERMINAL SCREW M4 X 7.10', 'CH M4 X 7.10 CHAMFER', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 0, 0, 1, '2021-04-19 08:55:41', 1, '2021-04-19 14:25:41', NULL, NULL, 0, 87, 0, 0),
(56, 25, 11, 5, 'E-00085178B', 'CH COMBI M3.5 X 6 CHAMFER, HARDENED, BORON STEEL SCREW', 'CH COMBI M3.5 X 6 HARDENING, BORON STEEL SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 0, 0, 1, '2021-04-19 09:06:41', 1, '2021-04-19 14:36:48', 0, 0, 0, 60, 0, 0),
(57, 26, 11, 5, '30-8644-2', '1/4 - 28.5 UNF - 2A NEUTRAL BAR SCREW  SC 40206 - 469-01', 'SQ. HEAD 1/4 X 11.45 RADIUS, MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 0, 0, 1, '2021-04-19 09:13:51', 1, '2021-04-19 14:43:51', NULL, NULL, 0, 273, 0, 0),
(58, 27, 11, 5, 'AP-01011', 'CH M4 X 7 RADIUS, MS SCREW  (6-8 MICRONS WHITE ZINC)', 'CH M4 X 7 RADIUS', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-20 02:22:58', 1, '2021-04-20 07:52:58', NULL, NULL, 0, 77, 0, 0),
(59, 27, 11, 5, 'AP-01027', 'CH COMBI M3 X 6 CHAMFER, MS SCREW   (YELLOW ZINC)', 'CH COMBI M3 X 6 CHAMFER, MS', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-20 02:24:18', 1, '2021-04-20 07:54:18', NULL, NULL, 0, 45, 0, 0),
(60, 27, 11, 5, 'AP-01010', 'CH M5 X 8.50 RADIUS, MS SCREW  (6-8 MICRONS WHITE ZINC)', 'CH M5 X 8.50 RADIUS, MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-20 02:29:21', 1, '2021-04-20 07:59:21', NULL, NULL, 0, 135, 0, 0),
(61, 22, 11, 5, 'AU-6/1', 'CH POZI BIG M6 X 10 CHAMFER, MS SCREW', 'CH POZI BIG M6 X 10 CHAMFER', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-20 02:41:23', 1, '2021-04-20 08:11:23', NULL, NULL, 0, 263, 0, 0),
(62, 22, 11, 5, 'DM-41/1', 'PC SP. M4 X 8 CHAMFER, MS SCREW', 'PC SP. M4 X 8 CHAMFER', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-20 02:42:48', 1, '2021-04-20 08:12:48', NULL, NULL, 0, 84, 0, 0),
(63, 28, 11, 5, 'RI-74 M4', 'CH POZI M4 X 8 RADIUS, MS SCREW   (6-8 MICRONS TRIVALENT BLUE)', 'CH POZI M4 X 8 RADIUS', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-20 02:54:52', 1, '2021-04-20 08:24:52', NULL, NULL, 0, 91, 0, 0),
(64, 29, 11, 5, 'SS-30', 'CH M6 X 27 MS SCREW  (NICKEL PLATED)', 'CH M6 X 27 MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-20 03:32:17', 1, '2021-04-20 09:02:17', NULL, NULL, 0, 662, 0, 0),
(65, 29, 11, 5, 'SS-07', 'CH 0BA X 1&#34; MS SCREW   (NICKEL PLATED)', 'CH 0BA X 1&#34; MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-20 03:33:53', 1, '2021-04-20 09:03:53', NULL, NULL, 0, 635, 0, 0),
(66, 29, 11, 5, 'SS-05', 'CH 0BA X 1/2 MS SCREW  (NICKEL PLATED)', 'CH 0BA X 1/2 MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-20 03:34:48', 1, '2021-04-20 09:10:31', 0, 0, 0, 420, 0, 0),
(67, 29, 11, 5, 'SS-06', 'CH 0BA X 3/8 MS SCREW  (NICKEL PLATED)', 'CH 0BA X 3/8 MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-20 03:35:43', 1, '2021-04-20 09:10:14', 0, 0, 0, 368, 0, 0),
(68, 27, 11, 5, 'AP-01005', 'CH COMBI M3 X 5 CHAMFER, MS SCREW   (YELLOW ZINC)', 'CH COMBI M3 X 5 CHAMFER, MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-20 03:43:01', 1, '2021-04-20 09:13:01', NULL, NULL, 0, 40, 0, 0),
(69, 11, 11, 5, 'VEW-12', 'CH COMBI M5 X 9 CHAMFER, MS SCREW  (WHITE ZINC)', 'CH COMBI M5 X 9 CHAMFER, MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-20 03:50:17', 1, '2021-04-20 09:22:40', 0, 0, 0, 148, 0, 0),
(70, 18, 11, 5, 'SLBI-08', 'CH COMBI M5 X 8 CHAMFER, MS SCREW  (6-8 MICRONS WHITE ZINC)', 'CH COMBI M5 X 8 CHAMFER, MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-20 03:56:20', 1, '2021-04-20 09:26:20', NULL, NULL, 0, 140, 0, 0),
(71, 27, 11, 5, 'AP-01015', 'CH M6 X 9.80 RADIUS, MS SCREW  (6-8 MICRONS WHITE ZINC)', 'CH M6 X 9.80 RADIUS, MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-20 04:02:12', 1, '2021-04-20 09:32:12', NULL, NULL, 0, 209, 0, 0),
(72, 27, 11, 5, 'AP-01014', 'CH M3.5 X 7 RADIUS, MS SCREW  (6-8 MICRONS WHITE ZINC)', 'CH M3.5 X 7 RADIUS, MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-20 04:05:53', 1, '2021-04-20 09:35:52', NULL, NULL, 0, 60, 0, 0),
(73, 30, 11, 5, '500002504/1', 'CH POZI M5 X 10 CHAMFER, HARDENED, BORON STEEL SCREW   (8-10 MICRONS 96 HOURS SSBT)', 'CH POZI M5 X 10 CHAMFER, BORON STEEL SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-20 04:17:56', 1, '2021-04-20 15:05:26', 0, 0, 0, 165, 0, 0),
(74, 30, 11, 5, '500000222', 'PC M6 X 10 CHAMFER, HARDENED, BORON STEEL SCREW   (8-10 MICRONS 96 HOURS SSBT)', 'PC M6 X 10 CHAMFER, BORON STEEL SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-20 04:19:40', 1, '2021-04-20 09:49:40', NULL, NULL, 0, 230, 0, 0),
(75, 31, 11, 5, 'MM-106', 'CH POZI M4 X 8 CHAMFER, MS SCREW  (YELLOW ZINC)', 'CH POZI M4 X 8 CHAMFER, MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-20 04:31:27', 1, '2021-04-20 10:01:27', NULL, NULL, 0, 92, 0, 0),
(76, 32, 11, 5, 'CI-002', 'CH SMALL M4.5 X 7.10 RADIUS, MS SCREW', 'CH SMALL M4.5 X 7.10 RADIUS, MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-20 04:39:31', 1, '2021-04-20 10:09:31', NULL, NULL, 0, 97, 0, 0),
(77, 19, 11, 5, 'PDYL6640 S1', 'CH POZI M4 X 10.10 CHAMFER, MS SCREW', 'CH POZI M4 X 10.10 CHAMFER, MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-20 04:43:27', 1, '2021-04-20 10:13:27', NULL, NULL, 0, 102, 0, 0),
(78, 19, 11, 5, 'PDYL6640 S2', 'CH POZI M4 X 8.10 CHAMFER, MS SCREW', 'CH POZI M4 X 8.10 CHAMFER, MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-20 04:45:13', 1, '2021-04-20 10:15:13', NULL, NULL, 0, 88, 0, 0),
(79, 23, 11, 5, 'PBWPL6904', 'HEX PHILIPS M6 X 15 MS SCREW', '1234', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 3, 0, 1, '2021-04-20 08:27:40', 1, '2021-04-20 13:57:40', NULL, NULL, 0, 600, 0, 0),
(80, 33, 10, 9, 'CuZn40', 'Brass Coil Wire 3.42 - 3.44 mm', '1234', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '74081910', NULL, '', NULL, 3, 0, 1, '2021-04-20 08:38:17', 1, '2021-04-20 14:09:57', 0, 0, 0, 250, 0, 0),
(81, 21, 9, 8, '', 'JMP + M30        Ø12', '1234', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '82073000', NULL, '', NULL, 0, 0, 1, '2021-04-20 08:46:15', 1, '2021-04-24 12:30:27', 0, 0, 0, 50, 0, 0),
(82, 21, 9, 8, 'Mold No. 105-144', 'COMBI PIN PUNCH Ø4.65', '1234', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '82073000', NULL, '', NULL, 0, 0, 1, '2021-04-20 08:51:05', 1, '2021-04-24 12:24:38', 0, 0, 0, 200, 0, 0),
(83, 34, 9, 8, 'As per drawing no. SIF-024', 'M4 Heading Machine Pointing Die', '1234', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '8466', NULL, '', NULL, 0, 0, 1, '2021-04-20 09:23:14', 1, '2021-04-20 14:53:14', NULL, NULL, 0, 1, 0, 0),
(84, 34, 9, 8, '', 'adf', 'asdf', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '', NULL, '', NULL, 0, 1, 1, '2021-04-20 09:44:48', 1, '2021-04-20 15:15:04', NULL, NULL, 0, 234, 0, 0),
(85, 36, 11, 5, '52SESCKNPS', 'PC #4 X 11.50 AB&#34; TYPE, HARDENED, MS SCREW (SAE-1018)', 'Pc #4 X 11.50 AB&#34; (1018)', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 0, 0, 1, '2021-04-20 09:58:42', 1, '2021-04-20 15:28:42', NULL, NULL, 0, 55, 0, 0),
(86, 37, 11, 5, '', 'CH M4 X 13.50 MS SCREW', 'CH M4 X 13.50 MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 3, 0, 1, '2021-04-22 02:43:46', 1, '2021-04-22 08:13:46', NULL, NULL, 0, 115, 0, 0),
(87, 37, 11, 5, 'PF-01', 'CHW M5 X 12 MS SCREW', 'CHW M5 X 12 MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 3, 0, 1, '2021-04-22 02:54:19', 1, '2021-04-22 08:24:19', NULL, NULL, 0, 140, 0, 0),
(88, 38, 12, 10, 'AN-002', 'JOB WORK OF ITEM, MATERIAL RECEIVED AGAINST CHALLAN NO. 786    CH COMBI M4 X 8 CHAMFER, BRASS SCREW', 'CH COMBI M4 X 8 CHAMFER, BRASS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '998933', NULL, '', NULL, 1, 0, 1, '2021-04-22 03:16:57', 1, '2021-04-22 08:46:57', NULL, NULL, 0, 104, 0, 0),
(89, 32, 11, 5, 'CI-005', 'CH SMALL M3.5 X 6.10 RADIUS, MS SCREW', 'CH M3.5 X 6.10 RADIUS, MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-22 04:49:14', 1, '2021-04-22 10:19:14', NULL, NULL, 0, 54, 0, 0),
(90, 39, 11, 5, 'II-0101', 'CH SP. M4 X 24 CHAMFER, HALF THREADED, MS SCREW', 'CH M4 X 24 CHAMFER, H.T. MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-22 05:27:22', 1, '2021-04-22 10:57:22', NULL, NULL, 0, 252, 0, 0),
(91, 28, 11, 5, 'RI-74 M5', 'CH POZI M5 X 8 RADIUS, MS SCREW (6-8 MICRONS TRIVALENT BLUE)', 'CH POZI M5 X 8 RADIUS, MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-22 05:35:02', 1, '2021-04-22 11:05:02', NULL, NULL, 0, 119, 0, 0),
(92, 40, 11, 5, 'PRAJ-18', 'CH POZI M3 X 6 RADIUS, MS SCREW   (8-10 MICRONS 96 HRS. SALT SPRAY YELLOW ZINC)', 'CH POZI M3 X 6 RADIUS, MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-22 08:16:12', 1, '2021-04-22 13:46:12', NULL, NULL, 0, 45, 0, 0),
(93, 22, 11, 5, 'AU-6/5', 'CH POZI M4 X 12 CHAMFER, MS SCREW', 'CH POZI M4 X 12 CHAMFER, MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-22 08:19:53', 1, '2021-04-22 13:49:53', NULL, NULL, 0, 148, 0, 0),
(94, 22, 11, 5, 'SP-50/1', 'PC M6 X 20 CHAMFER, MS SCREW', 'PC M6 X 20 CHAMFER, MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-22 08:20:51', 1, '2021-04-22 13:50:51', NULL, NULL, 0, 468, 0, 0),
(95, 22, 11, 5, 'SP-50/2', 'PC M6 X 22 MS SCREW', 'PC M6 X 22 MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-22 08:21:39', 1, '2021-04-22 13:51:39', NULL, NULL, 0, 535, 0, 0),
(96, 41, 11, 5, 'REP-514', 'CH POZI M5 X 14 CHAMFER, MS SCREW   (TRIVALENT BLUE)', 'CH POZI M5 X 14 CHAMFER, MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-22 08:29:43', 1, '2021-04-22 13:59:43', NULL, NULL, 0, 207, 0, 0),
(97, 41, 11, 5, 'REP-510', 'CH POZI M5 X 10 CHAMFER, MS SCREW  (TRIVALENT BLUE)', 'CH POZI M5 X 10 CHAMFER, MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-22 08:30:54', 1, '2021-04-22 14:00:54', NULL, NULL, 0, 161, 0, 0),
(98, 32, 11, 5, 'CI-006', 'CH M6 X 9.70 RADIUS, MS SCREW (YELLOW ZINC)', 'CH M6 X 9.70 RADIUS, MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-22 08:37:36', 1, '2021-04-22 14:07:36', NULL, NULL, 0, 220, 0, 0),
(99, 22, 11, 11, 'SE-001', 'MS HEX NUT M4', 'HEX NUT M4 MS', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-22 08:46:15', 1, '2021-04-22 14:16:15', NULL, NULL, 0, 59, 0, 0),
(100, 25, 11, 5, 'E-00073728C', 'CH M4 X 6.70 RADIUS, BORON STEEL SCREW', 'CH M4 X 6.70 RADIUS, BORON STEEL SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-22 08:49:47', 1, '2021-04-22 14:19:47', NULL, NULL, 0, 72, 0, 0),
(101, 37, 11, 5, 'PF-02', 'CHW M5 X 16 MS SCREW', 'CHW N5 X 16 MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-22 09:09:46', 1, '2021-04-22 14:39:46', NULL, NULL, 0, 160, 0, 0),
(102, 31, 11, 5, 'MM-101', 'CH POZI 1/4 X 10MM CHAMFER, MS SCREW (YELLOW ZINC)', 'CH POZI 1/4 X 10MM CHAMFER, MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-22 09:17:50', 1, '2021-04-22 14:47:50', NULL, NULL, 0, 256, 0, 0),
(103, 31, 11, 5, 'MM-102', 'CH M3.5 X 8 CHAMFER, MS SCREW  (YELLOW ZINC)', 'CH N3.5 X 8 CHAMFER, MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-22 09:19:18', 1, '2021-04-22 14:49:18', NULL, NULL, 0, 65, 0, 0),
(104, 19, 11, 5, 'PDYL VR-2', 'CH COMBI M5 X 9 CHAMFER, MS SCREW', 'CH COMBI M5 X 9 CHAMFER, MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-22 09:27:37', 1, '2021-04-22 14:57:37', NULL, NULL, 0, 145, 0, 0),
(105, 43, 11, 5, '3131-01', 'PC 1/4 X 9.90 CHAMFER, MS SCREW  (10-12 µ 120 HRS. SSBT)', 'PC 1/4 X 9.90 CHAMFER, MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-22 09:40:04', 1, '2021-04-22 15:10:04', NULL, NULL, 0, 254, 0, 0),
(106, 19, 11, 5, 'PDYL6774', 'CH POZI M5 X 8 CHAMFER, BREAK, BORON STEEL SCREW', 'CH POZI M5 X 8 CHAMFER, BREAK, BORON STEEL SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-22 09:45:05', 1, '2021-04-22 15:15:05', NULL, NULL, 0, 132, 0, 0),
(107, 22, 11, 5, 'CO-84/1', 'CH POZI M5 X 10 CHAMFER, BREAK, BORON STEEL SCREW', 'CH POZI M5 X 10 CHAMFER, BREAK, BORON STEEL SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-22 09:51:18', 1, '2021-04-22 15:21:18', NULL, NULL, 0, 184, 0, 0),
(108, 24, 11, 5, 'MI-004', 'CH M4 X 6.10 CHAMFER, MS SCREW (YELLOW ZINC)', 'CH M4 X 6.10 CHAMFER, MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-22 09:54:26', 1, '2021-04-22 15:24:26', NULL, NULL, 0, 81, 0, 0),
(109, 31, 11, 5, 'MM-110', 'CH POZI M4 X 8.50 SAL, MS SCREW (YELLOW ZINC)', 'CH POZI M4 X 8.50 SAL, MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-22 09:58:29', 1, '2021-04-22 15:28:29', NULL, NULL, 0, 90, 0, 0),
(110, 41, 11, 5, 'RT-001315', 'CH POZI M5 X 8 CHAMFER, MS SCREW  (WHITE ZINC)', 'CH POZI M5 X 8 CHAMFER, MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-22 10:40:35', 1, '2021-04-22 16:10:35', NULL, NULL, 0, 142, 0, 0),
(111, 32, 11, 5, 'CI-010', 'CH M4 X 6.10 CHAMFER, MS SCREW (YELLOW ZINC)', 'CH M4 X 6.10 CHAMFER, MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-22 10:44:45', 1, '2021-04-22 16:14:45', NULL, NULL, 0, 81, 0, 0),
(112, 32, 11, 5, 'CI-003', 'CH M4.5 X 5.60 RADIUS, MS SCREW', 'CH M4.5 X 5.60 RADIUS, MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-22 10:45:30', 1, '2021-04-22 16:15:30', NULL, NULL, 0, 80, 0, 0),
(113, 19, 11, 7, 'PDYL20102401', 'CH M4 X 8 BRASS SCREW', 'CHEESE HEAD M4 X 8 BRASS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '74153390', NULL, '', NULL, 1, 0, 1, '2021-04-22 10:55:53', 1, '2021-04-22 16:25:53', NULL, NULL, 0, 90, 0, 0),
(114, 22, 11, 5, 'AU-6/2', 'CH POZI M5 X 10 CHAMFER, MS SCREW', 'CH POZI BIG M5 X 10 CHAMFER, MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-22 12:01:04', 1, '2021-04-22 17:31:04', NULL, NULL, 0, 181, 0, 0),
(115, 20, 11, 5, '', 'CSK M5 X 12 MS SCREW', 'CSK M5 X 12 MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-24 05:08:44', 1, '2021-04-24 10:38:44', NULL, NULL, 0, 140, 0, 0),
(116, 20, 11, 5, '', 'CP M4 X 8 MS SCREW', 'CP M4 X 8 MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-24 05:11:01', 1, '2021-04-24 10:41:01', NULL, NULL, 0, 90, 0, 0),
(117, 24, 11, 7, '', 'CH COMBI WASHER HEAD M4 X 10 CHAMFER, GRUV, BRASS SCREW', 'CH COMBI WASHER M4 X 10 CHAMFER, GRUV, BRASS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '74153390', NULL, '', NULL, 1, 0, 1, '2021-04-24 05:24:41', 1, '2021-04-24 10:54:41', NULL, NULL, 0, 126, 0, 0),
(118, 43, 11, 5, '2970-01', 'CH POZI M4 X 8.10 CHAMFER, BREAK, MS SCREW', 'CH POZI M4 X 8.10 CHAMFER, BREAK, MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-24 05:28:33', 1, '2021-04-24 10:58:33', NULL, NULL, 0, 93, 0, 0),
(119, 20, 11, 5, '', 'CSK M5 X 15 MS SCREW', 'CSK M5 X 15 MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-24 05:49:40', 1, '2021-04-24 11:19:40', NULL, NULL, 0, 180, 0, 0),
(120, 20, 11, 5, '', 'PCW M4 X 8 MS SCREW', 'PCW M4 X 8 MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-24 06:03:53', 1, '2021-04-24 11:33:53', NULL, NULL, 0, 95, 0, 0),
(121, 20, 11, 5, '', 'PP M3.5 X 15 MS SCREW', 'PP M3.5 X 15 MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-24 06:04:34', 1, '2021-04-24 11:34:34', NULL, NULL, 0, 105, 0, 0),
(122, 20, 11, 5, '', 'CH M5 X 22 MS SCREW', 'CH M5 X 22 MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-24 06:05:15', 1, '2021-04-24 11:35:15', NULL, NULL, 0, 200, 0, 0),
(123, 45, 11, 7, '010-312-01', 'CH M4.5 X 8.50 RADIUS, BREAK, BRASS SCREW  (WITH WASHING)  (TC No. 35.1)', 'CH M4.5 X 8.50 RADIUS, BREAK, BRASS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '74153390', NULL, '', NULL, 1, 0, 1, '2021-04-25 09:05:59', 1, '2021-04-25 14:35:59', NULL, NULL, 0, 111, 0, 0),
(124, 35, 9, 8, 'TIN Coated Pin Punch', 'MG 110A  SQ(-)   SIZE: Ø7.22', '1234', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '82073000', NULL, '', NULL, 0, 0, 1, '2021-04-25 09:39:47', 1, '2021-04-25 15:15:52', 0, 0, 0, 0, 0, 0),
(125, 33, 10, 9, 'CuZn37', 'Coil Wire 5.22 - 5.24 mm', '1234', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '74081910', NULL, '', NULL, 3, 0, 1, '2021-04-25 09:50:50', 1, '2021-04-25 15:20:50', NULL, NULL, 0, 50, 0, 0),
(126, 47, 11, 5, 'PRAJ-18', 'CH POZI M3 X 6 RADIUS, MS SCREW   (8-10 MICRONS 96 HRS. SALT SPRAY YELLOW ZINC)', 'CH POZI M3 X 6 RADIUS, MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-25 10:40:16', 1, '2021-04-25 16:10:16', NULL, NULL, 0, 45, 0, 0),
(127, 48, 11, 5, 'A7N00578091', 'SCREW HEADED M4 X 6.20MM WITH YELLOW ZINC PASSIVATION', 'CH M4 X 6.20 CHAMFER, MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-25 11:06:36', 1, '2021-04-25 16:36:36', NULL, NULL, 0, 70, 0, 0),
(128, 48, 11, 5, 'A7N00579091', 'SCREW HEADED M4 X 7.80MM WITH YELLOW ZINC PASSIVATION', 'CHW M4 X 7.80 CHAMFER, MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-25 11:07:37', 1, '2021-04-25 16:37:37', NULL, NULL, 0, 87, 0, 0),
(129, 49, 11, 5, '', 'HEX BOLT M10 X 32MM  (AS PER DRAWING)', 'HEX BOLT M10 X 32MM', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-25 12:27:55', 1, '2021-04-25 17:57:55', NULL, NULL, 0, 1200, 0, 0),
(130, 22, 11, 5, '', 'PHILIPS HEAD M2.9 X 12MM, HARDENED, MS SCREW   (100 Pcs. Weight: 70 Grams)', 'PHILIPS HEAD M2.9 X 12MM, MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-26 04:17:31', 1, '2021-04-26 09:47:31', NULL, NULL, 0, 70, 0, 0),
(131, 22, 11, 5, '', 'PHILIPS HEAD M4.8 X 12MM, HARDENED, MS SCREW  (100 Pcs. Weight:190 Grams)', 'PHILIPS HEAD M4.8 X 12MM, MS SCREW', NULL, NULL, NULL, NULL, NULL, 0.000, '', NULL, NULL, '73181500', NULL, '', NULL, 1, 0, 1, '2021-04-26 04:19:34', 1, '2021-04-26 09:50:25', 0, 0, 0, 190, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer_item_sub`
--

CREATE TABLE `tbl_customer_item_sub` (
  `id` int(11) NOT NULL,
  `itemid` int(11) NOT NULL,
  `metal_name` varchar(255) NOT NULL,
  `part_type` varchar(255) NOT NULL,
  `part_name` varchar(255) NOT NULL,
  `weight` decimal(10,3) NOT NULL,
  `isdelete` tinyint(1) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_customer_item_sub`
--

INSERT INTO `tbl_customer_item_sub` (`id`, `itemid`, `metal_name`, `part_type`, `part_name`, `weight`, `isdelete`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(1, 1, 'Aluminium', 'abc', 'abc', 150.000, 0, NULL, '2021-03-08 12:27:28', NULL, NULL),
(2, 2, 'Ms', 'ms', 'ms', 300.000, 0, NULL, '2021-03-09 10:53:16', NULL, NULL),
(3, 2, 'Couper', 'couper', 'couper', 250.000, 0, NULL, '2021-03-09 10:53:16', NULL, NULL),
(4, 2, 'Couper', 'couper', 'couper', 150.000, 0, NULL, '2021-03-09 11:01:24', NULL, NULL),
(5, 2, 'Aluminium', 'abc', 'ac', 50.000, 0, NULL, '2021-03-09 11:05:56', NULL, NULL),
(6, 5, 'Ms', 'ms', 'ms', 149.000, 0, NULL, '2021-03-09 11:10:51', NULL, NULL),
(7, 6, 'Brass', '2', 'part', 20.000, 0, NULL, '2021-03-16 09:37:22', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer_management`
--

CREATE TABLE `tbl_customer_management` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `company_id` int(10) NOT NULL,
  `tds_no` varchar(20) DEFAULT NULL,
  `party_type` varchar(10) NOT NULL COMMENT '1-customer, 2-supplier',
  `pan_no` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `country` int(10) NOT NULL,
  `state` varchar(20) NOT NULL,
  `city` varchar(50) NOT NULL,
  `pincode` int(10) NOT NULL,
  `gst_no` varchar(30) NOT NULL,
  `cgst` int(10) NOT NULL,
  `sgst` int(10) NOT NULL,
  `igst` int(10) NOT NULL,
  `isdelete` tinyint(2) NOT NULL,
  `created_by` int(10) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(10) NOT NULL,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_customer_management`
--

INSERT INTO `tbl_customer_management` (`id`, `customer_name`, `company_id`, `tds_no`, `party_type`, `pan_no`, `address`, `country`, `state`, `city`, `pincode`, `gst_no`, `cgst`, `sgst`, `igst`, `isdelete`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(2, 'Keshvi Tools', 8, '', '', '544545', 'shapar road\r\nshapar', 248, '12', 'rajkot', 360024, '06AADCB2230M1ZX', 0, 0, 0, 1, 1, '2021-01-09 04:46:38', 1, '2021-03-18 18:21:34'),
(5, 'Harishrai & Co.', 8, '', '', 'AABCU9603R1ZM', '1220  Mill Street,\r\nATHOL, 66932', 12, '24', 'Rajeshwari', 587642, '24AABCU9603R1ZM', 0, 0, 0, 1, 1, '2021-01-26 06:16:22', 1, '2021-03-18 18:21:20'),
(10, 'Tata Pvt. LTD.', 8, '', '', 'MP12345B', 'Tata Pvt. LTD, Ramamurthy Nagar, Bangalore-560016', 25, '14', 'Nagar', 256125, '29AADCB2230M1ZP', 0, 0, 1, 1, 1, '2021-03-17 09:37:51', 1, '2021-03-17 16:17:22'),
(11, 'VAGADIYA ENGINEERING WORKS', 8, '', '1', 'AKBPR6867P', 'Shed No. 3396, E Road,\r\nNear Mahavir Circle, \r\nGIDC Phase -III, Dared,\r\nJamnagar - 361004', 1, '24', 'JAMNAGAR', 361004, '24AKBPR6867P1ZC', 9, 9, 0, 0, 1, '2021-03-18 12:53:50', 1, '2021-04-22 08:36:00'),
(12, 'ARVIND INDUSTRIES', 8, '', '1', 'ACTPP6152H', 'Plot No. 3990,\r\nGIDC Phase - 3, Dared,\r\nJamnagar - 361004.', 1, '24', 'Jamnagar', 361004, '24ACTPP6152H1Z8', 9, 9, 0, 0, 1, '2021-03-18 14:04:08', 1, '2021-03-26 16:58:04'),
(13, 'CONNECTWELL INDUSTRIES PRIVATE LIMITED', 8, '', '1', 'AAACC4125D', 'D-7, Phase-II, MIDC,\r\nDombivli (East) - 421204', 1, '27', 'DOMBIVLI', 421204, '27AAACC4125D1Z8', 0, 0, 18, 0, 1, '2021-03-23 13:59:11', 1, '2021-03-27 18:30:15'),
(14, 'SIDDHNATH FASTENERS', 8, '', '2', 'ACPPM1890F', 'PLOT NO. 4671/4672, \r\nG.I.D.C PHASE - 3, DARED, \r\nJAMNAGAR - 361004', 1, '24', 'Jamnagar', 361004, '24ACPPM1890F1ZG', 9, 9, 0, 1, 1, '2021-03-26 11:36:54', 1, '2021-04-18 15:35:23'),
(15, 'SPEEDWELL FASTENERS', 8, '', '2', 'AEDFS5652P', 'PLOT NO. E-45/46, \r\nG.I.D.C PHASE - 2, DARED, \r\nJAMNAGAR - 361004', 1, '24', 'Jamnagar', 361004, '24AEDFS5652P1ZI', 9, 9, 0, 1, 1, '2021-03-26 11:38:09', 1, '2021-04-18 15:35:20'),
(16, 'RAJ INDUSTRIES', 8, '', '1', 'AGYPS8481R', 'C-1/293, GIDC, Phase -2,\r\nDARED, JAMNAGAR - 361004', 1, '24', 'Jamnagar', 361004, '24AGYPS8481R1ZV', 9, 9, 0, 0, 1, '2021-03-26 11:48:01', 1, '2021-03-27 11:25:58'),
(17, 'PANASONIC LIFE SOLUTIONS INDIA PRIVATE LIMITED U-2', 8, '', '1', 'AAECA2190C', 'Unit -2, Plot No. 4, Sector 11, \r\nIIE, Sidcul, District Haridwar,\r\nHaridwar - 249403', 1, '05', 'Haridwar', 249403, '05AAECA2190C1Z9', 0, 0, 18, 0, 3, '2021-03-27 06:13:30', 1, '2021-04-14 17:48:25'),
(18, 'SHREE LAXMI BRASS INDUSTRIES', 8, '', '1', 'ADXFS1103N', 'Plot No. 614, G.I.D.C Phase- II,\r\nNear Patel Chowk, Jamnagar - 361004.', 1, '24', 'JAMNAGAR', 361004, '24ADXFS1103N1ZQ', 9, 9, 0, 0, 1, '2021-03-30 09:23:12', 1, '2021-03-30 14:53:12'),
(19, 'PRECISION BRASS WORKS PVT. LTD.', 8, '', '1', 'AAECP4265B', 'PLOT NO 3645-3646, N ROAD, GIDC PHASE-3,\r\nDARED, JAMNAGAR-361004', 1, '24', 'JAMNAGAR', 361004, '24AAECP4265B1ZS', 9, 9, 0, 0, 1, '2021-04-15 10:58:23', 1, '2021-04-18 14:36:49'),
(20, 'PRECISION FAST TECH INDIA', 8, '', '1', 'AAVFP3676Q', 'Plot No. 3917, W Road,\r\nGIDC Phase - III, \r\nDared, Jamnagar - 361004', 1, '24', 'Jamnagar', 361004, '24AAVFP3676Q1Z5', 9, 9, 0, 0, 1, '2021-04-18 08:43:00', 1, '2021-04-18 14:13:00'),
(21, 'M K THAKKER', 8, '', '2', '', 'Udit Mittal Estate, Unit - B- 145,\r\nBuilding No.6, Andheri Kurla Road,\r\nMarol Naka, Andheri (East).', 1, '24', 'Mumbai', 400059, '', 9, 9, 18, 0, 1, '2021-04-18 10:09:05', 1, '2021-04-18 20:38:16'),
(22, 'SHREE EXPORT', 8, '', '1', 'ABMFS6330C', 'Plot No. 3067, Road No.5,\r\nGIDC Phase - III,\r\nDared, Jamnagar - 361004.', 1, '24', 'Jamnagar', 361004, '24ABMFS6330C1ZD', 9, 9, 0, 0, 1, '2021-04-18 11:03:04', 1, '2021-04-18 16:33:04'),
(23, 'PRECISION FASTTECH INDIA', 8, '', '2', 'AAVFP3676Q', 'Plot No. 3917, W Road, GIDC,\r\nPhase - 3 Dared, Jamnagar - 361004', 1, '24', 'Jamnagar', 361004, '24AAVFP3676Q1Z5', 9, 9, 0, 0, 1, '2021-04-18 13:17:18', 1, '2021-04-18 18:47:18'),
(24, 'MEERA IMPEX', 8, '', '1', 'AAZFM9699L', 'Plot No. 4013, 4014, 4037, 4038,\r\nGIDC Phase-III,\r\nDared, Jamnagar - 361004', 1, '24', 'Jamnagar', 361004, '24AAZFM9699L1ZV', 9, 9, 0, 0, 1, '2021-04-19 08:40:31', 1, '2021-04-19 14:10:31'),
(25, 'JSK ELECTRICALS PRIVATE LIMITED', 8, '', '1', 'AACCJ0539J', 'Plot No. 42, 1/2 of 43 & 44B, EPP Phase - 1,\r\nJharmajri, Tehsil - Nalagarh,\r\nBaddi, District Solan - 173205', 1, '02', 'Baddi', 173205, '02AACCJ0539J1ZW', 0, 0, 18, 0, 1, '2021-04-19 09:01:54', 1, '2021-04-19 14:31:54'),
(26, 'JAYNIX ENGINEERING PRIVATE LIMITED', 8, '', '1', 'AABCJ9778J', 'Plot No. F-98, \r\nMIDC Satpur,\r\nNASIK - 422007', 1, '27', 'Nasik', 422007, '27AABCJ9778J1ZU', 0, 0, 18, 0, 1, '2021-04-19 09:10:13', 1, '2021-04-19 14:40:13'),
(27, 'LATON CONNEXIONS', 8, '', '1', 'AAEFL8154E', 'Plot No. 354/2, GIDC,\r\nShanker Tekri Udyog Nagar,\r\nJamnagar - 361004', 1, '24', 'Jamnagar', 361004, '24AAEFL8154E1ZG', 9, 9, 0, 0, 1, '2021-04-20 02:16:44', 1, '2021-04-20 07:46:44'),
(28, 'RANJIT INDUSTRIES', 8, '', '1', 'AAEFR0335B', 'Plot No. 4028, \r\nGIDC Phase-III,\r\nDared, Jamnagar-361004', 1, '24', 'Jamnagar', 361004, '24AAEFR0335B1ZX', 9, 9, 0, 0, 1, '2021-04-20 02:50:33', 1, '2021-04-20 08:20:33'),
(29, 'STANLEY SWITCHGEAR PRODUCTS', 8, '', '1', 'AACFS3575Q', '21, Sadguru Estate, Vishweshwar Nagar,\r\noff. Aarey Road, Goregaon (East),\r\nMumbai - 400063.', 1, '27', 'Mumbai', 400063, '27AACFS3575Q1ZH', 0, 0, 18, 0, 1, '2021-04-20 03:01:16', 1, '2021-04-20 08:31:16'),
(30, 'KAMAL METAL PRODUCTS', 8, '', '1', 'AACFK6090N', 'Plot No. 3983, Road No. 08,\r\nGIDC Phase-III, \r\nDared, Jamnagar - 361004', 1, '24', 'Jamnagar', 361004, '24AACFK6090N1Z1', 9, 9, 0, 0, 1, '2021-04-20 04:12:04', 1, '2021-04-20 09:42:04'),
(31, 'MEERA METALS', 8, '', '1', 'CLZPM9168F', 'Shed No. 3913, W Road, \r\nGIDC Phase-III,\r\nDared, Jamnagar - 361004', 1, '24', 'Jamnagar', 361004, '24CLZPM9168F1ZA', 9, 9, 0, 0, 1, '2021-04-20 04:24:36', 1, '2021-04-20 09:54:36'),
(32, 'CHHAYA INDUSTRIES', 8, '', '1', 'AANFC4636R', 'Plot No. 3686, \r\nGIDC Phase-III,\r\nDared, Jamnagar - 361004.', 1, '24', 'Jamnagar', 361004, '24AANFC4636R1ZU', 9, 9, 0, 0, 1, '2021-04-20 04:35:13', 1, '2021-04-20 10:05:13'),
(33, 'SENOR METALS PRIVATE LIMITED', 8, '', '2', '', 'Plot No. 353, GIDC Phase-II, \r\nDared, Jamnagar - 361004', 1, '24', 'Jamnagar', 361004, '', 9, 9, 18, 0, 1, '2021-04-20 08:34:27', 1, '2021-04-25 15:24:32'),
(34, 'VATS FASTENER TOOLS', 8, '', '2', '', 'Opp. IDC, B/h. Hanuman Mandir, Nr. Vodafone Tower, \r\n Hissar Road, Rohtak - 124001.', 1, '24', 'Rohtak', 124001, '', 9, 9, 18, 0, 1, '2021-04-20 09:00:28', 1, '2021-04-21 18:02:30'),
(35, 'FASTENER TOOLING&#39;S INC.', 8, '', '2', '', 'Gala No. 103, Shubh Industrial Estate,\r\nChinchpada, Waliv Road,\r\nVasai Road (East), Dist. Palghar - 401208.', 1, '24', 'Palghar', 401208, '', 9, 9, 18, 0, 1, '2021-04-20 09:39:32', 1, '2021-04-20 15:09:32'),
(36, 'ELEMEX ELECTRIC PVT. LTD.', 8, '', '1', 'AAACE4966E', '134-135, GIDC Estate, Por - Ramangamdi,\r\nVadodara - 391243', 1, '24', 'Vadodara', 391243, '24AAACE4966E1ZT', 9, 9, 0, 0, 1, '2021-04-20 09:52:28', 1, '2021-04-20 15:22:28'),
(37, 'PARASMANI FASTENERS', 8, '', '1', 'ADSPK4715H', 'SP. Shed No. 447/1, GIDC Estate,\r\nShanker Tekri Udyog Nagar,\r\nJamnagar - 361004', 1, '24', 'Jamnagar', 361004, '24ADSPK4715H1ZF', 9, 9, 0, 0, 1, '2021-04-22 02:33:05', 1, '2021-04-22 08:03:05'),
(38, 'ARIHANT INDUSTRIES', 8, '', '1', 'AFZPM6289F', 'SP. Shed No. 422-1,\r\nGIDC Phase - 1,\r\nJamnagar - 361004', 1, '24', 'Jamnagar', 361004, '24AFZPM6289F1ZP', 9, 9, 0, 0, 1, '2021-04-22 03:11:49', 1, '2021-04-22 10:39:02'),
(39, 'ICON INDUSTRIES', 8, '', '1', 'ABKPR8473K', 'Plot No. 260, \r\nGIDC Phase-II,\r\nDared, Jamnagar - 361004', 1, '24', 'Jamnagar', 361004, '24ABKPR8473K1ZY', 9, 9, 0, 0, 1, '2021-04-22 05:22:23', 1, '2021-04-22 10:52:23'),
(40, 'RAM METAL INC.', 8, '', '1', 'BBFPS5247C', 'Plot No. 386,\r\nGIDC Shaker Tekri Udyog Nagar,\r\nJamnagar - 361004', 1, '24', 'Jamnagar', 361004, '24BBFPS5247C1ZS', 9, 9, 0, 0, 1, '2021-04-22 08:13:32', 1, '2021-04-22 13:43:32'),
(41, 'RAMA METAL PRODUCTS', 8, '', '1', 'AGHPR9760P', 'Plot No. 480, \r\nGIDC Phase-II,\r\nDared, Jamnagar - 361004', 1, '24', 'Jamnagar', 361004, '24AGHPR9760P1ZH', 9, 9, 0, 0, 1, '2021-04-22 08:26:27', 1, '2021-04-22 13:56:27'),
(42, 'G S STEEL CORPORATION', 8, '', '1', 'AGSPA5534H', 'Plot No. 4358, \r\nGIDC Phase -III,\r\nDared, Jamnagar - 361004', 1, '24', 'Jamnagar', 361004, '24AGSPA5534H1ZG', 9, 9, 0, 0, 1, '2021-04-22 09:04:56', 1, '2021-04-22 14:34:56'),
(43, 'SHIV OM BRASS INDUSTRIES', 8, '', '1', 'AAQFS9995J', 'Plot No. 3690/3691, Road No. 7,\r\nNear Pramukh Swami Circle,\r\nGIDC Phase - III, Dared,\r\nJamnagar - 361004', 1, '24', 'Jamnagar', 361004, '24AAQFS9995J1Z3', 9, 9, 0, 0, 1, '2021-04-22 09:36:21', 1, '2021-04-22 15:06:21'),
(44, 'NEW MUKESH SCRAP REPROCESSING INDUSTRIES', 8, '', '1', 'ABUPJ2862L', 'Plot No. 391, \r\nShanker Tekri Udyog Nagar,\r\nJamnagar - 361004', 1, '24', 'Jamnagar', 361004, '24ABUPJ2862L1Z5', 9, 9, 0, 0, 1, '2021-04-25 08:57:41', 1, '2021-04-25 14:27:41'),
(45, 'BALARK METALS PRIVATE LIMITED', 8, '', '1', 'AAECB8956B', 'Survey No. 82 & 83/2,\r\nVillage Kansumra, Jamnagar Bypass Road,\r\nJamnagar - 361006', 1, '24', 'Jamnagar', 361004, '24AAECB8956B2ZR', 9, 9, 0, 0, 1, '2021-04-25 09:01:24', 1, '2021-04-25 14:31:24'),
(46, 'M K BRASS INDUSTRIES', 8, '', '1', 'AEIPP8737P', 'Plot No. 3428, Road No. E,\r\nGIDC Phase - 3, Dared,\r\nJamnagar - 361004', 1, '24', 'Jamnagar', 361004, '24AEIPP8737P1ZN', 9, 9, 0, 0, 1, '2021-04-25 10:13:41', 1, '2021-04-25 15:43:41'),
(47, 'SADARIYA INDUSTRIES', 8, '', '1', 'AFNPS6769J', '386/11, Kasundra Shed,\r\nGIDC, Shanker Tekri Udyog Nagar,\r\nJamnagar - 361004', 1, '24', 'Jamnagar', 361004, '24AFNPS6769J1ZL', 9, 9, 0, 0, 1, '2021-04-25 10:36:15', 1, '2021-04-25 16:06:15'),
(48, 'PANASONIC LIFE SOLUTIONS INDIA PRIVATE LIMITED U-1', 8, '', '1', 'AAECA2190C', 'Unit-1, Plot No. 1A & 1B, Sector - 8B,\r\nIIE Ranipur, Sidcul Haridwar,\r\nHaridwar - 249403', 1, '05', 'Haridwar', 249403, '05AAECA2190C1Z9', 0, 0, 18, 0, 1, '2021-04-25 10:57:46', 1, '2021-04-25 16:27:46'),
(49, 'FIT TIGHT FASTENERS PRIVATE LIMITED', 8, '', '2', '', 'Plot No. 1458/59, GIDC Metoda, Almighty Gate, Road No. B-6, \r\nKalawad Road, Rajkot - 360021', 1, '24', 'Rajkot', 360021, '', 9, 9, 18, 0, 1, '2021-04-25 12:22:02', 1, '2021-04-25 17:52:02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer_person`
--

CREATE TABLE `tbl_customer_person` (
  `id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `name` varchar(155) NOT NULL,
  `email` varchar(50) NOT NULL,
  `designation` varchar(155) NOT NULL,
  `contact_no` bigint(20) NOT NULL,
  `status` int(10) NOT NULL,
  `isdelete` tinyint(10) NOT NULL,
  `created_by` int(10) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(10) NOT NULL,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_customer_person`
--

INSERT INTO `tbl_customer_person` (`id`, `customer_id`, `name`, `email`, `designation`, `contact_no`, `status`, `isdelete`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(1, 1, 'meet kamani', 'meetkamani95@gmail.com', 'mba', 2147483647, 1, 1, 1, '2021-01-09 05:29:38', 1, '2021-01-09 13:06:41'),
(2, 1, 'meet kamani', 'meetkamani95@gmail.com', 'mca', 2147483647, 1, 0, 1, '2021-01-09 07:19:58', 1, '2021-01-09 13:05:04'),
(3, 1, 'mahesh', 'meetkamani@gmail.com', 'mba', 2147483647, 1, 0, 1, '2021-01-09 07:26:48', 1, '2021-01-09 13:12:02'),
(5, 1, 'prince', 'prince@gmail.com', 'mca', 2147483647, 0, 0, 1, '2021-01-09 07:40:24', 1, '2021-01-15 16:33:26'),
(6, 1, 'shivam', 'shivam@gmail.com', 'bca', 2147483647, 1, 0, 1, '2021-01-09 07:46:58', 1, '2021-01-15 16:33:26'),
(7, 3, 'meet kamani', 'meetkamani220@gmail.com', 'mba', 2147483647, 1, 0, 1, '2021-01-18 06:06:17', 1, '2021-01-20 10:53:34'),
(8, 2, 'meet', 'meet@gmail.com', 'mca', 2147483647, 1, 1, 1, '2021-01-18 11:00:57', 1, '2021-03-17 11:49:32'),
(9, 3, 'meet kamani', 'meetkamani005@gmail.com', 'mca', 2147483647, 1, 1, 1, '2021-01-20 05:23:34', 1, '2021-01-26 10:51:35'),
(10, 4, 'customar 1011', 'adminmand1m@gmail.com', 'constant2041', 32323231, 1, 1, 1, '2021-01-26 05:07:44', 1, '2021-01-26 00:11:52'),
(11, 4, 'brijj1', 'adminmanm1s@gmail.com', 'post1', 32323231, 1, 1, 1, '2021-01-26 05:11:52', 1, '2021-01-26 00:22:59'),
(12, 3, 'brijj22', 'adminmeet@gmail.com', 'post', 3232323, 0, 0, 1, '2021-01-26 05:18:56', 1, '2021-01-26 10:48:56'),
(13, 4, 'customar 101', 'adminm&m@gmail.com', 'constant204', 3232323, 0, 0, 1, '2021-01-26 05:22:59', 1, '2021-01-26 10:52:59'),
(14, 2, 'brijj', 'admin444@gmail.com', 'post', 3232323, 1, 1, 1, '2021-01-26 05:52:20', 1, '2021-03-17 11:48:51'),
(15, 5, 'Admin', 'admin@gmail.com', 'Marketing Manager', 2147483647, 1, 0, 1, '2021-01-26 06:16:40', 1, '2021-02-03 17:48:41'),
(16, 5, 'Rasul Raj', 'rashulraj@gmail.com', 'CEO', 2147483647, 0, 0, 1, '2021-01-26 06:16:54', 1, '2021-02-03 17:47:22'),
(17, 6, 'Rahul Pawar', 'rahul.pawar@polycab.com', 'Purchase Manager', 7058716721, 0, 0, 1, '2021-01-26 07:11:31', 1, '2021-02-28 11:17:26'),
(18, 6, 'Tatsat Rao', 'tatsatrao@gmail.com', 'Purchase Manager', 2147483647, 1, 1, 1, '2021-02-03 07:06:21', 1, '2021-02-07 15:55:38'),
(19, 8, 'karsndas', 'karsan@gmailcom', 'menegar', 9933232323, 0, 0, 1, '2021-03-16 09:30:50', 1, '2021-03-16 15:01:03'),
(20, 9, 'rambhai', 'admin12112@gmail.com', 'menegar', 323232322, 0, 0, 1, '2021-03-17 05:56:59', 1, '2021-03-17 11:26:59'),
(21, 2, 'rambhai', 'demo001@gmail.com', 'menegar', 9724855505, 1, 0, 1, '2021-03-17 06:18:43', 1, '2021-03-17 11:56:48'),
(22, 2, 'DEMO 12', 'admin0101@gmail.com', 'post', 3232323232, 1, 0, 1, '2021-03-17 06:26:48', 1, '2021-03-17 12:01:04'),
(23, 2, 'abc', 'admin2222@gmail.com', 'post', 9724855503, 1, 0, 1, '2021-03-17 06:31:04', 1, '2021-03-17 12:03:53'),
(24, 2, 'abc', 'admin222222@gmail.com', 'post', 323232300, 1, 0, 1, '2021-03-17 06:33:53', 1, '2021-03-17 12:06:18'),
(25, 2, 'Mahedra Bhai', 'admin3333@gmail.com', 'post', 3232323000, 0, 0, 1, '2021-03-17 06:36:18', 1, '2021-03-17 16:20:44'),
(26, 10, 'Raj', 'tatam@gmaul.com', 'Employ', 9724855508, 0, 0, 1, '2021-03-17 09:39:11', 1, '2021-03-17 15:09:11'),
(27, 11, 'SANJAYBHAI', 'vagadiya1975@gmail.com', 'MD', 9879763050, 0, 0, 1, '2021-03-18 12:54:22', 1, '2021-03-18 18:24:22'),
(28, 12, 'DHANJIBHAI', 'info@arvindindustries.com', 'MD', 9328100459, 0, 0, 1, '2021-03-18 14:04:32', 1, '2021-03-18 19:34:32'),
(29, 13, 'SUDIN BAKRE', 'purchase@connectwell.com', 'PURCHASE EXECUTIVE', 9004262237, 0, 0, 1, '2021-03-23 14:00:46', 1, '2021-03-23 19:30:46'),
(30, 14, 'JITENDRA', 'siddhnathfasteners@gmail.com', 'EMPLOYEE', 9586738544, 0, 0, 1, '2021-03-26 11:37:13', 1, '2021-03-26 17:07:13'),
(31, 15, 'DILIP', 'test@gmail.com', 'MD', 9428668170, 0, 0, 1, '2021-03-26 11:38:29', 1, '2021-03-26 17:08:29'),
(32, 16, 'Mr. Chirag Shah', 'info@rajind.in', 'MD', 9687568568, 0, 0, 1, '2021-03-26 11:48:46', 1, '2021-03-27 11:27:49'),
(33, 17, 'NIKHIL GUPTA', 'nikhil.gupta04@in.panasonic.com', 'MCD', 8445598256, 0, 0, 3, '2021-03-27 06:14:27', 3, '2021-03-27 11:44:27'),
(34, 18, 'NARESHKUMAR', 'laxmibrassind@gmail.com', 'MD', 9824912474, 0, 0, 1, '2021-03-30 09:58:25', 1, '2021-03-30 15:28:25'),
(35, 19, 'MIRAJ BHAI', '', '', 9904694260, 1, 1, 1, '2021-04-15 11:00:05', 1, '2021-04-18 08:12:58'),
(36, 20, 'Mr. Miraj Khimasiya', 'info@precisionfasttech.com', 'Managing Partner', 9904694260, 0, 0, 1, '2021-04-18 08:44:28', 1, '2021-04-18 14:14:28'),
(37, 21, 'Kamdar', 'thakkermk@gmail.com', 'MD', 9819049049, 0, 0, 1, '2021-04-18 10:10:11', 1, '2021-04-18 15:40:11'),
(38, 22, 'Maheshbhai Sojitra', 'popularmetal@gmail.com', 'Partner', 9978000734, 0, 0, 1, '2021-04-18 11:04:01', 1, '2021-04-18 17:40:05'),
(39, 19, 'Virat Rabadiya', 'pbwplexport@gmail.com', 'Director', 9825193978, 0, 0, 1, '2021-04-18 12:12:58', 1, '2021-04-18 17:42:58'),
(40, 24, 'Mitesh Kanakhara', 'mitesh@meeraimpex.com', 'Partner', 0, 0, 0, 1, '2021-04-19 08:41:58', 1, '2021-04-19 14:11:58'),
(41, 25, 'Vivek Rajaura', 'vivek.kumar@nipa.co.in', 'Purchase Manager', 9627887070, 0, 0, 1, '2021-04-19 09:03:08', 1, '2021-04-19 14:33:08'),
(42, 26, 'Pankaj Jadhav', '', 'Purchase Manager', 9727709265, 0, 0, 1, '2021-04-19 09:11:16', 1, '2021-04-19 14:41:16'),
(43, 27, 'Hirav Chheda', 'latonconnexions@gmail.com', 'Partner', 9725812436, 0, 0, 1, '2021-04-20 02:17:50', 1, '2021-04-20 07:47:50'),
(44, 28, 'Janibhai', 'accounts@ranjitindustries.net', 'Accountant', 9979934841, 0, 0, 1, '2021-04-20 02:51:53', 1, '2021-04-20 08:21:53'),
(45, 29, 'Jigneshbhai', 'stanleyswitch@yahoo.co.in', 'Partner', 8169349042, 0, 0, 1, '2021-04-20 03:02:18', 1, '2021-04-20 08:32:18'),
(46, 30, 'Milan Markana', 'quality@kamalmetal.in', 'Purchase Manager', 9924246776, 0, 0, 1, '2021-04-20 04:14:04', 1, '2021-04-20 09:44:04'),
(47, 31, 'Vipulbhai Mungara', 'cometmetallinks@gmail.com', 'Proprietor', 9725332564, 0, 0, 1, '2021-04-20 04:26:08', 1, '2021-04-20 09:56:08'),
(48, 32, 'Kishanbhai Chhaya', 'info@chhayabrassparts.com', 'Purchase Manager', 9662223018, 0, 0, 1, '2021-04-20 04:37:22', 1, '2021-04-20 10:07:22'),
(49, 33, 'Himanshu Sharma', 'sales5@senormetals.in', 'Marketing Executive', 9725252141, 0, 0, 1, '2021-04-20 08:35:39', 1, '2021-04-20 14:05:39'),
(50, 34, 'Ajay Sharma', 'ajaysharma.671@rediffmail.com', 'Proprietor', 9996014107, 0, 0, 1, '2021-04-20 09:01:41', 1, '2021-04-20 14:31:41'),
(51, 36, 'Jatin Bhai', '', '', 7878404403, 0, 0, 1, '2021-04-20 09:53:16', 1, '2021-04-20 15:23:16'),
(52, 37, 'Rasikbhai Khimasiya', 'parasmanifasteners@gmail.com', 'Proprietor', 9427256983, 0, 0, 1, '2021-04-22 02:41:29', 1, '2021-04-22 08:11:29'),
(53, 38, 'Niravbhai', '', 'Proprietor', 9426965985, 0, 0, 1, '2021-04-22 03:12:37', 1, '2021-04-22 08:42:37'),
(54, 39, 'Sagarbhai', 'iconindustries.jamnagar@gmail.com', 'Proprietor', 9879985008, 0, 0, 1, '2021-04-22 05:25:11', 1, '2021-04-22 10:55:11'),
(55, 40, 'Brijeshbhai', '', 'Proprietor', 9327711555, 0, 0, 1, '2021-04-22 08:14:17', 1, '2021-04-22 13:44:17'),
(56, 41, 'Niravbhai', 'niravbba@gmail.com', 'Purchase Manager', 8000730923, 0, 0, 1, '2021-04-22 08:27:55', 1, '2021-04-22 13:57:55'),
(57, 42, 'Pappubhai', '', 'Proprietor', 0, 0, 0, 1, '2021-04-22 09:05:23', 1, '2021-04-22 14:35:23'),
(58, 43, 'Ravibhai', 'purchase@shivombrass.in', 'Purchase Manager', 9979890658, 0, 0, 1, '2021-04-22 09:37:45', 1, '2021-04-22 15:07:45'),
(59, 44, 'Mukesh Joisher', '', 'Proprietor', 0, 0, 0, 1, '2021-04-25 08:57:58', 1, '2021-04-25 14:27:58'),
(60, 45, 'Anil Parmar', 'purchase@balark.com', 'Purchase Manager', 9099299606, 0, 0, 1, '2021-04-25 09:03:10', 1, '2021-04-25 14:33:10'),
(61, 46, 'Nitinbhai', 'kalpesh.patel@mkbrassindustries.com', 'Proprietor', 9824039864, 0, 0, 1, '2021-04-25 10:14:47', 1, '2021-04-25 15:44:47'),
(62, 47, 'Mahendrabhai', '', '', 0, 1, 1, 1, '2021-04-25 10:37:43', 1, '2021-04-25 16:08:29'),
(63, 47, 'Brijeshbhai', '', 'Proprietor', 0, 0, 0, 1, '2021-04-25 10:38:24', 1, '2021-04-25 16:08:24'),
(64, 48, 'Nikhil Gupta', 'nikhil.gupta04@in.panasonic.com', 'MCD', 8445598256, 0, 0, 1, '2021-04-25 10:58:47', 1, '2021-04-25 16:28:47'),
(65, 49, 'Vipul Maraviya', 'fittightfasteners@yahoo.com', 'Proprietor', 0, 0, 0, 1, '2021-04-25 12:23:27', 1, '2021-04-25 17:53:27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_deliverychallan`
--

CREATE TABLE `tbl_deliverychallan` (
  `id` int(11) NOT NULL,
  `fin_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `consignee` int(11) NOT NULL DEFAULT '0',
  `oderid` text,
  `deliveryno` varchar(200) NOT NULL,
  `delivery_date` date NOT NULL,
  `shpping_company` int(11) NOT NULL,
  `description` text NOT NULL,
  `description_of_fright` text NOT NULL,
  `fright_amount` decimal(20,2) NOT NULL,
  `iseditable` tinyint(1) NOT NULL DEFAULT '0',
  `delivery_amount` decimal(20,3) NOT NULL,
  `bags` int(11) NOT NULL DEFAULT '0',
  `isdelete` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `lr_number` int(20) NOT NULL,
  `dispatched_by` varchar(50) NOT NULL,
  `place_supply` varchar(50) DEFAULT NULL COMMENT 'place to supply',
  `cartoon_bag` varchar(50) NOT NULL,
  `po_number` varchar(55) DEFAULT NULL COMMENT 'Purchase Order No',
  `payment` varchar(155) DEFAULT NULL,
  `tcs` decimal(10,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_deliverychallan`
--

INSERT INTO `tbl_deliverychallan` (`id`, `fin_id`, `customer_id`, `consignee`, `oderid`, `deliveryno`, `delivery_date`, `shpping_company`, `description`, `description_of_fright`, `fright_amount`, `iseditable`, `delivery_amount`, `bags`, `isdelete`, `created_by`, `created_on`, `updated_by`, `updated_on`, `lr_number`, `dispatched_by`, `place_supply`, `cartoon_bag`, `po_number`, `payment`, `tcs`) VALUES
(1, 18, 19, 39, NULL, '21-22/0001', '2021-04-19', 0, '', '', 0.00, 0, 0.000, 50, 0, NULL, '2021-04-18 08:09:41', NULL, NULL, 1234, 'LOCAL RIKSHAW', 'GUJARAT', '', '220321,09022021', 'Paid', 0.10);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_deliverychallan_payment`
--

CREATE TABLE `tbl_deliverychallan_payment` (
  `id` int(11) NOT NULL,
  `invoiceid` int(11) NOT NULL,
  `date` date NOT NULL,
  `amount` decimal(20,3) NOT NULL,
  `exchange_rate` decimal(10,3) NOT NULL,
  `price_in_inr` decimal(30,3) NOT NULL,
  `advice_no` varchar(150) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `detail` varchar(255) NOT NULL,
  `isdelete` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_deliverychallan_sub`
--

CREATE TABLE `tbl_deliverychallan_sub` (
  `id` int(11) NOT NULL,
  `deliveryid` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `weight` decimal(10,3) DEFAULT NULL,
  `rate_type` int(10) DEFAULT NULL,
  `rate` decimal(10,2) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `isdelete` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_deliverychallan_sub`
--

INSERT INTO `tbl_deliverychallan_sub` (`id`, `deliveryid`, `item_id`, `qty`, `weight`, `rate_type`, `rate`, `amount`, `isdelete`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(1, 1, 46, 0, 145.300, 1, 117.00, 17000.10, 0, NULL, '2021-04-18 08:16:06', NULL, NULL),
(2, 1, 47, 0, 105.000, 1, 129.00, 13545.00, 0, NULL, '2021-04-18 08:16:31', NULL, NULL),
(3, 1, 48, 0, 200.000, 1, 107.00, 21400.00, 0, NULL, '2021-04-18 08:16:57', NULL, NULL),
(4, 1, 49, 0, 600.000, 1, 103.00, 61800.00, 0, NULL, '2021-04-18 08:17:20', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

CREATE TABLE `tbl_department` (
  `id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `isdelete` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_department`
--

INSERT INTO `tbl_department` (`id`, `department_name`, `isdelete`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(1, 'Ladise', 0, 1, '2020-11-12 14:07:43', 2, '2020-11-22 18:47:01');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_financial_year`
--

CREATE TABLE `tbl_financial_year` (
  `id` int(11) NOT NULL,
  `company_id` int(10) DEFAULT '0',
  `name` varchar(200) NOT NULL,
  `company_name` varchar(55) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `ms_value` varchar(30) DEFAULT NULL,
  `isdelete` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_financial_year`
--

INSERT INTO `tbl_financial_year` (`id`, `company_id`, `name`, `company_name`, `start_date`, `end_date`, `ms_value`, `isdelete`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(18, 8, '21-22', 'Financial Year - 2021-22', '2021-04-01', '2022-03-31', '80', 0, 1, '2021-04-01 02:22:14', 1, '2021-04-01 07:52:13');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_general_voucher`
--

CREATE TABLE `tbl_general_voucher` (
  `id` int(10) NOT NULL,
  `fin_id` int(10) DEFAULT NULL,
  `customer_id` int(11) DEFAULT '0',
  `voucher_date` date DEFAULT NULL,
  `voucher_no` varchar(55) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT '0.00',
  `isdelete` tinyint(2) DEFAULT '0',
  `created_by` int(10) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(10) DEFAULT NULL,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_general_voucher`
--

INSERT INTO `tbl_general_voucher` (`id`, `fin_id`, `customer_id`, `voucher_date`, `voucher_no`, `total`, `isdelete`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(1, 12, 0, '2021-02-17', 'XYZ123', 0.00, 0, 1, '2021-03-09 12:27:54', 1, '2021-03-09 17:57:54');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_general_voucher_sub`
--

CREATE TABLE `tbl_general_voucher_sub` (
  `id` int(10) NOT NULL,
  `voucher_id` int(10) DEFAULT NULL,
  `item_id` int(10) DEFAULT NULL,
  `voucher_type` int(10) DEFAULT NULL,
  `qty` int(20) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT '0.00',
  `total` decimal(10,2) DEFAULT '0.00',
  `isdelete` tinyint(2) DEFAULT '0',
  `created_by` int(10) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(10) DEFAULT NULL,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inventory`
--

CREATE TABLE `tbl_inventory` (
  `id` int(10) NOT NULL,
  `finid` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `subid` int(10) NOT NULL,
  `stype` int(3) NOT NULL,
  `qty` decimal(10,3) DEFAULT NULL,
  `isdelete` tinyint(1) NOT NULL,
  `created_by` int(10) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(10) NOT NULL,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_inventory`
--

INSERT INTO `tbl_inventory` (`id`, `finid`, `item_id`, `subid`, `stype`, `qty`, `isdelete`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(1, 12, 2, 2, 0, 80.000, 0, 1, '2021-03-09 10:53:16', 1, '2021-03-09 16:35:56'),
(2, 12, 3, 3, 0, 60.000, 0, 1, '2021-03-09 11:01:24', 1, '2021-03-09 16:31:24'),
(3, 12, 4, 4, 0, 60.000, 0, 1, '2021-03-09 11:08:52', 1, '2021-03-09 16:38:52'),
(4, 12, 5, 5, 0, 60.000, 0, 1, '2021-03-09 11:10:51', 1, '2021-03-09 16:40:50'),
(5, 12, 6, 6, 0, 200.000, 0, 1, '2021-03-16 09:37:22', 1, '2021-03-16 15:07:22'),
(6, 12, 7, 7, 0, 0.000, 0, 1, '2021-03-16 10:32:54', 1, '2021-03-16 16:02:54'),
(7, 12, 8, 8, 0, NULL, 0, 1, '2021-03-16 11:55:52', 1, '2021-03-16 17:25:52'),
(8, 12, 9, 9, 0, NULL, 0, 1, '2021-03-16 11:57:52', 1, '2021-03-16 17:27:52'),
(9, 12, 10, 10, 0, NULL, 0, 1, '2021-03-16 12:00:43', 1, '2021-03-16 17:30:43'),
(10, 12, 11, 11, 0, NULL, 0, 1, '2021-03-16 12:06:27', 1, '2021-03-16 17:36:27'),
(11, 12, 12, 12, 0, NULL, 0, 1, '2021-03-16 12:09:00', 1, '2021-03-16 17:39:00'),
(12, 12, 13, 13, 0, NULL, 0, 1, '2021-03-16 12:18:12', 1, '2021-03-16 18:11:33'),
(13, 16, 33, 1, 1, 100.000, 1, 1, '2021-03-27 07:01:57', 1, '2021-04-18 15:48:36'),
(14, 16, 33, 2, 1, 2000.000, 1, 1, '2021-03-27 07:02:25', 1, '2021-04-18 15:55:26'),
(15, 16, 43, 3, 1, 50.000, 1, 1, '2021-03-31 06:57:41', 1, '2021-04-20 13:50:59'),
(16, 16, 33, 4, 1, 50000.000, 1, 1, '2021-03-31 06:59:27', 1, '2021-04-20 13:50:53'),
(17, 18, 33, 5, 1, 500000.000, 0, 1, '2021-04-11 10:01:57', 1, '2021-04-11 15:31:57'),
(18, 18, 51, 1, 1, 2.000, 1, 1, '2021-04-18 10:16:31', 1, '2021-04-18 15:48:36'),
(19, 18, 51, 2, 1, 2.000, 1, 1, '2021-04-18 10:20:26', 1, '2021-04-18 15:55:26'),
(20, 18, 52, 3, 1, 2.000, 1, 1, '2021-04-18 10:30:18', 1, '2021-04-20 13:50:59'),
(21, 18, 51, 4, 1, 10.000, 1, 1, '2021-04-18 13:20:32', 1, '2021-04-20 13:50:53'),
(22, 18, 52, 0, 1, 2.000, 0, 0, '2021-04-19 13:50:01', 1, '2021-04-19 19:20:01'),
(23, 18, 52, 0, 1, 2.000, 0, 0, '2021-04-19 13:50:27', 1, '2021-04-19 19:20:27'),
(24, 18, 52, 0, 1, 2.000, 0, 0, '2021-04-19 13:50:51', 1, '2021-04-19 19:20:51'),
(25, 18, 52, 0, 1, 2.000, 0, 0, '2021-04-19 13:50:54', 1, '2021-04-19 19:20:54'),
(26, 18, 52, 0, 1, 2.000, 0, 0, '2021-04-19 13:51:09', 1, '2021-04-19 19:21:09'),
(27, 18, 52, 0, 1, 2.000, 0, 0, '2021-04-19 13:51:21', 1, '2021-04-19 19:21:21'),
(28, 18, 52, 0, 1, 2.000, 0, 0, '2021-04-19 13:51:22', 1, '2021-04-19 19:21:22'),
(29, 18, 52, 0, 1, 2.000, 0, 0, '2021-04-19 13:51:43', 1, '2021-04-19 19:21:43'),
(30, 18, 52, 0, 1, 2.000, 0, 0, '2021-04-19 13:52:08', 1, '2021-04-19 19:22:08'),
(31, 18, 52, 0, 1, 2.000, 0, 0, '2021-04-19 13:52:34', 1, '2021-04-19 19:22:34'),
(32, 18, 52, 0, 1, 2.000, 0, 0, '2021-04-19 13:55:13', 1, '2021-04-19 19:25:13'),
(33, 18, 52, 0, 1, 2.000, 0, 0, '2021-04-19 13:56:22', 1, '2021-04-19 19:26:22'),
(34, 18, 52, 0, 1, 2.000, 0, 0, '2021-04-19 13:56:43', 1, '2021-04-19 19:26:43'),
(35, 18, 52, 0, 1, 2.000, 0, 0, '2021-04-19 13:57:34', 1, '2021-04-19 19:27:34'),
(36, 18, 52, 5, 1, 2.000, 0, 1, '2021-04-20 08:22:57', 1, '2021-04-20 13:52:57'),
(37, 18, 79, 6, 1, 600.000, 0, 1, '2021-04-20 08:28:51', 1, '2021-04-20 13:58:51'),
(38, 18, 80, 7, 1, 250.000, 0, 1, '2021-04-20 08:39:11', 1, '2021-04-20 14:09:11'),
(39, 18, 81, 8, 1, 50.000, 0, 1, '2021-04-20 08:46:43', 1, '2021-04-20 14:16:43'),
(40, 18, 82, 9, 1, 200.000, 0, 1, '2021-04-20 08:51:42', 1, '2021-04-20 14:21:42'),
(41, 18, 83, 10, 1, 1.000, 0, 1, '2021-04-20 09:23:49', 1, '2021-04-20 14:53:49'),
(42, 18, 82, 0, 1, 200.000, 0, 0, '2021-04-24 06:52:30', 1, '2021-04-24 12:22:30'),
(43, 18, 79, 0, 1, 600.000, 0, 0, '2021-04-25 09:26:33', 1, '2021-04-25 14:56:33'),
(44, 18, 124, 11, 1, 250.000, 0, 1, '2021-04-25 09:41:40', 1, '2021-04-25 15:11:40'),
(45, 18, 125, 12, 1, 50.000, 0, 1, '2021-04-25 09:51:40', 1, '2021-04-25 15:21:40');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice`
--

CREATE TABLE `tbl_invoice` (
  `id` int(11) NOT NULL,
  `fin_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `oderid` text,
  `invoiceno` varchar(200) NOT NULL,
  `invoice_date` date NOT NULL,
  `shpping_company` int(11) NOT NULL,
  `description` text NOT NULL,
  `description_of_fright` text NOT NULL,
  `fright_amount` decimal(20,2) NOT NULL,
  `iseditable` tinyint(1) NOT NULL DEFAULT '0',
  `invoice_amount` decimal(20,3) NOT NULL,
  `bags` int(11) NOT NULL DEFAULT '0',
  `sgst` int(11) NOT NULL DEFAULT '0',
  `cgst` int(11) NOT NULL DEFAULT '0',
  `igst` int(11) NOT NULL DEFAULT '0',
  `isdelete` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `lr_number` int(20) NOT NULL,
  `dispatched_by` varchar(50) NOT NULL,
  `place_supply` varchar(50) DEFAULT NULL COMMENT 'place to supply',
  `cartoon_bag` varchar(50) NOT NULL,
  `po_number` varchar(55) DEFAULT NULL COMMENT 'Purchase Order No',
  `payment` varchar(155) DEFAULT NULL,
  `tcs` decimal(10,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_invoice`
--

INSERT INTO `tbl_invoice` (`id`, `fin_id`, `customer_id`, `oderid`, `invoiceno`, `invoice_date`, `shpping_company`, `description`, `description_of_fright`, `fright_amount`, `iseditable`, `invoice_amount`, `bags`, `sgst`, `cgst`, `igst`, `isdelete`, `created_by`, `created_on`, `updated_by`, `updated_on`, `lr_number`, `dispatched_by`, `place_supply`, `cartoon_bag`, `po_number`, `payment`, `tcs`) VALUES
(1, 18, 20, NULL, '21-22/0001', '2021-04-01', 0, '', '', 0.00, 0, 0.000, 4, 9, 9, 0, 0, NULL, '2021-04-19 04:30:06', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', 'Email', '30 Days', 0.10),
(2, 18, 24, NULL, '21-22/0002', '2021-04-01', 0, '', '', 0.00, 0, 0.000, 4, 9, 9, 0, 0, NULL, '2021-04-19 08:43:49', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', '0010', '30 Days', 0.10),
(3, 18, 13, NULL, '21-22/0003', '2021-04-01', 0, '', '', 0.00, 0, 0.000, 16, 0, 0, 18, 0, NULL, '2021-04-19 08:57:26', NULL, NULL, 0, 'V TRANS INDIA LIMITED', 'MAHARASHTRA', '', '5000026248', '30 Days', 0.00),
(4, 18, 25, NULL, '21-22/0004', '2021-04-01', 0, '', '', 3600.00, 0, 0.000, 12, 0, 0, 18, 0, NULL, '2021-04-19 09:05:03', NULL, NULL, 1005988325, 'Rivigo Services Pvt. Ltd.', 'Himachal Pradesh', '', 'JSKEPO03377', '30 Days', 0.10),
(5, 18, 26, NULL, '21-22/0005', '2021-04-01', 0, '', '', 0.00, 0, 0.000, 100, 0, 0, 18, 0, NULL, '2021-04-19 09:12:13', NULL, NULL, 0, 'GJ15 UU 1382', 'MAHARASHTRA', '', 'JD20PO0434', '30 Days', 0.00),
(6, 18, 19, NULL, '21-22/0006', '2021-04-03', 0, '', '', 0.00, 0, 0.000, 25, 9, 9, 0, 0, NULL, '2021-04-19 09:16:15', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', '10321', '30 Days', 0.10),
(7, 18, 27, NULL, '21-22/0007', '2021-04-03', 0, '', '', 0.00, 0, 0.000, 38, 9, 9, 0, 0, NULL, '2021-04-20 02:18:46', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', 'Email Order', '30 Days', 0.00),
(8, 18, 27, NULL, '21-22/0008', '2021-04-03', 0, '', '', 0.00, 0, 0.000, 55, 9, 9, 0, 0, NULL, '2021-04-20 02:27:49', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', 'Email Order', '30 Days', 0.00),
(9, 18, 17, NULL, '21-22/0009', '2021-04-03', 0, '', '', 0.00, 0, 0.000, 68, 0, 0, 18, 0, NULL, '2021-04-20 02:32:39', NULL, NULL, 2, 'Shree Haridwar Logistics', 'Uttarakhand', '', '207026508', '45 Days', 0.00),
(10, 18, 17, NULL, '21-22/0010', '2021-04-03', 0, '', '', 0.00, 0, 0.000, 204, 0, 0, 18, 0, NULL, '2021-04-20 02:36:27', NULL, NULL, 2, 'Shree Haridwar Logistics', 'Uttarakhand', '', '207027130', '45 Days', 0.00),
(11, 18, 22, NULL, '21-22/0011', '2021-04-03', 0, '', '', 0.00, 0, 0.000, 27, 9, 9, 0, 0, NULL, '2021-04-20 02:39:34', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', '697, 824, 832', '30 Days', 0.10),
(12, 18, 24, NULL, '21-22/0012', '2021-04-03', 0, '', '', 0.00, 0, 0.000, 2, 9, 9, 0, 0, NULL, '2021-04-20 02:46:00', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', '0010', '30 Days', 0.10),
(13, 18, 28, NULL, '21-22/0013', '2021-04-03', 0, '', '', 0.00, 0, 0.000, 5, 9, 9, 0, 0, NULL, '2021-04-20 02:53:21', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', '26', '30 Days', 0.10),
(14, 18, 29, NULL, '21-22/0014', '2021-04-03', 0, '', '', 0.00, 0, 0.000, 19, 0, 0, 18, 0, NULL, '2021-04-20 03:04:21', NULL, NULL, 0, 'New Era Transport', 'Maharashtra', '', '454', '30 Days', 0.00),
(15, 18, 27, NULL, '21-22/0015', '2021-04-03', 0, '', '', 0.00, 0, 0.000, 5, 9, 9, 0, 0, NULL, '2021-04-20 03:41:39', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', 'Email Order', '30 Days', 0.00),
(16, 18, 11, NULL, '21-22/0016', '2021-04-03', 0, '', '', 0.00, 0, 0.000, 2, 9, 9, 0, 0, NULL, '2021-04-20 03:44:55', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', 'VE/0009/20-21', '30 Days', 0.00),
(17, 18, 18, NULL, '21-22/0017', '2021-04-04', 0, '', '', 0.00, 0, 0.000, 40, 9, 9, 0, 0, NULL, '2021-04-20 03:54:26', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', '030321-02', '30 Days', 0.10),
(18, 18, 24, NULL, '21-22/0018', '2021-04-04', 0, '', '', 0.00, 0, 0.000, 3, 9, 9, 0, 0, NULL, '2021-04-20 03:57:52', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', '0010', '30 Days', 0.10),
(19, 18, 27, NULL, '21-22/0019', '2021-04-04', 0, '', '', 0.00, 0, 0.000, 44, 9, 9, 0, 0, NULL, '2021-04-20 04:00:38', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', 'Email Order', '30 Days', 0.00),
(20, 18, 27, NULL, '21-22/0020', '2021-04-04', 0, '', '', 0.00, 0, 0.000, 27, 9, 9, 0, 0, NULL, '2021-04-20 04:04:20', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', 'Email Order', '30 Days', 0.00),
(21, 18, 27, NULL, '21-22/0021', '2021-04-04', 0, '', '', 0.00, 0, 0.000, 42, 9, 9, 0, 0, NULL, '2021-04-20 04:08:04', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', 'Email Order', '30 Days', 0.00),
(22, 18, 30, NULL, '21-22/0022', '2021-04-04', 0, '', '', 0.00, 0, 0.000, 30, 9, 9, 0, 0, NULL, '2021-04-20 04:14:48', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', '0299/2019-20', '30 Days', 0.10),
(23, 18, 31, NULL, '21-22/0023', '2021-04-04', 0, '', '', 0.00, 0, 0.000, 6, 9, 9, 0, 0, NULL, '2021-04-20 04:26:54', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', 'Email Order', '30 Days', 0.00),
(24, 18, 32, NULL, '21-22/0024', '2021-04-04', 0, '', '', 0.00, 0, 0.000, 20, 9, 9, 0, 0, NULL, '2021-04-20 04:38:20', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', '3003150421', '30 Days', 0.10),
(25, 18, 19, NULL, '21-22/0025', '2021-04-04', 0, '', '', 0.00, 0, 0.000, 14, 9, 9, 0, 0, NULL, '2021-04-20 04:41:35', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', 'PBWPL28715', '30 Days', 0.10),
(26, 18, 37, NULL, '21-22/0026', '2021-04-05', 0, '', '', 0.00, 0, 0.000, 15, 9, 9, 0, 0, NULL, '2021-04-22 02:42:09', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', 'Email Order', '30 Days', 0.00),
(27, 18, 11, NULL, '21-22/0027', '2021-04-05', 0, '', '', 0.00, 0, 0.000, 2, 9, 9, 0, 0, NULL, '2021-04-22 03:01:25', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', 'VE/0008/20-21', '30 Days', 0.00),
(28, 18, 24, NULL, '21-22/0028', '2021-04-05', 0, '', '', 0.00, 0, 0.000, 4, 9, 9, 0, 0, NULL, '2021-04-22 03:07:30', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', '0010', '30 Days', 0.10),
(29, 18, 38, NULL, '21-22/0029', '2021-04-05', 0, '', '', 0.00, 0, 0.000, 13, 6, 6, 0, 0, NULL, '2021-04-22 03:13:17', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', 'Email Order', '30 Days', 0.00),
(30, 18, 32, NULL, '21-22/0030', '2021-04-05', 0, '', '', 0.00, 0, 0.000, 23, 9, 9, 0, 0, NULL, '2021-04-22 04:48:04', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', '3003150421', '30 Days', 0.10),
(31, 18, 39, NULL, '21-22/0031', '2021-04-05', 0, '', '', 0.00, 0, 0.000, 6, 9, 9, 0, 0, NULL, '2021-04-22 05:25:50', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', 'Email Order', '30 Days', 0.00),
(32, 18, 28, NULL, '21-22/0032', '2021-04-05', 0, '', '', 0.00, 0, 0.000, 10, 9, 9, 0, 0, NULL, '2021-04-22 05:29:33', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', '26', '30 Days', 0.10),
(33, 18, 18, NULL, '21-22/0033', '2021-04-05', 0, '', '', 0.00, 0, 0.000, 40, 9, 9, 0, 0, NULL, '2021-04-22 08:07:10', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', '030321-02', '30 Days', 0.10),
(34, 18, 40, NULL, '21-22/0034', '2021-04-05', 0, '', '', 0.00, 0, 0.000, 14, 9, 9, 0, 0, NULL, '2021-04-22 08:14:51', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', 'Telephonic', '30 Days', 0.00),
(35, 18, 22, NULL, '21-22/0035', '2021-04-05', 0, '', '', 0.00, 0, 0.000, 15, 9, 9, 0, 1, NULL, '2021-04-22 08:17:52', 1, '2021-04-22 13:54:00', 0, 'Local Rikshaw', 'Gujarat', '', '828, 832', '30 Days', 0.10),
(36, 18, 22, NULL, '21-22/0035', '2021-04-05', 0, '', '', 0.00, 0, 0.000, 15, 9, 9, 0, 0, NULL, '2021-04-22 08:18:50', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', '828, 832', '30 Days', 0.10),
(37, 18, 41, NULL, '21-22/0036', '2021-04-05', 0, '', '', 0.00, 0, 0.000, 10, 9, 9, 0, 0, NULL, '2021-04-22 08:28:37', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', '35/20-21', '30 Days', 0.10),
(38, 18, 26, NULL, '21-22/0037', '2021-04-05', 0, '', '', 0.00, 0, 0.000, 100, 0, 0, 18, 0, NULL, '2021-04-22 08:34:59', NULL, NULL, 0, 'Local Rikshaw', 'Maharashtra', '', 'JD20PO0434', '30 Days', 0.00),
(39, 18, 32, NULL, '21-22/0038', '2021-04-06', 0, '', '', 0.00, 0, 0.000, 5, 9, 9, 0, 0, NULL, '2021-04-22 08:36:47', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', '3003150421', '30 Days', 0.10),
(40, 18, 24, NULL, '21-22/0039', '2021-04-06', 0, '', '', 0.00, 0, 0.000, 2, 9, 9, 0, 0, NULL, '2021-04-22 08:39:35', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', '0010', '30 Days', 0.10),
(41, 18, 18, NULL, '21-22/0040', '2021-04-06', 0, '', '', 0.00, 0, 0.000, 40, 9, 9, 0, 0, NULL, '2021-04-22 08:40:52', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', '030321-02', '30 Days', 0.10),
(42, 18, 22, NULL, '21-22/0041', '2021-04-06', 0, '', '', 0.00, 0, 0.000, 2, 9, 9, 0, 0, NULL, '2021-04-22 08:43:45', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', 'Telephonic', '30 Days', 0.10),
(43, 18, 25, NULL, '21-22/0042', '2021-04-06', 0, '', '', 4000.00, 0, 0.000, 15, 0, 0, 18, 0, NULL, '2021-04-22 08:48:08', NULL, NULL, 2001915454, 'Rivigo Services Pvt. Ltd.', 'Himachal Pradesh', '', 'JSKEPO03377', '30 Days', 0.10),
(44, 18, 28, NULL, '21-22/0043', '2021-04-06', 0, '', '', 0.00, 0, 0.000, 5, 9, 9, 0, 0, NULL, '2021-04-22 08:51:21', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', '26', '30 Days', 0.10),
(45, 18, 19, NULL, '21-22/0044', '2021-04-07', 0, '', '', 0.00, 0, 0.000, 19, 9, 9, 0, 0, NULL, '2021-04-22 08:52:39', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', '10321', '30 Days', 0.10),
(46, 18, 42, NULL, '21-22/0045', '2021-04-07', 0, '', '', 0.00, 0, 0.000, 0, 9, 9, 0, 0, NULL, '2021-04-22 09:06:04', NULL, NULL, 0, 'Tractor', 'Gujarat', '', 'Telephonic', '30 Days', 0.10),
(47, 18, 37, NULL, '21-22/0046', '2021-04-07', 0, '', '', 0.00, 0, 0.000, 12, 9, 9, 0, 0, NULL, '2021-04-22 09:07:57', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', 'Email Order', '30 Days', 0.00),
(48, 18, 27, NULL, '21-22/0047', '2021-04-07', 0, '', '', 0.00, 0, 0.000, 8, 9, 9, 0, 0, NULL, '2021-04-22 09:11:01', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', 'Email Order', '30 Days', 0.00),
(49, 18, 20, NULL, '21-22/0048', '2021-04-07', 0, '', '', 0.00, 0, 0.000, 12, 9, 9, 0, 0, NULL, '2021-04-22 09:12:33', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', 'Email Order', '30 Days', 0.10),
(50, 18, 30, NULL, '21-22/0049', '2021-04-07', 0, '', '', 0.00, 0, 0.000, 38, 9, 9, 0, 0, NULL, '2021-04-22 09:13:14', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', '0299/2019-20', '30 Days', 0.10),
(51, 18, 30, NULL, '21-22/0050', '2021-04-07', 0, '', '', 0.00, 0, 0.000, 29, 9, 9, 0, 0, NULL, '2021-04-22 09:14:18', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', '0299/2019-20', '30 Days', 0.10),
(52, 18, 31, NULL, '21-22/0051', '2021-04-07', 0, '', '', 0.00, 0, 0.000, 19, 9, 9, 0, 0, NULL, '2021-04-22 09:16:03', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', 'Email Order', '30 Days', 0.00),
(53, 18, 28, NULL, '21-22/0052', '2021-04-07', 0, '', '', 0.00, 0, 0.000, 16, 9, 9, 0, 0, NULL, '2021-04-22 09:22:39', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', '26', '30 Days', 0.10),
(54, 18, 32, NULL, '21-22/0053', '2021-04-07', 0, '', '', 0.00, 0, 0.000, 31, 9, 9, 0, 0, NULL, '2021-04-22 09:24:33', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', '3003150421', '30 Days', 0.10),
(55, 18, 19, NULL, '21-22/0054', '2021-04-08', 0, '', '', 0.00, 0, 0.000, 25, 9, 9, 0, 0, NULL, '2021-04-22 09:26:13', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', '09022021, PBWPL28715', '30 Days', 0.10),
(56, 18, 18, NULL, '21-22/0055', '2021-04-08', 0, '', '', 0.00, 0, 0.000, 40, 9, 9, 0, 0, NULL, '2021-04-22 09:30:10', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', '030321-01, 010421-01', '30 Days', 0.10),
(57, 18, 18, NULL, '21-22/0056', '2021-04-08', 0, '', '', 0.00, 0, 0.000, 47, 9, 9, 0, 0, NULL, '2021-04-22 09:32:02', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', '030321-01, 010421-01', '30 Days', 0.10),
(58, 18, 43, NULL, '21-22/0057', '2021-04-08', 0, '', '', 0.00, 0, 0.000, 25, 9, 9, 0, 0, NULL, '2021-04-22 09:38:38', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', 'PO1564', '30 Days', 0.00),
(59, 18, 19, NULL, '21-22/0058', '2021-04-08', 0, '', '', 0.00, 0, 0.000, 1, 9, 9, 0, 0, NULL, '2021-04-22 09:42:58', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', '240321', '30 Days', 0.10),
(60, 18, 13, NULL, '21-22/0059', '2021-04-08', 0, '', '', 0.00, 0, 0.000, 16, 0, 0, 18, 0, NULL, '2021-04-22 09:48:28', NULL, NULL, 0, 'V Trans India Limited', 'Maharashtra', '', '5000026248', '30 Days', 0.00),
(61, 18, 22, NULL, '21-22/0060', '2021-04-08', 0, '', '', 0.00, 0, 0.000, 10, 9, 9, 0, 0, NULL, '2021-04-22 09:49:43', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', '827', '30 Days', 0.10),
(62, 18, 24, NULL, '21-22/0061', '2021-04-08', 0, '', '', 0.00, 0, 0.000, 3, 9, 9, 0, 0, NULL, '2021-04-22 09:53:30', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', '0013', '30 Days', 0.10),
(63, 18, 31, NULL, '21-22/0062', '2021-04-08', 0, '', '', 0.00, 0, 0.000, 18, 9, 9, 0, 0, NULL, '2021-04-22 09:56:10', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', 'Email Order', '30 Days', 0.00),
(64, 18, 20, NULL, '21-22/0063', '2021-04-08', 0, '', '', 0.00, 0, 0.000, 6, 9, 9, 0, 0, NULL, '2021-04-22 10:00:05', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', 'Email Order', '30 Days', 0.10),
(65, 18, 27, NULL, '21-22/0064', '2021-04-10', 0, '', '', 0.00, 0, 0.000, 4, 9, 9, 0, 0, NULL, '2021-04-22 10:00:48', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', 'Email Order', '30 Days', 0.00),
(66, 18, 41, NULL, '21-22/0065', '2021-04-10', 0, '', '', 0.00, 0, 0.000, 40, 9, 9, 0, 0, NULL, '2021-04-22 10:39:31', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', '31/20-21', '30 Days', 0.10),
(67, 18, 32, NULL, '21-22/0066', '2021-04-10', 0, '', '', 0.00, 0, 0.000, 10, 9, 9, 0, 0, NULL, '2021-04-22 10:42:58', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', '3003150421', '30 Days', 0.10),
(68, 18, 28, NULL, '21-22/0067', '2021-04-10', 0, '', '', 0.00, 0, 0.000, 7, 9, 9, 0, 0, NULL, '2021-04-22 10:49:42', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', '26', '30 Days', 0.10),
(69, 18, 19, NULL, '21-22/0068', '2021-04-10', 0, '', '', 0.00, 0, 0.000, 7, 9, 9, 0, 0, NULL, '2021-04-22 10:51:34', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', '17032021', '30 Days', 0.10),
(70, 18, 22, NULL, '21-22/0069', '2021-04-10', 0, '', '', 0.00, 0, 0.000, 10, 9, 9, 0, 0, NULL, '2021-04-22 12:00:06', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', '824, 827', '30 Days', 0.10),
(71, 18, 20, NULL, '21-22/0070', '2021-04-10', 0, '', '', 0.00, 0, 0.000, 5, 9, 9, 0, 0, NULL, '2021-04-22 12:02:19', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', 'Email Order', '30 Days', 0.10),
(72, 18, 31, NULL, '21-22/0071', '2021-04-10', 0, '', '', 0.00, 0, 0.000, 14, 9, 9, 0, 0, NULL, '2021-04-22 12:03:12', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', 'Email Order', '30 Days', 0.00),
(73, 18, 24, NULL, '21-22/0072', '2021-04-10', 0, '', '', 0.00, 0, 0.000, 1, 9, 9, 0, 0, NULL, '2021-04-22 12:06:00', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', '0013', '30 Days', 0.10),
(74, 18, 43, NULL, '21-22/0073', '2021-04-10', 0, '', '', 0.00, 0, 0.000, 1, 9, 9, 0, 0, NULL, '2021-04-24 05:27:03', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', '', '30 Days', 0.00),
(75, 18, 44, NULL, '21-22/0074', '2021-04-10', 0, '', '', 0.00, 0, 0.000, 0, 0, 0, 0, 0, NULL, '2021-04-25 08:58:25', NULL, NULL, 0, '', '', '', '', '30 Days', 0.00),
(76, 18, 45, NULL, '21-22/0075', '2021-04-11', 0, '', '', 0.00, 0, 0.000, 11, 9, 9, 0, 0, NULL, '2021-04-25 09:04:09', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', 'DOM/20/21-405', '30 Days', 0.10),
(77, 18, 47, NULL, '21-22/0076', '2021-04-11', 0, '', '', 0.00, 0, 0.000, 10, 9, 9, 0, 0, NULL, '2021-04-25 10:39:17', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', 'Telephonic', '30 Days', 0.00),
(78, 18, 48, NULL, '21-22/0077', '2021-04-11', 0, '', '', 0.00, 0, 0.000, 46, 0, 0, 18, 0, NULL, '2021-04-25 11:05:13', NULL, NULL, 3014, 'Shree Haridwar Logistics', 'Uttarakhand', '', '201048782', '30 Days', 0.10),
(79, 18, 17, NULL, '21-22/0078', '2021-04-11', 0, '', '', 0.00, 0, 0.000, 27, 0, 0, 18, 0, NULL, '2021-04-25 11:14:36', NULL, NULL, 22, 'Shree Haridwar Logistics', 'Uttarakhand', '', '207026508', '45 Days', 0.10),
(80, 18, 17, NULL, '21-22/0079', '2021-04-11', 0, '', '', 0.00, 0, 0.000, 319, 0, 0, 18, 0, NULL, '2021-04-25 11:18:15', NULL, NULL, 22, 'Shree Haridwar Logistics', 'Uttarakhand', '', '207027130', '30 Days', 0.10),
(81, 18, 19, NULL, '21-22/0080', '2021-04-11', 0, '', '', 0.00, 0, 0.000, 4, 9, 9, 0, 0, NULL, '2021-04-25 11:22:44', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', '240321', '30 Days', 0.10),
(82, 18, 41, NULL, '21-22/0081', '2021-04-11', 0, '', '', 0.00, 0, 0.000, 22, 9, 9, 0, 0, NULL, '2021-04-25 11:27:41', NULL, NULL, 0, 'Local Rikshaw', 'Gujarat', '', '35/20-21, 1/21-22', '30 Days', 0.10);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice_payment`
--

CREATE TABLE `tbl_invoice_payment` (
  `id` int(11) NOT NULL,
  `invoiceid` int(11) NOT NULL,
  `date` date NOT NULL,
  `amount` decimal(20,3) NOT NULL,
  `exchange_rate` decimal(10,3) NOT NULL,
  `price_in_inr` decimal(30,3) NOT NULL,
  `advice_no` varchar(150) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `detail` varchar(255) NOT NULL,
  `isdelete` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice_sub`
--

CREATE TABLE `tbl_invoice_sub` (
  `id` int(11) NOT NULL,
  `invoiceid` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `weight` decimal(10,3) DEFAULT NULL,
  `rate_type` int(10) DEFAULT NULL,
  `rate` decimal(10,4) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `isdelete` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_invoice_sub`
--

INSERT INTO `tbl_invoice_sub` (`id`, `invoiceid`, `item_id`, `qty`, `weight`, `rate_type`, `rate`, `amount`, `isdelete`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(1, 1, 50, 0, 167.500, 1, 79.0000, 13232.50, 0, NULL, '2021-04-19 04:30:40', NULL, NULL),
(2, 2, 54, 86486, 160.000, 0, 1.2610, 109058.85, 0, NULL, '2021-04-19 08:48:45', NULL, NULL),
(3, 3, 40, 320000, 230.400, 0, 0.2500, 80000.00, 0, NULL, '2021-04-19 08:58:01', NULL, NULL),
(4, 4, 56, 600000, 359.400, 0, 0.2815, 168900.00, 0, NULL, '2021-04-19 09:07:09', NULL, NULL),
(5, 5, 57, 1000000, 2730.000, 0, 0.3950, 395000.00, 0, NULL, '2021-04-19 09:14:17', NULL, NULL),
(6, 6, 45, 0, 1008.700, 1, 112.0000, 112974.40, 0, NULL, '2021-04-19 09:19:03', NULL, NULL),
(7, 7, 58, 1043896, 803.800, 0, 0.1465, 152930.76, 0, NULL, '2021-04-20 02:25:01', NULL, NULL),
(8, 7, 59, 298030, 136.200, 0, 0.0980, 29206.94, 0, NULL, '2021-04-20 02:25:25', NULL, NULL),
(9, 8, 60, 1019777, 1376.700, 0, 0.2185, 222821.27, 0, NULL, '2021-04-20 02:29:58', NULL, NULL),
(10, 9, 36, 2000000, 958.000, 0, 0.0961, 192200.00, 0, NULL, '2021-04-20 02:33:02', NULL, NULL),
(11, 9, 37, 1000000, 108.500, 0, 0.1074, 107400.00, 0, NULL, '2021-04-20 02:33:25', NULL, NULL),
(12, 9, 38, 600000, 490.275, 0, 0.2034, 122040.00, 0, NULL, '2021-04-20 02:33:43', NULL, NULL),
(13, 10, 35, 5000000, 3252.000, 0, 0.1356, 678000.00, 0, NULL, '2021-04-20 02:36:45', NULL, NULL),
(14, 10, 39, 100000, 73.600, 0, 0.1865, 18650.00, 0, NULL, '2021-04-20 02:37:04', NULL, NULL),
(15, 11, 61, 150000, 394.500, 0, 0.2795, 41925.00, 0, NULL, '2021-04-20 02:43:17', NULL, NULL),
(16, 11, 61, 123764, 325.500, 0, 0.2080, 25742.91, 0, NULL, '2021-04-20 02:43:56', NULL, NULL),
(17, 11, 62, 418810, 351.800, 0, 0.1410, 59052.21, 0, NULL, '2021-04-20 02:44:15', NULL, NULL),
(18, 12, 54, 43243, 80.000, 0, 1.2610, 54529.42, 0, NULL, '2021-04-20 02:46:24', NULL, NULL),
(19, 13, 63, 220220, 200.400, 0, 0.1610, 35455.42, 0, NULL, '2021-04-20 02:55:21', NULL, NULL),
(20, 14, 64, 0, 207.200, 1, 138.0000, 28593.60, 0, NULL, '2021-04-20 03:36:15', NULL, NULL),
(21, 14, 65, 0, 276.900, 1, 137.0000, 37935.30, 0, NULL, '2021-04-20 03:36:36', NULL, NULL),
(22, 14, 66, 0, 155.200, 1, 140.0000, 21728.00, 0, NULL, '2021-04-20 03:36:58', NULL, NULL),
(23, 14, 67, 0, 312.200, 1, 139.0000, 43395.80, 0, NULL, '2021-04-20 03:37:16', NULL, NULL),
(24, 15, 68, 300000, 120.000, 0, 0.0875, 26250.00, 0, NULL, '2021-04-20 03:43:38', NULL, NULL),
(25, 16, 69, 0, 90.000, 1, 152.0000, 13680.00, 0, NULL, '2021-04-20 03:53:09', NULL, NULL),
(26, 17, 70, 717642, 1004.700, 0, 0.2150, 154293.03, 0, NULL, '2021-04-20 03:56:43', NULL, NULL),
(27, 18, 54, 64865, 120.000, 0, 1.2610, 81794.76, 0, NULL, '2021-04-20 03:58:33', NULL, NULL),
(28, 19, 71, 526315, 1100.000, 0, 0.3445, 181315.52, 0, NULL, '2021-04-20 04:02:52', NULL, NULL),
(29, 20, 72, 1052940, 626.500, 0, 0.1310, 137935.14, 0, NULL, '2021-04-20 04:06:22', NULL, NULL),
(30, 20, 68, 187500, 75.000, 0, 0.0875, 16406.25, 0, NULL, '2021-04-20 04:06:47', NULL, NULL),
(31, 21, 71, 501100, 1047.300, 0, 0.3445, 172628.95, 0, NULL, '2021-04-20 04:08:29', NULL, NULL),
(32, 22, 73, 0, 500.600, 1, 177.0000, 88606.20, 0, NULL, '2021-04-20 04:20:11', NULL, NULL),
(33, 22, 74, 0, 250.300, 1, 168.0000, 42050.40, 0, NULL, '2021-04-20 04:20:27', NULL, NULL),
(34, 23, 75, 0, 150.000, 1, 152.0000, 22800.00, 0, NULL, '2021-04-20 04:31:51', NULL, NULL),
(35, 24, 76, 515465, 500.000, 0, 0.1230, 63402.19, 0, NULL, '2021-04-20 04:40:04', NULL, NULL),
(36, 25, 77, 0, 141.000, 1, 129.0000, 18189.00, 0, NULL, '2021-04-20 04:47:38', NULL, NULL),
(37, 25, 78, 0, 400.000, 1, 129.0000, 51600.00, 0, NULL, '2021-04-20 04:47:54', NULL, NULL),
(38, 26, 86, 0, 156.900, 1, 94.0000, 14748.60, 0, NULL, '2021-04-22 02:46:37', NULL, NULL),
(39, 26, 87, 0, 600.000, 1, 84.0000, 50400.00, 0, NULL, '2021-04-22 02:55:54', NULL, NULL),
(40, 27, 18, 0, 63.100, 1, 116.0000, 7319.60, 0, NULL, '2021-04-22 03:03:51', NULL, NULL),
(41, 28, 54, 86486, 160.000, 0, 1.2610, 109058.85, 0, NULL, '2021-04-22 03:07:49', NULL, NULL),
(42, 29, 88, 578836, 497.800, 0, 0.0900, 52095.24, 0, NULL, '2021-04-22 03:17:52', NULL, NULL),
(43, 30, 89, 1203703, 650.000, 0, 0.0925, 111342.53, 0, NULL, '2021-04-22 04:49:45', NULL, NULL),
(44, 31, 90, 96507, 243.200, 0, 1.0655, 102828.21, 0, NULL, '2021-04-22 05:27:45', NULL, NULL),
(45, 32, 63, 265054, 241.200, 0, 0.1610, 42673.69, 0, NULL, '2021-04-22 05:33:24', NULL, NULL),
(46, 32, 91, 66974, 79.700, 0, 0.1960, 13126.90, 0, NULL, '2021-04-22 05:35:27', NULL, NULL),
(47, 33, 70, 714285, 1000.000, 0, 0.2150, 153571.27, 0, NULL, '2021-04-22 08:07:31', NULL, NULL),
(48, 34, 92, 1271111, 572.000, 0, 0.1035, 131559.99, 0, NULL, '2021-04-22 08:16:35', NULL, NULL),
(49, 36, 93, 109662, 162.300, 0, 0.1820, 19958.48, 0, NULL, '2021-04-22 08:22:08', NULL, NULL),
(50, 36, 94, 21773, 101.900, 0, 0.4875, 10614.34, 0, NULL, '2021-04-22 08:22:31', NULL, NULL),
(51, 36, 95, 58485, 312.900, 0, 0.5375, 31435.69, 0, NULL, '2021-04-22 08:22:56', NULL, NULL),
(52, 37, 96, 26086, 54.000, 0, 0.2770, 7225.82, 0, NULL, '2021-04-22 08:31:15', NULL, NULL),
(53, 37, 97, 125093, 201.400, 0, 0.2315, 28959.03, 0, NULL, '2021-04-22 08:32:12', NULL, NULL),
(54, 38, 57, 1000000, 2735.400, 0, 0.3950, 395000.00, 0, NULL, '2021-04-22 08:35:30', NULL, NULL),
(55, 39, 98, 54545, 120.000, 0, 0.2450, 13363.52, 0, NULL, '2021-04-22 08:38:00', NULL, NULL),
(56, 40, 54, 35891, 66.400, 0, 1.2610, 45258.55, 0, NULL, '2021-04-22 08:39:50', NULL, NULL),
(57, 41, 70, 714285, 1000.000, 0, 0.2150, 153571.27, 0, NULL, '2021-04-22 08:41:13', NULL, NULL),
(58, 42, 99, 98644, 58.200, 0, 0.0980, 9667.11, 0, NULL, '2021-04-22 08:46:41', NULL, NULL),
(59, 43, 56, 550000, 324.500, 0, 0.2815, 154825.00, 0, NULL, '2021-04-22 08:48:39', NULL, NULL),
(60, 43, 100, 100000, 72.000, 0, 0.2850, 28500.00, 0, NULL, '2021-04-22 08:50:09', NULL, NULL),
(61, 44, 91, 99833, 119.800, 0, 0.1960, 19567.27, 0, NULL, '2021-04-22 08:51:39', NULL, NULL),
(62, 45, 45, 0, 760.000, 1, 112.0000, 85120.00, 0, NULL, '2021-04-22 08:53:03', NULL, NULL),
(63, 47, 87, 0, 156.500, 1, 89.0000, 13928.50, 0, NULL, '2021-04-22 09:08:21', NULL, NULL),
(64, 47, 101, 0, 545.600, 1, 87.0000, 47467.20, 0, NULL, '2021-04-22 09:10:10', NULL, NULL),
(65, 48, 68, 500000, 200.000, 0, 0.0875, 43750.00, 0, NULL, '2021-04-22 09:11:24', NULL, NULL),
(66, 50, 74, 0, 950.000, 1, 168.0000, 159600.00, 0, NULL, '2021-04-22 09:13:30', NULL, NULL),
(67, 51, 73, 0, 725.000, 1, 177.0000, 128325.00, 0, NULL, '2021-04-22 09:14:33', NULL, NULL),
(68, 52, 75, 0, 329.200, 1, 152.0000, 50038.40, 0, NULL, '2021-04-22 09:16:21', NULL, NULL),
(69, 52, 102, 0, 119.800, 1, 117.0000, 14016.60, 0, NULL, '2021-04-22 09:19:41', NULL, NULL),
(70, 52, 103, 0, 69.000, 1, 178.0000, 12282.00, 0, NULL, '2021-04-22 09:19:56', NULL, NULL),
(71, 53, 63, 246593, 224.400, 0, 0.1610, 39701.47, 0, NULL, '2021-04-22 09:22:59', NULL, NULL),
(72, 53, 91, 133583, 160.300, 0, 0.1960, 26182.27, 0, NULL, '2021-04-22 09:23:21', NULL, NULL),
(73, 54, 98, 345727, 760.600, 0, 0.2450, 84703.12, 0, NULL, '2021-04-22 09:24:55', NULL, NULL),
(74, 55, 104, 0, 741.400, 1, 105.0000, 77847.00, 0, NULL, '2021-04-22 09:28:04', NULL, NULL),
(75, 55, 78, 0, 352.300, 1, 129.0000, 45446.70, 0, NULL, '2021-04-22 09:28:29', NULL, NULL),
(76, 56, 44, 370000, 706.700, 0, 0.3470, 128390.00, 0, NULL, '2021-04-22 09:30:26', NULL, NULL),
(77, 56, 44, 153560, 293.300, 0, 0.3470, 53285.32, 0, NULL, '2021-04-22 09:30:41', NULL, NULL),
(78, 57, 70, 517857, 725.000, 0, 0.2150, 111339.26, 0, NULL, '2021-04-22 09:32:30', NULL, NULL),
(79, 57, 44, 235602, 450.000, 0, 0.3470, 81753.89, 0, NULL, '2021-04-22 09:32:51', NULL, NULL),
(80, 58, 105, 196850, 500.000, 0, 0.4245, 83562.82, 0, NULL, '2021-04-22 09:40:30', NULL, NULL),
(81, 59, 106, 0, 40.000, 1, 127.0000, 5080.00, 0, NULL, '2021-04-22 09:45:27', NULL, NULL),
(82, 60, 40, 320000, 229.760, 0, 0.2500, 80000.00, 0, NULL, '2021-04-22 09:48:46', NULL, NULL),
(83, 61, 107, 202065, 371.800, 0, 0.2470, 49910.06, 0, NULL, '2021-04-22 09:51:55', NULL, NULL),
(84, 62, 108, 185185, 150.000, 0, 0.1650, 30555.53, 0, NULL, '2021-04-22 09:54:51', NULL, NULL),
(85, 63, 75, 0, 119.900, 1, 152.0000, 18224.80, 0, NULL, '2021-04-22 09:56:31', NULL, NULL),
(86, 63, 102, 0, 440.000, 1, 117.0000, 51480.00, 0, NULL, '2021-04-22 09:56:46', NULL, NULL),
(87, 63, 109, 0, 159.800, 1, 145.0000, 23171.00, 0, NULL, '2021-04-22 09:58:51', NULL, NULL),
(88, 65, 68, 211500, 84.600, 0, 0.0875, 18506.25, 0, NULL, '2021-04-22 10:01:14', NULL, NULL),
(89, 66, 110, 695633, 987.800, 0, 0.1750, 121735.77, 0, NULL, '2021-04-22 10:41:01', NULL, NULL),
(90, 67, 111, 123456, 100.000, 0, 0.1650, 20370.24, 0, NULL, '2021-04-22 10:45:55', NULL, NULL),
(91, 67, 112, 187500, 150.000, 0, 0.1185, 22218.75, 0, NULL, '2021-04-22 10:46:15', NULL, NULL),
(92, 68, 91, 133333, 160.000, 0, 0.1960, 26133.27, 0, NULL, '2021-04-22 10:50:00', NULL, NULL),
(93, 69, 113, 0, 260.200, 1, 743.0000, 193328.60, 0, NULL, '2021-04-22 10:56:22', NULL, NULL),
(94, 70, 114, 208508, 377.400, 0, 0.2030, 42327.12, 0, NULL, '2021-04-22 12:01:24', NULL, NULL),
(95, 72, 102, 0, 320.000, 1, 117.0000, 37440.00, 0, NULL, '2021-04-22 12:03:53', NULL, NULL),
(96, 72, 75, 0, 159.900, 1, 152.0000, 24304.80, 0, NULL, '2021-04-22 12:04:08', NULL, NULL),
(97, 72, 109, 0, 79.800, 1, 145.0000, 11571.00, 0, NULL, '2021-04-22 12:04:24', NULL, NULL),
(98, 71, 115, 0, 85.100, 1, 92.0000, 7829.20, 0, NULL, '2021-04-24 05:10:08', NULL, NULL),
(99, 71, 116, 0, 98.500, 1, 101.0000, 9948.50, 0, NULL, '2021-04-24 05:11:33', NULL, NULL),
(100, 73, 117, 31746, 40.000, 0, 1.1640, 36952.34, 0, NULL, '2021-04-24 05:25:10', NULL, NULL),
(101, 74, 118, 24193, 22.500, 0, 0.1970, 4766.02, 0, NULL, '2021-04-24 05:28:53', NULL, NULL),
(102, 64, 116, 0, 120.000, 1, 101.0000, 12120.00, 0, NULL, '2021-04-24 05:49:01', NULL, NULL),
(103, 64, 119, 0, 105.800, 1, 87.0000, 9204.60, 0, NULL, '2021-04-24 05:50:45', NULL, NULL),
(104, 49, 120, 0, 306.400, 1, 93.0000, 28495.20, 0, NULL, '2021-04-24 06:05:49', NULL, NULL),
(105, 49, 121, 0, 51.700, 1, 92.0000, 4756.40, 0, NULL, '2021-04-24 06:06:39', NULL, NULL),
(106, 49, 122, 0, 98.100, 1, 83.0000, 8142.30, 0, NULL, '2021-04-24 06:06:56', NULL, NULL),
(107, 76, 123, 247747, 275.000, 0, 0.8530, 211328.19, 0, NULL, '2021-04-25 09:06:28', NULL, NULL),
(108, 77, 126, 888888, 400.000, 0, 0.1035, 91999.91, 0, NULL, '2021-04-25 10:40:40', NULL, NULL),
(109, 78, 127, 150000, 107.250, 0, 0.1802, 27030.00, 0, NULL, '2021-04-25 11:08:31', NULL, NULL),
(110, 78, 128, 1000000, 817.000, 0, 0.1923, 192300.00, 0, NULL, '2021-04-25 11:08:48', NULL, NULL),
(111, 79, 37, 800000, 86.800, 0, 0.1074, 85920.00, 0, NULL, '2021-04-25 11:14:57', NULL, NULL),
(112, 79, 38, 600000, 491.325, 0, 0.2034, 122040.00, 0, NULL, '2021-04-25 11:15:24', NULL, NULL),
(113, 80, 37, 700000, 75.950, 0, 0.1074, 75180.00, 0, NULL, '2021-04-25 11:18:57', NULL, NULL),
(114, 80, 35, 7000000, 4547.000, 0, 0.1356, 949200.00, 0, NULL, '2021-04-25 11:19:16', NULL, NULL),
(115, 80, 36, 1500000, 719.600, 0, 0.0961, 144150.00, 0, NULL, '2021-04-25 11:19:35', NULL, NULL),
(116, 80, 39, 150000, 109.350, 0, 0.1865, 27975.00, 0, NULL, '2021-04-25 11:20:00', NULL, NULL),
(117, 81, 106, 0, 167.400, 1, 127.0000, 21259.80, 0, NULL, '2021-04-25 11:23:15', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item`
--

CREATE TABLE `tbl_item` (
  `id` int(11) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `item_number` varchar(20) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `category_id` int(10) NOT NULL,
  `opening_stock` int(20) NOT NULL,
  `description` varchar(50) NOT NULL,
  `isdelete` tinyint(2) NOT NULL,
  `created_by` int(10) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(10) NOT NULL,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item_category`
--

CREATE TABLE `tbl_item_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `isdelete` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_item_category`
--

INSERT INTO `tbl_item_category` (`id`, `category_name`, `description`, `isdelete`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(9, 'Tooling', 'Tooling description.', 0, 1, '2021-03-17 09:01:56', 1, '2021-03-18 16:54:56'),
(10, 'Raw Wire', 'Raw Wire description.', 0, 1, '2021-03-17 09:02:32', 1, '2021-03-18 16:55:08'),
(11, 'Finish Goods', 'Finish Goods description.', 0, 1, '2021-03-17 09:03:00', 5, '2021-03-25 15:14:31'),
(12, 'Job Work', '', 0, 1, '2021-04-22 03:14:28', 1, '2021-04-22 08:44:28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item_parameters`
--

CREATE TABLE `tbl_item_parameters` (
  `id` int(11) NOT NULL,
  `subid` int(11) NOT NULL,
  `parameter_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `isdelete` tinyint(11) DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_item_parameters`
--

INSERT INTO `tbl_item_parameters` (`id`, `subid`, `parameter_name`, `description`, `isdelete`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(5, 5, 'OD', 'OD Description', 0, 1, '2021-03-17 09:07:32', 1, '2021-03-17 14:37:32'),
(6, 5, 'Length', 'Length Description', 0, 1, '2021-03-17 09:08:46', 1, '2021-03-17 14:38:46'),
(7, 5, 'ID', 'ID Description', 0, 1, '2021-03-17 09:09:42', 1, '2021-03-17 14:39:42');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item_subcategory`
--

CREATE TABLE `tbl_item_subcategory` (
  `id` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `subcategory_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `isdelete` tinyint(11) DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_item_subcategory`
--

INSERT INTO `tbl_item_subcategory` (`id`, `cid`, `subcategory_name`, `description`, `isdelete`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(5, 11, 'MS Screw', 'Screw description.', 0, 1, '2021-03-17 09:05:53', 5, '2021-03-25 15:14:58'),
(6, 10, 'MS Wire', '', 0, 1, '2021-03-26 11:39:24', 1, '2021-03-26 17:09:24'),
(7, 11, 'Brass Screw', '', 0, 1, '2021-04-18 06:04:34', 1, '2021-04-18 11:34:34'),
(8, 9, 'Screw Making Tools', '', 0, 1, '2021-04-18 10:25:08', 1, '2021-04-18 15:55:08'),
(9, 10, 'Brass Coil Wire', '', 0, 1, '2021-04-20 08:37:03', 1, '2021-04-20 14:07:03'),
(10, 12, 'Job Work - Brass Screw', '', 0, 1, '2021-04-22 03:15:04', 1, '2021-04-22 08:45:04'),
(11, 11, 'MS NUT', '', 0, 1, '2021-04-22 08:44:32', 1, '2021-04-22 14:14:32'),
(12, 11, 'MS SCRAP', '', 0, 1, '2021-04-22 09:06:41', 1, '2021-04-22 14:36:41');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item_unit`
--

CREATE TABLE `tbl_item_unit` (
  `id` int(10) NOT NULL,
  `unit_name` varchar(30) NOT NULL,
  `description` varchar(100) NOT NULL,
  `status` tinyint(2) NOT NULL,
  `isdelete` tinyint(2) NOT NULL,
  `created_by` int(10) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(10) NOT NULL,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_item_unit`
--

INSERT INTO `tbl_item_unit` (`id`, `unit_name`, `description`, `status`, `isdelete`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(1, 'PCS', 'in pcs', 1, 0, 1, '2021-02-08 16:30:20', 1, '2021-02-09 10:01:59');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jobwcustomer_person`
--

CREATE TABLE `tbl_jobwcustomer_person` (
  `id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `name` varchar(155) NOT NULL,
  `email` varchar(50) NOT NULL,
  `designation` varchar(155) NOT NULL,
  `contact_no` bigint(20) NOT NULL,
  `status` int(10) NOT NULL,
  `isdelete` tinyint(10) NOT NULL,
  `created_by` int(10) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(10) NOT NULL,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_jobwcustomer_person`
--

INSERT INTO `tbl_jobwcustomer_person` (`id`, `customer_id`, `name`, `email`, `designation`, `contact_no`, `status`, `isdelete`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(3, 2, 'abc', 'admin342@gmail.com', 'post', 323232322, 1, 0, 1, '2021-03-17 06:41:05', 1, '2021-03-17 12:16:25'),
(4, 2, 'Manoj', 'itp.1admin@gmail.com', 'post', 9724835452, 0, 0, 1, '2021-03-17 06:46:25', 1, '2021-03-17 12:34:23'),
(5, 1, 'onlinekiranade', 'onlinekiranadev@gmail.com', 'post', 9482548250, 0, 0, 1, '2021-03-17 06:48:59', 1, '2021-03-17 12:18:59'),
(6, 3, 'RAHUL', 'dummy1@gmail.com', 'Menegar', 9999999999, 0, 0, 1, '2021-03-17 09:21:06', 1, '2021-03-19 17:38:02'),
(7, 4, 'Smitesh Madhani', '', 'Proprietor', 8866131333, 0, 0, 1, '2021-03-17 09:25:00', 1, '2021-04-18 17:37:20'),
(8, 5, 'Rajesh Abhangi', '', 'Proprietor', 9723734124, 0, 0, 1, '2021-04-18 06:26:04', 1, '2021-04-18 17:35:37'),
(9, 6, 'Shaileshbhai Patodiya', '', 'Proprietor', 9427421553, 0, 0, 1, '2021-04-18 11:32:06', 1, '2021-04-18 17:36:24'),
(10, 7, 'Akash Bhai', '', 'Owner', 8758587773, 0, 0, 1, '2021-04-20 08:41:06', 1, '2021-04-20 14:11:06'),
(11, 8, 'Bhavesh Bhai', '', 'Owner', 9727445432, 0, 0, 1, '2021-04-25 09:50:02', 1, '2021-04-25 15:20:02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jobworker_master`
--

CREATE TABLE `tbl_jobworker_master` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_id` int(10) NOT NULL,
  `tds_no` varchar(20) DEFAULT NULL,
  `party_type` varchar(10) NOT NULL,
  `pan_no` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `country` int(10) NOT NULL,
  `state` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `pincode` int(10) NOT NULL,
  `gst_no` varchar(30) NOT NULL,
  `cgst` int(10) NOT NULL,
  `sgst` int(10) NOT NULL,
  `igst` int(10) NOT NULL,
  `isdelete` tinyint(2) NOT NULL,
  `created_by` int(10) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(10) NOT NULL,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_jobworker_master`
--

INSERT INTO `tbl_jobworker_master` (`id`, `company_name`, `company_id`, `tds_no`, `party_type`, `pan_no`, `address`, `country`, `state`, `city`, `pincode`, `gst_no`, `cgst`, `sgst`, `igst`, `isdelete`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(1, 'RO AHMEDABAD', 4, '', '', 'BN12345J', 'Iris Watson\r\nP.O. Box 283 8562 Fusce Rd.\r\nFrederick Nebraska 20620\r\n(372) 587-2335', 25, '14', 'Floyda', 256125, '29AADCB2230M1ZP', 0, 0, 1, 1, 1, '2021-03-17 06:04:55', 1, '2021-03-17 12:19:58'),
(2, 'BILT GRAPHIC PAPER', 4, '', '', 'M522335H', 'Cecilia Chapman\r\n711-2880 Nulla St.\r\nMankato Mississippi 96522\r\n(257) 563-7401', 1, '12', 'Rajkot', 3232323, '32AADCB2230M1Z2', 0, 0, 1, 1, 1, '2021-03-17 06:18:04', 1, '2021-03-19 17:36:03'),
(3, 'ZINC TECH PROCESS', 8, '', '', 'ATPPM0997A', 'PLOT NO. 3907-B, G.I.D.C., \r\nPHASE - III, DARED, JAMNAGAR\r\nGUJARAT-361004, INDIA', 1, '24', 'JAMNAGAR', 361004, '24ATPPM0997A1ZL', 9, 9, 0, 0, 1, '2021-03-17 09:19:08', 1, '2021-03-24 12:55:11'),
(4, 'RADHE ELECTROPLATERS', 8, '', '', 'CSQPM3318H', 'PLOT NO. 4037/38, G.I.D.C., \r\nPHASE - III, DARED, JAMNAGAR,\r\nGUJARAT-361004, INDIA', 1, '24', 'Jamnagar', 361004, '24CSQPM3318H1ZL', 6, 6, 0, 0, 1, '2021-03-17 09:23:32', 1, '2021-04-18 17:37:53'),
(5, 'AKSHAR ZINC PROCESS', 8, '', '', 'ANPPA5499P', 'Shed No:- 3605, I Road, GIDC, Phase-3,\r\nDared, Jamnagar', 1, '24', 'JAMNAGAR', 361004, '24ANPPA5499P1Z7', 6, 6, 0, 0, 1, '2021-04-18 06:23:16', 1, '2021-04-18 11:53:16'),
(6, 'SHREE KHODIYAR ELECTROPLATERS', 8, '', '', 'ARUPP0869M', 'Plot No:- 135, GIDC, Phase-2, \r\nDared, Jamnagar', 1, '24', 'Jamnagar', 361004, '24ARUPP0869M1ZX', 6, 6, 0, 0, 1, '2021-04-18 09:34:38', 1, '2021-04-18 17:01:19'),
(7, 'HOT WORK SERVICE', 8, '', '', 'AACFH3200P', '8/10, Navrangpura Opp. Hightech,\r\nRajkot - 360 002', 1, '24', 'Rajkot', 360002, '24AACFH3200P1ZM', 6, 6, 0, 0, 1, '2021-04-20 08:39:20', 1, '2021-04-20 14:09:20'),
(8, 'OM ELECTROPLATERS', 8, '', '', 'APLPK5149Q', '58, Udhayog Nagar Road, B/H Bhagvti Hotel, \r\nJamnagar- 361005', 1, '24', 'JAMNAGAR', 361005, '24APLPK5149Q1Z8', 6, 6, 0, 0, 1, '2021-04-25 09:42:57', 1, '2021-04-25 15:12:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jobwork_inword`
--

CREATE TABLE `tbl_jobwork_inword` (
  `id` int(11) NOT NULL,
  `outword_id` int(10) DEFAULT NULL,
  `inword_date` date DEFAULT NULL,
  `challan_no` varchar(50) DEFAULT NULL,
  `isdelete` tinyint(2) DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_jobwork_inword`
--

INSERT INTO `tbl_jobwork_inword` (`id`, `outword_id`, `inword_date`, `challan_no`, `isdelete`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(1, 1, '2021-04-20', '', 1, 1, '2021-04-20 08:34:39', 1, '2021-04-21 14:38:35'),
(2, 1, '2021-04-20', '2', 1, 1, '2021-04-20 08:37:37', 1, '2021-04-21 14:41:14'),
(3, 1, '2021-04-03', '', 0, 1, '2021-04-20 08:47:24', 1, '2021-04-21 14:39:00'),
(4, 2, '2021-04-21', '', 1, 1, '2021-04-21 07:02:04', 1, '2021-04-21 14:42:49'),
(5, 2, '2021-04-21', '', 1, 1, '2021-04-21 07:03:57', 1, '2021-04-21 14:43:02'),
(6, 2, '2021-04-04', '', 0, 1, '2021-04-21 09:13:39', 1, '2021-04-21 14:43:39'),
(7, 3, '2021-04-03', '', 0, 1, '2021-04-21 09:27:08', 1, '2021-04-21 14:57:08'),
(8, 3, '2021-04-21', '', 0, 1, '2021-04-21 10:10:45', 1, '2021-04-21 15:40:45'),
(9, 4, '2021-04-03', '', 1, 1, '2021-04-21 12:26:03', 1, '2021-04-21 17:58:59'),
(10, 4, '2021-04-03', '', 0, 1, '2021-04-21 12:26:37', 1, '2021-04-21 17:56:37'),
(11, 5, '2021-04-03', '', 0, 1, '2021-04-25 10:18:25', 1, '2021-04-25 15:48:25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jobwork_inword_sub`
--

CREATE TABLE `tbl_jobwork_inword_sub` (
  `id` int(11) NOT NULL,
  `inword_id` int(11) DEFAULT NULL,
  `outword_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `weight` decimal(10,3) DEFAULT NULL,
  `isdelete` tinyint(2) DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_jobwork_inword_sub`
--

INSERT INTO `tbl_jobwork_inword_sub` (`id`, `inword_id`, `outword_id`, `item_id`, `qty`, `weight`, `isdelete`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(1, 1, 1, 35, NULL, 120.000, 0, NULL, '2021-04-20 08:37:12', NULL, '2021-04-20 04:37:12'),
(2, 2, 1, 35, NULL, 20.000, 0, NULL, '2021-04-20 08:38:06', NULL, '2021-04-20 04:38:06'),
(3, 3, 1, 57, NULL, 681.100, 0, NULL, '2021-04-21 09:09:17', NULL, '2021-04-21 05:09:17'),
(4, 3, 1, 35, NULL, 761.100, 0, NULL, '2021-04-21 09:09:31', NULL, '2021-04-21 05:09:31'),
(5, 3, 1, 55, NULL, 79.900, 0, NULL, '2021-04-21 09:09:44', NULL, '2021-04-21 05:09:44'),
(6, 3, 1, 40, NULL, 45.900, 0, NULL, '2021-04-21 09:10:02', NULL, '2021-04-21 05:10:02'),
(7, 6, 2, 44, NULL, 399.300, 0, NULL, '2021-04-21 09:13:51', NULL, '2021-04-21 05:13:51'),
(8, 6, 2, 73, NULL, 399.000, 0, NULL, '2021-04-21 09:14:01', NULL, '2021-04-21 05:14:01'),
(9, 6, 2, 74, NULL, 549.800, 0, NULL, '2021-04-21 09:14:12', NULL, '2021-04-21 05:14:12'),
(10, 6, 2, 56, NULL, 149.000, 0, NULL, '2021-04-21 09:14:37', NULL, '2021-04-21 05:14:37'),
(11, 6, 2, 85, NULL, 50.000, 0, NULL, '2021-04-21 09:14:45', NULL, '2021-04-21 05:14:45'),
(12, 7, 3, 38, NULL, 120.000, 0, NULL, '2021-04-21 09:27:20', NULL, '2021-04-21 05:27:20'),
(13, 7, 3, 75, NULL, 79.800, 0, NULL, '2021-04-21 09:27:35', NULL, '2021-04-21 05:33:48'),
(14, 7, 3, 69, NULL, 90.000, 0, NULL, '2021-04-21 09:32:32', NULL, '2021-04-21 05:32:32'),
(15, 7, 3, 68, NULL, 79.700, 0, NULL, '2021-04-21 09:32:43', NULL, '2021-04-21 05:32:43'),
(16, 7, 3, 36, NULL, 159.600, 0, NULL, '2021-04-21 09:32:58', NULL, '2021-04-21 05:32:58'),
(17, 8, 3, 68, NULL, 50.000, 1, NULL, '2021-04-21 10:11:00', 1, NULL),
(18, 10, 4, 35, NULL, 200.000, 0, NULL, '2021-04-21 12:26:43', NULL, '2021-04-21 08:29:58'),
(19, 10, 4, 36, NULL, 80.000, 0, NULL, '2021-04-21 12:26:53', NULL, '2021-04-21 08:26:53'),
(20, 10, 4, 38, NULL, 240.000, 0, NULL, '2021-04-21 12:27:00', NULL, '2021-04-21 08:27:00'),
(21, 11, 5, 56, NULL, 99.800, 0, NULL, '2021-04-25 10:18:37', NULL, '2021-04-25 06:18:37'),
(22, 11, 5, 63, NULL, 120.000, 0, NULL, '2021-04-25 10:18:44', NULL, '2021-04-25 06:18:44');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jobwork_outword`
--

CREATE TABLE `tbl_jobwork_outword` (
  `id` int(11) NOT NULL,
  `jobworker_id` int(11) DEFAULT NULL,
  `challan_date` date DEFAULT NULL,
  `challan_no` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `expected_item` text,
  `dispatched_by` varchar(155) DEFAULT NULL,
  `place_to_supply` varchar(155) DEFAULT NULL,
  `freight_terms` varchar(155) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT '0.00',
  `note` varchar(50) DEFAULT NULL,
  `isdelete` tinyint(2) DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_jobwork_outword`
--

INSERT INTO `tbl_jobwork_outword` (`id`, `jobworker_id`, `challan_date`, `challan_no`, `status`, `expected_item`, `dispatched_by`, `place_to_supply`, `freight_terms`, `amount`, `note`, `isdelete`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(1, 6, '2021-04-01', '21-22/0001', 0, NULL, 'Self', 'GUJARAT', '1', 0.00, '', 0, 1, '2021-04-18 09:36:50', 1, '2021-04-19 14:26:16'),
(2, 7, '2021-04-01', '21-22/0002', 0, NULL, '', 'GUJARAT', '0', 0.00, '', 0, 1, '2021-04-20 09:16:54', 1, '2021-04-20 15:29:13'),
(3, 5, '2021-04-01', '21-22/0003', 0, NULL, '', 'GUJARAT', '1', 0.00, '', 0, 1, '2021-04-21 09:16:43', 1, '2021-04-21 14:47:16'),
(4, 3, '2021-04-01', '21-22/0004', 1, NULL, '', 'GUJRAT', '1', 0.00, '', 0, 1, '2021-04-21 12:23:46', 1, '2021-04-25 15:21:03'),
(5, 8, '2021-04-01', '21-22/0005', 0, NULL, '', 'GUJARAT', '1', 0.00, '', 0, 1, '2021-04-25 09:50:50', 1, '2021-04-25 15:20:50');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jobwork_outword_sub`
--

CREATE TABLE `tbl_jobwork_outword_sub` (
  `id` int(11) NOT NULL,
  `outword_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `process` varchar(155) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `weight` decimal(10,3) DEFAULT NULL,
  `bags` int(11) NOT NULL DEFAULT '0',
  `rate` decimal(10,2) NOT NULL DEFAULT '0.00',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `isdelete` tinyint(2) DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_jobwork_outword_sub`
--

INSERT INTO `tbl_jobwork_outword_sub` (`id`, `outword_id`, `item_id`, `process`, `qty`, `weight`, `bags`, `rate`, `amount`, `isdelete`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(1, 1, 35, 'Yellow Zinc', NULL, 760.000, 19, 85.00, 64600.00, 0, NULL, '2021-04-18 13:48:40', NULL, '2021-04-20 04:11:42'),
(2, 1, 40, '8-10 µ 96 Hrs Blue Trivalent', NULL, 45.000, 1, 80.00, 3600.00, 0, NULL, '2021-04-18 13:49:40', NULL, '2021-04-20 05:19:35'),
(3, 1, 55, 'Yellow Zinc', NULL, 80.000, 2, 80.00, 6400.00, 0, NULL, '2021-04-18 13:52:08', NULL, '2021-04-20 04:11:12'),
(4, 1, 57, 'Light Yellow Zinc 6 µ', NULL, 680.000, 17, 70.00, 47600.00, 0, NULL, '2021-04-20 08:10:36', NULL, '2021-04-20 04:10:36'),
(5, 2, 44, 'Hardening 28-33 Hrc', NULL, 400.000, 8, 75.00, 30000.00, 0, NULL, '2021-04-20 10:00:30', NULL, '2021-04-20 06:01:54'),
(6, 2, 73, 'Hardening 28-33 Hrc', NULL, 400.000, 8, 75.00, 30000.00, 0, NULL, '2021-04-20 10:01:40', NULL, '2021-04-20 06:01:40'),
(7, 2, 74, 'Hardening 28-33 Hrc', NULL, 550.000, 11, 70.00, 38500.00, 0, NULL, '2021-04-20 10:02:36', NULL, '2021-04-20 06:02:36'),
(8, 2, 56, 'Hardening 40-45 Hrc', NULL, 150.000, 3, 85.00, 12750.00, 0, NULL, '2021-04-20 10:03:19', NULL, '2021-04-20 06:03:19'),
(9, 2, 85, 'Hardening 30-35 Hrc', NULL, 50.000, 1, 80.00, 4000.00, 0, NULL, '2021-04-20 10:03:54', NULL, '2021-04-20 06:03:54'),
(10, 2, 40, 'Hardening 20-25', NULL, 40.000, 1, 50.00, 2000.00, 1, NULL, '2021-04-20 10:05:29', 1, NULL),
(11, 2, 44, 'Hardening 28-33 Hrc', NULL, 500.000, 5, 70.00, 35000.00, 1, NULL, '2021-04-20 10:05:54', 1, NULL),
(12, 2, 56, 'Hardening 40-45 Hrc', NULL, 200.000, 5, 50.00, 10000.00, 1, NULL, '2021-04-20 10:07:03', 1, NULL),
(13, 3, 68, 'Yellow Zinc', NULL, 80.000, 2, 90.00, 7200.00, 0, NULL, '2021-04-21 09:18:00', NULL, '2021-04-21 05:18:00'),
(14, 3, 38, 'Yellow Zinc', NULL, 120.000, 3, 80.00, 9600.00, 0, NULL, '2021-04-21 09:21:07', NULL, '2021-04-21 05:21:07'),
(15, 3, 75, 'Yellow Zinc', NULL, 80.000, 2, 80.00, 6400.00, 0, NULL, '2021-04-21 09:23:24', NULL, '2021-04-21 05:23:24'),
(16, 3, 69, 'White Zinc', NULL, 90.000, 2, 75.00, 6750.00, 0, NULL, '2021-04-21 09:23:54', NULL, '2021-04-21 05:34:44'),
(17, 3, 68, 'Yellow Zinc', NULL, 80.000, 2, 90.00, 7200.00, 1, NULL, '2021-04-21 09:25:32', 1, NULL),
(18, 3, 36, 'Yellow Zinc', NULL, 160.000, 4, 80.00, 12800.00, 0, NULL, '2021-04-21 09:29:37', NULL, '2021-04-21 05:29:37'),
(19, 4, 35, 'Yellow Zinc', NULL, 200.000, 5, 85.00, 17000.00, 0, NULL, '2021-04-21 12:25:04', NULL, '2021-04-21 08:25:04'),
(20, 4, 36, 'Yellow Zinc', NULL, 80.000, 2, 80.00, 6400.00, 0, NULL, '2021-04-21 12:25:26', NULL, '2021-04-21 08:25:26'),
(21, 4, 38, 'Yellow Zinc', NULL, 240.000, 6, 80.00, 19200.00, 0, NULL, '2021-04-21 12:25:46', NULL, '2021-04-21 08:25:46'),
(22, 5, 56, 'SSBT 150 Hours', NULL, 100.000, 2, 85.00, 8500.00, 0, NULL, '2021-04-25 10:04:46', NULL, '2021-04-25 06:04:46'),
(23, 5, 63, 'BT 6-8 MICRON', NULL, 120.000, 3, 80.00, 9600.00, 0, NULL, '2021-04-25 10:06:48', NULL, '2021-04-25 06:06:48');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login_attempts`
--

CREATE TABLE `tbl_login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) NOT NULL,
  `fin_id` int(11) DEFAULT NULL,
  `order_date` date NOT NULL,
  `orderno` varchar(50) NOT NULL,
  `customerid` int(11) NOT NULL,
  `quotationid` int(10) DEFAULT NULL,
  `ponumber` varchar(50) NOT NULL,
  `po_date` date NOT NULL,
  `status` int(11) DEFAULT NULL,
  `order_accept_date` date NOT NULL,
  `order_accept_no` varchar(30) NOT NULL,
  `freight` decimal(10,2) NOT NULL,
  `note` varchar(255) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `isdelete` tinyint(1) NOT NULL,
  `created_by` int(10) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(10) NOT NULL,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_invoice` tinyint(2) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `fin_id`, `order_date`, `orderno`, `customerid`, `quotationid`, `ponumber`, `po_date`, `status`, `order_accept_date`, `order_accept_no`, `freight`, `note`, `total`, `isdelete`, `created_by`, `created_on`, `updated_by`, `updated_on`, `is_invoice`) VALUES
(1, 18, '2021-04-01', 'ORD001', 18, 0, '010421-01', '2021-04-01', 0, '0000-00-00', '', 0.00, '', 0.00, 0, 1, '2021-04-18 12:18:58', 1, '2021-04-18 08:18:58', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_sub`
--

CREATE TABLE `tbl_order_sub` (
  `id` int(10) NOT NULL,
  `fin_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `orderid` int(10) NOT NULL,
  `qty` int(10) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `delivery_date` date NOT NULL,
  `dispatched` int(10) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `isdelete` tinyint(1) NOT NULL,
  `created_by` int(10) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(10) NOT NULL,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_picklist`
--

CREATE TABLE `tbl_picklist` (
  `id` int(11) NOT NULL,
  `pick_name` varchar(50) DEFAULT NULL,
  `isdelete` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_picklist`
--

INSERT INTO `tbl_picklist` (`id`, `pick_name`, `isdelete`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(1, 'Platting', 0, 1, '2020-11-09 13:24:52', 1, '2020-11-09 18:54:52'),
(2, 'metal', 0, 1, '2020-11-09 13:45:06', 1, '2020-11-09 19:15:14'),
(3, 'Estimated time of delivery', 0, 1, '2020-11-11 17:29:41', 1, '2020-11-11 15:59:41'),
(4, 'Estimated time of Arrival', 0, 1, '2020-11-11 17:29:41', 1, '2020-11-11 15:59:41'),
(5, 'Mode Of Transport', 0, 1, '2020-11-11 18:26:16', 1, '2020-11-11 16:56:16'),
(6, 'Terms Of Delivery', 0, 1, '2020-11-11 18:26:16', 1, '2020-11-11 16:56:16');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_picklist_sub`
--

CREATE TABLE `tbl_picklist_sub` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL DEFAULT '0',
  `pickname` varchar(100) DEFAULT NULL,
  `pickvalue` varchar(100) DEFAULT NULL,
  `shortname` varchar(200) NOT NULL,
  `isdelete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_picklist_sub`
--

INSERT INTO `tbl_picklist_sub` (`id`, `pid`, `pickname`, `pickvalue`, `shortname`, `isdelete`) VALUES
(1, 1, 'Copper', 'Copper', 'P', 0),
(2, 2, 'Brass', 'Brass', '', 0),
(3, 2, 'Ms', 'Ms', '', 0),
(4, 2, 'Aluminium', 'Aluminium', '', 0),
(5, 2, 'Ss', 'Ss', '', 0),
(6, 2, 'Couper', 'Couper', '', 0),
(7, 3, '1 Day', '1 Day', '', 0),
(8, 3, '2 Day', '2 Day', '', 0),
(9, 4, '1 Day', '1 Day', '', 0),
(10, 4, '2 Day', '2 Day', '', 0),
(11, 5, 'Bus', 'Bus', '', 0),
(12, 6, '50 % Advance Payment', '50 % Advance Payment', '', 0),
(13, 1, 'Nickel', 'Nickel', '', 0),
(14, 1, 'Gold', 'Gold', '', 0),
(15, 1, 'Tin', 'Tin', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_order`
--

CREATE TABLE `tbl_purchase_order` (
  `id` int(10) NOT NULL,
  `finid` int(11) NOT NULL,
  `po_date` date NOT NULL,
  `customerid` int(11) NOT NULL,
  `ponumber` varchar(20) NOT NULL,
  `freight` varchar(25) NOT NULL DEFAULT 'Paid',
  `pay_terms` varchar(30) DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `isdelete` tinyint(2) NOT NULL,
  `created_by` int(10) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(10) NOT NULL,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_purchase_order`
--

INSERT INTO `tbl_purchase_order` (`id`, `finid`, `po_date`, `customerid`, `ponumber`, `freight`, `pay_terms`, `total`, `isdelete`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(1, 18, '2021-04-06', 21, '21-22/0001', 'Paid', NULL, 4800.00, 0, 1, '2021-04-18 10:10:45', 1, '2021-04-20 05:30:28'),
(2, 18, '2021-04-10', 23, '21-22/0002', 'Paid', NULL, 57000.00, 0, 1, '2021-04-20 08:25:36', 1, '2021-04-25 14:56:33'),
(3, 18, '2021-04-10', 33, '21-22/0003', 'Paid', NULL, 136750.00, 0, 1, '2021-04-20 08:36:06', 1, '2021-04-20 05:30:37'),
(4, 18, '2021-04-11', 21, '21-22/0004', 'Paid', NULL, 6250.00, 0, 1, '2021-04-20 08:44:44', 1, '2021-04-20 05:30:41'),
(5, 18, '2021-04-13', 21, '21-22/0005', 'Paid', '60 Days', 70000.00, 0, 1, '2021-04-20 08:48:01', 1, '2021-04-24 12:23:15'),
(6, 18, '2021-04-14', 34, '21-22/0006', 'Paid', '60 days', 1500.00, 0, 1, '2021-04-20 09:01:59', 1, '2021-04-20 15:06:44'),
(7, 18, '2021-04-15', 35, '21-22/0007', 'Paid', '60 Days', 106250.00, 0, 1, '2021-04-25 09:33:10', 1, '2021-04-25 15:11:40'),
(8, 18, '2021-04-25', 33, '21-22/0008', 'Paid', '15 Days', 30550.00, 0, 1, '2021-04-25 09:47:03', 1, '2021-04-25 15:21:40'),
(9, 18, '2021-04-25', 49, '21-22/0009', 'Paid', '30 Days', 0.00, 0, 1, '2021-04-25 12:24:21', 1, '2021-04-25 17:54:21');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_order_sub`
--

CREATE TABLE `tbl_purchase_order_sub` (
  `id` int(10) NOT NULL,
  `fin_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `poid` int(10) NOT NULL,
  `qty` int(10) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `delivery_date` date NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `isdelete` tinyint(2) NOT NULL,
  `created_by` int(10) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(10) NOT NULL,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_purchase_order_sub`
--

INSERT INTO `tbl_purchase_order_sub` (`id`, `fin_id`, `item_id`, `poid`, `qty`, `amount`, `delivery_date`, `total`, `isdelete`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(1, 18, 51, 1, 2, 2200.00, '2021-04-20', 4400.00, 1, 0, '2021-04-18 10:16:31', 1, '2021-04-18 15:48:36'),
(2, 18, 51, 1, 2, 2400.00, '2021-04-06', 4800.00, 1, 0, '2021-04-18 10:20:26', 1, '2021-04-18 15:55:26'),
(3, 18, 52, 1, 2, 2400.00, '2021-04-20', 4800.00, 1, 0, '2021-04-18 10:30:18', 1, '2021-04-20 13:50:59'),
(4, 18, 51, 1, 10, 500.00, '2021-04-18', 5000.00, 1, 0, '2021-04-18 13:20:32', 1, '2021-04-20 13:50:53'),
(5, 18, 52, 1, 2, 2400.00, '2021-04-06', 4800.00, 0, 0, '2021-04-20 08:22:57', 0, '2021-04-20 04:22:57'),
(6, 18, 79, 2, 600, 95.00, '2021-04-20', 57000.00, 0, 0, '2021-04-20 08:28:51', 0, '2021-04-25 05:26:33'),
(7, 18, 80, 3, 250, 547.00, '2021-04-15', 136750.00, 0, 0, '2021-04-20 08:39:11', 0, '2021-04-20 04:39:11'),
(8, 18, 81, 4, 50, 125.00, '2021-04-15', 6250.00, 0, 0, '2021-04-20 08:46:43', 0, '2021-04-20 04:46:43'),
(9, 18, 82, 5, 200, 350.00, '2021-04-20', 70000.00, 0, 0, '2021-04-20 08:51:42', 0, '2021-04-20 04:51:42'),
(10, 18, 83, 6, 1, 1500.00, '2021-04-15', 1500.00, 0, 0, '2021-04-20 09:23:49', 0, '2021-04-20 05:23:49'),
(11, 18, 124, 7, 250, 425.00, '2021-04-20', 106250.00, 0, 0, '2021-04-25 09:41:40', 0, '2021-04-25 05:41:40'),
(12, 18, 125, 8, 50, 611.00, '2021-04-29', 30550.00, 0, 0, '2021-04-25 09:51:40', 0, '2021-04-25 05:51:40');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quotation`
--

CREATE TABLE `tbl_quotation` (
  `id` int(10) NOT NULL,
  `quotationno` varchar(55) DEFAULT NULL,
  `quotation_date` date DEFAULT NULL,
  `cid` int(10) NOT NULL COMMENT 'Customer Id',
  `consignee` int(11) NOT NULL DEFAULT '0',
  `quotationm` varchar(50) NOT NULL,
  `freight_terms` varchar(50) NOT NULL,
  `qid` int(10) DEFAULT NULL COMMENT 'parent_id',
  `moq` int(20) NOT NULL,
  `payment_terms` varchar(50) NOT NULL,
  `against_form` varchar(155) DEFAULT 'N.A.',
  `insurance` varchar(155) DEFAULT 'N.A.',
  `quotation_validity` varchar(50) NOT NULL,
  `note` text NOT NULL,
  `isdelete` tinyint(4) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_quotation`
--

INSERT INTO `tbl_quotation` (`id`, `quotationno`, `quotation_date`, `cid`, `consignee`, `quotationm`, `freight_terms`, `qid`, `moq`, `payment_terms`, `against_form`, `insurance`, `quotation_validity`, `note`, `isdelete`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(1, '21-22/0001 - Revision (0)', '2021-04-06', 22, 38, '', '0', NULL, 0, '30 Days', 'N.A.', 'N.A.', '06/04/2021', '', 0, 1, '2021-04-18 11:04:52', 1, '2021-04-24 11:02:46'),
(2, '21-22/0002 - Revision (0)', '2021-04-07', 22, 38, '', '0', NULL, 0, '30 Days', 'N.A.', 'N.A.', '30/04/2021', '', 0, 1, '2021-04-22 06:30:21', 1, '2021-04-26 09:44:21'),
(3, '21-22/0002 - - Revision (1)', '2021-04-24', 22, 38, '', '0', 2, 0, '30 Days', 'N.A.', 'N.A.', '22/04/2021', '', 0, 1, '2021-04-24 10:20:43', 1, '2021-04-24 15:50:43'),
(4, '21-22/0002 - - Revision (2)', '2021-04-25', 22, 38, '', '0', 2, 0, '30 Days', 'N.A.', 'N.A.', '22/04/2021', '', 0, 1, '2021-04-25 03:12:00', 1, '2021-04-25 08:42:00'),
(5, '21-22/0002 - - Revision (3)', '2021-04-26', 22, 38, '', '0', 2, 0, '30 Days', 'N.A.', 'N.A.', '22/04/2021', '', 1, 1, '2021-04-26 05:30:38', 1, '2021-04-26 11:12:41');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quotation_sub`
--

CREATE TABLE `tbl_quotation_sub` (
  `id` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `subcat_id` int(11) NOT NULL COMMENT 'Item id',
  `platting` varchar(155) DEFAULT NULL,
  `moq` varchar(55) DEFAULT NULL,
  `rate` decimal(10,2) NOT NULL DEFAULT '0.00',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `isdelete` tinyint(4) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(10) DEFAULT NULL,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_quotation_sub`
--

INSERT INTO `tbl_quotation_sub` (`id`, `cid`, `subcat_id`, `platting`, `moq`, `rate`, `amount`, `isdelete`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(1, 1, 53, 'Nickel', '200000', 415.00, 0.00, 1, 0, '2021-04-18 11:10:40', 1, '2021-04-24 11:31:06'),
(2, 1, 61, 'NA', '500000', 27.95, 0.00, 1, 0, '2021-04-20 05:13:58', 1, '2021-04-24 11:02:19'),
(3, 1, 62, 'Yellow Zinc', '5000000', 30.00, 0.00, 1, 0, '2021-04-20 05:14:33', 1, '2021-04-24 11:02:21'),
(4, 1, 61, '8-10 µ 96 Hrs. Blue Trivalent', '500000', 30.00, 0.00, 1, 0, '2021-04-20 11:22:13', 1, '2021-04-24 11:02:23'),
(5, 1, 62, '6-8 µ Yellow Zinc', '500000', 30.00, 0.00, 1, 0, '2021-04-20 11:22:44', 1, '0000-00-00 00:00:00'),
(6, 1, 61, '8-10 µ 96 Hrs. Blue Trivalent', '500000', 30.00, 0.00, 1, 0, '2021-04-20 11:24:09', 1, '0000-00-00 00:00:00'),
(7, 1, 62, '123', '500000', 30.00, 0.00, 1, 0, '2021-04-20 11:43:08', 1, '0000-00-00 00:00:00'),
(8, 1, 61, '1234', '500000', 30.00, 0.00, 1, 0, '2021-04-20 11:43:22', 1, '0000-00-00 00:00:00'),
(9, 1, 61, 'NA', '50000', 27.95, 0.00, 1, 0, '2021-04-20 13:03:55', 1, '2021-04-24 11:02:27'),
(10, 1, 61, 'NA', '10000', 25.36, 0.00, 1, 0, '2021-04-20 13:05:29', 1, '0000-00-00 00:00:00'),
(11, 1, 61, 'White Zinc', '1000000', 35.00, 0.00, 1, 0, '2021-04-20 13:15:51', 1, '2021-04-24 11:02:31'),
(12, 1, 53, 'Nickel', '200000', 415.00, 0.00, 0, 0, '2021-04-24 06:18:05', NULL, '2021-04-24 02:18:05'),
(13, 2, 130, '', '10,00,000', 13.00, 0.00, 0, 0, '2021-04-26 04:20:58', NULL, '2021-04-26 00:20:58'),
(14, 2, 131, '', '10,00,000', 27.50, 0.00, 0, 0, '2021-04-26 04:21:23', NULL, '2021-04-26 00:21:23');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_state`
--

CREATE TABLE `tbl_state` (
  `id` int(10) UNSIGNED NOT NULL,
  `state` varchar(50) NOT NULL,
  `state_code` varchar(2) NOT NULL,
  `isdelete` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_state`
--

INSERT INTO `tbl_state` (`id`, `state`, `state_code`, `isdelete`) VALUES
(1, 'ANDAMAN AND NICOBAR ISLANDS', '35', 0),
(2, 'ANDHRA PRADESH', '37', 0),
(3, 'ARUNACHAL PRADESH', '12', 0),
(4, 'ASSAM', '18', 0),
(5, 'BIHAR', '10', 0),
(6, 'CHATTISGARH', '22', 0),
(7, 'CHANDIGARH', '04', 0),
(8, 'DAMAN AND DIU', '25', 0),
(9, 'DELHI', '07', 0),
(10, 'DADRA AND NAGAR HAVELI', '26', 0),
(11, 'GOA', '30', 0),
(12, 'GUJARAT', '24', 0),
(13, 'HIMACHAL PRADESH', '02', 0),
(14, 'HARYANA', '06', 0),
(15, 'JAMMU AND KASHMIR', '01', 0),
(16, 'JHARKHAND', '20', 0),
(17, 'KERALA', '32', 0),
(18, 'KARNATAKA', '29', 0),
(19, 'LAKSHADWEEP', '31', 0),
(20, 'MEGHALAYA', '17', 0),
(21, 'MAHARASHTRA', '27', 0),
(22, 'MANIPUR', '14', 0),
(23, 'MADHYA PRADESH', '23', 0),
(24, 'MIZORAM', '15', 0),
(25, 'NAGALAND', '13', 0),
(26, 'ORISSA', '21', 0),
(27, 'PUNJAB', '03', 0),
(28, 'PONDICHERRY', '34', 0),
(29, 'RAJASTHAN', '08', 0),
(30, 'SIKKIM', '11', 0),
(31, 'TAMIL NADU', '33', 0),
(32, 'TRIPURA', '16', 0),
(33, 'UTTARAKHAND', '05', 0),
(34, 'UTTAR PRADESH', '09', 0),
(35, 'WEST BENGAL', '19', 0),
(36, 'TELANGANA', '36', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_userinfo`
--

CREATE TABLE `tbl_userinfo` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `user_name` varchar(30) DEFAULT NULL,
  `user_email` varchar(50) DEFAULT NULL,
  `user_password` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `user_image` varchar(255) DEFAULT NULL,
  `user_code` varchar(10) DEFAULT NULL,
  `user_mob` varchar(20) DEFAULT NULL,
  `user_fname` varchar(30) DEFAULT NULL,
  `user_lname` varchar(30) DEFAULT NULL,
  `user_fullname` varchar(255) DEFAULT NULL,
  `user_companyid` text,
  `card_id` varchar(100) NOT NULL,
  `basic_pay` bigint(20) NOT NULL DEFAULT '0',
  `attendance_group` int(11) NOT NULL,
  `pay_type` varchar(50) NOT NULL,
  `user_blocked` int(11) NOT NULL DEFAULT '0' COMMENT '1 - Unblock / 0 - Block',
  `user_last_login` varchar(255) DEFAULT NULL,
  `user_session` varchar(100) DEFAULT NULL,
  `user_type` int(11) NOT NULL DEFAULT '2',
  `have_login` tinyint(1) NOT NULL,
  `salt` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `activation_code` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `forgotten_password_code` varchar(255) NOT NULL,
  `forgotten_password_time` varchar(255) NOT NULL,
  `remember_code` varchar(100) NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `isdelete` int(1) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `updated_on` varchar(30) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `tbl_userinfo`
--

INSERT INTO `tbl_userinfo` (`id`, `ip_address`, `user_name`, `user_email`, `user_password`, `user_image`, `user_code`, `user_mob`, `user_fname`, `user_lname`, `user_fullname`, `user_companyid`, `card_id`, `basic_pay`, `attendance_group`, `pay_type`, `user_blocked`, `user_last_login`, `user_session`, `user_type`, `have_login`, `salt`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `last_login`, `isdelete`, `created_by`, `updated_by`, `updated_on`, `created_on`) VALUES
(1, NULL, 'admin', 'supreme.fasteners@gmail.com', '$2y$08$wVRDGHELcU4aGQ4GIeBfPucfzLqbpN8TGvue3t8.lX1CcYV8yWv9e', 'uploads/supreme_logo1.jpg', NULL, '9712524646', 'Admin', 'User', 'Supreme Industrial Fasteners', '4', '', 0, 0, '', 1, NULL, NULL, 1, 0, NULL, NULL, '-GcX8qdTlvIJm1WfKknBeu37b28539399e7a5861', '1612437548', '', 1619503581, 0, 1, 1, '2021-03-25 09:01:05', '2020-11-06 09:57:16'),
(2, NULL, 'ajay', 'ajay.sojitra562@gmail.com', '$2y$08$gqGEVHMSNGKVCmJc/hfZ0uIBgmnQ.9Ckr.Ka5cEVODugUBtpx8Gpy', 'assets/default.png', NULL, '9962033292', 'Ajay', 'Patel', 'Ajay Patel', '4,6', '1', 0, 1, 'Hourly', 1, NULL, NULL, 4, 1, NULL, NULL, '', '', '', 1606042848, 1, 1, 1, '2021-03-25 18:29:14', '2020-11-07 08:41:09'),
(3, NULL, 'Aniruddh', 'supreme.fasteners@gmail.com', '$2y$08$1dOmS2h4ctpe4xlpXTn5cOpeJqTbdEmzW18mlPfeGq9DCM.1lxDgy', 'uploads/BingImageOfTheDay1.jpg', NULL, '9712524646', 'Aniruddh', 'Dudhagara', 'Aniruddh Dudhagara', '8', '101', 1000, 1, 'Hourly', 1, NULL, NULL, 4, 1, NULL, NULL, '', '', '', 1616824723, 0, 3, 1, '2021-03-25 19:13:51', '2020-11-09 11:35:44'),
(4, NULL, 'Brij1', 'brij@gmail.com1', '$2y$08$7Cuz.y8vEjbvhqrKScpqCekJY6uVHVB81LkeHLfAiCM3qmXY/zuBe', 'assets/default.png', NULL, '9724855511', 'm&M1', 'mahendra1', 'm&M1 mahendra1', NULL, '121', 221, 1, 'Hourly', 1, NULL, NULL, 3, 1, NULL, NULL, '', '', '', NULL, 1, 1, 1, '2021-01-26 11:31:38', '2021-01-26 06:00:58'),
(5, NULL, 'shivam', 'shivam@gmail.com', '$2y$08$PpnrhaBZRd5bit/Wgzb07.tdKhYLEZORmrRY4lPa0ezHy1sBjv5sW', 'assets/default.png', NULL, '9898989898', 'shivam', 'shah', 'shivam shah', '8', '1234', 125, 1, 'Daily', 1, NULL, NULL, 6, 1, NULL, NULL, '', '', '', 1616665403, 1, 1, 1, '2021-03-25 15:31:58', '2021-03-25 09:43:05'),
(6, NULL, 'Parsottam', 'Test@gmail.com', '$2y$08$kHde5GaTvQ/8L4pL4agoPex1U5CIrHT/ntjG4jc0L3H3APj2jHlTy', 'assets/default.png', NULL, '9426458259', 'Parsottambhai', 'Korat', 'Parsottambhai Korat', NULL, '', 0, 0, '', 0, NULL, NULL, 2, 1, NULL, NULL, '', '', '', 1616680144, 0, 3, 1, '2021-04-27 08:45:28', '2021-03-25 13:48:40');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_roles`
--

CREATE TABLE `tbl_user_roles` (
  `id` int(11) NOT NULL,
  `user_role` varchar(50) DEFAULT NULL,
  `role_details` longtext NOT NULL,
  `cdtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isdelete` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_roles`
--

INSERT INTO `tbl_user_roles` (`id`, `user_role`, `role_details`, `cdtime`, `isdelete`) VALUES
(1, 'Super Admin', '{\"dashboard\":{\"view\":\"1\"},\"order\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"packing_list\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"invoice\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"customer\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"company_master\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"reports\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"settings\":{\"view\":\"1\"},\"financial_year\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"country_master\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"currency_master\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"item_category\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"port_master\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"transporter_master\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"bank_master\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"hrms\":{\"view\":\"1\"},\"user\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"role\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"department_master\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"attendance_master\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"staff_payment\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"staff_salary_report\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"}}', '2020-11-07 08:09:09', 0),
(2, 'Dispatch Manager', '{\"dashboard\":{\"view\":\"1\"},\"order\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"jobwork_challan\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"settings\":{\"view\":\"1\"},\"financial_year\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"item_category\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"customer\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"jobworker\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"}}', '2020-11-07 08:09:04', 0),
(3, 'Accountant', '{\"dashboard\":{\"view\":\"1\"}}', '2020-11-07 08:01:24', 0),
(4, 'Main Admin', '{\"dashboard\":{\"view\":\"1\"},\"quotation\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"order\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"purchase_order\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"jobwork_challan\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"invoice\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"item\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"company_master\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"settings\":{\"view\":\"1\"},\"financial_year\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"backup\":{\"view\":\"1\",\"add\":\"1\"},\"item_category\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"item_sub_category\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"item_parameters\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"customer\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"supplier\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"jobworker\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"hrms\":{\"view\":\"1\"},\"user\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"role\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"}}', '2020-11-17 05:50:52', 0),
(5, 'add', 'null', '2021-01-26 06:02:03', 1),
(6, 'Test Role', '{\"dashboard\":{\"view\":\"1\"},\"quotation\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"order\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"purchase_order\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"jobwork_challan\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"invoice\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"item\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"company_master\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"settings\":{\"view\":\"1\"},\"financial_year\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"backup\":{\"view\":\"1\",\"add\":\"1\"},\"item_category\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"item_sub_category\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"item_parameters\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"customer\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"supplier\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"jobworker\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"hrms\":{\"view\":\"1\"},\"user\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"role\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"}}', '2021-03-25 09:42:19', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_backup`
--
ALTER TABLE `tbl_backup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_company_management`
--
ALTER TABLE `tbl_company_management`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_company_person`
--
ALTER TABLE `tbl_company_person`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_country_master`
--
ALTER TABLE `tbl_country_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_customer_item`
--
ALTER TABLE `tbl_customer_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_customer_item_sub`
--
ALTER TABLE `tbl_customer_item_sub`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_customer_management`
--
ALTER TABLE `tbl_customer_management`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_customer_person`
--
ALTER TABLE `tbl_customer_person`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_deliverychallan`
--
ALTER TABLE `tbl_deliverychallan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_deliverychallan_payment`
--
ALTER TABLE `tbl_deliverychallan_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_deliverychallan_sub`
--
ALTER TABLE `tbl_deliverychallan_sub`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_department`
--
ALTER TABLE `tbl_department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_financial_year`
--
ALTER TABLE `tbl_financial_year`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_general_voucher`
--
ALTER TABLE `tbl_general_voucher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_general_voucher_sub`
--
ALTER TABLE `tbl_general_voucher_sub`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_inventory`
--
ALTER TABLE `tbl_inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_invoice_payment`
--
ALTER TABLE `tbl_invoice_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_invoice_sub`
--
ALTER TABLE `tbl_invoice_sub`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_item`
--
ALTER TABLE `tbl_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_item_category`
--
ALTER TABLE `tbl_item_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_item_parameters`
--
ALTER TABLE `tbl_item_parameters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_item_subcategory`
--
ALTER TABLE `tbl_item_subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_item_unit`
--
ALTER TABLE `tbl_item_unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_jobwcustomer_person`
--
ALTER TABLE `tbl_jobwcustomer_person`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_jobworker_master`
--
ALTER TABLE `tbl_jobworker_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_jobwork_inword`
--
ALTER TABLE `tbl_jobwork_inword`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_jobwork_inword_sub`
--
ALTER TABLE `tbl_jobwork_inword_sub`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_jobwork_outword`
--
ALTER TABLE `tbl_jobwork_outword`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_jobwork_outword_sub`
--
ALTER TABLE `tbl_jobwork_outword_sub`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_login_attempts`
--
ALTER TABLE `tbl_login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order_sub`
--
ALTER TABLE `tbl_order_sub`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_picklist`
--
ALTER TABLE `tbl_picklist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_picklist_sub`
--
ALTER TABLE `tbl_picklist_sub`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_purchase_order`
--
ALTER TABLE `tbl_purchase_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_purchase_order_sub`
--
ALTER TABLE `tbl_purchase_order_sub`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_quotation`
--
ALTER TABLE `tbl_quotation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_quotation_sub`
--
ALTER TABLE `tbl_quotation_sub`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_state`
--
ALTER TABLE `tbl_state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_userinfo`
--
ALTER TABLE `tbl_userinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_roles`
--
ALTER TABLE `tbl_user_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_backup`
--
ALTER TABLE `tbl_backup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_company_management`
--
ALTER TABLE `tbl_company_management`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_company_person`
--
ALTER TABLE `tbl_company_person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_country_master`
--
ALTER TABLE `tbl_country_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248;

--
-- AUTO_INCREMENT for table `tbl_customer_item`
--
ALTER TABLE `tbl_customer_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `tbl_customer_item_sub`
--
ALTER TABLE `tbl_customer_item_sub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_customer_management`
--
ALTER TABLE `tbl_customer_management`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `tbl_customer_person`
--
ALTER TABLE `tbl_customer_person`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `tbl_deliverychallan`
--
ALTER TABLE `tbl_deliverychallan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_deliverychallan_payment`
--
ALTER TABLE `tbl_deliverychallan_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_deliverychallan_sub`
--
ALTER TABLE `tbl_deliverychallan_sub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_department`
--
ALTER TABLE `tbl_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_financial_year`
--
ALTER TABLE `tbl_financial_year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_general_voucher`
--
ALTER TABLE `tbl_general_voucher`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_general_voucher_sub`
--
ALTER TABLE `tbl_general_voucher_sub`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_inventory`
--
ALTER TABLE `tbl_inventory`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `tbl_invoice_payment`
--
ALTER TABLE `tbl_invoice_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_invoice_sub`
--
ALTER TABLE `tbl_invoice_sub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `tbl_item`
--
ALTER TABLE `tbl_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_item_category`
--
ALTER TABLE `tbl_item_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_item_parameters`
--
ALTER TABLE `tbl_item_parameters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_item_subcategory`
--
ALTER TABLE `tbl_item_subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_item_unit`
--
ALTER TABLE `tbl_item_unit`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_jobwcustomer_person`
--
ALTER TABLE `tbl_jobwcustomer_person`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_jobworker_master`
--
ALTER TABLE `tbl_jobworker_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_jobwork_inword`
--
ALTER TABLE `tbl_jobwork_inword`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_jobwork_inword_sub`
--
ALTER TABLE `tbl_jobwork_inword_sub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_jobwork_outword`
--
ALTER TABLE `tbl_jobwork_outword`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_jobwork_outword_sub`
--
ALTER TABLE `tbl_jobwork_outword_sub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_login_attempts`
--
ALTER TABLE `tbl_login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_order_sub`
--
ALTER TABLE `tbl_order_sub`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_picklist`
--
ALTER TABLE `tbl_picklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_picklist_sub`
--
ALTER TABLE `tbl_picklist_sub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_purchase_order`
--
ALTER TABLE `tbl_purchase_order`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_purchase_order_sub`
--
ALTER TABLE `tbl_purchase_order_sub`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_quotation`
--
ALTER TABLE `tbl_quotation`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_quotation_sub`
--
ALTER TABLE `tbl_quotation_sub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_state`
--
ALTER TABLE `tbl_state`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tbl_userinfo`
--
ALTER TABLE `tbl_userinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_user_roles`
--
ALTER TABLE `tbl_user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
