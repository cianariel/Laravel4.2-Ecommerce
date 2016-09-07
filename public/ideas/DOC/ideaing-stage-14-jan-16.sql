-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.0.17-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table ideaingdb.medias
DROP TABLE IF EXISTS `medias`;
CREATE TABLE IF NOT EXISTS `medias` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `media_name` varchar(255) DEFAULT NULL,
  `media_type` varchar(255) DEFAULT NULL,
  `media_link` varchar(255) DEFAULT NULL,
  `is_hero_item` varchar(50) DEFAULT NULL,
  `mediable_id` int(11) DEFAULT NULL,
  `mediable_type` varchar(40) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- Dumping data for table ideaingdb.medias: ~14 rows (approximately)
DELETE FROM `medias`;
/*!40000 ALTER TABLE `medias` DISABLE KEYS */;
INSERT INTO `medias` (`id`, `media_name`, `media_type`, `media_link`, `is_hero_item`, `mediable_id`, `mediable_type`, `created_at`, `updated_at`) VALUES
	(6, 'lkj', 'img-link', 'http://dsf.com/234', NULL, 26, 'App\\Models\\Product', '2016-01-03 09:13:58', '2016-01-03 09:13:58'),
	(7, 'lkj', 'img-link', 'http://dsf.com/234', NULL, 26, 'App\\Models\\Product', '2016-01-03 09:14:02', '2016-01-03 09:14:02'),
	(8, 'lkj', 'img-link', 'http://dsf.com/234', NULL, 26, 'App\\Models\\Product', '2016-01-03 09:14:06', '2016-01-03 09:14:06'),
	(9, 'Kids', 'img-upload', 'file-max-limit-exit', NULL, 35, 'App\\Models\\Product', '2016-01-04 14:23:49', '2016-01-04 14:23:49'),
	(11, 'black tead', 'img-upload', 'http://s3-us-west-1.amazonaws.com/ideaing-01/product-568a87587514e-Ideaing-Admin.png', NULL, 36, 'App\\Models\\Product', '2016-01-04 14:53:18', '2016-01-04 14:53:18'),
	(12, 'NEST Learning Thermostat', 'img-upload', 'http://s3-us-west-1.amazonaws.com/ideaing-01/product-568dae575871b-nest-thermostat.jpg', '1', 31, 'App\\Models\\Product', '2016-01-07 00:16:43', '2016-01-07 00:16:43'),
	(13, 'first', 'img-upload', 'http://s3-us-west-1.amazonaws.com/ideaing-01/product-568f4431690e7-1.ideas-feed.png', '0', 38, 'App\\Models\\Product', '2016-01-08 05:10:05', '2016-01-08 05:10:05'),
	(14, 'fly', 'img-upload', 'http://s3-us-west-1.amazonaws.com/ideaing-01/product-568f44cc0eb0d-image_upload_.png', '', 38, 'App\\Models\\Product', '2016-01-08 05:10:40', '2016-01-08 05:10:40'),
	(15, 'lkj', 'img-upload', 'http://s3-us-west-1.amazonaws.com/ideaing-01/product-568f468c2f36b-1.ideas-feed.png', '0', 39, 'App\\Models\\Product', '2016-01-08 05:19:21', '2016-01-08 05:19:21'),
	(16, 'another image', 'img-upload', 'http://s3-us-west-1.amazonaws.com/ideaing-01/product-568f5ae98fe88-1.ideas-feed.png', '0', 31, 'App\\Models\\Product', '2016-01-08 06:45:00', '2016-01-08 06:45:00'),
	(17, 'august lock front', 'img-upload', 'http://s3-us-west-1.amazonaws.com/ideaing-01/product-569141987db83-august-lock.jpg', '0', 40, 'App\\Models\\Product', '2016-01-09 17:21:33', '2016-01-09 17:21:33'),
	(18, 'august lock 2', 'img-upload', 'http://s3-us-west-1.amazonaws.com/ideaing-01/product-569141c4c0c43-august-lock2.jpg', '', 40, 'App\\Models\\Product', '2016-01-09 17:22:14', '2016-01-09 17:22:14'),
	(19, 'hello', 'img-upload', 'http://s3-us-west-1.amazonaws.com/ideaing-01/product-5691d928b530a-p1.png', '0', 41, 'App\\Models\\Product', '2016-01-10 04:08:13', '2016-01-10 04:08:13'),
	(20, 'hero', 'img-upload', 'http://s3-us-west-1.amazonaws.com/ideaing-01/product-5691d9474876b-details-view.png', '1', 41, 'App\\Models\\Product', '2016-01-10 04:08:45', '2016-01-10 04:08:45');
