-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : jeu. 19 jan. 2023 à 10:31
-- Version du serveur : 10.3.35-MariaDB
-- Version de PHP : 8.1.7

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de données : `exe29`
--
DROP DATABASE IF EXISTS `exe29`;
CREATE DATABASE IF NOT EXISTS `exe29` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `exe29`;

-- --------------------------------------------------------

--
-- Structure de la table `adresses`
--

DROP TABLE IF EXISTS `adresses`;
CREATE TABLE IF NOT EXISTS `adresses` (
                                          `idadresses` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                                          `nomadresses` varchar(200) NOT NULL,
                                          `mailadresses` varchar(250) NOT NULL,
                                          `dateadresses` datetime NOT NULL DEFAULT current_timestamp(),
                                          PRIMARY KEY (`idadresses`),
                                          UNIQUE KEY `mailadresses` (`mailadresses`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
