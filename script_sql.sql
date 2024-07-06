CREATE TABLE Time (
  id_time INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  Usuario_id_usuario INTEGER UNSIGNED NOT NULL,
  nome_time VARCHAR(60) NOT NULL,
  data_hora_criacao DATETIME NOT NULL,
  sexo_time VARCHAR(3) NOT NULL,
  PRIMARY KEY(id_time),
  INDEX Time_FKIndex1(Usuario_id_usuario)
);

CREATE TABLE Time_has_Time (
  Time_id_time INTEGER UNSIGNED NOT NULL,
  PRIMARY KEY(Time_id_time),
  INDEX Time_has_Time_FKIndex1(Time_id_time),
  INDEX Time_has_Time_FKIndex2(Time_id_time)
);

CREATE TABLE Usuario (
  id_usuario INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  nome_usuario VARCHAR(60) NULL,
  jogador BOOL NULL,
  senha_usuario VARCHAR NULL,
  PRIMARY KEY(id_usuario)
);


