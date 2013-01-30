-- MySQL dump 10.13  Distrib 5.1.67, for debian-linux-gnu (i486)
--
-- Host: localhost    Database: restaurantaide
-- ------------------------------------------------------
-- Server version	5.1.67-0ubuntu0.10.04.1

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acl_permissions`
--

LOCK TABLES `acl_permissions` WRITE;
/*!40000 ALTER TABLE `acl_permissions` DISABLE KEYS */;
INSERT INTO `acl_permissions` VALUES (1,'controllers/Admins',2,'2013-01-28 21:01:55','2013-01-28 21:01:55'),(2,'controllers/Categories',2,'2013-01-28 21:01:55','2013-01-28 21:01:55'),(3,'controllers/Companies',2,'2013-01-28 21:01:55','2013-01-28 21:01:55'),(4,'controllers/Groups',2,'2013-01-28 21:01:55','2013-01-28 21:01:55'),(5,'controllers/Orders',2,'2013-01-28 21:01:55','2013-01-28 21:01:55'),(6,'controllers/Pages',2,'2013-01-28 21:01:55','2013-01-28 21:01:55'),(7,'controllers/Printers',2,'2013-01-28 21:01:55','2013-01-28 21:01:55'),(8,'controllers/TaxInfos',2,'2013-01-28 21:01:55','2013-01-28 21:01:55'),(9,'controllers/Users',2,'2013-01-28 21:01:55','2013-01-28 21:01:55');
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
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acos`
--

LOCK TABLES `acos` WRITE;
/*!40000 ALTER TABLE `acos` DISABLE KEYS */;
INSERT INTO `acos` VALUES (1,NULL,NULL,NULL,'controllers',1,134),(2,1,NULL,NULL,'Admins',2,19),(3,2,NULL,NULL,'login',3,4),(4,2,NULL,NULL,'logout',5,6),(5,2,NULL,NULL,'index',7,8),(6,2,NULL,NULL,'retract',9,10),(7,2,NULL,NULL,'add',11,12),(8,2,NULL,NULL,'edit',13,14),(9,2,NULL,NULL,'view',15,16),(10,2,NULL,NULL,'delete',17,18),(11,1,NULL,NULL,'Categories',20,31),(12,11,NULL,NULL,'index',21,22),(13,11,NULL,NULL,'view',23,24),(14,11,NULL,NULL,'add',25,26),(15,11,NULL,NULL,'edit',27,28),(16,11,NULL,NULL,'delete',29,30),(17,1,NULL,NULL,'Companies',32,43),(18,17,NULL,NULL,'index',33,34),(19,17,NULL,NULL,'view',35,36),(20,17,NULL,NULL,'add',37,38),(21,17,NULL,NULL,'edit',39,40),(22,17,NULL,NULL,'delete',41,42),(23,1,NULL,NULL,'Groups',44,57),(24,23,NULL,NULL,'index',45,46),(25,23,NULL,NULL,'view',47,48),(26,23,NULL,NULL,'add',49,50),(27,23,NULL,NULL,'initializeAcl',51,52),(28,23,NULL,NULL,'edit',53,54),(29,23,NULL,NULL,'delete',55,56),(30,1,NULL,NULL,'Menus',58,71),(31,30,NULL,NULL,'index',59,60),(32,30,NULL,NULL,'view',61,62),(33,30,NULL,NULL,'add',63,64),(34,30,NULL,NULL,'edit',65,66),(35,30,NULL,NULL,'delete',67,68),(36,30,NULL,NULL,'request',69,70),(37,1,NULL,NULL,'Orders',72,83),(38,37,NULL,NULL,'index',73,74),(39,37,NULL,NULL,'view',75,76),(40,37,NULL,NULL,'add',77,78),(41,37,NULL,NULL,'edit',79,80),(42,37,NULL,NULL,'delete',81,82),(43,1,NULL,NULL,'Pages',84,97),(44,43,NULL,NULL,'display',85,86),(45,43,NULL,NULL,'add',87,88),(46,43,NULL,NULL,'edit',89,90),(47,43,NULL,NULL,'index',91,92),(48,43,NULL,NULL,'view',93,94),(49,43,NULL,NULL,'delete',95,96),(50,1,NULL,NULL,'Printers',98,109),(51,50,NULL,NULL,'index',99,100),(52,50,NULL,NULL,'view',101,102),(53,50,NULL,NULL,'add',103,104),(54,50,NULL,NULL,'edit',105,106),(55,50,NULL,NULL,'delete',107,108),(56,1,NULL,NULL,'TaxInfos',110,121),(57,56,NULL,NULL,'index',111,112),(58,56,NULL,NULL,'view',113,114),(59,56,NULL,NULL,'add',115,116),(60,56,NULL,NULL,'edit',117,118),(61,56,NULL,NULL,'delete',119,120),(62,1,NULL,NULL,'Users',122,133),(63,62,NULL,NULL,'index',123,124),(64,62,NULL,NULL,'view',125,126),(65,62,NULL,NULL,'add',127,128),(66,62,NULL,NULL,'edit',129,130),(67,62,NULL,NULL,'delete',131,132);
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aros`
--

LOCK TABLES `aros` WRITE;
/*!40000 ALTER TABLE `aros` DISABLE KEYS */;
INSERT INTO `aros` VALUES (1,NULL,'Group',1,NULL,1,4),(2,NULL,'Group',2,NULL,5,6),(3,1,'User',1,NULL,2,3);
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aros_acos`
--

