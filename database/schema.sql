-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 16 juil. 2026 à 16:43
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
-- Base de données : `tomtroc`
--

-- --------------------------------------------------------

--
-- Structure de la table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `availability` tinyint(1) NOT NULL DEFAULT 0,
  `cover_picture_path` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `books`
--

INSERT INTO `books` (`id`, `user_id`, `title`, `author`, `description`, `availability`, `cover_picture_path`, `created_at`, `updated_at`) VALUES
(1, 1, 'Esther', 'Alabaster', 'J\'ai récemment plongé dans les pages de Esther et j\'ai été profondément touché par la délicatesse de ce récit. Ce livre ne se contente pas de raconter une histoire ; il explore avec finesse les émotions humaines et les parcours de vie parfois fragiles.\nL’écriture sensible et les instants du quotidien décrits avec justesse créent une proximité immédiate avec les personnages.\nChaque page invite à l’introspection, à ralentir et à observer les nuances de la vie.\nEsther est une œuvre sincère et émouvante qui laisse une empreinte durable bien après la dernière page.', 1, './../public/uploads/books/livre3.jpg', '2026-06-13 11:00:30', '2026-07-05 17:42:04'),
(2, 2, 'The Kinfolk Table', 'Nathan Williams', 'J\'ai récemment plongé dans les pages de \'The Kinfolk Table\' et j\'ai été enchanté par cette œuvre captivante. Ce livre va bien au-delà d\'une simple collection de recettes ; il célèbre l\'art de partager des moments authentiques autour de la table. \r\n\r\nLes photographies magnifiques et le ton chaleureux captivent dès le départ, transportant le lecteur dans un voyage à travers des recettes et des histoires qui mettent en avant la beauté de la simplicité et de la convivialité. \r\n\r\nChaque page est une invitation à ralentir, à savourer et à créer des souvenirs durables avec les êtres chers. \r\n\r\n\'The Kinfolk Table\' incarne parfaitement l\'esprit de la cuisine et de la camaraderie, et il est certain que ce livre trouvera une place spéciale dans le cœur de tout amoureux de la cuisine et des rencontres inspirantes.', 1, './../public/uploads/books/6a4fee29cfa215.35110833.jpg', '2026-06-13 11:01:36', '2026-07-15 12:03:39'),
(3, 3, 'Wabi Sabi', 'Beth Kempton', 'J\'ai récemment découvert Wabi Sabi et j\'ai été apaisé par la philosophie qui s’en dégage. Ce livre va bien au-delà d’un simple concept esthétique ; il propose une véritable manière de voir et de ressentir le monde.\r\nLes mots, choisis avec soin, et les idées présentées avec simplicité offrent une lecture fluide et inspirante.\r\nChaque page est une invitation à embrasser l’imperfection et à trouver la beauté dans les choses simples.\r\nWabi Sabi est une lecture profondément apaisante qui invite à ralentir et à apprécier l’instant présent.', 1, './../public/uploads/books/livre1.jpg', '2026-06-13 11:02:18', '2026-06-21 17:30:09'),
(4, 4, 'Milk & honey', 'Rupi Kaur', 'J\'ai récemment parcouru Milk & Honey et j\'ai été frappé par la puissance brute de ses mots. Ce livre ne suit pas les codes traditionnels ; il livre des émotions à l’état pur, sans détour.\r\nLes textes courts mais intenses touchent directement, abordant des thèmes universels avec une grande sincérité.\r\nChaque page résonne comme une confidence, à la fois personnelle et universelle.\r\nMilk & Honey est une œuvre poignante et accessible qui parle au cœur avec une rare authenticité.', 1, './../public/uploads/books/livre2.jpg', '2026-06-13 11:02:54', '2026-06-21 17:30:31'),
(5, 1, 'Les Ombres de Valoria', 'Claire Duroc', 'J\'ai récemment plongé dans les pages de \'Les Ombres de Valoria\' et j\'ai été immédiatement captivé par son univers riche et mystérieux. Ce livre dépasse largement le simple récit de fantasy ; il explore les liens profonds entre pouvoir, mémoire et destinée.\r\n\r\nLes descriptions immersives et le rythme maîtrisé entraînent le lecteur dans un monde où chaque détail compte et où les secrets se dévoilent lentement.\r\n\r\nChaque chapitre est une invitation à s\'évader, à réfléchir et à ressentir intensément les émotions des personnages.\r\n\r\n\'Les Ombres de Valoria\' est une œuvre marquante qui séduira tous les amateurs d\'aventures épiques et de récits envoûtants.', 1, './../public/uploads/books/livre5.png', '2026-06-21 17:23:50', '2026-06-21 17:38:09'),
(6, 2, 'Le Dernier Algorithme', 'Marc Lenoir', 'J\'ai récemment découvert \'Le Dernier Algorithme\' et j\'ai été fasciné par son approche intelligente et moderne. Ce roman ne se contente pas de parler de technologie ; il interroge notre rapport au futur et à l\'inconnu.\r\n\r\nL\'écriture fluide et les idées percutantes captivent dès les premières pages, nous plongeant dans une intrigue aussi stimulante qu\'inquiétante.\r\n\r\nChaque passage pousse à réfléchir sur les conséquences de nos innovations.\r\n\r\n\'Le Dernier Algorithme\' est une lecture incontournable pour les passionnés de technologie et de thrillers contemporains.', 1, './../public/uploads/books/6a4b87e6af203.png', '2026-06-21 17:23:50', '2026-07-06 12:48:06'),
(7, 3, 'Voyage au-delà des dunes', 'Sofia Benali', 'J\'ai récemment exploré \'Voyage au-delà des dunes\' et j\'ai été transporté par la beauté de ce récit. Ce livre est bien plus qu\'une aventure ; il s\'agit d\'une véritable quête intérieure.\r\n\r\nLes paysages décrits avec finesse et les rencontres marquantes donnent vie à une histoire profondément humaine.\r\n\r\nChaque page invite à la contemplation et au lâcher-prise.\r\n\r\n\'Voyage au-delà des dunes\' est une œuvre inspirante qui touche par sa sincérité et sa poésie.', 0, './../public/uploads/books/livre7.png', '2026-06-21 17:23:50', '2026-06-21 17:38:30'),
(8, 4, 'Les Chroniques d’Etheris', 'Julien Morel', 'J\'ai récemment plongé dans \'Les Chroniques d’Etheris\' et j\'ai été séduit par l\'ampleur de cet univers. Ce livre propose une aventure riche où chaque personnage trouve sa place.\r\n\r\nL\'équilibre entre action et développement des personnages rend la lecture particulièrement engageante.\r\n\r\nChaque chapitre renforce l\'attachement aux héros et à leur destinée.\r\n\r\n\'Les Chroniques d’Etheris\' est un incontournable pour les amateurs de grandes sagas.', 1, './../public/uploads/books/livre8.png', '2026-06-21 17:23:50', '2026-06-21 17:38:40'),
(9, 1, 'Cuisine & Passions', 'Élodie Martin', 'J\'ai récemment feuilleté \'Cuisine & Passions\' et j\'ai été charmé par son authenticité. Ce livre célèbre le plaisir de cuisiner et de partager.\r\n\r\nLes recettes accessibles et les anecdotes personnelles créent une atmosphère chaleureuse et inspirante.\r\n\r\nChaque page donne envie de se mettre aux fourneaux et de partager un moment convivial.\r\n\r\n\'Cuisine & Passions\' est une belle invitation à savourer les plaisirs simples.', 1, './../public/uploads/books/livre9.png', '2026-06-21 17:23:50', '2026-06-21 17:38:46'),
(10, 2, 'La Ville Silencieuse', 'Antoine Girard', 'J\'ai récemment découvert \'La Ville Silencieuse\' et j\'ai été intrigué par son ambiance unique. Ce roman propose une immersion dans un monde déroutant et captivant.\r\n\r\nLe suspense est maintenu avec finesse, rendant chaque révélation encore plus marquante.\r\n\r\nChaque page renforce le mystère et l\'envie de comprendre.\r\n\r\n\'La Ville Silencieuse\' est une lecture idéale pour les amateurs d\'histoires énigmatiques.', 0, './../public/uploads/books/livre10.png', '2026-06-21 17:23:50', '2026-06-21 17:38:51'),
(11, 3, 'Étoiles et Cendres', 'Nina Laurent', 'J\'ai récemment lu \'Étoiles et Cendres\' et j\'ai été profondément touché par son intensité émotionnelle. Ce livre mêle habilement science-fiction et romance.\r\n\r\nLes personnages sont attachants et leurs parcours résonnent longtemps après la lecture.\r\n\r\nChaque chapitre est chargé d\'émotions et de réflexions.\r\n\r\n\'Étoiles et Cendres\' est une œuvre marquante et sensible.', 1, './../public/uploads/books/livre11.png', '2026-06-21 17:23:50', '2026-06-21 17:38:57'),
(12, 4, 'Le Jardin des Secrets', 'Camille Rousseau', 'J\'ai récemment exploré \'Le Jardin des Secrets\' et j\'ai été captivé par son atmosphère envoûtante. Ce roman dévoile progressivement une histoire pleine de mystères.\r\n\r\nLes descriptions délicates et le rythme posé créent une immersion totale.\r\n\r\nChaque page révèle un peu plus les secrets enfouis.\r\n\r\n\'Le Jardin des Secrets\' est une lecture aussi intrigante que poétique.', 0, './../public/uploads/books/livre12.png', '2026-06-21 17:23:50', '2026-06-21 17:39:07'),
(13, 1, 'Hackers & Révolutions', 'Thomas Leroy', 'J\'ai récemment découvert \'Hackers & Révolutions\' et j\'ai été impressionné par sa pertinence. Ce livre offre un regard fascinant sur le monde numérique.\r\n\r\nLes analyses et les récits s\'entrelacent pour donner une vision complète et captivante.\r\n\r\nChaque chapitre apporte une nouvelle perspective.\r\n\r\n\'Hackers & Révolutions\' est une lecture essentielle pour comprendre les enjeux actuels.', 1, './../public/uploads/books/livre13.png', '2026-06-21 17:23:50', '2026-06-21 17:39:18'),
(14, 2, 'L’Héritage des Brumes', 'Aurélien Dupuis', 'J\'ai récemment plongé dans \'L’Héritage des Brumes\' et j\'ai été emporté par son atmosphère mystérieuse. Ce roman mêle habilement héritage familial et éléments fantastiques.\r\n\r\nL\'intrigue se dévoile progressivement, maintenant un suspense constant.\r\n\r\nChaque page renforce le sentiment d\'immersion.\r\n\r\n\'L’Héritage des Brumes\' est une œuvre captivante et immersive.', 1, './../public/uploads/books/livre14.png', '2026-06-21 17:23:50', '2026-07-02 20:47:52');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `content` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `content`, `created_at`, `is_read`) VALUES
(1, 10, 13, 'Bonjour, premier message de test', '2026-07-08 16:38:02', 1),
(2, 13, 10, 'Bonjour, réponse de test au premier message de test', '2026-07-08 16:38:24', 1),
(3, 13, 10, 'test d\'envois de message', '2026-07-08 20:22:43', 1),
(4, 13, 10, 'test', '2026-07-08 20:25:22', 1),
(5, 13, 10, 'encore un test', '2026-07-08 20:26:09', 1),
(6, 10, 13, 'un test de plus', '2026-07-08 20:30:21', 1),
(7, 10, 2, 'test', '2026-07-09 11:16:00', 1),
(8, 10, 2, 'tes2', '2026-07-09 20:49:48', 1),
(9, 2, 10, 'retour de test', '2026-07-13 14:11:12', 1),
(10, 2, 10, 'test de message vraiment vraiment très long. Série de mots au hasard mis bout à bout', '2026-07-13 15:33:40', 1),
(11, 2, 4, 'test d\'envoi', '2026-07-13 16:37:06', 0),
(12, 4, 2, 'reponse du test', '2026-07-13 16:44:52', 1),
(13, 2, 10, 'nouveau test', '2026-07-14 10:51:19', 1),
(14, 13, 10, 'toujours plus de test', '2026-07-14 12:24:16', 1),
(15, 2, 1, 'test', '2026-07-14 12:39:01', 0),
(16, 2, 1, 'encore un test', '2026-07-14 13:16:32', 0),
(17, 10, 2, 'reponse', '2026-07-15 12:17:39', 1),
(18, 10, 13, 'Et encore un test', '2026-07-15 12:18:03', 0),
(19, 10, 1, 'nouveau message', '2026-07-15 12:18:24', 0),
(20, 10, 2, 'Nouveau message', '2026-07-15 14:51:35', 1),
(21, 10, 3, 'Premier message', '2026-07-15 14:53:18', 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nickname` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture_path` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `status` varchar(8) NOT NULL DEFAULT 'actif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nickname`, `email`, `password`, `profile_picture_path`, `created_at`, `updated_at`, `status`) VALUES
(1, 'CamilleClubLit', 'camilleClubLit@mail.com', '$2y$10$aFqAQbtktyvE70NDA7g2a.dLRqgKxXL6/iCGHscm2cx72tea5sFpi', 'uploads/users/6a57ac62de0018.24007414.jpg', '2026-06-13 10:58:13', '2026-07-15 17:50:58', 'actif'),
(2, 'Nathalie', 'nathalie@mail.com', '$2y$10$E99Ct.331W.n3oQprK5cZuz5SpkNtU6CXxmJR/s6Xkf7/RYcgdEcK', 'uploads/users/6a57ab33515cd5.87057834.jpg', '2026-06-19 10:37:52', '2026-07-15 17:46:12', 'actif'),
(3, 'Alexlecture', 'alexlecture@mail.com', '$2y$10$6RmLP2kXs7.xfZ8kKPxytu1WD8mSZQatCfiZOPg9N2E.CwdWSvqYS', 'uploads/users/6a57ac777a1c49.70903695.jpg', '2026-06-19 10:38:34', '2026-07-15 17:51:19', 'actif'),
(4, 'Hugo1990_12', 'hugo1990_12@mail.com', '$2y$10$WlmlEyzD4N7ecglRx3SCFOiZ0LAblcvAzyB1yjU0CyuzdmLYf8C2u', './../public/uploads/users/6a54f9d50cde32.73529140.jpg', '2026-06-19 10:38:57', '2026-07-13 16:44:37', 'actif'),
(10, 'PseudoTest', 'test@mail.com', '$2y$10$vMX3e483uUU/DTOhsLcGVOw8bSTGRwn5/eQzgaWGH2Zly0WiZNKca', './../public/uploads/users/6a575f9e8b2bc5.12772849.png', '2026-06-25 20:20:48', '2026-07-15 12:23:26', 'actif'),
(13, 'test2', 'test2@mail.com', '$2y$10$1jvO9uG5BOhy6fiwwRnf5eAO4NFFflkvvOUR6S1QRCCmKJnyjl/wO', './../public/uploads/users/6a560e43234434.14604902.png', '2026-07-08 16:35:23', '2026-07-14 12:24:03', 'actif');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
