-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2025 at 01:23 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
(156, 'Admin ', 'decline', '2025-01-14 10:42:11', 'ejthecoder@gmail.com', '0');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `owner_name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL DEFAULT 'pending',
  `status` enum('pending','confirm','complete','decline','cancelled') NOT NULL,
  `reason_cancel` text DEFAULT NULL,
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
  `decline_reason` varchar(255) DEFAULT NULL,
  `pet_name` varchar(255) NOT NULL,
  `vet_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `owner_name`, `code`, `status`, `reason_cancel`, `contact_number`, `email`, `address`, `pet_type`, `breed`, `age`, `service_category`, `service_type`, `appointment_time`, `appointment_date`, `total_payment`, `created_at`, `payment_method`, `gcash_screenshot`, `reference`, `decline_reason`, `pet_name`, `vet_name`) VALUES
(128, 'Admin ', 'OVAS-000004', 'decline', 'Wrong', '', 'ejthecoder@gmail.com', '', '321321', 'dsadasdas', 12, 'medical', 'Diagnostic and Therapeutic', '12:00:00', '2025-01-14', 1200.00, '2025-01-14 08:13:39', 'gcash', '3.jpg', 2147483647, 'dsadsa', '', 'sdadsa');

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
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `image`, `created_at`) VALUES
(2, 'faq_67860f7d305083.69504165.jpg', '2025-01-14 07:17:17'),
(3, 'faq_67860f82f32a07.60933655.jpg', '2025-01-14 07:17:22'),
(4, 'faq_67860f86df9771.04243774.jpg', '2025-01-14 07:17:26'),
(5, 'faq_67860f8b6f9151.25127788.jpg', '2025-01-14 07:17:31'),
(6, 'faq_67860f8f952159.43128882.jpg', '2025-01-14 07:17:35'),
(7, 'faq_67860f936cc337.86141619.jpg', '2025-01-14 07:17:39'),
(8, 'faq_67860f97381459.25070398.jpg', '2025-01-14 07:17:43'),
(9, 'faq_678610c85625e1.58634761.jpg', '2025-01-14 07:22:48');

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
(275, 'ejthecoder@gmail.com', NULL, 'decline', 'Your appointment has been declined.<br> Reason: dasdsa', '2025-01-14 10:37:42', 0),
(276, 'ejthecoder@gmail.com', NULL, 'decline', 'Your appointment has been declined.<br> Reason: Wrong', '2025-01-14 10:42:11', 0);

-- --------------------------------------------------------

--
-- Table structure for table `patients_records`
--

