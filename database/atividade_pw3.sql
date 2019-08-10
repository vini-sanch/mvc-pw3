#Cria o banco de dados
CREATE DATABASE `BDNOTICIA`;
#seleciona o banco
USE `BDNOTICIA`;

ALTER DATABASE `BDNOTICIA` CHARSET = UTF8 COLLATE = utf8_unicode_ci;

#cria a tabela Usuário
CREATE TABLE `USUARIO`(
	#colunas
	`CODUSUARIO`	INT AUTO_INCREMENT,
    `NOME` 			VARCHAR(50)  NOT NULL,
    `EMAIL`			VARCHAR(50)  NOT NULL,
    `SENHA`			VARCHAR(100) NOT NULL,
    `NIVEL_ACESSO`	VARCHAR(20)  NOT NULL,
    #chave primária
    PRIMARY KEY (`CODUSUARIO`)
);

#cria a tabela Categoria
CREATE TABLE `CATEGORIA` (
	`CODCATEGORIA`		INT AUTO_INCREMENT,
    `NOMECATEGORIA` 	VARCHAR(20),
    
    PRIMARY KEY (`CODCATEGORIA`)
);

#cria a tabela notícia
CREATE TABLE `NOTICIA` (
	#atributos
	`CODNOTICIA`	INT AUTO_INCREMENT,
    `TITULO`		VARCHAR(40) NOT NULL,
    `CONTEUDO`		TEXT,
    `DATA`			DATE NOT NULL,
    `AUTOR`			VARCHAR(50) NOT NULL,
    `IMAGEM`		VARCHAR(60),
    `CODCATEGORIA`	INT,
    
    #chave primária
    PRIMARY KEY (`CODNOTICIA`),
    
    #chave estrangeira
    CONSTRAINT `FK_CATEGORIA_NOTICIA`
		FOREIGN KEY (`CODCATEGORIA`)
        REFERENCES `CATEGORIA` (`CODCATEGORIA`)
);

/* Criação de indexações para as tabelas */

# indexando pelo nome (tabela usuário)
CREATE INDEX IDX_NOME ON `USUARIO` (`NOME`);
# indíce único para e-mail (chave candidata tabela usuário)
CREATE UNIQUE INDEX IDX_EMAIL ON `USUARIO` (`EMAIL`);

#indexando pelo nome da categoria (tabela categoria)
CREATE INDEX IDX_NOMECATEGORIA ON `CATEGORIA` (`NOMECATEGORIA`);

# indexando pela data, título e autor (tabela notícia)
CREATE INDEX IDX_NOTICIA ON `NOTICIA` (`DATA`, `TITULO`, `AUTOR`);
