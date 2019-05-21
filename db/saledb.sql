-- MySQL dump 10.13  Distrib 8.0.15, for Win64 (x86_64)
--
-- Host: localhost    Database: saledb
-- ------------------------------------------------------
-- Server version	8.0.15

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `url_avt` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` smallint(1) NOT NULL,
  `status` smallint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(1) NOT NULL DEFAULT '1',
  `level` smallint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'Nguyễn Công Thành','Thôn 2 Long Hưng Bình Phước Việt Nam','nct@gmail.com','e10adc3949ba59abbe56e057f20f883e','0335286410',1,2,'2019-04-29 07:21:48','2019-05-10 10:07:58'),(2,'Lưu Ảnh Tú','Long Hưng','LAT@gmail.com','e10adc3949ba59abbe56e057f20f883e','0986481537',1,1,'2019-05-02 14:43:16','2019-05-04 06:01:35');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brand`
--

DROP TABLE IF EXISTS `brand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brand`
--

LOCK TABLES `brand` WRITE;
/*!40000 ALTER TABLE `brand` DISABLE KEYS */;
INSERT INTO `brand` VALUES (1,'Sony','sony',1,'2019-04-29 13:45:44','2019-05-10 18:55:40'),(2,'Samsung','samsung',1,'2019-04-29 13:58:18','2019-05-02 13:16:26'),(5,'Apple','apple',1,'2019-05-11 04:48:15','2019-05-11 04:48:27'),(6,'Dell','dell',1,'2019-05-15 03:51:05','2019-05-15 03:51:05'),(7,'Cannon','cannon',1,'2019-05-15 03:55:23','2019-05-15 03:55:23'),(8,'Vizio','vizio',1,'2019-05-15 03:59:44','2019-05-15 03:59:44'),(9,'LG','lg',1,'2019-05-15 04:04:26','2019-05-15 04:04:26');
/*!40000 ALTER TABLE `brand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `banner` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(1) NOT NULL DEFAULT '1',
  `content` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Televison','televison','tv_banner.jpg',1,'Television (TV), sometimes shortened to tele or telly, is a telecommunication medium used for transmitting moving images in monochrome (black and white), or in color, and in two or three dimensions and sound','2019-04-29 07:38:35','2019-05-15 06:29:02'),(2,'SmartPhone','smartphone','phone.jpg',1,'Smartphones are a class of mobile phones and of multi-purpose mobile computing devices. They are distinguished from feature phones by their stronger hardware capabilities and extensive mobile operating systems, which facilitate wider software, internet (including web browsing[1] over mobile broadband), and multimedia functionality (including music, video, cameras, and gaming), alongside core phone functions such as voice calls and text messaging.','2019-04-29 08:17:50','2019-05-05 04:26:00'),(4,'Playstation','playstation','playstation-banner.png',1,'PlayStation (Japanese: プレイステーション Hepburn: Pureisutēshon, abbreviated as PS) is a gaming brand that consists of four home video game consoles, as well as a media center, an online service, a line of controllers, two handhelds and a phone, as well as multiple magazines. It is created and owned by Sony Interactive Entertainment since December 3, 1994, with the launch of the original PlayStation in Japan.','2019-04-29 13:57:17','2019-05-15 06:29:00'),(6,'Laptop','laptop','laptop-banner.jpg',1,'A laptop computer (also shortened to just laptop; or called a notebook or notebook computer) is a small, portable personal computer (PC) with a \"clamshell\" form factor, typically having a thin LCD or LED computer screen mounted on the inside of the upper lid of the clamshell and an alphanumeric keyboard on the inside of the lower lid.','2019-05-04 05:44:56','2019-05-15 03:48:32'),(10,'Camera','camera','avds_large.jpg',1,'A camera is an optical instrument to capture still images or to record moving images, which are stored in a physical medium such as in a digital system or on photographic film. A camera consists of a lens which focuses light from the scene, and a camera body which holds the image capture mechanism.','2019-05-05 04:18:22','2019-05-05 04:18:22'),(12,'abc','abc','C8-OLED.jpg',1,'the loaji abc','2019-05-15 06:16:36','2019-05-15 06:16:36');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detailorder`
--

DROP TABLE IF EXISTS `detailorder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `detailorder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_detailorder_order_idx` (`order_id`),
  KEY `fk_detailorder_product_idx` (`product_id`),
  CONSTRAINT `fk_detailorder_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  CONSTRAINT `fk_detailorder_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detailorder`
--

LOCK TABLES `detailorder` WRITE;
/*!40000 ALTER TABLE `detailorder` DISABLE KEYS */;
INSERT INTO `detailorder` VALUES (24,40,1,1,160,160,'2019-05-15 06:31:46','2019-05-15 06:31:46');
/*!40000 ALTER TABLE `detailorder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favorite`
--

DROP TABLE IF EXISTS `favorite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `favorite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_like_user_idx` (`user_id`),
  KEY `fk_like_product_idx` (`product_id`),
  CONSTRAINT `fk_like_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_like_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorite`
--

LOCK TABLES `favorite` WRITE;
/*!40000 ALTER TABLE `favorite` DISABLE KEYS */;
/*!40000 ALTER TABLE `favorite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `note` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_curr` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `address_curr` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `method_paying` smallint(1) NOT NULL DEFAULT '1',
  `bank_brand` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'none',
  `card_number` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'none',
  `admin_id` int(11) NOT NULL DEFAULT '0',
  `status` smallint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (32,1210,2,'Con gái của NCT','','',1,'none','none',0,1,'2019-05-12 03:35:33','2019-05-12 03:35:45'),(33,880,2,'','0986481537','Long Hưng',1,'none','none',0,1,'2019-05-12 05:31:57','2019-05-13 09:46:04'),(34,880,2,'Cháu nội mua cho ông','0986481537','38 Thôn 2 , Xã Long hưng, Huyện Phú Riềng, Tỉnh Bình Phước',1,'none','none',0,1,'2019-05-12 05:32:52','2019-05-12 05:34:00'),(35,1364,1,NULL,'0335286410','451/30 Phạm Thế Hiển, Phường 3, Quận 8, Thành Phố Hồ Chí Minh',2,'AgriBank','**********751',23,1,'2019-05-14 05:17:30','2019-05-14 06:02:43'),(36,1210,1,NULL,'0335286410','451/30 Phạm Thế Hiển, Phường 3, Quận 8, Thành Phố Hồ Chí Minh',1,'none','none',0,0,'2019-05-14 05:18:06','2019-05-14 05:18:06'),(37,176,1,'Quên note','0335286410','451/30 Phạm Thế Hiển, Phường 3, Quận 8, Thành Phố Hồ Chí Minh',1,'none','none',23,1,'2019-05-14 05:19:21','2019-05-14 15:51:51'),(38,1254,18,'Test cho Trinh','0335286410','Vĩnh Long, Việt Nam',2,'AgriBank','**********888',22,1,'2019-05-14 11:07:41','2019-05-14 11:10:05'),(39,704,24,'Mua 4 cai con 80','0987654321','SGU',2,'AgriBank','**********234',23,1,'2019-05-15 03:11:56','2019-05-15 03:13:15'),(40,176,23,'gui cho co trang','0335286410vbvcb','Nha be',2,'AgriBank','**********123',23,1,'2019-05-15 06:31:46','2019-05-15 07:31:40');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `sale` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `image` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `head` double NOT NULL DEFAULT '0',
  `view` int(11) NOT NULL DEFAULT '0',
  `pay` int(11) NOT NULL DEFAULT '0',
  `hot` tinyint(1) NOT NULL DEFAULT '0',
  `amount` int(11) NOT NULL,
  `status` smallint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_product_category_idx` (`category_id`),
  KEY `fk_product_brand_idx` (`brand_id`),
  CONSTRAINT `fk_product_brand` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`),
  CONSTRAINT `fk_product_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'Samsung S9+ da sua','samsung-s9-da-sua',2000,20,2,2,'samsung-s9.png','Experience FT99 asvcasv',0,198,12,0,99,1,'2019-04-29 15:08:50','2019-05-15 07:31:40'),(3,'Sony Playstation PS4','sony-playstation-ps4',200,0,4,1,'Sony Playstation PS4.jpg','Máy chơi game',0,10,0,0,20,1,'2019-05-02 13:03:32','2019-05-15 03:24:36'),(7,'Xperia','xperia',2000,60,2,1,'sony-xperia-1-400x460.png','Không sợ nước',0,25,8,0,1,1,'2019-05-04 15:34:44','2019-05-15 03:32:33'),(8,'Sony Xperia XZ1','sony-xperia-xz1',100,0,2,1,'xperia-xz1-2.jpg','Lại là 1 sản phẩm đến từ SONY\r\nVà chắc chắn là không sợ nước ',0,4,0,0,10,1,'2019-05-05 15:24:05','2019-05-15 05:05:02'),(12,'Samsung S8','samsung-s8',125,0,2,2,'samsungs8.jpg','Mô tả .......',0,0,0,0,35,1,'2019-05-08 08:13:26','2019-05-15 03:42:48'),(16,'Iphone 6','iphone-6',220,0,2,5,'product_1.jpg','Sản phẩm hot của Táo',0,3,10,0,25,1,'2019-05-11 04:50:09','2019-05-15 03:43:48'),(17,'PS Vita','ps-vita',100,0,4,1,'psvita.jpg','Ps Vita hahahahahahahahahahahaha\r\nĐể chơi game',0,0,0,0,35,1,'2019-05-15 03:26:31','2019-05-15 03:26:31'),(18,'Iphone XS Max','iphone-xs-max',250,0,2,5,'iphone-xs-max.png','Điện thoại của iphone khỏi quảng cáo cũng biết xịn',0,0,0,0,55,1,'2019-05-15 03:40:42','2019-05-15 03:40:42'),(19,'Dell Inspiron 3476','dell-inspiron-3476',140,0,6,6,'dell-inspiron.png','CPU:	Intel Core i3 Kabylake Refresh, 8130U, 2.20 GHz\r\nRAM:	4 GB, DDR4 (2 khe), 2400 MHz\r\nỔ cứng:	HDD: 1 TB SATA3\r\nMàn hình:	14 inch, HD (1366 x 768)\r\nCard màn hình:	Card đồ họa tích hợp, Intel® UHD Graphics 620\r\nCổng kết nối:	2 x USB 3.0, HDMI, LAN (RJ45), USB 2.0\r\nHệ điều hành:	Windows 10 Home SL\r\nThiết kế:	Vỏ nhựa, PIN rời\r\nKích thước:	Dày 23.35 mm, 1.97 Kg',0,1,0,0,50,1,'2019-05-15 03:51:49','2019-05-15 03:52:06'),(20,'Canon EOS 6D ','canon-eos-6d',200,0,10,7,'EOS-6D-Mark.jpg',' 26.2MP Full-Frame CMOS Sensor · DIGIC 7 Image Processor · 45-Point All-Cross Type AF System',0,142,0,0,40,1,'2019-05-15 03:56:16','2019-05-15 03:57:48'),(21,'Vizio P Series 4K TV','vizio-p-series-4k-tv',800,0,1,8,'Vizio-P.jpg','People throw out a lot of words like \"mid-range\" to describe many TVs that cost less than $1,000, but Vizio\'s P Series is just about as nice as it gets outside an OLED TV (8/10, WIRED Recommends).',0,0,0,0,40,1,'2019-05-15 04:00:24','2019-05-15 04:00:24'),(22,'Samsung NU8000 4K TV','samsung-nu8000-4k-tv',1000,0,1,2,'Samsung-NU8000-4K.jpg','Samsung\'s NU8000 is one of the high quality larger TVs that still has a pedestal stand, which may it more practical, depending on your setup. ',0,1,0,0,35,1,'2019-05-15 04:01:49','2019-05-15 04:01:56'),(23,'Sony X900F 4K TV','sony-x900f-4k-tv',1200,0,1,1,'Sony-X900F.jpg','The Sony X900F is another top-class TV that shouldn\'t be called mid-range. It excels with deep blacks and high contrast, and is well suited for any task, including gaming. ',0,1,0,0,60,1,'2019-05-15 04:02:51','2019-05-15 04:05:45'),(24,'Samsung Q8FN 4K UHD TV','samsung-q8fn-4k-uhd-tv',1498,0,1,2,'samsungq8qled.jpg','Samsung knows its way around a television. To compete with the noticeably superior picture quality of OLED, it came up with QLED.',0,4,0,0,46,1,'2019-05-15 04:03:48','2019-05-15 04:24:42'),(25,'C8 OLED 4K TV','c8-oled-4k-tv',1679,0,1,9,'C8-OLED.jpg','If you want to own the best picture possible, you should seek out an OLED TV, and LG is the only TV maker that manufactures them (Sony even buys its OLED displays from LG).',0,2,0,0,45,1,'2019-05-15 04:05:06','2019-05-15 04:26:19'),(26,'abc','abc',200,0,2,1,'xiaomi-note5.png','dien thaoi',0,9,0,0,10,1,'2019-05-15 06:44:12','2019-05-15 06:48:38');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `avt` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'default_avt.png',
  `note` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(1) NOT NULL DEFAULT '1',
  `level` smallint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Nguyễn NISEEL','nguyenthanh@gmail.com','e10adc3949ba59abbe56e057f20f883e','0335286410','451/30 Phạm Thế Hiển, Phường 3, Quận 8, Thành Phố Hồ Chí Minh','1-Lfn3cCdu7zDtYMJVipCURQ.jpeg','Hừmmmmmmmm',1,1,'2019-04-29 07:34:12','2019-05-14 03:38:53'),(2,'Lưu Ảnh Tú','LAT@gmail.com','e10adc3949ba59abbe56e057f20f883e','123456789','Quận 4 Thành Phố Hồ Chí Minh','ngan.jpg','',0,1,'2019-05-06 14:07:25','2019-05-14 10:56:49'),(3,'Phúc Ngô','DEDZEUD@gmail.com','e10adc3949ba59abbe56e057f20f883e',NULL,NULL,'default_avt.png',NULL,0,1,'2019-05-06 14:10:26','2019-05-12 03:30:24'),(15,'Nguyễn Đức Linh','a@gmail.com','e10adc3949ba59abbe56e057f20f883e',NULL,NULL,'default_avt.png',NULL,1,1,'2019-05-06 15:13:54','2019-05-12 03:30:24'),(18,'Lê Thị Như Ý','NhuY@gmail.com','e10adc3949ba59abbe56e057f20f883e','0335286410','Vĩnh Long, Việt Nam','gaidep.jpg','Test ForFUn',1,1,'2019-05-06 15:51:18','2019-05-14 10:58:37'),(20,'Tèo','teo@gmail.com','16c5fcbc3dc60840f1105316c29bdfef','0335286410','Địa cầu','43.jpg','Đá bóng kém',1,1,'2019-05-12 10:31:41','2019-05-12 10:42:46'),(21,'admin','admin@gmail.com','362f32df3d00e09904f414e8b84e9950',NULL,NULL,'default_avt.png',NULL,1,3,'2019-05-13 08:27:43','2019-05-13 08:29:02'),(22,'Sale','sale@gmail.com','e10adc3949ba59abbe56e057f20f883e',NULL,NULL,'default_avt.png',NULL,1,2,'2019-05-13 08:28:29','2019-05-13 08:54:58'),(23,'superadmin','superadming@gmail.com','e10adc3949ba59abbe56e057f20f883e','0335286410','Earth','default_avt.png',NULL,1,3,'2019-05-13 08:37:15','2019-05-13 08:37:27'),(24,'Trinh','trinh@gmail.com','e10adc3949ba59abbe56e057f20f883e',NULL,NULL,'default_avt.png',NULL,1,1,'2019-05-14 11:25:18','2019-05-14 11:25:18'),(25,'vcbbc','abc@gmail.vn','e10adc3949ba59abbe56e057f20f883e',NULL,NULL,'default_avt.png',NULL,1,1,'2019-05-15 06:35:40','2019-05-15 06:35:40');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-05-16 11:42:22
