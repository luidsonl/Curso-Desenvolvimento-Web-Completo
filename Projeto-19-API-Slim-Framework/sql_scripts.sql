DROP DATABASE IF EXISTS slim;
CREATE DATABASE slim COLLATE utf8_unicode_ci;
USE slim;

/*A tabela produtos já é criada no arquivo db.php*/

CREATE TABLE usuarios(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	nome VARCHAR(100) NOT NULL,
	email VARCHAR(150) NOT NULL,
	senha VARCHAR(32) NOT NULL 
);

INSERT INTO usuarios (nome, email, senha) VALUES ('luidson', 'luidson@email.com', MD5('123456'));