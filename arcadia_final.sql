-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 07 oct. 2024 à 05:43
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `arcadia_final`
--

-- --------------------------------------------------------

--
-- Structure de la table `animal`
--

CREATE TABLE `animal` (
  `animal_id` int(11) NOT NULL,
  `animal_name` varchar(50) NOT NULL,
  `habitat_id` int(11) NOT NULL,
  `breed_id` int(11) NOT NULL,
  `health` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `animal`
--

INSERT INTO `animal` (`animal_id`, `animal_name`, `habitat_id`, `breed_id`, `health`) VALUES
(1, 'Bumba', 1, 1, 'Bonne santé'),
(2, 'Pylo', 1, 1, 'Bonne santé'),
(3, 'Gouna', 1, 1, 'Légère fièvre'),
(4, 'Ganda', 1, 1, 'Forte fièvre'),
(5, 'Hathi', 1, 1, 'Bonne santé'),
(6, 'Nadim', 1, 1, 'Bonne santé'),
(7, 'Olga', 1, 2, 'Fatiguée'),
(8, 'Rafina', 1, 2, 'Bonne santé'),
(9, 'Gracia', 1, 2, 'Bonne santé'),
(10, 'Gaffy', 1, 2, 'Bonne santé'),
(11, 'Gumba', 1, 3, 'Bonne santé'),
(12, 'Noun', 1, 3, 'Bonne santé'),
(13, 'Simba', 1, 4, 'Manque d\'appétit'),
(14, 'Férone', 1, 5, 'En période de gestation'),
(15, 'Naolane', 1, 5, 'Bonne santé'),
(16, 'Rony', 1, 6, 'Bonne santé'),
(17, 'Ranou', 1, 6, 'Bonne santé'),
(18, 'Sei', 2, 7, 'Préparation de la mue'),
(19, 'Malau', 2, 8, 'Bonne santé'),
(20, 'Kong', 2, 8, 'Bonne santé'),
(21, 'Speedy', 2, 9, 'Bonne santé'),
(22, 'Louis', 2, 10, 'Bonne santé'),
(23, 'Fu', 2, 11, 'Bonne santé'),
(24, 'Ayu', 3, 12, 'Bonne santé'),
(25, 'Dundee', 3, 12, 'Bonne santé'),
(26, 'Pepe', 3, 12, 'Bonne santé'),
(27, 'Cadil', 3, 12, 'Bonne santé'),
(28, 'Pinky', 3, 13, 'Bonne santé'),
(29, 'Loustic', 3, 14, 'Bonne santé'),
(30, 'Louly', 3, 14, 'Bonne santé'),
(31, 'Bourne', 3, 14, 'Bonne santé'),
(32, 'Ria', 3, 14, 'Bonne santé'),
(33, 'Naga', 3, 15, 'Bonne santé'),
(34, 'Molly', 3, 16, 'Bonne santé'),
(35, 'Leo', 3, 16, 'Bonne santé'),
(36, 'Bowser', 3, 16, 'Bonne santé');

-- --------------------------------------------------------

--
-- Structure de la table `animal_image`
--

CREATE TABLE `animal_image` (
  `animal_image_id` int(11) NOT NULL,
  `animal_id` int(11) NOT NULL,
  `animal_image_url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `animal_image`
--

INSERT INTO `animal_image` (`animal_image_id`, `animal_id`, `animal_image_url`) VALUES
(1, 1, '/images/animaux/elephant2.jpg'),
(2, 2, '/images/animaux/elephant3.jpg'),
(3, 3, '/images/animaux/elephant4.jpg'),
(4, 4, '/images/animaux/elephant5.jpg'),
(5, 5, '/images/animaux/elephant6.jpg'),
(6, 6, '/images/animaux/elephant7.jpg'),
(7, 7, '/images/animaux/girafe1.jpg'),
(8, 8, '/images/animaux/girafe2.jpg'),
(9, 9, '/images/animaux/girafe2.jpg'),
(10, 10, '/images/animaux/girafe2.jpg'),
(11, 11, '/images/animaux/hippo1.jpg'),
(12, 12, '/images/animaux/hippo4.jpg'),
(13, 13, '/images/animaux/lion1.jpg'),
(14, 14, '/images/animaux/lionne1.jpg'),
(15, 15, '/images/animaux/lionne1.jpg'),
(16, 16, '/images/animaux/zebre1.jpg'),
(17, 17, '/images/animaux/zebre1.jpg'),
(18, 18, '/images/animaux/anaconda1.jpg'),
(19, 19, '/images/animaux/gorille1.jpg'),
(20, 20, '/images/animaux/gorille2.jpg'),
(21, 21, '/images/animaux/guepard1.jpg'),
(22, 22, '/images/animaux/orangoutan1.jpg'),
(23, 23, '/images/animaux/tigre1.jpg'),
(24, 24, '/images/animaux/crocodile1.jpg'),
(25, 25, '/images/animaux/crocodile2.jpg'),
(26, 26, '/images/animaux/crocodile3.jpg'),
(27, 27, '/images/animaux/crocodile4.jpg'),
(28, 28, '/images/animaux/flamrose1.jpg'),
(29, 29, '/images/animaux/loutres1.jpg'),
(30, 30, '/images/animaux/loutres1.jpg'),
(31, 31, '/images/animaux/loutres1.jpg'),
(32, 32, '/images/animaux/loutres1.jpg'),
(33, 33, '/images/animaux/couleuvre.jpg'),
(34, 34, '/images/animaux/tortue1.jpg'),
(35, 35, '/images/animaux/tortue1.jpg'),
(36, 36, '/images/animaux/tortue1.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `breed`
--

CREATE TABLE `breed` (
  `breed_id` int(11) NOT NULL,
  `breed_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `breed`
--

INSERT INTO `breed` (`breed_id`, `breed_name`) VALUES
(1, 'Elephant'),
(2, 'Girafe'),
(3, 'Hippopotame'),
(4, 'Lion'),
(5, 'Lionne'),
(6, 'Zèbre'),
(7, 'Anaconda'),
(8, 'Gorille'),
(9, 'Guépard'),
(10, 'Orang-outan'),
(11, 'Tigre'),
(12, 'Crocodile'),
(13, 'Flamant rose'),
(14, 'Loutre'),
(15, 'Couleuvre'),
(16, 'Tortue');

-- --------------------------------------------------------

--
-- Structure de la table `habitat`
--

CREATE TABLE `habitat` (
  `habitat_id` int(11) NOT NULL,
  `habitat_name` varchar(25) NOT NULL,
  `habitat_description` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `habitat`
--

INSERT INTO `habitat` (`habitat_id`, `habitat_name`, `habitat_description`) VALUES
(1, 'Savane', 'Notre savane reproduit un paysage d\'herbes tropicales ou subtropicales et d\'arbres.'),
(2, 'Jungle', 'Dans notre espace jungle, vous trouverez des plantes de forêts tropicale humide très dense et sauvage et des animaux différents.'),
(3, 'Marais', 'Notre marais est un sol recouvert par une couche d\'eau stagnante et constitué essentiellement de roseaux.');

-- --------------------------------------------------------

--
-- Structure de la table `habitat_image`
--

CREATE TABLE `habitat_image` (
  `habitat_image_id` int(11) NOT NULL,
  `habitat_id` int(11) NOT NULL,
  `habitat_image_url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `habitat_image`
--

INSERT INTO `habitat_image` (`habitat_image_id`, `habitat_id`, `habitat_image_url`) VALUES
(1, 1, '/images/photo_habitat/savane.jpg'),
(2, 2, '/images/photo_habitat/jungle.jpg'),
(3, 3, '/images/photo_habitat/marais.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_label` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`role_id`, `role_label`) VALUES
(1, 'Administrateur'),
(3, 'Vétérinaire'),
(4, 'Employé');

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

CREATE TABLE `service` (
  `service_id` int(11) NOT NULL,
  `service_name` varchar(100) NOT NULL,
  `service_description` longtext NOT NULL,
  `service_image_url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `service`
--

INSERT INTO `service` (`service_id`, `service_name`, `service_description`, `service_image_url`) VALUES
(1, 'Restauration', 'Un snack et un restaurant cuisinant des produits locaux vous accueillent au zoo', '/images/photos_services/restauration.png'),
(2, 'Visite guidée', 'Notre guide Merlin aura le plaisir de vous faire découvrir les habitats en vous détaillant les différentes étapes de leurs constructions.', '/images/photos_services/guide_visit.jpg'),
(3, 'Balade en petit train', 'Le parc zoologique a récemment installé un petit train pour une visite de notre grande savane.', '/images/photos_services/train.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `testimonial`
--

CREATE TABLE `testimonial` (
  `testimonial_id` int(11) NOT NULL,
  `visitor_firstname` varchar(50) NOT NULL,
  `visit_date` date NOT NULL,
  `message` text NOT NULL,
  `approuve_message` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `testimonial`
--

INSERT INTO `testimonial` (`testimonial_id`, `visitor_firstname`, `visit_date`, `message`, `approuve_message`) VALUES
(1, 'Pauline', '2020-08-30', 'Pour une découverte d\'habitats bien entretenus, n\'hésitez pas à vous y rendre', 1),
(2, 'Georges', '2017-06-24', 'Une visite féerique et animée grâce à la très belle équipe travaillant dans ce parc zoologique', 1),
(3, 'jessyca', '2024-09-04', 'Je recommande !', 1),
(8, 'Héléna', '2024-10-03', 'Visite agréable', 1),
(9, 'Héléna', '2024-10-01', 'zoo bien situé, facile d&#039;accès', 0);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_password`, `role_id`) VALUES
(1, 'José', '$2y$10$FNR8eCWxODOT4Y6XUgSgUehGpEJCKLBHQZurxiLmT73.LmuFMrvFK', 1),
(2, 'Josette', '$2y$10$a2UQ57bP3ITm4FxDsEtMcuag5VH.GJD69rYQEndzqeYtYYm10F6Rm', 4),
(3, 'Arthur', '$2y$10$L8XjDcw2zRb9CXyUxWJ8MefpSJWIci14I1rB.0pbwCFKvn2nj6XU2', 3),
(4, 'Merlin', '$2y$10$Vup/71MWQNIMhgiI8kPtx.zk48W2Utd7VBnDsr5yLwRlCIawl39cu where user_id = 4;\n', 4),
(5, 'Viviane', '$2y$10$bVFNgd3VNxKWxg71qGqdZ.FN2M4lGQI..K2d7QFK7vw/pf43Ljw/W', 4),
(6, 'Philippe', '$2y$10$WU/VGC2gag24LK1i0LY8dOliaNX7HAWDxmi.Wd6d9E0i1jX8RpKBC', 4),
(7, 'Rosita', '$2y$10$ahO2jkBaZS4CkSkR1UGPRuo3ZPM0quykbjRI/2bXLwBEshyNAgcAO', 4),
(8, 'Axel', '$2y$10$rbJqIxcgvZt9tycasO2soO.3bWB9JY8mkEom7MF10N2x8iWwthHJG', 4),
(9, 'Marianne', '$2y$10$vDo6V7vKTujhrghLIx.my.xyrBTTzwRBaMIvZeZ4/khUg4qK96VhK', 4),
(16, 'Jessyca', '$2y$10$CyZSAFyP9XK/har7thrsbe8q.JOfOEclrBGd35E9Xq3L6IywtGN1S', 1);

-- --------------------------------------------------------

--
-- Structure de la table `veterinary_report`
--

CREATE TABLE `veterinary_report` (
  `veterinary_report_id` int(11) NOT NULL,
  `animal_id` int(11) NOT NULL,
  `report_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `food` varchar(100) NOT NULL,
  `food_weight` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `veterinary_report`
--

INSERT INTO `veterinary_report` (`veterinary_report_id`, `animal_id`, `report_date`, `food`, `food_weight`) VALUES
(1, 1, '2023-08-23 22:00:00', 'pommes', '10 kg'),
(2, 7, '2022-01-04 23:00:00', 'feuilles', '30 kg'),
(3, 21, '2022-06-14 22:00:00', 'viande', '7 kg'),
(4, 20, '2013-04-08 22:00:00', 'feuilles et fruits', '25 kg'),
(5, 34, '2024-02-01 23:00:00', 'feuilles', '3 kg'),
(11, 11, '2024-10-06 01:03:30', '', ''),
(12, 2, '2024-10-06 01:03:47', '', ''),
(14, 36, '2024-10-06 14:43:46', '', '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`animal_id`),
  ADD KEY `breed_id` (`breed_id`),
  ADD KEY `habitat_id` (`habitat_id`);

--
-- Index pour la table `animal_image`
--
ALTER TABLE `animal_image`
  ADD PRIMARY KEY (`animal_image_id`),
  ADD KEY `animal_id` (`animal_id`);

--
-- Index pour la table `breed`
--
ALTER TABLE `breed`
  ADD PRIMARY KEY (`breed_id`);

--
-- Index pour la table `habitat`
--
ALTER TABLE `habitat`
  ADD PRIMARY KEY (`habitat_id`);

--
-- Index pour la table `habitat_image`
--
ALTER TABLE `habitat_image`
  ADD PRIMARY KEY (`habitat_image_id`),
  ADD KEY `habitat_id` (`habitat_id`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Index pour la table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`service_id`);

--
-- Index pour la table `testimonial`
--
ALTER TABLE `testimonial`
  ADD PRIMARY KEY (`testimonial_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Index pour la table `veterinary_report`
--
ALTER TABLE `veterinary_report`
  ADD PRIMARY KEY (`veterinary_report_id`),
  ADD KEY `veterinary_report_ibfk_1` (`animal_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `animal`
--
ALTER TABLE `animal`
  MODIFY `animal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT pour la table `animal_image`
--
ALTER TABLE `animal_image`
  MODIFY `animal_image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT pour la table `breed`
--
ALTER TABLE `breed`
  MODIFY `breed_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `habitat`
--
ALTER TABLE `habitat`
  MODIFY `habitat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `habitat_image`
--
ALTER TABLE `habitat_image`
  MODIFY `habitat_image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `service`
--
ALTER TABLE `service`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `testimonial`
--
ALTER TABLE `testimonial`
  MODIFY `testimonial_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `veterinary_report`
--
ALTER TABLE `veterinary_report`
  MODIFY `veterinary_report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `animal`
--
ALTER TABLE `animal`
  ADD CONSTRAINT `animal_ibfk_1` FOREIGN KEY (`breed_id`) REFERENCES `breed` (`breed_id`),
  ADD CONSTRAINT `animal_ibfk_2` FOREIGN KEY (`habitat_id`) REFERENCES `habitat` (`habitat_id`);

--
-- Contraintes pour la table `animal_image`
--
ALTER TABLE `animal_image`
  ADD CONSTRAINT `animal_image_ibfk_1` FOREIGN KEY (`animal_id`) REFERENCES `animal` (`animal_id`);

--
-- Contraintes pour la table `habitat_image`
--
ALTER TABLE `habitat_image`
  ADD CONSTRAINT `habitat_image_ibfk_1` FOREIGN KEY (`habitat_id`) REFERENCES `habitat` (`habitat_id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`);

--
-- Contraintes pour la table `veterinary_report`
--
ALTER TABLE `veterinary_report`
  ADD CONSTRAINT `veterinary_report_ibfk_1` FOREIGN KEY (`animal_id`) REFERENCES `animal` (`animal_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
