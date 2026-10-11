-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2026 at 07:36 PM
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
-- Database: `ta2_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `full_name`, `email`, `phone`, `created_at`) VALUES
(1, 'Maria Ella Tongson', 'ellagllrm@gmail.com', '09189347865', '2026-09-24 08:49:01'),
(2, 'Ivan Guillermo', 'ivangllrm27@gmail.com', '09217039488', '2026-09-24 16:08:12'),
(3, 'Gwen Morales', 'chippyyy@gmail.com', '09365724905', '2026-09-24 16:08:12'),
(4, 'Lanz Sacramento', 'lanz_sacramento@yahoo.com', '09563605827', '2026-09-24 16:08:12'),
(5, 'Bill Mamorno', 'mamornobill@yahoo.com', '09213649625', '2026-09-24 16:08:12'),
(8, 'Joseph Calleja', 'josephcalleja@gmail.com', '', '2026-10-11 15:34:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `full_name`, `created_at`, `avatar`) VALUES
(1, 'chippychipp', 'Alex Gem Morales', '2026-09-24 18:39:24', '3bbea0fed5d17107b3fb4a21f09e4cc7.jpg'),
(2, 'lbgonzales', 'Lei Vincent Gonzales', '2026-09-24 16:11:57', '3164af113ca7964ceb6a122f8c9e35c5.jpg'),
(3, 'sdcaayon', 'Shem James Caayon', '2026-09-24 16:11:57', '3b5c5b37a03bd3856797537c8b2eb94d.jpg'),
(4, 'tccachapero', 'Tristan Josh Cachapero', '2026-09-24 16:11:57', '77b4d1558edc248de05901e25600c791.jpg'),
(5, 'pdrivera', 'Paolo Rivera', '2026-09-24 16:11:57', 'd4d172327f19fab76e58e55144b46b3a.jpg'),
(6, 'josephcalleja', 'Joseph Calleja', '2026-10-11 16:04:46', 'e477fe5fab9dd834c43b3b6d5218662b.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
