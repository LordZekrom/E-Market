-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 18-Out-2024 às 13:55
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
(7, 1, 4, NULL, NULL),
(8, 2, 5, 1, NULL),
(9, 2, 6, 2, NULL),
(10, 2, 8, 1, NULL),
(11, 3, 9, 1, NULL),
(12, 3, 5, 3, NULL),
(13, 3, 8, 2, NULL),
(14, 3, 6, 1, NULL),
(15, 4, 7, 1, NULL);

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
(1, '12345678911', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'carrinho'),
(2, '12345612344', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'carrinho'),
(3, '1234', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'finalizado'),
(4, '1234', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'carrinho');

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
(4, 'Ferrero Rocher', 'chocolate Ferrero Rocher - 12 unidades', '3.99', 6, 'Eletrônicos', '172743965066f6a322061c7.jpg'),
(5, 'Chocolate Crunch ', 'Barra de Chocolate Nestlé Crunch 90g', '5.00', 20, 'Eletrônicos', '172743894766f6a0638122a.png'),
(6, 'Bolacha Passatempo', 'pacote de bolha passatempo - 1 quilo', '15.99', 10, 'Eletrônicos', '172743858566f69ef91ce22.png'),
(7, 'Arroz Carindé', 'arroz branco', '25.00', 1, 'Eletrônicos', '172743842166f69e555bd24.png'),
(8, 'Guaraná Antarctica', 'Refrigerante Guaraná Antarctica Lata 350ml', '3.50', 50, 'Eletrônicos', '172588612366deeeab4096e.png'),
(9, 'Coca Cola Lata ', 'Refrigerante Coca Cola Lata 350ml', '4.99', 60, 'Bebidas', '172588626466deef38212dc.png'),
(10, 'Kinder ovo', 'Chocolate Kinder Ovo Meninas 40g', '4.50', 20, 'Alimentos', '172744016366f6a5238e19a.jpg'),
(11, 'Suco Natural One ', 'Suco de Laranja Integral Refrigerado Natural One 100% Suco 1,5 Litros', '10.99', 5, 'Eletrônicos', '1729255241671257498ec0e.png'),
(12, 'Feijão Carioca Camil', 'feijão carioca camil em grãos - 1 quilo', '40.00', 4, 'Alimentos', '172744261866f6aeba10849.png'),
(13, 'Ração Pedigree', 'Ração Seca Pedigree Carne e Vegetais para Cães Adultos - 2,7Kg', '30.00', 3, 'Outros', '172744364466f6b2bcb1508.png'),
(14, 'Pedro Sarajane', 'Cachorre Pedro - 15 quilos', '190.00', 1, 'Eletrônicos', '172744375066f6b32653796.jpeg'),
(15, 'Suco Natural One', 'Suco natural de laranja , 1 litro', '36.89', 2, 'Bebidas', '172744383966f6b37f6fac2.png');

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
  `fotoPerfil` varchar(255) DEFAULT NULL,
  `tipoUsuario` enum('adm','cliente') NOT NULL DEFAULT 'cliente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`cpfUsuario`, `nomeUsuario`, `emailUsuario`, `estadoUsuario`, `cidadeUsuario`, `bairroUsuario`, `enderecoUsuario`, `numeroUsuario`, `complementoUsuario`, `senhaUsuario`, `fotoPerfil`, `tipoUsuario`) VALUES
('10987654321', 'burno', 'aburno@gmail.com', '', '', '', '', '89', '', '2323', '172441254866c872845282c.jpg', 'cliente'),
('111111111', 'lauany', 'g@gmail.com', 'Amazonas', 'Pouso Alegre', 'Cruz Alta', 'Rua do Dionisio', '64', 'apartamento', '1717', '1729258474671263ea51c18.png', 'adm'),
('11111111111', 'teste', 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 'cliente'),
('1234', 'Dio', 'dionisio@gmail.com', '', '', '', '', '', '', '1234', '172925235067124bfe99c53.png', 'cliente'),
('12345612344', 'Rafael Moreira', 'rafael@gmail.com', '', '', '', '', '', '', '123', 'default.png', 'cliente'),
('12345678911', 'Báh', 'b@gmail.com', 'Amazonas', 'Pouso Alegre', 'Cruz Alta', 'Roça', '89', 'Deu certo?', '1234', NULL, 'adm'),
('22222222', 's', 's@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '1414', 'default.png', 'cliente'),
('333333333', 'p', 'p@gmail.com', '', '', '', '', '', '', '14', '172441339466c875d282725.jpg', 'cliente'),
('4321', 'teste', 'teste@gmil.com', '', '', '', '', '', '', '4321', '172441206466c870a0f27d1.jpg', 'cliente'),
('54321', 'teste2', 'teste2@gmail.com', '', '', '', '', '', '', '54321', '172441220466c8712c1c02d.jpg', 'cliente'),
('6543221', 'teste3', 'teste3@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '6543221', NULL, 'cliente'),
('7654321', 'saci', 'saci@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '2626', NULL, 'cliente'),
('87654321', 'l', 'l@gmil.com', NULL, NULL, NULL, NULL, NULL, NULL, '1414', 'default.png', 'cliente'),
('98765432199', 'Simo', 'luis.tavares@ifsuldeminas.edu.br', NULL, NULL, NULL, NULL, NULL, NULL, '1234', NULL, 'cliente'),
('99', 'adm', 'adm@gmail.com', 'Minas Gerais', 'Pouso Alegre', 'Cruz Alta', 'Rua do Dionisio', '89', 'apartamento', '1234', NULL, 'cliente');

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
  MODIFY `idItensPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pedido`
--
ALTER TABLE `pedido`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `codigoProduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
