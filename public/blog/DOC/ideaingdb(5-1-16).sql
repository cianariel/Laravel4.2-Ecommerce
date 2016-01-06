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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table ideaingdb.medias: ~3 rows (approximately)
DELETE FROM `medias`;
/*!40000 ALTER TABLE `medias` DISABLE KEYS */;
INSERT INTO `medias` (`id`, `media_name`, `media_type`, `media_link`, `is_hero_item`, `mediable_id`, `mediable_type`, `created_at`, `updated_at`) VALUES
	(6, 'lkj', 'img-link', 'http://dsf.com/234', NULL, 26, 'App\\Models\\Product', '2016-01-03 09:13:58', '2016-01-03 09:13:58'),
	(7, 'lkj', 'img-link', 'http://dsf.com/234', NULL, 26, 'App\\Models\\Product', '2016-01-03 09:14:02', '2016-01-03 09:14:02'),
	(8, 'lkj', 'img-link', 'http://dsf.com/234', NULL, 26, 'App\\Models\\Product', '2016-01-03 09:14:06', '2016-01-03 09:14:06');
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
  `product_name` varchar(255) DEFAULT NULL,
  `product_permalink` varchar(255) NOT NULL,
  `product_description` text,
  `specifications` text,
  `price` decimal(10,0) DEFAULT NULL,
  `sale_price` decimal(10,0) DEFAULT NULL,
  `store_id` varchar(50) DEFAULT NULL,
  `affiliate_link` text,
  `price_grabber_master_id` varchar(255) DEFAULT NULL,
  `review` text,
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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

