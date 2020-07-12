-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.11-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para app-global
CREATE DATABASE IF NOT EXISTS `app-global` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `app-global`;

-- Copiando estrutura para tabela app-global.contas
CREATE TABLE IF NOT EXISTS `contas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `conta` varchar(50) DEFAULT NULL,
  `empresa_id` int(10) NOT NULL,
  `observacao` varchar(145) DEFAULT NULL,
  `operadora_id` int(10) NOT NULL,
  `grupo_id` int(10) DEFAULT 1,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_contas_operadoras_idx` (`operadora_id`),
  CONSTRAINT `fk_contas_operadoras` FOREIGN KEY (`operadora_id`) REFERENCES `operadoras` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.contas: ~2 rows (aproximadamente)
DELETE FROM `contas`;
/*!40000 ALTER TABLE `contas` DISABLE KEYS */;
INSERT INTO `contas` (`id`, `conta`, `empresa_id`, `observacao`, `operadora_id`, `grupo_id`, `updated_at`) VALUES
	(2, 'Conta Aguia 01', 1, NULL, 1, 1, NULL),
	(4, 'Conta  Extrabom', 4, NULL, 4, 5, NULL);
/*!40000 ALTER TABLE `contas` ENABLE KEYS */;

-- Copiando estrutura para tabela app-global.contratos_fixos
CREATE TABLE IF NOT EXISTS `contratos_fixos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `operadora_id` int(10) NOT NULL,
  `numero_contrato` varchar(40) DEFAULT NULL,
  `assinatura` decimal(10,2) NOT NULL DEFAULT 0.00,
  `franquia` varchar(20) NOT NULL,
  `comprometimento_minimo` decimal(10,2) NOT NULL DEFAULT 0.00,
  `empresa_id` int(10) unsigned NOT NULL,
  `periodo_inicio` date NOT NULL,
  `periodo_fim` date NOT NULL,
  `vigencia` varchar(3) NOT NULL,
  `canais` varchar(3) DEFAULT NULL,
  `range` varchar(9) DEFAULT NULL,
  `sinalizacao` varchar(4) DEFAULT NULL,
  `tarifa_local_fixo` varchar(7) DEFAULT NULL,
  `tarifa_local_movel` varchar(7) DEFAULT NULL,
  `tarifa_ld_fixo` varchar(7) DEFAULT NULL,
  `tarifa_ld_movel` varchar(7) DEFAULT NULL,
  `observacao` varchar(145) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_contratos_fixos_operadoras` (`operadora_id`),
  KEY `FK_contratos_fixos_empresas` (`empresa_id`),
  CONSTRAINT `FK_contratos_fixos_empresas` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`),
  CONSTRAINT `FK_contratos_fixos_operadoras` FOREIGN KEY (`operadora_id`) REFERENCES `operadoras` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.contratos_fixos: ~2 rows (aproximadamente)
DELETE FROM `contratos_fixos`;
/*!40000 ALTER TABLE `contratos_fixos` DISABLE KEYS */;
INSERT INTO `contratos_fixos` (`id`, `operadora_id`, `numero_contrato`, `assinatura`, `franquia`, `comprometimento_minimo`, `empresa_id`, `periodo_inicio`, `periodo_fim`, `vigencia`, `canais`, `range`, `sinalizacao`, `tarifa_local_fixo`, `tarifa_local_movel`, `tarifa_ld_fixo`, `tarifa_ld_movel`, `observacao`, `updated_at`) VALUES
	(3, 3, 'Contrato ABC 01018 AAAA', 3500.12, '2000 minutos', 1541.23, 1, '2020-04-01', '2021-04-01', '12', '15', '1000-1049', 'SIP', 'R$ 0,10', 'R$ 0,50', 'R$ 0,80', 'R$ 0,75', NULL, '2020-05-25 17:44:07'),
	(4, 3, 'MMB 29812', 1558.82, '2000 minutos', 2500.22, 1, '2019-03-01', '2020-04-22', '12', '15', '2000-2049', 'R2', 'R$ 0,33', 'R$ 0,57', 'R$ 0,98', 'R$ 1,23', NULL, '2020-04-23 12:36:49');
/*!40000 ALTER TABLE `contratos_fixos` ENABLE KEYS */;

-- Copiando estrutura para tabela app-global.contratos_moveis
CREATE TABLE IF NOT EXISTS `contratos_moveis` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `numero_contrato` varchar(40) DEFAULT NULL,
  `empresa_id` int(10) unsigned NOT NULL,
  `operadora_id` int(10) NOT NULL,
  `periodo_inicio` date NOT NULL,
  `periodo_fim` date NOT NULL,
  `vigencia` varchar(3) NOT NULL,
  `assinatura` decimal(10,2) NOT NULL DEFAULT 0.00,
  `sms_unitario` decimal(10,2) DEFAULT NULL,
  `sms_pacote` decimal(10,2) DEFAULT NULL,
  `gestor_online` decimal(10,2) DEFAULT NULL,
  `planos_contrato` varchar(145) DEFAULT NULL,
  `observacao` varchar(145) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_contratos_fixos_operadoras` (`operadora_id`) USING BTREE,
  KEY `FK_contratos_fixos_empresas` (`empresa_id`) USING BTREE,
  CONSTRAINT `contratos_moveis_ibfk_1` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`),
  CONSTRAINT `contratos_moveis_ibfk_2` FOREIGN KEY (`operadora_id`) REFERENCES `operadoras` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela app-global.contratos_moveis: ~3 rows (aproximadamente)
DELETE FROM `contratos_moveis`;
/*!40000 ALTER TABLE `contratos_moveis` DISABLE KEYS */;
INSERT INTO `contratos_moveis` (`id`, `numero_contrato`, `empresa_id`, `operadora_id`, `periodo_inicio`, `periodo_fim`, `vigencia`, `assinatura`, `sms_unitario`, `sms_pacote`, `gestor_online`, `planos_contrato`, `observacao`, `updated_at`) VALUES
	(7, 'CT Movel 2020', 1, 2, '2020-04-01', '2020-04-30', '18', 1400.60, NULL, 119.90, 2.00, 'Smart 0.5GB (R$ 34,99) / Smart 5GB (R$ 54,99)', 'teste obs!', NULL),
	(8, 'CT Movel 20201 A', 1, 2, '2020-04-01', '2020-04-30', '18', 1400.60, 0.00, 119.90, 2.00, 'Smart 0.5GB (R$ 34,99) / Smart 5GB (R$ 54,99)', 'teste obs!', NULL),
	(9, 'CT Movel 20201 A', 1, 2, '2020-04-01', '2020-04-30', '18', 1400.60, 0.00, 119.90, 2.00, 'Smart 0.5GB (R$ 34,99) / Smart 5GB (R$ 54,99)', 'teste obs!', NULL),
	(10, 'CT Movel 20201 A', 1, 2, '2020-04-01', '2020-04-30', '18', 1400.60, NULL, 119.90, 2.00, 'Smart 0.5GB (R$ 34,99) / Smart 5GB (R$ 54,99)', 'teste obs!', NULL);
/*!40000 ALTER TABLE `contratos_moveis` ENABLE KEYS */;

-- Copiando estrutura para tabela app-global.empresas
CREATE TABLE IF NOT EXISTS `empresas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `razao_social` varchar(50) NOT NULL,
  `cnpj` varchar(14) NOT NULL,
  `grupo_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cnpj` (`cnpj`),
  KEY `FK_empresas_grupos` (`grupo_id`),
  CONSTRAINT `FK_empresas_grupos` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.empresas: ~3 rows (aproximadamente)
