

CREATE TABLE `equipe` (
  `nom_equipe` varchar(255) NOT NULL,
  `description_equipe` text DEFAULT NULL,
  `date_creation_equipe` date DEFAULT NULL,
  `responsable_equipe` int(11) DEFAULT NULL,
  `id_equipe` int(11) NOT NULL,
  `id_projet` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `equipe` (`nom_equipe`, `description_equipe`, `date_creation_equipe`, `responsable_equipe`, `id_equipe`, `id_projet`) VALUES
('ff', 'ff', '2023-11-23', 49, 3, NULL);


CREATE TABLE `projets` (
  `id_projet` int(11) NOT NULL,
  `nom_projet` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `statut` varchar(50) DEFAULT NULL,
  `scrum_master` int(11) DEFAULT NULL,
  `equipe_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `projets` (`id_projet`, `nom_projet`, `description`, `date_debut`, `date_fin`, `statut`, `scrum_master`, `equipe_id`) VALUES
(18, 'dataware1', 'kjhugyjf', '2023-12-06', '2023-12-10', 'en_cours', 76, NULL);



CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','product_owner','scrum_master') NOT NULL DEFAULT 'user',
  `nom_equipe` varchar(50) DEFAULT NULL,
  `id_equipe` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `users` (`id_user`, `nom`, `prenom`, `email`, `password`, `role`, `nom_equipe`, `id_equipe`) VALUES
(49, 'ayoub', 'MOHAMMED', 'moBBhammedfytahi567@gmail.com', 'moha', 'scrum_master', 'ff', 3),
(66, '342', '\"é\"', 'rafiqmokhlis12@gma', 'LZJEFIL', 'user', 'ff', 3),
(74, 'FYTAHI', 'MOHAMMED', 'mohammed01fytahi@gmail.com', 'jhkhouoiu', 'product_owner', 'ff', 3),
(76, 'FYTAHI', 'moha', 'mohammed01fytjksahi@gmail.com', '123456789', 'scrum_master', NULL, NULL),
(78, 'Rachid', 'Rachid', 'rafiqmokhlis1zjkdh2@gmail.com', '87654321', 'user', 'ff', 3);


ALTER TABLE `equipe`
  ADD PRIMARY KEY (`id_equipe`),
  ADD KEY `responsable_equipe` (`responsable_equipe`),
  ADD KEY `fk_projet` (`id_projet`);


ALTER TABLE `projets`
  ADD PRIMARY KEY (`id_projet`),
  ADD KEY `scrum_master` (`scrum_master`),
  ADD KEY `projets_ibfk_2` (`equipe_id`);

dex pour la table `users`

ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_user_equipe` (`id_equipe`);



ALTER TABLE `equipe`
  MODIFY `id_equipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;


ALTER TABLE `projets`
  MODIFY `id_projet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;


ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;


ALTER TABLE `equipe`
  ADD CONSTRAINT `equipe_ibfk_1` FOREIGN KEY (`responsable_equipe`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `fk_projet` FOREIGN KEY (`id_projet`) REFERENCES `projets` (`id_projet`) ON DELETE SET NULL;

--
-- Contraintes pour la table `projets`
--
ALTER TABLE `projets`
  ADD CONSTRAINT `projets_ibfk_1` FOREIGN KEY (`scrum_master`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `projets_ibfk_2` FOREIGN KEY (`equipe_id`) REFERENCES `equipe` (`id_equipe`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_user_equipe` FOREIGN KEY (`id_equipe`) REFERENCES `equipe` (`id_equipe`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
