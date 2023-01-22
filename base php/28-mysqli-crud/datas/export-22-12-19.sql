-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : lun. 19 déc. 2022 à 13:50
-- Version du serveur : 10.6.5-MariaDB
-- Version de PHP : 8.1.0

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de données : `basecrud`
--
DROP DATABASE IF EXISTS `basecrud`;
CREATE DATABASE IF NOT EXISTS `basecrud` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `basecrud`;

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `idarticles` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `art_title` varchar(200) NOT NULL,
  `art_text` text NOT NULL,
  `art_date` datetime DEFAULT current_timestamp(),
  `users_idusers` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`idarticles`),
  KEY `fk_articles_users1_idx` (`users_idusers`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`idarticles`, `art_title`, `art_text`, `art_date`, `users_idusers`) VALUES
(1, 'Insolite: quand Lionel Messi se fait surprendre par... sa maman', 'Lionel Messi était le centre du monde dimanche soir vers 18h50. L\'Argentine venait de décrocher son premier titre mondial depuis 1986 et Lionel Andrés Messi remportait le dernier trophée qui manquait à sa brillante carrière.\r\n\r\nLe natif de Rosario a paradé fièrement sur la pelouse, porté en triomphe par son ami Sergio Aguero, avec la Coupe du monde en main. \r\n\r\nMais après avoir reçu tant d\'attention de tant de personnes différentes, le nouveau champion du monde a d\'abord été surpris avant de reconnaître le visage de sa mère. Un large sourire apparaît alors sur le visage de Léo. Mère et fils tombent dans les bras l\'un de l\'autre pour un moment de communion intime. \r\n\r\n35 ans après l\'avoir mis au monde, Celia Maria Cuccittini peut être fière de son fiston. ', '2022-12-19 14:38:36', 3);

-- --------------------------------------------------------

--
-- Structure de la table `articles_has_rubriques`
--

DROP TABLE IF EXISTS `articles_has_rubriques`;
CREATE TABLE IF NOT EXISTS `articles_has_rubriques` (
  `articles_idarticles` int(10) UNSIGNED NOT NULL,
  `rubriques_idrubriques` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`articles_idarticles`,`rubriques_idrubriques`),
  KEY `fk_articles_has_rubriques_rubriques1_idx` (`rubriques_idrubriques`),
  KEY `fk_articles_has_rubriques_articles_idx` (`articles_idarticles`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `articles_has_rubriques`
--

INSERT INTO `articles_has_rubriques` (`articles_idarticles`, `rubriques_idrubriques`) VALUES
(1, 4),
(1, 5),
(1, 6);

-- --------------------------------------------------------

--
-- Structure de la table `rubriques`
--

DROP TABLE IF EXISTS `rubriques`;
CREATE TABLE IF NOT EXISTS `rubriques` (
  `idrubriques` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `rub_title` varchar(200) NOT NULL,
  `rub_text` varchar(800) DEFAULT NULL,
  PRIMARY KEY (`idrubriques`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `rubriques`
--

INSERT INTO `rubriques` (`idrubriques`, `rub_title`, `rub_text`) VALUES
(1, 'Belgique', 'La Belgique est un pays de l\'Europe de l\'Ouest réputé pour ses villes médiévales, son architecture Renaissance et pour accueillir le siège de l\'Union européenne et de l\'OTAN. Le pays comprend des régions distinctes, notamment la Flandre néerlandophone au nord, la Wallonie francophone au sud et une communauté germanophone à l\'est. Bruxelles, la capitale bilingue, offre des maisons des corporations richement ornées sur la Grand-Place et d\'élégants bâtiments art nouveau.'),
(2, 'Monde', 'Le Monde est un journal français fondé par Hubert Beuve-Méry en 1944. Se voulant journal « de référence », régulièrement considéré comme tel, y compris à l\'étranger, il est le quotidien national payant le plus lu en France et le plus diffusé.'),
(3, 'Région', 'Territoire possédant des caractères particuliers qui lui donnent une unité.\r\nRégion naturelle.'),
(4, 'Sport', 'Le sport, d\'usage récent ( XIX e siècle) dans la langue française, est un ensemble d\'exercices physiques se pratiquant sous forme de jeux individuels'),
(5, 'Football', NULL),
(6, 'People', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `idusers` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_login` varchar(80) NOT NULL,
  `user_pwd` varchar(255) NOT NULL,
  `user_name` varchar(180) NOT NULL,
  PRIMARY KEY (`idusers`),
  UNIQUE KEY `user_login_UNIQUE` (`user_login`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`idusers`, `user_login`, `user_pwd`, `user_name`) VALUES
(1, 'Jaouad', 'Jaouad', 'Jaouad'),
(2, 'Pierre', 'Pierre', 'Pierre'),
(3, 'Fred', 'Fred', 'Fred');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `fk_articles_users1` FOREIGN KEY (`users_idusers`) REFERENCES `users` (`idusers`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `articles_has_rubriques`
--
ALTER TABLE `articles_has_rubriques`
  ADD CONSTRAINT `fk_articles_has_rubriques_articles` FOREIGN KEY (`articles_idarticles`) REFERENCES `articles` (`idarticles`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_articles_has_rubriques_rubriques1` FOREIGN KEY (`rubriques_idrubriques`) REFERENCES `rubriques` (`idrubriques`) ON DELETE NO ACTION ON UPDATE NO ACTION;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
