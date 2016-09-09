# ************************************************************
# Sequel Pro SQL dump
# Version 4499
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.6.27-0ubuntu0.14.04.1)
# Database: IdeaingDB
# Generation Time: 2016-01-22 20:16:03 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table taggables
# ------------------------------------------------------------

DROP TABLE IF EXISTS `taggables`;

CREATE TABLE `taggables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_id` int(5) unsigned NOT NULL,
  `taggable_id` int(5) unsigned NOT NULL,
  `taggable_type` varchar(30) DEFAULT '',
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `taggables` WRITE;
/*!40000 ALTER TABLE `taggables` DISABLE KEYS */;

INSERT INTO `taggables` (`id`, `tag_id`, `taggable_id`, `taggable_type`)
VALUES
	(21,17,69,'App\\Models\\Product');

/*!40000 ALTER TABLE `taggables` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tags
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tags`;

CREATE TABLE `tags` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(50) DEFAULT NULL,
  `tag_description` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;

INSERT INTO `tags` (`id`, `tag_name`, `tag_description`, `updated_at`, `created_at`)
VALUES
	(16,'Smart Home','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(17,'Energy & Air','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(18,'Purifiers','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(19,'Fans','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(20,'Water','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(21,'Thermostats','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(22,'Entertainment','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(23,'Audio','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(24,'Video','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(25,'Lighting','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(26,'Light Bulbs','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(27,'Switches','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(28,'Outlets','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(29,'Cleaning','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(30,'Vacuums','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(31,'Robots','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(32,'Networking','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(33,'Routers','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(34,'Tablets','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(35,'Modems','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(36,'Powerline','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(37,'NAS','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(38,'Doors','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(39,'Door Locks','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(40,'Garage','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(41,'Remote','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(42,'Pets','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(43,'Appliances','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(44,'Stoves','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(45,'Ovens','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(46,'Refrigerators','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(47,'Washer/Dryers','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(48,'Toilet','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(49,'Security','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(50,'Sensors','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(51,'Cameras','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(52,'Home Systems','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(53,'Travel','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(54,'Luggage','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(55,'Gadgets','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(56,'Backpacks','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(57,'Bags','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(58,'Accessories','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(59,'Wearables','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(60,'Running Watches','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(61,'FitnessTrackers','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(62,'Cameras','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(63,'Smart Glasses','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(64,'Smart Watches','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(65,'Smart Tracking','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(66,'Kids & Pets','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(67,'Smart Sport','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(68,'Healthcare','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(69,'Home Decor','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(70,'Furniture','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(71,'Bedding','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(72,'Beds','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(73,'Nightstands','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(74,'Dressers','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(75,'Pillows','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(76,'Bath','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(77,'Decor','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(78,'Clocks','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(79,'Mirrors','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(80,'Artwork','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(81,'Rugs','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(82,'Accessories','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(83,'Office','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(84,'Desks','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(85,'Office Chairs','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(86,'Bookcases','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(87,'Filing','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(88,'Supplies','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(89,'Desk Lamps','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(90,'Storage','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(91,'Outdoor','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(92,'Kitchen','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(93,'Cookware','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(94,'Coffee & Tea','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(95,'Cutlery','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(96,'Utensils','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(97,'Appliances','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(98,'Tools & Gadgets','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(99,'Storage','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(100,'Parent','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(101,'Child','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58'),
	(102,'Grandchild','Category Tag','2016-01-22 20:01:58','2016-01-22 20:01:58');

/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
