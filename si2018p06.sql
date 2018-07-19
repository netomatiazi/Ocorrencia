/*
SQLyog Enterprise - MySQL GUI v8.12 
MySQL - 5.5.5-10.1.13-MariaDB : Database - si2018p06
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`si2018p06` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `si2018p06`;

/*Table structure for table `bairro` */

DROP TABLE IF EXISTS `bairro`;

CREATE TABLE `bairro` (
  `idbairro` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idbairro`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `bairro` */

insert  into `bairro`(`idbairro`,`descricao`) values (1,'Adornos'),(2,'Barra Funda'),(3,'Campos Elísios'),(4,'Cecap'),(5,'Centro'),(6,'Chácara Bosque do Sol'),(7,'Cidade Amizade'),(8,'Cond. Mirante dos Rios'),(9,'Conj. Eugênio Franciscone');

/*Table structure for table `categoria` */

DROP TABLE IF EXISTS `categoria`;

CREATE TABLE `categoria` (
  `idcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `descritivo` enum('Patrimônio Público','Vegetação','Energia Elétrica','Água e Esgoto','Trânsito','Entulho') DEFAULT NULL,
  `icone` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `categoria` */

insert  into `categoria`(`idcategoria`,`descritivo`,`icone`) values (1,'Água e Esgoto','figuras/icon_aguaP.png'),(2,'Energia Elétrica','figuras/icon_luzP.png'),(3,'Entulho','figuras/icon_lixoP.png'),(4,'Patrimônio Público',NULL),(5,'Trânsito','figuras/icon_asfaltoP.png'),(6,'Vegetação','figuras/icon_arvoreP.png');

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `idmenu` int(11) NOT NULL AUTO_INCREMENT,
  `descritivo` varchar(20) NOT NULL,
  `link` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idmenu`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `menu` */

insert  into `menu`(`idmenu`,`descritivo`,`link`) values (1,'Menu Administrador','#');

/*Table structure for table `ocorrencias` */

DROP TABLE IF EXISTS `ocorrencias`;

CREATE TABLE `ocorrencias` (
  `idocorrencias` int(11) NOT NULL AUTO_INCREMENT,
  `idsubcategoria` int(11) NOT NULL,
  `idbairro` int(11) NOT NULL,
  `datao` date DEFAULT NULL,
  `logradouro` varchar(100) DEFAULT NULL,
  `numero` varchar(9) DEFAULT NULL,
  `latitude` varchar(20) DEFAULT NULL,
  `longitude` varchar(20) DEFAULT NULL,
  `anexo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idocorrencias`),
  KEY `idsubcategoria` (`idsubcategoria`),
  KEY `idbairro` (`idbairro`),
  CONSTRAINT `ocorrencias_ibfk_1` FOREIGN KEY (`idsubcategoria`) REFERENCES `subcategoria` (`idsubcategoria`),
  CONSTRAINT `ocorrencias_ibfk_2` FOREIGN KEY (`idbairro`) REFERENCES `bairro` (`idbairro`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `ocorrencias` */

insert  into `ocorrencias`(`idocorrencias`,`idsubcategoria`,`idbairro`,`datao`,`logradouro`,`numero`,`latitude`,`longitude`,`anexo`) values (1,3,4,'2018-03-21','Av. Godofredo Schilini','950','-22.380601636605913','-48.395696296264646','anexo/71999354abfe6e850ad0486e7197d18e.jpg'),(2,8,4,'2018-03-23','Av. Godofredo Schilini','69','-22.374048537086185','-48.3913833041687','anexo/915fe7478647b6ad2149d63b3b0325c2.jpg'),(3,15,4,'2018-03-26','Av. Godofredo Schilini','245 - 0','-22.376032753666404','-48.392220153381345','anexo/0d23bef2eca2c244e3205429c2faf9fb.jpg'),(4,12,9,'2018-04-12','Av. Godofredo Schilini','112','-22.374842227112755','-48.39226306872558','anexo/0f4b6d1540a207b68f5dfa6bca49f2cf.jpg'),(5,12,7,'2018-04-23','Av. José Antônio da Cruz','89-181','-22.381985233668082','-48.38434518771362','anexo/2cb53d1f31b8d7dc52c0e80bb152fc01.jpg');

/*Table structure for table `perfil` */

DROP TABLE IF EXISTS `perfil`;

CREATE TABLE `perfil` (
  `idperfil` int(11) NOT NULL AUTO_INCREMENT,
  `descritivo` varchar(20) NOT NULL,
  PRIMARY KEY (`idperfil`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `perfil` */

insert  into `perfil`(`idperfil`,`descritivo`) values (1,'Administrador');

/*Table structure for table `perfilmenu` */

DROP TABLE IF EXISTS `perfilmenu`;

CREATE TABLE `perfilmenu` (
  `idperfilmenu` int(11) NOT NULL AUTO_INCREMENT,
  `idperfil` int(11) DEFAULT NULL,
  `idmenu` int(11) DEFAULT NULL,
  PRIMARY KEY (`idperfilmenu`),
  KEY `idperfil` (`idperfil`),
  KEY `idmenu` (`idmenu`),
  CONSTRAINT `perfilmenu_ibfk_1` FOREIGN KEY (`idperfil`) REFERENCES `perfil` (`idperfil`),
  CONSTRAINT `perfilmenu_ibfk_2` FOREIGN KEY (`idmenu`) REFERENCES `menu` (`idmenu`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `perfilmenu` */

insert  into `perfilmenu`(`idperfilmenu`,`idperfil`,`idmenu`) values (2,1,1);

/*Table structure for table `subcategoria` */

DROP TABLE IF EXISTS `subcategoria`;

CREATE TABLE `subcategoria` (
  `idsubcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `idcategoria` int(11) DEFAULT NULL,
  `tipo` enum('Propriedade danificada','Vandalismo','Poda de árvore','Poda de grama','Terreno baldio','Falta de energia','Lampada queimada','Falta de iluminação','Boeiro entupido','Vazamento de água','Falta de água','Pavimento danificado','Falta de sinalização','Entulho de construção','Descarte de móveis') DEFAULT NULL,
  PRIMARY KEY (`idsubcategoria`),
  KEY `idcategoria` (`idcategoria`),
  CONSTRAINT `subcategoria_ibfk_1` FOREIGN KEY (`idcategoria`) REFERENCES `categoria` (`idcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `subcategoria` */

insert  into `subcategoria`(`idsubcategoria`,`idcategoria`,`tipo`) values (1,1,'Boeiro entupido'),(2,1,'Falta de água'),(3,1,'Vazamento de água'),(4,2,'Falta de energia'),(5,2,'Falta de iluminação'),(6,2,'Lampada queimada'),(7,3,'Descarte de móveis'),(8,3,'Entulho de construção'),(9,4,'Propriedade danificada'),(10,4,'Vandalismo'),(11,5,'Falta de sinalização'),(12,5,'Pavimento danificado'),(13,6,'Poda de árvore'),(14,6,'Poda de grama'),(15,6,'Terreno baldio');

/*Table structure for table `usuario` */

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `idperfil` int(11) DEFAULT NULL,
  `statusu` tinyint(1) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `email` varchar(40) NOT NULL,
  `senha` char(16) NOT NULL,
  PRIMARY KEY (`idusuario`),
  KEY `idperfil` (`idperfil`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idperfil`) REFERENCES `perfil` (`idperfil`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `usuario` */

insert  into `usuario`(`idusuario`,`idperfil`,`statusu`,`nome`,`email`,`senha`) values (1,1,1,'Ovidio','ovidio@teste.com','123'),(2,1,1,'Administrador','fatecjahu','fatecjahu');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
