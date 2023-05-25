-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 25 mai 2023 à 09:49
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `messagerie`
--

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `msg_id` int NOT NULL AUTO_INCREMENT,
  `msg_text` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `msg_user_id` int NOT NULL,
  `msg_date` datetime DEFAULT NULL,
  `msg_room_id` int NOT NULL,
  `msg_color` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`msg_id`,`msg_user_id`,`msg_room_id`),
  KEY `fk_messages_users_idx` (`msg_user_id`),
  KEY `fk_messages_rooms1_idx` (`msg_room_id`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`msg_id`, `msg_text`, `msg_user_id`, `msg_date`, `msg_room_id`, `msg_color`) VALUES
(63, 'Coucou ! Pain au chocolat ou chocolatine ?', 1, '2023-05-25 07:53:01', 3, '#F00'),
(64, 'Chocolatine, c\'est évident !', 2, '2023-05-25 07:57:15', 3, '#CF00BE'),
(65, 'Faux, c\'est pain au chocolat !', 1, '2023-05-25 07:58:23', 3, '#F00'),
(66, 'Non, la chocolatine, c\'est dans le Sud !', 2, '2023-05-25 07:59:19', 3, '#CF00BE'),
(67, 'Pain au chocolat est plus répandu !', 1, '2023-05-25 07:59:52', 3, '#F00'),
(68, 'Tradition et saveur, c\'est chocolatine !', 2, '2023-05-25 08:00:27', 3, '#CF00BE'),
(69, 'L\'exactitude et l\'uniformité, c\'est pain au chocolat !', 1, '2023-05-25 08:00:58', 3, '#F00'),
(70, 'Préférence personnelle, chacun son choix.', 2, '2023-05-25 08:01:30', 3, '#CF00BE'),
(71, 'En fin de compte, savourons-la, peu importe le nom.', 1, '2023-05-25 08:01:58', 3, '#F00'),
(72, 'Je suis bien d\'accord !', 2, '2023-05-25 08:03:11', 3, '#CF00BE'),
(74, 'Coucou tout le monde ! Je m\'appelle Toto et j\'adore dire coucou !', 1, '2023-05-25 08:13:14', 1, '#007AFF'),
(75, 'Salut Toto, bienvenue ^^', 2, '2023-05-25 08:16:32', 1, '#FF7000'),
(76, 'J\'ai utilisé chatGPT pour générer un débat sur pain au chocolat vs chocolatine entre Toto et moi, fascinant !', 2, '2023-05-25 08:18:53', 2, '#FF7000'),
(77, 'Moi je l\'utilise pour apprendre et comprendre de nouvelles fonctions quand je code.', 1, '2023-05-25 08:24:17', 2, '#007AFF'),
(79, 'Moi je l\'utilise pour imaginer des histoires d\'amour entre Tete et Tutu :D', 14, '2023-05-25 08:28:08', 2, '#15E25F'),
(80, '...', 1, '2023-05-25 08:28:17', 2, '#007AFF'),
(81, '...', 2, '2023-05-25 08:28:27', 2, '#FF7000');

-- --------------------------------------------------------

--
-- Structure de la table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE IF NOT EXISTS `rooms` (
  `room_id` int NOT NULL AUTO_INCREMENT,
  `room_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`room_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `rooms`
--

INSERT INTO `rooms` (`room_id`, `room_name`) VALUES
(1, 'Bienvenue'),
(2, 'Veille technologique'),
(3, 'Divers'),
(4, 'Room 1'),
(5, 'Room 2');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) DEFAULT NULL,
  `user_password` varchar(150) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password`, `user_email`) VALUES
(1, 'Toto', '$2y$10$qT0iXpNDjOe36q9FNhlb2enzptGlWIEHUtXKegu..KRu99rDM7Hoq', 'toto@gmail.com'),
(2, 'Tata', '$2y$10$4cQpHWKhzEYr8DZ0fcMQceK4XVE9c9/8Kd30CYnE1c2SNY4Ehqeum', 'tata@gmail.com'),
(14, 'Titi', '$2y$10$pxoH8A6o/r/g8G8dEjnadeJYtFo.76sKEil74KM/oA8G/1cvi8dCS', 'titi@gmail.com'),
(15, 'Tonton', '$2y$10$pBzrsw.L.R0SVoGMythRf.mExW.AlxZtY0dyCNKFZHTHxZEeeSUC.', 'tonton@gmail.com');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `messages`
--
ALTER TABLE `messages` ADD FULLTEXT KEY `FULLTEXT` (`msg_text`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_messages_rooms1` FOREIGN KEY (`msg_room_id`) REFERENCES `rooms` (`room_id`),
  ADD CONSTRAINT `fk_messages_users` FOREIGN KEY (`msg_user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
