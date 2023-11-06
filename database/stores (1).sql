-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 06, 2023 at 11:45 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stores`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
CREATE TABLE IF NOT EXISTS `brands` (
  `brand_id` int NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(255) NOT NULL,
  `brand_active` int NOT NULL,
  `brand_status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`brand_id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`, `brand_active`, `brand_status`) VALUES
(1, 'brandname', 1, 0),
(2, 'brandname', 1, 0),
(3, 'brandname', 1, 0),
(10, 'Chips', 1, 0),
(11, 'Chips', 1, 0),
(12, 'wdqwd', 1, 0),
(13, 'Chips', 1, 0),
(14, 'test', 1, 0),
(15, 'Chips2', 1, 0),
(16, 'Chips', 1, 0),
(17, 'Chips', 1, 0),
(18, 'Chipskaka', 1, 0),
(19, 'Chips12', 1, 0),
(20, 'Chips124', 1, 0),
(21, 'Chips1245', 1, 0),
(22, 'Chips3', 1, 0),
(23, 'ChipsChor', 1, 0),
(24, 'Chips', 1, 0),
(25, 'Chipskaka', 1, 0),
(26, 'Chipscharkaka', 1, 0),
(27, 'Chips', 1, 0),
(28, 'Chips3', 1, 0),
(29, 'Chips1245', 1, 0),
(30, 'Chips', 1, 0),
(31, 'Chipskhan', 0, 0),
(32, 'Chipsmahmudur', 0, 0),
(33, 'hp-2', 1, 1),
(34, 'Chips-2', 1, 0),
(35, 'hp-4', 1, 0),
(36, 'Chips', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `categories_id` int NOT NULL AUTO_INCREMENT,
  `categories_name` varchar(255) NOT NULL,
  `categories_active` int NOT NULL,
  `categories_status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`categories_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categories_id`, `categories_name`, `categories_active`, `categories_status`) VALUES
(1, 'hp-3', 1, 0),
(2, 'hp-4', 1, 0),
(3, 'hp-45', 1, 1),
(4, 'hp-3-5', 0, 0),
(5, 'phpBrand', 1, 1),
(6, 'phpBrand', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `order_date` varchar(255) DEFAULT NULL,
  `deliveryDate` varchar(255) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_contact` varchar(255) NOT NULL,
  `sub_total` varchar(255) NOT NULL,
  `vat` varchar(255) NOT NULL,
  `total_amount` varchar(50) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `grand_total` varchar(255) NOT NULL,
  `paid` varchar(255) NOT NULL,
  `due` varchar(255) NOT NULL,
  `payment_type` int NOT NULL,
  `payment_status` int NOT NULL DEFAULT '1',
  `payment_place` varchar(255) NOT NULL,
  `gstn` varchar(255) NOT NULL,
  `order_status` int NOT NULL DEFAULT '1',
  `user_id` int NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_date`, `deliveryDate`, `client_name`, `client_contact`, `sub_total`, `vat`, `total_amount`, `discount`, `grand_total`, `paid`, `due`, `payment_type`, `payment_status`, `payment_place`, `gstn`, `order_status`, `user_id`) VALUES
(1, '2023-11-03', '1970-01-01  ', 'mahmudur', '01810300382', '1900.00', '142.50', '2042.50', '10', '2032.50', '2032.5', '0', 2, 1, '1', '77.70', 1, 0),
(2, '2023-11-03', '2023-11-07', 'hridoy', '01810300382', '1036.00', '77.70', '1113.70', '13', '1100.70', '1100.7', '0', 2, 1, '2', '77.70', 1, 0),
(3, '2023-11-03', '2023-11-07', 'hridoy', '01810300382', '1036.00', '77.70', '1113.70', '13', '1100.70', '200', '900.70', 2, 2, '2', '77.70', 1, 0),
(4, '2023-11-03', '2023-11-07', 'hridoy', '01810300382', '1036.00', '77.70', '1113.70', '13', '1100.70', '200', '900.70', 2, 2, '2', '77.70', 1, 0),
(5, '2023-11-03', '1970-01-01  ', 'hridoy', '01810300382', '1036.00', '77.70', '1113.70', '13', '1100.70', '200', '900.70', 2, 2, '2', '77.70', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

DROP TABLE IF EXISTS `order_item`;
CREATE TABLE IF NOT EXISTS `order_item` (
  `order_item_id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `squantity` int NOT NULL,
  `rate` varchar(100) NOT NULL,
  `total` varchar(255) NOT NULL,
  `order_item_status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`order_item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`order_item_id`, `order_id`, `product_id`, `quantity`, `squantity`, `rate`, `total`, `order_item_status`) VALUES
