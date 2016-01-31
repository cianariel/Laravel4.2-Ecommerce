# ************************************************************
# Sequel Pro SQL dump
# Version 4499
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.6.27-0ubuntu0.14.04.1)
# Database: IdeaingDB
# Generation Time: 2016-01-20 18:28:21 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table products
# ------------------------------------------------------------

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `product_category_id` int(10) DEFAULT NULL,
  `product_vendor_type` varchar(255) DEFAULT NULL,
  `product_vendor_id` varchar(255) DEFAULT NULL,
  `show_for` varchar(30) DEFAULT NULL,
  `user_name` varchar(50) DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;

INSERT INTO `products` (`id`, `product_category_id`, `product_vendor_type`, `product_vendor_id`, `show_for`, `user_name`, `product_name`, `product_permalink`, `product_description`, `specifications`, `price`, `sale_price`, `store_id`, `affiliate_link`, `price_grabber_master_id`, `review`, `ideaing_review_score`, `review_ext_link`, `free_shipping`, `coupon_code`, `post_status`, `page_title`, `meta_description`, `similar_product_ids`, `product_availability`, `created_at`, `updated_at`)
VALUES
	(40,45,'Amazon',NULL,NULL,'Anonymous User','August Smart Lock','august-smart-lock','<p>Testing Testing Testing Testing Testing Testing Testing Testing Apple What The best item ever. Yes it is really nice. Cool. Sweet. </p><p><br/></p><p>Its ideal for most front doors.</p>','[]',100,0,'Amazon','http://www.amazon.com/August-Smart-Lock-Keyless-Smartphone/dp/B00OHY14CS/ref=sr_1_1?ie=UTF8&qid=1452360100&sr=8-1&keywords=august+lock','','[{\"key\":\"Average\",\"value\":0,\"counter\":\"\"},{\"key\":\"Amazon\",\"value\":0,\"counter\":0}]','0','<blockquote><p><br/>Amazing Device that Just Works</p></blockquote>','0','151515515','Active','August Smart Lock Reviews and Comparisons','August Smart Lock Keyless Home Entry with Your Smartphone is the best thing ever.','[]','','2016-01-17 04:28:42','2016-01-17 04:28:46'),
	(55,47,'Amazon','B00WBJGUA2',NULL,'Anonymous User','Nest Cam Security Camera','nest-security-cam','<p>the nest Camera is amazing. Its so cool and awesome. test. test. test. test. drop cam. test. It has night vision for night time viewing.</p><p>You must get this camera. It\'s a serious contender if you seriously want to consider it.</p>','[{\"key\":\"Manufacturer\",\"value\":\"Nest Cam\"},{\"key\":\"Model\",\"value\":\"NC1102ES\"},{\"key\":\"Part Number\",\"value\":\"NC1102ES\"},{\"key\":\"Color\",\"value\":\"Black\"},{\"key\":\"Product Size\",\"value\":\"6.6 X 3.8 X 6.5 Inches\"},{\"key\":\"Package Size\",\"value\":\"3.9 X 6.6 X 6.9 Inches\"},{\"key\":\"Weight\",\"value\":\"1.8 Pound\"},{\"key\":\"Weight\",\"value\":\"1.8 Pound\"}]',199,160,'','http://www.amazon.com/Nest-NC1102ES-Cam-Security-Camera/dp/B00WBJGUA2%3Fpsc%3D1%26SubscriptionId%3DAKIAIQYICLTUI4NBTPGA%26tag%3Dideaing07-20%26linkCode%3Dxm2%26camp%3D2025%26creative%3D165953%26creativeASIN%3DB00WBJGUA2','','[{\"key\":\"Average\",\"value\":3.25,\"counter\":\"\"},{\"key\":\"Amazon\",\"value\":3.5,\"counter\":\"3612\",\"link\":\"http:\\/\\/www.amazon.com\\/Nest-NC1102ES-Cam-Security-Camera\\/dp\\/B00WBJGUA2\\/\"},{\"key\":\"CNET\",\"value\":3,\"link\":\"http:\\/\\/www.cnet.com\",\"counter\":\"\"}]','4.5','','0','','Active','Nest Security Camera','Nest cam is simply amazing.','[{\"id\":\"31\",\"name\":\"Nest-Learning-Thermostat-v2\"}]','Spring Q2','2016-01-17 15:03:31','2016-01-17 15:03:35'),
	(59,78,'Amazon','B00NIU9YG0',NULL,'Anonymous User','Misfit Wearables Flash - Fitness and Sleep Monitor (Black)','misfit-fitness','<p>Misfit Flash is compatible with iPhone 4S/5/5C/5S/6/6 Plus, iPod Touch 5th Gen and above, iPad 3/4/Air/Mini (all running iOS 6.13 and above), Samsung Galaxy S4/Note 3, Google Nexus 4/5 (Or other BLE ready Android devices running software 4.3 and above) and BLE ready Windows Phone running software 8.1 and above.</p><p>Misfit Flash is compatible with iPhone 4S/5/5C/5S/6/6 Plus, iPod Touch 5th Gen and above, iPad 3/4/Air/Mini (all running iOS 6.13 and above), Samsung Galaxy S4/Note 3, Google Nexus 4/5 (Or other BLE ready Android devices running software 4.3 and above) and BLE ready Windows Phone running software 8.1 and above.</p><p>Misfit Flash is compatible with iPhone 4S/5/5C/5S/6/6 Plus, iPod Touch 5th Gen and above, iPad 3/4/Air/Mini (all running iOS 6.13 and above), Samsung Galaxy S4/Note 3, Google Nexus 4/5 (Or other BLE ready Android devices running software 4.3 and above) and BLE ready Windows Phone running software 8.1 and above.Misfit Flash is compatible with iPhone 4S/5/5C/5S/6/6 Plus, iPod Touch 5th Gen and above, iPad 3/4/Air/Mini (all running iOS 6.13 and above), Samsung Galaxy S4/Note 3, Google Nexus 4/5 (Or other BLE ready Android devices running software 4.3 and above) and BLE ready Windows Phone running software 8.1 and above.<br style=\"color: rgb(51, 51, 51);background-color: rgb(255, 255, 255);\"/><br style=\"color: rgb(51, 51, 51);background-color: rgb(255, 255, 255);\"/><br style=\"color: rgb(51, 51, 51);background-color: rgb(255, 255, 255);\"/><br style=\"color: rgb(51, 51, 51);background-color: rgb(255, 255, 255);\"/><br/></p>','[{\"key\":\"Manufacturer\",\"value\":\"Misfit wearables\"},{\"key\":\"Model\",\"value\":\"F00AZ\"},{\"key\":\"Part Number\",\"value\":\"F00AZ\"},{\"key\":\"Color\",\"value\":\"Black\"},{\"key\":\"Product Size\",\"value\":\"3.54 X 1.17 X 3.35 Inches\"},{\"key\":\"Package Size\",\"value\":\"1.8 X 3.5 X 4.4 Inches\"},{\"key\":\"Weight\",\"value\":\"0.0006 Pound\"}]',30,15,'','http://www.amazon.com/Misfit-Wearables-Flash-Fitness-Monitor/dp/B00NIU9YG0%3Fpsc%3D1%26SubscriptionId%3DAKIAIQYICLTUI4NBTPGA%26tag%3Dideaing07-20%26linkCode%3Dxm2%26camp%3D2025%26creative%3D165953%26creativeASIN%3DB00NIU9YG0','','[{\"key\":\"Average\",\"value\":3,\"counter\":\"\"},{\"key\":\"Amazon\",\"value\":3,\"counter\":2106,\"link\":\"http:\\/\\/www.amazon.com\\/Misfit-Wearables-Flash-Fitness-Monitor\\/dp\\/B00NIU9YG0\\/ref=sr_1_1?ie=UTF8&qid=1453229557&sr=8-1&keywords=wearables\"}]','4.5','','0','','Inactive','The best Misfit Wearables Flash - Fitness and Sleep Monitor','You must buy the best Misfit Wearables Flash - Fitness and Sleep Monitor (Black) around.','\"\"','Usually ships in 24 hours','2016-01-19 19:15:38','2016-01-19 19:15:43'),
	(60,66,'Amazon','B000TKDQ5C',NULL,'Anonymous User','Lasko 754200 Ceramic Heater with Adjustable Thermostat','lasko-ceramic-adjustable-thermostat','<p>The Lasko Ceramic Heater can heat an 11\' x 13\' pretty quickly thanks to it\'s 1500 watt rating. According to many reviewers for it\'s size and price it is very effective at heating a space quickly. This heater is very easy to carry around with you as it\'s not that large and it has a handle for easy portability. It does not have a tip-over switch but it does have an overheat sensor that will shut off power as soon as it exceeds a safe level for it\'s operation. </p>','[{\"key\":\"Manufacturer\",\"value\":\"Lasko\"},{\"key\":\"Model\",\"value\":\"754200\"},{\"key\":\"Part Number\",\"value\":\"LCP-002\"},{\"key\":\"Color\",\"value\":\"Silver\"},{\"key\":\"Product Size\",\"value\":\"9.2 X 7 X 6 Inches\"},{\"key\":\"Package Size\",\"value\":\"7.1 X 7.9 X 10.8 Inches\"},{\"key\":\"Weight\",\"value\":\"2.45 Pound\"}]',36,17,'Amazon','http://www.amazon.com/Lasko-754200-Ceramic-Adjustable-Thermostat/dp/B000TKDQ5C%3Fpsc%3D1%26SubscriptionId%3DAKIAIQYICLTUI4NBTPGA%26tag%3Dideaing07-20%26linkCode%3Dxm2%26camp%3D2025%26creative%3D165953%26creativeASIN%3DB000TKDQ5C','','[{\"key\":\"Average\",\"value\":3.5,\"counter\":\"\"},{\"key\":\"Amazon\",\"value\":3.5,\"counter\":4}]','0','','','','Inactive','Lasko Ceramic Heater with Adjustable Thermostat','Lasko Ceramic Heater with Adjustable Thermostat','\"\"','Usually ships in 24 hours','2016-01-19 20:01:08','2016-01-19 20:01:12'),
	(61,134,'Amazon','B0013BKDO8',NULL,'Anonymous User','AcuRite 00613A1 Indoor Humidity Monitor','acurite-indoor-humidity-monitor','','[{\"key\":\"Manufacturer\",\"value\":\"Chaney Instruments\"},{\"key\":\"Model\",\"value\":\"00613A1\"},{\"key\":\"Part Number\",\"value\":\"613\"},{\"key\":\"Color\",\"value\":\"Silver\"},{\"key\":\"Product Size\",\"value\":\"3.06 X 1.29 X 2.45 Inches\"},{\"key\":\"Package Size\",\"value\":\"1.2 X 3.1 X 4.3 Inches\"},{\"key\":\"Weight\",\"value\":\"0.2 Pound\"}]',13,8,'','http://amzn.to/1JgbUQh','','[{\"key\":\"Average\",\"value\":3.5,\"counter\":\"\"},{\"key\":\"Amazon\",\"value\":3.5,\"counter\":4,\"link\":\"http:\\/\\/amzn.to\\/1njfDmu\"}]','0','','','','Inactive','AcuRite Indoor Humidity Monitor','AcuRite Indoor Humidity Monitor','\"\"','Usually ships in 24 hours','2016-01-19 20:11:58','2016-01-19 20:12:03'),
	(62,131,'Amazon','B002QAYJPO',NULL,'Anonymous User','Honeywell Germ Free Cool Mist Humidifier, HCM-350','honeywell-germ-free-humidifier-hcm-350','','[{\"key\":\"Manufacturer\",\"value\":\"Honeywell\"},{\"key\":\"Model\",\"value\":\"HCM-350\\/HCM-350-TGT\"},{\"key\":\"Part Number\",\"value\":\"HCM-350\"},{\"key\":\"Color\",\"value\":\"White\"},{\"key\":\"Product Size\",\"value\":\"13.03 X 10.39 X 18.58 Inches\"},{\"key\":\"Package Size\",\"value\":\"10.5 X 13 X 18.8 Inches\"},{\"key\":\"Weight\",\"value\":\"4 Pound\"}]',80,56,'Amazon','http://amzn.to/1Jgd2n5','','[{\"key\":\"Average\",\"value\":3,\"counter\":\"\"},{\"key\":\"Amazon\",\"value\":3,\"counter\":3}]','0','','','','Inactive','Honeywell Germ Free Cool Mist Humidifier','Honeywell Germ Free Cool Mist Humidifier','\"\"','Usually ships in 24 hours','2016-01-19 20:20:36','2016-01-19 20:20:40'),
	(63,121,'Amazon','B002HFA5F6',NULL,'Anonymous User','Hoover T-Series WindTunnel Pet Rewind Bagless Upright Vacuum, UH70210','hoover-t-series-windtunnel-bagless-uh70210','','[{\"key\":\"Manufacturer\",\"value\":\"Hoover\"},{\"key\":\"Model\",\"value\":\"UH70210\"},{\"key\":\"Part Number\",\"value\":\"UH70210\"},{\"key\":\"Color\",\"value\":\"Blue\"},{\"key\":\"Product Size\",\"value\":\"32.5 X 12 X 16 Inches\"},{\"key\":\"Package Size\",\"value\":\"11.8 X 16 X 32.4 Inches\"},{\"key\":\"Weight\",\"value\":\"17.8 Pound\"}]',150,134,'','http://amzn.to/1QclPFT','','[{\"key\":\"Average\",\"value\":4,\"counter\":\"\"},{\"key\":\"Amazon\",\"value\":4,\"counter\":4}]','0','','','','Inactive','Hoover T-Series WindTunnel Pet Rewind Bagless Upright Vacuum','Hoover T-Series WindTunnel Pet Rewind Bagless Upright Vacuum','\"\"','Usually ships in 1-2 business days','2016-01-19 21:11:13','2016-01-19 21:11:17'),
	(64,112,'Amazon','B00ORC2Z2S',NULL,'Anonymous User','Pure Enrichment PureSteam Fabric Steamer','pure-enrichment-puresteam-fabric-steamer','','[{\"key\":\"Manufacturer\",\"value\":\"Pure Enrichment\"},{\"key\":\"Model\",\"value\":\"PEMINISTM\"},{\"key\":\"Part Number\",\"value\":\"PEMINISTM\"},{\"key\":\"Color\",\"value\":\"White\"},{\"key\":\"Product Size\",\"value\":\" X  X  Inches\"},{\"key\":\"Package Size\",\"value\":\"3.7 X 6.5 X 9 Inches\"},{\"key\":\"Weight\",\"value\":\" Pound\"}]',50,20,'','http://amzn.to/1JgjFpk','','[{\"key\":\"Average\",\"value\":4,\"counter\":\"\"},{\"key\":\"Amazon\",\"value\":4,\"counter\":4}]','0','','','','Inactive','Pure Enrichment PureSteam Fabric Steamer','Pure Enrichment PureSteam Fabric Steamer','\"\"','Usually ships in 24 hours','2016-01-19 21:16:51','2016-01-19 21:16:55'),
	(65,55,'Amazon','B00KO9GLQ4','Shop Landing','Anonymous User','ASICS Men\'s GEL Nimbus 17 Running Shoe','shoe','<p>this is a shoe.<br/></p>','[{\"key\":\"Manufacturer\",\"value\":\"ASICS America Corporation\"},{\"key\":\"Model\",\"value\":\"GEL-Nimbus 17-M\"},{\"key\":\"Part Number\",\"value\":\"GEL-Nimbus 17-M\"},{\"key\":\"Color\",\"value\":\"Lightning-Black-Flash Yellow\"},{\"key\":\"Product Size\",\"value\":\" X  X  Inches\"},{\"key\":\"Package Size\",\"value\":\"4 X 8 X 12 Inches\"},{\"key\":\"Weight\",\"value\":\"0.73 Pound\"}]',150,0,'','http://www.amazon.com/ASICS-Mens-Nimbus-Running-Shoe/dp/B00KO9GLQ4%3FSubscriptionId%3DAKIAIQYICLTUI4NBTPGA%26tag%3Dideaing07-20%26linkCode%3Dxm2%26camp%3D2025%26creative%3D165953%26creativeASIN%3DB00KO9GLQ4','','[{\"key\":\"Average\",\"value\":0,\"counter\":\"\"},{\"key\":\"Amazon\",\"value\":0,\"counter\":0}]','0','','','','Inactive','','','\"\"','No information available','2016-01-20 17:34:23','2016-01-20 17:34:23');

/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
