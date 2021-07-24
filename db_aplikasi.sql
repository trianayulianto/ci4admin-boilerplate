-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.3.13-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_aplikasi
DROP DATABASE IF EXISTS `db_aplikasi`;
CREATE DATABASE IF NOT EXISTS `db_aplikasi` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_aplikasi`;

-- Dumping structure for table db_aplikasi.failed_jobs
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_aplikasi.failed_jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table db_aplikasi.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_aplikasi.migrations: ~2 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table db_aplikasi.password_resets
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_aplikasi.password_resets: ~15 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
	('avanza@mail.com', '202061725260d12831da2726.21826077', '2021-06-21 19:00:49'),
	('avanza@mail.com', '2036082560d28dd9465568.93459053', '2021-06-22 20:26:49'),
	('avanza@mail.com', '145061271260d2aab58b3c85.82812825', '2021-06-22 22:29:57'),
	('avanza@mail.com', '14694035160d2ab70240058.68712260', '2021-06-22 22:33:04'),
	('avanza@mail.com', '162590182760d2dc4cd3b734.69083284', '2021-06-23 02:01:32'),
	('avanza@mail.com', '29278238960d2dd74677941.91853956', '2021-06-23 02:06:28'),
	('avanza@mail.com', '177964762960d2dddf24b767.44658442', '2021-06-23 02:08:15'),
	('member@mail.com', '139200850160d7cf3015ef38.81025198', '2021-06-26 20:06:56'),
	('member@mail.com', '67282540560d7dfa8967123.59365535', '2021-06-26 21:17:12'),
	('member@mail.com', '116541826660d7e10086b4d0.86535395', '2021-06-26 21:22:56'),
	('member@mail.com', '21691925060d7e3097e5ca1.75977016', '2021-06-26 21:31:37'),
	('member@mail.com', '99959131260d7e638bdc7f1.22809877', '2021-06-26 21:45:12'),
	('admin@example.com', '6639015060d88b0bb1dc39.31873516', '2021-06-27 09:28:27'),
	('admin@example.com', '167006204960d88b404a62f5.42441187', '2021-06-27 09:29:20'),
	('admin@example.com', '18965825460d88bbb19bfc3.81186263', '2021-06-27 09:31:23'),
	('test@domain.tld', '172272172060d92ae0e8ef57.03249162', '2021-06-27 20:50:25'),
	('test@domain.tld', '113510285660d92d6c284af0.65699653', '2021-06-27 21:01:16');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table db_aplikasi.permissions
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `readable_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `permissions_name_unique` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_aplikasi.permissions: ~15 rows (approximately)
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` (`id`, `name`, `readable_name`, `created_at`, `updated_at`) VALUES
	(1, 'account.users.index', 'Can see users account', '2021-07-03 18:47:25', '2021-07-03 22:26:19'),
	(2, 'account.users.create', 'Can create users account', '2021-07-03 20:40:03', '2021-07-03 22:26:29'),
	(4, 'account.users.update', 'Can update users account', '2021-07-03 20:50:17', '2021-07-03 22:26:39'),
	(5, 'account.users.delete', 'Can delete user account', '2021-07-03 22:24:26', '2021-07-03 22:26:55'),
	(6, 'access.roles.index', 'Can see roles data', '2021-07-03 22:25:23', '2021-07-03 22:27:07'),
	(7, 'access.roles.create', 'Can create roles data', '2021-07-04 07:41:52', '2021-07-04 07:41:52'),
	(8, 'access.roles.update', 'Can update roles data', '2021-07-04 07:42:25', '2021-07-04 07:45:42'),
	(9, 'access.roles.delete', 'Can delete roles data', '2021-07-04 07:42:59', '2021-07-04 07:45:54'),
	(10, 'access.roles.assign', 'Can assign role permission', '2021-07-04 07:43:43', '2021-07-05 04:08:01'),
	(11, 'access.permissions.index', 'Can see permission data', '2021-07-04 07:47:16', '2021-07-05 04:29:53'),
	(12, 'account.users.show', 'Can see user\'s roles and permissions', '2021-07-05 03:47:01', '2021-07-05 04:20:40'),
	(13, 'account.users.assign', 'Can update user\'s roles and permissions', '2021-07-05 03:48:46', '2021-07-05 04:21:00'),
	(14, 'access.permissions.create', 'Can create permission data', '2021-07-05 04:25:57', '2021-07-05 04:29:31'),
	(15, 'access.permissions.update', 'Can update permission data', '2021-07-05 04:26:33', '2021-07-05 04:29:43'),
	(16, 'access.permissions.delete', 'Can delete permission data', '2021-07-05 04:27:17', '2021-07-05 04:30:01'),
	(17, 'system.activity.index', 'Can see user activity logs', '2021-07-05 04:42:08', '2021-07-05 04:42:08'),
	(18, 'system.activity.delete', 'Can delete user activity logs', '2021-07-05 04:45:00', '2021-07-05 04:45:00');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- Dumping structure for table db_aplikasi.permission_role
DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE IF NOT EXISTS `permission_role` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  `value` tinyint(4) NOT NULL DEFAULT -1,
  `expires` timestamp NULL DEFAULT NULL,
  KEY `permission_role_permission_id_index` (`permission_id`) USING BTREE,
  KEY `permission_role_role_id_index` (`role_id`) USING BTREE,
  CONSTRAINT `FK_permission_role_permissions` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_permission_role_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_aplikasi.permission_role: ~24 rows (approximately)
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` (`permission_id`, `role_id`, `value`, `expires`) VALUES
	(11, 1, 1, NULL),
	(6, 1, 1, NULL),
	(7, 1, 1, NULL),
	(8, 1, 1, NULL),
	(9, 1, 1, NULL),
	(10, 1, 1, NULL),
	(1, 1, 1, NULL),
	(2, 1, 1, NULL),
	(4, 1, 1, NULL),
	(5, 1, 1, NULL),
	(12, 1, 1, NULL),
	(13, 1, 1, NULL),
	(1, 2, 1, NULL),
	(2, 2, 1, NULL),
	(4, 2, 1, NULL),
	(5, 2, 1, NULL),
	(11, 2, 1, NULL),
	(6, 2, 1, NULL),
	(17, 2, 1, NULL),
	(14, 1, 1, NULL),
	(16, 1, 1, NULL),
	(15, 1, 1, NULL),
	(18, 1, 1, NULL),
	(17, 1, 1, NULL);
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;

