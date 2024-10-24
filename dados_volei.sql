-- phpmyadmin sql dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- host: 127.0.0.1:3306
-- tempo de geração: 14-out-2024 às 13:32
-- versão do servidor: 8.0.31
-- versão do php: 8.0.26


set sql_mode = "no_auto_value_on_zero";

start transaction;

set time_zone = "+00:00";

/*!40101 set @old_character_set_client=@@character_set_client */;

/*!40101 set @old_character_set_results=@@character_set_results */;

/*!40101 set @old_collation_connection=@@collation_connection */;

/*!40101 set names utf8mb4 */;

--
-- banco de dados: `dados_volei`
--


-- --------------------------------------------------------


--
-- estrutura da tabela `competicao`
--


DROP TABLE IF EXISTS `COMPETICAO`;

CREATE TABLE IF NOT EXISTS `COMPETICAO` (
  `ID_COMPETICAO` INT NOT NULL AUTO_INCREMENT,
  `ID_TIME_DESAFIANTE` INT NOT NULL,
  `ID_TIME_DESAFIADO` INT DEFAULT NULL,
  `DATA_HORA_COMPETICAO` DATETIME NOT NULL,
  `NOME_COMPETICAO` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`ID_COMPETICAO`),
  KEY `COMPETICAO_ID_DESAFIADO` (`ID_TIME_DESAFIADO`),
  KEY `COMPETICAO_TIME_DESAFIANTE` (`ID_TIME_DESAFIANTE`)
) ENGINE=INNODB DEFAULT CHARSET=UTF8MB4 COLLATE=UTF8MB4_0900_AI_CI;

-- --------------------------------------------------------


--
-- estrutura da tabela `competicao_time`
--


DROP TABLE IF EXISTS `COMPETICAO_TIME`;

CREATE TABLE IF NOT EXISTS `COMPETICAO_TIME` (
  `ID_COMPETICAO` INT NOT NULL,
  `ID_TIME` INT NOT NULL,
  `DEFESA_NO_TIME` INT UNSIGNED NOT NULL DEFAULT '0',
  `ATAQUE_DENTRO_NO_TIME` INT UNSIGNED DEFAULT '0',
  `ATAQUE_FORA_NO_TIME` INT UNSIGNED DEFAULT '0',
  `BLOQUEIO_CONVERTIDO_NO_TIME` INT UNSIGNED DEFAULT '0',
  `BLOQUEIO_ERRADO_NO_TIME` INT UNSIGNED DEFAULT '0',
  `PASSE_A_NO_TIME` INT UNSIGNED DEFAULT '0',
  `PASSE_B_NO_TIME` INT UNSIGNED DEFAULT '0',
  `PASSE_C_NO_TIME` INT UNSIGNED DEFAULT '0',
  `PASSE_D_NO_TIME` INT UNSIGNED DEFAULT '0',
  `LEVANTAMENTO_PARA_OPOSTO_NO_TIME` INT UNSIGNED DEFAULT '0',
  `LEVANTAMENTO_PARA_PIPE_NO_TIME` INT UNSIGNED DEFAULT '0',
  `LEVANTAMENTO_PARA_PONTA_NO_TIME` INT UNSIGNED DEFAULT '0',
  `LEVANTAMENTO_PARA_CENTRO_NO_TIME` INT UNSIGNED DEFAULT '0',
  `ERROU_LEVANTAMENTO_NO_TIME` INT UNSIGNED DEFAULT '0',
  `SAQUE_FORA_NO_TIME` INT UNSIGNED DEFAULT '0',
  `SAQUE_ACE_CIMA_NO_TIME` INT UNSIGNED DEFAULT '0',
  `SAQUE_ACE_VIAGEM_NO_TIME` INT UNSIGNED DEFAULT '0',
  `SAQUE_ACE_FLUTUANTE_NO_TIME` INT UNSIGNED DEFAULT '0',
  `SAQUE_CIMA_NO_TIME` INT UNSIGNED DEFAULT '0',
  `SAQUE_VIAGEM_NO_TIME` INT UNSIGNED DEFAULT '0',
  `SAQUE_FLUTUANTE_NO_TIME` INT UNSIGNED DEFAULT '0',
  PRIMARY KEY (`ID_COMPETICAO`, `ID_TIME`),
  KEY `COMPETICAO_TIME` (`ID_TIME`)
) ENGINE=INNODB DEFAULT CHARSET=UTF8MB4 COLLATE=UTF8MB4_0900_AI_CI;

