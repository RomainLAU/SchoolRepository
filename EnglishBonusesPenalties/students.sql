-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: database:3306
-- Generation Time: Mar 30, 2022 at 09:16 PM
-- Server version: 8.0.28
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bonusesPenalties`
--

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `bonuses` int NOT NULL DEFAULT '0',
  `penalties` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`lastname`, `firstname`, `bonuses`, `penalties`) VALUES
('agre', 'william', 1, 1),
('bekkich', 'lyna', 0, 4),
('bensadoun', 'eyal', 0, 0),
('bossu', 'jules', 0, 0),
('calonne', 'alexandre', 0, 0),
('chapus', 'pierre', 0, 2),
('chaudry', 'zainab', 0, 0),
('crampon', 'charline', 0, 2),
('ez zerqty', 'ryan', 0, 0),
('ferte', 'jonathan', 0, 1),
('francisco', 'lucas', 1, 1),
('gregoire', 'julien', 0, 0),
('isungu', 'patrick', 0, 0),
('kalfon', 'raphael', 2, 0),
('kelfaoui', 'chabane', 0, 1),
('laurent', 'romain', 4, 0),
('ledour', 'keo', 0, 0),
('lemoust de lafosse', 'remi', 0, 1),
('mava', 'rebecca', 0, 0),
('moreira', 'philippe', 0, 0),
('ody', 'guillaume', 0, 0),
('patte', 'johan', 0, 0),
('queva', 'william', 0, 1),
('ramanantsoa', 'mika', 2, 4),
('richter', 'julie', 0, 2),
('tamzirt', 'yasmine', 0, 1),
('texeira lima', 'luis', 3, 0),
('xu', 'oscar', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`lastname`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
