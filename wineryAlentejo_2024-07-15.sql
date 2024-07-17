-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.7.0.6850
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for wineryalentejo
DROP DATABASE IF EXISTS `wineryalentejo`;
CREATE DATABASE IF NOT EXISTS `wineryalentejo` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `wineryalentejo`;

-- Dumping structure for table wineryalentejo.ano
DROP TABLE IF EXISTS `ano`;
CREATE TABLE IF NOT EXISTS `ano` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table wineryalentejo.ano: ~3 rows (approximately)
DELETE FROM `ano`;
INSERT INTO `ano` (`id`, `descricao`) VALUES
	(1, 2021),
	(2, 2022),
	(3, 2023);

-- Dumping structure for table wineryalentejo.castas
DROP TABLE IF EXISTS `castas`;
CREATE TABLE IF NOT EXISTS `castas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table wineryalentejo.castas: ~5 rows (approximately)
DELETE FROM `castas`;
INSERT INTO `castas` (`id`, `descricao`) VALUES
	(1, 'Aragonês'),
	(2, 'Trincadeira'),
	(3, 'Alicante Bouschet'),
	(4, 'Syrah'),
	(5, 'Touriga Nacional');

-- Dumping structure for table wineryalentejo.estado_funcionario
DROP TABLE IF EXISTS `estado_funcionario`;
CREATE TABLE IF NOT EXISTS `estado_funcionario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descr` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table wineryalentejo.estado_funcionario: ~2 rows (approximately)
DELETE FROM `estado_funcionario`;
INSERT INTO `estado_funcionario` (`id`, `descr`) VALUES
	(1, 'Ativo'),
	(2, 'Inativo');

-- Dumping structure for table wineryalentejo.funcionarios
DROP TABLE IF EXISTS `funcionarios`;
CREATE TABLE IF NOT EXISTS `funcionarios` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table wineryalentejo.funcionarios: ~4 rows (approximately)
DELETE FROM `funcionarios`;
INSERT INTO `funcionarios` (`bi`, `nome`, `morada`, `telefone`, `email`, `salario`, `id_estado`) VALUES
	(666558, 'mnoe', 'iwef', 989898, '@email.com', 541.2356, 2),
	(333555999, 'Funcionario 1', 'Morada rua principal nº2', 963582471, 'email@emial.com', 546.23, 1),
	(555448777, 'Funcionario 2', 'Morada rua secundaria nº15', 963582458, 'emailemail@emial.com', 658.35, 1),
	(2147483647, 'mmanniiifff', 'plpdlpdlwp', 787845488, 'emai@emailc.im', 878.54, 2);

-- Dumping structure for table wineryalentejo.tipouser
DROP TABLE IF EXISTS `tipouser`;
CREATE TABLE IF NOT EXISTS `tipouser` (
  `id_user` int(11) NOT NULL,
  `descricao_user` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table wineryalentejo.tipouser: ~2 rows (approximately)
DELETE FROM `tipouser`;
INSERT INTO `tipouser` (`id_user`, `descricao_user`) VALUES
	(1, 'ADMIN'),
	(2, 'USER');

-- Dumping structure for table wineryalentejo.utilizador
DROP TABLE IF EXISTS `utilizador`;
CREATE TABLE IF NOT EXISTS `utilizador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) DEFAULT NULL,
  `pw` text DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `idtuser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_utilizador_tipouser` (`idtuser`),
  CONSTRAINT `FK_utilizador_tipouser` FOREIGN KEY (`idtuser`) REFERENCES `tipouser` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table wineryalentejo.utilizador: ~1 rows (approximately)
DELETE FROM `utilizador`;
INSERT INTO `utilizador` (`id`, `user`, `pw`, `foto`, `idtuser`) VALUES
	(1, 'admin', 'IM8Au4aEhb00RzSdKDyyEi2ogB8HVz3ejYhAWMzmZsc=', 'src/img/user/user.webp', 1);

-- Dumping structure for table wineryalentejo.vindima
DROP TABLE IF EXISTS `vindima`;
CREATE TABLE IF NOT EXISTS `vindima` (
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table wineryalentejo.vindima: ~2 rows (approximately)
DELETE FROM `vindima`;
INSERT INTO `vindima` (`id`, `id_vinha`, `id_funcionario`, `kg`, `dth`, `id_ano`) VALUES
	(14, 5, 333555999, 535, '2024-07-01 18:55:00', 1),
	(15, 6, 555448777, 371, '2024-07-13 21:55:00', 2);

-- Dumping structure for table wineryalentejo.vinha
DROP TABLE IF EXISTS `vinha`;
CREATE TABLE IF NOT EXISTS `vinha` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` text DEFAULT NULL,
  `ha` int(11) DEFAULT NULL,
  `data_plantacao` date DEFAULT NULL,
  `ano_p_colheita` int(11) DEFAULT NULL,
  `foto` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table wineryalentejo.vinha: ~3 rows (approximately)
DELETE FROM `vinha`;
INSERT INTO `vinha` (`id`, `descricao`, `ha`, `data_plantacao`, `ano_p_colheita`, `foto`) VALUES
	(5, 'Vinha Nova', 120, '2002-02-20', 2005, 'src/imagens/1dfbae115a1dddef65b0e908298a332b/_vinha20240716132950.png'),
	(6, 'Vinha Velha', 500, '2020-12-15', 2022, 'src/imagens/0c031d77a8a01c797cf5fe9196d9aab6/_vinha20240716133021.png'),
	(7, '334242', 3333, '2024-07-18', 1997, 'src/imagens/863eca41d0e11c4572b80eed567e4c69/_vinha20240716183112.png');

-- Dumping structure for table wineryalentejo.vinhas_castas
DROP TABLE IF EXISTS `vinhas_castas`;
CREATE TABLE IF NOT EXISTS `vinhas_castas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_vinha` int(11) DEFAULT NULL,
  `id_casta` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_vinha` (`id_vinha`),
  KEY `id_casta` (`id_casta`),
  CONSTRAINT `vinhas_castas_ibfk_1` FOREIGN KEY (`id_vinha`) REFERENCES `vinha` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `vinhas_castas_ibfk_2` FOREIGN KEY (`id_casta`) REFERENCES `castas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table wineryalentejo.vinhas_castas: ~5 rows (approximately)
DELETE FROM `vinhas_castas`;
INSERT INTO `vinhas_castas` (`id`, `id_vinha`, `id_casta`) VALUES
	(70, 5, 1),
	(71, 5, 2),
	(72, 5, 3),
	(75, 6, 2),
	(76, 6, 4);

-- Dumping structure for table wineryalentejo.vinhos
DROP TABLE IF EXISTS `vinhos`;
CREATE TABLE IF NOT EXISTS `vinhos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `total` int(11) DEFAULT NULL,
  `id_vindima` int(11) DEFAULT NULL,
  `nome` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_vindima` (`id_vindima`),
  CONSTRAINT `vinhos_ibfk_1` FOREIGN KEY (`id_vindima`) REFERENCES `vindima` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table wineryalentejo.vinhos: ~2 rows (approximately)
DELETE FROM `vinhos`;
INSERT INTO `vinhos` (`id`, `total`, `id_vindima`, `nome`) VALUES
	(17, 2267, 14, 'Vinha Nova 2021'),
	(18, 226, 15, 'Vinha Velha 2022');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