CREATE TABLE `patients_records` (
  `id` int(11) NOT NULL,
  `ownerName` varchar(255) DEFAULT NULL,
  `ownerMiddleName` varchar(255) DEFAULT NULL,
  `ownerLastName` varchar(255) DEFAULT NULL,
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
  `date` date DEFAULT NULL,
  `previous_veteran` varchar(255) DEFAULT NULL,
  `health_insurance` varchar(255) DEFAULT NULL,
  `drug_allergies` text DEFAULT NULL,
  `illness_surgeries` text DEFAULT NULL,
  `cur_medications` text DEFAULT NULL,
  `diet_restrictions` text DEFAULT NULL,
  `initial_visits` int(11) DEFAULT NULL,
  `vet_name` varchar(255) DEFAULT NULL,
  `vet_report` text DEFAULT NULL,
  `date_return` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients_records`
--

INSERT INTO `patients_records` (`id`, `ownerName`, `ownerMiddleName`, `ownerLastName`, `ownerAddress`, `mobile`, `home`, `work`, `viber`, `ownerEmail`, `preferredContact`, `petName`, `petType`, `sex`, `breed`, `colorMarkings`, `microchipNo`, `dob`, `age`, `serviceCategory`, `service`, `totalPayment`, `authorization`, `enteringComplaint`, `historyPhysical`, `date`, `previous_veteran`, `health_insurance`, `drug_allergies`, `illness_surgeries`, `cur_medications`, `diet_restrictions`, `initial_visits`, `vet_name`, `vet_report`, `date_return`) VALUES
(16, 'test', 'test', 'test', 'test', '09957939703', NULL, NULL, NULL, 'test@gmail.com', NULL, 'test', 'test', 'Male', 'test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Yes', NULL, NULL, NULL, 'test', 'test', 'test', NULL, 'test', NULL, NULL, 'test', 'test', NULL),
(17, 'test', 'test', 'test', 'test', '31231', NULL, NULL, NULL, 'test@gmail.com', NULL, 'test', 'test', 'Male', 'test', 'test', '312312', '2025-01-24', 12, NULL, NULL, NULL, 'Yes', NULL, 'test', NULL, 'test', 'test', 'test', 'test', 'test', 'test', 0, 'test', 'test', '2025-01-25'),
(18, 'TEST', 'twst', 'test', 'test', '09957939703', NULL, NULL, NULL, 'test@gmail.com', NULL, 'Jss', 'Test', 'Female', 'test', 'black', '1033', '2025-01-12', 12, NULL, NULL, NULL, 'test', NULL, 'test', NULL, 'test', 'twst', 'test', 'test', 'test', 'yest', 0, 'test', 'test', '2025-01-12'),
(19, 'Racel Mae', 'cecilio', 'loquellano', 'pk2', '09916169998', NULL, NULL, NULL, 'racelmae@gmail.com', NULL, 'roar', 'mdsd', 'Male', 'spanish', 'black ', '123223', '2024-11-20', 1, NULL, NULL, NULL, 'yes', NULL, 'cnnskjcnsk', NULL, 'nskndks', '', '', '', '', '', 0, 'Ms. Villanueva', 'dnksndk kdmwsl kdmks', '2025-01-10');

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
  `changee` decimal(10,2) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pos_records`
--

INSERT INTO `pos_records` (`id`, `owner_name`, `services`, `medication`, `supplies`, `total`, `created_at`, `cost`, `cash_tendered`, `changee`, `timestamp`) VALUES
(55, 'Ivan', '[\"Surgical Servicesss\",\"Grooming\"]', '[\"nana\"]', '[\"dog food\",\"cat food\"]', 1999.00, '2024-09-12 10:10:40', '[\"\"]', 0.00, 0.00, '2025-01-05 04:41:59'),
(56, 'Ivan', '[\"Surgical Servicesss\",\"Grooming\"]', '[\"med\",\"mad\"]', '[\"dog\",\"cat\"]', 1234.00, '2024-09-12 10:13:20', '[\"2500.00\",\"999.00\"]', 0.00, 0.00, '2025-01-05 04:41:59'),
(57, 'ivan', '[\"Surgical Servicesss\"]', '[\"anan\"]', '[\"123\"]', 123.00, '2024-09-12 10:14:10', '[\"2500.00\"]', 0.00, 0.00, '2025-01-05 04:41:59'),
(58, 'Hello', '[\"Surgical Servicesss\",\"Grooming\",\"Preventive Health Caress\"]', '[\"dsa\"]', '[\"dsadsa\"]', 1.00, '2024-09-12 10:24:05', '[\"2500.00\",\"999.00\",\"1.00\"]', 0.00, 0.00, '2025-01-05 04:41:59'),
(59, 'Test Payment', '[\"Surgical Servicesss\",\"Pharmacy\"]', '[\"na\",\"drink\"]', '[\"na\",\"food\"]', 1000.00, '2024-09-23 05:52:13', '[\"2500.00\",\"300.00\"]', 0.00, 0.00, '2025-01-05 04:41:59'),
(60, 'Ivan Oct 24', '[\"Surgical Servicesss\"]', '[\"Gamot\"]', '[\"123\"]', 3712.00, '2024-10-24 23:21:05', '[\"2500.00\"]', 0.00, 0.00, '2025-01-05 04:41:59'),
(61, 'Test ni Ivan', '[\"Surgical Servicesss\",\"Surgical Servicesss\"]', '[\"dsadsa\",\"dsadsa\"]', '[\"21312\"]', 6011.00, '2024-10-25 02:48:27', '[\"2500.00\",\"2500.00\"]', 7000.00, 989.00, '2025-01-05 04:41:59'),
(62, 'Ivan', '[\"\"]', '[\"\"]', '[\"\"]', 1000.00, '2024-10-25 02:50:10', '[\"\"]', 600.00, -400.00, '2025-01-05 04:41:59'),
(63, 'Ivan', '[\"Pharmacy\"]', '[\"\"]', '[\"\"]', 100350.00, '2024-10-25 02:53:21', '[\"300.00\"]', 400.00, -99950.00, '2025-01-05 04:41:59'),
(64, 'ivan test oct 24', '[\"Surgical Servicesss\",\"Pharmacy\"]', '[\"gamot\"]', '[\"cat food\",\"dog food\"]', 3150.00, '2024-10-25 02:57:44', '[\"2500.00\",\"300.00\"]', 4000.00, 850.00, '2025-01-05 04:41:59'),
(65, 'Ivan test', '[\"Pharmacy\"]', '[\"gamot\",\"gamot2\"]', '[\"cat food\"]', 10550.00, '2024-10-25 02:59:44', '[\"300.00\"]', 4000.00, -6550.00, '2025-01-05 04:41:59'),
(66, 'Ivan', '[\"\"]', '[\"\"]', '[\"\",\"\"]', 505050.00, '2024-10-25 03:00:04', '[\"\"]', 6000.00, -499050.00, '2025-01-05 04:41:59'),
(67, 'Ivan test', '[\"Surgical Servicesss\",\"Pharmacy\"]', '[\"gamot\"]', '[\"cat food\"]', 3900.00, '2024-10-25 03:03:47', '[\"2500.00\",\"300.00\"]', 3950.00, 50.00, '2025-01-05 04:41:59'),
(68, 'Racel', '[\"Grooming\",\"\",\"\"]', '[\"Shampoo\"]', '[\"\"]', 999.00, '2025-01-12 06:51:12', '[\"999.00\",\"\",\"\"]', 1500.00, 501.00, '2025-01-12 06:51:12'),
(69, 'Racel', '[\"Pharmacy\",\"\",\"\",\"\"]', '[\"lkjkdhsjbdsj\"]', '[\"\"]', 300.00, '2025-01-12 17:59:25', '[\"300.00\",\"\",\"\",\"\"]', 1000.00, 700.00, '2025-01-12 17:59:25'),
(70, 'Anne Marcial', '[\"\",\"Surgical Servicesss\",\"Grooming\",\"Pet Supplies\",\"\",\"\",\"\",\"\"]', '[\"\"]', '[\"\"]', 3799.00, '2025-01-14 04:02:07', '[\"NaN\",\"2500.00\",\"999.00\",\"300.00\",\"\",\"\",\"\",\"\"]', 4000.00, 201.00, '2025-01-14 04:02:07');

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
  `view` tinyint(1) DEFAULT 0,
  `rating` int(1) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `name`, `profile_picture`, `comment`, `created_at`, `view`, `rating`, `image`) VALUES
