-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2025 at 03:35 AM
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
-- Database: `carrental`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(5) NOT NULL,
  `cust_id` int(5) NOT NULL,
  `car_id` int(5) NOT NULL,
  `package_id` int(5) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `total_amount` float(5,2) NOT NULL,
  `booking_status` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `car_id` int(5) NOT NULL,
  `car_name` varchar(200) NOT NULL,
  `price_per_day` float(5,2) NOT NULL,
  `features` varchar(150) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(5) NOT NULL,
  `booking_id` int(5) NOT NULL,
  `payment_date` date NOT NULL,
  `amount_paid` float(5,2) NOT NULL,
  `payment_proof` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rental_packages`
--

CREATE TABLE `rental_packages` (
  `package_id` int(5) NOT NULL,
  `package_name` varchar(150) NOT NULL,
  `desc` varchar(200) NOT NULL,
  `image` varchar(50) NOT NULL,
  `price` float(5,2) NOT NULL,
  `duration` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `cust_id` int(5) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(150) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `user_type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`cust_id`, `name`, `email`, `pass`, `phone_number`, `user_type`) VALUES
(1, 'Abu', 'abu@mail', 'abu', '123', 'user'),
(2, 'admin', 'admin@mail', 'admin', '1223', 'admin'),
(3, 'Ali', 'ali@mail', '123', '2233', 'user'),
(4, 'Aliy', 'aliy@mail', 'aliy', '3434', 'user'),
(5, 'ala', 'ala@mail', '1122', '3131', 'user'),
(6, 'ada', 'ada@mail', '234', '5656', 'user'),
(7, 'aku', 'aku@mail', '7788', '8989', 'user'),
(8, 'lgi', 'lgi@mail', '4334', '9090', 'user'),
(9, 'apa', 'apa@mail', '765', '7878', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `rental_packages`
--
ALTER TABLE `rental_packages`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`cust_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rental_packages`
--
ALTER TABLE `rental_packages`
  MODIFY `package_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `cust_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