(1, 0, 14, '1', 0, '86', '86.00', 1),
(2, 0, 6, '1', 0, '950', '950.00', 1),
(3, 0, 6, '1', 0, '950', '950.00', 1),
(4, 0, 14, '1', 0, '86', '86.00', 1),
(5, 0, 6, '1', 0, '950', '950.00', 1),
(6, 0, 6, '1', 0, '950', '950.00', 1),
(27, 1, 6, '1', 1, '950', '950.00', 1),
(26, 1, 6, '1', 1, '950', '950.00', 1),
(28, 2, 6, '1', 0, '950', '950.00', 1),
(29, 2, 14, '1', 0, '86', '86.00', 1),
(30, 3, 6, '1', 0, '950', '950.00', 1),
(31, 3, 14, '1', 0, '86', '86.00', 1),
(32, 4, 6, '1', 0, '950', '950.00', 1),
(33, 4, 14, '1', 0, '86', '86.00', 1),
(47, 5, 14, '1', 1, '86', '86.00', 0),
(36, 6, 6, '1', 1, '86', '86.00', 2),
(37, 7, 6, '1', 1, '86', '86.00', 2),
(38, 8, 6, '1', 1, '950', '950.00', 2),
(39, 8, 14, '1', 1, '86', '86.00', 2),
(40, 9, 6, '1', 1, '950', '950.00', 2),
(41, 9, 14, '1', 1, '86', '86.00', 2),
(42, 10, 6, '1', 1, '950', '950.00', 2),
(43, 11, 6, '1', 1, '950', '950.00', 2),
(46, 5, 6, '1', 1, '950', '950.00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `attribute` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `product_image` varchar(255) NOT NULL,
  `brand_id` int NOT NULL,
  `categories_id` int NOT NULL,
  `quantity` int DEFAULT NULL,
  `squantity` int DEFAULT NULL,
  `rate` varchar(100) NOT NULL,
  `mrp` varchar(50) DEFAULT NULL,
  `active` int NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `attribute`, `product_image`, `brand_id`, `categories_id`, `quantity`, `squantity`, `rate`, `mrp`, `active`, `status`, `create_at`) VALUES
(6, 'AirpodPro', 'black', '../assets/img/stock/18184446406537e1dc340e5.png', 33, 3, 96, 1, '950', '1700', 1, 1, '2023-10-18 17:25:47'),
(14, 'TWS', 'white', '../assets/img/stock/185674564065394749af5dd.png', 33, 3, 98, 1, '86', '1200', 1, 1, '2023-10-25 16:50:17'),
(13, 'AirpodsPro', 'Green', '../assets/img/stock/13835325106537f2d5bd8e9.png', 33, 3, 100, 1, '950', '1200', 1, 1, '2023-10-24 16:37:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(255) NOT NULL,
  `resettoken` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `resettokenexp` date DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `resettoken`, `resettokenexp`) VALUES
(7, 'admin5', 'admin@77889', 'mahmudur397@gmail.com', 'NULL', NULL),
(3, 'admin', 'admin@2323', 'admin420@gmail.com', 'NULL', NULL),
(51, 'admin2', 'f8450a97cc7e38e6d109425c87b41634', 'mahmudur397@gmail.com', NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
