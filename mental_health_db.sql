-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2023 at 06:45 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mental_health_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `email`, `phone`) VALUES
(1, 'Mahi', 'mahi@yahoo.com', '01755555554'),
(2, 'h', 'h', '01711112222'),
(3, 'h', 'h', '01711112222'),
(4, 'h', 'h', '01711112222'),
(5, 'h', 'h', '01711112222'),
(6, 'h', 'h', '01711112222'),
(7, 'h', 'h', '01711112222'),
(8, 'h', 'h', '01711112222'),
(9, 'h', 'h', '01711112222'),
(10, 'h', 'h', '01711112222'),
(11, 'h', 'h', '01711112222'),
(12, 'h', 'h', '01711112222'),
(13, '', '', ''),
(14, '', '', ''),
(15, '', '', ''),
(16, '', '', ''),
(17, '', '', ''),
(18, '', '', ''),
(19, '', '', ''),
(20, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `counselors`
--

CREATE TABLE `counselors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `counselors`
--

INSERT INTO `counselors` (`id`, `name`, `email`, `phone`) VALUES
(1, 'Dr. Hasan Mahmud', 'mah@gmail.com', '01711112222'),
(2, 'Dr. Uccahsh Barua', 'ucchash@gmail.com', '01711142242'),
(3, 'Dr. Naimur Rahman', 'naimur@gmail.com', '01711242242'),
(4, 'Dr. Shakib', 'shakibalhasan@gmail.com', '01711342244');

-- --------------------------------------------------------

--
-- Table structure for table `counselor_ratings`
--

CREATE TABLE `counselor_ratings` (
  `id` int(11) NOT NULL,
  `counselor_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `feedback` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `counselor_ratings`
--

INSERT INTO `counselor_ratings` (`id`, `counselor_id`, `client_id`, `rating`, `feedback`, `timestamp`) VALUES
(1, 1, 2, 5, 'Good', '2023-11-19 03:10:51'),
(2, 3, 2, 5, 'Good', '2023-11-19 03:11:58'),
(3, 1, 2, 4, 'Good', '2023-11-19 03:13:16'),
(4, 2, 1, 4, 'Good', '2023-11-19 03:18:14'),
(5, 1, 4, 5, 'Perfect', '2023-11-19 03:18:37'),
(6, 4, 4, 5, 'Good', '2023-11-19 03:18:50'),
(7, 3, 1, 5, 'bHALO', '2023-11-19 07:19:58'),
(8, 1, 9, 5, 'He is good as a Human Being', '2023-11-21 05:42:21');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `username`, `password`, `name`, `email`, `phone`) VALUES
(1, 'mahi', '$2y$10$KYx0oGUG1crM40VdZjnqYO7mIvNlrIpdsYy4ywa62B5JXzeaCvW9a', 'Mahi', 'mahi@yahoo.com', '01755555554'),
(2, 'fahim', '$2y$10$ff/p6slnwS4T1M47IHByk.b.Q1ndb4MAogLP3gUI/yekKaaAL2jMa', 'Fahim Mahmud Bhuiyan', 'fahim@gmail.com', '01725555555'),
(4, 'durjoy', '$2y$10$UN5ZsZrFA0mXI.0qeE.hC.qrs46.dkMIqA44Pr8BeE8q8B4D/zV0.', 'durjoy', 'durjoy@gmail.com', '01755555532'),
(8, 'mahi1', '$2y$10$ODCNsBnZKPt/D7wAXXYAyuCepmdXUoNPv.pV.tVYWJV2a5wS.g/9y', 'Fahim Mahmud Bhuiyan', 'fahim.mahiii@yahoo.com', '01755555421'),
(9, 'mahiiiii', '$2y$10$8YO/WMHhnzhV9UUQvW2htuB2FJur1pXrypqZeODX2gCvyRTiXEOJq', 'Fahim Mahmud Mahi', 'mahiiiii@gmail.com', '01712345778');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `counselor_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `session_date` date DEFAULT NULL,
  `session_notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `counselor_id`, `client_id`, `session_date`, `session_notes`) VALUES
(1, 1, 1, '2023-11-11', 'Mental Health Issue'),
(11, 3, 1, '2023-11-11', 'Mental Health Issue'),
(12, 1, 1, '2023-11-16', 'Mental Health Issue'),
(14, 2, 4, '2023-11-13', 'Duniya Shesh'),
(16, 1, 1, '2023-11-24', 'Urgent'),
(17, 4, 1, '2023-11-25', 'Urgent');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `counselors`
--
ALTER TABLE `counselors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `counselor_ratings`
--
ALTER TABLE `counselor_ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `counselor_id` (`counselor_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `counselor_id` (`counselor_id`),
  ADD KEY `client_id` (`client_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `counselors`
--
ALTER TABLE `counselors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `counselor_ratings`
--
ALTER TABLE `counselor_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `counselor_ratings`
--
ALTER TABLE `counselor_ratings`
  ADD CONSTRAINT `counselor_ratings_ibfk_1` FOREIGN KEY (`counselor_id`) REFERENCES `counselors` (`id`),
  ADD CONSTRAINT `counselor_ratings_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `patients` (`id`);

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`counselor_id`) REFERENCES `counselors` (`id`),
  ADD CONSTRAINT `sessions_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
