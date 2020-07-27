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
  KEY `fk_contas_operadoras_idx` (`operadora_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.contas: ~1 rows (aproximadamente)
DELETE FROM `contas`;
/*!40000 ALTER TABLE `contas` DISABLE KEYS */;
INSERT INTO `contas` (`id`, `conta`, `empresa_id`, `observacao`, `operadora_id`, `grupo_id`, `updated_at`) VALUES
	(1, '010925656', 1, 'Teste conta 5656', 1, 1, NULL);
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
  KEY `FK_contratos_fixos_empresas` (`empresa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.contratos_fixos: ~0 rows (aproximadamente)
DELETE FROM `contratos_fixos`;
/*!40000 ALTER TABLE `contratos_fixos` DISABLE KEYS */;
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
  KEY `FK_contratos_fixos_empresas` (`empresa_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela app-global.contratos_moveis: ~0 rows (aproximadamente)
DELETE FROM `contratos_moveis`;
/*!40000 ALTER TABLE `contratos_moveis` DISABLE KEYS */;
/*!40000 ALTER TABLE `contratos_moveis` ENABLE KEYS */;

-- Copiando estrutura para tabela app-global.empresas
CREATE TABLE IF NOT EXISTS `empresas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `razao_social` varchar(50) NOT NULL,
  `cnpj` varchar(14) NOT NULL,
  `grupo_id` int(10) unsigned NOT NULL,
  `observacao` varchar(145) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_empresas_grupos` (`grupo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.empresas: ~1 rows (aproximadamente)
DELETE FROM `empresas`;
/*!40000 ALTER TABLE `empresas` DISABLE KEYS */;
INSERT INTO `empresas` (`id`, `razao_social`, `cnpj`, `grupo_id`, `observacao`, `updated_at`) VALUES
	(1, 'Extrabom Serra', '03845717001447', 1, 'Supermercado Serra', NULL);
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
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `filial` varchar(25) NOT NULL DEFAULT '0',
  `grupo_id` int(10) unsigned NOT NULL,
  `observacao` varchar(145) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_matriculas_grupos` (`grupo_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela app-global.filiais: ~1 rows (aproximadamente)
DELETE FROM `filiais`;
/*!40000 ALTER TABLE `filiais` DISABLE KEYS */;
INSERT INTO `filiais` (`id`, `filial`, `grupo_id`, `observacao`, `updated_at`) VALUES
	(1, 'Filial Serra', 1, 'Filial Serra-ES', NULL);
/*!40000 ALTER TABLE `filiais` ENABLE KEYS */;

-- Copiando estrutura para tabela app-global.funcoes
CREATE TABLE IF NOT EXISTS `funcoes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `funcao` varchar(25) NOT NULL DEFAULT '0',
  `grupo_id` int(10) unsigned NOT NULL,
  `observacao` varchar(145) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_funcoes_grupos` (`grupo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.funcoes: ~1 rows (aproximadamente)
DELETE FROM `funcoes`;
/*!40000 ALTER TABLE `funcoes` DISABLE KEYS */;
INSERT INTO `funcoes` (`id`, `funcao`, `grupo_id`, `observacao`, `updated_at`) VALUES
	(1, 'Motorista', 1, 'Motorista Caminhão', '2020-07-27 19:04:23');
/*!40000 ALTER TABLE `funcoes` ENABLE KEYS */;

-- Copiando estrutura para tabela app-global.gestores
CREATE TABLE IF NOT EXISTS `gestores` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '\n\n',
  `gestor` varchar(50) DEFAULT NULL,
  `grupo_id` int(10) unsigned NOT NULL,
  `observacao` varchar(145) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_gestores_grupos` (`grupo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.gestores: ~1 rows (aproximadamente)
DELETE FROM `gestores`;
/*!40000 ALTER TABLE `gestores` DISABLE KEYS */;
INSERT INTO `gestores` (`id`, `gestor`, `grupo_id`, `observacao`, `updated_at`) VALUES
	(1, 'Lucas Freitas', 1, 'Gestor Financeiro', '2020-07-27 19:06:24');
/*!40000 ALTER TABLE `gestores` ENABLE KEYS */;

-- Copiando estrutura para tabela app-global.grupos
CREATE TABLE IF NOT EXISTS `grupos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `grupo` varchar(50) NOT NULL,
  `observacao` varchar(145) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.grupos: ~1 rows (aproximadamente)
DELETE FROM `grupos`;
/*!40000 ALTER TABLE `grupos` DISABLE KEYS */;
INSERT INTO `grupos` (`id`, `grupo`, `observacao`, `updated_at`) VALUES
	(1, 'Grupo Realmar', 'Extrabom Supermercados', '2020-07-27 18:50:47');
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
  KEY `FK_grupos_users_users` (`users_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.grupos_users: ~2 rows (aproximadamente)
DELETE FROM `grupos_users`;
/*!40000 ALTER TABLE `grupos_users` DISABLE KEYS */;
INSERT INTO `grupos_users` (`id`, `grupos_id`, `users_id`, `observacao`, `updated_at`) VALUES
	(1, 1, 1, 'Luis com acesso ao Grupo Realmar', NULL),
	(2, 1, 19, NULL, NULL);
/*!40000 ALTER TABLE `grupos_users` ENABLE KEYS */;

-- Copiando estrutura para tabela app-global.inventarios
CREATE TABLE IF NOT EXISTS `inventarios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `linha` varchar(11) NOT NULL,
  `nome_usuario` varchar(25) DEFAULT NULL,
  `data_registro` date DEFAULT NULL,
  `chip` varchar(20) DEFAULT NULL,
  `funcao_id` int(10) unsigned NOT NULL,
  `filial_id` int(10) unsigned NOT NULL,
  `conta_id` int(10) unsigned NOT NULL,
  `setor_id` int(10) unsigned NOT NULL,
  `subsetor_id` int(10) unsigned NOT NULL,
  `gestor_id` int(10) unsigned NOT NULL,
  `plano_id` int(10) unsigned NOT NULL,
  `status_id` int(10) unsigned NOT NULL,
  `tipo_linha_id` int(10) unsigned NOT NULL,
  `grupo_id` int(10) unsigned DEFAULT 1,
  `resp_despesa` varchar(145) DEFAULT NULL,
  `observacao` text DEFAULT NULL,
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
  KEY `FK_inventarios_matriculas` (`filial_id`) USING BTREE,
  KEY `FK_INVENTARIO_GRUPO` (`grupo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.inventarios: ~0 rows (aproximadamente)
DELETE FROM `inventarios`;
/*!40000 ALTER TABLE `inventarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventarios` ENABLE KEYS */;

-- Copiando estrutura para tabela app-global.matriculas
CREATE TABLE IF NOT EXISTS `matriculas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `matricula` varchar(25) NOT NULL DEFAULT '0',
  `grupo_id` int(10) unsigned NOT NULL,
  `observacao` varchar(145) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_matriculas_grupos` (`grupo_id`)
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
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `operadora` varchar(50) DEFAULT NULL,
  `tipo_operadora` int(1) DEFAULT NULL COMMENT '1 = Móvel; 2 = Fixa',
  `observacao` varchar(145) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.operadoras: ~4 rows (aproximadamente)
DELETE FROM `operadoras`;
/*!40000 ALTER TABLE `operadoras` DISABLE KEYS */;
INSERT INTO `operadoras` (`id`, `operadora`, `tipo_operadora`, `observacao`) VALUES
	(1, 'Claro', 1, NULL),
	(2, 'Oi', 1, NULL),
	(3, 'Tim', 1, NULL),
	(4, 'Vivo', 1, NULL);
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
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `plano` varchar(50) DEFAULT NULL,
  `grupo_id` int(11) unsigned DEFAULT NULL,
  `operadora_id` int(11) unsigned DEFAULT NULL,
  `observacao` varchar(145) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.planos: ~2 rows (aproximadamente)
DELETE FROM `planos`;
/*!40000 ALTER TABLE `planos` DISABLE KEYS */;
INSERT INTO `planos` (`id`, `plano`, `grupo_id`, `operadora_id`, `observacao`, `updated_at`) VALUES
	(1, 'Smart Vivo 0.5GB', 1, 4, 'Vivo', NULL),
	(2, 'Claro 5GB', 1, 1, NULL, NULL);
/*!40000 ALTER TABLE `planos` ENABLE KEYS */;

-- Copiando estrutura para tabela app-global.setores
CREATE TABLE IF NOT EXISTS `setores` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `setor` varchar(50) NOT NULL,
  `grupo_id` int(10) unsigned NOT NULL,
  `observacao` varchar(145) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `FK_setores_grupos` (`grupo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.setores: ~1 rows (aproximadamente)
DELETE FROM `setores`;
/*!40000 ALTER TABLE `setores` DISABLE KEYS */;
INSERT INTO `setores` (`id`, `setor`, `grupo_id`, `observacao`, `updated_at`) VALUES
	(1, 'Financeiro', 1, 'Setor 01', '2020-07-27 19:10:21');
/*!40000 ALTER TABLE `setores` ENABLE KEYS */;

-- Copiando estrutura para tabela app-global.status
CREATE TABLE IF NOT EXISTS `status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(50) DEFAULT NULL,
  `observacao` varchar(145) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.status: ~4 rows (aproximadamente)
DELETE FROM `status`;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` (`id`, `status`, `observacao`) VALUES
	(1, 'Ativa', NULL),
	(2, 'Cancelada', NULL),
	(3, 'Bloqueada', NULL),
	(4, 'Estoque', NULL);
/*!40000 ALTER TABLE `status` ENABLE KEYS */;

-- Copiando estrutura para tabela app-global.subsetores
CREATE TABLE IF NOT EXISTS `subsetores` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subsetor` varchar(50) DEFAULT NULL,
  `grupo_id` int(10) unsigned NOT NULL,
  `observacao` varchar(145) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `FK_subsetores_grupos` (`grupo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.subsetores: ~1 rows (aproximadamente)
DELETE FROM `subsetores`;
/*!40000 ALTER TABLE `subsetores` DISABLE KEYS */;
INSERT INTO `subsetores` (`id`, `subsetor`, `grupo_id`, `observacao`, `updated_at`) VALUES
	(1, 'Admin Financeiro', 1, 'Subsetor 01', NULL);
/*!40000 ALTER TABLE `subsetores` ENABLE KEYS */;

-- Copiando estrutura para tabela app-global.tipos_linhas
CREATE TABLE IF NOT EXISTS `tipos_linhas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tipos_UNIQUE` (`tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.tipos_linhas: ~4 rows (aproximadamente)
DELETE FROM `tipos_linhas`;
/*!40000 ALTER TABLE `tipos_linhas` DISABLE KEYS */;
INSERT INTO `tipos_linhas` (`id`, `tipo`) VALUES
	(2, 'Dados'),
	(4, 'M2M'),
	(1, 'Voz'),
	(3, 'Voz + Dados');
/*!40000 ALTER TABLE `tipos_linhas` ENABLE KEYS */;

-- Copiando estrutura para tabela app-global.tipos_usuarios
CREATE TABLE IF NOT EXISTS `tipos_usuarios` (
  `id` int(2) unsigned NOT NULL AUTO_INCREMENT,
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
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ultimo_usuario` varchar(50) DEFAULT NULL,
  `linha` varchar(11) DEFAULT NULL,
  `data_inicio` date DEFAULT NULL,
  `data_termino` date DEFAULT NULL,
  `data_alteracao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.ultimos_usuarios: ~1 rows (aproximadamente)
DELETE FROM `ultimos_usuarios`;
/*!40000 ALTER TABLE `ultimos_usuarios` DISABLE KEYS */;
INSERT INTO `ultimos_usuarios` (`id`, `ultimo_usuario`, `linha`, `data_inicio`, `data_termino`, `data_alteracao`) VALUES
	(1, 'Luis Eduardo', '27996397522', '2020-07-01', '2020-07-27', '2020-07-27 16:20:20');
/*!40000 ALTER TABLE `ultimos_usuarios` ENABLE KEYS */;

-- Copiando estrutura para tabela app-global.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo_usuario_id` int(2) unsigned DEFAULT NULL,
  `observacao` varchar(85) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela app-global.users: ~2 rows (aproximadamente)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `tipo_usuario_id`, `observacao`, `created_at`, `updated_at`) VALUES
	(1, 'Luis Eduardo', 'luis@luis.admin', '2020-07-23 17:08:15', '$2y$10$w1S/LpBzlqUqw7K8RRJF5Oltj4Q9uAf0QwMyGd03xF6Av9yo8CpRO', 'mwAEBtNEnCOJpSr5qoZpa4kt4OsWJcfAOIPkxvFxQoYoBwtFB7vSCkXh4znZ', 1, NULL, '2020-07-17 15:29:55', '2020-07-23 20:03:41'),
	(19, 'vinicius', 'vini@vini.com', '2020-07-27 16:18:20', '$2y$10$lQMCf1LYLRjPhNKbt1b.Qesvkxbf875pXVkjtxOzfgScGnvBKrBvK', NULL, 2, 'aaa', '2020-07-27 19:18:20', '2020-07-27 19:18:20');
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