LOCK TABLES `aros_acos` WRITE;
/*!40000 ALTER TABLE `aros_acos` DISABLE KEYS */;
INSERT INTO `aros_acos` VALUES (1,1,1,'1','1','1','1'),(2,2,1,'-1','-1','-1','-1'),(3,2,2,'1','1','1','1'),(4,2,10,'1','1','1','1'),(5,2,16,'1','1','1','1'),(6,2,22,'1','1','1','1'),(7,2,29,'1','1','1','1'),(8,2,35,'1','1','1','1'),(9,2,42,'1','1','1','1'),(10,2,48,'1','1','1','1'),(11,2,54,'1','1','1','1');
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
INSERT INTO `categories` VALUES (1,1,1,'Combo',1,'2012-09-05 00:38:46','2012-09-24 01:02:43'),(2,1,2,'Sides',1,'2012-09-05 00:38:58','2012-09-24 01:02:43'),(3,1,3,'Additional',1,'2012-09-05 00:39:53','2012-09-24 01:02:43');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies`
--

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
INSERT INTO `companies` VALUES (1,1,0,'Poja','Roosevelt',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'51f8fcbe108e6be2f9511b3c21323bb50298e5e8','1 day','2012-08-31 19:31:50','2012-08-31 19:31:50');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'Super Administrator','2013-01-28 21:01:22','2013-01-28 21:01:22'),(2,'Super Administrator','2013-01-28 21:01:55','2013-01-28 21:01:55');
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
  `after_tax` float(11,4) DEFAULT NULL,
  `day_paid` varchar(10) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice_lineitems`
--

