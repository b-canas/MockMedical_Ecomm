-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2021 at 01:55 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

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
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `USERID` int(16) NOT NULL COMMENT 'FK USERID from users',
  `PRODUCTID` int(16) NOT NULL COMMENT 'FK PRODUCTID from products',
  `AMOUNT` int(16) NOT NULL COMMENT 'Number of items with the same id ordered - must be truncated everytime called'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`USERID`, `PRODUCTID`, `AMOUNT`) VALUES
(2, 1001, 5),
(2, 1002, 20),
(2, 1003, 40);

-- --------------------------------------------------------

--
-- Table structure for table `orderno`
--

CREATE TABLE `orderno` (
  `ORDERNO` int(16) NOT NULL COMMENT 'Autoincremented - id of order of which "orders" are all derived and grouped by',
  `USERID` int(16) NOT NULL COMMENT 'FK users who initiated the order',
  `TOTALCOST` float NOT NULL COMMENT 'Total cost of the order',
  `ATTIME` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'Time the order was originally made',
  `STATUS` varchar(16) NOT NULL COMMENT 'Status of the order to be updated manually',
  `LASTMOD` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'Last time the order was updated'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderno`
--

INSERT INTO `orderno` (`ORDERNO`, `USERID`, `TOTALCOST`, `ATTIME`, `STATUS`, `LASTMOD`) VALUES
(3, 7, 100, '0000-00-00 00:00:00', 'READY', '2021-05-06 15:29:38'),
(4, 7, 100, '2021-05-03 00:00:00', 'SHIPPED', '2021-05-03 00:00:00'),
(5, 7, 100, '2021-05-03 00:00:00', 'DELIVERED', '2021-05-03 00:00:00'),
(6, 7, 100, '2021-05-03 00:00:00', 'CANCELLED', '2021-05-03 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ORDERNO` int(16) NOT NULL COMMENT 'FK orderno.ORDERNO - this is the order number this/these item(s) are grouped with',
  `USERID` int(16) NOT NULL COMMENT 'FK users.USERID',
  `PRODUCTID` int(16) NOT NULL COMMENT 'FK products.PRODUCTID',
  `AMOUNT` int(16) NOT NULL COMMENT 'Number of items with the same PRODUCTID in this order',
  `ICOST` float NOT NULL COMMENT 'Individual Cost of one single item with this PRODUCTID',
  `TPRICE` float NOT NULL COMMENT 'Total Price of the AMOUNT of items (with the same PRODUCTID) multiplied by ICOST'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Orders are grouped by ORDERNO, prod stacks grouped by pid';

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ORDERNO`, `USERID`, `PRODUCTID`, `AMOUNT`, `ICOST`, `TPRICE`) VALUES
(3, 7, 1003, 2, 20, 40),
(4, 7, 1003, 1, 20, 20),
(5, 7, 1003, 3, 20, 60),
(6, 7, 1003, 2, 20, 40),
(3, 7, 1001, 3, 10, 30),
(3, 7, 1002, 2, 15, 30),
(4, 7, 1001, 5, 10, 50),
(4, 7, 1002, 2, 15, 30),
(5, 7, 1001, 1, 10, 10),
(5, 7, 1002, 2, 15, 30),
(6, 7, 1002, 4, 15, 60);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `PRODUCTID` int(16) NOT NULL,
  `PNAME` varchar(16) NOT NULL,
  `CATEGORY` varchar(16) NOT NULL COMMENT 'Type of Drug',
  `PSTOCK` int(16) NOT NULL,
  `PRICE` float NOT NULL,
  `PIMAGE` varchar(64) DEFAULT NULL COMMENT 'Relative location of image'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`PRODUCTID`, `PNAME`, `CATEGORY`, `PSTOCK`, `PRICE`, `PIMAGE`) VALUES
(1001, 'Vitamin A', 'Child', 100, 10, 'images/bottleA.png'),
(1002, 'Vitamin B', 'Child', 100, 15, 'images/bottleB.png'),
(1003, 'Vitamin C', 'Child', 100, 20, 'images/bottleC.png'),
(1004, 'Vitamin D', 'Child', 100, 25, 'images/bottleD.png'),
(1005, 'Vitamin E', 'Child', 100, 30, 'images/bottleE.png'),
(2001, 'Vitamin F', 'Adult', 100, 10, 'images/bottleF.png'),
(2002, 'Vitamin G', 'Adult', 100, 15, 'images/bottleG.png'),
(2003, 'Vitamin H', 'Adult', 100, 20, 'images/bottleH.png'),
(2004, 'Vitamin I', 'Adult', 100, 25, 'images/bottleI.png'),
(2005, 'Vitamin J', 'Adult', 100, 30, 'images/bottleJ.png'),
(3001, 'Vitamin K', 'Elderly', 100, 10, 'images/bottleK.png'),
(3002, 'Vitamin L', 'Elderly', 100, 15, 'images/bottleL.png'),
(3003, 'Vitamin M', 'Elderly', 100, 20, 'images/bottleM.png'),
(3004, 'Vitamin N', 'Elderly', 100, 25, 'images/bottleN.png'),
(3005, 'Vitamin O', 'Elderly', 100, 30, 'images/bottleO.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `USERID` int(16) NOT NULL COMMENT 'Autoincremented PK that indicates this user across all tables',
  `USERNAME` varchar(16) NOT NULL COMMENT 'Name of user, could be volatile',
  `PASSWORD` varchar(128) NOT NULL COMMENT 'Password of user, must be encrypted?',
  `ACCESS` int(16) NOT NULL COMMENT 'Access level of "user" - -1 means customer, 0 is highest level admin, increase value means lesser access',
  `FNAME` varchar(64) NOT NULL COMMENT 'First name of user',
  `LNAME` varchar(64) NOT NULL COMMENT 'Last name of user',
  `ADDRESS` varchar(256) NOT NULL COMMENT 'Address of User - usually the full address for ease',
  `PHONE` varchar(16) NOT NULL COMMENT 'phone number - string is acceptable because whatever',
  `EMAIL` varchar(128) NOT NULL COMMENT 'email of user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`USERID`, `USERNAME`, `PASSWORD`, `ACCESS`, `FNAME`, `LNAME`, `ADDRESS`, `PHONE`, `EMAIL`) VALUES
(6, 'admin', '$2y$10$LF8EAR6SFewUXqYGdMzqGO/nY7B.ksmi2twrD7/s0t.Itqo9Qgdwu', 0, 'Brian', 'Canas', '123 Normal Ave, Montclair, NJ', '245-124-6437', 'admin@email.com'),
(7, 'testcustomer', '$2y$10$OZ.dXN6vg2BM2U5CzEQJGOqjbjm9RyHGQMv6DflVB/RnfNnKlGxC6', -1, 'Mary', 'Mac', '777 Lucky Drive, Montclair, NJ', '713-356-8594', 'marymac@email.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orderno`
--
ALTER TABLE `orderno`
  ADD PRIMARY KEY (`ORDERNO`),
  ADD KEY `RelOrdernoToUserid` (`USERID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD KEY `RelOrdersToOrderno` (`ORDERNO`),
  ADD KEY `RelOrdersToProductid` (`PRODUCTID`),
  ADD KEY `RelOrdersToUserid` (`USERID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`PRODUCTID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`USERID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orderno`
--
ALTER TABLE `orderno`
  MODIFY `ORDERNO` int(16) NOT NULL AUTO_INCREMENT COMMENT 'Autoincremented - id of order of which "orders" are all derived and grouped by', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `USERID` int(16) NOT NULL AUTO_INCREMENT COMMENT 'Autoincremented PK that indicates this user across all tables', AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orderno`
--
ALTER TABLE `orderno`
  ADD CONSTRAINT `RelOrdernoToUserid` FOREIGN KEY (`USERID`) REFERENCES `users` (`USERID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `RelOrdersToOrderno` FOREIGN KEY (`ORDERNO`) REFERENCES `orderno` (`ORDERNO`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `RelOrdersToProductid` FOREIGN KEY (`PRODUCTID`) REFERENCES `products` (`PRODUCTID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `RelOrdersToUserid` FOREIGN KEY (`USERID`) REFERENCES `users` (`USERID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
