-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 22 juil. 2024 à 15:48
-- Version du serveur : 8.0.31
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cakephp_verbs`
--

-- --------------------------------------------------------

--
-- Structure de la table `answers`
--

DROP TABLE IF EXISTS `answers`;
CREATE TABLE IF NOT EXISTS `answers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `test_id` int NOT NULL,
  `verb_id` int NOT NULL,
  `infinitive_given` tinyint(1) NOT NULL DEFAULT '0',
  `infinitive` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `preterit_given` tinyint(1) NOT NULL DEFAULT '0',
  `preterit` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `past_participle_given` tinyint(1) NOT NULL DEFAULT '0',
  `past_participle` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `translation_given` tinyint(1) NOT NULL DEFAULT '0',
  `translation` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_done` tinyint(1) NOT NULL DEFAULT '0',
  `is_correct` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `answers`
--

INSERT INTO `answers` (`id`, `test_id`, `verb_id`, `infinitive_given`, `infinitive`, `preterit_given`, `preterit`, `past_participle_given`, `past_participle`, `translation_given`, `translation`, `is_done`, `is_correct`, `created`, `modified`) VALUES
(1, 8, 11, 1, 'cost', 0, 'cost', 0, 'cost', 0, 'coûter', 1, 1, '2024-07-22 14:36:06', '2024-07-22 15:46:08'),
(2, 8, 6, 0, 'build', 0, 'built', 1, 'built', 0, 'construire', 1, 1, '2024-07-22 14:36:06', '2024-07-22 15:46:40'),
(3, 8, 17, 0, 'eat', 0, 'eat', 0, 'eaten', 1, 'manger', 1, 0, '2024-07-22 14:36:06', '2024-07-22 15:46:58'),
(4, 8, 9, 0, 'chose', 0, 'chosen', 0, 'choisir', 1, 'choisir', 1, 1, '2024-07-22 14:36:06', '2024-07-22 15:47:15'),
(5, 8, 12, 0, 'cut', 1, 'cut', 0, 'cuten', 0, 'couper', 1, 0, '2024-07-22 14:36:06', '2024-07-22 15:47:32');

-- --------------------------------------------------------

--
-- Structure de la table `tests`
--

DROP TABLE IF EXISTS `tests`;
CREATE TABLE IF NOT EXISTS `tests` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mark` decimal(4,2) NOT NULL DEFAULT '0.00',
  `answer_not_done_count` int NOT NULL,
  `answer_done_count` int NOT NULL,
  `wrong_answer_count` int NOT NULL,
  `right_answer_count` int NOT NULL,
  `answer_count` int DEFAULT NULL,
  `is_finished` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tests`
--

INSERT INTO `tests` (`id`, `name`, `mark`, `answer_not_done_count`, `answer_done_count`, `wrong_answer_count`, `right_answer_count`, `answer_count`, `is_finished`, `created`, `modified`) VALUES
(8, 'Premier test', '0.00', 0, 5, 2, 3, 5, 1, '2024-07-22 14:36:06', '2024-07-22 15:47:32');

-- --------------------------------------------------------

--
-- Structure de la table `verbs`
--

DROP TABLE IF EXISTS `verbs`;
CREATE TABLE IF NOT EXISTS `verbs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `infinitive` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `preterit` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `past_participle` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `translation` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `verbs`
--

INSERT INTO `verbs` (`id`, `infinitive`, `preterit`, `past_participle`, `translation`, `created`, `modified`) VALUES
(18, 'awake', 'awoke', 'awaken', 'se réveiller', '2024-07-22 08:32:35', '2024-07-22 08:32:35'),
(2, 'become', 'became', 'become', 'devenir', '2024-07-18 10:12:18', '2024-07-18 15:08:29'),
(3, 'begin', 'began', 'begun', 'commencer', '2024-07-18 10:12:18', '2024-07-18 15:08:29'),
(4, 'break', 'broke', 'broken', 'casser', '2024-07-18 10:12:18', '2024-07-18 15:08:29'),
(5, 'bring', 'brought', 'brought', 'apporter', '2024-07-18 10:12:18', '2024-07-18 15:08:29'),
(6, 'build', 'built', 'built', 'construire', '2024-07-18 10:12:18', '2024-07-18 15:08:29'),
(7, 'buy', 'bought', 'bought', 'acheter', '2024-07-18 10:12:18', '2024-07-18 15:08:29'),
(8, 'catch', 'caught', 'caught', 'attraper', '2024-07-18 10:12:18', '2024-07-18 15:08:29'),
(9, 'choose', 'chose', 'chosen', 'choisir', '2024-07-18 10:12:18', '2024-07-18 15:08:29'),
(10, 'come', 'came', 'come', 'venir', '2024-07-18 10:12:18', '2024-07-18 15:08:29'),
(11, 'cost', 'cost', 'cost', 'coûter', '2024-07-18 10:12:19', '2024-07-18 15:08:29'),
(12, 'cut', 'cut', 'cut', 'couper', '2024-07-18 10:12:19', '2024-07-18 15:08:29'),
(13, 'do', 'did', 'done', 'faire', '2024-07-18 10:12:19', '2024-07-18 15:08:29'),
(14, 'draw', 'drew', 'drawn', 'dessiner', '2024-07-18 10:12:19', '2024-07-18 15:08:29'),
(15, 'drink', 'drank', 'drunk', 'boire', '2024-07-18 10:12:19', '2024-07-18 15:08:29'),
(16, 'lose', 'lost', 'lost', 'perdre', '2024-07-18 13:33:51', '2024-07-18 13:33:51'),
(17, 'eat', 'ate', 'eaten', 'manger', '2024-07-18 13:34:46', '2024-07-18 13:34:46'),
(19, 'arise', 'arose', 'arisen', 'survenir', '2024-07-22 08:33:50', '2024-07-22 08:33:50');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
