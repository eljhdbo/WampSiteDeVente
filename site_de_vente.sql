-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 27 juin 2024 à 18:27
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
  `event_end_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `libelle`, `prix`, `stock`, `image`, `qteDansLePanier`, `event_end_date`) VALUES
(1, 'Walther PDP', 859.95, 17, 'Images\\098911-walther-pdp-sf-match-full-size-5quot-cal-9x19-1820-cps.jpg', 0, NULL),
(2, 'Beretta 92', 1159, 3, 'Images\\Beretta 92.jpeg', 0, NULL),
(3, 'Desert Eagle', 4049.99, 14, 'Images\\magnum-research-desert-eagle-cal-50ae.jpg', 0, NULL),
(4, 'Colt M1911', 199.99, 28, 'Images\\pim_25369-colt-m1911-government_1.jpg', 0, NULL),
(5, 'Glock 19', 699.99, 13, 'Images\\pistolet-glock-19-cal-bb-45-mm-umarex.jpg', 0, NULL),
(6, 'Smith & Wesson 629', 1861, 8, 'Images\\S&W 629 CAL 44MAG.jpg', 0, NULL),
(7, 'Noisy Cricket (Men in Black)', 689.9, 0, 'Images\\factory-entertainment-face408403-men-in-black-prop-replique-1-1-noisy-.jpg', 0, '2024-06-21'),
(8, 'Blaster DL-44 (Star Wars)', 1200, 0, 'Images\\han-solos-dl-44-blaster-prop-replica-star-wars-1-1024x1024.jpg', 0, '2024-06-21');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
