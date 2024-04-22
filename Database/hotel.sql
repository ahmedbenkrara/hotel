-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 14 juin 2021 à 10:31
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `hotel`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `idA` int(11) NOT NULL,
  `prenom` text NOT NULL,
  `nom` text NOT NULL,
  `email` text NOT NULL,
  `pass` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`idA`, `prenom`, `nom`, `email`, `pass`) VALUES
(1, 'ahmed', 'benkrara', 'admin@admin.com', '$2y$10$JJb3MvGObmu28hRZyj4VF.KPnY7CTqSAf2xXwnXXV8CUTfKi.RBtS');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `idcat` int(11) NOT NULL,
  `intitule` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`idcat`, `intitule`, `description`) VALUES
(1, 'Single', 'A room assigned to one person, May have one or more beds.'),
(2, 'Double', 'A room assigned to two people, May have one or more beds.'),
(3, 'Triple', 'A room assigned to three people, May have two or more beds.'),
(4, 'Quad', 'A room assigned to four people, May have two or more beds.'),
(5, 'Queen', 'A room with a queen-sized bed, May be occupied by one or more people.'),
(6, 'King', 'A room with a king-sized bed, May be occupied by one or more people.'),
(7, 'Twin', 'A room with two beds, May be occupied by one or more people.'),
(8, 'Double-double', 'A room with two double (or perhaps queen) beds, May be occupied by one or more people.'),
(9, 'Studio', 'A room with a studio bed – a couch that can be converted into a bed, May also have an additional bed.');

-- --------------------------------------------------------

--
-- Structure de la table `chambre`
--

CREATE TABLE `chambre` (
  `numero` int(11) NOT NULL,
  `image` text DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `idcat` int(11) DEFAULT NULL,
  `amenties` text DEFAULT NULL,
  `prix` float DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `chambre`
--

INSERT INTO `chambre` (`numero`, `image`, `description`, `idcat`, `amenties`, `prix`, `status`) VALUES
(1, 'images/60915e608a31a7.80917898.jpg', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like)', 3, 'wifi,pool', 400, 0),
(2, 'images/60c61e9f0be5a9.51933306.jpg', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 5, 'pool', 100, 1),
(3, 'images/60c61ebf989157.80209804.jpg', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 1, 'wifi', 420, 1),
(4, 'images/60c61ecf4f3255.30965789.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popular', 3, 'wifi,pool', 500, 1),
(5, 'images/60c70ef6a7cc17.53161653.jpg', 'azttg', 3, 'fghuu', 400, 1);

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `idC` int(11) NOT NULL,
  `cin` text NOT NULL,
  `prenom` text NOT NULL,
  `nom` text NOT NULL,
  `email` text NOT NULL,
  `pass` text NOT NULL,
  `phone` text NOT NULL,
  `date_de_naissance` date NOT NULL,
  `token` text DEFAULT NULL,
  `verified` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`idC`, `cin`, `prenom`, `nom`, `email`, `pass`, `phone`, `date_de_naissance`, `token`, `verified`) VALUES
(16, 'aaaaaaaaa', 'aaaaaaaaa', 'aaaaaaaa', 'aaaaaaaaaaaa@aaaaaaaaa.oo', '$2y$10$5oO83/9yXskkKRpOtdX07e45wqVNiG8aX9heu6ycKvW.ez6hDdMmW', '0658997744', '2001-10-27', '', 1),
(20, 'H123589', 'Ahmed', 'Benkrara', 'pibidog918@moxkid.com', '$2y$10$JJb3MvGObmu28hRZyj4VF.KPnY7CTqSAf2xXwnXXV8CUTfKi.RBtS', '0658325488', '2001-10-27', '', 1);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `idR` int(11) NOT NULL,
  `idC` int(11) DEFAULT NULL,
  `Nperson` int(11) NOT NULL,
  `numero` int(11) DEFAULT NULL,
  `prix` float DEFAULT NULL,
  `paystatus` int(11) NOT NULL,
  `check_in_date` date NOT NULL,
  `check_out_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`idR`, `idC`, `Nperson`, `numero`, `prix`, `paystatus`, `check_in_date`, `check_out_date`) VALUES
(74, 16, 1, 3, 478.8, 1, '2021-06-13', '2021-06-14'),
(75, 20, 1, 2, 114, 0, '2021-06-13', '2021-06-14'),
(76, 20, 1, 4, 8070, 1, '2021-06-14', '2021-06-30'),
(77, 20, 3, 2, 214, 0, '2021-06-14', '2021-06-16');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idA`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`idcat`);

--
-- Index pour la table `chambre`
--
ALTER TABLE `chambre`
  ADD PRIMARY KEY (`numero`),
  ADD KEY `idcat` (`idcat`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`idC`),
  ADD UNIQUE KEY `cin` (`cin`) USING HASH;

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`idR`),
  ADD KEY `idC` (`idC`),
  ADD KEY `numero` (`numero`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `idA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `idcat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `idC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `idR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `chambre`
--
ALTER TABLE `chambre`
  ADD CONSTRAINT `chambre_ibfk_1` FOREIGN KEY (`idcat`) REFERENCES `categorie` (`idcat`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`idC`) REFERENCES `client` (`idC`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`numero`) REFERENCES `chambre` (`numero`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
