-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2025 at 02:58 PM
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
-- Database: `u547077750_rdpos`
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
(16, 'ACC6038616', '2023-06-01', 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'Freddie mark', 'Santiago', '2000-10-03', 'administrator', 0, 0, 'freddiemark123@gmail.com', '09770987021', '67d170ddf31cf.png', '66f30847d85f3.jpeg', '', '2025-03-12 19:32:45', '0', NULL, NULL),
(227, '08884227', '2024-10-07', 'ZyrineRider', 'ea6cb441794bb6cbf666d3e5eae8b399dc0019dfb999f77ee24efc14311e59ed', 'Zyrine', 'Alcarez', NULL, 'deliveryStaff', 0, 0, 'ZyrineAlcarez@gmail.com', '09123456789', '6703163903144.jpg', NULL, '', NULL, '', NULL, NULL),
(229, '85008229', '2024-02-19', 'MikeWill', 'ba38fa8eb6abfe591896129ce1c4fe8b2ea736bad64b0c0d9f82b03078c4f101', 'Mike', 'Will', NULL, 'administrator', 0, 0, 'mike@gmail.com', '09120912091', '65d377cad0800.png', NULL, '', NULL, '', NULL, NULL),
(230, '57607230', '2024-02-19', 'Mike@will', '6a01a215a91e2534030040547166fac496a29d273ed9124ef36c1124a301bf92', 'Mike', 'Will', NULL, 'cashier', 2, 1, 'will@gmail.com', '09120912091', '65d37849c897e.png', NULL, '', NULL, '', NULL, NULL),
(236, '89253236', '2024-10-07', 'JoshuaRider', 'e5b505836bd26074e1d12fedfdc1bd718c7adca1ef306dcbff26b68dba6cd5b9', 'Joshua Anderson', 'Padilla', NULL, 'deliveryStaff', 0, 0, 'JoshuaAndersonPadilla@gmail.com', '09123456789', '6703169d7be40.jpg', NULL, '', NULL, '', NULL, NULL),
(240, '49799240', '2024-10-10', 'JullianaRider', '958f084e1bc51dcf40dc7f815b96a4c537c0acd7d0efdad223b0a8f3e02cf47e', 'Julliana', 'Padrigon', NULL, 'deliveryStaff', 0, 0, 'JullianaPadrigon@gmail.com', '09123456789', '670316a5dbefa.jpg', NULL, '', NULL, '', NULL, NULL),
(250, '62330250', '2024-10-12', 'FykeRider', '2b0dcdb1cab2cd9b47ac7c775a4d9807e418799c458e7455529306d017274e76', 'Fyke', 'Loterena', NULL, 'deliveryStaff', 0, 0, 'FykeLoterena@gmail.com', '09123456789', '670a938ecddf6.jpg', NULL, '', NULL, '', NULL, NULL),
(271, '09611271', '2024-09-17', 'akosiadmin2', 'e7b4e4c5399117f0598f8ad03599646ed90b17ae3470edade11aa69dfe15b58c', 'ako si', 'admin', NULL, 'administrator', 0, 0, 'akosiadmin@gmail.com', '09454454744', '66e8ebf842aa7.jpg', NULL, '', NULL, '', NULL, NULL),
(277, '89868277', '2024-10-07', 'ZyrineCashier', 'bf851b05275aadb143bae1913224f920e7719056b97dfe930d8fb821e8739a31', 'Zyrine', 'Alcarez', NULL, 'cashier', 0, 0, 'Cashier1@gmail.com', '09123456789', '670316b07dd89.jpg', NULL, '', NULL, '', NULL, NULL),
(278, '40681278', '2024-10-07', 'JoshuaCashier', '3d5249419f27520249d4fd4cab2ea828a5de17ffc0c7cba17f4a04bea4ab4c86', 'Joshua Anderson', 'Padilla', NULL, 'cashier', 0, 0, 'Cashier2@gmail.com', '09123456789', '670316bb861b6.jpg', NULL, '', NULL, '', NULL, NULL),
(292, 'ACC03771292', '2024-09-29', 'masterparj', '2448a34d49ecbe9f7c4293fcd3b5e359817322d4a615009158241bd0ab1a3547', 'christin', 'bermas', '2006-05-31', 'customer', 0, 0, 'masterparj@gmail.com', '09454454744', 'profile_67d1705d975ae2.90337812.jpg', NULL, '', NULL, '', 0, '2024-09-30 18:14:36'),
(294, '49708294', '2024-09-29', 'christinsamson', '267bfa680a5819a0b7e145896b9b4268cfbf8ac0c2804e17e6706bb91e7a49b0267bfa680a5819a0b7e145896b9b4268cfbf8ac0c2804e17e6706bb91e7a49b0', 'christine', 'samson', NULL, 'cashier', 2, 0, 'christinsamson@gmail.com', '09454454746', '66f84601da7c9.jpeg', NULL, '', NULL, '', NULL, NULL),
(301, 'ACC06596301', '2024-09-30', 'msMaloi2025', '9fac863470452c7ffc40117250176bb8ca002a199f114611902427200d2efc74', 'Mary Loi', 'Ricalde', '2002-05-27', 'customer', 0, 0, 'joshuaandersonpadilla8@gmail.com', '09454454744', 'profile_66fc171d36c0c5.94870671.jpg', NULL, '', NULL, '0', NULL, '2024-09-30 20:12:46'),
(302, 'ACC42718302', '2024-09-30', 'Joe123', 'a5b4e89f9f0a84e8ce20eb595ea154ded9436ad93b704cf9c2058c46ecfa34fe', 'Joe', 'Nuck', '1996-05-31', 'customer', 1, 0, 'rickandandmorty0224@gmail.com', '09127856747', '', NULL, '', NULL, '1071', NULL, '2024-09-30 20:30:27'),
(305, 'ACC31069305', '2024-09-30', 'mikegh1', 'a5b4e89f9f0a84e8ce20eb595ea154ded9436ad93b704cf9c2058c46ecfa34fe', 'Joe', 'Doe', '1998-10-08', 'customer', 0, 0, 'floterina@gmail.com', '09120912091', '', NULL, '', NULL, '0', NULL, '2024-09-30 20:58:39'),
(311, 'ACC57229311', '2024-10-01', 'mike123', '5154d355e61f547551042b91ba2dc8af46dece4695920eb50d4d73757c5eaf41', 'John', 'Doe', '2006-05-31', 'customer', 0, 0, 'loterinamichaela431@gmail.com', '09120912091', '', NULL, '', NULL, '0', NULL, '2024-10-01 23:58:57'),
(312, 'ACC37996312', '2024-10-02', 'irapadrigon', '347c9a3a91ceee960653d6c8ef724405f6896279ce72d8e77fc771f7ae2b0bd4', 'Juliana Ira', 'Padrigon', '2000-05-12', 'customer', 0, 0, 'Julianairadp@gmail.com', '09753035087', '', NULL, '', NULL, '0', 0, '2024-10-14 12:56:47'),
(313, 'ACC89780313', '2024-10-03', 'ZyrineCustomer', '28942869c110e0d1c5273c9a61f50ccd1183b3e351fd423f4d0bfca7ed795f92', 'Zyrine', 'Alcarez', '2000-03-30', 'customer', 0, 0, 'zy30alcarez@gmail.com', '09614229001', 'profile_66fe37b6df35e1.04968121.jpg', NULL, '', NULL, '', 0, '2024-10-06 20:24:00'),
(314, 'ACC69794314', '2024-10-03', 'Estebanise01', '6db442a1a8b2277bcd3cf9b13325083d96219e09ba1d950a2a619b2b5a65f299', 'Denise', 'Esteban', '1995-07-20', 'customer', 0, 0, 'Estebanise@gmail.com', '09451943082', 'profile_670bfa2c8e85b3.58408027.jpg', NULL, '', NULL, '2599', NULL, '2024-10-03 14:19:25'),
(315, 'ACC04033315', '2024-10-03', 'Leonel', 'a53c3fac31ce30c90bc064120cbc3e754d0c6406acc3fb4e20b72212110c85dc', 'Leonel', 'Rapsing', '2006-05-31', 'customer', 0, 0, 'leonelrapsing132@gmail.com', '09215038990', 'profile_670c0d27ddfef1.53921207.jpg', NULL, '', NULL, '0', NULL, '2024-10-03 23:30:42'),
(320, 'ACC12831320', '2024-10-12', 'babyJosh06', 'f545a6e490fbd32cb58bb36d814f94bbfbaf730bc638e8a6a71e99694b162b2e', 'Josh', 'Mogicash', '2006-05-31', 'customer', 0, 0, 'babyJosh06@gmail.com', '09454454744', 'profile_670a8dc7b405f4.34888906.jpg', NULL, '', NULL, '0', NULL, '2024-10-12 22:41:51'),
(321, 'ACC47835321', '2024-10-13', 'andersonandy001', 'b0feb9e3d27e8ae310a33a9a824c787c30ae61b39c036b51719f106fe14ecfb8', 'Joshua', 'padilla', '2006-05-31', 'customer', 0, 0, 'andersonandy001@gmail.com', '09454454744', 'profile_670c184c70cee3.13465259.jpg', NULL, '', NULL, '0', NULL, '2024-10-13 19:12:23'),
(322, 'ACC40428322', '2024-10-14', 'angenise242', '61e36b4d463fcf248af31898805050d4b137bb54e74c4e7e9b95b35ccb0f9753', 'Angela', 'Denise', '2006-06-02', 'customer', 0, 0, 'angenise242@gmail.com', '09454454744', 'profile_670c11864a37d6.61910224.jpg', NULL, '', NULL, '0', NULL, '2024-10-14 02:32:11'),
(323, 'ACC13847323', '2024-10-14', 'aziacosta046', '9734647c0ff4738d1bb46f628776120c2fef6ad7e111658bbbe556cea6e62239', 'Andrea', 'Acosta', '2006-05-31', 'customer', 0, 0, 'aziacosta046@gmail.com', '09454454744', 'profile_670c14855b69c3.46443494.jpeg', NULL, '', NULL, '0', NULL, '2024-10-14 02:45:47'),
(324, 'ACC37826324', '2024-10-14', 'kevinDurant', '61e36b4d463fcf248af31898805050d4b137bb54e74c4e7e9b95b35ccb0f9753', 'Kevin', 'Durant', '2006-05-31', 'customer', 0, 0, 'kevinDurant@gmail.com', '09454454744', 'profile_670c158f0b3580.61457385.jpeg', NULL, '', NULL, '0', NULL, '2024-10-14 02:48:30'),
(325, 'ACC98318325', '2024-10-14', 'july072025aprilJane', '2238b890569e93c0a051a2c805e27c8ffaa80ca8b5f2cc7c15461c7fcd90a467', 'April Jane', 'De Leon', '2000-05-31', 'customer', 0, 0, 'apriljane@gmail.com', '09454454744', 'profile_670c1fa5b2a837.08596711.jpg', NULL, '', NULL, '0', NULL, '2024-10-14 03:32:15'),
(326, 'ACC58538326', '2024-10-14', 'joanpanimbangon', '61e36b4d463fcf248af31898805050d4b137bb54e74c4e7e9b95b35ccb0f9753', 'Joan', 'Panimbangon', '2000-11-09', 'customer', 0, 0, 'joanpanimbangon@gmail.com', '09669994344', 'profile_670c22c0b10c64.52476394.jpg', NULL, '', NULL, '0', NULL, '2024-10-14 03:36:06'),
(327, 'ACC19728327', '2024-10-14', 'alcarezzyrinearreza.pdm', 'af6890b7f80b0f2edfcda1c39b35913ed52e919016323acb0c032938deff39a6', 'joshua', 'padilla', '2006-05-31', 'customer', 0, 0, 'alcarezzyrinearreza.pdm@gmail.com', '09454454744', '', NULL, '', NULL, '', 0, '2024-10-14 13:52:50'),
(328, 'ACC23394328', '2024-10-14', 'rickandmorty0224', '7f46a25b6ab4a56f573428b62f35c86a9e672d1597b78b53863dc10cd5c7ef1e', 'fykie', 'loterena', '2006-05-31', 'customer', 1, 0, 'rickandmorty0224@gmail.com', '09454454744', '', NULL, '', NULL, '0301', NULL, '2024-10-14 13:51:07');

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
(1, 'Pet and Poultry Accessories', 'Pet and Poultry Accessories refers to a wide range of tools, equipment, and products designed to cater to the needs of both household pets and poultry. These accessories can help improve the health, comfort, and overall wellbeing of animals, as well as as', 1, '2023-10-12 14:25:57', '2024-09-23 00:40:02'),
(2, 'Pet and Poultry Foods', 'Pet and Poultry Foods are specialized diets designed to meet the nutritional needs of various animals, ensuring they receive essential vitamins, minerals, and energy for their health and growth. These foods come in different forms and cater to specific sp', 1, '2023-10-12 14:25:57', '2024-09-23 00:40:23'),
(3, 'Medicines', 'Medicines for pets and poultry are specialized treatments used to prevent, manage, or cure various health conditions and diseases. These medications are essential in maintaining the health and wellbeing of animals and are available in different forms, suc', 1, '2023-10-12 14:25:57', '2024-09-23 00:40:41'),
(23, 'category 1', 'addasdawdasdwad', 0, '2023-10-13 00:05:16', '2023-10-13 00:24:44'),
(24, 'Vitaminss', 'awdwadwadwd', 0, '2023-10-15 21:30:18', '2023-10-16 16:05:31'),
(25, 'category 1', 'awdawdwadaw', 0, '2023-11-24 22:12:19', NULL),
(26, 'categor2', 'dwadwadawdwadwa', 0, '2024-02-28 23:34:32', NULL),
(28, 'Pet and Poultry Accessories', 'Pet and Poultry Accessories refers to a wide range of tools, equipment, and products designed to cater to the needs of both household pets and poultry. These accessories can help improve the health, comfort, and overall wellbeing of animals, as well as as', 0, '2024-09-23 00:37:12', NULL),
(29, 'Pet and Poultry Foods', 'Pet and Poultry Foods are specialized diets designed to meet the nutritional needs of various animals, ensuring they receive essential vitamins, minerals, and energy for their health and growth. These foods come in different forms and cater to specific sp', 0, '2024-09-23 00:37:52', NULL),
(30, 'Medicines', 'Medicines for pets and poultry are specialized treatments used to prevent, manage, or cure various health conditions and diseases. These medications are essential in maintaining the health and wellbeing of animals and are available in different forms, suc', 0, '2024-09-23 00:38:42', NULL),
(31, 'tind', 'aawdwadwdwadw', 0, '2024-09-23 02:07:54', NULL),
(32, 'category 1', 'testvffgggg', 0, '2024-10-03 14:30:38', NULL);

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
(40, '10 sakos', 'we give 20% discount', 20, '2023-11-25 11:24:40', '2023-11-25 11:24:55', 2),
(41, 'suki card', 'exclusive for regular customers only', 2, '2023-11-25 19:24:57', '2024-09-23 16:27:35', 1),
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
(1, 'RDPOS', '67d1702b96b29.png', '6534e356c9783.png', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quaerat, error esse, eos necessitatibus saepe temporibus aliquam aperiam quas reiciendis possimus laborum voluptates magni ad. Quam tempore officiis eligendi sed aut', 'Paso bagbaguin near highway road sta.maria bulacan', '09876543211', 12, '2025-03-12 19:29:47');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `mess_id` int(11) NOT NULL,
  `mess_sender` int(11) NOT NULL,
  `mess_content` varchar(255) DEFAULT NULL,
  `mess_reciever` varchar(60) DEFAULT NULL,
  `mess_date` datetime NOT NULL,
  `mess_seen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`mess_id`, `mess_sender`, `mess_content`, `mess_reciever`, `mess_date`, `mess_seen`) VALUES
(297, 16, 'hello good afternoon 🥰🥰🥰', '279', '2024-09-26 00:34:43', 0),
(299, 16, 'good morning', '279', '2024-09-26 01:06:45', 0),
(306, 16, '❤️❤️❤️', '284', '2024-09-27 01:13:58', 0),
(311, 292, 'hello', 'Admin', '2024-09-29 03:51:18', 2),
(312, 16, 'hi', '292', '2024-09-29 03:56:38', 0),
(313, 292, '👋', 'Admin', '2024-09-29 04:03:12', 2),
(314, 311, 'hello', 'Admin', '2024-10-02 00:05:22', 2),
(315, 311, 'pre\n\n\n\n', 'Admin', '2024-10-02 00:05:29', 2),
(316, 311, '<3', 'Admin', '2024-10-02 00:05:35', 2),
(317, 311, 'test', 'Admin', '2024-10-02 00:05:46', 2),
(318, 311, 'sample', 'Admin', '2024-10-02 00:06:00', 2),
(319, 311, 'test', 'Admin', '2024-10-02 00:06:09', 2),
(320, 311, '@asasqasas', 'Admin', '2024-10-02 00:06:19', 2),
(321, 311, '@.bat', 'Admin', '2024-10-02 00:06:28', 2),
(322, 311, '.exe', 'Admin', '2024-10-02 00:06:32', 2),
(323, 311, '.bat', 'Admin', '2024-10-02 00:06:41', 2),
(326, 16, 'hello', '311', '2024-10-13 00:39:08', 0),
(327, 315, 'hi', 'Admin', '2024-10-14 02:12:32', 2),
(328, 16, 'hee', '315', '2024-10-14 02:13:56', 0),
(329, 322, 'hi', 'Admin', '2024-10-14 02:37:58', 2),
(330, 323, 'Good morning', 'Admin', '2024-10-14 02:42:44', 2),
(331, 324, 'hellow', 'Admin', '2024-10-14 02:46:47', 2),
(332, 321, 'test', 'Admin', '2024-10-14 03:06:05', 1),
(333, 321, 'hellow', 'Admin', '2024-10-14 03:06:26', 1),
(334, 292, 'hello', 'Admin', '2024-10-14 14:02:40', 2);

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
(57, '002984357', 'GCASH', '09614229001', 'GCash-MyQR-08102024115439.PNG.jpg', 0, 'ewallet', '2023-10-17 13:31:40', '2024-10-08 11:57:49'),
(58, '006436458', 'MAYA', '09614229001', 'myqr_1728359618367.jpg', 0, 'ewallet', '2023-10-17 14:10:10', '2024-10-08 11:58:28'),
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
(273, 271, 1, 312),
(274, 280, 1, 312),
(277, 318, 1, 312);

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
  `proof_of_del` varchar(60) NOT NULL,
  `t_status` int(1) NOT NULL DEFAULT 0,
  `c_status` varchar(30) NOT NULL DEFAULT 'Not_Collected',
  `cancel_reason` text NOT NULL,
  `unsucessful_reason` text NOT NULL,
  `estimated_delivery` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `new_tbl_orders`
--

INSERT INTO `new_tbl_orders` (`order_id`, `cust_id`, `payment_id`, `pof`, `subtotal`, `vat`, `sf`, `total`, `order_date`, `delivered_date`, `rider_id`, `status`, `reject_reason`, `proof_of_del`, `t_status`, `c_status`, `cancel_reason`, `unsucessful_reason`, `estimated_delivery`) VALUES
('ORD-131785', 321, 'COD', NULL, 55.00, 0.55, 50.00, 105.00, '2024-10-13 22:36:17', '2024-10-13 22:36:49', 16, 'Delivered', NULL, 'proof_of_del_2970113711.jpg', 0, 'Collected', '', '', NULL),
('ORD-134508', 292, 'COD', NULL, 38400.00, 384.00, 50.00, 38450.00, '2024-10-10 22:46:23', NULL, 236, 'Rejected', NULL, '', 0, 'Collected', '', '', NULL),
('ORD-13742', 301, 'COD', NULL, 105.00, 1.05, 140.00, 245.00, '2024-10-02 00:37:10', '2024-10-02 00:38:15', 250, 'Delivered', NULL, 'proof_of_del_7435705635.png', 0, 'Collected', '', '', NULL),
('ORD-162910', 320, '57', 'ORD-162910.jpg', 1293.00, 12.93, 140.00, 1433.00, '2024-10-12 22:41:13', '2024-10-12 22:47:30', 250, 'Delivered', NULL, 'proof_of_del_0609765276.jpg', 0, 'Collected', '', '', NULL),
('ORD-170617', 292, '57', 'ORD-170617.jpeg', 1561.00, 15.61, 50.00, 1611.00, '2024-10-13 23:36:01', '2024-10-13 23:37:25', 16, 'Delivered', NULL, 'proof_of_del_6203960084.png', 0, 'Collected', '', '', NULL),
('ORD-174675', 292, 'COD', NULL, 26.00, 0.26, 50.00, 76.00, '2024-10-03 14:49:01', '2024-10-06 20:59:20', 250, 'Delivered', NULL, 'proof_of_del_2453130996.png', 0, 'Collected', '', '', NULL),
('ORD-186210', 292, '57', 'ORD-186210.jpeg', 240.00, 2.40, 50.00, 290.00, '2024-09-29 03:18:59', '2024-09-29 03:36:18', 236, 'Delivered', NULL, 'proof_of_del_0404628840.png', 0, 'Collected', '', '', NULL),
('ORD-2096', 321, 'COD', NULL, 960.00, 9.60, 50.00, 1010.00, '2024-10-14 03:09:49', '2024-10-14 03:10:12', 250, 'Delivered', NULL, 'proof_of_del_7041745151.webp', 0, 'Not_Collected', '', '', NULL),
('ORD-231658', 322, 'COD', NULL, 4414.00, 44.14, 140.00, 4554.00, '2024-10-14 02:35:32', '2024-10-14 02:36:09', 236, 'Delivered', NULL, 'proof_of_del_1526277995.png', 0, 'Not_Collected', '', '', NULL),
('ORD-29258', 322, 'COD', NULL, 8432.50, 84.33, 130.00, 8562.50, '2024-10-14 02:31:43', '2024-10-14 02:32:15', 227, 'Delivered', NULL, 'proof_of_del_9878876425.jpg', 0, 'Not_Collected', '', '', NULL),
('ORD-303567', 320, 'COD', NULL, 163.00, 1.63, 140.00, 303.00, '2024-10-14 01:49:03', '2024-10-14 01:49:43', 16, 'Delivered', NULL, 'proof_of_del_4486748914.png', 0, 'Collected', '', '', NULL),
('ORD-314468', 301, '57', 'ORD-314468.jpeg', 320.00, 3.20, 140.00, 460.00, '2024-10-01 23:51:43', '2024-10-02 00:32:11', 16, 'Delivered', NULL, 'proof_of_del_1624166664.png', 0, 'Collected', '', '', NULL),
('ORD-332213', 292, 'COD', NULL, 70.00, 0.70, 50.00, 120.00, '2024-10-14 14:05:11', '2024-10-14 14:22:54', 250, 'Delivered', NULL, 'proof_of_del_5246680124.jpg', 1, 'Not_Collected', '', '', NULL),
('ORD-332534', 301, '57', 'ORD-332534.jpeg', 3243.00, 32.43, 140.00, 3383.00, '2024-10-02 01:15:55', '2024-10-02 01:16:34', 16, 'Delivered', NULL, 'proof_of_del_7592106828.png', 0, 'Collected', '', '', NULL),
('ORD-337882', 311, '57', 'ORD-337882.png', 70.00, 0.70, 130.00, 200.00, '2024-10-02 00:11:01', '2024-10-13 23:20:12', 227, 'Delivered', NULL, 'proof_of_del_0338655768.jpg', 0, 'Collected', '', '', NULL),
('ORD-341909', 292, 'COD', NULL, 124.00, 1.24, 50.00, 174.00, '2024-10-12 21:54:15', NULL, NULL, 'Cancelled', NULL, '', 0, 'Not_Collected', '', '', NULL),
('ORD-40470', 292, 'COD', NULL, 3000.00, 30.00, 60.00, 3060.00, '2024-09-29 01:05:54', '2024-09-29 01:30:51', 250, 'Delivered', NULL, 'proof_of_del_9829125581.png', 0, 'Collected', '', '', NULL),
('ORD-405539', 292, 'COD', NULL, 385.00, 3.85, 50.00, 435.00, '2024-10-12 23:53:01', '2024-10-13 00:04:16', 250, 'Delivered', NULL, 'proof_of_del_1647460354.jpg', 0, 'Collected', '', '', NULL),
('ORD-465438', 315, 'COD', NULL, 1413.00, 14.13, 50.00, 1463.00, '2024-10-14 01:56:19', '2024-10-14 01:56:44', 16, 'Delivered', NULL, 'proof_of_del_9084266991.jpeg', 0, 'Collected', '', '', NULL),
('ORD-503589', 292, 'COD', NULL, 80.00, 0.80, 50.00, 130.00, '2024-10-14 14:00:03', NULL, NULL, 'Cancelled', NULL, '', 0, 'Not_Collected', '', '', NULL),
('ORD-51149', 305, 'COD', NULL, 160.00, 1.60, 130.00, 290.00, '2024-09-30 20:55:37', NULL, NULL, 'Cancelled', NULL, '', 0, 'Not_Collected', '', '', NULL),
('ORD-521894', 301, 'COD', NULL, 4448.50, 44.49, 140.00, 4588.50, '2024-10-14 02:18:44', '2024-10-14 02:19:06', 227, 'Delivered', NULL, 'proof_of_del_7713906935.jpeg', 0, 'Not_Collected', '', '', NULL),
('ORD-541780', 313, 'COD', NULL, 13.00, 0.13, 140.00, 153.00, '2024-10-03 14:18:47', '2024-10-03 14:21:44', 16, 'Delivered', NULL, 'proof_of_del_0299477265.png', 0, 'Collected', '', '', NULL),
('ORD-560814', 313, '57', 'ORD-560814.jpg', 183.00, 1.83, 140.00, 323.00, '2024-10-03 14:43:18', '2024-10-03 14:45:05', 250, 'Delivered', NULL, 'proof_of_del_0920503602.png', 0, 'Collected', '', '', NULL),
('ORD-574587', 292, 'COD', NULL, 1600.00, 16.00, 50.00, 1650.00, '2024-10-10 23:17:54', '2024-10-13 22:38:12', 16, 'Delivered', NULL, 'proof_of_del_9490841162.png', 0, 'Collected', '', '', NULL),
('ORD-582396', 292, '57', 'ORD-582396.jpeg', 534.00, 5.34, 50.00, 584.00, '2024-09-29 03:00:44', '2024-09-29 03:38:02', 250, 'Delivered', NULL, 'proof_of_del_4219063463.jpg', 0, 'Collected', '', '', NULL),
('ORD-621865', 320, 'COD', NULL, 360.00, 3.60, 140.00, 500.00, '2024-10-12 22:57:56', '2024-10-13 22:37:20', 250, 'Delivered', NULL, 'proof_of_del_2169005129.jpg', 0, 'Collected', '', '', NULL),
('ORD-622808', 313, 'COD', NULL, 35.00, 0.35, 140.00, 175.00, '2024-10-06 20:23:25', '2024-10-06 20:30:00', 227, 'Delivered', NULL, 'proof_of_del_5265756913.jpg', 0, 'Collected', '', '', NULL),
('ORD-635283', 314, 'COD', NULL, 1757.50, 17.58, 60.00, 1817.50, '2024-10-14 00:44:40', '2024-10-14 00:45:28', 16, 'Delivered', NULL, 'proof_of_del_6845958442.png', 0, 'Collected', '', '', NULL),
('ORD-674480', 315, 'COD', NULL, 3836.00, 38.36, 50.00, 3886.00, '2024-10-14 02:00:29', '2024-10-14 02:01:08', 236, 'Delivered', NULL, 'proof_of_del_9468975667.webp', 0, 'Not_Collected', '', '', NULL),
('ORD-766363', 292, '58', 'ORD-766363.jpg', 774.00, 7.74, 50.00, 824.00, '2024-09-29 10:05:31', NULL, NULL, 'Cancelled', NULL, '', 0, 'Not_Collected', '', '', NULL),
('ORD-777559', 292, 'COD', NULL, 495.00, 4.95, 50.00, 545.00, '2024-10-10 23:35:29', '2024-10-13 22:37:48', 240, 'Delivered', NULL, 'proof_of_del_9471131568.jpg', 0, 'Collected', '', '', NULL),
('ORD-780811', 292, 'COD', NULL, 609.00, 6.09, 50.00, 659.00, '2024-10-12 21:48:00', NULL, NULL, 'Cancelled', NULL, '', 0, 'Not_Collected', '', '', NULL),
('ORD-794240', 292, 'COD', NULL, 135.00, 16.20, 140.00, 275.00, '2025-03-12 19:32:00', '2025-03-12 19:39:03', 250, 'Delivered', NULL, 'proof_of_del_2352720780.jpg', 0, 'Not_Collected', '', '', '2025-03-12'),
('ORD-829289', 327, 'COD', NULL, 175.00, 1.75, 130.00, 305.00, '2024-10-14 13:54:08', NULL, NULL, 'Rejected', NULL, '', 0, 'Not_Collected', '', '', NULL),
('ORD-883131', 292, 'COD', NULL, 800.00, 8.00, 50.00, 850.00, '2024-09-29 03:41:22', '2024-09-29 03:49:20', 250, 'Delivered', NULL, 'proof_of_del_8087379779.jpg', 0, 'Collected', '', '', NULL),
('ORD-885157', 321, '57', 'ORD-885157.jpeg', 865.00, 8.65, 50.00, 915.00, '2024-10-13 19:12:21', '2024-10-13 19:15:46', 236, 'Delivered', NULL, 'proof_of_del_0296985028.png', 1, 'Collected', '', '', NULL),
('ORD-925374', 292, 'COD', NULL, 297.50, 2.98, 50.00, 347.50, '2024-10-10 23:55:31', '2024-10-13 23:31:06', 250, 'Delivered', NULL, 'proof_of_del_3774448954.jpeg', 0, 'Collected', '', '', NULL),
('ORD-946452', 311, '57', 'ORD-946452.png', 80.00, 0.80, 60.00, 140.00, '2024-10-01 23:59:58', '2024-10-02 00:00:44', 16, 'Delivered', NULL, 'proof_of_del_6665233805.png', 0, 'Collected', '', '', NULL),
('ORD-947240', 314, 'COD', NULL, 339.00, 3.39, 60.00, 399.00, '2024-10-14 00:52:10', '2024-10-14 00:52:37', 236, 'Delivered', NULL, 'proof_of_del_3177772974.jpg', 0, 'Collected', '', '', NULL),
('ORD-953842', 301, 'COD', NULL, 223.00, 2.23, 140.00, 363.00, '2024-10-13 23:59:38', '2024-10-14 00:03:21', 240, 'Delivered', NULL, 'proof_of_del_7509560819.png', 0, 'Collected', '', '', NULL),
('ORD-986815', 301, 'COD', NULL, 5920.00, 59.20, 140.00, 6060.00, '2024-10-02 01:00:24', '2024-10-02 01:01:01', 240, 'Delivered', NULL, 'proof_of_del_9247892975.png', 0, 'Collected', '', '', NULL);

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
(164, 'ORD-40470', 261, 5),
(166, 'ORD-582396', 262, 2),
(167, 'ORD-186210', 257, 3),
(168, 'ORD-883131', 257, 4),
(169, 'ORD-883131', 258, 3),
(170, 'ORD-766363', 257, 3),
(171, 'ORD-766363', 262, 2),
(172, 'ORD-51149', 257, 2),
(173, 'ORD-314468', 257, 4),
(174, 'ORD-946452', 257, 1),
(175, 'ORD-337882', 269, 1),
(176, 'ORD-13742', 259, 3),
(177, 'ORD-986815', 258, 7),
(178, 'ORD-986815', 261, 8),
(179, 'ORD-332534', 262, 9),
(180, 'ORD-332534', 265, 6),
(181, 'ORD-332534', 266, 4),
(182, 'ORD-541780', 280, 1),
(183, 'ORD-560814', 280, 1),
(184, 'ORD-560814', 257, 1),
(185, 'ORD-560814', 271, 3),
(186, 'ORD-174675', 280, 2),
(187, 'ORD-622808', 259, 1),
(188, 'ORD-134508', 318, 80),
(190, 'ORD-574587', 257, 20),
(191, 'ORD-777559', 325, 5),
(193, 'ORD-925374', 326, 5),
(196, 'ORD-780811', 280, 2),
(197, 'ORD-780811', 262, 1),
(198, 'ORD-780811', 320, 1),
(199, 'ORD-780811', 283, 1),
(200, 'ORD-341909', 265, 1),
(201, 'ORD-341909', 324, 1),
(202, 'ORD-162910', 280, 1),
(203, 'ORD-162910', 257, 1),
(204, 'ORD-162910', 261, 2),
(205, 'ORD-621865', 260, 1),
(206, 'ORD-405539', 260, 1),
(207, 'ORD-405539', 267, 1),
(208, 'ORD-885157', 257, 5),
(209, 'ORD-885157', 325, 2),
(210, 'ORD-885157', 262, 1),
(211, 'ORD-131785', 280, 3),
(212, 'ORD-131785', 288, 2),
(213, 'ORD-170617', 288, 1),
(214, 'ORD-170617', 280, 15),
(215, 'ORD-170617', 268, 1),
(216, 'ORD-170617', 269, 1),
(217, 'ORD-170617', 270, 1),
(218, 'ORD-953842', 280, 1),
(219, 'ORD-953842', 288, 1),
(220, 'ORD-953842', 266, 1),
(221, 'ORD-953842', 321, 1),
(222, 'ORD-953842', 273, 1),
(223, 'ORD-953842', 297, 1),
(224, 'ORD-635283', 324, 1),
(225, 'ORD-635283', 326, 1),
(226, 'ORD-635283', 320, 2),
(227, 'ORD-635283', 272, 3),
(228, 'ORD-635283', 274, 1),
(229, 'ORD-635283', 286, 1),
(230, 'ORD-635283', 273, 1),
(231, 'ORD-635283', 257, 3),
(232, 'ORD-635283', 280, 1),
(233, 'ORD-635283', 262, 1),
(234, 'ORD-635283', 259, 7),
(235, 'ORD-947240', 321, 1),
(236, 'ORD-947240', 268, 1),
(237, 'ORD-947240', 275, 1),
(238, 'ORD-303567', 288, 1),
(239, 'ORD-303567', 266, 2),
(240, 'ORD-303567', 259, 1),
(241, 'ORD-465438', 265, 14),
(242, 'ORD-465438', 280, 1),
(243, 'ORD-674480', 266, 1),
(244, 'ORD-674480', 267, 1),
(245, 'ORD-674480', 257, 1),
(246, 'ORD-674480', 275, 1),
(247, 'ORD-674480', 268, 1),
(248, 'ORD-674480', 302, 1),
(249, 'ORD-674480', 287, 1),
(250, 'ORD-674480', 274, 1),
(251, 'ORD-674480', 320, 1),
(252, 'ORD-674480', 288, 1),
(253, 'ORD-674480', 270, 1),
(254, 'ORD-674480', 273, 1),
(255, 'ORD-674480', 325, 1),
(256, 'ORD-674480', 324, 1),
(257, 'ORD-521894', 326, 1),
(258, 'ORD-521894', 284, 1),
(259, 'ORD-521894', 283, 1),
(260, 'ORD-521894', 260, 1),
(261, 'ORD-521894', 267, 1),
(262, 'ORD-521894', 297, 1),
(263, 'ORD-521894', 316, 1),
(264, 'ORD-521894', 275, 1),
(265, 'ORD-29258', 257, 3),
(266, 'ORD-29258', 280, 2),
(267, 'ORD-29258', 288, 1),
(268, 'ORD-29258', 259, 3),
(269, 'ORD-29258', 266, 3),
(270, 'ORD-29258', 258, 3),
(271, 'ORD-29258', 261, 3),
(272, 'ORD-29258', 313, 3),
(273, 'ORD-29258', 321, 3),
(274, 'ORD-29258', 262, 3),
(275, 'ORD-231658', 279, 1),
(276, 'ORD-231658', 272, 1),
(277, 'ORD-231658', 286, 1),
(278, 'ORD-231658', 289, 1),
(279, 'ORD-231658', 304, 1),
(280, 'ORD-231658', 284, 1),
(281, 'ORD-2096', 318, 2),
(282, 'ORD-829289', 257, 1),
(283, 'ORD-829289', 259, 1),
(284, 'ORD-829289', 266, 1),
(285, 'ORD-503589', 257, 1),
(286, 'ORD-332213', 288, 1),
(287, 'ORD-332213', 268, 1),
(288, 'ORD-794240', 272, 1),
(289, 'ORD-794240', 259, 1);

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
(940, 'RD60551', 280, 13.00, 5, 65.00, 0, '', 0.65, '2024-10-01 16:50:26', 65.00, 100.00, 35.00, 16, 0, 0, 'RD60551.png'),
(941, 'RD77604', 267, 25.00, 1, 25.00, 2, 'Senior', 0.24, '2024-10-06 12:08:29', 23.50, 100.00, 76.50, 16, 0, 0, 'RD77604.png'),
(942, 'RD22077', 288, 8.00, 5, 40.00, 2, 'Senior', 0.38, '2024-10-06 12:09:43', 37.60, 100.00, 62.40, 16, 1, 0, 'RD22077.png'),
(943, 'RD86952', 257, 80.00, 577, 46160.00, 923, 'suki card', 452.37, '2024-10-10 14:40:56', 45236.80, 50000.00, 4763.20, 16, 0, 0, 'RD86952.png'),
(944, 'RD18899', 266, 60.00, 3, 180.00, 18, 'PWD', 3.37, '2024-10-13 11:19:17', 337.25, 400.00, 62.75, 278, 1, 0, 'RD18899.png'),
(945, 'RD18899', 259, 35.00, 5, 175.00, 18, 'PWD', 3.37, '2024-10-13 11:19:17', 337.25, 400.00, 62.75, 278, 1, 0, 'RD18899.png'),
(946, 'RD74232', 296, 50.00, 3, 150.00, 0, '', 11.51, '2024-10-14 01:06:36', 1151.00, 1200.00, 49.00, 16, 0, 0, 'RD74232.png'),
(947, 'RD74232', 262, 267.00, 3, 801.00, 0, '', 11.51, '2024-10-14 01:06:36', 1151.00, 1200.00, 49.00, 16, 0, 0, 'RD74232.png'),
(948, 'RD74232', 273, 40.00, 5, 200.00, 0, '', 11.51, '2024-10-14 01:06:36', 1151.00, 1200.00, 49.00, 16, 0, 0, 'RD74232.png'),
(949, 'RD36073', 299, 1886.50, 1, 1886.50, 0, '', 20.87, '2024-10-14 01:08:15', 2086.50, 2500.00, 413.50, 16, 1, 0, 'RD36073.png'),
(950, 'RD36073', 274, 100.00, 2, 200.00, 0, '', 20.87, '2024-10-14 01:08:15', 2086.50, 2500.00, 413.50, 16, 1, 0, 'RD36073.png'),
(951, 'RD87952', 272, 100.00, 1, 100.00, 5, 'PWD', 1.03, '2024-10-14 04:36:02', 102.60, 500.00, 397.40, 16, 0, 0, 'RD87952.png'),
(952, 'RD87952', 288, 8.00, 1, 8.00, 5, 'PWD', 1.03, '2024-10-14 04:36:02', 102.60, 500.00, 397.40, 16, 0, 0, 'RD87952.png'),
(953, 'RD27421', 259, 35.00, 4, 140.00, 0, '', 16.8, '2025-03-12 19:42:23', 140.00, 500.00, 360.00, 16, 0, 0, 'RD27421.png');

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
(257, 'PROD84296', 'Bayong Big', 80.00, 0, 0, 0, 1, 10, 'A bayong is a traditional Filipino bag, usually woven from indigenous materials like rattan or buri leaves. It is commonly used for carrying groceries, clothes, or other items. The bags design is simple and versatile, making it a popular choice for everyday use in the Philippines.', 0, '67d17125d1df7.jpg', '2024-02-22 17:25:57', '2025-03-12 19:33:57', 0, 'PROD84296.png', 1, 0, 'N/A', 'pcs', 0, 0),
(258, 'PROD5091', 'Cat Litter', 160.00, 0, 0, 0, 1, 20, 'Cat litter is a granular substance used in litter boxes to absorb moisture and control odors from cat waste. It can be made from various materials like clay, silica gel, wood, or recycled paper. Litter is essential for maintaining a clean and hygienic environment for indoor cats.', 0, '65d713763820a.jpg', '2024-02-22 17:27:18', '2024-10-07 08:19:02', 0, 'PROD5091.png', 1, 0, 'N/A', 'pcs', 0, 0),
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
(272, 'PROD77746', 'S Hook Stainless', 100.00, 0, 0, 0, 1, 50, 'Stainless steel S hooks are commonly found in homes, workshops, garages, and farms due to their simplicity and utility. They come in various sizes to accommodate different weight capacities and uses.', 0, '65d719caf192a.jpg', '2024-02-22 17:54:18', '2024-09-23 01:55:12', 0, 'PROD77746.png', 1, 0, 'N/A', 'pcs', 0, 0),
(273, 'PROD4589', 'Tooth Brush', 40.00, 0, 0, 0, 1, 50, 'A toothbrush for pets is a grooming tool designed specifically for cleaning a pets teeth. It typically has a smaller head and softer bristles than a human toothbrush, making it more comfortable for pets. Pet toothbrushes come in various sizes and shapes, catering to different breeds and sizes of animals. They are used to prevent dental issues and maintain oral hygiene in pets.', 0, '65d71b123ee08.jpg', '2024-02-22 17:59:46', NULL, 0, 'PROD4589.png', 1, 0, 'N/A', 'pcs', 0, 0),
(274, 'PROD83680', 'Water Bottle Bird', 100.00, 0, 0, 0, 1, 100, '\r\nA water bottle for birds is a container designed to provide a continuous supply of water for pet birds. It typically consists of a plastic or glass bottle with a metal tube or ball bearing at the bottom. When the bird drinks from the tube, the water is released, ensuring a clean and accessible water source. This design helps prevent contamination and spillage, making it a convenient option for bird owners.', 0, '65d71b552b60c.jpg', '2024-02-22 18:00:53', NULL, 0, 'PROD83680.png', 1, 0, 'N/A', 'pcs', 0, 0),
(275, 'PROD40561', 'Water Pot for Chicken', 250.00, 0, 0, 0, 1, 50, '\r\nA water pot for chickens is a container used to provide a continuous supply of water for poultry. It typically consists of a plastic or metal pot with a narrow opening and a wide base to prevent tipping. The pot is filled with water, and the chickens can access the water through a small opening or a nipple drinker. This design helps prevent contamination and ensures that the chickens have access to clean water at all times.', 0, '65d71baf156aa.jpg', '2024-02-22 18:02:23', NULL, 0, 'PROD40561.png', 1, 0, 'N/A', 'pcs', 0, 0),
(276, 'PROD11219', 'Wooden Bird Box', 450.00, 0, 0, 0, 1, 50, 'A wooden bird box, also known as a birdhouse or nesting box, is a small structure made of wood that provides a safe and comfortable nesting site for birds. It typically has a small entrance hole, a floor, and a roof, and it may have a hinged door for cleaning. Bird boxes come in various shapes and sizes, catering to different bird species. They are placed in gardens, parks, or natural areas to encourage nesting and provide shelter for birds.', 0, '65d71bf35793b.jpg', '2024-02-22 18:03:31', '2024-02-23 13:04:52', 0, 'PROD11219.png', 0, 0, 'N/A', 'pcs', 0, 0),
(277, 'PROD30333', 'Wood Flakes', 100.00, 0, 0, 0, 1, 50, 'Wood flakes, also known as wood shavings or wood chips, are small pieces of wood that are typically used as bedding material for small animals, such as hamsters, guinea pigs, rabbits, and birds. Wood flakes are often made from softwood species like pine or cedar, and they provide a comfortable and absorbent surface for animals to rest on. They also help control odors and absorb moisture, making them a popular choice for pet owners.', 0, '65d71c216fea1.jpg', '2024-02-22 18:04:17', '2024-02-22 21:53:21', 0, 'PROD30333.png', 0, 0, 'N/A', 'kg', 0, 0),
(278, 'PROD84742', 'new product', 100.00, 500, 0, 0, 2, 100, 'hgjhagdjhasghjdgashjdgasd', 0, '65d758cd8517e.png', '2024-02-22 22:23:09', '2024-02-23 13:02:54', 2, 'PROD84742.png', 0, 0, 'N/A', 'kg', 0, 0),
(279, 'PROD22904', 'Beef Teriyaki', 523.00, 0, 0, 0, 2, 15, 'Size 8kg\r\nFlavor Beef teriyaki\r\nDry dog food\r\n \r\n\r\nIngredients\r\nMeat, meal, ground rice, high protein soyben meal, beef tallow preserved with mixed tacopherols, source of natural vitamin E, rice bran, dried banana meal, banana flour, flax seed, lecithin, calcium phosphate, amino acids supplements Llysine HCI, DLMethionine, LThreonine, yucca schidigera extract , salt, trace minerals, copper, sulfate, ferrous sulfate, magnesium sulfate, potassium iodide, sodium selenite, zinc oxide, vitamin supplements choline chloride, vit A, vit D3, vit E, thiamine mononitrate, riboflavin, vit B, vit B12, nlacin, biotin, folic acid.\r\n \r\n\r\nGuaranteed analysis\r\nCrude protein min 19.0\r\nCrude fat min 8.0\r\nCrude fiber 5.0\r\nCrude ash, max 12.0\r\nMoisture 12.0', 0, '65df5826071ab.jpg', '2024-02-28 23:58:30', NULL, 0, 'PROD22904.png', 1, 0, 'N/A', 'kg', 0, 0),
(280, 'PROD35580', 'Amty 500', 13.00, 0, 0, 0, 3, 10, 'Amtyl 500, the No. 1 and most trusted antibiotic brand for gamefowls, contains the powerful combination ofAmoxicillin and Tylosin. Its components are effective against respiratory, urogenital and integumentary system of gamefowls. Numerous foreign and local breeders refer to AMTYL 500 as a miracle drug.\r\n\r\nFor Prevention and Treatment of the following\r\nInfectious Coryza or Pisik na sipon\r\nChronic Respiratory Disease CRD or Halak na sipon\r\nFowl Pox\r\nAll type of wounds\r\nBacterial flushing', 0, '65df5952bd591.jpg', '2024-02-29 00:03:30', '2024-10-13 22:20:30', 0, 'PROD35580.png', 1, 0, 'withExpi', 'pcs', 0, 0),
(281, 'PROD54484', 'Dog Bag', 600.00, 0, 0, 0, 1, 10, 'Dog Front Carrier Bag Adjustable, Legs Out, Pet Cat Dog Carrier Backpack for Walking, Traveling, Hiking, Camping, Bike and Motorcycle\r\n\r\nBag size\r\nS28cm18cm', 0, '65df5a8d04f17.png', '2024-02-29 00:08:45', NULL, 2, 'PROD54484.png', 1, 0, 'N/A', 'pcs', 0, 0),
(282, 'PROD80899', 'Hair Brush', 60.00, 0, 0, 0, 1, 15, 'Brush Mix Colors is a handy grooming tool designed specifically for removing pet hair from various surfaces. The brush features a mix of colors, adding a vibrant and fun touch to the grooming process.\r\n\r\n', 0, '65df5b93d0055.jpg', '2024-02-29 00:13:07', NULL, 2, 'PROD80899.png', 1, 0, 'N/A', 'pcs', 0, 0),
(283, 'PROD80158', 'Dog Collar Big', 100.00, 0, 0, 0, 1, 10, 'Collars are made from hightensile strength nylon webbing with sewn on polyester and nylon ribbons, and are stain and fray resistant. They are designed to last a lifetime Complete the look with the matching harness and lead.\r\n\r\nMachine washable\r\nAll hardware is cast brass, not welded, for extra strength\r\nBuckles are Coast Guard approved for high weight hold\r\n', 0, '65df5ccbbc4be.jpg', '2024-02-29 00:18:19', NULL, 0, 'PROD80158.png', 1, 0, 'N/A', 'pcs', 0, 0),
(284, 'PROD36803', 'Aozi Puppy', 3399.00, 0, 0, 0, 2, 10, 'Aozi Puppy refers to a specific brand of pet food designed for puppies. Aozi is known for producing highquality, natural pet foods that focus on providing balanced nutrition for growing dogs. Their puppy food formulas are typically enriched with essential vitamins, minerals, and proteins to support the healthy development of puppies, promoting strong bones, muscles, and a healthy coat.', 0, '65dfc59f5a48e.jpg', '2024-02-29 07:45:35', '2024-09-23 01:04:29', 0, 'PROD36803.png', 1, 0, 'N/A', 'kg', 0, 0),
(285, 'PROD58890', 'Chick Booter', 40.00, 0, 0, 0, 2, 15, 'Energy Booster for day old chicks\r\nChickBoost is an energy booster, formulated for DOC, turkey poults and ducklings.\r\nChickBoost enables chicks to have access to water and feed at hatchery or during transportation.\r\nIt helps chicks to start feeding quicker after arrival on the farm.', 0, '65dfc656c9367.jpg', '2024-02-29 07:48:38', NULL, 2, 'PROD58890.png', 1, 0, 'N/A', 'kg', 0, 0),
(286, 'PROD61019', 'Integra 3000', 37.00, 0, 0, 0, 2, 15, 'BMEG Integra 3000 Free Range Chicken Finisher Pellet\r\nSan Miguel Foods, Inc.\r\nContent\r\nCorn, cassava meal, feed wheat, soybean meal, full fat soya, fish meal, wheat pollard, rice bran, pork meal, distillers dried grains solubles, meat and bone meal, crude coconut oil, palm olein, limestone, inorganic phosphates, iodized salt, lysine sulfate, DLmethionine, Llysine, Lthreonine, probiotic, organic selenium, choline chloride, vitamin premix, mineral premix, phytase enzyme, protease enzyme, cellulase enzyme, xylanase enzyme, toxin binders, mold inhibitor, antioxidants. Guaranteed analysis crude protein 17 min, crude fiber 8 max, crude fat 3 min, calcium 0.750.85, phosphorous 0.55 min, moisture 12 max', 0, '65dfc6f77991b.jpg', '2024-02-29 07:51:19', NULL, 0, 'PROD61019.png', 1, 0, 'N/A', 'kg', 0, 0),
(287, 'PROD92019', 'Power Cat Tuna', 1546.00, 0, 0, 0, 2, 10, 'Halal fresh organic, Halal certified\r\nAdheres to the strictest hygiene, quality  safety standards\r\nConsist of the finest natural ingredients fresh fish, high protein\r\nPremium quality dry food, high nutrition, fresh  rich in vitamins\r\nNo preservatives, no artificial coloring, does not contain salt', 0, '65dfc7762634a.jpg', '2024-02-29 07:53:26', NULL, 0, 'PROD92019.png', 1, 0, 'N/A', 'kg', 0, 0),
(288, 'PROD5805', 'B 50 Forten ', 8.00, 0, 0, 0, 3, 10, 'Improves body metabolism and increases energy production\r\nSharpens gamefowls reflexes and boosts resistance against stress and diseases\r\nPrevents hemorrhages and hastens wound healing\r\nNecessary for normal bone growth and development\r\nEnhances appetite, normal growth and reproduction\r\nImportant in maintaining structural integrity of cells, tissues and mucous membranes\r\nMaintains osmotic pressure and acidbase balance', 0, '65dfc881b35bb.jpg', '2024-02-29 07:57:53', NULL, 0, 'PROD5805.png', 1, 0, 'N/A', 'pcs', 0, 0),
(289, 'PROD18871', 'Combinex ', 325.00, 0, 150, 0, 3, 15, 'Combinex should be applied as soon as possible to prevent fly and worm infestation. DIRECTION OF USE 1 Clean the wound thoroughly 2 Hold the aerosol 10 cm 4in from the wound to be treated 3 Release spray by pressing the nozzle. Continue to spray until wound is completely covered and wessst.', 0, '65dfc9400440e.jpg', '2024-02-29 08:01:04', '2024-09-23 02:11:14', 0, 'PROD18871.png', 1, 0, 'withExpi', 'pcs', 0, 0),
(290, 'PROD18291', 'Dextrose Powder ', 180.00, 0, 0, 0, 3, 15, 'CONTENT\r\n\r\n99.9 D  Glucose Monohydrate\r\n\r\nBENEFITS  USES\r\n\r\nProvides energy as immediate first aid in the first few hours or days of illness\r\nPartially provides rehydration in dehydrated dogs and cats\r\nDOSAGE\r\n\r\nDissolve 2 tbsp of powder in 250 mL water. Mix then serve via syringe or dropper at the side of the mouth. Provide at least 60 mL of the solution per 1 kg of your pets weight.', 0, '66fa71f14d86c.png', '2024-02-29 08:03:48', '2024-09-30 17:40:01', 2, 'PROD18291.png', 1, 0, 'withExpi', 'kg', 0, 0),
(291, 'PROD65819', 'Cowhead', 100.00, 0, 1000, 0, 1, 5, 'Gatas ng baka masarap', 0, '65e2e5d1c7f27.jpg', '2024-03-02 16:39:45', NULL, 2, 'PROD65819.png', 1, 0, 'withExpi', 'kg', 0, 0),
(292, 'PROD87196', 'CAT FOOD', 99.00, 0, 0, 0, 2, 10, 'food for cat', 0, '66eadf2a00670.jpeg', '2024-09-18 22:09:45', NULL, 2, 'PROD87196.png', 1, 0, 'withExpi', 'kg', 0, 0),
(293, 'PROD3451', 'dog food', 99.00, 0, 0, 0, 2, 20, 'foods for dogs', 0, '66f84e7297a3a.jpeg', '2024-09-19 12:32:32', '2024-09-29 02:44:02', 2, 'PROD3451.png', 1, 0, 'withExpi', 'kg', 0, 0),
(294, 'PROD14294', 'dog food 3', 99.50, 0, 0, 0, 2, 10, 'food  for dogs', 0, '66ebbb58e8644.jpeg', '2024-09-19 13:49:12', NULL, 2, 'PROD14294.png', 1, 0, 'withExpi', 'kg', 0, 0),
(295, 'PROD82332', 'BMEG', 46.00, 0, 0, 0, 2, 10, 'BMEG is a wellknown brand of animal feeds in the Philippines, produced by San Miguel Foods, Inc. It offers a wide range of highquality feed products designed for various livestock, including poultry, pigs, fish, and other farm animals. BMEG is recognized for its commitment to providing balanced, nutritious, and scientifically formulated feeds that promote the healthy growth and productivity of animals.', 0, '66f051d01a700.png', '2024-09-23 01:20:16', '2024-10-07 07:03:08', 0, 'PROD82332.png', 1, 0, 'withExpi', 'kg', 0, 0),
(296, 'PROD98520', 'sheba tuna chicken', 50.00, 0, 0, 70, 2, 25, 'Sheba Tuna, Chicken  Bonito 70g Cat Wet Food contains a variety of protein and texture recipe for your adult feline.\r\n\r\nBest served straight from the pouch for a novel dining experience your feline friend will delight in.\r\n\r\nIngredients\r\n\r\nWater, Chicken meat, Tuna, Beef liver, Chicken byproducts, Flavour, Soybean oil, Wheat gluten, Minerals, Glycine, Gelling agents, Dried Bonito Powder, Vitamins, Taurine, Food preservative, Sodium nitrite, Antioxidant\r\n\r\nGuaranteed Analysis\r\n\r\nProtein min 7\r\nFat Content min 1\r\nFibres max 0.5\r\nMoisture max 88', 0, '66fa72d8435f6.jpg', '2024-09-30 17:43:52', NULL, 0, 'PROD98520.png', 1, 0, 'withExpi', 'kg', 0, 0),
(297, 'PROD55248', 'Vitmin Pro', 75.00, 0, 0, 0, 3, 10, 'Vitminpro is a watersoluble powder supplement used in poultry to enhance overall health, boost immunity, improve digestion, and promote growth. It contains a comprehensive blend of vitamins A, B complex, C, D3, E, K, minerals, electrolytes, amino acids, and probiotics. Vitminpro is commonly administered by mixing it into the drinking water of poultry, helping them cope with stress, extreme weather, and postvaccination recovery', 0, '67031acd3c9fe.jpg', '2024-10-07 07:18:37', NULL, 0, 'PROD55248.png', 1, 0, 'withExpi', 'kg', 0, 0),
(298, 'PROD29288', 'Zoi Cat', 2145.00, 0, 0, 0, 2, 15, 'Zoi Cat Cat Food is suitable for all adult cat breeds. Which is delicious and contain essential Vitamin, Minerals, and Amino acid for your beloved cat.', 0, '670397782eca1.jpg', '2024-10-07 16:10:32', NULL, 0, 'PROD29288.png', 1, 0, 'N/A', 'kg', 0, 0),
(299, 'PROD87456', 'Top Breed Puppy', 1886.50, 0, 0, 0, 2, 10, 'Top Breed was made and formulated to give dogs the nutritional value they need for their overall wellbeing and health.', 0, '670398e499200.jpg', '2024-10-07 16:16:36', NULL, 0, 'PROD87456.png', 1, 0, 'N/A', 'kg', 0, 0),
(300, 'PROD84660', 'Belamyl', 235.50, 0, 10, 0, 3, 11, 'VitaminB complex contains the most important members of the vitamin B group in pure form and in therapeutically balanced proportions. The members of the vitamin B group contained in VitaminB complex are components of enzyme systems that regulate various stages of carbohydrate, fat and protein metabolism, each of the components playing a specific biological role. ', 0, '670399c261440.jpg', '2024-10-07 16:20:18', '2024-10-08 10:10:36', 0, 'PROD84660.png', 1, 0, 'withExpi', 'pcs', 0, 0),
(301, 'PROD47976', ' Vitminpro', 75.00, 0, 0, 0, 3, 25, 'Complete MultivitaminsMineralsElectrolyteAmino AcidsProbiotics\r\nHealth enhancer\r\nImmunity enhancer\r\nAntiStress enhancer\r\nDigestion enhancer\r\nGrowth enhancer\r\n', 0, '67039a5a4a919.png', '2024-10-07 16:22:50', NULL, 2, 'PROD47976.png', 1, 0, 'withExpi', 'pcs', 0, 0),
(302, 'PROD84225', ' Salmon and Liver', 100.00, 0, 0, 0, 2, 5, 'Salmon and Liver Flavor For Dogs of All Breeds and Life Stages Pure natural organic food\r\nNatural Balanced Nutrition. No Preservatives. No Artificial Flavoring. No Coloring. No GMO', 0, '67039bc23a9b5.jpg', '2024-10-07 16:28:50', NULL, 0, 'PROD84225.png', 1, 0, 'withExpi', 'pcs', 0, 0),
(303, 'PROD25237', ' Beef Teriyaki', 522.50, 0, 0, 0, 2, 5, 'Pet One Beef Teriyaki 8kg Dry Dog Food\r\nSize 8kg\r\nFlavor Beef teriyaki\r\nDry dog food', 0, '67039e96cfd8f.jpg', '2024-10-07 16:40:54', NULL, 2, 'PROD25237.png', 1, 0, 'N/A', 'kg', 0, 0),
(304, 'PROD5606', 'Duck Layer', 30.00, 0, 0, 0, 2, 5, 'Layer duck feed with 1617 protein and extra calcium is needed for egglaying ducks1.', 0, '67039f70c4569.png', '2024-10-07 16:44:32', NULL, 0, 'PROD5606.png', 1, 0, 'N/A', 'kg', 0, 0),
(305, 'PROD18276', 'Chick Booster', 40.00, 0, 0, 0, 2, 10, 'Helps develop layer chicks healthy gut, ensuring a stronger immune system for a more diseaseresistant chick\r\nFor chicks aged 02 weeks', 0, '67039fd61c494.jpg', '2024-10-07 16:46:14', NULL, 2, 'PROD18276.png', 1, 0, 'N/A', 'kg', 0, 0),
(306, 'PROD30973', 'Water pot for chicken1L', 145.50, 0, 0, 0, 1, 5, 'Its easy to disassemble and clean and because its made of plastic and rubber, its easy to sanitize.', 0, '6703a21054925.jpeg', '2024-10-07 16:55:44', NULL, 2, 'PROD30973.png', 1, 0, 'N/A', 'pcs', 0, 0),
(307, 'PROD28621', 'Water pot for chicken3L', 250.00, 0, 0, 0, 1, 5, 'Light weight and small size, can be carried anywhere, surface is polished for easy cleaning.', 0, '6703a26931e68.jpg', '2024-10-07 16:57:13', '2024-10-08 08:10:27', 2, 'PROD28621.png', 1, 0, 'N/A', 'pcs', 0, 0),
(308, 'PROD18607', 'Water pot for chicken6L', 450.00, 0, 0, 0, 1, 10, 'Can be used by multiple poultry, the drinking system automatically provides fresh and clean water to the chicken, which is essential for the chicken to grow in a good environment.', 0, '6703a2c2d4624.jpg', '2024-10-07 16:58:42', NULL, 2, 'PROD18607.png', 1, 0, 'N/A', 'pcs', 0, 0),
(309, 'PROD86937', 'Wooden Bird box small', 500.00, 0, 0, 0, 1, 5, 'material Pine imported wood and pine palochina wood\r\nheavy duty and quality nest box', 0, '6703a34faf83d.jpg', '2024-10-07 17:01:03', NULL, 2, 'PROD86937.png', 1, 0, 'N/A', 'pcs', 0, 0),
(310, 'PROD23017', 'Wood Flakes', 100.00, 0, 0, 0, 1, 5, 'Highly absorbent\r\nNatural  biodegradable\r\nMade from soft  white flakes\r\nLong lasting odor control  dust free', 0, '6703a463753dc.jpg', '2024-10-07 17:05:39', NULL, 2, 'PROD23017.png', 1, 0, 'N/A', 'pcs', 0, 0),
(311, 'PROD56482', 'Toothbrush', 40.00, 0, 0, 0, 1, 4, 'Caring for your dogs teeth is very important to help maintain their health it should begin when still Puppy. ', 0, '6703a65f9cf06.jpg', '2024-10-07 17:14:07', NULL, 2, 'PROD56482.png', 1, 0, 'N/A', 'pcs', 0, 0),
(312, 'PROD11924', 'Stag d crumble ', 44.00, 0, 0, 0, 2, 5, 'Stag Developer Crumble  0 to 4 months', 0, '6703a77faa455.png', '2024-10-07 17:18:55', NULL, 0, 'PROD11924.png', 1, 0, 'N/A', 'kg', 0, 0),
(313, 'PROD75249', 'Top Breed Adult', 1570.50, 0, 0, 0, 2, 5, 'INGREDIENTS\r\nMeat Meal, Wheat Grains and Wheatbyproducts, Rice MiddlingBran, Soya Meal, Beef Tallow Preserved with Tocopherol, Vegetable Oil, Nutritional Yeast, Animal Digest, Salt, Amino Acids, Yucca Extract, Vitamin and Mineral Premix, Omega 3 and 6 Fatty Acids, Antioxidants, Antimold, Enzymes', 0, '6703a81029246.jpg', '2024-10-07 17:21:20', NULL, 0, 'PROD75249.png', 1, 0, 'N/A', 'kg', 0, 0),
(314, 'PROD86607', 'Vitakraf sauce ', 60.00, 0, 0, 85, 2, 4, 'These tasty appetizers with delicious cod fish , tender chicken, or beef a lot of fine sauce are a true culinary treat for your cat and are irresistible in the taste.', 0, '6703a8807c989.jpg', '2024-10-07 17:23:12', '2024-10-07 17:23:27', 0, 'PROD86607.png', 1, 0, 'withExpi', 'pcs', 0, 0),
(315, 'PROD76174', 'BowWow Adult', 1672.00, 0, 0, 0, 2, 5, ' All Breed Beef Adult Dog food 20kg \r\nComplete and Balanced diet for your dogs\r\nFortified with vitamins and minerals ', 0, '6703a97ca1b86.jpg', '2024-10-07 17:27:24', NULL, 0, 'PROD76174.png', 1, 0, 'N/A', 'kg', 0, 0),
(316, 'PROD99235', 'Dextrose Powder', 180.00, 0, 0, 0, 3, 6, ' Dextrose  a highgrade medicinal glucose for rapid energy and effective for rapid relief and prevention of fatigue', 0, '67d1716022f0e.png', '2024-10-07 17:30:27', '2025-03-12 19:34:56', 0, 'PROD99235.png', 1, 0, 'withExpi', 'kg', 0, 0),
(317, 'PROD11766', 'PAKYAW Tablet', 7.00, 75, 0, 0, 3, 7, 'Antihelmintics , Immature  mature stages of gastrointestinal namatodes, kidney  lungworms in chicken and pigs.', 0, '6703aaa7cd6c7.png', '2024-10-07 17:32:23', '2024-10-10 21:34:44', 0, 'PROD11766.png', 1, 0, 'withExpi', 'pcs', 0, 0),
(318, 'PROD26909', 'Ivermectin', 480.00, 0, 0, 0, 3, 5, 'Ivermectin is a medication that treats some parasitic diseases.', 0, '67d1710648e4d.jpg', '2024-10-07 17:38:30', '2025-03-12 19:33:26', 0, 'PROD26909.png', 1, 0, 'withExpi', 'pcs', 0, 0),
(319, 'PROD26196', 'BastoneroPlus', 200.00, 0, 0, 0, 3, 20, 'For the control and treatment of larval and adult stages of internal parasites.', 0, '6707df4e88f12.jpg', '2024-10-10 22:06:06', NULL, 0, 'PROD26196.png', 1, 0, 'withExpi', 'pack ', 0, 0),
(320, 'PROD13254', 'Wash out intense', 216.00, 0, 700, 0, 3, 20, 'A Shampoo that kills and controls lice and mites.\r\nCan be used for fighting cocks, goats, dogs, and other animals.\r\n', 0, '6707e091a63e6.png', '2024-10-10 22:11:29', '2024-10-14 13:52:06', 0, 'PROD13254.png', 1, 0, 'N/A', 'btl', 0, 0),
(321, 'PROD41571', 'Apralyte', 27.00, 0, 0, 0, 3, 10, 'APRALYTE is the fastacting antiscouring antibiotic against piglet diarrhea. It has 4 gutactive formula, APRAMYCIN, ATTAPULGITE, ELECTROLYTES and GLYCINEGLUCOSE that provides total scouring solution', 0, '67d171424938a.jpg', '2024-10-10 22:15:00', '2025-03-12 19:34:26', 0, 'PROD41571.png', 1, 0, 'withExpi', 'sach', 0, 0),
(322, 'PROD51966', 'Belamyl 50ml', 572.00, 0, 50, 0, 3, 10, 'Foods, drugs, devices and cosmetic act prohibit dispensing without prescription of a duly licensed veterinarian', 0, '6707e1ed6be89.jpg', '2024-10-10 22:17:17', NULL, 2, 'PROD51966.png', 1, 0, 'withExpi', 'btl', 0, 0),
(323, 'PROD24860', 'Belamyl 100ml', 1094.50, 0, 100, 0, 3, 15, 'Dietary supplement for all animals with Bcomplex deficiencies and anemia associated with lack of Vitamin B12', 0, '6707e2fa3baf0.jpg', '2024-10-10 22:21:46', NULL, 2, 'PROD24860.png', 1, 0, 'withExpi', 'pcs', 0, 0),
(324, 'PROD95733', 'Ambroxitil', 24.00, 0, 0, 0, 3, 10, ' Indicated for the prevention and treatment of Respiratory, Intestinal and Urinary track infection of poultry, swine and calves.', 0, '6707e3a896a72.jpg', '2024-10-10 22:24:40', NULL, 0, 'PROD95733.png', 1, 0, 'withExpi', 'sach', 0, 0),
(325, 'PROD99203', 'NutriVit Plus 12x', 99.00, 0, 120, 0, 3, 10, 'VITAMINS\r\nMINERAL\r\nLYSINE\r\nTAURINE\r\nCHLORELLA GROWTH FACTOR  CGF\r\nwith free Syringe 3ml', 0, '6707e61eeaeb6.png', '2024-10-10 22:35:10', '2024-10-13 22:27:09', 0, 'PROD99203.png', 1, 0, 'withExpi', 'btl', 0, 0),
(326, 'PROD94210', 'Multivitamin B12 Capsule', 59.50, 0, 0, 0, 3, 10, 'One tab daily for fighting cocks and racing pigeons Two tablets daily for dogs and cats', 0, '67d171988d5fb.jpg', '2024-10-10 22:39:52', '2025-03-12 19:35:52', 0, 'PROD94210.png', 1, 0, 'withExpi', 'pcs', 0, 0);

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
(10, 286, 'photo_6697b8034cb8d3.51809538.jpeg'),
(11, 286, 'photo_6697b80c9505d4.00919419.jpeg'),
(12, 288, 'photo_6697b84b63b5d3.19794199.webp'),
(18, 287, 'photo_669bad591d0d67.17127399.jpeg'),
(19, 287, 'photo_669bad96bcd260.17974144.webp'),
(35, 290, 'photo_66e9155cc5a467.87169554.jpeg'),
(36, 290, 'photo_66e9156974a820.69904270.jpeg'),
(37, 292, 'photo_66eae20ae822d9.39481984.jpeg'),
(38, 292, 'photo_66eae21ce7f0c8.07488956.jpeg'),
(39, 294, 'photo_66ebbc0a536f75.45548131.jpeg'),
(40, 294, 'photo_66ebbc15635a43.31710749.jpg'),
(42, 295, 'photo_66fa762b8cee29.68760320.jpg'),
(43, 295, 'photo_66fa7691efe731.02666147.jpeg'),
(44, 258, 'photo_66fc2fe9c5c4b5.06541194.jpeg'),
(45, 258, 'photo_66fc2ff641e7f7.52408938.jpg'),
(46, 260, 'photo_66fc3165dcf6d7.06753492.jpeg'),
(47, 260, 'photo_66fc316ea87e40.17098474.jpeg'),
(50, 259, 'photo_670bb7735f5bc6.48082804.webp'),
(51, 259, 'photo_670bb77d8ac099.39685591.jpg'),
(52, 321, 'photo_670bbb8514b966.58622787.webp'),
(53, 321, 'photo_670bbb8fd48228.02365727.webp'),
(54, 324, 'photo_670bbbfe17c719.90169995.jpg'),
(55, 324, 'photo_670bbc062e2520.67173606.jpg'),
(56, 288, 'photo_670bd3d0293c23.36949063.webp'),
(59, 280, 'photo_670bd799c6b345.18496145.jpeg'),
(60, 266, 'photo_670bd7eed6a6a4.11744719.webp'),
(61, 326, 'photo_670bd87964be58.33579997.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `rate_reviews`
--

CREATE TABLE `rate_reviews` (
  `r_rate_id` int(11) NOT NULL,
  `r_user_id` int(11) NOT NULL,
  `r_prod_id` int(11) NOT NULL,
  `r_rate` int(10) NOT NULL,
  `r_feedback` varchar(255) NOT NULL,
  `r_date_added` datetime NOT NULL,
  `r_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rate_reviews`
--

INSERT INTO `rate_reviews` (`r_rate_id`, `r_user_id`, `r_prod_id`, `r_rate`, `r_feedback`, `r_date_added`, `r_status`) VALUES
(31, 292, 257, 4, 'Good quality', '2024-09-29 03:50:57', 1),
(32, 301, 257, 5, 'Good Quality', '2024-10-01 23:56:20', 1),
(33, 311, 257, 5, 'Maganda yung item tamang tama para sa mga gulay na napamalengke ko', '2024-10-02 00:03:24', 1),
(41, 301, 259, 4, 'Good for my dogs', '2024-10-02 00:38:46', 1),
(42, 301, 258, 5, 'Good Packaging', '2024-10-02 01:02:13', 1),
(43, 301, 261, 4, 'Good Packaging and Good Quality', '2024-10-02 01:07:03', 1),
(44, 301, 266, 3, 'cute brush', '2024-10-02 01:16:59', 1),
(45, 301, 265, 5, 'nice collar', '2024-10-02 01:17:13', 1),
(46, 301, 262, 5, 'Good for it\'s price , so easy to assemble.', '2024-10-02 01:18:13', 1),
(48, 301, 265, 3, 'nice', '2024-10-02 01:19:21', 1),
(50, 320, 257, 4, 'Ang ganda ng quality at ang bilis pa nadeliver ni rider', '2024-10-12 22:50:22', 1),
(51, 320, 261, 5, 'ganda ng color pink', '2024-10-12 22:50:54', 1),
(52, 292, 267, 4, '👍👍👍', '2024-10-13 00:05:36', 1),
(53, 292, 260, 5, '🥰🥰🥰🥰', '2024-10-13 00:05:49', 1),
(54, 292, 261, 5, '🥰🥰😍😍😍😍', '2024-10-13 17:19:41', 1),
(55, 321, 257, 4, 'Ganda ng Quality 😍😍😍', '2024-10-13 19:48:21', 1),
(56, 321, 325, 4, '😍😍😍', '2024-10-13 19:48:45', 1),
(57, 321, 262, 3, '🤗🤗🤗', '2024-10-13 19:49:06', 1),
(58, 292, 288, 5, '', '2024-10-13 23:38:45', 1),
(59, 292, 280, 5, '', '2024-10-13 23:38:58', 1),
(62, 292, 270, 5, '', '2024-10-13 23:39:19', 1),
(63, 313, 280, 5, '', '2024-10-13 23:56:29', 1),
(64, 313, 259, 5, '', '2024-10-13 23:56:41', 1),
(65, 313, 257, 5, '', '2024-10-13 23:57:00', 1),
(66, 313, 271, 5, '', '2024-10-13 23:57:04', 1),
(67, 301, 280, 4, '', '2024-10-14 00:03:32', 1),
(68, 301, 288, 3, '', '2024-10-14 00:03:37', 1),
(69, 301, 266, 4, '', '2024-10-14 00:03:40', 1),
(70, 301, 321, 3, '', '2024-10-14 00:03:45', 1),
(71, 301, 273, 4, '', '2024-10-14 00:03:50', 1),
(72, 301, 297, 4, '', '2024-10-14 00:03:56', 1),
(73, 314, 324, 4, '', '2024-10-14 00:45:36', 1),
(74, 314, 326, 4, '', '2024-10-14 00:45:43', 1),
(76, 314, 272, 4, '', '2024-10-14 00:45:56', 1),
(77, 314, 274, 4, 'Cute ng packaging', '2024-10-14 00:46:06', 1),
(78, 314, 286, 4, '', '2024-10-14 00:46:16', 1),
(79, 314, 273, 5, '', '2024-10-14 00:46:21', 1),
(81, 314, 280, 4, '', '2024-10-14 00:46:33', 1),
(82, 314, 262, 3, '', '2024-10-14 00:46:55', 1),
(83, 314, 259, 4, 'My dogs love it = I love it. Truly indestructible appropriate for my dog that always destroys any toy i give to her. Its also heavy, indicative of the quality material its made of. So heavy enough that it might break your floor tiles.', '2024-10-14 00:47:32', 1),
(85, 314, 275, 2, '', '2024-10-14 00:55:59', 1),
(86, 314, 268, 2, '', '2024-10-14 00:56:10', 1),
(88, 314, 321, 2, '', '2024-10-14 01:33:06', 1),
(89, 314, 320, 4, '', '2024-10-14 01:34:35', 1),
(91, 314, 257, 4, '', '2024-10-14 01:36:42', 1),
(93, 292, 269, 5, '', '2024-10-14 01:39:52', 1),
(94, 292, 268, 3, '', '2024-10-14 01:39:58', 1),
(95, 292, 280, 5, '', '2024-10-14 01:40:13', 1),
(97, 292, 269, 5, '', '2024-10-14 01:43:45', 1),
(98, 320, 288, 5, '', '2024-10-14 01:49:55', 1),
(99, 320, 266, 5, '', '2024-10-14 01:49:58', 1),
(100, 320, 259, 5, '', '2024-10-14 01:50:06', 1),
(102, 320, 260, 3, 'Ganda ng packaging ng item ko they make sure na hindi mababbasag worth it s price nya pinakagat ko na s mga aso ko and nagustuhan naman nila kaso nag aagawan pa eh tig isa naman na sila hehe thank you seller till next transaction', '2024-10-14 01:53:05', 1),
(103, 315, 265, 4, '', '2024-10-14 01:57:12', 1),
(104, 315, 280, 5, '', '2024-10-14 01:57:19', 1),
(105, 315, 266, 5, '', '2024-10-14 02:01:24', 1),
(106, 315, 267, 5, '', '2024-10-14 02:01:28', 1),
(108, 315, 275, 5, '', '2024-10-14 02:01:42', 1),
(109, 315, 268, 5, '', '2024-10-14 02:01:46', 1),
(110, 315, 302, 4, '', '2024-10-14 02:01:52', 1),
(111, 315, 287, 5, '', '2024-10-14 02:01:59', 1),
(112, 315, 324, 4, '', '2024-10-14 02:02:06', 1),
(113, 315, 325, 5, '', '2024-10-14 02:02:13', 1),
(114, 315, 273, 4, '', '2024-10-14 02:02:19', 1),
(115, 315, 270, 5, '', '2024-10-14 02:02:26', 1),
(116, 315, 288, 5, '', '2024-10-14 02:02:33', 1),
(119, 315, 257, 4, '', '2024-10-14 02:03:36', 1),
(121, 315, 325, 5, '', '2024-10-14 02:06:07', 1),
(122, 315, 320, 5, '', '2024-10-14 02:07:25', 1),
(123, 315, 265, 4, '', '2024-10-14 02:11:34', 1),
(124, 315, 265, 2, '', '2024-10-14 02:11:38', 1),
(125, 315, 265, 5, '', '2024-10-14 02:11:55', 1),
(126, 315, 265, 5, '', '2024-10-14 02:11:58', 1),
(127, 315, 265, 5, '', '2024-10-14 02:11:58', 1),
(128, 320, 266, 5, '', '2024-10-14 02:14:39', 1),
(129, 301, 273, 3, '', '2024-10-14 02:16:56', 1),
(131, 301, 283, 4, 'Ganda ng packaging ng item ko they make sure na hindi mababbasag worth it s price nya pinakagat ko na s mga aso ko and nagustuhan naman nila kaso nag aagawan pa eh tig isa naman na sila hehe thank you seller till next transaction', '2024-10-14 02:19:58', 1),
(132, 301, 275, 5, 'Ganda ng packaging ng item ko they make sure na hindi mababbasag worth it s price nya pinakagat ko na s mga aso ko and nagustuhan naman nila kaso nag aagawan pa eh tig isa naman na sila hehe thank you seller till next transaction', '2024-10-14 02:20:06', 1),
(133, 301, 316, 2, 'Ganda ng packaging ng item ko they make sure na hindi mababbasag worth it s price nya pinakagat ko na s mga aso ko and nagustuhan naman nila kaso nag aagawan pa eh tig isa naman na sila hehe thank you seller till next transaction', '2024-10-14 02:20:15', 1),
(134, 301, 283, 5, 'Delivery was fast and easy\n\nItem looks expensive but affordable and easy to use\nProduct came well packed with great quality\nMy dog loves em\n\nI will definitely buy again once our fur baby finishes it', '2024-10-14 02:20:41', 1),
(135, 301, 326, 4, '', '2024-10-14 02:20:51', 1),
(136, 301, 267, 4, 'Delivery was fast and easy\n\nItem looks expensive but affordable and easy to use\nProduct came well packed with great quality\nMy dog loves em\n\nI will definitely buy again once our fur baby finishes it', '2024-10-14 02:21:48', 1),
(137, 301, 297, 3, '', '2024-10-14 02:22:02', 1),
(138, 301, 260, 5, '', '2024-10-14 02:22:05', 1),
(139, 301, 326, 5, 'Very fast shipping! This product really exceeded my expectation', '2024-10-14 02:22:52', 1),
(140, 301, 321, 5, '', '2024-10-14 02:24:29', 1),
(141, 301, 297, 4, '', '2024-10-14 02:24:56', 1),
(142, 301, 316, 4, '', '2024-10-14 02:25:13', 1),
(143, 301, 275, 5, '', '2024-10-14 02:25:19', 1),
(144, 301, 284, 5, '', '2024-10-14 02:25:27', 1),
(145, 322, 257, 5, '', '2024-10-14 02:32:35', 1),
(146, 322, 280, 5, '', '2024-10-14 02:32:42', 1),
(147, 322, 288, 5, '', '2024-10-14 02:32:46', 1),
(148, 322, 259, 5, '', '2024-10-14 02:32:50', 1),
(149, 322, 266, 5, '', '2024-10-14 02:32:54', 1),
(150, 322, 258, 5, '', '2024-10-14 02:33:00', 1),
(151, 322, 313, 5, '', '2024-10-14 02:33:06', 1),
(152, 322, 321, 5, '', '2024-10-14 02:33:11', 1),
(153, 322, 262, 5, '', '2024-10-14 02:33:18', 1),
(154, 322, 279, 4, '', '2024-10-14 02:36:24', 1),
(155, 322, 272, 3, '', '2024-10-14 02:36:32', 1),
(156, 322, 286, 4, '', '2024-10-14 02:36:35', 1),
(157, 322, 289, 4, '', '2024-10-14 02:36:40', 1),
(158, 322, 304, 5, '', '2024-10-14 02:36:44', 1),
(159, 322, 284, 4, '', '2024-10-14 02:36:53', 1),
(160, 321, 280, 5, '', '2024-10-14 03:00:15', 2),
(161, 321, 288, 5, '', '2024-10-14 03:00:19', 1),
(162, 321, 257, 5, 'I love bayong 😍😍🤗🤗🤗🤗😍', '2024-10-14 03:02:28', 1),
(163, 321, 262, 5, '', '2024-10-14 03:02:35', 1),
(164, 321, 325, 3, '', '2024-10-14 03:02:40', 1),
(165, 321, 318, 5, '', '2024-10-14 03:10:20', 1),
(166, 292, 288, 1, 'bad item', '2024-10-14 14:24:54', 1);

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
-- Table structure for table `return_pos_table`
--

CREATE TABLE `return_pos_table` (
  `id` int(11) NOT NULL,
  `rdate` date NOT NULL,
  `rcode` varchar(255) NOT NULL,
  `rreason` text NOT NULL,
  `rtype` varchar(255) NOT NULL,
  `selected_items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`selected_items`)),
  `rtransaction` int(1) NOT NULL DEFAULT 0,
  `rproof` varchar(100) NOT NULL,
  `rcustomer` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `return_pos_table`
