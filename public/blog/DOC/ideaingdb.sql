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

-- Dumping database structure for ideaingdb
DROP DATABASE IF EXISTS `ideaingdb`;
CREATE DATABASE IF NOT EXISTS `ideaingdb` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `ideaingdb`;


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
  `store_id` int(4) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table ideaingdb.products: ~7 rows (approximately)
DELETE FROM `products`;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `product_category_id`, `product_name`, `product_permalink`, `product_description`, `specifications`, `price`, `sale_price`, `store_id`, `affiliate_link`, `price_grabber_master_id`, `review`, `free_shipping`, `coupon_code`, `post_status`, `page_title`, `meta_description`, `similar_product_ids`, `product_availability`, `created_at`, `updated_at`) VALUES
	(1, 29, 'new product', 'new-product', 'this is a new product', '', 15, 14, 1, 'http://amazon.com/product/12/se23', '1', '', 'yes', '1235', NULL, 'this is seo page title', 'tag,product', '1,3,4', 'Yes', '2015-12-24 19:48:27', '2015-12-24 13:48:27'),
	(2, NULL, '2', '', 'Root 2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '30', NULL, NULL, NULL, NULL, NULL, NULL, '2015-12-24 13:01:10', '2015-12-24 13:01:10'),
	(3, NULL, '3', '', 'Root 1.1.1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '32', NULL, NULL, NULL, NULL, NULL, NULL, '2015-12-24 13:01:10', '2015-12-24 13:01:10'),
	(4, 29, '4', 'sdf-sdf-dsdd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', NULL, NULL, NULL, NULL, '2015-12-24 18:23:57', '2015-12-24 18:23:57'),
	(5, NULL, '5', 'lkj', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', NULL, NULL, NULL, NULL, '2015-12-24 12:53:23', '2015-12-24 12:53:23'),
	(6, NULL, '6', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', NULL, NULL, NULL, NULL, '2015-12-24 12:53:24', '2015-12-24 12:53:24'),
	(7, NULL, '7', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', NULL, NULL, NULL, NULL, '2015-12-24 12:53:25', '2015-12-24 12:53:25');
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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

-- Dumping data for table ideaingdb.product_categories: ~12 rows (approximately)
DELETE FROM `product_categories`;
/*!40000 ALTER TABLE `product_categories` DISABLE KEYS */;
INSERT INTO `product_categories` (`id`, `category_name`, `extra_info`, `lock`, `parent_id`, `lft`, `rgt`, `depth`, `created_at`, `updated_at`) VALUES
	(29, 'Root 1', 'first-root-node', 0, NULL, 1, 10, 0, '2015-12-22 11:28:07', '2015-12-22 05:28:07'),
	(30, 'Root 2', 'second-root-node', 0, NULL, 11, 14, 0, '2015-12-20 14:01:12', '2015-12-20 08:01:12'),
	(31, 'Root-1.1', 'child-of-first', 0, 29, 2, 5, 1, '2015-12-14 11:09:37', '2015-12-14 11:09:37'),
	(32, 'Root 1.1.1', 'child-child-first', 0, 31, 3, 4, 2, '2015-12-14 11:09:47', '2015-12-14 11:09:47'),
	(33, 'New', 'new node', 0, 29, 6, 7, 1, '2015-12-16 21:35:25', '2015-12-16 15:35:25'),
	(34, 'x-man', 'xto', 0, NULL, 15, 16, 0, '2015-12-20 14:01:12', '2015-12-20 08:01:12'),
	(38, 'ok', 'po', 0, NULL, 17, 18, 0, '2015-12-20 14:01:12', '2015-12-20 08:01:12'),
	(41, 'max2', 'tone.', 0, NULL, 19, 20, 0, '2015-12-20 14:01:12', '2015-12-20 08:01:12'),
	(42, 'fire stuffs', 'fire-stuffs', 0, 29, 8, 9, 1, '2015-12-20 13:59:44', '2015-12-20 07:59:44'),
	(43, 'nos', 'car-item', 0, 30, 12, 13, 1, '2015-12-20 14:01:13', '2015-12-20 08:01:13'),
	(44, 'Blog', 'blog', 0, NULL, 21, 24, 0, '2015-12-22 09:35:19', '2015-12-22 03:35:19'),
	(45, 'kitchen', 'blog/kitchen', 0, 44, 22, 23, 1, '2015-12-22 09:35:20', '2015-12-22 03:35:20');
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
	(27, 'Tac Box', 'tanvir@carbon51.com', '$2y$10$aY10NyjMgEF8NEK0bC2vBuALVoRgyaM0Sa.KqZXybrTzzT4Ri2aPi', NULL, 'Active', '2015-12-06 06:33:44', '2015-12-06 14:50:52'),
	(28, 'Shimana Alam', 'alam.rhidima@gmail.com', '$2y$10$NLbRDf86XND7hX3w347uVeXrlxFec.JS/VunugNbrA9gS0UdqkdNy', NULL, 'Active', '2015-12-06 12:38:38', '2015-12-06 12:38:39'),
	(30, 'Tan New', 'tefax@vkcode.ru', '$2y$10$FHMdM1swhJmYSAZtNEhV/u2HSGR4MT4EKvnDyf8RfAIcjgJVPwvIq', NULL, 'Active', '2015-12-06 15:00:39', '2015-12-06 15:49:02'),
	(31, 'Tanvir Anowar', 'tanvir.net@gmail.com', '$2y$10$7pj1uLWfV03zLl7AgL3SEOLPLTmTwhjX4p7AQiQnxXz4Z5aOBUXwO', NULL, 'Active', '2015-12-06 15:15:08', '2015-12-06 15:42:47');
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
	(23, 27, '2015-12-06 12:33:44', '2015-12-06 06:33:44'),
	(24, 28, '2015-12-06 18:38:38', '2015-12-06 12:38:38'),
	(26, 30, '2015-12-06 21:00:40', '2015-12-06 15:00:40'),
	(27, 31, '2015-12-06 21:15:08', '2015-12-06 15:15:08');
/*!40000 ALTER TABLE `user_profiles` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
