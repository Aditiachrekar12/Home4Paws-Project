-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2022 at 11:16 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

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
(12, 'SPJ', 'spj45', 'e10adc3949ba59abbe56e057f20f883e'),
(15, 'HUnner ', '49', 'e10adc3949ba59abbe56e057f20f883e'),
(20, 'new ', '9669', 'd41d8cd98f00b204e9800998ecf8427e'),
(27, 'Admin', 'Admin', '0cc175b9c0f1b6a831c399e269772661'),
(28, 'z', 'z', 'fbade9e36a3f36d3d676c1b808451dd7'),
(30, 'y', 'y', '415290769594460e2e485922904f345d');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_adopt`
--

CREATE TABLE `tbl_adopt` (
  `id` int(10) UNSIGNED NOT NULL,
  `pet` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `adoption_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `adoptee_name` varchar(100) NOT NULL,
  `adoptee_contact` varchar(20) NOT NULL,
  `adoptee_email` varchar(150) NOT NULL,
  `adoptee_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(18, 'Dog', 'Pet_Category870.png', 'Yes', 'Yes'),
(19, 'Fox', 'Pet_Category8170.png', 'Yes', 'No'),
(20, 'Cat2', 'Pet_Category6576.png', 'Yes', 'No'),
(21, 'cat3', 'Pet_Category5296.jpg', 'Yes', 'Yes'),
(22, 'Goat', 'Pet_Category8862.png', 'Yes', 'Yes'),
(23, 'Dog Sad', 'Pet_Category2273.png', 'No', 'Yes'),
(24, 'Doggo', 'Pet_Category8627.png', 'Yes', 'Yes'),
(25, 'Rabbit', 'Pet_Category1853.jpg', 'Yes', 'Yes');

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
(1, 'Dogesh', 'Wonderful Talkative Dog', 'Airport Road', 'Pet_Category3341.png', 18, 'Yes', 'Yes'),
(3, 'Meu', 'Catto', 'Akhalia', 'Pet_Category453.png', 20, 'Yes', 'No'),
(7, 'Meu2', 'Catto', 'Mirpur', '', 21, 'No', 'Yes'),
(11, 'Meu Meu', 'Cat', 'Amborkhana', 'Pet_name54225.png', 20, 'No', 'Yes');

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
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_adopt`
--
ALTER TABLE `tbl_adopt`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_pet`
--
ALTER TABLE `tbl_pet`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
