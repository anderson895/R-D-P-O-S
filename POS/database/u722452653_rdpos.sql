-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2023 at 03:17 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u722452653_rdpos`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `acc_id` int(11) NOT NULL,
  `acc_created` date NOT NULL,
  `acc_username` varchar(255) NOT NULL,
  `acc_password` varchar(255) NOT NULL,
  `acc_fname` varchar(255) NOT NULL,
  `acc_lname` varchar(255) NOT NULL,
  `acc_type` varchar(255) NOT NULL,
  `acc_status` int(11) NOT NULL,
  `acc_email` varchar(255) NOT NULL,
  `acc_contact` varchar(255) NOT NULL,
  `emp_image` varchar(255) NOT NULL,
  `emp_address` varchar(255) NOT NULL,
  `acc_lastEdit` datetime DEFAULT NULL,
  `Otp` varchar(6) NOT NULL,
  `incorrect_attempts` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`acc_id`, `acc_created`, `acc_username`, `acc_password`, `acc_fname`, `acc_lname`, `acc_type`, `acc_status`, `acc_email`, `acc_contact`, `emp_image`, `emp_address`, `acc_lastEdit`, `Otp`, `incorrect_attempts`) VALUES
(16, '2023-06-01', 'admin', 'admin', 'freddie mark', 'santiago', 'administrator', 0, 'freddiemarksantiago@gmail.com', '09770987020', '336897245_760394325703570_2135528582037243127_n.jpg', 'Paso bagbaguin Sta.Maria Bulacanss', '2023-08-08 05:41:15', '', NULL),
(19, '2023-06-03', 'masterparj', 'masterparj', 'Joshua Anderson', 'Padilla', 'customer', 0, 'masterparj@gmail.com', '09493336125', '336897245_760394325703570_2135528582037243127_n.jpg', 'Sta.Rosa 2 Marilao Bulacan', '2023-07-01 12:39:03', '669741', NULL),
(31, '2023-06-08', 'angela denise', '1234', 'Angela Denise', 'Flores', 'cashier', 0, 'floterina@gmail.com', '09454454744', '95429221_1644556029016308_5940044004929306624_n.jpg', 'Sta.Rosa 2 Marilao Bulacan', '2023-06-30 02:07:35', '833406', NULL),
(33, '2023-06-08', 'padilla', 'padilla', 'joshua', 'padilla', 'delivery person', 0, 'andersonandy123@gmail.com', '09770987020', '', 'Sta.Rosa 2 Marilao Bulacan', '2023-06-26 07:09:52', '0', NULL),
(47, '2023-06-30', 'andersonand1321y046@gmail.com', 'andersonand1321y046@gmail.com', 'test', 'padilla', 'delivery person', 0, 'andersonand1321y046@gmail.com', '09770987020', '3831dbe2-352e-4409-a2e2-fc87d11cab0a (1).jpg', 'Sta.Rosa 2 Marilao Bulacan', NULL, '', NULL),
(48, '2023-06-30', 'justinmelvin345@yahoo.com', 'justinmelvin345@yahoo.com', 'justin', 'melvin', 'delivery person', 0, 'justinmelvin345@yahoo.com', '09770987020', 'WIN_20230305_10_36_11_Pro.jpg', 'Sta.Rosa 2 Marilao Bulacanssss', '2023-06-30 01:59:19', '', NULL),
(50, '2023-07-01', '09454454744', '852109', 'Joshua Anderson', 'Padilla', 'customer', 0, 'Andersonandy04@gmail.com', '09454454744', '', '', NULL, '', NULL),
(51, '2023-07-01', 'joshua', 'joshua', 'joshua', 'padilla', 'customer', 1, 'andersonandy0@gmail.com', '09205433152', '', '', NULL, '710926', NULL),
(52, '2023-07-01', 'zy30alcarez', '123456789', 'zyrine', 'alcarez', 'customer', 0, 'zy30alcarez@gmail.com', '09205433152', '', '', NULL, '', NULL),
(53, '2023-07-04', 'Freddie', 'Freddie', 'Freddie', 'santiago', 'customer', 0, 'freddiemarkbs@gmail.com', '09123456782', '', '', NULL, '0', NULL),
(54, '2023-07-07', 'Auifrvqs123', 'Auifrvqs123', 'joshua', 'padilla', 'customer', 0, 'andersonandy446@gmail.com', '09770987020', '', 'Region III (Central Luzon) Bulacan Marilao Santa Rosa II tibagan looban', NULL, '0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `cart_prod_id` int(11) NOT NULL,
  `cart_user_id` int(11) NOT NULL,
  `cart_prodQty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `cart_prod_id`, `cart_user_id`, `cart_prodQty`) VALUES
(692, 100, 19, 6);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `critical_level` int(11) NOT NULL,
  `category_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `critical_level`, `category_status`) VALUES
(1, 'Accessoriess', 5, 1),
(2, 'Foods', 5, 1),
(3, 'Medicines', 4, 1),
(18, 'sample', 12, 0),
(19, 'Sample', 2, 0),
(20, 'Sample', 2, 1),
(21, 'Sample 2', 12, 1),
(22, 'Sample 3', 12, 1),
(23, 'Medicine', 5, 1),
(24, 'Category 5', 5, 1),
(25, 'category 5', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `discount_id` int(11) NOT NULL,
  `discount_name` varchar(255) NOT NULL,
  `discount_rate` float NOT NULL,
  `discount_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`discount_id`, `discount_name`, `discount_rate`, `discount_status`) VALUES
