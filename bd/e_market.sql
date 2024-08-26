-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 23-Ago-2024 às 11:58
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
  `quantidadeItensPedido` int(11) DEFAULT NULL,
  `precoProduto` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `itenspedido`
--

INSERT INTO `itenspedido` (`idItensPedido`, `idPedido`, `idProduto`, `quantidadeItensPedido`, `precoProduto`) VALUES
(1, 1, 7, NULL, NULL),
(2, 1, 4, NULL, NULL),
(3, 1, 5, NULL, NULL),
(4, 1, 6, NULL, NULL),
(5, 1, 4, NULL, NULL),
(6, 1, 4, NULL, NULL),
(7, 1, 4, NULL, NULL);

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

--
-- Extraindo dados da tabela `pedido`
--

INSERT INTO `pedido` (`idPedido`, `cpfUsuario`, `dataPedido`, `horaPedido`, `estadoUsuario`, `cidadeUsuario`, `bairroUsuario`, `enderecoUsuario`, `numeroUsuario`, `complementoUsuario`, `desconto`, `precoFinal`, `statusPedido`) VALUES
(1, '12345678911', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'carrinho');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `codigoProduto` int(11) NOT NULL,
  `nomeProduto` varchar(50) NOT NULL,
  `descricaoProduto` varchar(255) NOT NULL,
  `precoProduto` decimal(10,2) NOT NULL,
  `quantidadeProduto` int(11) NOT NULL,
  `categoriaProduto` enum('Eletrônicos','Roupas','Alimentos','Livros','Higiene','Bebidas','Casa','Outros') DEFAULT NULL,
  `fotoProduto` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`codigoProduto`, `nomeProduto`, `descricaoProduto`, `precoProduto`, `quantidadeProduto`, `categoriaProduto`, `fotoProduto`) VALUES
(1, 'joao', 'sdsd', '6.00', 2312, NULL, NULL),
(2, 'joao', 'sdsd', '6.00', 2312, NULL, NULL),
(3, 'joao', 'sdsd', '6.00', 2312, 'Eletrônicos', NULL),
(4, 'joao', 'sdsd', '6.00', 2312, 'Eletrônicos', NULL),
(5, 'joao', 'sdsd', '6.00', 2312, 'Eletrônicos', '172225657066a78cba76435.jpg'),
(6, 'bolacha', 'aaa', '15.99', 10, 'Alimentos', '172226166766a7a0a3bb6c3.jpg'),
(7, 'arroz', 'arroz branco', '20.00', 1, 'Alimentos', '172226379866a7a8f603078.jpg'),
(8, 'arroz', 'arroz branco', '30.00', 1, 'Alimentos', '172226383966a7a91f4711b.jpg');

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
  `complementoUsuario` varchar(100) DEFAULT NULL,
  `senhaUsuario` varchar(255) NOT NULL,
  `fotoPerfil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`cpfUsuario`, `nomeUsuario`, `emailUsuario`, `estadoUsuario`, `cidadeUsuario`, `bairroUsuario`, `enderecoUsuario`, `numeroUsuario`, `complementoUsuario`, `senhaUsuario`, `fotoPerfil`) VALUES
('0987654321', 'g', 'g@gmail.com', '', '', '', '', '', '', '1717', '172441306466c87488b4f80.jpg'),
('10987654321', 'burno', 'aburno@gmail.com', '', '', '', '', '', '', '2323', '172441254866c872845282c.jpg'),
('11111111111', 'teste', 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
('1234', 'Dio', 'dionisio@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '1234', NULL),
('12345678911', 'Bruno', 'b@gmail.com', 'Amazonas', 'Pouso Alegre', 'Cruz Alta', 'Roça', '000', 'Deu certo?', '1234', NULL),
('22222222', 's', 's@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '1414', 'default.png'),
('333333333', 'p', 'p@gmail.com', '', '', '', '', '', '', '14', '172441339466c875d282725.jpg'),
('33333333333333', 'h', 'h@gmail.com', '', '', '', '', '', '', '1414', '172441329166c8756b21b2d.jpg'),
('4321', 'teste', 'teste@gmil.com', '', '', '', '', '', '', '4321', '172441206466c870a0f27d1.jpg'),
('54321', 'teste2', 'teste2@gmail.com', '', '', '', '', '', '', '54321', '172441220466c8712c1c02d.jpg'),
('6543221', 'teste3', 'teste3@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '6543221', NULL),
('7654321', 'saci', 'saci@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '2626', NULL),
('87654321', 'l', 'l@gmil.com', NULL, NULL, NULL, NULL, NULL, NULL, '1414', 'default.png'),
('98765432199', 'Simo', 'luis.tavares@ifsuldeminas.edu.br', NULL, NULL, NULL, NULL, NULL, NULL, '1234', NULL);

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
  MODIFY `idItensPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pedido`
--
ALTER TABLE `pedido`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `codigoProduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
