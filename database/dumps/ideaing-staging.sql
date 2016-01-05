# ************************************************************
# Sequel Pro SQL dump
# Version 4499
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: staging-mysql.c9zzhwcfjtcc.us-west-2.rds.amazonaws.com (MySQL 5.6.23-log)
# Database: ideaing-staging
# Generation Time: 2016-01-05 16:10:57 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table medias
# ------------------------------------------------------------

DROP TABLE IF EXISTS `medias`;

CREATE TABLE `medias` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `medias` WRITE;
/*!40000 ALTER TABLE `medias` DISABLE KEYS */;

INSERT INTO `medias` (`id`, `media_name`, `media_type`, `media_link`, `is_hero_item`, `mediable_id`, `mediable_type`, `created_at`, `updated_at`)
VALUES
	(6,'lkj','img-link','http://dsf.com/234',NULL,26,'App\\Models\\Product','2016-01-03 09:13:58','2016-01-03 09:13:58'),
	(7,'lkj','img-link','http://dsf.com/234',NULL,26,'App\\Models\\Product','2016-01-03 09:14:02','2016-01-03 09:14:02'),
	(8,'lkj','img-link','http://dsf.com/234',NULL,26,'App\\Models\\Product','2016-01-03 09:14:06','2016-01-03 09:14:06'),
	(9,'Kids','img-upload','file-max-limit-exit',NULL,35,'App\\Models\\Product','2016-01-04 14:23:49','2016-01-04 14:23:49'),
	(10,'Nest Learning Thermostat','img-link','file-max-limit-exit',NULL,31,'App\\Models\\Product','2016-01-04 14:29:19','2016-01-04 14:29:19'),
	(11,'black tead','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-568a87587514e-Ideaing-Admin.png',NULL,36,'App\\Models\\Product','2016-01-04 14:53:18','2016-01-04 14:53:18');

/*!40000 ALTER TABLE `medias` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`migration`, `batch`)
VALUES
	('2014_10_12_000000_create_users_table',1),
	('2014_10_12_100000_create_password_resets_table',1),
	('2015_11_30_071910_entrust_setup_tables',1);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table permission_role
# ------------------------------------------------------------

DROP TABLE IF EXISTS `permission_role`;

CREATE TABLE `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table permissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table product_categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_categories`;

CREATE TABLE `product_categories` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `product_categories` WRITE;
/*!40000 ALTER TABLE `product_categories` DISABLE KEYS */;

INSERT INTO `product_categories` (`id`, `category_name`, `extra_info`, `lock`, `parent_id`, `lft`, `rgt`, `depth`, `created_at`, `updated_at`)
VALUES
	(44,'Smart Home','smart-home',0,NULL,1,20,0,'2016-01-01 17:43:31','2016-01-01 17:43:33'),
	(45,'Energy & Air','energy-and-air',0,44,2,3,1,'2016-01-01 17:43:31','2016-01-01 17:43:33'),
	(46,'Entertainment','entertainment',0,44,4,5,1,'2016-01-01 17:43:31','2016-01-01 17:43:33'),
	(47,'Lighting','lighting',0,44,6,7,1,'2016-01-01 17:43:31','2016-01-01 17:43:33'),
	(48,'Cleaning','cleaning',0,44,8,9,1,'2016-01-01 17:43:31','2016-01-01 17:43:33'),
	(49,'Networking','networking',0,44,10,11,1,'2016-01-01 17:43:31','2016-01-01 17:43:33'),
	(50,'Doors','doors',0,44,12,13,1,'2016-01-01 17:43:31','2016-01-01 17:43:33'),
	(51,'Garage','garage',0,44,14,15,1,'2016-01-01 17:43:31','2016-01-01 17:43:33'),
	(52,'Pets','pets',0,44,16,17,1,'2016-01-01 17:43:31','2016-01-01 17:43:33'),
	(53,'Appliances','appliances',0,44,18,19,1,'2016-01-01 17:43:31','2016-01-01 17:43:33'),
	(55,'Travel','travel',0,NULL,21,32,0,'2016-01-01 17:43:31','2016-01-01 17:43:33'),
	(56,'Luggage','luggage',0,55,22,23,1,'2016-01-01 17:43:31','2016-01-01 17:43:33'),
	(57,'Gadgets','gadgets',0,55,24,25,1,'2016-01-01 17:43:31','2016-01-01 17:43:33'),
	(58,'Backpacks','backpacks',0,55,26,27,1,'2016-01-01 17:43:31','2016-01-01 17:43:33'),
	(59,'Bags','bags',0,55,28,29,1,'2016-01-01 17:43:31','2016-01-01 17:43:33'),
	(60,'Accessories','accessories',0,55,30,31,1,'2016-01-01 17:43:31','2016-01-01 17:43:33'),
	(62,'Wearables','wearables',0,NULL,33,38,0,'2016-01-01 17:43:31','2016-01-01 17:43:33'),
	(63,'Running Watches','running-watches',0,62,34,35,1,'2016-01-01 17:43:31','2016-01-01 17:43:33'),
	(64,'Home Decor','home-decor',0,62,36,37,1,'2016-01-01 17:43:31','2016-01-01 17:43:33'),
	(65,'Home Decor','home-decor',0,NULL,39,54,0,'2016-01-01 17:43:31','2016-01-01 17:43:33'),
	(66,'Furniture','furniture',0,65,40,41,1,'2016-01-01 17:43:31','2016-01-01 17:43:33'),
	(67,'Bedding','bedding',0,65,42,43,1,'2016-01-01 17:43:31','2016-01-01 17:43:33'),
	(68,'Bath','bath',0,65,44,45,1,'2016-01-01 17:43:31','2016-01-01 17:43:33'),
	(69,'Decor','decor',0,65,46,47,1,'2016-01-01 17:43:31','2016-01-01 17:43:33'),
	(70,'Office','office',0,65,48,49,1,'2016-01-01 17:43:31','2016-01-01 17:43:33'),
	(71,'Storage','storage',0,65,50,51,1,'2016-01-01 17:43:31','2016-01-01 17:43:33'),
	(72,'Outdoor','outdoor',0,65,52,53,1,'2016-01-01 17:43:31','2016-01-01 17:43:33');

