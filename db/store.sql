-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2015 at 11:46 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT 'admin first name',
  `last_name` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT 'admin lastname',
  `email` varchar(120) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'email which is also the admins logon name - cannot be null',
  `password` varchar(15) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'encrypted admin password',
  `last_login` datetime DEFAULT NULL COMMENT 'date and time of last admin login.  -- should we keep a file log as well?',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`aid`),
  KEY `prim` (`aid`) USING BTREE,
  KEY `logon` (`email`,`password`) USING BTREE,
  KEY `for logon trace` (`first_name`,`last_name`,`last_login`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`aid`, `first_name`, `last_name`, `email`, `password`, `last_login`, `created_on`, `modified_on`) VALUES
(1, 'Peter', 'Richards', 'the.peter.richards@gmail.com', '', NULL, '2015-02-06 14:02:59', '2015-02-06 14:03:01');

-- --------------------------------------------------------

--
-- Table structure for table `carriers`
--

CREATE TABLE IF NOT EXISTS `carriers` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `Carrier` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'name of the carrier',
  PRIMARY KEY (`cid`),
  KEY `prim` (`cid`,`Carrier`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `carriers`
--

INSERT INTO `carriers` (`cid`, `Carrier`) VALUES
(1, 'UPS'),
(2, 'FedEx'),
(3, 'USPS'),
(4, 'Drone');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `active` int(11) DEFAULT '1' COMMENT 'defaults to 1 for active, 0 means we are disabling the active state of this category',
  `category` varchar(80) DEFAULT NULL COMMENT 'name of category (NOT PRODUCTS)',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `prim` (`id`) USING BTREE,
  KEY `show and where` (`active`,`category`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `active`, `category`, `created_on`, `modified_on`) VALUES
(1, 1, 'T-Shirts', '2015-02-06 14:07:25', '2015-02-06 14:07:27'),
(2, 1, 'Shoes', '2015-02-06 14:07:40', '2015-02-06 14:07:42'),
(3, 1, 'Cups', '2015-02-06 14:07:54', '2015-02-06 14:07:56'),
(4, 1, 'Fruits', '2015-02-06 14:08:07', '2015-02-06 14:08:10');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `oid` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(11) DEFAULT NULL COMMENT 'status of order:  pending, shipping, on carrier, delivered',
  `carrier_id` int(11) DEFAULT NULL COMMENT 'carrier id, table carriers will have fed ex, ups, etc.',
  `ship_name` varchar(50) NOT NULL,
  `ship_street` varchar(100) NOT NULL,
  `ship_street2` varchar(100) DEFAULT NULL,
  `ship_city` varchar(50) NOT NULL,
  `ship_state` varchar(2) DEFAULT NULL,
  `ship_zip` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'shipping zip. must be present',
  `bill_name` varchar(50) NOT NULL,
  `bill_street` varchar(100) NOT NULL,
  `bill_street2` varchar(100) DEFAULT NULL,
  `bill_city` varchar(50) NOT NULL,
  `bill_state` varchar(2) DEFAULT NULL,
  `bill_zip` varchar(10) NOT NULL,
  PRIMARY KEY (`oid`),
  KEY `prim` (`oid`) USING BTREE,
  KEY `statuscar` (`status`,`carrier_id`) USING BTREE,
  KEY `billing` (`bill_zip`) USING BTREE,
  KEY `shipping` (`ship_zip`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
  `phid` int(11) NOT NULL AUTO_INCREMENT,
  `prod_id` int(11) DEFAULT '0' COMMENT 'id of the product this belongs to',
  `sort` int(11) DEFAULT '0' COMMENT 'order the photo should show in, low to high. 0-9 type.',
  `file_path` varchar(300) DEFAULT NULL,
  `caption` varchar(150) DEFAULT NULL COMMENT 'caption or comment on photo',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`phid`),
  KEY `prim` (`phid`) USING BTREE,
  KEY `for filters` (`sort`,`modified_on`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`phid`, `prod_id`, `sort`, `file_path`, `caption`, `created_on`, `modified_on`) VALUES
(1, 1, 0, 'sweat-shirt_green.png', 'Green. Shirt. Yes.', '2015-02-09 00:00:00', '2015-02-09 00:00:00'),
(2, 2, 0, 't-shirt_red.png', 'No really, an ice cream scoop.', '2015-02-03 00:00:00', '2015-02-03 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `pivot_order-products`
--

CREATE TABLE IF NOT EXISTS `pivot_order-products` (
  `order_id` int(11) NOT NULL DEFAULT '0',
  `product_id` int(11) NOT NULL DEFAULT '0',
  `quantity` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`order_id`,`product_id`,`quantity`),
  KEY `main` (`order_id`,`product_id`,`quantity`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pivot_related_cats`
--

CREATE TABLE IF NOT EXISTS `pivot_related_cats` (
  `ref_category` int(11) NOT NULL DEFAULT '0',
  `rel_category` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ref_category`,`rel_category`),
  KEY `main` (`ref_category`,`rel_category`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pivot_related_prods`
--

CREATE TABLE IF NOT EXISTS `pivot_related_prods` (
  `ref_prod_id` int(11) NOT NULL DEFAULT '0',
  `rel_prod_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ref_prod_id`,`rel_prod_id`),
  KEY `main` (`ref_prod_id`,`rel_prod_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `catid` int(11) DEFAULT NULL,
  `inventory` int(11) DEFAULT '0' COMMENT 'simple inventory.  could be in sep table with inventory :: qty, order date, suplier....',
  `added_by` int(11) DEFAULT NULL COMMENT 'the admin who added this product',
  `price` decimal(10,2) DEFAULT '0.00' COMMENT 'price per unit',
  `taxable` int(11) DEFAULT '0' COMMENT 'true or false for taxable item',
  `product` varchar(200) DEFAULT NULL,
  `format` varchar(30) DEFAULT NULL COMMENT 'for comes in packs of 12, or 3 to a pack, or any type of unit',
  `description` text COMMENT 'long description of item.',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`pid`),
  KEY `main index` (`pid`) USING BTREE,
  KEY `cat` (`catid`) USING BTREE,
  KEY `added_date` (`added_by`,`created_on`) USING BTREE,
  KEY `for filtering` (`inventory`,`price`,`taxable`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `catid`, `inventory`, `added_by`, `price`, `taxable`, `product`, `format`, `description`, `created_on`, `modified_on`) VALUES
(1, 2, 13, 2, '24.99', 0, 'Upcycled Ninja Mask', NULL, 'Your very own ninja mask upcycled from discarded bike tires!', '2015-02-10 00:00:00', '2015-02-10 00:00:00'),
(2, 3, 5, 2, '3.13', 0, 'Ice Cream Scoop', NULL, 'Cast iron artisanal ice cream scoop. Yum. ', '2015-02-03 00:00:00', '2015-02-03 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
