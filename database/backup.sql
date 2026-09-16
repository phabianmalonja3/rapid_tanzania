-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: rapidtanzania_db
-- ------------------------------------------------------
-- Server version	8.0.40

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
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('0b1841cd4b37d9e2df4d0c4a287ff0f9ea781e96','i:6;',1763475673),('0b1841cd4b37d9e2df4d0c4a287ff0f9ea781e96:timer','i:1763475673;',1763475673),('5c785c036466adea360111aa28563bfd556b5fba','i:1;',1763480984),('5c785c036466adea360111aa28563bfd556b5fba:timer','i:1763480984;',1763480984),('80e28a51cbc26fa4bd34938c5e593b36146f5e0c','i:1;',1763480765),('80e28a51cbc26fa4bd34938c5e593b36146f5e0c:timer','i:1763480765;',1763480765);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'HUMANITARIAN AND RELIEF','humanitarian-and-relief','2025-11-12 09:27:47','2025-11-12 09:29:15'),(2,'COMMUNITY EMPOWERMENT PROGRAM (CEP)','community-empowerment-program-cep','2025-11-12 09:37:15','2025-11-12 09:37:15'),(3,'kawawa','kawawa','2025-11-16 06:20:34','2025-11-16 06:20:34');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `events` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_at` date NOT NULL,
  `end_date` date NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auth_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `images` json DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `events_auth_id_foreign` (`auth_id`),
  CONSTRAINT `events_auth_id_foreign` FOREIGN KEY (`auth_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (9,'Noelle Fitzgerald','Ea dicta in et ea of','2025-11-27','2025-11-30','Cumque ut consequat',54,'2025-11-16 04:06:51','2025-11-16 05:31:23','[\"events/images/vJ5dC8c4CSpba79CGlvuJnFjKYV1tjJldQCZFZ8P.jpg\"]','noelle-fitzgerald'),(10,'Gail Travis','Culpa voluptates qu','1975-04-09','2001-03-09','Officiis odit ad qui',54,'2025-11-16 05:26:52','2025-11-16 05:26:52','[\"events/images/I3DbMu864gpTzNA1Z1Aosmn2U1br4Vc2Eonnr4Vt.jpg\"]','gail-travis'),(11,'Ivana Ayers','Currently the organization has more than 50 members from different professions background, including Engineers, Architects, Environmentalist, Social scientists, Epidemiologist, Medical, doctors, Lawyers, Town and Urban planners, Economists, Social workers, Psychologist etc. who have been trained in disaster management. RAPID – Tanzania also work closely with volunteer’s groups and organizations and government departments dealing with Disaster Management.','1981-10-15','1983-02-17','Autem sunt anim plac',54,'2025-11-18 11:51:13','2025-11-18 11:51:13','[\"events/images/6pLcIR0VQdy9LbRjIjsjpKB5KTv23Cp0WSGlXoPx.png\", \"events/images/cL6GrjQMio2kWE2fp7qPMdOg6VchcPovAOrCnvJ8.jpg\", \"events/images/pSVJGw6JvS9zsYJMsrkJSTkvxfm9GY6ABRSLeDkV.png\", \"events/images/l3g38JWgMlLnJmpAPEe4b9eQj9c4DDn3kbbAg6Fw.png\", \"events/images/3Tvk5tsftf2OhENAABVC4an5S6DeRWHm5nFQUm5a.png\"]','ivana-ayers'),(12,'Allegra Patel','Et atque aute in vol','2001-07-15','2025-11-18','Est magna veniam qu',54,'2025-11-18 11:57:33','2025-11-18 11:57:33','[\"events/images/U81a4OFEdPqT2QfFFWukuiA1RaXwqZKF71qL79Pz.png\", \"events/images/UORUNo6og854oXCC28LxO9NVGOEFLI9H464XWkN1.png\", \"events/images/X0gXV3O9ZTU3kI97ZtGUCEX6PYst0jnykEPevAtf.png\", \"events/images/YHyucwWzq8YDV9tXQZPivWgYeeYw6nwsjGajjEoS.jpg\", \"events/images/4BouleUexDqhaLYEKVnBPpVSEC3BJ8HQjFj4okAj.png\"]','allegra-patel'),(13,'Allegra Patel','Et atque aute in vol','2001-07-15','2025-11-18','Est magna veniam qu',54,'2025-11-18 11:59:07','2025-11-18 11:59:07','[\"events/images/EIQcCMhP0GdMFT0vfMQMEpH2SSdiYl0VQJo7TrWS.png\", \"events/images/oJdjmU8ftq1Jh0D9RRJwRt5XAtJP3mP1QtX42cxE.png\", \"events/images/w1ES57BWRc3mKomnUq0fDTyr8HGU5GznBhV9oiw2.png\", \"events/images/PTyB6vQoBFp5Q4cySr0dAmosylSVjqqGHkQpTnLl.jpg\", \"events/images/NlX6gLuE56PMkrOhFX8dIbOMkQX7cE9qs84JS8Lg.png\"]','allegra-patel'),(14,'Allegra Patel','Et atque aute in vol','2001-07-15','2025-11-18','Est magna veniam qu',54,'2025-11-18 11:59:26','2025-11-18 11:59:26','[\"events/images/AFFqcjIQgLXyoSYejbSuB8CUVTBuihAJqfGX3HZo.png\", \"events/images/27r3LkadjFQFe77D4GgkxsJZujTfI13kCtp4AeQD.png\", \"events/images/f2hSjJl20cYevVZb1rbVMMc7JI69YgjylkMzZqRJ.png\", \"events/images/hi8rzPCyHQz9oiIzTG7burdauoKyI4PqUJ4RIdE2.jpg\", \"events/images/pf9cGpMX8H6FDSpC9IOJhpiqwzt1b8TX8kZwmODO.png\"]','allegra-patel'),(15,'2022 - 2025 - Fire emergency preparedness in school','Currently the organization has more than 50 members from different professions background, including Engineers, Architects, Environmentalist, Social scientists, Epidemiologist, Medical, doctors, Lawyers, Town and Urban planners, Economists, Social workers, Psychologist etc. who have been trained in disaster management. RAPID – Tanzania also work closely with volunteer’s groups and organizations and government departments dealing with Disaster Management.','2025-11-14','2025-11-30','Velit autem minima i',54,'2025-11-18 12:10:36','2025-11-18 12:24:47','[\"events/images/ogSbkiRLM5K723q6mWoLYnmJDGCoDCRX3iQcnaej.jpg\", \"events/images/qmchW7B7ULJSPCrpcq40qJxgqJXbxg56uEdODhdE.png\", \"events/images/tMmjTmZCxVWTGb0Tf3hSfj6ePf9lSvDUDt5Oskt4.png\", \"events/images/yFck2s1h89yC5EgIo6byP9BZpRvlwc5OvZUEP0Wd.jpg\", \"events/images/zxsp9rp7SSjOWoR0nzjR7eUAcwgKWhAH4mkmbUTy.png\", \"events/images/7i2NfrVrtAsKmvhn1RTzJpD0PPs5AvmY1LR9giRD.jpg\", \"events/images/S1dlsJx5CKnQMarDL8NtnTnu4KvFXtEmM4vyWkrO.png\", \"events/images/y8RksNUORS5N0udaraXC0JAMv85ZvRNuchcHdidS.png\", \"events/images/GqGocskVB4gbcRm1Rx7zlZ1zeesamNomNmQp1rvX.png\"]','2022-2025-fire-emergency-preparedness-in-school');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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

