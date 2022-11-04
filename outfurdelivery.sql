-- phpMyAdmin SQL Dump
-- version 5.0.0-alpha1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2020 at 04:00 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `outfurdelivery`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryId` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryId`, `name`, `dateCreated`) VALUES
(1, 'Food', '2020-10-15 23:13:11'),
(2, 'Toy', '2020-10-15 23:13:11'),
(3, 'Health', '2020-10-15 23:13:35'),
(4, 'Tech', '2020-10-15 23:13:35'),
(5, 'Clothing', '2020-10-21 03:23:19');

-- --------------------------------------------------------

--
-- Table structure for table `credit-cards`
--

CREATE TABLE `credit-cards` (
  `creditCardId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `cardNumber` varchar(20) NOT NULL,
  `expirationDate` varchar(10) NOT NULL,
  `status` int(11) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `deals`
--

CREATE TABLE `deals` (
  `dealId` int(11) NOT NULL,
  `dealName` varchar(100) NOT NULL,
  `code` varchar(150) NOT NULL,
  `description` varchar(150) NOT NULL,
  `discount` int(11) NOT NULL,
  `activeDate` date NOT NULL,
  `expirationDate` date NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deals`
--

INSERT INTO `deals` (`dealId`, `dealName`, `code`, `description`, `discount`, `activeDate`, `expirationDate`, `dateCreated`) VALUES
(1, 'Test1', 'test1', 'Test 1', 10, '0000-00-00', '0000-00-00', '2020-10-21 02:58:39'),
(2, 'Test 2', 'testTwo', 'second test', 20, '2020-10-20', '2020-10-24', '2020-10-21 03:03:51');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `inventoryId` int(11) NOT NULL,
  `productAttributeId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`inventoryId`, `productAttributeId`, `productId`, `stock`, `status`) VALUES
(4, 0, 15, 10, 'not available'),
(7, 0, 16, 15, 'not available'),
(8, 0, 17, 15, 'available'),
(9, 0, 18, 20, 'available'),
(10, 0, 19, 30, 'available'),
(24, 11, 20, 10, 'available'),
(25, 12, 20, 0, 'available'),
(26, 13, 20, 1, 'available');

-- --------------------------------------------------------

--
-- Table structure for table `order-items`
--

CREATE TABLE `order-items` (
  `orderItemId` int(11) NOT NULL,
  `orderId` varchar(255) NOT NULL,
  `productId` int(11) NOT NULL,
  `productAttributeId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order-subscription-box`
--

CREATE TABLE `order-subscription-box` (
  `orderSubscriptionBoxId` int(11) NOT NULL,
  `orderId` varchar(255) NOT NULL,
  `subscriptionId` int(11) NOT NULL,
  `productAttributeId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `price` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderId` varchar(255) NOT NULL,
  `userId` int(11) NOT NULL,
  `dealId` int(11) NOT NULL,
  `cartTotal` decimal(6,2) NOT NULL,
  `name` varchar(100) NOT NULL,
  `cardNumber` varchar(20) NOT NULL,
  `expirationDate` varchar(10) NOT NULL,
  `streetAddress` varchar(150) NOT NULL,
  `city` varchar(150) NOT NULL,
  `state` char(2) NOT NULL,
  `zip` varchar(20) NOT NULL,
  `shipmentType` int(11) NOT NULL,
  `orderDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product-attributes`
--

CREATE TABLE `product-attributes` (
  `productAttributeId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `attribute` varchar(50) NOT NULL,
  `value` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product-attributes`
--

INSERT INTO `product-attributes` (`productAttributeId`, `productId`, `attribute`, `value`, `status`) VALUES
(1, 1, 'size', 'small', ''),
(2, 1, 'size', 'large', ''),
(3, 2, 'color', 'red', ''),
(4, 2, 'color', 'blue', ''),
(5, 2, 'color', 'green', ''),
(7, 1, 'color', 'green', ''),
(9, 2, 'color', 'Pink', ''),
(11, 20, 'color', 'Green', ''),
(12, 20, 'color', 'Blue', '');

-- --------------------------------------------------------

--
-- Table structure for table `product-categories`
--

CREATE TABLE `product-categories` (
  `productCategoryId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product-categories`
--

INSERT INTO `product-categories` (`productCategoryId`, `productId`, `categoryId`) VALUES
(1, 12, 1),
(3, 12, 3),
(5, 13, 1),
(6, 13, 3),
(7, 14, 1),
(8, 14, 3),
(9, 15, 1),
(10, 15, 3),
(11, 16, 5),
(12, 17, 5),
(13, 18, 2),
(14, 18, 3),
(15, 19, 2),
(16, 20, 1),
(17, 20, 2);

-- --------------------------------------------------------

--
-- Table structure for table `product-images`
--

CREATE TABLE `product-images` (
  `productImageId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `imageLink` varchar(255) NOT NULL,
  `imageStatus` int(11) NOT NULL,
  `uploadDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product-images`
--

INSERT INTO `product-images` (`productImageId`, `productId`, `imageLink`, `imageStatus`, `uploadDate`) VALUES
(4, 3, '5f8f24ac782cbhomeTacos.jpg', 1, '2020-10-20 17:55:56'),
(5, 7, '5f8f24ac9a831homeTacos.jpg', 1, '2020-10-20 17:55:56'),
(6, 3, '5f8f25973c43dhomeTacos.jpg', 1, '2020-10-20 17:59:51'),
(7, 7, '5f8f259762e17homeTacos.jpg', 1, '2020-10-20 17:59:51'),
(8, 8, '5f8f25977f3fchomeTacos.jpg', 1, '2020-10-20 17:59:51'),
(9, 3, '5f8f2662e6a8anavTaco.png', 1, '2020-10-20 18:03:14'),
(10, 7, '5f8f26630f912navTaco.png', 1, '2020-10-20 18:03:15'),
(11, 8, '5f8f266317656navTaco.png', 1, '2020-10-20 18:03:15'),
(12, 9, '5f8f266329d7dnavTaco.png', 1, '2020-10-20 18:03:15'),
(13, 10, '5f8f27f5131f0homeBurritos.jpg', 1, '2020-10-20 18:09:57'),
(14, 11, '5f8f2d6ce1529homeTacos.jpg', 1, '2020-10-20 18:33:16'),
(15, 12, '5f8f2e382e331homeTacos.jpg', 1, '2020-10-20 18:36:40'),
(16, 13, '5f8f30c117fb0homeTacos.jpg', 1, '2020-10-20 18:47:29'),
(17, 14, '5f8f31703600chomeTacos.jpg', 1, '2020-10-20 18:50:24'),
(18, 15, '5f8f34ccb8d31homeTacos.jpg', 1, '2020-10-20 19:04:44'),
(19, 16, '5f9a0ae21c264dog-home-temp.jpg', 1, '2020-10-29 00:20:50'),
(20, 17, '5f9a0b3d9286cdog-home-temp.jpg', 1, '2020-10-29 00:22:21'),
(21, 18, '5f9a10c7df9c2dog-home-temp.jpg', 1, '2020-10-29 00:45:59'),
(22, 19, '5f9c24e76ed68dog-home-temp.jpg', 1, '2020-10-30 14:36:23'),
(23, 20, '5fa4a3ccef2cddog-home-temp.jpg', 1, '2020-11-06 01:15:56');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productId` int(11) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `sku` varchar(100) NOT NULL,
  `petType` varchar(100) NOT NULL,
  `tierLevel` int(11) NOT NULL,
  `productDescription` varchar(255) NOT NULL,
  `productWeight` decimal(6,2) NOT NULL,
  `productPrice` decimal(6,2) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productId`, `productName`, `sku`, `petType`, `tierLevel`, `productDescription`, `productWeight`, `productPrice`, `dateCreated`) VALUES
