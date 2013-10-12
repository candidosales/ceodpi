-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.5.24-log - MySQL Community Server (GPL)
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              8.1.0.4545
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura para tabela xceodpi.cliente
CREATE TABLE IF NOT EXISTS `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `endereco` text NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `estado` varchar(10) NOT NULL,
  `pais` varchar(100) NOT NULL,
  `cep` varchar(20) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `instituicao` varchar(150) DEFAULT NULL,
  `empresa` varchar(100) DEFAULT NULL,
  `celular` varchar(20) NOT NULL,
  `data_nasc` date NOT NULL,
  `data_inscricao` datetime NOT NULL,
  `confirma_pagamento` int(11) NOT NULL,
  `data_confirma_pagamento` datetime DEFAULT NULL,
  `twitter` varchar(100) DEFAULT NULL,
  `cpf` varchar(20) NOT NULL,
  `rg` varchar(20) NOT NULL,
  `tipo_participacao` varchar(20) NOT NULL,
  `usuario_id_deletado` int(11) NOT NULL,
  `deletado` int(11) NOT NULL,
  `data_deletado` datetime NOT NULL,
  `grupo_id` int(11) NOT NULL,
  `grupo_nome` varchar(50) NOT NULL,
  `filiado` varchar(50) NOT NULL,
  `hospedagem` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela xceodpi.cliente: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` (`id`, `nome`, `email`, `endereco`, `cidade`, `estado`, `pais`, `cep`, `tipo`, `instituicao`, `empresa`, `celular`, `data_nasc`, `data_inscricao`, `confirma_pagamento`, `data_confirma_pagamento`, `twitter`, `cpf`, `rg`, `tipo_participacao`, `usuario_id_deletado`, `deletado`, `data_deletado`, `grupo_id`, `grupo_nome`, `filiado`, `hospedagem`) VALUES
	(17, 'GEORGE NEGREIROS', 'georgenegreiros@hotmail.com', 'RUA 07 DE SETEMBRO - 34 - CENTRO', 'CURRAIS NOVOS', 'ACRE', 'BRASIL', '59.380-000', '1', '', 'GENE - COMUNICAÇÃO E MARKETING', '(84) 8884-3327', '0000-00-00', '2011-10-05 00:55:29', 1, '2013-10-07 12:19:24', '', '912.750.594-49', '1323635', 'inscrito', 0, 0, '0000-00-00 00:00:00', 1, '', '', NULL),
	(26, 'OKOKOK', 'okoko@okoko.com', '', '', '', '', '', '', '', '', '(23) 1231-2312', '0000-00-00', '2013-10-07 12:03:37', 0, NULL, '', '', '', 'inscrito', 0, 0, '2013-10-07 12:03:37', 3, 'OK', '', ''),
	(27, 'SACSACSACAS', 'candidosg@gmail.com', 'ERTRET', '435435', 'PIAUÍ', 'BRASIL', '43.543-534', '1', '34', '', '(53) 4534-5345', '0000-00-00', '2013-10-07 12:09:05', 0, NULL, '34342', '006.737.443-37', '243324234', 'inscrito', 0, 0, '2013-10-07 12:09:05', 1, 'X Congresso Estadual da Ordem DeMolay', '0', NULL);
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;


-- Copiando estrutura para tabela xceodpi.enviado
CREATE TABLE IF NOT EXISTS `enviado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sms_id` int(11) NOT NULL,
  `usuario_id_destinatario` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela xceodpi.enviado: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `enviado` DISABLE KEYS */;
/*!40000 ALTER TABLE `enviado` ENABLE KEYS */;


-- Copiando estrutura para tabela xceodpi.grupo
CREATE TABLE IF NOT EXISTS `grupo` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT '0',
  `usuario_id_criacao` int(11) DEFAULT '0',
  `usuario_id_atualizacao` int(11) DEFAULT '0',
  `deletado` int(11) DEFAULT '0',
  `usuario_id_deletado` int(11) DEFAULT '0',
  `data_deletado` datetime DEFAULT NULL,
  `data_criacao` datetime DEFAULT NULL,
  `data_atualizacao` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela xceodpi.grupo: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `grupo` DISABLE KEYS */;