LOCK TABLES `invoice_lineitems` WRITE;
/*!40000 ALTER TABLE `invoice_lineitems` DISABLE KEYS */;
INSERT INTO `invoice_lineitems` VALUES (1,1,'1',NULL,3,1,NULL,6.0200,NULL,'2013-01-30 00:58:54','2013-01-30 00:58:54'),(2,1,'1',NULL,2,1,NULL,5.4600,NULL,'2013-01-30 00:58:54','2013-01-30 00:58:54'),(3,2,'1',NULL,1,1,NULL,5.4600,NULL,'2013-01-30 00:59:04','2013-01-30 00:59:04'),(4,2,'1',NULL,2,1,NULL,5.4600,NULL,'2013-01-30 00:59:04','2013-01-30 00:59:04'),(5,2,'1',NULL,3,1,NULL,6.0200,NULL,'2013-01-30 00:59:04','2013-01-30 00:59:04'),(6,3,'1',NULL,1,1,NULL,5.4600,NULL,'2013-01-30 00:59:17','2013-01-30 00:59:17'),(7,3,'1',NULL,2,1,NULL,5.4600,NULL,'2013-01-30 00:59:17','2013-01-30 00:59:17'),(8,3,'1',NULL,3,1,NULL,6.0200,NULL,'2013-01-30 00:59:17','2013-01-30 00:59:17'),(9,3,'1',NULL,4,1,NULL,5.7500,NULL,'2013-01-30 00:59:17','2013-01-30 00:59:17'),(10,4,'1',NULL,9,1,NULL,6.5600,NULL,'2013-01-30 00:59:26','2013-01-30 00:59:26'),(11,4,'1',NULL,1,1,NULL,5.4600,NULL,'2013-01-30 00:59:26','2013-01-30 00:59:26'),(12,4,'1',NULL,2,1,NULL,5.4600,NULL,'2013-01-30 00:59:26','2013-01-30 00:59:26'),(13,4,'1',NULL,3,1,NULL,6.0200,NULL,'2013-01-30 00:59:26','2013-01-30 00:59:26'),(14,4,'1',NULL,4,1,NULL,5.7500,NULL,'2013-01-30 00:59:26','2013-01-30 00:59:26'),(15,5,'1',NULL,9,1,NULL,6.5600,NULL,'2013-01-30 01:01:59','2013-01-30 01:01:59'),(16,5,'1',NULL,1,1,NULL,5.4600,NULL,'2013-01-30 01:01:59','2013-01-30 01:01:59'),(17,5,'1',NULL,2,1,NULL,5.4600,NULL,'2013-01-30 01:01:59','2013-01-30 01:01:59'),(18,5,'1',NULL,3,1,NULL,6.0200,NULL,'2013-01-30 01:01:59','2013-01-30 01:01:59'),(19,5,'1',NULL,4,1,NULL,5.7500,NULL,'2013-01-30 01:01:59','2013-01-30 01:01:59');
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoices`
--

LOCK TABLES `invoices` WRITE;
/*!40000 ALTER TABLE `invoices` DISABLE KEYS */;
INSERT INTO `invoices` VALUES (1,1,1,'10.49','11.48','cash',NULL,'','',NULL,'2013-01-30 00:58:54','2013-01-30 00:58:54'),(2,2,1,'15.48','16.94','credit',NULL,'','',NULL,'2013-01-30 00:59:04','2013-01-30 00:59:04'),(3,3,1,'20.73','22.69','cash',NULL,'','',NULL,'2013-01-30 00:59:17','2013-01-30 00:59:17'),(4,4,1,'26.72','29.25','cash',NULL,'','',NULL,'2013-01-30 00:59:26','2013-01-30 00:59:26'),(5,5,1,'26.72','29.25','cash',NULL,'','',NULL,'2013-01-30 01:01:59','2013-01-30 01:01:59');
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
INSERT INTO `menu_items` VALUES (2,'Category Template',2,'Sub Header',6,'NULL','2013-01-30 01:25:39','2013-01-30 01:25:39'),(2,'Setup',1,'Main Header',5,'icon-cog','2013-01-30 01:25:39','2013-01-30 01:25:39'),(2,'Dashboard',1,'Main Header',1,'icon-home','2013-01-30 01:25:39','2013-01-30 01:25:39'),(2,'Navigation',2,'Sub Header',2,'NULL','2013-01-30 01:25:39','2013-01-30 01:25:39'),(2,'Dashboard',3,'/admins/index',3,'NULL','2013-01-30 01:25:40','2013-01-30 01:25:40'),(2,'Retract Order',3,'/admins/retract',4,'NULL','2013-01-30 01:25:40','2013-01-30 01:25:40'),(2,'View Categories',3,'/categories/index',7,'NULL','2013-01-30 01:25:40','2013-01-30 01:25:40'),(2,'Add Category',3,'/categories/add',8,'NULL','2013-01-30 01:25:41','2013-01-30 01:25:41'),(2,'Orders Template',2,'Sub Header',9,'NULL','2013-01-30 01:25:41','2013-01-30 01:25:41'),(2,'View Orders',3,'/orders/index',10,'NULL','2013-01-30 01:25:41','2013-01-30 01:25:41'),(2,'Add Orders',3,'/orders/add',11,'NULL','2013-01-30 01:25:41','2013-01-30 01:25:41'),(2,'Management',1,'Main Header',12,'icon-user','2013-01-30 01:25:42','2013-01-30 01:25:42'),(2,'User Template',2,'Sub Header',13,'NULL','2013-01-30 01:25:42','2013-01-30 01:25:42'),(2,'View Users',3,'/users/index',14,'NULL','2013-01-30 01:25:42','2013-01-30 01:25:42'),(2,'Add User',3,'/users/add',15,'NULL','2013-01-30 01:25:42','2013-01-30 01:25:42'),(2,'Reports',1,'Main Header',16,'icon-folder-open','2013-01-30 01:25:42','2013-01-30 01:25:42'),(2,'Reports Template',2,'Sub Header',17,'NULL','2013-01-30 01:25:42','2013-01-30 01:25:42');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (2,'Super Administrator','\n			\n			\n			\n			\n\n		<li label=\"Dashboard\" icon=\"icon-home\" url=\"Main Header\"><div class=\"btn btn-large btn-block btn\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"icon-home\" chosen=\"icon-home\"></i> Dashboard - Main Header</span></span><button id=\"removeMenuRow\" name=\"Dashboard\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div><ol tier=\"2\"><li class=\"\" style=\"\" label=\"Navigation\" icon=\"\" url=\"Sub Header\"><div class=\"btn btn-large btn-block btn-warning\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Navigation - Sub Header</span></span><button id=\"removeMenuRow\" name=\"Navigation\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div><ol tier=\"3\"><li class=\"\" style=\"\" label=\"Dashboard\" icon=\"\" url=\"/admins/index\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Dashboard - /admins/index</span></span><button id=\"removeMenuRow\" name=\"Dashboard\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li><li class=\"\" style=\"\" label=\"Retract Order\" icon=\"\" url=\"/admins/retract\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Retract Order - /admins/retract</span></span><button id=\"removeMenuRow\" name=\"Retract Order\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li></ol></li></ol></li>		<li label=\"Setup\" icon=\"icon-cog\" url=\"Main Header\"><div class=\"btn btn-large btn-block btn\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"icon-cog\" chosen=\"icon-cog\"></i> Setup - Main Header</span></span><button id=\"removeMenuRow\" name=\"Setup\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div><ol tier=\"2\"><li class=\"\" style=\"\" label=\"Category Template\" icon=\"\" url=\"Sub Header\"><div class=\"btn btn-large btn-block btn-warning\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Category Template - Sub Header</span></span><button id=\"removeMenuRow\" name=\"Category Template\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div><ol tier=\"3\"><li class=\"\" style=\"\" label=\"View Categories\" icon=\"\" url=\"/categories/index\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> View Categories - /categories/index</span></span><button id=\"removeMenuRow\" name=\"View Categories\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li><li class=\"\" style=\"\" label=\"Add Category\" icon=\"\" url=\"/categories/add\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Add Category - /categories/add</span></span><button id=\"removeMenuRow\" name=\"Add Category\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li></ol></li><li class=\"\" style=\"\" label=\"Orders Template\" icon=\"\" url=\"Sub Header\"><div class=\"btn btn-large btn-block btn-warning\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Orders Template - Sub Header</span></span><button id=\"removeMenuRow\" name=\"Orders Template\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div><ol tier=\"3\"><li class=\"\" style=\"\" label=\"View Orders\" icon=\"\" url=\"/orders/index\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> View Orders - /orders/index</span></span><button id=\"removeMenuRow\" name=\"View Orders\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li><li class=\"\" style=\"\" label=\"Add Orders\" icon=\"\" url=\"/orders/add\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Add Orders - /orders/add</span></span><button id=\"removeMenuRow\" name=\"Add Orders\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li></ol></li></ol></li>				<li label=\"Management\" icon=\"icon-user\" url=\"Main Header\"><div class=\"btn btn-large btn-block btn\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"icon-user\" chosen=\"icon-user\"></i> Management - Main Header</span></span><button id=\"removeMenuRow\" name=\"Management\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div><ol tier=\"2\"><li class=\"\" style=\"\" label=\"User Template\" icon=\"\" url=\"Sub Header\"><div class=\"btn btn-large btn-block btn-warning\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> User Template - Sub Header</span></span><button id=\"removeMenuRow\" name=\"User Template\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div><ol tier=\"3\"><li class=\"\" style=\"\" label=\"View Users\" icon=\"\" url=\"/users/index\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> View Users - /users/index</span></span><button id=\"removeMenuRow\" name=\"View Users\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li><li class=\"\" style=\"\" label=\"Add User\" icon=\"\" url=\"/users/add\"><div class=\"btn btn-large btn-block btn btn-info\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Add User - /users/add</span></span><button id=\"removeMenuRow\" name=\"Add User\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li></ol></li></ol></li>		<li label=\"Reports\" icon=\"icon-folder-open\" url=\"Main Header\"><div class=\"btn btn-large btn-block btn\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"icon-folder-open\" chosen=\"icon-folder-open\"></i> Reports - Main Header</span></span><button id=\"removeMenuRow\" name=\"Reports\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div><ol tier=\"2\"><li class=\"\" style=\"\" label=\"Reports Template\" icon=\"\" url=\"Sub Header\"><div class=\"btn btn-large btn-block btn-warning\" style=\"text-align:left;\"><span> <i id=\"icon_move_menu\" class=\"icon-move\"></i><span class=\"divisionUp\"><i class=\"\" chosen=\"\"></i> Reports Template - Sub Header</span></span><button id=\"removeMenuRow\" name=\"Reports Template\" style=\"position:absolute;right:75px;\"><i class=\"icon-trash\"></i></button></div></li></ol></li>','2013-01-30 01:16:33','2013-01-30 01:25:37');
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,1,4,1,'Chicken Teriyaki','Chicken over Rice combo','4.99','0000-00-00 00:00:00','2012-09-24 00:56:59'),(2,1,5,1,'Pork Combo','Pork over rice with salad','4.99','0000-00-00 00:00:00','2012-09-24 00:56:59'),(3,1,3,1,'Chicken & Pork Combo','Chicken & Pork Over rice & salad','5.50','0000-00-00 00:00:00','2012-09-24 00:56:59'),(4,1,1,1,'Beef Combo','Beef served over rice with salad','5.25','0000-00-00 00:00:00','2012-09-24 00:56:59'),(5,1,4,2,'Salad','add extra salad to the order','0.99','0000-00-00 00:00:00','2012-09-24 00:57:00'),(6,1,1,3,'Small Drink','Add a drink to the order','0.99','0000-00-00 00:00:00','2012-09-24 00:57:00'),(7,1,2,3,'Medium Drink','Add A medium size drink to the order','1.50','0000-00-00 00:00:00','2012-09-24 00:57:00'),(8,1,1,2,'Humbao (Beef)','Add a Beef humbao to the order.','1.09','0000-00-00 00:00:00','2012-09-24 00:56:59'),(9,1,2,1,'Seafood Combo','Shrimp, fish, scallops over rice','5.99','0000-00-00 00:00:00','2012-09-24 00:56:59'),(10,1,3,2,'Humbao (Vegetable)','a vegetable humbao','1.09','0000-00-00 00:00:00','2012-09-24 00:56:59'),(11,1,2,2,'Humbao (Kimchi)','a kimchi humbao','1.09','0000-00-00 00:00:00','2012-09-24 00:56:59');
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
INSERT INTO `printers` VALUES (1,1,'epson','2012-09-08 20:02:58','2012-09-08 20:09:53'),(2,1,'star','2012-09-17 12:46:17','2012-09-17 12:46:17');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tax_infos`
--

LOCK TABLES `tax_infos` WRITE;
/*!40000 ALTER TABLE `tax_infos` DISABLE KEYS */;
INSERT INTO `tax_infos` VALUES (1,1,'WA','0.0950','0000-00-00 00:00:00','0000-00-00 00:00:00');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'ydc2415','d32479828fb8f48ad50efd45c141014b56e74fb5',1,'2013-01-28 21:03:32','2013-01-28 21:03:32');
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

-- Dump completed on 2013-01-30 11:38:25
