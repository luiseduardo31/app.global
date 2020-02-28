-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.11-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              10.3.0.5771
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
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `conta` varchar(50) DEFAULT NULL,
  `operadora_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_contas_operadoras_idx` (`operadora_id`),
  CONSTRAINT `fk_contas_operadoras` FOREIGN KEY (`operadora_id`) REFERENCES `operadoras` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.contas: ~2 rows (aproximadamente)
DELETE FROM `contas`;
/*!40000 ALTER TABLE `contas` DISABLE KEYS */;
INSERT INTO `contas` (`id`, `conta`, `operadora_id`) VALUES
	(1, '032148975', 1),
	(3, '028954441', 1);
/*!40000 ALTER TABLE `contas` ENABLE KEYS */;

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

-- Copiando estrutura para tabela app-global.gestores
CREATE TABLE IF NOT EXISTS `gestores` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '\\n\\n',
  `gestor` varchar(50) DEFAULT NULL,
  `observacao` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.gestores: ~2 rows (aproximadamente)
DELETE FROM `gestores`;
/*!40000 ALTER TABLE `gestores` DISABLE KEYS */;
INSERT INTO `gestores` (`id`, `gestor`, `observacao`) VALUES
	(1, 'Vitor', NULL),
	(2, 'José', NULL);
/*!40000 ALTER TABLE `gestores` ENABLE KEYS */;

-- Copiando estrutura para tabela app-global.inventarios
CREATE TABLE IF NOT EXISTS `inventarios` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `linha` varchar(11) NOT NULL,
  `nome_usuario` varchar(25) DEFAULT NULL,
  `data_registro` date DEFAULT NULL,
  `matricula` varchar(20) DEFAULT NULL,
  `funcao` varchar(25) DEFAULT NULL,
  `chip` varchar(20) DEFAULT NULL,
  `observacao` text DEFAULT NULL,
  `conta_id` int(10) NOT NULL,
  `setor_id` int(10) NOT NULL,
  `subsetor_id` int(10) NOT NULL,
  `gestor_id` int(10) NOT NULL,
  `plano_id` int(10) NOT NULL,
  `status_id` int(10) NOT NULL,
  `tipo_linha_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `inventarios_contas_idx` (`conta_id`),
  KEY `inventarios_setores_idx` (`setor_id`),
  KEY `inventarios_subsetores_idx` (`subsetor_id`),
  KEY `inventarios_gestores_idx` (`gestor_id`),
  KEY `inventarios_planos_idx` (`plano_id`),
  KEY `inventarios_status_idx` (`status_id`),
  KEY `fk_inventarios_tipos_linhas1_idx` (`tipo_linha_id`),
  CONSTRAINT `fk_inventarios_contas` FOREIGN KEY (`conta_id`) REFERENCES `contas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_inventarios_gestores` FOREIGN KEY (`gestor_id`) REFERENCES `gestores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_inventarios_planos` FOREIGN KEY (`plano_id`) REFERENCES `planos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_inventarios_setores` FOREIGN KEY (`setor_id`) REFERENCES `setores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_inventarios_status` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_inventarios_subsetores` FOREIGN KEY (`subsetor_id`) REFERENCES `subsetores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_inventarios_tipos_linhas1` FOREIGN KEY (`tipo_linha_id`) REFERENCES `tipos_linhas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.inventarios: ~2 rows (aproximadamente)
DELETE FROM `inventarios`;
/*!40000 ALTER TABLE `inventarios` DISABLE KEYS */;
INSERT INTO `inventarios` (`id`, `linha`, `nome_usuario`, `data_registro`, `matricula`, `funcao`, `chip`, `observacao`, `conta_id`, `setor_id`, `subsetor_id`, `gestor_id`, `plano_id`, `status_id`, `tipo_linha_id`) VALUES
	(3, '27988554488', 'Luis Eduardo Monteiro', '2020-02-25', 'ES 548032020', 'Gerencia', '88889999111155553333', 'Teste Observação', 1, 1, 1, 1, 1, 1, 1),
	(6, '31992556644', 'Ronaldo Silva', '2020-02-22', 'MG 47855512', 'Coordenador', '89554444777711114444', 'Teste OK!', 1, 2, 2, 2, 2, 1, 3);
/*!40000 ALTER TABLE `inventarios` ENABLE KEYS */;

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
  `observacao` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.operadoras: ~0 rows (aproximadamente)
DELETE FROM `operadoras`;
/*!40000 ALTER TABLE `operadoras` DISABLE KEYS */;
INSERT INTO `operadoras` (`id`, `operadora`, `observacao`) VALUES
	(1, 'Vivo', NULL);
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
  `observacao` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.planos: ~2 rows (aproximadamente)
DELETE FROM `planos`;
/*!40000 ALTER TABLE `planos` DISABLE KEYS */;
INSERT INTO `planos` (`id`, `plano`, `observacao`) VALUES
	(1, 'Smart Vivo 05', NULL),
	(2, 'Smart Vivo 2GB', NULL);
/*!40000 ALTER TABLE `planos` ENABLE KEYS */;

-- Copiando estrutura para tabela app-global.setores
CREATE TABLE IF NOT EXISTS `setores` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `setor` varchar(50) NOT NULL,
  `observacao` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.setores: ~3 rows (aproximadamente)
DELETE FROM `setores`;
/*!40000 ALTER TABLE `setores` DISABLE KEYS */;
INSERT INTO `setores` (`id`, `setor`, `observacao`) VALUES
	(1, 'TI', NULL),
	(2, 'Administrativo', NULL),
	(3, 'Vendas', NULL);
/*!40000 ALTER TABLE `setores` ENABLE KEYS */;

-- Copiando estrutura para tabela app-global.status
CREATE TABLE IF NOT EXISTS `status` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `status` varchar(50) DEFAULT NULL,
  `observacao` text DEFAULT NULL,
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
  `observacao` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.subsetores: ~2 rows (aproximadamente)
DELETE FROM `subsetores`;
/*!40000 ALTER TABLE `subsetores` DISABLE KEYS */;
INSERT INTO `subsetores` (`id`, `subsetor`, `observacao`) VALUES
	(1, 'Suporte', NULL),
	(2, 'Financeiro', NULL);
/*!40000 ALTER TABLE `subsetores` ENABLE KEYS */;

-- Copiando estrutura para tabela app-global.tipos_linhas
CREATE TABLE IF NOT EXISTS `tipos_linhas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tipos_UNIQUE` (`tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.tipos_linhas: ~3 rows (aproximadamente)
DELETE FROM `tipos_linhas`;
/*!40000 ALTER TABLE `tipos_linhas` DISABLE KEYS */;
INSERT INTO `tipos_linhas` (`id`, `tipo`) VALUES
	(4, 'Dados'),
	(1, 'Voz'),
	(3, 'Voz + Dados');
