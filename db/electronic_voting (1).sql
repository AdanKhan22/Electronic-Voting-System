-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2025 at 10:09 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `electronic_voting`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `AddressID` bigint(20) NOT NULL,
  `Street` varchar(255) DEFAULT NULL,
  `City` varchar(255) DEFAULT NULL,
  `State` varchar(255) DEFAULT NULL,
  `ZipCode` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auditlog`
--

CREATE TABLE `auditlog` (
  `AuditID` bigint(20) NOT NULL,
  `UserID` int(11) NOT NULL,
  `ActionType` varchar(190) DEFAULT NULL,
  `Timestamp` bigint(20) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auditlog`
--

INSERT INTO `auditlog` (`AuditID`, `UserID`, `ActionType`, `Timestamp`, `Description`) VALUES
(5, 99, 'Verify User Request', 2025, 'Request from 99 to verify');

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `CandidateID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `PartyID` int(11) DEFAULT NULL,
  `ConstituencyID` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `candidate`
--

INSERT INTO `candidate` (`CandidateID`, `Name`, `PartyID`, `ConstituencyID`) VALUES
(1, 'John Doe', 1, 1),
(2, 'Jane Smith', 2, 1),
(3, 'Michael Johnson', 3, 2),
(4, 'Sarah Williams', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `citizen`
--

CREATE TABLE `citizen` (
  `UserID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Role` varchar(50) DEFAULT NULL,
  `AddressID` bigint(20) DEFAULT NULL,
  `PhoneNumber` varchar(15) DEFAULT NULL,
  `Gender` char(1) DEFAULT NULL,
  `password` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `citizen`
--

INSERT INTO `citizen` (`UserID`, `Name`, `Email`, `Role`, `AddressID`, `PhoneNumber`, `Gender`, `password`) VALUES
(1, 'new', 'test3@example.com', 'user', NULL, '1', 'M', '$2y$10$5cHfc9/Ip3nbG.p/s3157.2ASXb91Oow6kvpe53J1/b3CwsjCHSvG'),
(25, 'test', 'test69@example.com', 'user', NULL, '4', 'F', '$2y$10$cuhIeGGW0NP/o.HzhtQ.Q.YYtogjBPuzBRyzNCU6NtrluuW.ip0me'),
(55, 'itworks', 'itworks@test.com', 'user', NULL, '2', 'M', '$2y$10$dVqJqovfItdVGvsSGWLODOPj5zYIPMQPf2XOrVxjIwJZP9A86TzaW'),
(69, 'test3', 'test5@example.com', 'user', NULL, '22', 'F', '$2y$10$fe2SQ5Qovf3bP3DyAqJWbuLxD5WfbE..6O3Btl1Ic0Hu94VUJ.J/O'),
(99, 'meow', 'meow@email.com', 'user', NULL, '1', 'M', '$2y$10$wLFu0o8fNkb7yDiv5ECeL.cViLxj78QNaAy60PatXT/jJLKDDyxcO'),
(2147483647, 'Adan', 'adanjavedkhan52@gmail.com', 'admin', NULL, '00000000', 'M', '$2y$10$1IKx4a6JsUquteZMJBP0qenmC5lIX/pfFFGlciv5JSVixpQcx9WWq');

-- --------------------------------------------------------

--
-- Table structure for table `constituencies`
--

CREATE TABLE `constituencies` (
  `ConstituencyID` bigint(20) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `State` varchar(255) DEFAULT NULL,
  `Population` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `constituencies`
--

INSERT INTO `constituencies` (`ConstituencyID`, `Name`, `State`, `Population`) VALUES
(1, 'Constituency 1', NULL, NULL),
(2, 'Constituency 2', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `electionofficials`
--

CREATE TABLE `electionofficials` (
  `OfficialID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Phone` varchar(15) DEFAULT NULL,
  `ConstituencyID` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `elections`
--

CREATE TABLE `elections` (
  `ElectionID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `StartDate` date DEFAULT NULL,
  `EndDate` date DEFAULT NULL,
  `ConstituencyID` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `elections`
--

INSERT INTO `elections` (`ElectionID`, `Name`, `StartDate`, `EndDate`, `ConstituencyID`) VALUES
(1, '2025 General Election', '2025-01-01', '2025-12-31', 1),
(2, '2024 Local Election', '2024-01-01', '2024-12-31', 2);

-- --------------------------------------------------------

--
-- Table structure for table `parties`
--