DELETE FROM `empresas`;
/*!40000 ALTER TABLE `empresas` DISABLE KEYS */;
INSERT INTO `empresas` (`id`, `razao_social`, `cnpj`, `grupo_id`) VALUES
	(1, 'Aguia Branca SA', '1234567890', 1),
	(4, 'Extrabom', '0120910291', 5),
	(7, 'Viação Teste AB', '0789925154', 1);
/*!40000 ALTER TABLE `empresas` ENABLE KEYS */;

-- Copiando estrutura para tabela app-global.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela app-global.failed_jobs: ~0 rows (aproximadamente)
DELETE FROM `failed_jobs`;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Copiando estrutura para tabela app-global.filiais
CREATE TABLE IF NOT EXISTS `filiais` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `filial` varchar(25) NOT NULL DEFAULT '0',
  `grupo_id` int(10) unsigned NOT NULL,
  `observacao` varchar(145) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_matriculas_grupos` (`grupo_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela app-global.filiais: ~3 rows (aproximadamente)
DELETE FROM `filiais`;
/*!40000 ALTER TABLE `filiais` DISABLE KEYS */;
INSERT INTO `filiais` (`id`, `filial`, `grupo_id`, `observacao`, `updated_at`) VALUES
	(18, 'Laranjeiras', 1, 'aaa', NULL),
	(19, 'Filial Aguia 01', 1, NULL, NULL),
	(20, 'Filial  Extrabom', 5, NULL, NULL);
