-- MySQL dump 10.13  Distrib 8.0.44, for Win64 (x86_64)
--
-- Host: localhost    Database: coradius_it_center
-- ------------------------------------------------------
-- Server version	8.0.44

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
-- Table structure for table `accounting_transactions`
--

DROP TABLE IF EXISTS `accounting_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `accounting_transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_id` bigint unsigned DEFAULT NULL,
  `bank_account_id` bigint unsigned DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci,
  `file` text COLLATE utf8mb4_unicode_ci,
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transactionable_id` bigint unsigned NOT NULL,
  `transactionable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounting_transactions`
--

LOCK TABLES `accounting_transactions` WRITE;
/*!40000 ALTER TABLE `accounting_transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `accounting_transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `accounts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `default_for` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opening_balance` double NOT NULL DEFAULT '0',
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance` double NOT NULL DEFAULT '0',
  `withdrawal_amount` double NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `is_deletable` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activations`
--

DROP TABLE IF EXISTS `activations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `activations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `completed` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activations`
--

LOCK TABLES `activations` WRITE;
/*!40000 ALTER TABLE `activations` DISABLE KEYS */;
/*!40000 ALTER TABLE `activations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activity_logs`
--

DROP TABLE IF EXISTS `activity_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `activity_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `platform` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_logs`
--

LOCK TABLES `activity_logs` WRITE;
/*!40000 ALTER TABLE `activity_logs` DISABLE KEYS */;
INSERT INTO `activity_logs` VALUES (1,1,'http://127.0.0.1:8000/login','POST','127.0.0.1','Google Chrome','windows','2026-09-12 23:20:16','2026-09-12 23:20:16'),(2,1,'http://127.0.0.1:8000/login','POST','127.0.0.1','Google Chrome','windows','2026-09-12 23:27:27','2026-09-12 23:27:27'),(3,1,'http://127.0.0.1:8000/login','POST','127.0.0.1','Google Chrome','windows','2026-09-13 12:11:16','2026-09-13 12:11:16'),(4,1,'http://127.0.0.1:8000/login','POST','127.0.0.1','Google Chrome','windows','2026-09-13 12:23:08','2026-09-13 12:23:08'),(5,1,'http://127.0.0.1:8000/login','POST','127.0.0.1','Google Chrome','windows','2026-09-13 12:23:29','2026-09-13 12:23:29'),(6,1,'http://127.0.0.1:8000/login','POST','127.0.0.1','Google Chrome','windows','2026-09-13 12:23:33','2026-09-13 12:23:33'),(7,1,'http://127.0.0.1:8000/login','POST','127.0.0.1','Google Chrome','windows','2026-09-13 12:23:52','2026-09-13 12:23:52'),(8,1,'http://127.0.0.1:8000/login','POST','127.0.0.1','Google Chrome','windows','2026-09-13 12:23:58','2026-09-13 12:23:58');
/*!40000 ALTER TABLE `activity_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `addons`
--

DROP TABLE IF EXISTS `addons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `addons` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `addon_identifier` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '100',
  `version` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addons`
--

LOCK TABLES `addons` WRITE;
/*!40000 ALTER TABLE `addons` DISABLE KEYS */;
/*!40000 ALTER TABLE `addons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `addresses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `address_ids` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_shipping` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_billing` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addresses`
--

LOCK TABLES `addresses` WRITE;
/*!40000 ALTER TABLE `addresses` DISABLE KEYS */;
/*!40000 ALTER TABLE `addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `api_key_languages`
--

DROP TABLE IF EXISTS `api_key_languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `api_key_languages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `api_key_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `api_key_languages`
--

LOCK TABLES `api_key_languages` WRITE;
/*!40000 ALTER TABLE `api_key_languages` DISABLE KEYS */;
INSERT INTO `api_key_languages` VALUES (1,'1','Student App','en','2026-09-12 23:02:27','2026-09-12 23:02:27'),(2,'2','Instructor App','en','2026-09-12 23:02:27','2026-09-12 23:02:27');
/*!40000 ALTER TABLE `api_key_languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `api_keys`
--

DROP TABLE IF EXISTS `api_keys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `api_keys` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0 inactive, 1 active',
  `user_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `api_keys`
--

LOCK TABLES `api_keys` WRITE;
/*!40000 ALTER TABLE `api_keys` DISABLE KEYS */;
INSERT INTO `api_keys` VALUES (1,'Student App','spagreen_',1,1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(2,'Instructor App','spagreen',1,1,'2026-09-12 23:02:27','2026-09-12 23:02:27');
/*!40000 ALTER TABLE `api_keys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `applied_coupons`
--

DROP TABLE IF EXISTS `applied_coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `applied_coupons` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `instructor_id` bigint DEFAULT NULL,
  `user_id` bigint DEFAULT NULL,
  `trx_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_id` bigint DEFAULT NULL,
  `couponable_id` bigint unsigned DEFAULT NULL,
  `couponable_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_discount` double NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applied_coupons`
--

LOCK TABLES `applied_coupons` WRITE;
/*!40000 ALTER TABLE `applied_coupons` DISABLE KEYS */;
/*!40000 ALTER TABLE `applied_coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assignments`
--

DROP TABLE IF EXISTS `assignments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `assignments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint unsigned NOT NULL,
  `instructor_id` bigint unsigned NOT NULL,
  `section_id` bigint unsigned DEFAULT NULL,
  `lesson_id` bigint unsigned DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `file_media_id` bigint unsigned DEFAULT NULL,
  `file` text COLLATE utf8mb4_unicode_ci,
  `deadline` datetime NOT NULL,
  `total_marks` double NOT NULL DEFAULT '0',
  `pass_marks` double NOT NULL DEFAULT '0',
  `is_free` tinyint NOT NULL DEFAULT '0' COMMENT '1=free, 0=not free',
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0 inactive, 1 active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assignments`
--

LOCK TABLES `assignments` WRITE;
/*!40000 ALTER TABLE `assignments` DISABLE KEYS */;
/*!40000 ALTER TABLE `assignments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `badge_languages`
--

DROP TABLE IF EXISTS `badge_languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `badge_languages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `badge_id` bigint unsigned DEFAULT NULL,
  `lang` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `badge_languages`
--

LOCK TABLES `badge_languages` WRITE;
/*!40000 ALTER TABLE `badge_languages` DISABLE KEYS */;
/*!40000 ALTER TABLE `badge_languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `badges`
--

DROP TABLE IF EXISTS `badges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `badges` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `from_day` int DEFAULT NULL,
  `to_day` int DEFAULT NULL,
  `logo` text COLLATE utf8mb4_unicode_ci,
  `badge_media_id` bigint unsigned DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0 inactive, 1 active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `badges`
--

LOCK TABLES `badges` WRITE;
/*!40000 ALTER TABLE `badges` DISABLE KEYS */;
/*!40000 ALTER TABLE `badges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bank_accounts`
--

DROP TABLE IF EXISTS `bank_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bank_accounts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_holder_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_country_id` bigint unsigned NOT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opening_balance` double NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci,
  `balance` double NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bank_accounts`
--

LOCK TABLES `bank_accounts` WRITE;
/*!40000 ALTER TABLE `bank_accounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `bank_accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_categories`
--

DROP TABLE IF EXISTS `blog_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blog_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0 inactive, 1 active',
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_image` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_categories`
--

LOCK TABLES `blog_categories` WRITE;
/*!40000 ALTER TABLE `blog_categories` DISABLE KEYS */;
INSERT INTO `blog_categories` VALUES (1,'Mathematics','mathematics',1,'Mathematics','mathematics','Mathematics',NULL,'2026-09-12 23:02:21','2026-09-12 23:02:21');
/*!40000 ALTER TABLE `blog_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_category_languages`
--

DROP TABLE IF EXISTS `blog_category_languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blog_category_languages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blog_category_id` bigint unsigned DEFAULT NULL,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_category_languages`
--

LOCK TABLES `blog_category_languages` WRITE;
/*!40000 ALTER TABLE `blog_category_languages` DISABLE KEYS */;
INSERT INTO `blog_category_languages` VALUES (1,'Mathematics','en',1,'Mathematics','mathematics','Mathematics','2026-09-12 23:02:21','2026-09-12 23:02:21');
/*!40000 ALTER TABLE `blog_category_languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_comment_replies`
--

DROP TABLE IF EXISTS `blog_comment_replies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blog_comment_replies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `reply` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `blog_id` bigint unsigned DEFAULT NULL,
  `blog_comment_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_comment_replies`
--

LOCK TABLES `blog_comment_replies` WRITE;
/*!40000 ALTER TABLE `blog_comment_replies` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_comment_replies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_comments`
--

DROP TABLE IF EXISTS `blog_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blog_comments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `blog_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_comments`
--

LOCK TABLES `blog_comments` WRITE;
/*!40000 ALTER TABLE `blog_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_languages`
--

DROP TABLE IF EXISTS `blog_languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blog_languages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `blog_id` bigint unsigned DEFAULT NULL,
  `lang` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_languages`
--

LOCK TABLES `blog_languages` WRITE;
/*!40000 ALTER TABLE `blog_languages` DISABLE KEYS */;
INSERT INTO `blog_languages` VALUES (1,'The Future of Online Learning in 2026','Explore the upcoming trends in e-learning, from artificial intelligence driven personalized paths to immersive virtual classrooms.','The e-learning landscape is rapidly evolving. With advancements in AI and virtual reality, education is becoming more accessible and engaging than ever before. In this article, we dive deep into the technologies that are shaping the future of education and how institutions can adapt.',1,'en',NULL,NULL,NULL,NULL,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(2,'Top 10 Programming Languages to Learn','Discover the most in-demand programming languages that will help you land a job in the tech industry this year.','Choosing the right programming language to learn can be daunting. From Python to Go, we break down the top languages based on industry demand, salary potential, and ease of learning. Whether you are a beginner or an experienced developer, this guide will help you decide your next learning goal.',2,'en',NULL,NULL,NULL,NULL,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(3,'Balancing Work and Online Studies','Practical tips and strategies for managing a full-time job while pursuing your online degree or certification.','Juggling work, personal life, and studies requires excellent time management skills. In this post, we share actionable advice from successful adult learners on how to create a study schedule, avoid burnout, and stay motivated throughout your educational journey.',3,'en',NULL,NULL,NULL,NULL,'2026-09-12 23:02:21','2026-09-12 23:02:21');
/*!40000 ALTER TABLE `blog_languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blogs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `blog_category_id` bigint unsigned DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` text COLLATE utf8mb4_unicode_ci,
  `image_media_id` bigint unsigned DEFAULT NULL,
  `banner` text COLLATE utf8mb4_unicode_ci,
  `banner_media_id` bigint unsigned DEFAULT NULL,
  `total_view` bigint DEFAULT NULL,
  `is_featured` tinyint NOT NULL DEFAULT '0' COMMENT '1=featured, 0=no featured',
  `published_date` datetime DEFAULT NULL,
  `is_newspaper` tinyint NOT NULL DEFAULT '1' COMMENT '1=newspaper, 0=Not newspaper',
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published' COMMENT 'published, draft, pending',
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_image` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blogs`
--

LOCK TABLES `blogs` WRITE;
/*!40000 ALTER TABLE `blogs` DISABLE KEYS */;
INSERT INTO `blogs` VALUES (1,1,1,'The Future of Online Learning in 2026','the-future-of-online-learning-in-2026','Explore the upcoming trends in e-learning, from artificial intelligence driven personalized paths to immersive virtual classrooms.','The e-learning landscape is rapidly evolving. With advancements in AI and virtual reality, education is becoming more accessible and engaging than ever before. In this article, we dive deep into the technologies that are shaping the future of education and how institutions can adapt.',NULL,NULL,NULL,NULL,NULL,0,NULL,1,'published',NULL,NULL,NULL,NULL,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(2,1,1,'Top 10 Programming Languages to Learn','top-10-programming-languages-to-learn','Discover the most in-demand programming languages that will help you land a job in the tech industry this year.','Choosing the right programming language to learn can be daunting. From Python to Go, we break down the top languages based on industry demand, salary potential, and ease of learning. Whether you are a beginner or an experienced developer, this guide will help you decide your next learning goal.',NULL,NULL,NULL,NULL,NULL,0,NULL,1,'published',NULL,NULL,NULL,NULL,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(3,1,1,'Balancing Work and Online Studies','balancing-work-and-online-studies','Practical tips and strategies for managing a full-time job while pursuing your online degree or certification.','Juggling work, personal life, and studies requires excellent time management skills. In this post, we share actionable advice from successful adult learners on how to create a study schedule, avoid burnout, and stay motivated throughout your educational journey.',NULL,NULL,NULL,NULL,NULL,0,NULL,1,'published',NULL,NULL,NULL,NULL,'2026-09-12 23:02:21','2026-09-12 23:02:21');
/*!40000 ALTER TABLE `blogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `books` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `instructor_id` bigint unsigned DEFAULT NULL,
  `organization_id` bigint unsigned DEFAULT NULL,
  `category_ids` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `available_format` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double NOT NULL DEFAULT '0',
  `publication` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_stock` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `specification` text COLLATE utf8mb4_unicode_ci,
  `thumbnail` text COLLATE utf8mb4_unicode_ci,
  `discount_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` double NOT NULL DEFAULT '0',
  `discount_start_at` datetime DEFAULT NULL,
  `discount_end_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `is_free` tinyint NOT NULL DEFAULT '0' COMMENT '1=free, 0=not free',
  `subject_id` bigint unsigned DEFAULT NULL,
  `total_rating` double NOT NULL DEFAULT '0',
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_image` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0 inactive, 1 active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `brands` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `logo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_media_id` bigint unsigned DEFAULT NULL,
  `order_no` int DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0 inactive, 1 active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bundle_courses`
--

DROP TABLE IF EXISTS `bundle_courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bundle_courses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `organization_id` bigint unsigned DEFAULT NULL,
  `instructor_id` bigint unsigned DEFAULT NULL,
  `course_ids` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_free` tinyint NOT NULL DEFAULT '0' COMMENT '1=free, 0=not free',
  `price` double NOT NULL DEFAULT '0',
  `discount` double NOT NULL DEFAULT '0',
  `discount_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_period` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `bundle_media_id` bigint unsigned DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0 inactive, 1 active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bundle_courses`
--

LOCK TABLES `bundle_courses` WRITE;
/*!40000 ALTER TABLE `bundle_courses` DISABLE KEYS */;
/*!40000 ALTER TABLE `bundle_courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `instructor_id` text COLLATE utf8mb4_unicode_ci,
  `user_id` bigint DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `price` double NOT NULL DEFAULT '0',
  `discount` double NOT NULL DEFAULT '0',
  `trx_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_id` bigint DEFAULT NULL,
  `coupon_discount` double NOT NULL DEFAULT '0',
  `tax` double NOT NULL DEFAULT '0',
  `sub_total` double NOT NULL DEFAULT '0',
  `total_amount` double NOT NULL DEFAULT '0',
  `shipping_cost` double NOT NULL DEFAULT '0',
  `cartable_id` bigint unsigned DEFAULT NULL,
  `cartable_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_buy_now` tinyint NOT NULL DEFAULT '0' COMMENT '1=buy now available, 0=not available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carts`
--

LOCK TABLES `carts` WRITE;
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
/*!40000 ALTER TABLE `carts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint DEFAULT NULL,
  `icon` text COLLATE utf8mb4_unicode_ci,
  `image` text COLLATE utf8mb4_unicode_ci,
  `image_media_id` text COLLATE utf8mb4_unicode_ci,
  `position` int DEFAULT NULL,
  `ordering` int DEFAULT NULL,
  `is_featured` tinyint NOT NULL DEFAULT '0' COMMENT '1=featured, 0=not feature',
  `total_courses` int NOT NULL DEFAULT '0',
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_image` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0 inactive, 1 active',
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Computer Science','computer-science',0,NULL,NULL,NULL,1,NULL,0,0,'Computer Science','Computer Science, IT, Programming','Explore the world of Computer Science and Programming.',NULL,1,'course','2026-09-12 23:02:21','2026-09-13 00:30:32'),(2,'Business Administration','business-administration',0,NULL,NULL,NULL,2,NULL,0,1,'Business Administration','Business, Management, Finance','Learn essential business administration skills.',NULL,1,'course','2026-09-12 23:02:21','2026-09-12 23:02:21'),(3,'Data Science','data-science',0,NULL,NULL,NULL,3,NULL,0,0,'Data Science','Data Science, Machine Learning, AI','Master data science, machine learning, and AI.',NULL,1,'course','2026-09-12 23:02:21','2026-09-12 23:02:21');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_languages`
--

DROP TABLE IF EXISTS `category_languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category_languages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` bigint unsigned DEFAULT NULL,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_languages`
--

LOCK TABLES `category_languages` WRITE;
/*!40000 ALTER TABLE `category_languages` DISABLE KEYS */;
INSERT INTO `category_languages` VALUES (1,'Computer Science','en',1,NULL,NULL,NULL,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(2,'Business Administration','en',2,NULL,NULL,NULL,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(3,'Data Science','en',3,NULL,NULL,NULL,'2026-09-12 23:02:21','2026-09-12 23:02:21');
/*!40000 ALTER TABLE `category_languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `certificates`
--

DROP TABLE IF EXISTS `certificates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `certificates` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint unsigned DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci,
  `custom_fields` json DEFAULT NULL,
  `instructor_signature` text COLLATE utf8mb4_unicode_ci,
  `instructor_signature_media_id` bigint unsigned DEFAULT NULL,
  `administrator_signature` text COLLATE utf8mb4_unicode_ci,
  `administrator_signature_media_id` bigint unsigned DEFAULT NULL,
  `background_image` text COLLATE utf8mb4_unicode_ci,
  `background_image_media_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `certificates`
--

LOCK TABLES `certificates` WRITE;
/*!40000 ALTER TABLE `certificates` DISABLE KEYS */;
INSERT INTO `certificates` VALUES (1,1,'Web Develpoment Certificate','It is a long established fact that a reader Will Smith will be distracted by the readable content of\r\n            a page when looking at its layout.Laravel For Beginners - Become A Laravel Master - CMS\r\n            Project It is a long established fact that a reader will be distracted by the readable content of a\r\n            page when looking at its layout.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-09-12 23:02:22','2026-09-12 23:02:22');
/*!40000 ALTER TABLE `certificates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat_rooms`
--

DROP TABLE IF EXISTS `chat_rooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chat_rooms` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `receiver_id` bigint unsigned DEFAULT NULL,
  `is_accepted` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat_rooms`
--

LOCK TABLES `chat_rooms` WRITE;
/*!40000 ALTER TABLE `chat_rooms` DISABLE KEYS */;
/*!40000 ALTER TABLE `chat_rooms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `checkouts`
--

DROP TABLE IF EXISTS `checkouts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `checkouts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `billing_address` text COLLATE utf8mb4_unicode_ci,
  `shipping_address` text COLLATE utf8mb4_unicode_ci,
  `trx_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_total` double NOT NULL DEFAULT '0',
  `tax` double NOT NULL DEFAULT '0',
  `discount` double NOT NULL DEFAULT '0',
  `shipping_cost` double NOT NULL DEFAULT '0',
  `coupon_discount` double NOT NULL DEFAULT '0',
  `system_commission` double NOT NULL DEFAULT '0',
  `organization_commission` double NOT NULL DEFAULT '0',
  `total_amount` double NOT NULL DEFAULT '0',
  `payable_amount` double NOT NULL DEFAULT '0',
  `invoice_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_date` datetime DEFAULT NULL,
  `payment_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_details` text COLLATE utf8mb4_unicode_ci,
  `offline_method_id` bigint unsigned DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 => paid, 0 => unpaid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `checkouts`
--

LOCK TABLES `checkouts` WRITE;
/*!40000 ALTER TABLE `checkouts` DISABLE KEYS */;
INSERT INTO `checkouts` VALUES (1,1,NULL,NULL,'zAsjaTtxFWIn',0,0,0,0,0,0,0,0,0,'OVOY-8352222732','2026-09-13 17:41:39','direct','{\"type\":\"free\",\"status\":\"success\"}',NULL,1,'2026-09-13 11:41:39','2026-09-13 11:41:39'),(2,6,NULL,NULL,'YgYpxwaGbw9o',0,0,0,0,0,0,0,0,0,'OVOY-1854113443','2026-09-13 18:08:23','direct','{\"type\":\"free\",\"status\":\"success\"}',NULL,1,'2026-09-13 12:08:23','2026-09-13 12:08:23');
/*!40000 ALTER TABLE `checkouts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` bigint unsigned DEFAULT NULL,
  `state_id` bigint unsigned DEFAULT NULL,
  `latitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost` double NOT NULL DEFAULT '0',
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0 inactive, 1 active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cities`
--

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment_replies`
--

DROP TABLE IF EXISTS `comment_replies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comment_replies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `comment_id` bigint unsigned DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0 inactive, 1 active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment_replies`
--

LOCK TABLES `comment_replies` WRITE;
/*!40000 ALTER TABLE `comment_replies` DISABLE KEYS */;
/*!40000 ALTER TABLE `comment_replies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `user_id` bigint DEFAULT NULL,
  `course_id` bigint DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1=active, 0=inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contacts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `instructor_id` bigint unsigned DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0 inactive, 1 active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `countries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iso3` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iso2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phonecode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_symbol` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0 inactive, 1 active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=251 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'Afghanistan','AFG','AF','93','AFN','؋','33.00000000','65.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(2,'Aland Islands','ALA','AX','+358-18','EUR','€','60.11666700','19.90000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(3,'Albania','ALB','AL','355','ALL','Lek','41.00000000','20.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(4,'Algeria','DZA','DZ','213','DZD','دج','28.00000000','3.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(5,'American Samoa','ASM','AS','+1-684','USD','$','-14.33333333','-170.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(6,'Andorra','AND','AD','376','EUR','€','42.50000000','1.50000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(7,'Angola','AGO','AO','244','AOA','Kz','-12.50000000','18.50000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(8,'Anguilla','AIA','AI','+1-264','XCD','$','18.25000000','-63.16666666',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(9,'Antarctica','ATA','AQ','672','AAD','$','-74.65000000','4.48000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(10,'Antigua And Barbuda','ATG','AG','+1-268','XCD','$','17.05000000','-61.80000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(11,'Argentina','ARG','AR','54','ARS','$','-34.00000000','-64.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(12,'Armenia','ARM','AM','374','AMD','֏','40.00000000','45.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(13,'Aruba','ABW','AW','297','AWG','ƒ','12.50000000','-69.96666666',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(14,'Australia','AUS','AU','61','AUD','$','-27.00000000','133.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(15,'Austria','AUT','AT','43','EUR','€','47.33333333','13.33333333',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(16,'Azerbaijan','AZE','AZ','994','AZN','m','40.50000000','47.50000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(17,'Bahamas The','BHS','BS','+1-242','BSD','B$','24.25000000','-76.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(18,'Bahrain','BHR','BH','973','BHD','.د.ب','26.00000000','50.55000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(19,'Bangladesh','BGD','BD','880','BDT','৳','24.00000000','90.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(20,'Barbados','BRB','BB','+1-246','BBD','Bds$','13.16666666','-59.53333333',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(21,'Belarus','BLR','BY','375','BYN','Br','53.00000000','28.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(22,'Belgium','BEL','BE','32','EUR','€','50.83333333','4.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(23,'Belize','BLZ','BZ','501','BZD','$','17.25000000','-88.75000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(24,'Benin','BEN','BJ','229','XOF','CFA','9.50000000','2.25000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(25,'Bermuda','BMU','BM','+1-441','BMD','$','32.33333333','-64.75000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(26,'Bhutan','BTN','BT','975','BTN','Nu.','27.50000000','90.50000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(27,'Bolivia','BOL','BO','591','BOB','Bs.','-17.00000000','-65.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(28,'Bosnia and Herzegovina','BIH','BA','387','BAM','KM','44.00000000','18.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(29,'Botswana','BWA','BW','267','BWP','P','-22.00000000','24.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(30,'Bouvet Island','BVT','BV','0055','NOK','kr','-54.43333333','3.40000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(31,'Brazil','BRA','BR','55','BRL','R$','-10.00000000','-55.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(32,'British Indian Ocean Territory','IOT','IO','246','USD','$','-6.00000000','71.50000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(33,'Brunei','BRN','BN','673','BND','B$','4.50000000','114.66666666',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(34,'Bulgaria','BGR','BG','359','BGN','Лв.','43.00000000','25.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(35,'Burkina Faso','BFA','BF','226','XOF','CFA','13.00000000','-2.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(36,'Burundi','BDI','BI','257','BIF','FBu','-3.50000000','30.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(37,'Cambodia','KHM','KH','855','KHR','KHR','13.00000000','105.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(38,'Cameroon','CMR','CM','237','XAF','FCFA','6.00000000','12.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(39,'Canada','CAN','CA','1','CAD','$','60.00000000','-95.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(40,'Cape Verde','CPV','CV','238','CVE','$','16.00000000','-24.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(41,'Cayman Islands','CYM','KY','+1-345','KYD','$','19.50000000','-80.50000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(42,'Central African Republic','CAF','CF','236','XAF','FCFA','7.00000000','21.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(43,'Chad','TCD','TD','235','XAF','FCFA','15.00000000','19.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(44,'Chile','CHL','CL','56','CLP','$','-30.00000000','-71.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(45,'China','CHN','CN','86','CNY','¥','35.00000000','105.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(46,'Christmas Island','CXR','CX','61','AUD','$','-10.50000000','105.66666666',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(47,'Cocos (Keeling) Islands','CCK','CC','61','AUD','$','-12.50000000','96.83333333',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(48,'Colombia','COL','CO','57','COP','$','4.00000000','-72.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(49,'Comoros','COM','KM','269','KMF','CF','-12.16666666','44.25000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(50,'Congo','COG','CG','242','XAF','FC','-1.00000000','15.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(51,'Democratic Republic of the Congo','COD','CD','243','CDF','FC','0.00000000','25.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(52,'Cook Islands','COK','CK','682','NZD','$','-21.23333333','-159.76666666',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(53,'Costa Rica','CRI','CR','506','CRC','₡','10.00000000','-84.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(54,'Cote D\'Ivoire (Ivory Coast)','CIV','CI','225','XOF','CFA','8.00000000','-5.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(55,'Croatia','HRV','HR','385','HRK','kn','45.16666666','15.50000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(56,'Cuba','CUB','CU','53','CUP','$','21.50000000','-80.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(57,'Cyprus','CYP','CY','357','EUR','€','35.00000000','33.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(58,'Czech Republic','CZE','CZ','420','CZK','Kč','49.75000000','15.50000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(59,'Denmark','DNK','DK','45','DKK','Kr.','56.00000000','10.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(60,'Djibouti','DJI','DJ','253','DJF','Fdj','11.50000000','43.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(61,'Dominica','DMA','DM','+1-767','XCD','$','15.41666666','-61.33333333',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(62,'Dominican Republic','DOM','DO','+1-809 and 1-829','DOP','$','19.00000000','-70.66666666',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(63,'East Timor','TLS','TL','670','USD','$','-8.83333333','125.91666666',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(64,'Ecuador','ECU','EC','593','USD','$','-2.00000000','-77.50000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(65,'Egypt','EGY','EG','20','EGP','ج.م','27.00000000','30.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(66,'El Salvador','SLV','SV','503','USD','$','13.83333333','-88.91666666',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(67,'Equatorial Guinea','GNQ','GQ','240','XAF','FCFA','2.00000000','10.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(68,'Eritrea','ERI','ER','291','ERN','Nfk','15.00000000','39.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(69,'Estonia','EST','EE','372','EUR','€','59.00000000','26.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(70,'Ethiopia','ETH','ET','251','ETB','Nkf','8.00000000','38.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(71,'Falkland Islands','FLK','FK','500','FKP','£','-51.75000000','-59.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(72,'Faroe Islands','FRO','FO','298','DKK','Kr.','62.00000000','-7.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(73,'Fiji Islands','FJI','FJ','679','FJD','FJ$','-18.00000000','175.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(74,'Finland','FIN','FI','358','EUR','€','64.00000000','26.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(75,'France','FRA','FR','33','EUR','€','46.00000000','2.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(76,'French Guiana','GUF','GF','594','EUR','€','4.00000000','-53.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(77,'French Polynesia','PYF','PF','689','XPF','₣','-15.00000000','-140.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(78,'French Southern Territories','ATF','TF','262','EUR','€','-49.25000000','69.16700000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(79,'Gabon','GAB','GA','241','XAF','FCFA','-1.00000000','11.75000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(80,'Gambia The','GMB','GM','220','GMD','D','13.46666666','-16.56666666',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(81,'Georgia','GEO','GE','995','GEL','ლ','42.00000000','43.50000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(82,'Germany','DEU','DE','49','EUR','€','51.00000000','9.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(83,'Ghana','GHA','GH','233','GHS','GH₵','8.00000000','-2.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(84,'Gibraltar','GIB','GI','350','GIP','£','36.13333333','-5.35000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(85,'Greece','GRC','GR','30','EUR','€','39.00000000','22.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(86,'Greenland','GRL','GL','299','DKK','Kr.','72.00000000','-40.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(87,'Grenada','GRD','GD','+1-473','XCD','$','12.11666666','-61.66666666',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(88,'Guadeloupe','GLP','GP','590','EUR','€','16.25000000','-61.58333300',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(89,'Guam','GUM','GU','+1-671','USD','$','13.46666666','144.78333333',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(90,'Guatemala','GTM','GT','502','GTQ','Q','15.50000000','-90.25000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(91,'Guernsey and Alderney','GGY','GG','+44-1481','GBP','£','49.46666666','-2.58333333',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(92,'Guinea','GIN','GN','224','GNF','FG','11.00000000','-10.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(93,'Guinea-Bissau','GNB','GW','245','XOF','CFA','12.00000000','-15.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(94,'Guyana','GUY','GY','592','GYD','$','5.00000000','-59.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(95,'Haiti','HTI','HT','509','HTG','G','19.00000000','-72.41666666',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(96,'Heard Island and McDonald Islands','HMD','HM','672','AUD','$','-53.10000000','72.51666666',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(97,'Honduras','HND','HN','504','HNL','L','15.00000000','-86.50000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(98,'Hong Kong S.A.R.','HKG','HK','852','HKD','$','22.25000000','114.16666666',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(99,'Hungary','HUN','HU','36','HUF','Ft','47.00000000','20.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(100,'Iceland','ISL','IS','354','ISK','kr','65.00000000','-18.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(101,'India','IND','IN','91','INR','₹','20.00000000','77.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(102,'Indonesia','IDN','ID','62','IDR','Rp','-5.00000000','120.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(103,'Iran','IRN','IR','98','IRR','﷼','32.00000000','53.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(104,'Iraq','IRQ','IQ','964','IQD','د.ع','33.00000000','44.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(105,'Ireland','IRL','IE','353','EUR','€','53.00000000','-8.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(106,'Israel','ISR','IL','972','ILS','₪','31.50000000','34.75000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(107,'Italy','ITA','IT','39','EUR','€','42.83333333','12.83333333',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(108,'Jamaica','JAM','JM','+1-876','JMD','J$','18.25000000','-77.50000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(109,'Japan','JPN','JP','81','JPY','¥','36.00000000','138.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(110,'Jersey','JEY','JE','+44-1534','GBP','£','49.25000000','-2.16666666',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(111,'Jordan','JOR','JO','962','JOD','ا.د','31.00000000','36.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(112,'Kazakhstan','KAZ','KZ','7','KZT','лв','48.00000000','68.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(113,'Kenya','KEN','KE','254','KES','KSh','1.00000000','38.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(114,'Kiribati','KIR','KI','686','AUD','$','1.41666666','173.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(115,'North Korea','PRK','KP','850','KPW','₩','40.00000000','127.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(116,'South Korea','KOR','KR','82','KRW','₩','37.00000000','127.50000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(117,'Kuwait','KWT','KW','965','KWD','ك.د','29.50000000','45.75000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(118,'Kyrgyzstan','KGZ','KG','996','KGS','лв','41.00000000','75.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(119,'Laos','LAO','LA','856','LAK','₭','18.00000000','105.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(120,'Latvia','LVA','LV','371','EUR','€','57.00000000','25.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(121,'Lebanon','LBN','LB','961','LBP','£','33.83333333','35.83333333',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(122,'Lesotho','LSO','LS','266','LSL','L','-29.50000000','28.50000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(123,'Liberia','LBR','LR','231','LRD','$','6.50000000','-9.50000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(124,'Libya','LBY','LY','218','LYD','د.ل','25.00000000','17.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(125,'Liechtenstein','LIE','LI','423','CHF','CHf','47.26666666','9.53333333',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(126,'Lithuania','LTU','LT','370','EUR','€','56.00000000','24.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(127,'Luxembourg','LUX','LU','352','EUR','€','49.75000000','6.16666666',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(128,'Macau S.A.R.','MAC','MO','853','MOP','$','22.16666666','113.55000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(129,'Macedonia','MKD','MK','389','MKD','ден','41.83333333','22.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(130,'Madagascar','MDG','MG','261','MGA','Ar','-20.00000000','47.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(131,'Malawi','MWI','MW','265','MWK','MK','-13.50000000','34.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(132,'Malaysia','MYS','MY','60','MYR','RM','2.50000000','112.50000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(133,'Maldives','MDV','MV','960','MVR','Rf','3.25000000','73.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(134,'Mali','MLI','ML','223','XOF','CFA','17.00000000','-4.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(135,'Malta','MLT','MT','356','EUR','€','35.83333333','14.58333333',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(136,'Man (Isle of)','IMN','IM','+44-1624','GBP','£','54.25000000','-4.50000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(137,'Marshall Islands','MHL','MH','692','USD','$','9.00000000','168.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(138,'Martinique','MTQ','MQ','596','EUR','€','14.66666700','-61.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(139,'Mauritania','MRT','MR','222','MRO','MRU','20.00000000','-12.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(140,'Mauritius','MUS','MU','230','MUR','₨','-20.28333333','57.55000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(141,'Mayotte','MYT','YT','262','EUR','€','-12.83333333','45.16666666',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(142,'Mexico','MEX','MX','52','MXN','$','23.00000000','-102.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(143,'Micronesia','FSM','FM','691','USD','$','6.91666666','158.25000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(144,'Moldova','MDA','MD','373','MDL','L','47.00000000','29.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(145,'Monaco','MCO','MC','377','EUR','€','43.73333333','7.40000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(146,'Mongolia','MNG','MN','976','MNT','₮','46.00000000','105.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(147,'Montenegro','MNE','ME','382','EUR','€','42.50000000','19.30000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(148,'Montserrat','MSR','MS','+1-664','XCD','$','16.75000000','-62.20000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(149,'Morocco','MAR','MA','212','MAD','DH','32.00000000','-5.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(150,'Mozambique','MOZ','MZ','258','MZN','MT','-18.25000000','35.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(151,'Myanmar','MMR','MM','95','MMK','K','22.00000000','98.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(152,'Namibia','NAM','NA','264','NAD','$','-22.00000000','17.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(153,'Nauru','NRU','NR','674','AUD','$','-0.53333333','166.91666666',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(154,'Nepal','NPL','NP','977','NPR','₨','28.00000000','84.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(155,'Bonaire, Sint Eustatius and Saba','BES','BQ','599','USD','$','12.15000000','-68.26666700',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(156,'Netherlands','NLD','NL','31','EUR','€','52.50000000','5.75000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(157,'New Caledonia','NCL','NC','687','XPF','₣','-21.50000000','165.50000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(158,'New Zealand','NZL','NZ','64','NZD','$','-41.00000000','174.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(159,'Nicaragua','NIC','NI','505','NIO','C$','13.00000000','-85.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(160,'Niger','NER','NE','227','XOF','CFA','16.00000000','8.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(161,'Nigeria','NGA','NG','234','NGN','₦','10.00000000','8.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(162,'Niue','NIU','NU','683','NZD','$','-19.03333333','-169.86666666',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(163,'Norfolk Island','NFK','NF','672','AUD','$','-29.03333333','167.95000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(164,'Northern Mariana Islands','MNP','MP','+1-670','USD','$','15.20000000','145.75000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(165,'Norway','NOR','NO','47','NOK','kr','62.00000000','10.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(166,'Oman','OMN','OM','968','OMR','.ع.ر','21.00000000','57.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(167,'Pakistan','PAK','PK','92','PKR','₨','30.00000000','70.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(168,'Palau','PLW','PW','680','USD','$','7.50000000','134.50000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(169,'Palestinian Territory Occupied','PSE','PS','970','ILS','₪','31.90000000','35.20000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(170,'Panama','PAN','PA','507','PAB','B/.','9.00000000','-80.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(171,'Papua new Guinea','PNG','PG','675','PGK','K','-6.00000000','147.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(172,'Paraguay','PRY','PY','595','PYG','₲','-23.00000000','-58.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(173,'Peru','PER','PE','51','PEN','S/.','-10.00000000','-76.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(174,'Philippines','PHL','PH','63','PHP','₱','13.00000000','122.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(175,'Pitcairn Island','PCN','PN','870','NZD','$','-25.06666666','-130.10000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(176,'Poland','POL','PL','48','PLN','zł','52.00000000','20.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(177,'Portugal','PRT','PT','351','EUR','€','39.50000000','-8.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(178,'Puerto Rico','PRI','PR','+1-787 and 1-939','USD','$','18.25000000','-66.50000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(179,'Qatar','QAT','QA','974','QAR','ق.ر','25.50000000','51.25000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(180,'Reunion','REU','RE','262','EUR','€','-21.15000000','55.50000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(181,'Romania','ROU','RO','40','RON','lei','46.00000000','25.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(182,'Russia','RUS','RU','7','RUB','₽','60.00000000','100.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(183,'Rwanda','RWA','RW','250','RWF','FRw','-2.00000000','30.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(184,'Saint Helena','SHN','SH','290','SHP','£','-15.95000000','-5.70000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(185,'Saint Kitts And Nevis','KNA','KN','+1-869','XCD','$','17.33333333','-62.75000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(186,'Saint Lucia','LCA','LC','+1-758','XCD','$','13.88333333','-60.96666666',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(187,'Saint Pierre and Miquelon','SPM','PM','508','EUR','€','46.83333333','-56.33333333',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(188,'Saint Vincent And The Grenadines','VCT','VC','+1-784','XCD','$','13.25000000','-61.20000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(189,'Saint-Barthelemy','BLM','BL','590','EUR','€','18.50000000','-63.41666666',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(190,'Saint-Martin (French part)','MAF','MF','590','EUR','€','18.08333333','-63.95000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(191,'Samoa','WSM','WS','685','WST','SAT','-13.58333333','-172.33333333',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(192,'San Marino','SMR','SM','378','EUR','€','43.76666666','12.41666666',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(193,'Sao Tome and Principe','STP','ST','239','STD','Db','1.00000000','7.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(194,'Saudi Arabia','SAU','SA','966','SAR','﷼','25.00000000','45.00000000',1,'2018-07-20 08:11:03','2021-09-26 01:09:09'),(195,'Senegal','SEN','SN','221','XOF','CFA','14.00000000','-14.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(196,'Serbia','SRB','RS','381','RSD','din','44.00000000','21.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(197,'Seychelles','SYC','SC','248','SCR','SRe','-4.58333333','55.66666666',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(198,'Sierra Leone','SLE','SL','232','SLL','Le','8.50000000','-11.50000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(199,'Singapore','SGP','SG','65','SGD','$','1.36666666','103.80000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(200,'Slovakia','SVK','SK','421','EUR','€','48.66666666','19.50000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(201,'Slovenia','SVN','SI','386','EUR','€','46.11666666','14.81666666',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(202,'Solomon Islands','SLB','SB','677','SBD','Si$','-8.00000000','159.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(203,'Somalia','SOM','SO','252','SOS','Sh.so.','10.00000000','49.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(204,'South Africa','ZAF','ZA','27','ZAR','R','-29.00000000','24.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(205,'South Georgia','SGS','GS','500','GBP','£','-54.50000000','-37.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(206,'South Sudan','SSD','SS','211','SSP','£','7.00000000','30.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(207,'Spain','ESP','ES','34','EUR','€','40.00000000','-4.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(208,'Sri Lanka','LKA','LK','94','LKR','Rs','7.00000000','81.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(209,'Sudan','SDN','SD','249','SDG','.س.ج','15.00000000','30.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(210,'Suriname','SUR','SR','597','SRD','$','4.00000000','-56.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(211,'Svalbard And Jan Mayen Islands','SJM','SJ','47','NOK','kr','78.00000000','20.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(212,'Swaziland','SWZ','SZ','268','SZL','E','-26.50000000','31.50000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(213,'Sweden','SWE','SE','46','SEK','kr','62.00000000','15.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(214,'Switzerland','CHE','CH','41','CHF','CHf','47.00000000','8.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(215,'Syria','SYR','SY','963','SYP','LS','35.00000000','38.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(216,'Taiwan','TWN','TW','886','TWD','$','23.50000000','121.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(217,'Tajikistan','TJK','TJ','992','TJS','SM','39.00000000','71.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(218,'Tanzania','TZA','TZ','255','TZS','TSh','-6.00000000','35.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(219,'Thailand','THA','TH','66','THB','฿','15.00000000','100.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(220,'Togo','TGO','TG','228','XOF','CFA','8.00000000','1.16666666',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(221,'Tokelau','TKL','TK','690','NZD','$','-9.00000000','-172.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(222,'Tonga','TON','TO','676','TOP','$','-20.00000000','-175.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(223,'Trinidad And Tobago','TTO','TT','+1-868','TTD','$','11.00000000','-61.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(224,'Tunisia','TUN','TN','216','TND','ت.د','34.00000000','9.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(225,'Turkey','TUR','TR','90','TRY','₺','39.00000000','35.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(226,'Turkmenistan','TKM','TM','993','TMT','T','40.00000000','60.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(227,'Turks And Caicos Islands','TCA','TC','+1-649','USD','$','21.75000000','-71.58333333',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(228,'Tuvalu','TUV','TV','688','AUD','$','-8.00000000','178.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(229,'Uganda','UGA','UG','256','UGX','USh','1.00000000','32.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(230,'Ukraine','UKR','UA','380','UAH','₴','49.00000000','32.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(231,'United Arab Emirates','ARE','AE','971','AED','إ.د','24.00000000','54.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(232,'United Kingdom','GBR','GB','44','GBP','£','54.00000000','-2.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(233,'United States','USA','US','1','USD','$','38.00000000','-97.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(234,'United States Minor Outlying Islands','UMI','UM','1','USD','$','0.00000000','0.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(235,'Uruguay','URY','UY','598','UYU','$','-33.00000000','-56.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(236,'Uzbekistan','UZB','UZ','998','UZS','лв','41.00000000','64.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(237,'Vanuatu','VUT','VU','678','VUV','VT','-16.00000000','167.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(238,'Vatican City State (Holy See)','VAT','VA','379','EUR','€','41.90000000','12.45000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(239,'Venezuela','VEN','VE','58','VEF','Bs','8.00000000','-66.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(240,'Vietnam','VNM','VN','84','VND','₫','16.16666666','107.83333333',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(241,'Virgin Islands (British)','VGB','VG','+1-284','USD','$','18.43138300','-64.62305000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(242,'Virgin Islands (US)','VIR','VI','+1-340','USD','$','18.34000000','-64.93000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(243,'Wallis And Futuna Islands','WLF','WF','681','XPF','₣','-13.30000000','-176.20000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(244,'Western Sahara','ESH','EH','212','MAD','MAD','24.50000000','-13.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(245,'Yemen','YEM','YE','967','YER','﷼','15.00000000','48.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(246,'Zambia','ZMB','ZM','260','ZMW','ZK','-15.00000000','30.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(247,'Zimbabwe','ZWE','ZW','263','ZWL','$','-20.00000000','30.00000000',1,'2018-07-20 08:11:03','2021-08-01 02:37:27'),(248,'Kosovo','XKX','XK','383','EUR','€','42.56129090','20.34030350',1,'2020-08-15 03:33:50','2021-08-01 02:37:57'),(249,'Curaçao','CUW','CW','599','ANG','ƒ','12.11666700','-68.93333300',1,'2020-10-25 02:54:20','2021-08-01 02:37:27'),(250,'Sint Maarten (Dutch part)','SXM','SX','1721','ANG','ƒ','18.03333300','-63.05000000',1,'2020-12-05 01:03:39','2021-08-01 02:37:27');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupon_languages`
--

DROP TABLE IF EXISTS `coupon_languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coupon_languages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `lang` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupon_languages`
--

LOCK TABLES `coupon_languages` WRITE;
/*!40000 ALTER TABLE `coupon_languages` DISABLE KEYS */;
INSERT INTO `coupon_languages` VALUES (1,'en','Coradius It Center.',1,'2026-09-12 23:02:21','2026-09-13 12:25:42');
/*!40000 ALTER TABLE `coupon_languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coupons` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `for` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'course',
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `coupon_media_id` bigint unsigned DEFAULT NULL,
  `discount_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` double NOT NULL DEFAULT '0',
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `course_ids` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instructor_ids` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_ids` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0 inactive, 1 active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupons`
--

LOCK TABLES `coupons` WRITE;
/*!40000 ALTER TABLE `coupons` DISABLE KEYS */;
INSERT INTO `coupons` VALUES (1,'Coradius It Center.','spagreen404','course','course','CIC40','{\"storage\":\"local\",\"original_image\":\"images\\/20260913121710_original__media_57.webp\",\"image_40x40\":\"images\\/20260913121710image_40x40_media_432.webp\",\"image_80x80\":\"images\\/20260913121710image_80x80_media_302.webp\",\"image_68x48\":\"images\\/20260913121710image_68x48_media_339.webp\",\"image_190x230\":\"images\\/20260913121710image_190x230_media_441.webp\",\"image_163x116\":\"images\\/20260913121710image_163x116_media_439.webp\",\"image_295x248\":\"images\\/20260913121710image_295x248_media_383.webp\",\"image_417x384\":\"images\\/20260913121710image_417x384_media_245.webp\",\"image_thumbnail\":\"images\\/20260913121710image_thumbnail_media_231.webp\",\"image_402x238\":\"images\\/20260913121716image_402x238-454.webp\"}',2,'percent',40,'2026-09-13 00:00:00','2026-10-13 00:00:00','[\"1\"]','[1]',NULL,1,1,'2026-09-12 23:02:27','2026-09-13 12:25:42');
/*!40000 ALTER TABLE `coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_progress`
--

DROP TABLE IF EXISTS `course_progress`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_progress` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `course_id` bigint unsigned NOT NULL,
  `section_id` bigint unsigned NOT NULL,
  `lesson_id` bigint unsigned NOT NULL,
  `total_duration` double NOT NULL DEFAULT '0',
  `total_spent_time` double NOT NULL DEFAULT '0',
  `progress` double NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_progress`
--

LOCK TABLES `course_progress` WRITE;
/*!40000 ALTER TABLE `course_progress` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_progress` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_user`
--

DROP TABLE IF EXISTS `course_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_user` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_user`
--

LOCK TABLES `course_user` WRITE;
/*!40000 ALTER TABLE `course_user` DISABLE KEYS */;
INSERT INTO `course_user` VALUES (1,1,2,'2026-09-12 23:02:23','2026-09-12 23:02:23'),(2,2,2,'2026-09-12 23:02:23','2026-09-12 23:02:23');
/*!40000 ALTER TABLE `course_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `courses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_subtitle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `description_subtitle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint DEFAULT NULL,
  `instructor_ids` text COLLATE utf8mb4_unicode_ci,
  `category_id` bigint unsigned DEFAULT NULL,
  `course_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capacity` int DEFAULT NULL,
  `class_ends_at` date DEFAULT NULL,
  `language_id` bigint unsigned DEFAULT NULL,
  `organization_id` bigint unsigned DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_private` tinyint NOT NULL DEFAULT '0' COMMENT '1=privet, 0=not privet',
  `video_source` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_media_id` bigint unsigned DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `faq_image` text COLLATE utf8mb4_unicode_ci,
  `faq_image_media_id` bigint DEFAULT NULL,
  `masterclass_settings` text COLLATE utf8mb4_unicode_ci,
  `duration` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_downloadable` tinyint NOT NULL DEFAULT '0' COMMENT '1=downloadable, 0=not downloadable',
  `is_free` tinyint NOT NULL DEFAULT '0' COMMENT '1=free, 0=not free',
  `price` double NOT NULL DEFAULT '0',
  `is_discountable` tinyint(1) NOT NULL DEFAULT '0',
  `discount_type` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` double DEFAULT '0',
  `discount_start_at` datetime DEFAULT NULL,
  `discount_end_at` datetime DEFAULT NULL,
  `is_featured` tinyint NOT NULL DEFAULT '0' COMMENT '1=featured, 0=no featured',
  `deleted_at` datetime DEFAULT NULL,
  `tags` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level_id` bigint unsigned DEFAULT NULL,
  `subject_id` bigint unsigned DEFAULT NULL,
  `is_renewable` tinyint(1) NOT NULL DEFAULT '0',
  `renew_after` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '90' COMMENT 'after 90days',
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_image` text COLLATE utf8mb4_unicode_ci,
  `total_lesson` int NOT NULL DEFAULT '0',
  `total_enrolled` int NOT NULL DEFAULT '0',
  `total_rating` double NOT NULL DEFAULT '0',
  `is_published` tinyint NOT NULL DEFAULT '0' COMMENT '0 unpublished, 1 published',
  `status` enum('draft','in_review','rejected','approved') COLLATE utf8mb4_unicode_ci DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (1,'ডিজিটাল দক্ষতা শিখুন','অনলাইনে নিজের ক্যারিয়ার গড়ুন','dijital-dkshta-sikhun','ফ্রিল্যান্সিং, AI, কনটেন্ট ক্রিয়েশন, ইউটিউব অটোমেশন, ডিজিটাল মার্কেটিং, গ্রাফিক ডিজাইন, ভিডিও এডিটিং, ওয়েব ডিজাইন, সোশ্যাল মিডিয়া মার্কেটিং ও অনলাইন বিজনেস—প্রয়োজনীয় আধুনিক দক্ষতা শিখে নিজের ক্যারিয়ারকে আরও শক্তিশালী করুন এবং ঘরে বসেই সফলতার নতুন সুযোগ তৈরি করুন।','আপনার দক্ষতাই হোক আপনার সাফল্যের চাবিকাঠি',1,'[\"2\"]',1,'course',NULL,NULL,1,1,'<p>আধুনিক দক্ষতা অর্জনের মাধ্যমে গড়ে তুলুন নিজের সফল ভবিষ্যৎ। একটি প্ল্যাটফর্মে শিখুন বর্তমান সময়ের প্রয়োজনীয় বিভিন্ন দক্ষতা এবং নিজেকে প্রস্তুত করুন পরিবর্তনশীল কর্মজগতের জন্য। কৃত্রিম বুদ্ধিমত্তার ব্যবহার শিখে কাজের গতি ও দক্ষতা বাড়ান এবং প্রযুক্তিকে নিজের উন্নতির কাজে ব্যবহার করুন। মুক্তপেশা সম্পর্কে জ্ঞান অর্জন করে অনলাইন কর্মজীবনের জন্য নিজেকে প্রস্তুত করুন। ডিজিটাল বিপণনের মাধ্যমে প্রচার, ব্যবসা পরিচালনা ও গ্রাহকদের কাছে পৌঁছানোর কার্যকর কৌশল শিখুন। বিষয়বস্তু তৈরির মাধ্যমে আকর্ষণীয় ও মানসম্মত বিষয়বস্তু তৈরি করার দক্ষতা অর্জন করুন। ইউটিউব পরিচালনার আধুনিক পদ্ধতি শিখে নিজের চ্যানেলকে আরও কার্যকরভাবে এগিয়ে নিন। শূন্য থেকে শুরু করে ধাপে ধাপে নিজের জ্ঞান ও দক্ষতা উন্নত করুন। সহজ, বাস্তবভিত্তিক ও প্রয়োজনীয় শিক্ষার মাধ্যমে নিজের আত্মবিশ্বাস বাড়ান।<br></p>',0,'youtube','\"https:\\/\\/www.youtube.com\\/watch?v=PfdQQE42Si4&list=RDPfdQQE42Si4&start_radio=1\"',1,'{\"storage\":\"local\",\"original_image\":\"images\\/20260913105208_original__media_451.png\",\"image_40x40\":\"images\\/20260913105208image_40x40_media_477.png\",\"image_80x80\":\"images\\/20260913105208image_80x80_media_276.png\",\"image_68x48\":\"images\\/20260913105208image_68x48_media_346.png\",\"image_190x230\":\"images\\/20260913105208image_190x230_media_353.png\",\"image_163x116\":\"images\\/20260913105208image_163x116_media_460.png\",\"image_295x248\":\"images\\/20260913105208image_295x248_media_430.png\",\"image_417x384\":\"images\\/20260913105208image_417x384_media_111.png\",\"image_thumbnail\":\"images\\/20260913105208image_thumbnail_media_358.png\",\"image_402x248\":\"images\\/20260913105215image_402x248-365.png\"}','{\"storage\":\"local\",\"original_image\":\"images\\/20260913133036_original__media_167.jpg\",\"image_40x40\":\"images\\/20260913133036image_40x40_media_266.jpg\",\"image_80x80\":\"images\\/20260913133036image_80x80_media_369.jpg\",\"image_68x48\":\"images\\/20260913133036image_68x48_media_239.jpg\",\"image_190x230\":\"images\\/20260913133036image_190x230_media_437.jpg\",\"image_163x116\":\"images\\/20260913133036image_163x116_media_410.jpg\",\"image_295x248\":\"images\\/20260913133036image_295x248_media_399.jpg\",\"image_417x384\":\"images\\/20260913133036image_417x384_media_374.jpg\",\"image_thumbnail\":\"images\\/20260913133036image_thumbnail_media_100.jpg\",\"image_800x600\":\"images\\/20260913133135image_800x600-79.jpg\"}',5,'{\"overview_btn_text\":\"\\u098f\\u0996\\u09a8\\u0987 \\u09b6\\u09c1\\u09b0\\u09c1 \\u0995\\u09b0\\u09c1\\u09a8\",\"overview_btn_url\":\"#register\",\"desc_right_title\":\"\",\"desc_step_1_title\":\"\",\"desc_step_1_sub\":\"\",\"desc_step_2_title\":\"\",\"desc_step_2_sub\":\"\",\"desc_step_3_title\":\"\",\"desc_step_3_sub\":\"\",\"desc_banner_icon\":\"\",\"desc_banner_title\":\"\",\"desc_banner_sub\":\"\",\"benefits_title\":\"\\u09ab\\u09cd\\u09b0\\u09bf\\u09b2\\u09cd\\u09af\\u09be\\u09a8\\u09cd\\u09b8\\u09bf\\u0982\\u09af\\u09bc\\u09c7\\u09b0 \\u09ae\\u09be\\u09a7\\u09cd\\u09af\\u09ae\\u09c7 \\u0995\\u09cd\\u09af\\u09be\\u09b0\\u09bf\\u09af\\u09bc\\u09be\\u09b0 \\u0997\\u09a1\\u09bc\\u09be\\u09b0 \\u09b8\\u09c1\\u09af\\u09cb\\u0997\",\"benefits_list\":[\"\\u09af\\u09be\\u0981\\u09b0\\u09be \\u0985\\u09a8\\u09b2\\u09be\\u0987\\u09a8 \\u09ac\\u09cd\\u09af\\u09ac\\u09b8\\u09be\\u09b0 \\u099c\\u09a8\\u09cd\\u09af \\u09b8\\u09a0\\u09bf\\u0995 \\u0995\\u09cc\\u09b6\\u09b2 \\u0993 \\u09a6\\u09bf\\u0995\\u09a8\\u09bf\\u09b0\\u09cd\\u09a6\\u09c7\\u09b6\\u09a8\\u09be \\u0996\\u09c1\\u0981\\u099c\\u099b\\u09c7\\u09a8 - \\u09ac\\u09cd\\u09af\\u09ac\\u09b8\\u09be\\u09b0 \\u099c\\u09a8\\u09cd\\u09af \\u0995\\u09be\\u09b0\\u09cd\\u09af\\u0995\\u09b0 \\u09aa\\u09b0\\u09bf\\u0995\\u09b2\\u09cd\\u09aa\\u09a8\\u09be \\u0993 \\u0995\\u09cc\\u09b6\\u09b2 \\u09a4\\u09c8\\u09b0\\u09bf \\u0995\\u09b0\\u09a4\\u09c7 \\u09aa\\u09be\\u09b0\\u09ac\\u09c7\\u09a8\\u0964\",\"\\u09af\\u09be\\u0981\\u09b0\\u09be \\u0998\\u09b0\\u09c7 \\u09ac\\u09b8\\u09c7 \\u0985\\u09a8\\u09b2\\u09be\\u0987\\u09a8\\u09c7 \\u0986\\u09af\\u09bc\\u09c7\\u09b0 \\u09b8\\u09c1\\u09af\\u09cb\\u0997 \\u09a4\\u09c8\\u09b0\\u09bf \\u0995\\u09b0\\u09a4\\u09c7 \\u099a\\u09be\\u09a8 - \\u0985\\u09a8\\u09b2\\u09be\\u0987\\u09a8 \\u09a5\\u09c7\\u0995\\u09c7 \\u0986\\u09af\\u09bc\\u09c7\\u09b0 \\u09ac\\u09bf\\u09ad\\u09bf\\u09a8\\u09cd\\u09a8 \\u09b8\\u09c1\\u09af\\u09cb\\u0997 \\u09b8\\u09ae\\u09cd\\u09aa\\u09b0\\u09cd\\u0995\\u09c7 \\u099c\\u09be\\u09a8\\u09a4\\u09c7 \\u09aa\\u09be\\u09b0\\u09ac\\u09c7\\u09a8\\u0964\",\"\\u09af\\u09be\\u0981\\u09b0\\u09be \\u09ab\\u09cd\\u09b0\\u09bf\\u09b2\\u09cd\\u09af\\u09be\\u09a8\\u09cd\\u09b8\\u09bf\\u0982 \\u09b6\\u09bf\\u0996\\u09c7 \\u09a8\\u09bf\\u099c\\u09c7\\u09b0 \\u0995\\u09cd\\u09af\\u09be\\u09b0\\u09bf\\u09af\\u09bc\\u09be\\u09b0 \\u0997\\u09a1\\u09bc\\u09a4\\u09c7 \\u099a\\u09be\\u09a8 - \\u09ab\\u09cd\\u09b0\\u09bf\\u09b2\\u09cd\\u09af\\u09be\\u09a8\\u09cd\\u09b8\\u09bf\\u0982\\u09af\\u09bc\\u09c7\\u09b0 \\u09ae\\u09be\\u09a7\\u09cd\\u09af\\u09ae\\u09c7 \\u09a6\\u0995\\u09cd\\u09b7\\u09a4\\u09be \\u0993 \\u0995\\u09cd\\u09af\\u09be\\u09b0\\u09bf\\u09af\\u09bc\\u09be\\u09b0 \\u0997\\u09a1\\u09bc\\u09a4\\u09c7 \\u09aa\\u09be\\u09b0\\u09ac\\u09c7\\u09a8\\u0964\",\"\\u09af\\u09be\\u0981\\u09b0\\u09be \\u09ab\\u09cd\\u09b0\\u09bf\\u09b2\\u09cd\\u09af\\u09be\\u09a8\\u09cd\\u09b8\\u09bf\\u0982 \\u09b6\\u09bf\\u0996\\u09c7 \\u09a8\\u09bf\\u099c\\u09c7\\u09b0 \\u0995\\u09cd\\u09af\\u09be\\u09b0\\u09bf\\u09af\\u09bc\\u09be\\u09b0 \\u0997\\u09a1\\u09bc\\u09a4\\u09c7 \\u099a\\u09be\\u09a8 - \\u09ab\\u09cd\\u09b0\\u09bf\\u09b2\\u09cd\\u09af\\u09be\\u09a8\\u09cd\\u09b8\\u09bf\\u0982\\u09af\\u09bc\\u09c7\\u09b0 \\u09ae\\u09be\\u09a7\\u09cd\\u09af\\u09ae\\u09c7 \\u09a6\\u0995\\u09cd\\u09b7\\u09a4\\u09be \\u0993 \\u0995\\u09cd\\u09af\\u09be\\u09b0\\u09bf\\u09af\\u09bc\\u09be\\u09b0 \\u0997\\u09a1\\u09bc\\u09a4\\u09c7 \\u09aa\\u09be\\u09b0\\u09ac\\u09c7\\u09a8\\u0964\",\"\\u09af\\u09be\\u0981\\u09b0\\u09be \\u0987\\u0989\\u099f\\u09bf\\u0989\\u09ac \\u09a5\\u09c7\\u0995\\u09c7 \\u0986\\u09af\\u09bc \\u0995\\u09b0\\u09a4\\u09c7 \\u099a\\u09be\\u09a8, \\u0995\\u09bf\\u09a8\\u09cd\\u09a4\\u09c1 \\u0995\\u09cb\\u09a5\\u09be \\u09a5\\u09c7\\u0995\\u09c7 \\u09b6\\u09c1\\u09b0\\u09c1 \\u0995\\u09b0\\u09ac\\u09c7\\u09a8 \\u099c\\u09be\\u09a8\\u09c7\\u09a8 \\u09a8\\u09be - \\u0987\\u0989\\u099f\\u09bf\\u0989\\u09ac \\u099a\\u09cd\\u09af\\u09be\\u09a8\\u09c7\\u09b2 \\u09b6\\u09c1\\u09b0\\u09c1 \\u0993 \\u09ae\\u09a8\\u09bf\\u099f\\u09be\\u0987\\u099c\\u09c7\\u09b6\\u09a8\\u09c7\\u09b0 \\u09a7\\u09be\\u09b0\\u09a3\\u09be \\u09aa\\u09be\\u09ac\\u09c7\\u09a8\\u0964\",\"\\u09af\\u09be\\u0981\\u09b0\\u09be \\u0986\\u0995\\u09b0\\u09cd\\u09b7\\u09a3\\u09c0\\u09af\\u09bc \\u09ac\\u09bf\\u09b7\\u09af\\u09bc\\u09ac\\u09b8\\u09cd\\u09a4\\u09c1 \\u09a4\\u09c8\\u09b0\\u09bf \\u0995\\u09b0\\u09a4\\u09c7 \\u09b6\\u09bf\\u0996\\u09a4\\u09c7 \\u099a\\u09be\\u09a8 - \\u09aa\\u09cd\\u09b0\\u09ab\\u09c7\\u09b6\\u09a8\\u09be\\u09b2 \\u0993 \\u0986\\u0995\\u09b0\\u09cd\\u09b7\\u09a3\\u09c0\\u09af\\u09bc \\u0995\\u09a8\\u099f\\u09c7\\u09a8\\u09cd\\u099f \\u09a4\\u09c8\\u09b0\\u09bf \\u0995\\u09b0\\u09a4\\u09c7 \\u09aa\\u09be\\u09b0\\u09ac\\u09c7\\u09a8\\u0964\"],\"show_special_gift\":1,\"gift_badge\":\"\\u0995\\u09cb\\u09b0\\u09cd\\u09b8\\u09c7\\u09b0 \\u09b8\\u09be\\u09a5\\u09c7 \\u09aa\\u09be\\u099a\\u09cd\\u099b\\u09c7\\u09a8 \\u09ac\\u09bf\\u09b6\\u09c7\\u09b7 \\u0989\\u09aa\\u09b9\\u09be\\u09b0 \\u0993 \\u098f\\u0995\\u09cd\\u09b8\\u0995\\u09cd\\u09b2\\u09c1\\u09b8\\u09bf\\u09ad \\u09ac\\u09cb\\u09a8\\u09be\\u09b8\",\"gift_title\":\"\\u09f3\\u09e9\\u09e6,\\u09e6\\u09e6\\u09e6+ \\u09ae\\u09c2\\u09b2\\u09cd\\u09af\\u09c7\\u09b0 \\u09b0\\u09bf\\u09b8\\u09cb\\u09b0\\u09cd\\u09b8 \\u0993 \\u09aa\\u09cd\\u09b0\\u09bf\\u09ae\\u09bf\\u09df\\u09be\\u09ae \\u09b8\\u09ab\\u099f\\u0993\\u09df\\u09cd\\u09af\\u09be\\u09b0 \\u09aa\\u09cd\\u09af\\u09be\\u0995\\u09c7\\u099c \\u098f\\u0995\\u09a6\\u09ae \\u09ab\\u09cd\\u09b0\\u09bf!\",\"gift_value\":\"\\u09f3\\u09e9,\\u09eb\\u09e6\\u09e6\\/-\",\"gift_cta_text\":\"\\u098f\\u0996\\u09a8\\u0987 \\u0989\\u09aa\\u09b9\\u09be\\u09b0 \\u09a8\\u09bf\\u09a8\",\"gift_cta_link\":\"#register\",\"gift_description\":\"<p>\\u0986\\u09aa\\u09a8\\u09be\\u09b0 \\u09b6\\u09c7\\u0996\\u09be\\u09b0 \\u09af\\u09be\\u09a4\\u09cd\\u09b0\\u09be\\u0995\\u09c7 \\u0986\\u09b0\\u0993 \\u09b8\\u09b9\\u099c, \\u0995\\u09be\\u09b0\\u09cd\\u09af\\u0995\\u09b0 \\u0993 \\u0986\\u09a8\\u09a8\\u09cd\\u09a6\\u09a6\\u09be\\u09df\\u0995 \\u0995\\u09b0\\u09a4\\u09c7 \\u0986\\u09ae\\u09b0\\u09be \\u09a6\\u09bf\\u099a\\u09cd\\u099b\\u09bf \\u09ac\\u09bf\\u09b6\\u09c7\\u09b7 \\u0995\\u09bf\\u099b\\u09c1 \\u0989\\u09aa\\u09b9\\u09be\\u09b0\\u0964 \\u0995\\u09cb\\u09b0\\u09cd\\u09b8\\u09c7 \\u09af\\u09c1\\u0995\\u09cd\\u09a4 \\u09b9\\u0993\\u09df\\u09be\\u09b0 \\u09aa\\u09be\\u09b6\\u09be\\u09aa\\u09be\\u09b6\\u09bf \\u098f\\u0987 \\u09ac\\u09bf\\u09b6\\u09c7\\u09b7 \\u0989\\u09aa\\u09b9\\u09be\\u09b0\\u0997\\u09c1\\u09b2\\u09cb \\u0995\\u09be\\u099c\\u09c7 \\u09b2\\u09be\\u0997\\u09bf\\u09df\\u09c7 \\u0986\\u09aa\\u09a8\\u09be\\u09b0 \\u09a6\\u0995\\u09cd\\u09b7\\u09a4\\u09be \\u0986\\u09b0\\u0993 \\u09a6\\u09cd\\u09b0\\u09c1\\u09a4 \\u0989\\u09a8\\u09cd\\u09a8\\u09a4 \\u0995\\u09b0\\u09c1\\u09a8 \\u098f\\u09ac\\u0982 \\u09ac\\u09be\\u09b8\\u09cd\\u09a4\\u09ac \\u099c\\u09c0\\u09ac\\u09a8\\u09c7 \\u09b6\\u09c7\\u0996\\u09be \\u09ac\\u09bf\\u09b7\\u09df\\u0997\\u09c1\\u09b2\\u09cb \\u09aa\\u09cd\\u09b0\\u09df\\u09cb\\u0997 \\u0995\\u09b0\\u09be\\u09b0 \\u09b8\\u09c1\\u09af\\u09cb\\u0997 \\u09a4\\u09c8\\u09b0\\u09bf \\u0995\\u09b0\\u09c1\\u09a8\\u0964 \\u0986\\u09aa\\u09a8\\u09be\\u09b0 \\u09b6\\u09c7\\u0996\\u09be\\u09b0 \\u0985\\u09ad\\u09bf\\u099c\\u09cd\\u099e\\u09a4\\u09be\\u0995\\u09c7 \\u0986\\u09b0\\u0993 \\u09b8\\u09ae\\u09c3\\u09a6\\u09cd\\u09a7 \\u0995\\u09b0\\u09a4\\u09c7 \\u09aa\\u09cd\\u09b0\\u09a4\\u09bf\\u099f\\u09bf \\u0989\\u09aa\\u09b9\\u09be\\u09b0 \\u098f\\u09ae\\u09a8\\u09ad\\u09be\\u09ac\\u09c7 \\u09b8\\u09be\\u099c\\u09be\\u09a8\\u09cb \\u09b9\\u09df\\u09c7\\u099b\\u09c7, \\u09af\\u09be\\u09a4\\u09c7 \\u0986\\u09aa\\u09a8\\u09bf \\u09a8\\u09bf\\u099c\\u09c7\\u09b0 \\u099c\\u09cd\\u099e\\u09be\\u09a8 \\u0993 \\u09a6\\u0995\\u09cd\\u09b7\\u09a4\\u09be\\u0995\\u09c7 \\u09a7\\u09be\\u09aa\\u09c7 \\u09a7\\u09be\\u09aa\\u09c7 \\u0986\\u09b0\\u0993 \\u09b6\\u0995\\u09cd\\u09a4\\u09bf\\u09b6\\u09be\\u09b2\\u09c0 \\u0995\\u09b0\\u09a4\\u09c7 \\u09aa\\u09be\\u09b0\\u09c7\\u09a8\\u0964&nbsp;<\\/p>\",\"breakdown_today_title\":\"\\u098f\\u0987 \\u0995\\u09cb\\u09b0\\u09cd\\u09b8 \\u098f \\u09af\\u09be \\u09af\\u09be \\u09aa\\u09be\\u09ac\\u09c7\\u09a8 \\u09a4\\u09be\\u09b0 \\u09ae\\u09c2\\u09b2\\u09cd\\u09af \\u09ac\\u09bf\\u09ad\\u09be\\u099c\\u09a8 \\u0995\\u09b0\\u099b\\u09bf\",\"breakdown_subheading\":\"\\u0986\\u099c\\u0987 \\u09b8\\u09cd\\u09aa\\u09c7\\u09b6\\u09be\\u09b2 \\u09a1\\u09bf\\u09b8\\u09cd\\u0995\\u09be\\u0989\\u09a8\\u09cd\\u099f \\u098f \\u098f\\u0996\\u09a8\\u0987 \\u0995\\u09cb\\u09b0\\u09cd\\u09b8 \\u099f\\u09bf \\u0995\\u09bf\\u09a8\\u09c1\\u09a8 \\u09ae\\u09be\\u09a4\\u09cd\\u09b0\\u0983 \\u09f3\\u09e8,\\u09ef\\u09ef\\u09e6\\/-\",\"breakdown_original_price\":\"\\u09f3\\u09e7\\u09ea,\\u09ef\\u09ef\\u09e6\\/-\",\"breakdown_items\":\"\\u0995\\u09cb\\u09b0\\u09cd\\u09b8 \\u09e6\\u09e7: \\u0995\\u09c1\\u0987\\u0995 \\u0986\\u09b0\\u09a8\\u09bf\\u0982 \\u09b8\\u09bf\\u09b8\\u09cd\\u099f\\u09c7\\u09ae - Daily Income | \\u09f3\\u09e9,\\u09e6\\u09e6\\u09e6\\r\\n\\r\\n\\u0995\\u09cb\\u09b0\\u09cd\\u09b8 \\u09e6\\u09e8: \\u0987\\u0989\\u099f\\u09bf\\u0989\\u09ac \\u0985\\u099f\\u09cb\\u09ae\\u09c7\\u09b6\\u09a8 \\u0995\\u09cb\\u09b0\\u09cd\\u09b8 - USA Channel | \\u09f3\\u09ea,\\u09e6\\u09e6\\u09e6\\r\\n\\r\\n\\u0995\\u09cb\\u09b0\\u09cd\\u09b8 \\u09e6\\u09e9: AI - Passive Income | \\u09f3\\u09e9,\\u09e6\\u09e6\\u09e6\\r\\n\\r\\nLive Support Class with Mentor | \\u09f3\\u09e8,\\u09e6\\u09e6\\u09e6\\r\\n\\r\\nLife Time Course Access | \\u09f3\\u09e8,\\u09e6\\u09e6\\u09e6\\r\\n\\r\\n30k Bonus Resources & Materials | FREE\\r\\n\\r\\nCertificate of Participation | \\u09f3990\\r\\n\\r\\nFuture Updates (if applicable) | FREE\",\"breakdown_cta_text\":\"\\u0985\\u09ab\\u09be\\u09b0 \\u099f\\u09bf \\u09a8\\u09bf\\u09a4\\u09c7 \\u099a\\u09be\\u0987\",\"breakdown_cta_link\":\"#register\",\"ad_banner_1_link\":\"\",\"ad_banner_1_image_url_custom\":\"http:\\/\\/127.0.0.1:8000\\/images\\/20260913134957_original__media_298.webp\",\"ad_banner_2_link\":\"\",\"ad_banner_2_image_url_custom\":\"http:\\/\\/127.0.0.1:8000\\/images\\/20260913134957_original__media_41.webp\",\"support_title\":\"\\u09b6\\u09bf\\u0995\\u09cd\\u09b7\\u09be\\u09b0\\u09cd\\u09a5\\u09c0\\u09a6\\u09c7\\u09b0 \\u099c\\u09a8\\u09cd\\u09af \\u0986\\u09ae\\u09be\\u09a6\\u09c7\\u09b0 \\u09b8\\u09b9\\u09be\\u09af\\u09bc\\u09a4\\u09be\",\"support_title_icon\":\"fas fa-headset\",\"support_subtitle\":\"\\u0995\\u09cb\\u09b0\\u09cd\\u09b8 \\u09b6\\u09c7\\u09b7 \\u09b9\\u09b2\\u09c7\\u0993 \\u0986\\u09aa\\u09a8\\u09be\\u09b0 \\u09b6\\u09c7\\u0996\\u09be\\u09b0 \\u09aa\\u09a5 \\u09b6\\u09c7\\u09b7 \\u09b9\\u09ac\\u09c7 \\u09a8\\u09be\\u0964\",\"support_description\":\"<p>\\u0986\\u09aa\\u09a8\\u09be\\u09b0 \\u09af\\u09c7\\u0995\\u09cb\\u09a8\\u09cb \\u09aa\\u09cd\\u09b0\\u09b6\\u09cd\\u09a8, \\u09b8\\u09ae\\u09b8\\u09cd\\u09af\\u09be \\u09ac\\u09be \\u09aa\\u09cd\\u09b0\\u09df\\u09cb\\u099c\\u09a8\\u09c0\\u09df \\u09b8\\u09b9\\u09be\\u09df\\u09a4\\u09be\\u09b0 \\u099c\\u09a8\\u09cd\\u09af \\u0986\\u09ae\\u09be\\u09a6\\u09c7\\u09b0 \\u09b8\\u09be\\u09aa\\u09cb\\u09b0\\u09cd\\u099f \\u099f\\u09bf\\u09ae \\u09b8\\u09ac\\u09b8\\u09ae\\u09df \\u09aa\\u09cd\\u09b0\\u09b8\\u09cd\\u09a4\\u09c1\\u09a4\\u0964 \\u0986\\u09ae\\u09be\\u09a6\\u09c7\\u09b0 \\u09b2\\u0995\\u09cd\\u09b7\\u09cd\\u09af \\u09b9\\u09b2\\u09cb \\u0986\\u09aa\\u09a8\\u09be\\u09b0 \\u09b8\\u09ae\\u09b8\\u09cd\\u09af\\u09be\\u0997\\u09c1\\u09b2\\u09cb \\u09a6\\u09cd\\u09b0\\u09c1\\u09a4 \\u09ac\\u09c1\\u099d\\u09c7 \\u09b8\\u09b9\\u099c, \\u0995\\u09be\\u09b0\\u09cd\\u09af\\u0995\\u09b0 \\u098f\\u09ac\\u0982 \\u09a8\\u09bf\\u09b0\\u09cd\\u09ad\\u09b0\\u09af\\u09cb\\u0997\\u09cd\\u09af \\u09b8\\u09ae\\u09be\\u09a7\\u09be\\u09a8 \\u09aa\\u09cd\\u09b0\\u09a6\\u09be\\u09a8 \\u0995\\u09b0\\u09be\\u0964<\\/p><p>\\u09aa\\u09cd\\u09b2\\u09cd\\u09af\\u09be\\u099f\\u09ab\\u09b0\\u09cd\\u09ae \\u09ac\\u09cd\\u09af\\u09ac\\u09b9\\u09be\\u09b0, \\u0995\\u09cb\\u09b0\\u09cd\\u09b8, \\u0985\\u09cd\\u09af\\u09be\\u0995\\u09be\\u0989\\u09a8\\u09cd\\u099f \\u09ac\\u09be \\u0985\\u09a8\\u09cd\\u09af\\u09be\\u09a8\\u09cd\\u09af \\u09af\\u09c7\\u0995\\u09cb\\u09a8\\u09cb \\u09ac\\u09bf\\u09b7\\u09df\\u09c7 \\u09aa\\u09cd\\u09b0\\u09df\\u09cb\\u099c\\u09a8\\u09c0\\u09df \\u09a6\\u09bf\\u0995\\u09a8\\u09bf\\u09b0\\u09cd\\u09a6\\u09c7\\u09b6\\u09a8\\u09be \\u09aa\\u09c7\\u09a4\\u09c7 \\u0986\\u09ae\\u09be\\u09a6\\u09c7\\u09b0 \\u09b8\\u09be\\u09a5\\u09c7 \\u09af\\u09cb\\u0997\\u09be\\u09af\\u09cb\\u0997 \\u0995\\u09b0\\u09c1\\u09a8\\u0964 \\u0986\\u09ae\\u09be\\u09a6\\u09c7\\u09b0 \\u0985\\u09ad\\u09bf\\u099c\\u09cd\\u099e \\u099f\\u09bf\\u09ae \\u0986\\u09aa\\u09a8\\u09be\\u09b0 \\u09aa\\u09cd\\u09b0\\u09a4\\u09bf\\u099f\\u09bf \\u09aa\\u09cd\\u09b0\\u09b6\\u09cd\\u09a8\\u09c7\\u09b0 \\u0989\\u09a4\\u09cd\\u09a4\\u09b0 \\u09a6\\u09bf\\u09a4\\u09c7 \\u098f\\u09ac\\u0982 \\u09aa\\u09cd\\u09b0\\u09df\\u09cb\\u099c\\u09a8 \\u0985\\u09a8\\u09c1\\u09af\\u09be\\u09df\\u09c0 \\u09b8\\u09a0\\u09bf\\u0995 \\u09b8\\u09b9\\u09be\\u09df\\u09a4\\u09be \\u09a6\\u09bf\\u09a4\\u09c7 \\u0986\\u09a8\\u09cd\\u09a4\\u09b0\\u09bf\\u0995\\u09ad\\u09be\\u09ac\\u09c7 \\u0995\\u09be\\u099c \\u0995\\u09b0\\u09c7\\u0964<\\/p>\",\"support_image_url_custom\":\"http:\\/\\/127.0.0.1:8000\\/images\\/20260913140946_original__media_410.jpg\",\"support_features_list\":[{\"title\":\"\\u09a1\\u09be\\u0987\\u09b0\\u09c7\\u0995\\u09cd\\u099f \\u09b8\\u09be\\u09aa\\u09cb\\u09b0\\u09cd\\u099f\",\"icon\":\"fas fa-comment-dots\",\"desc\":\"\\u09a4 \\u0993 \\u09a8\\u09bf\\u09b0\\u09cd\\u09ad\\u09b0\\u09af\\u09cb\\u0997\\u09cd\\u09af \\u09b8\\u09b9\\u09be\\u09af\\u09bc\\u09a4\\u09be \\u09aa\\u09c7\\u09a4\\u09c7 \\u0986\\u09ae\\u09be\\u09a6\\u09c7\\u09b0 \\u09b8\\u09be\\u09aa\\u09cb\\u09b0\\u09cd\\u099f \\u099f\\u09bf\\u09ae\\u09c7\\u09b0 \\u09b8\\u09be\\u09a5\\u09c7 \\u09af\\u09cb\\u0997\\u09be\\u09af\\u09cb\\u0997 \\u0995\\u09b0\\u09c1\\u09a8\\u0964\"},{\"title\":\"1-to-1 \\u09b2\\u09be\\u0987\\u09ad \\u09b9\\u09c7\\u09b2\\u09cd\\u09aa\",\"icon\":\"fas fa-video\",\"desc\":\"\\u0986\\u09aa\\u09a8\\u09be\\u09b0 \\u09b8\\u09ae\\u09b8\\u09cd\\u09af\\u09be\\u09b0 \\u09b8\\u09b9\\u099c \\u09b8\\u09ae\\u09be\\u09a7\\u09be\\u09a8 \\u0993 \\u09aa\\u09cd\\u09b0\\u09df\\u09cb\\u099c\\u09a8\\u09c0\\u09df \\u09a6\\u09bf\\u0995\\u09a8\\u09bf\\u09b0\\u09cd\\u09a6\\u09c7\\u09b6\\u09a8\\u09be \\u098f\\u0995 \\u099c\\u09be\\u09df\\u0997\\u09be\\u09df \\u09aa\\u09be\\u09a8\\u0964\"},{\"title\":\"\\u09b2\\u09be\\u0987\\u09ab\\u099f\\u09be\\u0987\\u09ae \\u098f\\u0995\\u09cd\\u09b8\\u09c7\\u09b8\",\"icon\":\"fas fa-infinity\",\"desc\":\"\\u09af\\u09c7\\u0995\\u09cb\\u09a8\\u09cb \\u09aa\\u09cd\\u09b0\\u09b6\\u09cd\\u09a8\\u09c7\\u09b0 \\u0989\\u09a4\\u09cd\\u09a4\\u09b0 \\u0993 \\u09aa\\u09cd\\u09b0\\u09df\\u09cb\\u099c\\u09a8\\u09c0\\u09df \\u09b8\\u09b9\\u09be\\u09df\\u09a4\\u09be \\u09aa\\u09c7\\u09a4\\u09c7 \\u0986\\u09ae\\u09b0\\u09be \\u09b8\\u09ac\\u09b8\\u09ae\\u09df \\u09aa\\u09be\\u09b6\\u09c7 \\u0986\\u099b\\u09bf\\u0964\"}],\"support_divider_text\":\"\\u09b8\\u09be\\u09aa\\u09cb\\u09b0\\u09cd\\u099f \\u09a8\\u09bf\\u09a4\\u09c7 \\u09af\\u09cb\\u0997\\u09be\\u09af\\u09cb\\u0997 \\u0995\\u09b0\\u09c1\\u09a8\",\"support_channels_list\":[{\"is_highlighted\":\"1\",\"title\":\"\\u09ab\\u09c7\\u09b8\\u09ac\\u09c1\\u0995 \\u09b8\\u09be\\u09aa\\u09cb\\u09b0\\u09cd\\u099f\",\"desc\":\"\\u0986\\u09ae\\u09be\\u09a6\\u09c7\\u09b0 \\u09ab\\u09c7\\u09b8\\u09ac\\u09c1\\u0995 \\u09aa\\u09c7\\u099c\\u09c7 \\u09ae\\u09c7\\u09b8\\u09c7\\u099c \\u0995\\u09b0\\u09c1\\u09a8\",\"icon\":\"http:\\/\\/127.0.0.1:8000\\/images\\/20260913142044_original_course354.png\",\"team_avatar\":\"images\\/support\\/support_avatars.png\",\"team_label\":\"\\u09b8\\u0995\\u09cd\\u09b0\\u09bf\\u09af\\u09bc \\u09b8\\u09be\\u09aa\\u09cb\\u09b0\\u09cd\\u099f \\u099f\\u09bf\\u09ae\",\"btn_text\":\"\\u09ae\\u09c7\\u09b8\\u09c7\\u099c \\u0995\\u09b0\\u09c1\\u09a8\",\"url\":\"https:\\/\\/www.facebook.com\"},{\"is_highlighted\":\"1\",\"title\":\"\\u09b9\\u09cb\\u09af\\u09bc\\u09be\\u099f\\u09b8\\u0985\\u09cd\\u09af\\u09be\\u09aa \\u09b8\\u09be\\u09aa\\u09cb\\u09b0\\u09cd\\u099f\",\"desc\":\"\\u09a6\\u09cd\\u09b0\\u09c1\\u09a4 \\u0989\\u09a4\\u09cd\\u09a4\\u09b0 \\u09aa\\u09c7\\u09a4\\u09c7 \\u0986\\u09ae\\u09be\\u09a6\\u09c7\\u09b0 \\u09b9\\u09cb\\u09af\\u09bc\\u09be\\u099f\\u09b8\\u0985\\u09cd\\u09af\\u09be\\u09aa\\u09c7 \\u09a8\\u0995 \\u09a6\\u09bf\\u09a8\",\"icon\":\"\",\"team_avatar\":\"\",\"team_label\":\"\",\"btn_text\":\"\",\"url\":\"\"},{\"is_highlighted\":\"1\",\"title\":\"\\u099f\\u09c7\\u09b2\\u09bf\\u0997\\u09cd\\u09b0\\u09be\\u09ae \\u09b8\\u09be\\u09aa\\u09cb\\u09b0\\u09cd\\u099f\",\"desc\":\"\\u09b8\\u09be\\u09aa\\u09cb\\u09b0\\u09cd\\u099f \\u0995\\u09ae\\u09bf\\u0989\\u09a8\\u09bf\\u099f\\u09bf\\u09a4\\u09c7 \\u09af\\u09c1\\u0995\\u09cd\\u09a4 \\u09b9\\u09df\\u09c7 \\u09b8\\u09ac\\u09be\\u09b0 \\u09b8\\u09be\\u09a5\\u09c7 \\u09a5\\u09be\\u0995\\u09c1\\u09a8\",\"icon\":\"\",\"team_avatar\":\"\",\"team_label\":\"\",\"btn_text\":\"\",\"url\":\"\"}],\"support_strip_icon\":\"fas fa-heart\",\"support_strip_text_1\":\"\\u0986\\u09aa\\u09a8\\u09bf \\u098f\\u0995\\u09be \\u09a8\\u09a8, \\u0986\\u09ae\\u09b0\\u09be \\u0986\\u099b\\u09bf \\u0986\\u09aa\\u09a8\\u09be\\u09b0 \\u09b8\\u09be\\u09a5\\u09c7 \\u09b8\\u09ac\\u09b8\\u09ae\\u09df\\u0964\",\"support_strip_text_2\":\"\\u0986\\u09aa\\u09a8\\u09be\\u09b0 \\u09b8\\u09ab\\u09b2\\u09a4\\u09be\\u0987 \\u0986\\u09ae\\u09be\\u09a6\\u09c7\\u09b0 \\u09b2\\u0995\\u09cd\\u09b7\\u09cd\\u09af\\u0964\",\"show_curriculum_section\":\"1\",\"curriculum_title\":\"\",\"faq_title\":\"\\u09b8\\u099a\\u09b0\\u09be\\u099a\\u09b0 \\u099c\\u09bf\\u099c\\u09cd\\u099e\\u09be\\u09b8\\u09bf\\u09a4 \\u09aa\\u09cd\\u09b0\\u09b6\\u09cd\\u09a8\",\"faq_subtitle\":\"\\u0986\\u09aa\\u09a8\\u09be\\u09b0 \\u09b8\\u09be\\u09a7\\u09be\\u09b0\\u09a3 \\u09aa\\u09cd\\u09b0\\u09b6\\u09cd\\u09a8\\u0997\\u09c1\\u09b2\\u09cb\\u09b0 \\u0989\\u09a4\\u09cd\\u09a4\\u09b0\",\"hide_explainer\":0,\"hide_breakdown\":0,\"hide_reviews\":0,\"hide_related_courses\":0,\"hide_overview_section\":0,\"ad_banner_1_status\":1,\"ad_banner_2_status\":1,\"support_status\":1,\"breakdown_status\":1,\"support_image_url\":\"http:\\/\\/127.0.0.1:8000\\/images\\/20260913140946_original__media_410.jpg\",\"support_feature_1_title\":\"\\u09a1\\u09be\\u0987\\u09b0\\u09c7\\u0995\\u09cd\\u099f \\u09b8\\u09be\\u09aa\\u09cb\\u09b0\\u09cd\\u099f\",\"support_feature_1_icon\":\"fas fa-comment-dots\",\"support_feature_1_desc\":\"\\u09a4 \\u0993 \\u09a8\\u09bf\\u09b0\\u09cd\\u09ad\\u09b0\\u09af\\u09cb\\u0997\\u09cd\\u09af \\u09b8\\u09b9\\u09be\\u09af\\u09bc\\u09a4\\u09be \\u09aa\\u09c7\\u09a4\\u09c7 \\u0986\\u09ae\\u09be\\u09a6\\u09c7\\u09b0 \\u09b8\\u09be\\u09aa\\u09cb\\u09b0\\u09cd\\u099f \\u099f\\u09bf\\u09ae\\u09c7\\u09b0 \\u09b8\\u09be\\u09a5\\u09c7 \\u09af\\u09cb\\u0997\\u09be\\u09af\\u09cb\\u0997 \\u0995\\u09b0\\u09c1\\u09a8\\u0964\",\"support_feature_2_title\":\"1-to-1 \\u09b2\\u09be\\u0987\\u09ad \\u09b9\\u09c7\\u09b2\\u09cd\\u09aa\",\"support_feature_2_icon\":\"fas fa-video\",\"support_feature_2_desc\":\"\\u0986\\u09aa\\u09a8\\u09be\\u09b0 \\u09b8\\u09ae\\u09b8\\u09cd\\u09af\\u09be\\u09b0 \\u09b8\\u09b9\\u099c \\u09b8\\u09ae\\u09be\\u09a7\\u09be\\u09a8 \\u0993 \\u09aa\\u09cd\\u09b0\\u09df\\u09cb\\u099c\\u09a8\\u09c0\\u09df \\u09a6\\u09bf\\u0995\\u09a8\\u09bf\\u09b0\\u09cd\\u09a6\\u09c7\\u09b6\\u09a8\\u09be \\u098f\\u0995 \\u099c\\u09be\\u09df\\u0997\\u09be\\u09df \\u09aa\\u09be\\u09a8\\u0964\",\"support_feature_3_title\":\"\\u09b2\\u09be\\u0987\\u09ab\\u099f\\u09be\\u0987\\u09ae \\u098f\\u0995\\u09cd\\u09b8\\u09c7\\u09b8\",\"support_feature_3_icon\":\"fas fa-infinity\",\"support_feature_3_desc\":\"\\u09af\\u09c7\\u0995\\u09cb\\u09a8\\u09cb \\u09aa\\u09cd\\u09b0\\u09b6\\u09cd\\u09a8\\u09c7\\u09b0 \\u0989\\u09a4\\u09cd\\u09a4\\u09b0 \\u0993 \\u09aa\\u09cd\\u09b0\\u09df\\u09cb\\u099c\\u09a8\\u09c0\\u09df \\u09b8\\u09b9\\u09be\\u09df\\u09a4\\u09be \\u09aa\\u09c7\\u09a4\\u09c7 \\u0986\\u09ae\\u09b0\\u09be \\u09b8\\u09ac\\u09b8\\u09ae\\u09df \\u09aa\\u09be\\u09b6\\u09c7 \\u0986\\u099b\\u09bf\\u0964\",\"support_channel_1_title\":\"\\u09ab\\u09c7\\u09b8\\u09ac\\u09c1\\u0995 \\u09b8\\u09be\\u09aa\\u09cb\\u09b0\\u09cd\\u099f\",\"support_channel_1_desc\":\"\\u0986\\u09ae\\u09be\\u09a6\\u09c7\\u09b0 \\u09ab\\u09c7\\u09b8\\u09ac\\u09c1\\u0995 \\u09aa\\u09c7\\u099c\\u09c7 \\u09ae\\u09c7\\u09b8\\u09c7\\u099c \\u0995\\u09b0\\u09c1\\u09a8\",\"support_channel_1_icon\":\"http:\\/\\/127.0.0.1:8000\\/images\\/20260913142044_original_course354.png\",\"support_channel_1_team_avatar\":\"images\\/support\\/support_avatars.png\",\"support_channel_1_team_label\":\"\\u09b8\\u0995\\u09cd\\u09b0\\u09bf\\u09af\\u09bc \\u09b8\\u09be\\u09aa\\u09cb\\u09b0\\u09cd\\u099f \\u099f\\u09bf\\u09ae\",\"support_channel_1_btn_text\":\"\\u09ae\\u09c7\\u09b8\\u09c7\\u099c \\u0995\\u09b0\\u09c1\\u09a8\",\"support_channel_1_url\":\"https:\\/\\/www.facebook.com\",\"support_channel_2_title\":\"\\u09b9\\u09cb\\u09af\\u09bc\\u09be\\u099f\\u09b8\\u0985\\u09cd\\u09af\\u09be\\u09aa \\u09b8\\u09be\\u09aa\\u09cb\\u09b0\\u09cd\\u099f\",\"support_channel_2_desc\":\"\\u09a6\\u09cd\\u09b0\\u09c1\\u09a4 \\u0989\\u09a4\\u09cd\\u09a4\\u09b0 \\u09aa\\u09c7\\u09a4\\u09c7 \\u0986\\u09ae\\u09be\\u09a6\\u09c7\\u09b0 \\u09b9\\u09cb\\u09af\\u09bc\\u09be\\u099f\\u09b8\\u0985\\u09cd\\u09af\\u09be\\u09aa\\u09c7 \\u09a8\\u0995 \\u09a6\\u09bf\\u09a8\",\"support_channel_2_icon\":\"\",\"support_channel_2_team_avatar\":\"\",\"support_channel_2_team_label\":\"\",\"support_channel_2_btn_text\":\"\",\"support_channel_2_url\":\"\",\"support_channel_3_title\":\"\\u099f\\u09c7\\u09b2\\u09bf\\u0997\\u09cd\\u09b0\\u09be\\u09ae \\u09b8\\u09be\\u09aa\\u09cb\\u09b0\\u09cd\\u099f\",\"support_channel_3_desc\":\"\\u09b8\\u09be\\u09aa\\u09cb\\u09b0\\u09cd\\u099f \\u0995\\u09ae\\u09bf\\u0989\\u09a8\\u09bf\\u099f\\u09bf\\u09a4\\u09c7 \\u09af\\u09c1\\u0995\\u09cd\\u09a4 \\u09b9\\u09df\\u09c7 \\u09b8\\u09ac\\u09be\\u09b0 \\u09b8\\u09be\\u09a5\\u09c7 \\u09a5\\u09be\\u0995\\u09c1\\u09a8\",\"support_channel_3_icon\":\"\",\"support_channel_3_team_avatar\":\"\",\"support_channel_3_team_label\":\"\",\"support_channel_3_btn_text\":\"\",\"support_channel_3_url\":\"\",\"show_benefits_section\":\"1\",\"gift_quotes_list\":[{\"text\":\"<div class=\\\"quote-text me-3\\\" style=\\\"color: rgb(74, 85, 104); font-family: poppins, sans-serif; font-size: 14px; font-style: italic;\\\"><strong data-start=\\\"34\\\" data-end=\\\"47\\\">Canva Pro<\\/strong> \\u2014 \\u0986\\u09aa\\u09a8\\u09be\\u09b0 \\u09aa\\u09cd\\u09b0\\u09a4\\u09bf\\u09a6\\u09bf\\u09a8\\u09c7\\u09b0 \\u09a1\\u09bf\\u099c\\u09be\\u0987\\u09a8, \\u09b8\\u09cb\\u09b6\\u09cd\\u09af\\u09be\\u09b2 \\u09ae\\u09bf\\u09a1\\u09bf\\u09df\\u09be \\u09aa\\u09cb\\u09b8\\u09cd\\u099f \\u0993 \\u09aa\\u09cd\\u09b0\\u09c7\\u099c\\u09c7\\u09a8\\u09cd\\u099f\\u09c7\\u09b6\\u09a8 \\u09a4\\u09c8\\u09b0\\u09bf\\u09b0 \\u099c\\u09a8\\u09cd\\u09af \\u09b8\\u09b9\\u099c \\u0993 \\u09b6\\u0995\\u09cd\\u09a4\\u09bf\\u09b6\\u09be\\u09b2\\u09c0 \\u09a1\\u09bf\\u099c\\u09be\\u0987\\u09a8 \\u099f\\u09c1\\u09b2\\u0964<\\/div>\",\"price\":\"\\u09e8\\u09ef\\u09ef\\/-\"},{\"text\":\"<p><strong data-start=\\\"176\\\" data-end=\\\"193\\\">Canva Premium<\\/strong> \\u2014 \\u09aa\\u09cd\\u09b0\\u09ab\\u09c7\\u09b6\\u09a8\\u09be\\u09b2 \\u099f\\u09c7\\u09ae\\u09aa\\u09cd\\u09b2\\u09c7\\u099f, \\u0997\\u09cd\\u09b0\\u09be\\u09ab\\u09bf\\u0995\\u09cd\\u09b8 \\u0993 \\u0995\\u09cd\\u09b0\\u09bf\\u09df\\u09c7\\u099f\\u09bf\\u09ad \\u09b0\\u09bf\\u09b8\\u09cb\\u09b0\\u09cd\\u09b8 \\u09ac\\u09cd\\u09af\\u09ac\\u09b9\\u09be\\u09b0 \\u0995\\u09b0\\u09c7 \\u09a6\\u09cd\\u09b0\\u09c1\\u09a4 \\u0986\\u0995\\u09b0\\u09cd\\u09b7\\u09a3\\u09c0\\u09df \\u09a1\\u09bf\\u099c\\u09be\\u0987\\u09a8 \\u09a4\\u09c8\\u09b0\\u09bf \\u0995\\u09b0\\u09c1\\u09a8\\u0964<\\/p>\",\"price\":\"\\u09e9\\u09ef\\u09ef\\/-\"},{\"text\":\"<p><strong data-start=\\\"317\\\" data-end=\\\"337\\\">Canva Design Pro<\\/strong> \\u2014 \\u09ac\\u09cd\\u09af\\u09ac\\u09b8\\u09be \\u0993 \\u09ac\\u09cd\\u09af\\u0995\\u09cd\\u09a4\\u09bf\\u0997\\u09a4 \\u09ac\\u09cd\\u09b0\\u09cd\\u09af\\u09be\\u09a8\\u09cd\\u09a1\\u09bf\\u0982\\u09df\\u09c7\\u09b0 \\u099c\\u09a8\\u09cd\\u09af \\u09aa\\u09cd\\u09b0\\u09df\\u09cb\\u099c\\u09a8\\u09c0\\u09df \\u09a1\\u09bf\\u099c\\u09be\\u0987\\u09a8\\u0997\\u09c1\\u09b2\\u09cb \\u09b8\\u09b9\\u099c\\u09c7\\u0987 \\u09a4\\u09c8\\u09b0\\u09bf \\u0995\\u09b0\\u09be\\u09b0 \\u09b8\\u09cd\\u09ae\\u09be\\u09b0\\u09cd\\u099f \\u09aa\\u09cd\\u09b2\\u09cd\\u09af\\u09be\\u099f\\u09ab\\u09b0\\u09cd\\u09ae\\u0964<\\/p>\",\"price\":\"\\u09ea\\u09ef\\u09ef\\/-\"},{\"text\":\"<p><strong data-start=\\\"463\\\" data-end=\\\"485\\\">Canva Creator Pack<\\/strong> \\u2014 \\u09aa\\u09cb\\u09b8\\u09cd\\u099f\\u09be\\u09b0, \\u09ac\\u09cd\\u09af\\u09be\\u09a8\\u09be\\u09b0, \\u09a5\\u09be\\u09ae\\u09cd\\u09ac\\u09a8\\u09c7\\u0987\\u09b2 \\u0993 \\u09ae\\u09be\\u09b0\\u09cd\\u0995\\u09c7\\u099f\\u09bf\\u0982 \\u0995\\u09a8\\u099f\\u09c7\\u09a8\\u09cd\\u099f \\u09a4\\u09c8\\u09b0\\u09bf\\u09a4\\u09c7 \\u09a6\\u09be\\u09b0\\u09c1\\u09a3 \\u098f\\u0995\\u099f\\u09bf \\u09a1\\u09bf\\u099c\\u09be\\u0987\\u09a8 \\u09b8\\u09ae\\u09be\\u09a7\\u09be\\u09a8\\u0964<\\/p>\",\"price\":\"\\u09eb\\u09ef\\u09ef\\/-\"},{\"text\":\"<p><strong data-start=\\\"595\\\" data-end=\\\"617\\\">Canva Business Pro<\\/strong> \\u2014 \\u0986\\u09aa\\u09a8\\u09be\\u09b0 \\u09ac\\u09cd\\u09af\\u09ac\\u09b8\\u09be\\u09b0 \\u099c\\u09a8\\u09cd\\u09af \\u09ac\\u09cd\\u09b0\\u09cd\\u09af\\u09be\\u09a8\\u09cd\\u09a1\\u09c7\\u09a1 \\u09a1\\u09bf\\u099c\\u09be\\u0987\\u09a8, \\u09aa\\u09cd\\u09b0\\u099a\\u09be\\u09b0\\u09a3\\u09be\\u09ae\\u09c2\\u09b2\\u0995 \\u0995\\u09a8\\u099f\\u09c7\\u09a8\\u09cd\\u099f \\u0993 \\u09ad\\u09bf\\u099c\\u09cd\\u09af\\u09c1\\u09df\\u09be\\u09b2 \\u09a4\\u09c8\\u09b0\\u09bf \\u0995\\u09b0\\u09c1\\u09a8 \\u0986\\u09b0\\u0993 \\u09b8\\u09b9\\u099c\\u09c7\\u0964<\\/p>\",\"price\":\"\\u09ec\\u09ef\\u09ef\\/-\"},{\"text\":\"<p><strong data-start=\\\"595\\\" data-end=\\\"617\\\">Canva Business Pro<\\/strong> \\u2014 \\u0986\\u09aa\\u09a8\\u09be\\u09b0 \\u09ac\\u09cd\\u09af\\u09ac\\u09b8\\u09be\\u09b0 \\u099c\\u09a8\\u09cd\\u09af \\u09ac\\u09cd\\u09b0\\u09cd\\u09af\\u09be\\u09a8\\u09cd\\u09a1\\u09c7\\u09a1 \\u09a1\\u09bf\\u099c\\u09be\\u0987\\u09a8, \\u09aa\\u09cd\\u09b0\\u099a\\u09be\\u09b0\\u09a3\\u09be\\u09ae\\u09c2\\u09b2\\u0995 \\u0995\\u09a8\\u099f\\u09c7\\u09a8\\u09cd\\u099f \\u0993 \\u09ad\\u09bf\\u099c\\u09cd\\u09af\\u09c1\\u09df\\u09be\\u09b2 \\u09a4\\u09c8\\u09b0\\u09bf \\u0995\\u09b0\\u09c1\\u09a8 \\u0986\\u09b0\\u0993 \\u09b8\\u09b9\\u099c\\u09c7\\u0964<\\/p>\",\"price\":\"\\u09ed\\u09ef\\u09ef\\/-\"},{\"text\":\"<p><strong data-start=\\\"1045\\\" data-end=\\\"1068\\\">Canva Ultimate Pack<\\/strong> \\u2014 \\u0995\\u09cd\\u09b0\\u09bf\\u09df\\u09c7\\u099f\\u09bf\\u09ad \\u0995\\u09be\\u099c\\u0995\\u09c7 \\u0986\\u09b0\\u0993 \\u09a6\\u09cd\\u09b0\\u09c1\\u09a4 \\u0993 \\u09aa\\u09cd\\u09b0\\u09ab\\u09c7\\u09b6\\u09a8\\u09be\\u09b2 \\u0995\\u09b0\\u09a4\\u09c7 \\u09a1\\u09bf\\u099c\\u09be\\u0987\\u09a8, \\u09ac\\u09cd\\u09b0\\u09cd\\u09af\\u09be\\u09a8\\u09cd\\u09a1\\u09bf\\u0982 \\u0993 \\u0995\\u09a8\\u099f\\u09c7\\u09a8\\u09cd\\u099f \\u09a4\\u09c8\\u09b0\\u09bf\\u09b0 \\u09b8\\u09ae\\u09cd\\u09aa\\u09c2\\u09b0\\u09cd\\u09a3 \\u09b8\\u09ae\\u09be\\u09a7\\u09be\\u09a8\\u0964<\\/p>\",\"price\":\"\\u09ef\\u09ef\\u09ef\\/-\"}],\"ad_banner_1_image_url\":\"http:\\/\\/127.0.0.1:8000\\/images\\/20260913134957_original__media_298.webp\",\"ad_banner_2_image_url\":\"http:\\/\\/127.0.0.1:8000\\/images\\/20260913134957_original__media_41.webp\",\"ad_banner_1_media_id\":\"9\",\"ad_banner_2_media_id\":\"8\",\"support_image_media_id\":\"11\",\"title_font_size_desktop\":\"38\",\"title_font_size_mobile\":\"26\"}','12h 30min',0,0,0,0,'',25,'2027-01-13 00:00:00','2027-01-13 23:59:59',0,NULL,NULL,1,1,0,'90','Complete Guide to Web Development','complete-guide-to-web-development','A comprehensive guide to learning modern web development from scratch to advanced topics.','{\"storage\":\"local\",\"original_image\":\"images\\/20260913105208_original__media_451.png\",\"image_40x40\":\"images\\/20260913105208image_40x40_media_477.png\",\"image_80x80\":\"images\\/20260913105208image_80x80_media_276.png\",\"image_68x48\":\"images\\/20260913105208image_68x48_media_346.png\",\"image_190x230\":\"images\\/20260913105208image_190x230_media_353.png\",\"image_163x116\":\"images\\/20260913105208image_163x116_media_460.png\",\"image_295x248\":\"images\\/20260913105208image_295x248_media_430.png\",\"image_417x384\":\"images\\/20260913105208image_417x384_media_111.png\",\"image_thumbnail\":\"images\\/20260913105208image_thumbnail_media_358.png\",\"image_402x248\":\"images\\/20260913105215image_402x248-365.png\"}',-1,2,0,1,'approved','2027-01-12 23:02:21','2026-09-13 13:46:34');
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `currencies`
--

DROP TABLE IF EXISTS `currencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `currencies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exchange_rate` double NOT NULL DEFAULT '0',
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0 inactive, 1 active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currencies`
--

LOCK TABLES `currencies` WRITE;
/*!40000 ALTER TABLE `currencies` DISABLE KEYS */;
INSERT INTO `currencies` VALUES (1,'USD','$','USD',1,1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(2,'Taka','৳','BDT',100,1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(3,'Euro','€','EUR',0.89,1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(4,'Indian Rupee','₹','INR',82.08,1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(5,'Ghana Cedi',' GH₵ ','GHS',11.35,1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(6,'West African CFA franc','CFA','XOF',583.15,1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(7,'Nigerian Naira','₦','NGN',776.5,1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(8,'Indonesian Rupiah','Rp','IDR',15003,1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(9,'Singapore Dollar','$','SGD',1.32,1,'2026-09-12 23:02:27','2026-09-12 23:02:27');
/*!40000 ALTER TABLE `currencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `custom_notifications`
--

DROP TABLE IF EXISTS `custom_notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `custom_notifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `image_media_id` bigint unsigned DEFAULT NULL,
  `role_ids` text COLLATE utf8mb4_unicode_ci,
  `action_for` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instructor_id` bigint unsigned DEFAULT NULL,
  `category_id` bigint unsigned DEFAULT NULL,
  `course_id` bigint unsigned DEFAULT NULL,
  `organization_id` bigint unsigned DEFAULT NULL,
  `student_id` bigint unsigned DEFAULT NULL,
  `blog_id` bigint unsigned DEFAULT NULL,
  `subject_id` bigint unsigned DEFAULT NULL,
  `book_id` bigint unsigned DEFAULT NULL,
  `open_from` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `custom_notifications`
--

LOCK TABLES `custom_notifications` WRITE;
/*!40000 ALTER TABLE `custom_notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `custom_notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `department_languages`
--

DROP TABLE IF EXISTS `department_languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `department_languages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `department_id` bigint unsigned NOT NULL,
  `lang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `department_languages`
--

LOCK TABLES `department_languages` WRITE;
/*!40000 ALTER TABLE `department_languages` DISABLE KEYS */;
/*!40000 ALTER TABLE `department_languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_templates`
--

DROP TABLE IF EXISTS `email_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `email_templates` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identifier` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci,
  `short_codes` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0 inactive, 1 active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_templates`
--

LOCK TABLES `email_templates` WRITE;
/*!40000 ALTER TABLE `email_templates` DISABLE KEYS */;
INSERT INTO `email_templates` VALUES (1,'Email Confirmation','Email Confirmation','email_confirmation','<p>Hi {name},</p><p>Please confirm your email by clicking the link below:</p><p>{confirmation_link}</p><p><br></p><p>Thanks</p><p>{site_name}</p>','{name},{email},{site_name},{confirmation_link}','authentication',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(2,'Welcome to {site_name}','{name},{email},{site_name},{login_link}','welcome_email','2026-09-13 05:02:21','Welcome Email','Welcome Email',1,'0000-00-00 00:00:00','2026-09-12 23:02:21'),(3,'Password Reset Mail','Password Reset Mail','password_reset','Email temple is working Perfectly!! This is test email template from','{name},{email},{site_name},{reset_link},{otp}','authentication',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(4,'Email temple is working Perfectly!! This is test email template from','{name},{email},{site_name},{login_link}','recovery_mail','2026-09-13 05:02:21','Recovery Successful Mail','Recovery Successful Mail',1,'0000-00-00 00:00:00','2026-09-12 23:02:21');
/*!40000 ALTER TABLE `email_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_verifications`
--

DROP TABLE IF EXISTS `email_verifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `email_verifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0=not verify, 1= verified',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_verifications`
--

LOCK TABLES `email_verifications` WRITE;
/*!40000 ALTER TABLE `email_verifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `email_verifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enrolls`
--

DROP TABLE IF EXISTS `enrolls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `enrolls` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `checkout_id` bigint unsigned DEFAULT NULL,
  `price` double NOT NULL DEFAULT '0',
  `quantity` int NOT NULL DEFAULT '0',
  `coupon_discount` double NOT NULL DEFAULT '0',
  `discount` double NOT NULL DEFAULT '0',
  `tax` double NOT NULL DEFAULT '0',
  `shipping_cost` double NOT NULL DEFAULT '0',
  `sub_total` double NOT NULL DEFAULT '0',
  `enrollable_id` bigint unsigned DEFAULT NULL,
  `complete_details` text COLLATE utf8mb4_unicode_ci,
  `complete_count` int NOT NULL DEFAULT '0',
  `enrollable_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `system_commission` double NOT NULL DEFAULT '0',
  `organization_commission` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enrolls`
--

LOCK TABLES `enrolls` WRITE;
/*!40000 ALTER TABLE `enrolls` DISABLE KEYS */;
INSERT INTO `enrolls` VALUES (1,1,0,1,0,0,0,0,0,1,NULL,0,'App\\Models\\Course',0,0,'2026-09-13 11:41:39','2026-09-13 11:41:39'),(2,2,0,1,0,0,0,0,0,1,NULL,0,'App\\Models\\Course',0,0,'2026-09-13 12:08:24','2026-09-13 12:08:24');
/*!40000 ALTER TABLE `enrolls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expertise_languages`
--

DROP TABLE IF EXISTS `expertise_languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `expertise_languages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `expertise_id` bigint unsigned DEFAULT NULL,
  `lang` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expertise_languages`
--

LOCK TABLES `expertise_languages` WRITE;
/*!40000 ALTER TABLE `expertise_languages` DISABLE KEYS */;
/*!40000 ALTER TABLE `expertise_languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expertises`
--

DROP TABLE IF EXISTS `expertises`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `expertises` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `percentage` int NOT NULL DEFAULT '0',
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0 inactive, 1 active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expertises`
--

LOCK TABLES `expertises` WRITE;
/*!40000 ALTER TABLE `expertises` DISABLE KEYS */;
/*!40000 ALTER TABLE `expertises` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `faq_languages`
--

DROP TABLE IF EXISTS `faq_languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faq_languages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `faq_id` bigint unsigned DEFAULT NULL,
  `lang` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `answer` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faq_languages`
--

LOCK TABLES `faq_languages` WRITE;
/*!40000 ALTER TABLE `faq_languages` DISABLE KEYS */;
INSERT INTO `faq_languages` VALUES (1,1,'en','Is it paid course?','Please check purchase price','2026-09-12 23:02:23','2026-09-12 23:02:23');
/*!40000 ALTER TABLE `faq_languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faqs`
--

DROP TABLE IF EXISTS `faqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faqs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint unsigned NOT NULL,
  `question` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faqs`
--

LOCK TABLES `faqs` WRITE;
/*!40000 ALTER TABLE `faqs` DISABLE KEYS */;
INSERT INTO `faqs` VALUES (2,1,'এই কোর্সটি কার জন্য উপযোগী?','<p>এই কোর্সটি নতুন শিক্ষার্থী থেকে শুরু করে যারা নিজেদের দক্ষতা আরও উন্নত করতে চান—সবার জন্য উপযোগী।</p>',1,'2026-09-13 07:32:03','2026-09-13 07:33:01'),(3,1,'কোর্সটি সম্পূর্ণ করতে কত সময় লাগবে?','<p>আপনার শেখার গতি অনুযায়ী সময় ভিন্ন হতে পারে। নিয়মিত সময় দিলে সহজেই নির্ধারিত সময়ের মধ্যে কোর্সটি সম্পন্ন করতে পারবেন।</p>',1,'2026-09-13 07:33:34','2026-09-13 07:33:34'),(4,1,'কোর্সে ভর্তি হওয়ার পর কীভাবে ক্লাসগুলো অ্যাক্সেস করব?','<p>ভর্তি সম্পন্ন করার পর আপনার অ্যাকাউন্টে লগইন করে ড্যাশবোর্ড থেকে সরাসরি কোর্সের ক্লাস ও শিক্ষামূলক উপকরণগুলো অ্যাক্সেস করতে পারবেন।</p>',1,'2026-09-13 07:33:57','2026-09-13 07:33:57'),(5,1,'কোর্স সম্পন্ন করলে কি সার্টিফিকেট দেওয়া হবে?','<p>হ্যাঁ, কোর্সের নির্ধারিত পাঠ ও প্রয়োজনীয় কার্যক্রম সম্পন্ন করলে আপনি কোর্স সম্পন্ন করার সার্টিফিকেট পেতে পারেন।</p>',1,'2026-09-13 07:34:14','2026-09-13 07:34:14'),(6,1,'কোর্স সম্পর্কে আরও সাহায্য বা সাপোর্ট কীভাবে পাব?','<p>কোর্স চলাকালীন কোনো সমস্যা বা প্রশ্ন থাকলে আমাদের সাপোর্ট টিমের সঙ্গে যোগাযোগ করে প্রয়োজনীয় সহায়তা নিতে পারবেন।</p>',1,'2026-09-13 07:34:32','2026-09-13 07:34:32');
/*!40000 ALTER TABLE `faqs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `feedback` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` text COLLATE utf8mb4_unicode_ci,
  `feedback_media_id` bigint unsigned DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0 inactive, 1 active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback`
--

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
INSERT INTO `feedback` VALUES (1,'Good','good','It was nice for me to be able to do the assignments and tests at my leisure and when I had the time. I loved how you stated unequivocally that additional online research may be required for some assignments. To be honest, there was nothing I didn\'t appreciate about the course.\r\n            I will undoubtedly take another online course from you!',NULL,NULL,3,1,'2026-09-12 23:02:27','2026-09-12 23:02:27');
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback_languages`
--

DROP TABLE IF EXISTS `feedback_languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `feedback_languages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `feedback_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback_languages`
--

LOCK TABLES `feedback_languages` WRITE;
/*!40000 ALTER TABLE `feedback_languages` DISABLE KEYS */;
INSERT INTO `feedback_languages` VALUES (1,'Good','en','It was nice for me to be able to do the assignments and tests at my leisure and when I had the time. I loved how you stated unequivocally that additional online research may be required for some assignments. To be honest, there was nothing I didn\'t appreciate about the course. \r\n            I will undoubtedly take another online course from you!',1,'2026-09-12 23:02:27','2026-09-12 23:02:27');
/*!40000 ALTER TABLE `feedback_languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `flag_icons`
--

DROP TABLE IF EXISTS `flag_icons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `flag_icons` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=241 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `flag_icons`
--

LOCK TABLES `flag_icons` WRITE;
/*!40000 ALTER TABLE `flag_icons` DISABLE KEYS */;
INSERT INTO `flag_icons` VALUES (1,'images/flags/ad.png','AD','2026-09-12 23:02:23','2026-09-12 23:02:23'),(2,'images/flags/ae.png','AE','2026-09-12 23:02:23','2026-09-12 23:02:23'),(3,'images/flags/af.png','AF','2026-09-12 23:02:23','2026-09-12 23:02:23'),(4,'images/flags/ag.png','AG','2026-09-12 23:02:23','2026-09-12 23:02:23'),(5,'images/flags/ai.png','AI','2026-09-12 23:02:23','2026-09-12 23:02:23'),(6,'images/flags/al.png','AL','2026-09-12 23:02:23','2026-09-12 23:02:23'),(7,'images/flags/am.png','AM','2026-09-12 23:02:23','2026-09-12 23:02:23'),(8,'images/flags/ao.png','AO','2026-09-12 23:02:23','2026-09-12 23:02:23'),(9,'images/flags/ar.png','AR','2026-09-12 23:02:23','2026-09-12 23:02:23'),(10,'images/flags/as.png','AS','2026-09-12 23:02:23','2026-09-12 23:02:23'),(11,'images/flags/at.png','AT','2026-09-12 23:02:23','2026-09-12 23:02:23'),(12,'images/flags/au.png','AU','2026-09-12 23:02:23','2026-09-12 23:02:23'),(13,'images/flags/aw.png','AW','2026-09-12 23:02:23','2026-09-12 23:02:23'),(14,'images/flags/ax.png','AX','2026-09-12 23:02:23','2026-09-12 23:02:23'),(15,'images/flags/az.png','AZ','2026-09-12 23:02:23','2026-09-12 23:02:23'),(16,'images/flags/ba.png','BA','2026-09-12 23:02:23','2026-09-12 23:02:23'),(17,'images/flags/bb.png','BB','2026-09-12 23:02:23','2026-09-12 23:02:23'),(18,'images/flags/bd.png','BD','2026-09-12 23:02:23','2026-09-12 23:02:23'),(19,'images/flags/be.png','BE','2026-09-12 23:02:23','2026-09-12 23:02:23'),(20,'images/flags/bf.png','BF','2026-09-12 23:02:23','2026-09-12 23:02:23'),(21,'images/flags/bg.png','BG','2026-09-12 23:02:23','2026-09-12 23:02:23'),(22,'images/flags/bh.png','BH','2026-09-12 23:02:23','2026-09-12 23:02:23'),(23,'images/flags/bi.png','BI','2026-09-12 23:02:23','2026-09-12 23:02:23'),(24,'images/flags/bj.png','BJ','2026-09-12 23:02:23','2026-09-12 23:02:23'),(25,'images/flags/bm.png','BM','2026-09-12 23:02:23','2026-09-12 23:02:23'),(26,'images/flags/bn.png','BN','2026-09-12 23:02:23','2026-09-12 23:02:23'),(27,'images/flags/bo.png','BO','2026-09-12 23:02:23','2026-09-12 23:02:23'),(28,'images/flags/br.png','BR','2026-09-12 23:02:23','2026-09-12 23:02:23'),(29,'images/flags/bs.png','BS','2026-09-12 23:02:23','2026-09-12 23:02:23'),(30,'images/flags/bt.png','BT','2026-09-12 23:02:23','2026-09-12 23:02:23'),(31,'images/flags/bv.png','BV','2026-09-12 23:02:23','2026-09-12 23:02:23'),(32,'images/flags/bw.png','BW','2026-09-12 23:02:23','2026-09-12 23:02:23'),(33,'images/flags/by.png','BY','2026-09-12 23:02:23','2026-09-12 23:02:23'),(34,'images/flags/bz.png','BZ','2026-09-12 23:02:23','2026-09-12 23:02:23'),(35,'images/flags/ca.png','CA','2026-09-12 23:02:23','2026-09-12 23:02:23'),(36,'images/flags/cc.png','CC','2026-09-12 23:02:23','2026-09-12 23:02:23'),(37,'images/flags/cd.png','CD','2026-09-12 23:02:23','2026-09-12 23:02:23'),(38,'images/flags/cf.png','CF','2026-09-12 23:02:23','2026-09-12 23:02:23'),(39,'images/flags/cg.png','CG','2026-09-12 23:02:23','2026-09-12 23:02:23'),(40,'images/flags/ch.png','CH','2026-09-12 23:02:23','2026-09-12 23:02:23'),(41,'images/flags/ci.png','CI','2026-09-12 23:02:23','2026-09-12 23:02:23'),(42,'images/flags/ck.png','CK','2026-09-12 23:02:23','2026-09-12 23:02:23'),(43,'images/flags/cl.png','CL','2026-09-12 23:02:23','2026-09-12 23:02:23'),(44,'images/flags/cm.png','CM','2026-09-12 23:02:23','2026-09-12 23:02:23'),(45,'images/flags/cn.png','CN','2026-09-12 23:02:23','2026-09-12 23:02:23'),(46,'images/flags/co.png','CO','2026-09-12 23:02:23','2026-09-12 23:02:23'),(47,'images/flags/cr.png','CR','2026-09-12 23:02:23','2026-09-12 23:02:23'),(48,'images/flags/cv.png','CV','2026-09-12 23:02:23','2026-09-12 23:02:23'),(49,'images/flags/cv.png','CV','2026-09-12 23:02:23','2026-09-12 23:02:23'),(50,'images/flags/cx.png','CX','2026-09-12 23:02:23','2026-09-12 23:02:23'),(51,'images/flags/cy.png','CY','2026-09-12 23:02:23','2026-09-12 23:02:23'),(52,'images/flags/cz.png','CZ','2026-09-12 23:02:23','2026-09-12 23:02:23'),(53,'images/flags/de.png','DE','2026-09-12 23:02:23','2026-09-12 23:02:23'),(54,'images/flags/dj.png','DJ','2026-09-12 23:02:23','2026-09-12 23:02:23'),(55,'images/flags/dk.png','DK','2026-09-12 23:02:23','2026-09-12 23:02:23'),(56,'images/flags/dm.png','DM','2026-09-12 23:02:23','2026-09-12 23:02:23'),(57,'images/flags/do.png','DO','2026-09-12 23:02:23','2026-09-12 23:02:23'),(58,'images/flags/dz.png','DZ','2026-09-12 23:02:23','2026-09-12 23:02:23'),(59,'images/flags/ec.png','EC','2026-09-12 23:02:23','2026-09-12 23:02:23'),(60,'images/flags/ee.png','EE','2026-09-12 23:02:23','2026-09-12 23:02:23'),(61,'images/flags/eg.png','EG','2026-09-12 23:02:23','2026-09-12 23:02:23'),(62,'images/flags/eh.png','EH','2026-09-12 23:02:23','2026-09-12 23:02:23'),(63,'images/flags/er.png','ER','2026-09-12 23:02:23','2026-09-12 23:02:23'),(64,'images/flags/es.png','ES','2026-09-12 23:02:23','2026-09-12 23:02:23'),(65,'images/flags/et.png','ET','2026-09-12 23:02:23','2026-09-12 23:02:23'),(66,'images/flags/fi.png','FI','2026-09-12 23:02:23','2026-09-12 23:02:23'),(67,'images/flags/fj.png','FJ','2026-09-12 23:02:23','2026-09-12 23:02:23'),(68,'images/flags/fk.png','FK','2026-09-12 23:02:23','2026-09-12 23:02:23'),(69,'images/flags/fm.png','FM','2026-09-12 23:02:23','2026-09-12 23:02:23'),(70,'images/flags/fo.png','FO','2026-09-12 23:02:23','2026-09-12 23:02:23'),(71,'images/flags/fr.png','FR','2026-09-12 23:02:23','2026-09-12 23:02:23'),(72,'images/flags/ga.png','GA','2026-09-12 23:02:23','2026-09-12 23:02:23'),(73,'images/flags/gb.png','GB','2026-09-12 23:02:23','2026-09-12 23:02:23'),(74,'images/flags/gd.png','GD','2026-09-12 23:02:23','2026-09-12 23:02:23'),(75,'images/flags/ge.png','GE','2026-09-12 23:02:23','2026-09-12 23:02:23'),(76,'images/flags/gf.png','GF','2026-09-12 23:02:23','2026-09-12 23:02:23'),(77,'images/flags/gh.png','GH','2026-09-12 23:02:23','2026-09-12 23:02:23'),(78,'images/flags/gi.png','GI','2026-09-12 23:02:23','2026-09-12 23:02:23'),(79,'images/flags/gl.png','GL','2026-09-12 23:02:23','2026-09-12 23:02:23'),(80,'images/flags/gm.png','GM','2026-09-12 23:02:23','2026-09-12 23:02:23'),(81,'images/flags/gn.png','GN','2026-09-12 23:02:23','2026-09-12 23:02:23'),(82,'images/flags/gn.png','GN','2026-09-12 23:02:23','2026-09-12 23:02:23'),(83,'images/flags/gp.png','GP','2026-09-12 23:02:23','2026-09-12 23:02:23'),(84,'images/flags/gq.png','GQ','2026-09-12 23:02:23','2026-09-12 23:02:23'),(85,'images/flags/gr.png','GR','2026-09-12 23:02:23','2026-09-12 23:02:23'),(86,'images/flags/gs.png','GS','2026-09-12 23:02:23','2026-09-12 23:02:23'),(87,'images/flags/gt.png','GT','2026-09-12 23:02:23','2026-09-12 23:02:23'),(88,'images/flags/gu.png','GU','2026-09-12 23:02:23','2026-09-12 23:02:23'),(89,'images/flags/gw.png','GW','2026-09-12 23:02:23','2026-09-12 23:02:23'),(90,'images/flags/gy.png','GY','2026-09-12 23:02:23','2026-09-12 23:02:23'),(91,'images/flags/hk.png','HK','2026-09-12 23:02:23','2026-09-12 23:02:23'),(92,'images/flags/hm.png','HM','2026-09-12 23:02:23','2026-09-12 23:02:23'),(93,'images/flags/hn.png','HN','2026-09-12 23:02:23','2026-09-12 23:02:23'),(94,'images/flags/hr.png','HR','2026-09-12 23:02:23','2026-09-12 23:02:23'),(95,'images/flags/ht.png','HT','2026-09-12 23:02:23','2026-09-12 23:02:23'),(96,'images/flags/hu.png','HU','2026-09-12 23:02:23','2026-09-12 23:02:23'),(97,'images/flags/id.png','ID','2026-09-12 23:02:23','2026-09-12 23:02:23'),(98,'images/flags/ie.png','IE','2026-09-12 23:02:23','2026-09-12 23:02:23'),(99,'images/flags/il.png','IL','2026-09-12 23:02:23','2026-09-12 23:02:23'),(100,'images/flags/in.png','IN','2026-09-12 23:02:23','2026-09-12 23:02:23'),(101,'images/flags/io.png','IO','2026-09-12 23:02:23','2026-09-12 23:02:23'),(102,'images/flags/iq.png','IQ','2026-09-12 23:02:23','2026-09-12 23:02:23'),(103,'images/flags/ir.png','IR','2026-09-12 23:02:23','2026-09-12 23:02:23'),(104,'images/flags/is.png','IS','2026-09-12 23:02:23','2026-09-12 23:02:23'),(105,'images/flags/it.png','IT','2026-09-12 23:02:23','2026-09-12 23:02:23'),(106,'images/flags/jm.png','JM','2026-09-12 23:02:23','2026-09-12 23:02:23'),(107,'images/flags/jo.png','JO','2026-09-12 23:02:23','2026-09-12 23:02:23'),(108,'images/flags/jp.png','JP','2026-09-12 23:02:23','2026-09-12 23:02:23'),(109,'images/flags/ke.png','KE','2026-09-12 23:02:23','2026-09-12 23:02:23'),(110,'images/flags/kg.png','KG','2026-09-12 23:02:23','2026-09-12 23:02:23'),(111,'images/flags/kh.png','KH','2026-09-12 23:02:23','2026-09-12 23:02:23'),(112,'images/flags/ki.png','KI','2026-09-12 23:02:23','2026-09-12 23:02:23'),(113,'images/flags/km.png','KM','2026-09-12 23:02:23','2026-09-12 23:02:23'),(114,'images/flags/kn.png','KN','2026-09-12 23:02:23','2026-09-12 23:02:23'),(115,'images/flags/kp.png','KP','2026-09-12 23:02:23','2026-09-12 23:02:23'),(116,'images/flags/kr.png','KR','2026-09-12 23:02:23','2026-09-12 23:02:23'),(117,'images/flags/kw.png','KW','2026-09-12 23:02:23','2026-09-12 23:02:23'),(118,'images/flags/ky.png','KY','2026-09-12 23:02:23','2026-09-12 23:02:23'),(119,'images/flags/kz.png','KZ','2026-09-12 23:02:23','2026-09-12 23:02:23'),(120,'images/flags/la.png','LA','2026-09-12 23:02:23','2026-09-12 23:02:23'),(121,'images/flags/lb.png','LB','2026-09-12 23:02:23','2026-09-12 23:02:23'),(122,'images/flags/lc.png','LC','2026-09-12 23:02:23','2026-09-12 23:02:23'),(123,'images/flags/li.png','LI','2026-09-12 23:02:23','2026-09-12 23:02:23'),(124,'images/flags/lk.png','LK','2026-09-12 23:02:23','2026-09-12 23:02:23'),(125,'images/flags/lr.png','LR','2026-09-12 23:02:23','2026-09-12 23:02:23'),(126,'images/flags/ls.png','LS','2026-09-12 23:02:23','2026-09-12 23:02:23'),(127,'images/flags/lt.png','LT','2026-09-12 23:02:23','2026-09-12 23:02:23'),(128,'images/flags/lu.png','LU','2026-09-12 23:02:23','2026-09-12 23:02:23'),(129,'images/flags/lv.png','LV','2026-09-12 23:02:23','2026-09-12 23:02:23'),(130,'images/flags/ly.png','LY','2026-09-12 23:02:23','2026-09-12 23:02:23'),(131,'images/flags/ma.png','MA','2026-09-12 23:02:23','2026-09-12 23:02:23'),(132,'images/flags/mc.png','MC','2026-09-12 23:02:23','2026-09-12 23:02:23'),(133,'images/flags/md.png','MD','2026-09-12 23:02:23','2026-09-12 23:02:23'),(134,'images/flags/me.png','ME','2026-09-12 23:02:23','2026-09-12 23:02:23'),(135,'images/flags/mg.png','MG','2026-09-12 23:02:23','2026-09-12 23:02:23'),(136,'images/flags/mh.png','MH','2026-09-12 23:02:23','2026-09-12 23:02:23'),(137,'images/flags/mk.png','MK','2026-09-12 23:02:23','2026-09-12 23:02:23'),(138,'images/flags/ml.png','ML','2026-09-12 23:02:23','2026-09-12 23:02:23'),(139,'images/flags/mm.png','MM','2026-09-12 23:02:23','2026-09-12 23:02:23'),(140,'images/flags/mn.png','MN','2026-09-12 23:02:23','2026-09-12 23:02:23'),(141,'images/flags/mo.png','MO','2026-09-12 23:02:23','2026-09-12 23:02:23'),(142,'images/flags/mp.png','MP','2026-09-12 23:02:23','2026-09-12 23:02:23'),(143,'images/flags/mq.png','MQ','2026-09-12 23:02:23','2026-09-12 23:02:23'),(144,'images/flags/mr.png','MR','2026-09-12 23:02:23','2026-09-12 23:02:23'),(145,'images/flags/ms.png','MS','2026-09-12 23:02:23','2026-09-12 23:02:23'),(146,'images/flags/mt.png','MT','2026-09-12 23:02:23','2026-09-12 23:02:23'),(147,'images/flags/mu.png','MU','2026-09-12 23:02:23','2026-09-12 23:02:23'),(148,'images/flags/mv.png','MV','2026-09-12 23:02:23','2026-09-12 23:02:23'),(149,'images/flags/mw.png','MW','2026-09-12 23:02:23','2026-09-12 23:02:23'),(150,'images/flags/mx.png','MX','2026-09-12 23:02:23','2026-09-12 23:02:23'),(151,'images/flags/my.png','MY','2026-09-12 23:02:23','2026-09-12 23:02:23'),(152,'images/flags/mz.png','MZ','2026-09-12 23:02:23','2026-09-12 23:02:23'),(153,'images/flags/na.png','NA','2026-09-12 23:02:23','2026-09-12 23:02:23'),(154,'images/flags/nc.png','NC','2026-09-12 23:02:23','2026-09-12 23:02:23'),(155,'images/flags/ne.png','NE','2026-09-12 23:02:23','2026-09-12 23:02:23'),(156,'images/flags/nf.png','NF','2026-09-12 23:02:23','2026-09-12 23:02:23'),(157,'images/flags/ng.png','NG','2026-09-12 23:02:23','2026-09-12 23:02:23'),(158,'images/flags/ni.png','NI','2026-09-12 23:02:23','2026-09-12 23:02:23'),(159,'images/flags/nl.png','NL','2026-09-12 23:02:23','2026-09-12 23:02:23'),(160,'images/flags/no.png','NO','2026-09-12 23:02:23','2026-09-12 23:02:23'),(161,'images/flags/np.png','NP','2026-09-12 23:02:23','2026-09-12 23:02:23'),(162,'images/flags/nr.png','NR','2026-09-12 23:02:23','2026-09-12 23:02:23'),(163,'images/flags/nu.png','NU','2026-09-12 23:02:23','2026-09-12 23:02:23'),(164,'images/flags/nz.png','NZ','2026-09-12 23:02:23','2026-09-12 23:02:23'),(165,'images/flags/om.png','OM','2026-09-12 23:02:23','2026-09-12 23:02:23'),(166,'images/flags/pa.png','PA','2026-09-12 23:02:23','2026-09-12 23:02:23'),(167,'images/flags/pe.png','PE','2026-09-12 23:02:23','2026-09-12 23:02:23'),(168,'images/flags/pf.png','PF','2026-09-12 23:02:23','2026-09-12 23:02:23'),(169,'images/flags/pg.png','PG','2026-09-12 23:02:23','2026-09-12 23:02:23'),(170,'images/flags/ph.png','PH','2026-09-12 23:02:23','2026-09-12 23:02:23'),(171,'images/flags/pk.png','PK','2026-09-12 23:02:23','2026-09-12 23:02:23'),(172,'images/flags/pl.png','PL','2026-09-12 23:02:23','2026-09-12 23:02:23'),(173,'images/flags/pm.png','PM','2026-09-12 23:02:23','2026-09-12 23:02:23'),(174,'images/flags/pn.png','PN','2026-09-12 23:02:23','2026-09-12 23:02:23'),(175,'images/flags/pr.png','PR','2026-09-12 23:02:23','2026-09-12 23:02:23'),(176,'images/flags/ps.png','PS','2026-09-12 23:02:23','2026-09-12 23:02:23'),(177,'images/flags/pt.png','PT','2026-09-12 23:02:23','2026-09-12 23:02:23'),(178,'images/flags/pw.png','PW','2026-09-12 23:02:23','2026-09-12 23:02:23'),(179,'images/flags/py.png','PY','2026-09-12 23:02:23','2026-09-12 23:02:23'),(180,'images/flags/qa.png','QA','2026-09-12 23:02:23','2026-09-12 23:02:23'),(181,'images/flags/re.png','RE','2026-09-12 23:02:23','2026-09-12 23:02:23'),(182,'images/flags/ro.png','RO','2026-09-12 23:02:23','2026-09-12 23:02:23'),(183,'images/flags/rs.png','RS','2026-09-12 23:02:23','2026-09-12 23:02:23'),(184,'images/flags/ru.png','RU','2026-09-12 23:02:23','2026-09-12 23:02:23'),(185,'images/flags/rw.png','RW','2026-09-12 23:02:23','2026-09-12 23:02:23'),(186,'images/flags/sa.png','SA','2026-09-12 23:02:23','2026-09-12 23:02:23'),(187,'images/flags/sb.png','SB','2026-09-12 23:02:23','2026-09-12 23:02:23'),(188,'images/flags/sc.png','SC','2026-09-12 23:02:23','2026-09-12 23:02:23'),(189,'images/flags/sd.png','SD','2026-09-12 23:02:23','2026-09-12 23:02:23'),(190,'images/flags/se.png','SE','2026-09-12 23:02:23','2026-09-12 23:02:23'),(191,'images/flags/sg.png','SG','2026-09-12 23:02:23','2026-09-12 23:02:23'),(192,'images/flags/sh.png','SH','2026-09-12 23:02:23','2026-09-12 23:02:23'),(193,'images/flags/si.png','SI','2026-09-12 23:02:23','2026-09-12 23:02:23'),(194,'images/flags/sj.png','SJ','2026-09-12 23:02:23','2026-09-12 23:02:23'),(195,'images/flags/sk.png','SK','2026-09-12 23:02:23','2026-09-12 23:02:23'),(196,'images/flags/sl.png','SL','2026-09-12 23:02:23','2026-09-12 23:02:23'),(197,'images/flags/sm.png','SM','2026-09-12 23:02:23','2026-09-12 23:02:23'),(198,'images/flags/sn.png','SN','2026-09-12 23:02:23','2026-09-12 23:02:23'),(199,'images/flags/so.png','SO','2026-09-12 23:02:23','2026-09-12 23:02:23'),(200,'images/flags/sr.png','SR','2026-09-12 23:02:23','2026-09-12 23:02:23'),(201,'images/flags/st.png','ST','2026-09-12 23:02:23','2026-09-12 23:02:23'),(202,'images/flags/sv.png','SV','2026-09-12 23:02:23','2026-09-12 23:02:23'),(203,'images/flags/sy.png','SY','2026-09-12 23:02:23','2026-09-12 23:02:23'),(204,'images/flags/sz.png','SZ','2026-09-12 23:02:23','2026-09-12 23:02:23'),(205,'images/flags/tc.png','TC','2026-09-12 23:02:23','2026-09-12 23:02:23'),(206,'images/flags/td.png','TD','2026-09-12 23:02:23','2026-09-12 23:02:23'),(207,'images/flags/tf.png','TF','2026-09-12 23:02:23','2026-09-12 23:02:23'),(208,'images/flags/tg.png','TG','2026-09-12 23:02:23','2026-09-12 23:02:23'),(209,'images/flags/th.png','TH','2026-09-12 23:02:23','2026-09-12 23:02:23'),(210,'images/flags/tj.png','TJ','2026-09-12 23:02:23','2026-09-12 23:02:23'),(211,'images/flags/tk.png','TK','2026-09-12 23:02:23','2026-09-12 23:02:23'),(212,'images/flags/tl.png','TL','2026-09-12 23:02:23','2026-09-12 23:02:23'),(213,'images/flags/tm.png','TM','2026-09-12 23:02:23','2026-09-12 23:02:23'),(214,'images/flags/tn.png','TN','2026-09-12 23:02:23','2026-09-12 23:02:23'),(215,'images/flags/to.png','TO','2026-09-12 23:02:23','2026-09-12 23:02:23'),(216,'images/flags/tr.png','TR','2026-09-12 23:02:23','2026-09-12 23:02:23'),(217,'images/flags/tt.png','TT','2026-09-12 23:02:23','2026-09-12 23:02:23'),(218,'images/flags/tv.png','TV','2026-09-12 23:02:23','2026-09-12 23:02:23'),(219,'images/flags/tw.png','TW','2026-09-12 23:02:23','2026-09-12 23:02:23'),(220,'images/flags/tz.png','TZ','2026-09-12 23:02:23','2026-09-12 23:02:23'),(221,'images/flags/ua.png','UA','2026-09-12 23:02:23','2026-09-12 23:02:23'),(222,'images/flags/us.png','US','2026-09-12 23:02:23','2026-09-12 23:02:23'),(223,'images/flags/ug.png','UG','2026-09-12 23:02:23','2026-09-12 23:02:23'),(224,'images/flags/um.png','UM','2026-09-12 23:02:23','2026-09-12 23:02:23'),(225,'images/flags/uy.png','UY','2026-09-12 23:02:23','2026-09-12 23:02:23'),(226,'images/flags/uz.png','UZ','2026-09-12 23:02:23','2026-09-12 23:02:23'),(227,'images/flags/va.png','VA','2026-09-12 23:02:23','2026-09-12 23:02:23'),(228,'images/flags/vc.png','VC','2026-09-12 23:02:23','2026-09-12 23:02:23'),(229,'images/flags/ve.png','VE','2026-09-12 23:02:23','2026-09-12 23:02:23'),(230,'images/flags/vg.png','VG','2026-09-12 23:02:23','2026-09-12 23:02:23'),(231,'images/flags/vi.png','VI','2026-09-12 23:02:23','2026-09-12 23:02:23'),(232,'images/flags/vn.png','VN','2026-09-12 23:02:23','2026-09-12 23:02:23'),(233,'images/flags/vu.png','VU','2026-09-12 23:02:23','2026-09-12 23:02:23'),(234,'images/flags/wf.png','WF','2026-09-12 23:02:23','2026-09-12 23:02:23'),(235,'images/flags/ws.png','WS','2026-09-12 23:02:23','2026-09-12 23:02:23'),(236,'images/flags/ye.png','YE','2026-09-12 23:02:23','2026-09-12 23:02:23'),(237,'images/flags/yt.png','YT','2026-09-12 23:02:23','2026-09-12 23:02:23'),(238,'images/flags/za.png','ZA','2026-09-12 23:02:23','2026-09-12 23:02:23'),(239,'images/flags/zm.png','ZM','2026-09-12 23:02:23','2026-09-12 23:02:23'),(240,'images/flags/zw.png','ZW','2026-09-12 23:02:23','2026-09-12 23:02:23');
/*!40000 ALTER TABLE `flag_icons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `follows`
--

DROP TABLE IF EXISTS `follows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `follows` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `follower_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `follows`
--

LOCK TABLES `follows` WRITE;
/*!40000 ALTER TABLE `follows` DISABLE KEYS */;
INSERT INTO `follows` VALUES (1,4,3,'2026-09-12 23:02:27','2026-09-12 23:02:27');
/*!40000 ALTER TABLE `follows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `home_screens`
--

DROP TABLE IF EXISTS `home_screens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `home_screens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `section` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'home_screen',
  `contents` text COLLATE utf8mb4_unicode_ci,
  `position` int NOT NULL DEFAULT '0',
  `version` tinyint NOT NULL DEFAULT '1' COMMENT 'use for demo purpose only',
  `media_id_1` bigint unsigned DEFAULT NULL,
  `image_1` text COLLATE utf8mb4_unicode_ci,
  `media_id_2` bigint unsigned DEFAULT NULL,
  `image_2` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `home_screens`
--

LOCK TABLES `home_screens` WRITE;
/*!40000 ALTER TABLE `home_screens` DISABLE KEYS */;
INSERT INTO `home_screens` VALUES (1,'top_courses','home_page','{\"title\":\"Top Courses\",\"sub_title\":\"\"}',0,1,NULL,NULL,NULL,NULL,'2026-09-12 23:02:22','2026-09-12 23:02:22'),(2,'blog_news','home_page','{\"title\":\"Latest News From Blog\",\"sub_title\":\"\"}',0,1,NULL,NULL,NULL,NULL,'2026-09-12 23:02:22','2026-09-12 23:02:22'),(3,'fun_fact','home_page','{\"title\":\"Fun Fact\",\"sub_title\":\"\",\"image1\":\"\",\"image2\":\"\"}',0,1,NULL,NULL,NULL,NULL,'2026-09-12 23:02:22','2026-09-12 23:02:22');
/*!40000 ALTER TABLE `home_screens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instructor_payout_methods`
--

DROP TABLE IF EXISTS `instructor_payout_methods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `instructor_payout_methods` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `instructor_id` bigint unsigned DEFAULT NULL,
  `payout_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=active, 0=inactive',
  `is_default` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=default, 0=not default',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instructor_payout_methods`
--

LOCK TABLES `instructor_payout_methods` WRITE;
/*!40000 ALTER TABLE `instructor_payout_methods` DISABLE KEYS */;
/*!40000 ALTER TABLE `instructor_payout_methods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instructors`
--

DROP TABLE IF EXISTS `instructors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `instructors` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `organization_id` bigint unsigned DEFAULT NULL,
  `designation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expertises` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_links` text COLLATE utf8mb4_unicode_ci,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instructors`
--

LOCK TABLES `instructors` WRITE;
/*!40000 ALTER TABLE `instructors` DISABLE KEYS */;
INSERT INTO `instructors` VALUES (1,2,1,'Professional Graphic & UX Designer',NULL,'[]',NULL,'instructor','2026-09-12 23:02:21','2026-09-12 23:02:21');
/*!40000 ALTER TABLE `instructors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `language_configs`
--

DROP TABLE IF EXISTS `language_configs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `language_configs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `language_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `script` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `native` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `regional` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `language_configs`
--

LOCK TABLES `language_configs` WRITE;
/*!40000 ALTER TABLE `language_configs` DISABLE KEYS */;
/*!40000 ALTER TABLE `language_configs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `languages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `flag` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_direction` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT 'ltr',
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `languages_locale_unique` (`locale`),
  KEY `languages_name_index` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `languages`
--

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
INSERT INTO `languages` VALUES (1,'English','en','images/flags/us.png','ltr',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(2,'Bangla','bn','images/flags/bd.png','ltr',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(3,'Arabic','ar','images/flags/ar.png','rtl',1,'2026-09-12 23:02:27','2026-09-12 23:02:27');
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lessons`
--

DROP TABLE IF EXISTS `lessons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lessons` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint unsigned NOT NULL,
  `section_id` bigint unsigned NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lesson_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source_data` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` time DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` text COLLATE utf8mb4_unicode_ci,
  `image_media_id` bigint unsigned DEFAULT NULL,
  `is_free` tinyint NOT NULL DEFAULT '0' COMMENT '1=free, 0=not free',
  `order_no` int NOT NULL DEFAULT '0',
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0 inactive, 1 active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lessons`
--

LOCK TABLES `lessons` WRITE;
/*!40000 ALTER TABLE `lessons` DISABLE KEYS */;
/*!40000 ALTER TABLE `lessons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `level_languages`
--

DROP TABLE IF EXISTS `level_languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `level_languages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `level_id` bigint unsigned DEFAULT NULL,
  `lang` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `level_languages`
--

LOCK TABLES `level_languages` WRITE;
/*!40000 ALTER TABLE `level_languages` DISABLE KEYS */;
INSERT INTO `level_languages` VALUES (1,1,'en','beginner','2026-09-12 23:02:22','2026-09-12 23:02:22'),(2,2,'en','Intermediate','2026-09-12 23:02:27','2026-09-12 23:02:27'),(3,3,'en','advanced','2026-09-12 23:02:27','2026-09-12 23:02:27');
/*!40000 ALTER TABLE `level_languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `levels`
--

DROP TABLE IF EXISTS `levels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `levels` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0 inactive, 1 active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `levels`
--

LOCK TABLES `levels` WRITE;
/*!40000 ALTER TABLE `levels` DISABLE KEYS */;
INSERT INTO `levels` VALUES (1,'Beginner',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(2,'Intermediate',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(3,'Advanced',1,'2026-09-12 23:02:27','2026-09-12 23:02:27');
/*!40000 ALTER TABLE `levels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `live_classes`
--

DROP TABLE IF EXISTS `live_classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `live_classes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `course_id` bigint unsigned NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_date` datetime NOT NULL,
  `meeting_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `end_at` datetime DEFAULT NULL,
  `start_at` datetime DEFAULT NULL,
  `is_free` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=free, 0= not free',
  `meeting_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meeting_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meeting_password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 inactive, 1 active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `live_classes`
--

LOCK TABLES `live_classes` WRITE;
/*!40000 ALTER TABLE `live_classes` DISABLE KEYS */;
/*!40000 ALTER TABLE `live_classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marketing_leads`
--

DROP TABLE IF EXISTS `marketing_leads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `marketing_leads` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course_id` bigint unsigned DEFAULT NULL,
  `is_synced` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marketing_leads`
--

LOCK TABLES `marketing_leads` WRITE;
/*!40000 ALTER TABLE `marketing_leads` DISABLE KEYS */;
INSERT INTO `marketing_leads` VALUES (5,'Md. Tanvir Hasan Tonmoy','info.tonmoyorg@12gmail.com','01609804993',1,0,'2026-09-13 12:27:17','2026-09-13 12:27:17'),(6,'Md. Tanvir Hasan Tonmoy','info.tonmoyorg@gmail.com','01609804994',1,0,'2026-09-13 12:28:16','2026-09-13 12:28:16'),(7,'John','admin@spagreen.net','017111131111',1,0,'2026-09-13 14:32:20','2026-09-13 14:32:20');
/*!40000 ALTER TABLE `marketing_leads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media_libraries`
--

DROP TABLE IF EXISTS `media_libraries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `media_libraries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `storage` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'local',
  `type` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extension` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `original_file` text COLLATE utf8mb4_unicode_ci,
  `image_variants` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0 inactive, 1 active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media_libraries`
--

LOCK TABLES `media_libraries` WRITE;
/*!40000 ALTER TABLE `media_libraries` DISABLE KEYS */;
INSERT INTO `media_libraries` VALUES (2,'1920x464%20web',1,'local','image','webp','126244','images/20260913121710_original__media_57.webp','{\"storage\":\"local\",\"original_image\":\"images\\/20260913121710_original__media_57.webp\",\"image_40x40\":\"images\\/20260913121710image_40x40_media_432.webp\",\"image_80x80\":\"images\\/20260913121710image_80x80_media_302.webp\",\"image_68x48\":\"images\\/20260913121710image_68x48_media_339.webp\",\"image_190x230\":\"images\\/20260913121710image_190x230_media_441.webp\",\"image_163x116\":\"images\\/20260913121710image_163x116_media_439.webp\",\"image_295x248\":\"images\\/20260913121710image_295x248_media_383.webp\",\"image_417x384\":\"images\\/20260913121710image_417x384_media_245.webp\",\"image_thumbnail\":\"images\\/20260913121710image_thumbnail_media_231.webp\",\"image_402x238\":\"images\\/20260913121716image_402x238-454.webp\"}',1,'2026-09-13 06:17:10','2026-09-13 06:17:16'),(3,'807086477_1104508172100988_3641328511126429862_n',1,'local','image','png','1757737','images/20260913124335_original__media_132.png','{\"storage\":\"local\",\"original_image\":\"images\\/20260913124335_original__media_132.png\",\"image_40x40\":\"images\\/20260913124335image_40x40_media_489.png\",\"image_80x80\":\"images\\/20260913124335image_80x80_media_257.png\",\"image_68x48\":\"images\\/20260913124335image_68x48_media_437.png\",\"image_190x230\":\"images\\/20260913124335image_190x230_media_109.png\",\"image_163x116\":\"images\\/20260913124335image_163x116_media_75.png\",\"image_295x248\":\"images\\/20260913124335image_295x248_media_117.png\",\"image_417x384\":\"images\\/20260913124335image_417x384_media_21.png\",\"image_thumbnail\":\"images\\/20260913124335image_thumbnail_media_412.png\"}',1,'2026-09-13 06:43:36','2026-09-13 06:43:36'),(4,'GP_MyGP_Story_Card_Internet_load_upto_BDT200_0',1,'local','image','webp','15348','images/20260913132150_original__media_172.webp','{\"storage\":\"local\",\"original_image\":\"images\\/20260913132150_original__media_172.webp\",\"image_40x40\":\"images\\/20260913132150image_40x40_media_295.webp\",\"image_80x80\":\"images\\/20260913132150image_80x80_media_116.webp\",\"image_68x48\":\"images\\/20260913132150image_68x48_media_148.webp\",\"image_190x230\":\"images\\/20260913132150image_190x230_media_188.webp\",\"image_163x116\":\"images\\/20260913132150image_163x116_media_152.webp\",\"image_295x248\":\"images\\/20260913132150image_295x248_media_287.webp\",\"image_417x384\":\"images\\/20260913132150image_417x384_media_212.webp\",\"image_thumbnail\":\"images\\/20260913132150image_thumbnail_media_451.webp\"}',1,'2026-09-13 07:21:51','2026-09-13 07:21:51'),(6,'images (1)',1,'local','image','jpg','37672','images/20260913133653_original__media_279.jpg','{\"storage\":\"local\",\"original_image\":\"images\\/20260913133653_original__media_279.jpg\",\"image_40x40\":\"images\\/20260913133653image_40x40_media_230.jpg\",\"image_80x80\":\"images\\/20260913133653image_80x80_media_460.jpg\",\"image_68x48\":\"images\\/20260913133653image_68x48_media_302.jpg\",\"image_190x230\":\"images\\/20260913133653image_190x230_media_51.jpg\",\"image_163x116\":\"images\\/20260913133653image_163x116_media_471.jpg\",\"image_295x248\":\"images\\/20260913133653image_295x248_media_90.jpg\",\"image_417x384\":\"images\\/20260913133653image_417x384_media_202.jpg\",\"image_thumbnail\":\"images\\/20260913133653image_thumbnail_media_470.jpg\",\"image_473x337\":\"images\\/20260913133800image_473x337-72.jpg\"}',1,'2026-09-13 07:36:53','2026-09-13 07:38:00'),(7,'images (2)',1,'local','image','jpg','10168','images/20260913134012_original__media_364.jpg','{\"storage\":\"local\",\"original_image\":\"images\\/20260913134012_original__media_364.jpg\",\"image_40x40\":\"images\\/20260913134012image_40x40_media_454.jpg\",\"image_80x80\":\"images\\/20260913134012image_80x80_media_30.jpg\",\"image_68x48\":\"images\\/20260913134012image_68x48_media_448.jpg\",\"image_190x230\":\"images\\/20260913134012image_190x230_media_301.jpg\",\"image_163x116\":\"images\\/20260913134012image_163x116_media_338.jpg\",\"image_295x248\":\"images\\/20260913134012image_295x248_media_438.jpg\",\"image_417x384\":\"images\\/20260913134012image_417x384_media_295.jpg\",\"image_thumbnail\":\"images\\/20260913134012image_thumbnail_media_182.jpg\",\"image_473x337\":\"images\\/20260913134037image_473x337-484.jpg\"}',1,'2026-09-13 07:40:12','2026-09-13 07:40:37'),(8,'GP_Accelerator_Desktop_Image',1,'local','image','webp','25764','images/20260913134957_original__media_41.webp','{\"storage\":\"local\",\"original_image\":\"images\\/20260913134957_original__media_41.webp\",\"image_40x40\":\"images\\/20260913134957image_40x40_media_483.webp\",\"image_80x80\":\"images\\/20260913134957image_80x80_media_281.webp\",\"image_68x48\":\"images\\/20260913134957image_68x48_media_362.webp\",\"image_190x230\":\"images\\/20260913134957image_190x230_media_59.webp\",\"image_163x116\":\"images\\/20260913134957image_163x116_media_443.webp\",\"image_295x248\":\"images\\/20260913134957image_295x248_media_175.webp\",\"image_417x384\":\"images\\/20260913134957image_417x384_media_484.webp\",\"image_thumbnail\":\"images\\/20260913134957image_thumbnail_media_350.webp\"}',1,'2026-09-13 07:49:57','2026-09-13 07:49:57'),(9,'GP_4G_Network_Desktop_Image',1,'local','image','webp','70270','images/20260913134957_original__media_298.webp','{\"storage\":\"local\",\"original_image\":\"images\\/20260913134957_original__media_298.webp\",\"image_40x40\":\"images\\/20260913134957image_40x40_media_177.webp\",\"image_80x80\":\"images\\/20260913134957image_80x80_media_111.webp\",\"image_68x48\":\"images\\/20260913134957image_68x48_media_371.webp\",\"image_190x230\":\"images\\/20260913134957image_190x230_media_274.webp\",\"image_163x116\":\"images\\/20260913134957image_163x116_media_220.webp\",\"image_295x248\":\"images\\/20260913134957image_295x248_media_153.webp\",\"image_417x384\":\"images\\/20260913134957image_417x384_media_57.webp\",\"image_thumbnail\":\"images\\/20260913134957image_thumbnail_media_208.webp\"}',1,'2026-09-13 07:49:58','2026-09-13 07:49:58'),(10,'360_F_388744882_VV8WqAoBmeaVE0d6LPR0lQRVGZJrgVz1',1,'local','image','jpg','23358','images/20260913140426_original__media_415.jpg','{\"storage\":\"local\",\"original_image\":\"images\\/20260913140426_original__media_415.jpg\",\"image_40x40\":\"images\\/20260913140426image_40x40_media_407.jpg\",\"image_80x80\":\"images\\/20260913140426image_80x80_media_304.jpg\",\"image_68x48\":\"images\\/20260913140426image_68x48_media_279.jpg\",\"image_190x230\":\"images\\/20260913140426image_190x230_media_234.jpg\",\"image_163x116\":\"images\\/20260913140426image_163x116_media_304.jpg\",\"image_295x248\":\"images\\/20260913140426image_295x248_media_204.jpg\",\"image_417x384\":\"images\\/20260913140426image_417x384_media_372.jpg\",\"image_thumbnail\":\"images\\/20260913140426image_thumbnail_media_318.jpg\"}',1,'2026-09-13 08:04:26','2026-09-13 08:04:26'),(11,'customer-care-webpage-interface-word_53876-134070',1,'local','image','jpg','126243','images/20260913140946_original__media_410.jpg','{\"storage\":\"local\",\"original_image\":\"images\\/20260913140946_original__media_410.jpg\",\"image_40x40\":\"images\\/20260913140946image_40x40_media_199.jpg\",\"image_80x80\":\"images\\/20260913140946image_80x80_media_259.jpg\",\"image_68x48\":\"images\\/20260913140946image_68x48_media_478.jpg\",\"image_190x230\":\"images\\/20260913140946image_190x230_media_120.jpg\",\"image_163x116\":\"images\\/20260913140946image_163x116_media_200.jpg\",\"image_295x248\":\"images\\/20260913140946image_295x248_media_203.jpg\",\"image_417x384\":\"images\\/20260913140946image_417x384_media_295.jpg\",\"image_thumbnail\":\"images\\/20260913140946image_thumbnail_media_436.jpg\"}',1,'2026-09-13 08:09:47','2026-09-13 08:09:47');
/*!40000 ALTER TABLE `media_libraries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meetings`
--

DROP TABLE IF EXISTS `meetings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meetings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `instructor_id` bigint DEFAULT NULL,
  `invitation_ids` text COLLATE utf8mb4_unicode_ci,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `meeting_link` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '0=pending, 1= complete, 2=cancel',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meetings`
--

LOCK TABLES `meetings` WRITE;
/*!40000 ALTER TABLE `meetings` DISABLE KEYS */;
INSERT INTO `meetings` VALUES (1,2,'[\"3\",\"5\"]','2026-09-13 05:02:27','2026-09-14 00:00:00','https://meet.google.com/psg-rbsi-yto',0,'2026-09-12 23:02:27','2026-09-12 23:02:27');
/*!40000 ALTER TABLE `meetings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `message` text COLLATE utf8mb4_unicode_ci,
  `is_seen` tinyint NOT NULL DEFAULT '0' COMMENT '0=unseen, 1=unread',
  `chat_room_id` bigint unsigned DEFAULT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_file` tinyint NOT NULL DEFAULT '0' COMMENT '1=file, 0=not file',
  `file` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_01_02_112613_create_timezones_table',1),(2,'2014_10_12_000000_create_users_table',1),(3,'2014_10_12_100000_create_password_resets_table',1),(4,'2019_08_19_000000_create_failed_jobs_table',1),(5,'2019_12_14_000001_create_personal_access_tokens_table',1),(6,'2023_01_29_044814_create_roles_table',1),(7,'2023_01_29_045732_create_permissions_table',1),(8,'2023_01_29_050544_create_currencies_table',1),(9,'2023_01_29_051134_create_languages_table',1),(10,'2023_01_29_051611_create_settings_table',1),(11,'2023_01_29_052118_create_email_templates_table',1),(12,'2023_01_29_053213_create_media_libraries_table',1),(13,'2023_02_01_113851_create_blog_categories_table',1),(14,'2023_02_01_114033_create_blog_category_languages_table',1),(15,'2023_02_01_114413_create_blogs_table',1),(16,'2023_02_01_115622_create_blog_languages_table',1),(17,'2023_02_01_120210_create_categories_table',1),(18,'2023_02_01_121853_create_category_languages_table',1),(19,'2023_02_02_033740_create_instructors_table',1),(20,'2023_02_02_034754_create_blog_comments_table',1),(21,'2023_02_02_034857_create_blog_comment_replies_table',1),(22,'2023_02_02_035230_create_organizations_table',1),(23,'2023_02_02_035926_create_badges_table',1),(24,'2023_02_02_040320_create_badge_languages_table',1),(25,'2023_02_02_043221_create_contacts_table',1),(26,'2023_02_02_043431_create_courses_table',1),(27,'2023_02_02_050453_create_sections_table',1),(28,'2023_02_02_050724_create_live_classes_table',1),(29,'2023_02_02_051212_create_assignments_table',1),(30,'2023_02_02_051905_create_lessons_table',1),(31,'2023_02_02_052309_create_expertises_table',1),(32,'2023_02_02_052600_create_levels_table',1),(33,'2023_02_02_052652_create_faqs_table',1),(34,'2023_02_02_053036_create_tags_table',1),(35,'2023_02_02_053141_create_coupons_table',1),(36,'2023_02_02_053937_create_coupon_languages_table',1),(37,'2023_02_02_054129_create_carts_table',1),(38,'2023_02_02_055550_create_applied_counpons_table',1),(39,'2023_02_02_055723_create_checkouts_table',1),(40,'2023_02_02_060722_create_brands_table',1),(41,'2023_02_02_061934_create_ratings_table',1),(42,'2023_02_02_062128_create_comments_table',1),(43,'2023_02_02_062415_create_comment_replies_table',1),(44,'2023_02_02_062632_create_feedback_table',1),(45,'2023_02_02_062848_create_feedback_languages_table',1),(46,'2023_02_02_063042_create_success_stories_table',1),(47,'2023_02_02_063343_create_success_story_languages_table',1),(48,'2023_02_02_100336_create_enrolls_table',1),(49,'2023_02_02_101551_create_follows_table',1),(50,'2023_02_02_101757_create_subjects_table',1),(51,'2023_02_02_101859_create_subject_languages_table',1),(52,'2023_02_02_102106_create_services_table',1),(53,'2023_02_02_102252_create_service_languages_table',1),(54,'2023_02_02_102445_create_books_table',1),(55,'2023_02_02_103505_create_wishlists_table',1),(56,'2023_02_02_103827_create_recent_views_table',1),(57,'2023_02_02_103959_create_notifications_table',1),(58,'2023_02_02_104516_create_subscribers_table',1),(59,'2023_02_02_104614_create_wallets_table',1),(60,'2023_02_02_105111_create_transactions_table',1),(61,'2023_02_02_105815_create_activity_logs_table',1),(62,'2023_02_02_110153_create_addresses_table',1),(63,'2023_02_02_111008_create_api_keys_table',1),(64,'2023_02_02_111527_create_api_key_languages_table',1),(65,'2023_02_02_111739_create_countries_table',1),(66,'2023_02_02_111929_create_states_table',1),(67,'2023_02_02_112140_create_cities_table',1),(68,'2023_02_02_112738_create_offline_methods_table',1),(69,'2023_02_02_113133_create_offline_method_languages_table',1),(70,'2023_02_02_113405_create_certificates_table',1),(71,'2023_02_04_045354_create_chat_rooms_table',1),(72,'2023_02_04_045504_create_messages_table',1),(73,'2023_02_04_050123_create_sliders_table',1),(74,'2023_02_04_052805_create_home_screens_table',1),(75,'2023_02_04_052918_create_bundle_courses_table',1),(76,'2023_02_05_053956_create_email_verifications_table',1),(77,'2023_02_05_054220_create_phone_verifications_table',1),(78,'2023_02_12_040457_create_pages_table',1),(79,'2023_02_12_042334_create_page_languages_table',1),(80,'2023_02_12_054655_create_level_languages_table',1),(81,'2023_02_12_055117_create_expertise_languages_table',1),(82,'2023_02_12_055413_create_tag_languages_table',1),(83,'2023_02_14_050321_create_on_boards_table',1),(84,'2023_02_18_084145_create_faq_languages_table',1),(85,'2023_02_22_100545_create_social_accounts_table',1),(86,'2023_02_26_033301_create_addons_table',1),(87,'2023_03_02_113712_create_flag_icons_table',1),(88,'2023_03_07_105153_create_slider_languages_table',1),(89,'2023_03_11_033836_create_testimonials_table',1),(90,'2023_03_11_034029_create_testimonial_languages_table',1),(91,'2023_03_15_094043_create_password_requests_table',1),(92,'2023_03_19_091107_create_language_configs_table',1),(93,'2023_03_20_060444_create_activations_table',1),(94,'2023_03_21_094543_create_sms_templates_table',1),(95,'2023_04_02_034916_create_tickets_table',1),(96,'2023_04_02_035137_create_departments_table',1),(97,'2023_04_02_042554_create_ticket_replies_table',1),(98,'2023_04_02_044233_create_department_languages_table',1),(99,'2023_04_03_101442_create_custom_notifications_table',1),(100,'2023_04_10_063027_create_meetings_table',1),(101,'2023_04_15_102259_create_quizzes_table',1),(102,'2023_04_16_045037_create_quiz_questions_table',1),(103,'2023_04_29_111855_create_package_solutions_table',1),(104,'2023_04_30_084951_create_user_subscriptions_table',1),(105,'2023_05_06_062228_create_payouts_table',1),(106,'2023_05_07_125010_create_instructor_payout_methods_table',1),(107,'2023_05_09_062010_create_submited_assignments_table',1),(108,'2023_05_13_102934_create_accounts_table',1),(109,'2023_05_14_052056_create_organization_payout_methods_table',1),(110,'2023_05_20_093951_create_accounting_transactions_table',1),(111,'2023_05_20_132533_create_bank_accounts_table',1),(112,'2023_05_20_150339_create_quiz_answers_table',1),(113,'2023_05_27_182043_create_transfers_table',1),(114,'2023_06_17_090115_create_refunds_table',1),(115,'2023_06_25_085130_create_payment_methods_table',1),(116,'2023_07_22_082947_create_student_faqs_table',1),(117,'2023_07_22_083009_create_student_faq_languages_table',1),(118,'2023_07_23_144905_create_course_progress_table',1),(119,'2023_07_26_113716_create_resources_table',1),(120,'2023_08_01_090607_create_organization_staff_table',1),(121,'2023_10_11_095100_create_course_user_table',1),(122,'2023_10_15_141150_add_created_by_columns_to_notifications',1),(123,'2023_11_04_104747_add_columns_to_sliders_table',1),(124,'2023_11_05_050606_add_position_to_home_screens_table',1),(125,'2023_11_11_073747_add_url_to_sliders_table',1),(126,'2023_11_21_182025_fix_permissions_table',1),(127,'2023_12_09_135831_change_instructions_column_from_offline_methods',1),(128,'2023_12_09_190707_add_offline_method_id_to_checkouts',1),(129,'2023_12_10_060019_add_offline_method_id_to_wallets',1),(130,'2023_12_16_125355_add_lang_to_users_table',1),(131,'2024_01_15_182809_change_template_id_column_from_sms_templates_table',1),(132,'2024_01_21_054442_fix_missing_permissions',1),(133,'2026_07_29_213026_add_fields_to_testimonials_table',1),(134,'2026_07_29_214809_add_position_rating_video_to_success_stories_table',1),(135,'2026_08_04_131114_add_faq_image_to_courses_table',1),(136,'2026_08_09_000000_add_masterclass_settings_to_courses_table',1),(137,'2026_08_15_203457_add_subtitle_fields_to_courses_table',1),(138,'2026_08_19_180700_add_video_fields_to_offline_methods_table',1),(139,'2026_08_20_000001_add_is_featured_to_success_stories_table',1),(140,'2026_09_11_212506_add_custom_fields_to_certificates_table',1),(141,'2026_09_13_175410_create_marketing_leads_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_read` tinyint NOT NULL DEFAULT '0' COMMENT '1=read, 0=unread',
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `created_by` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offline_method_languages`
--

DROP TABLE IF EXISTS `offline_method_languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `offline_method_languages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instructions` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `offline_method_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offline_method_languages`
--

LOCK TABLES `offline_method_languages` WRITE;
/*!40000 ALTER TABLE `offline_method_languages` DISABLE KEYS */;
/*!40000 ALTER TABLE `offline_method_languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offline_methods`
--

DROP TABLE IF EXISTS `offline_methods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `offline_methods` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instructions` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `video_source` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video` text COLLATE utf8mb4_unicode_ci,
  `offline_method_media_id` bigint unsigned DEFAULT NULL,
  `bank_details` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0 inactive, 1 active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offline_methods`
--

LOCK TABLES `offline_methods` WRITE;
/*!40000 ALTER TABLE `offline_methods` DISABLE KEYS */;
/*!40000 ALTER TABLE `offline_methods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `on_boards`
--

DROP TABLE IF EXISTS `on_boards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `on_boards` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` text COLLATE utf8mb4_unicode_ci,
  `onboard_media_id` bigint unsigned DEFAULT NULL,
  `is_skipable` tinyint NOT NULL DEFAULT '1' COMMENT '1=skipable, 0=not skipable',
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1=active, 0=inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `on_boards`
--

LOCK TABLES `on_boards` WRITE;
/*!40000 ALTER TABLE `on_boards` DISABLE KEYS */;
/*!40000 ALTER TABLE `on_boards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organization_payout_methods`
--

DROP TABLE IF EXISTS `organization_payout_methods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `organization_payout_methods` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `organization_id` bigint unsigned DEFAULT NULL,
  `payout_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=default, 0=not default',
  `user_id` bigint unsigned DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=active, 0=inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organization_payout_methods`
--

LOCK TABLES `organization_payout_methods` WRITE;
/*!40000 ALTER TABLE `organization_payout_methods` DISABLE KEYS */;
/*!40000 ALTER TABLE `organization_payout_methods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organization_staff`
--

DROP TABLE IF EXISTS `organization_staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `organization_staff` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `organization_id` bigint unsigned DEFAULT NULL,
  `designation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expertises` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_links` text COLLATE utf8mb4_unicode_ci,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organization_staff`
--

LOCK TABLES `organization_staff` WRITE;
/*!40000 ALTER TABLE `organization_staff` DISABLE KEYS */;
INSERT INTO `organization_staff` VALUES (1,5,1,'Professional Graphic & UX Designer',NULL,'[]',NULL,'organization-staff','2026-09-12 23:02:23','2026-09-12 23:02:23');
/*!40000 ALTER TABLE `organization_staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organizations`
--

DROP TABLE IF EXISTS `organizations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `organizations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `org_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_country_id` bigint unsigned NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` bigint unsigned NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `tagline` text COLLATE utf8mb4_unicode_ci,
  `logo` text COLLATE utf8mb4_unicode_ci,
  `org_media_id` bigint unsigned DEFAULT NULL,
  `brand_color` text COLLATE utf8mb4_unicode_ci,
  `tin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `license` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `person_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `person_designation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `person_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `person_country_id` bigint unsigned NOT NULL,
  `person_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_details` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `person_image` text COLLATE utf8mb4_unicode_ci,
  `person_media_id` bigint unsigned DEFAULT NULL,
  `about` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0 inactive, 1 active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organizations`
--

LOCK TABLES `organizations` WRITE;
/*!40000 ALTER TABLE `organizations` DISABLE KEYS */;
INSERT INTO `organizations` VALUES (1,'Super Admin Organization','super-admin-organization','organization@spagreen.net',0,'017144444445',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Shelina Gumaje','CEO','gumej@gmail.com',0,'01744444444',NULL,NULL,NULL,NULL,NULL,1,'2026-09-12 23:02:21','2026-09-12 23:02:21');
/*!40000 ALTER TABLE `organizations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `package_solutions`
--

DROP TABLE IF EXISTS `package_solutions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `package_solutions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double NOT NULL DEFAULT '0',
  `validity` int DEFAULT NULL,
  `upload_limit` int DEFAULT NULL,
  `add_limit` int DEFAULT NULL,
  `bundle` int DEFAULT NULL,
  `facilities` tinyint NOT NULL DEFAULT '1' COMMENT '1=yes, 0=no',
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0 inactive, 1 active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `package_solutions`
--

LOCK TABLES `package_solutions` WRITE;
/*!40000 ALTER TABLE `package_solutions` DISABLE KEYS */;
INSERT INTO `package_solutions` VALUES (1,'basic','Aliqua id fugiat nostru irure ex duis ea quis id quis ad et. Sunt qui\r\n             esse pariatur duis deserunt mollit dolore cillum minim tempor enim. Elit aute irure tempor',1000,3,20,5,5,1,1,'2026-09-12 23:02:27','2026-09-12 23:02:27');
/*!40000 ALTER TABLE `package_solutions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page_languages`
--

DROP TABLE IF EXISTS `page_languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `page_languages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `page_id` bigint unsigned DEFAULT NULL,
  `lang` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page_languages`
--

LOCK TABLES `page_languages` WRITE;
/*!40000 ALTER TABLE `page_languages` DISABLE KEYS */;
INSERT INTO `page_languages` VALUES (1,404,'en','Page Not Found.','The page you are looking for might have been removed, had its name changed, or is temporarily unavailable. Please return to the homepage.','Page Not Found.','Page Not Found.','The requested page could not be found.','2026-09-12 23:02:22','2026-09-12 23:02:22'),(2,403,'en','Permission Denied.','You do not have permission to access this resource. If you believe this is an error, please contact support.','Permission Denied.','Permission Denied.','You do not have permission to access this page.','2026-09-12 23:02:22','2026-09-12 23:02:22'),(3,500,'en','Internal Server Error.','An unexpected condition was encountered by the server that prevented it from fulfilling the request. We are working to resolve it.','Internal Server Error.','Internal Server Error.','An internal server error occurred.','2026-09-12 23:02:22','2026-09-12 23:02:22'),(4,100,'en','Privacy Policy','<p class=\"isSelectedEnd\"><strong>Coradius IT Center</strong> আপনার গোপনীয়তা এবং ব্যক্তিগত তথ্যের নিরাপত্তাকে অত্যন্ত গুরুত্ব দেয়। আমাদের ওয়েবসাইট ব্যবহার করার সময় আপনি যে তথ্য প্রদান করেন, তা নিরাপদ রাখা এবং দায়িত্বশীলভাবে ব্যবহার করা আমাদের অঙ্গীকার।</p><h2><span style=\"font-size: 18px;\"><b>আমরা যে তথ্য সংগ্রহ করি</b></span></h2><p class=\"isSelectedEnd\">আপনি যখন আমাদের ওয়েবসাইট ব্যবহার করেন, রেজিস্ট্রেশন করেন, কোর্সে ভর্তি হন বা আমাদের সাথে যোগাযোগ করেন, তখন আপনার নাম, ই-মেইল ঠিকানা, ফোন নম্বর এবং প্রয়োজনীয় অন্যান্য তথ্য সংগ্রহ করা হতে পারে।</p><h2><span style=\"font-size: 18px;\"><b>তথ্য ব্যবহারের উদ্দেশ্য</b></span></h2><p class=\"isSelectedEnd\">সংগৃহীত তথ্য আপনার অ্যাকাউন্ট পরিচালনা, কোর্স ও সেবা প্রদান, আপনার প্রশ্নের উত্তর দেওয়া, গুরুত্বপূর্ণ আপডেট জানানো এবং আমাদের সেবার মান উন্নত করার জন্য ব্যবহার করা হয়।</p><h2><span style=\"font-size: 18px;\"><b>তথ্যের নিরাপত্তা</b></span></h2><p class=\"isSelectedEnd\">আপনার ব্যক্তিগত তথ্যকে অননুমোদিত ব্যবহার, পরিবর্তন, প্রকাশ বা ক্ষতি থেকে সুরক্ষিত রাখতে আমরা যথাযথ নিরাপত্তা ব্যবস্থা গ্রহণ করি।</p><h2><span style=\"font-size: 18px;\"><b>তৃতীয় পক্ষের সাথে তথ্য শেয়ার</b></span></h2><p class=\"isSelectedEnd\">আপনার ব্যক্তিগত তথ্য আপনার অনুমতি ছাড়া বিক্রি বা অপ্রয়োজনীয়ভাবে তৃতীয় পক্ষের কাছে প্রকাশ করা হয় না। তবে আইনগত প্রয়োজন বা আমাদের সেবা পরিচালনার জন্য প্রয়োজন হলে নির্দিষ্ট তথ্য অনুমোদিত পক্ষের সাথে শেয়ার করা হতে পারে।</p><h2><span style=\"font-size: 18px;\"><b>কুকিজ</b></span></h2><p class=\"isSelectedEnd\">আমাদের ওয়েবসাইট ব্যবহারকারীর অভিজ্ঞতা উন্নত করতে এবং ওয়েবসাইটের কার্যক্রম বিশ্লেষণ করতে কুকিজ বা অনুরূপ প্রযুক্তি ব্যবহার করতে পারে।</p><h2><span style=\"font-size: 18px;\"><b>নীতিমালার পরিবর্তন</b></span></h2><p class=\"isSelectedEnd\">প্রয়োজনে আমরা এই গোপনীয়তা নীতিতে পরিবর্তন আনতে পারি। যেকোনো পরিবর্তন এই পৃষ্ঠায় প্রকাশ করা হবে।</p><h2><span style=\"font-size: 18px;\"><b>যোগাযোগ</b></span></h2><p>আমাদের গোপনীয়তা নীতি সম্পর্কে কোনো প্রশ্ন বা উদ্বেগ থাকলে <strong>Coradius IT Center</strong>-এর সাথে যোগাযোগ করুন।</p>','Meta Title','','','2026-09-12 23:02:27','2026-09-13 13:19:40'),(5,101,'en','Terms And Conditions','<p class=\"isSelectedEnd\"><strong>Coradius IT Center</strong>-এর ওয়েবসাইট ও সেবাসমূহ ব্যবহার করার আগে অনুগ্রহ করে নিচের শর্তাবলি পড়ুন। আমাদের ওয়েবসাইট ব্যবহার বা আমাদের কোনো সেবা গ্রহণ করার মাধ্যমে আপনি এই শর্তাবলিতে সম্মত হচ্ছেন।</p><h2><span style=\"font-size: 18px;\"><b>ওয়েবসাইট ব্যবহার</b></span></h2><p class=\"isSelectedEnd\">এই ওয়েবসাইটের সকল কনটেন্ট, তথ্য, ছবি, লেখা এবং অন্যান্য উপকরণ শুধুমাত্র তথ্য ও শিক্ষামূলক উদ্দেশ্যে প্রদান করা হয়। ব্যবহারকারীকে ওয়েবসাইটটি বৈধ ও দায়িত্বশীলভাবে ব্যবহার করতে হবে।</p><h2><span style=\"font-size: 18px;\"><b>অ্যাকাউন্ট ও তথ্য</b></span></h2><p class=\"isSelectedEnd\">ওয়েবসাইটে অ্যাকাউন্ট তৈরি করার ক্ষেত্রে আপনাকে সঠিক ও সম্পূর্ণ তথ্য প্রদান করতে হবে। আপনার অ্যাকাউন্টের তথ্য এবং লগইন নিরাপত্তা বজায় রাখার দায়িত্ব আপনার নিজের।</p><h2><span style=\"font-size: 18px;\"><b>কোর্স ও সেবা</b></span></h2><p class=\"isSelectedEnd\">আমাদের কোর্স, প্রশিক্ষণ এবং অন্যান্য সেবার তথ্য সময়ে সময়ে পরিবর্তিত হতে পারে। <strong>Coradius IT Center</strong> প্রয়োজনে কোনো কোর্স, মূল্য, সময়সূচি বা সেবার বৈশিষ্ট্য পরিবর্তন বা আপডেট করার অধিকার সংরক্ষণ করে।</p><h2><span style=\"font-size: 18px;\"><b>পেমেন্ট ও রিফান্ড</b></span></h2><p class=\"isSelectedEnd\">কোনো পেইড কোর্স বা সেবা গ্রহণের ক্ষেত্রে নির্ধারিত মূল্য পরিশোধ করতে হবে। রিফান্ড বা বাতিলের ক্ষেত্রে সংশ্লিষ্ট কোর্স বা সেবার নির্ধারিত নীতিমালা প্রযোজ্য হবে।</p><h2><span style=\"font-size: 18px;\"><b>ব্যবহারকারীর দায়িত্ব</b></span></h2><p class=\"isSelectedEnd\">ওয়েবসাইট ব্যবহার করার সময় কোনো বেআইনি কার্যক্রম, প্রতারণামূলক কাজ, অন্যের অ্যাকাউন্টে অননুমোদিত প্রবেশ বা ওয়েবসাইটের স্বাভাবিক কার্যক্রম ব্যাহত করে এমন কোনো কাজ করা যাবে না।</p><h2><span style=\"font-size: 18px;\"><b>কনটেন্টের মালিকানা</b></span></h2><p class=\"isSelectedEnd\">এই ওয়েবসাইটে প্রকাশিত লেখা, ছবি, গ্রাফিক্স, লোগো, ভিডিও এবং অন্যান্য কনটেন্ট <strong>Coradius IT Center</strong> অথবা সংশ্লিষ্ট মালিকের সম্পত্তি। অনুমতি ছাড়া এগুলো কপি, পুনঃপ্রকাশ, বিতরণ বা বাণিজ্যিকভাবে ব্যবহার করা যাবে না।</p><h2><span style=\"font-size: 18px;\"><b>দায়বদ্ধতার সীমাবদ্ধতা</b></span></h2><p class=\"isSelectedEnd\">ওয়েবসাইটের তথ্য যথাসম্ভব সঠিক রাখার চেষ্টা করা হলেও কোনো তথ্য সব সময় সম্পূর্ণ, নির্ভুল বা হালনাগাদ থাকবে—এমন নিশ্চয়তা দেওয়া হয় না। ওয়েবসাইট ব্যবহারের ফলে কোনো প্রত্যক্ষ বা পরোক্ষ ক্ষতির জন্য প্রযোজ্য আইন অনুযায়ী আমাদের দায়বদ্ধতা সীমিত থাকবে।</p><h2><span style=\"font-size: 18px;\"><b>শর্তাবলির পরিবর্তন</b></span></h2><p class=\"isSelectedEnd\"><strong>Coradius IT Center</strong> প্রয়োজন অনুযায়ী যেকোনো সময় এই শর্তাবলি পরিবর্তন বা আপডেট করতে পারে। পরিবর্তিত শর্তাবলি এই পৃষ্ঠায় প্রকাশ করার পর তা কার্যকর হবে।</p><h2><span style=\"font-size: 18px;\"><b>যোগাযোগ</b></span></h2><p>এই শর্তাবলি সম্পর্কে কোনো প্রশ্ন বা পরামর্শ থাকলে <strong>Coradius IT Center</strong>-এর সাথে যোগাযোগ করুন।</p>','Meta Title','','','2026-09-12 23:02:27','2026-09-13 13:22:11'),(6,102,'en','Refund Policy','<p class=\"isSelectedEnd\"><span>﻿</span><strong>Coradius IT Center</strong>-এ শিক্ষার্থীদের সন্তুষ্টি এবং স্বচ্ছ সেবা নিশ্চিত করতে আমরা একটি সুস্পষ্ট রিফান্ড নীতিমালা অনুসরণ করি।</p><h2><span style=\"font-size: 18px;\"><b>রিফান্ডের যোগ্যতা</b></span></h2><p class=\"isSelectedEnd\">কোনো কোর্স বা সেবার জন্য পেমেন্ট করার পর রিফান্ডের আবেদন করতে হলে নির্ধারিত সময়সীমার মধ্যে আবেদন করতে হবে। কোর্সের ধরন ও ব্যবহারের উপর ভিত্তি করে রিফান্ডের যোগ্যতা নির্ধারণ করা হবে।</p><h2><b><span style=\"font-size: 18px;\">রিফান্ডের শর্ত</span></b></h2><p class=\"isSelectedEnd\">কোর্সের উল্লেখযোগ্য অংশ সম্পন্ন করা হলে বা কোর্সের শিক্ষামূলক উপকরণ ব্যাপকভাবে ব্যবহার করা হলে রিফান্ড প্রযোজ্য নাও হতে পারে। বিশেষ অফার বা ডিসকাউন্টের আওতায় নেওয়া কিছু কোর্সের ক্ষেত্রে আলাদা রিফান্ড শর্ত প্রযোজ্য হতে পারে।</p><h2><b><span style=\"font-size: 18px;\">রিফান্ডের আবেদন</span></b></h2><p class=\"isSelectedEnd\">রিফান্ডের জন্য আমাদের নির্ধারিত যোগাযোগ মাধ্যমের মাধ্যমে আবেদন করতে হবে। আবেদনের সময় অর্ডার বা পেমেন্টের প্রয়োজনীয় তথ্য প্রদান করতে হতে পারে।</p><h2><b><span style=\"font-size: 18px;\">রিফান্ড প্রক্রিয়া</span></b></h2><p class=\"isSelectedEnd\">রিফান্ডের আবেদন পর্যালোচনা ও অনুমোদনের পর প্রযোজ্য পেমেন্ট পদ্ধতির মাধ্যমে অর্থ ফেরত দেওয়া হবে। ব্যাংক বা পেমেন্ট প্রদানকারীর কারণে অর্থ ফেরত পেতে অতিরিক্ত সময় লাগতে পারে।</p><h2><b><span style=\"font-size: 18px;\">নন-রিফান্ডেবল সেবা</span></b></h2><p class=\"isSelectedEnd\">যেসব কোর্স বা সেবা স্পষ্টভাবে <strong>Non-Refundable</strong> হিসেবে উল্লেখ করা হয়েছে, সেগুলোর ক্ষেত্রে কোনো রিফান্ড প্রদান করা হবে না।</p><h2><span style=\"font-size: 18px;\"><b>নীতিমালার পরিবর্তন</b></span></h2><p class=\"isSelectedEnd\"><strong>Coradius IT Center</strong> প্রয়োজন অনুযায়ী এই রিফান্ড নীতিমালা পরিবর্তন বা আপডেট করার অধিকার সংরক্ষণ করে। যেকোনো পরিবর্তন এই পৃষ্ঠায় প্রকাশ করা হবে।</p><h2><span style=\"font-size: 18px;\"><b>যোগাযোগ</b></span></h2><p>রিফান্ড সংক্রান্ত কোনো প্রশ্ন বা সহায়তার প্রয়োজন হলে <strong>Coradius IT Center</strong>-এর সাথে যোগাযোগ করুন।</p>','Meta Title','','','2026-09-12 23:02:27','2026-09-13 13:24:22'),(7,103,'en','Help And Support','If you have any questions or need assistance, our support team is available 24/7 to help you resolve any issues you might encounter.','Meta Title',NULL,NULL,'2026-09-12 23:02:27','2026-09-12 23:02:27');
/*!40000 ALTER TABLE `page_languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_image_id` bigint unsigned DEFAULT NULL,
  `meta_image` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1=Active, 0=Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=501 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (100,'Privacy Policy','<p class=\"isSelectedEnd\"><strong>Coradius IT Center</strong> আপনার গোপনীয়তা এবং ব্যক্তিগত তথ্যের নিরাপত্তাকে অত্যন্ত গুরুত্ব দেয়। আমাদের ওয়েবসাইট ব্যবহার করার সময় আপনি যে তথ্য প্রদান করেন, তা নিরাপদ রাখা এবং দায়িত্বশীলভাবে ব্যবহার করা আমাদের অঙ্গীকার।</p><h2><span style=\"font-size: 18px;\"><b>আমরা যে তথ্য সংগ্রহ করি</b></span></h2><p class=\"isSelectedEnd\">আপনি যখন আমাদের ওয়েবসাইট ব্যবহার করেন, রেজিস্ট্রেশন করেন, কোর্সে ভর্তি হন বা আমাদের সাথে যোগাযোগ করেন, তখন আপনার নাম, ই-মেইল ঠিকানা, ফোন নম্বর এবং প্রয়োজনীয় অন্যান্য তথ্য সংগ্রহ করা হতে পারে।</p><h2><span style=\"font-size: 18px;\"><b>তথ্য ব্যবহারের উদ্দেশ্য</b></span></h2><p class=\"isSelectedEnd\">সংগৃহীত তথ্য আপনার অ্যাকাউন্ট পরিচালনা, কোর্স ও সেবা প্রদান, আপনার প্রশ্নের উত্তর দেওয়া, গুরুত্বপূর্ণ আপডেট জানানো এবং আমাদের সেবার মান উন্নত করার জন্য ব্যবহার করা হয়।</p><h2><span style=\"font-size: 18px;\"><b>তথ্যের নিরাপত্তা</b></span></h2><p class=\"isSelectedEnd\">আপনার ব্যক্তিগত তথ্যকে অননুমোদিত ব্যবহার, পরিবর্তন, প্রকাশ বা ক্ষতি থেকে সুরক্ষিত রাখতে আমরা যথাযথ নিরাপত্তা ব্যবস্থা গ্রহণ করি।</p><h2><span style=\"font-size: 18px;\"><b>তৃতীয় পক্ষের সাথে তথ্য শেয়ার</b></span></h2><p class=\"isSelectedEnd\">আপনার ব্যক্তিগত তথ্য আপনার অনুমতি ছাড়া বিক্রি বা অপ্রয়োজনীয়ভাবে তৃতীয় পক্ষের কাছে প্রকাশ করা হয় না। তবে আইনগত প্রয়োজন বা আমাদের সেবা পরিচালনার জন্য প্রয়োজন হলে নির্দিষ্ট তথ্য অনুমোদিত পক্ষের সাথে শেয়ার করা হতে পারে।</p><h2><span style=\"font-size: 18px;\"><b>কুকিজ</b></span></h2><p class=\"isSelectedEnd\">আমাদের ওয়েবসাইট ব্যবহারকারীর অভিজ্ঞতা উন্নত করতে এবং ওয়েবসাইটের কার্যক্রম বিশ্লেষণ করতে কুকিজ বা অনুরূপ প্রযুক্তি ব্যবহার করতে পারে।</p><h2><span style=\"font-size: 18px;\"><b>নীতিমালার পরিবর্তন</b></span></h2><p class=\"isSelectedEnd\">প্রয়োজনে আমরা এই গোপনীয়তা নীতিতে পরিবর্তন আনতে পারি। যেকোনো পরিবর্তন এই পৃষ্ঠায় প্রকাশ করা হবে।</p><h2><span style=\"font-size: 18px;\"><b>যোগাযোগ</b></span></h2><p>আমাদের গোপনীয়তা নীতি সম্পর্কে কোনো প্রশ্ন বা উদ্বেগ থাকলে <strong>Coradius IT Center</strong>-এর সাথে যোগাযোগ করুন।</p>','error_page_404','privacy-policy',NULL,NULL,'Meta Title','','',NULL,NULL,1,'2026-09-12 23:02:27','2026-09-13 13:19:40'),(101,'Terms And Conditions','<p class=\"isSelectedEnd\"><strong>Coradius IT Center</strong>-এর ওয়েবসাইট ও সেবাসমূহ ব্যবহার করার আগে অনুগ্রহ করে নিচের শর্তাবলি পড়ুন। আমাদের ওয়েবসাইট ব্যবহার বা আমাদের কোনো সেবা গ্রহণ করার মাধ্যমে আপনি এই শর্তাবলিতে সম্মত হচ্ছেন।</p><h2><span style=\"font-size: 18px;\"><b>ওয়েবসাইট ব্যবহার</b></span></h2><p class=\"isSelectedEnd\">এই ওয়েবসাইটের সকল কনটেন্ট, তথ্য, ছবি, লেখা এবং অন্যান্য উপকরণ শুধুমাত্র তথ্য ও শিক্ষামূলক উদ্দেশ্যে প্রদান করা হয়। ব্যবহারকারীকে ওয়েবসাইটটি বৈধ ও দায়িত্বশীলভাবে ব্যবহার করতে হবে।</p><h2><span style=\"font-size: 18px;\"><b>অ্যাকাউন্ট ও তথ্য</b></span></h2><p class=\"isSelectedEnd\">ওয়েবসাইটে অ্যাকাউন্ট তৈরি করার ক্ষেত্রে আপনাকে সঠিক ও সম্পূর্ণ তথ্য প্রদান করতে হবে। আপনার অ্যাকাউন্টের তথ্য এবং লগইন নিরাপত্তা বজায় রাখার দায়িত্ব আপনার নিজের।</p><h2><span style=\"font-size: 18px;\"><b>কোর্স ও সেবা</b></span></h2><p class=\"isSelectedEnd\">আমাদের কোর্স, প্রশিক্ষণ এবং অন্যান্য সেবার তথ্য সময়ে সময়ে পরিবর্তিত হতে পারে। <strong>Coradius IT Center</strong> প্রয়োজনে কোনো কোর্স, মূল্য, সময়সূচি বা সেবার বৈশিষ্ট্য পরিবর্তন বা আপডেট করার অধিকার সংরক্ষণ করে।</p><h2><span style=\"font-size: 18px;\"><b>পেমেন্ট ও রিফান্ড</b></span></h2><p class=\"isSelectedEnd\">কোনো পেইড কোর্স বা সেবা গ্রহণের ক্ষেত্রে নির্ধারিত মূল্য পরিশোধ করতে হবে। রিফান্ড বা বাতিলের ক্ষেত্রে সংশ্লিষ্ট কোর্স বা সেবার নির্ধারিত নীতিমালা প্রযোজ্য হবে।</p><h2><span style=\"font-size: 18px;\"><b>ব্যবহারকারীর দায়িত্ব</b></span></h2><p class=\"isSelectedEnd\">ওয়েবসাইট ব্যবহার করার সময় কোনো বেআইনি কার্যক্রম, প্রতারণামূলক কাজ, অন্যের অ্যাকাউন্টে অননুমোদিত প্রবেশ বা ওয়েবসাইটের স্বাভাবিক কার্যক্রম ব্যাহত করে এমন কোনো কাজ করা যাবে না।</p><h2><span style=\"font-size: 18px;\"><b>কনটেন্টের মালিকানা</b></span></h2><p class=\"isSelectedEnd\">এই ওয়েবসাইটে প্রকাশিত লেখা, ছবি, গ্রাফিক্স, লোগো, ভিডিও এবং অন্যান্য কনটেন্ট <strong>Coradius IT Center</strong> অথবা সংশ্লিষ্ট মালিকের সম্পত্তি। অনুমতি ছাড়া এগুলো কপি, পুনঃপ্রকাশ, বিতরণ বা বাণিজ্যিকভাবে ব্যবহার করা যাবে না।</p><h2><span style=\"font-size: 18px;\"><b>দায়বদ্ধতার সীমাবদ্ধতা</b></span></h2><p class=\"isSelectedEnd\">ওয়েবসাইটের তথ্য যথাসম্ভব সঠিক রাখার চেষ্টা করা হলেও কোনো তথ্য সব সময় সম্পূর্ণ, নির্ভুল বা হালনাগাদ থাকবে—এমন নিশ্চয়তা দেওয়া হয় না। ওয়েবসাইট ব্যবহারের ফলে কোনো প্রত্যক্ষ বা পরোক্ষ ক্ষতির জন্য প্রযোজ্য আইন অনুযায়ী আমাদের দায়বদ্ধতা সীমিত থাকবে।</p><h2><span style=\"font-size: 18px;\"><b>শর্তাবলির পরিবর্তন</b></span></h2><p class=\"isSelectedEnd\"><strong>Coradius IT Center</strong> প্রয়োজন অনুযায়ী যেকোনো সময় এই শর্তাবলি পরিবর্তন বা আপডেট করতে পারে। পরিবর্তিত শর্তাবলি এই পৃষ্ঠায় প্রকাশ করার পর তা কার্যকর হবে।</p><h2><span style=\"font-size: 18px;\"><b>যোগাযোগ</b></span></h2><p>এই শর্তাবলি সম্পর্কে কোনো প্রশ্ন বা পরামর্শ থাকলে <strong>Coradius IT Center</strong>-এর সাথে যোগাযোগ করুন।</p>','error_page_403','terms-and-conditions',NULL,NULL,'Meta Title','','',NULL,NULL,1,'2026-09-12 23:02:27','2026-09-13 13:22:11'),(102,'Refund Policy','<p class=\"isSelectedEnd\"><span>﻿</span><strong>Coradius IT Center</strong>-এ শিক্ষার্থীদের সন্তুষ্টি এবং স্বচ্ছ সেবা নিশ্চিত করতে আমরা একটি সুস্পষ্ট রিফান্ড নীতিমালা অনুসরণ করি।</p><h2><span style=\"font-size: 18px;\"><b>রিফান্ডের যোগ্যতা</b></span></h2><p class=\"isSelectedEnd\">কোনো কোর্স বা সেবার জন্য পেমেন্ট করার পর রিফান্ডের আবেদন করতে হলে নির্ধারিত সময়সীমার মধ্যে আবেদন করতে হবে। কোর্সের ধরন ও ব্যবহারের উপর ভিত্তি করে রিফান্ডের যোগ্যতা নির্ধারণ করা হবে।</p><h2><b><span style=\"font-size: 18px;\">রিফান্ডের শর্ত</span></b></h2><p class=\"isSelectedEnd\">কোর্সের উল্লেখযোগ্য অংশ সম্পন্ন করা হলে বা কোর্সের শিক্ষামূলক উপকরণ ব্যাপকভাবে ব্যবহার করা হলে রিফান্ড প্রযোজ্য নাও হতে পারে। বিশেষ অফার বা ডিসকাউন্টের আওতায় নেওয়া কিছু কোর্সের ক্ষেত্রে আলাদা রিফান্ড শর্ত প্রযোজ্য হতে পারে।</p><h2><b><span style=\"font-size: 18px;\">রিফান্ডের আবেদন</span></b></h2><p class=\"isSelectedEnd\">রিফান্ডের জন্য আমাদের নির্ধারিত যোগাযোগ মাধ্যমের মাধ্যমে আবেদন করতে হবে। আবেদনের সময় অর্ডার বা পেমেন্টের প্রয়োজনীয় তথ্য প্রদান করতে হতে পারে।</p><h2><b><span style=\"font-size: 18px;\">রিফান্ড প্রক্রিয়া</span></b></h2><p class=\"isSelectedEnd\">রিফান্ডের আবেদন পর্যালোচনা ও অনুমোদনের পর প্রযোজ্য পেমেন্ট পদ্ধতির মাধ্যমে অর্থ ফেরত দেওয়া হবে। ব্যাংক বা পেমেন্ট প্রদানকারীর কারণে অর্থ ফেরত পেতে অতিরিক্ত সময় লাগতে পারে।</p><h2><b><span style=\"font-size: 18px;\">নন-রিফান্ডেবল সেবা</span></b></h2><p class=\"isSelectedEnd\">যেসব কোর্স বা সেবা স্পষ্টভাবে <strong>Non-Refundable</strong> হিসেবে উল্লেখ করা হয়েছে, সেগুলোর ক্ষেত্রে কোনো রিফান্ড প্রদান করা হবে না।</p><h2><span style=\"font-size: 18px;\"><b>নীতিমালার পরিবর্তন</b></span></h2><p class=\"isSelectedEnd\"><strong>Coradius IT Center</strong> প্রয়োজন অনুযায়ী এই রিফান্ড নীতিমালা পরিবর্তন বা আপডেট করার অধিকার সংরক্ষণ করে। যেকোনো পরিবর্তন এই পৃষ্ঠায় প্রকাশ করা হবে।</p><h2><span style=\"font-size: 18px;\"><b>যোগাযোগ</b></span></h2><p>রিফান্ড সংক্রান্ত কোনো প্রশ্ন বা সহায়তার প্রয়োজন হলে <strong>Coradius IT Center</strong>-এর সাথে যোগাযোগ করুন।</p>','error_page_500','refund-policy',NULL,NULL,'Meta Title','','',NULL,NULL,1,'2026-09-12 23:02:27','2026-09-13 13:24:22'),(103,'Help And Support','If you have any questions or need assistance, our support team is available 24/7 to help you resolve any issues you might encounter.','error_page_500','#',NULL,NULL,'Meta Title',NULL,NULL,NULL,NULL,1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(403,'Permission Denied.','You do not have permission to access this resource. If you believe this is an error, please contact support.','error_page_403','#',NULL,NULL,'Permission Denied','Permission Denied, 403','You do not have permission to access this page.',NULL,NULL,1,'2026-09-12 23:02:22','2026-09-12 23:02:22'),(404,'Page Not Found.','The page you are looking for might have been removed, had its name changed, or is temporarily unavailable. Please return to the homepage.','error_page_404','#',NULL,NULL,'Page not found','not found, 404','The requested page could not be found.',NULL,NULL,1,'2026-09-12 23:02:22','2026-09-12 23:02:22'),(500,'Internal Server Error.','An unexpected condition was encountered by the server that prevented it from fulfilling the request. We are working to resolve it.','error_page_500','#',NULL,NULL,'Internal Server Error','Server Error, 500','An internal server error occurred.',NULL,NULL,1,'2026-09-12 23:02:22','2026-09-12 23:02:22');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_requests`
--

DROP TABLE IF EXISTS `password_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_requests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `otp` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_requests`
--

LOCK TABLES `password_requests` WRITE;
/*!40000 ALTER TABLE `password_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
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
-- Table structure for table `payment_methods`
--

DROP TABLE IF EXISTS `payment_methods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment_methods` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `trx_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_token` text COLLATE utf8mb4_unicode_ci,
  `guest_id` tinyint NOT NULL DEFAULT '0',
  `amount` double NOT NULL DEFAULT '0',
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_methods`
--

LOCK TABLES `payment_methods` WRITE;
/*!40000 ALTER TABLE `payment_methods` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment_methods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payouts`
--

DROP TABLE IF EXISTS `payouts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payouts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `organization_id` bigint unsigned DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_country_id` bigint unsigned DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_type` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_id` bigint unsigned DEFAULT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payout_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=pending, 1=approved, 2="completed, 3=declined',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payouts`
--

LOCK TABLES `payouts` WRITE;
/*!40000 ALTER TABLE `payouts` DISABLE KEYS */;
/*!40000 ALTER TABLE `payouts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(151) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attribute` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keywords` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'roles','roles','{\"view\":\"roles.index\",\"create\":\"roles.create\",\"edit\":\"roles.edit\",\"delete\":\"roles.destroy\"}','2026-09-12 23:02:20','2026-09-12 23:02:20'),(3,'blog categories','blog_categories','{\"view\":\"blog-categories.index\",\"create\":\"blog-categories.create\",\"edit\":\"blog-categories.edit\",\"delete\":\"blog-categories.destroy\"}','2026-09-12 23:02:20','2026-09-12 23:02:20'),(4,'cities','cities','{\"create\":\"cities.create\",\"edit\":\"cities.edit\",\"delete\":\"cities.destroy\",\"view\":\"cities.index\"}','2026-09-12 23:02:20','2026-09-12 23:02:24'),(5,'contacts','contacts','{\"create\":\"contacts.create\",\"edit\":\"contacts.edit\",\"delete\":\"contacts.destroy\"}','2026-09-12 23:02:20','2026-09-12 23:02:20'),(6,'coupons','coupons','{\"view\":\"coupons.index\",\"create\":\"coupons.create\",\"delete\":\"coupons.destroy\",\"edit\":\"coupons.edit\"}','2026-09-12 23:02:20','2026-09-12 23:02:24'),(7,'languages','languages','{\"view\":\"languages.index\",\"create\":\"languages.create\",\"edit\":\"languages.edit\",\"delete\":\"languages.destroy\",\"languages update\":\"languages.update\",\"language translations\":\"language.translations.page\",\"update Trans\":\"admin.language.key.update\"}','2026-09-12 23:02:20','2026-09-12 23:02:20'),(8,'services','services','{\"create\":\"services.create\",\"edit\":\"services.edit\",\"delete\":\"services.destroy\"}','2026-09-12 23:02:20','2026-09-12 23:02:20'),(9,'stats','stats','{\"create\":\"stats.create\",\"edit\":\"stats.edit\",\"delete\":\"stats.destroy\"}','2026-09-12 23:02:20','2026-09-12 23:02:20'),(10,'Staff','Staff','{\"create\":\"staffs.create\",\"view\":\"staffs.index\",\"edit\":\"staffs.edit\",\"delete\":\"staffs.delete\"}','2026-09-12 23:02:20','2026-09-12 23:02:24'),(11,'organizations','organizations','{\"view\":\"organizations.index\",\"show\":\"organizations.show\",\"create\":\"organizations.create\",\"overview\":\"organizations.overview\",\"payment\":\"organizations.payment\",\"settings\":\"organizations.settings\",\"courses\":\"courses.organization\",\"instructors\":\"instructors.organization\",\"payouts\":\"organizations.payouts.method-setting-update\",\"delete\":\"organizations.delete\",\"staff\":\"organizations.staff.index\"}','2026-09-12 23:02:20','2026-09-12 23:02:24'),(12,'pages','pages','{\"view\":\"pages.index\",\"create\":\"pages.create\",\"edit\":\"pages.edit\",\"delete\":\"pages.destroy\"}','2026-09-12 23:02:20','2026-09-12 23:02:24'),(13,'courses','courses','{\"view\":\"courses.index\",\"create\":\"courses.create\",\"published\":\"course.publish\",\"edit\":\"courses.edit\",\"delete\":\"courses.destroy\",\"course students\":\"course.students\",\"course statistics\":\"course.statistics\"}','2026-09-12 23:02:20','2026-09-12 23:02:24'),(14,'levels','levels','{\"view\":\"level.index\",\"create\":\"level.create\",\"edit\":\"level.edit\",\"delete\":\"level.destroy\"}','2026-09-12 23:02:20','2026-09-12 23:02:24'),(15,'tags','tags','{\"view\":\"tag.index\",\"create\":\"tag.create\",\"edit\":\"tag.edit\",\"delete\":\"tag.destroy\"}','2026-09-12 23:02:20','2026-09-12 23:02:24'),(16,'AI','AI','{\"view\":\"ai.writer\"}','2026-09-12 23:02:20','2026-09-12 23:02:20'),(17,'category','category','{\"create\":\"category.create\",\"edit\":\"category.edit\",\"delete\":\"category.destroy\",\"view\":\"category.index\"}','2026-09-12 23:02:20','2026-09-12 23:02:24'),(18,'subjects','subjects','{\"create\":\"subjects.create\",\"edit\":\"subjects.edit\",\"delete\":\"subjects.destroy\",\"view\":\"subjects.index\"}','2026-09-12 23:02:20','2026-09-12 23:02:24'),(19,'sections','sections','{\"create\":\"sections.create\",\"edit\":\"sections.edit\",\"delete\":\"sections.destroy\",\"sections order\":\"course.sections.order\"}','2026-09-12 23:02:20','2026-09-12 23:02:20'),(20,'lessons','lessons','{\"create\":\"lessons.create\",\"edit\":\"lessons.edit\",\"delete\":\"lessons.destroy\",\"lessons order\":\"section.lessons.order\"}','2026-09-12 23:02:20','2026-09-12 23:02:20'),(21,'faqs','faqs','{\"create\":\"faqs.create\",\"edit\":\"faqs.edit\",\"delete\":\"faqs.destroy\",\"view\":\"faqs.index\"}','2026-09-12 23:02:20','2026-09-12 23:02:24'),(22,'assignments','assignments','{\"create\":\"assignments.create\",\"edit\":\"assignments.edit\",\"delete\":\"assignments.destroy\",\"view\":\"assignments.index\"}','2026-09-12 23:02:20','2026-09-12 23:02:24'),(23,'quizzes','quizzes','{\"create\":\"quizzes.create\",\"edit\":\"quizzes.edit\",\"delete\":\"quizzes.destroy\",\"view\":\"quiz.index\"}','2026-09-12 23:02:20','2026-09-12 23:02:24'),(24,'quiz-questions','quiz-questions','{\"create\":\"quiz-questions.create\",\"edit\":\"quiz-questions.edit\",\"delete\":\"quiz-questions.destroy\",\"view\":\"quiz-questions.index\"}','2026-09-12 23:02:20','2026-09-12 23:02:24'),(26,'expertise','expertise','{\"create\":\"expertise.create\",\"edit\":\"expertise.edit\",\"delete\":\"expertise.destroy\",\"view\":\"expertise.index\"}','2026-09-12 23:02:20','2026-09-12 23:02:24'),(27,'instructor','instructor','{\"view\":\"instructors.index\",\"create\":\"instructors.create\",\"edit\":\"instructors.edit\",\"show\":\"instructors.show\",\"delete\":\"users.destroy\"}','2026-09-12 23:02:20','2026-09-12 23:02:24'),(29,'students','students','{\"view\":\"students.index\",\"create\":\"students.create\",\"edit\":\"students.edit\",\"profile\":\"students.show\",\"enrolled courses\":\"students.courses\",\"certificates\":\"students.certificates\",\"payment history\":\"students.payments\",\"login history\":\"students.activity.logs\"}','2026-09-12 23:02:20','2026-09-12 23:02:24'),(30,'blogs','blogs','{\"view\":\"blogs.index\",\"create\":\"blogs.create\",\"edit\":\"blogs.edit\",\"delete\":\"blogs.destroy\"}','2026-09-12 23:02:20','2026-09-12 23:02:20'),(31,'On Board','On Board','{\"view\":\"onboards.index\",\"create\":\"onboards.create\",\"edit\":\"onboards.edit\",\"delete\":\"onboards.destroy\"}','2026-09-12 23:02:20','2026-09-12 23:02:20'),(32,'Api key','Api key','{\"view\":\"apikeys.index\",\"create\":\"apikeys.create\",\"edit\":\"apikeys.edit\",\"revoke\":\"apikeys.revoke\"}','2026-09-12 23:02:20','2026-09-12 23:02:24'),(33,'mobile App','mobile App','{\"android\":\"android.setting\",\"ios\":\"ios.setting\",\"mobile home screen\":\"mobile.home.screen\",\"gdpr\":\"mobile.gdpr\"}','2026-09-12 23:02:20','2026-09-12 23:02:24'),(34,'slider','slider','{\"view\":\"sliders.index\",\"create\":\"sliders.create\",\"edit\":\"sliders.edit\",\"delete\":\"sliders.destroy\"}','2026-09-12 23:02:20','2026-09-12 23:02:20'),(35,'email','email','{\"server configuration\":\"email.server-configuration\",\"email template\":\"email.template\",\"update server configuration\":\"email.server-configuration.edit\",\"update template\":\"auth-template.edit\"}','2026-09-12 23:02:20','2026-09-12 23:02:24'),(36,'media library','media library','{\"media\":\"media-library.index\",\"delete-media\":\"media.destroy\",\"add media\":\"media-library.create\"}','2026-09-12 23:02:20','2026-09-12 23:02:24'),(38,'system setting','system setting','{\"general Setting\":\"general.setting\",\"cache setting\":\"admin.cache\",\"preferences setting\":\"preference\",\"admin panel setting\":\"admin.panel-setting\",\"storage\":\"storage.setting\",\"miscellaneous\":\"miscellaneous.setting\",\"ai writer setting\":\"ai_writer.setting\",\"refund setting\":\"admin.refund\"}','2026-09-12 23:02:20','2026-09-12 23:02:24'),(39,'currencies','currencies','{\"view\":\"currencies.index\",\"create\":\"currencies.create\",\"edit\":\"currencies.edit\",\"delete\":\"currencies.destroy\",\"default currency\":\"currencies.default-currency\",\"set currency format\":\"set.currency.format\",\"system update\":\"system.edit\"}','2026-09-12 23:02:20','2026-09-12 23:02:24'),(50,'payment methods','payment methods','{\"payouts method setting\":\"payouts.method-setting\",\"payment Gateways\":\"payment.gateway\"}','2026-09-12 23:02:20','2026-09-12 23:02:20'),(51,'Notification','Notification','{\"pusher notification\":\"pusher.notification\",\"one signal notification\":\"onesignal.notification\"}','2026-09-12 23:02:20','2026-09-12 23:02:20'),(52,'custom-notification','custom-notification','{\"view\":\"custom-notification.index\",\"create\":\"custom-notification.create\",\"delete\":\"custom-notification.destroy\"}','2026-09-12 23:02:20','2026-09-12 23:02:24'),(55,'otp','otp','{\"otp setting\":\"otp.setting\",\"smsTemplates\":\"sms.templates\",\"saveTemplate\":\"save.template\"}','2026-09-12 23:02:20','2026-09-12 23:02:20'),(56,'report','report','{\"book sale\":\"backend.admin.report.book_sale\",\"course-sale\":\"backend.admin.report.course_sale\",\"commission-history\":\"backend.admin.report.commission_history\",\"payment-history\":\"backend.admin.report.payment_history\",\"payout-history\":\"backend.admin.report.payout_history\",\"wishlist\":\"backend.admin.report.wishlist\"}','2026-09-12 23:02:20','2026-09-12 23:02:20'),(57,'website setting','website setting','{\"website themes\":\"website.themes\",\"theme options\":\"theme.options\",\"header content\":\"header.logo\",\"header topbar\":\"header.topbar\",\"header menu\":\"header.menu\",\"hero-section\":\"hero.section\",\"Call to action\":\"website.cta\",\"website popup\":\"website.popup\",\"website-seo\":\"website.seo\",\"custom css\":\"custom.css\",\"custom js\":\"custom.js\",\"instructor content\":\"website.instructor_content\",\"google setup\":\"google.setup\",\"fb pixel\":\"fb.pixel\",\"gdpr\":\"gdpr\",\"firebase\":\"admin.firebase\",\"chat messenger\":\"chat.messenger\",\"home page builder\":\"home.page.builder\"}','2026-09-12 23:02:20','2026-09-12 23:02:26'),(58,'website footer content','website footer content','{\"footer content\":\"footer.social-links\",\"newsletter setting\":\"footer.newsletter-settings\",\"useful link setting\":\"footer.useful-links\",\"resource link setting\":\"footer.resource-links\",\"quick link setting\":\"footer.quick-links\",\"apps link setting\":\"footer.apps-links\",\"payment banner setting\":\"footer.payment-banner-settings\",\"copyright setting\":\"footer.copyright\"}','2026-09-12 23:02:20','2026-09-12 23:02:26'),(64,'success story','success story','{\"view\":\"success-stories.index\",\"create\":\"success-stories.create\",\"edit\":\"success-stories.edit\",\"delete\":\"success-stories.destroy\"}','2026-09-12 23:02:20','2026-09-12 23:02:20'),(65,'testimonials','testimonials','{\"view\":\"testimonials.index\",\"create\":\"testimonials.create\",\"edit\":\"testimonials.edit\",\"delete\":\"testimonials.destroy\"}','2026-09-12 23:02:20','2026-09-12 23:02:20'),(66,'brand','brand','{\"view\":\"brands.index\",\"create\":\"brands.create\",\"edit\":\"brands.edit\",\"delete\":\"brands.destroy\"}','2026-09-12 23:02:21','2026-09-12 23:02:21'),(67,'subscribers','subscribers','{\"view\":\"subscribers.index\",\"create\":\"subscribers.create\",\"delete\":\"subscribers.destroy\"}','2026-09-12 23:02:21','2026-09-12 23:02:21'),(68,'bulk sms','bulk sms','{\"bulk sms\":\"bulk.sms\"}','2026-09-12 23:02:21','2026-09-12 23:02:21'),(71,'Support System','Support System','{\"view\":\"tickets.index\",\"create\":\"tickets.create\",\"ticket reply\":\"ticket.reply\",\"ticket reply edit\":\"ticket.reply.edit\",\"ticket-reply-delete\":\"ticket.reply.delete\"}','2026-09-12 23:02:21','2026-09-12 23:02:24'),(72,'departments','departments','{\"view\":\"departments.index\",\"create\":\"departments.create\",\"edit\":\"departments.edit\",\"delete\":\"departments.destroy\"}','2026-09-12 23:02:21','2026-09-12 23:02:21'),(73,'packages','packages','{\"create\":\"packages.create\",\"edit\":\"packages.edit\",\"delete\":\"packages.destroy\",\"packages-subscribe\":\"packages.subscribe\",\"view\":\"packages.index\"}','2026-09-12 23:02:21','2026-09-12 23:02:24'),(79,'payouts','payouts','{\"view\":\"payouts.index\",\"create\":\"payouts.create\",\"edit\":\"payouts.edit\",\"delete\":\"payouts.destroy\",\"payouts method setting\":\"payouts.method-setting\",\"payouts method setting update\":\"payouts.method-setting-update\"}','2026-09-12 23:02:21','2026-09-12 23:02:24'),(80,'categories','categories','{\"view category\":\"categories.index\",\"create\":\"categories.create\",\"edit\":\"categories.edit\",\"delete\":\"categories.destroy\"}','2026-09-12 23:02:21','2026-09-12 23:02:21'),(81,'expertises','expertises','{\"view\":\"expertise.index\",\"create\":\"expertises.create\",\"edit\":\"expertises.edit\",\"delete\":\"expertises.destroy\"}','2026-09-12 23:02:21','2026-09-12 23:02:21'),(82,'dashboard','dashboard','{\"dashboard\":\"admin.dashboard\",\"dashboard statistics\":\"dashboard_statistic\",\"total enrolment\":\"view_enrolment_statistic\",\"total earning\":\"view_total_earning\",\"total organization\":\"view_total_organization\",\"total Course\":\"view_total_course\",\"new student count\":\"new_student_count\",\"new course count\":\"view_new_course_count\",\"total sale statistic\":\"total_sale_statistic\",\"total student statistic\":\"total_student_statistic\",\"recent payout list\":\"recent_payout_list\",\"best selling course list\":\"best_selling_course_list\",\"best instructor list\":\"best_instructor_list\",\"manpower information\":\"view_manpower_information\",\"sale information\":\"sale_information\",\"earning statistic\":\"view_earning_statistic\",\"total instructor statistic\":\"total_instructor_statistic\"}','2026-09-12 23:02:21','2026-09-12 23:02:24'),(83,'addons','addons','{\"view\":\"addon.index\",\"install\":\"addon.create\",\"edit\":\"addon.edit\"}','2026-09-12 23:02:21','2026-09-12 23:02:24'),(84,'organization-panel','organization-panel','{\"manage course\":\"manage_course\",\"manage student\":\"manage_student\",\"manage instructor\":\"manage_instructor\",\"manage staff\":\"manage_staff\",\"manage certificate\":\"mnage_certificate\",\"manage statement\":\"manage_statement\",\"manage finance\":\"finance\"}','2026-09-12 23:02:21','2026-09-12 23:02:21'),(85,'utility','utility','{\"server information\":\"server.info\",\"system info\":\"system.info\",\"extension-library\":\"extension.library\",\"file-system-permission\":\"file.system.permission\",\"system update\":\"system.edit\"}','2026-09-12 23:02:21','2026-09-12 23:02:24'),(86,'Certificates','certificates','{\"view\":\"certificates.index\",\"edit\":\"certificates.edit\"}','2026-09-12 23:02:24','2026-09-12 23:02:24'),(87,'Payment Gateway','payment gateway','{\"update\":\"payment.gateway\"}','2026-09-12 23:02:24','2026-09-12 23:02:24'),(88,'Wallet Request','wallet request','{\"view\":\"wallet.request\",\"change status\":\"wallet.status.change\"}','2026-09-12 23:02:24','2026-09-12 23:02:24'),(89,'Student Faqs','student faqs','{\"view\":\"student-faqs.index\",\"create\":\"student-faqs.create\",\"edit\":\"student-faqs.edit\",\"delete\":\"student-faqs.destroy\"}','2026-09-12 23:02:24','2026-09-12 23:02:24'),(90,'Offline Payment','offline payment','{\"view\":\"offline-methods.index\",\"create\":\"offline-methods.create\",\"edit\":\"offline-methods.edit\",\"delete\":\"offline-methods.destroy\"}','2026-09-12 23:02:24','2026-09-12 23:02:24'),(91,'Country','country','{\"view\":\"countries.index\",\"create\":\"countries.create\",\"edit\":\"countries.edit\",\"delete\":\"countries.destroy\"}','2026-09-12 23:02:24','2026-09-12 23:02:24'),(92,'State','state','{\"view\":\"states.index\",\"create\":\"states.create\",\"edit\":\"states.edit\",\"delete\":\"states.destroy\"}','2026-09-12 23:02:24','2026-09-12 23:02:24'),(93,'City','city','{\"view\":\"cities.index\",\"create\":\"cities.create\",\"edit\":\"cities.edit\",\"delete\":\"cities.destroy\"}','2026-09-12 23:02:24','2026-09-12 23:02:24'),(94,'enrollment history','enrollment history','{\"index\":\"admin.enrollments\",\"create\":\"bulk.enrollments\",\"change status\":\"enrollments.status\"}','2026-09-12 23:02:26','2026-09-12 23:02:26');
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
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
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
-- Table structure for table `phone_verifications`
--

DROP TABLE IF EXISTS `phone_verifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phone_verifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0=not verify, 1= verified',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phone_verifications`
--

LOCK TABLES `phone_verifications` WRITE;
/*!40000 ALTER TABLE `phone_verifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `phone_verifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quiz_answers`
--

DROP TABLE IF EXISTS `quiz_answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quiz_answers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `quiz_question_id` bigint unsigned DEFAULT NULL,
  `quiz_id` bigint unsigned DEFAULT NULL,
  `answers` text COLLATE utf8mb4_unicode_ci,
  `correct_answer` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quiz_answers`
--

LOCK TABLES `quiz_answers` WRITE;
/*!40000 ALTER TABLE `quiz_answers` DISABLE KEYS */;
/*!40000 ALTER TABLE `quiz_answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quiz_questions`
--

DROP TABLE IF EXISTS `quiz_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quiz_questions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `quiz_id` bigint unsigned NOT NULL,
  `question_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answers` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quiz_questions`
--

LOCK TABLES `quiz_questions` WRITE;
/*!40000 ALTER TABLE `quiz_questions` DISABLE KEYS */;
INSERT INTO `quiz_questions` VALUES (1,1,'short_question','write down about software development','[]',1,'2026-09-12 23:02:23','2026-09-12 23:02:23'),(2,1,'default','what is software development','[\r\n                    {\'answer\'   : \'fun\', \'is_correct\' : 0,}\r\n                    {\'answer\'   : \'jok\', \'is_correct\' : 0,}\r\n                    {\'answer\'   : \'nothing\', \'is_correct\' : 0,}\r\n                    {\'answer\'   : \'Software development is the process of conceiving\', \'is_correct\' : 1}\r\n                ]',1,'2026-09-12 23:02:23','2026-09-12 23:02:23'),(3,1,'mcq','best tool for software development','[\r\n                    {\'answer\'    : \'windows\', \'is_correct\' : 1,}\r\n                    {\'answer\'    : \'linux\', \'is_correct\' : 1,}\r\n                    {\'answer\'    : \'php storm\', \'is_correct\' : 0,}\r\n                    {\'answer\'    : \'visual code\', \'is_correct\' : 0}\r\n                ]',1,'2026-09-12 23:02:23','2026-09-12 23:02:23');
/*!40000 ALTER TABLE `quiz_questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quizzes`
--

DROP TABLE IF EXISTS `quizzes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quizzes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `section_id` bigint unsigned DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` int NOT NULL COMMENT 'in minutes',
  `total_marks` int NOT NULL DEFAULT '0',
  `pass_marks` int NOT NULL DEFAULT '0',
  `certificate_included` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quizzes`
--

LOCK TABLES `quizzes` WRITE;
/*!40000 ALTER TABLE `quizzes` DISABLE KEYS */;
/*!40000 ALTER TABLE `quizzes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ratings`
--

DROP TABLE IF EXISTS `ratings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ratings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `rating` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `commentable_id` bigint unsigned DEFAULT NULL,
  `commentable_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ratings`
--

LOCK TABLES `ratings` WRITE;
/*!40000 ALTER TABLE `ratings` DISABLE KEYS */;
INSERT INTO `ratings` VALUES (1,4,'5','lines of code with a single click, just like copying and pasting',1,'App\\Models\\Course',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(2,4,'5','lines of code with a single click, just like copying and pasting',1,'App\\Models\\Book',1,'2026-09-12 23:02:27','2026-09-12 23:02:27');
/*!40000 ALTER TABLE `ratings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recent_views`
--

DROP TABLE IF EXISTS `recent_views`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recent_views` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `viewable_id` bigint unsigned DEFAULT NULL,
  `viewable_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recent_views`
--

LOCK TABLES `recent_views` WRITE;
/*!40000 ALTER TABLE `recent_views` DISABLE KEYS */;
/*!40000 ALTER TABLE `recent_views` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `refunds`
--

DROP TABLE IF EXISTS `refunds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `refunds` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `checkout_id` bigint unsigned NOT NULL,
  `refundable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `refundable_id` bigint unsigned NOT NULL,
  `refundable_amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `refunds`
--

LOCK TABLES `refunds` WRITE;
/*!40000 ALTER TABLE `refunds` DISABLE KEYS */;
/*!40000 ALTER TABLE `refunds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resources`
--

DROP TABLE IF EXISTS `resources`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `resources` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint unsigned NOT NULL,
  `section_id` bigint unsigned NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resource_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source_data` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` time DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` text COLLATE utf8mb4_unicode_ci,
  `image_media_id` bigint unsigned DEFAULT NULL,
  `is_free` tinyint NOT NULL DEFAULT '0' COMMENT '1=free, 0=not free',
  `order_no` int NOT NULL DEFAULT '0',
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0 inactive, 1 active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resources`
--

LOCK TABLES `resources` WRITE;
/*!40000 ALTER TABLE `resources` DISABLE KEYS */;
/*!40000 ALTER TABLE `resources` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permissions` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0 inactive, 1 active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Admin','admin','[\"roles.create\",\"roles.edit\",\"roles.destroy\",\"badges.create\",\"badges.edit\",\"badges.destroy\",\"blog-categories.create\",\"blog-categories.edit\",\"blog-categories.destroy\",\"cities.create\",\"cities.edit\",\"cities.destroy\",\"contacts.create\",\"contacts.edit\",\"contacts.destroy\",\"coupons.create\",\"coupons.store\",\"coupons.destroy\",\"languages.create\",\"languages.edit\",\"languages.destroy\",\"languages.update\",\"language.translations.page\",\"admin.language.key.update\",\"services.create\",\"services.edit\",\"services.destroy\",\"stats.create\",\"stats.edit\",\"stats.destroy\",\"staffs.create\",\"staffs.edit\",\"staffs.destroy\",\"organizations.create\",\"organizations.edit\",\"organizations.destroy\",\"organizations.delete\",\"organizations.overview\",\"organizations.payment\",\"organizations.settings\",\"courses.organization\",\"instructors.organization\",\"organizations.payouts.method-setting-update\",\"pages.create\",\"pages.edit\",\"pages.destroy\",\"pages.update\",\"courses.create\",\"courses.edit\",\"courses.destroy\",\"course.students\",\"course.statistics\",\"levels.create\",\"levels.edit\",\"levels.destroy\",\"tags.create\",\"tags.edit\",\"tags.destroy\",\"category.create\",\"category.edit\",\"category.destroy\",\"subjects.create\",\"subjects.edit\",\"subjects.destroy\",\"sections.create\",\"sections.edit\",\"sections.destroy\",\"course.sections.order\",\"lessons.create\",\"lessons.edit\",\"lessons.destroy\",\"section.lessons.order\",\"faqs.create\",\"faqs.create\",\"faqs.edit\",\"faqs.destroy\",\"assignments.create\",\"assignments.edit\",\"assignments.destroy\",\"quizzes.create\",\"quizzes.edit\",\"quizzes.destroy\",\"quiz-questions.create\",\"quiz-questions.edit\",\"quiz-questions.destroy\",\"books.edit\",\"books.destroy\",\"backend.admin.book.index\",\"expertise.create\",\"expertise.edit\",\"expertise.destroy\",\"instructors.create\",\"instructors.edit\",\"instructors.destroy\",\"live-classes.create\",\"live-classes.edit\",\"live-classes.destroy\",\"students.create\",\"students.edit\",\"students.show\",\"students.certificates\",\"students.instructors\",\"students.payments\",\"students.activity.logs\",\"students.load.course\",\"students.load.certificates\",\"blogs.create\",\"blogs.edit\",\"blogs.destroy\",\"onboards.create\",\"onboards.edit\",\"onboards.destroy\",\"apikeys.create\",\"apikeys.edit\",\"apikeys.destroy\",\"android.setting\",\"ios.setting\",\"mobile-settings.update\",\"sliders.create\",\"sliders.edit\",\"sliders.destroy\",\"email.server-configuration\",\"email.server-configuration.update\",\"email.template\",\"auth-template.update\",\"media-library.index\",\"media-library.store\",\"media.destroy\",\"verified\",\"ban\",\"status\",\"delete\",\"media.destroy\",\"general.setting\",\"general.setting-update\",\"currencies.create\",\"currencies.edit\",\"currencies.destroy\",\"currencies.update\",\"currencies.default-currency\",\"set.currency.format\",\"admin.cache\",\"cache.update\",\"admin.firebase\",\"firebase.update\",\"preference\",\"storage.setting\",\"chat.messenger\",\"payment.gateway\",\"pusher.notification\",\"onesignal.notification\",\"custom-notification.create\",\"custom-notification.edit\",\"custom-notification.destroy\",\"admin.panel-setting\",\"admin.panel-setting.update\",\"miscellaneous.setting\",\"admin.miscellaneous.update\",\"otp.setting\",\"sms.templates\",\"save.template\",\"backend.admin.report.book_sale\",\"backend.admin.report.course_sale\",\"backend.admin.report.commission_history\",\"backend.admin.report.payment_history\",\"backend.admin.report.payout_history\",\"backend.admin.report.wishlist\",\"home.page.builder\",\"update.home.page.builder\",\"website.themes\",\"theme.options\",\"header.logo\",\"header.content\",\"header.topbar\",\"header.menu\",\"hero.section\",\"footer.content\",\"footer.social-links\",\"footer.newsletter-settings\",\"footer.useful-links\",\"footer.resource-links\",\"footer.quick-links\",\"footer.apps-links\",\"footer.payment-banner-settings\",\"footer.copyright\",\"footer.update-setting\",\"footer.update-menu\",\"website.popup\",\"website.seo\",\"google.setup\",\"custom.js\",\"custom.css\",\"custom.css.js\",\"fb.pixel\",\"gdpr\",\"success-stories.create\",\"success-stories.edit\",\"success-stories.destroy\",\"testimonials.create\",\"testimonials.edit\",\"testimonials.destroy\",\"brands.create\",\"brands.edit\",\"brands.destroy\",\"subscribers.create\",\"subscribers.destroy\",\"bulk.sms\",\"server.info\",\"system.info\",\"extension.library\",\"file.system.permission\",\"system.update\",\"tickets.create\",\"tickets.update\",\"ticket.reply\",\"ticket.reply.edit\",\"ticket.reply.update\",\"ticket.reply.delete\",\"departments.create\",\"departments.edit\",\"departments.destroy\",\"packages.create\",\"packages.edit\",\"packages.destroy\",\"packages.subscribe\",\"accounts.create\",\"accounts.edit\",\"accounts.destroy\",\"backend.admin.account.transaction_history\",\"income.create\",\"income.edit\",\"income.destroy\",\"expense.create\",\"expense.edit\",\"expense.destroy\",\"transfer.create\",\"transfer.edit\",\"transfer.destroy\",\"deposit.create\",\"deposit.edit\",\"deposit.destroy\",\"payouts.create\",\"payouts.edit\",\"payouts.destroy\",\"payouts.method-setting\",\"payouts.method-setting-update\",\"payouts.complete\",\"payouts.approved\",\"payouts.declined\",\"categories.create\",\"categories.edit\",\"categories.destroy\",\"expertises.create\",\"expertises.edit\",\"expertises.destroy\",\"admin.dashboard\",\"mobile.home.screen\",\"addon.index\",\"addon.create\"]',1,'2026-09-12 23:02:20','2026-09-12 23:02:20'),(2,'Instructor','instructor','[\"instructors.create\",\"instructors.edit\",\"payouts.create\",\"payouts.edit\",\"payouts.destroy\",\"payouts.method-setting\",\"payouts.method-setting-update\",\"students.create\",\"students.show\",\"students.edit\",\"students.certificates\",\"students.instructors\",\"students.payments\",\"students.activity.logs\",\"students.load.course\",\"students.load.certificates\",\"courses.organization\",\"courses.create\",\"courses.destroy\",\"course.students\",\"course.statistics\",\"sections.create\",\"sections.edit\",\"sections.destroy\",\"course.sections.order\",\"lessons.create\",\"lessons.edit\",\"lessons.destroy\",\"section.lessons.order\",\"faqs.create\",\"faqs.create\",\"faqs.edit\",\"faqs.destroy\",\"assignments.create\",\"assignments.edit\",\"assignments.destroy\",\"quizzes.create\",\"quizzes.edit\",\"quizzes.destroy\",\"quiz-questions.create\",\"quiz-questions.edit\",\"quiz-questions.destroy\",\"expertise.create\",\"expertise.edit\",\"expertise.destroy\"]',1,'2026-09-12 23:02:20','2026-09-12 23:02:20'),(3,'Student','student','[]',1,'2026-09-12 23:02:20','2026-09-12 23:02:20'),(4,'Staff','staff','[]',1,'2026-09-12 23:02:20','2026-09-12 23:02:20'),(5,'organization-staff','organization-staff','[]',1,'2026-09-12 23:02:20','2026-09-12 23:02:20');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sections`
--

DROP TABLE IF EXISTS `sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sections` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course_id` bigint unsigned DEFAULT NULL,
  `order_no` int NOT NULL DEFAULT '0',
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0 inactive, 1 active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sections`
--

LOCK TABLES `sections` WRITE;
/*!40000 ALTER TABLE `sections` DISABLE KEYS */;
/*!40000 ALTER TABLE `sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_languages`
--

DROP TABLE IF EXISTS `service_languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service_languages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_languages`
--

LOCK TABLES `service_languages` WRITE;
/*!40000 ALTER TABLE `service_languages` DISABLE KEYS */;
/*!40000 ALTER TABLE `service_languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `services` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `logo` text COLLATE utf8mb4_unicode_ci,
  `service_media_id` bigint unsigned DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0 inactive, 1 active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `lang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0 inactive, 1 active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `settings_title_index` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=218 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'en','system_name','Coradius IT Center',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(2,'en','company_name','\"SpaGreen Creative\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(3,'en','default_language','\"en\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(4,'en','default_currency','\"1\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(5,'en','default_country','\"19\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(6,'en','phone_country_id','\"19\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(7,'en','disable_preloader','\"1\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(8,'en','api_url','\"https://spagreen.net/api\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(9,'en','android_current_version_code','\"1\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(10,'en','android_current_version_name','\"V1.0.0\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(11,'en','android_app_url','\"https://play.google.com/store/apps/details?id=\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(12,'en','android_whats_new','\"Fixes few known bugs.\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(13,'en','android_skippable','\"1\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(14,'en','ios_current_version_code','\"1\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(15,'en','ios_current_version_name','\"V1.0.0\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(16,'en','ios_app_url','\"https://play.google.com/store/apps/details?id=\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(17,'en','ios_whats_new','\"Fixes few known bugs.\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(18,'en','ios_skippable','\"1\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(19,'en','themes','\"1\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(20,'en','header_font','\"jost\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(21,'en','header_font_size','\"28\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(22,'en','body_font','\"poppins\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(23,'en','body_font_size','\"14\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(24,'en','primary_color','\"#0056D2\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(25,'en','secondary_color','\"#FF7A00\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(26,'en','link_color','\"#0056D2\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(27,'en','hover_color','\"#FF7A00\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(28,'en','header','\"header_one\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(29,'en','footer','\"footer_one\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(30,'en','show_social_links','\"1\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(31,'en','facebook_link','\"https:\\/\\/www.facebook.com\\/CoradiusITCenter\"',1,'2026-09-12 23:02:21','2026-09-13 12:43:49'),(32,'en','twitter_link','\"\"',1,'2026-09-12 23:02:21','2026-09-13 12:42:52'),(33,'en','linkedin_link','\"\"',1,'2026-09-12 23:02:21','2026-09-13 12:42:52'),(34,'en','instagram_link','\"https:\\/\\/www.instagram.com\\/coradiusit\"',1,'2026-09-12 23:02:21','2026-09-13 12:43:49'),(35,'en','youtube_link','\"https:\\/\\/www.youtube.com\\/@CoradiusIT\"',1,'2026-09-12 23:02:21','2026-09-13 12:43:49'),(36,'en','newsletter_title','\"\\u09ac\\u09bf\\u09b6\\u09c7\\u09b7 \\u09ab\\u09bf\\u099a\\u09be\\u09b0 \\u09aa\\u09c7\\u09a4\\u09c7 \\u098f\\u0996\\u09a8\\u0987 \\u09b8\\u09be\\u09ac\\u09b8\\u09cd\\u0995\\u09cd\\u09b0\\u09be\\u0987\\u09ac \\u0995\\u09b0\\u09c1\\u09a8\"',1,'2026-09-12 23:02:21','2026-09-13 07:54:22'),(37,'en','show_newsletter','\"1\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(38,'en','show_apps_link','\"1\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(39,'en','apps_link_title','\"Download App\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(40,'en','apps_link_description','\"Download our apps in play store and app store.\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(41,'en','play_store_link','\"#\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(42,'en','app_store_link','\"#\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(43,'en','currency_symbol_format','\"symbol_amount\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(44,'en','decimal_separator','\".\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(45,'en','no_of_decimals','\"2\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(46,'en','live_api_currency','\"0\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(47,'en','useful_link_title','\"Useful Links\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(48,'en','resource_link_title','\"Resources\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(49,'en','quick_link_title','\"Quick Links\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(50,'en','show_copyright','\"1\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(51,'en','copyright_title','\"Copyright @ 2026 All Rights Reserved to Coradius It Center.\"',1,'2026-09-12 23:02:21','2026-09-13 12:50:25'),(52,'en','show_useful_link','\"0\"',1,'2026-09-12 23:02:21','2026-09-13 12:40:41'),(53,'en','show_quick_link','\"1\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(54,'en','show_resource_link','\"1\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(55,'en','show_default_courses_link','\"1\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(56,'en','hero_subtitle','\"#1 Platform for Online Learning\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(57,'en','hero_title','\"Find the best online courses & grow up your skills.\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(58,'en','hero_description','\"Explore new skills beyond the world of knowledge and get lost in freedom of creativity.\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(59,'en','hero_main_action_btn_label','\"Browse All Course\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(60,'en','hero_secondary_action_btn_label','\"Get Started\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(61,'en','hero_main_action_btn_enable','\"1\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(62,'en','hero_secondary_action_btn_enable','\"1\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(63,'en','hero_main_action_btn_url','\"/courses\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(64,'en','secondary_btn_url','\"#\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(65,'en','topbar_phone','\"+088343947469\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(66,'en','topbar_email','\"admin@spagreen.net\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(67,'en','hero_rating_overview','\"1200+ student new enroll\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(68,'en','header2_hero_title1','\"Lilian\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(69,'en','header2_hero_title2','\"Sophia\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(70,'en','header2_hero_title3','\"Parker\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(71,'en','version_code','\"1.0.0\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(72,'en','current_version','\"100\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(73,'en','course_view_percent','\"70\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(74,'en','paginate','\"10\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(75,'en','system_commission','\"20\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(76,'en','theme_color','\"blue\"',1,'2026-09-12 23:02:21','2026-09-12 23:28:17'),(77,'en','coupon_system','\"1\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(78,'en','disable_email_confirmation','\"1\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(79,'en','disable_otp_verification','\"1\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(80,'en','wallet_system','\"1\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(81,'en','header_menu','\"a:4:{i:0;a:3:{s:5:\\\"label\\\";s:4:\\\"Home\\\";s:3:\\\"url\\\";s:1:\\\"\\/\\\";s:9:\\\"mega_menu\\\";s:0:\\\"\\\";}i:1;a:3:{s:5:\\\"label\\\";s:4:\\\"Blog\\\";s:3:\\\"url\\\";s:5:\\\"\\/blog\\\";s:9:\\\"mega_menu\\\";s:0:\\\"\\\";}i:2;a:3:{s:5:\\\"label\\\";s:7:\\\"Courses\\\";s:3:\\\"url\\\";s:8:\\\"\\/courses\\\";s:9:\\\"mega_menu\\\";s:0:\\\"\\\";}i:3;a:3:{s:5:\\\"label\\\";s:10:\\\"Instructor\\\";s:3:\\\"url\\\";s:12:\\\"\\/instructors\\\";s:9:\\\"mega_menu\\\";s:0:\\\"\\\";}}\"',1,'2026-09-12 23:02:21','2026-09-12 23:02:21'),(82,'en','email_address','\"sales@spagreen.net\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(83,'en','phone','\"+8801400620055\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(84,'en','mail_server','\"smtp\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(85,'en','smtp_server_address','\"smtp.elasticemail.com\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(86,'en','smtp_user_name','\"test5@spagreen.net\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(87,'en','smtp_password','\"2C971E6BCCCA9425E4E077DE1EDF582A5348\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(88,'en','smtp_mail_port','\"465\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(89,'en','smtp_encryption_type','\"ssl\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(90,'en','smtp_mail_from_name','\"OvoyLMS\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(91,'en','mail_from_address','\"ovoy@spagreen.net\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(92,'en','mail_signature','\"<p>Thanks</p><p>SpaGreen Creative</p>\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(93,'en','jazz_cash_merchant_id','',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(94,'en','jazz_cash_password','',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(95,'en','stripe_key','\"your_stripe_publishable_key_here\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(96,'en','stripe_secret','\"your_stripe_secret_key_here\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(97,'en','is_stripe_activated','\"1\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(98,'en','payment_method','\"paypal\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(99,'en','paypal_client_id','\"AZxyKxJo_Ogc7jYDellCuEogwYbkFVdIXYGmCajwgbkBe-Wodlls8jplUzZAmXHxxmxhWB9xJq1L79V1\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(100,'en','is_paypal_activated','\"1\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(101,'en','is_uddokta_pay_activated','\"1\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(102,'en','is_uddokta_pay_sandbox_mode_activated','\"1\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(103,'en','uddokta_pay_api_key','\"982d381360a69d419689740d9f2e26ce36fb7a50\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(104,'en','is_mollie_activated','\"1\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(105,'en','mollie_api_key','\"test_NB2BVwR8rekUbtQvenmb9nCvVVRwNJ\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(106,'en','is_skrill_activated','\"1\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(107,'en','skrill_merchant_email','\"demoqco@sun-fish.com\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(108,'en','is_sslcommerz_activated','\"1\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(109,'en','is_sslcommerz_sandbox_mode_activated','\"1\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(110,'en','sslcommerz_id','\"ecomm621c6cee01086\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(111,'en','sslcommerz_password','\"ecomm621c6cee01086@ssl\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(112,'en','is_bkash_activated','\"1\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(113,'en','is_bkash_sandbox_mode_activated','1',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(114,'en','app_key','\"4f6o0cjiki2rfm34kfdadl1eqq\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(115,'en','bkash_app_secret','\"2is7hdktrekvrbljjh44ll3d9l1dtjo4pasmjvs5vl5qr3fug4b\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(116,'en','bkash_username','\"sandboxTokenizedUser02\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(117,'en','bkash_password','\"sandboxTokenizedUser02@12345\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(118,'en','is_amarpay_sandbox_mode_activated','\"1\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(119,'en','is_aamarpay_activated','\"1\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(120,'en','aamrapay_store_id','\"aamarpay\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(121,'en','aamarpay_signature_key','\"28c78bb1f45112f5d40b956fe104645a\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(122,'en','is_razorpay_activated','\"1\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(123,'en','razorpay_key','\"rzp_test_0TxiJynxZFTbwx\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(124,'en','razorpay_secret','\"3WTWGfrzVjwTcVMgzy8phSpJ\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(125,'en','is_paystack_activated','\"1\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(126,'en','paystack_secret_key','\"your_paystack_secret_key_here\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(127,'en','paystack_public_key','\"your_paystack_public_key_here\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(128,'en','is_mercado_pago_activated','\"1\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(129,'en','mercadopago_access_key','\"APP_USR-4488927440113908-102518-53151da33060878333b01bbed7d7b477-577487269\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(130,'en','mercadopago_key','\"APP_USR-d770982e-aa81-4252-8285-326bb273f862\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(131,'en','is_kkiapay_activated','\"1\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(132,'en','is_kkiapay_sandbox_enabled','\"1\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(133,'en','kkiapay_public_api_key','\"3c1d8b50846311ebbaa79fdd109248c0\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(134,'en','kkiapay_private_api_key','\"tpk_3c1d8b52846311ebbaa79fdd109248c0\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(135,'en','kkiapay_secret','\"tsk_3c1db260846311ebbaa79fdd109248c0\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(136,'en','is_mid_trans_activated','\"1\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(137,'en','is_midtrans_sandbox_enabled','\"1\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(138,'en','mid_trans_client_id','\"SB-Mid-client-W37JosxKCA5iS45Q\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(139,'en','mid_trans_server_key','\"SB-Mid-server-KSF0d8bUpgK62_98goRxHTZU\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(140,'en','is_hitpay_sandbox_mode_activated','\"1\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(141,'en','is_hitpay_activated','\"1\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(142,'en','system_commission','\"20\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(143,'en','hitpay_api_key','\"c3272a28ee0dc817ee9c83401eef95e25a5ea4f4d52ded116df56bb9fc12aaec\"',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(144,'en','website_mode','\"single_course\"',1,'2026-09-12 23:28:17','2026-09-12 23:28:17'),(145,'en','single_course_id','\"\"',1,'2026-09-12 23:28:17','2026-09-12 23:28:17'),(146,'en','is_modal','\"0\"',1,'2026-09-13 04:12:17','2026-09-13 04:12:17'),(147,'en','counter_section_status','\"1\"',1,'2026-09-13 04:12:17','2026-09-13 04:12:17'),(148,'en','counter_items','[{\"title\":\"\\u09ae\\u09cb\\u099f \\u0995\\u09cb\\u09b0\\u09cd\\u09b8\",\"count\":\"\\u09e9\\u09eb\\u09e6\\u09e6 +\"},{\"title\":\"\\u09aa\\u09cd\\u09b0\\u09b6\\u09bf\\u0995\\u09cd\\u09b7\\u0995\",\"count\":\"\\u09ef\\u09e6 +\"},{\"title\":\"\\u09b6\\u09bf\\u0995\\u09cd\\u09b7\\u09be\\u09b0\\u09cd\\u09a5\\u09c0\",\"count\":\"\\u09e9\\u09e8\\u09e6\\u09ed +\"},{\"title\":\"\\u09b8\\u09ab\\u09b2 \\u09b6\\u09bf\\u0995\\u09cd\\u09b7\\u09be\\u09b0\\u09cd\\u09a5\\u09c0\",\"count\":\"\\u09e8\\u09eb\\u09e6\\u09e6 +\"}]',1,'2026-09-13 04:12:26','2026-09-13 05:27:03'),(149,'en','about_me_tag','\"\\u0986\\u09ae\\u09be\\u09b0 \\u09b8\\u09ae\\u09cd\\u09aa\\u09b0\\u09cd\\u0995\\u09c7\"',1,'2026-09-13 04:18:26','2026-09-13 05:17:39'),(150,'en','about_me_title','\"\\u0986\\u09aa\\u09a8\\u09be\\u09b0 \\u09b6\\u09c7\\u0996\\u09be\\u09b0 \\u09af\\u09be\\u09a4\\u09cd\\u09b0\\u09be\\u09af\\u09bc \\u0986\\u09ae\\u09bf \\u0986\\u09aa\\u09a8\\u09be\\u09b0 \\u09aa\\u09be\\u09b6\\u09c7 \\u0986\\u099b\\u09bf\"',1,'2026-09-13 04:18:26','2026-09-13 05:17:39'),(151,'en','about_me_description','\"<p>\\u0986\\u09ae\\u09bf \\u09a1\\u09bf\\u099c\\u09bf\\u099f\\u09be\\u09b2 \\u09a6\\u0995\\u09cd\\u09b7\\u09a4\\u09be, \\u0985\\u09a8\\u09b2\\u09be\\u0987\\u09a8 \\u09ac\\u09cd\\u09af\\u09ac\\u09b8\\u09be \\u098f\\u09ac\\u0982 \\u0986\\u09a7\\u09c1\\u09a8\\u09bf\\u0995 \\u09aa\\u09cd\\u09b0\\u09af\\u09c1\\u0995\\u09cd\\u09a4\\u09bf \\u09a8\\u09bf\\u09af\\u09bc\\u09c7 \\u0995\\u09be\\u099c \\u0993 \\u09b6\\u09c7\\u0996\\u09be\\u09a8\\u09cb\\u09b0 \\u09ae\\u09be\\u09a7\\u09cd\\u09af\\u09ae\\u09c7 \\u09ae\\u09be\\u09a8\\u09c1\\u09b7\\u0995\\u09c7 \\u09a8\\u09bf\\u099c\\u09c7\\u09b0 \\u0995\\u09cd\\u09af\\u09be\\u09b0\\u09bf\\u09af\\u09bc\\u09be\\u09b0 \\u0993 \\u0986\\u09af\\u09bc\\u09c7\\u09b0 \\u09a8\\u09a4\\u09c1\\u09a8 \\u09b8\\u09c1\\u09af\\u09cb\\u0997 \\u09a4\\u09c8\\u09b0\\u09bf \\u0995\\u09b0\\u09a4\\u09c7 \\u09b8\\u09b9\\u09be\\u09af\\u09bc\\u09a4\\u09be \\u0995\\u09b0\\u09bf\\u0964 \\u0986\\u09ae\\u09be\\u09b0 \\u09b2\\u0995\\u09cd\\u09b7\\u09cd\\u09af \\u09b9\\u09b2\\u09cb \\u099c\\u099f\\u09bf\\u09b2 \\u09ac\\u09bf\\u09b7\\u09af\\u09bc\\u0997\\u09c1\\u09b2\\u09cb\\u0995\\u09c7 \\u09b8\\u09b9\\u099c\\u09ad\\u09be\\u09ac\\u09c7 \\u0989\\u09aa\\u09b8\\u09cd\\u09a5\\u09be\\u09aa\\u09a8 \\u0995\\u09b0\\u09be, \\u09af\\u09be\\u09a4\\u09c7 \\u098f\\u0995\\u099c\\u09a8 \\u09b6\\u09bf\\u0995\\u09cd\\u09b7\\u09be\\u09b0\\u09cd\\u09a5\\u09c0 \\u09b6\\u09c2\\u09a8\\u09cd\\u09af \\u09a5\\u09c7\\u0995\\u09c7 \\u09b6\\u09c1\\u09b0\\u09c1 \\u0995\\u09b0\\u09c7 \\u09a7\\u09be\\u09aa\\u09c7 \\u09a7\\u09be\\u09aa\\u09c7 \\u09ac\\u09be\\u09b8\\u09cd\\u09a4\\u09ac \\u09a6\\u0995\\u09cd\\u09b7\\u09a4\\u09be \\u0985\\u09b0\\u09cd\\u099c\\u09a8 \\u0995\\u09b0\\u09a4\\u09c7 \\u09aa\\u09be\\u09b0\\u09c7\\u0964<\\/p><li>\\u09b8\\u09b9\\u099c \\u0993 \\u09ac\\u09cd\\u09af\\u09ac\\u09b9\\u09be\\u09b0\\u09bf\\u0995\\u09ad\\u09be\\u09ac\\u09c7 \\u09a1\\u09bf\\u099c\\u09bf\\u099f\\u09be\\u09b2 \\u09a6\\u0995\\u09cd\\u09b7\\u09a4\\u09be \\u09b6\\u09c7\\u0996\\u09be\\u09a8\\u09cb<\\/li><li>\\u0987-\\u0995\\u09ae\\u09be\\u09b0\\u09cd\\u09b8 \\u09ac\\u09cd\\u09af\\u09ac\\u09b8\\u09be \\u09b6\\u09c1\\u09b0\\u09c1 \\u0995\\u09b0\\u09be\\u09b0 \\u09b8\\u09a0\\u09bf\\u0995 \\u09a6\\u09bf\\u0995\\u09a8\\u09bf\\u09b0\\u09cd\\u09a6\\u09c7\\u09b6\\u09a8\\u09be<\\/li><li>\\u09ab\\u09cd\\u09b0\\u09bf\\u09b2\\u09cd\\u09af\\u09be\\u09a8\\u09cd\\u09b8\\u09bf\\u0982 \\u0993 \\u0985\\u09a8\\u09b2\\u09be\\u0987\\u09a8 \\u0986\\u09af\\u09bc\\u09c7\\u09b0 \\u09b8\\u09c1\\u09af\\u09cb\\u0997 \\u09b8\\u09ae\\u09cd\\u09aa\\u09b0\\u09cd\\u0995\\u09c7 \\u09b6\\u09c7\\u0996\\u09be\\u09a8\\u09cb<\\/li><li>\\u09a1\\u09bf\\u099c\\u09bf\\u099f\\u09be\\u09b2 \\u09ae\\u09be\\u09b0\\u09cd\\u0995\\u09c7\\u099f\\u09bf\\u0982\\u09af\\u09bc\\u09c7\\u09b0 \\u0995\\u09be\\u09b0\\u09cd\\u09af\\u0995\\u09b0 \\u0995\\u09cc\\u09b6\\u09b2 \\u09b6\\u09c7\\u0996\\u09be\\u09a8\\u09cb<\\/li><li>\\u0995\\u09c3\\u09a4\\u09cd\\u09b0\\u09bf\\u09ae \\u09ac\\u09c1\\u09a6\\u09cd\\u09a7\\u09bf\\u09ae\\u09a4\\u09cd\\u09a4\\u09be \\u09ac\\u09cd\\u09af\\u09ac\\u09b9\\u09be\\u09b0 \\u0995\\u09b0\\u09c7 \\u0995\\u09be\\u099c\\u09c7\\u09b0 \\u09a6\\u0995\\u09cd\\u09b7\\u09a4\\u09be \\u09ac\\u09c3\\u09a6\\u09cd\\u09a7\\u09bf<\\/li><p><\\/p>\"',1,'2026-09-13 04:18:26','2026-09-13 13:34:42'),(152,'en','about_me_btn_text','\"\\u0986\\u09ae\\u09be\\u09b0 \\u09b8\\u09ae\\u09cd\\u09aa\\u09b0\\u09cd\\u0995\\u09c7 \\u0986\\u09b0\\u0993 \\u099c\\u09be\\u09a8\\u09c1\\u09a8\"',1,'2026-09-13 04:18:26','2026-09-13 05:17:39'),(153,'en','about_me_btn_url','\"#register\"',1,'2026-09-13 04:18:26','2026-09-13 05:17:39'),(154,'en','about_me_status','\"1\"',1,'2026-09-13 04:18:26','2026-09-13 04:18:26'),(155,'en','categories_of_work_cards','\"a:6:{i:0;a:5:{s:5:\\\"title\\\";s:0:\\\"\\\";s:4:\\\"link\\\";s:0:\\\"\\\";s:7:\\\"content\\\";s:0:\\\"\\\";s:8:\\\"media_id\\\";s:1:\\\"4\\\";s:5:\\\"image\\\";s:68:\\\"http:\\/\\/127.0.0.1:8000\\/images\\/20260913132150_original__media_172.webp\\\";}i:1;a:5:{s:5:\\\"title\\\";s:0:\\\"\\\";s:4:\\\"link\\\";s:0:\\\"\\\";s:7:\\\"content\\\";s:0:\\\"\\\";s:8:\\\"media_id\\\";s:1:\\\"4\\\";s:5:\\\"image\\\";s:68:\\\"http:\\/\\/127.0.0.1:8000\\/images\\/20260913132150_original__media_172.webp\\\";}i:2;a:5:{s:5:\\\"title\\\";s:0:\\\"\\\";s:4:\\\"link\\\";s:0:\\\"\\\";s:7:\\\"content\\\";s:0:\\\"\\\";s:8:\\\"media_id\\\";s:1:\\\"4\\\";s:5:\\\"image\\\";s:68:\\\"http:\\/\\/127.0.0.1:8000\\/images\\/20260913132150_original__media_172.webp\\\";}i:3;a:5:{s:5:\\\"title\\\";s:0:\\\"\\\";s:4:\\\"link\\\";s:0:\\\"\\\";s:7:\\\"content\\\";s:0:\\\"\\\";s:8:\\\"media_id\\\";s:1:\\\"4\\\";s:5:\\\"image\\\";s:68:\\\"http:\\/\\/127.0.0.1:8000\\/images\\/20260913132150_original__media_172.webp\\\";}i:4;a:5:{s:5:\\\"title\\\";s:0:\\\"\\\";s:4:\\\"link\\\";s:0:\\\"\\\";s:7:\\\"content\\\";s:0:\\\"\\\";s:8:\\\"media_id\\\";s:1:\\\"4\\\";s:5:\\\"image\\\";s:68:\\\"http:\\/\\/127.0.0.1:8000\\/images\\/20260913132150_original__media_172.webp\\\";}i:5;a:5:{s:5:\\\"title\\\";s:0:\\\"\\\";s:4:\\\"link\\\";s:0:\\\"\\\";s:7:\\\"content\\\";s:0:\\\"\\\";s:8:\\\"media_id\\\";s:1:\\\"4\\\";s:5:\\\"image\\\";s:68:\\\"http:\\/\\/127.0.0.1:8000\\/images\\/20260913132150_original__media_172.webp\\\";}}\"',1,'2026-09-13 04:19:53','2026-09-13 07:22:44'),(156,'en','categories_of_work_status','\"1\"',1,'2026-09-13 04:19:53','2026-09-13 04:19:53'),(157,'en','categories_of_work_title','\"\\u0986\\u09aa\\u09a8\\u09bf \\u09ab\\u09cd\\u09b0\\u09bf\\u09b2\\u09cd\\u09af\\u09be\\u09a8\\u09cd\\u09b8\\u09bf\\u0982 \\u09ae\\u09be\\u09b8\\u09cd\\u099f\\u09be\\u09b0\\u09bf \\u0995\\u09cb\\u09b0\\u09cd\\u09b8 \\u098f \\u09af\\u09c7 \\u09af\\u09c7 \\u09ac\\u09bf\\u09b7\\u09df\\u09c7 \\u09b6\\u09bf\\u0996\\u09a4\\u09c7 \\u09aa\\u09be\\u09b0\\u09ac\\u09c7\\u09a8\\u0964\"',1,'2026-09-13 04:19:53','2026-09-13 07:23:13'),(158,'en','show_sticky_promo_bar','\"1\"',1,'2026-09-13 04:57:34','2026-09-13 04:57:34'),(159,'en','sticky_promo_title','\"\\u09b2\\u09bf\\u09ae\\u09bf\\u099f\\u09c7\\u09a1 \\u099f\\u09be\\u0987\\u09ae \\u0985\\u09ab\\u09be\\u09b0 - \\u098f \\u09b8\\u09c1\\u09af\\u09cb\\u0997 \\u09b9\\u09be\\u09a4 \\u099b\\u09be\\u09dc\\u09be \\u0995\\u09b0\\u09ac\\u09c7\\u09a8 \\u09a8\\u09be\\u0964\"',1,'2026-09-13 04:57:34','2026-09-13 07:28:53'),(160,'en','sticky_promo_btn_text','\"\\u098f\\u0996\\u09a8\\u0987 \\u09af\\u09cb\\u0997 \\u09a6\\u09bf\\u09a8\"',1,'2026-09-13 04:57:34','2026-09-13 07:29:05'),(161,'en','sticky_promo_btn_link','\"#register\"',1,'2026-09-13 04:57:34','2026-09-13 04:57:34'),(162,'en','about_me_image','\"a:10:{s:7:\\\"storage\\\";s:5:\\\"local\\\";s:14:\\\"original_image\\\";s:52:\\\"images\\/20260913112244_original_about_me_image443.jpg\\\";s:11:\\\"image_40x40\\\";s:53:\\\"images\\/20260913112244image_40x40about_me_image188.jpg\\\";s:11:\\\"image_80x80\\\";s:53:\\\"images\\/20260913112244image_80x80about_me_image257.jpg\\\";s:11:\\\"image_68x48\\\";s:53:\\\"images\\/20260913112244image_68x48about_me_image456.jpg\\\";s:13:\\\"image_190x230\\\";s:55:\\\"images\\/20260913112244image_190x230about_me_image225.jpg\\\";s:13:\\\"image_163x116\\\";s:54:\\\"images\\/20260913112244image_163x116about_me_image24.jpg\\\";s:13:\\\"image_295x248\\\";s:55:\\\"images\\/20260913112244image_295x248about_me_image386.jpg\\\";s:13:\\\"image_417x384\\\";s:55:\\\"images\\/20260913112244image_417x384about_me_image442.jpg\\\";s:15:\\\"image_thumbnail\\\";s:57:\\\"images\\/20260913112244image_thumbnailabout_me_image225.jpg\\\";}\"',1,'2026-09-13 05:22:45','2026-09-13 05:22:45'),(163,'en','newsletter_description','\"\\u09b8\\u09b0\\u09cd\\u09ac\\u09b6\\u09c7\\u09b7 \\u0986\\u09aa\\u09a1\\u09c7\\u099f, \\u09ac\\u09bf\\u09b6\\u09c7\\u09b7 \\u09b8\\u09c1\\u09ac\\u09bf\\u09a7\\u09be \\u0993 \\u0997\\u09c1\\u09b0\\u09c1\\u09a4\\u09cd\\u09ac\\u09aa\\u09c2\\u09b0\\u09cd\\u09a3 \\u09a4\\u09a5\\u09cd\\u09af \\u09aa\\u09c7\\u09a4\\u09c7 \\u0986\\u09ae\\u09be\\u09a6\\u09c7\\u09b0 \\u09a8\\u09bf\\u0989\\u099c\\u09b2\\u09c7\\u099f\\u09be\\u09b0\\u09c7 \\u09b8\\u09be\\u09ac\\u09b8\\u09cd\\u0995\\u09cd\\u09b0\\u09be\\u0987\\u09ac \\u0995\\u09b0\\u09c1\\u09a8\\u0964\"',1,'2026-09-13 07:54:22','2026-09-13 07:54:22'),(164,'en','promo_banner_countdown_title','\"\\u0995\\u09be\\u0989\\u09a8\\u09cd\\u099f\\u09a1\\u09be\\u0989\\u09a8 \\u09b6\\u09bf\\u09b0\\u09cb\\u09a8\\u09be\\u09ae\"',1,'2026-09-13 07:54:22','2026-09-13 07:54:22'),(165,'en','promo_banner_countdown','\"2026-12-31T19:53\"',1,'2026-09-13 07:54:22','2026-09-13 07:54:22'),(166,'en','get_access_btn_title','\"\\u0985\\u09cd\\u09af\\u09be\\u0995\\u09cd\\u09b8\\u09c7\\u09b8 \\u09a8\\u09bf\\u09a8\"',1,'2026-09-13 07:54:22','2026-09-13 07:54:22'),(167,'en','get_access_btn_link','\"#register\"',1,'2026-09-13 07:54:22','2026-09-13 07:54:22'),(168,'en','marketing_webhook_url','',1,'2026-09-13 11:55:11','2026-09-13 11:55:11'),(169,'en','lang','\"\"',1,'2026-09-13 12:40:41','2026-09-13 12:40:41'),(170,'en','footer_useful_link_menu','\"a:1:{i:0;a:3:{s:5:\\\"label\\\";s:0:\\\"\\\";s:3:\\\"url\\\";N;s:9:\\\"mega_menu\\\";N;}}\"',1,'2026-09-13 12:40:41','2026-09-13 12:40:41'),(171,'en','follow_us_title','\"Follow Us :\"',1,'2026-09-13 12:42:52','2026-09-13 12:42:52'),(172,'en','footer_logo_description','\"\\u0986\\u09aa\\u09a8\\u09be\\u09b0 \\u09b8\\u09be\\u09ab\\u09b2\\u09cd\\u09af\\u09c7\\u09b0 \\u09af\\u09be\\u09a4\\u09cd\\u09b0\\u09be\\u09df \\u0986\\u09ae\\u09b0\\u09be \\u09b8\\u09ac\\u09b8\\u09ae\\u09df \\u09aa\\u09be\\u09b6\\u09c7 \\u0986\\u099b\\u09bf\\u0964 \\u09aa\\u09cd\\u09b0\\u09df\\u09cb\\u099c\\u09a8\\u09c0\\u09df \\u09a4\\u09a5\\u09cd\\u09af, \\u09b8\\u09c7\\u09ac\\u09be \\u0993 \\u09b8\\u09b9\\u09be\\u09df\\u09a4\\u09be \\u098f\\u0995 \\u099c\\u09be\\u09df\\u0997\\u09be\\u09df \\u09aa\\u09c7\\u09a4\\u09c7 \\u0986\\u09ae\\u09be\\u09a6\\u09c7\\u09b0 \\u09aa\\u09cd\\u09b2\\u09cd\\u09af\\u09be\\u099f\\u09ab\\u09b0\\u09cd\\u09ae\\u09c7\\u09b0 \\u09b8\\u0999\\u09cd\\u0997\\u09c7 \\u09af\\u09c1\\u0995\\u09cd\\u09a4 \\u09a5\\u09be\\u0995\\u09c1\\u09a8\\u0964\"',1,'2026-09-13 12:46:22','2026-09-13 12:46:22'),(173,'en','footer_get_in_touch_title','\"Get In Touch\"',1,'2026-09-13 12:46:22','2026-09-13 12:46:22'),(174,'en','footer_get_in_touch_desc','\"\"',1,'2026-09-13 12:46:22','2026-09-13 12:46:22'),(175,'en','contact_address','\"99 Roving St., Big City\"',1,'2026-09-13 12:46:22','2026-09-13 12:46:22'),(176,'en','contact_phone','\"+123-234-1234\"',1,'2026-09-13 12:46:22','2026-09-13 12:46:22'),(177,'en','contact_phone_schedule','\"Mon - Fri: 9:00 AM - 6:00 PM\"',1,'2026-09-13 12:46:22','2026-09-13 12:46:22'),(178,'en','contact_email','\"Hello@Awesomesite.Com\"',1,'2026-09-13 12:46:22','2026-09-13 12:46:22'),(179,'en','contact_email_response','\"We reply within 24 hours\"',1,'2026-09-13 12:46:22','2026-09-13 12:46:22'),(180,'en','hero_title_fs','\"18\"',1,'2026-09-13 14:08:10','2026-09-13 14:08:10'),(181,'en','hero_title_mobile_fs','\"15\"',1,'2026-09-13 14:08:10','2026-09-13 14:08:10'),(182,'en','desc_right_title_fs','\"18\"',1,'2026-09-13 14:08:10','2026-09-13 14:08:10'),(183,'en','desc_right_title_mobile_fs','\"15\"',1,'2026-09-13 14:08:10','2026-09-13 14:08:10'),(184,'en','benefits_title_fs','\"18\"',1,'2026-09-13 14:08:10','2026-09-13 14:08:10'),(185,'en','benefits_title_mobile_fs','\"15\"',1,'2026-09-13 14:08:10','2026-09-13 14:08:10'),(186,'en','gift_title_fs','\"18\"',1,'2026-09-13 14:08:11','2026-09-13 14:08:11'),(187,'en','gift_title_mobile_fs','\"15\"',1,'2026-09-13 14:08:11','2026-09-13 14:08:11'),(188,'en','breakdown_today_title_fs','\"18\"',1,'2026-09-13 14:08:11','2026-09-13 14:08:11'),(189,'en','breakdown_today_title_mobile_fs','\"15\"',1,'2026-09-13 14:08:11','2026-09-13 14:08:11'),(190,'en','order_summary_title_fs','\"18\"',1,'2026-09-13 14:08:11','2026-09-13 14:08:11'),(191,'en','order_summary_title_mobile_fs','\"15\"',1,'2026-09-13 14:08:11','2026-09-13 14:08:11'),(192,'en','curriculum_title_fs','\"18\"',1,'2026-09-13 14:08:11','2026-09-13 14:08:11'),(193,'en','curriculum_title_mobile_fs','\"15\"',1,'2026-09-13 14:08:11','2026-09-13 14:08:11'),(194,'en','success_title_fs','\"18\"',1,'2026-09-13 14:08:11','2026-09-13 14:08:11'),(195,'en','success_title_mobile_fs','\"15\"',1,'2026-09-13 14:08:11','2026-09-13 14:08:11'),(196,'en','support_title_fs','\"18\"',1,'2026-09-13 14:08:11','2026-09-13 14:08:11'),(197,'en','support_title_mobile_fs','\"15\"',1,'2026-09-13 14:08:11','2026-09-13 14:08:11'),(198,'en','faq_title_fs','\"\"',1,'2026-09-13 14:08:11','2026-09-13 14:08:11'),(199,'en','faq_title_mobile_fs','\"15\"',1,'2026-09-13 14:08:11','2026-09-13 14:08:11'),(200,'en','success_section_status','\"1\"',1,'2026-09-13 14:34:02','2026-09-13 14:34:02'),(201,'en','success_section_eyebrow','\"SUCCESS STORIES\"',1,'2026-09-13 14:34:02','2026-09-13 14:34:02'),(202,'en','success_section_title','\"What Says My Students About The Platform\"',1,'2026-09-13 14:34:02','2026-09-13 14:34:02'),(203,'en','success_section_description','\"\"',1,'2026-09-13 14:34:02','2026-09-13 14:34:02'),(204,'en','success_section_btn_text','\"Join Now\"',1,'2026-09-13 14:34:02','2026-09-13 14:34:02'),(205,'en','success_section_btn_url','\"#register\"',1,'2026-09-13 14:34:02','2026-09-13 14:34:02'),(206,'bn','success_section_status','\"1\"',1,'2026-09-13 14:34:02','2026-09-13 14:34:02'),(207,'ar','success_section_status','\"1\"',1,'2026-09-13 14:34:02','2026-09-13 14:34:02'),(208,'bn','success_section_eyebrow','\"SUCCESS STORIES\"',1,'2026-09-13 14:34:02','2026-09-13 14:34:02'),(209,'ar','success_section_eyebrow','\"SUCCESS STORIES\"',1,'2026-09-13 14:34:02','2026-09-13 14:34:02'),(210,'bn','success_section_title','\"What Says My Students About The Platform\"',1,'2026-09-13 14:34:02','2026-09-13 14:34:02'),(211,'ar','success_section_title','\"What Says My Students About The Platform\"',1,'2026-09-13 14:34:02','2026-09-13 14:34:02'),(212,'bn','success_section_description','\"\"',1,'2026-09-13 14:34:02','2026-09-13 14:34:02'),(213,'ar','success_section_description','\"\"',1,'2026-09-13 14:34:02','2026-09-13 14:34:02'),(214,'bn','success_section_btn_text','\"Join Now\"',1,'2026-09-13 14:34:02','2026-09-13 14:34:02'),(215,'ar','success_section_btn_text','\"Join Now\"',1,'2026-09-13 14:34:02','2026-09-13 14:34:02'),(216,'bn','success_section_btn_url','\"#register\"',1,'2026-09-13 14:34:02','2026-09-13 14:34:02'),(217,'ar','success_section_btn_url','\"#register\"',1,'2026-09-13 14:34:02','2026-09-13 14:34:02');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slider_languages`
--

DROP TABLE IF EXISTS `slider_languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `slider_languages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slider_id` bigint unsigned DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btn_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slider_languages`
--

LOCK TABLES `slider_languages` WRITE;
/*!40000 ALTER TABLE `slider_languages` DISABLE KEYS */;
/*!40000 ALTER TABLE `slider_languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sliders`
--

DROP TABLE IF EXISTS `sliders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sliders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `btn_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `media_id` bigint unsigned DEFAULT NULL,
  `sliderable_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sliderable_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_no` int DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sliders`
--

LOCK TABLES `sliders` WRITE;
/*!40000 ALTER TABLE `sliders` DISABLE KEYS */;
/*!40000 ALTER TABLE `sliders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sms_templates`
--

DROP TABLE IF EXISTS `sms_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sms_templates` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `template_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'use only for fast2sms',
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_codes` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sms_templates`
--

LOCK TABLES `sms_templates` WRITE;
/*!40000 ALTER TABLE `sms_templates` DISABLE KEYS */;
INSERT INTO `sms_templates` VALUES (1,'login','0','Your login OTP is {otp}','{otp},{phone_no},{site_name}',1,NULL,NULL),(2,'register','0','Your register OTP is {otp}','{otp},{phone_no},{site_name}',1,NULL,NULL);
/*!40000 ALTER TABLE `sms_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `social_accounts`
--

DROP TABLE IF EXISTS `social_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `social_accounts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `social_media_id` bigint unsigned DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `social_accounts`
--

LOCK TABLES `social_accounts` WRITE;
/*!40000 ALTER TABLE `social_accounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `social_accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `states` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` bigint unsigned DEFAULT NULL,
  `latitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0 inactive, 1 active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `states`
--

LOCK TABLES `states` WRITE;
/*!40000 ALTER TABLE `states` DISABLE KEYS */;
/*!40000 ALTER TABLE `states` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_faq_languages`
--

DROP TABLE IF EXISTS `student_faq_languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `student_faq_languages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `lang` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `faq_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_faq_languages`
--

LOCK TABLES `student_faq_languages` WRITE;
/*!40000 ALTER TABLE `student_faq_languages` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_faq_languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_faqs`
--

DROP TABLE IF EXISTS `student_faqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `student_faqs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `question` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ordering` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_faqs`
--

LOCK TABLES `student_faqs` WRITE;
/*!40000 ALTER TABLE `student_faqs` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_faqs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subject_languages`
--

DROP TABLE IF EXISTS `subject_languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subject_languages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint unsigned NOT NULL,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subject_languages`
--

LOCK TABLES `subject_languages` WRITE;
/*!40000 ALTER TABLE `subject_languages` DISABLE KEYS */;
INSERT INTO `subject_languages` VALUES (1,'Programming','en',1,'Programming','programming, coding','Programming courses and tutorials.','2026-09-12 23:02:22','2026-09-12 23:02:22'),(2,'Marketing','en',2,'Marketing','marketing, business','Marketing strategies and principles.','2026-09-12 23:02:22','2026-09-12 23:02:22'),(3,'Machine Learning','en',3,'Machine Learning','machine learning, ai','Artificial intelligence and machine learning.','2026-09-12 23:02:22','2026-09-12 23:02:22'),(4,'Mathematics','en',4,'Mathematics','mathematics, algebra','Mathematics and algebra courses.','2026-09-12 23:02:22','2026-09-12 23:02:22');
/*!40000 ALTER TABLE `subject_languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subjects` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `image_media_id` text COLLATE utf8mb4_unicode_ci,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_image` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0 inactive, 1 active',
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'course',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subjects`
--

LOCK TABLES `subjects` WRITE;
/*!40000 ALTER TABLE `subjects` DISABLE KEYS */;
INSERT INTO `subjects` VALUES (1,'Programming','programming',NULL,NULL,'Programming','programming, coding','Programming courses and tutorials.',NULL,1,'course','2026-09-12 23:02:22','2026-09-12 23:02:22'),(2,'Marketing','marketing',NULL,NULL,'Marketing','marketing, business','Marketing strategies and principles.',NULL,1,'course','2026-09-12 23:02:22','2026-09-12 23:02:22'),(3,'Machine Learning','machine-learning',NULL,NULL,'Machine Learning','machine learning, ai','Artificial intelligence and machine learning.',NULL,1,'course','2026-09-12 23:02:22','2026-09-12 23:02:22'),(4,'Mathematics','mathematics',NULL,NULL,'Mathematics','mathematics, algebra','Mathematics and algebra courses.',NULL,1,'course','2026-09-12 23:02:22','2026-09-12 23:02:22');
/*!40000 ALTER TABLE `subjects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `submited_assignments`
--

DROP TABLE IF EXISTS `submited_assignments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `submited_assignments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `assignment_id` bigint unsigned DEFAULT NULL,
  `marks` double NOT NULL DEFAULT '0',
  `grad` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '0=submit, 1=complete, 2=fail',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `submited_assignments`
--

LOCK TABLES `submited_assignments` WRITE;
/*!40000 ALTER TABLE `submited_assignments` DISABLE KEYS */;
/*!40000 ALTER TABLE `submited_assignments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscribers`
--

DROP TABLE IF EXISTS `subscribers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subscribers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0 inactive, 1 active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscribers`
--

LOCK TABLES `subscribers` WRITE;
/*!40000 ALTER TABLE `subscribers` DISABLE KEYS */;
/*!40000 ALTER TABLE `subscribers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `success_stories`
--

DROP TABLE IF EXISTS `success_stories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `success_stories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` int DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `video` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `success_media_id` bigint unsigned DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0 inactive, 1 active',
  `is_featured` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `success_stories`
--

LOCK TABLES `success_stories` WRITE;
/*!40000 ALTER TABLE `success_stories` DISABLE KEYS */;
INSERT INTO `success_stories` VALUES (1,'Mahfuza Akter Zarin','CEO',5,'mahfuza-akter-zarin','কোর্সটি আমার জন্য খুবই উপকারী ছিল। প্রতিটি বিষয় সহজভাবে এবং সুন্দরভাবে উপস্থাপন করা হয়েছে। শেখার পাশাপাশি বাস্তব কাজে প্রয়োগ করার সুযোগ পেয়েছি। যারা নিজের দক্ষতা বাড়াতে চান, তাদের জন্য এই প্ল্যাটফর্মটি অবশ্যই উপকারী।','{\"storage\":\"local\",\"original_image\":\"images\\/20260913133653_original__media_279.jpg\",\"image_40x40\":\"images\\/20260913133653image_40x40_media_230.jpg\",\"image_80x80\":\"images\\/20260913133653image_80x80_media_460.jpg\",\"image_68x48\":\"images\\/20260913133653image_68x48_media_302.jpg\",\"image_190x230\":\"images\\/20260913133653image_190x230_media_51.jpg\",\"image_163x116\":\"images\\/20260913133653image_163x116_media_471.jpg\",\"image_295x248\":\"images\\/20260913133653image_295x248_media_90.jpg\",\"image_417x384\":\"images\\/20260913133653image_417x384_media_202.jpg\",\"image_thumbnail\":\"images\\/20260913133653image_thumbnail_media_470.jpg\",\"image_473x337\":\"images\\/20260913133800image_473x337-72.jpg\"}','',6,1,1,'2026-09-12 23:02:22','2026-09-13 07:41:36'),(2,'Mohammad Yeasin Arafat','CEO',5,'mohammad-yeasin-arafat','কোর্সটি আমার জন্য খুবই উপকারী ছিল। প্রতিটি বিষয় সহজভাবে এবং সুন্দরভাবে উপস্থাপন করা হয়েছে। শেখার পাশাপাশি বাস্তব কাজে প্রয়োগ করার সুযোগ পেয়েছি। যারা নিজের দক্ষতা বাড়াতে চান, তাদের জন্য এই প্ল্যাটফর্মটি অবশ্যই উপকারী।','{\"storage\":\"local\",\"original_image\":\"images\\/20260913134012_original__media_364.jpg\",\"image_40x40\":\"images\\/20260913134012image_40x40_media_454.jpg\",\"image_80x80\":\"images\\/20260913134012image_80x80_media_30.jpg\",\"image_68x48\":\"images\\/20260913134012image_68x48_media_448.jpg\",\"image_190x230\":\"images\\/20260913134012image_190x230_media_301.jpg\",\"image_163x116\":\"images\\/20260913134012image_163x116_media_338.jpg\",\"image_295x248\":\"images\\/20260913134012image_295x248_media_438.jpg\",\"image_417x384\":\"images\\/20260913134012image_417x384_media_295.jpg\",\"image_thumbnail\":\"images\\/20260913134012image_thumbnail_media_182.jpg\",\"image_473x337\":\"images\\/20260913134037image_473x337-484.jpg\"}','',7,1,1,'2026-09-13 07:40:37','2026-09-13 07:41:29');
/*!40000 ALTER TABLE `success_stories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `success_story_languages`
--

DROP TABLE IF EXISTS `success_story_languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `success_story_languages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `success_story_id` bigint unsigned DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `success_story_languages`
--

LOCK TABLES `success_story_languages` WRITE;
/*!40000 ALTER TABLE `success_story_languages` DISABLE KEYS */;
INSERT INTO `success_story_languages` VALUES (1,1,'Mahfuza Akter Zarin','en','It took a long time for me to locate an excellent platform for my online schools. Coradius IT Center is a solid platform that\r\n                                is simple to use and set up, as well as economical for those just getting started','2026-09-12 23:02:22','2026-09-13 07:41:36'),(2,2,'Mohammad Yeasin Arafat','en','কোর্সটি আমার জন্য খুবই উপকারী ছিল। প্রতিটি বিষয় সহজভাবে এবং সুন্দরভাবে উপস্থাপন করা হয়েছে। শেখার পাশাপাশি বাস্তব কাজে প্রয়োগ করার সুযোগ পেয়েছি। যারা নিজের দক্ষতা বাড়াতে চান, তাদের জন্য এই প্ল্যাটফর্মটি অবশ্যই উপকারী।','2026-09-13 07:40:37','2026-09-13 07:41:24');
/*!40000 ALTER TABLE `success_story_languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag_languages`
--

DROP TABLE IF EXISTS `tag_languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tag_languages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tag_id` bigint unsigned DEFAULT NULL,
  `lang` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag_languages`
--

LOCK TABLES `tag_languages` WRITE;
/*!40000 ALTER TABLE `tag_languages` DISABLE KEYS */;
INSERT INTO `tag_languages` VALUES (1,1,'en','web','2026-09-12 23:02:27','2026-09-12 23:02:27'),(2,2,'en','book','2026-09-12 23:02:27','2026-09-12 23:02:27'),(3,3,'en','blog','2026-09-12 23:02:27','2026-09-12 23:02:27');
/*!40000 ALTER TABLE `tag_languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tags` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0 inactive, 1 active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (1,'web',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(2,'book',1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(3,'blog',1,'2026-09-12 23:02:27','2026-09-12 23:02:27');
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonial_languages`
--

DROP TABLE IF EXISTS `testimonial_languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `testimonial_languages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `testimonial_id` bigint unsigned NOT NULL,
  `lang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonial_languages`
--

LOCK TABLES `testimonial_languages` WRITE;
/*!40000 ALTER TABLE `testimonial_languages` DISABLE KEYS */;
INSERT INTO `testimonial_languages` VALUES (1,1,'en','Natasha Hope','We\'re loving it. This platform is both perfect and highly adaptable to our needs.','2026-09-12 23:02:27','2026-09-12 23:02:27'),(2,2,'en','Charles Dale','An incredible learning experience with great instructors and well-structured courses.','2026-09-12 23:02:27','2026-09-12 23:02:27');
/*!40000 ALTER TABLE `testimonial_languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `testimonials` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `media_id` bigint unsigned DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0 inactive, 1 active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `position` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` tinyint DEFAULT NULL,
  `video` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonials`
--

LOCK TABLES `testimonials` WRITE;
/*!40000 ALTER TABLE `testimonials` DISABLE KEYS */;
INSERT INTO `testimonials` VALUES (1,'Natasha Hope','We\'re loving it. This platform is both perfect and highly adaptable to our needs.',NULL,NULL,1,'2026-09-12 23:02:27','2026-09-12 23:02:27',NULL,NULL,NULL),(2,'Charles Dale','An incredible learning experience with great instructors and well-structured courses.',NULL,NULL,1,'2026-09-12 23:02:27','2026-09-12 23:02:27',NULL,NULL,NULL);
/*!40000 ALTER TABLE `testimonials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_replies`
--

DROP TABLE IF EXISTS `ticket_replies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ticket_replies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ticket_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` text COLLATE utf8mb4_unicode_ci,
  `file_media_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `viewed` tinyint(1) NOT NULL DEFAULT '1',
  `reply` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_replies`
--

LOCK TABLES `ticket_replies` WRITE;
/*!40000 ALTER TABLE `ticket_replies` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_replies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tickets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `priority` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ticket_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `viewed` tinyint(1) NOT NULL DEFAULT '0',
  `client_viewed` tinyint(1) NOT NULL DEFAULT '0',
  `file` text COLLATE utf8mb4_unicode_ci,
  `file_media_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci,
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
-- Table structure for table `timezones`
--

DROP TABLE IF EXISTS `timezones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `timezones` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `country_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timezone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gmt_offset` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dst_offset` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `raw_offset` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=419 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `timezones`
--

LOCK TABLES `timezones` WRITE;
/*!40000 ALTER TABLE `timezones` DISABLE KEYS */;
INSERT INTO `timezones` VALUES (1,'AD','Europe/Andorra','1.00','2.00','1.00',NULL,NULL),(2,'AE','Asia/Dubai','4.00','4.00','4.00',NULL,NULL),(3,'AF','Asia/Kabul','4.50','4.50','4.50',NULL,NULL),(4,'AG','America/Antigua','-4.00','-4.00','-4.00',NULL,NULL),(5,'AI','America/Anguilla','-4.00','-4.00','-4.00',NULL,NULL),(6,'AL','Europe/Tirane','1.00','2.00','1.00',NULL,NULL),(7,'AM','Asia/Yerevan','4.00','4.00','4.00',NULL,NULL),(8,'AO','Africa/Luanda','1.00','1.00','1.00',NULL,NULL),(9,'AQ','Antarctica/Casey','8.00','8.00','8.00',NULL,NULL),(10,'AQ','Antarctica/Davis','7.00','7.00','7.00',NULL,NULL),(11,'AQ','Antarctica/DumontDUrville','10.00','10.00','10.00',NULL,NULL),(12,'AQ','Antarctica/Mawson','5.00','5.00','5.00',NULL,NULL),(13,'AQ','Antarctica/McMurdo','13.00','12.00','12.00',NULL,NULL),(14,'AQ','Antarctica/Palmer','-3.00','-4.00','-4.00',NULL,NULL),(15,'AQ','Antarctica/Rothera','-3.00','-3.00','-3.00',NULL,NULL),(16,'AQ','Antarctica/South_Pole','13.00','12.00','12.00',NULL,NULL),(17,'AQ','Antarctica/Syowa','3.00','3.00','3.00',NULL,NULL),(18,'AQ','Antarctica/Vostok','6.00','6.00','6.00',NULL,NULL),(19,'AR','America/Argentina/Buenos_Aires','-3.00','-3.00','-3.00',NULL,NULL),(20,'AR','America/Argentina/Catamarca','-3.00','-3.00','-3.00',NULL,NULL),(21,'AR','America/Argentina/Cordoba','-3.00','-3.00','-3.00',NULL,NULL),(22,'AR','America/Argentina/Jujuy','-3.00','-3.00','-3.00',NULL,NULL),(23,'AR','America/Argentina/La_Rioja','-3.00','-3.00','-3.00',NULL,NULL),(24,'AR','America/Argentina/Mendoza','-3.00','-3.00','-3.00',NULL,NULL),(25,'AR','America/Argentina/Rio_Gallegos','-3.00','-3.00','-3.00',NULL,NULL),(26,'AR','America/Argentina/Salta','-3.00','-3.00','-3.00',NULL,NULL),(27,'AR','America/Argentina/San_Juan','-3.00','-3.00','-3.00',NULL,NULL),(28,'AR','America/Argentina/San_Luis','-3.00','-3.00','-3.00',NULL,NULL),(29,'AR','America/Argentina/Tucuman','-3.00','-3.00','-3.00',NULL,NULL),(30,'AR','America/Argentina/Ushuaia','-3.00','-3.00','-3.00',NULL,NULL),(31,'AS','Pacific/Pago_Pago','-11.00','-11.00','-11.00',NULL,NULL),(32,'AT','Europe/Vienna','1.00','2.00','1.00',NULL,NULL),(33,'AU','Antarctica/Macquarie','11.00','11.00','11.00',NULL,NULL),(34,'AU','Australia/Adelaide','10.50','9.50','9.50',NULL,NULL),(35,'AU','Australia/Brisbane','10.00','10.00','10.00',NULL,NULL),(36,'AU','Australia/Broken_Hill','10.50','9.50','9.50',NULL,NULL),(37,'AU','Australia/Currie','11.00','10.00','10.00',NULL,NULL),(38,'AU','Australia/Darwin','9.50','9.50','9.50',NULL,NULL),(39,'AU','Australia/Eucla','8.75','8.75','8.75',NULL,NULL),(40,'AU','Australia/Hobart','11.00','10.00','10.00',NULL,NULL),(41,'AU','Australia/Lindeman','10.00','10.00','10.00',NULL,NULL),(42,'AU','Australia/Lord_Howe','11.00','10.50','10.50',NULL,NULL),(43,'AU','Australia/Melbourne','11.00','10.00','10.00',NULL,NULL),(44,'AU','Australia/Perth','8.00','8.00','8.00',NULL,NULL),(45,'AU','Australia/Sydney','11.00','10.00','10.00',NULL,NULL),(46,'AW','America/Aruba','-4.00','-4.00','-4.00',NULL,NULL),(47,'AX','Europe/Mariehamn','2.00','3.00','2.00',NULL,NULL),(48,'AZ','Asia/Baku','4.00','5.00','4.00',NULL,NULL),(49,'BA','Europe/Sarajevo','1.00','2.00','1.00',NULL,NULL),(50,'BB','America/Barbados','-4.00','-4.00','-4.00',NULL,NULL),(51,'BD','Asia/Dhaka','6.00','6.00','6.00',NULL,NULL),(52,'BE','Europe/Brussels','1.00','2.00','1.00',NULL,NULL),(53,'BF','Africa/Ouagadougou','0.00','0.00','0.00',NULL,NULL),(54,'BG','Europe/Sofia','2.00','3.00','2.00',NULL,NULL),(55,'BH','Asia/Bahrain','3.00','3.00','3.00',NULL,NULL),(56,'BI','Africa/Bujumbura','2.00','2.00','2.00',NULL,NULL),(57,'BJ','Africa/Porto-Novo','1.00','1.00','1.00',NULL,NULL),(58,'BL','America/St_Barthelemy','-4.00','-4.00','-4.00',NULL,NULL),(59,'BM','Atlantic/Bermuda','-4.00','-3.00','-4.00',NULL,NULL),(60,'BN','Asia/Brunei','8.00','8.00','8.00',NULL,NULL),(61,'BO','America/La_Paz','-4.00','-4.00','-4.00',NULL,NULL),(62,'BQ','America/Kralendijk','-4.00','-4.00','-4.00',NULL,NULL),(63,'BR','America/Araguaina','-3.00','-3.00','-3.00',NULL,NULL),(64,'BR','America/Bahia','-3.00','-3.00','-3.00',NULL,NULL),(65,'BR','America/Belem','-3.00','-3.00','-3.00',NULL,NULL),(66,'BR','America/Boa_Vista','-4.00','-4.00','-4.00',NULL,NULL),(67,'BR','America/Campo_Grande','-3.00','-4.00','-4.00',NULL,NULL),(68,'BR','America/Cuiaba','-3.00','-4.00','-4.00',NULL,NULL),(69,'BR','America/Eirunepe','-5.00','-5.00','-5.00',NULL,NULL),(70,'BR','America/Fortaleza','-3.00','-3.00','-3.00',NULL,NULL),(71,'BR','America/Maceio','-3.00','-3.00','-3.00',NULL,NULL),(72,'BR','America/Manaus','-4.00','-4.00','-4.00',NULL,NULL),(73,'BR','America/Noronha','-2.00','-2.00','-2.00',NULL,NULL),(74,'BR','America/Porto_Velho','-4.00','-4.00','-4.00',NULL,NULL),(75,'BR','America/Recife','-3.00','-3.00','-3.00',NULL,NULL),(76,'BR','America/Rio_Branco','-5.00','-5.00','-5.00',NULL,NULL),(77,'BR','America/Santarem','-3.00','-3.00','-3.00',NULL,NULL),(78,'BR','America/Sao_Paulo','-2.00','-3.00','-3.00',NULL,NULL),(79,'BS','America/Nassau','-5.00','-4.00','-5.00',NULL,NULL),(80,'BT','Asia/Thimphu','6.00','6.00','6.00',NULL,NULL),(81,'BW','Africa/Gaborone','2.00','2.00','2.00',NULL,NULL),(82,'BY','Europe/Minsk','3.00','3.00','3.00',NULL,NULL),(83,'BZ','America/Belize','-6.00','-6.00','-6.00',NULL,NULL),(84,'CA','America/Atikokan','-5.00','-5.00','-5.00',NULL,NULL),(85,'CA','America/Blanc-Sablon','-4.00','-4.00','-4.00',NULL,NULL),(86,'CA','America/Cambridge_Bay','-7.00','-6.00','-7.00',NULL,NULL),(87,'CA','America/Creston','-7.00','-7.00','-7.00',NULL,NULL),(88,'CA','America/Dawson','-8.00','-7.00','-8.00',NULL,NULL),(89,'CA','America/Dawson_Creek','-7.00','-7.00','-7.00',NULL,NULL),(90,'CA','America/Edmonton','-7.00','-6.00','-7.00',NULL,NULL),(91,'CA','America/Glace_Bay','-4.00','-3.00','-4.00',NULL,NULL),(92,'CA','America/Goose_Bay','-4.00','-3.00','-4.00',NULL,NULL),(93,'CA','America/Halifax','-4.00','-3.00','-4.00',NULL,NULL),(94,'CA','America/Inuvik','-7.00','-6.00','-7.00',NULL,NULL),(95,'CA','America/Iqaluit','-5.00','-4.00','-5.00',NULL,NULL),(96,'CA','America/Moncton','-4.00','-3.00','-4.00',NULL,NULL),(97,'CA','America/Montreal','-5.00','-4.00','-5.00',NULL,NULL),(98,'CA','America/Nipigon','-5.00','-4.00','-5.00',NULL,NULL),(99,'CA','America/Pangnirtung','-5.00','-4.00','-5.00',NULL,NULL),(100,'CA','America/Rainy_River','-6.00','-5.00','-6.00',NULL,NULL),(101,'CA','America/Rankin_Inlet','-6.00','-5.00','-6.00',NULL,NULL),(102,'CA','America/Regina','-6.00','-6.00','-6.00',NULL,NULL),(103,'CA','America/Resolute','-6.00','-5.00','-6.00',NULL,NULL),(104,'CA','America/St_Johns','-3.50','-2.50','-3.50',NULL,NULL),(105,'CA','America/Swift_Current','-6.00','-6.00','-6.00',NULL,NULL),(106,'CA','America/Thunder_Bay','-5.00','-4.00','-5.00',NULL,NULL),(107,'CA','America/Toronto','-5.00','-4.00','-5.00',NULL,NULL),(108,'CA','America/Vancouver','-8.00','-7.00','-8.00',NULL,NULL),(109,'CA','America/Whitehorse','-8.00','-7.00','-8.00',NULL,NULL),(110,'CA','America/Winnipeg','-6.00','-5.00','-6.00',NULL,NULL),(111,'CA','America/Yellowknife','-7.00','-6.00','-7.00',NULL,NULL),(112,'CC','Indian/Cocos','6.50','6.50','6.50',NULL,NULL),(113,'CD','Africa/Kinshasa','1.00','1.00','1.00',NULL,NULL),(114,'CD','Africa/Lubumbashi','2.00','2.00','2.00',NULL,NULL),(115,'CF','Africa/Bangui','1.00','1.00','1.00',NULL,NULL),(116,'CG','Africa/Brazzaville','1.00','1.00','1.00',NULL,NULL),(117,'CH','Europe/Zurich','1.00','2.00','1.00',NULL,NULL),(118,'CI','Africa/Abidjan','0.00','0.00','0.00',NULL,NULL),(119,'CK','Pacific/Rarotonga','-10.00','-10.00','-10.00',NULL,NULL),(120,'CL','America/Santiago','-3.00','-4.00','-4.00',NULL,NULL),(121,'CL','Pacific/Easter','-5.00','-6.00','-6.00',NULL,NULL),(122,'CM','Africa/Douala','1.00','1.00','1.00',NULL,NULL),(123,'CN','Asia/Chongqing','8.00','8.00','8.00',NULL,NULL),(124,'CN','Asia/Harbin','8.00','8.00','8.00',NULL,NULL),(125,'CN','Asia/Kashgar','8.00','8.00','8.00',NULL,NULL),(126,'CN','Asia/Shanghai','8.00','8.00','8.00',NULL,NULL),(127,'CN','Asia/Urumqi','8.00','8.00','8.00',NULL,NULL),(128,'CO','America/Bogota','-5.00','-5.00','-5.00',NULL,NULL),(129,'CR','America/Costa_Rica','-6.00','-6.00','-6.00',NULL,NULL),(130,'CU','America/Havana','-5.00','-4.00','-5.00',NULL,NULL),(131,'CV','Atlantic/Cape_Verde','-1.00','-1.00','-1.00',NULL,NULL),(132,'CW','America/Curacao','-4.00','-4.00','-4.00',NULL,NULL),(133,'CX','Indian/Christmas','7.00','7.00','7.00',NULL,NULL),(134,'CY','Asia/Nicosia','2.00','3.00','2.00',NULL,NULL),(135,'CZ','Europe/Prague','1.00','2.00','1.00',NULL,NULL),(136,'DE','Europe/Berlin','1.00','2.00','1.00',NULL,NULL),(137,'DE','Europe/Busingen','1.00','2.00','1.00',NULL,NULL),(138,'DJ','Africa/Djibouti','3.00','3.00','3.00',NULL,NULL),(139,'DK','Europe/Copenhagen','1.00','2.00','1.00',NULL,NULL),(140,'DM','America/Dominica','-4.00','-4.00','-4.00',NULL,NULL),(141,'DO','America/Santo_Domingo','-4.00','-4.00','-4.00',NULL,NULL),(142,'DZ','Africa/Algiers','1.00','1.00','1.00',NULL,NULL),(143,'EC','America/Guayaquil','-5.00','-5.00','-5.00',NULL,NULL),(144,'EC','Pacific/Galapagos','-6.00','-6.00','-6.00',NULL,NULL),(145,'EE','Europe/Tallinn','2.00','3.00','2.00',NULL,NULL),(146,'EG','Africa/Cairo','2.00','2.00','2.00',NULL,NULL),(147,'EH','Africa/El_Aaiun','0.00','0.00','0.00',NULL,NULL),(148,'ER','Africa/Asmara','3.00','3.00','3.00',NULL,NULL),(149,'ES','Africa/Ceuta','1.00','2.00','1.00',NULL,NULL),(150,'ES','Atlantic/Canary','0.00','1.00','0.00',NULL,NULL),(151,'ES','Europe/Madrid','1.00','2.00','1.00',NULL,NULL),(152,'ET','Africa/Addis_Ababa','3.00','3.00','3.00',NULL,NULL),(153,'FI','Europe/Helsinki','2.00','3.00','2.00',NULL,NULL),(154,'FJ','Pacific/Fiji','13.00','12.00','12.00',NULL,NULL),(155,'FK','Atlantic/Stanley','-3.00','-3.00','-3.00',NULL,NULL),(156,'FM','Pacific/Chuuk','10.00','10.00','10.00',NULL,NULL),(157,'FM','Pacific/Kosrae','11.00','11.00','11.00',NULL,NULL),(158,'FM','Pacific/Pohnpei','11.00','11.00','11.00',NULL,NULL),(159,'FO','Atlantic/Faroe','0.00','1.00','0.00',NULL,NULL),(160,'FR','Europe/Paris','1.00','2.00','1.00',NULL,NULL),(161,'GA','Africa/Libreville','1.00','1.00','1.00',NULL,NULL),(162,'GB','Europe/London','0.00','1.00','0.00',NULL,NULL),(163,'GD','America/Grenada','-4.00','-4.00','-4.00',NULL,NULL),(164,'GE','Asia/Tbilisi','4.00','4.00','4.00',NULL,NULL),(165,'GF','America/Cayenne','-3.00','-3.00','-3.00',NULL,NULL),(166,'GG','Europe/Guernsey','0.00','1.00','0.00',NULL,NULL),(167,'GH','Africa/Accra','0.00','0.00','0.00',NULL,NULL),(168,'GI','Europe/Gibraltar','1.00','2.00','1.00',NULL,NULL),(169,'GL','America/Danmarkshavn','0.00','0.00','0.00',NULL,NULL),(170,'GL','America/Godthab','-3.00','-2.00','-3.00',NULL,NULL),(171,'GL','America/Scoresbysund','-1.00','0.00','-1.00',NULL,NULL),(172,'GL','America/Thule','-4.00','-3.00','-4.00',NULL,NULL),(173,'GM','Africa/Banjul','0.00','0.00','0.00',NULL,NULL),(174,'GN','Africa/Conakry','0.00','0.00','0.00',NULL,NULL),(175,'GP','America/Guadeloupe','-4.00','-4.00','-4.00',NULL,NULL),(176,'GQ','Africa/Malabo','1.00','1.00','1.00',NULL,NULL),(177,'GR','Europe/Athens','2.00','3.00','2.00',NULL,NULL),(178,'GS','Atlantic/South_Georgia','-2.00','-2.00','-2.00',NULL,NULL),(179,'GT','America/Guatemala','-6.00','-6.00','-6.00',NULL,NULL),(180,'GU','Pacific/Guam','10.00','10.00','10.00',NULL,NULL),(181,'GW','Africa/Bissau','0.00','0.00','0.00',NULL,NULL),(182,'GY','America/Guyana','-4.00','-4.00','-4.00',NULL,NULL),(183,'HK','Asia/Hong_Kong','8.00','8.00','8.00',NULL,NULL),(184,'HN','America/Tegucigalpa','-6.00','-6.00','-6.00',NULL,NULL),(185,'HR','Europe/Zagreb','1.00','2.00','1.00',NULL,NULL),(186,'HT','America/Port-au-Prince','-5.00','-4.00','-5.00',NULL,NULL),(187,'HU','Europe/Budapest','1.00','2.00','1.00',NULL,NULL),(188,'ID','Asia/Jakarta','7.00','7.00','7.00',NULL,NULL),(189,'ID','Asia/Jayapura','9.00','9.00','9.00',NULL,NULL),(190,'ID','Asia/Makassar','8.00','8.00','8.00',NULL,NULL),(191,'ID','Asia/Pontianak','7.00','7.00','7.00',NULL,NULL),(192,'IE','Europe/Dublin','0.00','1.00','0.00',NULL,NULL),(193,'IL','Asia/Jerusalem','2.00','3.00','2.00',NULL,NULL),(194,'IM','Europe/Isle_of_Man','0.00','1.00','0.00',NULL,NULL),(195,'IN','Asia/Kolkata','5.50','5.50','5.50',NULL,NULL),(196,'IO','Indian/Chagos','6.00','6.00','6.00',NULL,NULL),(197,'IQ','Asia/Baghdad','3.00','3.00','3.00',NULL,NULL),(198,'IR','Asia/Tehran','3.50','4.50','3.50',NULL,NULL),(199,'IS','Atlantic/Reykjavik','0.00','0.00','0.00',NULL,NULL),(200,'IT','Europe/Rome','1.00','2.00','1.00',NULL,NULL),(201,'JE','Europe/Jersey','0.00','1.00','0.00',NULL,NULL),(202,'JM','America/Jamaica','-5.00','-5.00','-5.00',NULL,NULL),(203,'JO','Asia/Amman','2.00','3.00','2.00',NULL,NULL),(204,'JP','Asia/Tokyo','9.00','9.00','9.00',NULL,NULL),(205,'KE','Africa/Nairobi','3.00','3.00','3.00',NULL,NULL),(206,'KG','Asia/Bishkek','6.00','6.00','6.00',NULL,NULL),(207,'KH','Asia/Phnom_Penh','7.00','7.00','7.00',NULL,NULL),(208,'KI','Pacific/Enderbury','13.00','13.00','13.00',NULL,NULL),(209,'KI','Pacific/Kiritimati','14.00','14.00','14.00',NULL,NULL),(210,'KI','Pacific/Tarawa','12.00','12.00','12.00',NULL,NULL),(211,'KM','Indian/Comoro','3.00','3.00','3.00',NULL,NULL),(212,'KN','America/St_Kitts','-4.00','-4.00','-4.00',NULL,NULL),(213,'KP','Asia/Pyongyang','9.00','9.00','9.00',NULL,NULL),(214,'KR','Asia/Seoul','9.00','9.00','9.00',NULL,NULL),(215,'KW','Asia/Kuwait','3.00','3.00','3.00',NULL,NULL),(216,'KY','America/Cayman','-5.00','-5.00','-5.00',NULL,NULL),(217,'KZ','Asia/Almaty','6.00','6.00','6.00',NULL,NULL),(218,'KZ','Asia/Aqtau','5.00','5.00','5.00',NULL,NULL),(219,'KZ','Asia/Aqtobe','5.00','5.00','5.00',NULL,NULL),(220,'KZ','Asia/Oral','5.00','5.00','5.00',NULL,NULL),(221,'KZ','Asia/Qyzylorda','6.00','6.00','6.00',NULL,NULL),(222,'LA','Asia/Vientiane','7.00','7.00','7.00',NULL,NULL),(223,'LB','Asia/Beirut','2.00','3.00','2.00',NULL,NULL),(224,'LC','America/St_Lucia','-4.00','-4.00','-4.00',NULL,NULL),(225,'LI','Europe/Vaduz','1.00','2.00','1.00',NULL,NULL),(226,'LK','Asia/Colombo','5.50','5.50','5.50',NULL,NULL),(227,'LR','Africa/Monrovia','0.00','0.00','0.00',NULL,NULL),(228,'LS','Africa/Maseru','2.00','2.00','2.00',NULL,NULL),(229,'LT','Europe/Vilnius','2.00','3.00','2.00',NULL,NULL),(230,'LU','Europe/Luxembourg','1.00','2.00','1.00',NULL,NULL),(231,'LV','Europe/Riga','2.00','3.00','2.00',NULL,NULL),(232,'LY','Africa/Tripoli','2.00','2.00','2.00',NULL,NULL),(233,'MA','Africa/Casablanca','0.00','0.00','0.00',NULL,NULL),(234,'MC','Europe/Monaco','1.00','2.00','1.00',NULL,NULL),(235,'MD','Europe/Chisinau','2.00','3.00','2.00',NULL,NULL),(236,'ME','Europe/Podgorica','1.00','2.00','1.00',NULL,NULL),(237,'MF','America/Marigot','-4.00','-4.00','-4.00',NULL,NULL),(238,'MG','Indian/Antananarivo','3.00','3.00','3.00',NULL,NULL),(239,'MH','Pacific/Kwajalein','12.00','12.00','12.00',NULL,NULL),(240,'MH','Pacific/Majuro','12.00','12.00','12.00',NULL,NULL),(241,'MK','Europe/Skopje','1.00','2.00','1.00',NULL,NULL),(242,'ML','Africa/Bamako','0.00','0.00','0.00',NULL,NULL),(243,'MM','Asia/Rangoon','6.50','6.50','6.50',NULL,NULL),(244,'MN','Asia/Choibalsan','8.00','8.00','8.00',NULL,NULL),(245,'MN','Asia/Hovd','7.00','7.00','7.00',NULL,NULL),(246,'MN','Asia/Ulaanbaatar','8.00','8.00','8.00',NULL,NULL),(247,'MO','Asia/Macau','8.00','8.00','8.00',NULL,NULL),(248,'MP','Pacific/Saipan','10.00','10.00','10.00',NULL,NULL),(249,'MQ','America/Martinique','-4.00','-4.00','-4.00',NULL,NULL),(250,'MR','Africa/Nouakchott','0.00','0.00','0.00',NULL,NULL),(251,'MS','America/Montserrat','-4.00','-4.00','-4.00',NULL,NULL),(252,'MT','Europe/Malta','1.00','2.00','1.00',NULL,NULL),(253,'MU','Indian/Mauritius','4.00','4.00','4.00',NULL,NULL),(254,'MV','Indian/Maldives','5.00','5.00','5.00',NULL,NULL),(255,'MW','Africa/Blantyre','2.00','2.00','2.00',NULL,NULL),(256,'MX','America/Bahia_Banderas','-6.00','-5.00','-6.00',NULL,NULL),(257,'MX','America/Cancun','-6.00','-5.00','-6.00',NULL,NULL),(258,'MX','America/Chihuahua','-7.00','-6.00','-7.00',NULL,NULL),(259,'MX','America/Hermosillo','-7.00','-7.00','-7.00',NULL,NULL),(260,'MX','America/Matamoros','-6.00','-5.00','-6.00',NULL,NULL),(261,'MX','America/Mazatlan','-7.00','-6.00','-7.00',NULL,NULL),(262,'MX','America/Merida','-6.00','-5.00','-6.00',NULL,NULL),(263,'MX','America/Mexico_City','-6.00','-5.00','-6.00',NULL,NULL),(264,'MX','America/Monterrey','-6.00','-5.00','-6.00',NULL,NULL),(265,'MX','America/Ojinaga','-7.00','-6.00','-7.00',NULL,NULL),(266,'MX','America/Santa_Isabel','-8.00','-7.00','-8.00',NULL,NULL),(267,'MX','America/Tijuana','-8.00','-7.00','-8.00',NULL,NULL),(268,'MY','Asia/Kuala_Lumpur','8.00','8.00','8.00',NULL,NULL),(269,'MY','Asia/Kuching','8.00','8.00','8.00',NULL,NULL),(270,'MZ','Africa/Maputo','2.00','2.00','2.00',NULL,NULL),(271,'NA','Africa/Windhoek','2.00','1.00','1.00',NULL,NULL),(272,'NC','Pacific/Noumea','11.00','11.00','11.00',NULL,NULL),(273,'NE','Africa/Niamey','1.00','1.00','1.00',NULL,NULL),(274,'NF','Pacific/Norfolk','11.50','11.50','11.50',NULL,NULL),(275,'NG','Africa/Lagos','1.00','1.00','1.00',NULL,NULL),(276,'NI','America/Managua','-6.00','-6.00','-6.00',NULL,NULL),(277,'NL','Europe/Amsterdam','1.00','2.00','1.00',NULL,NULL),(278,'NO','Europe/Oslo','1.00','2.00','1.00',NULL,NULL),(279,'NP','Asia/Kathmandu','5.75','5.75','5.75',NULL,NULL),(280,'NR','Pacific/Nauru','12.00','12.00','12.00',NULL,NULL),(281,'NU','Pacific/Niue','-11.00','-11.00','-11.00',NULL,NULL),(282,'NZ','Pacific/Auckland','13.00','12.00','12.00',NULL,NULL),(283,'NZ','Pacific/Chatham','13.75','12.75','12.75',NULL,NULL),(284,'OM','Asia/Muscat','4.00','4.00','4.00',NULL,NULL),(285,'PA','America/Panama','-5.00','-5.00','-5.00',NULL,NULL),(286,'PE','America/Lima','-5.00','-5.00','-5.00',NULL,NULL),(287,'PF','Pacific/Gambier','-9.00','-9.00','-9.00',NULL,NULL),(288,'PF','Pacific/Marquesas','-9.50','-9.50','-9.50',NULL,NULL),(289,'PF','Pacific/Tahiti','-10.00','-10.00','-10.00',NULL,NULL),(290,'PG','Pacific/Port_Moresby','10.00','10.00','10.00',NULL,NULL),(291,'PH','Asia/Manila','8.00','8.00','8.00',NULL,NULL),(292,'PK','Asia/Karachi','5.00','5.00','5.00',NULL,NULL),(293,'PL','Europe/Warsaw','1.00','2.00','1.00',NULL,NULL),(294,'PM','America/Miquelon','-3.00','-2.00','-3.00',NULL,NULL),(295,'PN','Pacific/Pitcairn','-8.00','-8.00','-8.00',NULL,NULL),(296,'PR','America/Puerto_Rico','-4.00','-4.00','-4.00',NULL,NULL),(297,'PS','Asia/Gaza','2.00','3.00','2.00',NULL,NULL),(298,'PS','Asia/Hebron','2.00','3.00','2.00',NULL,NULL),(299,'PT','Atlantic/Azores','-1.00','0.00','-1.00',NULL,NULL),(300,'PT','Atlantic/Madeira','0.00','1.00','0.00',NULL,NULL),(301,'PT','Europe/Lisbon','0.00','1.00','0.00',NULL,NULL),(302,'PW','Pacific/Palau','9.00','9.00','9.00',NULL,NULL),(303,'PY','America/Asuncion','-3.00','-4.00','-4.00',NULL,NULL),(304,'QA','Asia/Qatar','3.00','3.00','3.00',NULL,NULL),(305,'RE','Indian/Reunion','4.00','4.00','4.00',NULL,NULL),(306,'RO','Europe/Bucharest','2.00','3.00','2.00',NULL,NULL),(307,'RS','Europe/Belgrade','1.00','2.00','1.00',NULL,NULL),(308,'RU','Asia/Anadyr','12.00','12.00','12.00',NULL,NULL),(309,'RU','Asia/Irkutsk','9.00','9.00','9.00',NULL,NULL),(310,'RU','Asia/Kamchatka','12.00','12.00','12.00',NULL,NULL),(311,'RU','Asia/Khandyga','10.00','10.00','10.00',NULL,NULL),(312,'RU','Asia/Krasnoyarsk','8.00','8.00','8.00',NULL,NULL),(313,'RU','Asia/Magadan','12.00','12.00','12.00',NULL,NULL),(314,'RU','Asia/Novokuznetsk','7.00','7.00','7.00',NULL,NULL),(315,'RU','Asia/Novosibirsk','7.00','7.00','7.00',NULL,NULL),(316,'RU','Asia/Omsk','7.00','7.00','7.00',NULL,NULL),(317,'RU','Asia/Sakhalin','11.00','11.00','11.00',NULL,NULL),(318,'RU','Asia/Ust-Nera','11.00','11.00','11.00',NULL,NULL),(319,'RU','Asia/Vladivostok','11.00','11.00','11.00',NULL,NULL),(320,'RU','Asia/Yakutsk','10.00','10.00','10.00',NULL,NULL),(321,'RU','Asia/Yekaterinburg','6.00','6.00','6.00',NULL,NULL),(322,'RU','Europe/Kaliningrad','3.00','3.00','3.00',NULL,NULL),(323,'RU','Europe/Moscow','4.00','4.00','4.00',NULL,NULL),(324,'RU','Europe/Samara','4.00','4.00','4.00',NULL,NULL),(325,'RU','Europe/Volgograd','4.00','4.00','4.00',NULL,NULL),(326,'RW','Africa/Kigali','2.00','2.00','2.00',NULL,NULL),(327,'SA','Asia/Riyadh','3.00','3.00','3.00',NULL,NULL),(328,'SB','Pacific/Guadalcanal','11.00','11.00','11.00',NULL,NULL),(329,'SC','Indian/Mahe','4.00','4.00','4.00',NULL,NULL),(330,'SD','Africa/Khartoum','3.00','3.00','3.00',NULL,NULL),(331,'SE','Europe/Stockholm','1.00','2.00','1.00',NULL,NULL),(332,'SG','Asia/Singapore','8.00','8.00','8.00',NULL,NULL),(333,'SH','Atlantic/St_Helena','0.00','0.00','0.00',NULL,NULL),(334,'SI','Europe/Ljubljana','1.00','2.00','1.00',NULL,NULL),(335,'SJ','Arctic/Longyearbyen','1.00','2.00','1.00',NULL,NULL),(336,'SK','Europe/Bratislava','1.00','2.00','1.00',NULL,NULL),(337,'SL','Africa/Freetown','0.00','0.00','0.00',NULL,NULL),(338,'SM','Europe/San_Marino','1.00','2.00','1.00',NULL,NULL),(339,'SN','Africa/Dakar','0.00','0.00','0.00',NULL,NULL),(340,'SO','Africa/Mogadishu','3.00','3.00','3.00',NULL,NULL),(341,'SR','America/Paramaribo','-3.00','-3.00','-3.00',NULL,NULL),(342,'SS','Africa/Juba','3.00','3.00','3.00',NULL,NULL),(343,'ST','Africa/Sao_Tome','0.00','0.00','0.00',NULL,NULL),(344,'SV','America/El_Salvador','-6.00','-6.00','-6.00',NULL,NULL),(345,'SX','America/Lower_Princes','-4.00','-4.00','-4.00',NULL,NULL),(346,'SY','Asia/Damascus','2.00','3.00','2.00',NULL,NULL),(347,'SZ','Africa/Mbabane','2.00','2.00','2.00',NULL,NULL),(348,'TC','America/Grand_Turk','-5.00','-4.00','-5.00',NULL,NULL),(349,'TD','Africa/Ndjamena','1.00','1.00','1.00',NULL,NULL),(350,'TF','Indian/Kerguelen','5.00','5.00','5.00',NULL,NULL),(351,'TG','Africa/Lome','0.00','0.00','0.00',NULL,NULL),(352,'TH','Asia/Bangkok','7.00','7.00','7.00',NULL,NULL),(353,'TJ','Asia/Dushanbe','5.00','5.00','5.00',NULL,NULL),(354,'TK','Pacific/Fakaofo','13.00','13.00','13.00',NULL,NULL),(355,'TL','Asia/Dili','9.00','9.00','9.00',NULL,NULL),(356,'TM','Asia/Ashgabat','5.00','5.00','5.00',NULL,NULL),(357,'TN','Africa/Tunis','1.00','1.00','1.00',NULL,NULL),(358,'TO','Pacific/Tongatapu','13.00','13.00','13.00',NULL,NULL),(359,'TR','Europe/Istanbul','2.00','3.00','2.00',NULL,NULL),(360,'TT','America/Port_of_Spain','-4.00','-4.00','-4.00',NULL,NULL),(361,'TV','Pacific/Funafuti','12.00','12.00','12.00',NULL,NULL),(362,'TW','Asia/Taipei','8.00','8.00','8.00',NULL,NULL),(363,'TZ','Africa/Dar_es_Salaam','3.00','3.00','3.00',NULL,NULL),(364,'UA','Europe/Kiev','2.00','3.00','2.00',NULL,NULL),(365,'UA','Europe/Simferopol','2.00','4.00','4.00',NULL,NULL),(366,'UA','Europe/Uzhgorod','2.00','3.00','2.00',NULL,NULL),(367,'UA','Europe/Zaporozhye','2.00','3.00','2.00',NULL,NULL),(368,'UG','Africa/Kampala','3.00','3.00','3.00',NULL,NULL),(369,'UM','Pacific/Johnston','-10.00','-10.00','-10.00',NULL,NULL),(370,'UM','Pacific/Midway','-11.00','-11.00','-11.00',NULL,NULL),(371,'UM','Pacific/Wake','12.00','12.00','12.00',NULL,NULL),(372,'US','America/Adak','-10.00','-9.00','-10.00',NULL,NULL),(373,'US','America/Anchorage','-9.00','-8.00','-9.00',NULL,NULL),(374,'US','America/Boise','-7.00','-6.00','-7.00',NULL,NULL),(375,'US','America/Chicago','-6.00','-5.00','-6.00',NULL,NULL),(376,'US','America/Denver','-7.00','-6.00','-7.00',NULL,NULL),(377,'US','America/Detroit','-5.00','-4.00','-5.00',NULL,NULL),(378,'US','America/Indiana/Indianapolis','-5.00','-4.00','-5.00',NULL,NULL),(379,'US','America/Indiana/Knox','-6.00','-5.00','-6.00',NULL,NULL),(380,'US','America/Indiana/Marengo','-5.00','-4.00','-5.00',NULL,NULL),(381,'US','America/Indiana/Petersburg','-5.00','-4.00','-5.00',NULL,NULL),(382,'US','America/Indiana/Tell_City','-6.00','-5.00','-6.00',NULL,NULL),(383,'US','America/Indiana/Vevay','-5.00','-4.00','-5.00',NULL,NULL),(384,'US','America/Indiana/Vincennes','-5.00','-4.00','-5.00',NULL,NULL),(385,'US','America/Indiana/Winamac','-5.00','-4.00','-5.00',NULL,NULL),(386,'US','America/Juneau','-9.00','-8.00','-9.00',NULL,NULL),(387,'US','America/Kentucky/Louisville','-5.00','-4.00','-5.00',NULL,NULL),(388,'US','America/Kentucky/Monticello','-5.00','-4.00','-5.00',NULL,NULL),(389,'US','America/Los_Angeles','-8.00','-7.00','-8.00',NULL,NULL),(390,'US','America/Menominee','-6.00','-5.00','-6.00',NULL,NULL),(391,'US','America/Metlakatla','-8.00','-8.00','-8.00',NULL,NULL),(392,'US','America/New_York','-5.00','-4.00','-5.00',NULL,NULL),(393,'US','America/Nome','-9.00','-8.00','-9.00',NULL,NULL),(394,'US','America/North_Dakota/Beulah','-6.00','-5.00','-6.00',NULL,NULL),(395,'US','America/North_Dakota/Center','-6.00','-5.00','-6.00',NULL,NULL),(396,'US','America/North_Dakota/New_Salem','-6.00','-5.00','-6.00',NULL,NULL),(397,'US','America/Phoenix','-7.00','-7.00','-7.00',NULL,NULL),(398,'US','America/Shiprock','-7.00','-6.00','-7.00',NULL,NULL),(399,'US','America/Sitka','-9.00','-8.00','-9.00',NULL,NULL),(400,'US','America/Yakutat','-9.00','-8.00','-9.00',NULL,NULL),(401,'US','Pacific/Honolulu','-10.00','-10.00','-10.00',NULL,NULL),(402,'UY','America/Montevideo','-2.00','-3.00','-3.00',NULL,NULL),(403,'UZ','Asia/Samarkand','5.00','5.00','5.00',NULL,NULL),(404,'UZ','Asia/Tashkent','5.00','5.00','5.00',NULL,NULL),(405,'VA','Europe/Vatican','1.00','2.00','1.00',NULL,NULL),(406,'VC','America/St_Vincent','-4.00','-4.00','-4.00',NULL,NULL),(407,'VE','America/Caracas','-4.50','-4.50','-4.50',NULL,NULL),(408,'VG','America/Tortola','-4.00','-4.00','-4.00',NULL,NULL),(409,'VI','America/St_Thomas','-4.00','-4.00','-4.00',NULL,NULL),(410,'VN','Asia/Ho_Chi_Minh','7.00','7.00','7.00',NULL,NULL),(411,'VU','Pacific/Efate','11.00','11.00','11.00',NULL,NULL),(412,'WF','Pacific/Wallis','12.00','12.00','12.00',NULL,NULL),(413,'WS','Pacific/Apia','14.00','13.00','13.00',NULL,NULL),(414,'YE','Asia/Aden','3.00','3.00','3.00',NULL,NULL),(415,'YT','Indian/Mayotte','3.00','3.00','3.00',NULL,NULL),(416,'ZA','Africa/Johannesburg','2.00','2.00','2.00',NULL,NULL),(417,'ZM','Africa/Lusaka','2.00','2.00','2.00',NULL,NULL),(418,'ZW','Africa/Harare','2.00','2.00','2.00',NULL,NULL);
/*!40000 ALTER TABLE `timezones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `come_from` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `file` text COLLATE utf8mb4_unicode_ci,
  `amount` double NOT NULL DEFAULT '0',
  `payment_details` text COLLATE utf8mb4_unicode_ci,
  `trx_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `transactionable_id` bigint unsigned DEFAULT NULL,
  `transactionable_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid' COMMENT 'paid,unpaid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (1,'course',3,NULL,'cash',NULL,NULL,NULL,1000,NULL,'STU1001','2026-09-13',1,'course','paid','2026-09-12 23:02:27','2026-09-12 23:02:27'),(2,'book',3,NULL,'cash',NULL,NULL,NULL,500,NULL,'STU1002','2026-09-13',1,'book','paid','2026-09-12 23:02:27','2026-09-12 23:02:27');
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transfers`
--

DROP TABLE IF EXISTS `transfers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transfers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `date` datetime NOT NULL,
  `transfer_from` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transfer_to` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_account_id` bigint unsigned DEFAULT NULL,
  `to_account_id` bigint unsigned DEFAULT NULL,
  `from_bank_account_id` bigint unsigned DEFAULT NULL,
  `to_bank_account_id` bigint unsigned DEFAULT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transfers`
--

LOCK TABLES `transfers` WRITE;
/*!40000 ALTER TABLE `transfers` DISABLE KEYS */;
/*!40000 ALTER TABLE `transfers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_subscriptions`
--

DROP TABLE IF EXISTS `user_subscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_subscriptions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `package_solutions_id` bigint unsigned DEFAULT NULL,
  `price` double NOT NULL DEFAULT '0',
  `validity` int DEFAULT NULL,
  `upload_limit` int DEFAULT NULL,
  `add_limit` int DEFAULT NULL,
  `bundle` int DEFAULT NULL,
  `facilities` tinyint NOT NULL DEFAULT '1' COMMENT '1=yes, 0=no',
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
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone_country_id` bigint unsigned DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` json DEFAULT NULL,
  `user_type` enum('admin','stuff','instructor','student','organization-staff') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'student',
  `firebase_auth_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'this is for mobile app.',
  `currency_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'USD',
  `lang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0 inactive, 1 active',
  `images` text COLLATE utf8mb4_unicode_ci,
  `last_login` timestamp NULL DEFAULT NULL,
  `last_password_change` timestamp NULL DEFAULT NULL,
  `is_user_banned` tinyint NOT NULL DEFAULT '0' COMMENT '0 not banned, 1 banned',
  `is_deleted` tinyint NOT NULL DEFAULT '0' COMMENT '0 not delete, 1 deleted',
  `role_id` bigint unsigned DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` bigint unsigned DEFAULT NULL,
  `state_id` bigint unsigned DEFAULT NULL,
  `city_id` bigint unsigned DEFAULT NULL,
  `gender` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `about` text COLLATE utf8mb4_unicode_ci,
  `is_newsletter_enabled` tinyint NOT NULL DEFAULT '0' COMMENT '1=newsletter enable, 0= not newsletter enable',
  `is_notification_enabled` tinyint NOT NULL DEFAULT '0' COMMENT '1=Notification enable, 0= not Notification enable',
  `balance` double NOT NULL DEFAULT '0',
  `otp` int DEFAULT NULL,
  `onesignal_player_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_onesignal_subscribed` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'John','Doe','admin@spagreen.net','2026-09-12 23:02:19',19,'017111131111','$2y$10$Uk4TPUNbZTgN8K/XQ3taBepglrWZEATS73IwQvgEM43e17b7xbm3u','[\"roles.index\", \"roles.create\", \"roles.edit\", \"roles.destroy\", \"badges.create\", \"badges.edit\", \"badges.destroy\", \"blog-categories.index\", \"blog-categories.create\", \"blog-categories.edit\", \"blog-categories.destroy\", \"cities.create\", \"cities.edit\", \"cities.destroy\", \"contacts.create\", \"contacts.edit\", \"contacts.destroy\", \"coupons.index\", \"coupons.create\", \"coupons.store\", \"coupons.destroy\", \"languages.index\", \"languages.create\", \"languages.edit\", \"languages.destroy\", \"languages.update\", \"language.translations.page\", \"admin.language.key.update\", \"services.create\", \"services.edit\", \"services.destroy\", \"stats.create\", \"stats.edit\", \"stats.destroy\", \"staffs.create\", \"staffs.index\", \"staffs.edit\", \"roles.index\", \"delete\", \"staffs.change-role\", \"organizations.index\", \"organizations.show\", \"organizations.create\", \"organizations.edit\", \"organizations.store\", \"organizations.delete\", \"organizations.overview\", \"organizations.payment\", \"organizations.settings\", \"courses.organization\", \"instructors.organization\", \"organizations.payouts.method-setting-update\", \"pages.index\", \"pages.create\", \"pages.edit\", \"pages.destroy\", \"pages.update\", \"view_course_module\", \"courses.index\", \"courses.create\", \"courses.store\", \"course.publish\", \"courses.edit\", \"courses.destroy\", \"course.students\", \"course.statistics\", \"levels.create\", \"levels.edit\", \"levels.destroy\", \"tags.create\", \"tags.edit\", \"tags.destroy\", \"ai.writer\", \"category.create\", \"category.edit\", \"category.destroy\", \"subjects.create\", \"subjects.edit\", \"subjects.destroy\", \"sections.create\", \"sections.edit\", \"sections.destroy\", \"course.sections.order\", \"lessons.create\", \"lessons.edit\", \"lessons.destroy\", \"section.lessons.order\", \"faqs.create\", \"faqs.edit\", \"faqs.destroy\", \"assignments.create\", \"assignments.edit\", \"assignments.destroy\", \"quizzes.create\", \"quizzes.edit\", \"quizzes.destroy\", \"quiz-questions.create\", \"quiz-questions.edit\", \"quiz-questions.destroy\", \"books.edit\", \"books.destroy\", \"backend.admin.book.index\", \"expertise.create\", \"expertise.edit\", \"expertise.destroy\", \"instructors.index\", \"instructors.create\", \"instructors.edit\", \"instructors.show\", \"instructors.store\", \"instructors.update\", \"instructors.destroy\", \"live-classes.create\", \"live-classes.edit\", \"live-classes.destroy\", \"student-faqs.index\", \"students.index\", \"students.create\", \"students.edit\", \"students.destroy\", \"students.certificates\", \"students.instructors\", \"students.payments\", \"students.activity.logs\", \"students.load.course\", \"students.load.certificates\", \"blogs.index\", \"blogs.create\", \"blogs.edit\", \"blogs.destroy\", \"onboards.index\", \"onboards.create\", \"onboards.edit\", \"onboards.destroy\", \"apikeys.index\", \"apikeys.create\", \"apikeys.edit\", \"apikeys.destroy\", \"android.setting\", \"ios.setting\", \"mobile-settings.update\", \"mobile.home.screen\", \"sliders.index\", \"sliders.create\", \"sliders.edit\", \"sliders.destroy\", \"email.server-configuration\", \"email.server-configuration.update\", \"email.template\", \"auth-template.update\", \"media-library.index\", \"media-library.store\", \"media.destroy\", \"verified\", \"ban\", \"status\", \"delete\", \"media.destroy\", \"general.setting\", \"currencies.index\", \"currencies.index\", \"currencies.create\", \"currencies.edit\", \"currencies.destroy\", \"currencies.update\", \"currencies.default-currency\", \"set.currency.format\", \"admin.cache\", \"cache.update\", \"admin.firebase\", \"firebase.update\", \"storage.setting\", \"chat.messenger\", \"admin.refund\", \"miscellaneous.setting\", \"admin.miscellaneous.update\", \"ai_writer.setting\", \"preference\", \"storage.setting\", \"chat.messenger\", \"payouts.method-setting\", \"payment.gateway\", \"pusher.notification\", \"onesignal.notification\", \"custom-notification.index\", \"custom-notification.create\", \"custom-notification.edit\", \"custom-notification.destroy\", \"admin.panel-setting\", \"admin.panel-setting.update\", \"miscellaneous.setting\", \"admin.miscellaneous.update\", \"otp.setting\", \"sms.templates\", \"save.template\", \"backend.admin.report.book_sale\", \"backend.admin.report.course_sale\", \"backend.admin.report.commission_history\", \"backend.admin.report.payment_history\", \"backend.admin.report.payout_history\", \"backend.admin.report.wishlist\", \"home.page.builder\", \"update.home.page.builder\", \"website.themes\", \"theme.options\", \"update.themes\", \"website.cta\", \"website_setting.popup\", \"header.logo\", \"header.content\", \"website_setting.cta\", \"header.topbar\", \"header.menu\", \"hero.section\", \"website_setting.seo\", \"website_setting.google_setup\", \"website_setting.custom_css\", \"website_setting.fb_pixel\", \"website_setting.gdpr\", \"footer.content\", \"footer.social-links\", \"footer.newsletter-settings\", \"footer.useful-links\", \"footer.resource-links\", \"footer.quick-links\", \"footer.apps-links\", \"footer.payment-banner-settings\", \"footer.copyright\", \"footer.update-setting\", \"footer.update-menu\", \"website.popup\", \"website.seo\", \"google.setup\", \"custom.js\", \"custom.css\", \"custom.css.js\", \"fb.pixel\", \"gdpr\", \"success-stories.index\", \"success-stories.create\", \"success-stories.edit\", \"success-stories.destroy\", \"testimonials.index\", \"testimonials.create\", \"testimonials.edit\", \"testimonials.destroy\", \"brands.index\", \"brands.create\", \"brands.edit\", \"brands.destroy\", \"subscribers.index\", \"subscribers.create\", \"subscribers.destroy\", \"bulk.sms\", \"server.info\", \"system.info\", \"extension.library\", \"file.system.permission\", \"system.update\", \"tickets.index\", \"tickets.create\", \"tickets.update\", \"ticket.reply\", \"ticket.reply.edit\", \"ticket.reply.update\", \"ticket.reply.delete\", \"departments.index\", \"departments.create\", \"departments.edit\", \"departments.destroy\", \"packages.create\", \"packages.edit\", \"packages.destroy\", \"packages.subscribe\", \"bank-accounts.index\", \"accounts.index\", \"accounts.create\", \"accounts.edit\", \"accounts.destroy\", \"backend.admin.account.transaction_history\", \"incomes.index\", \"income.create\", \"income.edit\", \"income.destroy\", \"expenses.index\", \"expense.create\", \"expense.edit\", \"expense.destroy\", \"transfers.index\", \"transfer.create\", \"transfer.edit\", \"transfer.destroy\", \"deposit.create\", \"deposit.edit\", \"deposit.destroy\", \"payouts.index\", \"payouts.create\", \"payouts.edit\", \"payouts.destroy\", \"payouts.method-setting\", \"payouts.method-setting-update\", \"payouts.complete\", \"payouts.approved\", \"payouts.declined\", \"categories.index\", \"categories.create\", \"categories.edit\", \"categories.destroy\", \"expertise.index\", \"expertises.create\", \"expertises.edit\", \"expertises.destroy\", \"admin.dashboard\", \"dashboard_statistic\", \"view_enrolment_statistic\", \"view_total_earning\", \"view_total_organization\", \"view_total_course\", \"new_student_count\", \"view_new_course_count\", \"total_sale_statistic\", \"total_student_statistic\", \"recent_payout_list\", \"best_selling_course_list\", \"best_instructor_list\", \"view_manpower_information\", \"sale_information\", \"view_earning_statistic\", \"addon.index\", \"addon.create\", \"addon.edit\", \"addon.destroy\", \"addon.index\", \"manage_course\", \"manage_student\", \"manage_instructor\", \"manage_staff\", \"mnage_certificate\", \"manage_statement\", \"finance\", \"system.update\", \"server.info\", \"system.info\", \"extension.library\", \"file.system.permission\"]','admin',NULL,'USD','en',1,'{\"storage\":\"local\",\"original_image\":\"images\\/20260913175711-_staff_43.jpg\",\"image_40x40\":\"images\\/20260913175711image_40X40_staff_222.jpg\",\"image_80x80\":\"images\\/20260913175711image_80X80_staff_243.jpg\",\"image_100x100\":\"images\\/20260913175711image_100X100_staff_340.jpg\",\"image_210x210\":\"images\\/20260913175711image_210X210_staff_274.jpg\"}',NULL,NULL,0,0,1,'Dhaka, Bangladesh',NULL,NULL,NULL,NULL,'male','1970-01-01','System Administrator',0,0,0,NULL,NULL,0,'ejy7L4rI0a32u07Alqrzc7zHE9jZySf49C9LE7dMhBsUWCFJKwpMKSmujrzq','2026-09-12 23:02:19','2026-09-13 11:57:11'),(2,'Jane','Smith','instructor@spagreen.net','2026-09-12 23:02:19',NULL,'017111132111','$2y$10$DJ3md8WcsaStZpNNBtJ14eVObZ4rU9sw0kh4Umyn3HRZO4b8eqOkW','[\"instructors.create\", \"instructors.edit\", \"payouts.create\", \"payouts.edit\", \"payouts.destroy\", \"payouts.method-setting\", \"payouts.method-setting-update\", \"students.create\", \"students.show\", \"students.edit\", \"students.certificates\", \"students.instructors\", \"students.payments\", \"students.activity.logs\", \"students.load.course\", \"students.load.certificates\", \"courses.organization\", \"courses.create\", \"courses.destroy\", \"course.students\", \"course.statistics\", \"sections.create\", \"sections.edit\", \"sections.destroy\", \"course.sections.order\", \"lessons.create\", \"lessons.edit\", \"lessons.destroy\", \"section.lessons.order\", \"faqs.create\", \"faqs.create\", \"faqs.edit\", \"faqs.destroy\", \"assignments.create\", \"assignments.edit\", \"assignments.destroy\", \"quizzes.create\", \"quizzes.edit\", \"quizzes.destroy\", \"quiz-questions.create\", \"quiz-questions.edit\", \"quiz-questions.destroy\", \"expertise.create\", \"expertise.edit\", \"expertise.destroy\"]','instructor',NULL,'USD','en',1,NULL,NULL,NULL,0,0,2,'Dhaka, Bangladesh',NULL,NULL,NULL,NULL,'female','1970-01-01','Experienced Educator in Computer Science and Programming.',0,0,0,NULL,NULL,0,NULL,'2026-09-12 23:02:19','2026-09-12 23:02:27'),(3,'Michael','Johnson','student@spagreen.net','2026-09-12 23:02:19',NULL,'017116546511111','$2y$10$mHzHQZnU4KX78GwmgdVIMufiZoQJXlZ2UfwS94VuD8XD8kF0fLrK2',NULL,'student',NULL,'USD','en',1,NULL,NULL,NULL,0,0,3,'Dhaka, Bangladesh',NULL,NULL,NULL,NULL,'male','1970-01-01','Enthusiastic student looking to learn new skills.',0,0,0,NULL,NULL,0,NULL,'2026-09-12 23:02:19','2026-09-12 23:02:19'),(4,'Sarah','Connor','staff@spagreen.net','2026-09-12 23:02:19',NULL,'0171153411111','$2y$10$FyIngBE9Ku72FwB0Pbn4m.v2/ocD2gHpq74iJIbIwQZgoItLzKUKW','[\"admin.dashboard\"]','stuff',NULL,'USD','en',1,NULL,NULL,NULL,0,0,4,'Dhaka, Bangladesh',NULL,NULL,NULL,NULL,'female','1970-01-01','Support Staff',0,0,0,NULL,NULL,0,NULL,'2026-09-12 23:02:19','2026-09-12 23:02:20'),(5,'Organization','Staff','org_staff@spagreen.net','2026-09-12 23:02:19',NULL,'0171153411111','$2y$10$xuFiK9DJFUaBrW5ugakmWO60dtsg0zeBhZ8.H0FKydID15EUzW8v.',NULL,'organization-staff',NULL,'USD','en',1,NULL,NULL,NULL,0,0,5,'Dhaka, Bangladesh',NULL,NULL,NULL,NULL,'male','1970-01-01','Organization Support',0,0,0,NULL,NULL,0,NULL,'2026-09-12 23:02:19','2026-09-12 23:02:19'),(6,'Md. Tanvir Hasan Tonmoy',NULL,'info.tonmoyorg@gmail.com','2026-09-13 12:08:23',NULL,'01609804993','$2y$10$mkQ/thBsEWQnC58f2esCtemrBzj2XoSr80ze3bZAKDvWMT.etayYu',NULL,'student',NULL,'USD','en',1,NULL,NULL,NULL,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,NULL,NULL,0,NULL,'2026-09-13 12:08:23','2026-09-13 12:08:23');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wallets`
--

DROP TABLE IF EXISTS `wallets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wallets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `walletable_id` bigint unsigned DEFAULT NULL,
  `walletable_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `source` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_details` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `offline_method_id` bigint unsigned DEFAULT NULL,
  `trx_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0 inactive, 1 active',
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
-- Table structure for table `wishlists`
--

DROP TABLE IF EXISTS `wishlists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wishlists` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `wishable_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `wishable_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wishlists`
--

LOCK TABLES `wishlists` WRITE;
/*!40000 ALTER TABLE `wishlists` DISABLE KEYS */;
INSERT INTO `wishlists` VALUES (1,'App\\Models\\Course',1,1,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(2,'App\\Models\\Course',1,2,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(3,'App\\Models\\Course',1,3,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(4,'App\\Models\\Course',1,4,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(5,'App\\Models\\Course',1,5,'2026-09-12 23:02:27','2026-09-12 23:02:27'),(6,'App\\Models\\Book',1,1,'2026-09-12 23:02:27','2026-09-12 23:02:27');
/*!40000 ALTER TABLE `wishlists` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-09-14  3:05:16
