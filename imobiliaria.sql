-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24/03/2026 às 02:31
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
-- Banco de dados: `imobiliaria`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `imoveis`
--

CREATE TABLE `imoveis` (
  `id` int(11) NOT NULL,
  `logradouro` varchar(255) NOT NULL,
  `numero` varchar(50) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `complemento` varchar(255) DEFAULT NULL,
  `usuario_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `imoveis`
--

INSERT INTO `imoveis` (`id`, `logradouro`, `numero`, `bairro`, `complemento`, `usuario_id`, `created_at`, `updated_at`) VALUES
(1, 'imovel', '123', 'bairro', '', 2, '2026-03-23 02:06:38', '2026-03-23 02:06:38');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `data_nascimento` date DEFAULT NULL,
  `cpf` varchar(20) DEFAULT NULL,
  `sexo` enum('Masculino','Feminino') DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo` varchar(20) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `data_nascimento`, `cpf`, `sexo`, `telefone`, `email`, `senha`, `tipo`) VALUES
(1, 'Admin', '1990-01-01', '00000000000', 'Masculino', NULL, 'admin@admin.com', '$2y$10$ObgPX9FtswwNrjjHSY8gYOiaQ/FwPj051//giSCdBhV5GIHqL12aa', 'admin'),
(2, 'usuario', '2001-01-01', '123456789', 'Masculino', NULL, 'user@user.com', '$2y$10$ypRPSndYJg7vwGtCAdkNLebPAjSTSuUSSXbXHWXNAuh5iVbgc/oQG', 'usuario');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `imoveis`
--
ALTER TABLE `imoveis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuario_id` (`usuario_id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `imoveis`
--
ALTER TABLE `imoveis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `imoveis`
--
ALTER TABLE `imoveis`
  ADD CONSTRAINT `fk_usuario_id` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
