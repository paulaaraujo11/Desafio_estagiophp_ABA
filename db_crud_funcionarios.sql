/*
SQLyog Ultimate
MySQL - 10.4.6-MariaDB : Database - db_crud_funcionarios
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `departamento` */

CREATE TABLE `departamento` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome_departamento` varchar(7) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `departamento` */

insert  into `departamento`(`id`,`nome_departamento`) values (1,'TI');
insert  into `departamento`(`id`,`nome_departamento`) values (2,'SUPORTE');
insert  into `departamento`(`id`,`nome_departamento`) values (3,'DESIGN');

/*Table structure for table `funcionario` */

CREATE TABLE `funcionario` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome_funcionario` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `funcao_funcionario` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `idade_funcionario` int(3) NOT NULL,
  `id_departamento` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `funcionario` */

insert  into `funcionario`(`id`,`nome_funcionario`,`funcao_funcionario`,`idade_funcionario`,`id_departamento`) values (1,'Rasmus Lerdorf','Programador PHP',52,1);
insert  into `funcionario`(`id`,`nome_funcionario`,`funcao_funcionario`,`idade_funcionario`,`id_departamento`) values (2,'James Gosling','Programador Java',65,1);
insert  into `funcionario`(`id`,`nome_funcionario`,`funcao_funcionario`,`idade_funcionario`,`id_departamento`) values (3,'Gustavo Guanabara','Web Design',43,3);
insert  into `funcionario`(`id`,`nome_funcionario`,`funcao_funcionario`,`idade_funcionario`,`id_departamento`) values (4,'JoÃ£o da Silva','Suporte TÃ©cnico',25,2);
insert  into `funcionario`(`id`,`nome_funcionario`,`funcao_funcionario`,`idade_funcionario`,`id_departamento`) values (5,'Ada Lovelace','Programadora e MatemÃ¡tica',36,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