(1, 'Dog Bone', '1050', 'dog', 3, 'A Dog Bone', '1.00', '4.99', '2020-10-16 01:15:33'),
(2, 'Dog Dish', '1060', 'dog', 3, 'A dog dish', '1.00', '6.99', '2020-10-16 02:35:59'),
(3, 'tacos', '101', 'dog', 1, 'Tacos to eat', '5.00', '2.99', '2020-10-20 04:19:07'),
(4, 'tacos', '102', 'cat', 1, 'more tacos', '2.00', '2.99', '2020-10-20 04:24:49'),
(5, 'tacos', '103', 'cat', 1, 'fghdfgh', '2.00', '2.99', '2020-10-20 04:28:58'),
(6, 'tacos', '103', 'cat', 1, 'asd', '5.00', '2.99', '2020-10-20 17:43:37'),
(7, 'tacos', '101', 'cat', 1, 'sdg', '5.00', '2.99', '2020-10-20 17:55:56'),
(8, 'tacos', '101', 'cat', 1, 'sdg', '2.00', '2.99', '2020-10-20 17:59:51'),
(9, 'tacos', '101', 'cat', 1, 'grdshg', '5.00', '2.99', '2020-10-20 18:03:14'),
(10, 'tacos', '20', 'cat', 1, 'adssad', '5.00', '2.99', '2020-10-20 18:09:56'),
(11, 'tacos', '200', 'cat', 1, 'df', '5.00', '2.99', '2020-10-20 18:33:16'),
(12, 'tacos', '33', 'cat', 1, 'asd', '5.00', '2.99', '2020-10-20 18:36:39'),
(13, 'Taco', '111', 'dog', 1, 'Food Tacos Test', '1.00', '1.99', '2020-10-20 18:47:28'),
(14, 'tacos', '1212', 'dog', 1, 'fdhhg', '1.00', '1.99', '2020-10-20 18:50:23'),
(15, 'tacos', '123456', 'dog', 1, 'zxxzcxcz', '1.00', '2.99', '2020-10-20 19:04:44'),
(16, 'inventory test', '123456789', 'dog', 2, 'dsfsdf', '2.00', '1.99', '2020-10-29 00:20:49'),
(17, 'Inventory test 2', '654123', 'Dog', 1, 'Sad', '5.00', '2.99', '2020-11-05 00:16:05'),
(18, 'inventory test 3', '314', 'dog', 1, 'dasf', '2.00', '0.99', '2020-10-29 00:45:59'),
(19, 'dfgdgfd', 'fdg', 'cat', 1, 'dfg', '5.00', '2.99', '2020-10-30 14:36:22'),
(20, 'Bone Test', '1000', 'cat', 1, 'Test', '5.00', '2.99', '2020-11-06 01:15:56');

