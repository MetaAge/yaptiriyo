-- MySQL dump 10.13  Distrib 9.5.0, for macos26.0 (arm64)
--
-- Host: localhost    Database: xilancer
-- ------------------------------------------------------
-- Server version	5.5.5-10.6.24-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin_notifications`
--

DROP TABLE IF EXISTS `admin_notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_notifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `identity` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `message` varchar(255) NOT NULL,
  `is_read` varchar(255) NOT NULL DEFAULT 'unread',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_notifications`
--

LOCK TABLES `admin_notifications` WRITE;
/*!40000 ALTER TABLE `admin_notifications` DISABLE KEYS */;
INSERT INTO `admin_notifications` VALUES (1,193,1236,'Create Project','Yeni bir proje oluşturuldu','read','2026-03-27 17:45:32','2026-04-02 12:50:29'),(2,5,1,'Order','Yeni sipariş verildi','unread','2026-04-02 09:43:34','2026-04-02 09:43:34'),(3,5,1236,'Reddet','Hizmet veren tarafından sipariş iptali','unread','2026-04-02 15:02:07','2026-04-02 15:02:07'),(4,12,1,'Order','Yeni sipariş verildi','unread','2026-04-02 17:16:01','2026-04-02 17:16:01'),(5,12,1236,'Reddet','Hizmet veren tarafından sipariş iptali','unread','2026-04-02 17:22:35','2026-04-02 17:22:35'),(6,15,1,'Order','Yeni sipariş verildi','unread','2026-04-02 17:24:57','2026-04-02 17:24:57'),(7,15,1236,'Reddet','Hizmet veren tarafından sipariş iptali','unread','2026-04-05 11:45:18','2026-04-05 11:45:18'),(8,16,1,'Order','Yeni sipariş verildi','unread','2026-04-05 11:48:34','2026-04-05 11:48:34'),(9,16,1236,'Reddet','Hizmet veren tarafından sipariş iptali','unread','2026-04-05 11:49:11','2026-04-05 11:49:11'),(10,194,1236,'Create Project','Yeni bir proje oluşturuldu','unread','2026-04-05 11:53:34','2026-04-05 11:53:34'),(11,17,1,'Order','Yeni sipariş verildi','unread','2026-04-05 12:03:54','2026-04-05 12:03:54'),(12,17,1236,'Order','Order submitted by freelancer','unread','2026-04-05 12:15:49','2026-04-05 12:15:49'),(13,17,1,'Order','Sipariş müşteri tarafından kabul edildi','unread','2026-04-05 12:16:51','2026-04-05 12:16:51'),(14,18,1,'Order','Yeni sipariş verildi','unread','2026-04-05 12:22:39','2026-04-05 12:22:39'),(15,18,1236,'Order','Order submitted by freelancer','unread','2026-04-05 12:26:22','2026-04-05 12:26:22'),(16,18,1236,'Order','Order submitted by freelancer','unread','2026-04-05 12:34:27','2026-04-05 12:34:27'),(17,18,1,'Order','Sipariş müşteri tarafından kabul edildi','unread','2026-04-05 12:36:56','2026-04-05 12:36:56'),(18,19,1,'Order','Yeni sipariş verildi','read','2026-04-05 15:06:59','2026-04-05 17:00:58'),(19,19,1236,'Reddet','Hizmet veren tarafından sipariş iptali','unread','2026-04-05 15:07:48','2026-04-05 15:07:48'),(20,1,1236,'Withdraw','New withdraw request','read','2026-04-05 17:02:30','2026-04-25 15:32:05'),(21,194,1236,'Edit Project','Bir proje düzenlendi.','read','2026-04-05 17:19:55','2026-04-21 17:32:50'),(22,194,1236,'Edit Project','Bir proje düzenlendi.','read','2026-04-05 17:20:12','2026-04-21 17:32:50'),(23,20,1,'Order','Yeni sipariş verildi','unread','2026-04-05 18:56:37','2026-04-05 18:56:37'),(24,194,1236,'Hizmet İlanını Düzenle','Bir proje düzenlendi.','unread','2026-04-05 19:12:24','2026-04-05 19:12:24'),(25,199,1236,'Hizmet İlanı Oluştur','Yeni bir proje oluşturuldu','unread','2026-04-05 19:25:49','2026-04-05 19:25:49'),(26,199,1236,'Hizmet İlanını Düzenle','Bir proje düzenlendi.','unread','2026-04-05 19:26:16','2026-04-05 19:26:16'),(27,199,1236,'Hizmet İlanını Düzenle','Bir proje düzenlendi.','unread','2026-04-05 19:26:44','2026-04-05 19:26:44'),(28,20,1236,'Decline','Sipariş hizmet veren tarafından reddedildi','unread','2026-04-05 19:43:07','2026-04-05 19:43:07'),(29,21,1,'Order','Yeni sipariş verildi','unread','2026-04-05 19:44:31','2026-04-05 19:44:31'),(30,21,1236,'Order','Sipariş hizmet veren tarafından teslim edildi','unread','2026-04-05 19:50:57','2026-04-05 19:50:57'),(31,21,1236,'Order','Sipariş hizmet veren tarafından teslim edildi','unread','2026-04-05 19:53:57','2026-04-05 19:53:57'),(32,21,1,'Order','Sipariş müşteri tarafından kabul edildi','unread','2026-04-05 19:54:20','2026-04-05 19:54:20'),(33,25,1,'Order','Yeni sipariş verildi','unread','2026-04-06 15:23:24','2026-04-06 15:23:24'),(34,25,1236,'Iptal','Hizmet veren tarafından sipariş iptali','unread','2026-04-06 15:24:02','2026-04-06 15:24:02'),(35,26,1,'Order','Yeni sipariş verildi','unread','2026-04-06 15:32:16','2026-04-06 15:32:16'),(36,26,1236,'Order','Order submitted by freelancer','unread','2026-04-06 15:33:11','2026-04-06 15:33:11'),(37,26,1,'Order','Sipariş müşteri tarafından kabul edildi','unread','2026-04-06 15:33:36','2026-04-06 15:33:36'),(38,204,1236,'Hizmet İlanı Oluştur','Yeni bir proje oluşturuldu','unread','2026-04-06 18:32:09','2026-04-06 18:32:09'),(39,204,1236,'Hizmet İlanını Düzenle','Bir proje düzenlendi.','unread','2026-04-12 15:16:31','2026-04-12 15:16:31'),(40,204,1236,'Hizmet İlanını Düzenle','Bir proje düzenlendi.','unread','2026-04-14 03:54:42','2026-04-14 03:54:42'),(41,204,1236,'Hizmet İlanını Düzenle','Bir proje düzenlendi.','unread','2026-04-14 03:55:11','2026-04-14 03:55:11'),(42,204,1236,'Hizmet İlanını Düzenle','Bir proje düzenlendi.','unread','2026-04-14 04:32:30','2026-04-14 04:32:30'),(43,204,1236,'Hizmet İlanını Düzenle','Bir proje düzenlendi.','unread','2026-04-14 04:49:40','2026-04-14 04:49:40'),(44,204,1236,'Hizmet İlanını Düzenle','Bir proje düzenlendi.','unread','2026-04-14 04:50:52','2026-04-14 04:50:52'),(45,204,1236,'Hizmet İlanını Düzenle','Bir proje düzenlendi.','unread','2026-04-14 04:57:16','2026-04-14 04:57:16'),(46,2,1236,'Withdraw','New withdraw request','read','2026-04-14 08:08:25','2026-04-25 15:32:05'),(47,207,1,'Hizmet İlanı Oluştur','Yeni bir proje oluşturuldu','unread','2026-04-16 12:41:15','2026-04-16 12:41:15'),(48,30,1237,'Order','Yeni sipariş verildi','unread','2026-04-16 12:43:55','2026-04-16 12:43:55'),(49,30,1,'Order','Sipariş hizmet veren tarafından teslim edildi','unread','2026-04-16 12:45:48','2026-04-16 12:45:48'),(50,30,1,'Order','Sipariş hizmet veren tarafından teslim edildi','unread','2026-04-16 12:48:26','2026-04-16 12:48:26'),(51,30,1237,'Order','Sipariş müşteri tarafından kabul edildi','unread','2026-04-16 12:48:49','2026-04-16 12:48:49'),(52,194,1236,'Hizmet İlanını Düzenle','Bir proje düzenlendi.','unread','2026-04-21 16:03:57','2026-04-21 16:03:57'),(53,204,1236,'Hizmet İlanını Düzenle','Bir proje düzenlendi.','unread','2026-04-21 17:02:35','2026-04-21 17:02:35'),(54,32,1,'Order','Yeni sipariş verildi','unread','2026-04-21 17:32:43','2026-04-21 17:32:43'),(55,199,1236,'Hizmet İlanını Düzenle','Bir proje düzenlendi.','unread','2026-04-22 14:28:23','2026-04-22 14:28:23'),(56,38,1,'Order','Yeni sipariş verildi','unread','2026-04-22 15:26:50','2026-04-22 15:26:50'),(57,38,1236,'Decline','Sipariş hizmet veren tarafından reddedildi','unread','2026-04-22 15:27:40','2026-04-22 15:27:40'),(58,39,1,'Order','Yeni sipariş verildi','unread','2026-04-22 18:01:36','2026-04-22 18:01:36'),(59,39,1236,'Decline','Sipariş hizmet veren tarafından reddedildi','unread','2026-04-22 18:05:36','2026-04-22 18:05:36'),(60,40,1,'Order','Yeni sipariş verildi','unread','2026-04-22 18:10:02','2026-04-22 18:10:02'),(61,40,1236,'Decline','Sipariş hizmet veren tarafından reddedildi','unread','2026-04-22 18:11:08','2026-04-22 18:11:08'),(62,214,1,'Hizmet İlanı Oluştur','Yeni bir proje oluşturuldu','unread','2026-04-23 11:27:42','2026-04-23 11:27:42'),(63,53,1,'Order','Yeni sipariş verildi','unread','2026-04-23 17:54:13','2026-04-23 17:54:13'),(64,55,1,'Order','Yeni sipariş verildi','unread','2026-04-23 18:04:54','2026-04-23 18:04:54'),(65,204,1236,'Hizmet İlanını Düzenle','Bir proje düzenlendi.','unread','2026-04-23 19:02:45','2026-04-23 19:02:45'),(66,53,1236,'Decline','Sipariş hizmet veren tarafından reddedildi','unread','2026-04-23 19:06:33','2026-04-23 19:06:33'),(67,55,1236,'Decline','Sipariş hizmet veren tarafından reddedildi','unread','2026-04-23 19:06:53','2026-04-23 19:06:53'),(68,54,1236,'Decline','Sipariş hizmet veren tarafından reddedildi','unread','2026-04-23 19:07:02','2026-04-23 19:07:02'),(69,214,1,'Hizmet İlanını Düzenle','Bir proje düzenlendi.','unread','2026-04-24 06:54:55','2026-04-24 06:54:55'),(70,214,1,'Hizmet İlanını Düzenle','Bir proje düzenlendi.','unread','2026-04-24 08:12:39','2026-04-24 08:12:39'),(71,214,1,'Hizmet İlanını Düzenle','Bir proje düzenlendi.','unread','2026-04-24 08:12:54','2026-04-24 08:12:54'),(72,207,1,'Hizmet İlanını Düzenle','Bir proje düzenlendi.','unread','2026-04-24 10:34:24','2026-04-24 10:34:24'),(73,67,1,'Order','Yeni sipariş verildi','unread','2026-04-24 15:00:11','2026-04-24 15:00:11'),(74,68,1,'Order','Yeni sipariş verildi','unread','2026-04-25 06:07:53','2026-04-25 06:07:53'),(75,68,1236,'Decline','Sipariş hizmet veren tarafından reddedildi','unread','2026-04-25 07:59:41','2026-04-25 07:59:41'),(76,69,1,'Order','Yeni sipariş verildi','unread','2026-04-25 12:59:21','2026-04-25 12:59:21'),(77,70,1,'Order','Yeni sipariş verildi','unread','2026-04-25 13:04:05','2026-04-25 13:04:05'),(78,71,1,'Order','Yeni sipariş verildi','read','2026-04-25 13:11:34','2026-04-26 13:53:00'),(79,71,1236,'Decline','Sipariş hizmet veren tarafından reddedildi','unread','2026-04-25 13:12:27','2026-04-25 13:12:27'),(80,70,1236,'Decline','Sipariş hizmet veren tarafından reddedildi','unread','2026-04-25 13:12:51','2026-04-25 13:12:51'),(81,69,1236,'Decline','Sipariş hizmet veren tarafından reddedildi','unread','2026-04-25 13:13:01','2026-04-25 13:13:01'),(82,3,1,'Withdraw','New withdraw request','read','2026-04-25 15:12:29','2026-04-25 15:32:05'),(83,4,1,'Withdraw','New withdraw request','read','2026-04-25 15:21:38','2026-04-25 15:32:05'),(84,5,1,'Withdraw','New withdraw request','read','2026-04-25 15:30:21','2026-04-25 15:32:05'),(85,72,1,'Order','Yeni sipariş verildi','unread','2026-04-25 16:45:28','2026-04-25 16:45:28'),(86,72,1236,'Order','Sipariş hizmet veren tarafından teslim edildi','unread','2026-04-25 16:49:33','2026-04-25 16:49:33'),(87,72,1,'Order','Sipariş müşteri tarafından kabul edildi','unread','2026-04-25 16:51:20','2026-04-25 16:51:20'),(88,32,1,'Decline','Sipariş hizmet veren tarafından reddedildi','unread','2026-04-26 14:28:57','2026-04-26 14:28:57'),(89,73,1236,'Order','Yeni sipariş verildi','read','2026-04-26 14:52:09','2026-04-27 08:54:38'),(90,73,1,'Decline','Sipariş hizmet veren tarafından reddedildi','unread','2026-04-27 09:16:54','2026-04-27 09:16:54'),(91,1,1,'Buy Package','Promotion package purchase','read','2026-04-27 13:54:06','2026-04-28 03:58:25'),(92,207,1,'Buy Package','Promotion package purchase (Iyzico)','read','2026-04-28 03:57:46','2026-04-28 03:58:25'),(93,194,1236,'Buy Package','Promotion package purchase (Iyzico)','unread','2026-04-28 04:27:34','2026-04-28 04:27:34'),(94,74,1,'Order','Yeni sipariş verildi','unread','2026-04-28 05:51:26','2026-04-28 05:51:26'),(95,74,1236,'Order','Sipariş hizmet veren tarafından teslim edildi','unread','2026-04-28 05:51:57','2026-04-28 05:51:57'),(96,74,1,'Order','Sipariş müşteri tarafından kabul edildi','unread','2026-04-28 05:52:12','2026-04-28 05:52:12'),(97,75,1,'Order','Yeni sipariş verildi','unread','2026-04-28 08:35:03','2026-04-28 08:35:03'),(98,75,1236,'Decline','Sipariş hizmet veren tarafından reddedildi','unread','2026-04-28 08:35:34','2026-04-28 08:35:34'),(99,76,1,'Order','Yeni sipariş verildi','unread','2026-05-04 12:43:45','2026-05-04 12:43:45'),(100,77,1,'Order','Yeni sipariş verildi','unread','2026-05-04 12:44:29','2026-05-04 12:44:29'),(101,78,1,'Order','Yeni sipariş verildi','unread','2026-05-04 12:45:18','2026-05-04 12:45:18'),(102,78,1236,'Decline','Sipariş hizmet veren tarafından reddedildi','unread','2026-05-04 12:45:35','2026-05-04 12:45:35'),(103,193,1236,'Edit Project','Bir proje düzenlendi.','unread','2026-05-04 13:41:25','2026-05-04 13:41:25'),(104,194,1236,'Edit Project','Bir proje düzenlendi.','unread','2026-05-04 13:43:18','2026-05-04 13:43:18'),(105,199,1236,'Edit Project','Bir proje düzenlendi.','unread','2026-05-04 13:44:28','2026-05-04 13:44:28'),(106,204,1236,'Edit Project','Bir proje düzenlendi.','unread','2026-05-04 13:45:12','2026-05-04 13:45:12'),(107,207,1,'Edit Project','Bir proje düzenlendi.','unread','2026-05-04 13:48:21','2026-05-04 13:48:21'),(108,214,1,'Edit Project','Bir proje düzenlendi.','unread','2026-05-04 13:49:14','2026-05-04 13:49:14'),(109,12,1236,'Abonelik Satın Al','User subscription purchase (Iyzico)','unread','2026-05-07 05:45:53','2026-05-07 05:45:53');
/*!40000 ALTER TABLE `admin_notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `is_email_verified` tinyint(3) unsigned NOT NULL DEFAULT 0 COMMENT '0: not verified, 1:verified',
  `email_verify_token` text DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT '1' COMMENT '1:super admin, 2:admin, 3:manager, 4:editor, 5:supporter 6:employee',
  `image` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0:active, 1:inactive',
  `designation` varchar(255) DEFAULT NULL,
  `about` text DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'Admin','admin','ahmeteren1999@gmail.com',0,NULL,NULL,'1',NULL,'$2y$10$RHdvJ5O6c34LC/rPYBkGX.oW7WcukhyjIUzwCX.w61f0c.0V8ApPq',1,NULL,NULL,'wvvZN2pwXdtH3RQLLwRitYnXaeosVdyYtJxZuysy90esv4944X7VfZM9iTVW',NULL,NULL);
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `banners` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  `category_id` bigint(20) unsigned DEFAULT NULL,
  `project_id` bigint(20) unsigned DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'project',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banners`
--

LOCK TABLES `banners` WRITE;
/*!40000 ALTER TABLE `banners` DISABLE KEYS */;
/*!40000 ALTER TABLE `banners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_posts`
--

DROP TABLE IF EXISTS `blog_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blog_posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) NOT NULL,
  `admin_id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` text DEFAULT NULL,
  `content` longtext NOT NULL,
  `image` varchar(255) NOT NULL,
  `views` bigint(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=inactive, 1=active',
  `tag_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_posts`
--

LOCK TABLES `blog_posts` WRITE;
/*!40000 ALTER TABLE `blog_posts` DISABLE KEYS */;
INSERT INTO `blog_posts` VALUES (1,2,1,'I will do figma website design or landing page UI UX design 1','i-will-do-figma-website-design-or-landing-page-ui-ux-design-1','<p>Over the last several years, a number of factors—including the pandemic, shifting labor market dynamics, macroeconomic uncertainties, and technological advancements—have prompted a significant reevaluation of what “work” looks like among enterprise leaders. To help drive the growth and success of our enterprise business, and deliver work solutions to our largest clients, we were pleased to welcome Zoë Diamadi as Upwork’s General Manager (GM) of Enterprise.</p><p><br></p><p>\r\n</p><p>Zoë came to Upwork with over two decades of experience as a go-to-market leader, strategist, engineer, management consultant, and innovator at many companies across tech, talent, and B2B. Since joining in June of 2023, she has overseen and evolved Enterprise sales, product, engineering, and operations.\r\n</p><p>We spoke with Zoë about her critical role in helping enterprises navigate the changing global work environment and dynamic hiring climate, her reasons for joining Upwork, and how she plans to champion the delivery of a best-in-class Enterprise Suite offering to our largest customers.</p><p><br></p><p>\r\n</p><p>You have extensive background in technology and business. How has your journey prepared you for your role as GM of Enterprise at Upwork?\r\n</p><p>My journey has been an evolution through various domains, from engineering to management consulting, and what I like to call “intrapreneurship.” I spent six years as GM of LinkedIn Elevate, building the leading employee advocacy solution for enterprises, as well as time spent in executive positions for LinkedIn’s B2B organization, helping scale its three enterprise business lines.</p><p><br></p><p>\r\n</p><p>More recently, I served as an operating advisor at Bessemer Venture Partners. There, I guided portfolio companies on go-to-market topics spanning revenue growth, efficient scaling, and operational excellence for sales and post-sales functions.\r\n</p><p>These experiences have given me a holistic perspective on enterprises, their business strategies, and opportunities that drive growth. This journey has led me to my current role at Upwork.\r\n</p><p>I believe we are at a critical inflection point in the future of work, and frankly, \"work\" needs to catch up to the technologies that are now enabling it to happen. Upwork delivers an end-to-end offering that gives enterprise companies access to a wide breadth of highly skilled fractional to full-time professionals and workforce solutions, enabling them to achieve incredible business outcomes. I hope to help even more organizations discover, and scale with, the transformational value of Upwork.\r\n</p><p>What motivated you to join Upwork?</p><p><br></p><p>\r\n</p><p>Aside from what I feel is the perfect career fit, on a more personal level, I grew up in a small rural place in Greece. Every day, I saw firsthand how many talented and hardworking people were limited by their geography and couldn’t access the opportunities they wanted and were qualified for. These people in my memories represent an untapped pool of highly skilled talent who could have a huge impact on companies. Additionally, these companies and jobs represent a huge economic opportunity for these people to lift themselves, their families, and their communities up.\r\n</p><p>That’s why I’m so passionate about Upwork—and why I joined.</p>','206',NULL,1,'sd asd ads,as as','2023-12-10 19:20:24','2025-03-23 09:17:57'),(3,1,1,'I will do figma website design or landing page UI UX design 234','i-will-do-figma-website-design-or-landing-page-ui-ux-design-234','Over the last several years, a number of factors—including the pandemic, shifting labor market dynamics, macroeconomic uncertainties, and technological advancements—have prompted a significant reevaluation of what “work” looks like among enterprise leaders. To help drive the growth and success of our enterprise business, and deliver work solutions to our largest clients, we were pleased to welcome Zoë Diamadi as Upwork’s General Manager (GM) of Enterprise.\r\n<div>Zoë came to Upwork with over two decades of experience as a go-to-market leader, strategist, engineer, management consultant, and innovator at many companies across tech, talent, and B2B. Since joining in June of 2023, she has overseen and evolved Enterprise sales, product, engineering, and operations.\r\n</div><div>We spoke with Zoë about her critical role in helping enterprises navigate the changing global work environment and dynamic hiring climate, her reasons for joining Upwork, and how she plans to champion the delivery of a best-in-class Enterprise Suite offering to our largest customers.\r\n</div><div>You have extensive background in technology and business. How has your journey prepared you for your role as GM of Enterprise at Upwork?\r\n</div><div>My journey has been an evolution through various domains, from engineering to management consulting, and what I like to call “intrapreneurship.” I spent six years as GM of LinkedIn Elevate, building the leading employee advocacy solution for enterprises, as well as time spent in executive positions for LinkedIn’s B2B organization, helping scale its three enterprise business lines.\r\n</div><div>More recently, I served as an operating advisor at Bessemer Venture Partners. There, I guided portfolio companies on go-to-market topics spanning revenue growth, efficient scaling, and operational excellence for sales and post-sales functions.\r\n</div><div>These experiences have given me a holistic perspective on enterprises, their business strategies, and opportunities that drive growth. This journey has led me to my current role at Upwork.\r\n</div><div>I believe we are at a critical inflection point in the future of work, and frankly, \"work\" needs to catch up to the technologies that are now enabling it to happen. Upwork delivers an end-to-end offering that gives enterprise companies access to a wide breadth of highly skilled fractional to full-time professionals and workforce solutions, enabling them to achieve incredible business outcomes. I hope to help even more organizations discover, and scale with, the transformational value of Upwork.\r\n</div><div>What motivated you to join Upwork?\r\n</div><div>Aside from what I feel is the perfect career fit, on a more personal level, I grew up in a small rural place in Greece. Every day, I saw firsthand how many talented and hardworking people were limited by their geography and couldn’t access the opportunities they wanted and were qualified for. These people in my memories represent an untapped pool of highly skilled talent who could have a huge impact on companies. Additionally, these companies and jobs represent a huge economic opportunity for these people to lift themselves, their families, and their communities up.\r\n</div><div>That’s why I’m so passionate about Upwork—and why I joined.</div>','207',NULL,1,'asdadasd,asd ,ads a','2023-12-10 22:52:45','2025-03-23 09:18:57'),(4,1,1,'I will do figma website design or landing page UI UX design 2','i-will-do-figma-website-design-or-landing-page-ui-ux-design-2','Over the last several years, a number of factors—including the pandemic, shifting labor market dynamics, macroeconomic uncertainties, and technological advancements—have prompted a significant reevaluation of what “work” looks like among enterprise leaders. To help drive the growth and success of our enterprise business, and deliver work solutions to our largest clients, we were pleased to welcome Zoë Diamadi as Upwork’s General Manager (GM) of Enterprise.\r\n<div>Zoë came to Upwork with over two decades of experience as a go-to-market leader, strategist, engineer, management consultant, and innovator at many companies across tech, talent, and B2B. Since joining in June of 2023, she has overseen and evolved Enterprise sales, product, engineering, and operations.\r\n</div><div>We spoke with Zoë about her critical role in helping enterprises navigate the changing global work environment and dynamic hiring climate, her reasons for joining Upwork, and how she plans to champion the delivery of a best-in-class Enterprise Suite offering to our largest customers.\r\n</div><div>You have extensive background in technology and business. How has your journey prepared you for your role as GM of Enterprise at Upwork?\r\n</div><div>My journey has been an evolution through various domains, from engineering to management consulting, and what I like to call “intrapreneurship.” I spent six years as GM of LinkedIn Elevate, building the leading employee advocacy solution for enterprises, as well as time spent in executive positions for LinkedIn’s B2B organization, helping scale its three enterprise business lines.\r\n</div><div>More recently, I served as an operating advisor at Bessemer Venture Partners. There, I guided portfolio companies on go-to-market topics spanning revenue growth, efficient scaling, and operational excellence for sales and post-sales functions.\r\n</div><div>These experiences have given me a holistic perspective on enterprises, their business strategies, and opportunities that drive growth. This journey has led me to my current role at Upwork.\r\n</div><div>I believe we are at a critical inflection point in the future of work, and frankly, \"work\" needs to catch up to the technologies that are now enabling it to happen. Upwork delivers an end-to-end offering that gives enterprise companies access to a wide breadth of highly skilled fractional to full-time professionals and workforce solutions, enabling them to achieve incredible business outcomes. I hope to help even more organizations discover, and scale with, the transformational value of Upwork.\r\n</div><div>What motivated you to join Upwork?\r\n</div><div>Aside from what I feel is the perfect career fit, on a more personal level, I grew up in a small rural place in Greece. Every day, I saw firsthand how many talented and hardworking people were limited by their geography and couldn’t access the opportunities they wanted and were qualified for. These people in my memories represent an untapped pool of highly skilled talent who could have a huge impact on companies. Additionally, these companies and jobs represent a huge economic opportunity for these people to lift themselves, their families, and their communities up.\r\n</div><div>That’s why I’m so passionate about Upwork—and why I joined.</div>','208',NULL,1,'a sasda','2023-12-10 22:53:11','2025-03-23 09:17:33'),(5,1,1,'I will do figma website design or landing page UI UX design','i-will-do-figma-website-design-or-landing-page-ui-ux-design','Over the last several years, a number of factors—including the pandemic, shifting labor market dynamics, macroeconomic uncertainties, and technological advancements—have prompted a significant reevaluation of what “work” looks like among enterprise leaders. To help drive the growth and success of our enterprise business, and deliver work solutions to our largest clients, we were pleased to welcome Zoë Diamadi as Upwork’s General Manager (GM) of Enterprise.\r\n<div>\r\n</div><div>Zoë came to Upwork with over two decades of experience as a go-to-market leader, strategist, engineer, management consultant, and innovator at many companies across tech, talent, and B2B. Since joining in June of 2023, she has overseen and evolved Enterprise sales, product, engineering, and operations.\r\n</div><div>\r\n</div><div>We spoke with Zoë about her critical role in helping enterprises navigate the changing global work environment and dynamic hiring climate, her reasons for joining Upwork, and how she plans to champion the delivery of a best-in-class Enterprise Suite offering to our largest customers.\r\n</div><div>\r\n</div><div>You have extensive background in technology and business. How has your journey prepared you for your role as GM of Enterprise at Upwork?\r\n</div><div>My journey has been an evolution through various domains, from engineering to management consulting, and what I like to call “intrapreneurship.” I spent six years as GM of LinkedIn Elevate, building the leading employee advocacy solution for enterprises, as well as time spent in executive positions for LinkedIn’s B2B organization, helping scale its three enterprise business lines.\r\n</div><div>\r\n</div><div>More recently, I served as an operating advisor at Bessemer Venture Partners. There, I guided portfolio companies on go-to-market topics spanning revenue growth, efficient scaling, and operational excellence for sales and post-sales functions.\r\n</div><div>\r\n</div><div>These experiences have given me a holistic perspective on enterprises, their business strategies, and opportunities that drive growth. This journey has led me to my current role at Upwork.\r\n</div><div>\r\n</div><div>I believe we are at a critical inflection point in the future of work, and frankly, \"work\" needs to catch up to the technologies that are now enabling it to happen. Upwork delivers an end-to-end offering that gives enterprise companies access to a wide breadth of highly skilled fractional to full-time professionals and workforce solutions, enabling them to achieve incredible business outcomes. I hope to help even more organizations discover, and scale with, the transformational value of Upwork.\r\n</div><div>\r\n</div><div>What motivated you to join Upwork?\r\n</div><div>Aside from what I feel is the perfect career fit, on a more personal level, I grew up in a small rural place in Greece. Every day, I saw firsthand how many talented and hardworking people were limited by their geography and couldn’t access the opportunities they wanted and were qualified for. These people in my memories represent an untapped pool of highly skilled talent who could have a huge impact on companies. Additionally, these companies and jobs represent a huge economic opportunity for these people to lift themselves, their families, and their communities up.\r\n</div><div>\r\n</div><div>That’s why I’m so passionate about Upwork—and why I joined.</div>','209',NULL,1,'dfsdf,sdfsdf,dsf sdf','2023-12-11 17:57:15','2025-03-23 09:17:24');
/*!40000 ALTER TABLE `blog_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bookmarks`
--

DROP TABLE IF EXISTS `bookmarks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bookmarks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `identity` bigint(20) NOT NULL,
  `is_project_job` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookmarks`
--

LOCK TABLES `bookmarks` WRITE;
/*!40000 ALTER TABLE `bookmarks` DISABLE KEYS */;
/*!40000 ALTER TABLE `bookmarks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `call_histories`
--

DROP TABLE IF EXISTS `call_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `call_histories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `caller_id` bigint(20) unsigned NOT NULL,
  `receiver_id` bigint(20) unsigned NOT NULL,
  `live_chat_id` bigint(20) unsigned DEFAULT NULL,
  `channel_name` varchar(255) NOT NULL,
  `status` enum('missed','answered','declined','ended') NOT NULL DEFAULT 'missed',
  `duration` int(11) NOT NULL DEFAULT 0 COMMENT 'Duration in seconds',
  `started_at` timestamp NULL DEFAULT NULL,
  `ended_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `call_histories_caller_id_foreign` (`caller_id`),
  KEY `call_histories_receiver_id_foreign` (`receiver_id`),
  CONSTRAINT `call_histories_caller_id_foreign` FOREIGN KEY (`caller_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `call_histories_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=123 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `call_histories`
--

LOCK TABLES `call_histories` WRITE;
/*!40000 ALTER TABLE `call_histories` DISABLE KEYS */;
INSERT INTO `call_histories` VALUES (1,1,1236,NULL,'call_1_1236_1775906197','answered',0,'2026-04-11 08:16:44',NULL,'2026-04-11 08:16:37','2026-04-11 08:16:44'),(2,1,1236,NULL,'call_1_1236_1775906208','answered',0,'2026-04-11 08:16:56',NULL,'2026-04-11 08:16:48','2026-04-11 08:16:56'),(3,1,1236,NULL,'call_1_1236_1775906383','missed',0,'2026-04-11 08:19:43',NULL,'2026-04-11 08:19:43','2026-04-11 08:19:43'),(4,1,1236,NULL,'call_1_1236_1775906386','missed',0,'2026-04-11 08:19:46',NULL,'2026-04-11 08:19:46','2026-04-11 08:19:46'),(5,1,1236,NULL,'call_1_1236_1775906707','missed',0,'2026-04-11 08:25:07',NULL,'2026-04-11 08:25:07','2026-04-11 08:25:07'),(6,1,1236,NULL,'call_1_1236_1775906710','missed',0,'2026-04-11 08:25:10',NULL,'2026-04-11 08:25:10','2026-04-11 08:25:10'),(7,1,1236,NULL,'call_1_1236_1775906885','missed',-14,'2026-04-11 08:28:05','2026-04-11 08:28:18','2026-04-11 08:28:05','2026-04-11 08:28:18'),(8,1236,1,NULL,'call_1_1236_1775907723','missed',-12,'2026-04-11 08:42:03','2026-04-11 08:42:14','2026-04-11 08:42:03','2026-04-11 08:42:14'),(9,1236,1,NULL,'call_1_1236_1775908310','ended',-19,'2026-04-11 08:51:55','2026-04-11 08:52:14','2026-04-11 08:51:50','2026-04-11 08:52:14'),(10,1,1236,NULL,'call_1_1236_1775908337','ended',-12,'2026-04-11 08:52:21','2026-04-11 08:52:33','2026-04-11 08:52:17','2026-04-11 08:52:33'),(11,1236,1,NULL,'call_1_1236_1775908366','answered',-39,'2026-04-11 08:53:26','2026-04-11 08:53:25','2026-04-11 08:52:46','2026-04-11 08:53:26'),(12,1236,1,NULL,'call_1_1236_1775908412','ended',-6,'2026-04-11 08:53:35','2026-04-11 08:53:41','2026-04-11 08:53:32','2026-04-11 08:53:41'),(13,1236,1,NULL,'call_1_1236_1776002849','missed',-14,'2026-04-12 11:07:29','2026-04-12 11:07:43','2026-04-12 11:07:29','2026-04-12 11:07:43'),(14,1236,1,NULL,'call_1_1236_1776002866','ended',-72,'2026-04-12 11:07:50','2026-04-12 11:09:02','2026-04-12 11:07:46','2026-04-12 11:09:02'),(15,1,1236,NULL,'call_1_1236_1776003124','ended',-15,'2026-04-12 11:12:09','2026-04-12 11:12:23','2026-04-12 11:12:04','2026-04-12 11:12:23'),(16,1236,1,NULL,'call_1_1236_1776003293','ended',-49,'2026-04-12 11:14:56','2026-04-12 11:15:44','2026-04-12 11:14:53','2026-04-12 11:15:44'),(17,1236,1,NULL,'call_1_1236_1776004242','ended',-28,'2026-04-12 11:30:47','2026-04-12 11:31:15','2026-04-12 11:30:42','2026-04-12 11:31:15'),(18,1236,1,NULL,'call_1_1236_1776004651','ended',-15,'2026-04-12 11:37:34','2026-04-12 11:37:49','2026-04-12 11:37:31','2026-04-12 11:37:49'),(19,1,1236,NULL,'call_1_1236_1776004671','ended',-34,'2026-04-12 11:37:55','2026-04-12 11:38:29','2026-04-12 11:37:51','2026-04-12 11:38:29'),(20,1236,1,NULL,'call_1_1236_1776004947','ended',-28,'2026-04-12 11:42:30','2026-04-12 11:42:57','2026-04-12 11:42:27','2026-04-12 11:42:57'),(21,1236,1,NULL,'call_1_1236_1776004986','ended',-22,'2026-04-12 11:43:09','2026-04-12 11:43:30','2026-04-12 11:43:06','2026-04-12 11:43:30'),(22,1236,1,NULL,'call_1_1236_1776005889','ended',-10,'2026-04-12 11:58:13','2026-04-12 11:58:22','2026-04-12 11:58:09','2026-04-12 11:58:22'),(23,1236,1,NULL,'call_1_1236_1776006078','ended',-40,'2026-04-12 12:01:19','2026-04-12 12:01:59','2026-04-12 12:01:18','2026-04-12 12:01:59'),(24,1236,1,NULL,'call_1_1236_1776006130','ended',-6,'2026-04-12 12:02:12','2026-04-12 12:02:17','2026-04-12 12:02:10','2026-04-12 12:02:17'),(25,1,1236,NULL,'call_1_1236_1776006386','ended',-7,'2026-04-12 12:06:28','2026-04-12 12:06:34','2026-04-12 12:06:26','2026-04-12 12:06:34'),(26,1,1236,NULL,'call_1_1236_1776006399','declined',-3,'2026-04-12 12:06:39','2026-04-12 12:06:41','2026-04-12 12:06:39','2026-04-12 12:06:41'),(27,1236,1,NULL,'call_1_1236_1776006408','ended',-5,'2026-04-12 12:06:49','2026-04-12 12:06:53','2026-04-12 12:06:48','2026-04-12 12:06:53'),(28,1,1236,NULL,'call_1_1236_1776006420','ended',-5,'2026-04-12 12:07:02','2026-04-12 12:07:06','2026-04-12 12:07:00','2026-04-12 12:07:06'),(29,1236,1,NULL,'call_1_1236_1776006429','missed',-9,'2026-04-12 12:07:09','2026-04-12 12:07:17','2026-04-12 12:07:09','2026-04-12 12:07:17'),(30,1,1236,NULL,'call_1_1236_1776008558','missed',-26,'2026-04-12 12:42:38','2026-04-12 12:43:04','2026-04-12 12:42:38','2026-04-12 12:43:04'),(31,1,1236,NULL,'call_1_1236_1776008588','missed',-13,'2026-04-12 12:43:08','2026-04-12 12:43:21','2026-04-12 12:43:08','2026-04-12 12:43:21'),(32,1,1236,NULL,'call_1_1236_1776008612','missed',-23,'2026-04-12 12:43:32','2026-04-12 12:43:54','2026-04-12 12:43:32','2026-04-12 12:43:54'),(33,1,1236,NULL,'call_1_1236_1776008893','missed',-27,'2026-04-12 12:48:13','2026-04-12 12:48:39','2026-04-12 12:48:13','2026-04-12 12:48:39'),(34,1236,1,NULL,'call_1_1236_1776008925','missed',-21,'2026-04-12 12:48:45','2026-04-12 12:49:05','2026-04-12 12:48:45','2026-04-12 12:49:05'),(35,1236,1,NULL,'call_1_1236_1776008962','missed',-27,'2026-04-12 12:49:22','2026-04-12 12:49:48','2026-04-12 12:49:22','2026-04-12 12:49:48'),(36,1,1236,NULL,'call_1_1236_1776008978','missed',-12,'2026-04-12 12:49:38','2026-04-12 12:49:50','2026-04-12 12:49:38','2026-04-12 12:49:50'),(37,1,1236,NULL,'call_1_1236_1776009244','ended',-12,'2026-04-12 12:54:08','2026-04-12 12:54:20','2026-04-12 12:54:04','2026-04-12 12:54:20'),(38,1236,1,NULL,'call_1_1236_1776009269','missed',-19,'2026-04-12 12:54:29','2026-04-12 12:54:47','2026-04-12 12:54:29','2026-04-12 12:54:47'),(39,1236,1,NULL,'call_1_1236_1776009291','ended',-16,'2026-04-12 12:54:55','2026-04-12 12:55:11','2026-04-12 12:54:51','2026-04-12 12:55:11'),(40,1236,1,NULL,'call_1_1236_1776009313','ended',-38,'2026-04-12 12:55:15','2026-04-12 12:55:53','2026-04-12 12:55:13','2026-04-12 12:55:53'),(41,1236,1,NULL,'call_1_1236_1776009482','declined',-5,'2026-04-12 12:58:02','2026-04-12 12:58:13','2026-04-12 12:58:02','2026-04-12 12:58:13'),(42,1,1236,NULL,'call_1_1236_1776009502','missed',-14,'2026-04-12 12:58:22','2026-04-12 12:58:35','2026-04-12 12:58:22','2026-04-12 12:58:35'),(43,1,1236,NULL,'call_1_1236_1776009518','missed',-9,'2026-04-12 12:58:38','2026-04-12 12:58:46','2026-04-12 12:58:38','2026-04-12 12:58:46'),(44,1,1236,NULL,'call_1_1236_1776009533','missed',-11,'2026-04-12 12:58:53','2026-04-12 12:59:03','2026-04-12 12:58:53','2026-04-12 12:59:03'),(45,1,1236,NULL,'call_1_1236_1776009549','missed',-10,'2026-04-12 12:59:09','2026-04-12 12:59:19','2026-04-12 12:59:09','2026-04-12 12:59:19'),(46,1236,1,NULL,'call_1_1236_1776009564','declined',-4,'2026-04-12 12:59:24','2026-04-12 12:59:32','2026-04-12 12:59:24','2026-04-12 12:59:32'),(47,1236,1,NULL,'call_1_1236_1776009582','missed',-10,'2026-04-12 12:59:42','2026-04-12 12:59:52','2026-04-12 12:59:42','2026-04-12 12:59:52'),(48,1236,1,NULL,'call_1_1236_1776009601','missed',-13,'2026-04-12 13:00:01','2026-04-12 13:00:13','2026-04-12 13:00:01','2026-04-12 13:00:13'),(49,1,1236,NULL,'call_1_1236_1776009616','declined',-4,'2026-04-12 13:00:16','2026-04-12 13:00:20','2026-04-12 13:00:16','2026-04-12 13:00:20'),(50,1236,1,NULL,'call_1_1236_1776009701','declined',-3,'2026-04-12 13:01:41','2026-04-12 13:01:46','2026-04-12 13:01:41','2026-04-12 13:01:46'),(51,1236,1,NULL,'call_1_1236_1776009711','missed',-14,'2026-04-12 13:01:51','2026-04-12 13:02:04','2026-04-12 13:01:51','2026-04-12 13:02:04'),(52,1236,1,NULL,'call_1_1236_1776009730','declined',-8,'2026-04-12 13:02:10','2026-04-12 13:02:20','2026-04-12 13:02:10','2026-04-12 13:02:20'),(53,1236,1,NULL,'call_1_1236_1776009742','declined',-3,'2026-04-12 13:02:22','2026-04-12 13:02:25','2026-04-12 13:02:22','2026-04-12 13:02:25'),(54,1,1236,NULL,'call_1_1236_1776009753','missed',-6,'2026-04-12 13:02:33','2026-04-12 13:02:38','2026-04-12 13:02:33','2026-04-12 13:02:38'),(55,1,1236,NULL,'call_1_1236_1776009777','missed',-6,'2026-04-12 13:02:57','2026-04-12 13:03:03','2026-04-12 13:02:57','2026-04-12 13:03:03'),(56,1,1236,NULL,'call_1_1236_1776009796','missed',-7,'2026-04-12 13:03:16','2026-04-12 13:03:22','2026-04-12 13:03:16','2026-04-12 13:03:22'),(57,1236,1,NULL,'call_1_1236_1776010357','ended',-20,'2026-04-12 13:12:41','2026-04-12 13:13:00','2026-04-12 13:12:37','2026-04-12 13:13:00'),(58,1236,1,NULL,'call_1_1236_1776010382','ended',-6,'2026-04-12 13:13:04','2026-04-12 13:13:09','2026-04-12 13:13:02','2026-04-12 13:13:09'),(59,1236,1,NULL,'call_1_1236_1776010422','declined',-8,'2026-04-12 13:13:42','2026-04-12 13:13:49','2026-04-12 13:13:42','2026-04-12 13:13:49'),(60,1236,1,NULL,'call_1_1236_1776010432','declined',-3,'2026-04-12 13:13:52','2026-04-12 13:13:57','2026-04-12 13:13:52','2026-04-12 13:13:57'),(61,1236,1,NULL,'call_1_1236_1776010440','declined',-3,'2026-04-12 13:14:00','2026-04-12 13:14:04','2026-04-12 13:14:00','2026-04-12 13:14:04'),(62,1,1236,NULL,'call_1_1236_1776010450','declined',-4,'2026-04-12 13:14:10','2026-04-12 13:14:19','2026-04-12 13:14:10','2026-04-12 13:14:19'),(63,1,1236,NULL,'call_1_1236_1776010462','declined',-4,'2026-04-12 13:14:22','2026-04-12 13:14:32','2026-04-12 13:14:22','2026-04-12 13:14:32'),(64,1236,1,NULL,'call_1_1236_1776010482','declined',-10,'2026-04-12 13:14:44','2026-04-12 13:14:56','2026-04-12 13:14:42','2026-04-12 13:14:56'),(65,1,1236,NULL,'call_1_1236_1776010503','missed',-11,'2026-04-12 13:15:03','2026-04-12 13:15:14','2026-04-12 13:15:03','2026-04-12 13:15:14'),(66,1,1236,NULL,'call_1_1236_1776010517','declined',-5,'2026-04-12 13:15:17','2026-04-12 13:15:21','2026-04-12 13:15:17','2026-04-12 13:15:21'),(67,1,1236,NULL,'call_1_1236_1776010526','missed',-7,'2026-04-12 13:15:26','2026-04-12 13:15:32','2026-04-12 13:15:26','2026-04-12 13:15:32'),(68,7,1236,NULL,'call_7_1236_1776010574','missed',-121,'2026-04-12 13:16:14','2026-04-12 13:18:15','2026-04-12 13:16:14','2026-04-12 13:18:15'),(69,7,1236,NULL,'call_7_1236_1776010708','missed',-7,'2026-04-12 13:18:28','2026-04-12 13:18:34','2026-04-12 13:18:28','2026-04-12 13:18:34'),(70,7,1236,NULL,'call_7_1236_1776010753','missed',-9,'2026-04-12 13:19:13','2026-04-12 13:19:22','2026-04-12 13:19:13','2026-04-12 13:19:22'),(71,7,1236,NULL,'call_7_1236_1776010781','ended',-4,'2026-04-12 13:19:45','2026-04-12 13:19:49','2026-04-12 13:19:41','2026-04-12 13:19:49'),(72,7,1236,NULL,'call_7_1236_1776010796','declined',-4,'2026-04-12 13:19:56','2026-04-12 13:20:04','2026-04-12 13:19:56','2026-04-12 13:20:04'),(73,1236,1,NULL,'call_1_1236_1776010812','missed',-6,'2026-04-12 13:20:12','2026-04-12 13:20:17','2026-04-12 13:20:12','2026-04-12 13:20:17'),(74,1236,7,NULL,'call_7_1236_1776010823','missed',-18,'2026-04-12 13:20:23','2026-04-12 13:20:40','2026-04-12 13:20:23','2026-04-12 13:20:40'),(75,1236,7,NULL,'call_7_1236_1776010845','declined',-5,'2026-04-12 13:20:45','2026-04-12 13:21:31','2026-04-12 13:20:45','2026-04-12 13:21:31'),(76,1236,7,NULL,'call_7_1236_1776011097','missed',-6,'2026-04-12 13:24:57','2026-04-12 13:25:02','2026-04-12 13:24:57','2026-04-12 13:25:02'),(77,7,1236,NULL,'call_7_1236_1776011110','missed',-5,'2026-04-12 13:25:10','2026-04-12 13:25:14','2026-04-12 13:25:10','2026-04-12 13:25:14'),(78,7,1236,NULL,'call_7_1236_1776011618','ended',-19,'2026-04-12 13:33:41','2026-04-12 13:33:59','2026-04-12 13:33:38','2026-04-12 13:33:59'),(79,1236,7,NULL,'call_7_1236_1776011751','missed',-5,'2026-04-12 13:35:51','2026-04-12 13:35:55','2026-04-12 13:35:51','2026-04-12 13:35:55'),(80,1236,7,NULL,'call_7_1236_1776011779','ended',-39,'2026-04-12 13:36:23','2026-04-12 13:37:02','2026-04-12 13:36:19','2026-04-12 13:37:02'),(81,7,1236,NULL,'call_7_1236_1776011826','ended',-3,'2026-04-12 13:38:04','2026-04-12 13:38:06','2026-04-12 13:37:06','2026-04-12 13:38:06'),(82,1236,7,NULL,'call_7_1236_1776011892','declined',-5,'2026-04-12 13:38:15','2026-04-12 13:38:22','2026-04-12 13:38:12','2026-04-12 13:38:22'),(83,1236,7,NULL,'call_7_1236_1776011915','declined',-3,'2026-04-12 13:38:37','2026-04-12 13:40:04','2026-04-12 13:38:35','2026-04-12 13:40:04'),(84,1236,7,NULL,'call_7_1236_1776012185','ended',-4,'2026-04-12 13:43:09','2026-04-12 13:43:13','2026-04-12 13:43:05','2026-04-12 13:43:13'),(85,1236,7,NULL,'call_7_1236_1776012196','ended',-4,'2026-04-12 13:43:19','2026-04-12 13:43:22','2026-04-12 13:43:16','2026-04-12 13:43:22'),(86,1236,1237,NULL,'call_1236_1237_1776352574','declined',-21,'2026-04-16 12:16:20','2026-04-16 12:16:45','2026-04-16 12:16:14','2026-04-16 12:16:45'),(87,1236,1,NULL,'call_1_1236_1776353192','declined',-13,'2026-04-16 12:26:37','2026-04-16 12:26:53','2026-04-16 12:26:32','2026-04-16 12:26:53'),(88,1237,1237,NULL,'call_1237_1237_1776353251','missed',-20,'2026-04-16 12:27:31','2026-04-16 12:27:50','2026-04-16 12:27:31','2026-04-16 12:27:50'),(89,1236,1237,NULL,'call_1236_1237_1776353274','declined',-5,'2026-04-16 12:27:54','2026-04-16 12:28:00','2026-04-16 12:27:54','2026-04-16 12:28:00'),(90,1,1236,NULL,'call_1_1236_1776356100','declined',0,'2026-04-16 13:15:00','2026-04-16 13:16:00','2026-04-16 13:15:00','2026-04-16 13:16:00'),(91,1,1236,NULL,'call_1_1236_1776356103','declined',-3,'2026-04-16 13:15:03','2026-04-16 13:15:57','2026-04-16 13:15:03','2026-04-16 13:15:57'),(92,1,1236,NULL,'call_1_1236_1776356165','ended',-12,'2026-04-16 13:16:08','2026-04-16 13:16:19','2026-04-16 13:16:05','2026-04-16 13:16:19'),(93,1236,1,NULL,'call_1_1236_1776953788','missed',-9,'2026-04-23 11:16:28','2026-04-23 11:16:37','2026-04-23 11:16:28','2026-04-23 11:16:37'),(94,1,1236,NULL,'call_1_1236_1777148717','missed',-18,'2026-04-25 17:25:17','2026-04-25 17:25:35','2026-04-25 17:25:17','2026-04-25 17:25:35'),(95,1236,1,NULL,'call_1_1236_1777148738','declined',-6,'2026-04-25 17:25:41','2026-04-25 17:25:50','2026-04-25 17:25:38','2026-04-25 17:25:50'),(96,1,1236,NULL,'call_1_1236_1777149008','missed',-13,'2026-04-25 17:30:08','2026-04-25 17:30:21','2026-04-25 17:30:08','2026-04-25 17:30:21'),(97,1,1236,NULL,'call_1_1236_1777149227','ended',-49,'2026-04-25 17:33:57','2026-04-25 17:34:46','2026-04-25 17:33:47','2026-04-25 17:34:46'),(98,1,1236,NULL,'call_1_1236_1777149883','missed',-21,'2026-04-25 17:44:43','2026-04-25 17:45:03','2026-04-25 17:44:43','2026-04-25 17:45:03'),(99,1,1236,NULL,'call_1_1236_1777149906','missed',-10,'2026-04-25 17:45:06','2026-04-25 17:45:16','2026-04-25 17:45:06','2026-04-25 17:45:16'),(100,1,1236,NULL,'call_1_1236_1777150648','ended',-14,'2026-04-25 17:57:36','2026-04-25 17:57:50','2026-04-25 17:57:28','2026-04-25 17:57:50'),(101,1,1236,NULL,'call_1_1236_1777150678','ended',-5,'2026-04-25 17:58:17','2026-04-25 17:58:21','2026-04-25 17:57:58','2026-04-25 17:58:21'),(102,1,1236,NULL,'call_1_1236_1777366085','missed',-21,'2026-04-28 05:48:05','2026-04-28 05:48:26','2026-04-28 05:48:05','2026-04-28 05:48:26'),(103,1,1236,NULL,'call_1_1236_1777366109','ended',-2,'2026-04-28 05:48:36','2026-04-28 05:48:37','2026-04-28 05:48:29','2026-04-28 05:48:37'),(104,1,1236,NULL,'call_1_1236_1777366120','ended',-2,'2026-04-28 05:48:44','2026-04-28 05:48:45','2026-04-28 05:48:40','2026-04-28 05:48:45'),(105,1,1236,NULL,'call_1_1236_1777366188','missed',-15,'2026-04-28 05:49:48','2026-04-28 05:50:03','2026-04-28 05:49:48','2026-04-28 05:50:03'),(106,1,1236,NULL,'call_1_1236_1777366206','missed',-9,'2026-04-28 05:50:06','2026-04-28 05:50:15','2026-04-28 05:50:06','2026-04-28 05:50:15'),(107,1,1236,NULL,'call_1_1236_1777366434','missed',-22,'2026-04-28 05:53:54','2026-04-28 05:54:15','2026-04-28 05:53:54','2026-04-28 05:54:15'),(108,1236,1,NULL,'call_1_1236_1777366448','declined',-7,'2026-04-28 05:54:08','2026-04-28 05:54:15','2026-04-28 05:54:08','2026-04-28 05:54:15'),(109,1,1236,NULL,'call_1_1236_1777366458','declined',-10,'2026-04-28 05:54:18','2026-04-28 05:54:28','2026-04-28 05:54:18','2026-04-28 05:54:28'),(110,1,1236,NULL,'call_1_1236_1777366490','missed',-17,'2026-04-28 05:54:50','2026-04-28 05:55:06','2026-04-28 05:54:50','2026-04-28 05:55:06'),(111,1236,1,NULL,'call_1_1236_1777366509','declined',-9,'2026-04-28 05:55:09','2026-04-28 05:55:17','2026-04-28 05:55:09','2026-04-28 05:55:17'),(112,1236,1,NULL,'call_1_1236_1777366519','declined',-6,'2026-04-28 05:55:19','2026-04-28 05:55:24','2026-04-28 05:55:19','2026-04-28 05:55:24'),(113,1236,1,NULL,'call_1_1236_1777366563','declined',-3,'2026-04-28 05:56:03','2026-04-28 05:56:06','2026-04-28 05:56:03','2026-04-28 05:56:06'),(114,1,1236,NULL,'call_1_1236_1777366640','declined',-15,'2026-04-28 05:57:20','2026-04-28 05:57:35','2026-04-28 05:57:20','2026-04-28 05:57:35'),(115,1236,1,NULL,'call_1_1236_1777366659','declined',-6,'2026-04-28 05:57:39','2026-04-28 05:57:44','2026-04-28 05:57:39','2026-04-28 05:57:44'),(116,1236,1,NULL,'call_1_1236_1777366667','declined',-5,'2026-04-28 05:57:47','2026-04-28 05:57:52','2026-04-28 05:57:47','2026-04-28 05:57:52'),(117,1,1236,NULL,'call_1_1236_1777366802','ended',-1,'2026-04-28 06:00:05','2026-04-28 06:00:06','2026-04-28 06:00:02','2026-04-28 06:00:06'),(118,1,1236,NULL,'call_1_1236_1777371278','missed',-14,'2026-04-28 07:14:38','2026-04-28 07:14:52','2026-04-28 07:14:38','2026-04-28 07:14:52'),(119,1,1236,NULL,'call_1_1236_1777371297','declined',0,'2026-04-28 07:14:57','2026-04-28 07:15:02','2026-04-28 07:14:57','2026-04-28 07:15:02'),(120,1,1236,NULL,'call_1_1236_1777371308','ended',-8,'2026-04-28 07:15:12','2026-04-28 07:15:19','2026-04-28 07:15:08','2026-04-28 07:15:19'),(121,1,1236,NULL,'call_1_1236_1777371324','ended',-5,'2026-04-28 07:15:28','2026-04-28 07:15:33','2026-04-28 07:15:24','2026-04-28 07:15:33'),(122,1236,1,NULL,'call_1_1236_1777909994','missed',-14,'2026-05-04 12:53:14','2026-05-04 12:53:28','2026-05-04 12:53:14','2026-05-04 12:53:28');
/*!40000 ALTER TABLE `call_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `can_contact_freelancers`
--

DROP TABLE IF EXISTS `can_contact_freelancers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `can_contact_freelancers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `can_contact_freelancer` int(11) NOT NULL DEFAULT 0 COMMENT '0:no, 1:yes',
  `show_contact_me_before_login` int(11) NOT NULL DEFAULT 0 COMMENT '0:no, 1:yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `can_contact_freelancers`
--

LOCK TABLES `can_contact_freelancers` WRITE;
/*!40000 ALTER TABLE `can_contact_freelancers` DISABLE KEYS */;
INSERT INTO `can_contact_freelancers` VALUES (1,1,0,'2026-04-02 12:11:04','2026-04-02 12:11:04');
/*!40000 ALTER TABLE `can_contact_freelancers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  `short_description` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=inactive 1=active',
  `selected_category` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Design and Creative','This category describes design and creatives','design-and-creative','This category describes design and creatives','This category describes design and creatives',0,NULL,'254','2023-02-06 05:36:19','2026-04-02 09:51:37'),(2,'Website Development','This category describes website development','website-development',NULL,NULL,0,NULL,'256','2023-02-06 05:48:16','2026-04-02 09:51:32'),(3,'Customer Service','This category describes customer service','customer-service',NULL,NULL,0,NULL,'255','2023-02-06 05:48:36','2026-04-02 09:51:27'),(4,'Mobile App Development','This category describes mobile app development','mobile-app-development',NULL,NULL,0,NULL,'257','2023-02-06 05:48:45','2026-04-02 09:51:23'),(5,'Education & Teachings','This category describes Education','education',NULL,NULL,0,NULL,'254','2023-02-06 05:49:25','2026-04-02 09:51:19'),(9,'Research','This category describes research','research',NULL,NULL,0,NULL,'256','2023-02-07 00:27:03','2026-04-02 09:51:15'),(11,'Tesisatçı','Tesisatçı Kategorisi','tesisatçı','tesisatçı','tesisatçı',1,NULL,NULL,'2023-02-07 00:57:08','2026-05-04 13:50:17'),(13,'Çilingir','Çilingir kategorisi','çilingir','çilingir','çilingir',1,NULL,NULL,'2023-02-07 00:58:39','2026-05-04 13:50:50'),(23,'Elektrikçi','Elektrikçi','elektrikçi','Elektrikçi','Elektrikçi',1,NULL,NULL,'2026-04-15 06:40:27','2026-04-15 06:40:27'),(24,'Boya & Badana','Boya & Badana','boya-&amp;-badana','Boya & Badana','Boya & Badana',1,NULL,NULL,'2026-04-15 06:40:48','2026-04-15 06:40:48'),(25,'Temizlik Hizmetleri','Temizlik Hizmetleri','temizlik-hizmetleri','Temizlik Hizmetleri','Temizlik Hizmetleri',1,NULL,NULL,'2026-04-15 06:41:01','2026-04-15 06:41:01'),(26,'Klima & Beyaz Eşya Servisi','Klima & Beyaz Eşya Servisi','klima-&amp;-beyaz-eşya-servisi','Klima & Beyaz Eşya Servisi','Klima & Beyaz Eşya Servisi',1,NULL,NULL,'2026-04-15 06:41:23','2026-04-15 06:41:23'),(27,'Mobilya & Montaj','Mobilya & Montaj','mobilya-&amp;-montaj','Mobilya & Montaj','Mobilya & Montaj',1,NULL,NULL,'2026-04-15 06:41:36','2026-04-15 06:41:36'),(28,'Nakliye & Taşıma','Nakliye & Taşıma','nakliye-&amp;-taşıma','Nakliye & Taşıma','Nakliye & Taşıma',1,NULL,NULL,'2026-04-15 06:41:50','2026-04-15 06:41:50'),(29,'İlaçlama','İlaçlama','i̇laçlama','İlaçlama','İlaçlama',1,NULL,NULL,'2026-04-15 06:42:01','2026-04-15 06:42:01'),(30,'Genel Tadilat & Usta','Genel Tadilat & Usta','genel-tadilat-&amp;-usta','Genel Tadilat & Usta','Genel Tadilat & Usta',1,NULL,NULL,'2026-04-15 06:42:17','2026-04-15 06:42:17'),(31,'Lastikçi','Lastikçi','lastikçi','Lastikçi','Lastikçi',1,NULL,NULL,'2026-05-04 12:06:57','2026-05-04 12:07:11'),(32,'Kombi Servisi','Kombi Servisi','kombi-servisi','Kombi Servisi','Kombi Servisi',1,NULL,NULL,'2026-05-04 12:08:05','2026-05-04 12:08:05'),(33,'Yol Yardım','Yol Yardım','yol-yardım','Yol Yardım','Yol Yardım',1,NULL,NULL,'2026-05-04 12:09:39','2026-05-04 12:22:30'),(34,'Kuru Temizleme','Kuru Temizleme','kuru-temizleme','Kuru Temizleme','Kuru Temizleme',1,NULL,NULL,'2026-05-04 12:26:39','2026-05-04 12:26:39'),(35,'Oto Yıkama','Oto Yıkama','oto-yıkama','Oto Yıkama','Oto Yıkama',1,NULL,NULL,'2026-05-04 12:31:14','2026-05-04 12:31:14');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat_messages`
--

DROP TABLE IF EXISTS `chat_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chat_messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ticket_id` bigint(20) NOT NULL,
  `message` longtext DEFAULT NULL,
  `notify` varchar(255) DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL COMMENT 'admin, client, freelancer',
  `sender_id` bigint(20) unsigned DEFAULT NULL COMMENT 'ID of the sender (admin, client, freelancer)',
  `load_from` int(11) NOT NULL DEFAULT 0,
  `is_synced` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat_messages`
--

LOCK TABLES `chat_messages` WRITE;
/*!40000 ALTER TABLE `chat_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `chat_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cities` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `country_id` int(11) DEFAULT NULL,
  `state_id` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=inactive 1=active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cities`
--

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` VALUES (22,15,26,'Nilüfer',1,'2026-04-21 14:21:21','2026-04-21 14:21:21'),(23,15,26,'Osmangazi',1,'2026-04-21 14:21:21','2026-04-21 14:21:21');
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client_notifications`
--

DROP TABLE IF EXISTS `client_notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `client_notifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `identity` bigint(20) NOT NULL,
  `client_id` bigint(20) NOT NULL,
  `type` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `is_read` varchar(255) NOT NULL DEFAULT 'unread',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client_notifications`
--

LOCK TABLES `client_notifications` WRITE;
/*!40000 ALTER TABLE `client_notifications` DISABLE KEYS */;
INSERT INTO `client_notifications` VALUES (1,1,1,'Offer','Yeni bir teklifiniz var','read','2026-04-02 12:55:10','2026-04-02 12:58:00'),(2,5,1,'Order','Order cancel','read','2026-04-02 15:02:07','2026-04-02 15:10:40'),(3,12,1,'Order','Order cancel','read','2026-04-02 17:22:35','2026-04-05 11:42:25'),(4,15,1,'Order','Order cancel','read','2026-04-05 11:45:18','2026-04-05 12:21:39'),(5,16,1,'Order','Order cancel','read','2026-04-05 11:49:11','2026-04-05 12:21:39'),(6,17,1,'Order','Order accepted by freelancer','read','2026-04-05 12:04:40','2026-04-05 12:21:39'),(7,17,1,'Order','Your order has been submitted. Please check it.','read','2026-04-05 12:15:49','2026-04-05 12:21:39'),(8,18,1,'Order','Order accepted by freelancer','read','2026-04-05 12:26:09','2026-04-05 12:26:41'),(9,18,1,'Order','Your order has been submitted. Please check it.','read','2026-04-05 12:26:22','2026-04-05 12:26:41'),(10,18,1,'Order','Your order has been submitted. Please check it.','read','2026-04-05 12:34:27','2026-04-05 12:36:33'),(11,2,1,'Offer','Yeni bir teklifiniz var','read','2026-04-05 14:12:23','2026-04-05 14:14:27'),(12,19,1,'Order','Order cancel','read','2026-04-05 15:07:48','2026-04-05 15:10:37'),(13,20,1,'Order','Sipariş iptali','read','2026-04-05 19:43:07','2026-04-05 19:44:05'),(14,21,1,'Order','Siparişiniz gönderildi. Lütfen kontrol edin.','read','2026-04-05 19:50:57','2026-04-05 19:58:25'),(15,21,1,'Order','Siparişiniz gönderildi. Lütfen kontrol edin.','read','2026-04-05 19:53:57','2026-04-05 19:58:25'),(16,3,1,'Offer','Yeni bir teklifiniz var','read','2026-04-06 06:12:10','2026-04-06 06:36:45'),(17,4,1,'Offer','Yeni bir teklifiniz var','read','2026-04-06 06:54:14','2026-04-06 12:16:56'),(18,5,1,'Offer','Yeni bir teklifiniz var','read','2026-04-06 15:11:49','2026-04-06 15:23:38'),(19,6,1,'Offer','Yeni bir teklifiniz var','read','2026-04-06 15:22:55','2026-04-06 15:23:38'),(20,25,1,'Order','Order accepted by freelancer','read','2026-04-06 15:23:53','2026-04-06 15:24:08'),(21,25,1,'Order','Order cancel','read','2026-04-06 15:24:02','2026-04-06 15:24:08'),(22,7,1,'Offer','Yeni bir teklifiniz var','read','2026-04-06 15:31:41','2026-04-06 15:42:38'),(23,26,1,'Order','Order accepted by freelancer','read','2026-04-06 15:32:52','2026-04-06 15:42:38'),(24,26,1,'Order','Your order has been submitted. Please check it.','read','2026-04-06 15:33:11','2026-04-06 15:42:38'),(25,1237,1237,'Identity Verify','Your Identity Verify Confirm','read','2026-04-16 12:11:15','2026-04-16 12:18:55'),(26,1237,1237,'Email Verify','Your email address successfully verified.','read','2026-04-16 12:12:47','2026-04-16 12:18:55'),(27,30,1237,'Order','Siparişiniz gönderildi. Lütfen kontrol edin.','read','2026-04-16 12:45:48','2026-04-16 12:45:52'),(28,30,1237,'Order','Siparişiniz gönderildi. Lütfen kontrol edin.','unread','2026-04-16 12:48:26','2026-04-16 12:48:26'),(29,8,1,'Offer','Yeni bir teklifiniz var','read','2026-04-16 13:14:05','2026-04-20 17:47:29'),(30,9,1,'Offer','Yeni bir teklifiniz var','read','2026-04-22 14:32:13','2026-04-22 15:06:57'),(31,10,1,'Offer','Yeni bir teklifiniz var','read','2026-04-22 15:26:12','2026-04-22 15:42:38'),(32,38,1,'Order','Sipariş iptali','read','2026-04-22 15:27:40','2026-04-22 15:42:38'),(33,11,1,'Offer','Yeni bir teklifiniz var','read','2026-04-22 15:58:45','2026-04-22 15:59:52'),(34,12,1,'Offer','Yeni bir teklifiniz var','read','2026-04-22 17:18:46','2026-04-22 17:19:13'),(35,13,1,'Offer','Yeni bir teklifiniz var','read','2026-04-22 17:24:15','2026-04-22 17:32:06'),(36,14,1,'Offer','Yeni bir teklifiniz var','read','2026-04-22 17:59:56','2026-04-22 18:01:53'),(37,39,1,'Order','Sipariş iptali','read','2026-04-22 18:05:36','2026-04-23 17:35:41'),(38,99999,1236,'Order','Sipariş reddi test bildirimi','read','2026-04-22 18:06:23','2026-04-25 08:07:49'),(39,40,1,'Order','Sipariş iptali','read','2026-04-22 18:11:08','2026-04-23 17:35:41'),(40,53,1,'Order','Sipariş iptali','read','2026-04-23 19:06:33','2026-04-23 19:38:07'),(41,55,1,'Order','Sipariş iptali','read','2026-04-23 19:06:53','2026-04-23 19:38:07'),(42,54,1,'Order','Sipariş iptali','read','2026-04-23 19:07:02','2026-04-23 19:38:07'),(43,68,1,'Order','Sipariş iptali','read','2026-04-25 07:59:41','2026-04-25 08:08:33'),(44,71,1,'Order','Sipariş iptali','read','2026-04-25 13:12:27','2026-04-25 14:19:05'),(45,70,1,'Order','Sipariş iptali','read','2026-04-25 13:12:51','2026-04-25 14:19:05'),(46,69,1,'Order','Sipariş iptali','read','2026-04-25 13:13:01','2026-04-25 14:19:05'),(47,6,1,'Deposit','Wallet successfully deposited','read','2026-04-25 14:58:34','2026-04-25 16:24:16'),(48,0,1,'Deposit','Your wallet has been credited by admin. Amount: 2000 - test','read','2026-04-25 15:28:53','2026-04-25 16:24:16'),(49,9,1,'Deposit','Deposit request rejected','read','2026-04-25 15:31:09','2026-04-25 16:24:16'),(50,15,1,'Offer','Yeni bir teklifiniz var','read','2026-04-25 16:44:22','2026-04-25 17:11:23'),(51,72,1,'Order','Siparişiniz gönderildi. Lütfen kontrol edin.','read','2026-04-25 16:49:33','2026-04-25 17:11:23'),(52,32,1,'Order','Sipariş iptali','read','2026-04-26 14:28:57','2026-04-26 14:41:47'),(53,73,1236,'Order','Sipariş iptali','read','2026-04-27 09:16:54','2026-04-28 04:26:37'),(54,74,1,'Order','Siparişiniz gönderildi. Lütfen kontrol edin.','read','2026-04-28 05:51:57','2026-04-28 07:43:31'),(55,75,1,'Order','Sipariş iptali','read','2026-04-28 08:35:34','2026-04-28 09:01:36'),(56,78,1,'Order','Sipariş iptali','read','2026-05-04 12:45:35','2026-05-04 14:37:53');
/*!40000 ALTER TABLE `client_notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `countries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `country` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=inactive 1=active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (15,'Türkiye',1,'2026-03-25 17:25:50','2026-03-25 17:25:50');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=inactive,1=active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES (1,'Order Management',0,'2023-08-27 01:44:10','2023-08-27 03:42:50'),(2,'Project Management',1,'2023-08-27 01:49:45','2023-08-27 03:44:07'),(3,'Account Management',1,'2023-08-27 01:50:59','2023-08-27 01:50:59'),(7,'Payment Management',1,'2023-08-27 03:44:23','2023-08-27 03:44:23');
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `experience_levels`
--

DROP TABLE IF EXISTS `experience_levels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `experience_levels` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `level` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `experience_levels`
--

LOCK TABLES `experience_levels` WRITE;
/*!40000 ALTER TABLE `experience_levels` DISABLE KEYS */;
/*!40000 ALTER TABLE `experience_levels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `feedback` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `rating` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=active 1=inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback`
--

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_builders`
--

DROP TABLE IF EXISTS `form_builders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `form_builders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `button_text` varchar(255) DEFAULT NULL,
  `fields` longtext DEFAULT NULL,
  `success_message` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_builders`
--

LOCK TABLES `form_builders` WRITE;
/*!40000 ALTER TABLE `form_builders` DISABLE KEYS */;
INSERT INTO `form_builders` VALUES (1,'Contact Form','rakibxgenious@gmail.com','Submit','{\"success_message\":\"Your Message Successfully Send.\",\"field_type\":[\"text\",\"email\",\"tel\",\"textarea\"],\"field_name\":[\"your-name\",\"your-email\",\"your-phone\",\"your-message\"],\"field_placeholder\":[\"Your Name\",\"Your Email\",\"Your Phone\",\"Your Message\"],\"field_required\":[\"on\",\"on\"]}','Your Message Successfully Send.','2022-12-29 04:52:45','2026-01-19 08:37:43'),(6,'Test Form','test@filancer.com','Test','{\"success_message\":\"Test\",\"field_type\":[\"text\"],\"field_name\":[\"your-name\"],\"field_placeholder\":[\"Your Name\"]}','Test','2022-12-29 05:53:05','2023-01-01 06:46:56');
/*!40000 ALTER TABLE `form_builders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `freelancer_level_rules`
--

DROP TABLE IF EXISTS `freelancer_level_rules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `freelancer_level_rules` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `freelancer_level_id` bigint(20) NOT NULL,
  `period` int(11) NOT NULL,
  `avg_rating` double NOT NULL,
  `earning` double NOT NULL,
  `complete_order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `freelancer_level_rules`
--

LOCK TABLES `freelancer_level_rules` WRITE;
/*!40000 ALTER TABLE `freelancer_level_rules` DISABLE KEYS */;
INSERT INTO `freelancer_level_rules` VALUES (1,3,3,4.5,10,1,'2024-01-04 06:43:07','2024-01-04 06:43:07'),(2,2,9,4.8,10,1,'2024-01-04 06:43:37','2024-06-04 08:35:56'),(3,1,12,4,10,1,'2024-06-04 08:37:48','2024-06-04 08:37:48');
/*!40000 ALTER TABLE `freelancer_level_rules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `freelancer_levels`
--

DROP TABLE IF EXISTS `freelancer_levels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `freelancer_levels` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `level` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=inactive 1=active',
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `freelancer_levels`
--

LOCK TABLES `freelancer_levels` WRITE;
/*!40000 ALTER TABLE `freelancer_levels` DISABLE KEYS */;
INSERT INTO `freelancer_levels` VALUES (1,'Rated Plus',1,'253','2024-01-04 06:41:18','2025-03-24 02:38:42'),(2,'Top Rated',1,'244','2024-01-04 06:41:53','2025-03-24 02:38:31'),(3,'Rising Talent',1,'248','2024-01-04 06:42:17','2025-03-24 02:38:14');
/*!40000 ALTER TABLE `freelancer_levels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `freelancer_notifications`
--

DROP TABLE IF EXISTS `freelancer_notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `freelancer_notifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `identity` bigint(20) NOT NULL,
  `freelancer_id` bigint(20) NOT NULL,
  `type` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `is_read` varchar(255) NOT NULL DEFAULT 'unread',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `freelancer_notifications`
--

LOCK TABLES `freelancer_notifications` WRITE;
/*!40000 ALTER TABLE `freelancer_notifications` DISABLE KEYS */;
INSERT INTO `freelancer_notifications` VALUES (1,1236,1236,'Identity Verify','Your Identity Verify Confirm','read','2026-03-27 16:44:24','2026-04-05 18:02:05'),(2,5,1236,'Order','You have a new order','read','2026-04-02 09:43:34','2026-04-05 18:02:05'),(3,12,1236,'Order','Yeni bir siparişiniz var','read','2026-04-02 17:16:01','2026-04-05 18:02:05'),(4,15,1236,'Order','Yeni bir siparişiniz var','read','2026-04-02 17:24:57','2026-04-05 18:02:05'),(5,16,1236,'Order','You have a new order','read','2026-04-05 11:48:34','2026-04-05 18:02:05'),(6,17,1236,'Order','You have a new order','read','2026-04-05 12:03:54','2026-04-05 18:02:05'),(7,17,1236,'Order','Sipariş müşteri tarafından kabul edildi','read','2026-04-05 12:16:51','2026-04-05 18:02:05'),(8,18,1236,'Order','You have a new order','read','2026-04-05 12:22:39','2026-04-05 18:02:05'),(9,18,1236,'Order','Request for revision','read','2026-04-05 12:33:59','2026-04-05 18:02:05'),(10,18,1236,'Order','Sipariş müşteri tarafından kabul edildi','read','2026-04-05 12:36:56','2026-04-05 18:02:05'),(11,19,1236,'Order','You have a new order','read','2026-04-05 15:06:59','2026-04-05 18:02:05'),(12,1,1236,'Withdraw','Para çekme talebi durumunuz şuna değiştirildi: tamamla','read','2026-04-05 17:05:46','2026-04-05 18:02:05'),(13,20,1236,'Order','Yeni sipariş verildi','read','2026-04-05 18:56:37','2026-04-05 19:04:10'),(14,21,1236,'Order','Yeni sipariş verildi','read','2026-04-05 19:44:31','2026-04-05 19:44:46'),(15,21,1236,'Order','Request for revision','read','2026-04-05 19:53:33','2026-04-06 06:00:46'),(16,21,1236,'Order','Sipariş müşteri tarafından kabul edildi','read','2026-04-05 19:54:20','2026-04-06 06:00:46'),(17,25,1236,'Order','You have a new order','read','2026-04-06 15:23:24','2026-04-06 15:25:51'),(18,26,1236,'Order','You have a new order','read','2026-04-06 15:32:16','2026-04-06 18:18:59'),(19,26,1236,'Order','Sipariş müşteri tarafından kabul edildi','read','2026-04-06 15:33:36','2026-04-06 18:18:59'),(20,1237,1237,'Email Verify','Your email address successfully verified.','unread','2026-04-16 12:12:47','2026-04-16 12:12:47'),(21,30,1,'Order','You have a new order','read','2026-04-16 12:43:55','2026-04-16 12:44:25'),(22,30,1,'Order','Request for revision','read','2026-04-16 12:46:25','2026-04-21 15:40:15'),(23,30,1,'Order','Sipariş müşteri tarafından kabul edildi','read','2026-04-16 12:48:49','2026-04-21 15:40:15'),(24,32,1,'Order','You have a new order','read','2026-04-21 17:32:43','2026-04-24 06:54:59'),(25,38,1236,'Order','You have a new order','read','2026-04-22 15:26:50','2026-04-22 15:55:36'),(26,39,1236,'Order','You have a new order','read','2026-04-22 18:01:36','2026-04-22 18:02:11'),(27,99999,1236,'Order','Yeni sipariş test bildirimi','read','2026-04-22 18:06:22','2026-04-22 18:07:07'),(28,40,1236,'Order','You have a new order','read','2026-04-22 18:10:02','2026-04-23 19:06:16'),(29,53,1236,'Order','Yeni bir siparişiniz var','read','2026-04-23 17:54:13','2026-04-23 19:06:16'),(30,55,1236,'Order','Yeni bir siparişiniz var','read','2026-04-23 18:04:54','2026-04-23 19:06:16'),(31,67,1236,'Order','Yeni bir siparişiniz var','read','2026-04-24 15:00:11','2026-04-25 08:00:45'),(32,68,1236,'Order','Yeni bir siparişiniz var','read','2026-04-25 06:07:53','2026-04-25 08:00:45'),(33,69,1236,'Order','Yeni bir siparişiniz var','read','2026-04-25 12:59:21','2026-04-25 14:18:05'),(34,70,1236,'Order','Yeni bir siparişiniz var','read','2026-04-25 13:04:05','2026-04-25 14:18:05'),(35,71,1236,'Order','Yeni bir siparişiniz var','read','2026-04-25 13:11:34','2026-04-25 14:18:05'),(36,3,1,'Withdraw','Para çekme talebi durumunuz şuna değiştirildi: tamamla','read','2026-04-25 15:13:31','2026-04-25 16:22:29'),(37,4,1,'Withdraw','Para çekme talebi durumunuz şuna değiştirildi: tamamla','read','2026-04-25 15:22:45','2026-04-25 16:22:29'),(38,5,1,'Withdraw','Para çekme talebi durumunuz şuna değiştirildi: iptal','read','2026-04-25 15:32:04','2026-04-25 16:22:29'),(39,72,1236,'Order','Yeni bir siparişiniz var','read','2026-04-25 16:45:28','2026-04-25 17:57:23'),(40,72,1236,'Order','Sipariş müşteri tarafından kabul edildi','read','2026-04-25 16:51:19','2026-04-25 17:57:23'),(41,73,1,'Order','Yeni bir siparişiniz var','read','2026-04-26 14:52:09','2026-04-27 09:26:52'),(42,74,1236,'Order','Yeni bir siparişiniz var','read','2026-04-28 05:51:26','2026-04-28 05:53:47'),(43,74,1236,'Order','Sipariş müşteri tarafından kabul edildi','read','2026-04-28 05:52:11','2026-04-28 05:53:47'),(44,75,1236,'Order','Yeni bir siparişiniz var','read','2026-04-28 08:35:03','2026-05-04 11:58:42'),(45,76,1236,'Order','Yeni bir siparişiniz var','read','2026-05-04 12:43:45','2026-05-06 14:56:59'),(46,77,1236,'Order','Yeni bir siparişiniz var','read','2026-05-04 12:44:29','2026-05-06 14:56:59'),(47,78,1236,'Order','Yeni bir siparişiniz var','read','2026-05-04 12:45:18','2026-05-06 14:56:59');
/*!40000 ALTER TABLE `freelancer_notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `identity_verifications`
--

DROP TABLE IF EXISTS `identity_verifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `identity_verifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `verify_by` varchar(255) NOT NULL,
  `country_id` bigint(20) NOT NULL,
  `state_id` bigint(20) NOT NULL,
  `city_id` bigint(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `national_id_number` varchar(255) NOT NULL,
  `front_image` varchar(255) NOT NULL,
  `back_image` varchar(255) NOT NULL,
  `status` tinyint(4) DEFAULT NULL COMMENT '1=verified, 2=rejected',
  `is_read` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1=read and 0=unread',
  `load_from` int(11) NOT NULL DEFAULT 0,
  `is_synced` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `identity_verifications`
--

LOCK TABLES `identity_verifications` WRITE;
/*!40000 ALTER TABLE `identity_verifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `identity_verifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `individual_commission_settings`
--

DROP TABLE IF EXISTS `individual_commission_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `individual_commission_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `admin_commission_type` varchar(255) DEFAULT NULL,
  `admin_commission_charge` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `individual_commission_settings`
--

LOCK TABLES `individual_commission_settings` WRITE;
/*!40000 ALTER TABLE `individual_commission_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `individual_commission_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_histories`
--

DROP TABLE IF EXISTS `job_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_histories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `job_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `reject_count` bigint(20) DEFAULT NULL,
  `edit_count` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_histories`
--

LOCK TABLES `job_histories` WRITE;
/*!40000 ALTER TABLE `job_histories` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_post_skills`
--

DROP TABLE IF EXISTS `job_post_skills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_post_skills` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `job_post_id` bigint(20) NOT NULL,
  `skill_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `job_post_skills_job_post_id_skill_id_index` (`job_post_id`,`skill_id`)
) ENGINE=InnoDB AUTO_INCREMENT=222 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_post_skills`
--

LOCK TABLES `job_post_skills` WRITE;
/*!40000 ALTER TABLE `job_post_skills` DISABLE KEYS */;
INSERT INTO `job_post_skills` VALUES (208,99,3,'2025-10-25 21:57:14','2025-10-25 21:57:14'),(209,100,6,'2025-11-02 03:46:38','2025-11-02 03:46:38'),(210,101,7,'2025-11-02 03:49:51','2025-11-02 03:49:51'),(211,102,1,'2026-01-04 11:19:36','2026-01-04 11:19:36'),(212,103,2,'2026-01-20 09:10:36','2026-01-20 09:10:36'),(213,103,4,'2026-01-20 09:10:36','2026-01-20 09:10:36'),(214,104,4,'2026-01-20 11:09:05','2026-01-20 11:09:05'),(215,105,2,'2026-01-20 11:10:05','2026-01-20 11:10:05'),(216,106,28,'2026-01-20 17:41:26','2026-01-20 17:41:26'),(217,106,29,'2026-01-20 17:41:26','2026-01-20 17:41:26'),(218,106,32,'2026-01-20 17:41:26','2026-01-20 17:41:26'),(219,106,33,'2026-01-20 17:41:26','2026-01-20 17:41:26'),(220,107,1,'2026-01-21 13:20:17','2026-01-21 13:20:17'),(221,108,1,'2026-01-21 13:20:40','2026-01-21 13:20:40');
/*!40000 ALTER TABLE `job_post_skills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_post_sub_categories`
--

DROP TABLE IF EXISTS `job_post_sub_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_post_sub_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `job_post_id` bigint(20) NOT NULL,
  `sub_category_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `job_post_sub_categories_job_post_id_sub_category_id_index` (`job_post_id`,`sub_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_post_sub_categories`
--

LOCK TABLES `job_post_sub_categories` WRITE;
/*!40000 ALTER TABLE `job_post_sub_categories` DISABLE KEYS */;
INSERT INTO `job_post_sub_categories` VALUES (140,99,6,'2025-10-25 21:57:14','2025-10-25 21:57:14'),(141,100,21,'2025-11-02 03:46:38','2025-11-02 03:46:38'),(142,101,6,'2025-11-02 03:49:51','2025-11-02 03:49:51'),(143,102,5,'2026-01-04 11:19:36','2026-01-04 11:19:36'),(144,103,20,'2026-01-20 09:10:36','2026-01-20 09:10:36'),(145,104,20,'2026-01-20 11:09:05','2026-01-20 11:09:05'),(146,105,22,'2026-01-20 11:10:05','2026-01-20 11:10:05'),(147,106,1,'2026-01-20 17:41:26','2026-01-20 17:41:26'),(148,106,2,'2026-01-20 17:41:26','2026-01-20 17:41:26'),(149,107,2,'2026-01-21 13:20:17','2026-01-21 13:20:17'),(150,108,2,'2026-01-21 13:20:40','2026-01-21 13:20:40');
/*!40000 ALTER TABLE `job_post_sub_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_posts`
--

DROP TABLE IF EXISTS `job_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category` bigint(20) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `country_restriction_type` enum('none','include','exclude') NOT NULL DEFAULT 'none',
  `allowed_countries` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`allowed_countries`)),
  `excluded_countries` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`excluded_countries`)),
  `description` longtext NOT NULL,
  `type` varchar(255) NOT NULL,
  `hourly_rate` int(11) DEFAULT NULL,
  `estimated_hours` int(11) DEFAULT NULL,
  `budget` double NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=pending/inactivate, 1=approve/publish',
  `current_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=nothing, 1=in progress, 2=complete, 3=cancel',
  `on_off` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=on, 0=off',
  `job_approve_request` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=request for approve, 1=approve, 2=decline, 2=will change to 0 when the user edit the project.',
  `last_seen` timestamp NULL DEFAULT NULL,
  `last_apply_date` timestamp NULL DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_tags` text DEFAULT NULL,
  `load_from` int(11) NOT NULL DEFAULT 0,
  `is_synced` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_urgent` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `job_posts_category_index` (`category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_posts`
--

LOCK TABLES `job_posts` WRITE;
/*!40000 ALTER TABLE `job_posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_proposals`
--

DROP TABLE IF EXISTS `job_proposals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_proposals` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `job_id` bigint(20) NOT NULL,
  `freelancer_id` bigint(20) NOT NULL,
  `client_id` bigint(20) NOT NULL,
  `amount` double NOT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `conversion_rate` double DEFAULT NULL,
  `symbol` varchar(255) DEFAULT NULL,
  `duration` varchar(255) NOT NULL,
  `revision` int(11) NOT NULL DEFAULT 0,
  `cover_letter` text NOT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=pending, 1=accept, 2=reject',
  `is_hired` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=no, 1=yes',
  `is_short_listed` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=no, 1=yes',
  `is_interview_take` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=no, 1=yes',
  `is_view` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=no, 1=yes',
  `is_rejected` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=no, 1=yes',
  `load_from` int(11) NOT NULL DEFAULT 0,
  `is_synced` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_proposals`
--

LOCK TABLES `job_proposals` WRITE;
/*!40000 ALTER TABLE `job_proposals` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_proposals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_skills`
--

DROP TABLE IF EXISTS `job_skills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_skills` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `job_post_id` bigint(20) NOT NULL,
  `skill_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `job_skills_job_post_id_skill_id_index` (`job_post_id`,`skill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_skills`
--

LOCK TABLES `job_skills` WRITE;
/*!40000 ALTER TABLE `job_skills` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_skills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `languages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `direction` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `default` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `languages`
--

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
INSERT INTO `languages` VALUES (1,'English (UK)','en_GB','ltr','draft',0,'2023-05-07 04:56:35','2026-04-05 17:40:54'),(3,'Беларуская мова','bel','ltr','draft',0,'2026-01-20 09:05:25','2026-04-05 17:41:01'),(4,'العربية','ar','rtl','draft',0,'2026-01-22 02:36:22','2026-04-05 17:41:08'),(5,'Türkçe','tr_TR','ltr','publish',1,'2026-03-25 17:20:12','2026-03-25 17:29:35');
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lengths`
--

DROP TABLE IF EXISTS `lengths`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lengths` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `length` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lengths`
--

LOCK TABLES `lengths` WRITE;
/*!40000 ALTER TABLE `lengths` DISABLE KEYS */;
INSERT INTO `lengths` VALUES (12,'1 Gün',1,'2026-04-24 08:06:20','2026-04-24 08:06:20'),(13,'3 Gün',1,'2026-04-24 08:06:35','2026-04-24 08:06:35'),(14,'5 Gün',1,'2026-04-24 08:06:40','2026-04-24 08:06:40'),(15,'1 Hafta',1,'2026-04-24 08:06:45','2026-04-24 08:06:45'),(16,'2 Hafta',1,'2026-04-24 08:06:52','2026-04-24 08:06:52'),(17,'3 Hafta',1,'2026-04-24 08:07:00','2026-04-24 08:07:00'),(18,'1 Ay',1,'2026-04-24 08:07:04','2026-04-24 08:07:04'),(19,'3 Ay',1,'2026-04-24 08:07:15','2026-04-24 08:07:15'),(20,'6 Ay',1,'2026-04-24 08:07:20','2026-04-24 08:07:20');
/*!40000 ALTER TABLE `lengths` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `live_chat_messages`
--

DROP TABLE IF EXISTS `live_chat_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `live_chat_messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `live_chat_id` bigint(20) unsigned NOT NULL,
  `from_user` int(11) NOT NULL COMMENT '1 = client, 2 = freelancer, 3 = admin',
  `message` longtext NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `is_seen` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=unseen, 1=seen',
  `load_from` int(11) NOT NULL DEFAULT 0,
  `is_synced` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `live_chat_messages_live_chat_id_foreign` (`live_chat_id`),
  CONSTRAINT `live_chat_messages_live_chat_id_foreign` FOREIGN KEY (`live_chat_id`) REFERENCES `live_chats` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=162 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `live_chat_messages`
--

LOCK TABLES `live_chat_messages` WRITE;
/*!40000 ALTER TABLE `live_chat_messages` DISABLE KEYS */;
INSERT INTO `live_chat_messages` VALUES (1,1,2,'{\"message\":null,\"project\":{\"id\":193,\"project_creator\":null,\"username\":\"ahmeteren1999\",\"title\":\"Her t\\u00fcrl\\u00fc kap\\u0131 a\\u00e7\\u0131l\\u0131r\",\"slug\":\"her-t\\u00fcrl\\u00fc-kap\\u0131-a\\u00e7\\u0131l\\u0131r\",\"image\":[\"1774644330-69c6ec6abbc4e.jpg\",\"1774644330-69c6ec6ad5129.jpg\",\"1774644330-69c6ec6ad7f9b.jpeg\"],\"type\":\"project\",\"interview_message\":\"\"}}','',1,0,0,'2026-04-02 10:17:19','2026-05-06 14:05:35'),(2,1,2,'{\"message\":\"Merhaba\",\"project\":null}','',1,0,0,'2026-04-02 10:17:22','2026-05-06 14:05:35'),(3,1,2,'{\"message\":\"Test\",\"project\":null}','',1,0,0,'2026-04-02 10:17:26','2026-05-06 14:05:35'),(4,1,1,'{\"message\":\"Merhabalar, nas\\u0131ls\\u0131n\\u0131z?\",\"project\":null}','',1,0,0,'2026-04-02 10:18:02','2026-04-24 15:34:30'),(5,1,2,'{\"message\":null,\"project\":{\"id\":193,\"project_creator\":null,\"username\":\"ahmeteren1999\",\"title\":\"Her t\\u00fcrl\\u00fc kap\\u0131 a\\u00e7\\u0131l\\u0131r\",\"slug\":\"her-t\\u00fcrl\\u00fc-kap\\u0131-a\\u00e7\\u0131l\\u0131r\",\"image\":[\"1774644330-69c6ec6abbc4e.jpg\",\"1774644330-69c6ec6ad5129.jpg\",\"1774644330-69c6ec6ad7f9b.jpeg\"],\"type\":\"project\",\"interview_message\":\"\"}}','',1,0,0,'2026-04-02 11:24:09','2026-05-06 14:05:35'),(6,1,1,'{\"message\":\"hey\",\"project\":null}','',1,0,0,'2026-04-02 12:05:50','2026-04-24 15:34:30'),(7,1,2,'{\"message\":null,\"project\":{\"id\":193,\"project_creator\":null,\"username\":\"ahmeteren1999\",\"title\":\"Her t\\u00fcrl\\u00fc kap\\u0131 a\\u00e7\\u0131l\\u0131r\",\"slug\":\"her-t\\u00fcrl\\u00fc-kap\\u0131-a\\u00e7\\u0131l\\u0131r\",\"image\":[\"1774644330-69c6ec6abbc4e.jpg\",\"1774644330-69c6ec6ad5129.jpg\",\"1774644330-69c6ec6ad7f9b.jpeg\"],\"type\":\"project\",\"interview_message\":\"\"}}','',1,0,0,'2026-04-02 12:54:32','2026-05-06 14:05:35'),(8,1,1,'{\"message\":\"Hey\",\"project\":null}','',1,0,0,'2026-04-05 14:15:50','2026-04-24 15:34:30'),(9,1,2,'{\"message\":\"Hi\",\"project\":null}','',1,0,0,'2026-04-05 14:29:16','2026-05-06 14:05:35'),(10,1,1,'{\"message\":\"Merhaba\",\"project\":null}','',1,0,0,'2026-04-05 14:30:01','2026-04-24 15:34:30'),(11,1,1,'{\"message\":\"Merhaba\",\"project\":null}','',1,0,0,'2026-04-05 14:30:14','2026-04-24 15:34:30'),(12,1,2,'{\"message\":\"test\",\"project\":null}','',1,0,0,'2026-04-05 14:38:42','2026-05-06 14:05:35'),(13,1,2,'{\"message\":\"test2\",\"project\":null}','',1,0,0,'2026-04-05 14:40:37','2026-05-06 14:05:35'),(14,1,2,'{\"message\":\"test3\",\"project\":null}','',1,0,0,'2026-04-05 14:49:13','2026-05-06 14:05:35'),(15,1,1,'{\"message\":\"test\",\"project\":null}','',1,0,0,'2026-04-05 14:59:49','2026-04-24 15:34:30'),(16,1,2,'{\"message\":\"Test\",\"project\":null}','',1,0,0,'2026-04-05 18:33:23','2026-05-06 14:05:35'),(17,1,2,'{\"message\":\"Hi\",\"project\":null}','',1,0,0,'2026-04-05 18:33:41','2026-05-06 14:05:35'),(18,1,1,'{\"message\":\"selam\",\"project\":null}','',1,0,0,'2026-04-05 18:35:06','2026-04-24 15:34:30'),(19,1,2,'{\"message\":\"hey\",\"project\":null}','',1,0,0,'2026-04-05 18:35:17','2026-05-06 14:05:35'),(20,1,2,'{\"message\":\"merhaba\",\"project\":null}','',1,0,0,'2026-04-06 18:07:40','2026-05-06 14:05:35'),(21,1,2,'{\"message\":\"hey\",\"project\":null}','',1,0,0,'2026-04-06 18:07:56','2026-05-06 14:05:35'),(22,1,1,'{\"message\":\"hi\",\"project\":null}','',1,0,0,'2026-04-06 18:08:13','2026-04-24 15:34:30'),(23,1,1,'{\"message\":\"test\",\"project\":null}','',1,0,0,'2026-04-06 18:08:59','2026-04-24 15:34:30'),(24,1,1,'{\"message\":\"hey\",\"project\":null}','',1,0,0,'2026-04-06 18:11:05','2026-04-24 15:34:30'),(25,1,2,'{\"message\":\"Test1\",\"project\":null}','',1,0,0,'2026-04-06 18:11:21','2026-05-06 14:05:35'),(26,1,2,'{\"message\":\"Test2\",\"project\":null}','',1,0,0,'2026-04-06 18:13:26','2026-05-06 14:05:35'),(27,1,1,'{\"message\":\"Merhaba\",\"project\":null}','',1,0,0,'2026-04-06 18:13:38','2026-04-24 15:34:30'),(28,1,2,'{\"message\":\"test3\",\"project\":null}','',1,0,0,'2026-04-06 18:14:21','2026-05-06 14:05:35'),(29,1,1,'{\"message\":\"Test\",\"project\":null}','',1,0,0,'2026-04-06 18:16:07','2026-04-24 15:34:30'),(30,1,1,'{\"message\":\"Test\",\"project\":null}','',1,0,0,'2026-04-06 18:16:51','2026-04-24 15:34:30'),(31,1,2,'{\"message\":\"Tets\",\"project\":null}','',1,0,0,'2026-04-06 18:17:49','2026-05-06 14:05:35'),(32,1,2,'{\"message\":\"Test4\",\"project\":null}','',1,0,0,'2026-04-06 18:18:41','2026-05-06 14:05:35'),(33,1,1,'{\"message\":\"Test5\",\"project\":null}','',1,0,0,'2026-04-06 18:19:26','2026-04-24 15:34:30'),(34,1,2,'{\"message\":\"Test6\",\"project\":null}','',1,0,0,'2026-04-06 18:19:38','2026-05-06 14:05:35'),(35,1,1,'{\"message\":\"Test7\",\"project\":null}','',1,0,0,'2026-04-06 18:27:29','2026-04-24 15:34:30'),(36,1,2,'{\"message\":\"test8\",\"project\":null}','',1,0,0,'2026-04-06 18:28:11','2026-05-06 14:05:35'),(37,1,1,'{\"message\":\"test9\",\"project\":null}','',1,0,0,'2026-04-06 18:28:20','2026-04-24 15:34:30'),(38,2,2,'{\"message\":\"test10\",\"project\":null}','',1,0,0,'2026-04-06 18:32:54','2026-04-25 17:14:53'),(39,2,2,'{\"message\":\"t\",\"project\":null}','',1,0,0,'2026-04-06 18:33:36','2026-04-25 17:14:53'),(40,1,1,'{\"message\":\"test\",\"project\":null}','',1,0,0,'2026-04-06 18:33:56','2026-04-24 15:34:30'),(41,2,2,'{\"message\":\"\\u0131\",\"project\":null}','',1,0,0,'2026-04-06 18:34:06','2026-04-25 17:14:53'),(42,1,1,'{\"message\":\"test\",\"project\":null}','',1,0,0,'2026-04-06 18:36:52','2026-04-24 15:34:30'),(43,2,2,'{\"message\":\"hey\",\"project\":null}','',1,0,0,'2026-04-06 18:38:40','2026-04-25 17:14:53'),(44,1,1,'{\"message\":\"hey\",\"project\":null}','',1,0,0,'2026-04-06 18:39:14','2026-04-24 15:34:30'),(45,1,1,'{\"message\":\"hi\",\"project\":null}','',1,0,0,'2026-04-06 18:39:20','2026-04-24 15:34:30'),(46,2,2,'{\"message\":\"yo\",\"project\":null}','',1,0,0,'2026-04-06 18:39:27','2026-04-25 17:14:53'),(47,2,2,'{\"message\":\"hey\",\"project\":null}','',1,0,0,'2026-04-06 18:43:08','2026-04-25 17:14:53'),(48,2,2,'{\"message\":\"test\",\"project\":null}','',1,0,0,'2026-04-06 18:46:24','2026-04-25 17:14:53'),(49,2,2,'{\"message\":\"hey\",\"project\":null}','',1,0,0,'2026-04-06 18:50:50','2026-04-25 17:14:53'),(50,2,2,'{\"message\":\"test\",\"project\":null}','',1,0,0,'2026-04-06 18:51:46','2026-04-25 17:14:53'),(51,2,2,'{\"message\":\"test\",\"project\":null}','',1,0,0,'2026-04-06 18:53:37','2026-04-25 17:14:53'),(52,2,2,'{\"message\":\"test\",\"project\":null}','',1,0,0,'2026-04-06 18:54:14','2026-04-25 17:14:53'),(53,2,2,'{\"message\":\"test\",\"project\":null}','',1,0,0,'2026-04-06 18:56:27','2026-04-25 17:14:53'),(54,2,2,'{\"message\":\"hey\",\"project\":null}','',1,0,0,'2026-04-07 15:20:20','2026-04-25 17:14:53'),(55,2,2,'{\"message\":\"test\",\"project\":null}','',1,0,0,'2026-04-07 15:21:29','2026-04-25 17:14:53'),(56,2,2,'{\"message\":\"test\",\"project\":null}','',1,0,0,'2026-04-07 15:22:27','2026-04-25 17:14:53'),(57,1,2,'{\"message\":\"test\",\"project\":null}','',1,0,0,'2026-04-07 15:24:28','2026-05-06 14:05:35'),(58,1,2,'{\"message\":\"hi\",\"project\":null}','',1,0,0,'2026-04-07 15:24:32','2026-05-06 14:05:35'),(59,1,2,'{\"message\":\"1 kere yaz\\u0131yorum\",\"project\":null}','',1,0,0,'2026-04-07 15:24:55','2026-05-06 14:05:35'),(60,1,2,'{\"message\":\"test\",\"project\":null}','',1,0,0,'2026-04-07 15:27:08','2026-05-06 14:05:35'),(61,1,2,'{\"message\":\"1 kere\",\"project\":null}','',1,0,0,'2026-04-07 15:27:30','2026-05-06 14:05:35'),(62,1,2,'{\"message\":\"2\",\"project\":null}','',1,0,0,'2026-04-07 15:27:43','2026-05-06 14:05:35'),(63,1,2,'{\"message\":\"hey\",\"project\":null}','',1,0,0,'2026-04-07 15:27:55','2026-05-06 14:05:35'),(64,1,2,'{\"message\":\"hi\",\"project\":null}','',1,0,0,'2026-04-07 15:27:59','2026-05-06 14:05:35'),(65,1,1,'{\"message\":\"hi\",\"project\":null}','',1,0,0,'2026-04-07 15:28:34','2026-04-24 15:34:30'),(66,1,2,'{\"message\":\"hey\",\"project\":null}','',1,0,0,'2026-04-07 15:29:03','2026-05-06 14:05:35'),(67,1,2,'{\"message\":\"hi\",\"project\":null}','',1,0,0,'2026-04-07 15:29:08','2026-05-06 14:05:35'),(68,1,2,'{\"message\":\"hi\",\"project\":null}','',1,0,0,'2026-04-07 15:30:03','2026-05-06 14:05:35'),(69,1,2,'{\"message\":\"test1\",\"project\":null}','',1,0,0,'2026-04-07 15:30:11','2026-05-06 14:05:35'),(70,1,1,'{\"message\":\"test2\",\"project\":null}','',1,0,0,'2026-04-07 15:31:23','2026-04-24 15:34:30'),(71,1,1,'{\"message\":\"test3\",\"project\":null}','',1,0,0,'2026-04-07 15:33:36','2026-04-24 15:34:30'),(72,1,2,'{\"message\":\"hey\",\"project\":null}','',1,0,0,'2026-04-07 15:34:48','2026-05-06 14:05:35'),(73,1,1,'{\"message\":\"hey\",\"project\":null}','',1,0,0,'2026-04-07 15:37:40','2026-04-24 15:34:30'),(74,1,1,'{\"message\":\"hey\",\"project\":null}','',1,0,0,'2026-04-07 15:38:12','2026-04-24 15:34:30'),(75,1,1,'{\"message\":\"hey\",\"project\":null}','',1,0,0,'2026-04-07 15:38:14','2026-04-24 15:34:30'),(76,1,1,'{\"message\":\"hey\",\"project\":null}','',1,0,0,'2026-04-07 15:38:16','2026-04-24 15:34:30'),(77,1,1,'{\"message\":\"hey\",\"project\":null}','',1,0,0,'2026-04-07 15:38:18','2026-04-24 15:34:30'),(78,1,1,'{\"message\":\"test1\",\"project\":null}','',1,0,0,'2026-04-07 15:40:57','2026-04-24 15:34:30'),(79,1,1,'{\"message\":\"test2\",\"project\":null}','',1,0,0,'2026-04-07 15:41:02','2026-04-24 15:34:30'),(80,1,1,'{\"message\":\"test3\",\"project\":null}','',1,0,0,'2026-04-07 15:41:05','2026-04-24 15:34:30'),(81,1,1,'{\"message\":\"test\",\"project\":null}','',1,0,0,'2026-04-07 15:43:29','2026-04-24 15:34:30'),(82,1,1,'{\"message\":\"log\",\"project\":null}','',1,0,0,'2026-04-07 15:43:39','2026-04-24 15:34:30'),(83,1,1,'{\"message\":\"log1\",\"project\":null}','',1,0,0,'2026-04-07 15:44:46','2026-04-24 15:34:30'),(84,1,1,'{\"message\":\"heey\",\"project\":null}','',1,0,0,'2026-04-07 16:37:58','2026-04-24 15:34:30'),(85,1,1,'{\"message\":\"ha a s\",\"project\":null}','',1,0,0,'2026-04-07 16:41:54','2026-04-24 15:34:30'),(86,1,1,'{\"message\":\"Eren eren\",\"project\":null}','',1,0,0,'2026-04-07 16:42:02','2026-04-24 15:34:30'),(87,1,1,'{\"message\":\"Eren eren\",\"project\":null}','',1,0,0,'2026-04-07 16:42:03','2026-04-24 15:34:30'),(88,1,1,'{\"message\":\"Eren\",\"project\":null}','',1,0,0,'2026-04-07 16:42:08','2026-04-24 15:34:30'),(89,1,2,'{\"message\":\"hi\",\"project\":null}','',1,0,0,'2026-04-07 16:42:22','2026-05-06 14:05:35'),(90,1,1,'{\"message\":\"heheh she\",\"project\":null}','',1,0,0,'2026-04-07 16:42:54','2026-04-24 15:34:30'),(91,1,1,'{\"message\":\"hi\",\"project\":null}','',1,0,0,'2026-04-11 07:24:31','2026-04-24 15:34:30'),(92,1,1,'{\"message\":\"1 kere g\\u00f6nderiyorum\",\"project\":null}','',1,0,0,'2026-04-11 07:24:38','2026-04-24 15:34:30'),(93,1,1,'{\"message\":\"test\",\"project\":null}','',1,0,0,'2026-04-11 07:39:17','2026-04-24 15:34:30'),(94,1,2,'{\"message\":\"hi\",\"project\":null}','',1,0,0,'2026-04-11 07:39:36','2026-05-06 14:05:35'),(95,1,2,'{\"message\":\"hey\",\"project\":null}','',1,0,0,'2026-04-11 07:39:45','2026-05-06 14:05:35'),(96,1,1,'{\"message\":\"test\",\"project\":null}','',1,0,0,'2026-04-11 07:39:49','2026-04-24 15:34:30'),(97,1,1,'{\"message\":\"g\\u00fczel \\u00e7al\\u0131\\u015f\\u0131yor\",\"project\":null}','',1,0,0,'2026-04-11 07:40:00','2026-04-24 15:34:30'),(98,3,1,'{\"message\":\"test\",\"project\":null}','',1,0,0,'2026-04-12 13:18:49','2026-04-24 15:34:29'),(99,3,2,'{\"message\":\"hi\",\"project\":null}','',1,0,0,'2026-04-12 13:19:02','2026-04-12 13:40:08'),(100,3,1,'{\"message\":\"hey\",\"project\":null}','',1,0,0,'2026-04-12 13:33:12','2026-04-24 15:34:29'),(101,3,2,'{\"message\":\"yo\",\"project\":null}','',1,0,0,'2026-04-12 13:39:42','2026-04-12 13:40:08'),(102,3,2,'{\"message\":\"hey\",\"project\":null}','',1,0,0,'2026-04-12 13:39:50','2026-04-12 13:40:08'),(103,3,2,'{\"message\":\"yo\",\"project\":null}','',1,0,0,'2026-04-12 13:39:59','2026-04-12 13:40:08'),(104,3,2,'{\"message\":\"hey\",\"project\":null}','',0,0,0,'2026-04-12 13:40:13','2026-04-12 13:40:13'),(105,4,1,'{\"message\":\"hi\",\"project\":null}','',1,0,0,'2026-04-16 12:15:56','2026-04-24 15:34:28'),(106,4,2,'{\"message\":\"hey\",\"project\":null}','',1,0,0,'2026-04-16 12:16:10','2026-04-16 12:19:50'),(107,1,1,'{\"message\":\"Eren\",\"project\":null}','',1,0,0,'2026-04-16 12:25:59','2026-04-24 15:34:30'),(108,1,2,'{\"message\":null,\"project\":null}','1776353177938203.pdf',1,0,0,'2026-04-16 12:26:17','2026-05-06 14:05:35'),(109,1,1,'{\"message\":\"Abi selam\\u00fcnaleyk\\u00fcm ben yolda kald\\u0131m da ne zaman gelebilirsin acil acil TEM yolunday\\u0131m\",\"project\":null}','',1,0,0,'2026-04-16 13:13:07','2026-04-24 15:34:30'),(110,1,2,'{\"message\":\"100 liraya gelirim\",\"project\":null}','',1,0,0,'2026-04-16 13:13:26','2026-05-06 14:05:35'),(111,1,1,'{\"message\":\"Abi hi\\u00e7 \\u00f6nemli de\\u011fil yan\\u0131mda \\u00e7ocuklar var yolda kald\\u0131m sen gel ben onayl\\u0131yorum sistemden sen geldi\\u011finde sen de onaylars\\u0131n paray\\u0131 verir\",\"project\":null}','',1,0,0,'2026-04-16 13:13:40','2026-04-24 15:34:30'),(112,1,2,'{\"message\":\"merhaba\",\"project\":null}','',1,0,0,'2026-04-22 14:30:49','2026-05-06 14:05:35'),(113,1,2,'{\"message\":\"hi\",\"project\":null}','',1,0,0,'2026-04-22 17:18:11','2026-05-06 14:05:35'),(114,1,2,'{\"message\":\"test\",\"project\":null}','',1,0,0,'2026-04-22 17:23:02','2026-05-06 14:05:35'),(115,1,1,'{\"message\":\"hi\",\"project\":null}','',1,0,0,'2026-04-22 17:23:24','2026-04-24 15:34:30'),(116,1,1,'{\"message\":\"test\",\"project\":null}','',1,0,0,'2026-04-22 17:23:33','2026-04-24 15:34:30'),(117,1,1,'{\"message\":\"hi\",\"project\":null}','',1,0,0,'2026-04-22 17:23:41','2026-04-24 15:34:30'),(118,1,2,'{\"message\":\"test\",\"project\":null}','',1,0,0,'2026-04-22 17:33:17','2026-05-06 14:05:35'),(119,1,2,'{\"message\":\"hey\",\"project\":null}','',1,0,0,'2026-04-22 17:33:30','2026-05-06 14:05:35'),(120,1,2,'{\"message\":\"hey\",\"project\":null}','',1,0,0,'2026-04-22 17:33:38','2026-05-06 14:05:35'),(121,1,1,'{\"message\":\"hey\",\"project\":null}','',1,0,0,'2026-04-22 17:35:31','2026-04-24 15:34:30'),(122,1,1,'{\"message\":\"hi\",\"project\":null}','',1,0,0,'2026-04-22 17:35:40','2026-04-24 15:34:30'),(123,1,1,'{\"message\":\"hey\",\"project\":null}','',1,0,0,'2026-04-22 17:35:54','2026-04-24 15:34:30'),(124,1,1,'{\"message\":\"hey\",\"project\":null}','',1,0,0,'2026-04-22 17:49:33','2026-04-24 15:34:30'),(125,1,2,'{\"message\":\"twst\",\"project\":null}','',1,0,0,'2026-04-22 17:49:47','2026-05-06 14:05:35'),(126,1,1,'{\"message\":\"hi\",\"project\":null}','',1,0,0,'2026-04-22 17:49:58','2026-04-24 15:34:30'),(127,1,1,'{\"message\":\"hey\",\"project\":null}','',1,0,0,'2026-04-22 17:59:17','2026-04-24 15:34:30'),(128,2,2,'{\"message\":\"hi\",\"project\":null}','',1,0,0,'2026-04-22 17:59:29','2026-04-25 17:14:53'),(129,1,1,'{\"message\":\"hi\",\"project\":null}','',1,0,0,'2026-04-22 18:00:32','2026-04-24 15:34:30'),(130,1,2,'{\"message\":\"hi\",\"project\":null}','',1,0,0,'2026-04-22 18:05:52','2026-05-06 14:05:35'),(131,1,1,'{\"message\":\"hey\",\"project\":null}','',1,0,0,'2026-04-22 18:09:31','2026-04-24 15:34:30'),(132,1,2,'{\"message\":\"merhaba\",\"project\":null}','',1,0,0,'2026-04-23 11:12:30','2026-05-06 14:05:35'),(133,1,2,'{\"message\":\"test\",\"project\":null}','',1,0,0,'2026-04-23 11:12:41','2026-05-06 14:05:35'),(134,1,1,'{\"message\":\"iki kere\",\"project\":null}','',1,0,0,'2026-04-23 11:12:48','2026-04-24 15:34:30'),(135,1,1,'{\"message\":\"bshshjs\",\"project\":null}','',1,0,0,'2026-04-23 11:12:58','2026-04-24 15:34:30'),(136,1,1,'{\"message\":\"hi\",\"project\":null}','',1,0,0,'2026-04-24 10:18:27','2026-04-24 15:34:30'),(137,1,1,'{\"message\":null,\"project\":null}','1777131275222310.jpg',1,0,0,'2026-04-25 12:34:35','2026-04-25 14:18:16'),(138,1,1,'{\"message\":\"I have placed an order. Order ID: #70\",\"project\":{\"id\":204,\"project_creator\":null,\"username\":\"ahmeteren1999\",\"title\":\"\\u00c7ilingir Deneme Hizmeti\",\"slug\":\"cilingir\",\"image\":[\"1776151948-69dded8c2abb2.jpg\",\"1776153049-69ddf1d9beebe.jpg\",\"1776153049-69ddf1d9bf235.jpg\"],\"type\":\"project\",\"interview_message\":\"\"}}','',1,0,0,'2026-04-25 13:04:13','2026-04-25 14:18:16'),(139,1,1,'{\"message\":\"Bir sipari\\u015f verdim. Sipari\\u015f ID: #71\",\"project\":{\"id\":204,\"project_creator\":null,\"username\":\"ahmeteren1999\",\"title\":\"\\u00c7ilingir Deneme Hizmeti\",\"slug\":\"cilingir\",\"image\":[\"1776151948-69dded8c2abb2.jpg\",\"1776153049-69ddf1d9beebe.jpg\",\"1776153049-69ddf1d9bf235.jpg\"],\"type\":\"project\",\"interview_message\":\"\"},\"order_id\":71}','',1,0,0,'2026-04-25 13:11:40','2026-04-25 14:18:16'),(140,1,2,'{\"message\":\"test\",\"project\":null,\"order_id\":null}','',1,0,0,'2026-04-25 14:18:16','2026-05-06 14:05:35'),(141,1,2,'{\"message\":\"hi\",\"project\":null,\"order_id\":null}','',1,0,0,'2026-04-25 17:16:06','2026-05-06 14:05:35'),(142,1,2,'{\"message\":null,\"project\":null,\"order_id\":null}','1777148194792722.jpg',1,0,0,'2026-04-25 17:16:35','2026-05-06 14:05:35'),(143,5,1,'{\"message\":\"Bir sipari\\u015f verdim. Sipari\\u015f ID: #73\",\"project\":{\"id\":207,\"project_creator\":null,\"username\":\"client\",\"title\":\"mobilya kurulum\",\"slug\":\"n-un-sjjsjsjsjjsjsjsjsjsuududuududusuduududududjjdjdd\",\"image\":[\"1776354073-69e10319751c4.jpg\"],\"type\":\"project\",\"interview_message\":\"\"},\"order_id\":73}','',0,0,0,'2026-04-26 14:52:16','2026-04-26 14:52:16'),(144,1,2,'{\"message\":null,\"project\":null,\"order_id\":null}','1777361802384625.jpg',1,0,0,'2026-04-28 04:36:42','2026-05-06 14:05:35'),(145,1,2,'{\"message\":\"hi\",\"project\":null,\"order_id\":null}','',1,0,0,'2026-04-28 04:41:18','2026-05-06 14:05:35'),(146,1,2,'{\"message\":\"test\",\"project\":null,\"order_id\":null}','',1,0,0,'2026-04-28 04:51:09','2026-05-06 14:05:35'),(147,1,2,'{\"message\":\"test\",\"project\":null,\"order_id\":null}','',1,0,0,'2026-04-28 04:51:19','2026-05-06 14:05:35'),(148,1,1,'{\"message\":\"hi\",\"project\":null,\"order_id\":null}','',1,0,0,'2026-04-28 04:51:40','2026-04-28 05:47:58'),(149,1,1,'{\"message\":\"test\",\"project\":null,\"order_id\":null}','',1,0,0,'2026-04-28 04:52:00','2026-04-28 05:47:58'),(150,1,1,'{\"message\":\"test\",\"project\":null,\"order_id\":null}','',1,0,0,'2026-04-28 04:52:16','2026-04-28 05:47:58'),(151,1,1,'{\"message\":\"test\",\"project\":null,\"order_id\":null}','',1,0,0,'2026-04-28 05:40:53','2026-04-28 05:47:58'),(152,1,1,'{\"message\":\"test2\",\"project\":null,\"order_id\":null}','',1,0,0,'2026-04-28 05:41:06','2026-04-28 05:47:58'),(153,1,2,'{\"message\":\"test\",\"project\":null,\"order_id\":null}','',1,0,0,'2026-04-28 05:47:51','2026-05-06 14:05:35'),(154,1,2,'{\"message\":\"merhaba\",\"project\":null,\"order_id\":null}','',1,0,0,'2026-04-28 05:47:58','2026-05-06 14:05:35'),(155,1,1,'{\"message\":\"Bir sipari\\u015f verdim. Sipari\\u015f ID: #74\",\"project\":{\"id\":194,\"project_creator\":null,\"username\":\"ahmeteren1999\",\"title\":\"Ben \\u015funu bunu yap\\u0131yorum\",\"slug\":\"hizmet\",\"image\":[\"1775400804-69d27764a35fc.jpeg\"],\"type\":\"project\",\"interview_message\":\"\"},\"order_id\":74}','',1,0,0,'2026-04-28 05:51:32','2026-05-04 12:52:43'),(156,1,1,'{\"message\":\"Bir sipari\\u015f verdim. Sipari\\u015f ID: #75\",\"project\":{\"id\":193,\"project_creator\":null,\"username\":\"ahmeteren1999\",\"title\":\"Her t\\u00fcrl\\u00fc kap\\u0131 a\\u00e7\\u0131l\\u0131r\",\"slug\":\"her-t\\u00fcrl\\u00fc-kap\\u0131-a\\u00e7\\u0131l\\u0131r\",\"image\":[\"1774644330-69c6ec6abbc4e.jpg\",\"1774644330-69c6ec6ad5129.jpg\",\"1774644330-69c6ec6ad7f9b.jpeg\"],\"type\":\"project\",\"interview_message\":\"\"},\"order_id\":75}','',1,0,0,'2026-04-28 08:35:11','2026-05-04 12:52:43'),(157,1,1,'{\"message\":\"test\",\"project\":null,\"order_id\":null}','',1,0,0,'2026-05-03 15:04:23','2026-05-04 12:52:43'),(158,1,1,'{\"message\":\"Bir sipari\\u015f verdim. Sipari\\u015f ID: #76\",\"project\":{\"id\":204,\"project_creator\":null,\"username\":\"ahmeteren1999\",\"title\":\"\\u00c7ilingir Deneme Hizmeti\",\"slug\":\"cilingir\",\"image\":[\"1776151948-69dded8c2abb2.jpg\",\"1776153049-69ddf1d9beebe.jpg\",\"1776153049-69ddf1d9bf235.jpg\"],\"type\":\"project\",\"interview_message\":\"\"},\"order_id\":76}','',1,0,0,'2026-05-04 12:43:53','2026-05-04 12:52:43'),(159,1,1,'{\"message\":\"Bir sipari\\u015f verdim. Sipari\\u015f ID: #77\",\"project\":{\"id\":194,\"project_creator\":null,\"username\":\"ahmeteren1999\",\"title\":\"Ben \\u015funu bunu yap\\u0131yorum\",\"slug\":\"hizmet\",\"image\":[\"1775400804-69d27764a35fc.jpeg\"],\"type\":\"project\",\"interview_message\":\"\"},\"order_id\":77}','',1,0,0,'2026-05-04 12:44:36','2026-05-04 12:52:43'),(160,1,1,'{\"message\":\"Bir sipari\\u015f verdim. Sipari\\u015f ID: #78\",\"project\":{\"id\":204,\"project_creator\":null,\"username\":\"ahmeteren1999\",\"title\":\"\\u00c7ilingir Deneme Hizmeti\",\"slug\":\"cilingir\",\"image\":[\"1776151948-69dded8c2abb2.jpg\",\"1776153049-69ddf1d9beebe.jpg\",\"1776153049-69ddf1d9bf235.jpg\"],\"type\":\"project\",\"interview_message\":\"\"},\"order_id\":78}','',1,0,0,'2026-05-04 12:45:25','2026-05-04 12:52:43'),(161,1,2,'{\"message\":\"hey\",\"project\":null,\"order_id\":null}','',1,0,0,'2026-05-04 12:52:43','2026-05-06 14:05:35');
/*!40000 ALTER TABLE `live_chat_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `live_chats`
--

DROP TABLE IF EXISTS `live_chats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `live_chats` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) DEFAULT NULL,
  `freelancer_id` bigint(20) DEFAULT NULL,
  `admin_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `live_chats`
--

LOCK TABLES `live_chats` WRITE;
/*!40000 ALTER TABLE `live_chats` DISABLE KEYS */;
INSERT INTO `live_chats` VALUES (1,1,1236,NULL,'2026-04-02 10:17:19','2026-04-02 10:17:19'),(2,1236,1236,NULL,'2026-04-06 18:32:54','2026-04-06 18:32:54'),(3,7,1236,NULL,'2026-04-12 13:18:49','2026-04-12 13:18:49'),(4,1237,1236,NULL,'2026-04-16 12:15:56','2026-04-16 12:15:56'),(5,1236,1,NULL,'2026-04-26 14:52:16','2026-04-26 14:52:16');
/*!40000 ALTER TABLE `live_chats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_activities`
--

DROP TABLE IF EXISTS `log_activities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `log_activities` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `method` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `agent` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_activities`
--

LOCK TABLES `log_activities` WRITE;
/*!40000 ALTER TABLE `log_activities` DISABLE KEYS */;
/*!40000 ALTER TABLE `log_activities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media_uploads`
--

DROP TABLE IF EXISTS `media_uploads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `media_uploads` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `path` text NOT NULL,
  `alt` text DEFAULT NULL,
  `size` text DEFAULT NULL,
  `dimensions` text DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'admin',
  `user_id` bigint(20) DEFAULT NULL,
  `load_from` int(11) NOT NULL DEFAULT 0,
  `is_synced` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=330 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media_uploads`
--

LOCK TABLES `media_uploads` WRITE;
/*!40000 ALTER TABLE `media_uploads` DISABLE KEYS */;
INSERT INTO `media_uploads` VALUES (178,'iyzipay17010664851703661770.svg','iyzipay170106648517036617701742736027.svg',NULL,'','','admin',1,0,0,'2025-03-23 07:20:27','2026-01-21 12:08:19'),(179,'authorize1681276383.png','authorize16812763831742736027.png',NULL,'2.01 KB','60 x 40 pixels','admin',1,0,0,'2025-03-23 07:20:27','2026-01-21 12:08:19'),(180,'pagali1681276333.png','pagali16812763331742736027.png',NULL,'993 ','60 x 40 pixels','admin',1,0,0,'2025-03-23 07:20:27','2026-01-21 12:08:19'),(181,'toybppay1681276253.png','toybppay16812762531742736028.png',NULL,'1014 ','60 x 40 pixels','admin',1,0,0,'2025-03-23 07:20:28','2026-01-21 12:08:19'),(182,'Group 11712748891680684065.png','Group 117127488916806840651742736028.png',NULL,'1.52 KB','60 x 40 pixels','admin',1,0,0,'2025-03-23 07:20:28','2026-01-21 12:08:19'),(183,'Group 11712748981680684100.png','Group 117127489816806841001742736028.png',NULL,'1.36 KB','59 x 40 pixels','admin',1,0,0,'2025-03-23 07:20:28','2026-01-21 12:08:19'),(184,'Group 11712748971680684099.png','Group 117127489716806840991742736028.png',NULL,'1.84 KB','59 x 40 pixels','admin',1,0,0,'2025-03-23 07:20:28','2026-01-21 12:08:19'),(185,'Group 11712748961680684065.png','Group 117127489616806840651742736029.png',NULL,'1.41 KB','60 x 40 pixels','admin',1,0,0,'2025-03-23 07:20:29','2026-01-21 12:08:19'),(186,'Group 11712748911680684065.png','Group 117127489116806840651742736029.png',NULL,'1.38 KB','59 x 40 pixels','admin',1,0,0,'2025-03-23 07:20:29','2026-01-21 12:08:19'),(187,'Group 11712748841680684099.png','Group 117127488416806840991742736029.png',NULL,'907 ','60 x 40 pixels','admin',1,0,0,'2025-03-23 07:20:29','2026-01-21 12:08:19'),(188,'Group 11712748831680684064.png','Group 117127488316806840641742736029.png',NULL,'1.28 KB','60 x 40 pixels','admin',1,0,0,'2025-03-23 07:20:29','2026-01-21 12:08:19'),(189,'Group 11712748871680684064.png','Group 117127488716806840641742736030.png',NULL,'1.32 KB','60 x 40 pixels','admin',1,0,0,'2025-03-23 07:20:30','2026-01-21 12:08:19'),(190,'Group 11712748851680684099.png','Group 117127488516806840991742736030.png',NULL,'1.66 KB','60 x 40 pixels','admin',1,0,0,'2025-03-23 07:20:30','2026-01-21 12:08:19'),(191,'Group 11712748861680684099.png','Group 117127488616806840991742736030.png',NULL,'1.63 KB','60 x 40 pixels','admin',1,0,0,'2025-03-23 07:20:30','2026-01-21 12:08:19'),(192,'Group 11712748771680684126.png','Group 117127487716806841261742736030.png',NULL,'1.06 KB','60 x 40 pixels','admin',1,0,0,'2025-03-23 07:20:30','2026-01-21 12:08:19'),(193,'Group 11712748821680684064.png','Group 117127488216806840641742736031.png',NULL,'1 KB','59 x 40 pixels','admin',1,0,0,'2025-03-23 07:20:31','2026-01-21 12:08:19'),(194,'Group 11712748791680684063.png','Group 117127487916806840631742736031.png',NULL,'1.09 KB','60 x 40 pixels','admin',1,0,0,'2025-03-23 07:20:31','2026-01-21 12:08:19'),(195,'Group 11712748801680684063.png','Group 117127488016806840631742736031.png',NULL,'1.15 KB','60 x 40 pixels','admin',1,0,0,'2025-03-23 07:20:31','2026-01-21 12:08:19'),(196,'Group 11712748781680684016.png','Group 117127487816806840161742736031.png',NULL,'984 ','60 x 40 pixels','admin',1,0,0,'2025-03-23 07:20:31','2026-01-21 12:08:19'),(197,'Group 11712748811680684064.png','Group 117127488116806840641742736032.png',NULL,'810 ','60 x 40 pixels','admin',1,0,0,'2025-03-23 07:20:32','2026-01-21 12:08:19'),(198,'Group 11712748761680683992.png','Group 117127487616806839921742736032.png',NULL,'1.2 KB','60 x 40 pixels','admin',1,0,0,'2025-03-23 07:20:32','2026-01-21 12:08:19'),(199,'Group 11712748921680684065.png','Group 117127489216806840651742736032.png',NULL,'2.74 KB','60 x 40 pixels','admin',1,0,0,'2025-03-23 07:20:32','2026-01-21 12:08:19'),(200,'sitesway1681276405 (1).png','sitesway1681276405 (1)1742736408.png',NULL,'1.41 KB','60 x 40 pixels','admin',1,0,0,'2025-03-23 07:26:48','2026-01-21 12:08:19'),(201,'logoedcaf74517197336801720591252 (1).png','logoedcaf74517197336801720591252 (1)1742736536.png',NULL,'36.65 KB','764 x 193 pixels','admin',1,0,0,'2025-03-23 07:28:56','2026-01-21 12:08:19'),(202,'logo1735215696 (1).png','logo1735215696 (1)1742736577.png',NULL,'3.56 KB','462 x 100 pixels','admin',1,0,0,'2025-03-23 07:29:37','2026-01-21 12:08:19'),(203,'xendit.png','xendit1742737238.png',NULL,'33.81 KB','1266 x 335 pixels','admin',1,0,0,'2025-03-23 07:40:38','2026-01-21 12:08:19'),(204,'03_banner_fav1715593369.png','03_banner_fav17155933691742738309.png',NULL,'510 ','20 x 20 pixels','admin',1,0,0,'2025-03-23 07:58:29','2026-01-21 12:08:19'),(205,'logo1698752007.png','logo16987520071742738309.png',NULL,'2.37 KB','201 x 40 pixels','admin',1,0,0,'2025-03-23 07:58:29','2026-01-21 12:08:19'),(206,'1701326993-656830918f9ea1702360366.png','1701326993-656830918f9ea17023603661742743026.png',NULL,'637.96 KB','1770 x 960 pixels','admin',1,0,0,'2025-03-23 09:17:07','2026-01-21 12:08:19'),(207,'1701347068-65687efc85ab81702360366.png','1701347068-65687efc85ab817023603661742743027.png',NULL,'993.12 KB','1770 x 960 pixels','admin',1,0,0,'2025-03-23 09:17:07','2026-01-21 12:08:19'),(208,'1701597696-656c52009c4821702360295.png','1701597696-656c52009c48217023602951742743027.png',NULL,'164.36 KB','1770 x 960 pixels','admin',1,0,0,'2025-03-23 09:17:08','2026-01-21 12:08:19'),(209,'1699190458-654796bad8a5d1702360364.png','1699190458-654796bad8a5d17023603641742743028.png',NULL,'321.42 KB','1770 x 960 pixels','admin',1,0,0,'2025-03-23 09:17:09','2026-01-21 12:08:19'),(210,'03_banner_light1715594933.png','03_banner_light17155949331742802008.png',NULL,'915 ','24 x 24 pixels','admin',1,0,0,'2025-03-24 01:40:08','2026-01-21 12:08:19'),(211,'03_banner_light1715594933.png','03_banner_light17155949331742802047.png',NULL,'915 ','24 x 24 pixels','admin',1,0,0,'2025-03-24 01:40:47','2026-01-21 12:08:19'),(212,'03_banner11715598594.png','03_banner117155985941742802055.png',NULL,'14.59 KB','196 x 195 pixels','admin',1,0,0,'2025-03-24 01:40:55','2026-01-21 12:08:19'),(213,'03_banner_tallent1715594947.png','03_banner_tallent17155949471742802090.png',NULL,'1.2 KB','24 x 24 pixels','admin',1,0,0,'2025-03-24 01:41:30','2026-01-21 12:08:19'),(214,'03_banner21715598604.png','03_banner217155986041742802129.png',NULL,'10.01 KB','171 x 171 pixels','admin',1,0,0,'2025-03-24 01:42:09','2026-01-21 12:08:19'),(215,'03_banner_shapes1715582691.png','03_banner_shapes17155826911742802159.png',NULL,'3.31 KB','1415 x 522 pixels','admin',1,0,0,'2025-03-24 01:42:39','2026-01-21 12:08:19'),(216,'03_banner_line1715593300.svg','03_banner_line17155933001742802236.svg',NULL,'','','admin',1,0,0,'2025-03-24 01:43:56','2026-01-21 12:08:19'),(217,'choose_thumb_shape1715685375.svg','choose_thumb_shape17156853751742802446.svg',NULL,'','','admin',1,0,0,'2025-03-24 01:47:26','2026-01-21 12:08:19'),(218,'choose_thumb1715685545.png','choose_thumb17156855451742802453.png',NULL,'14.23 KB','404 x 225 pixels','admin',1,0,0,'2025-03-24 01:47:33','2026-01-21 12:08:19'),(219,'work41698488777.svg','work416984887771742802628.svg',NULL,'','','admin',1,0,0,'2025-03-24 01:50:28','2026-01-21 12:08:19'),(220,'work31698488777.svg','work316984887771742802629.svg',NULL,'','','admin',1,0,0,'2025-03-24 01:50:29','2026-01-21 12:08:19'),(221,'work21698488777.svg','work216984887771742802629.svg',NULL,'','','admin',1,0,0,'2025-03-24 01:50:29','2026-01-21 12:08:19'),(222,'work1698488777.svg','work16984887771742802629.svg',NULL,'','','admin',1,0,0,'2025-03-24 01:50:29','2026-01-21 12:08:19'),(223,'Freelancer1717233304.png','Freelancer17172333041742802842.png',NULL,'33.08 KB','240 x 330 pixels','admin',1,0,0,'2025-03-24 01:54:02','2026-01-21 12:08:19'),(224,'Client1717233354.png','Client17172333541742802842.png',NULL,'49.31 KB','240 x 330 pixels','admin',1,0,0,'2025-03-24 01:54:02','2026-01-21 12:08:19'),(225,'appStore21715664155.jpg','appStore217156641551742802842.jpg',NULL,'7.98 KB','136 x 40 pixels','admin',1,0,0,'2025-03-24 01:54:02','2026-01-21 12:08:19'),(226,'appStore11715664155.jpg','appStore117156641551742802842.jpg',NULL,'8.09 KB','122 x 40 pixels','admin',1,0,0,'2025-03-24 01:54:02','2026-01-21 12:08:19'),(227,'appStore-shapes1715664319.svg','appStore-shapes17156643191742802842.svg',NULL,'','','admin',1,0,0,'2025-03-24 01:54:02','2026-01-21 12:08:19'),(228,'white-logo1698752859.png','white-logo16987528591742803247.png',NULL,'2.82 KB','280 x 56 pixels','admin',1,0,0,'2025-03-24 02:00:47','2025-03-24 02:00:47'),(229,'51701088005.png','517010880051742803892.png',NULL,'2.59 KB','47 x 47 pixels','admin',1,0,0,'2025-03-24 02:11:32','2025-03-24 02:11:32'),(230,'41701088005.png','417010880051742803892.png',NULL,'2.68 KB','47 x 47 pixels','admin',1,0,0,'2025-03-24 02:11:32','2025-03-24 02:11:32'),(231,'31701088005.png','317010880051742803893.png',NULL,'2.69 KB','47 x 47 pixels','admin',1,0,0,'2025-03-24 02:11:33','2025-03-24 02:11:33'),(232,'Top1700310589.png','Top17003105891742804273.png',NULL,'427.75 KB','636 x 410 pixels','admin',1,0,0,'2025-03-24 02:17:53','2025-03-24 02:17:53'),(233,'2nd1700310726.png','2nd17003107261742804355.png',NULL,'1.32 MB','1296 x 700 pixels','admin',1,0,0,'2025-03-24 02:19:15','2025-03-24 02:19:15'),(234,'team41701072091.jpg','team417010720911742804431.jpg',NULL,'52.02 KB','306 x 306 pixels','admin',1,0,0,'2025-03-24 02:20:31','2025-03-24 02:20:31'),(235,'team31701072090.jpg','team317010720901742804431.jpg',NULL,'63.07 KB','306 x 306 pixels','admin',1,0,0,'2025-03-24 02:20:31','2025-03-24 02:20:31'),(236,'team21701072091.jpg','team217010720911742804432.jpg',NULL,'62.66 KB','306 x 306 pixels','admin',1,0,0,'2025-03-24 02:20:32','2025-03-24 02:20:32'),(237,'team11701072090.jpg','team117010720901742804432.jpg',NULL,'58.52 KB','306 x 306 pixels','admin',1,0,0,'2025-03-24 02:20:32','2025-03-24 02:20:32'),(238,'41701088005.png','417010880051742805386.png',NULL,'2.68 KB','47 x 47 pixels','admin',1,0,0,'2025-03-24 02:36:26','2025-03-24 02:36:26'),(239,'31704282576.png','317042825761742805386.png',NULL,'4.3 KB','80 x 80 pixels','admin',1,0,0,'2025-03-24 02:36:26','2025-03-24 02:36:26'),(240,'51701088005.png','517010880051742805386.png',NULL,'2.59 KB','47 x 47 pixels','admin',1,0,0,'2025-03-24 02:36:26','2025-03-24 02:36:26'),(241,'41704282576.png','417042825761742805401.png',NULL,'4.59 KB','80 x 80 pixels','admin',1,0,0,'2025-03-24 02:36:41','2025-03-24 02:36:41'),(242,'31704282576.png','317042825761742805417.png',NULL,'4.3 KB','80 x 80 pixels','admin',1,0,0,'2025-03-24 02:36:57','2025-03-24 02:36:57'),(243,'31701088005.png','317010880051742805425.png',NULL,'2.69 KB','47 x 47 pixels','admin',1,0,0,'2025-03-24 02:37:05','2025-03-24 02:37:05'),(244,'41704282576.png','417042825761742805431.png',NULL,'4.59 KB','80 x 80 pixels','admin',1,0,0,'2025-03-24 02:37:11','2025-03-24 02:37:11'),(245,'31701088005.png','317010880051742805445.png',NULL,'2.69 KB','47 x 47 pixels','admin',1,0,0,'2025-03-24 02:37:25','2025-03-24 02:37:25'),(246,'41704282576.png','417042825761742805457.png',NULL,'4.59 KB','80 x 80 pixels','admin',1,0,0,'2025-03-24 02:37:37','2025-03-24 02:37:37'),(247,'31701088005.png','317010880051742805480.png',NULL,'2.69 KB','47 x 47 pixels','admin',1,0,0,'2025-03-24 02:38:00','2025-03-24 02:38:00'),(248,'21704282574.png','217042825741742805480.png',NULL,'3.93 KB','80 x 80 pixels','admin',1,0,0,'2025-03-24 02:38:00','2025-03-24 02:38:00'),(249,'31704282576.png','317042825761742805480.png',NULL,'4.3 KB','80 x 80 pixels','admin',1,0,0,'2025-03-24 02:38:00','2025-03-24 02:38:00'),(250,'41701088005.png','417010880051742805480.png',NULL,'2.68 KB','47 x 47 pixels','admin',1,0,0,'2025-03-24 02:38:00','2025-03-24 02:38:00'),(251,'41704282576.png','417042825761742805480.png',NULL,'4.59 KB','80 x 80 pixels','admin',1,0,0,'2025-03-24 02:38:00','2025-03-24 02:38:00'),(252,'51701088005.png','517010880051742805481.png',NULL,'2.59 KB','47 x 47 pixels','admin',1,0,0,'2025-03-24 02:38:01','2025-03-24 02:38:01'),(253,'51704282577.png','517042825771742805481.png',NULL,'4.18 KB','80 x 80 pixels','admin',1,0,0,'2025-03-24 02:38:01','2025-03-24 02:38:01'),(254,'web.svg','web1766573439.svg',NULL,'','','admin',1,0,0,'2025-12-24 09:50:39','2025-12-24 09:50:39'),(255,'video.svg','video1766573458.svg',NULL,'','','admin',1,0,0,'2025-12-24 09:50:58','2025-12-24 09:50:58'),(256,'marketing.svg','marketing1766573460.svg',NULL,'','','admin',1,0,0,'2025-12-24 09:51:00','2025-12-24 09:51:00'),(257,'app.svg','app1766573462.svg',NULL,'','','admin',1,0,0,'2025-12-24 09:51:02','2025-12-24 09:51:02'),(258,'badge.svg','badge1766573859.svg',NULL,'','','admin',1,0,0,'2025-12-24 09:57:39','2025-12-24 09:57:39'),(259,'wallet.svg','wallet1766573914.svg',NULL,'','','admin',1,0,0,'2025-12-24 09:58:34','2025-12-24 09:58:34'),(260,'lock.svg','lock1766573919.svg',NULL,'','','admin',1,0,0,'2025-12-24 09:58:39','2025-12-24 09:58:39'),(261,'hire_the_best.png','hire_the_best1766573922.png',NULL,'513.15 KB','683 x 513 pixels','admin',1,0,0,'2025-12-24 09:58:42','2025-12-24 09:58:42'),(262,'app-store.svg','app-store1766574115.svg',NULL,'','','admin',1,0,0,'2025-12-24 10:01:55','2025-12-24 10:01:55'),(263,'play-store.svg','play-store1766574119.svg',NULL,'','','admin',1,0,0,'2025-12-24 10:01:59','2025-12-24 10:01:59'),(264,'background.svg','background1766574123.svg',NULL,'','','admin',1,0,0,'2025-12-24 10:02:03','2025-12-24 10:02:03'),(265,'background.png','background1766574124.png',NULL,'20.58 KB','240 x 285 pixels','admin',1,0,0,'2025-12-24 10:02:04','2025-12-24 10:02:04'),(266,'phone.png','phone1766574126.png',NULL,'98.31 KB','252 x 369 pixels','admin',1,0,0,'2025-12-24 10:02:06','2025-12-24 10:02:06'),(267,'1.svg','11766574327.svg',NULL,'','','admin',1,0,0,'2025-12-24 10:05:27','2025-12-24 10:05:27'),(268,'2.svg','21766574329.svg',NULL,'','','admin',1,0,0,'2025-12-24 10:05:29','2025-12-24 10:05:29'),(269,'3.svg','31766574332.svg',NULL,'','','admin',1,0,0,'2025-12-24 10:05:32','2025-12-24 10:05:32'),(270,'4.svg','41766574334.svg',NULL,'','','admin',1,0,0,'2025-12-24 10:05:34','2025-12-24 10:05:34'),(271,'service-1.png','service-11766574534.png',NULL,'189.16 KB','312 x 360 pixels','admin',1,0,0,'2025-12-24 10:08:54','2025-12-24 10:08:54'),(272,'service-2.png','service-21766574536.png',NULL,'207.92 KB','312 x 360 pixels','admin',1,0,0,'2025-12-24 10:08:56','2025-12-24 10:08:56'),(273,'service-3.png','service-31766574538.png',NULL,'182.11 KB','312 x 360 pixels','admin',1,0,0,'2025-12-24 10:08:58','2025-12-24 10:08:58'),(274,'service-4.png','service-41766574541.png',NULL,'204.72 KB','312 x 360 pixels','admin',1,0,0,'2025-12-24 10:09:01','2025-12-24 10:09:01'),(275,'service-2.png','service-21766574623.png',NULL,'207.92 KB','312 x 360 pixels','admin',1,0,0,'2025-12-24 10:10:24','2025-12-24 10:10:24'),(276,'arc-2.svg','arc-21766574845.svg',NULL,'','','admin',1,0,0,'2025-12-24 10:14:05','2025-12-24 10:14:05'),(277,'user-1.png','user-11766574974.png',NULL,'9.66 KB','64 x 64 pixels','admin',1,0,0,'2025-12-24 10:16:14','2025-12-24 10:16:14'),(278,'user-2.png','user-21766574976.png',NULL,'9.69 KB','64 x 64 pixels','admin',1,0,0,'2025-12-24 10:16:16','2026-01-21 12:08:19'),(279,'user-3.png','user-31766574978.png',NULL,'9.34 KB','64 x 64 pixels','admin',1,0,0,'2025-12-24 10:16:18','2026-01-21 12:08:19'),(280,'user-4.png','user-41766574980.png',NULL,'9.09 KB','64 x 64 pixels','admin',1,0,0,'2025-12-24 10:16:20','2026-01-21 12:08:19'),(281,'banner-video.mp4','banner-video1766575019.mp4',NULL,'','','admin',1,0,0,'2025-12-24 10:16:59','2026-01-21 12:08:19'),(282,'back_image.png','back_image1766575332.png',NULL,'13.41 KB','692 x 612 pixels','admin',1,0,0,'2025-12-24 10:22:12','2026-01-21 12:08:19'),(283,'complete.svg','complete1766575334.svg',NULL,'','','admin',1,0,0,'2025-12-24 10:22:14','2026-01-21 12:08:19'),(284,'hired.svg','hired1766575336.svg',NULL,'','','admin',1,0,0,'2025-12-24 10:22:16','2026-01-21 12:08:19'),(285,'home-2-banner-bg.svg','home-2-banner-bg1766575338.svg',NULL,'','','admin',1,0,0,'2025-12-24 10:22:18','2026-01-21 12:08:19'),(286,'top_image.png','top_image1766575341.png',NULL,'536.21 KB','711 x 656 pixels','admin',1,0,0,'2025-12-24 10:22:21','2026-01-21 12:08:19'),(287,'about-us.png','about-us1766576964.png',NULL,'309.53 KB','648 x 364 pixels','admin',1,0,0,'2025-12-24 10:49:24','2026-01-21 12:08:19'),(288,'facebook.svg','facebook1766576965.svg',NULL,'','','admin',1,0,0,'2025-12-24 10:49:25','2026-01-21 12:08:19'),(289,'instagram.svg','instagram1766576967.svg',NULL,'','','admin',1,0,0,'2025-12-24 10:49:27','2026-01-21 12:08:19'),(290,'linkedIn.svg','linkedIn1766576969.svg',NULL,'','','admin',1,0,0,'2025-12-24 10:49:29','2026-01-21 12:08:19'),(291,'man-1.png','man-11766576972.png',NULL,'292.45 KB','446 x 508 pixels','admin',1,0,0,'2025-12-24 10:49:32','2026-01-21 12:08:19'),(292,'man-2.png','man-21766576973.png',NULL,'112.94 KB','269 x 309 pixels','admin',1,0,0,'2025-12-24 10:49:33','2026-01-21 12:08:19'),(293,'man-3.png','man-31766576975.png',NULL,'140.04 KB','312 x 320 pixels','admin',1,0,0,'2025-12-24 10:49:35','2026-01-21 12:08:19'),(294,'man-4.png','man-41766576977.png',NULL,'116.96 KB','253 x 308 pixels','admin',1,0,0,'2025-12-24 10:49:37','2026-01-21 12:08:19'),(295,'our-story.png','our-story1766576979.png',NULL,'526.13 KB','648 x 474 pixels','admin',1,0,0,'2025-12-24 10:49:39','2026-01-21 12:08:19'),(296,'our-values.png','our-values1766576980.png',NULL,'369.33 KB','648 x 474 pixels','admin',1,0,0,'2025-12-24 10:49:41','2026-01-21 12:08:19'),(297,'our-vision.png','our-vision1766576982.png',NULL,'234.32 KB','648 x 474 pixels','admin',1,0,0,'2025-12-24 10:49:42','2026-01-21 12:08:19'),(298,'white-logo.svg','white-logo1766578337.svg',NULL,'','','admin',1,0,0,'2025-12-24 11:12:17','2026-01-21 12:08:19'),(299,'logo.svg','logo1766578358.svg',NULL,'','','admin',1,0,0,'2025-12-24 11:12:38','2026-01-21 12:08:19'),(300,'logo.svg','logo1766578399.svg',NULL,'','','admin',1,0,0,'2025-12-24 11:13:19','2026-01-21 12:08:19'),(301,'favicon.png','favicon1766578422.png',NULL,'718 ','32 x 30 pixels','admin',1,0,0,'2025-12-24 11:13:42','2026-01-21 12:08:19'),(302,'favicon.png','favicon1766578452.png',NULL,'718 ','32 x 30 pixels','admin',1,0,0,'2025-12-24 11:14:12','2026-01-21 12:08:19'),(303,'favicon.png','favicon1766578462.png',NULL,'718 ','32 x 30 pixels','admin',1,0,0,'2025-12-24 11:14:22','2026-01-21 12:08:19'),(304,'background.svg','background1766579614.svg',NULL,'','','admin',1,0,0,'2025-12-24 11:33:34','2026-01-21 12:08:19'),(305,'phone.png','phone1766579622.png',NULL,'98.31 KB','252 x 369 pixels','admin',1,0,0,'2025-12-24 11:33:42','2026-01-21 12:08:19'),(306,'home-2-banner-bg.svg','home-2-banner-bg1766981495.svg',NULL,'','','admin',1,0,0,'2025-12-29 03:11:35','2026-01-21 12:08:19'),(307,'service_1_author.png','service_1_author1766981778.png',NULL,'3.53 KB','36 x 36 pixels','admin',1,0,0,'2025-12-29 03:16:18','2026-01-21 12:08:19'),(308,'service_2_author.png','service_2_author1766981781.png',NULL,'3.46 KB','36 x 36 pixels','admin',1,0,0,'2025-12-29 03:16:21','2026-01-21 12:08:19'),(309,'service_3_author.png','service_3_author1766981783.png',NULL,'3.5 KB','36 x 36 pixels','admin',1,0,0,'2025-12-29 03:16:23','2026-01-21 12:08:19'),(310,'service_4_author.png','service_4_author1766981786.png',NULL,'3.74 KB','36 x 36 pixels','admin',1,0,0,'2025-12-29 03:16:26','2026-01-21 12:08:19'),(311,'service_5_author.png','service_5_author1766981789.png',NULL,'3.83 KB','36 x 36 pixels','admin',1,0,0,'2025-12-29 03:16:29','2026-01-21 12:08:19'),(312,'service_6_author.png','service_6_author1766981791.png',NULL,'3.53 KB','36 x 36 pixels','admin',1,0,0,'2025-12-29 03:16:31','2026-01-21 12:08:19'),(313,'testimonial.svg','testimonial1767771136.svg',NULL,'','','admin',1,0,0,'2026-01-07 06:32:16','2026-01-21 12:08:19'),(314,'white-logo.svg','white-logo1768731908.svg',NULL,'','','admin',1,0,0,'2026-01-18 09:25:08','2026-01-21 12:08:19'),(315,'cilingir-nasil-olunur.jpg','cilingir-nasil-olunur1777913448.jpg',NULL,'75.92 KB','902 x 601 pixels','admin',1,0,0,'2026-05-04 13:50:48','2026-05-04 13:50:48'),(316,'2295734144129-607-tesisatci-makro-meslek.jpg','2295734144129-607-tesisatci-makro-meslek1777978833.jpg',NULL,'73.03 KB','1024 x 1024 pixels','admin',1,0,0,'2026-05-05 08:00:33','2026-05-05 08:01:03'),(317,'yaptırıyo (13).png','yaptırıyo (13)1777995275.png',NULL,'117.81 KB','4000 x 4000 pixels','admin',1,0,0,'2026-05-05 12:34:36','2026-05-05 12:34:36'),(321,'Adsız tasarım (3).png','Adsız tasarım (3)1777996489.png',NULL,'116.9 KB','257 x 385 pixels','admin',1,0,0,'2026-05-05 12:54:49','2026-05-05 12:54:49'),(322,'istockphoto-1049775258-612x612.jpg','istockphoto-1049775258-612x6121777997290.jpg',NULL,'37.78 KB','612 x 408 pixels','admin',1,0,0,'2026-05-05 13:08:10','2026-05-05 13:08:10'),(323,'yaptırıyo (14).png','yaptırıyo (14)1777998745.png',NULL,'114.24 KB','4000 x 4000 pixels','admin',1,0,0,'2026-05-05 13:32:26','2026-05-05 13:32:26'),(324,'Adsız tasarım (4).png','Adsız tasarım (4)1777998823.png',NULL,'6.12 KB','180 x 56 pixels','admin',1,0,0,'2026-05-05 13:33:43','2026-05-05 13:33:43'),(326,'Adsız tasarım (6).png','Adsız tasarım (6)1777998988.png',NULL,'2.42 KB','40 x 40 pixels','admin',1,0,0,'2026-05-05 13:36:28','2026-05-05 13:36:28'),(328,'Adsız tasarım (7).png','Adsız tasarım (7)1777999037.png',NULL,'3.43 KB','40 x 40 pixels','admin',1,0,0,'2026-05-05 13:37:17','2026-05-05 13:37:17'),(329,'Adsız tasarım (8).png','Adsız tasarım (8)1778067651.png',NULL,'343.31 KB','514 x 770 pixels','admin',1,0,0,'2026-05-06 08:40:51','2026-05-06 08:40:51');
/*!40000 ALTER TABLE `media_uploads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` longtext DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'Primary Menu','[{\"ptype\":\"custom\",\"id\":2,\"antarget\":\"\",\"icon\":\"\",\"pname\":\"Ana Sayfa\",\"purl\":\"@url\",\"children\":[{\"ptype\":\"pages\",\"id\":3,\"antarget\":\"\",\"icon\":\"\",\"menulabel\":\"\",\"pid\":7},{},{},{},{\"ptype\":\"pages\",\"id\":6,\"antarget\":\"\",\"icon\":\"\",\"menulabel\":\"\",\"pid\":10},{},{},{}]},{\"ptype\":\"custom\",\"id\":9,\"antarget\":\"\",\"icon\":\"\",\"pname\":\"Hizmetler\",\"purl\":\"@url\\/projects\\/all\"},{\"ptype\":\"custom\",\"id\":13,\"antarget\":\"\",\"icon\":\"\",\"pname\":\"Sayfalar\",\"purl\":\"#\",\"children\":[{},{},{},{},{},{\"ptype\":\"custom\",\"id\":19,\"antarget\":\"\",\"icon\":\"\",\"pname\":\"Blog\",\"purl\":\"@url\\/blogs\\/all\"},{},{},{},{},{},{},{},{},{},{},{},{\"ptype\":\"pages\",\"id\":34,\"antarget\":\"\",\"icon\":\"\",\"menulabel\":\"\",\"pid\":8},{\"ptype\":\"pages\",\"pid\":6,\"id\":47},{\"ptype\":\"pages\",\"id\":30,\"antarget\":\"\",\"icon\":\"\",\"menulabel\":\"\",\"pid\":9},{},{},{},{},{},{},{},{},{},{},{},{}]},{\"ptype\":\"pages\",\"id\":42,\"antarget\":\"\",\"icon\":\"\",\"menulabel\":\"\",\"pid\":2}]','default','2022-12-27 04:43:16','2026-05-05 07:50:37'),(2,'Footer Menu',NULL,'','2022-12-27 04:44:55','2023-11-14 05:24:22'),(4,'Social Menu',NULL,NULL,'2022-12-27 05:31:28','2022-12-27 05:31:28'),(5,'Test Menu','[{\"ptype\":\"custom\",\"id\":2,\"antarget\":\"\",\"icon\":\"\",\"pname\":\"Home\",\"purl\":\"@url\"},{\"ptype\":\"pages\",\"pid\":2,\"id\":2}]',NULL,'2022-12-28 01:50:31','2022-12-29 06:32:52');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meta_data`
--

DROP TABLE IF EXISTS `meta_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meta_data` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `meta_taggable_id` bigint(20) unsigned NOT NULL,
  `meta_taggable_type` varchar(255) NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_tags` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `facebook_meta_tags` varchar(255) DEFAULT NULL,
  `facebook_meta_description` text DEFAULT NULL,
  `facebook_meta_image` varchar(255) DEFAULT NULL,
  `twitter_meta_tags` varchar(255) DEFAULT NULL,
  `twitter_meta_description` text DEFAULT NULL,
  `twitter_meta_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meta_data`
--

LOCK TABLES `meta_data` WRITE;
/*!40000 ALTER TABLE `meta_data` DISABLE KEYS */;
INSERT INTO `meta_data` VALUES (1,193,'App\\Models\\Project','Her türlü kapı açılır','her, türlü, kapı, açılır','Her türlü kapı açılırHer türlü kapı açılırHer türlü kapı açılır','her, türlü, kapı, açılır','Her türlü kapı açılırHer türlü kapı açılırHer türlü kapı açılır',NULL,'her, türlü, kapı, açılır','Her türlü kapı açılırHer türlü kapı açılırHer türlü kapı açılır',NULL,'2026-03-27 17:45:30','2026-03-27 17:45:30'),(2,194,'App\\Models\\Project','Ben şunu bunu yapıyorum','ben, şunu, bunu, yapıyorum','Test Test Test Test Test Test Test Test Test Test Test Test Test Test v Test Test Test Test Test Test Test Test Test Test Test Test Test Test','ben, şunu, bunu, yapıyorum','Test Test Test Test Test Test Test Test Test Test Test Test Test Test v Test Test Test Test Test Test Test Test Test Test Test Test Test Test',NULL,'ben, şunu, bunu, yapıyorum','Test Test Test Test Test Test Test Test Test Test Test Test Test Test v Test Test Test Test Test Test Test Test Test Test Test Test Test Test',NULL,'2026-04-05 11:53:24','2026-05-04 13:43:15'),(3,199,'App\\Models\\Project','2. Su Borusu Tamir İlanı','borusu, tamir, İlanı','2. Su borusu tamir ilanı 2. Su borusu tamir ilanı 2. Su borusu tamir ilanı','borusu, tamir, İlanı','2. Su borusu tamir ilanı 2. Su borusu tamir ilanı 2. Su borusu tamir ilanı',NULL,'borusu, tamir, İlanı','2. Su borusu tamir ilanı 2. Su borusu tamir ilanı 2. Su borusu tamir ilanı',NULL,'2026-05-04 13:44:25','2026-05-04 13:44:25'),(4,204,'App\\Models\\Project','Çilingir Deneme Hizmeti','Çilingir, deneme, hizmeti','Çilingir hizmeti için deneme hizmeti test için yapıldı edit test edildi','Çilingir, deneme, hizmeti','Çilingir hizmeti için deneme hizmeti test için yapıldı edit test edildi',NULL,'Çilingir, deneme, hizmeti','Çilingir hizmeti için deneme hizmeti test için yapıldı edit test edildi',NULL,'2026-05-04 13:45:09','2026-05-04 13:45:09'),(5,207,'App\\Models\\Project','mobilya kurulum','mobilya, kurulum','FshshsbsbbshsjsjsjsjdjsjjzjJsjJjzjzjjzjsjzjzjzjzjzjznzjzjzjzjzjzjzjjzjzbsbshsgs','mobilya, kurulum','FshshsbsbbshsjsjsjsjdjsjjzjJsjJjzjzjjzjsjzjzjzjzjzjznzjzjzjzjzjzjzjjzjzbsbshsgs',NULL,'mobilya, kurulum','FshshsbsbbshsjsjsjsjdjsjjzjJsjJjzjzjjzjsjzjzjzjzjzjznzjzjzjzjzjzjzjjzjzbsbshsgs',NULL,'2026-05-04 13:48:19','2026-05-04 13:48:19'),(6,214,'App\\Models\\Project','süper Elektirik','süper, elektirik','Test Test Test Test Test Test Test Test Test Test Test Test Test v v v Test Test Test Test Test Test Test Test Test ','süper, elektirik','Test Test Test Test Test Test Test Test Test Test Test Test Test v v v Test Test Test Test Test Test Test Test Test ',NULL,'süper, elektirik','Test Test Test Test Test Test Test Test Test Test Test Test Test v v v Test Test Test Test Test Test Test Test Test ',NULL,'2026-05-04 13:49:12','2026-05-04 13:49:12');
/*!40000 ALTER TABLE `meta_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=319 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2022_12_06_070148_create_admins_table',1),(6,'2022_12_07_111046_create_static_options_table',2),(7,'2022_12_07_111908_create_media_uploads_table',3),(9,'2022_12_21_081351_create_meta_data_table',4),(10,'2022_12_21_075819_create_pages_table',5),(11,'2022_12_27_102354_create_menus_table',6),(12,'2022_12_29_073650_create_form_builders_table',7),(13,'2023_01_14_111350_create_widgets_table',8),(15,'2014_10_12_000000_create_users_table',9),(16,'2023_01_25_061947_create_countries_table',10),(17,'2023_01_25_062042_create_states_table',10),(18,'2023_01_25_062051_create_cities_table',10),(20,'2023_01_31_111953_create_user_introductions_table',11),(21,'2023_02_01_105814_create_user_experiences_table',12),(22,'2023_02_06_070500_create_user_education_table',13),(26,'2023_02_06_104340_create_categories_table',15),(27,'2023_02_06_104409_create_sub_categories_table',15),(31,'2023_02_08_080702_add_slug_and_image_to_categories_table',16),(32,'2023_02_08_080738_add_slug_and_image_to_sub_categories_table',16),(33,'2023_02_09_031836_create_skills_table',17),(34,'2023_02_12_120227_create_user_works_table',18),(35,'2023_02_13_070232_create_user_skills_table',19),(36,'2023_02_13_110318_add_hourly_rate_to_users_table',20),(38,'2023_02_15_084950_create_identity_verifications_table',21),(41,'2023_02_20_062146_add_status_and_is_read_to_identity_verifications_table',22),(43,'2023_02_22_102326_add_deleted_at_to_users',23),(47,'2023_02_26_072137_create_create_projects_table',25),(48,'2023_02_27_060732_create_create_project_attributes_table',26),(49,'2023_03_05_045336_add_slug_and_status_to_create_projects',27),(51,'2023_03_13_091210_create_portfolios_table',28),(52,'2023_03_19_061043_add_timezone_to_states',29),(53,'2023_03_19_091240_add_check_online_status_to_users',30),(55,'2023_03_19_101455_add_check_work_availability_to_users',31),(56,'2023_03_22_065938_add_google_2fa_secret_to_users',32),(57,'2023_03_22_085506_add_google_2fa_enable_disable_disable_to_users',33),(58,'2023_03_28_090737_create_project_histories_table',34),(61,'2023_03_29_034510_add_project_approve_request_to_create_projects',35),(62,'2023_04_02_045528_create_admin_notifications_table',36),(63,'2023_04_03_083057_create_create_project_sub_categories_table',37),(64,'2023_04_04_063804_add_category_id_to_create_projects',38),(65,'2023_04_06_022811_create_wallets_table',39),(66,'2023_04_06_022826_create_wallet_histories_table',39),(76,'2023_04_29_070422_create_subscription_types_table',43),(77,'2023_04_29_071804_create_subscription_features_table',43),(78,'2023_04_29_072511_create_subscriptions_table',43),(79,'2023_05_02_123118_create_page_builders_table',44),(80,'2023_05_07_070709_create_languages_table',45),(81,'2023_05_15_052137_add_short_description_to_categories',46),(82,'2023_05_15_060433_add_short_description_to_sub_categories',47),(83,'2023_05_17_072955_add_level_to_users',48),(85,'2023_05_30_105849_add_last_apply_date_and_last_seen_to_jobs_table',49),(86,'2023_06_01_063633_create_job_histories_table',50),(88,'2023_06_07_044153_change_is_read_column_name',51),(89,'2023_06_08_034931_rename_subscription_connet_to_limit',52),(91,'2023_06_13_044928_add_validatity_to_subscription_types',53),(96,'2023_06_17_054259_create_user_subscriptions_table',54),(107,'2023_07_10_043726_create_user_earnings_table',55),(108,'2023_07_10_075003_create_individual_commission_settings_table',55),(145,'2023_07_09_042039_create_orders_table',56),(147,'2023_07_26_115750_create_order_decline_histories_table',56),(148,'2023_07_26_120317_create_order_decline_wallet_histories_table',56),(169,'2023_07_30_063825_create_user_notifications_table',57),(170,'2023_07_30_070915_create_order_submit_histories_table',57),(171,'2023_08_01_103629_create_order_request_revisions_table',57),(174,'2023_08_08_054420_add_revision_left_to_orders_table',58),(181,'2023_08_10_043412_create_ratings_table',59),(182,'2023_08_10_045939_create_rating_details_table',59),(183,'2023_08_21_101229_add_status_before_hold_to_orders_table',60),(184,'2023_08_21_101822_add_is_suspend_to_users_table',60),(185,'2023_08_27_055736_create_departments_table',61),(186,'2023_08_27_060148_create_tickets_table',61),(187,'2023_08_27_060349_create_chat_messages_table',61),(192,'2023_05_23_165755_create_live_chats_table',62),(193,'2023_05_23_165849_create_live_chat_messages_table',62),(195,'2023_09_11_094021_create_job_posts_table',63),(197,'2023_09_11_111935_create_job_post_sub_categories_table',64),(198,'2023_04_17_052446_create_job_skills_table',65),(199,'2023_09_11_115123_create_job_post_skills_table',66),(204,'2023_09_12_112426_create_job_proposals_table',67),(211,'2023_08_02_074726_create_freelancer_notifications_table',69),(212,'2023_08_03_115328_create_client_notifications_table',69),(213,'2023_10_01_051409_add_revision_to_job_proposals',70),(214,'2023_09_24_072604_create_offers_table',71),(215,'2023_09_24_072659_create_offer_milestones_table',71),(216,'2023_07_13_093714_create_order_milestones_table',72),(217,'2023_10_04_125750_add_current_status_to_job_posts',73),(218,'2023_10_15_073144_add_remaining_balance_and_withdraw_amount_to_wallets',74),(220,'2023_10_15_130310_create_withdraw_gateways_table',75),(222,'2023_10_16_122611_create_withdraw_requests_table',76),(223,'2023_10_19_092727_create_permission_tables',77),(224,'2023_10_19_095329_add_menu_name_to_permissions',77),(225,'2020_02_04_010636_create_newsletters_table',78),(230,'2023_10_29_115154_create_question_answers_table',79),(232,'2023_10_30_082828_create_feedback_table',80),(233,'2023_11_09_052611_create_bookmarks_table',81),(234,'2023_11_13_090531_create_reports_table',82),(235,'2023_12_04_093048_create_xg_ftp_infos_table',83),(236,'2023_12_11_062442_create_blog_posts_table',83),(237,'2023_12_23_081053_create_freelancer_levels_table',84),(238,'2023_12_23_081216_create_freelancer_level_rules_table',84),(239,'2024_01_14_091704_add_reject_reason_to_project_histories_table',85),(240,'2024_01_31_071706_add_offer_package_available_or_not_to_projects_table',86),(241,'2024_02_14_060336_add_is_pro_and_pro_expire_date_to_projects_table',87),(242,'2024_02_15_120132_add_is_valid_payment_to_orders_table',87),(243,'2024_02_18_072401_add_note_to_reports_table',87),(244,'2024_02_18_150813_create_news_letter_for_emails_table',87),(245,'2024_03_05_123836_add_email_verify_token_to_admins',88),(246,'2024_03_06_065635_add_firebase_device_token_to_users',88),(247,'2024_04_21_131737_create_jobs_table',89),(248,'2024_01_29_053338_create_project_promote_settings_table',90),(249,'2024_02_08_063522_create_promotion_project_lists_table',90),(250,'2024_02_14_075240_add_is_valid_payment_promotion_project_lists__table',90),(251,'2024_05_01_053357_add_apple_id_to_users_table',90),(252,'2024_05_05_100714_add_is_pro_to_users_table',90),(253,'2024_05_16_095256_create_words_table',91),(254,'2024_05_19_051405_add_freeze_withdraw_and_freeze_project_freeze_job_freeze_order_freeze_chat_to_users',91),(255,'2024_05_20_093916_create_log_activities_table',91),(256,'2024_06_11_053715_add_meta_title_and_meta_description_to_categories',92),(257,'2024_06_11_054044_add_meta_title_and_meta_description_to_sub_categories',92),(258,'2024_06_25_052118_add_meta_title_and_meta_description_and_meta_tags_to_projects',93),(259,'2024_06_25_053121_add_meta_title_and_meta_description_and_meta_tags_to_job_posts',93),(260,'2024_07_03_082447_add_load_from_and_is_synced_to_media_uploads',93),(261,'2024_07_06_050745_add_load_from_and_is_synced_to_projects',93),(262,'2024_07_07_103341_add_load_from_and_is_synced_to_job_posts',93),(263,'2024_07_07_135455_add_load_from_and_is_synced_to_job_proposals',93),(264,'2024_07_08_091056_add_load_from_and_is_synced_to_portfolios',93),(265,'2024_07_08_113034_add_load_from_and_is_synced_to_users',93),(266,'2024_07_09_061732_add_load_from_and_is_synced_to_chat_messages',93),(267,'2024_07_11_103143_add_load_from_and_is_synced_to_identity_verifications',93),(268,'2024_04_26_034953_create_payment_meta_data_table',94),(269,'2024_08_01_035813_add_hourly_rate_and_estimated_hours_to_job_posts',94),(270,'2024_08_13_054216_add_email_send_to_wallet_histories',94),(271,'2024_08_13_063128_add_email_send_to_orders',94),(272,'2024_08_13_063226_add_email_send_to_user_subscriptions',94),(273,'2024_08_13_063805_add_email_send_to_promotion_project_lists',94),(274,'2024_08_18_080543_create_order_work_histories_table',94),(275,'2024_08_27_100524_add_selected_category_to_categories',94),(276,'2024_08_28_122807_create_order_screenshots_table',94),(277,'2024_08_29_115158_add_load_from_and_is_synced_to_live_chat_messages',94),(278,'2024_09_11_043432_change_admins_table_role_default_value',95),(279,'2024_09_18_062831_create_lengths_table',96),(280,'2024_09_18_080536_create_experience_levels_table',96),(281,'2024_09_22_064433_add_order_type_to_orders',96),(282,'2024_11_28_060639_create_question_tips_table',97),(283,'2024_12_01_123713_create_question_tip_answers_table',97),(284,'2024_12_04_044850_create_question_tip_reactions_table',97),(285,'2024_12_04_110833_create_question_tip_answer_reactions_table',97),(286,'2024_12_08_110120_create_question_tip_answer_replies_table',97),(287,'2025_02_17_113008_add_currency_and_conversion_rate_to_orders',98),(288,'2025_02_20_125546_add_currency_and_conversion_rate_to_job_proposals',98),(289,'2025_02_24_121003_add_currency_and_conversion_rate_to_wallet_histories',98),(290,'2025_02_26_112850_add_currency_symbol_position_to_selected_currency_lists',98),(291,'2025_05_05_092633_create_can_contact_freelancers_table',98),(292,'2025_07_19_172820_add_is_free_to_subscription_types_table',98),(293,'2025_08_25_060900_add_type_to_wallet_histories_table',98),(294,'2025_08_31_045533_add_fee_columns_to_wallet_histories_table',98),(295,'2025_09_01_031118_add_commission_fields_to_subscriptions_table',98),(296,'2025_09_01_045650_make_admin_commission_nullable_in_individual_commission_settings_table',98),(297,'2025_09_02_110547_add_extra_price_and_is_paid_to_project_attributes_table',98),(298,'2025_09_08_051449_add_invoice_no_to_orders_table',98),(299,'2025_09_18_184451_add_sender_id_to_chat_messages_table',99),(300,'2025_09_24_064509_add_country_restriction_fields_to_job_posts',99),(301,'2025_09_25_052541_alter_description_in_user_introductions_table',99),(302,'2025_10_12_095344_add_show_earning_to_user_earnings_table',100),(303,'2025_12_30_080316_create_banners_table',101),(304,'2026_04_02_122045_add_physical_service_columns_to_orders_table',102),(305,'2026_04_05_151343_change_attachment_nullable_to_order_submit_histories_table',103),(306,'2026_04_11_105000_create_call_histories_table',104),(307,'2026_04_14_080718_add_video_url_to_projects_table',105),(308,'2026_04_21_172831_create_project_service_areas_table',106),(309,'2023_09_12_105849_add_last_apply_date_and_last_seen_to_jobs_table',107),(310,'2026_03_27_174008_create_user_service_areas_table',108),(311,'2026_03_27_174050_add_location_fields_to_projects_table',109),(312,'2026_03_27_180206_add_physical_service_fields_to_orders_table',110),(313,'2026_03_27_204043_add_location_columns_to_projects_table',110),(314,'2026_04_21_222500_make_image_nullable_in_projects_table',110),(315,'2026_04_23_200000_add_iyzico_card_user_key_to_users_table',111),(316,'2026_04_24_174000_create_user_addresses_table',112),(317,'2026_05_06_162626_add_is_urgent_to_job_posts_table',113),(318,'2026_05_07_082522_add_store_ids_to_subscriptions_table',114);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\Admin',1);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news_letter_for_emails`
--

DROP TABLE IF EXISTS `news_letter_for_emails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `news_letter_for_emails` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `verified` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `news_letter_for_emails_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news_letter_for_emails`
--

LOCK TABLES `news_letter_for_emails` WRITE;
/*!40000 ALTER TABLE `news_letter_for_emails` DISABLE KEYS */;
/*!40000 ALTER TABLE `news_letter_for_emails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newsletters`
--

DROP TABLE IF EXISTS `newsletters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `newsletters` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `verified` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `newsletters_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newsletters`
--

LOCK TABLES `newsletters` WRITE;
/*!40000 ALTER TABLE `newsletters` DISABLE KEYS */;
/*!40000 ALTER TABLE `newsletters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offer_milestones`
--

DROP TABLE IF EXISTS `offer_milestones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `offer_milestones` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `offer_id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `price` double NOT NULL,
  `deadline` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=pending, 1=active, 2=complete, 3=cancel',
  `revision` int(11) NOT NULL DEFAULT 0,
  `revision_left` int(11) NOT NULL DEFAULT 0,
  `attachment` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offer_milestones`
--

LOCK TABLES `offer_milestones` WRITE;
/*!40000 ALTER TABLE `offer_milestones` DISABLE KEYS */;
/*!40000 ALTER TABLE `offer_milestones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offers`
--

DROP TABLE IF EXISTS `offers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `offers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `freelancer_id` bigint(20) NOT NULL,
  `client_id` bigint(20) NOT NULL,
  `price` double NOT NULL,
  `description` longtext DEFAULT NULL,
  `deadline` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=pending, 1=active, 2=reject',
  `revision` int(11) NOT NULL DEFAULT 0,
  `revision_left` int(11) NOT NULL DEFAULT 0,
  `attachment` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offers`
--

LOCK TABLES `offers` WRITE;
/*!40000 ALTER TABLE `offers` DISABLE KEYS */;
INSERT INTO `offers` VALUES (2,1236,1,1000,'<p>Test teklif</p>','2 Days',1,1,1,NULL,'2026-04-05 14:12:23','2026-04-05 15:06:34'),(3,1236,1,100,'<p>Özel teklif açıklaması</p>','2026-04-06',2,1,1,NULL,'2026-04-06 06:12:10','2026-04-06 06:23:41'),(4,1236,1,1000,'<p>Özel teklif formu özel teklif formu özel teklif formu</p>','2026-04-06',1,1,1,NULL,'2026-04-06 06:54:14','2026-04-06 15:05:01'),(5,1236,1,1000,'<p>Teklif test ediyorum Teklif test ediyorum Teklif test ediyorum Teklif test ediyorum Teklif test ediyorum Teklif test ediyorum</p>','1 Days',1,1,1,NULL,'2026-04-06 15:11:49','2026-04-06 15:12:01'),(6,1236,1,1000,'<p>test test test test test test test test test test test test</p>','1 Days',1,1,1,NULL,'2026-04-06 15:22:55','2026-04-06 15:23:03'),(7,1236,1,1000,'&nbsp;Açıklama test ediyorum Açıklama test ediyorum Açıklama test ediyorum Açıklama test ediyorum','1 Days',1,1,1,NULL,'2026-04-06 15:31:41','2026-04-06 15:31:53'),(8,1236,1,1008,'<p>Geliyorummmmmmömmmm</p>','2026-04-16',1,1,1,NULL,'2026-04-16 13:14:05','2026-04-16 13:14:27'),(9,1236,1,499,'<p>Sipariş açıklaması şöyle olacak böyle olacak</p>','2026-04-30',1,1,1,NULL,'2026-04-22 14:32:13','2026-04-22 14:32:46'),(10,1236,1,498,'<p>O bu şu yapılacak</p>','2026-04-22',1,1,1,NULL,'2026-04-22 15:26:12','2026-04-22 15:26:28'),(11,1236,1,497,'<p>O bu şu onlar bunlar şunlar yapılacak&nbsp;<span style=\"font-size: 1rem; -webkit-tap-highlight-color: transparent; -webkit-text-size-adjust: 100%;\">O bu şu onlar bunlar şunlar yapılacak&nbsp;</span><span style=\"font-size: 1rem; -webkit-tap-highlight-color: transparent; -webkit-text-size-adjust: 100%;\">O bu şu onlar bunlar şunlar yapılacak&nbsp;</span><span style=\"font-size: 1rem; -webkit-tap-highlight-color: transparent; -webkit-text-size-adjust: 100%;\">O bu şu onlar bunlar şunlar yapılacak&nbsp;</span><span style=\"font-size: 1rem; -webkit-tap-highlight-color: transparent; -webkit-text-size-adjust: 100%;\">O bu şu onlar bunlar şunlar yapılacak&nbsp;</span></p>','2026-04-22',2,1,1,NULL,'2026-04-22 15:58:45','2026-04-22 16:38:58'),(12,1236,1,496,NULL,'2026-04-22',2,1,1,NULL,'2026-04-22 17:18:46','2026-04-22 17:19:06'),(13,1236,1,495,NULL,'2026-04-22',2,1,1,NULL,'2026-04-22 17:24:15','2026-04-22 17:24:29'),(14,1236,1,494,NULL,'2026-04-22',2,1,1,NULL,'2026-04-22 17:59:56','2026-04-22 18:00:10'),(15,1236,1,1000,NULL,'2026-04-25',1,1,1,NULL,'2026-04-25 16:44:22','2026-04-25 16:45:19');
/*!40000 ALTER TABLE `offers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_decline_histories`
--

DROP TABLE IF EXISTS `order_decline_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_decline_histories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) NOT NULL,
  `freelancer_id` bigint(20) NOT NULL,
  `client_id` bigint(20) NOT NULL,
  `order_price` double NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `cancel_or_decline` varchar(255) DEFAULT NULL,
  `cancel_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_decline_histories`
--

LOCK TABLES `order_decline_histories` WRITE;
/*!40000 ALTER TABLE `order_decline_histories` DISABLE KEYS */;
INSERT INTO `order_decline_histories` VALUES (1,5,1236,1,40,'complete','reddet','freelancer','2026-04-02 15:02:07','2026-04-02 15:02:07'),(2,12,1236,1,40,'complete','reddet','freelancer','2026-04-02 17:22:35','2026-04-02 17:22:35'),(3,15,1236,1,40,'complete','reddet','freelancer','2026-04-05 11:45:18','2026-04-05 11:45:18'),(4,16,1236,1,40,'complete','reddet','freelancer','2026-04-05 11:49:11','2026-04-05 11:49:11'),(5,19,1236,1,1000,'complete','reddet','freelancer','2026-04-05 15:07:48','2026-04-05 15:07:48'),(6,20,1236,1,40,'complete','decline','freelancer','2026-04-05 19:43:07','2026-04-05 19:43:07'),(7,25,1236,1,1000,'complete','iptal','freelancer','2026-04-06 15:24:02','2026-04-06 15:24:02'),(8,38,1236,1,498,'complete','decline','freelancer','2026-04-22 15:27:40','2026-04-22 15:27:40'),(9,39,1236,1,399,'complete','decline','freelancer','2026-04-22 18:05:36','2026-04-22 18:05:36'),(10,40,1236,1,399,'complete','decline','freelancer','2026-04-22 18:11:08','2026-04-22 18:11:08'),(11,53,1236,1,1000,'complete','decline','freelancer','2026-04-23 19:06:33','2026-04-23 19:06:33'),(12,55,1236,1,1000,'complete','decline','freelancer','2026-04-23 19:06:53','2026-04-23 19:06:53'),(13,54,1236,1,1000,'complete','decline','freelancer','2026-04-23 19:07:02','2026-04-23 19:07:02'),(14,68,1236,1,40,'complete','decline','freelancer','2026-04-25 07:59:41','2026-04-25 07:59:41'),(15,71,1236,1,1000,'complete','decline','freelancer','2026-04-25 13:12:27','2026-04-25 13:12:27'),(16,70,1236,1,1000,'complete','decline','freelancer','2026-04-25 13:12:51','2026-04-25 13:12:51'),(17,69,1236,1,1000,'complete','decline','freelancer','2026-04-25 13:13:01','2026-04-25 13:13:01'),(18,32,1,1,9,'complete','decline','freelancer','2026-04-26 14:28:57','2026-04-26 14:28:57'),(19,73,1,1236,9,'complete','decline','freelancer','2026-04-27 09:16:54','2026-04-27 09:16:54'),(20,75,1236,1,40,'complete','decline','freelancer','2026-04-28 08:35:34','2026-04-28 08:35:34'),(21,78,1236,1,1000,'complete','decline','freelancer','2026-05-04 12:45:35','2026-05-04 12:45:35');
/*!40000 ALTER TABLE `order_decline_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_decline_wallet_histories`
--

DROP TABLE IF EXISTS `order_decline_wallet_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_decline_wallet_histories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) NOT NULL,
  `freelancer_id` bigint(20) NOT NULL,
  `client_id` bigint(20) NOT NULL,
  `order_price` double NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `cancel_or_decline` varchar(255) DEFAULT NULL,
  `cancel_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_decline_wallet_histories`
--

LOCK TABLES `order_decline_wallet_histories` WRITE;
/*!40000 ALTER TABLE `order_decline_wallet_histories` DISABLE KEYS */;
INSERT INTO `order_decline_wallet_histories` VALUES (1,5,1236,1,40,'complete','reddet','freelancer','2026-04-02 15:02:07','2026-04-02 15:02:07'),(2,12,1236,1,40,'complete','reddet','freelancer','2026-04-02 17:22:35','2026-04-02 17:22:35'),(3,15,1236,1,40,'complete','reddet','freelancer','2026-04-05 11:45:18','2026-04-05 11:45:18'),(4,16,1236,1,40,'complete','reddet','freelancer','2026-04-05 11:49:11','2026-04-05 11:49:11'),(5,19,1236,1,1000,'complete','reddet','freelancer','2026-04-05 15:07:48','2026-04-05 15:07:48'),(6,20,1236,1,40,'complete','decline','freelancer','2026-04-05 19:43:07','2026-04-05 19:43:07'),(7,25,1236,1,1000,'complete','iptal','freelancer','2026-04-06 15:24:02','2026-04-06 15:24:02'),(8,38,1236,1,498,'complete','decline','freelancer','2026-04-22 15:27:40','2026-04-22 15:27:40'),(9,39,1236,1,399,'complete','decline','freelancer','2026-04-22 18:05:36','2026-04-22 18:05:36'),(10,40,1236,1,399,'complete','decline','freelancer','2026-04-22 18:11:08','2026-04-22 18:11:08'),(11,53,1236,1,1000,'complete','decline','freelancer','2026-04-23 19:06:33','2026-04-23 19:06:33'),(12,55,1236,1,1000,'complete','decline','freelancer','2026-04-23 19:06:53','2026-04-23 19:06:53'),(13,54,1236,1,1000,'complete','decline','freelancer','2026-04-23 19:07:02','2026-04-23 19:07:02'),(14,68,1236,1,40,'complete','decline','freelancer','2026-04-25 07:59:41','2026-04-25 07:59:41'),(15,71,1236,1,1000,'complete','decline','freelancer','2026-04-25 13:12:27','2026-04-25 13:12:27'),(16,70,1236,1,1000,'complete','decline','freelancer','2026-04-25 13:12:51','2026-04-25 13:12:51'),(17,69,1236,1,1000,'complete','decline','freelancer','2026-04-25 13:13:01','2026-04-25 13:13:01'),(18,32,1,1,9,'complete','decline','freelancer','2026-04-26 14:28:57','2026-04-26 14:28:57'),(19,73,1,1236,9,'complete','decline','freelancer','2026-04-27 09:16:54','2026-04-27 09:16:54'),(20,75,1236,1,40,'complete','decline','freelancer','2026-04-28 08:35:34','2026-04-28 08:35:34'),(21,78,1236,1,1000,'complete','decline','freelancer','2026-05-04 12:45:35','2026-05-04 12:45:35');
/*!40000 ALTER TABLE `order_decline_wallet_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_milestones`
--

DROP TABLE IF EXISTS `order_milestones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_milestones` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` double NOT NULL,
  `deadline` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=pending, 1=active, 2=complete, 3=cancel',
  `revision` int(11) NOT NULL DEFAULT 0,
  `revision_left` int(11) NOT NULL DEFAULT 0,
  `attachment` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_milestones`
--

LOCK TABLES `order_milestones` WRITE;
/*!40000 ALTER TABLE `order_milestones` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_milestones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_request_revisions`
--

DROP TABLE IF EXISTS `order_request_revisions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_request_revisions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) NOT NULL,
  `order_submit_history_id` bigint(20) DEFAULT NULL,
  `milestone_id` int(11) DEFAULT NULL,
  `description` blob DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_request_revisions`
--

LOCK TABLES `order_request_revisions` WRITE;
/*!40000 ALTER TABLE `order_request_revisions` DISABLE KEYS */;
INSERT INTO `order_request_revisions` VALUES (1,18,2,NULL,_binary 'İstediğim gibi olmadı','2026-04-05 12:33:59','2026-04-05 12:33:59'),(2,21,4,NULL,_binary 'Kabul edilmedi','2026-04-05 19:53:33','2026-04-05 19:53:33'),(3,30,7,NULL,NULL,'2026-04-16 12:46:25','2026-04-16 12:46:25');
/*!40000 ALTER TABLE `order_request_revisions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_screenshots`
--

DROP TABLE IF EXISTS `order_screenshots`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_screenshots` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_screenshots`
--

LOCK TABLES `order_screenshots` WRITE;
/*!40000 ALTER TABLE `order_screenshots` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_screenshots` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_submit_histories`
--

DROP TABLE IF EXISTS `order_submit_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_submit_histories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) NOT NULL,
  `order_milestone_id` bigint(20) DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=pending, 1=approve, 2=request revision,',
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_submit_histories`
--

LOCK TABLES `order_submit_histories` WRITE;
/*!40000 ALTER TABLE `order_submit_histories` DISABLE KEYS */;
INSERT INTO `order_submit_histories` VALUES (1,17,NULL,NULL,1,'Başarılı şekilde bitirildi','2026-04-05 12:15:49','2026-04-05 12:16:51'),(2,18,NULL,NULL,2,'Başarıyla teslim edildi','2026-04-05 12:26:22','2026-04-05 12:33:59'),(3,18,NULL,NULL,1,'Revizyona göre teslim edildi','2026-04-05 12:34:27','2026-04-05 12:36:56'),(4,21,NULL,NULL,2,'Teslim edildi','2026-04-05 19:50:57','2026-04-05 19:53:33'),(5,21,NULL,NULL,1,'Gönderidli','2026-04-05 19:53:57','2026-04-05 19:54:20'),(6,26,NULL,NULL,1,'Başarıyla teslim edildi','2026-04-06 15:33:11','2026-04-06 15:33:36'),(7,30,NULL,NULL,2,'Ben işi yaptım abi paramı verinfggggyggjygtghuuuhhjjj','2026-04-16 12:45:48','2026-04-16 12:46:25'),(8,30,NULL,NULL,1,'Bshshsijshshdhhshshhshshshdhhdhshshshshsbbdhdhdhdjjdjdjdjdjdjdj','2026-04-16 12:48:26','2026-04-16 12:48:49'),(9,72,NULL,'order_attachment_1777146573.pdf',1,'Teslim edildi','2026-04-25 16:49:33','2026-04-25 16:51:19'),(10,74,NULL,NULL,1,'teslim ettim','2026-04-28 05:51:57','2026-04-28 05:52:11');
/*!40000 ALTER TABLE `order_submit_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_work_histories`
--

DROP TABLE IF EXISTS `order_work_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_work_histories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `freelancer_id` int(11) NOT NULL,
  `job_id` int(11) DEFAULT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `only_start_date` date DEFAULT NULL,
  `only_end_date` date DEFAULT NULL,
  `hours_worked` time NOT NULL,
  `seconds` int(11) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_work_histories`
--

LOCK TABLES `order_work_histories` WRITE;
/*!40000 ALTER TABLE `order_work_histories` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_work_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) NOT NULL COMMENT 'client id',
  `freelancer_id` bigint(20) NOT NULL,
  `order_type` varchar(255) DEFAULT NULL,
  `identity` bigint(20) NOT NULL COMMENT 'project_id or job_id',
  `is_project_job` varchar(255) NOT NULL COMMENT 'project or job',
  `is_basic_standard_premium_custom` varchar(255) DEFAULT NULL COMMENT 'project type',
  `is_fixed_hourly` varchar(255) DEFAULT NULL COMMENT 'fixed or hourly',
  `is_custom` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1=custom',
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=pending, 1=active, 2=delivered, 3=complete, 4=cancel, 5=decline by frl, 6=suspend by ad, 7=hold by ad',
  `email_send` varchar(255) DEFAULT NULL,
  `status_before_hold` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=not hold , 1=hold',
  `revision` varchar(255) DEFAULT NULL,
  `revision_left` int(11) NOT NULL DEFAULT 0,
  `delivery_time` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `price` double NOT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `conversion_rate` double DEFAULT NULL,
  `symbol` varchar(255) DEFAULT NULL,
  `commission_type` varchar(255) NOT NULL,
  `commission_charge` double NOT NULL,
  `commission_amount` double NOT NULL DEFAULT 0,
  `transaction_type` varchar(255) DEFAULT NULL,
  `transaction_charge` double NOT NULL DEFAULT 0,
  `transaction_amount` double NOT NULL DEFAULT 0,
  `payable_amount` double NOT NULL DEFAULT 0,
  `refund_amount` double NOT NULL DEFAULT 0,
  `refund_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=pending, 1=paid',
  `total_hour` double DEFAULT NULL,
  `payment_gateway` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `is_valid_payment` varchar(255) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `manual_payment_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `appointment_time` varchar(255) DEFAULT NULL,
  `service_address` text DEFAULT NULL,
  `city_id` bigint(20) unsigned DEFAULT NULL,
  `state_id` bigint(20) unsigned DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_invoice_no_unique` (`invoice_no`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,NULL,1,1236,NULL,193,'project','Basic',NULL,0,0,NULL,0,'1',1,'1 Days','Test test test',40.8,NULL,NULL,NULL,'percentage',21,8.4,'percentage',2,0.8,31.6,0,0,NULL,'iyzipay','pending',NULL,NULL,NULL,'2026-04-02 09:22:43','2026-04-02 09:22:43','2026-04-02','13:00 - 15:00','Test mahalle',24,21,'5418553983'),(2,NULL,1,1236,NULL,193,'project','Basic',NULL,0,0,NULL,0,'1',1,'1 Days','Test açıklaması',40.8,NULL,NULL,NULL,'percentage',21,8.4,'percentage',2,0.8,31.6,0,0,NULL,'iyzipay','pending',NULL,NULL,NULL,'2026-04-02 09:23:11','2026-04-02 09:23:11','2026-04-02','15:00 - 17:00','Test mahalle',24,21,'5418553983'),(3,NULL,1,1236,NULL,193,'project','Basic',NULL,0,0,NULL,0,'1',1,'1 Days','Test',40.8,NULL,NULL,NULL,'percentage',21,8.4,'percentage',2,0.8,31.6,0,0,NULL,'iyzipay','pending',NULL,NULL,NULL,'2026-04-02 09:29:43','2026-04-02 09:29:43','2026-04-02','13:00 - 15:00','Test mahalle',24,21,'5418553983'),(4,NULL,1,1236,NULL,193,'project','Basic',NULL,0,0,NULL,0,'1',1,'1 Days','Test',40.8,NULL,NULL,NULL,'percentage',21,8.4,'percentage',2,0.8,31.6,0,0,NULL,'iyzipay','pending',NULL,NULL,NULL,'2026-04-02 09:38:04','2026-04-02 09:38:04','2026-04-02','17:00 - 19:00','Test mahalle',24,21,'5418553983'),(5,NULL,1,1236,NULL,193,'project','Basic',NULL,0,4,NULL,0,'1',1,'1 Days','Test',40,NULL,NULL,NULL,'percentage',21,8.4,'percentage',2,0.8,31.6,0,0,NULL,'iyzipay','complete',NULL,'29229864',NULL,'2026-04-02 09:43:12','2026-04-02 15:02:07','2026-04-02','15:00 - 17:00','Test mahalle',24,21,'5418553983'),(6,NULL,1,1236,NULL,193,'project','Basic',NULL,0,0,NULL,0,'1',1,'1 Days',NULL,40.8,NULL,NULL,NULL,'percentage',21,8.4,'percentage',2,0.8,31.6,0,0,NULL,'iyzipay','pending',NULL,NULL,NULL,'2026-04-02 15:00:46','2026-04-02 15:00:46',NULL,NULL,NULL,NULL,NULL,NULL),(7,NULL,1,1236,NULL,193,'project','Basic',NULL,0,0,NULL,0,'1',1,'1 Days',NULL,40.8,NULL,NULL,NULL,'percentage',21,8.4,'percentage',2,0.8,31.6,0,0,NULL,'iyzipay','pending',NULL,NULL,NULL,'2026-04-02 17:01:54','2026-04-02 17:01:54',NULL,NULL,NULL,NULL,NULL,NULL),(8,NULL,1,1236,NULL,193,'project','Basic',NULL,0,0,NULL,0,'1',1,'1 Days',NULL,40.8,NULL,NULL,NULL,'percentage',21,8.4,'percentage',2,0.8,31.6,0,0,NULL,'iyzipay','pending',NULL,NULL,NULL,'2026-04-02 17:06:41','2026-04-02 17:06:41',NULL,NULL,NULL,NULL,NULL,NULL),(9,NULL,1,1236,NULL,193,'project','Basic',NULL,0,0,NULL,0,'1',1,'1 Days',NULL,40.8,NULL,NULL,NULL,'percentage',21,8.4,'percentage',2,0.8,31.6,0,0,NULL,'iyzipay','pending',NULL,NULL,NULL,'2026-04-02 17:07:40','2026-04-02 17:07:40',NULL,NULL,NULL,NULL,NULL,NULL),(10,NULL,1,1236,NULL,193,'project','Basic',NULL,0,0,NULL,0,'1',1,'1 Days',NULL,40.8,NULL,NULL,NULL,'percentage',21,8.4,'percentage',2,0.8,31.6,0,0,NULL,'iyzipay','pending',NULL,NULL,NULL,'2026-04-02 17:10:09','2026-04-02 17:10:09',NULL,NULL,NULL,NULL,NULL,NULL),(11,NULL,1,1236,NULL,193,'project','Basic',NULL,0,0,NULL,0,'1',1,'1 Days',NULL,40.8,NULL,NULL,NULL,'percentage',21,8.4,'percentage',2,0.8,31.6,0,0,NULL,'iyzipay','pending',NULL,NULL,NULL,'2026-04-02 17:13:15','2026-04-02 17:13:15',NULL,NULL,NULL,NULL,NULL,NULL),(12,NULL,1,1236,NULL,193,'project','Basic',NULL,0,4,NULL,0,'1',1,'1 Days',NULL,40,NULL,NULL,NULL,'percentage',21,8.4,'percentage',2,0.8,31.6,0,0,NULL,'iyzipay','complete',NULL,NULL,NULL,'2026-04-02 17:15:36','2026-04-02 17:22:35',NULL,NULL,NULL,NULL,NULL,NULL),(13,NULL,1,1236,NULL,193,'project','Basic',NULL,0,0,NULL,0,'1',1,'1 Days',NULL,40.8,NULL,NULL,NULL,'percentage',21,8.4,'percentage',2,0.8,31.6,0,0,NULL,'iyzipay','pending',NULL,NULL,NULL,'2026-04-02 17:21:36','2026-04-02 17:21:36',NULL,NULL,NULL,NULL,NULL,NULL),(14,NULL,1,1236,NULL,193,'project','Basic',NULL,0,0,NULL,0,'1',1,'1 Days',NULL,40.8,NULL,NULL,NULL,'percentage',21,8.4,'percentage',2,0.8,31.6,0,0,NULL,'iyzipay','pending',NULL,NULL,NULL,'2026-04-02 17:23:12','2026-04-02 17:23:12',NULL,NULL,NULL,NULL,NULL,NULL),(15,NULL,1,1236,NULL,193,'project','Basic',NULL,0,4,NULL,0,'1',1,'1 Days',NULL,40,NULL,NULL,NULL,'percentage',21,8.4,'percentage',2,0.8,31.6,0,0,NULL,'iyzipay','complete',NULL,NULL,NULL,'2026-04-02 17:24:38','2026-04-05 11:45:18',NULL,NULL,NULL,NULL,NULL,NULL),(16,NULL,1,1236,NULL,193,'project','Basic',NULL,0,4,NULL,0,'1',1,'1 Days',NULL,40,NULL,NULL,NULL,'percentage',21,8.4,'percentage',2,0.8,31.6,0,0,NULL,'iyzipay','complete',NULL,'29399533',NULL,'2026-04-05 11:48:02','2026-04-05 11:49:11','2026-04-05','15:00 - 17:00','Test',24,21,'5418553983'),(17,'INV-20260405-000017',1,1236,NULL,194,'project','Basic',NULL,0,3,NULL,0,'1',1,'1 Days',NULL,100,NULL,NULL,NULL,'percentage',21,21,'percentage',2,2,79,0,0,NULL,'iyzipay','complete',NULL,'29399760',NULL,'2026-04-05 12:03:35','2026-04-05 12:18:21','2026-04-05','15:00 - 17:00','test',24,21,'5418553983'),(18,'INV-20260405-000018',1,1236,NULL,194,'project','Basic',NULL,0,3,NULL,0,'1',0,'1 Days',NULL,100,NULL,NULL,NULL,'percentage',21,21,'percentage',2,2,79,0,0,NULL,'iyzipay','complete',NULL,'29399863',NULL,'2026-04-05 12:22:13','2026-04-05 12:38:29',NULL,NULL,NULL,NULL,NULL,NULL),(19,NULL,1,1236,NULL,2,'offer','offer',NULL,0,4,NULL,0,'1',1,'2 Days',NULL,1000,NULL,NULL,NULL,'percentage',21,210,'percentage',2,20,790,0,0,NULL,'iyzipay','complete',NULL,'29401250',NULL,'2026-04-05 15:06:34','2026-04-05 15:07:48',NULL,NULL,NULL,NULL,NULL,NULL),(20,NULL,1,1236,NULL,193,'project','Basic',NULL,0,5,NULL,0,'1',1,'1 Days',NULL,40,NULL,NULL,NULL,'percentage',21,8.4,'percentage',2,0,31.6,0,0,NULL,'wallet','complete',NULL,NULL,NULL,'2026-04-05 18:56:37','2026-04-05 19:43:07','2026-04-06','11:00 - 13:00','Test',24,21,'5418553983'),(21,'INV-20260405-000021',1,1236,NULL,199,'project','Basic',NULL,0,3,NULL,0,'4',3,'1 Days',NULL,9,NULL,NULL,NULL,'percentage',21,1.89,'percentage',2,0,7.11,0,0,NULL,'wallet','complete',NULL,NULL,NULL,'2026-04-05 19:44:31','2026-04-06 14:10:01','2026-04-06','15:00 - 17:00','Test',24,21,'5418553983'),(22,NULL,1,1236,NULL,4,'offer','offer',NULL,0,0,NULL,0,'1',1,'2026-04-06',NULL,1020,NULL,NULL,NULL,'percentage',21,210,'percentage',2,20,790,0,0,NULL,'iyzipay','pending',NULL,NULL,NULL,'2026-04-06 15:02:55','2026-04-06 15:02:55',NULL,NULL,NULL,NULL,NULL,NULL),(23,NULL,1,1236,NULL,4,'offer','offer',NULL,0,0,NULL,0,'1',1,'2026-04-06',NULL,1020,NULL,NULL,NULL,'percentage',21,210,'percentage',2,20,790,0,0,NULL,'iyzipay','pending',NULL,NULL,NULL,'2026-04-06 15:05:01','2026-04-06 15:05:01',NULL,NULL,NULL,NULL,NULL,NULL),(24,NULL,1,1236,NULL,5,'offer','offer',NULL,0,0,NULL,0,'1',1,'1 Days',NULL,1020,NULL,NULL,NULL,'percentage',21,210,'percentage',2,20,790,0,0,NULL,'iyzipay','pending',NULL,NULL,NULL,'2026-04-06 15:12:01','2026-04-06 15:12:01',NULL,NULL,NULL,NULL,NULL,NULL),(25,NULL,1,1236,NULL,6,'offer','offer',NULL,0,4,NULL,0,'1',1,'1 Days',NULL,1000,NULL,NULL,NULL,'percentage',21,210,'percentage',2,20,790,0,0,NULL,'iyzipay','complete',NULL,'29438838',NULL,'2026-04-06 15:23:03','2026-04-06 15:24:02',NULL,NULL,NULL,NULL,NULL,NULL),(26,NULL,1,1236,NULL,7,'offer','offer',NULL,0,3,NULL,0,'1',1,'1 Days','&nbsp;Açıklama test ediyorum Açıklama test ediyorum Açıklama test ediyorum Açıklama test ediyorum',1000,NULL,NULL,NULL,'percentage',21,210,'percentage',2,20,790,0,0,NULL,'iyzipay','complete',NULL,'29439367',NULL,'2026-04-06 15:31:53','2026-04-06 15:33:36',NULL,NULL,NULL,NULL,NULL,NULL),(27,NULL,1237,1236,NULL,199,'project','Basic',NULL,0,0,NULL,0,'4',4,'1 Days',NULL,9.18,NULL,NULL,NULL,'percentage',21,1.89,'percentage',2,0.18,7.11,0,0,NULL,'iyzipay','pending',NULL,NULL,NULL,'2026-04-16 12:15:06','2026-04-16 12:15:06',NULL,NULL,NULL,NULL,NULL,NULL),(28,NULL,1,1236,NULL,204,'project','Basic',NULL,0,0,NULL,0,'4',4,'2 Days',NULL,1020,NULL,NULL,NULL,'percentage',21,210,'percentage',2,20,790,0,0,NULL,'iyzipay','pending',NULL,NULL,NULL,'2026-04-16 12:19:19','2026-04-16 12:19:19',NULL,NULL,NULL,NULL,NULL,NULL),(29,NULL,1,1236,NULL,204,'project','Basic',NULL,0,0,NULL,0,'4',4,'2 Days','jsjdjdjjdjdjdj',1020,NULL,NULL,NULL,'percentage',21,210,'percentage',2,20,790,0,0,NULL,'iyzipay','pending',NULL,NULL,NULL,'2026-04-16 12:20:25','2026-04-16 12:20:25',NULL,NULL,NULL,NULL,NULL,NULL),(30,NULL,1237,1,NULL,207,'project','Basic',NULL,0,3,NULL,0,'4',3,'1 Days',NULL,9,NULL,NULL,NULL,'percentage',21,1.89,'percentage',2,0.18,7.11,0,0,NULL,'iyzipay','complete',NULL,'30114637',NULL,'2026-04-16 12:42:16','2026-04-16 12:48:49',NULL,NULL,NULL,NULL,NULL,NULL),(31,NULL,1,1236,NULL,8,'offer','offer',NULL,0,0,NULL,0,'1',1,'2026-04-16','<p>Geliyorummmmmmömmmm</p>',1028.16,NULL,NULL,NULL,'percentage',21,211.68,'percentage',2,20.16,796.32,0,0,NULL,'iyzipay','pending',NULL,NULL,NULL,'2026-04-16 13:14:27','2026-04-16 13:14:27',NULL,NULL,NULL,NULL,NULL,NULL),(32,NULL,1,1,NULL,207,'project','Basic',NULL,0,5,NULL,0,'4',4,'1 Days',NULL,9,NULL,NULL,NULL,'percentage',21,1.89,'percentage',2,0.18,7.11,0,0,NULL,'iyzipay','complete',NULL,'30758640',NULL,'2026-04-21 17:32:26','2026-04-26 14:28:57',NULL,NULL,NULL,NULL,NULL,NULL),(33,NULL,1,1,NULL,207,'project','Basic',NULL,0,0,NULL,0,'4',4,'1 Days',NULL,9.18,NULL,NULL,NULL,'percentage',21,1.89,'percentage',2,0.18,7.11,0,0,NULL,'iyzipay','pending',NULL,NULL,NULL,'2026-04-21 17:33:00','2026-04-21 17:33:00',NULL,NULL,NULL,NULL,NULL,NULL),(34,NULL,1,1,NULL,207,'project','Basic',NULL,0,0,NULL,0,'4',4,'1 Days','test',9.18,NULL,NULL,NULL,'percentage',21,1.89,'percentage',2,0.18,7.11,0,0,NULL,'iyzipay','pending',NULL,NULL,NULL,'2026-04-22 14:16:56','2026-04-22 14:16:56',NULL,NULL,NULL,NULL,NULL,NULL),(35,NULL,1,1,NULL,207,'project','Basic',NULL,0,0,NULL,0,'4',4,'1 Days',NULL,9.18,NULL,NULL,NULL,'percentage',21,1.89,'percentage',2,0.18,7.11,0,0,NULL,'iyzipay','pending',NULL,NULL,NULL,'2026-04-22 14:23:06','2026-04-22 14:23:06',NULL,NULL,NULL,NULL,NULL,NULL),(36,NULL,1236,1,NULL,207,'project','Basic',NULL,0,0,NULL,0,'4',4,'1 Days','test',9.18,NULL,NULL,NULL,'percentage',21,1.89,'percentage',2,0.18,7.11,0,0,NULL,'iyzipay','pending',NULL,NULL,NULL,'2026-04-22 14:29:58','2026-04-22 14:29:58',NULL,NULL,NULL,NULL,NULL,NULL),(37,NULL,1,1236,NULL,9,'offer','offer',NULL,0,0,NULL,0,'1',1,'2026-04-30','<p>Sipariş açıklaması şöyle olacak böyle olacak</p>',508.98,NULL,NULL,NULL,'percentage',21,104.79,'percentage',2,9.98,394.21,0,0,NULL,'iyzipay','pending',NULL,NULL,NULL,'2026-04-22 14:32:46','2026-04-22 14:32:46',NULL,NULL,NULL,NULL,NULL,NULL),(38,NULL,1,1236,NULL,10,'offer','offer',NULL,0,5,NULL,0,'1',1,'2026-04-22','<p>O bu şu yapılacak</p>',498,NULL,NULL,NULL,'percentage',21,104.58,'percentage',2,9.96,393.42,0,0,NULL,'iyzipay','complete',NULL,'30876261',NULL,'2026-04-22 15:26:28','2026-04-22 15:27:40',NULL,NULL,NULL,NULL,NULL,NULL),(39,NULL,1,1236,NULL,199,'project','Basic',NULL,0,5,NULL,0,'4',4,'1 Days',NULL,399,NULL,NULL,NULL,'percentage',21,83.79,'percentage',2,7.98,315.21,0,0,NULL,'iyzipay','complete',NULL,'30889743',NULL,'2026-04-22 18:01:14','2026-04-22 18:05:36',NULL,NULL,NULL,NULL,NULL,NULL),(40,NULL,1,1236,NULL,199,'project','Basic',NULL,0,5,NULL,0,'4',4,'1 Days',NULL,399,NULL,NULL,NULL,'percentage',21,83.79,'percentage',2,7.98,315.21,0,0,NULL,'iyzipay','complete',NULL,'30890630',NULL,'2026-04-22 18:09:43','2026-04-22 18:11:08',NULL,NULL,NULL,NULL,NULL,NULL),(41,NULL,1,1236,NULL,204,'project','Basic',NULL,0,0,NULL,0,'4',4,'2 Days','Ben memnunum',1020,NULL,NULL,NULL,'percentage',21,210,'percentage',2,20,790,0,0,NULL,'iyzipay','pending',NULL,NULL,NULL,'2026-04-23 11:13:54','2026-04-23 11:13:54',NULL,NULL,NULL,NULL,NULL,NULL),(42,NULL,1,1236,NULL,204,'project','Basic',NULL,0,0,NULL,0,'4',4,'2 Days','heheh',1020,NULL,NULL,NULL,'percentage',21,210,'percentage',2,20,790,0,0,NULL,'iyzipay','pending',NULL,NULL,NULL,'2026-04-23 11:14:13','2026-04-23 11:14:13',NULL,NULL,NULL,NULL,NULL,NULL),(43,NULL,1,1236,NULL,204,'project','Basic',NULL,0,0,NULL,0,'4',4,'2 Days',NULL,1020,NULL,NULL,NULL,'percentage',21,210,'percentage',2,20,790,0,0,NULL,'iyzipay','pending',NULL,NULL,NULL,'2026-04-23 11:17:45','2026-04-23 11:17:45',NULL,NULL,NULL,NULL,NULL,NULL),(44,NULL,1,1236,NULL,204,'project','Basic',NULL,0,0,NULL,0,'4',4,'2 Days',NULL,1020,NULL,NULL,NULL,'percentage',21,210,'percentage',2,20,790,0,0,NULL,'iyzipay','pending',NULL,NULL,NULL,'2026-04-23 11:18:22','2026-04-23 11:18:22',NULL,NULL,NULL,NULL,NULL,NULL),(45,NULL,1,1236,NULL,204,'project','Basic',NULL,0,0,NULL,0,'4',4,'2 Days',NULL,1020,NULL,NULL,NULL,'percentage',21,210,'percentage',2,20,790,0,0,NULL,'iyzipay','pending',NULL,NULL,NULL,'2026-04-23 11:21:28','2026-04-23 11:21:28',NULL,NULL,NULL,NULL,NULL,NULL),(46,NULL,1,1,NULL,207,'project','Basic',NULL,0,0,NULL,0,'4',4,'1 Days',NULL,9.18,NULL,NULL,NULL,'percentage',21,1.89,'percentage',2,0.18,7.11,0,0,NULL,'iyzipay','pending',NULL,NULL,NULL,'2026-04-23 11:23:12','2026-04-23 11:23:12',NULL,NULL,NULL,NULL,NULL,NULL),(47,NULL,1,1236,NULL,204,'project','Basic',NULL,0,0,NULL,0,'4',4,'2 Days',NULL,1020,NULL,NULL,NULL,'percentage',21,210,'percentage',2,20,790,0,0,NULL,'iyzipay','pending',NULL,NULL,NULL,'2026-04-23 11:24:34','2026-04-23 11:24:34',NULL,NULL,NULL,NULL,NULL,NULL),(48,NULL,1,1236,NULL,204,'project','Basic',NULL,0,0,NULL,0,'4',4,'2 Days',NULL,1020,NULL,NULL,NULL,'percentage',21,210,'percentage',2,20,790,0,0,NULL,'iyzipay','pending',NULL,NULL,NULL,'2026-04-23 17:35:15','2026-04-23 17:35:15',NULL,NULL,NULL,NULL,NULL,NULL),(49,NULL,1,1236,NULL,204,'project','Basic',NULL,0,0,NULL,0,'4',4,'2 Days',NULL,1020,NULL,NULL,NULL,'percentage',21,210,'percentage',2,20,790,0,0,NULL,'iyzipay','pending',NULL,NULL,NULL,'2026-04-23 17:43:23','2026-04-23 17:43:23',NULL,NULL,NULL,NULL,NULL,NULL),(50,NULL,1,1236,NULL,204,'project','Basic',NULL,0,0,NULL,0,'4',4,'2 Days',NULL,1020,NULL,NULL,NULL,'percentage',21,210,'percentage',2,20,790,0,0,NULL,'iyzipay','pending',NULL,NULL,NULL,'2026-04-23 17:47:17','2026-04-23 17:47:17',NULL,NULL,NULL,NULL,NULL,NULL),(51,NULL,1,1236,NULL,204,'project','Basic',NULL,0,0,NULL,0,'4',4,'2 Days',NULL,1020,NULL,NULL,NULL,'percentage',21,210,'percentage',2,20,790,0,0,NULL,'iyzipay','pending',NULL,NULL,NULL,'2026-04-23 17:50:44','2026-04-23 17:50:44',NULL,NULL,NULL,NULL,NULL,NULL),(52,NULL,1,1236,NULL,204,'project','Basic',NULL,0,0,NULL,0,'4',4,'2 Days',NULL,1020,NULL,NULL,NULL,'percentage',21,210,'percentage',2,20,790,0,0,NULL,'iyzipay','pending',NULL,NULL,NULL,'2026-04-23 17:51:30','2026-04-23 17:51:30',NULL,NULL,NULL,NULL,NULL,NULL),(53,NULL,1,1236,NULL,204,'project','Basic',NULL,0,5,NULL,0,'4',4,'2 Days',NULL,1000,NULL,NULL,NULL,'percentage',21,210,'percentage',2,20,790,0,0,NULL,'iyzipay','complete',NULL,NULL,NULL,'2026-04-23 17:54:06','2026-04-23 19:06:33',NULL,NULL,NULL,NULL,NULL,NULL),(54,NULL,1,1236,NULL,204,'project','Basic',NULL,0,5,NULL,0,'4',4,'2 Days',NULL,1000,NULL,NULL,NULL,'percentage',21,210,'percentage',2,20,790,0,0,NULL,'iyzipay','complete',NULL,NULL,NULL,'2026-04-23 17:59:05','2026-04-23 19:07:02',NULL,NULL,NULL,NULL,NULL,NULL),(55,NULL,1,1236,NULL,204,'project','Basic',NULL,0,5,NULL,0,'4',4,'2 Days',NULL,1000,NULL,NULL,NULL,'percentage',21,210,'percentage',2,20,790,0,0,NULL,'iyzipay','complete',NULL,NULL,NULL,'2026-04-23 18:04:48','2026-04-23 19:06:53',NULL,NULL,NULL,NULL,NULL,NULL),(56,NULL,1,1236,NULL,199,'project','Basic',NULL,0,0,NULL,0,'4',4,'1 Days',NULL,406.98,NULL,NULL,NULL,'percentage',21,83.79,'percentage',2,7.98,315.21,0,0,NULL,'iyzipay','pending',NULL,NULL,NULL,'2026-04-23 18:26:13','2026-04-23 18:26:13',NULL,NULL,NULL,NULL,NULL,NULL),(57,NULL,1,1236,NULL,204,'project','Basic',NULL,0,0,NULL,0,'4',4,'2 Days',NULL,1020,NULL,NULL,NULL,'percentage',21,210,'percentage',2,20,790,0,0,NULL,'iyzipay','pending',NULL,NULL,NULL,'2026-04-23 18:26:39','2026-04-23 18:26:39',NULL,NULL,NULL,NULL,NULL,NULL),(58,NULL,1,1236,NULL,204,'project','Basic',NULL,0,0,NULL,0,'4',4,'2 Days',NULL,1020,NULL,NULL,NULL,'percentage',21,210,'percentage',2,20,790,0,0,NULL,'iyzipay','pending',NULL,NULL,NULL,'2026-04-23 18:31:47','2026-04-23 18:31:47',NULL,NULL,NULL,NULL,NULL,NULL),(59,NULL,1,1236,NULL,204,'project','Basic',NULL,0,0,NULL,0,'4',4,'2 Days',NULL,1020,NULL,NULL,NULL,'percentage',21,210,'percentage',2,20,790,0,0,NULL,'iyzipay','pending',NULL,NULL,NULL,'2026-04-23 18:31:58','2026-04-23 18:31:58',NULL,NULL,NULL,NULL,NULL,NULL),(60,NULL,1,1236,NULL,204,'project','Basic',NULL,0,0,NULL,0,'4',4,'2 Days',NULL,1020,NULL,NULL,NULL,'percentage',21,210,'percentage',2,20,790,0,0,NULL,'iyzipay','pending',NULL,NULL,NULL,'2026-04-23 18:32:09','2026-04-23 18:32:09',NULL,NULL,NULL,NULL,NULL,NULL),(61,NULL,1,1236,NULL,204,'project','Basic',NULL,0,0,NULL,0,'4',4,'2 Days','test',1020,NULL,NULL,NULL,'percentage',21,210,'percentage',2,20,790,0,0,NULL,'iyzipay','pending',NULL,NULL,NULL,'2026-04-23 18:33:01','2026-04-23 18:33:01',NULL,NULL,NULL,NULL,NULL,NULL),(62,NULL,1,1236,NULL,204,'project','Basic',NULL,0,0,NULL,0,'4',4,'2 Days',NULL,1020,NULL,NULL,NULL,'percentage',21,210,'percentage',2,20,790,0,0,NULL,'iyzipay','pending',NULL,NULL,NULL,'2026-04-23 19:22:01','2026-04-23 19:22:01',NULL,NULL,NULL,NULL,NULL,NULL),(63,NULL,1,1236,NULL,204,'project','Basic',NULL,0,0,NULL,0,'4',4,'2 Days',NULL,1020,NULL,NULL,NULL,'percentage',21,210,'percentage',2,20,790,0,0,NULL,'iyzipay','pending',NULL,NULL,NULL,'2026-04-23 19:35:47','2026-04-23 19:35:47',NULL,NULL,NULL,NULL,NULL,NULL),(65,NULL,1,1236,NULL,204,'project','Basic',NULL,0,0,NULL,0,'4',4,'2 Days',NULL,1020,NULL,NULL,NULL,'percentage',21,210,'percentage',2,20,790,0,0,NULL,'iyzipay','pending',NULL,NULL,NULL,'2026-04-23 19:37:11','2026-04-23 19:37:11',NULL,NULL,NULL,NULL,NULL,NULL),(66,NULL,1,1236,NULL,204,'project','Basic',NULL,0,0,NULL,0,'4',4,'2 Days',NULL,1020,NULL,NULL,NULL,'percentage',21,210,'percentage',2,20,790,0,0,NULL,'iyzipay','pending',NULL,NULL,NULL,'2026-04-23 19:37:52','2026-04-23 19:37:52',NULL,NULL,NULL,NULL,NULL,NULL),(67,NULL,1,1236,NULL,204,'project','Basic',NULL,0,1,NULL,0,'4',4,'2 Days',NULL,1000,NULL,NULL,NULL,'percentage',21,210,'percentage',2,20,790,0,0,NULL,'iyzipay','complete',NULL,NULL,NULL,'2026-04-24 15:00:02','2026-04-24 15:01:41','2026-04-26','11:0','Çamlıca mah',22,26,'5418553983'),(68,NULL,1,1236,NULL,193,'project','Basic',NULL,0,5,NULL,0,'1',1,'1 Days',NULL,40,NULL,NULL,NULL,'percentage',21,8.4,'percentage',2,0.8,31.6,0,0,NULL,'iyzipay','complete',NULL,NULL,NULL,'2026-04-25 06:07:44','2026-04-25 07:59:41','2026-04-26','0:0','Çamlıca mah',22,26,NULL),(69,NULL,1,1236,NULL,204,'project','Basic',NULL,0,5,NULL,0,'4',4,'2 Days',NULL,1000,NULL,NULL,NULL,'percentage',21,210,'percentage',2,20,790,0,0,NULL,'iyzipay','complete',NULL,NULL,NULL,'2026-04-25 12:59:11','2026-04-25 13:13:01','2026-04-26','12:0','Çamlıca mah',22,26,NULL),(70,NULL,1,1236,NULL,204,'project','Basic',NULL,0,5,NULL,0,'4',4,'2 Days',NULL,1000,NULL,NULL,NULL,'percentage',21,210,'percentage',2,20,790,0,0,NULL,'iyzipay','complete',NULL,NULL,NULL,'2026-04-25 13:03:56','2026-04-25 13:12:51','2026-04-26','12:0','Çamlıca mah',22,26,NULL),(71,NULL,1,1236,NULL,204,'project','Basic',NULL,0,5,NULL,0,'4',4,'2 Days',NULL,1000,NULL,NULL,NULL,'percentage',21,210,'percentage',2,20,790,0,0,NULL,'iyzipay','complete',NULL,NULL,NULL,'2026-04-25 13:11:27','2026-04-25 13:12:27','2026-04-26','0:0','Çamlıca mah',22,26,NULL),(72,NULL,1,1236,NULL,15,'offer','offer',NULL,0,3,NULL,0,'1',1,'2026-04-25',NULL,1000,NULL,NULL,NULL,'percentage',21,210,'percentage',2,20,790,0,0,NULL,'iyzipay','complete',NULL,NULL,NULL,'2026-04-25 16:45:19','2026-04-25 16:51:19','2026-04-26','12:0','Çamlıca mah. Ahmet Taner Kışlalı cad. Park Evleri B blok daire:1 no:57/B',22,26,NULL),(73,NULL,1236,1,NULL,207,'project','Basic',NULL,0,5,NULL,0,'4',4,'1 Gün',NULL,9,NULL,NULL,NULL,'percentage',21,1.89,'percentage',2,0.18,7.11,0,0,NULL,'iyzipay','complete',NULL,NULL,NULL,'2026-04-26 14:52:02','2026-04-27 09:16:54','2026-04-27','20:50','Çınar Pastanesi',22,26,NULL),(74,NULL,1,1236,NULL,194,'project','Basic',NULL,0,3,NULL,0,'1',1,'1 Days',NULL,300,NULL,NULL,NULL,'percentage',21,63,'percentage',2,6,237,0,0,NULL,'iyzipay','complete',NULL,NULL,NULL,'2026-04-28 05:51:19','2026-04-28 05:52:11','2026-04-29','16:0','Çamlıca mah. Ahmet Taner Kışlalı cad. Park Evleri B blok daire:1 no:57/B',22,26,NULL),(75,NULL,1,1236,NULL,193,'project','Basic',NULL,0,5,NULL,0,'1',1,'1 Days','hhh',40,NULL,NULL,NULL,'percentage',21,8.4,'percentage',2,0.8,31.6,0,0,NULL,'iyzipay','complete',NULL,NULL,NULL,'2026-04-28 08:34:51','2026-04-28 08:35:34','2026-04-30','16:15','Çamlıca mah. Ahmet Taner Kışlalı cad. Park Evleri B blok daire:1 no:57/B',22,26,NULL),(76,NULL,1,1236,NULL,204,'project','Basic',NULL,0,1,NULL,0,'4',4,'2 Days','Dfffddd',1000,NULL,NULL,NULL,'percentage',21,210,'percentage',2,20,790,0,0,NULL,'iyzipay','complete',NULL,NULL,NULL,'2026-05-04 12:43:33','2026-05-04 12:44:08','2026-05-06','18:43','Çamlıca mah. Ahmet Taner Kışlalı cad. Park Evleri B blok daire:1 no:57/B',22,26,NULL),(77,NULL,1,1236,NULL,194,'project','Basic',NULL,0,1,NULL,0,'1',1,'1 Days','ffgg',300,NULL,NULL,NULL,'percentage',21,63,'percentage',2,6,237,0,0,NULL,'iyzipay','complete',NULL,NULL,NULL,'2026-05-04 12:44:18','2026-05-04 12:44:45','2026-05-06','18:44','Çamlıca mah. Ahmet Taner Kışlalı cad. Park Evleri B blok daire:1 no:57/B',22,26,NULL),(78,NULL,1,1236,NULL,204,'project','Basic',NULL,0,5,NULL,0,'4',4,'2 Days',NULL,1000,NULL,NULL,NULL,'percentage',21,210,'percentage',2,20,790,0,0,NULL,'iyzipay','complete',NULL,NULL,NULL,'2026-05-04 12:45:06','2026-05-04 12:45:35','2026-05-30','19:44','Çamlıca mah. Ahmet Taner Kışlalı cad. Park Evleri B blok daire:1 no:57/B',22,26,NULL),(79,NULL,1,1236,NULL,194,'project','Basic',NULL,0,0,NULL,0,'1',1,'1 Gün',NULL,306,NULL,NULL,NULL,'percentage',21,63,'percentage',2,6,237,0,0,NULL,'iyzipay','pending',NULL,NULL,NULL,'2026-05-04 14:04:18','2026-05-04 14:04:18','2026-05-06','20:0','Çamlıca mah. Ahmet Taner Kışlalı cad. Park Evleri B blok daire:1 no:57/B',22,26,NULL);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page_builders`
--

DROP TABLE IF EXISTS `page_builders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `page_builders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `addon_name` varchar(255) DEFAULT NULL,
  `addon_type` varchar(255) DEFAULT NULL,
  `addon_namespace` varchar(255) DEFAULT NULL,
  `addon_location` varchar(255) DEFAULT NULL,
  `addon_order` bigint(20) unsigned DEFAULT NULL,
  `addon_page_id` bigint(20) unsigned DEFAULT NULL,
  `addon_page_type` varchar(255) DEFAULT NULL,
  `addon_settings` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page_builders`
--

LOCK TABLES `page_builders` WRITE;
/*!40000 ALTER TABLE `page_builders` DISABLE KEYS */;
INSERT INTO `page_builders` VALUES (3,'HeaderStyleOne','update','plugins\\PageBuilder\\Addons\\Header\\HeaderStyleOne','dynamic_page',1,7,'dynamic_page','a:30:{s:2:\"id\";s:1:\"3\";s:10:\"addon_name\";s:14:\"HeaderStyleOne\";s:15:\"addon_namespace\";s:64:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcSGVhZGVyXEhlYWRlclN0eWxlT25l\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"1\";s:13:\"addon_page_id\";s:1:\"7\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:38:\"Connecting Ideas with the Right Talent\";s:8:\"subtitle\";s:166:\"We make it\'s easier for talents and businesses to connect and \r\nwe make it absolutely less charges. Hire Talents or Get Hired from our platform and work independently\";s:21:\"find_work_button_text\";s:9:\"Find Work\";s:21:\"find_work_button_link\";s:12:\"projects/all\";s:24:\"find_project_button_text\";s:11:\"Find Talent\";s:24:\"find_project_button_link\";s:12:\"projects/all\";s:27:\"top_freelancer_of_the_month\";N;s:19:\"show_top_freelancer\";s:3:\"off\";s:18:\"search_placeholder\";s:36:\"Search By Services , Jobs or Talents\";s:10:\"skill_tags\";a:2:{s:9:\"tag_name_\";a:4:{i:0;s:11:\"Tesisatçı\";i:1;s:9:\"Çilingir\";i:2;s:11:\"Elektrikçi\";i:3;s:13:\"Boya & Badana\";}s:9:\"tag_link_\";a:4:{i:0;s:22:\"categories/tesisatçı\";i:1;s:20:\"categories/çilingir\";i:2;s:22:\"categories/elektrikçi\";i:3;s:24:\"categories/boya-&-badana\";}}s:18:\"info_card_one_text\";s:16:\"Complete Project\";s:18:\"info_card_one_icon\";s:3:\"283\";s:18:\"info_card_two_text\";s:17:\"Hired 41+ Talents\";s:18:\"info_card_two_icon\";s:3:\"284\";s:12:\"slider_image\";s:3:\"286\";s:15:\"shape_image_one\";s:3:\"282\";s:15:\"shape_image_two\";s:3:\"124\";s:16:\"background_image\";N;s:11:\"padding_top\";s:2:\"64\";s:14:\"padding_bottom\";s:2:\"59\";s:10:\"section_bg\";N;s:10:\"trusted_by\";a:1:{s:5:\"logo_\";a:1:{i:0;N;}}}','2023-10-26 00:25:40','2026-05-05 13:17:18'),(12,'ContactMessage','update','plugins\\PageBuilder\\Addons\\Contact\\ContactMessage','dynamic_page',1,2,'dynamic_page','a:14:{s:2:\"id\";s:2:\"12\";s:10:\"addon_name\";s:14:\"ContactMessage\";s:15:\"addon_namespace\";s:68:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcQ29udGFjdFxDb250YWN0TWVzc2FnZQ==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"1\";s:13:\"addon_page_id\";s:1:\"2\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:7:\"heading\";s:10:\"Contact Us\";s:16:\"contact_form_des\";s:90:\"Feel free to contact with us if you have any query or face any issues to use this website.\";s:12:\"contact_info\";a:3:{s:5:\"icon_\";a:4:{i:0;s:21:\"fas fa-map-marker-alt\";i:1;s:12:\"fas fa-phone\";i:2;s:15:\"fas fa-envelope\";i:3;s:12:\"fas fa-clock\";}s:6:\"title_\";a:4:{i:0;s:7:\"Address\";i:1;s:12:\"Phone Number\";i:2;s:13:\"Email Address\";i:3;s:14:\"Business Hours\";}s:12:\"description_\";a:4:{i:0;s:34:\"8502 Preston Wood, Oregon Michigan\";i:1;s:12:\"(629)5550129\";i:2;s:24:\"bill.senders@example.com\";i:3;s:26:\"(GMT +6) 10:00am - 07:00pm\";}}s:11:\"padding_top\";s:3:\"191\";s:14:\"padding_bottom\";s:3:\"190\";s:14:\"custom_form_id\";s:1:\"1\";}','2023-10-30 19:18:39','2025-12-30 06:29:45'),(13,'AboutUs','update','plugins\\PageBuilder\\Addons\\About\\AboutUs','dynamic_page',1,8,'dynamic_page','a:15:{s:2:\"id\";s:2:\"13\";s:10:\"addon_name\";s:7:\"AboutUs\";s:15:\"addon_namespace\";s:56:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcQWJvdXRcQWJvdXRVcw==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"1\";s:13:\"addon_page_id\";s:1:\"8\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:13:\"section_title\";s:44:\"Redefining Freelance Collaboration Worldwide\";s:11:\"description\";s:697:\"<p style=\"text-align: left; line-height: 1.6;\"><span style=\"font-weight: 400; font-size: 14px;\">Welcome to Xilancer, where dynamic connections between talented freelancers and visionary clients. Our platform is a vibrant marketplace designed to elevate the way innovators and clients collaborate, innovate, and succeed.</span></p><p style=\"text-align: left; line-height: 1.6;\"><span style=\"font-size: 14px;\">\r\n</span></p><p style=\"text-align: left; line-height: 1.6;\"><span style=\"font-size: 14px;\">At Xilancer, we envision a world where every project, big or small, finds its perfect match. We\'re here to break down barriers, empower creativity, and redefine the future of work.</span></p><p></p>\";s:11:\"creditility\";a:2:{s:6:\"title_\";a:1:{i:0;N;}s:12:\"description_\";a:1:{i:0;N;}}s:5:\"image\";s:3:\"287\";s:11:\"padding_top\";s:3:\"100\";s:14:\"padding_bottom\";s:3:\"100\";s:10:\"section_bg\";s:18:\"rgb(245, 245, 245)\";}','2023-11-18 00:30:12','2025-12-29 04:21:51'),(14,'WhatWeDo','update','plugins\\PageBuilder\\Addons\\About\\WhatWeDo','dynamic_page',3,8,'dynamic_page','a:16:{s:2:\"id\";s:2:\"14\";s:10:\"addon_name\";s:8:\"WhatWeDo\";s:15:\"addon_namespace\";s:56:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcQWJvdXRcV2hhdFdlRG8=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"3\";s:13:\"addon_page_id\";s:1:\"8\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:13:\"section_title\";s:11:\"What we do?\";s:8:\"subtitle\";N;s:5:\"image\";s:3:\"297\";s:10:\"video_file\";s:3:\"281\";s:5:\"stats\";a:2:{s:6:\"title_\";a:4:{i:0;s:3:\"49k\";i:1;s:4:\"$50M\";i:2;s:4:\"10k+\";i:3;s:4:\"100k\";}s:12:\"description_\";a:4:{i:0;s:31:\"Jobs we have handle in Xilancer\";i:1;s:36:\"Earned by Freelancer in Our Platform\";i:2;s:25:\"Find job by this platform\";i:3;s:19:\"Trusted Freelancers\";}}s:11:\"padding_top\";s:3:\"100\";s:14:\"padding_bottom\";s:2:\"50\";s:10:\"section_bg\";s:18:\"rgb(255, 255, 255)\";}','2023-11-18 00:32:13','2025-12-29 04:40:04'),(18,'PopularProjectOne','update','plugins\\PageBuilder\\Addons\\Project\\PopularProjectOne','dynamic_page',3,7,'dynamic_page','a:17:{s:2:\"id\";s:2:\"18\";s:10:\"addon_name\";s:17:\"PopularProjectOne\";s:15:\"addon_namespace\";s:72:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcUHJvamVjdFxQb3B1bGFyUHJvamVjdE9uZQ==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"3\";s:13:\"addon_page_id\";s:1:\"7\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:16:\"Popular Services\";s:5:\"items\";s:1:\"6\";s:9:\"pro_count\";N;s:8:\"order_by\";s:6:\"latest\";s:11:\"layout_type\";s:6:\"slider\";s:13:\"category_tags\";a:2:{s:9:\"tag_text_\";a:1:{i:0;s:16:\"Tüm Kategoriler\";}s:8:\"tag_url_\";a:1:{i:0;s:13:\"/projects/all\";}}s:11:\"padding_top\";s:2:\"50\";s:14:\"padding_bottom\";s:2:\"50\";s:10:\"section_bg\";N;}','2023-11-25 05:15:02','2026-05-05 12:36:16'),(19,'Credit','update','plugins\\PageBuilder\\Addons\\About\\Credit','dynamic_page',3,8,'dynamic_page','a:12:{s:2:\"id\";s:2:\"19\";s:10:\"addon_name\";s:6:\"Credit\";s:15:\"addon_namespace\";s:52:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcQWJvdXRcQ3JlZGl0\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"3\";s:13:\"addon_page_id\";s:1:\"8\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:6:\"credit\";a:2:{s:6:\"title_\";a:3:{i:0;s:3:\"49K\";i:1;s:4:\"$50M\";i:2;s:3:\"09X\";}s:12:\"description_\";a:3:{i:0;s:45:\"Jobs we have handled in our Xilancer platform\";i:1;s:47:\"Earned by Freelancers in our platform till date\";i:2;s:47:\"Awards received in IT for excellence in service\";}}s:11:\"padding_top\";s:2:\"50\";s:14:\"padding_bottom\";s:3:\"100\";s:10:\"section_bg\";N;}','2023-11-27 04:32:01','2024-02-19 08:44:17'),(22,'HeaderStyleTwo','update','plugins\\PageBuilder\\Addons\\Header\\HeaderStyleTwo','dynamic_page',1,10,'dynamic_page','a:19:{s:2:\"id\";s:2:\"22\";s:10:\"addon_name\";s:14:\"HeaderStyleTwo\";s:15:\"addon_namespace\";s:64:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcSGVhZGVyXEhlYWRlclN0eWxlVHdv\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"1\";s:13:\"addon_page_id\";s:2:\"10\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:31:\"Lead Change, \r\nMarket Needs You\";s:11:\"description\";s:97:\"We make it\'s easier for talents and businesses to connect and we make it absolutely less charges.\";s:18:\"search_placeholder\";s:36:\"Search By Services , Jobs or Talents\";s:15:\"user_count_text\";s:23:\"10k+ job holder get job\";s:11:\"user_images\";a:1:{s:11:\"user_image_\";a:4:{i:0;s:3:\"307\";i:1;s:3:\"308\";i:2;s:3:\"309\";i:3;s:3:\"310\";}}s:10:\"video_file\";s:3:\"281\";s:16:\"background_shape\";s:3:\"306\";s:11:\"search_tags\";a:2:{s:9:\"tag_text_\";a:3:{i:0;s:17:\"Design & Creative\";i:1;s:19:\"Website Development\";i:2;s:22:\"Mobile App Development\";}s:9:\"tag_link_\";a:3:{i:0;s:31:\"/categories/design-and-creative\";i:1;s:31:\"/categories/website-development\";i:2;s:34:\"/categories/mobile-app-development\";}}s:10:\"section_bg\";N;s:11:\"padding_top\";s:3:\"154\";s:14:\"padding_bottom\";s:3:\"145\";}','2024-06-03 14:31:10','2026-01-20 06:03:02'),(46,'ProjectPromotion','new','Modules\\SecurityManage\\Http\\PageBuilder\\Promotion\\ProjectPromotion','dynamic_page',11,10,'dynamic_page','a:12:{s:10:\"addon_name\";s:16:\"ProjectPromotion\";s:15:\"addon_namespace\";s:88:\"TW9kdWxlc1xTZWN1cml0eU1hbmFnZVxIdHRwXFBhZ2VCdWlsZGVyXFByb21vdGlvblxQcm9qZWN0UHJvbW90aW9u\";s:10:\"addon_type\";s:3:\"new\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:2:\"11\";s:13:\"addon_page_id\";s:2:\"10\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:17:\"Promoted Projects\";s:5:\"items\";s:1:\"6\";s:11:\"padding_top\";s:2:\"45\";s:14:\"padding_bottom\";s:2:\"42\";s:10:\"section_bg\";N;}','2024-07-29 15:15:25','2024-07-29 15:15:25'),(49,'CategoryJobOne','update','plugins\\PageBuilder\\Addons\\Category\\CategoryJobOne','dynamic_page',2,10,'dynamic_page','a:15:{s:2:\"id\";s:2:\"49\";s:10:\"addon_name\";s:14:\"CategoryJobOne\";s:15:\"addon_namespace\";s:68:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcQ2F0ZWdvcnlcQ2F0ZWdvcnlKb2JPbmU=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"2\";s:13:\"addon_page_id\";s:2:\"10\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:18:\"Popular Categories\";s:18:\"browse_button_text\";s:22:\"Tüm Kategorileri Gör\";s:18:\"browse_button_link\";s:10:\"categories\";s:20:\"category_custom_data\";a:3:{s:12:\"category_id_\";a:4:{i:0;N;i:1;N;i:2;s:2:\"11\";i:3;N;}s:12:\"custom_icon_\";a:4:{i:0;s:3:\"254\";i:1;s:3:\"257\";i:2;s:3:\"256\";i:3;s:3:\"255\";}s:16:\"custom_subtitle_\";a:4:{i:0;N;i:1;N;i:2;N;i:3;N;}}s:11:\"padding_top\";s:2:\"40\";s:14:\"padding_bottom\";s:2:\"40\";s:10:\"section_bg\";N;}','2025-12-24 09:51:12','2026-05-05 07:58:39'),(50,'PopularProjectOne','update','plugins\\PageBuilder\\Addons\\Project\\PopularProjectOne','dynamic_page',3,10,'dynamic_page','a:17:{s:2:\"id\";s:2:\"50\";s:10:\"addon_name\";s:17:\"PopularProjectOne\";s:15:\"addon_namespace\";s:72:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcUHJvamVjdFxQb3B1bGFyUHJvamVjdE9uZQ==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"3\";s:13:\"addon_page_id\";s:2:\"10\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:16:\"Popular Services\";s:5:\"items\";s:1:\"6\";s:9:\"pro_count\";s:1:\"3\";s:8:\"order_by\";s:6:\"latest\";s:11:\"layout_type\";s:4:\"grid\";s:13:\"category_tags\";a:2:{s:9:\"tag_text_\";a:1:{i:0;N;}s:8:\"tag_url_\";a:1:{i:0;N;}}s:11:\"padding_top\";s:3:\"260\";s:14:\"padding_bottom\";s:3:\"190\";s:10:\"section_bg\";N;}','2025-12-24 09:54:59','2026-05-05 07:59:10'),(52,'HireTheBest','update','plugins\\PageBuilder\\Addons\\HireTheBest\\HireTheBest','dynamic_page',5,10,'dynamic_page','a:14:{s:2:\"id\";s:2:\"52\";s:10:\"addon_name\";s:11:\"HireTheBest\";s:15:\"addon_namespace\";s:68:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcSGlyZVRoZUJlc3RcSGlyZVRoZUJlc3Q=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"5\";s:13:\"addon_page_id\";s:2:\"10\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:40:\"Neden Yaptırıyo\'yu Tercih Etmelisiniz?\";s:13:\"feature_cards\";a:3:{s:5:\"icon_\";a:3:{i:0;s:3:\"258\";i:1;s:3:\"259\";i:2;s:3:\"260\";}s:11:\"card_title_\";a:3:{i:0;s:29:\"Doğrulanmış Profesyoneller\";i:1;s:17:\"Güvenceli Ödeme\";i:2;s:27:\"Güvenli ve Şeffaf Süreç\";}s:17:\"card_description_\";a:3:{i:0;s:98:\"Kimlik doğrulaması yapılmış, referansları kontrol edilmiş güvenilir ustalarla çalışın.\";i:1;s:114:\"Ödemeniz, hizmet tamamlanana kadar güvende tutulur. Memnun kalmadığınız sürece ödeme serbest bırakılmaz.\";i:2;s:111:\"Anlık mesajlaşma, fotoğraflı ilerleme takibi ve güvenli ödeme sistemiyle her adımda kontrolünüz sizde.\";}}s:11:\"right_image\";s:3:\"316\";s:16:\"background_color\";s:7:\"#F8F9FD\";s:11:\"padding_top\";s:2:\"40\";s:14:\"padding_bottom\";s:2:\"40\";}','2025-12-24 09:59:43','2026-05-05 08:04:45'),(53,'TestimonialOne','update','plugins\\PageBuilder\\Addons\\Testimonial\\TestimonialOne','dynamic_page',6,10,'dynamic_page','a:16:{s:2:\"id\";s:2:\"53\";s:10:\"addon_name\";s:14:\"TestimonialOne\";s:15:\"addon_namespace\";s:72:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcVGVzdGltb25pYWxcVGVzdGltb25pYWxPbmU=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"6\";s:13:\"addon_page_id\";s:2:\"10\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:38:\"What Freelancers are Thinking About Us\";s:18:\"slider_button_text\";N;s:5:\"items\";s:1:\"6\";s:8:\"order_by\";s:6:\"latest\";s:11:\"padding_top\";s:3:\"260\";s:14:\"padding_bottom\";s:3:\"190\";s:10:\"section_bg\";N;s:16:\"background_image\";s:3:\"313\";}','2025-12-24 10:00:41','2026-01-19 06:06:23'),(54,'Mobilica','update','plugins\\PageBuilder\\Addons\\Mobilica\\Mobilica','dynamic_page',7,10,'dynamic_page','a:25:{s:2:\"id\";s:2:\"54\";s:10:\"addon_name\";s:8:\"Mobilica\";s:15:\"addon_namespace\";s:60:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcTW9iaWxpY2FcTW9iaWxpY2E=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"7\";s:13:\"addon_page_id\";s:2:\"10\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:20:\"free_app_store_title\";s:37:\"Download Xilancer \r\nClient Mobile App\";s:20:\"free_app_store_image\";s:3:\"262\";s:19:\"free_app_store_link\";s:73:\"https://play.google.com/store/apps/details?id=com.xgenious.xilancer&hl=en\";s:25:\"free_app_play_store_image\";s:3:\"263\";s:24:\"free_app_play_store_link\";s:73:\"https://play.google.com/store/apps/details?id=com.xgenious.xilancer&hl=en\";s:20:\"free_app_store_shape\";N;s:20:\"free_app_store_phone\";s:3:\"305\";s:22:\"client_app_store_title\";s:37:\"Download Xilancer \r\nClient Mobile App\";s:22:\"client_app_store_image\";s:3:\"262\";s:21:\"client_app_store_link\";s:73:\"https://play.google.com/store/apps/details?id=com.xgenious.xilancer&hl=en\";s:27:\"client_app_play_store_image\";s:3:\"263\";s:26:\"client_app_play_store_link\";s:73:\"https://play.google.com/store/apps/details?id=com.xgenious.xilancer&hl=en\";s:22:\"client_app_store_shape\";N;s:22:\"client_app_store_phone\";s:3:\"305\";s:11:\"padding_top\";s:3:\"234\";s:14:\"padding_bottom\";s:3:\"121\";s:10:\"section_bg\";N;}','2025-12-24 10:03:21','2026-01-25 11:01:43'),(55,'LatestProject','new','plugins\\PageBuilder\\Addons\\Project\\LatestProject','dynamic_page',8,10,'dynamic_page','a:14:{s:10:\"addon_name\";s:13:\"LatestProject\";s:15:\"addon_namespace\";s:64:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcUHJvamVjdFxMYXRlc3RQcm9qZWN0\";s:10:\"addon_type\";s:3:\"new\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"8\";s:13:\"addon_page_id\";s:2:\"10\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:17:\"Trending Projects\";s:5:\"items\";s:2:\"10\";s:9:\"pro_count\";N;s:8:\"order_by\";s:6:\"latest\";s:11:\"padding_top\";s:2:\"40\";s:14:\"padding_bottom\";s:2:\"40\";s:10:\"section_bg\";N;}','2025-12-24 10:04:34','2025-12-24 10:04:34'),(56,'HowItWorks','update','plugins\\PageBuilder\\Addons\\HowItWorks\\HowItWorks','dynamic_page',9,10,'dynamic_page','a:15:{s:2:\"id\";s:2:\"56\";s:10:\"addon_name\";s:10:\"HowItWorks\";s:15:\"addon_namespace\";s:64:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcSG93SXRXb3Jrc1xIb3dJdFdvcmtz\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"9\";s:13:\"addon_page_id\";s:2:\"10\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:13:\"section_title\";s:12:\"How It Works\";s:5:\"steps\";a:3:{s:5:\"icon_\";a:4:{i:0;s:3:\"267\";i:1;s:3:\"268\";i:2;s:3:\"269\";i:3;s:3:\"270\";}s:6:\"title_\";a:4:{i:0;s:14:\"Post a Project\";i:1;s:13:\"Get Proposals\";i:2;s:15:\"Hire Freelancer\";i:3;s:13:\"Get Work Done\";}s:12:\"description_\";a:4:{i:0;s:36:\"Choose your project and requirements\";i:1;s:43:\"Receive proposals form qualified freelancer\";i:2;s:42:\"Select the best freelancer for your needs.\";i:3;s:43:\"Collaborate and get your project completed.\";}}s:11:\"padding_top\";s:1:\"0\";s:14:\"padding_bottom\";s:2:\"18\";s:10:\"section_bg\";s:7:\"#F8F9FD\";s:7:\"card_bg\";s:7:\"#FFFFFF\";s:7:\"icon_bg\";s:7:\"#E6F7F7\";}','2025-12-24 10:07:11','2026-01-07 11:33:01'),(57,'CategoryProjectOne','update','plugins\\PageBuilder\\Addons\\Category\\CategoryProjectOne','dynamic_page',10,10,'dynamic_page','a:15:{s:2:\"id\";s:2:\"57\";s:10:\"addon_name\";s:18:\"CategoryProjectOne\";s:15:\"addon_namespace\";s:72:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcQ2F0ZWdvcnlcQ2F0ZWdvcnlQcm9qZWN0T25l\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:2:\"10\";s:13:\"addon_page_id\";s:2:\"10\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:28:\"Browse Service by Categories\";s:20:\"view_all_button_text\";s:17:\"View all services\";s:20:\"view_all_button_link\";s:12:\"projects/all\";s:20:\"category_custom_data\";a:2:{s:12:\"category_id_\";a:5:{i:0;s:1:\"2\";i:1;s:1:\"4\";i:2;s:1:\"1\";i:3;s:2:\"13\";i:4;s:1:\"9\";}s:17:\"background_image_\";a:5:{i:0;s:3:\"271\";i:1;s:3:\"274\";i:2;s:3:\"273\";i:3;s:3:\"275\";i:4;s:3:\"271\";}}s:11:\"padding_top\";s:2:\"40\";s:14:\"padding_bottom\";s:2:\"40\";s:10:\"section_bg\";N;}','2025-12-24 10:10:30','2025-12-24 11:28:25'),(58,'ProfilePromotion','update','Modules\\PromoteFreelancer\\Http\\PageBuilder\\Promotion\\ProfilePromotion','dynamic_page',11,10,'dynamic_page','a:15:{s:2:\"id\";s:2:\"58\";s:10:\"addon_name\";s:16:\"ProfilePromotion\";s:15:\"addon_namespace\";s:92:\"TW9kdWxlc1xQcm9tb3RlRnJlZWxhbmNlclxIdHRwXFBhZ2VCdWlsZGVyXFByb21vdGlvblxQcm9maWxlUHJvbW90aW9u\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:2:\"11\";s:13:\"addon_page_id\";s:2:\"10\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:21:\"Top Rated Freelancers\";s:18:\"browse_button_text\";s:10:\"Browse all\";s:18:\"browse_button_link\";s:40:\"http://xilancer.xgenious.com/talents/all\";s:5:\"items\";s:1:\"3\";s:11:\"padding_top\";s:2:\"40\";s:14:\"padding_bottom\";s:2:\"40\";s:10:\"section_bg\";N;}','2025-12-24 10:12:53','2025-12-24 10:47:37'),(59,'GetStarted2','update','plugins\\PageBuilder\\Addons\\GetStarted\\GetStarted2','dynamic_page',12,10,'dynamic_page','a:17:{s:2:\"id\";s:2:\"59\";s:10:\"addon_name\";s:11:\"GetStarted2\";s:15:\"addon_namespace\";s:68:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcR2V0U3RhcnRlZFxHZXRTdGFydGVkMg==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:2:\"12\";s:13:\"addon_page_id\";s:2:\"10\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:11:\"Get Started\";s:8:\"subtitle\";N;s:11:\"button_text\";s:7:\"Join Us\";s:11:\"button_link\";s:5:\"login\";s:16:\"decorative_image\";s:3:\"276\";s:13:\"gradient_from\";s:25:\"rgba(111, 227, 181, 0.11)\";s:11:\"gradient_to\";s:24:\"rgba(222, 175, 64, 0.23)\";s:11:\"padding_top\";s:2:\"40\";s:14:\"padding_bottom\";s:2:\"40\";}','2025-12-24 10:14:40','2026-01-07 11:31:20'),(61,'HireTheBest','update','plugins\\PageBuilder\\Addons\\HireTheBest\\HireTheBest','dynamic_page',5,7,'dynamic_page','a:14:{s:2:\"id\";s:2:\"61\";s:10:\"addon_name\";s:11:\"HireTheBest\";s:15:\"addon_namespace\";s:68:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcSGlyZVRoZUJlc3RcSGlyZVRoZUJlc3Q=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"5\";s:13:\"addon_page_id\";s:1:\"7\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:40:\"Neden Yaptırıyo\'yu Tercih Etmelisiniz?\";s:13:\"feature_cards\";a:3:{s:5:\"icon_\";a:3:{i:0;s:3:\"258\";i:1;s:3:\"259\";i:2;s:3:\"260\";}s:11:\"card_title_\";a:3:{i:0;s:29:\"Doğrulanmış Profesyoneller\";i:1;s:17:\"Güvenceli Ödeme\";i:2;s:27:\"Güvenli ve Şeffaf Süreç\";}s:17:\"card_description_\";a:3:{i:0;s:98:\"Kimlik doğrulaması yapılmış, referansları kontrol edilmiş güvenilir ustalarla çalışın.\";i:1;s:114:\"Ödemeniz, hizmet tamamlanana kadar güvende tutulur. Memnun kalmadığınız sürece ödeme serbest bırakılmaz.\";i:2;s:111:\"Anlık mesajlaşma, fotoğraflı ilerleme takibi ve güvenli ödeme sistemiyle her adımda kontrolünüz sizde.\";}}s:11:\"right_image\";s:3:\"316\";s:16:\"background_color\";s:7:\"#F8F9FD\";s:11:\"padding_top\";s:2:\"88\";s:14:\"padding_bottom\";s:2:\"89\";}','2025-12-24 10:29:22','2026-05-05 12:35:33'),(62,'Mobilica','update','plugins\\PageBuilder\\Addons\\Mobilica\\Mobilica','dynamic_page',7,7,'dynamic_page','a:25:{s:2:\"id\";s:2:\"62\";s:10:\"addon_name\";s:8:\"Mobilica\";s:15:\"addon_namespace\";s:60:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcTW9iaWxpY2FcTW9iaWxpY2E=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"7\";s:13:\"addon_page_id\";s:1:\"7\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:20:\"free_app_store_title\";s:13:\"HEMEN İNDİR\";s:20:\"free_app_store_image\";s:3:\"262\";s:19:\"free_app_store_link\";s:73:\"https://play.google.com/store/apps/details?id=com.xgenious.xilancer&hl=en\";s:25:\"free_app_play_store_image\";s:3:\"263\";s:24:\"free_app_play_store_link\";s:73:\"https://play.google.com/store/apps/details?id=com.xgenious.xilancer&hl=en\";s:20:\"free_app_store_shape\";N;s:20:\"free_app_store_phone\";s:3:\"329\";s:22:\"client_app_store_title\";s:13:\"HEMEN İNDİR\";s:22:\"client_app_store_image\";s:3:\"262\";s:21:\"client_app_store_link\";s:73:\"https://play.google.com/store/apps/details?id=com.xgenious.xilancer&hl=en\";s:27:\"client_app_play_store_image\";s:3:\"263\";s:26:\"client_app_play_store_link\";s:73:\"https://play.google.com/store/apps/details?id=com.xgenious.xilancer&hl=en\";s:22:\"client_app_store_shape\";N;s:22:\"client_app_store_phone\";s:3:\"329\";s:11:\"padding_top\";s:3:\"200\";s:14:\"padding_bottom\";s:2:\"99\";s:10:\"section_bg\";N;}','2025-12-24 10:31:41','2026-05-06 08:41:10'),(63,'LatestProject','update','plugins\\PageBuilder\\Addons\\Project\\LatestProject','dynamic_page',8,7,'dynamic_page','a:15:{s:2:\"id\";s:2:\"63\";s:10:\"addon_name\";s:13:\"LatestProject\";s:15:\"addon_namespace\";s:64:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcUHJvamVjdFxMYXRlc3RQcm9qZWN0\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"8\";s:13:\"addon_page_id\";s:1:\"7\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:22:\"Öne Çıkan Hizmetler\";s:5:\"items\";s:2:\"10\";s:9:\"pro_count\";s:2:\"10\";s:8:\"order_by\";s:6:\"random\";s:11:\"padding_top\";s:2:\"40\";s:14:\"padding_bottom\";s:2:\"40\";s:10:\"section_bg\";N;}','2025-12-24 10:32:51','2026-05-05 13:04:12'),(64,'HowItWorks','update','plugins\\PageBuilder\\Addons\\HowItWorks\\HowItWorks','dynamic_page',9,7,'dynamic_page','a:15:{s:2:\"id\";s:2:\"64\";s:10:\"addon_name\";s:10:\"HowItWorks\";s:15:\"addon_namespace\";s:64:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcSG93SXRXb3Jrc1xIb3dJdFdvcmtz\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"9\";s:13:\"addon_page_id\";s:1:\"7\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:13:\"section_title\";s:19:\"Nasıl Çalışır?\";s:5:\"steps\";a:3:{s:5:\"icon_\";a:4:{i:0;s:3:\"267\";i:1;s:3:\"268\";i:2;s:3:\"269\";i:3;s:3:\"270\";}s:6:\"title_\";a:4:{i:0;s:13:\"Hizmet Seçin\";i:1;s:12:\"Teklif Alın\";i:2;s:21:\"Ustanızı Belirleyin\";i:3;s:17:\"Hizmetinizi Alın\";}s:12:\"description_\";a:4:{i:0;s:76:\"İhtiyacınız olan hizmet kategorisini seçin ve detaylarınızı belirtin.\";i:1;s:81:\"Doğrulanmış ustalardan hızlıca fiyat teklifleri alın ve karşılaştırın.\";i:2;s:66:\"Değerlendirmeleri inceleyin ve size en uygun profesyoneli seçin.\";i:3;s:63:\"Ustanız işi tamamlasın, memnun kalınca ödemeyi onaylayın.\";}}s:11:\"padding_top\";s:1:\"0\";s:14:\"padding_bottom\";s:2:\"18\";s:10:\"section_bg\";s:7:\"#F8F9FD\";s:7:\"card_bg\";s:7:\"#FFFFFF\";s:7:\"icon_bg\";s:18:\"rgb(255, 255, 255)\";}','2025-12-24 10:35:05','2026-05-05 13:07:06'),(65,'CategoryProjectOne','update','plugins\\PageBuilder\\Addons\\Category\\CategoryProjectOne','dynamic_page',10,7,'dynamic_page','a:15:{s:2:\"id\";s:2:\"65\";s:10:\"addon_name\";s:18:\"CategoryProjectOne\";s:15:\"addon_namespace\";s:72:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcQ2F0ZWdvcnlcQ2F0ZWdvcnlQcm9qZWN0T25l\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:2:\"10\";s:13:\"addon_page_id\";s:1:\"7\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:28:\"Browse Service by Categories\";s:20:\"view_all_button_text\";s:17:\"View all services\";s:20:\"view_all_button_link\";s:12:\"projects/all\";s:20:\"category_custom_data\";a:2:{s:12:\"category_id_\";a:5:{i:0;s:2:\"11\";i:1;s:2:\"13\";i:2;s:2:\"23\";i:3;s:2:\"24\";i:4;s:2:\"25\";}s:17:\"background_image_\";a:5:{i:0;s:3:\"316\";i:1;s:3:\"315\";i:2;s:3:\"322\";i:3;s:3:\"272\";i:4;s:3:\"274\";}}s:11:\"padding_top\";s:2:\"40\";s:14:\"padding_bottom\";s:2:\"40\";s:10:\"section_bg\";N;}','2025-12-24 10:37:01','2026-05-05 13:08:42'),(67,'GetStarted2','update','plugins\\PageBuilder\\Addons\\GetStarted\\GetStarted2','dynamic_page',12,7,'dynamic_page','a:17:{s:2:\"id\";s:2:\"67\";s:10:\"addon_name\";s:11:\"GetStarted2\";s:15:\"addon_namespace\";s:68:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcR2V0U3RhcnRlZFxHZXRTdGFydGVkMg==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:2:\"12\";s:13:\"addon_page_id\";s:1:\"7\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:16:\"Hemen Başlayın\";s:8:\"subtitle\";s:173:\"Eviniz, iş yeriniz veya yaşam alanınız için ihtiyaç duyduğunuz her hizmete Yaptırıyo ile ulaşın. Hemen üye olun, dakikalar içinde profesyonel desteğe kavuşun.\";s:11:\"button_text\";s:9:\"Kayıt Ol\";s:11:\"button_link\";s:5:\"login\";s:16:\"decorative_image\";s:3:\"276\";s:13:\"gradient_from\";s:25:\"rgba(111, 227, 181, 0.11)\";s:11:\"gradient_to\";s:24:\"rgba(222, 175, 64, 0.23)\";s:11:\"padding_top\";s:2:\"40\";s:14:\"padding_bottom\";s:2:\"40\";}','2025-12-24 10:39:23','2026-05-05 13:13:29'),(68,'OurStory','update','plugins\\PageBuilder\\Addons\\About\\OurStory','dynamic_page',2,8,'dynamic_page','a:13:{s:2:\"id\";s:2:\"68\";s:10:\"addon_name\";s:8:\"OurStory\";s:15:\"addon_namespace\";s:56:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcQWJvdXRcT3VyU3Rvcnk=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"2\";s:13:\"addon_page_id\";s:1:\"8\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:14:\"story_sections\";a:4:{s:14:\"section_title_\";a:3:{i:0;s:9:\"Our Story\";i:1;s:10:\"Our Vision\";i:2;s:10:\"Our Values\";}s:16:\"section_content_\";a:3:{i:0;s:1016:\"<p style=\"line-height: 1.5;\"><b>01. Built On Real Experience</b></p><p style=\"line-height: 1.5;\"><span style=\"display: inline !important;\">Xilancer was founded with a vision to connect talents and businesses worldwide. Our journey started with understanding the struggles of freelancers and employers.</span></p><p style=\"line-height: 1.5;\"><span style=\"display: inline !important;\"><br></span></p><p style=\"line-height: 1.5;\"><b>02. Empowering Connections</b></p><p style=\"line-height: 1.5;\"><span style=\"font-weight: normal;\">Xilancer helps businesses find the right talent while giving freelancers the opportunity to showcase their skills and grow.</span></p><p style=\"line-height: 1.5;\"><br><b>03. Trust &amp; Growth Together</b></p><p style=\"line-height: 1.5;\"><span style=\"font-weight: normal;\">Our platform ensures safe payments, reliable communication, and fair opportunities for everyone. At Xilancer, we\'re building not just a marketplace— but a community of trust, collaboration, and success.</span></p>\";i:1;s:458:\"Our vision is to build a platform where talented freelancers and businesses from around the world come together. We believe every skill has value, and connecting it with the right opportunity is our mission.<br><br>We aim to make freelancing simpler, more transparent, and trustworthy—where every talent is recognized, and every business finds the right expertise they need. We want to redefine the future of work, where borders don’t matter—skills do.\";i:2;s:458:\"Our vision is to build a platform where talented freelancers and businesses from around the world come together. We believe every skill has value, and connecting it with the right opportunity is our mission.<br><br>We aim to make freelancing simpler, more transparent, and trustworthy—where every talent is recognized, and every business finds the right expertise they need. We want to redefine the future of work, where borders don’t matter—skills do.\";}s:14:\"section_image_\";a:3:{i:0;s:3:\"295\";i:1;s:3:\"297\";i:2;s:3:\"296\";}s:15:\"image_position_\";a:3:{i:0;s:5:\"right\";i:1;s:4:\"left\";i:2;s:5:\"right\";}}s:11:\"padding_top\";s:2:\"80\";s:14:\"padding_bottom\";s:2:\"80\";s:15:\"section_spacing\";s:3:\"128\";s:10:\"section_bg\";s:7:\"#F8F9FD\";}','2025-12-24 10:53:21','2026-01-08 10:03:36');
/*!40000 ALTER TABLE `page_builders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `slug` text DEFAULT NULL,
  `page_content` longtext DEFAULT NULL,
  `page_builder_status` varchar(255) DEFAULT NULL,
  `layout` varchar(255) DEFAULT NULL,
  `page_class` varchar(255) DEFAULT NULL,
  `breadcrumb_status` varchar(255) DEFAULT NULL,
  `navbar_variant` varchar(255) DEFAULT NULL,
  `footer_variant` varchar(255) DEFAULT NULL,
  `visibility` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL COMMENT '1-active, 0-inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (2,'İletişim','contact-us','<p><span style=\"color: rgb(153, 153, 153); font-family: Manrope, sans-serif; font-size: 15px; display: inline !important;\">You’re not obliged to pay any fee before you earn and we just charge less than 2% on your total earnings if you have membership then it’s less than 1%</span><span style=\"color: rgb(153, 153, 153); font-family: Manrope, sans-serif; font-size: 15px; font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); display: inline !important;\">You’re not obliged to pay any fee before you earn and we just charge less than 2% on your total earnings if you have membership then it’s less than 1%</span><span style=\"color: rgb(153, 153, 153); font-family: Manrope, sans-serif; font-size: 15px; font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); display: inline !important;\">You’re not obliged to pay any fee before you earn and we just charge less than 2% on your total earnings if you have membership then it’s less than 1%</span><span style=\"color: rgb(153, 153, 153); font-family: Manrope, sans-serif; font-size: 15px; font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); display: inline !important;\">You’re not obliged to pay any fee before you earn and we just charge less than 2% on your total earnings if you have membership then it’s less than 1%</span><span style=\"color: rgb(153, 153, 153); font-family: Manrope, sans-serif; font-size: 15px; font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); display: inline !important;\">You’re not obliged to pay any fee before you earn and we just charge less than 2% on your total earnings if you have membership then it’s less than 1%</span><span style=\"color: rgb(153, 153, 153); font-family: Manrope, sans-serif; font-size: 15px; font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); display: inline !important;\">You’re not obliged to pay any fee before you earn and we just charge less than 2% on your total earnings if you have membership then it’s less than 1%</span></p><p><span style=\"color: rgb(153, 153, 153); font-family: Manrope, sans-serif; font-size: 15px; font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); display: inline !important;\"><br></span></p><p><span style=\"color: rgb(153, 153, 153); font-family: Manrope, sans-serif; font-size: 15px; font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); display: inline !important;\"><span style=\"display: inline !important;\">You’re not obliged to pay any fee before you earn and we just charge less than 2% on your total earnings if you have membership then it’s less than 1%</span></span></p><p><span style=\"color: rgb(153, 153, 153); font-family: Manrope, sans-serif; font-size: 15px; font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); display: inline !important;\"><span style=\"display: inline !important;\"><span style=\"display: inline !important;\">You’re not obliged to pay any fee before you earn and we just charge less than 2% on your total earnings if you have membership then it’s less than 1%</span></span></span></p><p><span style=\"color: rgb(153, 153, 153); font-family: Manrope, sans-serif; font-size: 15px; font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); display: inline !important;\"><span style=\"display: inline !important;\"><span style=\"display: inline !important;\"><br></span></span></span></p><p><span style=\"color: rgb(153, 153, 153); font-family: Manrope, sans-serif; font-size: 15px; font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); display: inline !important;\"><span style=\"display: inline !important;\"><span style=\"display: inline !important;\"><span style=\"display: inline !important;\">You’re not obliged to pay any fee before you earn and we just charge less than 2% on your total earnings if you have membership then it’s less than 1%</span></span></span></span></p><p><span style=\"color: rgb(153, 153, 153); font-family: Manrope, sans-serif; font-size: 15px; font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); display: inline !important;\"><span style=\"display: inline !important;\"><span style=\"display: inline !important;\"><span style=\"display: inline !important;\"><br></span></span></span></span></p><p><span style=\"color: rgb(153, 153, 153); font-family: Manrope, sans-serif; font-size: 15px; font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); display: inline !important;\"><span style=\"display: inline !important;\"><span style=\"display: inline !important;\"><span style=\"display: inline !important;\"><span style=\"display: inline !important;\">You’re not obliged to pay any fee before you earn and we just charge less than 2% on your total earnings if you have membership then it’s less than 1%</span><br></span><br></span><br></span><br></span><br></p>','on','normal_layout','nav-absolute','on','02','03','all',1,'2022-12-21 07:22:54','2026-05-05 07:46:44'),(6,'Gizlilik Politikası','privacy-policy','<p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">Welcome to our platform dedicated to connecting clients with independent professionals generally. We understand the importance of privacy and are committed to protecting the personal information of our users. This Privacy Policy outlines our practices regarding the collection, use, and disclosure of your information when you use our website and services.</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><b>Information We Collect</b></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">Personal information such as your name, email address, phone number, postal address, and other contact details. Professional information, Resume work history, educational background, skills, and any other information related to professional qualifications. Financial information: Payment details, including credit card numbers, bank information, and billing addresses, which are processed by our third-party payment processors. Technical information: Browser types, operating system details, device information, and usage data such as website navigation patterns.\r\n</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">The information we collect may be used for the following purposes:</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><b>01.</b>&nbsp;<span style=\"display: inline !important;\">To facilitate the creation of your account and your access to our services.</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><b>02.</b>&nbsp;<span style=\"display: inline !important;\">To match clients with suitable freelancers and vice versa.</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><b>03.</b>&nbsp;<span style=\"display: inline !important;\">To process payments and manage transactions.</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><b>04.</b>&nbsp;<span style=\"display: inline !important;\">To communicate with you about your account or transactions and to send you updates about our services.</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><b>05.</b>&nbsp;<span style=\"display: inline !important;\">To improve our website functionality and user experience.</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><b>06.</b>&nbsp;<span style=\"display: inline !important;\">To comply with legal obligations and enforce our terms and conditions.</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\"><b>Sharing Your Information</b></span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\">We may share your information with:\r\n</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\"><b>01.</b>&nbsp;</span><span style=\"display: inline !important;\">Other users of this site when necessary to facilitate service offerings and collaborations.</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\"><b>02.</b>&nbsp;</span><span style=\"display: inline !important;\">Service providers who perform services on our behalf, such as payment processing, data analysis, and email delivery services.</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\"><b>03.</b>&nbsp;</span><span style=\"display: inline !important;\">Law enforcement or other government agencies if required by law or in good faith belief that such action is necessary to comply with legal processes.</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\">We do not sell, rent, or lease our user lists to third parties for their marketing purposes without your explicit consent.</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\"><b>Data Security</b></span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\">We implement reasonable security measures to protect against unauthorized access, alteration, disclosure, or destruction of your personal information. However, no method of transmission over the internet or electronic storage is 100% secure, and we cannot guarantee its absolute security.</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\"><b>Your Rights</b></span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\">You have the right to:\r\n</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\"><b>01.</b>&nbsp;</span><span style=\"display: inline !important;\">Access, update, or delete the personal information we have on you.</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\"><b>02</b>.&nbsp;</span><span style=\"display: inline !important;\">Object to the processing of your personal information.</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\"><b>03.</b>&nbsp;</span><span style=\"display: inline !important;\">Request that we restrict the processing of your personal information.</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\"><b>04.</b>&nbsp;</span><span style=\"display: inline !important;\">Withdraw consent at any time where we relied on your consent to process your personal information.</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><b>International Transfers</b></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">Your information may be transferred to, and maintained on, computers located outside of your state, province, country, or other governmental jurisdiction, where the data protection laws may differ from those of your jurisdiction.</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><b>Changes to This Privacy Policy</b></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">We may update this Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page. We encourage you to review this Privacy Policy periodically for any changes.</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><b>Contact Us</b></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">If you have any questions about this Privacy Policy, please contact us:</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><b>01.</b>&nbsp;<span style=\"display: inline !important;\">By email: [insert Email Address]</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><b>02.</b>&nbsp;<span style=\"display: inline !important;\">By visiting this page on our website: [insert Privacy Policy Page URL]</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\"><b>Consent</b></span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\">By using our website and services, you consent to the collection, use, and sharing of your personal information as outlined in this Privacy Policy. This Privacy Policy is intended to be a general template and may need to be tailored to comply with the laws of your jurisdiction or to suit the specific operations of your website or organization. It is advisable to consult with a legal expert when drafting your detailed privacy policy.</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">\r\n</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\">\r\n</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\">\r\n</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\">\r\n</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\">\r\n</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\">\r\n</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\">\r\n</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\">\r\n</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\">\r\n</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">\r\n</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">\r\n</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">\r\n</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">\r\n</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">\r\n</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><b>\r\n</b></p>',NULL,'normal_layout','none','on',NULL,'03','all',1,'2022-12-28 01:51:06','2026-05-05 07:46:44'),(7,'Home Page One','home-page-one','<p>asdaui sasd aosidj laksdj aklsdj alkfjsdoijqoi aslkd aslkdj asoidj asoidj asd jmoriopi posdf aspod kaspod jaspodij asdiopja siopdjasoid jaspodi jaspdas fdpasoqwe k rokasodk aspodk asdasd asd</p>','on','home_page_layout','none',NULL,'01','03','all',1,'2023-10-26 05:33:00','2026-01-20 17:24:17'),(8,'Hakkımızda','about-us','<p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin-right: 0px; margin-bottom: 1.25em; margin-left: 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-weight: 600; color: var(--tw-prose-bold);\">About Us</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">Welcome to [Your Freelancing Website Name], where talent meets opportunity.</p><h3 style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-size: 1.25em; font-weight: 600; margin-top: 1rem; margin-bottom: 0.5rem; line-height: 1.6; font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; color: inherit;\">Our Story</span></h3><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin-right: 0px; margin-bottom: 1.25em; margin-left: 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">In the bustling digital age, where connectivity is as simple as a click, we found that the true potential of freelance talent was still untapped. Established in [Year], our platform was born from a simple yet powerful vision: to create a seamless bridge between gifted freelancers and visionary businesses.</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">We recognized the hurdles of the gig economy – the uncertainty, the competition, the often-impersonal interactions – and set out to craft a solution that would empower both freelancers and clients alike.</p><h3 style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-size: 1.25em; font-weight: 600; margin-top: 1rem; margin-bottom: 0.5rem; line-height: 1.6; font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; color: inherit;\">Our Mission</span></h3><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin-right: 0px; margin-bottom: 1.25em; margin-left: 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">At [Your Freelancing Website Name], we\'re not just building a marketplace; we\'re cultivating a community. Our mission is to facilitate a professional environment where freelancers can thrive, businesses can innovate, and collaboration can flourish.</p><h3 style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-size: 1.25em; font-weight: 600; margin-top: 1rem; margin-bottom: 0.5rem; line-height: 1.6; font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; color: inherit;\">Our Values</span></h3><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin-right: 0px; margin-bottom: 1.25em; margin-left: 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-weight: 600; color: var(--tw-prose-bold);\">Integrity</span>: We believe in honest and transparent communication, ensuring that every interaction on our platform is conducted with the utmost respect and professionalism.</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-weight: 600; color: var(--tw-prose-bold);\">Innovation</span>: Staying ahead of the curve is in our DNA. We constantly seek out new ways to enhance your experience, simplify processes, and enable success.</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-weight: 600; color: var(--tw-prose-bold);\">Excellence</span>: Our commitment to quality is unwavering. We meticulously curate our pool of talent and the projects that come through our platform, guaranteeing a standard of excellence that is second to none.</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-weight: 600; color: var(--tw-prose-bold);\">Community</span>: We understand the power of connection. That\'s why we foster a supportive network of professionals who share advice, offer mentorship, and help each other grow.</p><h3 style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-size: 1.25em; font-weight: 600; margin-top: 1rem; margin-bottom: 0.5rem; line-height: 1.6; font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; color: inherit;\">Our Community</span></h3><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin-right: 0px; margin-bottom: 1.25em; margin-left: 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">Our freelancers are the heartbeat of our platform. They are writers, designers, developers, marketers, consultants, and more – each bringing a unique set of skills and a passion for their craft.</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">Our clients range from startups to Fortune 500 companies, all seeking the perfect match for their project needs. Together, they span the globe, creating a diverse and dynamic tapestry of cultures and ideas.</p><h3 style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-size: 1.25em; font-weight: 600; margin-top: 1rem; margin-bottom: 0.5rem; line-height: 1.6; font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; color: inherit;\">Our Promise</span></h3><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin-right: 0px; margin-bottom: 1.25em; margin-left: 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">To Freelancers: We promise to provide you with a platform where you can showcase your skills, set your rates, and connect with clients who value what you do.</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">To Clients: We promise a curated selection of top-tier freelancers who are not only talented but also reliable and ready to help bring your projects to life.</p><h3 style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-size: 1.25em; font-weight: 600; margin-top: 1rem; margin-bottom: 0.5rem; line-height: 1.6; font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; color: inherit;\">Join Us</span></h3><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin-right: 0px; margin-bottom: 1.25em; margin-left: 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">Whether you\'re a freelancer looking to take your career to new heights or a business in search of the right talent to complete your next project, [Your Freelancing Website Name] is your partner in success. Explore our site, join our community, and let\'s make something incredible together.</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">Because here, we believe that when great minds collaborate, the possibilities are endless.</p><hr style=\"border-top-width: 1px; border-style: solid; border-color: var(--tw-prose-hr); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; color: rgb(55, 65, 81); height: 0px; margin-top: 3em; margin-bottom: 3em; font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" font-size:=\"\" 16px;=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin-right: 0px; margin-left: 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">This sample is meant to be inspirational and should be customized to align with the specific brand voice, value proposition, and unique selling points of your freelancing website.</p>','on','normal_layout','none','on',NULL,'03','all',1,'2023-11-02 06:43:42','2026-05-05 07:46:44'),(9,'Kullanım Koşulları','terms-conditions','<p>Welcome to our platform dedicated to connecting clients with independent professionals generally. We understand the importance of privacy and are committed to protecting the personal information of our users. This Privacy Policy outlines our practices regarding the collection, use, and disclosure of your information when you use our website and services.</p><p><br></p><p><b>Information We Collect</b></p><p>We collect information you provide directly to us such as your name, email address, phone number, postal address, and other contact details. Professional information, Resume work history, educational background, skills, and any other information related to professional qualifications. Financial information: Payment details, including credit card numbers, bank information, and billing addresses, which are processed by our third-party payment processors. Technical information: Browser types, operating system details, device information, and usage data such as website navigation patterns.</p><p><br></p><p>\r\n</p><p>The information we collect may be used for the following purposes:</p><p><br></p><p><b>01.</b>&nbsp;<span style=\"display: inline !important;\">To facilitate the creation of your account and your access to our services.</span></p><p><span style=\"display: inline !important;\"><br></span></p><p><b>02.</b>&nbsp;<span style=\"display: inline !important;\">To match clients with suitable freelancers and vice versa.</span></p><p><span style=\"display: inline !important;\"><br></span></p><p><b>03.</b>&nbsp;<span style=\"display: inline !important;\">To provide you with our services and support.</span></p><p><span style=\"display: inline !important;\"><br></span></p><p><b>04.</b>&nbsp;<span style=\"display: inline !important;\">To communicate with you about your account or transactions and to send you updates about our services.</span></p><p><span style=\"display: inline !important;\"><br></span></p><p><b>05.</b>&nbsp;<span style=\"display: inline !important;\">To improve our website functionality and user experience.</span></p><p><span style=\"display: inline !important;\"><br></span></p><p><b>06.</b>&nbsp;<span style=\"display: inline !important;\">To comply with legal obligations and enforce our terms and conditions.</span></p><p><span style=\"display: inline !important;\"><br></span></p><p><span style=\"display: inline !important;\"><b>Sharing Your Information</b></span></p><p><span style=\"display: inline !important;\"><b><br></b></span></p><p><span style=\"display: inline !important;\">We may share your information with:</span></p><p><span style=\"display: inline !important;\"><br></span></p><p><span style=\"display: inline !important;\">\r\n</span></p><p><span style=\"display: inline !important;\"><b>01.&nbsp;</b></span>Other users of this site when necessary to facilitate service offerings and collaborations.</p><p><br></p><p><span style=\"display: inline !important;\"><b>02.&nbsp;</b></span>Service providers who perform services on our behalf, such as payment processing, data analysis, and email delivery services.</p><p><br></p><p><span style=\"display: inline !important;\"><b>03.&nbsp;</b></span>Law enforcement or government entities when necessary to comply with legal processes.</p><p><span style=\"display: inline !important;\">We do not sell, rent, or lease our user lists to third parties for their marketing purposes without your explicit consent.</span></p><p><span style=\"display: inline !important;\"><br></span></p><p><span style=\"display: inline !important;\"><b>Data Security</b></span></p><p><span style=\"display: inline !important;\">We implement reasonable security measures to protect against unauthorized access, alteration, disclosure, or destruction of your personal information. However, no method of transmission over the internet or electronic storage is 100% secure, and we cannot guarantee its absolute security.</span></p><p><span style=\"display: inline !important;\"><br></span></p><p><span style=\"display: inline !important;\"><b>Your Rights</b></span></p><p><span style=\"display: inline !important;\"><b><br></b></span></p><p><span style=\"display: inline !important;\">Depending on your location, you may have the right to:</span></p><p><span style=\"display: inline !important;\"><br></span></p><p><span style=\"display: inline !important;\">\r\n</span></p><p><span style=\"display: inline !important;\"><b>01.&nbsp;</b></span><span style=\"display: inline !important;\">Access, update, or delete the personal information we have on you.</span></p><p><span style=\"display: inline !important;\"><br></span></p><p><span style=\"display: inline !important;\"><b>02.&nbsp;</b></span><span style=\"display: inline !important;\">Obtain the portability of your personal information.</span></p><p><span style=\"display: inline !important;\"><br></span></p><p><span style=\"display: inline !important;\"><b>03.&nbsp;</b></span><span style=\"display: inline !important;\">Request that we restrict the processing of your personal information.</span></p><p><span style=\"display: inline !important;\"><br></span></p><p><span style=\"display: inline !important;\"><b>04.&nbsp;</b></span><span style=\"display: inline !important;\">Withdraw consent at any time where we relied on your consent to process your personal information.</span></p><p><span style=\"display: inline !important;\"><br></span></p><p><span style=\"display: inline !important;\"><b>International Transfers</b></span></p><p><span style=\"display: inline !important;\"><b><br></b></span></p><p><span style=\"display: inline !important;\">Your information may be transferred to, and maintained on, computers located outside of your state, province, country, or other governmental jurisdiction. Your data protection laws may differ from those of your jurisdiction.</span></p><p><span style=\"display: inline !important;\"><br></span></p><p><span style=\"display: inline !important;\"><b>Contact Us</b></span></p><p><span style=\"display: inline !important;\"><b><br></b></span></p><p><span style=\"display: inline !important;\">If you have any questions about this Privacy Policy, please contact us:</span></p><p><span style=\"display: inline !important;\"><br></span></p><p><span style=\"display: inline !important;\">\r\n</span></p><p><span style=\"display: inline !important;\"><b>01.&nbsp;</b></span>By email: helloxilancer@gmail.com</p><p><br></p><p><span style=\"display: inline !important;\"><b>02.&nbsp;</b></span>By visiting this page on our website: <a href=\"http://www.xilancer.com\" target=\"_blank\">www.xilancer.com</a></p><p><br></p><p><b>Consent</b></p><p><b><br></b></p><p>By using our website and services, you consent to the collection, use, and sharing of your personal information as outlined in this Privacy Policy. This Privacy Policy is intended to be a general template and may need to be tailored to comply with the laws of your jurisdiction or to suit the specific operations of your website or organization. It is advisable to consult with a legal expert when drafting your detailed privacy policy.</p><p><span style=\"display: inline !important;\"><b>\r\n</b></span></p><p><span style=\"display: inline !important;\"><b>\r\n</b></span></p><p><span style=\"display: inline !important;\"><b>\r\n</b></span></p><p><span style=\"display: inline !important;\"><b>\r\n</b></span></p><p><span style=\"display: inline !important;\"><b>\r\n</b></span></p><p><span style=\"display: inline !important;\"><b>\r\n</b></span></p><p><span style=\"display: inline !important;\"><b>\r\n</b></span></p><p><span style=\"display: inline !important;\"><b>\r\n</b></span></p><p><span style=\"display: inline !important;\"><b>\r\n</b></span></p><p><span style=\"display: inline !important;\"><b>\r\n</b></span></p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p>',NULL,'normal_layout','none','on',NULL,'03','all',1,'2024-03-10 16:36:03','2026-05-05 07:46:44'),(10,'Home Page Two','home-page-two','<p>Home Page Two</p>','on','normal_layout','none',NULL,NULL,'04','all',1,'2024-06-03 14:26:33','2026-01-20 17:30:19');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=211 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'Category','category-list','admin','2023-10-22 01:16:30','2023-10-22 01:16:30'),(2,'Category','category-add','admin','2023-10-22 01:16:30','2023-10-22 01:16:30'),(3,'Category','category-edit','admin','2023-10-22 01:16:31','2023-10-22 01:16:31'),(4,'Category','category-delete','admin','2023-10-22 01:16:31','2023-10-22 01:16:31'),(5,'Category','category-status-change','admin','2023-10-22 01:16:31','2023-10-22 01:16:31'),(6,'Category','category-bulk-delete','admin','2023-10-22 01:16:31','2023-10-22 01:16:31'),(7,'Subcategory','subcategory-list','admin','2023-10-22 01:18:53','2023-10-22 01:18:53'),(8,'Subcategory','subcategory-add','admin','2023-10-22 01:18:53','2023-10-22 01:18:53'),(9,'Subcategory','subcategory-edit','admin','2023-10-22 01:18:53','2023-10-22 01:18:53'),(10,'Subcategory','subcategory-delete','admin','2023-10-22 01:18:53','2023-10-22 01:18:53'),(11,'Subcategory','subcategory-status-change','admin','2023-10-22 01:18:53','2023-10-22 01:18:53'),(12,'Subcategory','subcategory-bulk-delete','admin','2023-10-22 01:18:53','2023-10-22 01:18:53'),(13,'Skill','skill-list','admin','2023-10-22 01:20:00','2023-10-22 01:20:00'),(14,'Skill','skill-add','admin','2023-10-22 01:20:00','2023-10-22 01:20:00'),(15,'Skill','skill-edit','admin','2023-10-22 01:20:00','2023-10-22 01:20:00'),(16,'Skill','skill-delete','admin','2023-10-22 01:20:00','2023-10-22 01:20:00'),(17,'Skill','skill-status-change','admin','2023-10-22 01:20:00','2023-10-22 01:20:00'),(18,'Skill','skill-bulk-delete','admin','2023-10-22 01:20:00','2023-10-22 01:20:00'),(19,'Country','country-list','admin','2023-10-22 01:25:54','2023-10-22 01:25:54'),(20,'Country','country-add','admin','2023-10-22 01:25:54','2023-10-22 01:25:54'),(21,'Country','country-edit','admin','2023-10-22 01:25:54','2023-10-22 01:25:54'),(22,'Country','country-delete','admin','2023-10-22 01:25:54','2023-10-22 01:25:54'),(23,'Country','country-status-change','admin','2023-10-22 01:25:54','2023-10-22 01:25:54'),(24,'Country','country-bulk-delete','admin','2023-10-22 01:25:54','2023-10-22 01:25:54'),(25,'Country','country-csv-file-import','admin','2023-10-22 01:25:54','2023-10-22 01:25:54'),(26,'State','state-list','admin','2023-10-22 01:26:48','2023-10-22 01:26:48'),(27,'State','state-add','admin','2023-10-22 01:26:48','2023-10-22 01:26:48'),(28,'State','state-edit','admin','2023-10-22 01:26:48','2023-10-22 01:26:48'),(29,'State','state-delete','admin','2023-10-22 01:26:48','2023-10-22 01:26:48'),(30,'State','state-status-change','admin','2023-10-22 01:26:48','2023-10-22 01:26:48'),(31,'State','state-bulk-delete','admin','2023-10-22 01:26:48','2023-10-22 01:26:48'),(32,'State','state-csv-file-import','admin','2023-10-22 01:26:48','2023-10-22 01:26:48'),(33,'City','city-list','admin','2023-10-22 01:27:12','2023-10-22 01:27:12'),(34,'City','city-add','admin','2023-10-22 01:27:12','2023-10-22 01:27:12'),(35,'City','city-edit','admin','2023-10-22 01:27:12','2023-10-22 01:27:12'),(36,'City','city-delete','admin','2023-10-22 01:27:12','2023-10-22 01:27:12'),(37,'City','city-status-change','admin','2023-10-22 01:27:13','2023-10-22 01:27:13'),(38,'City','city-bulk-delete','admin','2023-10-22 01:27:13','2023-10-22 01:27:13'),(39,'City','city-csv-file-import','admin','2023-10-22 01:27:13','2023-10-22 01:27:13'),(40,'Project','project-list','admin','2023-10-22 01:33:18','2023-10-22 01:33:18'),(41,'Project','project-delete','admin','2023-10-22 01:33:18','2023-10-22 01:33:18'),(42,'Project','project-details','admin','2023-10-22 01:33:18','2023-10-22 01:33:18'),(43,'Project','project-reject','admin','2023-10-22 01:33:19','2023-10-22 01:33:19'),(44,'Project','project-status-change','admin','2023-10-22 01:33:19','2023-10-22 01:33:19'),(45,'Project','project-history-list','admin','2023-10-22 01:35:30','2023-10-22 01:35:30'),(46,'Job','job-list','admin','2023-10-22 01:51:58','2023-10-22 01:51:58'),(47,'Job','job-details','admin','2023-10-22 01:51:58','2023-10-22 01:51:58'),(48,'Job','job-delete','admin','2023-10-22 01:51:58','2023-10-22 01:51:58'),(49,'Job','job-status-change','admin','2023-10-22 01:51:58','2023-10-22 01:51:58'),(50,'Job','job-auto-approval','admin','2023-10-22 01:51:59','2023-10-22 01:51:59'),(51,'Job','job-history-list','admin','2023-10-22 01:51:59','2023-10-22 01:51:59'),(52,'Wallet','deposit-list','admin','2023-10-22 01:58:28','2023-10-22 01:58:28'),(53,'Wallet','deposit-settings-view','admin','2023-10-22 01:58:28','2023-10-22 01:58:28'),(54,'Wallet','deposit-settings-update','admin','2023-10-22 01:58:28','2023-10-22 01:58:28'),(55,'Wallet','deposit-history-details','admin','2023-10-22 01:58:28','2023-10-22 01:58:28'),(56,'Wallet','complete-manual-deposit-status','admin','2023-10-22 01:58:28','2023-10-22 01:58:28'),(57,'Withdraw','withdraw-list','admin','2023-10-22 02:03:25','2023-10-22 02:03:25'),(58,'Withdraw','withdraw-settings-view','admin','2023-10-22 02:03:25','2023-10-22 02:03:25'),(59,'Withdraw','withdraw-settings-update','admin','2023-10-22 02:03:25','2023-10-22 02:03:25'),(60,'Withdraw','withdraw-status-change','admin','2023-10-22 02:03:25','2023-10-22 02:03:25'),(61,'Withdraw','withdraw-payment-gateway-list','admin','2023-10-22 02:03:25','2023-10-22 02:03:25'),(62,'Withdraw','withdraw-payment-gateway-add','admin','2023-10-22 02:03:25','2023-10-22 02:03:25'),(63,'Withdraw','withdraw-payment-gateway-edit','admin','2023-10-22 02:03:25','2023-10-22 02:03:25'),(64,'Withdraw','withdraw-payment-gateway-delete','admin','2023-10-22 02:03:25','2023-10-22 02:03:25'),(65,'Withdraw','withdraw-payment-status-change','admin','2023-10-22 02:03:25','2023-10-22 02:03:25'),(66,'Subscription','subscription-type-list','admin','2023-10-22 03:18:59','2023-10-22 03:18:59'),(67,'Subscription','subscription-type-add','admin','2023-10-22 03:18:59','2023-10-22 03:18:59'),(68,'Subscription','subscription-type-edit','admin','2023-10-22 03:18:59','2023-10-22 03:18:59'),(69,'Subscription','subscription-type-delete','admin','2023-10-22 03:18:59','2023-10-22 03:18:59'),(70,'Subscription','subscription-type-bulk-delete','admin','2023-10-22 03:18:59','2023-10-22 03:18:59'),(71,'Subscription','subscription-list','admin','2023-10-22 03:18:59','2023-10-22 03:18:59'),(72,'Subscription','subscription-add','admin','2023-10-22 03:18:59','2023-10-22 03:18:59'),(73,'Subscription','subscription-edit','admin','2023-10-22 03:18:59','2023-10-22 03:18:59'),(74,'Subscription','subscription-delete','admin','2023-10-22 03:18:59','2023-10-22 03:18:59'),(75,'Subscription','subscription-bulk-delete','admin','2023-10-22 03:18:59','2023-10-22 03:18:59'),(76,'Subscription','subscription-status-change','admin','2023-10-22 03:18:59','2023-10-22 03:18:59'),(77,'Subscription','subscription-connect-settings-view','admin','2023-10-22 03:18:59','2023-10-22 03:18:59'),(78,'Subscription','subscription-connect-settings-update','admin','2023-10-22 03:18:59','2023-10-22 03:18:59'),(79,'User Subscription','user-subscription-list','admin','2023-10-22 03:23:39','2023-10-22 03:23:39'),(80,'User Subscription','user-subscription-status-change','admin','2023-10-22 03:23:39','2023-10-22 03:23:39'),(81,'User Subscription','user-active-subscription','admin','2023-10-22 03:23:39','2023-10-22 03:23:39'),(82,'User Subscription','user-inactive-subscription','admin','2023-10-22 03:23:40','2023-10-22 03:23:40'),(83,'User Subscription','user-manual-subscription','admin','2023-10-22 03:23:40','2023-10-22 03:23:40'),(84,'Transaction Fee','transaction-fee-settings-view','admin','2023-10-22 03:28:15','2023-10-22 03:28:15'),(85,'Transaction Fee','transaction-fee-settings-update','admin','2023-10-22 03:28:15','2023-10-22 03:28:15'),(86,'Withdraw Fee','withdraw-fee-settings-view','admin','2023-10-22 03:28:38','2023-10-22 03:28:38'),(87,'Withdraw Fee','withdraw-fee-settings-update','admin','2023-10-22 03:28:38','2023-10-22 03:28:38'),(88,'Admin Commission','admin-commission-settings-view','admin','2023-10-22 03:30:49','2023-10-22 03:30:49'),(89,'Admin Commission','admin-commission-settings-update','admin','2023-10-22 03:30:49','2023-10-22 03:30:49'),(90,'Order','order-list','admin','2023-10-22 03:38:10','2023-10-22 03:38:10'),(91,'Order','order-details','admin','2023-10-22 03:38:10','2023-10-22 03:38:10'),(92,'Order','order-hold','admin','2023-10-22 03:38:10','2023-10-22 03:38:10'),(93,'Order','order-active','admin','2023-10-22 03:38:10','2023-10-22 03:38:10'),(94,'Order','order-queue','admin','2023-10-22 03:38:10','2023-10-22 03:38:10'),(95,'Order','order-deliver','admin','2023-10-22 03:38:10','2023-10-22 03:38:10'),(96,'Order','order-complete','admin','2023-10-22 03:38:10','2023-10-22 03:38:10'),(97,'Order','order-cancel','admin','2023-10-22 03:38:10','2023-10-22 03:38:10'),(98,'Order','order-decline','admin','2023-10-22 03:38:10','2023-10-22 03:38:10'),(99,'Order','order-manual-payment-status-update','admin','2023-10-22 03:38:10','2023-10-22 03:38:10'),(100,'Department','department-list','admin','2023-10-22 03:59:01','2023-10-22 03:59:01'),(101,'Department','department-add','admin','2023-10-22 03:59:01','2023-10-22 03:59:01'),(102,'Department','department-edit','admin','2023-10-22 03:59:01','2023-10-22 03:59:01'),(103,'Department','department-delete','admin','2023-10-22 03:59:01','2023-10-22 03:59:01'),(104,'Department','department-bulk-delete','admin','2023-10-22 03:59:01','2023-10-22 03:59:01'),(105,'Department','department-status-update','admin','2023-10-22 03:59:01','2023-10-22 03:59:01'),(106,'Support Ticket','support-ticket-list','admin','2023-10-22 04:19:55','2023-10-22 04:19:55'),(107,'Support Ticket','support-ticket-details','admin','2023-10-22 04:19:55','2023-10-22 04:19:55'),(108,'Support Ticket','support-ticket-delete','admin','2023-10-22 04:19:55','2023-10-22 04:19:55'),(109,'Support Ticket','support-ticket-bulk-action','admin','2023-10-22 04:19:55','2023-10-22 04:19:55'),(110,'Support Ticket','support-ticket-status-change','admin','2023-10-22 04:19:55','2023-10-22 04:19:55'),(111,'Support Ticket','support-ticket-reply','admin','2023-10-22 04:19:55','2023-10-22 04:19:55'),(112,'Support Ticket','support-ticket-close','admin','2023-10-22 04:19:56','2023-10-22 04:19:56'),(113,'Notification','notification-list','admin','2023-10-22 04:21:17','2023-10-22 04:21:17'),(114,'Notification','notification-details','admin','2023-10-22 04:21:17','2023-10-22 04:21:17'),(115,'User Manage','user-list','admin','2023-10-22 04:47:01','2023-10-22 04:47:01'),(116,'User Manage','user-details','admin','2023-10-22 04:47:01','2023-10-22 04:47:01'),(117,'User Manage','user-details-update','admin','2023-10-22 04:47:01','2023-10-22 04:47:01'),(118,'User Manage','user-identity-details','admin','2023-10-22 04:47:01','2023-10-22 04:47:01'),(119,'User Manage','user-identity-decline','admin','2023-10-22 04:47:01','2023-10-22 04:47:01'),(120,'User Manage','user-identity-status-update','admin','2023-10-22 04:47:01','2023-10-22 04:47:01'),(121,'User Manage','user-password-change','admin','2023-10-22 04:47:01','2023-10-22 04:47:01'),(122,'User Manage','user-delete','admin','2023-10-22 04:47:01','2023-10-22 04:47:01'),(123,'User Manage','user-account-status-change','admin','2023-10-22 04:47:01','2023-10-22 04:47:01'),(124,'User Manage','user-individual-commission-settings','admin','2023-10-22 04:47:01','2023-10-22 04:47:01'),(125,'User Manage','user-account-suspend-page','admin','2023-10-22 04:47:01','2023-10-22 04:47:01'),(126,'User Manage','user-account-suspend','admin','2023-10-22 04:47:01','2023-10-22 04:47:01'),(127,'User Manage','user-trash-list','admin','2023-10-22 04:49:01','2023-10-22 04:49:01'),(128,'User Manage','user-restore-from-trash-list','admin','2023-10-22 04:49:01','2023-10-22 04:49:01'),(129,'Page Text Settings','login-page-settings-view','admin','2023-10-22 05:12:33','2023-10-22 05:12:33'),(130,'Page Text Settings','login-page-settings-update','admin','2023-10-22 05:12:33','2023-10-22 05:12:33'),(131,'Page Text Settings','register-page-settings-view','admin','2023-10-22 05:12:33','2023-10-22 05:12:33'),(132,'Page Text Settings','register-page-settings-update','admin','2023-10-22 05:12:33','2023-10-22 05:12:33'),(133,'Page Text Settings','account-page-settings-view','admin','2023-10-22 05:12:33','2023-10-22 05:12:33'),(134,'Page Text Settings','account-page-settings-update','admin','2023-10-22 05:12:33','2023-10-22 05:12:33'),(135,'Page Text Settings','introduction-page-settings-view','admin','2023-10-22 05:12:33','2023-10-22 05:12:33'),(136,'Page Text Settings','introduction-page-settings-update','admin','2023-10-22 05:12:34','2023-10-22 05:12:34'),(137,'Page Text Settings','experience-page-settings-view','admin','2023-10-22 05:12:34','2023-10-22 05:12:34'),(138,'Page Text Settings','experience-page-settings-update','admin','2023-10-22 05:12:34','2023-10-22 05:12:34'),(139,'Page Text Settings','education-page-settings-view','admin','2023-10-22 05:12:34','2023-10-22 05:12:34'),(140,'Page Text Settings','education-page-settings-update','admin','2023-10-22 05:12:34','2023-10-22 05:12:34'),(141,'Page Text Settings','work-page-settings-view','admin','2023-10-22 05:12:34','2023-10-22 05:12:34'),(142,'Page Text Settings','work-page-settings-update','admin','2023-10-22 05:12:34','2023-10-22 05:12:34'),(143,'Page Text Settings','skill-page-settings-view','admin','2023-10-22 05:12:34','2023-10-22 05:12:34'),(144,'Page Text Settings','skill-page-settings-update','admin','2023-10-22 05:12:34','2023-10-22 05:12:34'),(145,'Page Text Settings','photo-page-settings-view','admin','2023-10-22 05:12:34','2023-10-22 05:12:34'),(146,'Page Text Settings','photo-page-settings-update','admin','2023-10-22 05:12:34','2023-10-22 05:12:34'),(147,'General Settings','reading','admin','2023-10-22 05:58:58','2023-10-22 05:58:58'),(148,'General Settings','navbar-global-variant','admin','2023-10-22 05:58:58','2023-10-22 05:58:58'),(149,'General Settings','footer-global-variant','admin','2023-10-22 05:58:58','2023-10-22 05:58:58'),(150,'General Settings','site-identity','admin','2023-10-22 05:58:58','2023-10-22 05:58:58'),(151,'General Settings','basic-settings','admin','2023-10-22 05:58:58','2023-10-22 05:58:58'),(152,'General Settings','color-settings','admin','2023-10-22 05:58:58','2023-10-22 05:58:58'),(153,'General Settings','typography-settings','admin','2023-10-22 05:58:58','2023-10-22 05:58:58'),(154,'General Settings','seo-settings','admin','2023-10-22 05:58:58','2023-10-22 05:58:58'),(155,'General Settings','third-party-script-settings','admin','2023-10-22 05:58:58','2023-10-22 05:58:58'),(156,'General Settings','social-login-settings','admin','2023-10-22 05:58:58','2023-10-22 05:58:58'),(157,'General Settings','email-template-settings','admin','2023-10-22 05:58:58','2023-10-22 05:58:58'),(158,'General Settings','smtp-settings','admin','2023-10-22 05:58:58','2023-10-22 05:58:58'),(159,'General Settings','custom-css-settings','admin','2023-10-22 05:58:59','2023-10-22 05:58:59'),(160,'General Settings','custom-js-settings','admin','2023-10-22 05:58:59','2023-10-22 05:58:59'),(161,'General Settings','gdpr-settings','admin','2023-10-22 05:58:59','2023-10-22 05:58:59'),(162,'General Settings','licence-settings','admin','2023-10-22 05:58:59','2023-10-22 05:58:59'),(163,'General Settings','cache-settings','admin','2023-10-22 05:58:59','2023-10-22 05:58:59'),(164,'General Settings','database-upgrade','admin','2023-10-22 05:58:59','2023-10-22 05:58:59'),(165,'Payment Gateway Settings','payment-info-settings','admin','2023-10-22 06:03:42','2023-10-22 06:03:42'),(166,'Payment Gateway Settings','payment-gateway-settings','admin','2023-10-22 06:03:42','2023-10-22 06:03:42'),(167,'Menu Builder','menu-list','admin','2023-10-22 06:20:10','2023-10-22 06:20:10'),(168,'Menu Builder','menu-add','admin','2023-10-22 06:20:10','2023-10-22 06:20:10'),(169,'Menu Builder','menu-edit','admin','2023-10-22 06:20:10','2023-10-22 06:20:10'),(170,'Menu Builder','menu-delete','admin','2023-10-22 06:20:10','2023-10-22 06:20:10'),(171,'Form Builder','form-list','admin','2023-10-22 06:27:24','2023-10-22 06:27:24'),(172,'Form Builder','form-add','admin','2023-10-22 06:27:24','2023-10-22 06:27:24'),(173,'Form Builder','form-edit','admin','2023-10-22 06:27:24','2023-10-22 06:27:24'),(174,'Form Builder','form-delete','admin','2023-10-22 06:27:24','2023-10-22 06:27:24'),(175,'Form Builder','form-bulk-delete','admin','2023-10-22 06:27:24','2023-10-22 06:27:24'),(176,'Widget Builder','widget-list','admin','2023-10-22 06:35:42','2023-10-22 06:35:42'),(177,'Widget Builder','widget-add','admin','2023-10-22 06:35:42','2023-10-22 06:35:42'),(178,'Widget Builder','widget-update','admin','2023-10-22 06:35:42','2023-10-22 06:35:42'),(179,'Widget Builder','widget-delete','admin','2023-10-22 06:35:42','2023-10-22 06:35:42'),(180,'Email Template','email-template-list','admin','2023-10-22 06:39:35','2023-10-22 06:39:35'),(181,'Email Template','email-template-details','admin','2023-10-22 06:39:35','2023-10-22 06:39:35'),(182,'Email Template','email-template-update','admin','2023-10-22 06:39:35','2023-10-22 06:39:35'),(183,'Email Template','email-template-delete','admin','2023-10-22 06:39:36','2023-10-22 06:39:36'),(184,'Pages','page-list','admin','2023-10-22 06:47:37','2023-10-22 06:47:37'),(185,'Pages','page-create-new','admin','2023-10-22 06:47:37','2023-10-22 06:47:37'),(186,'Pages','page-edit','admin','2023-10-22 06:47:37','2023-10-22 06:47:37'),(187,'Pages','page-update','admin','2023-10-22 06:47:37','2023-10-22 06:47:37'),(188,'Pages','page-delete','admin','2023-10-22 06:47:37','2023-10-22 06:47:37'),(189,'Pages','page-delete-bulk-action','admin','2023-10-22 06:47:38','2023-10-22 06:47:38'),(190,'Pages','manage-404-page','admin','2023-10-22 06:47:38','2023-10-22 06:47:38'),(191,'Pages','update-404-page','admin','2023-10-22 06:47:38','2023-10-22 06:47:38'),(192,'Pages','manage-maintenance-page','admin','2023-10-22 06:47:38','2023-10-22 06:47:38'),(193,'Pages','update-maintenance-page','admin','2023-10-22 06:47:38','2023-10-22 06:47:38'),(194,'Language','language-list','admin','2023-10-22 06:54:01','2023-10-22 06:54:01'),(195,'Language','language-add','admin','2023-10-22 06:54:01','2023-10-22 06:54:01'),(196,'Language','language-edit','admin','2023-10-22 06:54:01','2023-10-22 06:54:01'),(197,'Language','language-word-edit','admin','2023-10-22 06:54:01','2023-10-22 06:54:01'),(198,'User Subscription','user-subscription-manual-payment-status-change','admin','2023-10-25 04:31:06','2023-10-25 04:31:06'),(199,'Support Ticket','support-ticket-add','admin','2023-10-25 05:53:02','2023-10-25 05:53:02'),(200,'Language','language-word-list','admin','2023-10-25 22:44:08','2023-10-25 22:44:08'),(201,'Language','language-word-add','admin','2023-10-25 22:48:59','2023-10-25 22:48:59'),(202,'User Manage','user-identity-verify-request-list','admin','2023-10-25 23:04:19','2023-10-25 23:04:19'),(203,'Blog Manage','blog-list','admin','2024-01-04 06:37:10','2024-01-04 06:37:10'),(204,'Blog Manage','blog-add','admin','2024-01-04 06:37:10','2024-01-04 06:37:10'),(205,'Blog Manage','blog-edit','admin','2024-01-04 06:37:10','2024-01-04 06:37:10'),(206,'Blog Manage','blog-delete','admin','2024-01-04 06:37:11','2024-01-04 06:37:11'),(207,'License Manage','generate-license-key','admin','2024-01-04 06:37:11','2024-01-04 06:37:11'),(208,'License Manage','update-license','admin','2024-01-04 06:37:11','2024-01-04 06:37:11'),(209,'Admin Role and Transaction','admin-role-manage','admin','2024-11-18 11:24:45','2024-11-18 11:24:45'),(210,'Admin Role and Transaction','transaction-manage','admin','2024-11-18 11:24:45','2024-11-18 11:24:45');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
INSERT INTO `personal_access_tokens` VALUES (46,'App\\Models\\User',1237,'xilancerapi_keys','626335a4e070c2aa7f64ed003951c4a8eb485605b84f6a04fa030df3535ad22e','[\"*\"]',NULL,NULL,'2026-04-16 12:10:32','2026-04-16 12:10:32'),(47,'App\\Models\\User',1237,'xilancerapi_keys','a788b6fff212626738e7b75ae3a4732f17c69d7510ffb639ccbb9184700d5b33','[\"*\"]',NULL,NULL,'2026-04-16 12:11:53','2026-04-16 12:11:53'),(48,'App\\Models\\User',1237,'xilancerapi_keys','af2cfecfe8ac2c70c2b0881319d109f2e725380edf543c15c7f2379f6d7555cb','[\"*\"]','2026-04-16 12:51:12',NULL,'2026-04-16 12:14:22','2026-04-16 12:51:12'),(79,'App\\Models\\User',7,'test','89e811125dd46b069e99353d023293094742298e05ecb12adb43fa45183865d4','[\"*\"]',NULL,NULL,'2026-04-25 15:28:54','2026-04-25 15:28:54'),(104,'App\\Models\\User',1236,'xilancerapi_keys','d04147ea87ec9589b32258f15f59d591b1a0b80c2cd070a6db260eed8f309f3c','[\"*\"]','2026-05-07 06:02:39',NULL,'2026-05-07 05:34:09','2026-05-07 06:02:39'),(105,'App\\Models\\User',1236,'xilancerapi_keys','d04c485384aa747cd9ee229ce0de47ad9cb3423044f93a1682f538c612bae3d0','[\"*\"]','2026-05-09 10:01:30',NULL,'2026-05-07 06:17:18','2026-05-09 10:01:30');
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `portfolios`
--

DROP TABLE IF EXISTS `portfolios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `portfolios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `published_date` varchar(255) DEFAULT NULL,
  `load_from` int(11) NOT NULL DEFAULT 0,
  `is_synced` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `portfolios`
--

LOCK TABLES `portfolios` WRITE;
/*!40000 ALTER TABLE `portfolios` DISABLE KEYS */;
INSERT INTO `portfolios` VALUES (1,1236,'ahmeteren1999','1775506729-69d4152960738.png','Test Projesi','Test projesi açıklaması Test projesi açıklaması Test projesi açıklaması',NULL,0,0,'2026-04-06 17:18:49','2026-04-06 17:18:49'),(2,1,'client','1777291925-69ef52959b1a7.jpg','Portfolyo Projesi','Önceden yaptığımız iş',NULL,0,0,'2026-04-27 09:12:05','2026-04-27 09:12:05');
/*!40000 ALTER TABLE `portfolios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_attributes`
--

DROP TABLE IF EXISTS `project_attributes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `project_attributes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `create_project_id` bigint(20) NOT NULL,
  `type` varchar(191) DEFAULT NULL,
  `is_paid` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = free, 1 = paid',
  `check_numeric_title` varchar(255) DEFAULT NULL,
  `basic_check_numeric` varchar(255) DEFAULT NULL,
  `basic_extra_price` decimal(10,2) DEFAULT NULL,
  `standard_check_numeric` varchar(255) DEFAULT NULL,
  `standard_extra_price` decimal(10,2) DEFAULT NULL,
  `premium_check_numeric` varchar(255) DEFAULT NULL,
  `premium_extra_price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2263 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_attributes`
--

LOCK TABLES `project_attributes` WRITE;
/*!40000 ALTER TABLE `project_attributes` DISABLE KEYS */;
INSERT INTO `project_attributes` VALUES (2259,1236,193,'checkbox',0,'Test Paket','on',NULL,'off',NULL,'off',NULL,NULL,'2026-05-04 13:41:23'),(2260,1236,194,'checkbox',0,'Deneme','on',NULL,'off',NULL,'off',NULL,NULL,'2026-05-04 13:43:15'),(2261,1236,199,'checkbox',0,'Deneme','on',NULL,'off',NULL,'off',NULL,NULL,'2026-05-04 13:44:25'),(2262,1236,204,'checkbox',0,'test','on',NULL,'off',NULL,'off',NULL,NULL,'2026-05-04 13:45:09');
/*!40000 ALTER TABLE `project_attributes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_histories`
--

DROP TABLE IF EXISTS `project_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `project_histories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `reject_count` bigint(20) DEFAULT NULL,
  `edit_count` bigint(20) DEFAULT NULL,
  `reject_reason` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_histories`
--

LOCK TABLES `project_histories` WRITE;
/*!40000 ALTER TABLE `project_histories` DISABLE KEYS */;
INSERT INTO `project_histories` VALUES (35,194,1236,0,5,NULL,'2026-04-05 17:19:52','2026-05-04 13:43:15'),(36,199,1236,0,4,NULL,'2026-04-05 19:26:14','2026-05-04 13:44:25'),(37,204,1236,0,10,NULL,'2026-04-12 15:16:27','2026-05-04 13:45:09'),(38,214,1,0,4,NULL,'2026-04-24 06:54:54','2026-05-04 13:49:12'),(39,207,1,0,2,NULL,'2026-04-24 10:34:21','2026-05-04 13:48:19'),(40,193,1236,0,1,NULL,'2026-05-04 13:41:23','2026-05-04 13:41:23');
/*!40000 ALTER TABLE `project_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_promote_settings`
--

DROP TABLE IF EXISTS `project_promote_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `project_promote_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `budget` double NOT NULL,
  `duration` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_promote_settings`
--

LOCK TABLES `project_promote_settings` WRITE;
/*!40000 ALTER TABLE `project_promote_settings` DISABLE KEYS */;
INSERT INTO `project_promote_settings` VALUES (1,'7 Gün',NULL,700,7,1,'2024-05-09 15:15:21','2026-04-27 14:56:20'),(2,'5 Gün',NULL,500,5,1,'2024-05-09 15:17:29','2026-04-27 14:56:09'),(3,'3 Gün',NULL,300,3,1,'2024-05-09 15:18:44','2026-04-27 14:55:56');
/*!40000 ALTER TABLE `project_promote_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_service_areas`
--

DROP TABLE IF EXISTS `project_service_areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `project_service_areas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` bigint(20) unsigned NOT NULL,
  `country_id` bigint(20) unsigned NOT NULL,
  `state_id` bigint(20) unsigned NOT NULL,
  `city_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_service_areas_project_id_foreign` (`project_id`),
  KEY `project_service_areas_country_id_index` (`country_id`),
  KEY `project_service_areas_state_id_index` (`state_id`),
  KEY `project_service_areas_city_id_index` (`city_id`),
  CONSTRAINT `project_service_areas_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_service_areas`
--

LOCK TABLES `project_service_areas` WRITE;
/*!40000 ALTER TABLE `project_service_areas` DISABLE KEYS */;
INSERT INTO `project_service_areas` VALUES (1,193,15,26,22,'2026-04-21 15:37:54','2026-04-21 15:37:54'),(6,194,15,26,22,'2026-04-21 16:03:54','2026-04-21 16:03:54'),(7,194,15,26,23,'2026-04-21 16:03:54','2026-04-21 16:03:54'),(10,199,15,26,22,'2026-04-22 14:28:20','2026-04-22 14:28:20'),(11,204,15,26,22,'2026-04-23 19:02:43','2026-04-23 19:02:43'),(12,204,15,26,23,'2026-04-23 19:02:43','2026-04-23 19:02:43'),(13,207,15,26,22,'2026-04-24 10:34:21','2026-04-24 10:34:21');
/*!40000 ALTER TABLE `project_service_areas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_sub_categories`
--

DROP TABLE IF EXISTS `project_sub_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `project_sub_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` bigint(20) NOT NULL,
  `sub_category_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=262 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_sub_categories`
--

LOCK TABLES `project_sub_categories` WRITE;
/*!40000 ALTER TABLE `project_sub_categories` DISABLE KEYS */;
INSERT INTO `project_sub_categories` VALUES (218,180,36,'2025-06-30 12:09:30','2025-06-30 12:09:30'),(219,181,20,'2025-07-02 01:12:11','2025-07-02 01:12:11'),(220,181,21,'2025-07-02 01:12:11','2025-07-02 01:12:11'),(221,182,1,'2025-10-13 23:23:21','2025-10-13 23:23:21'),(223,184,1,'2025-11-02 03:53:40','2025-11-02 03:53:40'),(224,185,21,'2025-11-02 04:06:29','2025-11-02 04:06:29'),(225,186,20,'2025-12-20 17:14:08','2025-12-20 17:14:08'),(228,189,21,'2026-01-19 17:26:50','2026-01-19 17:26:50'),(229,189,22,'2026-01-19 17:26:50','2026-01-19 17:26:50'),(230,190,20,'2026-01-20 03:41:23','2026-01-20 03:41:23'),(231,191,20,'2026-01-20 06:46:34','2026-01-20 06:46:34'),(232,192,21,'2026-01-22 11:14:06','2026-01-22 11:14:06'),(233,193,38,'2026-03-27 17:45:30','2026-03-27 17:45:30'),(234,194,39,'2026-04-05 11:53:24','2026-04-05 11:53:24'),(239,199,39,'2026-04-05 19:25:47','2026-04-05 19:25:47'),(244,204,38,'2026-04-06 18:32:07','2026-04-06 18:32:07'),(247,207,49,'2026-04-16 12:41:13','2026-04-16 12:41:13'),(260,214,49,'2026-04-23 11:27:39','2026-04-23 11:27:39'),(261,214,51,'2026-04-23 11:27:39','2026-04-23 11:27:39');
/*!40000 ALTER TABLE `project_sub_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `projects` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `basic_title` varchar(255) NOT NULL,
  `standard_title` varchar(255) DEFAULT NULL,
  `premium_title` varchar(255) DEFAULT NULL,
  `basic_revision` varchar(255) DEFAULT NULL,
  `standard_revision` varchar(255) DEFAULT NULL,
  `premium_revision` varchar(255) DEFAULT NULL,
  `basic_delivery` varchar(255) DEFAULT NULL,
  `standard_delivery` varchar(255) DEFAULT NULL,
  `premium_delivery` varchar(255) DEFAULT NULL,
  `basic_regular_charge` double NOT NULL,
  `basic_discount_charge` double DEFAULT NULL,
  `standard_regular_charge` double DEFAULT NULL,
  `standard_discount_charge` double DEFAULT NULL,
  `premium_regular_charge` double DEFAULT NULL,
  `premium_discount_charge` double DEFAULT NULL,
  `project_on_off` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=off, 1=on',
  `project_approve_request` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=request for approve, 1=approve,2=2 will change to 0 when the user resubmit after rejected.',
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'o=pending, 1=approve',
  `is_pro` varchar(255) DEFAULT NULL,
  `pro_expire_date` timestamp NULL DEFAULT NULL,
  `is_subscription_promoted` tinyint(4) DEFAULT 0,
  `offer_packages_available_or_not` int(11) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_tags` text DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `load_from` int(11) NOT NULL DEFAULT 0,
  `is_synced` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=215 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (193,1236,13,'Her türlü kapı açılır','her-türlü-kapı-açılır','<p>Her türlü kapı açılırHer türlü kapı açılırHer türlü kapı açılır</p>','[\"1777912883-69f8cc336eba7.jpg\"]',NULL,'Basic',NULL,NULL,'1',NULL,NULL,'1 Gün',NULL,NULL,50,40,NULL,NULL,NULL,NULL,1,1,1,NULL,NULL,0,0,NULL,NULL,NULL,15,26,22,0,0,'2026-03-27 17:45:30','2026-05-07 10:12:32'),(194,1236,11,'Ben şunu bunu yapıyorum','hizmet','Test Test Test Test Test Test Test Test Test Test Test Test Test Test v Test Test Test Test Test Test Test Test Test Test Test Test Test Test','[\"1777912995-69f8cca3cd02c.jpg\"]',NULL,'Basic',NULL,NULL,'1',NULL,NULL,'1 Gün',NULL,NULL,300,0,NULL,NULL,NULL,NULL,1,1,1,'yes','2026-05-05 04:27:26',1,0,NULL,NULL,NULL,15,26,22,0,0,'2026-04-05 11:53:24','2026-05-06 14:57:06'),(199,1236,11,'2. Su Borusu Tamir İlanı','slugslugher-tu00fcrlu00fc-kapu0131-au00e7u0131lu0131ris-pro-projectfalsemediaimagesfirst-imagenullis-pro-projectfalsemediaimagesfirst-imagenull','2. Su borusu tamir ilanı 2. Su borusu tamir ilanı 2. Su borusu tamir ilanı','[\"1777913065-69f8cce9cec5a.jpeg\"]',NULL,'Basic',NULL,NULL,'4',NULL,NULL,'1 Gün',NULL,NULL,400,399,NULL,NULL,NULL,NULL,1,1,1,NULL,NULL,0,0,NULL,NULL,NULL,15,26,22,0,0,'2026-04-05 19:25:47','2026-05-06 14:59:54'),(204,1236,13,'Çilingir Deneme Hizmeti','cilingir','Çilingir hizmeti için deneme hizmeti test için yapıldı edit test edildi','[\"1777913109-69f8cd15e83e5.jpg\"]',NULL,'Basic',NULL,NULL,'4',NULL,NULL,'1 Gün',NULL,NULL,1000,0,NULL,NULL,NULL,NULL,1,1,1,NULL,NULL,1,0,NULL,NULL,NULL,15,26,22,0,0,'2026-04-06 18:32:07','2026-05-07 10:12:34'),(207,1,23,'mobilya kurulum','n-un-sjjsjsjsjjsjsjsjsjsuududuududusuduududududjjdjdd','FshshsbsbbshsjsjsjsjdjsjjzjJsjJjzjzjjzjsjzjzjzjzjzjznzjzjzjzjzjzjzjjzjzbsbshsgs','[\"1777913299-69f8cdd35f19a.jpg\"]',NULL,'Basic',NULL,NULL,'4',NULL,NULL,'1 Gün',NULL,NULL,1000,999,NULL,NULL,NULL,NULL,1,1,1,'yes','2026-05-01 03:57:38',0,0,NULL,NULL,NULL,15,26,22,0,0,'2026-04-16 12:41:13','2026-05-04 13:48:19'),(214,1,23,'süper Elektirik','jsjsjsjjs','Test Test Test Test Test Test Test Test Test Test Test Test Test v v v Test Test Test Test Test Test Test Test Test&nbsp;','[\"1777913352-69f8ce085da63.jpg\"]',NULL,'Basic',NULL,NULL,'4',NULL,NULL,'1 Gün',NULL,NULL,1000,900,NULL,NULL,NULL,NULL,1,1,1,'yes','2026-05-07 13:54:06',0,0,NULL,NULL,NULL,15,NULL,NULL,0,0,'2026-04-23 11:27:39','2026-05-04 13:49:12');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promotion_project_lists`
--

DROP TABLE IF EXISTS `promotion_project_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `promotion_project_lists` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `identity` bigint(20) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL COMMENT 'project,profile,proposal',
  `package_id` int(11) NOT NULL,
  `price` double NOT NULL DEFAULT 0,
  `transaction_fee` double DEFAULT NULL,
  `duration` bigint(20) NOT NULL DEFAULT 0,
  `expire_date` timestamp NULL DEFAULT NULL,
  `payment_gateway` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `is_valid_payment` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `email_send` varchar(255) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `manual_payment_image` varchar(255) DEFAULT NULL,
  `impression` int(11) NOT NULL DEFAULT 0,
  `click` int(11) NOT NULL DEFAULT 0,
  `country` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promotion_project_lists`
--

LOCK TABLES `promotion_project_lists` WRITE;
/*!40000 ALTER TABLE `promotion_project_lists` DISABLE KEYS */;
INSERT INTO `promotion_project_lists` VALUES (1,1,214,'project',1,10,NULL,10,'2026-05-07 13:54:06','wallet','complete','yes',1,NULL,NULL,NULL,11,0,NULL,'2026-04-27 13:54:06','2026-05-05 13:38:52'),(2,1,207,'project',3,300,NULL,3,'2026-04-30 16:20:40','iyzipay','pending',NULL,0,NULL,NULL,NULL,0,0,NULL,'2026-04-27 16:20:40','2026-04-27 16:20:40'),(3,1,207,'project',3,300,NULL,3,'2026-04-30 16:22:43','iyzipay','pending',NULL,0,NULL,NULL,NULL,0,0,NULL,'2026-04-27 16:22:43','2026-04-27 16:22:43'),(4,1,207,'project',3,300,NULL,3,'2026-04-30 16:26:33','iyzipay','pending',NULL,0,NULL,NULL,NULL,0,0,NULL,'2026-04-27 16:26:33','2026-04-27 16:26:33'),(5,1,207,'project',3,300,NULL,3,'2026-05-01 03:57:38','iyzipay','complete','yes',1,NULL,'31336304',NULL,0,0,NULL,'2026-04-28 03:57:38','2026-04-28 03:57:46'),(6,1236,194,'project',1,700,NULL,7,'2026-05-05 04:27:26','iyzipay','complete','yes',1,NULL,'31337010',NULL,11,2,NULL,'2026-04-28 04:27:26','2026-05-04 18:16:16');
/*!40000 ALTER TABLE `promotion_project_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question_answers`
--

DROP TABLE IF EXISTS `question_answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `question_answers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  `answer` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question_answers`
--

LOCK TABLES `question_answers` WRITE;
/*!40000 ALTER TABLE `question_answers` DISABLE KEYS */;
/*!40000 ALTER TABLE `question_answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question_tip_answer_reactions`
--

DROP TABLE IF EXISTS `question_tip_answer_reactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `question_tip_answer_reactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `question_tip_id` bigint(20) NOT NULL,
  `answer_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `status` int(11) DEFAULT NULL COMMENT '0 for inactive, 1 for active',
  `like` varchar(255) DEFAULT NULL,
  `haha` varchar(255) DEFAULT NULL,
  `up` varchar(255) DEFAULT NULL,
  `sad` varchar(255) DEFAULT NULL,
  `support` varchar(255) DEFAULT NULL,
  `congrats` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question_tip_answer_reactions`
--

LOCK TABLES `question_tip_answer_reactions` WRITE;
/*!40000 ALTER TABLE `question_tip_answer_reactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `question_tip_answer_reactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question_tip_answer_replies`
--

DROP TABLE IF EXISTS `question_tip_answer_replies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `question_tip_answer_replies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `question_tip_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) NOT NULL,
  `answer_id` bigint(20) NOT NULL,
  `reply` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question_tip_answer_replies`
--

LOCK TABLES `question_tip_answer_replies` WRITE;
/*!40000 ALTER TABLE `question_tip_answer_replies` DISABLE KEYS */;
/*!40000 ALTER TABLE `question_tip_answer_replies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question_tip_answers`
--

DROP TABLE IF EXISTS `question_tip_answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `question_tip_answers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `question_tip_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `answer` text NOT NULL,
  `parent_answer_id` bigint(20) unsigned DEFAULT NULL,
  `is_author_reply` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question_tip_answers`
--

LOCK TABLES `question_tip_answers` WRITE;
/*!40000 ALTER TABLE `question_tip_answers` DISABLE KEYS */;
/*!40000 ALTER TABLE `question_tip_answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question_tip_reactions`
--

DROP TABLE IF EXISTS `question_tip_reactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `question_tip_reactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `question_tip_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `status` int(11) DEFAULT NULL COMMENT '0 for inactive, 1 for active',
  `like` varchar(255) DEFAULT NULL,
  `haha` varchar(255) DEFAULT NULL,
  `up` varchar(255) DEFAULT NULL,
  `sad` varchar(255) DEFAULT NULL,
  `support` varchar(255) DEFAULT NULL,
  `congrats` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question_tip_reactions`
--

LOCK TABLES `question_tip_reactions` WRITE;
/*!40000 ALTER TABLE `question_tip_reactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `question_tip_reactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question_tips`
--

DROP TABLE IF EXISTS `question_tips`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `question_tips` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `vote` bigint(20) NOT NULL DEFAULT 0,
  `question_user_id` bigint(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0 for inactive, 1 for active',
  `like` bigint(20) NOT NULL DEFAULT 0,
  `haha` bigint(20) NOT NULL DEFAULT 0,
  `up` bigint(20) NOT NULL DEFAULT 0,
  `sad` bigint(20) NOT NULL DEFAULT 0,
  `support` bigint(20) NOT NULL DEFAULT 0,
  `congrats` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question_tips`
--

LOCK TABLES `question_tips` WRITE;
/*!40000 ALTER TABLE `question_tips` DISABLE KEYS */;
/*!40000 ALTER TABLE `question_tips` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rating_details`
--

DROP TABLE IF EXISTS `rating_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rating_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `rating_id` bigint(20) NOT NULL,
  `type` varchar(255) DEFAULT NULL COMMENT 'skill,availability,communication,deadline,quality,co-operation',
  `rating` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rating_details`
--

LOCK TABLES `rating_details` WRITE;
/*!40000 ALTER TABLE `rating_details` DISABLE KEYS */;
INSERT INTO `rating_details` VALUES (1,1,'skill',5,'2026-04-05 12:17:10','2026-04-05 12:17:10'),(2,1,'availability',5,'2026-04-05 12:17:10','2026-04-05 12:17:10'),(3,1,'communication',5,'2026-04-05 12:17:10','2026-04-05 12:17:10'),(4,1,'work-quality',5,'2026-04-05 12:17:10','2026-04-05 12:17:10'),(5,1,'deadline',5,'2026-04-05 12:17:10','2026-04-05 12:17:10'),(6,1,'co-operation',5,'2026-04-05 12:17:10','2026-04-05 12:17:10'),(7,3,'skill',5,'2026-04-05 19:54:34','2026-04-05 19:54:34'),(8,3,'availability',2,'2026-04-05 19:54:34','2026-04-05 19:54:34'),(9,3,'communication',2,'2026-04-05 19:54:34','2026-04-05 19:54:34'),(10,3,'work-quality',3,'2026-04-05 19:54:34','2026-04-05 19:54:34'),(11,3,'deadline',1,'2026-04-05 19:54:34','2026-04-05 19:54:34'),(12,3,'co-operation',1,'2026-04-05 19:54:34','2026-04-05 19:54:34'),(13,4,'skill',1,'2026-04-06 15:43:17','2026-04-06 15:43:17'),(14,4,'availability',1,'2026-04-06 15:43:17','2026-04-06 15:43:17'),(15,4,'communication',1,'2026-04-06 15:43:17','2026-04-06 15:43:17'),(16,4,'work-quality',1,'2026-04-06 15:43:17','2026-04-06 15:43:17'),(17,4,'deadline',1,'2026-04-06 15:43:17','2026-04-06 15:43:17'),(18,4,'co-operation',1,'2026-04-06 15:43:17','2026-04-06 15:43:17'),(19,5,'skill',5,'2026-04-26 14:41:15','2026-04-26 14:41:15'),(20,5,'availability',5,'2026-04-26 14:41:15','2026-04-26 14:41:15'),(21,5,'communication',5,'2026-04-26 14:41:15','2026-04-26 14:41:15'),(22,5,'work-quality',5,'2026-04-26 14:41:15','2026-04-26 14:41:15'),(23,5,'deadline',5,'2026-04-26 14:41:15','2026-04-26 14:41:15'),(24,5,'co-operation',5,'2026-04-26 14:41:15','2026-04-26 14:41:15'),(25,6,'skill',5,'2026-04-28 05:52:25','2026-04-28 05:52:25'),(26,6,'availability',5,'2026-04-28 05:52:25','2026-04-28 05:52:25'),(27,6,'communication',5,'2026-04-28 05:52:25','2026-04-28 05:52:25'),(28,6,'work-quality',5,'2026-04-28 05:52:25','2026-04-28 05:52:25'),(29,6,'deadline',5,'2026-04-28 05:52:25','2026-04-28 05:52:25'),(30,6,'co-operation',5,'2026-04-28 05:52:25','2026-04-28 05:52:25');
/*!40000 ALTER TABLE `rating_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ratings`
--

DROP TABLE IF EXISTS `ratings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ratings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) NOT NULL,
  `sender_id` bigint(20) NOT NULL,
  `sender_type` tinyint(4) NOT NULL COMMENT '1=client, 2=freelancer',
  `rating` double NOT NULL,
  `review_feedback` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ratings`
--

LOCK TABLES `ratings` WRITE;
/*!40000 ALTER TABLE `ratings` DISABLE KEYS */;
INSERT INTO `ratings` VALUES (1,17,1,1,5,'Fazlasıyla başarılı','2026-04-05 12:17:10','2026-04-05 12:17:10'),(2,17,1236,2,0,'Harika bir müşteri sorunsuz geçti','2026-04-05 12:46:41','2026-04-05 12:46:41'),(3,21,1,1,2.3,NULL,'2026-04-05 19:54:34','2026-04-05 19:54:34'),(4,26,1,1,1,'Beklediğim gibi değildi sakın güvenmeyin yeteneksiz','2026-04-06 15:43:17','2026-04-06 15:43:17'),(5,72,1,1,5,'Çok başarılı','2026-04-26 14:41:15','2026-04-26 14:41:15'),(6,74,1,1,5,'on numara Adam','2026-04-28 05:52:25','2026-04-28 05:52:25');
/*!40000 ALTER TABLE `ratings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reports` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) DEFAULT NULL,
  `client_id` bigint(20) NOT NULL,
  `freelancer_id` bigint(20) NOT NULL,
  `reporter` varchar(255) DEFAULT NULL COMMENT 'freelancer, client',
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reports`
--

LOCK TABLES `reports` WRITE;
/*!40000 ALTER TABLE `reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Super Admin','admin','2023-10-19 07:28:11','2023-10-19 07:28:11'),(2,'Admin','admin','2023-10-19 07:31:16','2023-10-19 07:31:16'),(6,'Editor','admin','2023-10-23 01:03:36','2023-10-23 01:03:36');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `skills`
--

DROP TABLE IF EXISTS `skills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `skills` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `skill` varchar(255) NOT NULL,
  `category_id` varchar(255) NOT NULL,
  `sub_category_id` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=inactive 1=active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skills`
--

LOCK TABLES `skills` WRITE;
/*!40000 ALTER TABLE `skills` DISABLE KEYS */;
/*!40000 ALTER TABLE `skills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `states` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `country_id` int(11) DEFAULT NULL,
  `state` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=inactive 1=active',
  `timezone` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `states`
--

LOCK TABLES `states` WRITE;
/*!40000 ALTER TABLE `states` DISABLE KEYS */;
INSERT INTO `states` VALUES (26,15,'Bursa',1,NULL,'2026-04-21 14:21:21','2026-04-21 14:21:21');
/*!40000 ALTER TABLE `states` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `static_options`
--

DROP TABLE IF EXISTS `static_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `static_options` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `option_name` varchar(255) NOT NULL,
  `option_value` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=511 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `static_options`
--

LOCK TABLES `static_options` WRITE;
/*!40000 ALTER TABLE `static_options` DISABLE KEYS */;
INSERT INTO `static_options` VALUES (1,'site_title','Xilancer','2022-12-10 01:37:26','2026-03-27 16:15:34'),(2,'site_footer_copyright','{copy}  {year}  All right reserved by  <a href=\"https://xilancer.xgenious.com/\">xgenious</a>','2022-12-10 01:37:26','2026-03-27 16:15:34'),(3,'disable_user_email_verify',NULL,'2022-12-10 01:37:26','2026-03-27 16:15:34'),(4,'site_maintenance_mode',NULL,'2022-12-10 01:37:26','2026-03-27 16:15:34'),(5,'admin_loader_animation',NULL,'2022-12-10 01:37:26','2026-03-27 16:15:34'),(6,'site_loader_animation','on','2022-12-10 01:37:26','2026-03-27 16:15:34'),(7,'site_force_ssl_redirection',NULL,'2022-12-10 01:37:26','2026-03-27 16:15:34'),(8,'site_google_captcha_enable',NULL,'2022-12-10 01:37:26','2026-03-27 16:15:34'),(9,'site_logo','324','2022-12-11 23:42:42','2026-05-05 13:37:25'),(10,'site_favicon','328','2022-12-11 23:42:42','2026-05-05 13:37:25'),(11,'site_main_color_one','#9c3030','2022-12-12 00:51:22','2022-12-12 00:51:48'),(12,'site_main_color_two','#000000','2022-12-12 00:51:22','2022-12-12 00:51:48'),(13,'site_main_color_three','#4b1111','2022-12-12 00:51:22','2022-12-12 00:51:48'),(14,'heading_color','#1D2635','2022-12-12 00:51:22','2026-05-05 13:43:48'),(15,'light_color','#a04eb7','2022-12-12 00:51:22','2022-12-12 00:51:48'),(16,'extra_light_color','#000000','2022-12-12 00:51:22','2022-12-12 00:51:48'),(17,'body_font_family','Poppins','2022-12-12 05:19:22','2026-01-08 10:21:56'),(18,'heading_font_family','Poppins','2022-12-12 05:19:22','2026-01-08 10:21:56'),(19,'extra_body_font',NULL,'2022-12-12 05:19:22','2026-01-08 10:21:56'),(20,'heading_font','on','2022-12-12 05:19:22','2026-01-08 10:21:56'),(21,'body_font_variant','a:9:{i:0;s:5:\"0,100\";i:1;s:5:\"0,200\";i:2;s:5:\"0,300\";i:3;s:5:\"0,400\";i:4;s:5:\"0,500\";i:5;s:5:\"0,600\";i:6;s:5:\"0,700\";i:7;s:5:\"0,800\";i:8;s:5:\"0,900\";}','2022-12-12 05:19:22','2026-01-08 10:21:56'),(22,'heading_font_variant','a:9:{i:0;s:5:\"0,100\";i:1;s:5:\"0,200\";i:2;s:5:\"0,300\";i:3;s:5:\"0,400\";i:4;s:5:\"0,500\";i:5;s:5:\"0,600\";i:6;s:5:\"0,700\";i:7;s:5:\"0,800\";i:8;s:5:\"0,900\";}','2022-12-12 05:19:22','2026-01-08 10:21:56'),(23,'site_meta_tags','fds sdsdf sdf sdf ,sdf sdf sdf sdf sdfsd ,sdf sdf sdf sd','2022-12-13 00:03:23','2022-12-13 00:03:23'),(24,'site_meta_description','Xilancr market place','2022-12-13 00:03:23','2022-12-13 00:03:23'),(25,'og_meta_title','Xilancr market place','2022-12-13 00:03:23','2022-12-13 00:03:23'),(26,'og_meta_description','Xilancr market place','2022-12-13 00:03:23','2022-12-13 00:03:23'),(27,'og_meta_site_name','Xilancr market place','2022-12-13 00:03:23','2022-12-13 00:03:23'),(28,'og_meta_url','Xilancr market place','2022-12-13 00:03:24','2022-12-13 00:03:24'),(29,'og_meta_image','2','2022-12-13 00:03:24','2022-12-13 00:03:24'),(30,'site_third_party_tracking_code',NULL,'2022-12-13 01:46:32','2022-12-13 04:41:00'),(31,'site_google_analytics',NULL,'2022-12-13 01:46:32','2022-12-13 04:41:00'),(32,'site_google_captcha_v3_site_key','6LcJtlYpAAAAAAZAJk7pjWKhz09FRSWLCYyKVpAd','2022-12-13 01:46:32','2024-01-27 06:49:27'),(33,'site_google_captcha_v3_secret_key','6LcJtlYpAAAAAENuELMZG9N3UqUak0bV0IvioEHA','2022-12-13 01:46:32','2024-01-27 06:49:27'),(34,'tawk_api_key',NULL,'2022-12-13 01:46:32','2022-12-13 04:41:00'),(35,'facebook_client_id','713291307367672','2022-12-13 04:59:55','2024-03-10 14:52:54'),(36,'facebook_client_secret','5ec25da1868a7b58b838850570b90c08','2022-12-13 04:59:55','2024-03-10 14:52:54'),(37,'google_client_id','483808191107-sjonvl0tg80j1mk63i8tsjdub7ql9v4a.apps.googleusercontent.com','2022-12-13 04:59:55','2024-03-10 14:52:54'),(38,'google_client_secret','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','2022-12-13 04:59:55','2024-03-10 14:52:54'),(39,'site_global_email','info@xilancer.xgenious.com','2022-12-13 07:46:18','2026-01-20 03:53:30'),(40,'site_global_email_template','<p>sdf sdf sdf sdf sdfs dsdf sdf&nbsp;</p>','2022-12-13 07:46:18','2026-01-20 03:53:30'),(41,'site_smtp_mail_mailer','smtp','2022-12-14 00:53:07','2026-01-20 03:58:52'),(42,'site_smtp_mail_host','smtp.gmail.com','2022-12-14 00:53:07','2026-01-20 03:58:52'),(43,'site_smtp_mail_port','587','2022-12-14 00:53:07','2026-01-20 03:58:52'),(44,'site_smtp_mail_username','info@xilancer.xgenious.com','2022-12-14 00:53:07','2026-01-20 03:58:52'),(45,'site_smtp_mail_password','12345678','2022-12-14 00:53:07','2026-01-20 03:58:52'),(46,'site_smtp_mail_encryption','tls','2022-12-14 00:53:07','2026-01-20 03:58:52'),(47,'site_gdpr_cookie_title','Cookies & Privacy','2022-12-15 03:19:57','2026-01-19 10:04:22'),(48,'site_gdpr_cookie_message','Is education residence conveying so so. Suppose shyness say ten behaved morning had. Any unsatiable assistance compliment occasional too reasonably advantages.','2022-12-15 03:19:57','2026-01-19 10:04:22'),(49,'site_gdpr_cookie_more_info_label','More information','2022-12-15 03:19:57','2026-01-19 10:04:22'),(50,'site_gdpr_cookie_more_info_link','{url}/privacy-policy','2022-12-15 03:19:57','2026-01-19 10:04:22'),(51,'site_gdpr_cookie_accept_button_label','Accept','2022-12-15 03:19:57','2026-01-19 10:04:22'),(52,'site_gdpr_cookie_decline_button_label','Decline','2022-12-15 03:19:57','2026-01-19 10:04:22'),(53,'site_gdpr_cookie_manage_button_label','Manage','2022-12-15 03:19:57','2026-01-19 10:04:22'),(54,'site_gdpr_cookie_manage_title',NULL,'2022-12-15 03:19:57','2026-01-19 10:04:22'),(55,'site_gdpr_cookie_manage_item_title','a:2:{i:0;s:4:\"test\";i:1;s:8:\"yr dfdfg\";}','2022-12-15 03:19:57','2026-01-19 10:04:22'),(56,'site_gdpr_cookie_manage_item_description','a:2:{i:0;s:14:\"sadas dsa asda\";i:1;s:61:\"fg dfg dfgdf dfgdfg dfg dfg dfg dfg dfg dfg dfg dfgdfgdfg d d\";}','2022-12-15 03:19:57','2026-01-19 10:04:22'),(57,'site_gdpr_cookie_delay','3000','2022-12-15 03:19:57','2026-01-19 10:04:22'),(58,'site_gdpr_cookie_enabled','on','2022-12-15 03:19:57','2026-01-19 10:04:22'),(59,'site_gdpr_cookie_expire','30','2022-12-15 03:19:57','2026-01-19 10:04:22'),(60,'global_navbar_variant','04','2022-12-15 07:08:00','2025-12-28 05:28:17'),(61,'global_footer_variant','03','2022-12-17 23:45:33','2026-01-20 17:27:56'),(62,'paypal_preview_logo','198','2022-12-20 01:33:51','2026-04-02 09:29:24'),(63,'paypal_mode',NULL,'2022-12-20 01:33:51','2023-04-09 22:54:08'),(64,'paypal_sandbox_client_id','AUP7AuZMwJbkee-2OmsSZrU-ID1XUJYE-YB-2JOrxeKV-q9ZJZYmsr-UoKuJn4kwyCv5ak26lrZyb-gb','2022-12-20 01:33:51','2026-04-02 09:29:24'),(65,'paypal_sandbox_client_secret','EEIxCuVnbgING9EyzcF2q-gpacLneVbngQtJ1mbx-42Lbq-6Uf6PEjgzF7HEayNsI4IFmB9_CZkECc3y','2022-12-20 01:33:51','2026-04-02 09:29:24'),(66,'paypal_sandbox_app_id','641651651958','2022-12-20 01:33:51','2026-04-02 09:29:24'),(67,'paypal_live_app_id','Test','2022-12-20 01:33:51','2026-04-02 09:29:24'),(68,'paypal_payment_action',NULL,'2022-12-20 01:33:51','2026-04-02 09:29:24'),(69,'paypal_currency',NULL,'2022-12-20 01:33:51','2026-04-02 09:29:24'),(70,'paypal_notify_url',NULL,'2022-12-20 01:33:51','2026-04-02 09:29:24'),(71,'paypal_locale',NULL,'2022-12-20 01:33:51','2026-04-02 09:29:24'),(72,'paypal_validate_ssl',NULL,'2022-12-20 01:33:52','2026-04-02 09:29:24'),(73,'paypal_live_client_id','Test','2022-12-20 01:33:52','2026-04-02 09:29:24'),(74,'paypal_live_client_secret','Test','2022-12-20 01:33:52','2026-04-02 09:29:24'),(75,'paypal_gateway',NULL,'2022-12-20 01:33:52','2026-04-02 09:29:24'),(76,'paypal_test_mode',NULL,'2022-12-20 01:33:52','2026-04-02 09:29:24'),(77,'razorpay_preview_logo','194','2022-12-20 01:56:54','2026-04-02 09:29:24'),(78,'razorpay_key',NULL,'2022-12-20 01:56:54','2026-04-02 09:29:24'),(79,'razorpay_secret',NULL,'2022-12-20 01:56:54','2026-04-02 09:29:24'),(80,'razorpay_api_key','rzp_test_SXk7LZqsBPpAkj','2022-12-20 01:56:54','2026-04-02 09:29:24'),(81,'razorpay_api_secret','Nenvq0aYArtYBDOGgmMH7JNv','2022-12-20 01:56:54','2026-04-02 09:29:24'),(82,'razorpay_gateway',NULL,'2022-12-20 01:56:54','2026-04-02 09:29:24'),(83,'stripe_preview_logo','195','2022-12-20 01:56:54','2026-04-02 09:29:24'),(84,'stripe_publishable_key',NULL,'2022-12-20 01:56:54','2026-04-02 09:29:24'),(85,'stripe_secret_key','sk_test_51GwS1SEmGOuJLTMs2vhSliTwAGkOt4fKJMBrxzTXeCJoLrRu8HFf4I0C5QuyE3l3bQHBJm3c0qFmeVjd0V9nFb6Z00VrWDJ9Uw','2022-12-20 01:56:54','2026-04-02 09:29:24'),(86,'stripe_public_key','pk_test_51GwS1SEmGOuJLTMsIeYKFtfAT3o3Fc6IOC7wyFmmxA2FIFQ3ZigJ2z1s4ZOweKQKlhaQr1blTH9y6HR2PMjtq1Rx00vqE8LO0x','2022-12-20 01:56:54','2026-04-02 09:29:24'),(87,'stripe_gateway',NULL,'2022-12-20 01:56:55','2026-04-02 09:29:24'),(88,'paytm_gateway',NULL,'2022-12-20 01:56:55','2026-04-02 09:29:24'),(89,'paytm_preview_logo','196','2022-12-20 01:56:55','2026-04-02 09:29:24'),(90,'paytm_merchant_key','dv0XtmsPYpewNag','2022-12-20 01:56:55','2026-04-02 09:29:24'),(91,'paytm_merchant_mid','Digita57697814558795','2022-12-20 01:56:55','2026-04-02 09:29:24'),(92,'paytm_merchant_website','WEBSTAGING','2022-12-20 01:56:55','2026-04-02 09:29:24'),(93,'paytm_test_mode',NULL,'2022-12-20 01:56:55','2026-04-02 09:29:24'),(94,'paystack_merchant_email','xgeniousteam@gmail.com','2022-12-20 01:56:55','2026-04-02 09:29:24'),(95,'paystack_preview_logo','192','2022-12-20 01:56:55','2026-04-02 09:29:24'),(96,'paystack_public_key','pk_test_7c6f87613b4dc1514acc3875998ba4f3a12bfda7','2022-12-20 01:56:55','2026-04-02 09:29:24'),(97,'paystack_secret_key','sk_test_0ec08da7d5d342774eaa3779ff37004a1fbda6c4','2022-12-20 01:56:55','2026-04-02 09:29:24'),(98,'paystack_gateway',NULL,'2022-12-20 01:56:55','2026-04-02 09:29:24'),(99,'mollie_preview_logo','197','2022-12-20 01:56:55','2026-04-02 09:29:24'),(100,'mollie_public_key','test_fVk76gNbAp6ryrtRjfAVvzjxSHxC2v','2022-12-20 01:56:55','2026-04-02 09:29:24'),(101,'mollie_gateway',NULL,'2022-12-20 01:56:55','2026-04-02 09:29:24'),(102,'marcado_pagp_client_id',NULL,'2022-12-20 01:56:55','2023-04-09 22:54:10'),(103,'marcado_pago_client_secret',NULL,'2022-12-20 01:56:55','2023-04-09 22:54:10'),(104,'marcado_pago_test_mode',NULL,'2022-12-20 01:56:55','2023-04-09 22:54:10'),(105,'cash_on_delivery_gateway',NULL,'2022-12-20 01:56:55','2026-04-02 09:29:24'),(106,'cash_on_delivery_preview_logo',NULL,'2022-12-20 01:56:55','2026-04-02 09:29:24'),(107,'flutterwave_preview_logo','193','2022-12-20 01:56:55','2026-04-02 09:29:24'),(108,'flutterwave_gateway',NULL,'2022-12-20 01:56:55','2026-04-02 09:29:24'),(109,'flw_public_key','86cce2ec43c63e09a517290a8347fcab','2022-12-20 01:56:56','2026-04-02 09:29:24'),(110,'flw_secret_key','d37a42d8917db84f1b2f47c125252d0a','2022-12-20 01:56:56','2026-04-02 09:29:24'),(111,'flw_secret_hash',NULL,'2022-12-20 01:56:56','2026-04-02 09:29:24'),(112,'midtrans_preview_logo','187','2022-12-20 01:56:56','2026-04-02 09:29:24'),(113,'midtrans_merchant_id',NULL,'2022-12-20 01:56:56','2026-04-02 09:29:24'),(114,'midtrans_server_key','SB-Mid-server-9z5jztsHyYxEdSs7DgkNg2on','2022-12-20 01:56:56','2026-04-02 09:29:24'),(115,'midtrans_client_key','SB-Mid-client-iDuy-jKdZHkLjL_I','2022-12-20 01:56:56','2026-04-02 09:29:24'),(116,'midtrans_environment',NULL,'2022-12-20 01:56:56','2026-04-02 09:29:24'),(117,'midtrans_gateway',NULL,'2022-12-20 01:56:56','2026-04-02 09:29:24'),(118,'midtrans_test_mode',NULL,'2022-12-20 01:56:56','2026-04-02 09:29:24'),(119,'payfast_preview_logo','188','2022-12-20 01:56:56','2026-04-02 09:29:24'),(120,'payfast_merchant_id','10024000','2022-12-20 01:56:56','2026-04-02 09:29:24'),(121,'payfast_merchant_key','77jcu5v4ufdod','2022-12-20 01:56:56','2026-04-02 09:29:24'),(122,'payfast_passphrase','testpayfastsohan','2022-12-20 01:56:56','2026-04-02 09:29:24'),(123,'payfast_merchant_env',NULL,'2022-12-20 01:56:56','2026-04-02 09:29:24'),(124,'payfast_itn_url',NULL,'2022-12-20 01:56:56','2026-04-02 09:29:24'),(125,'payfast_gateway',NULL,'2022-12-20 01:56:56','2026-04-02 09:29:24'),(126,'cashfree_preview_logo','189','2022-12-20 01:56:56','2026-04-02 09:29:24'),(127,'cashfree_test_mode',NULL,'2022-12-20 01:56:56','2026-04-02 09:29:24'),(128,'cashfree_app_id','94527832f47d6e74fa6ca5e3c72549','2022-12-20 01:56:56','2026-04-02 09:29:24'),(129,'cashfree_secret_key','ec6a3222018c676e95436b2e26e89c1ec6be2830','2022-12-20 01:56:56','2026-04-02 09:29:24'),(130,'cashfree_gateway',NULL,'2022-12-20 01:56:56','2026-04-02 09:29:24'),(131,'instamojo_preview_logo','190','2022-12-20 01:56:57','2026-04-02 09:29:24'),(132,'instamojo_client_id','test_nhpJ3RvWObd3uryoIYF0gjKby5NB5xu6S9Z','2022-12-20 01:56:57','2026-04-02 09:29:24'),(133,'instamojo_client_secret','test_iZusG4P35maQVPTfqutbCc6UEbba3iesbCbrYM7zOtDaJUdbPz76QOnBcDgblC53YBEgsymqn2sx3NVEPbl3b5coA3uLqV1ikxKquOeXSWr8Ruy7eaKUMX1yBbm','2022-12-20 01:56:57','2026-04-02 09:29:24'),(134,'instamojo_username',NULL,'2022-12-20 01:56:57','2026-04-02 09:29:24'),(135,'instamojo_password',NULL,'2022-12-20 01:56:57','2026-04-02 09:29:24'),(136,'instamojo_test_mode',NULL,'2022-12-20 01:56:57','2026-04-02 09:29:24'),(137,'instamojo_gateway',NULL,'2022-12-20 01:56:57','2026-04-02 09:29:24'),(138,'marcadopago_preview_logo','191','2022-12-20 01:56:57','2026-04-02 09:29:24'),(139,'marcado_pago_client_id','TEST-0a3cc78a-57bf-4556-9dbe-2afa06347769','2022-12-20 01:56:57','2023-04-10 21:43:47'),(140,'marcadopago_gateway',NULL,'2022-12-20 01:56:57','2026-04-02 09:29:24'),(141,'marcadopago_test_mode',NULL,'2022-12-20 01:56:57','2026-04-02 09:29:24'),(142,'zitopay_username','dvrobin4','2022-12-20 01:56:57','2026-04-02 09:29:24'),(143,'zitopay_preview_logo','182','2022-12-20 01:56:57','2026-04-02 09:29:24'),(144,'zitopay_gateway',NULL,'2022-12-20 01:56:57','2026-04-02 09:29:24'),(145,'zitopay_test_mode',NULL,'2022-12-20 01:56:57','2026-04-02 09:29:24'),(146,'billplz_collection_name','kjj5ya006','2022-12-20 01:56:57','2026-04-02 09:29:24'),(147,'billplz_xsignature','S-HDXHxRJB-J7rNtoktZkKJg','2022-12-20 01:56:57','2026-04-02 09:29:24'),(148,'billplz_key','b2ead199-e6f3-4420-ae5c-c94f1b1e8ed6','2022-12-20 01:56:57','2026-04-02 09:29:24'),(149,'billplz_preview_logo','183','2022-12-20 01:56:57','2026-04-02 09:29:24'),(150,'billplz_gateway',NULL,'2022-12-20 01:56:57','2026-04-02 09:29:24'),(151,'billplz_test_mode',NULL,'2022-12-20 01:56:57','2026-04-02 09:29:24'),(152,'paytabs_region','GLOBAL','2022-12-20 01:56:57','2026-04-02 09:29:24'),(153,'paytabs_profile_id','96698','2022-12-20 01:56:57','2026-04-02 09:29:24'),(154,'paytabs_server_key','SKJNDNRHM2-JDKTZDDH2N-H9HLMJNJ2L','2022-12-20 01:56:58','2026-04-02 09:29:24'),(155,'paytabs_preview_logo','184','2022-12-20 01:56:58','2026-04-02 09:29:24'),(156,'paytabs_gateway',NULL,'2022-12-20 01:56:58','2026-04-02 09:29:24'),(157,'paytabs_test_mode',NULL,'2022-12-20 01:56:58','2026-04-02 09:29:24'),(158,'cinetpay_site_id','445160','2022-12-20 01:56:58','2026-04-02 09:29:24'),(159,'cinetpay_app_key','12912847765bc0db748fdd44.40081707','2022-12-20 01:56:58','2026-04-02 09:29:24'),(160,'cinetpay_preview_logo','185','2022-12-20 01:56:58','2026-04-02 09:29:24'),(161,'cinetpay_gateway',NULL,'2022-12-20 01:56:58','2026-04-02 09:29:24'),(162,'cinetpay_test_mode',NULL,'2022-12-20 01:56:58','2026-04-02 09:29:24'),(163,'squareup_application_id',NULL,'2022-12-20 01:56:58','2026-04-02 09:29:24'),(164,'squareup_location_id','LE9C12TNM5HAS','2022-12-20 01:56:58','2026-04-02 09:29:24'),(165,'squareup_access_token','EAAAEOuLQObrVwJvCvoio3H13b8Ssqz1ighmTBKZvIENW9qxirHGHkqsGcPBC1uN','2022-12-20 01:56:58','2026-04-02 09:29:24'),(166,'squareup_preview_logo','186','2022-12-20 01:56:58','2026-04-02 09:29:24'),(167,'squareup_gateway',NULL,'2022-12-20 01:56:58','2026-04-02 09:29:24'),(168,'squareup_test_mode',NULL,'2022-12-20 01:56:58','2026-04-02 09:29:24'),(169,'paytm_channel','WEB','2022-12-20 02:01:36','2026-04-02 09:29:24'),(170,'paytm_industry_type','Retail','2022-12-20 02:01:36','2026-04-02 09:29:24'),(171,'error_404_page_title','Sayfa Bulunamadı','2022-12-26 04:23:23','2026-05-05 13:20:49'),(172,'error_404_page_subtitle','Sayfaya Ulaşılamıyor!!','2022-12-26 04:23:23','2026-05-05 13:20:49'),(173,'error_404_page_paragraph',NULL,'2022-12-26 04:23:23','2026-05-05 13:20:49'),(174,'error_404_page_button_text','Anasayfaya Dön','2022-12-26 04:23:23','2026-05-05 13:20:49'),(175,'error_image','80','2022-12-26 04:23:23','2026-05-05 13:20:49'),(176,'maintain_page_title','Merak etme, bakım modundayız. Hemen dönüyoruz !!','2022-12-26 05:51:02','2026-05-05 13:21:29'),(177,'maintain_page_description',NULL,'2022-12-26 05:51:02','2026-05-05 13:21:29'),(178,'maintenance_duration',NULL,'2022-12-26 05:51:02','2026-05-05 13:21:29'),(179,'maintain_page_logo','10','2022-12-26 05:51:02','2026-05-05 13:21:29'),(180,'professional_title','Tell us what professional title describes you?','2023-02-14 04:40:23','2023-04-02 22:32:36'),(181,'intro_title','Provide an intro about yourself','2023-02-14 04:40:23','2023-04-02 22:32:36'),(182,'experience_title','Tell us about your professional experiences(Experience)','2023-02-14 05:31:43','2023-04-02 22:03:58'),(183,'inner_title','Experience','2023-02-14 05:31:43','2023-02-14 05:32:10'),(184,'modal_title','Add Work Experience','2023-02-14 05:31:43','2023-02-14 05:32:10'),(185,'edit_modal_title','Edit Work Experience','2023-02-14 05:31:43','2023-02-14 05:32:10'),(186,'experience_inner_title','Work experience','2023-02-14 05:36:13','2023-04-02 22:03:58'),(187,'experience_modal_title','Add work experience','2023-02-14 05:36:13','2023-04-02 22:03:58'),(188,'experience_edit_modal_title','Edit work experience','2023-02-14 05:36:13','2023-04-02 22:03:59'),(189,'education_title','What’s your Educational Background?(Education)','2023-02-14 05:44:09','2023-04-02 22:04:04'),(190,'education_inner_title','Education','2023-02-14 05:44:09','2023-04-02 22:04:04'),(191,'education_modal_title','Educational background','2023-02-14 05:44:09','2023-04-02 22:04:04'),(192,'education_edit_modal_title','Edit educational background','2023-02-14 05:44:09','2023-04-02 22:04:04'),(193,'work_title','What kinds of services will you provide to clients?(Work)','2023-02-14 05:57:43','2023-04-02 22:04:09'),(194,'work_inner_title','Choose, what would you do?','2023-02-14 05:57:43','2023-04-02 22:04:09'),(195,'work_modal_title','Choose a service','2023-02-14 05:57:43','2023-04-02 22:04:09'),(196,'skill_title','Great! Now add some skills you have','2023-02-14 06:30:53','2023-04-02 22:04:14'),(197,'hourly_rate',NULL,'2023-02-14 06:40:13','2023-02-14 06:40:13'),(198,'profile_photo',NULL,'2023-02-14 06:40:13','2023-02-14 06:40:13'),(199,'hourly_rate_title','What is your hourly rate?','2023-02-14 06:41:09','2023-04-02 22:04:19'),(200,'profile_photo_title','Upload profile photo','2023-02-14 06:41:09','2023-04-02 22:04:19'),(201,'account_page_title','Hesabını Düzenle','2023-02-14 22:59:23','2026-05-05 13:30:34'),(202,'account_page_skip_title','Geç','2023-02-14 22:59:23','2026-05-05 13:30:34'),(203,'account_page_back_button_title','Geri','2023-02-14 22:59:23','2026-05-05 13:30:34'),(204,'introduction_menu_title','Introduction','2023-02-14 23:08:28','2023-04-02 22:32:36'),(205,'introduction_menu_sub_title','How do you professionally introduce yourself?','2023-02-14 23:08:28','2023-04-02 22:32:36'),(206,'experience_menu_title','Experience','2023-02-14 23:36:28','2023-04-02 22:03:58'),(207,'experience_menu_sub_title','Let clients know about your professional experiences.','2023-02-14 23:36:29','2023-04-02 22:03:58'),(208,'education_menu_title','Education','2023-02-14 23:36:50','2023-04-02 22:04:04'),(209,'education_menu_sub_title','How do you professionally introduce yourself?','2023-02-14 23:36:50','2023-04-02 22:04:04'),(210,'work_menu_title','Work','2023-02-14 23:37:33','2023-04-02 22:04:09'),(211,'work_menu_sub_title','Add the services and necessary skills you offer.','2023-02-14 23:37:33','2023-04-02 22:04:09'),(212,'skill_menu_title','Skills','2023-02-14 23:37:56','2023-04-02 22:04:14'),(213,'skill_menu_sub_title','Add the services and necessary skills you offer.','2023-02-14 23:37:56','2023-04-02 22:04:14'),(214,'hourly_rate_menu_title','Hourly Rate & Photo','2023-02-14 23:38:36','2023-04-02 22:04:19'),(215,'hourly_rate_menu_sub_title','Just add your Hourly Rate and Profile Photo to finish.','2023-02-14 23:38:36','2023-04-02 22:04:19'),(216,'user_identity_verify_subject','User identity verify request email','2023-02-16 02:31:58','2023-02-16 02:32:15'),(217,'user_identity_verify_message','<p>Hello,</p><p></p>You have a new request for user identity verification<p></p>','2023-02-16 02:31:58','2023-02-16 02:32:15'),(218,'user_info_update_subject','User Info Update Email','2023-02-18 04:51:23','2023-02-18 05:10:03'),(219,'user_info_update_message','<p>Hello @name,\r\n</p><p>Your information successfully updated</p><p>Username: @username</p><p> Email: @email</p><p>\r\n</p>','2023-02-18 04:51:23','2023-02-18 05:10:03'),(220,'user_identity_verify_confirm_subject','User Identity Verify Confirm','2023-02-20 01:38:44','2023-02-20 01:38:44'),(221,'user_identity_verify_confirm_message','<p>Hello @name,\r\n</p><p>Your identity verification successfully done. Now you are a verified user.\r\n</p><p>Username: @username\r\n</p><p>Email: @email</p><p>\r\n</p><p>\r\n</p><p>\r\n</p>','2023-02-20 01:38:45','2023-02-20 01:38:45'),(222,'user_identity_re_verify_subject','User Identity Reverification','2023-02-20 02:10:13','2023-02-20 02:10:13'),(223,'user_identity_re_verify_message','<p>Hello @name,\r\n</p><p>Your identity need to reverification for the following reasons.</p><ul><li>Face issue</li><li>ID issue</li></ul><p>Username: @username\r\n</p><p>Email: @email</p><p>\r\n</p><p>\r\n</p><p>\r\n</p>','2023-02-20 02:10:13','2023-02-20 02:10:13'),(224,'user_identity_decline_subject','User Identity Decline','2023-02-20 03:17:50','2023-02-20 03:36:03'),(225,'user_identity_decline_message','<p>Hello @name,\r\n</p><p>Your identity verification request decline for the bellow reasons</p><ul><li>&nbsp;image not si,ilar</li><li>number not match</li><li>email not match</li></ul><p>Username: @username\r\n</p><p>Email: @email</p><p>\r\n</p><p>\r\n</p><p>\r\n</p>','2023-02-20 03:17:50','2023-02-20 03:36:03'),(226,'user_password_change_subject','User Password Change Email','2023-02-21 22:53:34','2023-02-21 22:56:21'),(227,'user_password_change_message','<p>Hello @name,\r\n</p><p>Your password has been changed.\r\n</p><p>New password : @password</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p>','2023-02-21 22:53:34','2023-02-21 22:56:21'),(228,'user_status_active_subject','User Status Activate Email','2023-02-22 03:18:43','2023-02-22 03:18:43'),(229,'user_status_active_message','<p>Hello @name,\r\n</p><p>Your account status has been changed from inactive to active.</p><p>\r\n</p>','2023-02-22 03:18:43','2023-02-22 03:18:43'),(230,'user_status_inactive_subject','User Status Inactivate Email','2023-02-22 03:22:20','2023-02-22 03:22:20'),(231,'user_status_inactive_message','<p>Hello @name,\r\n</p><p>Your account status has been changed from active to inactive due to multiple violations of our community guidelines.</p><ul><li>test text</li><li>test text</li><li>test text</li><li>test text</li></ul><p>\r\n</p>','2023-02-22 03:22:20','2023-02-22 03:22:20'),(232,'user_register_subject','New User Register Email','2023-02-23 06:36:57','2024-01-30 04:23:56'),(233,'user_register_message','<p>Hello Admin,\r\n</p><p>New user just registered. Bello is the user details.</p><p><br></p><p>\r\n</p><p>Name : @name\r\n</p><p>Email: @email\r\n</p><p>Username: @username\r\n</p><p>User Type: @userType</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p>','2023-02-23 06:36:57','2024-01-30 04:23:56'),(234,'site_global_currency','TRY','2023-03-06 06:48:47','2026-04-26 13:54:16'),(235,'enable_disable_decimal_point','enable','2023-03-06 07:51:22','2026-04-26 13:54:16'),(236,'site_currency_symbol_position','right','2023-03-06 07:51:22','2026-04-26 13:54:16'),(237,'site_default_payment_gateway','iyzipay','2023-03-06 07:51:22','2026-04-26 13:54:16'),(238,'site_usd_to_idr_exchange_rate','100','2023-03-06 07:51:22','2025-03-24 00:01:03'),(239,'site_usd_to_inr_exchange_rate','100','2023-03-06 07:51:22','2025-03-24 00:01:03'),(240,'site_usd_to_ngn_exchange_rate','100','2023-03-06 07:51:22','2025-03-24 00:01:03'),(241,'site_usd_to_zar_exchange_rate','100','2023-03-06 07:51:22','2025-03-24 00:01:03'),(242,'site_usd_to_brl_exchange_rate','100','2023-03-06 07:51:22','2025-03-24 00:01:03'),(243,'site_usd_to_myr_exchange_rate','100','2023-03-06 07:51:22','2025-03-24 00:01:03'),(244,'_2fa_disable_subject','Disable 2FA Email','2023-03-25 00:36:36','2023-03-25 00:36:36'),(245,'_2fa_disable_message','<p>Hello @name,<br><br>2 factor authentication successfully disable from your account.<br></p>','2023-03-25 00:36:36','2023-03-25 00:36:36'),(246,'user_email_verified_subject','User Email Verify','2023-03-25 01:12:29','2023-03-25 02:22:42'),(247,'user_email_verified_message','<p>Hello @name,<br><br>Your email address successfully verified.<br></p>','2023-03-25 01:12:29','2023-03-25 02:22:42'),(248,'project_create_email_subject','Project Create Email','2023-03-25 03:12:40','2023-03-25 03:12:40'),(249,'project_create_email_message','<p>Hello,<br><br>A new project is just created. Project ID: @project_id<br></p>','2023-03-25 03:12:40','2023-03-25 03:12:40'),(250,'project_approve_email_subject','Project Activate Email','2023-03-25 03:41:43','2023-03-28 02:12:13'),(251,'project_approve_email_message','<p>Hello @name,<br><br>Your project successfully activate. Project ID: @project_id<br></p>','2023-03-25 03:41:43','2023-03-28 02:12:13'),(252,'project_decline_email_subject','Project Reject Email','2023-03-25 03:50:42','2023-03-28 02:27:42'),(253,'project_decline_email_message','<p>Hello @name,<br><br>Your project has been rejected. Project ID: @project_id<br></p>','2023-03-25 03:50:42','2023-03-28 02:27:42'),(254,'project_edit_email_subject','Project Edit Email','2023-03-26 21:55:46','2023-03-26 21:55:46'),(255,'project_edit_email_message','<p>Hello,\r\n</p><p>A project is just edited. Project ID: @project_id</p><p>\r\n</p>','2023-03-26 21:55:46','2023-03-26 21:55:46'),(256,'project_inactivate_email_subject','Project Inactivate Email','2023-03-28 01:12:45','2023-03-28 02:00:19'),(257,'project_inactivate_email_message','<p>Hello @name,\r\n</p><p>Your project inactivate for the bellow reasons..... Project ID: @project_id</p><p>\r\n</p>','2023-03-28 01:12:45','2023-03-28 02:00:19'),(258,'login_page_title','Devam Etmek İçin Lütfen Giriş Yapınız','2023-03-29 23:49:12','2026-05-05 13:23:46'),(259,'login_page_button_title','Giriş Yap','2023-03-29 23:49:12','2026-05-05 13:23:46'),(260,'login_page_sidebar_title','YAPTIRIYO','2023-03-29 23:49:12','2026-05-05 13:23:46'),(261,'login_page_sidebar_description','✓ Doğrulanmış ve güvenilir profesyonellerle çalışın.\r\n✓ Hızlı teklif alın, uygun fiyatla hizmetinizi yaptırın.\r\n✓ Güvenceli ödeme sistemiyle her işleminiz kontrol altında.','2023-03-29 23:49:12','2026-05-05 13:23:46'),(262,'login_page_social_login_enable_disable','on','2023-03-29 23:49:12','2026-05-05 13:23:46'),(263,'login_page_sidebar_image','317','2023-03-30 00:26:39','2026-05-05 13:23:46'),(264,'register_page_title','Kayıt ol','2023-03-30 01:27:49','2026-05-05 13:26:02'),(265,'register_page_button_title','Kayıt Ol','2023-03-30 01:27:49','2026-05-05 13:26:02'),(266,'register_page_sidebar_title','Register and start discover','2023-03-30 01:27:49','2026-05-05 13:26:02'),(267,'register_page_sidebar_description','Once register you will see the magic of xilancer marketplace.','2023-03-30 01:27:49','2026-05-05 13:26:02'),(268,'register_page_social_login_enable_disable',NULL,'2023-03-30 01:27:49','2026-05-05 13:26:02'),(269,'register_page_sidebar_image','26','2023-03-30 01:27:49','2026-05-05 13:26:02'),(270,'site_white_logo','324','2023-04-02 22:55:28','2026-05-05 13:37:25'),(271,'manual_payment_preview_logo','199','2023-04-05 03:06:03','2026-04-02 09:29:24'),(272,'site_manual_payment_name','Bank  Transfer','2023-04-05 03:06:03','2023-04-12 21:34:36'),(273,'manual_payment_test_mode',NULL,'2023-04-05 03:06:03','2026-04-02 09:29:24'),(274,'user_deposit_to_wallet_subject','User Deposit Email','2023-04-06 01:30:36','2023-04-06 01:42:47'),(275,'user_deposit_to_wallet_message','<p>Hello @name,<br><br>Your deposit to wallet successfully completed. Deposit ID: @deposit_id<br></p>','2023-04-06 01:30:36','2023-04-06 01:42:47'),(276,'user_deposit_to_wallet_subject_admin','User Deposit Email','2023-04-06 01:31:53','2023-04-06 01:42:41'),(277,'user_deposit_to_wallet_message_admin','<p>Hello,<br></p><p>A user deposit to his wallet. Deposit ID: @deposit_id<br></p>','2023-04-06 01:31:53','2023-04-06 01:42:41'),(278,'deposit_amount_limitation_for_user','5000','2023-04-08 23:01:49','2026-04-05 16:59:57'),(279,'razorpay_test_mode',NULL,'2023-04-09 23:51:10','2026-04-02 09:29:24'),(280,'stripe_test_mode',NULL,'2023-04-09 23:51:10','2026-04-02 09:29:24'),(281,'paystack_test_mode',NULL,'2023-04-09 23:51:11','2026-04-02 09:29:24'),(282,'mollie_test_mode',NULL,'2023-04-09 23:51:11','2026-04-02 09:29:24'),(283,'flutterwave_test_mode',NULL,'2023-04-09 23:51:11','2026-04-02 09:29:24'),(284,'payfast_test_mode',NULL,'2023-04-09 23:51:12','2026-04-02 09:29:24'),(285,'marcadopago_client_id','TEST-0a3cc78a-57bf-4556-9dbe-2afa06347769','2023-04-10 21:46:19','2026-04-02 09:29:24'),(286,'marcadopago_client_secret','TEST-4644184554273630-070813-7d817e2ca1576e75884001d0755f8a7a-786499991','2023-04-10 21:46:19','2026-04-02 09:29:24'),(287,'toyyibpay_secrect_key','wnbtrqle-9t9l-m02j-e2bz-iaj2tkp52sfo','2023-04-11 03:10:15','2026-04-02 09:29:24'),(288,'toyyibpay_category_code','0m0j9yc4','2023-04-11 03:10:15','2026-04-02 09:29:24'),(289,'toyyibpay_preview_logo','181','2023-04-11 03:10:15','2026-04-02 09:29:24'),(290,'toyyibpay_gateway',NULL,'2023-04-11 03:10:15','2026-04-02 09:29:24'),(291,'toyyibpay_test_mode',NULL,'2023-04-11 03:10:15','2026-04-02 09:29:24'),(292,'pagali_page_id',NULL,'2023-04-11 03:53:41','2026-04-02 09:29:24'),(293,'pagali_entity_id',NULL,'2023-04-11 03:53:41','2026-04-02 09:29:24'),(294,'pagali_preview_logo','180','2023-04-11 03:53:41','2026-04-02 09:29:24'),(295,'pagali_gateway',NULL,'2023-04-11 03:53:41','2026-04-02 09:29:24'),(296,'pagali_test_mode',NULL,'2023-04-11 03:53:41','2026-04-02 09:29:24'),(297,'authorize_dot_net_login_id','2e8yjNL89kV2','2023-04-11 22:24:12','2026-04-02 09:29:24'),(298,'authorize_dot_net_transaction_id','65968Gb3DU2ntX2v','2023-04-11 22:24:12','2026-04-02 09:29:24'),(299,'authorize_dot_net_preview_logo','179','2023-04-11 22:24:12','2026-04-02 09:29:24'),(300,'authorize_dot_net_gateway',NULL,'2023-04-11 22:24:12','2026-04-02 09:29:24'),(301,'authorize_dot_net_test_mode',NULL,'2023-04-11 22:24:12','2026-04-02 09:29:24'),(302,'sitesway_brand_id',NULL,'2023-04-11 23:13:38','2026-04-02 09:29:24'),(303,'sitesway_api_key',NULL,'2023-04-11 23:13:38','2026-04-02 09:29:24'),(304,'sitesway_preview_logo','200','2023-04-11 23:13:38','2026-04-02 09:29:24'),(305,'sitesway_gateway',NULL,'2023-04-11 23:13:38','2026-04-02 09:29:24'),(306,'sitesway_test_mode',NULL,'2023-04-11 23:13:38','2026-04-02 09:29:24'),(307,'manual_payment_gateway',NULL,'2023-04-12 22:12:04','2026-04-02 09:29:24'),(308,'job_create_email_subject','Job Create Email','2023-04-17 01:14:00','2023-04-17 03:20:55'),(309,'job_create_email_message','<p>Hello,</p><p><br></p><p>\r\n</p><p>A new job is just created. Job ID: @job_id</p><p>\r\n</p>','2023-04-17 01:14:00','2023-04-17 03:20:55'),(310,'job_edit_email_subject','Job Edit Email','2023-04-17 01:42:31','2023-04-17 01:42:53'),(311,'job_edit_email_message','<p>Hello,</p><p>\r\n</p><p>A project is just edited. Job ID: @job_id</p><p>\r\n</p>','2023-04-17 01:42:31','2023-04-17 01:42:53'),(312,'job_approve_email_subject','Job Activate Email','2023-04-17 02:02:00','2023-04-17 02:13:30'),(313,'job_approve_email_message','<p>Hello @name,</p><p><br></p><p>\r\n</p><p>Your job successfully activate. Job ID: @job_id</p><p>\r\n</p>','2023-04-17 02:02:00','2023-04-17 02:13:30'),(314,'job_inactivate_email_subject','Job Inactivate Email','2023-04-17 02:09:25','2023-04-17 02:09:30'),(315,'job_inactivate_email_message','<p>Hello @name,\r\n</p><p>Your job inactivate for the bellow reasons..... Job ID: @job_id</p><p>\r\n</p>','2023-04-17 02:09:25','2023-04-17 02:09:30'),(316,'job_decline_email_subject','Job Decline Email','2023-04-17 02:13:15','2023-04-17 02:13:15'),(317,'job_decline_email_message','<p>Hello @name,\r\n</p><p>Your job has been rejected. Job ID: @job_id</p><p>\r\n</p>','2023-04-17 02:13:15','2023-04-17 02:13:15'),(318,'site_tag_line','Freelance Services Marketplace','2023-05-09 01:09:04','2026-03-27 16:15:34'),(319,'home_page','7','2023-05-10 00:53:34','2025-12-28 05:52:58'),(320,'user_subscription_purchase_subject','User Subscription Purchase Email','2023-06-22 05:44:20','2023-06-22 05:44:20'),(321,'user_subscription_purchase_message','<p>Your subscription purchase successfully completed. Subscription ID: @subscription_id</p>','2023-06-22 05:44:20','2023-06-22 05:44:20'),(322,'user_subscription_purchase_admin_email_subject','User Subscription Purchase Email','2023-06-22 05:46:20','2023-06-22 05:46:20'),(323,'user_subscription_purchase_admin_email_message','<p>A user just purchase a subscription. Subscription ID: @subscription_id</p>','2023-06-22 05:46:20','2023-06-22 05:46:20'),(324,'limit_settings','2','2023-06-24 01:29:25','2023-07-06 04:01:20'),(325,'manual_subscription_complete_subject','Subscription Manual Payment Complete','2023-06-26 01:16:35','2023-07-04 03:55:16'),(326,'manual_subscription_complete_message','<p>Hello @name,\r\n</p><p>Your manual subscription payment status successfully changed from pending to complete. Subscription ID: @subscription_id</p><p>\r\n</p>','2023-06-26 01:16:35','2023-07-04 03:55:16'),(327,'manual_subscription_pending_subject','Subscription Manual Payment Pending Email','2023-06-26 01:17:48','2023-06-26 01:17:48'),(328,'manual_subscription_pending_message','<p>Hello @name,\r\n</p><p>Your manual subscription payment status changed from complete to pending. Subscription ID: @subscription_id</p><p>\r\n</p>','2023-06-26 01:17:48','2023-06-26 01:17:48'),(329,'manual_subscription_complete_subject_to_admin','Subscription Manual Payment Complete','2023-07-04 03:59:45','2023-07-04 03:59:52'),(330,'manual_subscription_complete_message_to_admin','<p>Hello admin,\r\n</p><p>A manual subscription payment status successfully changed from pending to complete. Subscription ID: @subscription_id</p><p>\r\n</p><p>\r\n</p>','2023-07-04 03:59:46','2023-07-04 03:59:52'),(331,'subscription_active_subject','Subscription Active','2023-07-04 05:28:01','2023-07-04 05:28:42'),(332,'subscription_active_message','<p>Hello @name,\r\n</p><p>Your subscription status changed from inactive to active. Subscription ID: @subscription_id</p><p>\r\n</p>','2023-07-04 05:28:01','2023-07-04 05:28:42'),(333,'subscription_inactive_subject','Subscription Inactive','2023-07-04 05:29:31','2023-07-04 05:29:31'),(334,'subscription_inactive_message','<p>Hello @name,\r\n</p><p>Your subscription status changed from active to inactive. Subscription ID: @subscription_id</p><p>\r\n</p>','2023-07-04 05:29:31','2023-07-04 05:29:31'),(353,'admin_commission_type','percentage','2023-07-11 01:37:44','2023-07-11 01:37:44'),(354,'admin_commission_charge','21','2023-07-11 01:37:44','2023-07-11 01:37:44'),(359,'transaction_fee_type','percentage','2023-07-12 01:19:22','2023-07-27 00:29:56'),(360,'transaction_fee_charge','2','2023-07-12 01:19:22','2023-07-27 00:29:57'),(361,'order_hold_subject','Hold Order','2023-08-22 00:39:06','2023-08-22 06:48:43'),(362,'order_hold_message','<p>Hello @name,</p><p><br></p><p>Your order has been hold .... contact with support team</p><p><br></p><p>Order Id: #@order_id</p>','2023-08-22 00:39:06','2023-08-22 06:48:43'),(363,'order_unhold_subject','Unhold Order','2023-08-22 00:40:04','2023-08-22 01:24:20'),(364,'order_unhold_message','<p>Hello @name;\r\n</p><p>Your order has been Unhold ....</p><p><br></p><p>Order Id: #@order_id</p><p>\r\n</p><p>\r\n</p><p>\r\n</p>','2023-08-22 00:40:04','2023-08-22 01:24:21'),(365,'account_active_subject','Account Active','2023-08-22 03:55:06','2023-08-22 06:48:19'),(366,'account_active_message','<p>Hello @name,</p><p><br></p><p>Your account has been active......</p>','2023-08-22 03:55:06','2023-08-22 06:48:19'),(367,'account_suspend_subject','Account Suspend','2023-08-22 03:55:23','2023-08-22 06:48:24'),(368,'account_suspend_message','<p>Hello @name,</p><p><br></p><p>Your account has been suspended......</p>','2023-08-22 03:55:23','2023-08-22 06:48:24'),(369,'account_unsuspend_subject','Account Active','2023-08-24 04:10:00','2023-08-24 04:10:00'),(370,'account_unsuspend_message','<p>Hello @name,\r\n</p><p>Your account has been unsuspend form suspend......</p><p>\r\n</p><p>\r\n</p><p>\r\n</p>','2023-08-24 04:10:00','2023-08-24 04:10:00'),(371,'order_manual_payment_complete_subject','Order Manual Payment Complete','2023-08-24 07:30:11','2023-08-24 07:30:11'),(372,'order_manual_payment_complete_message','<p>Hello @name,</p><p><br></p><p>\r\n</p><p>Your order payment has been updated from pending to complete.</p><p><br></p><p>\r\n</p><p>Order Id: #@order_id</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p>','2023-08-24 07:30:11','2023-08-24 07:30:11'),(373,'support_ticket_subject','Support Ticket','2023-08-27 06:59:20','2023-08-27 07:08:12'),(374,'support_ticket_message','<p>Hello @name,</p><p><br></p><p>You have a new ticket</p><p><br></p><p>Ticket ID: #@ticket_id</p>','2023-08-27 06:59:20','2023-08-27 07:08:12'),(375,'support_ticket_message_email_subject','Support Ticket Message Email','2023-08-29 04:57:15','2023-08-29 04:57:15'),(376,'support_ticket_message_email_message','<p>Hello @name,</p><p><br></p><p>You have a new message for the bellow ticket</p><p><br></p><p>Ticket ID : #@ticket_id</p>','2023-08-29 04:57:15','2023-08-29 04:57:15'),(377,'job_auto_approval','no','2023-09-20 05:50:29','2025-11-02 03:49:02'),(378,'withdraw_amount_limitation_for_user','50','2023-10-15 05:09:35','2023-10-15 05:09:35'),(379,'minimum_withdraw_amount','50','2023-10-15 05:28:40','2026-04-25 15:12:25'),(380,'maximum_withdraw_amount','10000','2023-10-15 05:28:40','2026-04-25 15:12:25'),(381,'withdraw_fee','5','2023-10-16 23:47:35','2026-04-05 16:59:36'),(382,'register_subscription','10','2023-11-06 04:35:25','2023-11-06 04:35:25'),(383,'main_color_one','#ff751f','2023-11-15 04:32:16','2026-05-05 13:43:48'),(384,'main_color_two',NULL,'2023-11-15 04:32:16','2026-05-05 13:43:48'),(385,'secondary_color','#ff6b6b','2023-11-15 04:32:16','2026-05-05 13:43:48'),(386,'paragraph_color','#475467','2023-11-15 04:32:16','2026-05-05 13:43:48'),(387,'body_color','#3B4759','2023-11-15 04:32:16','2026-05-05 13:43:48'),(388,'site_script_version','4.0.0','2023-12-18 14:01:27','2023-12-18 14:01:30'),(389,'iyzipay_secret_key','sandbox-OcDnYm37qpkpFuuQBGo5oLdFzQHoqXz6','2023-12-27 07:40:33','2026-04-02 09:29:24'),(390,'iyzipay_api_key','sandbox-reTOuY0XoLY4Ltb0v9FVOSl3e0KHlqcr','2023-12-27 07:40:33','2026-04-02 09:29:24'),(391,'iyzipay_preview_logo','178','2023-12-27 07:40:33','2026-04-02 09:29:24'),(392,'iyzipay_gateway','on','2023-12-27 07:40:33','2026-04-02 09:29:24'),(393,'iyzipay_test_mode','on','2023-12-27 07:40:33','2026-04-02 09:29:24'),(394,'site_manual_payment_description',NULL,'2023-12-27 07:40:33','2026-04-02 09:29:24'),(395,'job_enable_disable','disable','2024-01-17 06:35:58','2026-04-02 10:24:06'),(396,'project_enable_disable','enable','2024-01-17 07:07:23','2024-01-17 07:35:07'),(397,'captcha_status','off','2024-01-27 06:46:42','2026-03-27 16:13:38'),(398,'site_bgn_to_usd_exchange_rate',NULL,'2024-01-27 09:02:54','2024-01-27 09:03:21'),(399,'site_bgn_to_idr_exchange_rate',NULL,'2024-01-27 09:02:54','2024-01-27 09:03:21'),(400,'site_bgn_to_inr_exchange_rate',NULL,'2024-01-27 09:02:54','2024-01-27 09:03:21'),(401,'site_bgn_to_ngn_exchange_rate',NULL,'2024-01-27 09:02:54','2024-01-27 09:03:21'),(402,'site_bgn_to_zar_exchange_rate',NULL,'2024-01-27 09:02:54','2024-01-27 09:03:21'),(403,'site_bgn_to_brl_exchange_rate',NULL,'2024-01-27 09:02:54','2024-01-27 09:03:21'),(404,'site_bgn_to_myr_exchange_rate',NULL,'2024-01-27 09:02:54','2024-01-27 09:03:21'),(405,'site_usd_to_usd_exchange_rate','100','2024-01-27 22:41:10','2025-03-24 00:01:03'),(406,'user_register_welcome_subject','User Register Welcome Email','2024-01-30 03:58:20','2024-01-30 03:58:20'),(407,'user_register_welcome_message','<p>Hello @name,\r\n</p><p>Your registration successfully completed. Below is your account details.</p><p><br></p><p>\r\n</p><p>Name : @name\r\n</p><p>Email: @email\r\n</p><p>Username: @username\r\n</p><p>Password : @password\r\n</p><p>User Type: @userType</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p>','2024-01-30 03:58:20','2024-01-30 03:58:20'),(408,'manual_payment_gateway_name',NULL,'2024-03-10 15:58:06','2026-04-02 09:29:24'),(409,'profile_page_badge_settings','enable','2024-06-04 08:33:21','2024-06-04 08:44:11'),(410,'recaptcha_site_key','6LdsrfEpAAAAAO6kajZpCjiq-ppcVJFHoCUhAHXx','2024-06-12 11:08:11','2024-06-12 11:08:11'),(411,'recaptcha_secret_key','6LdsrfEpAAAAAEpQ58fvbmvzN1DuUnfDXnBZJcSr','2024-06-12 11:08:11','2024-06-12 11:08:11'),(412,'subscription_enable_disable','enable','2024-06-12 11:15:39','2026-05-06 14:02:51'),(413,'kineticpay_gateway',NULL,'2024-07-29 15:05:12','2026-04-02 09:29:24'),(414,'kineticpay_test_mode',NULL,'2024-07-29 15:05:12','2026-04-02 09:29:24'),(415,'kineticpay_merchant_key','ede1c5e9f81c9d12bf418629f56a7870','2024-07-29 15:05:12','2026-04-02 09:29:24'),(416,'kineticpay_preview_logo','152','2024-07-29 15:05:12','2026-04-02 09:29:24'),(417,'awdpay_gateway',NULL,'2024-07-29 15:05:12','2026-04-02 09:29:24'),(418,'awdpay_test_mode',NULL,'2024-07-29 15:05:12','2026-04-02 09:29:24'),(419,'awdpay_private_key',NULL,'2024-07-29 15:05:12','2026-04-02 09:29:24'),(420,'awdpay_preview_logo','201','2024-07-29 15:05:12','2026-04-02 09:29:24'),(421,'awdpay_logo_url','https://www.awdpay.com/api/public/image-1649803735945-214296083.png','2024-07-29 15:05:12','2026-04-02 09:29:24'),(422,'file_extensions','[\"png\",\"jpg\",\"jpeg\",\"gif\",\"pdf\",\"doc\",\"docx\",\"txt\",\"csv\",\"xlsx\",\"xls\",\"ppt\",\"pptx\",\"zip\"]','2024-10-09 16:44:33','2024-10-09 16:46:04'),(423,'max_upload_size','2097152','2024-10-09 16:44:33','2024-10-09 16:46:04'),(424,'community_page_title','Get answers to your questions by our expert community members2','2024-12-24 04:12:07','2024-12-30 08:50:54'),(425,'community_question_button_title','Login to Ask a Question','2024-12-24 04:12:07','2024-12-30 08:50:54'),(426,'community_question_modal_title','Ask a question','2024-12-24 04:12:07','2024-12-30 08:50:54'),(427,'community_page_notification_title','Your questions has been answered by community members','2024-12-24 04:12:07','2024-12-30 08:50:54'),(428,'community_question_page_subtitle','This is a space for both clients and freelancers to get their questions answered by the community.','2024-12-24 04:12:07','2024-12-30 08:50:54'),(429,'community_tips_page_subtitle','This is a space for both clients and freelancers to get their tips comment by the community.','2024-12-24 04:12:07','2024-12-30 08:50:54'),(430,'community_page_image','170','2024-12-24 04:12:07','2024-12-30 08:50:54'),(431,'site_currency_thousand_separator',',','2024-12-28 05:23:41','2026-04-26 13:54:16'),(432,'site_currency_decimal_separator','.','2024-12-28 05:23:41','2026-04-26 13:54:16'),(433,'site_usd_to_bdt_exchange_rate','116','2024-12-28 05:23:41','2025-03-24 00:01:03'),(434,'sslcommerce_gateway',NULL,'2024-12-28 05:26:24','2026-04-02 09:29:24'),(435,'sslcommerce_preview_logo','202','2024-12-28 05:26:24','2026-04-02 09:29:24'),(436,'sslcommerce_test_mode',NULL,'2024-12-28 05:26:24','2026-04-02 09:29:24'),(437,'sslcommerce_store_id','xgeni65bceeafdfb1e','2024-12-28 05:26:24','2026-04-02 09:29:24'),(438,'sslcommerce_store_password','xgeni65bceeafdfb1e@ssl','2024-12-28 05:26:24','2026-04-02 09:29:24'),(439,'yoomoney_gateway',NULL,'2024-12-28 05:26:24','2026-04-02 09:29:24'),(440,'yoomoney_test_mode',NULL,'2024-12-28 05:26:24','2026-04-02 09:29:24'),(441,'yoomoney_preview_logo',NULL,'2024-12-28 05:26:24','2026-04-02 09:29:24'),(442,'yoomoney_shop_id',NULL,'2024-12-28 05:26:24','2026-04-02 09:29:24'),(443,'yoomoney_secret_key',NULL,'2024-12-28 05:26:24','2026-04-02 09:29:24'),(444,'coinpayments_gateway',NULL,'2024-12-28 05:26:24','2026-04-02 09:29:24'),(445,'coinpayments_test_mode',NULL,'2024-12-28 05:26:24','2026-04-02 09:29:24'),(446,'coinpayments_preview_logo',NULL,'2024-12-28 05:26:24','2026-04-02 09:29:24'),(447,'coinpayments_merchant',NULL,'2024-12-28 05:26:24','2026-04-02 09:29:24'),(448,'coinpayments_ipn_pin',NULL,'2024-12-28 05:26:24','2026-04-02 09:29:24'),(449,'mouse_pointer','disable','2025-01-07 01:04:05','2026-05-05 15:24:14'),(450,'xendit_gateway',NULL,'2025-03-23 07:30:03','2026-04-02 09:29:24'),(451,'xendit_test_mode',NULL,'2025-03-23 07:30:03','2026-04-02 09:29:24'),(452,'xendit_secret_key','xnd_development_axvvNZd9HGFxJlH8SpFqwgKYMUFugu8uF8ZCqAfpZ7QCovylWMbpJi0I3XDtS','2025-03-23 07:30:03','2026-04-02 09:29:24'),(453,'xendit_webhook_token',NULL,'2025-03-23 07:30:03','2026-04-02 09:29:24'),(454,'xendit_preview_logo','203','2025-03-23 07:30:03','2026-04-02 09:29:24'),(455,'subscription_chat_enable_disable','enable','2025-03-23 08:53:32','2025-03-23 23:51:33'),(456,'admin_url_prefix','admin','2025-03-23 23:52:01','2025-03-24 01:57:24'),(457,'user_identity_verify_enable_disable','disable','2025-09-09 04:08:44','2025-09-09 04:08:44'),(458,'state_filter_enable_disable','enable','2025-09-09 04:15:48','2025-09-09 04:15:48'),(459,'job_country_restriction_enabled','1','2025-09-28 00:24:18','2025-09-28 00:24:18'),(460,'job_country_view_level_enabled','1','2025-09-28 00:24:18','2025-09-28 00:24:18'),(461,'promote_transaction_fee_type','percentage','2025-09-28 00:24:48','2025-09-28 00:24:48'),(462,'promote_transaction_fee_charge','2','2025-09-28 00:24:48','2025-09-28 00:24:48'),(463,'projects_per_page','12','2025-09-28 00:25:15','2026-04-27 16:17:47'),(464,'pro_projects_default_first','1','2025-09-28 00:25:15','2026-04-27 16:17:47'),(465,'pro_projects_count','2','2025-09-28 00:25:15','2026-04-27 16:17:47'),(466,'non_pro_projects_count','10','2025-09-28 00:25:15','2026-04-27 16:17:47'),(467,'promoted_user_profile_text','Your current promotion is active and will expire on','2025-09-28 00:25:15','2026-04-27 16:17:47'),(468,'promoted_badge_text','Sponsorlu','2025-09-28 00:25:15','2026-04-27 16:17:47'),(469,'promoted_badge_text_toggle','on','2025-09-28 00:25:15','2026-04-27 16:17:47'),(470,'user_earning_toggle','enable','2025-10-19 04:34:53','2025-10-19 04:34:53'),(471,'hide_empty_categories','on','2025-10-19 04:37:38','2025-10-19 04:37:38'),(472,'project_auto_approval','yes','2025-12-29 03:41:10','2025-12-29 03:44:36'),(473,'section_font_family','Poppins','2026-01-08 10:21:56','2026-01-08 10:21:56'),(474,'section_font_variant','a:9:{i:0;s:5:\"0,100\";i:1;s:5:\"0,200\";i:2;s:5:\"0,300\";i:3;s:5:\"0,400\";i:4;s:5:\"0,500\";i:5;s:5:\"0,600\";i:6;s:5:\"0,700\";i:7;s:5:\"0,800\";i:8;s:5:\"0,900\";}','2026-01-08 10:21:56','2026-01-08 10:21:56'),(475,'page_loader','enable','2026-01-14 06:05:40','2026-01-14 06:06:15'),(476,'social_login_enable_disable',NULL,'2026-03-27 16:15:34','2026-03-27 16:15:34'),(477,'category_section_enable_disable_for_homepage','enable','2026-03-27 16:41:24','2026-03-27 16:41:24'),(478,'category_section_enable_disable','enable','2026-03-27 16:41:24','2026-03-27 16:41:24'),(479,'stripe_connect_client_id',NULL,'2026-04-02 09:10:32','2026-04-02 09:29:24'),(480,'stripe_webhook_secret_main_account',NULL,'2026-04-02 09:10:32','2026-04-02 09:29:24'),(481,'stripe_webhook_secret_connected_account',NULL,'2026-04-02 09:10:32','2026-04-02 09:29:24'),(482,'airwallex_gateway',NULL,'2026-04-02 09:10:32','2026-04-02 09:29:24'),(483,'airwallex_test_mode',NULL,'2026-04-02 09:10:32','2026-04-02 09:29:24'),(484,'airwallex_client_id',NULL,'2026-04-02 09:10:32','2026-04-02 09:29:24'),(485,'airwallex_api_key',NULL,'2026-04-02 09:10:32','2026-04-02 09:29:24'),(486,'airwallex_api_url',NULL,'2026-04-02 09:10:32','2026-04-02 09:29:24'),(487,'airwallex_preview_logo',NULL,'2026-04-02 09:10:32','2026-04-02 09:29:24'),(488,'cryptomus_gateway',NULL,'2026-04-02 09:10:32','2026-04-02 09:29:24'),(489,'cryptomus_test_mode',NULL,'2026-04-02 09:10:32','2026-04-02 09:29:24'),(490,'cryptomus_api_key',NULL,'2026-04-02 09:10:32','2026-04-02 09:29:24'),(491,'cryptomus_merchant_id',NULL,'2026-04-02 09:10:32','2026-04-02 09:29:24'),(492,'cryptomus_preview_logo',NULL,'2026-04-02 09:10:32','2026-04-02 09:29:24'),(493,'site_try_to_usd_exchange_rate',NULL,'2026-04-02 09:11:09','2026-04-26 13:54:16'),(494,'site_try_to_bdt_exchange_rate',NULL,'2026-04-02 09:11:09','2026-04-26 13:54:16'),(495,'site_try_to_idr_exchange_rate',NULL,'2026-04-02 09:11:09','2026-04-26 13:54:16'),(496,'site_try_to_inr_exchange_rate',NULL,'2026-04-02 09:11:09','2026-04-26 13:54:16'),(497,'site_try_to_ngn_exchange_rate',NULL,'2026-04-02 09:11:09','2026-04-26 13:54:16'),(498,'site_try_to_zar_exchange_rate',NULL,'2026-04-02 09:11:09','2026-04-26 13:54:16'),(499,'site_try_to_brl_exchange_rate',NULL,'2026-04-02 09:11:09','2026-04-26 13:54:16'),(500,'site_try_to_myr_exchange_rate',NULL,'2026-04-02 09:11:09','2026-04-26 13:54:16'),(501,'iyzico_gateway','','2026-04-02 09:23:59','2026-04-02 09:23:59'),(502,'withdraw_fee_type','fixed','2026-04-05 16:59:36','2026-04-05 16:59:36'),(503,'minimum_deposit_amount','100','2026-04-05 16:59:57','2026-04-05 16:59:57'),(504,'register_page_choose_role_title','Müşteri veya Hizmet Veren Olarak Katılın','2026-05-05 13:25:05','2026-05-05 13:26:02'),(505,'register_page_choose_role_subtitle',NULL,'2026-05-05 13:25:05','2026-05-05 13:26:02'),(506,'register_page_choose_join_freelancer_title','Hizmet Veren olarak katıl','2026-05-05 13:25:05','2026-05-05 13:26:02'),(507,'register_page_choose_join_client_title','Müşteri olarak katıl','2026-05-05 13:25:05','2026-05-05 13:26:02'),(508,'register_page_continue_button_title','Devam Et','2026-05-05 13:25:05','2026-05-05 13:26:02'),(509,'toc_page_link',NULL,'2026-05-05 13:25:05','2026-05-05 13:26:02'),(510,'privacy_policy_link',NULL,'2026-05-05 13:25:05','2026-05-05 13:26:02');
/*!40000 ALTER TABLE `static_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sub_categories`
--

DROP TABLE IF EXISTS `sub_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sub_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sub_category` varchar(255) NOT NULL,
  `short_description` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `category_id` bigint(20) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=inactive 1=active',
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub_categories`
--

LOCK TABLES `sub_categories` WRITE;
/*!40000 ALTER TABLE `sub_categories` DISABLE KEYS */;
INSERT INTO `sub_categories` VALUES (21,'Frontend Developer','This category descrips frontend developer','frontend-developer',NULL,NULL,2,1,NULL,'2023-02-08 23:02:13','2023-05-15 00:15:05'),(38,'Kapı Açma','Kapı Açma','kapı-açma','Kapı Açma','Kapı Açma',13,1,NULL,'2026-03-27 16:24:20','2026-04-15 06:37:54'),(39,'Su Kaçağı Tespiti','Su Kaçağı Tespiti','su-kaçağı-tespiti','Su Kaçağı Tespiti','Su Kaçağı Tespiti',11,1,NULL,'2026-04-05 11:51:23','2026-04-15 06:39:16'),(40,'Kilit Değişimi','Kilit Değişimi','kilit-değişimi','Kilit Değişimi','Kilit Değişimi',13,1,NULL,'2026-04-15 06:37:30','2026-04-15 06:37:30'),(41,'Kilit Tamiri','Kilit Tamiri','kilit-tamiri','Kilit Tamiri','Kilit Tamiri',13,1,NULL,'2026-04-15 06:38:09','2026-04-15 06:38:09'),(42,'Oto Çilingir','Oto Çilingir','oto-çilingir','Oto Çilingir','Oto Çilingir',13,1,NULL,'2026-04-15 06:38:25','2026-04-15 06:38:25'),(43,'Akıllı Kilit Montajı','Akıllı Kilit Montajı','akıllı-kilit-montajı','Akıllı Kilit Montajı','Akıllı Kilit Montajı',13,1,NULL,'2026-04-15 06:38:41','2026-04-15 06:38:41'),(44,'Tıkanıklık Açma','Tıkanıklık Açma','tıkanıklık-açma','Tıkanıklık Açma','Tıkanıklık Açma',11,1,NULL,'2026-04-15 06:39:30','2026-04-15 06:39:30'),(45,'Musluk Değişimi','Musluk Değişimi','musluk-değişimi','Musluk Değişimi','Musluk Değişimi',11,1,NULL,'2026-04-15 06:39:44','2026-04-15 06:39:44'),(46,'Klozet Montajı','Klozet Montajı','klozet-montajı','Klozet Montajı','Klozet Montajı',11,1,NULL,'2026-04-15 06:39:58','2026-04-15 06:39:58'),(47,'Gider Açma','Gider Açma','gider-açma','Gider Açma','Gider Açma',11,1,NULL,'2026-04-15 06:40:09','2026-04-15 06:40:09'),(48,'Elektrik Arıza','Elektrik Arıza','elektrik-arıza','Elektrik Arıza','Elektrik Arıza',23,1,NULL,'2026-04-15 06:42:39','2026-04-15 06:42:39'),(49,'Priz Montajı','Priz Montajı','priz-montajı','Priz Montajı','Priz Montajı',23,1,NULL,'2026-04-15 06:42:52','2026-04-15 06:42:52'),(50,'Sigorta Değişimi','Sigorta Değişimi','sigorta-değişimi','Sigorta Değişimi','Sigorta Değişimi',23,1,NULL,'2026-04-15 06:43:52','2026-04-15 06:43:52'),(51,'Avize Montajı','Avize Montajı','avize-montajı','Avize Montajı','Avize Montajı',23,1,NULL,'2026-04-15 06:44:07','2026-04-15 06:44:07'),(52,'Kaçak Akım Çözümü','Kaçak Akım Çözümü','kaçak-akım-çözümü','Kaçak Akım Çözümü','Kaçak Akım Çözümü',23,1,NULL,'2026-04-15 06:44:23','2026-04-15 06:44:23'),(53,'İç Cephe Boyama','İç Cephe Boyama','iç-cephe-boyama','İç Cephe Boyama','İç Cephe Boyama',24,1,NULL,'2026-04-15 06:44:38','2026-04-15 06:44:38'),(54,'Dış Cephe Boyama','Dış Cephe Boyama','dış-cephe-boyama','Dış Cephe Boyama','Dış Cephe Boyama',24,1,NULL,'2026-04-15 06:44:51','2026-04-15 06:44:51'),(55,'Alçı Sıva','Alçı Sıva','alçı-sıva','Alçı Sıva','Alçı Sıva',24,1,NULL,'2026-04-15 06:45:01','2026-04-15 06:45:01'),(56,'Duvar Tamiri','Duvar Tamiri','duvar-tamiri','Duvar Tamiri','Duvar Tamiri',24,1,NULL,'2026-04-15 06:45:44','2026-04-15 06:45:44'),(57,'Dekoratif Boya','Dekoratif Boya','dekoratif-boya','Dekoratif Boya','Dekoratif Boya',24,1,NULL,'2026-04-15 06:45:59','2026-04-15 06:45:59'),(58,'Ev Temizliği','Ev Temizliği','ev-temizliği','Ev Temizliği','Ev Temizliği',25,1,NULL,'2026-04-15 06:46:29','2026-04-15 06:46:29'),(59,'Ofis Temizliği','Ofis Temizliği','ofis-temizliği','Ofis Temizliği','Ofis Temizliği',25,1,NULL,'2026-04-15 06:46:41','2026-04-15 06:46:41'),(60,'İnşaat Sonrası Temizlik','İnşaat Sonrası Temizlik','inşaat-sonrası-temizlik','İnşaat Sonrası Temizlik','İnşaat Sonrası Temizlik',25,1,NULL,'2026-04-15 06:47:00','2026-04-15 06:47:00'),(61,'Taşınma Temizliği','Taşınma Temizliği','taşınma-temizliği','Taşınma Temizliği','Taşınma Temizliği',25,1,NULL,'2026-04-15 06:47:17','2026-04-15 06:47:17'),(62,'Detaylı Temizlik','Detaylı Temizlik','detaylı-temizlik','Detaylı Temizlik','Detaylı Temizlik',25,1,NULL,'2026-04-15 06:47:31','2026-04-15 06:47:31'),(63,'Klima Montajı','Klima Montajı','klima-montajı','Klima Montajı','Klima Montajı',26,1,NULL,'2026-04-15 06:47:49','2026-04-15 06:47:49'),(64,'Klima Bakım','Klima Bakım','klima-bakım','Klima Bakım','Klima Bakım',26,1,NULL,'2026-04-15 06:48:03','2026-04-15 06:48:03'),(65,'Beyaz Eşya Tamiri','Beyaz Eşya Tamiri','beyaz-eşya-tamiri','Beyaz Eşya Tamiri','Beyaz Eşya Tamiri',26,1,NULL,'2026-04-15 06:48:18','2026-04-15 06:48:18'),(66,'Klima Gaz Dolumu','Klima Gaz Dolumu','klima-gaz-dolumu','Klima Gaz Dolumu','Klima Gaz Dolumu',26,1,NULL,'2026-04-15 06:48:32','2026-04-15 06:48:32'),(68,'Mobilya Montajı','Mobilya Montajı','mobilya-montajı','Mobilya Montajı','Mobilya Montajı',27,1,NULL,'2026-04-15 06:49:04','2026-04-15 06:49:04'),(69,'Dolap Kurulumu','Dolap Kurulumu','dolap-kurulumu','Dolap Kurulumu','Dolap Kurulumu',27,1,NULL,'2026-04-15 06:49:20','2026-04-15 06:49:20'),(70,'Raf Montajı','Raf Montajı','raf-montajı','Raf Montajı','Raf Montajı',27,1,NULL,'2026-04-15 06:49:42','2026-04-15 06:49:42'),(71,'Mobilya Tamiri','Mobilya Tamiri','mobilya-tamiri','Mobilya Tamiri','Mobilya Tamiri',27,1,NULL,'2026-04-15 06:49:59','2026-04-15 06:49:59'),(72,'TV Ünitesi Montajı','TV Ünitesi Montajı','tv-ünitesi-montajı','TV Ünitesi Montajı','TV Ünitesi Montajı',27,1,NULL,'2026-04-15 06:50:18','2026-04-15 06:50:18'),(73,'Ev Taşıma','Ev Taşıma','ev-taşıma','Ev Taşıma','Ev Taşıma',28,1,NULL,'2026-04-15 06:50:31','2026-04-15 06:50:31'),(74,'Parça Eşya Taşıma','Parça Eşya Taşıma','parça-eşya-taşıma','Parça Eşya Taşıma','Parça Eşya Taşıma',28,1,NULL,'2026-04-15 06:50:46','2026-04-15 06:50:46'),(75,'Ofis Taşıma','Ofis Taşıma','ofis-taşıma','Ofis Taşıma','Ofis Taşıma',28,1,NULL,'2026-04-15 06:51:01','2026-04-15 06:51:01'),(76,'Şehir İçi Nakliye','Şehir İçi Nakliye','şehir-içi-nakliye','Şehir İçi Nakliye','Şehir İçi Nakliye',28,1,NULL,'2026-04-15 06:51:18','2026-04-15 06:51:18'),(77,'Yük Taşıma','Yük Taşıma','yük-taşıma','Yük Taşıma','Yük Taşıma',28,1,NULL,'2026-04-15 06:51:35','2026-04-15 06:51:35'),(78,'Böcek İlaçlama','Böcek İlaçlama','böcek-ilaçlama','Böcek İlaçlama','Böcek İlaçlama',29,1,NULL,'2026-04-15 06:51:52','2026-04-15 06:51:52'),(79,'Fare İlaçlama','Fare İlaçlama','fare-ilaçlama','Fare İlaçlama','Fare İlaçlama',29,1,NULL,'2026-04-15 06:52:09','2026-04-15 06:52:09'),(80,'Dezenfeksiyon','Dezenfeksiyon','dezenfeksiyon','Dezenfeksiyon','Dezenfeksiyon',29,1,NULL,'2026-04-15 06:52:23','2026-04-15 06:52:23'),(81,'Bahçe İlaçlama','Bahçe İlaçlama','bahçe-ilaçlama','Bahçe İlaçlama','Bahçe İlaçlama',29,1,NULL,'2026-04-15 06:52:39','2026-04-15 06:52:39'),(82,'Apartman İlaçlama','Apartman İlaçlama','apartman-ilaçlama','Apartman İlaçlama','Apartman İlaçlama',29,1,NULL,'2026-04-15 06:52:54','2026-04-15 06:52:54'),(83,'Küçük Tamirat','Küçük Tamirat','küçük-tamirat','Küçük Tamirat','Küçük Tamirat',30,1,NULL,'2026-04-15 06:53:11','2026-04-15 06:53:11'),(84,'Ev Tadilat','Ev Tadilat','ev-tadilat','Ev Tadilat','Ev Tadilat',30,1,NULL,'2026-04-15 06:53:23','2026-04-15 06:53:23'),(85,'Duvar Kırma','Duvar Kırma','duvar-kırma','Duvar Kırma','Duvar Kırma',30,1,NULL,'2026-04-15 06:53:33','2026-04-15 06:53:33'),(86,'Anahtar Teslim Tadilat','Anahtar Teslim Tadilat','anahtar-teslim-tadilat','Anahtar Teslim Tadilat','Anahtar Teslim Tadilat',30,1,NULL,'2026-04-15 06:53:48','2026-04-15 06:53:48'),(87,'Genel Usta Hizmeti','Genel Usta Hizmeti','genel-usta-hizmeti','Genel Usta Hizmeti','Genel Usta Hizmeti',30,1,NULL,'2026-04-15 06:54:06','2026-04-15 06:54:06'),(88,'Kombi Arızası','Kombi Arızası','kombi-arızası','Kombi Arızası','Kombi Arızası',32,1,NULL,'2026-05-04 12:14:31','2026-05-04 12:14:31'),(89,'Kombi Bakımı','Kombi Bakımı','kombi-bakımı','Kombi Bakımı','Kombi Bakımı',32,1,NULL,'2026-05-04 12:15:02','2026-05-04 12:15:02'),(90,'Petek Temizliği','Petek Temizliği','petek-temizliği','Petek Temizliği','Petek Temizliği',32,1,NULL,'2026-05-04 12:15:39','2026-05-04 12:15:39'),(91,'Kombi Montajı','Kombi Montajı','kombi-montajı','Kombi Montajı','Kombi Montajı',32,1,NULL,'2026-05-04 12:15:53','2026-05-04 12:15:53'),(92,'Basınç & Su Akıtma Sorunu','Basınç & Su Akıtma Sorunu','basınç-amp-su-akıtma-sorunu','Basınç & Su Akıtma Sorunu','Basınç & Su Akıtma Sorunu',32,1,NULL,'2026-05-04 12:16:25','2026-05-04 12:16:25'),(93,'Klima Arızası','Klima Arızası','klima-arızası','Klima Arızası','Klima Arızası',26,1,NULL,'2026-05-04 12:17:27','2026-05-04 12:17:27'),(94,'Lastik Değişimi','Lastik Değişimi','lastik-değişimi','Lastik Değişimi','Lastik Değişimi',31,1,NULL,'2026-05-04 12:20:25','2026-05-04 12:20:25'),(95,'Lastik Tamiri','Lastik Tamiri','lastik-tamiri','Lastik Tamiri','Lastik Tamiri',31,1,NULL,'2026-05-04 12:20:38','2026-05-04 12:20:38'),(96,'Yerinde Lastik Kontrolü','Yerinde Lastik Kontrolü','yerinde-lastik-kontrolü','Yerinde Lastik Kontrolü','Yerinde Lastik Kontrolü',31,1,NULL,'2026-05-04 12:21:31','2026-05-04 12:21:31'),(97,'Oto Çekici','Oto Çekici','oto-çekici','Oto Çekici','Oto Çekici',33,1,NULL,'2026-05-04 12:22:48','2026-05-04 12:22:48'),(98,'Akü Takviye','Akü Takviye','akü-takviye','Akü Takviye','Akü Takviye',33,1,NULL,'2026-05-04 12:22:59','2026-05-04 12:22:59'),(99,'Yakıt Bitti Yardımı','Yakıt Bitti Yardımı','yakıt-bitti-yardımı','Yakıt Bitti Yardımı','Yakıt Bitti Yardımı',33,1,NULL,'2026-05-04 12:23:21','2026-05-04 12:23:21'),(100,'Kaza Sonrası Çekici','Kaza Sonrası Çekici','kaza-sonrası-çekici','Kaza Sonrası Çekici','Kaza Sonrası Çekici',33,1,NULL,'2026-05-04 12:23:34','2026-05-04 12:23:34'),(101,'Kıyafet Yıkama','Kıyafet Yıkama','kıyafet-yıkama','Kıyafet Yıkama','Kıyafet Yıkama',34,1,NULL,'2026-05-04 12:27:18','2026-05-04 12:27:18'),(102,'Halı Yıkama','Halı Yıkama','halı-yıkama','Halı Yıkama','Halı Yıkama',34,1,NULL,'2026-05-04 12:27:47','2026-05-04 12:27:47'),(103,'Perde Yıkama','Perde Yıkama','perde-yıkama','Perde Yıkama','Perde Yıkama',34,1,NULL,'2026-05-04 12:28:15','2026-05-04 12:28:15'),(104,'Yorgan & Battaniye Yıkama','Yorgan & Battaniye Yıkama','yorgan-amp-battaniye-yıkama','Yorgan & Battaniye Yıkama','Yorgan & Battaniye Yıkama',34,1,NULL,'2026-05-04 12:29:04','2026-05-04 12:29:04'),(105,'Uydu Kurulumu ve Tamiri','Uydu Kurulumu ve Tamiri','uydu-kurulumu-ve-tamiri','Uydu Kurulumu ve Tamiri','Uydu Kurulumu ve Tamiri',23,1,NULL,'2026-05-04 12:30:34','2026-05-04 12:30:34'),(106,'Standart Dış Yıkama','Standart Dış Yıkama','standart-dış-yıkama','Standart Dış Yıkama','Standart Dış Yıkama',35,1,NULL,'2026-05-04 12:32:26','2026-05-04 12:32:26'),(107,'İç Dış Detaylı Temizlik','İç Dış Detaylı Temizlik','iç-dış-detaylı-temizlik','İç Dış Detaylı Temizlik','İç Dış Detaylı Temizlik',35,1,NULL,'2026-05-04 12:32:41','2026-05-04 12:32:41'),(108,'Araç Detaylı İç Temizlik(Premium)','Araç Detaylı İç Temizlik(Premium)','araç-detaylı-iç-temizlikpremium','Araç Detaylı İç Temizlik(Premium)','Araç Detaylı İç Temizlik(Premium)',35,1,NULL,'2026-05-04 12:33:14','2026-05-04 12:33:14'),(109,'Pasta Cila - Boya Koruma','Pasta Cila - Boya Koruma','pasta-cila-boya-koruma','Pasta Cila - Boya Koruma','Pasta Cila - Boya Koruma',35,1,NULL,'2026-05-04 12:33:32','2026-05-04 12:33:32'),(110,'Mobil Yerinde Oto Yıkama','Mobil Yerinde Oto Yıkama','mobil-yerinde-oto-yıkama','Mobil Yerinde Oto Yıkama','Mobil Yerinde Oto Yıkama',35,1,NULL,'2026-05-04 12:33:50','2026-05-04 12:33:50');
/*!40000 ALTER TABLE `sub_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscription_features`
--

DROP TABLE IF EXISTS `subscription_features`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subscription_features` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `subscription_id` bigint(20) NOT NULL,
  `feature` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=538 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscription_features`
--

LOCK TABLES `subscription_features` WRITE;
/*!40000 ALTER TABLE `subscription_features` DISABLE KEYS */;
INSERT INTO `subscription_features` VALUES (293,4,'Yearly useable','on','2023-11-08 04:59:30','2023-11-08 04:59:30'),(294,4,'Support','on','2023-11-08 04:59:30','2023-11-08 04:59:30'),(295,4,'Very professional','on','2023-11-08 04:59:30','2023-11-08 04:59:30'),(296,4,'Easy Access','on','2023-11-08 04:59:30','2023-11-08 04:59:30'),(297,4,'New policy remove','on','2023-11-08 04:59:30','2023-11-08 04:59:30'),(298,4,'Lifetime','off','2023-11-08 04:59:30','2023-11-08 04:59:30'),(299,4,'Less use','off','2023-11-08 04:59:30','2023-11-08 04:59:30'),(356,8,'Connect 5','on','2023-11-08 06:09:17','2023-11-08 06:09:17'),(357,8,'Weekly','on','2023-11-08 06:09:17','2023-11-08 06:09:17'),(358,8,'Less feature','on','2023-11-08 06:09:17','2023-11-08 06:09:17'),(359,8,'New feature','on','2023-11-08 06:09:17','2023-11-08 06:09:17'),(360,8,'Support system','on','2023-11-08 06:09:17','2023-11-08 06:09:17'),(361,8,'No drawback','on','2023-11-08 06:09:17','2023-11-08 06:09:17'),(362,8,'Professional','on','2023-11-08 06:09:17','2023-11-08 06:09:17'),(391,7,'Connect 23','on','2023-11-27 05:05:37','2023-11-27 05:05:37'),(392,7,'Professional','on','2023-11-27 05:05:37','2023-11-27 05:05:37'),(393,7,'Monthly support','on','2023-11-27 05:05:37','2023-11-27 05:05:37'),(394,7,'Features','on','2023-11-27 05:05:37','2023-11-27 05:05:37'),(395,7,'New way','on','2023-11-27 05:05:37','2023-11-27 05:05:37'),(396,7,'Long term','on','2023-11-27 05:05:37','2023-11-27 05:05:37'),(397,7,'Usefull','on','2023-11-27 05:05:37','2023-11-27 05:05:37'),(447,2,'Yearly system','on','2025-03-24 02:11:40','2025-03-24 02:11:40'),(448,2,'Professional','on','2025-03-24 02:11:40','2025-03-24 02:11:40'),(449,2,'Usefull','on','2025-03-24 02:11:40','2025-03-24 02:11:40'),(450,2,'Less price','on','2025-03-24 02:11:40','2025-03-24 02:11:40'),(451,2,'Low cost','on','2025-03-24 02:11:40','2025-03-24 02:11:40'),(452,2,'Reasonable','off','2025-03-24 02:11:40','2025-03-24 02:11:40'),(453,2,'Lifetime','off','2025-03-24 02:11:40','2025-03-24 02:11:40'),(454,3,'Monthly support','on','2025-03-24 02:12:22','2025-03-24 02:12:22'),(455,3,'Lifetime','on','2025-03-24 02:12:22','2025-03-24 02:12:22'),(456,3,'Professional','on','2025-03-24 02:12:22','2025-03-24 02:12:22'),(457,3,'Long term','off','2025-03-24 02:12:22','2025-03-24 02:12:22'),(458,3,'New feature','off','2025-03-24 02:12:22','2025-03-24 02:12:22'),(459,3,'Unlimited validity','off','2025-03-24 02:12:22','2025-03-24 02:12:22'),(460,3,'All Time','off','2025-03-24 02:12:22','2025-03-24 02:12:22'),(461,5,'Connect 100','on','2025-03-24 02:12:31','2025-03-24 02:12:31'),(462,5,'Yearly system','on','2025-03-24 02:12:31','2025-03-24 02:12:31'),(463,5,'Less use','on','2025-03-24 02:12:31','2025-03-24 02:12:31'),(464,5,'Professional','on','2025-03-24 02:12:31','2025-03-24 02:12:31'),(465,5,'One time get','on','2025-03-24 02:12:31','2025-03-24 02:12:31'),(466,5,'Monthly support','on','2025-03-24 02:12:31','2025-03-24 02:12:31'),(467,5,'New policy','on','2025-03-24 02:12:31','2025-03-24 02:12:31'),(475,9,'Connect 10','on','2025-03-24 02:12:51','2025-03-24 02:12:51'),(476,9,'Weekly 2','on','2025-03-24 02:12:51','2025-03-24 02:12:51'),(477,9,'Limit 10','on','2025-03-24 02:12:51','2025-03-24 02:12:51'),(478,9,'Professional','on','2025-03-24 02:12:51','2025-03-24 02:12:51'),(479,9,'Supported','on','2025-03-24 02:12:51','2025-03-24 02:12:51'),(480,9,'Less use','on','2025-03-24 02:12:51','2025-03-24 02:12:51'),(481,9,'Welcome feature','off','2025-03-24 02:12:51','2025-03-24 02:12:51'),(503,1,'Month wise','on','2026-05-06 13:48:52','2026-05-06 13:48:52'),(504,1,'Get more connect','on','2026-05-06 13:48:52','2026-05-06 13:48:52'),(505,1,'Multiple use','on','2026-05-06 13:48:52','2026-05-06 13:48:52'),(506,1,'Multi connect','on','2026-05-06 13:48:52','2026-05-06 13:48:52'),(507,1,'Professional use','on','2026-05-06 13:48:52','2026-05-06 13:48:52'),(508,1,'Month wise','off','2026-05-06 13:48:52','2026-05-06 13:48:52'),(509,1,'Lifetime support','off','2026-05-06 13:48:52','2026-05-06 13:48:52'),(524,10,'Free for first time','on','2026-05-06 14:02:35','2026-05-06 14:02:35'),(525,10,'Get while register','on','2026-05-06 14:02:35','2026-05-06 14:02:35'),(526,10,'Must register as a freelancer','on','2026-05-06 14:02:35','2026-05-06 14:02:35'),(527,10,'One time get','on','2026-05-06 14:02:35','2026-05-06 14:02:35'),(528,10,'Use for job proposal','on','2026-05-06 14:02:35','2026-05-06 14:02:35'),(529,10,'Get only once','on','2026-05-06 14:02:35','2026-05-06 14:02:35'),(530,10,'Totally Free','on','2026-05-06 14:02:35','2026-05-06 14:02:35'),(531,6,'Connect 10','on','2026-05-06 14:55:58','2026-05-06 14:55:58'),(532,6,'Monthly support','on','2026-05-06 14:55:58','2026-05-06 14:55:58'),(533,6,'Professional','on','2026-05-06 14:55:58','2026-05-06 14:55:58'),(534,6,'List type','on','2026-05-06 14:55:58','2026-05-06 14:55:58'),(535,6,'New feature','on','2026-05-06 14:55:58','2026-05-06 14:55:58'),(536,6,'Long term','on','2026-05-06 14:55:58','2026-05-06 14:55:58'),(537,6,'Healthy usecase','on','2026-05-06 14:55:58','2026-05-06 14:55:58');
/*!40000 ALTER TABLE `subscription_features` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscription_types`
--

DROP TABLE IF EXISTS `subscription_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subscription_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `validity` int(11) DEFAULT NULL,
  `is_free` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscription_types`
--

LOCK TABLES `subscription_types` WRITE;
/*!40000 ALTER TABLE `subscription_types` DISABLE KEYS */;
INSERT INTO `subscription_types` VALUES (1,'Aylık',30,0,'2023-04-30 06:39:12','2026-05-07 06:18:30'),(2,'Yearly',365,0,'2023-04-30 06:39:24','2023-06-13 00:11:36'),(3,'Weekly',7,0,'2023-06-13 00:13:12','2023-06-13 00:13:12'),(5,'Ücretsiz',30,1,'2023-08-19 06:56:31','2026-05-07 06:18:19');
/*!40000 ALTER TABLE `subscription_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscriptions`
--

DROP TABLE IF EXISTS `subscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subscriptions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `subscription_type_id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `limit` bigint(20) NOT NULL,
  `commission_rate` decimal(5,2) DEFAULT NULL,
  `commission_type` enum('percentage','fixed') DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-active, 0-inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `apple_product_id` varchar(255) DEFAULT NULL,
  `google_product_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscriptions`
--

LOCK TABLES `subscriptions` WRITE;
/*!40000 ALTER TABLE `subscriptions` DISABLE KEYS */;
INSERT INTO `subscriptions` VALUES (1,1,'Pro','113',399,100,NULL,NULL,1,'2023-05-01 22:45:15','2026-05-06 13:49:04',NULL,NULL),(6,1,'Premium','230',999,50,NULL,NULL,1,'2023-06-13 23:10:38','2026-05-06 14:55:58',NULL,NULL),(10,5,'Free','231',0,5,NULL,NULL,1,'2023-08-19 06:57:07','2026-05-06 14:02:35',NULL,NULL);
/*!40000 ALTER TABLE `subscriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tickets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `department_id` bigint(20) NOT NULL,
  `admin_id` bigint(20) DEFAULT NULL,
  `client_id` bigint(20) DEFAULT NULL,
  `freelancer_id` bigint(20) DEFAULT NULL,
  `title` text DEFAULT NULL,
  `subject` text DEFAULT NULL,
  `priority` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'open',
  `via` text DEFAULT NULL COMMENT 'admin, client, freelancer',
  `operating_system` varchar(255) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `description` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tickets`
--

LOCK TABLES `tickets` WRITE;
/*!40000 ALTER TABLE `tickets` DISABLE KEYS */;
/*!40000 ALTER TABLE `tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_addresses`
--

DROP TABLE IF EXISTS `user_addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_addresses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL COMMENT 'Address name e.g. Home, Office',
  `address_details` text NOT NULL,
  `country_id` bigint(20) unsigned DEFAULT NULL,
  `state_id` bigint(20) unsigned DEFAULT NULL,
  `city_id` bigint(20) unsigned DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_addresses_user_id_foreign` (`user_id`),
  CONSTRAINT `user_addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_addresses`
--

LOCK TABLES `user_addresses` WRITE;
/*!40000 ALTER TABLE `user_addresses` DISABLE KEYS */;
INSERT INTO `user_addresses` VALUES (1,1,'Ev','Çamlıca mah. Ahmet Taner Kışlalı cad. Park Evleri B blok daire:1 no:57/B',15,26,22,'16000',NULL,1,'2026-04-24 14:58:19','2026-04-25 16:36:21',NULL),(2,1236,'Ev','Çınar Pastanesi',15,26,22,'16000',NULL,0,'2026-04-26 14:51:56','2026-04-26 14:52:33','2026-04-26 14:52:33');
/*!40000 ALTER TABLE `user_addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_earnings`
--

DROP TABLE IF EXISTS `user_earnings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_earnings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `total_earning` double NOT NULL DEFAULT 0,
  `total_withdraw` double NOT NULL DEFAULT 0,
  `remaining_balance` double NOT NULL DEFAULT 0,
  `show_earning` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_earnings`
--

LOCK TABLES `user_earnings` WRITE;
/*!40000 ALTER TABLE `user_earnings` DISABLE KEYS */;
INSERT INTO `user_earnings` VALUES (1,1236,1982.11,0,1982.11,1,'2026-04-05 12:16:51','2026-04-28 05:52:11'),(2,1,7.11,0,7.11,1,'2026-04-16 12:48:49','2026-04-16 12:48:49');
/*!40000 ALTER TABLE `user_earnings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_education`
--

DROP TABLE IF EXISTS `user_education`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_education` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `institution` varchar(255) NOT NULL,
  `degree` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_education`
--

LOCK TABLES `user_education` WRITE;
/*!40000 ALTER TABLE `user_education` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_education` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_experiences`
--

DROP TABLE IF EXISTS `user_experiences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_experiences` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `short_description` varchar(255) NOT NULL,
  `organization` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `country_id` varchar(255) NOT NULL,
  `state_id` varchar(255) NOT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_experiences`
--

LOCK TABLES `user_experiences` WRITE;
/*!40000 ALTER TABLE `user_experiences` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_experiences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_introductions`
--

DROP TABLE IF EXISTS `user_introductions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_introductions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_introductions`
--

LOCK TABLES `user_introductions` WRITE;
/*!40000 ALTER TABLE `user_introductions` DISABLE KEYS */;
INSERT INTO `user_introductions` VALUES (2,7,'Laravel Developer','I am a professional web developer work experience with 5 years. I will able to develop your any business  with laravel.','2023-02-01 01:37:26','2023-03-19 06:05:38'),(7,1,'Usta','Hizmet veren şahıs','2024-10-10 11:27:40','2026-04-27 09:34:17');
/*!40000 ALTER TABLE `user_introductions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_notifications`
--

DROP TABLE IF EXISTS `user_notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_notifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `identity` bigint(20) NOT NULL,
  `client_id` bigint(20) NOT NULL,
  `freelancer_id` bigint(20) NOT NULL,
  `type` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `is_client_read` varchar(255) NOT NULL DEFAULT 'unread',
  `is_freelancer_read` varchar(255) NOT NULL DEFAULT 'unread',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_notifications`
--

LOCK TABLES `user_notifications` WRITE;
/*!40000 ALTER TABLE `user_notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_service_areas`
--

DROP TABLE IF EXISTS `user_service_areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_service_areas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `country_id` bigint(20) unsigned NOT NULL,
  `state_id` bigint(20) unsigned NOT NULL,
  `city_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_service_areas_user_id_foreign` (`user_id`),
  KEY `user_service_areas_country_id_index` (`country_id`),
  KEY `user_service_areas_state_id_index` (`state_id`),
  KEY `user_service_areas_city_id_index` (`city_id`),
  CONSTRAINT `user_service_areas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_service_areas`
--

LOCK TABLES `user_service_areas` WRITE;
/*!40000 ALTER TABLE `user_service_areas` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_service_areas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_skills`
--

DROP TABLE IF EXISTS `user_skills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_skills` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `skill` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_skills`
--

LOCK TABLES `user_skills` WRITE;
/*!40000 ALTER TABLE `user_skills` DISABLE KEYS */;
INSERT INTO `user_skills` VALUES (1,7,'Laravel, Php, Node Js, Firebase on Android, Android, Android foundations','2023-02-13 01:11:06','2023-09-18 00:49:15'),(3,1,'HTML,CSS,Javascript','2024-10-09 09:17:39','2024-10-09 09:17:39');
/*!40000 ALTER TABLE `user_skills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_subscriptions`
--

DROP TABLE IF EXISTS `user_subscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_subscriptions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `subscription_id` bigint(20) NOT NULL,
  `price` double NOT NULL DEFAULT 0,
  `limit` bigint(20) NOT NULL DEFAULT 0,
  `expire_date` timestamp NULL DEFAULT NULL,
  `payment_gateway` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `transaction_id` varchar(255) DEFAULT NULL,
  `manual_payment_image` varchar(255) DEFAULT NULL,
  `email_send` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_subscriptions`
--

LOCK TABLES `user_subscriptions` WRITE;
/*!40000 ALTER TABLE `user_subscriptions` DISABLE KEYS */;
INSERT INTO `user_subscriptions` VALUES (1,1236,10,0,20,'2026-04-26 16:17:10','Trial','complete',0,NULL,NULL,NULL,'2026-03-27 16:17:10','2026-05-06 13:33:32'),(2,1236,6,50,10,'2026-06-05 13:36:13','manual_assignment','complete',0,'ADMIN_wGWgdvzgRq',NULL,NULL,'2026-05-06 13:36:13','2026-05-06 13:49:31'),(3,1236,1,399,100,'2026-06-05 13:50:07','manual_assignment','complete',0,'ADMIN_dDaeTRJuj4',NULL,NULL,'2026-05-06 13:50:07','2026-05-06 13:50:39'),(4,1236,6,999,10,'2026-06-05 13:50:46','manual_assignment','complete',0,'ADMIN_B3MylbFqyC',NULL,NULL,'2026-05-06 13:50:46','2026-05-06 13:54:17'),(5,1236,6,999,10,'2026-06-05 13:54:25','manual_assignment','complete',0,'ADMIN_DCva7nxmlE',NULL,NULL,'2026-05-06 13:54:25','2026-05-06 14:13:00'),(6,1236,1,399,100,'2026-06-05 14:13:34','manual_assignment','complete',0,'ADMIN_izWtAKcbZ3',NULL,NULL,'2026-05-06 14:13:34','2026-05-06 14:21:47'),(7,1236,6,999,50,'2026-06-05 14:21:53','manual_assignment','complete',0,'ADMIN_xVIThjzyZw',NULL,NULL,'2026-05-06 14:21:53','2026-05-06 14:45:12'),(8,1236,1,399,100,'2026-06-05 14:45:41','manual_assignment','complete',0,'ADMIN_k8k5EjtKEI',NULL,NULL,'2026-05-06 14:45:41','2026-05-06 14:47:18'),(9,1236,6,999,50,'2026-06-05 14:50:42','manual_assignment','complete',0,'ADMIN_y1mkcTtNUn',NULL,NULL,'2026-05-06 14:50:42','2026-05-06 14:55:01'),(10,1236,6,999,50,'2026-06-05 14:56:17','manual_assignment','complete',0,'ADMIN_3DABCZJh19',NULL,NULL,'2026-05-06 14:56:17','2026-05-06 14:56:36'),(11,1236,1,399,100,'2026-06-05 14:56:44','manual_assignment','complete',0,'ADMIN_iXGEXu6n6V',NULL,NULL,'2026-05-06 14:56:44','2026-05-06 15:05:45'),(12,1236,6,999,50,'2026-06-06 05:45:39','iyzipay','complete',0,'32324302',NULL,NULL,'2026-05-07 05:45:39','2026-05-07 10:11:29'),(13,1236,1,399,100,'2026-06-06 10:11:43','manual_assignment','complete',1,'ADMIN_ofAVW470GJ',NULL,NULL,'2026-05-07 10:11:43','2026-05-07 10:11:43');
/*!40000 ALTER TABLE `user_subscriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_works`
--

DROP TABLE IF EXISTS `user_works`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_works` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `sub_category_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_works`
--

LOCK TABLES `user_works` WRITE;
/*!40000 ALTER TABLE `user_works` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_works` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `hourly_rate` double NOT NULL DEFAULT 0,
  `experience_level` varchar(255) NOT NULL DEFAULT 'junior',
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `country_id` bigint(20) DEFAULT NULL,
  `state_id` bigint(20) DEFAULT NULL,
  `city_id` bigint(20) DEFAULT NULL,
  `user_type` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1:client, 2:freelancer',
  `check_online_status` timestamp NULL DEFAULT NULL,
  `check_work_availability` tinyint(4) NOT NULL DEFAULT 1,
  `user_active_inactive_status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0:inactive, 1:active',
  `user_verified_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:not verified, 1:verified',
  `is_suspend` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=no , 1=yes',
  `terms_condition` int(11) NOT NULL DEFAULT 1,
  `about` text DEFAULT NULL,
  `is_email_verified` varchar(255) NOT NULL DEFAULT '0' COMMENT '0: not verified, 1:verified',
  `google_2fa_secret` varchar(255) DEFAULT NULL,
  `google_2fa_enable_disable_disable` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=disable 1=enable',
  `google_id` varchar(255) DEFAULT NULL,
  `facebook_id` varchar(255) DEFAULT NULL,
  `github_id` varchar(255) DEFAULT NULL,
  `apple_id` varchar(255) DEFAULT NULL,
  `iyzico_card_user_key` varchar(255) DEFAULT NULL,
  `is_pro` varchar(255) DEFAULT NULL,
  `pro_expire_date` timestamp NULL DEFAULT NULL,
  `email_verify_token` text DEFAULT NULL,
  `firebase_device_token` varchar(255) DEFAULT NULL,
  `freeze_withdraw` varchar(255) DEFAULT NULL,
  `freeze_project` varchar(255) DEFAULT NULL,
  `freeze_job` varchar(255) DEFAULT NULL,
  `freeze_chat` varchar(255) DEFAULT NULL,
  `freeze_order_create` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `load_from` int(11) NOT NULL DEFAULT 0,
  `is_synced` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=1238 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Test','Müşterisi',0,'junior','mustafa24031999@gmail.com','05418553983','client','$2y$10$dVn7Zka2IxHQeXYRCe/GweDPW7wqxjwT2qycATvIcLh3fg20i5z0W','1775509492-69d41ff4e0378.jpg',15,26,22,1,'2026-05-07 10:11:43',1,1,1,0,1,NULL,'1','HATKCPGN5WGPJEFU',0,NULL,NULL,NULL,NULL,'e0a0d1b2-3356-40b5-223f-fafa705e2c57',NULL,NULL,'876626','emf52-eI80iEnWUOG7en3B:APA91bGuABwboHkzHiXoz7FPGLBEMlaCiYVHxWGToMxxSXaQks0MLwKDgL5gTkhQ3W0bRHFn_CVoBcaPTZE6y68XAh4WLhzH0hcR1xEiUYtRuyTkdDmPdko',NULL,NULL,'unfreeze','unfreeze','unfreeze',NULL,'9bYFbnj3vdGJByPaP04Kuct8bUz4jcNbIkzp5ENZ6agJXVY4QSgL6RjHZHwn',0,0,'2023-01-23 06:03:28','2026-05-07 10:11:43',NULL),(7,'William','Montag',30,'senior','ali.abdulah.sd@gmail.com','6546463544645','freelancer','$2y$10$qIx2SM3faeDLL.Mv3.OrsuqZD5iP6oEvWe3OUizm5yQ5xGxQmtbq2','1768374471-696740c74fc92.png',11,20,1,2,'2026-04-12 14:12:58',1,1,1,0,1,NULL,'1','SOVLAM7IWRWHZX23',0,NULL,NULL,NULL,NULL,NULL,'yes','2026-05-11 18:03:46','531787','c8XucJuiRXqVYxPZ-j3MwZ:APA91bH357HYy2TEkuM7vAy5qQDsnSJrEk0s8gdn1to94Wtc4o5EZ0B1fJFVr6t16BVfVbc7BWdrEi2Y8MBb7TdjQOEK9u6KdfcqCm6XncPAwXGrNX2AqeM','unfreeze','unfreeze',NULL,'unfreeze',NULL,NULL,'kfL7trBuRTuiJtCsoIJ195yD2sUPVSEXfjdxN12cTLwqcPDGzQZflqKJhDvM',0,0,'2023-01-24 04:58:46','2026-05-05 13:11:02','2026-05-05 13:11:02'),(1236,'ahmet eren','şahin',0,'junior','ahmeteren1999@gmail.com','541 855 39 83','ahmeteren1999','$2y$10$F9QPrKX737D1ebY8tF7eLOoWSWXLcAjcFO75C1C04H71z2O7UDIiq','1777148445-69ed221d47186.jpg',15,26,22,2,'2026-05-09 10:01:30',1,1,1,0,1,NULL,'1',NULL,0,NULL,NULL,NULL,NULL,'4a738df9-c104-9b40-01ab-84775cea030f',NULL,NULL,'595731','d5EzUntW9EbtmrlFigehPg:APA91bHn-myBI40FeBN7usD2eXq11Z5DYth9UIPminUnZhmMGMw70_LCVZEasQAKCOawXb6hrNDiGsyAvIsGI4G_Nk3i1dPEFUeQU7ABpht04F0zBN-y4UE',NULL,NULL,NULL,NULL,NULL,'2026-03-27 16:21:51','ZxDWQ2mAlCUDifKeMds1QpOUD1HZoiqZB8GKyXtuYRtAYjh15SMqbj6yNb0t',0,0,'2026-03-27 16:17:10','2026-05-09 10:01:30',NULL),(1237,'bekir can','anğay',0,'junior','bekircan161616@gmail.com','+905335196416','beko16','$2y$10$a7EZXPz7a4lL7MEtuU1B3e7nPfc/OZ5n4c9Bmb9MIVsaXsgTMa/7.','1776353227-69e0ffcb48d95.jpg',15,26,22,1,'2026-04-16 12:51:12',1,1,1,0,1,NULL,'1',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'446931','cSX16SdGXkfagtVH8NgN-u:APA91bF3JFsd56SKD2K87e56vxJ0DOAs3y8NzJgWY-OlJFl-XEh4xdDtqtTcLpUJlzCE9aQCFbXcI_HbSOnCAXtinHPArEZVhVkvFFeExHr5B-1L5gw_SkA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,'2026-04-16 12:10:26','2026-04-16 12:51:12',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wallet_histories`
--

DROP TABLE IF EXISTS `wallet_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wallet_histories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `payment_gateway` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `amount` double NOT NULL DEFAULT 0,
  `transaction_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `type` varchar(255) NOT NULL DEFAULT 'deposit',
  `currency` varchar(255) DEFAULT NULL,
  `conversion_rate` double DEFAULT NULL,
  `symbol` varchar(255) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `manual_payment_image` varchar(255) NOT NULL DEFAULT '0',
  `note` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `email_send` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wallet_histories`
--

LOCK TABLES `wallet_histories` WRITE;
/*!40000 ALTER TABLE `wallet_histories` DISABLE KEYS */;
INSERT INTO `wallet_histories` VALUES (1,1236,'Order','complete',79,0.00,79.00,'earning','TRY',NULL,'TRY','order_17_1775402211','0',NULL,1,NULL,'2026-04-05 12:16:51','2026-04-05 12:16:51'),(2,1236,'Order','complete',79,0.00,79.00,'earning','TRY',NULL,'TRY','order_18_1775403416','0',NULL,1,NULL,'2026-04-05 12:36:56','2026-04-05 12:36:56'),(3,1236,'Order','complete',7.11,0.00,7.11,'earning','TRY',NULL,'TRY','order_21_1775429660','0',NULL,1,NULL,'2026-04-05 19:54:20','2026-04-05 19:54:20'),(4,1236,'Order','complete',790,0.00,790.00,'earning','TRY',NULL,'TRY','order_26_1775500416','0',NULL,1,NULL,'2026-04-06 15:33:36','2026-04-06 15:33:36'),(5,1,'Order','complete',7.11,0.00,7.11,'earning','TRY',NULL,'TRY','order_30_1776354529','0',NULL,1,NULL,'2026-04-16 12:48:49','2026-04-16 12:48:49'),(6,1,'iyzipay','complete',10000,0.00,0.00,'deposit',NULL,NULL,NULL,NULL,'0',NULL,1,NULL,'2026-04-25 14:48:25','2026-04-25 14:58:34'),(7,1,'Havale/EFT','complete',1000,0.00,0.00,'withdraw',NULL,NULL,NULL,'WITHDRAW-4','0',NULL,1,NULL,'2026-04-25 15:21:38','2026-04-25 15:22:45'),(8,1,'manual_admin','complete',2000,0.00,0.00,'deposit',NULL,NULL,NULL,'ADMIN-69ed07e39c64a','0',NULL,1,NULL,'2026-04-25 15:28:51','2026-04-25 15:28:51'),(9,1,'Havale/EFT','cancel',2000,0.00,0.00,'withdraw',NULL,NULL,NULL,'WITHDRAW-5','0',NULL,1,NULL,'2026-04-25 15:30:21','2026-04-25 15:32:04'),(10,1236,'Order','complete',790,0.00,790.00,'earning','TRY',NULL,'TRY','order_72_1777146679','0',NULL,1,NULL,'2026-04-25 16:51:19','2026-04-25 16:51:19'),(11,1236,'Order','complete',237,0.00,237.00,'earning','TRY',NULL,'TRY','order_74_1777366331','0',NULL,1,NULL,'2026-04-28 05:52:11','2026-04-28 05:52:11');
/*!40000 ALTER TABLE `wallet_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wallets`
--

DROP TABLE IF EXISTS `wallets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wallets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `balance` double NOT NULL,
  `remaining_balance` double NOT NULL DEFAULT 0,
  `withdraw_amount` double NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wallets`
--

LOCK TABLES `wallets` WRITE;
/*!40000 ALTER TABLE `wallets` DISABLE KEYS */;
INSERT INTO `wallets` VALUES (1,1236,1791.11,1782.11,200,1,'2026-03-27 16:17:10','2026-04-28 05:52:11'),(2,1,20413.11,19374.11,4000,1,'2026-04-05 11:49:11','2026-05-04 12:45:35'),(3,1237,0,0,0,1,'2026-04-16 12:10:26','2026-04-16 12:10:26');
/*!40000 ALTER TABLE `wallets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `widgets`
--

DROP TABLE IF EXISTS `widgets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `widgets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `widget_area` varchar(255) DEFAULT NULL,
  `widget_order` int(11) DEFAULT NULL,
  `widget_location` varchar(255) DEFAULT NULL,
  `widget_name` text NOT NULL,
  `widget_content` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `widgets`
--

LOCK TABLES `widgets` WRITE;
/*!40000 ALTER TABLE `widgets` DISABLE KEYS */;
INSERT INTO `widgets` VALUES (13,NULL,2,'footer_one','AboutUsWidget','a:7:{s:2:\"id\";s:2:\"13\";s:11:\"widget_name\";s:13:\"AboutUsWidget\";s:11:\"widget_type\";s:6:\"update\";s:15:\"widget_location\";s:10:\"footer_one\";s:12:\"widget_order\";s:1:\"2\";s:5:\"title\";s:8:\"About Us\";s:9:\"menu_link\";a:2:{s:10:\"list_item_\";a:4:{i:0;s:5:\"About\";i:1;s:7:\"Contact\";i:2;s:14:\"Privacy Policy\";i:3;s:20:\"Terms and Conditions\";}s:4:\"url_\";a:4:{i:0;s:1:\"#\";i:1;s:1:\"#\";i:2;s:1:\"#\";i:3;s:1:\"#\";}}}','2023-10-31 05:11:20','2023-10-31 05:59:33'),(14,NULL,1,'footer_one','SocialAreaWidget','a:8:{s:2:\"id\";s:2:\"14\";s:11:\"widget_name\";s:16:\"SocialAreaWidget\";s:11:\"widget_type\";s:6:\"update\";s:15:\"widget_location\";s:10:\"footer_one\";s:12:\"widget_order\";s:1:\"1\";s:5:\"image\";s:3:\"228\";s:11:\"description\";s:45:\"Hi You will find everything on this platform.\";s:11:\"social_icon\";a:2:{s:5:\"icon_\";a:4:{i:0;s:17:\"fab fa-facebook-f\";i:1;s:14:\"fab fa-youtube\";i:2;s:14:\"fab fa-twitter\";i:3;s:18:\"fab fa-linkedin-in\";}s:4:\"url_\";a:4:{i:0;s:1:\"#\";i:1;s:1:\"#\";i:2;s:1:\"#\";i:3;s:1:\"#\";}}}','2023-10-31 05:34:22','2025-03-24 02:03:20'),(15,NULL,3,'footer_one','ServiceWidget','a:9:{s:2:\"id\";s:2:\"15\";s:11:\"widget_name\";s:13:\"ServiceWidget\";s:11:\"widget_type\";s:6:\"update\";s:15:\"widget_location\";s:10:\"footer_one\";s:12:\"widget_order\";s:1:\"3\";s:5:\"title\";s:8:\"Services\";s:8:\"order_by\";s:2:\"id\";s:5:\"order\";s:3:\"asc\";s:5:\"items\";s:1:\"5\";}','2023-10-31 06:12:50','2023-10-31 06:25:06'),(16,NULL,4,'footer_one','ContactUsWidget','a:7:{s:2:\"id\";s:2:\"16\";s:11:\"widget_name\";s:15:\"ContactUsWidget\";s:11:\"widget_type\";s:6:\"update\";s:15:\"widget_location\";s:10:\"footer_one\";s:12:\"widget_order\";s:1:\"4\";s:5:\"title\";s:10:\"Contact Us\";s:12:\"contact_info\";a:2:{s:5:\"icon_\";a:3:{i:0;s:12:\"fas fa-phone\";i:1;s:15:\"far fa-envelope\";i:2;s:17:\"fas fa-map-marker\";}s:5:\"info_\";a:3:{i:0;s:13:\"+627-521-1504\";i:1;s:18:\"info@washeco.co.uk\";i:2;s:27:\"8702 Jayson, Well Suite 348\";}}}','2023-10-31 06:37:46','2023-10-31 06:38:30'),(18,NULL,1,'footer_two','ContactUsTwoWidget','a:8:{s:2:\"id\";s:2:\"18\";s:11:\"widget_name\";s:18:\"ContactUsTwoWidget\";s:11:\"widget_type\";s:6:\"update\";s:15:\"widget_location\";s:10:\"footer_two\";s:12:\"widget_order\";s:1:\"1\";s:5:\"title\";s:10:\"Contact Us\";s:11:\"description\";s:70:\"Amet minim mollit non deserunt ullamco est sit ali dolor do amet sint.\";s:12:\"contact_info\";a:2:{s:5:\"icon_\";a:2:{i:0;s:12:\"fas fa-phone\";i:1;s:15:\"fas fa-envelope\";}s:5:\"info_\";a:2:{i:0;s:29:\"Have a question? 310-437-2766\";i:1;s:35:\"Have a question? unreal@example.com\";}}}','2023-10-31 07:26:30','2023-11-27 08:54:56'),(19,NULL,2,'footer_two','AboutUsWidget','a:7:{s:2:\"id\";s:2:\"19\";s:11:\"widget_name\";s:13:\"AboutUsWidget\";s:11:\"widget_type\";s:6:\"update\";s:15:\"widget_location\";s:10:\"footer_two\";s:12:\"widget_order\";s:1:\"2\";s:5:\"title\";s:8:\"About Us\";s:9:\"menu_link\";a:2:{s:10:\"list_item_\";a:5:{i:0;s:5:\"About\";i:1;s:7:\"Contact\";i:2;s:14:\"Privacy Policy\";i:3;s:20:\"Terms and Conditions\";i:4;s:20:\"Terms and Conditions\";}s:4:\"url_\";a:5:{i:0;s:1:\"#\";i:1;s:1:\"#\";i:2;s:1:\"#\";i:3;s:1:\"#\";i:4;s:1:\"#\";}}}','2023-10-31 07:33:39','2023-10-31 07:34:50'),(20,NULL,3,'footer_two','ServiceWidget','a:9:{s:2:\"id\";s:2:\"20\";s:11:\"widget_name\";s:13:\"ServiceWidget\";s:11:\"widget_type\";s:6:\"update\";s:15:\"widget_location\";s:10:\"footer_two\";s:12:\"widget_order\";s:1:\"3\";s:5:\"title\";s:8:\"Services\";s:8:\"order_by\";s:2:\"id\";s:5:\"order\";s:3:\"asc\";s:5:\"items\";s:1:\"5\";}','2023-10-31 07:35:30','2023-10-31 07:40:20'),(21,NULL,4,'footer_two','NewsLetterWidget','a:7:{s:2:\"id\";s:2:\"21\";s:11:\"widget_name\";s:16:\"NewsLetterWidget\";s:11:\"widget_type\";s:6:\"update\";s:15:\"widget_location\";s:10:\"footer_two\";s:12:\"widget_order\";s:1:\"4\";s:5:\"title\";s:20:\"Subscribe Newsletter\";s:11:\"description\";s:81:\"Enter your email to receive regular updates, newsletters. We promise to not spam.\";}','2023-10-31 07:41:26','2023-10-31 07:41:53'),(22,NULL,1,'footer_four','AboutUsWidget','a:7:{s:2:\"id\";s:2:\"22\";s:11:\"widget_name\";s:13:\"AboutUsWidget\";s:11:\"widget_type\";s:6:\"update\";s:15:\"widget_location\";s:11:\"footer_four\";s:12:\"widget_order\";s:1:\"1\";s:5:\"title\";s:5:\"About\";s:9:\"menu_link\";a:2:{s:10:\"list_item_\";a:5:{i:0;s:8:\"About Us\";i:1;s:8:\"Find Job\";i:2;s:7:\"Pricing\";i:3;s:7:\"Service\";i:4;s:17:\"Terms Of Services\";}s:4:\"url_\";a:5:{i:0;s:9:\"/about-us\";i:1;s:9:\"/jobs/all\";i:2;s:17:\"subscriptions/all\";i:3;s:12:\"projects/all\";i:4;s:17:\"/terms-conditions\";}}}','2025-12-24 10:59:28','2026-01-20 06:33:02'),(23,NULL,2,'footer_four','ServiceWidget','a:9:{s:2:\"id\";s:2:\"23\";s:11:\"widget_name\";s:13:\"ServiceWidget\";s:11:\"widget_type\";s:6:\"update\";s:15:\"widget_location\";s:11:\"footer_four\";s:12:\"widget_order\";s:1:\"2\";s:5:\"title\";s:10:\"Categories\";s:8:\"order_by\";s:2:\"id\";s:5:\"order\";s:3:\"asc\";s:5:\"items\";N;}','2025-12-24 11:00:03','2025-12-24 11:02:57'),(24,NULL,3,'footer_four','SupportWidget','a:7:{s:2:\"id\";s:2:\"24\";s:11:\"widget_name\";s:13:\"SupportWidget\";s:11:\"widget_type\";s:6:\"update\";s:15:\"widget_location\";s:11:\"footer_four\";s:12:\"widget_order\";s:1:\"3\";s:5:\"title\";s:7:\"Support\";s:9:\"menu_link\";a:2:{s:10:\"list_item_\";a:5:{i:0;s:14:\"Privacy Policy\";i:1;s:18:\"Terms & Conditions\";i:2;s:14:\"Help & Support\";i:3;s:10:\"Contact Us\";i:4;s:13:\"Documentation\";}s:4:\"url_\";a:5:{i:0;s:15:\"/privacy-policy\";i:1;s:17:\"/terms-conditions\";i:2;s:9:\"/about-us\";i:3;s:11:\"/contact-us\";i:4;s:11:\"/contact-us\";}}}','2025-12-24 11:01:06','2025-12-30 08:27:36'),(25,NULL,4,'footer_four','NewsLetterWidget','a:7:{s:2:\"id\";s:2:\"25\";s:11:\"widget_name\";s:16:\"NewsLetterWidget\";s:11:\"widget_type\";s:6:\"update\";s:15:\"widget_location\";s:11:\"footer_four\";s:12:\"widget_order\";s:1:\"4\";s:5:\"title\";s:9:\"Subscribe\";s:11:\"description\";s:68:\"Receive Xilancer news, updates,exclusive discounts and early access.\";}','2025-12-24 11:01:45','2025-12-24 11:02:00'),(26,NULL,1,'footer_three','AboutUsWidget','a:7:{s:2:\"id\";s:2:\"26\";s:11:\"widget_name\";s:13:\"AboutUsWidget\";s:11:\"widget_type\";s:6:\"update\";s:15:\"widget_location\";s:12:\"footer_three\";s:12:\"widget_order\";s:1:\"1\";s:5:\"title\";s:5:\"About\";s:9:\"menu_link\";a:2:{s:10:\"list_item_\";a:5:{i:0;s:8:\"About Us\";i:1;s:8:\"Find Job\";i:2;s:7:\"Pricing\";i:3;s:7:\"Service\";i:4;s:17:\"Terms Of Services\";}s:4:\"url_\";a:5:{i:0;s:9:\"/about-us\";i:1;s:9:\"/jobs/all\";i:2;s:17:\"subscriptions/all\";i:3;s:12:\"projects/all\";i:4;s:17:\"/terms-conditions\";}}}','2025-12-24 11:53:52','2026-01-20 06:33:12'),(27,NULL,2,'footer_three','ServiceWidget','a:8:{s:11:\"widget_name\";s:13:\"ServiceWidget\";s:11:\"widget_type\";s:3:\"new\";s:15:\"widget_location\";s:12:\"footer_three\";s:12:\"widget_order\";s:1:\"2\";s:5:\"title\";s:10:\"Categories\";s:8:\"order_by\";s:2:\"id\";s:5:\"order\";s:3:\"asc\";s:5:\"items\";N;}','2025-12-30 08:31:53','2025-12-30 08:31:53'),(28,NULL,3,'footer_three','SupportWidget','a:6:{s:11:\"widget_name\";s:13:\"SupportWidget\";s:11:\"widget_type\";s:3:\"new\";s:15:\"widget_location\";s:12:\"footer_three\";s:12:\"widget_order\";s:1:\"3\";s:5:\"title\";s:7:\"Support\";s:9:\"menu_link\";a:2:{s:10:\"list_item_\";a:5:{i:0;s:14:\"Privacy Policy\";i:1;s:18:\"Terms & Conditions\";i:2;s:14:\"Help & Support\";i:3;s:10:\"Contact Us\";i:4;s:13:\"Documentation\";}s:4:\"url_\";a:5:{i:0;s:15:\"/privacy-policy\";i:1;s:17:\"/terms-conditions\";i:2;s:9:\"/about-us\";i:3;s:11:\"/contact-us\";i:4;s:11:\"/contact-us\";}}}','2025-12-30 08:33:46','2025-12-30 08:33:46'),(29,NULL,4,'footer_three','NewsLetterWidget','a:6:{s:11:\"widget_name\";s:16:\"NewsLetterWidget\";s:11:\"widget_type\";s:3:\"new\";s:15:\"widget_location\";s:12:\"footer_three\";s:12:\"widget_order\";s:1:\"4\";s:5:\"title\";s:9:\"Subscribe\";s:11:\"description\";s:68:\"Receive Xilancer news, updates,exclusive discounts and early access.\";}','2025-12-30 08:34:22','2025-12-30 08:34:22');
/*!40000 ALTER TABLE `widgets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `withdraw_gateways`
--

DROP TABLE IF EXISTS `withdraw_gateways`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `withdraw_gateways` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `field` longtext NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=active, 2=inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `withdraw_gateways`
--

LOCK TABLES `withdraw_gateways` WRITE;
/*!40000 ALTER TABLE `withdraw_gateways` DISABLE KEYS */;
INSERT INTO `withdraw_gateways` VALUES (1,'Bank','a:3:{i:0;s:9:\"Bank Name\";i:1;s:10:\"Swift Code\";i:2;s:14:\"Account Number\";}',1,'2023-10-16 02:31:37','2023-10-16 04:24:26'),(4,'Paypal','a:4:{i:0;s:12:\"Account Name\";i:1;s:14:\"Account Number\";i:2;s:12:\"Account Type\";i:3;s:10:\"Account Id\";}',1,'2023-10-16 04:17:18','2023-10-16 04:20:51'),(5,'Havale/EFT','a:2:{i:0;s:15:\"İBAN Numarası\";i:1;s:13:\"İsim Soyisim\";}',1,'2026-04-05 16:56:30','2026-04-05 16:56:30');
/*!40000 ALTER TABLE `withdraw_gateways` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `withdraw_requests`
--

DROP TABLE IF EXISTS `withdraw_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `withdraw_requests` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `amount` double NOT NULL,
  `gateway_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=pending, 2=complete, 3=cancel',
  `gateway_fields` longtext NOT NULL,
  `note` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `withdraw_requests`
--

LOCK TABLES `withdraw_requests` WRITE;
/*!40000 ALTER TABLE `withdraw_requests` DISABLE KEYS */;
INSERT INTO `withdraw_requests` VALUES (1,95,5,1236,2,'a:2:{s:16:\"i̇ban_numarası\";s:0:\"\";s:14:\"i̇sim_soyisim\";s:0:\"\";}',NULL,NULL,'2026-04-05 17:02:30','2026-04-05 17:05:46'),(2,95,5,1236,1,'a:2:{s:16:\"i̇ban_numarası\";s:24:\"111111111111111111111111\";s:14:\"i̇sim_soyisim\";s:17:\"ahmet eren şahin\";}',NULL,NULL,'2026-04-14 08:08:25','2026-04-14 08:08:25'),(3,995,5,1,2,'a:2:{s:14:\"iban_numarası\";s:32:\"TR11-1111-1111-1111-1111-1111-11\";s:12:\"isim_soyisim\";s:17:\"Ahmet Eren Şahin\";}',NULL,NULL,'2026-04-25 15:12:29','2026-04-25 15:13:31'),(4,995,5,1,2,'a:2:{s:14:\"iban_numarası\";s:32:\"TR11-1111-1111-1111-1111-1111-11\";s:12:\"isim_soyisim\";s:17:\"Ahmet Eren Şahin\";}',NULL,NULL,'2026-04-25 15:21:38','2026-04-25 15:22:45'),(5,1995,5,1,3,'a:2:{s:14:\"iban_numarası\";s:32:\"TR11-1111-1111-1111-1111-1111-11\";s:12:\"isim_soyisim\";s:17:\"Ahmet Eren Şahin\";}',NULL,NULL,'2026-04-25 15:30:21','2026-04-25 15:32:04');
/*!40000 ALTER TABLE `withdraw_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `words`
--

DROP TABLE IF EXISTS `words`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `words` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `word` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `words`
--

LOCK TABLES `words` WRITE;
/*!40000 ALTER TABLE `words` DISABLE KEYS */;
/*!40000 ALTER TABLE `words` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xg_ftp_infos`
--

DROP TABLE IF EXISTS `xg_ftp_infos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `xg_ftp_infos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `item_version` varchar(255) NOT NULL,
  `item_license_key` varchar(255) NOT NULL,
  `item_license_status` varchar(255) NOT NULL,
  `item_license_msg` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xg_ftp_infos`
--

LOCK TABLES `xg_ftp_infos` WRITE;
/*!40000 ALTER TABLE `xg_ftp_infos` DISABLE KEYS */;
/*!40000 ALTER TABLE `xg_ftp_infos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xg_payment_meta`
--

DROP TABLE IF EXISTS `xg_payment_meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `xg_payment_meta` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `gateway` varchar(255) NOT NULL,
  `amount` double NOT NULL,
  `meta_data` longtext DEFAULT NULL,
  `session_id` text DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `order_id` varchar(255) NOT NULL,
  `track` varchar(255) NOT NULL,
  `status` bigint(20) unsigned NOT NULL DEFAULT 0 COMMENT '0=pending,1=complete,2=cancel',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xg_payment_meta`
--

LOCK TABLES `xg_payment_meta` WRITE;
/*!40000 ALTER TABLE `xg_payment_meta` DISABLE KEYS */;
/*!40000 ALTER TABLE `xg_payment_meta` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-05-10  0:53:49
