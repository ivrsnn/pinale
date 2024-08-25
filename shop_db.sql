-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2024 at 08:14 PM
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
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(13, 14, 'shaikh anas', 'shaikh@gmail.com', '0987654321', 'hi, how are you?');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(29, 16, 'Iverson Castro', '09693405958', 'iversoncastro0115@gmail.com', 'cash on delivery', 'CALABARZON , Cavite , Maragondon , Ciudad nuevo Sabang phase 1A Blk.6 Lot.24 Durian St. , Philippines - 4110', ' | flower 2 (1) ', 99, '2024-08-26 00:51:16', 'completed'),
(30, 16, 'Iverson Castro', '09693405958', 'iversoncastro0115@gmail.com', 'cash on delivery', 'CALABARZON , Batangas , Malvar , Ciudad nuevo Sabang phase 1A Blk.6 Lot.24 Durian St. , Philippines - 4110', ' | flower 2 (100) ', 9900, '2024-08-26 01:06:47', 'completed'),
(31, 16, 'Iverson Castro', '09693405958', 'iversoncastro0115@gmail.com', 'cash on delivery', 'CALABARZON , Cavite , Mendez , Ciudad nuevo Sabang phase 1A Blk.6 Lot.24 Durian St. , Philippines - 4110', ' | flower 2 (1) ', 99, '2024-08-26 01:12:20', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `details`, `price`, `image`, `quantity`) VALUES
(21, 'flower 1', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium voluptate quisquam totam velit. Expedita, nisi! Quas nostrum commodi quisquam eaque.', 99, 'flower-1.jpg', 0),
(22, 'flower 2', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium voluptate quisquam totam velit. Expedita, nisi! Quas nostrum commodi quisquam eaque.', 99, 'flower-2.jpg', 0),
(23, 'flower 3', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium voluptate quisquam totam velit. Expedita, nisi! Quas nostrum commodi quisquam eaque.', 99, 'flower-3.jpg', 0),
(24, 'flower 4', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium voluptate quisquam totam velit. Expedita, nisi! Quas nostrum commodi quisquam eaque.', 99, 'flower-4.jpg', 0),
(25, 'flower 5 ', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium voluptate quisquam totam velit. Expedita, nisi! Quas nostrum commodi quisquam eaque.', 99, 'flower-5.jpg', 0),
(26, 'flower 6', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium voluptate quisquam totam velit. Expedita, nisi! Quas nostrum commodi quisquam eaque.', 99, 'flower-7.jpg', 0),
(27, 'flower 7', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium voluptate quisquam totam velit. Expedita, nisi! Quas nostrum commodi quisquam eaque.', 99, 'flower-6.jpg', 0),
(28, 'flower 8', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium voluptate quisquam totam velit. Expedita, nisi! Quas nostrum commodi quisquam eaque.', 99, 'flower-8.jpg', 0),
(29, 'flower 9', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium voluptate quisquam totam velit. Expedita, nisi! Quas nostrum commodi quisquam eaque.', 99, 'flower-9.jpg', 0),
(30, 'flower 10', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium voluptate quisquam totam velit. Expedita, nisi! Quas nostrum commodi quisquam eaque.', 99, 'flower-10.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(10, 'admin A', 'admin01@gmail.com', '698d51a19d8a121ce581499d7b701668', 'admin'),
(14, 'user A', 'user01@gmail.com', '698d51a19d8a121ce581499d7b701668', 'user'),
(15, 'user B', 'user02@gmail.com', '698d51a19d8a121ce581499d7b701668', 'user'),
(16, 'iverson@gmail.com', 'iverson@gmail.com', '38ab1afbd102631c8874ed6197ea9ebb', 'user'),
(17, 'admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
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
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
