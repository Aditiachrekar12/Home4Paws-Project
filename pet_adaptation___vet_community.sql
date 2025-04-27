-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 12, 2022 at 02:42 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pet adaptation & vet community`
--

-- --------------------------------------------------------

--
-- Table structure for table `msgs`
--

CREATE TABLE `msgs` (
  `sno` int(11) NOT NULL,
  `msg` text NOT NULL,
  `room` text NOT NULL,
  `ip` text NOT NULL,
  `stime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `msgs`
--

INSERT INTO `msgs` (`sno`, `msg`, `room`, `ip`, `stime`) VALUES
(19, 'Hi', '01879093418', '::1', '2022-08-12 18:22:59'),
(20, 'Ok, Please Send More Details Info', '01879093418', '::1', '2022-08-12 18:23:44'),
(21, 'ok', '01879093418', '::1', '2022-08-12 18:25:30'),
(22, 'Thnaks', '01879093418', '::1', '2022-08-12 18:25:40');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(3, 'Md Ataullha', 'MAS', 'd240cb4a3e3d2ed5250ac2e1480422f0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_adopt`
--

CREATE TABLE `tbl_adopt` (
  `id` int(10) UNSIGNED NOT NULL,
  `pet` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `adoption_date` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `adoptee_name` varchar(100) NOT NULL,
  `adoptee_contact` varchar(20) NOT NULL,
  `adoptee_email` varchar(150) NOT NULL,
  `adoptee_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_adopt`
--

INSERT INTO `tbl_adopt` (`id`, `pet`, `location`, `adoption_date`, `status`, `adoptee_name`, `adoptee_contact`, `adoptee_email`, `adoptee_address`) VALUES
(49, 'Bulldog', 'USA', '2022-08-12', 'Done', 'MD.ATAULLHA', '01879093418', 'saimsaimsaimsaim7246@gmail.com', 'House No -107,Road No-6, Lake-city,Sylhet'),
(50, 'White Cat', 'Khulna', '2022-08-12', 'Cancelled', 'MD.ATAULLHA', '01904192708', 'atasaim081@gmail.com', 'Paradogar,Konapara,Demra,Dhaka;');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(10, 'Dog', 'Pet_Category9344.png', 'Yes', 'Yes'),
(11, 'Cat', 'Pet_Category8231.png', 'Yes', 'Yes'),
(12, 'Bird', 'Pet_Category1636.png', 'Yes', 'Yes'),
(13, 'Fish', 'Pet_Category5310.png', 'No', 'Yes'),
(14, 'Turtle', 'Pet_Category8332.png', 'No', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pet`
--

CREATE TABLE `tbl_pet` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `location` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pet`
--

INSERT INTO `tbl_pet` (`id`, `title`, `description`, `location`, `image_name`, `category_id`, `featured`, `active`) VALUES
(10, 'The Barking Dog', 'Barking Dog', 'Dhaka', 'Pet_name41903.png', 10, 'Yes', 'Yes'),
(11, 'Thomas Cat', 'Remember Tom Cat?', 'Hollywood', 'Pet_name71408.png', 11, 'Yes', 'Yes'),
(12, 'Bulldog', 'Crazy Dog', 'USA', 'Pet_name66189.png', 10, 'Yes', 'Yes'),
(13, 'Tota Mia', 'Typical Bengali Parrot', 'Sylhet', 'Pet_name55596.png', 12, 'Yes', 'Yes'),
(14, 'Cute Puppy ', 'cute but little', 'Dhaka', 'Pet_name28301.png', 10, 'Yes', 'Yes'),
(15, 'White Cat', 'all white', 'Khulna', 'Pet_name81208.png', 11, 'Yes', 'Yes'),
(16, 'Birdy', 'A Bird', 'Sylhet', 'Pet_name22981.png', 12, 'No', 'No'),
(17, 'Doggy', 'Typical Bengali Breed Dog', 'Dhaka', 'Pet_name60631.png', 10, 'No', 'Yes');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_vc`
--

INSERT INTO `tbl_vc` (`id`, `name`, `phone_number`, `email`, `pet_type`, `address`) VALUES
(15, 'MD.ATAULLHA', '01879093418', 'saimsaimsaimsaim7246@gmail.com', 'Dog', 'My Dog is note eating anything..');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `msgs`
--
ALTER TABLE `msgs`
  ADD PRIMARY KEY (`sno`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_vc`
--
ALTER TABLE `tbl_vc`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `msgs`
--
ALTER TABLE `msgs`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_adopt`
--
ALTER TABLE `tbl_adopt`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_pet`
--
ALTER TABLE `tbl_pet`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_vc`
--
ALTER TABLE `tbl_vc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
