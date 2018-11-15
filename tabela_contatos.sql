CREATE TABLE `contatos` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nome` varchar(64) DEFAULT NULL,
  `telefone` bigint(255) DEFAULT NULL,
  `email` varchar(32) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `descricao` varchar(256) DEFAULT NULL,
  `favorito` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
