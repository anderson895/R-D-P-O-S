-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2024 at 02:23 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u533477241_rdpos`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `acc_id` int(11) NOT NULL,
  `acc_code` varchar(255) NOT NULL,
  `acc_created` date NOT NULL,
  `acc_username` varchar(255) NOT NULL,
  `acc_password` varchar(255) NOT NULL,
  `acc_fname` varchar(255) NOT NULL,
  `acc_lname` varchar(255) NOT NULL,
  `acc_birthday` date DEFAULT NULL,
  `acc_type` varchar(255) NOT NULL,
  `acc_status` int(11) NOT NULL,
  `acc_display_status` int(11) NOT NULL,
  `acc_email` varchar(255) NOT NULL,
  `acc_contact` varchar(255) NOT NULL,
  `emp_image` varchar(255) NOT NULL,
  `acc_cover_img` varchar(255) DEFAULT NULL,
  `acc_added` varchar(255) NOT NULL,
  `acc_lastEdit` datetime DEFAULT NULL,
  `Otp` varchar(6) NOT NULL,
  `incorrect_attempts` int(11) DEFAULT NULL,
  `otp_expiration` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`acc_id`, `acc_code`, `acc_created`, `acc_username`, `acc_password`, `acc_fname`, `acc_lname`, `acc_birthday`, `acc_type`, `acc_status`, `acc_display_status`, `acc_email`, `acc_contact`, `emp_image`, `acc_cover_img`, `acc_added`, `acc_lastEdit`, `Otp`, `incorrect_attempts`, `otp_expiration`) VALUES
(16, 'ACC6038616', '2023-06-01', 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'joshua admin', 'padilla', '2000-10-03', 'administrator', 0, 0, 'andyanderson12s3@gmail.com', '09770987021', '6574557bbc999.jpg', '6574556abd008.jpeg', '', '2023-12-09 19:54:35', '0', NULL, NULL),
(223, 'ACC79187223', '2024-02-17', 'Zy30Alcarez', '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9', 'Zyrine', 'Alcarez', '2000-03-30', 'customer', 0, 0, 'zy30alcarez@gmail.com', '09614229001', '', NULL, '', NULL, '', 0, '2024-02-17 21:37:19'),
(225, 'ACC52228225', '2024-02-17', 'irapadris', 'e0ffe6d9176ab2cfd446c7ecf4937bffb61f7f1970004cb783d6cc86ab81133a', 'juliana', 'padrigon', '2000-02-07', 'customer', 0, 0, 'julianairadp@gmail.com', '09753033046', '', NULL, '', NULL, '0', 0, '2024-02-17 21:27:08'),
(226, 'ACC19042226', '2024-02-17', 'emman', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Emman', 'Ugaban', '2002-12-03', 'customer', 0, 0, 'ugabane0516@gmail.com', '09666888756', '', NULL, '', NULL, '0', 0, '2024-02-17 21:54:27'),
(227, '08884227', '2024-02-22', 'rider', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Johns', 'Does', NULL, 'deliveryStaff', 0, 0, 'rider123123@gmail.com', '09123456789', '65d0beda1c5b0.png', NULL, '', NULL, '', NULL, NULL),
(228, '61168228', '2024-03-02', 'Zy30Rider', '417493176e38b5f999685422e45e63a2d40854867d09c22bc80a8c0b38e46905', 'Zyrines', 'Alcarez', NULL, 'deliveryStaff', 0, 0, 'alcarezzyrinearreza.pdm@gmail.com', '09128505092', '65e2e9d9124b4.jpeg', NULL, '', NULL, '', NULL, NULL),
(229, '85008229', '2024-02-19', 'MikeWill', 'ba38fa8eb6abfe591896129ce1c4fe8b2ea736bad64b0c0d9f82b03078c4f101', 'Mike', 'Will', NULL, 'administrator', 0, 0, 'mike@gmail.com', '09120912091', '65d377cad0800.png', NULL, '', NULL, '', NULL, NULL),
(230, '57607230', '2024-02-19', 'Mike@will', '6a01a215a91e2534030040547166fac496a29d273ed9124ef36c1124a301bf92', 'Mike', 'Will', NULL, 'cashier', 2, 1, 'will@gmail.com', '09120912091', '65d37849c897e.png', NULL, '', NULL, '', NULL, NULL),
(235, 'ACC12286235', '2024-02-22', 'andersonandy7', '16c6ad2f31e691bf324c0568d3108534e80d47b30fbf3a0ac26c496f506cf509', 'Joshua Anderson', 'Padilla', '2000-02-22', 'customer', 1, 0, 'andersonandy7@gmail.com', '09914965320', '', NULL, '', NULL, '7448', NULL, '2024-02-22 18:56:15'),
(236, '89253236', '2024-02-23', 'riderpadilla', '7b06f661244d139bbc93042adb8a4ec2e15f962cbc5a2188700104261b264ec1', 'riderpadilla', 'Bocado', NULL, 'deliveryStaff', 0, 0, 'riderpadilla@gmail.com', '09123456789', '65d75f9a63f12.png', NULL, '', NULL, '', NULL, NULL),
(238, 'ACC35213238', '2024-02-23', 'alcarez123', 'd624cedb9f1ee9ea0dace44a504feaa325ebca32a5fb459ca47d1e626cfa7cdb', 'Alcarez', 'Zyrine', '2001-07-26', 'customer', 0, 0, 'Julianairapadrigon0@gmail.com', '09989887768', '', NULL, '', NULL, '0', 0, '2024-02-23 13:14:13'),
(239, 'ACC04027239', '2024-02-23', 'aanderson8954', '4bda60df260fe33ad5c6230b412eb565c0e160a9cf9ffe2d1f8d33c48344d0fe', 'joshua', 'padilla', '2000-02-23', 'customer', 1, 0, 'aanderson8954@gmail.com', '09454454744', '', NULL, '', NULL, '7008', 6, '2024-02-23 21:52:22'),
(240, '49799240', '2024-02-25', 'juliana', 'aa4c231348ed81024de144fdc13020a000d718eec0e7deb86ceb2158ce60bbb0', 'jullian', 'padrigon', NULL, 'cashier', 0, 0, 'juliana@gmail.com', '09123456789', '65dab033b81e1.jpg', NULL, '', NULL, '', NULL, NULL),
(241, 'ACC57830241', '2024-02-25', 'bugtonggera', '13559657a7b9dcfe9bd7ec0602e0d7d11fc73cf70622b2cf659ae55c5999f5b1', 'geraldine', 'bugtong', '2001-01-28', 'customer', 0, 0, 'bugtonggera@gmail.com', '09454454744', '', NULL, '', NULL, '0', 0, '2024-02-25 11:26:40'),
(242, 'ACC31896242', '2024-02-27', 'spads', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Joshu', 'Padilla', '2002-12-12', 'customer', 1, 0, 'padilla.pdm@gmail.com', '09123456789', '', NULL, '', NULL, '3138', 1, '2024-02-27 23:00:43'),
(243, 'ACC30689243', '2024-02-27', 'jrsisa', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'John Rey', 'Sisa', '2002-12-12', 'customer', 1, 0, 'sisa@gmail.com', '09123441233', '', NULL, '', NULL, '9530', NULL, '2024-02-27 23:08:16'),
(244, 'ACC99424244', '2024-02-27', 'asokdhakshd', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'John Rey', 'asd', '1212-12-12', 'customer', 1, 0, 'qwe@gmail.com', '09123456789', '', NULL, '', NULL, '7698', NULL, '2024-02-27 23:15:27'),
(245, 'ACC81976245', '2024-02-27', 'joshu123', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Joshua', 'Padilla', '2002-12-12', 'customer', 1, 0, 'joshua132@gmail.com', '09123456789', '', NULL, '', NULL, '4040', NULL, '2024-02-27 23:23:17'),
(246, 'ACC09265246', '2024-02-28', 'andersonandy234', '61e36b4d463fcf248af31898805050d4b137bb54e74c4e7e9b95b35ccb0f9753', 'Joshua Anderson', 'Padilla', '2000-02-28', 'customer', 0, 0, 'andersonandy046@gmail.com', '09914965321', '', NULL, '', NULL, '', 0, '2024-07-02 21:25:52'),
(247, 'ACC12803247', '2024-02-28', 'emman123', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Emman', 'Sample', '2002-12-12', 'customer', 1, 0, 'emman@gmail.com', '09123456789', '', NULL, '', NULL, '0007', NULL, '2024-02-28 20:10:31'),
(248, 'ACC24016248', '2024-02-28', 'danielpadilla', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'John Rey', 'Padilla', '2002-12-31', 'customer', 1, 0, 'sis2a@gmail.com', '09123456789', '', NULL, '', NULL, '1654', 2, '2024-02-28 20:29:14'),
(249, 'ACC30775249', '2024-02-28', 'ashlot.bajo', '5fbc597cd725de89cfa83dd3b0c1114d5a7a98fd1d679b45c0ba2f003895fbca', 'ash', 'lot', '2000-01-01', 'customer', 0, 0, 'ashlot.bajo1@gmail.com', '09454454744', '', NULL, '', NULL, '0', 0, '2024-02-28 23:27:40'),
(250, '62330250', '2024-03-02', 'FykeRider', '2b0dcdb1cab2cd9b47ac7c775a4d9807e418799c458e7455529306d017274e76', 'fyke', 'loterena', NULL, 'deliveryStaff', 0, 0, 'FykeRider@gmail.com', '09123456789', '65e2e9a84091d.png', NULL, '', NULL, '', NULL, NULL),
(252, 'ACC75423252', '2024-02-29', 'irapadrigon', 'c50d339c8af5e26a349c6e2fe127d1948f299403f5549531335ee64829c7ea79', 'Juliana Ira', 'Padrigon', '2000-02-11', 'customer', 0, 0, 'julianairapadrigon5@gmail.com', '09753035756', '', NULL, '', NULL, '0', 0, '2024-02-29 16:10:36'),
(253, 'ACC35017253', '2024-03-04', 'costumer1', '693bfa3ccf2ba5458437468ada2fd3949319528867bff78de905cef88360d3d2', 'Jv', 'Magtalas', '2000-03-04', 'customer', 0, 0, 'jvmagtalas043@gmail.com', '09914965320', '', NULL, '', NULL, '', 0, '2024-03-04 12:46:47'),
(262, 'ACC59775262', '2024-06-27', 'joshua', '0b126e93856f3289c7c9c9bad49733d101586065e41fcbd3b745c5291d5e93ff', 'joshua', 'padilla', '2024-06-12', 'customer', 1, 0, 'anderson@gmail.com', '09454454744', '', NULL, '', NULL, '4863', NULL, '2024-06-27 22:40:29'),
(266, 'ACC08687266', '2024-06-27', 'wadwadwadwad', 'ddff250e687a1a592bc17d963b7cd4e8fab6d92bd26c4d4be91ae13a58d86bfd', 'joshua', 'padilla', '2000-06-21', 'customer', 1, 0, 'awdwad@gmail.com', '09454454744', '', NULL, '', NULL, '5971', NULL, '2024-06-27 22:59:23'),
(268, 'ACC03134268', '2024-06-27', 'padillajoshuaanderson.pdm', 'c9da6e6ac07fbfa8cbc71335f5b99c2d3eeb26c08c802d804252852476154f7e', 'joshua', 'padilla', '2000-06-13', 'customer', 0, 0, 'padillajoshuaanderson.pdm@gmail.com', '09454454744', '', NULL, '', NULL, '0', 0, '2024-06-27 23:35:04');

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
(1177, 216, 188, 4),
(1212, 252, 208, 1),
(1213, 244, 213, 3);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_description` varchar(255) NOT NULL,
  `category_status` int(11) NOT NULL,
  `category_date_created` varchar(255) NOT NULL,
  `category_date_edited` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_description`, `category_status`, `category_date_created`, `category_date_edited`) VALUES
(1, 'Accessories', 'thing which can be added to something else in order to make it more useful, versatile, or attractive. a range of bathroom accessoriesssss', 1, '2023-10-12 14:25:57', '2024-03-06 22:11:04'),
(2, 'foods', 'food, substance consisting essentially of protein, carbohydrate, fat, and other nutrients used in the body of an organism to sustain growth and vital processes and to furnish energy. The absorption and utilization of food by the body is fundamental to nut', 1, '2023-10-12 14:25:57', '2023-10-16 16:02:39'),
(3, 'medicines', 'Medicines are chemicals or compounds used to cure, halt, or prevent disease ease symptoms or help in the diagnosis of illnesses. Advances in medicines have enabled doctors to cure many diseases and save lives.', 1, '2023-10-12 14:25:57', '2023-10-22 18:32:15'),
(23, 'category 1', 'addasdawdasdwad', 0, '2023-10-13 00:05:16', '2023-10-13 00:24:44'),
(24, 'Vitaminss', 'awdwadwadwd', 0, '2023-10-15 21:30:18', '2023-10-16 16:05:31'),
(25, 'category 1', 'awdawdwadaw', 0, '2023-11-24 22:12:19', NULL),
(26, 'categor2', 'dwadwadawdwadwa', 0, '2024-02-28 23:34:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `discount_id` int(11) NOT NULL,
  `discount_name` varchar(255) NOT NULL,
  `discount_description` varchar(255) NOT NULL,
  `discount_rate` float NOT NULL,
  `discount_added` datetime NOT NULL,
  `discount_edited` datetime DEFAULT NULL,
  `discount_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`discount_id`, `discount_name`, `discount_description`, `discount_rate`, `discount_added`, `discount_edited`, `discount_status`) VALUES