-- --------------------------------------------------------

--
-- Table structure for table `subscription-images`
--

CREATE TABLE `subscription-images` (
  `subscriptionImageId` int(11) NOT NULL,
  `subscriptionBoxId` int(11) NOT NULL,
  `subscriptionImageLink` varchar(255) NOT NULL,
  `uploadDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscription-images`
--

INSERT INTO `subscription-images` (`subscriptionImageId`, `subscriptionBoxId`, `subscriptionImageLink`, `uploadDate`) VALUES
(1, 8, '5fa1eb36454b2dog-home-temp.jpg', '2020-11-03 23:43:50');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `subscriptionId` int(11) NOT NULL,
  `subscriptionBoxSku` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `subscriptionDescription` varchar(255) NOT NULL,
  `petType` varchar(50) NOT NULL,
  `duration` int(11) NOT NULL,
  `tierOneAmount` int(11) NOT NULL,
  `tierTwoAmount` int(11) NOT NULL,
  `tierThreeAmount` int(11) NOT NULL,
  `subscriptionPrice` decimal(5,2) NOT NULL,
  `isActive` char(3) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`subscriptionId`, `subscriptionBoxSku`, `name`, `subscriptionDescription`, `petType`, `duration`, `tierOneAmount`, `tierTwoAmount`, `tierThreeAmount`, `subscriptionPrice`, `isActive`, `dateCreated`) VALUES
(1, '', 'Edit Test', 'Edit test', 'Cat', 3, 0, 3, 2, '70.00', 'no', '2020-11-04 23:28:22'),
(2, '', 'Two', 'Test 2', 'Cat', 3, 1, 3, 3, '29.99', 'yes', '2020-10-20 21:25:46'),
(3, '', 'test box', 'testing box', 'Dog', 3, 2, 2, 2, '30.00', 'no', '2020-11-03 22:58:56'),
(4, '', 'test box 2', 'test box', 'Dog', 3, 2, 2, 2, '30.00', 'no', '2020-11-03 23:02:53'),
(5, '', 'test box 3', 'test ', 'Dog', 3, 2, 2, 2, '30.00', 'no', '2020-11-03 23:13:15'),
(6, '1', 'test box 4', 'test box', 'Dog', 3, 2, 2, 2, '30.00', 'no', '2020-11-03 23:28:16'),
(7, '01', 'test box 5', 'test box', 'Dog', 3, 2, 2, 2, '30.00', 'no', '2020-11-03 23:36:30'),
(8, '001', 'test box 5', 'test box 5', 'Cat', 3, 2, 2, 2, '30.00', 'no', '2020-11-03 23:43:48');

