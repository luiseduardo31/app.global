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

-- Copiando estrutura para tabela app-global.logs
CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `tipo_acao` varchar(10) DEFAULT NULL,
  `acao` varchar(150) DEFAULT NULL,
  `tabela` varchar(50) DEFAULT NULL,
  `registro_id` int(10) DEFAULT NULL,
  `grupo_id` int(10) DEFAULT NULL,
  `retorno` int(1) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela app-global.logs: ~17 rows (aproximadamente)
DELETE FROM `logs`;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` (`id`, `user_id`, `tipo_acao`, `acao`, `tabela`, `registro_id`, `grupo_id`, `retorno`, `updated_at`) VALUES
	(67, 1, 'Update', 'O status foi alterado para Ativa.', 'inventarios', 245, 1, 1, '2020-09-02 11:46:32'),
	(68, 1, 'Update', 'O usuario foi alterado para aaaa.', 'inventarios', 33, 1, 1, '2020-09-02 11:47:05'),
	(69, 1, 'Update', 'O chip foi alterado para 4444.', 'inventarios', 33, 1, 1, '2020-09-02 11:47:05'),
	(70, 1, 'Update', 'O status foi alterado para Cancelada.', 'inventarios', 33, 1, 1, '2020-09-02 11:47:05'),
	(71, 1, 'Update', 'O usuario foi alterado para Kamyla Monteiro.', 'inventarios', 207, 1, 1, '2020-09-02 11:49:32'),
	(72, 1, 'Update', 'O chip foi alterado para 0000222255554444.', 'inventarios', 207, 1, 1, '2020-09-02 11:49:32'),
	(73, 1, 'Update', 'A função foi alterada para Advogado.', 'inventarios', 207, 1, 1, '2020-09-02 11:49:32'),
	(74, 1, 'Update', 'A filial foi alterada para FM 102 (Linhares).', 'inventarios', 207, 1, 1, '2020-09-02 11:49:32'),
	(75, 1, 'Update', 'A conta foi alterada para 0001 Teste.', 'inventarios', 207, 1, 1, '2020-09-02 11:49:32'),
	(76, 1, 'Update', 'O setor foi alterado para A Gazeta.com.', 'inventarios', 207, 1, 1, '2020-09-02 11:49:32'),
	(77, 1, 'Update', 'O subsetor foi alterado para 315.291.100.1150.', 'inventarios', 207, 1, 1, '2020-09-02 11:49:32'),
	(78, 1, 'Update', 'O gestor foi alterado para Abdo Chequer Bou-Habib.', 'inventarios', 207, 1, 1, '2020-09-02 11:49:32'),
	(79, 1, 'Update', 'O plano foi alterado para 10GB - Pacote Internet Ilimitado.', 'inventarios', 207, 1, 1, '2020-09-02 11:49:32'),
	(80, 1, 'Update', 'O status foi alterado para Bloqueada.', 'inventarios', 207, 1, 1, '2020-09-02 11:49:32'),
	(81, 1, 'Update', 'O tipo da linha foi alterado para Dados.', 'inventarios', 207, 1, 1, '2020-09-02 11:49:32'),
	(82, 1, 'Update', 'O responsável despesa foi alterado para lucas.', 'inventarios', 207, 1, 1, '2020-09-02 11:49:32'),
	(83, 1, 'Update', 'A observação foi alterada para .', 'inventarios', 207, 1, 1, '2020-09-02 11:49:32');
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
