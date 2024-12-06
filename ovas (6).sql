-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2024 at 03:33 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ovas`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_confirm`
--

CREATE TABLE `admin_confirm` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `email` varchar(255) NOT NULL,
  `read` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_confirm`
--

INSERT INTO `admin_confirm` (`id`, `name`, `status`, `created_at`, `email`, `read`) VALUES
(1, 'Ivan Ablanida', 'confirm', '2024-09-16 06:36:10', 'ejivancablanida@gmail.com', '1'),
(2, 'Ivan Ablanida', 'decline', '2024-09-16 06:45:43', 'ejivan@gmail.com', '1'),
(3, 'Ivan Ablanida', 'complete', '2024-09-16 06:49:04', 'ejivan@gmail.com', '1'),
(4, 'Ivan Ablanida', 'confirm', '2024-09-23 05:49:45', 'ejthecoder@gmail.com', '1'),
(5, 'Ivan Ablanida', 'confirm', '2024-10-17 18:12:25', 'ejthecoder@gmail.com', '1'),
(6, 'Ivan Ablanida', 'complete', '2024-10-17 18:12:31', 'ejthecoder@gmail.com', '1'),
(7, 'Ivan Ablanida', 'decline', '2024-10-17 18:12:32', 'ejthecoder@gmail.com', '1'),
(8, 'Ivan Ablanida', 'confirm', '2024-10-17 18:13:05', 'ejthecoder@gmail.com', '1'),
(9, 'Ivan Ablanida', 'complete', '2024-10-17 18:13:15', 'ejthecoder@gmail.com', '1'),
(10, 'Ivan Ablanida', 'confirm', '2024-10-17 18:13:17', 'ejthecoder@gmail.com', '1'),
(11, 'Ivan Ablanida', 'decline', '2024-10-17 18:13:18', 'ejthecoder@gmail.com', '1'),
(12, 'Ivan Ablanida', 'confirm', '2024-10-17 18:14:10', 'ejthecoder@gmail.com', '1'),
(13, 'Ivan Ablanida', 'complete', '2024-10-17 18:14:34', 'ejthecoder@gmail.com', '1'),
(14, 'Ivan Ablanida', 'decline', '2024-10-17 18:14:56', 'ejthecoder@gmail.com', '1'),
(15, 'Ivan Ablanida', 'complete', '2024-10-17 18:15:53', 'ejthecoder@gmail.com', '1'),
(16, 'Ivan Ablanida', 'confirm', '2024-10-17 18:22:31', 'ejthecoder@gmail.com', '1'),
(17, 'Ivan Ablanida', 'complete', '2024-10-17 18:22:44', 'ejthecoder@gmail.com', '1'),
(18, 'Ivan Ablanida', 'confirm', '2024-10-17 18:22:45', 'ejthecoder@gmail.com', '1'),
(19, 'Ivan Ablanida', 'complete', '2024-10-17 20:34:05', 'ejthecoder@gmail.com', '1'),
(20, 'Ivan Ablanida', 'confirm', '2024-10-17 20:34:55', 'ejthecoder@gmail.com', '1'),
(21, 'Ablanida', 'confirm', '2024-10-18 06:06:21', 'ejivan@gmail.com', '1'),
(22, 'Ablanida', 'confirm', '2024-10-18 06:07:54', 'ejivan@gmail.com', '1'),
(23, 'Ivan', 'confirm', '2024-11-29 03:09:09', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(24, 'Ivan', 'confirm', '2024-12-05 19:22:22', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(25, 'Ivan', 'complete', '2024-12-05 20:57:26', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(26, 'Ivan', 'complete', '2024-12-05 21:08:16', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(27, 'Ivan', 'confirm', '2024-12-05 21:08:21', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(28, 'Ivan', 'complete', '2024-12-05 21:08:22', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(29, 'Ivan', 'confirm', '2024-12-05 21:08:26', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(30, 'Ivan', 'confirm', '2024-12-05 21:10:22', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(31, 'Ivan', 'complete', '2024-12-05 21:10:25', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(32, 'Ivan', 'complete', '2024-12-05 21:10:27', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(33, 'Ivan', 'decline', '2024-12-05 21:10:29', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(34, 'Ivan', 'confirm', '2024-12-05 21:10:32', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(35, 'Ivan', 'confirm', '2024-12-05 21:10:33', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(36, 'Ivan', 'complete', '2024-12-05 21:10:35', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(37, 'Ivan', 'decline', '2024-12-05 21:10:37', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(38, 'Ivan', 'confirm', '2024-12-05 21:10:45', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(39, 'Ivan', 'decline', '2024-12-05 21:10:47', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(40, 'Ivan', 'complete', '2024-12-05 21:12:22', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(41, 'Ivan', 'complete', '2024-12-05 21:12:25', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(42, 'Ivan', 'complete', '2024-12-05 21:12:29', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(43, 'Ivan', 'decline', '2024-12-05 21:12:31', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(44, 'Ivan', 'confirm', '2024-12-05 21:12:33', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(45, 'Ivan', 'decline', '2024-12-05 21:12:41', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(46, 'Ivan', 'confirm', '2024-12-05 21:12:42', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(47, 'Ivan', 'confirm', '2024-12-05 21:15:04', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(48, 'Ivan', 'complete', '2024-12-05 21:15:07', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(49, 'Ivan', 'decline', '2024-12-05 21:15:09', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(50, 'Ivan', 'complete', '2024-12-05 21:16:28', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(51, 'Ivan', 'confirm', '2024-12-05 21:16:28', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(52, 'Ivan', 'confirm', '2024-12-05 21:17:17', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(53, 'Ivan', 'confirm', '2024-12-05 21:21:36', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(54, 'Ivan', 'complete', '2024-12-05 21:21:39', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(55, 'Ivan', 'decline', '2024-12-05 21:21:46', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(56, 'Ivan', 'complete', '2024-12-05 21:21:48', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(57, 'Ivan', 'confirm', '2024-12-05 21:23:10', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(58, 'Ivan', 'confirm', '2024-12-05 21:23:27', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(59, 'Ivan', 'complete', '2024-12-05 21:23:28', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(60, 'Ivan', 'decline', '2024-12-05 21:23:30', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(61, 'Ivan', 'confirm', '2024-12-05 21:23:34', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(62, 'Ivan', 'complete', '2024-12-05 21:27:50', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(63, 'Ivan', 'complete', '2024-12-05 21:27:53', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(64, 'Ivan', 'decline', '2024-12-05 21:27:55', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(65, 'Ivan', 'confirm', '2024-12-05 21:28:05', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(66, 'Ivan', 'complete', '2024-12-05 21:31:42', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(67, 'Ivan', 'decline', '2024-12-05 21:31:43', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(68, 'Ivan', 'confirm', '2024-12-05 21:31:46', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(69, 'Ivan', 'decline', '2024-12-05 21:46:05', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(70, 'Ivan', 'confirm', '2024-12-05 21:49:09', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(71, 'Ivan', 'decline', '2024-12-05 21:49:11', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(72, 'Ivan', 'decline', '2024-12-05 21:49:33', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(73, 'Ivan', 'complete', '2024-12-05 21:49:44', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(74, 'Ivan', 'confirm', '2024-12-05 21:51:03', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(75, 'Ivan', 'complete', '2024-12-05 21:51:06', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(76, 'Ivan', 'decline', '2024-12-05 21:51:08', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(77, 'Ivan', 'decline', '2024-12-05 21:51:11', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(78, 'Ivan', 'confirm', '2024-12-05 21:57:16', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(79, 'Ivan', 'decline', '2024-12-05 21:57:19', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(80, 'Ivan', 'confirm', '2024-12-05 22:00:34', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(81, 'Ivan', 'decline', '2024-12-05 22:00:43', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(82, 'Ablanida, Ej ivan C.', 'confirm', '2024-12-05 22:03:23', 'ejthecoder@gmail.com', '1'),
(83, 'Ivan', 'confirm', '2024-12-05 22:05:20', 'ejivan.ablanida@cvsu.edu.ph', '1'),
(84, 'Ablanida, Ej ivan C.', 'decline', '2024-12-05 22:06:32', 'ejthecoder@gmail.com', '0'),
(85, 'Ivan', 'confirm', '2024-12-05 22:07:20', 'ejivan.ablanida@cvsu.edu.ph', '0'),
(86, 'Ivan', 'decline', '2024-12-05 22:07:23', 'ejivan.ablanida@cvsu.edu.ph', '0'),
(87, 'Ivan', 'confirm', '2024-12-05 22:07:45', 'ejivan.ablanida@cvsu.edu.ph', '0'),
(88, 'Ivan', 'decline', '2024-12-05 22:07:48', 'ejivan.ablanida@cvsu.edu.ph', '0'),
(89, 'Ivan', 'confirm', '2024-12-05 22:08:21', 'ejivan.ablanida@cvsu.edu.ph', '0'),
(90, 'Ivan', 'decline', '2024-12-05 22:08:23', 'ejivan.ablanida@cvsu.edu.ph', '0'),
(91, 'Ivan', 'decline', '2024-12-05 22:08:41', 'ejivan.ablanida@cvsu.edu.ph', '0'),
(92, 'Ivan', 'complete', '2024-12-05 22:09:07', 'ejivan.ablanida@cvsu.edu.ph', '0'),
(93, 'Ivan', 'decline', '2024-12-05 22:09:08', 'ejivan.ablanida@cvsu.edu.ph', '0'),
(94, 'Ivan', 'complete', '2024-12-05 22:09:12', 'ejivan.ablanida@cvsu.edu.ph', '0'),
(95, 'Ivan', 'decline', '2024-12-05 22:09:14', 'ejivan.ablanida@cvsu.edu.ph', '0'),
(96, 'Ivan', 'complete', '2024-12-05 22:09:54', 'ejivan.ablanida@cvsu.edu.ph', '0'),
(97, 'Ivan', 'decline', '2024-12-05 22:10:02', 'ejivan.ablanida@cvsu.edu.ph', '0'),
(98, 'Ivan', 'complete', '2024-12-05 22:10:11', 'ejivan.ablanida@cvsu.edu.ph', '0'),
(99, 'Ivan', 'decline', '2024-12-05 22:10:12', 'ejivan.ablanida@cvsu.edu.ph', '0'),
(100, 'Ivan', 'complete', '2024-12-05 22:10:54', 'ejivan.ablanida@cvsu.edu.ph', '0'),
(101, 'Ivan', 'decline', '2024-12-05 22:10:56', 'ejivan.ablanida@cvsu.edu.ph', '0'),
(102, 'Ivan', 'complete', '2024-12-05 22:11:46', 'ejivan.ablanida@cvsu.edu.ph', '0'),
(103, 'Ivan', 'decline', '2024-12-05 22:11:47', 'ejivan.ablanida@cvsu.edu.ph', '0'),
(104, 'Ivan', 'complete', '2024-12-05 22:13:16', 'ejivan.ablanida@cvsu.edu.ph', '0'),
(105, 'Ivan', 'decline', '2024-12-05 22:13:18', 'ejivan.ablanida@cvsu.edu.ph', '0'),
(106, 'Ivan', 'complete', '2024-12-05 22:15:47', 'ejivan.ablanida@cvsu.edu.ph', '0'),
(107, 'Ivan', 'confirm', '2024-12-05 22:15:48', 'ejivan.ablanida@cvsu.edu.ph', '0'),
(108, 'Ivan', 'decline', '2024-12-05 22:15:50', 'ejivan.ablanida@cvsu.edu.ph', '0'),
(109, 'Ivan', 'confirm', '2024-12-05 22:18:52', 'ejivan.ablanida@cvsu.edu.ph', '0'),
(110, 'Ivan', 'complete', '2024-12-05 22:18:54', 'ejivan.ablanida@cvsu.edu.ph', '0'),
(111, 'Ivan', 'decline', '2024-12-05 22:18:55', 'ejivan.ablanida@cvsu.edu.ph', '0'),
(112, 'Ablanida, Ej ivan C.', 'confirm', '2024-12-06 01:00:16', 'ejthecoder@gmail.com', '0'),
(113, 'Ablanida, Ej ivan C.', 'decline', '2024-12-06 01:00:24', 'ejthecoder@gmail.com', '0'),
(114, 'Ablanida, Ej ivan C.', 'complete', '2024-12-06 01:05:32', 'ejthecoder@gmail.com', '0');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `owner_name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL DEFAULT 'pending',
  `status` enum('pending','confirm','complete','decline') NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `pet_type` varchar(50) NOT NULL,
  `breed` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `service_category` varchar(100) NOT NULL,
  `service_type` varchar(100) NOT NULL,
  `appointment_time` time NOT NULL,
  `appointment_date` date NOT NULL,
  `total_payment` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment_method` varchar(50) DEFAULT NULL,
  `gcash_screenshot` varchar(255) DEFAULT NULL,
  `reference` int(100) DEFAULT NULL,
  `decline_reason` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `owner_name`, `code`, `status`, `contact_number`, `email`, `address`, `pet_type`, `breed`, `age`, `service_category`, `service_type`, `appointment_time`, `appointment_date`, `total_payment`, `created_at`, `payment_method`, `gcash_screenshot`, `reference`, `decline_reason`) VALUES
(90, 'Ivan', 'OVAS-000028', 'decline', '12', 'ejivan.ablanida@cvsu.edu.ph', '12', 'Cat', '12', 12, 'medical', 'Preventive Health Care', '15:00:00', '2024-11-29', 850.00, '2024-11-29 03:04:39', 'pay_on_store', '', 0, 'DASDASDASDASDASDSDASDASDASDASDASDSDASDASDASDASDASDSDASDA'),
(91, 'Ivan', 'OVAS-000030', 'decline', '12', 'ejivan.ablanida@cvsu.edu.ph', '12', 'Cat', '12', 12, 'medical', 'Diagnostic and Therapeutic', '11:00:00', '2024-11-29', 1200.00, '2024-11-29 03:53:44', 'pay_on_store', '', 0, 'dsadsa'),
(92, 'Ablanida, Ej ivan C.', 'OVAS-000024', 'decline', '09957939703', 'ejthecoder@gmail.com', 'Blk 4. Lot 24', 'Cat', 'Husky', 12, 'medical', 'Diagnostic and Therapeutic', '00:00:00', '2024-12-06', 1200.00, '2024-12-05 22:02:38', 'gcash', 'deedfc55-0872-4cd0-9460-dbf533bdb346.jpg', 312312312, NULL),
(93, 'Ablanida, Ej ivan C.', 'pending', 'pending', '09957939703', 'ejthecoder@gmail.com', 'Blk 4. Lot 24', 'Cat', '12', 12, 'medical', 'Diagnostic and Therapeutic', '09:00:00', '2024-12-07', 1200.00, '2024-12-05 22:46:09', 'gcash', 'deedfc55-0872-4cd0-9460-dbf533bdb346.jpg', 12, NULL),
(94, 'Ablanida, Ej ivan C.', 'pending', 'pending', '09957939703', 'ejthecoder@gmail.com', 'Blk 4. Lot 24', 'Cat', '1221', 1212, 'medical', 'Diagnostic and Therapeutic', '10:00:00', '2024-12-08', 1200.00, '2024-12-05 22:46:54', 'gcash', 'deedfc55-0872-4cd0-9460-dbf533bdb346.jpg', 2121, NULL),
(95, 'Ablanida, Ej ivan C.', 'pending', 'pending', '09957939703', 'ejthecoder@gmail.com', 'Blk 4. Lot 24', 'Cat', '1221', 1212, 'medical', 'Diagnostic and Therapeutic', '11:00:00', '2024-12-08', 1200.00, '2024-12-05 23:19:16', 'gcash', 'deedfc55-0872-4cd0-9460-dbf533bdb346.jpg', 1212, NULL),
(102, 'Ablanida, Ej ivan C.', 'pending', 'pending', '09957939703', 'ejthecoder@gmail.com', 'Blk 4. Lot 24', 'Cat', '12', 12, 'medical', 'Preventive Health Care', '10:00:00', '0000-00-00', 850.00, '2024-12-05 23:36:35', 'gcash', 'deedfc55-0872-4cd0-9460-dbf533bdb346.jpg', 21312, NULL),
(103, 'Ablanida, Ej ivan C.', 'pending', 'pending', '09957939703', 'ejthecoder@gmail.com', 'Blk 4. Lot 24', 'Cat', 'dasdsa', 1221, 'medical', 'Diagnostic and Therapeutic', '09:00:00', '2024-12-08', 1200.00, '2024-12-05 23:38:21', 'gcash', 'deedfc55-0872-4cd0-9460-dbf533bdb346.jpg', 121212, NULL),
(104, 'Ablanida, Ej ivan C.', 'pending', 'pending', '09957939703', 'ejthecoder@gmail.com', 'Blk 4. Lot 24', 'Cat', '122112', 1212, 'nonMedical', 'Grooming', '16:00:00', '2024-12-08', 999.00, '2024-12-05 23:49:04', 'gcash', 'deedfc55-0872-4cd0-9460-dbf533bdb346.jpg', 122112, NULL),
(105, 'Ablanida, Ej ivan C.', 'pending', 'pending', '09957939703', 'ejthecoder@gmail.com', 'Blk 4. Lot 24', 'Dog', 'Cat', 12, 'medical', 'Diagnostic and Therapeutic', '12:00:00', '2024-12-08', 1200.00, '2024-12-06 00:43:41', 'gcash', 'deedfc55-0872-4cd0-9460-dbf533bdb346.jpg', 312321, NULL),
(106, 'Ablanida, Ej ivan C.', 'OVAS-000031', 'complete', '09957939703', 'ejthecoder@gmail.com', 'Blk 4. Lot 24', 'Cat', '12', 12, 'medical', 'Diagnostic and Therapeutic', '09:00:00', '2024-12-05', 1200.00, '2024-12-06 00:47:59', 'gcash', 'deedfc55-0872-4cd0-9460-dbf533bdb346.jpg', 3121221, 'Ayoko lang bat ba');

-- --------------------------------------------------------

--
-- Table structure for table `app_req_notif`
--

CREATE TABLE `app_req_notif` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `app_req_notif`
--

INSERT INTO `app_req_notif` (`id`, `name`, `message`, `client_name`, `created_at`, `is_read`) VALUES
(1, 'Ej Ivan Ablanidaaaa', 'Kate\'s record added by Ej Ivan Ablanidaaaa', 'Kate', '2024-09-20 07:02:42', 1),
(2, 'Ej Ivan Ablanidaaaa', 'Kate\'s record added by Ej Ivan Ablanidaaaa', 'Kate', '2024-09-20 07:15:43', 1),
(3, 'Ej Ivan Ablanidaaaa', 'Test\'s record added by Ej Ivan Ablanidaaaa', 'Test', '2024-09-23 05:50:55', 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(6) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `message` varchar(255) DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `created_at`, `message`, `is_read`) VALUES
(7, 'Cat', '2024-09-13 09:13:21', NULL, 1),
(8, 'Dog', '2024-09-13 09:13:24', NULL, 1),
(9, 'Rabit', '2024-09-13 09:15:00', NULL, 1),
(10, 'Reptile', '2024-09-13 09:15:06', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `response` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat_messages`
--