-- Dumping structure for table db_aplikasi.permission_user
DROP TABLE IF EXISTS `permission_user`;
CREATE TABLE IF NOT EXISTS `permission_user` (
  `user_id` bigint(20) unsigned NOT NULL,
  `permission_id` bigint(20) unsigned NOT NULL,
  `value` tinyint(4) NOT NULL DEFAULT -1,
  `expires` timestamp NULL DEFAULT NULL,
  KEY `permission_user_user_id_index` (`user_id`) USING BTREE,
  KEY `permission_user_permission_id_index` (`permission_id`) USING BTREE,
  CONSTRAINT `FK_permission_user_permissions` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_permission_user_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_aplikasi.permission_user: ~9 rows (approximately)
/*!40000 ALTER TABLE `permission_user` DISABLE KEYS */;
INSERT INTO `permission_user` (`user_id`, `permission_id`, `value`, `expires`) VALUES
	(2, 11, 1, NULL),
	(2, 6, 1, NULL),
	(2, 1, 1, NULL),
	(2, 2, 1, NULL),
	(2, 4, 1, NULL),
	(2, 5, 1, NULL),
	(2, 17, 1, NULL),
	(2, 18, 1, NULL),
	(2, 12, 1, NULL),
	(2, 13, 1, NULL);
/*!40000 ALTER TABLE `permission_user` ENABLE KEYS */;

-- Dumping structure for table db_aplikasi.roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `roles_name_unique` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_aplikasi.roles: ~3 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'superuser', '2021-07-03 14:02:01', '2021-07-04 18:58:09'),
	(2, 'admin', '2021-07-03 14:02:13', '2021-07-03 14:02:14'),
	(3, 'noaccess', '2021-07-03 10:35:53', '2021-07-03 20:16:51');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping structure for table db_aplikasi.role_user
