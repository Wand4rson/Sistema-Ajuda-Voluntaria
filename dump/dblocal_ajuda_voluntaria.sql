/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.4.11-MariaDB : Database - ajuda_voluntaria
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ajuda_voluntaria` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `ajuda_voluntaria`;

/*Table structure for table `tab_lancamentos` */

DROP TABLE IF EXISTS `tab_lancamentos`;

CREATE TABLE `tab_lancamentos` (
  `user_id_precisaajuda` int(11) NOT NULL DEFAULT 0 COMMENT 'ID do usuario que precisa de Ajuda',
  `lanc_id` int(11) NOT NULL AUTO_INCREMENT,
  `lanc_descricao` mediumtext NOT NULL COMMENT 'Descreva aqui. Qual sua necessidade ? Escreva o que precisa de ajuda.',
  `lanc_prioridade` varchar(30) DEFAULT 'Baixo' COMMENT 'Baixo, Medio, Urgente',
  `lanc_status_solicitacao` int(11) NOT NULL DEFAULT 0 COMMENT '0 = Aberto, 1 = Concluido, 2 = Em Andamento, 3 = Cancelado',
  `user_id_voluntario` int(11) DEFAULT 0 COMMENT 'ID do Voluntario ou seja que se disponilizou a Ajudar',
  `ip_lancamento_voluntario` varchar(100) DEFAULT NULL COMMENT 'IP do PC voluntario que se disponibilizou a ajudar',
  `lanc_datahoravoluntarioaceitou` varchar(60) DEFAULT '' COMMENT 'Data e Hora em que Voluntario Aceitou Ajudar este chamado',
  `ip_lancamento_precisaajuda` varchar(100) DEFAULT NULL COMMENT 'IP do PC lançamento, ou seja de quem precisa de ajuda e lançou este chamado',
  `lanc_datahoralancamento` datetime DEFAULT current_timestamp() COMMENT 'data e hora do lancamento do chamado',
  `lanc_datahoraconcluido` varchar(60) DEFAULT '' COMMENT 'Data e Hora em Foi concluido o chamado, status 1 = Concluido',
  `ip_lancamento_concluido` varchar(100) DEFAULT NULL COMMENT 'IP do PC que concluiu o chamado',
  `user_id_concluido` int(11) DEFAULT 0 COMMENT 'ID do Usuario que concluiu o chamado',
  PRIMARY KEY (`user_id_precisaajuda`,`lanc_id`),
  UNIQUE KEY `lanc_id` (`lanc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tab_lancamentos` */

/*Table structure for table `tab_usuarios` */

DROP TABLE IF EXISTS `tab_usuarios`;

CREATE TABLE `tab_usuarios` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_nomecompleto` varchar(200) NOT NULL,
  `user_celular` varchar(20) NOT NULL DEFAULT '',
  `user_email` varchar(150) NOT NULL DEFAULT '',
  `user_senha` varchar(50) NOT NULL DEFAULT '',
  `user_imagemperfil` varchar(150) DEFAULT NULL,
  `user_cidade` varchar(100) NOT NULL,
  `user_estado` char(2) NOT NULL,
  `user_bairro` varchar(100) NOT NULL,
  `user_ativo` char(3) DEFAULT 'sim',
  `user_datacadastro` datetime DEFAULT current_timestamp(),
  `ip_lancamento` varchar(100) DEFAULT NULL,
  `user_cep` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tab_usuarios` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
