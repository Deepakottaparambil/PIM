-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2022 at 12:35 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pim`
--

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `name`) VALUES
(1, 'Size'),
(2, 'Weight'),
(3, 'Colour');

-- --------------------------------------------------------

--
-- Table structure for table `attributes_values`
--

CREATE TABLE `attributes_values` (
  `value_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attributes_values`
--

INSERT INTO `attributes_values` (`value_id`, `attribute_id`, `value_name`) VALUES
(1, 1, 'S'),
(2, 1, 'M'),
(3, 1, 'L'),
(4, 1, 'XL'),
(5, 3, 'Red'),
(6, 3, 'Blue'),
(7, 2, '500'),
(8, 2, '1');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `description` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `description`, `created`, `modified`) VALUES
(1, 'President', 'President', '2022-03-12 11:57:23', '2022-03-12 10:58:14'),
(2, 'Lactel', 'Lactel', '2022-03-12 11:57:23', '2022-03-12 10:58:14'),
(3, 'Nike', 'Nike', '2022-03-12 11:58:23', '2022-03-12 10:59:04'),
(4, 'Adidas', 'Adidas', '2022-03-12 11:58:23', '2022-03-12 10:59:04');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created`, `modified`) VALUES
(1, 'Food', 'Milk, Vegetables', '2022-03-12 11:35:04', '2022-03-12 10:38:15'),
(2, 'Clothes', 'Clothes', '2022-03-12 11:35:04', '2022-03-12 10:38:15');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `category_id`, `brand_id`, `created`, `modified`) VALUES
(1, 'Cheese', 'Cheese', '12', 1, 1, '2022-03-12 11:38:25', '2022-03-12 10:40:15'),
(2, 'Milk', 'Milk', '12', 1, 2, '2022-03-12 11:38:25', '2022-03-12 10:40:15'),
(3, 'Tshirt', 'Tshirt', '15', 2, 3, '2022-03-12 11:40:36', '2022-03-12 10:41:25'),
(4, 'Pant', 'Track pants', '18', 2, 3, '2022-03-12 11:40:36', '2022-03-12 10:41:25'),
(6, 'Mango Juices', 'plupy mango juicce.', '255', 1, 1, '2022-03-12 23:19:45', '2022-03-12 22:19:45'),
(7, 'Water', 'Aqua Mineral Water.', '2', 2, 3, '2022-03-14 12:09:53', '2022-03-14 11:09:53'),
(11, 'Mutligrain bread', 'Mutligrain bread.', '2', 1, 1, '2022-03-14 12:30:40', '2022-03-14 11:30:40'),
(12, 'Candum shower gel', 'Candum shower gel.', '25', 2, 3, '2022-03-14 12:49:23', '2022-03-14 11:49:23'),
(14, 'Orange Juices', 'plupy Orange juicce.', '25', 1, 1, '2022-03-14 22:16:11', '2022-03-14 21:16:11'),
(15, 'Olive Oil', 'Olive Oil', '12', 1, 2, '2022-03-14 23:41:50', '2022-03-14 22:41:50'),
(16, 'Olive Oil', 'Olive Oil', '12', 1, 2, '2022-03-14 23:45:09', '2022-03-14 22:45:09'),
(17, 'Sunflower Oil', 'SunFlower Oil', '12', 1, 2, '2022-03-15 00:23:27', '2022-03-14 23:23:27'),
(18, 'Sunflower Oil', 'SunFlower Oil', '12', 1, 2, '2022-03-15 00:32:42', '2022-03-14 23:32:42');

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

CREATE TABLE `product_attributes` (
  `product_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `created`, `modified`) VALUES
(1, 'Casino', 'Casino', '2022-03-14 19:34:40', '2022-03-14 18:35:23'),
(2, 'Frankprix', 'Frankprix', '2022-03-14 19:34:40', '2022-03-14 18:35:23');

-- --------------------------------------------------------

--
-- Table structure for table `user_products`
--

CREATE TABLE `user_products` (
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_products`
--

INSERT INTO `user_products` (`user_id`, `product_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 5),
(2, 3),
(2, 5),
(1, 3),
(1, 5),
(1, 3),
(1, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attributes_values`
--
ALTER TABLE `attributes_values`
  ADD PRIMARY KEY (`value_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `attributes_values`
--
ALTER TABLE `attributes_values`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
