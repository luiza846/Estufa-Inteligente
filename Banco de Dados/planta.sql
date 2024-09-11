-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11/09/2024 às 02:47
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
-- Banco de dados: `planta`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `planta`
--

CREATE TABLE `planta` (
  `id_planta` int(11) NOT NULL,
  `nome_planta` varchar(255) NOT NULL,
  `umidade_ideal` int(11) NOT NULL,
  `temperatura_ideal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `planta`
--
ALTER TABLE `planta`
  ADD PRIMARY KEY (`id_planta`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `planta`
--
ALTER TABLE `planta`
  MODIFY `id_planta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
