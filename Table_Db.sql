-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 18 mars 2026 à 10:43
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
-- Base de données : `black_dodo`
--

-- --------------------------------------------------------

--
-- Structure de la table `achats`
--

CREATE TABLE `achats` (
                          `id` int(11) NOT NULL,
                          `utilisateur_id` int(11) NOT NULL,
                          `produit_id` int(11) NOT NULL,
                          `date_achat` datetime DEFAULT current_timestamp(),
                          `prix_paye` decimal(10,2) NOT NULL,
                          `methode_paiement` varchar(50) DEFAULT 'Carte Bancaire',
                          `transaction_id` varchar(100) DEFAULT NULL,
                          `statut` enum('en_attente','termine','echoue') DEFAULT 'termine',
                          `nom` varchar(255) DEFAULT NULL,
                          `prenom` varchar(255) DEFAULT NULL,
                          `carte_bleue` varchar(16) DEFAULT NULL,
                          `ccb` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `achats`
--

INSERT INTO `achats` (`id`, `utilisateur_id`, `produit_id`, `date_achat`, `prix_paye`, `methode_paiement`, `transaction_id`, `statut`, `nom`, `prenom`, `carte_bleue`, `ccb`) VALUES
                                                                                                                                                                                  (7, 1, 1, '2026-03-17 11:25:16', 5.00, 'Carte Bancaire', 'CUBIC-69B92C0CE8A32', 'termine', 'TWlLS2hOUzY3K2t6b1Bock5FTXAzUT09Ojr5PFVQ1x2p2KwlUjtiJXWa', 'ZUNEczJ1SFVhNTFzT3k3Nkt5MkVQUT09Ojo0Fu8LVkdBOFGT7AyeVdCh', 'V0JpcTZTZUF3c2lj', 'WXJK'),
                                                                                                                                                                                  (8, 1, 1, '2026-03-17 11:25:37', 5.00, 'Carte Bancaire', 'CUBIC-69B92C216CA65', 'termine', 'MW1YWHZtR3dGMXJ1eWdvUk84ZkJsQT09OjqBweXJuEtR7giGkgSE2WiC', 'Rm1YV0lNdE14RkN1cEwxU1VLckdFdz09OjqRIyil8XyTIW1XgiKsdQU0', 'Y25Sb3EzdlpuOE8v', 'OStk'),
                                                                                                                                                                                  (9, 1, 1, '2026-03-17 11:32:13', 5.00, 'Carte Bancaire', 'CUBIC-69B92DAD2A031', 'termine', 'TTJXRW5JZXBJZnVDVG1YUDZyVjJ2Zz09OjqVmm1lTTBxHSQGwEHaSxdT', 'b2xXVkhNTUtmbnI0MnZ0MnBWdUY0UT09OjoeGPjPzd65n98GpJXVlVaw', 'S0JOSzNPUHkxeU9T', 'UWEx'),
                                                                                                                                                                                  (10, 1, 1, '2026-03-17 11:33:28', 5.00, 'Carte Bancaire', 'CUBIC-69B92DF8303DA', 'termine', 'V3ZvZ0x4cHFkbjcyeDUrVlYzNmEwQT09OjpaNuHr2467zLJDbI82WTEv', 'c0U1SXdtdTRJOXFtc3R2NUJvdkh3QT09OjrVhffxA30MBJjzfBn+h51g', 'Ukh2RXlhckhINnBI', 'WEVW'),
                                                                                                                                                                                  (11, 1, 3, '2026-03-17 14:50:58', 2.00, 'Carte Bancaire', 'CUBIC-69B95C423793E', 'termine', 'TE5OdmV1dncvOE01YldEOVFtQUdEUT09OjrNEWDboiv/kNwtxvDx2hh1', 'MTQvaWlZakNLMVFIQ0xNaFJaV1dlQT09OjoaerA2+4bfrB87NtKIH4o7', 'VEl0NGFZZEthQXcz', 'ajM5'),
                                                                                                                                                                                  (12, 1, 3, '2026-03-17 14:50:58', 2.00, 'Carte Bancaire', 'CUBIC-69B95C423793E', 'termine', 'aDJ5enEzT1IxRDdNVjhyYVk0MUJyQT09OjrbZ2YOy2m37c4pnYIMnZnb', 'cUFZWklhYWRxcFhrMVliNTlUNVVIZz09OjoDMBYiaY41AgHtY8n54rQF', 'VjFGYW95T2lleERw', 'SEVE'),
                                                                                                                                                                                  (13, 1, 3, '2026-03-17 14:50:58', 2.00, 'Carte Bancaire', 'CUBIC-69B95C423793E', 'termine', 'SUxOZUlKUmVCRFM5cVlTWWNBTkpudz09Ojo96ZYZn1Zy6FoH65COOBcN', 'aGdkNkQrV0ROQ3FvZHNvR2VNS3FWdz09OjopZZtfgZGM3uFwN7kuGANc', 'Qjd1THdIQ2NsV2N5', 'eko5'),
                                                                                                                                                                                  (14, 1, 3, '2026-03-17 15:14:03', 2.00, 'Carte Bancaire', 'CUBIC-69B961AB676E3', 'termine', 'cVhuQ2ZtNGtTclBoSS9FTzlGeEFZUT09OjogbsGiv7rGXP/B7qHWCd3O', 'OFV1SjRiWkZxdHB0VmtMRmZDMWpwQT09Ojrfw73k3Ulrl8M7Rs1V3ZUR', 'SW5TNTJCV2lUK3JV', 'Rm1B'),
                                                                                                                                                                                  (15, 1, 7, '2026-03-17 15:14:03', 2.00, 'Carte Bancaire', 'CUBIC-69B961AB676E3', 'termine', 'WGlnRkhzcnN3aDJ3dFFFdUlpQzRjZz09Ojqs9j0LQ+wfI3EWtEBGH69O', 'dmZlNEZ1SEovT29FcmlVeVlBZ0dUQT09Ojo2R3DUVq4EiKBBl0taS6be', 'UlFvQWtuTGFZTE5j', 'OTBI'),
                                                                                                                                                                                  (16, 1, 3, '2026-03-17 15:23:04', 2.00, 'Carte Bancaire', 'CUBIC-69B963C8A7962', 'termine', 'TTFCcGw2VTFaQnU2dGh2aVVZRm5TZz09OjpsgwyaOiILvOhBmaBpDPCp', 'VGc0bHkzM2d4YzVqUHdqNWlDNU45Zz09Ojq8Zsdg3jJz1f76DSeBhBZO', 'YU1vNlZmbFdBVVY4', 'VUI1'),
                                                                                                                                                                                  (17, 1, 3, '2026-03-17 15:23:04', 2.00, 'Carte Bancaire', 'CUBIC-69B963C8A7962', 'termine', 'RCtEdHVKMy9ZOG1tK0ZOQTZDekxXZz09OjqmNEs3KoPLwDQFrvDyI/mk', 'NmxCQkFOTGhOeXBVTmhwQlA1bVJaUT09Ojqam0YKONNvfW+TC7ICG0Jq', 'VWprcFBURUtEMHdE', 'OGJu'),
                                                                                                                                                                                  (18, 1, 3, '2026-03-17 15:23:04', 2.00, 'Carte Bancaire', 'CUBIC-69B963C8A7962', 'termine', 'cG9Gb281Z3lGbFZsZndac2h0SGVJQT09OjqJUei1Q4onEJcq1uozHC3m', 'ajZSTDhVeHZmTWJ3NVhYTFpCOXNjdz09OjoCMKr0CYtcghIm6zK11Y02', 'LzJTdDhJd2pFNldJ', 'YWVk'),
                                                                                                                                                                                  (19, 1, 3, '2026-03-17 15:23:04', 2.00, 'Carte Bancaire', 'CUBIC-69B963C8A7962', 'termine', 'cnM0bTkwdDNCZjRyanZYNVFjMnZZUT09OjpLVsYLg6seQfrGPpg9kdUE', 'Zi9nYk9nMG5xVHE1Qms1OHNRbENDdz09OjrXDfd66fGGe8obFC9jfVI6', 'NzNFaVhVSlc5VVdI', 'WExF'),
                                                                                                                                                                                  (20, 1, 9, '2026-03-18 10:05:45', 4.99, 'Carte Bancaire', 'CUBIC-69BA6AE917B31', 'termine', 'S0NGYUJCeVE5VUh6KzJIa1p5b2JiQT09OjpmLBgxthSMWx3YR9p5iHLp', 'V3o1SEwxWldOangzTC9XKzBKT0tGZz09Ojq1XWTcqOuTbxB1WGBB7Qb1', 'VHc1MWpOTzV4TDFl', 'djVJ'),
                                                                                                                                                                                  (21, 1, 11, '2026-03-18 10:05:45', 20.99, 'Carte Bancaire', 'CUBIC-69BA6AE917B31', 'termine', 'Mi9BendmU0ZlVWl3dnZPNTBhRXhwdz09OjryQdbQP038LqrKK8V6KaNc', 'RXZKZVdNVk5oWjRqaDFzZCs5VHdWUT09Ojr0OWuynE2xPLq/orUt2GN6', 'R0YyMHFrRkMxQ2pH', 'MFVV'),
                                                                                                                                                                                  (22, 1, 11, '2026-03-18 10:06:11', 20.99, 'Carte Bancaire', 'CUBIC-69BA6B03A3286', 'termine', 'dHRhRWxkdmNZS2NwVUYxM0xYQTZyUT09OjoahKlMMtLzLZbAaqgMITxP', 'TURtUzJBOFJLdTU0NFhLMUJoMFJMdz09OjoFdB4x+wCouQQLdX8Exhwu', 'ZlppVkErNmRZS0tP', 'WXhL'),
                                                                                                                                                                                  (23, 1, 10, '2026-03-18 10:10:17', 9.99, 'Carte Bancaire', 'CUBIC-69BA6BF995A54', 'termine', 'SnRsaHVQbk5oejJOdXJscTdHVkoxdz09Ojp7ppaWAKu++knQ0LhQT/iM', 'TlMydzlsYStGcWU5STFWMzN5VHMxQT09OjobFC1ugQMIRrreZrkRyZaE', 'WC9WME9VRnZ1NWdj', 'aFZH');

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
                            `id` int(11) NOT NULL,
                            `titre` varchar(150) NOT NULL,
                            `contenu` text NOT NULL,
                            `image_article` varchar(255) DEFAULT NULL,
                            `utilisateurs_id` int(11) DEFAULT NULL,
                            `date_publication` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `titre`, `contenu`, `image_article`, `utilisateurs_id`, `date_publication`) VALUES
                                                                                                              (1, 'Ouverture du serveur Cubic', 'Le serveur ouvre officiellement cette semaine avec des nouveautés exclusives.', 'https://images.unsplash.com/photo-1627398242454-45a1465c2479?q=80&w=1000&auto=format&fit=crop', NULL, '2026-03-17 11:49:45'),
                                                                                                              (2, 'Tournoi PvP du week-end', 'Participez au tournoi PvP samedi soir et tentez de gagner des récompenses.', 'https://images.unsplash.com/photo-1511512578047-dfb367046420?q=80&w=1000&auto=format&fit=crop', NULL, '2026-03-17 11:49:45'),
                                                                                                              (3, 'Mise à jour Boutique', 'De nouveaux articles sont disponibles dans la boutique avec une promo de lancement.', 'https://images.unsplash.com/photo-1542751371-adc38448a05e?q=80&w=1000&auto=format&fit=crop', NULL, '2026-03-17 11:49:45');

