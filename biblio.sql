-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           5.7.19 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             11.1.0.6116
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour bibliomvc
CREATE DATABASE IF NOT EXISTS `bibliomvc` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `bibliomvc`;

-- Listage de la structure de la table bibliomvc. auteur
CREATE TABLE IF NOT EXISTS `auteur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Listage des données de la table bibliomvc.auteur : ~1 rows (environ)
/*!40000 ALTER TABLE `auteur` DISABLE KEYS */;
INSERT INTO `auteur` (`id`, `nom`, `prenom`, `photo`) VALUES
	(1, 'KING', 'Stephen', NULL),
	(2, 'HERBERT', 'Frank', NULL),
	(3, 'ORWELL', 'George', NULL);
/*!40000 ALTER TABLE `auteur` ENABLE KEYS */;

-- Listage de la structure de la table bibliomvc. emprunt
CREATE TABLE IF NOT EXISTS `emprunt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `exemplaire_id` int(11) NOT NULL,
  `dateEmprunt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `delai` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `exemplaire_id` (`exemplaire_id`),
  CONSTRAINT `FK_emprunt_exemplaire` FOREIGN KEY (`exemplaire_id`) REFERENCES `exemplaire` (`id`),
  CONSTRAINT `FK_emprunt_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Listage des données de la table bibliomvc.emprunt : ~3 rows (environ)
/*!40000 ALTER TABLE `emprunt` DISABLE KEYS */;
INSERT INTO `emprunt` (`id`, `user_id`, `exemplaire_id`, `dateEmprunt`, `delai`) VALUES
	(1, 1, 1, '2021-08-16 10:15:03', 10),
	(2, 1, 2, '2021-09-16 10:54:46', 5),
	(3, 1, 3, '2021-09-16 11:04:45', 5),
	(4, 2, 7, '2021-08-31 13:06:19', 15);
/*!40000 ALTER TABLE `emprunt` ENABLE KEYS */;

-- Listage de la structure de la table bibliomvc. exemplaire
CREATE TABLE IF NOT EXISTS `exemplaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `livre_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `livre_id` (`livre_id`),
  CONSTRAINT `FK_exemplaire_livre` FOREIGN KEY (`livre_id`) REFERENCES `livre` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Listage des données de la table bibliomvc.exemplaire : ~6 rows (environ)
/*!40000 ALTER TABLE `exemplaire` DISABLE KEYS */;
INSERT INTO `exemplaire` (`id`, `livre_id`) VALUES
	(1, 3),
	(2, 3),
	(3, 3),
	(4, 4),
	(5, 4),
	(6, 5),
	(7, 7),
	(8, 7),
	(9, 8),
	(10, 8),
	(11, 8);
/*!40000 ALTER TABLE `exemplaire` ENABLE KEYS */;