--

INSERT INTO `return_pos_table` (`id`, `rdate`, `rcode`, `rreason`, `rtype`, `selected_items`, `rtransaction`, `rproof`, `rcustomer`) VALUES
(15, '2024-09-25', 'RD17482', 'Expired', 'Replace', '{\"277\":{\"prodName\":\"Wood Flakes\",\"quantity\":\"2\",\"price\":100}}', 0, '657e714b90ff0efe51cd987e8bb9531a.jpg', 'joshua padilla'),
(16, '2024-10-06', 'RD22077', 'Defective', 'Replace', '{\"288\":{\"prodName\":\"B 50 Forten\",\"quantity\":\"2\",\"price\":8}}', 0, '758b2baed00632e448eacb4d47feb1a8.jpg', 'Zyrine Alcarez'),
(17, '2024-10-13', 'ORD-885157', 'Expired', 'Replace', '{\"325\":{\"prodName\":\"NutriVit Plus 12x120ml\",\"quantity\":\"1\",\"price\":99}}', 1, '6a02bcd772807eae176eb1e6b3deb8b1.jpeg', 'Joshua Padilla'),
(18, '2024-10-13', 'RD18899', 'Defective', 'Replace', '{\"266\":{\"prodName\":\"Hair Brush\",\"quantity\":\"1\",\"price\":60}}', 0, 'cfeefd459671ce5cc365857dbafbc04b.jpeg', 'Joshua Anderson'),
(19, '2024-10-14', 'ORD-332213', 'Defective', 'Replace', '{\"268\":{\"prodName\":\"Lori Soap\",\"quantity\":\"1\",\"price\":62}}', 1, 'f0e4a841a511fb44ac9cb0b8d9b9fe1d.jpg', 'joshua padilla'),
(20, '2025-03-12', 'RD36073', 'Expired', 'Replace', '{\"274\":{\"prodName\":\"Water Bottle Bird\",\"quantity\":\"2\",\"price\":100}}', 0, '5b0e0597299d131511cc979434f9fefe.png', 'Joshua padilla');

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
  `s_supplierPrice` decimal(12,2) NOT NULL,
  `s_spl_id` int(11) NOT NULL,
  `s_edited` datetime DEFAULT NULL,
  `s_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`s_id`, `s_stockin_date`, `s_invoice`, `s_expiration`, `s_prod_id`, `s_stock_in_qty`, `s_amount`, `s_supplierPrice`, `s_spl_id`, `s_edited`, `s_status`) VALUES
(444, '2024-02-22', 'INV0001', '0000-00-00', 257, 500, 0, 72.00, 42, NULL, 1),
(445, '2024-02-22', 'INV0001', '0000-00-00', 258, 500, 458, 160.00, 42, NULL, 1),
(446, '2024-02-22', 'INV0001', '0000-00-00', 257, 500, 471, 80.00, 42, NULL, 0),
(447, '2024-02-22', 'INV0001', '0000-00-00', 259, 500, 501, 31.50, 42, NULL, 1),
(448, '2024-02-22', 'INV0001', '0000-00-00', 259, 500, 489, 31.50, 42, NULL, 1),
(449, '2024-02-22', 'INV0001', '0000-00-00', 259, 500, 491, 31.50, 42, NULL, 1),
(450, '2024-02-22', 'INV002', '0000-00-00', 261, 500, 450, 540.00, 42, NULL, 1),
(451, '2024-02-22', 'INV002', '0000-00-00', 262, 500, 426, 240.00, 42, NULL, 1),
(452, '2024-02-22', 'INV002', '0000-00-00', 265, 500, 479, 90.00, 42, NULL, 1),
(453, '2024-02-22', 'INV002', '0000-00-00', 265, 500, 499, 90.00, 42, NULL, 0),
(454, '2024-02-22', 'INV002', '0000-00-00', 266, 500, 472, 54.00, 42, NULL, 1),
(455, '2024-02-22', 'inv003', '0000-00-00', 267, 500, 395, 22.50, 42, NULL, 1),
(456, '2024-02-22', 'INV0001', '0000-00-00', 269, 20, 9, 11.00, 42, NULL, 1),
(457, '2024-02-22', 'INV0001', '0000-00-00', 273, 500, 470, 36.00, 42, NULL, 1),
(458, '2024-02-22', 'INV0001', '0000-00-00', 274, 500, 481, 90.00, 42, NULL, 1),
(459, '2024-02-22', 'INV0001', '0000-00-00', 276, 500, 475, 882.00, 42, NULL, 1),
(460, '2024-02-22', 'INV0001', '0000-00-00', 277, 500, 434, 90.00, 42, NULL, 1),
(461, '2024-02-22', 'INV0001', '0000-00-00', 269, 20, 15, 11.00, 42, NULL, 1),
(462, '2024-02-22', 'INV0001', '0000-00-00', 271, 500, 513, 90.00, 42, NULL, 1),
(463, '2024-02-22', 'INV0001', '0000-00-00', 259, 10, 10, 20.00, 42, NULL, 1),
(464, '2024-02-22', 'INV0001', '0000-00-00', 259, 20, 20, 50.00, 42, NULL, 1),
(465, '2024-02-29', 'INV0001', '0000-00-00', 266, 5, 5, 10.00, 42, NULL, 1),
(466, '2024-02-22', 'INV0001', '0000-00-00', 268, 10, 0, 2.00, 42, NULL, 1),
(467, '2024-02-22', 'INV0001', '0000-00-00', 266, 20, 20, 20.00, 42, NULL, 1),
(468, '2024-02-29', 'INV23333', '0000-00-00', 257, 5, 0, 50.00, 43, NULL, 1),
(469, '2024-03-06', 'INV0001', '2025-01-16', 280, 5, 0, 10.00, 42, NULL, 0),
(470, '2024-09-18', 'INV0006', '2025-06-26', 292, 100, 99, 50.00, 42, NULL, 1),
(471, '2024-09-19', 'INV00056', '2025-06-19', 293, 100, 88, 80.00, 42, NULL, 1),
(472, '2024-09-19', 'INV045465-24', '2026-09-19', 294, 150, 95, 80.00, 39, NULL, 1),
(473, '2024-09-19', 'INV056565', '2026-06-08', 280, 100, 78, 10.00, 44, NULL, 0),
(474, '2024-09-23', 'INV0046', '2028-10-23', 280, 100, 100, 10.00, 39, NULL, 1),
(475, '2024-09-24', 'INV0046', '0000-00-00', 288, 10, 1, 5.00, 39, NULL, 1),
(476, '2024-09-24', 'INV0046', '2025-12-12', 280, 99, 64, 10.00, 39, NULL, 1),
(477, '2024-10-06', 'INV12345', '0000-00-00', 259, 100, 100, 30.00, 39, NULL, 1),
(478, '2024-10-08', 'INV23333', '0000-00-00', 306, 20, 20, 130.90, 43, NULL, 1),
(479, '2024-10-08', 'INV23333', '0000-00-00', 299, 17, 16, 1715.00, 43, NULL, 1),
(480, '2024-10-08', 'INV23333', '0000-00-00', 308, 25, 25, 405.00, 43, NULL, 1),
(481, '2024-10-08', 'INV23333', '0000-00-00', 277, 20, 20, 90.00, 43, NULL, 1),
(482, '2024-10-08', 'INV00058', '2028-05-12', 316, 17, 16, 162.00, 43, NULL, 1),
(483, '2024-10-08', 'INV00058', '0000-00-00', 260, 20, 17, 310.00, 43, NULL, 1),
(484, '2024-10-08', 'INV00058', '0000-00-00', 257, 100, 0, 70.00, 43, NULL, 1),
(485, '2024-10-08', 'INV00058', '2021-11-11', 318, 100, 100, 450.00, 43, NULL, 1),
(486, '2024-10-08', 'INV00058', '2026-10-03', 317, 100, 100, 5.00, 43, NULL, 0),
(487, '2024-10-08', 'INV00058', '2030-06-08', 317, 99, 99, 5.00, 43, NULL, 0),
(488, '2024-10-08', 'INV00058', '2026-05-08', 317, 55, 55, 5.00, 43, NULL, 0),
(489, '2024-10-08', 'INV00058', '2028-02-08', 317, 51, 51, 5.00, 43, NULL, 1),
(490, '2024-10-10', 'INV00058', '0000-00-00', 313, 23, 20, 1430.00, 43, NULL, 1),
(491, '2024-10-10', 'INV00059', '0000-00-00', 307, 20, 20, 225.00, 43, NULL, 1),
(492, '2024-10-10', 'INV00059', '0000-00-00', 305, 20, 20, 36.00, 43, NULL, 1),
(493, '2024-10-10', 'INV05246', '2026-09-25', 314, 5, 5, 50.00, 40, NULL, 0),
(494, '2024-10-10', 'INV05246', '2025-10-17', 289, 50, 50, 300.00, 40, NULL, 0),
(495, '2024-10-10', 'INV05246', '2025-10-10', 289, 5, 6, 300.00, 40, NULL, 1),
(496, '2024-10-10', 'INV05246', '0000-00-00', 275, 99, 96, 200.00, 40, NULL, 1),
(497, '2024-10-10', 'INV05246', '2026-05-30', 295, 100, 100, 40.00, 40, NULL, 1),
(498, '2024-10-10', 'INV00059', '0000-00-00', 315, 21, 21, 1520.00, 43, NULL, 1),
(499, '2024-10-10', 'INV00059', '0000-00-00', 279, 23, 22, 475.00, 43, NULL, 1),
(500, '2024-10-10', 'INV00059', '2026-05-14', 300, 24, 24, 214.00, 43, NULL, 1),
(501, '2024-10-10', 'INV00059', '0000-00-00', 284, 23, 21, 3090.00, 43, NULL, 1),
(502, '2024-10-10', 'INV00059', '0000-00-00', 283, 25, 24, 90.00, 43, NULL, 1),
(503, '2024-10-10', 'INV00059', '0000-00-00', 277, 20, 20, 90.00, 43, NULL, 1),
(504, '2024-10-10', 'INV00059', '0000-00-00', 312, 21, 25, 39.60, 43, NULL, 1),
(505, '2024-10-10', 'INV00059', '0000-00-00', 304, 28, 29, 27.00, 43, NULL, 1),
(506, '2024-10-10', 'INV00059', '0000-00-00', 286, 21, 19, 33.30, 43, NULL, 1),
(507, '2024-10-10', 'INV00059', '0000-00-00', 287, 23, 22, 1405.00, 43, NULL, 1),
(508, '2024-10-10', 'INV00059', '0000-00-00', 268, 25, 21, 61.00, 43, NULL, 1),
(509, '2024-10-10', 'INV00059', '0000-00-00', 266, 1, 1, 50.00, 43, NULL, 1),
(510, '2024-10-10', 'INV00059', '0000-00-00', 276, 10, 10, 400.00, 43, NULL, 1),
(511, '2024-10-10', 'INV00059', '2025-10-10', 295, 3, 7, 40.00, 43, NULL, 1),
(512, '2024-10-10', 'INV00059', '2026-09-12', 314, 21, 25, 54.00, 43, NULL, 1),
(513, '2024-10-10', 'INV00059', '2028-07-17', 302, 24, 29, 90.00, 43, NULL, 1),
(514, '2024-10-10', 'INV00059', '0000-00-00', 262, 2, 0, 260.00, 43, NULL, 1),
(515, '2024-10-10', 'INV00059', '0000-00-00', 298, 21, 21, 1950.00, 43, NULL, 1),
(516, '2024-10-10', 'INV00059', '0000-00-00', 272, 21, 15, 90.00, 43, NULL, 1),
(517, '2024-10-10', 'INV00059', '0000-00-00', 309, 21, 21, 450.00, 43, NULL, 1),
(518, '2024-10-10', 'INV00059', '2028-08-14', 297, 25, 23, 67.50, 43, NULL, 1),
(519, '2024-10-10', 'INV00059', '2027-10-15', 296, 21, 25, 40.00, 43, NULL, 1),
(520, '2024-10-10', 'INV00059', '0000-00-00', 261, 23, 23, 540.00, 43, NULL, 0),
(521, '2024-10-10', 'INV00059', '0000-00-00', 261, 21, 27, 540.00, 43, NULL, 1),
(522, '2024-10-10', 'INV00059', '0000-00-00', 270, 25, 23, 1115.00, 43, NULL, 1),
(523, '2024-10-10', 'INV00058', '2028-10-10', 318, 80, 68, 450.00, 43, NULL, 1),
(524, '2024-10-10', 'INV00060', '2027-12-20', 319, 20, 20, 19.80, 43, NULL, 1),
(525, '2024-10-10', 'INV00060', '0000-00-00', 320, 25, 22, 194.50, 43, NULL, 1),
(526, '2024-10-10', 'INV00060', '2028-10-21', 321, 20, 15, 24.30, 43, NULL, 1),
(527, '2024-10-10', 'INV00060', '2029-06-20', 324, 23, 21, 21.60, 43, NULL, 1),
(528, '2024-10-10', 'INV00060', '2028-06-25', 325, 20, 0, 90.00, 43, NULL, 1),
(529, '2024-10-10', 'INV00060', '2027-04-30', 326, 20, 0, 54.00, 43, NULL, 1),
(530, '2024-10-10', 'INV00059', '0000-00-00', 257, 20, 0, 72.00, 43, NULL, 1),
(531, '2024-10-12', 'INV00059', '2028-07-17', 325, 20, 17, 90.00, 43, NULL, 1),
(532, '2024-10-12', 'INV00059', '2027-05-12', 326, 18, 16, 54.00, 43, NULL, 1),
(533, '2024-10-12', 'INV00059', '0000-00-00', 257, 25, 12, 72.00, 43, NULL, 1),
(534, '2024-10-14', 'INV0156410', '0000-00-00', 288, 999, 994, 5.00, 40, NULL, 1);

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
(149, 469, 'SU5067142', 'INV0001', '2024-03-06', 'PROD35580', '2025-01-16', 5, 10, NULL),
(150, 470, 'SU5067142', 'INV0006', '2024-09-18', 'PROD87196', '2025-06-26', 100, 50, NULL),
(151, 471, 'SU5067142', 'INV00056', '2024-09-19', 'PROD3451', '2025-06-19', 100, 80, NULL),
(152, 472, 'SU4896939', 'INV045465-24', '2024-09-19', 'PROD14294', '2026-09-19', 150, 80, NULL),
(153, 473, 'SU9320244', 'INV056565', '2024-09-19', 'PROD35580', '2026-06-08', 100, 10, NULL),
(154, 474, 'SU4896939', 'INV0046', '2024-09-23', 'PROD35580', '2028-10-23', 100, 10, NULL),
(155, 475, 'SU4896939', 'INV0046', '2024-09-24', 'PROD5805', '0000-00-00', 10, 5, NULL),
(156, 476, 'SU4896939', 'INV0046', '2024-09-24', 'PROD35580', '2025-12-12', 99, 10, NULL),
(157, 477, 'SU4896939', 'INV12345', '2024-10-06', 'PROD21129', '0000-00-00', 100, 30, NULL),
(158, 478, 'SU7265643', 'INV23333', '2024-10-08', 'PROD30973', '0000-00-00', 20, 130.9, NULL),
(159, 479, 'SU7265643', 'INV23333', '2024-10-08', 'PROD87456', '0000-00-00', 17, 1715, NULL),
(160, 480, 'SU7265643', 'INV23333', '2024-10-08', 'PROD18607', '0000-00-00', 25, 405, NULL),
(161, 481, 'SU7265643', 'INV23333', '2024-10-08', 'PROD30333', '0000-00-00', 20, 90, NULL),
(162, 482, 'SU7265643', 'INV00058', '2024-10-08', 'PROD99235', '2028-05-12', 17, 162, NULL),
(163, 483, 'SU7265643', 'INV00058', '2024-10-08', 'PROD48973', '0000-00-00', 20, 310, NULL),
(164, 484, 'SU7265643', 'INV00058', '2024-10-08', 'PROD84296', '0000-00-00', 100, 70, NULL),
(165, 485, 'SU7265643', 'INV00058', '2024-10-08', 'PROD26909', '2027-11-11', 100, 450, NULL),
(166, 486, 'SU7265643', 'INV00058', '2024-10-08', 'PROD11766', '2026-10-03', 100, 5, NULL),
(167, 487, 'SU7265643', 'INV00058', '2024-10-08', 'PROD11766', '2030-06-08', 99, 5, NULL),
(168, 488, 'SU7265643', 'INV00058', '2024-10-08', 'PROD11766', '2026-05-08', 55, 5, NULL),
(169, 489, 'SU7265643', 'INV00058', '2024-10-08', 'PROD11766', '2028-02-08', 51, 5, NULL),
(170, 490, 'SU7265643', 'INV00058', '2024-10-10', 'PROD75249', '0000-00-00', 23, 1430, NULL),
(171, 491, 'SU7265643', 'INV00059', '2024-10-10', 'PROD28621', '0000-00-00', 20, 225, NULL),
(172, 492, 'SU7265643', 'INV00059', '2024-10-10', 'PROD18276', '0000-00-00', 20, 36, NULL),
(173, 493, 'SU4004040', 'INV05246', '2024-10-10', 'PROD86607', '2026-09-25', 5, 50, NULL),
(174, 494, 'SU4004040', 'INV05246', '2024-10-10', 'PROD18871', '2025-10-17', 50, 300, NULL),
(175, 495, 'SU4004040', 'INV05246', '2024-10-10', 'PROD18871', '2025-10-10', 7, 300, NULL),
(176, 496, 'SU4004040', 'INV05246', '2024-10-10', 'PROD40561', '0000-00-00', 99, 200, NULL),
(177, 497, 'SU4004040', 'INV05246', '2024-10-10', 'PROD82332', '2026-05-30', 100, 40, NULL),
(178, 498, 'SU7265643', 'INV00059', '2024-10-10', 'PROD76174', '0000-00-00', 21, 1520, NULL),
(179, 499, 'SU7265643', 'INV00059', '2024-10-10', 'PROD22904', '0000-00-00', 23, 475, NULL),
(180, 500, 'SU7265643', 'INV00059', '2024-10-10', 'PROD84660', '2026-05-14', 24, 214, NULL),
(181, 501, 'SU7265643', 'INV00059', '2024-10-10', 'PROD36803', '0000-00-00', 23, 3090, NULL),
(182, 502, 'SU7265643', 'INV00059', '2024-10-10', 'PROD80158', '0000-00-00', 25, 90, NULL),
(183, 503, 'SU7265643', 'INV00059', '2024-10-10', 'PROD30333', '0000-00-00', 20, 90, NULL),
(184, 504, 'SU7265643', 'INV00059', '2024-10-10', 'PROD11924', '0000-00-00', 25, 39.6, NULL),
(185, 505, 'SU7265643', 'INV00059', '2024-10-10', 'PROD5606', '0000-00-00', 30, 27, NULL),
(186, 506, 'SU7265643', 'INV00059', '2024-10-10', 'PROD61019', '0000-00-00', 21, 33.3, NULL),
(187, 507, 'SU7265643', 'INV00059', '2024-10-10', 'PROD92019', '0000-00-00', 23, 1405, NULL),
(188, 508, 'SU7265643', 'INV00059', '2024-10-10', 'PROD80192', '0000-00-00', 25, 61, NULL),
(189, 509, 'SU7265643', 'INV00059', '2024-10-10', 'PROD65507', '0000-00-00', 1, 50, NULL),
(190, 510, 'SU7265643', 'INV00059', '2024-10-10', 'PROD11219', '0000-00-00', 10, 400, NULL),
(191, 511, 'SU7265643', 'INV00059', '2024-10-10', 'PROD82332', '2025-10-10', 7, 40, NULL),
(192, 512, 'SU7265643', 'INV00059', '2024-10-10', 'PROD86607', '2026-09-12', 25, 54, NULL),
(193, 513, 'SU7265643', 'INV00059', '2024-10-10', 'PROD84225', '2028-07-17', 30, 90, NULL),
(194, 514, 'SU7265643', 'INV00059', '2024-10-10', 'PROD33772', '0000-00-00', 2, 260, NULL),
(195, 515, 'SU7265643', 'INV00059', '2024-10-10', 'PROD29288', '0000-00-00', 21, 1950, NULL),
(196, 516, 'SU7265643', 'INV00059', '2024-10-10', 'PROD77746', '0000-00-00', 21, 90, NULL),
(197, 517, 'SU7265643', 'INV00059', '2024-10-10', 'PROD86937', '0000-00-00', 21, 450, NULL),
(198, 518, 'SU7265643', 'INV00059', '2024-10-10', 'PROD55248', '2028-08-14', 25, 67.5, NULL),
(199, 519, 'SU7265643', 'INV00059', '2024-10-10', 'PROD98520', '2027-10-15', 28, 40, NULL),
(200, 520, 'SU7265643', 'INV00059', '2024-10-10', 'PROD15868', '0000-00-00', 23, 540, NULL),
(201, 521, 'SU7265643', 'INV00059', '2024-10-10', 'PROD15868', '0000-00-00', 27, 540, NULL),
(202, 522, 'SU7265643', 'INV00059', '2024-10-10', 'PROD21243', '0000-00-00', 25, 1115, NULL),
(203, 523, 'SU7265643', 'INV00058', '2024-10-10', 'PROD26909', '2028-10-10', 80, 450, NULL),
(204, 524, 'SU7265643', 'INV00060', '2024-10-10', 'PROD26196', '2027-12-20', 20, 19.8, NULL),
(205, 525, 'SU7265643', 'INV00060', '2024-10-10', 'PROD13254', '0000-00-00', 25, 194.5, NULL),
(206, 526, 'SU7265643', 'INV00060', '2024-10-10', 'PROD41571', '2028-10-21', 20, 24.3, NULL),
(207, 527, 'SU7265643', 'INV00060', '2024-10-10', 'PROD95733', '2029-06-20', 23, 21.6, NULL),
(208, 528, 'SU7265643', 'INV00060', '2024-10-10', 'PROD99203', '2028-06-25', 20, 90, NULL),
(209, 529, 'SU7265643', 'INV00060', '2024-10-10', 'PROD94210', '2027-04-30', 20, 54, NULL),
(210, 530, 'SU7265643', 'INV00059', '2024-10-10', 'PROD84296', '0000-00-00', 20, 72, NULL),
(211, 531, 'SU7265643', 'INV00059', '2024-10-12', 'PROD99203', '2028-07-17', 20, 90, NULL),
(212, 532, 'SU7265643', 'INV00059', '2024-10-12', 'PROD94210', '2027-05-12', 18, 54, NULL),
(213, 533, 'SU7265643', 'INV00059', '2024-10-12', 'PROD84296', '0000-00-00', 25, 72, NULL),
(214, 534, 'SU4004040', 'INV0156410', '2024-10-14', 'PROD5805', '0000-00-00', 999, 5, NULL);

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
(44, 'SU9320244', 'Jv Magtalas', 'jvmagtalas043@gmail.com', '09123456781', '9e callejon tinajeros malabon', '2024-03-07 06:42:27', '', 1);

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
  `address_display_status` int(11) NOT NULL,
  `address_rider` int(11) NOT NULL,
  `cutoff` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_address`
