-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 21 fév. 2025 à 11:31
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
  `publication_date` datetime NOT NULL,
  `modification_date` datetime NOT NULL,
  `image_link` varchar(128) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `name`, `slug`, `description`, `publication_date`, `modification_date`, `image_link`, `owner_id`, `price`) VALUES
(10, 'TShirt - I Love Nerds Y2K Baby', 'tshirt-i-love-nerds-y2k-baby-tee', '- Matériaux : 95 % coton, 5 % élasthanne\n- Longueur courte et silhouette ajustée\n- Instructions de lavage : à la main ou en machine ; ne pas sécher au sèche-linge et repasser sur le motif.', '2025-02-15 00:00:00', '2025-02-15 00:00:00', 'http://localhost/y-commerce/images/i-love-nerds-y2k-baby-tee-921458.png', 55, 24.5),
(11, 'T-Shirt Dancing Dogs Chunky Sh', 't-shirt-dancing-dogs-chunky-shirt', '- Matériaux : 100 % coton\n- Genre : unisexe\n- Coupe : surdimensionnée\n- Instructions de lavage : à la main ou en machine ; ne pas sécher au sèche-linge et repasser sur le motif', '2025-02-16 00:00:00', '2025-02-16 00:00:00', 'http://localhost/y-commerce/images/cherrykitten.png', 55, 27.9),
(12, 'Doudoune Axel Arigato', 'doudoune-axel-arigato', 'Doudoune Observer Noire en polyester recyclé. Fermeture zippée. Poignets élastiqués. Ourlet avec cordon ajustable. Logo sérigraphié sur la poitrine.\n\nCouleur : NOIR', '2025-02-17 00:00:00', '2025-02-17 00:00:00', 'http://localhost/y-commerce/images/Doudoune.png', 54, 450),
(16, 'Chemise Soie Fleurs Floues', 'chemise-soie-fleurs-floues', 'Chemise Soie Fleurs Floues, au fini satiné. manches courtes. Logo brodé sur la poitrine. Col à larges revers crantés. Ourlet droit.\n\nCouleur : FANTAISIE, MARINE', '2025-02-19 00:00:00', '2025-02-19 00:00:00', 'http://localhost/y-commerce/images/chemise.png', 54, 320),
(21, 'Veste en nylon EKD', 'veste-en-nylon-ekd', 'Une veste à capuche légère en nylon dotée d\'une coupe oversize. Cette pièce présente notre emblème Equestrian Knight Design et des languettes de zip en B.\n– Fermeture zippée à double sens\n– Capuche et base à cordon de serrage\n– Poches latérales zippées\n– Poignets élastiqués', '2025-02-20 00:00:00', '2025-02-21 00:00:00', 'http://localhost/y-commerce/images/Veste.png', 95, 1700),
(22, 'Derby Soho Noir', 'derby-soho-noir', 'Type : Derby-hommes\nDesign : Dessiné et Stylisé en France\nMontage : Cousu Goodyear Véritable\nMatière : 100% Cuir de veau\nSemelle extérieure : Gomme\nPays de fabrication : Espagne', '2025-02-21 00:00:00', '2025-02-21 00:00:00', 'http://localhost/y-commerce/images/derby-soho-noir.png', 95, 140),
(23, 'Sneakers JULIAN Bleu Patine', 'sneakers-julian-bleu-patine', 'Type : Sneakers-hommes\nDesign : Dessiné et Stylisé en France\nMontage : Cousu latéral\nMatière : 100% Cuir de veau\nSemelle extérieure : Gomme\nPays de fabrication : Espagne', '2025-02-21 00:00:00', '2025-02-21 00:00:00', 'http://localhost/y-commerce/images/sneaker.png', 95, 210);

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

-- --------------------------------------------------------

--
-- Structure de la table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(94, 'ADMIN', 'admin@gmail.com', '$2y$10$LTPXnbgloFYiiBF7d5WnMOALPjexDYRTukv7BSyGRN5SG5V8RtymC', 21583, '', '{\"role\":[\"user\", \"admin\"]}', '{\"wishlist\":[]}', '2025-02-21', NULL),
(95, 'Benjamin', 'benjamin@gmail.com', '$2y$10$hxcVVZ3bLW4IY8PxmVymLOV.AAlKPHAUgfDujfjEDxJCdoxogKinC', 0, '', '{\"role\":[\"user\"]}', '{\"wishlist\":[]}', '2025-02-21', NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