/*!40000 ALTER TABLE `tipos_linhas` ENABLE KEYS */;

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

-- Copiando dados para a tabela app-global.ultimos_usuarios: ~2 rows (aproximadamente)
DELETE FROM `ultimos_usuarios`;
/*!40000 ALTER TABLE `ultimos_usuarios` DISABLE KEYS */;
INSERT INTO `ultimos_usuarios` (`id`, `ultimo_usuario`, `linha`, `data_inicio`, `data_termino`, `data_alteracao`) VALUES
	(3, 'Luis Eduardo', '27988554488', '2020-02-20', '2020-02-25', '2020-02-25 21:57:01'),
	(6, 'Ronaldo Silva', '31992556644', '2020-02-22', NULL, '2020-02-26 08:58:19');
/*!40000 ALTER TABLE `ultimos_usuarios` ENABLE KEYS */;

-- Copiando estrutura para tabela app-global.users
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela app-global.users: ~0 rows (aproximadamente)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Luis Eduardo', 'admin@admin.com', NULL, '$2y$10$GOstnfWut.bEtsq7ICSnM.tASelr81aYn6X4Ep7WTlCsghr6l/r3C', 'GBx4AcNODAkpFgii3NwMr32UXz5Uk6iy8ERV3I96Jn1AeQhLDr6WeK1Lxxc9', '2020-02-14 19:18:31', '2020-02-14 19:18:31');
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