DROP TABLE IF EXISTS `role_user`;
CREATE TABLE IF NOT EXISTS `role_user` (
  `user_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  KEY `role_user_user_id_index` (`user_id`) USING BTREE,
  KEY `role_user_role_id_index` (`role_id`) USING BTREE,
  CONSTRAINT `FK_role_user_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_role_user_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_aplikasi.role_user: ~4 rows (approximately)
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
	(1, 1),
	(11, 2),
	(14, 2),
	(2, 3),
	(13, 2);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;

-- Dumping structure for table db_aplikasi.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_aplikasi.users: ~43 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Root', 'admin@example.com', '2021-06-17 10:17:08', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'UrP5ynpnA0', '2021-06-17 10:17:08', '2021-07-01 22:49:52'),
	(2, 'Avanza', 'avanza@mail.com', '2021-07-02 08:58:00', '$2y$10$vbZ.EOc4wSjlh/qDOtByO.2PPOLNNoNtn/S/G.582jGFNPgWonwqS', NULL, '2021-07-02 08:58:00', '2021-07-02 08:58:00'),
	(11, 'Alfredo McLaughlin', 'powlowski@example.net', '2021-07-04 19:31:17', '$2y$10$kst.sflh7gNHcAVSK6p0eOzg3DiCU9PkszNqP60cL5pbEyq5g88ka', 'a2mPDCPjwp', '2021-06-17 10:17:23', '2021-07-04 19:31:17'),
	(13, 'Pete Hickle', 'joesph.romaguera@example.org', '2021-06-17 10:17:23', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'F712TLk83Q', '2021-06-17 10:17:23', '2021-06-17 10:17:23'),
	(14, 'Tamara Becker', 'zwisozk@example.net', '2021-07-02 08:43:49', '$2y$10$ITugWnjyREnM4SkE9I9a0OguWndTJo9CbijczsU3AiPHyG9UcvKH.', 'c8dygbUdrb', '2021-06-17 10:17:23', '2021-07-02 08:43:49'),
	(16, 'Kristin Wuckert II', 'kelsi67@example.org', '2021-07-02 08:04:08', '$2y$10$17chS/dT6q36Rak8/UG8m.jElO6AvLxsh0zUUyWhhsT09GfNl/Bky', 'eDEOGcWGnv', '2021-06-17 10:17:23', '2021-07-02 08:04:08'),
	(17, 'Jennie Christiansen', 'vrice@example.net', '2021-06-17 10:17:23', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'a63xQRfbn9', '2021-06-17 10:17:23', '2021-06-17 10:17:23'),
	(18, 'Ellis Lang Sr.', 'hope04@example.net', '2021-06-17 10:17:23', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'EEjMOKWCEE', '2021-06-17 10:17:23', '2021-06-17 10:17:23'),
	(19, 'Dr. Cleveland Waters DVM', 'weimann.cynthia@example.org', '2021-06-17 10:17:23', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'q8NFOXQyGt', '2021-06-17 10:17:23', '2021-06-17 10:17:23'),
	(20, 'Danyka Abbott IV', 'borer.ocie@example.net', '2021-06-17 10:17:23', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'HSTDdkBz4R', '2021-06-17 10:17:23', '2021-06-17 10:17:23'),
	(21, 'Nicholaus Emmerich', 'corwin.dudley@example.net', '2021-06-17 10:17:25', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'aJiE84Mrfk', '2021-06-17 10:17:25', '2021-06-17 10:17:25'),
	(22, 'Miss Glenda Witting', 'ashton78@example.org', '2021-06-17 10:17:25', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'SPOAKR2VLZ', '2021-06-17 10:17:25', '2021-06-17 10:17:25'),
	(23, 'Tierra Bednar', 'sonia.veum@example.org', '2021-06-17 10:17:25', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'vc8pdgsXwD', '2021-06-17 10:17:25', '2021-06-17 10:17:25'),
	(24, 'Prof. Jules Dickens DDS', 'reba.baumbach@example.org', '2021-06-17 10:17:25', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'gsxUqYJvAx', '2021-06-17 10:17:25', '2021-06-17 10:17:25'),
	(25, 'Americo Marks', 'ludwig75@example.org', '2021-06-17 10:17:25', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'uO4fPalKR8', '2021-06-17 10:17:25', '2021-06-17 10:17:25'),
	(26, 'Mr. Jaydon Langworth', 'macy31@example.org', '2021-06-17 10:17:25', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'MUQ4zqeZKC', '2021-06-17 10:17:25', '2021-06-17 10:17:25'),
	(27, 'Nyah Farrell', 'labadie.jackie@example.com', '2021-06-17 10:17:25', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '7wGGhoZpMQ', '2021-06-17 10:17:25', '2021-06-17 10:17:25'),
	(28, 'Janiya Mosciski', 'ocrooks@example.com', '2021-06-17 10:17:25', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Yr99iGlEkc', '2021-06-17 10:17:25', '2021-06-17 10:17:25'),
	(29, 'Janessa Bayer', 'qbeatty@example.com', '2021-06-17 10:17:25', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'rieFlu562P', '2021-06-17 10:17:25', '2021-06-17 10:17:25'),
	(30, 'Alycia Raynor', 'levi54@example.net', '2021-06-17 10:17:25', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '5TWeahSSVm', '2021-06-17 10:17:25', '2021-06-17 10:17:25'),
	(31, 'Kaleigh Wolf', 'evelyn77@example.net', '2021-06-17 10:17:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'OME28ixciE', '2021-06-17 10:17:27', '2021-06-17 10:17:27'),
	(32, 'Hallie Ullrich', 'erich50@example.net', '2021-06-17 10:17:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Gl6dyY3CN4', '2021-06-17 10:17:27', '2021-06-17 10:17:27'),
	(33, 'Fletcher Bechtelar', 'caroline76@example.org', '2021-06-17 10:17:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'JBSFEtl2Oz', '2021-06-17 10:17:27', '2021-06-17 10:17:27'),
	(34, 'Cassidy Reilly', 'juliana.kuphal@example.com', '2021-06-17 10:17:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'DJnwz9LJSc', '2021-06-17 10:17:27', '2021-06-17 10:17:27'),
	(35, 'Earline Walsh II', 'bode.brianne@example.net', '2021-06-17 10:17:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '5wnYJk3eQR', '2021-06-17 10:17:28', '2021-06-17 10:17:28'),
	(36, 'Gus Kutch', 'malinda51@example.net', '2021-06-17 10:17:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'cYT2IhyRRv', '2021-06-17 10:17:28', '2021-06-17 10:17:28'),
	(37, 'Keira Bergnaum', 'grimes.felicia@example.org', '2021-06-17 10:17:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '9KWfGeYVqj', '2021-06-17 10:17:28', '2021-06-17 10:17:28'),
	(38, 'Kattie Paucek', 'wziemann@example.net', '2021-06-17 10:17:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0ZkZs33zpR', '2021-06-17 10:17:28', '2021-06-17 10:17:28'),
	(39, 'Augustine Schmeler', 'kuhn.moriah@example.org', '2021-06-17 10:17:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'XPwK5BxpZC', '2021-06-17 10:17:28', '2021-06-17 10:17:28'),
	(40, 'Hipolito Pfeffer', 'julien61@example.org', '2021-06-17 10:17:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'RutkKATTKM', '2021-06-17 10:17:28', '2021-06-17 10:17:28'),
	(41, 'Harold Howe', 'pgerhold@example.com', '2021-06-17 10:17:30', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'yLkdtM5qFF', '2021-06-17 10:17:30', '2021-06-17 10:17:30'),
	(42, 'Ms. Janessa Legros MD', 'sheridan.cassin@example.net', '2021-06-17 10:17:30', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0PcSrkQa9w', '2021-06-17 10:17:30', '2021-06-17 10:17:30'),
	(43, 'Zachariah Nader', 'daron.dooley@example.org', '2021-06-17 10:17:30', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'z6SmfAxzU8', '2021-06-17 10:17:30', '2021-06-17 10:17:30'),
	(44, 'April Kutch II', 'jordi.harvey@example.org', '2021-06-17 10:17:30', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Tcu8Kljujl', '2021-06-17 10:17:30', '2021-06-17 10:17:30'),
	(45, 'Ophelia Emmerich', 'crona.lydia@example.org', '2021-06-17 10:17:30', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Xt3oQjyhmL', '2021-06-17 10:17:30', '2021-06-17 10:17:30'),
	(46, 'Lawrence McKenzie', 'therese.mcglynn@example.net', '2021-06-17 10:17:30', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'LfDGrq3EBa', '2021-06-17 10:17:30', '2021-06-17 10:17:30'),
	(47, 'Miss Muriel Deckow', 'karine73@example.net', '2021-06-17 10:17:30', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'QrAiuu84iX', '2021-06-17 10:17:30', '2021-06-17 10:17:30'),
	(48, 'Dr. Leanne Olson', 'maurice31@example.org', '2021-06-17 10:17:30', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'V0M2quZv2l', '2021-06-17 10:17:30', '2021-06-17 10:17:30'),
	(49, 'Ms. Joanny Hermiston I', 'murphy08@example.org', '2021-06-17 10:17:30', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'nNM1nM8G3U', '2021-06-17 10:17:30', '2021-06-17 10:17:30'),
	(50, 'Esta Doyle', 'xharvey@example.com', '2021-06-17 10:17:30', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'qcNKQ7XWDv', '2021-06-17 10:17:30', '2021-06-17 10:17:30'),
	(87, 'Triana Yulianto', 'test@domain.tld', '2021-06-27 21:16:50', '$2y$10$eyRyJbagLvyr6GZ6c2C/sO7bUDPJFTP5nYoU8lFKN3hLs7O//nbie', NULL, '2021-06-26 19:48:52', '2021-06-27 21:16:50'),
	(89, 'Nicole Wiegand', 'hollie17@example.com', '2021-07-02 07:55:35', '$2y$10$GM1aFnUycsg39uYYyGMCOOmq10zm05/Mf17I0MiSrQme83ofqyEqm', NULL, '2021-07-02 07:55:35', '2021-07-02 07:55:35');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table db_aplikasi.user_logables
DROP TABLE IF EXISTS `user_logables`;
CREATE TABLE IF NOT EXISTS `user_logables` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `logable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logable_id` bigint(20) unsigned NOT NULL,
  `new_data` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `old_data` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `member_logables_logable_type_logable_id_index` (`logable_type`,`logable_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=153 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_aplikasi.user_logables: ~77 rows (approximately)
/*!40000 ALTER TABLE `user_logables` DISABLE KEYS */;
INSERT INTO `user_logables` (`id`, `user_id`, `logable_type`, `logable_id`, `new_data`, `old_data`, `type`, `state`, `created_at`, `updated_at`) VALUES
	(61, 1, 'App\\Models\\User', 11, '{"id":11,"name":"Alfredo McLaughlin","email":"abi.powlowski@example.net","email_verified_at":"2021-07-03T07:37:55.000000Z","created_at":"2021-06-17T15:17:23.000000Z","updated_at":"2021-07-03T12:17:40.000000Z"}', '{"id":11,"name":"Alfredo McLaughlin","email":"abi.powlowski@example.net","email_verified_at":"2021-07-03T07:37:55.000000Z","created_at":"2021-06-17T15:17:23.000000Z","updated_at":"2021-07-03T07:37:55.000000Z"}', 'edit', NULL, '2021-07-03 07:17:40', '2021-07-03 07:17:40'),
	(62, 1, 'App\\Models\\User', 11, '{"id":11,"name":"Alfredo McLaughlin","email":"abi.powlowski@example.net","email_verified_at":"2021-07-03T12:17:40.000000Z","created_at":"2021-06-17T15:17:23.000000Z","updated_at":"2021-07-03T12:17:40.000000Z"}', '{"id":11,"name":"Alfredo McLaughlin","email":"abi.powlowski@example.net","email_verified_at":"2021-07-03T07:37:55.000000Z","created_at":"2021-06-17T15:17:23.000000Z","updated_at":"2021-07-03T12:17:40.000000Z"}', 'edit', NULL, '2021-07-03 07:17:40', '2021-07-03 07:17:40'),
	(63, 1, 'App\\Models\\User', 11, '{"id":11,"name":"Alfredo McLaughlin","email":"abi.powlowski@example.net","email_verified_at":"2021-07-03T12:17:40.000000Z","created_at":"2021-06-17T15:17:23.000000Z","updated_at":"2021-07-03T12:28:07.000000Z"}', '{"id":11,"name":"Alfredo McLaughlin","email":"abi.powlowski@example.net","email_verified_at":"2021-07-03T12:17:40.000000Z","created_at":"2021-06-17T15:17:23.000000Z","updated_at":"2021-07-03T12:17:40.000000Z"}', 'edit', NULL, '2021-07-03 07:28:07', '2021-07-03 07:28:07'),
	(64, 1, 'App\\Models\\User', 11, '{"id":11,"name":"Alfredo McLaughlin","email":"abi.powlowski@example.net","email_verified_at":"2021-07-03T12:28:07.000000Z","created_at":"2021-06-17T15:17:23.000000Z","updated_at":"2021-07-03T12:28:07.000000Z"}', '{"id":11,"name":"Alfredo McLaughlin","email":"abi.powlowski@example.net","email_verified_at":"2021-07-03T12:17:40.000000Z","created_at":"2021-06-17T15:17:23.000000Z","updated_at":"2021-07-03T12:28:07.000000Z"}', 'edit', NULL, '2021-07-03 07:28:07', '2021-07-03 07:28:07'),
	(65, 1, 'App\\Models\\User', 11, '{"id":11,"name":"Alfredo McLaughlin","email":"abi.powlowski@example.net","email_verified_at":"2021-07-03T12:28:07.000000Z","created_at":"2021-06-17T15:17:23.000000Z","updated_at":"2021-07-03T12:28:56.000000Z"}', '{"id":11,"name":"Alfredo McLaughlin","email":"abi.powlowski@example.net","email_verified_at":"2021-07-03T12:28:07.000000Z","created_at":"2021-06-17T15:17:23.000000Z","updated_at":"2021-07-03T12:28:07.000000Z"}', 'edit', NULL, '2021-07-03 07:28:56', '2021-07-03 07:28:56'),
	(66, 1, 'App\\Models\\User', 11, '{"id":11,"name":"Alfredo McLaughlin","email":"abi.powlowski@example.net","email_verified_at":"2021-07-03T12:28:56.000000Z","created_at":"2021-06-17T15:17:23.000000Z","updated_at":"2021-07-03T12:28:56.000000Z"}', '{"id":11,"name":"Alfredo McLaughlin","email":"abi.powlowski@example.net","email_verified_at":"2021-07-03T12:28:07.000000Z","created_at":"2021-06-17T15:17:23.000000Z","updated_at":"2021-07-03T12:28:56.000000Z"}', 'edit', NULL, '2021-07-03 07:28:56', '2021-07-03 07:28:56'),
	(67, 1, 'App\\Models\\User', 11, '{"id":11,"name":"Alfredo McLaughlin","email":"abi.powlowski@example.net","email_verified_at":"2021-07-03T12:28:56.000000Z","created_at":"2021-06-17T15:17:23.000000Z","updated_at":"2021-07-03T13:09:05.000000Z"}', '{"id":11,"name":"Alfredo McLaughlin","email":"abi.powlowski@example.net","email_verified_at":"2021-07-03T12:28:56.000000Z","created_at":"2021-06-17T15:17:23.000000Z","updated_at":"2021-07-03T12:28:56.000000Z"}', 'edit', NULL, '2021-07-03 08:09:05', '2021-07-03 08:09:05'),
	(68, 1, 'App\\Models\\User', 11, '{"id":11,"name":"Alfredo McLaughlin","email":"abi.powlowski@example.net","email_verified_at":"2021-07-03T13:09:05.000000Z","created_at":"2021-06-17T15:17:23.000000Z","updated_at":"2021-07-03T13:09:05.000000Z"}', '{"id":11,"name":"Alfredo McLaughlin","email":"abi.powlowski@example.net","email_verified_at":"2021-07-03T12:28:56.000000Z","created_at":"2021-06-17T15:17:23.000000Z","updated_at":"2021-07-03T13:09:05.000000Z"}', 'edit', NULL, '2021-07-03 08:09:05', '2021-07-03 08:09:05'),
	(69, 1, 'App\\Models\\User', 11, '{"id":11,"name":"Alfredo McLaughlin","email":"abi.powlowski@example.net","email_verified_at":"2021-07-03T13:09:05.000000Z","created_at":"2021-06-17T15:17:23.000000Z","updated_at":"2021-07-03T13:13:03.000000Z"}', '{"id":11,"name":"Alfredo McLaughlin","email":"abi.powlowski@example.net","email_verified_at":"2021-07-03T13:09:05.000000Z","created_at":"2021-06-17T15:17:23.000000Z","updated_at":"2021-07-03T13:09:05.000000Z"}', 'edit', NULL, '2021-07-03 08:13:04', '2021-07-03 08:13:04'),
	(70, 1, 'App\\Models\\User', 11, '{"id":11,"name":"Alfredo McLaughlin","email":"abi.powlowski@example.net","email_verified_at":"2021-07-03T13:13:04.000000Z","created_at":"2021-06-17T15:17:23.000000Z","updated_at":"2021-07-03T13:13:04.000000Z"}', '{"id":11,"name":"Alfredo McLaughlin","email":"abi.powlowski@example.net","email_verified_at":"2021-07-03T13:09:05.000000Z","created_at":"2021-06-17T15:17:23.000000Z","updated_at":"2021-07-03T13:13:03.000000Z"}', 'edit', NULL, '2021-07-03 08:13:04', '2021-07-03 08:13:04'),
	(71, 1, 'App\\Models\\User', 1, '{"ip":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36"}', '[]', 'logout', NULL, '2021-07-03 08:16:09', '2021-07-03 08:16:09'),
	(72, 1, 'App\\Models\\User', 1, '{"ip":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36"}', '[]', 'login', NULL, '2021-07-03 09:47:39', '2021-07-03 09:47:39'),
	(73, 1, 'App\\Models\\Role', 3, '{"id":3,"name":"noaccess","created_at":"2021-07-03T15:35:53.000000Z","updated_at":"2021-07-04T01:16:51.000000Z"}', '{"id":3,"name":"member","created_at":"2021-07-03T15:35:53.000000Z","updated_at":"2021-07-03T23:38:09.000000Z"}', 'edit', NULL, '2021-07-03 20:16:51', '2021-07-03 20:16:51'),
	(74, 1, 'App\\Models\\Permission', 2, '{"name":"account.user.create","readable_name":"Can create user account","updated_at":"2021-07-04T01:40:03.000000Z","created_at":"2021-07-04T01:40:03.000000Z","id":2}', '[]', 'create', NULL, '2021-07-03 20:40:03', '2021-07-03 20:40:03'),
	(75, 1, 'App\\Models\\Permission', 4, '{"name":"account.user.update","readable_name":"Can update user account","updated_at":"2021-07-04T01:50:17.000000Z","created_at":"2021-07-04T01:50:17.000000Z","id":4}', '[]', 'create', NULL, '2021-07-03 20:50:17', '2021-07-03 20:50:17'),
	(77, 1, 'App\\Models\\Permission', 4, '{"id":4,"name":"account.user.delete","readable_name":"Can update user account","created_at":"2021-07-04T01:50:17.000000Z","updated_at":"2021-07-04T01:52:53.000000Z"}', '{"id":4,"name":"account.user.update","readable_name":"Can update user account","created_at":"2021-07-04T01:50:17.000000Z","updated_at":"2021-07-04T01:50:17.000000Z"}', 'edit', NULL, '2021-07-03 20:52:53', '2021-07-03 20:52:53'),
	(78, 1, 'App\\Models\\Permission', 4, '{"id":4,"name":"account.user.update","readable_name":"Can update user account","created_at":"2021-07-04T01:50:17.000000Z","updated_at":"2021-07-04T03:23:53.000000Z"}', '{"id":4,"name":"account.user.delete","readable_name":"Can update user account","created_at":"2021-07-04T01:50:17.000000Z","updated_at":"2021-07-04T01:52:53.000000Z"}', 'edit', NULL, '2021-07-03 22:23:53', '2021-07-03 22:23:53'),
	(79, 1, 'App\\Models\\Permission', 5, '{"name":"account.user.delete","readable_name":"Can delete user account","updated_at":"2021-07-04T03:24:26.000000Z","created_at":"2021-07-04T03:24:26.000000Z","id":5}', '[]', 'create', NULL, '2021-07-03 22:24:26', '2021-07-03 22:24:26'),
	(80, 1, 'App\\Models\\Permission', 6, '{"name":"access.roles.index","readable_name":"Can see role data","updated_at":"2021-07-04T03:25:23.000000Z","created_at":"2021-07-04T03:25:23.000000Z","id":6}', '[]', 'create', NULL, '2021-07-03 22:25:23', '2021-07-03 22:25:23'),
	(81, 1, 'App\\Models\\Permission', 2, '{"id":2,"name":"account.user.create","readable_name":"Can create users account","created_at":"2021-07-04T01:40:03.000000Z","updated_at":"2021-07-04T03:25:38.000000Z"}', '{"id":2,"name":"account.user.create","readable_name":"Can create user account","created_at":"2021-07-04T01:40:03.000000Z","updated_at":"2021-07-04T01:40:03.000000Z"}', 'edit', NULL, '2021-07-03 22:25:38', '2021-07-03 22:25:38'),
	(82, 1, 'App\\Models\\Permission', 4, '{"id":4,"name":"account.user.update","readable_name":"Can update users account","created_at":"2021-07-04T01:50:17.000000Z","updated_at":"2021-07-04T03:25:51.000000Z"}', '{"id":4,"name":"account.user.update","readable_name":"Can update user account","created_at":"2021-07-04T01:50:17.000000Z","updated_at":"2021-07-04T03:23:53.000000Z"}', 'edit', NULL, '2021-07-03 22:25:51', '2021-07-03 22:25:51'),
	(83, 1, 'App\\Models\\Permission', 1, '{"id":1,"name":"account.user.index","readable_name":"Can see users account","created_at":"2021-07-03T23:47:25.000000Z","updated_at":"2021-07-04T03:26:02.000000Z"}', '{"id":1,"name":"account.users.index","readable_name":"Can see users account","created_at":"2021-07-03T23:47:25.000000Z","updated_at":"2021-07-03T23:51:36.000000Z"}', 'edit', NULL, '2021-07-03 22:26:02', '2021-07-03 22:26:02'),
	(84, 1, 'App\\Models\\Permission', 1, '{"id":1,"name":"account.users.index","readable_name":"Can see users account","created_at":"2021-07-03T23:47:25.000000Z","updated_at":"2021-07-04T03:26:19.000000Z"}', '{"id":1,"name":"account.user.index","readable_name":"Can see users account","created_at":"2021-07-03T23:47:25.000000Z","updated_at":"2021-07-04T03:26:02.000000Z"}', 'edit', NULL, '2021-07-03 22:26:19', '2021-07-03 22:26:19'),
	(85, 1, 'App\\Models\\Permission', 2, '{"id":2,"name":"account.users.create","readable_name":"Can create users account","created_at":"2021-07-04T01:40:03.000000Z","updated_at":"2021-07-04T03:26:29.000000Z"}', '{"id":2,"name":"account.user.create","readable_name":"Can create users account","created_at":"2021-07-04T01:40:03.000000Z","updated_at":"2021-07-04T03:25:38.000000Z"}', 'edit', NULL, '2021-07-03 22:26:29', '2021-07-03 22:26:29'),
	(86, 1, 'App\\Models\\Permission', 4, '{"id":4,"name":"account.users.update","readable_name":"Can update users account","created_at":"2021-07-04T01:50:17.000000Z","updated_at":"2021-07-04T03:26:39.000000Z"}', '{"id":4,"name":"account.user.update","readable_name":"Can update users account","created_at":"2021-07-04T01:50:17.000000Z","updated_at":"2021-07-04T03:25:51.000000Z"}', 'edit', NULL, '2021-07-03 22:26:39', '2021-07-03 22:26:39'),
	(87, 1, 'App\\Models\\Permission', 5, '{"id":5,"name":"account.users.delete","readable_name":"Can delete user account","created_at":"2021-07-04T03:24:26.000000Z","updated_at":"2021-07-04T03:26:55.000000Z"}', '{"id":5,"name":"account.user.delete","readable_name":"Can delete user account","created_at":"2021-07-04T03:24:26.000000Z","updated_at":"2021-07-04T03:24:26.000000Z"}', 'edit', NULL, '2021-07-03 22:26:55', '2021-07-03 22:26:55'),
	(88, 1, 'App\\Models\\Permission', 6, '{"id":6,"name":"access.roles.index","readable_name":"Can see roles data","created_at":"2021-07-04T03:25:23.000000Z","updated_at":"2021-07-04T03:27:07.000000Z"}', '{"id":6,"name":"access.roles.index","readable_name":"Can see role data","created_at":"2021-07-04T03:25:23.000000Z","updated_at":"2021-07-04T03:25:23.000000Z"}', 'edit', NULL, '2021-07-03 22:27:07', '2021-07-03 22:27:07'),
	(89, 1, 'App\\Models\\Permission', 7, '{"name":"access.roles.create","readable_name":"Can create roles data","updated_at":"2021-07-04T12:41:52.000000Z","created_at":"2021-07-04T12:41:52.000000Z","id":7}', '[]', 'create', NULL, '2021-07-04 07:41:52', '2021-07-04 07:41:52'),
	(90, 1, 'App\\Models\\Permission', 8, '{"name":"account.roles.update","readable_name":"Can update roles data","updated_at":"2021-07-04T12:42:25.000000Z","created_at":"2021-07-04T12:42:25.000000Z","id":8}', '[]', 'create', NULL, '2021-07-04 07:42:25', '2021-07-04 07:42:25'),
	(91, 1, 'App\\Models\\Permission', 9, '{"name":"account.roles.delete","readable_name":"Can delete roles data","updated_at":"2021-07-04T12:42:59.000000Z","created_at":"2021-07-04T12:42:59.000000Z","id":9}', '[]', 'create', NULL, '2021-07-04 07:42:59', '2021-07-04 07:42:59'),
	(92, 1, 'App\\Models\\Permission', 10, '{"name":"account.permission.index","readable_name":"Can see permission data","updated_at":"2021-07-04T12:43:43.000000Z","created_at":"2021-07-04T12:43:43.000000Z","id":10}', '[]', 'create', NULL, '2021-07-04 07:43:43', '2021-07-04 07:43:43'),
	(93, 1, 'App\\Models\\Permission', 10, '{"id":10,"name":"access.roles.permission","readable_name":"Can assign role permission","created_at":"2021-07-04T12:43:43.000000Z","updated_at":"2021-07-04T12:45:27.000000Z"}', '{"id":10,"name":"account.permission.index","readable_name":"Can see permission data","created_at":"2021-07-04T12:43:43.000000Z","updated_at":"2021-07-04T12:43:43.000000Z"}', 'edit', NULL, '2021-07-04 07:45:27', '2021-07-04 07:45:27'),
	(94, 1, 'App\\Models\\Permission', 8, '{"id":8,"name":"access.roles.update","readable_name":"Can update roles data","created_at":"2021-07-04T12:42:25.000000Z","updated_at":"2021-07-04T12:45:42.000000Z"}', '{"id":8,"name":"account.roles.update","readable_name":"Can update roles data","created_at":"2021-07-04T12:42:25.000000Z","updated_at":"2021-07-04T12:42:25.000000Z"}', 'edit', NULL, '2021-07-04 07:45:42', '2021-07-04 07:45:42'),
	(95, 1, 'App\\Models\\Permission', 9, '{"id":9,"name":"access.roles.delete","readable_name":"Can delete roles data","created_at":"2021-07-04T12:42:59.000000Z","updated_at":"2021-07-04T12:45:54.000000Z"}', '{"id":9,"name":"account.roles.delete","readable_name":"Can delete roles data","created_at":"2021-07-04T12:42:59.000000Z","updated_at":"2021-07-04T12:42:59.000000Z"}', 'edit', NULL, '2021-07-04 07:45:54', '2021-07-04 07:45:54'),
	(96, 1, 'App\\Models\\Permission', 11, '{"name":"access.permission.index","readable_name":"Can see permission data","updated_at":"2021-07-04T12:47:16.000000Z","created_at":"2021-07-04T12:47:16.000000Z","id":11}', '[]', 'create', NULL, '2021-07-04 07:47:16', '2021-07-04 07:47:16'),
	(97, 1, 'App\\Models\\Role', 1, '{"id":1,"name":"superuser","created_at":"2021-07-03T19:02:01.000000Z","updated_at":"2021-07-04T23:58:09.000000Z"}', '{"id":1,"name":"superadmin","created_at":"2021-07-03T19:02:01.000000Z","updated_at":"2021-07-03T23:50:27.000000Z"}', 'edit', NULL, '2021-07-04 18:58:09', '2021-07-04 18:58:09'),
	(98, 1, 'App\\Models\\User', 11, '{"id":11,"name":"Alfredo McLaughlin","email":"powlowski@example.net","email_verified_at":"2021-07-03T13:13:04.000000Z","created_at":"2021-06-17T15:17:23.000000Z","updated_at":"2021-07-05T00:31:17.000000Z"}', '{"id":11,"name":"Alfredo McLaughlin","email":"abi.powlowski@example.net","email_verified_at":"2021-07-03T13:13:04.000000Z","created_at":"2021-06-17T15:17:23.000000Z","updated_at":"2021-07-03T13:13:04.000000Z"}', 'edit', NULL, '2021-07-04 19:31:17', '2021-07-04 19:31:17'),
	(99, 1, 'App\\Models\\User', 11, '{"id":11,"name":"Alfredo McLaughlin","email":"powlowski@example.net","email_verified_at":"2021-07-05T00:31:17.000000Z","created_at":"2021-06-17T15:17:23.000000Z","updated_at":"2021-07-05T00:31:17.000000Z"}', '{"id":11,"name":"Alfredo McLaughlin","email":"powlowski@example.net","email_verified_at":"2021-07-03T13:13:04.000000Z","created_at":"2021-06-17T15:17:23.000000Z","updated_at":"2021-07-05T00:31:17.000000Z"}', 'edit', NULL, '2021-07-04 19:31:17', '2021-07-04 19:31:17'),
	(100, 1, 'App\\Models\\User', 15, '{"id":15,"name":"Mr. Ryley Hermiston IV","email":"laverna01@example.com","email_verified_at":"2021-06-17T15:17:23.000000Z","created_at":"2021-06-17T15:17:23.000000Z","updated_at":"2021-06-17T15:17:23.000000Z"}', '{"id":15,"name":"Mr. Ryley Hermiston IV","email":"laverna01@example.com","email_verified_at":"2021-06-17T15:17:23.000000Z","created_at":"2021-06-17T15:17:23.000000Z","updated_at":"2021-06-17T15:17:23.000000Z"}', 'delete', NULL, '2021-07-04 19:33:44', '2021-07-04 19:33:44'),
	(101, 1, 'App\\Models\\User', 1, '{"ip":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36"}', '[]', 'login', NULL, '2021-07-05 00:00:04', '2021-07-05 00:00:04'),
	(102, 1, 'App\\Models\\User', 1, '{"ip":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36"}', '[]', 'logout', NULL, '2021-07-05 03:35:26', '2021-07-05 03:35:26'),
	(103, 1, 'App\\Models\\User', 1, '{"ip":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36"}', '[]', 'login', NULL, '2021-07-05 03:35:52', '2021-07-05 03:35:52'),
	(104, 1, 'App\\Models\\Permission', 12, '{"name":"account.users.show","readable_name":"Can see details of user roles and permissions","updated_at":"2021-07-05T08:47:01.000000Z","created_at":"2021-07-05T08:47:01.000000Z","id":12}', '[]', 'create', NULL, '2021-07-05 03:47:01', '2021-07-05 03:47:01'),
	(105, 1, 'App\\Models\\Permission', 13, '{"name":"account.users.assign","readable_name":"Can update details of user roles and permissions","updated_at":"2021-07-05T08:48:46.000000Z","created_at":"2021-07-05T08:48:46.000000Z","id":13}', '[]', 'create', NULL, '2021-07-05 03:48:46', '2021-07-05 03:48:46'),
	(106, 1, 'App\\Models\\Permission', 10, '{"id":10,"name":"access.roles.assign","readable_name":"Can assign role permission","created_at":"2021-07-04T12:43:43.000000Z","updated_at":"2021-07-05T09:08:01.000000Z"}', '{"id":10,"name":"access.roles.permission","readable_name":"Can assign role permission","created_at":"2021-07-04T12:43:43.000000Z","updated_at":"2021-07-04T12:45:27.000000Z"}', 'edit', NULL, '2021-07-05 04:08:01', '2021-07-05 04:08:01'),
	(107, 1, 'App\\Models\\Permission', 12, '{"id":12,"name":"account.users.show","readable_name":"Can see user\'s roles and permissions","created_at":"2021-07-05T08:47:01.000000Z","updated_at":"2021-07-05T09:20:40.000000Z"}', '{"id":12,"name":"account.users.show","readable_name":"Can see details of user roles and permissions","created_at":"2021-07-05T08:47:01.000000Z","updated_at":"2021-07-05T08:47:01.000000Z"}', 'edit', NULL, '2021-07-05 04:20:40', '2021-07-05 04:20:40'),
	(108, 1, 'App\\Models\\Permission', 13, '{"id":13,"name":"account.users.assign","readable_name":"Can update user\'s roles and permissions","created_at":"2021-07-05T08:48:46.000000Z","updated_at":"2021-07-05T09:21:00.000000Z"}', '{"id":13,"name":"account.users.assign","readable_name":"Can update details of user roles and permissions","created_at":"2021-07-05T08:48:46.000000Z","updated_at":"2021-07-05T08:48:46.000000Z"}', 'edit', NULL, '2021-07-05 04:21:00', '2021-07-05 04:21:00'),
	(109, 1, 'App\\Models\\Permission', 14, '{"name":"access.permission.create","readable_name":"Can create permission data","updated_at":"2021-07-05T09:25:57.000000Z","created_at":"2021-07-05T09:25:57.000000Z","id":14}', '[]', 'create', NULL, '2021-07-05 04:25:57', '2021-07-05 04:25:57'),
	(110, 1, 'App\\Models\\Permission', 15, '{"name":"access.permission.update","readable_name":"Can update permission data","updated_at":"2021-07-05T09:26:33.000000Z","created_at":"2021-07-05T09:26:33.000000Z","id":15}', '[]', 'create', NULL, '2021-07-05 04:26:33', '2021-07-05 04:26:33'),
	(111, 1, 'App\\Models\\Permission', 16, '{"name":"access.permission.delete","readable_name":"Can delete permission data","updated_at":"2021-07-05T09:27:17.000000Z","created_at":"2021-07-05T09:27:17.000000Z","id":16}', '[]', 'create', NULL, '2021-07-05 04:27:17', '2021-07-05 04:27:17'),
	(112, 1, 'App\\Models\\Permission', 14, '{"id":14,"name":"access.permissions.create","readable_name":"Can create permission data","created_at":"2021-07-05T09:25:57.000000Z","updated_at":"2021-07-05T09:29:31.000000Z"}', '{"id":14,"name":"access.permission.create","readable_name":"Can create permission data","created_at":"2021-07-05T09:25:57.000000Z","updated_at":"2021-07-05T09:25:57.000000Z"}', 'edit', NULL, '2021-07-05 04:29:31', '2021-07-05 04:29:31'),
	(113, 1, 'App\\Models\\Permission', 15, '{"id":15,"name":"access.permissions.update","readable_name":"Can update permission data","created_at":"2021-07-05T09:26:33.000000Z","updated_at":"2021-07-05T09:29:43.000000Z"}', '{"id":15,"name":"access.permission.update","readable_name":"Can update permission data","created_at":"2021-07-05T09:26:33.000000Z","updated_at":"2021-07-05T09:26:33.000000Z"}', 'edit', NULL, '2021-07-05 04:29:43', '2021-07-05 04:29:43'),
	(114, 1, 'App\\Models\\Permission', 11, '{"id":11,"name":"access.permissions.index","readable_name":"Can see permission data","created_at":"2021-07-04T12:47:16.000000Z","updated_at":"2021-07-05T09:29:53.000000Z"}', '{"id":11,"name":"access.permission.index","readable_name":"Can see permission data","created_at":"2021-07-04T12:47:16.000000Z","updated_at":"2021-07-04T12:47:16.000000Z"}', 'edit', NULL, '2021-07-05 04:29:53', '2021-07-05 04:29:53'),
	(115, 1, 'App\\Models\\Permission', 16, '{"id":16,"name":"access.permissions.delete","readable_name":"Can delete permission data","created_at":"2021-07-05T09:27:17.000000Z","updated_at":"2021-07-05T09:30:01.000000Z"}', '{"id":16,"name":"access.permission.delete","readable_name":"Can delete permission data","created_at":"2021-07-05T09:27:17.000000Z","updated_at":"2021-07-05T09:27:17.000000Z"}', 'edit', NULL, '2021-07-05 04:30:01', '2021-07-05 04:30:01'),
	(116, 1, 'App\\Models\\Permission', 17, '{"name":"system.activity.index","readable_name":"Can see user activity logs","updated_at":"2021-07-05T09:42:08.000000Z","created_at":"2021-07-05T09:42:08.000000Z","id":17}', '[]', 'create', NULL, '2021-07-05 04:42:08', '2021-07-05 04:42:08'),
	(117, 1, 'App\\Models\\Permission', 18, '{"name":"system.activity.delete","readable_name":"Can delete user activity logs","updated_at":"2021-07-05T09:45:00.000000Z","created_at":"2021-07-05T09:45:00.000000Z","id":18}', '[]', 'create', NULL, '2021-07-05 04:45:00', '2021-07-05 04:45:00'),
	(118, 1, 'App\\Models\\User', 1, '{"ip":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36"}', '[]', 'login', NULL, '2021-07-05 04:53:57', '2021-07-05 04:53:57'),
	(119, 1, 'App\\Models\\User', 1, '{"ip":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36"}', '[]', 'logout', NULL, '2021-07-05 04:59:17', '2021-07-05 04:59:17'),
	(120, 1, 'App\\Models\\User', 1, '{"ip":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36"}', '[]', 'login', NULL, '2021-07-05 05:09:06', '2021-07-05 05:09:06'),
	(121, 1, 'App\\Models\\User', 1, '{"ip":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36"}', '[]', 'logout', NULL, '2021-07-06 02:28:23', '2021-07-06 02:28:23'),
	(122, 90, 'App\\Models\\User', 90, '{"ip":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36"}', '[]', 'login', NULL, '2021-07-06 02:28:53', '2021-07-06 02:28:53'),
	(123, 90, 'App\\Models\\User', 90, '{"ip":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36"}', '[]', 'logout', NULL, '2021-07-06 02:29:50', '2021-07-06 02:29:50'),
	(124, 1, 'App\\Models\\User', 1, '{"ip":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36"}', '[]', 'login', NULL, '2021-07-06 02:31:08', '2021-07-06 02:31:08'),
	(125, 1, 'App\\Models\\User', 1, '{"ip":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36"}', '[]', 'logout', NULL, '2021-07-06 02:32:20', '2021-07-06 02:32:20'),
	(126, 2, 'App\\Models\\User', 2, '{"ip":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36"}', '[]', 'login', NULL, '2021-07-06 02:32:47', '2021-07-06 02:32:47'),
	(127, 2, 'App\\Models\\User', 2, '{"ip":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36"}', '[]', 'logout', NULL, '2021-07-06 06:11:54', '2021-07-06 06:11:54'),
	(128, 1, 'App\\Models\\User', 1, '{"ip":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36"}', '[]', 'login', NULL, '2021-07-06 06:12:17', '2021-07-06 06:12:17'),
	(129, 1, 'App\\Models\\User', 1, '{"ip":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36"}', '[]', 'logout', NULL, '2021-07-06 07:15:22', '2021-07-06 07:15:22'),
	(130, 2, 'App\\Models\\User', 2, '{"ip":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36"}', '[]', 'login', NULL, '2021-07-06 07:15:58', '2021-07-06 07:15:58'),
	(131, 1, 'App\\Models\\User', 1, '{"ip":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36"}', '[]', 'login', NULL, '2021-07-06 21:22:18', '2021-07-06 21:22:18'),
	(132, 1, 'App\\Models\\User', 1, '{"ip":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36"}', '[]', 'login', NULL, '2021-07-06 21:26:18', '2021-07-06 21:26:18'),
	(133, 1, 'App\\Models\\User', 1, '{"ip":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36"}', '[]', 'login', NULL, '2021-07-06 21:31:22', '2021-07-06 21:31:22'),
	(134, 1, 'App\\Models\\User', 1, '{"ip":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36"}', '[]', 'logout', NULL, '2021-07-06 21:41:11', '2021-07-06 21:41:11'),
	(135, 1, 'App\\Models\\User', 1, '{"ip":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36"}', '[]', 'login', NULL, '2021-07-06 21:41:44', '2021-07-06 21:41:44'),
	(136, 1, 'App\\Models\\User', 1, '{"ip":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36"}', '[]', 'logout', NULL, '2021-07-06 21:48:26', '2021-07-06 21:48:26'),
	(137, 1, 'App\\Models\\User', 1, '{"ip":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36"}', '[]', 'login', NULL, '2021-07-06 21:49:09', '2021-07-06 21:49:09'),
	(138, 1, 'App\\Models\\User', 1, '{"ip":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36"}', '[]', 'logout', NULL, '2021-07-06 21:59:14', '2021-07-06 21:59:14'),
	(139, 1, 'App\\Models\\User', 1, '{"ip":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36"}', '[]', 'login', NULL, '2021-07-06 21:59:43', '2021-07-06 21:59:43'),
	(140, 1, 'App\\Models\\User', 1, '{"ip":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36"}', '[]', 'logout', NULL, '2021-07-06 22:03:01', '2021-07-06 22:03:01'),
	(141, 1, 'App\\Models\\User', 1, '{"ip":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36"}', '[]', 'login', NULL, '2021-07-06 22:03:27', '2021-07-06 22:03:27'),
	(142, 1, 'App\\Models\\User', 1, '{"ip":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36"}', '[]', 'logout', NULL, '2021-07-06 22:04:19', '2021-07-06 22:04:19'),
	(143, 1, 'App\\Models\\User', 1, '{"ip":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36"}', '[]', 'login', NULL, '2021-07-06 22:04:59', '2021-07-06 22:04:59'),
	(144, 1, 'App\\Models\\User', 1, '{"ip":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36"}', '[]', 'login', NULL, '2021-07-06 22:12:24', '2021-07-06 22:12:24'),
	(145, 1, 'App\\Models\\User', 1, '{"ip":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36"}', '[]', 'logout', NULL, '2021-07-06 22:17:41', '2021-07-06 22:17:41'),
	(146, 2, 'App\\Models\\User', 2, '{"ip":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36"}', '[]', 'login', NULL, '2021-07-06 22:18:18', '2021-07-06 22:18:18'),
	(147, 2, 'App\\Models\\User', 2, '{"ip":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36"}', '[]', 'logout', NULL, '2021-07-06 22:44:55', '2021-07-06 22:44:55'),
	(148, 1, 'App\\Models\\User', 1, '{"ip":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36"}', '[]', 'login', NULL, '2021-07-07 05:11:08', '2021-07-07 05:11:08'),
	(149, 1, 'App\\Models\\User', 1, '{"ip":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36"}', '[]', 'login', NULL, '2021-07-07 05:17:03', '2021-07-07 05:17:03'),
	(150, 1, 'App\\Models\\User', 1, '{"ip":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36"}', '[]', 'login', NULL, '2021-07-07 10:35:47', '2021-07-07 10:35:47'),
	(151, 1, 'App\\Models\\User', 1, '{"ip":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36"}', '[]', 'logout', NULL, '2021-07-07 11:28:28', '2021-07-07 11:28:28'),
	(152, 1, 'App\\Models\\User', 1, '{"ip":"127.0.0.1","user_agent":"Mozilla\\/5.0 (Windows NT 6.1) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.124 Safari\\/537.36"}', '[]', 'login', NULL, '2021-07-07 20:02:09', '2021-07-07 20:02:09');
/*!40000 ALTER TABLE `user_logables` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