/*!40000 ALTER TABLE `product_categories` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table products
# ------------------------------------------------------------

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;

INSERT INTO `products` (`id`, `product_category_id`, `product_name`, `product_permalink`, `product_description`, `specifications`, `price`, `sale_price`, `store_id`, `affiliate_link`, `price_grabber_master_id`, `review`, `review_ext_link`, `free_shipping`, `coupon_code`, `post_status`, `page_title`, `meta_description`, `similar_product_ids`, `product_availability`, `created_at`, `updated_at`)
VALUES
	(26,NULL,NULL,'first-book',NULL,'[{\"key\":\"ki\",\"value\":\"89\"}]',NULL,NULL,NULL,NULL,NULL,'[{\"key\":\"Average\",\"value\":3},{\"key\":\"fg\",\"value\":3}]',NULL,NULL,NULL,'Inactive',NULL,NULL,'\"\"',NULL,'2015-12-29 23:01:27','2015-12-29 23:01:27'),
	(27,NULL,'','ff','','[{\"key\":\"ki\",\"value\":\"89\"}]',0,0,'','','','[{\"key\":\"Average\",\"value\":3},{\"key\":\"fg\",\"value\":3}]',NULL,'','','Inactive','','','\"\"','','2015-12-29 22:45:03','2015-12-29 16:45:02'),
	(28,NULL,NULL,'apples',NULL,'[]',NULL,NULL,NULL,NULL,NULL,'[{\"key\":\"Average\",\"value\":0}]',NULL,NULL,NULL,'Inactive',NULL,NULL,'\"\"',NULL,'2016-01-03 15:27:51','2016-01-03 15:27:51'),
	(29,NULL,NULL,'test',NULL,'[]',NULL,NULL,NULL,NULL,NULL,'[{\"key\":\"Average\",\"value\":0}]',NULL,NULL,NULL,'Inactive',NULL,NULL,'\"\"',NULL,'2016-01-03 15:27:55','2016-01-03 15:27:55'),
	(30,NULL,NULL,'testing',NULL,'[]',NULL,NULL,NULL,NULL,NULL,'[{\"key\":\"Average\",\"value\":0}]',NULL,NULL,NULL,'Inactive',NULL,NULL,'\"\"',NULL,'2016-01-03 15:27:58','2016-01-03 15:27:58'),
	(31,44,'Nest Learning Thermostat v2','nest-learning-thermostat-v2','<p>nest-learning-thermostat-v2nest-learning-thermostat-v2nest-learning-thermostat-v2nest-learning-thermostat-v2nest-learning-thermostat-v2nest-learning-thermostat-v2nest-learning-thermostat-v2nest-learning-thermostat-v2nest-learning-thermostat-v2nest-learning-thermostat-v2nest-learning-thermostat-v2nest-learning-thermostat-v2nest-learning-thermostat-v2nest-learning-thermostat-v2nest-learning-thermostat-v2nest-learning-thermostat-v2nest-learning-thermostat-v2nest-learning-thermostat-v2nest-learning-thermostat-v2nest-learning-thermostat-v2nest-learning-thermostat-v2nest-learning-thermostat-v2nest-learning-thermostat-v2nest-learning-thermostat-v2nest-learning-thermostat-v2nest-learning-thermostat-v2nest-learning-thermostat-v2nest-learning-thermostat-v2nest-learning-thermostat-v2nest-learning-thermostat-v2nest-learning-thermostat-v2nest-learning-thermostat-v2nest-learning-thermostat-v2nest-learning-thermostat-v2nest-learning-thermostat-v2nest-learning-thermostat-v2nest-learning-thermostat-v2nest-learning-thermostat-v2nest-learning-thermostat-v2nest-learning-thermostat-v2nest-learning-thermostat-v2nest-learning-thermostat-v2nest-learning-thermostat-v2nest-learning-thermostat-v2</p>','[]',250,225,'Amazon','http://www.amazon.com','','[{\"key\":\"Average\",\"value\":0}]',NULL,'0','NEST','Inactive','Nest Learning Thermostat v2','Find and share best smart home gadgets like the Nest Thermostat','\"\"','Yes','2016-01-04 14:29:29','2016-01-04 14:29:32'),
	(32,NULL,NULL,'testtest',NULL,'[]',NULL,NULL,NULL,NULL,NULL,'[{\"key\":\"Average\",\"value\":0}]',NULL,NULL,NULL,'Inactive',NULL,NULL,'\"\"',NULL,'2016-01-03 15:28:02','2016-01-03 15:28:02'),
	(33,NULL,NULL,'asda',NULL,'[]',NULL,NULL,NULL,NULL,NULL,'[{\"key\":\"Average\",\"value\":0}]',NULL,NULL,NULL,'Inactive',NULL,NULL,'\"\"',NULL,'2016-01-03 15:28:04','2016-01-03 15:28:04');

/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table role_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `role_user`;

CREATE TABLE `role_user` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_user_role_id_foreign` (`role_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table user_profiles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_profiles`;

CREATE TABLE `user_profiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `user_profiles` WRITE;
/*!40000 ALTER TABLE `user_profiles` DISABLE KEYS */;

