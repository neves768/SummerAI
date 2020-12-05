-- phpMyAdmin SQL Dump
-- version 4.4.15.1
-- http://www.phpmyadmin.net
--
-- Host: mysql741.umbler.com
-- Generation Time: Dec 04, 2020 at 06:44 PM
-- Server version: 5.6.49
-- PHP Version: 5.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `summer`
--

-- --------------------------------------------------------

--
-- Table structure for table `smartdevices`
--

CREATE TABLE IF NOT EXISTS `smartdevices` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `nome` tinytext NOT NULL,
  `dados` text NOT NULL,
  `type` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `smartdevices`
--

INSERT INTO `smartdevices` (`ID`, `userID`, `nome`, `dados`, `type`) VALUES
(1, 9, 'Lâmpada da Cozinha', '{"state":"true"}', 1),
(2, 9, 'Lâmpada 02', '{"state":"true"}', 1),
(3, 9, 'Lâmpada 03', '{"state":"true"}', 1),
(4, 9, 'Lâmpada da Sala', '{"state":"true"}', 1),
(5, 17, 'Lâmpada da Cozinha', '{"state":"false"}', 1),
(6, 17, 'Lâmpada 02', '{"state":"false"}', 1),
(7, 17, 'Lâmpada 03', '{"state":"false"}', 1),
(8, 17, 'Lâmpada da Sala', '{"state":"true"}', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(11) NOT NULL,
  `nome` tinytext NOT NULL,
  `sobrenome` tinytext NOT NULL,
  `email` tinytext NOT NULL,
  `senha` text NOT NULL,
  `sessao` text
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `nome`, `sobrenome`, `email`, `senha`, `sessao`) VALUES
(4, 'afafasfa', 'fafafa', 'roger@machado.com', '$2y$10$EjChaxevBJgKmIeHlHzSh./t0qRnMRrbJh1Ph0sdexS7z7oedLfca', ''),
(9, 'Christopher', 'Neves', 'chris_oboy@hotmail.com', '$2y$10$kP57vaamr0f3xlfQBhkURuD/bINix4afKj1/zckYaQFovWp965dPq', 'a46d138b3efbcc52204cfcf62bbd95dba358cebe'),
(16, 'teste', 'teste', 'fafabe@machado.com.br', '$2y$10$SPbKzEh3BTvIGx.kpJit1O4FG8ehRFAMmvE9xqmFpAdQp6tISvvIC', '8727f8799ff4f090f3cc6b861935388ae4802fec'),
(17, 'Christopher', 'Neves', 'neves7681@outlook.com', '$2y$10$.GMvUsJh4W0Xmje/N.BqJOhUzSWrkS9PwrN4R5zISsIMc659Ib2rC', 'f3f88ca62f075070b812c10fac08867ecf059d1f');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `smartdevices`
--
ALTER TABLE `smartdevices`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `smartdevices`
--
ALTER TABLE `smartdevices`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