/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
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

/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `members` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `position_id` bigint unsigned NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (10,'hamis rajabu','members/images/NAgesLQhMuFnfQIp4D6jphS50JDMKlrQVkiVS5pR.jpg','2025-11-16 06:14:14','2025-11-16 06:14:14',3,'hamis-rajabu');
/*!40000 ALTER TABLE `members` ENABLE KEYS */;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_10_28_185258_create_permission_tables',1),(5,'2025_10_29_084107_create_projects_table',1),(6,'2025_10_29_085020_create_events_table',1),(7,'2025_10_29_085339_create_posts_table',1),(8,'2025_10_31_164839_create_personal_access_tokens_table',2),(9,'2025_11_02_233225_add_names_to_users_table',3),(10,'2025_04_05_135411_create_words_table',4),(11,'2025_11_06_035359_add_profile_img_to_users',4),(12,'2025_11_06_132218_create_permission_tables',5),(13,'2025_11_06_204502_create_members_table',6),(14,'2025_11_06_213512_create_positions_table',7),(15,'2025_11_07_140940_create_tests_table',8),(16,'2025_11_07_232244_create_org_clients_table',9),(17,'2025_11_08_005626_add_images_to_events_table',10),(18,'2025_11_08_134115_add_bio_to_users_table',11),(19,'2025_11_09_125003_add_description_to_positions_table',12),(20,'2025_11_09_152007_create_projects_table',13),(21,'2025_11_09_154833_add_status_to_projects_table',14),(22,'2025_11_12_114358_create_categories_table',15),(23,'2025_11_12_115120_add_category_id_to_projects_table',15),(24,'2025_11_13_103634_add_images_to_events_table',16),(25,'2025_11_15_071032_create_seo_table',17),(26,'2025_11_16_081331_add_slugs_to_events_table',18),(27,'2025_11_16_083703_add_slugs_to_projects_table',19),(28,'2025_11_16_085355_add_slugs_to_members_table',20),(29,'2025_11_16_085627_add_slugs_to_org_clients_table',20),(30,'2025_11_16_094137_add_slugs_to_users_table',21),(31,'2025_11_16_122813_add_slugs_to_positions_table',22),(32,'2025_11_18_112815_update_description_column_in_events_table',23);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\User',54);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;

