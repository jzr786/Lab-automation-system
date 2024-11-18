-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2024 at 04:08 PM
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
-- Database: `user_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `book_request`
--

CREATE TABLE `book_request` (
  `sno` int(11) NOT NULL,
  `date` date NOT NULL,
  `batch_code` varchar(100) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `test` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_request`
--

INSERT INTO `book_request` (`sno`, `date`, `batch_code`, `product_name`, `test`) VALUES
(29, '1970-12-08', 'Est cupiditate quo d', 'Raven Quinn', 'Chemical Test'),
(31, '1973-12-14', 'Et aut dolores dolor', 'Halee Webb', 'Safety Test'),
(32, '1972-10-17', 'Pariatur Quia eaque', 'Kaden Castaneda', 'Thermal Test'),
(34, '1978-01-07', 'Cumque est quisquam ', 'Farrah Gallegos', 'Electrical Test'),
(36, '1983-05-04', 'Quasi harum doloremq', 'Chester Baker', 'Thermal Test');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `sno` int(11) NOT NULL,
  `date` varchar(50) NOT NULL,
  `batch_code` varchar(50) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `test` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`sno`, `date`, `batch_code`, `product_name`, `test`, `status`) VALUES
(12, '2000-06-13', 'Magna', 'Quon', 'Electrical Test', 'Approve'),
(13, '1999-02-27', 'Nihil eius aspernatu', 'Kylee Gregory', 'Mechanical Test', 'Reject'),
(14, '1993-02-28', 'Nesciunt qui quo vo', 'Thane Koch', 'Chemical Test', 'Approve'),
(16, '1975-04-04', 'Quo incididunt dolor', 'Sage Richards', 'Safety Test', 'Approve'),
(17, '1969-11-13', 'Voluptatum ullamco p 123', 'Elton Roth 123', 'Thermal Test', 'Approve');

-- --------------------------------------------------------

--
-- Table structure for table `user_form`
--

CREATE TABLE `user_form` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(225) NOT NULL,
  `user_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_form`
--

INSERT INTO `user_form` (`id`, `username`, `email`, `password`, `user_type`) VALUES
(35, 'juzer', 'admin@gmail.com', '$2y$10$R0MGe7zSVR9bB8HWQmuIjedxjh5bV/lLkQQkyx56LfTCU5s0RE9n6', 'admin'),
(40, 'ali', 'user@gmail.com', '$2y$10$nJt4yvety.LO3ndoc3jIeOwxKw2v2A4Pjo/0ocVMcBiNkZH.8.kYK', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book_request`
--
ALTER TABLE `book_request`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `user_form`
--
ALTER TABLE `user_form`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book_request`
--
ALTER TABLE `book_request`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_form`
--
ALTER TABLE `user_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