INSERT INTO `chat_messages` (`id`, `question`, `response`, `created_at`) VALUES
(2, 'who is your mother?', 'dsadas', '2024-10-29 18:44:48');

-- --------------------------------------------------------

--
-- Table structure for table `max_booking`
--

CREATE TABLE `max_booking` (
  `id` int(11) NOT NULL,
  `max_booking` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `max_booking`
--

INSERT INTO `max_booking` (`id`, `max_booking`) VALUES
(1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `code` varchar(20) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `email`, `code`, `type`, `message`, `created_at`, `is_read`) VALUES
(12, 'ejivancablanida@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-09-10 11:07:13', 1),
(13, 'ejivancablanida@gmail.com', 'OVAS-000010', 'confirm', 'Your appointment has been confirmed!', '2024-09-10 11:07:43', 1),
(14, 'racel@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-09-12 10:45:02', 1),
(15, 'racel@gmail.com', 'OVAS-000011', 'confirm', 'Your appointment has been confirmed!', '2024-09-12 10:45:47', 1),
(16, 'ejivan@gmail.com', 'OVAS-000012', 'confirm', 'Your appointment has been confirmed!', '2024-09-16 05:40:34', 1),
(17, 'racel@gmail.com', 'OVAS-000013', 'confirm', 'Your appointment has been confirmed!', '2024-09-16 05:43:36', 1),
(18, 'ejivan@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-09-16 05:44:24', 1),
(19, 'ejivan@gmail.com', 'OVAS-000014', 'confirm', 'Your appointment has been confirmed!', '2024-09-16 05:44:32', 1),
(20, 'ejivan@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-09-16 05:47:25', 1),
(21, 'ejivan@gmail.com', 'OVAS-000015', 'confirm', 'Admin has confirmed the appointment of Ivan Ablanida.', '2024-09-16 05:54:17', 1),
(22, 'ejivancablanida@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-09-16 06:00:28', 1),
(23, 'ejivan@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-09-16 06:35:01', 1),
(24, 'ejivancablanida@gmail.com', 'OVAS-000016', 'confirm', 'Admin has confirmed the appointment of Ivan Ablanida.', '2024-09-16 06:36:10', 1),
(25, 'ejivan@gmail.com', 'pending', 'decline', 'Your appointment has been rejected.', '2024-09-16 06:45:43', 1),
(26, 'a@gmail.com', 'OVAS-000004', 'complete', 'Your appointment has been completed.', '2024-09-16 06:49:04', 1),
(27, 'ejthecoder@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-09-17 05:14:07', 1),
(28, '', NULL, '', ' category has been deleted.', '2024-09-23 05:17:11', 1),
(36, 'ejthecoder@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-09-23 05:49:24', 1),
(37, 'ejthecoder@gmail.com', 'OVAS-000001', 'confirm', 'Admin has confirmed the appointment of Ivan Ablanida.', '2024-09-23 05:49:45', 1),
(38, '', NULL, '', 'Frogs category has been edited.', '2024-09-23 05:53:00', 1),
(39, '', NULL, '', 'Frogs category has been deleted.', '2024-09-23 05:53:08', 1),
(40, 'ejthecoder@gmail.com', 'OVAS-000001', 'confirm', 'Admin has confirmed the appointment of Ivan Ablanida.', '2024-10-17 18:12:25', 1),
(41, 'ejthecoder@gmail.com', 'pending', 'complete', 'Your appointment has been completed.', '2024-10-17 18:12:31', 1),
(42, 'ejthecoder@gmail.com', 'pending', 'decline', 'Your appointment has been rejected.', '2024-10-17 18:12:32', 1),
(43, 'ejthecoder@gmail.com', 'OVAS-000001', 'confirm', 'Admin has confirmed the appointment of Ivan Ablanida.', '2024-10-17 18:13:05', 1),
(44, 'ejthecoder@gmail.com', 'pending', 'complete', 'Your appointment has been completed.', '2024-10-17 18:13:15', 1),
(45, 'ejthecoder@gmail.com', 'OVAS-000001', 'confirm', 'Admin has confirmed the appointment of Ivan Ablanida.', '2024-10-17 18:13:17', 1),
(46, 'ejthecoder@gmail.com', 'pending', 'decline', 'Your appointment has been rejected.', '2024-10-17 18:13:18', 1),
(47, 'ejthecoder@gmail.com', 'OVAS-000001', 'confirm', 'Admin has confirmed the appointment of Ivan Ablanida.', '2024-10-17 18:14:10', 1),
(48, 'ejthecoder@gmail.com', 'pending', 'complete', 'Your appointment has been completed.', '2024-10-17 18:14:34', 1),
(49, 'ejthecoder@gmail.com', 'pending', 'decline', 'Your appointment has been rejected.', '2024-10-17 18:14:56', 1),
(50, 'ejthecoder@gmail.com', 'pending', 'complete', 'Your appointment has been completed.', '2024-10-17 18:15:53', 1),
(51, 'ejthecoder@gmail.com', 'OVAS-000001', 'confirm', 'Admin has confirmed the appointment of Ivan Ablanida.', '2024-10-17 18:22:31', 1),
(52, 'ejthecoder@gmail.com', 'pending', 'complete', 'Your appointment has been completed.', '2024-10-17 18:22:44', 1),
(53, 'ejthecoder@gmail.com', 'OVAS-000002', 'confirm', 'Admin has confirmed the appointment of Ivan Ablanida.', '2024-10-17 18:22:45', 1),
(54, 'ejthecoder@gmail.com', 'OVAS-000002', 'complete', 'Your appointment has been completed.', '2024-10-17 20:34:05', 1),
(55, 'ejthecoder@gmail.com', 'OVAS-000003', 'confirm', 'Admin has confirmed the appointment of Ivan Ablanida.', '2024-10-17 20:34:55', 1),
(56, 'ejivan@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-10-17 20:46:23', 1),
(57, 'ejivan@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-10-17 21:05:37', 1),
(58, 'ejivan@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-10-17 21:12:22', 1),
(59, '', NULL, '', 'ab category has been edited.', '2024-10-17 22:22:44', 1),
(60, '', NULL, '', 'ab category has been deleted.', '2024-10-17 22:22:49', 1),
(61, '', NULL, '', 'New category \'1\' has been added.', '2024-10-17 22:32:38', 1),
(62, '', NULL, '', '1a category has been edited.', '2024-10-17 22:33:06', 1),
(63, '', NULL, '', '1a category has been deleted.', '2024-10-17 22:33:13', 1),
(64, '', NULL, '', 'New category test has been added.', '2024-10-17 22:36:54', 1),
(65, '', NULL, '', 'tests category has been edited.', '2024-10-17 22:37:14', 1),
(66, '', NULL, '', 'tests category has been deleted.', '2024-10-17 22:38:06', 1),
(67, 'ejivan@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-10-18 04:48:33', 1),
(68, 'ejivan@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-10-18 04:50:29', 1),
(69, 'ejivan@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-10-18 04:51:47', 1),
(70, 'ejivan@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-10-18 04:57:50', 1),
(71, 'ejivan@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-10-18 05:00:22', 1),
(72, 'ejivan@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-10-18 05:04:48', 1),
(73, 'ejivan@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-10-18 05:08:55', 1),
(74, 'ejivan@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-10-18 05:09:46', 1),
(75, 'ejivan@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-10-18 06:04:06', 1),
(76, 'ejivan@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-10-18 06:05:48', 1),
(77, 'ejivan@gmail.com', 'OVAS-000001', 'confirm', 'Admin has confirmed the appointment of Ablanida.', '2024-10-18 06:06:21', 1),
(78, 'ejivan@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-10-18 06:07:18', 1),
(79, 'ejivan@gmail.com', 'OVAS-000002', 'confirm', 'Admin has confirmed the appointment of Ablanida.', '2024-10-18 06:07:54', 1),
(80, 'ejivan.ablanida@cvsu.edu.ph', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-11-28 05:07:22', 1),
(81, 'eej@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-11-28 05:07:59', 1),
(82, 'e@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-11-28 05:12:22', 1),
(83, 'ejivancalbanida@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-11-28 06:56:39', 1),
(84, 'ejivancalbanida@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-11-28 07:49:59', 1),
(85, '32312@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-11-28 07:54:08', 1),
(86, '3123@gmail.co', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-11-28 07:57:16', 1),
(87, 'dasdas@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-11-28 07:58:13', 1),
(88, 'dsada@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-11-28 07:59:06', 1),
(89, 'dasdas213@mgail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-11-28 07:59:49', 1),
(90, 'dasds@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-11-28 08:00:17', 1),
(91, 'dasa@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-11-28 08:00:33', 1),
(92, 'ejv@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-11-28 08:04:35', 1),
(93, 'ddas312@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-11-28 08:09:32', 1),
(94, 'dsa@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-11-28 08:11:33', 1),
(95, 'dasdas@gfmail.co', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-11-28 08:14:13', 1),
(96, 'dasda@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-11-28 08:15:50', 1),
(97, 'ejivan.ablanida@cvsu.edu.ph', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-11-29 02:33:07', 1),
(98, 'ejivan.ablanida@cvsu.edu.ph', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-11-29 02:33:52', 1),
(99, 'ejivan.ablanida@cvsu.edu.ph', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-11-29 02:35:57', 1),
(100, 'ejivan@cvsu.edu.ph', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-11-29 02:36:57', 1),
(101, 'ejivan.ablanida@cvsu.edu.ph', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-11-29 02:37:47', 1),
(102, 'ejivan.ablanida@cvsu.edu.ph', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-11-29 02:38:23', 1),
(103, 'ejivan.ablanida@cvsu.edu.ph', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-11-29 02:39:02', 1),
(104, 'ejivan.ablanida@cvsu.edu.ph', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-11-29 02:42:40', 1),
(105, 'ejivan.ablanida@cvsu.edu.ph', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-11-29 03:04:39', 1),
(106, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000001', 'confirm', 'Admin has confirmed the appointment of Ivan.', '2024-11-29 03:09:09', 1),
(107, 'ejivan.ablanida@cvsu.edu.ph', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-11-29 03:53:44', 1),
(108, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000002', 'confirm', 'Admin has confirmed the appointment of Ivan.', '2024-12-05 19:22:22', 0),
(109, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000002', 'complete', 'Your appointment has been completed.', '2024-12-05 20:57:26', 0),
(110, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000002', 'complete', 'Your appointment has been completed.', '2024-12-05 21:08:16', 0),
(111, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000003', 'confirm', 'Admin has confirmed the appointment of Ivan.', '2024-12-05 21:08:21', 0),
(112, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000003', 'complete', 'Your appointment has been completed.', '2024-12-05 21:08:22', 0),
(113, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000004', 'confirm', 'Admin has confirmed the appointment of Ivan.', '2024-12-05 21:08:26', 0),
(114, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000005', 'confirm', 'Admin has confirmed the appointment of Ivan.', '2024-12-05 21:10:22', 0),
(115, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000005', 'complete', 'Your appointment has been completed.', '2024-12-05 21:10:25', 0),
(116, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000005', 'complete', 'Your appointment has been completed.', '2024-12-05 21:10:27', 0),
(117, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000005', 'decline', 'Your appointment has been rejected.', '2024-12-05 21:10:29', 0),
(118, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000006', 'confirm', 'Admin has confirmed the appointment of Ivan.', '2024-12-05 21:10:32', 0),
(119, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000007', 'confirm', 'Admin has confirmed the appointment of Ivan.', '2024-12-05 21:10:33', 0),
(120, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000007', 'complete', 'Your appointment has been completed.', '2024-12-05 21:10:35', 0),
(121, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000007', 'decline', 'Your appointment has been rejected.', '2024-12-05 21:10:37', 0),
(122, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000008', 'confirm', 'Admin has confirmed the appointment of Ivan.', '2024-12-05 21:10:45', 0),
(123, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000008', 'decline', 'Your appointment has been rejected.', '2024-12-05 21:10:47', 0),
(124, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000002', 'complete', 'Your appointment has been completed.', '2024-12-05 21:12:22', 0),
(125, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000002', 'complete', 'Your appointment has been completed.', '2024-12-05 21:12:25', 0),
(126, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000008', 'complete', 'Your appointment has been completed.', '2024-12-05 21:12:29', 0),
(127, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000008', 'decline', 'Your appointment has been rejected.', '2024-12-05 21:12:31', 0),
(128, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000009', 'confirm', 'Admin has confirmed the appointment of Ivan.', '2024-12-05 21:12:33', 0),
(129, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000009', 'decline', 'Your appointment has been rejected.', '2024-12-05 21:12:41', 0),
(130, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000010', 'confirm', 'Admin has confirmed the appointment of Ivan.', '2024-12-05 21:12:42', 0),
(131, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000011', 'confirm', 'Admin has confirmed the appointment of Ivan.', '2024-12-05 21:15:04', 0),
(132, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000011', 'complete', 'Your appointment has been completed.', '2024-12-05 21:15:07', 0),
(133, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000011', 'decline', 'Your appointment has been rejected.', '2024-12-05 21:15:09', 0),
(134, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000010', 'complete', 'Your appointment has been completed.', '2024-12-05 21:16:28', 0),
(135, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000012', 'confirm', 'Admin has confirmed the appointment of Ivan.', '2024-12-05 21:16:28', 0),
(136, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000013', 'confirm', 'Admin has confirmed the appointment of Ivan.', '2024-12-05 21:17:17', 0),
(137, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000014', 'confirm', 'Admin has confirmed the appointment of Ivan.', '2024-12-05 21:21:36', 0),
(138, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000014', 'complete', 'Your appointment has been completed.', '2024-12-05 21:21:39', 0),
(139, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000014', 'decline', 'Your appointment has been rejected.', '2024-12-05 21:21:46', 0),
(140, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000014', 'complete', 'Your appointment has been completed.', '2024-12-05 21:21:48', 0),
(141, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000015', 'confirm', 'Admin has confirmed the appointment of Ivan.', '2024-12-05 21:23:10', 0),
(142, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000016', 'confirm', 'Admin has confirmed the appointment of Ivan.', '2024-12-05 21:23:27', 0),
(143, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000016', 'complete', 'Your appointment has been completed.', '2024-12-05 21:23:28', 0),
(144, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000016', 'decline', 'Your appointment has been rejected.', '2024-12-05 21:23:30', 0),
(145, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000017', 'confirm', 'Admin has confirmed the appointment of Ivan.', '2024-12-05 21:23:34', 0),
(146, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000013', 'complete', 'Your appointment has been completed.', '2024-12-05 21:27:50', 0),
(147, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000013', 'complete', 'Your appointment has been completed.', '2024-12-05 21:27:53', 0),
(148, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000013', 'decline', 'Your appointment has been rejected.', '2024-12-05 21:27:55', 0),
(149, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000018', 'confirm', 'Admin has confirmed the appointment of Ivan.', '2024-12-05 21:28:05', 0),
(150, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000018', 'complete', 'Your appointment has been completed.', '2024-12-05 21:31:42', 0),
(151, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000018', 'decline', 'Your appointment has been rejected.', '2024-12-05 21:31:43', 0),
(152, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000019', 'confirm', 'Admin has confirmed the appointment of Ivan.', '2024-12-05 21:31:46', 0),
(153, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000019', 'decline', 'Your appointment has been rejected.', '2024-12-05 21:46:05', 0),
(154, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000020', 'confirm', 'Admin has confirmed the appointment of Ivan.', '2024-12-05 21:49:09', 0),
(155, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000020', 'decline', 'Your appointment has been rejected.', '2024-12-05 21:49:11', 0),
(156, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000017', 'decline', 'Your appointment has been rejected.', '2024-12-05 21:49:33', 0),
(157, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000017', 'complete', 'Your appointment has been completed.', '2024-12-05 21:49:44', 0),
(158, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000021', 'confirm', 'Admin has confirmed the appointment of Ivan.', '2024-12-05 21:51:03', 0),
(159, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000021', 'complete', 'Your appointment has been completed.', '2024-12-05 21:51:06', 0),
(160, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000021', 'decline', 'Your appointment has been rejected.', '2024-12-05 21:51:08', 0),
(161, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000021', 'decline', 'Your appointment has been rejected.', '2024-12-05 21:51:11', 0),
(162, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000022', 'confirm', 'Admin has confirmed the appointment of Ivan.', '2024-12-05 21:57:16', 0),
(163, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000022', 'decline', 'Your appointment has been rejected.', '2024-12-05 21:57:19', 0),
(164, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000023', 'confirm', 'Admin has confirmed the appointment of Ivan.', '2024-12-05 22:00:34', 0),
(165, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000023', 'decline', 'Your appointment has been rejected.', '2024-12-05 22:00:43', 0),
(166, 'ejthecoder@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-12-05 22:02:38', 0),
(167, 'ejthecoder@gmail.com', 'OVAS-000024', 'confirm', 'Admin has confirmed the appointment of Ablanida, Ej ivan C..', '2024-12-05 22:03:23', 0),
(168, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000025', 'confirm', 'Admin has confirmed the appointment of Ivan.', '2024-12-05 22:05:20', 0),
(169, 'ejthecoder@gmail.com', 'OVAS-000024', 'decline', 'Your appointment has been rejected.', '2024-12-05 22:06:32', 0),
(170, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000026', 'confirm', 'Admin has confirmed the appointment of Ivan.', '2024-12-05 22:07:20', 0),
(171, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000026', 'decline', 'Your appointment has been rejected.', '2024-12-05 22:07:23', 0),
(172, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000027', 'confirm', 'Admin has confirmed the appointment of Ivan.', '2024-12-05 22:07:45', 0),
(173, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000027', 'decline', 'Your appointment has been rejected.', '2024-12-05 22:07:48', 0),
(174, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000028', 'confirm', 'Admin has confirmed the appointment of Ivan.', '2024-12-05 22:08:21', 0),
(175, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000028', 'decline', 'Your appointment has been rejected.', '2024-12-05 22:08:23', 0),
(176, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000025', 'decline', 'Your appointment has been rejected.', '2024-12-05 22:08:41', 0),
(177, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000025', 'complete', 'Your appointment has been completed.', '2024-12-05 22:09:07', 0),
(178, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000025', 'decline', 'Your appointment has been rejected.', '2024-12-05 22:09:08', 0),
(179, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000025', 'complete', 'Your appointment has been completed.', '2024-12-05 22:09:12', 0),
(180, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000025', 'decline', 'Your appointment has been rejected.', '2024-12-05 22:09:14', 0),
(181, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000028', 'complete', 'Your appointment has been completed.', '2024-12-05 22:09:54', 0),
(182, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000028', 'decline', 'Your appointment has been rejected.', '2024-12-05 22:10:02', 0),
(183, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000028', 'complete', 'Your appointment has been completed.', '2024-12-05 22:10:11', 0),
(184, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000028', 'decline', 'Your appointment has been rejected.', '2024-12-05 22:10:12', 0),
(185, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000025', 'complete', 'Your appointment has been completed.', '2024-12-05 22:10:54', 0),
(186, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000025', 'decline', 'Your appointment has been rejected.', '2024-12-05 22:10:56', 0),
(187, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000025', 'complete', 'Your appointment has been completed.', '2024-12-05 22:11:46', 0),
(188, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000025', 'decline', 'Your appointment has been rejected.', '2024-12-05 22:11:47', 0),
(189, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000025', 'complete', 'Your appointment has been completed.', '2024-12-05 22:13:16', 0),
(190, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000025', 'decline', 'Your appointment has been rejected.', '2024-12-05 22:13:18', 0),
(191, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000025', 'complete', 'Your appointment has been completed.', '2024-12-05 22:15:47', 0),
(192, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000029', 'confirm', 'Admin has confirmed the appointment of Ivan.', '2024-12-05 22:15:48', 0),
(193, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000029', 'decline', 'Your appointment has been rejected.', '2024-12-05 22:15:50', 0),
(194, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000030', 'confirm', 'Admin has confirmed the appointment of Ivan.', '2024-12-05 22:18:52', 0),
(195, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000030', 'complete', 'Your appointment has been completed.', '2024-12-05 22:18:54', 0),
(196, 'ejivan.ablanida@cvsu.edu.ph', 'OVAS-000030', 'decline', 'Your appointment has been rejected.', '2024-12-05 22:18:55', 0),
(197, 'ejthecoder@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-12-05 22:46:09', 0),
(198, 'ejthecoder@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-12-05 22:46:54', 0),
(199, 'ejthecoder@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-12-05 23:19:16', 0),
(200, 'ejthecoder@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-12-05 23:23:41', 0),
(201, 'ejthecoder@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-12-05 23:26:57', 0),
(202, 'ejthecoder@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-12-05 23:29:17', 0),
(203, 'ejthecoder@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-12-05 23:30:14', 0),
(204, 'ejthecoder@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-12-05 23:32:29', 0),
(205, 'ejthecoder@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-12-05 23:34:23', 0),
(206, 'ejthecoder@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-12-05 23:36:36', 0),
(207, 'ejthecoder@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-12-05 23:38:21', 0),
(208, 'ejthecoder@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-12-05 23:49:04', 0),
(209, 'ejthecoder@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-12-06 00:43:41', 0),
(210, 'ejthecoder@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-12-06 00:47:59', 0),
(211, 'ejthecoder@gmail.com', 'OVAS-000031', 'confirm', 'Admin has confirmed the appointment of Ablanida, Ej ivan C..', '2024-12-06 01:00:16', 0),
(212, 'ejthecoder@gmail.com', 'OVAS-000031', 'decline', 'Your appointment has been rejected.', '2024-12-06 01:00:24', 0),
(213, 'ejthecoder@gmail.com', 'OVAS-000031', 'complete', 'Your appointment has been completed.', '2024-12-06 01:05:32', 0);

-- --------------------------------------------------------

--
-- Table structure for table `patients_records`
--

CREATE TABLE `patients_records` (
  `id` int(11) NOT NULL,
  `ownerName` varchar(255) DEFAULT NULL,
  `ownerAddress` text DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `home` varchar(20) DEFAULT NULL,
  `work` varchar(20) DEFAULT NULL,
  `viber` varchar(20) DEFAULT NULL,
  `ownerEmail` varchar(255) DEFAULT NULL,
  `preferredContact` varchar(50) DEFAULT NULL,
  `petName` varchar(255) DEFAULT NULL,
  `petType` varchar(50) DEFAULT NULL,
  `sex` varchar(50) DEFAULT NULL,
  `breed` varchar(50) DEFAULT NULL,
  `colorMarkings` varchar(255) DEFAULT NULL,
  `microchipNo` varchar(50) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `serviceCategory` varchar(50) DEFAULT NULL,
  `service` varchar(255) DEFAULT NULL,
  `totalPayment` decimal(10,2) DEFAULT NULL,
  `authorization` varchar(10) DEFAULT NULL,
  `enteringComplaint` text DEFAULT NULL,
  `historyPhysical` text DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients_records`
--

INSERT INTO `patients_records` (`id`, `ownerName`, `ownerAddress`, `mobile`, `home`, `work`, `viber`, `ownerEmail`, `preferredContact`, `petName`, `petType`, `sex`, `breed`, `colorMarkings`, `microchipNo`, `dob`, `age`, `serviceCategory`, `service`, `totalPayment`, `authorization`, `enteringComplaint`, `historyPhysical`, `date`) VALUES
(1, 'Ivan Ablanida', '', '09957939703', '312321', '312321', '31321312', 'ejivan@gmail.com', 'Mobile', '312312', 'Cat', 'Male Intact', 'dadas', 'dasds', '12312', '2024-09-27', 111, 'medical', '1500', 1500.00, 'no', 'dasdas', 'dasdasdas', '2024-09-29'),
(2, 'Ivan Ablanidas', 'dsadsadas', '09957939703', '312321', '312321', '31321312', 'ejivan@gmail.com', 'Mobile', '312312', 'Cat', 'Male Intact', 'dadas', 'dasds', '12312', '0000-00-00', 111, 'nonMedical', '850', 850.00, 'yes', 'dasdas', 'dsadas', '0000-00-00'),
(3, 'Ivan Ablanida', 'dasdasdasdsa', '09957939703', '312321', '312321', '31321312', 'ejivan@gmail.com', 'Work', '312312', 'Cat', 'Male Intact', 'dadas', 'dasds', '12312', '2024-09-26', 111, 'medical', '850', 850.00, 'no', 'dsadas', 'dasdsadas', '2024-09-26'),
(4, 'Racel Maes', '2nd Flor', '321', '312321', '312312', '12312', 'ejivancablanida@gmail.com', 'Email', '312312', 'Cat', 'Male Intact', 'dadas', 'dasds', '12312', '2026-02-02', 111, 'nonMedical', '2500', 2500.00, 'yes', 'dasdsa', 'dasdsa', '2024-09-03'),
(5, 'Kate', 'SANA SA INYO :((', '09957939703', '123', '12321321', '312321', 'ejivan@gmail.com', 'Mobile', 'Hello', 'Rabit', 'Male Neutered (kapon)', 'dadas', 'White', '123', '2024-10-03', 12, 'nonMedical', '999', 999.00, 'no', 'wala e', 'wala rin', '2024-09-20'),
(6, 'Kate', 'dasdsadas', '09957939703', '123', '12321321', '312321', 'ejivan@gmail.com', 'Mobile', 'Hello', 'Cat', 'Male Intact', 'dadas', 'White', '123', '2024-09-25', 12, 'medical', '1200', NULL, 'yes', 'dasdas', 'dasdsa', '2024-09-11'),
(7, 'Kate', 'dasdsadsa', '09957939703', '123', '12321321', '312321', 'ejivan@gmail.com', 'Mobile', 'Hello', 'Cat', 'Male Intact', 'dadas', 'White', '123', '2024-09-26', 12, 'medical', '2500', 2500.00, 'yes', 'dasdas', 'dsadas', '0000-00-00'),
(8, 'KateS', 'dsadasdas', '09957939703', '123', '12321321', '312321', 'ejivan@gmail.com', 'Email', 'Hello', 'Dog', 'Male Intact', 'dadas', 'White', '123', '2024-10-01', 12, 'medical', '1500', 1500.00, 'yes', 'dasda', 'dasdsadas', '2024-09-18'),
(9, 'Kate', '', '09957939703', '123', '12321321', '312321', 'ejivan@gmail.com', NULL, 'Hello', 'Cat', 'Male Intact', 'dadas', 'White', '123', '0000-00-00', 12, 'medical', '1200', 0.00, NULL, '', '', '0000-00-00'),
(10, 'Kate', '', '09957939703', '123', '12321321', '312321', 'ejivan@gmail.com', NULL, 'Hello', 'Cat', 'Male Intact', 'dadas', 'White', '123', '0000-00-00', 12, 'medical', '1200', 0.00, NULL, '', '', '0000-00-00'),
(11, 'Kate', 'brgy. san agustin', '09957939703', '123', '12321321', '312321', 'ejivan@gmail.com', NULL, 'Hello', 'Cat', 'Male Intact', 'dadas', 'White', '123', '0000-00-00', 12, 'medical', '1200', 0.00, NULL, 'sadsadsa', 'dasd', '0000-00-00'),
(12, 'Kate', 'dsadsa', '09957939703', '312', '321321312', '312312', 'ej@gmail.com', 'Email', '', 'Cat', 'Male Neutered (kapon)', '321312', '312312', '123', '2024-09-26', 12, 'medical', '1500', 1500.00, 'yes', 'dasdsa', 'dasdas', '2024-09-03'),
(13, 'Kate', 'dsadsa', '09957939703', '312', '', '312312', 'ej@gmail.com', NULL, '', 'Cat', 'Male Intact', '321312', '312312', '123', '0000-00-00', 12, 'medical', '1200', 0.00, NULL, '', '', '0000-00-00'),
(14, 'Test Updated', 'Test', '123', '123', '123', '123', 'ejthecoder@gmail.com', 'Email', 'Test', 'Dog', 'Male Neutered (kapon)', 'Test', 'Test', '123', '2024-09-26', 12, 'nonMedical', '2500', 2500.00, 'yes', '12', '12', '2024-09-19');

-- --------------------------------------------------------

--
-- Table structure for table `pos_records`
--

CREATE TABLE `pos_records` (
  `id` int(11) NOT NULL,
  `owner_name` varchar(255) NOT NULL,
  `services` text NOT NULL,
  `medication` text NOT NULL,
  `supplies` text NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `cost` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`cost`)),
  `cash_tendered` decimal(10,2) NOT NULL,
  `changee` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pos_records`
--

INSERT INTO `pos_records` (`id`, `owner_name`, `services`, `medication`, `supplies`, `total`, `created_at`, `cost`, `cash_tendered`, `changee`) VALUES
(55, 'Ivan', '[\"Surgical Servicesss\",\"Grooming\"]', '[\"nana\"]', '[\"dog food\",\"cat food\"]', 1999.00, '2024-09-12 10:10:40', '[\"\"]', 0.00, 0.00),
(56, 'Ivan', '[\"Surgical Servicesss\",\"Grooming\"]', '[\"med\",\"mad\"]', '[\"dog\",\"cat\"]', 1234.00, '2024-09-12 10:13:20', '[\"2500.00\",\"999.00\"]', 0.00, 0.00),
(57, 'ivan', '[\"Surgical Servicesss\"]', '[\"anan\"]', '[\"123\"]', 123.00, '2024-09-12 10:14:10', '[\"2500.00\"]', 0.00, 0.00),
(58, 'Hello', '[\"Surgical Servicesss\",\"Grooming\",\"Preventive Health Caress\"]', '[\"dsa\"]', '[\"dsadsa\"]', 1.00, '2024-09-12 10:24:05', '[\"2500.00\",\"999.00\",\"1.00\"]', 0.00, 0.00),
(59, 'Test Payment', '[\"Surgical Servicesss\",\"Pharmacy\"]', '[\"na\",\"drink\"]', '[\"na\",\"food\"]', 1000.00, '2024-09-23 05:52:13', '[\"2500.00\",\"300.00\"]', 0.00, 0.00),
(60, 'Ivan Oct 24', '[\"Surgical Servicesss\"]', '[\"Gamot\"]', '[\"123\"]', 3712.00, '2024-10-24 23:21:05', '[\"2500.00\"]', 0.00, 0.00),
(61, 'Test ni Ivan', '[\"Surgical Servicesss\",\"Surgical Servicesss\"]', '[\"dsadsa\",\"dsadsa\"]', '[\"21312\"]', 6011.00, '2024-10-25 02:48:27', '[\"2500.00\",\"2500.00\"]', 7000.00, 989.00),
(62, 'Ivan', '[\"\"]', '[\"\"]', '[\"\"]', 1000.00, '2024-10-25 02:50:10', '[\"\"]', 600.00, -400.00),
(63, 'Ivan', '[\"Pharmacy\"]', '[\"\"]', '[\"\"]', 100350.00, '2024-10-25 02:53:21', '[\"300.00\"]', 400.00, -99950.00),
(64, 'ivan test oct 24', '[\"Surgical Servicesss\",\"Pharmacy\"]', '[\"gamot\"]', '[\"cat food\",\"dog food\"]', 3150.00, '2024-10-25 02:57:44', '[\"2500.00\",\"300.00\"]', 4000.00, 850.00),
(65, 'Ivan test', '[\"Pharmacy\"]', '[\"gamot\",\"gamot2\"]', '[\"cat food\"]', 10550.00, '2024-10-25 02:59:44', '[\"300.00\"]', 4000.00, -6550.00),
(66, 'Ivan', '[\"\"]', '[\"\"]', '[\"\",\"\"]', 505050.00, '2024-10-25 03:00:04', '[\"\"]', 6000.00, -499050.00),
(67, 'Ivan test', '[\"Surgical Servicesss\",\"Pharmacy\"]', '[\"gamot\"]', '[\"cat food\"]', 3900.00, '2024-10-25 03:03:47', '[\"2500.00\",\"300.00\"]', 3950.00, 50.00);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `view` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `name`, `profile_picture`, `comment`, `created_at`, `view`) VALUES
(1, 'test', 'gallery-11.jpg', 'dasdsa', '2024-09-17 06:42:18', 1),
(2, 'test', 'gallery-11.jpg', 'dasdsa', '2024-09-17 06:43:19', 1),
(4, 'Ej Ivan Ablanida', NULL, 'Hello', '2024-10-18 02:52:06', 1),
(5, 'Ej Ivan Ablanida', NULL, 'das', '2024-10-18 02:52:15', 1),
(6, 'Ivan', 'customer.jfif', 'dsadsa', '2024-10-26 07:38:11', 1),
(7, 'Anonymous', NULL, 'dsadsa', '2024-10-26 07:38:22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `service_list`
--

CREATE TABLE `service_list` (
  `id` int(11) NOT NULL,
  `service_type` enum('medical','non-medical') NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `discount` decimal(5,2) DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `info` varchar(255) DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_list`
--

INSERT INTO `service_list` (`id`, `service_type`, `service_name`, `cost`, `discount`, `created_at`, `info`, `is_read`) VALUES
(6, 'medical', 'Surgical Servicesss', 2500.00, 1.00, '2024-09-11 10:11:31', 'Professional surgical services for your pets', 0),
(7, 'medical', 'Pharmacy', 300.00, 0.00, '2024-09-11 10:12:04', 'Wide range of medications available at our pharmacy.', 0),
(8, 'non-medical', 'Grooming', 999.00, 10.00, '2024-09-11 10:13:23', 'Professional grooming services to keep your pets looking their best', 0),
(9, 'non-medical', 'Boarding', 700.00, 0.00, '2024-09-11 10:13:43', 'Comfortable and safe boarding services for your pets', 0),
(10, 'non-medical', 'Pet Supplies', 300.00, 0.00, '2024-09-11 10:14:05', 'A wide range of pet supplies for your pet\'s needs', 0),
(17, 'medical', 'Preventive Health Caress', 123.00, 10.00, '2024-10-17 22:53:49', '312312dasdsa', 1);

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(11) NOT NULL,
  `system_logo` varchar(255) DEFAULT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `system_name` varchar(255) NOT NULL,
  `system_short_name` varchar(255) DEFAULT NULL,
  `welcome_content` text DEFAULT NULL,
  `welcome_image` varchar(255) DEFAULT NULL,
  `about_us` text DEFAULT NULL,
  `about_us_image` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `contact_num` varchar(20) NOT NULL,
  `location` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `system_logo`, `cover`, `system_name`, `system_short_name`, `welcome_content`, `welcome_image`, `about_us`, `about_us_image`, `email`, `contact_num`, `location`, `created_at`, `updated_at`) VALUES
(1, 'logo.png', '', 'Pawfects', 'Pawfect', 'Welcome to Bark Yard Pet Wellness Center, your one-stop destination for pet grooming and care.s\r\n\r\n', 'about-us.png', 'The Bark Yard Pet Salon and Wellness Clinic is an animal care facility dedicated to providing high customer satisfaction by rendering quality pet care while furnishing a fun, clean, thematic, enjoyable atmosphere at an acceptable price. Our experienced team is passionate about animals and committed to their well-being. We offer a range of services tailored to meet the unique needs of each pet, ensuring they leave happy and healthy.', 'vet logo.jpg', 'sample@gmail.com', '09338182822', '2nd Floor A & A Building Magdiwang Highway, Noveleta, Philippines, 4105', '2024-09-10 06:04:11', '2024-09-10 11:11:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'user',
  `profile_picture` varchar(255) NOT NULL DEFAULT 'customer.jfif',
  `address` varchar(255) NOT NULL,
  `contact_num` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `profile_picture`, `address`, `contact_num`) VALUES
(32, 'Ej Ivan Ablanids', 'ejivancablanida@gmail.com', '$2y$10$0eNUhX8Nx6.gSi.L85kIdemmaT6bt.3iOzbVlVfXUwlYG.OE2lWf2', 'admin', '', '', ''),
(34, 'Ej Ivan Ablanida', 'a@gmail.com', '$2y$10$0eNUhX8Nx6.gSi.L85kIdemmaT6bt.3iOzbVlVfXUwlYG.OE2lWf2', 'user', 'R.png', '', ''),
(36, 'Admin', 'ab@gmail.com', '$2y$10$B4sTaZVYv6u1XGvXFZE2buBUxHz5uKW9/Dr5y1MxLY1H6QnVoLRvO', 'admin', '', '', ''),
(37, 'Ej Ivan Ablanida', 'abc@gmail.com', '$2y$10$aSc1mOWnnS/EIQ9eF7beIO4YTiiSYYbxhbNcX.W0jS6Pi7kxFKoHe', 'admin', '', '', ''),
(42, 'Tests', 'test@gmail.com', '$2y$10$hwURNTqnyPiVYte4Gueh0.dWfAjIEfRtB20YQv60LifoS3ugN0VkC', 'admin', '', '', ''),
(45, 'Ivan', 'ejivan.ablanida@cvsu.edu.ph', '$2y$10$CEJtNHPflXQ4mDooAahoFenQLbRnwA50ny.wqIDmBTH8qUtGehx7y', 'user', 'customer.jfif', '', ''),
(46, 'ejivan', '1@gmail.com', '$2y$10$.u6lPyISRoBxc0HkpZtlP.yPT24G4fdIBm8MLBkz8Pgd3CynQcpmi', 'staff', 'customer.jfif', '', ''),
(47, 'Ablanida, Ej ivan C.', 'ejthecoder@gmail.com', '$2y$10$N46Z5IOEwdxum5nez0Uy1OqVaUGVCYOdZTaveSR9EgrDouinIU3kS', 'user', 'customer.jfif', 'Blk 4. Lot 24', '09957939703');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_confirm`
--
ALTER TABLE `admin_confirm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_req_notif`
--
ALTER TABLE `app_req_notif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `max_booking`
--
ALTER TABLE `max_booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients_records`
--
ALTER TABLE `patients_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pos_records`
--
ALTER TABLE `pos_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_list`
--
ALTER TABLE `service_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_confirm`
--
ALTER TABLE `admin_confirm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `app_req_notif`
--
ALTER TABLE `app_req_notif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `max_booking`
--
ALTER TABLE `max_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;

--
-- AUTO_INCREMENT for table `patients_records`
--
ALTER TABLE `patients_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pos_records`
--
ALTER TABLE `pos_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `service_list`
--
ALTER TABLE `service_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
