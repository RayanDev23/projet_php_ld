-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 11 nov. 2023 à 11:40
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
-- Base de données : `projet_php`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`) VALUES
(1, 'Legs'),
(2, 'Pecs'),
(3, 'Dos');

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

DROP TABLE IF EXISTS `commandes`;
CREATE TABLE IF NOT EXISTS `commandes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int DEFAULT NULL,
  `date_commande` date DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_commandes_utilisateurs` (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commande_produit`
--

DROP TABLE IF EXISTS `commande_produit`;
CREATE TABLE IF NOT EXISTS `commande_produit` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_commande` int DEFAULT NULL,
  `id_produit` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_commande` (`id_commande`),
  KEY `id_produit` (`id_produit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `prix` decimal(10,2) DEFAULT NULL,
  `stock` int DEFAULT NULL,
  `id_categorie` int DEFAULT NULL,
  `image_sport` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_produits_categories` (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `nom`, `description`, `prix`, `stock`, `id_categorie`, `image_sport`) VALUES
(1, 'Machine mustilation', 'Cette machine tonifie et conditionne les jambes, les bras, le haut et le bas du corps. Pour les confirmés et experts, idéal pour faire de l\'exercice à la maison.', '799.00', 10, 1, 'https://th.bing.com/th/id/OIP.aCKQM-yqFLmTqGAdESPB0gHaHa?pid=ImgDet&rs=1'),
(2, 'Machine à charge guidée', 'Stable et confortable pour des séances en toute sécurité, la home gym permet de travailler tous les groupes musculaires. Vous avez maintenant véritable mini-salle de muscu, chez vous !\r\n\r\nPour une séance d\'entraînement complète, et efficace à domicile, optez pour la home gym. Compacte, elle prend un minimum d\'espace pour un maximum de résultat !', '999.00', 5, 2, 'https://contents.mediadecathlon.com/p2040892/k$13675f5dbad29bab4e534c5398a9f0d1/sq/machine-musculation-charge-guidee-compact-home-gym-900.jpg?f=3000x3000'),
(3, 'Leg Press & Hack Squat', 'La presse à jambes et le Hack Squat GLPH1100 sont conçus pour supporter une vie entière d\'entraînement musculaire.', '2345.00', 3, 1, 'https://contents.mediadecathlon.com/m2660376/k$06ea6b991981e3531c9960b25a8ad4bf/sq/presse-a-cuisses-et-hack-squat-glph1100-pour-fitness-et-musculation.jpg?f=3000x3000'),
(4, 'Everfit MSK-500', 'La station de musculation Everfit MSK-500 est livrée complète avec une boucle de prêcheur, une barre de triceps et une sangle de cheville.', '499.00', 7, 3, 'https://contents.mediadecathlon.com/m383641/k$381fe33bcb5c6cd820fbd7ff167db1b5/sq/everfit-msk-500.jpg?f=3000x3000');

-- --------------------------------------------------------

--
-- Structure de la table `produit_categories`
--

DROP TABLE IF EXISTS `produit_categories`;
CREATE TABLE IF NOT EXISTS `produit_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_produit` int NOT NULL,
  `id_categorie` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_produit_categories_produits` (`id_produit`),
  KEY `fk_produit_categories_categories` (`id_categorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `first_name` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `profil_image` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `name`, `first_name`, `email`, `password`, `profil_image`) VALUES
(1, 'frfr', 'frfr', 'fergrehg@gmail.com', '$2y$10$KmkDX7MjagKPtGKfQ5Hyquw37XA/M2sD9VvBT1auUBcKGKlaoIS/6', NULL),
(2, 'lolo', 'lala', 'lololala@gmail.com', '$2y$10$vP2Afg34rM9O4zc5bK3RJ.l9MuZXzhDA1Jsz6SFB/15KT3ZaeqWKu', 'profile_images/lololala@gmail.com_1699606289_OIP (1).jpg'),
(3, 'fere', 'rere', 'lili@gmail.com', '$2y$10$.i1eDogT6O5Jwk1pZcCxKODQJDdhRWrgtHGlbGD.kFk6evYTEO18G', 'profile_images/lili@gmail.com_1699608079_OIP (1).jpg'),
(4, 'rara', 'rere', 'rara@gmail.com', '$2y$10$9mZKnvWaKwLSTDN4YhvKJ.bnMUBZeXEu5wylVjMijFhLmxqKnx7Ym', 'profile_images/rara@gmail.com_1699624984_presse-a-cuisses-et-hack-squat-glph1100-pour-fitness-et-musculation.jpg'),
(5, 'momo', 'mimi', 'momo@gmail.com', '$2y$10$m4JNZri4/9zWJZPVMnY7T.7NLW9qsf1wNyVagtE6YCulRxBLv7xM.', 'profile_images/momo@gmail.com_1699627070_car-1.jpg'),
(6, 'test', 'test', 'test1@gmail.com', '$2y$10$W9r07eViopNnVEwSwgh4HerQIOvz2mdYVB0HzwcgeduM2tPOwuUti', NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `produit_categories`
--
ALTER TABLE `produit_categories`
  ADD CONSTRAINT `fk_produit_categories_categories` FOREIGN KEY (`id_categorie`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_produit_categories_produits` FOREIGN KEY (`id_produit`) REFERENCES `produits` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