-- Listage de la structure de la table bibliomvc. livre
CREATE TABLE IF NOT EXISTS `livre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(200) NOT NULL,
  `annee` int(11) NOT NULL DEFAULT '0',
  `nbPages` int(11) NOT NULL DEFAULT '0',
  `resume` text NOT NULL,
  `auteur_id` int(11) NOT NULL DEFAULT '0',
  `image` varchar(255) NOT NULL DEFAULT '0',
  `addedAt` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `auteur_id` (`auteur_id`),
  CONSTRAINT `FK_livre_auteur` FOREIGN KEY (`auteur_id`) REFERENCES `auteur` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Listage des données de la table bibliomvc.livre : ~4 rows (environ)
/*!40000 ALTER TABLE `livre` DISABLE KEYS */;
INSERT INTO `livre` (`id`, `titre`, `annee`, `nbPages`, `resume`, `auteur_id`, `image`, `addedAt`) VALUES
	(3, 'Ca : il est revenu', 1986, 627, 'out avait commencé juste avant les vacances d\'été quand le petit Browers avait gravé ses initiales au couteau sur le ventre de son copain Ben Hascom. Tout s\'était terminé deux mois plus tard dans les égouts par la poursuite infernale d\'une créature étrange, incarnation même du mal. Mais aujourd\'hui tout recommence. Les enfants terrorisés sont devenus des adultes. Le présent retrouve le passé, le destin reprend ses droits, l\'horreur ressurgit. Chacun retrouvera dans ce roman à la construction saisissante ses propres souvenirs, ses angoisses et ses terreurs d\'enfant, la peur de grandir dans un monde de violence.', 1, 'https://images-na.ssl-images-amazon.com/images/I/51HFC04N8SL._SX300_BO1,204,203,200_.jpg', '2021-09-16 11:26:12'),
	(4, 'Salem', 1975, 850, 'Peu après l\'enterrement de Danny, Matt Burke recueille Mike Ryerson, un ancien élève qui travaillait comme fossoyeur lors de la cérémonie. Très mal en point, Mike semble également gravement choqué, si bien que Matt lui propose de dormir chez lui. Pendant la nuit, il entend pourtant Mike inviter une personne à entrer, et au matin, le retrouve mort à son tour. La nuit suivante, Matt est attaqué par Ryerson et, bien qu\'arrivant à le repousser, fait une attaque cardiaque. Il est emmené à l\'hôpital, tandis que Ben est agressé par l\'ancien ami de Susan, Floyd Tibbits, dissimulé sous de lourds vêtements d\'hiver en dépit de la chaleur. Les deux amis se persuadent alors que des vampires sont la cause des morts étranges qui frappent la ville, et que Straker et Barlow pourraient en être l\'origine. Mark Petrie, un jeune garçon de 12 ans, a, de son côté, l\'horrible surprise de voir Danny Glick frapper une nuit à sa fenêtre et lui demander de le faire entrer. Saisissant une petite croix, il trouve le courage de l\'appliquer sur la joue du vampire ce qui fait reculer celui-ci, et sauve Mark du même coup.', 1, 'https://images-eu.ssl-images-amazon.com/images/I/51SGgDyK-CL._SY291_BO1,204,203,200_QL40_ML2_.jpg', '2021-09-16 11:26:12'),
	(5, '22-11-63', 2011, 934, 'Muni de la fausse identité de George Amberson, Jake fait alors un voyage-test dans lequel son but est de sauver la famille de Harry Dunning, le concierge du lycée, dont les membres ont tous été tués par Frank Dunning, le père de Harry, le soir de Halloween 1958. Jake s\'installe à Derry, où le drame a eu lieu, et surveille Frank Dunning. Le jour d\'Halloween, Jake est victime de divers accidents qui le retardent mais parvient à empêcher Dunning d\'assassiner toute sa famille sauf le fils aîné. Jake réintègre le présent de 2011 mais apprend que Harry a été ultérieurement tué lors de la guerre du Viêt Nam, conséquence inattendue de son intervention. Hésitant sur la conduite à tenir, il découvre que Templeton s\'est suicidé en absorbant une dose massive d\'antalgiques et lui a laissé une lettre le suppliant d\'accéder à sa requête, ainsi que ses notes sur Lee Harvey Oswald et une fiche de résultats sportifs de l\'époque permettant de faire des paris sportifs et de gagner de l\'argent.', 1, 'https://images-na.ssl-images-amazon.com/images/I/51l7s82DUvL._SX307_BO1,204,203,200_.jpg', '2021-09-15 11:26:12'),
	(6, 'Mr Mercedes', 2015, 550, 'Brady Hartsfield, jeune homme travaillant dans un magasin d\'électronique et d\'informatique tout en étant vendeur ambulant de glace et de confiserie, a vécu une enfance difficile avec une mère dérangée psychologiquement. Il n\'en est pas ressorti indemne et voue au monde une haine féroce, voulant prendre sa vengeance à travers le meurtre de masse. En avril 2009, après avoir dérobé une Mercedes grâce à un appareil électronique de sa construction, il se rend à une foire à l\'emploi et fonce dans la foule, tuant huit personnes, puis s\'échappe sans encombre. L\'enquête policière qui s\'ensuit fait naître un sentiment de culpabilité chez Olivia Trelawney, la propriétaire de la voiture. Brady Hartsfield parvient à la contacter par l\'intermédiaire d\'un réseau social sur Internet. Prenant un ascendant psychologique sur elle, il accentue cette culpabilité et l\'amène à se suicider.', 1, 'https://m.media-amazon.com/images/I/51WjFX52+-L.jpg', '2021-09-13 11:31:25'),
	(7, 'Dune', 1970, 592, 'Le duc Leto Atréides, chef de la Maison Atréides, règne sur son fief planétaire de Caladan, une planète constituée de jungles et de vastes océans dont il tire sa puissance. Sa concubine officielle, dame Jessica, est une adepte du Bene Gesserit, une école exclusivement féminine qui poursuit de mystérieuses visées politiques et qui enseigne des capacités non moins étranges.', 2, 'https://images-na.ssl-images-amazon.com/images/I/416AS5j7UFL._SX324_BO1,204,203,200_.jpg', '2021-09-16 12:48:14'),
	(8, '1984', 1950, 376, 'L’histoire se passe à Londres en 1984, comme l\'indique le titre du roman. Le monde, depuis les grandes guerres nucléaires des années 1950, est divisé en trois grands « blocs » : l’Océania (Amériques, îles de l\'Atlantique, comprenant notamment les îles Anglo-Celtes, Océanie et Afrique australe), l’Eurasia (reste de l\'Europe et URSS) et l’Estasia (Chine et ses contrées méridionales, îles du Japon, et une portion importante mais variable de la Mongolie, de la Mandchourie, de l\'Inde et du Tibet6) qui sont en guerre perpétuelle les uns contre les autres. Ces trois grandes puissances sont dirigées par différents régimes totalitaires revendiqués comme tels, et s\'appuyant sur des idéologies nommées différemment mais fondamentalement similaires : l’Angsoc (ou « socialisme anglais ») pour l\'Océania, le « néo-bolchévisme » pour l\'Eurasia et le « culte de la mort » (ou « oblitération du moi ») pour l\'Estasia. Tous ces partis sont présentés comme communistes avant leur montée au pouvoir, jusqu\'à ce qu\'ils deviennent des régimes totalitaires et relèguent les prolétaires qu\'ils prétendaient défendre au bas de la pyramide sociale. Les trois régimes sont présentés comme étant socialement, économiquement et idéologiquement sensiblement les mêmes.', 3, 'https://images-eu.ssl-images-amazon.com/images/I/515yoXDW6aL._SY291_BO1,204,203,200_QL40_ML2_.jpg', '2021-09-16 13:42:32');
/*!40000 ALTER TABLE `livre` ENABLE KEYS */;

-- Listage de la structure de la table bibliomvc. user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'ROLE_USER',
  `password` varchar(255) NOT NULL,
  `dateNaissance` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `adresse` varchar(200) NOT NULL,
  `cp` varchar(10) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `registerDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Listage des données de la table bibliomvc.user : ~1 rows (environ)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `nom`, `prenom`, `role`, `password`, `dateNaissance`, `adresse`, `cp`, `ville`, `email`, `registerDate`) VALUES
	(1, 'MURMANN', 'Micka', 'ROLE_USER', 'plusTard', '1985-01-17 10:13:52', '3 rue de la Gare', '67000', 'STRASBOURG', 'mickael@exemple.com', '2021-09-16 10:14:25'),
	(2, 'GIBELLO', 'Virgile', 'ROLE_USER', 'plusTard', '2021-09-16 13:05:30', '1 rue des Champs', '67000', 'STRASBOURG', 'virgile@exemple.com', '2021-09-16 13:05:45');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
