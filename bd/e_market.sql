-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 29-Nov-2024 às 13:42
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
(1, 1, 6, 8, NULL),
(2, 2, 6, 2, NULL);

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
(1, '777', '2024-11-29', '10:21:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '127.92', 'finalizado'),
(2, '777', '2024-11-29', '10:21:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '31.98', 'finalizado'),
(3, '777', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'carrinho');

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
(4, 'Ferrero Rocher', 'chocolate Ferrero Rocher - 12 unidades', '3.99', 6, 'Alimentos', '172743965066f6a322061c7.jpg'),
(5, 'Chocolate Crunch ', 'Barra de Chocolate Nestlé Crunch 90g', '5.00', 20, 'Alimentos', '172743894766f6a0638122a.png'),
(6, 'Bolacha Passatempo', 'pacote de bolha passatempo - 1 quilo', '15.99', 0, 'Alimentos', '172743858566f69ef91ce22.png'),
(7, 'Arroz Carindé', 'Arroz Branco Premium - 10kg', '25.00', 1, 'Eletrônicos', '172743842166f69e555bd24.png'),
(8, 'Guaraná Antarctica', 'Refrigerante Guaraná Antarctica Lata 350ml', '3.50', 50, 'Bebidas', '172588612366deeeab4096e.png'),
(9, 'Coca Cola Lata ', 'Refrigerante Coca Cola Lata 350ml', '4.99', 60, 'Bebidas', '172588626466deef38212dc.png'),
(10, 'Kinder ovo', 'Chocolate Kinder Ovo Meninas 40g', '4.50', 20, 'Alimentos', '172744016366f6a5238e19a.jpg'),
(12, 'Feijão Carioca Camil', 'feijão carioca camil em grãos - 1 quilo', '40.00', 4, 'Alimentos', '172744261866f6aeba10849.png'),
(13, 'Ração Pedigree', 'Ração Seca Pedigree Carne e Vegetais para Cães Adultos - 2,7Kg', '30.00', 3, 'Outros', '172744364466f6b2bcb1508.png'),
(15, 'Suco Natural One', 'Suco natural de laranja , 1 litro', '36.89', 2, 'Bebidas', '172744383966f6b37f6fac2.png'),
(16, 'Cinco Aneis', 'É mais do que um simples manual de artes marciais.', '20.00', 14, 'Eletrônicos', '173287714367499b576064a.jpg'),
(18, 'O Pequeno Príncipe', 'Obra atemporal, com metáforas pertinentes e aprendizados', '20.00', 14, 'Livros', '173287748267499caaecad3.jpg'),
(19, 'Sherlck Holmes Box', 'Sherlock Holmes é o investigador mais famoso da literatura.', '150.00', 5, 'Eletrônicos', '17328790126749a2a4a1b4e.jpg'),
(20, 'O Hobbit', 'Bilbo era um dos mais respeitáveis hobbits de todo o Condado até que...', '70.00', 43, 'Livros', '17328793066749a3ca6fbe7.png'),
(21, 'O Menino que Descobriu o Vento', 'Quando uma terrível seca atingiu o pequeno vilarejo...', '30.00', 435, 'Livros', '17328794556749a45fe669b.png'),
(22, 'Assassinato no Expresso Oriente', 'Dentro da noite quando a neve acumulada sobre os trilhos..', '40.00', 23, 'Livros', '17328796636749a52f7f333.png'),
(23, 'O Vilarejo', 'Ligação de cada um dos pecados capitais a um demônio...', '60.00', 34, 'Eletrônicos', '17328797936749a5b1c91b0.png'),
(24, 'Cueca Comfort Insider', 'Comfort Boxer para trazer mais conforto à sua vida diária.', '60.00', 657, 'Roupas', '17328800006749a680459ae.png'),
(25, 'kit 12 pares de meia', 'Meias para varias idades modelo feminino com fundo colorido, calcanhar verdadeiro e anatômica.', '60.00', 56, 'Eletrônicos', '17328801816749a73584716.png'),
(26, 'Capacete Moto', 'R8 Pro Tork Fechado 58 Preto/Vermelho Viseira Fumê', '150.00', 234, 'Outros', '17328802676749a78bab2fe.png'),
(27, 'Lâmpada Fluorescente 15W', 'Indicadas para ambientes corporativos e residenciais como salas, escritórios...', '18.00', 456, 'Casa', '17328804116749a81b2e450.png'),
(28, 'Espelho de Aumento', 'Espelho com aumento 5x ideal para maquiagens e cuidados pessoais.', '25.00', 15, 'Eletrônicos', '17328809466749aa324f20c.png'),
(29, 'Kit Pincéis Maquiagem', 'Kit com 12 pincéis de alta qualidade para maquiagem profissional.', '50.00', 10, 'Higiene', '17328809816749aa557cd5e.png'),
(30, 'Secador de Cabelo', 'Secador de cabelo profissional, 2000W, com 3 temperaturas.', '199.00', 25, 'Eletrônicos', '17328810746749aab2d4a88.png'),
(31, 'Toalha de Banho', 'Toalha de banho de algodão 100% premium - tamanho 70x140 cm', '35.00', 40, 'Casa', '17328811856749ab21cc74e.png'),
(32, 'Aspirador de Pó', 'Aspirador de pó sem saco, 1000W, com filtro HEPA.', '150.00', 12, 'Casa', '17328812116749ab3b02eda.png'),
(33, 'Jogo de Cama Queen', 'Jogo de cama Queen size com 4 peças, 100% algodão.', '120.00', 18, 'Casa', '17328813146749aba2bfa38.png'),
(34, 'Panela de Pressão', 'Panela de pressão de 4,5 litros, feita de alumínio.', '90.00', 50, 'Casa', '17328813616749abd1bc661.png'),
(35, 'Tênis Nike AirMax', 'Tênis esportivo Nike AirMax, modelo masculino, número 42.', '450.00', 30, 'Roupas', '17328814006749abf801599.png'),
(36, 'Sandália Feminina', 'Sandália feminina, rasteira, com strass, disponível em várias cores.', '80.00', 15, 'Roupas', '17328814346749ac1a87f75.png'),
(37, 'Botas de Couro', 'Botas de couro legítimo para o inverno, disponíveis nos tamanhos 38 a 43.', '250.00', 40, 'Roupas', '17328819886749ae44e4468.png'),
(38, 'Detergente Líquido', 'Detergente líquido para lavar louças, embalagem 500ml.', '3.50', 100, 'Casa', '17328820226749ae66d122b.png'),
(39, 'Sabonete Líquido', 'Sabonete líquido para o corpo, 250ml, fragrância suave.', '6.00', 150, 'Higiene', '17328821046749aeb8d5219.png'),
(40, 'Cerveja Skol', 'Cerveja Skol Lata 350ml.', '2.50', 200, 'Bebidas', '17328824346749b0027b5ad.png'),
(41, 'Suco de Uva Integral', 'Suco de uva integral, 1 litro, sem adição de açúcar.', '8.00', 80, 'Bebidas', '17328826396749b0cf1e4fd.png'),
(42, 'Papel Higiênico', 'Papel higiênico 4 unidades, macio e resistente.', '7.50', 300, 'Eletrônicos', '17328826756749b0f37ebbc.png'),
(43, 'Livro 1984', 'Romance distópico de George Orwell, edição especial.', '35.00', 50, 'Livros', '17328827236749b1232081d.png'),
(44, 'O Senhor dos Anéis', 'Coleção completa de O Senhor dos Anéis de J.R.R.', '150.00', 20, 'Eletrônicos', '17328827716749b1535dbcf.png'),
(45, 'Caneca de Café', 'Caneca de cerâmica para café, 300ml.', '12.00', 75, 'Casa', '17328828946749b1ce1d16c.png'),
(46, 'Cadeira de Escritório', 'Cadeira ergonômica para escritório, ajustável, com rodinhas.', '350.00', 10, 'Casa', '17328829456749b20196d5d.png'),
(47, 'Cortina de Veludo', 'Cortina de veludo para janela, 2 metros de largura.', '100.00', 30, 'Casa', '17328834556749b3ff458bc.png'),
(48, 'Smartphone Samsung Galaxy', 'Smartphone Samsung Galaxy A54, tela 6.5\", 128GB de armazenamento.', '2000.00', 30, 'Eletrônicos', '17328835046749b430db72b.png'),
(49, 'Camiseta Masculina', 'Camiseta masculina de algodão, tamanho M, cor preta.', '29.90', 100, 'Roupas', '17328837846749b54847016.png'),
(50, 'Arroz Tipo 1', 'Arroz tipo 1, 5kg, pacote grande.', '18.00', 150, 'Alimentos', '17328838296749b5751d1b8.png'),
(51, 'Caderno Universitário', 'Caderno universitário 10 matérias, 200 folhas.', '25.00', 200, 'Livros', '17328839176749b5cd0f617.png'),
(52, 'Escova de Dentes', 'Escova de dentes de cerdas macias.', '5.00', 120, 'Higiene', '17328839576749b5f5459fc.png'),
(53, 'Vodka Absolut', 'Vodka Absolut 750ml, destilada na Suécia.', '120.00', 50, 'Bebidas', '17328839916749b6170267b.png'),
(54, 'Café Torrado', 'Café torrado e moído, embalagem 500g.', '15.00', 80, 'Eletrônicos', '17328840446749b64c821d7.png'),
(55, 'Mesa de Jantar', 'Mesa de jantar retangular, 6 lugares, madeira maciça.', '800.00', 20, 'Casa', '17328841446749b6b083ca3.png'),
(57, 'Relógio de Pulso', 'Relógio de pulso masculino com pulseira de aço inox.', '180.00', 45, 'Eletrônicos', '17328841986749b6e60240d.png'),
(58, 'arroz', 'arroz branco japones - 15kg', '30.00', 100, 'Eletrônicos', '17328800486749a6b077d1f.png'),
(59, 'arroz', 'arroz branco japones - 15kg', '30.00', 100, 'Alimentos', '1732876745674999c97c5be.jpg'),
(60, 'bolacha', 'Bolacha Hanna Maria - bem cremosa ', '15.99', 100, 'Alimentos', '173287682867499a1c06fba.jpg'),
(61, 'Despertador', 'Desperta você para realidade da ditadura', '15.99', 100, 'Eletrônicos', '173287687967499a4f234f7.png'),
(62, 'notebook', 'Notebook Gamer Acer Nitro 5 AMD Ryzen 7-4800H,', '3500.00', 100, 'Eletrônicos', '173287714467499b581eb49.png'),
(63, 'chocolate', 'Chocolate de 30% cacau direto da fabrica de chocolate', '30.00', 100, 'Alimentos', '173287722667499baa4642e.png'),
(64, 'ferrero', 'ferrero rocher cremoso e gostoso', '40.00', 100, 'Alimentos', '173287743467499c7a9cb04.jpg'),
(65, 'Spaten', 'cerveja spaten latão direto da ambev - 473ml', '2.00', 2000, 'Bebidas', '173287755967499cf781358.png'),
(66, 'Heineikein', 'Cerveja long neck heineken - 330ml', '3.00', 2000, 'Bebidas', '173287764167499d4962481.png'),
(67, 'Winchester 22', 'Rifle de wichester de calibri 22', '30.00', 98, 'Casa', '173287779367499de18b2a9.png'),
(68, 'Metanol', 'Metanol para desbacterização de ambientes e boca', '30.00', 99, 'Higiene', '173287789967499e4bd36d2.png'),
(69, 'Pasta de dente', 'Paste de dente para limpeza de dente', '30.00', 100, 'Higiene', '173287796567499e8ddaa54.png'),
(70, 'Tenis', 'Tenis de corrida feito para correr corridas', '30.00', 98, 'Roupas', '173287803267499ed0ba27d.png'),
(71, 'Cadeira', 'Cadeira de cozinha para mesas da cozinha', '30.00', 100, 'Casa', '173287810167499f1554cbe.png'),
(72, 'Garrafa', 'Garrafa Termica que segura calor e frio', '30.00', 100, 'Outros', '173287826567499fb9979a3.png'),
(73, 'Sobretudo', 'Sobretudo preto bem badass de protagonista', '40.00', 100, 'Eletrônicos', '17328799526749a65056138.png'),
(74, 'Arte da Guerra', 'Livro a arte da guerra escrito por sun tzu', '40.00', 100, 'Eletrônicos', '17328814096749ac0100bbc.png'),
(75, 'Cavalo', 'Cavalo puro sangue raça percheron', '20.00', 100, 'Casa', '17328785826749a0f64d642.png'),
(76, 'Guarda Chuva', 'Guarda Chuva para se proteger ', '15.99', 100, 'Casa', '17328786686749a14c4a668.png'),
(77, 'feijão', 'Feijão carioca paulista mineiro', '17.80', 100, 'Alimentos', '17328788956749a22f7fea8.jpg'),
(78, 'Carro', 'O **Humvee HMMWV** é um veículo 4x4 robusto e versátil, ideal para terrenos difíceis e uso multifuncional.', '666.00', 98, 'Casa', '17328790686749a2dc6c2e6.png'),
(79, 'Shampoo', 'Shampoo anti caspa do cr7 o mais recomendado', '18.00', 100, 'Higiene', '17328791416749a325bb7b5.png'),
(80, 'Teclado', 'Teclado gamer da Dell (delicia linda louca)', '30.00', 100, 'Eletrônicos', '17328793206749a3d80d813.png'),
(81, 'Pinga', 'Pinga cachaça agua ardente', '20.00', 100, 'Bebidas', '17328796346749a51235aad.png'),
(82, 'Janela', 'Janela grande para sala de estar', '30.00', 100, 'Casa', '17328797606749a590dd1af.png');

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
('1234', 'THIAGO', 'REIDELAS@GMAIL.COM', '', '', '', '', '', '', '81dc9bdb52d04dc20036dbd8313ed055', '17307216426728b76ae99ad.jpg', 'adm'),
('4321', 'burno', 'burno@gmail.com', 'Minas Gerais', 'Pouso Alegre', 'Cruz Alta', 'Rua do Dionisio', '64', 'Casa', 'd93591bdf7860e1e4ee2fca799911215', '173253365567445d978f4b5.png', 'cliente'),
('777', '777', '777', NULL, NULL, NULL, NULL, NULL, NULL, 'f1c1592588411002af340cbaedd6fc33', '17328756316749956fec2b3.png', 'cliente');

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
  MODIFY `idItensPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pedido`
--
ALTER TABLE `pedido`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `codigoProduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

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
