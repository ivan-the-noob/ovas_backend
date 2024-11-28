-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2024 at 09:34 AM
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
(21, 'Ablanida', 'confirm', '2024-10-18 06:06:21', 'ejivan@gmail.com', '0'),
(22, 'Ablanida', 'confirm', '2024-10-18 06:07:54', 'ejivan@gmail.com', '0');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `owner_name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL DEFAULT 'pending',
  `status` enum('pending','confirm','decline') NOT NULL DEFAULT 'pending',
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
  `reference` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `owner_name`, `code`, `status`, `contact_number`, `email`, `address`, `pet_type`, `breed`, `age`, `service_category`, `service_type`, `appointment_time`, `appointment_date`, `total_payment`, `created_at`, `payment_method`, `gcash_screenshot`, `reference`) VALUES
(68, 'Ivan', 'pending', 'pending', '0312321', 'ejivancalbanida@gmail.com', 'dasdas', 'Cat', '12', 12, 'medical', 'Diagnostic and Therapeutic', '09:00:00', '2024-11-28', 1200.00, '2024-11-28 06:56:39', 'pay_on_store', '', 0),
(69, 'Ivan', 'pending', 'pending', '0312321', 'ejivancalbanida@gmail.com', 'dasdas', 'Cat', '12', 12, '', '', '00:00:00', '0000-00-00', 0.00, '2024-11-28 07:49:59', '', '', 0),
(70, 'dasdasd', 'pending', 'pending', 'adsada', '32312@gmail.com', 'dasdas', 'Dog', 'dsadsa', 312312312, 'medical', 'Diagnostic and Therapeutic', '09:00:00', '2024-11-29', 1200.00, '2024-11-28 07:54:08', 'pay_on_store', '', 0),
(71, 'dasdsadsa', 'pending', 'pending', 'dsadsa', '3123@gmail.co', 'mdasdsa', 'Cat', 'dsa', 12, 'nonMedical', 'Grooming', '12:00:00', '2024-11-30', 999.00, '2024-11-28 07:57:16', 'pay_on_store', '', 0),
(72, 'daskdas', 'pending', 'pending', 'dasdsa', 'dasdas@gmail.com', 'dsadsa', 'Cat', '12', 12, 'nonMedical', '', '10:00:00', '2024-12-03', 0.00, '2024-11-28 07:58:13', 'pay_on_store', '', 0),
(73, 'dasdsa321', 'pending', 'pending', '321321', 'dsada@gmail.com', 'dsadsa', 'Cat', '12', 21, 'medical', 'Preventive Health Care', '11:00:00', '2024-12-04', 850.00, '2024-11-28 07:59:06', '', '', 0),
(74, 'dsadsadsa', 'pending', 'pending', 'dasdsadas', 'dasdas213@mgail.com', 'dsadas', 'Cat', '123', 123, 'medical', 'Diagnostic and Therapeutic', '10:00:00', '2024-12-05', 1200.00, '2024-11-28 07:59:49', 'pay_on_store', '', 0),
(75, 'dsadsa3213', 'pending', 'pending', '312321', 'dasds@gmail.com', 'dasdas', 'Dog', '321312', 21, 'nonMedical', 'Boarding', '11:00:00', '2024-12-06', 700.00, '2024-11-28 08:00:17', 'pay_on_store', '', 0),
(76, 'dsadsadsa', 'pending', 'pending', '21321', 'dasa@gmail.com', 'dasdas', 'Cat', '12', 12, 'medical', 'Preventive Health Care', '10:00:00', '2024-12-07', 850.00, '2024-11-28 08:00:33', 'pay_on_store', '', 0),
(77, 'dasdsa', 'pending', 'pending', '321321', 'ejv@gmail.com', 'dasdsa', 'Cat', '12', 12, 'medical', 'Diagnostic and Therapeutic', '10:00:00', '2024-12-02', 1200.00, '2024-11-28 08:04:35', 'pay_on_store', '', 0),
(78, 'dsadsa312', 'pending', 'pending', '32123321', 'ddas312@gmail.com', 'dasdsa', 'Cat', '12', 12, 'medical', 'Diagnostic and Therapeutic', '10:00:00', '2024-12-12', 1200.00, '2024-11-28 08:09:32', 'pay_on_store', '', 0),
(79, 'ivan ablanida', 'pending', 'pending', 'dasdsa', 'dsa@gmail.com', 'dasdas', 'Cat', '12', 12, 'medical', 'Diagnostic and Therapeutic', '17:00:00', '2024-12-01', 1200.00, '2024-11-28 08:11:33', 'pay_on_store', '', 0),
(80, 'dadasda', 'pending', 'pending', '312321', 'dasdas@gfmail.co', 'mdasdsa', 'Cat', '12', 12, 'nonMedical', 'Boarding', '15:00:00', '2024-12-11', 700.00, '2024-11-28 08:14:13', 'pay_on_store', '', 0),
(81, 'dasdsa', 'pending', 'pending', 'dasdas', 'dasda@gmail.com', 'dasdsa', 'Cat', '12', 12, 'medical', 'Diagnostic and Therapeutic', '11:00:00', '2024-12-10', 1200.00, '2024-11-28 08:15:50', 'pay_on_store', '', 0);

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
(1, 1);

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
(84, 'ejivancalbanida@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-11-28 07:49:59', 0),
(85, '32312@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-11-28 07:54:08', 0),
(86, '3123@gmail.co', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-11-28 07:57:16', 0),
(87, 'dasdas@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-11-28 07:58:13', 0),
(88, 'dsada@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-11-28 07:59:06', 0),
(89, 'dasdas213@mgail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-11-28 07:59:49', 0),
(90, 'dasds@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-11-28 08:00:17', 0),
(91, 'dasa@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-11-28 08:00:33', 0),
(92, 'ejv@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-11-28 08:04:35', 0),
(93, 'ddas312@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-11-28 08:09:32', 0),
(94, 'dsa@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-11-28 08:11:33', 0),
(95, 'dasdas@gfmail.co', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-11-28 08:14:13', 0),
(96, 'dasda@gmail.com', NULL, 'Success', 'You successfully booked! Please wait for confirmation.', '2024-11-28 08:15:50', 0);

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
  `profile_picture` varchar(255) NOT NULL DEFAULT 'customer.jfif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `profile_picture`) VALUES
(32, 'Ej Ivan Ablanids', 'ejivancablanida@gmail.com', '$2y$10$0eNUhX8Nx6.gSi.L85kIdemmaT6bt.3iOzbVlVfXUwlYG.OE2lWf2', 'admin', ''),
(34, 'Ej Ivan Ablanida', 'a@gmail.com', '$2y$10$0eNUhX8Nx6.gSi.L85kIdemmaT6bt.3iOzbVlVfXUwlYG.OE2lWf2', 'user', 'R.png'),
(36, 'Admin', 'ab@gmail.com', '$2y$10$B4sTaZVYv6u1XGvXFZE2buBUxHz5uKW9/Dr5y1MxLY1H6QnVoLRvO', 'admin', ''),
(37, 'Ej Ivan Ablanida', 'abc@gmail.com', '$2y$10$aSc1mOWnnS/EIQ9eF7beIO4YTiiSYYbxhbNcX.W0jS6Pi7kxFKoHe', 'admin', ''),
(42, 'Tests', 'test@gmail.com', '$2y$10$hwURNTqnyPiVYte4Gueh0.dWfAjIEfRtB20YQv60LifoS3ugN0VkC', 'admin', ''),
(44, 'ej ej', 'ejthecoder@gmail.com', '$2y$10$6qFHs8ZoGu.gQGNEVG7qG.bqKKA3enTvJi2BvJzJtB317t42VNjvy', 'user', 'customer.jfif'),
(45, 'Ivan', 'ejivan.ablanida@cvsu.edu.ph', '$2y$10$CEJtNHPflXQ4mDooAahoFenQLbRnwA50ny.wqIDmBTH8qUtGehx7y', 'user', 'customer.jfif'),
(46, 'ejivan', '1@gmail.com', '$2y$10$.u6lPyISRoBxc0HkpZtlP.yPT24G4fdIBm8MLBkz8Pgd3CynQcpmi', 'staff', 'customer.jfif');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
