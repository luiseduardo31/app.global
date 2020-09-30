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