/*!40000 ALTER TABLE `filiais` ENABLE KEYS */;

-- Copiando estrutura para tabela app-global.funcoes
CREATE TABLE IF NOT EXISTS `funcoes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `funcao` varchar(25) NOT NULL DEFAULT '0',
  `grupo_id` int(10) unsigned NOT NULL,
  `observacao` varchar(145) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_funcoes_grupos` (`grupo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.funcoes: ~2 rows (aproximadamente)
DELETE FROM `funcoes`;
/*!40000 ALTER TABLE `funcoes` DISABLE KEYS */;
INSERT INTO `funcoes` (`id`, `funcao`, `grupo_id`, `observacao`, `updated_at`) VALUES
	(1, 'Função Aguia 01', 1, NULL, NULL),
	(2, 'Funcao Extrabom', 5, NULL, NULL);
/*!40000 ALTER TABLE `funcoes` ENABLE KEYS */;

-- Copiando estrutura para tabela app-global.gestores
CREATE TABLE IF NOT EXISTS `gestores` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '\n\n',
  `gestor` varchar(50) DEFAULT NULL,
  `grupo_id` int(10) unsigned NOT NULL,
  `observacao` varchar(145) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_gestores_grupos` (`grupo_id`),
  CONSTRAINT `FK_gestores_grupos` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.gestores: ~2 rows (aproximadamente)
DELETE FROM `gestores`;
/*!40000 ALTER TABLE `gestores` DISABLE KEYS */;
INSERT INTO `gestores` (`id`, `gestor`, `grupo_id`, `observacao`, `updated_at`) VALUES
	(1, 'Gestor Aguia 01', 1, NULL, NULL),
	(2, 'Gestor  Extrabom', 5, NULL, NULL);
/*!40000 ALTER TABLE `gestores` ENABLE KEYS */;

-- Copiando estrutura para tabela app-global.grupos
CREATE TABLE IF NOT EXISTS `grupos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `grupo` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.grupos: ~2 rows (aproximadamente)
DELETE FROM `grupos`;
/*!40000 ALTER TABLE `grupos` DISABLE KEYS */;
INSERT INTO `grupos` (`id`, `grupo`) VALUES
	(1, 'Águia Branca'),
	(5, 'Realmar');
/*!40000 ALTER TABLE `grupos` ENABLE KEYS */;

-- Copiando estrutura para tabela app-global.grupos_users
CREATE TABLE IF NOT EXISTS `grupos_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `grupos_id` int(10) unsigned NOT NULL,
  `users_id` int(10) unsigned NOT NULL,
  `observacao` varchar(150) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_grupos_users_grupos` (`grupos_id`) USING BTREE,
  KEY `FK_grupos_users_users` (`users_id`) USING BTREE,
  CONSTRAINT `FK_grupos_users_grupos` FOREIGN KEY (`grupos_id`) REFERENCES `grupos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_grupos_users_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.grupos_users: ~4 rows (aproximadamente)
DELETE FROM `grupos_users`;
/*!40000 ALTER TABLE `grupos_users` DISABLE KEYS */;
INSERT INTO `grupos_users` (`id`, `grupos_id`, `users_id`, `observacao`, `updated_at`) VALUES
	(9, 1, 5, '5454 u', '2020-07-09 18:47:52'),
	(12, 1, 1, 'erer', NULL),
	(16, 5, 1, NULL, NULL),
	(17, 5, 4, NULL, NULL);
/*!40000 ALTER TABLE `grupos_users` ENABLE KEYS */;

-- Copiando estrutura para tabela app-global.inventarios
CREATE TABLE IF NOT EXISTS `inventarios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `linha` varchar(11) NOT NULL,
  `nome_usuario` varchar(25) DEFAULT NULL,
  `data_registro` date DEFAULT NULL,
  `chip` varchar(20) DEFAULT NULL,
  `observacao` varchar(145) DEFAULT NULL,
  `funcao_id` int(10) NOT NULL,
  `filial_id` int(10) NOT NULL,
  `conta_id` int(10) NOT NULL,
  `setor_id` int(10) NOT NULL,
  `subsetor_id` int(10) NOT NULL,
  `gestor_id` int(10) NOT NULL,
  `plano_id` int(10) NOT NULL,
  `status_id` int(10) NOT NULL,
  `tipo_linha_id` int(10) NOT NULL,
  `grupo_id` int(10) DEFAULT 1,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `linha` (`linha`),
  KEY `inventarios_contas_idx` (`conta_id`),
  KEY `inventarios_setores_idx` (`setor_id`),
  KEY `inventarios_subsetores_idx` (`subsetor_id`),
  KEY `inventarios_gestores_idx` (`gestor_id`),
  KEY `inventarios_planos_idx` (`plano_id`),
  KEY `inventarios_status_idx` (`status_id`),
  KEY `inventarios_tipos_linhas_idx` (`tipo_linha_id`),
  KEY `FK_inventarios_funcoes` (`funcao_id`),
  KEY `nome_usuario` (`nome_usuario`),
  KEY `data_registro` (`data_registro`),
  KEY `chip` (`chip`),
  KEY `FK_inventarios_matriculas` (`filial_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.inventarios: ~4 rows (aproximadamente)
DELETE FROM `inventarios`;
/*!40000 ALTER TABLE `inventarios` DISABLE KEYS */;
INSERT INTO `inventarios` (`id`, `linha`, `nome_usuario`, `data_registro`, `chip`, `observacao`, `funcao_id`, `filial_id`, `conta_id`, `setor_id`, `subsetor_id`, `gestor_id`, `plano_id`, `status_id`, `tipo_linha_id`, `grupo_id`, `updated_at`) VALUES
	(3, '27996397522', 'Luis', '2020-06-01', '88885555111100009999', 'aaa', 1, 19, 2, 1, 1, 1, 8, 1, 1, 1, NULL),
	(4, '27988888888', 'aaaaa', '2020-06-01', NULL, NULL, 12, 12, 2, 12, 12, 12, 8, 1, 1, 1, NULL),
	(5, '12121212', 'asas', '2020-06-03', NULL, NULL, 1, 12, 2, 12, 12, 12, 8, 1, 1, 1, NULL),
	(6, '31999995555', 'Teste DDD 31 A', '2020-06-20', '88881111', 'asasasaaaa a', 1, 19, 2, 1, 1, 1, 8, 1, 1, 1, '2020-06-29 18:30:51'),
	(7, '27888787777', 'User Extrabom', '2020-06-01', NULL, 'aaaaa', 2, 20, 4, 2, 2, 2, 8, 1, 1, 5, NULL);
/*!40000 ALTER TABLE `inventarios` ENABLE KEYS */;

-- Copiando estrutura para tabela app-global.matriculas
CREATE TABLE IF NOT EXISTS `matriculas` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `matricula` varchar(25) NOT NULL DEFAULT '0',
  `grupo_id` int(10) unsigned NOT NULL,
  `observacao` varchar(145) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_matriculas_grupos` (`grupo_id`),
  CONSTRAINT `FK_matriculas_grupos` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.matriculas: ~0 rows (aproximadamente)
DELETE FROM `matriculas`;
/*!40000 ALTER TABLE `matriculas` DISABLE KEYS */;
/*!40000 ALTER TABLE `matriculas` ENABLE KEYS */;

-- Copiando estrutura para tabela app-global.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela app-global.migrations: ~3 rows (aproximadamente)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Copiando estrutura para tabela app-global.operadoras
CREATE TABLE IF NOT EXISTS `operadoras` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `operadora` varchar(50) DEFAULT NULL,
  `observacao` varchar(145) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.operadoras: ~4 rows (aproximadamente)
DELETE FROM `operadoras`;
/*!40000 ALTER TABLE `operadoras` DISABLE KEYS */;
INSERT INTO `operadoras` (`id`, `operadora`, `observacao`) VALUES
	(1, 'Vivo', NULL),
	(2, 'Claro', NULL),
	(3, 'Tim', NULL),
	(4, 'Oi', NULL);
/*!40000 ALTER TABLE `operadoras` ENABLE KEYS */;

-- Copiando estrutura para tabela app-global.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela app-global.password_resets: ~0 rows (aproximadamente)
DELETE FROM `password_resets`;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Copiando estrutura para tabela app-global.planos
CREATE TABLE IF NOT EXISTS `planos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `plano` varchar(50) DEFAULT NULL,
  `grupo_id` int(11) DEFAULT NULL,
  `observacao` varchar(145) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.planos: ~11 rows (aproximadamente)
DELETE FROM `planos`;
/*!40000 ALTER TABLE `planos` DISABLE KEYS */;
INSERT INTO `planos` (`id`, `plano`, `grupo_id`, `observacao`, `updated_at`) VALUES
	(1, 'SMART EMPRESAS 0.5GB', 1, NULL, '2020-06-29 16:41:54'),
	(2, 'SMART EMPRESAS 5GB', 1, NULL, '2020-06-29 16:41:55'),
	(3, 'SMART EMPRESAS 2GB', 1, NULL, '2020-06-29 16:41:56'),
	(4, 'INTERNET MOVEL 3GB', 1, NULL, '2020-06-29 16:41:57'),
	(5, 'SMART EMPRESAS 10GB', 1, NULL, '2020-06-29 16:41:58'),
	(6, 'SMART EMPRESAS 25GB', 1, NULL, '2020-06-29 16:41:59'),
	(7, 'INTERNET MOVEL 20GB', 1, NULL, '2020-06-29 16:42:00'),
	(8, 'INTERNET MOVEL 10GB', 1, NULL, '2020-06-29 16:42:01'),
	(9, 'SMART EMPRESAS NACIONAL VOZ', 1, NULL, '2020-06-29 16:42:02'),
	(10, 'LOCAL SMART 80 MINUTOS', 1, NULL, '2020-06-29 16:42:03'),
	(14, 'Plano A', 5, 'aaa', NULL);
/*!40000 ALTER TABLE `planos` ENABLE KEYS */;

-- Copiando estrutura para tabela app-global.setores
CREATE TABLE IF NOT EXISTS `setores` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `setor` varchar(50) NOT NULL,
  `grupo_id` int(10) unsigned NOT NULL,
  `observacao` varchar(145) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `FK_setores_grupos` (`grupo_id`),
  CONSTRAINT `FK_setores_grupos` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.setores: ~2 rows (aproximadamente)
DELETE FROM `setores`;
/*!40000 ALTER TABLE `setores` DISABLE KEYS */;
INSERT INTO `setores` (`id`, `setor`, `grupo_id`, `observacao`, `updated_at`) VALUES
	(1, 'Setor Aguia 01', 1, NULL, NULL),
	(2, 'Setor  Extrabom', 5, NULL, NULL);
/*!40000 ALTER TABLE `setores` ENABLE KEYS */;

-- Copiando estrutura para tabela app-global.status
CREATE TABLE IF NOT EXISTS `status` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `status` varchar(50) DEFAULT NULL,
  `observacao` varchar(145) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.status: ~2 rows (aproximadamente)
DELETE FROM `status`;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` (`id`, `status`, `observacao`) VALUES
	(1, 'Ativa', NULL),
	(2, 'Cancelada', NULL);
/*!40000 ALTER TABLE `status` ENABLE KEYS */;

-- Copiando estrutura para tabela app-global.subsetores
CREATE TABLE IF NOT EXISTS `subsetores` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `subsetor` varchar(50) DEFAULT NULL,
  `grupo_id` int(10) unsigned NOT NULL,
  `observacao` varchar(145) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `FK_subsetores_grupos` (`grupo_id`),
  CONSTRAINT `FK_subsetores_grupos` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.subsetores: ~2 rows (aproximadamente)
DELETE FROM `subsetores`;
/*!40000 ALTER TABLE `subsetores` DISABLE KEYS */;
INSERT INTO `subsetores` (`id`, `subsetor`, `grupo_id`, `observacao`, `updated_at`) VALUES
	(1, 'Subsetor Aguia 01', 1, NULL, NULL),
	(2, 'Subsetor  Extrabom', 5, NULL, NULL);
/*!40000 ALTER TABLE `subsetores` ENABLE KEYS */;

-- Copiando estrutura para tabela app-global.tipos_linhas
CREATE TABLE IF NOT EXISTS `tipos_linhas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tipos_UNIQUE` (`tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.tipos_linhas: ~3 rows (aproximadamente)
DELETE FROM `tipos_linhas`;
/*!40000 ALTER TABLE `tipos_linhas` DISABLE KEYS */;
INSERT INTO `tipos_linhas` (`id`, `tipo`) VALUES
	(1, 'Dados'),
	(2, 'Voz'),
	(3, 'Voz + Dados');
/*!40000 ALTER TABLE `tipos_linhas` ENABLE KEYS */;

-- Copiando estrutura para tabela app-global.tipos_usuarios
CREATE TABLE IF NOT EXISTS `tipos_usuarios` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `tipo_usuario` varchar(15) NOT NULL DEFAULT '0',
  `observacao` varchar(145) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela app-global.tipos_usuarios: ~2 rows (aproximadamente)
DELETE FROM `tipos_usuarios`;
/*!40000 ALTER TABLE `tipos_usuarios` DISABLE KEYS */;
INSERT INTO `tipos_usuarios` (`id`, `tipo_usuario`, `observacao`, `updated_at`) VALUES
	(1, 'Administrador', NULL, NULL),
	(2, 'Usuario', NULL, NULL);
/*!40000 ALTER TABLE `tipos_usuarios` ENABLE KEYS */;

-- Copiando estrutura para tabela app-global.ultimos_usuarios
CREATE TABLE IF NOT EXISTS `ultimos_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ultimo_usuario` varchar(50) DEFAULT NULL,
  `linha` varchar(11) DEFAULT NULL,
  `data_inicio` date DEFAULT NULL,
  `data_termino` date DEFAULT NULL,
  `data_alteracao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.ultimos_usuarios: ~5 rows (aproximadamente)
DELETE FROM `ultimos_usuarios`;
/*!40000 ALTER TABLE `ultimos_usuarios` DISABLE KEYS */;
INSERT INTO `ultimos_usuarios` (`id`, `ultimo_usuario`, `linha`, `data_inicio`, `data_termino`, `data_alteracao`) VALUES
	(2, 'Luis', '27996397522', '2020-06-01', NULL, '2020-06-29 15:14:21'),
	(3, 'aaaaa', '27988888888', '2020-06-01', NULL, '2020-06-29 15:23:02'),
	(4, 'asas', '12121212', '2020-06-03', NULL, '2020-06-29 15:26:40'),
	(5, 'Teste DDD 31', '31999995555', '2020-02-01', '2020-06-20', '2020-06-29 15:30:51'),
	(6, 'User Extrabom', '27888787777', '2020-06-01', NULL, '2020-06-29 15:42:59');
/*!40000 ALTER TABLE `ultimos_usuarios` ENABLE KEYS */;

-- Copiando estrutura para tabela app-global.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo_usuario_id` int(2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela app-global.users: ~6 rows (aproximadamente)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `tipo_usuario_id`, `created_at`, `updated_at`) VALUES
	(1, 'Administrador', 'admin@admin.com', '2020-07-12 16:25:13', '$2y$10$GOstnfWut.bEtsq7ICSnM.tASelr81aYn6X4Ep7WTlCsghr6l/r3C', 'hZib8ysrYVdvy6PxI6FlYtOGi0uoIBbHC88DGlR4JpcYTz2bHfU2JT2IC5q2', 1, '2020-02-14 19:18:31', '2020-02-14 19:18:31'),
	(4, 'Extrabom', 'extrabom@extrabom.com', '2020-07-12 16:25:16', '$2y$10$wS6CN94ruvwwQOSSowd5Se5V3QAFLGICVJfqfjnex9Nv98Ji7Uebu', 'buOjhJCvoxQbcfPxXXRPyaeL2nhzWOmIsQEpa56eiOc8voS9QCmGNZf9wvdf', 1, '2020-06-24 12:55:34', '2020-06-24 12:55:34'),
	(5, 'Águia Branca', 'aguia@aguia.com', '2020-07-12 16:25:18', '$2y$10$JZuemToeylA7ey7sdNtM3.C8fcViESbVyhLDi00H3mm8p30RV2TPG', NULL, 1, '2020-06-24 14:14:01', '2020-06-24 14:14:01'),
	(9, 'teste', 'teste@teste.com', '2020-07-12 17:56:42', '$2y$10$S.0WwM.gCYfm/kew1nKwj.rk9VUuv/f7yuE7LMc/EKEM40MVNxRXy', NULL, 2, '2020-07-01 18:26:30', '2020-07-01 18:26:30');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Copiando estrutura para trigger app-global.trigger_insert_ultimo_usuario
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `trigger_insert_ultimo_usuario` BEFORE INSERT ON `inventarios` FOR EACH ROW BEGIN
INSERT INTO ultimos_usuarios (linha, ultimo_usuario,data_inicio) VALUES (NEW.linha, NEW.nome_usuario,NEW.data_registro);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Copiando estrutura para trigger app-global.trigger_update_ultimo_usuario
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `trigger_update_ultimo_usuario` BEFORE UPDATE ON `inventarios` FOR EACH ROW BEGIN

IF (NEW.nome_usuario <> OLD.nome_usuario)
	THEN
	UPDATE ultimos_usuarios SET ultimo_usuario = OLD.nome_usuario, data_inicio = OLD.data_registro, 
	data_termino = NEW.data_registro
	WHERE ultimos_usuarios.linha = OLD.linha;
END IF;

END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