(2, 'Senior Citizen Card', 5, 1),
(8, 'Regular Customer', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `maintinance`
--

CREATE TABLE `maintinance` (
  `system_id` int(11) NOT NULL,
  `system_name` varchar(255) NOT NULL,
  `system_banner` varchar(255) NOT NULL,
  `system_logo` varchar(255) NOT NULL,
  `system_content` varchar(255) NOT NULL,
  `system_address` varchar(255) NOT NULL,
  `system_contact` varchar(255) NOT NULL,
  `system_tax` float NOT NULL,
  `system_shipfee` double NOT NULL,
  `system_fb` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `maintinance`
--

INSERT INTO `maintinance` (`system_id`, `system_name`, `system_banner`, `system_logo`, `system_content`, `system_address`, `system_contact`, `system_tax`, `system_shipfee`, `system_fb`) VALUES
(1, 'RDPOS', 'cover.jpg', 'logo.png', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quaerat, error esse, eos necessitatibus saepe temporibus aliquam aperiam quas reiciendis possimus laborum voluptates magni ad. Quam tempore officiis eligendi sed aut!', 'Paso bagbaguin near highway road Sta.Maria Bulacanss', '09123456787', 0.12, 300, 'https://web.facebook.com/messages/t/100002036471968');

-- --------------------------------------------------------

--
-- Table structure for table `mode_of_payment`
--

CREATE TABLE `mode_of_payment` (
  `payment_id` int(11) NOT NULL,
  `payment_name` varchar(255) NOT NULL,
  `payment_number` varchar(255) NOT NULL,
  `payment_image` varchar(255) DEFAULT NULL,
  `payment_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mode_of_payment`
--

INSERT INTO `mode_of_payment` (`payment_id`, `payment_name`, `payment_number`, `payment_image`, `payment_status`) VALUES
(1, 'Gcash', '09454454744', 'gcash.jpg', 1),
(2, 'Maya', '09074637830', '367247243_960657671789985_5682591977014890192_n.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orders_id` int(11) NOT NULL,
  `order_transaction_code` varchar(8) NOT NULL,
  `orders_prod_id` int(11) NOT NULL,
  `orders_customer_id` int(11) NOT NULL,
  `orders_nickname` varchar(255) NOT NULL,
  `orders_email` varchar(255) NOT NULL,
  `orders_contact` varchar(255) NOT NULL,
  `orders_paymethod` varchar(255) NOT NULL,
  `orders_proof` varchar(255) DEFAULT NULL,
  `orders_qty` int(11) NOT NULL,
  `orders_stock_id` int(11) NOT NULL,
  `orders_prod_price` double NOT NULL,
  `orders_subtotal` double NOT NULL,
  `orders_ship_fee` double NOT NULL,
  `orders_tax` float NOT NULL,
  `orders_voucher_name` varchar(255) DEFAULT NULL,
  `orders_voucher_rate` varchar(255) DEFAULT NULL,
  `orders_address` varchar(255) NOT NULL,
  `orders_date` datetime NOT NULL,
  `orders_dates_delivered` datetime DEFAULT NULL,
  `orders_status` varchar(255) NOT NULL,
  `display_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orders_id`, `order_transaction_code`, `orders_prod_id`, `orders_customer_id`, `orders_nickname`, `orders_email`, `orders_contact`, `orders_paymethod`, `orders_proof`, `orders_qty`, `orders_stock_id`, `orders_prod_price`, `orders_subtotal`, `orders_ship_fee`, `orders_tax`, `orders_voucher_name`, `orders_voucher_rate`, `orders_address`, `orders_date`, `orders_dates_delivered`, `orders_status`, `display_status`) VALUES
(688, 'RD19445', 100, 52, 'Zyrine', 'andyanderson895@yahoo.com', '09205433152', '1', '357620400_1541992679669022_5512093646833525486_n.jpg', 6, 138, 13, 78, 300, 0.02, 'sample voucher', '50%', 'ysmael sta.rosa 2 marilao bulacan', '2023-08-13 12:33:00', NULL, 'Preparing', 0),
(689, 'RD19445', 100, 52, 'Zyrine', 'andyanderson895@yahoo.com', '09205433152', '1', '357620400_1541992679669022_5512093646833525486_n.jpg', 4, 138, 13, 52, 300, 0.02, 'sample voucher', '50%', 'ysmael sta.rosa 2 marilao bulacan', '2023-08-13 12:33:00', NULL, 'Preparing', 0),
(690, 'RD19445', 100, 52, 'Zyrine', 'andyanderson895@yahoo.com', '09205433152', '1', '357620400_1541992679669022_5512093646833525486_n.jpg', 8, 140, 13, 104, 300, 0.02, 'sample voucher', '50%', 'ysmael sta.rosa 2 marilao bulacan', '2023-08-13 12:33:00', NULL, 'Preparing', 0),
(691, 'RD19445', 100, 52, 'Zyrine', 'andyanderson895@yahoo.com', '09205433152', '1', '357620400_1541992679669022_5512093646833525486_n.jpg', 5, 139, 13, 65, 300, 0.02, 'sample voucher', '50%', 'ysmael sta.rosa 2 marilao bulacan', '2023-08-13 12:33:00', NULL, 'Preparing', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pos_cart`
--

CREATE TABLE `pos_cart` (
  `pos_cart_id` int(11) NOT NULL,
  `pos_cart_prod_id` int(11) NOT NULL,
  `pos_cart_user_id` int(11) NOT NULL,
  `cart_prodQty` int(11) NOT NULL,
  `subtotal` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pos_orders`
--

CREATE TABLE `pos_orders` (
  `orders_orders_id` int(11) NOT NULL,
  `orders_tcode` varchar(8) NOT NULL,
  `orders_prod_id` int(10) NOT NULL,
  `orders_cart_id` int(11) NOT NULL,
  `orders_prodQty` int(11) NOT NULL,
  `orders_discount` int(11) DEFAULT NULL,
  `orders_discount_name` varchar(255) DEFAULT NULL,
  `orders_tax` double NOT NULL,
  `orders_date` datetime NOT NULL,
  `orders_final` double NOT NULL,
  `orders_payment` double NOT NULL,
  `orders_change` double NOT NULL,
  `orders_user_id` int(11) NOT NULL,
  `orders_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pos_orders`
--

INSERT INTO `pos_orders` (`orders_orders_id`, `orders_tcode`, `orders_prod_id`, `orders_cart_id`, `orders_prodQty`, `orders_discount`, `orders_discount_name`, `orders_tax`, `orders_date`, `orders_final`, `orders_payment`, `orders_change`, `orders_user_id`, `orders_status`) VALUES
(390, 'RD46875', 99, 239, 5, 0, '', 0.03, '2023-06-24 07:20:00', 236.9, 300, 63.1, 31, 0),
(391, 'RD95746', 96, 240, 3, 0, '', 0.03, '2023-06-26 09:08:00', 341.96, 500, 158.04, 31, 0),
(392, 'RD95746', 99, 241, 2, 0, '', 0.03, '2023-06-26 09:08:00', 341.96, 500, 158.04, 31, 0),
(397, 'RD34199', 99, 244, 3, 0, '', 0.03, '2023-06-26 09:20:00', 1625.34, 2000, 374.66, 31, 0),
(398, 'RD34199', 98, 245, 4, 0, '', 0.03, '2023-06-26 09:20:00', 1625.34, 2000, 374.66, 31, 0),
(399, 'RD33410', 96, 248, 5, 5, 'Senior Citizen Card', 0.03, '2023-07-01 10:12:00', 78.4, 100, 21.6, 31, 0),
(400, 'RD05842', 96, 249, 3, 5, 'Senior Citizen Card', 0.03, '2023-07-01 11:33:00', 234.84, 1000, 765.16, 31, 0),
(401, 'RD90051', 99, 250, 2, 2, 'SUKI CARD', 0.01, '2023-07-04 08:15:00', 882.9, 1000, 117.1, 31, 0),
(402, 'RD90051', 96, 251, 10, 2, 'SUKI CARD', 0.01, '2023-07-04 08:15:00', 882.9, 1000, 117.1, 31, 0),
(403, 'RD72627', 96, 262, 5, 0, '', 0.01, '2023-07-16 03:43:00', 443.39, 1000, 556.61, 31, 0),
(404, 'RD72627', 100, 263, 3, 0, '', 0.01, '2023-07-16 03:43:00', 443.39, 1000, 556.61, 31, 0),
(405, 'RD03209', 96, 262, 5, 0, '', 0.01, '2023-07-16 03:43:00', 443.39, 1000, 556.61, 31, 0),
(406, 'RD03209', 100, 263, 3, 0, '', 0.01, '2023-07-16 03:43:00', 443.39, 1000, 556.61, 31, 0),
(407, 'RD12489', 96, 264, 2, 0, '', 0.01, '2023-07-16 03:53:00', 939.3, 1000, 60.7, 31, 0),
(408, 'RD12489', 98, 265, 2, 0, '', 0.01, '2023-07-16 03:53:00', 939.3, 1000, 60.7, 31, 0),
(409, 'RD12489', 101, 266, 1, 0, '', 0.01, '2023-07-16 03:53:00', 939.3, 1000, 60.7, 31, 0),
(410, 'RD12489', 100, 267, 1, 0, '', 0.01, '2023-07-16 03:53:00', 939.3, 1000, 60.7, 31, 0),
(411, 'RD76015', 98, 268, 2, 2, 'SUKI CARD', 0.01, '2023-07-23 10:01:00', 737.4, 1000, 262.6, 31, 0),
(412, 'RD76015', 100, 269, 1, 2, 'SUKI CARD', 0.01, '2023-07-23 10:01:00', 737.4, 1000, 262.6, 31, 0),
(413, 'RD58905', 100, 277, 1, 2, 'SUKI CARD', 0.01, '2023-07-24 07:23:00', 399.88, 500, 100.12, 31, 0),
(414, 'RD58905', 101, 278, 1, 2, 'SUKI CARD', 0.01, '2023-07-24 07:23:00', 399.88, 500, 100.12, 31, 0),
(415, 'RD58905', 98, 279, 1, 2, 'SUKI CARD', 0.01, '2023-07-24 07:23:00', 399.88, 500, 100.12, 31, 0),
(416, 'RD65918', 98, 280, 5, 2, 'SUKI CARD', 0.01, '2023-07-24 10:24:00', 1936.05, 2000, 63.95, 31, 0),
(417, 'RD65918', 101, 281, 4, 2, 'SUKI CARD', 0.01, '2023-07-24 10:24:00', 1936.05, 2000, 63.95, 31, 0),
(418, 'RD65918', 100, 282, 2, 2, 'SUKI CARD', 0.01, '2023-07-24 10:24:00', 1936.05, 2000, 63.95, 31, 0),
(419, 'RD42223', 98, 280, 5, 2, 'SUKI CARD', 0.01, '2023-07-24 10:24:00', 1936.05, 2000, 63.95, 31, 0),
(420, 'RD42223', 101, 281, 4, 2, 'SUKI CARD', 0.01, '2023-07-24 10:24:00', 1936.05, 2000, 63.95, 31, 0),
(421, 'RD42223', 100, 282, 2, 2, 'SUKI CARD', 0.01, '2023-07-24 10:24:00', 1936.05, 2000, 63.95, 31, 0),
(422, 'RD61393', 98, 285, 3, 0, '', 0.01, '2023-08-07 09:02:00', 739.32, 1000, 260.68, 31, 0),
(423, 'RD70820', 98, 286, 1, 0, '', 0.01, '2023-08-07 09:03:00', 753.46, 1000, 246.54, 31, 0),
(424, 'RD70820', 99, 287, 2, 0, '', 0.01, '2023-08-07 09:03:00', 753.46, 1000, 246.54, 31, 0),
(425, 'RD70820', 100, 288, 1, 0, '', 0.01, '2023-08-07 09:03:00', 753.46, 1000, 246.54, 31, 0),
(426, 'RD70820', 101, 289, 3, 0, '', 0.01, '2023-08-07 09:03:00', 753.46, 1000, 246.54, 31, 0),
(427, 'RD70820', 104, 290, 2, 0, '', 0.01, '2023-08-07 09:03:00', 753.46, 1000, 246.54, 31, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pos_transaction`
--

CREATE TABLE `pos_transaction` (
  `transaction_no` int(11) NOT NULL,
  `transaction_code` varchar(255) DEFAULT NULL,
  `transaction_cart_id` int(11) DEFAULT NULL,
  `transaction_prod_id` int(11) DEFAULT NULL,
  `transaction_user_id` int(11) DEFAULT NULL,
  `transaction_prodQty` int(11) DEFAULT NULL,
  `transaction_subtotal` decimal(10,2) DEFAULT NULL,
  `transaction_discount` decimal(10,2) DEFAULT NULL,
  `transaction_tax` decimal(10,2) DEFAULT NULL,
  `transaction_total` decimal(10,2) DEFAULT NULL,
  `transaction_payment` varchar(255) DEFAULT NULL,
  `transaction_change` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pos_transaction`
--

INSERT INTO `pos_transaction` (`transaction_no`, `transaction_code`, `transaction_cart_id`, `transaction_prod_id`, `transaction_user_id`, `transaction_prodQty`, `transaction_subtotal`, `transaction_discount`, `transaction_tax`, `transaction_total`, `transaction_payment`, `transaction_change`) VALUES
(23, 'RD07244', 968, 182, 31, 1, 256.00, 12.80, 29.18, 243.20, '250', 6.80),
(24, 'RD07244', 969, 180, 31, 2, 256.00, 12.80, 29.18, 243.20, '250', 6.80),
(25, 'RD07244', 970, 177, 31, 2, 256.00, 12.80, 29.18, 243.20, '250', 6.80),
(26, 'RD98949', 972, 177, 31, 2, 100.00, 0.00, 12.00, 100.00, '100', 0.00),
(27, 'RD29964', 973, 182, 31, 1, 72.00, 3.60, 8.21, 68.40, '70', 1.60),
(28, 'RD29964', 974, 179, 31, 2, 72.00, 3.60, 8.21, 68.40, '70', 1.60),
(30, 'RD16193', 975, 182, 31, 1, 371.50, 18.57, 42.35, 352.93, '360', 7.07),
(31, 'RD16193', 976, 184, 31, 5, 371.50, 18.57, 42.35, 352.93, '360', 7.07),
(32, 'RD16193', 977, 179, 31, 2, 371.50, 18.57, 42.35, 352.93, '360', 7.07),
(33, 'RD16193', 978, 180, 31, 4, 371.50, 18.57, 42.35, 352.93, '360', 7.07),
(37, 'RD01887', 979, 184, 31, 1, 323.50, 16.18, 36.88, 307.32, '310', 2.68),
(38, 'RD01887', 980, 183, 31, 2, 323.50, 16.18, 36.88, 307.32, '310', 2.68),
(39, 'RD01887', 981, 177, 31, 2, 323.50, 16.18, 36.88, 307.32, '310', 2.68),
(40, 'RD01887', 982, 178, 31, 1, 323.50, 16.18, 36.88, 307.32, '310', 2.68),
(41, 'RD01887', 983, 181, 31, 1, 323.50, 16.18, 36.88, 307.32, '310', 2.68),
(42, 'RD01887', 984, 179, 31, 1, 323.50, 16.18, 36.88, 307.32, '310', 2.68),
(44, 'RD30768', 985, 182, 31, 1, 212.00, 0.00, 25.44, 212.00, '215', 3.00),
(45, 'RD30768', 986, 183, 31, 1, 212.00, 0.00, 25.44, 212.00, '215', 3.00),
(46, 'RD30768', 987, 180, 31, 2, 212.00, 0.00, 25.44, 212.00, '215', 3.00),
(47, 'RD07532', 988, 183, 31, 2, 164.00, 0.00, 19.68, 164.00, '170', 6.00),
(48, 'RD07532', 989, 179, 31, 2, 164.00, 0.00, 19.68, 164.00, '170', 6.00),
(49, 'RD00417', 990, 184, 31, 2, 147.00, 0.00, 17.64, 147.00, '150', 3.00),
(50, 'RD00417', 991, 180, 31, 2, 147.00, 0.00, 17.64, 147.00, '150', 3.00),
(52, 'RD08230', 992, 184, 31, 2, 123.00, 0.00, 14.76, 123.00, '130', 7.00),
(53, 'RD08230', 993, 183, 31, 2, 123.00, 0.00, 14.76, 123.00, '130', 7.00),
(55, 'RD76042', 994, 184, 31, 5, 27.50, 1.38, 3.13, 26.13, '50', 23.87),
(56, 'RD17808', 995, 184, 31, 1, 255.50, 12.78, 29.13, 242.72, '250', 7.28),
(57, 'RD17808', 996, 179, 31, 2, 255.50, 12.78, 29.13, 242.72, '250', 7.28),
(58, 'RD17808', 997, 177, 31, 2, 255.50, 12.78, 29.13, 242.72, '250', 7.28),
(59, 'RD17808', 998, 180, 31, 1, 255.50, 12.78, 29.13, 242.72, '250', 7.28),
(60, 'RD17808', 999, 181, 31, 2, 255.50, 12.78, 29.13, 242.72, '250', 7.28),
(63, 'RD30694', 1001, 182, 31, 1, 20.00, 0.00, 2.40, 20.00, '20', 0.00),
(64, 'RD88965', 1004, 184, 31, 2, 11.00, 0.55, 1.25, 10.45, '20', 9.55);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `prod_id` int(11) NOT NULL,
  `prod_code` varchar(11) NOT NULL,
  `prod_name` varchar(255) NOT NULL,
  `prod_orgprice` varchar(255) NOT NULL,
  `prod_currprice` varchar(255) NOT NULL,
  `prod_unit_id` int(11) NOT NULL,
  `prod_category_id` int(11) NOT NULL,
  `prod_description` varchar(255) DEFAULT NULL,
  `prod_image` varchar(255) DEFAULT NULL,
  `prod_added` varchar(255) NOT NULL,
  `prod_edit` varchar(255) DEFAULT NULL,
  `prod_status` int(11) NOT NULL,
  `barcode` varchar(50) NOT NULL,
  `c_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prod_id`, `prod_code`, `prod_name`, `prod_orgprice`, `prod_currprice`, `prod_unit_id`, `prod_category_id`, `prod_description`, `prod_image`, `prod_added`, `prod_edit`, `prod_status`, `barcode`, `c_level`) VALUES
(175, 'PROD22491', 'Apralyte', '60', '65', 24, 1, 'Medicine', '../uploads/images/Apralyte.jpg', '2023-10-30 13:12:25', '2023-10-30 13:12:25', 0, 'PROD22491.png', 50),
(176, 'PROD53374', 'B-Meg Enertone', '550', '560', 24, 1, 'Foods', '../uploads/images/B-MEG Enertone.jpg', '2023-10-30 13:13:32', '2023-10-30 13:13:32', 0, 'PROD53374.png', 5),
(177, 'PROD82462', 'Beef Teriyaki', '45', '50', 25, 1, 'Foods', '../uploads/images/Beef Teriyaki.jpg', '2023-10-30 13:15:22', '2023-10-30 13:15:22', 0, 'PROD82462.png', 5),
(178, 'PROD05884', 'Chewing Toy Bone Small', '60', '65', 25, 2, 'Dog STuff', '../uploads/images/Chewing toy bone -small.jpg', '2023-10-30 13:17:11', '2023-10-30 13:17:11', 0, 'PROD05884.png', 5),
(179, 'PROD60908', 'Belymyl 10ml', '25', '26', 24, 2, 'Medicine', '../uploads/images/Belamyl 10ml.jpg', '2023-10-30 13:20:16', '2023-10-30 13:20:16', 0, 'PROD60908.png', 12),
(180, 'PROD52157', 'Top Breed Adult', '67', '68', 24, 2, 'sample', '../uploads/images/Top Breed Adult.jpg', '2023-10-30 13:20:58', '2023-10-30 13:20:58', 0, 'PROD52157.png', 5),
(181, 'PROD54505', 'Hush Pet Diaper', '12', '15', 24, 2, 'sample', '../uploads/images/Hushpet diaper.jpg', '2023-10-30 13:21:44', '2023-10-30 13:21:44', 0, 'PROD54505.png', 5),
(182, 'PROD09379', 'Vetracin Classic ', '15', '20', 24, 2, 'Medicine', '../uploads/images/Vetracin classic.jpg', '2023-10-30 13:22:50', '2023-11-06 01:40:45', 0, 'PROD09379.png', 12),
(183, 'PROD30097', 'Breeder Ade', '55', '56', 26, 2, 'sample', '../uploads/images/Breeder ade.jpg', '2023-10-30 13:24:01', '2023-10-30 13:24:01', 0, 'PROD30097.png', 5),
(184, 'PROD42210', 'Fenbendazolesas ', '5', '5.5', 24, 19, 'sample', '../uploads/images/Fenbendazole.jpg', '2023-10-30 13:24:44', '2023-11-05 20:05:26', 0, 'PROD42210.png', 12),
(185, 'PROD40760', 'Dog Cagef', '500', '550', 17, 1, 'sample', '../uploads/images/Dog cage.jpg', '2023-11-06 21:52:13', '2023-11-06 21:56:58', 0, 'PROD40760.png', 5);

-- --------------------------------------------------------

--
-- Table structure for table `returns_pos`
--

CREATE TABLE `returns_pos` (
  `ret_id` int(11) NOT NULL,
  `ret_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ret_datepurchase` datetime NOT NULL,
  `ret_transaction_code` varchar(8) NOT NULL,
  `ret_product_code` varchar(11) NOT NULL,
  `ret_qty` int(11) NOT NULL,
  `ret_request` varchar(255) NOT NULL,
  `ret_reason` varchar(255) NOT NULL,
  `ret_customer_name` varchar(255) NOT NULL,
  `ret_contact_number` varchar(255) NOT NULL,
  `ret_address` varchar(255) NOT NULL,
  `ret_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `returns_pos`
--

INSERT INTO `returns_pos` (`ret_id`, `ret_date`, `ret_datepurchase`, `ret_transaction_code`, `ret_product_code`, `ret_qty`, `ret_request`, `ret_reason`, `ret_customer_name`, `ret_contact_number`, `ret_address`, `ret_status`) VALUES
(195, '2023-07-25 16:31:16', '2023-07-24 10:24:00', 'RD42223', 'PROD21387', 1, 'return', 'wrong item', 'joshua anderson padilla', '09454454744', 'sta.rosa 2 marilao bulacan', 0),
(197, '2023-08-07 13:04:32', '2023-08-07 09:03:00', 'RD70820', 'PROD21387', 1, 'return', 'invalid', 'joshua raymundo padilla', '09770987020', 'Sta.Rosa 2 Marilao Bulacan', 0),
(198, '2023-08-07 13:05:27', '2023-08-07 09:03:00', 'RD70820', 'PROD66826', 0, 'return', 'invalid', 'joshua raymundo padilla', '09770987020', 'Sta.Rosa 2 Marilao Bulacan', 0),
(199, '2023-08-07 13:05:27', '2023-08-07 09:03:00', 'RD70820', 'PROD06056', 2, 'return', 'invalid', 'joshua raymundo padilla', '09770987020', 'Sta.Rosa 2 Marilao Bulacan', 0),
(200, '2023-08-07 13:05:54', '2023-08-07 09:03:00', 'RD70820', 'PROD66826', 0, 'return', 'invalid', 'joshua raymundo padilla', '09770987020', 'Sta.Rosa 2 Marilao Bulacan', 0);

-- --------------------------------------------------------

--
-- Table structure for table `return_ordering`
--

CREATE TABLE `return_ordering` (
  `ret_ol_id` int(11) NOT NULL,
  `ret_ol_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ret_ol_datepurchase` datetime NOT NULL,
  `ret_ol_transaction_code` varchar(8) NOT NULL,
  `ret_ol_product_code` varchar(11) NOT NULL,
  `ret_ol_qty` int(11) NOT NULL,
  `ret_ol_request` varchar(255) NOT NULL,
  `ret_ol_paymethod` varchar(255) NOT NULL,
  `ret_ol_reason` varchar(255) NOT NULL,
  `ret_ol_customer_name` varchar(255) NOT NULL,
  `ret_ol_contact_number` varchar(255) NOT NULL,
  `ret_ol_address` varchar(255) NOT NULL,
  `ret_ol_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `return_ordering`
--

INSERT INTO `return_ordering` (`ret_ol_id`, `ret_ol_date`, `ret_ol_datepurchase`, `ret_ol_transaction_code`, `ret_ol_product_code`, `ret_ol_qty`, `ret_ol_request`, `ret_ol_paymethod`, `ret_ol_reason`, `ret_ol_customer_name`, `ret_ol_contact_number`, `ret_ol_address`, `ret_ol_status`) VALUES
(4, '2023-07-26 04:28:20', '0000-00-00 00:00:00', 'RD18284', 'PROD20211', 27, 'return', '', 'invalid', 'new new new', '09454454744', 'sta.rosa 2 marilao bulacan', 0);

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `s_id` int(11) NOT NULL,
  `s_created` date NOT NULL DEFAULT current_timestamp(),
  `s_expiration` date NOT NULL,
  `s_prod_id` int(11) NOT NULL,
  `s_amount` int(11) NOT NULL,
  `s_amount_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`s_id`, `s_created`, `s_expiration`, `s_prod_id`, `s_amount`, `s_amount_number`) VALUES
(138, '2023-08-13', '2023-08-14', 100, 0, 0),
(139, '2023-08-13', '2023-08-17', 100, 10, 0),
(140, '2023-08-13', '2023-08-15', 100, 10, 0),
(141, '2023-08-13', '0000-00-00', 105, 50, 0),
(142, '2023-08-13', '0000-00-00', 104, 10, 0),
(143, '2023-10-22', '2023-10-22', 146, 5, 0),
(144, '2023-10-22', '2023-10-22', 146, 10, 0),
(145, '2023-10-22', '2023-10-22', 146, 10, 0),
(146, '2023-10-22', '2023-10-22', 146, 23, 0),
(147, '2023-10-22', '2023-10-22', 144, 5, 0),
(148, '2023-10-22', '2023-10-22', 145, 5, 0),
(149, '2023-10-22', '2023-10-22', 142, 3, 0),
(150, '2023-10-22', '2023-10-22', 142, 4, 0),
(151, '2023-10-22', '2023-10-22', 133, 3, 0),
(152, '2023-10-22', '2023-10-22', 132, 12, 0),
(153, '2023-10-22', '2023-10-22', 131, 12, 0),
(154, '2023-10-22', '2023-10-22', 132, 3, 0),
(155, '2023-10-22', '2023-10-22', 130, 12, 0),
(156, '2023-10-22', '2023-10-22', 146, 12, 0),
(157, '2023-10-22', '2023-10-22', 146, 12, 0),
(158, '2023-10-22', '2023-10-22', 145, 10, 0),
(159, '2023-10-22', '2023-10-22', 144, 12, 0),
(160, '2023-10-22', '2023-10-22', 144, 12, 0),
(161, '2023-10-22', '2023-10-22', 144, 12, 0),
(162, '2023-10-22', '2023-10-22', 142, 100, 0),
(163, '2023-10-22', '2023-10-22', 129, 10, 0),
(164, '2023-10-22', '2023-10-22', 128, 12, 0),
(165, '2023-10-22', '2023-10-22', 127, 18, 0),
(166, '2023-10-22', '2023-10-22', 133, 10, 0),
(167, '2023-10-22', '2023-10-22', 130, 3, 0),
(168, '2023-10-22', '2023-10-22', 127, 2, 0),
(169, '2023-10-22', '2023-10-22', 149, 12, 0),
(170, '2023-10-22', '2023-10-22', 148, 5, 0),
(171, '2023-10-22', '2023-10-22', 148, 5, 0),
(172, '2023-10-22', '2023-10-22', 148, 5, 0),
(173, '2023-10-22', '2023-10-22', 150, 5, 0),
(174, '2023-10-22', '2023-10-22', 150, 5, 0),
(175, '2023-10-22', '2023-10-22', 150, 5, 0),
(176, '2023-10-22', '2023-10-22', 152, 12, 0),
(177, '2023-10-22', '2023-10-22', 127, 12, 0),
(178, '2023-10-22', '2023-10-22', 127, 12, 0),
(179, '2023-10-22', '2023-10-22', 128, 12, 0),
(180, '2023-10-23', '2023-10-23', 154, 12, 0),
(181, '2023-10-23', '2023-10-23', 154, 1, 0),
(182, '2023-10-23', '2023-10-23', 152, 1, 0),
(183, '2023-10-23', '2023-10-23', 154, 5, 0),
(184, '2023-10-23', '2023-10-23', 156, 12, 0),
(185, '2023-10-24', '2023-10-24', 156, 0, 0),
(186, '2023-10-24', '2023-10-24', 156, 0, 0),
(187, '2023-10-24', '2023-10-24', 156, 0, 0),
(188, '2023-10-25', '2023-10-25', 156, 5, 0),
(189, '2023-10-25', '2023-10-25', 154, 12, 0),
(190, '2023-10-25', '2023-10-25', 154, 12, 0),
(191, '2023-10-26', '2023-10-26', 152, 12, 0),
(192, '2023-10-26', '2023-10-26', 152, 12, 0),
(193, '2023-10-27', '2023-10-27', 144, 5, 0),
(194, '2023-10-27', '2023-10-27', 144, 5, 0),
(195, '2023-10-27', '2023-10-27', 161, 12, 0),
(196, '2023-10-27', '2023-10-31', 127, 12, 0),
(197, '2023-10-27', '2023-10-31', 127, 12, 0),
(198, '2023-10-27', '2023-10-30', 127, 5, 0),
(199, '2023-10-27', '2023-10-29', 127, 12, 12),
(200, '2023-10-27', '2023-08-24', 127, 5, 5),
(201, '2023-10-27', '0000-00-00', 0, 5, 5),
(202, '2023-10-27', '2023-10-30', 161, 12, 12),
(203, '2023-10-27', '2023-10-31', 161, 6, 6),
(204, '2023-10-27', '0000-00-00', 161, 13, 13),
(205, '2023-10-27', '0000-00-00', 161, 13, 13),
(206, '2023-10-27', '0000-00-00', 161, 13, 13),
(207, '2023-10-27', '2023-10-30', 161, 13, 13),
(208, '2023-10-27', '0000-00-00', 161, 1, 1),
(209, '2023-10-27', '2023-10-30', 161, 5, 5),
(210, '2023-10-27', '2023-10-30', 161, 5, 5),
(211, '2023-10-27', '2023-10-30', 161, 5, 5),
(212, '2023-10-27', '0000-00-00', 161, 1, 1),
(213, '2023-10-27', '2023-10-30', 161, 1, 1),
(214, '2023-10-27', '0000-00-00', 161, 12, 12),
(215, '2023-10-27', '0000-00-00', 161, 12, 12),
(216, '2023-10-27', '2023-11-09', 161, 51, 51),
(217, '2023-10-27', '2023-11-09', 161, 51, 51),
(218, '2023-10-27', '0000-00-00', 161, 1, 1),
(219, '2023-10-27', '2023-11-01', 161, 0, 0),
(220, '2023-10-27', '0000-00-00', 132, 1, 1),
(221, '2023-10-27', '0000-00-00', 132, 1, 1),
(222, '2023-10-27', '2023-11-16', 162, 5, 5),
(223, '2023-10-27', '2023-11-24', 163, 5, 5),
(224, '2023-10-27', '2023-10-31', 163, 12, 12),
(225, '2023-10-27', '0000-00-00', 163, 12, 12),
(226, '2023-10-27', '0000-00-00', 163, 12, 12),
(227, '2023-10-28', '2023-10-31', 164, 5, 5),
(228, '2023-10-28', '2023-11-09', 165, 5, 5),
(229, '2023-10-28', '2023-11-09', 166, 12, 12),
(230, '2023-10-28', '2023-11-10', 167, 23, 23),
(231, '2023-10-28', '2023-11-01', 168, 25, 25),
(232, '2023-10-28', '2023-11-07', 169, 20, 20),
(233, '2023-10-28', '2023-11-17', 170, 20, 20),
(234, '2023-10-28', '2023-10-30', 173, 12, 12),
(235, '2023-10-28', '2023-11-02', 173, 5, 5),
(236, '2023-10-28', '2023-10-30', 172, 5, 5),
(237, '2023-10-30', '2023-10-31', 184, 5, 5),
(238, '2023-10-30', '2023-11-09', 184, 12, 12),
(239, '2023-10-30', '2023-11-10', 184, 5, 5),
(240, '2023-11-01', '2023-11-29', 183, 2, 2),
(241, '2023-11-01', '2023-11-29', 177, 2, 2),
(242, '2023-11-01', '2023-11-16', 182, 1, 1),
(243, '2023-11-01', '2023-11-30', 181, 5, 5),
(244, '2023-11-01', '2023-11-23', 180, 5, 5),
(245, '2023-11-01', '2023-12-07', 178, 34, 34),
(246, '2023-11-02', '2023-11-28', 179, 2, 2),
(247, '2023-11-06', '2023-11-22', 185, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `system_log`
--

CREATE TABLE `system_log` (
  `sys_id` int(11) NOT NULL,
  `sys_user_id` int(11) NOT NULL,
  `sys_login` datetime NOT NULL,
  `sys_logout` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_log`
--

INSERT INTO `system_log` (`sys_id`, `sys_user_id`, `sys_login`, `sys_logout`) VALUES
(98, 31, '2023-06-13 04:57:00', '2023-08-22 01:26:00'),
(100, 16, '2023-06-14 08:54:00', NULL),
(101, 31, '2023-06-14 08:55:00', '2023-08-22 01:26:00'),
(102, 16, '2023-06-14 08:56:00', NULL),
(103, 16, '2023-06-15 01:27:00', NULL),
(104, 16, '2023-06-15 02:33:00', NULL),
(105, 16, '2023-06-15 03:37:00', NULL),
(106, 31, '2023-06-15 07:33:00', '2023-08-22 01:26:00'),
(107, 16, '2023-06-15 09:41:00', NULL),
(108, 31, '2023-06-15 09:42:00', '2023-08-22 01:26:00'),
(109, 16, '2023-06-15 09:45:00', NULL),
(110, 16, '2023-06-16 09:33:00', NULL),
(111, 31, '2023-06-16 09:33:00', '2023-08-22 01:26:00'),
(112, 16, '2023-06-16 12:46:00', NULL),
(113, 16, '2023-06-16 07:27:00', NULL),
(114, 16, '2023-06-17 12:15:00', NULL),
(115, 35, '2023-06-17 12:17:00', '2023-06-27 02:18:00'),
(116, 31, '2023-06-17 09:19:00', '2023-08-22 01:26:00'),
(117, 33, '2023-06-17 10:21:00', '2023-08-02 08:22:00'),
(118, 16, '2023-06-17 12:08:00', NULL),
(119, 35, '2023-06-17 04:05:00', '2023-06-27 02:18:00'),
(120, 16, '2023-06-17 05:05:00', NULL),
(121, 16, '2023-06-17 09:10:00', NULL),
(122, 19, '2023-06-17 09:11:00', NULL),
(123, 16, '2023-06-17 10:06:00', NULL),
(124, 31, '2023-06-17 10:10:00', '2023-08-22 01:26:00'),
(125, 16, '2023-06-17 10:40:00', NULL),
(126, 33, '2023-06-18 12:41:00', '2023-08-02 08:22:00'),
(127, 19, '2023-06-18 12:42:00', NULL),
(128, 16, '2023-06-18 03:16:00', NULL),
(129, 16, '2023-06-18 09:25:00', NULL),
(130, 19, '2023-06-18 09:25:00', NULL),
(131, 33, '2023-06-18 01:19:00', '2023-08-02 08:22:00'),
(132, 31, '2023-06-18 06:54:00', '2023-08-22 01:26:00'),
(133, 16, '2023-06-18 06:55:00', NULL),
(134, 35, '2023-06-19 07:54:00', '2023-06-27 02:18:00'),
(135, 16, '2023-06-19 08:58:00', NULL),
(136, 35, '2023-06-19 12:40:00', '2023-06-27 02:18:00'),
(137, 16, '2023-06-19 08:34:00', NULL),
(138, 35, '2023-06-20 01:36:00', '2023-06-27 02:18:00'),
(139, 35, '2023-06-20 01:36:00', '2023-06-27 02:18:00'),
(140, 19, '2023-06-20 06:24:00', NULL),
(141, 16, '2023-06-20 06:25:00', NULL),
(142, 16, '2023-06-20 11:34:00', NULL),
(143, 19, '2023-06-20 11:35:00', NULL),
(144, 16, '2023-06-20 11:35:00', NULL),
(145, 33, '2023-06-20 11:36:00', '2023-08-02 08:22:00'),
(146, 19, '2023-06-21 05:54:00', NULL),
(147, 31, '2023-06-21 05:54:00', '2023-08-22 01:26:00'),
(148, 35, '2023-06-21 06:02:00', '2023-06-27 02:18:00'),
(149, 35, '2023-06-21 06:41:00', '2023-06-27 02:18:00'),
(150, 16, '2023-06-21 08:58:00', NULL),
(151, 35, '2023-06-21 10:09:00', '2023-06-27 02:18:00'),
(152, 19, '2023-06-21 10:09:00', NULL),
(153, 33, '2023-06-21 10:19:00', '2023-08-02 08:22:00'),
(154, 16, '2023-06-21 10:37:00', NULL),
(155, 19, '2023-06-22 06:52:00', NULL),
(156, 19, '2023-06-22 11:25:00', NULL),
(157, 16, '2023-06-23 08:15:00', NULL),
(158, 19, '2023-06-23 08:15:00', NULL),
(159, 33, '2023-06-23 11:56:00', '2023-08-02 08:22:00'),
(160, 34, '2023-06-23 04:53:00', NULL),
(161, 16, '2023-06-24 08:34:00', NULL),
(162, 31, '2023-06-24 08:52:00', '2023-08-22 01:26:00'),
(163, 19, '2023-06-24 08:56:00', NULL),
(164, 31, '2023-06-24 09:09:00', '2023-08-22 01:26:00'),
(165, 31, '2023-06-24 09:09:00', '2023-08-22 01:26:00'),
(166, 33, '2023-06-24 09:32:00', '2023-08-02 08:22:00'),
(167, 19, '2023-06-24 09:33:00', NULL),
(168, 19, '2023-06-24 09:33:00', NULL),
(169, 33, '2023-06-24 09:34:00', '2023-08-02 08:22:00'),
(170, 34, '2023-06-24 09:49:00', NULL),
(171, 16, '2023-06-24 09:54:00', NULL),
(172, 33, '2023-06-24 10:06:00', '2023-08-02 08:22:00'),
(173, 19, '2023-06-24 10:52:00', NULL),
(174, 19, '2023-06-24 11:33:00', NULL),
(175, 16, '2023-06-24 12:04:00', NULL),
(176, 35, '2023-06-24 12:05:00', '2023-06-27 02:18:00'),
(177, 33, '2023-06-24 12:11:00', '2023-08-02 08:22:00'),
(178, 31, '2023-06-24 12:44:00', '2023-08-22 01:26:00'),
(179, 33, '2023-06-24 12:57:00', '2023-08-02 08:22:00'),
(180, 19, '2023-06-24 03:20:00', NULL),
(181, 35, '2023-06-24 03:21:00', '2023-06-27 02:18:00'),
(182, 16, '2023-06-24 03:21:00', NULL),
(183, 16, '2023-06-24 07:14:00', NULL),
(184, 31, '2023-06-24 07:19:00', '2023-08-22 01:26:00'),
(185, 19, '2023-06-24 09:00:00', NULL),
(186, 33, '2023-06-24 09:02:00', '2023-08-02 08:22:00'),
(187, 19, '2023-06-25 08:52:00', NULL),
(188, 19, '2023-06-25 10:14:00', NULL),
(189, 19, '2023-06-25 11:39:00', NULL),
(190, 16, '2023-06-25 11:43:00', NULL),
(191, 33, '2023-06-25 02:32:00', '2023-08-02 08:22:00'),
(192, 19, '2023-06-25 03:09:00', NULL),
(193, 16, '2023-06-25 04:24:00', NULL),
(194, 16, '2023-06-25 09:10:00', NULL),
(195, 16, '2023-06-26 08:13:00', NULL),
(196, 31, '2023-06-26 09:08:00', '2023-08-22 01:26:00'),
(197, 33, '2023-06-26 10:10:00', '2023-08-02 08:22:00'),
(198, 19, '2023-06-26 10:10:00', NULL),
(199, 34, '2023-06-26 10:19:00', NULL),
(200, 16, '2023-06-26 10:49:00', NULL),
(201, 16, '2023-06-26 10:51:00', NULL),
(202, 16, '2023-06-26 10:51:00', NULL),
(203, 16, '2023-06-26 01:13:00', NULL),
(204, 16, '2023-06-27 08:15:00', NULL),
(205, 16, '2023-06-27 08:15:00', NULL),
(206, 16, '2023-06-27 08:16:00', NULL),
(207, 16, '2023-06-27 08:16:00', NULL),
(208, 19, '2023-06-27 01:59:00', NULL),
(209, 33, '2023-06-27 02:05:00', '2023-08-02 08:22:00'),
(210, 19, '2023-06-27 02:17:00', NULL),
(211, 35, '2023-06-27 02:17:00', '2023-06-27 02:18:00'),
(212, 16, '2023-06-27 02:18:00', NULL),
(213, 16, '2023-06-27 02:41:00', NULL),
(214, 31, '2023-06-27 05:48:00', '2023-08-22 01:26:00'),
(215, 16, '2023-06-28 08:32:00', NULL),
(216, 16, '2023-06-29 11:22:00', NULL),
(217, 16, '2023-06-30 10:24:00', NULL),
(218, 33, '2023-06-30 12:06:00', '2023-08-02 08:22:00'),
(219, 16, '2023-06-30 04:30:00', NULL),
(220, 16, '2023-06-30 10:40:00', NULL),
(221, 19, '2023-06-30 10:40:00', NULL),
(222, 16, '2023-06-30 11:46:00', NULL),
(223, 16, '2023-06-30 11:47:00', NULL),
(224, 16, '2023-06-30 11:51:00', NULL),
(225, 16, '2023-07-01 01:23:00', NULL),
(226, 16, '2023-07-01 01:25:00', NULL),
(227, 16, '2023-07-01 01:27:00', NULL),
(228, 33, '2023-07-01 01:36:00', '2023-08-02 08:22:00'),
(229, 31, '2023-07-01 01:38:00', '2023-08-22 01:26:00'),
(230, 16, '2023-07-01 07:32:00', NULL),
(231, 16, '2023-07-01 07:33:00', NULL),
(232, 31, '2023-07-01 08:12:00', '2023-08-22 01:26:00'),
(233, 16, '2023-07-01 08:22:00', NULL),
(234, 16, '2023-07-01 08:26:00', NULL),
(235, 16, '2023-07-01 08:32:00', NULL),
(236, 16, '2023-07-01 08:39:00', NULL),
(237, 19, '2023-07-01 09:46:00', NULL),
(238, 31, '2023-07-01 10:11:00', '2023-08-22 01:26:00'),
(239, 16, '2023-07-01 10:13:00', NULL),
(240, 52, '2023-07-01 10:42:00', NULL),
(241, 16, '2023-07-01 10:55:00', NULL),
(242, 16, '2023-07-01 10:55:00', NULL),
(243, 16, '2023-07-01 10:58:00', NULL),
(244, 16, '2023-07-01 11:04:00', NULL),
(245, 16, '2023-07-01 11:04:00', NULL),
(246, 52, '2023-07-01 11:05:00', NULL),
(247, 31, '2023-07-01 11:30:00', '2023-08-22 01:26:00'),
(248, 16, '2023-07-01 11:31:00', NULL),
(249, 19, '2023-07-01 11:41:00', NULL),
(250, 16, '2023-07-01 11:43:00', NULL),
(251, 19, '2023-07-01 11:53:00', NULL),
(252, 33, '2023-07-01 12:03:00', '2023-08-02 08:22:00'),
(253, 52, '2023-07-01 01:34:00', NULL),
(254, 16, '2023-07-02 04:27:00', NULL),
(255, 16, '2023-07-02 05:22:00', NULL),
(256, 16, '2023-07-02 09:31:00', NULL),
(257, 16, '2023-07-02 09:34:00', NULL),
(258, 16, '2023-07-04 06:01:00', NULL),
(259, 19, '2023-07-04 06:21:00', NULL),
(260, 16, '2023-07-04 06:22:00', NULL),
(261, 16, '2023-07-04 06:37:00', NULL),
(262, 16, '2023-07-04 07:35:00', NULL),
(263, 16, '2023-07-04 07:44:00', NULL),
(264, 31, '2023-07-04 08:10:00', '2023-08-22 01:26:00'),
(265, 16, '2023-07-04 08:22:00', NULL),
(266, 52, '2023-07-04 08:25:00', NULL),
(267, 53, '2023-07-04 08:27:00', NULL),
(268, 52, '2023-07-04 08:28:00', NULL),
(269, 16, '2023-07-04 08:28:00', NULL),
(270, 16, '2023-07-05 10:23:00', NULL),
(271, 16, '2023-07-05 10:36:00', NULL),
(272, 16, '2023-07-08 12:56:00', NULL),
(273, 19, '2023-07-08 02:47:00', NULL),
(274, 19, '2023-07-08 02:47:00', NULL),
(275, 19, '2023-07-08 03:24:00', NULL),
(276, 16, '2023-07-08 04:17:00', NULL),
(277, 16, '2023-07-09 08:06:00', NULL),
(278, 19, '2023-07-09 08:06:00', NULL),
(279, 16, '2023-07-09 09:09:00', NULL),
(280, 33, '2023-07-09 09:42:00', '2023-08-02 08:22:00'),
(281, 19, '2023-07-09 09:55:00', NULL),
(282, 52, '2023-07-09 11:13:00', NULL),
(283, 19, '2023-07-15 09:32:00', NULL),
(284, 16, '2023-07-15 09:52:00', NULL),
(285, 16, '2023-07-15 11:24:00', NULL),
(286, 31, '2023-07-15 11:25:00', '2023-08-22 01:26:00'),
(287, 16, '2023-07-16 03:13:00', NULL),
(288, 31, '2023-07-16 03:15:00', '2023-08-22 01:26:00'),
(289, 31, '2023-07-16 03:15:00', '2023-08-22 01:26:00'),
(290, 31, '2023-07-16 03:20:00', '2023-08-22 01:26:00'),
(291, 31, '2023-07-16 03:20:00', '2023-08-22 01:26:00'),
(292, 31, '2023-07-16 03:23:00', '2023-08-22 01:26:00'),
(293, 31, '2023-07-16 03:23:00', '2023-08-22 01:26:00'),
(294, 31, '2023-07-16 03:23:00', '2023-08-22 01:26:00'),
(295, 31, '2023-07-16 03:24:00', '2023-08-22 01:26:00'),
(296, 31, '2023-07-16 03:30:00', '2023-08-22 01:26:00'),
(297, 31, '2023-07-18 12:05:00', '2023-08-22 01:26:00'),
(298, 31, '2023-07-18 12:05:00', '2023-08-22 01:26:00'),
(299, 31, '2023-07-20 09:11:00', '2023-08-22 01:26:00'),
(300, 31, '2023-07-20 09:41:00', '2023-08-22 01:26:00'),
(301, 31, '2023-07-20 10:34:00', '2023-08-22 01:26:00'),
(302, 31, '2023-07-20 11:15:00', '2023-08-22 01:26:00'),
(303, 31, '2023-07-21 09:47:00', '2023-08-22 01:26:00'),
(304, 31, '2023-07-21 09:48:00', '2023-08-22 01:26:00'),
(305, 31, '2023-07-21 09:50:00', '2023-08-22 01:26:00'),
(306, 31, '2023-07-21 10:53:00', '2023-08-22 01:26:00'),
(307, 31, '2023-07-21 11:02:00', '2023-08-22 01:26:00'),
(308, 31, '2023-07-21 01:55:00', '2023-08-22 01:26:00'),
(309, 16, '2023-07-21 02:16:00', NULL),
(310, 31, '2023-07-23 09:39:00', '2023-08-22 01:26:00'),
(311, 31, '2023-07-23 09:48:00', '2023-08-22 01:26:00'),
(312, 31, '2023-07-23 09:58:00', '2023-08-22 01:26:00'),
(313, 31, '2023-07-24 06:26:00', '2023-08-22 01:26:00'),
(314, 31, '2023-07-24 06:26:00', '2023-08-22 01:26:00'),
(315, 31, '2023-07-24 06:30:00', '2023-08-22 01:26:00'),
(316, 31, '2023-07-24 06:30:00', '2023-08-22 01:26:00'),
(317, 31, '2023-07-24 06:38:00', '2023-08-22 01:26:00'),
(318, 31, '2023-07-24 07:21:00', '2023-08-22 01:26:00'),
(319, 31, '2023-07-24 07:21:00', '2023-08-22 01:26:00'),
(320, 31, '2023-07-24 08:37:00', '2023-08-22 01:26:00'),
(321, 31, '2023-07-24 08:37:00', '2023-08-22 01:26:00'),
(322, 31, '2023-07-25 09:00:00', '2023-08-22 01:26:00'),
(323, 31, '2023-07-25 09:14:00', '2023-08-22 01:26:00'),
(324, 31, '2023-07-25 09:25:00', '2023-08-22 01:26:00'),
(325, 31, '2023-07-25 10:12:00', '2023-08-22 01:26:00'),
(326, 31, '2023-07-25 11:00:00', '2023-08-22 01:26:00'),
(327, 31, '2023-07-25 11:16:00', '2023-08-22 01:26:00'),
(328, 31, '2023-07-26 12:43:00', '2023-08-22 01:26:00'),
(329, 31, '2023-07-26 01:34:00', '2023-08-22 01:26:00'),
(330, 31, '2023-07-26 01:44:00', '2023-08-22 01:26:00'),
(331, 31, '2023-07-26 01:47:00', '2023-08-22 01:26:00'),
(332, 31, '2023-07-26 11:41:00', '2023-08-22 01:26:00'),
(333, 31, '2023-07-26 11:55:00', '2023-08-22 01:26:00'),
(334, 31, '2023-07-26 01:13:00', '2023-08-22 01:26:00'),
(335, 19, '2023-08-02 07:40:00', NULL),
(336, 54, '2023-08-02 07:58:00', NULL),
(337, 16, '2023-08-02 08:20:00', NULL),
(338, 33, '2023-08-02 08:21:00', '2023-08-02 08:22:00'),
(339, 19, '2023-08-02 08:23:00', NULL),
(340, 19, '2023-08-07 07:04:00', NULL),
(341, 16, '2023-08-07 07:04:00', NULL),
(342, 16, '2023-08-07 07:18:00', NULL),
(343, 16, '2023-08-07 07:25:00', NULL),
(344, 16, '2023-08-07 08:43:00', NULL),
(345, 19, '2023-08-07 08:47:00', NULL),
(346, 16, '2023-08-07 08:47:00', NULL),
(347, 31, '2023-08-07 09:02:00', '2023-08-22 01:26:00'),
(348, 16, '2023-08-07 09:07:00', NULL),
(349, 31, '2023-08-07 09:19:00', '2023-08-22 01:26:00'),
(350, 16, '2023-08-07 09:30:00', NULL),
(351, 16, '2023-08-08 09:53:00', NULL),
(352, 16, '2023-08-09 12:22:00', NULL),
(353, 16, '2023-08-09 12:23:00', NULL),
(354, 19, '2023-08-09 01:01:00', NULL),
(355, 52, '2023-08-09 01:33:00', NULL),
(356, 16, '2023-08-09 01:38:00', NULL),
(357, 52, '2023-08-09 02:02:00', NULL),
(358, 19, '2023-08-10 12:06:00', NULL),
(359, 19, '2023-08-10 03:12:00', NULL),
(360, 19, '2023-08-10 04:25:00', NULL),
(361, 16, '2023-08-10 08:40:00', NULL),
(362, 19, '2023-08-12 05:13:00', NULL),
(363, 16, '2023-08-12 05:13:00', NULL),
(364, 16, '2023-08-12 09:26:00', NULL),
(365, 19, '2023-08-13 09:19:00', NULL),
(366, 16, '2023-08-13 09:19:00', NULL),
(367, 16, '2023-08-13 11:28:00', NULL),
(368, 52, '2023-08-13 12:32:00', NULL),
(369, 31, '2023-08-21 05:02:00', '2023-08-22 01:26:00');

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `unit_id` int(11) NOT NULL,
  `unit_name` varchar(255) NOT NULL,
  `unit_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`unit_id`, `unit_name`, `unit_status`) VALUES
(17, 'Sacks', 1),
(24, 'sach', 1),
(25, 'tab', 1),
(26, 'CAPS', 1),
(27, 'vial', 1),
(30, 'kg', 1),
(31, 'pcs', 1),
(38, '5liters', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_log`
--

CREATE TABLE `users_log` (
  `act_id` int(11) NOT NULL,
  `act_account_id` int(11) NOT NULL,
  `act_activity` varchar(255) DEFAULT NULL,
  `act_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_log`
--

INSERT INTO `users_log` (`act_id`, `act_account_id`, `act_activity`, `act_date`) VALUES
(812, 16, 'UPDATE USER NO 19:', '2023-06-30 08:11:00'),
(813, 16, 'UPDATE PRODUCT CODE :PROD20211:', '2023-06-30 08:37:00'),
(814, 16, 'ADD 10 STOCKS IN PRODUCT:B-MEG Enertone', '2023-06-30 09:39:00'),
(815, 16, 'DELIVER TRANSACTION ID:RD57613 ', '2023-06-30 09:40:00'),
(816, 16, 'DELIVER TRANSACTION ID:RD57613 ', '2023-06-30 09:40:00'),
(817, 16, 'DELIVER TRANSACTION ID:RD11963 ', '2023-06-30 09:43:00'),
(818, 16, 'DELIVER TRANSACTION ID:RD18782 ', '2023-06-30 09:48:00'),
(820, 16, 'DELIVER TRANSACTION ID:RD35223 ', '2023-06-30 09:50:00'),
(823, 16, 'DELIVER TRANSACTION ID:RD23439 ', '2023-06-30 09:51:00'),
(826, 16, 'DELIVER TRANSACTION ID:RD57613 ', '2023-06-30 10:08:00'),
(828, 16, 'DELIVER TRANSACTION ID:RD97573 ', '2023-06-30 10:09:00'),
(831, 16, 'DELIVER TRANSACTION ID:RD57613 ', '2023-06-30 10:12:00'),
(833, 16, 'DELIVER TRANSACTION ID:RD35223 ', '2023-06-30 10:14:00'),
(834, 16, 'ADD 5 STOCKS IN PRODUCT:Ambroxitils', '2023-06-30 10:45:00'),
(835, 16, 'ADD 5 STOCKS IN PRODUCT:Ambroxitils', '2023-06-30 10:45:00'),
(836, 16, 'ADD 2 STOCKS IN PRODUCT:Ambroxitils', '2023-06-30 10:46:00'),
(837, 16, 'UPDATE PRODUCT CODE :PROD12400', '2023-06-30 10:47:00'),
(838, 16, 'UPDATE PRODUCT CODE :PROD12400', '2023-06-30 10:48:00'),
(839, 16, 'UPDATE PRODUCT CODE :PROD12400', '2023-06-30 10:49:00'),
(840, 16, 'UPDATE PRODUCT CODE :PROD12400', '2023-06-30 10:50:00'),
(841, 16, 'DELIVER TRANSACTION ID:RD26382 ', '2023-06-30 11:11:00'),
(842, 16, 'UPDATE USER NO 16:', '2023-06-30 11:15:00'),
(843, 16, 'UPDATE USER NO 16:', '2023-06-30 11:16:00'),
(845, 50, 'CREATE ACCOUNT', '2023-07-01 12:14:00'),
(846, 50, 'RECOVER ACCOUNT', '2023-07-01 12:38:00'),
(847, 16, 'ADD 1 STOCKS IN PRODUCT:B-MEG Enertone', '2023-07-01 07:46:00'),
(848, 16, 'UPDATE USER NO 19:', '2023-07-01 08:38:00'),
(849, 16, 'UPDATE USER NO 19:', '2023-07-01 08:38:00'),
(850, 16, 'UPDATE USER NO 19:', '2023-07-01 08:38:00'),
(851, 16, 'UPDATE USER NO 19:', '2023-07-01 08:39:00'),
(852, 31, 'CASHIERING IN TRANSACTION: RD33410', '2023-07-01 10:12:00'),
(853, 51, 'CREATE ACCOUNT', '2023-07-01 10:36:00'),
(854, 52, 'CREATE ACCOUNT', '2023-07-01 10:38:00'),
(855, 52, 'RECOVER ACCOUNT', '2023-07-01 10:44:00'),
(856, 16, 'DELIVER TRANSACTION ID:RD17317 ', '2023-07-01 11:01:00'),
(857, 16, 'ADD 5 STOCKS IN PRODUCT:B-MEG Enertone', '2023-07-01 11:17:00'),
(858, 16, 'ADD 10 STOCKS IN PRODUCT:B-MEG Enertone', '2023-07-01 11:18:00'),
(859, 16, 'DELIVER TRANSACTION ID:RD17249 ', '2023-07-01 11:22:00'),
(860, 16, 'ARCHIVE PRODUCT:Bayong-big', '2023-07-01 11:28:00'),
(861, 16, 'RESTORE PRODUCT:Bayong-big', '2023-07-01 11:28:00'),
(862, 31, 'CASHIERING IN TRANSACTION: RD05842', '2023-07-01 11:33:00'),
(863, 33, 'DELIVER TRANSACTION ID:RD75165 ', '2023-07-01 12:03:00'),
(864, 16, 'ADD 20 STOCKS IN PRODUCT:Chicken cage-small', '2023-07-02 05:22:00'),
(865, 16, 'UPDATE USER NO 16:', '2023-07-04 06:02:00'),
(866, 16, 'UPDATE USER NO 16:', '2023-07-04 06:03:00'),
(867, 31, 'CASHIERING IN TRANSACTION: RD90051', '2023-07-04 08:15:00'),
(868, 53, 'CREATE ACCOUNT', '2023-07-04 08:24:00'),
(869, 16, 'DELIVER TRANSACTION ID:RD69534 ', '2023-07-04 08:40:00'),
(870, 54, 'CREATE ACCOUNT', '2023-07-07 09:33:00'),
(871, 50, 'RECOVER ACCOUNT', '2023-07-07 09:44:00'),
(872, 55, 'CREATE ACCOUNT', '2023-07-07 09:51:00'),
(873, 56, 'CREATE ACCOUNT', '2023-07-07 11:16:00'),
(874, 57, 'CREATE ACCOUNT', '2023-07-08 11:32:00'),
(875, 58, 'CREATE ACCOUNT', '2023-07-08 12:53:00'),
(876, 16, 'UPDATE USER NO 58:', '2023-07-08 12:56:00'),
(877, 59, 'CREATE ACCOUNT', '2023-07-08 12:57:00'),
(878, 16, 'ADD 10 STOCKS IN PRODUCT:Ambroxitilssss', '2023-07-09 09:37:00'),
(879, 16, 'ADD 10 STOCKS IN PRODUCT:Ambroxitilssss', '2023-07-09 09:37:00'),
(880, 16, 'ADD 5 STOCKS IN PRODUCT:AMTYL 500', '2023-07-09 09:38:00'),
(881, 16, 'ADD 6 STOCKS IN PRODUCT:AMTYL 500', '2023-07-09 09:38:00'),
(882, 16, 'ADD 3 STOCKS IN PRODUCT:AMTYL 500', '2023-07-09 09:38:00'),
(883, 33, 'DELIVER TRANSACTION ID:RD90877 ', '2023-07-09 09:43:00'),
(884, 33, 'DELIVER TRANSACTION ID:RD90877 ', '2023-07-09 09:43:00'),
(885, 16, 'DELIVER TRANSACTION ID:RD90877 ', '2023-07-09 09:45:00'),
(886, 16, 'DELIVER TRANSACTION ID:RD90877 ', '2023-07-09 09:45:00'),
(887, 16, 'ADD 10 STOCKS IN PRODUCT:AMTYL 500', '2023-07-09 10:19:00'),
(888, 16, 'ADD 10 STOCKS IN PRODUCT:AMTYL 500', '2023-07-09 10:19:00'),
(889, 16, 'ADD 10 STOCKS IN PRODUCT:AMTYL 500', '2023-07-09 10:20:00'),
(890, 16, 'ADD 10 STOCKS IN PRODUCT:AMTYL 500', '2023-07-09 10:20:00'),
(891, 16, 'ADD 3 STOCKS IN PRODUCT:AMTYL 500', '2023-07-09 10:20:00'),
(892, 16, 'ADD 2 STOCKS IN PRODUCT:AMTYL 500', '2023-07-09 10:28:00'),
(893, 16, 'ADD 6 STOCKS IN PRODUCT:AMTYL 500', '2023-07-09 10:40:00'),
(894, 16, 'ADD 10 STOCKS IN PRODUCT:Ambroxitilssss', '2023-07-09 10:49:00'),
(895, 16, 'ADD 5 STOCKS IN PRODUCT:Ambroxitilssss', '2023-07-09 10:49:00'),
(896, 16, 'ADD 10 STOCKS IN PRODUCT:Bayong-big', '2023-07-09 10:49:00'),
(897, 16, 'ADD 12 STOCKS IN PRODUCT:Bayong-big', '2023-07-15 09:52:00'),
(898, 16, 'ADD 71 STOCKS IN PRODUCT:AMTYL 500', '2023-07-15 09:53:00'),
(899, 16, 'ADD 60 STOCKS IN PRODUCT:Chicken cage-small', '2023-07-15 09:53:00'),
(900, 31, 'CASHIERING IN TRANSACTION: RD72627', '2023-07-16 03:43:00'),
(901, 31, 'CASHIERING IN TRANSACTION: RD03209', '2023-07-16 03:43:00'),
(902, 31, 'CASHIERING IN TRANSACTION: RD12489', '2023-07-16 03:53:00'),
(903, 31, 'CASHIERING IN TRANSACTION: RD76015', '2023-07-23 10:01:00'),
(904, 31, 'CASHIERING IN TRANSACTION: RD58905', '2023-07-24 07:23:00'),
(905, 31, 'CASHIERING IN TRANSACTION: RD65918', '2023-07-24 10:24:00'),
(906, 31, 'CASHIERING IN TRANSACTION: RD42223', '2023-07-24 10:24:00'),
(907, 16, 'ADD 10 STOCKS IN PRODUCT:Aozi Puppy', '2023-08-07 07:29:00'),
(908, 16, 'ADD 123 STOCKS IN PRODUCT:Aozi Puppy', '2023-08-07 07:30:00'),
(909, 16, 'ADD 3 STOCKS IN PRODUCT:Water bottle-bird', '2023-08-07 07:30:00'),
(910, 16, 'ADD 9 STOCKS IN PRODUCT:Water bottle-bird', '2023-08-07 07:31:00'),
(911, 16, 'UPDATE PRODUCT CODE :PROD03969', '2023-08-07 07:31:00'),
(912, 16, 'UPDATE PRODUCT CODE :PROD03969', '2023-08-07 07:31:00'),
(913, 16, 'UPDATE PRODUCT CODE :PROD03969', '2023-08-07 07:31:00'),
(914, 16, 'UPDATE PRODUCT CODE :PROD03969', '2023-08-07 07:31:00'),
(915, 16, 'ADD 88 STOCKS IN PRODUCT:testing', '2023-08-07 08:44:00'),
(916, 16, 'ADD 5 STOCKS IN PRODUCT:Ambroxitilssss', '2023-08-07 08:45:00'),
(917, 16, 'ADD 5 STOCKS IN PRODUCT:Ambroxitilssss', '2023-08-07 08:45:00'),
(918, 16, 'ADD 50 STOCKS IN PRODUCT:B-MEG Enertone', '2023-08-07 08:46:00'),
(919, 16, 'DELIVER TRANSACTION ID:RD07462 ', '2023-08-07 08:56:00'),
(920, 31, 'CASHIERING IN TRANSACTION: RD61393', '2023-08-07 09:02:00'),
(921, 31, 'CASHIERING IN TRANSACTION: RD70820', '2023-08-07 09:03:00'),
(922, 16, 'ARCHIVE PRODUCT:Aozi Puppy', '2023-08-07 09:14:00'),
(923, 16, 'ARCHIVE PRODUCT:Water bottle-bird', '2023-08-07 09:14:00'),
(924, 16, 'RESTORE PRODUCT:Aozi Puppy', '2023-08-07 09:14:00'),
(925, 16, 'RESTORE PRODUCT:Water bottle-bird', '2023-08-07 09:14:00'),
(926, 16, 'UPDATE USER NO 16:', '2023-08-08 09:54:00'),
(927, 16, 'UPDATE USER NO 16:', '2023-08-08 09:54:00'),
(928, 16, 'UPDATE USER NO 16:', '2023-08-08 09:55:00'),
(929, 16, 'UPDATE USER NO 16:', '2023-08-08 09:55:00'),
(930, 16, 'UPDATE USER NO 16:', '2023-08-08 09:55:00'),
(931, 16, 'UPDATE USER NO 16:', '2023-08-08 09:55:00'),
(932, 16, 'UPDATE USER NO 16:', '2023-08-08 09:55:00'),
(933, 16, 'UPDATE USER NO 16:', '2023-08-08 09:55:00'),
(934, 16, 'UPDATE USER NO 16:', '2023-08-08 09:55:00'),
(935, 16, 'UPDATE USER NO 16:', '2023-08-08 09:59:00'),
(936, 16, 'UPDATE USER NO 16:', '2023-08-08 09:59:00'),
(937, 16, 'UPDATE USER NO 16:', '2023-08-08 09:59:00'),
(938, 16, 'UPDATE USER NO 16:', '2023-08-08 10:00:00'),
(939, 16, 'UPDATE USER NO 16:', '2023-08-08 10:00:00'),
(940, 16, 'UPDATE USER NO 16:', '2023-08-08 10:01:00'),
(941, 16, 'UPDATE USER NO 16:', '2023-08-08 10:01:00'),
(942, 16, 'UPDATE USER NO 16:', '2023-08-08 10:01:00'),
(943, 16, 'UPDATE USER NO 16:', '2023-08-08 10:01:00'),
(944, 16, 'UPDATE USER NO 16:', '2023-08-08 10:01:00'),
(945, 16, 'UPDATE USER NO 16:', '2023-08-08 10:01:00'),
(946, 16, 'UPDATE USER NO 16:', '2023-08-08 10:01:00'),
(947, 16, 'UPDATE USER NO 16:', '2023-08-08 10:01:00'),
(948, 16, 'UPDATE USER NO 16:', '2023-08-08 10:01:00'),
(949, 16, 'UPDATE USER NO 16:', '2023-08-08 10:01:00'),
(950, 16, 'UPDATE USER NO 16:', '2023-08-08 10:01:00'),
(951, 16, 'UPDATE USER NO 16:', '2023-08-08 10:01:00'),
(952, 16, 'UPDATE USER NO 16:', '2023-08-08 10:01:00'),
(953, 16, 'UPDATE USER NO 16:', '2023-08-08 10:03:00'),
(954, 16, 'UPDATE USER NO 16:', '2023-08-08 10:03:00'),
(955, 16, 'UPDATE USER NO 16:', '2023-08-08 10:03:00'),
(956, 16, 'UPDATE USER NO 16:', '2023-08-08 10:03:00'),
(957, 16, 'UPDATE USER NO 16:', '2023-08-08 10:03:00'),
(958, 16, 'UPDATE USER NO 16:', '2023-08-08 10:03:00'),
(959, 16, 'UPDATE USER NO 16:', '2023-08-08 10:03:00'),
(960, 16, 'UPDATE USER NO 16:', '2023-08-08 10:04:00'),
(961, 16, 'UPDATE USER NO 16:', '2023-08-08 10:04:00'),
(962, 16, 'UPDATE USER NO 16:', '2023-08-08 10:04:00'),
(963, 16, 'UPDATE USER NO 16:', '2023-08-08 10:04:00'),
(964, 16, 'UPDATE USER NO 16:', '2023-08-08 10:05:00'),
(965, 16, 'UPDATE USER NO 16:', '2023-08-08 10:05:00'),
(966, 16, 'UPDATE USER NO 16:', '2023-08-08 10:05:00'),
(967, 16, 'UPDATE USER NO 16:', '2023-08-08 10:05:00'),
(968, 16, 'UPDATE USER NO 16:', '2023-08-08 10:05:00'),
(969, 16, 'UPDATE USER NO 16:', '2023-08-08 10:05:00'),
(970, 16, 'UPDATE USER NO 16:', '2023-08-08 10:06:00'),
(971, 16, 'UPDATE USER NO 16:', '2023-08-08 10:06:00'),
(972, 16, 'UPDATE USER NO 16:', '2023-08-08 10:06:00'),
(973, 16, 'UPDATE USER NO 16:', '2023-08-08 10:06:00'),
(974, 16, 'UPDATE USER NO 16:', '2023-08-08 10:07:00'),
(975, 16, 'UPDATE USER NO 16:', '2023-08-08 10:08:00'),
(976, 16, 'UPDATE USER NO 16:', '2023-08-08 10:08:00'),
(977, 16, 'ARCHIVE PRODUCT:testing8', '2023-08-08 10:14:00'),
(978, 16, 'ARCHIVE PRODUCT:Hairbrush', '2023-08-08 10:14:00'),
(979, 16, 'ARCHIVE PRODUCT:testing3', '2023-08-08 10:14:00'),
(980, 16, 'ARCHIVE PRODUCT:testing5', '2023-08-08 10:14:00'),
(981, 16, 'UPDATE PRODUCT CODE :PROD03969', '2023-08-08 10:15:00'),
(982, 16, 'UPDATE PRODUCT CODE :PROD03969', '2023-08-08 10:15:00'),
(983, 16, 'UPDATE PRODUCT CODE :PROD03969', '2023-08-08 10:16:00'),
(984, 16, 'UPDATE PRODUCT CODE :PROD03969', '2023-08-08 10:16:00'),
(985, 16, 'UPDATE PRODUCT CODE :PROD03969', '2023-08-08 10:16:00'),
(986, 16, 'UPDATE PRODUCT CODE :PROD03969', '2023-08-08 10:16:00'),
(987, 16, 'UPDATE PRODUCT CODE :PROD03969', '2023-08-08 10:16:00'),
(988, 16, 'UPDATE PRODUCT CODE :PROD03969', '2023-08-08 10:17:00'),
(989, 16, 'UPDATE PRODUCT CODE :PROD03969', '2023-08-08 10:17:00'),
(990, 16, 'UPDATE PRODUCT CODE :PROD03969', '2023-08-08 10:17:00'),
(991, 16, 'UPDATE PRODUCT CODE :PROD03969', '2023-08-08 10:17:00'),
(992, 16, 'UPDATE PRODUCT CODE :PROD03969', '2023-08-08 10:17:00'),
(993, 16, 'UPDATE PRODUCT CODE :PROD03969', '2023-08-08 10:17:00'),
(994, 16, 'UPDATE PRODUCT CODE :PROD03969', '2023-08-08 10:17:00'),
(995, 16, 'UPDATE PRODUCT CODE :PROD03969', '2023-08-08 10:17:00'),
(996, 16, 'UPDATE PRODUCT CODE :PROD03969', '2023-08-08 10:17:00'),
(997, 16, 'UPDATE PRODUCT CODE :PROD03969', '2023-08-08 10:18:00'),
(998, 16, 'UPDATE PRODUCT CODE :PROD03969', '2023-08-08 10:18:00'),
(999, 16, 'UPDATE PRODUCT CODE :PROD03969', '2023-08-08 11:40:00'),
(1000, 16, 'UPDATE USER NO 16:', '2023-08-08 11:41:00'),
(1001, 16, 'UPDATE PRODUCT CODE :PROD03969', '2023-08-09 12:12:00'),
(1002, 16, 'UPDATE PRODUCT CODE :PROD03969', '2023-08-09 12:12:00'),
(1003, 16, 'UPDATE PRODUCT CODE :PROD03969', '2023-08-09 12:13:00'),
(1004, 16, 'UPDATE PRODUCT CODE :PROD03969', '2023-08-09 12:13:00'),
(1005, 16, 'UPDATE PRODUCT CODE :PROD03969', '2023-08-09 12:14:00'),
(1006, 16, 'UPDATE PRODUCT CODE :PROD03969', '2023-08-09 12:14:00'),
(1007, 16, 'UPDATE PRODUCT CODE :PROD03969', '2023-08-09 12:14:00'),
(1008, 16, 'ARCHIVE PRODUCT:testing', '2023-08-09 12:43:00'),
(1009, 16, 'RESTORE PRODUCT:testing8', '2023-08-09 12:45:00'),
(1010, 16, 'RESTORE PRODUCT:testing', '2023-08-09 12:45:00'),
(1011, 16, 'RESTORE PRODUCT:Hairbrush', '2023-08-09 12:45:00'),
(1012, 16, 'RESTORE PRODUCT:testing3', '2023-08-09 12:45:00'),
(1013, 16, 'RESTORE PRODUCT:testing5', '2023-08-09 12:45:00'),
(1014, 16, 'ADD 100 STOCKS IN PRODUCT:Ambroxitilssss', '2023-08-09 01:42:00'),
(1015, 16, 'ADD 50 STOCKS IN PRODUCT:AMTYL 500', '2023-08-09 01:43:00'),
(1016, 16, 'ADD 50 STOCKS IN PRODUCT:Aozi Puppy', '2023-08-10 08:47:00'),
(1017, 16, 'ADD 50 STOCKS IN PRODUCT:Aozi Puppy', '2023-08-10 08:47:00'),
(1018, 16, 'ADD 15 STOCKS IN PRODUCT:Water bottle-bird', '2023-08-10 08:48:00'),
(1019, 16, 'ADD 15 STOCKS IN PRODUCT:Water bottle-bird', '2023-08-10 08:48:00'),
(1020, 16, 'ADD 5 STOCKS IN PRODUCT:Ambroxitilssss', '2023-08-10 08:48:00'),
(1021, 16, 'ADD 11 STOCKS IN PRODUCT:testing2', '2023-08-10 08:48:00'),
(1022, 16, 'ADD 15 STOCKS IN PRODUCT:Bayong-big', '2023-08-10 08:48:00'),
(1023, 16, 'ADD 15 STOCKS IN PRODUCT:Bayong-big', '2023-08-10 08:48:00'),
(1024, 16, 'ADD 20 STOCKS IN PRODUCT:Chicken cage-small', '2023-08-10 08:48:00'),
(1025, 16, 'ADD 20 STOCKS IN PRODUCT:Chicken cage-small', '2023-08-10 08:48:00'),
(1026, 16, 'ADD 59 STOCKS IN PRODUCT:Chewing toy bone -small', '2023-08-10 08:49:00'),
(1027, 16, 'ADD 59 STOCKS IN PRODUCT:Chewing toy bone -small', '2023-08-10 08:49:00'),
(1028, 16, 'ADD 10 STOCKS IN PRODUCT:Aozi Puppy', '2023-08-13 12:13:00'),
(1029, 16, 'ADD 10 STOCKS IN PRODUCT:Aozi Puppy', '2023-08-13 12:13:00'),
(1030, 16, 'ADD 13 STOCKS IN PRODUCT:Aozi Puppy', '2023-08-13 12:13:00'),
(1031, 16, 'ADD 3 STOCKS IN PRODUCT:Aozi Puppy', '2023-08-13 12:13:00'),
(1032, 16, 'ADD 3 STOCKS IN PRODUCT:AMTYL 500', '2023-08-13 12:29:00'),
(1033, 16, 'ADD 6 STOCKS IN PRODUCT:AMTYL 500', '2023-08-13 12:29:00'),
(1034, 16, 'ADD 1 STOCKS IN PRODUCT:AMTYL 500', '2023-08-13 12:30:00'),
(1035, 16, 'ADD 6 STOCKS IN PRODUCT:AMTYL 500', '2023-08-13 12:30:00'),
(1036, 16, 'ADD 5 STOCKS IN PRODUCT:AMTYL 500', '2023-08-13 12:30:00'),
(1037, 16, 'ADD 5 STOCKS IN PRODUCT:AMTYL 500', '2023-08-13 12:30:00'),
(1038, 16, 'ADD 1 STOCKS IN PRODUCT:AMTYL 500', '2023-08-13 12:37:00'),
(1039, 16, 'ADD 6 STOCKS IN PRODUCT:B-MEG Enertone', '2023-08-13 09:46:00'),
(1040, 16, 'ADD 7 STOCKS IN PRODUCT:B-MEG Enertone', '2023-08-13 09:46:00'),
(1041, 16, 'ADD 9 STOCKS IN PRODUCT:B-MEG Enertone', '2023-08-13 09:46:00'),
(1042, 16, 'ADD 6 STOCKS IN PRODUCT:B-MEG Enertone', '2023-08-13 09:55:00'),
(1043, 16, 'ADD 10 STOCKS IN PRODUCT:B-MEG Enertone', '2023-08-13 09:55:00'),
(1044, 16, 'ADD 75 STOCKS IN PRODUCT:B-MEG Enertone', '2023-08-13 09:56:00'),
(1045, 16, 'ADD 10 STOCKS IN PRODUCT:AMTYL 500', '2023-08-13 12:24:00'),
(1046, 16, 'ADD 5 STOCKS IN PRODUCT:AMTYL 500', '2023-08-13 12:24:00'),
(1047, 16, 'ADD 8 STOCKS IN PRODUCT:AMTYL 500', '2023-08-13 12:25:00'),
(1048, 16, 'ADD 50 STOCKS IN PRODUCT:Aozi Puppy', '2023-08-13 12:25:00'),
(1049, 16, 'ADD 10 STOCKS IN PRODUCT:Water bottle-bird', '2023-08-13 12:25:00');

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `voucher_id` int(11) NOT NULL,
  `voucher_name` varchar(255) NOT NULL,
  `voucher_discount` float NOT NULL,
  `voucher_created` datetime NOT NULL,
  `voucher_expiration` datetime NOT NULL,
  `voucher_maximumLimit` int(11) NOT NULL,
  `voucher_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voucher`
--

INSERT INTO `voucher` (`voucher_id`, `voucher_name`, `voucher_discount`, `voucher_created`, `voucher_expiration`, `voucher_maximumLimit`, `voucher_status`) VALUES
(21, 'sample voucher', 50, '2023-07-04 12:37:39', '2023-08-15 00:00:00', 98, 1),
(23, 'test', 75, '2023-08-08 23:47:59', '2023-08-09 00:00:00', 100, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`acc_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`discount_id`);

--
-- Indexes for table `maintinance`
--
ALTER TABLE `maintinance`
  ADD PRIMARY KEY (`system_id`);

--
-- Indexes for table `mode_of_payment`
--
ALTER TABLE `mode_of_payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orders_id`);

--
-- Indexes for table `pos_cart`
--
ALTER TABLE `pos_cart`
  ADD PRIMARY KEY (`pos_cart_id`);

--
-- Indexes for table `pos_orders`
--
ALTER TABLE `pos_orders`
  ADD PRIMARY KEY (`orders_orders_id`);

--
-- Indexes for table `pos_transaction`
--
ALTER TABLE `pos_transaction`
  ADD PRIMARY KEY (`transaction_no`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `returns_pos`
--
ALTER TABLE `returns_pos`
  ADD PRIMARY KEY (`ret_id`);

--
-- Indexes for table `return_ordering`
--
ALTER TABLE `return_ordering`
  ADD PRIMARY KEY (`ret_ol_id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `system_log`
--
ALTER TABLE `system_log`
  ADD PRIMARY KEY (`sys_id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `users_log`
--
ALTER TABLE `users_log`
  ADD PRIMARY KEY (`act_id`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`voucher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `acc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=694;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `discount_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `maintinance`
--
ALTER TABLE `maintinance`
  MODIFY `system_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mode_of_payment`
--
ALTER TABLE `mode_of_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orders_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=692;

--
-- AUTO_INCREMENT for table `pos_cart`
--
ALTER TABLE `pos_cart`
  MODIFY `pos_cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1005;

--
-- AUTO_INCREMENT for table `pos_orders`
--
ALTER TABLE `pos_orders`
  MODIFY `orders_orders_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=428;

--
-- AUTO_INCREMENT for table `pos_transaction`
--
ALTER TABLE `pos_transaction`
  MODIFY `transaction_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- AUTO_INCREMENT for table `returns_pos`
--
ALTER TABLE `returns_pos`
  MODIFY `ret_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `return_ordering`
--
ALTER TABLE `return_ordering`
  MODIFY `ret_ol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248;

--
-- AUTO_INCREMENT for table `system_log`
--
ALTER TABLE `system_log`
  MODIFY `sys_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=370;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `users_log`
--
ALTER TABLE `users_log`
  MODIFY `act_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1050;

--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `voucher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
