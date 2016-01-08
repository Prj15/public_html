-- phpMyAdmin SQL Dump
-- version 4.2.12
-- http://www.phpmyadmin.net
--
-- Client :  mysql
-- Généré le :  Ven 08 Janvier 2016 à 15:06
-- Version du serveur :  5.5.32-MariaDB
-- Version de PHP :  5.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `infs3_prj15`
--

-- --------------------------------------------------------

--
-- Structure de la table `arbitre`
--

CREATE TABLE IF NOT EXISTS `arbitre` (
  `numArbitre` int(11) NOT NULL,
`idPers` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `idCtg` int(11) NOT NULL,
  `idNiveau` int(11) NOT NULL,
  `nomCtg` varchar(30) CHARACTER SET utf8 NOT NULL,
  `urlCtg` longtext CHARACTER SET utf8
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`idCtg`, `idNiveau`, `nomCtg`, `urlCtg`) VALUES
(1, 1, 'Accueil', '    <p> \r\nFerrars all spirits his imagine effects amongst neither. It bachelor cheerful of mistaken. Tore has sons put upon wife use bred seen. Its dissimilar invitation ten has discretion unreserved. Had you him humoured jointure ask expenses learning. Blush on in jokes sense do do. Brother hundred he assured reached on up no. On am nearer missed lovers. To it mother extent temper figure better.\r\nFerrars all spirits his imagine effects amongst neither. It bachelor cheerful of mistaken. Tore has sons put upon wife use bred seen. Its dissimilar invitation ten has discretion unreserved. Had you him humoured jointure ask expenses learning. Blush on in jokes sense do do. Brother hundred he assured reached on up no. On am nearer missed lovers. To it mother extent temper figure better. \r\n    </p>\r\n    <p> \r\nFerrars all spirits his imagine effects amongst neither. It bachelor cheerful of mistaken. Tore has sons put upon wife use bred seen. Its dissimilar invitation ten has discretion unreserved. Had you him humoured jointure ask expenses learning. Blush on in jokes sense do do. Brother hundred he assured reached on up no. On am nearer missed lovers. To it mother extent temper figure better.\r\nFerrars all spirits his imagine effects amongst neither. It bachelor cheerful of mistaken. Tore has sons put upon wife use bred seen. Its dissimilar invitation ten has discretion unreserved. Had you him humoured jointure ask expenses learning. Blush on in jokes sense do do. Brother hundred he assured reached on up no. On am nearer missed lovers. To it mother extent temper figure better. \r\n    </p> '),
(2, 1, 'L''ASSBC', '<p> ASSBC </p>'),
(3, 1, 'Equipes', '<p> Equipes </p>'),
(4, 1, 'Classement et Résultats', '<p> Classement et Résultats </p>'),
(5, 1, 'Photos', '<p>Photos</p>'),
(6, 1, 'La salle', '<p>La salle </p>'),
(7, 2, 'Documents', '<p>Documents</p>'),
(8, 1, 'Evénements', '<p>Evenemnts</p>'),
(9, 1, 'Partenaires', '<p>Partenaires</p>'),
(10, 3, 'Administration', '<p>Administration</p>'),
(11, 1, 'Contact', '<p>Contact</p>');

-- --------------------------------------------------------

--
-- Structure de la table `championnat`
--

