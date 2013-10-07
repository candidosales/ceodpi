# --------------------------------------------------------
# Host:                         127.0.0.1
# Server version:               5.5.8-log
# Server OS:                    Win32
# HeidiSQL version:             6.0.0.3603
# Date/time:                    2011-08-31 17:04:22
# --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

# Dumping database structure for mktpolitico
CREATE DATABASE IF NOT EXISTS `mktpolitico` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `mktpolitico`;


# Dumping structure for table mktpolitico.cliente
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=229 DEFAULT CHARSET=utf8;

# Dumping data for table mktpolitico.cliente: ~1 rows (approximately)
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
REPLACE INTO `cliente` (`id`, `nome`, `email`, `endereco`, `cidade`, `estado`, `pais`, `cep`, `tipo`, `instituicao`, `empresa`, `celular`, `data_nasc`, `data_inscricao`, `confirma_pagamento`, `data_confirma_pagamento`, `twitter`, `cpf`, `rg`, `tipo_participacao`, `usuario_id_deletado`, `deletado`, `data_deletado`, `grupo_id`, `grupo_nome`) VALUES
	(228, 'Cândido Sales Gomes', 'candidosg@gmail.com', 'dddddd', 'Teresina', 'Piauí', 'Brasil', '66.666-666', 'estudante', 'eeeeeeeeee', NULL, '(33) 3333-3333', '0000-00-00', '2011-08-30 20:40:55', 1, '2011-08-31 15:25:12', '', '333.333.333-33', '2222222', 'inscrito', 0, 0, '2011-08-30 20:40:55', 1, 'Curso Marketing Politico');
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;


# Dumping structure for table mktpolitico.enviado
CREATE TABLE IF NOT EXISTS `enviado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sms_id` int(11) NOT NULL,
  `usuario_id_destinatario` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Dumping data for table mktpolitico.enviado: ~0 rows (approximately)
/*!40000 ALTER TABLE `enviado` DISABLE KEYS */;
/*!40000 ALTER TABLE `enviado` ENABLE KEYS */;


# Dumping structure for table mktpolitico.grupo
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

# Dumping data for table mktpolitico.grupo: ~1 rows (approximately)
/*!40000 ALTER TABLE `grupo` DISABLE KEYS */;
REPLACE INTO `grupo` (`id`, `nome`, `usuario_id_criacao`, `usuario_id_atualizacao`, `deletado`, `usuario_id_deletado`, `data_deletado`, `data_criacao`, `data_atualizacao`) VALUES
	(1, 'Curso Marketing Politico', 1, 1, 0, 0, NULL, '2011-08-30 20:16:07', '2011-08-30 20:16:08');
/*!40000 ALTER TABLE `grupo` ENABLE KEYS */;


# Dumping structure for table mktpolitico.sms
CREATE TABLE IF NOT EXISTS `sms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mensagem` text NOT NULL,
  `usuario_id_envio` int(11) NOT NULL,
  `data_envio` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Dumping data for table mktpolitico.sms: ~0 rows (approximately)
/*!40000 ALTER TABLE `sms` DISABLE KEYS */;
/*!40000 ALTER TABLE `sms` ENABLE KEYS */;


# Dumping structure for table mktpolitico.transacao_moip
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
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;

# Dumping data for table mktpolitico.transacao_moip: ~8 rows (approximately)
/*!40000 ALTER TABLE `transacao_moip` DISABLE KEYS */;
REPLACE INTO `transacao_moip` (`id`, `id_transacao`, `cliente_id`, `cliente_nome`, `valor`, `data_criacao`, `status_pagamento`, `cod_moip`, `forma_pagamento`, `tipo_pagamento`, `email_consumidor`) VALUES
	(1, NULL, 277, 'Cândido Sales Gomes', 600, '2011-08-31 11:30:14', NULL, NULL, NULL, NULL, NULL),
	(54, NULL, NULL, NULL, NULL, '2011-08-31 15:18:23', NULL, NULL, NULL, NULL, NULL),
	(55, '_Ab123', NULL, NULL, 60000, '2011-08-31 15:18:25', 4, 0, 1, 'BoletoBancario', 'candidosg@gmail.com'),
	(56, '_Ab123', NULL, NULL, 60000, '2011-08-31 15:19:13', 4, 0, 1, 'BoletoBancario', 'candidosg@gmail.com'),
	(57, '_Ab123', NULL, NULL, 60000, '2011-08-31 15:22:04', 4, 0, 1, 'BoletoBancario', 'candidosg@gmail.com'),
	(58, '_Ab123', NULL, NULL, 60000, '2011-08-31 15:22:18', 4, 0, 1, 'BoletoBancario', 'candidosg@gmail.com'),
	(59, '_Ab123', NULL, NULL, 60000, '2011-08-31 15:25:01', 4, 0, 1, 'BoletoBancario', 'candidosg@gmail.com'),
	(60, '_Ab123', NULL, NULL, 60000, '2011-08-31 15:25:12', 4, 0, 1, 'BoletoBancario', 'candidosg@gmail.com');
/*!40000 ALTER TABLE `transacao_moip` ENABLE KEYS */;


# Dumping structure for table mktpolitico.usuario
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

# Dumping data for table mktpolitico.usuario: ~1 rows (approximately)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
REPLACE INTO `usuario` (`id`, `nome`, `login`, `senha`, `regra`, `email`, `tel`, `data_criacao`, `data_atualizacao`, `deletado`, `usuario_id_atualizacao`, `ultimo_acesso`, `usuario_id_criacao`, `data_deletado`, `usuario_id_deletado`) VALUES
	(1, 'Cândido', 'candidosales', '12345', 'administrador', 'candidosg@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
