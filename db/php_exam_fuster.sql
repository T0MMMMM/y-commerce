-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 19 fév. 2025 à 18:41
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
(1, 'Portable', 'téléphone', 'téléphone iphone 14', '0000-00-00', '0000-00-00', 'http://localhost/y-commerce/images/test_image.jpg', 2, 0),
(2, 'Fruit', 'Mangue', 'bon fruit', '0000-00-00', '0000-00-00', 'http://localhost/y-commerce/images/test_image.jpg', 2, 0),
(3, 'Guitare', 'instrument', 'instrument de musique', '2025-02-17', '2025-02-17', 'http://localhost/y-commerce/images/test_image.jpg', 2, 100),
(4, 'Arnaud', 'arnaud', 'vvvvvvvvvvvvvArnaud', '2025-02-19', '2025-02-19', 'http://localhost/y-commerce/images/test_image.jpg', 20, 22),
(5, 'ArnaudArnaudArnaud', 'arnaudarnaudarnaud', 'ArnaudArnaudArnaud', '2025-02-19', '2025-02-19', 'http://localhost/y-commerce/images/test_image.jpg', 20, 333),
(6, 'Modifier l\'article', 'modifier-l-article', 'Modifier l\'article\n', '2025-02-19', '2025-02-19', 'http://localhost/y-commerce/images/test_image.jpg', 20, 113),
(7, 'ss', 'ss', 'ssss', '2025-02-19', '2025-02-19', 'http://localhost/y-commerce/images/test_image.jpg', 20, 22),
(8, 'Arnaud', 'arnaud', 'ssssssssssssssssssssssssssssssss', '2025-02-19', '2025-02-19', 'http://localhost/y-commerce/images/test_image.jpg', 46, 22);

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
  `adress` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `order`
--

