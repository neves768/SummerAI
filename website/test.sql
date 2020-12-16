-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 16, 2020 at 09:06 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `in_devices`
--

DROP TABLE IF EXISTS `in_devices`;
CREATE TABLE IF NOT EXISTS `in_devices` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nome` tinytext NOT NULL,
  `ponto` tinytext NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `in_devices`
--

INSERT INTO `in_devices` (`ID`, `nome`, `ponto`) VALUES
(1, 'Lâmpada', '/API/DEV/communicate'),
(2, 'Televisão', '/API/DEV/communicate'),
(3, 'Computador', '/API/DEV/communicate');

-- --------------------------------------------------------

--
-- Table structure for table `smartdevices`
--

DROP TABLE IF EXISTS `smartdevices`;
CREATE TABLE IF NOT EXISTS `smartdevices` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `nome` tinytext NOT NULL,
  `dados` text NOT NULL,
  `type` tinyint(4) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `smartdevices`
--

INSERT INTO `smartdevices` (`ID`, `userID`, `nome`, `dados`, `type`) VALUES
(1, 16, 'Lâmpada da Cozinha', '{\"state\":\"false\"}', 1),
(2, 9, 'Lâmpada 02', '{\"state\":\"true\"}', 1),
(3, 16, 'Lâmpada 03', '{\"state\":\"false\"}', 1),
(4, 16, 'Lâmpada da Sala', '{\"state\":\"true\"}', 1),
(5, 17, 'Lâmpada da Cozinha', '{\"state\":\"false\"}', 1),
(6, 17, 'Lâmpada 02', '{\"state\":\"true\"}', 1),
(7, 17, 'Lâmpada 03', '{\"state\":\"true\"}', 1),
(8, 17, 'Lâmpada da Sala', '{\"state\":\"true\"}', 1),
(9, 9, 'afa', '{\"state\":\"true\"}', 1),
(10, 9, 'tete', '{\"state\":\"true\"}', 2),
(11, 9, 'tete', '{\"state\":\"true\"}', 2),
(12, 9, 'sdadsa', '{\"state\":\"false\"}', 2),
(13, 9, 'hehehe', '{\"state\":\"false\"}', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nome` tinytext NOT NULL,
  `sobrenome` tinytext NOT NULL,
  `email` tinytext NOT NULL,
  `senha` text NOT NULL,
  `sessao` text DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `nome`, `sobrenome`, `email`, `senha`, `sessao`) VALUES
(4, 'afafasfa', 'fafafa', 'roger@machado.com', '$2y$10$EjChaxevBJgKmIeHlHzSh./t0qRnMRrbJh1Ph0sdexS7z7oedLfca', ''),
(9, 'Christopher', 'Neves', 'chris_oboy@hotmail.com', '$2y$10$kP57vaamr0f3xlfQBhkURuD/bINix4afKj1/zckYaQFovWp965dPq', '4619426743b9564b9d236cfed9152fc7352bb18e'),
(16, 'teste', 'teste', 'fafabe@machado.com.br', '$2y$10$SPbKzEh3BTvIGx.kpJit1O4FG8ehRFAMmvE9xqmFpAdQp6tISvvIC', '8727f8799ff4f090f3cc6b861935388ae4802fec'),
(17, 'Christopher', 'Neves', 'admin@neves768.com', '$2y$10$DD8zN8ogXDR/pjcAjqmPCufwYQILrGPEHkQsL5YCJC5xCeknwlF66', 'a185b647b0c7e47198f5fad1793c23e97244f191');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
