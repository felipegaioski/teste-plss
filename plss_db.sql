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


-- Copiando estrutura do banco de dados para plss_db
CREATE DATABASE IF NOT EXISTS `plss_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `plss_db`;

-- Copiando estrutura para tabela plss_db.access_levels
CREATE TABLE IF NOT EXISTS `access_levels` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela plss_db.access_levels: ~2 rows (aproximadamente)
INSERT INTO `access_levels` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Administrador', '2025-03-27 02:58:42', '2025-03-28 07:13:02', NULL),
	(2, 'Comum', '2025-03-28 03:30:22', '2025-03-28 03:30:22', NULL);

-- Copiando estrutura para tabela plss_db.access_level_user_permission
CREATE TABLE IF NOT EXISTS `access_level_user_permission` (
  `access_level_id` int unsigned NOT NULL,
  `user_permission_id` int unsigned NOT NULL,
  `allow` tinyint unsigned NOT NULL DEFAULT '0',
  KEY `access_level_id` (`access_level_id`),
  KEY `user_permission_id` (`user_permission_id`),
  CONSTRAINT `access_level_id_fk2` FOREIGN KEY (`access_level_id`) REFERENCES `access_levels` (`id`),
  CONSTRAINT `user_permission_id_fk` FOREIGN KEY (`user_permission_id`) REFERENCES `user_permissions` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela plss_db.access_level_user_permission: ~11 rows (aproximadamente)
INSERT INTO `access_level_user_permission` (`access_level_id`, `user_permission_id`, `allow`) VALUES
	(1, 1, 1),
	(1, 2, 1),
	(2, 3, 0),
	(1, 3, 1),
	(2, 1, 1),
	(2, 2, 0),
	(1, 11, 1),
	(2, 11, 1),
	(1, 12, 1),
	(2, 12, 1),
	(1, 4, 1),
	(2, 4, 0);

-- Copiando estrutura para tabela plss_db.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` char(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela plss_db.categories: ~0 rows (aproximadamente)
INSERT INTO `categories` (`id`, `name`) VALUES
	(1, 'Software'),
	(2, 'Hardware'),
	(3, 'Manutenção'),
	(4, 'Administrativo');

-- Copiando estrutura para tabela plss_db.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
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

-- Copiando dados para a tabela plss_db.failed_jobs: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela plss_db.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela plss_db.migrations: ~4 rows (aproximadamente)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- Copiando estrutura para tabela plss_db.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela plss_db.password_reset_tokens: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela plss_db.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
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

-- Copiando dados para a tabela plss_db.personal_access_tokens: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela plss_db.statuses
CREATE TABLE IF NOT EXISTS `statuses` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` char(50) COLLATE utf8mb4_general_ci NOT NULL,
  `slug` char(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela plss_db.statuses: ~0 rows (aproximadamente)
INSERT INTO `statuses` (`id`, `name`, `slug`) VALUES
	(1, 'Novo', 'new'),
	(2, 'Pendente', 'pending'),
	(3, 'Resolvido', 'solved');

-- Copiando estrutura para tabela plss_db.tickets
CREATE TABLE IF NOT EXISTS `tickets` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `category_id` int unsigned NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `deadline` datetime NOT NULL,
  `solved_at` datetime DEFAULT NULL,
  `status_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `status_id` (`status_id`),
  KEY `ticket_category_id_fk` (`category_id`),
  CONSTRAINT `ticket_category_id_fk` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `ticket_status_id_fk` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela plss_db.tickets: ~0 rows (aproximadamente)
INSERT INTO `tickets` (`id`, `title`, `category_id`, `description`, `deadline`, `solved_at`, `status_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Primeiro Chamado', 2, 'Por outro lado, o início da atividade geral de formação de atitudes prepara-nos para enfrentar situações atípicas decorrentes das regras de conduta normativas.', '2025-04-19 21:42:27', '2025-04-16 23:51:28', 3, '2025-04-17 00:42:27', '2025-04-17 02:51:28', NULL),
	(2, 'Segundo Chamado', 3, 'Por outro lado, o início da atividade geral de formação de atitudes prepara-nos para enfrentar situações atípicas decorrentes das regras de conduta normativas.', '2025-04-19 22:35:50', NULL, 1, '2025-04-17 01:35:50', '2025-04-17 02:15:38', '2025-04-17 02:15:38'),
	(3, 'Terceiro Chamado', 1, 'Gostaria de enfatizar que a constante divulgação das informações talvez venha a ressaltar a relatividade do sistema de participação geral.', '2025-04-20 00:33:26', NULL, 1, '2025-04-17 03:33:26', '2025-04-17 04:12:17', NULL),
	(4, 'Instalar pacote Office', 4, 'Por outro lado, o comprometimento entre as equipes apresenta tendências no sentido de aprovar a manutenção do impacto na agilidade decisória.', '2025-04-20 01:03:49', NULL, 2, '2025-04-17 04:03:49', '2025-04-17 04:19:15', NULL),
	(5, 'Baixar mais memória RAM', 1, 'No entanto, não podemos esquecer que a constante divulgação das informações cumpre um papel essencial na formulação do orçamento setorial.', '2025-04-20 01:24:09', '2025-04-17 01:25:44', 3, '2025-04-17 04:24:09', '2025-04-17 04:25:44', NULL),
	(6, 'Trocar resistor polarizado', 3, 'Não obstante, a revolução dos costumes prepara-nos para enfrentar situações atípicas decorrentes das diretrizes de desenvolvimento para o futuro.', '2025-04-15 01:26:47', '2025-04-17 01:27:00', 3, '2025-04-12 04:26:47', '2025-04-17 04:27:00', NULL),
	(7, 'Pc não liga', 2, 'É importante questionar o quanto o fenômeno da Internet estende o alcance e a importância dos modos de operação convencionais.', '2025-04-20 01:37:32', NULL, 1, '2025-04-17 04:37:32', '2025-04-17 04:37:32', NULL),
	(8, 'Computador dando tela azul', 1, 'Do mesmo modo, a necessidade de renovação processual auxilia a preparação e a composição dos relacionamentos verticais entre as hierarquias.', '2025-04-20 01:38:01', NULL, 1, '2025-04-17 04:38:01', '2025-04-17 04:38:01', NULL),
	(9, 'Otimização de performance', 1, 'A equipe de suporte precisa saber que a otimização de performance da renderização do DOM complexificou o merge do JSON compilado a partir de proto-buffers.', '2025-04-13 01:42:23', NULL, 2, '2025-04-10 04:42:23', '2025-04-17 04:42:27', NULL);

-- Copiando estrutura para tabela plss_db.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `access_level_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `access_level_id` (`access_level_id`),
  CONSTRAINT `access_level_id_fk` FOREIGN KEY (`access_level_id`) REFERENCES `access_levels` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela plss_db.users: ~2 rows (aproximadamente)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `access_level_id`) VALUES
	(1, 'admin', 'admin@admin.com', NULL, '$2y$10$HZDWCS.xyoKoS8M8aG5XBODSoUAF7Oi3.tb9jpmh/NKqUZsHHhUWy', NULL, '2025-03-27 04:28:11', '2025-03-27 04:28:11', NULL, 1),
	(2, 'Usuário Teste', 'comum@teste.com', NULL, '$2y$10$HZDWCS.xyoKoS8M8aG5XBODSoUAF7Oi3.tb9jpmh/NKqUZsHHhUWy', NULL, '2025-03-27 05:43:27', '2025-03-27 05:43:27', NULL, 2),
	(3, 'outro', 'outro@123.com', NULL, '$2y$12$puTAion6agyX9pqEXdTNB.2Y8BS9Mvb3VEymbG/uhFEgJlukJoJZ2', NULL, '2025-04-17 04:11:45', '2025-04-17 04:18:21', '2025-04-17 04:18:21', 2);

-- Copiando estrutura para tabela plss_db.user_permissions
CREATE TABLE IF NOT EXISTS `user_permissions` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '0',
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '0',
  `user_permission_category_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_permission_category_id` (`user_permission_category_id`),
  CONSTRAINT `uder_permission_category_id_fk` FOREIGN KEY (`user_permission_category_id`) REFERENCES `user_permission_categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela plss_db.user_permissions: ~0 rows (aproximadamente)
INSERT INTO `user_permissions` (`id`, `name`, `type`, `user_permission_category_id`) VALUES
	(1, 'Visualizar', 'view', 1),
	(2, 'Gerenciar', 'manage', 1),
	(3, 'Visualizar', 'view', 2),
	(4, 'Gerenciar', 'manage', 2),
	(11, 'Visualizar', 'view', 7),
	(12, 'Gerenciar', 'manage', 7);

-- Copiando estrutura para tabela plss_db.user_permission_categories
CREATE TABLE IF NOT EXISTS `user_permission_categories` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela plss_db.user_permission_categories: ~5 rows (aproximadamente)
INSERT INTO `user_permission_categories` (`id`, `name`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Usuários', 'users', '2025-03-28 01:01:37', '2025-03-28 01:01:38', NULL),
	(2, 'Níveis de Acesso', 'access_levels', '2025-03-28 01:01:51', '2025-03-28 01:01:51', NULL),
	(7, 'Chamados', 'tickets', NULL, NULL, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
