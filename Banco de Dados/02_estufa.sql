-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 05/05/2024 às 05:04
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `estufa`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `estufa`
--

CREATE TABLE `estufa` (
  `id_estufa` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `data_criacao` date DEFAULT NULL,
  `umidade` int(11) DEFAULT NULL,
  `temperatura` int(11) DEFAULT NULL,
  `imagem` varchar(220) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `estufa`
--

INSERT INTO `estufa` (`id_estufa`, `id_usuario`, `nome`, `data_criacao`, `umidade`, `temperatura`, `imagem`) VALUES
(10, 26, 'Cacto', '2024-05-04', 30, 30, 'cacto-mini-900x1200.jpg'),
(11, 25, 'Morango', '2024-05-04', 70, 22, 'morango.jpg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `planta`
--

CREATE TABLE `planta` (
  `id_planta` int(11) NOT NULL,
  `nome_planta` varchar(255) NOT NULL,
  `umidade_ideal` int(11) NOT NULL,
  `temperatura_ideal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `planta`
--

INSERT INTO `planta` (`id_planta`, `nome_planta`, `umidade_ideal`, `temperatura_ideal`) VALUES
(1, 'Morango', 70, 22),
(2, 'Cebolinha', 60, 18),
(3, 'Manjericão', 50, 24),
(4, 'Salsinha', 65, 20),
(5, 'Tomate', 75, 23),
(6, 'Pimenta', 60, 25),
(7, 'Alecrim', 40, 27),
(8, 'Lavanda', 40, 25),
(9, 'Camomila', 60, 21),
(10, 'Hortelã', 70, 18),
(11, 'Orégano', 55, 22),
(12, 'Coentro', 65, 20),
(13, 'Alface', 75, 18),
(14, 'Espinafre', 65, 20),
(15, 'Erva-cidreira', 50, 25),
(16, 'Cacto', 30, 30),
(17, 'Suculenta', 40, 25),
(18, 'Begônia', 50, 22),
(19, 'Violeta', 60, 18),
(20, 'Rosa', 55, 22);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

CREATE TABLE `produto` (
  `id_produto` int(11) NOT NULL,
  `n_serie` varchar(30) NOT NULL,
  `email_produto` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produto`
--

INSERT INTO `produto` (`id_produto`, `n_serie`, `email_produto`) VALUES
(1, '00ff', 'ana@gmail.com'),
(2, '555g', 'joao@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `senha` varchar(8) NOT NULL,
  `imagem` varchar(220) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome`, `email`, `senha`, `imagem`) VALUES
(25, 'ana', 'ana@gmail.com', '123', '20230501_094247.jpg'),
(26, 'Jão', 'joao@gmail.com', '123', 'cacto-mini-900x1200.jpg'),
(28, 'Cecilia', 'cecilia@gmail.com', '123', 'cacto-mini-900x1200.jpg');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `estufa`
--
ALTER TABLE `estufa`
  ADD PRIMARY KEY (`id_estufa`),
  ADD KEY `fk_plantUsuario` (`id_usuario`);

--
-- Índices de tabela `planta`
--
ALTER TABLE `planta`
  ADD PRIMARY KEY (`id_planta`);

--
-- Índices de tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id_produto`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `estufa`
--
ALTER TABLE `estufa`
  MODIFY `id_estufa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `planta`
--
ALTER TABLE `planta`
  MODIFY `id_planta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `estufa`
--
ALTER TABLE `estufa`
  ADD CONSTRAINT `fk_plantUsuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
