-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2023 at 09:54 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flavor_kitchen_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `password`) VALUES
(1, 'Rafi', 'rafi123', 'b2f0d9e408eccecc0edb74d654d36a72'),
(10, 'CSE482', 'cse482', '2b77bd48466a3ee0e0106f8a9ab31177');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `image`, `featured`, `active`) VALUES
(3, 'Burger', 'Food_Category_3.jpg', 'Yes', 'Yes'),
(5, 'Pasta', 'Food_Category_5.jpg', 'Yes', 'Yes'),
(11, 'Pizza', 'Food_Category_11.jpg', 'Yes', 'Yes'),
(12, 'Momo', 'Food_Category_12.jpg', 'No', 'Yes'),
(13, 'Chicken Fry', 'Food_Category_13.jpeg', 'No', 'Yes'),
(14, 'Fries', 'Food_Category_14.jpg', 'No', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `category` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`id`, `title`, `description`, `price`, `image`, `category`, `featured`, `active`) VALUES
(4, 'Chicken Burger', 'Chicken burger with cheese', '250.00', 'Food_Item_4.jpg', 3, 'Yes', 'Yes'),
(5, 'Beef Burger', 'Beef Burger with Cheese', '300.00', 'Food_Item_5.jpg', 3, 'Yes', 'Yes'),
(6, 'Chicken Double', 'Chicken Cheese burger with double petty', '350.00', 'Food_Item_6.jpeg', 3, 'No', 'Yes'),
(8, 'Beef Double', 'Beef Cheese burger with double petty\r\n', '400.00', 'Food_Item_8.jpg', 3, 'No', 'Yes'),
(10, 'Chicken Pizza', 'Chicken Pizza', '550.00', 'Food_Item_10.jpg', 11, 'Yes', 'Yes'),
(11, 'Cheese Pizza', 'Cheese Pizza', '500.00', 'Food_Item_11.jpg', 11, 'No', 'Yes'),
(12, 'Pepperoni Pizza', 'Pepperoni Pizza', '700.00', 'Food_Item_12.jpg', 11, 'Yes', 'Yes'),
(13, 'Chicken Pasta', 'Chicken PastaChicken Pasta', '300.00', 'Food_Item_13.jpg', 5, 'No', 'Yes'),
(14, 'Beef Pasta', 'Beef Pasta', '350.00', 'Food_Item_14.jpg', 5, 'Yes', 'Yes'),
(15, 'Pasta Alfredo', 'Pasta Alfredo', '300.00', 'Food_Item_15.jpg', 5, 'Yes', 'Yes'),
(16, 'Chicken Momo', 'Chicken Momo', '250.00', 'Food_Item_16.jpg', 12, 'Yes', 'Yes'),
(17, 'Vagetable Momo', 'Vagetable Momo', '200.00', 'Food_Item_17.jpg', 12, 'No', 'Yes'),
(18, 'Fried Momo', 'Fried Momo', '250.00', 'Food_Item_18.jpg', 12, 'Yes', 'Yes'),
(19, 'Chicken Fry 2pcs', 'Chicken Fry 2pcs', '200.00', 'Food_Item_19.jpg', 13, 'Yes', 'Yes'),
(20, 'Chicken Fry 5pcs', 'Chicken Fry 5pcs Leg', '490.00', 'Food_Item_20.jpeg', 13, 'Yes', 'Yes'),
(21, 'Chicken Fry 12pcs', 'Chicken Fry 12pcs', '1150.00', 'Food_Item_21.jpg', 13, 'No', 'Yes'),
(22, 'Chicken Strips 20pcs', 'Chicken Strips 20pcs', '600.00', 'Food_Item_22.jpg', 13, 'No', 'Yes'),
(23, 'Fries Large', 'Fries Large', '190.00', 'Food_Item_23.jpg', 14, 'Yes', 'Yes'),
(24, 'Fries Small', 'Fries Small', '110.00', 'Food_Item_24.jpg', 14, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(150) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_phone` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `total`, `order_date`, `status`, `customer_name`, `customer_phone`, `customer_email`, `customer_address`) VALUES
(3, 'Beef Double[2], Chicken Pizza[1], ', '1350.00', '2023-05-27 10:08:01', 'Delivered', 'Rafi', '01000000000', 'thrafi175@gmail.com', 'Dhaka'),
(5, 'Beef Double[2], Chicken Burger[1], ', '1050.00', '2023-05-27 11:38:47', 'Ordered', 'Rafi', '01000000000', 'thrafi175@gmail.com', 'Dhaka'),
(6, 'Beef Burger[1], Chicken Burger[1], ', '550.00', '2023-05-28 01:18:54', 'Ordered', 'Rafi', '01000000000', 'thrafi175@gmail.com', 'D'),
(9, 'Chicken Fry 12pcs[1], ', '1150.00', '2023-05-28 10:05:21', 'Ordered', 'Rafi', '01000000000', 'rafi1@gmail.com', 'Dhaka'),
(10, 'Beef Burger[1], ', '300.00', '2023-05-29 12:42:15', 'Ordered', 'Rafi', '01000000000', 'thrafi175@gmail.com', 'Dhaka');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `customer_email` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `item_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `paid_amount` float(10,2) NOT NULL,
  `paid_amount_currency` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `txn_id` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `payment_status` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `stripe_checkout_session_id` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `customer_name`, `customer_email`, `item_name`, `paid_amount`, `paid_amount_currency`, `txn_id`, `payment_status`, `stripe_checkout_session_id`, `created`, `modified`) VALUES
