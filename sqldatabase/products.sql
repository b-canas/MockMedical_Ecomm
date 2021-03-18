-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2021 at 08:51 PM
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
(1, 'Vitamin A', 'Child', 100, 10),
(2, 'Vitamin B', 'Child', 100, 15),
(3, 'Vitamin C', 'Child', 100, 20),
(4, 'Vitamin D', 'Child', 100, 25),
(5, 'Vitamin E', 'Child', 100, 30),
(6, 'Vitamin F', 'Adult', 100, 10),
(7, 'Vitamin G', 'Adult', 100, 15),
(8, 'Vitamin H', 'Adult', 100, 20),
(9, 'Vitamin I', 'Adult', 100, 25),
(10, 'Vitamin J', 'Adult', 100, 30),
(11, 'Vitamin K', 'Elderly', 100, 10),
(12, 'Vitamin L', 'Elderly', 100, 15),
(13, 'Vitamin M', 'Elderly', 100, 20),
(14, 'Vitamin N', 'Elderly', 100, 25),
(15, 'Vitamin O', 'Elderly', 100, 30);

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
  MODIFY `PRODUCTID` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
