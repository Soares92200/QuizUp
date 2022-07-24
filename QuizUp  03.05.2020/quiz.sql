DROP  DATABASE IF  EXISTS quizUp;
CREATE DATABASE IF NOT EXISTS  quizUp; 
USE quizUp;
CREATE TABLE usuario(
	idUser INT PRIMARY KEY AUTO_INCREMENT,
	user VARCHAR (30) UNIQUE NOT NULL,
	email VARCHAR(50),
	senha VARCHAR (32) NOT NULL,
	img VARCHAR(27) default 'img/l.png',
	pontuacao INT(4) default 0
);
CREATE TABLE perguntas (
	id INT PRIMARY KEY AUTO_INCREMENT,
	area VARCHAR(90) NOT NULL,
	enunc1 LONGTEXT,
	img VARCHAR(80),
	text LONGTEXT,
	enunc2 LONGTEXT,
	alt1 LONGTEXT NOT NULL,
	alt2 LONGTEXT NOT NULL,
	alt3 LONGTEXT,
	alt4 LONGTEXT,
	alt5 LONGTEXT,
	resp VARCHAR(1) NOT NULL
); 
CREATE TABLE historico (
  id INT PRIMARY KEY AUTO_INCREMENT,
  arPerg VARCHAR(80) NOT NULL,
  idUsuario INT NOT NULL,
  FOREIGN KEY (idUsuario) REFERENCES usuario (idUser)
);

INSERT INTO perguntas (area, enunc1, alt1, alt2, resp) VALUES("Curiosidades", "O cachorro-quente é uma invenção alemã do século XV.", "Verdadeiro", "Falso", "A");
INSERT INTO perguntas (area, enunc1, alt1, alt2, resp) VALUES("Curiosidades", "O recorde de voo de uma galinha é de 13 segundos.", "Verdadeiro", "Falso", "A");
INSERT INTO perguntas (area, enunc1, alt1, alt2, resp) VALUES("Curiosidades", "O cérebro humano é formado por, aproximadamente, 65% de água.", "Verdadeiro", "Falso", "B");
INSERT INTO perguntas (area, enunc1, alt1, alt2, resp) VALUES("Curiosidades", "O calendário da Etiópia é sete anos atrasado em relação aos demais países do ocidente.", "Verdadeiro", "Falso", "A");