(2, 'test', 'gallery-11.jpg', 'dasdsa', '2024-09-17 06:43:19', 1, 3, NULL),
(5, 'Ej Ivan Ablanida', 'customer.jfif', 'das', '2024-10-18 02:52:15', 1, 3, '1736836240_profile.png'),
(6, 'Ivan', 'customer.jfif', 'dsadsa', '2024-10-26 07:38:11', 1, 3, '1736836240_profile.png'),
(7, 'Anonymous', 'customer.jfif', 'dsadsa', '2024-10-26 07:38:22', 1, 3, '1736836240_profile.png'),
(8, 'Racel Mae', 'customer.jfif', 'Super nice! ', '2025-01-12 03:52:37', 1, 3, '1736836240_profile.png'),
(9, 'Admin', 'customer.jfif', 'hello po!', '2025-01-14 06:23:55', 0, 3, '1736836240_profile.png'),
(10, 'Admin', 'customer.jfif', 'dasdsadsa', '2025-01-14 06:25:35', 0, 3, '1736836240_profile.png\\'),
(11, 'Admin', 'customer.jfif', 'dsadsa', '2025-01-14 06:27:35', 0, 3, '1736836240_profile.png'),
(13, 'Admin', 'customer.jfif', 'dasdsadsa', '2025-01-14 06:30:40', 0, 3, NULL);

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
(1, 'logo.png', '', 'Pawfects', 'Pawfect', 'Welcome to Bark Yard Pet Wellness Center, your one-stop destination for pet grooming and care.s\r\n\r\n', 'about-us.png', 'The Bark Yard Pet Salon and Wellness Clinic is an animal care facility dedicated to providing high customer satisfaction by rendering quality pet care while furnishing a fun, clean, thematic, enjoyable atmosphere at an acceptable price. Our experienced team is passionate about animals and committed to their well-being. We offer a range of services tailored to meet the unique needs of each pet, ensuring they leave happy and healthy.\r\n\r\n\r\nBYPWC has been in operation for 8 years – opened by Dr. Anna Kristine Mendoza after she earned her Doctorate in Veterinary Medicine in 2005 from University of the Philippines Los Baños. The clinic focuses on small animals –most of its patients being dogs and cats. The clinic does not handle larger animals like horses, cows, or pigs. The clinic now has 3 full time employees  amd 1 part time veterinarian– including one veterinarian (Dr. Mendoza), one veterinary assistant, and one office manager.\r\n- DOC TIN', 'vet logo.jpg', 'sample@gmail.com', '09338182822', '2nd Floor A & A Building Magdiwang Highway, Noveleta, Philippines, 4105', '2024-09-10 06:04:11', '2024-12-10 19:29:22');