/*!40000 ALTER TABLE `medias` ENABLE KEYS */;


-- Dumping structure for table ideaingdb.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table ideaingdb.migrations: ~3 rows (approximately)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`migration`, `batch`) VALUES
	('2014_10_12_000000_create_users_table', 1),
	('2014_10_12_100000_create_password_resets_table', 1),
	('2015_11_30_071910_entrust_setup_tables', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;


-- Dumping structure for table ideaingdb.password_resets
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table ideaingdb.password_resets: ~0 rows (approximately)
DELETE FROM `password_resets`;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;


-- Dumping structure for table ideaingdb.permissions
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table ideaingdb.permissions: ~0 rows (approximately)
DELETE FROM `permissions`;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;


-- Dumping structure for table ideaingdb.permission_role
DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE IF NOT EXISTS `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table ideaingdb.permission_role: ~0 rows (approximately)
DELETE FROM `permission_role`;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;


-- Dumping structure for table ideaingdb.products
DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `product_category_id` int(10) DEFAULT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_vendor_type` varchar(50) DEFAULT NULL,
  `product_vendor_id` varchar(50) DEFAULT NULL,
  `product_permalink` varchar(255) NOT NULL,
  `product_description` text,
  `specifications` text,
  `price` decimal(10,0) DEFAULT NULL,
  `sale_price` decimal(10,0) DEFAULT NULL,
  `store_id` varchar(50) DEFAULT NULL,
  `affiliate_link` text,
  `price_grabber_master_id` varchar(255) DEFAULT NULL,
  `review` text,
  `ideaing_review_score` varchar(4) DEFAULT '0',
  `review_ext_link` varchar(255) DEFAULT NULL,
  `free_shipping` varchar(255) DEFAULT NULL,
  `coupon_code` varchar(255) DEFAULT NULL,
  `post_status` varchar(255) DEFAULT NULL,
  `page_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `similar_product_ids` varchar(255) DEFAULT NULL,
  `product_availability` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

-- Dumping data for table ideaingdb.products: ~18 rows (approximately)
DELETE FROM `products`;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `product_category_id`, `user_name`, `product_name`, `product_vendor_type`, `product_vendor_id`, `product_permalink`, `product_description`, `specifications`, `price`, `sale_price`, `store_id`, `affiliate_link`, `price_grabber_master_id`, `review`, `ideaing_review_score`, `review_ext_link`, `free_shipping`, `coupon_code`, `post_status`, `page_title`, `meta_description`, `similar_product_ids`, `product_availability`, `created_at`, `updated_at`) VALUES
	(26, NULL, 'Anonymous User', NULL, NULL, NULL, 'first-book', NULL, '[{"key":"ki","value":"89"}]', NULL, NULL, NULL, NULL, NULL, '[{"key":"Average","value":3},{"key":"fg","value":3}]', NULL, NULL, NULL, NULL, 'Inactive', NULL, NULL, '""', NULL, '2016-01-07 10:49:51', '2016-01-07 10:49:51'),
	(27, NULL, 'Anonymous User', 'Apple', NULL, NULL, 'ff', '', '[{"key":"ki","value":"89"}]', 0, 0, '', '', '', '[{"key":"Average","value":3},{"key":"fg","value":3}]', NULL, NULL, '', '', 'Inactive', '', '', '""', '', '2016-01-13 00:43:51', '2016-01-13 00:43:51'),
	(28, NULL, 'Anonymous User', NULL, NULL, NULL, 'apples', NULL, '[]', NULL, NULL, NULL, NULL, NULL, '[{"key":"Average","value":0}]', NULL, NULL, NULL, NULL, 'Inactive', NULL, NULL, '""', NULL, '2016-01-07 10:49:56', '2016-01-07 10:49:56'),
	(29, NULL, 'Admin', NULL, NULL, NULL, 'test', NULL, '[]', NULL, NULL, NULL, NULL, NULL, '[{"key":"Average","value":0}]', NULL, NULL, NULL, NULL, 'Inactive', NULL, NULL, '""', NULL, '2016-01-07 10:50:01', '2016-01-07 10:50:01'),
	(30, NULL, 'Admin', NULL, NULL, NULL, 'testing', NULL, '[]', NULL, NULL, NULL, NULL, NULL, '[{"key":"Average","value":0}]', NULL, NULL, NULL, NULL, 'Inactive', NULL, NULL, '""', NULL, '2016-01-07 10:50:04', '2016-01-07 10:50:04'),
	(31, 44, 'Anonymous User', 'Nest Learning Thermostat v2', NULL, NULL, 'nest-learning-thermostat-v2', '<p>A thinner, sleeker design. A bigger, sharper display. The 3rd generation Nest Learning Thermostat is more beautiful than ever. With Farsight, it lights up when it sees you coming and shows you the time or temperature from across the room. And the Nest Thermostat is proven to save energy. That’s the most beautiful part.</p><p>Your thermostat controls half your energy bill – more than appliances, more than electronics. So shouldn’t it help you save energy? Independent studies have proven that the Nest Learning Thermostat saved an average of 10-12% on heating bills and 15% on cooling bills. That means that in two years, it can pay for itself.</p>', '[{"key":"Range","value":"30ft"},{"key":"Screen","value":"5.3cm Diameter"},{"key":"Wireless","value":"802.11b\\/g\\/n at 2.4 GHz, 5 GHz, 802.15.4 at 2.4 GHz"},{"key":"Bluetooth","value":"Yes, Bluetooth Low Energy"}]', 250, 225, 'Amazon', 'http://www.amazon.com', '', '[{"key":"Average","value":4},{"key":"Engadget","value":4,"link":"http:\\/\\/www.engadget.com"},{"key":"The Verge","value":5},{"key":"PCMag","value":4}]', NULL, '', '0', 'NEST', 'Active', 'Nest Learning Thermostat v2', 'Find and share best smart home gadgets like the Nest Thermostat', '""', 'Yes', '2016-01-07 23:25:16', '2016-01-07 23:25:19'),
	(32, NULL, 'Anonymous User', NULL, NULL, NULL, 'testtest', NULL, '[]', NULL, NULL, NULL, NULL, NULL, '[{"key":"Average","value":0}]', NULL, NULL, NULL, NULL, 'Inactive', NULL, NULL, '""', NULL, '2016-01-07 10:50:11', '2016-01-07 10:50:11'),
	(33, NULL, 'Anonymous User', NULL, NULL, NULL, 'asda', NULL, '[]', NULL, NULL, NULL, NULL, NULL, '[{"key":"Average","value":0}]', NULL, NULL, NULL, NULL, 'Inactive', NULL, NULL, '""', NULL, '2016-01-07 10:50:15', '2016-01-07 10:50:15'),
	(38, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Inactive', NULL, NULL, NULL, NULL, '2016-01-08 05:09:49', '2016-01-08 05:09:49'),
	(39, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Inactive', NULL, NULL, NULL, NULL, '2016-01-08 05:18:57', '2016-01-08 05:18:57'),
	(40, 45, 'Anonymous User', 'August Smart Lock - Keyless Home Entry with Your Smartphone', NULL, NULL, 'august-smart-lock', '<p>Testing Testing Testing Testing Testing Testing Testing Testing Apple What The best item ever. Yes it is really nice. Cool. Sweet. </p><p><br/></p><p>Its ideal for most front doors.</p>', '[]', 0, 50, 'Amazon', 'http://www.amazon.com/August-Smart-Lock-Keyless-Smartphone/dp/B00OHY14CS/ref=sr_1_1?ie=UTF8&qid=1452360100&sr=8-1&keywords=august+lock', '', '[{"key":"Average","value":5},{"key":"CNET","value":4,"link":"http:\\/\\/www.cnet.com"},{"key":"PCMag","value":5,"link":"http:\\/\\/www.apple.com"}]', NULL, '<h2>sdfkjsdklfj</h2><h4>lksdjfldsk jl</h4><h6>sdf</h6><blockquote><p>dddddddddddd<br/></p></blockquote>', '0', '151515515', 'Active', 'August Smart Lock Reviews and Comparisons', '', '[{"name":"locks"},{"name":"smart-locks"}]', '', '2016-01-11 02:49:29', '2016-01-10 20:49:28'),
	(41, 72, 'Anonymous User', 'home dec', NULL, NULL, 'home-dec', '<p>this <br/></p><p>is a <br/></p><p>home decoration product. <br/></p>', '[{"key":"size","value":"12 x 34 cm"}]', 12, 98, 'flowar ltd', 'http://aws.com/23423', '', '[{"key":"Average","value":4},{"key":"amazon","value":4,"link":"http:\\/\\/cat.com\\/234"}]', NULL, '<h2>sdfkjsdklfj</h2><h4>lksdjfldsk jl</h4><h6>sdf<br/></h6>', '1', '', 'Active', 'tile of the page for home item ', 'meta description for prouduct.', '[{"id":"40","name":"August-Smart-Lock---Keyless-Home-Entry-with-Your-Smartphone"}]', 'yes', '2016-01-11 17:19:56', '2016-01-11 17:19:56'),
	(42, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Inactive', NULL, NULL, NULL, NULL, '2016-01-12 14:09:05', '2016-01-12 14:09:05'),
	(43, 44, 'Anonymous User', 'pco', 'Amazon', '', 'pco', '', '[]', 0, 0, '', '', '', '[{"key":"Average","value":2},{"key":"pc mag","value":1.3,"link":"http:\\/\\/www.pcmac.com\\/342"},{"key":"jh","value":2,"link":"ui"},{"key":"hjgkjg","value":0.5,"link":"kjhgkhg"},{"key":"gkjhgkjhg","value":4.5,"link":"hjkkjhjh"},{"key":"jkhkjhkjh","value":2.5,"link":"76876"},{"key":"gjhgj","value":2.5,"link":"6876"}]', NULL, '', '0', '', 'Inactive', '', '', '""', '', '2016-01-14 12:38:20', '2016-01-14 06:38:20'),
	(44, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Inactive', NULL, NULL, NULL, NULL, '2016-01-14 06:22:42', '2016-01-14 06:22:42'),
	(45, NULL, 'Anonymous User', 'lkj', 'Amazon', 'lj', 'pot', '', '[]', 0, 0, '', '', '', '[{"key":"Average","value":3.5,"counter":""},{"key":"jlkjlkj","value":2.5,"link":"lkjlkj","counter":"30"},{"key":"lkjlkj","value":4.5,"link":"lkjlkj99"}]', '5', '<p>khkjh<br/></p>', '0', '', 'Inactive', '', '', '""', '', '2016-01-14 19:02:08', '2016-01-14 13:02:08'),
	(46, 44, 'Anonymous User', 'lkjlkjl', 'Amazon', 'lkjlkj', 'pot', '<p>lkjlkj<br/></p>', '[]', 0, 0, '', '', '', '[{"key":"Average","value":2.5,"counter":""},{"key":"lkjlkj","value":3.5,"link":"kjlkjlkj.com","counter":"8"},{"key":"slkdfjsdlkfj","value":1.5,"link":"dfsdj.com","counter":"96"}]', NULL, '', '', '', 'Inactive', '', '', '""', '', '2016-01-14 13:01:12', '2016-01-14 07:01:12'),
	(47, 55, 'Anonymous User', '654564', 'Amazon', '65465465', 'pt', '', '[]', 0, 0, '', '', '', '[{"key":"Average","value":0,"counter":""},{"key":"Amazon","value":0,"counter":0}]', NULL, '', '0', '', 'Inactive', '', '', '""', '', '2016-01-14 13:41:36', '2016-01-14 07:41:36'),
	(48, NULL, 'Anonymous User', 'lkjlkj', 'Amazon', 'lkjlj', 'plo', '', '[]', 0, 0, '', '', '', '[{"key":"Average","value":0,"counter":""},{"key":"Amazon","value":0,"counter":0}]', '0', '', '', '', 'Inactive', '', '', '""', '', '2016-01-14 19:09:48', '2016-01-14 13:09:48');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;


-- Dumping structure for table ideaingdb.product_categories
DROP TABLE IF EXISTS `product_categories`;
CREATE TABLE IF NOT EXISTS `product_categories` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(15) NOT NULL,
  `extra_info` varchar(255) DEFAULT NULL,
  `lock` tinyint(4) NOT NULL DEFAULT '0',
  `parent_id` int(10) DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rgt` int(11) DEFAULT NULL,
  `depth` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;

-- Dumping data for table ideaingdb.product_categories: ~27 rows (approximately)
DELETE FROM `product_categories`;
/*!40000 ALTER TABLE `product_categories` DISABLE KEYS */;
INSERT INTO `product_categories` (`id`, `category_name`, `extra_info`, `lock`, `parent_id`, `lft`, `rgt`, `depth`, `created_at`, `updated_at`) VALUES
	(44, 'Smart Home', 'smart-home', 0, NULL, 1, 20, 0, '2016-01-01 17:43:31', '2016-01-01 17:43:33'),
	(45, 'Energy & Air', 'energy-and-air', 0, 44, 2, 3, 1, '2016-01-01 17:43:31', '2016-01-01 17:43:33'),
	(46, 'Entertainment', 'entertainment', 0, 44, 4, 5, 1, '2016-01-01 17:43:31', '2016-01-01 17:43:33'),
	(47, 'Lighting', 'lighting', 0, 44, 6, 7, 1, '2016-01-01 17:43:31', '2016-01-01 17:43:33'),
	(48, 'Cleaning', 'cleaning', 0, 44, 8, 9, 1, '2016-01-01 17:43:31', '2016-01-01 17:43:33'),
	(49, 'Networking', 'networking', 0, 44, 10, 11, 1, '2016-01-01 17:43:31', '2016-01-01 17:43:33'),
	(50, 'Doors', 'doors', 0, 44, 12, 13, 1, '2016-01-01 17:43:31', '2016-01-01 17:43:33'),
	(51, 'Garage', 'garage', 0, 44, 14, 15, 1, '2016-01-01 17:43:31', '2016-01-01 17:43:33'),
	(52, 'Pets', 'pets', 0, 44, 16, 17, 1, '2016-01-01 17:43:31', '2016-01-01 17:43:33'),
	(53, 'Appliances', 'appliances', 0, 44, 18, 19, 1, '2016-01-01 17:43:31', '2016-01-01 17:43:33'),
	(55, 'Travel', 'travel', 0, NULL, 21, 32, 0, '2016-01-01 17:43:31', '2016-01-01 17:43:33'),
	(56, 'Luggage', 'luggage', 0, 55, 22, 23, 1, '2016-01-01 17:43:31', '2016-01-01 17:43:33'),
	(57, 'Gadgets', 'gadgets', 0, 55, 24, 25, 1, '2016-01-01 17:43:31', '2016-01-01 17:43:33'),
	(58, 'Backpacks', 'backpacks', 0, 55, 26, 27, 1, '2016-01-01 17:43:31', '2016-01-01 17:43:33'),
	(59, 'Bags', 'bags', 0, 55, 28, 29, 1, '2016-01-01 17:43:31', '2016-01-01 17:43:33'),
	(60, 'Accessories', 'accessories', 0, 55, 30, 31, 1, '2016-01-01 17:43:31', '2016-01-01 17:43:33'),
	(62, 'Wearables', 'wearables', 0, NULL, 33, 38, 0, '2016-01-01 17:43:31', '2016-01-01 17:43:33'),
	(63, 'Running Watches', 'running-watches', 0, 62, 34, 35, 1, '2016-01-01 17:43:31', '2016-01-01 17:43:33'),
	(64, 'Home Decor', 'home-decor', 0, 62, 36, 37, 1, '2016-01-01 17:43:31', '2016-01-01 17:43:33'),
	(65, 'Home Decor', 'home-decor', 0, NULL, 39, 54, 0, '2016-01-01 17:43:31', '2016-01-01 17:43:33'),
	(66, 'Furniture', 'furniture', 0, 65, 40, 41, 1, '2016-01-01 17:43:31', '2016-01-01 17:43:33'),
	(67, 'Bedding', 'bedding', 0, 65, 42, 43, 1, '2016-01-01 17:43:31', '2016-01-01 17:43:33'),
	(68, 'Bath', 'bath', 0, 65, 44, 45, 1, '2016-01-01 17:43:31', '2016-01-01 17:43:33'),
	(69, 'Decor', 'decor', 0, 65, 46, 47, 1, '2016-01-01 17:43:31', '2016-01-01 17:43:33'),
	(70, 'Office', 'office', 0, 65, 48, 49, 1, '2016-01-01 17:43:31', '2016-01-01 17:43:33'),
	(71, 'Storage', 'storage', 0, 65, 50, 51, 1, '2016-01-01 17:43:31', '2016-01-01 17:43:33'),
	(72, 'Outdoor', 'outdoor', 0, 65, 52, 53, 1, '2016-01-01 17:43:31', '2016-01-01 17:43:33');
/*!40000 ALTER TABLE `product_categories` ENABLE KEYS */;


-- Dumping structure for table ideaingdb.roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table ideaingdb.roles: ~0 rows (approximately)
DELETE FROM `roles`;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;


-- Dumping structure for table ideaingdb.role_user
DROP TABLE IF EXISTS `role_user`;
CREATE TABLE IF NOT EXISTS `role_user` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_user_role_id_foreign` (`role_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table ideaingdb.role_user: ~0 rows (approximately)
DELETE FROM `role_user`;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;


-- Dumping structure for table ideaingdb.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table ideaingdb.users: ~4 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `status`, `created_at`, `updated_at`) VALUES
	(27, 'Tac Box', 'tanvir@carbon51.com', '$2y$10$aY10NyjMgEF8NEK0bC2vBuALVoRgyaM0Sa.KqZXybrTzzT4Ri2aPi', NULL, 'Active', '2015-12-06 00:33:44', '2015-12-06 08:50:52'),
	(28, 'Shimana Alam', 'alam.rhidima@gmail.com', '$2y$10$NLbRDf86XND7hX3w347uVeXrlxFec.JS/VunugNbrA9gS0UdqkdNy', NULL, 'Active', '2015-12-06 06:38:38', '2015-12-06 06:38:39'),
	(30, 'Tan New', 'tefax@vkcode.ru', '$2y$10$FHMdM1swhJmYSAZtNEhV/u2HSGR4MT4EKvnDyf8RfAIcjgJVPwvIq', NULL, 'Active', '2015-12-06 09:00:39', '2015-12-06 09:49:02'),
	(31, 'Tanvir Anowar', 'tanvir.net@gmail.com', '$2y$10$7pj1uLWfV03zLl7AgL3SEOLPLTmTwhjX4p7AQiQnxXz4Z5aOBUXwO', NULL, 'Active', '2015-12-06 09:15:08', '2015-12-06 09:42:47');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- Dumping structure for table ideaingdb.user_profiles
DROP TABLE IF EXISTS `user_profiles`;
CREATE TABLE IF NOT EXISTS `user_profiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- Dumping data for table ideaingdb.user_profiles: ~4 rows (approximately)
DELETE FROM `user_profiles`;
/*!40000 ALTER TABLE `user_profiles` DISABLE KEYS */;
INSERT INTO `user_profiles` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
	(23, 27, '2015-12-06 06:33:44', '2015-12-06 00:33:44'),
	(24, 28, '2015-12-06 12:38:38', '2015-12-06 06:38:38'),
	(26, 30, '2015-12-06 15:00:40', '2015-12-06 09:00:40'),
	(27, 31, '2015-12-06 15:15:08', '2015-12-06 09:15:08');
/*!40000 ALTER TABLE `user_profiles` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
