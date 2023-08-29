-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 29 Août 2023 à 21:28
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `students`
--

-- --------------------------------------------------------

--
-- Structure de la table `etudiants`
--

CREATE TABLE `etudiants` (
  `id` int(11) NOT NULL,
  `nom_prenom` varchar(255) NOT NULL,
  `matricule` int(7) NOT NULL,
  `programme` varchar(255) NOT NULL,
  `carte_etudiante_image` varchar(555) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `etudiants`
--

INSERT INTO `etudiants` (`id`, `nom_prenom`, `matricule`, `programme`, `carte_etudiante_image`) VALUES
(1, 'Rayan, Tony', 1234567, 'Technique de ballet contemporain', 'https://happymag.tv/wp-content/uploads/2021/05/shrek4_disneyscreencaps.com_675.0.jpg'),
(2, 'Scarpino, Vincent', 7654321, 'Technique de l\'informatique', 'https://wallpapercave.com/wp/wp5216611.jpg'),
(3, 'St-Amand, Thomas', 2270432, 'Technique de l\'informatique', 'https://i.pinimg.com/736x/0d/88/72/0d8872867918f07489f6ce23e4c3edeb.jpg'),
(4, 'Carle, Shany', 7777777, 'Informatique', 'https://cdn.britannica.com/43/172743-138-545C299D/overview-Barack-Obama.jpg');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `etudiants`
--
ALTER TABLE `etudiants`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `etudiants`
--
ALTER TABLE `etudiants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
