-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2025 at 10:53 AM
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
-- Database: `home4paws_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `uname` varchar(100) NOT NULL,
  `pw` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `fname`, `uname`, `pw`) VALUES
(1, 'Aditi Acharekar', 'Aditi_12', '210924');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_adopt`
--

CREATE TABLE `tbl_adopt` (
  `id` int(11) NOT NULL,
  `pet_id` int(11) NOT NULL,
  `pet` varchar(100) NOT NULL,
  `age` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `adoption_date` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `adoptee_name` varchar(100) NOT NULL,
  `adoptee_contact` varchar(20) NOT NULL,
  `adoptee_email` varchar(150) NOT NULL,
  `adoptee_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
--
-- Dumping data for table `tbl_adopt`
--

INSERT INTO `tbl_adopt` (`id`, `pet`, `age`, `gender`, `adoption_date`, `status`, `adoptee_name`, `adoptee_contact`, `adoptee_email`, `adoptee_address`) VALUES
(5, 'Rocky', '5 years', 'Male', '2025-02-16', 'Requested', 'Aditi Acharekar', '9326852690', 'aditiacharekar3@gmail.com', 'Sitaram jadhav marg sun mill compound sarang building room.no 403 lower parel west');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(1, 'Dog', 'Pet_Category232.png', 'Yes', 'Yes'),
(2, 'Cat', 'Pet_Category1353.png', 'Yes', 'Yes'),
(3, 'Bird', 'Pet_Category4617.png', 'Yes', 'Yes'),
(4, 'Rabbit', 'Pet_Category2526.png', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pet`
--

CREATE TABLE `tbl_pet` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `age` varchar(50) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `featured` enum('Yes','No') DEFAULT 'No',
  `active` enum('Yes','No') DEFAULT 'Yes',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_pet`
--

INSERT INTO `tbl_pet` (`id`, `title`, `gender`, `age`, `image_name`, `category_id`, `featured`, `active`, `created_at`) VALUES
(1, 'Bella', 'Female', '3 years', 'Pet_Category2878.png', 1, 'Yes', 'Yes', '2025-02-12 10:26:21'),
(2, 'Shadow', 'Male', '5 years', 'Pet_Category7004.png', 2, 'Yes', 'Yes', '2025-02-12 10:26:21'),
(3, 'Rocky', 'Male', '5 years', 'Pet_Category3020.png', 1, 'Yes', 'Yes', '2025-02-12 10:26:21'),
(4, 'Pico', 'Male', '4 years', 'Pet_Category652.png', 3, 'Yes', 'Yes', '2025-02-12 10:26:21'),
(5, 'Coco', 'Male', '1.5 years', 'Pet_Category8216.png', 1, 'Yes', 'Yes', '2025-02-12 10:26:21'),
(6, 'Sasha', 'Female', '4 years', 'Pet_Category4949.png', 2, 'Yes', 'Yes', '2025-02-12 10:26:21'),
(7, 'Tweety', 'Female', '6 months', 'Pet_Category7514.png', 3, 'No', 'Yes', '2025-02-12 10:26:21'),
(15, 'Whiskers', 'Male', '2 years', 'Pet_Category5491.png', 2, 'No', 'Yes', '2025-02-12 11:39:44'),
(16, 'Snowball', 'Male', '3 years', 'Pet_Category5647.png', 2, 'Yes', 'Yes', '2025-02-14 10:56:35'),
(17, 'Bruno', 'Male', '10 years', 'Pet_name4373.png', 1, 'Yes', 'Yes', '2025-02-14 13:29:31');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vc`
--

CREATE TABLE `tbl_vc` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pet_type` varchar(50) NOT NULL,
  `address` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_vc`
--

INSERT INTO `tbl_vc` (`id`, `name`, `phone_number`, `email`, `pet_type`, `address`) VALUES
(1, 'MD.ATAULLHA', '01879093418', 'saimsaimsaimsaim7246@gmail.com', 'Dog', 'My Dog is not eating anything..');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `created_at`) VALUES
(5, 'Aditi Acharekar', 'aditiacharekar3@gmail.com', '210924', '2025-02-13 06:23:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_adopt`
--
ALTER TABLE `tbl_adopt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pet`
--
ALTER TABLE `tbl_pet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `tbl_vc`
--
ALTER TABLE `tbl_vc`
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
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_adopt`
--
ALTER TABLE `tbl_adopt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_pet`
--
ALTER TABLE `tbl_pet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_vc`
--
ALTER TABLE `tbl_vc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_pet`
--
ALTER TABLE `tbl_pet`
  ADD CONSTRAINT `tbl_pet_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `tbl_category` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