INSERT INTO `grupo` (`id`, `nome`, `usuario_id_criacao`, `usuario_id_atualizacao`, `deletado`, `usuario_id_deletado`, `data_deletado`, `data_criacao`, `data_atualizacao`) VALUES
	(1, 'CEOD', 1, 1, 0, 0, NULL, '2011-08-30 20:16:07', '2011-08-30 20:16:08'),
	(3, 'OK', 1, 1, 0, NULL, '2013-10-07 12:03:26', '2013-10-07 12:03:26', '2013-10-07 12:03:26');
/*!40000 ALTER TABLE `grupo` ENABLE KEYS */;


-- Copiando estrutura para tabela xceodpi.participante
CREATE TABLE IF NOT EXISTS `participante` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `cpf` varchar(100) DEFAULT NULL,
  `data_participacao` datetime DEFAULT NULL,
  `value1` varchar(100) DEFAULT NULL,
  `value2` varchar(100) DEFAULT NULL,
  `value3` varchar(100) DEFAULT NULL,
  `value4` varchar(100) DEFAULT NULL,
  `value5` varchar(100) DEFAULT NULL,
  `value6` varchar(100) DEFAULT NULL,
  `value7` varchar(100) DEFAULT NULL,
  `value8` varchar(100) DEFAULT NULL,
  `value9` varchar(100) DEFAULT NULL,
  `value10` varchar(100) DEFAULT NULL,
  `value11` varchar(100) DEFAULT NULL,
  `value12` varchar(100) DEFAULT NULL,
  `value13` varchar(100) DEFAULT NULL,
  `value14` varchar(100) DEFAULT NULL,
  `value15` varchar(100) DEFAULT NULL,
  `value16` varchar(100) DEFAULT NULL,
  `value17` varchar(100) DEFAULT NULL,
  `value18` varchar(100) DEFAULT NULL,
  `value19` varchar(100) DEFAULT NULL,
  `value20` varchar(100) DEFAULT NULL,
  `value21` varchar(100) DEFAULT NULL,
  `value22` varchar(100) DEFAULT NULL,
  `value23` varchar(100) DEFAULT NULL,
  `value24` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela xceodpi.participante: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `participante` DISABLE KEYS */;
