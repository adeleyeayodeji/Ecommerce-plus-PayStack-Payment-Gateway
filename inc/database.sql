-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 09, 2020 at 05:59 AM
-- Server version: 10.4.15-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u380882461_biggi_ecommerc`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(15, 'Fashion'),
(17, 'Accessories');

-- --------------------------------------------------------

--
-- Table structure for table `image_slider`
--

CREATE TABLE `image_slider` (
  `id` int(11) NOT NULL,
  `slider_name` varchar(10000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `image_slider`
--

INSERT INTO `image_slider` (`id`, `slider_name`) VALUES
(1, 'slide-lg-3.jpg'),
(2, 'slide-lg-2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `pid` int(200) NOT NULL,
  `quantity` int(200) DEFAULT NULL,
  `customer_email` varchar(200) DEFAULT NULL,
  `customer_name` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `pid`, `quantity`, `customer_email`, `customer_name`) VALUES
(10, 33, 8, 'admin@gmail.com', 'Adeleye Ayodeji'),
(11, 35, 5, 'admin@gmail.com', 'Asdeded sdsd'),
(12, 36, 2, 'admin@gmail.com', 'Asdeded sdsd'),
(13, 35, 5, 'admin@gmail.com', 'aaa'),
(14, 36, 5, 'admin@gmail.com', 'aaa'),
(15, 34, 6, 'admin@gmail.com', 'Ade'),
(16, 36, 2, 'admin@gmail.com', 'Ade'),
(17, 35, 2, 'admin@gmail.com', 'Ade'),
(18, 34, 2, 'admin@gmail.com', 'Ade'),
(19, 34, 5, 'admin@gmail.com', 'Ade'),
(20, 34, 1, 'etz.bigjay@gmail.com', 'Jay'),
(21, 36, 375, 'example@mail.com', 'Coded');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `description` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `category`, `price`, `product_image`, `description`) VALUES
(33, 'Men&#39;s T-shirt for summer', 15, '20', '1_new_b9a69e780fe70db71fc79cb565e7f9c8.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore commodi quam amet ducimus illum dolorem iste corrupti nemo quo repudiandae cupiditate culpa tempora accusantium possimus, qui eligendi cum. Laborum, dolorem!'),
(34, 'Winter Jacket for Men, All sizes', 15, '30', '2_new_3ef8671facec8ae2870aa224ed6c3413.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore commodi quam amet ducimus illum dolorem iste corrupti nemo quo repudiandae cupiditate culpa tempora accusantium possimus, qui eligendi cum. Laborum, dolorem!'),
(35, 'Jeans Shorts for Boys Small size', 15, '80', '3_new_9435a9c00919ff98cb34a61494ef4a5b.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.'),
(36, 'Jeans Shorts for Boys Small size', 15, '100', '4_new_0c66545fc7697c25d49881048eeb1c2d.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(10000) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `timestamp`) VALUES
(1, 'Adeleye Ayodeji', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '2017-10-27 12:05:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image_slider`
--
ALTER TABLE `image_slider`
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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `image_slider`
--
ALTER TABLE `image_slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