CREATE TABLE `parties` (
  `PartyID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Founder` varchar(255) DEFAULT NULL,
  `Members` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parties`
--

INSERT INTO `parties` (`PartyID`, `Name`, `Founder`, `Members`) VALUES
(1, 'Party A', 'Founder A', 5000),
(2, 'Party B', 'Founder B', 3000),
(3, 'Party C', 'Founder C', 2000);

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `ElectionID` int(11) NOT NULL,
  `CandidateID` int(11) NOT NULL,
  `TotalVotes` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`ElectionID`, `CandidateID`, `TotalVotes`) VALUES
(1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'Adan', 'adanjavedkhan67@gmail.com', '$2y$10$zzwusDpP.DKlWwAfNtoERuG93Llc3jrN/jyHl05RrhqyU9OU7V.5S'),
(2, 'Adan', 'adanjavedkhan67@gmail.com', '$2y$10$h/26KXbCgGu8Bxq39Vhv4eL/ZMRH4Fnq5Ra.5Yf1UCIm50rgEBq0e'),
(3, 'SOmeone', 'adanjavedkhan99@gmail.com', '$2y$10$CGlUF37wx9Fi9LExbomxn.hOPoHXZYb47KVD3FwesEmbAIWh4SZCK'),
(5, 'ba', 'test@example.com', '$2y$10$pVWu8rcgrItfm.EMgVraV.X9U7byUGhktiZ6I51dyzdiVCZGRCUVC'),
(6, 'ac', 'test2@example.com', '$2y$10$KDps70yMSUOxZDB1i6rprO4eL/lKwscWLtwm12/wcrbmMCg30BLJa');

-- --------------------------------------------------------

--
-- Table structure for table `voterverification`
--

CREATE TABLE `voterverification` (
  `UserID` int(11) NOT NULL,
  `VerifiedStatus` tinyint(1) DEFAULT 0,
  `VerificationMethod` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voterverification`
--

INSERT INTO `voterverification` (`UserID`, `VerifiedStatus`, `VerificationMethod`) VALUES
(69, 1, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `VoterID` int(11) NOT NULL,
  `CandidateID` int(11) NOT NULL,
  `ElectionID` int(11) DEFAULT NULL,
  `Timestamp` datetime DEFAULT NULL,
  `ConstituencyID` bigint(20) DEFAULT NULL,
  `HasVoted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`VoterID`, `CandidateID`, `ElectionID`, `Timestamp`, `ConstituencyID`, `HasVoted`) VALUES
(55, 1, 1, '2025-01-18 12:15:33', 1, 1),
(69, 1, 1, '2025-01-18 12:05:01', 1, 1),
(99, 1, 1, '2025-01-18 12:19:31', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`AddressID`);

--
-- Indexes for table `auditlog`
--
ALTER TABLE `auditlog`
  ADD PRIMARY KEY (`AuditID`,`UserID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`CandidateID`),
  ADD KEY `PartyID` (`PartyID`),
  ADD KEY `ConstituencyID` (`ConstituencyID`);

--
-- Indexes for table `citizen`
--
ALTER TABLE `citizen`
  ADD PRIMARY KEY (`UserID`),
  ADD KEY `AddressID` (`AddressID`);

--
-- Indexes for table `constituencies`
--
ALTER TABLE `constituencies`
  ADD PRIMARY KEY (`ConstituencyID`);

--
-- Indexes for table `electionofficials`
--
ALTER TABLE `electionofficials`
  ADD PRIMARY KEY (`OfficialID`),
  ADD KEY `ConstituencyID` (`ConstituencyID`);

--
-- Indexes for table `elections`
--
ALTER TABLE `elections`
  ADD PRIMARY KEY (`ElectionID`),
  ADD KEY `ConstituencyID` (`ConstituencyID`);

--
-- Indexes for table `parties`
--
ALTER TABLE `parties`
  ADD PRIMARY KEY (`PartyID`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`ElectionID`,`CandidateID`),
  ADD KEY `CandidateID` (`CandidateID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voterverification`
--
ALTER TABLE `voterverification`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`VoterID`,`CandidateID`),
  ADD KEY `CandidateID` (`CandidateID`),
  ADD KEY `ElectionID` (`ElectionID`),
  ADD KEY `ConstituencyID` (`ConstituencyID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auditlog`
--
ALTER TABLE `auditlog`
  MODIFY `AuditID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `candidate`
--
ALTER TABLE `candidate`
  ADD CONSTRAINT `candidate_ibfk_1` FOREIGN KEY (`PartyID`) REFERENCES `parties` (`PartyID`),
  ADD CONSTRAINT `candidate_ibfk_2` FOREIGN KEY (`ConstituencyID`) REFERENCES `constituencies` (`ConstituencyID`);

--
-- Constraints for table `citizen`
--
ALTER TABLE `citizen`
  ADD CONSTRAINT `citizen_ibfk_1` FOREIGN KEY (`AddressID`) REFERENCES `address` (`AddressID`);

--
-- Constraints for table `electionofficials`
--
ALTER TABLE `electionofficials`
  ADD CONSTRAINT `electionofficials_ibfk_1` FOREIGN KEY (`ConstituencyID`) REFERENCES `constituencies` (`ConstituencyID`);

--
-- Constraints for table `elections`
--
ALTER TABLE `elections`
  ADD CONSTRAINT `elections_ibfk_1` FOREIGN KEY (`ConstituencyID`) REFERENCES `constituencies` (`ConstituencyID`);

--
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `results_ibfk_1` FOREIGN KEY (`ElectionID`) REFERENCES `elections` (`ElectionID`),
  ADD CONSTRAINT `results_ibfk_2` FOREIGN KEY (`CandidateID`) REFERENCES `candidate` (`CandidateID`);

--
-- Constraints for table `voterverification`
--
ALTER TABLE `voterverification`
  ADD CONSTRAINT `fk_UserID` FOREIGN KEY (`UserID`) REFERENCES `citizen` (`UserID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_voterverification_userid` FOREIGN KEY (`UserID`) REFERENCES `citizen` (`UserID`) ON DELETE CASCADE,
  ADD CONSTRAINT `voterverification_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `citizen` (`UserID`);

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`VoterID`) REFERENCES `citizen` (`UserID`),
  ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`CandidateID`) REFERENCES `candidate` (`CandidateID`),
  ADD CONSTRAINT `votes_ibfk_3` FOREIGN KEY (`ElectionID`) REFERENCES `elections` (`ElectionID`),
  ADD CONSTRAINT `votes_ibfk_4` FOREIGN KEY (`ConstituencyID`) REFERENCES `constituencies` (`ConstituencyID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
