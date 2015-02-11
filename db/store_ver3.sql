/*
 Navicat MySQL Data Transfer

 Source Server         : default
 Source Server Type    : MySQL
 Source Server Version : 50538
 Source Host           : localhost
 Source Database       : store

 Target Server Type    : MySQL
 Target Server Version : 50538
 File Encoding         : utf-8

 Date: 02/10/2015 16:24:22 PM
*/

SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `admins`
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `admins`
-- ----------------------------
BEGIN;
INSERT INTO `admins` VALUES ('1', 'Matt', 'McCullough', 'mlK/e6fJv4o1w', '12/qKCGKv.ZmE', null, '2015-02-10 12:04:57', '2015-02-10 12:04:57'), ('2', 'Kristy', 'Overton', 'kr5v/0gCIHo7M', '12/qKCGKv.ZmE', null, '2015-02-10 12:04:57', '2015-02-10 12:04:57'), ('3', 'Peter', 'Richards', 'thxWvrB88LT1o', '12/qKCGKv.ZmE', null, '2015-02-10 12:04:57', '2015-02-10 12:04:57');
COMMIT;

-- ----------------------------
--  Table structure for `carriers`
-- ----------------------------
DROP TABLE IF EXISTS `carriers`;
CREATE TABLE `carriers` (
  `carid` int(11) NOT NULL AUTO_INCREMENT,
  `Carrier` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'name of the carrier',
  PRIMARY KEY (`carid`),
  KEY `prim` (`carid`,`Carrier`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `carriers`
-- ----------------------------
BEGIN;
INSERT INTO `carriers` VALUES ('1', 'UPS'), ('2', 'FedEx'), ('3', 'USPS'), ('4', 'Drone');
COMMIT;

-- ----------------------------
--  Table structure for `categories`
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `active` int(11) DEFAULT '1' COMMENT 'defaults to 1 for active, 0 means we are disabling the active state of this category',
  `category` varchar(80) DEFAULT NULL COMMENT 'name of category (NOT PRODUCTS)',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`cid`),
  KEY `prim` (`cid`) USING BTREE,
  KEY `show and where` (`active`,`category`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `categories`
-- ----------------------------
BEGIN;
INSERT INTO `categories` VALUES ('1', '1', 'T-Shirts', '2015-02-06 14:07:25', '2015-02-06 14:07:27'), ('2', '1', 'Shoes', '2015-02-06 14:07:40', '2015-02-06 14:07:42'), ('3', '1', 'Cups', '2015-02-06 14:07:54', '2015-02-06 14:07:56'), ('4', '1', 'Fruits', '2015-02-06 14:08:07', '2015-02-06 14:08:10');
COMMIT;

-- ----------------------------
--  Table structure for `orders`
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `oid` int(11) NOT NULL AUTO_INCREMENT,
  `sessid` varchar(100) DEFAULT NULL COMMENT 'session id for this user''s shopping experience',
  `paid` int(1) DEFAULT '0',
  `status` int(1) DEFAULT '0' COMMENT 'status of order:  pending, shipping, on carrier, delivered',
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
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`oid`),
  KEY `prim` (`oid`) USING BTREE,
  KEY `statuscar` (`status`,`carrier_id`) USING BTREE,
  KEY `billing` (`bill_zip`) USING BTREE,
  KEY `shipping` (`ship_zip`) USING BTREE,
  KEY `sessid` (`sessid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `photos`
-- ----------------------------
DROP TABLE IF EXISTS `photos`;
CREATE TABLE `photos` (
  `phid` int(11) NOT NULL AUTO_INCREMENT,
  `main` int(11) DEFAULT '0',
  `prod_id` int(11) DEFAULT '0' COMMENT 'id of the product this belongs to',
  `sort` int(11) DEFAULT '0' COMMENT 'order the photo should show in, low to high. 0-9 type.',
  `file_path` varchar(300) DEFAULT NULL,
  `caption` varchar(150) DEFAULT NULL COMMENT 'caption or comment on photo',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`phid`),
  KEY `prim` (`phid`) USING BTREE,
  KEY `for filters` (`sort`,`modified_on`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `photos`
-- ----------------------------
BEGIN;
INSERT INTO `photos` VALUES ('1', '1', '1', '1', 't-shirt_green_sweat.png', 'Light cotton blend sweat shirt with pull strings and a beautiful pastel green color', '2015-02-09 21:01:46', '2015-02-09 21:01:49'), ('2', '0', '1', '2', 't-shirt_blue_yellow.png', 'Blue poly blend t-shirt with a bright yellow stripe in the ideal soccer style', '2015-02-09 21:02:41', '2015-02-09 21:02:44'), ('3', '0', '1', '3', 't-shirt_green.png', 'Green cotton blend t-shirt, pre-shrunk', '2015-02-09 21:03:33', '2015-02-09 21:03:35'), ('4', '0', '1', '4', 't-shirt_red.png', 'A bright red cotton t-shirt for easily seen joggers on those hard to see mornings', '2015-02-09 21:04:23', '2015-02-09 21:04:25'), ('5', '0', '1', '5', 't-shirt_salmon.png', 'A salmon colored tank top for this light and breezy days in the sun', '2015-02-09 21:05:50', '2015-02-09 21:05:52'), ('6', '1', '2', '1', 'cup_orange.png', 'A super strong BPA laden plastic cup. Guaranteed to choke a seal if left out in the ocean', '2015-02-10 14:40:17', '2015-02-10 14:40:19'), ('7', '0', '2', '2', 'cup_beer.png', 'The old standard! Beer in a can with a beer cozy.  get it while it lasts.  A sure fire classic at the next company picnic.', '2015-02-10 14:41:07', '2015-02-10 14:41:09');
COMMIT;

-- ----------------------------
--  Table structure for `pivot_order-products`
-- ----------------------------
DROP TABLE IF EXISTS `pivot_order-products`;
CREATE TABLE `pivot_order-products` (
  `order_id` int(11) NOT NULL DEFAULT '0',
  `product_id` int(11) NOT NULL DEFAULT '0',
  `quantity` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`order_id`,`product_id`,`quantity`),
  KEY `main` (`order_id`,`product_id`,`quantity`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `pivot_order-products`
-- ----------------------------
BEGIN;
INSERT INTO `pivot_order-products` VALUES ('1', '1', '3'), ('1', '2', '5');
COMMIT;

-- ----------------------------
--  Table structure for `pivot_related_cats`
-- ----------------------------
DROP TABLE IF EXISTS `pivot_related_cats`;
CREATE TABLE `pivot_related_cats` (
  `ref_category` int(11) NOT NULL DEFAULT '0',
  `rel_category` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ref_category`,`rel_category`),
  KEY `main` (`ref_category`,`rel_category`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `pivot_related_prods`
-- ----------------------------
DROP TABLE IF EXISTS `pivot_related_prods`;
CREATE TABLE `pivot_related_prods` (
  `ref_prod_id` int(11) NOT NULL DEFAULT '0',
  `rel_prod_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ref_prod_id`,`rel_prod_id`),
  KEY `main` (`ref_prod_id`,`rel_prod_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `pivot_related_prods`
-- ----------------------------
BEGIN;
INSERT INTO `pivot_related_prods` VALUES ('1', '2');
COMMIT;

-- ----------------------------
--  Table structure for `products`
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `catid` int(11) DEFAULT NULL,
  `inventory` int(11) DEFAULT '0' COMMENT 'simple inventory.  could be in sep table with inventory :: qty, order date, suplier....',
  `added_by` int(11) DEFAULT NULL COMMENT 'the admin who added this product',
  `price` decimal(10,0) DEFAULT '0' COMMENT 'price per unit',
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `products`
-- ----------------------------
BEGIN;
INSERT INTO `products` VALUES ('1', '1', '12', '1', '50', '1', 'Neon Shirtz', null, 'the best cotton blend shirts around', '2015-02-10 08:21:58', '2015-02-10 08:22:00'), ('2', '2', '10', '1', '24', '1', 'Super T', null, 'The nicest cotton blend', '2015-02-10 08:39:35', '2015-02-10 08:39:38');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
