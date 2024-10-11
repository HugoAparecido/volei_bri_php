-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 11-Out-2024 às 23:36
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
  KEY `competicao_time_desafiante` (`id_time_desafiante`),
  KEY `competicao_id_desafiado` (`id_time_desafiado`)
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
  `posicao_jogador` enum('Líbero','Levantador','Oposto','Central','Ponta 1','Ponta 2','Não definida') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `saque_fora_no_time` int UNSIGNED DEFAULT '0',
  `saque_ace_cima_no_time` int UNSIGNED DEFAULT '0',
  `saque_ace_viagem_no_time` int UNSIGNED DEFAULT '0',
  `saque_ace_flutuante_no_time` int UNSIGNED DEFAULT '0',
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `instituicao`
--

INSERT INTO `instituicao` (`id_instituicao`, `nome_instituicao`, `tipo_instituicao`) VALUES
(4, 'SESC-BAURU', 'máster'),
(5, 'IFSP - Birigui', 'juvenil');

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
  `altura_jogador` decimal(2,2) DEFAULT NULL,
  `peso_jogador` decimal(3,2) DEFAULT NULL,
  `sexo_jogador` enum('M','F') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_jogador`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `jogador`
--

INSERT INTO `jogador` (`id_jogador`, `nome_jogador`, `apelido_jogador`, `numero_camisa`, `defesa_jogador`, `altura_jogador`, `peso_jogador`, `sexo_jogador`) VALUES
(13, 'Aaron Kenzo Hukuda Castro Kanashiro', '', 9, 0, '0.00', '0.00', 'M'),
(14, 'Andrus Neves Roman', '', 17, 0, '0.00', '0.00', 'M'),
(15, 'Daniel Alves de Morais', '', 10, 0, '0.00', '0.00', 'M'),
(16, 'Eduardo Pereira Xavier', 'Dudu', 12, 0, '0.00', '0.00', 'M'),
(17, 'Victor Hugo Toneto dos Santos', '', 1, 0, '0.00', '0.00', 'M');

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
  `posicao_jogador` enum('Líbero','Levantador','Oposto','Central','Ponta 1','Ponta 2','Não definida') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `saque_fora_no_time` int UNSIGNED DEFAULT '0',
  `saque_ace_no_time` int UNSIGNED DEFAULT '0',
  `saque_cima_no_time` int UNSIGNED DEFAULT '0',
  `saque_viagem_no_time` int UNSIGNED DEFAULT '0',
  `saque_flutuante_no_time` int UNSIGNED DEFAULT '0',
  PRIMARY KEY (`id_jogador_time`),
  KEY `jogador_jogador` (`id_jogador`),
  KEY `time_time` (`id_time`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `jogador_no_time`
--

INSERT INTO `jogador_no_time` (`id_jogador_time`, `id_jogador`, `id_time`, `defesa_jogador_no_time`, `erro_defesa_no_time`, `ataque_dentro_no_time`, `ataque_fora_no_time`, `bloqueio_convertido_no_time`, `bloqueio_errado_no_time`, `passe_a_no_time`, `passe_b_no_time`, `passe_c_no_time`, `passe_d_no_time`, `levantamento_para_oposto_no_time`, `levantamento_para_pipe_no_time`, `levantamento_para_ponta_no_time`, `levantamento_para_centro_no_time`, `errou_levantamento_no_time`, `posicao_jogador`, `saque_fora_no_time`, `saque_ace_no_time`, `saque_cima_no_time`, `saque_viagem_no_time`, `saque_flutuante_no_time`) VALUES
(1, 14, 7, 3, 2, 1, 1, 1, 1, 2, 2, 2, 1, 0, 0, 0, 0, 0, 'Oposto', 2, 1, 2, 1, 2),
(2, 13, 7, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 'Ponta 1', 1, 1, 1, 1, 1),
(3, 15, 7, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 'Central', 1, 1, 1, 1, 1),
(4, 16, 7, 1, 1, 0, 0, 0, 0, 1, 1, 1, 1, 0, 0, 0, 0, 0, 'Líbero', 0, 0, 0, 0, 0),
(5, 17, 7, 2, 2, 2, 2, 2, 2, 0, 0, 0, 0, 2, 2, 2, 2, 2, 'Levantador', 2, 2, 2, 2, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `levantador`
--

DROP TABLE IF EXISTS `levantador`;
CREATE TABLE IF NOT EXISTS `levantador` (
  `id_jogador` int NOT NULL,
  `posicao` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Levantador',
  `ataque_dentro` int UNSIGNED NOT NULL DEFAULT '0',
  `ataque_errado` int UNSIGNED NOT NULL DEFAULT '0',
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
  `saque_cima_ace` int UNSIGNED NOT NULL DEFAULT '0',
  `saque_flutuante_ace` int UNSIGNED NOT NULL DEFAULT '0',
  `saque_viagem_ace` int UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_jogador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `levantador`
--

INSERT INTO `levantador` (`id_jogador`, `posicao`, `ataque_dentro`, `ataque_errado`, `bloqueio_convertido`, `bloqueio_errado`, `errou_levantamento`, `levantamento_para_oposto`, `levantamento_para_ponta`, `levantamento_para_pipe`, `levantamento_para_centro`, `saque_fora`, `saque_cima`, `saque_flutuante`, `saque_viagem`, `saque_cima_ace`, `saque_flutuante_ace`, `saque_viagem_ace`) VALUES
(17, 'Levantador', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

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
  `posicao` char(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Líbero',
  PRIMARY KEY (`id_jogador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `libero`
