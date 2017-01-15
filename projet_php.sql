-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Dim 15 Janvier 2017 à 22:39
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet_php`
--

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `id_membre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `images`
--

INSERT INTO `images` (`id`, `name`, `description`, `image`, `ip`, `date`, `id_membre`) VALUES
(27, 'photo587bb82511527', 'android', 'image/photo587bb82511527.png', '::1', '2017-01-15 18:57:57', 18),
(28, 'photo587bb82e532cf', 'linkedin', 'image/photo587bb82e532cf.png', '::1', '2017-01-15 18:58:06', 18),
(29, 'photo587bb8440f0db', 'logo', 'image/photo587bb8440f0db.png', '::1', '2017-01-15 18:58:28', 15),
(30, 'photo587bb84ef2bc8', 'asanoha', 'image/photo587bb84ef2bc8.png', '::1', '2017-01-15 18:58:38', 15),
(31, 'photo587bbe0ed4a1c', 'github', 'image/photo587bbe0ed4a1c.png', '::1', '2017-01-15 19:23:10', 18),
(32, 'photo587bf851deaef', '', 'image/photo587bf851deaef.jpg', '::1', '2017-01-15 23:31:45', 19),
(33, 'photo587bf85e6a59e', '', 'image/photo587bf85e6a59e.jpg', '::1', '2017-01-15 23:31:58', 19);

-- --------------------------------------------------------

--
-- Structure de la table `profil`
--

CREATE TABLE `profil` (
  `id_membre` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(24) NOT NULL,
  `mail` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `profil`
--

INSERT INTO `profil` (`id_membre`, `name`, `password`, `mail`) VALUES
(1, 'Naomi', 'aaa', 'n@n.fr'),
(2, 'bobo', 'bbb', 'b@b.fr'),
(3, 'Coco', 'ccc', 'c@c.fr'),
(6, 'Ed', 'eee', 'e@e.fr'),
(5, 'didi', 'ddd', 'd@d.fr'),
(7, 'fifi', 'fff', 'f@f.fr'),
(8, 'fifi', 'fff', 'f@f.fr'),
(17, 'Nao', 'braWKW0Yph0KA', 'npaulmin@yahoo.com'),
(18, 'Naomi', 'brK1q.1PU7Dg.', 'n@n.fr'),
(16, 'Nao', 'braWKW0Yph0KA', 'npaulmin@yahoo.com'),
(15, 'gogo', 'br.lbjVtKJGBM', 'g@g.fr'),
(19, 'branis', 'br53tIK56otVs', 'branis.lb@gmail.com');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id_membre`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT pour la table `profil`
--
ALTER TABLE `profil`
  MODIFY `id_membre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
