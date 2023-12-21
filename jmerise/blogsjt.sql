-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 21 déc. 2023 à 14:43
-- Version du serveur : 8.0.30
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blogsjt`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `img` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category_id` int DEFAULT NULL,
  `id_user` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `title`, `content`, `img`, `state`, `created_at`, `updatedAt`, `category_id`, `id_user`) VALUES
(2, 'article2', 'Un article', 'assets/img/codage.png', '0', '2020-08-03 15:07:20', '2023-12-21 08:50:31', 1, 13),
(3, 'article3', 'Un article', 'assets/img/_bc3f623c-3d25-45d0-bf30-a8aa2d515781.jpg', '0', '2020-08-03 15:07:20', '2023-12-21 08:50:52', 2, 13),
(4, 'article4', 'test', 'assets/img/velo.png', '1', '2023-12-10 20:35:26', '2023-12-19 08:10:57', 1, 13),
(5, 'article5', 'bonjour toto', 'https://placehold.co/600x400/png', '1', '2023-12-21 12:52:21', '2023-12-21 12:52:21', 2, 12),
(6, 'article6', 'Un article 10', 'assets/img/codage.png', '0', '2020-08-03 15:07:20', '2023-12-21 08:50:31', 1, 13),
(7, 'article7', 'Un article', 'assets/img/_bc3f623c-3d25-45d0-bf30-a8aa2d515781.jpg', '0', '2020-08-03 15:07:20', '2023-12-21 08:50:52', 2, 13),
(8, 'article8', 'test', 'assets/img/velo.png', '1', '2023-12-10 20:35:26', '2023-12-19 08:10:57', 1, 13),
(9, 'article9', 'bonjour toto', 'https://placehold.co/600x400/png', '1', '2023-12-21 12:52:21', '2023-12-21 12:52:21', 2, 12),
(10, 'Article10', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer egestas ut ligula non cursus. Fusce facilisis justo dolor. Praesent faucibus risus vel velit imperdiet, non pharetra nunc pulvinar. Donec viverra purus eu magna mollis pellentesque. Duis varius, urna eu scelerisque iaculis, ex ipsum varius libero, nec cursus ex odio vitae erat. Nunc eu venenatis felis, eu efficitur felis. Integer orci nulla, suscipit placerat dictum vel, varius nec mauris. Suspendisse sit amet felis odio. Sed a molestie nulla. Nunc suscipit tristique nulla, id faucibus erat lobortis et. Donec tempus mi in elementum consequat.\r\n\r\nProin id mollis urna, dictum congue massa. Vivamus non augue lobortis, efficitur ex non, suscipit felis. Quisque enim nisi, pretium vitae magna eu, interdum malesuada arcu. Pellentesque id ligula commodo, sollicitudin eros a, tempor est. Vivamus sollicitudin iaculis erat nec posuere. Integer euismod sem nisl. Curabitur at venenatis ligula, nec sagittis dui. Maecenas laoreet cursus quam. Proin sit amet consectetur quam. Morbi non volutpat turpis. Phasellus facilisis, leo eget volutpat dignissim, quam risus egestas orci, eget feugiat libero justo nec arcu.', 'https://placehold.co/600x400/png', '1', '2023-12-21 12:52:21', '2023-12-21 12:52:21', 2, 12);

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` int NOT NULL,
  `content` varchar(1500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `state` int NOT NULL,
  `created_at` timestamp NOT NULL,
  `id_user` int DEFAULT NULL,
  `id_article` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `content`, `state`, `created_at`, `id_user`, `id_article`) VALUES
(3, 'coucou', 0, '2023-12-21 12:45:39', 12, 2),
(4, 'test', 0, '2023-12-21 12:45:25', 12, 2),
(6, 'Coucou ', 0, '2023-12-21 13:25:51', 12, 5),
(7, 'salut', 1, '2023-12-21 13:27:58', 12, 4),
(9, 'j\'adore', 1, '2023-12-21 14:06:37', 12, 2),
(13, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer egestas ut ligula non cursus. Fusce facilisis justo dolor. Praesent faucibus risus vel velit imperdiet, non pharetra nunc pulvinar. Donec viverra purus eu magna mollis pellentesque. Duis varius, urna eu scelerisque iaculis, ex ipsum varius libero, nec cursus ex odio vitae erat. Nunc eu venenatis felis, eu efficitur felis. Integer orci nulla, suscipit placerat dictum vel, varius nec mauris. Suspendisse sit amet felis odio. Sed a molestie nulla. Nunc suscipit tristique nulla, id faucibus erat lobortis et. Donec tempus mi in elementum consequat.', 1, '2023-12-21 14:17:17', 12, 7);

-- --------------------------------------------------------

--
-- Structure de la table `sjt_category`
--

CREATE TABLE `sjt_category` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `sjt_category`
--

INSERT INTO `sjt_category` (`id`, `name`, `description`) VALUES
(1, 'DEV', 'Categorie qui concerne le developpement'),
(2, 'Divers', 'Plein de chose ');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `role`, `token`) VALUES
(1, 'nicos02', 'nicos02@outlook.fr', '$2y$10$iTyxsSX0D8Ihz8dxHj5GwOgiSnfvCNZZOe./rPPB9xmhb3rTVSb9W', 'user', 'c831b07506de0d8e07d64e3c928aeda28af53e3c4f030f9696f53d5bb28af09d'),
(2, 'test45', '1234@test.fr', '$2y$10$3Mwkd4GpGQm7RNxjKPql5uzaFfRkja1cDmNjDfCZGG/qlAbaufrMu', 'user', '93349f71bfeb37bcac110939a74ed6fe9edcb1b767bf70728e608b86e25fbf90'),
(3, 'test454444', '1234@test.fr', '$2y$10$K4.qEB01JCRSn.t1QkQ1r.0iBxydN3V/FbDapLV/.cEZPeb5noh.a', 'user', '3099ed013384a65195f0a0671f5db668efa933d96e2cdcf147f3806ca98b6a52'),
(4, 'test111', '1234@test.fr', '$2y$10$JRyhvvkls2OAIuNtiqYkFOaek1goRR.1KoEOUiQj4PDWvmyIBi6Gy', 'user', 'a4bc228d0a27aa99a159e271e1946b4921f2cc9f6c087899b5a51f958162196f'),
(5, 'nicos024', '1234@test.fr', '$2y$10$ZvKM78/IDfiZT6BlfxRmC.Rk67Oro4zKZ6vZykovPWeBUrRjPBZ1C', 'user', 'a183fa55e1cccaaedfc68d16ac7aaabd39efe6d4639795b41af82febe5da4a07'),
(6, 'testddd', 'test02@gm.frd', '$2y$10$i.Xg57oNlgTfdmLZrHGfMusJC2kcht4NUPuvyIijaBYOGTKPlDr5a', 'user', '98ad9ba3f640f97359a1d072316c72d95849aaacbe9b498825dd0fff2bc93f27'),
(8, 'cbgcb', 'test02@gmail.com', '$2y$10$YSmLFWpgPvL091dMP7fTr.DlcvJxGVTpoVvXDwQw5rI6kL7K4TiGe', 'user', '169dd44836c5c03de13d6ee8e30c46552cba99da08c8b7af28066dca6d1b4861'),
(9, 'test44545', 'test02@gm.fr', '$2y$10$mPrmW0x6zRS7mrb0wkUhSOKAyEkPwuDJrITrsrRgSUuKjLPJETQ7G', 'user', '7b9237625d3e8239e4ef682b72ae0da78921690037f4cfa6afbe83fa3bf9f2c3'),
(10, 'test4575', 'nicos02@outlook.frs', '$2y$10$Wl3dw3UdsuX1KbfKTXV2reCyLfrQr.5e2KfcHKByyzEj5uXAVsyby', 'user', 'bf17a3d060c54b434418b275a673e15716761fc49c056a8675533b7c1cd3892e'),
(11, 'toto456', 'test02@gm.fr44', '$2y$10$akqjGoghblEwysD5lAYlrO1LxmN.7TUPLUHCE9yAjUtTqtaIuBOba', 'user', '60a5d8bf6767085b115d12a6e796b77e4eb3dcbbb42d7e998d17b707d5d7dd1b'),
(12, 'admin', 'admin@admin.fr', '$2y$10$DwMrW0Rf8SfMQfrZJZOFcuhETidpw3z6j2odWGTdiQ4ub496acuGi', 'admin', NULL),
(13, 'user', 'user@user.fr', '$2y$10$jCWqBHWJRMUHxIVH4EY6cuZiw71V0zcX8wFFV.8huA6frSqUIzgo2', 'user', 'fb1f732b300fbf08674859da463dbb482bbbb5c221f1552794aeefdfededd0ad'),
(14, 'adminvfkgj', 'fvdsfj@fskff.fdd', '$2y$10$5EHHqMHP2IUd5m4av1mJmedvaCqcN0gAGvtgSiij7DF8fkC/4QCoq', 'user', '8a1880d6eb93821556293d5673745e1b4934012de0a5d7deb53f661651a3f9c9');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`) USING BTREE,
  ADD KEY `id_user` (`id_user`) USING BTREE;

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_article` (`id_article`);

--
-- Index pour la table `sjt_category`
--
ALTER TABLE `sjt_category`
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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `sjt_category`
--
ALTER TABLE `sjt_category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `category-id` FOREIGN KEY (`category_id`) REFERENCES `sjt_category` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `id_article` FOREIGN KEY (`id_article`) REFERENCES `article` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `id_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
