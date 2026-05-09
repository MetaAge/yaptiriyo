-- MySQL dump 10.13  Distrib 8.0.42, for Linux (x86_64)
--
-- Host: localhost    Database: xilancer_db
-- ------------------------------------------------------
-- Server version	8.0.42-0ubuntu0.24.10.1

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
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `identity` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unread',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_notifications`
--

LOCK TABLES `admin_notifications` WRITE;
/*!40000 ALTER TABLE `admin_notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_email_verified` tinyint unsigned NOT NULL DEFAULT '0' COMMENT '0: not verified, 1:verified',
  `email_verify_token` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '1:super admin, 2:admin, 3:manager, 4:editor, 5:supporter 6:employee',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0:active, 1:inactive',
  `designation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` bigint unsigned DEFAULT NULL,
  `project_id` bigint unsigned DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'project',
  `status` tinyint(1) NOT NULL DEFAULT '1',
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
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint NOT NULL,
  `admin_id` bigint NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `views` bigint DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0=inactive, 1=active',
  `tag_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `identity` bigint NOT NULL,
  `is_project_job` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `can_contact_freelancers`
--

DROP TABLE IF EXISTS `can_contact_freelancers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `can_contact_freelancers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `can_contact_freelancer` int NOT NULL DEFAULT '0' COMMENT '0:no, 1:yes',
  `show_contact_me_before_login` int NOT NULL DEFAULT '0' COMMENT '0:no, 1:yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `can_contact_freelancers`
--

LOCK TABLES `can_contact_freelancers` WRITE;
/*!40000 ALTER TABLE `can_contact_freelancers` DISABLE KEYS */;
/*!40000 ALTER TABLE `can_contact_freelancers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0=inactive 1=active',
  `selected_category` int DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Design and Creative','This category describes design and creatives','design-and-creative','This category describes design and creatives','This category describes design and creatives',1,NULL,'254','2023-02-06 05:36:19','2025-12-30 06:44:13'),(2,'Website Development','This category describes website development','website-development',NULL,NULL,1,NULL,'256','2023-02-06 05:48:16','2025-12-30 06:43:52'),(3,'Customer Service','This category describes customer service','customer-service',NULL,NULL,1,NULL,'255','2023-02-06 05:48:36','2025-12-30 06:43:34'),(4,'Mobile App Development','This category describes mobile app development','mobile-app-development',NULL,NULL,1,NULL,'257','2023-02-06 05:48:45','2025-12-30 06:43:09'),(5,'Education & Teachings','This category describes Education','education',NULL,NULL,1,NULL,'254','2023-02-06 05:49:25','2025-12-30 06:42:25'),(9,'Research','This category describes research','research',NULL,NULL,1,NULL,'256','2023-02-07 00:27:03','2025-12-30 06:41:04'),(11,'Digital Marketing','This category describes digital marketing','digital-marketing',NULL,NULL,1,NULL,'255','2023-02-07 00:57:08','2025-12-30 06:40:36'),(13,'İnşaat','This category describes writing and translation','writing-and-translation',NULL,NULL,1,NULL,'257','2023-02-07 00:58:39','2026-03-25 17:28:42'),(18,'İş Makineleri','This category describes website design','website-design','This category describes website design','This category describes website design',1,NULL,'254','2023-05-15 23:50:03','2026-03-25 17:28:27');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat_messages`
--

DROP TABLE IF EXISTS `chat_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chat_messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ticket_id` bigint NOT NULL,
  `message` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `notify` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'admin, client, freelancer',
  `sender_id` bigint unsigned DEFAULT NULL COMMENT 'ID of the sender (admin, client, freelancer)',
  `load_from` int NOT NULL DEFAULT '0',
  `is_synced` int NOT NULL DEFAULT '0',
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
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `country_id` int DEFAULT NULL,
  `state_id` int NOT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0=inactive 1=active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cities`
--

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` VALUES (21,15,24,'Bursa',1,'2026-03-25 17:27:49','2026-03-25 17:27:49');
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client_notifications`
--

DROP TABLE IF EXISTS `client_notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `client_notifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `identity` bigint NOT NULL,
  `client_id` bigint NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unread',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client_notifications`
--

LOCK TABLES `client_notifications` WRITE;
/*!40000 ALTER TABLE `client_notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `client_notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `countries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0=inactive 1=active',
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
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0=inactive,1=active',
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
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
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
INSERT INTO `experience_levels` VALUES (1,'Junior',1,'2024-10-10 07:38:07','2024-10-10 07:38:07'),(2,'MidLevel',1,'2024-10-10 07:38:34','2024-10-10 07:38:34'),(3,'Senior',1,'2024-10-10 07:38:47','2024-10-10 07:38:47'),(4,'Not Mandatory',1,'2024-10-10 07:39:08','2024-10-10 07:39:08');
/*!40000 ALTER TABLE `experience_levels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '0=active 1=inactive',
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
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fields` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `success_message` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
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
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `freelancer_level_id` bigint NOT NULL,
  `period` int NOT NULL,
  `avg_rating` double NOT NULL,
  `earning` double NOT NULL,
  `complete_order` int NOT NULL,
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
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0=inactive 1=active',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `identity` bigint NOT NULL,
  `freelancer_id` bigint NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unread',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `freelancer_notifications`
--

LOCK TABLES `freelancer_notifications` WRITE;
/*!40000 ALTER TABLE `freelancer_notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `freelancer_notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `identity_verifications`
--

DROP TABLE IF EXISTS `identity_verifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `identity_verifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `verify_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` bigint NOT NULL,
  `state_id` bigint NOT NULL,
  `city_id` bigint NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `zipcode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `national_id_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `front_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `back_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint DEFAULT NULL COMMENT '1=verified, 2=rejected',
  `is_read` tinyint NOT NULL DEFAULT '0' COMMENT '1=read and 0=unread',
  `load_from` int NOT NULL DEFAULT '0',
  `is_synced` int NOT NULL DEFAULT '0',
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
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `admin_commission_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `job_id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `reject_count` bigint DEFAULT NULL,
  `edit_count` bigint DEFAULT NULL,
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
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `job_post_id` bigint NOT NULL,
  `skill_id` bigint NOT NULL,
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
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `job_post_id` bigint NOT NULL,
  `sub_category_id` bigint NOT NULL,
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
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` bigint NOT NULL,
  `duration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_restriction_type` enum('none','include','exclude') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none',
  `allowed_countries` json DEFAULT NULL,
  `excluded_countries` json DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `hourly_rate` int DEFAULT NULL,
  `estimated_hours` int DEFAULT NULL,
  `budget` double NOT NULL,
  `attachment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '0=pending/inactivate, 1=approve/publish',
  `current_status` tinyint NOT NULL DEFAULT '0' COMMENT '0=nothing, 1=in progress, 2=complete, 3=cancel',
  `on_off` tinyint NOT NULL DEFAULT '1' COMMENT '1=on, 0=off',
  `job_approve_request` tinyint NOT NULL DEFAULT '0' COMMENT '0=request for approve, 1=approve, 2=decline, 2=will change to 0 when the user edit the project.',
  `last_seen` timestamp NULL DEFAULT NULL,
  `last_apply_date` timestamp NULL DEFAULT NULL,
  `meta_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `meta_tags` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `load_from` int NOT NULL DEFAULT '0',
  `is_synced` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `job_posts_category_index` (`category`)
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_posts`
--

LOCK TABLES `job_posts` WRITE;
/*!40000 ALTER TABLE `job_posts` DISABLE KEYS */;
INSERT INTO `job_posts` VALUES (99,1,'土语好姐姐','土语好姐姐',4,'less than a week','midLevel','none',NULL,NULL,'<p>发%hhhjjklllllllllllkkkkkkkkkkkkk_扭扭捏捏那你呢南京</p><p><br></p>','fixed',0,0,2000,'',1,0,1,1,'2025-12-16 19:54:14',NULL,NULL,NULL,NULL,0,0,'2025-10-25 21:57:14','2025-12-16 19:54:14'),(100,1,'Job Restriction Testing','job-restriction-testing',2,'less than a month','MidLevel','include','[\"7\", \"10\"]',NULL,'<p>HireTheBest HireTheBest HireTheBest</p>','hourly',5,5,0,'',1,1,1,1,'2026-01-14 02:22:23',NULL,NULL,NULL,NULL,0,0,'2025-11-02 03:46:38','2026-01-14 02:22:23'),(101,1,'Job Restriction Check2','job-restriction-check2',4,'less than a month','MidLevel','exclude',NULL,'[\"8\"]','HireTheBest HireTheBest HireTheBest HireTheBest','fixed',NULL,NULL,5,'',1,0,1,1,'2026-01-19 05:36:50',NULL,NULL,NULL,NULL,0,0,'2025-11-02 03:49:51','2026-01-19 05:36:50'),(102,1,'Jobtitle','jobtitle',4,'less than a week','senior','none',NULL,NULL,'<b>Imnotbeingabletotypespacebecauseofthepackagerestrictionsthusihopeinfurthertimethiswillberesolve</b>','fixed',0,0,100000,'',0,0,1,1,'2026-01-14 02:22:38',NULL,NULL,NULL,NULL,0,0,'2026-01-04 11:19:36','2026-01-14 02:22:38'),(103,1,'Review Checking2','review-checking2',2,'less than a week','Junior','none',NULL,NULL,'<p>Review Checking2Review Checking2Review Checking2Review Checking2Review Checking2Review Checking2Review Checking2Review Checking2Review Checking2Review Checking2Review Checking2Review Checking2Review Checking2</p>','fixed',NULL,NULL,5,'',0,0,1,1,NULL,NULL,NULL,NULL,NULL,0,0,'2026-01-20 09:10:36','2026-01-20 09:10:36'),(104,1,'abcdef','abcdef',2,'less than 2 month','MidLevel','none',NULL,NULL,'<p>abcdefabcdefabcdefabcdefabcdefabcdefabcdefabcdefabcdefabcdefabcdefabcdefabcdefabcdefabcdefabcdefabcdefabcdefabcdefabcdefabcdefabcdefabcdefabcdefabcdefabcdefabcdefabcdefabcdefabcdefabcdefabcdefabcdefabcdefabcdefabcdefabcdef</p>','fixed',NULL,NULL,5,'',0,0,1,1,NULL,NULL,NULL,NULL,NULL,0,0,'2026-01-20 11:09:05','2026-01-20 11:09:05'),(105,1,'Lets Check Our Featues','lets-check-our-featues',2,'less than 2 month','MidLevel','none',NULL,NULL,'<p>Lets Check Our FeatuesLets Check Our FeatuesLets Check Our FeatuesLets Check Our FeatuesLets Check Our FeatuesLets Check Our FeatuesLets Check Our FeatuesLets Check Our FeatuesLets Check Our FeatuesLets Check Our FeatuesLets Check Our FeatuesLets Check Our FeatuesLets Check Our FeatuesLets Check Our FeatuesLets Check Our FeatuesLets Check Our FeatuesLets Check Our FeatuesLets Check Our FeatuesLets Check Our FeatuesLets Check Our FeatuesLets Check Our FeatuesLets Check Our FeatuesLets Check Our FeatuesLets Check Our Featues</p>','fixed',NULL,NULL,5,'1768911005-696f709d88d98.png',0,0,1,1,'2026-01-20 16:11:01',NULL,NULL,NULL,NULL,0,0,'2026-01-20 11:10:05','2026-01-20 16:11:01'),(106,1,'Need a Professional Logo Designer for a Startup Brand','need-a-professional-logo-designer-for-a-startup-brand',1,'less than a week','Senior','none',NULL,NULL,'<p>Hi,<br><br>I’m looking for an experienced graphic designer to create a modern and professional logo for my startup. The brand is in the tech/digital services niche, so I prefer a clean and minimal design.<br><br>The logo should be:<br><br>Unique and original<br><br>Suitable for website and social media<br><br>Delivered in high-quality formats (PNG, JPG, source file)<br><br>Please share samples of your previous logo work in your proposal.<br><br>Looking forward to working with someone creative and reliable.<br><br>Thank you!</p>','fixed',NULL,NULL,50,'',1,0,1,1,'2026-01-20 17:43:03',NULL,NULL,NULL,NULL,0,0,'2026-01-20 17:41:26','2026-01-20 17:43:03'),(107,1,'hhjghhjjuyyyrrv rvrrrrr','hhjghhjjuyyyrrv-rvrrrrr',1,'1 Days','senior','none',NULL,NULL,'Hhhghyuvyvuuvu u u bubibibibubbh h u u ububuvuvuvuvuvu.. Uvbububu','fixed',0,0,555,'',0,0,1,1,NULL,NULL,NULL,NULL,NULL,0,0,'2026-01-21 13:20:17','2026-01-21 13:20:17'),(108,1,'hhjghhjjuyyyrrv rvrrrrr','hhjghhjjuyyyrrv-rvrrrrr',1,'1 Days','senior','none',NULL,NULL,'Hhhghyuvyvuuvu u u bubibibibubbh h u u ububuvuvuvuvuvu.. Uvbububu','fixed',0,0,555,'',1,0,1,1,NULL,NULL,NULL,NULL,NULL,0,0,'2026-01-21 13:20:40','2026-01-22 08:33:58');
/*!40000 ALTER TABLE `job_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_proposals`
--

DROP TABLE IF EXISTS `job_proposals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_proposals` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `job_id` bigint NOT NULL,
  `freelancer_id` bigint NOT NULL,
  `client_id` bigint NOT NULL,
  `amount` double NOT NULL,
  `currency` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `conversion_rate` double DEFAULT NULL,
  `symbol` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `revision` int NOT NULL DEFAULT '0',
  `cover_letter` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '0=pending, 1=accept, 2=reject',
  `is_hired` tinyint NOT NULL DEFAULT '0' COMMENT '0=no, 1=yes',
  `is_short_listed` tinyint NOT NULL DEFAULT '0' COMMENT '0=no, 1=yes',
  `is_interview_take` tinyint NOT NULL DEFAULT '0' COMMENT '0=no, 1=yes',
  `is_view` tinyint NOT NULL DEFAULT '0' COMMENT '0=no, 1=yes',
  `is_rejected` tinyint NOT NULL DEFAULT '0' COMMENT '0=no, 1=yes',
  `load_from` int NOT NULL DEFAULT '0',
  `is_synced` int NOT NULL DEFAULT '0',
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
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
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
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `direction` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default` int unsigned DEFAULT NULL,
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
INSERT INTO `languages` VALUES (1,'English (UK)','en_GB','ltr','publish',0,'2023-05-07 04:56:35','2026-03-25 17:29:35'),(3,'Беларуская мова','bel','ltr','publish',0,'2026-01-20 09:05:25','2026-01-22 02:36:37'),(4,'العربية','ar','rtl','publish',0,'2026-01-22 02:36:22','2026-01-22 02:44:11'),(5,'Türkçe','tr_TR','ltr','publish',1,'2026-03-25 17:20:12','2026-03-25 17:29:35');
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lengths`
--

DROP TABLE IF EXISTS `lengths`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lengths` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `length` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lengths`
--

LOCK TABLES `lengths` WRITE;
/*!40000 ALTER TABLE `lengths` DISABLE KEYS */;
INSERT INTO `lengths` VALUES (1,'1 Days',1,'2024-10-09 14:09:23','2024-10-09 14:09:23'),(2,'2 Days',1,'2024-10-09 14:09:35','2024-10-09 14:09:35'),(3,'3 Days',1,'2024-10-09 14:09:49','2024-10-09 14:09:49'),(4,'less than a week',1,'2024-10-09 14:10:37','2024-10-09 14:10:37'),(5,'less than a month',1,'2024-10-09 14:11:02','2024-10-09 14:11:02'),(6,'less than 2 month',1,'2024-10-09 14:11:13','2024-10-09 14:11:13'),(7,'less than 3 month',1,'2024-10-09 14:11:25','2024-10-09 14:11:25'),(8,'More than 3 month',1,'2024-10-09 14:11:46','2024-10-09 14:11:46');
/*!40000 ALTER TABLE `lengths` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `live_chat_messages`
--

DROP TABLE IF EXISTS `live_chat_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `live_chat_messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `live_chat_id` bigint unsigned NOT NULL,
  `from_user` int NOT NULL COMMENT '1 = client, 2 = freelancer, 3 = admin',
  `message` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_seen` tinyint NOT NULL DEFAULT '0' COMMENT '0=unseen, 1=seen',
  `load_from` int NOT NULL DEFAULT '0',
  `is_synced` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `live_chat_messages_live_chat_id_foreign` (`live_chat_id`),
  CONSTRAINT `live_chat_messages_live_chat_id_foreign` FOREIGN KEY (`live_chat_id`) REFERENCES `live_chats` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `live_chat_messages`
--

LOCK TABLES `live_chat_messages` WRITE;
/*!40000 ALTER TABLE `live_chat_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `live_chat_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `live_chats`
--

DROP TABLE IF EXISTS `live_chats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `live_chats` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint DEFAULT NULL,
  `freelancer_id` bigint DEFAULT NULL,
  `admin_id` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `live_chats`
--

LOCK TABLES `live_chats` WRITE;
/*!40000 ALTER TABLE `live_chats` DISABLE KEYS */;
/*!40000 ALTER TABLE `live_chats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_activities`
--

DROP TABLE IF EXISTS `log_activities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `log_activities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint DEFAULT NULL,
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
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `size` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `dimensions` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `user_id` bigint DEFAULT NULL,
  `load_from` int NOT NULL DEFAULT '0',
  `is_synced` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=315 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media_uploads`
--

LOCK TABLES `media_uploads` WRITE;
/*!40000 ALTER TABLE `media_uploads` DISABLE KEYS */;
INSERT INTO `media_uploads` VALUES (178,'iyzipay17010664851703661770.svg','iyzipay170106648517036617701742736027.svg',NULL,'','','admin',1,0,0,'2025-03-23 07:20:27','2026-01-21 12:08:19'),(179,'authorize1681276383.png','authorize16812763831742736027.png',NULL,'2.01 KB','60 x 40 pixels','admin',1,0,0,'2025-03-23 07:20:27','2026-01-21 12:08:19'),(180,'pagali1681276333.png','pagali16812763331742736027.png',NULL,'993 ','60 x 40 pixels','admin',1,0,0,'2025-03-23 07:20:27','2026-01-21 12:08:19'),(181,'toybppay1681276253.png','toybppay16812762531742736028.png',NULL,'1014 ','60 x 40 pixels','admin',1,0,0,'2025-03-23 07:20:28','2026-01-21 12:08:19'),(182,'Group 11712748891680684065.png','Group 117127488916806840651742736028.png',NULL,'1.52 KB','60 x 40 pixels','admin',1,0,0,'2025-03-23 07:20:28','2026-01-21 12:08:19'),(183,'Group 11712748981680684100.png','Group 117127489816806841001742736028.png',NULL,'1.36 KB','59 x 40 pixels','admin',1,0,0,'2025-03-23 07:20:28','2026-01-21 12:08:19'),(184,'Group 11712748971680684099.png','Group 117127489716806840991742736028.png',NULL,'1.84 KB','59 x 40 pixels','admin',1,0,0,'2025-03-23 07:20:28','2026-01-21 12:08:19'),(185,'Group 11712748961680684065.png','Group 117127489616806840651742736029.png',NULL,'1.41 KB','60 x 40 pixels','admin',1,0,0,'2025-03-23 07:20:29','2026-01-21 12:08:19'),(186,'Group 11712748911680684065.png','Group 117127489116806840651742736029.png',NULL,'1.38 KB','59 x 40 pixels','admin',1,0,0,'2025-03-23 07:20:29','2026-01-21 12:08:19'),(187,'Group 11712748841680684099.png','Group 117127488416806840991742736029.png',NULL,'907 ','60 x 40 pixels','admin',1,0,0,'2025-03-23 07:20:29','2026-01-21 12:08:19'),(188,'Group 11712748831680684064.png','Group 117127488316806840641742736029.png',NULL,'1.28 KB','60 x 40 pixels','admin',1,0,0,'2025-03-23 07:20:29','2026-01-21 12:08:19'),(189,'Group 11712748871680684064.png','Group 117127488716806840641742736030.png',NULL,'1.32 KB','60 x 40 pixels','admin',1,0,0,'2025-03-23 07:20:30','2026-01-21 12:08:19'),(190,'Group 11712748851680684099.png','Group 117127488516806840991742736030.png',NULL,'1.66 KB','60 x 40 pixels','admin',1,0,0,'2025-03-23 07:20:30','2026-01-21 12:08:19'),(191,'Group 11712748861680684099.png','Group 117127488616806840991742736030.png',NULL,'1.63 KB','60 x 40 pixels','admin',1,0,0,'2025-03-23 07:20:30','2026-01-21 12:08:19'),(192,'Group 11712748771680684126.png','Group 117127487716806841261742736030.png',NULL,'1.06 KB','60 x 40 pixels','admin',1,0,0,'2025-03-23 07:20:30','2026-01-21 12:08:19'),(193,'Group 11712748821680684064.png','Group 117127488216806840641742736031.png',NULL,'1 KB','59 x 40 pixels','admin',1,0,0,'2025-03-23 07:20:31','2026-01-21 12:08:19'),(194,'Group 11712748791680684063.png','Group 117127487916806840631742736031.png',NULL,'1.09 KB','60 x 40 pixels','admin',1,0,0,'2025-03-23 07:20:31','2026-01-21 12:08:19'),(195,'Group 11712748801680684063.png','Group 117127488016806840631742736031.png',NULL,'1.15 KB','60 x 40 pixels','admin',1,0,0,'2025-03-23 07:20:31','2026-01-21 12:08:19'),(196,'Group 11712748781680684016.png','Group 117127487816806840161742736031.png',NULL,'984 ','60 x 40 pixels','admin',1,0,0,'2025-03-23 07:20:31','2026-01-21 12:08:19'),(197,'Group 11712748811680684064.png','Group 117127488116806840641742736032.png',NULL,'810 ','60 x 40 pixels','admin',1,0,0,'2025-03-23 07:20:32','2026-01-21 12:08:19'),(198,'Group 11712748761680683992.png','Group 117127487616806839921742736032.png',NULL,'1.2 KB','60 x 40 pixels','admin',1,0,0,'2025-03-23 07:20:32','2026-01-21 12:08:19'),(199,'Group 11712748921680684065.png','Group 117127489216806840651742736032.png',NULL,'2.74 KB','60 x 40 pixels','admin',1,0,0,'2025-03-23 07:20:32','2026-01-21 12:08:19'),(200,'sitesway1681276405 (1).png','sitesway1681276405 (1)1742736408.png',NULL,'1.41 KB','60 x 40 pixels','admin',1,0,0,'2025-03-23 07:26:48','2026-01-21 12:08:19'),(201,'logoedcaf74517197336801720591252 (1).png','logoedcaf74517197336801720591252 (1)1742736536.png',NULL,'36.65 KB','764 x 193 pixels','admin',1,0,0,'2025-03-23 07:28:56','2026-01-21 12:08:19'),(202,'logo1735215696 (1).png','logo1735215696 (1)1742736577.png',NULL,'3.56 KB','462 x 100 pixels','admin',1,0,0,'2025-03-23 07:29:37','2026-01-21 12:08:19'),(203,'xendit.png','xendit1742737238.png',NULL,'33.81 KB','1266 x 335 pixels','admin',1,0,0,'2025-03-23 07:40:38','2026-01-21 12:08:19'),(204,'03_banner_fav1715593369.png','03_banner_fav17155933691742738309.png',NULL,'510 ','20 x 20 pixels','admin',1,0,0,'2025-03-23 07:58:29','2026-01-21 12:08:19'),(205,'logo1698752007.png','logo16987520071742738309.png',NULL,'2.37 KB','201 x 40 pixels','admin',1,0,0,'2025-03-23 07:58:29','2026-01-21 12:08:19'),(206,'1701326993-656830918f9ea1702360366.png','1701326993-656830918f9ea17023603661742743026.png',NULL,'637.96 KB','1770 x 960 pixels','admin',1,0,0,'2025-03-23 09:17:07','2026-01-21 12:08:19'),(207,'1701347068-65687efc85ab81702360366.png','1701347068-65687efc85ab817023603661742743027.png',NULL,'993.12 KB','1770 x 960 pixels','admin',1,0,0,'2025-03-23 09:17:07','2026-01-21 12:08:19'),(208,'1701597696-656c52009c4821702360295.png','1701597696-656c52009c48217023602951742743027.png',NULL,'164.36 KB','1770 x 960 pixels','admin',1,0,0,'2025-03-23 09:17:08','2026-01-21 12:08:19'),(209,'1699190458-654796bad8a5d1702360364.png','1699190458-654796bad8a5d17023603641742743028.png',NULL,'321.42 KB','1770 x 960 pixels','admin',1,0,0,'2025-03-23 09:17:09','2026-01-21 12:08:19'),(210,'03_banner_light1715594933.png','03_banner_light17155949331742802008.png',NULL,'915 ','24 x 24 pixels','admin',1,0,0,'2025-03-24 01:40:08','2026-01-21 12:08:19'),(211,'03_banner_light1715594933.png','03_banner_light17155949331742802047.png',NULL,'915 ','24 x 24 pixels','admin',1,0,0,'2025-03-24 01:40:47','2026-01-21 12:08:19'),(212,'03_banner11715598594.png','03_banner117155985941742802055.png',NULL,'14.59 KB','196 x 195 pixels','admin',1,0,0,'2025-03-24 01:40:55','2026-01-21 12:08:19'),(213,'03_banner_tallent1715594947.png','03_banner_tallent17155949471742802090.png',NULL,'1.2 KB','24 x 24 pixels','admin',1,0,0,'2025-03-24 01:41:30','2026-01-21 12:08:19'),(214,'03_banner21715598604.png','03_banner217155986041742802129.png',NULL,'10.01 KB','171 x 171 pixels','admin',1,0,0,'2025-03-24 01:42:09','2026-01-21 12:08:19'),(215,'03_banner_shapes1715582691.png','03_banner_shapes17155826911742802159.png',NULL,'3.31 KB','1415 x 522 pixels','admin',1,0,0,'2025-03-24 01:42:39','2026-01-21 12:08:19'),(216,'03_banner_line1715593300.svg','03_banner_line17155933001742802236.svg',NULL,'','','admin',1,0,0,'2025-03-24 01:43:56','2026-01-21 12:08:19'),(217,'choose_thumb_shape1715685375.svg','choose_thumb_shape17156853751742802446.svg',NULL,'','','admin',1,0,0,'2025-03-24 01:47:26','2026-01-21 12:08:19'),(218,'choose_thumb1715685545.png','choose_thumb17156855451742802453.png',NULL,'14.23 KB','404 x 225 pixels','admin',1,0,0,'2025-03-24 01:47:33','2026-01-21 12:08:19'),(219,'work41698488777.svg','work416984887771742802628.svg',NULL,'','','admin',1,0,0,'2025-03-24 01:50:28','2026-01-21 12:08:19'),(220,'work31698488777.svg','work316984887771742802629.svg',NULL,'','','admin',1,0,0,'2025-03-24 01:50:29','2026-01-21 12:08:19'),(221,'work21698488777.svg','work216984887771742802629.svg',NULL,'','','admin',1,0,0,'2025-03-24 01:50:29','2026-01-21 12:08:19'),(222,'work1698488777.svg','work16984887771742802629.svg',NULL,'','','admin',1,0,0,'2025-03-24 01:50:29','2026-01-21 12:08:19'),(223,'Freelancer1717233304.png','Freelancer17172333041742802842.png',NULL,'33.08 KB','240 x 330 pixels','admin',1,0,0,'2025-03-24 01:54:02','2026-01-21 12:08:19'),(224,'Client1717233354.png','Client17172333541742802842.png',NULL,'49.31 KB','240 x 330 pixels','admin',1,0,0,'2025-03-24 01:54:02','2026-01-21 12:08:19'),(225,'appStore21715664155.jpg','appStore217156641551742802842.jpg',NULL,'7.98 KB','136 x 40 pixels','admin',1,0,0,'2025-03-24 01:54:02','2026-01-21 12:08:19'),(226,'appStore11715664155.jpg','appStore117156641551742802842.jpg',NULL,'8.09 KB','122 x 40 pixels','admin',1,0,0,'2025-03-24 01:54:02','2026-01-21 12:08:19'),(227,'appStore-shapes1715664319.svg','appStore-shapes17156643191742802842.svg',NULL,'','','admin',1,0,0,'2025-03-24 01:54:02','2026-01-21 12:08:19'),(228,'white-logo1698752859.png','white-logo16987528591742803247.png',NULL,'2.82 KB','280 x 56 pixels','admin',1,0,0,'2025-03-24 02:00:47','2025-03-24 02:00:47'),(229,'51701088005.png','517010880051742803892.png',NULL,'2.59 KB','47 x 47 pixels','admin',1,0,0,'2025-03-24 02:11:32','2025-03-24 02:11:32'),(230,'41701088005.png','417010880051742803892.png',NULL,'2.68 KB','47 x 47 pixels','admin',1,0,0,'2025-03-24 02:11:32','2025-03-24 02:11:32'),(231,'31701088005.png','317010880051742803893.png',NULL,'2.69 KB','47 x 47 pixels','admin',1,0,0,'2025-03-24 02:11:33','2025-03-24 02:11:33'),(232,'Top1700310589.png','Top17003105891742804273.png',NULL,'427.75 KB','636 x 410 pixels','admin',1,0,0,'2025-03-24 02:17:53','2025-03-24 02:17:53'),(233,'2nd1700310726.png','2nd17003107261742804355.png',NULL,'1.32 MB','1296 x 700 pixels','admin',1,0,0,'2025-03-24 02:19:15','2025-03-24 02:19:15'),(234,'team41701072091.jpg','team417010720911742804431.jpg',NULL,'52.02 KB','306 x 306 pixels','admin',1,0,0,'2025-03-24 02:20:31','2025-03-24 02:20:31'),(235,'team31701072090.jpg','team317010720901742804431.jpg',NULL,'63.07 KB','306 x 306 pixels','admin',1,0,0,'2025-03-24 02:20:31','2025-03-24 02:20:31'),(236,'team21701072091.jpg','team217010720911742804432.jpg',NULL,'62.66 KB','306 x 306 pixels','admin',1,0,0,'2025-03-24 02:20:32','2025-03-24 02:20:32'),(237,'team11701072090.jpg','team117010720901742804432.jpg',NULL,'58.52 KB','306 x 306 pixels','admin',1,0,0,'2025-03-24 02:20:32','2025-03-24 02:20:32'),(238,'41701088005.png','417010880051742805386.png',NULL,'2.68 KB','47 x 47 pixels','admin',1,0,0,'2025-03-24 02:36:26','2025-03-24 02:36:26'),(239,'31704282576.png','317042825761742805386.png',NULL,'4.3 KB','80 x 80 pixels','admin',1,0,0,'2025-03-24 02:36:26','2025-03-24 02:36:26'),(240,'51701088005.png','517010880051742805386.png',NULL,'2.59 KB','47 x 47 pixels','admin',1,0,0,'2025-03-24 02:36:26','2025-03-24 02:36:26'),(241,'41704282576.png','417042825761742805401.png',NULL,'4.59 KB','80 x 80 pixels','admin',1,0,0,'2025-03-24 02:36:41','2025-03-24 02:36:41'),(242,'31704282576.png','317042825761742805417.png',NULL,'4.3 KB','80 x 80 pixels','admin',1,0,0,'2025-03-24 02:36:57','2025-03-24 02:36:57'),(243,'31701088005.png','317010880051742805425.png',NULL,'2.69 KB','47 x 47 pixels','admin',1,0,0,'2025-03-24 02:37:05','2025-03-24 02:37:05'),(244,'41704282576.png','417042825761742805431.png',NULL,'4.59 KB','80 x 80 pixels','admin',1,0,0,'2025-03-24 02:37:11','2025-03-24 02:37:11'),(245,'31701088005.png','317010880051742805445.png',NULL,'2.69 KB','47 x 47 pixels','admin',1,0,0,'2025-03-24 02:37:25','2025-03-24 02:37:25'),(246,'41704282576.png','417042825761742805457.png',NULL,'4.59 KB','80 x 80 pixels','admin',1,0,0,'2025-03-24 02:37:37','2025-03-24 02:37:37'),(247,'31701088005.png','317010880051742805480.png',NULL,'2.69 KB','47 x 47 pixels','admin',1,0,0,'2025-03-24 02:38:00','2025-03-24 02:38:00'),(248,'21704282574.png','217042825741742805480.png',NULL,'3.93 KB','80 x 80 pixels','admin',1,0,0,'2025-03-24 02:38:00','2025-03-24 02:38:00'),(249,'31704282576.png','317042825761742805480.png',NULL,'4.3 KB','80 x 80 pixels','admin',1,0,0,'2025-03-24 02:38:00','2025-03-24 02:38:00'),(250,'41701088005.png','417010880051742805480.png',NULL,'2.68 KB','47 x 47 pixels','admin',1,0,0,'2025-03-24 02:38:00','2025-03-24 02:38:00'),(251,'41704282576.png','417042825761742805480.png',NULL,'4.59 KB','80 x 80 pixels','admin',1,0,0,'2025-03-24 02:38:00','2025-03-24 02:38:00'),(252,'51701088005.png','517010880051742805481.png',NULL,'2.59 KB','47 x 47 pixels','admin',1,0,0,'2025-03-24 02:38:01','2025-03-24 02:38:01'),(253,'51704282577.png','517042825771742805481.png',NULL,'4.18 KB','80 x 80 pixels','admin',1,0,0,'2025-03-24 02:38:01','2025-03-24 02:38:01'),(254,'web.svg','web1766573439.svg',NULL,'','','admin',1,0,0,'2025-12-24 09:50:39','2025-12-24 09:50:39'),(255,'video.svg','video1766573458.svg',NULL,'','','admin',1,0,0,'2025-12-24 09:50:58','2025-12-24 09:50:58'),(256,'marketing.svg','marketing1766573460.svg',NULL,'','','admin',1,0,0,'2025-12-24 09:51:00','2025-12-24 09:51:00'),(257,'app.svg','app1766573462.svg',NULL,'','','admin',1,0,0,'2025-12-24 09:51:02','2025-12-24 09:51:02'),(258,'badge.svg','badge1766573859.svg',NULL,'','','admin',1,0,0,'2025-12-24 09:57:39','2025-12-24 09:57:39'),(259,'wallet.svg','wallet1766573914.svg',NULL,'','','admin',1,0,0,'2025-12-24 09:58:34','2025-12-24 09:58:34'),(260,'lock.svg','lock1766573919.svg',NULL,'','','admin',1,0,0,'2025-12-24 09:58:39','2025-12-24 09:58:39'),(261,'hire_the_best.png','hire_the_best1766573922.png',NULL,'513.15 KB','683 x 513 pixels','admin',1,0,0,'2025-12-24 09:58:42','2025-12-24 09:58:42'),(262,'app-store.svg','app-store1766574115.svg',NULL,'','','admin',1,0,0,'2025-12-24 10:01:55','2025-12-24 10:01:55'),(263,'play-store.svg','play-store1766574119.svg',NULL,'','','admin',1,0,0,'2025-12-24 10:01:59','2025-12-24 10:01:59'),(264,'background.svg','background1766574123.svg',NULL,'','','admin',1,0,0,'2025-12-24 10:02:03','2025-12-24 10:02:03'),(265,'background.png','background1766574124.png',NULL,'20.58 KB','240 x 285 pixels','admin',1,0,0,'2025-12-24 10:02:04','2025-12-24 10:02:04'),(266,'phone.png','phone1766574126.png',NULL,'98.31 KB','252 x 369 pixels','admin',1,0,0,'2025-12-24 10:02:06','2025-12-24 10:02:06'),(267,'1.svg','11766574327.svg',NULL,'','','admin',1,0,0,'2025-12-24 10:05:27','2025-12-24 10:05:27'),(268,'2.svg','21766574329.svg',NULL,'','','admin',1,0,0,'2025-12-24 10:05:29','2025-12-24 10:05:29'),(269,'3.svg','31766574332.svg',NULL,'','','admin',1,0,0,'2025-12-24 10:05:32','2025-12-24 10:05:32'),(270,'4.svg','41766574334.svg',NULL,'','','admin',1,0,0,'2025-12-24 10:05:34','2025-12-24 10:05:34'),(271,'service-1.png','service-11766574534.png',NULL,'189.16 KB','312 x 360 pixels','admin',1,0,0,'2025-12-24 10:08:54','2025-12-24 10:08:54'),(272,'service-2.png','service-21766574536.png',NULL,'207.92 KB','312 x 360 pixels','admin',1,0,0,'2025-12-24 10:08:56','2025-12-24 10:08:56'),(273,'service-3.png','service-31766574538.png',NULL,'182.11 KB','312 x 360 pixels','admin',1,0,0,'2025-12-24 10:08:58','2025-12-24 10:08:58'),(274,'service-4.png','service-41766574541.png',NULL,'204.72 KB','312 x 360 pixels','admin',1,0,0,'2025-12-24 10:09:01','2025-12-24 10:09:01'),(275,'service-2.png','service-21766574623.png',NULL,'207.92 KB','312 x 360 pixels','admin',1,0,0,'2025-12-24 10:10:24','2025-12-24 10:10:24'),(276,'arc-2.svg','arc-21766574845.svg',NULL,'','','admin',1,0,0,'2025-12-24 10:14:05','2025-12-24 10:14:05'),(277,'user-1.png','user-11766574974.png',NULL,'9.66 KB','64 x 64 pixels','admin',1,0,0,'2025-12-24 10:16:14','2025-12-24 10:16:14'),(278,'user-2.png','user-21766574976.png',NULL,'9.69 KB','64 x 64 pixels','admin',1,0,0,'2025-12-24 10:16:16','2026-01-21 12:08:19'),(279,'user-3.png','user-31766574978.png',NULL,'9.34 KB','64 x 64 pixels','admin',1,0,0,'2025-12-24 10:16:18','2026-01-21 12:08:19'),(280,'user-4.png','user-41766574980.png',NULL,'9.09 KB','64 x 64 pixels','admin',1,0,0,'2025-12-24 10:16:20','2026-01-21 12:08:19'),(281,'banner-video.mp4','banner-video1766575019.mp4',NULL,'','','admin',1,0,0,'2025-12-24 10:16:59','2026-01-21 12:08:19'),(282,'back_image.png','back_image1766575332.png',NULL,'13.41 KB','692 x 612 pixels','admin',1,0,0,'2025-12-24 10:22:12','2026-01-21 12:08:19'),(283,'complete.svg','complete1766575334.svg',NULL,'','','admin',1,0,0,'2025-12-24 10:22:14','2026-01-21 12:08:19'),(284,'hired.svg','hired1766575336.svg',NULL,'','','admin',1,0,0,'2025-12-24 10:22:16','2026-01-21 12:08:19'),(285,'home-2-banner-bg.svg','home-2-banner-bg1766575338.svg',NULL,'','','admin',1,0,0,'2025-12-24 10:22:18','2026-01-21 12:08:19'),(286,'top_image.png','top_image1766575341.png',NULL,'536.21 KB','711 x 656 pixels','admin',1,0,0,'2025-12-24 10:22:21','2026-01-21 12:08:19'),(287,'about-us.png','about-us1766576964.png',NULL,'309.53 KB','648 x 364 pixels','admin',1,0,0,'2025-12-24 10:49:24','2026-01-21 12:08:19'),(288,'facebook.svg','facebook1766576965.svg',NULL,'','','admin',1,0,0,'2025-12-24 10:49:25','2026-01-21 12:08:19'),(289,'instagram.svg','instagram1766576967.svg',NULL,'','','admin',1,0,0,'2025-12-24 10:49:27','2026-01-21 12:08:19'),(290,'linkedIn.svg','linkedIn1766576969.svg',NULL,'','','admin',1,0,0,'2025-12-24 10:49:29','2026-01-21 12:08:19'),(291,'man-1.png','man-11766576972.png',NULL,'292.45 KB','446 x 508 pixels','admin',1,0,0,'2025-12-24 10:49:32','2026-01-21 12:08:19'),(292,'man-2.png','man-21766576973.png',NULL,'112.94 KB','269 x 309 pixels','admin',1,0,0,'2025-12-24 10:49:33','2026-01-21 12:08:19'),(293,'man-3.png','man-31766576975.png',NULL,'140.04 KB','312 x 320 pixels','admin',1,0,0,'2025-12-24 10:49:35','2026-01-21 12:08:19'),(294,'man-4.png','man-41766576977.png',NULL,'116.96 KB','253 x 308 pixels','admin',1,0,0,'2025-12-24 10:49:37','2026-01-21 12:08:19'),(295,'our-story.png','our-story1766576979.png',NULL,'526.13 KB','648 x 474 pixels','admin',1,0,0,'2025-12-24 10:49:39','2026-01-21 12:08:19'),(296,'our-values.png','our-values1766576980.png',NULL,'369.33 KB','648 x 474 pixels','admin',1,0,0,'2025-12-24 10:49:41','2026-01-21 12:08:19'),(297,'our-vision.png','our-vision1766576982.png',NULL,'234.32 KB','648 x 474 pixels','admin',1,0,0,'2025-12-24 10:49:42','2026-01-21 12:08:19'),(298,'white-logo.svg','white-logo1766578337.svg',NULL,'','','admin',1,0,0,'2025-12-24 11:12:17','2026-01-21 12:08:19'),(299,'logo.svg','logo1766578358.svg',NULL,'','','admin',1,0,0,'2025-12-24 11:12:38','2026-01-21 12:08:19'),(300,'logo.svg','logo1766578399.svg',NULL,'','','admin',1,0,0,'2025-12-24 11:13:19','2026-01-21 12:08:19'),(301,'favicon.png','favicon1766578422.png',NULL,'718 ','32 x 30 pixels','admin',1,0,0,'2025-12-24 11:13:42','2026-01-21 12:08:19'),(302,'favicon.png','favicon1766578452.png',NULL,'718 ','32 x 30 pixels','admin',1,0,0,'2025-12-24 11:14:12','2026-01-21 12:08:19'),(303,'favicon.png','favicon1766578462.png',NULL,'718 ','32 x 30 pixels','admin',1,0,0,'2025-12-24 11:14:22','2026-01-21 12:08:19'),(304,'background.svg','background1766579614.svg',NULL,'','','admin',1,0,0,'2025-12-24 11:33:34','2026-01-21 12:08:19'),(305,'phone.png','phone1766579622.png',NULL,'98.31 KB','252 x 369 pixels','admin',1,0,0,'2025-12-24 11:33:42','2026-01-21 12:08:19'),(306,'home-2-banner-bg.svg','home-2-banner-bg1766981495.svg',NULL,'','','admin',1,0,0,'2025-12-29 03:11:35','2026-01-21 12:08:19'),(307,'service_1_author.png','service_1_author1766981778.png',NULL,'3.53 KB','36 x 36 pixels','admin',1,0,0,'2025-12-29 03:16:18','2026-01-21 12:08:19'),(308,'service_2_author.png','service_2_author1766981781.png',NULL,'3.46 KB','36 x 36 pixels','admin',1,0,0,'2025-12-29 03:16:21','2026-01-21 12:08:19'),(309,'service_3_author.png','service_3_author1766981783.png',NULL,'3.5 KB','36 x 36 pixels','admin',1,0,0,'2025-12-29 03:16:23','2026-01-21 12:08:19'),(310,'service_4_author.png','service_4_author1766981786.png',NULL,'3.74 KB','36 x 36 pixels','admin',1,0,0,'2025-12-29 03:16:26','2026-01-21 12:08:19'),(311,'service_5_author.png','service_5_author1766981789.png',NULL,'3.83 KB','36 x 36 pixels','admin',1,0,0,'2025-12-29 03:16:29','2026-01-21 12:08:19'),(312,'service_6_author.png','service_6_author1766981791.png',NULL,'3.53 KB','36 x 36 pixels','admin',1,0,0,'2025-12-29 03:16:31','2026-01-21 12:08:19'),(313,'testimonial.svg','testimonial1767771136.svg',NULL,'','','admin',1,0,0,'2026-01-07 06:32:16','2026-01-21 12:08:19'),(314,'white-logo.svg','white-logo1768731908.svg',NULL,'','','admin',1,0,0,'2026-01-18 09:25:08','2026-01-21 12:08:19');
/*!40000 ALTER TABLE `media_uploads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
INSERT INTO `menus` VALUES (1,'Primary Menu','[{\"ptype\":\"custom\",\"id\":2,\"antarget\":\"\",\"icon\":\"\",\"pname\":\"Home\",\"purl\":\"@url\",\"children\":[{\"ptype\":\"pages\",\"id\":3,\"antarget\":\"\",\"icon\":\"\",\"menulabel\":\"\",\"pid\":7},{},{},{},{\"ptype\":\"pages\",\"id\":6,\"antarget\":\"\",\"icon\":\"\",\"menulabel\":\"\",\"pid\":10},{},{},{}]},{\"ptype\":\"custom\",\"id\":9,\"antarget\":\"\",\"icon\":\"\",\"pname\":\"Projects\",\"purl\":\"@url/projects/all\"},{\"ptype\":\"custom\",\"id\":10,\"antarget\":\"\",\"icon\":\"\",\"pname\":\"Jobs\",\"purl\":\"@url/jobs/all\"},{\"ptype\":\"custom\",\"id\":11,\"antarget\":\"\",\"icon\":\"\",\"pname\":\"Talents\",\"purl\":\"@url/talents/all\"},{\"ptype\":\"custom\",\"id\":12,\"antarget\":\"\",\"icon\":\"\",\"pname\":\"Subscriptions\",\"purl\":\"@url/subscriptions/all\"},{\"ptype\":\"custom\",\"id\":13,\"antarget\":\"\",\"icon\":\"\",\"pname\":\"Pages\",\"purl\":\"#\",\"children\":[{},{},{},{},{},{\"ptype\":\"custom\",\"id\":19,\"antarget\":\"\",\"icon\":\"\",\"pname\":\"Blog\",\"purl\":\"@url/blogs/all\"},{},{},{},{},{},{},{},{},{},{},{},{\"ptype\":\"pages\",\"id\":34,\"antarget\":\"\",\"icon\":\"\",\"menulabel\":\"\",\"pid\":8},{\"ptype\":\"pages\",\"pid\":6,\"id\":47},{\"ptype\":\"pages\",\"id\":30,\"antarget\":\"\",\"icon\":\"\",\"menulabel\":\"\",\"pid\":9},{},{},{},{},{},{},{},{},{},{},{},{}]},{\"ptype\":\"pages\",\"id\":42,\"antarget\":\"\",\"icon\":\"\",\"menulabel\":\"\",\"pid\":2}]','default','2022-12-27 04:43:16','2025-12-28 05:52:28'),(2,'Footer Menu',NULL,'','2022-12-27 04:44:55','2023-11-14 05:24:22'),(4,'Social Menu',NULL,NULL,'2022-12-27 05:31:28','2022-12-27 05:31:28'),(5,'Test Menu','[{\"ptype\":\"custom\",\"id\":2,\"antarget\":\"\",\"icon\":\"\",\"pname\":\"Home\",\"purl\":\"@url\"},{\"ptype\":\"pages\",\"pid\":2,\"id\":2}]',NULL,'2022-12-28 01:50:31','2022-12-29 06:32:52');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meta_data`
--

DROP TABLE IF EXISTS `meta_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meta_data` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `meta_taggable_id` bigint unsigned NOT NULL,
  `meta_taggable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_tags` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `facebook_meta_tags` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_meta_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `facebook_meta_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_meta_tags` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_meta_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `twitter_meta_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meta_data`
--

LOCK TABLES `meta_data` WRITE;
/*!40000 ALTER TABLE `meta_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `meta_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=304 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2022_12_06_070148_create_admins_table',1),(6,'2022_12_07_111046_create_static_options_table',2),(7,'2022_12_07_111908_create_media_uploads_table',3),(9,'2022_12_21_081351_create_meta_data_table',4),(10,'2022_12_21_075819_create_pages_table',5),(11,'2022_12_27_102354_create_menus_table',6),(12,'2022_12_29_073650_create_form_builders_table',7),(13,'2023_01_14_111350_create_widgets_table',8),(15,'2014_10_12_000000_create_users_table',9),(16,'2023_01_25_061947_create_countries_table',10),(17,'2023_01_25_062042_create_states_table',10),(18,'2023_01_25_062051_create_cities_table',10),(20,'2023_01_31_111953_create_user_introductions_table',11),(21,'2023_02_01_105814_create_user_experiences_table',12),(22,'2023_02_06_070500_create_user_education_table',13),(26,'2023_02_06_104340_create_categories_table',15),(27,'2023_02_06_104409_create_sub_categories_table',15),(31,'2023_02_08_080702_add_slug_and_image_to_categories_table',16),(32,'2023_02_08_080738_add_slug_and_image_to_sub_categories_table',16),(33,'2023_02_09_031836_create_skills_table',17),(34,'2023_02_12_120227_create_user_works_table',18),(35,'2023_02_13_070232_create_user_skills_table',19),(36,'2023_02_13_110318_add_hourly_rate_to_users_table',20),(38,'2023_02_15_084950_create_identity_verifications_table',21),(41,'2023_02_20_062146_add_status_and_is_read_to_identity_verifications_table',22),(43,'2023_02_22_102326_add_deleted_at_to_users',23),(47,'2023_02_26_072137_create_create_projects_table',25),(48,'2023_02_27_060732_create_create_project_attributes_table',26),(49,'2023_03_05_045336_add_slug_and_status_to_create_projects',27),(51,'2023_03_13_091210_create_portfolios_table',28),(52,'2023_03_19_061043_add_timezone_to_states',29),(53,'2023_03_19_091240_add_check_online_status_to_users',30),(55,'2023_03_19_101455_add_check_work_availability_to_users',31),(56,'2023_03_22_065938_add_google_2fa_secret_to_users',32),(57,'2023_03_22_085506_add_google_2fa_enable_disable_disable_to_users',33),(58,'2023_03_28_090737_create_project_histories_table',34),(61,'2023_03_29_034510_add_project_approve_request_to_create_projects',35),(62,'2023_04_02_045528_create_admin_notifications_table',36),(63,'2023_04_03_083057_create_create_project_sub_categories_table',37),(64,'2023_04_04_063804_add_category_id_to_create_projects',38),(65,'2023_04_06_022811_create_wallets_table',39),(66,'2023_04_06_022826_create_wallet_histories_table',39),(76,'2023_04_29_070422_create_subscription_types_table',43),(77,'2023_04_29_071804_create_subscription_features_table',43),(78,'2023_04_29_072511_create_subscriptions_table',43),(79,'2023_05_02_123118_create_page_builders_table',44),(80,'2023_05_07_070709_create_languages_table',45),(81,'2023_05_15_052137_add_short_description_to_categories',46),(82,'2023_05_15_060433_add_short_description_to_sub_categories',47),(83,'2023_05_17_072955_add_level_to_users',48),(85,'2023_05_30_105849_add_last_apply_date_and_last_seen_to_jobs_table',49),(86,'2023_06_01_063633_create_job_histories_table',50),(88,'2023_06_07_044153_change_is_read_column_name',51),(89,'2023_06_08_034931_rename_subscription_connet_to_limit',52),(91,'2023_06_13_044928_add_validatity_to_subscription_types',53),(96,'2023_06_17_054259_create_user_subscriptions_table',54),(107,'2023_07_10_043726_create_user_earnings_table',55),(108,'2023_07_10_075003_create_individual_commission_settings_table',55),(145,'2023_07_09_042039_create_orders_table',56),(147,'2023_07_26_115750_create_order_decline_histories_table',56),(148,'2023_07_26_120317_create_order_decline_wallet_histories_table',56),(169,'2023_07_30_063825_create_user_notifications_table',57),(170,'2023_07_30_070915_create_order_submit_histories_table',57),(171,'2023_08_01_103629_create_order_request_revisions_table',57),(174,'2023_08_08_054420_add_revision_left_to_orders_table',58),(181,'2023_08_10_043412_create_ratings_table',59),(182,'2023_08_10_045939_create_rating_details_table',59),(183,'2023_08_21_101229_add_status_before_hold_to_orders_table',60),(184,'2023_08_21_101822_add_is_suspend_to_users_table',60),(185,'2023_08_27_055736_create_departments_table',61),(186,'2023_08_27_060148_create_tickets_table',61),(187,'2023_08_27_060349_create_chat_messages_table',61),(192,'2023_05_23_165755_create_live_chats_table',62),(193,'2023_05_23_165849_create_live_chat_messages_table',62),(195,'2023_09_11_094021_create_job_posts_table',63),(197,'2023_09_11_111935_create_job_post_sub_categories_table',64),(198,'2023_04_17_052446_create_job_skills_table',65),(199,'2023_09_11_115123_create_job_post_skills_table',66),(204,'2023_09_12_112426_create_job_proposals_table',67),(211,'2023_08_02_074726_create_freelancer_notifications_table',69),(212,'2023_08_03_115328_create_client_notifications_table',69),(213,'2023_10_01_051409_add_revision_to_job_proposals',70),(214,'2023_09_24_072604_create_offers_table',71),(215,'2023_09_24_072659_create_offer_milestones_table',71),(216,'2023_07_13_093714_create_order_milestones_table',72),(217,'2023_10_04_125750_add_current_status_to_job_posts',73),(218,'2023_10_15_073144_add_remaining_balance_and_withdraw_amount_to_wallets',74),(220,'2023_10_15_130310_create_withdraw_gateways_table',75),(222,'2023_10_16_122611_create_withdraw_requests_table',76),(223,'2023_10_19_092727_create_permission_tables',77),(224,'2023_10_19_095329_add_menu_name_to_permissions',77),(225,'2020_02_04_010636_create_newsletters_table',78),(230,'2023_10_29_115154_create_question_answers_table',79),(232,'2023_10_30_082828_create_feedback_table',80),(233,'2023_11_09_052611_create_bookmarks_table',81),(234,'2023_11_13_090531_create_reports_table',82),(235,'2023_12_04_093048_create_xg_ftp_infos_table',83),(236,'2023_12_11_062442_create_blog_posts_table',83),(237,'2023_12_23_081053_create_freelancer_levels_table',84),(238,'2023_12_23_081216_create_freelancer_level_rules_table',84),(239,'2024_01_14_091704_add_reject_reason_to_project_histories_table',85),(240,'2024_01_31_071706_add_offer_package_available_or_not_to_projects_table',86),(241,'2024_02_14_060336_add_is_pro_and_pro_expire_date_to_projects_table',87),(242,'2024_02_15_120132_add_is_valid_payment_to_orders_table',87),(243,'2024_02_18_072401_add_note_to_reports_table',87),(244,'2024_02_18_150813_create_news_letter_for_emails_table',87),(245,'2024_03_05_123836_add_email_verify_token_to_admins',88),(246,'2024_03_06_065635_add_firebase_device_token_to_users',88),(247,'2024_04_21_131737_create_jobs_table',89),(248,'2024_01_29_053338_create_project_promote_settings_table',90),(249,'2024_02_08_063522_create_promotion_project_lists_table',90),(250,'2024_02_14_075240_add_is_valid_payment_promotion_project_lists__table',90),(251,'2024_05_01_053357_add_apple_id_to_users_table',90),(252,'2024_05_05_100714_add_is_pro_to_users_table',90),(253,'2024_05_16_095256_create_words_table',91),(254,'2024_05_19_051405_add_freeze_withdraw_and_freeze_project_freeze_job_freeze_order_freeze_chat_to_users',91),(255,'2024_05_20_093916_create_log_activities_table',91),(256,'2024_06_11_053715_add_meta_title_and_meta_description_to_categories',92),(257,'2024_06_11_054044_add_meta_title_and_meta_description_to_sub_categories',92),(258,'2024_06_25_052118_add_meta_title_and_meta_description_and_meta_tags_to_projects',93),(259,'2024_06_25_053121_add_meta_title_and_meta_description_and_meta_tags_to_job_posts',93),(260,'2024_07_03_082447_add_load_from_and_is_synced_to_media_uploads',93),(261,'2024_07_06_050745_add_load_from_and_is_synced_to_projects',93),(262,'2024_07_07_103341_add_load_from_and_is_synced_to_job_posts',93),(263,'2024_07_07_135455_add_load_from_and_is_synced_to_job_proposals',93),(264,'2024_07_08_091056_add_load_from_and_is_synced_to_portfolios',93),(265,'2024_07_08_113034_add_load_from_and_is_synced_to_users',93),(266,'2024_07_09_061732_add_load_from_and_is_synced_to_chat_messages',93),(267,'2024_07_11_103143_add_load_from_and_is_synced_to_identity_verifications',93),(268,'2024_04_26_034953_create_payment_meta_data_table',94),(269,'2024_08_01_035813_add_hourly_rate_and_estimated_hours_to_job_posts',94),(270,'2024_08_13_054216_add_email_send_to_wallet_histories',94),(271,'2024_08_13_063128_add_email_send_to_orders',94),(272,'2024_08_13_063226_add_email_send_to_user_subscriptions',94),(273,'2024_08_13_063805_add_email_send_to_promotion_project_lists',94),(274,'2024_08_18_080543_create_order_work_histories_table',94),(275,'2024_08_27_100524_add_selected_category_to_categories',94),(276,'2024_08_28_122807_create_order_screenshots_table',94),(277,'2024_08_29_115158_add_load_from_and_is_synced_to_live_chat_messages',94),(278,'2024_09_11_043432_change_admins_table_role_default_value',95),(279,'2024_09_18_062831_create_lengths_table',96),(280,'2024_09_18_080536_create_experience_levels_table',96),(281,'2024_09_22_064433_add_order_type_to_orders',96),(282,'2024_11_28_060639_create_question_tips_table',97),(283,'2024_12_01_123713_create_question_tip_answers_table',97),(284,'2024_12_04_044850_create_question_tip_reactions_table',97),(285,'2024_12_04_110833_create_question_tip_answer_reactions_table',97),(286,'2024_12_08_110120_create_question_tip_answer_replies_table',97),(287,'2025_02_17_113008_add_currency_and_conversion_rate_to_orders',98),(288,'2025_02_20_125546_add_currency_and_conversion_rate_to_job_proposals',98),(289,'2025_02_24_121003_add_currency_and_conversion_rate_to_wallet_histories',98),(290,'2025_02_26_112850_add_currency_symbol_position_to_selected_currency_lists',98),(291,'2025_05_05_092633_create_can_contact_freelancers_table',98),(292,'2025_07_19_172820_add_is_free_to_subscription_types_table',98),(293,'2025_08_25_060900_add_type_to_wallet_histories_table',98),(294,'2025_08_31_045533_add_fee_columns_to_wallet_histories_table',98),(295,'2025_09_01_031118_add_commission_fields_to_subscriptions_table',98),(296,'2025_09_01_045650_make_admin_commission_nullable_in_individual_commission_settings_table',98),(297,'2025_09_02_110547_add_extra_price_and_is_paid_to_project_attributes_table',98),(298,'2025_09_08_051449_add_invoice_no_to_orders_table',98),(299,'2025_09_18_184451_add_sender_id_to_chat_messages_table',99),(300,'2025_09_24_064509_add_country_restriction_fields_to_job_posts',99),(301,'2025_09_25_052541_alter_description_in_user_introductions_table',99),(302,'2025_10_12_095344_add_show_earning_to_user_earnings_table',100),(303,'2025_12_30_080316_create_banners_table',101);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
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
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
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
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `offer_id` bigint NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `deadline` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '0=pending, 1=active, 2=complete, 3=cancel',
  `revision` int NOT NULL DEFAULT '0',
  `revision_left` int NOT NULL DEFAULT '0',
  `attachment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `freelancer_id` bigint NOT NULL,
  `client_id` bigint NOT NULL,
  `price` double NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `deadline` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '0=pending, 1=active, 2=reject',
  `revision` int NOT NULL DEFAULT '0',
  `revision_left` int NOT NULL DEFAULT '0',
  `attachment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offers`
--

LOCK TABLES `offers` WRITE;
/*!40000 ALTER TABLE `offers` DISABLE KEYS */;
/*!40000 ALTER TABLE `offers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_decline_histories`
--

DROP TABLE IF EXISTS `order_decline_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_decline_histories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint NOT NULL,
  `freelancer_id` bigint NOT NULL,
  `client_id` bigint NOT NULL,
  `order_price` double NOT NULL,
  `payment_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cancel_or_decline` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancel_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_decline_histories`
--

LOCK TABLES `order_decline_histories` WRITE;
/*!40000 ALTER TABLE `order_decline_histories` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_decline_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_decline_wallet_histories`
--

DROP TABLE IF EXISTS `order_decline_wallet_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_decline_wallet_histories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint NOT NULL,
  `freelancer_id` bigint NOT NULL,
  `client_id` bigint NOT NULL,
  `order_price` double NOT NULL,
  `payment_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cancel_or_decline` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancel_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_decline_wallet_histories`
--

LOCK TABLES `order_decline_wallet_histories` WRITE;
/*!40000 ALTER TABLE `order_decline_wallet_histories` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_decline_wallet_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_milestones`
--

DROP TABLE IF EXISTS `order_milestones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_milestones` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `deadline` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '0=pending, 1=active, 2=complete, 3=cancel',
  `revision` int NOT NULL DEFAULT '0',
  `revision_left` int NOT NULL DEFAULT '0',
  `attachment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint NOT NULL,
  `order_submit_history_id` bigint DEFAULT NULL,
  `milestone_id` int DEFAULT NULL,
  `description` blob,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_request_revisions`
--

LOCK TABLES `order_request_revisions` WRITE;
/*!40000 ALTER TABLE `order_request_revisions` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_request_revisions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_screenshots`
--

DROP TABLE IF EXISTS `order_screenshots`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_screenshots` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint NOT NULL,
  `order_milestone_id` bigint DEFAULT NULL,
  `attachment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '0=pending, 1=approve, 2=request revision,',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_submit_histories`
--

LOCK TABLES `order_submit_histories` WRITE;
/*!40000 ALTER TABLE `order_submit_histories` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_submit_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_work_histories`
--

DROP TABLE IF EXISTS `order_work_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_work_histories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `client_id` int NOT NULL,
  `freelancer_id` int NOT NULL,
  `job_id` int DEFAULT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `only_start_date` date DEFAULT NULL,
  `only_end_date` date DEFAULT NULL,
  `hours_worked` time NOT NULL,
  `seconds` int DEFAULT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
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
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint NOT NULL COMMENT 'client id',
  `freelancer_id` bigint NOT NULL,
  `order_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identity` bigint NOT NULL COMMENT 'project_id or job_id',
  `is_project_job` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'project or job',
  `is_basic_standard_premium_custom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'project type',
  `is_fixed_hourly` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'fixed or hourly',
  `is_custom` tinyint NOT NULL DEFAULT '0' COMMENT '1=custom',
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '0=pending, 1=active, 2=delivered, 3=complete, 4=cancel, 5=decline by frl, 6=suspend by ad, 7=hold by ad',
  `email_send` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_before_hold` tinyint NOT NULL DEFAULT '0' COMMENT '0=not hold , 1=hold',
  `revision` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revision_left` int NOT NULL DEFAULT '0',
  `delivery_time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `price` double NOT NULL,
  `currency` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `conversion_rate` double DEFAULT NULL,
  `symbol` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commission_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `commission_charge` double NOT NULL,
  `commission_amount` double NOT NULL DEFAULT '0',
  `transaction_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_charge` double NOT NULL DEFAULT '0',
  `transaction_amount` double NOT NULL DEFAULT '0',
  `payable_amount` double NOT NULL DEFAULT '0',
  `refund_amount` double NOT NULL DEFAULT '0',
  `refund_status` tinyint NOT NULL DEFAULT '0' COMMENT '0=pending, 1=paid',
  `total_hour` double DEFAULT NULL,
  `payment_gateway` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_valid_payment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manual_payment_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_invoice_no_unique` (`invoice_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page_builders`
--

DROP TABLE IF EXISTS `page_builders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `page_builders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `addon_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addon_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addon_namespace` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addon_location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addon_order` bigint unsigned DEFAULT NULL,
  `addon_page_id` bigint unsigned DEFAULT NULL,
  `addon_page_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addon_settings` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
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
INSERT INTO `page_builders` VALUES (3,'HeaderStyleOne','update','plugins\\PageBuilder\\Addons\\Header\\HeaderStyleOne','dynamic_page',1,7,'dynamic_page','a:30:{s:2:\"id\";s:1:\"3\";s:10:\"addon_name\";s:14:\"HeaderStyleOne\";s:15:\"addon_namespace\";s:64:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcSGVhZGVyXEhlYWRlclN0eWxlT25l\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"1\";s:13:\"addon_page_id\";s:1:\"7\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:38:\"Connecting Ideas with the Right Talent\";s:8:\"subtitle\";s:166:\"We make it\'s easier for talents and businesses to connect and \r\nwe make it absolutely less charges. Hire Talents or Get Hired from our platform and work independently\";s:21:\"find_work_button_text\";s:9:\"Find Work\";s:21:\"find_work_button_link\";s:8:\"jobs/all\";s:24:\"find_project_button_text\";s:11:\"Find Talent\";s:24:\"find_project_button_link\";s:11:\"talents/all\";s:27:\"top_freelancer_of_the_month\";N;s:19:\"show_top_freelancer\";s:3:\"off\";s:18:\"search_placeholder\";s:36:\"Search By Services , Jobs or Talents\";s:10:\"skill_tags\";a:2:{s:9:\"tag_name_\";a:4:{i:0;s:19:\"Design & Creativity\";i:1;s:19:\"Website Development\";i:2;s:22:\"Mobile App Development\";i:3;s:23:\"Writing and Translation\";}s:9:\"tag_link_\";a:4:{i:0;s:30:\"categories/design-and-creative\";i:1;s:30:\"categories/website-development\";i:2;s:33:\"categories/mobile-app-development\";i:3;s:34:\"categories/writing-and-translation\";}}s:18:\"info_card_one_text\";s:16:\"Complete Project\";s:18:\"info_card_one_icon\";s:3:\"283\";s:18:\"info_card_two_text\";s:17:\"Hired 41+ Talents\";s:18:\"info_card_two_icon\";s:3:\"284\";s:12:\"slider_image\";s:3:\"286\";s:15:\"shape_image_one\";s:3:\"282\";s:15:\"shape_image_two\";s:3:\"124\";s:16:\"background_image\";N;s:11:\"padding_top\";s:2:\"64\";s:14:\"padding_bottom\";s:2:\"59\";s:10:\"section_bg\";N;s:10:\"trusted_by\";a:1:{s:5:\"logo_\";a:1:{i:0;N;}}}','2023-10-26 00:25:40','2026-01-20 06:02:42'),(5,'PopularJobOne','update','plugins\\PageBuilder\\Addons\\Job\\PopularJobOne','dynamic_page',4,7,'dynamic_page','a:15:{s:2:\"id\";s:1:\"5\";s:10:\"addon_name\";s:13:\"PopularJobOne\";s:15:\"addon_namespace\";s:60:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcSm9iXFBvcHVsYXJKb2JPbmU=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"4\";s:13:\"addon_page_id\";s:1:\"7\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:11:\"Latest Jobs\";s:5:\"items\";s:2:\"10\";s:8:\"order_by\";s:6:\"latest\";s:11:\"layout_type\";s:4:\"grid\";s:11:\"padding_top\";s:2:\"61\";s:14:\"padding_bottom\";s:2:\"60\";s:10:\"section_bg\";N;}','2023-10-26 01:09:17','2025-12-29 03:28:32'),(6,'TestimonialOne','update','plugins\\PageBuilder\\Addons\\Testimonial\\TestimonialOne','dynamic_page',6,7,'dynamic_page','a:16:{s:2:\"id\";s:1:\"6\";s:10:\"addon_name\";s:14:\"TestimonialOne\";s:15:\"addon_namespace\";s:72:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcVGVzdGltb25pYWxcVGVzdGltb25pYWxPbmU=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"6\";s:13:\"addon_page_id\";s:1:\"7\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:38:\"What Freelancers are Thinking About Us\";s:18:\"slider_button_text\";N;s:5:\"items\";s:1:\"6\";s:8:\"order_by\";s:6:\"latest\";s:11:\"padding_top\";s:3:\"100\";s:14:\"padding_bottom\";s:3:\"100\";s:10:\"section_bg\";N;s:16:\"background_image\";s:3:\"313\";}','2023-10-26 01:22:31','2026-01-19 06:01:36'),(12,'ContactMessage','update','plugins\\PageBuilder\\Addons\\Contact\\ContactMessage','dynamic_page',1,2,'dynamic_page','a:14:{s:2:\"id\";s:2:\"12\";s:10:\"addon_name\";s:14:\"ContactMessage\";s:15:\"addon_namespace\";s:68:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcQ29udGFjdFxDb250YWN0TWVzc2FnZQ==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"1\";s:13:\"addon_page_id\";s:1:\"2\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:7:\"heading\";s:10:\"Contact Us\";s:16:\"contact_form_des\";s:90:\"Feel free to contact with us if you have any query or face any issues to use this website.\";s:12:\"contact_info\";a:3:{s:5:\"icon_\";a:4:{i:0;s:21:\"fas fa-map-marker-alt\";i:1;s:12:\"fas fa-phone\";i:2;s:15:\"fas fa-envelope\";i:3;s:12:\"fas fa-clock\";}s:6:\"title_\";a:4:{i:0;s:7:\"Address\";i:1;s:12:\"Phone Number\";i:2;s:13:\"Email Address\";i:3;s:14:\"Business Hours\";}s:12:\"description_\";a:4:{i:0;s:34:\"8502 Preston Wood, Oregon Michigan\";i:1;s:12:\"(629)5550129\";i:2;s:24:\"bill.senders@example.com\";i:3;s:26:\"(GMT +6) 10:00am - 07:00pm\";}}s:11:\"padding_top\";s:3:\"191\";s:14:\"padding_bottom\";s:3:\"190\";s:14:\"custom_form_id\";s:1:\"1\";}','2023-10-30 19:18:39','2025-12-30 06:29:45'),(13,'AboutUs','update','plugins\\PageBuilder\\Addons\\About\\AboutUs','dynamic_page',1,8,'dynamic_page','a:15:{s:2:\"id\";s:2:\"13\";s:10:\"addon_name\";s:7:\"AboutUs\";s:15:\"addon_namespace\";s:56:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcQWJvdXRcQWJvdXRVcw==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"1\";s:13:\"addon_page_id\";s:1:\"8\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:13:\"section_title\";s:44:\"Redefining Freelance Collaboration Worldwide\";s:11:\"description\";s:697:\"<p style=\"text-align: left; line-height: 1.6;\"><span style=\"font-weight: 400; font-size: 14px;\">Welcome to Xilancer, where dynamic connections between talented freelancers and visionary clients. Our platform is a vibrant marketplace designed to elevate the way innovators and clients collaborate, innovate, and succeed.</span></p><p style=\"text-align: left; line-height: 1.6;\"><span style=\"font-size: 14px;\">\r\n</span></p><p style=\"text-align: left; line-height: 1.6;\"><span style=\"font-size: 14px;\">At Xilancer, we envision a world where every project, big or small, finds its perfect match. We\'re here to break down barriers, empower creativity, and redefine the future of work.</span></p><p></p>\";s:11:\"creditility\";a:2:{s:6:\"title_\";a:1:{i:0;N;}s:12:\"description_\";a:1:{i:0;N;}}s:5:\"image\";s:3:\"287\";s:11:\"padding_top\";s:3:\"100\";s:14:\"padding_bottom\";s:3:\"100\";s:10:\"section_bg\";s:18:\"rgb(245, 245, 245)\";}','2023-11-18 00:30:12','2025-12-29 04:21:51'),(14,'WhatWeDo','update','plugins\\PageBuilder\\Addons\\About\\WhatWeDo','dynamic_page',3,8,'dynamic_page','a:16:{s:2:\"id\";s:2:\"14\";s:10:\"addon_name\";s:8:\"WhatWeDo\";s:15:\"addon_namespace\";s:56:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcQWJvdXRcV2hhdFdlRG8=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"3\";s:13:\"addon_page_id\";s:1:\"8\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:13:\"section_title\";s:11:\"What we do?\";s:8:\"subtitle\";N;s:5:\"image\";s:3:\"297\";s:10:\"video_file\";s:3:\"281\";s:5:\"stats\";a:2:{s:6:\"title_\";a:4:{i:0;s:3:\"49k\";i:1;s:4:\"$50M\";i:2;s:4:\"10k+\";i:3;s:4:\"100k\";}s:12:\"description_\";a:4:{i:0;s:31:\"Jobs we have handle in Xilancer\";i:1;s:36:\"Earned by Freelancer in Our Platform\";i:2;s:25:\"Find job by this platform\";i:3;s:19:\"Trusted Freelancers\";}}s:11:\"padding_top\";s:3:\"100\";s:14:\"padding_bottom\";s:2:\"50\";s:10:\"section_bg\";s:18:\"rgb(255, 255, 255)\";}','2023-11-18 00:32:13','2025-12-29 04:40:04'),(17,'Team','update','plugins\\PageBuilder\\Addons\\About\\Team','dynamic_page',4,8,'dynamic_page','a:14:{s:2:\"id\";s:2:\"17\";s:10:\"addon_name\";s:4:\"Team\";s:15:\"addon_namespace\";s:52:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcQWJvdXRcVGVhbQ==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"4\";s:13:\"addon_page_id\";s:1:\"8\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:13:\"section_title\";s:26:\"Meet our  hardworking team\";s:8:\"subtitle\";N;s:11:\"padding_top\";s:3:\"100\";s:14:\"padding_bottom\";s:3:\"100\";s:10:\"section_bg\";N;s:4:\"team\";a:3:{s:6:\"image_\";a:5:{i:0;s:3:\"237\";i:1;s:3:\"236\";i:2;s:3:\"235\";i:3;s:3:\"234\";i:4;s:3:\"234\";}s:5:\"name_\";a:5:{i:0;s:13:\"Md Siam Ahmed\";i:1;s:15:\"Mohammad Shahin\";i:2;s:12:\"Nazmul Hoque\";i:3;s:16:\"Md Riyad Hossain\";i:4;s:14:\"Md Zahid Hasan\";}s:12:\"designation_\";a:5:{i:0;s:17:\"Webflow Developer\";i:1;s:12:\"Web Designer\";i:2;s:9:\"Developer\";i:3;s:14:\"Html Developer\";i:4;s:9:\"Developer\";}}}','2023-11-18 01:11:45','2025-03-24 02:21:04'),(18,'PopularProjectOne','update','plugins\\PageBuilder\\Addons\\Project\\PopularProjectOne','dynamic_page',3,7,'dynamic_page','a:17:{s:2:\"id\";s:2:\"18\";s:10:\"addon_name\";s:17:\"PopularProjectOne\";s:15:\"addon_namespace\";s:72:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcUHJvamVjdFxQb3B1bGFyUHJvamVjdE9uZQ==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"3\";s:13:\"addon_page_id\";s:1:\"7\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:16:\"Popular Services\";s:5:\"items\";s:1:\"6\";s:9:\"pro_count\";N;s:8:\"order_by\";s:6:\"latest\";s:11:\"layout_type\";s:6:\"slider\";s:13:\"category_tags\";a:2:{s:9:\"tag_text_\";a:1:{i:0;s:21:\"Browse All categories\";}s:8:\"tag_url_\";a:1:{i:0;s:13:\"/projects/all\";}}s:11:\"padding_top\";s:2:\"50\";s:14:\"padding_bottom\";s:2:\"50\";s:10:\"section_bg\";N;}','2023-11-25 05:15:02','2026-01-21 06:37:13'),(19,'Credit','update','plugins\\PageBuilder\\Addons\\About\\Credit','dynamic_page',3,8,'dynamic_page','a:12:{s:2:\"id\";s:2:\"19\";s:10:\"addon_name\";s:6:\"Credit\";s:15:\"addon_namespace\";s:52:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcQWJvdXRcQ3JlZGl0\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"3\";s:13:\"addon_page_id\";s:1:\"8\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:6:\"credit\";a:2:{s:6:\"title_\";a:3:{i:0;s:3:\"49K\";i:1;s:4:\"$50M\";i:2;s:3:\"09X\";}s:12:\"description_\";a:3:{i:0;s:45:\"Jobs we have handled in our Xilancer platform\";i:1;s:47:\"Earned by Freelancers in our platform till date\";i:2;s:47:\"Awards received in IT for excellence in service\";}}s:11:\"padding_top\";s:2:\"50\";s:14:\"padding_bottom\";s:3:\"100\";s:10:\"section_bg\";N;}','2023-11-27 04:32:01','2024-02-19 08:44:17'),(22,'HeaderStyleTwo','update','plugins\\PageBuilder\\Addons\\Header\\HeaderStyleTwo','dynamic_page',1,10,'dynamic_page','a:19:{s:2:\"id\";s:2:\"22\";s:10:\"addon_name\";s:14:\"HeaderStyleTwo\";s:15:\"addon_namespace\";s:64:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcSGVhZGVyXEhlYWRlclN0eWxlVHdv\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"1\";s:13:\"addon_page_id\";s:2:\"10\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:31:\"Lead Change, \r\nMarket Needs You\";s:11:\"description\";s:97:\"We make it\'s easier for talents and businesses to connect and we make it absolutely less charges.\";s:18:\"search_placeholder\";s:36:\"Search By Services , Jobs or Talents\";s:15:\"user_count_text\";s:23:\"10k+ job holder get job\";s:11:\"user_images\";a:1:{s:11:\"user_image_\";a:4:{i:0;s:3:\"307\";i:1;s:3:\"308\";i:2;s:3:\"309\";i:3;s:3:\"310\";}}s:10:\"video_file\";s:3:\"281\";s:16:\"background_shape\";s:3:\"306\";s:11:\"search_tags\";a:2:{s:9:\"tag_text_\";a:3:{i:0;s:17:\"Design & Creative\";i:1;s:19:\"Website Development\";i:2;s:22:\"Mobile App Development\";}s:9:\"tag_link_\";a:3:{i:0;s:31:\"/categories/design-and-creative\";i:1;s:31:\"/categories/website-development\";i:2;s:34:\"/categories/mobile-app-development\";}}s:10:\"section_bg\";N;s:11:\"padding_top\";s:3:\"154\";s:14:\"padding_bottom\";s:3:\"145\";}','2024-06-03 14:31:10','2026-01-20 06:03:02'),(46,'ProjectPromotion','new','Modules\\SecurityManage\\Http\\PageBuilder\\Promotion\\ProjectPromotion','dynamic_page',11,10,'dynamic_page','a:12:{s:10:\"addon_name\";s:16:\"ProjectPromotion\";s:15:\"addon_namespace\";s:88:\"TW9kdWxlc1xTZWN1cml0eU1hbmFnZVxIdHRwXFBhZ2VCdWlsZGVyXFByb21vdGlvblxQcm9qZWN0UHJvbW90aW9u\";s:10:\"addon_type\";s:3:\"new\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:2:\"11\";s:13:\"addon_page_id\";s:2:\"10\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:17:\"Promoted Projects\";s:5:\"items\";s:1:\"6\";s:11:\"padding_top\";s:2:\"45\";s:14:\"padding_bottom\";s:2:\"42\";s:10:\"section_bg\";N;}','2024-07-29 15:15:25','2024-07-29 15:15:25'),(49,'CategoryJobOne','update','plugins\\PageBuilder\\Addons\\Category\\CategoryJobOne','dynamic_page',2,10,'dynamic_page','a:15:{s:2:\"id\";s:2:\"49\";s:10:\"addon_name\";s:14:\"CategoryJobOne\";s:15:\"addon_namespace\";s:68:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcQ2F0ZWdvcnlcQ2F0ZWdvcnlKb2JPbmU=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"2\";s:13:\"addon_page_id\";s:2:\"10\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:18:\"Popular Categories\";s:18:\"browse_button_text\";s:21:\"Browse all categories\";s:18:\"browse_button_link\";s:10:\"categories\";s:20:\"category_custom_data\";a:3:{s:12:\"category_id_\";a:4:{i:0;s:1:\"2\";i:1;s:1:\"4\";i:2;s:2:\"11\";i:3;s:1:\"9\";}s:12:\"custom_icon_\";a:4:{i:0;s:3:\"254\";i:1;s:3:\"257\";i:2;s:3:\"256\";i:3;s:3:\"255\";}s:16:\"custom_subtitle_\";a:4:{i:0;N;i:1;N;i:2;N;i:3;N;}}s:11:\"padding_top\";s:2:\"40\";s:14:\"padding_bottom\";s:2:\"40\";s:10:\"section_bg\";N;}','2025-12-24 09:51:12','2025-12-24 11:26:44'),(50,'PopularProjectOne','new','plugins\\PageBuilder\\Addons\\Project\\PopularProjectOne','dynamic_page',3,10,'dynamic_page','a:16:{s:10:\"addon_name\";s:17:\"PopularProjectOne\";s:15:\"addon_namespace\";s:72:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcUHJvamVjdFxQb3B1bGFyUHJvamVjdE9uZQ==\";s:10:\"addon_type\";s:3:\"new\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"3\";s:13:\"addon_page_id\";s:2:\"10\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:16:\"Popular Services\";s:5:\"items\";s:1:\"6\";s:9:\"pro_count\";N;s:8:\"order_by\";s:6:\"latest\";s:11:\"layout_type\";s:4:\"grid\";s:13:\"category_tags\";a:2:{s:9:\"tag_text_\";a:1:{i:0;N;}s:8:\"tag_url_\";a:1:{i:0;N;}}s:11:\"padding_top\";s:3:\"260\";s:14:\"padding_bottom\";s:3:\"190\";s:10:\"section_bg\";N;}','2025-12-24 09:54:59','2025-12-24 09:54:59'),(51,'PopularJobOne','new','plugins\\PageBuilder\\Addons\\Job\\PopularJobOne','dynamic_page',4,10,'dynamic_page','a:14:{s:10:\"addon_name\";s:13:\"PopularJobOne\";s:15:\"addon_namespace\";s:60:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcSm9iXFBvcHVsYXJKb2JPbmU=\";s:10:\"addon_type\";s:3:\"new\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"4\";s:13:\"addon_page_id\";s:2:\"10\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:11:\"Latest Jobs\";s:5:\"items\";s:1:\"6\";s:8:\"order_by\";s:6:\"latest\";s:11:\"layout_type\";s:4:\"grid\";s:11:\"padding_top\";s:2:\"40\";s:14:\"padding_bottom\";s:2:\"64\";s:10:\"section_bg\";N;}','2025-12-24 09:56:05','2025-12-24 09:56:05'),(52,'HireTheBest','new','plugins\\PageBuilder\\Addons\\HireTheBest\\HireTheBest','dynamic_page',5,10,'dynamic_page','a:13:{s:10:\"addon_name\";s:11:\"HireTheBest\";s:15:\"addon_namespace\";s:68:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcSGlyZVRoZUJlc3RcSGlyZVRoZUJlc3Q=\";s:10:\"addon_type\";s:3:\"new\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"5\";s:13:\"addon_page_id\";s:2:\"10\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:29:\"All You Need to Hire The Best\";s:13:\"feature_cards\";a:3:{s:5:\"icon_\";a:3:{i:0;s:3:\"258\";i:1;s:3:\"259\";i:2;s:3:\"260\";}s:11:\"card_title_\";a:3:{i:0;s:22:\"Verified Professionals\";i:1;s:20:\"Pay Only for Results\";i:2;s:20:\"Secure & Transparent\";}s:17:\"card_description_\";a:3:{i:0;s:76:\"Work with skilled freelancers who pass quality checks and portfolio reviews.\";i:1;s:60:\"Release payment once your project is successfully completed.\";i:2;s:66:\"Built-in tools for communication, file sharing, and sage payments.\";}}s:11:\"right_image\";s:3:\"261\";s:16:\"background_color\";s:7:\"#F8F9FD\";s:11:\"padding_top\";s:2:\"40\";s:14:\"padding_bottom\";s:2:\"40\";}','2025-12-24 09:59:43','2025-12-24 09:59:43'),(53,'TestimonialOne','update','plugins\\PageBuilder\\Addons\\Testimonial\\TestimonialOne','dynamic_page',6,10,'dynamic_page','a:16:{s:2:\"id\";s:2:\"53\";s:10:\"addon_name\";s:14:\"TestimonialOne\";s:15:\"addon_namespace\";s:72:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcVGVzdGltb25pYWxcVGVzdGltb25pYWxPbmU=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"6\";s:13:\"addon_page_id\";s:2:\"10\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:38:\"What Freelancers are Thinking About Us\";s:18:\"slider_button_text\";N;s:5:\"items\";s:1:\"6\";s:8:\"order_by\";s:6:\"latest\";s:11:\"padding_top\";s:3:\"260\";s:14:\"padding_bottom\";s:3:\"190\";s:10:\"section_bg\";N;s:16:\"background_image\";s:3:\"313\";}','2025-12-24 10:00:41','2026-01-19 06:06:23'),(54,'Mobilica','update','plugins\\PageBuilder\\Addons\\Mobilica\\Mobilica','dynamic_page',7,10,'dynamic_page','a:25:{s:2:\"id\";s:2:\"54\";s:10:\"addon_name\";s:8:\"Mobilica\";s:15:\"addon_namespace\";s:60:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcTW9iaWxpY2FcTW9iaWxpY2E=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"7\";s:13:\"addon_page_id\";s:2:\"10\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:20:\"free_app_store_title\";s:37:\"Download Xilancer \r\nClient Mobile App\";s:20:\"free_app_store_image\";s:3:\"262\";s:19:\"free_app_store_link\";s:73:\"https://play.google.com/store/apps/details?id=com.xgenious.xilancer&hl=en\";s:25:\"free_app_play_store_image\";s:3:\"263\";s:24:\"free_app_play_store_link\";s:73:\"https://play.google.com/store/apps/details?id=com.xgenious.xilancer&hl=en\";s:20:\"free_app_store_shape\";N;s:20:\"free_app_store_phone\";s:3:\"305\";s:22:\"client_app_store_title\";s:37:\"Download Xilancer \r\nClient Mobile App\";s:22:\"client_app_store_image\";s:3:\"262\";s:21:\"client_app_store_link\";s:73:\"https://play.google.com/store/apps/details?id=com.xgenious.xilancer&hl=en\";s:27:\"client_app_play_store_image\";s:3:\"263\";s:26:\"client_app_play_store_link\";s:73:\"https://play.google.com/store/apps/details?id=com.xgenious.xilancer&hl=en\";s:22:\"client_app_store_shape\";N;s:22:\"client_app_store_phone\";s:3:\"305\";s:11:\"padding_top\";s:3:\"234\";s:14:\"padding_bottom\";s:3:\"121\";s:10:\"section_bg\";N;}','2025-12-24 10:03:21','2026-01-25 11:01:43'),(55,'LatestProject','new','plugins\\PageBuilder\\Addons\\Project\\LatestProject','dynamic_page',8,10,'dynamic_page','a:14:{s:10:\"addon_name\";s:13:\"LatestProject\";s:15:\"addon_namespace\";s:64:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcUHJvamVjdFxMYXRlc3RQcm9qZWN0\";s:10:\"addon_type\";s:3:\"new\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"8\";s:13:\"addon_page_id\";s:2:\"10\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:17:\"Trending Projects\";s:5:\"items\";s:2:\"10\";s:9:\"pro_count\";N;s:8:\"order_by\";s:6:\"latest\";s:11:\"padding_top\";s:2:\"40\";s:14:\"padding_bottom\";s:2:\"40\";s:10:\"section_bg\";N;}','2025-12-24 10:04:34','2025-12-24 10:04:34'),(56,'HowItWorks','update','plugins\\PageBuilder\\Addons\\HowItWorks\\HowItWorks','dynamic_page',9,10,'dynamic_page','a:15:{s:2:\"id\";s:2:\"56\";s:10:\"addon_name\";s:10:\"HowItWorks\";s:15:\"addon_namespace\";s:64:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcSG93SXRXb3Jrc1xIb3dJdFdvcmtz\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"9\";s:13:\"addon_page_id\";s:2:\"10\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:13:\"section_title\";s:12:\"How It Works\";s:5:\"steps\";a:3:{s:5:\"icon_\";a:4:{i:0;s:3:\"267\";i:1;s:3:\"268\";i:2;s:3:\"269\";i:3;s:3:\"270\";}s:6:\"title_\";a:4:{i:0;s:14:\"Post a Project\";i:1;s:13:\"Get Proposals\";i:2;s:15:\"Hire Freelancer\";i:3;s:13:\"Get Work Done\";}s:12:\"description_\";a:4:{i:0;s:36:\"Choose your project and requirements\";i:1;s:43:\"Receive proposals form qualified freelancer\";i:2;s:42:\"Select the best freelancer for your needs.\";i:3;s:43:\"Collaborate and get your project completed.\";}}s:11:\"padding_top\";s:1:\"0\";s:14:\"padding_bottom\";s:2:\"18\";s:10:\"section_bg\";s:7:\"#F8F9FD\";s:7:\"card_bg\";s:7:\"#FFFFFF\";s:7:\"icon_bg\";s:7:\"#E6F7F7\";}','2025-12-24 10:07:11','2026-01-07 11:33:01'),(57,'CategoryProjectOne','update','plugins\\PageBuilder\\Addons\\Category\\CategoryProjectOne','dynamic_page',10,10,'dynamic_page','a:15:{s:2:\"id\";s:2:\"57\";s:10:\"addon_name\";s:18:\"CategoryProjectOne\";s:15:\"addon_namespace\";s:72:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcQ2F0ZWdvcnlcQ2F0ZWdvcnlQcm9qZWN0T25l\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:2:\"10\";s:13:\"addon_page_id\";s:2:\"10\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:28:\"Browse Service by Categories\";s:20:\"view_all_button_text\";s:17:\"View all services\";s:20:\"view_all_button_link\";s:12:\"projects/all\";s:20:\"category_custom_data\";a:2:{s:12:\"category_id_\";a:5:{i:0;s:1:\"2\";i:1;s:1:\"4\";i:2;s:1:\"1\";i:3;s:2:\"13\";i:4;s:1:\"9\";}s:17:\"background_image_\";a:5:{i:0;s:3:\"271\";i:1;s:3:\"274\";i:2;s:3:\"273\";i:3;s:3:\"275\";i:4;s:3:\"271\";}}s:11:\"padding_top\";s:2:\"40\";s:14:\"padding_bottom\";s:2:\"40\";s:10:\"section_bg\";N;}','2025-12-24 10:10:30','2025-12-24 11:28:25'),(58,'ProfilePromotion','update','Modules\\PromoteFreelancer\\Http\\PageBuilder\\Promotion\\ProfilePromotion','dynamic_page',11,10,'dynamic_page','a:15:{s:2:\"id\";s:2:\"58\";s:10:\"addon_name\";s:16:\"ProfilePromotion\";s:15:\"addon_namespace\";s:92:\"TW9kdWxlc1xQcm9tb3RlRnJlZWxhbmNlclxIdHRwXFBhZ2VCdWlsZGVyXFByb21vdGlvblxQcm9maWxlUHJvbW90aW9u\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:2:\"11\";s:13:\"addon_page_id\";s:2:\"10\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:21:\"Top Rated Freelancers\";s:18:\"browse_button_text\";s:10:\"Browse all\";s:18:\"browse_button_link\";s:40:\"http://xilancer.xgenious.com/talents/all\";s:5:\"items\";s:1:\"3\";s:11:\"padding_top\";s:2:\"40\";s:14:\"padding_bottom\";s:2:\"40\";s:10:\"section_bg\";N;}','2025-12-24 10:12:53','2025-12-24 10:47:37'),(59,'GetStarted2','update','plugins\\PageBuilder\\Addons\\GetStarted\\GetStarted2','dynamic_page',12,10,'dynamic_page','a:17:{s:2:\"id\";s:2:\"59\";s:10:\"addon_name\";s:11:\"GetStarted2\";s:15:\"addon_namespace\";s:68:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcR2V0U3RhcnRlZFxHZXRTdGFydGVkMg==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:2:\"12\";s:13:\"addon_page_id\";s:2:\"10\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:11:\"Get Started\";s:8:\"subtitle\";N;s:11:\"button_text\";s:7:\"Join Us\";s:11:\"button_link\";s:5:\"login\";s:16:\"decorative_image\";s:3:\"276\";s:13:\"gradient_from\";s:25:\"rgba(111, 227, 181, 0.11)\";s:11:\"gradient_to\";s:24:\"rgba(222, 175, 64, 0.23)\";s:11:\"padding_top\";s:2:\"40\";s:14:\"padding_bottom\";s:2:\"40\";}','2025-12-24 10:14:40','2026-01-07 11:31:20'),(60,'CategoryJobOne','update','plugins\\PageBuilder\\Addons\\Category\\CategoryJobOne','dynamic_page',2,7,'dynamic_page','a:15:{s:2:\"id\";s:2:\"60\";s:10:\"addon_name\";s:14:\"CategoryJobOne\";s:15:\"addon_namespace\";s:68:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcQ2F0ZWdvcnlcQ2F0ZWdvcnlKb2JPbmU=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"2\";s:13:\"addon_page_id\";s:1:\"7\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:18:\"Popular Categories\";s:18:\"browse_button_text\";s:21:\"Browse all categories\";s:18:\"browse_button_link\";s:10:\"categories\";s:20:\"category_custom_data\";a:3:{s:12:\"category_id_\";a:4:{i:0;s:1:\"2\";i:1;s:1:\"4\";i:2;s:2:\"11\";i:3;s:1:\"9\";}s:12:\"custom_icon_\";a:4:{i:0;s:3:\"254\";i:1;s:3:\"255\";i:2;s:3:\"256\";i:3;s:3:\"255\";}s:16:\"custom_subtitle_\";a:4:{i:0;s:52:\"Designing and building responsive business websites.\";i:1;s:42:\"Creating apps for Android and iOS devices.\";i:2;s:54:\"Promoting brands through digital marketing strategies.\";i:3;s:54:\"Promoting brands through digital marketing strategies.\";}}s:11:\"padding_top\";s:2:\"40\";s:14:\"padding_bottom\";s:2:\"40\";s:10:\"section_bg\";N;}','2025-12-24 10:26:22','2025-12-24 11:32:23'),(61,'HireTheBest','update','plugins\\PageBuilder\\Addons\\HireTheBest\\HireTheBest','dynamic_page',5,7,'dynamic_page','a:14:{s:2:\"id\";s:2:\"61\";s:10:\"addon_name\";s:11:\"HireTheBest\";s:15:\"addon_namespace\";s:68:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcSGlyZVRoZUJlc3RcSGlyZVRoZUJlc3Q=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"5\";s:13:\"addon_page_id\";s:1:\"7\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:29:\"All You Need to Hire The Best\";s:13:\"feature_cards\";a:3:{s:5:\"icon_\";a:3:{i:0;s:3:\"258\";i:1;s:3:\"259\";i:2;s:3:\"260\";}s:11:\"card_title_\";a:3:{i:0;s:22:\"Verified Professionals\";i:1;s:20:\"Pay Only for Results\";i:2;s:20:\"Secure & Transparent\";}s:17:\"card_description_\";a:3:{i:0;s:76:\"Work with skilled freelancers who pass quality checks and portfolio reviews.\";i:1;s:60:\"Release payment once your project is successfully completed.\";i:2;s:66:\"Built-in tools for communication, file sharing, and sage payments.\";}}s:11:\"right_image\";s:3:\"261\";s:16:\"background_color\";s:7:\"#F8F9FD\";s:11:\"padding_top\";s:2:\"88\";s:14:\"padding_bottom\";s:2:\"89\";}','2025-12-24 10:29:22','2026-01-08 08:50:28'),(62,'Mobilica','update','plugins\\PageBuilder\\Addons\\Mobilica\\Mobilica','dynamic_page',7,7,'dynamic_page','a:25:{s:2:\"id\";s:2:\"62\";s:10:\"addon_name\";s:8:\"Mobilica\";s:15:\"addon_namespace\";s:60:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcTW9iaWxpY2FcTW9iaWxpY2E=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"7\";s:13:\"addon_page_id\";s:1:\"7\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:20:\"free_app_store_title\";s:36:\"Download Xilancer\r\nClient Mobile App\";s:20:\"free_app_store_image\";s:3:\"262\";s:19:\"free_app_store_link\";s:73:\"https://play.google.com/store/apps/details?id=com.xgenious.xilancer&hl=en\";s:25:\"free_app_play_store_image\";s:3:\"263\";s:24:\"free_app_play_store_link\";s:73:\"https://play.google.com/store/apps/details?id=com.xgenious.xilancer&hl=en\";s:20:\"free_app_store_shape\";N;s:20:\"free_app_store_phone\";s:3:\"305\";s:22:\"client_app_store_title\";s:37:\"Download Xilancer \r\nClient Mobile App\";s:22:\"client_app_store_image\";s:3:\"262\";s:21:\"client_app_store_link\";s:73:\"https://play.google.com/store/apps/details?id=com.xgenious.xilancer&hl=en\";s:27:\"client_app_play_store_image\";s:3:\"263\";s:26:\"client_app_play_store_link\";s:73:\"https://play.google.com/store/apps/details?id=com.xgenious.xilancer&hl=en\";s:22:\"client_app_store_shape\";N;s:22:\"client_app_store_phone\";s:3:\"305\";s:11:\"padding_top\";s:3:\"200\";s:14:\"padding_bottom\";s:2:\"99\";s:10:\"section_bg\";N;}','2025-12-24 10:31:41','2026-01-25 11:00:31'),(63,'LatestProject','new','plugins\\PageBuilder\\Addons\\Project\\LatestProject','dynamic_page',8,7,'dynamic_page','a:14:{s:10:\"addon_name\";s:13:\"LatestProject\";s:15:\"addon_namespace\";s:64:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcUHJvamVjdFxMYXRlc3RQcm9qZWN0\";s:10:\"addon_type\";s:3:\"new\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"8\";s:13:\"addon_page_id\";s:1:\"7\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:17:\"Trending Projects\";s:5:\"items\";s:2:\"10\";s:9:\"pro_count\";N;s:8:\"order_by\";s:6:\"latest\";s:11:\"padding_top\";s:2:\"40\";s:14:\"padding_bottom\";s:2:\"40\";s:10:\"section_bg\";N;}','2025-12-24 10:32:51','2025-12-24 10:32:51'),(64,'HowItWorks','update','plugins\\PageBuilder\\Addons\\HowItWorks\\HowItWorks','dynamic_page',9,7,'dynamic_page','a:15:{s:2:\"id\";s:2:\"64\";s:10:\"addon_name\";s:10:\"HowItWorks\";s:15:\"addon_namespace\";s:64:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcSG93SXRXb3Jrc1xIb3dJdFdvcmtz\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"9\";s:13:\"addon_page_id\";s:1:\"7\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:13:\"section_title\";s:12:\"How It Works\";s:5:\"steps\";a:3:{s:5:\"icon_\";a:4:{i:0;s:3:\"267\";i:1;s:3:\"268\";i:2;s:3:\"269\";i:3;s:3:\"270\";}s:6:\"title_\";a:4:{i:0;s:14:\"Post a Project\";i:1;s:13:\"Get Proposals\";i:2;s:15:\"Hire Freelancer\";i:3;s:13:\"Get Work Done\";}s:12:\"description_\";a:4:{i:0;s:36:\"Choose your project and requirements\";i:1;s:43:\"Receive proposals form qualified freelancer\";i:2;s:42:\"Select the best freelancer for your needs.\";i:3;s:43:\"Collaborate and get your project completed.\";}}s:11:\"padding_top\";s:1:\"0\";s:14:\"padding_bottom\";s:2:\"18\";s:10:\"section_bg\";s:7:\"#F8F9FD\";s:7:\"card_bg\";s:7:\"#FFFFFF\";s:7:\"icon_bg\";s:7:\"#E6F7F7\";}','2025-12-24 10:35:05','2026-01-07 11:29:46'),(65,'CategoryProjectOne','update','plugins\\PageBuilder\\Addons\\Category\\CategoryProjectOne','dynamic_page',10,7,'dynamic_page','a:15:{s:2:\"id\";s:2:\"65\";s:10:\"addon_name\";s:18:\"CategoryProjectOne\";s:15:\"addon_namespace\";s:72:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcQ2F0ZWdvcnlcQ2F0ZWdvcnlQcm9qZWN0T25l\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:2:\"10\";s:13:\"addon_page_id\";s:1:\"7\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:28:\"Browse Service by Categories\";s:20:\"view_all_button_text\";s:17:\"View all services\";s:20:\"view_all_button_link\";s:12:\"projects/all\";s:20:\"category_custom_data\";a:2:{s:12:\"category_id_\";a:5:{i:0;s:1:\"2\";i:1;s:1:\"4\";i:2;s:1:\"1\";i:3;s:1:\"9\";i:4;s:2:\"13\";}s:17:\"background_image_\";a:5:{i:0;s:3:\"272\";i:1;s:3:\"273\";i:2;s:3:\"275\";i:3;s:3:\"272\";i:4;s:3:\"274\";}}s:11:\"padding_top\";s:2:\"40\";s:14:\"padding_bottom\";s:2:\"40\";s:10:\"section_bg\";N;}','2025-12-24 10:37:01','2025-12-24 11:31:31'),(66,'ProfilePromotion','update','Modules\\PromoteFreelancer\\Http\\PageBuilder\\Promotion\\ProfilePromotion','dynamic_page',11,7,'dynamic_page','a:15:{s:2:\"id\";s:2:\"66\";s:10:\"addon_name\";s:16:\"ProfilePromotion\";s:15:\"addon_namespace\";s:92:\"TW9kdWxlc1xQcm9tb3RlRnJlZWxhbmNlclxIdHRwXFBhZ2VCdWlsZGVyXFByb21vdGlvblxQcm9maWxlUHJvbW90aW9u\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:2:\"11\";s:13:\"addon_page_id\";s:1:\"7\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:21:\"Top Rated Freelancers\";s:18:\"browse_button_text\";s:10:\"Browse all\";s:18:\"browse_button_link\";s:11:\"talents/all\";s:5:\"items\";s:1:\"3\";s:11:\"padding_top\";s:2:\"40\";s:14:\"padding_bottom\";s:2:\"40\";s:10:\"section_bg\";N;}','2025-12-24 10:37:54','2025-12-24 11:31:20'),(67,'GetStarted2','update','plugins\\PageBuilder\\Addons\\GetStarted\\GetStarted2','dynamic_page',12,7,'dynamic_page','a:17:{s:2:\"id\";s:2:\"67\";s:10:\"addon_name\";s:11:\"GetStarted2\";s:15:\"addon_namespace\";s:68:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcR2V0U3RhcnRlZFxHZXRTdGFydGVkMg==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:2:\"12\";s:13:\"addon_page_id\";s:1:\"7\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:11:\"Get Started\";s:8:\"subtitle\";N;s:11:\"button_text\";s:7:\"Join Us\";s:11:\"button_link\";s:5:\"login\";s:16:\"decorative_image\";s:3:\"276\";s:13:\"gradient_from\";s:25:\"rgba(111, 227, 181, 0.11)\";s:11:\"gradient_to\";s:24:\"rgba(222, 175, 64, 0.23)\";s:11:\"padding_top\";s:2:\"40\";s:14:\"padding_bottom\";s:2:\"40\";}','2025-12-24 10:39:23','2026-01-07 11:28:54'),(68,'OurStory','update','plugins\\PageBuilder\\Addons\\About\\OurStory','dynamic_page',2,8,'dynamic_page','a:13:{s:2:\"id\";s:2:\"68\";s:10:\"addon_name\";s:8:\"OurStory\";s:15:\"addon_namespace\";s:56:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcQWJvdXRcT3VyU3Rvcnk=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"2\";s:13:\"addon_page_id\";s:1:\"8\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:14:\"story_sections\";a:4:{s:14:\"section_title_\";a:3:{i:0;s:9:\"Our Story\";i:1;s:10:\"Our Vision\";i:2;s:10:\"Our Values\";}s:16:\"section_content_\";a:3:{i:0;s:1016:\"<p style=\"line-height: 1.5;\"><b>01. Built On Real Experience</b></p><p style=\"line-height: 1.5;\"><span style=\"display: inline !important;\">Xilancer was founded with a vision to connect talents and businesses worldwide. Our journey started with understanding the struggles of freelancers and employers.</span></p><p style=\"line-height: 1.5;\"><span style=\"display: inline !important;\"><br></span></p><p style=\"line-height: 1.5;\"><b>02. Empowering Connections</b></p><p style=\"line-height: 1.5;\"><span style=\"font-weight: normal;\">Xilancer helps businesses find the right talent while giving freelancers the opportunity to showcase their skills and grow.</span></p><p style=\"line-height: 1.5;\"><br><b>03. Trust &amp; Growth Together</b></p><p style=\"line-height: 1.5;\"><span style=\"font-weight: normal;\">Our platform ensures safe payments, reliable communication, and fair opportunities for everyone. At Xilancer, we\'re building not just a marketplace— but a community of trust, collaboration, and success.</span></p>\";i:1;s:458:\"Our vision is to build a platform where talented freelancers and businesses from around the world come together. We believe every skill has value, and connecting it with the right opportunity is our mission.<br><br>We aim to make freelancing simpler, more transparent, and trustworthy—where every talent is recognized, and every business finds the right expertise they need. We want to redefine the future of work, where borders don’t matter—skills do.\";i:2;s:458:\"Our vision is to build a platform where talented freelancers and businesses from around the world come together. We believe every skill has value, and connecting it with the right opportunity is our mission.<br><br>We aim to make freelancing simpler, more transparent, and trustworthy—where every talent is recognized, and every business finds the right expertise they need. We want to redefine the future of work, where borders don’t matter—skills do.\";}s:14:\"section_image_\";a:3:{i:0;s:3:\"295\";i:1;s:3:\"297\";i:2;s:3:\"296\";}s:15:\"image_position_\";a:3:{i:0;s:5:\"right\";i:1;s:4:\"left\";i:2;s:5:\"right\";}}s:11:\"padding_top\";s:2:\"80\";s:14:\"padding_bottom\";s:2:\"80\";s:15:\"section_spacing\";s:3:\"128\";s:10:\"section_bg\";s:7:\"#F8F9FD\";}','2025-12-24 10:53:21','2026-01-08 10:03:36');
/*!40000 ALTER TABLE `page_builders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `page_content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `page_builder_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `layout` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_class` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `breadcrumb_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `navbar_variant` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_variant` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visibility` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint DEFAULT NULL COMMENT '1-active, 0-inactive',
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
INSERT INTO `pages` VALUES (2,'Contact','contact-us','<p><span style=\"color: rgb(153, 153, 153); font-family: Manrope, sans-serif; font-size: 15px; display: inline !important;\">You’re not obliged to pay any fee before you earn and we just charge less than 2% on your total earnings if you have membership then it’s less than 1%</span><span style=\"color: rgb(153, 153, 153); font-family: Manrope, sans-serif; font-size: 15px; font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); display: inline !important;\">You’re not obliged to pay any fee before you earn and we just charge less than 2% on your total earnings if you have membership then it’s less than 1%</span><span style=\"color: rgb(153, 153, 153); font-family: Manrope, sans-serif; font-size: 15px; font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); display: inline !important;\">You’re not obliged to pay any fee before you earn and we just charge less than 2% on your total earnings if you have membership then it’s less than 1%</span><span style=\"color: rgb(153, 153, 153); font-family: Manrope, sans-serif; font-size: 15px; font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); display: inline !important;\">You’re not obliged to pay any fee before you earn and we just charge less than 2% on your total earnings if you have membership then it’s less than 1%</span><span style=\"color: rgb(153, 153, 153); font-family: Manrope, sans-serif; font-size: 15px; font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); display: inline !important;\">You’re not obliged to pay any fee before you earn and we just charge less than 2% on your total earnings if you have membership then it’s less than 1%</span><span style=\"color: rgb(153, 153, 153); font-family: Manrope, sans-serif; font-size: 15px; font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); display: inline !important;\">You’re not obliged to pay any fee before you earn and we just charge less than 2% on your total earnings if you have membership then it’s less than 1%</span></p><p><span style=\"color: rgb(153, 153, 153); font-family: Manrope, sans-serif; font-size: 15px; font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); display: inline !important;\"><br></span></p><p><span style=\"color: rgb(153, 153, 153); font-family: Manrope, sans-serif; font-size: 15px; font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); display: inline !important;\"><span style=\"display: inline !important;\">You’re not obliged to pay any fee before you earn and we just charge less than 2% on your total earnings if you have membership then it’s less than 1%</span></span></p><p><span style=\"color: rgb(153, 153, 153); font-family: Manrope, sans-serif; font-size: 15px; font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); display: inline !important;\"><span style=\"display: inline !important;\"><span style=\"display: inline !important;\">You’re not obliged to pay any fee before you earn and we just charge less than 2% on your total earnings if you have membership then it’s less than 1%</span></span></span></p><p><span style=\"color: rgb(153, 153, 153); font-family: Manrope, sans-serif; font-size: 15px; font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); display: inline !important;\"><span style=\"display: inline !important;\"><span style=\"display: inline !important;\"><br></span></span></span></p><p><span style=\"color: rgb(153, 153, 153); font-family: Manrope, sans-serif; font-size: 15px; font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); display: inline !important;\"><span style=\"display: inline !important;\"><span style=\"display: inline !important;\"><span style=\"display: inline !important;\">You’re not obliged to pay any fee before you earn and we just charge less than 2% on your total earnings if you have membership then it’s less than 1%</span></span></span></span></p><p><span style=\"color: rgb(153, 153, 153); font-family: Manrope, sans-serif; font-size: 15px; font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); display: inline !important;\"><span style=\"display: inline !important;\"><span style=\"display: inline !important;\"><span style=\"display: inline !important;\"><br></span></span></span></span></p><p><span style=\"color: rgb(153, 153, 153); font-family: Manrope, sans-serif; font-size: 15px; font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); display: inline !important;\"><span style=\"display: inline !important;\"><span style=\"display: inline !important;\"><span style=\"display: inline !important;\"><span style=\"display: inline !important;\">You’re not obliged to pay any fee before you earn and we just charge less than 2% on your total earnings if you have membership then it’s less than 1%</span><br></span><br></span><br></span><br></span><br></p>','on','normal_layout','nav-absolute','on','02','03','all',1,'2022-12-21 07:22:54','2026-01-20 17:28:36'),(6,'Privacy Policy','privacy-policy','<p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">Welcome to our platform dedicated to connecting clients with independent professionals generally. We understand the importance of privacy and are committed to protecting the personal information of our users. This Privacy Policy outlines our practices regarding the collection, use, and disclosure of your information when you use our website and services.</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><b>Information We Collect</b></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">Personal information such as your name, email address, phone number, postal address, and other contact details. Professional information, Resume work history, educational background, skills, and any other information related to professional qualifications. Financial information: Payment details, including credit card numbers, bank information, and billing addresses, which are processed by our third-party payment processors. Technical information: Browser types, operating system details, device information, and usage data such as website navigation patterns.\r\n</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">The information we collect may be used for the following purposes:</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><b>01.</b>&nbsp;<span style=\"display: inline !important;\">To facilitate the creation of your account and your access to our services.</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><b>02.</b>&nbsp;<span style=\"display: inline !important;\">To match clients with suitable freelancers and vice versa.</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><b>03.</b>&nbsp;<span style=\"display: inline !important;\">To process payments and manage transactions.</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><b>04.</b>&nbsp;<span style=\"display: inline !important;\">To communicate with you about your account or transactions and to send you updates about our services.</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><b>05.</b>&nbsp;<span style=\"display: inline !important;\">To improve our website functionality and user experience.</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><b>06.</b>&nbsp;<span style=\"display: inline !important;\">To comply with legal obligations and enforce our terms and conditions.</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\"><b>Sharing Your Information</b></span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\">We may share your information with:\r\n</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\"><b>01.</b>&nbsp;</span><span style=\"display: inline !important;\">Other users of this site when necessary to facilitate service offerings and collaborations.</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\"><b>02.</b>&nbsp;</span><span style=\"display: inline !important;\">Service providers who perform services on our behalf, such as payment processing, data analysis, and email delivery services.</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\"><b>03.</b>&nbsp;</span><span style=\"display: inline !important;\">Law enforcement or other government agencies if required by law or in good faith belief that such action is necessary to comply with legal processes.</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\">We do not sell, rent, or lease our user lists to third parties for their marketing purposes without your explicit consent.</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\"><b>Data Security</b></span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\">We implement reasonable security measures to protect against unauthorized access, alteration, disclosure, or destruction of your personal information. However, no method of transmission over the internet or electronic storage is 100% secure, and we cannot guarantee its absolute security.</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\"><b>Your Rights</b></span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\">You have the right to:\r\n</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\"><b>01.</b>&nbsp;</span><span style=\"display: inline !important;\">Access, update, or delete the personal information we have on you.</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\"><b>02</b>.&nbsp;</span><span style=\"display: inline !important;\">Object to the processing of your personal information.</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\"><b>03.</b>&nbsp;</span><span style=\"display: inline !important;\">Request that we restrict the processing of your personal information.</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\"><b>04.</b>&nbsp;</span><span style=\"display: inline !important;\">Withdraw consent at any time where we relied on your consent to process your personal information.</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><b>International Transfers</b></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">Your information may be transferred to, and maintained on, computers located outside of your state, province, country, or other governmental jurisdiction, where the data protection laws may differ from those of your jurisdiction.</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><b>Changes to This Privacy Policy</b></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">We may update this Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page. We encourage you to review this Privacy Policy periodically for any changes.</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><b>Contact Us</b></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">If you have any questions about this Privacy Policy, please contact us:</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><b>01.</b>&nbsp;<span style=\"display: inline !important;\">By email: [insert Email Address]</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><b>02.</b>&nbsp;<span style=\"display: inline !important;\">By visiting this page on our website: [insert Privacy Policy Page URL]</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\"><b>Consent</b></span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\">By using our website and services, you consent to the collection, use, and sharing of your personal information as outlined in this Privacy Policy. This Privacy Policy is intended to be a general template and may need to be tailored to comply with the laws of your jurisdiction or to suit the specific operations of your website or organization. It is advisable to consult with a legal expert when drafting your detailed privacy policy.</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">\r\n</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\">\r\n</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\">\r\n</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\">\r\n</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\">\r\n</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\">\r\n</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\">\r\n</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\">\r\n</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\">\r\n</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">\r\n</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">\r\n</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">\r\n</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">\r\n</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">\r\n</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); line-height: 2;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><b>\r\n</b></p>',NULL,'normal_layout','none','on',NULL,'03','all',1,'2022-12-28 01:51:06','2026-01-20 17:28:43'),(7,'Home Page One','home-page-one','<p>asdaui sasd aosidj laksdj aklsdj alkfjsdoijqoi aslkd aslkdj asoidj asoidj asd jmoriopi posdf aspod kaspod jaspodij asdiopja siopdjasoid jaspodi jaspdas fdpasoqwe k rokasodk aspodk asdasd asd</p>','on','home_page_layout','none',NULL,'01','03','all',1,'2023-10-26 05:33:00','2026-01-20 17:24:17'),(8,'About Us','about-us','<p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin-right: 0px; margin-bottom: 1.25em; margin-left: 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-weight: 600; color: var(--tw-prose-bold);\">About Us</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">Welcome to [Your Freelancing Website Name], where talent meets opportunity.</p><h3 style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-size: 1.25em; font-weight: 600; margin-top: 1rem; margin-bottom: 0.5rem; line-height: 1.6; font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; color: inherit;\">Our Story</span></h3><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin-right: 0px; margin-bottom: 1.25em; margin-left: 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">In the bustling digital age, where connectivity is as simple as a click, we found that the true potential of freelance talent was still untapped. Established in [Year], our platform was born from a simple yet powerful vision: to create a seamless bridge between gifted freelancers and visionary businesses.</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">We recognized the hurdles of the gig economy – the uncertainty, the competition, the often-impersonal interactions – and set out to craft a solution that would empower both freelancers and clients alike.</p><h3 style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-size: 1.25em; font-weight: 600; margin-top: 1rem; margin-bottom: 0.5rem; line-height: 1.6; font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; color: inherit;\">Our Mission</span></h3><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin-right: 0px; margin-bottom: 1.25em; margin-left: 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">At [Your Freelancing Website Name], we\'re not just building a marketplace; we\'re cultivating a community. Our mission is to facilitate a professional environment where freelancers can thrive, businesses can innovate, and collaboration can flourish.</p><h3 style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-size: 1.25em; font-weight: 600; margin-top: 1rem; margin-bottom: 0.5rem; line-height: 1.6; font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; color: inherit;\">Our Values</span></h3><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin-right: 0px; margin-bottom: 1.25em; margin-left: 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-weight: 600; color: var(--tw-prose-bold);\">Integrity</span>: We believe in honest and transparent communication, ensuring that every interaction on our platform is conducted with the utmost respect and professionalism.</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-weight: 600; color: var(--tw-prose-bold);\">Innovation</span>: Staying ahead of the curve is in our DNA. We constantly seek out new ways to enhance your experience, simplify processes, and enable success.</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-weight: 600; color: var(--tw-prose-bold);\">Excellence</span>: Our commitment to quality is unwavering. We meticulously curate our pool of talent and the projects that come through our platform, guaranteeing a standard of excellence that is second to none.</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-weight: 600; color: var(--tw-prose-bold);\">Community</span>: We understand the power of connection. That\'s why we foster a supportive network of professionals who share advice, offer mentorship, and help each other grow.</p><h3 style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-size: 1.25em; font-weight: 600; margin-top: 1rem; margin-bottom: 0.5rem; line-height: 1.6; font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; color: inherit;\">Our Community</span></h3><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin-right: 0px; margin-bottom: 1.25em; margin-left: 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">Our freelancers are the heartbeat of our platform. They are writers, designers, developers, marketers, consultants, and more – each bringing a unique set of skills and a passion for their craft.</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">Our clients range from startups to Fortune 500 companies, all seeking the perfect match for their project needs. Together, they span the globe, creating a diverse and dynamic tapestry of cultures and ideas.</p><h3 style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-size: 1.25em; font-weight: 600; margin-top: 1rem; margin-bottom: 0.5rem; line-height: 1.6; font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; color: inherit;\">Our Promise</span></h3><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin-right: 0px; margin-bottom: 1.25em; margin-left: 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">To Freelancers: We promise to provide you with a platform where you can showcase your skills, set your rates, and connect with clients who value what you do.</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">To Clients: We promise a curated selection of top-tier freelancers who are not only talented but also reliable and ready to help bring your projects to life.</p><h3 style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-size: 1.25em; font-weight: 600; margin-top: 1rem; margin-bottom: 0.5rem; line-height: 1.6; font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; color: inherit;\">Join Us</span></h3><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin-right: 0px; margin-bottom: 1.25em; margin-left: 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">Whether you\'re a freelancer looking to take your career to new heights or a business in search of the right talent to complete your next project, [Your Freelancing Website Name] is your partner in success. Explore our site, join our community, and let\'s make something incredible together.</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">Because here, we believe that when great minds collaborate, the possibilities are endless.</p><hr style=\"border-top-width: 1px; border-style: solid; border-color: var(--tw-prose-hr); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; color: rgb(55, 65, 81); height: 0px; margin-top: 3em; margin-bottom: 3em; font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" font-size:=\"\" 16px;=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin-right: 0px; margin-left: 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">This sample is meant to be inspirational and should be customized to align with the specific brand voice, value proposition, and unique selling points of your freelancing website.</p>','on','normal_layout','none','on',NULL,'03','all',1,'2023-11-02 06:43:42','2026-01-20 17:28:47'),(9,'Terms Conditions','terms-conditions','<p>Welcome to our platform dedicated to connecting clients with independent professionals generally. We understand the importance of privacy and are committed to protecting the personal information of our users. This Privacy Policy outlines our practices regarding the collection, use, and disclosure of your information when you use our website and services.</p><p><br></p><p><b>Information We Collect</b></p><p>We collect information you provide directly to us such as your name, email address, phone number, postal address, and other contact details. Professional information, Resume work history, educational background, skills, and any other information related to professional qualifications. Financial information: Payment details, including credit card numbers, bank information, and billing addresses, which are processed by our third-party payment processors. Technical information: Browser types, operating system details, device information, and usage data such as website navigation patterns.</p><p><br></p><p>\r\n</p><p>The information we collect may be used for the following purposes:</p><p><br></p><p><b>01.</b>&nbsp;<span style=\"display: inline !important;\">To facilitate the creation of your account and your access to our services.</span></p><p><span style=\"display: inline !important;\"><br></span></p><p><b>02.</b>&nbsp;<span style=\"display: inline !important;\">To match clients with suitable freelancers and vice versa.</span></p><p><span style=\"display: inline !important;\"><br></span></p><p><b>03.</b>&nbsp;<span style=\"display: inline !important;\">To provide you with our services and support.</span></p><p><span style=\"display: inline !important;\"><br></span></p><p><b>04.</b>&nbsp;<span style=\"display: inline !important;\">To communicate with you about your account or transactions and to send you updates about our services.</span></p><p><span style=\"display: inline !important;\"><br></span></p><p><b>05.</b>&nbsp;<span style=\"display: inline !important;\">To improve our website functionality and user experience.</span></p><p><span style=\"display: inline !important;\"><br></span></p><p><b>06.</b>&nbsp;<span style=\"display: inline !important;\">To comply with legal obligations and enforce our terms and conditions.</span></p><p><span style=\"display: inline !important;\"><br></span></p><p><span style=\"display: inline !important;\"><b>Sharing Your Information</b></span></p><p><span style=\"display: inline !important;\"><b><br></b></span></p><p><span style=\"display: inline !important;\">We may share your information with:</span></p><p><span style=\"display: inline !important;\"><br></span></p><p><span style=\"display: inline !important;\">\r\n</span></p><p><span style=\"display: inline !important;\"><b>01.&nbsp;</b></span>Other users of this site when necessary to facilitate service offerings and collaborations.</p><p><br></p><p><span style=\"display: inline !important;\"><b>02.&nbsp;</b></span>Service providers who perform services on our behalf, such as payment processing, data analysis, and email delivery services.</p><p><br></p><p><span style=\"display: inline !important;\"><b>03.&nbsp;</b></span>Law enforcement or government entities when necessary to comply with legal processes.</p><p><span style=\"display: inline !important;\">We do not sell, rent, or lease our user lists to third parties for their marketing purposes without your explicit consent.</span></p><p><span style=\"display: inline !important;\"><br></span></p><p><span style=\"display: inline !important;\"><b>Data Security</b></span></p><p><span style=\"display: inline !important;\">We implement reasonable security measures to protect against unauthorized access, alteration, disclosure, or destruction of your personal information. However, no method of transmission over the internet or electronic storage is 100% secure, and we cannot guarantee its absolute security.</span></p><p><span style=\"display: inline !important;\"><br></span></p><p><span style=\"display: inline !important;\"><b>Your Rights</b></span></p><p><span style=\"display: inline !important;\"><b><br></b></span></p><p><span style=\"display: inline !important;\">Depending on your location, you may have the right to:</span></p><p><span style=\"display: inline !important;\"><br></span></p><p><span style=\"display: inline !important;\">\r\n</span></p><p><span style=\"display: inline !important;\"><b>01.&nbsp;</b></span><span style=\"display: inline !important;\">Access, update, or delete the personal information we have on you.</span></p><p><span style=\"display: inline !important;\"><br></span></p><p><span style=\"display: inline !important;\"><b>02.&nbsp;</b></span><span style=\"display: inline !important;\">Obtain the portability of your personal information.</span></p><p><span style=\"display: inline !important;\"><br></span></p><p><span style=\"display: inline !important;\"><b>03.&nbsp;</b></span><span style=\"display: inline !important;\">Request that we restrict the processing of your personal information.</span></p><p><span style=\"display: inline !important;\"><br></span></p><p><span style=\"display: inline !important;\"><b>04.&nbsp;</b></span><span style=\"display: inline !important;\">Withdraw consent at any time where we relied on your consent to process your personal information.</span></p><p><span style=\"display: inline !important;\"><br></span></p><p><span style=\"display: inline !important;\"><b>International Transfers</b></span></p><p><span style=\"display: inline !important;\"><b><br></b></span></p><p><span style=\"display: inline !important;\">Your information may be transferred to, and maintained on, computers located outside of your state, province, country, or other governmental jurisdiction. Your data protection laws may differ from those of your jurisdiction.</span></p><p><span style=\"display: inline !important;\"><br></span></p><p><span style=\"display: inline !important;\"><b>Contact Us</b></span></p><p><span style=\"display: inline !important;\"><b><br></b></span></p><p><span style=\"display: inline !important;\">If you have any questions about this Privacy Policy, please contact us:</span></p><p><span style=\"display: inline !important;\"><br></span></p><p><span style=\"display: inline !important;\">\r\n</span></p><p><span style=\"display: inline !important;\"><b>01.&nbsp;</b></span>By email: helloxilancer@gmail.com</p><p><br></p><p><span style=\"display: inline !important;\"><b>02.&nbsp;</b></span>By visiting this page on our website: <a href=\"http://www.xilancer.com\" target=\"_blank\">www.xilancer.com</a></p><p><br></p><p><b>Consent</b></p><p><b><br></b></p><p>By using our website and services, you consent to the collection, use, and sharing of your personal information as outlined in this Privacy Policy. This Privacy Policy is intended to be a general template and may need to be tailored to comply with the laws of your jurisdiction or to suit the specific operations of your website or organization. It is advisable to consult with a legal expert when drafting your detailed privacy policy.</p><p><span style=\"display: inline !important;\"><b>\r\n</b></span></p><p><span style=\"display: inline !important;\"><b>\r\n</b></span></p><p><span style=\"display: inline !important;\"><b>\r\n</b></span></p><p><span style=\"display: inline !important;\"><b>\r\n</b></span></p><p><span style=\"display: inline !important;\"><b>\r\n</b></span></p><p><span style=\"display: inline !important;\"><b>\r\n</b></span></p><p><span style=\"display: inline !important;\"><b>\r\n</b></span></p><p><span style=\"display: inline !important;\"><b>\r\n</b></span></p><p><span style=\"display: inline !important;\"><b>\r\n</b></span></p><p><span style=\"display: inline !important;\"><b>\r\n</b></span></p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p>',NULL,'normal_layout','none','on',NULL,'03','all',1,'2024-03-10 16:36:03','2026-01-20 17:28:51'),(10,'Home Page Two','home-page-two','<p>Home Page Two</p>','on','normal_layout','none',NULL,NULL,'04','all',1,'2024-06-03 14:26:33','2026-01-20 17:30:19');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `portfolios`
--

DROP TABLE IF EXISTS `portfolios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `portfolios` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `published_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `load_from` int NOT NULL DEFAULT '0',
  `is_synced` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `portfolios`
--

LOCK TABLES `portfolios` WRITE;
/*!40000 ALTER TABLE `portfolios` DISABLE KEYS */;
/*!40000 ALTER TABLE `portfolios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_attributes`
--

DROP TABLE IF EXISTS `project_attributes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `project_attributes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `create_project_id` bigint NOT NULL,
  `type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_paid` tinyint NOT NULL DEFAULT '0' COMMENT '0 = free, 1 = paid',
  `check_numeric_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `basic_check_numeric` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `basic_extra_price` decimal(10,2) DEFAULT NULL,
  `standard_check_numeric` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `standard_extra_price` decimal(10,2) DEFAULT NULL,
  `premium_check_numeric` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `premium_extra_price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2226 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_attributes`
--

LOCK TABLES `project_attributes` WRITE;
/*!40000 ALTER TABLE `project_attributes` DISABLE KEYS */;
INSERT INTO `project_attributes` VALUES (2086,7,180,'checkbox',0,'Title 0','on',NULL,'on',NULL,'on',NULL,'2025-06-30 12:09:30','2025-06-30 12:09:30'),(2104,7,181,'numeric',0,'Title 0','0',NULL,'0',NULL,'0',NULL,NULL,'2025-09-09 03:39:19'),(2105,7,181,'checkbox',0,'Title 1','on',NULL,'off',NULL,'off',NULL,NULL,'2025-09-09 03:39:19'),(2106,7,181,'text',1,'Module','Payment Module',10.00,'',NULL,'',NULL,NULL,'2025-09-09 03:39:19'),(2111,7,182,'numeric',0,'Title 0','0',NULL,'0',NULL,'0',NULL,'2025-10-13 23:23:21','2025-10-13 23:23:21'),(2122,7,185,'checkbox',0,'testing Text Field','on',NULL,'on',NULL,'on',NULL,'2025-11-02 04:06:29','2025-11-02 04:06:29'),(2123,7,186,'checkbox',0,'Plus Nothing','on',NULL,'on',NULL,'on',NULL,'2025-12-20 17:14:08','2025-12-20 17:14:08'),(2138,7,184,'checkbox',0,'test1','on',NULL,'on',NULL,'on',NULL,NULL,'2025-12-29 03:46:52'),(2221,7,189,'text',0,'Starter','Simple Landing Page using React/Next.js, Upto 5 sections + R',NULL,'Attractive 5 Pages React/Next.js + Custom Design + Responsiv',NULL,'Business React/Next.js Web App + Custom Design + Upto 8 Page',NULL,NULL,'2026-01-19 19:34:58'),(2222,7,190,'checkbox',0,'abcgh','on',NULL,'on',NULL,'on',NULL,'2026-01-20 03:41:23','2026-01-20 03:41:23'),(2223,7,191,'checkbox',0,'test74754','on',NULL,'on',NULL,'on',NULL,'2026-01-20 06:46:34','2026-01-20 06:46:34'),(2225,7,192,'checkbox',0,'Final','on',NULL,'on',NULL,'on',NULL,NULL,'2026-01-22 11:14:40');
/*!40000 ALTER TABLE `project_attributes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_histories`
--

DROP TABLE IF EXISTS `project_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `project_histories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `project_id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `reject_count` bigint DEFAULT NULL,
  `edit_count` bigint DEFAULT NULL,
  `reject_reason` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_histories`
--

LOCK TABLES `project_histories` WRITE;
/*!40000 ALTER TABLE `project_histories` DISABLE KEYS */;
INSERT INTO `project_histories` VALUES (30,181,7,2,1,NULL,'2025-09-09 03:09:08','2025-09-09 03:39:19'),(32,184,7,0,2,NULL,'2025-12-29 03:37:34','2025-12-29 03:46:52'),(33,189,7,0,3,NULL,'2026-01-19 19:26:51','2026-01-19 19:34:58'),(34,192,7,0,1,NULL,'2026-01-22 11:14:40','2026-01-22 11:14:40');
/*!40000 ALTER TABLE `project_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_promote_settings`
--

DROP TABLE IF EXISTS `project_promote_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `project_promote_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `budget` double NOT NULL,
  `duration` int NOT NULL,
  `status` int NOT NULL,
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
INSERT INTO `project_promote_settings` VALUES (1,'10 Days',NULL,10,10,1,'2024-05-09 15:15:21','2024-05-09 15:15:21'),(2,'30 Days',NULL,30,30,1,'2024-05-09 15:17:29','2024-05-09 15:18:26'),(3,'150 Days',NULL,300,150,1,'2024-05-09 15:18:44','2024-05-09 15:18:44');
/*!40000 ALTER TABLE `project_promote_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_sub_categories`
--

DROP TABLE IF EXISTS `project_sub_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `project_sub_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `project_id` bigint NOT NULL,
  `sub_category_id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=233 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_sub_categories`
--

LOCK TABLES `project_sub_categories` WRITE;
/*!40000 ALTER TABLE `project_sub_categories` DISABLE KEYS */;
INSERT INTO `project_sub_categories` VALUES (218,180,36,'2025-06-30 12:09:30','2025-06-30 12:09:30'),(219,181,20,'2025-07-02 01:12:11','2025-07-02 01:12:11'),(220,181,21,'2025-07-02 01:12:11','2025-07-02 01:12:11'),(221,182,1,'2025-10-13 23:23:21','2025-10-13 23:23:21'),(223,184,1,'2025-11-02 03:53:40','2025-11-02 03:53:40'),(224,185,21,'2025-11-02 04:06:29','2025-11-02 04:06:29'),(225,186,20,'2025-12-20 17:14:08','2025-12-20 17:14:08'),(228,189,21,'2026-01-19 17:26:50','2026-01-19 17:26:50'),(229,189,22,'2026-01-19 17:26:50','2026-01-19 17:26:50'),(230,190,20,'2026-01-20 03:41:23','2026-01-20 03:41:23'),(231,191,20,'2026-01-20 06:46:34','2026-01-20 06:46:34'),(232,192,21,'2026-01-22 11:14:06','2026-01-22 11:14:06');
/*!40000 ALTER TABLE `project_sub_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `projects` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `category_id` bigint NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `basic_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `standard_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `premium_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `basic_revision` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `standard_revision` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `premium_revision` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `basic_delivery` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `standard_delivery` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `premium_delivery` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `basic_regular_charge` double NOT NULL,
  `basic_discount_charge` double DEFAULT NULL,
  `standard_regular_charge` double DEFAULT NULL,
  `standard_discount_charge` double DEFAULT NULL,
  `premium_regular_charge` double DEFAULT NULL,
  `premium_discount_charge` double DEFAULT NULL,
  `project_on_off` tinyint NOT NULL DEFAULT '1' COMMENT '0=off, 1=on',
  `project_approve_request` tinyint NOT NULL DEFAULT '0' COMMENT '0=request for approve, 1=approve,2=2 will change to 0 when the user resubmit after rejected.',
  `status` tinyint NOT NULL DEFAULT '0' COMMENT 'o=pending, 1=approve',
  `is_pro` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pro_expire_date` timestamp NULL DEFAULT NULL,
  `offer_packages_available_or_not` int DEFAULT NULL,
  `meta_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `meta_tags` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `load_from` int NOT NULL DEFAULT '0',
  `is_synced` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=193 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (180,7,3,'thdişek rllejjr ejkrldk nprnpnrpn lrjpnrpnrpn lnrpnrpnpr p','slugslugslugslugslugslugsluganother-project-create-as-a-freelancer-by-client','Just testingkjşjronrpnpn. Pj8ej8 rp p e8j r jprj p jşj is ğ. İs ğdj şjğejğ. Jp ğj pj eğjğe pj pj j pepjğjş. Şfjpnş pfhpf ğ jdlh şjpjpjdplnlnl ld lnfohrlnpfnpf l flbpndl dl dlhpdblblgpfnlf lf lnflbrpnflbfpjpdnl el rhpd lr lrnobrl el lrnobrpnrpnpjrpgodnpd l dlbdpndl dlbprhpr lr l flbprnpr şe phrpjflnfpnfl if şfnpfnş fş fl fl flbpbdpndl dlbdplşrnl','1751306970-6862d2da422ef.jpg','Basic','Standard','premium','4','4','4','1 Days','1 Days','1 Days',10,9,10,9,10,9,1,0,0,NULL,NULL,1,NULL,NULL,NULL,0,0,'2025-06-30 12:09:30','2025-06-30 12:09:30'),(181,7,2,'lborbo el eobohrp penlbıbdl ld lbobrş if l dlnpnşmdl lbıf','slugslugslugslugslugslugslugsluganother-project-create-as-a-freelancer-by-client','Pjld ş elbondl kbobonrl l gl gl gl do p l l lbdl fl lbıbpmfğkpdnl dl dlndpndl l lbornşnrş fl dl lnohşdmid ş dl dlnpdmşd öd şdnondp dş dl ro dl dş ld lbhohdl ld l dlnrpnld l el robl dşnpjfpnld l flnfpnpf şf lf lf lf lnohofnpr lhhhjllşghh','1751440331-6864dbcb903d6.jpg','Basic',NULL,NULL,'4',NULL,NULL,'1 Days',NULL,NULL,10,9,NULL,NULL,NULL,NULL,1,1,0,NULL,NULL,0,NULL,NULL,NULL,0,0,'2025-07-02 01:12:11','2025-09-09 03:39:19'),(182,7,1,'works hijvjk calf muscle to bone i','slugslugslugslugslugslugslugslugsluganother-project-create-as-a-freelancer-by-clientis-pro-projectfalse','just normal diff size of the teaching me how to do it I want to see if i will be a bit late today so I am going to be true lagtgyo you are doing well and i want to go to next year I am not quite sure what is going','1760419401-68edde4985988.jpg','Basic',NULL,NULL,'4','4','4','less than a week','1 Days','1 Days',10,9,NULL,NULL,NULL,NULL,0,0,0,NULL,NULL,0,NULL,NULL,NULL,0,0,'2025-10-13 23:23:21','2025-10-15 05:20:19'),(184,7,1,'HireTheBestHireTheBest','hirethebesthirethebest','<p>HireTheBestHireHireTheBestHireTheBestHireTheBest</p>','[\"1766983612-695207bc0cd08.png\",\"1766983612-695207bc2be2e.png\",\"1766983612-695207bc60c5a.png\",\"1766983612-695207bc91763.png\"]','Basic','Standard','Premium','1','1','1','1 Days','1 Days','1 Days',20,10,60,50,70,60,1,1,1,NULL,NULL,1,NULL,NULL,NULL,0,0,'2025-11-02 03:53:40','2025-12-29 03:46:52'),(185,7,2,'responsive web application9996','responsive-web-application9996','<p>responsive web application9996responsive web application9996responsive web application9996responsive web application9996responsive web application9996</p>','1762077989-69072d251f374.png','Basic','Standard','Premium','1','1','1','1 Days','1 Days','1 Days',50,10,60,50,70,60,1,1,1,NULL,NULL,1,NULL,NULL,NULL,0,0,'2025-11-02 04:06:29','2025-11-02 04:06:58'),(186,7,2,'Nothing At All Uuuuu','slugresponsive-web-application9996is-pro-projectfalse','Just Nothing and Nothing&nbsp;and Nothing&nbsp;and Nothing&nbsp;and Nothing and Nothing&nbsp;','1766254448-6946e77012584.png','Basic',NULL,NULL,'4','4','4','1 Days','1 Days','1 Days',10,9,NULL,NULL,NULL,NULL,1,0,0,'yes','2026-01-30 04:06:05',0,NULL,NULL,NULL,0,0,'2025-12-20 17:14:08','2026-01-20 04:06:06'),(189,7,2,'I will do software development, custom website backend, front end web develope','i-will-do-software-development-custom-website-backend-front-end-web-develope','<p>About this gig</p><p>Need a top-notch Web Developer to turn your vision into a stunning reality? Let\'s make it happen!</p><p><br></p><p><br></p><p><br></p><p>I\'m Jubayer, specializing in transforming creative visions into fully functional, high-performance websites front end and back end. I have expertise in modern technologies like PHP, Laravel, Next.js, React.js, TailwindCSS, TypeScript, HTML5, CSS3, and more. I\'m here to build your web solution that stands out and performs flawlessly.</p><p><br></p><p><br></p><p><br></p><p>Whether you need a dynamic single-page application or a complex multi-page website, I bring a user-centric approach that ensures your site looks impressive and delivers a seamless experience.&nbsp;</p><p><br></p><p><br></p><p><br></p><p>I focus on design details, performance optimization, and code quality to ensure your site is fast, visually precise, responsive, and easy to maintain.</p><p><br></p><p><br></p><p><br></p><p><br></p><p><br></p><p>What I Offer:</p><p><br></p><p><br></p><p><br></p><p>- Responsive Front End Development</p><p><br></p><p>- Clean Layouts</p><p><br></p><p>- Custom Website Solutions</p><p><br></p><p>- SEO Optimization</p><p><br></p><p>- API Integration &amp; Deployment</p><p><br></p><p><br></p><p><br></p><p>Why Choose Me?</p><p><br></p><p><br></p><p><br></p><p>Quick project completion</p><p>Premium customer service</p><p><br></p><p><br></p><p>Get in touch with me to embark on your app development journey!</p>','[\"1768847210-696e776a98320.jpeg\",\"1768847210-696e776aab607.jpeg\",\"1768847210-696e776ab7960.png\"]','Basic','Standard','Premium','1','3','1000','1 Days','1 Days','1 Days',50,40,60,50,70,60,1,1,1,'yes','2026-01-30 04:05:17',1,NULL,'I\'m Jubayer, specializing in transforming creative visions into fully functional, high-performance websites front end and back end. I have expertise in modern technologies like PHP, Laravel, Next.js, React.js, TailwindCSS, TypeScript, HTML5, CSS3, and more. I\'m here to build your web solution that stands out and performs flawlessly.',NULL,0,0,'2026-01-19 17:26:50','2026-01-20 04:05:30'),(190,7,2,'Image Testing Image Testing','image-testing-image-testing','<p>Image Testing Image TestingImage Testing Image TestingImage Testing Image TestingImage Testing Image TestingImage Testing Image TestingImage Testing Image TestingImage Testing Image TestingImage Testing Image TestingImage Testing Image TestingImage Testing Image TestingImage Testing Image TestingImage Testing Image Testing</p>','[\"1768884082-696f0772a224d.png\",\"1768884082-696f0772de6ce.png\"]','Basic','Standard','Premium','1','1','1','1 Days','1 Days','1 Days',50,40,60,50,70,60,1,1,1,'yes','2026-01-30 04:02:47',1,NULL,NULL,NULL,0,0,'2026-01-20 03:41:23','2026-01-20 04:02:48'),(191,7,2,'Image Testing Image Testing33','image-testing-image-testing33','<p>Image Testing Image Testing33Image Testing Image Testing33Image Testing Image Testing33Image Testing Image Testing33</p>','[\"1768895194-696f32da218bb.mp4\",\"1768895194-696f32da22173.jpg\"]','Basic','Standard','Premium','1','1','1','1 Days','1 Days','1 Days',50,40,60,50,70,60,1,1,1,NULL,NULL,1,NULL,NULL,NULL,0,0,'2026-01-20 06:46:34','2026-01-20 06:46:34'),(192,7,2,'Final Checking Final Checking','final-checking-final-checking','<p>Final Checking Final CheckingFinal Checking Final CheckingFinal Checking Final CheckingFinal Checking Final CheckingFinal Checking Final CheckingFinal Checking Final CheckingFinal Checking Final CheckingFinal Checking Final CheckingFinal Checking Final CheckingFinal Checking Final CheckingFinal Checking Final CheckingFinal Checking Final Checking</p>','[\"1769084043-6972148be271f.mp4\",\"1769084043-6972148be397f.png\"]','Basic','Standard','Premium','1','1','1','1 Days','1 Days','1 Days',50,40,60,50,70,60,1,1,1,NULL,NULL,1,NULL,NULL,NULL,0,0,'2026-01-22 11:14:06','2026-01-22 11:14:40');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promotion_project_lists`
--

DROP TABLE IF EXISTS `promotion_project_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `promotion_project_lists` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `identity` bigint DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'project,profile,proposal',
  `package_id` int NOT NULL,
  `price` double NOT NULL DEFAULT '0',
  `transaction_fee` double DEFAULT NULL,
  `duration` bigint NOT NULL DEFAULT '0',
  `expire_date` timestamp NULL DEFAULT NULL,
  `payment_gateway` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_valid_payment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `email_send` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manual_payment_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `impression` int NOT NULL DEFAULT '0',
  `click` int NOT NULL DEFAULT '0',
  `country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promotion_project_lists`
--

LOCK TABLES `promotion_project_lists` WRITE;
/*!40000 ALTER TABLE `promotion_project_lists` DISABLE KEYS */;
/*!40000 ALTER TABLE `promotion_project_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question_answers`
--

DROP TABLE IF EXISTS `question_answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `question_answers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `question` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
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
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `question_tip_id` bigint NOT NULL,
  `answer_id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `status` int DEFAULT NULL COMMENT '0 for inactive, 1 for active',
  `like` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `haha` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `up` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sad` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `support` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `congrats` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `question_tip_id` bigint DEFAULT NULL,
  `user_id` bigint NOT NULL,
  `answer_id` bigint NOT NULL,
  `reply` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `question_tip_id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `answer` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_answer_id` bigint unsigned DEFAULT NULL,
  `is_author_reply` int NOT NULL DEFAULT '0',
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
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `question_tip_id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `status` int DEFAULT NULL COMMENT '0 for inactive, 1 for active',
  `like` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `haha` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `up` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sad` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `support` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `congrats` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `vote` bigint NOT NULL DEFAULT '0',
  `question_user_id` bigint NOT NULL,
  `status` int NOT NULL DEFAULT '0' COMMENT '0 for inactive, 1 for active',
  `like` bigint NOT NULL DEFAULT '0',
  `haha` bigint NOT NULL DEFAULT '0',
  `up` bigint NOT NULL DEFAULT '0',
  `sad` bigint NOT NULL DEFAULT '0',
  `support` bigint NOT NULL DEFAULT '0',
  `congrats` bigint NOT NULL DEFAULT '0',
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
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `rating_id` bigint NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'skill,availability,communication,deadline,quality,co-operation',
  `rating` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rating_details`
--

LOCK TABLES `rating_details` WRITE;
/*!40000 ALTER TABLE `rating_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `rating_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ratings`
--

DROP TABLE IF EXISTS `ratings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ratings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint NOT NULL,
  `sender_id` bigint NOT NULL,
  `sender_type` tinyint NOT NULL COMMENT '1=client, 2=freelancer',
  `rating` double NOT NULL,
  `review_feedback` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ratings`
--

LOCK TABLES `ratings` WRITE;
/*!40000 ALTER TABLE `ratings` DISABLE KEYS */;
/*!40000 ALTER TABLE `ratings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reports` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint DEFAULT NULL,
  `client_id` bigint NOT NULL,
  `freelancer_id` bigint NOT NULL,
  `reporter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'freelancer, client',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
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
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
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
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `skill` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_category_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0=inactive 1=active',
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
INSERT INTO `skills` VALUES (1,'Android','4',NULL,1,'2023-02-08 22:31:43','2023-09-18 00:43:23'),(2,'Firebase on Android','4','6',1,'2023-02-08 22:41:05','2023-02-08 22:41:05'),(3,'Android foundations','4','6',1,'2023-02-08 22:42:43','2023-02-08 22:42:43'),(4,'Php','2','20',1,'2023-02-08 22:49:30','2023-02-08 22:49:30'),(6,'Javascript','2',NULL,1,'2023-02-08 23:00:58','2023-02-08 23:00:58'),(7,'HTML','2',NULL,1,'2023-02-08 23:03:02','2023-11-05 22:58:25'),(10,'Jquery','2',NULL,1,'2023-02-08 23:03:48','2023-02-08 23:03:48'),(20,'CSS','2',NULL,1,'2023-11-05 22:56:47','2023-11-05 22:56:47'),(21,'Bootstrap','2',NULL,1,'2023-11-05 22:57:04','2023-11-05 22:57:04'),(22,'Vue JS','2',NULL,1,'2023-11-05 22:57:24','2023-11-05 22:57:24'),(23,'Laravel','2',NULL,1,'2023-11-05 22:57:38','2023-11-05 22:57:38'),(24,'React','2',NULL,1,'2023-11-05 22:57:51','2023-11-05 22:57:51'),(25,'NodeJS','2',NULL,1,'2023-11-05 22:58:13','2023-11-05 22:58:13'),(26,'Ajax','2',NULL,1,'2023-11-05 23:13:28','2023-11-05 23:25:00'),(27,'Rest API','2',NULL,1,'2023-11-05 23:13:41','2023-11-05 23:13:41'),(28,'Logo Design','1','2',1,'2023-11-05 23:32:46','2023-11-05 23:33:05'),(29,'Graphic Design','1','2',1,'2023-11-05 23:33:35','2023-11-05 23:33:35'),(30,'Photoshop','1','2',1,'2023-11-05 23:34:30','2023-11-05 23:34:30'),(31,'Illustrator','1',NULL,1,'2023-11-05 23:34:43','2023-11-05 23:34:43'),(32,'3D Design','1',NULL,1,'2023-11-05 23:34:58','2023-11-05 23:34:58'),(33,'UI/UX Design','1',NULL,1,'2023-11-05 23:42:26','2023-11-05 23:42:26'),(34,'eCommerce','2',NULL,1,'2023-11-05 23:42:50','2023-11-05 23:42:50'),(35,'Mobile App Development','4',NULL,1,'2023-11-06 00:01:56','2023-11-06 00:01:56'),(36,'Software Architecture','2',NULL,1,'2023-11-06 00:02:14','2023-11-06 00:02:14'),(37,'Article Writing','13','26',1,'2023-11-06 00:18:01','2023-11-06 00:18:01'),(38,'Technical Writing','13',NULL,1,'2023-11-06 00:18:20','2023-11-06 00:18:20'),(39,'Data Entry','13',NULL,1,'2023-11-06 00:18:36','2023-11-06 00:18:36'),(40,'Copy Writing','13',NULL,1,'2023-11-06 00:19:29','2023-11-06 00:19:29'),(41,'Content Writing','13',NULL,1,'2023-11-06 00:25:10','2023-11-06 00:25:10'),(42,'Blog','13',NULL,1,'2023-11-06 00:25:26','2023-11-06 00:25:26'),(43,'Accounting','11',NULL,1,'2023-11-06 00:31:19','2023-11-06 00:31:19'),(44,'Sales','11',NULL,1,'2023-11-06 00:31:35','2023-11-06 00:31:35'),(45,'Digital Marketing','11',NULL,1,'2023-11-06 00:31:57','2023-11-06 00:31:57'),(46,'Research','9',NULL,1,'2023-11-06 00:40:36','2023-11-06 00:40:36'),(47,'Market Research','9',NULL,1,'2023-11-06 00:40:59','2023-11-06 00:40:59'),(48,'Internet marketing','9',NULL,1,'2023-11-06 00:41:18','2023-11-06 00:41:18'),(49,'Customer Service','3',NULL,1,'2023-11-06 00:56:09','2023-11-06 00:56:09'),(50,'English Translator','3',NULL,1,'2023-11-06 00:56:53','2023-11-06 00:56:53'),(51,'Spanish Translator','3',NULL,1,'2023-11-06 00:57:12','2023-11-06 00:57:12'),(52,'English Teaching','5',NULL,1,'2023-11-06 01:16:19','2023-11-06 01:16:19'),(53,'English Grammer','5',NULL,1,'2023-11-06 01:16:43','2023-11-06 01:16:43'),(54,'English Tutoring','5',NULL,1,'2023-11-06 01:17:00','2023-11-06 01:17:00'),(55,'Education','5',NULL,1,'2023-11-06 01:20:07','2023-11-06 01:20:07'),(56,'SEO','11',NULL,1,'2023-11-06 02:01:16','2023-11-06 02:01:16'),(57,'Serach Engine marketing','11',NULL,1,'2023-11-06 02:02:18','2023-11-06 02:02:18');
/*!40000 ALTER TABLE `skills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `states` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `country_id` int DEFAULT NULL,
  `state` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0=inactive 1=active',
  `timezone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `states`
--

LOCK TABLES `states` WRITE;
/*!40000 ALTER TABLE `states` DISABLE KEYS */;
INSERT INTO `states` VALUES (24,15,'Bursa',1,'Europe/Istanbul','2026-03-25 17:26:31','2026-03-25 17:26:31');
/*!40000 ALTER TABLE `states` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `static_options`
--

DROP TABLE IF EXISTS `static_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `static_options` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `option_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=476 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `static_options`
--

LOCK TABLES `static_options` WRITE;
/*!40000 ALTER TABLE `static_options` DISABLE KEYS */;
INSERT INTO `static_options` VALUES (1,'site_title','Xilancer','2022-12-10 01:37:26','2023-11-13 07:45:07'),(2,'site_footer_copyright','{copy}  {year}  All right reserved by  <a href=\"https://xilancer.xgenious.com/\">xgenious</a>','2022-12-10 01:37:26','2023-11-13 07:45:07'),(3,'disable_user_email_verify','on','2022-12-10 01:37:26','2023-11-13 07:45:07'),(4,'site_maintenance_mode',NULL,'2022-12-10 01:37:26','2023-11-13 07:45:07'),(5,'admin_loader_animation',NULL,'2022-12-10 01:37:26','2023-11-13 07:45:07'),(6,'site_loader_animation','on','2022-12-10 01:37:26','2023-11-13 07:45:07'),(7,'site_force_ssl_redirection',NULL,'2022-12-10 01:37:26','2023-11-13 07:45:07'),(8,'site_google_captcha_enable','on','2022-12-10 01:37:26','2023-11-13 07:45:07'),(9,'site_logo','300','2022-12-11 23:42:42','2026-01-18 09:25:14'),(10,'site_favicon','303','2022-12-11 23:42:42','2026-01-18 09:25:14'),(11,'site_main_color_one','#9c3030','2022-12-12 00:51:22','2022-12-12 00:51:48'),(12,'site_main_color_two','#000000','2022-12-12 00:51:22','2022-12-12 00:51:48'),(13,'site_main_color_three','#4b1111','2022-12-12 00:51:22','2022-12-12 00:51:48'),(14,'heading_color','#1D2635','2022-12-12 00:51:22','2026-01-08 10:19:52'),(15,'light_color','#a04eb7','2022-12-12 00:51:22','2022-12-12 00:51:48'),(16,'extra_light_color','#000000','2022-12-12 00:51:22','2022-12-12 00:51:48'),(17,'body_font_family','Poppins','2022-12-12 05:19:22','2026-01-08 10:21:56'),(18,'heading_font_family','Poppins','2022-12-12 05:19:22','2026-01-08 10:21:56'),(19,'extra_body_font',NULL,'2022-12-12 05:19:22','2026-01-08 10:21:56'),(20,'heading_font','on','2022-12-12 05:19:22','2026-01-08 10:21:56'),(21,'body_font_variant','a:9:{i:0;s:5:\"0,100\";i:1;s:5:\"0,200\";i:2;s:5:\"0,300\";i:3;s:5:\"0,400\";i:4;s:5:\"0,500\";i:5;s:5:\"0,600\";i:6;s:5:\"0,700\";i:7;s:5:\"0,800\";i:8;s:5:\"0,900\";}','2022-12-12 05:19:22','2026-01-08 10:21:56'),(22,'heading_font_variant','a:9:{i:0;s:5:\"0,100\";i:1;s:5:\"0,200\";i:2;s:5:\"0,300\";i:3;s:5:\"0,400\";i:4;s:5:\"0,500\";i:5;s:5:\"0,600\";i:6;s:5:\"0,700\";i:7;s:5:\"0,800\";i:8;s:5:\"0,900\";}','2022-12-12 05:19:22','2026-01-08 10:21:56'),(23,'site_meta_tags','fds sdsdf sdf sdf ,sdf sdf sdf sdf sdfsd ,sdf sdf sdf sd','2022-12-13 00:03:23','2022-12-13 00:03:23'),(24,'site_meta_description','Xilancr market place','2022-12-13 00:03:23','2022-12-13 00:03:23'),(25,'og_meta_title','Xilancr market place','2022-12-13 00:03:23','2022-12-13 00:03:23'),(26,'og_meta_description','Xilancr market place','2022-12-13 00:03:23','2022-12-13 00:03:23'),(27,'og_meta_site_name','Xilancr market place','2022-12-13 00:03:23','2022-12-13 00:03:23'),(28,'og_meta_url','Xilancr market place','2022-12-13 00:03:24','2022-12-13 00:03:24'),(29,'og_meta_image','2','2022-12-13 00:03:24','2022-12-13 00:03:24'),(30,'site_third_party_tracking_code',NULL,'2022-12-13 01:46:32','2022-12-13 04:41:00'),(31,'site_google_analytics',NULL,'2022-12-13 01:46:32','2022-12-13 04:41:00'),(32,'site_google_captcha_v3_site_key','6LcJtlYpAAAAAAZAJk7pjWKhz09FRSWLCYyKVpAd','2022-12-13 01:46:32','2024-01-27 06:49:27'),(33,'site_google_captcha_v3_secret_key','6LcJtlYpAAAAAENuELMZG9N3UqUak0bV0IvioEHA','2022-12-13 01:46:32','2024-01-27 06:49:27'),(34,'tawk_api_key',NULL,'2022-12-13 01:46:32','2022-12-13 04:41:00'),(35,'facebook_client_id','713291307367672','2022-12-13 04:59:55','2024-03-10 14:52:54'),(36,'facebook_client_secret','5ec25da1868a7b58b838850570b90c08','2022-12-13 04:59:55','2024-03-10 14:52:54'),(37,'google_client_id','483808191107-sjonvl0tg80j1mk63i8tsjdub7ql9v4a.apps.googleusercontent.com','2022-12-13 04:59:55','2024-03-10 14:52:54'),(38,'google_client_secret','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','2022-12-13 04:59:55','2024-03-10 14:52:54'),(39,'site_global_email','info@xilancer.xgenious.com','2022-12-13 07:46:18','2026-01-20 03:53:30'),(40,'site_global_email_template','<p>sdf sdf sdf sdf sdfs dsdf sdf&nbsp;</p>','2022-12-13 07:46:18','2026-01-20 03:53:30'),(41,'site_smtp_mail_mailer','smtp','2022-12-14 00:53:07','2026-01-20 03:58:52'),(42,'site_smtp_mail_host','smtp.gmail.com','2022-12-14 00:53:07','2026-01-20 03:58:52'),(43,'site_smtp_mail_port','587','2022-12-14 00:53:07','2026-01-20 03:58:52'),(44,'site_smtp_mail_username','info@xilancer.xgenious.com','2022-12-14 00:53:07','2026-01-20 03:58:52'),(45,'site_smtp_mail_password','12345678','2022-12-14 00:53:07','2026-01-20 03:58:52'),(46,'site_smtp_mail_encryption','tls','2022-12-14 00:53:07','2026-01-20 03:58:52'),(47,'site_gdpr_cookie_title','Cookies & Privacy','2022-12-15 03:19:57','2026-01-19 10:04:22'),(48,'site_gdpr_cookie_message','Is education residence conveying so so. Suppose shyness say ten behaved morning had. Any unsatiable assistance compliment occasional too reasonably advantages.','2022-12-15 03:19:57','2026-01-19 10:04:22'),(49,'site_gdpr_cookie_more_info_label','More information','2022-12-15 03:19:57','2026-01-19 10:04:22'),(50,'site_gdpr_cookie_more_info_link','{url}/privacy-policy','2022-12-15 03:19:57','2026-01-19 10:04:22'),(51,'site_gdpr_cookie_accept_button_label','Accept','2022-12-15 03:19:57','2026-01-19 10:04:22'),(52,'site_gdpr_cookie_decline_button_label','Decline','2022-12-15 03:19:57','2026-01-19 10:04:22'),(53,'site_gdpr_cookie_manage_button_label','Manage','2022-12-15 03:19:57','2026-01-19 10:04:22'),(54,'site_gdpr_cookie_manage_title',NULL,'2022-12-15 03:19:57','2026-01-19 10:04:22'),(55,'site_gdpr_cookie_manage_item_title','a:2:{i:0;s:4:\"test\";i:1;s:8:\"yr dfdfg\";}','2022-12-15 03:19:57','2026-01-19 10:04:22'),(56,'site_gdpr_cookie_manage_item_description','a:2:{i:0;s:14:\"sadas dsa asda\";i:1;s:61:\"fg dfg dfgdf dfgdfg dfg dfg dfg dfg dfg dfg dfg dfgdfgdfg d d\";}','2022-12-15 03:19:57','2026-01-19 10:04:22'),(57,'site_gdpr_cookie_delay','3000','2022-12-15 03:19:57','2026-01-19 10:04:22'),(58,'site_gdpr_cookie_enabled','on','2022-12-15 03:19:57','2026-01-19 10:04:22'),(59,'site_gdpr_cookie_expire','30','2022-12-15 03:19:57','2026-01-19 10:04:22'),(60,'global_navbar_variant','04','2022-12-15 07:08:00','2025-12-28 05:28:17'),(61,'global_footer_variant','03','2022-12-17 23:45:33','2026-01-20 17:27:56'),(62,'paypal_preview_logo','198','2022-12-20 01:33:51','2025-03-24 00:00:18'),(63,'paypal_mode',NULL,'2022-12-20 01:33:51','2023-04-09 22:54:08'),(64,'paypal_sandbox_client_id','AUP7AuZMwJbkee-2OmsSZrU-ID1XUJYE-YB-2JOrxeKV-q9ZJZYmsr-UoKuJn4kwyCv5ak26lrZyb-gb','2022-12-20 01:33:51','2025-03-24 00:00:18'),(65,'paypal_sandbox_client_secret','EEIxCuVnbgING9EyzcF2q-gpacLneVbngQtJ1mbx-42Lbq-6Uf6PEjgzF7HEayNsI4IFmB9_CZkECc3y','2022-12-20 01:33:51','2025-03-24 00:00:18'),(66,'paypal_sandbox_app_id','641651651958','2022-12-20 01:33:51','2025-03-24 00:00:18'),(67,'paypal_live_app_id','Test','2022-12-20 01:33:51','2025-03-24 00:00:18'),(68,'paypal_payment_action',NULL,'2022-12-20 01:33:51','2025-03-24 00:00:18'),(69,'paypal_currency',NULL,'2022-12-20 01:33:51','2025-03-24 00:00:18'),(70,'paypal_notify_url',NULL,'2022-12-20 01:33:51','2025-03-24 00:00:18'),(71,'paypal_locale',NULL,'2022-12-20 01:33:51','2025-03-24 00:00:18'),(72,'paypal_validate_ssl',NULL,'2022-12-20 01:33:52','2025-03-24 00:00:18'),(73,'paypal_live_client_id','Test','2022-12-20 01:33:52','2025-03-24 00:00:18'),(74,'paypal_live_client_secret','Test','2022-12-20 01:33:52','2025-03-24 00:00:18'),(75,'paypal_gateway','on','2022-12-20 01:33:52','2025-03-24 00:00:18'),(76,'paypal_test_mode','on','2022-12-20 01:33:52','2025-03-24 00:00:18'),(77,'razorpay_preview_logo','194','2022-12-20 01:56:54','2025-03-24 00:00:18'),(78,'razorpay_key',NULL,'2022-12-20 01:56:54','2025-03-24 00:00:18'),(79,'razorpay_secret',NULL,'2022-12-20 01:56:54','2025-03-24 00:00:18'),(80,'razorpay_api_key','rzp_test_SXk7LZqsBPpAkj','2022-12-20 01:56:54','2025-03-24 00:00:18'),(81,'razorpay_api_secret','Nenvq0aYArtYBDOGgmMH7JNv','2022-12-20 01:56:54','2025-03-24 00:00:18'),(82,'razorpay_gateway','on','2022-12-20 01:56:54','2025-03-24 00:00:18'),(83,'stripe_preview_logo','195','2022-12-20 01:56:54','2025-03-24 00:00:18'),(84,'stripe_publishable_key',NULL,'2022-12-20 01:56:54','2025-03-24 00:00:18'),(85,'stripe_secret_key','sk_test_51GwS1SEmGOuJLTMs2vhSliTwAGkOt4fKJMBrxzTXeCJoLrRu8HFf4I0C5QuyE3l3bQHBJm3c0qFmeVjd0V9nFb6Z00VrWDJ9Uw','2022-12-20 01:56:54','2025-03-24 00:00:18'),(86,'stripe_public_key','pk_test_51GwS1SEmGOuJLTMsIeYKFtfAT3o3Fc6IOC7wyFmmxA2FIFQ3ZigJ2z1s4ZOweKQKlhaQr1blTH9y6HR2PMjtq1Rx00vqE8LO0x','2022-12-20 01:56:54','2025-03-24 00:00:18'),(87,'stripe_gateway','on','2022-12-20 01:56:55','2025-03-24 00:00:18'),(88,'paytm_gateway','on','2022-12-20 01:56:55','2025-03-24 00:00:18'),(89,'paytm_preview_logo','196','2022-12-20 01:56:55','2025-03-24 00:00:18'),(90,'paytm_merchant_key','dv0XtmsPYpewNag','2022-12-20 01:56:55','2025-03-24 00:00:18'),(91,'paytm_merchant_mid','Digita57697814558795','2022-12-20 01:56:55','2025-03-24 00:00:18'),(92,'paytm_merchant_website','WEBSTAGING','2022-12-20 01:56:55','2025-03-24 00:00:18'),(93,'paytm_test_mode','on','2022-12-20 01:56:55','2025-03-24 00:00:18'),(94,'paystack_merchant_email','xgeniousteam@gmail.com','2022-12-20 01:56:55','2025-03-24 00:00:18'),(95,'paystack_preview_logo','192','2022-12-20 01:56:55','2025-03-24 00:00:18'),(96,'paystack_public_key','pk_test_7c6f87613b4dc1514acc3875998ba4f3a12bfda7','2022-12-20 01:56:55','2025-03-24 00:00:18'),(97,'paystack_secret_key','sk_test_0ec08da7d5d342774eaa3779ff37004a1fbda6c4','2022-12-20 01:56:55','2025-03-24 00:00:18'),(98,'paystack_gateway','on','2022-12-20 01:56:55','2025-03-24 00:00:18'),(99,'mollie_preview_logo','197','2022-12-20 01:56:55','2025-03-24 00:00:18'),(100,'mollie_public_key','test_fVk76gNbAp6ryrtRjfAVvzjxSHxC2v','2022-12-20 01:56:55','2025-03-24 00:00:18'),(101,'mollie_gateway','on','2022-12-20 01:56:55','2025-03-24 00:00:18'),(102,'marcado_pagp_client_id',NULL,'2022-12-20 01:56:55','2023-04-09 22:54:10'),(103,'marcado_pago_client_secret',NULL,'2022-12-20 01:56:55','2023-04-09 22:54:10'),(104,'marcado_pago_test_mode',NULL,'2022-12-20 01:56:55','2023-04-09 22:54:10'),(105,'cash_on_delivery_gateway',NULL,'2022-12-20 01:56:55','2025-03-24 00:00:18'),(106,'cash_on_delivery_preview_logo',NULL,'2022-12-20 01:56:55','2025-03-24 00:00:18'),(107,'flutterwave_preview_logo','193','2022-12-20 01:56:55','2025-03-24 00:00:18'),(108,'flutterwave_gateway','on','2022-12-20 01:56:55','2025-03-24 00:00:18'),(109,'flw_public_key','86cce2ec43c63e09a517290a8347fcab','2022-12-20 01:56:56','2025-03-24 00:00:18'),(110,'flw_secret_key','d37a42d8917db84f1b2f47c125252d0a','2022-12-20 01:56:56','2025-03-24 00:00:18'),(111,'flw_secret_hash',NULL,'2022-12-20 01:56:56','2025-03-24 00:00:18'),(112,'midtrans_preview_logo','187','2022-12-20 01:56:56','2025-03-24 00:00:18'),(113,'midtrans_merchant_id',NULL,'2022-12-20 01:56:56','2025-03-24 00:00:18'),(114,'midtrans_server_key','SB-Mid-server-9z5jztsHyYxEdSs7DgkNg2on','2022-12-20 01:56:56','2025-03-24 00:00:18'),(115,'midtrans_client_key','SB-Mid-client-iDuy-jKdZHkLjL_I','2022-12-20 01:56:56','2025-03-24 00:00:18'),(116,'midtrans_environment',NULL,'2022-12-20 01:56:56','2025-03-24 00:00:18'),(117,'midtrans_gateway','on','2022-12-20 01:56:56','2025-03-24 00:00:18'),(118,'midtrans_test_mode','on','2022-12-20 01:56:56','2025-03-24 00:00:18'),(119,'payfast_preview_logo','188','2022-12-20 01:56:56','2025-03-24 00:00:18'),(120,'payfast_merchant_id','10024000','2022-12-20 01:56:56','2025-03-24 00:00:18'),(121,'payfast_merchant_key','77jcu5v4ufdod','2022-12-20 01:56:56','2025-03-24 00:00:18'),(122,'payfast_passphrase','testpayfastsohan','2022-12-20 01:56:56','2025-03-24 00:00:18'),(123,'payfast_merchant_env',NULL,'2022-12-20 01:56:56','2025-03-24 00:00:18'),(124,'payfast_itn_url',NULL,'2022-12-20 01:56:56','2025-03-24 00:00:18'),(125,'payfast_gateway','on','2022-12-20 01:56:56','2025-03-24 00:00:18'),(126,'cashfree_preview_logo','189','2022-12-20 01:56:56','2025-03-24 00:00:18'),(127,'cashfree_test_mode','on','2022-12-20 01:56:56','2025-03-24 00:00:18'),(128,'cashfree_app_id','94527832f47d6e74fa6ca5e3c72549','2022-12-20 01:56:56','2025-03-24 00:00:18'),(129,'cashfree_secret_key','ec6a3222018c676e95436b2e26e89c1ec6be2830','2022-12-20 01:56:56','2025-03-24 00:00:18'),(130,'cashfree_gateway','on','2022-12-20 01:56:56','2025-03-24 00:00:18'),(131,'instamojo_preview_logo','190','2022-12-20 01:56:57','2025-03-24 00:00:18'),(132,'instamojo_client_id','test_nhpJ3RvWObd3uryoIYF0gjKby5NB5xu6S9Z','2022-12-20 01:56:57','2025-03-24 00:00:18'),(133,'instamojo_client_secret','test_iZusG4P35maQVPTfqutbCc6UEbba3iesbCbrYM7zOtDaJUdbPz76QOnBcDgblC53YBEgsymqn2sx3NVEPbl3b5coA3uLqV1ikxKquOeXSWr8Ruy7eaKUMX1yBbm','2022-12-20 01:56:57','2025-03-24 00:00:18'),(134,'instamojo_username',NULL,'2022-12-20 01:56:57','2025-03-24 00:00:18'),(135,'instamojo_password',NULL,'2022-12-20 01:56:57','2025-03-24 00:00:19'),(136,'instamojo_test_mode','on','2022-12-20 01:56:57','2025-03-24 00:00:19'),(137,'instamojo_gateway','on','2022-12-20 01:56:57','2025-03-24 00:00:19'),(138,'marcadopago_preview_logo','191','2022-12-20 01:56:57','2025-03-24 00:00:19'),(139,'marcado_pago_client_id','TEST-0a3cc78a-57bf-4556-9dbe-2afa06347769','2022-12-20 01:56:57','2023-04-10 21:43:47'),(140,'marcadopago_gateway','on','2022-12-20 01:56:57','2025-03-24 00:00:19'),(141,'marcadopago_test_mode','on','2022-12-20 01:56:57','2025-03-24 00:00:19'),(142,'zitopay_username','dvrobin4','2022-12-20 01:56:57','2025-03-24 00:00:19'),(143,'zitopay_preview_logo','182','2022-12-20 01:56:57','2025-03-24 00:00:19'),(144,'zitopay_gateway','on','2022-12-20 01:56:57','2025-03-24 00:00:19'),(145,'zitopay_test_mode','on','2022-12-20 01:56:57','2025-03-24 00:00:19'),(146,'billplz_collection_name','kjj5ya006','2022-12-20 01:56:57','2025-03-24 00:00:19'),(147,'billplz_xsignature','S-HDXHxRJB-J7rNtoktZkKJg','2022-12-20 01:56:57','2025-03-24 00:00:19'),(148,'billplz_key','b2ead199-e6f3-4420-ae5c-c94f1b1e8ed6','2022-12-20 01:56:57','2025-03-24 00:00:19'),(149,'billplz_preview_logo','183','2022-12-20 01:56:57','2025-03-24 00:00:19'),(150,'billplz_gateway','on','2022-12-20 01:56:57','2025-03-24 00:00:19'),(151,'billplz_test_mode','on','2022-12-20 01:56:57','2025-03-24 00:00:19'),(152,'paytabs_region','GLOBAL','2022-12-20 01:56:57','2025-03-24 00:00:19'),(153,'paytabs_profile_id','96698','2022-12-20 01:56:57','2025-03-24 00:00:19'),(154,'paytabs_server_key','SKJNDNRHM2-JDKTZDDH2N-H9HLMJNJ2L','2022-12-20 01:56:58','2025-03-24 00:00:19'),(155,'paytabs_preview_logo','184','2022-12-20 01:56:58','2025-03-24 00:00:19'),(156,'paytabs_gateway','on','2022-12-20 01:56:58','2025-03-24 00:00:19'),(157,'paytabs_test_mode','on','2022-12-20 01:56:58','2025-03-24 00:00:19'),(158,'cinetpay_site_id','445160','2022-12-20 01:56:58','2025-03-24 00:00:19'),(159,'cinetpay_app_key','12912847765bc0db748fdd44.40081707','2022-12-20 01:56:58','2025-03-24 00:00:19'),(160,'cinetpay_preview_logo','185','2022-12-20 01:56:58','2025-03-24 00:00:19'),(161,'cinetpay_gateway','on','2022-12-20 01:56:58','2025-03-24 00:00:19'),(162,'cinetpay_test_mode','on','2022-12-20 01:56:58','2025-03-24 00:00:19'),(163,'squareup_application_id',NULL,'2022-12-20 01:56:58','2025-03-24 00:00:19'),(164,'squareup_location_id','LE9C12TNM5HAS','2022-12-20 01:56:58','2025-03-24 00:00:19'),(165,'squareup_access_token','EAAAEOuLQObrVwJvCvoio3H13b8Ssqz1ighmTBKZvIENW9qxirHGHkqsGcPBC1uN','2022-12-20 01:56:58','2025-03-24 00:00:19'),(166,'squareup_preview_logo','186','2022-12-20 01:56:58','2025-03-24 00:00:19'),(167,'squareup_gateway','on','2022-12-20 01:56:58','2025-03-24 00:00:19'),(168,'squareup_test_mode','on','2022-12-20 01:56:58','2025-03-24 00:00:19'),(169,'paytm_channel','WEB','2022-12-20 02:01:36','2025-03-24 00:00:18'),(170,'paytm_industry_type','Retail','2022-12-20 02:01:36','2025-03-24 00:00:18'),(171,'error_404_page_title','Page Not Found','2022-12-26 04:23:23','2023-11-19 07:18:47'),(172,'error_404_page_subtitle','Page Unavailable!!','2022-12-26 04:23:23','2023-11-19 07:18:47'),(173,'error_404_page_paragraph',NULL,'2022-12-26 04:23:23','2023-11-19 07:18:47'),(174,'error_404_page_button_text','Back To Home','2022-12-26 04:23:23','2023-11-19 07:18:47'),(175,'error_image','80','2022-12-26 04:23:23','2023-11-19 07:18:47'),(176,'maintain_page_title','Sorry  we are down for schedule maintenance right now !!','2022-12-26 05:51:02','2022-12-26 05:51:02'),(177,'maintain_page_description','Sorry  we are down for schedule maintenance right now !!','2022-12-26 05:51:02','2022-12-26 05:51:02'),(178,'maintenance_duration','2022-12-31','2022-12-26 05:51:02','2022-12-26 05:51:02'),(179,'maintain_page_logo','10','2022-12-26 05:51:02','2022-12-26 05:51:02'),(180,'professional_title','Tell us what professional title describes you?','2023-02-14 04:40:23','2023-04-02 22:32:36'),(181,'intro_title','Provide an intro about yourself','2023-02-14 04:40:23','2023-04-02 22:32:36'),(182,'experience_title','Tell us about your professional experiences(Experience)','2023-02-14 05:31:43','2023-04-02 22:03:58'),(183,'inner_title','Experience','2023-02-14 05:31:43','2023-02-14 05:32:10'),(184,'modal_title','Add Work Experience','2023-02-14 05:31:43','2023-02-14 05:32:10'),(185,'edit_modal_title','Edit Work Experience','2023-02-14 05:31:43','2023-02-14 05:32:10'),(186,'experience_inner_title','Work experience','2023-02-14 05:36:13','2023-04-02 22:03:58'),(187,'experience_modal_title','Add work experience','2023-02-14 05:36:13','2023-04-02 22:03:58'),(188,'experience_edit_modal_title','Edit work experience','2023-02-14 05:36:13','2023-04-02 22:03:59'),(189,'education_title','What’s your Educational Background?(Education)','2023-02-14 05:44:09','2023-04-02 22:04:04'),(190,'education_inner_title','Education','2023-02-14 05:44:09','2023-04-02 22:04:04'),(191,'education_modal_title','Educational background','2023-02-14 05:44:09','2023-04-02 22:04:04'),(192,'education_edit_modal_title','Edit educational background','2023-02-14 05:44:09','2023-04-02 22:04:04'),(193,'work_title','What kinds of services will you provide to clients?(Work)','2023-02-14 05:57:43','2023-04-02 22:04:09'),(194,'work_inner_title','Choose, what would you do?','2023-02-14 05:57:43','2023-04-02 22:04:09'),(195,'work_modal_title','Choose a service','2023-02-14 05:57:43','2023-04-02 22:04:09'),(196,'skill_title','Great! Now add some skills you have','2023-02-14 06:30:53','2023-04-02 22:04:14'),(197,'hourly_rate',NULL,'2023-02-14 06:40:13','2023-02-14 06:40:13'),(198,'profile_photo',NULL,'2023-02-14 06:40:13','2023-02-14 06:40:13'),(199,'hourly_rate_title','What is your hourly rate?','2023-02-14 06:41:09','2023-04-02 22:04:19'),(200,'profile_photo_title','Upload profile photo','2023-02-14 06:41:09','2023-04-02 22:04:19'),(201,'account_page_title','Setup Your Account','2023-02-14 22:59:23','2023-04-02 22:04:24'),(202,'account_page_skip_title','Skip','2023-02-14 22:59:23','2023-04-02 22:04:24'),(203,'account_page_back_button_title','Back','2023-02-14 22:59:23','2023-04-02 22:04:24'),(204,'introduction_menu_title','Introduction','2023-02-14 23:08:28','2023-04-02 22:32:36'),(205,'introduction_menu_sub_title','How do you professionally introduce yourself?','2023-02-14 23:08:28','2023-04-02 22:32:36'),(206,'experience_menu_title','Experience','2023-02-14 23:36:28','2023-04-02 22:03:58'),(207,'experience_menu_sub_title','Let clients know about your professional experiences.','2023-02-14 23:36:29','2023-04-02 22:03:58'),(208,'education_menu_title','Education','2023-02-14 23:36:50','2023-04-02 22:04:04'),(209,'education_menu_sub_title','How do you professionally introduce yourself?','2023-02-14 23:36:50','2023-04-02 22:04:04'),(210,'work_menu_title','Work','2023-02-14 23:37:33','2023-04-02 22:04:09'),(211,'work_menu_sub_title','Add the services and necessary skills you offer.','2023-02-14 23:37:33','2023-04-02 22:04:09'),(212,'skill_menu_title','Skills','2023-02-14 23:37:56','2023-04-02 22:04:14'),(213,'skill_menu_sub_title','Add the services and necessary skills you offer.','2023-02-14 23:37:56','2023-04-02 22:04:14'),(214,'hourly_rate_menu_title','Hourly Rate & Photo','2023-02-14 23:38:36','2023-04-02 22:04:19'),(215,'hourly_rate_menu_sub_title','Just add your Hourly Rate and Profile Photo to finish.','2023-02-14 23:38:36','2023-04-02 22:04:19'),(216,'user_identity_verify_subject','User identity verify request email','2023-02-16 02:31:58','2023-02-16 02:32:15'),(217,'user_identity_verify_message','<p>Hello,</p><p></p>You have a new request for user identity verification<p></p>','2023-02-16 02:31:58','2023-02-16 02:32:15'),(218,'user_info_update_subject','User Info Update Email','2023-02-18 04:51:23','2023-02-18 05:10:03'),(219,'user_info_update_message','<p>Hello @name,\r\n</p><p>Your information successfully updated</p><p>Username: @username</p><p> Email: @email</p><p>\r\n</p>','2023-02-18 04:51:23','2023-02-18 05:10:03'),(220,'user_identity_verify_confirm_subject','User Identity Verify Confirm','2023-02-20 01:38:44','2023-02-20 01:38:44'),(221,'user_identity_verify_confirm_message','<p>Hello @name,\r\n</p><p>Your identity verification successfully done. Now you are a verified user.\r\n</p><p>Username: @username\r\n</p><p>Email: @email</p><p>\r\n</p><p>\r\n</p><p>\r\n</p>','2023-02-20 01:38:45','2023-02-20 01:38:45'),(222,'user_identity_re_verify_subject','User Identity Reverification','2023-02-20 02:10:13','2023-02-20 02:10:13'),(223,'user_identity_re_verify_message','<p>Hello @name,\r\n</p><p>Your identity need to reverification for the following reasons.</p><ul><li>Face issue</li><li>ID issue</li></ul><p>Username: @username\r\n</p><p>Email: @email</p><p>\r\n</p><p>\r\n</p><p>\r\n</p>','2023-02-20 02:10:13','2023-02-20 02:10:13'),(224,'user_identity_decline_subject','User Identity Decline','2023-02-20 03:17:50','2023-02-20 03:36:03'),(225,'user_identity_decline_message','<p>Hello @name,\r\n</p><p>Your identity verification request decline for the bellow reasons</p><ul><li>&nbsp;image not si,ilar</li><li>number not match</li><li>email not match</li></ul><p>Username: @username\r\n</p><p>Email: @email</p><p>\r\n</p><p>\r\n</p><p>\r\n</p>','2023-02-20 03:17:50','2023-02-20 03:36:03'),(226,'user_password_change_subject','User Password Change Email','2023-02-21 22:53:34','2023-02-21 22:56:21'),(227,'user_password_change_message','<p>Hello @name,\r\n</p><p>Your password has been changed.\r\n</p><p>New password : @password</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p>','2023-02-21 22:53:34','2023-02-21 22:56:21'),(228,'user_status_active_subject','User Status Activate Email','2023-02-22 03:18:43','2023-02-22 03:18:43'),(229,'user_status_active_message','<p>Hello @name,\r\n</p><p>Your account status has been changed from inactive to active.</p><p>\r\n</p>','2023-02-22 03:18:43','2023-02-22 03:18:43'),(230,'user_status_inactive_subject','User Status Inactivate Email','2023-02-22 03:22:20','2023-02-22 03:22:20'),(231,'user_status_inactive_message','<p>Hello @name,\r\n</p><p>Your account status has been changed from active to inactive due to multiple violations of our community guidelines.</p><ul><li>test text</li><li>test text</li><li>test text</li><li>test text</li></ul><p>\r\n</p>','2023-02-22 03:22:20','2023-02-22 03:22:20'),(232,'user_register_subject','New User Register Email','2023-02-23 06:36:57','2024-01-30 04:23:56'),(233,'user_register_message','<p>Hello Admin,\r\n</p><p>New user just registered. Bello is the user details.</p><p><br></p><p>\r\n</p><p>Name : @name\r\n</p><p>Email: @email\r\n</p><p>Username: @username\r\n</p><p>User Type: @userType</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p>','2023-02-23 06:36:57','2024-01-30 04:23:56'),(234,'site_global_currency','USD','2023-03-06 06:48:47','2025-03-24 00:01:03'),(235,'enable_disable_decimal_point','enable','2023-03-06 07:51:22','2025-03-24 00:01:03'),(236,'site_currency_symbol_position','left','2023-03-06 07:51:22','2025-03-24 00:01:03'),(237,'site_default_payment_gateway','stripe','2023-03-06 07:51:22','2025-03-24 00:01:03'),(238,'site_usd_to_idr_exchange_rate','100','2023-03-06 07:51:22','2025-03-24 00:01:03'),(239,'site_usd_to_inr_exchange_rate','100','2023-03-06 07:51:22','2025-03-24 00:01:03'),(240,'site_usd_to_ngn_exchange_rate','100','2023-03-06 07:51:22','2025-03-24 00:01:03'),(241,'site_usd_to_zar_exchange_rate','100','2023-03-06 07:51:22','2025-03-24 00:01:03'),(242,'site_usd_to_brl_exchange_rate','100','2023-03-06 07:51:22','2025-03-24 00:01:03'),(243,'site_usd_to_myr_exchange_rate','100','2023-03-06 07:51:22','2025-03-24 00:01:03'),(244,'_2fa_disable_subject','Disable 2FA Email','2023-03-25 00:36:36','2023-03-25 00:36:36'),(245,'_2fa_disable_message','<p>Hello @name,<br><br>2 factor authentication successfully disable from your account.<br></p>','2023-03-25 00:36:36','2023-03-25 00:36:36'),(246,'user_email_verified_subject','User Email Verify','2023-03-25 01:12:29','2023-03-25 02:22:42'),(247,'user_email_verified_message','<p>Hello @name,<br><br>Your email address successfully verified.<br></p>','2023-03-25 01:12:29','2023-03-25 02:22:42'),(248,'project_create_email_subject','Project Create Email','2023-03-25 03:12:40','2023-03-25 03:12:40'),(249,'project_create_email_message','<p>Hello,<br><br>A new project is just created. Project ID: @project_id<br></p>','2023-03-25 03:12:40','2023-03-25 03:12:40'),(250,'project_approve_email_subject','Project Activate Email','2023-03-25 03:41:43','2023-03-28 02:12:13'),(251,'project_approve_email_message','<p>Hello @name,<br><br>Your project successfully activate. Project ID: @project_id<br></p>','2023-03-25 03:41:43','2023-03-28 02:12:13'),(252,'project_decline_email_subject','Project Reject Email','2023-03-25 03:50:42','2023-03-28 02:27:42'),(253,'project_decline_email_message','<p>Hello @name,<br><br>Your project has been rejected. Project ID: @project_id<br></p>','2023-03-25 03:50:42','2023-03-28 02:27:42'),(254,'project_edit_email_subject','Project Edit Email','2023-03-26 21:55:46','2023-03-26 21:55:46'),(255,'project_edit_email_message','<p>Hello,\r\n</p><p>A project is just edited. Project ID: @project_id</p><p>\r\n</p>','2023-03-26 21:55:46','2023-03-26 21:55:46'),(256,'project_inactivate_email_subject','Project Inactivate Email','2023-03-28 01:12:45','2023-03-28 02:00:19'),(257,'project_inactivate_email_message','<p>Hello @name,\r\n</p><p>Your project inactivate for the bellow reasons..... Project ID: @project_id</p><p>\r\n</p>','2023-03-28 01:12:45','2023-03-28 02:00:19'),(258,'login_page_title','Please login to continue','2023-03-29 23:49:12','2023-11-09 06:39:50'),(259,'login_page_button_title','Sign In Now','2023-03-29 23:49:12','2023-11-09 06:39:50'),(260,'login_page_sidebar_title','Xilancer Marketplace','2023-03-29 23:49:12','2023-11-09 06:39:50'),(261,'login_page_sidebar_description','Welcome, to xilancer marketplace. Here you can build a awesome career. Be a freelancer or you can post your job.','2023-03-29 23:49:12','2023-11-09 06:39:50'),(262,'login_page_social_login_enable_disable','on','2023-03-29 23:49:12','2023-11-09 06:39:50'),(263,'login_page_sidebar_image','26','2023-03-30 00:26:39','2023-11-09 06:39:50'),(264,'register_page_title','Sign Up','2023-03-30 01:27:49','2023-11-25 05:53:06'),(265,'register_page_button_title','Sign Up Now','2023-03-30 01:27:49','2023-11-25 05:53:06'),(266,'register_page_sidebar_title','Register and start discover','2023-03-30 01:27:49','2023-11-25 05:53:06'),(267,'register_page_sidebar_description','Once register you will see the magic of xilancer marketplace.','2023-03-30 01:27:49','2023-11-25 05:53:06'),(268,'register_page_social_login_enable_disable','on','2023-03-30 01:27:49','2023-11-25 05:53:06'),(269,'register_page_sidebar_image','26','2023-03-30 01:27:49','2023-11-25 05:53:06'),(270,'site_white_logo','314','2023-04-02 22:55:28','2026-01-18 09:25:14'),(271,'manual_payment_preview_logo','199','2023-04-05 03:06:03','2025-03-24 00:00:19'),(272,'site_manual_payment_name','Bank  Transfer','2023-04-05 03:06:03','2023-04-12 21:34:36'),(273,'manual_payment_test_mode',NULL,'2023-04-05 03:06:03','2025-03-24 00:00:19'),(274,'user_deposit_to_wallet_subject','User Deposit Email','2023-04-06 01:30:36','2023-04-06 01:42:47'),(275,'user_deposit_to_wallet_message','<p>Hello @name,<br><br>Your deposit to wallet successfully completed. Deposit ID: @deposit_id<br></p>','2023-04-06 01:30:36','2023-04-06 01:42:47'),(276,'user_deposit_to_wallet_subject_admin','User Deposit Email','2023-04-06 01:31:53','2023-04-06 01:42:41'),(277,'user_deposit_to_wallet_message_admin','<p>Hello,<br></p><p>A user deposit to his wallet. Deposit ID: @deposit_id<br></p>','2023-04-06 01:31:53','2023-04-06 01:42:41'),(278,'deposit_amount_limitation_for_user','500','2023-04-08 23:01:49','2024-07-29 12:58:24'),(279,'razorpay_test_mode','on','2023-04-09 23:51:10','2025-03-24 00:00:18'),(280,'stripe_test_mode','on','2023-04-09 23:51:10','2025-03-24 00:00:18'),(281,'paystack_test_mode','on','2023-04-09 23:51:11','2025-03-24 00:00:18'),(282,'mollie_test_mode',NULL,'2023-04-09 23:51:11','2025-03-24 00:00:18'),(283,'flutterwave_test_mode','on','2023-04-09 23:51:11','2025-03-24 00:00:18'),(284,'payfast_test_mode','on','2023-04-09 23:51:12','2025-03-24 00:00:18'),(285,'marcadopago_client_id','TEST-0a3cc78a-57bf-4556-9dbe-2afa06347769','2023-04-10 21:46:19','2025-03-24 00:00:19'),(286,'marcadopago_client_secret','TEST-4644184554273630-070813-7d817e2ca1576e75884001d0755f8a7a-786499991','2023-04-10 21:46:19','2025-03-24 00:00:19'),(287,'toyyibpay_secrect_key','wnbtrqle-9t9l-m02j-e2bz-iaj2tkp52sfo','2023-04-11 03:10:15','2025-03-24 00:00:19'),(288,'toyyibpay_category_code','0m0j9yc4','2023-04-11 03:10:15','2025-03-24 00:00:19'),(289,'toyyibpay_preview_logo','181','2023-04-11 03:10:15','2025-03-24 00:00:19'),(290,'toyyibpay_gateway','on','2023-04-11 03:10:15','2025-03-24 00:00:19'),(291,'toyyibpay_test_mode','on','2023-04-11 03:10:15','2025-03-24 00:00:19'),(292,'pagali_page_id',NULL,'2023-04-11 03:53:41','2025-03-24 00:00:19'),(293,'pagali_entity_id',NULL,'2023-04-11 03:53:41','2025-03-24 00:00:19'),(294,'pagali_preview_logo','180','2023-04-11 03:53:41','2025-03-24 00:00:19'),(295,'pagali_gateway','on','2023-04-11 03:53:41','2025-03-24 00:00:19'),(296,'pagali_test_mode','on','2023-04-11 03:53:41','2025-03-24 00:00:19'),(297,'authorize_dot_net_login_id','2e8yjNL89kV2','2023-04-11 22:24:12','2025-03-24 00:00:19'),(298,'authorize_dot_net_transaction_id','65968Gb3DU2ntX2v','2023-04-11 22:24:12','2025-03-24 00:00:19'),(299,'authorize_dot_net_preview_logo','179','2023-04-11 22:24:12','2025-03-24 00:00:19'),(300,'authorize_dot_net_gateway','on','2023-04-11 22:24:12','2025-03-24 00:00:19'),(301,'authorize_dot_net_test_mode','on','2023-04-11 22:24:12','2025-03-24 00:00:19'),(302,'sitesway_brand_id',NULL,'2023-04-11 23:13:38','2025-03-24 00:00:19'),(303,'sitesway_api_key',NULL,'2023-04-11 23:13:38','2025-03-24 00:00:19'),(304,'sitesway_preview_logo','200','2023-04-11 23:13:38','2025-03-24 00:00:19'),(305,'sitesway_gateway','on','2023-04-11 23:13:38','2025-03-24 00:00:19'),(306,'sitesway_test_mode','on','2023-04-11 23:13:38','2025-03-24 00:00:19'),(307,'manual_payment_gateway','on','2023-04-12 22:12:04','2025-03-24 00:00:19'),(308,'job_create_email_subject','Job Create Email','2023-04-17 01:14:00','2023-04-17 03:20:55'),(309,'job_create_email_message','<p>Hello,</p><p><br></p><p>\r\n</p><p>A new job is just created. Job ID: @job_id</p><p>\r\n</p>','2023-04-17 01:14:00','2023-04-17 03:20:55'),(310,'job_edit_email_subject','Job Edit Email','2023-04-17 01:42:31','2023-04-17 01:42:53'),(311,'job_edit_email_message','<p>Hello,</p><p>\r\n</p><p>A project is just edited. Job ID: @job_id</p><p>\r\n</p>','2023-04-17 01:42:31','2023-04-17 01:42:53'),(312,'job_approve_email_subject','Job Activate Email','2023-04-17 02:02:00','2023-04-17 02:13:30'),(313,'job_approve_email_message','<p>Hello @name,</p><p><br></p><p>\r\n</p><p>Your job successfully activate. Job ID: @job_id</p><p>\r\n</p>','2023-04-17 02:02:00','2023-04-17 02:13:30'),(314,'job_inactivate_email_subject','Job Inactivate Email','2023-04-17 02:09:25','2023-04-17 02:09:30'),(315,'job_inactivate_email_message','<p>Hello @name,\r\n</p><p>Your job inactivate for the bellow reasons..... Job ID: @job_id</p><p>\r\n</p>','2023-04-17 02:09:25','2023-04-17 02:09:30'),(316,'job_decline_email_subject','Job Decline Email','2023-04-17 02:13:15','2023-04-17 02:13:15'),(317,'job_decline_email_message','<p>Hello @name,\r\n</p><p>Your job has been rejected. Job ID: @job_id</p><p>\r\n</p>','2023-04-17 02:13:15','2023-04-17 02:13:15'),(318,'site_tag_line','Freelance Services Marketplace','2023-05-09 01:09:04','2023-11-13 07:45:07'),(319,'home_page','7','2023-05-10 00:53:34','2025-12-28 05:52:58'),(320,'user_subscription_purchase_subject','User Subscription Purchase Email','2023-06-22 05:44:20','2023-06-22 05:44:20'),(321,'user_subscription_purchase_message','<p>Your subscription purchase successfully completed. Subscription ID: @subscription_id</p>','2023-06-22 05:44:20','2023-06-22 05:44:20'),(322,'user_subscription_purchase_admin_email_subject','User Subscription Purchase Email','2023-06-22 05:46:20','2023-06-22 05:46:20'),(323,'user_subscription_purchase_admin_email_message','<p>A user just purchase a subscription. Subscription ID: @subscription_id</p>','2023-06-22 05:46:20','2023-06-22 05:46:20'),(324,'limit_settings','2','2023-06-24 01:29:25','2023-07-06 04:01:20'),(325,'manual_subscription_complete_subject','Subscription Manual Payment Complete','2023-06-26 01:16:35','2023-07-04 03:55:16'),(326,'manual_subscription_complete_message','<p>Hello @name,\r\n</p><p>Your manual subscription payment status successfully changed from pending to complete. Subscription ID: @subscription_id</p><p>\r\n</p>','2023-06-26 01:16:35','2023-07-04 03:55:16'),(327,'manual_subscription_pending_subject','Subscription Manual Payment Pending Email','2023-06-26 01:17:48','2023-06-26 01:17:48'),(328,'manual_subscription_pending_message','<p>Hello @name,\r\n</p><p>Your manual subscription payment status changed from complete to pending. Subscription ID: @subscription_id</p><p>\r\n</p>','2023-06-26 01:17:48','2023-06-26 01:17:48'),(329,'manual_subscription_complete_subject_to_admin','Subscription Manual Payment Complete','2023-07-04 03:59:45','2023-07-04 03:59:52'),(330,'manual_subscription_complete_message_to_admin','<p>Hello admin,\r\n</p><p>A manual subscription payment status successfully changed from pending to complete. Subscription ID: @subscription_id</p><p>\r\n</p><p>\r\n</p>','2023-07-04 03:59:46','2023-07-04 03:59:52'),(331,'subscription_active_subject','Subscription Active','2023-07-04 05:28:01','2023-07-04 05:28:42'),(332,'subscription_active_message','<p>Hello @name,\r\n</p><p>Your subscription status changed from inactive to active. Subscription ID: @subscription_id</p><p>\r\n</p>','2023-07-04 05:28:01','2023-07-04 05:28:42'),(333,'subscription_inactive_subject','Subscription Inactive','2023-07-04 05:29:31','2023-07-04 05:29:31'),(334,'subscription_inactive_message','<p>Hello @name,\r\n</p><p>Your subscription status changed from active to inactive. Subscription ID: @subscription_id</p><p>\r\n</p>','2023-07-04 05:29:31','2023-07-04 05:29:31'),(353,'admin_commission_type','percentage','2023-07-11 01:37:44','2023-07-11 01:37:44'),(354,'admin_commission_charge','21','2023-07-11 01:37:44','2023-07-11 01:37:44'),(359,'transaction_fee_type','percentage','2023-07-12 01:19:22','2023-07-27 00:29:56'),(360,'transaction_fee_charge','2','2023-07-12 01:19:22','2023-07-27 00:29:57'),(361,'order_hold_subject','Hold Order','2023-08-22 00:39:06','2023-08-22 06:48:43'),(362,'order_hold_message','<p>Hello @name,</p><p><br></p><p>Your order has been hold .... contact with support team</p><p><br></p><p>Order Id: #@order_id</p>','2023-08-22 00:39:06','2023-08-22 06:48:43'),(363,'order_unhold_subject','Unhold Order','2023-08-22 00:40:04','2023-08-22 01:24:20'),(364,'order_unhold_message','<p>Hello @name;\r\n</p><p>Your order has been Unhold ....</p><p><br></p><p>Order Id: #@order_id</p><p>\r\n</p><p>\r\n</p><p>\r\n</p>','2023-08-22 00:40:04','2023-08-22 01:24:21'),(365,'account_active_subject','Account Active','2023-08-22 03:55:06','2023-08-22 06:48:19'),(366,'account_active_message','<p>Hello @name,</p><p><br></p><p>Your account has been active......</p>','2023-08-22 03:55:06','2023-08-22 06:48:19'),(367,'account_suspend_subject','Account Suspend','2023-08-22 03:55:23','2023-08-22 06:48:24'),(368,'account_suspend_message','<p>Hello @name,</p><p><br></p><p>Your account has been suspended......</p>','2023-08-22 03:55:23','2023-08-22 06:48:24'),(369,'account_unsuspend_subject','Account Active','2023-08-24 04:10:00','2023-08-24 04:10:00'),(370,'account_unsuspend_message','<p>Hello @name,\r\n</p><p>Your account has been unsuspend form suspend......</p><p>\r\n</p><p>\r\n</p><p>\r\n</p>','2023-08-24 04:10:00','2023-08-24 04:10:00'),(371,'order_manual_payment_complete_subject','Order Manual Payment Complete','2023-08-24 07:30:11','2023-08-24 07:30:11'),(372,'order_manual_payment_complete_message','<p>Hello @name,</p><p><br></p><p>\r\n</p><p>Your order payment has been updated from pending to complete.</p><p><br></p><p>\r\n</p><p>Order Id: #@order_id</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p>','2023-08-24 07:30:11','2023-08-24 07:30:11'),(373,'support_ticket_subject','Support Ticket','2023-08-27 06:59:20','2023-08-27 07:08:12'),(374,'support_ticket_message','<p>Hello @name,</p><p><br></p><p>You have a new ticket</p><p><br></p><p>Ticket ID: #@ticket_id</p>','2023-08-27 06:59:20','2023-08-27 07:08:12'),(375,'support_ticket_message_email_subject','Support Ticket Message Email','2023-08-29 04:57:15','2023-08-29 04:57:15'),(376,'support_ticket_message_email_message','<p>Hello @name,</p><p><br></p><p>You have a new message for the bellow ticket</p><p><br></p><p>Ticket ID : #@ticket_id</p>','2023-08-29 04:57:15','2023-08-29 04:57:15'),(377,'job_auto_approval','no','2023-09-20 05:50:29','2025-11-02 03:49:02'),(378,'withdraw_amount_limitation_for_user','50','2023-10-15 05:09:35','2023-10-15 05:09:35'),(379,'minimum_withdraw_amount','50','2023-10-15 05:28:40','2023-10-17 03:47:28'),(380,'maximum_withdraw_amount','500','2023-10-15 05:28:40','2023-10-17 03:47:28'),(381,'withdraw_fee','5','2023-10-16 23:47:35','2023-10-16 23:47:35'),(382,'register_subscription','10','2023-11-06 04:35:25','2023-11-06 04:35:25'),(383,'main_color_one','#007456','2023-11-15 04:32:16','2026-01-08 10:19:52'),(384,'main_color_two',NULL,'2023-11-15 04:32:16','2026-01-08 10:19:52'),(385,'secondary_color','#ffa500','2023-11-15 04:32:16','2026-01-08 10:19:52'),(386,'paragraph_color','#475467','2023-11-15 04:32:16','2026-01-08 10:19:52'),(387,'body_color','#3B4759','2023-11-15 04:32:16','2026-01-08 10:19:52'),(388,'site_script_version','4.0.0','2023-12-18 14:01:27','2023-12-18 14:01:30'),(389,'iyzipay_secret_key','sandbox-QsgXTUpizlCZzHaypMJwkL8YTMGsYMBM','2023-12-27 07:40:33','2025-03-24 00:00:19'),(390,'iyzipay_api_key','sandbox-QsgXTUpizlCZzHaypMJwkL8YTMGsYMBM','2023-12-27 07:40:33','2025-03-24 00:00:19'),(391,'iyzipay_preview_logo','178','2023-12-27 07:40:33','2025-03-24 00:00:19'),(392,'iyzipay_gateway','on','2023-12-27 07:40:33','2025-03-24 00:00:19'),(393,'iyzipay_test_mode','on','2023-12-27 07:40:33','2025-03-24 00:00:19'),(394,'site_manual_payment_description',NULL,'2023-12-27 07:40:33','2025-03-24 00:00:19'),(395,'job_enable_disable','enable','2024-01-17 06:35:58','2024-01-17 07:34:50'),(396,'project_enable_disable','enable','2024-01-17 07:07:23','2024-01-17 07:35:07'),(397,'captcha_status','on','2024-01-27 06:46:42','2024-01-27 06:46:42'),(398,'site_bgn_to_usd_exchange_rate',NULL,'2024-01-27 09:02:54','2024-01-27 09:03:21'),(399,'site_bgn_to_idr_exchange_rate',NULL,'2024-01-27 09:02:54','2024-01-27 09:03:21'),(400,'site_bgn_to_inr_exchange_rate',NULL,'2024-01-27 09:02:54','2024-01-27 09:03:21'),(401,'site_bgn_to_ngn_exchange_rate',NULL,'2024-01-27 09:02:54','2024-01-27 09:03:21'),(402,'site_bgn_to_zar_exchange_rate',NULL,'2024-01-27 09:02:54','2024-01-27 09:03:21'),(403,'site_bgn_to_brl_exchange_rate',NULL,'2024-01-27 09:02:54','2024-01-27 09:03:21'),(404,'site_bgn_to_myr_exchange_rate',NULL,'2024-01-27 09:02:54','2024-01-27 09:03:21'),(405,'site_usd_to_usd_exchange_rate','100','2024-01-27 22:41:10','2025-03-24 00:01:03'),(406,'user_register_welcome_subject','User Register Welcome Email','2024-01-30 03:58:20','2024-01-30 03:58:20'),(407,'user_register_welcome_message','<p>Hello @name,\r\n</p><p>Your registration successfully completed. Below is your account details.</p><p><br></p><p>\r\n</p><p>Name : @name\r\n</p><p>Email: @email\r\n</p><p>Username: @username\r\n</p><p>Password : @password\r\n</p><p>User Type: @userType</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p>','2024-01-30 03:58:20','2024-01-30 03:58:20'),(408,'manual_payment_gateway_name',NULL,'2024-03-10 15:58:06','2025-03-24 00:00:19'),(409,'profile_page_badge_settings','enable','2024-06-04 08:33:21','2024-06-04 08:44:11'),(410,'recaptcha_site_key','6LdsrfEpAAAAAO6kajZpCjiq-ppcVJFHoCUhAHXx','2024-06-12 11:08:11','2024-06-12 11:08:11'),(411,'recaptcha_secret_key','6LdsrfEpAAAAAEpQ58fvbmvzN1DuUnfDXnBZJcSr','2024-06-12 11:08:11','2024-06-12 11:08:11'),(412,'subscription_enable_disable','enable','2024-06-12 11:15:39','2024-06-12 11:16:19'),(413,'kineticpay_gateway','on','2024-07-29 15:05:12','2025-03-24 00:00:19'),(414,'kineticpay_test_mode','on','2024-07-29 15:05:12','2025-03-24 00:00:19'),(415,'kineticpay_merchant_key','ede1c5e9f81c9d12bf418629f56a7870','2024-07-29 15:05:12','2025-03-24 00:00:19'),(416,'kineticpay_preview_logo','152','2024-07-29 15:05:12','2025-03-24 00:00:19'),(417,'awdpay_gateway','on','2024-07-29 15:05:12','2025-03-24 00:00:19'),(418,'awdpay_test_mode','on','2024-07-29 15:05:12','2025-03-24 00:00:19'),(419,'awdpay_private_key',NULL,'2024-07-29 15:05:12','2025-03-24 00:00:19'),(420,'awdpay_preview_logo','201','2024-07-29 15:05:12','2025-03-24 00:00:19'),(421,'awdpay_logo_url','https://www.awdpay.com/api/public/image-1649803735945-214296083.png','2024-07-29 15:05:12','2025-03-24 00:00:19'),(422,'file_extensions','[\"png\",\"jpg\",\"jpeg\",\"gif\",\"pdf\",\"doc\",\"docx\",\"txt\",\"csv\",\"xlsx\",\"xls\",\"ppt\",\"pptx\",\"zip\"]','2024-10-09 16:44:33','2024-10-09 16:46:04'),(423,'max_upload_size','2097152','2024-10-09 16:44:33','2024-10-09 16:46:04'),(424,'community_page_title','Get answers to your questions by our expert community members2','2024-12-24 04:12:07','2024-12-30 08:50:54'),(425,'community_question_button_title','Login to Ask a Question','2024-12-24 04:12:07','2024-12-30 08:50:54'),(426,'community_question_modal_title','Ask a question','2024-12-24 04:12:07','2024-12-30 08:50:54'),(427,'community_page_notification_title','Your questions has been answered by community members','2024-12-24 04:12:07','2024-12-30 08:50:54'),(428,'community_question_page_subtitle','This is a space for both clients and freelancers to get their questions answered by the community.','2024-12-24 04:12:07','2024-12-30 08:50:54'),(429,'community_tips_page_subtitle','This is a space for both clients and freelancers to get their tips comment by the community.','2024-12-24 04:12:07','2024-12-30 08:50:54'),(430,'community_page_image','170','2024-12-24 04:12:07','2024-12-30 08:50:54'),(431,'site_currency_thousand_separator',',','2024-12-28 05:23:41','2025-03-24 00:01:03'),(432,'site_currency_decimal_separator','.','2024-12-28 05:23:41','2025-03-24 00:01:03'),(433,'site_usd_to_bdt_exchange_rate','116','2024-12-28 05:23:41','2025-03-24 00:01:03'),(434,'sslcommerce_gateway','on','2024-12-28 05:26:24','2025-03-24 00:00:19'),(435,'sslcommerce_preview_logo','202','2024-12-28 05:26:24','2025-03-24 00:00:19'),(436,'sslcommerce_test_mode','on','2024-12-28 05:26:24','2025-03-24 00:00:19'),(437,'sslcommerce_store_id','xgeni65bceeafdfb1e','2024-12-28 05:26:24','2025-03-24 00:00:19'),(438,'sslcommerce_store_password','xgeni65bceeafdfb1e@ssl','2024-12-28 05:26:24','2025-03-24 00:00:19'),(439,'yoomoney_gateway',NULL,'2024-12-28 05:26:24','2025-03-24 00:00:19'),(440,'yoomoney_test_mode',NULL,'2024-12-28 05:26:24','2025-03-24 00:00:19'),(441,'yoomoney_preview_logo',NULL,'2024-12-28 05:26:24','2025-03-24 00:00:19'),(442,'yoomoney_shop_id',NULL,'2024-12-28 05:26:24','2025-03-24 00:00:19'),(443,'yoomoney_secret_key',NULL,'2024-12-28 05:26:24','2025-03-24 00:00:19'),(444,'coinpayments_gateway',NULL,'2024-12-28 05:26:24','2025-03-24 00:00:19'),(445,'coinpayments_test_mode',NULL,'2024-12-28 05:26:24','2025-03-24 00:00:19'),(446,'coinpayments_preview_logo',NULL,'2024-12-28 05:26:24','2025-03-24 00:00:19'),(447,'coinpayments_merchant',NULL,'2024-12-28 05:26:24','2025-03-24 00:00:19'),(448,'coinpayments_ipn_pin',NULL,'2024-12-28 05:26:24','2025-03-24 00:00:19'),(449,'mouse_pointer','enable','2025-01-07 01:04:05','2025-09-09 22:19:56'),(450,'xendit_gateway','on','2025-03-23 07:30:03','2025-03-24 00:00:19'),(451,'xendit_test_mode','on','2025-03-23 07:30:03','2025-03-24 00:00:19'),(452,'xendit_secret_key','xnd_development_axvvNZd9HGFxJlH8SpFqwgKYMUFugu8uF8ZCqAfpZ7QCovylWMbpJi0I3XDtS','2025-03-23 07:30:03','2025-03-24 00:00:19'),(453,'xendit_webhook_token',NULL,'2025-03-23 07:30:03','2025-03-24 00:00:19'),(454,'xendit_preview_logo','203','2025-03-23 07:30:03','2025-03-24 00:00:19'),(455,'subscription_chat_enable_disable','enable','2025-03-23 08:53:32','2025-03-23 23:51:33'),(456,'admin_url_prefix','admin','2025-03-23 23:52:01','2025-03-24 01:57:24'),(457,'user_identity_verify_enable_disable','disable','2025-09-09 04:08:44','2025-09-09 04:08:44'),(458,'state_filter_enable_disable','enable','2025-09-09 04:15:48','2025-09-09 04:15:48'),(459,'job_country_restriction_enabled','1','2025-09-28 00:24:18','2025-09-28 00:24:18'),(460,'job_country_view_level_enabled','1','2025-09-28 00:24:18','2025-09-28 00:24:18'),(461,'promote_transaction_fee_type','percentage','2025-09-28 00:24:48','2025-09-28 00:24:48'),(462,'promote_transaction_fee_charge','2','2025-09-28 00:24:48','2025-09-28 00:24:48'),(463,'projects_per_page','12','2025-09-28 00:25:15','2026-01-19 05:15:13'),(464,'pro_projects_default_first','1','2025-09-28 00:25:15','2026-01-19 05:15:13'),(465,'pro_projects_count','7','2025-09-28 00:25:15','2026-01-19 05:15:13'),(466,'non_pro_projects_count','5','2025-09-28 00:25:15','2026-01-19 05:15:13'),(467,'promoted_user_profile_text','Your current promotion is active and will expire on','2025-09-28 00:25:15','2026-01-19 05:15:13'),(468,'promoted_badge_text','Sponsored','2025-09-28 00:25:15','2026-01-19 05:15:13'),(469,'promoted_badge_text_toggle','on','2025-09-28 00:25:15','2026-01-19 05:15:13'),(470,'user_earning_toggle','enable','2025-10-19 04:34:53','2025-10-19 04:34:53'),(471,'hide_empty_categories','on','2025-10-19 04:37:38','2025-10-19 04:37:38'),(472,'project_auto_approval','yes','2025-12-29 03:41:10','2025-12-29 03:44:36'),(473,'section_font_family','Poppins','2026-01-08 10:21:56','2026-01-08 10:21:56'),(474,'section_font_variant','a:9:{i:0;s:5:\"0,100\";i:1;s:5:\"0,200\";i:2;s:5:\"0,300\";i:3;s:5:\"0,400\";i:4;s:5:\"0,500\";i:5;s:5:\"0,600\";i:6;s:5:\"0,700\";i:7;s:5:\"0,800\";i:8;s:5:\"0,900\";}','2026-01-08 10:21:56','2026-01-08 10:21:56'),(475,'page_loader','enable','2026-01-14 06:05:40','2026-01-14 06:06:15');
/*!40000 ALTER TABLE `static_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sub_categories`
--

DROP TABLE IF EXISTS `sub_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sub_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sub_category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `category_id` bigint NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0=inactive 1=active',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub_categories`
--

LOCK TABLES `sub_categories` WRITE;
/*!40000 ALTER TABLE `sub_categories` DISABLE KEYS */;
INSERT INTO `sub_categories` VALUES (1,'UI/UX Design','This category descrips financial ui-ux design','uiux-design','This category descrips financial ui-ux design','This category descrips financial ui-ux design',1,1,NULL,'2023-02-07 06:00:14','2024-06-12 11:14:22'),(2,'Graphic Design','This category descrips financial graphic design','graphic-design',NULL,NULL,1,1,NULL,'2023-02-07 06:00:23','2023-05-15 00:25:33'),(3,'Wordpress','This category related to wordpres development','wordpress',NULL,NULL,2,1,'69','2023-02-07 22:28:02','2023-11-05 00:17:38'),(5,'Flutter Development','This category descrips financial flutter development','flutter-development',NULL,NULL,4,1,NULL,'2023-02-07 22:28:28','2023-05-15 00:23:43'),(6,'Android Development','This category descrips financial android development','android-development',NULL,NULL,4,1,NULL,'2023-02-07 22:28:43','2023-05-15 00:22:58'),(7,'ios Development','This category descrips financial operations ios development','ios-development',NULL,NULL,4,1,NULL,'2023-02-07 22:28:55','2023-05-15 00:21:20'),(8,'Kotlin Development','This category descrips financial kotlin development','kotlin-development',NULL,NULL,4,1,NULL,'2023-02-07 22:29:07','2023-05-15 00:20:39'),(20,'Php Developer','This category descrips php developer','php-developer',NULL,NULL,2,1,'7','2023-02-08 22:49:10','2023-05-15 00:15:19'),(21,'Frontend Developer','This category descrips frontend developer','frontend-developer',NULL,NULL,2,1,NULL,'2023-02-08 23:02:13','2023-05-15 00:15:05'),(22,'Backend Developer','This category descrips backend developer','backend-developer',NULL,NULL,2,1,NULL,'2023-02-08 23:02:39','2023-05-15 00:14:47'),(24,'Website Design','This category describes html templates design.','website-design',NULL,NULL,1,1,'69','2023-05-15 23:54:28','2023-11-05 03:09:25'),(26,'Content Writing','This category descrips wordpress templates design','content-writing',NULL,NULL,13,1,NULL,'2023-05-17 06:51:34','2023-05-05 06:51:34'),(29,'Search Engine Optimization (SEO)','Seo','search-engine-optimization--seo-',NULL,NULL,11,1,'77','2023-11-05 05:21:43','2023-11-05 05:21:43'),(30,'Branding','branding','branding',NULL,NULL,11,1,'77','2023-11-05 05:41:56','2023-11-05 05:41:56'),(31,'Website Content','Website Content','website-content',NULL,NULL,13,1,'77','2023-11-05 06:23:45','2023-11-05 06:23:45'),(32,'Article and Blog Post','Article and Blog Post','article-and-blog-post',NULL,NULL,13,1,'69','2023-11-05 06:24:27','2023-11-05 06:24:27'),(33,'Script Writing','Script Writing','script-writing',NULL,NULL,13,1,'67','2023-11-05 06:25:42','2023-11-05 06:25:42'),(34,'Social Media Marketing','Social Media Marketing','social-media-marketing',NULL,NULL,11,1,'66','2023-11-05 06:26:26','2023-11-05 06:26:26'),(35,'Market Research','Market Research','market-research',NULL,NULL,9,1,NULL,'2023-11-06 00:45:03','2023-11-06 00:45:03'),(36,'Virtual Assistance','Virtual Assistance','virtual-assistance',NULL,NULL,3,1,NULL,'2023-11-06 00:51:44','2023-11-06 00:51:44'),(37,'IELTS','ielts','ielts',NULL,NULL,5,1,NULL,'2023-11-06 01:20:41','2023-11-06 01:20:41');
/*!40000 ALTER TABLE `sub_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscription_features`
--

DROP TABLE IF EXISTS `subscription_features`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subscription_features` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `subscription_id` bigint NOT NULL,
  `feature` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=496 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscription_features`
--

LOCK TABLES `subscription_features` WRITE;
/*!40000 ALTER TABLE `subscription_features` DISABLE KEYS */;
INSERT INTO `subscription_features` VALUES (293,4,'Yearly useable','on','2023-11-08 04:59:30','2023-11-08 04:59:30'),(294,4,'Support','on','2023-11-08 04:59:30','2023-11-08 04:59:30'),(295,4,'Very professional','on','2023-11-08 04:59:30','2023-11-08 04:59:30'),(296,4,'Easy Access','on','2023-11-08 04:59:30','2023-11-08 04:59:30'),(297,4,'New policy remove','on','2023-11-08 04:59:30','2023-11-08 04:59:30'),(298,4,'Lifetime','off','2023-11-08 04:59:30','2023-11-08 04:59:30'),(299,4,'Less use','off','2023-11-08 04:59:30','2023-11-08 04:59:30'),(356,8,'Connect 5','on','2023-11-08 06:09:17','2023-11-08 06:09:17'),(357,8,'Weekly','on','2023-11-08 06:09:17','2023-11-08 06:09:17'),(358,8,'Less feature','on','2023-11-08 06:09:17','2023-11-08 06:09:17'),(359,8,'New feature','on','2023-11-08 06:09:17','2023-11-08 06:09:17'),(360,8,'Support system','on','2023-11-08 06:09:17','2023-11-08 06:09:17'),(361,8,'No drawback','on','2023-11-08 06:09:17','2023-11-08 06:09:17'),(362,8,'Professional','on','2023-11-08 06:09:17','2023-11-08 06:09:17'),(391,7,'Connect 23','on','2023-11-27 05:05:37','2023-11-27 05:05:37'),(392,7,'Professional','on','2023-11-27 05:05:37','2023-11-27 05:05:37'),(393,7,'Monthly support','on','2023-11-27 05:05:37','2023-11-27 05:05:37'),(394,7,'Features','on','2023-11-27 05:05:37','2023-11-27 05:05:37'),(395,7,'New way','on','2023-11-27 05:05:37','2023-11-27 05:05:37'),(396,7,'Long term','on','2023-11-27 05:05:37','2023-11-27 05:05:37'),(397,7,'Usefull','on','2023-11-27 05:05:37','2023-11-27 05:05:37'),(419,1,'Month wise','on','2023-11-27 05:08:18','2023-11-27 05:08:18'),(420,1,'Get more connect','on','2023-11-27 05:08:18','2023-11-27 05:08:18'),(421,1,'Multiple use','on','2023-11-27 05:08:18','2023-11-27 05:08:18'),(422,1,'Multi connect','on','2023-11-27 05:08:18','2023-11-27 05:08:18'),(423,1,'Professional use','on','2023-11-27 05:08:18','2023-11-27 05:08:18'),(424,1,'Month wise','off','2023-11-27 05:08:18','2023-11-27 05:08:18'),(425,1,'Lifetime support','off','2023-11-27 05:08:18','2023-11-27 05:08:18'),(447,2,'Yearly system','on','2025-03-24 02:11:40','2025-03-24 02:11:40'),(448,2,'Professional','on','2025-03-24 02:11:40','2025-03-24 02:11:40'),(449,2,'Usefull','on','2025-03-24 02:11:40','2025-03-24 02:11:40'),(450,2,'Less price','on','2025-03-24 02:11:40','2025-03-24 02:11:40'),(451,2,'Low cost','on','2025-03-24 02:11:40','2025-03-24 02:11:40'),(452,2,'Reasonable','off','2025-03-24 02:11:40','2025-03-24 02:11:40'),(453,2,'Lifetime','off','2025-03-24 02:11:40','2025-03-24 02:11:40'),(454,3,'Monthly support','on','2025-03-24 02:12:22','2025-03-24 02:12:22'),(455,3,'Lifetime','on','2025-03-24 02:12:22','2025-03-24 02:12:22'),(456,3,'Professional','on','2025-03-24 02:12:22','2025-03-24 02:12:22'),(457,3,'Long term','off','2025-03-24 02:12:22','2025-03-24 02:12:22'),(458,3,'New feature','off','2025-03-24 02:12:22','2025-03-24 02:12:22'),(459,3,'Unlimited validity','off','2025-03-24 02:12:22','2025-03-24 02:12:22'),(460,3,'All Time','off','2025-03-24 02:12:22','2025-03-24 02:12:22'),(461,5,'Connect 100','on','2025-03-24 02:12:31','2025-03-24 02:12:31'),(462,5,'Yearly system','on','2025-03-24 02:12:31','2025-03-24 02:12:31'),(463,5,'Less use','on','2025-03-24 02:12:31','2025-03-24 02:12:31'),(464,5,'Professional','on','2025-03-24 02:12:31','2025-03-24 02:12:31'),(465,5,'One time get','on','2025-03-24 02:12:31','2025-03-24 02:12:31'),(466,5,'Monthly support','on','2025-03-24 02:12:31','2025-03-24 02:12:31'),(467,5,'New policy','on','2025-03-24 02:12:31','2025-03-24 02:12:31'),(468,6,'Connect 10','on','2025-03-24 02:12:42','2025-03-24 02:12:42'),(469,6,'Monthly support','on','2025-03-24 02:12:42','2025-03-24 02:12:42'),(470,6,'Professional','on','2025-03-24 02:12:42','2025-03-24 02:12:42'),(471,6,'List type','on','2025-03-24 02:12:42','2025-03-24 02:12:42'),(472,6,'New feature','on','2025-03-24 02:12:42','2025-03-24 02:12:42'),(473,6,'Long term','on','2025-03-24 02:12:42','2025-03-24 02:12:42'),(474,6,'Healthy usecase','on','2025-03-24 02:12:42','2025-03-24 02:12:42'),(475,9,'Connect 10','on','2025-03-24 02:12:51','2025-03-24 02:12:51'),(476,9,'Weekly 2','on','2025-03-24 02:12:51','2025-03-24 02:12:51'),(477,9,'Limit 10','on','2025-03-24 02:12:51','2025-03-24 02:12:51'),(478,9,'Professional','on','2025-03-24 02:12:51','2025-03-24 02:12:51'),(479,9,'Supported','on','2025-03-24 02:12:51','2025-03-24 02:12:51'),(480,9,'Less use','on','2025-03-24 02:12:51','2025-03-24 02:12:51'),(481,9,'Welcome feature','off','2025-03-24 02:12:51','2025-03-24 02:12:51'),(489,10,'Free for first time','on','2025-09-09 22:18:24','2025-09-09 22:18:24'),(490,10,'Get while register','on','2025-09-09 22:18:24','2025-09-09 22:18:24'),(491,10,'Must register as a freelancer','on','2025-09-09 22:18:24','2025-09-09 22:18:24'),(492,10,'One time get','on','2025-09-09 22:18:24','2025-09-09 22:18:24'),(493,10,'Use for job proposal','on','2025-09-09 22:18:24','2025-09-09 22:18:24'),(494,10,'Get only once','on','2025-09-09 22:18:24','2025-09-09 22:18:24'),(495,10,'Totally Free','on','2025-09-09 22:18:24','2025-09-09 22:18:24');
/*!40000 ALTER TABLE `subscription_features` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscription_types`
--

DROP TABLE IF EXISTS `subscription_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subscription_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `validity` int DEFAULT NULL,
  `is_free` tinyint(1) NOT NULL DEFAULT '0',
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
INSERT INTO `subscription_types` VALUES (1,'Monthly',30,0,'2023-04-30 06:39:12','2023-06-13 00:11:48'),(2,'Yearly',365,0,'2023-04-30 06:39:24','2023-06-13 00:11:36'),(3,'Weekly',7,0,'2023-06-13 00:13:12','2023-06-13 00:13:12'),(5,'Free',30,1,'2023-08-19 06:56:31','2025-09-09 22:18:10');
/*!40000 ALTER TABLE `subscription_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscriptions`
--

DROP TABLE IF EXISTS `subscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subscriptions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `subscription_type_id` bigint NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `limit` bigint NOT NULL,
  `commission_rate` decimal(5,2) DEFAULT NULL,
  `commission_type` enum('percentage','fixed') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1-active, 0-inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscriptions`
--

LOCK TABLES `subscriptions` WRITE;
/*!40000 ALTER TABLE `subscriptions` DISABLE KEYS */;
INSERT INTO `subscriptions` VALUES (1,1,'Standard','113',20,100,NULL,NULL,0,'2023-05-01 22:45:15','2023-11-28 06:12:12'),(2,2,'Standard','231',110,60,NULL,NULL,1,'2023-05-02 00:21:17','2025-03-24 02:11:40'),(3,1,'Starter','230',30,5,NULL,NULL,1,'2023-05-02 00:23:11','2025-03-24 02:12:22'),(4,2,'Starter','57',100,50,NULL,NULL,0,'2023-05-02 03:29:33','2023-11-08 04:59:30'),(5,2,'Professional','229',150,100,NULL,NULL,1,'2023-06-13 23:06:27','2025-03-24 02:12:31'),(6,1,'Professional','230',50,10,NULL,NULL,1,'2023-06-13 23:10:38','2025-03-24 02:12:42'),(7,1,'Professional Plus','113',60,23,NULL,NULL,0,'2023-06-13 23:11:55','2023-11-28 06:24:17'),(8,3,'Nano Offer','57',10,5,NULL,NULL,0,'2023-06-13 23:13:30','2023-11-08 06:09:17'),(9,3,'Micro Offer','229',20,10,NULL,NULL,1,'2023-06-13 23:17:56','2025-03-24 02:12:51'),(10,5,'Free','231',0,20,NULL,NULL,1,'2023-08-19 06:57:07','2025-09-09 22:18:24');
/*!40000 ALTER TABLE `subscriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tickets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `department_id` bigint NOT NULL,
  `admin_id` bigint DEFAULT NULL,
  `client_id` bigint DEFAULT NULL,
  `freelancer_id` bigint DEFAULT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `subject` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `priority` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `via` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'admin, client, freelancer',
  `operating_system` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `user_earnings`
--

DROP TABLE IF EXISTS `user_earnings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_earnings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `total_earning` double NOT NULL DEFAULT '0',
  `total_withdraw` double NOT NULL DEFAULT '0',
  `remaining_balance` double NOT NULL DEFAULT '0',
  `show_earning` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_earnings`
--

LOCK TABLES `user_earnings` WRITE;
/*!40000 ALTER TABLE `user_earnings` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_earnings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_education`
--

DROP TABLE IF EXISTS `user_education`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_education` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `institution` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `degree` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `organization` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `state_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
INSERT INTO `user_introductions` VALUES (2,7,'Laravel Developer','I am a professional web developer work experience with 5 years. I will able to develop your any business  with laravel.','2023-02-01 01:37:26','2023-03-19 06:05:38'),(7,1,'Html Designer','Hello I also design html pages that can attractive your websites.','2024-10-10 11:27:40','2024-10-10 11:27:40');
/*!40000 ALTER TABLE `user_introductions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_notifications`
--

DROP TABLE IF EXISTS `user_notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_notifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `identity` bigint NOT NULL,
  `client_id` bigint NOT NULL,
  `freelancer_id` bigint NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_client_read` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unread',
  `is_freelancer_read` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unread',
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
-- Table structure for table `user_skills`
--

DROP TABLE IF EXISTS `user_skills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_skills` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `skill` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `subscription_id` bigint NOT NULL,
  `price` double NOT NULL DEFAULT '0',
  `limit` bigint NOT NULL DEFAULT '0',
  `expire_date` timestamp NULL DEFAULT NULL,
  `payment_gateway` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `transaction_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manual_payment_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_send` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_subscriptions`
--

LOCK TABLES `user_subscriptions` WRITE;
/*!40000 ALTER TABLE `user_subscriptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_subscriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_works`
--

DROP TABLE IF EXISTS `user_works`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_works` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `category_id` bigint NOT NULL,
  `sub_category_id` bigint DEFAULT NULL,
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
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `hourly_rate` double NOT NULL DEFAULT '0',
  `experience_level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'junior',
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` bigint DEFAULT NULL,
  `state_id` bigint DEFAULT NULL,
  `city_id` bigint DEFAULT NULL,
  `user_type` tinyint NOT NULL DEFAULT '0' COMMENT '1:client, 2:freelancer',
  `check_online_status` timestamp NULL DEFAULT NULL,
  `check_work_availability` tinyint NOT NULL DEFAULT '1',
  `user_active_inactive_status` tinyint NOT NULL DEFAULT '1' COMMENT '0:inactive, 1:active',
  `user_verified_status` tinyint NOT NULL DEFAULT '0' COMMENT '0:not verified, 1:verified',
  `is_suspend` tinyint NOT NULL DEFAULT '0' COMMENT '0=no , 1=yes',
  `terms_condition` int NOT NULL DEFAULT '1',
  `about` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_email_verified` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0: not verified, 1:verified',
  `google_2fa_secret` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_2fa_enable_disable_disable` tinyint NOT NULL DEFAULT '0' COMMENT '0=disable 1=enable',
  `google_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `github_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apple_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_pro` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pro_expire_date` timestamp NULL DEFAULT NULL,
  `email_verify_token` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `firebase_device_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `freeze_withdraw` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `freeze_project` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `freeze_job` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `freeze_chat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `freeze_order_create` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `load_from` int NOT NULL DEFAULT '0',
  `is_synced` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=1236 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Andrew','Fateh',0,'junior','tclient@gmail.com','6546463544645','client','$2y$10$dVn7Zka2IxHQeXYRCe/GweDPW7wqxjwT2qycATvIcLh3fg20i5z0W','1742790096-67e0ddd056a27.jpg',1,1,1,1,'2026-01-25 13:20:02',1,1,1,0,1,NULL,'1','HATKCPGN5WGPJEFU',0,NULL,NULL,NULL,NULL,NULL,NULL,'876626','dBIXRHqqRJ6Zc7pF_qJUx5:APA91bEvV3iCiNYGAoRCu-ZeMgjFZPO4lt7mmZNRItqwHYwf8IYmZGWhT5uQj4IwLja-69M4VXKdYgqPSN4GGw6ZnGKPm7C75Gnce7wu6QFNJNxHSz-_Ro8',NULL,NULL,'unfreeze','unfreeze','unfreeze',NULL,NULL,0,0,'2023-01-23 06:03:28','2026-01-25 13:20:02',NULL),(7,'William','Montag',30,'senior','ali.abdulah.sd@gmail.com','6546463544645','freelancer','$2y$10$qIx2SM3faeDLL.Mv3.OrsuqZD5iP6oEvWe3OUizm5yQ5xGxQmtbq2','1768374471-696740c74fc92.png',11,20,1,2,'2026-01-25 22:05:55',1,1,1,0,1,NULL,'1','SOVLAM7IWRWHZX23',0,NULL,NULL,NULL,NULL,'yes','2026-05-11 18:03:46','531787','c8XucJuiRXqVYxPZ-j3MwZ:APA91bH357HYy2TEkuM7vAy5qQDsnSJrEk0s8gdn1to94Wtc4o5EZ0B1fJFVr6t16BVfVbc7BWdrEi2Y8MBb7TdjQOEK9u6KdfcqCm6XncPAwXGrNX2AqeM','unfreeze','unfreeze',NULL,'unfreeze',NULL,NULL,'BCCnXjpEcPhjeS7xKlLt0E0rmFAnMtxJbt50QyTCPQOPi4uSASNXKb7adKtG',0,0,'2023-01-24 04:58:46','2026-01-25 22:05:55',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wallet_histories`
--

DROP TABLE IF EXISTS `wallet_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wallet_histories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `payment_gateway` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `transaction_fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'deposit',
  `currency` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `conversion_rate` double DEFAULT NULL,
  `symbol` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manual_payment_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '1',
  `email_send` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wallet_histories`
--

LOCK TABLES `wallet_histories` WRITE;
/*!40000 ALTER TABLE `wallet_histories` DISABLE KEYS */;
/*!40000 ALTER TABLE `wallet_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wallets`
--

DROP TABLE IF EXISTS `wallets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wallets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `balance` double NOT NULL,
  `remaining_balance` double NOT NULL DEFAULT '0',
  `withdraw_amount` double NOT NULL DEFAULT '0',
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wallets`
--

LOCK TABLES `wallets` WRITE;
/*!40000 ALTER TABLE `wallets` DISABLE KEYS */;
/*!40000 ALTER TABLE `wallets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `widgets`
--

DROP TABLE IF EXISTS `widgets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `widgets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `widget_area` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `widget_order` int DEFAULT NULL,
  `widget_location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `widget_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `widget_content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `field` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1=active, 2=inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `withdraw_gateways`
--

LOCK TABLES `withdraw_gateways` WRITE;
/*!40000 ALTER TABLE `withdraw_gateways` DISABLE KEYS */;
INSERT INTO `withdraw_gateways` VALUES (1,'Bank','a:3:{i:0;s:9:\"Bank Name\";i:1;s:10:\"Swift Code\";i:2;s:14:\"Account Number\";}',1,'2023-10-16 02:31:37','2023-10-16 04:24:26'),(4,'Paypal','a:4:{i:0;s:12:\"Account Name\";i:1;s:14:\"Account Number\";i:2;s:12:\"Account Type\";i:3;s:10:\"Account Id\";}',1,'2023-10-16 04:17:18','2023-10-16 04:20:51');
/*!40000 ALTER TABLE `withdraw_gateways` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `withdraw_requests`
--

DROP TABLE IF EXISTS `withdraw_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `withdraw_requests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `amount` double NOT NULL,
  `gateway_id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1=pending, 2=complete, 3=cancel',
  `gateway_fields` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `withdraw_requests`
--

LOCK TABLES `withdraw_requests` WRITE;
/*!40000 ALTER TABLE `withdraw_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `withdraw_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `words`
--

DROP TABLE IF EXISTS `words`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `words` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `word` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
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
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `item_version` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_license_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_license_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_license_msg` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `gateway` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `meta_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `session_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `track` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` bigint unsigned NOT NULL DEFAULT '0' COMMENT '0=pending,1=complete,2=cancel',
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

-- Dump completed on 2026-03-27 18:39:10
