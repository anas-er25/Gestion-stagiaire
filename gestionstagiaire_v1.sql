-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2023 at 12:09 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestionstagiaire_v1`
--

-- --------------------------------------------------------

--
-- Table structure for table `compteadministrateur`
--

CREATE TABLE `compteadministrateur` (
  `loginAdmin` varchar(10) NOT NULL,
  `motPasse` varchar(10) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `compteadministrateur`
--

INSERT INTO `compteadministrateur` (`loginAdmin`, `motPasse`, `nom`, `prenom`) VALUES
('admin', '12345', 'ER-RAKIBI', 'Anas');

-- --------------------------------------------------------

--
-- Table structure for table `filiere`
--

CREATE TABLE `filiere` (
  `idFiliere` varchar(5) NOT NULL,
  `intitule` varchar(50) NOT NULL,
  `nombreGroupe` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `filiere`
--

INSERT INTO `filiere` (`idFiliere`, `intitule`, `nombreGroupe`) VALUES
('DEVOW', 'Développement web', 3),
('GE201', 'Gestion des entreprises', 2),
('ID201', 'Infrastructure Digital', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stagiaire`
--

CREATE TABLE `stagiaire` (
  `idStagiaire` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `dateNaissance` date DEFAULT NULL,
  `photoProfil` text DEFAULT NULL,
  `idFiliere` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `stagiaire`
--

INSERT INTO `stagiaire` (`idStagiaire`, `nom`, `prenom`, `dateNaissance`, `photoProfil`, `idFiliere`) VALUES
(1, 'ER-RAKIBI', 'Anas', '2002-11-25', 'img/stagiaires/stg.png', 'DEVOW'),
(2, 'ISSAOUI', 'Yassin', '2004-10-06', 'img/stagiaires/stg.png', 'ID201'),
(3, 'SOUBAI', 'Khaoula', '2003-09-05', 'img/stagiaires/stgF.png', 'GE201'),
(4, 'HAMIDI', 'Aroua', '2012-12-12', 'img/stagiaires/stgF.png', 'ID201');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `compteadministrateur`
--
ALTER TABLE `compteadministrateur`
  ADD PRIMARY KEY (`loginAdmin`);

--
-- Indexes for table `filiere`
--
ALTER TABLE `filiere`
  ADD PRIMARY KEY (`idFiliere`);

--
-- Indexes for table `stagiaire`
--
ALTER TABLE `stagiaire`
  ADD PRIMARY KEY (`idStagiaire`),
  ADD KEY `fk_idFiliere` (`idFiliere`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `stagiaire`
--
ALTER TABLE `stagiaire`
  MODIFY `idStagiaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `stagiaire`
--
ALTER TABLE `stagiaire`
  ADD CONSTRAINT `fk_idFiliere` FOREIGN KEY (`idFiliere`) REFERENCES `filiere` (`idFiliere`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
