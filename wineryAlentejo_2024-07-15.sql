# ************************************************************
# Sequel Pro SQL dump
# Versão 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.4.21-MariaDB)
# Base de Dados: wineryAlentejo
# Tempo de Geração: 2024-07-15 07:22:51 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump da tabela ano
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ano`;

CREATE TABLE `ano` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `ano` WRITE;
/*!40000 ALTER TABLE `ano` DISABLE KEYS */;

INSERT INTO `ano` (`id`, `descricao`)
VALUES
	(1,2021),
	(2,2022),
	(3,2023);

/*!40000 ALTER TABLE `ano` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela castas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `castas`;

CREATE TABLE `castas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `castas` WRITE;
/*!40000 ALTER TABLE `castas` DISABLE KEYS */;

INSERT INTO `castas` (`id`, `descricao`)
VALUES
	(1,'Aragonês'),
	(2,'Trincadeira'),
	(3,'Alicante Bouschet'),
	(4,'Syrah'),
	(5,'Touriga Nacional');

/*!40000 ALTER TABLE `castas` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela estado_funcionario
# ------------------------------------------------------------

DROP TABLE IF EXISTS `estado_funcionario`;

CREATE TABLE `estado_funcionario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descr` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `estado_funcionario` WRITE;
/*!40000 ALTER TABLE `estado_funcionario` DISABLE KEYS */;

INSERT INTO `estado_funcionario` (`id`, `descr`)
VALUES
	(1,'Ativo'),
	(2,'Inativo');

/*!40000 ALTER TABLE `estado_funcionario` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela funcionarios
# ------------------------------------------------------------

DROP TABLE IF EXISTS `funcionarios`;

CREATE TABLE `funcionarios` (
  `bi` int(11) NOT NULL,
  `nome` text DEFAULT NULL,
  `morada` text DEFAULT NULL,
  `telefone` int(11) DEFAULT NULL,
  `email` text DEFAULT NULL,
  `salario` double DEFAULT NULL,
  `id_estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`bi`),
  KEY `id_estado` (`id_estado`),
  CONSTRAINT `funcionarios_ibfk_1` FOREIGN KEY (`id_estado`) REFERENCES `estado_funcionario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump da tabela vindima
# ------------------------------------------------------------

DROP TABLE IF EXISTS `vindima`;

CREATE TABLE `vindima` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_vinha` int(11) DEFAULT NULL,
  `id_funcionario` int(11) DEFAULT NULL,
  `kg` float DEFAULT NULL,
  `dth` datetime DEFAULT NULL,
  `id_ano` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_funcionario` (`id_funcionario`),
  KEY `id_vinha` (`id_vinha`),
  KEY `id_ano` (`id_ano`),
  CONSTRAINT `vindima_ibfk_1` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionarios` (`bi`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `vindima_ibfk_2` FOREIGN KEY (`id_vinha`) REFERENCES `vinha` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `vindima_ibfk_3` FOREIGN KEY (`id_ano`) REFERENCES `ano` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump da tabela vinha
# ------------------------------------------------------------

DROP TABLE IF EXISTS `vinha`;

CREATE TABLE `vinha` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` text DEFAULT NULL,
  `ha` int(11) DEFAULT NULL,
  `data_plantacao` date DEFAULT NULL,
  `ano_p_colheita` int(11) DEFAULT NULL,
  `foto` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump da tabela vinhas_castas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `vinhas_castas`;

CREATE TABLE `vinhas_castas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_vinha` int(11) DEFAULT NULL,
  `id_casta` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_vinha` (`id_vinha`),
  KEY `id_casta` (`id_casta`),
  CONSTRAINT `vinhas_castas_ibfk_1` FOREIGN KEY (`id_vinha`) REFERENCES `vinha` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `vinhas_castas_ibfk_2` FOREIGN KEY (`id_casta`) REFERENCES `castas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump da tabela vinhos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `vinhos`;

CREATE TABLE `vinhos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `total` int(11) DEFAULT NULL,
  `id_vindima` int(11) DEFAULT NULL,
  `nome` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_vindima` (`id_vindima`),
  CONSTRAINT `vinhos_ibfk_1` FOREIGN KEY (`id_vindima`) REFERENCES `vindima` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
