-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 18 mai 2023 à 10:33
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `concours`
--

-- --------------------------------------------------------

--
-- Structure de la table `etud3a`
--

CREATE TABLE `etud3a` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `naissance` varchar(30) NOT NULL,
  `diplome` varchar(30) NOT NULL,
  `niveau` text NOT NULL,
  `etablissement` text NOT NULL,
  `photo` varchar(255) NOT NULL,
  `cv` varchar(255) NOT NULL,
  `log` varchar(30) NOT NULL,
  `mdp` varchar(30) NOT NULL,
  `confirm_code` varchar(15) NOT NULL,
  `confirme` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `etud3a`
--

INSERT INTO `etud3a` (`id`, `nom`, `prenom`, `email`, `naissance`, `diplome`, `niveau`, `etablissement`, `photo`, `cv`, `log`, `mdp`, `confirm_code`, `confirme`) VALUES
(1, 'sabri', 'manal', 'ludgerd3@jnggmysqll.com', '24-01-2002', 'bac+2', '3ème', 'fst mohamadia', 'photos/image2.jpeg', 'cvs/cv2.jpg', 'm_anal', 'manal', '123310151', 1),
(2, 'samih', 'karima', 'deryl@jnggmysqll.com', '18-01-2001', 'bac+2', '3ème', 'fst jadida', 'photos/image4.jpeg', 'cvs/cv3.jpg', 'k_arima', 'karima', '162903289', 1),
(3, 'rihani', 'saad', 'madaie5@jnggmysqll.com', '10-11-2001', 'bac+2', '3ème', 'fst marrakech', 'photos/image5.jpg', 'cvs/cv7.png', 's_aad', 'saad', '268318989', 1),
(4, 'tamir', 'mouaad', 'carlette62@jnggmysqll.com', '13-10-2000', 'bac+2', '3ème', 'fst jadida', 'photos/image9.jpg', 'cvs/cv6.jpg', 'm_ouaad', 'mouaad', '433285719', 1),
(5, 'bnami', 'samia', 'browder.4@jnggmysqll.com', '20-04-2001', 'bac+2', '3ème', 'fst marrakech', '    photos/image1.jpg', 'cvs/cv12.jpg', 's_amia', 'samia', '564020927', 1);

-- --------------------------------------------------------

--
-- Structure de la table `etud4a`
--

CREATE TABLE `etud4a` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `naissance` varchar(30) NOT NULL,
  `diplome` varchar(30) NOT NULL,
  `niveau` text NOT NULL,
  `etablissement` text NOT NULL,
  `photo` varchar(255) NOT NULL,
  `cv` varchar(255) NOT NULL,
  `log` varchar(30) NOT NULL,
  `mdp` varchar(30) NOT NULL,
  `confirm_code` varchar(15) NOT NULL,
  `confirme` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `etud4a`
--

INSERT INTO `etud4a` (`id`, `nom`, `prenom`, `email`, `naissance`, `diplome`, `niveau`, `etablissement`, `photo`, `cv`, `log`, `mdp`, `confirm_code`, `confirme`) VALUES
(1, 'timasli', 'laila', 'lailatimasli2002@gmail.com', '26-03-2002', 'bac+3', '4ème', 'ensa marrakech', ' photos/image3.jpg', 'cvs/cv13.jpg', 'l_laila', 'laila123', '960267615', 1),
(2, 'talib', 'amine', 'jovanna.1@jnggmysqll.com', '08-12-2001', 'bac+3', '4ème', 'fst marrakech', 'photos/image8.jpg', 'cvs/cv5.png', 'amine_1', 'amine', '695703949', 1),
(3, 'elharti', 'inass', 'sholanda.11@jnggmysqll.com', '28-11-2001', 'bac+3', '4ème', 'ensa agadir', 'photos/images10.jpeg', 'cvs/cv9.jpg', 'inass1', 'inass', '807915431', 1),
(4, 'elamrani', 'sara', 'gurshan@jnggmysqll.com', '08-02-2001', 'bac+3', '4ème', 'fst marrakech', 'photos/image11.jpg', 'cvs/cv10.png', 's_ara', 'sara', '294906567', 1),
(5, 'hafid', 'hatim', 'gnata4@jnggmysqll.com', '05-06-2000', 'bac+3', '4ème', 'ensa marrakech', 'photos/image6.jpeg', 'cvs/cv8.jpg', 'h_atim', 'hatim', '088803319', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `etud3a`
--
ALTER TABLE `etud3a`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `log` (`log`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `log_2` (`log`);

--
-- Index pour la table `etud4a`
--
ALTER TABLE `etud4a`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `log` (`log`),
  ADD UNIQUE KEY `log_2` (`log`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `log_3` (`log`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `etud3a`
--
ALTER TABLE `etud3a`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `etud4a`
--
ALTER TABLE `etud4a`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
