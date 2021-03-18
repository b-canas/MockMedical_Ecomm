-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2021 at 08:33 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `se2_medicine`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `PRODUCTID` int(16) NOT NULL,
  `PNAME` varchar(16) NOT NULL,
  `CATEGORY` varchar(16) NOT NULL COMMENT 'Type of Drug',
  `PSTOCK` int(16) NOT NULL,
  `PRICE` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`PRODUCTID`, `PNAME`, `CATEGORY`, `PSTOCK`, `PRICE`) VALUES
(1, 'Vitamin A', '0', 100, 10),
(2, 'Vitamin B', '0', 100, 15),
(3, 'Vitamin C', '0', 100, 20),
(4, 'Vitamin D', '0', 100, 25),
(5, 'Vitamin E', '0', 100, 30),
(6, 'Vitamin F', '1', 100, 10),
(7, 'Vitamin G', '1', 100, 15),
(8, 'Vitamin H', '1', 100, 20),
(9, 'Vitamin I', '1', 100, 25),
(10, 'Vitamin J', '1', 100, 30),
(11, 'Vitamin K', '2', 100, 10),
(12, 'Vitamin L', '2', 100, 15),
(13, 'Vitamin M', '2', 100, 20),
(14, 'Vitamin N', '2', 100, 25),
(15, 'Vitamin O', '2', 100, 30),
(16, 'Vitamin A', '0', 100, 10),
(17, 'Vitamin B', '0', 100, 15),
(18, 'Vitamin C', '0', 100, 20),
(19, 'Vitamin D', '0', 100, 25),
(20, 'Vitamin E', '0', 100, 30),
(21, 'Vitamin F', '1', 100, 10),
(22, 'Vitamin G', '1', 100, 15),
(23, 'Vitamin H', '1', 100, 20),
(24, 'Vitamin I', '1', 100, 25),
(25, 'Vitamin J', '1', 100, 30),
(26, 'Vitamin K', '2', 100, 10),
(27, 'Vitamin L', '2', 100, 15),
(28, 'Vitamin M', '2', 100, 20),
(29, 'Vitamin N', '2', 100, 25),
(30, 'Vitamin O', '2', 100, 30);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`PRODUCTID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `PRODUCTID` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