INSERT INTO `order` (`id`, `user_id`, `transaction_date`, `total_price`, `article_list`, `adress`) VALUES
(1, 8, '2025-02-18', 300, '[34,35,36]', ''),
(2, 8, '2025-02-18', 300, '[37,38,39]', ''),
(3, 8, '2025-02-18', 300, '[40,41,42]', ''),
(4, 8, '2025-02-18', 300, '[43,44,45]', ''),
(5, 8, '2025-02-18', 300, '[46,47,48]', ''),
(6, 8, '2025-02-18', 300, '[49,50,51]', ''),
(7, 8, '2025-02-18', 1600, '[52,53,54]', ''),
(8, 13, '2025-02-18', 200, '[55]', ''),
(9, 18, '2025-02-19', 200, '[56]', ''),
(10, 47, '2025-02-19', 1570, '[165,166,167,168]', 'Montpellier');

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
(1, 2, 3),
(2, 1, 3),
(3, 3, 3),
(4, 2, 3),
(5, 1, 3),
(6, 3, 3),
(7, 2, 3),
(8, 1, 3),
(9, 3, 3),
(10, 2, 3),
(11, 1, 3),
(12, 3, 3),
(13, 2, 3),
(14, 1, 3),
(15, 3, 3),
(16, 2, 3),
(17, 1, 3),
(18, 3, 3),
(19, 2, 3),
(20, 1, 3),
(21, 3, 3),
(22, 2, 3),
(23, 1, 3),
(24, 3, 3),
(25, 2, 3),
(26, 1, 3),
(27, 3, 3),
(28, 2, 3),
(29, 1, 3),
(30, 3, 3),
(31, 2, 3),
(32, 1, 3),
(33, 3, 3),
(34, 2, 3),
(35, 1, 3),
(36, 3, 3),
(37, 2, 3),
(38, 1, 3),
(39, 3, 3),
(40, 2, 3),
(41, 1, 3),
(42, 3, 3),
(43, 2, 3),
(44, 1, 3),
(45, 3, 3),
(46, 2, 3),
(47, 1, 3),
(48, 3, 3),
(49, 2, 3),
(50, 1, 3),
(51, 3, 3),
(52, 2, 3),
(53, 1, 7),
(54, 3, 16),
(55, 3, 2),
(56, 3, 2),
(57, 2, 5),
(58, 1, 3),
(59, 5, 2),
(60, 6, 8),
(61, 2, 5),
(62, 1, 3),
(63, 5, 2),
(64, 6, 8),
(65, 2, 5),
(66, 1, 3),
(67, 5, 2),
(68, 6, 8),
(69, 2, 5),
(70, 1, 3),
(71, 5, 2),
(72, 6, 8),
(73, 2, 5),
(74, 1, 3),
(75, 5, 2),
(76, 6, 8),
(77, 2, 5),
(78, 1, 3),
(79, 5, 2),
(80, 6, 8),
(81, 2, 5),
(82, 1, 3),
(83, 5, 2),
(84, 6, 8),
(85, 2, 5),
(86, 1, 3),
(87, 5, 2),
(88, 6, 8),
(89, 2, 5),
(90, 1, 3),
(91, 5, 2),
(92, 6, 8),
(93, 2, 5),
(94, 1, 3),
(95, 5, 2),
(96, 6, 8),
(97, 2, 5),
(98, 1, 3),
(99, 5, 2),
(100, 6, 8),
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
(168, 6, 8);

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
(1, 'Arnauddddddd', NULL, 'abcdef', 3, 'avatar', '{\"role\":[\"user\"]}', '{\"wishlist\":[\"movies\",\"sports\"]}', NULL, NULL),
(2, 'Tommmmmmmmmm', NULL, 'devchut', 0, '', '{\"role\":[\"user\"]}', '{\"wishlist\":[]}', NULL, NULL),
(3, 'Lucas', NULL, 'lucas123', 0, '', '{\"role\":[\"user\"]}', '{\"wishlist\":[]}', NULL, NULL),
(6, 'Benjos', NULL, 'benja', 0, '', '{\"role\":[\"user\"]}', '{\"wishlist\":[]}', NULL, NULL),
(7, 'Loic', NULL, '$2y$10$6tPMiqzEyI6p8S8J0GHHqOC', 0, '', '{\"role\":[\"user\"]}', '{\"wishlist\":[]}', NULL, NULL),
(8, 'dddddxxxxxxxxxxxx', NULL, '$2y$10$Z4/lMEvPmt6F90mFHGMkSOfMdggiFsyZAOjnNHpHQsHIaOKJkkK1O', 20250200000000, '', '{\"role\":[\"user\"]}', '{\"wishlist\":[]}', NULL, '2025-02-18'),
(10, 'Arnauddddd', NULL, '$2y$10$0AeAiRCnfUznYJZXkAG1MOPyUKp59oOzfP2Zbn5hA.cqcewPMUgaS', 0, '', '{\"role\":[\"user\"]}', '{\"wishlist\":[]}', NULL, NULL),
(11, 'tomyyy', NULL, '$2y$10$h.VVNrImt8HYBSdzFlibwuQGqEKDWRDlUYpAU1qByfGMsqjIXjDdS', 0, '', '{\"role\":[\"user\"]}', '{\"wishlist\":[]}', NULL, NULL),
(12, 'dragon', NULL, '$2y$10$H1/BJ8yDdZYR8vEOywIOZ.xJqGTdxit89DBLaINwQ5hUuFvsQg6aG', 0, '', '{\"role\":[\"user\"]}', '{\"wishlist\":[]}', NULL, NULL),
(13, 'xxxxxxxxxxxxxxxxxxxx', NULL, '$2y$10$pqMHsnXnLiiNmj1H8Cg7vucmCynL.h2V2z3VVSrwCcwh/w9UVwMzm', 222891000000000, '', '{\"role\":[\"user\"]}', '{\"wishlist\":[]}', NULL, '2025-02-18'),
(14, 'leretour', NULL, '$2y$10$jksJA5Ueh./U1x7xQ9t/weJRU8fj4oscod8yQSUspCZq9mb..ULHK', 0, '', '{\"role\":[\"user\"]}', '{\"wishlist\":[]}', '2025-02-18', '2025-02-18'),
(15, 'finito2', NULL, '$2y$10$re5xR4XIQ6i/Cuv6wEjgF.UljmdvkB8Vc2OxQtvWdS00FjCdom8gG', 0, '', '{\"role\":[\"user\"]}', '{\"wishlist\":[]}', '2025-02-06', NULL),
(16, 'Lucas', NULL, '$2y$10$kLR2cVoOTysKle5LNhCsrez2gyjUgzrQCODYlAg76M.5R16UJIspe', 0, '', '{\"role\":[\"user\"]}', '{\"wishlist\":[]}', '2025-02-18', NULL),
(17, 'devchut', NULL, '$2y$10$UoCT6e6jQpVRrytWuB9qAu9RROmyOVxVrJ7YVRBpucMshIVJFyXla', 224, '', '{\"role\":[\"user\"]}', '{\"wishlist\":[]}', '2025-02-18', NULL),
(18, 'leretourrr', NULL, '$2y$10$Y5wVfOICgR9.M5By.0UQd.YTwq8a22oVeBYU//mNKXzf31PS/knU2', 101, '', '{\"role\":[\"user\"]}', '{\"wishlist\":[]}', '2025-02-19', '2025-02-19'),
(19, 'xxxxxxxxxxxww', NULL, '$2y$10$WHhmD92N6r/4BndMTdMWauQM5yHPIn/1UhLjC/Mc07jpSXdGj9PQO', 22, '', '{\"role\":[\"user\"]}', '{\"wishlist\":[]}', '2025-02-19', '2025-02-19'),
(21, 'admin2', NULL, '$2y$10$oj7Wd2SJCfgcmDR.FrRTreMd1IR5fD/nAbNvRmQz2p7bQuSC4Vwri', 0, '', '{\"role\":[\"user\"]}', '{\"wishlist\":[]}', '2025-02-19', NULL),
(23, 'atchatchatcha', NULL, '$2y$10$yQq25U3xO8gay5NB7QOhHeNlj8ESAaBOLy/uviO1oMNrvunvuj7sW', 0, '', '{\"role\":[\"user\"]}', '{\"wishlist\":[]}', '2025-02-19', NULL),
(24, 'atchatchatcha2', NULL, '$2y$10$VI3yPpyw8x34H7MMlP1mi.9P75ulKOh6H1RFLRyq8ZP09f.vlQ9JK', 0, '', '{\"role\":[\"user\"]}', '{\"wishlist\":[]}', '2025-02-19', NULL),
(26, 'atchatchatcha4', NULL, '$2y$10$7X3IYxjwGaMUm9hPJ50EPutWmmDND9FAAqk8TK/ZK34obJihu0yAq', 0, '', '{\"role\":[\"user\"]}', '{\"wishlist\":[]}', '2025-02-19', NULL),
(27, 'atchatchatcha6', NULL, '$2y$10$fJYU6zO37bvGarqrLfkw3.LzmnmZ92l.CgkS42GicgBN7hHV5bhby', 0, '', '{\"role\":[\"user\"]}', '{\"wishlist\":[]}', '2025-02-19', NULL),
(28, 'Dylan2', NULL, '$2y$10$zyPC4aJlLXUHKxudsVN0ju0MSZHoKPvsfSvjrZLLumW0WU6I0kV0O', 0, '', '{\"role\":[\"user\"]}', '{\"wishlist\":[]}', '2025-02-19', NULL),
(29, 'dylan3', NULL, '$2y$10$FPOBf2X0S9le89iySbJQhuceYrgzhM.I2S0uHce5pjTtudP7aaDeW', 0, '', '{\"role\":[\"user\"]}', '{\"wishlist\":[]}', '2025-02-19', NULL),
(30, 'dylan4', NULL, '$2y$10$pDWADvD6vdoRbVzCEem88O8z97jXps9VQJcYnl9choCmPxaK3eh/i', 0, '', '{\"role\":[\"user\"]}', '{\"wishlist\":[]}', '2025-02-19', NULL),
(31, 'passwords', NULL, '$2y$10$aHLZj94pbohX0pBvyJpzAOLUdoVZvAlftPNlVe5D40yufUEJDFJrm', 0, '', '{\"role\":[\"user\"]}', '{\"wishlist\":[]}', '2025-02-19', NULL),
(32, 'ArnaudArnaud', NULL, '$2y$10$Xzq2sHZ2qMuAnSZ4Y2LpyeE4ZqTC8K.Z7504gkz9vP7NYc1.sUhYO', 0, '', '{\"role\":[\"user\"]}', '{\"wishlist\":[]}', '2025-02-19', NULL),
(33, 'finitofinito', NULL, '$2y$10$meKVtpqsclokv11CuExlqesp8dm.aJgdGdADPAjfD2VMLFa8QaeR2', 0, '', '{\"role\":[\"user\"]}', '{\"wishlist\":[]}', '2025-02-19', NULL),
(34, 'ADMIN3', '0', 'test@gmaiL.com', 0, '', '{\"role\":[\"user\"]}', '{\"wishlist\":[]}', '2025-02-19', NULL),
(35, 'ADMIN4', '0', 'test@gmaiL.com', 0, '', '{\"role\":[\"user\"]}', '{\"wishlist\":[]}', '2025-02-19', NULL),
(36, 'ADMIN5', '0', 'test@gmaiL.com', 0, '', '{\"role\":[\"user\"]}', '{\"wishlist\":[]}', '2025-02-19', NULL),
(37, 'ADMIN6', '0', 'test@gmaiL.com', 0, '', '{\"role\":[\"user\"]}', '{\"wishlist\":[]}', '2025-02-19', NULL),
(38, 'ADMIN7', '0', 'test@gmaiL.com', 0, '', '{\"role\":[\"user\"]}', '{\"wishlist\":[]}', '2025-02-19', NULL),
(39, 'ADMIN9', '0', 'test@gmaiL.com', 0, '', '{\"role\":[\"user\"]}', '{\"wishlist\":[]}', '2025-02-19', NULL),
(40, 'ADMIN10', '0', 'test@gmaiL.com', 0, '', '{\"role\":[\"user\"]}', '{\"wishlist\":[]}', '2025-02-19', NULL),
(41, 'ADMIN11', 'test@gmail.com', '$2y$10$bp5.zBRto3ClCTdQRGlen.k8vbo9VJ.h44mRC6bB4z1WkKJd/A.9S', 0, '', '{\"role\":[\"user\"]}', '{\"wishlist\":[]}', '2025-02-19', NULL),
(42, 'arnaudddddxx', 'test@gmail.com', '$2y$10$rLyNWI6EbI4DneF1/bmUKuSwWakCnSaJGvrEQgnKcI549mIckUjCG', 0, '', '{\"role\":[\"user\"]}', '{\"wishlist\":[]}', '2025-02-19', NULL),
(43, 'ADMIN000', 'test@gmail.com', '$2y$10$zU/22PQrW/JMYrrXvEw/DOqi7me8ALo3OE.6nOofoFUajFIHCrt5G', 0, '', '{\"role\":[\"user\"]}', '{\"wishlist\":[]}', '2025-02-19', NULL),
(44, 'ADMIN000ADMIN000', 'test@gmail.com', '$2y$10$EcYrY8e9oW/ycPs.reV2dOxnmh3dTIxh9SrFl9ov5pTmjUrBtC7Qu', 0, '', '{\"role\":[\"user\"]}', '{\"wishlist\":[]}', '2025-02-19', NULL),
(45, 'sssssssss', 'test@gmail.com', '$2y$10$HsZ7D.cS3i16E2P2/6c9O.5gFp5VuPTnC4mhCnHNd6zX/aYqqHSQO', 0, '', '{\"role\":[\"user\"]}', '{\"wishlist\":[]}', '2025-02-19', NULL),
(46, 'ADMINLERETOUR', 'test@gmail.com', '$2y$10$q4SeGzbVXjemiPIE4sSSSuvWlFV4PS86I3R9vzqLQf/aRCzx6A6t.', 0, '', '{\"role\":[\"user\"]}', '{\"wishlist\":[]}', '2025-02-19', NULL),
(47, 'ADMINfinito', 'test@gmail.com', '$2y$10$1kKReMA9ogA97XdEu9VDZehRN8/Hcb8Ejw407CcNJH7F.ss9EnrHO', 109541, '', '{\"role\":[\"user\",\"admin\"]}', '{\"wishlist\":[]}', '2025-02-19', NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT pour la table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
