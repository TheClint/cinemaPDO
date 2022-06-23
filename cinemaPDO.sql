-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           5.7.33 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour cinema
CREATE DATABASE IF NOT EXISTS `cinema` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `cinema`;

-- Listage de la structure de la table cinema. acteur
CREATE TABLE IF NOT EXISTS `acteur` (
  `id_acteur` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `sexe` varchar(50) DEFAULT NULL,
  `date_de_naissance` date DEFAULT NULL,
  PRIMARY KEY (`id_acteur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema.acteur : ~18 rows (environ)
/*!40000 ALTER TABLE `acteur` DISABLE KEYS */;
INSERT INTO `acteur` (`id_acteur`, `nom`, `prenom`, `sexe`, `date_de_naissance`) VALUES
	(1, 'Eastwood', 'Clint', 'Homme ', '1930-05-31'),
	(2, 'Swank', 'Hilary', 'Femme', '1974-07-30'),
	(3, 'Freeman', 'Morgan', 'Homme', '1937-06-01'),
	(4, 'Travolta', 'John', 'Homme', '1954-02-18'),
	(5, 'Jackson', 'Samuel', 'Homme', '1948-12-21'),
	(6, 'Willis', 'Bruce', 'Homme', '1955-03-19'),
	(7, 'Thurman', 'Uma', 'Femme', '1970-04-29'),
	(8, 'Wood', 'Elijah', 'Homme', '1981-01-28'),
	(9, 'McKellen', 'Ian', 'Homme', '1939-05-25'),
	(10, 'Mortensen', 'Viggo', 'Homme', '1958-10-20'),
	(11, 'Streep', 'Meryl', 'Femme', '1949-06-22'),
	(12, 'Slezak', 'Victor', 'Homme', '1957-07-30'),
	(13, 'Murray', 'Bill', 'Homme', '1950-09-21'),
	(14, 'Johansson', 'Scarlett', 'Femme', '1984-11-22'),
	(15, 'Ribisi', 'Giovanni', 'Homme', '1974-12-14'),
	(16, 'Liu', 'Lucy', 'Femme', '1968-12-02'),
	(17, 'Fox', 'Vivica', 'Femme', '1964-07-30'),
	(18, 'aaa', 'aaa', 'Homme', '2022-06-01');
/*!40000 ALTER TABLE `acteur` ENABLE KEYS */;

-- Listage de la structure de la table cinema. categorie
CREATE TABLE IF NOT EXISTS `categorie` (
  `id_categorie` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table cinema.categorie : ~0 rows (environ)
/*!40000 ALTER TABLE `categorie` DISABLE KEYS */;
/*!40000 ALTER TABLE `categorie` ENABLE KEYS */;

-- Listage de la structure de la table cinema. film
CREATE TABLE IF NOT EXISTS `film` (
  `id_film` int(11) NOT NULL,
  `titre` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `annee_de_sortie` date DEFAULT NULL,
  `duree` int(11) DEFAULT NULL,
  `synopsis` text CHARACTER SET utf8 COLLATE utf8_bin,
  `note` decimal(5,1) DEFAULT NULL,
  `affiche` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT 'non disponible',
  `id_realisateur` int(11) NOT NULL,
  PRIMARY KEY (`id_film`),
  KEY `id_realisateur` (`id_realisateur`),
  CONSTRAINT `film_ibfk_1` FOREIGN KEY (`id_realisateur`) REFERENCES `realisateur` (`id_realisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema.film : ~7 rows (environ)
/*!40000 ALTER TABLE `film` DISABLE KEYS */;
INSERT INTO `film` (`id_film`, `titre`, `annee_de_sortie`, `duree`, `synopsis`, `note`, `affiche`, `id_realisateur`) VALUES
	(1, 'Sur la route de Madison', '1995-01-01', 135, 'Michael Johnson et sa soeur Caroline reviennent dans la ferme de leur enfance régler la succession de leur mÃ¨re, Francesca. Ils vont dÃ©couvrir tout un pan de la vie de leur mère ignoré de tous, sa brève, intense et inoubliable liaison avec un photographe de passage', 4.0, 'sur-la-route-de-madison.jpg', 1),
	(2, 'Pulp fiction', '1994-01-01', 154, 'L\'odyssée sanglante et burlesque de petits malfrats dans la jungle de Hollywood à  travers trois histoires qui s\'entremèlent. Dans un restaurant, un couple de jeunes braqueurs, Pumpkin et Yolanda, discutent des risques que comporte leur activité. Deux truands, Jules Winnfield et son ami Vincent Vega, qui revient d\'Amsterdam, ont pour mission de récupérer une mallette au contenu mystérieux et de la rapporter à  Marsellus Wallace.', 5.0, 'pulp-fiction.jpg', 2),
	(3, 'Lost in Translation', '2003-01-01', 101, 'Bob Harris est un acteur américain dont la carrière semble s\'essouffler. Il part à  Tokyo tourner un spot publicitaire, non seulement pour gagner de l\'argent mais également pour s\'éloigner de sa femme. Sur place, il a bien du mal à  s\'accoutumer à la ville et passe la majorité de son temps dans son hôtel de luxe. Là-bas, il y rencontrera Charlotte, une jeune Américaine tout juste diplômée qui est venue accompagner son mari photographe, John.', 4.0, 'film-lost-translation.jpg', 3),
	(4, 'Les deux tours', '2002-01-01', 179, 'Après la mort de Boromir et la disparition de Gandalf, la Communauté s\'est scindée en trois. Perdus dans les collines d\'`Emyn Muil\', Frodon et Sam découvrent qu\'ils sont suivis par Gollum, une créature versatile corrompue par l\'anneau magique. Gollum promet de conduire les `Hobbits\' jusqu\'à la `Porte Noire\' du `Mordor\'. A travers la `Terre du Milieu\', Aragorn, Legolas et Gimli font route vers le `Rohan\', le royaume assiégé de Theoden.', 5.0, 'les-deux-tours.jpg', 4),
	(5, 'Kill Bill', '2003-01-01', 111, 'Au cours d\'une cérémonie de mariage en plein désert, un commando fait irruption dans la chapelle et tire sur les convives. Laissée pour morte, la mariée enceinte retrouve ses esprits après un coma de quatre ans. Celle qui a auparavant exercé les fonctions de tueuse à gages au sein du Détachement international des Vipères assassines n\'a alors plus qu\'une seule idée en tête: venger la mort de ses proches en éliminant tous les membres de cette organisation criminelle.', 5.0, 'kill-bill.jpg', 2),
	(6, 'Million Dollar Baby', '2004-01-01', 132, 'Rejeté depuis longtemps par sa fille, l\'entraîneur Frankie Dunn s\'est replié sur lui-mème et vit dans un désert affectif. Le jour où Maggie Fitzgerald, 31 ans, pousse la porte de son gymnase à  la recherche d\'un `coach\', elle n\'amène pas seulement avec elle sa jeunesse et sa force, mais aussi une histoire jalonnée d\'épreuves et une exigence, vitale et urgente : monter sur le `ring\', entraînée par Frankie, et enfin concrétiser le rève d\'une vie.', 3.0, 'milion-dollar-baby.jpg', 1),
	(7, 'Le Pont de la rivi&egrave;re Kwa&iuml;', '1957-01-01', 161, '1943. Un r&eacute;giment britannique est emprisonn&eacute; dans un camp japonais, dirig&eacute; par le colonel Saito. Devant le refus du colonel anglais Nicholson de forcer ses hommes &agrave; construire un pont, Saito lui fait endurer les pires s&eacute;vices mais n&#039;obtient aucun r&eacute;sultat. Nicholson finit par prendre la t&ecirc;te des op&eacute;rations mais les Am&eacute;ricains d&eacute;barquent...', 4.1, '', 1);
/*!40000 ALTER TABLE `film` ENABLE KEYS */;

-- Listage de la structure de la table cinema. genre
CREATE TABLE IF NOT EXISTS `genre` (
  `id_genre` int(11) NOT NULL,
  `libelle` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_genre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema.genre : ~5 rows (environ)
/*!40000 ALTER TABLE `genre` DISABLE KEYS */;
INSERT INTO `genre` (`id_genre`, `libelle`) VALUES
	(1, 'Romantique'),
	(2, 'Drame'),
	(3, 'Mafia'),
	(4, 'Action'),
	(5, 'Fantaisy');
/*!40000 ALTER TABLE `genre` ENABLE KEYS */;

-- Listage de la structure de la table cinema. genrer
CREATE TABLE IF NOT EXISTS `genrer` (
  `id_film` int(11) NOT NULL,
  `id_genre` int(11) NOT NULL,
  PRIMARY KEY (`id_film`,`id_genre`),
  KEY `id_genre` (`id_genre`),
  CONSTRAINT `genrer_ibfk_1` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`),
  CONSTRAINT `genrer_ibfk_2` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id_genre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema.genrer : ~7 rows (environ)
/*!40000 ALTER TABLE `genrer` DISABLE KEYS */;
INSERT INTO `genrer` (`id_film`, `id_genre`) VALUES
	(1, 1),
	(3, 2),
	(6, 2),
	(2, 3),
	(5, 3),
	(5, 4),
	(4, 5);
/*!40000 ALTER TABLE `genrer` ENABLE KEYS */;

-- Listage de la structure de la table cinema. jouer
CREATE TABLE IF NOT EXISTS `jouer` (
  `id_film` int(11) NOT NULL,
  `id_acteur` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  PRIMARY KEY (`id_film`,`id_acteur`,`id_role`),
  KEY `id_acteur` (`id_acteur`),
  KEY `id_role` (`id_role`),
  CONSTRAINT `jouer_ibfk_1` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`),
  CONSTRAINT `jouer_ibfk_2` FOREIGN KEY (`id_acteur`) REFERENCES `acteur` (`id_acteur`),
  CONSTRAINT `jouer_ibfk_3` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema.jouer : ~19 rows (environ)
/*!40000 ALTER TABLE `jouer` DISABLE KEYS */;
INSERT INTO `jouer` (`id_film`, `id_acteur`, `id_role`) VALUES
	(1, 1, 11),
	(6, 1, 1),
	(6, 2, 2),
	(6, 3, 3),
	(2, 4, 4),
	(2, 5, 5),
	(2, 6, 6),
	(2, 7, 7),
	(5, 7, 17),
	(4, 8, 8),
	(4, 9, 9),
	(4, 10, 10),
	(1, 11, 12),
	(1, 12, 13),
	(3, 13, 14),
	(3, 14, 15),
	(3, 15, 16),
	(5, 16, 18),
	(5, 17, 19);
/*!40000 ALTER TABLE `jouer` ENABLE KEYS */;

-- Listage de la structure de la table cinema. realisateur
CREATE TABLE IF NOT EXISTS `realisateur` (
  `id_realisateur` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `sexe` varchar(50) DEFAULT NULL,
  `date_de_naissance` date DEFAULT NULL,
  PRIMARY KEY (`id_realisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema.realisateur : ~5 rows (environ)
/*!40000 ALTER TABLE `realisateur` DISABLE KEYS */;
INSERT INTO `realisateur` (`id_realisateur`, `nom`, `prenom`, `sexe`, `date_de_naissance`) VALUES
	(1, 'Eastwood', 'Clint', 'Homme', '1930-05-31'),
	(2, 'Tarantino', 'Quentin', 'Homme', '1963-03-27'),
	(3, 'Coppola', 'Sofia', 'Femme', '1971-05-14'),
	(4, 'Jackson', 'Peter', 'Homme', '1961-10-31'),
	(5, 'jhgf', 'jhgf', 'jh', NULL);
/*!40000 ALTER TABLE `realisateur` ENABLE KEYS */;

-- Listage de la structure de la table cinema. role
CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int(11) NOT NULL,
  `nom_personnage` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema.role : ~19 rows (environ)
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` (`id_role`, `nom_personnage`, `type`) VALUES
	(1, 'Frankie Dunn', 'Principal'),
	(2, 'Margaret Fitzgerald', 'Principal'),
	(3, 'Eddie Dupris', 'Secondaire'),
	(4, 'Vincent Vega', 'Principal'),
	(5, 'Jules Winnfield', 'Principal'),
	(6, 'Butch Coolidge', 'Principal'),
	(7, 'Mia Wallace', 'Principal'),
	(8, 'Frodon Sacquet', 'Principal'),
	(9, 'Gandalf', 'Principal'),
	(10, 'Aragorn', 'Pincipal'),
	(11, 'Robert Kincaid', 'Principal'),
	(12, 'Francesca Johnson', 'Principal'),
	(13, 'Michael Johnson', 'Secondaire'),
	(14, 'Bob Harris', 'Principal'),
	(15, 'Charlotte', 'Principal'),
	(16, 'John', 'Secondaire'),
	(17, 'La MariÃ©e', 'Principale'),
	(18, 'Cottonmouth', 'Secondaire'),
	(19, 'Copperhead', 'Secondaire');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;

-- Listage de la structure de la table cinema. user_
CREATE TABLE IF NOT EXISTS `user_` (
  `id_user` int(11) NOT NULL,
  `pseudonyme` varchar(20) DEFAULT NULL,
  `register_date` datetime DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `pseudonyme` (`pseudonyme`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table cinema.user_ : ~0 rows (environ)
/*!40000 ALTER TABLE `user_` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