--

INSERT INTO `tbl_address` (`address_id`, `address_code`, `muni_code`, `prov_code`, `reg_code`, `address_complete_name`, `address_rate`, `address_status`, `address_cod`, `address_paynow`, `address_date_added`, `address_date_edited`, `address_display_status`, `address_rider`, `cutoff`) VALUES
(69, '031411006', '031411', '0314', '03', 'Region III (Central Luzon) Bulacan Marilao Loma de Gato', 10, 1, 1, 1, '2024-02-22 08:51:20', '2024-02-23 11:37:23', 0, 250, NULL),
(70, '031404011', '031404', '0314', '03', 'Region III (Central Luzon) Bulacan Bocaue Duhat', 60, 1, 1, 1, '2024-02-22 13:17:35', '2024-09-25 03:57:11', 1, 250, NULL),
(71, '031411011', '031411', '0314', '03', 'Region III (Central Luzon) Bulacan Marilao Prenza I', 130, 1, 1, 1, '2024-02-23 04:12:10', '2024-09-25 03:53:16', 1, 250, NULL),
(72, '031411001', '031411', '0314', '03', 'Region III (Central Luzon) Bulacan Marilao Abangan Norte', 50, 1, 1, 1, '2024-02-28 15:33:31', NULL, 0, 250, NULL),
(73, '031411014', '031411', '0314', '03', 'Region III (Central Luzon) Bulacan Marilao Santa Rosa II', 100, 1, 1, 1, '2024-02-29 02:10:21', NULL, 0, 250, NULL),
(74, '031412003', '031412', '0314', '03', 'Region III (Central Luzon) Bulacan City Of Meycauayan Bancal', 50, 1, 1, 1, '2024-03-06 13:41:20', NULL, 0, 250, NULL),
(76, '031411008', '031411', '0314', '03', 'Region III (Central Luzon) Bulacan Marilao Patubig', 140, 1, 1, 1, '2024-09-23 08:23:37', '2024-09-25 03:53:36', 1, 250, NULL),
(77, '031423001', '031423', '0314', '03', 'Region III (Central Luzon) Bulacan Santa Maria Bagbaguin', 50, 1, 1, 1, '2024-09-24 19:56:40', NULL, 1, 250, NULL),
(78, '012802007', '012802', '0128', '01', 'Region I (Ilocos Region) Ilocos Norte Bacarra Calioet-Libong', 50, 1, 1, 1, '2024-10-13 11:23:12', NULL, 0, 250, NULL);

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
(17, 'Sack', 'a large bag made of a strong material such as burlap, thick paper, or plastic, used for storing and carrying goods.', 2, '', '2023-10-16 21:48:30'),
(24, 'sach', 'a small bag containing a perfumed powder or potpourri used to scent clothes and linens. sacheted.', 2, '', ''),
(25, 'tab', 'A tablet (also known as a pill) is a pharmaceutical oral dosage form (oral solid dosage, or OSD) or solid unit dosage form. Tablets may be defined as the solid unit dosage form of medication with suitable excipients.', 2, '', ''),
(26, 'CAPS', 'Catastrophic antiphospholipid syndrome (CAPS) is a rare life-threatening autoimmune disease characterized by disseminated intravascular thrombosis resulting in multi-organ failure.', 2, '', ''),
(27, 'vial', 'A vial also known as a phial or flacon is a small glass or plastic vessel or bottle, often used to store medication in the form of liquids, powders, or capsules. They can also be used as scientific sample vessels for instance, in autosampler devices in', 2, '', '2023-10-19 12:29:56'),
(30, 'kg', 'basta kilogram', 2, '', '2023-11-24 00:26:44'),
(31, 'pcs', 'A vial (also known as a phial or flacon) is a small glass or plastic vessel or bottle, often used to store medication in the form of liquids, powders, or capsules. They can also be used as scientific sample vessels; for instance, in autosampler devices in', 2, '', ''),
(63, '10 Kg', 'specific for 10 kilogramsss', 2, '2023-10-20 11:13:58', '2024-09-23 01:12:31'),
(64, 'pcs', 'for unit product', 2, '2023-11-06 22:29:26', '2023-11-06 22:30:35'),
(65, '5 kg', '5 kilogram', 2, '2023-11-12 01:27:55', NULL),
(66, 'tests', 'asdasd', 2, '2023-11-19 21:56:29', NULL),
(67, '5kg', 'only for 5 kilogram', 2, '2024-09-23 16:26:48', NULL),
(68, 'Kg', 'No', 2, '2024-10-06 20:03:08', NULL),
(69, 'kg', 'kilogram', 1, '2024-10-10 21:35:25', NULL),
(70, 'pcs', '', 1, '2024-10-10 21:35:33', NULL),
(71, 'pack ', '', 1, '2024-10-10 21:58:31', NULL),
(72, 'btl', 'Bottle', 1, '2024-10-10 21:59:23', '2024-10-10 22:00:48'),
(73, 'sach', '', 1, '2024-10-10 21:59:53', '2024-10-10 22:00:58'),
(74, 'tab', 'tablet', 1, '2024-10-10 22:00:13', NULL),
(75, 'vial', '', 1, '2024-10-10 22:00:38', NULL);

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

