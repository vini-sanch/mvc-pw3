-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 20-Set-2019 às 23:57
-- Versão do servidor: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bdnoticia`
--
CREATE DATABASE IF NOT EXISTS `bdnoticia` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `bdnoticia`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE `categoria` (
  `CODCATEGORIA` int(11) NOT NULL,
  `NOMECATEGORIA` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`CODCATEGORIA`, `NOMECATEGORIA`) VALUES
(3, 'Cultura'),
(1, 'Esportes'),
(2, 'PolÃ­tica'),
(4, 'ViolÃªncia');

-- --------------------------------------------------------

--
-- Estrutura da tabela `noticia`
--

DROP TABLE IF EXISTS `noticia`;
CREATE TABLE `noticia` (
  `CODNOTICIA` int(11) NOT NULL,
  `TITULO` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `CONTEUDO` text COLLATE utf8_unicode_ci,
  `DATA` date NOT NULL,
  `AUTOR` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `IMAGEM` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CODCATEGORIA` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `noticia`
--

INSERT INTO `noticia` (`CODNOTICIA`, `TITULO`, `CONTEUDO`, `DATA`, `AUTOR`, `IMAGEM`, `CODCATEGORIA`) VALUES
(1, 'Minha NotÃ­cia', 'hb  gjtj j rtj fgj t jfgj tfg jf gjdfgjfd u5rtyk jsgnm \\dh nxr jnt,.;i;.Ã§l.lul,', '2019-09-06', 'Eu mesmo', 'Wallpaper-EFM.jpg', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `CODUSUARIO` int(11) NOT NULL,
  `NOME` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `EMAIL` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `SENHA` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `NIVEL_ACESSO` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`CODUSUARIO`, `NOME`, `EMAIL`, `SENHA`, `NIVEL_ACESSO`) VALUES
(1, 'Eu', 'eu@eu.com', '8cb2237d0679ca88db6464eac60da96345513964', '2'),
(2, 'Vinícius', 'vi@vi.com', '8cb2237d0679ca88db6464eac60da96345513964', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`CODCATEGORIA`),
  ADD KEY `IDX_NOMECATEGORIA` (`NOMECATEGORIA`);

--
-- Indexes for table `noticia`
--
ALTER TABLE `noticia`
  ADD PRIMARY KEY (`CODNOTICIA`),
  ADD KEY `FK_CATEGORIA_NOTICIA` (`CODCATEGORIA`),
  ADD KEY `IDX_NOTICIA` (`DATA`,`TITULO`,`AUTOR`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`CODUSUARIO`),
  ADD UNIQUE KEY `IDX_EMAIL` (`EMAIL`),
  ADD KEY `IDX_NOME` (`NOME`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `CODCATEGORIA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `noticia`
--
ALTER TABLE `noticia`
  MODIFY `CODNOTICIA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `CODUSUARIO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `noticia`
--
ALTER TABLE `noticia`
  ADD CONSTRAINT `FK_CATEGORIA_NOTICIA` FOREIGN KEY (`CODCATEGORIA`) REFERENCES `categoria` (`CODCATEGORIA`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
