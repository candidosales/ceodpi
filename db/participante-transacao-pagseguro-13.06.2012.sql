-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.8-log - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2012-06-13 01:39:01
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping database structure for encontro
CREATE DATABASE IF NOT EXISTS `encontro` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `encontro`;


-- Dumping structure for table encontro.participante
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

-- Dumping data for table encontro.participante: ~1 rows (approximately)
/*!40000 ALTER TABLE `participante` DISABLE KEYS */;
REPLACE INTO `participante` (`id`, `nome`, `email`, `cpf`, `data_participacao`, `value1`, `value2`, `value3`, `value4`, `value5`, `value6`, `value7`, `value8`, `value9`, `value10`, `value11`, `value12`, `value13`, `value14`, `value15`, `value16`, `value17`, `value18`, `value19`, `value20`, `value21`, `value22`, `value23`, `value24`) VALUES
	(8, 'BRENO ', 'breno@gmail.com', '006.737.443-37', '2012-06-11 17:41:27', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24');
/*!40000 ALTER TABLE `participante` ENABLE KEYS */;


-- Dumping structure for table encontro.transacao_pagseguro
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

-- Dumping data for table encontro.transacao_pagseguro: ~2 rows (approximately)
/*!40000 ALTER TABLE `transacao_pagseguro` DISABLE KEYS */;
REPLACE INTO `transacao_pagseguro` (`id`, `id_transacao`, `cliente_nome`, `cliente_id`, `data_criacao`, `valor`, `code`, `reference`, `payment_method_type`, `payment_method_code`, `sender_email`, `last_event_date`, `status`) VALUES
	(1, NULL, 'Cândido Sales', 1, '2012-06-13 01:13:13', 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(2, NULL, 'Cândido Sales', 22, '2012-06-13 01:37:51', 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `transacao_pagseguro` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
