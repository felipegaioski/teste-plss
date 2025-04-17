-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.30 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para autogestor_db
CREATE DATABASE IF NOT EXISTS `autogestor_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `autogestor_db`;

-- Copiando estrutura para tabela autogestor_db.access_levels
CREATE TABLE IF NOT EXISTS `access_levels` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela autogestor_db.access_levels: ~2 rows (aproximadamente)
INSERT INTO `access_levels` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Administrador', '2025-03-27 02:58:42', '2025-03-28 07:13:02', NULL),
	(2, 'Comum', '2025-03-28 03:30:22', '2025-03-28 03:30:22', NULL);

-- Copiando estrutura para tabela autogestor_db.access_level_user_permission
CREATE TABLE IF NOT EXISTS `access_level_user_permission` (
  `access_level_id` int unsigned NOT NULL,
  `user_permission_id` int unsigned NOT NULL,
  `allow` tinyint unsigned NOT NULL DEFAULT '0',
  KEY `access_level_id` (`access_level_id`),
  KEY `user_permission_id` (`user_permission_id`),
  CONSTRAINT `access_level_id_fk2` FOREIGN KEY (`access_level_id`) REFERENCES `access_levels` (`id`),
  CONSTRAINT `user_permission_id_fk` FOREIGN KEY (`user_permission_id`) REFERENCES `user_permissions` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela autogestor_db.access_level_user_permission: ~20 rows (aproximadamente)
INSERT INTO `access_level_user_permission` (`access_level_id`, `user_permission_id`, `allow`) VALUES
	(1, 1, 1),
	(1, 2, 1),
	(2, 3, 0),
	(2, 4, 0),
	(2, 5, 1),
	(2, 6, 1),
	(1, 3, 1),
	(1, 4, 1),
	(1, 6, 0),
	(1, 5, 0),
	(2, 1, 0),
	(2, 2, 0),
	(1, 7, 0),
	(2, 7, 1),
	(1, 8, 0),
	(2, 8, 1),
	(1, 9, 0),
	(2, 9, 1),
	(1, 10, 0),
	(2, 10, 1);

-- Copiando estrutura para tabela autogestor_db.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
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

-- Copiando dados para a tabela autogestor_db.failed_jobs: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela autogestor_db.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela autogestor_db.migrations: ~0 rows (aproximadamente)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- Copiando estrutura para tabela autogestor_db.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela autogestor_db.password_reset_tokens: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela autogestor_db.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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

-- Copiando dados para a tabela autogestor_db.personal_access_tokens: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela autogestor_db.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `access_level_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `access_level_id` (`access_level_id`),
  CONSTRAINT `access_level_id_fk` FOREIGN KEY (`access_level_id`) REFERENCES `access_levels` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela autogestor_db.users: ~2 rows (aproximadamente)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `access_level_id`) VALUES
	(1, 'admin', 'admin@admin.com', NULL, '$2y$10$HZDWCS.xyoKoS8M8aG5XBODSoUAF7Oi3.tb9jpmh/NKqUZsHHhUWy', NULL, '2025-03-27 04:28:11', '2025-03-27 04:28:11', NULL, 1),
	(2, 'Usuário Teste', 'comum@teste.com', NULL, '$2y$10$HZDWCS.xyoKoS8M8aG5XBODSoUAF7Oi3.tb9jpmh/NKqUZsHHhUWy', NULL, '2025-03-27 05:43:27', '2025-03-27 05:43:27', NULL, 2);

-- Copiando estrutura para tabela autogestor_db.user_permissions
CREATE TABLE IF NOT EXISTS `user_permissions` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT '0',
  `type` varchar(50) COLLATE utf8mb4_general_ci DEFAULT '0',
  `user_permission_category_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_permission_category_id` (`user_permission_category_id`),
  CONSTRAINT `uder_permission_category_id_fk` FOREIGN KEY (`user_permission_category_id`) REFERENCES `user_permission_categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela autogestor_db.user_permissions: ~10 rows (aproximadamente)
INSERT INTO `user_permissions` (`id`, `name`, `type`, `user_permission_category_id`) VALUES
	(1, 'Visualizar', 'view', 1),
	(2, 'Gerenciar', 'manage', 1),
	(3, 'Visualizar', 'view', 2),
	(4, 'Gerenciar', 'manage', 2),
	(5, 'Visualizar', 'view', 4),
	(6, 'Gerenciar', 'manage', 4),
	(7, 'Visualizar', 'view', 5),
	(8, 'Gerenciar', 'manage', 5),
	(9, 'Visualizar', 'view', 6),
	(10, 'Gerenciar', 'manage', 6);

-- Copiando estrutura para tabela autogestor_db.user_permission_categories
CREATE TABLE IF NOT EXISTS `user_permission_categories` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `type` varchar(100) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela autogestor_db.user_permission_categories: ~5 rows (aproximadamente)
INSERT INTO `user_permission_categories` (`id`, `name`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Usuários', 'users', '2025-03-28 01:01:37', '2025-03-28 01:01:38', NULL),
	(2, 'Níveis de Acesso', 'access_levels', '2025-03-28 01:01:51', '2025-03-28 01:01:51', NULL),
	(4, 'Produtos', 'products', '2025-03-28 02:37:16', '2025-03-28 02:37:17', NULL),
	(5, 'Categorias', 'categories', '2025-03-28 16:59:27', '2025-03-28 16:59:28', NULL),
	(6, 'Marcas', 'brands', '2025-03-28 16:59:29', '2025-03-28 16:59:29', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