(39, 'joshua', 'awadwad', 10, '2023-11-25 10:47:36', '2023-11-25 10:48:51', 2),
(40, '10 sakos', 'we give 20% discount', 20, '2023-11-25 11:24:40', '2023-11-25 11:24:55', 1),
(41, 'suki ', 'exclusive for regular customers only', 2, '2023-11-25 19:24:57', NULL, 1),
(42, 'PWD', 'Discount for PWD', 5, '2023-11-25 19:25:51', NULL, 1),
(43, 'Senior', 'basta senior ', 6, '2023-11-25 19:26:14', NULL, 1);

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
  `system_last_update` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `maintinance`
--

INSERT INTO `maintinance` (`system_id`, `system_name`, `system_banner`, `system_logo`, `system_content`, `system_address`, `system_contact`, `system_tax`, `system_last_update`) VALUES
(1, 'RDPOS', '6534fbcd9b0f9.jpg', '6534e356c9783.png', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quaerat, error esse, eos necessitatibus saepe temporibus aliquam aperiam quas reiciendis possimus laborum voluptates magni ad. Quam tempore officiis eligendi sed aut', 'Paso bagbaguin near highway road sta.maria bulacan', '09876543211', 0.1, '2024-02-29 16:00:51');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `mess_id` int(11) NOT NULL,
  `mess_sender_id` int(11) NOT NULL,
  `mess_content` varchar(255) DEFAULT NULL,
  `mess_type` varchar(255) NOT NULL,
  `mess_status` int(11) NOT NULL,
  `mess_reciever_id` int(11) DEFAULT NULL,
  `mess_date` datetime NOT NULL,
  `mess_seen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mode_of_payment`
--

CREATE TABLE `mode_of_payment` (
  `payment_id` int(11) NOT NULL,
  `payment_code` varchar(9) NOT NULL,
  `payment_name` varchar(255) NOT NULL,
  `payment_number` varchar(255) NOT NULL,
  `payment_image` varchar(255) DEFAULT NULL,
  `payment_status` int(11) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `payment_date_added` varchar(255) NOT NULL,
  `payment_date_edited` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mode_of_payment`
--

INSERT INTO `mode_of_payment` (`payment_id`, `payment_code`, `payment_name`, `payment_number`, `payment_image`, `payment_status`, `payment_type`, `payment_date_added`, `payment_date_edited`) VALUES
(57, '002984357', 'Gcash', '09214563278', '364696137_2896008720532733_7482788190110373134_n.jpg', 0, 'ewallet', '2023-10-17 13:31:40', '2024-03-06 22:11:28'),
(58, '006436458', 'MAYA', '09123456785', 'Maya Standee-1.webp', 0, 'ewallet', '2023-10-17 14:10:10', '2024-03-06 22:12:01'),
(67, '006653667', 'BPI', '1000000120', 'bpi.webp', 1, 'bank', '2023-11-11 16:12:42', '2023-11-19 21:53:20'),
(69, '002018069', 'BDO', '1032165498', '7.jpg', 1, 'bank', '2023-11-14 09:12:09', '');

-- --------------------------------------------------------

--
-- Table structure for table `new_cart`
--

CREATE TABLE `new_cart` (
  `cart_id` int(20) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `new_cart`
--

INSERT INTO `new_cart` (`cart_id`, `prod_id`, `qty`, `user_id`) VALUES
(77, 255, 6, 224),
(92, 276, 5, 225),
(93, 259, 2, 225),
(94, 265, 1, 225),
(96, 271, 4, 238),
(97, 274, 1, 238),
(103, 275, 4, 241),
(104, 272, 1, 241),
(106, 271, 1, 241),
(112, 274, 1, 226),
(133, 257, 4, 252),
(137, 287, 1, 223),
(138, 257, 1, 226),
(139, 258, 1, 226),
(141, 259, 1, 267),
(142, 258, 1, 267),
(143, 257, 1, 268),
(144, 266, 1, 268),
(146, 286, 1, 246),
(147, 257, 1, 246);

-- --------------------------------------------------------

--
-- Table structure for table `new_tbl_orders`
--

CREATE TABLE `new_tbl_orders` (
  `order_id` varchar(50) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `payment_id` varchar(11) NOT NULL,
  `pof` varchar(60) DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `vat` decimal(10,2) NOT NULL,
  `sf` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `delivered_date` datetime DEFAULT NULL,
  `rider_id` int(11) DEFAULT NULL,
  `status` varchar(30) NOT NULL,
  `reject_reason` varchar(255) DEFAULT NULL,
  `proof_of_del` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `new_tbl_orders`
--

INSERT INTO `new_tbl_orders` (`order_id`, `cust_id`, `payment_id`, `pof`, `subtotal`, `vat`, `sf`, `total`, `order_date`, `delivered_date`, `rider_id`, `status`, `reject_reason`, `proof_of_del`) VALUES
('ORD-142105', 234, '58', 'ORD-142105.png', 185.00, 22.20, 10.00, 217.20, '2024-02-28 22:44:30', NULL, NULL, 'Cancelled', NULL, ''),
('ORD-213147', 234, '58', 'ORD-213147.jpeg', 1122.00, 134.64, 10.00, 1266.64, '2024-02-28 22:45:45', NULL, NULL, 'Cancelled', NULL, ''),
('ORD-238827', 234, 'COD', NULL, 480.00, 48.00, 10.00, 538.00, '2024-03-06 21:47:41', NULL, NULL, 'Cancelled', NULL, ''),
('ORD-250645', 226, '57', 'ORD-250645.png', 40.00, 4.80, 10.00, 54.80, '2024-02-27 22:24:02', NULL, 228, 'Shipped', NULL, ''),
('ORD-276607', 252, '57', 'ORD-276607.jpg', 62.00, 6.20, 80.00, 148.20, '2024-02-29 16:37:55', '2024-02-29 16:41:14', 228, 'Delivered', NULL, 'proof_of_del_7963301166.jpg'),
('ORD-290426', 223, '57', 'ORD-290426.jpg', 100.00, 12.00, 80.00, 192.00, '2024-02-27 22:46:58', NULL, NULL, 'Pending', NULL, ''),
('ORD-290736', 234, '58', 'ORD-290736.png', 185.00, 22.20, 10.00, 217.20, '2024-02-28 22:43:49', NULL, NULL, 'Cancelled', NULL, ''),
('ORD-301651', 249, '57', 'ORD-301651.jpg', 240.00, 28.80, 10.00, 278.80, '2024-02-28 23:25:47', '2024-02-28 23:31:05', 250, 'Delivered', NULL, 'proof_of_del_4194545267.jpg'),
('ORD-388565', 226, 'COD', NULL, 140.00, 16.80, 10.00, 166.80, '2024-02-25 12:43:52', '2024-02-25 13:05:11', 16, 'Delivered', NULL, 'proof_of_del_5639775789.png'),
('ORD-417162', 251, '57', 'ORD-417162.jpg', 480.00, 48.00, 30.00, 558.00, '2024-02-29 10:04:20', '2024-02-29 10:07:29', 250, 'Delivered', NULL, 'proof_of_del_3938352078.jpg'),
('ORD-432294', 226, 'COD', NULL, 100.00, 12.00, 10.00, 122.00, '2024-02-25 14:12:59', '2024-02-25 14:13:31', 16, 'Delivered', NULL, 'proof_of_del_7400632930.png'),
('ORD-547492', 253, '58', 'ORD-547492.jpg', 720.00, 72.00, 150.00, 942.00, '2024-03-04 12:45:33', '2024-03-04 12:47:34', 228, 'Delivered', NULL, 'proof_of_del_5523869610.jpg'),
('ORD-636833', 234, '58', 'ORD-636833.png', 185.00, 22.20, 10.00, 217.20, '2024-02-28 22:44:35', NULL, NULL, 'Cancelled', NULL, ''),
('ORD-751059', 246, 'COD', NULL, 160.00, 16.00, 80.00, 256.00, '2024-07-02 21:22:02', NULL, NULL, 'Pending', NULL, ''),
('ORD-825276', 234, '58', 'ORD-825276.png', 185.00, 22.20, 10.00, 217.20, '2024-02-28 22:44:33', NULL, NULL, 'Cancelled', NULL, ''),
('ORD-826417', 234, '58', 'ORD-826417.png', 185.00, 22.20, 10.00, 217.20, '2024-02-28 22:44:30', NULL, NULL, 'Cancelled', NULL, ''),
('ORD-917981', 234, 'COD', NULL, 2400.00, 288.00, 10.00, 2698.00, '2024-02-27 22:08:59', NULL, NULL, 'Rejected', NULL, ''),
('ORD-98954', 234, '58', 'ORD-98954.png', 185.00, 22.20, 10.00, 217.20, '2024-02-28 22:44:29', NULL, NULL, 'Cancelled', NULL, ''),
('ORD-990516', 234, '58', 'ORD-990516.png', 185.00, 22.20, 10.00, 217.20, '2024-02-28 22:44:33', NULL, NULL, 'Cancelled', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `new_tbl_order_items`
--

CREATE TABLE `new_tbl_order_items` (
  `id` int(50) NOT NULL,
  `order_id` varchar(50) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `new_tbl_order_items`
--

INSERT INTO `new_tbl_order_items` (`id`, `order_id`, `product_id`, `qty`) VALUES
(41, 'ORD-314701', 255, 1),
(42, 'ORD-59454', 255, 1),
(43, 'ORD-856262', 255, 1),
(44, 'ORD-798562', 255, 3),
(45, 'ORD-213856', 255, 14),
(46, 'ORD-974469', 255, 5),
(47, 'ORD-109134', 255, 10),
(48, 'ORD-245143', 257, 1),
(49, 'ORD-305901', 258, 2),
(50, 'ORD-305901', 274, 1),
(51, 'ORD-40275', 273, 2),
(52, 'ORD-908018', 273, 1),
(53, 'ORD-513659', 274, 10),
(54, 'ORD-359731', 268, 1),
(55, 'ORD-61835', 274, 3),
(56, 'ORD-388565', 274, 1),
(57, 'ORD-388565', 273, 1),
(58, 'ORD-432294', 274, 1),
(59, 'ORD-917981', 261, 4),
(60, 'ORD-250645', 273, 1),
(61, 'ORD-290426', 274, 1),
(62, 'ORD-290736', 257, 1),
(63, 'ORD-290736', 259, 3),
(64, 'ORD-98954', 257, 1),
(65, 'ORD-98954', 259, 3),
(66, 'ORD-142105', 257, 1),
(67, 'ORD-142105', 259, 3),
(68, 'ORD-826417', 257, 1),
(69, 'ORD-826417', 259, 3),
(70, 'ORD-825276', 257, 1),
(71, 'ORD-825276', 259, 3),
(72, 'ORD-990516', 257, 1),
(73, 'ORD-990516', 259, 3),
(74, 'ORD-636833', 257, 1),
(75, 'ORD-636833', 259, 3),
(76, 'ORD-213147', 258, 1),
(77, 'ORD-213147', 262, 1),
(78, 'ORD-213147', 261, 1),
(79, 'ORD-213147', 269, 1),
(80, 'ORD-213147', 267, 1),
(81, 'ORD-301651', 257, 1),
(82, 'ORD-301651', 258, 1),
(83, 'ORD-417162', 257, 4),
(84, 'ORD-417162', 258, 1),
(85, 'ORD-276607', 268, 1),
(86, 'ORD-547492', 257, 1),
(87, 'ORD-547492', 258, 4),
(88, 'ORD-238827', 258, 2),
(89, 'ORD-238827', 257, 2),
(90, 'ORD-751059', 258, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orders_id` int(11) NOT NULL,
  `order_transaction_code` varchar(10) NOT NULL,
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
  `orders_gradeTotal` varchar(255) NOT NULL,
  `orders_ship_fee` double NOT NULL,
  `orders_tax` float NOT NULL,
  `orders_voucher_name` varchar(255) DEFAULT NULL,
  `orders_voucher_rate` varchar(255) DEFAULT NULL,
  `orders_address` varchar(255) NOT NULL,
  `orders_date` datetime NOT NULL,
  `orders_dates_delivered` datetime DEFAULT NULL,
  `orders_status` varchar(255) NOT NULL,
  `display_status` int(11) NOT NULL,
  `order_barcode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orders_id`, `order_transaction_code`, `orders_prod_id`, `orders_customer_id`, `orders_nickname`, `orders_email`, `orders_contact`, `orders_paymethod`, `orders_proof`, `orders_qty`, `orders_stock_id`, `orders_prod_price`, `orders_subtotal`, `orders_gradeTotal`, `orders_ship_fee`, `orders_tax`, `orders_voucher_name`, `orders_voucher_rate`, `orders_address`, `orders_date`, `orders_dates_delivered`, `orders_status`, `display_status`, `order_barcode`) VALUES
(1202, 'RD37457', 252, 208, 'Emmanuel Ugaban', 'ugabane0516@gmail.com', '09123456789', 'Cash on Delivery', NULL, 1, 420, 100, 100, '100', 30, 1, '', '0', 'Region III (Central Luzon) Bulacan Marilao Patubig aksjdkjashd', '2024-01-10 15:31:35', NULL, 'Pending', 0, 'RD37457.png');

-- --------------------------------------------------------

--
-- Table structure for table `pickup`
--

CREATE TABLE `pickup` (
  `pickup_id` int(11) NOT NULL,
  `p_customer_name` varchar(255) NOT NULL,
  `p_date` datetime NOT NULL,
  `p_pickup_date` varchar(255) NOT NULL,
  `p_pickup_time` varchar(255) NOT NULL,
  `p_pickup_code` varchar(12) NOT NULL,
  `p_prod_id` int(11) NOT NULL,
  `p_acc_id` int(11) NOT NULL,
  `p_paymethod` varchar(255) NOT NULL,
  `p_proof` varchar(255) NOT NULL,
  `p_qty` int(11) NOT NULL,
  `p_stock_id` int(11) NOT NULL,
  `p_prod_price` double NOT NULL,
  `p_subtotal` double NOT NULL,
  `p_grand_total` varchar(255) NOT NULL,
  `p_tax` double NOT NULL,
  `p_voucher_name` varchar(255) DEFAULT NULL,
  `p_voucher_rate` varchar(255) DEFAULT NULL,
  `p_status` varchar(255) NOT NULL,
  `p_display_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pos_cart`
--

CREATE TABLE `pos_cart` (
  `pos_cart_id` int(11) NOT NULL,
  `pos_cart_prod_id` int(11) NOT NULL,
  `pos_cart_user_id` int(11) NOT NULL,
  `cart_prodQty` int(11) NOT NULL,
  `pos_cart_stock_id` int(11) NOT NULL,
  `subtotal` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pos_orders`
--

CREATE TABLE `pos_orders` (
  `orders_orders_id` int(11) NOT NULL,
  `orders_tcode` varchar(8) NOT NULL,
  `orders_prod_id` int(10) NOT NULL,
  `orders_prod_price` decimal(12,2) NOT NULL,
  `orders_prodQty` int(11) NOT NULL,
  `orders_subtotal` decimal(12,2) NOT NULL,
  `orders_discount` int(11) DEFAULT NULL,
  `orders_discount_name` varchar(255) DEFAULT NULL,
  `orders_tax` double NOT NULL,
  `orders_date` datetime NOT NULL,
  `orders_final` decimal(12,2) NOT NULL,
  `orders_payment` decimal(12,2) NOT NULL,
  `orders_change` decimal(12,2) NOT NULL,
  `orders_user_id` int(11) NOT NULL,
  `orders_status` int(11) NOT NULL,
  `return_availability` int(11) NOT NULL,
  `orders_barcode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pos_orders`
--

INSERT INTO `pos_orders` (`orders_orders_id`, `orders_tcode`, `orders_prod_id`, `orders_prod_price`, `orders_prodQty`, `orders_subtotal`, `orders_discount`, `orders_discount_name`, `orders_tax`, `orders_date`, `orders_final`, `orders_payment`, `orders_change`, `orders_user_id`, `orders_status`, `return_availability`, `orders_barcode`) VALUES
(879, 'RD74993', 244, 100.00, 1, 100.00, 0, '', 1, '2024-01-07 20:06:05', 100.00, 100.00, 0.00, 16, 0, 0, 'RD74993.png'),
(880, 'RD13622', 244, 100.00, 2, 200.00, 0, '', 2, '2024-01-07 22:05:21', 200.00, 200.00, 0.00, 16, 0, 0, 'RD13622.png'),
(881, 'RD38187', 243, 35.00, 101, 3535.00, 0, '', 35.35, '2024-01-08 16:46:04', 3535.00, 4000.00, 465.00, 16, 0, 0, 'RD38187.png'),
(882, 'RD51761', 244, 100.00, 1, 100.00, 0, '', 12.12, '2024-02-09 19:06:34', 10100.00, 10100.00, 0.00, 16, 0, 0, 'RD51761.png'),
(883, 'RD51761', 252, 100.00, 100, 10000.00, 0, '', 12.12, '2024-02-09 19:06:34', 10100.00, 10100.00, 0.00, 16, 0, 0, 'RD51761.png'),
(884, 'RD57056', 243, 35.00, 1, 35.00, 5, 'suki ', 0.28, '2024-02-14 05:18:36', 230.30, 1000.00, 769.70, 16, 0, 0, 'RD57056.png'),
(885, 'RD57056', 252, 100.00, 1, 100.00, 5, 'suki ', 0.28, '2024-02-14 05:18:36', 230.30, 1000.00, 769.70, 16, 0, 0, 'RD57056.png'),
(886, 'RD57056', 253, 100.00, 1, 100.00, 5, 'suki ', 0.28, '2024-02-14 05:18:36', 230.30, 1000.00, 769.70, 16, 0, 0, 'RD57056.png'),
(887, 'RD92233', 243, 35.00, 3, 105.00, 12, 'suki ', 0.71, '2024-02-16 05:23:19', 592.90, 600.00, 7.10, 16, 0, 0, 'RD92233.png'),
(888, 'RD92233', 253, 100.00, 5, 500.00, 12, 'suki ', 0.71, '2024-02-16 05:23:19', 592.90, 600.00, 7.10, 16, 0, 0, 'RD92233.png'),
(889, 'RD42869', 255, 100.00, 4, 400.00, 0, '', 0.48, '2024-02-17 14:03:05', 400.00, 500.00, 100.00, 16, 0, 0, 'RD42869.png'),
(890, 'RD90235', 255, 100.00, 4, 400.00, 8, 'suki ', 0.47, '2024-02-17 14:09:52', 392.00, 888.00, 496.00, 16, 0, 0, 'RD90235.png'),
(891, 'RD96582', 255, 100.00, 6, 600.00, 0, '', 0.72, '2024-02-19 09:16:12', 600.00, 1000.00, 400.00, 16, 0, 0, 'RD96582.png'),
(892, 'RD65212', 255, 100.00, 5, 500.00, 10, 'suki ', 0.59, '2024-02-19 15:58:20', 490.00, 500.00, 10.00, 16, 0, 0, 'RD65212.png'),
(893, 'RD40096', 277, 100.00, 5, 500.00, 0, '', 0.6, '2024-02-23 02:17:05', 500.00, 600.00, 100.00, 16, 0, 0, 'RD40096.png'),
(894, 'RD73309', 276, 450.00, 6, 2700.00, 64, 'suki ', 3.14, '2024-02-29 02:09:02', 3136.00, 5000.00, 1864.00, 16, 0, 0, 'RD73309.png'),
(895, 'RD73309', 277, 100.00, 5, 500.00, 64, 'suki ', 3.14, '2024-02-29 02:09:02', 3136.00, 5000.00, 1864.00, 16, 0, 0, 'RD73309.png'),
(896, 'RD37556', 277, 100.00, 1, 100.00, 0, '', 0.1, '2024-03-02 05:07:41', 100.00, 1000.00, 900.00, 16, 0, 0, 'RD37556.png'),
(897, 'RD25357', 277, 100.00, 50, 5000.00, 0, '', 5, '2024-03-04 01:51:49', 5000.00, 10000.00, 5000.00, 16, 0, 0, 'RD25357.png'),
(898, 'RD36862', 274, 100.00, 5, 500.00, 0, '', 0.5, '2024-03-04 04:53:26', 500.00, 500.00, 0.00, 16, 0, 0, 'RD36862.png');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `prod_id` int(11) NOT NULL,
  `prod_code` varchar(11) NOT NULL,
  `prod_name` varchar(30) NOT NULL,
  `prod_currprice` decimal(12,2) NOT NULL,
  `prod_mg` decimal(10,0) NOT NULL,
  `prod_ml` decimal(10,0) DEFAULT NULL,
  `prod_g` decimal(10,0) DEFAULT NULL,
  `prod_category_id` int(11) NOT NULL,
  `prod_critical` int(11) NOT NULL,
  `prod_description` text DEFAULT NULL,
  `prod_voucher_id` int(11) NOT NULL,
  `prod_image` varchar(30) DEFAULT NULL,
  `prod_added` datetime NOT NULL,
  `prod_edit` datetime DEFAULT NULL,
  `prod_status` int(11) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `prod_sell_onlline` tinyint(1) NOT NULL,
  `prod_vatable` tinyint(1) NOT NULL,
  `prod_expirationStatus` varchar(25) NOT NULL,
  `unit_type` varchar(60) NOT NULL,
  `prod_kg` int(11) NOT NULL,
  `prod_unit_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prod_id`, `prod_code`, `prod_name`, `prod_currprice`, `prod_mg`, `prod_ml`, `prod_g`, `prod_category_id`, `prod_critical`, `prod_description`, `prod_voucher_id`, `prod_image`, `prod_added`, `prod_edit`, `prod_status`, `barcode`, `prod_sell_onlline`, `prod_vatable`, `prod_expirationStatus`, `unit_type`, `prod_kg`, `prod_unit_id`) VALUES
(242, 'PROD35228', 'painuman', 100.00, 0, 0, 0, 1, 10, 'painuman ng manok', 0, '65811fc5d68c6.jpg', '2023-12-19 12:44:53', '2024-01-06 13:22:09', 2, 'PROD35228.png', 1, 0, 'N/A', 'pcs', 0, 0),
(243, 'PROD55296', 'ambroxitil', 35.00, 0, 100, 0, 3, 1, 'adawdawdwad', 0, '65811fe688ba7.jpeg', '2023-12-19 12:45:26', '2024-01-06 13:22:02', 2, 'PROD55296.png', 1, 0, 'withExpi', 'pcs', 0, 0),
(244, 'PROD41785', 'painuman kulay pula', 100.00, 0, 0, 0, 1, 20, 'dwadawdwdwad', 0, '65812019de6a3.jpg', '2023-12-19 12:46:17', '2024-01-06 13:21:54', 2, 'PROD41785.png', 1, 0, 'N/A', 'pcs', 0, 0),
(245, 'PROD90256', 'fedegree', 120.00, 0, 0, 10, 2, 10, 'qqqqqqqqqq', 0, '658120483a1f8.jpg', '2023-12-19 12:47:04', '2024-01-06 13:21:23', 2, 'PROD90256.png', 1, 0, 'withExpi', 'kg', 0, 0),
(249, 'PROD83088', 'Sample Product', 100.00, 0, 0, 0, 1, 100, 'samplasdjakjsdhkjashdjahsdji', 0, '6596c566cca02.jpg', '2024-01-04 22:49:10', NULL, 2, 'PROD83088.png', 1, 0, 'N/A', 'kg', 0, 0),
(250, 'PROD39770', 'Heyyyyy', 100.00, 0, 20, 0, 1, 123, 'asmhdjasdhjasgdgasd', 0, '6596cc306e626.jpg', '2024-01-04 22:52:51', '2024-01-04 23:18:08', 2, 'PROD39770.png', 1, 0, 'N/A', 'kg', 0, 0),
(251, 'PROD59322', 'new product', 100.00, 0, 10, 0, 1, 100, 'asdjkahsdkjhasjkdh', 35, '659a92e420c3d.jpg', '2024-01-07 20:02:44', NULL, 2, 'PROD59322.png', 1, 0, 'N/A', 'kg', 0, 0),
(252, 'PROD60346', 'New Product', 100.00, 0, 0, 0, 1, 10, 'ksjklskjhdkjashdkj', 0, '65cba123cf696.jpg', '2024-01-07 21:05:21', '2024-02-14 01:04:35', 2, 'PROD60346.png', 1, 0, 'withExpi', 'kg', 0, 0),
(253, 'PROD68095', 'Product 1', 100.00, 10, 10, 10, 1, 100, 'asdasdakjsdhjagsdj', 0, '65c61859758fd.png', '2024-02-09 20:19:37', NULL, 2, 'PROD68095.png', 1, 0, 'withExpi', 'pcs', 0, 0),
(254, 'PROD73180', 'Feeds', 100.00, 0, 0, 0, 2, 10, 'Pagkain sa manok', 0, '65d0addb07e17.png', '2024-02-17 21:00:11', NULL, 2, 'PROD73180.png', 1, 0, 'N/A', 'kg', 0, 0),
(255, 'PROD86430', 'Pagkain ng Manok  Feeds', 100.00, 500, 1000, 0, 2, 10, 'Scientifically formulated with SPLIT peas for easier digestion. To increase fighting speed, Vigor and sharpness of your game birds.\r\n\r\n\r\nNUTRITIONAL FACTS\r\n\r\nCrude Protein not lower than...................16\r\n\r\nCrude Fat not lower than..........................2.5\r\n\r\nCrude Fiber not more than.......................10\r\n\r\nAsh not more than......................................4\r\n\r\n\r\nINGREDIENTS\r\n\r\nAustrian Peas, Feed Wheat, Feed Barley, Bamboo Beans, Cracked Corn, Dari, Jockey Oats, Split Green Peas, Split Yellow Peas, Black Sunflower, Red Sorghum, Safflower and Vetch.', 0, '65d0c966aa04a.jpeg', '2024-02-17 21:02:34', '2024-02-17 22:57:42', 2, 'PROD86430.png', 1, 0, 'N/A', 'kg', 0, 0),
(256, 'PROD41364', 'milo', 123.00, 0, 0, 0, 3, 15, 'awdwadwawadwadwadwa', 0, '65d6f3eaeb499.png', '2024-02-22 15:12:42', NULL, 2, 'PROD41364.png', 1, 0, 'withExpi', 'kg', 0, 0),
(257, 'PROD84296', 'Bayong Big', 80.00, 0, 0, 0, 1, 50, 'A bayong is a traditional Filipino bag, usually woven from indigenous materials like rattan or buri leaves. It is commonly used for carrying groceries, clothes, or other items. The bags design is simple and versatile, making it a popular choice for everyday use in the Philippines.', 0, '65d71325d9400.jpg', '2024-02-22 17:25:57', '2024-02-22 17:29:51', 0, 'PROD84296.png', 1, 0, 'N/A', 'pcs', 0, 0),
(258, 'PROD5091', 'Cat Litter 5kg', 160.00, 0, 0, 0, 1, 20, 'Cat litter is a granular substance used in litter boxes to absorb moisture and control odors from cat waste. It can be made from various materials like clay, silica gel, wood, or recycled paper. Litter is essential for maintaining a clean and hygienic environment for indoor cats.', 0, '65d713763820a.jpg', '2024-02-22 17:27:18', '2024-02-22 17:31:01', 0, 'PROD5091.png', 1, 0, 'N/A', 'pcs', 0, 0),
(259, 'PROD21129', 'Chewing Toy Bone  Small', 35.00, 0, 0, 0, 1, 50, '\r\nThe chewing toy bone for dogs is a durable, often rubberbased, boneshaped toy designed to satisfy a dogs natural urge to chew. It helps promote dental health by cleaning teeth and massaging gums. These toys come in various sizes and textures, catering to different breeds and chewing preferences.', 0, '65d713eb6909c.jpg', '2024-02-22 17:29:15', NULL, 0, 'PROD21129.png', 1, 0, 'N/A', 'pcs', 0, 0),
(260, 'PROD48973', 'Chicken Cage', 360.00, 0, 0, 0, 1, 50, '\r\nA chicken cage, also known as a chicken coop or hen house, is a shelter used to house chickens. It provides a safe and secure environment for the birds to roost, lay eggs, and seek protection from predators. Coops vary in size and design, from small backyard structures to large commercial operations.', 0, '65d714aa5099b.jpg', '2024-02-22 17:32:26', NULL, 0, 'PROD48973.png', 1, 0, 'N/A', 'pcs', 0, 0),
(261, 'PROD15868', 'Dog Bag', 600.00, 0, 0, 0, 1, 50, 'A dog bag, also known as a dog carrier or dog tote, is a portable bag designed to transport small dogs. It typically features a soft, comfortable interior and mesh windows for ventilation. Dog bags come in various styles, including backpacks, slings, and purses, providing convenience and safety for pet owners on the go.', 0, '65d7153549c68.jpg', '2024-02-22 17:34:45', NULL, 0, 'PROD15868.png', 1, 0, 'N/A', 'pcs', 0, 0),
(262, 'PROD33772', 'Dog Cage', 267.00, 0, 0, 0, 1, 50, '\r\nA dog cage, also known as a dog crate or kennel, is a secure enclosure used for housing and transporting dogs. It provides a safe and comfortable space for the dog to rest, sleep, or travel. Dog cages come in various sizes and materials, catering to different breeds and purposes.', 0, '65d715f3c9baf.jpg', '2024-02-22 17:37:55', NULL, 0, 'PROD33772.png', 1, 0, 'N/A', 'pcs', 0, 0),
(263, 'PROD3248', 'Dog Collar  Small', 80.00, 0, 0, 0, 1, 50, '\r\nA dog collar is a strap or band placed around a dogs neck. It serves various purposes, including identification, control, and training. Collars can be made from different materials like nylon, leather, or metal, and they often have a buckle or clasp for easy adjustment. Some collars also feature tags or electronic devices for tracking and monitoring.', 0, '65d71652d1051.jpg', '2024-02-22 17:39:30', NULL, 2, 'PROD3248.png', 1, 0, 'N/A', 'pcs', 0, 0),
(264, 'PROD98434', 'Dog Collar  Medium', 90.00, 0, 0, 0, 1, 50, '\r\nA dog collar is a strap or band placed around a dogs neck. It serves various purposes, including identification, control, and training. Collars can be made from different materials like nylon, leather, or metal, and they often have a buckle or clasp for easy adjustment. Some collars also feature tags or electronic devices for tracking and monitoring.', 0, '65d7167e514a1.jpg', '2024-02-22 17:40:14', NULL, 2, 'PROD98434.png', 1, 0, 'N/A', 'pcs', 0, 0),
(265, 'PROD98769', 'Dog Collar Large', 100.00, 0, 0, 0, 1, 50, '\r\nA dog collar is a strap or band placed around a dogs neck. It serves various purposes, including identification, control, and training. Collars can be made from different materials like nylon, leather, or metal, and they often have a buckle or clasp for easy adjustment. Some collars also feature tags or electronic devices for tracking and monitoring.', 0, '65d7169d55c30.jpg', '2024-02-22 17:40:45', NULL, 0, 'PROD98769.png', 1, 0, 'N/A', 'pcs', 0, 0),
(266, 'PROD65507', 'Hair Brush', 60.00, 0, 0, 0, 1, 50, '\r\nA puppy hairbrush is a grooming tool designed to remove loose hair and debris from a puppys coat. It helps maintain a healthy and shiny coat, prevents matting, and reduces shedding. Puppy hairbrushes come in various sizes and materials, including bristle, pin, and slicker brushes, catering to different coat types and lengths.', 0, '65d716eb281df.jpg', '2024-02-22 17:42:03', NULL, 0, 'PROD65507.png', 1, 0, 'N/A', 'pcs', 0, 0),
(267, 'PROD25419', 'Hushpet Diaper', 25.00, 0, 0, 0, 1, 50, '\r\nThe Hush Pet Diaper is a pet accessory designed to provide comfort and convenience for dogs and cats with incontinence or during house training. It is typically made of absorbent materials and features adjustable straps for a secure and comfortable fit. The diaper helps prevent messes and keeps pets dry and clean.', 0, '65d71831bec1d.jpg', '2024-02-22 17:47:29', NULL, 0, 'PROD25419.png', 1, 0, 'N/A', 'pcs', 0, 0),
(268, 'PROD80192', 'Lori Soap', 62.00, 0, 0, 0, 1, 50, '\r\nLori soap is a type of soap made from the oil of the Lori tree Calophyllum inophyllum. It is popular in the Pacific Islands and Southeast Asia, where it is used for skin and hair care. Lori soap is known for its moisturizing properties and is used for its antiinflammatory and antibacterial properties.', 0, '65d7188622b6f.jpg', '2024-02-22 17:48:54', NULL, 0, 'PROD80192.png', 1, 0, 'N/A', 'pcs', 0, 0),
(269, 'PROD57713', 'Paw Roller', 70.00, 0, 0, 0, 1, 50, 'A paw roller could refer to a grooming tool used to remove loose fur and debris from a pets paws. It typically has a roller or brush mechanism that can be rolled over the paw to collect hair and dirt. This helps keep the paws clean and reduces the amount of dirt tracked into the home.', 0, '65d7190bd4fda.jpg', '2024-02-22 17:51:07', NULL, 0, 'PROD57713.png', 1, 0, 'N/A', 'pcs', 0, 0),
(270, 'PROD21243', 'Pet Carrier', 1226.00, 0, 0, 0, 1, 50, 'A pet carrier is a portable container used to transport small animals, such as cats, dogs, rabbits, or birds. It is typically made of plastic, metal, or fabric and has a handle or shoulder strap for easy carrying. Pet carriers provide a safe and secure way to transport pets to the vet, groomer, or while traveling.', 0, '65d7194cc1b3c.jpg', '2024-02-22 17:52:12', NULL, 0, 'PROD21243.png', 1, 0, 'N/A', 'pcs', 0, 0),
(271, 'PROD64840', 'Plastic Bowl for Dog', 30.00, 0, 0, 0, 1, 50, '\r\nA plastic bowl for dogs is a food or water dish made of plastic material. It is lightweight, durable, and easy to clean. Plastic bowls come in various sizes, shapes, and colors, catering to different breeds and preferences. They are a popular choice for pet owners due to their affordability and practicality.', 0, '65d7199cd5416.jpg', '2024-02-22 17:53:32', NULL, 0, 'PROD64840.png', 1, 0, 'N/A', 'pcs', 0, 0),
(272, 'PROD77746', 'S Hook', 100.00, 0, 0, 0, 1, 50, '\r\nAn S hook is a type of fastener consisting of a curved metal wire shaped like the letter S. It has two open ends that can be used to attach or hang objects. S hooks are commonly used in a variety of applications, including hanging plants, securing chains, and organizing tools or kitchen utensils.', 0, '65d719caf192a.jpg', '2024-02-22 17:54:18', NULL, 0, 'PROD77746.png', 1, 0, 'N/A', 'pcs', 0, 0),
(273, 'PROD4589', 'Tooth Brush', 40.00, 0, 0, 0, 1, 50, 'A toothbrush for pets is a grooming tool designed specifically for cleaning a pets teeth. It typically has a smaller head and softer bristles than a human toothbrush, making it more comfortable for pets. Pet toothbrushes come in various sizes and shapes, catering to different breeds and sizes of animals. They are used to prevent dental issues and maintain oral hygiene in pets.', 0, '65d71b123ee08.jpg', '2024-02-22 17:59:46', NULL, 0, 'PROD4589.png', 1, 0, 'N/A', 'pcs', 0, 0),
(274, 'PROD83680', 'Water Bottle Bird', 100.00, 0, 0, 0, 1, 100, '\r\nA water bottle for birds is a container designed to provide a continuous supply of water for pet birds. It typically consists of a plastic or glass bottle with a metal tube or ball bearing at the bottom. When the bird drinks from the tube, the water is released, ensuring a clean and accessible water source. This design helps prevent contamination and spillage, making it a convenient option for bird owners.', 0, '65d71b552b60c.jpg', '2024-02-22 18:00:53', NULL, 0, 'PROD83680.png', 1, 0, 'N/A', 'pcs', 0, 0),
(275, 'PROD40561', 'Water Pot for Chicken', 250.00, 0, 0, 0, 1, 50, '\r\nA water pot for chickens is a container used to provide a continuous supply of water for poultry. It typically consists of a plastic or metal pot with a narrow opening and a wide base to prevent tipping. The pot is filled with water, and the chickens can access the water through a small opening or a nipple drinker. This design helps prevent contamination and ensures that the chickens have access to clean water at all times.', 0, '65d71baf156aa.jpg', '2024-02-22 18:02:23', NULL, 0, 'PROD40561.png', 1, 0, 'N/A', 'pcs', 0, 0),
(276, 'PROD11219', 'Wooden Bird Box', 450.00, 0, 0, 0, 1, 50, 'A wooden bird box, also known as a birdhouse or nesting box, is a small structure made of wood that provides a safe and comfortable nesting site for birds. It typically has a small entrance hole, a floor, and a roof, and it may have a hinged door for cleaning. Bird boxes come in various shapes and sizes, catering to different bird species. They are placed in gardens, parks, or natural areas to encourage nesting and provide shelter for birds.', 0, '65d71bf35793b.jpg', '2024-02-22 18:03:31', '2024-02-23 13:04:52', 0, 'PROD11219.png', 0, 0, 'N/A', 'pcs', 0, 0),
(277, 'PROD30333', 'Wood Flakes', 100.00, 0, 0, 0, 1, 50, 'Wood flakes, also known as wood shavings or wood chips, are small pieces of wood that are typically used as bedding material for small animals, such as hamsters, guinea pigs, rabbits, and birds. Wood flakes are often made from softwood species like pine or cedar, and they provide a comfortable and absorbent surface for animals to rest on. They also help control odors and absorb moisture, making them a popular choice for pet owners.', 0, '65d71c216fea1.jpg', '2024-02-22 18:04:17', '2024-02-22 21:53:21', 0, 'PROD30333.png', 0, 0, 'N/A', 'kg', 0, 0),
(278, 'PROD84742', 'new product', 100.00, 500, 0, 0, 2, 100, 'hgjhagdjhasghjdgashjdgasd', 0, '65d758cd8517e.png', '2024-02-22 22:23:09', '2024-02-23 13:02:54', 0, 'PROD84742.png', 0, 0, 'N/A', 'kg', 0, 0),
(279, 'PROD22904', 'Beef Teriyaki', 523.00, 0, 0, 0, 2, 15, 'Size 8kg\r\nFlavor Beef teriyaki\r\nDry dog food\r\n \r\n\r\nIngredients\r\nMeat, meal, ground rice, high protein soyben meal, beef tallow preserved with mixed tacopherols, source of natural vitamin E, rice bran, dried banana meal, banana flour, flax seed, lecithin, calcium phosphate, amino acids supplements Llysine HCI, DLMethionine, LThreonine, yucca schidigera extract , salt, trace minerals, copper, sulfate, ferrous sulfate, magnesium sulfate, potassium iodide, sodium selenite, zinc oxide, vitamin supplements choline chloride, vit A, vit D3, vit E, thiamine mononitrate, riboflavin, vit B, vit B12, nlacin, biotin, folic acid.\r\n \r\n\r\nGuaranteed analysis\r\nCrude protein min 19.0\r\nCrude fat min 8.0\r\nCrude fiber 5.0\r\nCrude ash, max 12.0\r\nMoisture 12.0', 0, '65df5826071ab.jpg', '2024-02-28 23:58:30', NULL, 0, 'PROD22904.png', 1, 0, 'N/A', 'kg', 0, 0),
(280, 'PROD35580', 'Amtyl 500', 13.00, 0, 0, 0, 3, 10, 'Amtyl 500, the No. 1 and most trusted antibiotic brand for gamefowls, contains the powerful combination ofAmoxicillin and Tylosin. Its components are effective against respiratory, urogenital and integumentary system of gamefowls. Numerous foreign and local breeders refer to AMTYL 500 as a miracle drug.\r\n\r\nFor Prevention and Treatment of the following\r\nInfectious Coryza or Pisik na sipon\r\nChronic Respiratory Disease CRD or Halak na sipon\r\nFowl Pox\r\nAll type of wounds\r\nBacterial flushing', 0, '65df5952bd591.jpg', '2024-02-29 00:03:30', NULL, 0, 'PROD35580.png', 1, 0, 'withExpi', 'pcs', 0, 0),
(281, 'PROD54484', 'Dog Bag', 600.00, 0, 0, 0, 1, 10, 'Dog Front Carrier Bag Adjustable, Legs Out, Pet Cat Dog Carrier Backpack for Walking, Traveling, Hiking, Camping, Bike and Motorcycle\r\n\r\nBag size\r\nS28cm18cm', 0, '65df5a8d04f17.png', '2024-02-29 00:08:45', NULL, 0, 'PROD54484.png', 1, 0, 'N/A', 'pcs', 0, 0),
(282, 'PROD80899', 'Hair Brush', 60.00, 0, 0, 0, 1, 15, 'Brush Mix Colors is a handy grooming tool designed specifically for removing pet hair from various surfaces. The brush features a mix of colors, adding a vibrant and fun touch to the grooming process.\r\n\r\n', 0, '65df5b93d0055.jpg', '2024-02-29 00:13:07', NULL, 2, 'PROD80899.png', 1, 0, 'N/A', 'pcs', 0, 0),
(283, 'PROD80158', 'Dog Collar Big', 100.00, 0, 0, 0, 1, 10, 'Collars are made from hightensile strength nylon webbing with sewn on polyester and nylon ribbons, and are stain and fray resistant. They are designed to last a lifetime Complete the look with the matching harness and lead.\r\n\r\nMachine washable\r\nAll hardware is cast brass, not welded, for extra strength\r\nBuckles are Coast Guard approved for high weight hold\r\n', 0, '65df5ccbbc4be.jpg', '2024-02-29 00:18:19', NULL, 0, 'PROD80158.png', 1, 0, 'N/A', 'pcs', 0, 0),
(284, 'PROD36803', 'Aozi Puppy ', 3399.00, 0, 0, 0, 2, 10, 'Aozi Dry Food\r\nFor Puppy of All Breeds\r\nYounger than 10 months of age, also suitable for Pregnant and Lactating Dogs\r\nAozi is a pure natural organic food, pure natural healthy and safe food\r\nSupport Full Range Growing  high quality protein\r\nBuild Intelligence and Physical Quality, Ensure Healthy Growing  Fatty acid is helpful to the development of nervous system and brain\r\nStrong Bones, Strong Joint\r\nImprove Immunity  help puppies to establish their own immune system.\r\nNutritious Egg and Spinach fully help growing.', 0, '65dfc59f5a48e.jpg', '2024-02-29 07:45:35', NULL, 0, 'PROD36803.png', 1, 0, 'N/A', 'kg', 0, 0),
(285, 'PROD58890', 'Chick Booter', 40.00, 0, 0, 0, 2, 15, 'Energy Booster for day old chicks\r\nChickBoost is an energy booster, formulated for DOC, turkey poults and ducklings.\r\nChickBoost enables chicks to have access to water and feed at hatchery or during transportation.\r\nIt helps chicks to start feeding quicker after arrival on the farm.', 0, '65dfc656c9367.jpg', '2024-02-29 07:48:38', NULL, 0, 'PROD58890.png', 1, 0, 'N/A', 'kg', 0, 0),
(286, 'PROD61019', 'Integra 3000', 37.00, 0, 0, 0, 2, 15, 'BMEG Integra 3000 Free Range Chicken Finisher Pellet\r\nSan Miguel Foods, Inc.\r\nContent\r\nCorn, cassava meal, feed wheat, soybean meal, full fat soya, fish meal, wheat pollard, rice bran, pork meal, distillers dried grains solubles, meat and bone meal, crude coconut oil, palm olein, limestone, inorganic phosphates, iodized salt, lysine sulfate, DLmethionine, Llysine, Lthreonine, probiotic, organic selenium, choline chloride, vitamin premix, mineral premix, phytase enzyme, protease enzyme, cellulase enzyme, xylanase enzyme, toxin binders, mold inhibitor, antioxidants. Guaranteed analysis crude protein 17 min, crude fiber 8 max, crude fat 3 min, calcium 0.750.85, phosphorous 0.55 min, moisture 12 max', 0, '65dfc6f77991b.jpg', '2024-02-29 07:51:19', NULL, 0, 'PROD61019.png', 1, 0, 'N/A', 'kg', 0, 0),
(287, 'PROD92019', 'Power Cat Tuna', 1546.00, 0, 0, 0, 2, 10, 'Halal fresh organic, Halal certified\r\nAdheres to the strictest hygiene, quality  safety standards\r\nConsist of the finest natural ingredients fresh fish, high protein\r\nPremium quality dry food, high nutrition, fresh  rich in vitamins\r\nNo preservatives, no artificial coloring, does not contain salt', 0, '65dfc7762634a.jpg', '2024-02-29 07:53:26', NULL, 0, 'PROD92019.png', 1, 0, 'N/A', 'kg', 0, 0),
(288, 'PROD5805', 'B 50 Forten ', 8.00, 0, 0, 0, 3, 10, 'Improves body metabolism and increases energy production\r\nSharpens gamefowls reflexes and boosts resistance against stress and diseases\r\nPrevents hemorrhages and hastens wound healing\r\nNecessary for normal bone growth and development\r\nEnhances appetite, normal growth and reproduction\r\nImportant in maintaining structural integrity of cells, tissues and mucous membranes\r\nMaintains osmotic pressure and acidbase balance', 0, '65dfc881b35bb.jpg', '2024-02-29 07:57:53', NULL, 0, 'PROD5805.png', 1, 0, 'N/A', 'pcs', 0, 0),
(289, 'PROD18871', 'Combinex ', 325.00, 0, 150, 0, 3, 15, 'Combinex should be applied as soon as possible to prevent fly and worm infestation. DIRECTION OF USE 1 Clean the wound thoroughly 2 Hold the aerosol 10 cm 4in from the wound to be treated 3 Release spray by pressing the nozzle. Continue to spray until wound is completely covered and wet.', 0, '65dfc9400440e.jpg', '2024-02-29 08:01:04', NULL, 0, 'PROD18871.png', 1, 0, 'withExpi', 'pcs', 0, 0),
(290, 'PROD18291', 'Dextrose Powder ', 180.00, 0, 0, 0, 3, 15, 'CONTENT\r\n\r\n99.9 D  Glucose Monohydrate\r\n\r\nBENEFITS  USES\r\n\r\nProvides energy as immediate first aid in the first few hours or days of illness\r\nPartially provides rehydration in dehydrated dogs and cats\r\nDOSAGE\r\n\r\nDissolve 2 tbsp of powder in 250 mL water. Mix then serve via syringe or dropper at the side of the mouth. Provide at least 60 mL of the solution per 1 kg of your pets weight.', 0, '65dfc9e46db4e.jpg', '2024-02-29 08:03:48', NULL, 0, 'PROD18291.png', 1, 0, 'withExpi', 'kg', 0, 0),
(291, 'PROD65819', 'Cowhead', 100.00, 0, 1000, 0, 1, 5, 'Gatas ng baka masarap', 0, '65e2e5d1c7f27.jpg', '2024-03-02 16:39:45', NULL, 2, 'PROD65819.png', 1, 0, 'withExpi', 'kg', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `productphotos`
--

CREATE TABLE `productphotos` (
  `ID` int(11) NOT NULL,
  `PHOTOS_PROD_ID` int(11) NOT NULL,
  `PROD_PHOTOS` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productphotos`
--

INSERT INTO `productphotos` (`ID`, `PHOTOS_PROD_ID`, `PROD_PHOTOS`) VALUES
(4, 290, 'photo_6691e5d42a06e7.09853571.jpg'),
(8, 289, 'photo_6697b2924af777.17375064.jpg'),
(9, 290, 'photo_6697b6502b4fa9.61865884.jpg'),
(10, 286, 'photo_6697b8034cb8d3.51809538.jpeg'),
(11, 286, 'photo_6697b80c9505d4.00919419.jpeg'),
(12, 288, 'photo_6697b84b63b5d3.19794199.webp'),
(13, 257, 'photo_6697c42930c8e5.44565602.jpeg'),
(14, 257, 'photo_6697c43d616004.80330598.jpeg'),
(15, 257, 'photo_6697c4544b0519.04545319.webp'),
(16, 257, 'photo_6697c45f3e3dd6.28954850.jpg'),
(17, 257, 'photo_6697c497f0d211.26034775.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `returns_pos`
--

CREATE TABLE `returns_pos` (
  `ret_id` int(11) NOT NULL,
  `ret_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ret_datepurchase` datetime NOT NULL,
  `ret_transaction_code` varchar(8) NOT NULL,
  `ret_product_id` int(11) NOT NULL,
  `ret_qty` int(11) NOT NULL,
  `ret_prod_price` double NOT NULL,
  `replace_prod_id` int(11) NOT NULL,
  `ret_reason` varchar(255) NOT NULL,
  `ret_cashier_id` int(11) NOT NULL,
  `ret_status` int(11) NOT NULL,
  `ret_return_approval_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `s_id` int(11) NOT NULL,
  `s_stockin_date` date NOT NULL DEFAULT current_timestamp(),
  `s_invoice` varchar(255) NOT NULL,
  `s_expiration` date DEFAULT NULL,
  `s_prod_id` int(11) NOT NULL,
  `s_stock_in_qty` int(11) NOT NULL,
  `s_amount` int(11) NOT NULL,
  `s_supplierPrice` double NOT NULL,
  `s_spl_id` int(11) NOT NULL,
  `s_edited` datetime DEFAULT NULL,
  `s_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`s_id`, `s_stockin_date`, `s_invoice`, `s_expiration`, `s_prod_id`, `s_stock_in_qty`, `s_amount`, `s_supplierPrice`, `s_spl_id`, `s_edited`, `s_status`) VALUES
(444, '2024-02-22', 'INV0001', '0000-00-00', 257, 500, 495, 72, 42, NULL, 1),
(445, '2024-02-22', 'INV0001', '0000-00-00', 258, 500, 492, 160, 42, NULL, 1),
(446, '2024-02-22', 'INV0001', '0000-00-00', 257, 500, 498, 80, 42, NULL, 0),
(447, '2024-02-22', 'INV0001', '0000-00-00', 259, 500, 500, 31.5, 42, NULL, 1),
(448, '2024-02-22', 'INV0001', '0000-00-00', 259, 500, 500, 31.5, 42, NULL, 1),
(449, '2024-02-22', 'INV0001', '0000-00-00', 259, 500, 500, 31.5, 42, NULL, 1),
(450, '2024-02-22', 'INV002', '0000-00-00', 261, 500, 500, 540, 42, NULL, 1),
(451, '2024-02-22', 'INV002', '0000-00-00', 262, 500, 500, 240, 42, NULL, 1),
(452, '2024-02-22', 'INV002', '0000-00-00', 265, 500, 500, 90, 42, NULL, 1),
(453, '2024-02-22', 'INV002', '0000-00-00', 265, 500, 500, 90, 42, NULL, 0),
(454, '2024-02-22', 'INV002', '0000-00-00', 266, 500, 501, 54, 42, NULL, 1),
(455, '2024-02-22', 'inv003', '0000-00-00', 267, 500, 500, 22.5, 42, NULL, 1),
(456, '2024-02-22', 'INV0001', '0000-00-00', 269, 20, 20, 11, 42, NULL, 1),
(457, '2024-02-22', 'INV0001', '0000-00-00', 273, 500, 495, 36, 42, NULL, 1),
(458, '2024-02-22', 'INV0001', '0000-00-00', 274, 500, 479, 90, 42, NULL, 1),
(459, '2024-02-22', 'INV0001', '0000-00-00', 276, 500, 494, 882, 42, NULL, 1),
(460, '2024-02-22', 'INV0001', '0000-00-00', 277, 500, 439, 90, 42, NULL, 1),
(461, '2024-02-22', 'INV0001', '0000-00-00', 269, 20, 20, 11, 42, NULL, 1),
(462, '2024-02-22', 'INV0001', '0000-00-00', 271, 500, 500, 90, 42, NULL, 1),
(463, '2024-02-22', 'INV0001', '0000-00-00', 259, 10, 10, 20, 42, NULL, 1),
(464, '2024-02-22', 'INV0001', '0000-00-00', 259, 20, 20, 50, 42, NULL, 1),
(465, '2024-02-29', 'INV0001', '0000-00-00', 266, 5, 5, 10, 42, NULL, 1),
(466, '2024-02-22', 'INV0001', '0000-00-00', 268, 10, 8, 2, 42, NULL, 1),
(467, '2024-02-22', 'INV0001', '0000-00-00', 266, 20, 20, 20, 42, NULL, 1),
(468, '2024-02-29', 'INV23333', '0000-00-00', 257, 5, 5, 50, 43, NULL, 1),
(469, '2024-03-06', 'INV0001', '2025-01-16', 280, 5, 5, 10, 42, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `stocks_details`
--

CREATE TABLE `stocks_details` (
  `ns_id` int(11) NOT NULL,
  `ns_stock_id` int(11) NOT NULL,
  `ns_supplier_code` varchar(255) NOT NULL,
  `ns_invoice` varchar(255) NOT NULL,
  `ns_stockin_date` date NOT NULL,
  `ns_product_code` varchar(255) NOT NULL,
  `ns_expirationDate` date NOT NULL,
  `ns_qty` int(11) NOT NULL,
  `ns_supplierPrice` double NOT NULL,
  `ns_edited` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stocks_details`
--

INSERT INTO `stocks_details` (`ns_id`, `ns_stock_id`, `ns_supplier_code`, `ns_invoice`, `ns_stockin_date`, `ns_product_code`, `ns_expirationDate`, `ns_qty`, `ns_supplierPrice`, `ns_edited`) VALUES
(124, 444, 'SU5067142', 'INV0001', '2024-02-22', 'PROD84296', '0000-00-00', 500, 72, NULL),
(125, 445, 'SU5067142', 'INV0001', '2024-02-22', 'PROD5091', '0000-00-00', 500, 160, NULL),
(126, 446, 'SU5067142', 'INV0001', '2024-02-22', 'PROD84296', '0000-00-00', 500, 80, NULL),
(127, 447, 'SU5067142', 'INV0001', '2024-02-22', 'PROD21129', '0000-00-00', 500, 31.5, NULL),
(128, 448, 'SU5067142', 'INV0001', '2024-02-22', 'PROD21129', '0000-00-00', 500, 31.5, NULL),
(129, 449, 'SU5067142', 'INV0001', '2024-02-22', 'PROD21129', '0000-00-00', 500, 31.5, NULL),
(130, 450, 'SU5067142', 'INV002', '2024-02-22', 'PROD15868', '0000-00-00', 500, 540, NULL),
(131, 451, 'SU5067142', 'INV002', '2024-02-22', 'PROD33772', '0000-00-00', 500, 240, NULL),
(132, 452, 'SU5067142', 'INV002', '2024-02-22', 'PROD98769', '0000-00-00', 500, 90, NULL),
(133, 453, 'SU5067142', 'INV002', '2024-02-22', 'PROD98769', '0000-00-00', 500, 90, NULL),
(134, 454, 'SU5067142', 'INV002', '2024-02-22', 'PROD65507', '0000-00-00', 500, 54, NULL),
(135, 455, 'SU5067142', 'inv003', '2024-02-22', 'PROD25419', '0000-00-00', 500, 22.5, NULL),
(136, 456, 'SU5067142', 'INV0001', '2024-02-22', 'PROD57713', '0000-00-00', 20, 11, NULL),
(137, 457, 'SU5067142', 'INV0001', '2024-02-22', 'PROD4589', '0000-00-00', 500, 36, NULL),
(138, 458, 'SU5067142', 'INV0001', '2024-02-22', 'PROD83680', '0000-00-00', 500, 90, NULL),
(139, 459, 'SU5067142', 'INV0001', '2024-02-22', 'PROD11219', '0000-00-00', 500, 882, NULL),
(140, 460, 'SU5067142', 'INV0001', '2024-02-22', 'PROD30333', '0000-00-00', 500, 90, NULL),
(141, 461, 'SU5067142', 'INV0001', '2024-02-22', 'PROD57713', '0000-00-00', 20, 11, NULL),
(142, 462, 'SU5067142', 'INV0001', '2024-02-22', 'PROD64840', '0000-00-00', 500, 90, NULL),
(143, 463, 'SU5067142', 'INV0001', '2024-02-22', 'PROD21129', '0000-00-00', 10, 20, NULL),
(144, 464, 'SU5067142', 'INV0001', '2024-02-22', 'PROD21129', '0000-00-00', 20, 50, NULL),
(145, 465, 'SU5067142', 'INV0001', '2024-02-29', 'PROD65507', '0000-00-00', 5, 10, NULL),
(146, 466, 'SU5067142', 'INV0001', '2024-02-22', 'PROD80192', '0000-00-00', 10, 2, NULL),
(147, 467, 'SU5067142', 'INV0001', '2024-02-22', 'PROD65507', '0000-00-00', 20, 20, NULL),
(148, 468, 'SU7265643', 'INV23333', '2024-02-29', 'PROD84296', '0000-00-00', 5, 50, NULL),
(149, 469, 'SU5067142', 'INV0001', '2024-03-06', 'PROD35580', '2025-01-16', 5, 10, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `spl_id` int(11) NOT NULL,
  `spl_code` varchar(9) NOT NULL,
  `spl_name` varchar(255) NOT NULL,
  `spl_email` varchar(255) NOT NULL,
  `spl_contact` varchar(255) NOT NULL,
  `spl_address` varchar(255) NOT NULL,
  `spl_date_added` varchar(255) NOT NULL,
  `spl_date_edited` varchar(255) NOT NULL,
  `spl_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`spl_id`, `spl_code`, `spl_name`, `spl_email`, `spl_contact`, `spl_address`, `spl_date_added`, `spl_date_edited`, `spl_status`) VALUES
(1, 'SU1289519', 'supplier 1', 'supplier6@gmail.com', '09454454749', 'ZIP codes are also part of the typical Philippine address. Address format Edit. Street, e.g. BLDG 1A5U11 MRH SITE 4 TALA: District, e.g. TALA 1: ', '2023-10-16 12:47:09', '2023-11-20 08:17:43', 1),
(2, 'SU1797120', 'supplier 2', 'supplier2@gmail.com', '09454454744', 'ZIP codes are also part of the typical Philippine address. Address format Edit. Street, e.g. BLDG 1A5U11 MRH SITE 4 TALA: District, e.g. TALA 1: Barangay', '2023-10-16 12:48:37', '', 1),
(3, 'SU0632821', 'supplier 3', 'supplier3@gmail.com', '09454454744', 'ZIP codes are also part of the typical Philippine address. Address format Edit. Street, e.g. BLDG 1A5U11 MRH SITE 4 TALA: District, e.g. TALA 1: Barangay', '2023-10-16 12:48:54', '2023-10-18 13:15:08', 1),
(32, 'SU7467032', 'suppler zyrine', 'supplierzyrine@gmail.com', '09457444444', 'supplier ng feeds', '2023-10-20 11:10:46', '', 1),
(33, 'SU8295633', 'Joshua supplies', 'padillajoshuaanderson.pdm@gmail.com', '09454454744', 'sta.rosa 2 marilao bulacan', '2023-10-20 13:40:40', '', 1),
(34, 'SU5546334', 'supplier jeff', 'jeffersoncarreon22@gmail.com', '09923795722', 'Loma de gato', '2023-10-29 13:03:15', '', 1),
(35, 'SU5898035', 'julliana', 'julianairapadrigon5@gmail.com', '09123456789', 'abangan norte', '2023-11-06 22:51:18', '', 1),
(36, 'SU3688436', 'supply Jonald', 'xjonald11@gmail.com', '09454444444', 'taga dito aaaaaa', '2023-12-09 18:34:18', '2023-12-09 18:35:26', 1),
(37, 'SU9668537', 'sypplier andy', 'andersonandy046@gmail.com', '09454454744', 'stwdwadwadwadwad', '2023-12-09 18:36:09', '', 1),
(38, 'SU3838538', 'Mike', 'mike@gmail.com', '09120912099', 'sampleasasasas', '2024-02-19 23:52:28', '', 1),
(39, 'SU4896939', 'Zyrine Alcarez', 'ZyrineAlcarez@gmail.com', '09123456789', 'Bocaue Duhat Bulacan', '2024-02-21 21:47:24', '', 0),
(40, 'SU4004040', 'Joshua Anderson Padilla', 'andersonandy046@gmail.com', '09234567890', 'Marilao Tibagan Bulacan', '2024-02-21 21:48:59', '2024-02-25 12:17:04', 0),
(41, 'SU5895241', 'Juliana Ira Padrigon', 'JulianaIraPadrigon@gmail.com', '09345678901', 'Marilao Abangan Sur Bulacan', '2024-02-21 21:50:27', '', 1),
(42, 'SU5067142', 'Fyke Lleva Loterena', 'FykeLlevaLoterena@gmail.com', '09456789012', 'Marilao Prenza Dos Bulacan', '2024-02-21 21:52:40', '', 0),
(43, 'SU7265643', 'Julianna Ir Padrigon', 'Padrigon@gmail.com', '09987654321', 'Patubig, Marilao, Bulacan', '2024-02-25 12:15:05', '', 0),
(44, 'SU9320244', 'Jv Magtalas', 'jvmagtalas043@gmail.com', '09123456781', '9e callejon tinajeros malabon', '2024-03-07 06:42:27', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_address`
--

CREATE TABLE `tbl_address` (
  `address_id` int(11) NOT NULL,
  `address_code` varchar(255) NOT NULL,
  `muni_code` varchar(60) NOT NULL,
  `prov_code` varchar(60) NOT NULL,
  `reg_code` varchar(60) NOT NULL,
  `address_complete_name` varchar(255) NOT NULL,
  `address_rate` double NOT NULL,
  `address_status` int(11) NOT NULL,
  `address_cod` int(11) NOT NULL DEFAULT 1,
  `address_paynow` int(11) NOT NULL DEFAULT 1,
  `address_date_added` varchar(255) NOT NULL,
  `address_date_edited` varchar(255) DEFAULT NULL,
  `address_display_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_address`
--

INSERT INTO `tbl_address` (`address_id`, `address_code`, `muni_code`, `prov_code`, `reg_code`, `address_complete_name`, `address_rate`, `address_status`, `address_cod`, `address_paynow`, `address_date_added`, `address_date_edited`, `address_display_status`) VALUES
(69, '031411006', '031411', '0314', '03', 'Region III (Central Luzon) Bulacan Marilao Loma de Gato', 10, 1, 1, 1, '2024-02-22 08:51:20', '2024-02-23 11:37:23', 1),
(70, '031404011', '031404', '0314', '03', 'Region III (Central Luzon) Bulacan Bocaue Duhat', 80, 1, 1, 1, '2024-02-22 13:17:35', '2024-02-23 11:37:25', 1),
(71, '031411011', '031411', '0314', '03', 'Region III (Central Luzon) Bulacan Marilao Prenza I', 30, 1, 1, 1, '2024-02-23 04:12:10', NULL, 1),
(72, '031411001', '031411', '0314', '03', 'Region III (Central Luzon) Bulacan Marilao Abangan Norte', 50, 1, 1, 1, '2024-02-28 15:33:31', NULL, 1),
(73, '031411014', '031411', '0314', '03', 'Region III (Central Luzon) Bulacan Marilao Santa Rosa II', 150, 1, 1, 1, '2024-02-29 02:10:21', NULL, 1),
(74, '031412003', '031412', '0314', '03', 'Region III (Central Luzon) Bulacan City Of Meycauayan Bancal', 50, 1, 1, 1, '2024-03-06 13:41:20', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `unit_id` int(11) NOT NULL,
  `unit_name` varchar(255) NOT NULL,
  `unit_description` varchar(255) NOT NULL,
  `unit_status` int(11) NOT NULL,
  `unit_date_added` varchar(255) NOT NULL,
  `unit_date_edited` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`unit_id`, `unit_name`, `unit_description`, `unit_status`, `unit_date_added`, `unit_date_edited`) VALUES
(17, 'Sack', 'a large bag made of a strong material such as burlap, thick paper, or plastic, used for storing and carrying goods.', 1, '', '2023-10-16 21:48:30'),
(24, 'sach', 'a small bag containing a perfumed powder or potpourri used to scent clothes and linens. sacheted.', 1, '', ''),
(25, 'tab', 'A tablet (also known as a pill) is a pharmaceutical oral dosage form (oral solid dosage, or OSD) or solid unit dosage form. Tablets may be defined as the solid unit dosage form of medication with suitable excipients.', 1, '', ''),
(26, 'CAPS', 'Catastrophic antiphospholipid syndrome (CAPS) is a rare life-threatening autoimmune disease characterized by disseminated intravascular thrombosis resulting in multi-organ failure.', 1, '', ''),
(27, 'vial', 'A vial also known as a phial or flacon is a small glass or plastic vessel or bottle, often used to store medication in the form of liquids, powders, or capsules. They can also be used as scientific sample vessels for instance, in autosampler devices in', 1, '', '2023-10-19 12:29:56'),
(30, 'kg', 'basta kilogram', 1, '', '2023-11-24 00:26:44'),
(31, 'pcs', 'A vial (also known as a phial or flacon) is a small glass or plastic vessel or bottle, often used to store medication in the form of liquids, powders, or capsules. They can also be used as scientific sample vessels; for instance, in autosampler devices in', 2, '', ''),
(63, '10 Kg', 'for zyine product', 1, '2023-10-20 11:13:58', '2023-11-12 01:27:28'),
(64, 'pcs', 'for unit product', 1, '2023-11-06 22:29:26', '2023-11-06 22:30:35'),
(65, '5 kg', '5 kilogram', 1, '2023-11-12 01:27:55', NULL),
(66, 'tests', 'asdasd', 2, '2023-11-19 21:56:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_log`
--

CREATE TABLE `users_log` (
  `act_id` int(11) NOT NULL,
  `act_account_id` int(11) NOT NULL,
  `act_activity` varchar(255) DEFAULT NULL,
  `act_date` datetime DEFAULT NULL,
  `act_table` varchar(255) NOT NULL,
  `act_collumn_id` varchar(255) DEFAULT NULL,
  `act_seen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `id` int(11) NOT NULL,
  `user_acc_code` varchar(255) NOT NULL,
  `user_address_fullname` varchar(255) NOT NULL,
  `user_address_phone` varchar(255) NOT NULL,
  `user_address_email` varchar(255) NOT NULL,
  `user_address_code` varchar(255) NOT NULL,
  `user_complete_address` varchar(255) NOT NULL,
  `user_active_status` int(11) NOT NULL,
  `user_add_display_status` int(11) NOT NULL,
  `user_add_Default_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_address`
--

INSERT INTO `user_address` (`id`, `user_acc_code`, `user_address_fullname`, `user_address_phone`, `user_address_email`, `user_address_code`, `user_complete_address`, `user_active_status`, `user_add_display_status`, `user_add_Default_status`) VALUES
(209, 'ACC63202222', 'andy anderson', '09454454744', 'andersonandy046@gmail.com', '031402003', 'Region III (Central Luzon) Bulacan Balagtas (Bigaa) Borol 1st awdwadwad', 1, 1, 1),
(210, 'ACC79187223', 'Zyrine Alcarez', '09614229001', 'zy30alcarez@gmail.com', '031404011', 'Region III (Central Luzon) Bulacan Bocaue Duhat Saffron hills, Balubaran Street, Block 33 Lot 12', 1, 1, 1),
(211, 'ACC16247224', 'joshua anderson', '09454454744', 'andersonandy046@gmail.com', '031411014', 'Region III (Central Luzon) Bulacan Marilao Santa Rosa II tibagan', 1, 1, 1),
(212, 'ACC52228225', 'juliana padrigon', '09753033046', 'julianairadp@gmail.com', '031411010', 'Region III (Central Luzon) Bulacan Marilao Poblacion II 40 Sampaloc', 1, 1, 1),
(213, 'ACC19042226', 'Emman Ugaban', '09666888756', 'ugabane0516@gmail.com', '031411006', 'Region III (Central Luzon) Bulacan Marilao Loma de Gato Marilao Grand Villas', 1, 1, 1),
(214, 'ACC01997231', 'andy anderson', '09454454744', 'andyanderson046@gmail.com', '035407013', 'Region III (Central Luzon) Pampanga Guagua San Antonio awdawd', 1, 1, 1),
(215, 'ACC19724232', 'joshua padilla', '09454454744', 'andersonandy046@gmail.com', '101804005', 'Region X (Northern Mindanao) Camiguin Mambajao (Capital) Benhaan awdwad', 1, 1, 1),
(216, 'ACC45442233', 'Joshu Padilla', '09123456789', 'padillajoshuaanderson.pdm@gmail.com', '031411006', 'Region III (Central Luzon) Bulacan Marilao Loma de Gato Grand Villas', 1, 1, 1),
(217, 'ACC39204234', 'Joshua Padilla', '09123456789', 'andersonandy046@gmail.com', '031411006', 'Region III (Central Luzon) Bulacan Marilao Loma de Gato Marilao Grand Villas', 1, 1, 1),
(218, 'ACC12286235', 'Joshua Anderson Padilla', '09914965320', 'andersonandy7@gmail.com', '031411006', 'Region III (Central Luzon) Bulacan Marilao Loma de Gato 9e callejon tinajeros malabon', 1, 1, 1),
(219, 'ACC35213238', 'Alcarez Zyrine', '09989887768', 'Julianairapadrigon0@gmail.com', '031411006', 'Region III (Central Luzon) Bulacan Marilao Loma de Gato bisita 123', 1, 1, 1),
(220, 'ACC04027239', 'joshua padilla', '09454454744', 'aanderson8954@gmail.com', '031404011', 'Region III (Central Luzon) Bulacan Bocaue Duhat awdwadwa', 1, 1, 1),
(221, 'ACC57830241', 'geraldine bugtong', '09454454744', 'bugtonggera@gmail.com', '031404011', 'Region III (Central Luzon) Bulacan Bocaue Duhat 32323', 1, 1, 1),
(222, 'ACC31896242', 'Joshu Padilla', '09123456789', 'padillajoshuaanderson.pdm@gmail.com', '031411011', 'Region III (Central Luzon) Bulacan Marilao Prenza I aksjdlkasjd', 1, 1, 1),
(223, 'ACC30689243', 'John Rey Sisa', '09123441233', 'sisa@gmail.com', '031411011', 'Region III (Central Luzon) Bulacan Marilao Prenza I Marilao Grand Villas', 1, 1, 1),
(224, 'ACC99424244', 'John Rey asd', '09123456789', 'qwe@gmail.com', '031404011', 'Region III (Central Luzon) Bulacan Bocaue Duhat Grand Villas', 1, 1, 1),
(225, 'ACC81976245', 'Joshua Padilla', '09123456789', 'joshua132@gmail.com', '031404011', 'Region III (Central Luzon) Bulacan Bocaue Duhat Grand Villas', 1, 1, 1),
(226, 'ACC09265246', 'Joshua Anderson Padilla', '09914965320', 'andersonandy06@gmail.com', '031411014', 'Region III (Central Luzon) Bulacan Marilao Santa Rosa II tibagan', 1, 1, 1),
(227, 'ACC12803247', 'Emman Sample', '09123456789', 'emman@gmail.com', '031404011', 'Region III (Central Luzon) Bulacan Bocaue Duhat marilao', 1, 1, 1),
(228, 'ACC24016248', 'John Rey Padilla', '09123456789', 'sis2a@gmail.com', '031404011', 'Region III (Central Luzon) Bulacan Bocaue Duhat Grand Villas', 1, 1, 1),
(229, 'ACC30775249', 'ash lot', '09454454744', 'ashlot.bajo1@gmail.com', '031411006', 'Region III (Central Luzon) Bulacan Marilao Loma de Gato ilang ilang', 1, 1, 1),
(230, 'ACC48493251', 'joshua padilla', '09454454744', 'padillajoshuaanderson.pdm@gmail.com', '031411011', 'Region III (Central Luzon) Bulacan Marilao Prenza I looban', 1, 1, 1),
(231, 'ACC75423252', 'Juliana Ira Padrigon', '09753035756', 'julianairapadrigon5@gmail.com', '031404011', 'Region III (Central Luzon) Bulacan Bocaue Duhat Abangan Norte, Marilao, Bulacan', 1, 1, 1),
(232, 'ACC35017253', 'Jv Magtalas', '09914965320', 'jvmagtalas043@gmail.com', '031411014', 'Region III (Central Luzon) Bulacan Marilao Santa Rosa II Xkfjfjdjd', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `voucher_id` int(11) NOT NULL,
  `voucher_name` varchar(255) NOT NULL,
  `voucher_discount` float NOT NULL,
  `voucher_desciption` varchar(255) NOT NULL,
  `voucher_created` date NOT NULL,
  `voucher_expiration` date NOT NULL,
  `voucher_maximumLimit` int(11) NOT NULL,
  `voucher_date_edit` datetime DEFAULT NULL,
  `voucher_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voucher`
--

INSERT INTO `voucher` (`voucher_id`, `voucher_name`, `voucher_discount`, `voucher_desciption`, `voucher_created`, `voucher_expiration`, `voucher_maximumLimit`, `voucher_date_edit`, `voucher_status`) VALUES
(33, 'christmass sales', 20, 'discount every pasko', '2023-11-25', '2023-12-07', 997, '2023-11-26 13:15:23', 1),
(34, 'hollyweek', 55, 'hollyweekhollyweekhollyweek', '2023-11-25', '2023-12-09', 100, '2023-11-26 13:15:02', 1),
(35, 'Mike Discount', 5, 'dsdsdd', '2023-11-25', '2024-02-12', 10, NULL, 1),
(36, 'NEW DISCOUNT', 10, 'ASDADIUY', '2024-02-22', '2025-12-12', 10, NULL, 1);

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
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`mess_id`);

--
-- Indexes for table `mode_of_payment`
--
ALTER TABLE `mode_of_payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `new_cart`
--
ALTER TABLE `new_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `new_tbl_orders`
--
ALTER TABLE `new_tbl_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `new_tbl_order_items`
--
ALTER TABLE `new_tbl_order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orders_id`);

--
-- Indexes for table `pickup`
--
ALTER TABLE `pickup`
  ADD PRIMARY KEY (`pickup_id`);

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
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `productphotos`
--
ALTER TABLE `productphotos`
  ADD PRIMARY KEY (`ID`);

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
-- Indexes for table `stocks_details`
--
ALTER TABLE `stocks_details`
  ADD PRIMARY KEY (`ns_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`spl_id`);

--
-- Indexes for table `tbl_address`
--
ALTER TABLE `tbl_address`
  ADD PRIMARY KEY (`address_id`);

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
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `acc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=269;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1214;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `discount_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `maintinance`
--
ALTER TABLE `maintinance`
  MODIFY `system_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `mess_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT for table `mode_of_payment`
--
ALTER TABLE `mode_of_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `new_cart`
--
ALTER TABLE `new_cart`
  MODIFY `cart_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `new_tbl_order_items`
--
ALTER TABLE `new_tbl_order_items`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orders_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1203;

--
-- AUTO_INCREMENT for table `pickup`
--
ALTER TABLE `pickup`
  MODIFY `pickup_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT for table `pos_cart`
--
ALTER TABLE `pos_cart`
  MODIFY `pos_cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=991;

--
-- AUTO_INCREMENT for table `pos_orders`
--
ALTER TABLE `pos_orders`
  MODIFY `orders_orders_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=899;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=292;

--
-- AUTO_INCREMENT for table `productphotos`
--
ALTER TABLE `productphotos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `returns_pos`
--
ALTER TABLE `returns_pos`
  MODIFY `ret_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=264;

--
-- AUTO_INCREMENT for table `return_ordering`
--
ALTER TABLE `return_ordering`
  MODIFY `ret_ol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=470;

--
-- AUTO_INCREMENT for table `stocks_details`
--
ALTER TABLE `stocks_details`
  MODIFY `ns_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `spl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tbl_address`
--
ALTER TABLE `tbl_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `users_log`
--
ALTER TABLE `users_log`
  MODIFY `act_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3761;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=233;

--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `voucher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
