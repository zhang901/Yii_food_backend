-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2015 at 09:38 AM
-- Server version: 5.5.34
-- PHP Version: 5.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fastfood-essa`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ime` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `full_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `role` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `token` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=59 ;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `ime`, `username`, `password`, `email`, `full_name`, `phone`, `address`, `role`, `status`, `token`) VALUES
(1, NULL, 'delivery', '21232f297a57a5a743894a0e4a801fc3', 'fruity.ha@mail.com', 'Yoona', '0987654321', '17 Phung Chi Kien Cau Giay Ha Noi', 1, 1, '9be30288fa4d747c3ff227fa3631b060'),
(2, NULL, 'chef', '21232f297a57a5a743894a0e4a801fc3', 'fruity.haanh@gmail.com', 'Nguyen Ha Anh', '12345678901', '17 Phung Chi Kien', 2, 1, 'b095717d1889b35b3734d15672ad5d09'),
(27, NULL, 'simoninilucas', 'e10adc3949ba59abbe56e057f20f883e', 'simonini.lucas0@gmail.com', 'Lucas Simonini', '11980614377', 'Av. Giovanni Gronchi, 4381. Apto 39', 0, 1, NULL),
(36, NULL, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'email@gmail.com', 'Admin', '0912312308', '17 Phung Chi Kien', 3, 1, NULL),
(37, NULL, 'user', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', 'Pham Manh Cuong', '0912312308', 'Tu Ky Hai Duong', 0, 1, NULL),
(38, NULL, 'lucas', 'e10adc3949ba59abbe56e057f20f883e', 'lucas.simonini@email.com', 'lucas simonini', '1234567', 'av giovsnni gronchi 4381', 0, 1, NULL),
(39, NULL, 'dantruong', '21232f297a57a5a743894a0e4a801fc3', 'dantruong@gmail.com', 'Pham Dan Truong', '0912312308', '17 phung chi kien', 0, 1, NULL),
(42, NULL, 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229', 'demo@gmail.com', 'Pham Demo', '0912312308', '17 phung chi kien', 0, 1, NULL),
(43, NULL, 'HoangHaro', 'b390d110b5af949abb68651a2d44d76f', 'asdsd@gmail.com', 'asdda', '08855', 'adsads', 0, 1, NULL),
(44, NULL, 'waiter', '21232f297a57a5a743894a0e4a801fc3', 'fruity.waiter@gmail.com', 'Waiter', '01234124057', 'Phung Chi Kien - Cau Giay - Ha Noi', 4, 1, NULL),
(46, NULL, 'teste', '698dc19d489c4e4db73e28a713eab07b', 'email@email.com', 'teste', '123456', 'rua', 0, 1, NULL),
(47, NULL, 'pizzaiolo', '7cf2db5ec261a0fa27a502d3196a6f60', 'tesre@teste.com', 'pizza iolo', '123456', 'rua ', 2, 1, NULL),
(48, NULL, 'v2tien', '21232f297a57a5a743894a0e4a801fc3', 'tien@gmail.com', 'vu tien', '0987654321', 'ha noi', 0, 1, NULL),
(57, NULL, 'Linh', 'b24331b1a138cde62aa1f679164fc62f', 'Fruity.linhdtt@gmail.com', 'Long2', '09325048861', 'Hanoi1', 0, 1, NULL),
(58, NULL, 'Cuong', 'e10adc3949ba59abbe56e057f20f883e', 'orange@fruitysolution.com', 'Cuong', '0932504886', 'Cau giay', 0, 1, 'de6b08121968caa9fc4c8d24d70cb8ed');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `admin_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_username` varchar(100) NOT NULL,
  `admin_password` varchar(300) NOT NULL,
  `admin_role` varchar(30) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_username`, `admin_password`, `admin_role`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'super');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `contact_id` int(10) unsigned NOT NULL,
  `contact_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `contact_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `contact_content` text COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`contact_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contact_id`, `contact_name`, `contact_email`, `contact_content`, `created`) VALUES
(1398150733, '', 'danglv.android@gmail.com', 'Pleesae tell me ', '2014-04-22 07:12:13'),
(1398157487, '', 'danglv.android@gmail.com', 'Gdjd', '2014-04-22 09:04:47'),
(1400664251, '', 'duclt.it@gmail.com', 'vcc', '2014-05-21 09:24:11'),
(1432538249, '', 'demo@gmail.com', 'content', '2015-05-25 07:17:29'),
(1432539658, '', 'demo@gmail.com', 'content', '2015-05-25 07:40:58'),
(1435136323, '', 'cuong@fruitysolution.com', 'abc', '2015-06-24 08:58:43');

-- --------------------------------------------------------

--
-- Table structure for table `cooking_method`
--

