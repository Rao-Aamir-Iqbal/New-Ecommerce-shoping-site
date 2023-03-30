-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2023 at 08:18 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `registeration`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `p_name` varchar(255) NOT NULL,
  `p_quantity` int(255) NOT NULL,
  `p_price` varchar(255) NOT NULL,
  `total_price` varchar(255) NOT NULL,
  `p_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(255) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `status` int(255) NOT NULL COMMENT '1=Active\r\n0=Deactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`, `status`) VALUES
(1, 'labtop l', 1),
(2, 'mobile', 1),
(3, 'bag', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cat_subcat_status`
--

CREATE TABLE `cat_subcat_status` (
  `id` int(255) NOT NULL,
  `subcat_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `otp_code` int(11) NOT NULL,
  `token` int(255) NOT NULL,
  `status` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `isadmin` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `email`, `password`, `otp_code`, `token`, `status`, `image`, `isadmin`) VALUES
(1, 'aamir iqbal', 'amirraoiqbal@gmail.com', '$2y$10$6LvfF7TeGmRY0DLID0WbV.OuBK4eRPkeDh6FfIle3N.pnKInPmMF6', 923701, 5032, 1, 'aW1hZ2VzICgxKS5qcGVn', 1),
(2, 'aamir', 'test@gmaim.com', '$2y$10$Lk8vYEUjO5RXHdUk2jbZuOdJOjNnKOXQrWhH6SKM8RVAYcffGMzg6', 524362, 0, 0, '', 0),
(3, 'aamir', 'test@gmail.com', '$2y$10$5LpOamS/5Cl.OmT4.Gc46.8xKIh/wNpRL9NOi2jEGJPZGG1fu8QPq', 863841, 0, 1, '', 0),
(4, 'aamir rao', 'test2@gmail.com', '$2y$10$6LvfF7TeGmRY0DLID0WbV.OuBK4eRPkeDh6FfIle3N.pnKInPmMF6', 119964, 0, 1, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_info`
--

CREATE TABLE `order_info` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zip_code` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_info`
--

INSERT INTO `order_info` (`id`, `name`, `email`, `address`, `city`, `zip_code`) VALUES
(1, 'aamir', 'amirraoiqbal@gmail.com', 'bhalwal srgodha', 'sargodha', 2345),
(2, 'aamir', 'amirraoiqbal@gmail.com', 'bhalwal srgodha', 'sargodha', 2345),
(3, 'aamir', 'amirraoiqbal@gmail.com', 'bhalwal srgodha', 'sargodha', 2345),
(4, 'aamir', 'amirraoiqbal@gmail.com', 'bhalwal srgodha', 'sargodha', 2345),
(5, 'iqbal', 'test@gmail.com', 'bhalwal srgodha', 'sargodha', 23423454),
(6, 'iqbal', 'test@gmail.com', 'bhalwal srgodha', 'sargodha', 23423454),
(7, 'iqbal', 'test@gmail.com', 'bhalwal srgodha', 'sargodha', 23423454),
(8, 'kashif', 'amirraoiqbal@gmail.com', 'bhalwal srgodha', 'sargodha', 2345),
(9, 'hassan', 'gdsgj@gmail.com', 'bhalwal srgodha', 'sargodha', 5123),
(10, 'saqib', 'gdsgj@gmail.com', 'bhalwal srgodha', 'sargodha', 45634),
(11, 'ahsan', 'test@gmail.com', 'bhalwal srgodha', 'sargodha', 2345),
(12, 'kashif', 'test@gmail.com', 'bhalwal srgodha', 'sargodha', 45634),
(13, 'test', 'test@gmail.com', 'Tehsil Bhalwal, District Sargodha, Pakistan', 'Bhalwal', 40410),
(14, 'kashif', 'amirraoiqbal@gmail.com.com', 'Tehsil Bhalwal, District Sargodha, Pakistan', 'sargodha', 40410);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(255) NOT NULL,
  `emply_id` int(255) NOT NULL,
  `sub_category_id` int(255) NOT NULL,
  `p_name` varchar(255) NOT NULL,
  `p_price` int(255) NOT NULL,
  `p_type` varchar(255) NOT NULL,
  `p_description` varchar(255) NOT NULL,
  `p_image` varchar(255) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1= Active\r\n0=Deactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `emply_id`, `sub_category_id`, `p_name`, `p_price`, `p_type`, `p_description`, `p_image`, `status`) VALUES
(1, 1, 4, 'hot infinix 6', 25, '', 'kdfgk erter', 'download (1).jpeg', 1),
(6, 1, 3, 'mobile', 1256, '', '156156', 'download (3).jpeg', 1),
(7, 1, 1, 'labtop', 695656, '', 'jdskfj dfgdfg', 'download.jpeg', 1),
(8, 1, 2, 'labtop', 123232, '', 'jdskfj dfgdfg', 'images (1).jpeg', 0),
(9, 1, 6, 'bag lather', 253, '', 'jdskfj dfgsd', 'download (6).jpeg', 1),
(10, 1, 5, 'bagc oteene', 5466, '', 'jdskfj dfgsd', 'download (5).jpeg', 1),
(11, 1, 4, 'mobile', 34656, '', '23432544454dfgd', 'download (2).jpeg', 1),
(12, 1, 1, 'labtop', 565656, '', '156156', 'murjp1nk4lp1idlt.jpg', 1),
(13, 1, 4, 'mobile', 7568768, '', 'jdskfj dfgsd', 'images (3).jpeg', 1),
(14, 1, 5, 'mobilefg', 54657, '', '454jklj', 'download (3).jpeg', 1),
(15, 1, 2, 'mobile i phone', 563543, '', 'jdskfj dfgdfg', 'tag.webp', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pro_statuses`
--

CREATE TABLE `pro_statuses` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` int(11) NOT NULL,
  `subcategory_name` varchar(255) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `subcategory_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(255) NOT NULL,
  `sub_category_name` varchar(255) NOT NULL,
  `category_id` int(255) NOT NULL,
  `status` int(255) NOT NULL COMMENT '1=Active\r\n0=Deactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `sub_category_name`, `category_id`, `status`) VALUES
(1, 'hp labtop', 1, 1),
(2, 'dell laptop', 1, 0),
(3, 'apple mobile', 2, 1),
(4, 'infinix mobile', 2, 1),
(5, 'Cotten Bag', 3, 1),
(6, 'lather bag', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sub_category_stateses`
--

CREATE TABLE `sub_category_stateses` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_category_stateses`
--

INSERT INTO `sub_category_stateses` (`id`, `product_name`, `product_id`, `product_status`) VALUES
(1, 'labtop corei5 hp', 2, 1),
(2, 'labtop corei5 hp', 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cat_subcat_status`
--
ALTER TABLE `cat_subcat_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_info`
--
ALTER TABLE `order_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_category_id` (`sub_category_id`);

--
-- Indexes for table `pro_statuses`
--
ALTER TABLE `pro_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `sub_category_stateses`
--
ALTER TABLE `sub_category_stateses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cat_subcat_status`
--
ALTER TABLE `cat_subcat_status`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_info`
--
ALTER TABLE `order_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pro_statuses`
--
ALTER TABLE `pro_statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sub_category_stateses`
--
ALTER TABLE `sub_category_stateses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
