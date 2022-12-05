/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.25-MariaDB : Database - db_penjualan
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_penjualan` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `db_penjualan`;

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(8,'2014_10_12_000000_create_users_table',1),
(9,'2014_10_12_100000_create_password_resets_table',1),
(10,'2019_08_19_000000_create_failed_jobs_table',1),
(11,'2019_12_14_000001_create_personal_access_tokens_table',1),
(12,'2022_12_02_145458_create_product_table',1),
(13,'2022_12_02_145527_create_transaction_header_table',1),
(14,'2022_12_02_145543_create_transaction_detail_table',1);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `product` */

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product` (
  `prod_code` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(6,0) NOT NULL,
  `currency` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` decimal(6,0) NOT NULL,
  `dimension` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`prod_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `product` */

insert  into `product`(`prod_code`,`name`,`price`,`currency`,`discount`,`dimension`,`unit`,`created_at`,`updated_at`) values 
('SKUDAIASB','Daia Detergen',35000,'IDR',5,'35cm x 20cm','pcs','2022-12-05 08:00:57','2022-12-05 08:00:57'),
('SKUGIVBBR','Giv Biru',11000,'IDR',0,'10cm x 7cm','pcs','2022-12-05 08:00:57','2022-12-05 08:00:57'),
('SKUGIVPRP','Giv Parfume Sabun Mandi Passio',30000,'IDR',5,'25cm x 10cm','pcs','2022-12-05 08:00:57','2022-12-05 08:00:57'),
('SKUMSDPKR','Mie Sedaap Kari Kental',112000,'IDR',10,'40cm x 25cm','dus','2022-12-05 08:00:57','2022-12-05 08:00:57'),
('SKUMSDPST','Mie Sedaap Soto',110000,'IDR',10,'40cm x 25cm','dus','2022-12-05 08:00:57','2022-12-05 08:00:57'),
('SKUSKILNL','So Klin Liquid',18000,'IDR',10,'13cm x 10cm','pcs','2022-12-05 08:00:57','2022-12-05 08:00:57'),
('SKUSKILNP','So Klin Pewangi',15000,'IDR',10,'13cm x 10cm','pcs','2022-12-05 08:00:57','2022-12-05 08:00:57'),
('SKUSKILNS','So Klin Softergent',70000,'IDR',17,'35cm x 20cm','pcs','2022-12-05 08:00:57','2022-12-05 08:00:57');

/*Table structure for table `transaction_detail` */

DROP TABLE IF EXISTS `transaction_detail`;

CREATE TABLE `transaction_detail` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `doc_code` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doc_number` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prod_code` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(6,0) NOT NULL,
  `quantity` int(10) unsigned NOT NULL,
  `unit` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_total` decimal(10,0) NOT NULL,
  `currency` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transaction_detail_product_code_foreign` (`prod_code`),
  CONSTRAINT `transaction_detail_product_code_foreign` FOREIGN KEY (`prod_code`) REFERENCES `product` (`prod_code`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `transaction_detail` */

insert  into `transaction_detail`(`id`,`doc_code`,`doc_number`,`prod_code`,`price`,`quantity`,`unit`,`sub_total`,`currency`,`created_at`,`updated_at`) values 
(1,'TRX','000001','SKUDAIASB',33250,2,'pcs',66500,'IDR','2022-12-05 17:29:49','2022-12-05 17:31:11'),
(2,'TRX','000001','SKUMSDPKR',100800,1,'dus',100800,'IDR','2022-12-05 17:30:07','2022-12-05 17:30:07'),
(3,'TRX','000001','SKUSKILNP',13500,1,'pcs',13500,'IDR','2022-12-05 17:30:11','2022-12-05 17:30:11'),
(4,'TRX','000001','SKUMSDPST',99000,1,'dus',99000,'IDR','2022-12-05 17:31:15','2022-12-05 17:31:15'),
(5,'TRX','000002','SKUGIVBBR',11000,5,'pcs',55000,'IDR','2022-12-05 17:32:28','2022-12-05 17:32:32'),
(6,'TRX','000002','SKUSKILNS',58100,2,'pcs',116200,'IDR','2022-12-05 17:32:37','2022-12-05 17:32:38');

/*Table structure for table `transaction_header` */

DROP TABLE IF EXISTS `transaction_header`;

CREATE TABLE `transaction_header` (
  `doc_code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `doc_number` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `total` decimal(10,0) NOT NULL DEFAULT 0,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`doc_number`),
  KEY `transaction_header_user_id_foreign` (`user_id`),
  CONSTRAINT `transaction_header_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `transaction_header` */

insert  into `transaction_header`(`doc_code`,`doc_number`,`user_id`,`total`,`date`,`created_at`,`updated_at`) values 
('TRX','000001',1,279800,'2022-12-05','2022-12-05 17:29:49','2022-12-05 17:32:04'),
('TRX','000002',1,171200,'2022-12-05','2022-12-05 17:32:28','2022-12-05 17:32:55');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`username`,`password`,`remember_token`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'SMIT','Smit','$2y$10$1SuF8YAp6JTmvVvSbRGKTeSWnTxZihd9wEfCdShiVB8m7uVtvpTX2',NULL,'2022-12-04 22:58:05','2022-12-04 22:58:05',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
