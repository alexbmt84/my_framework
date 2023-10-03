-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 03 oct. 2023 à 10:09
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
-- Base de données : `my_framework`
--

-- --------------------------------------------------------

--
-- Structure de la table `routing`
--

DROP TABLE IF EXISTS `routing`;
CREATE TABLE IF NOT EXISTS `routing` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `real_path` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `routing`
--

INSERT INTO `routing` (`id`, `url`, `real_path`) VALUES
(1, 'connexion', 'default/connexion'),
(2, 'home', 'default/home'),
(3, 'register', 'default/register'),
(4, 'logout', 'default/logout');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'Alex', 'alexisdev@gmail.com', '$2y$10$lNzIA..JbA54l9KUq58U2e3UvTg/gfKDkaacu7.H4DfEcl.0ivbDe'),
(2, 'Glanum', 'glanum@gmail.com', '$2y$10$LJXNcvBKwmTKLlYW2hKeM.iW7mOEXohOf7ZZpUewQQ8sXisNAH6oe'),
(3, 'Test', 'test@gmail.com', '$2y$10$lNzIA..JbA54l9KUq58U2e3UvTg/gfKDkaacu7.H4DfEcl.0ivbDe');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