--

INSERT INTO `libero` (`id_jogador`, `passe_a`, `passe_b`, `passe_c`, `passe_d`, `posicao`) VALUES
(16, 0, 0, 0, 0, 'Líbero');

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
  `saque_ace_cima` int UNSIGNED NOT NULL DEFAULT '0',
  `saque_ace_flutuante` int UNSIGNED NOT NULL DEFAULT '0',
  `saque_ace_viagem` int UNSIGNED NOT NULL DEFAULT '0',
  `saque_cima` int UNSIGNED NOT NULL DEFAULT '0',
  `saque_flutuante` int UNSIGNED NOT NULL DEFAULT '0',
  `saque_viagem` int UNSIGNED NOT NULL DEFAULT '0',
  `saque_errado` int UNSIGNED NOT NULL DEFAULT '0',
  `posicao` enum('Oposto','Central','Ponta 1','Ponta 2','Não Definida') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_posicao`),
  KEY `posicao_jogador` (`id_jogador`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `outras_posicoes`
--

INSERT INTO `outras_posicoes` (`id_posicao`, `id_jogador`, `passe_a`, `passe_b`, `passe_c`, `passe_d`, `bloqueio_convertido`, `bloqueio_errado`, `ataque_dentro`, `ataque_fora`, `saque_ace_cima`, `saque_ace_flutuante`, `saque_ace_viagem`, `saque_cima`, `saque_flutuante`, `saque_viagem`, `saque_errado`, `posicao`) VALUES
(1, 13, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Ponta 1'),
(2, 14, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Ponta 2'),
(3, 14, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Oposto'),
(4, 15, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Central');

-- --------------------------------------------------------

--
-- Estrutura da tabela `time`
--

DROP TABLE IF EXISTS `time`;
CREATE TABLE IF NOT EXISTS `time` (
  `id_time` int NOT NULL AUTO_INCREMENT,
  `nome_time` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `data_hora_criacao` datetime NOT NULL,
  `sexo_time` enum('M','F','MIS') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_usuario` int NOT NULL,
  `id_instituicao` int NOT NULL,
  PRIMARY KEY (`id_time`),
  KEY `time_usuario` (`id_usuario`),
  KEY `time_instituicao` (`id_instituicao`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `time`
--

INSERT INTO `time` (`id_time`, `nome_time`, `data_hora_criacao`, `sexo_time`, `id_usuario`, `id_instituicao`) VALUES
(7, 'teste', '2024-10-10 16:42:12', 'M', 9, 5),
(8, 'teste', '2024-10-10 16:46:39', 'F', 9, 5),
(9, 'teste', '2024-10-10 16:46:45', 'MIS', 9, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `nome_usuario` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email_usuario` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `senha_usuario_site` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jogador` tinyint(1) NOT NULL,
  `id_jogador` int DEFAULT NULL,
  `treinador` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome_usuario`, `email_usuario`, `senha_usuario_site`, `jogador`, `id_jogador`, `treinador`) VALUES
(9, 'Hugo Aparecido', 'hugoapga626@gmail.com', '$2y$10$EpdrR6dRNasg.FFkfaEvXeflIca2.AyMo4ol3iDTR0qRu5XkHUh52', 0, 1, 1),
(10, 'Aaron', 'kenzo@gmail.com', '$2y$10$9fwXcnpN0sRv3MwusNNqNej7buR7VfGJacrOXucIoAvOoxk4lab.O', 1, 6, 0),
(11, 'Hugo Teste', 'testehugo@gamil.com', '$2y$10$T8n6oak1HFMpI6wCjYFF0OuyJhYr6pRRIb/IPNVNrz00DWMM02wZm', 0, 1, 0);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `competicao`
--
ALTER TABLE `competicao`
  ADD CONSTRAINT `competicao_id_desafiado` FOREIGN KEY (`id_time_desafiado`) REFERENCES `time` (`id_time`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `competicao_time_desafiante` FOREIGN KEY (`id_time_desafiante`) REFERENCES `time` (`id_time`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Limitadores para a tabela `competicao_time`
--
ALTER TABLE `competicao_time`
  ADD CONSTRAINT `competicao_competicao` FOREIGN KEY (`id_competicao`) REFERENCES `competicao` (`id_competicao`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `competicao_time` FOREIGN KEY (`id_time`) REFERENCES `time` (`id_time`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Limitadores para a tabela `jogador_no_time`
--
ALTER TABLE `jogador_no_time`
  ADD CONSTRAINT `jogador_jogador` FOREIGN KEY (`id_jogador`) REFERENCES `jogador` (`id_jogador`),
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
  ADD CONSTRAINT `posicao_jogador` FOREIGN KEY (`id_jogador`) REFERENCES `jogador` (`id_jogador`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `time`
--
ALTER TABLE `time`
  ADD CONSTRAINT `time_instituicao` FOREIGN KEY (`id_instituicao`) REFERENCES `instituicao` (`id_instituicao`),
  ADD CONSTRAINT `time_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
