-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `chemin`;
CREATE TABLE `chemin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_dest_finale` int(11) NOT NULL,
  `id_lieu1` int(11) NOT NULL,
  `id_lieu2` int(11) NOT NULL,
  `id_lieu3` int(11) NOT NULL,
  `id_lieu4` int(11) NOT NULL,
  `id_lieu5` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_dest_finale` (`id_dest_finale`),
  KEY `id_lieu1` (`id_lieu1`),
  KEY `id_lieu2` (`id_lieu2`),
  KEY `id_lieu3` (`id_lieu3`),
  KEY `id_lieu4` (`id_lieu4`),
  KEY `id_lieu5` (`id_lieu5`),
  CONSTRAINT `chemin_ibfk_1` FOREIGN KEY (`id_dest_finale`) REFERENCES `lieu` (`id`),
  CONSTRAINT `chemin_ibfk_2` FOREIGN KEY (`id_lieu1`) REFERENCES `lieu` (`id`),
  CONSTRAINT `chemin_ibfk_3` FOREIGN KEY (`id_lieu2`) REFERENCES `lieu` (`id`),
  CONSTRAINT `chemin_ibfk_4` FOREIGN KEY (`id_lieu3`) REFERENCES `lieu` (`id`),
  CONSTRAINT `chemin_ibfk_5` FOREIGN KEY (`id_lieu4`) REFERENCES `lieu` (`id`),
  CONSTRAINT `chemin_ibfk_6` FOREIGN KEY (`id_lieu5`) REFERENCES `lieu` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `chemin` (`id`, `id_dest_finale`, `id_lieu1`, `id_lieu2`, `id_lieu3`, `id_lieu4`, `id_lieu5`) VALUES
(87,	1,	2,	6,	5,	4,	3),
(88,	1,	6,	4,	2,	5,	3),
(89,	1,	1,	4,	6,	5,	2);

DROP TABLE IF EXISTS `lieu`;
CREATE TABLE `lieu` (
  `nom_lieu` varchar(150) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `coord_x` float NOT NULL,
  `coord_y` float NOT NULL,
  `indication` varchar(150) NOT NULL,
  `description` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `indice1` varchar(150) NOT NULL,
  `indice2` varchar(150) NOT NULL,
  `indice3` varchar(150) NOT NULL,
  `indice4` varchar(150) NOT NULL,
  `indice5` varchar(150) NOT NULL,
  `dest_finale` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `lieu` (`nom_lieu`, `id`, `coord_x`, `coord_y`, `indication`, `description`, `image`, `indice1`, `indice2`, `indice3`, `indice4`, `indice5`, `dest_finale`) VALUES
('Paris',	1,	47.245,	2.654,	'test_indication',	'test_descr',	'',	'test indice1',	'test indice 2',	'test indice 3',	'test indice 4',	'test indice 5',	1),
('Colmar',	2,	87,	122,	'azaz',	'lkn',	'',	'lkn',	'nki',	'tdc',	'fty',	'rtcfg',	1),
('Strasbourg',	3,	87,	45,	'qsd',	'zer',	'',	'zeg',	'ytj',	'ar',	'azr',	'tra',	1),
('Nancy',	4,	875,	561,	'kjb',	'kln',	'mlkn',	'igu',	'khjb',	'iug',	'rc',	'iuy',	0),
('Lyon',	5,	32,	97,	'dfvb',	'tghj',	'vbn',	'vbn',	'fgh',	'tyu',	'aze',	'xcv',	0),
('Marseille',	6,	875,	654,	'fgh',	'rty',	'dcvb',	'zert',	'efgh',	'xcvb',	'sdfg',	'rtgyh',	0);

DROP TABLE IF EXISTS `partie`;
CREATE TABLE `partie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `distanceDF` float NOT NULL,
  `score` int(11) NOT NULL,
  `id_chemin` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_chemin` (`id_chemin`),
  CONSTRAINT `partie_ibfk_1` FOREIGN KEY (`id_chemin`) REFERENCES `chemin` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `partie` (`id`, `token`, `distanceDF`, `score`, `id_chemin`) VALUES
(64,	'6ogdeqt586mxjw8lg9rh9hcdjacfz6zw',	100,	0,	87),
(65,	'9vmnid8swmksczjjbfb5b4o1dtsc9s9a',	100,	0,	88),
(66,	'ytu8ml2dgdu4qfqk3tr6jpqbp52mx9kv',	100,	0,	89);

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE `utilisateur` (
  `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nv_droit` int(11) NOT NULL,
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2017-02-08 10:20:31