--
-- Dumping data for table `users_log`
--

INSERT INTO `users_log` (`act_id`, `act_account_id`, `act_activity`, `act_date`, `act_table`, `act_collumn_id`, `act_seen`) VALUES
(4000, 16, 'Disabled product: `Combinex `', '2024-10-01 18:55:33', 'product', 'PROD18871', 1),
(4001, 16, 'Enabled product: `Combinex `', '2024-10-01 18:55:43', 'product', 'PROD18871', 1),
(4006, 311, 'Created their account: John Doe', '2024-10-01 23:48:48', 'account', '311', 1),
(4007, 301, 'Gave 5 Stars and commented on Bayong Big: Good Quality', '2024-10-01 23:56:20', 'Feedback', '257', 1),
(4008, 311, 'Gave 5 Stars and commented on Bayong Big: Maganda yung item tamang tama para sa mga gulay na napamalengke ko', '2024-10-02 00:03:24', 'Feedback', '257', 1),
(4017, 301, 'Gave 5 Stars and commented on Cat Litter 5kg: Good Packaging', '2024-10-02 01:02:13', 'Feedback', '258', 1),
(4018, 301, 'Gave 4 Stars and commented on Dog Bag: Good Packaging and Good Quality', '2024-10-02 01:07:03', 'Feedback', '261', 1),
(4019, 301, 'Gave 3 Stars and commented on Hair Brush: cute brush', '2024-10-02 01:16:59', 'Feedback', '266', 1),
(4020, 301, 'Gave 5 Stars and commented on Dog Collar Large: nice collar', '2024-10-02 01:17:13', 'Feedback', '265', 1),
(4021, 301, 'Gave 5 Stars and commented on Dog Cage: Good for it\'s price , so easy to assemble.', '2024-10-02 01:18:13', 'Feedback', '262', 1),
(4022, 301, 'Gave 3 Stars on 265', '2024-10-02 01:18:31', 'Feedback', '265', 1),
(4023, 301, 'Gave 3 Stars and commented on Dog Collar Large: nice', '2024-10-02 01:19:21', 'Feedback', '265', 1),
(4024, 301, 'Gave 2 Stars and commented on Hair Brush: test', '2024-10-02 01:21:05', 'Feedback', '266', 1),
(4025, 312, 'Created their account: Juliana Ira Padrigon', '2024-10-02 22:31:46', 'account', '312', 1),
(4026, 313, 'Created their account: Zyrine Alcarez', '2024-10-03 14:11:33', 'account', '313', 1),
(4027, 314, 'Created their account: Freddie Mark Santiago', '2024-10-03 14:14:25', 'account', '314', 1),
(4028, 16, 'Created new category named: category 1', '2024-10-03 14:30:38', 'category', NULL, 1),
(4029, 16, 'Remove category: category 1', '2024-10-03 14:31:50', 'category', '32', 1),
(4030, 313, 'Their account successfully recovered', '2024-10-03 14:37:30', 'account', '313', 1),
(4031, 313, 'RECOVER ACCOUNT', '2024-10-03 02:38:00', '', NULL, 1),
(4032, 315, 'Created their account: Leonel Rapsing', '2024-10-03 23:20:39', 'account', '315', 1),
(4033, 16, 'Add new unit named: Kg', '2024-10-06 20:03:08', 'unit', NULL, 1),
(4034, 313, 'Their account successfully recovered', '2024-10-06 20:20:07', 'account', '313', 1),
(4035, 313, 'RECOVER ACCOUNT', '2024-10-06 08:20:00', '', NULL, 1),
(4036, 16, 'Update Zyrine Alcarez`s information', '2024-10-07 06:59:05', 'account', '227', 1),
(4037, 16, 'Update Joshua Anderson Padilla`s information', '2024-10-07 07:00:45', 'account', '236', 1),
(4038, 16, 'Update Julliana Padrigon`s information', '2024-10-07 07:00:53', 'account', '240', 1),
(4039, 16, 'Update Zyrine Alcarez`s information', '2024-10-07 07:01:04', 'account', '277', 1),
(4040, 16, 'Update Joshua Anderson Padilla`s information', '2024-10-07 07:01:15', 'account', '278', 1),
(4041, 16, 'Update Fyke Loterena`s information', '2024-10-07 07:02:20', 'account', '250', 1),
(4042, 16, 'Added new product: Vitmin Pro', '2024-10-07 07:18:37', 'product', 'PROD55248', 1),
(4043, 16, 'Remove unit: Kg', '2024-10-07 07:23:59', 'unit', '68', 1),
(4044, 16, 'Disabled unit: pcs', '2024-10-07 07:27:33', 'unit', '64', 1),
(4045, 16, 'Remove unit: 5kg', '2024-10-07 07:42:27', 'unit', '67', 1),
(4046, 16, 'Remove unit: pcs', '2024-10-07 07:42:32', 'unit', '64', 1),
(4047, 16, 'Remove unit: 10 Kg', '2024-10-07 07:42:36', 'unit', '63', 1),
(4048, 16, 'Remove unit: kg', '2024-10-07 07:42:39', 'unit', '30', 1),
(4049, 16, 'Remove unit: vial', '2024-10-07 07:42:42', 'unit', '27', 1),
(4050, 16, 'Remove unit: CAPS', '2024-10-07 07:42:45', 'unit', '26', 1),
(4051, 16, 'Remove unit: tab', '2024-10-07 07:42:48', 'unit', '25', 1),
(4052, 16, 'Remove unit: sach', '2024-10-07 07:42:51', 'unit', '24', 1),
(4053, 16, 'Remove unit: Sack', '2024-10-07 07:42:55', 'unit', '17', 1),
(4054, 16, 'Added new product: Zoi Cat', '2024-10-07 16:10:32', 'product', 'PROD29288', 1),
(4055, 16, 'Added new product: Top Breed Puppy', '2024-10-07 16:16:36', 'product', 'PROD87456', 1),
(4056, 16, 'Added new product: Belamyl 10ml ', '2024-10-07 16:20:18', 'product', 'PROD84660', 1),
(4057, 16, 'Added new product:  Vitminpro', '2024-10-07 16:22:50', 'product', 'PROD47976', 1),
(4058, 16, 'Added new product:  Salmon and Liver', '2024-10-07 16:28:50', 'product', 'PROD84225', 1),
(4059, 16, 'Added new product:  Beef Teriyaki', '2024-10-07 16:40:54', 'product', 'PROD25237', 1),
(4060, 16, 'Remove product:  Beef Teriyaki', '2024-10-07 16:41:25', 'product', 'PROD25237', 1),
(4061, 16, 'Added new product: Duck Layer', '2024-10-07 16:44:32', 'product', 'PROD5606', 1),
(4062, 16, 'Added new product: Chick Booster', '2024-10-07 16:46:14', 'product', 'PROD18276', 1),
(4063, 16, 'Added new product: Water pot for chicken1L', '2024-10-07 16:55:44', 'product', 'PROD30973', 1),
(4064, 16, 'Added new product: Water pot for chicken3L', '2024-10-07 16:57:13', 'product', 'PROD28621', 1),
(4065, 16, 'Added new product: Water pot for chicken6L', '2024-10-07 16:58:42', 'product', 'PROD18607', 1),
(4066, 16, 'Added new product: Wooden Bird box small', '2024-10-07 17:01:03', 'product', 'PROD86937', 1),
(4067, 16, 'Added new product: Wood Flakes', '2024-10-07 17:05:39', 'product', 'PROD23017', 1),
(4068, 16, 'Added new product: Toothbrush', '2024-10-07 17:14:07', 'product', 'PROD56482', 1),
(4069, 16, 'Added new product: Stag d crumble ', '2024-10-07 17:18:55', 'product', 'PROD11924', 1),
(4070, 16, 'Added new product: Top Breed Adult', '2024-10-07 17:21:20', 'product', 'PROD75249', 1),
(4071, 16, 'Added new product: Vitakraf sauce for cat ', '2024-10-07 17:23:12', 'product', 'PROD86607', 1),
(4072, 16, 'Added new product: BowWow Adult', '2024-10-07 17:27:24', 'product', 'PROD76174', 1),
(4073, 16, 'Added new product: Dextrose Powder', '2024-10-07 17:30:27', 'product', 'PROD99235', 1),
(4074, 16, 'Added new product: PAKYAW Tablet', '2024-10-07 17:32:23', 'product', 'PROD11766', 1),
(4075, 16, 'Added new product: Ivermectin', '2024-10-07 17:38:30', 'product', 'PROD26909', 1),
(4076, 16, 'Remove product:  Vitminpro', '2024-10-08 08:03:27', 'product', 'PROD47976', 1),
(4077, 16, 'Remove product: Toothbrush', '2024-10-08 08:11:37', 'product', 'PROD56482', 1),
(4078, 16, 'Update GCASH` e-wallet image', '2024-10-08 11:57:49', 'product', '57', 1),
(4079, 16, 'Update MAYA` e-wallet image', '2024-10-08 11:58:28', 'product', '58', 1),
(4080, 16, 'Remove product: Dextrose Powder ', '2024-10-10 17:17:40', 'product', 'PROD18291', 1),
(4081, 16, 'Add new unit named: kg', '2024-10-10 21:35:25', 'unit', NULL, 1),
(4082, 16, 'Add new unit named: pcs', '2024-10-10 21:35:33', 'unit', NULL, 1),
(4083, 16, 'Remove product: Wood Flakes', '2024-10-10 21:42:08', 'product', 'PROD23017', 1),
(4084, 16, 'Remove product: Dog Bag', '2024-10-10 21:44:47', 'product', 'PROD54484', 1),
(4085, 16, 'Add new unit named: pack ', '2024-10-10 21:58:31', 'unit', NULL, 1),
(4086, 16, 'Add new unit named: Btl', '2024-10-10 21:59:23', 'unit', NULL, 1),
(4087, 16, 'Add new unit named: Sach', '2024-10-10 21:59:53', 'unit', NULL, 1),
(4088, 16, 'Add new unit named: tab', '2024-10-10 22:00:13', 'unit', NULL, 1),
(4089, 16, 'Add new unit named: vial', '2024-10-10 22:00:38', 'unit', NULL, 1),
(4090, 16, 'update `Btl` changed to `btl`', '2024-10-10 22:00:48', 'unit', '72', 1),
(4091, 16, 'update `Sach` changed to `sach`', '2024-10-10 22:00:58', 'unit', '73', 1),
(4092, 16, 'Added new product: BastoneroPlus', '2024-10-10 22:06:06', 'product', 'PROD26196', 1),
(4093, 16, 'Added new product: Wash out intense', '2024-10-10 22:11:29', 'product', 'PROD13254', 1),
(4094, 16, 'Added new product: Apralyte', '2024-10-10 22:15:00', 'product', 'PROD41571', 1),
(4095, 16, 'Added new product: Belamyl 50ml', '2024-10-10 22:17:17', 'product', 'PROD51966', 1),
(4096, 16, 'Added new product: Belamyl 100ml', '2024-10-10 22:21:46', 'product', 'PROD24860', 1),
(4097, 16, 'Added new product: Ambroxitil', '2024-10-10 22:24:40', 'product', 'PROD95733', 1),
(4098, 16, 'Remove product: Belamyl 100ml', '2024-10-10 22:26:17', 'product', 'PROD24860', 1),
(4099, 16, 'Remove product: Belamyl 50ml', '2024-10-10 22:26:24', 'product', 'PROD51966', 1),
(4100, 16, 'Added new product: NutriVit Plus 12x120ml', '2024-10-10 22:35:10', 'product', 'PROD99203', 1),
(4101, 16, 'Added new product: Multivit B12 Caps', '2024-10-10 22:39:52', 'product', 'PROD94210', 1),
(4105, 16, 'Remove product: Wooden Bird box small', '2024-10-10 23:11:28', 'product', 'PROD86937', 1),
(4106, 16, 'Remove product: Water pot for chicken1L', '2024-10-10 23:12:31', 'product', 'PROD30973', 1),
(4107, 16, 'Remove product: Water pot for chicken6L', '2024-10-10 23:12:40', 'product', 'PROD18607', 1),
(4108, 16, 'Remove product: Chick Booster', '2024-10-10 23:12:43', 'product', 'PROD18276', 1),
(4109, 16, 'Remove product: Water pot for chicken3L', '2024-10-10 23:12:52', 'product', 'PROD28621', 1),
(4111, 320, 'Created their account: Joshua Anderson Padilla', '2024-10-12 22:36:51', 'account', '320', 1),
(4112, 320, 'Gave 4 Stars and commented on Bayong Big: Ang ganda ng quality at ang bilis pa nadeliver ni rider', '2024-10-12 22:50:22', 'Feedback', '257', 1),
(4113, 320, 'Gave 5 Stars and commented on Dog Bag: ganda ng color pink', '2024-10-12 22:50:54', 'Feedback', '261', 1),
(4114, 16, 'Updated Freddie mark Santiago`s Profile picture', '2024-10-12 23:17:41', 'account', '16', 1),
(4115, 16, 'Update Fyke Loterena`s information', '2024-10-12 23:19:42', 'account', '250', 1),
(4116, 292, 'Gave 4 Stars and commented on Hushpet Diaper: 👍👍👍', '2024-10-13 00:05:36', 'Feedback', '267', 1),
(4117, 292, 'Gave 5 Stars and commented on Chicken Cage: 🥰🥰🥰🥰', '2024-10-13 00:05:49', 'Feedback', '260', 1),
(4118, 16, 'Disabled: christine samson account', '2024-10-13 00:37:08', 'account', '294', 1),
(4119, 16, 'Enabled: christine samson account', '2024-10-13 00:37:12', 'account', '294', 1),
(4120, 16, 'Disabled: christine samson account', '2024-10-13 00:37:22', 'account', '294', 1),
(4121, 292, 'Gave 5 Stars and commented on Dog Bag: 🥰🥰😍😍😍😍', '2024-10-13 17:19:41', 'Feedback', '261', 1),
(4122, 321, 'Created their account: Joshua padilla', '2024-10-13 19:07:23', 'account', '321', 1),
(4123, 16, 'restore new address: Region III (Central Luzon) Bulacan Marilao Santa Rosa II', '2024-10-13 11:22:45', 'address', '031411014', 1),
(4124, 16, 'Remove Region III (Central Luzon) Bulacan Marilao Santa Rosa II', '2024-10-13 11:22:58', 'address', '73', 1),
(4125, 16, 'Added new address: Region I (Ilocos Region) Ilocos Norte Bacarra Calioet-Libong', '2024-10-13 11:23:12', 'address', '012802007', 1),
(4126, 16, 'Remove Region I (Ilocos Region) Ilocos Norte Bacarra Calioet-Libong', '2024-10-13 11:23:21', 'address', '78', 1),
(4127, 16, 'update system name from RDPOS changed to TERDPOS', '2024-10-13 19:24:18', 'maintinance', '1', 1),
(4128, 16, 'update system name from TERDPOS changed to RDPOS', '2024-10-13 19:24:39', 'maintinance', '1', 1),
(4129, 321, 'Gave 4 Stars and commented on Bayong Big: Ganda ng Quality 😍😍😍', '2024-10-13 19:48:21', 'Feedback', '257', 1),
(4130, 321, 'Gave 4 Stars and commented on NutriVit Plus 12x120ml: 😍😍😍', '2024-10-13 19:48:45', 'Feedback', '325', 1),
(4131, 321, 'Gave 3 Stars and commented on Dog Cage: 🤗🤗🤗', '2024-10-13 19:49:06', 'Feedback', '262', 1),
(4132, 292, 'Gave 5 Stars on 288', '2024-10-13 23:38:45', 'Feedback', '288', 1),
(4133, 292, 'Gave 5 Stars on 280', '2024-10-13 23:38:58', 'Feedback', '280', 1),
(4134, 292, 'Gave 5 Stars on 268', '2024-10-13 23:39:08', 'Feedback', '268', 1),
(4135, 292, 'Gave 5 Stars on 269', '2024-10-13 23:39:14', 'Feedback', '269', 1),
(4136, 292, 'Gave 5 Stars on 270', '2024-10-13 23:39:19', 'Feedback', '270', 1),
(4137, 313, 'Gave 5 Stars on 280', '2024-10-13 23:56:29', 'Feedback', '280', 1),
(4138, 313, 'Gave 5 Stars on 259', '2024-10-13 23:56:41', 'Feedback', '259', 1),
(4139, 313, 'Gave 5 Stars on 257', '2024-10-13 23:57:00', 'Feedback', '257', 1),
(4140, 313, 'Gave 5 Stars on 271', '2024-10-13 23:57:04', 'Feedback', '271', 1),
(4141, 301, 'Gave 4 Stars on 280', '2024-10-14 00:03:32', 'Feedback', '280', 1),
(4142, 301, 'Gave 3 Stars on 288', '2024-10-14 00:03:37', 'Feedback', '288', 1),
(4143, 301, 'Gave 4 Stars on 266', '2024-10-14 00:03:40', 'Feedback', '266', 1),
(4144, 301, 'Gave 3 Stars on 321', '2024-10-14 00:03:45', 'Feedback', '321', 1),
(4145, 301, 'Gave 4 Stars on 273', '2024-10-14 00:03:50', 'Feedback', '273', 1),
(4146, 301, 'Gave 4 Stars on 297', '2024-10-14 00:03:56', 'Feedback', '297', 1),
(4147, 314, 'Gave 4 Stars on 324', '2024-10-14 00:45:36', 'Feedback', '324', 1),
(4148, 314, 'Gave 4 Stars on 326', '2024-10-14 00:45:43', 'Feedback', '326', 1),
(4149, 314, 'Gave 5 Stars on 320', '2024-10-14 00:45:51', 'Feedback', '320', 1),
(4150, 314, 'Gave 4 Stars on 272', '2024-10-14 00:45:56', 'Feedback', '272', 1),
(4151, 314, 'Gave 4 Stars and commented on Water Bottle Bird: Cute ng packaging', '2024-10-14 00:46:06', 'Feedback', '274', 1),
(4152, 314, 'Gave 4 Stars on 286', '2024-10-14 00:46:16', 'Feedback', '286', 1),
(4153, 314, 'Gave 5 Stars on 273', '2024-10-14 00:46:21', 'Feedback', '273', 1),
(4154, 314, 'Gave 3 Stars on 257', '2024-10-14 00:46:26', 'Feedback', '257', 1),
(4155, 314, 'Gave 4 Stars on 280', '2024-10-14 00:46:33', 'Feedback', '280', 1),
(4156, 314, 'Gave 3 Stars on 262', '2024-10-14 00:46:55', 'Feedback', '262', 1),
(4157, 314, 'Gave 4 Stars and commented on Chewing Toy Bone  Small: My dogs love it = I love it. Truly indestructible appropriate for my dog that always destroys any toy i give to her. Its also heavy, indicative of the quality material its made of. So heavy enough tha', '2024-10-14 00:47:32', 'Feedback', '259', 1),
(4158, 314, 'Gave 0 Stars on 275', '2024-10-14 00:54:55', 'Feedback', '275', 1),
(4159, 314, 'Gave 2 Stars on 275', '2024-10-14 00:55:59', 'Feedback', '275', 1),
(4160, 314, 'Gave 2 Stars on 268', '2024-10-14 00:56:10', 'Feedback', '268', 1),
(4161, 314, 'Gave 1 Stars on 321', '2024-10-14 00:56:21', 'Feedback', '321', 1),
(4162, 16, 'Remove product: NutriVit Plus 12x', '2024-10-14 01:16:45', 'product', 'PROD99203', 1),
(4163, 16, 'Restore product: NutriVit Plus 12x', '2024-10-14 01:16:54', 'product', 'PROD99203', 1),
(4164, 314, 'Gave 2 Stars on 321', '2024-10-14 01:33:06', 'Feedback', '321', 1),
(4165, 314, 'Gave 4 Stars on 320', '2024-10-14 01:34:35', 'Feedback', '320', 1),
(4166, 314, 'Gave 5 Stars on 257', '2024-10-14 01:35:32', 'Feedback', '257', 1),
(4167, 314, 'Gave 4 Stars on 257', '2024-10-14 01:36:42', 'Feedback', '257', 1),
(4168, 292, 'Gave 4 Stars on 325', '2024-10-14 01:39:06', 'Feedback', '325', 1),
(4169, 292, 'Gave 5 Stars on 269', '2024-10-14 01:39:52', 'Feedback', '269', 1),
(4170, 292, 'Gave 3 Stars on 268', '2024-10-14 01:39:58', 'Feedback', '268', 1),
(4171, 292, 'Gave 5 Stars on 280', '2024-10-14 01:40:13', 'Feedback', '280', 1),
(4172, 292, 'Gave 2 Stars on 269', '2024-10-14 01:42:22', 'Feedback', '269', 1),
(4173, 292, 'Gave 5 Stars on 269', '2024-10-14 01:43:45', 'Feedback', '269', 1),
(4174, 320, 'Gave 5 Stars on 288', '2024-10-14 01:49:55', 'Feedback', '288', 1),
(4175, 320, 'Gave 5 Stars on 266', '2024-10-14 01:49:58', 'Feedback', '266', 1),
(4176, 320, 'Gave 5 Stars on 259', '2024-10-14 01:50:06', 'Feedback', '259', 1),
(4177, 320, 'Gave 5 Stars and commented on Chicken Cage: Ganda ng packaging ng item ko they make sure na hindi mababbasag worth it s price nya pinakagat ko na s mga aso ko and nagustuhan naman nila kaso nag aagawan pa eh tig isa naman na sila hehe thank you seller til', '2024-10-14 01:52:28', 'Feedback', '260', 1),
(4178, 320, 'Gave 3 Stars and commented on Chicken Cage: Ganda ng packaging ng item ko they make sure na hindi mababbasag worth it s price nya pinakagat ko na s mga aso ko and nagustuhan naman nila kaso nag aagawan pa eh tig isa naman na sila hehe thank you seller til', '2024-10-14 01:53:05', 'Feedback', '260', 1),
(4179, 315, 'Gave 4 Stars on 265', '2024-10-14 01:57:12', 'Feedback', '265', 1),
(4180, 315, 'Gave 5 Stars on 280', '2024-10-14 01:57:19', 'Feedback', '280', 1),
(4181, 315, 'Gave 5 Stars on 266', '2024-10-14 02:01:24', 'Feedback', '266', 1),
(4182, 315, 'Gave 5 Stars on 267', '2024-10-14 02:01:28', 'Feedback', '267', 1),
(4183, 315, 'Gave 1 Stars on 257', '2024-10-14 02:01:36', 'Feedback', '257', 1),
(4184, 315, 'Gave 5 Stars on 275', '2024-10-14 02:01:42', 'Feedback', '275', 1),
(4185, 315, 'Gave 5 Stars on 268', '2024-10-14 02:01:46', 'Feedback', '268', 1),
(4186, 315, 'Gave 4 Stars on 302', '2024-10-14 02:01:52', 'Feedback', '302', 1),
(4187, 315, 'Gave 5 Stars on 287', '2024-10-14 02:01:59', 'Feedback', '287', 1),
(4188, 315, 'Gave 4 Stars on 324', '2024-10-14 02:02:06', 'Feedback', '324', 1),
(4189, 315, 'Gave 5 Stars on 325', '2024-10-14 02:02:13', 'Feedback', '325', 1),
(4190, 315, 'Gave 4 Stars on 273', '2024-10-14 02:02:19', 'Feedback', '273', 1),
(4191, 315, 'Gave 5 Stars on 270', '2024-10-14 02:02:26', 'Feedback', '270', 1),
(4192, 315, 'Gave 5 Stars on 288', '2024-10-14 02:02:33', 'Feedback', '288', 1),
(4193, 315, 'Gave 5 Stars on 257', '2024-10-14 02:02:56', 'Feedback', '257', 1),
(4194, 315, 'Gave 5 Stars on 257', '2024-10-14 02:03:22', 'Feedback', '257', 1),
(4195, 315, 'Gave 4 Stars on 257', '2024-10-14 02:03:36', 'Feedback', '257', 1),
(4196, 315, 'Gave 3 Stars on 257', '2024-10-14 02:04:34', 'Feedback', '257', 1),
(4197, 315, 'Gave 5 Stars on 325', '2024-10-14 02:06:07', 'Feedback', '325', 1),
(4198, 315, 'Gave 5 Stars on 320', '2024-10-14 02:07:25', 'Feedback', '320', 1),
(4199, 315, 'Gave 4 Stars on 265', '2024-10-14 02:11:34', 'Feedback', '265', 1),
(4200, 315, 'Gave 2 Stars on 265', '2024-10-14 02:11:38', 'Feedback', '265', 1),
(4201, 315, 'Gave 5 Stars on 265', '2024-10-14 02:11:55', 'Feedback', '265', 1),
(4202, 315, 'Gave 5 Stars on 265', '2024-10-14 02:11:58', 'Feedback', '265', 1),
(4203, 315, 'Gave 5 Stars on 265', '2024-10-14 02:11:58', 'Feedback', '265', 1),
(4204, 320, 'Gave 5 Stars on 266', '2024-10-14 02:14:39', 'Feedback', '266', 1),
(4205, 301, 'Gave 3 Stars on 273', '2024-10-14 02:16:56', 'Feedback', '273', 1),
(4206, 301, 'Gave 0 Stars and commented on Hushpet Diaper: Maganda yung quality, sakto sa price. Walang mabahong amoy, yung texture niya may pagka plastic na kahoy, hindi totally wooden feel pero expected naman yun. I think mag tatagal talaga ito basta supervised ang ', '2024-10-14 02:19:40', 'Feedback', '267', 1),
(4207, 301, 'Gave 4 Stars and commented on Dog Collar Big: Ganda ng packaging ng item ko they make sure na hindi mababbasag worth it s price nya pinakagat ko na s mga aso ko and nagustuhan naman nila kaso nag aagawan pa eh tig isa naman na sila hehe thank you seller t', '2024-10-14 02:19:58', 'Feedback', '283', 1),
(4208, 301, 'Gave 5 Stars and commented on Water Pot for Chicken: Ganda ng packaging ng item ko they make sure na hindi mababbasag worth it s price nya pinakagat ko na s mga aso ko and nagustuhan naman nila kaso nag aagawan pa eh tig isa naman na sila hehe thank you s', '2024-10-14 02:20:06', 'Feedback', '275', 1),
(4209, 301, 'Gave 2 Stars and commented on Dextrose Powder: Ganda ng packaging ng item ko they make sure na hindi mababbasag worth it s price nya pinakagat ko na s mga aso ko and nagustuhan naman nila kaso nag aagawan pa eh tig isa naman na sila hehe thank you seller ', '2024-10-14 02:20:15', 'Feedback', '316', 1),
(4210, 301, 'Gave 5 Stars and commented on Dog Collar Big: Delivery was fast and easy\n\nItem looks expensive but affordable and easy to use\nProduct came well packed with great quality\nMy dog loves em\n\nI will definitely buy again once our fur baby finishes it', '2024-10-14 02:20:41', 'Feedback', '283', 1),
(4211, 301, 'Gave 4 Stars on 326', '2024-10-14 02:20:51', 'Feedback', '326', 1),
(4212, 301, 'Gave 4 Stars and commented on Hushpet Diaper: Delivery was fast and easy\n\nItem looks expensive but affordable and easy to use\nProduct came well packed with great quality\nMy dog loves em\n\nI will definitely buy again once our fur baby finishes it', '2024-10-14 02:21:48', 'Feedback', '267', 1),
(4213, 301, 'Gave 3 Stars on 297', '2024-10-14 02:22:02', 'Feedback', '297', 1),
(4214, 301, 'Gave 5 Stars on 260', '2024-10-14 02:22:05', 'Feedback', '260', 1),
(4215, 301, 'Gave 5 Stars and commented on Multivitamin B12 Capsule: Very fast shipping! This product really exceeded my expectation', '2024-10-14 02:22:52', 'Feedback', '326', 1),
(4216, 301, 'Gave 5 Stars on 321', '2024-10-14 02:24:29', 'Feedback', '321', 1),
(4217, 301, 'Gave 4 Stars on 297', '2024-10-14 02:24:56', 'Feedback', '297', 1),
(4218, 301, 'Gave 4 Stars on 316', '2024-10-14 02:25:13', 'Feedback', '316', 1),
(4219, 301, 'Gave 5 Stars on 275', '2024-10-14 02:25:19', 'Feedback', '275', 1),
(4220, 301, 'Gave 5 Stars on 284', '2024-10-14 02:25:27', 'Feedback', '284', 1),
(4221, 322, 'Created their account: kyline padilla', '2024-10-14 02:27:11', 'account', '322', 1),
(4222, 322, 'Gave 5 Stars on 257', '2024-10-14 02:32:35', 'Feedback', '257', 1),
(4223, 322, 'Gave 5 Stars on 280', '2024-10-14 02:32:42', 'Feedback', '280', 1),
(4224, 322, 'Gave 5 Stars on 288', '2024-10-14 02:32:46', 'Feedback', '288', 1),
(4225, 322, 'Gave 5 Stars on 259', '2024-10-14 02:32:50', 'Feedback', '259', 1),
(4226, 322, 'Gave 5 Stars on 266', '2024-10-14 02:32:54', 'Feedback', '266', 1),
(4227, 322, 'Gave 5 Stars on 258', '2024-10-14 02:33:00', 'Feedback', '258', 1),
(4228, 322, 'Gave 5 Stars on 313', '2024-10-14 02:33:06', 'Feedback', '313', 1),
(4229, 322, 'Gave 5 Stars on 321', '2024-10-14 02:33:11', 'Feedback', '321', 1),
(4230, 322, 'Gave 5 Stars on 262', '2024-10-14 02:33:18', 'Feedback', '262', 1),
(4231, 322, 'Gave 4 Stars on 279', '2024-10-14 02:36:24', 'Feedback', '279', 1),
(4232, 322, 'Gave 3 Stars on 272', '2024-10-14 02:36:32', 'Feedback', '272', 1),
(4233, 322, 'Gave 4 Stars on 286', '2024-10-14 02:36:35', 'Feedback', '286', 1),
(4234, 322, 'Gave 4 Stars on 289', '2024-10-14 02:36:40', 'Feedback', '289', 1),
(4235, 322, 'Gave 5 Stars on 304', '2024-10-14 02:36:44', 'Feedback', '304', 1),
(4236, 322, 'Gave 4 Stars on 284', '2024-10-14 02:36:53', 'Feedback', '284', 1),
(4237, 323, 'Created their account: Azi Acosta', '2024-10-14 02:40:47', 'account', '323', 1),
(4238, 324, 'Created their account: andersonandy andy', '2024-10-14 02:43:30', 'account', '324', 1),
(4239, 321, 'Gave 5 Stars on 280', '2024-10-14 03:00:15', 'Feedback', '280', 1),
(4240, 321, 'Gave 5 Stars on 288', '2024-10-14 03:00:19', 'Feedback', '288', 1),
(4241, 321, 'Gave 5 Stars and commented on Bayong Big: I love bayong 😍😍🤗🤗🤗🤗😍', '2024-10-14 03:02:28', 'Feedback', '257', 1),
(4242, 321, 'Gave 5 Stars on 262', '2024-10-14 03:02:35', 'Feedback', '262', 1),
(4243, 321, 'Gave 3 Stars on 325', '2024-10-14 03:02:40', 'Feedback', '325', 1),
(4244, 321, 'Gave 5 Stars on 318', '2024-10-14 03:10:20', 'Feedback', '318', 1),
(4245, 325, 'Created their account: April Jane De Leon', '2024-10-14 03:27:15', 'account', '325', 1),
(4246, 326, 'Created their account: Joshua Anderson Padilla', '2024-10-14 03:31:06', 'account', '326', 1),
(4247, 312, 'Their account successfully recovered', '2024-10-14 12:52:27', 'account', '312', 1),
(4248, 327, 'Created their account: joshua padilla', '2024-10-14 13:41:55', 'account', '327', 1),
(4249, 328, 'Created their account: fykie loterena', '2024-10-14 13:46:07', 'account', '328', 1),
(4250, 327, 'Their account successfully recovered', '2024-10-14 13:48:13', 'account', '327', 1),
(4251, 327, 'RECOVER ACCOUNT', '2024-10-14 01:48:00', '', NULL, 1),
(4252, 292, 'Gave 1 Stars and commented on B 50 Forten : bad item', '2024-10-14 14:24:54', 'Feedback', '288', 1),
(4253, 16, 'Disabled: Mary Loi Ricalde account', '2024-10-14 14:27:49', 'account', '301', 1),
(4254, 16, 'Enabled: Mary Loi Ricalde account', '2024-10-14 14:28:01', 'account', '301', 1),
(4255, 16, ' update vat from 1 changed to 12', '2024-10-14 14:38:03', 'maintinance', '1', 1),
(4256, 16, 'update system banner', '2025-03-12 19:29:47', 'maintinance', '1', 0),
(4257, 16, 'Updated Freddie mark Santiago`s Profile picture', '2025-03-12 19:32:45', 'account', '16', 0);

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
(240, 'ACC66436279', 'Ñiña padilla', '09454454744', 'andersonandy046@gmail.com', '031411011', 'Region III (Central Luzon) Bulacan Marilao Prenza I bayanbayanan', 1, 1, 1),
(241, 'ACC96580280', 'Zyrine Alcarez', '09614229001', 'zy30alcarez@gmail.com', '031411011', 'Region III (Central Luzon) Bulacan Marilao Prenza I Pag-asa street', 1, 1, 1),
(242, 'ACC60360281', 'andy anderson', '09454454744', 'joshuaandersonpadilla8@gmail.com', '031411011', 'Region III (Central Luzon) Bulacan Marilao Prenza I bayanbayan', 1, 1, 1),
(243, 'ACC50299283', 'Juan Doe', '09120912091', 'andersonandy046@gmail.com', '031411008', 'Region III (Central Luzon) Bulacan Marilao Patubig Block 1 Lot 3', 1, 1, 1),
(244, 'ACC26869284', 'Daniel Villegas', '09123456789', 'dummy1stapador@gmail.com', '031404011', 'Region III (Central Luzon) Bulacan Bocaue Duhat T?!:\"\"()/-_$1', 1, 1, 1),
(247, 'ACC03771292', 'christin bermas', '09454454744', 'masterparj@gmail.com', '031411008', 'Region III (Central Luzon) Bulacan Marilao Patubig bonifacio', 1, 1, 1),
(248, 'ACC93237293', 'joe doe', '09120912091', 'floterina@gmail.com', '031411008', 'Region III (Central Luzon) Bulacan Marilao Patubig block1 lot 3', 1, 1, 1),
(249, 'ACC06596301', 'aprila jane', '09454454744', 'joshuaandersonpadilla8@gmail.com', '031411008', 'Region III (Central Luzon) Bulacan Marilao Patubig Nlex', 1, 1, 1),
(250, 'ACC31069305', 'Joe Doe', '09120912091', 'floterina@gmail.com', '031411011', 'Region III (Central Luzon) Bulacan Marilao Prenza I block1 lot 3', 1, 1, 1),
(251, 'ACC57229311', 'John Doe', '09120912091', 'loterinamichaela431@gmail.com', '031411011', 'Region III (Central Luzon) Bulacan Marilao Prenza I block1 lot 3', 1, 1, 1),
(252, 'ACC89780313', 'Zyrine Alcarez', '09614229001', 'zy30alcarez@gmail.com', '031411008', 'Region III (Central Luzon) Bulacan Marilao Patubig Pag-asa street papa compound', 1, 1, 1),
(253, 'ACC01594319', 'Joshua Anderson Padilla', '09454454744', 'andersonandy046@gmail.com', '031411011', 'Region III (Central Luzon) Bulacan Marilao Prenza I bayan bayanan', 1, 1, 1),
(254, 'ACC12831320', 'Joshua Anderson Padilla', '09454454744', 'andersonandy046@gmail.com', '031411008', 'Region III (Central Luzon) Bulacan Marilao Patubig bonifacio street', 1, 1, 1),
(255, 'ACC47835321', 'Joshua padilla', '09454454744', 'andersonandy046@gmail.com', '031423001', 'Region III (Central Luzon) Bulacan Santa Maria Bagbaguin kalye trese', 1, 1, 1),
(256, 'ACC69794314', 'Andy  Isaac', '09451943082', 'andyisaac18@gmail.com', '031404011', 'Region III (Central Luzon) Bulacan Bocaue Duhat safronhills', 1, 1, 1),
(257, 'ACC04033315', 'Leonel Rapsing', '09215038990', 'leonelrapsing1@gmail.com', '031423001', 'Region III (Central Luzon) Bulacan Santa Maria Bagbaguin kalye onse', 1, 1, 1),
(258, 'ACC40428322', 'Angela Denise', '09454454744', 'angenise242@gmail.com', '031411008', 'Region III (Central Luzon) Bulacan Marilao Patubig safronhills', 1, 1, 1),
(259, 'ACC37826324', 'Kevin Durant', '09454454744', 'kevinDurant@gmail.com', '031404011', 'Region III (Central Luzon) Bulacan Bocaue Duhat kanto9', 1, 1, 1),
(260, 'ACC13847323', 'Andrea Acosta', '09454454744', 'aziacosta046@gmail.com', '031411011', 'Region III (Central Luzon) Bulacan Marilao Prenza I pavhoa street', 1, 1, 1),
(261, 'ACC98318325', 'April Jane De Leon', '09454454744', 'apriljane@gmail.com', '031411011', 'Region III (Central Luzon) Bulacan Marilao Prenza I bayan bayanan', 1, 1, 1),
(262, 'ACC58538326', 'Joan Panimbangon', '09669994344', 'joanpanimbangon@gmail.com', '031404011', 'Region III (Central Luzon) Bulacan Bocaue Duhat ilang ilang', 1, 1, 1),
(263, 'ACC19728327', 'joshua padilla', '09454454744', 'alcarezzyrinearreza.pdm@gmail.com', '031411011', 'Region III (Central Luzon) Bulacan Marilao Prenza I bayanan bayanan', 1, 1, 1);

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
  ADD PRIMARY KEY (`mess_id`),
  ADD KEY `messages_ibfk_1` (`mess_sender`);