-- --------------------------------------------------------

--
-- Table structure for table `user-addresses`
--

CREATE TABLE `user-addresses` (
  `userAddressId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `streetAddtress` varchar(150) NOT NULL,
  `city` varchar(150) NOT NULL,
  `state` char(2) NOT NULL,
  `zip` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user-box-contents`
--

CREATE TABLE `user-box-contents` (
  `userBoxContentId` int(11) NOT NULL,
  `userSubscriptionId` int(11) NOT NULL,
  `productAttributeId` int(11) NOT NULL,
  `productId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user-pets`
--

CREATE TABLE `user-pets` (
  `userPetsId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `petType` varchar(50) NOT NULL,
  `birthday` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user-subscriptions`
--

CREATE TABLE `user-subscriptions` (
  `userSubscriptionId` int(11) NOT NULL,
  `subscriptionId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `dateStarted` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `dateEnded` date NOT NULL,
  `autoRenew` char(3) NOT NULL,
  `isActive` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `birthday` date NOT NULL,
  `dateJoined` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `firstName`, `lastName`, `email`, `password`, `phone`, `birthday`, `dateJoined`) VALUES
(1, 'Admin', 'Admin', 'admin@outfurdelivery.com', '$2y$10$prGxY/ZguKXr3XDQfoz9AO.An4/HqB0f7OKcbD/0J6vxy6SJ2vyQi', '9209999999', '2020-11-01', '2020-11-02 00:05:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `credit-cards`
--
ALTER TABLE `credit-cards`
  ADD PRIMARY KEY (`creditCardId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `deals`
--
ALTER TABLE `deals`
  ADD PRIMARY KEY (`dealId`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventoryId`),
  ADD KEY `productAttributeId` (`productAttributeId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `order-items`
--
ALTER TABLE `order-items`
  ADD PRIMARY KEY (`orderItemId`),
  ADD KEY `productAttributeId` (`productAttributeId`),
  ADD KEY `productId` (`productId`),
  ADD KEY `orderId` (`orderId`);

--
-- Indexes for table `order-subscription-box`
--
ALTER TABLE `order-subscription-box`
  ADD PRIMARY KEY (`orderSubscriptionBoxId`),
  ADD KEY `subscriptionId` (`subscriptionId`),
  ADD KEY `productAttributeId` (`productAttributeId`),
  ADD KEY `productId` (`productId`),
  ADD KEY `orderId` (`orderId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD KEY `userId` (`userId`),
  ADD KEY `dealId` (`dealId`),
  ADD KEY `orderId` (`orderId`);

--
-- Indexes for table `product-attributes`
--
ALTER TABLE `product-attributes`
  ADD PRIMARY KEY (`productAttributeId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `product-categories`
--
ALTER TABLE `product-categories`
  ADD PRIMARY KEY (`productCategoryId`),
  ADD KEY `productId` (`productId`),
  ADD KEY `categoryId` (`categoryId`);

--
-- Indexes for table `product-images`
--
ALTER TABLE `product-images`
  ADD PRIMARY KEY (`productImageId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `subscription-images`
--
ALTER TABLE `subscription-images`
  ADD PRIMARY KEY (`subscriptionImageId`),
  ADD KEY `subscriptionBoxId` (`subscriptionBoxId`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`subscriptionId`);

--
-- Indexes for table `user-addresses`
--
ALTER TABLE `user-addresses`
  ADD PRIMARY KEY (`userAddressId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `user-box-contents`
--
ALTER TABLE `user-box-contents`
  ADD PRIMARY KEY (`userBoxContentId`),
  ADD KEY `productAttributeId` (`productAttributeId`),
  ADD KEY `productId` (`productId`),
  ADD KEY `userSubscriptionId` (`userSubscriptionId`);

--
-- Indexes for table `user-pets`
--
ALTER TABLE `user-pets`
  ADD PRIMARY KEY (`userPetsId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `user-subscriptions`
--
ALTER TABLE `user-subscriptions`
  ADD PRIMARY KEY (`userSubscriptionId`),
  ADD KEY `subscriptionId` (`subscriptionId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `credit-cards`
--
ALTER TABLE `credit-cards`
  MODIFY `creditCardId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deals`
--
ALTER TABLE `deals`
  MODIFY `dealId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `order-items`
--
ALTER TABLE `order-items`
  MODIFY `orderItemId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order-subscription-box`
--
ALTER TABLE `order-subscription-box`
  MODIFY `orderSubscriptionBoxId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product-attributes`
--
ALTER TABLE `product-attributes`
  MODIFY `productAttributeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product-categories`
--
ALTER TABLE `product-categories`
  MODIFY `productCategoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `product-images`
--
ALTER TABLE `product-images`
  MODIFY `productImageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `subscription-images`
--
ALTER TABLE `subscription-images`
  MODIFY `subscriptionImageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `subscriptionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user-addresses`
--
ALTER TABLE `user-addresses`
  MODIFY `userAddressId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user-box-contents`
--
ALTER TABLE `user-box-contents`
  MODIFY `userBoxContentId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user-pets`
--
ALTER TABLE `user-pets`
  MODIFY `userPetsId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user-subscriptions`
--
ALTER TABLE `user-subscriptions`
  MODIFY `userSubscriptionId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `credit-cards`
--
ALTER TABLE `credit-cards`
  ADD CONSTRAINT `credit-cards_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `products` (`productId`);

--
-- Constraints for table `order-items`
--
ALTER TABLE `order-items`
  ADD CONSTRAINT `order-items_ibfk_1` FOREIGN KEY (`productAttributeId`) REFERENCES `product-attributes` (`productAttributeId`),
  ADD CONSTRAINT `order-items_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `products` (`productId`),
  ADD CONSTRAINT `order-items_ibfk_3` FOREIGN KEY (`orderId`) REFERENCES `orders` (`orderId`);

--
-- Constraints for table `order-subscription-box`
--
ALTER TABLE `order-subscription-box`
  ADD CONSTRAINT `order-subscription-box_ibfk_1` FOREIGN KEY (`subscriptionId`) REFERENCES `subscriptions` (`subscriptionId`),
  ADD CONSTRAINT `order-subscription-box_ibfk_2` FOREIGN KEY (`productAttributeId`) REFERENCES `product-attributes` (`productAttributeId`),
  ADD CONSTRAINT `order-subscription-box_ibfk_3` FOREIGN KEY (`productId`) REFERENCES `products` (`productId`),
  ADD CONSTRAINT `order-subscription-box_ibfk_4` FOREIGN KEY (`orderId`) REFERENCES `orders` (`orderId`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`dealId`) REFERENCES `deals` (`dealId`);

--
-- Constraints for table `product-attributes`
--
ALTER TABLE `product-attributes`
  ADD CONSTRAINT `product-attributes_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `products` (`productId`);

--
-- Constraints for table `product-categories`
--
ALTER TABLE `product-categories`
  ADD CONSTRAINT `product-categories_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `products` (`productId`),
  ADD CONSTRAINT `product-categories_ibfk_2` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`categoryId`);

--
-- Constraints for table `product-images`
--
ALTER TABLE `product-images`
  ADD CONSTRAINT `product-images_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `products` (`productId`);

--
-- Constraints for table `subscription-images`
--
ALTER TABLE `subscription-images`
  ADD CONSTRAINT `subscription-images_ibfk_1` FOREIGN KEY (`subscriptionBoxId`) REFERENCES `subscriptions` (`subscriptionId`);

--
-- Constraints for table `user-addresses`
--
ALTER TABLE `user-addresses`
  ADD CONSTRAINT `user-addresses_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);

--
-- Constraints for table `user-box-contents`
--
ALTER TABLE `user-box-contents`
  ADD CONSTRAINT `user-box-contents_ibfk_1` FOREIGN KEY (`productAttributeId`) REFERENCES `product-attributes` (`productAttributeId`),
  ADD CONSTRAINT `user-box-contents_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `products` (`productId`),
  ADD CONSTRAINT `user-box-contents_ibfk_3` FOREIGN KEY (`userSubscriptionId`) REFERENCES `user-subscriptions` (`userSubscriptionId`);

--
-- Constraints for table `user-pets`
--
ALTER TABLE `user-pets`
  ADD CONSTRAINT `user-pets_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);

--
-- Constraints for table `user-subscriptions`
--
ALTER TABLE `user-subscriptions`
  ADD CONSTRAINT `user-subscriptions_ibfk_1` FOREIGN KEY (`subscriptionId`) REFERENCES `subscriptions` (`subscriptionId`),
  ADD CONSTRAINT `user-subscriptions_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