INSERT INTO `participante` (`id`, `nome`, `email`, `cpf`, `data_participacao`, `value1`, `value2`, `value3`, `value4`, `value5`, `value6`, `value7`, `value8`, `value9`, `value10`, `value11`, `value12`, `value13`, `value14`, `value15`, `value16`, `value17`, `value18`, `value19`, `value20`, `value21`, `value22`, `value23`, `value24`) VALUES
	(8, 'BRENO ', 'breno@gmail.com', '006.737.443-37', '2012-06-11 17:41:27', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24');
/*!40000 ALTER TABLE `participante` ENABLE KEYS */;


-- Copiando estrutura para tabela xceodpi.sms
CREATE TABLE IF NOT EXISTS `sms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mensagem` text NOT NULL,
  `usuario_id_envio` int(11) NOT NULL,
  `data_envio` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela xceodpi.sms: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `sms` DISABLE KEYS */;
/*!40000 ALTER TABLE `sms` ENABLE KEYS */;


-- Copiando estrutura para tabela xceodpi.transacao_moip
CREATE TABLE IF NOT EXISTS `transacao_moip` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_transacao` varchar(50) DEFAULT NULL,
  `cliente_id` int(10) DEFAULT '0',
  `cliente_nome` varchar(100) DEFAULT '0',
  `valor` float DEFAULT '0',
  `data_criacao` datetime DEFAULT NULL,
  `status_pagamento` int(10) DEFAULT NULL,
  `cod_moip` int(10) DEFAULT NULL,
  `forma_pagamento` int(10) DEFAULT NULL,
  `tipo_pagamento` varchar(50) DEFAULT NULL,
  `email_consumidor` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela xceodpi.transacao_moip: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `transacao_moip` DISABLE KEYS */;
INSERT INTO `transacao_moip` (`id`, `id_transacao`, `cliente_id`, `cliente_nome`, `valor`, `data_criacao`, `status_pagamento`, `cod_moip`, `forma_pagamento`, `tipo_pagamento`, `email_consumidor`) VALUES
	(83, NULL, 1, 'Cândido Sales', 1500, '2012-05-08 20:22:41', NULL, NULL, NULL, NULL, NULL),
	(84, NULL, 1, 'Cândido Sales', 1500, '2012-05-08 20:39:09', NULL, NULL, NULL, NULL, NULL),
	(85, NULL, 1, 'Cândido Sales', 1500, '2012-05-08 20:47:25', NULL, NULL, NULL, NULL, NULL),
	(86, NULL, 1, 'Cândido Sales', 1500, '2012-05-08 20:54:40', NULL, NULL, NULL, NULL, NULL),
	(87, NULL, 1, 'Cândido Sales', 1500, '2012-05-08 20:55:42', NULL, NULL, NULL, NULL, NULL),
	(88, NULL, 1, 'Cândido Sales', 1500, '2012-05-08 21:31:41', NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `transacao_moip` ENABLE KEYS */;


-- Copiando estrutura para tabela xceodpi.transacao_pagseguro
CREATE TABLE IF NOT EXISTS `transacao_pagseguro` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_transacao` int(10) DEFAULT NULL,
  `cliente_nome` varchar(100) DEFAULT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `data_criacao` datetime DEFAULT NULL,
  `valor` float DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `reference` varchar(50) DEFAULT NULL,
  `payment_method_type` int(11) DEFAULT NULL,
  `payment_method_code` int(11) DEFAULT NULL,
  `sender_email` varchar(100) DEFAULT NULL,
  `last_event_date` date DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela xceodpi.transacao_pagseguro: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `transacao_pagseguro` DISABLE KEYS */;
INSERT INTO `transacao_pagseguro` (`id`, `id_transacao`, `cliente_nome`, `cliente_id`, `data_criacao`, `valor`, `code`, `reference`, `payment_method_type`, `payment_method_code`, `sender_email`, `last_event_date`, `status`) VALUES
	(1, NULL, 'Cândido Sales', 1, '2012-06-13 01:13:13', 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(2, NULL, 'Cândido Sales', 22, '2012-06-13 01:37:51', 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `transacao_pagseguro` ENABLE KEYS */;


-- Copiando estrutura para tabela xceodpi.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `login` varchar(45) DEFAULT NULL,
  `senha` varchar(45) DEFAULT NULL,
  `regra` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `tel` varchar(45) DEFAULT NULL,
  `data_criacao` datetime DEFAULT NULL,
  `data_atualizacao` datetime DEFAULT NULL,
  `deletado` int(11) DEFAULT NULL,
  `usuario_id_atualizacao` int(11) DEFAULT NULL,
  `ultimo_acesso` datetime DEFAULT NULL,
  `usuario_id_criacao` int(11) DEFAULT NULL,
  `data_deletado` datetime DEFAULT NULL,
  `usuario_id_deletado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario_usuario1` (`usuario_id_atualizacao`),
  KEY `fk_usuario_usuario2` (`usuario_id_criacao`),
  CONSTRAINT `fk_usuario_usuario1` FOREIGN KEY (`usuario_id_atualizacao`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_usuario2` FOREIGN KEY (`usuario_id_criacao`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela xceodpi.usuario: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id`, `nome`, `login`, `senha`, `regra`, `email`, `tel`, `data_criacao`, `data_atualizacao`, `deletado`, `usuario_id_atualizacao`, `ultimo_acesso`, `usuario_id_criacao`, `data_deletado`, `usuario_id_deletado`) VALUES
	(1, 'Cândido', 'candidosales', '12345', 'administrador', 'candidosg@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(2, 'Candim', 'caca', 'caca', 'assistente', 'candidosg@gmail.com', '(333) 3333-3333', '2011-09-12 23:18:24', '2011-09-16 00:29:55', 0, 2, NULL, 1, NULL, NULL);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
