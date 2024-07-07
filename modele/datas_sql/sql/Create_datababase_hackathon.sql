DROP DATABASE if exists u715474161_Sonia; -- à ne faire qu'avec une BD de jeu de tests
CREATE DATABASE u715474161_Sonia;
USE u715474161_Sonia;

CREATE TABLE `administrateurs` (
  `idAdministrateur` int(11) NOT NULL,
  `loginAdministrateur` varchar(30) NOT NULL,
  `passwordAdministrateur` varchar(30) NOT NULL,
  `nomAdministrateur` varchar(30) NOT NULL,
  `prenomAdministrateur` varchar(30) DEFAULT NULL,
  `mailAdministrateur` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `administrateurs`
--

INSERT INTO `administrateurs` (`idAdministrateur`, `loginAdministrateur`, `passwordAdministrateur`, `nomAdministrateur`, `prenomAdministrateur`, `mailAdministrateur`) VALUES
(1, 'root', 'root', 'nom_root_admin', 'prenom_root_admin', 'nom_root_admin@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `equipes`
--

CREATE TABLE `equipes` (
  `idEquipe` int(11) NOT NULL,
  `nomEquipe` varchar(20) NOT NULL,
  `lienProjetEquipe` varchar(20) DEFAULT NULL,
  `noteProjetEquipe` int(11) DEFAULT NULL,
  `classementEquipe` int(11) DEFAULT NULL,
  `idParticipantChef` int(11) NOT NULL,
  `idProjet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `hackathons`
--

CREATE TABLE `hackathons` (
  `idHackathon` int(11) NOT NULL,
  `nomHackathon` varchar(30) NOT NULL,
  `dateDebutHackathon` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE IF NOT EXISTS login_history (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    login_time DATETIME NOT NULL,
    ip_address VARCHAR(45) NOT NULL,
    user_agent TEXT NOT NULL,
    location VARCHAR(255)
);
--
-- Déchargement des données de la table `hackathons`
--

INSERT INTO `hackathons` (`idHackathon`, `nomHackathon`, `dateDebutHackathon`) VALUES
(1, 'hackathon_2023_1', '2023-06-01 09:00:00'),
(2, 'hackathon_2023_2', '2023-10-01 09:00:00'),
(3, 'hackathon_2023_3', '2025-06-01 09:00:00'),
(4, 'hackathon_2023_4', '2024-06-01 09:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `jurys`
--

CREATE TABLE `jurys` (
  `idJury` int(11) NOT NULL,
  `loginJury` varchar(30) DEFAULT NULL,
  `passwordJury` varchar(30) DEFAULT NULL,
  `nomJury` varchar(30) NOT NULL,
  `prenomJury` varchar(30) NOT NULL,
  `mailJury` varchar(30) DEFAULT NULL,
  `telephoneJury` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `jurys`
--

INSERT INTO `jurys` (`idJury`, `loginJury`, `passwordJury`, `nomJury`, `prenomJury`, `mailJury`, `telephoneJury`) VALUES
(1, 'jury1', 'root', 'jury_toto', 'p1', 'toto@gmail.com', '0607080910'),
(2, 'jury2', 'root', 'jury_tata', 'p2', 'tata@gmail.com', NULL),
(3, 'jurry3', 'root', 'jury_titi', 'p1', 'titi@gmail.com', NULL),
(4, 'root', 'root', 'nom_root_jury', 'prenom_root_jury', 'nom_root_jury@gmail.com', NULL),
(5, 'jury4', 'root', 'jury-lolo', '', NULL, NULL),
(10, 'test', 'test', 'test', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `jurysequipes`
--

CREATE TABLE `jurysequipes` (
  `idJury` int(11) NOT NULL,
  `idEquipe` int(11) NOT NULL,
  `note` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `juryshackathons`
--

CREATE TABLE `juryshackathons` (
  `idJury` int(11) NOT NULL,
  `idHackathon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `juryshackathons`
--

INSERT INTO `juryshackathons` (`idJury`, `idHackathon`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 1),
(3, 2),
(10, 4);

-- --------------------------------------------------------

--
-- Structure de la table `participants`
--

CREATE TABLE `participants` (
  `idParticipant` int(11) NOT NULL,
  `loginParticipant` varchar(30) NOT NULL,
  `passwordParticipant` varchar(30) NOT NULL,
  `nomParticipant` varchar(30) NOT NULL,
  `prenomParticipant` varchar(30) NOT NULL,
  `mailParticipant` varchar(30) NOT NULL,
  `telephoneParticipant` varchar(10) DEFAULT NULL,
  `dateDeNaissanceParticipant` date DEFAULT NULL,
  `lienPorteFolioParticipant` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `participants`
--

INSERT INTO `participants` (`idParticipant`, `loginParticipant`, `passwordParticipant`, `nomParticipant`, `prenomParticipant`, `mailParticipant`, `telephoneParticipant`, `dateDeNaissanceParticipant`, `lienPorteFolioParticipant`) VALUES
(1, 'root', 'root', 'nom_root_participant', 'prenom_root_participant', 'nom_root_participant@gmail.com', NULL, NULL, NULL),
(2, 'Kiko', 'root', 'Kiko', 'Bouh', 'mariam.bouhassoune40@gmail.com', NULL, NULL, NULL),
(3, 'Alan', 'azerty', 'Bajoc', 'Alan', 'sdfsfd@gmail.com', NULL, NULL, NULL),
(5, 'Momo', '123', 'Momo', 'Momo', 'dtrzarezdtezrdgftsrd', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `participantsequipes`
--

CREATE TABLE `participantsequipes` (
  `idParticipant` int(11) NOT NULL,
  `idEquipe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `participantshackathons`
--

CREATE TABLE `participantshackathons` (
  `idParticipant` int(11) NOT NULL,
  `idHackathon` int(11) NOT NULL,
  `idRelatifParticipantHackathon` int(11) NOT NULL,
  `dateInscriptionParticipantHackathon` datetime NOT NULL,
  `competenceParticipantHackathon` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `participantshackathons`
--

INSERT INTO `participantshackathons` (`idParticipant`, `idHackathon`, `idRelatifParticipantHackathon`, `dateInscriptionParticipantHackathon`, `competenceParticipantHackathon`) VALUES
(1, 3, 0, '2024-04-07 20:24:07', NULL),
(3, 3, 0, '2024-06-05 16:34:51', NULL),
(1, 4, 0, '2024-04-07 20:24:02', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `projets`
--

CREATE TABLE `projets` (
  `idProjet` int(11) NOT NULL,
  `nomProjet` varchar(20) NOT NULL,
  `descriptionProjet` text NOT NULL,
  `pdfProjet` varchar(100) DEFAULT NULL,
  `retenuProjet` tinyint(1) NOT NULL DEFAULT 0,
  `idHackathon` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `projets`
--

INSERT INTO `projets` (`idProjet`, `nomProjet`, `descriptionProjet`, `pdfProjet`, `retenuProjet`, `idHackathon`) VALUES
(1, 'projet 1', 'super projet 1', 'projet_1.pdf', 1, 1),
(2, 'projet 2', 'super projet 2', 'projet_2.pdf', 1, 1),
(3, 'projet 3', 'super projet 3', 'projet_3.pdf', 1, 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `administrateurs`
--
ALTER TABLE `administrateurs`
  ADD PRIMARY KEY (`idAdministrateur`),
  ADD UNIQUE KEY `loginAdministrateur` (`loginAdministrateur`),
  ADD UNIQUE KEY `mailAdministrateur` (`mailAdministrateur`);

--
-- Index pour la table `equipes`
--
ALTER TABLE `equipes`
  ADD PRIMARY KEY (`idEquipe`),
  ADD KEY `idProjet` (`idProjet`),
  ADD KEY `idParticipantChef` (`idParticipantChef`);

--
-- Index pour la table `hackathons`
--
ALTER TABLE `hackathons`
  ADD PRIMARY KEY (`idHackathon`);

--
-- Index pour la table `jurys`
--
ALTER TABLE `jurys`
  ADD PRIMARY KEY (`idJury`),
  ADD UNIQUE KEY `loginJury` (`loginJury`),
  ADD UNIQUE KEY `mailJury` (`mailJury`);

--
-- Index pour la table `jurysequipes`
--
ALTER TABLE `jurysequipes`
  ADD PRIMARY KEY (`idJury`,`idEquipe`),
  ADD KEY `idEquipe` (`idEquipe`);

--
-- Index pour la table `juryshackathons`
--
ALTER TABLE `juryshackathons`
  ADD PRIMARY KEY (`idJury`,`idHackathon`),
  ADD KEY `idHackathon` (`idHackathon`);

--
-- Index pour la table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`idParticipant`),
  ADD UNIQUE KEY `loginParticipant` (`loginParticipant`),
  ADD UNIQUE KEY `mailParticipant` (`mailParticipant`);

--
-- Index pour la table `participantsequipes`
--
ALTER TABLE `participantsequipes`
  ADD PRIMARY KEY (`idParticipant`,`idEquipe`),
  ADD KEY `idEquipe` (`idEquipe`);

--
-- Index pour la table `participantshackathons`
--
ALTER TABLE `participantshackathons`
  ADD PRIMARY KEY (`idHackathon`,`idParticipant`),
  ADD KEY `idParticipant` (`idParticipant`);

--
-- Index pour la table `projets`
--
ALTER TABLE `projets`
  ADD PRIMARY KEY (`idProjet`),
  ADD KEY `idHackathon` (`idHackathon`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `administrateurs`
--
ALTER TABLE `administrateurs`
  MODIFY `idAdministrateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `equipes`
--
ALTER TABLE `equipes`
  MODIFY `idEquipe` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `hackathons`
--
ALTER TABLE `hackathons`
  MODIFY `idHackathon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `jurys`
--
ALTER TABLE `jurys`
  MODIFY `idJury` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `participants`
--
ALTER TABLE `participants`
  MODIFY `idParticipant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `projets`
--
ALTER TABLE `projets`
  MODIFY `idProjet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `equipes`
--
ALTER TABLE `equipes`
  ADD CONSTRAINT `equipes_ibfk_1` FOREIGN KEY (`idProjet`) REFERENCES `projets` (`idProjet`),
  ADD CONSTRAINT `equipes_ibfk_2` FOREIGN KEY (`idParticipantChef`) REFERENCES `participants` (`idParticipant`);

--
-- Contraintes pour la table `jurysequipes`
--
ALTER TABLE `jurysequipes`
  ADD CONSTRAINT `jurysequipes_ibfk_1` FOREIGN KEY (`idJury`) REFERENCES `jurys` (`idJury`),
  ADD CONSTRAINT `jurysequipes_ibfk_2` FOREIGN KEY (`idEquipe`) REFERENCES `equipes` (`idEquipe`);

--
-- Contraintes pour la table `juryshackathons`
--
ALTER TABLE `juryshackathons`
  ADD CONSTRAINT `juryshackathons_ibfk_1` FOREIGN KEY (`idJury`) REFERENCES `jurys` (`idJury`),
  ADD CONSTRAINT `juryshackathons_ibfk_2` FOREIGN KEY (`idHackathon`) REFERENCES `hackathons` (`idHackathon`);

--
-- Contraintes pour la table `participantsequipes`
--
ALTER TABLE `participantsequipes`
  ADD CONSTRAINT `participantsequipes_ibfk_1` FOREIGN KEY (`idParticipant`) REFERENCES `participants` (`idParticipant`),
  ADD CONSTRAINT `participantsequipes_ibfk_2` FOREIGN KEY (`idEquipe`) REFERENCES `equipes` (`idEquipe`);

--
-- Contraintes pour la table `participantshackathons`
--
ALTER TABLE `participantshackathons`
  ADD CONSTRAINT `participantshackathons_ibfk_1` FOREIGN KEY (`idParticipant`) REFERENCES `participants` (`idParticipant`),
  ADD CONSTRAINT `participantshackathons_ibfk_2` FOREIGN KEY (`idHackathon`) REFERENCES `hackathons` (`idHackathon`);

--
-- Contraintes pour la table `projets`
--
ALTER TABLE `projets`
  ADD CONSTRAINT `projets_ibfk_1` FOREIGN KEY (`idHackathon`) REFERENCES `hackathons` (`idHackathon`);