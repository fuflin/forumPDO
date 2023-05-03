-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour forum
CREATE DATABASE IF NOT EXISTS `forum` /*!40100 DEFAULT CHARACTER SET latin1 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `forum`;

-- Listage de la structure de table forum. category
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `img` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum.category : ~5 rows (environ)
INSERT INTO `category` (`id_category`, `name`, `img`) VALUES
	(1, 'Airsoft', 'réplique.jpg'),
	(2, 'Milsim', 'milsim.jpg'),
	(3, 'Simulation', 'simulation.jpg'),
	(6, 'voiture', 'voiture'),
	(7, 'train', 'train'),
	(8, 'camion', 'camion');

-- Listage de la structure de table forum. post
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `text` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `datecreate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int NOT NULL,
  `topic_id` int NOT NULL,
  PRIMARY KEY (`id_post`),
  KEY `id_user` (`user_id`) USING BTREE,
  KEY `id_topic` (`topic_id`) USING BTREE,
  CONSTRAINT `FK_post_topics` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`),
  CONSTRAINT `FK_post_users` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum.post : ~4 rows (environ)
INSERT INTO `post` (`id_post`, `text`, `datecreate`, `user_id`, `topic_id`) VALUES
	(1, 'les répliques AEG sont un bon compromis en ce qui  concerne le prix et la qualité', '2023-04-25 18:43:21', 1, 1),
	(2, 'les répliques GBB sont intéressante par rapport au réalisme qu\'elles apportent', '2023-04-25 18:44:03', 2, 2),
	(3, 'Un gilet porte plaque est plus polyvalent qu\'un gilet normal ou simple', '2023-04-25 18:44:34', 2, 3),
	(4, 'Des lunettes de vision nocturne apportent un énorme avantage dans le noir ou pour les simulations de nuit ', '2023-04-25 18:45:24', 1, 4);

-- Listage de la structure de table forum. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `creationdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category_id` int NOT NULL,
  `user_id` int NOT NULL,
  `statut` int DEFAULT NULL,
  PRIMARY KEY (`id_topic`),
  KEY `id_category` (`category_id`) USING BTREE,
  KEY `id_user` (`user_id`) USING BTREE,
  CONSTRAINT `FK_topics_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`),
  CONSTRAINT `FK_topics_users` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum.topic : ~4 rows (environ)
INSERT INTO `topic` (`id_topic`, `title`, `creationdate`, `category_id`, `user_id`, `statut`) VALUES
	(1, 'AEG = Airsoft Electric Gun', '2023-04-25 18:41:05', 1, 1, NULL),
	(2, 'GBB = Gaz BlowBack', '2023-04-25 18:41:27', 1, 2, NULL),
	(3, 'Gilet Protection', '2023-04-25 18:41:50', 2, 2, NULL),
	(4, 'lunette vision nocturne', '2023-04-25 18:42:14', 3, 1, NULL);

-- Listage de la structure de table forum. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nickname` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `dateregis` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mail` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `role` json DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum.user : ~2 rows (environ)
INSERT INTO `user` (`id_user`, `nickname`, `dateregis`, `mail`, `password`, `role`) VALUES
	(1, 'Lelouch', '2023-04-25 00:00:00', 'britania@shine.fr', 'geass', '"ROLE_ADMIN"'),
	(2, 'Ains Ool Gown', '2023-04-25 00:00:00', 'Yggdrasil@tree.com', 'momonga', '"ROLE_USER"'),
	(3, 'test1', '2023-04-29 20:02:04', 'test@fzsrfee.fr', '$2y$10$HwLA7kyub6G4PwdO9MKxvOfAN6kNMStAyEU..B/yi2HX96s5Zj8RW', '"ROLE_USER"'),
	(4, 'test2', '2023-05-01 20:27:33', 'test@test.fr', '$2y$10$GpA7S8aDKN8Z48nNX.7BSetV4yPTT5v4q6g5He8V0tqI20hdtUuma', '"ROLE_USER"'),
	(5, 'test3', '2023-05-02 15:11:38', 'test3@test.com', '$2y$10$u0wOi2qIBTsT/Y6EOdKfUupoaknQuPNCS7YmZwpQsuo.noVhQuodC', '"ROLE_USER"');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