--
-- Indexes for table `mode_of_payment`
--
ALTER TABLE `mode_of_payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `new_cart`
--
ALTER TABLE `new_cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `new_cart_ibfk_1` (`user_id`);

--
-- Indexes for table `new_tbl_orders`
--
ALTER TABLE `new_tbl_orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `cust_id` (`cust_id`),
  ADD KEY `rider_id` (`rider_id`);

--
-- Indexes for table `new_tbl_order_items`
--
ALTER TABLE `new_tbl_order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `new_tbl_order_items_ibfk_2` (`order_id`);

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
  ADD PRIMARY KEY (`orders_orders_id`),
  ADD KEY `orders_prod_id` (`orders_prod_id`),
  ADD KEY `orders_user_id` (`orders_user_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `productphotos`
--
ALTER TABLE `productphotos`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `PHOTOS_PROD_ID` (`PHOTOS_PROD_ID`);

--
-- Indexes for table `rate_reviews`
--
ALTER TABLE `rate_reviews`
  ADD PRIMARY KEY (`r_rate_id`),
  ADD KEY `rate_reviews_ibfk_1` (`r_user_id`),
  ADD KEY `r_prod_id` (`r_prod_id`);

--
-- Indexes for table `return_ordering`
--
ALTER TABLE `return_ordering`
  ADD PRIMARY KEY (`ret_ol_id`);

--
-- Indexes for table `return_pos_table`
--
ALTER TABLE `return_pos_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `s_prod_id` (`s_prod_id`),
  ADD KEY `s_spl_id` (`s_spl_id`);

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
  ADD PRIMARY KEY (`act_id`),
  ADD KEY `act_account_id` (`act_account_id`);

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
  MODIFY `acc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=329;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1214;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

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
  MODIFY `mess_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=335;

--
-- AUTO_INCREMENT for table `mode_of_payment`
--
ALTER TABLE `mode_of_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `new_cart`
--
ALTER TABLE `new_cart`
  MODIFY `cart_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=387;

--
-- AUTO_INCREMENT for table `new_tbl_order_items`
--
ALTER TABLE `new_tbl_order_items`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=290;

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
  MODIFY `pos_cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1096;

--
-- AUTO_INCREMENT for table `pos_orders`
--
ALTER TABLE `pos_orders`
  MODIFY `orders_orders_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=954;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=327;

--
-- AUTO_INCREMENT for table `productphotos`
--
ALTER TABLE `productphotos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `rate_reviews`
--
ALTER TABLE `rate_reviews`
  MODIFY `r_rate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT for table `return_ordering`
--
ALTER TABLE `return_ordering`
  MODIFY `ret_ol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `return_pos_table`
--
ALTER TABLE `return_pos_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=535;

--
-- AUTO_INCREMENT for table `stocks_details`
--
ALTER TABLE `stocks_details`
  MODIFY `ns_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `spl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tbl_address`
--
ALTER TABLE `tbl_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `users_log`
--
ALTER TABLE `users_log`
  MODIFY `act_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4258;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=264;

--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `voucher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`mess_sender`) REFERENCES `account` (`acc_id`) ON DELETE CASCADE;

