-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 17-Jul-2020 às 01:48
-- Versão do servidor: 5.7.17
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db-loja`
--
CREATE DATABASE IF NOT EXISTS `db-loja` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db-loja`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `livro`
--

CREATE TABLE `livro` (
  `IdLivro` int(11) NOT NULL,
  `NomeLivro` varchar(255) NOT NULL,
  `AutorLivro` varchar(255) NOT NULL,
  `QtePagLivro` int(11) NOT NULL,
  `PrecoLivro` float NOT NULL,
  `LivroAtivo` tinyint(1) NOT NULL DEFAULT '0',
  `DataInclusao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DataEdicao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `livro`
--

INSERT INTO `livro` (`IdLivro`, `NomeLivro`, `AutorLivro`, `QtePagLivro`, `PrecoLivro`, `LivroAtivo`, `DataInclusao`, `DataEdicao`) VALUES
(1, 'Dom Casmurro', 'Machado de Assis', 256, 16.42, 0, '2020-07-16 23:46:19', '2020-07-16 23:46:19'),
(2, 'MemÃ³rias pÃ³stumas de BrÃ¡s Cubas', 'Machado de Assis', 192, 15.92, 0, '2020-07-16 23:47:11', '2020-07-16 23:47:11'),
(3, 'Assim falou Zaratustra: um livro para todos e para ninguÃ©m', 'Friedrich Nietzsche', 384, 22.42, 0, '2020-07-16 23:48:15', '2020-07-16 23:48:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `livro`
--
ALTER TABLE `livro`
  ADD PRIMARY KEY (`IdLivro`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `livro`
--
ALTER TABLE `livro`
  MODIFY `IdLivro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