-- --------------------------------------------------------

--
-- Table structure for table `unavailable`
--

CREATE TABLE `unavailable` (
  `id` int(11) NOT NULL,
  `unavailable` date NOT NULL,
  `reason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unavailable`
--

INSERT INTO `unavailable` (`id`, `unavailable`, `reason`) VALUES
(1, '2024-12-13', 'dasdsa123try'),
(3, '2025-01-15', 'fully booked!');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'user',
  `profile_picture` varchar(255) NOT NULL DEFAULT 'customer.jfif',
  `address` varchar(255) NOT NULL,
  `contact_num` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `email`, `password`, `role`, `profile_picture`, `address`, `contact_num`) VALUES
(36, 'Admin', '', 'ejthecoder@gmail.com', '$2y$10$B4sTaZVYv6u1XGvXFZE2buBUxHz5uKW9/Dr5y1MxLY1H6QnVoLRvO', 'user', '', '', ''),
(42, 'Tests', '', 'admin@gmail.com', '$2y$10$hwURNTqnyPiVYte4Gueh0.dWfAjIEfRtB20YQv60LifoS3ugN0VkC', 'admin', '', '', ''),
(51, 'Racel Mae', 'Loquellano', 'racelmaeloquellano@gmail.com', '$2y$10$dME4MAYzCJJUDt/JTxcFa.rwF29R8grWL7PS2h0Dys04X.jms0.yO', 'user', 'customer.jfif', 'S11 B2 L13 Belvedere Pk2 Gentri', '09618757048'),
(52, 'Frances', 'Medrano', 'love.cessyyyy@gmail.com', '$2y$10$dnZ5NCBT.N/2QD2Q2mFE3.2iweMh8.3TBE26pD0Ig56oomxb854GS', 'user', 'customer.jfif', 'tanza', '09057965873'),
(53, 'Kim', 'Lungcay', 'kimlouremae.lungcay@gmail.com', '$2y$10$4gkDdCXRHuTXSMFxZxAjq.Su74XsRYodcwx7j6IOaaRFGBo3iyM3a', 'user', 'customer.jfif', 'Halayhay', '09167649000'),
(54, 'farhan', 'sharief', 'farhanuoiklhjlkjasdlkj@yopmail.com', '$2y$10$t3KcIBYwu8IXePVxVlozwOnOmGad0ZXE0fB7vhCvh9UhaEQ8LmJE6', 'user', 'customer.jfif', 'Mati City', '09615365586'),
(55, 'Anne', 'Marcial', 'annemarcialll@gmail.com', '$2y$10$x.jSUfC1/JP.WULf2NmJvOlZ0PV2AbbZHpvNIfZ5dc5vB3cn9.s4K', 'user', 'customer.jfif', 'Amaya 2', '09265482650');

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
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
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
-- Indexes for table `unavailable`
--
ALTER TABLE `unavailable`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

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
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `max_booking`
--
ALTER TABLE `max_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=277;

--
-- AUTO_INCREMENT for table `patients_records`
--
ALTER TABLE `patients_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pos_records`
--
ALTER TABLE `pos_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
-- AUTO_INCREMENT for table `unavailable`
--
ALTER TABLE `unavailable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