--
-- Table structure for table `org_clients`
--

DROP TABLE IF EXISTS `org_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `org_clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `org_clients`
--

/*!40000 ALTER TABLE `org_clients` DISABLE KEYS */;
INSERT INTO `org_clients` VALUES (7,'Kituja','clients/images/KlVfXy1IJf6FMUljxQs5WtOajTmszbumj5qcpGtX.png','2025-11-13 08:35:37','2025-11-13 08:35:37',NULL),(8,'TCRS','clients/images/4MwstcKtfuQTlVAk4Azik8zoTAh5nEdFyqFTQHeS.png','2025-11-13 08:37:36','2025-11-13 08:37:36',NULL),(9,'SISI TANZANIA','clients/images/s6Ph2nFVVh2IIoyWSCfz7c0H9lGGH8sTmhRYIpem.png','2025-11-13 08:38:08','2025-11-13 08:38:08',NULL),(10,'SUKOS','clients/images/WR5Z4kjzbXPzA00OlhmNZuu03o2eW7VyVCxnbWN4.png','2025-11-13 08:38:31','2025-11-13 08:38:31',NULL),(11,'HUDEFU','clients/images/PcF7kJEk5YGwOLW9iivpZgBpMd0Z4ogzyM392rhw.png','2025-11-13 08:42:21','2025-11-13 08:42:21',NULL),(12,'ART IN TANZANIA','clients/images/2Aeek7LJcWaVZ27YoHlRtSu518wtUxRhcFyHXRfv.png','2025-11-13 08:42:42','2025-11-13 08:42:42',NULL),(13,'AFRIKA','clients/images/FiW7VKKcCwW6jo1GS1wBIaGzJC3sxs5NkZZYkUyh.png','2025-11-13 08:42:59','2025-11-13 08:42:59',NULL),(14,'JAMHURI','clients/images/NyedSyaYNWRiow4IOvSWEs11JlDqf0xnS64AkSdC.png','2025-11-13 08:43:21','2025-11-13 08:43:21',NULL),(15,'JHPIEGO','clients/images/wJ6exmkPFH15x3IlVV6x9ifz0qbUyhoCygoKD917.png','2025-11-13 08:43:40','2025-11-13 08:43:40',NULL),(16,'CARE','clients/images/21Dz5PASQTucfchMDlzZk8C46ZLxqVjruGKmpKvE.png','2025-11-13 08:43:55','2025-11-13 08:43:55',NULL),(17,'MEDICAL TEAM','clients/images/zkuV2dusynVGNg5TAgobPfEAUr4UL32dNTJ3r0IZ.png','2025-11-13 08:44:20','2025-11-13 08:44:20',NULL),(18,'PLAN','clients/images/HqKQTlUQE5ZWAUMuebps14XMSOlOMThsFwENqX5T.png','2025-11-13 08:44:42','2025-11-13 08:44:42',NULL),(19,'WORLD VISION','clients/images/IqvTFSivj6SRzwEgmxY9nK0MhDnchHk25XhfsGMO.png','2025-11-13 08:45:16','2025-11-13 08:45:16',NULL),(20,'WE WORLD','clients/images/5nHAy6g7kBlf5NcN7C4ukGntK19oIFNNajhW3q0K.png','2025-11-13 08:45:36','2025-11-13 08:45:36',NULL),(21,'THE CHILD','clients/images/JzU4ZXb1mEbbl8ltrS3GDT7V96Eh92Br5kXArnCQ.png','2025-11-13 08:46:05','2025-11-13 08:46:05',NULL),(22,'UNHCR','clients/images/lUDTpeAx8DUWP90ga2C40dFAGsIX59nDnTXdeBMY.png','2025-11-13 08:46:25','2025-11-13 08:46:25',NULL),(23,'IOM','clients/images/qnmAhE6S4KBqvHlrjVLA13ETIi30AFFJX2pg0ujI.png','2025-11-13 08:46:39','2025-11-13 08:46:39',NULL),(24,'WFP','clients/images/qXtzawPvkNRzi2LbxAZ91RV6CVtaPi6viekUJEdK.png','2025-11-13 08:46:59','2025-11-13 08:46:59',NULL),(25,'UNCEF','clients/images/JD5SW7KwuEQwx2hszNdd5zptjTxUh6ovdDHeRssT.png','2025-11-13 08:47:20','2025-11-13 08:47:20',NULL),(26,'UNDP','clients/images/ZMkqCxbrlF4pb9crXatkOlzS2GvZODDtaROyvq1M.png','2025-11-13 08:48:10','2025-11-13 08:48:10',NULL);
/*!40000 ALTER TABLE `org_clients` ENABLE KEYS */;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'view posts','web','2025-11-15 08:25:08','2025-11-15 08:25:08'),(2,'create posts','web','2025-11-15 08:25:08','2025-11-15 08:25:08'),(3,'edit posts','web','2025-11-15 08:25:08','2025-11-15 08:25:08'),(4,'delete posts','web','2025-11-15 08:25:08','2025-11-15 08:25:08');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  KEY `personal_access_tokens_expires_at_index` (`expires_at`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
INSERT INTO `personal_access_tokens` VALUES (1,'App\\Models\\User',23,'admin@example.com','ef4000889f0ed3b26e553d8834a7d59dba7f93abd6f01896259b1fb9ee58cd87','[\"*\"]',NULL,NULL,'2025-11-02 18:28:44','2025-11-02 18:28:44'),(2,'App\\Models\\User',23,'token for adminadmin@example.com','bd1b2174eaebba5608e9327ae7b1371fa2c1c61abdf901a66d677eb1a262ae3b','[\"*\"]','2025-11-02 21:26:50',NULL,'2025-11-02 18:29:54','2025-11-02 21:26:50'),(3,'App\\Models\\User',30,'users5@test.com','c6d0c6f05bb71116a32df44c342d3309f2a5f99881bff774a22bcdf7fd3b7b65','[\"*\"]',NULL,NULL,'2025-11-02 21:32:37','2025-11-02 21:32:37'),(4,'App\\Models\\User',30,'users5@test.com','732624aa3c05685e49bf3c00a0e238c8f4ba13e34baad4769ac18ab93f30a2b2','[\"*\"]','2025-11-02 21:36:08',NULL,'2025-11-02 21:32:54','2025-11-02 21:36:08'),(5,'App\\Models\\User',30,'users5@test.com','87f057489be4c116d50e8790a79fa11f334a3755ffc09333502be97176d0bdbd','[\"*\"]','2025-11-03 04:23:10',NULL,'2025-11-02 21:37:11','2025-11-03 04:23:10'),(6,'App\\Models\\User',30,'users5@test.com','a77eae9d739aa7fa50ba4fb8d79bba08788045c78af5bf7f99401b060333cd61','[\"*\"]',NULL,NULL,'2025-11-02 21:37:32','2025-11-02 21:37:32'),(7,'App\\Models\\User',30,'users5@test.com','aae9d62571e5c1f896f9f3a2422f3d3b9cdb8264a6225870ab008d0678010671','[\"*\"]','2025-11-03 04:27:05',NULL,'2025-11-03 04:25:08','2025-11-03 04:27:05'),(8,'App\\Models\\User',30,'users5@test.com','019022bc32f89a031b060a1578e4f8514d23ea8779c2c23e82482aa0e2074264','[\"*\"]','2025-11-04 03:27:04',NULL,'2025-11-03 04:35:52','2025-11-04 03:27:04');
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

--
-- Table structure for table `positions`
--

DROP TABLE IF EXISTS `positions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `positions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `positions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `positions`
--

/*!40000 ALTER TABLE `positions` DISABLE KEYS */;
INSERT INTO `positions` VALUES (1,'teacher','2025-11-06 18:44:09','2025-11-06 18:44:09',NULL,NULL),(3,'managing director','2025-11-06 18:44:09','2025-11-06 18:44:09',NULL,NULL),(4,'ERERfgf','2025-11-09 10:09:04','2025-11-09 10:27:14','erer',NULL);
/*!40000 ALTER TABLE `positions` ENABLE KEYS */;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `published` tinyint(1) NOT NULL,
  `auth_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `posts_auth_id_foreign` (`auth_id`),
  CONSTRAINT `posts_auth_id_foreign` FOREIGN KEY (`auth_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `projects` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `images` json NOT NULL,
  `auth_id` bigint unsigned NOT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('ACTIVE','CLOSED','RUNNING','PENDING') NOT NULL DEFAULT 'PENDING',
  `category_id` bigint unsigned NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `projects_auth_id_foreign` (`auth_id`),
  CONSTRAINT `projects_auth_id_foreign` FOREIGN KEY (`auth_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (8,'Ullam Totam Illum O','<p style=\"text-align: center; \"><b>jshsshshjsssj</b></p>','[\"project/images/F3ONSLYFzEaxBjZi7kfADxkt5iYu90RG57a1AXKa.jpg\"]',54,NULL,'2025-11-16 05:48:01','2025-11-16 05:49:54','PENDING',1,'ullam-totam-illum-o');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,1),(2,1),(3,1),(4,1),(1,2);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','web','2025-11-15 08:25:08','2025-11-15 08:25:08'),(2,'user','web','2025-11-15 08:25:08','2025-11-15 08:25:08');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

--
-- Table structure for table `seo`
--

DROP TABLE IF EXISTS `seo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `seo` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  `description` longtext,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `robots` varchar(255) DEFAULT NULL,
  `canonical_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `seo_model_type_model_id_index` (`model_type`,`model_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seo`
--

/*!40000 ALTER TABLE `seo` DISABLE KEYS */;
INSERT INTO `seo` VALUES (1,'App\\Models\\Post',44,'hjhvhvhj','hjbjhvhvhgv',NULL,NULL,NULL,NULL,'2025-11-15 05:15:06','2025-11-15 05:15:06'),(2,'App\\Models\\Post',45,'Dolore dicta iure addfd','Corporis pariatur A','http://127.0.0.1:8000/storage/posts/images/rv8q2zk9SdT7qSJHahX1pxboKTJXbqCKnANDCwwm.jpg','Admin',NULL,NULL,'2025-11-15 05:32:29','2025-11-16 03:45:49'),(3,'App\\Models\\Event',7,'Fugiat dolor volupt','Iola Oconnorfgfgfgfggfg',NULL,'Admin',NULL,NULL,'2025-11-15 06:18:19','2025-11-15 06:18:36'),(4,'App\\Models\\Event',8,'Officia et occaecat','Xena Hurst','http://127.0.0.1:8000/storage/events/images/44ETF5ax4ZQYBMGMi3zCXjLBEvk4ZPTBAzpfXTOW.jpg','Admin',NULL,NULL,'2025-11-15 06:20:08','2025-11-15 06:42:21'),(5,'App\\Models\\Post',46,'Consequuntur illo ni','Commodi dolores mini','http://127.0.0.1:8000/storage/posts/images/J0yjRO4OWowozBzvuQXr3Fd2mUBni7GGMoj7I1MI.gif',NULL,NULL,NULL,'2025-11-15 07:07:12','2025-11-15 07:07:40'),(6,'App\\Models\\Post',46,'Consequuntur illo ni','Commodi dolores mini','http://127.0.0.1:8000/storage/posts/images/J0yjRO4OWowozBzvuQXr3Fd2mUBni7GGMoj7I1MI.gif','Admin',NULL,NULL,'2025-11-15 07:07:12','2025-11-15 07:07:40'),(7,'App\\Models\\User',54,NULL,NULL,NULL,NULL,NULL,NULL,'2025-11-15 08:25:09','2025-11-15 08:25:09'),(8,'App\\Models\\Event',9,'Ea dicta in et ea of','Noelle Fitzgerald','http://127.0.0.1:8000/storage/events/images/vJ5dC8c4CSpba79CGlvuJnFjKYV1tjJldQCZFZ8P.jpg','Super Admin',NULL,NULL,'2025-11-16 04:06:51','2025-11-16 05:31:23'),(9,'App\\Models\\Event',9,'Ea dicta in et ea of','Noelle Fitzgerald','http://127.0.0.1:8000/storage/events/images/vJ5dC8c4CSpba79CGlvuJnFjKYV1tjJldQCZFZ8P.jpg','Super Admin',NULL,NULL,'2025-11-16 04:06:51','2025-11-16 05:31:23'),(10,'App\\Models\\Event',10,NULL,NULL,NULL,NULL,NULL,NULL,'2025-11-16 05:26:52','2025-11-16 05:26:52'),(11,'App\\Models\\Event',10,'Culpa voluptates qu','Gail Travis','http://127.0.0.1:8000/storage/events/images/I3DbMu864gpTzNA1Z1Aosmn2U1br4Vc2Eonnr4Vt.jpg','Super Admin',NULL,NULL,'2025-11-16 05:26:52','2025-11-16 05:26:52'),(12,'App\\Models\\Project',8,'jshsshshjsssj','Ullam Totam Illum O','http://127.0.0.1:8000/storage/project/images/F3ONSLYFzEaxBjZi7kfADxkt5iYu90RG57a1AXKa.jpg','RAPID Tanzania',NULL,NULL,'2025-11-16 05:48:01','2025-11-16 05:52:31'),(13,'App\\Models\\Project',8,'jshsshshjsssj','Ullam Totam Illum O','http://127.0.0.1:8000/storage/project/images/F3ONSLYFzEaxBjZi7kfADxkt5iYu90RG57a1AXKa.jpg','RAPID Tanzania',NULL,NULL,'2025-11-16 05:48:01','2025-11-16 05:52:31'),(14,'App\\Models\\Member',9,NULL,NULL,NULL,NULL,NULL,NULL,'2025-11-16 06:08:40','2025-11-16 06:08:40'),(15,'App\\Models\\Member',10,NULL,NULL,NULL,NULL,NULL,NULL,'2025-11-16 06:14:14','2025-11-16 06:14:14'),(16,'App\\Models\\Category',3,NULL,NULL,NULL,NULL,NULL,NULL,'2025-11-16 06:20:34','2025-11-16 06:20:34'),(18,'App\\Models\\User',56,NULL,NULL,NULL,NULL,NULL,NULL,'2025-11-16 07:09:28','2025-11-16 07:09:28'),(19,'App\\Models\\Event',11,NULL,NULL,NULL,NULL,NULL,NULL,'2025-11-18 11:51:14','2025-11-18 11:51:14'),(20,'App\\Models\\Event',11,'Currently the organization has more than 50 members from different professions background, including Engineers, Architects, Environmentalist, Social scientists,...','Ivana Ayers','http://127.0.0.1:8000/storage/events/images/3Tvk5tsftf2OhENAABVC4an5S6DeRWHm5nFQUm5a.png','Super Admin',NULL,NULL,'2025-11-18 11:51:14','2025-11-18 11:51:14'),(21,'App\\Models\\Event',12,NULL,NULL,NULL,NULL,NULL,NULL,'2025-11-18 11:57:33','2025-11-18 11:57:33'),(22,'App\\Models\\Event',12,'Et atque aute in vol','Allegra Patel','http://127.0.0.1:8000/storage/events/images/4BouleUexDqhaLYEKVnBPpVSEC3BJ8HQjFj4okAj.png','Super Admin',NULL,NULL,'2025-11-18 11:57:33','2025-11-18 11:57:33'),(23,'App\\Models\\Event',13,NULL,NULL,NULL,NULL,NULL,NULL,'2025-11-18 11:59:07','2025-11-18 11:59:07'),(24,'App\\Models\\Event',13,'Et atque aute in vol','Allegra Patel','http://127.0.0.1:8000/storage/events/images/NlX6gLuE56PMkrOhFX8dIbOMkQX7cE9qs84JS8Lg.png','Super Admin',NULL,NULL,'2025-11-18 11:59:07','2025-11-18 11:59:07'),(25,'App\\Models\\Event',14,NULL,NULL,NULL,NULL,NULL,NULL,'2025-11-18 11:59:26','2025-11-18 11:59:26'),(26,'App\\Models\\Event',14,'Et atque aute in vol','Allegra Patel','http://127.0.0.1:8000/storage/events/images/pf9cGpMX8H6FDSpC9IOJhpiqwzt1b8TX8kZwmODO.png','Super Admin',NULL,NULL,'2025-11-18 11:59:26','2025-11-18 11:59:26'),(27,'App\\Models\\Event',15,'Currently the organization has more than 50 members from different professions background, including Engineers, Architects, Environmentalist, Social scientists,...','2022 - 2025 - Fire emergency preparedness in school','http://127.0.0.1:8000/storage/events/images/GqGocskVB4gbcRm1Rx7zlZ1zeesamNomNmQp1rvX.png','Super Admin',NULL,NULL,'2025-11-18 12:10:36','2025-11-18 12:24:47'),(28,'App\\Models\\Event',15,'Currently the organization has more than 50 members from different professions background, including Engineers, Architects, Environmentalist, Social scientists,...','2022 - 2025 - Fire emergency preparedness in school','http://127.0.0.1:8000/storage/events/images/GqGocskVB4gbcRm1Rx7zlZ1zeesamNomNmQp1rvX.png','Super Admin',NULL,NULL,'2025-11-18 12:10:36','2025-11-18 12:24:47');
/*!40000 ALTER TABLE `seo` ENABLE KEYS */;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('r6xH3QLSrXYffluXctyPagLfdDDUeukbd7P40Sku',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiOHoxdVYzajRjSFV1clNOUnFIWkpWVk50TDFPM2ZsMkVZM2ZnVm11ZyI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1763579786);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;

--
-- Table structure for table `tests`
--

DROP TABLE IF EXISTS `tests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tester` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tests`
--

/*!40000 ALTER TABLE `tests` DISABLE KEYS */;
/*!40000 ALTER TABLE `tests` ENABLE KEYS */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` longtext COLLATE utf8mb4_unicode_ci,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (26,'last name','users1e@test.com',NULL,'$2y$12$XxvinqTBP99bVYXUiWgIXu6mn2sLRVdsSKCTeFfMh4P7juSjPzVfS',NULL,NULL,'2025-11-02 21:15:24','2025-11-02 21:15:24','first name','last name',NULL,NULL),(29,'last name','users4@test.com',NULL,'$2y$12$9muqmQjctnUbighHL9O/Eeo/7iAm97DHZaKeaz1IOXyuIPcpTzevW',NULL,NULL,'2025-11-02 21:17:51','2025-11-02 21:17:51','first name','last name',NULL,NULL),(43,'Hunt','cilon@mailinator.com',NULL,'$2y$12$rdODw4iLT557KhINHSqhCOxzNz3ZS96mpv6/HTN6iEWpO45fKoLXe',NULL,NULL,'2025-11-06 10:49:30','2025-11-06 10:49:30','Seth','Hunt',NULL,NULL),(54,'Super Admin','admin@app.com',NULL,'$2y$12$y7jbMypOsqhJAiallC.lU.YhOL3DOuaMx0jzoV8KoZa67Mlixws5q',NULL,NULL,'2025-11-15 08:25:09','2025-11-15 08:25:09',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

--
-- Table structure for table `words`
--

DROP TABLE IF EXISTS `words`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `words` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `text` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `words`
--

/*!40000 ALTER TABLE `words` DISABLE KEYS */;
/*!40000 ALTER TABLE `words` ENABLE KEYS */;

--
-- Dumping routines for database 'rapidtanzania_db'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-11-20 11:26:36
