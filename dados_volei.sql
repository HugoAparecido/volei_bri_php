-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 07-Jul-2024 às 21:50
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

-- --------------------------------------------------------

--
-- Estrutura da tabela `instituicao`
--

DROP TABLE IF EXISTS `instituicao`;
CREATE TABLE IF NOT EXISTS `instituicao` (
  `id_instituicao` int NOT NULL AUTO_INCREMENT,
  `nome_instituicao` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `tipo_instituicao` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_instituicao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `jogador`
--

DROP TABLE IF EXISTS `jogador`;
CREATE TABLE IF NOT EXISTS `jogador` (
  `id_jogador` int NOT NULL AUTO_INCREMENT,
  `nome_jogador` varchar(80) COLLATE utf8mb4_general_ci NOT NULL,
  `apelido_jogador` varchar(80) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `numero_camisa` int UNSIGNED DEFAULT NULL,
  `defesa_jogador` int UNSIGNED NOT NULL DEFAULT '0',
  `altura_jogador` decimal(2,2) DEFAULT NULL,
  `peso_jogador` decimal(3,2) DEFAULT NULL,
  `sexo_jogador` enum('M','S') COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_jogador`)
) ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `jogador_no_time`
--

DROP TABLE IF EXISTS `jogador_no_time`;
CREATE TABLE IF NOT EXISTS `jogador_no_time` (
  `id_jogador` int NOT NULL,
  `id_time` int NOT NULL,
  `defesa_no_time` int UNSIGNED NOT NULL,
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
  `posicao_jogador` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `saque_fora_no_time` int UNSIGNED DEFAULT '0',
  `saque_ace_cima_no_time` int UNSIGNED DEFAULT '0',
  `saque_ace_viagem_no_time` int UNSIGNED DEFAULT '0',
  `saque_ace_flutuante_no_time` int UNSIGNED DEFAULT '0',
  `saque_cima_no_time` int UNSIGNED DEFAULT '0',
  `saque_viagem_no_time` int UNSIGNED DEFAULT '0',
  `saque_flutuante_no_time` int UNSIGNED DEFAULT '0',
  PRIMARY KEY (`id_jogador`,`id_time`),
  KEY `time_time` (`id_time`)
) ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `levantador`
--

DROP TABLE IF EXISTS `levantador`;
CREATE TABLE IF NOT EXISTS `levantador` (
  `id_jogador` int NOT NULL,
  `posicao` char(10) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Levantador',
  `ataque_dentro` int UNSIGNED NOT NULL DEFAULT '0',
  `ataque_errado` int UNSIGNED NOT NULL DEFAULT '0',
  `bloqueio_convertido` int UNSIGNED NOT NULL DEFAULT '0',
  `bloqueio_errado` int UNSIGNED NOT NULL DEFAULT '0',
  `errou_levantamento` int UNSIGNED NOT NULL DEFAULT '0',
  `levantamento_para_oposto` int UNSIGNED NOT NULL,
  `levantamento_para_ponta` int UNSIGNED NOT NULL,
  `levantamento_para_pipe` int UNSIGNED NOT NULL,
  `levantamento_para_centro` int UNSIGNED NOT NULL,
  `saque_fora` int UNSIGNED NOT NULL,
  `saque_cima` int UNSIGNED NOT NULL,
  `saque_flutuante` int UNSIGNED NOT NULL,
  `saque_viagem` int UNSIGNED NOT NULL,
  `saque_cima_ace` int UNSIGNED NOT NULL,
  `saque_flutuante_ace` int UNSIGNED NOT NULL,
  `saque_viagem_ace` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id_jogador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `libero`
--

DROP TABLE IF EXISTS `libero`;
CREATE TABLE IF NOT EXISTS `libero` (
  `id_jogador` int NOT NULL,
  `passe_a` int UNSIGNED NOT NULL,
  `passe_b` int UNSIGNED NOT NULL,
  `passe_c` int UNSIGNED NOT NULL,
  `passe_d` int UNSIGNED NOT NULL,
  `posicao` char(6) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Líbero',
  PRIMARY KEY (`id_jogador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `outras_posicoes`
--

DROP TABLE IF EXISTS `outras_posicoes`;
CREATE TABLE IF NOT EXISTS `outras_posicoes` (
  `id_jogador` int NOT NULL,
  `passe_a` int UNSIGNED NOT NULL,
  `passe_b` int UNSIGNED NOT NULL,
  `passe_c` int UNSIGNED NOT NULL,
  `passe_d` int UNSIGNED NOT NULL,
  `bloqueio_convertido` int UNSIGNED NOT NULL,
  `bloqueio_errado` int UNSIGNED NOT NULL,
  `ataque_dentro` int UNSIGNED NOT NULL,
  `ataque_fora` int UNSIGNED NOT NULL,
  `saque_ace_cima` int UNSIGNED NOT NULL,
  `saque_ace_flutuante` int UNSIGNED NOT NULL,
  `saque_ace_viagem` int UNSIGNED NOT NULL,
  `saque_cima` int UNSIGNED NOT NULL,
  `saque_flutuante` int UNSIGNED NOT NULL,
  `saque_viagem` int UNSIGNED NOT NULL,
  `saque_errado` int UNSIGNED NOT NULL,
  `posicao` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_jogador`)
) ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `time`
--

DROP TABLE IF EXISTS `time`;
CREATE TABLE IF NOT EXISTS `time` (
  `id_time` int NOT NULL AUTO_INCREMENT,
  `nome_time` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `data_hora_criacao` datetime NOT NULL,
  `sexo_time` varchar(3) COLLATE utf8mb4_general_ci NOT NULL,
  `id_time_adversario` int NOT NULL,
  `id_usuario` int NOT NULL,
  `id_instituicao` int NOT NULL,
  PRIMARY KEY (`id_time`),
  KEY `time_time` (`id_time_adversario`),
  KEY `time_usuario` (`id_usuario`),
  KEY `time_instituicao` (`id_instituicao`)
) ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `time_time`
--

DROP TABLE IF EXISTS `time_time`;
CREATE TABLE IF NOT EXISTS `time_time` (
  `id_time_time` int NOT NULL AUTO_INCREMENT,
  `id_desafiante` int NOT NULL,
  `id_desafiado` int NOT NULL,
  `data_hora_competicao` datetime NOT NULL,
  PRIMARY KEY (`id_time_time`),
  KEY `time_dasafiado` (`id_desafiado`),
  KEY `time_desafiante` (`id_desafiante`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `nome_usuario` varchar(80) COLLATE utf8mb4_general_ci NOT NULL,
  `senha_usuario` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `jogador` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `jogador_no_time`
--
ALTER TABLE `jogador_no_time`
  ADD CONSTRAINT `jogador_jogador` FOREIGN KEY (`id_jogador`) REFERENCES `jogador` (`id_jogador`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `time_time` FOREIGN KEY (`id_time`) REFERENCES `time` (`id_time`);

--
-- Limitadores para a tabela `levantador`
--
ALTER TABLE `levantador`
  ADD CONSTRAINT `jogador_levantador` FOREIGN KEY (`id_jogador`) REFERENCES `jogador` (`id_jogador`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Limitadores para a tabela `libero`
--
ALTER TABLE `libero`
  ADD CONSTRAINT `jogador_libero` FOREIGN KEY (`id_jogador`) REFERENCES `jogador` (`id_jogador`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Limitadores para a tabela `outras_posicoes`
--
ALTER TABLE `outras_posicoes`
  ADD CONSTRAINT `jogador_posicao` FOREIGN KEY (`id_jogador`) REFERENCES `jogador` (`id_jogador`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `time`
--
ALTER TABLE `time`
  ADD CONSTRAINT `time_instituicao` FOREIGN KEY (`id_instituicao`) REFERENCES `instituicao` (`id_instituicao`),
  ADD CONSTRAINT `time_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `time_time`
--
ALTER TABLE `time_time`
  ADD CONSTRAINT `time_dasafiado` FOREIGN KEY (`id_desafiado`) REFERENCES `time` (`id_time`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `time_desafiante` FOREIGN KEY (`id_desafiante`) REFERENCES `time` (`id_time`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