INSERT INTO `user_profiles` (`id`, `user_id`, `created_at`, `updated_at`)
VALUES
	(23,27,'2015-12-06 06:33:44','2015-12-06 00:33:44'),
	(24,28,'2015-12-06 12:38:38','2015-12-06 06:38:38'),
	(26,30,'2015-12-06 15:00:40','2015-12-06 09:00:40'),
	(27,31,'2015-12-06 15:15:08','2015-12-06 09:15:08');

/*!40000 ALTER TABLE `user_profiles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `status`, `created_at`, `updated_at`)
VALUES
	(27,'Tac Box','tanvir@carbon51.com','$2y$10$aY10NyjMgEF8NEK0bC2vBuALVoRgyaM0Sa.KqZXybrTzzT4Ri2aPi',NULL,'Active','2015-12-06 00:33:44','2015-12-06 08:50:52'),
	(28,'Shimana Alam','alam.rhidima@gmail.com','$2y$10$NLbRDf86XND7hX3w347uVeXrlxFec.JS/VunugNbrA9gS0UdqkdNy',NULL,'Active','2015-12-06 06:38:38','2015-12-06 06:38:39'),
	(30,'Tan New','tefax@vkcode.ru','$2y$10$FHMdM1swhJmYSAZtNEhV/u2HSGR4MT4EKvnDyf8RfAIcjgJVPwvIq',NULL,'Active','2015-12-06 09:00:39','2015-12-06 09:49:02'),
	(31,'Tanvir Anowar','tanvir.net@gmail.com','$2y$10$7pj1uLWfV03zLl7AgL3SEOLPLTmTwhjX4p7AQiQnxXz4Z5aOBUXwO',NULL,'Active','2015-12-06 09:15:08','2015-12-06 09:42:47');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
