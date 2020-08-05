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
  `operadora_id` int(10) NOT NULL,
  `grupo_id` int(10) DEFAULT 1,
  `observacao` varchar(145) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_contas_operadoras_idx` (`operadora_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.contas: ~4 rows (aproximadamente)
DELETE FROM `contas`;
/*!40000 ALTER TABLE `contas` DISABLE KEYS */;
INSERT INTO `contas` (`id`, `conta`, `empresa_id`, `operadora_id`, `grupo_id`, `observacao`, `updated_at`) VALUES
	(1, '120604594', 1, 4, 1, NULL, NULL),
	(2, '112967994', 2, 1, 1, NULL, NULL),
	(3, '153936991', 1, 1, 1, NULL, NULL),
	(4, '71423692', 1, 3, 1, NULL, NULL),
	(5, '71544563', 1, 3, 1, NULL, NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.empresas: ~2 rows (aproximadamente)
DELETE FROM `empresas`;
/*!40000 ALTER TABLE `empresas` DISABLE KEYS */;
INSERT INTO `empresas` (`id`, `razao_social`, `cnpj`, `grupo_id`, `observacao`, `updated_at`) VALUES
	(1, 'A Gazeta do Espirito Santo Rádio e TV LTDA', '27063726000120', 1, NULL, NULL),
	(2, 'Radio Difusora Princesa do Sul', '27468008000133', 1, NULL, NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela app-global.filiais: ~12 rows (aproximadamente)
DELETE FROM `filiais`;
/*!40000 ALTER TABLE `filiais` DISABLE KEYS */;
INSERT INTO `filiais` (`id`, `filial`, `grupo_id`, `observacao`, `updated_at`) VALUES
	(1, 'CBN', 1, NULL, NULL),
	(2, 'FM102', 1, NULL, NULL),
	(3, 'FM 102 (Linhares)', 1, NULL, NULL),
	(4, 'Nova Geração', 1, NULL, NULL),
	(5, 'Radio Cidadã', 1, NULL, NULL),
	(6, 'Radio Difusora', 1, NULL, NULL),
	(7, 'S/A', 1, NULL, NULL),
	(8, 'Sem ID', 1, NULL, NULL),
	(9, 'TV', 1, NULL, NULL),
	(10, 'TV Cachoeiro', 1, NULL, NULL),
	(11, 'TV Noroeste', 1, NULL, NULL),
	(12, 'TV Norte', 1, NULL, NULL);
/*!40000 ALTER TABLE `filiais` ENABLE KEYS */;

-- Copiando estrutura para tabela app-global.funcoes
CREATE TABLE IF NOT EXISTS `funcoes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `funcao` varchar(50) NOT NULL DEFAULT '0',
  `grupo_id` int(10) unsigned NOT NULL,
  `observacao` varchar(145) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_funcoes_grupos` (`grupo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.funcoes: ~76 rows (aproximadamente)
DELETE FROM `funcoes`;
/*!40000 ALTER TABLE `funcoes` DISABLE KEYS */;
INSERT INTO `funcoes` (`id`, `funcao`, `grupo_id`, `observacao`, `updated_at`) VALUES
	(1, 'Advogado', 1, NULL, NULL),
	(2, 'Analista', 1, NULL, NULL),
	(3, 'Analista de Sistema', 1, NULL, NULL),
	(4, 'Analista Info', 1, NULL, NULL),
	(5, 'Ass. de Produção', 1, NULL, NULL),
	(6, 'Ass.Mkt', 1, NULL, NULL),
	(7, 'Assistente', 1, NULL, NULL),
	(8, 'Assistente de Serviços Gerais 2', 1, NULL, NULL),
	(9, 'Chefe de Manutenção', 1, NULL, NULL),
	(10, 'Chefe de Redação', 1, NULL, NULL),
	(11, 'Cinegrafista', 1, NULL, NULL),
	(12, 'Comercial', 1, NULL, NULL),
	(13, 'Contas', 1, NULL, NULL),
	(14, 'Contato', 1, NULL, NULL),
	(15, 'Contato Comercial', 1, NULL, NULL),
	(16, 'Contato G1', 1, NULL, NULL),
	(17, 'Coordenador', 1, NULL, NULL),
	(18, 'Coordenador Comercial Web', 1, NULL, NULL),
	(19, 'Coordenador de Promoção', 1, NULL, NULL),
	(20, 'Coordenador de Suporte', 1, NULL, NULL),
	(21, 'Coordenadora', 1, NULL, NULL),
	(22, 'Dados', 1, NULL, NULL),
	(23, 'Diretor', 1, NULL, NULL),
	(24, 'Diretor Digital Multimidia', 1, NULL, NULL),
	(25, 'Disponivel', 1, NULL, NULL),
	(26, 'Disposição', 1, NULL, NULL),
	(27, 'Editor', 1, NULL, NULL),
	(28, 'Editor Chefe', 1, NULL, NULL),
	(29, 'Editor Nucleo Entretenimento', 1, NULL, NULL),
	(30, 'Editora de Economia', 1, NULL, NULL),
	(31, 'Eletricísta', 1, NULL, NULL),
	(32, 'Entregador', 1, NULL, NULL),
	(33, 'Externa', 1, NULL, NULL),
	(34, 'Estoque', 1, NULL, NULL),
	(35, 'Evento', 1, NULL, NULL),
	(36, 'Executivo de Contas', 1, NULL, NULL),
	(37, 'Fotografo', 1, NULL, NULL),
	(38, 'Gazeta Online', 1, NULL, NULL),
	(39, 'Gerente', 1, NULL, NULL),
	(40, 'Gerente Marketing', 1, NULL, NULL),
	(41, 'Gerente Relações Institucionais', 1, NULL, NULL),
	(42, 'Interface', 1, NULL, NULL),
	(43, 'Ipad', 1, NULL, NULL),
	(44, 'Jornalista', 1, NULL, NULL),
	(45, 'Locutor', 1, NULL, NULL),
	(46, 'Locutor de Externa E Promoções', 1, NULL, NULL),
	(47, 'Modem', 1, NULL, NULL),
	(48, 'Modem 3G', 1, NULL, NULL),
	(49, 'Modem 4G', 1, NULL, NULL),
	(50, 'Monitoramento Remoto Dos Sites', 1, NULL, NULL),
	(51, 'Motorista', 1, NULL, NULL),
	(52, 'Não Especificado', 1, NULL, NULL),
	(53, 'Pabx', 1, NULL, NULL),
	(54, 'Pauta', 1, NULL, NULL),
	(55, 'Pauteiro', 1, NULL, NULL),
	(56, 'Produtor', 1, NULL, NULL),
	(57, 'Produtor Executivo E Sonoplasta', 1, NULL, NULL),
	(58, 'Promotor', 1, NULL, NULL),
	(59, 'Reportagem', 1, NULL, NULL),
	(60, 'Repórter', 1, NULL, NULL),
	(61, 'S.Gerais', 1, NULL, NULL),
	(62, 'Sac', 1, NULL, NULL),
	(63, 'Secretário', 1, NULL, NULL),
	(64, 'Sem Id', 1, NULL, NULL),
	(65, 'Só Rec. Torpedo', 1, NULL, NULL),
	(66, 'Sup. Cont. Mestre', 1, NULL, NULL),
	(67, 'Supervisor', 1, NULL, NULL),
	(68, 'Supervisor de Manutenção', 1, NULL, NULL),
	(69, 'Tablet', 1, NULL, NULL),
	(70, 'Tec. Noroeste', 1, NULL, NULL),
	(71, 'Técnico', 1, NULL, NULL),
	(72, 'Vivo Box', 1, NULL, NULL),
	(73, 'Whatsapp', 1, NULL, NULL),
	(74, 'Whatsapp Antena 1', 1, NULL, NULL),
	(75, 'Whatsapp Cbn', 1, NULL, NULL),
	(76, 'Whatssap', 1, NULL, NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.gestores: ~64 rows (aproximadamente)
DELETE FROM `gestores`;
/*!40000 ALTER TABLE `gestores` DISABLE KEYS */;
INSERT INTO `gestores` (`id`, `gestor`, `grupo_id`, `observacao`, `updated_at`) VALUES
	(1, 'Abdo Chequer Bou-Habib', 1, NULL, NULL),
	(2, 'Adinalte Joao Beltrame', 1, NULL, NULL),
	(3, 'Aglisson Lopes', 1, NULL, NULL),
	(4, 'Alexandre Destefani dos Santos', 1, NULL, NULL),
	(5, 'Andre Furlaneto', 1, NULL, NULL),
	(6, 'Andre Hees de Carvalho', 1, NULL, NULL),
	(7, 'Andre Luis Furlanetto Pacheco', 1, NULL, NULL),
	(8, 'Andre Luiz de Faria Junqueira', 1, NULL, NULL),
	(9, 'Angela Theodoro de Souza', 1, NULL, NULL),
	(10, 'Bruno Araujo Izidoro Pereira', 1, NULL, NULL),
	(11, 'Café', 1, NULL, NULL),
	(12, 'Camila de Andrade Rocha', 1, NULL, NULL),
	(13, 'Camila Uliana Donna', 1, NULL, NULL),
	(14, 'Carla Sobreira Gomes de Oliveira', 1, NULL, NULL),
	(15, 'Carlos Bittencurt', 1, NULL, NULL),
	(16, 'Carlos Dultra', 1, NULL, NULL),
	(17, 'Carlos Eduardo Pena', 1, NULL, NULL),
	(18, 'Carlos Fernando Monteiro Lindenberg Filho', 1, NULL, NULL),
	(19, 'Carlos Fernando Monteiro Lindenberg Neto', 1, NULL, NULL),
	(20, 'Carlos Henrique Benfica Neves', 1, NULL, NULL),
	(21, 'Davi Wescley dos Santos', 1, NULL, NULL),
	(22, 'Elaine Silva', 1, NULL, NULL),
	(23, 'Emerson Minimi', 1, NULL, NULL),
	(24, 'Felipe Ruback', 1, NULL, NULL),
	(25, 'Fernanda de Queiroz Castro', 1, NULL, NULL),
	(26, 'Fernando Bohn Geller', 1, NULL, NULL),
	(27, 'Gabriel Moura', 1, NULL, NULL),
	(28, 'Helder Luciano de Oliveira', 1, NULL, NULL),
	(29, 'Hugo Batista Prudêncio', 1, NULL, NULL),
	(30, 'Ivan Henrique Seatttle Reis', 1, NULL, NULL),
	(31, 'Joao Carlos Coser', 1, NULL, NULL),
	(32, 'João Carlos Cozer', 1, NULL, NULL),
	(33, 'Joelder Dansi', 1, NULL, NULL),
	(34, 'Jose Cesar Leite Junior', 1, NULL, NULL),
	(35, 'Jose Lopes dos Santos Rocha', 1, NULL, NULL),
	(36, 'Kassius', 1, NULL, NULL),
	(37, 'Leticia Paoliello Lindenberg', 1, NULL, NULL),
	(38, 'Luciane Ventura da Silva', 1, NULL, NULL),
	(39, 'Luciene Campagnaro', 1, NULL, NULL),
	(40, 'Marcio Chagas Do Nascimento', 1, NULL, NULL),
	(41, 'Maria Alice Paoliello Lindenber', 1, NULL, NULL),
	(42, 'Maria Helena Vargas de Azevedo', 1, NULL, NULL),
	(43, 'Marizete Pietralonga', 1, NULL, NULL),
	(44, 'Milson Bonomo', 1, NULL, NULL),
	(45, 'Milson Bonomo de Matos', 1, NULL, NULL),
	(46, 'Neulan Bastos', 1, NULL, NULL),
	(47, 'Paula Roseli Rodrigues', 1, NULL, NULL),
	(48, 'Paulo Roberto Monfrin Canno', 1, NULL, NULL),
	(49, 'Rafael Moreira dos Santos', 1, NULL, NULL),
	(50, 'Rafael Queiroz Silveira', 1, NULL, NULL),
	(51, 'Rafael Silveira', 1, NULL, NULL),
	(52, 'Ranieri Aguiar', 1, NULL, NULL),
	(53, 'Renan Effgen Fae', 1, NULL, NULL),
	(54, 'Ricardo Costi Ribeiro', 1, NULL, NULL),
	(55, 'Rodrigo Resende', 1, NULL, NULL),
	(56, 'Rogerio Machado Bastos', 1, NULL, NULL),
	(57, 'Sem ID', 1, NULL, NULL),
	(58, 'Sergio Alexandre', 1, NULL, NULL),
	(59, 'Sergio Luiz Lugon Grecco', 1, NULL, NULL),
	(60, 'Vinicius Batista', 1, NULL, NULL),
	(61, 'Vinicius Catrinque', 1, NULL, NULL),
	(62, 'Vinicius dos Santos Batista', 1, NULL, NULL),
	(63, 'Vitor Jubini', 1, NULL, NULL),
	(64, 'Wanderson Luiz Clemente', 1, NULL, NULL);
/*!40000 ALTER TABLE `gestores` ENABLE KEYS */;

-- Copiando estrutura para tabela app-global.grupos
CREATE TABLE IF NOT EXISTS `grupos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `grupo` varchar(50) NOT NULL,
  `observacao` varchar(145) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.grupos: ~0 rows (aproximadamente)
DELETE FROM `grupos`;
/*!40000 ALTER TABLE `grupos` DISABLE KEYS */;
INSERT INTO `grupos` (`id`, `grupo`, `observacao`, `updated_at`) VALUES
	(1, 'Gazeta', NULL, NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.grupos_users: ~0 rows (aproximadamente)
DELETE FROM `grupos_users`;
/*!40000 ALTER TABLE `grupos_users` DISABLE KEYS */;
INSERT INTO `grupos_users` (`id`, `grupos_id`, `users_id`, `observacao`, `updated_at`) VALUES
	(1, 1, 1, 'Administrador Gazeta', NULL);
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- Copiando dados para a tabela app-global.operadoras: ~3 rows (aproximadamente)
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.planos: ~11 rows (aproximadamente)
DELETE FROM `planos`;
/*!40000 ALTER TABLE `planos` DISABLE KEYS */;
INSERT INTO `planos` (`id`, `plano`, `grupo_id`, `operadora_id`, `observacao`, `updated_at`) VALUES
	(1, '10GB - Pacote Internet Ilimitado', 1, 1, NULL, NULL),
	(2, 'Assinatura Plano Sob Medida', 1, 1, NULL, NULL),
	(3, 'Liberty Web Empresa 10GB', 1, 3, NULL, NULL),
	(4, 'Liberty Web Empresa Multi 20GB', 1, 3, NULL, NULL),
	(5, 'Smart Empresas 0.5GB', 1, 4, NULL, NULL),
	(6, 'Smart Empresas 10GB', 1, 4, NULL, NULL),
	(7, 'Smart Empresas 2GB', 1, 4, NULL, NULL),
	(8, 'Smart Empresas 50GB', 1, 4, NULL, NULL),
	(9, 'Smart Empresas 5GB', 1, 4, NULL, NULL),
	(10, 'Smart Empresas Nacional Voz', 1, 4, NULL, NULL),
	(11, 'Vivo Empresa Flex', 1, 4, NULL, NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.setores: ~85 rows (aproximadamente)
DELETE FROM `setores`;
/*!40000 ALTER TABLE `setores` DISABLE KEYS */;
INSERT INTO `setores` (`id`, `setor`, `grupo_id`, `observacao`, `updated_at`) VALUES
	(1, 'A Gazeta.com', 1, NULL, NULL),
	(2, 'Área Industrial', 1, NULL, NULL),
	(3, 'Assessoria de Comunicação Emp.', 1, NULL, NULL),
	(4, 'Assessoria Jurídica', 1, NULL, NULL),
	(5, 'Call Center', 1, NULL, NULL),
	(6, 'Cedoc', 1, NULL, NULL),
	(7, 'Central Gazeta de Produções', 1, NULL, NULL),
	(8, 'Comercial / Marketing', 1, NULL, NULL),
	(9, 'Comercial G1 Ge', 1, NULL, NULL),
	(10, 'Comercial Gazeta Digital', 1, NULL, NULL),
	(11, 'Comercial Mídia Eletrônica Rad', 1, NULL, NULL),
	(12, 'Comercial Multimidia', 1, NULL, NULL),
	(13, 'Comercial Rádio Litoral Linhares', 1, NULL, NULL),
	(14, 'Comunicação Mercadologica', 1, NULL, NULL),
	(15, 'Conselho Administração', 1, NULL, NULL),
	(16, 'Desenvol. Comercial Corp.', 1, NULL, NULL),
	(17, 'Desenvolvimento de Produto E I', 1, NULL, NULL),
	(18, 'Despesas Promocionais NA', 1, NULL, NULL),
	(19, 'Diretoria de Mercado', 1, NULL, NULL),
	(20, 'Diretoria de Redação Mídia Imp.', 1, NULL, NULL),
	(21, 'Distribuição', 1, NULL, NULL),
	(22, 'Distribuição Própria Cariacica', 1, NULL, NULL),
	(23, 'Distribuição Própria Vitória', 1, NULL, NULL),
	(24, 'Distribuição Própria Vv', 1, NULL, NULL),
	(25, 'Entrega de Assinaturas', 1, NULL, NULL),
	(26, 'Estúdio Ag', 1, NULL, NULL),
	(27, 'Fotografia', 1, NULL, NULL),
	(28, 'G1', 1, NULL, NULL),
	(29, 'Gazeta Online', 1, NULL, NULL),
	(30, 'Gerência de Operações Rádios', 1, NULL, NULL),
	(31, 'Gestão Atendim. Cliente Leitor', 1, NULL, NULL),
	(32, 'Gestão Corporativa', 1, NULL, NULL),
	(33, 'Gestão Mídia Eletrônica Tv Cachoeiro', 1, NULL, NULL),
	(34, 'Gestão Mídia Eletrônica Tv Norte', 1, NULL, NULL),
	(35, 'Hard News', 1, NULL, NULL),
	(36, 'Impressão News Liner', 1, NULL, NULL),
	(37, 'Jornalismo', 1, NULL, NULL),
	(38, 'Mant.Tec Noroes', 1, NULL, NULL),
	(39, 'Manutenção Elétrica E Climatiz', 1, NULL, NULL),
	(40, 'Manutenção Estúdios E Externas', 1, NULL, NULL),
	(41, 'Marketing', 1, NULL, NULL),
	(42, 'Marketing Tv', 1, NULL, NULL),
	(43, 'Mercado Leitor', 1, NULL, NULL),
	(44, 'Mercado Nacional', 1, NULL, NULL),
	(45, 'Midia Digital', 1, NULL, NULL),
	(46, 'Mídia Eletrônica Rádiojornalis', 1, NULL, NULL),
	(47, 'Mídia Eletrônica Telejornalismo', 1, NULL, NULL),
	(48, 'Núcleo de Performace', 1, NULL, NULL),
	(49, 'Núcleo de Vendas', 1, NULL, NULL),
	(50, 'Opec', 1, NULL, NULL),
	(51, 'Opec Rádios', 1, NULL, NULL),
	(52, 'Operação Comercial', 1, NULL, NULL),
	(53, 'Presidência', 1, NULL, NULL),
	(54, 'Primeiro Caderno', 1, NULL, NULL),
	(55, 'Primeiro Caderno Noticia Agora', 1, NULL, NULL),
	(56, 'Projetos de Engenharia', 1, NULL, NULL),
	(57, 'Radio', 1, NULL, NULL),
	(58, 'Radio Cidadã', 1, NULL, NULL),
	(59, 'Radio Jornalismo', 1, NULL, NULL),
	(60, 'Rádio Litoral', 1, NULL, NULL),
	(61, 'Radio Litoral Colatina', 1, NULL, NULL),
	(62, 'Redação M. Midia', 1, NULL, NULL),
	(63, 'Relações Institucionais', 1, NULL, NULL),
	(64, 'Reportagem', 1, NULL, NULL),
	(65, 'Rio Doce Fm', 1, NULL, NULL),
	(66, 'S.Gerais', 1, NULL, NULL),
	(67, 'Sem ID', 1, NULL, '2020-07-30 10:07:03'),
	(68, 'Serviços Gerais', 1, NULL, NULL),
	(69, 'Solo', 1, NULL, NULL),
	(70, 'Sucursal Brasília', 1, NULL, NULL),
	(71, 'Sucursal Cachoeiro', 1, NULL, NULL),
	(72, 'Sucursal Colatina', 1, NULL, NULL),
	(73, 'Suprimentos', 1, NULL, NULL),
	(74, 'Tecnologia', 1, NULL, NULL),
	(75, 'Tecnologia de Informática', 1, NULL, NULL),
	(76, 'Telejorn. Noroeste', 1, NULL, NULL),
	(77, 'Telejorn. Norte', 1, NULL, NULL),
	(78, 'Telejornalismo', 1, NULL, NULL),
	(79, 'Telemetria', 1, NULL, NULL),
	(80, 'Tesouraria', 1, NULL, NULL),
	(81, 'Transmissão / Retransmissão', 1, NULL, NULL),
	(82, 'Transporte', 1, NULL, NULL),
	(83, 'Tv Norte', 1, NULL, NULL),
	(84, 'Tv Sul', 1, NULL, NULL),
	(85, 'Venda Avulsa', 1, NULL, NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.subsetores: ~90 rows (aproximadamente)
DELETE FROM `subsetores`;
/*!40000 ALTER TABLE `subsetores` DISABLE KEYS */;
INSERT INTO `subsetores` (`id`, `subsetor`, `grupo_id`, `observacao`, `updated_at`) VALUES
	(1, '315.291.100.1529', 1, NULL, NULL),
	(2, '315.291.100.1528', 1, NULL, NULL),
	(3, '315.291.900.9822', 1, NULL, NULL),
	(4, '315.291.100.1344', 1, NULL, NULL),
	(5, '315.291.100.1500', 1, NULL, NULL),
	(6, '315.291.230.2360', 1, NULL, NULL),
	(7, '315.291.410.4400', 1, NULL, NULL),
	(8, '315.291.100.1522', 1, NULL, NULL),
	(9, '315.291.100.1374', 1, NULL, NULL),
	(10, '315.291.200.1219', 1, NULL, NULL),
	(11, '315.291.200.9720', 1, NULL, NULL),
	(12, '315.291.342.3617', 1, NULL, NULL),
	(13, '315.291.310.3600', 1, NULL, NULL),
	(14, '315.291.220.9750', 1, NULL, NULL),
	(15, '315.291.210.2310', 1, NULL, NULL),
	(16, '315.291.110.1515', 1, NULL, NULL),
	(17, '315.291.341.3616', 1, NULL, NULL),
	(18, '315.291.900.9112', 1, NULL, NULL),
	(19, '315.291.100.1200', 1, NULL, NULL),
	(20, '315.291.100.1505', 1, NULL, NULL),
	(21, '315.291.100.1220', 1, NULL, NULL),
	(22, '315.291.300.3630', 1, NULL, NULL),
	(23, '315.291.200.2120', 1, NULL, NULL),
	(24, '315.291.300.3690', 1, NULL, NULL),
	(25, '315.291.300.3300', 1, NULL, NULL),
	(26, '315.291.210.9118', 1, NULL, NULL),
	(27, '315.291.210.1251', 1, NULL, NULL),
	(28, '315.291.900.9100', 1, NULL, NULL),
	(29, '315.291.900.2216', 1, NULL, NULL),
	(30, '315.291.100.1371', 1, NULL, NULL),
	(31, '315.291.410.4300', 1, NULL, NULL),
	(32, '315.291.900.9824', 1, NULL, NULL),
	(33, '315.291.900.9826', 1, NULL, NULL),
	(34, '315.291.410.4200', 1, NULL, NULL),
	(35, '315.291.100.3200', 1, NULL, NULL),
	(36, '315.291.100.1525', 1, NULL, NULL),
	(37, '315.291.100.1352', 1, NULL, NULL),
	(38, '315.291.210.2300', 1, NULL, NULL),
	(39, '315.291.220.2220', 1, NULL, NULL),
	(40, '315.291.900.9000', 1, NULL, NULL),
	(41, '315.291.100.1378', 1, NULL, NULL),
	(42, '315.291.210.2473', 1, NULL, NULL),
	(43, '315.291.200.2150', 1, NULL, NULL),
	(44, '315.291.200.2470', 1, NULL, NULL),
	(45, '315.291.210.2471', 1, NULL, NULL),
	(46, '315.291.100.1503', 1, NULL, NULL),
	(47, '315.291.900.9107', 1, NULL, NULL),
	(48, '315.291.100.1251', 1, NULL, NULL),
	(49, '315.291.300.9220', 1, NULL, NULL),
	(50, '315.291.900.9710', 1, NULL, NULL),
	(51, '315.291.210.2240', 1, NULL, NULL),
	(52, '315.291.100.9107', 1, NULL, NULL),
	(53, '315.291.900.9120', 1, NULL, NULL),
	(54, '315.291.100.1211', 1, NULL, NULL),
	(55, '315.291.312.3208', 1, NULL, NULL),
	(56, '315.291.100.9220', 1, NULL, NULL),
	(57, '315.291.312.3618', 1, NULL, NULL),
	(58, '315.291.210.2200', 1, NULL, NULL),
	(59, '315.291.200.2610', 1, NULL, NULL),
	(60, '315.291.322.3611', 1, NULL, NULL),
	(61, '315.291.210.1220', 1, NULL, NULL),
	(62, '315.291.900.1220', 1, NULL, NULL),
	(63, '315.291.100.1521', 1, NULL, NULL),
	(64, '315.291.900.9790', 1, NULL, NULL),
	(65, '315.291.210.2600', 1, NULL, NULL),
	(66, '315.291.200.9790', 1, NULL, NULL),
	(67, '315.291.900.9101', 1, NULL, NULL),
	(68, '315.291.100.1150', 1, NULL, NULL),
	(69, '315.291.900.9810', 1, NULL, NULL),
	(70, '315.291.300.3215', 1, NULL, NULL),
	(71, '315.291.900.9725', 1, NULL, NULL),
	(72, '315.291.300.2200', 1, NULL, NULL),
	(73, '315.291.300.1212', 1, NULL, NULL),
	(74, '315.291.230.9760', 1, NULL, NULL),
	(75, '315.291.220.2350', 1, NULL, NULL),
	(76, '315.291.100.1400', 1, NULL, NULL),
	(77, '315.291.900.9111', 1, NULL, NULL),
	(78, '315.291.900.9315', 1, NULL, NULL),
	(79, '315.291.900.9700', 1, NULL, NULL),
	(80, '315.291.100.1251', 1, NULL, '2020-07-30 10:27:27'),
	(81, '315.291.260.2370', 1, NULL, NULL),
	(82, '315.291.260.9770', 1, NULL, NULL),
	(83, '315.291.100.1373', 1, NULL, NULL),
	(84, '315.291.900.9230', 1, NULL, NULL),
	(85, '315.291.100.1346', 1, NULL, NULL),
	(86, '315.291.200.2110', 1, NULL, NULL),
	(87, '315.291.120.1212', 1, NULL, NULL),
	(88, '315.291.200.2220', 1, NULL, NULL),
	(89, '315.291.300.1200', 1, NULL, NULL),
	(90, '315.291.410.4410', 1, NULL, NULL);
/*!40000 ALTER TABLE `subsetores` ENABLE KEYS */;

-- Copiando estrutura para tabela app-global.tipos_linhas
CREATE TABLE IF NOT EXISTS `tipos_linhas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tipos_UNIQUE` (`tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.tipos_linhas: ~3 rows (aproximadamente)
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.ultimos_usuarios: ~0 rows (aproximadamente)
DELETE FROM `ultimos_usuarios`;
/*!40000 ALTER TABLE `ultimos_usuarios` DISABLE KEYS */;
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

-- Copiando dados para a tabela app-global.users: ~1 rows (aproximadamente)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `tipo_usuario_id`, `observacao`, `created_at`, `updated_at`) VALUES
	(1, 'Luis Eduardo', 'luis@luis.admin', '2020-07-23 17:08:15', '$2y$10$w1S/LpBzlqUqw7K8RRJF5Oltj4Q9uAf0QwMyGd03xF6Av9yo8CpRO', 'mwAEBtNEnCOJpSr5qoZpa4kt4OsWJcfAOIPkxvFxQoYoBwtFB7vSCkXh4znZ', 1, NULL, '2020-07-17 15:29:55', '2020-07-23 20:03:41');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Copiando estrutura para trigger app-global.trigger_delete_ultimo_usuario
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `trigger_delete_ultimo_usuario` BEFORE DELETE ON `inventarios` FOR EACH ROW BEGIN
DELETE FROM ultimos_usuarios WHERE ultimos_usuarios.linha = OLD.linha;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

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