(2, 'Tajbiul', 'thrafi175@gmail.com', 'Beef Burger[1], Beef Pasta[2], Cheese Pizza[1],', 1500.00, 'bdt', 'pi_3NCoVZGlMd3WOK0U1xzwMPC9', 'succeeded', 'cs_test_a1I560V4TQgD3l65SpLKMsEN0aifLCjcmp5db2goiIoDnSALeKPIVGHyBQ', '2023-05-29 00:40:05', '2023-05-29 00:40:05'),
(3, 'Rafi', 'thrafi175@gmail.com', 'Beef Burger[1], Beef Pasta[2], Cheese Pizza[1], Vagetable Momo[1],', 1700.00, 'bdt', 'pi_3NCp4vGlMd3WOK0U1rd7Cgsa', 'succeeded', 'cs_test_a1zq5vcDhUckcoLwD9IOhFYpFGfpLlk0qd3dmyzc1BXHOm745Si6Mb1zOs', '2023-05-29 01:16:37', '2023-05-29 01:16:37'),
(4, 'Rafi', 'thrafi175@gmail.com', 'Beef Pasta[2], Cheese Pizza[1], Vagetable Momo[1],', 1400.00, 'bdt', 'pi_3NCp9CGlMd3WOK0U0gASeu53', 'succeeded', 'cs_test_a10WLeP3WArqGmShIU9LhsoJzCEucrV96pyKzVWP0CjR0jnvorTczso9cg', '2023-05-29 01:21:02', '2023-05-29 01:21:02'),
(5, 'Rafi', 'thrafi175@gmail.com', 'Beef Pasta[2], Cheese Pizza[1], Vagetable Momo[1],', 1400.00, 'bdt', 'pi_3NCpCRGlMd3WOK0U04ErMETI', 'succeeded', 'cs_test_a1OVX2GoIPOApzLODLqLCb1xlEnPuOjrUO2oIgOg7GExpQhiYMWeZqkYoV', '2023-05-29 01:24:23', '2023-05-29 01:24:23'),
(6, 'Tajbiul', 'thrafi175@gmail.com', 'Beef Pasta[2], Cheese Pizza[1], ', 1200.00, 'bdt', 'pi_3NCpoOGlMd3WOK0U0rGbiCpK', 'succeeded', 'cs_test_a1KIA0fnxjhr1WMSFIi1ersoY3xtK2qUddNE7qnZlUSg39Uj0AJ9bgPHOQ', '2023-05-29 02:03:36', '2023-05-29 02:03:36'),
(7, 'Rafi', 'rafi1@gmail.com', 'Chicken Fry 12pcs[1], ', 1150.00, 'bdt', 'pi_3NCpq6GlMd3WOK0U1khecOLv', 'succeeded', 'cs_test_a1dPGBjTUIYoBXykQkiNYces0XRPfviZcFzC3E5ADOZvsqoYwqWL0JHJ71', '2023-05-29 02:05:22', '2023-05-29 02:05:22'),
(8, 'Rafi', 'thrafi175@gmail.com', 'Beef Burger[1], ', 300.00, 'bdt', 'pi_3ND3WjGlMd3WOK0U0sthIrwO', 'succeeded', 'cs_test_a1ZckVCUDs5XMNxdokyVKKWOjq4c5tlvEDislvuwf2Sm89smaWkhrh6G0F', '2023-05-29 16:42:17', '2023-05-29 16:42:17'),
(9, 'Rafi', 'thrafi175@gmail.com', 'Beef Burger[1], ', 300.00, 'bdt', 'pi_3ND9ZBGlMd3WOK0U1ySPMZXs', 'succeeded', 'cs_test_a1BCZAkXT2jQqaE0jL11Fq7gzmOlygfQE8sBncAL0ki1aqOMsgCQyCGdNL', '2023-05-29 23:09:13', '2023-05-29 23:09:13'),
(10, 'Rafi', 'thrafi175@gmail.com', 'Chicken Burger[1], Chicken Double[2], ', 950.00, 'bdt', 'pi_3NDu5zGlMd3WOK0U1VsJJnJV', 'succeeded', 'cs_test_a1in3R3ZwFNthdQxBSDowQU1Y1SDMKjwOsRx4eWalcDBDcWLtxMn3LRPY6', '2023-06-01 00:50:10', '2023-06-01 00:50:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
