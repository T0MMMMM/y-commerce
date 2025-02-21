-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 21 fév. 2025 à 11:05
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `php_exam_fuster`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `publication_date` date NOT NULL,
  `modification_date` date NOT NULL,
  `image_link` varchar(128) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `name`, `slug`, `description`, `publication_date`, `modification_date`, `image_link`, `owner_id`, `price`) VALUES
(10, 'TShirt - I Love Nerds Y2K Baby', 'tshirt-i-love-nerds-y2k-baby-tee', '- Matériaux : 95 % coton, 5 % élasthanne\n- Longueur courte et silhouette ajustée\n- Instructions de lavage : à la main ou en machine ; ne pas sécher au sèche-linge et repasser sur le motif.', '2025-02-15', '2025-02-15', 'http://localhost/y-commerce/images/i-love-nerds-y2k-baby-tee-921458.png', 55, 24.5),
(11, 'T-Shirt Dancing Dogs Chunky Sh', 't-shirt-dancing-dogs-chunky-shirt', '- Matériaux : 100 % coton\n- Genre : unisexe\n- Coupe : surdimensionnée\n- Instructions de lavage : à la main ou en machine ; ne pas sécher au sèche-linge et repasser sur le motif', '2025-02-16', '2025-02-16', 'http://localhost/y-commerce/images/cherrykitten.png', 55, 27.9),
(12, 'Doudoune Axel Arigato', 'doudoune-axel-arigato', 'Doudoune Observer Noire en polyester recyclé. Fermeture zippée. Poignets élastiqués. Ourlet avec cordon ajustable. Logo sérigraphié sur la poitrine.\n\nCouleur : NOIR', '2025-02-17', '2025-02-17', 'http://localhost/y-commerce/images/Doudoune.png', 54, 450),
(16, 'Chemise Soie Fleurs Floues', 'chemise-soie-fleurs-floues', 'Chemise Soie Fleurs Floues, au fini satiné. manches courtes. Logo brodé sur la poitrine. Col à larges revers crantés. Ourlet droit.\n\nCouleur : FANTAISIE, MARINE', '2025-02-19', '2025-02-19', 'http://localhost/y-commerce/images/chemise.png', 54, 320);

-- --------------------------------------------------------

--
-- Structure de la table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_date` date NOT NULL,
  `total_price` float NOT NULL,
  `article_list` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `adress` text NOT NULL,
  `postal_code` varchar(16) NOT NULL,
  `city` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `order`
--

INSERT INTO `order` (`id`, `user_id`, `transaction_date`, `total_price`, `article_list`, `adress`, `postal_code`, `city`) VALUES
(49, 94, '2025-02-21', 638, '[218,219,220]', '33 rue Messidor', '66000', 'Perpignan');

-- --------------------------------------------------------

--
-- Structure de la table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `order_details`
--

INSERT INTO `order_details` (`id`, `article_id`, `quantity`) VALUES
(101, 2, 5),
(102, 1, 3),
(103, 5, 2),
(104, 6, 8),
(105, 2, 5),
(106, 1, 3),
(107, 5, 2),
(108, 6, 8),
(109, 2, 5),
(110, 1, 3),
(111, 5, 2),
(112, 6, 8),
(113, 2, 5),
(114, 1, 3),
(115, 5, 2),
(116, 6, 8),
(117, 2, 5),
(118, 1, 3),
(119, 5, 2),
(120, 6, 8),
(121, 2, 5),
(122, 1, 3),
(123, 5, 2),
(124, 6, 8),
(125, 2, 5),
(126, 1, 3),
(127, 5, 2),
(128, 6, 8),
(129, 2, 5),
(130, 1, 3),
(131, 5, 2),
(132, 6, 8),
(133, 2, 5),
(134, 1, 3),
(135, 5, 2),
(136, 6, 8),
(137, 2, 5),
(138, 1, 3),
(139, 5, 2),
(140, 6, 8),
(141, 2, 5),
(142, 1, 3),
(143, 5, 2),
(144, 6, 8),
(145, 2, 5),
(146, 1, 3),
(147, 5, 2),
(148, 6, 8),
(149, 2, 5),
(150, 1, 3),
(151, 5, 2),
(152, 6, 8),
(153, 2, 5),
(154, 1, 3),
(155, 5, 2),
(156, 6, 8),
(157, 2, 5),
(158, 1, 3),
(159, 5, 2),
(160, 6, 8),
(161, 2, 5),
(162, 1, 3),
(163, 5, 2),
(164, 6, 8),
(165, 2, 5),
(166, 1, 3),
(167, 5, 2),
(168, 6, 8),
(194, 10, 2),
(195, 11, 1),
(196, 11, 3),
(197, 10, 2),
(198, 12, 1),
(199, 12, 1),
(200, 11, 2),
(201, 10, 2),
(202, 12, 1),
(203, 11, 5),
(204, 12, 3),
(205, 11, 3),
(206, 10, 3),
(207, 11, 1),
(208, 10, 3),
(209, 16, 2),
(210, 10, 1),
(211, 12, 1),
(212, 11, 1),
(213, 11, 1),
(214, 10, 1),
(215, 12, 1),
(216, 16, 1),
(217, 17, 1),
(218, 12, 1),
(219, 11, 5),
(220, 10, 2);

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `balance` float NOT NULL,
  `profil_image` varchar(255) NOT NULL,
  `role` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `wishlist` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `creation_date` date DEFAULT NULL,
  `modification_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `mail`, `password`, `balance`, `profil_image`, `role`, `wishlist`, `creation_date`, `modification_date`) VALUES
(54, 'Arnaud', 'arnaud@gmail.com', '$2y$10$XgJ.1Yaz5Zn.F4OsyQWqjeu3dyuNIDadzCblhGQcYh5iXxbcTbQOG', 23, '', '{\"role\":[\"user\"]}', '{\"wishlist\":[]}', '2025-02-09', NULL),
(55, 'Tomyyy', 'tom@gmail.com', '$2y$10$m5.H9kdsVC9dzFgX2W5xQeGtwI3v5GYubMSZMXf2KyFiML.SwkdHK', 0, '', '{\"role\":[\"user\"]}', '{\"wishlist\":[]}', '2025-02-10', NULL),
(94, 'ADMIN', 'admin@gmail.com', '$2y$10$LTPXnbgloFYiiBF7d5WnMOALPjexDYRTukv7BSyGRN5SG5V8RtymC', 21583, '', '{\"role\":[\"user\", \"admin\"]}', '{\"wishlist\":[]}', '2025-02-21', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT pour la table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;

--
-- AUTO_INCREMENT pour la table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
