# --------------------------------------------------------
# Host:                         127.0.0.1
# Server version:               5.5.8-log
# Server OS:                    Win32
# HeidiSQL version:             6.0.0.3603
# Date/time:                    2011-08-30 13:10:35
# --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

# Dumping database structure for vendepublicida3
CREATE DATABASE IF NOT EXISTS `vendepublicida3` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `vendepublicida3`;


# Dumping structure for table vendepublicida3.cliente
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
) ENGINE=InnoDB AUTO_INCREMENT=228 DEFAULT CHARSET=utf8;

# Dumping data for table vendepublicida3.cliente: ~135 rows (approximately)
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;

# Dumping structure for table vendepublicida3.enviado
CREATE TABLE IF NOT EXISTS `enviado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sms_id` int(11) NOT NULL,
  `usuario_id_destinatario` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=408 DEFAULT CHARSET=utf8;

# Dumping data for table vendepublicida3.enviado: ~329 rows (approximately)
/*!40000 ALTER TABLE `enviado` DISABLE KEYS */;

# Dumping structure for table vendepublicida3.grupo
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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

# Dumping data for table vendepublicida3.grupo: ~3 rows (approximately)
/*!40000 ALTER TABLE `grupo` DISABLE KEYS */;
REPLACE INTO `grupo` (`id`, `nome`, `usuario_id_criacao`, `usuario_id_atualizacao`, `deletado`, `usuario_id_deletado`, `data_deletado`, `data_criacao`, `data_atualizacao`) VALUES
	(27, 'IFPI', 1, 1, 0, NULL, '2011-06-02 16:34:08', '2011-06-02 16:34:08', '2011-06-02 16:34:08'),
	(28, 'Vende Publicidade', 1, 1, 0, NULL, '2011-06-02 20:23:32', '2011-06-02 20:23:32', '2011-06-02 20:23:32'),
	(29, 'Amigo', 1, 1, 0, NULL, '2011-06-05 15:22:43', '2011-06-05 15:22:43', '2011-06-05 15:22:43');
/*!40000 ALTER TABLE `grupo` ENABLE KEYS */;


# Dumping structure for table vendepublicida3.sms
CREATE TABLE IF NOT EXISTS `sms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mensagem` text NOT NULL,
  `usuario_id_envio` int(11) NOT NULL,
  `data_envio` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;

# Dumping data for table vendepublicida3.sms: ~38 rows (approximately)
/*!40000 ALTER TABLE `sms` DISABLE KEYS */;


# Dumping structure for table vendepublicida3.usuario
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

# Dumping data for table vendepublicida3.usuario: ~5 rows (approximately)
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