--
-- Constraints for table `new_cart`
--
ALTER TABLE `new_cart`
  ADD CONSTRAINT `new_cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `account` (`acc_id`) ON DELETE CASCADE;

--
-- Constraints for table `new_tbl_orders`
--
ALTER TABLE `new_tbl_orders`
  ADD CONSTRAINT `new_tbl_orders_ibfk_1` FOREIGN KEY (`cust_id`) REFERENCES `account` (`acc_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `new_tbl_orders_ibfk_2` FOREIGN KEY (`rider_id`) REFERENCES `account` (`acc_id`) ON DELETE CASCADE;

--
-- Constraints for table `new_tbl_order_items`
--
ALTER TABLE `new_tbl_order_items`
  ADD CONSTRAINT `new_tbl_order_items_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`prod_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `new_tbl_order_items_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `new_tbl_orders` (`order_id`) ON DELETE CASCADE;

--
-- Constraints for table `pos_orders`
--
ALTER TABLE `pos_orders`
  ADD CONSTRAINT `pos_orders_ibfk_1` FOREIGN KEY (`orders_prod_id`) REFERENCES `product` (`prod_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pos_orders_ibfk_2` FOREIGN KEY (`orders_user_id`) REFERENCES `account` (`acc_id`);

--
-- Constraints for table `productphotos`
--
ALTER TABLE `productphotos`
  ADD CONSTRAINT `productphotos_ibfk_1` FOREIGN KEY (`PHOTOS_PROD_ID`) REFERENCES `product` (`prod_id`) ON DELETE CASCADE;

--
-- Constraints for table `rate_reviews`
--
ALTER TABLE `rate_reviews`
  ADD CONSTRAINT `rate_reviews_ibfk_1` FOREIGN KEY (`r_user_id`) REFERENCES `account` (`acc_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rate_reviews_ibfk_2` FOREIGN KEY (`r_prod_id`) REFERENCES `product` (`prod_id`) ON DELETE CASCADE;

--
-- Constraints for table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `stocks_ibfk_1` FOREIGN KEY (`s_prod_id`) REFERENCES `product` (`prod_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stocks_ibfk_2` FOREIGN KEY (`s_spl_id`) REFERENCES `supplier` (`spl_id`);

--
-- Constraints for table `users_log`
--
ALTER TABLE `users_log`
  ADD CONSTRAINT `users_log_ibfk_1` FOREIGN KEY (`act_account_id`) REFERENCES `account` (`acc_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
