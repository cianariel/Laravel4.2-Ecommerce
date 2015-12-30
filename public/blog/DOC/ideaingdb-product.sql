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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- Dumping data for table ideaingdb.products: ~2 rows (approximately)
DELETE FROM `products`;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `product_category_id`, `product_name`, `product_permalink`, `product_description`, `specifications`, `price`, `sale_price`, `store_id`, `affiliate_link`, `price_grabber_master_id`, `review`, `free_shipping`, `coupon_code`, `post_status`, `page_title`, `meta_description`, `similar_product_ids`, `product_availability`, `created_at`, `updated_at`) VALUES
	(26, NULL, NULL, 'first-book', NULL, '[{"key":"ki","value":"89"}]', NULL, NULL, NULL, NULL, NULL, '[{"key":"Average","value":3},{"key":"fg","value":3}]', NULL, NULL, 'Inactive', NULL, NULL, '""', NULL, '2015-12-29 23:01:27', '2015-12-29 23:01:27'),
	(27, NULL, '', 'ff', '', '[{"key":"ki","value":"89"}]', 0, 0, '', '', '', '[{"key":"Average","value":3},{"key":"fg","value":3}]', '', '', 'Inactive', '', '', '""', '', '2015-12-29 22:45:03', '2015-12-29 16:45:02');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
