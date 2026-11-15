-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2026 at 10:06 PM
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
-- Database: `zimcraft_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `markets`
--

CREATE TABLE `markets` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `city` varchar(80) NOT NULL,
  `craft_type` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `location` varchar(180) NOT NULL,
  `opening_hours` varchar(120) NOT NULL,
  `contact` varchar(80) DEFAULT 'Contact details to be confirmed',
  `icon` varchar(20) DEFAULT '?',
  `whatsapp` varchar(20) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `markets`
--
ALTER TABLE `markets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `markets`
--
ALTER TABLE `markets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
