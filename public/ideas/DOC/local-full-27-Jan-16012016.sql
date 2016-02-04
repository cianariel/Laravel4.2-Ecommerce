# ************************************************************
# Sequel Pro SQL dump
# Version 4499
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.6.27-0ubuntu0.14.04.1)
# Database: IdeaingDB
# Generation Time: 2016-01-27 14:04:26 +0000
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
  `is_main_item` varchar(11) DEFAULT '0',
  `mediable_id` int(11) DEFAULT NULL,
  `mediable_type` varchar(40) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `medias` WRITE;
/*!40000 ALTER TABLE `medias` DISABLE KEYS */;

INSERT INTO `medias` (`id`, `media_name`, `media_type`, `media_link`, `is_hero_item`, `is_main_item`, `mediable_id`, `mediable_type`, `created_at`, `updated_at`)
VALUES
	(9,'Kids','img-upload','file-max-limit-exit',NULL,'0',35,'App\\Models\\Product','2016-01-04 14:23:49','2016-01-04 14:23:49'),
	(11,'black tead','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-568a87587514e-Ideaing-Admin.png',NULL,'0',36,'App\\Models\\Product','2016-01-04 14:53:18','2016-01-04 14:53:18'),
	(13,'first','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-568f4431690e7-1.ideas-feed.png','0','0',38,'App\\Models\\Product','2016-01-08 05:10:05','2016-01-08 05:10:05'),
	(14,'fly','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-568f44cc0eb0d-image_upload_.png','','0',38,'App\\Models\\Product','2016-01-08 05:10:40','2016-01-08 05:10:40'),
	(15,'lkj','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-568f468c2f36b-1.ideas-feed.png','0','0',39,'App\\Models\\Product','2016-01-08 05:19:21','2016-01-08 05:19:21'),
	(17,'august lock front','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-569141987db83-august-lock.jpg','0','0',40,'App\\Models\\Product','2016-01-09 17:21:33','2016-01-09 17:21:33'),
	(18,'august lock 2','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-569141c4c0c43-august-lock2.jpg','','0',40,'App\\Models\\Product','2016-01-09 17:22:14','2016-01-09 17:22:14'),
	(26,'Kuna Integrated Smart Home Security Lantern','img-link','http://ecx.images-amazon.com/images/I/61x-mPOIUzL._SL1000_.jpg','1','0',43,'App\\Models\\Product','2016-01-12 18:19:14','2016-01-12 18:19:14'),
	(27,'Ring Wi-Fi Enabled Video Doorbell','img-link','http://ecx.images-amazon.com/images/I/41B7kZJpZLL.jpg','1','0',44,'App\\Models\\Product','2016-01-12 21:40:26','2016-01-12 21:40:26'),
	(34,'Alarm.com Indoor Wireless Fixed IP Camera','img-link','http://ecx.images-amazon.com/images/I/31FFSYgEw7L.jpg','1','0',48,'App\\Models\\Product','2016-01-13 23:42:52','2016-01-13 23:42:52'),
	(83,'Lasko Ceramic Heater - kitchen','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-569fbe9766b30-lasko-ceramic-heater-kitchen.jpg','0','0',60,'App\\Models\\Product','2016-01-20 17:06:33','2016-01-20 17:06:33'),
	(84,'Lasko Ceramic Heater - Top','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-569fbedf53808-lasko-ceramic-heater-top.jpg','','0',60,'App\\Models\\Product','2016-01-20 17:07:44','2016-01-20 17:07:44'),
	(90,'nest front','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a1297b7913d-nestcam1.jpg','0','0',55,'App\\Models\\Product','2016-01-21 18:54:54','2016-01-21 18:54:54'),
	(91,'nest back','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a1298e9ff50-nestcam2.jpg','','0',55,'App\\Models\\Product','2016-01-21 18:55:12','2016-01-21 18:55:12'),
	(92,'nest side','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a1299b905c3-nestcam3.jpg','','0',55,'App\\Models\\Product','2016-01-21 18:55:24','2016-01-21 18:55:24'),
	(93,'Nest 4','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a129c3eb191-nestcam4.jpg','','0',55,'App\\Models\\Product','2016-01-21 18:56:05','2016-01-21 18:56:05'),
	(94,'Nest 5','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a129d1ea768-nestcam5.jpg','1','0',55,'App\\Models\\Product','2016-01-21 18:56:21','2016-01-21 18:56:21'),
	(95,'Nest 6','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a129e1bbd0e-nestcam6.jpg','0','0',55,'App\\Models\\Product','2016-01-21 18:56:35','2016-01-21 18:56:35'),
	(96,'Nest 7','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a129ef1b6bb-nestcam7.jpg','','0',55,'App\\Models\\Product','2016-01-21 18:56:49','2016-01-21 18:56:49'),
	(97,'ecobee3 Smarter Wi-Fi Thermostat with Remote Sensor','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a1310a41cd6-ecobee3-smart-thermostat-hero.jpg','1','0',68,'App\\Models\\Product','2016-01-21 19:27:08','2016-01-21 19:27:08'),
	(98,'Ecobee3 - Side View','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a131402bbd1-ecobee3-smart-thermostat-front.jpg','','0',68,'App\\Models\\Product','2016-01-21 19:28:01','2016-01-21 19:28:01'),
	(99,'Ecobee3 - Side View 2','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a1317727e90-ecobee3-smart-thermostat-side-view-2.jpg','0','0',68,'App\\Models\\Product','2016-01-21 19:28:56','2016-01-21 19:28:56'),
	(100,'Ecobee3 - Front Weather Report','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a1323770421-ecobee3-smart-thermostat-front-weather-report.jpg','','0',68,'App\\Models\\Product','2016-01-21 19:32:08','2016-01-21 19:32:08'),
	(101,'Ecobee3 - Front On','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a1325eeded6-ecobee3-smart-thermostat-front-on.jpg','','0',68,'App\\Models\\Product','2016-01-21 19:32:48','2016-01-21 19:32:48'),
	(103,'Honeywell Wi-Fi Smart Thermostat - front','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a13aaaa1180-honeywell-wi-fi-smart-thermostat-rth9580wf.jpg','0','0',66,'App\\Models\\Product','2016-01-21 20:08:11','2016-01-21 20:08:11'),
	(104,'Honeywell Wi-Fi Smart Thermostat -  Hero','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a13ac3730be-honeywell-wi-fi-smart-thermostat-rth9580wf-hero.jpg','1','0',66,'App\\Models\\Product','2016-01-21 20:08:36','2016-01-21 20:08:36'),
	(105,'Honeywell Wi-Fi Smart Thermostat - Control from smart device','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a13ae068463-honeywell-wi-fi-smart-thermostat-rth9580wf-control-from-tablet.jpg','0','0',66,'App\\Models\\Product','2016-01-21 20:09:05','2016-01-21 20:09:05'),
	(106,'Honeywell Wi-Fi Smart Thermostat - different backgrounds','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a13b00502a7-honeywell-wi-fi-smart-thermostat-rth9580wf-different-backgrounds.jpg','','0',66,'App\\Models\\Product','2016-01-21 20:09:37','2016-01-21 20:09:37'),
	(107,'Hoover UH70210 Vac - front-side','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a13c5b7a1ba-hoover-uh70210-t-series-pet-rewind-bagless-upright-vacuum.jpg','0','1',63,'App\\Models\\Product','2016-01-24 17:46:56','2016-01-24 17:47:01'),
	(109,'Hoover UH70210 - Front Left','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a13d51469e3-hoover-uh70210-t-series-pet-rewind-bagless-upright-vacuum-front-left.jpg','','0',63,'App\\Models\\Product','2016-01-21 20:19:30','2016-01-21 20:19:30'),
	(110,'Hoover UH70210 Vac - Kitchen','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a13e3ecc526-hoover-t-series-windtunnel-kitchen.jpg','1','0',63,'App\\Models\\Product','2016-01-21 20:23:27','2016-01-21 20:23:27'),
	(111,'Hoover UH70210 Vac - roller adjustment','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a13e8407ae3-hoover-t-series-windtunnel-roller-adjustment.jpg','0','0',63,'App\\Models\\Product','2016-01-21 20:24:37','2016-01-21 20:24:37'),
	(112,'Hoover UH70210 Vac - couch cleaning','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a1492cab142-hoover-t-series-windtunnel-couch-cleaning.jpg','','0',63,'App\\Models\\Product','2016-01-21 21:10:05','2016-01-21 21:10:05'),
	(113,'Acurite humidity monitor - hero','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a14bcf883d0-acurite-humidity-monitor-hero.jpg','1','0',61,'App\\Models\\Product','2016-01-21 21:21:22','2016-01-21 21:21:22'),
	(114,'Acurite humidity monitor - front','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a14c440d768-acurite-humidity-monitor-front.jpg','0','1',61,'App\\Models\\Product','2016-01-24 17:45:15','2016-01-24 17:45:20'),
	(115,'Acurite humidity monitor - fridge','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a14c81eb189-acurite-humidity-monitor-fridge.jpg','','0',61,'App\\Models\\Product','2016-01-21 21:24:19','2016-01-21 21:24:19'),
	(116,'Acurite humidity monitor - front front','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a14d9f4efc9-acurite-humidity-monitor-front-front.jpg','','0',61,'App\\Models\\Product','2016-01-21 21:29:04','2016-01-21 21:29:04'),
	(117,'Puresteam - hero','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a1509d61749-puresteam-fabric-steamer-hero.jpg','1','0',64,'App\\Models\\Product','2016-01-21 21:41:50','2016-01-21 21:41:50'),
	(118,'Puresteam - package','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a150db05189-puresteam-fabric-steamer-package.jpg','0','0',64,'App\\Models\\Product','2016-01-21 21:42:51','2016-01-21 21:42:51'),
	(119,'Puresteam - front','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a150f75c916-puresteam-fabric-steamer-front.jpg','','0',64,'App\\Models\\Product','2016-01-21 21:43:20','2016-01-21 21:43:20'),
	(120,'Puresteam - steamer','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a151104be5d-puresteam-fabric-steamer.jpg','','0',64,'App\\Models\\Product','2016-01-21 21:43:45','2016-01-21 21:43:45'),
	(121,'Puresteam - shirt','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a151278e3a6-puresteam-fabric-steamer-shirt.jpg','','0',64,'App\\Models\\Product','2016-01-21 21:44:09','2016-01-21 21:44:09'),
	(122,'Honeywell hcm350 - dark view','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a158c99c683-honeywell-humidifier-hcm-350-front-dark.jpg','0','0',62,'App\\Models\\Product','2016-01-21 22:16:42','2016-01-21 22:16:42'),
	(123,'Honeywell hcm350 - front light','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a158ff25553-honeywell-humidifier-hcm-350-front-light.jpg','','0',62,'App\\Models\\Product','2016-01-21 22:17:36','2016-01-21 22:17:36'),
	(124,'Honeywell hcm350 - front black','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a159ab6dc60-honeywell-humidifier-hcm-350-front-black.jpg','','0',62,'App\\Models\\Product','2016-01-21 22:20:28','2016-01-21 22:20:28'),
	(125,'Honeywell hcm350 - office','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a159e74024f-honeywell-humidifier-hcm-350-office.jpg','1','0',62,'App\\Models\\Product','2016-01-21 22:21:27','2016-01-21 22:21:27'),
	(126,'Honeywell hcm350 - package','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a159fea2fdb-honeywell-humidifier-hcm-350-package.jpg','0','0',62,'App\\Models\\Product','2016-01-21 22:21:51','2016-01-21 22:21:51'),
	(127,'Nest Thermostat - Hero','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a15c92f0d31-nest-thermostat-hero.jpg','1','0',67,'App\\Models\\Product','2016-01-21 22:32:53','2016-01-21 22:32:53'),
	(128,'Nest Thermostat - front','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a15cfed8fb6-nest-thermostat-front.jpg','0','0',67,'App\\Models\\Product','2016-01-21 22:34:39','2016-01-21 22:34:39'),
	(129,'Nest Thermostat - Sensor Window','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a15d12a1fb2-nest-thermostat-sensor-window.jpg','','0',67,'App\\Models\\Product','2016-01-21 22:34:59','2016-01-21 22:34:59'),
	(130,'Nest Thermostat - away','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a15d25e5fbc-nest-thermostat-away.jpg','','0',67,'App\\Models\\Product','2016-01-21 22:35:18','2016-01-21 22:35:18'),
	(131,'Nest Thermostat - smartphone control','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a15d3f4d0be-nest-thermostat-smartphone-control.jpg','','0',67,'App\\Models\\Product','2016-01-21 22:35:44','2016-01-21 22:35:44'),
	(132,'August Doorlock - hero','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a1673f433fe-august-doorlock-hero.jpg','1','0',40,'App\\Models\\Product','2016-01-21 23:18:24','2016-01-21 23:18:24'),
	(133,'August Doorlocks - Insides','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a1677363442-August-doorlock-insides.jpg','0','0',40,'App\\Models\\Product','2016-01-21 23:19:19','2016-01-21 23:19:19'),
	(134,'August Doorlock - Smartphone','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a167afbad55-August-doorlock-smartphone.jpg','','0',40,'App\\Models\\Product','2016-01-21 23:20:17','2016-01-21 23:20:17'),
	(135,'August doorlock - side','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a167f394c11-august-doorlock-side.jpg','','0',40,'App\\Models\\Product','2016-01-21 23:21:25','2016-01-21 23:21:25'),
	(137,'Lasko Ceramic Heater - front','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a16f3a1df11-lasko-754200-ceramic-heater-2.jpg','','0',60,'App\\Models\\Product','2016-01-21 23:52:29','2016-01-21 23:52:29'),
	(138,'Lasko Heater - office','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a1711d6b7b0-lasko-754200-office.png','','0',60,'App\\Models\\Product','2016-01-22 00:00:30','2016-01-22 00:00:30'),
	(139,'Lasko heater - tabletop','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a1717cec1ed-lasko-754200-tabletop.png','','0',60,'App\\Models\\Product','2016-01-22 00:02:05','2016-01-22 00:02:05'),
	(140,'Nest Learning Thermostat - Hero','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a25ba8e9615-nest-thermostat-3gen-hero.jpg','1','0',69,'App\\Models\\Product','2016-01-22 16:41:14','2016-01-22 16:41:14'),
	(141,'Nest Learning Thermostat - front','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a25bd368c91-nest-thermostat-3gen-front.jpg','','0',69,'App\\Models\\Product','2016-01-22 16:41:56','2016-01-22 16:41:56'),
	(142,'Nest Learning Thermostat - side','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a25c0016ebb-nest-thermostat-3gen-side.jpg','0','0',69,'App\\Models\\Product','2016-01-22 16:42:41','2016-01-22 16:42:41'),
	(143,'Nest Learning Thermostat - hand','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a25c2352406-nest-thermostat-3gen-hand.jpg','','0',69,'App\\Models\\Product','2016-01-22 16:43:16','2016-01-22 16:43:16'),
	(144,'Nest Learning Thermostat - color screen','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a25c513a1e0-nest-thermostat-3gen-color-screen.jpg','','0',69,'App\\Models\\Product','2016-01-22 16:44:02','2016-01-22 16:44:02'),
	(145,'Nest Learning Thermostat - wall','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a25c7402e96-nest-thermostat-3gen-wall.jpg','','0',69,'App\\Models\\Product','2016-01-22 16:44:36','2016-01-22 16:44:36'),
	(146,'Nest Learning Thermostat - parts','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a25c969941b-nest-thermostat-3gen-parts.jpg','','0',69,'App\\Models\\Product','2016-01-22 16:45:11','2016-01-22 16:45:11'),
	(147,'Nest Learning Thermostat - hand 2','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a25cb1128e6-nest-thermostat-3gen-hand-2.jpg','','0',69,'App\\Models\\Product','2016-01-22 16:45:37','2016-01-22 16:45:37'),
	(148,'Nest Protect - Hero','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a2626e044c5-nest-protect-hero.jpg','1','0',70,'App\\Models\\Product','2016-01-22 17:10:07','2016-01-22 17:10:07'),
	(149,'Nest Protect 2gen - front','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a2629e3c408-nest-protect-2gen-front.jpg','0','0',70,'App\\Models\\Product','2016-01-22 17:10:56','2016-01-22 17:10:56'),
	(150,'Nest Protect - ceiling','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a262c2493af-nest-protect-2gen-ceiling.jpg','','0',70,'App\\Models\\Product','2016-01-22 17:11:31','2016-01-22 17:11:31'),
	(151,'Nest Protect - package','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a262df95ab5-nest-protect-2gen-package.jpg','','0',70,'App\\Models\\Product','2016-01-22 17:12:00','2016-01-22 17:12:00'),
	(152,'Nest Protect - glow','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a262fe7ff76-nest-protect-2gen-glow.jpg','','0',70,'App\\Models\\Product','2016-01-22 17:12:31','2016-01-22 17:12:31'),
	(153,'Nest Protect - control','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a26321c6b07-nest-protect-2gen-control.jpg','','0',70,'App\\Models\\Product','2016-01-22 17:13:06','2016-01-22 17:13:06'),
	(154,'Nest Protect - smartphone','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a26343c7066-nest-protect-2gen-smartphone.jpg','','0',70,'App\\Models\\Product','2016-01-22 17:13:40','2016-01-22 17:13:40'),
	(157,'August Smart Keypad - angle','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a269ab44917-august-smart-keypad-angle.jpg','','0',71,'App\\Models\\Product','2016-01-22 17:41:00','2016-01-22 17:41:00'),
	(158,'August Smart Keypad - Hero','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a269fd932f9-august-smart-keypad-hero.jpg','1','0',71,'App\\Models\\Product','2016-01-22 17:42:23','2016-01-22 17:42:23'),
	(159,'August Smart Keypad - Video','video-link','https://www.youtube.com/embed/SxF-vzdqgUo','0','0',71,'App\\Models\\Product','2016-01-22 17:43:51','2016-01-22 17:43:51'),
	(160,'August Smart Keypad - closeup','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a26b5a4cf95-august-smart-keypad-closeup.jpg','','0',71,'App\\Models\\Product','2016-01-22 17:48:11','2016-01-22 17:48:11'),
	(161,'GreenIQ Smart Garden Hub - Hero','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a26e00dd7d6-greeniq-smart-garden-hub-hero.jpg','1','0',72,'App\\Models\\Product','2016-01-22 17:59:30','2016-01-22 17:59:30'),
	(162,'GreenIQ Smart Garden Hub - front','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a26e2405e83-greeniq-smart-garden-hub-front.jpg','0','0',72,'App\\Models\\Product','2016-01-22 18:00:06','2016-01-22 18:00:06'),
	(163,'GreenIQ Smart Garden Hub - package','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a26e4216b4b-greeniq-smart-garden-hub-package.jpg','','0',72,'App\\Models\\Product','2016-01-22 18:00:35','2016-01-22 18:00:35'),
	(164,'GreenIQ Smart Garden Hub - smartphone','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a26e654bdb2-greeniq-smart-garden-hub-smartphone.jpg','','0',72,'App\\Models\\Product','2016-01-22 18:01:10','2016-01-22 18:01:10'),
	(165,'Rachio Iro controller - Hero','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a27085a533f-rachio-iro-smart-sprinkler-controller-hero.jpg','1','0',73,'App\\Models\\Product','2016-01-22 18:10:15','2016-01-22 18:10:15'),
	(166,'Rachio Iro controller - backyard','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a270abc374d-rachio-iro-smart-sprinkler-controller-backyard.jpg','0','0',73,'App\\Models\\Product','2016-01-22 18:10:54','2016-01-22 18:10:54'),
	(167,'Rachio Iro controller - guts','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a270ca6ea87-rachio-iro-smart-sprinkler-controller-guts.jpg','','0',73,'App\\Models\\Product','2016-01-22 18:11:23','2016-01-22 18:11:23'),
	(168,'Rachio Iro controller - smartphone app','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a270e8307f1-rachio-iro-smart-sprinkler-controller-smartphone-app.jpg','','0',73,'App\\Models\\Product','2016-01-22 18:11:53','2016-01-22 18:11:53'),
	(169,'Rachio Iro controller - front','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a27109b8ec6-rachio-iro-smart-sprinkler-controller-front.jpg','','0',73,'App\\Models\\Product','2016-01-22 18:12:26','2016-01-22 18:12:26'),
	(170,'Umbra FishHotel - Hero','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a2736f7cfb1-umbra-fishhotel-hero.jpg','1','0',74,'App\\Models\\Product','2016-01-22 18:22:40','2016-01-22 18:22:40'),
	(171,'Umbra FishHotel - 1','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a273a9def56-umbra-fishhotel-1.jpg','0','0',74,'App\\Models\\Product','2016-01-22 18:23:38','2016-01-22 18:23:38'),
	(172,'Umbra FishHotel - 2','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a273b79ba9e-umbra-fishhotel-2.jpg','','0',74,'App\\Models\\Product','2016-01-22 18:23:52','2016-01-22 18:23:52'),
	(173,'Umbra FishHotel Aquarium - 3','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a2741b1378f-umbra-fishhotel-3.jpg','','0',74,'App\\Models\\Product','2016-01-22 18:25:31','2016-01-22 18:25:31'),
	(174,'Chinatera Melting Clock - Hero','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a2755c6cd52-chinatera-melting-clock-hero.jpg','1','0',75,'App\\Models\\Product','2016-01-22 18:30:53','2016-01-22 18:30:53'),
	(175,'Chinatera Melting Clock - 1','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a275ae17955-chinatera-melting-clock-1.jpg','0','1',75,'App\\Models\\Product','2016-01-24 17:48:32','2016-01-24 17:48:37'),
	(176,'Chinatera Melting Clock - 2','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a27605ac264-chinatera-melting-clock-2.jpg','','0',75,'App\\Models\\Product','2016-01-22 18:33:42','2016-01-22 18:33:42'),
	(177,'Chinatera Melting Clock - 3','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a2761429361-chinatera-melting-clock-3.jpg','','0',75,'App\\Models\\Product','2016-01-22 18:33:57','2016-01-22 18:33:57'),
	(178,'Chinatera Melting Clock - 4','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a27620a0904-chinatera-melting-clock-4.jpg','','0',75,'App\\Models\\Product','2016-01-22 18:34:09','2016-01-22 18:34:09'),
	(179,'Chinatera Melting Clock - 5','img-upload','http://ecx.images-amazon.com/images/I/51MdVNE-9ML.jpg','','0',75,'App\\Models\\Product','2016-01-22 18:34:21','2016-01-22 18:34:21'),
	(183,'Boss modern chair - 1','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a2786eb0d8b-Boss-modern-chair-1.jpg','0','1',76,'App\\Models\\Product','2016-01-24 17:47:39','2016-01-24 17:47:44'),
	(184,'Boss modern chair - 2','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a278ac38844-Boss-modern-chair-2.jpg','','0',76,'App\\Models\\Product','2016-01-22 18:45:01','2016-01-22 18:45:01'),
	(185,'Boss modern chair - 3','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a278ed8ffd1-Boss-modern-chair-3.jpg','','0',76,'App\\Models\\Product','2016-01-22 18:46:06','2016-01-22 18:46:06'),
	(186,'Roost Battery Alarms - 1','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a28143eda67-roost-battery-alarms-1.jpg','0','0',77,'App\\Models\\Product','2016-01-22 19:21:40','2016-01-22 19:21:40'),
	(187,'Roost Battery Alarms - Hero','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a2815a08850-roost-battery-alarms-hero.jpg','1','0',77,'App\\Models\\Product','2016-01-22 19:22:02','2016-01-22 19:22:02'),
	(188,'Roost Battery Alarms - 2','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a2816ba6a3b-roost-battery-alarms-2.jpg','0','0',77,'App\\Models\\Product','2016-01-22 19:22:20','2016-01-22 19:22:20'),
	(189,'Roost Battery Alarms - 3','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a281765890c-roost-battery-alarms-3.jpg','','0',77,'App\\Models\\Product','2016-01-22 19:22:31','2016-01-22 19:22:31'),
	(190,'Roost Battery Alarms - 4','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a28181cbb47-roost-battery-alarms-4.jpg','','0',77,'App\\Models\\Product','2016-01-22 19:22:42','2016-01-22 19:22:42'),
	(192,'August Smart Keypad Side','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a3a513ee9b8-augustkeypadside.jpg','','0',71,'App\\Models\\Product','2016-01-23 16:06:45','2016-01-23 16:06:45'),
	(193,'August Smart Keypad Front','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a3af5c8fa00-augustkeypad1.jpg','0','1',71,'App\\Models\\Product','2016-01-23 16:50:38','2016-01-23 16:50:38'),
	(194,'Green Smart IQ Thumb','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a3b9fe628f6-greeniqsmartsm.jpg','0','1',72,'App\\Models\\Product','2016-01-23 17:36:06','2016-01-23 17:36:06'),
	(195,'August Smart Lock Thumb','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a3baed6ec7e-augustsmartsm.jpg','0','1',40,'App\\Models\\Product','2016-01-23 17:39:59','2016-01-23 17:39:59'),
	(196,'Nest Thumb','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a3bc0ded25a-nest3rdsm.jpg','0','1',69,'App\\Models\\Product','2016-01-23 17:44:48','2016-01-23 17:44:48'),
	(197,'Fish Hotel Thumb','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a3bc9737ed6-fishhotelsm.jpg','0','1',74,'App\\Models\\Product','2016-01-23 17:47:24','2016-01-23 17:47:24'),
	(198,'Ecobee Thumb','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a3bd6e1c54b-ecobeesm.jpg','0','1',68,'App\\Models\\Product','2016-01-23 17:50:39','2016-01-23 17:50:39'),
	(199,'Rachio Iro Controller Smart Sprink Thumb','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a3c0bfc2a95-rachiosmartirrgationsm.jpg','0','1',73,'App\\Models\\Product','2016-01-23 18:04:49','2016-01-23 18:04:49'),
	(200,'Honeywell WiFi Thermostat Thumb','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a3c1aaa7cc7-honeywellthermowifism.jpg','0','1',66,'App\\Models\\Product','2016-01-23 18:08:44','2016-01-23 18:08:44'),
	(201,'Lasko Heater Thumb','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a3dcf1bc352-laskosm.jpg','0','1',60,'App\\Models\\Product','2016-01-23 20:05:07','2016-01-23 20:05:07'),
	(202,'Nest 2nd Gen Thumb','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a3ddd39e7a2-nest2ndthumb.jpg','0','1',67,'App\\Models\\Product','2016-01-23 20:08:53','2016-01-23 20:08:53'),
	(203,'Roost Smart Battery Thumb','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a3de5f0baf5-roostsmartthumb.jpg','0','1',77,'App\\Models\\Product','2016-01-23 20:11:12','2016-01-23 20:11:12'),
	(204,'Nest Protect 2nd Gen Thumb','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a3df554e7c6-nestprotect2ndsm.jpg','0','1',70,'App\\Models\\Product','2016-01-23 20:15:18','2016-01-23 20:15:18'),
	(205,'Nestcam Thumb','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a3e05f4390b-nestcamsm.jpg','0','1',55,'App\\Models\\Product','2016-01-23 20:19:44','2016-01-23 20:19:44'),
	(206,'Puresteam Thumb','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a427da405ad-puresteamersm.jpg','0','1',64,'App\\Models\\Product','2016-01-24 01:24:43','2016-01-24 01:24:43'),
	(207,'Honeywell Germ Free Thumb','img-upload','http://s3-us-west-1.amazonaws.com/ideaing-01/product-56a42945d2d56-honeywellgermsm.jpg','0','1',62,'App\\Models\\Product','2016-01-24 01:30:47','2016-01-24 01:30:47');

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
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `product_categories` WRITE;
/*!40000 ALTER TABLE `product_categories` DISABLE KEYS */;

