-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 05/12/2024 às 14:28
-- Versão do servidor: 8.3.0
-- Versão do PHP: 8.2.18

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
-- Estrutura para tabela `competicao`
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `competicao`
--

INSERT INTO `competicao` (`id_competicao`, `id_time_desafiante`, `id_time_desafiado`, `data_hora_competicao`, `nome_competicao`) VALUES
(7, 8, NULL, '2024-12-04 21:57:38', 'Treino do dia 02/08/2024'),
(8, 8, NULL, '2024-12-04 22:16:00', 'Treino do dia 26/08/2024'),
(9, 8, NULL, '2024-12-04 22:24:52', 'Treino 12/09/2024'),
(10, 9, NULL, '2024-12-04 22:44:37', 'Treino Dia 23/08/2024'),
(11, 9, NULL, '2024-12-04 23:06:19', 'Treino do dia 09/08/2024'),
(12, 9, 8, '2024-12-04 23:10:43', 'Treino do dia 02/09/2024');

-- --------------------------------------------------------

--
-- Estrutura para tabela `competicao_time`
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

--
-- Despejando dados para a tabela `competicao_time`
--

INSERT INTO `competicao_time` (`id_competicao`, `id_time`, `defesa_no_time`, `erro_defesa_no_time`, `ataque_dentro_no_time`, `ataque_fora_no_time`, `bloqueio_convertido_no_time`, `bloqueio_errado_no_time`, `passe_a_no_time`, `passe_b_no_time`, `passe_c_no_time`, `passe_d_no_time`, `levantamento_para_oposto_no_time`, `levantamento_para_pipe_no_time`, `levantamento_para_ponta_no_time`, `levantamento_para_centro_no_time`, `errou_levantamento_no_time`, `saque_fora_no_time`, `saque_ace_no_time`, `saque_cima_no_time`, `saque_viagem_no_time`, `saque_flutuante_no_time`) VALUES
(7, 8, 20, 6, 9, 3, 0, 0, 17, 5, 2, 0, 2, 0, 3, 1, 1, 3, 7, 10, 0, 0),
(8, 8, 22, 7, 9, 5, 0, 0, 1, 7, 6, 1, 1, 2, 7, 6, 1, 5, 1, 11, 1, 15),
(9, 8, 36, 11, 8, 6, 1, 0, 7, 5, 3, 2, 6, 0, 5, 0, 0, 6, 0, 11, 0, 2),
(10, 9, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(11, 9, 39, 5, 22, 7, 2, 0, 25, 7, 4, 0, 9, 0, 8, 6, 3, 7, 3, 2, 0, 19),
(12, 8, 10, 0, 6, 1, 1, 1, 4, 1, 2, 0, 3, 1, 2, 3, 0, 5, 0, 14, 0, 3),
(12, 9, 14, 3, 0, 0, 0, 0, 2, 2, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `instituicao`
--

DROP TABLE IF EXISTS `instituicao`;
CREATE TABLE IF NOT EXISTS `instituicao` (
  `id_instituicao` int NOT NULL AUTO_INCREMENT,
  `nome_instituicao` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tipo_instituicao` enum('pré-mirim','mirim','infantil','infanto juvenil','juvenil','adulto','máster') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_instituicao`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `instituicao`
--

INSERT INTO `instituicao` (`id_instituicao`, `nome_instituicao`, `tipo_instituicao`) VALUES
(6, 'IFSP - Birigui', 'juvenil');

-- --------------------------------------------------------

--
-- Estrutura para tabela `jogador`
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
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `jogador`
--

INSERT INTO `jogador` (`id_jogador`, `nome_jogador`, `apelido_jogador`, `numero_camisa`, `defesa_jogador`, `erro_defesa`, `altura_jogador`, `peso_jogador`, `sexo_jogador`) VALUES
(22, 'Larissa Espinosa Belinello', '', 0, 1, 0, 0.00, 0.00, 'f'),
(23, 'Raíssa Pereira Vargas', '', 16, 8, 5, 0.00, 0.00, 'f'),
(24, 'Evellyn Sversut Barros', '', 7, 4, 2, 0.00, 0.00, 'f'),
(25, 'Lara Vasconcellos', '', 4, 18, 4, 0.00, 0.00, 'f'),
(27, 'Ana Luiza Franzo Domingos', '', 10, 7, 1, 0.00, 0.00, 'f'),
(28, 'Lívia Genari', '', 9, 5, 0, 0.00, 0.00, 'f'),
(29, 'Emilyn Nagate Araujo', '', 1, 14, 3, 0.00, 0.00, 'f'),
(30, 'Ana Carolina Cardoso Freire', 'Carol', 0, 12, 4, 0.00, 0.00, 'f'),
(31, 'Ana Clara Soares', '', 0, 19, 8, 0.00, 0.00, 'f'),
(32, 'Sophia Passos de Oliveira', 'Soso', 0, 19, 3, 0.00, 0.00, 'f'),
(33, 'Joao Gabriel Simões Reis', '', 0, 5, 2, 0.00, 0.00, 'm'),
(34, 'Victor Hugo Toneto dos Santos', 'Vitin', 0, 2, 0, 0.00, 0.00, 'm'),
(35, 'Matheus Henrique Cesario da Silva', 'Bahiano', 0, 0, 0, 0.00, 0.00, 'm'),
(36, 'Alexandre Alves Ferraz', '', 0, 0, 0, 0.00, 0.00, 'm'),
(37, 'João Gabriel da Silva Brissi', 'Brissi', 0, 1, 0, 0.00, 0.00, 'm'),
(38, 'Victor Frigério Laluce', 'Laluce', 0, 0, 0, 0.00, 0.00, 'm'),
(39, 'Daniel Alves de Morais', 'Dani', 0, 15, 1, 0.00, 0.00, 'm'),
(40, 'João Vitor Soares Firme', '', 0, 6, 3, 0.00, 0.00, 'm'),
(41, 'Eduardo Pereira Xavier', 'Du', 0, 36, 5, 0.00, 0.00, 'm'),
(42, 'Aaron Kenzo Hukuda Castro Kanashiro', '', 0, 6, 4, 0.00, 0.00, 'm'),
(43, 'Andrus Neves Roman', '', 17, 2, 1, 0.00, 0.00, 'm');

-- --------------------------------------------------------

--
-- Estrutura para tabela `jogador_no_time`
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
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `jogador_no_time`
--

INSERT INTO `jogador_no_time` (`id_jogador_time`, `id_jogador`, `id_time`, `defesa_jogador_no_time`, `erro_defesa_no_time`, `posicao_jogador`) VALUES
(31, 24, 8, 4, 2, 'oposto'),
(32, 23, 8, 8, 5, 'ponta 2'),
(33, 22, 8, 1, 0, 'central'),
(34, 25, 8, 18, 4, 'líbero'),
(35, 27, 8, 7, 1, 'levantador'),
(36, 29, 8, 14, 3, 'ponta 1'),
(37, 28, 8, 5, 0, 'central'),
(38, 31, 8, 19, 8, 'líbero'),
(39, 30, 8, 12, 4, 'ponta 2'),
(40, 32, 8, 19, 3, 'ponta 2'),
(41, 41, 9, 36, 5, 'líbero'),
(42, 38, 9, 0, 0, 'levantador'),
(43, 35, 9, 0, 0, 'oposto'),
(44, 42, 9, 6, 4, 'ponta 1'),
(45, 43, 9, 2, 1, 'ponta 2'),
(46, 39, 9, 15, 1, 'central'),
(47, 34, 9, 2, 0, 'levantador'),
(48, 36, 9, 0, 0, 'oposto'),
(49, 37, 9, 1, 0, 'central'),
(50, 33, 9, 5, 2, 'central'),
(51, 40, 9, 6, 3, 'central');

-- --------------------------------------------------------

--
-- Estrutura para tabela `levantador`
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

--
-- Despejando dados para a tabela `levantador`
--

INSERT INTO `levantador` (`id_jogador`, `posicao`, `ataque_dentro`, `ataque_fora`, `bloqueio_convertido`, `bloqueio_errado`, `errou_levantamento`, `levantamento_para_oposto`, `levantamento_para_ponta`, `levantamento_para_pipe`, `levantamento_para_centro`, `saque_fora`, `saque_cima`, `saque_flutuante`, `saque_viagem`, `saque_ace`) VALUES
(27, 'levantador', 6, 1, 1, 0, 3, 15, 20, 4, 13, 4, 8, 19, 0, 2),
(34, 'levantador', 0, 1, 0, 0, 3, 12, 13, 0, 7, 5, 0, 4, 5, 0),
(38, 'levantador', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `levantador_no_time`
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

--
-- Despejando dados para a tabela `levantador_no_time`
--

INSERT INTO `levantador_no_time` (`id_jogador_time`, `ataque_dentro_no_time`, `ataque_fora_no_time`, `bloqueio_convertido_no_time`, `bloqueio_errado_no_time`, `levantamento_para_oposto_no_time`, `levantamento_para_pipe_no_time`, `levantamento_para_ponta_no_time`, `levantamento_para_centro_no_time`, `errou_levantamento_no_time`, `saque_fora_no_time`, `saque_ace_no_time`, `saque_cima_no_time`, `saque_viagem_no_time`, `saque_flutuante_no_time`) VALUES
(35, 6, 1, 1, 0, 15, 4, 20, 13, 3, 4, 2, 8, 0, 19),
(42, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(47, 0, 1, 0, 0, 12, 0, 13, 7, 3, 5, 0, 0, 5, 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `libero`
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

--
-- Despejando dados para a tabela `libero`
--

INSERT INTO `libero` (`id_jogador`, `passe_a`, `passe_b`, `passe_c`, `passe_d`, `posicao`) VALUES
(25, 9, 4, 4, 0, 'líbero'),
(31, 1, 4, 5, 2, 'líbero'),
(41, 15, 11, 3, 0, 'líbero');

-- --------------------------------------------------------

--
-- Estrutura para tabela `libero_no_time`
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

--
-- Despejando dados para a tabela `libero_no_time`
--

INSERT INTO `libero_no_time` (`id_jogador_time`, `passe_a_no_time`, `passe_b_no_time`, `passe_c_no_time`, `passe_d_no_time`) VALUES
(34, 9, 4, 4, 0),
(38, 1, 4, 5, 2),
(41, 15, 11, 3, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `outras_posicoes`
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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `outras_posicoes`
--

INSERT INTO `outras_posicoes` (`id_posicao`, `id_jogador`, `passe_a`, `passe_b`, `passe_c`, `passe_d`, `bloqueio_convertido`, `bloqueio_errado`, `ataque_dentro`, `ataque_fora`, `saque_ace`, `saque_cima`, `saque_flutuante`, `saque_viagem`, `saque_fora`, `posicao`) VALUES
(18, 22, 0, 0, 0, 0, 0, 0, 1, 0, 0, 4, 0, 0, 1, 'central'),
(19, 23, 9, 0, 0, 0, 0, 0, 7, 1, 5, 7, 0, 0, 1, 'ponta 2'),
(20, 24, 2, 3, 2, 0, 0, 0, 14, 6, 0, 5, 0, 0, 5, 'oposto'),
(21, 28, 1, 1, 2, 0, 1, 1, 6, 2, 0, 3, 0, 0, 5, 'central'),
(22, 29, 7, 6, 1, 0, 0, 0, 4, 2, 3, 4, 0, 1, 3, 'ponta 1'),
(23, 30, 2, 2, 1, 0, 0, 0, 3, 2, 0, 12, 1, 0, 2, 'ponta 2'),
(24, 32, 9, 3, 1, 1, 0, 0, 2, 3, 0, 8, 0, 0, 3, 'ponta 2'),
(25, 33, 2, 1, 0, 0, 0, 0, 5, 2, 2, 3, 4, 0, 0, 'central'),
(26, 35, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 'oposto'),
(27, 36, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'oposto'),
(28, 37, 1, 0, 0, 0, 2, 0, 2, 1, 0, 1, 0, 0, 1, 'central'),
(29, 39, 11, 0, 2, 0, 1, 0, 5, 0, 2, 0, 2, 0, 2, 'central'),
(30, 40, 6, 1, 0, 0, 3, 1, 3, 2, 2, 0, 5, 0, 2, 'central'),
(31, 42, 5, 1, 0, 0, 0, 0, 9, 2, 2, 0, 6, 7, 0, 'ponta 1'),
(32, 43, 1, 0, 0, 0, 2, 0, 9, 2, 0, 0, 4, 2, 3, 'ponta 2');

-- --------------------------------------------------------

--
-- Estrutura para tabela `outras_posicoes_no_time`
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

--
-- Despejando dados para a tabela `outras_posicoes_no_time`
--

INSERT INTO `outras_posicoes_no_time` (`id_jogador_time`, `ataque_dentro_no_time`, `ataque_fora_no_time`, `bloqueio_convertido_no_time`, `bloqueio_errado_no_time`, `passe_a_no_time`, `passe_b_no_time`, `passe_c_no_time`, `passe_d_no_time`, `saque_fora_no_time`, `saque_ace_no_time`, `saque_cima_no_time`, `saque_viagem_no_time`, `saque_flutuante_no_time`) VALUES
(31, 14, 6, 0, 0, 2, 3, 2, 0, 5, 0, 5, 0, 0),
(32, 7, 1, 0, 0, 9, 0, 0, 0, 1, 5, 7, 0, 0),
(33, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 4, 0, 0),
(36, 4, 2, 0, 0, 7, 6, 1, 0, 3, 3, 4, 1, 0),
(37, 6, 2, 1, 1, 1, 1, 2, 0, 5, 0, 3, 0, 0),
(39, 3, 2, 0, 0, 2, 2, 1, 0, 2, 0, 12, 0, 1),
(40, 2, 3, 0, 0, 9, 3, 1, 1, 3, 0, 8, 0, 0),
(43, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(44, 9, 2, 0, 0, 5, 1, 0, 0, 0, 2, 0, 7, 6),
(45, 9, 2, 2, 0, 1, 0, 0, 0, 3, 0, 0, 2, 4),
(46, 5, 0, 1, 0, 11, 0, 2, 0, 2, 2, 0, 0, 2),
(48, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(49, 2, 1, 2, 0, 1, 0, 0, 0, 1, 0, 1, 0, 0),
(50, 5, 2, 0, 0, 2, 1, 0, 0, 0, 2, 3, 0, 4),
(51, 3, 2, 3, 1, 6, 1, 0, 0, 2, 2, 0, 0, 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `time`
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `time`
--

INSERT INTO `time` (`id_time`, `nome_time`, `data_hora_criacao`, `sexo_time`, `id_usuario`, `id_instituicao`) VALUES
(8, 'Time Oficial 2024 Feminino', '2024-12-04 21:10:28', 'f', 16, 6),
(9, 'Time Oficial 2024 Masculino', '2024-12-04 22:31:52', 'm', 16, 6);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome_usuario`, `email_usuario`, `senha_usuario_site`, `jogador`, `id_jogador`, `treinador`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$RumoBce/TzUVVVBM29fR0OSOY1zAlRpSOtzh99oRPlTkOzQM.F.2e', 0, NULL, 1),
(16, 'Hugo Ap.', 'hugoapga626@gmail.com', '$2y$10$cU93hdArUKazitqcfOMece9UszZh5r/Q9zIAnYeBvsleT0ekgiCOq', 0, NULL, 1),
(17, 'taina', 'taina@gmail.com', '$2y$10$jU8zt198hqAx4.KdFczM/uEOQt9C1HkZCSbNmn16BbAKXjf80HTdS', 0, 42, 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `time`
--
ALTER TABLE `time` ADD FULLTEXT KEY `nome_time` (`nome_time`);

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `competicao`
--
ALTER TABLE `competicao`
  ADD CONSTRAINT `competicao_id_desafiado` FOREIGN KEY (`id_time_desafiado`) REFERENCES `time` (`id_time`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `competicao_time_desafiante` FOREIGN KEY (`id_time_desafiante`) REFERENCES `time` (`id_time`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `competicao_time`
--
ALTER TABLE `competicao_time`
  ADD CONSTRAINT `competicao_competicao` FOREIGN KEY (`id_competicao`) REFERENCES `competicao` (`id_competicao`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `competicao_time` FOREIGN KEY (`id_time`) REFERENCES `time` (`id_time`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `jogador_no_time`
--
ALTER TABLE `jogador_no_time`
  ADD CONSTRAINT `jogador_jogador` FOREIGN KEY (`id_jogador`) REFERENCES `jogador` (`id_jogador`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `time_time` FOREIGN KEY (`id_time`) REFERENCES `time` (`id_time`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `levantador`
--
ALTER TABLE `levantador`
  ADD CONSTRAINT `jogador_levantador` FOREIGN KEY (`id_jogador`) REFERENCES `jogador` (`id_jogador`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `levantador_no_time`
--
ALTER TABLE `levantador_no_time`
  ADD CONSTRAINT `time_levantador` FOREIGN KEY (`id_jogador_time`) REFERENCES `jogador_no_time` (`id_jogador_time`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `libero`
--
ALTER TABLE `libero`
  ADD CONSTRAINT `jogador_libero` FOREIGN KEY (`id_jogador`) REFERENCES `jogador` (`id_jogador`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `libero_no_time`
--
ALTER TABLE `libero_no_time`
  ADD CONSTRAINT `libero_time` FOREIGN KEY (`id_jogador_time`) REFERENCES `jogador_no_time` (`id_jogador_time`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `outras_posicoes`
--
ALTER TABLE `outras_posicoes`
  ADD CONSTRAINT `posicao_jogador` FOREIGN KEY (`id_jogador`) REFERENCES `jogador` (`id_jogador`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `outras_posicoes_no_time`
--
ALTER TABLE `outras_posicoes_no_time`
  ADD CONSTRAINT `outras_posicoes_time` FOREIGN KEY (`id_jogador_time`) REFERENCES `jogador_no_time` (`id_jogador_time`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `time`
--
ALTER TABLE `time`
  ADD CONSTRAINT `time_instituicao` FOREIGN KEY (`id_instituicao`) REFERENCES `instituicao` (`id_instituicao`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_time` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
