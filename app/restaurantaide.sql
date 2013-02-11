-- MySQL dump 10.13  Distrib 5.1.67, for debian-linux-gnu (i486)
--
-- Host: localhost    Database: restaurantaide
-- ------------------------------------------------------
-- Server version	5.1.67-0ubuntu0.10.04.1-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `acl_permissions`
--

DROP TABLE IF EXISTS `acl_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acl_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(250) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acl_permissions`
--

LOCK TABLES `acl_permissions` WRITE;
/*!40000 ALTER TABLE `acl_permissions` DISABLE KEYS */;
INSERT INTO `acl_permissions` VALUES (1,'controllers/Admins',1,'2013-02-08 18:02:03','2013-02-08 18:02:03'),(2,'controllers/Categories',1,'2013-02-08 18:02:03','2013-02-08 18:02:03'),(3,'controllers/Companies',1,'2013-02-08 18:02:03','2013-02-08 18:02:03'),(4,'controllers/Groups',1,'2013-02-08 18:02:03','2013-02-08 18:02:03'),(5,'controllers/Menus',1,'2013-02-08 18:02:03','2013-02-08 18:02:03'),(6,'controllers/Orders',1,'2013-02-08 18:02:03','2013-02-08 18:02:03'),(7,'controllers/Pages',1,'2013-02-08 18:02:03','2013-02-08 18:02:03'),(8,'controllers/Printers',1,'2013-02-08 18:02:03','2013-02-08 18:02:03'),(9,'controllers/Reports',1,'2013-02-08 18:02:03','2013-02-08 18:02:03'),(10,'controllers/TaxInfos',1,'2013-02-08 18:02:03','2013-02-08 18:02:03'),(11,'controllers/Users',1,'2013-02-08 18:02:03','2013-02-08 18:02:03'),(12,'controllers/FusionCharts',1,'2013-02-08 18:02:03','2013-02-08 18:02:03'),(13,'controllers/Admins',2,'2013-02-08 18:34:23','2013-02-08 18:34:23'),(14,'controllers/Categories',2,'2013-02-08 18:34:23','2013-02-08 18:34:23'),(15,'controllers/Companies',2,'2013-02-08 18:34:23','2013-02-08 18:34:23'),(16,'controllers/Menus',2,'2013-02-08 18:34:23','2013-02-08 18:34:23'),(17,'controllers/Orders',2,'2013-02-08 18:34:23','2013-02-08 18:34:23'),(18,'controllers/Pages',2,'2013-02-08 18:34:23','2013-02-08 18:34:23'),(19,'controllers/Printers',2,'2013-02-08 18:34:23','2013-02-08 18:34:23'),(20,'controllers/Reports',2,'2013-02-08 18:34:23','2013-02-08 18:34:23'),(21,'controllers/TaxInfos',2,'2013-02-08 18:34:23','2013-02-08 18:34:23'),(22,'controllers/Users',2,'2013-02-08 18:34:23','2013-02-08 18:34:23'),(23,'controllers/FusionCharts',2,'2013-02-08 18:34:23','2013-02-08 18:34:23'),(24,'controllers/Admins',3,'2013-02-08 18:35:25','2013-02-08 18:35:25'),(25,'controllers/Categories',3,'2013-02-08 18:35:25','2013-02-08 18:35:25'),(26,'controllers/Companies',3,'2013-02-08 18:35:25','2013-02-08 18:35:25'),(27,'controllers/Orders',3,'2013-02-08 18:35:25','2013-02-08 18:35:25'),(28,'controllers/Pages',3,'2013-02-08 18:35:25','2013-02-08 18:35:25'),(29,'controllers/Printers',3,'2013-02-08 18:35:25','2013-02-08 18:35:25'),(30,'controllers/Reports',3,'2013-02-08 18:35:25','2013-02-08 18:35:25'),(31,'controllers/TaxInfos',3,'2013-02-08 18:35:25','2013-02-08 18:35:25'),(32,'controllers/Users',3,'2013-02-08 18:35:25','2013-02-08 18:35:25'),(33,'controllers/FusionCharts',3,'2013-02-08 18:35:25','2013-02-08 18:35:25'),(34,'controllers/Admins/login',4,'2013-02-08 18:36:45','2013-02-08 18:36:45'),(35,'controllers/Admins/logout',4,'2013-02-08 18:36:45','2013-02-08 18:36:45'),(36,'controllers/Admins/index',4,'2013-02-08 18:36:45','2013-02-08 18:36:45'),(37,'controllers/Admins/retract',4,'2013-02-08 18:36:45','2013-02-08 18:36:45'),(38,'controllers/Admins/delete',4,'2013-02-08 18:36:45','2013-02-08 18:36:45'),(39,'controllers/Pages',4,'2013-02-08 18:36:45','2013-02-08 18:36:45'),(40,'controllers/Printers',4,'2013-02-08 18:36:45','2013-02-08 18:36:45'),(41,'controllers/Users/view',4,'2013-02-08 18:36:45','2013-02-08 18:36:45');
/*!40000 ALTER TABLE `acl_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acos`
--

DROP TABLE IF EXISTS `acos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acos`
--

LOCK TABLES `acos` WRITE;
/*!40000 ALTER TABLE `acos` DISABLE KEYS */;
INSERT INTO `acos` VALUES (1,NULL,NULL,NULL,'controllers',1,256),(2,1,NULL,NULL,'Admins',2,19),(3,2,NULL,NULL,'login',3,4),(4,2,NULL,NULL,'logout',5,6),(5,2,NULL,NULL,'index',7,8),(6,2,NULL,NULL,'retract',9,10),(7,2,NULL,NULL,'delete',11,12),(8,2,NULL,NULL,'add',13,14),(9,2,NULL,NULL,'edit',15,16),(10,2,NULL,NULL,'view',17,18),(11,1,NULL,NULL,'Categories',20,31),(12,11,NULL,NULL,'index',21,22),(13,11,NULL,NULL,'view',23,24),(14,11,NULL,NULL,'add',25,26),(15,11,NULL,NULL,'edit',27,28),(16,11,NULL,NULL,'delete',29,30),(17,1,NULL,NULL,'Companies',32,43),(18,17,NULL,NULL,'index',33,34),(19,17,NULL,NULL,'view',35,36),(20,17,NULL,NULL,'add',37,38),(21,17,NULL,NULL,'edit',39,40),(22,17,NULL,NULL,'delete',41,42),(23,1,NULL,NULL,'Groups',44,57),(24,23,NULL,NULL,'index',45,46),(25,23,NULL,NULL,'view',47,48),(26,23,NULL,NULL,'add',49,50),(27,23,NULL,NULL,'initializeAcl',51,52),(28,23,NULL,NULL,'edit',53,54),(29,23,NULL,NULL,'delete',55,56),(30,1,NULL,NULL,'Menus',58,71),(31,30,NULL,NULL,'index',59,60),(32,30,NULL,NULL,'view',61,62),(33,30,NULL,NULL,'add',63,64),(34,30,NULL,NULL,'edit',65,66),(35,30,NULL,NULL,'delete',67,68),(36,30,NULL,NULL,'request',69,70),(37,1,NULL,NULL,'Orders',72,83),(38,37,NULL,NULL,'index',73,74),(39,37,NULL,NULL,'view',75,76),(40,37,NULL,NULL,'add',77,78),(41,37,NULL,NULL,'edit',79,80),(42,37,NULL,NULL,'delete',81,82),(43,1,NULL,NULL,'Pages',84,97),(44,43,NULL,NULL,'display',85,86),(45,43,NULL,NULL,'add',87,88),(46,43,NULL,NULL,'edit',89,90),(47,43,NULL,NULL,'index',91,92),(48,43,NULL,NULL,'view',93,94),(49,43,NULL,NULL,'delete',95,96),(50,1,NULL,NULL,'Printers',98,109),(51,50,NULL,NULL,'index',99,100),(52,50,NULL,NULL,'view',101,102),(53,50,NULL,NULL,'add',103,104),(54,50,NULL,NULL,'edit',105,106),(55,50,NULL,NULL,'delete',107,108),(56,1,NULL,NULL,'Reports',110,145),(57,56,NULL,NULL,'index',111,112),(58,56,NULL,NULL,'today',113,114),(59,56,NULL,NULL,'yesterday',115,116),(60,56,NULL,NULL,'byDates',117,118),(61,56,NULL,NULL,'thisWeek',119,120),(62,56,NULL,NULL,'lastWeek',121,122),(63,56,NULL,NULL,'byWeeks',123,124),(64,56,NULL,NULL,'thisMonth',125,126),(65,56,NULL,NULL,'lastMonth',127,128),(66,56,NULL,NULL,'byMonth',129,130),(67,56,NULL,NULL,'thisYear',131,132),(68,56,NULL,NULL,'lastYear',133,134),(69,56,NULL,NULL,'byYear',135,136),(70,56,NULL,NULL,'add',137,138),(71,56,NULL,NULL,'edit',139,140),(72,56,NULL,NULL,'view',141,142),(73,56,NULL,NULL,'delete',143,144),(74,1,NULL,NULL,'TaxInfos',146,157),(75,74,NULL,NULL,'index',147,148),(76,74,NULL,NULL,'view',149,150),(77,74,NULL,NULL,'add',151,152),(78,74,NULL,NULL,'edit',153,154),(79,74,NULL,NULL,'delete',155,156),(80,1,NULL,NULL,'Users',158,169),(81,80,NULL,NULL,'index',159,160),(82,80,NULL,NULL,'view',161,162),(83,80,NULL,NULL,'add',163,164),(84,80,NULL,NULL,'edit',165,166),(85,80,NULL,NULL,'delete',167,168),(86,1,NULL,NULL,'FusionCharts',170,255),(87,86,NULL,NULL,'',171,182),(88,87,NULL,NULL,'add',172,173),(89,87,NULL,NULL,'edit',174,175),(90,87,NULL,NULL,'index',176,177),(91,87,NULL,NULL,'view',178,179),(92,87,NULL,NULL,'delete',180,181),(93,86,NULL,NULL,'',183,194),(94,93,NULL,NULL,'add',184,185),(95,93,NULL,NULL,'edit',186,187),(96,93,NULL,NULL,'index',188,189),(97,93,NULL,NULL,'view',190,191),(98,93,NULL,NULL,'delete',192,193),(99,86,NULL,NULL,'',195,206),(100,99,NULL,NULL,'add',196,197),(101,99,NULL,NULL,'edit',198,199),(102,99,NULL,NULL,'index',200,201),(103,99,NULL,NULL,'view',202,203),(104,99,NULL,NULL,'delete',204,205),(105,86,NULL,NULL,'',207,218),(106,105,NULL,NULL,'add',208,209),(107,105,NULL,NULL,'edit',210,211),(108,105,NULL,NULL,'index',212,213),(109,105,NULL,NULL,'view',214,215),(110,105,NULL,NULL,'delete',216,217),(111,86,NULL,NULL,'',219,230),(112,111,NULL,NULL,'add',220,221),(113,111,NULL,NULL,'edit',222,223),(114,111,NULL,NULL,'index',224,225),(115,111,NULL,NULL,'view',226,227),(116,111,NULL,NULL,'delete',228,229),(117,86,NULL,NULL,'',231,242),(118,117,NULL,NULL,'add',232,233),(119,117,NULL,NULL,'edit',234,235),(120,117,NULL,NULL,'index',236,237),(121,117,NULL,NULL,'view',238,239),(122,117,NULL,NULL,'delete',240,241),(123,86,NULL,NULL,'',243,254),(124,123,NULL,NULL,'add',244,245),(125,123,NULL,NULL,'edit',246,247),(126,123,NULL,NULL,'index',248,249),(127,123,NULL,NULL,'view',250,251),(128,123,NULL,NULL,'delete',252,253);
/*!40000 ALTER TABLE `acos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aros`
--

DROP TABLE IF EXISTS `aros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aros` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aros`
--

LOCK TABLES `aros` WRITE;
/*!40000 ALTER TABLE `aros` DISABLE KEYS */;
INSERT INTO `aros` VALUES (1,NULL,'Group',1,NULL,1,4),(2,1,'User',1,NULL,2,3),(3,NULL,'Group',2,NULL,5,6),(4,NULL,'Group',3,NULL,7,8),(5,NULL,'Group',4,NULL,9,12),(6,5,'User',2,NULL,10,11);
/*!40000 ALTER TABLE `aros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aros_acos`
--

DROP TABLE IF EXISTS `aros_acos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aros_acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) NOT NULL,
  `aco_id` int(10) NOT NULL,
  `_create` varchar(2) NOT NULL DEFAULT '0',
  `_read` varchar(2) NOT NULL DEFAULT '0',
  `_update` varchar(2) NOT NULL DEFAULT '0',
  `_delete` varchar(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ARO_ACO_KEY` (`aro_id`,`aco_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aros_acos`
--

LOCK TABLES `aros_acos` WRITE;
/*!40000 ALTER TABLE `aros_acos` DISABLE KEYS */;
INSERT INTO `aros_acos` VALUES (1,1,1,'1','1','1','1'),(2,3,1,'-1','-1','-1','-1'),(3,3,2,'1','1','1','1'),(4,3,11,'1','1','1','1'),(5,3,17,'1','1','1','1'),(6,3,30,'1','1','1','1'),(7,3,37,'1','1','1','1'),(8,3,43,'1','1','1','1'),(9,3,50,'1','1','1','1'),(10,3,56,'1','1','1','1'),(11,3,74,'1','1','1','1'),(12,3,80,'1','1','1','1'),(13,3,86,'1','1','1','1'),(14,4,1,'-1','-1','-1','-1'),(15,4,2,'1','1','1','1'),(16,4,11,'1','1','1','1'),(17,4,17,'1','1','1','1'),(18,4,37,'1','1','1','1'),(19,4,43,'1','1','1','1'),(20,4,50,'1','1','1','1'),(21,4,56,'1','1','1','1'),(22,4,74,'1','1','1','1'),(23,4,80,'1','1','1','1'),(24,4,86,'1','1','1','1'),(25,5,1,'-1','-1','-1','-1'),(26,5,3,'1','1','1','1'),(27,5,4,'1','1','1','1'),(28,5,5,'1','1','1','1'),(29,5,6,'1','1','1','1'),(30,5,7,'1','1','1','1'),(31,5,43,'1','1','1','1'),(32,5,50,'1','1','1','1'),(33,5,82,'1','1','1','1');
/*!40000 ALTER TABLE `aros_acos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `category_list` int(4) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,1,NULL,'Combo',1,'2013-02-09 15:23:29','2013-02-09 15:23:29'),(2,1,NULL,'Sides',1,'2013-02-09 15:23:56','2013-02-09 15:23:56'),(3,1,NULL,'Plates',1,'2013-02-09 15:24:17','2013-02-09 15:24:17');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `companies` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `type` tinyint(1) DEFAULT '1',
  `name` varchar(100) DEFAULT NULL,
  `area` varchar(100) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `suite` varchar(10) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(2) DEFAULT NULL,
  `zipcode` varchar(10) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `phone_fax` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` char(40) DEFAULT NULL,
  `timed_login` varchar(25) DEFAULT '1 day',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies`
--

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
INSERT INTO `companies` VALUES (1,1,1,'Poja','Roosevelt','','','Seattle','WA',NULL,'',NULL,'',NULL,'1 day','2013-02-08 18:09:34','2013-02-08 18:09:34');
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'Super Administrator','2013-02-08 18:02:03','2013-02-08 18:02:03'),(2,'Owner','2013-02-08 18:34:23','2013-02-08 18:34:23'),(3,'Manager','2013-02-08 18:35:25','2013-02-08 18:35:25'),(4,'Employees','2013-02-08 18:36:45','2013-02-08 18:36:45');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice_lineitems`
--

DROP TABLE IF EXISTS `invoice_lineitems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoice_lineitems` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_number` int(11) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `before_tax` float(11,2) DEFAULT NULL,
  `after_tax` decimal(11,2) DEFAULT NULL,
  `day_paid` varchar(10) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice_lineitems`
--

LOCK TABLES `invoice_lineitems` WRITE;
/*!40000 ALTER TABLE `invoice_lineitems` DISABLE KEYS */;
INSERT INTO `invoice_lineitems` VALUES (1,1,'Combo',1,1,1,4.99,'5.46','Saturday','2013-02-09 15:43:12','2013-02-09 15:43:12'),(2,1,'Combo',1,2,1,4.99,'5.46','Saturday','2013-02-09 15:43:12','2013-02-09 15:43:12'),(3,1,'Combo',1,3,1,5.50,'6.02','Saturday','2013-02-09 15:43:12','2013-02-09 15:43:12'),(4,2,'Combo',1,3,1,5.50,'6.02','Saturday','2013-02-09 15:43:52','2013-02-09 15:43:52'),(5,2,'Sides',1,4,1,0.99,'1.08','Saturday','2013-02-09 15:43:52','2013-02-09 15:43:52'),(6,2,'Plates',1,6,1,6.75,'7.39','Saturday','2013-02-09 15:43:52','2013-02-09 15:43:52'),(7,3,'Plates',1,6,1,6.75,'7.39','Saturday','2013-02-09 15:44:48','2013-02-09 15:44:48'),(8,3,'Sides',1,4,1,0.99,'1.08','Saturday','2013-02-09 15:44:48','2013-02-09 15:44:48'),(9,3,'Sides',1,5,1,0.99,'1.08','Saturday','2013-02-09 15:44:48','2013-02-09 15:44:48'),(10,3,'Combo',1,1,1,4.99,'5.46','Saturday','2013-02-09 15:44:48','2013-02-09 15:44:48'),(11,3,'Combo',1,2,1,4.99,'5.46','Saturday','2013-02-09 15:44:48','2013-02-09 15:44:48'),(12,3,'Combo',1,3,1,5.50,'6.02','Saturday','2013-02-09 15:44:48','2013-02-09 15:44:48'),(13,4,'Combo',1,1,1,4.99,'5.46','Sunday','2013-02-10 22:42:06','2013-02-10 22:42:06'),(14,4,'Combo',1,2,1,4.99,'5.46','Sunday','2013-02-10 22:42:06','2013-02-10 22:42:06'),(15,4,'Combo',1,3,1,5.50,'6.02','Sunday','2013-02-10 22:42:06','2013-02-10 22:42:06'),(16,5,'Combo',1,2,1,4.99,'5.46','Sunday','2013-02-10 22:42:54','2013-02-10 22:42:54'),(17,5,'Combo',1,3,1,5.50,'6.02','Sunday','2013-02-10 22:42:54','2013-02-10 22:42:54'),(18,5,'Combo',1,1,1,4.99,'5.46','Sunday','2013-02-10 22:42:54','2013-02-10 22:42:54'),(19,5,'Sides',1,5,1,0.99,'1.08','Sunday','2013-02-10 22:42:54','2013-02-10 22:42:54'),(20,5,'Sides',1,4,1,0.99,'1.08','Sunday','2013-02-10 22:42:54','2013-02-10 22:42:54'),(21,5,'Plates',1,6,1,6.75,'7.39','Sunday','2013-02-10 22:42:54','2013-02-10 22:42:54'),(22,6,'Combo',1,2,1,4.99,'5.46','Sunday','2013-02-10 22:44:12','2013-02-10 22:44:12'),(23,6,'Combo',1,3,1,5.50,'6.02','Sunday','2013-02-10 22:44:12','2013-02-10 22:44:12'),(24,7,'Combo',1,2,1,4.99,'5.46','Sunday','2013-02-10 22:47:41','2013-02-10 22:47:41'),(25,7,'Combo',1,3,1,5.50,'6.02','Sunday','2013-02-10 22:47:41','2013-02-10 22:47:41'),(26,8,'Combo',1,1,1,4.99,'5.46','Sunday','2013-02-10 22:47:59','2013-02-10 22:47:59'),(27,8,'Combo',1,2,1,4.99,'5.46','Sunday','2013-02-10 22:47:59','2013-02-10 22:47:59'),(28,8,'Combo',1,3,1,5.50,'6.02','Sunday','2013-02-10 22:47:59','2013-02-10 22:47:59'),(29,8,'Sides',1,4,1,0.99,'1.08','Sunday','2013-02-10 22:47:59','2013-02-10 22:47:59'),(30,8,'Sides',1,5,1,0.99,'1.08','Sunday','2013-02-10 22:47:59','2013-02-10 22:47:59'),(31,8,'Plates',1,6,1,6.75,'7.39','Sunday','2013-02-10 22:47:59','2013-02-10 22:47:59'),(32,9,'Combo',1,1,1,4.99,'5.46','Sunday','2013-02-10 22:49:34','2013-02-10 22:49:34'),(33,9,'Combo',1,2,1,4.99,'5.46','Sunday','2013-02-10 22:49:34','2013-02-10 22:49:34'),(34,9,'Combo',1,3,1,5.50,'6.02','Sunday','2013-02-10 22:49:34','2013-02-10 22:49:34'),(35,9,'Sides',1,4,1,0.99,'1.08','Sunday','2013-02-10 22:49:34','2013-02-10 22:49:34'),(36,9,'Sides',1,5,1,0.99,'1.08','Sunday','2013-02-10 22:49:34','2013-02-10 22:49:34'),(37,9,'Plates',1,6,1,6.75,'7.39','Sunday','2013-02-10 22:49:34','2013-02-10 22:49:34'),(38,10,'Combo',1,1,1,4.99,'5.46','Sunday','2013-02-10 22:50:01','2013-02-10 22:50:01'),(39,10,'Combo',1,2,1,4.99,'5.46','Sunday','2013-02-10 22:50:01','2013-02-10 22:50:01'),(40,10,'Combo',1,3,1,5.50,'6.02','Sunday','2013-02-10 22:50:01','2013-02-10 22:50:01'),(41,10,'Sides',1,4,1,0.99,'1.08','Sunday','2013-02-10 22:50:01','2013-02-10 22:50:01'),(42,10,'Sides',1,5,1,0.99,'1.08','Sunday','2013-02-10 22:50:01','2013-02-10 22:50:01'),(43,10,'Plates',1,6,1,6.75,'7.39','Sunday','2013-02-10 22:50:01','2013-02-10 22:50:01'),(44,11,'Combo',1,3,1,5.50,'6.02','Sunday','2013-02-10 22:50:28','2013-02-10 22:50:28'),(45,11,'Combo',1,2,1,4.99,'5.46','Sunday','2013-02-10 22:50:28','2013-02-10 22:50:28'),(46,12,'Combo',1,3,1,5.50,'6.02','Sunday','2013-02-10 22:57:22','2013-02-10 22:57:22'),(47,12,'Combo',1,2,1,4.99,'5.46','Sunday','2013-02-10 22:57:22','2013-02-10 22:57:22'),(48,13,'Combo',1,1,1,4.99,'5.46','Sunday','2013-02-10 22:57:29','2013-02-10 22:57:29'),(49,13,'Combo',1,2,1,4.99,'5.46','Sunday','2013-02-10 22:57:29','2013-02-10 22:57:29'),(50,13,'Combo',1,3,1,5.50,'6.02','Sunday','2013-02-10 22:57:29','2013-02-10 22:57:29'),(51,14,'Combo',1,1,1,4.99,'5.46','Sunday','2013-02-10 23:03:00','2013-02-10 23:03:00'),(52,14,'Combo',1,2,1,4.99,'5.46','Sunday','2013-02-10 23:03:00','2013-02-10 23:03:00'),(53,14,'Combo',1,3,1,5.50,'6.02','Sunday','2013-02-10 23:03:00','2013-02-10 23:03:00'),(54,15,'Combo',1,2,2,NULL,'10.93','Sunday','2013-02-10 23:03:14','2013-02-10 23:03:14'),(55,15,'Combo',1,3,2,NULL,'12.04','Sunday','2013-02-10 23:03:14','2013-02-10 23:03:14'),(56,15,'Combo',1,1,2,NULL,'10.93','Sunday','2013-02-10 23:03:14','2013-02-10 23:03:14'),(57,15,'Sides',1,4,1,0.99,'1.08','Sunday','2013-02-10 23:03:14','2013-02-10 23:03:14'),(58,15,'Sides',1,5,1,0.99,'1.08','Sunday','2013-02-10 23:03:14','2013-02-10 23:03:14'),(59,15,'Plates',1,6,3,NULL,'22.17','Sunday','2013-02-10 23:03:14','2013-02-10 23:03:14');
/*!40000 ALTER TABLE `invoice_lineitems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoices` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_number` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `before_tax` decimal(11,2) NOT NULL,
  `after_tax` decimal(11,2) NOT NULL,
  `payment_type` varchar(20) DEFAULT NULL,
  `payment_number` int(12) DEFAULT NULL,
  `credit_number` varchar(10) DEFAULT NULL,
  `check_number` varchar(10) DEFAULT NULL,
  `day_paid` varchar(10) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoices`
--

LOCK TABLES `invoices` WRITE;
/*!40000 ALTER TABLE `invoices` DISABLE KEYS */;
INSERT INTO `invoices` VALUES (1,1,1,'15.48','16.94','cash',NULL,'','','Saturday','2013-02-09 15:43:12','2013-02-09 15:43:12'),(2,2,1,'13.24','14.49','credit',NULL,'4567','','Saturday','2013-02-09 15:43:52','2013-02-09 15:43:52'),(3,3,1,'24.21','26.49','credit',NULL,'12346','','Saturday','2013-02-09 15:44:48','2013-02-09 15:44:48'),(4,4,1,'15.48','16.94','cash',NULL,'','','Sunday','2013-02-10 22:42:06','2013-02-10 22:42:06'),(5,5,1,'24.21','26.49','cash',NULL,'','','Sunday','2013-02-10 22:42:54','2013-02-10 22:42:54'),(6,6,1,'10.49','11.48','cash',NULL,'','','Sunday','2013-02-10 22:44:12','2013-02-10 22:44:12'),(7,7,1,'10.49','11.48','cash',NULL,'','','Sunday','2013-02-10 22:47:41','2013-02-10 22:47:41'),(8,8,1,'24.21','26.49','credit',NULL,'2312','','Sunday','2013-02-10 22:47:59','2013-02-10 22:47:59'),(9,9,1,'24.21','26.49','credit',NULL,'2312','','Sunday','2013-02-10 22:49:34','2013-02-10 22:49:34'),(10,10,1,'24.21','26.49','credit',NULL,'2312','','Sunday','2013-02-10 22:50:01','2013-02-10 22:50:01'),(11,11,1,'10.49','11.48','cash',NULL,'','','Sunday','2013-02-10 22:50:28','2013-02-10 22:50:28'),(12,12,1,'10.49','11.48','cash',NULL,'','','Sunday','2013-02-10 22:57:22','2013-02-10 22:57:22'),(13,13,1,'15.48','16.94','cash',NULL,'','','Sunday','2013-02-10 22:57:29','2013-02-10 22:57:29'),(14,14,1,'15.48','16.94','cash',NULL,'','','Sunday','2013-02-10 23:03:00','2013-02-10 23:03:00'),(15,15,1,'53.19','58.23','credit',NULL,'2321','','Sunday','2013-02-10 23:03:14','2013-02-10 23:03:14');
/*!40000 ALTER TABLE `invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_items`
--

DROP TABLE IF EXISTS `menu_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_items` (
  `menu_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `tier` int(3) DEFAULT NULL,
  `url` varchar(150) DEFAULT NULL,
  `orders` int(5) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_items`
--

LOCK TABLES `menu_items` WRITE;
/*!40000 ALTER TABLE `menu_items` DISABLE KEYS */;
INSERT INTO `menu_items` VALUES (0,'Dashboard',1,'Main Header',1,'NULL','2013-02-08 17:59:58','2013-02-08 17:59:58'),(0,'View Dashboard',3,'/admins/index',3,'NULL','2013-02-08 17:59:58','2013-02-08 17:59:58'),(0,'Dashboard Template',2,'Sub Header',2,'NULL','2013-02-08 17:59:58','2013-02-08 17:59:58'),(0,'Retract Order',3,'/admins/retract',4,'NULL','2013-02-08 17:59:58','2013-02-08 17:59:58'),(0,'Dashboard',1,'Main Header',1,'NULL','2013-02-08 18:17:29','2013-02-08 18:17:29'),(0,'Retract Order',3,'/admins/retract',4,'NULL','2013-02-08 18:17:29','2013-02-08 18:17:29'),(0,'Dashboard Template',2,'Sub Header',2,'NULL','2013-02-08 18:17:29','2013-02-08 18:17:29'),(0,'View Dashboard',3,'/admins/index',3,'NULL','2013-02-08 18:17:29','2013-02-08 18:17:29'),(1,'Dashboard',1,'Main Header',1,'icon-th','2013-02-08 18:55:54','2013-02-08 18:55:54'),(1,'Dashboard Template',2,'Sub Header',2,'NULL','2013-02-08 18:55:55','2013-02-08 18:55:55'),(1,'Category Template',2,'Sub Header',6,'NULL','2013-02-08 18:55:55','2013-02-08 18:55:55'),(1,'View Dashboard',3,'/admins/index',3,'NULL','2013-02-08 18:55:55','2013-02-08 18:55:55'),(1,'Orders',1,'Main Header',5,'icon-folder-close','2013-02-08 18:55:55','2013-02-08 18:55:55'),(1,'Retract Order',3,'/admins/retract',4,'NULL','2013-02-08 18:55:56','2013-02-08 18:55:56'),(1,'View Categories',3,'/categories/index',7,'NULL','2013-02-08 18:55:56','2013-02-08 18:55:56'),(1,'Add Category',3,'/categories/add',8,'NULL','2013-02-08 18:55:56','2013-02-08 18:55:56'),(1,'Orders Template',2,'Sub Header',9,'NULL','2013-02-08 18:55:57','2013-02-08 18:55:57'),(1,'View Orders',3,'/orders/index',10,'NULL','2013-02-08 18:55:57','2013-02-08 18:55:57'),(1,'Add Order',3,'/orders/add',11,'NULL','2013-02-08 18:55:57','2013-02-08 18:55:57'),(1,'Management',1,'Main Header',12,'icon-user','2013-02-08 18:55:57','2013-02-08 18:55:57'),(1,'Groups Template',2,'Sub Header',13,'NULL','2013-02-08 18:55:58','2013-02-08 18:55:58'),(1,'View Groups',3,'/groups/index',14,'NULL','2013-02-08 18:55:58','2013-02-08 18:55:58'),(1,'Add Groups',3,'/groups/add',15,'NULL','2013-02-08 18:55:58','2013-02-08 18:55:58'),(1,'Users Template',2,'Sub Header',16,'NULL','2013-02-08 18:55:58','2013-02-08 18:55:58'),(1,'View Users',3,'/users/index',17,'NULL','2013-02-08 18:55:59','2013-02-08 18:55:59'),(1,'Add Users',3,'/users/add',18,'NULL','2013-02-08 18:55:59','2013-02-08 18:55:59'),(1,'Setup',1,'Main Header',19,'icon-cog','2013-02-08 18:55:59','2013-02-08 18:55:59'),(1,'Taxes Template',2,'Sub Header',20,'NULL','2013-02-08 18:55:59','2013-02-08 18:55:59'),(1,'View Taxes',3,'/tax_infos/index',21,'NULL','2013-02-08 18:56:00','2013-02-08 18:56:00'),(1,'Add Taxes',3,'/tax_infos/add',22,'NULL','2013-02-08 18:56:00','2013-02-08 18:56:00'),(1,'Printers Template',2,'Sub Header',23,'NULL','2013-02-08 18:56:00','2013-02-08 18:56:00'),(1,'View Printers',3,'/printers/index',24,'NULL','2013-02-08 18:56:00','2013-02-08 18:56:00'),(1,'Add Printer',3,'/printers/add',25,'NULL','2013-02-08 18:56:00','2013-02-08 18:56:00'),(1,'Navigation Template',2,'Sub Header',26,'NULL','2013-02-08 18:56:01','2013-02-08 18:56:01'),(1,'View Navigation Menus',3,'/menus/index',27,'NULL','2013-02-08 18:56:01','2013-02-08 18:56:01'),(1,'Add Navigation Menu',3,'/menus/add',28,'NULL','2013-02-08 18:56:01','2013-02-08 18:56:01'),(1,'Reports',1,'Main Header',29,'icon-file','2013-02-08 18:56:01','2013-02-08 18:56:01'),(1,'Reports Template',2,'Sub Header',30,'NULL','2013-02-08 18:56:01','2013-02-08 18:56:01'),(1,'View Reports',3,'/reports/index',31,'NULL','2013-02-08 18:56:01','2013-02-08 18:56:01'),(2,'Dashboard',1,'Main Header',1,'icon-th','2013-02-08 19:08:31','2013-02-08 19:08:31'),(2,'View Dashboard',3,'/admins/index',3,'NULL','2013-02-08 19:08:31','2013-02-08 19:08:31'),(2,'Category Template',2,'Sub Header',6,'NULL','2013-02-08 19:08:32','2013-02-08 19:08:32'),(2,'Dashboard Template',2,'Sub Header',2,'NULL','2013-02-08 19:08:32','2013-02-08 19:08:32'),(2,'Orders',1,'Main Header',5,'icon-folder-close','2013-02-08 19:08:32','2013-02-08 19:08:32'),(2,'Retract Order',3,'/admins/retract',4,'NULL','2013-02-08 19:08:33','2013-02-08 19:08:33'),(2,'View Categories',3,'/categories/index',7,'NULL','2013-02-08 19:08:33','2013-02-08 19:08:33'),(2,'Add Category',3,'/categories/add',8,'NULL','2013-02-08 19:08:34','2013-02-08 19:08:34'),(2,'Orders Template',2,'Sub Header',9,'NULL','2013-02-08 19:08:34','2013-02-08 19:08:34'),(2,'View Orders',3,'/orders/index',10,'NULL','2013-02-08 19:08:34','2013-02-08 19:08:34'),(2,'Add Order',3,'/orders/add',11,'NULL','2013-02-08 19:08:34','2013-02-08 19:08:34'),(2,'Management',1,'Main Header',12,'icon-user','2013-02-08 19:08:35','2013-02-08 19:08:35'),(2,'Users Template',2,'Sub Header',13,'NULL','2013-02-08 19:08:35','2013-02-08 19:08:35'),(2,'View Users',3,'/users/index',14,'NULL','2013-02-08 19:08:35','2013-02-08 19:08:35'),(2,'Add User',3,'/users/add',15,'NULL','2013-02-08 19:08:35','2013-02-08 19:08:35'),(2,'Setup',1,'Main Header',16,'icon-cog','2013-02-08 19:08:36','2013-02-08 19:08:36'),(2,'Taxes Template',2,'Sub Header',17,'NULL','2013-02-08 19:08:36','2013-02-08 19:08:36'),(2,'View Taxes',3,'/tax_infos/index',18,'NULL','2013-02-08 19:08:36','2013-02-08 19:08:36'),(2,'Add Taxes',3,'/tax_infos/add',19,'NULL','2013-02-08 19:08:36','2013-02-08 19:08:36'),(2,'Printers Template',2,'Sub Header',20,'NULL','2013-02-08 19:08:37','2013-02-08 19:08:37'),(2,'View Printers',3,'/printers/index',21,'NULL','2013-02-08 19:08:37','2013-02-08 19:08:37'),(2,'Add Printers',3,'/printers/add',22,'NULL','2013-02-08 19:08:37','2013-02-08 19:08:37'),(2,'Reports',1,'Main Header',23,'icon-file','2013-02-08 19:08:37','2013-02-08 19:08:37'),(2,'Reports Template',2,'Sub Header',24,'NULL','2013-02-08 19:08:37','2013-02-08 19:08:37'),(2,'View Reports',3,'/reports/index',25,'NULL','2013-02-08 19:08:37','2013-02-08 19:08:37'),(3,'Dashboard',1,'Main Header',1,'icon-th','2013-02-08 19:15:04','2013-02-08 19:15:04'),(3,'View Dashboard',3,'/admins/index',3,'NULL','2013-02-08 19:15:04','2013-02-08 19:15:04'),(3,'Retract Order',3,'/admins/retract',4,'NULL','2013-02-08 19:15:04','2013-02-08 19:15:04'),(3,'Orders',1,'Main Header',5,'icon-folder-close','2013-02-08 19:15:04','2013-02-08 19:15:04'),(3,'Dashboard Template',2,'Sub Header',2,'NULL','2013-02-08 19:15:05','2013-02-08 19:15:05'),(3,'Category Template',2,'Sub Header',6,'NULL','2013-02-08 19:15:05','2013-02-08 19:15:05'),(3,'View Categories',3,'/categories/index',7,'NULL','2013-02-08 19:15:05','2013-02-08 19:15:05'),(3,'Orders Template',2,'Sub Header',8,'NULL','2013-02-08 19:15:05','2013-02-08 19:15:05'),(3,'View Orders',3,'/orders/index',9,'NULL','2013-02-08 19:15:06','2013-02-08 19:15:06'),(3,'Management',1,'Main Header',10,'icon-user','2013-02-08 19:15:06','2013-02-08 19:15:06'),(3,'Users Template',2,'Sub Header',11,'NULL','2013-02-08 19:15:06','2013-02-08 19:15:06'),(3,'View Users',3,'/users/index',12,'NULL','2013-02-08 19:15:06','2013-02-08 19:15:06'),(3,'Add User',3,'/users/add',13,'NULL','2013-02-08 19:15:07','2013-02-08 19:15:07'),(3,'Setup',1,'Main Header',14,'icon-cog','2013-02-08 19:15:07','2013-02-08 19:15:07'),(3,'Taxes Template',2,'Sub Header',15,'NULL','2013-02-08 19:15:07','2013-02-08 19:15:07'),(3,'View Taxes',3,'/tax_infos/view',16,'NULL','2013-02-08 19:15:08','2013-02-08 19:15:08'),(3,'Add Tax',3,'/tax_infos/add',17,'NULL','2013-02-08 19:15:08','2013-02-08 19:15:08'),(3,'Printer Template',2,'Sub Header',18,'NULL','2013-02-08 19:15:08','2013-02-08 19:15:08'),(3,'View Printer',3,'/printers/index',19,'NULL','2013-02-08 19:15:08','2013-02-08 19:15:08'),(3,'Add Printer',3,'/printers/add',20,'NULL','2013-02-08 19:15:08','2013-02-08 19:15:08'),(3,'Reports',1,'Main Header',21,'icon-file','2013-02-08 19:15:09','2013-02-08 19:15:09'),(3,'Reports Template',2,'Sub Header',22,'NULL','2013-02-08 19:15:09','2013-02-08 19:15:09'),(3,'View Reports',3,'/reports/index',23,'NULL','2013-02-08 19:15:09','2013-02-08 19:15:09'),(4,'Dashboard',1,'Main Header',1,'icon-th','2013-02-08 19:16:32','2013-02-08 19:16:32'),(4,'Retract Order',3,'/admins/retract',4,'NULL','2013-02-08 19:16:32','2013-02-08 19:16:32'),(4,'View Dashboard',3,'/admins/index',3,'NULL','2013-02-08 19:16:32','2013-02-08 19:16:32'),(4,'Dashboard Template',2,'Sub Header',2,'NULL','2013-02-08 19:16:32','2013-02-08 19:16:32');
/*!40000 ALTER TABLE `menu_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `edit_menu` text,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'Super Administrator','\n			\n			\n			\n			\n			\n\n				<li label=\"Dashboard\" icon=\"icon-th\" url=\"Main Header\"><div class=\"btn btn-large btn-block btn\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"icon-th\" chosen=\"icon-th\"></i> Dashboard - Main Header</span></span><button id=\"removeMenuRow\" name=\"Dashboard\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div><ol tier=\"2\"><li class=\"\" style=\"\" label=\"Dashboard Template\" icon=\"\" url=\"Sub Header\"><div class=\"btn btn-large btn-block btn-warning\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Dashboard Template - Sub Header</span></span><button id=\"removeMenuRow\" name=\"Dashboard Template\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div><ol tier=\"3\"><li class=\"\" style=\"\" label=\"View Dashboard\" icon=\"\" url=\"/admins/index\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> View Dashboard - /admins/index</span></span><button id=\"removeMenuRow\" name=\"View Dashboard\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li><li class=\"\" style=\"\" label=\"Retract Order\" icon=\"\" url=\"/admins/retract\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Retract Order - /admins/retract</span></span><button id=\"removeMenuRow\" name=\"Retract Order\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li></ol></li></ol></li><li label=\"Orders\" icon=\"icon-folder-close\" url=\"Main Header\"><div class=\"btn btn-large btn-block btn\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"icon-folder-close\" chosen=\"icon-folder-close\"></i> Orders - Main Header</span></span><button id=\"removeMenuRow\" name=\"Orders\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div><ol tier=\"2\"><li class=\"\" style=\"\" label=\"Category Template\" icon=\"\" url=\"Sub Header\"><div class=\"btn btn-large btn-block btn-warning\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Category Template - Sub Header</span></span><button id=\"removeMenuRow\" name=\"Category Template\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div><ol tier=\"3\"><li class=\"\" style=\"\" label=\"View Categories\" icon=\"\" url=\"/categories/index\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> View Categories - /categories/index</span></span><button id=\"removeMenuRow\" name=\"View Categories\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li><li class=\"\" style=\"\" label=\"Add Category\" icon=\"\" url=\"/categories/add\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Add Category - /categories/add</span></span><button id=\"removeMenuRow\" name=\"Add Category\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li></ol></li><li class=\"\" style=\"\" label=\"Orders Template\" icon=\"\" url=\"Sub Header\"><div class=\"btn btn-large btn-block btn-warning\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Orders Template - Sub Header</span></span><button id=\"removeMenuRow\" name=\"Orders Template\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div><ol tier=\"3\"><li class=\"\" style=\"\" label=\"View Orders\" icon=\"\" url=\"/orders/index\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> View Orders - /orders/index</span></span><button id=\"removeMenuRow\" name=\"View Orders\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li><li class=\"\" style=\"\" label=\"Add Order\" icon=\"\" url=\"/orders/add\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Add Order - /orders/add</span></span><button id=\"removeMenuRow\" name=\"Add Order\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li></ol></li></ol></li>		<li label=\"Management\" icon=\"icon-user\" url=\"Main Header\"><div class=\"btn btn-large btn-block btn\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"icon-user\" chosen=\"icon-user\"></i> Management - Main Header</span></span><button id=\"removeMenuRow\" name=\"Management\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div><ol tier=\"2\"><li class=\"\" style=\"\" label=\"Groups Template\" icon=\"\" url=\"Sub Header\"><div class=\"btn btn-large btn-block btn-warning\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Groups Template - Sub Header</span></span><button id=\"removeMenuRow\" name=\"Groups Template\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div><ol tier=\"3\"><li class=\"\" style=\"\" label=\"View Groups\" icon=\"\" url=\"/groups/index\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> View Groups - /groups/index</span></span><button id=\"removeMenuRow\" name=\"View Groups\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li><li class=\"\" style=\"\" label=\"Add Groups\" icon=\"\" url=\"/groups/add\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Add Groups - /groups/add</span></span><button id=\"removeMenuRow\" name=\"Add Groups\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li></ol></li><li class=\"\" style=\"\" label=\"Users Template\" icon=\"\" url=\"Sub Header\"><div class=\"btn btn-large btn-block btn-warning\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Users Template - Sub Header</span></span><button id=\"removeMenuRow\" name=\"Users Template\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div><ol tier=\"3\"><li class=\"\" style=\"\" label=\"View Users\" icon=\"\" url=\"/users/index\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> View Users - /users/index</span></span><button id=\"removeMenuRow\" name=\"View Users\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li><li class=\"\" style=\"\" label=\"Add Users\" icon=\"\" url=\"/users/add\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Add Users - /users/add</span></span><button id=\"removeMenuRow\" name=\"Add Users\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li></ol></li></ol></li>		<li label=\"Setup\" icon=\"icon-cog\" url=\"Main Header\"><div class=\"btn btn-large btn-block btn\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"icon-cog\" chosen=\"icon-cog\"></i> Setup - Main Header</span></span><button id=\"removeMenuRow\" name=\"Setup\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div><ol tier=\"2\"><li class=\"\" style=\"\" label=\"Taxes Template\" icon=\"\" url=\"Sub Header\"><div class=\"btn btn-large btn-block btn-warning\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Taxes Template - Sub Header</span></span><button id=\"removeMenuRow\" name=\"Taxes Template\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div><ol tier=\"3\"><li class=\"\" style=\"\" label=\"View Taxes\" icon=\"\" url=\"/tax_infos/index\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> View Taxes - /tax_infos/index</span></span><button id=\"removeMenuRow\" name=\"View Taxes\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li><li class=\"\" style=\"\" label=\"Add Taxes\" icon=\"\" url=\"/tax_infos/add\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Add Taxes - /tax_infos/add</span></span><button id=\"removeMenuRow\" name=\"Add Taxes\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li></ol></li><li class=\"\" style=\"\" label=\"Printers Template\" icon=\"\" url=\"Sub Header\"><div class=\"btn btn-large btn-block btn-warning\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Printers Template - Sub Header</span></span><button id=\"removeMenuRow\" name=\"Printers Template\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div><ol tier=\"3\"><li class=\"\" style=\"\" label=\"View Printers\" icon=\"\" url=\"/printers/index\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> View Printers - /printers/index</span></span><button id=\"removeMenuRow\" name=\"View Printers\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li><li class=\"\" style=\"\" label=\"Add Printer\" icon=\"\" url=\"/printers/add\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Add Printer - /printers/add</span></span><button id=\"removeMenuRow\" name=\"Add Printer\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li></ol></li><li class=\"\" style=\"\" label=\"Navigation Template\" icon=\"\" url=\"Sub Header\"><div class=\"btn btn-large btn-block btn-warning\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Navigation Template - Sub Header</span></span><button id=\"removeMenuRow\" name=\"Navigation Template\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div><ol tier=\"3\"><li class=\"\" style=\"\" label=\"View Navigation Menus\" icon=\"\" url=\"/menus/index\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> View Navigation Menus - /menus/index</span></span><button id=\"removeMenuRow\" name=\"View Navigation Menus\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li><li class=\"\" style=\"\" label=\"Add Navigation Menu\" icon=\"\" url=\"/menus/add\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Add Navigation Menu - /menus/add</span></span><button id=\"removeMenuRow\" name=\"Add Navigation Menu\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li></ol></li></ol></li>		<li class=\"\" style=\"\" label=\"Reports\" icon=\"icon-file\" url=\"Main Header\"><div class=\"btn btn-large btn-block btn\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"icon-file\" chosen=\"icon-file\"></i> Reports - Main Header</span></span><button id=\"removeMenuRow\" name=\"Reports\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div><ol tier=\"2\"><li class=\"\" style=\"\" label=\"Reports Template\" icon=\"\" url=\"Sub Header\"><div class=\"btn btn-large btn-block btn-warning\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Reports Template - Sub Header</span></span><button id=\"removeMenuRow\" name=\"Reports Template\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div><ol tier=\"3\"><li class=\"\" style=\"\" label=\"View Reports\" icon=\"\" url=\"/reports/index\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> View Reports - /reports/index</span></span><button id=\"removeMenuRow\" name=\"View Reports\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li></ol></li></ol></li>		','2013-02-08 18:17:28','2013-02-08 18:55:53'),(2,'Owners','\n			\n			\n			\n\n		<li label=\"Dashboard\" icon=\"icon-th\" url=\"Main Header\"><div class=\"btn btn-large btn-block btn\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"icon-th\" chosen=\"icon-th\"></i> Dashboard - Main Header</span></span><button id=\"removeMenuRow\" name=\"Dashboard\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div><ol tier=\"2\"><li class=\"\" style=\"\" label=\"Dashboard Template\" icon=\"\" url=\"Sub Header\"><div class=\"btn btn-large btn-block btn-warning\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Dashboard Template - Sub Header</span></span><button id=\"removeMenuRow\" name=\"Dashboard Template\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div><ol tier=\"3\"><li class=\"\" style=\"\" label=\"View Dashboard\" icon=\"\" url=\"/admins/index\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> View Dashboard - /admins/index</span></span><button id=\"removeMenuRow\" name=\"View Dashboard\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li><li class=\"\" style=\"\" label=\"Retract Order\" icon=\"\" url=\"/admins/retract\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Retract Order - /admins/retract</span></span><button id=\"removeMenuRow\" name=\"Retract Order\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li></ol></li></ol></li><li label=\"Orders\" icon=\"icon-folder-close\" url=\"Main Header\"><div class=\"btn btn-large btn-block btn\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"icon-folder-close\" chosen=\"icon-folder-close\"></i> Orders - Main Header</span></span><button id=\"removeMenuRow\" name=\"Orders\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div><ol tier=\"2\"><li class=\"\" style=\"\" label=\"Category Template\" icon=\"\" url=\"Sub Header\"><div class=\"btn btn-large btn-block btn-warning\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Category Template - Sub Header</span></span><button id=\"removeMenuRow\" name=\"Category Template\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div><ol tier=\"3\"><li class=\"\" style=\"\" label=\"View Categories\" icon=\"\" url=\"/categories/index\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> View Categories - /categories/index</span></span><button id=\"removeMenuRow\" name=\"View Categories\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li><li class=\"\" style=\"\" label=\"Add Category\" icon=\"\" url=\"/categories/add\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Add Category - /categories/add</span></span><button id=\"removeMenuRow\" name=\"Add Category\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li></ol></li><li class=\"\" style=\"\" label=\"Orders Template\" icon=\"\" url=\"Sub Header\"><div class=\"btn btn-large btn-block btn-warning\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Orders Template - Sub Header</span></span><button id=\"removeMenuRow\" name=\"Orders Template\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div><ol tier=\"3\"><li class=\"\" style=\"\" label=\"View Orders\" icon=\"\" url=\"/orders/index\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> View Orders - /orders/index</span></span><button id=\"removeMenuRow\" name=\"View Orders\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li><li class=\"\" style=\"\" label=\"Add Order\" icon=\"\" url=\"/orders/add\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Add Order - /orders/add</span></span><button id=\"removeMenuRow\" name=\"Add Order\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li></ol></li></ol></li>		<li label=\"Management\" icon=\"icon-user\" url=\"Main Header\"><div class=\"btn btn-large btn-block btn\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"icon-user\" chosen=\"icon-user\"></i> Management - Main Header</span></span><button id=\"removeMenuRow\" name=\"Management\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div><ol tier=\"2\"><li class=\"\" style=\"\" label=\"Users Template\" icon=\"\" url=\"Sub Header\"><div class=\"btn btn-large btn-block btn-warning\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Users Template - Sub Header</span></span><button id=\"removeMenuRow\" name=\"Users Template\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div><ol tier=\"3\"><li class=\"\" style=\"\" label=\"View Users\" icon=\"\" url=\"/users/index\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> View Users - /users/index</span></span><button id=\"removeMenuRow\" name=\"View Users\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li><li class=\"\" style=\"\" label=\"Add User\" icon=\"\" url=\"/users/add\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Add User - /users/add</span></span><button id=\"removeMenuRow\" name=\"Add User\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li></ol></li></ol></li>		<li label=\"Setup\" icon=\"icon-cog\" url=\"Main Header\"><div class=\"btn btn-large btn-block btn\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"icon-cog\" chosen=\"icon-cog\"></i> Setup - Main Header</span></span><button id=\"removeMenuRow\" name=\"Setup\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div><ol tier=\"2\"><li class=\"\" style=\"\" label=\"Taxes Template\" icon=\"\" url=\"Sub Header\"><div class=\"btn btn-large btn-block btn-warning\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Taxes Template - Sub Header</span></span><button id=\"removeMenuRow\" name=\"Taxes Template\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div><ol tier=\"3\"><li class=\"\" style=\"\" label=\"View Taxes\" icon=\"\" url=\"/tax_infos/index\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> View Taxes - /tax_infos/index</span></span><button id=\"removeMenuRow\" name=\"View Taxes\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li><li class=\"\" style=\"\" label=\"Add Taxes\" icon=\"\" url=\"/tax_infos/add\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Add Taxes - /tax_infos/add</span></span><button id=\"removeMenuRow\" name=\"Add Taxes\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li></ol></li><li class=\"\" style=\"\" label=\"Printers Template\" icon=\"\" url=\"Sub Header\"><div class=\"btn btn-large btn-block btn-warning\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Printers Template - Sub Header</span></span><button id=\"removeMenuRow\" name=\"Printers Template\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div><ol tier=\"3\"><li class=\"\" style=\"\" label=\"View Printers\" icon=\"\" url=\"/printers/index\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> View Printers - /printers/index</span></span><button id=\"removeMenuRow\" name=\"View Printers\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li><li class=\"\" style=\"\" label=\"Add Printers\" icon=\"\" url=\"/printers/add\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Add Printers - /printers/add</span></span><button id=\"removeMenuRow\" name=\"Add Printers\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li></ol></li></ol></li>		<li label=\"Reports\" icon=\"icon-file\" url=\"Main Header\"><div class=\"btn btn-large btn-block btn\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"icon-file\" chosen=\"icon-file\"></i> Reports - Main Header</span></span><button id=\"removeMenuRow\" name=\"Reports\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div><ol tier=\"2\"><li class=\"\" style=\"\" label=\"Reports Template\" icon=\"\" url=\"Sub Header\"><div class=\"btn btn-large btn-block btn-warning\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Reports Template - Sub Header</span></span><button id=\"removeMenuRow\" name=\"Reports Template\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div><ol tier=\"3\"><li class=\"\" style=\"\" label=\"View Reports\" icon=\"\" url=\"/reports/index\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> View Reports - /reports/index</span></span><button id=\"removeMenuRow\" name=\"View Reports\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li></ol></li></ol></li>','2013-02-08 19:01:19','2013-02-08 19:08:30'),(3,'Managers','\n\n		<li label=\"Dashboard\" icon=\"icon-th\" url=\"Main Header\"><div class=\"btn btn-large btn-block btn\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"icon-th\" chosen=\"icon-th\"></i> Dashboard - Main Header</span></span><button id=\"removeMenuRow\" name=\"Dashboard\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div><ol tier=\"2\"><li class=\"\" style=\"\" label=\"Dashboard Template\" icon=\"\" url=\"Sub Header\"><div class=\"btn btn-large btn-block btn-warning\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Dashboard Template - Sub Header</span></span><button id=\"removeMenuRow\" name=\"Dashboard Template\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div><ol tier=\"3\"><li class=\"\" style=\"\" label=\"View Dashboard\" icon=\"\" url=\"/admins/index\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> View Dashboard - /admins/index</span></span><button id=\"removeMenuRow\" name=\"View Dashboard\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li><li class=\"\" style=\"\" label=\"Retract Order\" icon=\"\" url=\"/admins/retract\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Retract Order - /admins/retract</span></span><button id=\"removeMenuRow\" name=\"Retract Order\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li></ol></li></ol></li><li label=\"Orders\" icon=\"icon-folder-close\" url=\"Main Header\"><div class=\"btn btn-large btn-block btn\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"icon-folder-close\" chosen=\"icon-folder-close\"></i> Orders - Main Header</span></span><button id=\"removeMenuRow\" name=\"Orders\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div><ol tier=\"2\"><li class=\"\" style=\"\" label=\"Category Template\" icon=\"\" url=\"Sub Header\"><div class=\"btn btn-large btn-block btn-warning\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Category Template - Sub Header</span></span><button id=\"removeMenuRow\" name=\"Category Template\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div><ol tier=\"3\"><li class=\"\" style=\"\" label=\"View Categories\" icon=\"\" url=\"/categories/index\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> View Categories - /categories/index</span></span><button id=\"removeMenuRow\" name=\"View Categories\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li></ol></li><li class=\"\" style=\"\" label=\"Orders Template\" icon=\"\" url=\"Sub Header\"><div class=\"btn btn-large btn-block btn-warning\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Orders Template - Sub Header</span></span><button id=\"removeMenuRow\" name=\"Orders Template\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div><ol tier=\"3\"><li class=\"\" style=\"\" label=\"View Orders\" icon=\"\" url=\"/orders/index\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> View Orders - /orders/index</span></span><button id=\"removeMenuRow\" name=\"View Orders\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li></ol></li></ol></li><li label=\"Management\" icon=\"icon-user\" url=\"Main Header\"><div class=\"btn btn-large btn-block btn\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"icon-user\" chosen=\"icon-user\"></i> Management - Main Header</span></span><button id=\"removeMenuRow\" name=\"Management\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div><ol tier=\"2\"><li class=\"\" style=\"\" label=\"Users Template\" icon=\"\" url=\"Sub Header\"><div class=\"btn btn-large btn-block btn-warning\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Users Template - Sub Header</span></span><button id=\"removeMenuRow\" name=\"Users Template\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div><ol tier=\"3\"><li class=\"\" style=\"\" label=\"View Users\" icon=\"\" url=\"/users/index\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> View Users - /users/index</span></span><button id=\"removeMenuRow\" name=\"View Users\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li><li class=\"\" style=\"\" label=\"Add User\" icon=\"\" url=\"/users/add\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Add User - /users/add</span></span><button id=\"removeMenuRow\" name=\"Add User\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li></ol></li></ol></li><li label=\"Setup\" icon=\"icon-cog\" url=\"Main Header\"><div class=\"btn btn-large btn-block btn\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"icon-cog\" chosen=\"icon-cog\"></i> Setup - Main Header</span></span><button id=\"removeMenuRow\" name=\"Setup\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div><ol tier=\"2\"><li class=\"\" style=\"\" label=\"Taxes Template\" icon=\"\" url=\"Sub Header\"><div class=\"btn btn-large btn-block btn-warning\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Taxes Template - Sub Header</span></span><button id=\"removeMenuRow\" name=\"Taxes Template\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div><ol tier=\"3\"><li class=\"\" style=\"\" label=\"View Taxes\" icon=\"\" url=\"/tax_infos/view\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> View Taxes - /tax_infos/view</span></span><button id=\"removeMenuRow\" name=\"View Taxes\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li><li class=\"\" style=\"\" label=\"Add Tax\" icon=\"\" url=\"/tax_infos/add\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Add Tax - /tax_infos/add</span></span><button id=\"removeMenuRow\" name=\"Add Tax\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li></ol></li><li class=\"\" style=\"\" label=\"Printer Template\" icon=\"\" url=\"Sub Header\"><div class=\"btn btn-large btn-block btn-warning\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Printer Template - Sub Header</span></span><button id=\"removeMenuRow\" name=\"Printer Template\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div><ol tier=\"3\"><li class=\"\" style=\"\" label=\"View Printer\" icon=\"\" url=\"/printers/index\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> View Printer - /printers/index</span></span><button id=\"removeMenuRow\" name=\"View Printer\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li><li class=\"\" style=\"\" label=\"Add Printer\" icon=\"\" url=\"/printers/add\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Add Printer - /printers/add</span></span><button id=\"removeMenuRow\" name=\"Add Printer\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li></ol></li></ol></li><li label=\"Reports\" icon=\"icon-file\" url=\"Main Header\"><div class=\"btn btn-large btn-block btn\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"icon-file\" chosen=\"icon-file\"></i> Reports - Main Header</span></span><button id=\"removeMenuRow\" name=\"Reports\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div><ol tier=\"2\"><li class=\"\" style=\"\" label=\"Reports Template\" icon=\"\" url=\"Sub Header\"><div class=\"btn btn-large btn-block btn-warning\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Reports Template - Sub Header</span></span><button id=\"removeMenuRow\" name=\"Reports Template\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div><ol tier=\"3\"><li class=\"\" style=\"\" label=\"View Reports\" icon=\"\" url=\"/reports/index\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> View Reports - /reports/index</span></span><button id=\"removeMenuRow\" name=\"View Reports\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li></ol></li></ol></li>','2013-02-08 19:15:01','2013-02-08 19:15:01'),(4,'Employees','\n\n		<li label=\"Dashboard\" icon=\"icon-th\" url=\"Main Header\"><div class=\"btn btn-large btn-block btn\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"icon-th\" chosen=\"icon-th\"></i> Dashboard - Main Header</span></span><button id=\"removeMenuRow\" name=\"Dashboard\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div><ol tier=\"2\"><li class=\"\" style=\"\" label=\"Dashboard Template\" icon=\"\" url=\"Sub Header\"><div class=\"btn btn-large btn-block btn-warning\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Dashboard Template - Sub Header</span></span><button id=\"removeMenuRow\" name=\"Dashboard Template\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div><ol tier=\"3\"><li class=\"\" style=\"\" label=\"View Dashboard\" icon=\"\" url=\"/admins/index\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> View Dashboard - /admins/index</span></span><button id=\"removeMenuRow\" name=\"View Dashboard\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li><li class=\"\" style=\"\" label=\"Retract Order\" icon=\"\" url=\"/admins/retract\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Retract Order - /admins/retract</span></span><button id=\"removeMenuRow\" name=\"Retract Order\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li></ol></li></ol></li>','2013-02-08 19:16:31','2013-02-08 19:16:31');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `order_list` int(5) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `description` text,
  `price` decimal(11,2) NOT NULL DEFAULT '0.00',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,1,NULL,1,'Chicken Combo','','4.99','2013-02-09 15:32:04','2013-02-09 15:32:04'),(2,1,NULL,1,'Beef Combo','','4.99','2013-02-09 15:32:20','2013-02-09 15:32:20'),(3,1,NULL,1,'Pork Combo','','5.50','2013-02-09 15:33:04','2013-02-09 15:33:04'),(4,1,NULL,2,'Chicken Humbao','','0.99','2013-02-09 15:33:23','2013-02-09 15:33:23'),(5,1,NULL,2,'Kimchee Humbao','','0.99','2013-02-09 15:33:44','2013-02-09 15:33:44'),(6,1,NULL,3,'Chicken Dinner','','6.75','2013-02-09 15:34:09','2013-02-09 15:34:09');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page_contents`
--

DROP TABLE IF EXISTS `page_contents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `page_contents` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `class_name` varchar(100) NOT NULL,
  `html` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page_contents`
--

LOCK TABLES `page_contents` WRITE;
/*!40000 ALTER TABLE `page_contents` DISABLE KEYS */;
/*!40000 ALTER TABLE `page_contents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(100) DEFAULT NULL,
  `relationship` int(1) DEFAULT NULL,
  `page_name` varchar(100) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `title` varchar(150) DEFAULT NULL,
  `keywords` text,
  `description` text,
  `layout` varchar(50) DEFAULT NULL,
  `menu_id` int(3) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `printers`
--

DROP TABLE IF EXISTS `printers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `printers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `printers`
--

LOCK TABLES `printers` WRITE;
/*!40000 ALTER TABLE `printers` DISABLE KEYS */;
/*!40000 ALTER TABLE `printers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tax_infos`
--

DROP TABLE IF EXISTS `tax_infos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tax_infos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `state` varchar(2) NOT NULL,
  `rate` decimal(6,4) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tax_infos`
--

LOCK TABLES `tax_infos` WRITE;
/*!40000 ALTER TABLE `tax_infos` DISABLE KEYS */;
INSERT INTO `tax_infos` VALUES (2,1,'WA','9.5000','2013-02-08 18:12:47','2013-02-08 18:12:47');
/*!40000 ALTER TABLE `tax_infos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` char(40) NOT NULL,
  `group_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'ydc2415','d32479828fb8f48ad50efd45c141014b56e74fb5',1,'2013-02-08 18:02:29','2013-02-08 18:02:29'),(2,1,'wondollaballa','c6563ff6967cae1eba5be343fa46c77f4b8a0876',4,'2013-02-08 19:21:19','2013-02-08 19:21:19');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-02-11  8:03:14