-- --------------------------------------------------------


--
-- estrutura da tabela `instituicao`
--


DROP TABLE IF EXISTS `INSTITUICAO`;

CREATE TABLE IF NOT EXISTS `INSTITUICAO` (
  `ID_INSTITUICAO` INT NOT NULL AUTO_INCREMENT,
  `NOME_INSTITUICAO` VARCHAR(200) CHARACTER SET UTF8MB4 COLLATE UTF8MB4_GENERAL_CI NOT NULL,
  `TIPO_INSTITUICAO` ENUM('pré-mirim', 'mirim', 'infantil', 'infanto juvenil', 'juvenil', 'adulto', 'máster') CHARACTER SET UTF8MB4 COLLATE UTF8MB4_GENERAL_CI NOT NULL,
  PRIMARY KEY (`ID_INSTITUICAO`)
) ENGINE=INNODB AUTO_INCREMENT=6 DEFAULT CHARSET=UTF8MB4 COLLATE=UTF8MB4_GENERAL_CI;

-- --------------------------------------------------------


--
-- estrutura da tabela `jogador`
--


DROP TABLE IF EXISTS `JOGADOR`;

CREATE TABLE IF NOT EXISTS `JOGADOR` (
  `ID_JOGADOR` INT NOT NULL AUTO_INCREMENT,
  `NOME_JOGADOR` VARCHAR(80) CHARACTER SET UTF8MB4 COLLATE UTF8MB4_GENERAL_CI NOT NULL,
  `APELIDO_JOGADOR` VARCHAR(80) CHARACTER SET UTF8MB4 COLLATE UTF8MB4_GENERAL_CI DEFAULT NULL,
  `NUMERO_CAMISA` INT UNSIGNED DEFAULT NULL,
  `DEFESA_JOGADOR` INT UNSIGNED NOT NULL DEFAULT '0',
  `ERRO_DEFESA` INT UNSIGNED NOT NULL DEFAULT '0',
  `ALTURA_JOGADOR` DECIMAL(2, 2) DEFAULT NULL,
  `PESO_JOGADOR` DECIMAL(3, 2) DEFAULT NULL,
  `SEXO_JOGADOR` ENUM('m', 'f') CHARACTER SET UTF8MB4 COLLATE UTF8MB4_GENERAL_CI DEFAULT NULL,
  PRIMARY KEY (`ID_JOGADOR`)
) ENGINE=INNODB AUTO_INCREMENT=18 DEFAULT CHARSET=UTF8MB4 COLLATE=UTF8MB4_GENERAL_CI;

-- --------------------------------------------------------


--
-- estrutura da tabela `jogador_no_time`
--


DROP TABLE IF EXISTS `JOGADOR_NO_TIME`;

CREATE TABLE IF NOT EXISTS `JOGADOR_NO_TIME` (
  `ID_JOGADOR_TIME` INT NOT NULL AUTO_INCREMENT,
  `ID_JOGADOR` INT NOT NULL,
  `ID_TIME` INT NOT NULL,
  `DEFESA_JOGADOR_NO_TIME` INT UNSIGNED NOT NULL DEFAULT '0',
  `ERRO_DEFESA_NO_TIME` INT UNSIGNED NOT NULL DEFAULT '0',
  `POSICAO_JOGADOR` ENUM('líbero', 'levantador', 'oposto', 'central', 'ponta 1', 'ponta 2', 'não definida') CHARACTER SET UTF8MB4 COLLATE UTF8MB4_GENERAL_CI NOT NULL,
  PRIMARY KEY (`ID_JOGADOR_TIME`),
  KEY `JOGADOR_JOGADOR` (`ID_JOGADOR`),
  KEY `TIME_TIME` (`ID_TIME`)
) ENGINE=INNODB AUTO_INCREMENT=6 DEFAULT CHARSET=UTF8MB4 COLLATE=UTF8MB4_GENERAL_CI;

-- --------------------------------------------------------


--
-- estrutura da tabela `levantador`
--


DROP TABLE IF EXISTS `LEVANTADOR`;