INSERT INTO `product_categories` (`id`, `category_name`, `extra_info`, `lock`, `parent_id`, `lft`, `rgt`, `depth`, `created_at`, `updated_at`)
VALUES
	(44,'Smart Home','smart-home',0,NULL,1,80,0,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(45,'Energy & Air','energy-and-air',0,44,2,13,1,'2016-01-22 17:08:46','2016-01-22 17:08:50'),
	(46,'Entertainment','entertainment',0,44,14,19,1,'2016-01-22 17:08:46','2016-01-22 17:08:50'),
	(47,'Lighting','lighting',0,44,20,27,1,'2016-01-22 17:08:46','2016-01-22 17:08:50'),
	(48,'Cleaning','cleaning',0,44,28,33,1,'2016-01-22 17:08:46','2016-01-22 17:08:50'),
	(49,'Networking','networking',0,44,34,45,1,'2016-01-22 17:08:46','2016-01-22 17:08:50'),
	(50,'Doors','doors',0,44,46,49,1,'2016-01-22 17:08:46','2016-01-22 17:08:50'),
	(51,'Garage','garage',0,44,50,53,1,'2016-01-22 17:08:46','2016-01-22 17:08:50'),
	(52,'Pets','pets',0,44,54,55,1,'2016-01-22 17:08:46','2016-01-22 17:08:50'),
	(53,'Appliances','appliances',0,44,56,67,1,'2016-01-22 17:08:46','2016-01-22 17:08:50'),
	(55,'Travel','travel',0,NULL,81,92,0,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(56,'Luggage','luggage',0,55,82,83,1,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(57,'Gadgets','gadgets',0,55,84,85,1,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(58,'Backpacks','backpacks',0,55,86,87,1,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(59,'Bags','bags',0,55,88,89,1,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(60,'Accessories','accessories',0,55,90,91,1,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(62,'Wearables','wearables',0,NULL,93,112,0,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(63,'Running Watches','running-watches',0,62,94,95,1,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(65,'Home Decor','home-decor',0,NULL,113,174,0,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(66,'Furniture','furniture',0,65,114,115,1,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(67,'Bedding','bedding',0,65,116,125,1,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(68,'Bath','bath',0,65,126,127,1,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(69,'Decor','decor',0,65,128,139,1,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(70,'Office','office',0,65,140,153,1,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(71,'Storage','storage',0,65,154,155,1,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(72,'Outdoor','outdoor',0,65,156,157,1,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(73,'Security','security',0,44,68,75,1,'2016-01-22 17:08:46','2016-01-22 17:08:50'),
	(78,'FitnessTrackers','fitness-trackers',0,62,96,97,1,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(79,'Cameras','cameras',0,62,98,99,1,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(80,'Smart Glasses','smart-glasses',0,62,100,101,1,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(81,'Smart Watches','smart-watches',0,62,102,103,1,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(82,'Smart Tracking','smart-tracking',0,62,104,105,1,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(83,'Kids & Pets','kids-pets',0,62,106,107,1,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(84,'Smart Sport','smart-sport',0,62,108,109,1,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(85,'Healthcare','healthcare',0,62,110,111,1,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(86,'Kitchen','kitchen',0,65,158,173,1,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(87,'Cookware','cookware',0,86,159,160,2,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(88,'Coffee & Tea','coffee-tea',0,86,161,162,2,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(89,'Cutlery','cutlery',0,86,163,164,2,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(90,'Utensils','utensils',0,86,165,166,2,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(91,'Appliances','appliances',0,86,167,168,2,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(92,'Tools & Gadgets','tools-gadgets',0,86,169,170,2,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(93,'Storage','storage',0,86,171,172,2,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(94,'Beds','beds',0,67,117,118,2,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(95,'Nightstands','nightstands',0,67,119,120,2,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(96,'Dressers','dressers',0,67,121,122,2,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(97,'Pillows','pillows',0,67,123,124,2,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(98,'Clocks','clocks',0,69,129,130,2,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(99,'Mirrors','mirrors',0,69,131,132,2,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(100,'Artwork','artwork',0,69,133,134,2,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(101,'Rugs','rugs',0,69,135,136,2,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(102,'Accessories','accessories',0,69,137,138,2,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(103,'Desks','desks',0,70,141,142,2,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(104,'Office Chairs','office-chairs',0,70,143,144,2,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(105,'Bookcases','bookcases',0,70,145,146,2,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(106,'Filing','filing-cabinets',0,70,147,148,2,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(107,'Supplies','supplies',0,70,149,150,2,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(108,'Desk Lamps','desk-lamps',0,70,151,152,2,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(109,'Stoves','stoves',0,53,57,58,2,'2016-01-22 17:08:46','2016-01-22 17:08:50'),
	(110,'Ovens','ovens',0,53,59,60,2,'2016-01-22 17:08:46','2016-01-22 17:08:50'),
	(111,'Refrigerators','refrigerators',0,53,61,62,2,'2016-01-22 17:08:46','2016-01-22 17:08:50'),
	(112,'Washer/Dryers','washer-dryers',0,53,63,64,2,'2016-01-22 17:08:46','2016-01-22 17:08:50'),
	(113,'Toilet','toilet',0,53,65,66,2,'2016-01-22 17:08:46','2016-01-22 17:08:50'),
	(114,'Remote','remote-open-close',0,51,51,52,2,'2016-01-22 17:08:46','2016-01-22 17:08:50'),
	(115,'Door Locks','door-locks',0,50,47,48,2,'2016-01-22 17:08:46','2016-01-22 17:08:50'),
	(116,'Routers','routers',0,49,35,36,2,'2016-01-22 17:08:46','2016-01-22 17:08:50'),
	(117,'Tablets','tablets',0,49,37,38,2,'2016-01-22 17:08:46','2016-01-22 17:08:50'),
	(118,'Modems','modems',0,49,39,40,2,'2016-01-22 17:08:46','2016-01-22 17:08:50'),
	(119,'Powerline','powerline',0,49,41,42,2,'2016-01-22 17:08:46','2016-01-22 17:08:50'),
	(120,'NAS','nas',0,49,43,44,2,'2016-01-22 17:08:46','2016-01-22 17:08:50'),
	(121,'Vacuums','vacuums',0,48,29,30,2,'2016-01-22 17:08:46','2016-01-22 17:08:50'),
	(122,'Robots','robots',0,48,31,32,2,'2016-01-22 17:08:46','2016-01-22 17:08:50'),
	(123,'Light Bulbs','light-bulbs',0,47,21,22,2,'2016-01-22 17:08:46','2016-01-22 17:08:50'),
	(124,'Switches','switches',0,47,23,24,2,'2016-01-22 17:08:46','2016-01-22 17:08:50'),
	(125,'Outlets','outlets',0,47,25,26,2,'2016-01-22 17:08:46','2016-01-22 17:08:50'),
	(126,'Audio','audio',0,46,15,16,2,'2016-01-22 17:08:46','2016-01-22 17:08:50'),
	(127,'Video','video',0,46,17,18,2,'2016-01-22 17:08:46','2016-01-22 17:08:50'),
	(128,'Sensors','sensors',0,73,69,70,2,'2016-01-22 17:08:46','2016-01-22 17:08:50'),
	(129,'Cameras','cameras',0,73,71,72,2,'2016-01-22 17:08:46','2016-01-22 17:08:50'),
	(130,'Home Systems','home-security-systems',0,73,73,74,2,'2016-01-22 17:08:46','2016-01-22 17:08:50'),
	(131,'Purifiers','purifiers',0,45,3,4,2,'2016-01-17 01:53:39','2016-01-17 01:53:43'),
	(132,'Fans','fans',0,45,5,6,2,'2016-01-17 01:53:50','2016-01-17 01:53:55'),
	(133,'Water','water',0,45,7,8,2,'2016-01-17 01:54:00','2016-01-17 01:54:04'),
	(134,'Thermostats','thermostats',0,45,9,10,2,'2016-01-17 01:54:18','2016-01-17 01:54:22'),
	(135,'Smoke / Carbon ','smoke-carbon-manoxide',0,45,11,12,2,'2016-01-22 17:08:46','2016-01-22 17:08:50'),
	(136,'Outdoors','outdoors',0,44,76,79,1,'2016-01-22 18:08:26','2016-01-22 18:08:31'),
	(137,'Irrigation','irrigation',0,136,77,78,2,'2016-01-22 18:08:26','2016-01-22 18:08:31');

/*!40000 ALTER TABLE `product_categories` ENABLE KEYS */;
UNLOCK TABLES;


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
  `price` double(10,2) DEFAULT NULL,
  `sale_price` double(10,2) DEFAULT NULL,
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
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;

INSERT INTO `products` (`id`, `product_category_id`, `product_vendor_type`, `product_vendor_id`, `show_for`, `user_name`, `product_name`, `product_permalink`, `product_description`, `specifications`, `price`, `sale_price`, `store_id`, `affiliate_link`, `price_grabber_master_id`, `review`, `ideaing_review_score`, `review_ext_link`, `free_shipping`, `coupon_code`, `post_status`, `page_title`, `meta_description`, `similar_product_ids`, `product_availability`, `created_at`, `updated_at`)
VALUES
	(40,45,'Amazon','B00OHY14CS','','Anonymous User','August Smart Lock - Keyless Home Entry with Your Smartphone','august-smart-lock','<p>Testing Testing Testing Testing Testing Testing Testing Testing Apple What The best item ever. Yes it is really nice. Cool. Sweet. </p><p><br/></p><p>Its ideal for most front doors.</p>','[{\"key\":\"Manufacturer\",\"value\":\"August\"},{\"key\":\"Model\",\"value\":\"ASL-1\"},{\"key\":\"Part Number\",\"value\":\"TY0918\"},{\"key\":\"Color\",\"value\":\"Silver\"},{\"key\":\"Product Size\",\"value\":\"2.21 X 3.26 X 3.26 Inches\"},{\"key\":\"Package Size\",\"value\":\"2.5 X 5 X 9 Inches\"},{\"key\":\"Weight\",\"value\":\"1 Pound\"}]',299.99,140.00,'Amazon','http://www.amazon.com/August-Smart-Lock-Keyless-Smartphone/dp/B00OHY14CS%3Fpsc%3D1%26SubscriptionId%3DAKIAIQYICLTUI4NBTPGA%26tag%3Dideaing07-20%26linkCode%3Dxm2%26camp%3D2025%26creative%3D165953%26creativeASIN%3DB00OHY14CS','','[{\"key\":\"Average\",\"value\":3.5,\"counter\":\"\"},{\"key\":\"Amazon\",\"value\":3,\"counter\":453,\"link\":\"http:\\/\\/amzn.to\\/1QhKCbK\"},{\"key\":\"CNET\",\"value\":4,\"link\":\"http:\\/\\/www.cnet.com\\/products\\/august-smart-lock\\/\",\"counter\":\"\"}]','4.5','<blockquote><p><span id=\"seodescription\" class=\"description\">We haven\'t seen a flawless smart lock yet, but the August Smart Lock comes closer than any of its competitors thanks to its ease of use and overall<br/> polish.</span><br/></p><p>- Rich Brown , ','0','151515515','Active','Best August Smart Lock Reviews and Comparisons','August Smart Lock Keyless Home Entry with Your Smartphone is the best thing ever. Ideaing provides aggregated reviews, comparisons, vs, and lowest price on the August Smart Lock.','[]','Usually ships in 24 hours','2016-01-26 18:47:17','2016-01-26 18:47:17'),
	(55,47,'Amazon','B00WBJGUA2','','Anonymous User','Nest Cam Security Camera','nest-security-cam','<p>Nest, the company that originally started with the Nest Thermostat has introduced its own security camera dubbed the Nest Cam after acquiring the popular DropCam. The Nest Cam is one of the most versatile and easy to use web camera for the home. Simply connects to your Wi-Fi network and easily access video using your iPhone or Android phone from anywhere on the world.</p><p>This Wi-Fi security camera can capture up to 1080p video footages and comes with built-in microphone so you can speak to the person on the other side.</p><p>1. Describe what the product is</p><p>2. How does it solve one\'s problem</p><p>3. Why is it unique</p><p>4. Mention how the reviewers (Amazon users or CNET or another source) said about it.</p><p>5. List 3 bullet points on its key features in your own words</p>','[{\"key\":\"Manufacturer\",\"value\":\"Nest Cam\"},{\"key\":\"Model\",\"value\":\"NC1102ES\"},{\"key\":\"Part Number\",\"value\":\"NC1102ES\"},{\"key\":\"Color\",\"value\":\"Black\"},{\"key\":\"Product Size\",\"value\":\"6.6 X 3.8 X 6.5 Inches\"},{\"key\":\"Package Size\",\"value\":\"3.9 X 6.6 X 6.9 Inches\"},{\"key\":\"Weight\",\"value\":\"1.8 Pound\"}]',199.00,183.00,'','http://www.amazon.com/Nest-NC1102ES-Cam-Security-Camera/dp/B00WBJGUA2%3Fpsc%3D1%26SubscriptionId%3DAKIAIQYICLTUI4NBTPGA%26tag%3Dideaing07-20%26linkCode%3Dxm2%26camp%3D2025%26creative%3D165953%26creativeASIN%3DB00WBJGUA2','','[{\"key\":\"Average\",\"value\":\"4.17\",\"counter\":\"\"},{\"key\":\"Amazon\",\"value\":4,\"counter\":1775,\"link\":\"http:\\/\\/www.amazon.com\\/Nest-NC1102ES-Cam-Security-Camera\\/dp\\/B00WBJGUA2\\/tag=\"},{\"key\":\"CNET\",\"value\":4.5,\"link\":\"http:\\/\\/www.cnet.com\\/products\\/nest-cam\\/\",\"counter\":0},{\"key\":\"PCMag\",\"value\":4,\"link\":\"http:\\/\\/www.pcmag.com\\/article2\\/0,2817,2488861,00.asp\",\"counter\":\"\"}]','4.5','<p>DIYers searching for a high-res live streaming camera really can\'t beat Nest Cam.<br/></p><blockquote><p>-Megan from CNET</p></blockquote>','0','','Active','Best Nest Cam Security Camera Reviews & Deals','The Nest Cam Security Camera is a Wi-Fi webcam that allows you to monitor your home and family. Ideaing provides aggregated reviews, comparisons, vs, and lowest price on the Nest Cam Security Camera.','[{\"id\":\"31\",\"name\":\"Nest-Learning-Thermostat-v2\"}]','Usually ships in 24 hours','2016-01-23 20:19:41','2016-01-23 20:19:46'),
	(60,66,'Amazon','B000TKDQ5C','','Anonymous User','Lasko Ceramic Heater with Adjustable Thermostat (754200)','lasko-ceramic-adjustable-thermostat','<p>The Lasko Ceramic Heater can heat an 11\' x 13\' pretty quickly thanks to it\'s 1500 watt rating. According to many reviewers for it\'s size and price it is very effective at heating a space quickly. This heater is very easy to carry around with you as it\'s not that large and it has a handle for easy portability. It does not have a tip-over switch but it does have an overheat sensor that will shut off power as soon as it exceeds a safe level for it\'s operation. </p>','[{\"key\":\"Manufacturer\",\"value\":\"Lasko\"},{\"key\":\"Model\",\"value\":\"754200\"},{\"key\":\"Part Number\",\"value\":\"LCP-002\"},{\"key\":\"Color\",\"value\":\"Silver\"},{\"key\":\"Product Size\",\"value\":\"9.2 X 7 X 6 Inches\"},{\"key\":\"Package Size\",\"value\":\"7.1 X 7.9 X 10.8 Inches\"},{\"key\":\"Weight\",\"value\":\"2.45 Pound\"}]',36.00,17.00,'Amazon','http://www.amazon.com/Lasko-754200-Ceramic-Adjustable-Thermostat/dp/B000TKDQ5C%3Fpsc%3D1%26SubscriptionId%3DAKIAIQYICLTUI4NBTPGA%26tag%3Dideaing07-20%26linkCode%3Dxm2%26camp%3D2025%26creative%3D165953%26creativeASIN%3DB000TKDQ5C','','[{\"key\":\"Average\",\"value\":3.5,\"counter\":\"\"},{\"key\":\"Amazon\",\"value\":3.5,\"counter\":4}]','3.5','','0','','Active','Best Lasko Ceramic Heater with Adjustable Thermostat','The Lasko Ceramic Heater is a tabletop heater for your room or office. Ideaing provides aggregated reviews, comparisons, vs, and lowest price on the Lasko Ceramic Heater.','\"\"','Usually ships in 24 hours','2016-01-23 20:05:40','2016-01-23 20:05:45'),
	(61,134,'Amazon','B0013BKDO8','','Anonymous User','AcuRite Indoor Humidity Monitor (00613A1)','acurite-indoor-humidity-monitor','','[{\"key\":\"Manufacturer\",\"value\":\"Chaney Instruments\"},{\"key\":\"Model\",\"value\":\"00613A1\"},{\"key\":\"Part Number\",\"value\":\"613\"},{\"key\":\"Color\",\"value\":\"Silver\"},{\"key\":\"Product Size\",\"value\":\"3.06 X 1.29 X 2.45 Inches\"},{\"key\":\"Package Size\",\"value\":\"1.2 X 3.1 X 4.3 Inches\"},{\"key\":\"Weight\",\"value\":\"0.2 Pound\"}]',12.99,7.99,'Amazon','http://amzn.to/1JgbUQh','','[{\"key\":\"Average\",\"value\":4.5,\"counter\":\"\"},{\"key\":\"Amazon\",\"value\":4.5,\"counter\":8286,\"link\":\"http:\\/\\/amzn.to\\/1njfDmu\"},{\"key\":\"Home Depot\",\"value\":4,\"link\":\"http:\\/\\/www.homedepot.com\\/p\\/AcuRite-Digital-Humidity-and-Temperature-Comfort-Monitor-00613\\/204350179\",\"counter\":\"21\"},{\"key\":\"Kmart\",\"value\":5,\"link\":\"http:\\/\\/www.kmart.com\\/digital-thermometer-indoor-w-humidity\\/p-005W006699361001P\",\"counter\":\"7\"}]','0','','0','','Active','Best AcuRite Indoor Humidity Monitor 00613A1 Reviews & Deals','AcuRite Indoor Humidity Monitor ensures that the humidity indoors is at a healthy level to help avoid the growth of mold, bacteria and other alergens. Ideaing provides aggregated reviews vs, and lowest price on the AcuRite Indoor Humidity Monitor','\"\"','Usually ships in 24 hours','2016-01-26 19:59:03','2016-01-26 19:59:03'),
	(62,131,'Amazon','B002QAYJPO','','Anonymous User','Honeywell Germ Free Cool Mist Humidifier, HCM-350','honeywell-germ-free-humidifier-hcm-350','','[{\"key\":\"Manufacturer\",\"value\":\"Honeywell\"},{\"key\":\"Model\",\"value\":\"HCM-350\\/HCM-350-TGT\"},{\"key\":\"Part Number\",\"value\":\"HCM-350\"},{\"key\":\"Color\",\"value\":\"White\"},{\"key\":\"Product Size\",\"value\":\"13.03 X 10.39 X 18.58 Inches\"},{\"key\":\"Package Size\",\"value\":\"10.5 X 13 X 18.8 Inches\"},{\"key\":\"Weight\",\"value\":\"4 Pound\"}]',80.00,55.00,'Amazon','http://www.amazon.com/Honeywell-Germ-Free-Humidifier-HCM-350/dp/B002QAYJPO%3Fpsc%3D1%26SubscriptionId%3DAKIAIQYICLTUI4NBTPGA%26tag%3Dideaing07-20%26linkCode%3Dxm2%26camp%3D2025%26creative%3D165953%26creativeASIN%3DB002QAYJPO','','[{\"key\":\"Average\",\"value\":4.25,\"counter\":\"\"},{\"key\":\"Amazon\",\"value\":4,\"counter\":1867,\"link\":\"http:\\/\\/amzn.to\\/1OAneG3\"},{\"key\":\"Walmart\",\"value\":4.5,\"link\":\"http:\\/\\/www.walmart.com\\/ip\\/16563558\",\"counter\":121}]','4','','0','','Active','Best Honeywell Germ Free Cool Mist Humidifier HCM-350 Reviews & Deals','This humidifier helps kill up to 99% of bacteria and mold. Ideaing provides aggregated reviews vs, and lowest price on the Honeywell Germ Free Cool Mist Humidifier.','\"\"','Usually ships in 24 hours','2016-01-24 01:31:10','2016-01-24 01:31:15'),
	(63,121,'Amazon','B002HFA5F6','Homepage','Anonymous User','Hoover T-Series WindTunnel Pet Rewind Bagless Upright Vacuum (UH70210)','hoover-t-series-windtunnel-bagless-uh70210','','[{\"key\":\"Manufacturer\",\"value\":\"Hoover\"},{\"key\":\"Model\",\"value\":\"UH70210\"},{\"key\":\"Part Number\",\"value\":\"UH70210\"},{\"key\":\"Color\",\"value\":\"Blue\"},{\"key\":\"Product Size\",\"value\":\"32.5 X 12 X 16 Inches\"},{\"key\":\"Package Size\",\"value\":\"11.8 X 16 X 32.4 Inches\"},{\"key\":\"Weight\",\"value\":\"17.8 Pound\"}]',150.00,134.00,'','http://amzn.to/1QclPFT','','[{\"key\":\"Average\",\"value\":\"3.67\",\"counter\":\"\"},{\"key\":\"Amazon\",\"value\":4,\"counter\":4},{\"key\":\"Walmart\",\"value\":4,\"link\":\"http:\\/\\/www.walmart.com\\/ip\\/Hoover-WindTunnel-Pet-Rewind-Bagless-Upright-Vacuum-UH70210\\/14504122\",\"counter\":\"412\"},{\"key\":\"Hoover\",\"value\":3,\"link\":\"http:\\/\\/hoover.com\\/products\\/details\\/uh70210\\/windtunnel-t-series-pet-rewind-bagless-upright\\/\",\"counter\":\"306\"}]','0','','0','','Active','Best Hoover T-Series WindTunnel Pet Rewind Bagless Upright Vacuum Reviews & Deals','The Hoover T-Series WindTunnel Pet Rewind Bagless Upright Vacuum has power without any suction loss. Ideaing provides aggregated reviews, comparisons, vs lowest price on the Hoover T-Series WindTunnel.','\"\"','Usually ships in 1-2 business days','2016-01-22 15:25:33','2016-01-22 15:25:38'),
	(64,57,'Amazon','B00ORC2Z2S','','Anonymous User','Pure Enrichment PureSteam Fabric Steamer - White','pure-enrichment-puresteam-fabric-steamer','<div><br/><br/><br/>1. Describe what the product is<br/><br/></div><div>2. How does it solve one\'s problem<br/><br/></div><div>3. Why is it unique<br/><br/></div><div>4. Mention how the reviewers (Amazon users or CNET or another source) said about it.<br/><br/></div><div>5. List 3 bullet points on its key features in your own words</div>','[{\"key\":\"Manufacturer\",\"value\":\"Pure Enrichment\"},{\"key\":\"Model\",\"value\":\"PEMINISTM\"},{\"key\":\"Part Number\",\"value\":\"PEMINISTM\"},{\"key\":\"Color\",\"value\":\"White\"},{\"key\":\"Product Size\",\"value\":\" X  X  Inches\"},{\"key\":\"Package Size\",\"value\":\"3.7 X 6.5 X 9 Inches\"},{\"key\":\"Weight\",\"value\":\" Pound\"}]',50.00,22.00,'Amazon','http://www.amazon.com/Pure-Enrichment-PureSteam-Fabric-Steamer/dp/B00ORC2Z2S%3Fpsc%3D1%26SubscriptionId%3DAKIAIQYICLTUI4NBTPGA%26tag%3Dideaing07-20%26linkCode%3Dxm2%26camp%3D2025%26creative%3D165953%26creativeASIN%3DB00ORC2Z2S','','[{\"key\":\"Average\",\"value\":4.5,\"counter\":\"\"},{\"key\":\"Amazon\",\"value\":4.5,\"counter\":2609,\"link\":\"http:\\/\\/amzn.to\\/1OJq6y5\"}]','4','','0','','Inactive','Best Pure Enrichment PureSteam Fabric Steamer Reviews & Deals','The Pure Enrichment PureSteam Fabric Steamer can steam your clothes and do away with wrinkles on your garments. Ideaing provides aggregated reviews vs, and lowest price on the PureSteam Fabric Steamer.','\"\"','Usually ships in 24 hours','2016-01-25 18:40:15','2016-01-25 18:40:15'),
	(66,134,'Amazon','B00V2RO1WS','','Anonymous User','Honeywell Wi-Fi Smart Thermostat (RTH9580WF)','honeywell-wi-fi-smart-thermostat-rth9580wf','','[{\"key\":\"Manufacturer\",\"value\":\"Honeywell\"},{\"key\":\"Model\",\"value\":\"HoneywellRTH9580WF\"},{\"key\":\"Part Number\",\"value\":\"HNY-RTH9580WF\"},{\"key\":\"Color\",\"value\":\"\"},{\"key\":\"Product Size\",\"value\":\" X  X  Inches\"},{\"key\":\"Package Size\",\"value\":\"4.2 X 7.2 X 9.4 Inches\"},{\"key\":\"Weight\",\"value\":\"1.2 Pound\"}]',207.00,187.00,'Amazon','http://amzn.to/20eH9PY','','[{\"key\":\"Average\",\"value\":\"4.17\",\"counter\":\"\"},{\"key\":\"Amazon\",\"value\":4.5,\"counter\":27,\"link\":\"http:\\/\\/amzn.to\\/1QeoChY\"},{\"key\":\"Home Depot\",\"value\":4,\"link\":\"http:\\/\\/www.homedepot.com\\/p\\/Honeywell-Wi-Fi-Smart-Thermostat-RTH9580WF\\/203926327\",\"counter\":\"296\"},{\"key\":\"CNET\",\"value\":4,\"link\":\"http:\\/\\/www.cnet.com\\/products\\/honeywell-wi-fi-smart-thermostat\\/\",\"counter\":\"\"}]','4','<p><span style=\"color: rgb(0, 0, 0);float: none;background-color: rgb(255, 255, 255);\">Honeywell\'s Wi-Fi Smart Thermostat can compete directly with the Nest Learning Thermostat on features, but it doesn\'t match the Nest\'s intuitive design.</span></p>','0','','Active','Best Honeywell Wi-Fi Smart Thermostat RTH9580WF Reviews & Deals','Honeywell Wi-Fi Smart Thermostat RTH9580WF adjusts the temperatures inside your home and allows you to keep track of the weather outside. Ideaing provides aggregated reviews, comparisons, vs lowest price on the Honeywell Wi-Fi Smart Thermostat.','[{\"id\":\"67\",\"name\":\"Nest-Learning-Thermostat-(2nd-Generation)\"}]','Usually ships in 24 hours','2016-01-23 18:08:41','2016-01-23 18:08:46'),
	(67,134,'Amazon','B009GDHYPQ','','Anonymous User','Nest Learning Thermostat (2nd Generation)','nest-learning-thermostat','','[{\"key\":\"Manufacturer\",\"value\":\"Nest Labs\"},{\"key\":\"Model\",\"value\":\"T200577\"},{\"key\":\"Part Number\",\"value\":\"T200577\"},{\"key\":\"Color\",\"value\":\"Stainless\"},{\"key\":\"Product Size\",\"value\":\"3.25 X 6.5 X 6.5 Inches\"},{\"key\":\"Package Size\",\"value\":\"3.3 X 6.5 X 6.7 Inches\"},{\"key\":\"Weight\",\"value\":\"1.62 Pound\"}]',249.00,189.00,'Amazon','http://amzn.to/1QepnYf','','[{\"key\":\"Average\",\"value\":4.75,\"counter\":\"\"},{\"key\":\"Amazon\",\"value\":4.5,\"counter\":4,\"link\":\"http:\\/\\/amzn.to\\/1QepnYf\"},{\"key\":\"CNET\",\"value\":5,\"link\":\"http:\\/\\/www.cnet.com\\/products\\/nest-learning-thermostat\\/\"}]','0','<p><span id=\"seodescription\" class=\"description\">The second generation of the energy-saving Nest Learning Thermostat puts this device even further ahead of the (nearly nonexistent) competition.</span><!--EndFragment--><br/><br/>- Lindsey Turrentine , CNET','0','','Active','Best Nest Learning Thermostat Reviews & Deals','The Nest Thermostat can learn your behavior and turn itself down when you\'re away to save energy. Ideaing provides aggregated reviews vs, and lowest price on the Nest Learning Thermostat.','[{\"id\":\"66\",\"name\":\"Honeywell-Wi-Fi-Smart-Thermostat-(RTH9580WF)\"},{\"id\":\"68\",\"name\":\"ecobee3-Smarter-Wi-Fi-Thermostat-with-Remote-Sensor-(2nd-Generation)\"}]','Usually ships in 24 hours','2016-01-23 20:08:50','2016-01-23 20:08:54'),
	(68,134,'Amazon','B00ZIRV39M','','Anonymous User','ecobee3 Smarter Wi-Fi Thermostat with Remote Sensor (2nd Gen)','ecobee3-smart-thermostat-2nd-gen','','[{\"key\":\"Manufacturer\",\"value\":\"Ecobee\"},{\"key\":\"Model\",\"value\":\"EB-STATe3-O2\"},{\"key\":\"Part Number\",\"value\":\"EB-STATe3-02\"},{\"key\":\"Color\",\"value\":\"Black\"},{\"key\":\"Product Size\",\"value\":\"0.93 X 3.95 X 3.95 Inches\"},{\"key\":\"Package Size\",\"value\":\"3.6 X 7.9 X 8.1 Inches\"},{\"key\":\"Weight\",\"value\":\"1.35 Pound\"}]',249.00,220.00,'','http://amzn.to/1JlAQ94','','[{\"key\":\"Average\",\"value\":\"4.17\",\"counter\":\"\"},{\"key\":\"Amazon\",\"value\":4,\"counter\":634,\"link\":\"http:\\/\\/amazon.com\"},{\"key\":\"CNET\",\"value\":4.5,\"link\":\"cnet.com\",\"counter\":\"\"},{\"key\":\"Tom\'s guide\",\"value\":4,\"link\":\"http:\\/\\/www.tomsguide.com\\/us\\/ecobee3-thermostat,review-2708.html\"}]','5','<p>The most amazing thermostat ever</p><p>-Dan Lee from CNET</p>','0','','Active','ecobee3 Smarter Wi-Fi Thermostat Reviews & Deals','The Ecobee3 is a smart thermostat that knows when to turn on your heating or cooling equipment based on your home profile. Ideaing provides aggregated reviews, comparisons, vs, and lowest price on the ecobee3.','[{\"id\":\"66\",\"name\":\"Honeywell-Wi-Fi-Smart-Thermostat-RTH9580WF\"},{\"id\":\"67\",\"name\":\"Nest-Learning-Thermostat-(2nd-Generation)\"},{\"id\":\"69\",\"name\":\"Nest-Learning-Thermostat,-3rd-Generation\"}]','Usually ships in 24 hours','2016-01-23 17:50:36','2016-01-23 17:50:41'),
	(69,134,'Amazon','B0131RG6VK','','Anonymous User','Nest Learning Thermostat (3rd Generation)','nest-learning-thermostat-3rd-generation','','[{\"key\":\"Manufacturer\",\"value\":\"Nest Labs\"},{\"key\":\"Model\",\"value\":\"T3007ES\"},{\"key\":\"Part Number\",\"value\":\"T3007ES\"},{\"key\":\"Color\",\"value\":\"1.21\"},{\"key\":\"Product Size\",\"value\":\"1.21 X 3.3 X 3.3 Inches\"},{\"key\":\"Package Size\",\"value\":\"3.9 X 8.5 X 8.5 Inches\"},{\"key\":\"Weight\",\"value\":\"1.31 Pound\"}]',249.00,210.00,'','http://amzn.to/1Qjn726','','[{\"key\":\"Average\",\"value\":\"4.50\",\"counter\":\"\"},{\"key\":\"Amazon\",\"value\":4.5,\"counter\":2049,\"link\":\"http:\\/\\/amzn.to\\/1RZbvEW\"},{\"key\":\"CNET\",\"value\":4.5,\"link\":\"http:\\/\\/www.cnet.com\\/products\\/nest-learning-thermostat-third-generation\\/\"}]','0','<p><span id=\"seodescription\" class=\"description\">Nest is still our choice for best overall smart thermostat, but it isn\'t massively different from the second-gen model</span><!--EndFragment--><br/><br/>- Megan Wollerton, CNET<!--EndFragment--><br/><br/></','0','','Active','Best Nest Learning Thermostat 3rd Generation Reviews & Deals','The Nest Thermostat learns from you and programs itself to optimally keep your home at a comfortable temperature. Ideaing provides aggregated reviews, comparisons, vs, and lowest price on the Nest Learning Thermostat 3rd Generation.','[{\"id\":\"67\",\"name\":\"Nest-Learning-Thermostat-(2nd-Generation)\"},{\"id\":\"66\",\"name\":\"Honeywell-Wi-Fi-Smart-Thermostat-(RTH9580WF)\"},{\"id\":\"68\",\"name\":\"ecobee3-Smarter-Wi-Fi-Thermostat-with-Remote-Sensor-(2nd-Gen)\"}]','Usually ships in 24 hours','2016-01-23 17:44:45','2016-01-23 17:44:50'),
	(70,135,'Amazon','B00XV1RCRY','','Anonymous User','Nest Protect 2nd Gen Smoke + Carbon Monoxide Alarm','nest-protect-2nd-gen-smoke-carbon-monoxide-alarm','','[{\"key\":\"Manufacturer\",\"value\":\"Nest Labs\"},{\"key\":\"Model\",\"value\":\"S3000BWES\"},{\"key\":\"Part Number\",\"value\":\"S3000BWES\"},{\"key\":\"Color\",\"value\":\"6.26\"},{\"key\":\"Product Size\",\"value\":\"5.3 X 1.5 X 5.3 Inches\"},{\"key\":\"Package Size\",\"value\":\"2.8 X 6.2 X 6.3 Inches\"},{\"key\":\"Weight\",\"value\":\"0.83 Pound\"}]',99.00,99.00,'','http://amzn.to/1RZfEbZ','','[{\"key\":\"Average\",\"value\":\"4.25\",\"counter\":\"\"},{\"key\":\"Amazon\",\"value\":4.5,\"counter\":1554,\"link\":\"http:\\/\\/amzn.to\\/1KuKT6E\"},{\"key\":\"CNET\",\"value\":4,\"link\":\"http:\\/\\/www.cnet.com\\/products\\/nest-protect-second-generation\\/\"}]','4.5','<p><br/><!--StartFragment--><span id=\"seodescription\" class=\"description\">No other smoke and carbon monoxide detectors available today can match the second-gen Nest Protect in terms of looks and options</span><!--EndFragment--><br/><br/>- Megan Wollerton,','0','','Active','Best Nest Protect 2nd Gen Smoke + Carbon Monoxide Alarm Reviews & Deals','The Nest Protect is a smoke + carbon manoxide detector that you can control from your smart device. Ideaing provides aggregated reviews, comparisons, vs, and lowest price on the Nest Protect 2nd Gen Smoke + Carbon Monoxide.','\"\"','Usually ships in 24 hours','2016-01-23 20:16:13','2016-01-23 20:16:17'),
	(71,115,'Amazon','B015SLMR1U','','Anonymous User','August Smart Keypad','august-smart-keypad','','[{\"key\":\"Manufacturer\",\"value\":\"August Lock\"},{\"key\":\"Model\",\"value\":\"AK-R1\"},{\"key\":\"Part Number\",\"value\":\"\"},{\"key\":\"Color\",\"value\":\"Dark Gray\"},{\"key\":\"Product Size\",\"value\":\"0.9 X 2.9 X 1 Inches\"},{\"key\":\"Package Size\",\"value\":\"2.56 X 4.25 X 4.88 Inches\"},{\"key\":\"Weight\",\"value\":\" Pound\"}]',80.00,80.00,'','http://amzn.to/1SBORlQ','','[{\"key\":\"Average\",\"value\":0,\"counter\":\"\"},{\"key\":\"Amazon\",\"value\":0,\"counter\":0}]','0','','0','','Active','Best August Smart Keypad Reviews & Deals','The August smart keypad is an add-on to the august smart lock to give you the ability to unlock it using a numeric code.Ideaing provides aggregated reviews, comparisons, vs, and lowest price on the August Smart Keypad.','[{\"id\":\"40\",\"name\":\"August-Smart-Lock---Keyless-Home-Entry-with-Your-Smartphone\"}]','Not yet released','2016-01-23 16:06:51','2016-01-23 16:06:56'),
	(72,137,'Amazon','B0147B3HM0','','Anonymous User','GreenIQ Smart Garden Hub 6 Zone Wi-Fi Irrigation Controller','greeniq-smart-garden-irrigation-controller','','[{\"key\":\"Manufacturer\",\"value\":\"GreenIQ\"},{\"key\":\"Model\",\"value\":\"GIQ-USWIF-001\\/EN\"},{\"key\":\"Part Number\",\"value\":\"GIQ-USWIF-001\\/EN\"},{\"key\":\"Color\",\"value\":\"\"},{\"key\":\"Product Size\",\"value\":\"5.91 X 2.09 X 5.91 Inches\"},{\"key\":\"Package Size\",\"value\":\"6.69 X 6.69 X 6.69 Inches\"},{\"key\":\"Weight\",\"value\":\"3.31 Pound\"}]',249.00,199.00,'','http://amzn.to/1SBPLi9','','[{\"key\":\"Average\",\"value\":\"4.00\",\"counter\":\"\"},{\"key\":\"Amazon\",\"value\":4,\"counter\":7,\"link\":\"http:\\/\\/amzn.to\\/1NpQISS\"}]','0','','0','','Active','Best GreenIQ Smart Garden Hub 6 Zone Wi-Fi Irrigation Controller Reviews & Deals','The GreenIQ smart garden hub can save you up to 50% on watering your garden by replacing your current irrigation controller. Ideaing provides aggregated reviews, comparisons, vs, and lowest price on the GreenIQ Smart Garden Hub.','[{\"id\":\"73\",\"name\":\"Rachio-IRO-Smart-Wifi-Enabled-Irrigation-Controller-8-zones\"}]','Usually ships in 1-2 business days','2016-01-23 17:36:05','2016-01-23 17:36:09'),
	(73,137,'Amazon','B00IEFXDIE','','Anonymous User','Rachio IRO Smart Wifi Enabled Irrigation Controller 8 zones','rachio-iro-smart-wifi-enabled-irrigation-controller','','[{\"key\":\"Manufacturer\",\"value\":\"Rachio\"},{\"key\":\"Model\",\"value\":\"8ZULW\"},{\"key\":\"Part Number\",\"value\":\"8ZULW\"},{\"key\":\"Color\",\"value\":\"White\"},{\"key\":\"Product Size\",\"value\":\"3.2 X 7.7 X 10.4 Inches\"},{\"key\":\"Package Size\",\"value\":\"3.4 X 7.8 X 10.5 Inches\"},{\"key\":\"Weight\",\"value\":\" Pound\"}]',249.00,150.00,'','http://amzn.to/1WBpiR9','','[{\"key\":\"Average\",\"value\":\"4.50\",\"counter\":\"\"},{\"key\":\"Amazon\",\"value\":4.5,\"counter\":676,\"link\":\"http:\\/\\/amzn.to\\/1WBpL5T\"}]','0','','0','','Active','Best Rachio IRO Smart Wifi Enabled Irrigation Controller Reviews & Deals','The Rachio IRO is a smart irrigation controller waters your garden when the weather is right. Ideaing provides aggregated reviews, comparisons, vs, and lowest price on the Rachio IRO Smart Wifi Enabled Irrigation Controller.','[{\"id\":\"72\",\"name\":\"GreenIQ-Smart-Garden-Hub-6-Zone-Wi-Fi-Irrigation-Controller\"}]','Usually ships in 1-2 business days','2016-01-23 18:04:49','2016-01-23 18:04:54'),
	(74,102,'Amazon','B0033FGDRS','','Anonymous User','Umbra FishHotel Aquarium','umbra-fishhotel-aquarium','','[{\"key\":\"Manufacturer\",\"value\":\"Umbra\"},{\"key\":\"Model\",\"value\":\"460410-660\"},{\"key\":\"Part Number\",\"value\":\"460410-660\"},{\"key\":\"Color\",\"value\":\"White\"},{\"key\":\"Product Size\",\"value\":\"8 X 7.5 X 7.5 Inches\"},{\"key\":\"Package Size\",\"value\":\"9.2 X 9.3 X 10 Inches\"},{\"key\":\"Weight\",\"value\":\"3.31 Pound\"}]',35.00,30.00,'','http://amzn.to/1WBrNTj','','[{\"key\":\"Average\",\"value\":\"4.50\",\"counter\":\"\"},{\"key\":\"Amazon\",\"value\":4.5,\"counter\":115,\"link\":\"http:\\/\\/amzn.to\\/1Qjxymg\"}]','0','','0','','Active','Best Umbra FishHotel Aquarium Reviews & Deals','The Umbra FishHotel Aquarium has a very sleek modern design perfect for the modern home. Ideaing provides aggregated reviews, comparisons, vs, and lowest price on the Umbra FishHotel Aquarium.','\"\"','Usually ships in 24 hours','2016-01-23 17:47:29','2016-01-23 17:47:34'),
	(75,98,'Amazon','B00V5RCPUA','','Anonymous User','Chinatera Novelty Creative Modern Melting Clock','chinatera-novelty-creative-modern-melting-clock','','[{\"key\":\"Manufacturer\",\"value\":\"Chinatera\"},{\"key\":\"Model\",\"value\":\"82855\"},{\"key\":\"Part Number\",\"value\":\"82855\"},{\"key\":\"Color\",\"value\":\"Black\"},{\"key\":\"Product Size\",\"value\":\" X  X  Inches\"},{\"key\":\"Package Size\",\"value\":\"5.2 X 7.5 X 7.9 Inches\"},{\"key\":\"Weight\",\"value\":\" Pound\"}]',65.00,19.00,'','http://amzn.to/1SBT9d3','','[{\"key\":\"Average\",\"value\":\"4.00\",\"counter\":\"\"},{\"key\":\"Amazon\",\"value\":4,\"counter\":7,\"link\":\"http:\\/\\/amzn.to\\/1SBT8pg\"}]','0','','','','Active','Best Chinatera Novelty Creative Modern Melting Clock Reviews & Deals','The Chinatera Melting Clock gives you the illusion that the clock is warped and melting on the wall for a modern look. Ideaing provides aggregated reviews, comparisons, vs, and lowest price on the Chinatera Novelty Creative Modern Melting Clock.','\"\"','Usually ships in 24 hours','2016-01-23 15:52:02','2016-01-23 15:52:07'),
	(76,104,'Amazon','B00IKBL2ZS','','Anonymous User','BOSS Modern Office Chair','boss-modern-office-chair','','[{\"key\":\"Manufacturer\",\"value\":\"BOSS Office Products\"},{\"key\":\"Model\",\"value\":\"B330-WT\"},{\"key\":\"Part Number\",\"value\":\"B330-WT\"},{\"key\":\"Color\",\"value\":\"White\"},{\"key\":\"Product Size\",\"value\":\"38.5 X 27 X 27 Inches\"},{\"key\":\"Package Size\",\"value\":\"12.2 X 24 X 24.5 Inches\"},{\"key\":\"Weight\",\"value\":\"24 Pound\"}]',235.00,80.00,'','http://amzn.to/1NpWjIP','','[{\"key\":\"Average\",\"value\":\"4.50\",\"counter\":\"\"},{\"key\":\"Amazon\",\"value\":4.5,\"counter\":53,\"link\":\"http:\\/\\/amzn.to\\/1NpWjIP\"}]','0','','','','Active','Best BOSS Modern Office Chair','The BOSS modern office chair is designed for those working long days sitting down at their desk. Ideaing provides aggregated reviews, comparisons, vs, and lowest price on the BOSS Modern Office Chair.','\"\"','Usually ships in 24 hours','2016-01-23 15:51:53','2016-01-23 15:51:58'),
	(77,135,'Amazon','B00ZWQHVPE','','Anonymous User','Roost Smart Battery for Smoke Alarms (900-00002)','roost-smart-battery-for-smoke-alarms-900-00002','','[{\"key\":\"Manufacturer\",\"value\":\"Roost\"},{\"key\":\"Model\",\"value\":\"900-00002\"},{\"key\":\"Part Number\",\"value\":\"\"},{\"key\":\"Color\",\"value\":\"1.90\"},{\"key\":\"Product Size\",\"value\":\"1.9 X 1.04 X 0.68 Inches\"},{\"key\":\"Package Size\",\"value\":\"1.1 X 5.2 X 5.7 Inches\"},{\"key\":\"Weight\",\"value\":\" Pound\"}]',65.00,50.00,'','http://amzn.to/1QjDLi1','','[{\"key\":\"Average\",\"value\":\"3.00\",\"counter\":\"\"},{\"key\":\"Amazon\",\"value\":3,\"counter\":83,\"link\":\"http:\\/\\/amzn.to\\/1QjDLi1\"}]','3','','0','','Active','Best Roost Smart Battery for Smoke Alarms Reviews & Deals','The Roost Smart Battery for Smoke Alarms alerts your smartphone when the alarm sounds. Ideaing provides aggregated reviews, comparisons, vs, and lowest price on the Roost Smart Battery for Smoke Alarms.','[{\"id\":\"70\",\"name\":\"Nest-Protect-2nd-Gen-Smoke-+-Carbon-Monoxide-Alarm,-Battery\"}]','Usually ships in 24 hours','2016-01-23 20:11:11','2016-01-23 20:11:15'),
	(80,44,'Amazon','','','Anonymous User','lkjlkj','lkl','<div><br/><br/><br/>1. Describe what the product is<br/><br/></div><div>2. How does it solve one\'s problem<br/><br/></div><div>3. Why is it unique<br/><br/></div><div>4. Mention how the reviewers (Amazon users or CNET or another source) said about it.<br/><br/></div><div>5. List 3 bullet points on its key features in your own words</div>','[]',0.00,0.00,'','','','[{\"key\":\"Average\",\"value\":\"3.50\",\"counter\":\"\"},{\"key\":\"Amazon\",\"value\":3.5,\"counter\":0,\"link\":\"http:\\/\\/aws.com\"}]','0','','0','','Inactive','','','\"\"','','2016-01-25 19:13:56','2016-01-25 19:13:56');

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



# Dump of table stores
# ------------------------------------------------------------

DROP TABLE IF EXISTS `stores`;

CREATE TABLE `stores` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `store_id` varchar(30) DEFAULT NULL,
  `store_name` varchar(30) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `store_description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `store_description` (`store_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



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
	(24,88,67,'App\\Models\\Product');

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
	(1,'Smart Home','Category Tag','2016-01-23 20:31:45','2016-01-23 16:24:14'),
	(2,'Energy & Air','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(3,'Purifiers','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(4,'Fans','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(5,'Water','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(6,'Thermostats','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(7,'Smoke / Carbon ','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(8,'Entertainment','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(9,'Audio','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(10,'Video','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(11,'Lighting','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(12,'Light Bulbs','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(13,'Switches','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(14,'Outlets','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(15,'Cleaning','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(16,'Vacuums','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(17,'Robots','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(18,'Networking','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(19,'Routers','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(20,'Tablets','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(21,'Modems','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(22,'Powerline','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(23,'NAS','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(24,'Doors','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(25,'Door Locks','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(26,'Garage','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(27,'Remote','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(28,'Pets','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(29,'Appliances','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(30,'Stoves','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(31,'Ovens','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(32,'Refrigerators','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(33,'Washer/Dryers','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(34,'Toilet','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(35,'Security','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(36,'Sensors','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(37,'Cameras','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(38,'Home Systems','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(39,'Outdoors','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(40,'Irrigation','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(41,'Travel','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(42,'Luggage','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(43,'Gadgets','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(44,'Backpacks','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(45,'Bags','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(46,'Accessories','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(47,'Wearables','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(48,'Running Watches','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(49,'FitnessTrackers','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(50,'Cameras','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(51,'Smart Glasses','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(52,'Smart Watches','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(53,'Smart Tracking','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(54,'Kids & Pets','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(55,'Smart Sport','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(56,'Healthcare','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(57,'Home Decor','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(58,'Furniture','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(59,'Bedding','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(60,'Beds','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(61,'Nightstands','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(62,'Dressers','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(63,'Pillows','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(64,'Bath','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(65,'Decor','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(66,'Clocks','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(67,'Mirrors','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(68,'Artwork','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(69,'Rugs','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(70,'Accessories','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(71,'Office','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(72,'Desks','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(73,'Office Chairs','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(74,'Bookcases','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(75,'Filing','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(76,'Supplies','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(77,'Desk Lamps','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(78,'Storage','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(79,'Outdoor','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(80,'Kitchen','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(81,'Cookware','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(82,'Coffee & Tea','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(83,'Cutlery','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(84,'Utensils','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(85,'Appliances','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(86,'Tools & Gadgets','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(87,'Storage','Category Tag','2016-01-23 16:24:14','2016-01-23 16:24:14'),
	(88,'living','living room','2016-01-23 20:06:54','2016-01-23 20:06:54'),
	(89,'kitchen','kitchen room','2016-01-23 20:34:46','2016-01-23 20:34:46');

/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_profiles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_profiles`;

CREATE TABLE `user_profiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
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
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
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
