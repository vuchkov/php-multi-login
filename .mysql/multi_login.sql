-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 16, 2021 at 10:02 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `multi_login`
--

-- --------------------------------------------------------

--
-- Table structure for table `healt_data`
--

CREATE TABLE `healt_data` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `heartrate` int(3) NOT NULL,
  `bloodo2` int(3) NOT NULL,
  `boodpressure` int(3) NOT NULL,
  `weight` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `healt_data`
--

INSERT INTO `healt_data` (`id`, `user_id`, `heartrate`, `bloodo2`, `boodpressure`, `weight`) VALUES
(1, 2, 55, 33, 156, 70),
(2, 1, 22, 0, 0, 0),
(3, 3, 99, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `user_type` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `user_type`, `password`) VALUES
(1, 'tatyana', 'Mileva', 'tatyana', 'tmilev200@caledonian.ac.uk', 'admin', '81dc9bdb52d04dc20036dbd8313ed055'),
(2, 'ivan', 'Mileva', 'ivan', 'tmilev200@caledonian.ac.uk3', 'user', '81dc9bdb52d04dc20036dbd8313ed055'),
(3, 'maria', 'Mileva', 'maria', 'tmilev200@caledonian.ac.uk6', 'user', '81dc9bdb52d04dc20036dbd8313ed055'),
(5, 'new', 'new', 'new', 'new@new.com', 'user', '81dc9bdb52d04dc20036dbd8313ed055');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `healt_data`
--
ALTER TABLE `healt_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `healt_data_ibfk_1` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `healt_data`
--
ALTER TABLE `healt_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `healt_data`
--
ALTER TABLE `healt_data`
  ADD CONSTRAINT `healt_data_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