CREATE TABLE IF NOT EXISTS `cooking_method` (
  `cm_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `cm_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cm_desc` text COLLATE utf8_unicode_ci,
  `cm_parent_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `cm_group` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `cm_type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `order_number` int(20) DEFAULT '0',
  PRIMARY KEY (`cm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cooking_method`
--

INSERT INTO `cooking_method` (`cm_id`, `cm_name`, `cm_desc`, `cm_parent_id`, `cm_group`, `cm_type`, `created`, `updated`, `order_number`) VALUES
('1397639422', 'Dry', '', '0', '1397639422', 'menu', '2014-04-16 09:10:22', '2014-04-22 02:33:52', 0),
('1397639445', 'Butter', '', '0', '1397639445', 'menu', '2014-04-16 09:10:45', '2014-04-22 02:36:09', 0),
('1397639459', 'Fresh raw cheerful', '', '0', '1397639459', 'menu', '2014-04-16 09:10:59', '2014-04-22 02:51:16', 0),
('1397709426', 'Brittle', '', '1397639422', '1397639422', 'menu', '2014-04-17 04:37:06', '2014-04-22 02:35:18', 0),
('1397709440', 'Medium dry', '', '1397639422', '1397639422', 'menu', '2014-04-17 04:37:20', '2014-04-22 02:34:13', 0),
('1397883341', 'Sugar', 'Gaintt', '0', '1397883341', 'topping', '2014-04-19 04:55:41', '2014-05-16 07:43:54', 0),
('1397951538', 'Unsalted', '', '1397639445', '1397639445', 'menu', '2014-04-19 23:52:18', '2014-04-22 02:47:10', 0),
('1398065257', 'Salty', '', '0', '1398065257', 'topping', '2014-04-21 07:27:37', '2014-04-21 07:37:47', 0),
('1398065565', 'Cooking oil ', '', '0', '1398065565', 'topping', '2014-04-21 07:32:45', '2014-04-21 07:32:45', 0),
('1398065814', 'Tasteless', '', '0', '1398065814', 'topping', '2014-04-21 07:36:54', '2014-04-21 07:36:54', 0),
('1398065836', 'Sweet', '', '0', '1398065836', 'topping', '2014-04-21 07:37:16', '2014-04-21 07:37:16', 0),
('1398065903', 'Sour', '', '0', '1398065903', 'topping', '2014-04-21 07:38:23', '2014-04-21 07:38:23', 0),
('1398067697', 'White', '', '0', '1398067697', 'topping', '2014-04-21 08:08:17', '2014-04-21 08:08:17', 0),
('1398067708', 'Black', '', '0', '1398067708', 'topping', '2014-04-21 08:08:28', '2015-06-18 04:36:47', 1),
('1398067719', 'Gold', '', '0', '1398067719', 'topping', '2014-04-21 08:08:39', '2014-04-21 08:08:39', 0),
('1398134845', 'Sweet butter', '', '1397639445', '1397639445', 'menu', '2014-04-22 02:47:25', '2014-04-22 02:47:25', 0),
('1398134869', 'Salted butter', '', '1397639445', '1397639445', 'menu', '2014-04-22 02:47:49', '2014-04-22 02:47:49', 0),
('1398134894', 'Sweet cream butter', '', '1397639445', '1397639445', 'menu', '2014-04-22 02:48:14', '2014-04-22 02:48:14', 0),
('1398134919', 'Lactic butter', '', '1397639445', '1397639445', 'menu', '2014-04-22 02:48:39', '2014-04-22 02:48:39', 0),
('1398134935', ' Whey butter', '', '1397639445', '1397639445', 'menu', '2014-04-22 02:48:55', '2014-04-25 13:16:39', 0),
('1398134953', 'Concentrated butter', '', '1397639445', '1397639445', 'menu', '2014-04-22 02:49:13', '2014-04-22 02:49:13', 0),
('1398134970', 'Margarine', '', '1397639445', '1397639445', 'menu', '2014-04-22 02:49:30', '2014-04-22 02:49:30', 0),
('1398134989', 'Shortening', '', '1397639445', '1397639445', 'menu', '2014-04-22 02:49:49', '2014-04-22 02:49:49', 0),
('1398140077', 'Hot', '', '0', '1398140077', 'menu', '2014-04-22 04:14:37', '2014-04-22 04:14:37', 0),
('1398140090', 'Cold', '', '0', '1398140090', 'menu', '2014-04-22 04:14:50', '2014-04-22 04:14:50', 0),
('1398140115', 'Warm', '', '0', '1398140115', 'menu', '2014-04-22 04:15:15', '2014-05-16 09:46:43', 0),
('1400237181', 'Suitable', '', '0', '1400237181', 'topping', '2014-05-16 10:46:21', '2014-05-16 10:46:35', 0),
('1431519833', 'Hour Availability', 'You can order within hours 8:00- 23:59', '0', '1431519833', 'topping', '2015-05-13 12:23:53', '2015-05-13 12:23:53', 0);

-- --------------------------------------------------------

--
-- Table structure for table `device`
--

CREATE TABLE IF NOT EXISTS `device` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gcm_id` varchar(255) DEFAULT NULL,
  `ime` varchar(255) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `device`
--

INSERT INTO `device` (`id`, `gcm_id`, `ime`, `type`, `status`, `user_id`) VALUES
(16, 'APA91bEwGILBV2857aJA38HUv61Z7G34r9s608UKYRGNBOpUzB-mV2DAbHjyFtmCl-yi22JBcnvKwHnJnq5baD7DCWQNV8F1aAYUGNfNwme9D41ZlbuJdTVOKtqJ3hddvdd4TvcJCpOT', '353719057770230', 1, 1, 0),
(17, 'APA91bGqpUCyJg42UNBGhb7wNS-DFWoZxNaU4gayjqaNt_sirLBw_bLd6ojcBNnFbU4NCekV9G2mxfMZK7vAbghO8vEk74lfly12JhenzR7IIYQzPbUk4P7ubNNgv-qhHo77bcEDTdZ-', '004999010640000', 1, 1, 44),
(18, 'APA91bGLpaTdVQzl_-djGzgSAyHySdxe3bgtvqq-asphGs0zhBXWmMTKf_7KT4cognhnS2ohEqWmaU1lChL4oOnECmVu8uYvlRWXNxbIyRGOQsgYDJIM86eSA8u3PQ37LVTR2n5b-w1A', '357865051525413', 1, 1, 44),
(20, 'APA91bEOcbY9LoMd5D4ofNdwEkDcbgOSA8HihuencHwNmxLVCtkU1IYpryWfQmWd4KcQfEn-az94n0O52gG0GPgxhn2dPP-pIV8GpXlB2Ea6uDMYJ96cRpyLP-MrHmnulFM4oAgu8uQM', '359878060694482', 1, 1, 2),
(21, 'APA91bFBJmEfV_aU0LzUwV3bB_d0gSN0Yb6-3DAnt7rCmWhZeKGsmXbVCzgKtBKy_1IehRhWrSlf4gQIX253rbQNbDhxgr3_Bme0qFXiIlIYZ6xm2_E2BSeMNPc0fQVkf5BUCB1xBOOj', '359315050575330', 1, 1, 27),
(23, 'APA91bF1ymexXuXIIlyvgF7Vd3-8go_KZwONBnhO-6wloypz9AAGMnwjgUOqk1rD9qytNnAzEGhnjYwcJ1A99yJkOsEmh4_2oY_P4OBSZXqut6khLwEMOImRywPoSc5E8A45r_XfYWx0', '351904051342317', 1, 1, 0),
(26, 'APA91bFEnoGhuGB8qBGZEWm0FUPNYzBBZJXV85G0fo8iwWndy2EDsDnpyBocbZrxt_f_jHZwnjW0DdtjVlCDbljG2L0mxWaF8ZkWuZdYystJDZHBXY631IjaNTgApnmw_xBcBw0CTJ4z', '353106067589851', 1, 1, 0),
(28, 'APA91bHVfOuqLCPGHU0BO65-GsoSNSyW9YMjMUtq5B0YeIG3KZn7WUdElGXEv6XPKuw4XwCDr9CQnwjVHTqrcw7eQQeFJmR_oTF87tY8ILPKMNt50YranOYrj-R93pU8T3S7MJdixcma', '359149055000014', 1, 1, 36),
(29, 'APA91bFYKJdr28drbGwPEbuNUQf7TVLyVacNpqZuKDXVV-OaaHje6Pw-HxbI-1gkvb8DEUck7ABayKxlUtw7a24BgZsvm6eCP7r0InYMJZWmj1bTfbkOiRM11D9Q7jtKWfqaYOv_loEG', '000000000000000', 1, 1, 36),
(30, 'APA91bFz0sURQTzm6rFkwlQwQwHnOYPUv9uQ0DUl8zC_AM1pvO_2DmQgR4nlWMWVlIMMv4AKfELSm_LFTTgoeBV4iZWSjyc_cuNaHnX8fb0fVLDZ_Sm0FIxcPpow0WRya3kXIYVPsu7a', '359651045927735', 1, 1, 46),
(31, 'APA91bE1up3hhZHu_Ot-_mfTzyOMjA5RPLCOTha1TT3wo1fAi8foyZtbKUk_A2XgYf1yMTj_Me8eaM7-Lykehog6EzmfK5Y9giR5k6353Hfhk35Prjkw_aAjXvuTKrCzVR3L3PJimQe5', '352239065268946', 1, 1, 48),
(32, 'APA91bFM_QDosQzkTzEkl79AJ6Y-wzUE-NqgSCQEBZ_in9jBb7MQGxnglan2v9HpL7-H-uZec6G2Az7HteJgJyQ9feuii5jfYVRazs_Xxe2a_2ETjn4VzVgHh0eQ1lnyk6yAvG9mi3uQ', '354988053871644', 1, 1, 0),
(37, '1bd00c829b306c8e4512328fc450c3d7de919cc0e44e3ad6596ecda4102fc830', 'hieu nguyen’s iPod', 2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `dish`
--

CREATE TABLE IF NOT EXISTS `dish` (
  `dish_id` int(10) unsigned NOT NULL,
  `dish_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dish_price` double NOT NULL,
  `dish_promotion` double DEFAULT NULL,
  `dish_urls_image` text COLLATE utf8_unicode_ci,
  `dish_urls_video` text COLLATE utf8_unicode_ci,
  `dish_thumb` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dish_small_thumb` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dish_menu` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `dish_desc` text COLLATE utf8_unicode_ci,
  `updated` date DEFAULT NULL,
  `created` date NOT NULL,
  `order_number` int(20) DEFAULT '0',
  PRIMARY KEY (`dish_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dish`
--

INSERT INTO `dish` (`dish_id`, `dish_name`, `dish_price`, `dish_promotion`, `dish_urls_image`, `dish_urls_video`, `dish_thumb`, `dish_small_thumb`, `dish_menu`, `dish_desc`, `updated`, `created`, `order_number`) VALUES
(1394421159, 'Coca-Cola', 2, NULL, NULL, NULL, '1397467940.jpg', 'S1397467940.jpg', '1397446507', 'We believe it&#39;s not just what you do but how you do it\r\n', '2014-05-16', '0000-00-00', 0),
(1394445723, 'Coca-Cola Light', 1.5, NULL, NULL, NULL, '1397448142.jpg', '1397448142.jpg', '1397446507', '<p>Diet Coke, also known as Coca-Cola light, is a sugar- and calorie-free soft drink with a deliciously crisp taste that gives you a light boost in your busy day</p>\r\n', NULL, '0000-00-00', 0),
(1394445763, 'Coca-Cola Zero', 1.5, NULL, NULL, NULL, '1397448238.jpg', '1397448238.jpg', '1397446507', '<p>Coca-Cola Zero or Coke Zero is a product of The Coca-Cola Company. It is a low-calorie (0.50 kilocalories per 150ml)[1] variation of Coca-Cola specifically marketed to men, who were shown to associate diet drinks with women. It is marketed as tasting indistinguishable from standard Coca-Cola, as opposed to Diet Coke which has a different formulation.[2][3]</p>\r\n\r\n<p>The Coca-Cola Zero logo has generally featured the script Coca-Cola logo in red with white trim on a black background, with the word &quot;zero&quot; underneath in lower case in the geometric typeface Avenir (or a customized version of it). Some details have varied from country to country. In the U.S., the letters decline in weight over the course of the word.</p>\r\n', NULL, '0000-00-00', 0),
(1394445794, 'Fanta', 1.5, NULL, NULL, NULL, '1397448315.jpg', '1397448315.jpg', '1397446507', '<p>Get your Fanta fix online, anytime. Visit &#39;Fanta GB&#39; to meet the &#39;GB&#39; Fanta characters, watch TV ads, download the newest screensavers and get the latest</p>\r\n', NULL, '0000-00-00', 0),
(1397466005, 'Spa Rood', 1.5, NULL, NULL, NULL, '1397466005.jpg', 'S1397466005.jpg', '1397446507', '<p>It it delicious !</p>\r\n', '2014-04-14', '2014-04-14', 0),
(1397466338, 'Barisart', 1.7, NULL, NULL, NULL, '1397466338.jpg', 'S1397466338.jpg', '1397446507', '<p>A barista is a person, usually a coffee-house employee, who prepares and serves espresso-based coffee drinks. Contents.</p>\r\n', '2015-06-18', '2014-04-14', 1),
(1397466530, 'Evian', 1.7, NULL, NULL, NULL, '1397466530.jpg', 'S1397466530.jpg', '1397446507', '<p>Producer of mineral water from the French Alps. Source details, health benefits, product information and events.</p>\r\n', '2014-04-14', '2014-04-14', 0),
(1397467644, 'Ice Tea', 1.8, NULL, NULL, NULL, '1397467644.jpg', 'S1397467644.jpg', '1397446507', '<p><em>Iced tea</em> (or <em>ice tea</em>) is a form of <em>cold tea</em>, usually served in a glass with ice. It may or may not be sweetened. <em>Iced tea</em> is also a popular packaged drink</p>\r\n', '2014-04-14', '2014-04-14', 0),
(1397528834, 'Supreme Meat Lover', 7, NULL, NULL, NULL, '1415935147.jpg', 'S1415935147.jpg', '1397447704', 'Find out more about the refreshing taste of Lipton Ice Tea Lemon\r\n', '2014-11-14', '2014-04-15', 0),
(1397528923, 'Rode Wijn', 3.3, NULL, NULL, NULL, '1397528923.jpg', 'S1397528923.jpg', '1397446507', '<p>Om rode wijn te verkrijgen wordt most gedurende een bepaalde periode (tegenwoordig tot twee weken) met de druivenschillen vergist</p>\r\n', '2014-04-15', '2014-04-15', 0),
(1397529009, 'Rosé Wijn', 3, NULL, NULL, NULL, '1397529009.jpg', 'S1397529009.jpg', '1397446507', '<p>Ros&eacute;wijn wordt gemaakt van blauwe druiven, soms in combinatie met witte druiven. De wijn krijgt haar kleur doordat de schillen van de blauwe druiven minder&nbsp;.</p>\r\n', '2014-04-15', '2014-04-15', 0),
(1397529209, 'Witte Wijn', 3.3, NULL, NULL, NULL, '1397529209.jpg', 'S1397529209.jpg', '1397446507', '<p><span class="st"><em>Witte wijn</em> wordt gemaakt uit het sap van druiven. De most is dus vrij van schillen, steeltjes en pitten. Omdat druivensap weinig tot geen kleurstof bevat zal de&nbsp;...</span></p>\r\n', '2014-04-15', '2014-04-15', 0),
(1397529560, 'Hoegaarden', 1.8, NULL, NULL, NULL, '1397529560.jpg', 'S1397529560.jpg', '1397446507', '<p>Speaking of which: pouring Hoegaarden is just like letting the sun fall into your glass: light yellow and naturally murky. And the soft foam adds a cloudy finish.</p>\r\n', '2014-04-15', '2014-04-15', 0),
(1397529704, 'Red-Bull', 2.5, NULL, NULL, NULL, '1397529704.jpg', 'S1397529704.jpg', '1397446507', '<p>Red Bull is an energy drink sold by Austrian company Red Bull GmbH, created in 1987. In terms of market share, Red Bull is the most popular energy drink in the&nbsp;</p>\r\n', '2014-04-15', '2014-04-15', 0),
(1397529821, 'Golden Power', 1.5, NULL, NULL, NULL, '1397529821.jpg', 'S1397529821.jpg', '1397446507', '<p>Now we are Generac power systems sole dealer and the official dealer of Hexing electrical in Egypt.</p>\r\n', '2014-04-15', '2014-04-15', 0),
(1397529994, 'Koffie', 1.2, NULL, NULL, NULL, '1397529994.jpg', 'S1397529994.jpg', '1397446507', '<p>Koffie is een meestal warm genuttigde drank die onder andere het oppeppende middel cafe&iuml;ne bevat. Koffie wordt gemaakt van de ontvelde, gemalen,&nbsp;</p>\r\n', '2014-04-15', '2014-04-15', 0),
(1398067068, 'Shrimp Scampi', 10, NULL, NULL, NULL, '1415935171.jpg', 'S1415935171.jpg', '1397447704', '', '2014-11-14', '2014-04-21', 0),
(1398134645, 'Family Lover', 7, NULL, NULL, NULL, '1415935201.jpg', 'S1415935201.jpg', '1397447704', '', '2014-11-14', '2014-04-22', 0),
(1400581409, 'Garden Salad', 6.95, NULL, NULL, NULL, '1415935467.png', 'S1415935467.png', '1400581350', 'Freshly made Garden Salad', '2014-11-14', '2014-05-20', 0),
(1431519996, 'Otel Salatası', 5, NULL, NULL, NULL, '1431519996.png', 'S1431519996.png', '1431513531', 'Pek Leziz', '2015-05-13', '2015-05-13', 0);

-- --------------------------------------------------------

--
-- Table structure for table `dish_transfer`
--

CREATE TABLE IF NOT EXISTS `dish_transfer` (
  `dish_transfer_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `dish_id` int(10) unsigned NOT NULL,
  `language_id` int(10) unsigned NOT NULL,
  `dish_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dish_desc` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`dish_transfer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dish_transfer`
--

INSERT INTO `dish_transfer` (`dish_transfer_id`, `dish_id`, `language_id`, `dish_name`, `dish_desc`) VALUES
('001547F6-6375-0883-DBDB-0A0A255EA583', 1397529912, 1394183321, 'Nalu', '<p>aLu (ナツルー Natsurū) is a semi-canon pair between the Fairy Tail Mages, Natsu Dragneel and Lucy Heartfilia. Contents. [show]. About Natsu and Lucy Edit.</p>\r\n'),
('00A239B6-ADC6-A5F0-BF01-386FEC54D800', 1397529821, 1394183321, 'Golden Power', '<p>Now we are Generac power systems sole dealer and the official dealer of Hexing electrical in Egypt.</p>\r\n'),
('065153EC-CAC1-9BD4-C5AC-AC85720A8AA9', 1400235204, 1394183321, 'ggg', 'ggg'),
('08FA4963-573F-A184-6FF3-0F8EA9A9E0A2', 1394421159, 1394183321, 'Coca-Cola', 'We believe it&#39;s not just what you do but how you do it\r\n'),
('0908FD8B-5F12-6A46-024B-E287F18BFC00', 1397529704, 1394183321, 'Red-Bull', '<p>Red Bull is an energy drink sold by Austrian company Red Bull GmbH, created in 1987. In terms of market share, Red Bull is the most popular energy drink in the&nbsp;</p>\r\n'),
('0B17A2AF-5B06-E92F-8C13-D1C8A87C5556', 1397546900, 1394183321, 'Croissant', '<p>I had a package of croissants in my fridge&mdash;I&rsquo;d picked them up at&nbsp;Le Walmarte, otherwise known as The Wal Marts, also known as Walmart the other day&mdash;and had originally planned to use them to make breakfast sandwiches with eggs, shaved ham, and cheese. But since I was in the mood for something a little sweet before I headed to church, I decided to make French toast instead.</p>\r\n\r\n<p>I&rsquo;ll just launch into the recipe now and spare you all the adjectives describing how positively sublime this French toast was&hellip;but just trust me on this: you&rsquo;ll want to make it this week.</p>\r\n\r\n<p>I absolutely, positively loved it.</p>\r\n'),
('124F6D22-3B4E-ACC8-E1E8-77BA67BB594D', 1400233074, 1394183321, 'bvcx', 'bvcxz'),
('1394429087', 0, 1394183321, 'commm', '<p>bbbbbbbbbbbbbbbbbbbbbbb</p>\r\n'),
('21978F7D-6918-EB0D-859B-46BAA46296B3', 1394445794, 1394183321, 'Fanta', '<p>Get your Fanta fix online, anytime. Visit &#39;Fanta GB&#39; to meet the &#39;GB&#39; Fanta characters, watch TV ads, download the newest screensavers and get the latest</p>\r\n'),
('23E6BC8C-B8D8-5D3C-7622-A2160E0F0E5A', 1397529318, 1394183321, 'Jupilera', '<p>Upiler is a Belgian beer brewed by Piedboeuf Brewery in Jupille-sur-Meuse, Belgium. Jupiler is the biggest-selling beer in Belgium.</p>\r\n'),
('254B02D2-D0E9-89C1-2DC7-EC71E44FFA01', 1397465872, 1394183321, 'Spa Rood', '<p>It it delicious !</p>\r\n'),
('31B0CACA-B691-E252-AD6B-C5CDFDC8168F', 1398073375, 1394183321, 'Vegetable', ''),
('3ADD68AB-B0E7-2AAA-3142-4622220DA2F9', 1397465759, 1394183321, 'Spa Rood', '<p>It it delicious !</p>\r\n'),
('4668205E-12A3-30D8-DFAA-DE6F10E3260A', 1397465860, 1394183321, 'Spa Rood', '<p>It it delicious !</p>\r\n'),
('476917A2-1A31-C3FA-2C02-F804171BFFCD', 1397529560, 1394183321, 'Hoegaarden', '<p>Speaking of which: pouring Hoegaarden is just like letting the sun fall into your glass: light yellow and naturally murky. And the soft foam adds a cloudy finish.</p>\r\n'),
('4C791A4C-C28F-585C-3A23-D3CDC86A5D6A', 1400233450, 1394183321, 'hhh', 'hhhh'),
('521D87DF-5E3F-7AD3-43E2-1277F5D35518', 1397466338, 1394183321, 'Barisart', '<p>A barista is a person, usually a coffee-house employee, who prepares and serves espresso-based coffee drinks. Contents.</p>\r\n'),
('5BF062EB-DCC1-75AF-E4A8-A58B64692AF8', 1398047051, 1394183321, 'hgfdj', 'hgf'),
('6006CCA3-A6E7-E8BB-C235-8C36312A4080', 1394437237, 1394183321, 'Bears tasty cake', '<p>Consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna.</p>\r\n'),
('64561856-B307-5A76-8971-F4402EEF766A', 1397467644, 1394183321, 'Ice Tea', '<p><em>Iced tea</em> (or <em>ice tea</em>) is a form of <em>cold tea</em>, usually served in a glass with ice. It may or may not be sweetened. <em>Iced tea</em> is also a popular packaged drink</p>\r\n'),
('68F87574-4F73-8804-F460-8887FB56EC88', 1398051298, 1394183321, '<b>tester</b>', '<b>tester</b>'),
('6B0441F8-441D-F3D8-D75C-BB0E5FE0FCEC', 1400581409, 1394183321, 'Garden Salad', 'Freshly made Garden Salad'),
('72F6D521-EA3D-F89A-902A-242BEFEC89F8', 1397528923, 1394183321, 'Rode Wijn', '<p>Om rode wijn te verkrijgen wordt most gedurende een bepaalde periode (tegenwoordig tot twee weken) met de druivenschillen vergist</p>\r\n'),
('75FD25E0-D4FF-2D59-A98D-15E5D7D068C6', 1397529209, 1394183321, 'Witte Wijn', '<p><span class="st"><em>Witte wijn</em> wordt gemaakt uit het sap van druiven. De most is dus vrij van schillen, steeltjes en pitten. Omdat druivensap weinig tot geen kleurstof bevat zal de&nbsp;...</span></p>\r\n'),
('7BC9ACA5-C466-AA9F-988D-0AC21B9B88A8', 1394445763, 1394183321, 'Coca-Cola Zero', '<p>Coca-Cola Zero or Coke Zero is a product of The Coca-Cola Company. It is a low-calorie (0.50 kilocalories per 150ml)[1] variation of Coca-Cola specifically marketed to men, who were shown to associate diet drinks with women. It is marketed as tasting indistinguishable from standard Coca-Cola, as opposed to Diet Coke which has a different formulation.[2][3]</p>\r\n\r\n<p>The Coca-Cola Zero logo has generally featured the script Coca-Cola logo in red with white trim on a black background, with the word &quot;zero&quot; underneath in lower case in the geometric typeface Avenir (or a customized version of it). Some details have varied from country to country. In the U.S., the letters decline in weight over the course of the word.</p>\r\n'),
('807964D1-7723-76DE-E089-9EB07FF3C598', 1397528834, 1394183321, 'Supreme Meat Lover', 'Find out more about the refreshing taste of Lipton Ice Tea Lemon\r\n'),
('969EBA0C-7EDA-FF87-7469-E7C8C0CD9611', 1400236900, 1394183321, 'ed3e', 'e3e'),
('9F1219EC-D9B9-4969-57CB-8450325BA1F1', 1394421159, 1394183993, 'Consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna.', '<p>Consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna.</p>\r\n'),
('A59E1373-18AD-05AB-C42B-537BB8602E38', 1397465850, 1394183321, 'Spa Rood', '<p>It it delicious !</p>\r\n'),
('BEB38E04-1B83-8A1E-3E3F-345AAFBAA060', 1394445723, 1394183321, 'Coca-Cola Light', '<p>Diet Coke, also known as Coca-Cola light, is a sugar- and calorie-free soft drink with a deliciously crisp taste that gives you a light boost in your busy day</p>\r\n'),
('CDB14907-AFE7-662A-EE60-8876F892645F', 1397466530, 1394183321, 'Evian', '<p>Producer of mineral water from the French Alps. Source details, health benefits, product information and events.</p>\r\n'),
('D4E2FC60-188B-B5EA-361E-F2D160194DE8', 1398067068, 1394183321, 'Shrimp Scampi', ''),
('D88D7FC6-7135-661E-22B6-AA5BF56276C5', 1398134645, 1394183321, 'Family Lover', ''),
('E2B6463D-01F7-0E4F-1B98-E82DF7CC69B2', 1398066491, 1394183321, 'Test', ''),
('E5EDD9C6-8F65-6F25-DFAB-1B3C362B6ABF', 1431519996, 1394183321, 'Otel Salatası', 'Pek Leziz'),
('E6E3CB98-5DD7-470A-78D0-FE8C19DFC4D7', 1397466005, 1394183321, 'Spa Rood', '<p>It it delicious !</p>\r\n'),
('F4B550AC-CDC0-A992-3516-7661F78D6E3B', 1397529009, 1394183321, 'Rosé Wijn', '<p>Ros&eacute;wijn wordt gemaakt van blauwe druiven, soms in combinatie met witte druiven. De wijn krijgt haar kleur doordat de schillen van de blauwe druiven minder&nbsp;.</p>\r\n'),
('FEEDE12A-D83B-512A-3FC1-9079C8DDC9AD', 1397529994, 1394183321, 'Koffie', '<p>Koffie is een meestal warm genuttigde drank die onder andere het oppeppende middel cafe&iuml;ne bevat. Koffie wordt gemaakt van de ontvelde, gemalen,&nbsp;</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE IF NOT EXISTS `language` (
  `language_id` int(10) unsigned NOT NULL,
  `language_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `language_key` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `language_thumb` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `language_is_default` tinyint(1) DEFAULT NULL,
  `language_status` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`language_id`, `language_name`, `language_key`, `language_thumb`, `language_is_default`, `language_status`) VALUES
(1394183321, 'English', 'en', '1394183320.jpg', 1, 'active'),
(1394183993, 'Vietnamese', 'vi', '1394183992.png', 0, 'inactive'),
(1394184008, 'Japanese', 'jp', '1394184007.jpg', 0, 'inactive'),
(1394439760, 'France', 'fr', '1394439759.png', 0, 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
  `menu_id` int(10) unsigned NOT NULL,
  `menu_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `menu_thumb` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `menu_desc` text COLLATE utf8_unicode_ci,
  `menu_is_panini` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `order_number` int(20) DEFAULT '0',
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`menu_id`, `menu_name`, `menu_thumb`, `menu_desc`, `menu_is_panini`, `created`, `updated`, `order_number`) VALUES
(1397446507, 'DRINKS', '1397446507.jpg', 'To go a bit of a different direction because i''m not sure if this is more of the nature of your question..dddddddddddddd', 1, '0000-00-00 00:00:00', '2015-06-18 04:36:11', 1),
(1397447704, 'PIZZA', '1415935083.jpg', 'With the huge variety on sandwiches (broodjes) and bread toppings we have in Holland, I was convinced we would be mentioned at least indddddddddddddddddddd\r\n', 1, '0000-00-00 00:00:00', '2015-06-18 07:38:08', 2),
(1400581350, 'SALADS', '1400581350.jpg', 'Freshly made salads to order', 0, '2014-05-20 10:22:30', '2015-06-05 10:44:57', 0),
(1431513531, 'OTEL MENU', '1431513531.png', 'Otelimizde Yatağınızdan Sipariş Vermenin Tek Adresi', 0, '2015-05-13 10:38:51', '2015-05-13 10:38:51', 0);

-- --------------------------------------------------------

--
-- Table structure for table `menu_transfer`
--

CREATE TABLE IF NOT EXISTS `menu_transfer` (
  `menu_transfer_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `menu_id` int(10) unsigned NOT NULL,
  `language_id` int(10) unsigned NOT NULL,
  `menu_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `menu_desc` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`menu_transfer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu_transfer`
--

INSERT INTO `menu_transfer` (`menu_transfer_id`, `menu_id`, `language_id`, `menu_name`, `menu_desc`) VALUES
('0573682B-9524-CD70-F00F-4F1FC60D2059', 1400588997, 1394183321, 'Cold', 'Cold Sandwiches'),
('0C29C5FC-583D-D177-D28A-21EA7CE620F4', 1397447704, 1394183321, 'PIZZA', 'With the huge variety on sandwiches (broodjes) and bread toppings we have in Holland, I was convinced we would be mentioned at least indddddddddddddddddddd\r\n'),
('1394247791', 1394246689, 1394183993, 'thịt', '<p>cccccccccccccccccc</p>\r\n'),
('23BAB587-ADA8-45B7-0205-82889DDF2022', 1400669743, 1394183321, '   @623', ''),
('26DDCA6A-B36A-0F4C-3EBE-6B020517E1DB', 1426136228, 1394183321, 'PIZZAddfd', 'ffffffffffffff'),
('392A9489-F5F4-3324-1FE1-5247FB972965', 1397446507, 1394183321, 'DRINKS', 'To go a bit of a different direction because i''m not sure if this is more of the nature of your question..dddddddddddddd'),
('3DF978AE-6635-3FAB-8E62-08A130ADF82F', 1398051357, 1394183321, '?returnSysID=''>"><script>alert("www.testingvn.com")</script>', '?returnSysID=''>"><script>alert("www.testingvn.com")</script>'),
('4B6B8CEF-7479-3410-6D4D-9EDD33CF6A79', 1400213710, 1394183321, 'Test', ''),
('4DE7DD8D-FE2C-668F-2D5B-E9DFBD0F1F28', 1400581350, 1394183321, 'SALADS', 'Freshly made salads to order'),
('564C02A3-021B-DF12-339E-D3B5E27CE7B7', 1400639788, 1394183321, 'Cold Sandwiches', ''),
('667A029B-6558-4A16-FD4A-73C99E417134', 1394246689, 1394184008, 'what do you thing about this?', '<p>fdsfsdfs</p>\r\n'),
('74CC4397-D4B2-BEB6-7EA7-E67C6C1A7239', 1400641518, 1394183321, 'Cold Sandwiches', ''),
('7AA6F2FC-5B70-CB2F-FFA5-D4C35537F26D', 1397878925, 1394183321, 'bvcx', 'cx'),
('93E159CD-F206-7DFF-1B2B-5AB515519E13', 1431513531, 1394183321, 'OTEL MENU', 'Otelimizde Yatağınızdan Sipariş Vermenin Tek Adresi'),
('950B5566-89C2-8AA7-AF88-3C2CC8EBA1C2', 1398047409, 1394183321, ' NOODLE SOUP', 'Noodle soup refers to a variety of soups with noodles and other ingredients served in a light broth. Noodle soup is an East and Southeast Asian staple'),
('9D2A44D3-8E65-E440-475E-ED879CB2D89C', 1397878957, 1394183321, 'AAAAAAAAAAAAAAAAA', ''),
('B048DAAD-FED1-9AEF-51A1-8DAF7315AE94', 1400233494, 1394183321, 'yuyuu67677', ''),
('C0C1C52E-BFF4-B102-E96C-0645E4E20971', 1398046633, 1394183321, 'Noodle soup', ''),
('CACFD4D7-9E79-92F0-E29A-320F2442882E', 1398073695, 1394183321, 'hgfd', 'gf'),
('E4A8A402-05F6-0304-B67B-D0C916100726', 1400657700, 1394183321, '  a b    ccc', 'blgdwoedweedweq'),
('EAAAB221-8EBD-6649-9052-DFD8357DBDF2', 1394246689, 1394183321, 'chicken', '<p>chickennnnnnnnnnnnnnnnnnnnnnnnnnnnnn</p>\r\n'),
('EBBB2CFF-1C4D-B704-8779-39C63E3D0EEA', 1394445584, 1394183321, 'beef', '<p>Generating code using template &quot;C:\\xampp\\htdocs\\restaurant\\common\\extensions\\gii\\bo\\templates\\default&quot;... overwrote models\\LanguageForm.php done!<br />\r\n&nbsp;</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `order_tel` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `order_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `order_foods` longtext COLLATE utf8_unicode_ci NOT NULL,
  `order_requirement` text COLLATE utf8_unicode_ci,
  `order_time` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_price` double DEFAULT NULL,
  `order_topping_price` double NOT NULL,
  `order_status` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `delivery_id` int(11) DEFAULT '0',
  `order_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `deviceId` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `chef_id` int(11) DEFAULT '0',
  `table_id` int(11) DEFAULT NULL,
  `seats_number` int(11) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=223 ;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `order_name`, `order_tel`, `order_email`, `order_foods`, `order_requirement`, `order_time`, `order_price`, `order_topping_price`, `order_status`, `created`, `updated`, `delivery_id`, `order_address`, `user_id`, `deviceId`, `payment_type`, `chef_id`, `table_id`, `seats_number`) VALUES
(28, 'Pham Dan Truong', '0912312308', 'no-email@mail.com', '[{"topping":[],"sl":1,"id":"1394421159","instruction":""},{"topping":[],"sl":1,"id":"1394445723","instruction":""},{"topping":[],"sl":1,"id":"1400581409","instruction":""},{"topping":[],"sl":1,"id":"1394421159","instruction":""},{"topping":[],"sl":1,"id":"1394445723","instruction":""}]', '', '1433939400', 13.95, 0, 4, '2015-05-13 06:52:14', '2015-05-13 06:52:14', 0, 'Ho Chi Minh', NULL, '004999010640000', 'pay on delivery', 0, 1, NULL),
(29, 'Pham Manh Cuong', '0912312308', '', '[{"topping":[],"sl":1,"id":"1400581409","instruction":""},{"topping":[],"sl":1,"id":"1394421159","instruction":""},{"topping":[],"sl":1,"id":"1394445723","instruction":""}]', '', '1433939400', 10.45, 0, 4, '2015-05-13 06:52:55', '2015-05-13 06:52:55', 0, 'Tu Ky Hai Duong', 37, NULL, 'pay on delivery', 0, 1, NULL),
(30, 'Pham Manh Cuong', '0912312308', '', '[{"topping":[],"sl":1,"id":"1400581409","instruction":""},{"topping":[],"sl":1,"id":"1394445794","instruction":""},{"topping":[],"sl":1,"id":"1397466530","instruction":""},{"topping":[],"sl":1,"id":"1397528923","instruction":""}]', '', '1433939400', 13.45, 0, 4, '2015-05-13 06:53:31', '2015-05-13 06:53:31', 0, 'Tu Ky Hai Duong', 37, NULL, 'pay on delivery', 0, 1, NULL),
(31, 'Pham Manh Cuong', '0912312308', '', '[{"topping":[],"sl":1,"id":"1400581409","instruction":""},{"topping":[],"sl":1,"id":"1397528923","instruction":""},{"topping":[],"sl":1,"id":"1397529009","instruction":""}]', '', '1433939400', 13.25, 0, 4, '2015-05-13 06:54:14', '2015-05-13 06:54:14', 0, 'Tu Ky Hai Duong', 37, NULL, 'pay on delivery', 0, 1, NULL),
(33, 'Pham Manh Cuong', '0912312308', '', '[{"id":"1400581409","instruction":"","sl":"1"}]', '', '1433939400', 6.95, 0, 4, '2015-05-13 07:59:12', '2015-05-13 07:59:12', 1, 'Dhdh', 37, NULL, 'pay on delivery', 2, 1, NULL),
(34, 'uzh', '93507060', 'no-email@mail.com', '[{"id":"1397528834","sl":6,"topping":[],"instruction":""},{"id":"1398067068","sl":8,"topping":[],"instruction":""},{"id":"1398134645","sl":1,"topping":[],"instruction":""},{"id":"1394421159","sl":1,"topping":[],"instruction":""},{"id":"1394445723","sl":1,"topping":[],"instruction":""},{"id":"1394445763","sl":1,"topping":[],"instruction":""},{"id":"1394445794","sl":1,"topping":[],"instruction":""},{"id":"1397466005","sl":1,"topping":[],"instruction":""},{"id":"1397466338","sl":1,"topping":[],"instruction":""},{"id":"1397466530","sl":1,"topping":[],"instruction":""},{"id":"1397467644","sl":1,"topping":[],"instruction":""},{"id":"1397528923","sl":1,"topping":[],"instruction":""},{"id":"1397529009","sl":1,"topping":[],"instruction":""},{"id":"1400581409","sl":1,"topping":[],"instruction":""}]', '', '1433939400', 155.45, 0, 4, '2015-05-14 09:12:23', '2015-05-14 09:12:23', 1, 'io', NULL, '359878060694482', 'pay on delivery', 2, 1, NULL),
(35, 'uzh', '93507060', 'no-email@mail.com', '[{"id":"1394421159","sl":7,"topping":[],"instruction":""},{"id":"1394445763","sl":6,"topping":[],"instruction":""},{"id":"1394445794","sl":1,"topping":[{"1397879078":"1398067719"},{"1397879375":"1398065565"}],"instruction":""},{"id":"1397466005","sl":1,"topping":[{"1397879078":"1398067708"},{"1397879375":"1398065565"}],"instruction":""},{"id":"1431519996","sl":1,"topping":[],"instruction":""},{"id":"1394445723","sl":1,"topping":[],"instruction":""},{"id":"1398067068","sl":1,"topping":[],"instruction":""}]', '', '1433939400', 42.5, 0, 4, '2015-05-14 10:02:30', '2015-05-14 10:02:30', 0, 'yu', NULL, '359878060694482', 'pay on delivery', 2, 1, NULL),
(36, 'test 6', '93507060', 'no-email@mail.com', '[{"id":"1394421159","sl":1,"topping":[{"1397879078":"1398067719"},{"1397879375":"1398065565"}],"instruction":"this is great"},{"id":"1394445723","sl":1,"topping":[{"1397879375":"1398065565"}],"instruction":""},{"id":"1394445763","sl":1,"topping":[],"instruction":""},{"id":"1394445794","sl":1,"topping":[],"instruction":""},{"id":"1397466005","sl":1,"topping":[],"instruction":"this is great"}]', '', '1433939400', 8, 0, 4, '2015-05-14 10:26:11', '2015-05-14 10:26:11', NULL, 'test', NULL, '359878060694482', 'pay on delivery', NULL, NULL, NULL),
(37, 'test6-1', '9658-23868', 'no-email@mail.com', '[{"id":"1400581409","sl":1,"topping":[],"instruction":""},{"id":"1394445723","sl":1,"topping":[],"instruction":""},{"id":"1394421159","sl":1,"topping":[],"instruction":""},{"id":"1394445763","sl":1,"topping":[],"instruction":""},{"id":"1394445794","sl":1,"topping":[],"instruction":""},{"id":"1397466005","sl":1,"topping":[],"instruction":""},{"id":"1397466530","sl":1,"topping":[],"instruction":""},{"id":"1397466338","sl":1,"topping":[],"instruction":""}]', '', '1433939400', 18.35, 0, 4, '2015-05-14 10:27:39', '2015-05-14 10:27:39', 0, 'tedt', NULL, '359878060694482', 'pay on delivery', 2, NULL, NULL),
(38, 'tedt6-3', '93507060', 'no-email@mail.com', '[{"id":"1394445723","sl":1,"topping":[],"instruction":""},{"id":"1394445763","sl":1,"topping":[],"instruction":""},{"id":"1394445794","sl":1,"topping":[],"instruction":""},{"id":"1397466005","sl":1,"topping":[],"instruction":""},{"id":"1397466338","sl":1,"topping":[],"instruction":""},{"id":"1397466530","sl":1,"topping":[],"instruction":""},{"id":"1397467644","sl":1,"topping":[],"instruction":""},{"id":"1397529009","sl":1,"topping":[],"instruction":""},{"id":"1397528923","sl":1,"topping":[],"instruction":""},{"id":"1397529821","sl":1,"topping":[],"instruction":""},{"id":"1397529704","sl":1,"topping":[],"instruction":""},{"id":"1397529560","sl":1,"topping":[],"instruction":""},{"id":"1400581409","sl":1,"topping":[],"instruction":""},{"id":"1394421159","sl":1,"topping":[],"instruction":""},{"id":"1397528834","sl":1,"topping":[],"instruction":""},{"id":"1398067068","sl":1,"topping":[],"instruction":""},{"id":"1398134645","sl":1,"topping":[],"instruction":""}]', '', '1433939400', 56.25, 0, 4, '2015-05-14 10:30:58', '2015-05-14 10:30:58', NULL, 'ggg', NULL, '359878060694482', 'pay on delivery', NULL, NULL, NULL),
(39, 'test 6-3', '93507060', 'no-email@mail.com', '[{"id":"1431519996","sl":1,"topping":[],"instruction":""},{"id":"1397528834","sl":1,"topping":[],"instruction":""},{"id":"1398067068","sl":1,"topping":[],"instruction":""},{"id":"1398134645","sl":1,"topping":[],"instruction":""},{"id":"1394445723","sl":1,"topping":[],"instruction":""},{"id":"1394421159","sl":1,"topping":[],"instruction":""},{"id":"1394445763","sl":1,"topping":[],"instruction":""}]', '', '1433939400', 34, 0, 4, '2015-05-14 10:32:52', '2015-05-14 10:32:52', NULL, 'gf', NULL, '359878060694482', 'pay on delivery', NULL, NULL, NULL),
(40, 'Pham Manh Cuong', '0912312308', '', '[{"topping":[],"sl":1,"id":"1400581409","instruction":""},{"topping":[],"sl":1,"id":"1394421159","instruction":""}]', '', '1433939400', 8.95, 0, 4, '2015-05-15 04:47:12', '2015-05-15 04:47:12', 0, '17 Phung Chi Kien', 36, NULL, 'pay on delivery', 0, NULL, NULL),
(45, 'Pham Manh Cuong', '0912312308', '', '[{"topping":[],"sl":1,"id":"1400581409","instruction":""}]', '', '1433939400', 6.95, 0, 4, '2015-05-15 07:57:10', '2015-05-15 07:57:10', 0, '17 Phung Chi Kien', 36, NULL, 'pay on delivery', 0, NULL, NULL),
(46, 'Pham Manh Cuong', '0912312308', '', '[{"topping":[],"sl":1,"id":"1400581409","instruction":""}]', '', '1433939400', 6.95, 0, 4, '2015-05-15 07:59:46', '2015-05-15 07:59:46', 0, '17 Phung Chi Kien', 36, NULL, 'pay on delivery', 0, NULL, NULL),
(47, 'Pham Manh Cuong', '0912312308', '', '[{"topping":[],"sl":1,"id":"1400581409","instruction":""}]', '', '1433939400', 6.95, 0, 4, '2015-05-15 08:03:03', '2015-05-15 08:03:03', 0, '17 Phung Chi Kien', 36, NULL, 'pay on delivery', 0, NULL, NULL),
(48, 'Pham Manh Cuong', '0912312308', '', '[{"topping":[],"sl":1,"id":"1400581409","instruction":""}]', '', '1433939400', 6.95, 0, 4, '2015-05-15 08:05:01', '2015-05-15 08:05:01', 0, '17 Phung Chi Kien', 36, NULL, 'pay on delivery', 0, NULL, NULL),
(49, 'Pham Manh Cuong', '0912312308', '', '[{"topping":[],"sl":1,"id":"1400581409","instruction":""}]', '', '1433939400', 6.95, 0, 4, '2015-05-15 08:05:41', '2015-05-15 08:05:41', 0, '17 Phung Chi Kien', 36, NULL, 'pay on delivery', 0, NULL, NULL),
(50, 'Pham Manh Cuong', '0912312308', '', '[{"topping":[],"sl":1,"id":"1400581409","instruction":""}]', '', '1433939400', 6.95, 0, 4, '2015-05-15 08:05:54', '2015-05-15 08:05:54', 0, '17 Phung Chi Kien', 36, NULL, 'pay on delivery', 0, NULL, NULL),
(57, 'Pham Manh Cuong', '0912312308', '', '[{"topping":[],"sl":1,"id":"1400581409","instruction":""}]', '', '1433939400', 6.95, 0, 4, '2015-05-15 08:13:30', '2015-05-15 08:13:30', 0, '17 Phung Chi Kien', 36, NULL, 'pay on delivery', 0, NULL, NULL),
(62, 'Pham Manh Cuong', '0912312308', '', '[{"topping":[],"sl":1,"id":"1394445723","instruction":""}]', '', '1433939400', 1.5, 0, 4, '2015-05-15 10:24:24', '2015-05-15 10:24:24', 0, '17 Phung Chi Kien', 36, NULL, 'pay on delivery', 0, NULL, NULL),
(63, 'Pham Manh Cuong', '0912312308', '', '[{"topping":[],"sl":1,"id":"1394421159","instruction":""},{"topping":[{"1397879375":"1397883341"}],"sl":1,"id":"1394445723","instruction":"ncnxnd"}]', '', '1433939400', 3.5, 0, 4, '2015-05-15 11:29:10', '2015-05-15 11:29:10', 0, '17 Phung Chi Kien', 36, NULL, 'pay on delivery', 0, NULL, NULL),
(64, 'Pham Manh Cuong', '0912312308', '', '[{"topping":[],"sl":1,"id":"1394421159","instruction":""},{"topping":[],"sl":1,"id":"1394445723","instruction":""}]', '', '1433939400', 3.5, 0, 4, '2015-05-16 01:27:56', '2015-05-16 01:27:56', 0, '17 Phung Chi Kien', 36, NULL, 'pay on delivery', 0, NULL, NULL),
(65, 'djdjdd', '9989888', 'no-email@mail.com', '[{"topping":[],"sl":1,"id":"1397529009","instruction":""},{"topping":[],"sl":1,"id":"1397529209","instruction":""}]', '', '1433939400', 6.3, 0, 4, '2015-05-16 01:31:07', '2015-05-16 01:31:07', NULL, 'hxhdxjx', NULL, '004999010640000', 'pay on delivery', NULL, NULL, NULL),
(66, 'cffff', '85888', 'no-email@mail.com', '[{"topping":[],"sl":1,"id":"1400581409","instruction":""}]', '', '1433939400', 6.95, 0, 4, '2015-05-16 01:41:15', '2015-05-16 01:41:15', NULL, 'ggg', NULL, '004999010640000', 'pay on delivery', NULL, NULL, NULL),
(67, 'cffff', '85888', 'no-email@mail.com', '[{"topping":[],"sl":1,"id":"1400581409","instruction":""}]', '', '1433939400', 6.95, 0, 1, '2015-05-16 01:43:22', '2015-05-16 01:43:22', 0, 'ggg', NULL, '004999010640000', 'pay on delivery', 0, NULL, NULL),
(68, 'cffff', '85888', 'no-email@mail.com', '[{"topping":[],"sl":1,"id":"1400581409","instruction":""}]', '', '1433939400', 6.95, 0, 4, '2015-05-16 01:43:35', '2015-05-16 01:43:35', NULL, 'ggg', NULL, '004999010640000', 'pay on delivery', NULL, NULL, NULL),
(69, 'Pham Manh Cuong', '0912312308', '', '[{"topping":[],"sl":1,"id":"1400581409","instruction":""},{"topping":[],"sl":1,"id":"1394421159","instruction":""}]', '', '1433939400', 8.95, 0, 4, '2015-05-16 01:44:44', '2015-05-16 01:44:44', 0, '17 Phung Chi Kien', 36, NULL, 'pay on delivery', 0, NULL, NULL),
(70, 'Pham Manh Cuong', '0912312308', '', '[{"topping":[],"sl":1,"id":"1400581409","instruction":""},{"topping":[],"sl":1,"id":"1394421159","instruction":""}]', '', '1433939400', 8.95, 0, 4, '2015-05-16 01:45:18', '2015-05-16 01:45:18', 0, 'Tu Ky Hai Duong', 37, NULL, 'pay on delivery', 0, NULL, NULL),
(71, 'Pham Manh Cuong', '0912312308', '', '[{"topping":[],"sl":1,"id":"1400581409","instruction":""},{"topping":[],"sl":1,"id":"1394421159","instruction":""}]', '', '1433939400', 8.95, 0, 4, '2015-05-16 01:48:52', '2015-05-16 01:48:52', 0, '17 Phung Chi Kien', 36, NULL, 'pay on delivery', 0, NULL, NULL),
(72, 'fjfjfjfjj', '68688888', 'no-email@mail.com', '[{"topping":[],"sl":1,"id":"1400581409","instruction":""},{"topping":[],"sl":1,"id":"1394421159","instruction":""}]', '', '1433939400', 8.95, 0, 4, '2015-05-16 01:51:24', '2015-05-16 01:51:24', NULL, 'cjcjccjcjjf', NULL, '004999010640000', 'pay on delivery', NULL, NULL, NULL),
(73, 'bxjdjd', '956656565', 'no-email@mail.com', '[{"topping":[],"sl":1,"id":"1400581409","instruction":""},{"topping":[],"sl":1,"id":"1394445723","instruction":""}]', '', '1433939400', 8.45, 0, 4, '2015-05-16 01:51:58', '2015-05-16 01:51:58', NULL, 'jxjfjdjd', NULL, '004999010640000', 'pay on delivery', NULL, NULL, NULL),
(74, 'Pham Manh Cuong', '0912312308', '', '[{"topping":[],"sl":1,"id":"1400581409","instruction":""},{"topping":[],"sl":1,"id":"1394445723","instruction":""}]', '', '1433939400', 8.45, 0, 4, '2015-05-16 01:53:18', '2015-05-16 01:53:18', 0, 'Tu Ky Hai Duong', 37, NULL, 'pay on delivery', 0, NULL, NULL),
(75, 'Pham Manh Cuong', '0912312308', '', '[{"topping":[],"sl":1,"id":"1400581409","instruction":""}]', '', '1433939400', 6.95, 0, 4, '2015-05-16 02:19:03', '2015-05-16 02:19:03', 1, 'Tu Ky Hai Duong', 37, NULL, 'pay on delivery', 2, NULL, NULL),
(76, 'Pham Manh Cuong', '0912312308', '', '[{"topping":[],"sl":1,"id":"1394421159","instruction":""}]', '', '1433939400', 2, 0, 4, '2015-05-16 02:19:35', '2015-05-16 02:19:35', 0, 'Tu Ky Hai Duong', 37, NULL, 'pay on delivery', 0, NULL, NULL),
(85, 'ndjdjdjd', '865656', 'no-email@mail.com', '[{"topping":[],"sl":1,"id":"1400581409","instruction":""}]', '', '1433939400', 6.95, 0, 6, '2015-05-16 09:36:55', '2015-05-16 09:36:55', 0, 'djdjdj', NULL, '004999010640000', 'pay on delivery', 0, NULL, NULL),
(86, 'djddjjd', '16464', 'no-email@mail.com', '[{"topping":[],"sl":1,"id":"1400581409","instruction":""}]', '', '1433939400', 6.95, 0, 6, '2015-05-16 09:37:01', '2015-05-16 09:37:01', 0, 'xdjdjdj', NULL, '004999010640000', 'pay on delivery', 0, NULL, NULL),
(87, 'djddjjd', '16464', 'no-email@mail.com', '[{"topping":[],"sl":1,"id":"1400581409","instruction":""}]', '', '1433939400', 6.95, 0, 6, '2015-05-16 09:37:08', '2015-05-16 09:37:08', 0, 'xdjdjdj', NULL, '004999010640000', 'pay on delivery', 0, NULL, NULL),
(88, 'jdjdjd', '98888', 'no-email@mail.com', '[{"topping":[],"sl":1,"id":"1400581409","instruction":""}]', '', '1433939400', 6.95, 0, 4, '2015-05-16 09:46:24', '2015-05-16 09:46:24', 0, '17 phhhdjjdj', NULL, '004999010640000', 'pay on delivery', 0, NULL, NULL),
(89, 'Pham Manh Cuong', '0912312308', '', '[{"topping":[],"sl":1,"id":"1400581409","instruction":""}]', '', '1433939400', 6.95, 0, 6, '2015-05-16 09:59:46', '2015-05-16 09:59:46', 0, '17 Phung Chi Kien', 36, NULL, 'pay on delivery', 0, NULL, NULL),
(90, 'pjam manh cuong', '09232308', 'no-email@mail.com', '[{"topping":[],"sl":1,"id":"1400581409","instruction":""},{"topping":[],"sl":1,"id":"1394421159","instruction":""}]', '', '1433939400', 8.95, 0, 6, '2015-05-16 10:02:40', '2015-05-16 10:02:40', 0, '17 phung chi kien', NULL, '004999010640000', 'pay on delivery', 2, NULL, NULL),
(91, 'Pham Manh Cuong', '0912312308', '', '[{"topping":[],"sl":1,"id":"1400581409","instruction":""}]', '', '1433939400', 6.95, 0, 4, '2015-05-16 10:27:48', '2015-05-16 10:27:48', 1, '17 Phung Chi Kien', 37, NULL, 'pay on delivery', 2, NULL, NULL),
(92, 'Pham Manh Cuong', '0912312308', '', '[{"topping":[],"sl":1,"id":"1400581409","instruction":""},{"topping":[],"sl":1,"id":"1394421159","instruction":""}]', '', '1433939400', 8.95, 0, 6, '2015-05-16 10:37:52', '2015-05-16 10:37:52', 1, 'Tu Ky Hai Duong', 37, NULL, 'pay on delivery', 2, NULL, NULL),
(93, 'uaz', '93507060', 'no-email@mail.com', '[{"id":"1397528834","sl":5,"topping":[{"1398045322":"1398065836"},{"1397879078":"1398067719"}],"instruction":""},{"id":"1400581409","sl":5,"topping":[],"instruction":""},{"id":"1394445723","sl":6,"topping":[{"1397879375":"1397883341"}],"instruction":""}]', '', '1433939400', 78.75, 0, 6, '2015-05-16 10:54:42', '2015-05-16 10:54:42', 1, 'tedt', NULL, '359878060694482', 'pay on delivery', 2, NULL, NULL),
(94, 'Pham Manh Cuong', '0912312308', '', '[{"topping":[],"sl":1,"id":"1400581409","instruction":""}]', '', '1433939400', 6.95, 0, 4, '2015-05-16 11:08:14', '2015-05-16 11:08:14', 0, 'Tu Ky Hai Duong', 37, NULL, 'pay on delivery', 0, NULL, NULL),
(95, 'Nguyen van ha', '091234688', 'no-email@mail.com', '[{"topping":[],"sl":1,"id":"1400581409","instruction":""},{"topping":[],"sl":1,"id":"1394421159","instruction":""},{"topping":[],"sl":1,"id":"1394445723","instruction":""}]', '', '1433939400', 10.45, 0, 5, '2015-05-18 03:28:34', '2015-05-18 03:28:34', 1, 'Nam Truc Nam Dinh', NULL, '004999010640000', 'pay on delivery', 0, NULL, NULL),
(96, 'Lucas Simonini', '11980614377', '', '[{"topping":[],"sl":1,"id":"1394421159","instruction":""},{"topping":[],"sl":1,"id":"1394445723","instruction":""}]', '', '1433939400', 3.5, 0, 4, '2015-05-18 16:24:16', '2015-05-18 16:24:16', 0, 'Av. Giovanni Gronchi, 4381. Apto 39', 27, NULL, 'pay on delivery', 0, NULL, NULL),
(97, 'Pham Manh Cuong', '0912312308', 'email@gmail.com', '[{"id":"1400581409","instruction":"","sl":"1"}]', '', '1433939400', 6.95, 0, 4, '2015-05-19 06:39:22', '2015-05-19 06:39:22', 0, 'Ggg', 36, NULL, 'paypal', 0, NULL, NULL),
(98, 'Pham Manh Cuong', '0912312308', 'email@gmail.com', '[{"id":"1400581409","instruction":"","sl":"1"}]', '', '1433939400', 6.95, 0, 6, '2015-05-19 06:40:01', '2015-05-19 06:40:01', 0, 'Janshsh', 36, NULL, 'pay on delivery', 0, NULL, NULL),
(99, 'Pham Manh Cuong', '0912312308', 'email@gmail.com', '[{"id":"1400581409","instruction":"","sl":"1"}]', '', '1433939400', 6.95, 0, 4, '2015-05-19 06:40:28', '2015-05-19 06:40:28', 0, 'Babahs', 36, NULL, 'bank transfer', 0, NULL, NULL),
(101, 'sd', '222', 'no-email@mail.com', '[{"id":"1394445794","sl":6,"topping":[{"1397879375":"1397883341"}],"instruction":""},{"id":"1397466338","sl":1,"topping":[],"instruction":""},{"id":"1397466530","sl":1,"topping":[],"instruction":""},{"id":"1397467644","sl":7,"topping":[],"instruction":""}]', '', '1433939400', 25, 0, 6, '2015-05-23 05:41:40', '2015-05-23 05:41:40', 0, 'dff', NULL, '359878060694482', 'pay on delivery', 0, NULL, NULL),
(102, 'w', '12', 'no-email@mail.com', '[{"id":"1397528834","sl":5,"topping":[{"1398045322":"1398065257"}],"instruction":""},{"id":"1397466338","sl":1,"topping":[],"instruction":""},{"id":"1397466530","sl":1,"topping":[],"instruction":""}]', '', '1433939400', 38.4, 0, 6, '2015-05-23 14:20:56', '2015-05-23 14:20:56', 0, 'qw', NULL, '359878060694482', 'pay on delivery', 0, NULL, NULL),
(103, 'Pham manh cuong', '0912312308', 'no-email@mail.com', '[{"topping":[],"sl":1,"id":"1394421159","instruction":""},{"topping":[],"sl":1,"id":"1397528834","instruction":""}]', '', '1433939400', 9, 0, 4, '2015-05-25 07:15:25', '2015-05-25 07:15:25', 40, '17 phung chi kien', NULL, '351904051342317', 'pay on delivery', 41, NULL, NULL),
(104, 'Pham Demo', '0912312305', 'no-email@mail.com', '[{"topping":[],"sl":1,"id":"1394421159","instruction":""},{"topping":[],"sl":2,"id":"1397528834","instruction":""}]', '', '1433939400', 16, 0, 4, '2015-05-25 07:44:04', '2015-05-25 07:44:04', 40, '17 phuny chi kien', NULL, '351904051342317', 'pay on delivery', 41, NULL, NULL),
(105, 'Nguyen Ha Ann  ', '12345678901', '', '[{"topping":[],"sl":6,"id":"1397529821","instruction":""}]', '', '1433939400', 9, 0, 4, '2015-06-05 10:34:33', '2015-06-05 10:34:33', 0, '17 Phung Chi Kien', 2, NULL, 'pay on delivery', 0, NULL, NULL),
(106, 'Lucas Simonini', '11980614377', 'simonini.lucas0@gmail.com', '[{"cookingMethod":"1398140077","id":"1397529560","topping":[],"panini":"false","sl":"6","instruction":""}]', '', '1433939400', 10.8, 0, 6, '2015-06-05 14:10:18', '2015-06-05 14:10:18', 0, '', 27, NULL, 'pay on delivery', 0, NULL, NULL),
(107, 'test', '3558', 'no-email@mail.com', '[{"topping":[],"sl":1,"id":"1431519996","instruction":""}]', '', '1433939400', 5, 0, 4, '2015-06-08 17:52:14', '2015-06-08 17:52:14', 1, 'ygu', NULL, '353106067589851', 'pay on delivery', 2, NULL, NULL),
(108, 'cuong', '12356', 'no-email@mail.com', '[{"topping":[],"sl":2,"id":"1400581409","instruction":""}]', '', '1433939400', 13.9, 0, 6, '2015-06-10 04:04:09', '2015-06-10 04:04:09', 0, '17', NULL, '359149055000014', 'pay on delivery', 0, NULL, NULL),
(109, 'Cuong', '000', 'no-email@mail.com', '[{"id":"1400581409","instruction":"","sl":"2"}]', '', '1433939400', 13.9, 0, 1, '2015-06-10 05:00:11', '2015-06-10 05:00:11', 0, '111', NULL, '', 'pay on delivery', 0, NULL, NULL),
(110, 'Pham Manh Cuong', '0912312308', '', '[{"topping":[],"sl":1,"id":"1400581409","instruction":""}]', '', '1433939400', 6.95, 0, 4, '2015-06-10 09:08:44', '2015-06-10 09:08:44', 0, 'Tu Ky Hai Duong', 37, NULL, 'pay on delivery', 0, NULL, NULL),
(111, 'Nguyen Ha Anh', '12345678901', 'fruity.haanh@gmail.com', '[{"id":"1400581409","instruction":"","sl":"1"}]', '', '1433939400', 6.95, 0, 1, '2015-06-10 09:30:00', '2015-06-10 09:30:00', 0, 'Hanoi', 44, NULL, 'pay on delivery', 44, 1, 1),
(114, 'Waiter', '01234124057', 'fruity.waiter@gmail.com', '[{"id":"1400581409","instruction":"","sl":"1"}]', '', '1', 6.95, 0, 4, '2015-06-10 12:12:44', '2015-06-10 12:12:44', 0, '4', 44, NULL, 'pay on delivery', 0, 4, 1),
(115, 'Waiter1', '01234124057', 'fruity.waiter@gmail.com', '[{"id":"1400581409","instruction":"","sl":"1"}]', '', '1', 6.95, 0, 4, '2015-06-10 12:18:06', '2015-06-10 12:18:06', 0, '4', 44, NULL, 'pay on delivery', 0, 4, 1),
(118, 'Pham Manh Cuong (T1.1)', '', '', '[{"id":"1400581409","instruction":"","sl":"1"}]', '', '1433953179', 6.95, 0, 4, '2015-06-10 16:19:39', '2015-06-10 16:19:39', 0, '4', 44, NULL, 'pay on delivery', 0, 1, 1433953179),
(119, 'Pham Manh Cuong (T1.1)', '', '', '[{"id":"1400581409","instruction":"","sl":"1"}]', '', '1433953494', 6.95, 0, 4, '2015-06-10 16:24:53', '2015-06-10 16:24:53', 0, '4', 44, NULL, 'pay on delivery', 0, 1, 2),
(120, 'Cuong (T1.1)', '', '', '[{"id":"1400581409","instruction":"","sl":"1"}]', '', '1433956374', 6.95, 0, 4, '2015-06-10 17:12:53', '2015-06-10 17:12:53', NULL, '', 44, NULL, 'pay on delivery', NULL, 1, 1),
(121, 'Cuong (T1.1)', '', '', '[{"cookingMethod":"1398140077","id":"1394421159","topping":[],"panini":"false","sl":"1","instruction":""}]', '', '1433956410', 2, 0, 4, '2015-06-10 17:13:30', '2015-06-10 17:13:30', 40, '', 44, NULL, 'pay on delivery', 41, 1, 1),
(122, 'Cuong Den (T1.1)', '', '', '[{"id":"1400581409","instruction":"","sl":"1"}]', '', '1434005989', 6.95, 0, 4, '2015-06-11 06:59:48', '2015-06-11 06:59:48', NULL, '', 44, NULL, 'pay on delivery', NULL, 1, 1),
(123, 'T1.1. Client', '', '', '[{"id":"1397528834","instruction":"note","sl":"1"},{"id":"1398067068","instruction":"","sl":"1"}]', '', '1434079447', 17, 0, 1, '2015-06-12 03:24:06', '2015-06-12 03:24:06', 0, '', 44, NULL, 'pay on delivery', 0, 1, 4),
(126, 'T1.3. Huy', '', '', '[{"topping":[],"sl":1,"id":"1400581409","instruction":""}]', '', '1434118665', 6.95, 0, 1, '2015-06-12 14:17:45', '2015-06-12 14:17:45', NULL, '', 44, NULL, 'pay on delivery', 44, 3, 1),
(127, 'T1.1. Pham Manh Cuong', '0912312308', '', '[{"topping":[],"sl":1,"id":"1400581409","instruction":""}]', '', '1431676542104', 6.95, 0, 4, '2015-06-13 02:28:46', '2015-06-13 02:28:46', NULL, '17 Phung Chi Kien', 36, NULL, 'pay on delivery', NULL, 1, 4),
(128, 'T1.1. Pham Manh Cuong', '0912312308', '', '[{"topping":[],"sl":1,"id":"1400581409","instruction":""}]', '', '1431676542104', 6.95, 0, 4, '2015-06-13 03:25:21', '2015-06-13 03:25:21', NULL, '17 Phung Chi Kien', 36, NULL, 'pay on delivery', 2, 1, 4),
(129, 'T1.1. Nguyen Van Ha', '0912312308', '', '[{"topping":[],"sl":1,"id":"1400581409","instruction":""}]', '', '1431676542104', 6.95, 0, 5, '2015-06-13 09:01:45', '2015-06-13 09:01:45', 1, '17 Phung Chi Kien', 44, NULL, 'pay on delivery', 1, 1, 4),
(136, 'phammamj uclv', '0912312308', 'no-email@mail.com', '[{"topping":[],"sl":1,"id":"1400581409","instruction":""},{"topping":[],"sl":1,"id":"1394421159","instruction":""},{"topping":[],"sl":1,"id":"1394421159","instruction":"mia"}]', '', '1434188197', 10.95, 0, 4, '2015-06-13 09:38:56', '2015-06-13 09:38:56', NULL, 'kfkfkf', NULL, '004999010640000', 'pay on delivery', NULL, NULL, NULL),
(137, 'phammamj uclv', '0912312308', 'no-email@mail.com', '[{"topping":[],"sl":1,"id":"1400581409","instruction":""},{"topping":[],"sl":1,"id":"1394421159","instruction":""},{"topping":[],"sl":1,"id":"1394421159","instruction":"mia"}]', '', '1434188197', 10.95, 0, 4, '2015-06-13 09:39:04', '2015-06-13 09:39:04', NULL, 'kfkfkf', NULL, '004999010640000', 'pay on delivery', NULL, NULL, NULL),
(138, 'T1.1. Hhh', '5555', '', '[{"id":"1400581409","instruction":"","sl":"1"}]', '', '1434188342', 6.95, 0, 4, '2015-06-13 09:39:04', '2015-06-13 09:39:04', 0, '', 44, NULL, 'pay on delivery', 0, 1, 3),
(139, 'T1.1. Waiter1', '5555', '', '[{"id":"1400581409","instruction":"","sl":"1"},{"id":"1397528834","instruction":"","sl":"1"},{"id":"1397528834","instruction":"","sl":"1"}]', '', '1434188398', 20.95, 0, 4, '2015-06-13 09:39:58', '2015-06-13 09:39:58', 0, '', 44, NULL, 'pay on delivery', 0, 1, 1),
(140, 'phammamj uclv', '0912312308', 'no-email@mail.com', '[{"topping":[],"sl":1,"id":"1394421159","instruction":""},{"topping":[{"1397879078":"1398067719"},{"1397879375":"1398065565"}],"sl":1,"id":"1394421159","instruction":""}]', '', '1434188197', 4, 0, 4, '2015-06-13 09:40:48', '2015-06-13 09:40:48', NULL, 'kfkfkf', NULL, '004999010640000', 'pay on delivery', NULL, NULL, NULL),
(141, 'phammamj uclv', '0912312308', 'no-email@mail.com', '[{"topping":[{"1397879375":"1398065565"}],"sl":1,"id":"1394421159","instruction":""}]', '', '1434188197', 2, 0, 4, '2015-06-13 09:41:30', '2015-06-13 09:41:30', NULL, 'kfkfkf', NULL, '004999010640000', 'pay on delivery', NULL, NULL, NULL),
(142, 'T1.1. T1.1. Waiter1', '5555', '', '[{"id":"1397528834","instruction":"","sl":"1"}]', '', '1434188558', 7, 0, 4, '2015-06-13 09:42:38', '2015-06-13 09:42:38', 0, '', 44, NULL, 'pay on delivery', 0, 1, 1),
(143, 'phammamj uclv', '0912312308', 'no-email@mail.com', '[{"topping":[{"1397879375":"1398065565"}],"sl":1,"id":"1394421159","instruction":""}]', '', '1434188197', 2, 0, 4, '2015-06-13 09:43:16', '2015-06-13 09:43:16', NULL, 'kfkfkf', NULL, '004999010640000', 'pay on delivery', NULL, NULL, NULL),
(144, 'T1.2. T1.1. Hhh', '', '', '[{"topping":[],"sl":1,"id":"1400581409","instruction":""}]', '', '1434190709', 6.95, 0, 4, '2015-06-13 10:18:29', '2015-06-13 10:18:29', 0, '', 44, NULL, 'pay on delivery', 0, 2, 1),
(145, 'T1.4. Waiter1', '22222', '', '[{"id":"1397528834","instruction":"","sl":"1"},{"id":"1398067068","instruction":"","sl":"1"}]', '', '1434191148', 17, 0, 4, '2015-06-13 10:25:48', '2015-06-13 10:25:48', 0, '', 44, NULL, 'pay on delivery', 0, 4, 1),
(146, 'T1.4. T1.1. Pham Manh Cuong', '222222', '', '[{"id":"1397528834","instruction":"","sl":"1"},{"id":"1398067068","instruction":"","sl":"1"}]', '', '1434191244', 17, 0, 4, '2015-06-13 10:27:24', '2015-06-13 10:27:24', NULL, '', 44, NULL, 'pay on delivery', NULL, 4, 1),
(147, 'T1.2. T1.4. T1.1. Pham Manh Cuong', '', '', '[{"topping":[],"sl":2,"id":"1397528834","instruction":""},{"topping":[{"1397639385":"1398065836"},{"1398045322":"1398065903"},{"1397879375":"1398065565"}],"sl":1,"id":"1397528834","instruction":""},{"topping":[],"sl":1,"id":"1398067068","instruction":""}]', '', '1434191300', 31, 0, 4, '2015-06-13 10:28:21', '2015-06-13 10:28:21', NULL, '', 44, NULL, 'pay on delivery', NULL, 2, 12),
(148, 'T1.1) Cuong Ho', '', '', '[{"topping":[],"sl":1,"id":"1400581409","instruction":""}]', '', '1434191546', 6.95, 0, 4, '2015-06-13 10:32:27', '2015-06-13 10:32:27', 0, '', 44, NULL, 'pay on delivery', 0, 1, 1),
(149, 'T1.1) Cuong Ho', '', '', '[{"topping":[],"sl":1,"id":"1394421159","instruction":""}]', '', '1434191589', 2, 0, 4, '2015-06-13 10:33:10', '2015-06-13 10:33:10', 0, '', 44, NULL, 'pay on delivery', 0, 3, 1),
(158, 'T1.1) T1.1. Pham Manh Cuong', '', '', '[{"topping":[{"1397639385":"1398065836"},{"1398045322":"1398065903"},{"1397879375":"1398065565"},{"1397879078":"1398067708"}],"sl":1,"id":"1397528834","instruction":""}]', '', '1434192125', 7, 0, 4, '2015-06-13 10:43:03', '2015-06-13 10:43:03', NULL, '', 44, NULL, 'pay on delivery', NULL, 1, 1),
(159, 'T1.4) T1.4. T1.1. Pham Manh Cuong', '2222', '', '[{"id":"1397528834","instruction":"","sl":"1"},{"id":"1397528834","instruction":"","sl":"1"}]', '', '1434192291', 14, 0, 4, '2015-06-13 10:44:50', '2015-06-13 10:44:50', NULL, '', 44, NULL, 'pay on delivery', NULL, 4, 1),
(160, 'T1.1) T1.1. Pham Manh Cuong', '', '', '[{"topping":[{"1397639385":"1398065836"},{"1398045322":"1398065903"},{"1397879375":"1398065565"},{"1397879078":"1398067708"}],"sl":1,"id":"1397528834","instruction":""}]', '', '1434192125', 7, 0, 4, '2015-06-13 10:46:38', '2015-06-13 10:46:38', NULL, '', 44, NULL, 'pay on delivery', NULL, 1, 1),
(161, 'T1.1) T1.1. Pham Manh Cuong', '', '', '[{"toppings":[{"1397639385":"1398065836"},{"1398045322":"1398065903"},{"1397879375":"1398065565"},{"1397879078":"1398067708"}],"sl":1,"id":"1397528834","instruction":""}]', '', '1434192125', 7, 0, 4, '2015-06-13 10:46:51', '2015-06-13 10:46:51', NULL, '', 44, NULL, 'pay on delivery', NULL, 1, 1),
(162, 'T1.4) T1.4. T1.1. Pham Manh Cuong', '22222', '', '[{"id":"1397528834","instruction":"","sl":"1"}]', '', '1434192427', 7, 0, 4, '2015-06-13 10:47:06', '2015-06-13 10:47:06', NULL, '', 44, NULL, 'pay on delivery', NULL, 4, 1),
(163, 'T1.1) Pham Manh Cuong', '', '', '[{"toppings":[{"1397639385":"1398065836"},{"1398045322":"1398065903"},{"1397879375":"1398065565"},{"1397879078":"1398067708"}],"sl":1,"id":"1397528834","instruction":""}]', '', '1434192125', 7, 0, 4, '2015-06-13 10:48:39', '2015-06-13 10:48:39', NULL, '', 44, NULL, 'pay on delivery', NULL, 1, 1),
(167, 'T1.1) T1.1. Pham Manh Cuong', '', '', '[{"toppings":[{"1397639385":"1398065836"},{"1398045322":"1398065903"},{"1397879375":"1398065565"},{"1397879078":"1398067708"}],"sl":1,"id":"1397528834","instruction":""}]', '', '1434192125', 7, 0, 4, '2015-06-13 11:04:11', '2015-06-13 11:04:11', NULL, '', 44, NULL, 'pay on delivery', NULL, 1, 1),
(168, 'T1.1) T1.1. Pham Manh Cuong', '', '', '[{"toppings":[{"1397639385":"1398065836"},{"1398045322":"1398065903"},{"1397879375":"1398065565"},{"1397879078":"1398067708"}],"sl":1,"id":"1397528834","instruction":""}]', '', '1434192125', 8.51, 0, 4, '2015-06-13 11:36:38', '2015-06-13 11:36:38', NULL, '', 44, NULL, 'pay on delivery', NULL, 1, 1),
(169, 'T1.3) Cuong', '', '', '[{"sl":1,"id":"1400581409","instruction":"","toppings":[]},{"sl":2,"id":"1397528834","instruction":"","toppings":[{"1397639385":"1398067708"}]}]', '', '1434209107', 21.95, 0, 4, '2015-06-13 15:25:07', '2015-06-13 15:25:07', 0, '', 44, NULL, 'pay on delivery', 2, 3, 2),
(170, 'Joel', '12584863', 'no-email@mail.com', '[{"sl":1,"id":"1397528834","instruction":"sem a\\u00e7\\u00facar\\n","toppings":[{"1397879078":"1398067719"}]}]', '', '1434239303', 7.01, 0, 5, '2015-06-13 23:52:23', '2015-06-13 23:52:23', 1, 'Rua da entrega', NULL, '359651045927735', 'pay on delivery', 2, NULL, NULL),
(171, 'adriano', '123456', '', '[{"sl":1,"id":"1398134645","instruction":"","toppings":[]},{"sl":1,"id":"1398067068","instruction":"","toppings":[]},{"sl":1,"id":"1397528834","instruction":"","toppings":[]}]', '', '1434240006', 24, 0, 1, '2015-06-14 00:06:57', '2015-06-14 00:06:57', NULL, 'rua sa enteega', 46, NULL, 'pay on delivery', NULL, 0, 0),
(172, 'adriano', '123456', '', '[{"sl":1,"id":"1397528834","instruction":"","toppings":[]}]', '', '1434240006', 7, 0, 1, '2015-06-14 00:07:34', '2015-06-14 00:07:34', NULL, 'rua sa enteega', 46, NULL, 'pay on delivery', NULL, 0, 0),
(173, 'teste', '123456', '', '[{"sl":1,"id":"1398134645","instruction":"sem borda recheada","toppings":[{"1398045322":"1398065257"}]}]', '', '1434240765', 7, 0, 0, '2015-06-14 00:19:23', '2015-06-14 00:19:23', 0, 'rua', 46, NULL, 'pay on delivery', 0, 0, 0),
(174, 'teste', '123456', '', '[{"sl":1,"id":"1400581409","instruction":"salada","toppings":[]}]', '', '1434240765', 6.95, 0, 1, '2015-06-14 00:23:38', '2015-06-14 00:23:38', 0, 'rua', 46, NULL, 'pay on delivery', 2, 0, 0),
(175, 'teste', '123456', '', '[{"sl":1,"id":"1394445763","instruction":"","toppings":[]}]', '', '1434240765', 1.5, 0, 0, '2015-06-14 00:30:24', '2015-06-14 00:30:24', 0, 'rua', 46, NULL, 'pay on delivery', 0, 0, 0),
(176, 'ffh', '55455', 'no-email@mail.com', '[{"sl":1,"id":"1394421159","instruction":"","toppings":[]},{"sl":1,"id":"1394445723","instruction":"","toppings":[]},{"sl":1,"id":"1431519996","instruction":"","toppings":[]}]', '', '1434371986', 8.5, 0, 0, '2015-06-15 12:41:48', '2015-06-15 12:41:48', 0, 'hshfggdd', NULL, '353001060003549', 'pay on delivery', 0, NULL, NULL),
(177, 'T1.1) Pham Manh Cuong', '', '', '[{"id":"1397528834","sl":2,"toppings":[],"instruction":""}]', '', '1434386478', 14, 0, 4, '2015-06-15 16:41:19', '2015-06-15 16:41:19', 0, '', 44, NULL, 'pay on delivery', 2, 1, 1),
(178, 'Ho Cuong', '0932504886', 'no-email@mail.com', '[{"sl":2,"id":"1398067068","instruction":"","toppings":[{"1397639385":"1398067708"},{"1398045322":"1398065257"}]},{"sl":1,"id":"1394421159","instruction":"","toppings":[{"1397879078":"1398067697"}]}]', '', '1434599260', 23.01, 0, 4, '2015-06-18 03:50:00', '2015-06-18 03:50:00', 1, '17 Phung Chi Kien - Cau Giay - Hanoi', NULL, '000000000000000', 'pay on delivery', 2, NULL, NULL),
(179, 'asdf', 'asdfsaf', 'no-email@mail.com', '[{"toppings":[{"1398045322":"1398065814"},{"1397879375":"1398065565"}],"id":"1398134645","panini":"false","instruction":"","sl":"1"}]', '', '1434705480', 8, 0, 1, '2015-06-18 09:19:14', '2015-06-18 09:19:14', 0, 'asdfdsaf', NULL, '', 'bank transfer', 0, NULL, NULL),
(180, 'Pham Manh Cuong', '0912312308', 'admin@gmail.com', '[{"toppings":[{"1398045322":"1398065903"},{"1397639385":"1398067708"}],"id":"1398134645","panini":"false","instruction":"","sl":"1"},{"cookingMethod":"1398140077","id":"1397466338","toppings":[{"1397879078":"1398067697"}],"panini":"false","sl":"1","instruction":""}]', '', '1434620700', 9.21, 0, 4, '2015-06-18 09:45:25', '2015-06-18 09:45:25', 0, 'Hanoi', 37, NULL, 'pay on delivery', 1, NULL, NULL),
(181, 'T1.3) Cuong', '', '', '[{"toppings":[{"1397879375":"1397883341"}],"id":"1398134645","panini":"false","instruction":"","sl":"1"}]', '', '1434624644', 8, 0, 4, '2015-06-18 10:50:43', '2015-06-18 10:50:43', 0, '', 44, NULL, 'pay on delivery', 0, 3, 2),
(182, 'T1.3) Hieu', '', '', '[{"cookingMethod":"1398140077","id":"1397466338","toppings":[],"panini":"false","sl":"1","instruction":""}]', '', '1434625330', 1.7, 0, 4, '2015-06-18 11:02:09', '2015-06-18 11:02:09', 0, '', 44, NULL, 'pay on delivery', 0, 3, 1),
(183, 'Cuong Hy', '0932504886', 'no-email@mail.com', '[{"sl":1,"id":"1400581409","instruction":"","toppings":[]},{"sl":1,"id":"1394421159","instruction":"","toppings":[{"1397879078":"1398067697"}]}]', '', '1434946214', 8.96, 0, 0, '2015-06-22 04:11:55', '2015-06-22 04:11:55', 0, '17 Phung Chi Kien', NULL, '000000000000000', 'paypal', 0, NULL, NULL),
(184, 'Long2', '09325048861', '', '[{"sl":1,"id":"1400581409","instruction":"","toppings":[]}]', '', '1434965534', 6.95, 0, 6, '2015-06-22 09:51:10', '2015-06-22 09:51:10', 1, 'Hanoi1', 57, NULL, 'pay on delivery', 0, 0, 0),
(185, 'Hieu Ipod', '11111', 'no-email@mail.com', '[{"id":"1398134645","toppings":[],"sl":"1","instruction":"","panini":"false"}]', '', '1434999240', 7, 0, 2, '2015-06-22 18:53:54', '2015-06-22 18:53:54', 0, 'Qqqqq', NULL, 'hieu%20nguyen%E2%80%99s%20iPod', 'pay on delivery', 0, NULL, NULL),
(186, 'Hoa', '222888', 'no-email@mail.com', '[{"id":"1398067068","toppings":[],"sl":"1","instruction":"","panini":"false"}]', '', '1435003800', 10, 0, 0, '2015-06-22 20:06:50', '2015-06-22 20:06:50', 0, 'Iixxx', NULL, 'hieu nguyen’s iPod', 'pay on delivery', 0, NULL, NULL),
(187, 'Dthjj', '5555', 'no-email@mail.com', '[{"id":"1398067068","toppings":[],"sl":"1","instruction":"","panini":"false"}]', '', '1435435680', 10, 0, 0, '2015-06-22 20:08:25', '2015-06-22 20:08:25', 0, 'Ghụ', NULL, 'hieu%20nguyen%E2%80%99s%20iPod', 'pay on delivery', 0, NULL, NULL),
(188, 'Dthjj', '5555', 'no-email@mail.com', '[{"id":"1398067068","toppings":[],"sl":"1","instruction":"","panini":"false"}]', '', '1435435680', 10, 0, 0, '2015-06-22 20:10:41', '2015-06-22 20:10:41', 0, 'Ghụ', NULL, 'hieu%20nguyen%E2%80%99s%20iPod', 'pay on delivery', 0, NULL, NULL),
(189, 'Dthjj', '5555', 'no-email@mail.com', '[{"id":"1398067068","toppings":[],"sl":"1","instruction":"","panini":"false"}]', '', '1435435680', 10, 0, 0, '2015-06-22 20:12:09', '2015-06-22 20:12:09', 0, 'Ghụ', NULL, 'hieu%20nguyen%E2%80%99s%20iPod', 'pay on delivery', 0, NULL, NULL),
(190, 'Dthjj', '5555', 'no-email@mail.com', '[{"id":"1398067068","toppings":[],"sl":"1","instruction":"","panini":"false"}]', '', '1435435680', 10, 0, 0, '2015-06-22 20:14:53', '2015-06-22 20:14:53', 0, 'Ghụ', NULL, 'hieu%20nguyen%E2%80%99s%20iPod', 'pay on delivery', 0, NULL, NULL),
(191, 'Thjhcf', '225554', 'no-email@mail.com', '[{"id":"1398134645","toppings":[],"sl":"1","instruction":"","panini":"false"}]', '', '1435008060', 7, 0, 0, '2015-06-22 20:21:25', '2015-06-22 20:21:25', 0, 'Ghhuy', NULL, 'hieu%20nguyen%E2%80%99s%20iPod', 'pay on delivery', 0, NULL, NULL),
(192, 'Thjhcf', '225554', 'no-email@mail.com', '[{"id":"1398134645","toppings":[],"sl":"1","instruction":"","panini":"false"}]', '', '1435008060', 7, 0, 0, '2015-06-22 20:25:45', '2015-06-22 20:25:45', 0, 'Ghhuy', NULL, 'hieu%20nguyen%E2%80%99s%20iPod', 'pay on delivery', 0, NULL, NULL),
(193, 'Thjhcf', '225554', 'no-email@mail.com', '[{"id":"1398134645","toppings":[],"sl":"1","instruction":"","panini":"false"}]', '', '1435008060', 7, 0, 0, '2015-06-22 20:27:11', '2015-06-22 20:27:11', 0, 'Ghhuy', NULL, 'hieu%20nguyen%E2%80%99s%20iPod', 'pay on delivery', 0, NULL, NULL),
(194, 'Thjhcf', '225554', 'no-email@mail.com', '[{"id":"1398134645","toppings":[],"sl":"1","instruction":"","panini":"false"}]', '', '1435008060', 7, 0, 0, '2015-06-22 20:28:25', '2015-06-22 20:28:25', 0, 'Ghhuy', NULL, 'hieu%20nguyen%E2%80%99s%20iPod', 'pay on delivery', 0, NULL, NULL),
(195, 'Thjhcf', '225554', 'no-email@mail.com', '[{"id":"1398134645","toppings":[],"sl":"1","instruction":"","panini":"false"}]', '', '1435008060', 7, 0, 0, '2015-06-22 20:28:51', '2015-06-22 20:28:51', 0, 'Ghhuy', NULL, 'hieu%20nguyen%E2%80%99s%20iPod', 'pay on delivery', 0, NULL, NULL),
(196, 'Abc', '123', 'no-email@mail.com', '[{"id":"1398134645","toppings":[],"sl":"1","instruction":"","panini":"false"}]', '', '1435113780', 7, 0, 0, '2015-06-23 02:44:06', '2015-06-23 02:44:06', 0, 'Qưe', NULL, 'hieu%20nguyen%E2%80%99s%20iPod', 'pay on delivery', 0, NULL, NULL),
(197, 'Qqe', '123', 'no-email@mail.com', '[{"id":"1398134645","toppings":[],"sl":"1","instruction":"","panini":"false"}]', '', '1435027920', 7, 0, 0, '2015-06-23 02:52:44', '2015-06-23 02:52:44', 0, 'Qar', NULL, 'hieu%20nguyen%E2%80%99s%20iPod', 'pay on delivery', 0, NULL, NULL),
(198, 'Qqe', '123', 'no-email@mail.com', '[{"id":"1398134645","toppings":[],"sl":"1","instruction":"","panini":"false"}]', '', '1435027920', 7, 0, 0, '2015-06-23 02:52:52', '2015-06-23 02:52:52', 0, 'Qar', NULL, 'hieu%20nguyen%E2%80%99s%20iPod', 'pay on delivery', 0, NULL, NULL),
(199, 'Qqwe', '123', 'no-email@mail.com', '[{"id":"1398134645","toppings":[],"sl":"1","instruction":"","panini":"false"}]', '', '1435032000', 7, 0, 6, '2015-06-23 03:01:07', '2015-06-23 03:01:07', 0, 'Qưuu', NULL, 'hieu nguyen’s iPod', 'pay on delivery', 0, NULL, NULL),
(200, 'cuong', '09321', 'no-email@mail.com', '[{"sl":1,"id":"1400581409","instruction":"","toppings":[]},{"sl":1,"id":"1397528834","instruction":"","toppings":[{"1397639385":"1398067708"},{"1398045322":"1398065257"}]}]', '', '1435055948', 14.45, 0, 0, '2015-06-23 09:56:11', '2015-06-23 09:56:11', 0, 'chi kien', NULL, '359149055000014', 'bank transfer', 0, NULL, NULL),
(201, 'cuong', '0932504886', 'no-email@mail.com', '[{"sl":1,"id":"1398134645","instruction":"","toppings":[{"1397639385":"1398067708"}]},{"sl":1,"id":"1394421159","instruction":"","toppings":[]}]', '', '1435135821', 9.5, 0, 0, '2015-06-24 09:01:21', '2015-06-24 09:01:21', 0, 'ha noi', NULL, '359149055000014', 'pay on delivery', 0, NULL, NULL),
(202, 'Ho cuong', '0932504889', 'no-email@mail.com', '[{"sl":2,"id":"1394421159","instruction":"","toppings":[]},{"sl":1,"id":"1397528834","instruction":"hot","toppings":[{"1397639385":"1398067708"}]}]', '', '1435141945', 11.5, 0, 4, '2015-06-24 09:34:01', '2015-06-24 09:34:01', 1, 'Vietnam', NULL, '351904051342317', 'paypal', 2, NULL, NULL),
(203, 'T1.3) Hieu', '', '', '[{"sl":1,"id":"1398134645","instruction":"","toppings":[]}]', '', '1435138690', 7, 0, 4, '2015-06-24 09:38:12', '2015-06-24 09:38:12', 0, '', 44, NULL, 'pay on delivery', 0, 3, 1),
(204, 'Cuong', '0932504889', 'no-email@mail.com', '[{"toppings":[{"1397639385":"1398067708"}],"id":"1398134645","panini":"false","instruction":"Hot","sl":"1"},{"cookingMethod":"1398140077","id":"1394421159","toppings":[],"panini":"false","sl":"1","instruction":""}]', '', '1435290000', 9.5, 0, 4, '2015-06-25 03:41:28', '2015-06-25 03:41:28', 0, 'Hanoi, Vietnam', NULL, 'iPhone Simulator', 'paypal', 36, NULL, NULL),
(205, 'T1.1) Pham Manh Cuong', '', '', '[{"toppings":[],"id":"1398134645","panini":"false","instruction":"","sl":"1"}]', '', '1435203936', 7, 0, 4, '2015-06-25 03:45:33', '2015-06-25 03:45:33', 0, '', 44, NULL, 'pay on delivery', 2, 4, 1),
(206, 'T1.4) Nam', '', '', '[{"toppings":[],"id":"1398134645","panini":"false","instruction":"","sl":"1"}]', '', '1435205810', 7, 0, 4, '2015-06-25 04:16:47', '2015-06-25 04:16:47', 0, '', 44, NULL, 'pay on delivery', 36, 4, 1),
(207, 'T1.4) Cuong', '', '', '[{"toppings":[],"id":"1397528834","panini":"false","instruction":"","sl":"1"}]', '', '1435208531', 7, 0, 4, '2015-06-25 05:02:08', '2015-06-25 05:02:08', 0, '', 44, NULL, 'pay on delivery', 0, 4, 1),
(208, 'T1.4) Cuong', '', '', '[{"toppings":[],"id":"1397528834","panini":"false","instruction":"","sl":"1"}]', '', '1435208687', 7, 0, 4, '2015-06-25 05:04:43', '2015-06-25 05:04:43', 0, '', 44, NULL, 'pay on delivery', 0, 4, 1),
(209, 'T1.4) Cuong', '', '', '[{"toppings":[],"id":"1397528834","panini":"false","instruction":"","sl":"2"}]', '', '1435208796', 14, 0, 4, '2015-06-25 05:06:33', '2015-06-25 05:06:33', 0, '', 44, NULL, 'pay on delivery', 0, 4, 1),
(210, 'T1.4) Cuong', '', '', '[{"toppings":[],"id":"1398134645","panini":"false","instruction":"","sl":"1"}]', '', '1435209427', 7, 0, 4, '2015-06-25 05:17:04', '2015-06-25 05:17:04', 0, '', 44, NULL, 'pay on delivery', 0, 4, 2),
(211, 'T1.4) Cuong', '', '', '[{"toppings":[],"id":"1398067068","panini":"false","instruction":"","sl":"1"}]', '', '1435209576', 10, 0, 4, '2015-06-25 05:19:33', '2015-06-25 05:19:33', 0, '', 44, NULL, 'pay on delivery', 0, 4, 1),
(212, 'T1.4) Cuong', '', '', '[{"toppings":[],"id":"1398067068","panini":"false","instruction":"","sl":"1"}]', '', '1435209713', 10, 0, 4, '2015-06-25 05:21:50', '2015-06-25 05:21:50', 0, '', 44, NULL, 'pay on delivery', 0, 4, 1),
(213, 'T1.4) Cuong', '', '', '[{"toppings":[],"id":"1398067068","panini":"false","instruction":"","sl":"1"}]', '', '1435209834', 10, 0, 4, '2015-06-25 05:23:51', '2015-06-25 05:23:51', 0, '', 44, NULL, 'pay on delivery', 0, 4, 1),
(214, 'T1.4) Cuong', '', '', '[{"toppings":[],"id":"1398067068","panini":"false","instruction":"","sl":"1"}]', '', '1435210107', 10, 0, 4, '2015-06-25 05:28:24', '2015-06-25 05:28:24', 0, '', 44, NULL, 'pay on delivery', 0, 4, 1),
(215, 'T1.4) Cuong', '', '', '[{"toppings":[],"id":"1398067068","panini":"false","instruction":"","sl":"4"}]', '', '1435210181', 40, 0, 4, '2015-06-25 05:29:38', '2015-06-25 05:29:38', 0, '', 44, NULL, 'pay on delivery', 44, 4, 4),
(216, 'cuong', '0932504889', 'no-email@mail.com', '[{"sl":1,"id":"1398134645","instruction":"","toppings":[]}]', '', '1435210375', 7, 0, 4, '2015-06-25 05:35:33', '2015-06-25 05:35:33', 0, 'vietnam', NULL, '359149055000014', 'pay on delivery', 2, NULL, NULL),
(217, 'Cuong', '0932504889', 'no-email@mail.com', '[{"toppings":[{"1397639385":"1398067708"}],"id":"1398134645","panini":"false","instruction":"hot","sl":"2"},{"cookingMethod":"1398140077","id":"1394421159","toppings":[],"panini":"false","sl":"1","instruction":""}]', '', '1435218300', 17, 0, 4, '2015-06-25 07:39:24', '2015-06-25 07:39:24', 0, 'projectemplate', NULL, 'iPhone Simulator', 'paypal', 36, NULL, NULL),
(218, 'Cuong', '0932504889', 'no-email@mail.com', '[{"id":"1398134645","toppings":[{"1397639385":"1398067708"}],"sl":"1","instruction":"","panini":"false"},{"panini":"false","id":"1394421159","toppings":[],"sl":"1","instruction":"","cookingMethod":"1398140077"}]', '', '1435219920', 9.5, 0, 0, '2015-06-25 08:12:54', '2015-06-25 08:12:54', 0, 'Hanoi, Vietnam', NULL, 'hieu nguyen’s iPod', 'pay on delivery', 0, NULL, NULL),
(219, 'T1.2) Cuong', '', '', '[{"id":"1398067068","toppings":[],"sl":"1","instruction":"","panini":"false"}]', '', '1435220161', 10, 0, 0, '2015-06-25 08:16:00', '2015-06-25 08:16:00', 0, '', 44, NULL, 'pay on delivery', 0, 2, 1),
(220, 'T1.3) Hieu', '', '', '[{"panini":"false","id":"1394445763","toppings":[],"sl":"1","instruction":"","cookingMethod":"1398140077"}]', '', '1435220294', 1.5, 0, 0, '2015-06-25 08:18:57', '2015-06-25 08:18:57', 0, '', 44, NULL, 'pay on delivery', 0, 3, 2),
(221, 'T1.1) Linh', '', '', '[{"panini":"false","id":"1394445763","toppings":[],"sl":"1","instruction":"","cookingMethod":"1398140077"}]', '', '1435220391', 1.5, 0, 0, '2015-06-25 08:19:50', '2015-06-25 08:19:50', 0, '', 44, NULL, 'pay on delivery', 0, 1, 1),
(222, 'T1.2) Cuong', '', '', '[{"id":"1397528834","toppings":[],"sl":"1","instruction":"","panini":"false"}]', '', '1435220661', 7, 0, 2, '2015-06-25 08:24:20', '2015-06-25 08:24:20', NULL, '', 44, NULL, 'pay on delivery', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE IF NOT EXISTS `order_item` (
  `oi_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `oi_dish_id` int(10) unsigned NOT NULL,
  `oi_dish_quantity` int(10) unsigned NOT NULL,
  `oi_dish_price` double NOT NULL,
  `oi_order_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `oi_topping_price` double DEFAULT NULL,
  `oi_toppings` text COLLATE utf8_unicode_ci,
  `oi_cooking_method` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `oi_instruction` text COLLATE utf8_unicode_ci,
  `oi_is_panini` tinyint(1) NOT NULL,
  PRIMARY KEY (`oi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`oi_id`, `oi_dish_id`, `oi_dish_quantity`, `oi_dish_price`, `oi_order_id`, `oi_topping_price`, `oi_toppings`, `oi_cooking_method`, `oi_instruction`, `oi_is_panini`) VALUES
('003CAE99-BE5C-667D-57A7-7409C7C2A63F', 1394421159, 1, 2, '37', 0, '', '', '', 0),
('021200C3-9D32-BA77-835E-F29EDE66B1CF', 1400581409, 1, 6.95, '38', 0, '', '', '', 0),
('0272F1B6-28FB-7125-10A9-0E3D80210F5C', 1398067068, 1, 10, '213', 0, '', '', '', 0),
('042F71E1-1657-4076-06BA-708F2D7E58BA', 1398067068, 1, 10, '187', 0, '', '', '', 0),
('0466F0A4-D9F1-8A6F-41AC-91B69C93DC72', 1398134645, 1, 7, '179', 1, 'Mayonnaise  - Tasteless, Salt                   - Cooking oil ', '', '', 0),
('04F99BC3-2C62-0EEA-47FF-2F5FBBFAA1F1', 1394445723, 1, 1.5, '28', 0, '', '', '', 0),
('061F8870-6324-D47B-B104-8CCFC4A66E06', 1394445763, 1, 1.5, '37', 0, '', '', '', 0),
('06E860A8-9FE1-3D55-8CF1-2BBC55B6D2F4', 1398067068, 1, 10, '190', 0, '', '', '', 0),
('082457EB-A238-A8E1-F5C9-5577E08D552E', 1400581409, 1, 6.95, '99', 0, '', '', '', 0),
('0A95F6D8-48A4-6A63-0DC8-F7E0BFDA880D', 1397467644, 7, 1.8, '101', 0, '', '', '', 0),
('0B0E2AD1-9996-EB45-31D6-249C57ADCC9D', 1400581409, 1, 6.95, '86', 0, '', '', '', 0),
('0E1EE36A-3C1D-F0BE-55B0-8B4039E6BFD8', 1394421159, 1, 2, '96', 0, '', '', '', 0),
('0FCA5EAA-815D-A666-7DAA-41F70B16FFD3', 1400581409, 1, 6.95, '200', 0, '', '', '', 0),
('10209693-8015-9C0A-709D-6945AC741524', 1397528834, 1, 7, '208', 0, '', '', '', 0),
('119F463F-3DBB-5C2D-FBD3-C554E84BF403', 1397466530, 1, 1.7, '38', 0, '', '', '', 0),
('120E836C-1C74-A18D-01D5-267717F2C277', 1398067068, 1, 10, '171', 0, '', '', '', 0),
('12A926C1-312C-FBB0-A7BB-87C307F84E01', 1397467644, 1, 1.8, '38', 0, '', '', '', 0),
('12BFBF85-5696-001E-5B7D-8C9604CAF095', 1394421159, 1, 2, '183', 0.01, 'Sugar - White', '', '', 0),
('13C3FF13-42E3-E5A5-EC5A-5535127C1450', 1397529009, 1, 3, '65', 0, '', '', '', 0),
('14AED716-8DFE-0793-0151-388BF1421510', 1398134645, 1, 7, '191', 0, '', '', '', 0),
('15D1E3EB-41AA-255C-B425-C45EBE5E92FD', 1400581409, 1, 6.95, '67', 0, '', '', '', 0),
('15FFE909-D74F-E0B2-4773-6FA772097BB3', 1400581409, 1, 6.95, '139', 0, '', '', '', 0),
('166BB666-9BED-8C48-13DB-3B5DEE00AFEC', 1394445763, 6, 1.5, '35', 0, '', '', '', 0),
('171F2760-4466-2DD9-F8A0-407D070A0FDC', 1397529560, 1, 1.8, '38', 0, '', '', '', 0),
('177BE6AE-E811-2E4E-9126-705E07AC34A4', 1397466530, 1, 1.7, '102', 0, '', '', '', 0),
('17B17026-4E2E-9FDC-3B3B-57B0B1E6AF96', 1398134645, 1, 7, '218', 0.5, 'Mutard - Black', '', '', 0),
('17B8EF3B-4569-94D2-3DCD-61E73BEBA6E8', 1398134645, 1, 7, '173', 0, 'Mayonnaise  - Salty', '', 'sem borda recheada', 0),
('186B77AE-7342-1717-EA02-CA87779977B6', 1397529009, 1, 3, '34', 0, '', '', '', 0),
('189396FA-D2F0-30DF-B3D3-84FB12EFF745', 1394445723, 1, 1.5, '34', 0, '', '', '', 0),
('1951C66D-ADD7-43F3-D982-C9D0333A9F1C', 1398134645, 2, 7, '217', 0.5, 'Mutard - Black', '', 'hot', 0),
('1AAECDEB-B88C-7C68-FE67-29FA2896F78B', 1397528834, 1, 7, '159', 0, '', '', '', 0),
('1BE40EF9-BD5B-CEF7-F592-C10A015A7302', 1397528834, 1, 7, '103', 0, '', '', '', 0),
('1CFC1B5C-87CA-C318-EDA9-43AE1591C461', 1400581409, 1, 6.95, '95', 0, '', '', '', 0),
('1F4B9C99-12EB-1CD1-7F3B-1A8BA2F65A7D', 1400581409, 1, 6.95, '66', 0, '', '', '', 0),
('1FAD8615-2D14-48DA-82A6-E91B95EE02E0', 1394421159, 1, 2, '137', 0, '', '', 'mia', 0),
('207138BA-3CB7-2056-7E10-4C83C994A6B2', 1394445723, 1, 1.5, '38', 0, '', '', '', 0),
('20EA79CA-62C8-5646-8526-D9E432CC4943', 1397528834, 1, 7, '123', 0, '', '', 'note', 0),
('21ABE238-4A68-83F8-0D7F-E4ACF5B495DF', 1398067068, 1, 10, '38', 0, '', '', '', 0),
('22C81120-A00F-8812-D7E9-61B3EF07EF3D', 1394421159, 1, 2, '36', 0, '', '', 'this is great', 0),
('25127AE9-1E3A-45CE-BA30-2F4C212D9D22', 1397528834, 1, 7, '158', 0, '', '', '', 0),
('259BD382-0804-0954-D05A-A7964B1EAFD7', 1394421159, 1, 2, '121', 0, '', 'Hot', '', 0),
('26778C87-4768-C47C-2669-D8ADBF135383', 1397466005, 1, 1.5, '36', 0, '', '', 'this is great', 0),
('27FF612F-B145-5096-9CC0-8D37A8FBAB9E', 1394445723, 1, 1.5, '29', 0, '', '', '', 0),
('28E2BA63-4C5B-F450-74B3-4143ECCAC9E9', 1397528834, 2, 7, '147', 0, '', '', '', 0),
('2A53D231-42F1-AD3E-AEA9-5117955F34C9', 1400581409, 2, 6.95, '108', 0, '', '', '', 0),
('2B02C21A-0B8E-A13B-3FBF-21984D5D2400', 1394421159, 1, 2, '103', 0, '', '', '', 0),
('2C6B8665-E8B5-05A2-3762-FCB3ED290B4F', 1397529009, 1, 3, '38', 0, '', '', '', 0),
('2D3BFC18-884C-EC02-F47B-9E28168E7DD4', 1398067068, 1, 10, '39', 0, '', '', '', 0),
('2E477BEA-5128-F40A-0035-316042E0CE6A', 1394421159, 7, 2, '35', 0, '', '', '', 0),
('2F677D61-08E1-0412-4E75-8C852389231B', 1397466338, 1, 1.7, '101', 0, '', '', '', 0),
('30D599B8-F280-570D-3123-B102B76773E6', 1394421159, 1, 2, '140', 0, '', '', '', 0),
('317DB4BF-240F-CC56-8E86-F4C8A10C5560', 1397528834, 1, 7, '161', 0, '', '', '', 0),
('3206F5B1-E768-E431-CC5B-658F773120C1', 1431519996, 1, 5, '176', 0, '', '', '', 0),
('335A2A35-7ACB-4EA5-62DA-BC6C4CBA62DE', 1398134645, 1, 7, '185', 0, '', '', '', 0),
('33617CF1-0E36-C729-542E-764FBC2F6A27', 1397466530, 1, 1.7, '34', 0, '', '', '', 0),
('33EA2B1E-75ED-8B74-7FF3-81201C46CA21', 1397528923, 1, 3.3, '31', 0, '', '', '', 0),
('33FA1432-9C66-FB81-C869-21980053CAB6', 1400581409, 1, 6.95, '136', 0, '', '', '', 0),
('3413E96A-7F69-6058-2A84-4DA16819DF2B', 1397528834, 1, 7, '139', 0, '', '', '', 0),
('34B0B41B-3F89-8E5B-D70B-AED12ADD7774', 1400581409, 1, 6.95, '94', 0, '', '', '', 0),
('34B7582C-9FCD-F45A-4DA0-DCB364DFE1F8', 1397467644, 1, 1.8, '34', 0, '', '', '', 0),
('360932AE-8691-9954-863F-2C94590E48D0', 1400581409, 1, 6.95, '115', 0, '', '', '', 0),
('37398854-CA3E-23B7-24F8-D4B46888C952', 1398134645, 1, 7, '206', 0, '', '', '', 0),
('37B14211-9C8B-6250-078F-1ED31C5ED88A', 1397466338, 1, 1.7, '38', 0, '', '', '', 0),
('3A20BD72-E366-4675-B0E3-881E33F27C8B', 1400581409, 1, 6.95, '40', 0, '', '', '', 0),
('3C815549-1792-34A8-7A70-F1979A47D065', 1400581409, 1, 6.95, '30', 0, '', '', '', 0),
('3DF648A5-6FEE-904E-48CC-CF998B8246DC', 1398134645, 1, 7, '192', 0, '', '', '', 0),
('3E2A3074-F7CF-E3B3-3D78-914EBC942ED4', 1397528834, 1, 7, '145', 0, '', '', '', 0),
('3E61261B-2662-CC7A-E475-3738A81462B1', 1394445723, 1, 1.5, '96', 0, '', '', '', 0),
('3F0361C0-955A-E444-6686-DF1D50BF5A08', 1394421159, 1, 2, '38', 0, '', '', '', 0),
('406712EA-240F-F2FB-24C8-8E8DF7C5872B', 1400581409, 1, 6.95, '110', 0, '', '', '', 0),
('4175E2F3-0D3D-4C31-DE59-A28689D90A4E', 1397528834, 1, 7, '200', 0.5, 'Mutard - Black, Mayonnaise  - Salty', '', '', 0),
('42A79432-8A1F-DBA4-A55E-D9DDC558AC4A', 1398134645, 1, 7, '38', 0, '', '', '', 0),
('44F4562C-2FFB-EEDF-22C7-FBB1E49FBE11', 1400581409, 1, 6.95, '34', 0, '', '', '', 0),
('45E3FCBE-54E8-8E88-BCD7-AFEF51819348', 1400581409, 1, 6.95, '92', 0, '', '', '', 0),
('46CA41B3-EF6F-0A6F-1EDD-B2C709C41405', 1394445723, 1, 1.5, '74', 0, '', '', '', 0),
('4726C9F3-992C-61A8-4E5A-EB65E19B1C8F', 1398067068, 1, 10, '214', 0, '', '', '', 0),
('47A4D4C6-2BA8-EDC3-5B20-B360CF10FEEF', 1394421159, 1, 2, '104', 0, '', '', '', 0),
('47D9CAA1-D2F5-B36A-3AA5-D098EF175C9D', 1400581409, 1, 6.95, '184', 0, '', '', '', 0),
('47F5F3B8-B09E-A486-8432-D1CA625E87C8', 1397528834, 1, 7, '147', 0, '', '', '', 0),
('4810B531-458D-9C3B-7137-7FB174209D5F', 1398067068, 1, 10, '186', 0, '', '', '', 0),
('4844F8EB-9691-494F-5621-29DC772D335F', 1400581409, 1, 6.95, '87', 0, '', '', '', 0),
('4AE61F84-8E20-8899-340D-9861C95EF730', 1400581409, 1, 6.95, '144', 0, '', '', '', 0),
('4B5CE801-A10D-12E8-C10D-F8074B71BAF7', 1398067068, 1, 10, '212', 0, '', '', '', 0),
('4B7793C4-949A-51B6-46BA-EBF31585A61A', 1398134645, 1, 7, '39', 0, '', '', '', 0),
('4B9FFFF0-7430-B9C2-18B5-762360A42D13', 1400581409, 1, 6.95, '33', 0, '', '', '', 0),
('4C20CB62-663D-7201-5FB8-B93F3A3C727D', 1397528834, 1, 7, '163', 0, '', '', '', 0),
('4D10E408-9F11-092A-82EB-C2224B5ABEE8', 1400581409, 1, 6.95, '68', 0, '', '', '', 0),
('4D8C2185-3592-9109-E6FB-9BE93EB6C1B7', 1394445794, 1, 1.5, '38', 0, '', '', '', 0),
('4EB9E98E-93CF-9128-4AE1-1301FA29FDD7', 1397528834, 1, 7, '222', 0, '', '', '', 0),
('4F028F43-C7B4-BCED-5F54-7A69CC217D40', 1394421159, 1, 2, '29', 0, '', '', '', 0),
('4F8AC7EB-515E-05A7-3597-FBAC8EC5B1E4', 1397528834, 5, 7, '102', 0, '', '', '', 0),
('502F1FE6-FE3A-4D9E-201E-8525D9BE1B88', 1394445763, 1, 1.5, '36', 0, '', '', '', 0),
('5173BA42-4D0B-87EA-B411-3AD9E548C91C', 1398067068, 1, 10, '189', 0, '', '', '', 0),
('51AE3DDD-D01E-7D9D-A9E2-071499336664', 1394421159, 1, 2, '176', 0, '', '', '', 0),
('5270E274-E71B-19CA-A070-D0BD8D2D956F', 1398067068, 1, 10, '211', 0, '', '', '', 0),
('5300109D-25F8-505F-92DC-C80B29E84171', 1394421159, 1, 2, '39', 0, '', '', '', 0),
('538EF286-310E-2A3F-03C3-B6ABA86545E6', 1397528834, 1, 7, '202', 0.5, 'Mutard - Black', '', 'hot', 0),
('5400931F-6A9D-DDCA-0CCA-5A8A00BD8E08', 1394445763, 1, 1.5, '34', 0, '', '', '', 0),
('55794054-9878-734C-C2D7-6CA8353F251A', 1398067068, 1, 10, '188', 0, '', '', '', 0),
('56124F8C-32FC-0BB6-A1FE-7E901ED5EF3D', 1400581409, 1, 6.95, '118', 0, '', '', '', 0),
('5623B564-361E-BD32-79AB-3B40DF5E7C4D', 1394445723, 1, 1.5, '62', 0, '', '', '', 0),
('582B6C8B-E9DE-E7A2-4371-96594C331D33', 1400581409, 2, 6.95, '109', 0, '', '', '', 0),
('5A6FB733-4F72-3320-6ECE-8A1A1D934550', 1400581409, 1, 6.95, '47', 0, '', '', '', 0),
('5A97F7BA-E6C8-224C-DE9A-59837EA2BF5C', 1394445794, 1, 1.5, '37', 0, '', '', '', 0),
('5DB70AD9-3646-5CA3-4360-E97EFF472A3C', 1400581409, 1, 6.95, '127', 0, '', '', '', 0),
('5E05C13D-B790-CCB7-AA97-026B35BF2110', 1394421159, 1, 2, '178', 0.01, 'Sugar - White', '', '', 0),
('5FE49F2A-9A56-A9AE-CAE6-674EE3EBD08C', 1398067068, 1, 10, '35', 0, '', '', '', 0),
('61C1BA5B-15AC-F709-7122-B845424E41A7', 1397466530, 1, 1.7, '37', 0, '', '', '', 0),
('61D9CBDF-43FC-3E13-3A3A-24E9DB1B7377', 1394445723, 1, 1.5, '95', 0, '', '', '', 0),
('629724D4-C2AE-8180-28D6-CFAE65806CB7', 1400581409, 1, 6.95, '98', 0, '', '', '', 0),
('62A1A753-6C06-8CF6-545F-EC10E9759E16', 1400581409, 1, 6.95, '69', 0, '', '', '', 0),
('678970B9-122F-22B1-F795-A1AEDBB46F95', 1397528834, 1, 7, '139', 0, '', '', '', 0),
('685F8045-1A7E-88C4-3CC1-ECDFCAB29236', 1400581409, 1, 6.95, '90', 0, '', '', '', 0),
('68B1D98B-727D-D46C-B050-64406DA96C79', 1397529821, 6, 1.5, '105', 0, '', '', '', 0),
('6AD66996-6FDD-CDBA-2C75-D82BB427587A', 1397528923, 1, 3.3, '38', 0, '', '', '', 0),
('6AE06C6C-4A53-8E89-4FD0-828A903966BE', 1398134645, 1, 7, '210', 0, '', '', '', 0),
('6B1A6FE1-3594-C9D0-4EF2-DDB0C003DBEB', 1394421159, 1, 2, '64', 0, '', '', '', 0),
('716F3CBF-02A9-2E62-36AD-694D5C3F8D9A', 1394421159, 1, 2, '28', 0, '', '', '', 0),
('71FB3E74-B557-FF54-32F9-8FD8A7E8EA54', 1397528834, 1, 7, '159', 0, '', '', '', 0),
('720A88A4-35A1-6EE2-75CD-8D7E8B1E0F82', 1397528834, 1, 7, '146', 0, '', '', '', 0),
('721194A3-B52A-2039-82D5-97B4C24DD195', 1400581409, 1, 6.95, '48', 0, '', '', '', 0),
('73875D93-37BA-761E-75E0-92E4D88B82F0', 1398134645, 1, 7, '181', 1, 'Salt                   - Sugar', '', '', 0),
('73A121D0-FB53-9B31-BA5B-C95DDE770468', 1398134645, 1, 7, '195', 0, '', '', '', 0),
('745CDCFC-F8DA-F7FA-DE69-7425A8E92C26', 1394445763, 1, 1.5, '39', 0, '', '', '', 0),
('750D4822-1ED8-B693-9143-87ACECEF11F2', 1394445723, 1, 1.5, '28', 0, '', '', '', 0),
('75381753-A197-CC87-ACF1-B1F155221A13', 1400581409, 1, 6.95, '50', 0, '', '', '', 0),
('755CE12D-D2F2-DCFA-410B-BF0D5D20E332', 1394421159, 1, 2, '90', 0, '', '', '', 0),
('756BE734-34BE-609E-07A4-1B19D0546B2A', 1397529209, 1, 3.3, '65', 0, '', '', '', 0),
('760A223A-4558-3986-BC94-15B7907D599F', 1400581409, 1, 6.95, '32', 0, '', '', '', 0),
('76798A41-D364-B884-80E3-DE0F9355333D', 1400581409, 1, 6.95, '137', 0, '', '', '', 0),
('7746333C-5EA5-4D4B-08A4-1B11576DC8AC', 1400581409, 1, 6.95, '71', 0, '', '', '', 0),
('7789B361-5A2E-4BD3-F3F1-D882839CD8E7', 1397466530, 1, 1.7, '30', 0, '', '', '', 0),
('7957D798-9A7E-F374-414F-D8E2B3450147', 1394421159, 1, 2, '28', 0, '', '', '', 0),
('7A53E2A1-3DA1-5606-E3B3-60BA6ABEC7C1', 1397528834, 2, 7, '209', 0, '', '', '', 0),
('7AAE88B2-2A53-6704-3C24-DD0E407C1ACD', 1400581409, 1, 6.95, '97', 0, '', '', '', 0),
('80DD0B63-55F5-3EF7-C9D8-CD854AC0C60E', 1398067068, 4, 10, '215', 0, '', '', '', 0),
('824C3901-8980-F876-6DB9-7E8ECD6B4D07', 1394421159, 1, 2, '69', 0, '', '', '', 0),
('824E39C9-DA7C-2993-50EE-97BD0336A3F4', 1397528834, 1, 7, '38', 0, '', '', '', 0),
('831D1600-7DDC-F2A8-4F17-826225D1857E', 1400581409, 1, 6.95, '45', 0, '', '', '', 0),
('871A1CEF-8820-9A24-4B9A-13B40F5FE4AD', 1400581409, 1, 6.95, '138', 0, '', '', '', 0),
('88CE940B-155B-ED89-184F-7D0CB6E8D31D', 1394445723, 1, 1.5, '73', 0, '', '', '', 0),
('8AE66FF7-E650-C3FC-F8DB-C3C29A8F76DA', 1394445763, 1, 1.5, '221', 0, '', 'Hot', '', 0),
('8B039F38-B8DF-65AD-5160-3FAA59FBA526', 1431519996, 1, 5, '35', 0, '', '', '', 0),
('8B998D6D-1CF8-E973-804C-62FE44C7E696', 1397529009, 1, 3, '31', 0, '', '', '', 0),
('8CECA1C6-7884-9CF0-27D7-D3F6979A5200', 1398134645, 1, 7, '171', 0, '', '', '', 0),
('90B64613-739D-0775-630B-4207C4867657', 1394421159, 1, 2, '136', 0, '', '', 'mia', 0),
('91B741E6-E46F-0862-F287-A92C6BC47434', 1394445794, 1, 1.5, '34', 0, '', '', '', 0),
('91FEB175-534A-7618-46A3-8BC79312DA83', 1400581409, 1, 6.95, '89', 0, '', '', '', 0),
('920D6DE9-23AD-46D8-BC20-55A2BABA9023', 1394421159, 1, 2, '95', 0, '', '', '', 0),
('93BBEC27-303C-BF82-4D8A-D75B35B20ECC', 1400581409, 1, 6.95, '114', 0, '', '', '', 0),
('97546780-8AF5-42F0-DCEE-BA280DB8088A', 1394421159, 1, 2, '204', 0, '', 'Hot', '', 0),
('97CC9606-41AB-168C-2C0F-0763AE9288FF', 1397528834, 1, 7, '207', 0, '', '', '', 0),
('983E07D0-C5F0-D458-974F-F4ECB42BE1FC', 1400581409, 1, 6.95, '49', 0, '', '', '', 0),
('9892E0E1-E5DD-56AD-6690-FC9735FF1D2E', 1400581409, 1, 6.95, '91', 0, '', '', '', 0),
('9AF951F0-56C0-018E-C5DE-8AD4525D28FB', 1394421159, 1, 2, '71', 0, '', '', '', 0),
('9C44EBB3-171B-5C22-61D9-8F3C4F0CF29E', 1398134645, 1, 7, '203', 0, '', '', '', 0),
('9C5488D3-B00B-B1EB-06E8-4AEFD94AD8E3', 1397528834, 1, 7, '171', 0, '', '', '', 0),
('9C587A4B-5790-B7C8-9D87-4B4AE98FF16A', 1398067068, 1, 10, '147', 0, '', '', '', 0),
('9D39759E-4797-3954-3BF1-2B4A4E05BBB5', 1397528834, 1, 7, '167', 0, '8', '', '', 0),
('9D98BE47-99DC-65E1-9D09-9E82034B1923', 1400581409, 1, 6.95, '75', 0, '', '', '', 0),
('9DF33B89-F83A-22A9-5A30-C1B42CBB9A11', 1400581409, 1, 6.95, '29', 0, '', '', '', 0),
('9EC80BD8-DB38-FD33-8314-43740D1FE486', 1394421159, 1, 2, '76', 0, '', '', '', 0),
('9EFBEAB7-A920-69D7-3F96-DB845AF4F084', 1394421159, 2, 2, '202', 0, '', '', '', 0),
('A120A26B-76DE-4D9F-7C7C-5897059F90F3', 1397466530, 1, 1.7, '101', 0, '', '', '', 0),
('A14BC2D2-8135-13FD-AF8F-324B6ACF4EEA', 1398067068, 2, 10, '178', 0.5, 'Mutard - Black, Mayonnaise  - Salty', '', '', 0),
('A1AEFB13-DB33-926B-4D09-66C624A1499C', 1400581409, 1, 6.95, '169', 0, '', '', '', 0),
('A1BE1A58-09C2-FEC4-424D-B4B2A54268F0', 1400581409, 1, 6.95, '31', 0, '', '', '', 0),
('A3249883-DFAF-C17F-BE76-58C89A4B00AE', 1400581409, 1, 6.95, '74', 0, '', '', '', 0),
('A3BFEB8E-A98C-893C-5C7B-ADD9FD45F118', 1394445794, 1, 1.5, '35', 0, '', '', '', 0),
('A3C1CF96-F976-B92A-4AE7-8C5B07090683', 1394445723, 1, 1.5, '63', 0, '', '', 'ncnxnd', 0),
('A3D81CAD-B208-9595-F7D5-E03E2546B7D9', 1397528834, 1, 7, '39', 0, '', '', '', 0),
('A4CE91A4-7756-64B7-6D4F-ADB693C3444C', 1400581409, 1, 6.95, '88', 0, '', '', '', 0),
('A5427CB7-AF39-7123-A5B8-63DB62043896', 1394421159, 1, 2, '140', 0, '', '', '', 0),
('A59216D7-E018-2326-FDEF-3B606233F7CC', 1400581409, 1, 6.95, '46', 0, '', '', '', 0),
('A84DB509-EAB1-BEB6-EFF2-88F7B44D055C', 1397529704, 1, 2.5, '38', 0, '', '', '', 0),
('AADD08B0-DF25-1A74-DA8E-BE04D0F307FB', 1394421159, 1, 2, '149', 0, '', '', '', 0),
('AC7088B4-842E-9A35-B379-E01EF1B7B8EF', 1398134645, 1, 7, '204', 0.5, 'Mutard - Black', '', 'Hot', 0),
('ACD30A27-DE4C-F2F5-132E-855BD61EBD15', 1400581409, 1, 6.95, '85', 0, '', '', '', 0),
('ACF9E77A-374D-0C65-AA09-27480FDCBA23', 1394421159, 1, 2, '136', 0, '', '', '', 0),
('ADE52986-09FA-58D1-70B7-24822FA3DA79', 1400581409, 1, 6.95, '129', 0, '', '', '', 0),
('AF119BEE-4913-DF6F-F110-D12A8107D3B2', 1394445794, 1, 1.5, '36', 0, '', '', '', 0),
('AF444EC1-258A-4795-1025-C11A4C0B8809', 1398134645, 1, 7, '199', 0, '', '', '', 0),
('AF67644D-ED15-E1C2-3438-289608856A87', 1397528923, 1, 3.3, '30', 0, '', '', '', 0),
('AF70487E-EC6F-AC69-8B28-8B2CEAE3C949', 1394421159, 1, 2, '92', 0, '', '', '', 0),
('AF9A1B6A-ED29-9F2E-27A8-3FEE7D7E9535', 1397466338, 1, 1.7, '37', 0, '', '', '', 0),
('AFAB4BED-8B58-7F4F-199B-BCD529CD0CAD', 1397528834, 2, 7, '104', 0, '', '', '', 0),
('B45B5712-847E-AB5C-28D2-F0CD50ACC1AD', 1397528834, 1, 7, '160', 0, '', '', '', 0),
('B47A374A-2BD9-4AD3-990D-703C50AB7144', 1397466338, 1, 1.7, '102', 0, '', '', '', 0),
('B5AA9CAA-E33F-5F91-AD4B-358F94EA88FF', 1400581409, 1, 6.95, '148', 0, '', '', '', 0),
('B6555E39-9A13-C102-CC1A-FEE78956774E', 1397528834, 2, 7, '169', 0.5, 'Mutard - Black', '', '', 0),
('B911C409-942C-58D0-0FBE-DC6D0D605B1C', 1397466005, 1, 1.5, '38', 0, '', '', '', 0),
('B9B280D7-EEA3-19C9-3006-07E6DF0D4507', 1400581409, 5, 6.95, '93', 0, '', '', '', 0),
('BA2B596F-DBCE-7702-526A-99593B0954AB', 1394421159, 1, 2, '34', 0, '', '', '', 0),
('BB5943C1-C2FB-1DAB-8AB0-8E495006ACE6', 1397466005, 1, 1.5, '37', 0, '', '', '', 0),
('BD037418-DD20-811B-C9EC-E12B20BA926E', 1397528834, 1, 7, '172', 0, '', '', '', 0),
('BF3768AD-1856-BE98-1B7A-221622A75A05', 1394421159, 1, 2, '137', 0, '', '', '', 0),
('C0309818-EED3-000E-71CB-2CA687E050A6', 1397529821, 1, 1.5, '38', 0, '', '', '', 0),
('C155407F-AFE0-3ABD-6491-EB309EDBFCE7', 1394445723, 1, 1.5, '176', 0, '', '', '', 0),
('C3569A92-E7C9-1BFE-7527-FADB8BD643BE', 1394445723, 1, 1.5, '64', 0, '', '', '', 0),
('C498EC0D-4B9F-5DE7-3D5A-1CFE71969991', 1394445763, 1, 1.5, '175', 0, '', '', '', 0),
('C525F22C-86AF-6838-A339-13E97679DC2D', 1400581409, 1, 6.95, '37', 0, '', '', '', 0),
('C52A6169-DB51-EFFC-EDC0-2E3334FF77FA', 1398134645, 1, 7, '196', 0, '', '', '', 0),
('C608BD28-1016-CC72-3F81-884577F3E4ED', 1398067068, 1, 10, '219', 0, '', '', '', 0),
('C788C7B2-083B-6CC5-4F59-289DC6B7715F', 1400581409, 1, 6.95, '57', 0, '', '', '', 0),
('C8F53B29-F352-4401-9A66-2A32BBDBD66E', 1398134645, 1, 7, '197', 0, '', '', '', 0),
('CB45D74E-8994-AEC8-737C-2963D244A654', 1394421159, 1, 2, '70', 0, '', '', '', 0),
('CD17C13F-E087-541D-58B9-93E0E58ECAB4', 1397528834, 2, 7, '177', 0, '', '', '', 0),
('CD28D5FA-7154-30F3-E4FB-97E78D975C4D', 1398134645, 1, 7, '198', 0, '', '', '', 0),
('CD9154BD-75E7-8BA4-4B66-307EA299B03A', 1394445723, 1, 1.5, '37', 0, '', '', '', 0),
('CDC943A6-5154-3863-7FB6-7CC2B381D1D4', 1398134645, 1, 7, '34', 0, '', '', '', 0),
('D07D5232-84EC-D110-8065-B93474AC0D3D', 1397528834, 1, 7, '142', 0, '', '', '', 0),
('D1655437-0CBA-0B1D-94F4-832D02E5F3B5', 1394421159, 1, 2, '141', 0, '', '', '', 0),
('D212FD8C-750C-2A1B-F4E7-1F7409E40B54', 1400581409, 1, 6.95, '111', 0, '', '', '', 0),
('D25AE839-86E1-6DE4-2EC2-517CC886F34F', 1397528834, 6, 7, '34', 0, '', '', '', 0),
('D2A1FE1D-BD94-D3D7-6B5F-7F038B3DFA85', 1431519996, 1, 5, '107', 0, '', '', '', 0),
('D2E277AE-FFB7-A150-099B-F2F51073AE08', 1394421159, 1, 2, '72', 0, '', '', '', 0),
('D322FA7C-6876-0D24-5961-950883CDF5E1', 1397529560, 6, 1.8, '106', 0, '', 'Hot', '', 0),
('D3CCF881-4664-52F7-CD7D-B6603D14E390', 1394445794, 6, 1.5, '101', 0, '', '', '', 0),
('D3F734D5-07CE-82D5-DDAC-725E3164D164', 1394445723, 6, 1.5, '93', 0, '', '', '', 0),
('D5BD6A8B-91F1-DA1B-4133-579046A0B29E', 1397466005, 1, 1.5, '35', 0, '', '', '', 0),
('D72685A9-F5DE-2DDA-4E4D-1CE72FAE9569', 1400581409, 1, 6.95, '72', 0, '', '', '', 0),
('D8054BAC-9131-D9CB-A26E-4025462F07BC', 1394445794, 1, 1.5, '30', 0, '', '', '', 0),
('D8734F48-CBA7-74CA-A476-B14EA06C9205', 1394445723, 1, 1.5, '35', 0, '', '', '', 0),
('D9251F2C-DEA1-C73F-9E85-EA977649840F', 1398134645, 1, 7, '201', 0.5, 'Mutard - Black', '', '', 0),
('D9F6894E-8027-41ED-712B-BE07EB5854A1', 1397528834, 1, 7, '168', 1.51, 'Mutard - Sweet, Mayonnaise  - Sour, Salt                   - Cooking oil , Sugar - Black', '', '', 0),
('DB604A9F-CF23-A37D-8690-3CA568DE0DF4', 1400581409, 1, 6.95, '73', 0, '', '', '', 0),
('DBA665C3-EC30-065D-33F7-7309BC59418A', 1397528923, 1, 3.3, '34', 0, '', '', '', 0),
('DBC677F2-71CD-5D65-7304-2B0FC703861C', 1398067068, 1, 10, '123', 0, '', '', '', 0),
('DC239EAF-6EF3-CCB9-6697-9D241B6C4DA7', 1397466005, 1, 1.5, '34', 0, '', '', '', 0),
('DC44F3C5-B004-51FA-4D35-4A147B89F37E', 1400581409, 1, 6.95, '174', 0, '', '', 'salada', 0),
('DDD0E590-50CC-68D7-6309-F45A229267BB', 1394445763, 1, 1.5, '220', 0, '', 'Hot', '', 0),
('DDE75C79-DD50-9B3C-D1AA-F22C7550123D', 1394421159, 1, 2, '217', 0, '', 'Hot', '', 0),
('E21B9D00-AEDF-7803-369A-798EECB7FBDB', 1398134645, 1, 7, '205', 0, '', '', '', 0),
('E296B066-F3CE-950C-E5C3-1895287A5C72', 1398067068, 1, 10, '145', 0, '', '', '', 0),
('E2FFEAF4-3F83-4E91-5E51-1329278D01C4', 1400581409, 1, 6.95, '183', 0, '', '', '', 0),
('E31A587B-65B3-D6A5-3D15-5EF52A251393', 1400581409, 1, 6.95, '28', 0, '', '', '', 0),
('E32C8645-48B9-8F24-EF09-C519DA02EC6A', 1398067068, 1, 10, '146', 0, '', '', '', 0),
('E346908B-EAEC-09B3-18DD-6AD8FEFD097F', 1394421159, 1, 2, '143', 0, '', '', '', 0),
('E3F1D320-F2B0-2702-96F3-1DDD224483CC', 1400581409, 1, 6.95, '126', 0, '', '', '', 0),
('E4E5ED07-AF0C-6A78-9D19-2361D9E780BD', 1397466338, 1, 1.7, '34', 0, '', '', '', 0),
('E586A11F-1E55-7BE3-03EB-B9CA2C3DEBF4', 1398134645, 1, 7, '194', 0, '', '', '', 0),
('E5C0E5E3-1BD5-DF41-3E60-2C7F5D368AC8', 1397528834, 1, 7, '170', 0.01, 'Sugar - Gold', '', 'sem açúcar\n', 0),
('E5E826B5-0068-C714-2DF0-B83A5C70FDE8', 1394421159, 1, 2, '218', 0, '', 'Hot', '', 0),
('E85C94E3-7F64-1B08-471D-57E1203AE0BC', 1400581409, 1, 6.95, '120', 0, '', '', '', 0),
('E8DDC145-936E-723F-1026-E094965B32BD', 1397528834, 1, 7, '162', 0, '', '', '', 0),
('E9208AA2-73B3-C474-22E0-E552F81B5161', 1398134645, 1, 7, '216', 0, '', '', '', 0),
('EA113137-4C5F-D020-2506-3B7AA64B907E', 1398134645, 1, 7, '193', 0, '', '', '', 0),
('EA1370C5-436B-3491-AB00-948657276F19', 1400581409, 1, 6.95, '122', 0, '', '', '', 0),
('EA4A312C-C900-911B-DDAE-4D2D2644CD96', 1400581409, 1, 6.95, '119', 0, '', '', '', 0),
('EAD8CCEF-43F8-246C-6583-47FE5AF2FC82', 1397466338, 1, 1.7, '182', 0, '', 'Hot', '', 0),
('EBD3B2D1-DF9E-6D9D-780C-F050E69513E7', 1400581409, 1, 6.95, '128', 0, '', '', '', 0),
('EC705347-FD7B-164C-E5A8-ABEA762FE3A0', 1394445723, 1, 1.5, '36', 0, '', '', '', 0),
('EDD20BC2-2980-B9D4-FE72-462C38DDBFA8', 1398067068, 8, 10, '34', 0, '', '', '', 0),
('EE183305-9575-0840-5305-46A3F5F37225', 1397466338, 1, 1.7, '180', 0.01, 'Sugar - White', 'Hot', '', 0),
('EFF1817E-E93A-4CC4-C9CA-4A647BCD2FAB', 1431519996, 1, 5, '39', 0, '', '', '', 0),
('F0A40977-3C39-1A0D-1D8D-AF0562F96AE6', 1394421159, 1, 2, '40', 0, '', '', '', 0),
('F0B0F305-6529-D5CC-B19D-2E93D8165AB8', 1394421159, 1, 2, '63', 0, '', '', '', 0),
('F53FC204-F294-E507-7527-96B28B8E7D9C', 1397528834, 5, 7, '93', 0, '', '', '', 0),
('F6614AED-D27F-F9C7-62BD-E7E0E861FEB6', 1400581409, 1, 6.95, '70', 0, '', '', '', 0),
('F9D18AD9-C6F6-5F8F-CC4B-D4B9072FC606', 1394445723, 1, 1.5, '39', 0, '', '', '', 0),
('FA712ADE-67BB-A32C-5E89-3D7224575F3E', 1394445763, 1, 1.5, '38', 0, '', '', '', 0),
('FB45543B-C5E2-0CE5-4E1B-6CF4081B815D', 1394421159, 1, 2, '201', 0, '', '', '', 0),
('FFB7EAAC-69ED-B183-1F65-A88A17FEBEAD', 1398134645, 1, 7, '180', 0.5, 'Mayonnaise  - Sour, Mutard - Black', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `promotion`
--

CREATE TABLE IF NOT EXISTS `promotion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  `categoryId` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `startDate` varchar(255) DEFAULT NULL,
  `endDate` varchar(255) DEFAULT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `order_number` int(20) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `promotion`
--

INSERT INTO `promotion` (`id`, `image`, `categoryId`, `title`, `description`, `startDate`, `endDate`, `dateCreated`, `status`, `order_number`) VALUES
(1, '142987394275.jpg', 1397446507, 'Giam gia do uong 20%', 'Giam gia cac loai nuoc ngot: Coca, Sting, C2....', '2015-05-06', '2015-05-06', '2015-04-23 09:34:43', 1, 0),
(4, '142987392612.jpg', 1397446507, 'dsad', 'dada', '2015-04-24', '2015-04-29', '2015-04-24 11:11:58', 1, 0),
(5, '143175105273.jpg', 1397447704, 'Mien phi pizza cho nhan vien Fruity', 'I had an amazing experience with this team, there plus point is the response and the help you will get after you purchased the product, which is rare these days you get after u purchased it. I will give A++ for their support and the code quility , ', '2015-05-01', '2015-05-30', '2015-05-16 04:37:32', 1, 0),
(6, '143176200033.jpg', 1400581350, 'Anh Cuong dat giai chem gio cua nam', 'Ngon', '2015-05-29', '2015-05-31', '2015-05-16 07:40:00', 1, 1),
(7, '143176688614.jpg', 1397446507, 'Mien phi nuoc uong cho nhan vien Fruity', 'Thor is a 2011 American superhero film based on the Marvel Comics character of the same name, produced by Marvel Studios and distributed by Paramount Pictures.[a] It is the fourth installment in the Marvel Cinematic Universe. ', '2015-05-01', '2015-05-30', '2015-05-16 09:01:26', 1, 0),
(8, '143176701780.jpg', NULL, 'Khong duoc push', 'Sam Raimi first developed the concept of a film adaptation of Thor in 1991, but soon abandoned the project, leaving it in "development hell" for several years. ', '2015-05-01', '2015-06-06', '2015-05-16 09:03:37', 1, 0),
(9, '143176757837.jpeg', NULL, 'Check Icon', 'Sam Raimi first developed the concept of a film adaptation of Thor in 1991, but soon abandoned the project, leaving it in "development hell" for several years. ', '2015-05-01', '2015-06-06', '2015-05-16 09:12:58', 1, 0),
(10, '143191640338.jpg', 1400581350, 'New Promotion', 'New Promotion', '2015-05-01', '2015-05-31', '2015-05-18 02:33:23', 1, 0),
(12, '143387910563.png', 1400581350, 'Teste', 'AAAa', '2015-06-10', '2015-06-18', '2015-06-09 19:45:05', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ref_cooking`
--

CREATE TABLE IF NOT EXISTS `ref_cooking` (
  `rc_id` varchar(60) NOT NULL,
  `rc_cooking_id` varchar(60) NOT NULL,
  `rc_dest_id` varchar(60) NOT NULL,
  `rc_dest_type` varchar(30) NOT NULL,
  `rc_order` int(10) unsigned NOT NULL,
  PRIMARY KEY (`rc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ref_cooking`
--

INSERT INTO `ref_cooking` (`rc_id`, `rc_cooking_id`, `rc_dest_id`, `rc_dest_type`, `rc_order`) VALUES
('14A94A29-68DF-F112-54D3-79D773F32237', '1397639445', '1398047409', 'menu', 2),
('16472688-7925-73BE-7BC7-4AD24C8EC24A', '1398140090', '1397446507', 'menu', 3),
('180BE86A-3528-FE4B-15DD-68F0808423FF', '1398065257', '1398045322', 'topping', 2),
('23DC6226-A60B-A5F1-C881-E1B8D9B4E71E', '1398140077', '1397446507', 'menu', 1),
('2F0434E6-89EF-405D-F49F-A91BB6A1A5D4', '1398065257', '1398067647', 'topping', 2),
('3352354E-1377-BD12-5E72-61609C0E46C9', '1398140115', '1397446507', 'menu', 2),
('3EA48DEC-B743-5ACE-3090-166B5C7448BA', '1398067708', '1397639385', 'topping', 4),
('3FEFAD95-A9D8-4B1A-ED6C-D827F193610F', '1397883341', '1397879375', 'topping', 2),
('4B30B3E5-5E59-A9C8-5EF9-781589F56B78', '1398065903', '1397639385', 'topping', 3),
('500A3E93-0EF5-28A4-D70D-2E72C0BD53D2', '1397639422', '1400641518', 'menu', 1),
('5B426B40-B2CE-AD0C-E090-4AA6D740FE52', '1398067697', '1397879078', 'topping', 1),
('6648162F-91D0-0207-1FF6-83E4C9A56147', '1397639422', '1398047409', 'menu', 1),
('6E9BE785-01D4-AE0D-D192-3B515B772397', '1397639422', '1398046633', 'menu', 1),
('7D538C0F-A33B-6556-B5E0-8AEDFD53DAB5', '1398065814', '1397639385', 'topping', 2),
('7F324C09-F25B-069F-503F-10BF29B65A38', '1398065814', '1398045322', 'topping', 1),
('8C83C0F5-A264-697D-5BAD-C8B04EBBB9FB', '1397639459', '1398047409', 'menu', 3),
('9954AED6-CDE3-5908-6B19-8F156066AB44', '1398067719', '1397879078', 'topping', 3),
('9FBC5DB6-826C-78DD-98D2-BADBD814EB25', '1398065836', '1397639385', 'topping', 1),
('A3B24699-7A55-DE23-D39B-23A0186E4F52', '1398140077', '1400213710', 'menu', 2),
('B0911EB3-309B-FBED-E973-08042DD90273', '1397639422', '1400639788', 'menu', 1),
('BCD1C2C4-CD84-8B0C-B847-E1D9485BD6DE', '1398065565', '1397879375', 'topping', 1),
('BF9A2189-38C7-B58E-6D16-A2B86CB40F55', '1398065836', '1398045322', 'topping', 3),
('C3B3DDB1-DBAB-E6CD-058B-8F2AA248E109', '1397639459', '1400213710', 'menu', 1),
('E967BA0C-9B95-D240-5E97-C7EE5241AD5E', '1397639445', '1400639788', 'menu', 2),
('EFFDAEA7-B1D3-9978-2EA3-F87C198BEB4E', '1398065836', '1398067647', 'topping', 1),
('F237024E-52CF-7F75-C46E-6B0171B4FDEE', '1398067708', '1397879078', 'topping', 2),
('F81EBF9C-1223-4E8E-A95D-00516F84327F', '1397639445', '1400641518', 'menu', 2),
('F8732AE3-D564-39D9-9831-54449B8D64C1', '1398065903', '1398045322', 'topping', 4);

-- --------------------------------------------------------

--
-- Table structure for table `ref_relish`
--

CREATE TABLE IF NOT EXISTS `ref_relish` (
  `rr_id` varchar(60) NOT NULL,
  `rr_relish_id` varchar(60) NOT NULL,
  `rr_dest_id` varchar(60) NOT NULL,
  `rr_dest_type` varchar(30) NOT NULL,
  `rr_order` int(10) unsigned NOT NULL,
  PRIMARY KEY (`rr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ref_relish`
--

INSERT INTO `ref_relish` (`rr_id`, `rr_relish_id`, `rr_dest_id`, `rr_dest_type`, `rr_order`) VALUES
('025E6938-3CBC-E6DF-EE4D-D44AB2915817', '1397879375', '1398047409', 'menu', 2),
('1E04B3DA-F34B-6667-1AFA-F1E69E7AD114', '1397879078', '1400213710', 'menu', 1),
('1F7CF77B-B49D-C52D-5833-37914CF86AA4', '1397879078', '1426136228', 'menu', 1),
('2641EF38-8108-0C77-FD2B-003A85188755', '1398045322', '1400639788', 'menu', 2),
('35FF940C-2CA2-727D-0195-BF5903B3BC93', '1397879406', '1398046633', 'menu', 2),
('477996B8-6850-BD4C-4801-9A7B866343DB', '1397879375', '1400213710', 'menu', 2),
('4F080737-15B6-D78F-16F6-9BF02600B635', '1397639385', '1397447704', 'menu', 1),
('62F6B768-5604-6D8D-F977-D7FD3E047266', '1397639385', '1400641518', 'menu', 1),
('6FD660A5-52FC-B8D8-75D0-4624B8DD99C0', '1397879078', '1397446507', 'menu', 2),
('796EE03B-C003-E8AC-19BF-8E8EEECC3CB7', '1397879078', '1400639788', 'menu', 1),
('85ABB088-8553-1B62-990E-54CF24E8F571', '1398067647', '1398047409', 'menu', 4),
('9E2D0FED-D565-83E0-150E-A58340ACF337', '1397879375', '1397446507', 'menu', 2),
('B0D9EFCA-13EB-E3C3-A016-97C563A52B8C', '1398045322', '1398047409', 'menu', 3),
('CCF283E1-B665-F12F-C9AB-658BFCD80213', '1397879078', '1397447704', 'menu', 4),
('CF5288B9-DB3C-CF7E-3762-8685AF7D7BBD', '1397879375', '1400641518', 'menu', 2),
('D5824E5A-62B0-7B32-32B8-21BA88CDD96F', '1397639385', '1398047409', 'menu', 1),
('D5E681D2-9586-C4AA-395F-E8918B406E62', '1398045322', '1397447704', 'menu', 2),
('E43544E5-6486-4382-B755-2835605DFA51', '1397639385', '1398046633', 'menu', 1),
('F0CB7E52-1F17-2B24-EAF6-3AC56242ACDA', '1397879375', '1397447704', 'menu', 3);

-- --------------------------------------------------------

--
-- Table structure for table `relishes`
--

CREATE TABLE IF NOT EXISTS `relishes` (
  `relish_id` int(10) unsigned NOT NULL,
  `relish_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `relish_desc` text COLLATE utf8_unicode_ci,
  `relish_price` double DEFAULT NULL,
  `order_number` int(20) DEFAULT '0',
  PRIMARY KEY (`relish_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `relishes`
--

INSERT INTO `relishes` (`relish_id`, `relish_name`, `relish_desc`, `relish_price`, `order_number`) VALUES
(1397639385, 'Mutard', '', 0.5, 0),
(1397879078, 'Sugar', '', 0.01, 0),
(1397879375, 'Salt                  ', '', 1, 0),
(1398045322, 'Mayonnaise ', '', 0, 0),
(1398067647, 'Salad dressing', '', 5, 0),
(1400581594, 'Chicken', 'Add grilled chicked', 2.95, 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `setting_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `setting_value` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`setting_id`, `setting_key`, `setting_value`) VALUES
(1, 'SETTING_MAIL', '{"host":"smtp.gmail.com","account":"fruity.tester@gmail.com","password":"trollerlvlmax","port":"465","encryption":"tls"}'),
(2, 'SETTING_ADMIN_MAIL', 'trung@gmail.com'),
(3, 'SETTING_BANK_INFO', 'Bank info\r\n'),
(4, 'SETTING_GENERAL', '{"google_api_key":"AIzaSyA4bzJXAX23vKPQWnu-od6YzcEHiAnk6ak"}');

-- --------------------------------------------------------

--
-- Table structure for table `table_seats`
--

CREATE TABLE IF NOT EXISTS `table_seats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `occupied` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `order_number` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `table_seats`
--

INSERT INTO `table_seats` (`id`, `title`, `capacity`, `occupied`, `status`, `order_number`) VALUES
(1, 'T1.1', 5, 0, 1, 0),
(2, 'T1.2', 3, 1, 1, 1),
(3, 'T1.3', 6, 3, 1, 3),
(4, 'T1.4', 4, 4, 1, 4),
(5, 'T1.5', 7, 0, 1, 5);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
