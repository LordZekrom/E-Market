-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 29-Jul-2024 às 11:30
-- Versão do servidor: 5.7.25
-- versão do PHP: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_market`
--
CREATE DATABASE IF NOT EXISTS `e_market` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `e_market`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `itenspedido`
--

CREATE TABLE `itenspedido` (
  `idItensPedido` int(11) NOT NULL,
  `idPedido` int(11) DEFAULT NULL,
  `idProduto` int(11) DEFAULT NULL,
  `quantidadeItensPedido` int(11) NOT NULL,
  `precoProduto` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

CREATE TABLE `pedido` (
  `idPedido` int(11) NOT NULL,
  `cpfUsuario` varchar(14) NOT NULL,
  `dataPedido` date DEFAULT NULL,
  `horaPedido` time DEFAULT NULL,
  `estadoUsuario` varchar(50) DEFAULT NULL,
  `cidadeUsuario` varchar(100) DEFAULT NULL,
  `bairroUsuario` varchar(100) DEFAULT NULL,
  `enderecoUsuario` varchar(200) DEFAULT NULL,
  `numeroUsuario` varchar(10) DEFAULT NULL,
  `complementoUsuario` varchar(100) DEFAULT NULL,
  `desconto` decimal(10,2) DEFAULT NULL,
  `precoFinal` decimal(10,2) DEFAULT NULL,
  `statusPedido` enum('carrinho','finalizado') NOT NULL DEFAULT 'carrinho'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `codigoProduto` int(11) NOT NULL,
  `descricaoProduto` varchar(255) NOT NULL,
  `precoProduto` decimal(10,2) NOT NULL,
  `quantidadeProduto` int(11) NOT NULL,
  `categoriaProduto` enum('Eletrônicos','Roupas','Alimentos','Livros','Higiene','Bebidas','Casa','Outros') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `cpfUsuario` varchar(14) NOT NULL,
  `nomeUsuario` varchar(100) NOT NULL,
  `emailUsuario` varchar(100) NOT NULL,
  `estadoUsuario` varchar(50) DEFAULT NULL,
  `cidadeUsuario` varchar(100) DEFAULT NULL,
  `bairroUsuario` varchar(100) DEFAULT NULL,
  `enderecoUsuario` varchar(200) DEFAULT NULL,
  `numeroUsuario` varchar(10) DEFAULT NULL,
  `complementoUsuario` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`cpfUsuario`, `nomeUsuario`, `emailUsuario`, `estadoUsuario`, `cidadeUsuario`, `bairroUsuario`, `enderecoUsuario`, `numeroUsuario`, `complementoUsuario`) VALUES
('11111111111', 'teste', 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL),
('1234568911', 'Burno', 'b@gmail.com', 'Minas Gerais', 'Pouso Alegre', 'Cruz Alta', 'Roça', '000', 'Deu certo?');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `itenspedido`
--
ALTER TABLE `itenspedido`
  ADD PRIMARY KEY (`idItensPedido`),
  ADD KEY `idPedido` (`idPedido`),
  ADD KEY `idProduto` (`idProduto`);

--
-- Indexes for table `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`idPedido`),
  ADD KEY `fk_cpfusuario_usuario` (`cpfUsuario`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`codigoProduto`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`cpfUsuario`),
  ADD UNIQUE KEY `emailUsuario` (`emailUsuario`),
  ADD UNIQUE KEY `emailUsuario_2` (`emailUsuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `itenspedido`
--
ALTER TABLE `itenspedido`
  MODIFY `idItensPedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pedido`
--
ALTER TABLE `pedido`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `codigoProduto` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `itenspedido`
--
ALTER TABLE `itenspedido`
  ADD CONSTRAINT `itenspedido_ibfk_1` FOREIGN KEY (`idPedido`) REFERENCES `pedido` (`idPedido`),
  ADD CONSTRAINT `itenspedido_ibfk_2` FOREIGN KEY (`idProduto`) REFERENCES `produto` (`codigoProduto`);

--
-- Limitadores para a tabela `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_cpfusuario_usuario` FOREIGN KEY (`cpfUsuario`) REFERENCES `usuario` (`cpfUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
