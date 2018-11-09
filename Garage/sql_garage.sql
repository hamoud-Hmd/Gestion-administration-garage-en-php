-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 06 nov. 2018 à 15:11
-- Version du serveur :  5.7.21
-- Version de PHP :  7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bge_garage`
--

-- --------------------------------------------------------

--
-- Structure de la table `constructeur`
--

DROP TABLE IF EXISTS `constructeur`;
CREATE TABLE IF NOT EXISTS `constructeur` (
  `con_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `con_nom` varchar(30) NOT NULL,
  PRIMARY KEY (`con_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `constructeur`
--

INSERT INTO `constructeur` (`con_id`, `con_nom`) VALUES
(1, 'renault'),
(2, 'peugeot'),
(3, 'citroen'),
(4, 'ferrari'),
(5, 'bmw');

-- --------------------------------------------------------

--
-- Structure de la table `garage`
--

DROP TABLE IF EXISTS `garage`;
CREATE TABLE IF NOT EXISTS `garage` (
  `gar_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `gar_modele` varchar(50) NOT NULL,
  `gar_carburant` varchar(20) NOT NULL,
  `gar_prix` double(10,2) UNSIGNED NOT NULL,
  `gar_couleur` varchar(20) DEFAULT NULL,
  `gar_annee` int(5) UNSIGNED DEFAULT NULL,
  `gar_nbrVoiture` int(5) UNSIGNED NOT NULL,
  `fk_con_id` int(10) UNSIGNED NOT NULL,
  `fk_res_id` int(11) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`gar_id`),
  KEY `fk_gar_con` (`fk_con_id`),
  KEY `fk_gar_res` (`fk_res_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `garage`
--

INSERT INTO `garage` (`gar_id`, `gar_modele`, `gar_carburant`, `gar_prix`, `gar_couleur`, `gar_annee`, `gar_nbrVoiture`, `fk_con_id`, `fk_res_id`) VALUES
(1, 'berline', 'essence', 10000.00, 'noir', 2010, 25, 1, 4),
(2, 'berline', 'diesel', 5000.00, 'vert', 2008, 15, 1, NULL),
(3, 'sport', 'essence', 14000.00, NULL, NULL, 15, 3, NULL),
(4, 'sport', 'essence', 400000.00, NULL, NULL, 1, 4, NULL),
(5, 'coupe', 'diesel', 10000.00, NULL, NULL, 10, 2, 3),
(6, 'familiale', 'diesel', 13000.00, NULL, NULL, 12, 5, NULL),
(7, 'sport', 'diesel', 16000.00, NULL, NULL, 15, 4, NULL),
(8, '4x4', 'essence', 17000.00, NULL, NULL, 14, 1, NULL),
(9, 'luxe', 'diesel', 10150.00, NULL, NULL, 5, 3, NULL),
(10, 'sport', 'hybride', 14000.00, NULL, NULL, 10, 1, NULL),
(11, 'familiale', 'diesel', 13000.00, NULL, NULL, 12, 5, NULL),
(12, 'iyiy', '', 15527.00, NULL, NULL, 14, 1, NULL),
(13, 'rouge', '', 14520.00, NULL, NULL, 14, 5, NULL),
(14, 'noir', '', 15000.00, NULL, NULL, 14, 1, NULL),
(15, 'coupée sport', 'essence', 7.00, NULL, NULL, 3, 3, NULL),
(16, 'test1', 'test1', 1.00, NULL, NULL, 1, 3, NULL),
(17, 'test2', 'test2', 1.00, NULL, NULL, 1, 1, NULL),
(18, 'grge', 'gerger', 1.00, NULL, NULL, 1, 1, NULL),
(19, 'test3', 'test3', 1.00, NULL, NULL, 1, 1, NULL),
(20, 'test4', 'test4', 1.00, NULL, NULL, 1, 1, 2),
(21, 'test5', 'test5', 1.00, NULL, NULL, 1, 1, NULL),
(22, 'test8', 'test8', 1.00, NULL, NULL, 1, 1, NULL),
(23, 'test19', 'test19', 1.00, NULL, NULL, 1, 1, NULL),
(25, 'chiche1', 'chiche1', 1.00, NULL, NULL, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `resa`
--

DROP TABLE IF EXISTS `resa`;
CREATE TABLE IF NOT EXISTS `resa` (
  `res_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `res_date` date NOT NULL,
  `res_somme_versee` int(11) NOT NULL,
  `res_type_paiment` varchar(255) NOT NULL,
  `res_is_valid` tinyint(1) NOT NULL,
  `res_penalite` int(11) DEFAULT NULL,
  `res_date_created` datetime DEFAULT NULL,
  `res_date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`res_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `resa`
--

INSERT INTO `resa` (`res_id`, `res_date`, `res_somme_versee`, `res_type_paiment`, `res_is_valid`, `res_penalite`, `res_date_created`, `res_date_updated`) VALUES
(2, '2018-11-07', 0, 'cb', 0, 0, '2018-11-05 15:12:59', '2018-11-06 11:47:53'),
(3, '2018-11-07', 10000, 'cheque', 1, NULL, '2018-11-05 16:22:39', '2018-11-06 11:48:02'),
(4, '2018-11-08', 4000, 'cheque', 1, NULL, '2018-11-06 11:48:33', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `usr_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `usr_pseudo` varchar(50) NOT NULL,
  `usr_pass` varchar(255) NOT NULL,
  `usr_mail` varchar(50) NOT NULL,
  `usr_dateNaissance` date NOT NULL,
  PRIMARY KEY (`usr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`usr_id`, `usr_pseudo`, `usr_pass`, `usr_mail`, `usr_dateNaissance`) VALUES
(1, 'dieu', 'dieu', 'dieu@dieu', '2018-10-16'),
(2, 'jesus', 'jesus', 'jesus@jesus', '2018-10-16'),
(3, 'test1', 'test1', 'test1@test1', '2018-10-16'),
(4, 'test2', '6d201beeefb589b08ef0672dac82353d0cbd9ad99e1642c83a1601f3d647bcca003257b5e8f31bdc1d73fbec84fb085c79d6e2677b7ff927e823a54e789140d9', 'test2@test2.fr', '2018-10-16'),
(5, 'test5', '64c26ffe3b35c65dfb93a8fd9a91828c57ed76d3809d06b03e17128125b48e5d01b37bb605a0a0305eff8341fbd56096664597f5cd091bf036e4ca31b304a9cc', 'test5@test5.fr', '2018-10-08'),
(6, 'test3', 'cb872de2b8d2509c54344435ce9cb43b4faa27f97d486ff4de35af03e4919fb4ec53267caf8def06ef177d69fe0abab3c12fbdc2f267d895fd07c36a62bff4bf', 'test3@test3.fr', '2018-11-19');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `garage`
--
ALTER TABLE `garage`
  ADD CONSTRAINT `fk_gar_con` FOREIGN KEY (`fk_con_id`) REFERENCES `constructeur` (`con_id`),
  ADD CONSTRAINT `fk_gar_res` FOREIGN KEY (`fk_res_id`) REFERENCES `resa` (`res_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
