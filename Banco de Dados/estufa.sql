-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 21/10/2023 às 23:10
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

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
-- Estrutura para tabela `acao`
--

CREATE TABLE `acao` (
  `id_acao` int(11) NOT NULL,
  `nome` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `planta`
--

CREATE TABLE `planta` (
  `id_planta` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `data_criacao` date NOT NULL,
  `umidade` int(11) NOT NULL,
  `temperatura` int(11) NOT NULL,
  `imagem` varchar(220) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `registro`
--

CREATE TABLE `registro` (
  `id_registro` int(11) NOT NULL,
  `id_planta` int(11) NOT NULL,
  `id_acao` int(11) NOT NULL,
  `data_acao` date NOT NULL,
  `umidade_anterior` int(11) NOT NULL,
  `umidade_posterior` int(11) NOT NULL,
  `temperatura_anterior` int(11) NOT NULL,
  `temperatura_posterior` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `acao`
--
ALTER TABLE `acao`
  ADD PRIMARY KEY (`id_acao`);

--
-- Índices de tabela `planta`
--
ALTER TABLE `planta`
  ADD PRIMARY KEY (`id_planta`),
  ADD KEY `fk_plantUsuario` (`id_usuario`);

--
-- Índices de tabela `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`id_registro`),
  ADD KEY `fk_regisPlanta` (`id_planta`),
  ADD KEY `fk_regisAcao` (`id_acao`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `acao`
--
ALTER TABLE `acao`
  MODIFY `id_acao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `planta`
--
ALTER TABLE `planta`
  MODIFY `id_planta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `registro`
--
ALTER TABLE `registro`
  MODIFY `id_registro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `planta`
--
ALTER TABLE `planta`
  ADD CONSTRAINT `fk_plantUsuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Restrições para tabelas `registro`
--
ALTER TABLE `registro`
  ADD CONSTRAINT `fk_regisAcao` FOREIGN KEY (`id_acao`) REFERENCES `acao` (`id_acao`),
  ADD CONSTRAINT `fk_regisPlanta` FOREIGN KEY (`id_planta`) REFERENCES `planta` (`id_planta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