-- Dumping data for table ideaingdb.products: ~6 rows (approximately)
DELETE FROM `products`;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `product_category_id`, `product_name`, `product_permalink`, `product_description`, `specifications`, `price`, `sale_price`, `store_id`, `affiliate_link`, `price_grabber_master_id`, `review`, `free_shipping`, `coupon_code`, `post_status`, `page_title`, `meta_description`, `similar_product_ids`, `product_availability`, `created_at`, `updated_at`) VALUES
	(26, NULL, '', '', '', '[]', 0, 0, '', '', '', '[{"key":"Average","value":0}]', '', '', 'Inactive', '', '', '""', '', '2016-01-05 00:04:16', '2016-01-04 18:04:16'),
	(27, NULL, 'networking tools', 'ff', '', '[{"key":"ki","value":"89"}]', 0, 0, '', '', '', '[{"key":"Average","value":3},{"key":"fg","value":3}]', '', '', 'Inactive', '', '', '""', '', '2015-12-30 23:51:43', '2015-12-30 23:51:43'),
	(28, 49, 'Netgear 300N wifi router', 'wifi-netgear-router', '<p>this is a <b>netgear </b>router <br/></p>', '[{"key":"size","value":"20 x 15CM"},{"key":"weight","value":"200g"}]', 80, 70, 'Netgear LTD', 'http://amazon.com/ng/234324', '1345654', '[{"key":"Average","value":2},{"key":"Admin","value":4},{"key":"user","value":1},{"key":"usability","value":1}]', 'not available', 'rw123', 'Active', 'wifi router - netgear', 'sso, wifi', '[{"id":26,"name":"router-book"},{"id":27,"name":"networking-tools"}]', 'avaiable till 30st dec', '2015-12-31 00:02:42', '2015-12-30 18:02:42'),
	(29, 38, 'p2 mobile', 'p2', '<p>max font mobile<br/></p>', '[]', 464, 987, 'jil', 'http://sdf.com', '987', '[{"key":"Average","value":0}]', 'k', 'kj', 'Inactive', '', '', '""', '', '2016-01-03 16:28:59', '2016-01-03 10:28:59'),
	(30, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Inactive', NULL, NULL, NULL, NULL, '2016-01-04 18:17:12', '2016-01-04 18:17:12'),
	(31, 38, 'no', 'kk-it', '', '[{"key":"hi","value":"low"}]', 0, 0, '', '', '', '[{"key":"Average","value":0}]', '', '', 'Active', '', '', '""', 'no', '2016-01-05 00:23:44', '2016-01-04 18:23:44');
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

-- Dumping data for table ideaingdb.product_categories: ~36 rows (approximately)
DELETE FROM `product_categories`;
/*!40000 ALTER TABLE `product_categories` DISABLE KEYS */;
INSERT INTO `product_categories` (`id`, `category_name`, `extra_info`, `lock`, `parent_id`, `lft`, `rgt`, `depth`, `created_at`, `updated_at`) VALUES
	(29, 'Root 1', 'first-root-node', 0, NULL, 1, 10, 0, '2015-12-21 14:36:18', '2015-12-21 14:36:19'),
	(30, 'Root 2', 'second-root-node', 0, NULL, 11, 14, 0, '2015-12-20 08:01:12', '2015-12-20 02:01:12'),
	(31, 'Root-1.1', 'child-of-first', 0, 29, 2, 5, 1, '2015-12-14 05:09:37', '2015-12-14 05:09:37'),
	(32, 'Root 1.1.1', 'child-child-first', 0, 31, 3, 4, 2, '2015-12-14 05:09:47', '2015-12-14 05:09:47'),
	(33, 'New', 'new node', 0, 29, 6, 7, 1, '2015-12-16 15:35:25', '2015-12-16 09:35:25'),
	(38, 'ok', 'po', 0, NULL, 15, 16, 0, '2015-12-21 14:36:26', '2015-12-21 14:36:27'),
	(41, 'max2', 'tone.', 0, NULL, 17, 18, 0, '2015-12-21 14:36:26', '2015-12-21 14:36:27'),
	(42, 'fire stuffs', 'fire-stuffs', 0, 29, 8, 9, 1, '2015-12-20 07:59:44', '2015-12-20 01:59:44'),
	(43, 'nos', 'car-item', 0, 30, 12, 13, 1, '2015-12-20 08:01:13', '2015-12-20 02:01:13'),
	(44, 'Smart Home', 'smart-home', 0, NULL, 19, 38, 0, '2015-12-22 15:13:07', '2015-12-22 15:13:08'),
	(45, 'Energy & Air', 'energy-and-air', 0, 44, 20, 21, 1, '2015-12-22 15:02:39', '2015-12-22 15:02:40'),
	(46, 'Entertainment', 'entertainment', 0, 44, 22, 23, 1, '2015-12-22 15:03:11', '2015-12-22 15:03:12'),
	(47, 'Lighting', 'lighting', 0, 44, 24, 25, 1, '2015-12-22 15:03:27', '2015-12-22 15:03:28'),
	(48, 'Cleaning', 'cleaning', 0, 44, 26, 27, 1, '2015-12-22 15:03:36', '2015-12-22 15:03:37'),
	(49, 'Networking', 'networking', 0, 44, 28, 29, 1, '2015-12-22 15:03:47', '2015-12-22 15:03:49'),
	(50, 'Doors', 'doors', 0, 44, 30, 31, 1, '2015-12-22 15:04:03', '2015-12-22 15:04:05'),
	(51, 'Garage', 'garage', 0, 44, 32, 33, 1, '2015-12-22 15:04:26', '2015-12-22 15:04:27'),
	(52, 'Pets', 'pets', 0, 44, 34, 35, 1, '2015-12-22 15:04:36', '2015-12-22 15:04:38'),
	(53, 'Appliances', 'appliances', 0, 44, 36, 37, 1, '2015-12-22 15:04:45', '2015-12-22 15:04:46'),
	(55, 'Travel', 'travel', 0, NULL, 39, 50, 0, '2015-12-22 15:15:03', '2015-12-22 15:15:04'),
	(56, 'Luggage', 'luggage', 0, 55, 40, 41, 1, '2015-12-22 15:13:07', '2015-12-22 15:13:08'),
	(57, 'Gadgets', 'gadgets', 0, 55, 42, 43, 1, '2015-12-22 15:13:07', '2015-12-22 15:13:08'),
	(58, 'Backpacks', 'backpacks', 0, 55, 44, 45, 1, '2015-12-22 15:13:07', '2015-12-22 15:13:08'),
	(59, 'Bags', 'bags', 0, 55, 46, 47, 1, '2015-12-22 15:13:07', '2015-12-22 15:13:08'),
	(60, 'Accessories', 'accessories', 0, 55, 48, 49, 1, '2015-12-22 15:13:07', '2015-12-22 15:13:08'),
	(62, 'Wearables', 'wearables', 0, NULL, 51, 56, 0, '2015-12-22 15:15:03', '2015-12-22 15:15:04'),
	(63, 'Running Watches', 'running-watches', 0, 62, 52, 53, 1, '2015-12-22 15:15:03', '2015-12-22 15:15:04'),
	(64, 'Home Decor', 'home-decor', 0, 62, 54, 55, 1, '2015-12-22 15:15:03', '2015-12-22 15:15:04'),
	(65, 'Home Decor', 'home-decor', 0, NULL, 57, 72, 0, '2015-12-22 15:15:03', '2015-12-22 15:15:04'),
	(66, 'Furniture', 'furniture', 0, 65, 58, 59, 1, '2015-12-22 15:15:03', '2015-12-22 15:15:04'),
	(67, 'Bedding', 'bedding', 0, 65, 60, 61, 1, '2015-12-22 15:15:03', '2015-12-22 15:15:04'),
	(68, 'Bath', 'bath', 0, 65, 62, 63, 1, '2015-12-22 15:15:03', '2015-12-22 15:15:04'),
	(69, 'Decor', 'decor', 0, 65, 64, 65, 1, '2015-12-22 15:15:03', '2015-12-22 15:15:04'),
	(70, 'Office', 'office', 0, 65, 66, 67, 1, '2015-12-22 15:15:03', '2015-12-22 15:15:04'),
	(71, 'Storage', 'storage', 0, 65, 68, 69, 1, '2015-12-22 15:15:03', '2015-12-22 15:15:04'),
	(72, 'Outdoor', 'outdoor', 0, 65, 70, 71, 1, '2015-12-22 15:15:03', '2015-12-22 15:15:04');
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


-- Dumping structure for table ideaingdb.stores
DROP TABLE IF EXISTS `stores`;
CREATE TABLE IF NOT EXISTS `stores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ideaingdb.stores: ~0 rows (approximately)
DELETE FROM `stores`;
/*!40000 ALTER TABLE `stores` DISABLE KEYS */;
/*!40000 ALTER TABLE `stores` ENABLE KEYS */;


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