CREATE TABLE IF NOT EXISTS `championnat` (
`idChampionnat` int(11) NOT NULL,
  `nomChampionnat` varchar(40) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `championnat`
--

INSERT INTO `championnat` (`idChampionnat`, `nomChampionnat`) VALUES
(1, 'Pré-National Masculin'),
(2, 'Pré-National Féminin'),
(3, 'Départemental Excellence Masculin'),
(4, 'Départemental Excellence Féminin'),
(5, 'U17 Honneur Masculin'),
(6, 'U15 Honneur Masculin'),
(7, 'U11 Mixte');

-- --------------------------------------------------------

--
-- Structure de la table `equipe`
--

CREATE TABLE IF NOT EXISTS `equipe` (
`idEquipe` int(11) NOT NULL,
  `idChampionnat` int(11) NOT NULL,
  `nomEquipe` varchar(15) CHARACTER SET utf8 NOT NULL,
  `idMenu` int(11) NOT NULL,
  `photoEq` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `equipe`
--

INSERT INTO `equipe` (`idEquipe`, `idChampionnat`, `nomEquipe`, `idMenu`, `photoEq`) VALUES
(1, 1, 'Senior 1', 5, 'img/equipes/senior1.jpg'),
(2, 2, 'Seniores 1', 6, ''),
(3, 3, 'Senior 2', 7, ''),
(4, 4, 'Seniores 2', 8, '');

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE IF NOT EXISTS `evenement` (
  `idEvenement` int(11) NOT NULL,
  `idTypeEvenement` int(11) NOT NULL,
  `dateEvenement` date NOT NULL,
  `libEvenement` varchar(20) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `evenement`
--

INSERT INTO `evenement` (`idEvenement`, `idTypeEvenement`, `dateEvenement`, `libEvenement`) VALUES
(1, 1, '2015-10-27', 'soirée de bienvenue');

-- --------------------------------------------------------

--
-- Structure de la table `joueur`
--

CREATE TABLE IF NOT EXISTS `joueur` (
  `idJoueur` int(11) NOT NULL,
  `nomJoueur` varchar(30) NOT NULL,
  `pnomJoueur` varchar(30) NOT NULL,
  `idEquipe` int(11) NOT NULL,
  `dateNaissance` date DEFAULT NULL,
  `poste` varchar(20) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `poids` int(11) DEFAULT NULL,
  `taille` int(11) DEFAULT NULL,
  `photoid` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `joueur`
--

INSERT INTO `joueur` (`idJoueur`, `nomJoueur`, `pnomJoueur`, `idEquipe`, `dateNaissance`, `poste`, `numero`, `poids`, `taille`, `photoid`) VALUES
(1, 'Camus', 'Nicolas', 1, NULL, NULL, 8, NULL, NULL, 'img/joueurs/nicolascamus.jpg'),
(2, 'Child', 'Guillaume', 1, '1982-12-04', 'Meneur', 5, NULL, NULL, 'img/joueurs/guillaumechild.jpg'),
(3, 'Laplaige', 'Julien', 1, NULL, NULL, 4, NULL, NULL, 'img/joueurs/julienlaplaige.jpg'),
(4, 'Legros', 'Willy', 1, NULL, NULL, NULL, NULL, NULL, 'img/joueurs/willylegros.jpg'),
(5, 'Marchal', 'Benjamin', 1, '1983-05-28', 'Aillier', 7, NULL, 179, 'img/joueurs/benjaminmarchal.jpg'),
(6, 'Peru', 'Aurélien', 1, NULL, NULL, 15, NULL, NULL, 'img/joueurs/aurelienperu.jpg'),
(7, 'Teixeira', 'David', 1, NULL, NULL, NULL, NULL, NULL, 'img/joueurs/davidteixeira.jpg'),
(8, 'Tixier', 'Mike', 1, NULL, NULL, 14, NULL, NULL, NULL),
(9, 'Koffi', 'Essuih', 1, NULL, NULL, 12, NULL, NULL, NULL),
(10, 'Fagnon', 'Alexandra', 2, NULL, NULL, 9, NULL, NULL, NULL),
(11, 'Ratibi', 'Anissa', 2, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'Fasquel', 'Quentin', 3, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'Edwige', 'Stéphane', 3, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'Marchal', 'Léo', 3, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'Janniot', 'Claire', 2, NULL, '5', NULL, NULL, NULL, NULL),
(13, 'Stoclin Ecart', 'Clémence', 2, NULL, NULL, 10, NULL, NULL, NULL),
(14, 'Blaise', 'Julie', 2, NULL, NULL, 6, NULL, NULL, NULL),
(23, 'Cordier', 'Vincent', 3, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 'Thiriat', 'Julien', 3, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 'Giacomelli', 'Antoine', 3, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 'Picard', 'Florian', 3, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'Soares', 'Laëtitia', 2, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'Decrame', 'Marion', 2, NULL, NULL, 14, NULL, NULL, NULL),
(27, 'Lamblot', 'Pierre', 3, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 'Deguerne', 'Etienne', 3, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 'Damien', 'Vincent', 3, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 'Paradis', 'Grégory', 3, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'Maissin', 'Pauline', 2, NULL, NULL, 8, NULL, NULL, NULL),
(18, 'Mika', 'Pauline', 2, NULL, NULL, 4, NULL, NULL, NULL),
(19, 'Defaucheux', 'Virginie', 2, NULL, NULL, 11, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `match`
--

CREATE TABLE IF NOT EXISTS `match` (
  `idMatch` int(10) NOT NULL,
  `idEquipeDom` int(10) NOT NULL,
  `idSalle` int(10) NOT NULL,
  `idSaison` int(10) NOT NULL,
  `dateMatch` date NOT NULL,
  `noJournee` int(10) NOT NULL,
  `idPers` int(10) NOT NULL,
  `idEquipeVisiteur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `idMenu` int(11) NOT NULL,
  `nomMenu` varchar(50) CHARACTER SET utf8 NOT NULL,
  `urlMenu` longtext CHARACTER SET utf8,
  `idCtg` int(11) NOT NULL,
  `idNiveau` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `menu`
--

INSERT INTO `menu` (`idMenu`, `nomMenu`, `urlMenu`, `idCtg`, `idNiveau`) VALUES
(1, 'Organigramme', '<p>A l''issue de l''AG du 26 mai 2013, un nouveau bureau a été désigné.</p>\r\n<p>Voici le bureau de l''ASSBC Basket pour la saison 2013-2014 : </p>\r\n<p><span>Présidente</span> : Pauline MAISSIN</p>\r\n<p><span>Vice-présidente</span> : Dolyne GRONDIN</p>\r\n<p><span>Secrétaire</span> : Alexandra FAGNON</p>\r\n<p><span>Secrétaire adjointe</span> : Virginie DEFAUCHEUX (responsable licences)</p>\r\n<p><span>Trésorier</span> : Julien LAPLAIGE</p>\r\n<ul>\r\n	<li><span>Membres actifs</span> : Estelle CASANOVA</li>\r\n	<li>David TEIXEIRA</li>\r\n	<li>Guillaume CHILD</li>\r\n</ul>', 2, 1),
(2, 'Comptes Rendus', '<p> Comptes Rendus </p>', 2, 2),
(3, 'Un peu d''histoire ...', '<p>La première association <span style = "text-decoration : underline; font-weight : bold;">ASSBC</span> (<span style = "font-weight : bold;">A</span>ssociation <span style = "font-weight : bold;">S</span>portive <span style = "font-weight : bold;">S</span>aint <span style = "font-weight : bold;">B</span>rice <span style = "font-weight : bold;">C</span>ourcelles) a été déclarée en 1976 à la Préfecture de la Marne. Cette association était un regroupement des différentes sections (handball, football, basketball, ...) avec un président unique. </p>\r\n\r\n\r\n<p>Le créateur et premier président de l''<span style = "text-decoration : underline; font-weight : bold;">ASSBC Basket</span> était Monsieur HEBERT Maurice. \r\nL''association, sous sa forme actuelle, a été déclarée par Monsieur HEBERT en novembre 1995. </p>\r\n\r\n<p>En 1985, Monsieur LANCELEUX Jean-Luc est devenu secrétaire jusqu''en 1999, année de son élection à la présidence du club. Jean-Luc est resté président du club pendant 10 ans. </p>\r\n<p>En 2009, Monsieur Vincent CORDIER a été élu président. En 2011, il a passé la main à Madame Estelle CASANOVA jusqu''alors vice-présidente. En juin 2013, Madame Pauline MAISSIN a été élue présidente de l''association. </p>\r\n\r\n<p>À ses débuts, le club avait des équipes jeunes (garçons et filles) puis a grandi au fil du temps pour avoir une section masculine puis une équipe féminine au début des 90''. </p>\r\n<p>Pour la saison 2013-2014, le club a engagé 5 équipes en championnat (2 équipes masculines, 1 équipe féminine et 3 équipes jeunes).</p>\r\n\r\n<p>Le club était à son apogée au milieu des années 90 avec presque 100 licenciés. Pendant la saison 2012-2013, l''ASSBC Basket réunissait 69 licenciés. </p>', 2, 1),
(4, 'L''esprit du club', '<p> L''esprit du club </p>', 2, 1),
(5, 'Pré-National Masculin', NULL, 3, 1),
(6, 'Pré-National Féminin', NULL, 3, 1),
(7, 'Excellence Départementale Masculin', NULL, 3, 1),
(8, 'Excellence Départementale Feminin', NULL, 3, 1),
(9, 'U17 Masculin', NULL, 3, 1),
(10, 'U15 Masculin', NULL, 3, 1),
(11, 'U11 Masculin', NULL, 3, 1),
(12, 'Ecole de basket (6-8 ans)', NULL, 3, 1),
(13, 'Calendrier', NULL, 4, 1),
(14, 'Résultats d''équipes', NULL, 4, 1),
(15, 'Soirées', NULL, 8, 2),
(16, 'Stages ', NULL, 8, 2),
(17, 'Divers', NULL, 8, 1),
(18, 'Tournois', NULL, 8, 1),
(19, 'Gestion des menus', NULL, 10, 4),
(20, 'Gestion des utilisateurs', NULL, 10, 4),
(21, 'Mise à jour de la page d''accueil', NULL, 10, 3),
(22, 'Ajout de comptes rendus de réunion', NULL, 10, 3),
(23, 'Mise à jour des résultats d''équipes', NULL, 10, 3),
(24, 'Gestion de l''album photo', '<form id="uploadimg" method="post" action="ajax/reception.php" enctype="multipart/form-data">\r\n     <fieldset>\r\n          <ul>\r\n               <li>\r\n                    <label for="image">Fichier (tous formats | max. 1 Mo) :</label>\r\n                    <input type="hidden" name="MAX_FILE_SIZE" value="3145728" />\r\n                    <input type="file" name="image" id="image" />\r\n               </li>\r\n\r\n               <li>\r\n                    <label for="titre">Titre du fichier (max. 50 caractères) :</label>\r\n                    <input type="text" name="titre" value="Titre du fichier" id="titre" />\r\n               </li>\r\n\r\n               <li>\r\n                    <label for="description">Description de votre fichier (max. 255 caractères) :</label>\r\n                    <textarea name="description" id="description"></textarea>\r\n               </li>\r\n          </ul>\r\n     </fieldset>\r\n     <div class="messUpload"></div>\r\n     <fieldset>\r\n          <input type="submit" name="submit" value="Envoyer" />\r\n     </fieldset>\r\n</form>', 10, 3),
(25, 'Gestion du calendrier', NULL, 10, 3);

-- --------------------------------------------------------

--
-- Structure de la table `niveau`
--

CREATE TABLE IF NOT EXISTS `niveau` (
`idNiveau` int(10) NOT NULL,
  `libNiveau` varchar(20) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `niveau`
--

INSERT INTO `niveau` (`idNiveau`, `libNiveau`) VALUES
(1, 'Invité'),
(2, 'Membre'),
(3, 'Bureau'),
(4, 'Administrateur');

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

CREATE TABLE IF NOT EXISTS `personne` (
`idPers` int(11) NOT NULL,
  `nomPers` varchar(20) CHARACTER SET utf8 NOT NULL,
  `prenomPers` varchar(20) CHARACTER SET utf8 NOT NULL,
  `adressMailPers` varchar(40) CHARACTER SET utf8 NOT NULL,
  `adressPers` varchar(50) CHARACTER SET utf8 NOT NULL,
  `villePers` varchar(40) CHARACTER SET utf8 NOT NULL,
  `cpPers` varchar(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `personne`
--

INSERT INTO `personne` (`idPers`, `nomPers`, `prenomPers`, `adressMailPers`, `adressPers`, `villePers`, `cpPers`) VALUES
(1, 'Grimaud', 'Robin', 'robin.grimaud@etudiant.univ-reims.fr', '2 rue du pont', 'Reims', '51100'),
(2, 'Lallement', 'Jaufre', 'jaufre.lallement@etudiant.univ-reims.fr', '6 rue jean michel', 'reims', '51000'),
(3, 'bureau', 'bureau', 'bureau.bureau@etudiant.univ-reims.fr', '10 rue du bureau', 'Bureau', '51000'),
(4, 'membre', 'membre', 'membre.membre@etudiant.univ-reims.fr', '5 rue du membre', 'Membre', '51000'),
(5, 'Jean', 'Dupont', 'jean.dupon@etudiant.univ-reims.fr', '5 rue du pc', 'reims', '51000'),
(6, 'Isartelle', 'Patrick', 'patrick.isartelle@univ-reims.fr', '6 rue du moulin', 'charleville-mézières', '08000'),
(7, 'dzazd', 'dazdazd', 'a.a@a.fr', 'a.a@a.fr', '', ''),
(8, 'fddazdaz', 'dazdazd', 'a.a@htbt.fr', 'a.a@htbt.fr', '', ''),
(9, 'az', 'az', 'a.a@htbt.fr', 'a.a@htbt.fr', '', ''),
(10, 'Esp', 'Loris', 'efz.fez@fez.fr', 'efz.fez@fez.fr', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

CREATE TABLE IF NOT EXISTS `photo` (
  `idPhoto` int(11) NOT NULL,
  `libPhoto` varchar(20) CHARACTER SET utf8 NOT NULL,
  `legende` text CHARACTER SET utf8 NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `saison`
--

CREATE TABLE IF NOT EXISTS `saison` (
`idSaison` int(11) NOT NULL,
  `idChampionnat` int(11) NOT NULL,
  `libSaison` varchar(20) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE IF NOT EXISTS `salle` (
  `idSalle` int(10) NOT NULL,
  `libSalle` varchar(30) CHARACTER SET utf8 NOT NULL,
  `villeSalle` varchar(40) CHARACTER SET utf8 NOT NULL,
  `rueSalle` text CHARACTER SET utf8 NOT NULL,
  `cpSalle` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `typeevenement`
--

CREATE TABLE IF NOT EXISTS `typeevenement` (
  `idTypeEvenement` int(11) NOT NULL,
  `libTypeEvenement` varchar(20) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `typeevenement`
--

INSERT INTO `typeevenement` (`idTypeEvenement`, `libTypeEvenement`) VALUES
(1, 'Soirée');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `commentaire` text NOT NULL,
  `login` varchar(20) NOT NULL,
  `idNiveau` int(11) NOT NULL,
`idPers` int(11) NOT NULL,
  `mdp` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`commentaire`, `login`, `idNiveau`, `idPers`, `mdp`) VALUES
('c''est robin !!', 'grima001', 4, 1, 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3'),
('c''est jaufre !!', 'lalle001', 4, 2, '02553c7faada6f0cd3ae19d0ade3351027aa6af2'),
('c''est bureau !!', 'burea001', 3, 3, '688c24ec15901a9da7041a2f497c93ecff3095e7'),
('c''est membre !!', 'membr001', 2, 4, '587679f84349e8bf34281af770b1e6e3882d9e67'),
('c''est jean !!', 'dupon001', 2, 5, '0792bdb7b7c8fb1e51b1a203af7ea120b3d63ec4'),
('c''est patrick !!', 'isart001', 2, 6, 'adbaf3223048a5b125c62152ec2d4312351c799d'),
('', 'dazd', 2, 7, 'de5eaf0bfb7796ff84e97c916d7d99c440062b8b'),
('', 'dazdaz', 2, 8, '37c2e165ef60fb6d7ea090e79c3dd93dc78f02cd'),
('', 'az', 2, 9, 'f54a8e725fdcd4b0b5e4f05604fd24358cd70c8f'),
('C''est Loris !!', 'espos001', 2, 10, 'e60ace6755c3d51217fda4ed8c474929b9c34b21');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `arbitre`
--
ALTER TABLE `arbitre`
 ADD PRIMARY KEY (`idPers`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
 ADD PRIMARY KEY (`idCtg`);

--
-- Index pour la table `championnat`
--
ALTER TABLE `championnat`
 ADD PRIMARY KEY (`idChampionnat`);

--
-- Index pour la table `equipe`
--
ALTER TABLE `equipe`
 ADD PRIMARY KEY (`idEquipe`);

--
-- Index pour la table `evenement`
--
ALTER TABLE `evenement`
 ADD PRIMARY KEY (`idEvenement`);

--
-- Index pour la table `match`
--
ALTER TABLE `match`
 ADD PRIMARY KEY (`idMatch`);

--
-- Index pour la table `menu`
--
ALTER TABLE `menu`
 ADD PRIMARY KEY (`idMenu`);

--
-- Index pour la table `niveau`
--
ALTER TABLE `niveau`
 ADD PRIMARY KEY (`idNiveau`);

--
-- Index pour la table `personne`
--
ALTER TABLE `personne`
 ADD PRIMARY KEY (`idPers`);

--
-- Index pour la table `photo`
--
ALTER TABLE `photo`
 ADD PRIMARY KEY (`idPhoto`);

--
-- Index pour la table `saison`
--
ALTER TABLE `saison`
 ADD PRIMARY KEY (`idSaison`);

--
-- Index pour la table `salle`
--
ALTER TABLE `salle`
 ADD PRIMARY KEY (`idSalle`);

--
-- Index pour la table `typeevenement`
--
ALTER TABLE `typeevenement`
 ADD PRIMARY KEY (`idTypeEvenement`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
 ADD PRIMARY KEY (`idPers`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `arbitre`
--
ALTER TABLE `arbitre`
MODIFY `idPers` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `championnat`
--
ALTER TABLE `championnat`
MODIFY `idChampionnat` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `equipe`
--
ALTER TABLE `equipe`
MODIFY `idEquipe` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `niveau`
--
ALTER TABLE `niveau`
MODIFY `idNiveau` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `personne`
--
ALTER TABLE `personne`
MODIFY `idPers` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `saison`
--
ALTER TABLE `saison`
MODIFY `idSaison` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
MODIFY `idPers` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
