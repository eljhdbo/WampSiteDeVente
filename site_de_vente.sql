-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 26 juin 2024 à 18:48
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `site_de_vente`
--

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  `prix` double NOT NULL,
  `stock` int NOT NULL,
  `image` varchar(255) NOT NULL,
  `qteDansLePanier` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `libelle`, `prix`, `stock`, `image`, `qteDansLePanier`) VALUES
(1, 'Arme de Poing 1', 499.99, 10, 'images/arme1.jpg', 0),
(2, 'Arme de Poing 2', 599.99, 2, 'images/arme2.jpg', 0),
(3, 'Arme de Poing 3', 699.99, 9, 'images/arme3.jpg', 0),
(4, 'Arme de Poing 4', 799.99, 8, 'images/arme4.jpg', 0),
(5, 'Arme de Poing 5', 899.99, 18, 'images/arme5.jpg', 0),
(6, 'Arme de Poing 6', 999.99, 2, 'images/arme6.jpg', 0),
(7, 'Arme Spéciale 1', 1499.99, 0, 'images/event_weapon1.jpg', 0),
(8, 'Arme Spéciale 2', 1999.99, 0, 'images/event_weapon2.jpg', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
