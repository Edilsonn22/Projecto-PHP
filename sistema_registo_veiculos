CREATE DATABASE sistema_registo_veiculos;
USE sistema_registo_veiculos;


CREATE TABLE login_usuarios (
    codigo_usuario INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL ,
    senha VARCHAR(255) NOT NULL 
);
INSERT INTO login_usuarios (username, senha)
 VALUES ('elton', '1234');
	
select * from login_usuarios;
drop database sistema_registo_veiculos;



CREATE TABLE proprietarios (
    codigo_proprietario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    telefone VARCHAR(20),
    BI varchar(50) not null unique
);


CREATE TABLE veiculos ( 
    codigo_veiculo INT AUTO_INCREMENT PRIMARY KEY,
    marca VARCHAR(250) NOT NULL,
    matricula VARCHAR(20) NOT NULL UNIQUE,
    ano_fabrico INT,
    tipo varchar (50)
);


CREATE TABLE parquemento (
    codigo_parqueamento INT AUTO_INCREMENT PRIMARY KEY,
    codigo_veiculo INT NOT NULL,
    codigo_proprietario INT NOT NULL,
    numero_pista VARCHAR(10) NOT NULL,
    data_parqueamento DATE NOT NULL,
    hora_entrada TIME NOT NULL,
    hora_saida TIME,

    FOREIGN KEY (codigo_veiculo) REFERENCES veiculos(codigo_veiculo) ON DELETE CASCADE,
    FOREIGN KEY (codigo_proprietario) REFERENCES proprietarios(codigo_proprietario) ON DELETE CASCADE
);