CREATE TABLE IF NOT EXISTS `LEVANTADOR` (
  `ID_JOGADOR` INT NOT NULL,
  `POSICAO` CHAR(10) CHARACTER SET UTF8MB4 COLLATE UTF8MB4_GENERAL_CI NOT NULL DEFAULT 'levantador',
  `ATAQUE_DENTRO` INT UNSIGNED NOT NULL DEFAULT '0',
  `ATAQUE_FORA` INT UNSIGNED NOT NULL DEFAULT '0',
  `BLOQUEIO_CONVERTIDO` INT UNSIGNED NOT NULL DEFAULT '0',
  `BLOQUEIO_ERRADO` INT UNSIGNED NOT NULL DEFAULT '0',
  `ERROU_LEVANTAMENTO` INT UNSIGNED NOT NULL DEFAULT '0',
  `LEVANTAMENTO_PARA_OPOSTO` INT UNSIGNED NOT NULL DEFAULT '0',
  `LEVANTAMENTO_PARA_PONTA` INT UNSIGNED NOT NULL DEFAULT '0',
  `LEVANTAMENTO_PARA_PIPE` INT UNSIGNED NOT NULL DEFAULT '0',
  `LEVANTAMENTO_PARA_CENTRO` INT UNSIGNED NOT NULL DEFAULT '0',
  `SAQUE_FORA` INT UNSIGNED NOT NULL DEFAULT '0',
  `SAQUE_CIMA` INT UNSIGNED NOT NULL DEFAULT '0',
  `SAQUE_FLUTUANTE` INT UNSIGNED NOT NULL DEFAULT '0',
  `SAQUE_VIAGEM` INT UNSIGNED NOT NULL DEFAULT '0',
  `SAQUE_ACE` INT UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_JOGADOR`)
) ENGINE=INNODB DEFAULT CHARSET=UTF8MB4 COLLATE=UTF8MB4_GENERAL_CI;

-- --------------------------------------------------------


--
-- estrutura da tabela `levantador_no_time`
--


DROP TABLE IF EXISTS `LEVANTADOR_NO_TIME`;

CREATE TABLE IF NOT EXISTS `LEVANTADOR_NO_TIME` (
  `ID_JOGADOR_TIME` INT NOT NULL,
  `ATAQUE_DENTRO_NO_TIME` INT UNSIGNED NOT NULL DEFAULT '0',
  `ATAQUE_FORA_NO_TIME` INT UNSIGNED DEFAULT '0',
  `BLOQUEIO_CONVERTIDO_NO_TIME` INT UNSIGNED DEFAULT '0',
  `BLOQUEIO_ERRADO_NO_TIME` INT UNSIGNED DEFAULT '0',
  `LEVANTAMENTO_PARA_OPOSTO_NO_TIME` INT UNSIGNED DEFAULT '0',
  `LEVANTAMENTO_PARA_PIPE_NO_TIME` INT UNSIGNED DEFAULT '0',
  `LEVANTAMENTO_PARA_PONTA_NO_TIME` INT UNSIGNED DEFAULT '0',
  `LEVANTAMENTO_PARA_CENTRO_NO_TIME` INT UNSIGNED DEFAULT '0',
  `ERROU_LEVANTAMENTO_NO_TIME` INT UNSIGNED DEFAULT '0',
  `SAQUE_FORA_NO_TIME` INT UNSIGNED DEFAULT '0',
  `SAQUE_ACE_NO_TIME` INT UNSIGNED DEFAULT '0',
  `SAQUE_CIMA_NO_TIME` INT UNSIGNED DEFAULT '0',
  `SAQUE_VIAGEM_NO_TIME` INT UNSIGNED DEFAULT '0',
  `SAQUE_FLUTUANTE_NO_TIME` INT UNSIGNED DEFAULT '0',
  PRIMARY KEY (`ID_JOGADOR_TIME`)
) ENGINE=INNODB DEFAULT CHARSET=UTF8MB4 COLLATE=UTF8MB4_0900_AI_CI;

-- --------------------------------------------------------


--
-- estrutura da tabela `libero`
--


DROP TABLE IF EXISTS `LIBERO`;

CREATE TABLE IF NOT EXISTS `LIBERO` (
  `ID_JOGADOR` INT NOT NULL,
  `PASSE_A` INT UNSIGNED NOT NULL DEFAULT '0',
  `PASSE_B` INT UNSIGNED NOT NULL DEFAULT '0',
  `PASSE_C` INT UNSIGNED NOT NULL DEFAULT '0',
  `PASSE_D` INT UNSIGNED NOT NULL DEFAULT '0',
  `POSICAO` CHAR(6) CHARACTER SET UTF8MB4 COLLATE UTF8MB4_GENERAL_CI NOT NULL DEFAULT 'líbero',
  PRIMARY KEY (`ID_JOGADOR`)
) ENGINE=INNODB DEFAULT CHARSET=UTF8MB4 COLLATE=UTF8MB4_GENERAL_CI;

-- --------------------------------------------------------


--
-- estrutura da tabela `libero_no_time`
--


DROP TABLE IF EXISTS `LIBERO_NO_TIME`;

CREATE TABLE IF NOT EXISTS `LIBERO_NO_TIME` (
  `ID_JOGADOR_TIME` INT NOT NULL,
  `PASSE_A_NO_TIME` INT UNSIGNED DEFAULT '0',
  `PASSE_B_NO_TIME` INT UNSIGNED DEFAULT '0',
  `PASSE_C_NO_TIME` INT UNSIGNED DEFAULT '0',
  `PASSE_D_NO_TIME` INT UNSIGNED DEFAULT '0',
  PRIMARY KEY (`ID_JOGADOR_TIME`)
) ENGINE=INNODB DEFAULT CHARSET=UTF8MB4 COLLATE=UTF8MB4_0900_AI_CI;

-- --------------------------------------------------------


--
-- estrutura da tabela `outras_posicoes`
--


DROP TABLE IF EXISTS `OUTRAS_POSICOES`;

CREATE TABLE IF NOT EXISTS `OUTRAS_POSICOES` (
  `ID_POSICAO` INT NOT NULL AUTO_INCREMENT,
  `ID_JOGADOR` INT NOT NULL,
  `PASSE_A` INT UNSIGNED NOT NULL DEFAULT '0',
  `PASSE_B` INT UNSIGNED NOT NULL DEFAULT '0',
  `PASSE_C` INT UNSIGNED NOT NULL DEFAULT '0',
  `PASSE_D` INT UNSIGNED NOT NULL DEFAULT '0',
  `BLOQUEIO_CONVERTIDO` INT UNSIGNED NOT NULL DEFAULT '0',
  `BLOQUEIO_ERRADO` INT UNSIGNED NOT NULL DEFAULT '0',
  `ATAQUE_DENTRO` INT UNSIGNED NOT NULL DEFAULT '0',
  `ATAQUE_FORA` INT UNSIGNED NOT NULL DEFAULT '0',
  `SAQUE_ACE` INT UNSIGNED NOT NULL DEFAULT '0',
  `SAQUE_CIMA` INT UNSIGNED NOT NULL DEFAULT '0',
  `SAQUE_FLUTUANTE` INT UNSIGNED NOT NULL DEFAULT '0',
  `SAQUE_VIAGEM` INT UNSIGNED NOT NULL DEFAULT '0',
  `SAQUE_FORA` INT UNSIGNED NOT NULL DEFAULT '0',
  `POSICAO` ENUM('oposto', 'central', 'ponta 1', 'ponta 2', 'não definida') CHARACTER SET UTF8MB4 COLLATE UTF8MB4_GENERAL_CI NOT NULL,
  PRIMARY KEY (`ID_POSICAO`),
  KEY `POSICAO_JOGADOR` (`ID_JOGADOR`)
) ENGINE=INNODB AUTO_INCREMENT=5 DEFAULT CHARSET=UTF8MB4 COLLATE=UTF8MB4_GENERAL_CI;

-- --------------------------------------------------------


--
-- estrutura da tabela `outras_posicoes_no_time`
--


DROP TABLE IF EXISTS `OUTRAS_POSICOES_NO_TIME`;

CREATE TABLE IF NOT EXISTS `OUTRAS_POSICOES_NO_TIME` (
  `ID_JOGADOR_TIME` INT NOT NULL,
  `ATAQUE_DENTRO_NO_TIME` INT UNSIGNED DEFAULT '0',
  `ATAQUE_FORA_NO_TIME` INT UNSIGNED DEFAULT '0',
  `BLOQUEIO_CONVERTIDO_NO_TIME` INT UNSIGNED DEFAULT '0',
  `BLOQUEIO_ERRADO_NO_TIME` INT UNSIGNED DEFAULT '0',
  `PASSE_A_NO_TIME` INT UNSIGNED DEFAULT '0',
  `PASSE_B_NO_TIME` INT UNSIGNED DEFAULT '0',
  `PASSE_C_NO_TIME` INT UNSIGNED DEFAULT '0',
  `PASSE_D_NO_TIME` INT UNSIGNED DEFAULT '0',
  `SAQUE_FORA_NO_TIME` INT UNSIGNED DEFAULT '0',
  `SAQUE_ACE_NO_TIME` INT UNSIGNED DEFAULT '0',
  `SAQUE_CIMA_NO_TIME` INT UNSIGNED DEFAULT '0',
  `SAQUE_VIAGEM_NO_TIME` INT UNSIGNED DEFAULT '0',
  `SAQUE_FLUTUANTE_NO_TIME` INT UNSIGNED DEFAULT '0',
  PRIMARY KEY (`ID_JOGADOR_TIME`)
) ENGINE=INNODB DEFAULT CHARSET=UTF8MB4 COLLATE=UTF8MB4_0900_AI_CI;

-- --------------------------------------------------------


--
-- estrutura da tabela `time`
--


DROP TABLE IF EXISTS `TIME`;

CREATE TABLE IF NOT EXISTS `TIME` (
  `ID_TIME` INT NOT NULL AUTO_INCREMENT,
  `NOME_TIME` VARCHAR(100) CHARACTER SET UTF8MB4 COLLATE UTF8MB4_GENERAL_CI NOT NULL,
  `DATA_HORA_CRIACAO` DATETIME NOT NULL,
  `SEXO_TIME` ENUM('m', 'f', 'mis') CHARACTER SET UTF8MB4 COLLATE UTF8MB4_GENERAL_CI NOT NULL,
  `ID_USUARIO` INT NULL,
  `ID_INSTITUICAO` INT NOT NULL,
  PRIMARY KEY (`ID_TIME`),
  KEY `TIME_USUARIO` (`ID_USUARIO`),
  KEY `TIME_INSTITUICAO` (`ID_INSTITUICAO`)
) ENGINE=INNODB AUTO_INCREMENT=10 DEFAULT CHARSET=UTF8MB4 COLLATE=UTF8MB4_GENERAL_CI;

-- --------------------------------------------------------


--
-- estrutura da tabela `usuario`
--


DROP TABLE IF EXISTS `USUARIO`;

CREATE TABLE IF NOT EXISTS `USUARIO` (
  `ID_USUARIO` INT NOT NULL AUTO_INCREMENT,
  `NOME_USUARIO` VARCHAR(80) CHARACTER SET UTF8MB4 COLLATE UTF8MB4_GENERAL_CI NOT NULL,
  `EMAIL_USUARIO` VARCHAR(100) COLLATE UTF8MB4_GENERAL_CI NOT NULL,
  `SENHA_USUARIO_SITE` VARCHAR(255) CHARACTER SET UTF8MB4 COLLATE UTF8MB4_GENERAL_CI NOT NULL,
  `JOGADOR` TINYINT(1) NOT NULL,
  `ID_JOGADOR` INT DEFAULT NULL,
  `TREINADOR` TINYINT(1) NOT NULL,
  PRIMARY KEY (`ID_USUARIO`)
) ENGINE=INNODB AUTO_INCREMENT=12 DEFAULT CHARSET=UTF8MB4 COLLATE=UTF8MB4_GENERAL_CI;

--
-- extraindo dados da tabela `usuario`
--


INSERT INTO `USUARIO` (
  `ID_USUARIO`,
  `NOME_USUARIO`,
  `EMAIL_USUARIO`,
  `SENHA_USUARIO_SITE`,
  `JOGADOR`,
  `ID_JOGADOR`,
  `TREINADOR`
) VALUES (
  1,
  'hugo aparecido',
  'hugoapga626@gmail.com',
  '$2y$10$epdrr6drnasg.ffkfaevxeflica2.aymo4ol3idtr0qru5xkhuh52',
  0,
  1,
  1
),
(
  2,
  'hugo teste',
  'testehugo@gamil.com',
  '$2y$10$t8n6oak1hfmpi6wcjyff0ouyjhyr6prrib/ipnvnrz00dwmm02wzm',
  0,
  1,
  0
);

--
-- restrições para despejos de tabelas
--


--
-- limitadores para a tabela `competicao`
--
ALTER TABLE `COMPETICAO`
  ADD CONSTRAINT `COMPETICAO_ID_DESAFIADO` FOREIGN KEY (
    `ID_TIME_DESAFIADO`
  )
    REFERENCES `TIME` (
      `ID_TIME`
    ) ON DELETE CASCADE ON UPDATE CASCADE, ADD CONSTRAINT `COMPETICAO_TIME_DESAFIANTE` FOREIGN KEY (
      `ID_TIME_DESAFIANTE`
    )
      REFERENCES `TIME` (
        `ID_TIME`
      ) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- limitadores para a tabela `competicao_time`
--
ALTER TABLE `COMPETICAO_TIME`
  ADD CONSTRAINT `COMPETICAO_COMPETICAO` FOREIGN KEY (
    `ID_COMPETICAO`
  )
    REFERENCES `COMPETICAO` (
      `ID_COMPETICAO`
    ) ON DELETE RESTRICT ON UPDATE RESTRICT, ADD CONSTRAINT `COMPETICAO_TIME` FOREIGN KEY (
      `ID_TIME`
    )
      REFERENCES `TIME` (
        `ID_TIME`
      ) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- limitadores para a tabela `jogador_no_time`
--
ALTER TABLE `JOGADOR_NO_TIME`
  ADD CONSTRAINT `JOGADOR_JOGADOR` FOREIGN KEY (
    `ID_JOGADOR`
  )
    REFERENCES `JOGADOR` (
      `ID_JOGADOR`
    ) ON DELETE CASCADE ON UPDATE CASCADE, ADD CONSTRAINT `TIME_TIME` FOREIGN KEY (
      `ID_TIME`
    )
      REFERENCES `TIME` (
        `ID_TIME`
      ) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- limitadores para a tabela `levantador`
--
ALTER TABLE `LEVANTADOR`
  ADD CONSTRAINT `JOGADOR_LEVANTADOR` FOREIGN KEY (
    `ID_JOGADOR`
  )
    REFERENCES `JOGADOR` (
      `ID_JOGADOR`
    ) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- limitadores para a tabela `levantador_no_time`
--
ALTER TABLE `LEVANTADOR_NO_TIME`
  ADD CONSTRAINT `TIME_LEVANTADOR` FOREIGN KEY (
    `ID_JOGADOR_TIME`
  )
    REFERENCES `JOGADOR_NO_TIME` (
      `ID_JOGADOR_TIME`
    ) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- limitadores para a tabela `libero`
--
ALTER TABLE `LIBERO`
  ADD CONSTRAINT `JOGADOR_LIBERO` FOREIGN KEY (
    `ID_JOGADOR`
  )
    REFERENCES `JOGADOR` (
      `ID_JOGADOR`
    ) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- limitadores para a tabela `libero_no_time`
--
ALTER TABLE `LIBERO_NO_TIME`
  ADD CONSTRAINT `LIBERO_TIME` FOREIGN KEY (
    `ID_JOGADOR_TIME`
  )
    REFERENCES `JOGADOR_NO_TIME` (
      `ID_JOGADOR_TIME`
    ) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- limitadores para a tabela `outras_posicoes`
--
ALTER TABLE `OUTRAS_POSICOES`
  ADD CONSTRAINT `POSICAO_JOGADOR` FOREIGN KEY (
    `ID_JOGADOR`
  )
    REFERENCES `JOGADOR` (
      `ID_JOGADOR`
    ) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- limitadores para a tabela `outras_posicoes_no_time`
--
ALTER TABLE `OUTRAS_POSICOES_NO_TIME`
  ADD CONSTRAINT `OUTRAS_POSICOES_TIME` FOREIGN KEY (
    `ID_JOGADOR_TIME`
  )
    REFERENCES `JOGADOR_NO_TIME` (
      `ID_JOGADOR_TIME`
    ) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- limitadores para a tabela `time`
--
ALTER TABLE `TIME`
  ADD CONSTRAINT `TIME_INSTITUICAO` FOREIGN KEY (
    `ID_INSTITUICAO`
  )
    REFERENCES `INSTITUICAO` (
      `ID_INSTITUICAO`
    ) ON DELETE CASCADE ON UPDATE CASCADE, ADD CONSTRAINT `TIME_USUARIO` FOREIGN KEY (
      `ID_USUARIO`
    )
      REFERENCES `USUARIO` (
        `ID_USUARIO`
      ) ON DELETE SET NULL ON UPDATE SET NULL;

COMMIT;

/*!40101 set character_set_client=@old_character_set_client */;

/*!40101 set character_set_results=@old_character_set_results */;

/*!40101 set collation_connection=@old_collation_connection */;