-- --------------------------------------------------------

--
-- Structure de la table `categories_boutique`
--

CREATE TABLE `categories_boutique` (
                                       `id` int(11) NOT NULL,
                                       `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categories_boutique`
--

INSERT INTO `categories_boutique` (`id`, `nom`) VALUES
                                                    (1, 'vip'),
                                                    (2, 'non vip');

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
                             `id` int(11) NOT NULL,
                             `utilisateur_id` int(11) NOT NULL,
                             `total` decimal(10,2) NOT NULL,
                             `transaction_id` varchar(100) NOT NULL,
                             `statut` varchar(30) NOT NULL DEFAULT 'payee',
                             `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`id`, `utilisateur_id`, `total`, `transaction_id`, `statut`, `created_at`) VALUES
                                                                                                        (1, 1, 6.00, 'CUBIC-69B95C423793E', 'payee', '2026-03-17 14:50:58'),
                                                                                                        (2, 1, 4.00, 'CUBIC-69B961AB676E3', 'payee', '2026-03-17 15:14:03'),
                                                                                                        (3, 1, 8.00, 'CUBIC-69B963C8A7962', 'payee', '2026-03-17 15:23:04'),
                                                                                                        (4, 1, 25.98, 'CUBIC-69BA6AE917B31', 'payee', '2026-03-18 10:05:45'),
                                                                                                        (5, 1, 20.99, 'CUBIC-69BA6B03A3286', 'payee', '2026-03-18 10:06:11'),
                                                                                                        (6, 1, 9.99, 'CUBIC-69BA6BF995A54', 'payee', '2026-03-18 10:10:17');

-- --------------------------------------------------------

--
-- Structure de la table `commande_items`
--

CREATE TABLE `commande_items` (
                                  `id` int(11) NOT NULL,
                                  `commande_id` int(11) NOT NULL,
                                  `produit_id` int(11) NOT NULL,
                                  `nom_produit` varchar(255) NOT NULL,
                                  `prix_unitaire` decimal(10,2) NOT NULL,
                                  `quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commande_items`
--

INSERT INTO `commande_items` (`id`, `commande_id`, `produit_id`, `nom_produit`, `prix_unitaire`, `quantite`) VALUES
                                                                                                                 (1, 1, 3, 'Boisson', 2.00, 3),
                                                                                                                 (2, 2, 3, 'Boisson', 2.00, 1),
                                                                                                                 (3, 2, 7, 'Boisson', 2.00, 1),
                                                                                                                 (4, 3, 3, 'Boisson', 2.00, 4),
                                                                                                                 (5, 4, 9, 'Grade VIP Bronze', 4.99, 1),
                                                                                                                 (6, 4, 11, 'Pack Skin', 20.99, 1),
                                                                                                                 (7, 5, 11, 'Pack Skin', 20.99, 1),
                                                                                                                 (8, 6, 10, 'Grade VIP Silver', 9.99, 1);

-- --------------------------------------------------------

--
-- Structure de la table `paniers`
--

CREATE TABLE `paniers` (
                           `id` int(11) NOT NULL,
                           `utilisateur_id` int(11) NOT NULL,
                           `total` decimal(10,2) NOT NULL DEFAULT 0.00,
                           `date_creation` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `panier_items`
--

CREATE TABLE `panier_items` (
                                `id` int(11) NOT NULL,
                                `panier_id` int(11) NOT NULL,
                                `produit_id` int(11) NOT NULL,
                                `quantite` int(11) NOT NULL DEFAULT 1,
                                `prix_unitaire` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
                            `id` int(11) NOT NULL,
                            `nom` varchar(100) NOT NULL,
                            `description` text DEFAULT NULL,
                            `prix` decimal(10,2) NOT NULL,
                            `categorie_id` int(11) DEFAULT NULL,
                            `image_produit` varchar(255) DEFAULT 'default_item.png',
                            `categorie` varchar(100) DEFAULT 'Divers',
                            `image_url` text DEFAULT NULL,
                            `actif` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `nom`, `description`, `prix`, `categorie_id`, `image_produit`, `categorie`, `image_url`, `actif`) VALUES
                                                                                                                                    (1, 'Cacahuètes', 'Sachet premium', 5.00, 1, 'default_item.png', 'Divers', 'images/boutique/pika.png', 1),
                                                                                                                                    (3, 'Boisson', 'Canette fraîche', 2.00, 1, 'default_item.png', 'Divers', NULL, 1),
                                                                                                                                    (7, 'Boisson', 'Canette fraîche', 2.00, 1, 'default_item.png', 'Divers', NULL, 1),
                                                                                                                                    (9, 'Grade VIP Bronze', NULL, 4.99, NULL, 'default_item.png', 'Grades VIP', 'images/boutique/bronze_vip_mnthly_icon.png', 1),
                                                                                                                                    (10, 'Grade VIP Silver', NULL, 9.99, NULL, 'default_item.png', 'Grades VIP', 'images/boutique/silver_vip_mnthly_icon.png', 1),
                                                                                                                                    (11, 'Pack Skin', NULL, 20.99, NULL, 'default_item.png', 'Cosmétiques', 'images/boutique/Minecraft.jpg', 1),
                                                                                                                                    (12, 'Pack 1 000 HihiherCoins', NULL, 8.99, NULL, 'default_item.png', 'Monnaie virtuelle', 'images/boutique/coin.jfif', 1);

-- --------------------------------------------------------

--
-- Structure de la table `sanctions`
--

CREATE TABLE `sanctions` (
                             `id` int(11) NOT NULL,
                             `utilisateur_id` int(11) NOT NULL,
                             `type` enum('avertissement','bannissement') NOT NULL,
                             `raison` text NOT NULL,
                             `date_sanction` datetime DEFAULT current_timestamp(),
                             `est_actif` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
                                `id` int(11) NOT NULL,
                                `username` varchar(50) NOT NULL,
                                `email` varchar(100) NOT NULL,
                                `password` varchar(255) NOT NULL,
                                `role` enum('joueur','moderateur','administrateur') DEFAULT 'joueur',
                                `description_profil` text DEFAULT NULL,
                                `date_inscription` datetime DEFAULT current_timestamp(),
                                `avatar` varchar(255) DEFAULT 'uploads/avatars/default.png',
                                `discord_id` varchar(100) DEFAULT NULL,
                                `twitter_handle` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `username`, `email`, `password`, `role`, `description_profil`, `date_inscription`, `avatar`, `discord_id`, `twitter_handle`) VALUES
    (1, 'ezreal', 'etze@gmail.com', '$2y$10$HR5bawKOnhvvAIxn3Stryuf3AFH6tkHpNS2UZ4lJE1Cs7vESeRa4W', 'joueur', 'zeazeazea', '2026-03-17 11:20:13', 'uploads/avatars/avatar_1_1773747470.png', 'dsqdsqd', 'sdqdsqdqsd');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `achats`
--
ALTER TABLE `achats`
    ADD PRIMARY KEY (`id`),
    ADD KEY `fk_achat_joueur` (`utilisateur_id`),
    ADD KEY `fk_achat_item` (`produit_id`);

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
    ADD PRIMARY KEY (`id`),
    ADD KEY `fk_news_auteur` (`utilisateurs_id`);

--
-- Index pour la table `categories_boutique`
--
ALTER TABLE `categories_boutique`
    ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
    ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commande_items`
--
ALTER TABLE `commande_items`
    ADD PRIMARY KEY (`id`);

--
-- Index pour la table `paniers`
--
ALTER TABLE `paniers`
    ADD PRIMARY KEY (`id`);

--
-- Index pour la table `panier_items`
--
ALTER TABLE `panier_items`
    ADD PRIMARY KEY (`id`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
    ADD PRIMARY KEY (`id`),
    ADD KEY `fk_produit_categorie` (`categorie_id`);

--
-- Index pour la table `sanctions`
--
ALTER TABLE `sanctions`
    ADD PRIMARY KEY (`id`),
    ADD KEY `fk_sanction_joueur` (`utilisateur_id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `username` (`username`),
    ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `achats`
--
ALTER TABLE `achats`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `categories_boutique`
--
ALTER TABLE `categories_boutique`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `commande_items`
--
ALTER TABLE `commande_items`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `paniers`
--
ALTER TABLE `paniers`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `panier_items`
--
ALTER TABLE `panier_items`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `sanctions`
--
ALTER TABLE `sanctions`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `achats`
--
ALTER TABLE `achats`
    ADD CONSTRAINT `fk_achat_item` FOREIGN KEY (`produit_id`) REFERENCES `produits` (`id`),
    ADD CONSTRAINT `fk_achat_joueur` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `articles`
--
ALTER TABLE `articles`
    ADD CONSTRAINT `fk_news_auteur` FOREIGN KEY (`utilisateurs_id`) REFERENCES `utilisateurs` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
    ADD CONSTRAINT `fk_produit_categorie` FOREIGN KEY (`categorie_id`) REFERENCES `categories_boutique` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `sanctions`
--
ALTER TABLE `sanctions`
    ADD CONSTRAINT `fk_sanction_joueur` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;