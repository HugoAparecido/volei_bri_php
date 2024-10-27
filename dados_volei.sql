-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 27-Out-2024 às 20:43
-- Versão do servidor: 8.0.31
-- versão do PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `dados_volei`
--
CREATE DATABASE IF NOT EXISTS `dados_volei` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `dados_volei`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `competicao`
--

DROP TABLE IF EXISTS `competicao`;
CREATE TABLE IF NOT EXISTS `competicao` (
  `id_competicao` int NOT NULL AUTO_INCREMENT,
  `id_time_desafiante` int NOT NULL,
  `id_time_desafiado` int DEFAULT NULL,
  `data_hora_competicao` datetime NOT NULL,
  `nome_competicao` varchar(255) NOT NULL,
  PRIMARY KEY (`id_competicao`),
  KEY `competicao_id_desafiado` (`id_time_desafiado`),
  KEY `competicao_time_desafiante` (`id_time_desafiante`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `competicao_time`
--

DROP TABLE IF EXISTS `competicao_time`;
CREATE TABLE IF NOT EXISTS `competicao_time` (
  `id_competicao` int NOT NULL,
  `id_time` int NOT NULL,
  `defesa_no_time` int UNSIGNED NOT NULL DEFAULT '0',
  `erro_defesa_no_time` int UNSIGNED NOT NULL DEFAULT '0',
  `ataque_dentro_no_time` int UNSIGNED DEFAULT '0',
  `ataque_fora_no_time` int UNSIGNED DEFAULT '0',
  `bloqueio_convertido_no_time` int UNSIGNED DEFAULT '0',
  `bloqueio_errado_no_time` int UNSIGNED DEFAULT '0',
  `passe_a_no_time` int UNSIGNED DEFAULT '0',
  `passe_b_no_time` int UNSIGNED DEFAULT '0',
  `passe_c_no_time` int UNSIGNED DEFAULT '0',
  `passe_d_no_time` int UNSIGNED DEFAULT '0',
  `levantamento_para_oposto_no_time` int UNSIGNED DEFAULT '0',
  `levantamento_para_pipe_no_time` int UNSIGNED DEFAULT '0',
  `levantamento_para_ponta_no_time` int UNSIGNED DEFAULT '0',
  `levantamento_para_centro_no_time` int UNSIGNED DEFAULT '0',
  `errou_levantamento_no_time` int UNSIGNED DEFAULT '0',
  `saque_fora_no_time` int UNSIGNED DEFAULT '0',
  `saque_ace_no_time` int UNSIGNED DEFAULT '0',
  `saque_cima_no_time` int UNSIGNED DEFAULT '0',
  `saque_viagem_no_time` int UNSIGNED DEFAULT '0',
  `saque_flutuante_no_time` int UNSIGNED DEFAULT '0',
  PRIMARY KEY (`id_competicao`,`id_time`),
  KEY `competicao_time` (`id_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `instituicao`
--

DROP TABLE IF EXISTS `instituicao`;
CREATE TABLE IF NOT EXISTS `instituicao` (
  `id_instituicao` int NOT NULL AUTO_INCREMENT,
  `nome_instituicao` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tipo_instituicao` enum('pré-mirim','mirim','infantil','infanto juvenil','juvenil','adulto','máster') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_instituicao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `jogador`
--

DROP TABLE IF EXISTS `jogador`;
CREATE TABLE IF NOT EXISTS `jogador` (
  `id_jogador` int NOT NULL AUTO_INCREMENT,
  `nome_jogador` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `apelido_jogador` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `numero_camisa` int UNSIGNED DEFAULT NULL,
  `defesa_jogador` int UNSIGNED NOT NULL DEFAULT '0',
  `erro_defesa` int UNSIGNED NOT NULL DEFAULT '0',
  `altura_jogador` decimal(2,2) DEFAULT NULL,
  `peso_jogador` decimal(3,2) DEFAULT NULL,
  `sexo_jogador` enum('m','f') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_jogador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `jogador_no_time`
--

DROP TABLE IF EXISTS `jogador_no_time`;
CREATE TABLE IF NOT EXISTS `jogador_no_time` (
  `id_jogador_time` int NOT NULL AUTO_INCREMENT,
  `id_jogador` int NOT NULL,
  `id_time` int NOT NULL,
  `defesa_jogador_no_time` int UNSIGNED NOT NULL DEFAULT '0',
  `erro_defesa_no_time` int UNSIGNED NOT NULL DEFAULT '0',
  `posicao_jogador` enum('líbero','levantador','oposto','central','ponta 1','ponta 2','não definida') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_jogador_time`),
  KEY `jogador_jogador` (`id_jogador`),
  KEY `time_time` (`id_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `levantador`
--

DROP TABLE IF EXISTS `levantador`;
CREATE TABLE IF NOT EXISTS `levantador` (
  `id_jogador` int NOT NULL,
  `posicao` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'levantador',
  `ataque_dentro` int UNSIGNED NOT NULL DEFAULT '0',
  `ataque_fora` int UNSIGNED NOT NULL DEFAULT '0',
  `bloqueio_convertido` int UNSIGNED NOT NULL DEFAULT '0',
  `bloqueio_errado` int UNSIGNED NOT NULL DEFAULT '0',
  `errou_levantamento` int UNSIGNED NOT NULL DEFAULT '0',
  `levantamento_para_oposto` int UNSIGNED NOT NULL DEFAULT '0',
  `levantamento_para_ponta` int UNSIGNED NOT NULL DEFAULT '0',
  `levantamento_para_pipe` int UNSIGNED NOT NULL DEFAULT '0',
  `levantamento_para_centro` int UNSIGNED NOT NULL DEFAULT '0',
  `saque_fora` int UNSIGNED NOT NULL DEFAULT '0',
  `saque_cima` int UNSIGNED NOT NULL DEFAULT '0',
  `saque_flutuante` int UNSIGNED NOT NULL DEFAULT '0',
  `saque_viagem` int UNSIGNED NOT NULL DEFAULT '0',
  `saque_ace` int UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_jogador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `levantador_no_time`
--

DROP TABLE IF EXISTS `levantador_no_time`;
CREATE TABLE IF NOT EXISTS `levantador_no_time` (
  `id_jogador_time` int NOT NULL,
  `ataque_dentro_no_time` int UNSIGNED NOT NULL DEFAULT '0',
  `ataque_fora_no_time` int UNSIGNED DEFAULT '0',
  `bloqueio_convertido_no_time` int UNSIGNED DEFAULT '0',
  `bloqueio_errado_no_time` int UNSIGNED DEFAULT '0',
  `levantamento_para_oposto_no_time` int UNSIGNED DEFAULT '0',
  `levantamento_para_pipe_no_time` int UNSIGNED DEFAULT '0',
  `levantamento_para_ponta_no_time` int UNSIGNED DEFAULT '0',
  `levantamento_para_centro_no_time` int UNSIGNED DEFAULT '0',
  `errou_levantamento_no_time` int UNSIGNED DEFAULT '0',
  `saque_fora_no_time` int UNSIGNED DEFAULT '0',
  `saque_ace_no_time` int UNSIGNED DEFAULT '0',
  `saque_cima_no_time` int UNSIGNED DEFAULT '0',
  `saque_viagem_no_time` int UNSIGNED DEFAULT '0',
  `saque_flutuante_no_time` int UNSIGNED DEFAULT '0',
  PRIMARY KEY (`id_jogador_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `libero`
--

DROP TABLE IF EXISTS `libero`;
CREATE TABLE IF NOT EXISTS `libero` (
  `id_jogador` int NOT NULL,
  `passe_a` int UNSIGNED NOT NULL DEFAULT '0',
  `passe_b` int UNSIGNED NOT NULL DEFAULT '0',
  `passe_c` int UNSIGNED NOT NULL DEFAULT '0',
  `passe_d` int UNSIGNED NOT NULL DEFAULT '0',
  `posicao` char(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'líbero',
  PRIMARY KEY (`id_jogador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `libero_no_time`
--

DROP TABLE IF EXISTS `libero_no_time`;
CREATE TABLE IF NOT EXISTS `libero_no_time` (
  `id_jogador_time` int NOT NULL,
  `passe_a_no_time` int UNSIGNED DEFAULT '0',
  `passe_b_no_time` int UNSIGNED DEFAULT '0',
  `passe_c_no_time` int UNSIGNED DEFAULT '0',
  `passe_d_no_time` int UNSIGNED DEFAULT '0',
  PRIMARY KEY (`id_jogador_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `outras_posicoes`
--

DROP TABLE IF EXISTS `outras_posicoes`;
CREATE TABLE IF NOT EXISTS `outras_posicoes` (
  `id_posicao` int NOT NULL AUTO_INCREMENT,
  `id_jogador` int NOT NULL,
  `passe_a` int UNSIGNED NOT NULL DEFAULT '0',
  `passe_b` int UNSIGNED NOT NULL DEFAULT '0',
  `passe_c` int UNSIGNED NOT NULL DEFAULT '0',
  `passe_d` int UNSIGNED NOT NULL DEFAULT '0',
  `bloqueio_convertido` int UNSIGNED NOT NULL DEFAULT '0',
  `bloqueio_errado` int UNSIGNED NOT NULL DEFAULT '0',
  `ataque_dentro` int UNSIGNED NOT NULL DEFAULT '0',
  `ataque_fora` int UNSIGNED NOT NULL DEFAULT '0',
  `saque_ace` int UNSIGNED NOT NULL DEFAULT '0',
  `saque_cima` int UNSIGNED NOT NULL DEFAULT '0',
  `saque_flutuante` int UNSIGNED NOT NULL DEFAULT '0',
  `saque_viagem` int UNSIGNED NOT NULL DEFAULT '0',
  `saque_fora` int UNSIGNED NOT NULL DEFAULT '0',
  `posicao` enum('oposto','central','ponta 1','ponta 2','não definida') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_posicao`),
  KEY `posicao_jogador` (`id_jogador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `outras_posicoes_no_time`
--

DROP TABLE IF EXISTS `outras_posicoes_no_time`;
CREATE TABLE IF NOT EXISTS `outras_posicoes_no_time` (
  `id_jogador_time` int NOT NULL,
  `ataque_dentro_no_time` int UNSIGNED DEFAULT '0',
  `ataque_fora_no_time` int UNSIGNED DEFAULT '0',
  `bloqueio_convertido_no_time` int UNSIGNED DEFAULT '0',
  `bloqueio_errado_no_time` int UNSIGNED DEFAULT '0',
  `passe_a_no_time` int UNSIGNED DEFAULT '0',
  `passe_b_no_time` int UNSIGNED DEFAULT '0',
  `passe_c_no_time` int UNSIGNED DEFAULT '0',
  `passe_d_no_time` int UNSIGNED DEFAULT '0',
  `saque_fora_no_time` int UNSIGNED DEFAULT '0',
  `saque_ace_no_time` int UNSIGNED DEFAULT '0',
  `saque_cima_no_time` int UNSIGNED DEFAULT '0',
  `saque_viagem_no_time` int UNSIGNED DEFAULT '0',
  `saque_flutuante_no_time` int UNSIGNED DEFAULT '0',
  PRIMARY KEY (`id_jogador_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `time`
--

DROP TABLE IF EXISTS `time`;
CREATE TABLE IF NOT EXISTS `time` (
  `id_time` int NOT NULL AUTO_INCREMENT,
  `nome_time` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `data_hora_criacao` datetime NOT NULL,
  `sexo_time` enum('m','f','mis') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_usuario` int DEFAULT NULL,
  `id_instituicao` int NOT NULL,
  PRIMARY KEY (`id_time`),
  KEY `time_usuario` (`id_usuario`),
  KEY `time_instituicao` (`id_instituicao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `nome_usuario` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email_usuario` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `senha_usuario_site` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jogador` tinyint(1) NOT NULL,
  `id_jogador` int DEFAULT NULL,
  `treinador` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome_usuario`, `email_usuario`, `senha_usuario_site`, `jogador`, `id_jogador`, `treinador`) VALUE
(13, 'admin', 'admin@gmail.com', '$2y$10$RumoBce/TzUVVVBM29fR0OSOY1zAlRpSOtzh99oRPlTkOzQM.F.2e', 0, NULL, 1);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `competicao`
--
ALTER TABLE `competicao`
  ADD CONSTRAINT `competicao_id_desafiado` FOREIGN KEY (`id_time_desafiado`) REFERENCES `time` (`id_time`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `competicao_time_desafiante` FOREIGN KEY (`id_time_desafiante`) REFERENCES `time` (`id_time`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `competicao_time`
--
ALTER TABLE `competicao_time`
  ADD CONSTRAINT `competicao_competicao` FOREIGN KEY (`id_competicao`) REFERENCES `competicao` (`id_competicao`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `competicao_time` FOREIGN KEY (`id_time`) REFERENCES `time` (`id_time`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `jogador_no_time`
--
ALTER TABLE `jogador_no_time`
  ADD CONSTRAINT `jogador_jogador` FOREIGN KEY (`id_jogador`) REFERENCES `jogador` (`id_jogador`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `time_time` FOREIGN KEY (`id_time`) REFERENCES `time` (`id_time`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `levantador`
--
ALTER TABLE `levantador`
  ADD CONSTRAINT `jogador_levantador` FOREIGN KEY (`id_jogador`) REFERENCES `jogador` (`id_jogador`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `levantador_no_time`
--
ALTER TABLE `levantador_no_time`
  ADD CONSTRAINT `time_levantador` FOREIGN KEY (`id_jogador_time`) REFERENCES `jogador_no_time` (`id_jogador_time`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `libero`
--
ALTER TABLE `libero`
  ADD CONSTRAINT `jogador_libero` FOREIGN KEY (`id_jogador`) REFERENCES `jogador` (`id_jogador`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `libero_no_time`
--
ALTER TABLE `libero_no_time`
  ADD CONSTRAINT `libero_time` FOREIGN KEY (`id_jogador_time`) REFERENCES `jogador_no_time` (`id_jogador_time`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `outras_posicoes`
--
ALTER TABLE `outras_posicoes`
  ADD CONSTRAINT `posicao_jogador` FOREIGN KEY (`id_jogador`) REFERENCES `jogador` (`id_jogador`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `outras_posicoes_no_time`
--
ALTER TABLE `outras_posicoes_no_time`
  ADD CONSTRAINT `outras_posicoes_time` FOREIGN KEY (`id_jogador_time`) REFERENCES `jogador_no_time` (`id_jogador_time`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `time`
--
ALTER TABLE `time`
  ADD CONSTRAINT `time_instituicao` FOREIGN KEY (`id_instituicao`) REFERENCES `instituicao` (`id_instituicao`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_time` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
