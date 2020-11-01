-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 01 nov. 2020 à 18:10
-- Version du serveur :  8.0.21
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `reservsalle`
--
CREATE DATABASE IF NOT EXISTS `reservsalle` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `reservsalle`;

-- --------------------------------------------------------

--
-- Structure de la table `creneau`
--

DROP TABLE IF EXISTS `creneau`;
CREATE TABLE IF NOT EXISTS `creneau` (
  `id` int NOT NULL AUTO_INCREMENT,
  `heureDebut` varchar(5) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `creneau`
--

INSERT INTO `creneau` (`id`, `heureDebut`) VALUES
(1, '08:30'),
(2, '10:30'),
(3, '13:30'),
(4, '15:15'),
(5, '17:01');

-- --------------------------------------------------------

--
-- Structure de la table `dispo`
--

DROP TABLE IF EXISTS `dispo`;
CREATE TABLE IF NOT EXISTS `dispo` (
  `jour` date NOT NULL,
  `idSalle` int NOT NULL,
  `idCreneau` int NOT NULL,
  KEY `FK_idCreneau_Dispo` (`idCreneau`),
  KEY `FK_idSalle_Dispo` (`idSalle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `dispo`
--

INSERT INTO `dispo` (`jour`, `idSalle`, `idCreneau`) VALUES
('2020-11-01', 51, 3),
('2020-11-01', 52, 5),
('2020-11-02', 35, 4),
('2020-11-02', 42, 5),
('2020-11-02', 48, 1),
('2020-11-02', 6, 1),
('2020-11-02', 2, 2),
('2020-11-02', 1, 1),
('2020-11-02', 1, 3),
('2020-11-02', 1, 2),
('2020-11-02', 52, 1),
('2020-11-02', 52, 3),
('2020-11-02', 37, 4),
('2020-11-02', 51, 2),
('2020-11-02', 51, 3),
('2020-11-02', 51, 4),
('2020-11-02', 51, 5),
('2020-11-02', 50, 1),
('2020-11-02', 50, 4),
('2020-11-02', 49, 4),
('2020-11-02', 46, 1),
('2020-11-02', 49, 1),
('2020-11-01', 44, 3),
('2020-11-02', 44, 1),
('2020-11-02', 5, 3),
('2020-11-02', 5, 4),
('2020-11-02', 5, 5),
('2020-11-02', 3, 5),
('2020-11-02', 38, 5),
('2020-11-02', 46, 5),
('2020-11-03', 2, 2),
('2020-11-03', 4, 1),
('2020-11-03', 45, 3),
('2020-11-03', 41, 2),
('2020-11-03', 38, 4),
('2020-11-03', 1, 2),
('2020-11-03', 2, 3),
('2020-11-03', 3, 2),
('2020-11-03', 4, 4),
('2020-11-03', 6, 2),
('2020-11-03', 6, 1),
('2020-11-03', 11, 3),
('2020-11-03', 37, 2),
('2020-11-03', 37, 4),
('2020-11-04', 2, 3),
('2020-11-04', 39, 3),
('2020-11-04', 11, 5),
('2020-11-04', 39, 3),
('2020-11-04', 11, 5),
('2020-11-04', 1, 5),
('2020-11-04', 2, 5),
('2020-11-04', 2, 1),
('2020-11-04', 3, 2),
('2020-11-04', 4, 1),
('2020-11-04', 5, 3),
('2020-11-04', 6, 4),
('2020-11-04', 1, 2),
('2020-11-04', 2, 1),
('2020-11-04', 3, 3),
('2020-11-04', 4, 5),
('2020-11-04', 6, 3),
('2020-11-04', 6, 5),
('2020-11-04', 11, 2),
('2020-11-04', 37, 5),
('2020-11-04', 38, 2),
('2020-11-04', 42, 1),
('2020-11-04', 50, 3),
('2020-11-04', 43, 4),
('2020-11-04', 39, 2),
('2020-11-04', 40, 1),
('2020-11-04', 44, 3),
('2020-11-04', 43, 5);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idSalle` int NOT NULL,
  `idUser` int NOT NULL,
  `idCreneau` int NOT NULL,
  `jour` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_idCreneau_Reservation` (`idCreneau`),
  KEY `FK_idSalle_Reservation` (`idSalle`),
  KEY `FK_idUser_Reservation` (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id`, `idSalle`, `idUser`, `idCreneau`, `jour`) VALUES
(1, 51, 3, 1, '2020-11-02'),
(2, 52, 3, 3, '2020-11-02'),
(5, 35, 3, 4, '2020-11-02'),
(7, 3, 3, 3, '2020-11-04'),
(8, 39, 3, 2, '2020-11-04'),
(9, 1, 3, 2, '2020-11-03'),
(11, 4, 3, 1, '2020-11-03'),
(12, 43, 3, 4, '2020-11-04'),
(13, 51, 3, 1, '2020-11-01'),
(14, 52, 3, 5, '2020-11-01'),
(15, 3, 2, 5, '2020-11-02'),
(16, 5, 2, 4, '2020-11-02'),
(17, 5, 2, 3, '2020-11-02'),
(18, 2, 2, 3, '2020-11-03'),
(19, 4, 2, 4, '2020-11-03'),
(20, 38, 2, 4, '2020-11-03'),
(21, 3, 2, 2, '2020-11-04'),
(22, 2, 2, 1, '2020-11-04'),
(23, 51, 2, 1, '2020-11-01'),
(24, 51, 2, 3, '2020-11-01'),
(25, 51, 1, 3, '2020-11-01'),
(26, 52, 1, 5, '2020-11-01'),
(27, 51, 1, 1, '2020-11-02'),
(28, 51, 1, 2, '2020-11-02'),
(29, 51, 1, 3, '2020-11-02'),
(30, 51, 1, 4, '2020-11-02'),
(31, 51, 1, 5, '2020-11-02'),
(32, 2, 1, 2, '2020-11-03'),
(33, 2, 1, 3, '2020-11-03'),
(34, 2, 1, 1, '2020-11-04'),
(35, 1, 1, 2, '2020-11-04'),
(36, 6, 3, 1, '2020-11-02');

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

DROP TABLE IF EXISTS `salle`;
CREATE TABLE IF NOT EXISTS `salle` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dispo` tinyint(1) NOT NULL,
  `numSalle` int NOT NULL,
  `nbPlaces` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `salle`
--

INSERT INTO `salle` (`id`, `dispo`, `numSalle`, `nbPlaces`) VALUES
(1, 1, 110, 10),
(2, 1, 109, 15),
(3, 1, 108, 1),
(4, 1, 107, 12),
(5, 1, 106, 10),
(6, 1, 105, 2),
(11, 1, 104, 12),
(28, 1, 201, 20),
(34, 1, 203, 2),
(35, 1, 202, 10),
(37, 1, 102, 100),
(38, 1, 111, 15),
(39, 1, 112, 10),
(40, 1, 301, 100),
(41, 1, 302, 50),
(42, 1, 304, 15),
(43, 1, 305, 15),
(44, 1, 306, 15),
(45, 1, 307, 15),
(46, 1, 308, 15),
(47, 1, 309, 100),
(48, 1, 310, 50),
(49, 1, 311, 15),
(50, 1, 312, 10),
(51, 1, 8, 15),
(52, 1, 101, 100);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `mdp` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `admin` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `mdp`, `admin`) VALUES
(1, 'mathias@3il.fr', '$argon2i$v=19$m=65536,t=4,p=1$YTEud3lEMVdaVFAzallaTw$HE4LV3aO58K30RGDWxNhrGdBsrgYQpDJPzeCKxKpBwU', 0),
(2, 'anselme@3il.fr', '$argon2i$v=19$m=65536,t=4,p=1$dEl1NmIvT2JaZzlneTVzWA$Yb5WafS7i3KgktSk3bw9ki+K9Mm6+LPO1juvOc4guLQ', 0),
(3, 'antoine@3il.fr', '$argon2i$v=19$m=65536,t=4,p=1$L29Rbi53V0tOV3ZqSG5sZg$59Z8YogcteBkQ3PI/Ii6h6WJdiNDFvgZUXvR9EVNTDQ', 0),
(25, 'admin@3il.fr', '$argon2i$v=19$m=65536,t=4,p=1$bEE2NWk5Z1RRVlZzVUtRRg$7o0rGf4xvXsXfplRyTKoOJT+UlSr+fcDimFy6xe/SJs', 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `dispo`
--
ALTER TABLE `dispo`
  ADD CONSTRAINT `FK_idCreneau_Dispo` FOREIGN KEY (`idCreneau`) REFERENCES `creneau` (`id`),
  ADD CONSTRAINT `FK_idSalle_Dispo` FOREIGN KEY (`idSalle`) REFERENCES `salle` (`id`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `FK_idCreneau_Reservation` FOREIGN KEY (`idCreneau`) REFERENCES `creneau` (`id`),
  ADD CONSTRAINT `FK_idSalle_Reservation` FOREIGN KEY (`idSalle`) REFERENCES `salle` (`id`),
  ADD CONSTRAINT `FK_idUser_Reservation` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
