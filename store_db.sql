-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2023 at 10:29 AM
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
-- Database: `store_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `name`) VALUES
(12, 'polysmart'),
(14, 'omink'),
(15, 'sorose'),
(16, 'ego poly'),
(17, 'innoplast');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(19, 'cutting'),
(20, 'roll'),
(21, 'small'),
(22, 'big'),
(23, 'sam'),
(24, 'as');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity_left` double NOT NULL,
  `quantity_add` double NOT NULL,
  `current_quantity` double NOT NULL,
  `date` date NOT NULL,
  `brand_id` int(11) NOT NULL DEFAULT 0,
  `cat_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `product_id`, `quantity_left`, `quantity_add`, `current_quantity`, `date`, `brand_id`, `cat_id`) VALUES
(1, 77, 1, 0, 1, '2023-01-21', 16, 0),
(10, 75, 38.8, 10, 408, '2023-01-30', 12, 0),
(11, 79, 0, 6.9, 6.9, '2023-01-30', 14, 20),
(12, 77, 16, 0, 16, '2023-01-31', 16, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `cat_name` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` varchar(400) NOT NULL,
  `image` varchar(500) NOT NULL,
  `Reg_date` datetime NOT NULL,
  `brand_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `cat_name`, `name`, `description`, `image`, `Reg_date`, `brand_id`) VALUES
(71, 0, 'medium', 'form ikordu', 'upload/63c7f3256fbd88.38907858.jpg', '2023-01-18 14:24:53', 12),
(72, 0, 'orebe', 'ewdccx', 'upload/63c7f46adf8884.19501621.jpg', '2023-01-18 14:30:18', 15),
(73, 0, 'medium', 'form ikordu', 'upload/63c7f5098a79b9.77647437.jpg', '2023-01-18 14:32:57', 15),
(74, 0, 'blue/black ', 'wfyjn', 'upload/63c965e69b3b14.56758241.jpg', '2023-01-19 16:46:46', 12),
(75, 0, 'orebe', 'jsjkjsk', 'upload/63c966cdef4685.09848641.jpg', '2023-01-19 16:50:37', 12),
(76, 0, 'polybag', 'sawdd', 'upload/63c9676e4b2f07.66377085.jpg', '2023-01-19 16:53:18', 12),
(77, 0, 'orebe', 'qweww', 'upload/63c968e575b568.07273199.jpg', '2023-01-19 16:59:33', 16),
(78, 0, 'medium', 'erer567', 'upload/63c969698b8f15.70847681.jpg', '2023-01-19 17:01:45', 16),
(79, 20, 'santana', 'w6reyuknr', 'upload/63c9719600b3e5.99185830.jpg', '2023-01-19 17:36:37', 14),
(81, 22, 'polybag', 'rrrdddd', 'upload/63c9b7ac0ff398.84752941.jpg', '2023-01-19 22:35:40', 12),
(82, 0, 'orebe', 'rrr', 'upload/63cb184c8edd08.52900577.jpg', '2023-01-20 23:40:12', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `prices` double NOT NULL,
  `quantity` double NOT NULL,
  `total_price` double NOT NULL,
  `reg_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `sale_id`, `product_id`, `prices`, `quantity`, `total_price`, `reg_date`) VALUES
(30, 817827, 75, 1800, 0, 7200, '2023-01-30'),
(31, 946145, 75, 1800, 0, 9000, '2023-01-30'),
(32, 120704, 79, 1800, 0, 3600, '2023-01-30'),
(33, 452527, 77, 1400, 2, 2800, '2023-01-31'),
(34, 226354, 77, 1400, 2, 2800, '2023-01-31'),
(35, 220094, 77, 1400, 2, 2800, '2023-01-31');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `bundle` double NOT NULL,
  `piece` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `product_id`, `bundle`, `piece`) VALUES
(1, 72, 10, 10),
(2, 75, 10, 10),
(3, 77, 10, 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `password`) VALUES
(3, 'owolabi', '827ccb0eea8a706c4c34a16891f84e7b'),
(5, 'daystar', 'e034fb6b66aacc1d48f445ddfb08da98');

-- --------------------------------------------------------

--
-- Table structure for table `variation`
--

CREATE TABLE `variation` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` varchar(250) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `variation`
--

INSERT INTO `variation` (`id`, `product_id`, `quantity`, `price`) VALUES
(1, 71, 'bundles', 1400),
(3, 77, 'bundle', 1400),
(4, 77, 'bag', 14000),
(5, 79, '1kg', 1800),
(6, 75, ' bundle', 1800);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `cat_name` (`cat_name`) USING BTREE;

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `variation`
--
ALTER TABLE `variation`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `variation`
--
ALTER TABLE `variation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
